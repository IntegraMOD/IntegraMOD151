<?php
/***************************************************************************
 *                              em_schema.php
 *                            -------------------
 *   begin                : Wednesday, May 16, 2002
 *   copyright            : (C) 2002-2004 by Nuttzy - Craig Nuttall, 2005 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: em_schema.php,v 1.9 2005/10/31 17:57:15 markus_petrux Exp $
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

define('IN_PHPBB', 1);
define('FATAL_ERROR_MSG', $lang['EM_Unable_to_parse']) ;
define('DB_TYPE', SQL_LAYER) ;
/*
define("DB_TYPE", "mysql") ;
define("DB_TYPE", "msaccess") ;
define("DB_TYPE", "postgresql") ;
define("DB_TYPE", "mssql") ;
*/
//define("DB_TYPE", "postgresql") ;

define('NOT_A_KEY', 0) ;
define('PRIMARY_KEY', 1) ;
define('INDEX_KEY', 2) ;


function parse_field_type( $params )
{
	// watch out for case when a length is appened to the type, ie. TINYINT(1)
	$type = strtolower($params) ;
	if ( strstr($params, '('))
	{
		$type = substr( $params, 0, strpos($params, '(')) ;
	}

	// got the type, make sure it is valid
// screw it.... should really be using in_array here
// why aren't I allowing for blobs!?!?!
	$valid_types = "tinyint smallint mediumint int integer bigint float double decimal char varchar tinytext text mediumtext longtext" ;
	if ( !stristr( $valid_types, $type))
	{
		return 'undefined' ;
	}

// quick and dirty fix... i didn't account for "integer" in other parts of the code, only int
	if ($type == 'integer')
	{
		$type = 'int' ;
	}

	return $type ;
}


function parse_field_length( $param, &$error)
{
	// lengths are enclosed within parenthesis so make sure we have them
	if ( strstr($param, '('))
	{
		// make sure the length has the closing )
		if ( !strstr($param, ')'))
		{
			$error = FATAL_ERROR_MSG . $lang['EM_malformed_type'] . " [$param]" ;
			return ;
		}

		$lenlen = strpos( $param, ")") - strpos( $param, '(') -1 ;
		$length = substr( $param, strpos( $param, '(') + 1, $lenlen) ;

		return trim($length) ;
	}

	return '' ;
}


function parse_field_null( $param1, $param2, &$error)
{
	// NULL and NOT NULL
	if ( strtoupper($param1) == 'NOT')
	{
		if ( strtoupper($param2) != 'NULL')
		{
			$error = FATAL_ERROR_MSG . $lang['EM_unmatched_NOT'] . " [$param1 $param2]" ;
			return '' ;
		}

		return 'NOT NULL' ;
	}

	// obviously a NULL
	else if ( strtoupper($param1) == 'NULL')
	{
		return 'NULL' ;
	}

	// wasn't supplied so send undefined and let parse_field supply a default value
	else
	{
		return 'undefined' ;
	}
}


function parse_field_default( $param, &$error)
{
	// it's correct
	if ( strtoupper($param) == 'DEFAULT')
	{
		return 'DEFAULT' ;
	}

	// wasn't supplied so send undefined and let parse_field supply a default value
	else
	{
		return 'undefined' ;
	}
}


function parse_field_default_value( $param, &$error)
{
	// now see if there is a value, we're not going to bother validating it though
	//    make sure there is a leading ' and a trialing '
	if (( $param[0] == "'") && ( $param[ strlen( $param)-1 ] == "'"))
	{
		return $param ;
	}

	// they may be setting the default to NULL... hopefully this works for ALL DB types!! /me crosses fingers
	else if (strtoupper($param) == 'NULL')
	{
		return 'NULL' ;
	}

	// we do need to have a valid default param if this function is called, so halt if it is screwed up
	else
	{
		$error = FATAL_ERROR_MSG . $lang['EM_missing_DEFAULT'] . " [$param]" ;
		return ;
	}
}


function parse_field_increment( $params, $parampos, &$error)
{
	// if the array pos isn't set, then get us out of here
	if (!isset( $params[$parampos]))
	{
		return '' ;
	}

	// see if its auto_increment
	else if ( strtolower($params[$parampos]) == 'auto_increment')
	{
		return 'auto_increment' ;
	}

	// not incrementing
	else
	{
		return '' ;
	}
}



