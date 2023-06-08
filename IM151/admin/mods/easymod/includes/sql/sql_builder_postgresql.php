<?php
/**
 *
 * @package SQL Parser
 * @version $Id: sql_builder_postgresql.php,v 1.4 2008/02/16 22:18:28 terrafrost Exp $
 * @copyright (c) 2005 phpBB Group
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License
 *
 */


/**
 * SQL Builder Class for PostgreSQL
 *
 * References:
 * http://www.postgresql.org/docs/8.0/interactive/index.html
 * http://www.postgresql.org/docs/8.0/interactive/sql-commands.html
 */
class sql_builder_postgresql extends sql_builder
{
	/**
	 * Translate the data type
	 */
	function translate_datatype($column_data)
	{
		$datatype = $column_data['datatype_name'];

		$datatype_map = array(
			'TINYINT'		=> 'SMALLINT',
			'MEDIUMINT'		=> 'INTEGER',
			'BINARY'		=> 'BYTEA',
			'VARBINARY'		=> 'BYTEA',
			'TINYBLOB'		=> 'BYTEA',
			'BLOB'			=> 'BYTEA',
			'MEDIUMBLOB'	=> 'BYTEA',
			'LONGBLOB'		=> 'BYTEA'
		);
		if( isset($datatype_map[$datatype]) )
		{
			$datatype = $datatype_map[$datatype];
		}
		if( isset($column_data['binary']) )
		{
			$datatype = 'BYTEA';
		}
		if( in_array($datatype, array('SMALLINT','INTEGER','BIGINT')) )
		{
			// - PostgreSQL does not support the UNSIGNED attribute, therefore small
			//   integers (we'll never promote integers to BIGINT, which is a really huge
			//   data type) should promoted in some cases:
			//   a) Of course, SMALLINT UNSIGNED was specified and
			//   b) It hasn't been already promoted by datatype_map and
			//   c) No display width was specified or it is greater than the type capability.
			if( $datatype == 'SMALLINT' && isset($column_data['unsigned']) && !isset($datatype_map[$column_data['datatype_name']]) )
			{
				if( $column_data['datatype_argc'] == 0 || $column_data['datatype_argc'] > 6 )
				{
					$datatype = 'INTEGER';
				}
			}
			if( isset($column_data['auto_increment']) )
			{
				// PostgreSQL (at least, since 7.2) creates the sequence automatically when using SERIAL
				// See chapter "Serial Types":
				// http://www.postgresql.org/docs/8.0/interactive/datatype.html
				// http://www.postgresql.org/docs/7.2/interactive/datatype.html
				$datatype = ( $datatype == 'BIGINT' ? 'BIGSERIAL' : 'SERIAL' );
			}
		}
		else
		{
			if( $column_data['datatype_argc'] > 0 && in_array($datatype, array('DECIMAL','CHAR','VARCHAR')) )
			{
				$datatype .= '(' . implode(', ', $column_data['datatype_argv']) . ')';
			}
		}
		return $datatype;
	}

