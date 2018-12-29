<?php
// <$ID=19258851,REV=0001$>
// +---------------+-------------------------------+-----------+
// | IntegraMOD v1 |    © 2005 IntegraMOD Group    |  {1.4.0}  |
// +---------------+-------------------------------+-----------+
// | Filename      | constants.php                             |
// | Created By    | phpBB Group                               |
// | Created On    | February 13, 2001                         |
// | Copyright     | © 2005 phpBB Group                        |
// | License       | GNU-GPL v2 [http://gpl.integramod.org]    |
// +---------------+-------------------------------------------+
// |      DO NOT MODIFY/REMOVE ANTHING ABOVE THIS LINE!!!      |
// +-----------------------------------------------------------+

// *************************************************************
// ****************** Begin Protecting Script ******************
// *************************************************************
/*
if (!defined('IM_LOADER') or !IM_LOADER or !defined('IM_GLOBALS') or !IM_GLOBALS)
{
	die('<p><strong>Access Denied:</strong> This file ('.basename(__FILE__).') cannot be accessed directly.</p>');
}
*/

// *************************************************************
// ******************* Set Global Constants ********************
// *************************************************************
if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
	exit;
}
define('DEBUG', 1);

// Mighty Gorgon - Full Album Pack - BEGIN
include($phpbb_root_path . 'album_mod/album_constants.' . $phpEx);
define('LOGIN_MG', 'login.' . $phpEx);
// Mighty Gorgon - Full Album Pack - END

// ### Account Activation Settings ###
define('USER_ACTIVATION_NONE', 0);
define('USER_ACTIVATION_SELF', 1);
define('USER_ACTIVATION_ADMIN', 2);

// ### Auth Settings ###
define('AUTH_LIST_ALL', 0);
define('AUTH_ALL', 0);
// --------------------
define('AUTH_REG', 1);
define('AUTH_ACL', 2);
define('AUTH_MOD', 3);
define('AUTH_ADMIN', 5);
// --------------------
define('AUTH_VIEW', 1);
define('AUTH_READ', 2);
define('AUTH_POST', 3);
define('AUTH_REPLY', 4);
define('AUTH_EDIT', 5);
define('AUTH_DELETE', 6);
define('AUTH_ANNOUNCE', 7);
define('AUTH_STICKY', 8);
define('AUTH_POLLCREATE', 9);
define('AUTH_VOTE', 10);
define('AUTH_ATTACH', 11);
define('AUTH_DELAYEDPOST', 12);
define('AUTH_CAL', 20);
define('AUTH_GLOBAL_ANNOUNCE', 21);
define('AUTH_PAID_VIEW', 25);