// parse a table column for adding/modifying
function parse_field( $line, &$error)
{
/*

// adding a primary key --- DON'T NEED THE DROP PART!! - confirmed
ALTER TABLE `departments` DROP PRIMARY KEY ,
	ADD PRIMARY KEY ( `SSN` ) 

// then changing it to auto inc
ALTER TABLE `departments` CHANGE `SSN` `SSN` INT( 11 ) UNSIGNED DEFAULT '0' NOT NULL AUTO_INCREMENT
ALTER TABLE departments MODIFY SSN int( 11 ) UNSIGNED NOT NULL DEFAULT '0' AUTO_INCREMENT


auto_inc must be primary keys in mysql

*/

/////// need to strip of trailing )

	////
	//// now parse the fields being added
	////
	// field		text
	// type		tinyint; smallint; mediumint; int; float; double; decimal; char; varchar; 
	//			tinytext; text; mediumtext; longtext
	// length/set	text - OPTIONAL
	// null		NOT NULL; NULL - OPTIONAL; def = 'NOT NULL'
	// default		text - OPTIONAL; def = 'DEFAULT'
	// def val		text - OPTIONAL; def = ''
	// extra		auto_increment - OPTIONAL

	////
	//// if it's a key, it will have one of these formats
	////
	// KEY DateOfBirth (DateOfBirth) - for an index
	// PRIMARY KEY (SSN) - for primary key

	$params = explode(" ", $line) ;
	$numparams = count($params) ;
	// if there are less than 5 parameters, we automatically know it won't fly
	if ( $numparams < 2)
	{
		$error = FATAL_ERROR_MSG . $lang['EM_not_enough'] ;
		return ;
	}


// ALTER TABLE `departments` ADD `user_autospell` TINYINT DEFAULT '1',
// ALTER TABLE `departments` ADD `user_autospell` TINYINT(1) DEFAULT '1',
// ALTER TABLE `departments` ADD `user_autospell` TINYINT (1) DEFAULT '1',
// ALTER TABLE `departments` ADD `user_autospell` TINYINT( 1 ) DEFAULT '1',
// ALTER TABLE `departments` ADD `user_autospell` TINYINT ( 1 ) DEFAULT '1',


	// field name
	$name = str_replace("`", '', $params[0]) ;

	// variable type
	$type = parse_field_type( $params[1]) ;

	// get the length - a bit trickey if we want to allow max flexiblity
	$p1 = $params[1] ;
	$p2 = ( isset($params[2])) ? $params[2] : '' ;
	$p3 = ( isset($params[3])) ? $params[3] : '' ;
	$p4 = ( isset($params[4])) ? $params[4] : '' ;
	$len_search = "$p1 $p2 $p3 $p4" ;

	$length = parse_field_length( $len_search, $error) ;

	// this will give us the first occurence of ) and the associated pos
	$parampos = (strstr($p4, ')')) ? 3 : 0 ;
	$parampos = (strstr($p3, ')')) ? 2 : $parampos ;
	$parampos = (strstr($p2, ')')) ? 1 : $parampos ;
	$parampos = (strstr($p1, ')')) ? 0 : $parampos ;

	// add 2 to the pos for name and type + whatever we had for the length
	$parampos += 2 ;


/*
	PRIMARY KEY  (`post_id`),
	KEY `forum_id` (`forum_id`),
*/

	// KEY is normally a synonym for INDEX, as per the following link:
	// http://dev.mysql.com/doc/mysql/en/create-table.html#id3038496
	if (strtoupper($name) == 'INDEX')
	{
		$name = 'KEY';
	}

	// let's see if it's a key or primary key; if it's a malformed key, then the checks after this block should catch it
	if (((strtoupper($name) == 'KEY') || (strtoupper($name) == 'PRIMARY')) && ($type == 'undefined') && (!is_numeric( $length)))
	{
		// make sure the primary key is formatted correctly; just to make sure we are doing what we think we should be
		if ((strtoupper($name) == 'PRIMARY') && (!strstr(strtoupper($params[1]), 'KEY')))
		{
			$error = FATAL_ERROR_MSG . $lang['EM_improper_key'] ;
			return ;
		}

		// set 1 for primary and 2 for an index
		$key = (strtoupper($name) == 'PRIMARY') ? PRIMARY_KEY : INDEX_KEY ;

		// the length will actually contain the field name to be made a key, also sometimes when copying from 
		//   phpMyAdmin we'll get these ` characters... strip them out
		$name = str_replace("`", "", $length) ;

		// create the return array
		$ret_array = array(
			'name' => ($key == PRIMARY_KEY) ? 'PRIMARY' : 'KEY',
			'type' => ($key == PRIMARY_KEY) ? 'KEY' : $name,
			'length' => $name,
			'signed' => '',
			'null' => '',
			'default' => '',
			'def_val' => '',
			'increment' => '',
			'key_type' => $key) ;

		return $ret_array ;
	}


	// not a key, so if we don't recognize the type, then throw up ;-)
	if ( $type == 'undefined')
	{
		$error = FATAL_ERROR_MSG . sprintf($lang['EM_type_invalid'],'[' . $params[1] . ']') ;
//		return ;
	}

	// if there is a length, make sure it's an integer
	else if (($length != '') && (!is_numeric($length)))
	{
		$error = FATAL_ERROR_MSG . sprintf($lang['EM_length_invalid'],"[$length]") ;
//		return ;
	}

	// set unsigned if need be
	$signed = ( strtoupper($params[$parampos]) == 'UNSIGNED') ? 'UNSIGNED' : '' ;
	$parampos = ( $signed == 'UNSIGNED') ? ($parampos+1) : $parampos ;


	// NOTE: allow DEFAULT and NULL declaration to appear in any order if even present

/*
	// try "null" or "not null" first
	$null = parse_field_null( $params[$parampos], $params[$parampos+1], $error) ;
	$parampos = ( $null == 'NULL') ? $parampos+1 : ( ( $null == 'undefined') ? $parampos : $parampos+2 ) ;
	// mysql manual: If neither NULL nor NOT NULL is specified, the column is treated as though NULL had been specified. 
	$null = ($null == 'undefined') ? 'NULL' : $null ;


	// default value
	$default = parse_field_default( $params[$parampos], $parampos, $numparams, $error ) ;
	if ($default == 'undefined')
	{
		$text_types = 'char varchar tinytext text mediumtext longtext' ;
		$default = 'DEFAULT' ;
		$default_value = (stristr( $text_types, $type)) ? "''" : "'0'" ;
	}
	else
	{
		$default_value = parse_field_default_value( $params[$parampos+1], $error) ;
		$parampos = $parampos+2 ;
	}
*/
	// try "null" or "not null" first
	$null = parse_field_null( $params[$parampos], $params[$parampos+1], $error) ;

	// if we didn't get a null declaration, then see if the default is coming first
	if ($null == 'undefined')
	{
		// default value
		$default = parse_field_default( $params[$parampos], $parampos, $numparams, $error ) ;

		// if we don't get a default then both the default and null are definitely undefined
		if ($default == 'undefined')
		{
			$null = 'NULL' ;
			$text_types = 'char varchar tinytext text mediumtext longtext' ;
			$default = 'DEFAULT' ;
			$default_value = (stristr( $text_types, $type)) ? "''" : "'0'" ;
		}

		// got a default so define it and retest for null declaration
		else
		{
			// Make the default string (combine array, split by spaces)
			$default_string = '';
			while($parampos++ < count( $params ))
 			{
 				if(substr( $params[$parampos], -1 ) == "'")
				{
					$default_string .= $params[$parampos];
					break;
				}
				else
				{
					$default_string .= $params[$parampos] . ' ';
				}
 			}
			$default_value = parse_field_default_value( $default_string, $error);
			$parampos = $parampos+2 ;

			// try "null" or "not null" first
			$null = parse_field_null( $params[$parampos], $params[$parampos+1], $error) ;
			$parampos = ( $null == 'NULL') ? $parampos+1 : ( ( $null == 'undefined') ? $parampos : $parampos+2 ) ;
			// mysql manual: If neither NULL nor NOT NULL is specified, the column is treated as though NULL had been specified. 
			$null = ($null == 'undefined') ? 'NULL' : $null ;
		}
	}

	// got declaration, so now move on to default
	else
	{
		// will either be NULL or NOT NULL so add either 1 or 2 to the parmpos
		$parampos = ( $null == 'NULL') ? $parampos+1 : $parampos+2 ;

		// default value
		$default = parse_field_default( $params[$parampos], $parampos, $numparams, $error ) ;
		if ($default == 'undefined')
		{
			$text_types = 'char varchar tinytext text mediumtext longtext' ;
			$default = 'DEFAULT' ;
			$default_value = (stristr( $text_types, $type)) ? "''" : "'0'" ;
		}
		else
		{
			// Make the default string (combine array, split by spaces)
			$default_string = '';
			while($parampos++ < count( $params ))
 			{
 				if(substr( $params[$parampos], -1 ) == "'")
				{
					$default_string .= $params[$parampos];
					break;
				}
				else
				{
					$default_string .= $params[$parampos] . ' ';
				}
 			}
			$default_value = parse_field_default_value( $default_string, $error);
			$parampos = $parampos+2 ;
		}
	}


	// AUTO_INCREMENT; only do this is there is one more paramater
	$increment = parse_field_increment( $params, $parampos, $error) ;

	// create the return array
	$ret_array = array(
		'name' => $name,
		'type' => $type,
		'length' => $length,
		'signed' => $signed,
		'null' => $null,
		'default' => $default,
		'def_val' => $default_value,
		'increment' => $increment,
		'key_type' => NOT_A_KEY) ;

//$line = '[' . $ret_array['name'] . '][' . $ret_array['type'] . '][' . $ret_array['length'] . '][' . $ret_array['signed'] . '][' . $ret_array['null'] . '][' . $ret_array['default'] . '][' . $ret_array['def_val'] . '][' . $ret_array['increment'] . ']' ;
//echo "$line<br /><br />\n" ;

	return $ret_array ;
}


