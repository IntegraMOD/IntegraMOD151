<?php
/***************************************************************************
 *                                 mysqli.php
 *                            -------------------
 *   begin                : 1 janvier 2013
 *   copyright            : achaab & BoBmArLeY
 *   sebsite              : http://premod-shdow.servhome.org
 *
 *   $Id: mysqli.php,v 1.0 2013/01/01 21:13:47 achaab Exp $
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *   Please, if you do any change to improve the code, send me an email
 *   at achaab@hotmail.fr so i can do the changes myself and diffuse them
 *
 ***************************************************************************/

if(!defined("SQL_LAYER"))
{
	class sql_cache_fake_key
	{}

	define("SQL_LAYER","mysqli");

	class sql_db
	{
		var $db_connect_id;
		var $query_result;
		var $num_queries = 0;
		var $in_transaction = 0;
		public $queries;
		public $sql_time;
		public $cache, $cached, $caching;

		//
		// Constructor
		//
		function sql_db($sqlserver, $sqluser, $sqlpassword, $database, $port = false, $persistency = false)
		{
			$this->persistency = (version_compare(PHP_VERSION, '5.3.0', '>=')) ? $persistency : false;
			$this->user = $sqluser;
			
			$this->password = $sqlpassword;
			$this->server = ($this->persistency) ? 'p:' . (($sqlserver) ? $sqlserver : 'localhost') : $sqlserver;
			
			$this->dbname = $database;
			$port = (!$port) ? NULL : $port;

			$this->db_connect_id = @mysqli_connect($this->server, $this->user, $this->password, $this->dbname, $port);

			$this->row = new SplObjectStorage();
			$this->rowset = new SplObjectStorage();
			
			if( $this->db_connect_id && $database != '')
			{
				@mysqli_query($this->db_connect_id, "SET NAMES 'ISO-8859-1'");
				
				$this->dbname = $database;
				$dbselect = @mysqli_select_db($this->db_connect_id, $this->dbname);

				if( $dbselect === false )
				{
					@mysqli_close($this->db_connect_id);
					$this->db_connect_id = $dbselect;
				}


				return $this->db_connect_id;
			}
			else
			{
				return false;
			}
		}

		//
		// Other base methods
		//
		
		function sql_close()
		{
			if( $this->db_connect_id )
			{
				//
				// Commit any remaining transactions
				//
				if( $this->in_transaction )
				{
					@mysqli_commit($this->db_connect_id);
				}

				return @mysqli_close($this->db_connect_id);
			}
			else
			{
				return false;
			}
		}

		//
		// Base query method
		//
		function sql_query($query = "", $transaction = FALSE, $cache = null)
		{
			// Check cache
			$this->caching = false;
			$this->cache = array();
			$this->cached = false;
			if($query !== '' && $cache)
			{
				global $phpbb_root_path;
				$hash = md5($query);
				if(strlen($cache))
				{
					$hash = $cache . $hash;
				}
				$filename = $phpbb_root_path . 'cache/sql_' . $hash . '.php';
				if(@file_exists($filename))
				{
					$set = array();
					@include($filename);
					// This isset is important just in case someone removed the file while we included it
					if (isset($set))
					{
						$this->cache = $set;
						$this->cached = true;
						$this->caching = false;
						return new sql_cache_fake_key();
					}
				}
				$this->caching = $hash;
			}

			//
			// Remove any pre-existing queries
			//
			unset($this->query_result);
			if( $query != "" )
			{
				$this->num_queries++;
				if( $transaction == BEGIN_TRANSACTION && !$this->in_transaction )
				{
					$result = @mysqli_query($this->db_connect_id, "BEGIN");
					if(!$result)
					{
						return false;
					}
					$this->in_transaction = TRUE;
				}

				$qstart = microtime(true);
				$this->query_result = @mysqli_query($this->db_connect_id, $query);
				$qend = microtime(true);
				$this->sql_time += $qend - $qstart;

				if (defined('DEBUG_SQL') && DEBUG_SQL)
				{
					ob_start();
					debug_print_backtrace();
					$backtrace = ob_get_clean();
					$this->queries[] = array($query, $backtrace, $qend - $qstart);
				}
			}
			else
			{
				if( $transaction == END_TRANSACTION && $this->in_transaction )
				{
					$result = @mysqli_commit($this->db_connect_id);
				}
			}

			$this->query_result = (isset($this->query_result)) ? $this->query_result : false;
			if ($this->query_result)
			{
				if ($this->query_result !== true)
				{
					// if the query wasn't a SELECT, mysqli_query returns simply true
					unset($this->row[$this->query_result]);
					unset($this->rowset[$this->query_result]);
				}

				if( $transaction == END_TRANSACTION && $this->in_transaction )
				{
					$this->in_transaction = FALSE;

					if ( !@mysqli_commit($this->db_connect_id) )
					{
						@mysqli_rollback($this->db_connect_id);
						return false;
					}
				}
				
				return $this->query_result;
			}
			else
			{
				if( $this->in_transaction )
				{
					@mysqli_rollback($this->db_connect_id);
					$this->in_transaction = FALSE;
				}
				return false;
			}
		}

		//
		// Other query methods
		//
		function sql_numrows($query_id = 0)
		{
			if ($query_id instanceof sql_cache_fake_key)
			{
				return count($this->cache);
			}
			if ($query_id === false)
			{
				$query_id = $this->query_result;
			}
			

			$qstart = microtime(true);
			$result = ( $query_id ) ? mysqli_num_rows($query_id) : false;
			$qend = microtime(true);
			$this->sql_time += $qend - $qstart;
		}

		function sql_affectedrows()
		{
			return ( $this->db_connect_id ) ? @mysqli_affected_rows($this->db_connect_id) : false;
		}

		function sql_numfields($query_id)
		{
			if ($query_id === false)
			{
				$query_id = $this->query_result;
			}

			return ( $query_id ) ? $query_id->field_count : false;
		}

		function sql_fieldname($offset, $query_id = 0)
		{
			if ($query_id === false)
			{
				$query_id = $this->query_result;
			}
			
			$field_info = @mysqli_fetch_field_direct($query_id, $offset);
			
			return ( $query_id ) ? $field_info->name : false;
		}

		function sql_fieldtype($offset, $query_id = 0)
		{
			if ($query_id === false)
			{
				$query_id = $this->query_result;
			}

			$field_info = @mysqli_fetch_field_direct($query_id, $offset);
			
			return ( $query_id ) ? $field_info->type : false;
		}
		
		function sql_fetchrow($query_id = 0)
		{
			if ($query_id instanceof sql_cache_fake_key && $this->cached)
				return count($this->cache) ? array_shift($this->cache) : false;
			if ($query_id === false)
			{
				$query_id = $this->query_result;
			}

			if( $query_id )
			{
				$qstart = microtime(true);
				$this->row[$query_id] = mysqli_fetch_array($query_id, MYSQLI_ASSOC);
				$qend = microtime(true);
				$this->sql_time += $qend - $qstart;
				$this->cache[] = $this->row[$query_id];
				return $this->row[$query_id];
			}
			else
			{
				return false;
			}
		}

		function sql_fetchrowset($query_id = 0)
		{			
			if ($query_id === false)
			{
				$query_id = $this->query_result;
			}

			if( $query_id )
			{
				$qstart = microtime(true);
				$result = [];
				while($this->rowset[$query_id] = @mysqli_fetch_array($query_id, MYSQLI_ASSOC))
				{
					$result[] = $this->rowset[$query_id];
				}
				$this->cache = $result;
				$qend = microtime(true);
				$this->sql_time += $qend - $qstart;

        		return $result;
			}
			else
			{
				return false;
			}
		}
		
		function mysqlx_result($query_id, $rownum, $field) 
		{
			$i = 0;
			$retval = '';
			while ($row = $query_id->fetch_array(MYSQLI_BOTH)) 
			{
				if ($i == $rownum)
				{
					$retval = $row[$field];
				}
				$i++;
			}
			return $retval;
		} 

		function sql_fetchfield($field, $rownum = -1, $query_id = 0)
		{
			if ($query_id === false)
			{
				$query_id = $this->query_result;
			}

			if( $query_id )
			{
				if( $rownum > -1 )
				{
					// V TODO: this probably (definitely...) doesn't work with cached results!
					mysqli_data_seek($query_id, $rownum);
					$resrow = (is_numeric($col)) ? mysqli_fetch_row($query_id) : mysqli_fetch_assoc($query_id);
					if (isset($resrow[$field])){
						return $resrow[$field];
					} else {
						return false;
					}
				}
				else
				{
					if( empty($this->row[$query_id]) && empty($this->rowset[$query_id]) )
					{
						if( $this->sql_fetchrow() )
						{
							$result = $this->row[$query_id][$field];
						}
					}
					else
					{
						if( $this->rowset[$query_id] )
						{
							$result = $this->rowset[$query_id][0][$field];
						}
						else if( $this->row[$query_id] )
						{
							$result = $this->row[$query_id][$field];
						}
					}
				}

				return $result;
			}
			else
			{
				return false;
			}
		}

		function sql_rowseek($rownum, $query_id = 0)
		{
			if ($query_id === false)
			{
				$query_id = $this->query_result;
			}
			return ( $query_id ) ? @mysqli_data_seek($query_id, $rownum) : false;
		}

		function sql_nextid()
		{
			return ( $this->db_connect_id ) ? @mysqli_insert_id($this->db_connect_id) : false;
		}

		function sql_freeresult($query_id = 0)
		{
			if ($query_id === 'cache')
			{
				$this->caching = false;
				$this->cached = false;
				$this->cache = array();
				return;
			}

			if ($query_id === false)
			{
				$query_id = $this->query_result;
			}

			if ($query_id)
			{
				if ($this->caching)
					$this->write_cache();
				unset($this->row[$query_id]);
				unset($this->rowset[$query_id]);

				@mysqli_free_result($query_id);

				return true;
			}
			else
			{
				return false;
			}
		}

		function sql_error()
		{
			$result['message'] = @mysqli_error($this->db_connect_id);
			$result['code'] = @mysqli_errno($this->db_connect_id);

			return $result;
		}

		function write_cache()
		{
			if(!$this->caching)
			{
				return;
			}
			global $phpbb_root_path;
			$f = fopen($phpbb_root_path . 'cache/sql_' . $this->caching . '.php', 'w');
			$data = var_export($this->cache, true);
			@fputs($f, '<?php $set = ' . $data . '; ?>');
			@fclose($f);
			@chmod($phpbb_root_path . 'cache/sql_' . $this->caching . '.php', 0777);
			$this->caching = false;
			$this->cached = false;
			$this->cache = array();
		}

		  function clear_cache($prefix = '')
		  {
			global $phpbb_root_path;
			$this->caching = false;
			$this->cached = false;
			$this->cache = array();
			$prefix = 'sql_' . $prefix;
			$prefix_len = strlen($prefix);
			if($res = opendir($phpbb_root_path . 'cache'))
			{
				while(($file = readdir($res)) !== false)
				{
					if(substr($file, 0, $prefix_len) === $prefix)
					{
						@unlink($phpbb_root_path . 'cache/' . $file);
					}
				}
			}
			@closedir($res);
		}
	} // class sql_db

} // if ... define

?>
