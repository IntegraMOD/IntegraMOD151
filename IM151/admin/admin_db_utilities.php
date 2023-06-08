<?php
/***************************************************************************
*                             admin_db_utilities.php
*                              -------------------
*     begin                : Thu May 31, 2001
*     copyright            : (C) 2001 The phpBB Group
*     email                : support@phpbb.com
*
*
****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/***************************************************************************
*	We will attempt to create a file based backup of all of the data in the
*	users phpBB database.  The resulting file should be able to be imported by
*	the db_restore.php function, or by using the mysql command_line
*
*	Some functions are adapted from the upgrade_20.php script and others
*	adapted from the unoficial phpMyAdmin 2.2.0.
***************************************************************************/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['General']['Backup_DB'] = $filename . "?perform=backup";

	$file_uploads = (@phpversion() >= '4.0.0') ? @ini_get('file_uploads') : @get_cfg_var('file_uploads');

	if( (empty($file_uploads) || $file_uploads != 0) && (strtolower($file_uploads) != 'off') && (@phpversion() != '4.0.4pl1') )
	{
		$module['General']['Restore_DB'] = $filename . "?perform=restore";
		$module['General']['Optimize_DB'] = $filename . "?perform=optimize";
	}

	return;
}

//
// Load default header
//
$no_page_header = TRUE;
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path.'language/lang_' . $board_config['default_lang'] . '/lang_admin_db_utilities.'.$phpEx);
include($phpbb_root_path . 'includes/sql_parse.'.$phpEx);

//
// Set VERBOSE to 1  for debugging info..
//
define("VERBOSE", 0);

//
// Increase maximum execution time, but don't complain about it if it isn't
// allowed.
//
@set_time_limit(1200);

// -----------------------
// The following functions are adapted from phpMyAdmin and upgrade_20.php
//
function gzip_PrintFourChars($Val)
{
	for ($i = 0; $i < 4; $i ++)
	{
		$return .= chr($Val % 256);
		$Val = floor($Val / 256);
	}
	return $return;
} 



//
// This function is used for grabbing the sequences for postgres...
//
function pg_get_sequences($crlf, $backup_type)
{
	global $db;

	$get_seq_sql = "SELECT relname FROM pg_class WHERE NOT relname ~ 'pg_.*'
		AND relkind = 'S' ORDER BY relname";

	$seq = $db->sql_query($get_seq_sql);

	if( !$num_seq = $db->sql_numrows($seq) )
	{

		$return_val = "# No Sequences Found $crlf";

	}
	else
	{
		$return_val = "# Sequences $crlf";
		$i_seq = 0;

		while($i_seq < $num_seq)
		{
			$row = $db->sql_fetchrow($seq);
			$sequence = $row['relname'];

			$get_props_sql = "SELECT * FROM $sequence";
			$seq_props = $db->sql_query($get_props_sql);

			if($db->sql_numrows($seq_props) > 0)
			{
				$row1 = $db->sql_fetchrow($seq_props);

				if($backup_type == 'structure')
				{
					$row['last_value'] = 1;
				}

				$return_val .= "CREATE SEQUENCE $sequence start " . $row['last_value'] . ' increment ' . $row['increment_by'] . ' maxvalue ' . $row['max_value'] . ' minvalue ' . $row['min_value'] . ' cache ' . $row['cache_value'] . "; $crlf";

			}  // End if numrows > 0

			if(($row['last_value'] > 1) && ($backup_type != 'structure'))
			{
				$return_val .= "SELECT NEXTVALE('$sequence'); $crlf";
				unset($row['last_value']);
			}

			$i_seq++;

		} // End while..

	} // End else...

	return $returnval;

} // End function...