function assembleline_postgresql( $params, $target)
{
/*
	tinyint 	=> int2
	smallint	=> int2
	mediumint 	=> int4
	int 		=> int4
	bigint	=> int8
	float 	=> float4
	double 	=> float8
	decimal 	=  decimal
	char 		=  char
	varchar 	=  varchar
	tinytext 	=> text
	text 		=  text
	mediumtext 	=> text
	longtext	=> texts
*/

	// handle primary key... pretty easy in postgre
	if ($params['key_type'] == PRIMARY_KEY)
	{
		return 'CONSTRAINT PK_' . $target . ' PRIMARY KEY (' . $params['length'] . ')';
	}
	// handle index key... this will be added after the main alter or create statement
	else if ($params['key_type'] == INDEX_KEY)
	{
		return 'CREATE INDEX ' . $params['length'] . '_' . $target . "_index ON $target (" . $params['length'] . ')' ;
	}


	// conversions for auto_increment
	$default_value = $params['def_val'] ;
	if ($params['increment'] == 'auto_increment')
	{
		// we'll have to make a sequence... do this after the fact
		$default_value = "nextval('" . $target . "_" . $params['name'] . "_seq'::text)" ;
	}

	// convert type+length
	$type = $params['type'] ;
	if ( ($type == 'tinyint') || ($type == 'smallint'))
	{
		$type = 'int2' ;
	}
	else if ( ($type == 'mediumint') || ($type == 'int'))
	{
		$type = 'int4' ;
	}
	else if ($type == 'bigint')
	{
		$type = 'int8' ;
	}
	else if ($type == 'float')
	{
		$type = 'float4' ;
	}
	else if ($type == 'double')
	{
		$type = 'float8' ;
	}
	else if ( ($type == 'tinytext') || ($type == 'mediumtext') || ($type == 'longtext'))
	{
		$type = 'text' ;
	}

	// take care of length for varchar
	else if (( $type == 'varchar') || ( $type == 'char'))
	{
		$length = $params['length'] ;
		$type .= ($length != '')  ? "($length)" : '' ;
	}

	return $params['name'] . ' ' . $type . ' ' . $params['signed'] . ' ' . $params['null'] . ' ' . $params['default'] . ' ' . $default_value ;
}


