<?php
/**
 *
 * @package SQL Parser
 * @version $Id: sql_parser.php,v 1.6 2005/11/09 04:39:17 markus_petrux Exp $
 * @copyright (c) 2005 phpBB Group
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License
 *
 */


/**
 * SQL Parser Version.
 */
define('SQL_PARSER_VERSION', '1.0.0');


/**
 * SQL References...
 *
 * MOD Template SQL Command Standard (by Nuttzy):
 * http://area51.phpbb.com/phpBB/viewtopic.php?f=25&t=15390
 *
 * MySQL:
 * http://dev.mysql.com/doc/mysql/en/index.html
 *
 * PostgreSQL:
 * http://www.postgresql.org/docs/manuals/
 *
 * Microsoft SQL Server:
 * http://msdn.microsoft.com/library/en-us/dnanchor/html/sqlserver2000.asp
 *
 * IBM DB2 UDB for Linux/Unix/Windows:
 * http://publib.boulder.ibm.com/infocenter/db2help/index.jsp
 */


/**
 * Return Codes for public SQL parser methods.
 */
define('SQL_PARSER_SUCCESS'		, 0x0000);		// Process worked like a charm.
define('SQL_PARSER_ERROR'		, 0x0001);		// Process failed.
define('SQL_PARSER_WARNINGS'	, 0x0002);		// Warnings array has been filled.

/**
 * SQL Parser Class
 *
 * Convert SQL statements from MySQL to any other DBMS supported by phpBB.
 * It currently deals with CREATE TABLE, DROP TABLE and ALTER TABLE.
 * For DML statements only INSERT, UPDATE and DELETE are allowed, left as-is for
 * the DBAL engine, though.
 *
 *
 * Example usage:
 *
 *	// Instatiate the class
 *	$sql_parser = new sql_parser($phpbb_root_path . 'includes/sql/', SQL_LAYER);
 *
 *	// Process SQL statements from a stream (a string with one or more statements).
 *	// You could also use the method parse_file() with the same arguments.
 *	$result = $sql_parser->parse_stream($sql_stream, $table_prefix);
 *
 *	if( $result & SQL_PARSER_WARNINGS )
 *	{
 *		echo '<b>SQL Parser</b><br /><br /><b>Warnings:</b><br />' . implode('<br />', $sql_parser->warnings);
 *	}
 *
 *	if( $result & SQL_PARSER_ERROR )
 *	{
 *		die('<b>SQL Parser</b><br /><br /><b>Error:</b><br />' . $sql_parser->error_message .
 *			'<br /><br /><b>SQL:</b><br />' . $sql_parser->sql_input[$sql_parser->sql_count]);
 *	}
 *
 *	var_dump($sql_parser->sql_output);	// An array of all SQL statements generated for the target DBMS.
 *	var_dump($sql_parser->sql_total);	// The number of SQL statements processed.
 *
 *
 * Conventions for input format descriptions:
 *
 * Some methods use a special syntax to describe input format.
 * These notes adhere the following conventions:
 *
 * CONVENTION			USED FOR
 * ----------------		----------------------------------------
 * UPPERCASE			SQL keywords
 * | (vertical bar)		Separating optional syntax items within brackets or braces.
 * [ ] (brackets)		Optional syntax items (brackets aren't part of the input).
 * { } (braces)			Required syntax items (braces aren't part of the input).
 * [,...]				The preceding item can be repeated n number of times (separated by commas)
 * [ ...]				The preceding item can be repeated n number of times (separated by blanks).
 *
 */
class sql_parser
{
	/**
	 * Input SQL statements.
	 *
	 * @access public
	 */
	var $sql_input = array();

	/**
	 * Ouput SQL statements.
	 *
	 * @access public
	 */
	var $sql_output = array();

	/**
	 * Current/Latest SQL statement processed.
	 *
	 * @access public
	 */
	var $sql_count = 0;

	/**
	 * Error message, if process failed.
	 *
	 * @access public
	 */
	var $error_message = '';

	/**
	 * Warnings found during the process.
	 *
	 * @access public
	 */
	var $warnings = array();

	/**
	 * Default phpBB table prefix.
	 *
	 * @access private
	 */
	var $phpbb_prefix = 'phpbb_';

	/**
	 * Table prefix on the target system.
	 *
	 * @access private
	 */
	var $table_prefix = '';

	/**
	 * Includes path for "friend" classes.
	 *
	 * Initialized by Class Constructor.
	 *
	 * @access private
	 */
	var $includes_path = '';

	/**
	 * Current target SQL server.
	 *
	 * Initialized by Class Constructor.
	 *
	 * @access private
	 */
	var $sql_layer = '';

	/**
	 * Maximum Identifier Name Length.
	 *
	 * To minimize portability related issues, we use, by default, something
	 * reasonable around the minimum length found on selected DBMS.
	 *
	 * Identifier name lengths found in several SQL servers:
	 * - MS-SQL 2000	: 128
	 * - MySQL			: 64
	 * - PostgreSQL 7.3	: 63 (based on NAMEDATALEN)
	 * - PostgreSQL 7.2	: 31 (based on NAMEDATALEN)
	 *
	 * References:
	 * http://msdn.microsoft.com/library/en-us/acdata/ac_8_con_03_6e9e.asp
	 * http://dev.mysql.com/doc/mysql/en/legal-names.html
	 * http://www.postgresql.org/docs/7.3/interactive/sql-syntax.html
	 * http://www.postgresql.org/docs/7.2/interactive/sql-syntax.html
	 *
	 * @access public
	 */
	var $max_identifier_length = 30;

	/**
	 * Valid chars for an SQL identifier (ie. table, index or column name).
	 *
	 * We restrict identifier names as per the SQL standard, which is:
	 * - Names should start with a letter or hyphen.
	 * - From the second char on may also contain numbers.
	 *
	 * @access private
	 */
	var $valid_identifier_chars = '[a-zA-Z_][a-zA-Z0-9_]+';

	/**
	 * List of SQL Reserved Keywords.
	 *
	 * @see method initialize
	 * @see method check_identifier
	 *
	 * @access private
	 */
	var $reserved_keywords = array();

	/**
	 * Data Dictionary.
	 *
	 * This array is used to check columns using different data types in different tables.
	 * Although we just report warnings, it seems like it worths to check for possible
	 * design inconsistencies.
	 *
	 * @access private
	 */
	var $data_dictionary = array();