// ### Data Tables ###
define('ACCT_HIST_TABLE', $table_prefix.'account_hist');
define('ACRONYMS_TABLE', $table_prefix.'acronyms');
define('ADMIN_PM_TABLE', $table_prefix.'admin_pm');
define('APPROVE_FORUMS_TABLE', $table_prefix.'approve_forums');
define('APPROVE_POSTS_TABLE', $table_prefix.'approve_posts');
define('APPROVE_TOPICS_TABLE', $table_prefix.'approve_topics');
define('APPROVE_USERS_TABLE', $table_prefix.'approve_users');
define('AUTH_ACCESS_TABLE', $table_prefix.'auth_access');
define('BANNER_STATS_TABLE', $table_prefix.'banner_stats');
define('BANNERS_TABLE', $table_prefix.'banner');
define('BANLIST_TABLE', $table_prefix.'banlist');
define('BLOCK_POSITION_TABLE', $table_prefix.'block_position');
define('BLOCK_VARIABLE_TABLE', $table_prefix.'block_variable');
define('BLOCKS_TABLE', $table_prefix.'blocks');
define('BOOKMARK_TABLE', $table_prefix.'bookmarks');
define('BUDDY_TABLE', $table_prefix.'contact_list');
define('BUDDYS_TABLE', $table_prefix.'buddy');
define('CATEGORIES_TABLE', $table_prefix.'categories');
define('CONFIG_TABLE', $table_prefix.'config');
define('CAPTCHA_CONFIG_TABLE', $table_prefix.'captcha_config');
define('CONFIRM_TABLE', $table_prefix.'confirm');
define('CONTACT_TABLE', $table_prefix.'contact_list');
define('DIGEST_FORUMS_TABLE', $table_prefix.'digest_forums');
define('DIGEST_TABLE', $table_prefix.'digest');
define('DISALLOW_TABLE', $table_prefix.'disallow');
//define('DISALLOW_TABLE', $table_prefix.'contact_list'); // Which to use? constants_contact.php
define('FORUM_TOUR_TABLE', $table_prefix.'forum_tour');
define('FORUMS_TABLE', $table_prefix.'forums');
define('GROUPS_TABLE', $table_prefix.'groups');
define('HACKS_LIST_TABLE', $table_prefix.'hacks_list');
define('IGNORE_TABLE', $table_prefix.'contact_list');
define('IM_CONFIG_TABLE', $table_prefix.'im_config');
define('IM_PREFS_TABLE', $table_prefix.'im_prefs');
define('IM_SITES_TABLE', $table_prefix.'im_sites');
define('IM_SESSIONS_TABLE', $table_prefix.'im_sessions');
define('JR_ADMIN_TABLE', $table_prefix.'jr_admin_users');
define('LAYOUT_TABLE', $table_prefix.'layout');
define('LINK_CATEGORIES_TABLE', $table_prefix.'link_categories');
define('LINK_CONFIG_TABLE', $table_prefix.'link_config');
define('LINKS_TABLE', $table_prefix.'links');
define('NEWS_TABLE', $table_prefix.'news');
define('OPTIMIZE_DB_TABLE', $table_prefix.'optimize_db');
define('PORTAL_CONFIG_TABLE', $table_prefix.'portal_config');
define('POSTS_TABLE', $table_prefix.'posts');
define('POSTS_TEXT_TABLE', $table_prefix.'posts_text');
define('PRIVMSGS_IGNORE_TABLE', $table_prefix.'privmsgs_ignore');
define('PRIVMSGS_TABLE', $table_prefix.'privmsgs');
define('PRIVMSGS_TEXT_TABLE', $table_prefix.'privmsgs_text');
define('PRUNE_TABLE', $table_prefix.'forum_prune');
define('RANKS_TABLE', $table_prefix.'ranks');
define('REFERERS_TABLE', $table_prefix.'referers');
define('RULES_TABLE', $table_prefix.'rules');
define('SEARCH_MATCH_TABLE', $table_prefix.'search_wordmatch');
define('SEARCH_TABLE', $table_prefix.'search_results');
define('SEARCH_WORD_TABLE', $table_prefix.'search_wordlist');
define('SESSIONS_TABLE', $table_prefix.'sessions');
define('SESSIONS_KEYS_TABLE', $table_prefix.'sessions_keys');
define('SHOUTBOX_TABLE', $table_prefix.'shout');
define('SMILIES_TABLE', $table_prefix.'smilies');
define('SUBSCRIPTIONS_TABLE', $table_prefix.'mod_subscriptions');
define('SUBSCRIBED_FORUMS_TABLE', $table_prefix.'mod_subscribed_forums');
define('THEMES_NAME_TABLE', $table_prefix.'themes_name');
define('THEMES_TABLE', $table_prefix.'themes');
define('TOPICS_TABLE', $table_prefix.'topics');
define('TOPICS_WATCH_TABLE', $table_prefix.'topics_watch');
define('USER_GROUP_TABLE', $table_prefix.'user_group');
define('USERS_TABLE', $table_prefix.'users');
define('VOTE_DESC_TABLE', $table_prefix.'vote_desc');
define('VOTE_RESULTS_TABLE', $table_prefix.'vote_results');
define('VOTE_USERS_TABLE', $table_prefix.'vote_voters');
// Mighty Gorgon - Full Album Pack - BEGIN
define('ALBUM_TABLE', $table_prefix.'album');
define('ALBUM_CAT_TABLE', $table_prefix.'album_cat');
define('ALBUM_CONFIG_TABLE', $table_prefix.'album_config');
define('ALBUM_COMMENT_TABLE', $table_prefix.'album_comment');
define('ALBUM_RATE_TABLE', $table_prefix.'album_rate');
// Mighty Gorgon - Full Album Pack - END
define('WORDS_TABLE', $table_prefix.'words');
define('WPM', $table_prefix.'wpm');
// BEGIN CrackerTracker v5.x
define('CTRACKER_CONFIG', $table_prefix . 'ctracker_config');
define('CTRACKER_IPBLOCKER', $table_prefix . 'ctracker_ipblocker');
define('CTRACKER_LOGINHISTORY', $table_prefix . 'ctracker_loginhistory');
define('CTRACKER_FILECHK', $table_prefix . 'ctracker_filechk');
define('CTRACKER_FILESCANNER', $table_prefix . 'ctracker_filescanner');
define('CTRACKER_BACKUP', $table_prefix . 'ctracker_backup');
// END CrackerTracker v5.x
//-- mod : advanced report hack
//-- add
define('REPORTS_TABLE', $table_prefix.'reports');
define('REPORTS_CHANGES_TABLE', $table_prefix.'reports_changes');
define('REPORTS_MODULES_TABLE', $table_prefix.'reports_modules');
define('REPORTS_REASONS_TABLE', $table_prefix.'reports_reasons');
//-- fin mod : advanced report hack

