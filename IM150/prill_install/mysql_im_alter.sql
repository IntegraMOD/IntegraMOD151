#
# Alterations to pre-existing tables for Prillian Messenger
#

# -- PRIV_MSGS
ALTER TABLE phpbb_privmsgs ADD privmsgs_from_username varchar(25) DEFAULT '' NOT NULL;
ALTER TABLE phpbb_privmsgs ADD privmsgs_to_username varchar(25) DEFAULT '' NOT NULL;
ALTER TABLE phpbb_privmsgs ADD site_id mediumint(8) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_privmsgs ADD room_id mediumint(8) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_privmsgs ADD INDEX room_id (room_id);
ALTER TABLE phpbb_privmsgs ADD INDEX site_id (site_id);


# --------------------------------------------------------
# The installer script does not use the following, but this shows what the privmsgs
# table structure should look like when the above is done.
#
# Table structure for table 'phpbb_privmsgs'
#
#CREATE TABLE phpbb_privmsgs (
#   privmsgs_id mediumint(8) UNSIGNED NOT NULL auto_increment,
#   privmsgs_type tinyint(4) DEFAULT '0' NOT NULL,
#   privmsgs_subject varchar(255) DEFAULT '0' NOT NULL,
#   privmsgs_from_userid mediumint(8) DEFAULT '0' NOT NULL,
#   privmsgs_to_userid mediumint(8) DEFAULT '0' NOT NULL,
#   privmsgs_date int(11) DEFAULT '0' NOT NULL,
#   privmsgs_ip char(8) NOT NULL,
#   privmsgs_enable_bbcode tinyint(1) DEFAULT '1' NOT NULL,
#   privmsgs_enable_html tinyint(1) DEFAULT '0' NOT NULL,
#   privmsgs_enable_smilies tinyint(1) DEFAULT '1' NOT NULL,
#   privmsgs_attach_sig tinyint(1) DEFAULT '1' NOT NULL,
#   privmsgs_from_username varchar(25) DEFAULT '' NOT NULL,
#   privmsgs_to_username varchar(25) DEFAULT '' NOT NULL,
#   site_id mediumint(8) DEFAULT '0' NOT NULL,
#   room_id mediumint(8) DEFAULT '0' NOT NULL,
#   PRIMARY KEY (privmsgs_id),
#   KEY privmsgs_from_userid (privmsgs_from_userid),
#   KEY privmsgs_to_userid (privmsgs_to_userid),
#   KEY room_id (room_id),
#   KEY site_id (site_id)
#);