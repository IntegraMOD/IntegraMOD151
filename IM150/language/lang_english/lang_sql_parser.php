<?php
/**
 *
 * @package SQL Parser
 * @version $Id: lang_sql_parser.php,v 1.4 2005/09/27 19:13:23 markus_petrux Exp $
 * @copyright (c) 2005 phpBB Group
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License
 *
 */


/**
 * Language definitions for SQL Parser
 *
 * @language english
 */
$lang += array(
	'SQL_error_open_file'		=> 'Failed opening file "%s"',
	'SQL_unknown_dbms'			=> 'Unknown or unsupported DBMS "%s"',
	'SQL_nonclosed_string'		=> 'A non-closed string constant has been found: %s',
	'SQL_missing_semicolon'		=> 'Missing semicolon, it might be an indication of further syntax errors',
	'SQL_in_statement'			=> ', statement: %d',
	'SQL_in_table_name'			=> ', table: "%s"',
	'SQL_unknown_command'		=> 'Unknown SQL command "%s"',
	'SQL_unexpected_syntax'		=> 'Unexpected syntax in "%s"',
	'SQL_nonportable_option'	=> 'Non-portable syntax option(s) "%1$s", ignored',
	'SQL_invalid_table_name'	=> 'Invalid table name "%s"',
	'SQL_invalid_index_name'	=> 'Invalid index name "%s"',
	'SQL_invalid_column_name'	=> 'Invalid column name "%s"',
	'SQL_reserved_keyword'		=> 'Identifier "%1$s" is a reserved keyword (reference: %2$s)',
	'SQL_invalid_index_name'	=> 'Invalid index name "%s"',
	'SQL_invalid_index'			=> 'Invalid index "%s"',
	'SQL_missing_keys'			=> 'Missing keys in "%s"',
	'SQL_invalid_key_length'	=> 'Invalid key length "%s"',
	'SQL_missing_key_length'	=> 'Missing key length "%1$s", mandatory for "%2$s" columns',
	'SQL_invalid_column'		=> 'Invalid column definition "%s"',
	'SQL_already_column'		=> 'Column "%s" already defined',
	'SQL_invalid_primary'		=> 'Invalid primary key "%s"',
	'SQL_already_primary'		=> 'Primary key "%s" already defined',
	'SQL_unknown_primary'		=> 'Unknown column name "%s" in primary key',
	'SQL_notnull_primary'		=> 'Inconsistent primary key "%s", should be defined as not null',
	'SQL_autoinc_noindex'		=> 'Inconsistent usage of AUTO_INCREMENT in column "%s", it must be indexed',
	'SQL_unknown_key'			=> 'Unknown column name for key "%s"',
	'SQL_missing_default'		=> 'Missing default value "%s"',
	'SQL_unknown_attribute'		=> 'Unexpected or unknown attribute "%1$s", in "%2$s"',
	'SQL_nosupport_datatype'	=> 'Unsupported data type "%s"',
	'SQL_invalid_datatype'		=> 'Invalid or unknown data type "%1$s", code: %2$d',
	'SQL_unknown_datatype'		=> 'Unknown data type "%s"',
	'SQL_illegal_null'			=> 'Illegal use of NULL for a NOT NULL column "%s"',
	'SQL_illegal_attribute'		=> 'Illegal use of "%s" attribute',
	'SQL_illegal_attriblen'		=> 'Illegal attribute length "%s"',
	'SQL_warn_empty_number'		=> 'An empty string constant for a numeric data type has been converted to 0 "%s"',
	'SQL_warn_bad_constant'		=> 'Possible inconsistencies detected, constant converted to (%1$s) in "%2$s"',
	'SQL_warn_display_width'	=> 'Inconsistent display width specified "%1$s" in column "%2$s"',
	'SQL_warn_mysql_ext'		=> 'MySQL extension "%1$s" used for column "%2$s"',
	'SQL_warn_column_type'		=> 'Column "%1$s" has been found using %2$d different data types in %3$d tables: %4$s',
	'SQL_warn_column_type_tb'	=> '%1$s in %2$s',
);

?>