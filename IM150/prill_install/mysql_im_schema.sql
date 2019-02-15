#
# Prillian MySQL Schema
# Last updated in Prillian 0.7.0
# 

# --------------------------------------------------------
#
# Table structure for table `phpbb_im_prefs`
#
# You might want to change the default values for some of the columns in this
# table if you want to restrict the default settings for users.  Any column with
# "tinyint(1)" can have default values of 1 (on/true) or 0 (off/false).  The
# exceptions to this are:
# show_controls : 0 = no controls, 1 = images only, 2 = links only, 3 = both
# list_all_online : 1 = all online users, 2 = buddies on forums, 3 = buddies on IM,
#     4 = all users on im
# refresh_method : 0 = Meta, 1 = Javascript, 2 = Both
# network_user_list : 0 = Don't list Off-Site Users, 1 = List with On-Sites,
#     2 = List separately
# default_mode : 0 = Last mode used, 1 = Main Mode, 2 = Wide Mode, 3 = Mini Mode
# current_mode : 1 = Main Mode, 2 = Wide Mode, 3 = Mini Mode

CREATE TABLE phpbb_im_prefs (
  user_id mediumint(8) NOT NULL default '0',
  user_allow_ims tinyint(1) NOT NULL default '1',
  user_allow_shout tinyint(1) NOT NULL default '1',
  user_allow_chat tinyint(1) NOT NULL default '1',
  user_allow_network tinyint(1) NOT NULL default '1',
  admin_allow_ims tinyint(1) NOT NULL default '1',
  admin_allow_shout tinyint(1) NOT NULL default '1',
  admin_allow_chat tinyint(1) NOT NULL default '1',
  admin_allow_network tinyint(1) NOT NULL default '1',
  new_ims smallint(5) unsigned NOT NULL default '0',
  unread_ims smallint(5) unsigned NOT NULL default '0',
  read_ims smallint(5) unsigned NOT NULL default '0',
  total_sent mediumint(8) unsigned NOT NULL default '0',
  attach_sig tinyint(1) NOT NULL default '0',
  refresh_rate smallint(5) unsigned NOT NULL default '60',
  success_close tinyint(1) NOT NULL default '1',
  refresh_method tinyint(1) NOT NULL default '2',
  auto_launch tinyint(1) NOT NULL default '1',
  popup_ims tinyint(1) NOT NULL default '1',
  list_ims tinyint(1) NOT NULL default '0',
  show_controls tinyint(1) NOT NULL default '1',
  list_all_online tinyint(1) NOT NULL default '1',
  default_mode tinyint(1) NOT NULL default '1',
  current_mode tinyint(1) NOT NULL default '1',
  mode1_height varchar(4) NOT NULL default '400',
  mode1_width varchar(4) NOT NULL default '225',
  mode2_height varchar(4) NOT NULL default '225',
  mode2_width varchar(4) NOT NULL default '400',
  mode3_height varchar(4) NOT NULL default '100',
  mode3_width varchar(4) NOT NULL default '400',
  prefs_width varchar(4) NOT NULL default '500',
  prefs_height varchar(4) NOT NULL default '350',
  read_height varchar(4) NOT NULL default '300',
  read_width varchar(4) NOT NULL default '400',
  send_height varchar(4) NOT NULL default '365',
  send_width varchar(4) NOT NULL default '460',
  play_sound tinyint(1) NOT NULL default '1',
  default_sound tinyint(1) NOT NULL default '1',
  sound_name varchar(255) default NULL,
  themes_id mediumint(8) unsigned NOT NULL default '1',
  network_user_list tinyint(1) NOT NULL default '1',
  open_pms tinyint(1) NOT NULL default '0',
  auto_delete tinyint(1) NOT NULL default '0',
  use_frames tinyint(1) NOT NULL default '1',
  user_override tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (user_id)
);

# --------------------------------------------------------
#
# Table structure for table `phpbb_contact_list`
#

CREATE TABLE phpbb_contact_list (
  user_id mediumint(8) NOT NULL default '0',
  contact_id mediumint(8) NOT NULL default '0',
  user_ignore tinyint(1) NOT NULL default '0',
  alert tinyint(1) NOT NULL default '0',
  alert_status tinyint(1) NOT NULL default '0',
  disallow tinyint(1) NOT NULL default '0',
  display_name varchar(25) NOT NULL default '',
  KEY contact_id (contact_id),
  KEY user_id (user_id)
);

# --------------------------------------------------------
#
# Table structure for table 'phpbb_im_sites'
#
CREATE TABLE phpbb_im_sites (
  site_id mediumint(8) NOT NULL auto_increment,
  site_name varchar(50) NOT NULL default '',
  site_url varchar(100) NOT NULL default '',
  site_phpex varchar(4) NOT NULL default 'php',
  site_profile varchar(50) NOT NULL default 'profile',
  site_enable tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (site_id)
);

# --------------------------------------------------------
#
# Table structure for table 'phpbb_im_sessions'
#
CREATE TABLE phpbb_im_sessions (
  session_user_id mediumint(8) NOT NULL default '0',
  session_id char(32) NOT NULL default '',
  session_time int(11) NOT NULL default '0',
  session_popup tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (session_id),
  KEY session_user_id (session_user_id)
);

# --------------------------------------------------------
#
# Table structure for table 'phpbb_im_config'
#
CREATE TABLE phpbb_im_config (
  config_name varchar(190) NOT NULL default '',
  config_value varchar(255) NOT NULL default '',
  PRIMARY KEY  (config_name)
);