function assembleline_msaccess( $params, $target)
{
/*
	tinyint 	=  TINYINT
	smallint	=  SMALLINT
	mediumint 	=> INTEGER
	int 		=  INTEGER
	bigint	=> BIGINT		// not sure if this is right
	float 	=> REAL
	double 	=> FLOAT
	decimal 	=  DECIMAL
	char 		=  CHARACTER
	varchar 	=> TEXT
	tinytext 	=> TEXT
	text 		=> MEMO
	mediumtext 	=> MEMO
	longtext	=> MEMO
*/


	// handle primary key... we'll actually have to append this to the end of another column... joy!
	if ($params['key_type'] == PRIMARY_KEY)
	{
		return ' CONSTRAINT PK_' . $target . ' PRIMARY KEY' ;
	}
	// handle index key... this will be added after the main alter or create statement
	else if ($params['key_type'] == INDEX_KEY)
	{
		return 'CREATE INDEX ' . $params['length'] . '_' . $target . "_index ON $target (" . $params['length'] . ')' ;
	}


	// convert type+length
	$type = $params['type'] ;
	$length = $params['length'] ;
	$signed = '' ;
	if ($params['increment'] == 'auto_increment')
	{
		$type = 'COUNTER' ;
		$signed = '' ;
	}
	else if ( ($type == 'tinyint') && ($length == 1))
	{
		$type = 'BIT' ;
	}
	else if ( $type == 'mediumint')
	{
		$type = 'INTEGER' ;
	}
	else if ( $type == 'varchar')
	{
		$type = 'TEXT(' . $length . ')' ;
	}
	else if ( ($type == 'text') || ($type == 'mediumtext') || ($type == 'longtext'))
	{
		$type = 'MEMO' ;
	}

	// strange, float=REAL and double=FLOAT
	else if ( $type == 'float')
	{
		$type = 'REAL' ;
	}
	else if ( $type == 'double')
	{
		$type = 'FLOAT' ;
	}


//NOTE: can't get access to add defaults :(
$default = '' ;
$default_value = '' ;

	return $params['name'] . ' ' . $type . ' ' . $signed . ' ' . $params['null'] . ' ' . $default . ' ' . $default_value ;
}


function assembleline_mssql_defaults( $params, $target)
{

/////////// might need to strip out the single quotes on the value
/////////// 	CONSTRAINT [DF_phpbb_extension_groups_cat_id] DEFAULT (0) FOR [cat_id],

	if ($params['default'] == 'DEFAULT')
	{
		$default = 'CONSTRAINT [DF_' . $target . '_' . $params['name'] . '] DEFAULT (' . $params['def_val'] . ') FOR [' . $params['name'] . ']' ;

		return $default ;
	}
	return '' ;
}