	/**
	 * Build a Column Definition.
	 *
	 * References:
	 * http://www.postgresql.org/docs/8.0/interactive/datatype.html
	 */
	function build_column_definition($column_data)
	{
		$column_definition = $column_data['name'] . ' ' . $this->translate_datatype($column_data);

		if( !isset($column_data['auto_increment']) )
		{
			if( !empty($column_data['null']) )
			{
				$column_definition .= ' ' . $column_data['null'];
			}
			if( isset($column_data['default']) )
			{
				$column_definition .= ' DEFAULT ' . $column_data['default'];
			}
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
		$contraint_name = $this->get_identifier($sql_data['table_name'], '_pk');
		return 'CONSTRAINT ' . $contraint_name . ' PRIMARY KEY (' . implode(', ', $keys) . ')';
	}

	/**
	 * Build an Index Definition.
	 */
	function build_index(&$sql_data, $index_data)
	{
		$table_name = $sql_data['table_name'];
		$index_name = $this->get_identifier($sql_data['table_name'] . '_' . $index_data['name']);
		$keys = array();
		for( $i = 0; $i < count($index_data['keys']); $i++ )
		{
			$key_data = &$index_data['keys'][$i];
			$key_order = ( $key_data['order'] != 'ASC' ? ' DESC' : '' );
			$keys[] = $key_data['name'] . $key_order;
		}
		return 'CREATE' . ( $index_data['unique'] ? ' UNIQUE' : '' ) . ' INDEX ' . $index_name . ' ON ' . $table_name . ' (' . implode(', ', $keys) . ')';
	}

	/**
	 * Build a CREATE TABLE statement.
	 *
	 * References:
	 * http://www.postgresql.org/docs/8.0/interactive/sql-createtable.html
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
		foreach( $sql_data['columns'] as $column_data )
		{
			if( isset($column_data['unsigned']) )
			{
				$lines[] = $this->indent . 'CHECK (' . $column_data['name'] . '>=0)';
			}
		}
		$sql_output[] = 'CREATE TABLE ' . $sql_data['table_name'] . " (\n" . implode(",\n", $lines) . "\n)";

		foreach( $sql_data['indexes'] as $index_data )
		{
			$sql_output[] = $this->build_index($sql_data, $index_data);
		}
	}

	/**
	 * Build an ALTER TABLE statement.
	 *
	 * References:
	 * http://www.postgresql.org/docs/8.0/interactive/sql-altertable.html
	 * http://www.postgresql.org/docs/7.4/interactive/sql-altertable.html
	 * http://www.postgresql.org/docs/7.3/interactive/sql-altertable.html
	 * http://www.postgresql.org/docs/7.2/interactive/sql-altertable.html
	 *
	 * @access public
	 * @param array Specifications to build the statement.
	 * @param array One or more formatted SQL statements.
	 */
	function alter_table(&$sql_data, &$sql_output)
	{
		switch( $sql_data['action'] )
		{
			case 'ADD':
				if( count($sql_data['primary_keys']) > 0 )
				{
					$sql_output[] = 'ALTER TABLE ' . $sql_data['table_name'] . ' ADD ' . $this->build_primary_key($sql_data);
				}
				elseif( count($sql_data['indexes']) > 0 )
				{
					$sql_output[] = $this->build_index($sql_data, array_shift($sql_data['indexes']));
				}
				elseif( count($sql_data['columns']) > 0 )
				{
					// Note: DEFAULT and NOT NULL clausules in the same ALTER ADD COLUMN
					// statement were not supported until PostgreSQL 8.0
					$column_data = array_shift($sql_data['columns']);
					$column_name = $column_data['name'];
					if( isset($column_data['default']) )
					{
						$set_default = $column_data['default'];
						unset($column_data['default']);
					}
					if( isset($column_data['null']) )
					{
						if( $column_data['null'] == 'NOT NULL' )
						{
							$set_null = ' SET NOT NULL';
						}
						unset($column_data['null']);
					}
					$sql_output[] = 'ALTER TABLE ' . $sql_data['table_name'] . ' ADD COLUMN ' . $this->build_column_definition($column_data);
					if( isset($set_default) )
					{
						$sql_output[] = 'ALTER TABLE ' . $sql_data['table_name'] . ' ALTER COLUMN ' . $column_name . ' SET DEFAULT ' . $set_default;
					}
					if( isset($set_null) )
					{
						if( !isset($set_default) )
						{
							$set_default = ( strstr('BIFD', $column_data['constant_type']) ? 0 : "''" );
						}
						$sql_output[] = 'UPDATE ' . $sql_data['table_name'] . " SET $column_name = $set_default WHERE $column_name IS NULL";
						$sql_output[] = 'ALTER TABLE ' . $sql_data['table_name'] . ' ALTER COLUMN ' . $column_name . $set_null;
					}

					if( isset($column_data['unsigned']) )
					{
						$sql_output[] = 'ALTER TABLE ' . $sql_data['table_name'] . ' ADD CHECK (' . $column_data['name'] . '>=0)';
					}
				}
				break;

			case 'ALTER':
				$line = 'ALTER TABLE ' . $sql_data['table_name'] . ' ALTER COLUMN ' . $sql_data['column'];
				if( $sql_data['subaction'] == 'set_default' )
				{
					$line .= ' SET DEFAULT ' . $sql_data['default'];
				}
				else
				{
					$line .= ' DROP DEFAULT';
				}
				$sql_output[] = $line;
				break;

			case 'CHANGE':
			case 'MODIFY':
				$column_data = array_shift($sql_data['columns']);
				$column_name = $column_data['name'];
				$datatype = $this->translate_datatype($column_data);
				if( $sql_data['action'] == 'CHANGE' )
				{
					$sql_output[] = 'ALTER TABLE ' . $sql_data['table_name'] . ' RENAME COLUMN ' . $sql_data['old_column'] . ' TO ' . $column_name;
				}
				$sql_output[] = 'ALTER TABLE ' . $sql_data['table_name'] . ' ALTER COLUMN ' . $column_name . ' TYPE ' . $datatype;
				$line = 'ALTER TABLE ' . $sql_data['table_name'] . ' ALTER COLUMN ' . $column_name;
				if( isset($column_data['default']) )
				{
					$line .= ' SET DEFAULT ' . $column_data['default'];
				}
				else
				{
					$line .= ' DROP DEFAULT';
				}
				$sql_output[] = $line;
				$set_drop = ( empty($column_data['null']) || $column_data['null'] == 'NULL' ? 'DROP' : 'SET' );
				if( $set_drop == 'SET' && isset($column_data['default']) )
				{
					$sql_output[] = 'UPDATE ' . $sql_data['table_name'] . " SET $column_name = " . $column_data['default'] . " WHERE $column_name IS NULL";
				}
				$sql_output[] = 'ALTER TABLE ' . $sql_data['table_name'] . ' ALTER COLUMN ' . $column_name . ' ' . $set_drop . ' NOT NULL';

				if( isset($column_data['unsigned']) )
				{
					$sql_output[] = 'ALTER TABLE ' . $sql_data['table_name'] . ' ADD CHECK (' . $column_data['name'] . '>=0)';
				}
				break;

			case 'DROP':
				if( isset($sql_data['primary_key']) )
				{
					$sql_output[] = 'ALTER TABLE ' . $sql_data['table_name'] . ' DROP CONSTRAINT ' . $sql_data['table_name'] . '_pkey';
				}
				elseif( isset($sql_data['index']) )
				{
					$sql_output[] = 'DROP INDEX ' . $sql_data['index'];
				}
				elseif( isset($sql_data['column']) )
				{
					// Note: DROP COLUMN was added in 7.3, and I guess we can't easilly offer support for
					// previous (legacy :P ;) versions, where the way to deal with this kind of operations
					// would, more or less, look like this:
					// 1) CREATE TABLE temp AS SELECT * FROM target_table;
					// 2) DROP TABLE target_table;
					// 3) CREATE TABLE target_table (column_definition[,...]);
					// 4) INSERT INTO target_table SELECT * FROM temp;
					// 5) DROP TABLE temp;
					// The problem here is we don't have the required information to build 3rd step, and
					// the CREATE TABLE a LIKE b; statement was not implemented until version 7.4, so the
					// only possible automation here would be to read all table attributes from the server
					// and dynamically build the column definitions, which looks like a bit too heavy.
					$sql_output[] = 'ALTER TABLE ' . $sql_data['table_name'] . ' DROP COLUMN ' . $sql_data['column'] . ' CASCADE';
				}
				break;
		}
	}

	/**
	 * Build a DROP TABLE statement.
	 *
	 * References:
	 * http://www.postgresql.org/docs/8.0/interactive/sql-droptable.html
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