	/**
	 * Valid (or Supported) Data Types.
	 *
	 * Each datatype defines the following attributes:
	 * 'A' => 1 allow the auto_increment attribute, 0 disallowed.
	 * 'B' => 1 allow the binary attribute, 0 disallowed.
	 * 'C' => Constant type, used to check/transform constants ('B'oolean, 'I'nteger, 'F'loat, 'D'ecimal, 'C'har and binar'Y').
	 * 'K' => 1 allow to specify length in index keys, 2 required, 0 disallowed.
	 * 'L' => Number of elements allowed to specify column size, display width or (length,decimals).
	 *
	 *			Second and third elements of the 'L' array represent the maximum values
	 *			to specify display widths (DW) for integer types, based on their precision:
	 *
	 *			TYPE		BYTES	MINIMUM UNSIGNED		DW	MAXIMUM UNSIGNED		DW	MAXIMUM SIGNED			DW
	 *			---------	-----	---------------------	--	---------------------	--	---------------------	--
	 *			TINYINT		  1		                -128	 4	                 +127	 4	                 +255	 4
	 *			SMALLINT	  2		              -32768	 6	               +32767	 6	               +65535	 6
	 *			MEDIUMINT	  3		            -8388608	 8	             +8388607	 8	            +16777215	 9
	 *			INTEGER		  4		         -2147483648	11	          +2147483647	11	          +4294967295	11
	 *			BIGINT		  8		-9223372036854775808	20	 +9223372036854775807	20	+18446744073709551615	21
	 *
	 * 'U' => 1 allow the unsigned attribute, 0 disallowed.
	 * 'Z' => 1 allow the zerofill attribute, 0 disallowed.
	 *
	 * References:
	 * http://dev.mysql.com/doc/mysql/en/numeric-types.html
	 * http://dev.mysql.com/doc/mysql/en/char.html
	 * http://dev.mysql.com/doc/mysql/en/binary-varbinary.html
	 * http://dev.mysql.com/doc/mysql/en/blob.html
	 *
	 * @access private
	 */
	var $valid_datatypes = array(
			'BOOLEAN'			=> array('A'=>0, 'B'=>0, 'C'=>'B', 'K'=>0, 'L'=>array(0, 0, 0), 'U'=>0, 'Z'=>0),
			'TINYINT'			=> array('A'=>1, 'B'=>0, 'C'=>'I', 'K'=>0, 'L'=>array(1, 4, 4), 'U'=>1, 'Z'=>1),
			'SMALLINT'			=> array('A'=>1, 'B'=>0, 'C'=>'I', 'K'=>0, 'L'=>array(1, 6, 6), 'U'=>1, 'Z'=>1),
			'MEDIUMINT'			=> array('A'=>1, 'B'=>0, 'C'=>'I', 'K'=>0, 'L'=>array(1, 8, 9), 'U'=>1, 'Z'=>1),
			'INTEGER'			=> array('A'=>1, 'B'=>0, 'C'=>'I', 'K'=>0, 'L'=>array(1,11,11), 'U'=>1, 'Z'=>1),
			'BIGINT'			=> array('A'=>1, 'B'=>0, 'C'=>'I', 'K'=>0, 'L'=>array(1,20,21), 'U'=>1, 'Z'=>1),
			'FLOAT'				=> array('A'=>0, 'B'=>0, 'C'=>'F', 'K'=>0, 'L'=>array(2, 0, 0), 'U'=>1, 'Z'=>1),
			'DOUBLE PRECISION'	=> array('A'=>0, 'B'=>0, 'C'=>'F', 'K'=>0, 'L'=>array(2, 0, 0), 'U'=>1, 'Z'=>1),
			'DECIMAL'			=> array('A'=>0, 'B'=>0, 'C'=>'D', 'K'=>0, 'L'=>array(2, 0, 0), 'U'=>1, 'Z'=>1),
			'CHAR'				=> array('A'=>0, 'B'=>1, 'C'=>'C', 'K'=>1, 'L'=>array(1, 0, 0), 'U'=>0, 'Z'=>0),
			'VARCHAR'			=> array('A'=>0, 'B'=>1, 'C'=>'C', 'K'=>1, 'L'=>array(1, 0, 0), 'U'=>0, 'Z'=>0),
			'BINARY'			=> array('A'=>0, 'B'=>0, 'C'=>'Y', 'K'=>1, 'L'=>array(1, 0, 0), 'U'=>0, 'Z'=>0),
			'VARBINARY'			=> array('A'=>0, 'B'=>0, 'C'=>'Y', 'K'=>1, 'L'=>array(1, 0, 0), 'U'=>0, 'Z'=>0),
			'TINYTEXT'			=> array('A'=>0, 'B'=>0, 'C'=>'C', 'K'=>2, 'L'=>array(0, 0, 0), 'U'=>0, 'Z'=>0),
			'TEXT'				=> array('A'=>0, 'B'=>0, 'C'=>'C', 'K'=>2, 'L'=>array(0, 0, 0), 'U'=>0, 'Z'=>0),
			'MEDIUMTEXT'		=> array('A'=>0, 'B'=>0, 'C'=>'C', 'K'=>2, 'L'=>array(0, 0, 0), 'U'=>0, 'Z'=>0),
			'LONGTEXT'			=> array('A'=>0, 'B'=>0, 'C'=>'C', 'K'=>2, 'L'=>array(0, 0, 0), 'U'=>0, 'Z'=>0),
			'TINYBLOB'			=> array('A'=>0, 'B'=>0, 'C'=>'Y', 'K'=>2, 'L'=>array(0, 0, 0), 'U'=>0, 'Z'=>0),
			'BLOB'				=> array('A'=>0, 'B'=>0, 'C'=>'Y', 'K'=>2, 'L'=>array(0, 0, 0), 'U'=>0, 'Z'=>0),
			'MEDIUMBLOB'		=> array('A'=>0, 'B'=>0, 'C'=>'Y', 'K'=>2, 'L'=>array(0, 0, 0), 'U'=>0, 'Z'=>0),
			'LONGBLOB'			=> array('A'=>0, 'B'=>0, 'C'=>'Y', 'K'=>2, 'L'=>array(0, 0, 0), 'U'=>0, 'Z'=>0)
		);

	/**
	 * Invalid (or Unsupported) Data Types
	 *
	 * @access private
	 */
	var $invalid_datatypes = array(
			// http://dev.mysql.com/doc/mysql/en/enum.html
			'ENUM',
			// http://dev.mysql.com/doc/mysql/en/set.html
			'SET',
			// http://dev.mysql.com/doc/mysql/en/date-and-time-types.html
			'DATETIME',						// 'YYYY-MM-DD hh:mm:ss'
			'DATE',							// 'YYYY-MM-DD'
			'TIMESTAMP',					// YYYYMMDDhhmmss
			'TIME',							// 'hh:mm:ss'
			'YEAR'							// YYYY
		);

	/**
	 * Data type aliases
	 *
	 * @access private
	 */
	var $datatype_aliases = array(
			'BIT'		=> 'BOOLEAN',
			'BOOL'		=> 'BOOLEAN',
			'DEC'		=> 'DECIMAL',
			'DOUBLE'	=> 'DOUBLE PRECISION',
			'FIXED'		=> 'DECIMAL',
			'INT'		=> 'INTEGER',
			'NUMERIC'	=> 'DECIMAL',
			'REAL'		=> 'FLOAT'
		);

	/**
	 * Constant Tokens.
	 *
	 * @access private
	 */
	var $constant_tokens = array();

	/**
	 * Current Count of Constant Tokens stored.
	 *
	 * @access private
	 */
	var $tokens_count = 0;


	/**
	 * Class Constructor.
	 *
	 * @access public
	 * @param string Path to the includes directory for "friend" classes.
	 * @param string SQL_LAYER.
	 */
	function sql_parser($includes_path = '', $sql_layer = '')
	{
		global $phpbb_root_path;

		$this->includes_path = ( empty($includes_path) ? $phpbb_root_path . 'includes/sql/' : $includes_path );
		$this->sql_layer = ( empty($sql_layer) ? SQL_LAYER : $sql_layer );
	}

	/**
	 * Initialize private properties.
	 *
	 * @see method check_identifier
	 *
	 * @access private
	 * @return bool FALSE if any error was found.
	 */
	function initialize()
	{
		global $lang, $phpEx;

		// Initialize private properties
		$this->sql_total = 0;
		$this->sql_count = 0;
		$this->sql_input = array();
		$this->sql_output = array();
		$this->error_message = '';
		$this->warnings = array();
		$this->data_dictionary = array();
		$this->constant_tokens = array();
		$this->tokens_count = 0;

		// Build list(s) of reserved keywords
		$filename = $this->includes_path . "sql_reserved_keywords.$phpEx";
		if( !@file_exists($filename) )
		{
			$this->format_error(sprintf($lang['SQL_error_open_file'], $filename));
			return false;
		}
		require($filename);
		$this->reserved_keywords = array();
		$this->cached_keywords = array();
		$unique_keywords = array();
		foreach( $reserved_keywords as $list_key => $data )
		{
			$this->reserved_keywords[$list_key] = array(
				'reference'	=> $data['reference'],
				'keywords'	=> array()
			);
			$keywords_ary = preg_split("/\r?\n|\r/", $data['keywords']);
			$list_count = count($keywords_ary);
			for( $i = 0; $i < $list_count; $i++ )
			{
				$keyword = &$keywords_ary[$i];
				if( !isset($unique_keywords[$keyword]) )
				{
					$unique_keywords[$keyword] = true;
					$this->reserved_keywords[$list_key]['keywords'][] = $keyword;
				}
			}
		}
		unset($reserved_keywords, $unique_keywords, $data, $keywords_ary);

		// Load and instatiate specialized SQL builder
		if( !$this->get_builder_name($builder_name) )
		{
			$this->format_error(sprintf($lang['SQL_unknown_dbms'], $builder_name));
			return false;
		}
		$builder_classes = array(
			'base'	=> 'sql_builder',
			'real'	=> 'sql_builder_' . $builder_name
		);
		foreach( $builder_classes as $type => $class )
		{
			$filename = $this->includes_path . "$class.$phpEx";
			if( !@file_exists($filename) )
			{
				$this->format_error(sprintf($lang['SQL_error_open_file'], $filename));
				return false;
			}
			require_once($filename);
		}
		$this->sql_builder = new $builder_classes['real']($this);

		return true;
	}

	/**
	 * Get name of the SQL builder for the current DBMS.
	 *
	 * @access private
	 * @param string Used to return name of the SQL builder or $this->sql_layer if unknown or unsupported.
	 * @return bool FALSE if current DBMS is unknown or unsupported.
	 */
	function get_builder_name(&$builder_name)
	{
		if( preg_match('#mysql#i', $this->sql_layer) )
		{
			$builder_name = 'mysql';
			return true;
		}
		if( preg_match('#postgres#i', $this->sql_layer) )
		{
			$builder_name = 'postgresql';
			return true;
		}
		if( preg_match('#mssql#i', $this->sql_layer) )
		{
			$builder_name = 'mssql';
			return true;
		}
		$builder_name = $this->sql_layer;
		return false;
	}

