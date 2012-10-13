<?php
/**
 *
 * @package SQL Parser
 * @version $Id: sql_builder_mysql.php,v 1.5 2005/11/10 02:09:34 markus_petrux Exp $
 * @copyright (c) 2005 phpBB Group
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License
 *
 */


/**
 * SQL Builder Class for MySQL
 *
 * References:
 * http://dev.mysql.com/doc/mysql/en/data-definition.html
 */
class sql_builder_mysql extends sql_builder
{
	/**
	 * Translate the data type
	 */
	function translate_datatype($column_data)
	{
		$datatype = $column_data['datatype_name'];

		// BOOLEANs were added in MySQL 4.1.0
		// http://dev.mysql.com/doc/mysql/en/numeric-type-overview.html
		// We'll use the synonym here for compatibility with older versions.
		if( $datatype == 'BOOLEAN' )
		{
			$datatype = 'TINYINT(1)';
			$column_data['unsigned'] = true;
		}
		else
		{
			if( $column_data['datatype_argc'] > 0 )
			{
				$datatype .= '(' . implode(', ', $column_data['datatype_argv']) . ')';
			}
		}
		return $datatype;
	}

	/**
	 * Build a Column Definition.
	 */
	function build_column_definition($column_data)
	{
		$column_definition = $column_data['name'] . ' ' . $this->translate_datatype($column_data);

		if( isset($column_data['unsigned']) )
		{
			$column_definition .= ' UNSIGNED';
		}
		if( isset($column_data['binary']) )
		{
			$column_definition .= ' BINARY';
		}
		if( isset($column_data['zerofill']) )
		{
			$column_definition .= ' ZEROFILL';
		}
		if( !empty($column_data['null']) )
		{
			$column_definition .= ' ' . $column_data['null'];
		}
		if( isset($column_data['default']) )
		{
			$column_definition .= ' DEFAULT ' . $column_data['default'];
		}
		if( isset($column_data['auto_increment']) )
		{
			$column_definition .= ' AUTO_INCREMENT';
		}
		return $column_definition;
	}

	/**
	 * Build a Primary Key Definition.
	 */
	function build_primary_key(&$sql_data)
	{
		$keys = array();
		for( $i = 0; $i < count($sql_data['primary_keys']); $i++ )
		{
			$key_data = &$sql_data['primary_keys'][$i];
			$key_order = ( $key_data['order'] != 'ASC' ? ' DESC' : '' );
			$keys[] = $key_data['name'] . $key_order;
		}
		return 'PRIMARY KEY (' . implode(', ', $keys) . ')';
	}

	/**
	 * Build an Index Definition.
	 */
	function build_index(&$sql_data, $index_data)
	{
		$keys = array();
		for( $i = 0; $i < count($index_data['keys']); $i++ )
		{
			$key_data = &$index_data['keys'][$i];
			$key_length = ( $key_data['length'] > 0 ? ('('.$key_data['length'].')') : '' );
			$key_order = ( $key_data['order'] != 'ASC' ? ' DESC' : '' );
			$keys[] = $key_data['name'] . $key_length . $key_order;
		}
		return ( $index_data['unique'] ? 'UNIQUE' : 'INDEX' ) . ' ' . $index_data['name'] . ' (' . implode(', ', $keys) . ')';
	}

	/**
	 * Build a CREATE TABLE statement.
	 *
	 * References:
	 * http://dev.mysql.com/doc/mysql/en/create-table.html
	 *
	 * @access public
	 * @param array Specifications to build the statement.
	 * @param array One or more formatted SQL statements.
	 */
	function create_table(&$sql_data, &$sql_output)
	{
		$lines = array();
		foreach( $sql_data['columns'] as $column_data )
		{
			$lines[] = $this->indent . $this->build_column_definition($column_data);
		}
		if( count($sql_data['primary_keys']) > 0 )
		{
			$lines[] = $this->indent . $this->build_primary_key($sql_data);
		}
		foreach( $sql_data['indexes'] as $index_data )
		{
			$lines[] = $this->indent . $this->build_index($sql_data, $index_data);
		}
		$sql_output[] = 'CREATE TABLE ' . $sql_data['table_name'] . " (\n" . implode(",\n", $lines) . "\n)";
	}

	/**
	 * Build an ALTER TABLE statement.
	 *
	 * References:
	 * http://dev.mysql.com/doc/mysql/en/alter-table.html
	 *
	 * @access public
	 * @param array Specifications to build the statement.
	 * @param array One or more formatted SQL statements.
	 */
	function alter_table(&$sql_data, &$sql_output)
	{
		$line = 'ALTER TABLE ' . $sql_data['table_name'] . ' ' . $sql_data['action'];
		switch( $sql_data['action'] )
		{
			case 'ADD':
				if( count($sql_data['primary_keys']) > 0 )
				{
					$line .= ' ' . $this->build_primary_key($sql_data);
				}
				elseif( count($sql_data['indexes']) > 0 )
				{
					$line .= ' ' . $this->build_index($sql_data, array_shift($sql_data['indexes']));
				}
				elseif( count($sql_data['columns']) > 0 )
				{
					$line .= ' ' . $this->build_column_definition(array_shift($sql_data['columns']));
				}
				break;

			case 'ALTER':
				$line .= ' COLUMN ' . $sql_data['column'];
				if( $sql_data['subaction'] == 'set_default' )
				{
					$line .= ' SET DEFAULT ' . $sql_data['default'];
				}
				else
				{
					$line .= ' DROP DEFAULT';
				}
				break;

			case 'CHANGE':
				$line .= ' COLUMN ' . $sql_data['old_column'] . ' ' .$this->build_column_definition(array_shift($sql_data['columns']));
				break;

			case 'MODIFY':
				$line .= ' COLUMN ' . $this->build_column_definition(array_shift($sql_data['columns']));
				break;

			case 'DROP':
				if( isset($sql_data['primary_key']) )
				{
					$line .= ' PRIMARY KEY';
				}
				elseif( isset($sql_data['index']) )
				{
					$line .= ' INDEX ' . $sql_data['index'];
				}
				elseif( isset($sql_data['column']) )
				{
					$line .= ' COLUMN ' . $sql_data['column'];
				}
				break;
		}
		$sql_output[] = $line;
	}

	/**
	 * Build a DROP TABLE statement.
	 *
	 * References:
	 * http://dev.mysql.com/doc/mysql/en/drop-table.html
	 *
	 * @access public
	 * @param array Specifications to build the statement.
	 * @param array One or more formatted SQL statements.
	 */
	function drop_table(&$sql_data, &$sql_output)
	{
		$sql_output[] = 'DROP TABLE ' . $sql_data['table_name'];
	}
}

?>