//
// The following functions will return the "CREATE TABLE syntax for the
// varying DBMS's
//
// This function returns, will return the table def's for postgres...
//
function get_table_def_postgresql($table, $crlf)
{
	global $drop, $db;

	$schema_create = "";
	//
	// Get a listing of the fields, with their associated types, etc.
	//

	$field_query = "SELECT a.attnum, a.attname AS field, t.typname as type, a.attlen AS length, a.atttypmod as lengthvar, a.attnotnull as notnull
		FROM pg_class c, pg_attribute a, pg_type t
		WHERE c.relname = '$table'
			AND a.attnum > 0
			AND a.attrelid = c.oid
			AND a.atttypid = t.oid
		ORDER BY a.attnum";
	$result = $db->sql_query($field_query);

	if(!$result)
	{
		message_die(GENERAL_ERROR, "Failed in get_table_def (show fields)", "", __LINE__, __FILE__, $field_query);
	} // end if..

	if ($drop == 1)
	{
		$schema_create .= "DROP TABLE $table;$crlf";
	} // end if

	//
	// Ok now we actually start building the SQL statements to restore the tables
	//

	$schema_create .= "CREATE TABLE $table($crlf";

	while ($row = $db->sql_fetchrow($result))
	{
		//
		// Get the data from the table
		//
		$sql_get_default = "SELECT d.adsrc AS rowdefault
			FROM pg_attrdef d, pg_class c
			WHERE (c.relname = '$table')
				AND (c.oid = d.adrelid)
				AND d.adnum = " . $row['attnum'];
		$def_res = $db->sql_query($sql_get_default);

		if (!$def_res)
		{
			unset($row['rowdefault']);
		}
		else
		{
			$row['rowdefault'] = @pg_result($def_res, 0, 'rowdefault');
		}

		if ($row['type'] == 'bpchar')
		{
			// Internally stored as bpchar, but isn't accepted in a CREATE TABLE statement.
			$row['type'] = 'char';
		}

		$schema_create .= '	' . $row['field'] . ' ' . $row['type'];

		if (eregi('char', $row['type']))
		{
			if ($row['lengthvar'] > 0)
			{
				$schema_create .= '(' . ($row['lengthvar'] -4) . ')';
			}
		}

		if (eregi('numeric', $row['type']))
		{
			$schema_create .= '(';
			$schema_create .= sprintf("%s,%s", (($row['lengthvar'] >> 16) & 0xffff), (($row['lengthvar'] - 4) & 0xffff));
			$schema_create .= ')';
		}

		if (!empty($row['rowdefault']))
		{
			$schema_create .= ' DEFAULT ' . $row['rowdefault'];
		}

		if ($row['notnull'] == 't')
		{
			$schema_create .= ' NOT NULL';
		}

		$schema_create .= ",$crlf";

	}
	//
	// Get the listing of primary keys.
	//

	$sql_pri_keys = "SELECT ic.relname AS index_name, bc.relname AS tab_name, ta.attname AS column_name, i.indisunique AS unique_key, i.indisprimary AS primary_key
		FROM pg_class bc, pg_class ic, pg_index i, pg_attribute ta, pg_attribute ia
		WHERE (bc.oid = i.indrelid)
			AND (ic.oid = i.indexrelid)
			AND (ia.attrelid = i.indexrelid)
			AND	(ta.attrelid = bc.oid)
			AND (bc.relname = '$table')
			AND (ta.attrelid = i.indrelid)
			AND (ta.attnum = i.indkey[ia.attnum-1])
		ORDER BY index_name, tab_name, column_name ";
	$result = $db->sql_query($sql_pri_keys);

	if(!$result)
	{
		message_die(GENERAL_ERROR, "Failed in get_table_def (show fields)", "", __LINE__, __FILE__, $sql_pri_keys);
	}

	while ( $row = $db->sql_fetchrow($result))
	{
		if ($row['primary_key'] == 't')
		{
			if (!empty($primary_key))
			{
				$primary_key .= ', ';
			}

			$primary_key .= $row['column_name'];
			$primary_key_name = $row['index_name'];

		}
		else
		{
			//
			// We have to store this all this info because it is possible to have a multi-column key...
			// we can loop through it again and build the statement
			//
			$index_rows[$row['index_name']]['table'] = $table;
			$index_rows[$row['index_name']]['unique'] = ($row['unique_key'] == 't') ? ' UNIQUE ' : '';
			$index_rows[$row['index_name']]['column_names'] .= $row['column_name'] . ', ';
		}
	}

	if (!empty($index_rows))
	{
		while(list($idx_name, $props) = each($index_rows))
		{
			$props['column_names'] = ereg_replace(", $", "" , $props['column_names']);
			$index_create .= 'CREATE ' . $props['unique'] . " INDEX $idx_name ON $table (" . $props['column_names'] . ");$crlf";
		}
	}

	if (!empty($primary_key))
	{
		$schema_create .= "	CONSTRAINT $primary_key_name PRIMARY KEY ($primary_key),$crlf";
	}

	//
	// Generate constraint clauses for CHECK constraints
	//
	$sql_checks = "SELECT rcname as index_name, rcsrc
		FROM pg_relcheck, pg_class bc
		WHERE rcrelid = bc.oid
			AND bc.relname = '$table'
			AND NOT EXISTS (
				SELECT *
					FROM pg_relcheck as c, pg_inherits as i
					WHERE i.inhrelid = pg_relcheck.rcrelid
						AND c.rcname = pg_relcheck.rcname
						AND c.rcsrc = pg_relcheck.rcsrc
						AND c.rcrelid = i.inhparent
			)";
	$result = $db->sql_query($sql_checks);

	if (!$result)
	{
		message_die(GENERAL_ERROR, "Failed in get_table_def (show fields)", "", __LINE__, __FILE__, $sql_checks);
	}

	//
	// Add the constraints to the sql file.
	//
	while ($row = $db->sql_fetchrow($result))
	{
		$schema_create .= '	CONSTRAINT ' . $row['index_name'] . ' CHECK ' . $row['rcsrc'] . ",$crlf";
	}

	$schema_create = ereg_replace(',' . $crlf . '$', '', $schema_create);
	$index_create = ereg_replace(',' . $crlf . '$', '', $index_create);

	$schema_create .= "$crlf);$crlf";

	if (!empty($index_create))
	{
		$schema_create .= $index_create;
	}

	//
	// Ok now we've built all the sql return it to the calling function.
	//
	return (stripslashes($schema_create));

}