	/**
	 * Format warning/error messages.
	 *
	 * @access private
	 * @param string The error message.
	 * @param integer Use to include the current statement number in the message.
	 * @param bool TRUE to show the current table name in the message.
	 * @param bool TRUE to translate table prefixes in the message.
	 * @return array Associative array with the following elements: message, stmt_number and table_name
	 */
	function format_message($message, $stmt_number = false, $show_table_name = false, $translate_prefix = true)
	{
		global $lang;

		// Cleanup possible table prefixes in the message itself
		if( $translate_prefix && $this->table_prefix != $this->phpbb_prefix )
		{
			$message = str_replace($this->table_prefix, $this->phpbb_prefix, $message);
		}
		else
		{
			$translate_prefix = false;
		}

		$result = array();

		// Append additional information?
		if( $stmt_number !== false )
		{
			$result['stmt_number'] = $stmt_number;
			$message .= sprintf($lang['SQL_in_statement'], $stmt_number);
		}
		if( $show_table_name )
		{
			$result['table_name'] = ( $translate_prefix ? str_replace($this->table_prefix, $this->phpbb_prefix, $this->sql_data['table_name']) : $this->sql_data['table_name'] );
			$message .= sprintf($lang['SQL_in_table_name'], $result['table_name']);
		}
		$result['message'] = $message;
		return $result;
	}
	function format_warning($message, $stmt_number = false, $show_table_name = false, $translate_prefix = true)
	{
		$this->warnings[] = $this->format_message($message, $stmt_number, $show_table_name, $translate_prefix);
	}
	function format_error($message, $stmt_number = false, $show_table_name = false, $translate_prefix = true)
	{
		$this->error_message = $this->format_message($message, $stmt_number, $show_table_name, $translate_prefix);
	}

	/**
	 * Read entire file into a string.
	 *
	 * @access private
	 * @param string File name.
	 * @return string|bool Contents of the file or FALSE if any error was found.
	 */
	function read_file($filename)
	{
		global $lang;

		if( function_exists('file_get_contents') )
		{
			// If available, it might be much faster than fread
			if( !($contents = @file_get_contents($filename)) )
			{
				$this->format_error(sprintf($lang['SQL_error_open_file'], $filename));
				return false;
			}
		}
		else
		{
			if( !($fp = @fopen($filename, 'r')) )
			{
				$this->format_error(sprintf($lang['SQL_error_open_file'], $filename));
				return false;
			}
			$contents = '';
			while( !@feof($fp) )
			{
				$contents .= @fread($fp, 8192);
			}
			@fclose($fp);
		}

		return $contents;
	}

	/**
	 * Check a SQL identifier (ie. table, index or column name).
	 *
	 * @see method initialize
	 *
	 * @param string Identifier to check
	 * @param string Key to the $lang array, used to format the error, if any.
	 * @param bool TRUE to show the current table name in the message.
	 * @param bool TRUE to translate table prefixes in the message.
	 * @return bool FALSE if any error was found.
	 */
	function check_identifier($identifier, $lang_error, $show_table_name, $translate_prefix = true)
	{
		global $lang;

		// Check identifier length
		if( strlen($identifier) > $this->max_identifier_length )
		{
			$this->format_error(sprintf($lang[$lang_error], $identifier), $this->sql_count+1, $show_table_name, false);
			return false;
		}

		// Check if name is composed of valid characters
		if( !preg_match("#^{$this->valid_identifier_chars}$#", $identifier) )
		{
			$this->format_error(sprintf($lang[$lang_error], $identifier), $this->sql_count+1, $show_table_name, $translate_prefix);
			return false;
		}

		// Check for reserved keywords (checked keywords are in memory catched)
		$ucase_identifier = strtoupper($identifier);
		if( !isset($this->cached_keywords[$ucase_identifier]) )
		{
			$this->cached_keywords[$ucase_identifier] = '';
			foreach( $this->reserved_keywords as $list_key => $data )
			{
				if( in_array($ucase_identifier, $data['keywords']) )
				{
					$this->cached_keywords[$ucase_identifier] = $list_key;
					break;
				}
			}
		}
		if( !empty($this->cached_keywords[$ucase_identifier]) )
		{
			$list_key = $this->cached_keywords[$ucase_identifier];
			$data = &$this->reserved_keywords[$list_key];
			$message = sprintf($lang['SQL_reserved_keyword'], $identifier, '<a href="' . $data['reference'] . '" target="_blank">' . str_replace('_', ' ', $list_key) . '</a>');
			$this->format_warning($message, $this->sql_count+1, $show_table_name, $translate_prefix);
		}

		return true;
	}

	/**
	 * Generate a safe SQL identifier.
	 *
	 * This method may remove chars until it gets an identifier that is no longer than max length.
	 * To shorten the string, it first removes lastest underscores, then removes trailing chars.
	 * If possible it will not remove the first underscore, it might be part of the table prefix.
	 *
	 * @access public
	 * @param string Indentifier.
	 * @param string Suffix to append to identifier.
	 * @return string New identifier
	 */
	function get_identifier($identifier, $suffix = '')
	{
		$max_length = $this->max_identifier_length - strlen($suffix);
		while( strlen($identifier) > $max_length )
		{
			if( ($i = strpos($identifier, '_')) === false || ($j = strrpos($identifier, '_')) === false || $i == $j )
			{
				break;
			}
			$identifier = substr($identifier, 0, $j) . substr($identifier, $j+1);
		}
		while( strlen($identifier) > $max_length )
		{
			$identifier = substr($identifier, 0, -1);
		}
		return $identifier . $suffix;
	}

	/**
	 * Check data dictionary for possible inconsistencies in DB design.
	 *
	 * - @see method parse_column_definition
	 * - @see method parse_stream
	 *
	 * @access private
	 */
	function check_data_dictionary()
	{
		global $lang;

		foreach( $this->data_dictionary as $column_name => $datatypes )
		{
			$datatypes_count = count($datatypes);
			$table_count = 0;
			if( $datatypes_count > 1 )
			{
				$datatype_items = array();
				foreach( $datatypes as $datatype => $table_names )
				{
					$table_count += count($table_names);
					$table_names = implode(', ', $table_names);
					$datatype_items[] = sprintf($lang['SQL_warn_column_type_tb'], $datatype, $table_names);
				}
				$datatype_items = implode('; ', $datatype_items);
				$message = sprintf($lang['SQL_warn_column_type'], $column_name, $datatypes_count, $table_count, $datatype_items) . '.';
				$this->format_warning($message);
			}
		}
		unset($this->data_dictionary);
	}

	/**
	 * Parse List of Index Keys.
	 *
	 * Expected format is:
	 * - index_key_definition[,...]
	 *
	 * index_key_definition format is:
	 * - column_name[(length[,...])] [ASC|DESC]
	 *
	 * Note (length) is only accepted if the $key_length_allowed argument is true.
	 * Within this context we can't check its correctness, though.
	 *
	 * This method returns information in the following format:
	 *
	 *		array(				// An array where each element contains information for a single index key.
	 *			array(			// An associative array where each element is an attribute.
	 *				'name'		// string Column Name.
	 *				'length'	// integer Prefix Length for Index (0 if not specified).
	 *				'order'		// string Key Order as DESC or ASC (default).
	 *			),
	 *		);
	 *
	 * @access private
	 * @param string List of index keys.
	 * @param bool TRUE if key lengths are allowed.
	 * @return array An element for each key.
	 */
	function parse_index_keys($index_attributes, $key_length_allowed)
	{
		global $lang;

		$index_attributes = $this->split_elements_list($index_attributes);
		$index_keys = array();

		for( $i = 0; $i < count($index_attributes); $i++ )
		{
			$key_items = explode(' ', $index_attributes[$i]);
			$key_items_count = count($key_items);
			if( $key_items_count > 2 )
			{
				$this->format_error(sprintf($lang['SQL_invalid_index'], $this->column_definition), $this->sql_count+1, true);
				return false;
			}
			if( $key_items_count == 2 )
			{
				$key_items[1] = strtoupper($key_items[1]);
				if( !in_array($key_items[1], array('ASC','DESC')) )
				{
					$this->format_error(sprintf($lang['SQL_invalid_index'], $this->column_definition), $this->sql_count+1, true);
					return false;
				}
			}
			else
			{
				$key_items[1] = 'ASC';
			}

			$key_data = array('name' => $key_items[0], 'length' => false, 'order' => $key_items[1]);

			if( $key_length_allowed && strlen($key_data['name']) > 2 && ($pos = strpos($key_data['name'], '(')) !== false && $key_data['name']{strlen($key_data['name'])-1} == ')' )
			{
				$key_parts = explode('(', str_replace(')', '(', $key_data['name']));
				if( !is_numeric($key_parts[1]) )
				{
					$this->format_error(sprintf($lang['SQL_invalid_key_length'], $this->column_definition), $this->sql_count+1, true);
					return false;
				}
				$key_parts[1] = intval($key_parts[1]);
				if( $key_parts[1] > 0 )
				{
					$key_data['name'] = $key_parts[0];
					$key_data['length'] = $key_parts[1];
				}
			}

			if( !$this->check_identifier($key_data['name'], 'SQL_invalid_column_name', true) )
			{
				return false;
			}
			$index_keys[] = $key_data;
		}
		return $index_keys;
	}