function assembleline_mssql( $params, $target)
{
	// MSSQL seems to use the same data types as MS Access
	//	except use VARCHAR() instead of TEXT() and TEXT instead of MEMO
/*
	tinyint 	=  TINYINT
	smallint	=  SMALLINT
	mediumint 	=> INTEGER
	int 		=  INTEGER
	bigint	=> bigint
	float 	=> REAL
	double 	=> FLOAT
	decimal 	=  DECIMAL
	char 		=  CHARACTER
	varchar 	=  VARCHAR
	tinytext 	=> TEXT
	text 		=  TEXT
	mediumtext 	=> TEXT
	longtext	=> TEXT
*/

	// handle primary key... pretty easy in postgre
	if ($params['key_type'] == PRIMARY_KEY)
	{
		$mssql_primary = "ALTER TABLE [$target] WITH NOCHECK ADD" ;
		$mssql_primary .= ' CONSTRAINT [PK_' . $target . '] PRIMARY KEY CLUSTERED' ;
		$mssql_primary .= ' ( [' . $params['length'] . '] ) ON [PRIMARY]' ;
		$mssql_primary .= ' GO' ;
		return $mssql_primary ;
	}
	// handle index key... this will be added after the main alter or create statement
	else if ($params['key_type'] == INDEX_KEY)
	{
		return 'CREATE INDEX [' . $params['length'] . '_' . $target . "_index] ON [$target] ([" . $params['length'] . ']) ON [PRIMARY] GO' ;
	}


	// correct the type
	$type = $params['type'] ;
	if ( ($type == 'tinyint') && ($length == 1))
	{
		$type = 'bit' ;
	}
	else if ( ($type == 'mediumint'))
	{
		$type = 'int' ;
	}
	// strange, float=REAL and double=FLOAT (this appears true for MS Access, not sure about MSSQL)
	else if ( $type == 'float')
	{
		$type = 'real' ;
	}
	else if ( $type == 'double')
	{
		$type = 'float' ;
	}
	else if ( ($type == 'tinytext') || ($type == 'text') || ($type == 'mediumtext') || ($type == 'longtext'))
	{
		$type = 'text' ;
	}

	// take care of length for varchar
	$length = $params['length'] ;
	if (( $type == 'varchar') || ( $type == 'char'))
	{
		$length = ($length != '') ? "($length)" : '' ;
	}
	else
	{
		$length = '' ;
	}

	// conversions for auto_increment
	$identity = '' ;
	if ($params['increment'] == 'auto_increment')
	{
		$identity = ' IDENTITY (1, 1)' ;
	}


	return '['. $params['name'] . '] [' . $type . '] ' . $length . ' ' . $params['signed'] . ' ' . $identity . ' ' . $params['null'] ;
}


function assemble_line( $params, $command)
{
	$len = ($params['length'] == '') ? '' : ('(' . $params['length'] . ')') ;
	if( $params['increment'] != '' )
	{
		$params['default'] = $params['def_val'] = '';
	}
	$mysql_line = $params['name'] . ' ' . $params['type'] . $len . ' ' . $params['signed'] . ' ' . $params['null'] . ' ' . $params['default'] . ' ' . $params['def_val'] . ' ' . $params['increment'] ;
	switch ( DB_TYPE )
	{
		case 'mysql':
		case 'mysqli':
		case 'mysql4':
			// the beauty of using pseudo mySQL is that these everything is mySQL complaint without change ;-)
			return $mysql_line ;

		case 'postgresql':
			return assembleline_postgresql( $params, $command['target']) ;

		case 'msaccess':
			return assembleline_msaccess( $params, $command['target']) ;

		case 'mssql':
			return assembleline_mssql( $params, $command['target']);

		default:
			return $mysql_line ;
	}
}