//
// This function returns the "CREATE TABLE" syntax for mysql dbms...
//
function get_table_def_mysql($table, $crlf)
{
	global $drop, $db;

	$schema_create = "";
	$field_query = "SHOW FIELDS FROM $table";
	$key_query = "SHOW KEYS FROM $table";

	//
	// If the user has selected to drop existing tables when doing a restore.
	// Then we add the statement to drop the tables....
	//
	if ($drop == 1)
	{
		$schema_create .= "DROP TABLE IF EXISTS $table;$crlf";
	}

	$schema_create .= "CREATE TABLE $table($crlf";

	//
	// Ok lets grab the fields...
	//
	$result = $db->sql_query($field_query);
	if(!$result)
	{
		message_die(GENERAL_ERROR, "Failed in get_table_def (show fields)", "", __LINE__, __FILE__, $field_query);
	}

	while ($row = $db->sql_fetchrow($result))
	{
		$schema_create .= '	' . $row['Field'] . ' ' . $row['Type'];

		if(!empty($row['Default']))
		{
			$schema_create .= ' DEFAULT \'' . $row['Default'] . '\'';
		}

		if($row['Null'] != "YES")
		{
			$schema_create .= ' NOT NULL';
		}

		if($row['Extra'] != "")
		{
			$schema_create .= ' ' . $row['Extra'];
		}

		$schema_create .= ",$crlf";
	}
	//
	// Drop the last ',$crlf' off ;)
	//
	$schema_create = ereg_replace(',' . $crlf . '$', "", $schema_create);

	//
	// Get any Indexed fields from the database...
	//
	$result = $db->sql_query($key_query);
	if(!$result)
	{
		message_die(GENERAL_ERROR, "FAILED IN get_table_def (show keys)", "", __LINE__, __FILE__, $key_query);
	}

	while($row = $db->sql_fetchrow($result))
	{
		$kname = $row['Key_name'];

		if(($kname != 'PRIMARY') && ($row['Non_unique'] == 0))
		{
			$kname = "UNIQUE|$kname";
		}

		if(!is_array($index[$kname]))
		{
			$index[$kname] = array();
		}

		$index[$kname][] = $row['Column_name'];
	}

	while(list($x, $columns) = @each($index))
	{
		$schema_create .= ", $crlf";

		if($x == 'PRIMARY')
		{
			$schema_create .= '	PRIMARY KEY (' . implode($columns, ', ') . ')';
		}
		elseif (substr($x,0,6) == 'UNIQUE')
		{
			$schema_create .= '	UNIQUE ' . substr($x,7) . ' (' . implode($columns, ', ') . ')';
		}
		else
		{
			$schema_create .= "	KEY $x (" . implode($columns, ', ') . ')';
		}
	}

	$schema_create .= "$crlf);";

	if(get_magic_quotes_runtime())
	{
		return(stripslashes($schema_create));
	}
	else
	{
		return($schema_create);
	}

} // End get_table_def_mysql


//
// This fuction will return a tables create definition to be used as an sql
// statement.
//
//
// The following functions Get the data from the tables and format it as a
// series of INSERT statements, for each different DBMS...
// After every row a custom callback function $handler gets called.
// $handler must accept one parameter ($sql_insert);
//
//
// Here is the function for postgres...
//
function get_table_content_postgresql($table, $handler)
{
	global $db;

	//
	// Grab all of the data from current table.
	//

	$result = $db->sql_query("SELECT * FROM $table");

	if (!$result)
	{
		message_die(GENERAL_ERROR, "Failed in get_table_content (select *)", "", __LINE__, __FILE__, "SELECT * FROM $table");
	}

	$i_num_fields = $db->sql_numfields($result);

	for ($i = 0; $i < $i_num_fields; $i++)
	{
		$aryType[] = $db->sql_fieldtype($i, $result);
		$aryName[] = $db->sql_fieldname($i, $result);
	}

	$iRec = 0;

	while($row = $db->sql_fetchrow($result))
	{
		$schema_vals = '';
		$schema_fields = '';
		$schema_insert = '';
		//
		// Build the SQL statement to recreate the data.
		//
		for($i = 0; $i < $i_num_fields; $i++)
		{
			$strVal = $row[$aryName[$i]];
			if (eregi("char|text|bool", $aryType[$i]))
			{
				$strQuote = "'";
				$strEmpty = "";
				$strVal = addslashes($strVal);
			}
			elseif (eregi("date|timestamp", $aryType[$i]))
			{
				if (empty($strVal))
				{
					$strQuote = "";
				}
				else
				{
					$strQuote = "'";
				}
			}
			else
			{
				$strQuote = "";
				$strEmpty = "NULL";
			}

			if (empty($strVal) && $strVal != "0")
			{
				$strVal = $strEmpty;
			}

			$schema_vals .= " $strQuote$strVal$strQuote,";
			$schema_fields .= " $aryName[$i],";

		}

		$schema_vals = ereg_replace(",$", "", $schema_vals);
		$schema_vals = ereg_replace("^ ", "", $schema_vals);
		$schema_fields = ereg_replace(",$", "", $schema_fields);
		$schema_fields = ereg_replace("^ ", "", $schema_fields);

		//
		// Take the ordered fields and their associated data and build it
		// into a valid sql statement to recreate that field in the data.
		//
		$schema_insert = "INSERT INTO $table ($schema_fields) VALUES($schema_vals);";

		$handler(trim($schema_insert));
	}

	return(true);

}// end function get_table_content_postgres...

//
// This function is for getting the data from a mysql table.
//