	/**
	 * Parse Table Column or Index Definitions.
	 *
	 * Expected formats are:
	 * - PRIMARY KEY (index_key_definition[,...])
	 * - {KEY|INDEX} [index_name] (index_key_definition[,...])
	 * - UNIQUE [INDEX] [index_name] (index_key_definition[,...])
	 * - column_name data_type [attribute [ ...]]
	 *
	 * index_key_definition format is:
	 * - @see method parse_index_keys
	 *
	 * Note: CONSTRAINT, FOREIGN and other attributes are not supported.
	 * Note: FULLTEXT|SPATIAL indexes are not supported either, for now.
	 *
	 * This method fills the $this->sql_data associative array with the following information:
	 *
	 * - For Primary Keys:
	 *		$sql_data['primary_keys']			// Index Keys information as returned by the parse_index_keys method.
	 *
	 * - For Indexes:
	 *		$sql_data['indexes'] = array(		// An associative array where each element contains information for a single index.
	 *			[$index_name] = array(			// For each index (note the array key is the Index Name):
	 *				'name'						// string Index Name.
	 *				'unique'					// bool TRUE if this is an Unique Index.
	 *				'keys'						// Index Keys information as returned by the parse_index_keys method.
	 *			),
	 *		);
	 *
	 * - For Column Definitions:
	 *		$sql_data['columns'] = array(		// An associative array where each element contains information for a single column.
	 *			[$column_name] = array(			// For each column (note the array key is the Column Name):
	 *				'name'						// string Column Name (required)
	 *				'datatype'					// string Data Type, may contain (length[,decimals]) (required)
	 *				'datatype_name'				// string Only the Data Type itself here (@see property $valid_datatypes)
	 *				'datatype_argc'				// integer Number of elements used to specify (length[,decimals])
	 *				'datatype_argv'				// array Each element used to specify (length[,decimals])
	 *				'constant_type'				// string A single character indicator of the constant type (@see property $valid_datatypes)
	 *				'unsigned'					// bool and TRUE if specified (optional, for numeric types only)
	 *				'zerofill'					// bool and TRUE if specified (optional, for numeric types only)
	 *				'binary'					// bool and TRUE if specified (optional, for char and varchar only)
	 *				'null'						// string '', 'NULL' or 'NOT NULL' (optional, not null is required for primary keys)
	 *				'default'					// string filled only if specified (optional)
	 *				'auto_increment'			// bool and TRUE if specified (optional, if used column must be indexed)
	 *			),
	 *		);
	 *
	 * @access private
	 * @return bool FALSE if any error was found.
	 */
	function parse_column_definition()
	{
		global $lang;

		// Make sure arrays exist
		if( !isset($this->sql_data['primary_keys']) )
		{
			$this->sql_data['primary_keys'] = array();
		}
		if( !isset($this->sql_data['indexes']) )
		{
			$this->sql_data['indexes'] = array();
		}
		if( !isset($this->sql_data['columns']) )
		{
			$this->sql_data['columns'] = array();
		}

		// Check if this is an index definition
		if( preg_match('#^(PRIMARY KEY|KEY|UNIQUE INDEX|INDEX|UNIQUE)[^\w]#i', $this->column_definition, $match) )
		{
			// Extract index information
			if( !preg_match('#^(('.$match[1].')[^(]*)\((.*)\)$#i', $this->column_definition, $match) )
			{
				$this->format_error(sprintf($lang['SQL_invalid_index'], $this->column_definition), $this->sql_count+1, true);
				return false;
			}
			$index_name = trim(str_replace($match[2], '', $match[1]));
			$index_type = ( stristr($match[2], 'PRIMARY') ? 'P' : ( stristr($match[2], 'UNIQUE') ? 'U' : 'I' ) );
			$index_attributes = trim($match[3]);

			// There should be, at least, one index key definition
			if( empty($index_attributes) )
			{
				$this->format_error(sprintf($lang['SQL_missing_keys'], $this->column_definition), $this->sql_count+1, true);
				return false;
			}

			// Check/obtain index keys
			if( !($index_keys = $this->parse_index_keys($index_attributes, ($index_type != 'P' ? true : false))) )
			{
				return false;
			}

			// Process for Primary Keys
			if( $index_type == 'P' )
			{
				// Index name is not allowed for primary keys
				if( !empty($index_name) )
				{
					$this->format_error(sprintf($lang['SQL_invalid_primary'], $this->column_definition), $this->sql_count+1, true);
					return false;
				}

				// Only one primary key, please
				if( count($this->sql_data['primary_keys']) > 0 )
				{
					$this->format_error(sprintf($lang['SQL_already_primary'], $this->column_definition), $this->sql_count+1, true);
					return false;
				}

				// Save primary key data for later processing and quit.
				$this->sql_data['primary_keys'] = $index_keys;
				return true;
			}

			// Process for Indexes, first make sure we have an index name
			if( empty($index_name) )
			{
				// If they don't care, let us try to give them one, the DBMS will do anyway.
				// Up to 9 attempts to derive an index name only, though :P
				for( $i = 1; $i < 10; $i++ )
				{
					$index_name = $this->get_identifier($index_keys[0]['name'], '_x' . $i);
					if( !isset($this->sql_data['indexes'][$index_name]) )
					{
						break;
					}
				}
			}

			// Index names should be unique! =:-o
			if( isset($this->sql_data['indexes'][$index_name]) )
			{
				$this->format_error(sprintf($lang['SQL_invalid_index'], $this->column_definition), $this->sql_count+1, true);
				return false;
			}

			// Check for correctness of index name
			if( !$this->check_identifier($index_name, 'SQL_invalid_index_name', true) )
			{
				return false;
			}

			// Save index data for later processing and quit.
			$this->sql_data['indexes'][$index_name] = array(
				'name'		=> $index_name,
				'unique'	=> ( $index_type == 'U' ? true : false ),
				'keys'		=> $index_keys
			);
			return true;
		}

		//
		// Oh! we have (or we should) a column definition here, let's see. hmm...
		//

		// Sometimes, small changes make life easier
		$column_attributes = preg_replace('#NOT NULL#i', 'NOT_NULL', $this->column_definition);
		$column_attributes = preg_replace('#DOUBLE PRECISION#i', 'DOUBLE', $column_attributes);

		// Transform column definition into an array of words! ...where
		// each word is a single column attribute, except DEFAULT value
		$column_attributes = explode(' ', $column_attributes);

		if( count($column_attributes) < 2 )
		{
			$this->format_error(sprintf($lang['SQL_unknown_datatype'], '?'), $this->sql_count+1, true);
			return false;
		}

		// Obtain/check column name
		$column_name = array_shift($column_attributes);
		if( !$this->check_identifier($column_name, 'SQL_invalid_column_name', true) )
		{
			return false;
		}
		if( isset($this->sql_data['columns'][$column_name]) )
		{
			$this->format_error(sprintf($lang['SQL_already_column'], $column_name), $this->sql_count+1, true);
			return false;
		}

		// string to upper the rest of attributes to make it easier/faster to digest
		$column_attributes = array_map('strtoupper', $column_attributes);

		// Save column name and data type, both must be the first attributes of column definition!
		$column_data = array('name' => $column_name, 'datatype' => array_shift($column_attributes));

		// Parse default value (apart from NOT NULL and DOUBLE PRECISION "fixed" before, it is the only one that needs 2 words)
		if( ($i = array_search('DEFAULT', $column_attributes)) !== false )
		{
			if( !isset($column_attributes[$i+1]) )
			{
				$this->format_error(sprintf($lang['SQL_missing_default'], $this->column_definition), $this->sql_count+1, true);
				return false;
			}
			// If necessary, replace token with saved string constant
			$column_data['default'] = $this->restore_sql_constant($column_attributes[$i+1]);
			unset($column_attributes[$i+1], $column_attributes[$i]);
		}

		// Parse column attributes
		$attribute_words = array('AUTO_INCREMENT', 'BINARY', 'NOT_NULL', 'NULL', 'UNSIGNED', 'ZEROFILL');
		for( $i = 0; $i < count($attribute_words); $i++ )
		{
			$attribute = &$attribute_words[$i];
			if( ($j = array_search($attribute, $column_attributes)) !== false )
			{
				if( $attribute == 'NULL' || $attribute == 'NOT_NULL' )
				{
					if( isset($column_data['null']) )
					{
						$this->format_error(sprintf($lang['SQL_unknown_attribute'], 'NULL', $this->column_definition), $this->sql_count+1, true);
						return false;
					}
					$column_data['null'] = str_replace('_', ' ', $attribute);
				}
				else
				{
					$column_data[strtolower($attribute)] = true;
				}
				unset($column_attributes[$j]);
			}
		}

		// Check for illegal use of NULL for a NOT NULL column
		if( isset($column_data['null']) && $column_data['null'] == 'NOT NULL' && isset($column_data['default']) && $column_data['default'] == 'NULL' )
		{
			$this->format_error(sprintf($lang['SQL_illegal_null'], $this->column_definition), $this->sql_count+1, true);
			return false;
		}

		// Anything else is unsupported or, err, unknown?
		if( count($column_attributes) > 0 )
		{
			$this->format_error(sprintf($lang['SQL_unknown_attribute'], implode(' ', $column_attributes), $this->column_definition), $this->sql_count+1, true);
			return false;
		}

		// Trying to understand the datatype...
		$datatype_argv = explode('(', str_replace(',', '(', rtrim($column_data['datatype'], ')')));
		$datatype_name = array_shift($datatype_argv);
		$datatype_argc = count($datatype_argv);
		$datatype_error = '';

		// Deal with data type aliases
		if( isset($this->datatype_aliases[$datatype_name]) )
		{
			$datatype_name = $this->datatype_aliases[$datatype_name];
			$column_data['datatype'] = $datatype_name . ( $datatype_argc > 0 ? '(' . implode(',', $datatype_argv) . ')' : '' );
		}

		if( in_array($datatype_name, $this->invalid_datatypes) )
		{
			$datatype_error = sprintf($lang['SQL_nosupport_datatype'], $column_data['datatype']);
		}
		elseif( !isset($this->valid_datatypes[$datatype_name]) )
		{
			$datatype_error = sprintf($lang['SQL_unknown_datatype'], $column_data['datatype']);
		}
		elseif( isset($column_data['auto_increment']) && !$this->valid_datatypes[$datatype_name]['A'] )
		{
			$datatype_error = sprintf($lang['SQL_illegal_attribute'], 'AUTO_INCREMENT');
		}
		elseif( isset($column_data['auto_increment']) && isset($column_data['default']) )
		{
			$datatype_error = sprintf($lang['SQL_illegal_attribute'], 'AUTO_INCREMENT + DEFAULT');
		}
		elseif( isset($column_data['binary']) && !$this->valid_datatypes[$datatype_name]['B'] )
		{
			$datatype_error = sprintf($lang['SQL_illegal_attribute'], 'BINARY');
		}
		elseif( isset($column_data['unsigned']) && !$this->valid_datatypes[$datatype_name]['U'] )
		{
			$datatype_error = sprintf($lang['SQL_illegal_attribute'], 'UNSIGNED');
		}
		elseif( isset($column_data['zerofill']) && !$this->valid_datatypes[$datatype_name]['Z'] )
		{
			$datatype_error = sprintf($lang['SQL_illegal_attribute'], 'ZEROFILL');
		}
		elseif( $datatype_argc > $this->valid_datatypes[$datatype_name]['L'][0] )
		{
			$datatype_error = sprintf($lang['SQL_illegal_attriblen'], $column_data['datatype']);
		}
		else
		{
			for( $i = 0; $i < $datatype_argc; $i++ )
			{
				if( !is_numeric($datatype_argv[$i]) )
				{
					$datatype_error = sprintf($lang['SQL_illegal_attriblen'], $column_data['datatype']);
					break;
				}
			}
		}

		if( !empty($datatype_error) )
		{
			$this->format_error($datatype_error, $this->sql_count+1, true);
			return false;
		}

		// Some people tend to use string constants for numeric types, but that may lead to problems on
		// some non-MySQL servers, we here try to fix "wrong" default values for numeric types.
		if( isset($column_data['default']) && preg_match('#[\'"]#', $column_data['default']) && strstr('IFD', $this->valid_datatypes[$datatype_name]['C']) )
		{
			$column_data['default'] = trim(substr($column_data['default'], 1, -1));
			if( strlen($column_data['default']) <= 0 )
			{
				$context = $column_name . ' ... DEFAULT ?';
				$this->format_warning(sprintf($lang['SQL_warn_empty_number'], $context), $this->sql_count+1, true);
				$column_data['default'] = 0;
			}
		}

		// Check/normalize values used in default clausule -vs- specified data type
		if( isset($column_data['default']) && $column_data['default'] != 'NULL' )
		{
			$default_before = $column_data['default'];

			switch( $this->valid_datatypes[$datatype_name]['C'] )
			{
				case 'B':	// Check/normalize boolean constants
					// Make sure booleans are stored as 1 or 0
					if( preg_match('#^(true|false)$#i', $column_data['default']) )
					{
						$column_data['default'] = ( strtolower($column_data['default']) == 'true' ? 1 : 0 );
					}
					elseif( $column_data['default'] !== 0 )
					{
						$column_data['default'] = 1;
					}
					break;

				case 'I':	// Check/normalize Integer constants
					if( $datatype_name == 'BIGINT' || ( $datatype_name == 'INTEGER' && isset($column_data['unsigned']) ) )
					{
						// Get the big integer as a string, trying to ensure it is correctly handled by PHP
						$column_data['default'] = preg_replace('#^([^\.]*).*$#', '$1', (float)$column_data['default']);
					}
					else
					{
						$column_data['default'] = (int)$column_data['default'];
					}
					break;

				case 'D':	// Check/normalize Decimal constants
					if( !preg_match('#^[\+\-]{0,1}(([0-9]+\.[0-9]*)|([0-9]*\.[0-9]+)|([0-9]+))$#', $column_data['default']) )
					{
						$column_data['default'] = (float)$column_data['default'];
					}
					break;

				case 'F':	// Check/normalize Float/Double constants
					$column_data['default'] = (float)$column_data['default'];
					break;

				case 'C':	// Check/normalize Character constants
				case 'Y':	// Check/normalize binarY constants
					// If string constant is double quoted
					if( $column_data['default']{0} == '"' )
					{
						// convert into a single quoted string constant
						$column_data['default'] = "'" . preg_replace('#([\\\\"]"|\')#', '\'\'', substr($column_data['default'], 1, -1)) . "'";
					}
					break;
			}
			if( (string)$default_before != (string)$column_data['default'] )
			{
				$context = $column_name . ' ... DEFAULT ' . $default_before;
				$this->format_warning(sprintf($lang['SQL_warn_bad_constant'], $column_data['default'], $context), $this->sql_count+1, true);
			}
		}

		// Check consistency of display widths specified for integers
		if( $datatype_argc > 0 && $this->valid_datatypes[$datatype_name]['L'][1] > 0 )
		{
			if( !isset($column_data['unsigned']) && $datatype_argv[0] > $this->valid_datatypes[$datatype_name]['L'][1] ||
				isset($column_data['unsigned']) && $datatype_argv[0] > $this->valid_datatypes[$datatype_name]['L'][2] )
			{
				$message = sprintf($lang['SQL_warn_display_width'], $column_data['datatype'] . (isset($column_data['unsigned'])?' UNSIGNED':''), $column_name);
				$this->format_warning($message, $this->sql_count+1, true);
			}
		}

		// Check for MySQL extensions
		if( isset($column_data['zerofill']) )
		{
			$this->format_warning(sprintf($lang['SQL_warn_mysql_ext'], 'ZEROFILL', $column_name), $this->sql_count+1, true);
			if( !isset($column_data['unsigned']) )
			{
				// This is done by MySQL anyway, we activate the UNSIGNED flag here
				// to help builder to be a bit more consistent.
				$column_data['unsigned'] = true;
			}
		}

		// Save column name and type in data dictionary.
		if( !isset($this->data_dictionary[$column_name]) )
		{
			$this->data_dictionary[$column_name] = array();
		}
		if( !isset($this->data_dictionary[$column_name][$column_data['datatype']]) )
		{
			$this->data_dictionary[$column_name][$column_data['datatype']] = array();
		}
		$this->data_dictionary[$column_name][$column_data['datatype']][] = $this->sql_data['table_name'];

		// We got it here, fwiw, save extra datatype information
		$column_data['datatype_name'] = $datatype_name;
		$column_data['datatype_argc'] = $datatype_argc;
		$column_data['datatype_argv'] = $datatype_argv;
		$column_data['constant_type'] = $this->valid_datatypes[$datatype_name]['C'];

		// Hopefully good enough! Save all attributes for later processing and quit.
		$this->sql_data['columns'][$column_name] = $column_data;
		return true;
	}