function assemble_sql_lines( $params, $command, $line_start, $create)
{
	$sql = array() ;
	$sql_post = array() ;
	$sql_lines = array();


	if ( DB_TYPE == 'mssql' )
	{
//		$sql[] = 'BEGIN TRANSACTION GO' ;
	}

	// loop through our parameter list and build the create table SQL
	$num_params = count($params) ;
	for ($i=0; $i<$num_params; $i++)
	{
		$formatted_line = assemble_line( $params[$i], $command) ;

		switch ( DB_TYPE )
		{
			case 'mysql':
			case 'mysqli':
			case 'mysql4':
				$sql_line = $formatted_line ;
				$sql_line .= (($create) && ($i==($num_params-1))) ? ')' : (($create) ? ', ' : '') ;
				$sql_lines[] = $sql_line ;
				break ;

			case 'msaccess':
				// if this is an index key (not a primary) then we need a separate command for it
				if ($params[$i]['key_type'] == INDEX_KEY)
				{
					$sql_post[] = $formatted_line ;
				}

				// if this is a primary key, then we need to append some text to the column declaration
				else if ($params[$i]['key_type'] == PRIMARY_KEY)
				{
					// search for the line we need to append this to
					for ($j=0; $j<count($sql_lines); $j++)
					{
						$line_splits = explode(' ', $sql_lines[$j]) ;
						// kind of weird but the key name is stored in the length
						if ($line_splits[0] == $params[$i]['length'])
						{
							// got a match so append it (strip off the , first)
							$the_comma = '' ;
							if ($sql_lines[$j][strlen($sql_lines[$j])-2] == ',')
							{
								$sql_lines[$j] = substr($sql_lines[$j], 0, strlen($sql_lines[$j])-2) ;
								$the_comma = ', ' ;
							}
							$sql_lines[$j] .= " $formatted_line $the_comma" ;
							break ;
						}
					}
				}

				else
				{
					$sql_lines[] = $formatted_line ;
					$num_lines = count($sql_lines)-2 ;
					if (($create) && ($num_lines >= 0 ))
					{
						$sql_lines[$num_lines] .= ', ' ;
					}
				}

				if (($create) && ($i==($num_params-1)))
				{
					$sql_lines[] = ')' ;
				}
				break ;

			case 'postgresql':
				// add sequence if need be
				if ( $params[$i]['increment'] == 'auto_increment')
				{
					// if it's an auto_increment, then the firs sql command needs to be a sequence
					//   the postgre manual says "The keyword COLUMN is noise and can be omitted." ... so i did ;-)
					$sql[] = 'CREATE SEQUENCE ' . $command['target'] . '_' . $params[$i]['name'] . '_seq start 1 increment 1 maxvalue 2147483647 minvalue 1 cache 1' ;
				}


				// if this is an index key (not a primary) then we need a separate command for it
				if ($params[$i]['key_type'] == INDEX_KEY)
				{
					$sql_post[] = $formatted_line ;
				}
				else
				{
					$sql_line = $formatted_line ;
					$sql_line .= (($create) && ($i==($num_params-1))) ? ')' : (($create) ? ', ' : '') ;
					$sql_lines[] = $sql_line ;
				}
				break ;

			case 'mssql':
				// if this is an index key (not a primary) then we need a separate command for it
				if (($params[$i]['key_type'] == PRIMARY_KEY) || ($params[$i]['key_type'] == INDEX_KEY))
				{
					$sql_post[] = $formatted_line ;
				}
				else
				{
					$default = assembleline_mssql_defaults( $params[$i], $command['target']) ;
					if ( $default != '')
					{
////// not sure about the GO on the end - decided to exclude it
//						$sql_post[] = 'ALTER TABLE [' . $command['target'] . '] WITH NOCHECK ADD ' . $default . ' GO' ;
						$sql_post[] = 'ALTER TABLE [' . $command['target'] . '] WITH NOCHECK ADD ' . $default ;
					}

					$sql_lines[] = $formatted_line ;
					$num_lines = count($sql_lines)-2 ;
					if (($create) && ($num_lines >= 0 ))
					{
						$sql_lines[$num_lines] .= ', ' ;
					}
				}

				if (($create) && ($i == ($num_params-1)))
				{
					$sql_lines[] = ') ON [PRIMARY] GO' ;
				}
				break ;
		}
	}

	if ($create)
	{
		$sql_line = $line_start ;
		for ($i=0; $i<count($sql_lines); $i++)
		{
			$sql_line .= $sql_lines[$i] ;
		}
		$sql[] = $sql_line ;
	}
	else
	{
		for ($i=0; $i<count($sql_lines); $i++)
		{
			$sql[] = $line_start . ' ' . $sql_lines[$i] ;
		}
	}


	for ($i=0; $i<count($sql_post); $i++)
	{
		$sql[] = $sql_post[$i] ;
	}

	if ( DB_TYPE == 'mssql' )
	{
//		$sql[] = 'COMMIT GO' ;
	}

	return $sql ;
}


// create a table
function handle_create_table( $command, &$error)
{
	// creating a table, just make sure the subaction is a "("
	if ($command['subaction'] != '(')
	{
		$error = FATAL_ERROR_MSG . "subaction '" . $command['subaction'] . "' unknown; expected '('" ;
		return ;
	}


	// each column is delimited by a , so let's break 'em out
	$fields = explode(',', $command['params']) ;

	// loop through all the columns and assemble our paramaters
	$params = array() ;
	for ($i=0; $i<count($fields); $i++)
	{
		// store the column data for each column
		$field = trim($fields[$i]) ;
		$params[] = parse_field( $field, $error) ;

		// get out if there is an error
		if ($error != '')
		{
			return ;
		}
	}

	// set the command line
	$target = (DB_TYPE == 'mssql') ? '[' . $command['target'] . ']' : $command['target'] ;
	$line_start = 'CREATE TABLE ' . $target . ' ( ' ;

	// now generate the complete SQL lines
	$sql = assemble_sql_lines( $params, $command, $line_start, true) ;

	return $sql ;
}


