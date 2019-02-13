<?php
//
//	file: includes/class_db.php
//	author: ptirhiik
//	begin: 25/08/2004
//	version: 1.6.6 - 30/12/2006
//	license: http://opensource.org/licenses/gpl-license.php GNU General Public License (GPL)
//

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

function _sql_type_cast($value, $quotes=true)
{
	global $db;
	return
	/* str_replace(array('\\\'', '\\"'), array('\'\'', '"'), addslashes($value)) .  */
		is_string($value) ? ($quotes ? '\'' : '') . $db->sql_escape($value) . ($quotes ? '\'' : '') : (
		is_float($value) ? doubleval($value) : (
		is_integer($value) || is_bool($value) ? intval($value) : (
		'\'\''
	)));
}

function _sql_map_fields($key, $value)
{
	return $key . ' = ' . _sql_type_cast($value);
}

class class_db extends sql_db
{
	var $trc_sql;
	var $sql_fields;
	var $sql_values;
	var $sql_update;
	var $sql_stack_fields;
	var $sql_stack_values;

	var $sql_version;

	function db_class($sqlserver, $sqluser, $sqlpassword, $database, $persistency = true)
	{
		@parent::sql_db($sqlserver, $sqluser, $sqlpassword, $database, $persistency);
		$this->trc_sql = array();
		$this->sql_version = array();
	}

	function sql_query($query='', $transaction=false, $cache = null, $reason = '', $line='', $file='')
	{
		if ( empty($file) )
		{
			$break_on_error = false;
		}
		if ( defined('DEBUG_RUN_STATS') )
		{
			$query_start = microtime();
		}
		$query_res = parent::sql_query($query, $transaction, $cache);
		if ( defined('DEBUG_RUN_STATS') )
		{
			$query_end = microtime();
			if ( defined('DEBUG_SQL') )
			{
				if ( empty($file) && function_exists('debug_backtrace') )
				{
					$dbg = debug_backtrace();
					$file = $dbg[0]['file'];
					$line = $dbg[0]['line'];
					unset($dbg);
				}
				$this->trc_sql[] = array('file' => empty($file) ? '?' : basename($file), 'line' => $line, 'sql' => $query, 'start' => $query_start, 'end' => $query_end, 'after_debug' => microtime());
			}
			else
			{
				$this->trc_sql[] = array('start' => $query_start, 'end' => $query_end, 'after_debug' => microtime());
			}
		}
		if ( !$query_res && $reason )
		{
			$sql_err = $this->sql_error();
			$sql_err_msg = $sql_err ? '<pre>' . $sql_err['message'] . '</pre>' : '';
			message_die(GENERAL_ERROR, 'SQL error: '.$reason . '<br>' . $sql_err_msg, '', $line, $file, htmlspecialchars($query));
		}
		return $query_res;
	}

	function sql_type_cast($value)
	{
		return _sql_type_cast($value);
	}
	// needs sql_escape from parent

	function sql_build_insert($table, $fields)
	{
		$sql_fields = $this->sql_fields('fields', $fields);
		$sql_values = $this->sql_fields('values', $fields);
		if (!$sql_fields || !$sql_values)
		{
			return "";
		}
		return "INSERT INTO $table $sql_fields ($sql_values) ";
	}

	function sql_build_update($table, $fields, $fields_inc = '')
	{
		$sql_update = $this->sql_fields('update', $fields, $fields_inc);
		if (!$sql_update)
		{
			return "";
		}
		$sql = "UPDATE $table SET $sql_update ";
	}

	function sql_fields($mode, &$fields, $fields_inc='')
	{
		switch ( $mode )
		{
			case 'fields':
				return empty($fields) ? '' : implode(', ', array_keys($fields));
			case 'values':
				return empty($fields) ? '' : implode(', ', array_map('_sql_type_cast', array_values($fields)));
			case 'update':
				$inc = array();
				if ( !empty($fields_inc) )
				{
					foreach ( $fields_inc as $field => $indent )
					{
						if ( $indent != 0 )
						{
							$inc[] = $field . ' = ' . $field . ($indent < 0 ? ' - ' : ' + ') . abs($indent);
						}
					}
				}
				return empty($fields) && empty($inc) ? '' : implode(', ', array_merge(empty($inc) ? array() : $inc, empty($fields) ? array() : array_map('_sql_map_fields', array_keys($fields), array_values($fields))));
			default:
				return '';
		}
	}

	function sql_statement(&$fields, $fields_inc='')
	{
		// init result
		$this->sql_fields = $this->sql_values = $this->sql_update = '';
		if ( empty($fields) && empty($fields_inc) )
		{
			return;
		}

		// process
		$this->sql_fields = $this->sql_fields('fields', $fields);
		$this->sql_values = $this->sql_fields('values', $fields);
		$this->sql_update = $this->sql_fields('update', $fields, $fields_inc);
	}

	function sql_stack_reset($id='')
	{
		if ( empty($id) )
		{
			$this->sql_stack_fields = array();
			$this->sql_stack_values = array();
		}
		else
		{
			$this->sql_stack_fields[$id] = array();
			$this->sql_stack_values[$id] = array();
		}
	}

	function sql_stack_statement(&$fields, $id='')
	{
		if ( empty($id) )
		{
			$this->sql_stack_fields = $this->sql_fields('fields', $fields);
			$this->sql_stack_values[] = '(' . $this->sql_fields('values', $fields) . ')';
		}
		else
		{
			if ( empty($this->sql_stack_fields[$id]) )
			{
				$this->sql_stack_fields[$id] = $this->sql_fields('fields', $fields);
			}
			$this->sql_stack_values[$id][] = '(' . $this->sql_fields('values', $fields) . ')';
		}
	}