	/**
	 * Parse CREATE TABLE statement
	 *
	 * References:
	 * http://dev.mysql.com/doc/mysql/en/create-table.html
	 *
	 * Expected format is:
	 * - CREATE TABLE table_name [IF NOT EXISTS] (column_name column_definition[,...])
	 *
	 * - IF NOT EXISTS is considered non-portable, though.
	 *
	 * column_definition format is:
	 * - @see method parse_column_definition
	 *
	 * We do not even attempt to parse anything beyond the closing block of column definitions.
	 * That means no support for subqueries and anything like that. Maybe in the future.
	 *
	 * This method fills the $this->sql_data associative array with the following information:
	 *
	 *	array(
	 *		'table_name'				// string
	 *		'primary_keys'				// @see method parse_column_definition
	 *		'indexes'					// @see method parse_column_definition
	 *		'columns'					// @see method parse_column_definition
	 *	);
	 *
	 * @access private
	 * @param string SQL statement.
	 * @return bool FALSE if any error was found.
	 */
	function parse_create_table(&$sql_statement)
	{
		global $lang;

		// Obtain the table name and check its correctness
		$this->sql_data['table_name'] = preg_replace('#^CREATE TABLE (\w+).*#i', '$1', $sql_statement);
		if( !$this->check_identifier($this->sql_data['table_name'], 'SQL_invalid_table_name', false) )
		{
			return false;
		}

		// Check presence of and extract column definitions list into a string (and other attributes, if any)
		if( !preg_match('#^CREATE TABLE '.$this->sql_data['table_name'].'( (\w+ \w+ \w+)){0,1}\((.*)\)( (.+)){0,1}$#i', $sql_statement, $match) || empty($match[3]) )
		{
			$this->format_error(sprintf($lang['SQL_unexpected_syntax'], 'CREATE TABLE'), $this->sql_count+1, true);
			return false;
		}

		// Check for unsupported syntax options
		if( !empty($match[2]) )
		{
			if( $match[2] != 'IF NOT EXISTS' )
			{
				$this->format_error(sprintf($lang['SQL_unexpected_syntax'], $match[2]), $this->sql_count+1, true);
				return false;
			}
			$this->format_warning(sprintf($lang['SQL_nonportable_option'], $match[2]), $this->sql_count+1, true);
		}
		if( !empty($match[5]) )
		{
			$this->format_warning(sprintf($lang['SQL_nonportable_option'], $match[5]), $this->sql_count+1, true);
		}

		// Split into an array of elements for each single column definition.
		$column_definitions = $this->split_elements_list($match[3]);

		// Time to parse each column definition.
		for( $i = 0; $i < count($column_definitions); $i++ )
		{
			// Make current column definition easilly available to all methods
			$this->column_definition = &$column_definitions[$i];

			if( !$this->parse_column_definition() )
			{
				return false;
			}
		}

		//
		// Verify consistency of primary keys and indexes -vs- columns...
		//

		// Primary keys should exist as columns and have the not null attribute
		for( $i = 0; $i < count($this->sql_data['primary_keys']); $i++ )
		{
			$key_data = &$this->sql_data['primary_keys'][$i];
			if( !isset($this->sql_data['columns'][$key_data['name']]) )
			{
				$this->format_error(sprintf($lang['SQL_unknown_primary'], $key_data['name']), $this->sql_count+1, true);
				return false;
			}
			if( $this->sql_data['columns'][$key_data['name']]['null'] != 'NOT NULL' )
			{
				$this->format_error(sprintf($lang['SQL_notnull_primary'], $key_data['name']), $this->sql_count+1, true);
				return false;
			}
			// Mark column as being primary key
			$this->sql_data['columns'][$key_data['name']]['primary_key'] = true;
		}

		// Index keys should exist as columns, also checking index length consistency.
		foreach( $this->sql_data['indexes'] as $index_name => $index_data )
		{
			for( $i = 0; $i < count($index_data['keys']); $i++ )
			{
				$key_data = &$index_data['keys'][$i];
				if( !isset($this->sql_data['columns'][$key_data['name']]) )
				{
					$this->format_error(sprintf($lang['SQL_unknown_key'], $key_data['name']), $this->sql_count+1, true);
					return false;
				}
				$datatype_name = $this->sql_data['columns'][$key_data['name']]['datatype_name'];
				if( $this->valid_datatypes[$datatype_name]['K'] == 0 && $key_data['length'] > 0 )
				{
					$this->format_error(sprintf($lang['SQL_invalid_key_length'], $key_data['name'].'('.$key_data['length'].')'), $this->sql_count+1, true);
					return false;
				}
				if( $this->valid_datatypes[$datatype_name]['K'] == 2 && $key_data['length'] == 0 )
				{
					$this->format_error(sprintf($lang['SQL_missing_key_length'], $key_data['name'], strtoupper($datatype_name)), $this->sql_count+1, true);
					return false;
				}
				// Mark column as being indexed
				$this->sql_data['columns'][$key_data['name']]['indexed'] = true;
			}
		}

		// Auto_increment columns must be indexed
		foreach( $this->sql_data['columns'] as $column_data )
		{
			if( isset($column_data['auto_increment']) && !isset($column_data['indexed']) && !isset($column_data['primary_key']) )
			{
				$this->format_error(sprintf($lang['SQL_autoinc_noindex'], $column_data['name']), $this->sql_count+1, true);
				return false;
			}
		}

		return true;
	}