// add a column
function handle_column_add( $command, &$error)
{
	// each column is delimited by a , so let's break 'em out
	$fields = explode(',', $command['params']) ;

	// loop through all the columns and assemble our paramaters
	$params = array() ;
	for ($i=0; $i<count($fields); $i++)
	{
		// need to stip off leading ADD on additional lines
		$field = trim($fields[$i]) ;
		if (substr($field, 0, 4) == 'ADD ')
		{
			$field = trim(substr($field, 4)) ;
		}

		// store the column data for each column
		$params[] = parse_field( $field, $error) ;

		// get out if there is an error
		if ($error != '')
		{
			return ;
		}
	}


	// for mssql, add the defaults
	if ( DB_TYPE == 'mssql' )
	{
		$alter_line = $command['action'] . ' ' . $command['type'] . ' [' . $command['target'] . '] WITH NOCHECK ADD ' ;
	}
	else
	{
		$alter_line = $command['action'] . ' ' . $command['type'] . ' ' . $command['target'] . ' ' . $command['subaction'] . ' ' ;
	}

	// now generate the complete SQL lines
	$sql = assemble_sql_lines( $params, $command, $alter_line, false) ;

	return $sql ;
}


// modify a column
function handle_column_modify( $command, &$error)
{
	// GENERAL NOTES: only one field can be modified at a time as I understand mysql, so that's all that is allow here
	//	also note that, again as I far as I understand mysql, anything that is not specified will be overwritten
	//	with default params, so I will be supplying defaults too;  so if something was UNSIGNED or had a default of 'x'
	//	and then you neglect to include these, they will be wiped out.


	$fields = explode(',', $command['params']) ;

	$params = array() ;
	for ($i=0; $i<count($fields); $i++)
	{
		// store the column data for each column
		$field = trim($fields[$i]) ;
		$params[] = parse_field( $field, $error) ;

		// get out if there is an error
		if ($error != '')
		{
			return ;
		}
	}


	// for mssql, add the defaults
	$action = $command['action'] ;
	$type = $command['type'] ;
	$target = $command['target'] ;
	if ( DB_TYPE == 'mssql' )
	{
		$alter_line = "$action $type [$target] ALTER COLUMN " ;
	}
	else if ( (DB_TYPE == 'msaccess') || (DB_TYPE == 'postgresql'))
	{
		$alter_line = "$action $type $target ALTER COLUMN " ;
	}
	else
	{
		$alter_line = "$action $type $target MODIFY " ;
	}

	// now generate the complete SQL lines
	$sql = assemble_sql_lines( $params, $command, $alter_line, false) ;

	return $sql ;
}


// drop a column
function handle_column_drop( $command, &$error)
{
	$sql = array() ;
	$params = explode(' ', trim($command['params'])) ;

	// primary line
	$line = $command['action'] . ' ' . $command['type'] . ' ' . $command['target'] . ' ' . $command['subaction'] ;

	// get the column to drop (remember that we've already stripped off any trailing semicolon)
	$param1 = (isset($params[0])) ? $params[0] : '' ;
	$param2 = (isset($params[1])) ? $params[1] : '' ;

	// syntax is "COLUMN xxx"
	if ((strtoupper($param1) == 'COLUMN') && ( $param2 != ''))
	{
		$sql[] = "$line COLUMN $param2 " ;
	}

	// they didn't have "COLUMN" in the syntax
	else if ((strtoupper($param1) != 'COLUMN') && ( $param1 != '') && ( $param2 == ''))
	{
		$sql[] = "$line COLUMN $param1 " ;
	}

	// otherwise I don't know what the heck they are trying to do!
	else
	{
		$error = FATAL_ERROR_MSG . $lang['EM_malformed_DROP'] . " [$param1][$param2]" ;
		return ;
	}


	// can't drop a field in postgresql b/c i don't feel comfortable dropping and recreating the table yet
	if ( DB_TYPE == 'postgresql')
	{
		$line = trim($sql[0]) ;
		$sql = array() ;
		$sql[] = sprintf($lang['EM_postgresql_ABORTED'],$line);
	}

	return $sql ;
}