	function sql_stack_insert($table, $transaction=false, $line='', $file='', $break_on_error=true, $id='')
	{
		if ( (empty($id) && empty($this->sql_stack_values)) || (!empty($id) && empty($this->sql_stack_values[$id])) )
		{
			return false;
		}
		switch( SQL_LAYER )
		{
			case 'mysql':
			case 'mysql4':
			case 'mysqli':
				if ( empty($id) )
				{
					$sql = 'INSERT INTO ' . $table . '
								(' . $this->sql_stack_fields . ') VALUES ' . implode(",\n", $this->sql_stack_values);
				}
				else
				{
					$sql = 'INSERT INTO ' . $table . '
								(' . $this->sql_stack_fields[$id] . ') VALUES ' . implode(",\n", $this->sql_stack_values[$id]);
				}
				$this->sql_stack_reset($id);
				return $this->sql_query($sql, $transaction, $line, $file, $break_on_error);
				break;
			default:
				$count_sql_stack_values = empty($id) ? count($this->sql_stack_values) : count($this->sql_stack_values[$id]);
				$result = !empty($count_sql_stack_values);
				for ( $i = 0; $i < $count_sql_stack_values; $i++ )
				{
					if ( empty($id) )
					{
						$sql = 'INSERT INTO ' . $table . '
									(' . $this->sql_stack_fields . ') VALUES ' . $this->sql_stack_values[$i];
					}
					else
					{
						$sql = 'INSERT INTO ' . $table . '
									(' . $this->sql_stack_fields[$id] . ') VALUES ' . $this->sql_stack_values[$id][$i];
					}
					$result &= $this->sql_query($sql, $transaction, $line, $file, $break_on_error);
				}
				$this->sql_stack_reset($id);
				return $result;
				break;
		}
	}

	/**
	* Build IN or NOT IN sql comparison string, uses <> or = on single element arrays to improve comparison speed
	*
	* @access public
	* @param string $field name of the sql column that shall be compared
	* @param array $array array of values that are allowed (IN) or not allowed (NOT IN)
	* @param bool $negate true for NOT IN (), false for IN () (default)
	* @param bool $allow_empty_set If true, allow $array to be empty, this function will return 1=1 or 1=0 then. Default to false.
	*/
	function sql_in_set($field, $array, $negate = false, $allow_empty_set = false)
	{
		if (!sizeof($array))
		{
			if (!$allow_empty_set)
			{
				// Print the backtrace to help identifying the location of the problematic code
				$this->sql_error('No values specified for SQL IN comparison');
			}
			else
			{
				// NOT IN () actually means everything so use a tautology
				if ($negate)
				{
					return '1=1';
				}
				// IN () actually means nothing so use a contradiction
				else
				{
					return '1=0';
				}
			}
		}

		if (!is_array($array))
		{
			$array = array($array);
		}

		if (sizeof($array) == 1)
		{
			@reset($array);
			$var = current($array);

			return $field . ($negate ? ' <> ' : ' = ') . $this->sql_type_cast($var);
		}
		else
		{
			return $field . ($negate ? ' NOT IN ' : ' IN ') . '(' . implode(', ', array_map(array($this, 'sql_type_cast'), $array)) . ')';
		}
	}


	function sql_subquery($field, $sql, $line='', $file='', $break_on_error=true, $type=TYPE_INT)
	{
		// sub-queries doable
		$this->sql_get_version();
		if ( !in_array(SQL_LAYER, array('mysql', 'mysql4', 'mysqli')) || (($this->sql_version[0] + ($this->sql_version[1] / 100)) >= 4.01) )
		{
			return $sql;
		}

		// no sub-queries
		$ids = array();
		$result = $this->sql_query(trim($sql), false, $line, $file, $break_on_error);
		while ( $row = $this->sql_fetchrow($result) )
		{
			$ids[] = $type == TYPE_INT ? intval($row[$field]) : $this->sql_type_cast((string) $row[$field]);
		}
		$this->sql_freeresult($result);
		return empty($ids) ? 'NULL' : implode(', ', $ids);
	}

	function sql_col_id($expr, $alias)
	{
		$this->sql_get_version();
		return in_array(SQL_LAYER, array('mysql', 'mysql4', 'mysqli')) && (($this->sql_version[0] + ($this->sql_version[1] / 100)) <= 4.01) ? $alias : $expr;
	}

	function sql_get_version()
	{
		if ( empty($this->sql_version) )
		{
			$this->sql_version = array(0, 0, 0);
			switch ( SQL_LAYER )
			{
				case 'mysql':
				case 'mysql4':
				case 'mysqli':
					if ( function_exists('mysql_get_server_info') )
					{
						$lo_version = explode('-', mysql_get_server_info());
						$this->sql_version = explode('.', $lo_version[0]);
						$this->sql_version = array(intval($this->sql_version[0]), intval($this->sql_version[1]), intval($this->sql_version[2]), $lo_version[1]);
					}
					break;

				case 'postgresql':
				case 'mssql':
				case 'mssql-odbc':
				default:
					break;
			}
		}
		return $this->sql_version;
	}

	function sql_error()
	{
		if ( $this->db_connect_id )
		{
			return parent::sql_error();
		}
		else
		{
			return array();
		}
	}
}