	/**
	 * Parse ALTER TABLE statement
	 *
	 * References:
	 * http://dev.mysql.com/doc/mysql/en/alter-table.html
	 *
	 * Expected formats are:
	 * - ALTER TABLE table_name ADD PRIMARY KEY (index_key_definition[,...])
	 * - ALTER TABLE table_name ADD {INDEX|UNIQUE} [index_name] (index_key_definition[,...])
	 * - ALTER TABLE table_name ADD [COLUMN] column_definition
	 * - ALTER TABLE table_name ALTER [COLUMN] column_name {SET DEFAULT constant|DROP DEFAULT}
	 * - ALTER TABLE table_name CHANGE [COLUMN] old_col_name column_definition
	 * - ALTER TABLE table_name MODIFY [COLUMN] column_definition
	 * - ALTER TABLE table_name DROP [COLUMN] column_name
	 * - ALTER TABLE table_name DROP PRIMARY KEY
	 * - ALTER TABLE table_name DROP INDEX index_name
	 *
	 * index_key_definition format is:
	 * - @see method parse_index_keys
	 *
	 * column_definition format is:
	 * - @see method parse_column_definition
	 *
	 * This method fills the $this->sql_data associative array with the following information:
	 *
	 *	array(
	 *		'table_name'				// string
	 *		'action'					// string ADD, ALTER, CHANGE, MODIFY or DROP
	 *
	 *		Only for ADD actions, one of the following:
	 *		'primary_keys'				// @see method parse_column_definition
	 *		'indexes'					// @see method parse_column_definition
	 *		'columns'					// @see method parse_column_definition
	 *
	 *		Only for ALTER actions:
	 *		'column'					// string column_name
	 *		'subaction'					// string 'set_default' or 'drop_default'
	 *		'default'					// string Only filled for SET subaction
	 *
	 *		Only for CHANGE actions:
	 *		'old_column'				// string column_name
	 *		'columns'					// @see method parse_column_definition
	 *
	 *		Only for MODIFY actions:
	 *		'columns'					// @see method parse_column_definition
	 *
	 *		Only for DROP actions, one of the following:
	 *		'primary_key'				// bool and true
	 *		'index'						// string index_name
	 *		'column'					// string column_name
	 *	);
	 *
	 * @access private
	 * @param string SQL statement.
	 * @return bool FALSE if any error was found.
	 */
	function parse_alter_table(&$sql_statement)
	{
		global $lang;

		// Obtain the table name and check its correctness
		$this->sql_data['table_name'] = preg_replace('#^ALTER TABLE (\w+).*#i', '$1', $sql_statement);
		if( !$this->check_identifier($this->sql_data['table_name'], 'SQL_invalid_table_name', false) )
		{
			return false;
		}

		// Strip out 'ALTER TABLE table_name' and try to match action and remainder
		if( !preg_match('#^ALTER TABLE '.$this->sql_data['table_name'].' (\w+) (.*)#i', $sql_statement, $match) )
		{
			$this->format_error(sprintf($lang['SQL_unexpected_syntax'], 'ALTER TABLE'), $this->sql_count+1, true);
			return false;
		}
		$alter_statement = $match[2];

		// Obtain and validate action
		$this->sql_data['action'] = strtoupper($match[1]);
		if( !in_array($this->sql_data['action'], array('ADD','ALTER','CHANGE','MODIFY','DROP')) )
		{
			$this->format_error(sprintf($lang['SQL_unknown_command'], $this->sql_data['action']), $this->sql_count+1, true);
			return false;
		}

		if( $this->sql_data['action'] == 'ADD' )
		{
			if( !preg_match('#^(PRIMARY KEY|INDEX|UNIQUE|(COLUMN|\w+))[^\w]#i', $alter_statement, $match) )
			{
				$this->format_error(sprintf($lang['SQL_unexpected_syntax'], $alter_statement), $this->sql_count+1, true);
				return false;
			}
			if( isset($match[2]) && strtoupper($match[2]) == 'COLUMN' )
			{
				$alter_statement = substr($alter_statement, strlen($match[0]));
			}

			// Make current column definition easilly available to all methods
			$this->column_definition = &$alter_statement;

			// Parse the column or index definition following CREATE TABLE syntax
			if( !$this->parse_column_definition() )
			{
				return false;
			}
			return true;
		}

		if( $this->sql_data['action'] == 'ALTER' )
		{
			if( !preg_match('#(COLUMN ){0,1}(\w+) ((SET|DROP) DEFAULT)( (\w+)){0,1}#i', $alter_statement, $match) )
			{
				$this->format_error(sprintf($lang['SQL_unexpected_syntax'], $alter_statement), $this->sql_count+1, true);
				return false;
			}
			if( !$this->check_identifier($match[2], 'SQL_invalid_column_name', true) )
			{
				return false;
			}
			$this->sql_data['column'] = $match[2];
			$this->sql_data['subaction'] = strtolower($match[4]) . '_default';
			if( $match[4] == 'SET' )
			{
				// If necessary, replace token with saved string constant
				$this->sql_data['default'] = $this->restore_sql_constant($match[6]);
			}
			return true;
		}

		if( $this->sql_data['action'] == 'CHANGE' )
		{
			if( !preg_match('#(COLUMN ){0,1}(\w+) (.+)#i', $alter_statement, $match) )
			{
				$this->format_error(sprintf($lang['SQL_unexpected_syntax'], $alter_statement), $this->sql_count+1, true);
				return false;
			}
			if( !$this->check_identifier($match[2], 'SQL_invalid_column_name', true) )
			{
				return false;
			}
			$this->sql_data['old_column'] = $match[2];
			$this->column_definition = &$match[3];
			if( !$this->parse_column_definition() )
			{
				return false;
			}
			return true;
		}

		if( $this->sql_data['action'] == 'MODIFY' )
		{
			if( !preg_match('#(COLUMN ){0,1}(.+)#i', $alter_statement, $match) )
			{
				$this->format_error(sprintf($lang['SQL_unexpected_syntax'], $alter_statement), $this->sql_count+1, true);
				return false;
			}
			$this->column_definition = &$match[2];
			if( !$this->parse_column_definition() )
			{
				return false;
			}
			return true;
		}

		// Process for DROP action
		if( preg_match('#PRIMARY KEY#i', $alter_statement) )
		{
			$this->sql_data['primary_key'] = true;
		}
		elseif( preg_match('#INDEX (\w+)#i', $alter_statement, $match) )
		{
			if( !$this->check_identifier($match[1], 'SQL_invalid_index_name', true) )
			{
				return false;
			}
			$this->sql_data['index'] = $match[1];
		}
		elseif( preg_match('#(COLUMN ){0,1}(\w+)#i', $alter_statement, $match) )
		{
			if( !$this->check_identifier($match[2], 'SQL_invalid_column_name', true) )
			{
				return false;
			}
			$this->sql_data['column'] = $match[2];
		}
		else
		{
			$this->format_error(sprintf($lang['SQL_unexpected_syntax'], $alter_statement), $this->sql_count+1, true);
			return false;
		}
		return true;
	}

