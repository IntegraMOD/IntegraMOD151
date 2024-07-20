<?php
/***************************************************************************
 *                              admin_meta_tags.php
 *                            -------------------
 *   begin                : Thursday, 11/10/2004
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 ***************************************************************************/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['General']['Meta_tags_title'] = $file;
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'includes/functions_selects.'.$phpEx);

//
// Pull all config data
//
$sql = "SELECT *
	FROM " . CONFIG_TABLE;
if(!$result = $db->sql_query($sql))
{
	message_die(CRITICAL_ERROR, "Could not query config information in admin_meta_tags", "", __LINE__, __FILE__, $sql);
}
else
{
	while( $row = $db->sql_fetchrow($result) )
	{
		$config_name = $row['config_name'];
		$config_value = $row['config_value'];
		$default_config[$config_name] = isset($_POST['submit']) ? str_replace("'", "\'", $config_value) : $config_value;
		
		$new[$config_name] = ( isset($_POST[$config_name]) ) ? $_POST[$config_name] : $default_config[$config_name];

		if ($config_name == 'cookie_name')
		{
			$cookie_name = str_replace('.', '_', $new['cookie_name']);
		}

		if( isset($_POST['submit']) )
		{
			$sql = "UPDATE " . CONFIG_TABLE . " SET
				config_value = '" . str_replace("\'", "''", $new[$config_name]) . "'
				WHERE config_name = '$config_name'";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Failed to update general configuration for $config_name", "", __LINE__, __FILE__, $sql);
			}
		}
	}

	if( isset($_POST['submit']) )
	{
		$message = $lang['Config_updated'] . "<br /><br />" . sprintf($lang['Click_return_admin_meta_tags'], "<a href=\"" . append_sid("admin_meta_tags.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);
	}
}

$template->set_filenames(array(
	"body" => "admin/meta_tags_body.tpl")
);

//
// Escape any quotes in the site description for proper display in the text
// box on the admin page 
//
$new['site_desc'] = str_replace('"', '&quot;', $new['site_desc']);
$new['sitename'] = str_replace('"', '&quot;', strip_tags($new['sitename']));
$template->assign_vars(array(
	"L_META_TAGS_TITLE" => $lang['Meta_tags_title'],
	"L_META_TAGS_TITLE_EXPLAIN" => $lang['Meta_tags_title_explain'],
	"L_SUBMIT" => $lang['Submit'],
	"L_RESET" => $lang['Reset'],
	"L_META_PARAMETERS" => $lang['Meta_parameters'],
	"L_META_PARAMETERS_EXPLAIN" => $lang['Meta_parameters_explain'],
	"L_META_KEYWORDS" => $lang['Meta_keywords'],
	"L_META_KEYWORDS_EXPLAIN" => $lang['Meta_keywords_explain'],
	"L_META_DESCRIPTION" => $lang['Meta_description'],
	"L_META_DESCRIPTION_EXPLAIN" => $lang['Meta_description_explain'],
	"L_META_AUTHOR" => $lang['Meta_author'],
	"L_META_AUTHOR_EXPLAIN" => $lang['Meta_author_explain'],
	"L_META_IDENTIFIER_URL" => $lang['Meta_identifier_url'],
	"L_META_IDENTIFIER_URL_EXPLAIN" => $lang['Meta_identifier_url_explain'],
	"L_META_REPLY_TO" => $lang['Meta_reply_to'],
	"L_META_REPLY_TO_EXPLAIN" => $lang['Meta_reply_to_explain'],
	"L_META_REVISIT_AFTER" => $lang['Meta_revisit_after'],
	"L_META_REVISIT_AFTER_EXPLAIN" => $lang['Meta_revisit_after_explain'],
	"L_META_CATEGORY" => $lang['Meta_category'],
	"L_META_CATEGORY_EXPLAIN" => $lang['Meta_category_explain'],
	"L_META_GENERATOR" => $lang['Meta_generator'],
	"L_META_GENERATOR_EXPLAIN" => $lang['Meta_generator_explain'],
	"L_META_COPYRIGHT" => $lang['Meta_copyright'],
	"L_META_COPYRIGHT_EXPLAIN" => $lang['Meta_copyright_explain'],
	"L_META_ROBOTS" => $lang['Meta_robots'],
	"L_META_ROBOTS_EXPLAIN" => $lang['Meta_robots_explain'],
	"L_META_DISTRIBUTION" => $lang['Meta_distribution'],
	"L_META_DISTRIBUTION_EXPLAIN" => $lang['Meta_distribution_explain'],
	"L_META_DATE_CREATION" => $lang['Meta_date_creation'],
	"L_META_DATE_CREATION_EXPLAIN" => $lang['Meta_date_creation_explain'],
	"L_META_DATE_REVISION" => $lang['Meta_date_revision'],
	"L_META_DATE_REVISION_EXPLAIN" => $lang['Meta_date_revision_explain'],
	"L_META_DAY" => $lang['Meta_day'],
	"L_META_MONTH" => $lang['Meta_month'],
	"L_META_YEAR" => $lang['Meta_year'],
	"L_META_HTTP_EQUIV_PARAMETERS" => $lang['Meta_http_equiv_parameters'],
	"L_META_HTTP_EQUIV_PARAMETERS_EXPLAIN" => $lang['Meta_http_equiv_parameters_explain'],
	"L_META_REFRESH" => $lang['Meta_refresh'],
	"L_META_REFRESH_EXPLAIN" => $lang['Meta_refresh_explain'],
	"L_META_REDIRECT_URL" => $lang['Meta_redirect_url'],
	"L_META_REDIRECT_URL_EXPLAIN" => $lang['Meta_redirect_url_explain'],
	"L_META_REDIRECT_URL_TIME" => $lang['Meta_redirect_url_time'],
	"L_META_REDIRECT_URL_ADRESS" => $lang['Meta_redirect_url_adress'],
	"L_META_PRAGMA" => $lang['Meta_pragma'],
	"L_META_PRAGMA_EXPLAIN" => $lang['Meta_pragma_explain'],
	"L_META_LANGUAGE" => $lang['Meta_language'],
	"L_META_LANGUAGE_EXPLAIN" => $lang['Meta_language_explain'],
	
	"META_KEYWORDS" => $new['meta_keywords'],
	"META_DESCRIPTION" => $new['meta_description'],
	"META_AUTHOR" => $new['meta_author'],
	"META_IDENTIFIER_URL" => $new['meta_identifier_url'],
	"META_REPLY_TO" => $new['meta_reply_to'],
	"META_REVISIT_AFTER" => $new['meta_revisit_after'],
	"META_CATEGORY" => $new['meta_category'],
	"META_GENERATOR" => $new['meta_generator'],
	"META_COPYRIGHT" => $new['meta_copyright'],
	"META_ROBOTS" => $new['meta_robots'],
	"META_DISTRIBUTION" => $new['meta_distribution'],
	"META_DATE_CREATION" => ( isset($new['meta_date_creation']) ? $new['meta_date_creation'] : '' ) ,
	"META_DATE_CREATION_DAY" => $new['meta_date_creation_day'],
	"META_DATE_CREATION_MONTH" => $new['meta_date_creation_month'],
	"META_DATE_CREATION_YEAR" => $new['meta_date_creation_year'],
	"META_DATE_REVISION" => ( isset($new['meta_date_revision']) ? $new['meta_date_revision'] : '' ) ,
	"META_DATE_REVISION_DAY" => $new['meta_date_revision_day'],
	"META_DATE_REVISION_MONTH" => $new['meta_date_revision_month'],
	"META_DATE_REVISION_YEAR" => $new['meta_date_revision_year'],
	"META_REFRESH" => $new['meta_refresh'],
	"META_REDIRECT_URL_TIME" => $new['meta_redirect_url_time'],
	"META_REDIRECT_URL_ADRESS" => $new['meta_redirect_url_adress'],
	"META_PRAGMA" => $new['meta_pragma'],
	"META_LANGUAGE" => $new['meta_language'])
);

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>