// ### Database Connection ###
define('BEGIN_TRANSACTION', 1);
define('END_TRANSACTION', 2);

// ### Error Codes ###
define('GENERAL_MESSAGE', 200);
define('GENERAL_ERROR', 202);
define('CRITICAL_MESSAGE', 203);
define('CRITICAL_ERROR', 204);

// ### Group Settings ###
define('GROUP_OPEN', 0);
define('GROUP_CLOSED', 1);
define('GROUP_HIDDEN', 2);
define('GROUP_AUTO', 3);
define('GROUP_PAYMENT', 4);

// ### Page Numbers for Session Handling ###
define('PAGE_INDEX', 0);
define('PAGE_LOGIN', -1);
define('PAGE_SEARCH', -2);
define('PAGE_REGISTER', -3);
define('PAGE_PROFILE', -4);
define('PAGE_VIEWONLINE', -6);
define('PAGE_VIEWMEMBERS', -7);
define('PAGE_FAQ', -8);
define('PAGE_POSTING', -9);
define('PAGE_PRIVMSGS', -10);
define('PAGE_GROUPCP', -11);
define('PAGE_FORUM_TOUR', -12);
define('PAGE_PORTAL', -13);
define('PAGE_CARD', -14);
define('PAGE_RULES', -15);
define('PAGE_COOKIES', -16);
define('PAGE_STAFF', -17);
define('PAGE_LINKS', -18);
define('PAGE_DOWNLOAD', -19);
define('PAGE_REDIRECT', -1031);
define('PAGE_SHOUTBOX_MAX', -1035);
define('PAGE_SHOUTBOX', -1035);
define('PAGE_CONTACT', -8050);
define('PAGE_PRILLIAN', -8051);
define('PAGE_TOPIC_OFFSET', 5000);

// ### Post Types ###
define('POST_NORMAL', 0);
define('POST_STICKY', 1);
define('POST_ANNOUNCE', 2);
define('POST_GLOBAL_ANNOUNCE', 3);
define('POST_BIRTHDAY', 9);
define('POST_CALENDAR', 10);
define('POST_PICTURE', 11);
define('POST_ATTACHMENT', 11);