// get the basic command and then farm out the work to subprocedures; returns an array of SQL to be executed
function handle_db_alteration( $message, &$error )
{
	global $table_prefix ;
	$return_sql = array() ;
	$error = '' ;

	// parse out commands from each other; this is a bit tricky since we are wanting things to be white space independent
	//   we signify the end of a command if the line ends with a semicolon, or if it is the end of text;  you cannot
	//   have two commands on the same line... but what good coder does that anyway ;-)
	$lines = explode("\n", trim(stripslashes($message))) ;
	$command_list = array() ;
	$command_line = '' ;
	for ($i=0; $i<count($lines); $i++)
	{
		// if this is an empty line then don't do anything with it
		$line = trim($lines[$i]) ;
		if ($line == '')
		{
			continue ;
		}

		// add this line to the command line we are building
		$command_line .= ($command_line == '') ? $line : " $line" ;

		// if the line ends with a ; then we've got a completed line
		if ( $command_line[(strlen($command_line)-1)] == ';')
		{
			// add it to our list, but strip off the trailing ;
			$command_list[] = trim(substr($command_line, 0, strlen($command_line)-1)) ;
			$command_line = '' ;
		}
	}

	// catch case when last line doesn't end with a ;
	if ($command_line != '')
	{
		$command_list[] = $command_line ;
	}


	// loop through the commands and build DB specific SQL
	for ($comm=0; $comm<count($command_list); $comm++)
	{
		$sql = array();
		$message = trim($command_list[$comm]) ;


		//// get the SQL command primary attributes
		// action 	 = create		drop		alter
		// type 	 = table		table		table
		// target 	 = mytable		mytable	mycolumn
		// subaction = (					add, modify, drop
		$attributes = explode(' ', $message) ;
		$action = (isset($attributes[0])) ? strtoupper($attributes[0]) : '' ;
		$type = (isset($attributes[1])) ? $attributes[1] : '' ;
		$target = (isset($attributes[2])) ? $attributes[2] : '' ;
		$subaction = (isset($attributes[3])) ? strtoupper($attributes[3]) : '' ;

		// adjust for case when creating table and they have first field abbutting a ( ... seperate with a space
		if ((strstr( $subaction, '(')) && ($subaction != '('))
		{
			$pos = strpos($message, '(') ;
			$message = substr($message, 0, $pos+1) . ' ' . substr($message, $pos+1) ;
			$attributes = explode(' ', $message) ;

			// reassign the subaction
			$subaction = (isset($attributes[3])) ? $attributes[3] : '' ;
		}

		// extract the remainder of the command and prepare to process it
		$remainder = '' ;
		if ($subaction != '')
		{
			// if the table name is "add", "modify", or "drop" then there will probably be a problem
			$len = strpos( $message, $subaction) + strlen($subaction);
			$remainder = trim(substr($message, $len)) ;
		}

		// make sure the target is not null
		if ($target == '')
		{
			$error = FATAL_ERROR_MSG . $lang['EM_malformed_sql'] ;
		}

		// do some handwaving
		$target = ($action == 'UPDATE') ? $type : $target ;
		$type = strtoupper($type) ;

		// sometimes when copying from phpMyAdmin we'll get these ` characters... strip them out
		$target = str_replace("`", "", $target) ;

		// handle case if phpbb_ is already in the target; a little quality control ;-)
		$target = (substr($target, 0, 6) == 'phpbb_') ? $table_prefix . substr($target, 6) : $table_prefix . $target ;


		// start with the type, b/c it always has to be "TABLE"
		if (($type != 'TABLE') && (($action != 'INSERT') && ($action != 'UPDATE')))
		{
			$error = FATAL_ERROR_MSG . sprintf($lang['EM_type_unknown'],$type) ;
		}


		// store info in a nice array to pass around
		$command = array(
			'action' => $action,
			'type' => $type,
			'target' => $target,
			'subaction' => $subaction,
			'params' => $remainder) ;


		// if we have an error, then skip this
		if ($error != '')
		{
			// do nothing
		}

		// get a valid action and then parse from there
		else if ($action == 'CREATE')
		{
			$sql = handle_create_table( $command, $error) ;
		}

		// manipulate columns
		else if ($action == 'ALTER')
		{
			// add a field
			if ( $subaction == 'ADD')
			{
				$sql = handle_column_add( $command, $error) ;
			}

			// modify a field
			else if ( $subaction == 'MODIFY')
			{
				$sql = handle_column_modify( $command, $error) ;
			}

			// drop a field
			else if ( $subaction == 'DROP')
			{
				$sql = handle_column_drop( $command, $error) ;
			}

			// wtf?
			else
			{
				$error = FATAL_ERROR_MSG . sprintf($lang['EM_subaction_unknown'],$subaction) ;
			}
		}

		// drop a table
		else if ($action == 'DROP')
		{
			if ( count($attributes) > 3)
			{
				$error = FATAL_ERROR_MSG . $lang['EM_malformed_DROP2'] ;
			}
			$sql[] = "$action $type $target" ;
		}

		// we'll let phpBB DBAL handle INSERT and UPDATE
		else if (($action == 'INSERT') || ($action == 'UPDATE'))
		{
			// we need to rebuild the line with the correct table name
			$line = '' ;
			for ($i=0; $i<count($attributes); $i++)
			{
				if ((($action == 'INSERT') && ($i == 2)) || (($action == 'UPDATE') && ($i == 1)))
				{
					$line .= " $target" ;
				}
				else
				{
					$line .= ($line == '') ? $attributes[$i] : (' ' . $attributes[$i]) ;
				}
			}

			$sql[] = $line ;
		}

		// blah!
		else
		{
			$error = FATAL_ERROR_MSG . sprintf($lang['EM_unknown_action'],$action) ;
		}


		// if we've got an error, then make like a baby and head out
		if ($error != '')
		{
			$error .= "<br /><br />".$lang['EM_SQL_line']."<br />$message" ;
			return ;
		}

		// add the sql lines for this command into the overall list
		for ($i=0; $i<count($sql); $i++)
		{
			$return_sql[] = $sql[$i] ;
		}
	}

	return $return_sql ;
}

?>