	/**
	 * Parse DROP TABLE statement
	 *
	 * References:
	 * http://dev.mysql.com/doc/mysql/en/drop-table.html
	 *
	 * Expected format is:
	 * - DROP TABLE [IF EXISTS] table_name [RESTRICT|CASCADE]
	 *
	 * - IF EXISTS, RESTRICT and CASCADE are considered non-portable, though.
	 *
	 * This method fills the $this->sql_data associative array with the following information:
	 *
	 *	array(
	 *		'table_name'				// string
	 *	);
	 *
	 * @access private
	 * @param string SQL statement.
	 * @return bool FALSE if any error was found.
	 */
	function parse_drop_table(&$sql_statement)
	{
		global $lang;

		// Obtain the table name and check its correctness
		if( !preg_match('#^DROP TABLE ((\w+ \w+) ){0,1}(\w+)( (.+)){0,1}$#i', $sql_statement, $match) )
		{
			$this->format_error(sprintf($lang['SQL_unexpected_syntax'], 'DROP TABLE'), $this->sql_count+1);
			return false;
		}
		$this->sql_data['table_name'] = $match[3];
		if( !$this->check_identifier($this->sql_data['table_name'], 'SQL_invalid_table_name', false) )
		{
			return false;
		}

		// Check for unsupported syntax options
		if( !empty($match[2]) )
		{
			if( $match[2] != 'IF EXISTS' )
			{
				$this->format_error(sprintf($lang['SQL_unexpected_syntax'], $match[2]), $this->sql_count+1, true);
				return false;
			}
			$this->format_warning(sprintf($lang['SQL_nonportable_option'], $match[2]), $this->sql_count+1, true);
		}
		if( !empty($match[5]) )
		{
			if( !in_array($match[5], array('RESTRICT','CASCADE')) )
			{
				$this->format_error(sprintf($lang['SQL_unexpected_syntax'], $match[5]), $this->sql_count+1, true);
				return false;
			}
			$this->format_warning(sprintf($lang['SQL_nonportable_option'], $match[5]), $this->sql_count+1, true);
		}

		return true;
	}

	/**
	 * Parse a single SQL statement.
	 *
	 * This method initializes $this->sql_data as an associative array, for each SQL statement.
	 * Delegates parsing statements to proper methods and the build process to external classes.
	 *
	 * @access private
	 * @param string SQL statement.
	 * @return bool FALSE if any error was found.
	 */
	function parse_statement(&$sql_statement)
	{
		global $lang;

		// Obtain first two words of the statement
		$command = explode(' ', $sql_statement);
		if( count($command) < 3 )
		{
			$command = ( empty($command[0]) ? ';' : implode(' ', $command) );
			$this->format_error(sprintf($lang['SQL_unknown_command'], $command), $this->sql_count+1);
			return false;
		}
		$subcommand = strtoupper($command[1]);
		$command = strtoupper($command[0]);

		// Check for allowed DML statements in MODs.
		if( in_array($command, array('INSERT','UPDATE','DELETE')) )
		{
			// Save the statement as-is (if necessary, replace tokens with saved string constants)
			// No other validation takes place here, everything related to these kind of
			// statements is left for the DBAL itself.
			$this->sql_output[] = $this->restore_all_constants($sql_statement);
			return true;
		}

		// Check for supported DDL statements in MODs.
		if( !in_array($command, array('CREATE','DROP','ALTER')) )
		{
			$this->format_error(sprintf($lang['SQL_unknown_command'], $command), $this->sql_count+1);
			return false;
		}
		if( $subcommand != 'TABLE' )
		{
			$this->format_error(sprintf($lang['SQL_unknown_command'], $command.' '.$subcommand), $this->sql_count+1);
			return false;
		}

		// Invoke the proper parser
		$method_name = strtolower($command) . '_' . strtolower($subcommand);
		$parser = 'parse_' . $method_name;
		if( ($parser_result = $this->$parser($sql_statement)) !== false )
		{
			// Invoke the proper builder
			$this->sql_builder->$method_name($this->sql_data, $this->sql_output);
		}
		unset($this->sql_data);

		return $parser_result;
	}

	/**
	 * Normalize SQL syntax
	 *
	 * @access private
	 * @param string
	 */
	function normalize_sql_syntax(&$sql_string)
	{
		// Make sure whitespaces are really blanks and only a single one.
		// It should slightly simplify and, more importantly, speed up
		// regular expressions used by the parser from this point on.
		$sql_string = preg_replace('#\s+#', ' ', $sql_string);

		// Ignore backticks now, if any.
		$sql_string = str_replace('`', '', $sql_string);

		// Trim whitespaces before "(", ",", ";" or ")".
		$sql_string = preg_replace('# *([(),;])#', '$1', $sql_string);

		// Trim whitespaces after "(", "," or ";".
		$sql_string = preg_replace('#([(,;]) *#', '$1', $sql_string);

		// Make sure there is a single whitespace between ")" and a word.
		$sql_string = preg_replace('#(\))([a-zA-Z0-9_])#', '$1 $2', $sql_string);

		// Replace the phpBB table prefix here, only if necessary.
		if( $this->table_prefix != $this->phpbb_prefix )
		{
			$sql_string = str_replace($this->phpbb_prefix, $this->table_prefix, $sql_string);
		}
	}

	/**
	 * Split SQL elements list.
	 *
	 * Format expected: element[,...]
	 *
	 * This method assumes no string constants are present (they were replaced with tokens).
	 * Note this method needs to be used since some elements in the list may have commas
	 * such as dec(x,y) or (key1,key2), so we can't simply explode(',', $elements_list).
	 *
	 * @access private
	 * @param string Elements list.
	 * @return array An array item for each element in the list.
	 */
	function split_elements_list($elements_list)
	{
		$elements_list_length = strlen($elements_list);
		$elements_array = array();
		$element = '';
		$inner_parenthesis = 0;
		for( $i = 0; $i < $elements_list_length; $i++ )
		{
			$char = $elements_list[$i];

			if( $inner_parenthesis > 0 )
			{
				$element .= $char;

				if( $char == ')' )
				{
					$inner_parenthesis--;
				}
				elseif( $char == '(' )
				{
					$inner_parenthesis++;
				}
			}
			else
			{
				if( $char == ',' )
				{
					$elements_array[] = trim($element);
					$element = '';
				}
				else
				{
					$element .= $char;

					if( $char == '(' )
					{
						$inner_parenthesis++;
					}
				}
			}
		}
		$elements_array[] = trim($element);
		return $elements_array;
	}