function get_table_content_mysql($table, $handler)
{
	global $db;

	// Grab the data from the table.
	if (!($result = $db->sql_query("SELECT * FROM $table")))
	{
		message_die(GENERAL_ERROR, "Failed in get_table_content (select *)", "", __LINE__, __FILE__, "SELECT * FROM $table");
	}

	// Loop through the resulting rows and build the sql statement.
	if ($row = $db->sql_fetchrow($result))
	{
		$handler("\n#\n# Table Data for $table\n#\n");
		$field_names = array();

		// Grab the list of field names.
		$num_fields = $db->sql_numfields($result);
		$table_list = '(';
		for ($j = 0; $j < $num_fields; $j++)
		{
			$field_names[$j] = $db->sql_fieldname($j, $result);
			$table_list .= (($j > 0) ? ', ' : '') . $field_names[$j];
			
		}
		$table_list .= ')';

		do
		{
			// Start building the SQL statement.
			$schema_insert = "INSERT INTO $table $table_list VALUES(";

			// Loop through the rows and fill in data for each column
			for ($j = 0; $j < $num_fields; $j++)
			{
				$schema_insert .= ($j > 0) ? ', ' : '';

				if(!isset($row[$field_names[$j]]))
				{
					//
					// If there is no data for the column set it to null.
					// There was a problem here with an extra space causing the
					// sql file not to reimport if the last column was null in
					// any table.  Should be fixed now :) JLH
					//
					$schema_insert .= 'NULL';
				}
				elseif ($row[$field_names[$j]] != '')
				{
					$schema_insert .= '\'' . addslashes($row[$field_names[$j]]) . '\'';
				}
				else
				{
					$schema_insert .= '\'\'';
				}
			}

			$schema_insert .= ');';

			// Go ahead and send the insert statement to the handler function.
			$handler(trim($schema_insert));

		}
		while ($row = $db->sql_fetchrow($result));
	}

	return(true);
}

function output_table_content($content)
{
	global $tempfile;

	//fwrite($tempfile, $content . "\n");
	//$backup_sql .= $content . "\n";
	echo $content ."\n";
	return;
}
//
// End Functions
// -------------