// ### Prillian Constants ###
// prillian installed?
if (defined('PRILLIAN_INSTALLED')){
define('ALLOW_BUDDY_SELF', false);
define('CONTACT_PATH', $phpbb_root_path.'mods/contact/');
define('CONTACT_URL', $phpbb_root_path.'contact.'.$phpEx);
define('IM_NEW_MAIL', 6);
define('IM_READ_MAIL', 7);
define('IM_UNREAD_MAIL', 8);
define('OFF_SITE', -2);
define('OFF_SITE_USERS_URL', 'u');
define('OFF_SITE_POST_URL', 'p');
define('PRILL_PATH', $phpbb_root_path.'mods/prillian/');
define('PRILL_URL', $phpbb_root_path.'imclient.'.$phpEx);
define('MAIN_MODE', 1);
define('WIDE_MODE', 2);
define('MINI_MODE', 3);
define('FRAMES_MODE', 4);
define('NO_FRAMES_MODE', 5);
}

// ### Private Message System ###
define('PRIVMSGS_READ_MAIL', 0);
define('PRIVMSGS_NEW_MAIL', 1);
define('PRIVMSGS_SENT_MAIL', 2);
define('PRIVMSGS_SAVED_IN_MAIL', 3);
define('PRIVMSGS_SAVED_OUT_MAIL', 4);
define('PRIVMSGS_UNREAD_MAIL', 5);

// ### Session Parameters ###
define('SESSION_METHOD_COOKIE', 100);
define('SESSION_METHOD_GET', 101);

// ### Software Status ###
define('FORUM_UNLOCKED', 0);
define('FORUM_LOCKED', 1);

// ### Topic Status ###
define('TOPIC_UNLOCKED', 0);
define('TOPIC_LOCKED', 1);
define('TOPIC_MOVED', 2);
define('TOPIC_WATCH_NOTIFIED', 1);
define('TOPIC_WATCH_UN_NOTIFIED', 0);

// ### URL Parameters ###
define('POST_TOPIC_URL', 't');
define('POST_CAT_URL', 'c');
define('POST_FORUM_URL', 'f');
define('POST_USERS_URL', 'u');
define('POST_POST_URL', 'p');
define('POST_GROUPS_URL', 'g');

//-- mod : advanced report hack
//-- add
define('POST_REPORT_URL', 'r');
define('POST_REPORT_REASON_URL', 'r');
//-- fin mod : advanced report hack


// ### User Avatar Settings ###
define('USER_AVATAR_NONE', 0);
define('USER_AVATAR_UPLOAD', 1);
define('USER_AVATAR_REMOTE', 2);
define('USER_AVATAR_GALLERY', 3);

// ### User Levels ###
define('DELETED', -1);
define('ANONYMOUS', -1);
define('USER', 0);
define('ADMIN', 1);
define('MOD', 2);
define('JADMIN', 7);
define('ADMIN_FOUNDER', 99);
define('GUEST_ONLY', 1000);

// ### Special Constants ###
define('NO', 0);
define('YES', 1);
define('FRIEND_ONLY',2);
define('UNKNOWN', 0);
define('MALE', 1);
define('FEMALE', 2);
define('VIP_RANK_TITLE', 'VIP');
define('OVERIDE_THEME', false);
define('DIGEST_THEME', 1);
define('DIGEST_LOGGING', true);
define('DIGEST_SUPPORT', "http://www.phpbb.com/phpBB/viewtopic.php?t=187868");
define('DIGEST_HTML', 1);
define('DIGEST_TEXT', 0);

//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
define('CATEGORIES_HIERARCHY_INSTALLED', true);
//-- fin mod : categories hierarchy ----------------------------------------------------------------

define('THEMES_SELECT_INFO_TABLE', $table_prefix.'themes_select_info');

//-- mod : advanced report hack
//-- add
// Report status constants
define('REPORT_NEW', 0);
define('REPORT_OPEN', 1);
define('REPORT_IN_PROCESS', 2);
define('REPORT_CLEARED', 3);
define('REPORT_DELETE', 4);


// Report authorisation constants
define('REPORT_AUTH_USER', 0);
define('REPORT_AUTH_MOD', 1);
define('REPORT_AUTH_CONFIRM', 2);
define('REPORT_AUTH_ADMIN', 3);


// Report notification constants
define('REPORT_NOTIFY_NEW', 1);
define('REPORT_NOTIFY_CHANGE', 2);

//-- fin mod : advanced report hack