	/**
	 * Extract SQL String Constants.
	 *
	 * String constants are saved into an associative array where keys are a special tokens enclosed
	 * between regexp delimiters (#) and values are fully quoted string constants.
	 * Tokens replace string constants in the output string of this method (which is finally whitespace
	 * trimmed) so the rest of the parser doesn't need to take into account string constants to analize
	 * the syntax. Not in the scope of this method, but a job for the class itself is to ensure constants
	 * are properly restored before generating any output (such as SQL statements or error messages).
	 *
	 * Simple SQL Comments:
	 *
	 * - This method is also used to remove simple SQL comments. Simple SQL comments are introduced by
	 *   two consecutive hyphens (--) or by a hash character (#). Note comment markers inside of a string
	 *   constant should be (in fact, are) considered part of the constant.
	 *
	 * Expected Syntax for String Constants:
	 *
	 * - Standard SQL string constants are arbitrary sequences of characters delimited by single quotes.
	 *   ie. 'This is a standard SQL string constant'
	 *
	 * - Double quotes are used in SQL to quote identifiers, except MySQL, which uses backticks for this
	 *   purpose. MySQL (therefore this method too) also accepts double quotes to delimit string constants.
	 *   ie. "This is NOT standard, but still considered a string constant by MySQL, and so it is here"
	 *
	 * - Quotes used as string delimiters may be escaped by themselves or by backslashes.
	 *   ie. 'Here''s an example' 'Here\'s another example'
	 *
	 * @access private
	 * @param string Input string is passed by reference for performance reasons.
	 * @param string Output string is also returned by reference.
	 * @return bool FALSE if a non-closed string constant has been found.
	 */
	function extract_sql_constants(&$input, &$output)
	{
		$input_length = strlen($input);
		$output = $quote = $constant = '';

		for( $i = 0; $i < $input_length; $i++ )
		{
			$char = $input{$i};

			// If we were inside a string constant, $quote would contain the delimiter.
			if( empty($quote) )
			{
				// We aren't part of any string constant, let's see if we can find one.
				if( $char == "'" || $char == '"' )
				{
					$quote = $char;
				}
				else
				{
					// If this is a simple SQL comment mark, ignore the rest of the input
					$next = ( ($i+1) >= $input_length ? '' : $input{$i+1} );
					if( $char == '#' || ( $char == '-' && $next == '-' ) )
					{
						break;
					}
					$output .= $char;
				}
			}
			else
			{
				// Is this is an escape character or a trailing delimiter?
				if( $char == '\\' || $char == $quote )
				{
					// Is this is an escape character or is it a delimiter escaping itself?
					$next = ( ($i+1) >= $input_length ? '' : $input{$i+1} );
					if( $char == '\\' || ( $char == $quote && $char == $next ) )
					{
						// If so, current char and next one are both part of the string constant.
						$constant .= $char . $next;
						$i++;
					}
					else
					{
						// This is the trailing delimiter, save it and replace the constant with a unique token.
						$token = '___' . $this->tokens_count++ . '___';
						$output .= $token;
						$this->constant_tokens['#' . $token . '#'] = $quote . $constant . $quote;
						$quote = $constant = '';
					}
				}
				else
				{
					// This char is part the current string constant.
					$constant .= $char;
				}
			}
		}

		// If $quote is not empty, we found a non-closed string constant!
		if( !empty($quote) )
		{
			$output = $input;
			return false;
		}

		// Finally, trim the result
		$output = trim($output);
		return true;
	}

	/**
	 * Restore String Constants.
	 *
	 * Restore all tokens found in input string with the correspoding saved string constants.
	 *
	 * @access private
	 * @param string|array
	 * @return string|array
	 */
	function restore_all_constants(&$input)
	{
		return preg_replace(array_keys($this->constant_tokens), array_values($this->constant_tokens), $input);
	}

	/**
	 * Restore a single String Constant.
	 *
	 * @access private
	 * @param string Token to lookup.
	 * @return string Constant if token was found, otherwise return input as-is.
	 */
	function restore_sql_constant($token)
	{
		return isset($this->constant_tokens['#' . $token . '#']) ? $this->constant_tokens['#' . $token . '#'] : $token;
	}

	/**
	 * Split string into array of SQL statements.
	 *
	 * This method prepares the following class properties:
	 * - sql_input: An array of clean SQL statements.
	 * - sql_total: Total number of SQL statements.
	 *
	 * @access private
	 * @param string Reference to a string of one or more SQL statements.
	 * @return bool FALSE if any error was found.
	 */
	function split_string(&$sql_string, &$sql_array)
	{
		global $lang;

		// Split string into an array of lines (dealing with LF, CRLF and CR).
		$tmp_array = preg_split("/\r?\n|\r/", $sql_string);
		$tmp_array_count = count($tmp_array);
		$sql_string = '';

		// Clean up the input
		$sql_array = array();
		for( $i = 0; $i < $tmp_array_count; $i++ )
		{
			// Replace string constants with tokens and remove leading/trailing whitespaces
			if( !$this->extract_sql_constants($tmp_array[$i], $line) )
			{
				$this->format_error(sprintf($lang['SQL_nonclosed_string'], $line));
				return false;
			}
			// Remove empty lines
			if( !empty($line) )
			{
				$sql_array[] = $line;
			}
		}
		unset($tmp_array, $line);

		// Convert array into a long string again.
		$sql_string = implode(' ', $sql_array);

		// Remove C-style comments, introduced by /* and ended with */
		$sql_string = preg_replace('#/\*.*?\*/#', '', $sql_string);

		// Normalize SQL syntax
		$this->normalize_sql_syntax($sql_string);

		// Check for semicolon presence in last statement
		if( $sql_string{strlen($sql_string)-1} == ';' )
		{
			// Strip out latest semicolon to prevent explode from creating an empty element at end of array.
			$sql_string = substr($sql_string, 0, -1);
		}
		else
		{
			// A warning is issued if last statement is not terminated with a semi-colon.
			// It might be an indication of further syntax errors.
			$this->format_warning($lang['SQL_missing_semicolon'], substr_count($sql_string, ';')+1);
		}

		// Split string into an array where each element is a single SQL statement.
		$sql_array = explode(';', $sql_string);

		// We can easilly save an array of clean SQL statements for the caller's convenience.
		$this->sql_input = $this->restore_all_constants($sql_array);

		// Save total number of SQL statements and quit.
		$this->sql_total = count($sql_array);
		return true;
	}

	/**
	 * Convert SQL statements (input is a stream).
	 *
	 * @access public
	 * @param string Stream of one or more SQL statements.
	 * @param string Table Prefix in the target DB (optional).
	 * @return integer Return code (@see constants SQL_PARSER_*).
	 */
	function parse_stream($sql_stream, $table_prefix = false)
	{
		if( !$this->initialize() )
		{
			return SQL_PARSER_ERROR | (count($this->warnings) > 0 ? SQL_PARSER_WARNINGS : 0);
		}
		$this->table_prefix = ( $table_prefix !== false ? $table_prefix : $this->phpbb_prefix );

		// Split string into an array of SQL statements
		if( !$this->split_string($sql_stream, $sql_array) )
		{
			return SQL_PARSER_ERROR | (count($this->warnings) > 0 ? SQL_PARSER_WARNINGS : 0);
		}
		// Free up memory used by our local copy of the input string
		unset($sql_stream);

		// Process each SQL statement.
		for( $this->sql_count = 0; $this->sql_count < $this->sql_total; $this->sql_count++ )
		{
			if( !$this->parse_statement($sql_array[$this->sql_count]) )
			{
				return SQL_PARSER_ERROR | (count($this->warnings) > 0 ? SQL_PARSER_WARNINGS : 0);
			}
		}

		// Issue warnings for possible inconsistencies in DB design.
		$this->check_data_dictionary();

		// Free up a bit of memory
		unset($sql_array, $this->constant_tokens, $this->reserved_keywords, $this->cached_keywords);

		return ( count($this->warnings) > 0 ? SQL_PARSER_WARNINGS : SQL_PARSER_SUCCESS );
	}

	/**
	 * Convert SQL statements (input is file).
	 *
	 * This method is just provided for convenience. Despite input is a filename
	 * we still return an array, so the caller can do whatever...
	 *
	 * @access public
	 * @param string File name, contents of one or more SQL statements.
	 * @param string Table Prefix in the target DB (optional).
	 * @return integer Return code (@see constants SQL_PARSER_*).
	 */
	function parse_file($filename, $table_prefix = false)
	{
		if( !($sql_stream = $this->read_file($filename)) )
		{
			return SQL_PARSER_ERROR | (count($this->warnings) > 0 ? SQL_PARSER_WARNINGS : 0);
		}
		return $this->parse_stream($sql_stream, $table_prefix);
	}
}

?>