//
// Begin program proper
//
if( isset($_GET['perform']) || isset($_POST['perform']) )
{
	$perform = (isset($_POST['perform'])) ? $_POST['perform'] : $_GET['perform'];

	switch($perform)
	{
//
// Start Optimize Database 1.2.2 by Sko22 < sko22@quellicheilpc.com >
//
		case 'optimize':

			include('./page_header_admin.'.$phpEx);
		
		$current_time = time();

			//
			// If has been clicked the button reset
			//
			if( isset( $_POST['reset'] ) )
			{
			$sql = "UPDATE " . OPTIMIZE_DB_TABLE . " SET cron_enable = '0', cron_every = '86400', cron_next ='0', cron_count='0', cron_lock = '1', show_begin_for = '',  show_not_optimized = '0' LIMIT 1 ";
			
				if( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not reset optimize database configuration', '', __LINE__, __FILE__, $sql);
				}
			}
			
			//
			// If has been clicked the button configure
			//
			if( isset( $_POST['configure'] ) || isset( $_POST['show_begin_for'] ) )
			{

				$sql = "UPDATE " . OPTIMIZE_DB_TABLE . " SET show_begin_for = '" . $_POST['show_begin_for'] . "' ";
			
				if( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not configure show begin for', '', __LINE__, __FILE__, $sql);
				}
			
				if ( isset( $_POST['configure'] ) )
				{

				//
				// Update optimize database cronfiguration
				//
				$sql = "UPDATE " . OPTIMIZE_DB_TABLE . " SET cron_every = " . $_POST['cron_every'] . ", cron_enable = '"  . $_POST['enable_optimize_cron'] . "', cron_next = " . ( $current_time + $_POST['cron_every'] ) . ", show_begin_for = '" . $_POST['show_begin_for'] . "', show_not_optimized = '" . $_POST['show_not_optimized'] . "' ";
			
				if( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not optimize database cronfiguration', '', __LINE__, __FILE__, $sql);
				}

				}

			}

			//
			// Optimize database configuration
			//
			$sql_opt = "SELECT * FROM " . OPTIMIZE_DB_TABLE . " ";

			$opt_conf_result = $db->sql_query($sql_opt);

			if( !( $opt_conf = $db->sql_fetchrow($opt_conf_result) ) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain database optimize configuration', '', __LINE__, __FILE__, $sql);
			}

			//
			// If has been clicked the button optimize
			//
			if(!isset($_POST['optimize']))
			{

			$sql = "SHOW TABLE STATUS LIKE '" . $opt_conf['show_begin_for'] . "%' ";

			$result = $db->sql_query($sql);
			if( !$result )
			{
				message_die(GENERAL_ERROR, "Couldn't obtain databases list", "", __LINE__, __FILE__, $sql);
			}


		$i = 0;
		while ($opt = $db->sql_fetchrow($result) )
		{
	
			if ( $opt['Data_free'] != 0 || !$opt_conf['show_not_optimized'] )
			{
			
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

			$dbsize = $opt['Data_length'] + $opt['Index_length']; 
			
			//
			// Exact weight of a table of a database
			//
			if( $dbsize >= 1048576 )
			{
				//$dbsize = sprintf("%.2f Mb", ( $dbsize / 1048576 ));
				$dbsize = round(($dbsize / 1048576 ),1)." Mb";
			}
			else if( $dbsize >= 1024 )
			{
				//$dbsize = sprintf("%.2f Kb", ( $dbsize / 1024 ));
				$dbsize = round(($dbsize / 1024 ),1)." Kb";
			}
			else
			{
				//$dbsize = sprintf("%.2f Bytes", $dbsize);
				$dbsize = round($dbsize,1)." Bytes";
			}

			$opt['Data_free'] != 0 ? $data_free = "No OK" : $data_free = "OK";
			$opt['Data_free'] != 0 ? $check = "checked" : $check = ""; 


		//
		// Make list tables of database
		//
		$template->assign_block_vars("optimize", array(
			"ROW_CLASS" => $row_class,
			"S_SELECT_TABLE" => "<input type=\"checkbox\" name=\"selected_tbl[]\" value=\"" . $opt['Name'] . "\"" . $check . ">",
			"TABLE" => $opt['Name'],
			"RECORD" => $opt['Rows'],
			"TYPE" => $opt['Type'],
			"SIZE" => $dbsize,
			"STATUS" => $data_free,
			"TOT_TABLE" => $i
			)
		);

		$total_tab = $i +1;
		$total_rec = $total_rec + $opt['Rows']; 
		$total_size = $total_size + $opt['Data_length'] + $opt['Index_length']; 
		if ($data_free == "No OK") $total_stat = "No OK";

		} 
		
		else
		
		{
			$i--;
		}

$i++;

	}

	$total_size = round(($total_size / 1048576 ),1)." Mb";
	$total_stat == "No OK" ? $total_stat = "No OK" : $total_stat = "OK";

	$template->set_filenames(array(
		"body" => "admin/db_utils_optimize_body.tpl")
	);

	$s_hidden_fields = "<input type=\"hidden\" name=\"perform\" value=\"$perform\" />";
	
	//
	// Enable the select tables script 
	//
	if ( $i != 1 )
	{
					
	$select_scritp = "
	<script language=\"JavaScript\">
	// I have copied and modified a script of phpMyAdmin.net
	<!--
	function setCheckboxes(the_form, do_check)
	{
	var elts = (typeof(document.forms[the_form].elements['selected_tbl[]']) != 'undefined') 
	? document.forms[the_form].elements['selected_tbl[]'] 
	: document.forms[the_form].elements = '';

	var elts_cnt  = (typeof(elts.length) != 'undefined') ? elts.length : 0;

	if (elts_cnt) {
		for (var i = 0; i < elts_cnt; i++) {
			if (do_check == \"invert\"){
			elts[i].checked == true ? elts[i].checked = false : elts[i].checked = true;
			} else {
			elts[i].checked = do_check;
			}
			} // end for
		} else {
			elts.checked = do_check;
		} // end if... else

	return true;
	}
	//-->
	</script>
	";

	}
	else
	{

	$select_scritp = "
	<script language=\"JavaScript\">
	<!--
	function setCheckboxes(the_form, do_check)
	{

	}
	//-->
	</script>";

	}

	switch ( $opt_conf['cron_every'] ) {
    case 2592000:
        $month = "selected";
        break;
    case 1296000:
        $weeks2 = "selected";
        break;
    case 604800:
        $week = "selected";
        break;
	case 259200:
        $days3 = "selected";
        break;
	case 86400:
        $day = "selected";
        break;
	case 21600:
        $hours6 = "selected";
        break;
	case 3600:
        $hour = "selected";
        break;
	case 1800:
        $minutes30 = "selected";
        break;
	case 20:
        $seconds20 = "selected";
        break;
	default : $day = "selected";
	}
		//
		// Select a cron every
		//
		$template->assign_block_vars("sel_cron_every", array(
			"MONTH" => $month,
			"2WEEKS" => $weeks2,
			"WEEK" => $week,
			"3DAYS" => $days3,
			"DAY" => $day,
			"6HOURS" => $hours6,
			"HOUR" => $hour,
			"30MINUTES" => $minutes30,
			"20SECONDS" => $seconds20,
	
			"L_MONTH" => $lang['Optimize_month'],
			"L_2WEEKS" => $lang['Optimize_2weeks'],
			"L_WEEK" => $lang['Optimize_week'],
			"L_3DAYS" => $lang['Optimize_3days'],
			"L_DAY" => $lang['Optimize_day'],
			"L_6HOURS" => $lang['Optimize_6hours'],
			"L_HOUR" => $lang['Optimize_hour'],
			"L_30MINUTES" => $lang['Optimize_30minutes'],
			"L_20SECONDS" => $lang['Optimize_20seconds']
			)
		);

		$opt_conf['cron_enable'] != '1' ? $enable_cron_no = 'checked="checked"': $enable_cron_yes = 'checked="checked"';
		$opt_conf['show_not_optimized'] != '1' ? $enable_not_optimized_no = 'checked="checked"': $enable_not_optimized_yes = 'checked="checked"';
		
		if ( $opt_conf['cron_enable'] != '1'  || $opt_conf['cron_next'] == 0 )
		{
			$next_cron = " - - ";
			$performed_cron = " - - ";
		}
		else 
		{

		$next_cron = create_date( 'd M Y H:i:s', $opt_conf['cron_next'], $board_config['board_timezone'] );
		$performed_cron = $opt_conf['cron_count'];

		}
			
			//
			// Make the template
			//
			$template->assign_vars(array(
					"SELECT_SCRIPT" => $select_scritp,
					"TOT_TABLE" => $total_tab,
					"TOT_RECORD" => $total_rec,
					"TOT_SIZE" => $total_size,
					"TOT_STATUS" => $total_stat,
					"NEXT_CRON" => $next_cron,
					"CURRENT_TIME" => create_date( 'd M Y H:i:s', $current_time, $board_config['board_timezone'] ),
					"PERFORMED_CRON" => $performed_cron,
					"L_ENABLE_CRON" => $lang['Optimize_Enable_cron'],
					"L_YES" => $lang['Yes'],
					"L_NO" => $lang['No'],
					"L_CRON_EVERY" => $lang['Optimize_Cron_every'],
					"L_CURRENT_TIME" => $lang['Optimize_Current_time'],
					"L_NEXT_CRON_ACTION" => $lang['Optimize_Next_cron_action'],
					"L_PERFORMED_CRON" => $lang['Optimize_Performed_Cron'],
					"L_DATABASE_OPTIMIZE" => $lang['Database_Utilities'] . " : " . $lang['Optimize'],
					"L_OPTIMIZE_EXPLAIN" => $lang['Optimize_explain'],
					"L_OPTIMIZE_DB" => $lang['Optimize_DB'],
					"L_CONFIGURATION" => $lang['Configuration'],
					"L_SHOW_NOT_OPTIMIZED" => $lang['Optimize_Show_not_optimized'],
					"L_SHOW_BEGIN_FOR" => $lang['Optimize_Show_begin_for'],
					"L_CONFIGURE" => $lang['Optimize_Configure'],
					"L_RESET" => $lang['Reset'],
					"L_TABLE" => $lang['Optimize_Table'],
					"L_RECORD" => $lang['Optimize_Record'],
					"L_TYPE" => $lang['Optimize_Type'],
					"L_SIZE" => $lang['Optimize_Size'],
					"L_STATUS" => $lang['Optimize_Status'],
					"L_CHECKALL" => $lang['Optimize_CheckAll'],
					"L_UNCHECKALL" => $lang['Optimize_UncheckAll'],
					"L_INVERTCHECKED" => $lang['Optimize_InvertChecked'],
					"L_START_OPTIMIZE" => $lang['Optimize'],
					"S_DBUTILS_ACTION" => append_sid("admin_db_utilities.$phpEx"),
					"S_ENABLE_CRON_YES" => $enable_cron_yes,
					"S_ENABLE_CRON_NO" => $enable_cron_no,
					"S_SHOW_BEGIN_FOR" => $opt_conf['show_begin_for'],
					"S_ENABLE_NOT_OPTIMIZED_YES" => $enable_not_optimized_yes,
					"S_ENABLE_NOT_OPTIMIZED_NO" => $enable_not_optimized_no,
					"S_HIDDEN_FIELDS" => $s_hidden_fields
					)
				);

				$template->pparse("body");

				break;

			}

			else
			
			{

			$sql = "OPTIMIZE TABLE ";

			// Make optimize query
			if ($_POST["selected_tbl"] != ""){

			$i=1;
			foreach ($_POST["selected_tbl"] as $var => $value){
				if($i<count($_POST["selected_tbl"])){
					$sql .= "`$value`, ";
					} else {
					$sql .= "`$value`";
					}
			 $i++;
			} 

			}

			$sql .= " ;";

			if (!$result = $db->sql_query($sql))

			{
				$optimize_notablechecked = true;
			}

			//
			// Create information message 
			//
			if ( $optimize_notablechecked == true )
			{

			$message = $lang['Optimize_NoTableChecked']  . "." . 
			"<br /><br />" . sprintf($lang['Optimize_return'], "<a href=\"" . append_sid("admin_db_utilities.$phpEx?perform=optimize") . "\">", "</a>")	 . 
			"<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>")	;
			}

			else

			{

			$message = $message = $lang['Optimize_success']  . "." .
			"<br /><br />" . sprintf($lang['Optimize_return'], "<a href=\"" . append_sid("admin_db_utilities.$phpEx?perform=optimize") . "\">", "</a>")	 .
			"<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>")	;

			}

			message_die(GENERAL_MESSAGE, $message);


			}

		break;
