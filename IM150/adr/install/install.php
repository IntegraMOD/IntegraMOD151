<?php
define('DBMS', 'mysqli'); // V: no point making that configurable as of now...
set_time_limit(200);
error_reporting(-1); // this is a dev script

// Begin main prog
define('IN_PHPBB', true);
$phpbb_root_path = './../../';
$phpEx = 'php';
if (file_exists(realpath($phpbb_root_path.'config.'.$phpEx)))
{
	include($phpbb_root_path.'config.'.$phpEx);
}
else
{
	exit('Cannot install AD&R if IntegraMOD is not installed yet: '.realpath($phpbb_root_path.'config.'.$phpEx));
}
include($phpbb_root_path.'extension.inc');

// Initialise some basic arrays
$userdata = array();
$lang = array();
$error = false;

// Include some required functions
include($phpbb_root_path.'includes/constants.'.$phpEx);
include($phpbb_root_path.'includes/functions.'.$phpEx);
include($phpbb_root_path.'includes/sessions.'.$phpEx);

$available_dbms = array(
	'mysqli' => array(
		'LABEL'			=> 'MySQLi',
		'SCHEMA'		=> 'mysql',
		'DELIM'			=> ';',
		'DELIM_BASIC'	=> ';',
		'COMMENTS'		=> 'remove_remarks'
	),
);

$schema = $available_dbms[$dbms]['SCHEMA'];
$adr_install_root = $phpbb_root_path.'adr/install/';
$dbms_schema = $adr_install_root.$schema . '_schema.sql';
$dbms_basic = $adr_install_root.$schema . '_basic.sql';

$remove_remarks = $available_dbms[$dbms]['COMMENTS'];;
$delimiter = $available_dbms[$dbms]['DELIM'];
$delimiter_basic = $available_dbms[$dbms]['DELIM_BASIC'];
// Load in the DB
include($phpbb_root_path.'includes/db.'.$phpEx);
// Load in the sql parser
include($phpbb_root_path.'includes/sql_parse.'.$phpEx);

// Ok we have the db info go ahead and read in the relevant schema
// and work on building the table.. probably ought to provide some
// kind of feedback to the user as we are working here in order
// to let them know we are actually doing something.
$sql_query = fread(fopen($dbms_schema, 'r'), filesize($dbms_schema));
$sql_query = preg_replace('/phpbb_/', $table_prefix, $sql_query);

$sql_query = $remove_remarks($sql_query);
$sql_query = split_sql_file($sql_query, $delimiter);
if (empty($sql_query))
{
	exit('Could not fetch schema sql file');
}

$db->clear_cache('');
?><title>Ad-hoc AD&R install procedure</title>
<body><h1>This installs the AD&R module for IntegraMOD.</h1>
<h3>Schema:</h3>
<?php
$with_error = false;
echo '<ul>';
for ($i = 0; $i < sizeof($sql_query); $i++)
{
	if (trim($sql_query[$i]) != '')
	{
		if (!($result = $db->sql_query($sql_query[$i])))
		{
			$error = $db->sql_error();

			echo '<li><b style="color: RED;">ERROR:</b> <pre>'.$sql_query[$i].'
				
				
'.print_r($error, true).'</pre></li>';
		}
		else
		{
			echo '<li><b style="color: green;">OK:</b> <pre>'.$sql_query[$i].'</pre></li>';
		}
	}
}
echo '</ul>';
if ($with_error)
{
	echo '<h1 style="color: red;">Errors occured, stopping install</h1>';
	exit;
}

// Ok tables have been built, let's fill in the basic information
$sql_query = fread(fopen($dbms_basic, 'r'), filesize($dbms_basic));
$sql_query = preg_replace('/phpbb_/', $table_prefix, $sql_query);

$sql_query = $remove_remarks($sql_query);
$sql_query = split_sql_file($sql_query, $delimiter_basic);
if (empty($sql_query))
{
	exit('Could not fetch basic/data sql file');
}
?><h3>Data:</h3><?php
echo '<ul>';
for ($i = 0; $i < sizeof($sql_query); $i++)
{
	if (trim($sql_query[$i]) != '')
	{
		if (!($result = $db->sql_query($sql_query[$i])))
		{
			$error = $db->sql_error();

			echo '<li><b style="color: RED;">ERROR:</b> <pre>'.$sql_query[$i].'
				
				
'.print_r($error, true).'</pre></li>';
		}
		else
		{
			echo '<li><b style="color: green;">OK:</b> <pre>'.$sql_query[$i].'</pre></li>';
		}
	}
}
echo '</ul>';
if ($with_error)
{
	echo '<h1 style="color: red;">Errors occured, stopping install</h1>';
	exit;
}
?>
<h1 style="color: green;">Congratulations! AD&R is now installed on your board!</h1>
</body>
