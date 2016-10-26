<?php
/**
 *
 * @package SQL Parser
 * @version $Id: sql_builder_mssql.php,v 1.4 2005/11/04 05:44:33 markus_petrux Exp $
 * @copyright (c) 2005 phpBB Group
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License
 *
 */


/**
 * SQL Builder Class for Microsoft SQL Server
 *
 * References:
 * http://msdn.microsoft.com/library/en-us/dnanchor/html/sqlserver2000.asp
 *
 * Known things that may need revision by the end-user:
 * - The [PRIMARY] "filegroup" is specified for all ON and TEXTIMAGE_ON clausules generated.
 *   The user might want to adapt this clause to its own particular needs (big database, etc).
 *   More information on "filegroups" can be found here:
 *   > Creating and Maintaining Databases -> Files and Filegroups:
 *     http://msdn.microsoft.com/library/en-us/createdb/cm_8_des_02_6epf.asp
 *   > SQL Server Arquitecture -> Physical Database Files and Filegroups:
 *     http://msdn.microsoft.com/library/en-us/architec/8_ar_da2_9sab.asp
 *   > Optimizing Database Performance -> Data Placement using Filegroups:
 *     http://msdn.microsoft.com/library/en-us/optimsql/odp_tun_1_2upf.asp
 */
class sql_builder_mssql extends sql_builder
{
	/**
	 * Translate the data type
	 */
	function translate_datatype($column_data)
	{
		$datatype = $column_data['datatype_name'];

		$datatype_map = array(
			// http://msdn.microsoft.com/library/en-us/tsqlref/ts_fa-fz_6r3g.asp
			'FLOAT'				=> 'REAL',
			'DOUBLE PRECISION'	=> 'FLOAT',
			// http://msdn.microsoft.com/library/en-us/tsqlref/ts_ia-iz_3ss4.asp
			'MEDIUMINT'			=> 'INTEGER',
			// http://msdn.microsoft.com/library/en-us/tsqlref/ts_ia-iz_9rfp.asp
			'TINYBLOB'			=> 'IMAGE',
			'BLOB'				=> 'IMAGE',
			'MEDIUMBLOB'		=> 'IMAGE',
			'LONGBLOB'			=> 'IMAGE'
		);
		if( isset($datatype_map[$datatype]) )
		{
			$datatype = $datatype_map[$datatype];
		}
		if( isset($column_data['binary']) )
		{
			$datatype = ( $datatype == 'CHAR' ? 'BINARY' : 'VARBINARY' );
		}
		if( in_array($datatype, array('TINYINT','SMALLINT','INTEGER','BIGINT')) )
		{
			// - MS-SQL Server does not support signed TINYINTs.
			// - MS-SQL Server does not support MEDIUMINTs.
			// - MS-SQL Server does not support the UNSIGNED attribute, therefore small
			//   integers (we'll never promote integers to BIGINT, which is a really huge
			//   data type) should be promoted in some cases:
			//   a) Of course, SMALLINT UNSIGNED was specified and
			//   b) No display width was specified or it is greater than the type capability.
			if( $datatype == 'TINYINT' && !isset($column_data['unsigned']) )
			{
				$datatype = 'SMALLINT';
			}
			elseif( $datatype == 'SMALLINT' && isset($column_data['unsigned']) && ( $column_data['datatype_argc'] == 0 || $column_data['datatype_argc'] > 6 ) )
			{
				$datatype = 'INTEGER';
			}
		}
		else
		{
			if( $column_data['datatype_argc'] > 0 && in_array($datatype, array('DECIMAL','CHAR','VARCHAR','BINARY','VARBINARY')) )
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
	 * http://msdn.microsoft.com/library/en-us/tsqlref/ts_da-db_7msw.asp
	 */
	function build_column_definition($column_data)
	{
		$column_definition = $column_data['name'] . ' ' . $this->translate_datatype($column_data);

		// According to the MSSQL manual (chapter "Nullability Rules Within a Table Definition")
		// It is recommended to explicitly define the nullability attribute of columns.
		$column_definition .= ' ' . ( empty($column_data['null']) ? 'NULL' : $column_data['null'] );

		if( isset($column_data['default']) )
		{
			$column_definition .= ' DEFAULT (' . $column_data['default'] . ')';
		}
		if( isset($column_data['auto_increment']) )
		{
			$column_definition .= ' IDENTITY(1, 1)';
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
		return 'CONSTRAINT ' . $contraint_name . ' PRIMARY KEY (' . implode(', ', $keys) . ') ON [PRIMARY]';
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
		return 'CREATE' . ( $index_data['unique'] ? ' UNIQUE' : '' ) . ' INDEX ' . $index_name . ' ON ' . $table_name . ' (' . implode(', ', $keys) . ') ON [PRIMARY]';
	}

	/**
	 * Build a CREATE TABLE statement.
	 *
	 * References:
	 * http://msdn.microsoft.com/library/en-us/tsqlref/ts_create2_8g9x.asp
	 *
	 * @access public
	 * @param array Specifications to build the statement.
	 * @param array One or more formatted SQL statements.
	 */
	function create_table(&$sql_data, &$sql_output)
	{
		$on_textimage = false;
		$lines = array();
		foreach( $sql_data['columns'] as $column_data )
		{
			if( in_array($column_data['datatype_name'], array('TEXT')) )
			{
				$on_textimage = true;
			}
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
		$filegroups = ' ON [PRIMARY]' . ( $on_textimage ? ' TEXTIMAGE_ON [PRIMARY]' : '' );
		$sql_output[] = 'CREATE TABLE ' . $sql_data['table_name'] . " (\n" . implode(",\n", $lines) . "\n) $filegroups";

		foreach( $sql_data['indexes'] as $index_data )
		{
			$sql_output[] = $this->build_index($sql_data, $index_data);
		}
	}

	/**
	 * Build an ALTER TABLE statement.
	 *
	 * References:
	 * http://msdn.microsoft.com/library/en-us/tsqlref/ts_aa-az_3ied.asp
	 *
	 * @access public
	 * @param array Specifications to build the statement.
	 * @param array One or more formatted SQL statements.
	 */
	function alter_table(&$sql_data, &$sql_output)
	{
		// @TODO: ALTER TABLE for MSSQL
//		$sql_output[] = 'ALTER TABLE ' . $sql_data['table_name'];
	}

	/**
	 * Build a DROP TABLE statement.
	 *
	 * References:
	 * http://msdn.microsoft.com/library/en-us/tsqlref/ts_de-dz_7uud.asp
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