//
// End Optimize Database 1.2.2 by Sko22 < sko22@quellicheilpc.com >
//

		case 'backup':

			$error = false;
			switch(SQL_LAYER)
			{
				case 'oracle':
					$error = true;
					break;
				case 'db2':
					$error = true;
					break;
				case 'msaccess':
					$error = true;
					break;
				case 'mssql':
				case 'mssql-odbc':
					$error = true;
					break;
			}

			if ($error)
			{
				include('./page_header_admin.'.$phpEx);

				$template->set_filenames(array(
					"body" => "admin/admin_message_body.tpl")
				);

				$template->assign_vars(array(
					"MESSAGE_TITLE" => $lang['Information'],
					"MESSAGE_TEXT" => $lang['Backups_not_supported'])
				);

				$template->pparse("body");

				include('./page_footer_admin.'.$phpEx);
			}

			$sql = "SHOW TABLES";
			if(!$result = $db->sql_query($sql))
			{
				message_die(CRITICAL_ERROR, "Could not query database table information", "", __LINE__, __FILE__, $sql);
			}
			$tables = array();
			while( $row = $db->sql_fetchrow($result) )
			{
				$tables[] = str_replace($table_prefix, '', $row['Tables_in_' . $dbname]);
			}

/*			$tables = array('auth_access', 'banlist', 'categories', 'config', 'disallow', 'forums', 'forum_prune', 'groups', 'posts', 'posts_text', 'privmsgs', 'privmsgs_text', 'ranks', 'search_results', 'search_wordlist', 'search_wordmatch', 'sessions', 'smilies', 'themes', 'themes_name', 'topics', 'topics_watch', 'user_group', 'users', 'vote_desc', 'vote_results', 'vote_voters', 'words');
// Start add - Fully integrated shoutbox MOD
			$tables[] = 'shout';
// End add - Fully integrated shoutbox MOD
// Start add - Complete banner MOD
			$tables[] = 'banner';
			$tables[] = 'banner_stats';
// End add - Complete banner MOD*/
			$additional_tables = (isset($_POST['additional_tables'])) ? $_POST['additional_tables'] : ( (isset($_GET['additional_tables'])) ? $_GET['additional_tables'] : "" );

			$backup_type = (isset($_POST['backup_type'])) ? $_POST['backup_type'] : ( (isset($_GET['backup_type'])) ? $_GET['backup_type'] : "" );

			$gzipcompress = (!empty($_POST['gzipcompress'])) ? $_POST['gzipcompress'] : ( (!empty($_GET['gzipcompress'])) ? $_GET['gzipcompress'] : 0 );

			$drop = (!empty($_POST['drop'])) ? intval($_POST['drop']) : ( (!empty($_GET['drop'])) ? intval($_GET['drop']) : 0 );

			if(!empty($additional_tables))
			{
				if(ereg(",", $additional_tables))
				{
					$additional_tables = explode(",", $additional_tables);

					for($i = 0; $i < count($additional_tables); $i++)
					{
						$tables[] = trim($additional_tables[$i]);
					}

				}
				else
				{
					$tables[] = trim($additional_tables);
				}
			}

			if( !isset($_POST['backupstart']) && !isset($_GET['backupstart']))
			{
				include('./page_header_admin.'.$phpEx);

				$template->set_filenames(array(
					"body" => "admin/db_utils_backup_body.tpl")
				);	
				$s_hidden_fields = "<input type=\"hidden\" name=\"perform\" value=\"backup\" /><input type=\"hidden\" name=\"drop\" value=\"1\" /><input type=\"hidden\" name=\"perform\" value=\"$perform\" />";

				$template->assign_vars(array(
					"L_DATABASE_BACKUP" => $lang['Database_Utilities'] . " : " . $lang['Backup'],
					"L_BACKUP_EXPLAIN" => $lang['Backup_explain'],
					"L_FULL_BACKUP" => $lang['Full_backup'],
					"L_STRUCTURE_BACKUP" => $lang['Structure_backup'],
					"L_DATA_BACKUP" => $lang['Data_backup'],
					"L_ADDITIONAL_TABLES" => $lang['Additional_tables'],
					"L_START_BACKUP" => $lang['Start_backup'],
					"L_BACKUP_OPTIONS" => $lang['Backup_options'],
					"L_GZIP_COMPRESS" => $lang['Gzip_compress'],
					"L_NO" => $lang['No'],
					"L_YES" => $lang['Yes'],

					"S_HIDDEN_FIELDS" => $s_hidden_fields,
					"S_DBUTILS_ACTION" => append_sid("admin_db_utilities.$phpEx"))
				);
				$template->pparse("body");

				break;

			}
			else if( !isset($_POST['startdownload']) && !isset($_GET['startdownload']) )
			{
				if(is_array($additional_tables))
				{
					$additional_tables = implode(',', $additional_tables);
				}
				$template->set_filenames(array(
					"body" => "admin/admin_message_body.tpl")
				);

				$template->assign_vars(array(
					"META" => '<meta http-equiv="refresh" content="2;url=' . append_sid("admin_db_utilities.$phpEx?perform=backup&additional_tables=" . quotemeta($additional_tables) . "&backup_type=$backup_type&drop=1&amp;backupstart=1&gzipcompress=$gzipcompress&startdownload=1") . '">',

					"MESSAGE_TITLE" => $lang['Database_Utilities'] . " : " . $lang['Backup'],
					"MESSAGE_TEXT" => $lang['Backup_download'])
				);

				include('./page_header_admin.'.$phpEx);

				$template->pparse("body");

				include('./page_footer_admin.'.$phpEx);

			}
			header("Pragma: no-cache");
			$do_gzip_compress = FALSE;
			if( $gzipcompress )
			{
				$phpver = phpversion();

				if($phpver >= "4.0")
				{
					if(extension_loaded("zlib"))
					{
						$do_gzip_compress = TRUE;
					}
				}
			}
			if($do_gzip_compress)
			{
				@ob_start();
				@ob_implicit_flush(0);
				header("Content-Type: application/x-gzip; name=\"phpbb_db_backup.sql.gz\"");
				header("Content-disposition: attachment; filename=phpbb_db_backup.sql.gz");
			}
			else
			{
				header("Content-Type: text/x-delimtext; name=\"phpbb_db_backup.sql\"");
				header("Content-disposition: attachment; filename=phpbb_db_backup.sql");
			}

			//
			// Build the sql script file...
			//
			echo "#\n";
			echo "# phpBB Backup Script\n";
			echo "# Dump of tables for $dbname\n";
			echo "#\n# DATE : " .  gmdate("d-m-Y H:i:s", time()) . " GMT\n";
			echo "#\n";

			if(SQL_LAYER == 'postgresql')
			{
				 echo "\n" . pg_get_sequences("\n", $backup_type);
			}
			for($i = 0; $i < count($tables); $i++)
			{
				$table_name = $tables[$i];

				switch (SQL_LAYER)
				{
					case 'postgresql':
						$table_def_function = "get_table_def_postgresql";
						$table_content_function = "get_table_content_postgresql";
						break;

					case 'mysql':
					case 'mysql4':
					case 'mysqli':
						$table_def_function = "get_table_def_mysql";
						$table_content_function = "get_table_content_mysql";
						break;
				}

				if($backup_type != 'data')
				{
					echo "#\n# TABLE: " . $table_prefix . $table_name . "\n#\n";
					echo $table_def_function($table_prefix . $table_name, "\n") . "\n";
				}

				if($backup_type != 'structure')
				{
					$table_content_function($table_prefix . $table_name, "output_table_content");
				}
			}
			
			if($do_gzip_compress)
			{
				$Size = ob_get_length();
				$Crc = crc32(ob_get_contents());
				$contents = gzcompress(ob_get_contents());
				ob_end_clean();
				echo "\x1f\x8b\x08\x00\x00\x00\x00\x00".substr($contents, 0, strlen($contents) - 4).gzip_PrintFourChars($Crc).gzip_PrintFourChars($Size);
			}
			exit;

			break;

		case 'restore':
			if(!isset($_POST['restore_start']))
			{
				//
				// Define Template files...
				//
				include('./page_header_admin.'.$phpEx);

				$template->set_filenames(array(
					"body" => "admin/db_utils_restore_body.tpl")
				);

				$s_hidden_fields = "<input type=\"hidden\" name=\"perform\" value=\"restore\" /><input type=\"hidden\" name=\"perform\" value=\"$perform\" />";

				$template->assign_vars(array(
					"L_DATABASE_RESTORE" => $lang['Database_Utilities'] . " : " . $lang['Restore'],
					"L_RESTORE_EXPLAIN" => $lang['Restore_explain'],
					"L_SELECT_FILE" => $lang['Select_file'],
					"L_START_RESTORE" => $lang['Start_Restore'],

					"S_DBUTILS_ACTION" => append_sid("admin_db_utilities.$phpEx"),
					"S_HIDDEN_FIELDS" => $s_hidden_fields)
				);
				$template->pparse("body");

				break;

			}
			else
			{
				//
				// Handle the file upload ....
				// If no file was uploaded report an error...
				//
				$backup_file_name = (!empty($_FILES['backup_file']['name'])) ? $_FILES['backup_file']['name'] : "";
				$backup_file_tmpname = ($_FILES['backup_file']['tmp_name'] != "none") ? $_FILES['backup_file']['tmp_name'] : "";
				$backup_file_type = (!empty($_FILES['backup_file']['type'])) ? $_FILES['backup_file']['type'] : "";

				if($backup_file_tmpname == "" || $backup_file_name == "")
				{
					message_die(GENERAL_MESSAGE, $lang['Restore_Error_no_file']);
				}
				//
				// If I file was actually uploaded, check to make sure that we
				// are actually passed the name of an uploaded file, and not
				// a hackers attempt at getting us to process a local system
				// file.
				//
				if( file_exists(phpbb_realpath($backup_file_tmpname)) )
				{
					if( preg_match("/^(text\/[a-zA-Z]+)|(application\/(x\-)?gzip(\-compressed)?)|(application\/octet-stream)$/is", $backup_file_type) )
					{
						if( preg_match("/\.gz$/is",$backup_file_name) )
						{
							$do_gzip_compress = FALSE;
							$phpver = phpversion();
							if($phpver >= "4.0")
							{
								if(extension_loaded("zlib"))
								{
									$do_gzip_compress = TRUE;
								}
							}

							if($do_gzip_compress)
							{
								$gz_ptr = gzopen($backup_file_tmpname, 'rb');
								$sql_query = "";
								while( !gzeof($gz_ptr) )
								{
									$sql_query .= gzgets($gz_ptr, 100000);
								}
							}
							else
							{
								message_die(GENERAL_ERROR, $lang['Restore_Error_decompress']);
							}
						}
						else
						{
							$sql_query = fread(fopen($backup_file_tmpname, 'r'), filesize($backup_file_tmpname));
						}
						//
						// Comment this line out to see if this fixes the stuff...
						//
						//$sql_query = stripslashes($sql_query);
					}
					else
					{
						message_die(GENERAL_ERROR, $lang['Restore_Error_filename'] ." $backup_file_type $backup_file_name");
					}
				}
				else
				{
					message_die(GENERAL_ERROR, $lang['Restore_Error_uploading']);
				}

				if($sql_query != "")
				{
					// Strip out sql comments...
					$sql_query = remove_remarks($sql_query);
					$pieces = split_sql_file($sql_query, ";");

					$sql_count = count($pieces);
					for($i = 0; $i < $sql_count; $i++)
					{
						$sql = trim($pieces[$i]);

						if(!empty($sql) and $sql[0] != "#")
						{
							if(VERBOSE == 1)
							{
								echo "Executing: $sql\n<br>";
								flush();
							}

							$result = $db->sql_query($sql);

							if(!$result && ( !(SQL_LAYER == 'postgresql' && eregi("drop table", $sql) ) ) )
							{
								message_die(GENERAL_ERROR, "Error importing backup file", "", __LINE__, __FILE__, $sql);
							}
						}
					}
				}

				include('./page_header_admin.'.$phpEx);

				$template->set_filenames(array(
					"body" => "admin/admin_message_body.tpl")
				);

				$message = $lang['Restore_success'];

				$template->assign_vars(array(
					"MESSAGE_TITLE" => $lang['Database_Utilities'] . " : " . $lang['Restore'],
					"MESSAGE_TEXT" => $message)
				);

				$template->pparse("body");
				break;
			}
			break;
	}
}

include('./page_footer_admin.'.$phpEx);

?>
