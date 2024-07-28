# phpMyAdmin SQL Dump
# version 2.5.4
# http://www.phpmyadmin.net
#
# Host: localhost
# Generation Time: Aug 22, 2004 at 02:02 PM
# Server version: 4.0.16
# PHP Version: 4.3.7
# 
# Database : `phpbb`
# Dump by: masterdavid < http://www.integramod.com > (webmaster@integramod.com)
# 

# --------------------------------------------------------

#
# Table structure for table `phpbb_account_hist`
#

CREATE TABLE phpbb_account_hist (
  user_id mediumint(8) default '0',
  lw_post_id mediumint(8) default '0',
  lw_money float default '0',
  lw_plus_minus smallint(5) default '0',
  MNY_CURRENCY varchar(8) default '',
  lw_date int(11) default '0',
  comment varchar(255) default '',
  status varchar(64) default '',
  txn_id varchar(64) default '',
  lw_site varchar(10) default ''
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_acronyms`
#

CREATE TABLE phpbb_acronyms (
  acronym_id mediumint(9) NOT NULL auto_increment,
  acronym varchar(80) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  PRIMARY KEY  (acronym_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_admin_pm`
#

CREATE TABLE phpbb_admin_pm (
   admin_id int(10) default '0',
   admin_redirect_id int(10) default '0',
   admin_deny int(1) default '0'
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_cash`
#

CREATE TABLE phpbb_cash (
  cash_id smallint(6) NOT NULL auto_increment,
  cash_order smallint(6) NOT NULL default '0',
  cash_settings smallint(4) NOT NULL default '3313',
  cash_dbfield varchar(64) NOT NULL default '',
  cash_name varchar(64) NOT NULL default 'GP',
  cash_default int(11) NOT NULL default '0',
  cash_decimals tinyint(2) NOT NULL default '0',
  cash_imageurl varchar(255) NOT NULL default '',
  cash_exchange int(11) NOT NULL default '1',
  cash_perpost int(11) NOT NULL default '25',
  cash_postbonus int(11) NOT NULL default '2',
  cash_perreply int(11) NOT NULL default '25',
  cash_maxearn int(11) NOT NULL default '75',
  cash_perpm int(11) NOT NULL default '0',
  cash_perchar int(11) NOT NULL default '20',
  cash_allowance tinyint(1) NOT NULL default '0',
  cash_allowanceamount int(11) NOT NULL default '0',
  cash_allowancetime tinyint(2) NOT NULL default '2',
  cash_allowancenext int(11) NOT NULL default '0',
  cash_forumlist varchar(255) NOT NULL default '',
  PRIMARY KEY  (cash_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_cash_events`
#

CREATE TABLE phpbb_cash_events (
  event_name varchar(32) NOT NULL default '',
  event_data varchar(255) NOT NULL default '',
  PRIMARY KEY  (event_name)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_cash_exchange`
#

CREATE TABLE phpbb_cash_exchange (
  ex_cash_id1 int(11) NOT NULL default '0',
  ex_cash_id2 int(11) NOT NULL default '0',
  ex_cash_enabled int(1) NOT NULL default '0',
  PRIMARY KEY  (ex_cash_id1,ex_cash_id2)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_cash_groups`
#

CREATE TABLE phpbb_cash_groups (
  group_id mediumint(6) NOT NULL default '0',
  group_type tinyint(2) NOT NULL default '0',
  cash_id smallint(6) NOT NULL default '0',
  cash_perpost int(11) NOT NULL default '0',
  cash_postbonus int(11) NOT NULL default '0',
  cash_perreply int(11) NOT NULL default '0',
  cash_perchar int(11) NOT NULL default '0',
  cash_maxearn int(11) NOT NULL default '0',
  cash_perpm int(11) NOT NULL default '0',
  cash_allowance tinyint(1) NOT NULL default '0',
  cash_allowanceamount int(11) NOT NULL default '0',
  cash_allowancetime tinyint(2) NOT NULL default '2',
  cash_allowancenext int(11) NOT NULL default '0',
  PRIMARY KEY  (group_id,group_type,cash_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_cash_log`
#

CREATE TABLE phpbb_cash_log (
  log_id int(11) NOT NULL auto_increment,
  log_time int(11) NOT NULL default '0',
  log_type smallint(6) NOT NULL default '0',
  log_action varchar(255) NOT NULL default '',
  log_text varchar(255) NOT NULL default '',
  PRIMARY KEY  (log_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_easymod`
#

CREATE TABLE phpbb_easymod (
  mod_id mediumint(8) NOT NULL auto_increment,
  mod_title varchar(255) default '',
  mod_file varchar(255) default '',
  mod_version varchar(15) default '',
  mod_author_handle varchar(25) default '',
  mod_author_email varchar(100) default '',
  mod_author_name varchar(100) default '',
  mod_author_url varchar(100) default '',
  mod_description text,
  mod_process_date int(11) default '0',
  mod_phpBB_version varchar(15) default '',
  mod_processed_themes varchar(200) default '',
  mod_processed_langs varchar(200) default '',
  mod_files_edited mediumint(8) default '0',
  mod_tables_added mediumint(8) default '0',
  mod_tables_altered mediumint(8) default '0',
  mod_rows_inserted mediumint(8) default '0',
  PRIMARY KEY  (mod_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_easymod_processed_files`
#

CREATE TABLE phpbb_easymod_processed_files (
  mod_processed_file varchar(255) NOT NULL default '',
  mod_id mediumint(8) NOT NULL default '0'
);

# --------------------------------------------------------


#
# Table structure for table `phpbb_album`
#

CREATE TABLE phpbb_album (
  pic_id int(11) unsigned NOT NULL auto_increment,
  pic_filename varchar(255) NOT NULL default '',
  pic_thumbnail varchar(255) default NULL,
  pic_title varchar(255) NOT NULL default '',
  pic_desc text,
  pic_user_id mediumint(8) NOT NULL default '0',
  pic_username varchar(32) default NULL,
  pic_user_ip varchar(8) NOT NULL default '0',
  pic_time int(11) unsigned NOT NULL default '0',
  pic_cat_id mediumint(8) unsigned NOT NULL default '1',
  pic_view_count int(11) unsigned NOT NULL default '0',
  pic_lock tinyint(3) NOT NULL default '0',
  pic_approval tinyint(3) NOT NULL default '1',
  PRIMARY KEY  (pic_id),
  KEY pic_cat_id (pic_cat_id),
  KEY pic_user_id (pic_user_id),
  KEY pic_time (pic_time)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_album_cat`
#

CREATE TABLE phpbb_album_cat (
  cat_id mediumint(8) unsigned NOT NULL auto_increment,
  cat_title varchar(255) NOT NULL default '',
  cat_desc mediumtext NOT NULL,
  cat_order mediumint(8) NOT NULL default '0',
  cat_view_level tinyint(3) NOT NULL default '-1',
  cat_upload_level tinyint(3) NOT NULL default '0',
  cat_rate_level tinyint(3) NOT NULL default '0',
  cat_comment_level tinyint(3) NOT NULL default '0',
  cat_edit_level tinyint(3) NOT NULL default '0',
  cat_delete_level tinyint(3) NOT NULL default '2',
  cat_view_groups varchar(255) default NULL,
  cat_upload_groups varchar(255) default NULL,
  cat_rate_groups varchar(255) default NULL,
  cat_comment_groups varchar(255) default NULL,
  cat_edit_groups varchar(255) default NULL,
  cat_delete_groups varchar(255) default NULL,
  cat_moderator_groups varchar(255) default NULL,
  cat_approval tinyint(3) NOT NULL default '0',
  cat_parent mediumint(8) unsigned default '0',
  cat_user_id mediumint(8) unsigned default '0',
  PRIMARY KEY  (cat_id),
  KEY cat_order (cat_order)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_album_comment`
#

CREATE TABLE phpbb_album_comment (
  comment_id int(11) unsigned NOT NULL auto_increment,
  comment_pic_id int(11) unsigned NOT NULL default '0',
  comment_cat_id int(11) NOT NULL default '0',
  comment_user_id mediumint(8) NOT NULL default '0',
  comment_username varchar(32) default NULL,
  comment_user_ip varchar(8) NOT NULL default '',
  comment_time int(11) unsigned NOT NULL default '0',
  comment_text text,
  comment_edit_time int(11) unsigned default NULL,
  comment_edit_count smallint(5) unsigned NOT NULL default '0',
  comment_edit_user_id mediumint(8) default NULL,
  PRIMARY KEY  (comment_id),
  KEY comment_pic_id (comment_pic_id),
  KEY comment_user_id (comment_user_id),
  KEY comment_user_ip (comment_user_ip),
  KEY comment_time (comment_time)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_album_config`
#

CREATE TABLE phpbb_album_config (
  config_name varchar(190) NOT NULL default '',
  config_value varchar(255) NOT NULL default '',
  PRIMARY KEY  (config_name)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_album_rate`
#

CREATE TABLE phpbb_album_rate (
  rate_pic_id int(11) unsigned NOT NULL default '0',
  rate_user_id mediumint(8) NOT NULL default '0',
  rate_user_ip char(8) NOT NULL default '',
  rate_point tinyint(3) unsigned NOT NULL default '0',
  rate_hon_point tinyint(3) NOT NULL default '0',
  KEY rate_pic_id (rate_pic_id),
  KEY rate_user_id (rate_user_id),
  KEY rate_user_ip (rate_user_ip),
  KEY rate_point (rate_point)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_approve_forums`
#

CREATE TABLE phpbb_approve_forums (
  forum_id smallint(5) unsigned NOT NULL default '0',
  enabled tinyint(1) NOT NULL default '0',
  approve_posts tinyint(1) NOT NULL default '0',
  approve_topics tinyint(1) NOT NULL default '0',
  approve_users tinyint(1) NOT NULL default '0',
  approve_poste tinyint(1) NOT NULL default '0',
  approve_topice tinyint(1) NOT NULL default '0',
  approve_notify tinyint(1) NOT NULL default '0',
  approve_notify_approval tinyint(1) NOT NULL default '0',
  approve_notify_type tinyint(1) NOT NULL default '0',
  approve_notify_message tinyint(1) NOT NULL default '0',
  approve_notify_message_len smallint(5) NOT NULL default '500',
  approve_moderators varchar(255) NOT NULL default '0',
  approve_notify_posts tinyint(1) NOT NULL default '0',
  approve_notify_poste tinyint(1) NOT NULL default '0',
  approve_notify_topics tinyint(1) NOT NULL default '0',
  approve_notify_topice tinyint(1) NOT NULL default '0',
  forum_hide_unapproved_topics tinyint(1) NOT NULL default '0',
  forum_hide_unapproved_posts tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (forum_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_approve_posts`
#

CREATE TABLE phpbb_approve_posts (
  approval_id mediumint(8) unsigned NOT NULL auto_increment,
  topic_id mediumint(8) unsigned NOT NULL default '0',
  post_id mediumint(8) unsigned NOT NULL default '0',
  is_topic tinyint(1) NOT NULL default '0',
  is_post tinyint(1) NOT NULL default '0',
  poster_id mediumint(8) NOT NULL default '0',
  PRIMARY KEY  (approval_id),
  KEY post_id (post_id),
  KEY topic_id (topic_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_approve_topics`
#

CREATE TABLE phpbb_approve_topics (
  topic_id mediumint(8) unsigned NOT NULL default '0',
  approve_moderate tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (topic_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_approve_users`
#

CREATE TABLE phpbb_approve_users (
  user_id mediumint(8) NOT NULL default '0',
  approve_moderate tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (user_id)
);

# --------------------------------------------------------

#
# Table structure for table 'phpbb_attachments_config'
#
CREATE TABLE phpbb_attachments_config (
  config_name varchar(190) NOT NULL,
  config_value varchar(255) NOT NULL,
  PRIMARY KEY  (config_name)
);

# --------------------------------------------------------

#
# Table structure for table 'phpbb_forbidden_extensions'
#
CREATE TABLE phpbb_forbidden_extensions (
  ext_id mediumint(8) UNSIGNED NOT NULL auto_increment, 
  extension varchar(100) NOT NULL, 
  PRIMARY KEY (ext_id)
);

# --------------------------------------------------------

#
# Table structure for table 'phpbb_extension_groups'
#
CREATE TABLE phpbb_extension_groups (
  group_id mediumint(8) NOT NULL auto_increment,
  group_name char(20) NOT NULL,
  cat_id tinyint(2) DEFAULT '0' NOT NULL, 
  allow_group tinyint(1) DEFAULT '0' NOT NULL,
  download_mode tinyint(1) UNSIGNED DEFAULT '1' NOT NULL,
  upload_icon varchar(100) DEFAULT '',
  max_filesize int(20) DEFAULT '0' NOT NULL,
  forum_permissions varchar(255) default '' NOT NULL,
  PRIMARY KEY group_id (group_id)
);

# --------------------------------------------------------

#
# Table structure for table 'phpbb_extensions'
#
CREATE TABLE phpbb_extensions (
  ext_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  group_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  extension varchar(100) NOT NULL,
  comment varchar(100),
  PRIMARY KEY ext_id (ext_id)
);

# --------------------------------------------------------

#
# Table structure for table 'phpbb_attachments_desc'
#
CREATE TABLE phpbb_attachments_desc (
  attach_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  physical_filename varchar(255) NOT NULL,
  real_filename varchar(255) NOT NULL,
  download_count mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  comment varchar(255),
  extension varchar(100),
  mimetype varchar(100),
  filesize int(20) NOT NULL,
  filetime int(11) DEFAULT '0' NOT NULL,
  thumbnail tinyint(1) DEFAULT '0' NOT NULL,
  PRIMARY KEY (attach_id),
  KEY filetime (filetime),
  KEY physical_filename (physical_filename(10)),
  KEY filesize (filesize)
);

# --------------------------------------------------------

#
# Table structure for table 'phpbb_attachments'
#
CREATE TABLE phpbb_attachments (
  attach_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL, 
  post_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL, 
  privmsgs_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  user_id_1 mediumint(8) NOT NULL,
  user_id_2 mediumint(8) NOT NULL,
  KEY attach_id_post_id (attach_id, post_id),
  KEY attach_id_privmsgs_id (attach_id, privmsgs_id),
  KEY post_id (post_id),
  KEY privmsgs_id (privmsgs_id)
); 

# --------------------------------------------------------

#
# Table structure for table 'phpbb_quota_limits'
#

CREATE TABLE phpbb_quota_limits (
  quota_limit_id mediumint(8) unsigned NOT NULL auto_increment,
  quota_desc varchar(20) NOT NULL default '',
  quota_limit bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (quota_limit_id)
);

# --------------------------------------------------------

#
# Table structure for table 'phpbb_attach_quota'
#
CREATE TABLE phpbb_attach_quota (
  user_id mediumint(8) unsigned NOT NULL default '0',
  group_id mediumint(8) unsigned NOT NULL default '0',
  quota_type smallint(2) NOT NULL default '0',
  quota_limit_id mediumint(8) unsigned NOT NULL default '0',
  KEY quota_type (quota_type)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_auth_access`
#

CREATE TABLE phpbb_auth_access (
  group_id mediumint(8) NOT NULL default '0',
  forum_id smallint(5) unsigned NOT NULL default '0',
  auth_view tinyint(1) NOT NULL default '0',
  auth_read tinyint(1) NOT NULL default '0',
  auth_post tinyint(1) NOT NULL default '0',
  auth_reply tinyint(1) NOT NULL default '0',
  auth_edit tinyint(1) NOT NULL default '0',
  auth_delete tinyint(1) NOT NULL default '0',
  auth_sticky tinyint(1) NOT NULL default '0',
  auth_announce tinyint(1) NOT NULL default '0',
  auth_global_announce tinyint(1) NOT NULL default '0',
  auth_vote tinyint(1) NOT NULL default '0',
  auth_pollcreate tinyint(1) NOT NULL default '0',
  auth_attachments tinyint(1) NOT NULL default '0',
  auth_mod tinyint(1) NOT NULL default '0',
  auth_download TINYINT(1) DEFAULT '0' NOT NULL,
  auth_news tinyint(1) NOT NULL default '0',
  auth_cal tinyint(1) NOT NULL default '0',
  auth_ban tinyint(1) NOT NULL default '0',
  auth_greencard tinyint(1) NOT NULL default '0',
  auth_bluecard tinyint(1) NOT NULL default '0',
  auth_delayedpost tinyint(4) NOT NULL default '3',
  KEY group_id (group_id),
  KEY forum_id (forum_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_banlist`
#

CREATE TABLE phpbb_banlist (
  ban_id mediumint(8) unsigned NOT NULL auto_increment,
  ban_userid mediumint(8) NOT NULL default '0',
  ban_ip varchar(8) NOT NULL default '',
  ban_email varchar(255) default NULL,
  PRIMARY KEY  (ban_id),
  KEY ban_ip_user_id (ban_ip,ban_userid)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_banner`
#

CREATE TABLE phpbb_banner (
  banner_id mediumint(8) unsigned NOT NULL default '0',
  banner_name text NOT NULL,
  banner_spot smallint(1) unsigned NOT NULL default '0',
  banner_forum mediumint(8) unsigned NOT NULL default '0',
  banner_description varchar(30) NOT NULL default '',
  banner_url varchar(90) NOT NULL default '',
  banner_owner mediumint(8) NOT NULL default '0',
  banner_click mediumint(8) unsigned NOT NULL default '0',
  banner_view mediumint(8) unsigned NOT NULL default '0',
  banner_weigth tinyint(1) unsigned NOT NULL default '50',
  banner_active tinyint(1) NOT NULL default '0',
  banner_timetype tinyint(1) NOT NULL default '0',
  time_begin int(11) NOT NULL default '0',
  time_end int(11) NOT NULL default '0',
  date_begin int(11) NOT NULL default '0',
  date_end int(11) NOT NULL default '0',
  banner_level tinyint(1) NOT NULL default '0',
  banner_level_type tinyint(1) NOT NULL default '0',
  banner_comment varchar(50) NOT NULL default '',
  banner_type mediumint(5) NOT NULL default '0',
  banner_width mediumint(5) unsigned NOT NULL default '0',
  banner_height mediumint(5) NOT NULL default '0',
  banner_filter tinyint(1) NOT NULL default '0',
  banner_filter_time mediumint(5) NOT NULL default '600',
  KEY banner_id (banner_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_banner_stats`
#

CREATE TABLE phpbb_banner_stats (
  banner_id mediumint(8) unsigned NOT NULL default '0',
  click_date int(11) NOT NULL default '0',
  click_ip char(8) NOT NULL default '',
  click_user mediumint(8) NOT NULL default '0',
  user_duration int(11) NOT NULL default '0'
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_block_position`
#

CREATE TABLE phpbb_block_position (
  bpid int(10) NOT NULL auto_increment,
  pkey varchar(30) NOT NULL default '',
  bposition char(1) NOT NULL default '',
  layout int(10) NOT NULL default '1',
  PRIMARY KEY  (bpid)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_block_variable`
#

CREATE TABLE phpbb_block_variable (
  bvid int(10) NOT NULL auto_increment,
  label varchar(255) NOT NULL default '',
  sub_label varchar(255) default NULL,
  config_name varchar(30) NOT NULL default '',
  field_options varchar(255) default NULL,
  field_values varchar(255) default NULL,
  type tinyint(1) NOT NULL default '0',
  block varchar(255) default NULL,
  PRIMARY KEY  (config_name),
  KEY bvid (bvid)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_blocks`
#

CREATE TABLE phpbb_blocks (
  bid int(10) NOT NULL auto_increment,
  title varchar(60) NOT NULL default '',
  title_image varchar(255) NOT NULL DEFAULT '',
  content text NOT NULL,
  bposition char(1) NOT NULL default '',
  weight int(10) NOT NULL default '1',
  active tinyint(1) NOT NULL default '1',
  blockfile varchar(255) NOT NULL default '',
  view tinyint(1) NOT NULL default '0',
  layout int(10) NOT NULL default '1',
  cache tinyint(1) NOT NULL default '0',
  cache_time int(10) NOT NULL default '0',
  block_bbcode_uid varchar(10) default NULL,
  type tinyint(1) NOT NULL default '1',
  border tinyint(1) NOT NULL default '1',
  titlebar tinyint(1) NOT NULL default '1',
  openclose tinyint(1) NOT NULL default '1',
  background tinyint(1) NOT NULL default '1',
  local tinyint(1) NOT NULL default '0',
  pgroup tinytext NOT NULL,
  PRIMARY KEY  (bid)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_bookmarks`
#

CREATE TABLE phpbb_bookmarks (
  topic_id mediumint(8) unsigned NOT NULL default '0',
  user_id mediumint(8) NOT NULL default '0',
  KEY topic_id (topic_id),
  KEY user_id (user_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_bots`
#

CREATE TABLE phpbb_bots (
  bot_id tinyint(3) unsigned NOT NULL auto_increment,
  bot_name varchar(255) NOT NULL default '',
  bot_agent text NOT NULL,
  last_visit varchar(255) NOT NULL default '',
  bot_visits varchar(255) NOT NULL default '0',
  bot_pages varchar(255) NOT NULL default '0',
  pending_agent text NOT NULL,
  pending_ip text NOT NULL,
  bot_ip text NOT NULL,
  PRIMARY KEY  (bot_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_buddy`
#

CREATE TABLE phpbb_buddy (
  user_id mediumint(8) NOT NULL default '0',
  buddy_id mediumint(8) NOT NULL default '0',
  buddy_ignore tinyint(1) NOT NULL default '0',
  buddy_visible tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (user_id,buddy_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_captcha_config`
#

CREATE TABLE phpbb_captcha_config (
  `config_name` varchar(190) NOT NULL default '',
  `config_value` varchar(100) NOT NULL default '',
  PRIMARY KEY  (config_name)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_categories`
#

CREATE TABLE phpbb_categories (
  cat_id mediumint(8) unsigned NOT NULL auto_increment,
  cat_title varchar(100) default NULL,
  cat_order mediumint(8) unsigned NOT NULL default '0',
  cat_main_type char(1) default NULL,
  cat_main mediumint(8) unsigned NOT NULL default '0',
  cat_desc mediumtext NOT NULL,
  icon varchar(255) default NULL,
  PRIMARY KEY  (cat_id),
  KEY cat_order (cat_order)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_chatspot_messages`
#

CREATE TABLE phpbb_chatspot_messages (
	`message_id` int(11) unsigned NOT NULL auto_increment,
	`room_id` int(11) NOT NULL default '0',
	`username` varchar(25) NOT NULL default '',
	`msg` text NOT NULL,
	`msg_type` tinyint(1) unsigned NOT NULL default '0',
	`timestamp` int(11) unsigned NOT NULL default '0',
	`to_user_id` mediumint(8) unsigned NOT NULL default '0',
	`from_user_id` mediumint(8) unsigned NOT NULL default '0',
	PRIMARY KEY  (`message_id`)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_chatspot_rooms`
#

CREATE TABLE phpbb_chatspot_rooms (
	`room_id` mediumint(11) NOT NULL auto_increment,
	`room_name` varchar(20) NOT NULL default '',
	`room_type` tinyint(1) unsigned NOT NULL default '0',
	`room_access` mediumint(8) unsigned NOT NULL default '0',
	`room_password` varchar(20) default NULL,
	`room_creator_id` mediumint(8) unsigned NOT NULL default '0',
	PRIMARY KEY  (`room_id`)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_chatspot_session`
#

CREATE TABLE phpbb_chatspot_sessions (
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(25) NOT NULL default '',
  `room_id` mediumint(11) NOT NULL default '0',
  `last_active` int(11) NOT NULL default '0',
  `last_status` tinyint(1) unsigned NOT NULL default '1'
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_config`
#

CREATE TABLE phpbb_config (
  config_name varchar(190) NOT NULL default '',
  config_value varchar(255) NOT NULL default '',
  PRIMARY KEY  (config_name)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_confirm`
#

CREATE TABLE phpbb_confirm (
  confirm_id char(32) NOT NULL default '',
  session_id char(32) NOT NULL default '',
  code char(10) NOT NULL default '',
  PRIMARY KEY  (session_id,confirm_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_ctracker_config`
#

CREATE TABLE phpbb_ctracker_config (
			ct_config_name varchar(190) NOT NULL,
			ct_config_value varchar(255) NOT NULL,
			PRIMARY KEY  (ct_config_name)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_ctracker_filechk`
#

CREATE TABLE phpbb_ctracker_filechk (
			filepath text,
			hash varchar(32) default NULL
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_ctracker_filescanner`
#

CREATE TABLE phpbb_ctracker_filescanner (
			id smallint(5) NOT NULL,
			filepath text,
			safety smallint(1) NOT NULL default '0',
			PRIMARY KEY  (id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_ctracker_ipblocker`
#

CREATE TABLE phpbb_ctracker_ipblocker (
			id mediumint(8) unsigned NOT NULL,
			ct_blocker_value varchar(250) default NULL,
			PRIMARY KEY  (id)
) AUTO_INCREMENT=33 ;

# --------------------------------------------------------

#
# Table structure for table `phpbb_ctracker_loginhistory`
#

CREATE TABLE phpbb_ctracker_loginhistory (
			ct_user_id int(10) default NULL,
			ct_login_ip varchar(16) default NULL,
			ct_login_time int(11) NOT NULL default '0'
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_digest`
#

CREATE TABLE phpbb_digest (
  user_id mediumint(8) NOT NULL default '0',
  digest_frequency mediumint(8) NOT NULL default '0',
  last_digest int(11) NOT NULL default '0',
  format smallint(4) NOT NULL default '0',
  show_text smallint(4) NOT NULL default '0',
  show_mine smallint(4) NOT NULL default '0',
  new_only smallint(4) NOT NULL default '0',
  send_on_no_messages smallint(4) NOT NULL default '1',
  text_length int(11) NOT NULL default '0',
  PRIMARY KEY  (user_id),
  UNIQUE KEY user_id (user_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_digest_forums`
#

CREATE TABLE phpbb_digest_forums (
  user_id mediumint(8) NOT NULL default '0',
  forum_id smallint(5) NOT NULL default '0',
  UNIQUE KEY user_id (user_id,forum_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_disallow`
#

CREATE TABLE phpbb_disallow (
  disallow_id mediumint(8) unsigned NOT NULL auto_increment,
  disallow_username varchar(25) NOT NULL default '',
  PRIMARY KEY  (disallow_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_email_users`
#

CREATE TABLE phpbb_email_users (
  user_id int(8) NOT NULL default '0',
  user_email varchar(255) NOT NULL default '0',
  PRIMARY KEY  (user_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_flags`
#

CREATE TABLE phpbb_flags (
  flag_id int(10) NOT NULL auto_increment,
  flag_name varchar(25) default NULL,
  flag_image varchar(25) default NULL,
  PRIMARY KEY  (flag_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_forum_prune`
#

CREATE TABLE phpbb_forum_prune (
  prune_id mediumint(8) unsigned NOT NULL auto_increment,
  forum_id smallint(5) unsigned NOT NULL default '0',
  prune_days smallint(5) unsigned NOT NULL default '0',
  prune_freq smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (prune_id),
  KEY forum_id (forum_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_forum_tour`
#

CREATE TABLE phpbb_forum_tour (
  page_id mediumint(8) unsigned NOT NULL default '0',
  page_subject varchar(60) default NULL,
  page_text text,
  page_sort mediumint(8) NOT NULL default '0',
  bbcode_uid varchar(10) default NULL,
  page_access mediumint(8) NOT NULL,
  KEY page_id (page_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_force_read`
#

CREATE TABLE phpbb_force_read (
  `topic_number` int(25) NOT NULL default '0',
  `message` text NOT NULL,
  `install_date` int(15) NOT NULL default '0',
  `active` tinyint(2) NOT NULL default '1',
  `effected` tinyint(1) NOT NULL default '1'
);
    
# --------------------------------------------------------

#
# Table structure for table `phpbb_force_read_users`
#

CREATE TABLE phpbb_force_read_users (
  user varchar(255) NOT NULL default '',
  `read` int(1) NOT NULL default '0',
  time int(10) NOT NULL default '0'
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_force_read_users`
#

CREATE TABLE phpbb_themes_select_info (
	themes_id mediumint(8) unsigned NOT NULL auto_increment,
	style_author varchar(50) NOT NULL default '',
	style_version varchar(10) NOT NULL default '',
	style_website varchar(100) NOT NULL default '',
	style_views mediumint(8) unsigned NOT NULL default '0',
	style_dlurl varchar(100) NOT NULL default '',
	style_dls mediumint(8) unsigned NOT NULL default '0',
	style_loaclurl varchar(100) NOT NULL default '',
	style_ludls mediumint(8) unsigned NOT NULL default '0',
	PRIMARY KEY  (themes_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_forums`
#

CREATE TABLE phpbb_forums (
  forum_id smallint(5) unsigned NOT NULL default '0',
  cat_id mediumint(8) unsigned NOT NULL default '0',
  forum_name varchar(150) default NULL,
  forum_desc text,
  forum_status tinyint(4) NOT NULL default '0',
  forum_order mediumint(8) unsigned NOT NULL default '1',
  forum_posts mediumint(8) unsigned NOT NULL default '0',
  forum_topics mediumint(8) unsigned NOT NULL default '0',
  forum_last_post_id mediumint(8) unsigned NOT NULL default '0',
  prune_next int(11) default NULL,
  prune_enable tinyint(1) NOT NULL default '0',
  auth_view tinyint(2) NOT NULL default '0',
  auth_read tinyint(2) NOT NULL default '0',
  auth_post tinyint(2) NOT NULL default '0',
  auth_reply tinyint(2) NOT NULL default '0',
  auth_edit tinyint(2) NOT NULL default '0',
  auth_delete tinyint(2) NOT NULL default '0',
  auth_sticky tinyint(2) NOT NULL default '0',
  auth_announce tinyint(2) NOT NULL default '0',
  auth_global_announce tinyint(2) NOT NULL default '0',
  auth_vote tinyint(2) NOT NULL default '0',
  auth_pollcreate tinyint(2) NOT NULL default '0',
  auth_attachments tinyint(2) NOT NULL default '0',
  auth_download TINYINT(2) DEFAULT '0' NOT NULL,
  auth_news tinyint(2) NOT NULL default '2',
  forum_link varchar(255) default NULL,
  forum_link_internal tinyint(1) NOT NULL default '0',
  forum_link_hit_count tinyint(1) NOT NULL default '0',
  forum_link_hit bigint(20) unsigned NOT NULL default '0',
  icon varchar(255) default NULL,
  main_type char(1) default NULL,
  auth_cal tinyint(2) NOT NULL default '0',
  auth_ban tinyint(2) NOT NULL default '3',
  auth_greencard tinyint(2) NOT NULL default '5',
  auth_bluecard tinyint(2) NOT NULL default '1',
  auth_delayedpost tinyint(4) NOT NULL default '3',
  PRIMARY KEY  (forum_id),
  KEY forums_order (forum_order),
  KEY cat_id (cat_id),
  KEY forum_last_post_id (forum_last_post_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_groups`
#

CREATE TABLE phpbb_groups (
  group_id mediumint(8) NOT NULL auto_increment,
  group_type tinyint(4) NOT NULL default '1',
  group_name varchar(40) NOT NULL default '',
  group_description varchar(255) NOT NULL default '',
  group_moderator mediumint(8) NOT NULL default '0',
  group_single_user tinyint(1) NOT NULL default '1',
  group_count int(4) unsigned default '99999999',
  group_count_max int(4) unsigned default '99999999',
  group_count_enable smallint(2) unsigned default '0',
  group_amount float default '0',
  group_period integer default '1',
  group_period_basis varchar(10) default 'M',
  group_first_trial_fee float default '0',
  group_first_trial_period integer default '0',
  group_first_trial_period_basis VARCHAR(10) default '0',
  group_second_trial_fee float default '0',
  group_second_trial_period integer default '0',
  group_second_trial_period_basis VARCHAR(10) default '0',
  group_sub_recurring integer default '1',
  group_sub_recurring_stop integer default '0',
  group_sub_recurring_stop_num integer default '0',
  group_sub_reattempt integer default '1',
  group_weight MEDIUMINT(8) DEFAULT '0' NOT NULL,
  group_legend SMALLINT(1) DEFAULT '0' NOT NULL,
  group_color SMALLINT(1) DEFAULT '0' NOT NULL,
  PRIMARY KEY  (group_id),
  KEY group_single_user (group_single_user)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_hacks_list`
#

CREATE TABLE phpbb_hacks_list (
  hack_id mediumint(8) unsigned NOT NULL auto_increment,
  hack_name varchar(190) NOT NULL default '',
  hack_desc varchar(255) NOT NULL default '',
  hack_author varchar(255) NOT NULL default '',
  hack_author_email varchar(255) NOT NULL default '',
  hack_author_website tinytext NOT NULL,
  hack_version varchar(32) NOT NULL default '',
  hack_hide enum('Yes','No') NOT NULL default 'No',
  hack_download_url tinytext NOT NULL,
  hack_file varchar(255) NOT NULL default '',
  hack_file_mtime int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (hack_id),
  UNIQUE KEY hack_name (hack_name),
  KEY hack_file (hack_file),
  KEY hack_hide (hack_hide)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_ip_tracking`
#

CREATE TABLE phpbb_ip_tracking (
  ip varchar(15) NOT NULL default '',
  `time` int(11) NOT NULL default '0',
  located varchar(255) NOT NULL default '',
  referer varchar(255) NOT NULL default '',
  username varchar(50) NOT NULL default ''
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_ip_tracking_config`
#

CREATE TABLE phpbb_ip_tracking_config (
  max varchar(15) NOT NULL default '0'
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_jr_admin_users`
#

CREATE TABLE phpbb_jr_admin_users (
  user_id mediumint(9) NOT NULL default '0',
  user_jr_admin longtext NOT NULL,
  start_date int(10) unsigned NOT NULL default '0',
  update_date int(10) unsigned NOT NULL default '0',
  admin_notes text NOT NULL,
  notes_view tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (user_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_kb_articles`
#

CREATE TABLE phpbb_kb_articles (
  article_id mediumint(8) unsigned NOT NULL auto_increment,
  article_category_id mediumint(8) unsigned NOT NULL default '0',
  article_title varchar(255) binary NOT NULL default '',
  article_description varchar(255) binary NOT NULL default '',
  article_date varchar(255) binary NOT NULL default '',
  article_author_id mediumint(8) unsigned NOT NULL default '0',
  username varchar(255) default NULL,
  bbcode_uid varchar(10) binary NOT NULL default '',
  article_body text NOT NULL,
  article_type mediumint(8) unsigned NOT NULL default '0',
  approved tinyint(1) unsigned NOT NULL default '0',
  topic_id mediumint(8) unsigned NOT NULL default '0',
  views bigint(8) NOT NULL default '0',
  article_rating double(6,4) NOT NULL default '0.0000',
  article_totalvotes int(255) NOT NULL default '0',
  KEY article_id (article_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_kb_categories`
#

CREATE TABLE phpbb_kb_categories (
  category_id mediumint(8) unsigned NOT NULL auto_increment,
  category_name varchar(255) binary NOT NULL default '',
  category_details varchar(255) binary NOT NULL default '',
  number_articles mediumint(8) unsigned NOT NULL default '0',
  parent mediumint(8) unsigned default NULL,
  cat_order mediumint(8) unsigned NOT NULL default '0',
  auth_view tinyint(3) NOT NULL DEFAULT "0",
  auth_post tinyint(3) NOT NULL DEFAULT "0",
  auth_rate tinyint(3) NOT NULL DEFAULT "0",
  auth_comment tinyint(3) NOT NULL DEFAULT "0",
  auth_edit tinyint(3) NOT NULL DEFAULT "0",
  auth_delete tinyint(3) NOT NULL DEFAULT "2",
  auth_approval tinyint(3) NOT NULL DEFAULT "0",
  auth_approval_edit tinyint(3) NOT NULL DEFAULT "0",
  auth_view_groups varchar(255),
  auth_post_groups varchar(255),
  auth_rate_groups varchar(255),
  auth_comment_groups varchar(255),
  auth_edit_groups varchar(255),
  auth_delete_groups varchar(255),
  auth_approval_groups varchar(255),
  auth_approval_edit_groups varchar(255),
  auth_moderator_groups varchar(255),
  comments_forum_id tinyint(3) NOT NULL DEFAULT "-1",
  KEY category_id (category_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_kb_config`
#

CREATE TABLE phpbb_kb_config (
  config_name varchar(190) NOT NULL default '',
  config_value varchar(255) default NULL,
  PRIMARY KEY  (config_name)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_kb_results`
#

CREATE TABLE phpbb_kb_results (
  search_id int(11) unsigned NOT NULL default '0',
  session_id varchar(32) NOT NULL default '',
  search_array mediumtext NOT NULL,
  PRIMARY KEY  (search_id),
  KEY session_id (session_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_kb_types`
#

CREATE TABLE phpbb_kb_types (
  id mediumint(8) unsigned NOT NULL auto_increment,
  type varchar(255) binary NOT NULL default '',
  KEY id (id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_kb_votes`
#

CREATE TABLE phpbb_kb_votes (
  votes_ip varchar(50) NOT NULL default '0',
  votes_userid int(50) NOT NULL default '0',
  votes_file int(50) NOT NULL default '0'
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_kb_wordlist`
#

CREATE TABLE phpbb_kb_wordlist (
  word_text varchar(50) binary NOT NULL default '',
  word_id mediumint(8) unsigned NOT NULL auto_increment,
  word_common tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (word_text),
  KEY word_id (word_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_kb_wordmatch`
#

CREATE TABLE phpbb_kb_wordmatch (
  article_id mediumint(8) unsigned NOT NULL default '0',
  word_id mediumint(8) unsigned NOT NULL default '0',
  title_match tinyint(1) NOT NULL default '0',
  KEY post_id (article_id),
  KEY word_id (word_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_kb_custom`
#

CREATE TABLE phpbb_kb_custom (
  custom_id int(50) NOT NULL auto_increment,
  custom_name text NOT NULL,
  custom_description text NOT NULL,
  data text NOT NULL,
  field_order int(20) NOT NULL default '0',
  field_type tinyint(2) NOT NULL default '0',
  regex varchar(255) NOT NULL default '',
  PRIMARY KEY  (custom_id)
); 

# --------------------------------------------------------

#
# Table structure for table `phpbb_kb_customdata`
#

CREATE TABLE phpbb_kb_customdata (
  customdata_file int(50) NOT NULL default '0',
  customdata_custom int(50) NOT NULL default '0',
  data text NOT NULL
);		

# --------------------------------------------------------

#
# Table structure for table `phpbb_layout`
#

CREATE TABLE phpbb_layout (
  lid int(10) unsigned NOT NULL auto_increment,
  name varchar(100) NOT NULL default '',
  template varchar(100) NOT NULL default '',
  forum_wide tinyint(1) NOT NULL default '1',
  page_collapse tinyint(1) NOT NULL default '0',
  view tinyint(1) NOT NULL default '0',
  pgroup tinytext NOT NULL,
  pagetitle varchar(100) NOT NULL default 'Home',
  PRIMARY KEY  (lid)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_link_categories`
#

CREATE TABLE phpbb_link_categories (
  cat_id mediumint(8) unsigned NOT NULL auto_increment,
  cat_title varchar(100) NOT NULL default '',
  cat_order mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (cat_id),
  KEY cat_order (cat_order)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_link_config`
#

CREATE TABLE phpbb_link_config (
  config_name varchar(190) NOT NULL default '',
  config_value varchar(255) NOT NULL default ''
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_links`
#

CREATE TABLE phpbb_links (
  link_id mediumint(8) unsigned NOT NULL auto_increment,
  link_title varchar(100) NOT NULL default '',
  link_desc varchar(255) default NULL,
  link_category mediumint(8) unsigned NOT NULL default '0',
  link_url varchar(100) NOT NULL default '',
  link_logo_src varchar(120) default NULL,
  link_joined int(11) NOT NULL default '0',
  link_active tinyint(1) NOT NULL default '0',
  link_hits int(10) unsigned NOT NULL default '0',
  user_id mediumint(8) NOT NULL default '0',
  user_ip varchar(8) NOT NULL default '',
  last_user_ip varchar(8) NOT NULL default '',
  PRIMARY KEY  (link_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_module_admin_panel`
#

CREATE TABLE phpbb_module_admin_panel (
  module_id mediumint(8) unsigned NOT NULL default '0',
  config_name varchar(190) NOT NULL default '',
  config_value varchar(255) NOT NULL default '',
  config_type varchar(20) NOT NULL default '',
  config_title varchar(100) NOT NULL default '',
  config_explain varchar(100) default NULL,
  config_trigger varchar(20) NOT NULL default ''
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_module_cache`
#

CREATE TABLE phpbb_module_cache (
  module_id mediumint(8) NOT NULL default '0',
  module_cache_time int(12) NOT NULL default '0',
  db_cache text NOT NULL,
  priority mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (module_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_module_group_auth`
#

CREATE TABLE phpbb_module_group_auth (
  module_id mediumint(8) unsigned NOT NULL default '0',
  group_id mediumint(8) unsigned NOT NULL default '0'
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_module_info`
#

CREATE TABLE phpbb_module_info (
  module_id mediumint(8) NOT NULL default '0',
  long_name varchar(100) NOT NULL default '',
  author varchar(50) default NULL,
  email varchar(50) default NULL,
  url varchar(100) default NULL,
  version varchar(10) NOT NULL default '',
  update_site varchar(100) default NULL,
  extra_info varchar(255) NOT NULL default '',
  PRIMARY KEY  (module_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_modules`
#

CREATE TABLE phpbb_modules (
  module_id mediumint(8) unsigned NOT NULL auto_increment,
  short_name varchar(100) default NULL,
  update_time int(50) NOT NULL default '0',
  module_order mediumint(8) NOT NULL default '0',
  active tinyint(2) NOT NULL default '0',
  perm_all tinyint(2) unsigned NOT NULL default '1',
  perm_reg tinyint(2) unsigned NOT NULL default '1',
  perm_mod tinyint(2) unsigned NOT NULL default '1',
  perm_admin tinyint(2) unsigned NOT NULL default '1',
  PRIMARY KEY  (module_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_news`
#

CREATE TABLE phpbb_news (
  news_id mediumint(8) unsigned NOT NULL auto_increment,
  news_category varchar(70) NOT NULL default '',
  news_image varchar(70) NOT NULL default '',
  PRIMARY KEY  (news_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_optimize_db`
#

CREATE TABLE phpbb_optimize_db (
  cron_enable enum('0','1') NOT NULL default '0',
  cron_every int(7) NOT NULL default '86400',
  cron_next int(11) NOT NULL default '0',
  cron_count int(5) NOT NULL default '0',
  cron_lock enum('0','1') NOT NULL default '0',
  show_begin_for varchar(150) NOT NULL default '',
  show_not_optimized enum('0','1') NOT NULL default '0'
);

# --------------------------------------------------------


#
# Table structure for table `phpbb_pa_cat`
#

CREATE TABLE phpbb_pa_cat (
  cat_id int(10) NOT NULL auto_increment,
  cat_name mediumtext NOT NULL,
  cat_desc mediumtext NOT NULL,
  cat_parent int(50) default NULL,
  parents_data text NOT NULL,
  cat_order int(50) default NULL,
  cat_allow_file tinyint(2) NOT NULL default '0',
  cat_allow_ratings tinyint(2) NOT NULL default '1',
  cat_allow_comments tinyint(2) NOT NULL default '1',
  cat_files mediumint(8) NOT NULL default '-1',
  cat_last_file_id mediumint(8) unsigned NOT NULL default '0',
  cat_last_file_name varchar(255) NOT NULL default '',
  cat_last_file_time INT(50) UNSIGNED DEFAULT '0' NOT NULL,
  auth_view tinyint(2) NOT NULL default '0',
  auth_read tinyint(2) NOT NULL default '0',
  auth_view_file tinyint(2) NOT NULL default '0',
  auth_edit_file tinyint(1) DEFAULT '0' NOT NULL,
  auth_delete_file tinyint(1) DEFAULT '0' NOT NULL,
  auth_upload tinyint(2) NOT NULL default '0',
  auth_download tinyint(2) NOT NULL default '0',
  auth_rate tinyint(2) NOT NULL default '0',
  auth_email tinyint(2) NOT NULL default '0',
  auth_view_comment tinyint(2) NOT NULL default '0',
  auth_post_comment tinyint(2) NOT NULL default '0',
  auth_edit_comment tinyint(2) NOT NULL default '0',
  auth_delete_comment tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (cat_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_pa_auth`
#

CREATE TABLE phpbb_pa_auth (
   group_id mediumint(8) DEFAULT '0' NOT NULL,
   cat_id smallint(5) UNSIGNED DEFAULT '0' NOT NULL,
   auth_view tinyint(1) DEFAULT '0' NOT NULL,
   auth_read tinyint(1) DEFAULT '0' NOT NULL,
   auth_view_file tinyint(1) DEFAULT '0' NOT NULL,
   auth_edit_file tinyint(1) DEFAULT '0' NOT NULL,
   auth_delete_file tinyint(1) DEFAULT '0' NOT NULL,
   auth_upload tinyint(1) DEFAULT '0' NOT NULL,
   auth_download tinyint(1) DEFAULT '0' NOT NULL,
   auth_rate tinyint(1) DEFAULT '0' NOT NULL,
   auth_email tinyint(1) DEFAULT '0' NOT NULL,
   auth_view_comment tinyint(1) DEFAULT '0' NOT NULL,
   auth_post_comment tinyint(1) DEFAULT '0' NOT NULL,
   auth_edit_comment tinyint(1) DEFAULT '0' NOT NULL,
   auth_delete_comment tinyint(1) DEFAULT '0' NOT NULL,
   auth_mod tinyint(1) DEFAULT '0' NOT NULL,
   auth_search tinyint(1) DEFAULT '1' NOT NULL,
   auth_stats tinyint(1) DEFAULT '1' NOT NULL,
   auth_toplist tinyint(1) DEFAULT '1' NOT NULL,
   auth_viewall tinyint(1) DEFAULT '1' NOT NULL,
   KEY group_id (group_id),
   KEY cat_id (cat_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_pa_comments`
#

CREATE TABLE phpbb_pa_comments (
  comments_id int(10) NOT NULL auto_increment,
  file_id int(10) NOT NULL default '0',
  comments_text text NOT NULL,
  comments_title text NOT NULL,
  comments_time int(50) NOT NULL default '0',
  comment_bbcode_uid varchar(10) default NULL,
  poster_id mediumint(8) NOT NULL default '0',
  PRIMARY KEY  (comments_id),
  KEY comments_id (comments_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_pa_config`
#

CREATE TABLE phpbb_pa_config (
  config_name varchar(190) NOT NULL default '',
  config_value varchar(255) NOT NULL default '',
  PRIMARY KEY  (config_name)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_pa_custom`
#

CREATE TABLE phpbb_pa_custom (
  custom_id int(50) NOT NULL auto_increment,
  custom_name text NOT NULL,
  custom_description text NOT NULL,
  data text NOT NULL,
  field_order int(20) NOT NULL default '0',
  field_type tinyint(2) NOT NULL default '0',
  regex varchar(255) NOT NULL default '',
  PRIMARY KEY  (custom_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_pa_customdata`
#

CREATE TABLE phpbb_pa_customdata (
  customdata_file int(50) NOT NULL default '0',
  customdata_custom int(50) NOT NULL default '0',
  data text NOT NULL
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_pa_download_info`
#

CREATE TABLE phpbb_pa_download_info (
  file_id mediumint(8) NOT NULL default '0',
  user_id mediumint(8) NOT NULL default '0',
  downloader_ip varchar(8) NOT NULL default '',
  downloader_os varchar(255) NOT NULL default '',
  downloader_browser varchar(255) NOT NULL default '',
  browser_version varchar(255) NOT NULL default ''
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_pa_files`
#

CREATE TABLE phpbb_pa_files (
  file_id int(10) NOT NULL auto_increment,
  user_id mediumint(8) NOT NULL default '0',
  poster_ip varchar(8) NOT NULL default '',
  file_name text,
  file_size int(20) NOT NULL default '0',
  unique_name varchar(255) NOT NULL default '',
  real_name VARCHAR(255) NOT NULL,
  file_dir VARCHAR(255) NOT NULL,
  file_desc text,
  file_creator text,
  file_version text,
  file_longdesc text,
  file_ssurl text,
  file_sshot_link tinyint(2) NOT NULL default '0',
  file_dlurl text,
  file_time int(50) default NULL,
  file_update_time int(50) NOT NULL default '0',
  file_catid int(10) default NULL,
  file_posticon text,
  file_license int(10) default NULL,
  file_dls int(10) default NULL,
  file_last int(50) default NULL,
  file_pin int(2) default NULL,
  file_docsurl text,
  file_approved TINYINT(1) DEFAULT '1' NOT NULL,
  file_broken TINYINT(1) DEFAULT '0' NOT NULL,
  PRIMARY KEY  (file_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_pa_license`
#

CREATE TABLE phpbb_pa_license (
  license_id int(10) NOT NULL auto_increment,
  license_name text,
  license_text text,
  PRIMARY KEY  (license_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_pa_mirrors`
#

CREATE TABLE phpbb_pa_mirrors (
  mirror_id mediumint(8) NOT NULL auto_increment, 
  file_id int(10) NOT NULL,
  unique_name varchar(255) NOT NULL default '',
  file_dir VARCHAR(255) NOT NULL, 
  file_dlurl varchar(255) NOT NULL default '',
  mirror_location VARCHAR(255) NOT NULL default '',
  PRIMARY KEY  (mirror_id),
  KEY file_id (file_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_pa_votes`
#

CREATE TABLE phpbb_pa_votes (
  user_id mediumint(8) NOT NULL default '0',
  votes_ip varchar(50) NOT NULL default '0',
  votes_file int(50) NOT NULL default '0',
  rate_point tinyint(3) unsigned NOT NULL default '0',
  voter_os varchar(255) NOT NULL default '',
  voter_browser varchar(255) NOT NULL default '',
  browser_version varchar(8) NOT NULL default '',
  KEY user_id (user_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_phpBBSecurity`
#

CREATE TABLE phpbb_phpBBSecurity(
   ban_id mediumint(8) NOT NULL auto_increment,
   ban_ip varchar(15) NOT NULL default '',
   ban_reason varchar(50) NOT NULL default '0',
   ban_date int(10) NOT NULL default '0',
   ban_attempts int(10) NOT NULL default '0',
   ban_link text NOT NULL,
	PRIMARY KEY  (ban_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_portal_config`
#

CREATE TABLE phpbb_portal_config (
  id int(10) unsigned NOT NULL auto_increment,
  config_name varchar(190) NOT NULL default '',
  config_value varchar(255) NOT NULL default '',
  PRIMARY KEY  (id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_posts`
#

CREATE TABLE phpbb_posts (
  post_id mediumint(8) unsigned NOT NULL auto_increment,
  topic_id mediumint(8) unsigned NOT NULL default '0',
  forum_id smallint(5) unsigned NOT NULL default '0',
  poster_id mediumint(8) NOT NULL default '0',
  post_time int(11) NOT NULL default '0',
  poster_ip varchar(8) NOT NULL default '',
  post_username varchar(25) default NULL,
  enable_bbcode tinyint(1) NOT NULL default '1',
  enable_html tinyint(1) NOT NULL default '0',
  enable_smilies tinyint(1) NOT NULL default '1',
  enable_sig tinyint(1) NOT NULL default '1',
  post_edit_time int(11) default NULL,
  post_edit_count smallint(5) unsigned NOT NULL default '0',
  post_attachment TINYINT(1) DEFAULT '0' NOT NULL,
  post_icon tinyint(2) default NULL,
  rating_rank_id smallint(5) unsigned NOT NULL default '0',
  post_reported tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (post_id),
  KEY forum_id (forum_id),
  KEY topic_id (topic_id),
  KEY poster_id (poster_id),
  KEY post_time (post_time),
  KEY post_icon (post_icon),
  KEY posts_ratingrankid (rating_rank_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_posts_text`
#

CREATE TABLE phpbb_posts_text (
  post_id mediumint(8) unsigned NOT NULL default '0',
  bbcode_uid varchar(10) NOT NULL default '',
  post_subject varchar(60) default NULL,
  post_text text,
  PRIMARY KEY  (post_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_privmsgs`
#

CREATE TABLE phpbb_privmsgs (
  privmsgs_id mediumint(8) unsigned NOT NULL auto_increment,
  privmsgs_type tinyint(4) NOT NULL default '0',
  privmsgs_subject varchar(255) NOT NULL default '0',
  privmsgs_from_userid mediumint(8) NOT NULL default '0',
  privmsgs_to_userid mediumint(8) NOT NULL default '0',
  privmsgs_date int(11) NOT NULL default '0',
  privmsgs_ip varchar(8) NOT NULL default '',
  privmsgs_enable_bbcode tinyint(1) NOT NULL default '1',
  privmsgs_enable_html tinyint(1) NOT NULL default '0',
  privmsgs_enable_smilies tinyint(1) NOT NULL default '1',
  privmsgs_attach_sig tinyint(1) NOT NULL default '1',
  privmsgs_attachment TINYINT(1) DEFAULT '0' NOT NULL,
  privmsgs_reported tinyint(1) NOT NULL default '0',
  `privmsgs_track_id` mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  PRIMARY KEY  (privmsgs_id),
  KEY privmsgs_from_userid (privmsgs_from_userid),
  KEY privmsgs_to_userid (privmsgs_to_userid)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_privmsgs_archive`
#

CREATE TABLE phpbb_privmsgs_archive (
  privmsgs_id mediumint(8) unsigned NOT NULL auto_increment,
  privmsgs_type tinyint(4) NOT NULL default '0',
  privmsgs_subject varchar(255) NOT NULL default '0',
  privmsgs_from_userid mediumint(8) NOT NULL default '0',
  privmsgs_to_userid mediumint(8) NOT NULL default '0',
  privmsgs_date int(11) NOT NULL default '0',
  privmsgs_ip varchar(8) NOT NULL default '',
  privmsgs_enable_bbcode tinyint(1) NOT NULL default '1',
  privmsgs_enable_html tinyint(1) NOT NULL default '0',
  privmsgs_enable_smilies tinyint(1) NOT NULL default '1',
  privmsgs_attach_sig tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (privmsgs_id),
  KEY privmsgs_from_userid (privmsgs_from_userid),
  KEY privmsgs_to_userid (privmsgs_to_userid)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_privmsgs_text`
#

CREATE TABLE phpbb_privmsgs_text (
  privmsgs_text_id mediumint(8) unsigned NOT NULL default '0',
  privmsgs_bbcode_uid varchar(10) NOT NULL default '0',
  privmsgs_text text,
  PRIMARY KEY  (privmsgs_text_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_ranks`
#

CREATE TABLE phpbb_ranks (
  rank_id smallint(5) unsigned NOT NULL auto_increment,
  rank_title varchar(255) NOT NULL default '',
  rank_min mediumint(8) NOT NULL default '0',
  rank_max mediumint(8) NOT NULL default '0',
  rank_special tinyint(1) default '0',
  rank_image varchar(255) default NULL,
  PRIMARY KEY  (rank_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_rating`
#

CREATE TABLE phpbb_rating (
  post_id int(10) unsigned NOT NULL default '0',
  user_id int(10) unsigned NOT NULL default '0',
  rating_time int(10) unsigned NOT NULL default '0',
  option_id smallint(5) unsigned NOT NULL default '0',
  KEY rating_postid (post_id),
  KEY rating_userid (user_id),
  KEY rating_ratingoptionid (option_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_rating_bias`
#

CREATE TABLE phpbb_rating_bias (
  bias_id int(10) unsigned NOT NULL auto_increment,
  user_id int(10) unsigned NOT NULL default '0',
  target_user int(10) unsigned NOT NULL default '0',
  bias_status tinyint(3) unsigned NOT NULL default '0',
  bias_time int(10) unsigned NOT NULL default '0',
  post_id int(10) unsigned NOT NULL default '0',
  option_id smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (bias_id),
  KEY ratingbias_userid_targetuser (user_id,target_user),
  KEY ratingbias_targetuser (target_user),
  KEY ratingbias_postid (post_id),
  KEY ratingbias_optionid (option_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_rating_config`
#

CREATE TABLE phpbb_rating_config (
  label varchar(100) default NULL,
  num_value int(10) unsigned NOT NULL default '0',
  text_value varchar(255) default NULL,
  config_id int(10) unsigned NOT NULL default '0',
  input_type tinyint(3) unsigned NOT NULL default '0',
  list_order smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (config_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_rating_option`
#

CREATE TABLE phpbb_rating_option (
  option_id smallint(5) unsigned NOT NULL auto_increment,
  points tinyint(4) NOT NULL default '0',
  label varchar(100) default NULL,
  weighting smallint(5) unsigned NOT NULL default '0',
  user_type tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (option_id),
  KEY ratingoption_rating (points),
  KEY ratingoption_weighting (weighting)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_rating_rank`
#

CREATE TABLE phpbb_rating_rank (
  rating_rank_id smallint(5) unsigned NOT NULL auto_increment,
  type tinyint(3) unsigned NOT NULL default '0',
  average_threshold tinyint(4) NOT NULL default '0',
  sum_threshold int(11) NOT NULL default '0',
  label varchar(100) default NULL,
  icon varchar(255) default NULL,
  user_rank int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (rating_rank_id),
  KEY ratingrank_type (type)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_rating_temp`
#

CREATE TABLE phpbb_rating_temp (
  topic_id int(10) unsigned NOT NULL default '0',
  points tinyint(4) NOT NULL default '0',
  KEY ratingtemp_topicid (topic_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_referers`
#

CREATE TABLE phpbb_referers (
   referer_id mediumint(8) UNSIGNED NOT NULL auto_increment,
   referer_host varchar(255) NOT NULL default '',
   referer_url varchar(255) NOT NULL default '',
   referer_ip varchar(8) NOT NULL default '',
   referer_hits int(10) NOT NULL default '1',
   referer_firstvisit int(11) DEFAULT '0' NOT NULL,
   referer_lastvisit int(11) DEFAULT '0' NOT NULL,
   PRIMARY KEY (referer_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_rules`
#

CREATE TABLE phpbb_rules (
  date int(11) NOT NULL,
  rules text NOT NULL,
  pm_subject varchar(255) NOT NULL default '',
  pm_message text
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_search_results`
#

CREATE TABLE phpbb_search_results (
  search_id int(11) unsigned NOT NULL default '0',
  session_id varchar(32) NOT NULL default '',
  search_array mediumtext NOT NULL,
  search_time int(11) NOT NULL default '0',
  PRIMARY KEY  (search_id),
  KEY session_id (session_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_search_wordlist`
#

CREATE TABLE phpbb_search_wordlist (
  word_text varchar(50) binary NOT NULL default '',
  word_id mediumint(8) unsigned NOT NULL auto_increment,
  word_common tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (word_text),
  KEY word_id (word_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_search_wordmatch`
#

CREATE TABLE phpbb_search_wordmatch (
  post_id mediumint(8) unsigned NOT NULL default '0',
  word_id mediumint(8) unsigned NOT NULL default '0',
  title_match tinyint(1) NOT NULL default '0',
  KEY post_id (post_id),
  KEY word_id (word_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_serverload`
#

CREATE TABLE phpbb_serverload (
  time int(14) NOT NULL default '0'
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_sessions`
#

CREATE TABLE phpbb_sessions (
  session_id varchar(32) NOT NULL default '',
  session_user_id mediumint(8) NOT NULL default '0',
  session_start int(11) NOT NULL default '0',
  session_time int(11) NOT NULL default '0',
  session_ip varchar(8) NOT NULL default '0',
  session_page int(11) NOT NULL default '0',
  session_logged_in tinyint(1) NOT NULL default '0',
  session_robot varchar(32) default NULL,
  session_admin tinyint(2) DEFAULT '0' NOT NULL,
  priv_session_id char(32) NOT NULL DEFAULT '',
  PRIMARY KEY  (session_id),
  KEY session_user_id (session_user_id),
  KEY session_id_ip_user_id (session_id,session_ip,session_user_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_sessions_keys`
#

CREATE TABLE phpbb_sessions_keys (
  key_id varchar(32) NOT NULL default '0',
  user_id mediumint(8) NOT NULL default '0',
  last_ip varchar(8) NOT NULL default '0',
  last_login int(11) NOT NULL default '0',
  PRIMARY KEY (key_id, user_id),
  KEY last_login (last_login)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_shout`
#

CREATE TABLE phpbb_shout (
  shout_id mediumint(8) unsigned NOT NULL auto_increment,
  shout_username varchar(25) NOT NULL default '',
  shout_user_id mediumint(8) NOT NULL default '0',
  shout_group_id mediumint(8) NOT NULL default '0',
  shout_session_time int(11) NOT NULL default '0',
  shout_ip varchar(8) NOT NULL default '',
  shout_text text NOT NULL,
  shout_active mediumint(8) NOT NULL default '0',
  enable_bbcode tinyint(1) NOT NULL default '0',
  enable_html tinyint(1) NOT NULL default '0',
  enable_smilies tinyint(1) NOT NULL default '0',
  enable_sig tinyint(1) NOT NULL default '0',
  shout_bbcode_uid varchar(10) NOT NULL default '',
  KEY shout_id (shout_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_smilies`
#

CREATE TABLE phpbb_smilies (
  smilies_id smallint(5) unsigned NOT NULL auto_increment,
  code varchar(50) default NULL,
  smile_url varchar(100) default NULL,
  emoticon varchar(75) default NULL,
  PRIMARY KEY  (smilies_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_stats_config`
#

CREATE TABLE phpbb_stats_config (
  config_name varchar(100) NOT NULL default '',
  config_value varchar(100) NOT NULL default '',
  PRIMARY KEY  (config_name)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_stats_smilies_index`
#

CREATE TABLE phpbb_stats_smilies_index (
  code varchar(50) default NULL,
  smile_url varchar(100) default NULL,
  smile_count mediumint(8) default '0'
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_stats_smilies_info`
#

CREATE TABLE phpbb_stats_smilies_info (
  last_post_id mediumint(8) NOT NULL default '0',
  last_update_time int(50) NOT NULL default '0',
  update_time int(50) NOT NULL default '10080'
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_themes`
#

CREATE TABLE phpbb_themes (
  themes_id mediumint(8) unsigned NOT NULL auto_increment,
  template_name varchar(30) NOT NULL default '',
  style_name varchar(30) NOT NULL default '',
  head_stylesheet varchar(100) default NULL,
  body_background varchar(100) default NULL,
  body_bgcolor varchar(6) default NULL,
  body_text varchar(6) default NULL,
  body_link varchar(6) default NULL,
  body_vlink varchar(6) default NULL,
  body_alink varchar(6) default NULL,
  body_hlink varchar(6) default NULL,
  tr_color1 varchar(6) default NULL,
  tr_color2 varchar(6) default NULL,
  tr_color3 varchar(6) default NULL,
  tr_class1 varchar(25) default NULL,
  tr_class2 varchar(25) default NULL,
  tr_class3 varchar(25) default NULL,
  th_color1 varchar(6) default NULL,
  th_color2 varchar(6) default NULL,
  th_color3 varchar(6) default NULL,
  th_class1 varchar(25) default NULL,
  th_class2 varchar(25) default NULL,
  th_class3 varchar(25) default NULL,
  td_color1 varchar(6) default NULL,
  td_color2 varchar(6) default NULL,
  td_color3 varchar(6) default NULL,
  td_class1 varchar(25) default NULL,
  td_class2 varchar(25) default NULL,
  td_class3 varchar(25) default NULL,
  fontface1 varchar(50) default NULL,
  fontface2 varchar(50) default NULL,
  fontface3 varchar(50) default NULL,
  fontsize1 tinyint(4) default NULL,
  fontsize2 tinyint(4) default NULL,
  fontsize3 tinyint(4) default NULL,
  fontcolor1 varchar(6) default NULL,
  fontcolor2 varchar(6) default NULL,
  fontcolor3 varchar(6) default NULL,
  span_class1 varchar(25) default NULL,
  span_class2 varchar(25) default NULL,
  span_class3 varchar(25) default NULL,
  img_size_poll smallint(5) unsigned default NULL,
  img_size_privmsg smallint(5) unsigned default NULL,
  PRIMARY KEY  (themes_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_themes_name`
#

CREATE TABLE phpbb_themes_name (
  themes_id smallint(5) unsigned NOT NULL default '0',
  tr_color1_name char(50) default NULL,
  tr_color2_name char(50) default NULL,
  tr_color3_name char(50) default NULL,
  tr_class1_name char(50) default NULL,
  tr_class2_name char(50) default NULL,
  tr_class3_name char(50) default NULL,
  th_color1_name char(50) default NULL,
  th_color2_name char(50) default NULL,
  th_color3_name char(50) default NULL,
  th_class1_name char(50) default NULL,
  th_class2_name char(50) default NULL,
  th_class3_name char(50) default NULL,
  td_color1_name char(50) default NULL,
  td_color2_name char(50) default NULL,
  td_color3_name char(50) default NULL,
  td_class1_name char(50) default NULL,
  td_class2_name char(50) default NULL,
  td_class3_name char(50) default NULL,
  fontface1_name char(50) default NULL,
  fontface2_name char(50) default NULL,
  fontface3_name char(50) default NULL,
  fontsize1_name char(50) default NULL,
  fontsize2_name char(50) default NULL,
  fontsize3_name char(50) default NULL,
  fontcolor1_name char(50) default NULL,
  fontcolor2_name char(50) default NULL,
  fontcolor3_name char(50) default NULL,
  span_class1_name char(50) default NULL,
  span_class2_name char(50) default NULL,
  span_class3_name char(50) default NULL,
  PRIMARY KEY  (themes_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_topics`
#

CREATE TABLE phpbb_topics (
  topic_id mediumint(8) unsigned NOT NULL auto_increment,
  forum_id smallint(8) unsigned NOT NULL default '0',
  topic_title varchar(60) NOT NULL default '',
  topic_desc varchar(255) default '',
  topic_poster mediumint(8) NOT NULL default '0',
  topic_time int(11) NOT NULL default '0',
  topic_views mediumint(8) unsigned NOT NULL default '0',
  topic_replies mediumint(8) unsigned NOT NULL default '0',
  topic_status tinyint(3) NOT NULL default '0',
  topic_info varchar(20) default NULL,
  topic_vote tinyint(1) NOT NULL default '0',
  topic_type tinyint(3) NOT NULL default '0',
  topic_first_post_id mediumint(8) unsigned NOT NULL default '0',
  topic_last_post_id mediumint(8) unsigned NOT NULL default '0',
  topic_moved_id mediumint(8) unsigned NOT NULL default '0',
  topic_attachment TINYINT(1) DEFAULT '0' NOT NULL,
  news_id int(10) unsigned NOT NULL default '0',
  topic_announce_duration mediumint(5) NOT NULL default '0',
  topic_calendar_time int(11) default NULL,
  topic_calendar_duration int(11) default NULL,
  topic_icon tinyint(2) default NULL,
  topic_calendar_repeat varchar(4) default NULL,
  rating_rank_id smallint(5) unsigned NOT NULL default '0',
  topic_reported tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (topic_id),
  KEY forum_id (forum_id),
  KEY topic_moved_id (topic_moved_id),
  KEY topic_status (topic_status),
  KEY topic_type (topic_type),
  KEY news_id (news_id),
  KEY topic_calendar_time (topic_calendar_time),
  KEY topics_ratingrankid (rating_rank_id),
  KEY topic_first_post_id (topic_first_post_id)

);

# --------------------------------------------------------

#
# Table structure for table `phpbb_topics_watch`
#

CREATE TABLE phpbb_topics_watch (
  topic_id mediumint(8) unsigned NOT NULL default '0',
  user_id mediumint(8) NOT NULL default '0',
  notify_status tinyint(1) NOT NULL default '0',
  KEY topic_id (topic_id),
  KEY user_id (user_id),
  KEY notify_status (notify_status)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_user_group`
#

CREATE TABLE phpbb_user_group (
  group_id mediumint(8) NOT NULL default '0',
  user_id mediumint(8) NOT NULL default '0',
  user_pending tinyint(1) default NULL,
  group_moderator tinyint(1) NOT NULL default '0',
  ug_expire_date int(11) default '0',
  ug_active_date int(11) default '0',
  KEY group_id (group_id),
  KEY user_id (user_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_users`
#

CREATE TABLE phpbb_users (
  user_id mediumint(8) NOT NULL default '0',
  user_active tinyint(1) default '1',
  username varchar(25) NOT NULL default '',
  user_password varchar(32) NOT NULL default '',
  user_session_time int(11) NOT NULL default '0',
  user_session_page smallint(5) NOT NULL default '0',
  user_lastvisit int(11) NOT NULL default '0',
  user_regdate int(11) NOT NULL default '0',
  user_level tinyint(4) default '0',
  user_posts mediumint(8) unsigned NOT NULL default '0',
  user_timezone decimal(5,2) NOT NULL default '0.00',
  user_style tinyint(4) default NULL,
  user_lang varchar(255) default NULL,
  user_dateformat varchar(14) NOT NULL default 'd M Y H:i',
  user_new_privmsg smallint(5) unsigned NOT NULL default '0',
  user_unread_privmsg smallint(5) unsigned NOT NULL default '0',
  user_last_privmsg int(11) NOT NULL default '0',
  user_login_tries smallint(5) unsigned NOT NULL default '0',
  user_last_login_try int(11) NOT NULL default '0',
	user_emailtime int(11) default 0,
  user_viewemail tinyint(1) default 0,
  user_attachsig tinyint(1) default NULL,
  user_setbm tinyint(1) NOT NULL default '0',
  user_allowhtml tinyint(1) default '1',
  user_allowbbcode tinyint(1) default '1',
  user_allowsmile tinyint(1) default '1',
  user_allowavatar tinyint(1) NOT NULL default '1',
  user_allowphoto tinyint(1) NOT NULL default '1',
  user_allow_pm tinyint(1) NOT NULL default '1',
  user_allow_viewonline tinyint(1) NOT NULL default '1',
  user_notify tinyint(1) NOT NULL default '1',
  user_notify_pm tinyint(1) NOT NULL default '0',
  user_popup_pm tinyint(1) NOT NULL default '0',
  user_rank int(11) default '0',
  user_avatar varchar(100) default NULL,
  user_avatar_type tinyint(4) NOT NULL default '0',
  user_photo varchar(100) default NULL,
  user_photo_type tinyint(4) NOT NULL default '0',
  user_email varchar(255) default NULL,
  user_icq varchar(15) default NULL,
  user_website varchar(100) default NULL,
  user_from varchar(100) default NULL,
  user_sig text,
  user_sig_bbcode_uid varchar(10) default NULL,
  user_aim varchar(255) default NULL,
  user_yim varchar(255) default NULL,
  user_msnm varchar(255) default NULL,
  user_skype varchar(255) default NULL,
  user_occ varchar(100) default NULL,
  user_interests varchar(255) default NULL,
  user_actkey varchar(32) default NULL,
  user_newpasswd varchar(32) default NULL,
  user_realname varchar(25) NOT NULL default '',
  user_gender tinyint(1) unsigned NOT NULL default '0',
  user_birthday varchar(8) NOT NULL default '0',
  user_last_birthday int(11) unsigned NOT NULL default '0',
  user_home_phone varchar(20) default NULL,
  user_home_fax varchar(20) default NULL,
  user_work_phone varchar(20) default NULL,
  user_work_fax varchar(20) default NULL,
  user_cellular varchar(20) default NULL,
  user_pager varchar(20) default NULL,
  user_summer_time tinyint(1) unsigned NOT NULL default '0',
  user_list_option varchar(255) default NULL,
  user_allow_email tinyint(1) NOT NULL default '1',
  user_allow_website tinyint(1) NOT NULL default '1',
  user_allow_messenger tinyint(1) NOT NULL default '1',
  user_allow_real tinyint(1) NOT NULL default '1',
  user_allow_sig tinyint(1) NOT NULL default '1',
  user_viewpm tinyint(1) NOT NULL default '1',
  user_viewwebsite tinyint(1) NOT NULL default '1',
  user_viewmessenger tinyint(1) NOT NULL default '1',
  user_viewreal tinyint(1) NOT NULL default '1',
  user_viewavatar tinyint(1) NOT NULL default '1',
  user_viewphoto tinyint(1) NOT NULL default '1',
  user_viewsig tinyint(1) NOT NULL default '1',
  user_viewimg tinyint(1) NOT NULL default '1',
  user_buddy_friend_display tinyint(1) default '1',
  user_buddy_ignore_display tinyint(1) default '1',
  user_buddy_friend_of_display tinyint(1) default '1',
  user_buddy_ignored_by_display tinyint(1) default '1',
  user_watched_topics_per_page smallint(3) default '15',
  user_privmsgs_per_page smallint(3) default '5',
  user_sub_forum tinyint(1) NOT NULL default '1',
  user_split_cat tinyint(1) NOT NULL default '1',
  user_last_topic_title tinyint(1) NOT NULL default '1',
  user_sub_level_links tinyint(1) NOT NULL default '2',
  user_display_viewonline tinyint(1) NOT NULL default '2',
  user_announcement_date_display tinyint(1) NOT NULL default '1',
  user_announcement_display tinyint(1) NOT NULL default '1',
  user_announcement_display_forum tinyint(1) NOT NULL default '1',
  user_announcement_split tinyint(1) NOT NULL default '1',
  user_announcement_forum tinyint(1) NOT NULL default '1',
  user_calendar_display_open tinyint(1) NOT NULL default '0',
  user_calendar_header_cells tinyint(1) NOT NULL default '7',
  user_fdow tinyint(1) NOT NULL default '1',
  user_calendar_nb_row tinyint(2) unsigned NOT NULL default '5',
  user_calendar_birthday tinyint(1) NOT NULL default '1',
  user_calendar_forum tinyint(1) NOT NULL default '1',
  user_last_topics_from_started tinyint(2) NOT NULL default '3',
  user_last_topics_from_replied tinyint(2) NOT NULL default '3',
  user_last_topics_from_ended tinyint(2) NOT NULL default '3',
  user_last_topics_from_split tinyint(1) NOT NULL default '1',
  user_last_topics_from_forum tinyint(1) NOT NULL default '1',
  user_split_global_announce tinyint(1) NOT NULL default '1',
  user_split_announce tinyint(1) NOT NULL default '1',
  user_split_sticky tinyint(1) NOT NULL default '1',
  user_split_topic_split tinyint(1) NOT NULL default '0',
  user_points decimal(11,0) NOT NULL default '0',
  user_unread_topics text,
  user_topics_last_per_page smallint(2) NOT NULL default '15',
  user_flag varchar(25) default NULL,
  user_holidays tinyint(1) unsigned NOT NULL default '2',
  user_warnings smallint(5) default '0',
  user_rules int(11) NOT NULL default '0',
  rating_status tinyint(3) unsigned NOT NULL default '0',
  user_extra tinyint(2) not null default '0',
  user_allowsignature tinyint(1) not null default '1',
  user_actviate_date int(11) default '0',
  user_expire_date int(11) default '0',
  user_inactive_emls tinyint( 1 ) NOT NULL default '0',
  user_inactive_last_eml int( 11 ) NOT NULL default '0',
  user_state varchar(3) NOT NULL default '0',
  user_country varchar(3) NOT NULL default '0',
  phpBBSecurity_answer mediumtext NOT NULL,
  phpBBSecurity_question mediumtext NOT NULL,
  phpBBSecurity_login_tries smallint(5) NOT NULL default '0',
  phpBBSecurity_pm_sent smallint(1) NOT NULL default '0',
  user_group_id MEDIUMINT(8) DEFAULT 0 NOT NULL,
  PRIMARY KEY  (user_id),
  KEY user_session_time (user_session_time)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_vote_desc`
#

CREATE TABLE phpbb_vote_desc (
  vote_id mediumint(8) unsigned NOT NULL auto_increment,
  topic_id mediumint(8) unsigned NOT NULL default '0',
  vote_text mediumtext NOT NULL,
  vote_start int(11) NOT NULL default '0',
  vote_length int(11) NOT NULL default '0',
  vote_max int(3) NOT NULL default '1',
  vote_voted int(7) NOT NULL default '0',
  vote_hide tinyint(1) NOT NULL default '0',
  vote_tothide tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (vote_id),
  KEY topic_id (topic_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_vote_results`
#

CREATE TABLE phpbb_vote_results (
  vote_id mediumint(8) unsigned NOT NULL default '0',
  vote_option_id tinyint(4) unsigned NOT NULL default '0',
  vote_option_text varchar(255) NOT NULL default '',
  vote_result int(11) NOT NULL default '0',
  KEY vote_option_id (vote_option_id),
  KEY vote_id (vote_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_vote_voters`
#

CREATE TABLE phpbb_vote_voters (
  vote_id mediumint(8) unsigned NOT NULL default '0',
  vote_user_id mediumint(8) NOT NULL default '0',
  vote_user_ip char(8) NOT NULL default '',
  KEY vote_id (vote_id),
  KEY vote_user_id (vote_user_id),
  KEY vote_user_ip (vote_user_ip)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_words`
#

CREATE TABLE phpbb_words (
  word_id mediumint(8) unsigned NOT NULL auto_increment,
  word char(100) NOT NULL default '',
  replacement char(100) NOT NULL default '',
  PRIMARY KEY  (word_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_wpm`
#

CREATE TABLE phpbb_wpm (
	name varchar(255) NOT NULL default '',
	value mediumtext NOT NULL
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_color`
#

CREATE TABLE phpbb_color (
  group_id mediumint(8) NOT NULL default '0',
  color_code varchar(6) NOT NULL default '',
  themes_id mediumint(8) NOT NULL default '0',
  hover_bold smallint(1) NOT NULL default '0',
  hover_italic smallint(1) NOT NULL default '0',
  hover_underline smallint(1) NOT NULL default '0',
  bold smallint(1) NOT NULL default '0',
  italic smallint(1) NOT NULL default '0',
  underline smallint(1) NOT NULL default '0',
  KEY group_id (group_id),
  KEY themes_id (themes_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_reports`
#

CREATE TABLE phpbb_reports (
  report_id mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id mediumint(8) NOT NULL,
  report_time int(11) NOT NULL,
  report_last_change mediumint(8) UNSIGNED DEFAULT NULL,
  report_module_id mediumint(8) UNSIGNED NOT NULL,
  report_status tinyint(1) NOT NULL,
  report_reason_id mediumint(8) UNSIGNED NOT NULL,
  report_subject int(11) NOT NULL,
  report_subject_data mediumtext NULL,
  report_title varchar(255) NOT NULL,
  report_desc mediumtext NOT NULL,
  reportee_user_id mediumint(8) NULL,
  reportee_username varchar(25) NULL,
  PRIMARY KEY (report_id),
  KEY user_id (user_id),
  KEY report_time (report_time),
  KEY report_type_id (report_module_id),
  KEY report_status (report_status),
  KEY report_reason_id (report_reason_id),
  KEY report_subject (report_subject),
  KEY report_reportee_user_id (reportee_user_id)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_reports_changes`
#

CREATE TABLE phpbb_reports_changes (
  report_change_id mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  report_id mediumint(8) UNSIGNED NOT NULL,
  user_id mediumint(8) NOT NULL,
  report_change_time int(11) NOT NULL,
  report_status tinyint(1) NOT NULL,
  report_change_comment mediumtext NOT NULL,
  PRIMARY KEY (report_change_id),
  KEY report_id (report_id),
  KEY user_id (user_id),
  KEY report_change_time (report_change_time)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_reports_modules`
#

CREATE TABLE phpbb_reports_modules (
  report_module_id mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  report_module_order mediumint(8) UNSIGNED NOT NULL,
  report_module_notify tinyint(1) NOT NULL,
  report_module_prune smallint(6) NOT NULL,
  report_module_last_prune int(11) DEFAULT NULL,
  report_module_name varchar(50) NOT NULL,
  auth_write tinyint(1) NOT NULL,
  auth_view tinyint(1) NOT NULL,
  auth_notify tinyint(1) NOT NULL,
  auth_delete tinyint(1) NOT NULL,
  PRIMARY KEY (report_module_id),
  KEY report_module_order (report_module_order),
  KEY auth_view (auth_view)
);

# --------------------------------------------------------

#
# Table structure for table `phpbb_reports_reasons`
#

CREATE TABLE phpbb_reports_reasons (
  report_reason_id mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  report_module_id mediumint(8) UNSIGNED NOT NULL,
  report_reason_order mediumint(8) UNSIGNED NOT NULL,
  report_reason_desc varchar(255) NOT NULL,
  PRIMARY KEY (report_reason_id),
  KEY report_type_id (report_module_id),
  KEY report_reason_order (report_reason_order)
);
