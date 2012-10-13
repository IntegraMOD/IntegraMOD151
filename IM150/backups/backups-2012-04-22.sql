-- MySQL dump 10.13  Distrib 5.5.21, for Linux (x86_64)
--
-- Host: localhost    Database: importal_IM150
-- ------------------------------------------------------
-- Server version	5.5.21-cll

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `phpbb_account_hist`
--

DROP TABLE IF EXISTS `phpbb_account_hist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_account_hist` (
  `user_id` mediumint(8) DEFAULT '0',
  `lw_post_id` mediumint(8) DEFAULT '0',
  `lw_money` float DEFAULT '0',
  `lw_plus_minus` smallint(5) DEFAULT '0',
  `MNY_CURRENCY` varchar(8) DEFAULT '',
  `lw_date` int(11) DEFAULT '0',
  `comment` varchar(255) DEFAULT '',
  `status` varchar(64) DEFAULT '',
  `txn_id` varchar(64) DEFAULT '',
  `lw_site` varchar(10) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_account_hist`
--

LOCK TABLES `phpbb_account_hist` WRITE;
/*!40000 ALTER TABLE `phpbb_account_hist` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_account_hist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_acronyms`
--

DROP TABLE IF EXISTS `phpbb_acronyms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_acronyms` (
  `acronym_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `acronym` varchar(80) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`acronym_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_acronyms`
--

LOCK TABLES `phpbb_acronyms` WRITE;
/*!40000 ALTER TABLE `phpbb_acronyms` DISABLE KEYS */;
INSERT INTO `phpbb_acronyms` VALUES (1,'IntegraMOD','The best phpBB pre-modded package that ever exists. (www.integramod.com).');
/*!40000 ALTER TABLE `phpbb_acronyms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_admin_pm`
--

DROP TABLE IF EXISTS `phpbb_admin_pm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_admin_pm` (
  `admin_id` int(10) DEFAULT '0',
  `admin_redirect_id` int(10) DEFAULT '0',
  `admin_deny` int(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_admin_pm`
--

LOCK TABLES `phpbb_admin_pm` WRITE;
/*!40000 ALTER TABLE `phpbb_admin_pm` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_admin_pm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_album`
--

DROP TABLE IF EXISTS `phpbb_album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_album` (
  `pic_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pic_filename` varchar(255) NOT NULL DEFAULT '',
  `pic_thumbnail` varchar(255) DEFAULT NULL,
  `pic_title` varchar(255) NOT NULL DEFAULT '',
  `pic_desc` text,
  `pic_user_id` mediumint(8) NOT NULL DEFAULT '0',
  `pic_username` varchar(32) DEFAULT NULL,
  `pic_user_ip` varchar(8) NOT NULL DEFAULT '0',
  `pic_time` int(11) unsigned NOT NULL DEFAULT '0',
  `pic_cat_id` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `pic_view_count` int(11) unsigned NOT NULL DEFAULT '0',
  `pic_lock` tinyint(3) NOT NULL DEFAULT '0',
  `pic_approval` tinyint(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pic_id`),
  KEY `pic_cat_id` (`pic_cat_id`),
  KEY `pic_user_id` (`pic_user_id`),
  KEY `pic_time` (`pic_time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_album`
--

LOCK TABLES `phpbb_album` WRITE;
/*!40000 ALTER TABLE `phpbb_album` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_album_cat`
--

DROP TABLE IF EXISTS `phpbb_album_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_album_cat` (
  `cat_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(255) NOT NULL DEFAULT '',
  `cat_desc` text,
  `cat_order` mediumint(8) NOT NULL DEFAULT '0',
  `cat_view_level` tinyint(3) NOT NULL DEFAULT '-1',
  `cat_upload_level` tinyint(3) NOT NULL DEFAULT '0',
  `cat_rate_level` tinyint(3) NOT NULL DEFAULT '0',
  `cat_comment_level` tinyint(3) NOT NULL DEFAULT '0',
  `cat_edit_level` tinyint(3) NOT NULL DEFAULT '0',
  `cat_delete_level` tinyint(3) NOT NULL DEFAULT '2',
  `cat_view_groups` varchar(255) DEFAULT NULL,
  `cat_upload_groups` varchar(255) DEFAULT NULL,
  `cat_rate_groups` varchar(255) DEFAULT NULL,
  `cat_comment_groups` varchar(255) DEFAULT NULL,
  `cat_edit_groups` varchar(255) DEFAULT NULL,
  `cat_delete_groups` varchar(255) DEFAULT NULL,
  `cat_moderator_groups` varchar(255) DEFAULT NULL,
  `cat_approval` tinyint(3) NOT NULL DEFAULT '0',
  `cat_parent` mediumint(8) unsigned DEFAULT '0',
  `cat_user_id` mediumint(8) unsigned DEFAULT '0',
  PRIMARY KEY (`cat_id`),
  KEY `cat_order` (`cat_order`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_album_cat`
--

LOCK TABLES `phpbb_album_cat` WRITE;
/*!40000 ALTER TABLE `phpbb_album_cat` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_album_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_album_comment`
--

DROP TABLE IF EXISTS `phpbb_album_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_album_comment` (
  `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `comment_pic_id` int(11) unsigned NOT NULL DEFAULT '0',
  `comment_cat_id` int(11) NOT NULL DEFAULT '0',
  `comment_user_id` mediumint(8) NOT NULL DEFAULT '0',
  `comment_username` varchar(32) DEFAULT NULL,
  `comment_user_ip` varchar(8) NOT NULL DEFAULT '',
  `comment_time` int(11) unsigned NOT NULL DEFAULT '0',
  `comment_text` text,
  `comment_edit_time` int(11) unsigned DEFAULT NULL,
  `comment_edit_count` smallint(5) unsigned NOT NULL DEFAULT '0',
  `comment_edit_user_id` mediumint(8) DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `comment_pic_id` (`comment_pic_id`),
  KEY `comment_user_id` (`comment_user_id`),
  KEY `comment_user_ip` (`comment_user_ip`),
  KEY `comment_time` (`comment_time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_album_comment`
--

LOCK TABLES `phpbb_album_comment` WRITE;
/*!40000 ALTER TABLE `phpbb_album_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_album_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_album_config`
--

DROP TABLE IF EXISTS `phpbb_album_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_album_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_album_config`
--

LOCK TABLES `phpbb_album_config` WRITE;
/*!40000 ALTER TABLE `phpbb_album_config` DISABLE KEYS */;
INSERT INTO `phpbb_album_config` VALUES ('max_pics','1024'),('user_pics_limit','-1'),('mod_pics_limit','-1'),('max_file_size','128000'),('max_width','1024'),('max_height','768'),('rows_per_page','5'),('cols_per_page','4'),('fullpic_popup','0'),('thumbnail_quality','75'),('thumbnail_size','125'),('thumbnail_cache','1'),('sort_method','pic_time'),('sort_order','DESC'),('jpg_allowed','1'),('png_allowed','1'),('gif_allowed','1'),('desc_length','512'),('hotlink_prevent','0'),('hotlink_allowed','mightygorgon.com'),('personal_gallery','0'),('personal_gallery_private','0'),('personal_gallery_limit','-1'),('personal_gallery_view','-1'),('rate','1'),('rate_scale','10'),('comment','1'),('gd_version','2'),('album_version','.0.53'),('fap_version','1.2.3'),('show_index_thumb','0'),('show_index_total_pics','1'),('show_index_total_comments','1'),('show_index_comments','0'),('show_index_last_comment','1'),('show_index_last_pic','1'),('show_index_pics','0'),('show_recent_in_subcats','1'),('show_recent_instead_of_nopics','1'),('line_break_subcats','1'),('show_index_subcats','1'),('personal_allow_gallery_mod','0'),('personal_allow_sub_categories','0'),('personal_sub_category_limit','-1'),('personal_show_subcats_in_index','0'),('personal_show_recent_in_subcats','0'),('personal_show_recent_instead_of_nopics','0'),('show_personal_gallery_link','1'),('album_category_sorting','cat_order'),('album_category_sorting_direction','ASC'),('album_debug_mode','0'),('show_all_in_personal_gallery','1'),('new_pic_check_interval','1M'),('index_enable_supercells','0'),('email_notification','0'),('show_download','2'),('show_slideshow','1'),('show_pic_size_on_thumb','1'),('hon_rate_users','0'),('hon_rate_where',''),('hon_rate_sep','1'),('hon_rate_times','1'),('disp_watermark_at','3'),('wut_users','0'),('use_watermark','0'),('rate_type','2'),('disp_rand','1'),('disp_mostv','1'),('disp_high','1'),('disp_late','1'),('img_cols','4'),('img_rows','1'),('midthumb_use','1'),('midthumb_height','600'),('midthumb_width','800'),('midthumb_cache','1'),('max_files_to_upload','1'),('max_pregenerated_fields','1'),('dynamic_fields','1'),('pregenerate_fields','0'),('propercase_pic_title','1'),('show_index_last_pic_lv','0'),('personal_pics_approval','0'),('show_img_no_gd','0'),('dynamic_pic_resampling','1'),('max_file_size_resampling','1024000'),('switch_nuffload','0'),('path_to_bin','./cgi-bin/'),('perl_uploader','1'),('show_progress_bar','1'),('close_on_finish','1'),('max_pause','5'),('simple_format','0'),('multiple_uploads','1'),('max_uploads','5'),('zip_uploads','1'),('resize_pic','1'),('resize_width','600'),('resize_height','600'),('resize_quality','70'),('show_pics_nav','1'),('show_inline_copyright','0'),('enable_nuffimage','1'),('enable_sepia_bw','0'),('personal_allow_avatar_gallery','0'),('show_gif_mid_thumb','1'),('slideshow_script','0'),('show_exif','0'),('album_bbcode','1');
/*!40000 ALTER TABLE `phpbb_album_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_album_rate`
--

DROP TABLE IF EXISTS `phpbb_album_rate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_album_rate` (
  `rate_pic_id` int(11) unsigned NOT NULL DEFAULT '0',
  `rate_user_id` mediumint(8) NOT NULL DEFAULT '0',
  `rate_user_ip` char(8) NOT NULL DEFAULT '',
  `rate_point` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `rate_hon_point` tinyint(3) NOT NULL DEFAULT '0',
  KEY `rate_pic_id` (`rate_pic_id`),
  KEY `rate_user_id` (`rate_user_id`),
  KEY `rate_user_ip` (`rate_user_ip`),
  KEY `rate_point` (`rate_point`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_album_rate`
--

LOCK TABLES `phpbb_album_rate` WRITE;
/*!40000 ALTER TABLE `phpbb_album_rate` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_album_rate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_approve_forums`
--

DROP TABLE IF EXISTS `phpbb_approve_forums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_approve_forums` (
  `forum_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `approve_posts` tinyint(1) NOT NULL DEFAULT '0',
  `approve_topics` tinyint(1) NOT NULL DEFAULT '0',
  `approve_users` tinyint(1) NOT NULL DEFAULT '0',
  `approve_poste` tinyint(1) NOT NULL DEFAULT '0',
  `approve_topice` tinyint(1) NOT NULL DEFAULT '0',
  `approve_notify` tinyint(1) NOT NULL DEFAULT '0',
  `approve_notify_approval` tinyint(1) NOT NULL DEFAULT '0',
  `approve_notify_type` tinyint(1) NOT NULL DEFAULT '0',
  `approve_notify_message` tinyint(1) NOT NULL DEFAULT '0',
  `approve_notify_message_len` smallint(5) NOT NULL DEFAULT '500',
  `approve_moderators` varchar(255) NOT NULL DEFAULT '0',
  `approve_notify_posts` tinyint(1) NOT NULL DEFAULT '0',
  `approve_notify_poste` tinyint(1) NOT NULL DEFAULT '0',
  `approve_notify_topics` tinyint(1) NOT NULL DEFAULT '0',
  `approve_notify_topice` tinyint(1) NOT NULL DEFAULT '0',
  `forum_hide_unapproved_topics` tinyint(1) NOT NULL DEFAULT '0',
  `forum_hide_unapproved_posts` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_approve_forums`
--

LOCK TABLES `phpbb_approve_forums` WRITE;
/*!40000 ALTER TABLE `phpbb_approve_forums` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_approve_forums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_approve_posts`
--

DROP TABLE IF EXISTS `phpbb_approve_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_approve_posts` (
  `approval_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `is_topic` tinyint(1) NOT NULL DEFAULT '0',
  `is_post` tinyint(1) NOT NULL DEFAULT '0',
  `poster_id` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`approval_id`),
  KEY `post_id` (`post_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_approve_posts`
--

LOCK TABLES `phpbb_approve_posts` WRITE;
/*!40000 ALTER TABLE `phpbb_approve_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_approve_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_approve_topics`
--

DROP TABLE IF EXISTS `phpbb_approve_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_approve_topics` (
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `approve_moderate` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_approve_topics`
--

LOCK TABLES `phpbb_approve_topics` WRITE;
/*!40000 ALTER TABLE `phpbb_approve_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_approve_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_approve_users`
--

DROP TABLE IF EXISTS `phpbb_approve_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_approve_users` (
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `approve_moderate` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_approve_users`
--

LOCK TABLES `phpbb_approve_users` WRITE;
/*!40000 ALTER TABLE `phpbb_approve_users` DISABLE KEYS */;
INSERT INTO `phpbb_approve_users` VALUES (-1,1);
/*!40000 ALTER TABLE `phpbb_approve_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_attach_quota`
--

DROP TABLE IF EXISTS `phpbb_attach_quota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_attach_quota` (
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `quota_type` smallint(2) NOT NULL DEFAULT '0',
  `quota_limit_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  KEY `quota_type` (`quota_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_attach_quota`
--

LOCK TABLES `phpbb_attach_quota` WRITE;
/*!40000 ALTER TABLE `phpbb_attach_quota` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_attach_quota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_attachments`
--

DROP TABLE IF EXISTS `phpbb_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_attachments` (
  `attach_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `privmsgs_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id_1` mediumint(8) NOT NULL,
  `user_id_2` mediumint(8) NOT NULL,
  KEY `attach_id_post_id` (`attach_id`,`post_id`),
  KEY `attach_id_privmsgs_id` (`attach_id`,`privmsgs_id`),
  KEY `post_id` (`post_id`),
  KEY `privmsgs_id` (`privmsgs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_attachments`
--

LOCK TABLES `phpbb_attachments` WRITE;
/*!40000 ALTER TABLE `phpbb_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_attachments_config`
--

DROP TABLE IF EXISTS `phpbb_attachments_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_attachments_config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` varchar(255) NOT NULL,
  PRIMARY KEY (`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_attachments_config`
--

LOCK TABLES `phpbb_attachments_config` WRITE;
/*!40000 ALTER TABLE `phpbb_attachments_config` DISABLE KEYS */;
INSERT INTO `phpbb_attachments_config` VALUES ('upload_dir','files'),('upload_img','images/icon_clip.gif'),('topic_icon','images/icon_clip.gif'),('display_order','0'),('max_filesize','262144'),('attachment_quota','52428800'),('max_filesize_pm','262144'),('max_attachments','3'),('max_attachments_pm','1'),('disable_mod','0'),('allow_pm_attach','1'),('attachment_topic_review','0'),('allow_ftp_upload','0'),('show_apcp','0'),('attach_version','2.3.13'),('default_upload_quota','0'),('default_pm_quota','0'),('ftp_server',''),('ftp_path',''),('download_path',''),('ftp_user',''),('ftp_pass',''),('ftp_pasv_mode','1'),('img_display_inlined','1'),('img_max_width','0'),('img_max_height','0'),('img_link_width','0'),('img_link_height','0'),('img_create_thumbnail','0'),('img_min_thumb_filesize','12000'),('img_imagick',''),('use_gd2','1'),('wma_autoplay','0'),('flash_autoplay','0');
/*!40000 ALTER TABLE `phpbb_attachments_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_attachments_desc`
--

DROP TABLE IF EXISTS `phpbb_attachments_desc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_attachments_desc` (
  `attach_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `physical_filename` varchar(255) NOT NULL,
  `real_filename` varchar(255) NOT NULL,
  `download_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `comment` varchar(255) DEFAULT NULL,
  `extension` varchar(100) DEFAULT NULL,
  `mimetype` varchar(100) DEFAULT NULL,
  `filesize` int(20) NOT NULL,
  `filetime` int(11) NOT NULL DEFAULT '0',
  `thumbnail` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`attach_id`),
  KEY `filetime` (`filetime`),
  KEY `physical_filename` (`physical_filename`(10)),
  KEY `filesize` (`filesize`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_attachments_desc`
--

LOCK TABLES `phpbb_attachments_desc` WRITE;
/*!40000 ALTER TABLE `phpbb_attachments_desc` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_attachments_desc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_auth_access`
--

DROP TABLE IF EXISTS `phpbb_auth_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_auth_access` (
  `group_id` mediumint(8) NOT NULL DEFAULT '0',
  `forum_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `auth_view` tinyint(1) NOT NULL DEFAULT '0',
  `auth_read` tinyint(1) NOT NULL DEFAULT '0',
  `auth_post` tinyint(1) NOT NULL DEFAULT '0',
  `auth_reply` tinyint(1) NOT NULL DEFAULT '0',
  `auth_edit` tinyint(1) NOT NULL DEFAULT '0',
  `auth_delete` tinyint(1) NOT NULL DEFAULT '0',
  `auth_sticky` tinyint(1) NOT NULL DEFAULT '0',
  `auth_announce` tinyint(1) NOT NULL DEFAULT '0',
  `auth_global_announce` tinyint(1) NOT NULL DEFAULT '0',
  `auth_vote` tinyint(1) NOT NULL DEFAULT '0',
  `auth_pollcreate` tinyint(1) NOT NULL DEFAULT '0',
  `auth_attachments` tinyint(1) NOT NULL DEFAULT '0',
  `auth_mod` tinyint(1) NOT NULL DEFAULT '0',
  `auth_download` tinyint(1) NOT NULL DEFAULT '0',
  `auth_news` tinyint(1) NOT NULL DEFAULT '0',
  `auth_cal` tinyint(1) NOT NULL DEFAULT '0',
  `auth_ban` tinyint(1) NOT NULL DEFAULT '0',
  `auth_greencard` tinyint(1) NOT NULL DEFAULT '0',
  `auth_bluecard` tinyint(1) NOT NULL DEFAULT '0',
  `auth_delayedpost` tinyint(4) NOT NULL DEFAULT '3',
  KEY `group_id` (`group_id`),
  KEY `forum_id` (`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_auth_access`
--

LOCK TABLES `phpbb_auth_access` WRITE;
/*!40000 ALTER TABLE `phpbb_auth_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_auth_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_banlist`
--

DROP TABLE IF EXISTS `phpbb_banlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_banlist` (
  `ban_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ban_userid` mediumint(8) NOT NULL DEFAULT '0',
  `ban_ip` varchar(8) NOT NULL DEFAULT '',
  `ban_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ban_id`),
  KEY `ban_ip_user_id` (`ban_ip`,`ban_userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_banlist`
--

LOCK TABLES `phpbb_banlist` WRITE;
/*!40000 ALTER TABLE `phpbb_banlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_banlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_banner`
--

DROP TABLE IF EXISTS `phpbb_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_banner` (
  `banner_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `banner_name` text NOT NULL,
  `banner_spot` smallint(1) unsigned NOT NULL DEFAULT '0',
  `banner_forum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `banner_description` varchar(30) NOT NULL DEFAULT '',
  `banner_url` varchar(90) NOT NULL DEFAULT '',
  `banner_owner` mediumint(8) NOT NULL DEFAULT '0',
  `banner_click` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `banner_view` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `banner_weigth` tinyint(1) unsigned NOT NULL DEFAULT '50',
  `banner_active` tinyint(1) NOT NULL DEFAULT '0',
  `banner_timetype` tinyint(1) NOT NULL DEFAULT '0',
  `time_begin` int(11) NOT NULL DEFAULT '0',
  `time_end` int(11) NOT NULL DEFAULT '0',
  `date_begin` int(11) NOT NULL DEFAULT '0',
  `date_end` int(11) NOT NULL DEFAULT '0',
  `banner_level` tinyint(1) NOT NULL DEFAULT '0',
  `banner_level_type` tinyint(1) NOT NULL DEFAULT '0',
  `banner_comment` varchar(50) NOT NULL DEFAULT '',
  `banner_type` mediumint(5) NOT NULL DEFAULT '0',
  `banner_width` mediumint(5) unsigned NOT NULL DEFAULT '0',
  `banner_height` mediumint(5) NOT NULL DEFAULT '0',
  `banner_filter` tinyint(1) NOT NULL DEFAULT '0',
  `banner_filter_time` mediumint(5) NOT NULL DEFAULT '600',
  KEY `banner_id` (`banner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_banner`
--

LOCK TABLES `phpbb_banner` WRITE;
/*!40000 ALTER TABLE `phpbb_banner` DISABLE KEYS */;
INSERT INTO `phpbb_banner` VALUES (1,'images/banners/phpBB_88a.gif',20,0,'phpbb2 community','http://www.phpbb.com',2,0,147,50,1,0,0,0,0,0,-1,2,'phpBB link',0,0,0,0,600),(2,'images/banners/forum_images_banner_88x31.gif',21,0,'forumimages.co.uk','http://www.forumimages.co.uk',2,0,147,50,1,0,0,0,0,0,-1,2,'forumimages link',0,0,0,0,600),(3,'images/banners/smartorsite_logo.gif',22,0,'Smartor Portal','http://smartor.is-root.com',2,0,147,50,1,0,0,0,0,0,-1,2,'Smartor link',0,0,0,0,600),(4,'images/banners/phpbbhacks.gif',23,0,'phpBBhacks.com','http://www.phpbbhacks.com',2,0,147,50,1,0,0,0,0,0,-1,2,'phpbbhacks link',0,0,0,0,600),(5,'images/banners/phpbbintegraMOD.jpg',0,0,'phpbb2 integraMOD','http://www.integramod.com',2,1,147,50,1,0,0,0,0,0,-1,2,'phpBB IntegraMOD',0,0,0,0,600);
/*!40000 ALTER TABLE `phpbb_banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_banner_stats`
--

DROP TABLE IF EXISTS `phpbb_banner_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_banner_stats` (
  `banner_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `click_date` int(11) NOT NULL DEFAULT '0',
  `click_ip` char(8) NOT NULL DEFAULT '',
  `click_user` mediumint(8) NOT NULL DEFAULT '0',
  `user_duration` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_banner_stats`
--

LOCK TABLES `phpbb_banner_stats` WRITE;
/*!40000 ALTER TABLE `phpbb_banner_stats` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_banner_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_block_position`
--

DROP TABLE IF EXISTS `phpbb_block_position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_block_position` (
  `bpid` int(10) NOT NULL AUTO_INCREMENT,
  `pkey` varchar(30) NOT NULL DEFAULT '',
  `bposition` char(1) NOT NULL DEFAULT '',
  `layout` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`bpid`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_block_position`
--

LOCK TABLES `phpbb_block_position` WRITE;
/*!40000 ALTER TABLE `phpbb_block_position` DISABLE KEYS */;
INSERT INTO `phpbb_block_position` VALUES (1,'header','@',0),(2,'footer','*',0),(3,'right','r',1),(4,'center','c',1),(5,'center','c',2),(6,'right','r',3),(7,'center','c',3),(8,'left','l',3),(9,'toprow','t',4),(10,'column1','c',4),(11,'column2','d',4),(12,'bottomrow','b',4),(13,'right','r',5),(14,'bottomrow','b',5),(15,'center','c',5),(16,'toprow','t',5),(17,'left','l',5),(18,'col_1','1',6),(19,'col_2','2',6),(20,'col_3','3',6),(21,'col_4','4',6),(22,'col_5','5',6),(23,'col_6','6',6);
/*!40000 ALTER TABLE `phpbb_block_position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_block_variable`
--

DROP TABLE IF EXISTS `phpbb_block_variable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_block_variable` (
  `bvid` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(30) NOT NULL DEFAULT '',
  `sub_label` varchar(255) DEFAULT NULL,
  `config_name` varchar(30) NOT NULL DEFAULT '',
  `field_options` varchar(255) DEFAULT NULL,
  `field_values` varchar(255) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `block` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`config_name`),
  KEY `bvid` (`bvid`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_block_variable`
--

LOCK TABLES `phpbb_block_variable` WRITE;
/*!40000 ALTER TABLE `phpbb_block_variable` DISABLE KEYS */;
INSERT INTO `phpbb_block_variable` VALUES (1,'Number of news on portal','','md_num_news','','',1,'forum'),(2,'Length of news','Number of characters displayed','md_news_length','','',1,'forum'),(3,'News Forum ID(s)','comma delimited','md_news_forum_id','','',1,'forum'),(4,'Random Attach Max Height','When the height > the width, this will be set as height in the img tag','md_ran_att_height','','',1,'Random Attachments'),(5,'Random Attach Max Width','When the width > the height, this will be set as width in the img tag','md_ran_att_width','','',1,'Random Attachments'),(6,'Random Attach Max Files','Maximum number of files to return','md_ran_att_max','','',1,'Random Attachments'),(7,'Random Attach Include Forum ID','comma delimited; leave blank for all forums','md_ran_att_forums_incl','','',1,'Random Attachments'),(8,'Random Attach Exclude Forum ID','comma delimited; leave blank for no exclusions','md_ran_att_forums_excl','','',1,'Random Attachments'),(9,'Category to retrieve pics from','Enter 0 for all categories or comma delimited entries','md_cat_id','','',1,'album'),(10,'Number of Images to Display','','md_pics_number','','',1,'album'),(11,'Random or Newest Pics?','','md_pics_sort','Newest,Random','0,1',3,'album'),(12,'Display from what galleries?','','md_pics_all','Public,Public and Personal','0,1',3,'album'),(13,'Number of announcements','','md_num_announcements','','',1,'announcements'),(14,'Length of announcements','Number of characters displayed','md_announcements_length','','',1,'announcements'),(15,'Announcements Forum ID(s)','comma delimited. put 0 for all forums','md_announcements_forum_id','','',1,'announcements'),(16,'Poll Forum ID(s)','comma delimited','md_poll_forum_id','','',1,'poll'),(17,'Poll Bar Length','decrease/increase the value for 1 vote bar length','md_poll_bar_length','','',1,'poll'),(18,'Top Downloads','Number of top downloads to display','md_num_top_downloads','','',1,'center_downloads'),(19,'New Downloads','Number of new downloads to display','md_num_new_downloads','','',1,'center_downloads'),(20,'Show not visited','Tick to display users who didn\'t visit the site','md_display_not_visit','','',4,'users_visited'),(21,'Number of hours to track users','','md_hours_track_users','','',1,'users_visited'),(22,'Scroll delay','higher values means slower scroll','md_scroll_delay','','',1,'users_visited'),(23,'Header width','Width of forum-wide left column in pixels','header_width','','',1,'@Portal Config'),(24,'Footer width','Width of forum-wide right column in pixels','footer_width','','',1,'@Portal Config'),(25,'Cache File Locking','can avoid cache corruption under bad circumstances','md_cache_file_locking','','',4,'@Portal Config'),(26,'Cache Write Control','detect some corrupt cache files','md_cache_write_control','','',4,'@Portal Config'),(27,'Cache Read Control','a control key is embeded in cache file','md_cache_read_control','','',4,'@Portal Config'),(28,'Cache Read Control Type','Type of read control (only if read control is enabled)','md_cache_read_type','md5 hash control, crc32 hash control, length only test','md5,crc32,strlen',2,'@Portal Config'),(29,'Cache File Name Protection','','md_cache_filename_protect','','',4,'@Portal Config'),(30,'Cache Automatic Serialization','Enable / disable automatic serialization','md_cache_serialize','','',4,'@Portal Config'),(31,'Donations display','Number of donations to display','md_num_new_donations','','',1,'donate'),(32,'Number of Recent Articles','number of articles shown','cm_total_articles','','',1,'recent_articles'),(33,'Links -> Style','choose static display or scrolling display','md_links_style','Scroll,Static','1,0',3,'links'),(34,'Links -> Own (Top)','show your own link button above other buttons (delete caches to take affect)','md_links_own1','Yes,No','1,0',3,'links'),(35,'Links -> Own (Bottom)','show your own link button below other buttons (delete caches to take affect)','md_links_own2','Yes,No','1,0',3,'links'),(36,'Links -> Code','show HTML for your own link button','md_links_code','Yes,No','1,0',3,'links'),(37,'Number of Referers','number of referers displayed. 0 means no limit','md_num_referers','','',1,'referers'),(38,'Referers Sort','How to sort the referers','md_sort_referers','Website,Hits,Time','referer_host,referer_hits DESC,referer_lastvisit',2,'referers'),(39,'Number of recent topics','number of topics displayed','md_num_recent_topics','','',1,'recent_topics'),(40,'Approve MOD installed?','tick if Approve MOD is installed','md_approve_mod_installed','','',4,'recent_topics'),(41,'Recent Topics Style','choose static display or scrolling display','md_recent_topics_style','Scroll,Static','1,0',3,'recent_topics'),(42,'Category to retrieve pics from','Enter 0 for all categories or comma delimited entries','md_cat_id2','','',1,'album2'),(43,'Number of Images to Display','','md_pics_number2','','',1,'album2'),(44,'Random or Newest Pics?','','md_pics_sort2','Newest,Random','0,1',3,'album2'),(45,'Display from what galleries?','','md_pics_all2','Public,Public and Personal','0,1',3,'album2'),(46,'Search option text','Text displayed as the default option','md_search_option_text','','',1,'search');
/*!40000 ALTER TABLE `phpbb_block_variable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_blocks`
--

DROP TABLE IF EXISTS `phpbb_blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_blocks` (
  `bid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `bposition` char(1) NOT NULL DEFAULT '',
  `weight` int(10) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `blockfile` varchar(255) NOT NULL DEFAULT '',
  `view` tinyint(1) NOT NULL DEFAULT '0',
  `layout` int(10) NOT NULL DEFAULT '1',
  `cache` tinyint(1) NOT NULL DEFAULT '0',
  `cache_time` int(10) NOT NULL DEFAULT '0',
  `block_bbcode_uid` varchar(10) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `border` tinyint(1) NOT NULL DEFAULT '1',
  `titlebar` tinyint(1) NOT NULL DEFAULT '1',
  `openclose` tinyint(1) NOT NULL DEFAULT '1',
  `background` tinyint(1) NOT NULL DEFAULT '1',
  `local` tinyint(1) NOT NULL DEFAULT '0',
  `groups` tinytext NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_blocks`
--

LOCK TABLES `phpbb_blocks` WRITE;
/*!40000 ALTER TABLE `phpbb_blocks` DISABLE KEYS */;
INSERT INTO `phpbb_blocks` VALUES (1,'Welcome to IntegraMOD','<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"><tr><td align=\"center\"><img src=\"images/phpbbintegramod.jpg\" align=\"center\"></td></tr></table>','c',1,1,'',0,1,1,1000000000,'',0,1,1,1,1,1,''),(2,'News','','c',5,0,'blocks_imp_news',0,1,1,10000,'',1,1,1,1,1,1,''),(3,'Board Navigation','','@',2,1,'blocks_imp_menu',0,0,0,25000,'',1,1,1,1,1,1,''),(4,'Statistics','','r',4,0,'blocks_imp_statistics',0,1,1,310,'',1,1,1,1,1,1,''),(5,'Recent Topics','','@',8,0,'blocks_imp_recent_topics',0,0,0,0,'',1,1,1,1,1,1,''),(6,'Search','','@',4,0,'blocks_imp_search',0,0,1,1000000000,'',1,1,1,1,1,1,''),(7,'Links','','r',6,0,'blocks_imp_links',0,1,1,1900,'',1,1,1,1,1,1,''),(8,'Active Users','','r',7,0,'blocks_imp_users_visited',0,1,1,280,'',1,1,1,1,1,1,''),(9,'User Info','','@',6,0,'blocks_imp_user_block',0,0,0,0,'',1,1,1,1,1,1,''),(10,'Who is Online','','@',7,1,'blocks_imp_online_users',0,0,0,0,'',1,1,1,1,1,1,''),(11,'Mini Calendar','','r',3,1,'blocks_imp_calendar',0,1,0,0,'',1,1,1,1,1,1,''),(12,'Site Survey','','r',1,0,'blocks_imp_poll',0,1,0,0,'',1,1,1,1,1,1,''),(13,'Album','','r',5,0,'blocks_imp_album',0,1,1,270,'',1,1,1,1,1,1,''),(14,'Visit Counter','','r',8,0,'blocks_imp_visit_counter',0,1,1,290,'',1,1,1,1,1,1,''),(15,'Style Select','','@',1,1,'blocks_imp_style_select',0,0,0,0,'',0,1,1,1,1,1,''),(16,'Second Menu','','@',3,1,'blocks_imp_sec_menu',0,0,0,25100,'',0,1,1,1,1,1,''),(17,'security','','@',5,1,'blocks_imp_security',0,0,1,1800,'',0,1,1,1,1,1,''),(18,'Referers','','c',4,1,'blocks_imp_referers',0,1,1,12250,'',0,1,1,1,1,1,''),(19,'Install and Configure Integramod 1.4.1','<h1>Fresh Install for Integramod 1.4.1 </h1>\r\n\r\n<h2>Abbreviations used in this documentation:</h2>\r\n\r\nxxxxxx = wild card pattern .. those who are used to it its like \"*\" in most OS\'s<br><br>\r\nchmod = name of command to change file permissions<br><br>\r\nwww.yoursite.com = to be replaced with the name of your web site<br><br>\r\nACP = Admin Control Panel<br><br>\r\n<br>\r\n<h2>Requirements:</h2>\r\n\r\n<ol type=\"1\">\r\n    <lh><h3>In order to install IntegraMOD on your host server, you will require</h3></lh>\r\n    <li>A database source, which is MySQL3 or MySQL4 compliant. If you also have editing features like PHPMyAdmin - this may be helpful but not essential.</li><br><br>\r\n    <li>A host server with PHP Scripting 4.x. Please note IntegraMOD runs on PHP4 and PHP5 enabled hosts</li><br><br>\r\n    <li>A server space of at least 50Mb You may wish to consider more if you plan of providing</li><br>\r\n         - Multiple styles<br>\r\n         - File storage<br>\r\n         - Pictures<br>\r\n         - Attachments<br>\r\n</ul>\r\n</ol>\r\n<h2>Install:</h2>\r\n\r\n<ol type=\"1\">\r\n<li> Upload all the files from the directory trunk (retaining the directory structure)<br>\r\n   to \"public_html\" or a sub directory (e.g. /forum/) on your web server</li>\r\n<br><br>\r\n<li>If your running on a *nix based OS or IIS widdows service<br>\r\n   Change the permissions of the following directories and files:<br>\r\n<Table border=\"1\">\r\n    <tr><td align=\"center\" >chmod</td></tr>\r\n    <tr><td align=\"center\" >Setting</td><td>Directory or file name</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>album_mod/upload</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>album_mod/upload/cache</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>album_mod/upload/med_cache</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>album_mod/upload/wm_cache</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>backup</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>cache</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>cache/attach_config.php</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>cgi-bin/tmp</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>cgi-bin/nuffload.cgi</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>ctracker/logfiles/logfile_attempt_counter.txt</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>ctracker/logfiles/logfile_blocklist.txt</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>ctracker/logfiles/logfile_debug_mode.txt</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>ctracker/logfiles/logfile_malformed_logins.txt</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>ctracker/logfiles/logfile_spammer.txt</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>ctracker/logfiles/logfile_worms.txt</td></tr> \r\n    <tr><td align=\"center\" >777</td><td>files</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>files/thumbs</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>images/avatars</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>images/smiles</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>images/photos</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>includes/cache_tpls</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>includes/def_auth.php</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>includes/def_icons.php</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>includes/def_qbar.php</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>includes/def_themes.php</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>includes/def_tree.php</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>includes/def_words.php</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>includes/phpbb_security.php</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>language/lang_xxxxxx/lang_contact_faq.php</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>language/lang_xxxxxx/lang_extend_xxxxxx .php</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>language/lang_xxxxxx/lang_faq.php</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>language/lang_xxxxxx/lang_faq_attach.php</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>language/lang_xxxxxx/lang_prillian_faq.php</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>modules</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>modules/cache</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>modules/cache/explain</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>pafiledb/cache</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>pafiledb/cache/data_global.php</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>pafiledb/cache/templates</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>pafiledb/cache/templates/xxxxxx</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>pafiledb/cache/templates/xxxxxx/admin</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>pafiledb/images/ss</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>pafiledb/uploads</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>profilcp/functions_profile.php</td></tr> \r\n    <tr><td align=\"center\" >777</td><td>profilcp/def</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>profilcp/def/def_userxxxxxx.php</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>templates/xxxxxx/sub_templates.cfg</td></tr>\r\n    <tr><td align=\"center\" >777</td><td>var_cache</td></tr>\r\n    <tr><td align=\"center\" >666</td><td>config.php</td></tr>\r\n</table><br><br>\r\n<li>Create an empty Msql DataBase</li>\r\n<br><br>\r\n<li> Create a mySql DataBase User and assign their password</li>\r\n<br><br>\r\n<li> Add user to the DataBase with ALL privilages</li>\r\n<br><br>\r\n<li> Using your web browser<br>\r\n   visit the location where you uploaded the files with the addition of \"install/install.php\"<br>\r\n   (without the quotes)<br>\r\n   e.g: http://www.yoursite.com/forum/install/install.php</li>\r\n<br><br>\r\n<li> Fill out the necessary information in the installation page and submit the page<br>\r\n   (be sure that the information you specified are correct.<br>\r\n   Wrong information can result to your forum not accessible or nothing is displayed when it is accessed).</li>\r\n<br><br>\r\n<li> Click Finish Installation. (You will be redirected to the logon screen .. but don\'t login yet</li>\r\n<br><br>\r\n<li> Follow the steps in installing the new prillian messenger. </li>\r\n<br><br>\r\n<li> Delete the directory \"install\".<br>\r\n   Do not just rename this directory. It is mandatory that this directory be deleted.</li>\r\n<br><br>\r\n<li> Delete the directory \"prill_install\".<br>\r\n    Do not just rename this directory. It is mandatory that this directory be deleted.</li>\r\n<br><br>\r\n<li> Change the permissions on config.php AND includes/phpbb_security.php to be writeable only by yourself (644).</li>\r\n<br><br>\r\n<li>  Using your web browser,<br>\r\n      Go to www.yoursite.com<br>\r\n      Login using the details you fill in in the installation screen</li>\r\n<br><br>\r\n<li> Fill in remaining registration details for your account</li>\r\n<br><br>\r\n<li> Click on Admin in the menu bar (or \"Go to Administration Panel\" at the bottom of the page)</li>\r\n<br><br>\r\n<li> it will ask you for your log in details again. you need to fill this in every session that you go to the ACP</li>\r\n<br><br>\r\n</ul>\r\n</ol>\r\nYou are now ready to Configure your system<br>\r\n<br>\r\n<h2>Basic Configuration:</h2>\r\nEnter the Admin control panel<br>\r\nYou will be asked for your log in details again.<br>\r\nYou need to fill this in every session that you go to the ACP as a security measure<br>\r\n\r\n<b>.: Security :.</b> :: <b>Special</b> -- This is the section which you have to edit whenever you add in new Admins and moderators so that the system doesn\'t think that its been hacked. Change these settings to suit how you want to secure your site.<br>\r\n<br>\r\n<b>Attachments</b> :: <b>Management</b> -- Change these settings to how you\'d like to allow attachments to msgs in your forum<br>\r\n<br>\r\n<b>Download</b> :: <b>Configuration</b> -- Setup your download limits and banned extentions in here<br>\r\n<br>\r\n<b>Extentions</b> :: <b>Extention Control</b> -- Check the extentions default set and add, remove as you want, need.<br>\r\n<br>\r\n<b>Extentions</b> :: <b>Special catagories</b> -- Set your settings for images in as attachments<br>\r\n<br>\r\n<b>eXtreme Styles</b> :: <b>Configuration</b> -- <b>Show on left frame</b> -- You can select what items to show on left frame in admin control panel.<br>\r\n                                                                                            (I generally select all the panel;s to show in left panel)<br>\r\n                                                                                            Set Default template directory to Default<br>\r\n                                                                                            Make sure that \"set Add tpl filenames in html\" is set to No.<br>\r\n                                                      -- <b>FTP configuration</b> -- Click on set host\'s links and set path links<br>\r\n                                                                                            This will enable you to help keep track of what versions your running<br>\r\n                                                                                            Click on submit<br>\r\n<br>\r\n                   :: <b>Styles Management</b> -- <b>Set default style</b> -- Switch all users to use an IntegraMOD 1.4.x compatible style.<br>\r\n                                                                                            NOTE: It is recommended to uninstall all those styles that are NOT IntegraMOD 1.4.x compatible.<br>\r\n                                                          -- <b>Manage Cache</b> -- Click clear cache for all templates<br>\r\n                                                                                        -- Click compile cache for all templates<br>\r\n<br>\r\n<b>Forum Admin</b> :: <b>Spellcheck</b> --  Build your dictionaries (Remember part1 then part2) of each language you wish to support<br>\r\n                                                  NOTE: The Dictionaries take up a lot of DB Space. (approx 4-5mb each language)<br>\r\n                                                  Delete the /spelling/xxxxxx.dic Files once you\'ve built your Dictionarys<br>\r\n<br>\r\n<b>General Admin</b> :: <b>Configuration</b> -- Set your Site Name, Description, and default language. Signature content settings, and Avatar settings</br>\r\n<br>\r\n                            :: <b>Optomize DB</b> -- Enable Cron: and set to how often you\'d like your DB to be optomized<br>\r\n<br>\r\n                          :: <b>Rating System</b> -- Set rating system active to Yes.<br>\r\n                                                          If you do not want to have the rating system active in your forum, just leave it to no.<br>\r\n                                                          If you do NOT enable it, remove the link from the board navigation block through <b>General Admin</b> :: <b>Qbar</b><br>\r\n<br>\r\n<b>IM Portal</b> :: <b>Blocks Management</b> -- The cache for the following blocks must be set to No(disabled)<br>\r\n                                                           <b>Board Navigation</b><br>\r\n                                                           <b>IntegraNews</b><br>\r\n                                                           <b>Recent Topics</b><br>\r\n                                                           <b>Who is Online</b><br>\r\n<br>\r\n                    :: <b>Delete Cache Files</b> -- This will delete the cache files for the blocks<br>\r\n<br>\r\n                    :: <b>Portal Configuration</b> -- This is where you set the variables for IMPortal and Blocks eg:Scrolling links in links block<br>\r\n<br>\r\n<b>Links</b> :: <b>Configuration</b> -- Don\'t forget to update the values for your own forum<br>\r\n<br>\r\n<b>News Admin</b> :: <b>Configuration</b> -- <b>News Mod Base URL</b> to the exact URL of your portal.php<br>\r\n                                                   (e.g. http://www.mysite.com/forum/portal.php)<br>\r\n<br>\r\n                                                -- <b>News Mod Index File</b> to portal.php<br>\r\n<br>\r\n<b>Photo Album</b> :: <b>Configuration</b> -- Set image Size maximums to what you want<br>\r\n<br>\r\n<b>Prillian</b> :: <b>Configuration</b> -- Finalize the settings for your Prillian installation.<br>\r\n                                                e.g: to Disable Prillian:-<br>\r\n                                                <b>Enable Instant Messaging System</b> No<br>\r\n                                                <b>Enable Network Messaging system</b> No<br>\r\n                                                <b>Over ride user settings </b> Yes<br>\r\n<br>\r\n<b>Pseudocron</b> :: <b>Cron Configuration</b> -- <b>Enable Pseudocron</b> Yes (To enable the sending of digests)<br>\r\n<br>\r\nOnce you\'ve done these then feel free to familurize yourself with the rest of the Admin controls you have at your command..\r\n<br>\r\nEnjoy using <b>integramod</b> ;)\r\n<br>','c',2,1,'',0,2,1,1000,'',0,1,1,1,1,1,''),(20,'Downloads','','c',6,0,'blocks_imp_center_downloads',0,1,1,250,'',0,1,1,1,1,1,''),(21,'Donations','','@',9,1,'blocks_imp_donate',0,0,1,25200,'',1,1,1,1,1,1,''),(22,'clock','','r',2,1,'blocks_imp_clock',0,1,0,1000000000,'',0,1,1,1,1,1,''),(23,'Album','','c',7,0,'blocks_imp_album2',0,1,1,275,'',0,1,1,1,1,1,''),(24,'Chat','','r',9,0,'blocks_imp_chat',2,1,0,0,'',0,1,1,1,1,1,''),(26,'Announcements','','c',8,1,'blocks_imp_announcements',0,1,0,0,'',0,1,1,1,1,1,''),(28,'Newest Pic','','r',10,0,'blocks_imp_newest_pic',0,1,1,300,'',0,1,1,1,1,1,''),(29,'Online Users','','r',11,0,'blocks_imp_online_users2',0,1,0,0,'',0,1,1,1,1,1,''),(30,'Random Attach','','c',9,0,'blocks_imp_random_attach',0,1,1,260,'',0,1,1,1,1,1,''),(31,'Shoutbox','','c',3,1,'blocks_imp_shoutbox',0,1,0,0,'',0,1,1,1,1,1,''),(32,'Topics Since','','c',2,1,'blocks_imp_topics_since',0,1,0,0,'',0,1,1,1,1,1,''),(33,'Welcome','<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"><tr><td align=\"center\"><img src=\"images/phpbbintegramod.jpg\" align=\"center\"></td></tr></table>','c',1,1,'',0,2,1,10000,'',0,1,1,1,1,1,''),(34,'Welcome to IntegraMOD','<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"><tr><td align=\"center\"><img src=\"images/phpbbintegramod.jpg\" align=\"center\"></td></tr></table>','c',1,1,'',0,3,1,10000,'',0,1,1,1,1,1,''),(35,'Topics Since','','c',2,1,'blocks_imp_topics_since',2,3,0,0,'',0,1,1,1,1,1,''),(36,'Shoutbox','','c',3,1,'blocks_imp_shoutbox',2,3,0,0,'',0,1,1,1,1,1,''),(37,'Referers','','c',4,1,'blocks_imp_referers',0,3,1,10000,'',0,1,1,1,1,1,''),(38,'News','','c',6,1,'blocks_imp_news',0,3,1,10000,'',0,1,1,1,1,1,''),(39,'Announcements','','c',5,1,'blocks_imp_announcements',0,3,1,10000,'',0,1,1,1,1,1,''),(40,'Random Attach','','c',7,0,'blocks_imp_random_attach',2,3,0,0,'',0,1,1,1,1,1,''),(41,'Calendar','','r',1,1,'blocks_imp_calendar',0,3,1,10000,'',0,1,1,1,1,1,''),(42,'Site Survey','','r',2,1,'blocks_imp_poll',0,3,0,0,'',0,1,1,1,1,1,''),(43,'clock','','r',3,1,'blocks_imp_clock',0,3,1,10000,'',0,1,1,1,1,1,''),(44,'Statistics','','r',4,1,'blocks_imp_statistics',0,3,0,0,'',0,1,1,1,1,1,''),(45,'Links','','r',5,1,'blocks_imp_links',0,3,1,10000,'',0,1,1,1,1,1,''),(46,'Active Users','','r',6,1,'blocks_imp_users_visited',0,3,1,280,'',0,1,1,1,1,1,''),(47,'Visit Counter','','r',7,1,'blocks_imp_visit_counter',0,3,1,280,'',0,1,1,1,1,1,''),(48,'Board Navigation','','l',2,1,'blocks_imp_menu',0,3,1,10000,'',0,1,1,1,1,1,''),(49,'Style Select','','l',1,1,'blocks_imp_style_select',0,3,1,0,'',0,1,1,1,1,1,''),(50,'Second Menu','','l',3,1,'blocks_imp_sec_menu',0,3,1,10000,'',0,1,1,1,1,1,''),(51,'Search','','l',4,1,'blocks_imp_search',0,3,0,0,'',0,1,1,1,1,1,''),(52,'security','','l',5,1,'blocks_imp_security',0,3,0,0,'',0,1,1,1,1,1,''),(53,'User Info','','l',6,1,'blocks_imp_user_block',0,3,0,0,'',0,1,1,1,1,1,''),(54,'Who is Online','','l',7,1,'blocks_imp_online_users',0,3,0,0,'',0,1,1,1,1,1,''),(55,'Recent Topics','','l',8,1,'blocks_imp_recent_topics',2,3,0,0,'',0,1,1,1,1,1,''),(56,'Donations','','l',9,1,'blocks_imp_donate',0,3,0,0,'',0,1,1,1,1,1,''),(57,'Welcome to IntegraMOD','<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"><tr><td align=\"center\"><img src=\"images/phpbbintegramod.jpg\" align=\"center\"></td></tr></table>','t',1,1,'',0,4,1,10000,'',0,1,1,1,1,1,''),(58,'Style Select','','d',1,1,'blocks_imp_style_select',0,4,0,0,'',0,1,1,1,1,1,''),(59,'Board Navigation','','c',1,1,'blocks_imp_menu',0,4,1,10000,'',0,1,1,1,1,1,''),(60,'Second Menu','','c',2,1,'blocks_imp_sec_menu',0,4,1,10000,'',0,1,1,1,1,1,''),(61,'clock','','d',2,1,'blocks_imp_clock',0,4,0,0,'',0,1,1,1,1,1,''),(62,'Calendar','','d',3,1,'blocks_imp_calendar',0,4,0,0,'',0,1,1,1,1,1,''),(63,'Statistics','','d',4,1,'blocks_imp_statistics',0,4,1,10000,'',0,1,1,1,1,1,''),(64,'Referers','','b',1,1,'blocks_imp_referers',0,4,0,280,'',0,1,1,1,1,1,''),(65,'Shoutbox','','b',2,1,'blocks_imp_shoutbox',0,4,0,0,'',0,1,1,1,1,1,''),(66,'Shoutbox','','b',1,1,'blocks_imp_shoutbox',0,5,0,0,'',0,1,1,1,1,1,''),(67,'Ads','[b:41cb1c71a9][size=18:41cb1c71a9]This is an html/bbcode block that could contain site advertisements[/size:41cb1c71a9][/b:41cb1c71a9]','b',2,1,'',0,5,1,10000,'41cb1c71a9',1,1,1,1,1,1,''),(68,'Board Navigation','','1',1,1,'blocks_imp_menu',0,6,0,0,'',0,1,1,1,1,1,''),(69,'Second Menu','','1',2,1,'blocks_imp_sec_menu',0,6,0,0,'',0,1,1,1,1,1,''),(70,'Calendar','','6',1,1,'blocks_imp_calendar',0,6,0,0,'',0,1,1,1,1,1,''),(71,'Statistics','','5',1,1,'blocks_imp_statistics',0,6,0,0,'',0,1,1,1,1,1,''),(72,'Who is Online','','6',3,1,'blocks_imp_online_users',0,6,0,0,'',0,1,1,1,1,1,''),(73,'clock','','6',2,1,'blocks_imp_clock',0,6,0,0,'',0,1,1,1,1,1,''),(74,'Recent Articles','','2',1,1,'blocks_imp_recent_articles',0,6,0,0,'',0,1,1,1,1,1,''),(75,'Recent Topics','','2',2,1,'blocks_imp_recent_topics',0,6,0,0,'',0,1,1,1,1,1,''),(76,'User Info','','3',1,1,'blocks_imp_user_block',0,6,0,0,'',0,1,1,1,1,1,''),(77,'Links','','4',1,1,'blocks_imp_links',0,6,0,0,'',0,1,1,1,1,1,''),(78,'Welcome to IntegraMOD','<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"><tr><td align=\"center\"><img src=\"images/phpbbintegramod.jpg\" align=\"center\"></td></tr></table>','t',1,1,'',0,5,0,10000,'',0,1,1,1,1,1,''),(79,'Security','','l',1,1,'blocks_imp_security',0,5,0,0,'',0,1,1,1,1,1,''),(80,'Style Select','','l',2,1,'blocks_imp_style_select',0,5,0,0,'',0,1,1,1,1,1,''),(81,'Board Navigation','','l',3,1,'blocks_imp_menu',0,5,0,0,'',0,1,1,1,1,1,''),(82,'Second Menu','','l',4,1,'blocks_imp_sec_menu',0,5,0,0,'',0,1,1,1,1,1,''),(83,'Announcements','','c',1,1,'blocks_imp_announcements',0,5,0,0,'',0,1,1,1,1,1,''),(84,'News','','c',2,0,'blocks_imp_news',0,5,0,0,'',0,1,1,1,1,1,''),(85,'Referers','','c',4,1,'blocks_imp_referers',0,5,0,0,'',0,1,1,1,1,1,''),(86,'Recent Topics','','c',3,1,'blocks_imp_recent_topics',0,5,0,0,'',0,1,1,1,1,1,''),(87,'Calendar','','r',1,1,'blocks_imp_calendar',0,5,0,0,'',0,1,1,1,1,1,''),(88,'Site Survey','','r',2,1,'blocks_imp_poll',0,5,0,0,'',0,1,1,1,1,1,''),(89,'User Info','','r',4,1,'blocks_imp_user_block',0,5,0,0,'',0,1,1,1,1,1,''),(90,'Chatbox','','r',3,1,'blocks_imp_chat',2,5,0,0,'',0,1,1,1,1,1,'');
/*!40000 ALTER TABLE `phpbb_blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_bookmarks`
--

DROP TABLE IF EXISTS `phpbb_bookmarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_bookmarks` (
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_bookmarks`
--

LOCK TABLES `phpbb_bookmarks` WRITE;
/*!40000 ALTER TABLE `phpbb_bookmarks` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_bookmarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_bots`
--

DROP TABLE IF EXISTS `phpbb_bots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_bots` (
  `bot_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `bot_name` varchar(255) NOT NULL DEFAULT '',
  `bot_agent` text NOT NULL,
  `last_visit` varchar(255) NOT NULL DEFAULT '',
  `bot_visits` varchar(255) NOT NULL DEFAULT '0',
  `bot_pages` varchar(255) NOT NULL DEFAULT '0',
  `pending_agent` text NOT NULL,
  `pending_ip` text NOT NULL,
  `bot_ip` text NOT NULL,
  PRIMARY KEY (`bot_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_bots`
--

LOCK TABLES `phpbb_bots` WRITE;
/*!40000 ALTER TABLE `phpbb_bots` DISABLE KEYS */;
INSERT INTO `phpbb_bots` VALUES (1,'Googlebot','Googlebot','','0','0','','66.249.68.66','216.239.46.|64.68.8|64.68.9|164.71.1.|192.51.44.'),(2,'Alexa','ia_archiver','','0','0','','','66.28.250.|209.237.238.'),(3,'Inktomi','Slurp/','','0','0','','','216.35.116.|66.196.|66.94.230.|202.212.5.'),(4,'Infoseek','Infoseek','','0','0','','','204.162.9|205.226.203|206.3.30.|210.236.233.'),(5,'Alta Vista','Scooter','','0','0','','','194.221.84.|204.123.28.|208.221.35|212.187.226.|66.17.148.'),(6,'Lycos','Lycos','','0','0','','','208.146.27.|209.202.19|209.67.22|202.232.118.'),(7,'FAST','alltheweb','','0','0','','','146.101.142.2|216.35.112.|64.41.254.2|213.188.8.'),(8,'WiseNut','WISEnut','','0','0','','','64.241.243.|209.249.67.1|216.34.42.|66.35.208.'),(9,'MSN','msnbot/','','0','0','','','131.107.3.|204.95.98.|131.107.1|65.54.164.95'),(10,'Looksmart','MARTINI','','0','0','','','64.241.242.|207.138.42.212'),(11,'Ask Jeeves','teoma','','0','0','','','216.200.130.|216.34.121.|63.236.92.1|64.55.148.|65.192.195.|65.214.36.');
/*!40000 ALTER TABLE `phpbb_bots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_buddy`
--

DROP TABLE IF EXISTS `phpbb_buddy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_buddy` (
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `buddy_id` mediumint(8) NOT NULL DEFAULT '0',
  `buddy_ignore` tinyint(1) NOT NULL DEFAULT '0',
  `buddy_visible` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`buddy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_buddy`
--

LOCK TABLES `phpbb_buddy` WRITE;
/*!40000 ALTER TABLE `phpbb_buddy` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_buddy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_captcha_config`
--

DROP TABLE IF EXISTS `phpbb_captcha_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_captcha_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_captcha_config`
--

LOCK TABLES `phpbb_captcha_config` WRITE;
/*!40000 ALTER TABLE `phpbb_captcha_config` DISABLE KEYS */;
INSERT INTO `phpbb_captcha_config` VALUES ('width','450'),('height','100'),('exsample_code','SAMPLE'),('background_color','#E5ECF9'),('jpeg','1'),('jpeg_quality','90'),('pre_letters','0'),('pre_letters_great','1'),('font','1'),('trans_letters','0'),('chess','0'),('ellipses','1'),('arcs','1'),('lines','1'),('image','1'),('bg_transition','35'),('gammacorrect','0.8'),('foreground_lattice_x','20'),('foreground_lattice_y','20'),('lattice_color','#FFFFFF'),('avc_version','1.2.0');
/*!40000 ALTER TABLE `phpbb_captcha_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_cash`
--

DROP TABLE IF EXISTS `phpbb_cash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_cash` (
  `cash_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cash_order` smallint(6) NOT NULL DEFAULT '0',
  `cash_settings` smallint(4) NOT NULL DEFAULT '3313',
  `cash_dbfield` varchar(64) NOT NULL DEFAULT '',
  `cash_name` varchar(64) NOT NULL DEFAULT 'GP',
  `cash_default` int(11) NOT NULL DEFAULT '0',
  `cash_decimals` tinyint(2) NOT NULL DEFAULT '0',
  `cash_imageurl` varchar(255) NOT NULL DEFAULT '',
  `cash_exchange` int(11) NOT NULL DEFAULT '1',
  `cash_perpost` int(11) NOT NULL DEFAULT '25',
  `cash_postbonus` int(11) NOT NULL DEFAULT '2',
  `cash_perreply` int(11) NOT NULL DEFAULT '25',
  `cash_maxearn` int(11) NOT NULL DEFAULT '75',
  `cash_perpm` int(11) NOT NULL DEFAULT '0',
  `cash_perchar` int(11) NOT NULL DEFAULT '20',
  `cash_allowance` tinyint(1) NOT NULL DEFAULT '0',
  `cash_allowanceamount` int(11) NOT NULL DEFAULT '0',
  `cash_allowancetime` tinyint(2) NOT NULL DEFAULT '2',
  `cash_allowancenext` int(11) NOT NULL DEFAULT '0',
  `cash_forumlist` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`cash_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_cash`
--

LOCK TABLES `phpbb_cash` WRITE;
/*!40000 ALTER TABLE `phpbb_cash` DISABLE KEYS */;
INSERT INTO `phpbb_cash` VALUES (1,1,3313,'user_points','Points',0,0,'',1,25,2,25,75,0,20,0,0,2,0,'');
/*!40000 ALTER TABLE `phpbb_cash` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_cash_events`
--

DROP TABLE IF EXISTS `phpbb_cash_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_cash_events` (
  `event_name` varchar(32) NOT NULL DEFAULT '',
  `event_data` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`event_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_cash_events`
--

LOCK TABLES `phpbb_cash_events` WRITE;
/*!40000 ALTER TABLE `phpbb_cash_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_cash_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_cash_exchange`
--

DROP TABLE IF EXISTS `phpbb_cash_exchange`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_cash_exchange` (
  `ex_cash_id1` int(11) NOT NULL DEFAULT '0',
  `ex_cash_id2` int(11) NOT NULL DEFAULT '0',
  `ex_cash_enabled` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ex_cash_id1`,`ex_cash_id2`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_cash_exchange`
--

LOCK TABLES `phpbb_cash_exchange` WRITE;
/*!40000 ALTER TABLE `phpbb_cash_exchange` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_cash_exchange` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_cash_groups`
--

DROP TABLE IF EXISTS `phpbb_cash_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_cash_groups` (
  `group_id` mediumint(6) NOT NULL DEFAULT '0',
  `group_type` tinyint(2) NOT NULL DEFAULT '0',
  `cash_id` smallint(6) NOT NULL DEFAULT '0',
  `cash_perpost` int(11) NOT NULL DEFAULT '0',
  `cash_postbonus` int(11) NOT NULL DEFAULT '0',
  `cash_perreply` int(11) NOT NULL DEFAULT '0',
  `cash_perchar` int(11) NOT NULL DEFAULT '0',
  `cash_maxearn` int(11) NOT NULL DEFAULT '0',
  `cash_perpm` int(11) NOT NULL DEFAULT '0',
  `cash_allowance` tinyint(1) NOT NULL DEFAULT '0',
  `cash_allowanceamount` int(11) NOT NULL DEFAULT '0',
  `cash_allowancetime` tinyint(2) NOT NULL DEFAULT '2',
  `cash_allowancenext` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`,`group_type`,`cash_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_cash_groups`
--

LOCK TABLES `phpbb_cash_groups` WRITE;
/*!40000 ALTER TABLE `phpbb_cash_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_cash_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_cash_log`
--

DROP TABLE IF EXISTS `phpbb_cash_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_cash_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_time` int(11) NOT NULL DEFAULT '0',
  `log_type` smallint(6) NOT NULL DEFAULT '0',
  `log_action` varchar(255) NOT NULL DEFAULT '',
  `log_text` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_cash_log`
--

LOCK TABLES `phpbb_cash_log` WRITE;
/*!40000 ALTER TABLE `phpbb_cash_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_cash_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_categories`
--

DROP TABLE IF EXISTS `phpbb_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_categories` (
  `cat_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(100) DEFAULT NULL,
  `cat_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `cat_main_type` char(1) DEFAULT NULL,
  `cat_main` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `cat_desc` text NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cat_id`),
  KEY `cat_order` (`cat_order`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_categories`
--

LOCK TABLES `phpbb_categories` WRITE;
/*!40000 ALTER TABLE `phpbb_categories` DISABLE KEYS */;
INSERT INTO `phpbb_categories` VALUES (1,'Test category 1',10,NULL,0,'',NULL),(2,'Test category 1',40,'c',0,'','');
/*!40000 ALTER TABLE `phpbb_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_chatspot_messages`
--

DROP TABLE IF EXISTS `phpbb_chatspot_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_chatspot_messages` (
  `message_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL DEFAULT '0',
  `username` varchar(25) NOT NULL DEFAULT '',
  `msg` text NOT NULL,
  `msg_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  `to_user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `from_user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_chatspot_messages`
--

LOCK TABLES `phpbb_chatspot_messages` WRITE;
/*!40000 ALTER TABLE `phpbb_chatspot_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_chatspot_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_chatspot_rooms`
--

DROP TABLE IF EXISTS `phpbb_chatspot_rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_chatspot_rooms` (
  `room_id` mediumint(11) NOT NULL AUTO_INCREMENT,
  `room_name` varchar(20) NOT NULL DEFAULT '',
  `room_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `room_access` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `room_password` varchar(20) DEFAULT NULL,
  `room_creator_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`room_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_chatspot_rooms`
--

LOCK TABLES `phpbb_chatspot_rooms` WRITE;
/*!40000 ALTER TABLE `phpbb_chatspot_rooms` DISABLE KEYS */;
INSERT INTO `phpbb_chatspot_rooms` VALUES (1,'Lobby',1,0,NULL,0);
/*!40000 ALTER TABLE `phpbb_chatspot_rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_chatspot_sessions`
--

DROP TABLE IF EXISTS `phpbb_chatspot_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_chatspot_sessions` (
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(25) NOT NULL DEFAULT '',
  `room_id` mediumint(11) NOT NULL DEFAULT '0',
  `last_active` int(11) NOT NULL DEFAULT '0',
  `last_status` tinyint(1) unsigned NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_chatspot_sessions`
--

LOCK TABLES `phpbb_chatspot_sessions` WRITE;
/*!40000 ALTER TABLE `phpbb_chatspot_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_chatspot_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_config`
--

DROP TABLE IF EXISTS `phpbb_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_config`
--

LOCK TABLES `phpbb_config` WRITE;
/*!40000 ALTER TABLE `phpbb_config` DISABLE KEYS */;
INSERT INTO `phpbb_config` VALUES ('config_id','1'),('board_disable','0'),('sitename','yourdomain.com'),('site_desc','A _little_ text to describe your forum'),('cookie_name','im_b_248'),('cookie_path','/'),('cookie_domain',''),('cookie_secure','0'),('session_length','3600'),('allow_html','0'),('allow_html_tags','b,i,u,pre'),('allow_bbcode','1'),('allow_smilies','1'),('allow_sig','1'),('allow_namechange','0'),('allow_theme_create','0'),('allow_avatar_local','0'),('allow_avatar_remote','0'),('allow_avatar_upload','0'),('allow_photo_local','0'),('allow_photo_remote','0'),('allow_photo_upload','0'),('enable_confirm','1'),('allow_autologin','1'),('max_autologin_time','0'),('override_user_style','0'),('posts_per_page','15'),('topics_per_page','50'),('hot_threshold','25'),('max_poll_options','10'),('max_sig_chars','255'),('max_inbox_privmsgs','50'),('max_sentbox_privmsgs','25'),('max_savebox_privmsgs','50'),('board_email_sig','Thanks, The Management'),('smtp_delivery','0'),('smtp_host',''),('smtp_username',''),('smtp_password',''),('sendmail_fix','0'),('require_activation','0'),('flood_interval','15'),('max_login_attempts','5'),('login_reset_time','30'),('board_email_form','0'),('avatar_filesize','6144'),('avatar_max_width','80'),('avatar_max_height','80'),('avatar_path','images/avatars'),('avatar_gallery_path','images/avatars/gallery'),('photo_filesize','102400'),('photo_max_width','800'),('photo_max_height','600'),('photo_path','images/photos'),('photo_gallery_path','images/photos/gallery'),('read_viewphoto',''),('smilies_path','images/smiles'),('default_style','1'),('default_dateformat','D M d, Y g:i a'),('board_timezone','0'),('prune_enable','1'),('privmsg_disable','0'),('gzip_compress','0'),('debug_mode','1'),('coppa_fax',''),('coppa_mail',''),('record_online_users','2'),('record_online_date','1334688256'),('version','.0.24'),('allow_news','1'),('news_item_trim','0'),('news_title_trim','0'),('news_item_num','10'),('news_path','images/news'),('allow_rss','1'),('news_rss_desc',''),('news_rss_language','en_us'),('news_rss_ttl','60'),('news_rss_cat',''),('news_rss_image',''),('news_rss_image_desc',''),('news_rss_item_count','15'),('news_rss_show_abstract','1'),('news_base_url',''),('news_index_file','portal.php'),('prune_shouts','0'),('integramod_version','1.5.0'),('visit_counter','149'),('nextcron','1335139200'),('pseudocron','1'),('crontest','23'),('board_disable_msg','Upgrading the site...'),('bluecard_limit','3'),('bluecard_limit_2','1'),('max_user_bancard','10'),('report_forum','0'),('max_link_bookmarks','0'),('user_topics_last_per_page_over','0'),('mini_cal_calendar_version','TOPIC'),('mini_cal_limit','10'),('mini_cal_days_ahead','30'),('mini_cal_date_search','POSTS'),('mini_cal_fdow','0'),('mini_cal_link_class','gensmall'),('mini_cal_today_class','topicTitle'),('mini_cal_auth','auth_view'),('meta_keywords',''),('meta_description',''),('meta_author',''),('meta_identifier_url',''),('meta_reply_to',''),('meta_revisit_after',''),('meta_category',''),('meta_copyright',''),('meta_generator',''),('meta_robots',''),('meta_distribution',''),('meta_date_creation_day',''),('meta_date_creation_month',''),('meta_date_creation_year',''),('meta_date_revision_day',''),('meta_date_revision_month',''),('meta_date_revision_year',''),('meta_redirect_url_time',''),('meta_redirect_url_adress',''),('meta_refresh',''),('meta_pragma',''),('meta_language',''),('auto_lang_en','english'),('auto_lang_en-gb','english'),('auto_lang_en-us','english'),('auto_lang_fr','francais'),('auto_lang_nl','nederlands'),('auto_lang_nl-be','nederlands'),('auto_lang_de','deutsch'),('auto_lang_he','hebrew'),('dbmtnc_rebuild_end','0'),('dbmtnc_rebuild_pos','-1'),('dbmtnc_rebuildcfg_maxmemory','500'),('dbmtnc_rebuildcfg_minposts','3'),('dbmtnc_rebuildcfg_php3only','0'),('dbmtnc_rebuildcfg_php3pps','1'),('dbmtnc_rebuildcfg_php4pps','8'),('dbmtnc_rebuildcfg_timelimit','240'),('dbmtnc_rebuildcfg_timeoverwrite','0'),('dbmtnc_disallow_postcounter','0'),('dbmtnc_disallow_rebuild','0'),('sig_max_lines','5'),('sig_wordwrap','100'),('sig_allow_font_sizes','1'),('sig_min_font_size','7'),('sig_max_font_size','12'),('sig_allow_bold','1'),('sig_allow_italic','1'),('sig_allow_underline','1'),('sig_allow_colors','1'),('sig_allow_quote','0'),('sig_allow_code','0'),('sig_allow_list','0'),('sig_allow_url','1'),('sig_allow_images','1'),('sig_max_images','0'),('sig_max_img_height','75'),('sig_max_img_width','500'),('sig_allow_on_max_img_size_fail','0'),('sig_max_img_files_size','10'),('sig_max_img_av_files_size','0'),('sig_exotic_bbcodes_disallowed',''),('sig_allow_smilies','1'),('logo_image_path','images/logo'),('logo_image','phpbb2_logo.png'),('logo_image_w','500'),('logo_image_h','110'),('paypal_p_acct',''),('paypal_b_acct',''),('paypal_currency_code','USD'),('lw_trial_period','0'),('dislay_x_donors','10'),('donate_start_time',''),('donate_end_time',''),('donate_cur_goal','0'),('donate_description',''),('donate_to_points','0'),('donate_to_posts','0'),('list_top_donors','0'),('donate_to_grp_one','0'),('to_grp_one_amount','0'),('donate_to_grp_two','0'),('to_grp_two_amount','0'),('donate_currencies','USD;'),('usd_to_primary','0'),('eur_to_primary','0'),('gbp_to_primary','0'),('cad_to_primary','0'),('jpy_to_primary','0'),('search_flood_interval','0'),('rand_seed','890edb50269fdc71406bd179c6f381d2'),('apmr_deny_msg','Sorry %U%, The Admin You Are Trying To Private Message Currently Is Not Accepting Private Messages.'),('apmr_redirect_msg','The admin you have private messaged, has redirected your PM to another member for a faster response time.'),('donor_rank_id','0'),('lw_header_reminder','0'),('phpBBSecurity_login_limit','3'),('phpBBSecurity_notify_admin','1'),('phpBBSecurity_notify_admin_id','2'),('phpBBSecurity_auto_ban','1'),('phpBBSecurity_allowed_sessions','50'),('phpBBSecurity_DDoS_Ban','1'),('phpBBSecurity_Encoded_Ban','1'),('phpBBSecurity_Union_Ban','1'),('phpBBSecurity_Clike_Ban','1'),('phpBBSecurity_SQL_Ban','1'),('phpBBSecurity_File_Ban','1'),('phpBBSecurity_Perl_Ban','1'),('phpBBSecurity_total_attempts','0'),('phpBBSecurity_Cback_Ban','1'),('phpBBSecurity_Allow_Change','0'),('phpBBSecurity_notify_admin_pm','1'),('phpBBSecurity_notify_admin_em','1'),('phpBBSecurity_DDoS_level','1'),('phpBBSecurity_per_page','100'),('phpBBSecurity_allowed_admins',''),('phpBBSecurity_disallowed_agents',''),('phpBBSecurity_disallowed_referers',''),('phpBBSecurity_last_backup_date','21'),('phpBBSecurity_backup_time','18'),('phpBBSecurity_backup_on','1'),('phpBBSecurity_backup_folder','backups'),('phpBBSecurity_backup_filename','backups'),('phpBBSecurity_guest_matches','8'),('phpBBSecurity_use_password_match','1'),('phpBBSecurity_password_min_length','5'),('phpBBSecurity_version','1.0.3'),('search_min_chars','3'),('cash_disable','0'),('cash_display_after_posts','0'),('cash_post_message','You earned %s for that post'),('cash_disable_spam_num','10'),('cash_disable_spam_time','24'),('cash_disable_spam_message','You have exceeded the alloted amount of posts and will not earn anything for your post'),('cash_installed','yes'),('cash_version','2.2.3'),('cash_adminbig','0'),('cash_adminnavbar','1'),('points_name','Points'),('EM_version','0.4.0'),('EM_password',''),('EM_read','server'),('EM_write','server'),('EM_move','copy'),('EM_ftp_dir','/'),('EM_ftp_user',''),('EM_ftp_pass',''),('EM_ftp_host','localhost'),('EM_ftp_port','21'),('EM_ftp_type','fsock'),('EM_ftp_cache','0'),('board_startdate','1334688207'),('default_lang','english'),('board_email','jwi1965@hotmail.com'),('script_path','/IM150/'),('server_port','80'),('server_name','www.integramod.com'),('xkrefbpdtokyioatrkbag','1'),('ldghnvigyvbmdaraiqfno','0'),('zvitnfonoplcbouioqulk','1'),('sec_admin','xkrefbpdtokyioatrkbag'),('sec_mods','ldghnvigyvbmdaraiqfno'),('sec_name','zvitnfonoplcbouioqulk'),('icon_per_row','10'),('summer_time','0'),('summer_time_auto','1'),('board_fdow','0'),('user_attachsig','1'),('user_notify','0'),('user_notify_pm','1'),('user_popup_pm','1'),('user_viewimg','1'),('user_allowhtml','1'),('user_buddy_friend_display','1'),('user_buddy_ignore_display','1'),('user_buddy_friend_of_display','1'),('user_buddy_ignored_by_display','1'),('user_timezone','0'),('user_summer_time','0'),('user_fdow','0'),('user_privmsgs_per_page','5'),('user_allow_viewonline','1'),('user_viewemail','2'),('user_viewpm','1'),('user_viewwebsite','2'),('user_viewmessenger','2'),('user_viewreal','2'),('user_watched_topics_per_page','15'),('user_topics_last_per_page','15'),('user_setbm','1'),('user_allowbbcode','1'),('user_allowsmile','1'),('user_viewavatar','1'),('user_viewsig','1'),('user_active','1'),('user_allow_email','1'),('user_allow_pm','1'),('user_allow_website','1'),('user_allow_messenger','1'),('user_allow_real','1'),('user_allowavatar','1'),('user_allowphoto','1'),('user_allowsignature','1'),('user_extra','1'),('user_lang','english'),('user_dateformat','d M Y h:i a'),('username',''),('username_over','0'),('user_realname',''),('user_realname_over','0'),('user_birthday',''),('user_birthday_over','0'),('user_gender',''),('user_gender_over','0'),('user_country',''),('user_country_over','0'),('user_state',''),('user_state_over','0'),('user_email',''),('user_email_over','0'),('user_password',''),('user_password_over','0'),('phpBBSecurity_question',''),('phpBBSecurity_question_over','0'),('phpBBSecurity_answer',''),('phpBBSecurity_answer_over','0'),('user_notify_over','0'),('user_attachsig_over','0'),('user_notify_pm_over','0'),('user_popup_pm_over','0'),('user_style',''),('user_style_over','0'),('user_rules',''),('user_rules_over','0'),('user_from',''),('user_from_over','0'),('user_occ',''),('user_occ_over','0'),('user_holidays',''),('user_holidays_over','0'),('user_interests',''),('user_interests_over','0'),('user_home_phone',''),('user_home_phone_over','0'),('user_home_fax',''),('user_home_fax_over','0'),('user_work_phone',''),('user_work_phone_over','0'),('user_work_fax',''),('user_work_fax_over','0'),('user_cellular',''),('user_cellular_over','0'),('user_pager',''),('user_pager_over','0'),('user_msnm',''),('user_msnm_over','0'),('user_skype',''),('user_skype_over','0'),('user_icq',''),('user_icq_over','0'),('user_aim',''),('user_aim_over','0'),('user_yim',''),('user_yim_over','0'),('user_website',''),('user_website_over','0'),('user_lang_over','0'),('user_timezone_over','0'),('user_summer_time_over','0'),('user_dateformat_over','0'),('user_fdow_over','0'),('user_allow_viewonline_over','0'),('user_viewemail_over','0'),('user_viewpm_over','0'),('user_viewwebsite_over','0'),('user_viewmessenger_over','0'),('user_viewreal_over','0'),('user_setbm_over','0'),('user_allowbbcode_over','0'),('user_allowhtml_over','0'),('user_allowsmile_over','0'),('user_buddy_friend_display_over','0'),('user_buddy_ignore_display_over','0'),('user_buddy_friend_of_display_over','0'),('user_buddy_ignored_by_display_over','0'),('user_privmsgs_per_page_over','0'),('user_watched_topics_per_page_over','0'),('user_viewavatar_over','0'),('user_viewphoto',''),('user_viewphoto_over','0'),('user_viewsig_over','0'),('user_viewimg_over','0'),('icon_per_row_over','0'),('summer_time_over','0'),('summer_time_auto_over','0'),('board_fdow_over','0'),('mini_cal_calendar_version_over','0'),('mini_cal_limit_over','0'),('mini_cal_days_ahead_over','0'),('mini_cal_date_search_over','0'),('mini_cal_link_class_over','0'),('mini_cal_today_class_over','0'),('mini_cal_auth_over','0'),('user_active_over','0'),('user_allow_email_over','0'),('user_allow_pm_over','0'),('user_allow_website_over','0'),('user_allow_messenger_over','0'),('user_allow_real_over','0'),('user_allowavatar_over','0'),('user_allowphoto_over','0'),('user_allowsignature_over','0'),('user_extra_over','0'),('user_posts',''),('user_posts_over','0'),('user_warnings',''),('user_warnings_over','0'),('user_rank',''),('user_rank_over','0'),('calendar_display_open','0'),('calendar_display_open_over','0'),('calendar_header_cells','7'),('calendar_header_cells_over','0'),('calendar_title_length','30'),('calendar_text_length','200'),('calendar_nb_row','5'),('calendar_nb_row_over','0'),('calendar_birthday','1'),('calendar_birthday_over','0'),('calendar_forum','1'),('calendar_forum_over','0'),('announcement_date_display','1'),('announcement_date_display_over','0'),('announcement_display','1'),('announcement_display_over','0'),('announcement_display_forum','1'),('announcement_display_forum_over','0'),('announcement_split','1'),('announcement_split_over','0'),('announcement_forum','1'),('announcement_forum_over','0'),('announcement_duration','7'),('announcement_prune_strategy','0'),('last_topics_from_started','3'),('last_topics_from_started_over','0'),('last_topics_from_replied','3'),('last_topics_from_replied_over','0'),('last_topics_from_ended','3'),('last_topics_from_ended_over','0'),('last_topics_from_split','1'),('last_topics_from_split_over','0'),('last_topics_from_forum','1'),('last_topics_from_forum_over','0'),('split_global_announce','1'),('split_global_announce_over','0'),('split_announce','1'),('split_announce_over','0'),('split_sticky','1'),('split_sticky_over','0'),('split_topic_split','0'),('split_topic_split_over','0'),('sub_forum','1'),('sub_forum_over','0'),('split_cat','1'),('split_cat_over','0'),('last_topic_title','1'),('last_topic_title_over','0'),('last_topic_title_length','24'),('sub_level_links','2'),('sub_level_links_over','0'),('display_viewonline','2'),('display_viewonline_over','0'),('max_posts','1'),('max_topics','1'),('max_users','1'),('xs_auto_compile','1'),('xs_auto_recompile','1'),('xs_use_cache','1'),('xs_php','php'),('xs_def_template','subSilver'),('xs_check_switches','1'),('xs_warn_includes','1'),('xs_add_comments','0'),('xs_ftp_host',''),('xs_ftp_login',''),('xs_ftp_path',''),('xs_downloads_count','0'),('xs_downloads_default','0'),('xs_shownav','1'),('xs_template_time','1334688227'),('xs_version','8'),('announcement_last_prune','1335164399');
/*!40000 ALTER TABLE `phpbb_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_confirm`
--

DROP TABLE IF EXISTS `phpbb_confirm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_confirm` (
  `confirm_id` char(32) NOT NULL DEFAULT '',
  `session_id` char(32) NOT NULL DEFAULT '',
  `code` char(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`session_id`,`confirm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_confirm`
--

LOCK TABLES `phpbb_confirm` WRITE;
/*!40000 ALTER TABLE `phpbb_confirm` DISABLE KEYS */;
INSERT INTO `phpbb_confirm` VALUES ('c70575654ddc99032d8d0c374c93b0af','6c5ae9b08c2ea014eb9d7de4016f3940','4VHUTT'),('90c51bb6995b5c93a6a4c4148497807e','6c5ae9b08c2ea014eb9d7de4016f3940','BHUJWP'),('1137565904f8e3ee04e6c1c2b2fbd971','6c5ae9b08c2ea014eb9d7de4016f3940','DXYFYA'),('ed218c1aa5d484255d34b161e57d6145','6c5ae9b08c2ea014eb9d7de4016f3940','IHVH26');
/*!40000 ALTER TABLE `phpbb_confirm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_contact_list`
--

DROP TABLE IF EXISTS `phpbb_contact_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_contact_list` (
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `contact_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_ignore` tinyint(1) NOT NULL DEFAULT '0',
  `alert` tinyint(1) NOT NULL DEFAULT '0',
  `alert_status` tinyint(1) NOT NULL DEFAULT '0',
  `disallow` tinyint(1) NOT NULL DEFAULT '0',
  `display_name` varchar(25) NOT NULL DEFAULT '',
  KEY `contact_id` (`contact_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_contact_list`
--

LOCK TABLES `phpbb_contact_list` WRITE;
/*!40000 ALTER TABLE `phpbb_contact_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_contact_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_ctracker_config`
--

DROP TABLE IF EXISTS `phpbb_ctracker_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_ctracker_config` (
  `ct_config_name` varchar(255) NOT NULL,
  `ct_config_value` varchar(255) NOT NULL,
  PRIMARY KEY (`ct_config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_ctracker_config`
--

LOCK TABLES `phpbb_ctracker_config` WRITE;
/*!40000 ALTER TABLE `phpbb_ctracker_config` DISABLE KEYS */;
INSERT INTO `phpbb_ctracker_config` VALUES ('ipblock_enabled','1'),('ipblock_logsize','100'),('auto_recovery','1'),('vconfirm_guest','1'),('autoban_mails','1'),('detect_misconfiguration','1'),('search_time_guest','30'),('search_time_user','20'),('search_count_guest','1'),('search_count_user','4'),('massmail_protection','1'),('reg_protection','1'),('reg_blocktime','30'),('reg_lastip','0.0.0.0'),('pwreset_time','20'),('massmail_time','20'),('spammer_time','30'),('spammer_postcount','4'),('spammer_blockmode','1'),('loginfeature','1'),('pw_reset_feature','1'),('reg_last_reg','1155944976'),('login_history','1'),('login_history_count','10'),('login_ip_check','1'),('pw_validity','30'),('pw_complex_min','4'),('pw_complex_mode','1'),('pw_control','0'),('pw_complex','0'),('last_file_scan','1156000091'),('last_checksum_scan','1156000082'),('logsize_logins','100'),('logsize_spammer','100'),('reg_ip_scan','1'),('global_message','Hello world!'),('global_message_type','1'),('logincount','2'),('search_feature_enabled','1'),('spam_attack_boost','1'),('spam_keyword_det','1'),('footer_layout','6');
/*!40000 ALTER TABLE `phpbb_ctracker_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_ctracker_filechk`
--

DROP TABLE IF EXISTS `phpbb_ctracker_filechk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_ctracker_filechk` (
  `filepath` text,
  `hash` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_ctracker_filechk`
--

LOCK TABLES `phpbb_ctracker_filechk` WRITE;
/*!40000 ALTER TABLE `phpbb_ctracker_filechk` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_ctracker_filechk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_ctracker_filescanner`
--

DROP TABLE IF EXISTS `phpbb_ctracker_filescanner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_ctracker_filescanner` (
  `id` smallint(5) NOT NULL,
  `filepath` text,
  `safety` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_ctracker_filescanner`
--

LOCK TABLES `phpbb_ctracker_filescanner` WRITE;
/*!40000 ALTER TABLE `phpbb_ctracker_filescanner` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_ctracker_filescanner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_ctracker_ipblocker`
--

DROP TABLE IF EXISTS `phpbb_ctracker_ipblocker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_ctracker_ipblocker` (
  `id` mediumint(8) unsigned NOT NULL,
  `ct_blocker_value` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_ctracker_ipblocker`
--

LOCK TABLES `phpbb_ctracker_ipblocker` WRITE;
/*!40000 ALTER TABLE `phpbb_ctracker_ipblocker` DISABLE KEYS */;
INSERT INTO `phpbb_ctracker_ipblocker` VALUES (1,'*WebStripper*'),(2,'*NetMechanic*'),(3,'*CherryPicker*'),(4,'*EmailCollector*'),(5,'*EmailSiphon*'),(6,'*WebBandit*'),(7,'*EmailWolf*'),(8,'*ExtractorPro*'),(9,'*SiteSnagger*'),(10,'*CheeseBot*'),(11,'*ia_archiver*'),(12,'*Website Quester*'),(13,'*WebZip*'),(14,'*moget*'),(15,'*WebSauger*'),(16,'*WebCopier*'),(17,'*WWW-Collector*'),(18,'*InfoNaviRobot*'),(19,'*Harvest*'),(20,'*Bullseye*'),(21,'*LinkWalker*'),(22,'*LinkextractorPro*'),(23,'*WebProxy*'),(24,'*BlowFish*'),(25,'*WebEnhancer*'),(26,'*TightTwatBot*'),(27,'*LinkScan*'),(28,'*WebDownloader*'),(29,'lwp'),(30,'*BruteForce*'),(31,'lwp-*'),(32,'*anonym*');
/*!40000 ALTER TABLE `phpbb_ctracker_ipblocker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_ctracker_loginhistory`
--

DROP TABLE IF EXISTS `phpbb_ctracker_loginhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_ctracker_loginhistory` (
  `ct_user_id` int(10) DEFAULT NULL,
  `ct_login_ip` varchar(16) DEFAULT NULL,
  `ct_login_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_ctracker_loginhistory`
--

LOCK TABLES `phpbb_ctracker_loginhistory` WRITE;
/*!40000 ALTER TABLE `phpbb_ctracker_loginhistory` DISABLE KEYS */;
INSERT INTO `phpbb_ctracker_loginhistory` VALUES (2,'50.46.135.150',1334688227),(2,'50.46.135.150',1334688295),(2,'50.46.135.150',1334807349),(2,'50.46.135.150',1334807365),(2,'50.46.135.150',1335135616),(2,'50.46.135.150',1335135623);
/*!40000 ALTER TABLE `phpbb_ctracker_loginhistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_digest`
--

DROP TABLE IF EXISTS `phpbb_digest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_digest` (
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `digest_frequency` mediumint(8) NOT NULL DEFAULT '0',
  `last_digest` int(11) NOT NULL DEFAULT '0',
  `format` smallint(4) NOT NULL DEFAULT '0',
  `show_text` smallint(4) NOT NULL DEFAULT '0',
  `show_mine` smallint(4) NOT NULL DEFAULT '0',
  `new_only` smallint(4) NOT NULL DEFAULT '0',
  `send_on_no_messages` smallint(4) NOT NULL DEFAULT '1',
  `text_length` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_digest`
--

LOCK TABLES `phpbb_digest` WRITE;
/*!40000 ALTER TABLE `phpbb_digest` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_digest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_digest_forums`
--

DROP TABLE IF EXISTS `phpbb_digest_forums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_digest_forums` (
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `forum_id` smallint(5) NOT NULL DEFAULT '0',
  UNIQUE KEY `user_id` (`user_id`,`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_digest_forums`
--

LOCK TABLES `phpbb_digest_forums` WRITE;
/*!40000 ALTER TABLE `phpbb_digest_forums` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_digest_forums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_disallow`
--

DROP TABLE IF EXISTS `phpbb_disallow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_disallow` (
  `disallow_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `disallow_username` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`disallow_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_disallow`
--

LOCK TABLES `phpbb_disallow` WRITE;
/*!40000 ALTER TABLE `phpbb_disallow` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_disallow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_easymod`
--

DROP TABLE IF EXISTS `phpbb_easymod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_easymod` (
  `mod_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `mod_title` varchar(255) DEFAULT '',
  `mod_file` varchar(255) DEFAULT '',
  `mod_version` varchar(15) DEFAULT '',
  `mod_author_handle` varchar(25) DEFAULT '',
  `mod_author_email` varchar(100) DEFAULT '',
  `mod_author_name` varchar(100) DEFAULT '',
  `mod_author_url` varchar(100) DEFAULT '',
  `mod_description` text,
  `mod_process_date` int(11) DEFAULT '0',
  `mod_phpBB_version` varchar(15) DEFAULT '',
  `mod_processed_themes` varchar(200) DEFAULT '',
  `mod_processed_langs` varchar(200) DEFAULT '',
  `mod_files_edited` mediumint(8) DEFAULT '0',
  `mod_tables_added` mediumint(8) DEFAULT '0',
  `mod_tables_altered` mediumint(8) DEFAULT '0',
  `mod_rows_inserted` mediumint(8) DEFAULT '0',
  PRIMARY KEY (`mod_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_easymod`
--

LOCK TABLES `phpbb_easymod` WRITE;
/*!40000 ALTER TABLE `phpbb_easymod` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_easymod` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_easymod_processed_files`
--

DROP TABLE IF EXISTS `phpbb_easymod_processed_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_easymod_processed_files` (
  `mod_processed_file` varchar(255) NOT NULL DEFAULT '',
  `mod_id` mediumint(8) NOT NULL DEFAULT '0',
  KEY `mod_processed_file` (`mod_processed_file`),
  KEY `mod_id` (`mod_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_easymod_processed_files`
--

LOCK TABLES `phpbb_easymod_processed_files` WRITE;
/*!40000 ALTER TABLE `phpbb_easymod_processed_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_easymod_processed_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_email_users`
--

DROP TABLE IF EXISTS `phpbb_email_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_email_users` (
  `user_id` int(8) NOT NULL DEFAULT '0',
  `user_email` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_email_users`
--

LOCK TABLES `phpbb_email_users` WRITE;
/*!40000 ALTER TABLE `phpbb_email_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_email_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_extension_groups`
--

DROP TABLE IF EXISTS `phpbb_extension_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_extension_groups` (
  `group_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `group_name` char(20) NOT NULL,
  `cat_id` tinyint(2) NOT NULL DEFAULT '0',
  `allow_group` tinyint(1) NOT NULL DEFAULT '0',
  `download_mode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `upload_icon` varchar(100) DEFAULT '',
  `max_filesize` int(20) NOT NULL DEFAULT '0',
  `forum_permissions` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_extension_groups`
--

LOCK TABLES `phpbb_extension_groups` WRITE;
/*!40000 ALTER TABLE `phpbb_extension_groups` DISABLE KEYS */;
INSERT INTO `phpbb_extension_groups` VALUES (1,'Images',1,1,1,'',0,''),(2,'Archives',0,1,1,'',0,''),(3,'Plain Text',0,0,1,'',0,''),(4,'Documents',0,0,1,'',0,''),(5,'Real Media',0,0,2,'',0,''),(6,'Streams',2,0,1,'',0,''),(7,'Flash Files',3,0,1,'',0,'');
/*!40000 ALTER TABLE `phpbb_extension_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_extensions`
--

DROP TABLE IF EXISTS `phpbb_extensions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_extensions` (
  `ext_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `extension` varchar(100) NOT NULL,
  `comment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ext_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_extensions`
--

LOCK TABLES `phpbb_extensions` WRITE;
/*!40000 ALTER TABLE `phpbb_extensions` DISABLE KEYS */;
INSERT INTO `phpbb_extensions` VALUES (1,1,'gif',''),(2,1,'png',''),(3,1,'jpeg',''),(4,1,'jpg',''),(5,1,'tif',''),(6,1,'tga',''),(7,2,'gtar',''),(8,2,'gz',''),(9,2,'tar',''),(10,2,'zip',''),(11,2,'rar',''),(12,2,'ace',''),(13,3,'txt',''),(14,3,'c',''),(15,3,'h',''),(16,3,'cpp',''),(17,3,'hpp',''),(18,3,'diz',''),(19,4,'xls',''),(20,4,'doc',''),(21,4,'dot',''),(22,4,'pdf',''),(23,4,'ai',''),(24,4,'ps',''),(25,4,'ppt',''),(26,5,'rm',''),(27,6,'wma',''),(28,7,'swf','');
/*!40000 ALTER TABLE `phpbb_extensions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_flags`
--

DROP TABLE IF EXISTS `phpbb_flags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_flags` (
  `flag_id` int(10) NOT NULL AUTO_INCREMENT,
  `flag_name` varchar(25) DEFAULT NULL,
  `flag_image` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`flag_id`)
) ENGINE=MyISAM AUTO_INCREMENT=194 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_flags`
--

LOCK TABLES `phpbb_flags` WRITE;
/*!40000 ALTER TABLE `phpbb_flags` DISABLE KEYS */;
INSERT INTO `phpbb_flags` VALUES (1,'Afghanistan','afghanistan.gif'),(2,'Albania','albania.gif'),(3,'Algeria','algeria.gif'),(4,'Andorra','andorra.gif'),(5,'Angola','angola.gif'),(6,'Antigua and Barbuda','antiguabarbuda.gif'),(7,'Argentina','argentina.gif'),(8,'Armenia','armenia.gif'),(9,'Australia','australia.gif'),(10,'Austria','austria.gif'),(11,'Azerbaijan','azerbaijan.gif'),(12,'Bahamas','bahamas.gif'),(13,'Bahrain','bahrain.gif'),(14,'Bangladesh','bangladesh.gif'),(15,'Barbados','barbados.gif'),(16,'Belarus','belarus.gif'),(17,'Belgium','belgium.gif'),(18,'Belize','belize.gif'),(19,'Benin','benin.gif'),(20,'Bhutan','bhutan.gif'),(21,'Bolivia','bolivia.gif'),(22,'Bosnia Herzegovina','bosnia_herzegovina.gif'),(23,'Botswana','botswana.gif'),(24,'Brazil','brazil.gif'),(25,'Brunei','brunei.gif'),(26,'Bulgaria','bulgaria.gif'),(27,'Burkina Faso','burkinafaso.gif'),(28,'Burma','burma.gif'),(29,'Burundi','burundi.gif'),(30,'Cambodia','cambodia.gif'),(31,'Cameroon','cameroon.gif'),(32,'Canada','canada.gif'),(33,'Central African Rep','centralafricanrep.gif'),(34,'Chad','chad.gif'),(35,'Chile','chile.gif'),(36,'China','china.gif'),(37,'Columbia','columbia.gif'),(38,'Comoros','comoros.gif'),(39,'Congo','congo.gif'),(40,'Costa Rica','costarica.gif'),(41,'Croatia','croatia.gif'),(42,'Cuba','cuba.gif'),(43,'Cyprus','cyprus.gif'),(44,'Czech Republic','czechrepublic.gif'),(45,'Dem Rep Congo','demrepcongo.gif'),(46,'Denmark','denmark.gif'),(47,'Djibouti','djibouti.gif'),(48,'Dominica','dominica.gif'),(49,'Dominican Rep','dominicanrep.gif'),(50,'Ecuador','ecuador.gif'),(51,'Egypt','egypt.gif'),(52,'El Salvador','elsalvador.gif'),(53,'Eq Guinea','eq_guinea.gif'),(54,'Eritrea','eritrea.gif'),(55,'Estonia','estonia.gif'),(56,'Ethiopia','ethiopia.gif'),(57,'Fiji','fiji.gif'),(58,'Finland','finland.gif'),(59,'France','france.gif'),(60,'Gabon','gabon.gif'),(61,'Gambia','gambia.gif'),(62,'Georgia','georgia.gif'),(63,'Germany','germany.gif'),(64,'Ghana','ghana.gif'),(65,'Greece','greece.gif'),(66,'Grenada','grenada.gif'),(67,'Grenadines','grenadines.gif'),(68,'Guatemala','guatemala.gif'),(69,'Guinea','guinea.gif'),(70,'Guinea Bissau','guineabissau.gif'),(71,'Guyana','guyana.gif'),(72,'Haiti','haiti.gif'),(73,'Honduras','honduras.gif'),(74,'Hong Kong','hong_kong.gif'),(75,'Hungary','hungary.gif'),(76,'Iceland','iceland.gif'),(77,'India','india.gif'),(78,'Indonesia','indonesia.gif'),(79,'Iran','iran.gif'),(80,'Iraq','iraq.gif'),(81,'Ireland','ireland.gif'),(82,'Israel','israel.gif'),(83,'Italy','italy.gif'),(84,'Ivory Coast','ivorycoast.gif'),(85,'Jamaica','jamaica.gif'),(86,'Japan','japan.gif'),(87,'Jordan','jordan.gif'),(88,'Kazakhstan','kazakhstan.gif'),(89,'Kenya','kenya.gif'),(90,'Kiribati','kiribati.gif'),(91,'Kuwait','kuwait.gif'),(92,'Kyrgyzstan','kyrgyzstan.gif'),(93,'Laos','laos.gif'),(94,'Latvia','latvia.gif'),(95,'Lebanon','lebanon.gif'),(96,'Liberia','liberia.gif'),(97,'Libya','libya.gif'),(98,'Liechtenstein','liechtenstein.gif'),(99,'Lithuania','lithuania.gif'),(100,'Luxembourg','luxembourg.gif'),(101,'Macadonia','macadonia.gif'),(102,'Macau','macau.gif'),(103,'Madagascar','madagascar.gif'),(104,'Malawi','malawi.gif'),(105,'Malaysia','malaysia.gif'),(106,'Maldives','maldives.gif'),(107,'Mali','mali.gif'),(108,'Malta','malta.gif'),(109,'Mauritania','mauritania.gif'),(110,'Mauritius','mauritius.gif'),(111,'Mexico','mexico.gif'),(112,'Micronesia','micronesia.gif'),(113,'Moldova','moldova.gif'),(114,'Monaco','monaco.gif'),(115,'Mongolia','mongolia.gif'),(116,'Morocco','morocco.gif'),(117,'Mozambique','mozambique.gif'),(118,'Namibia','namibia.gif'),(119,'Nauru','nauru.gif'),(120,'Nepal','nepal.gif'),(121,'Neth Antilles','neth_antilles.gif'),(122,'Netherlands','netherlands.gif'),(123,'New Zealand','newzealand.gif'),(124,'Nicaragua','nicaragua.gif'),(125,'Niger','niger.gif'),(126,'Nigeria','nigeria.gif'),(127,'North Korea','north_korea.gif'),(128,'Norway','norway.gif'),(129,'Oman','oman.gif'),(130,'Pakistan','pakistan.gif'),(131,'Panama','panama.gif'),(132,'Papua New Guinea','papuanewguinea.gif'),(133,'Paraguay','paraguay.gif'),(134,'Peru','peru.gif'),(135,'Philippines','philippines.gif'),(136,'Poland','poland.gif'),(137,'Portugal','portugal.gif'),(138,'Puerto Rico','puertorico.gif'),(139,'Qatar','qatar.gif'),(140,'Quebec','quebec.gif'),(141,'Rawanda','rawanda.gif'),(142,'Romania','romania.gif'),(143,'Russia','russia.gif'),(144,'Sao Tome','sao_tome.gif'),(145,'Saudi Arabia','saudiarabia.gif'),(146,'Senegal','senegal.gif'),(147,'Serbia','serbia.gif'),(148,'Seychelles','seychelles.gif'),(149,'Sierra Leone','sierraleone.gif'),(150,'Singapore','singapore.gif'),(151,'Slovakia','slovakia.gif'),(152,'Slovenia','slovenia.gif'),(153,'Solomon Islands','solomon_islands.gif'),(154,'Somalia','somalia.gif'),(155,'South Korea','south_korea.gif'),(156,'South Africa','southafrica.gif'),(157,'Spain','spain.gif'),(158,'Sri Lanka','srilanka.gif'),(159,'St Kitts Nevis','stkitts_nevis.gif'),(160,'St Lucia','stlucia.gif'),(161,'Sudan','sudan.gif'),(162,'Suriname','suriname.gif'),(163,'Sweden','sweden.gif'),(164,'Switzerland','switzerland.gif'),(165,'Syria','syria.gif'),(166,'Taiwan','taiwan.gif'),(167,'Tajikistan','tajikistan.gif'),(168,'Tanzania','tanzania.gif'),(169,'Thailand','thailand.gif'),(170,'Togo','togo.gif'),(171,'Tonga','tonga.gif'),(172,'Trinidad and Tobago','trinidadandtobago.gif'),(173,'Tunisia','tunisia.gif'),(174,'Turkey','turkey.gif'),(175,'Turkmenistan','turkmenistan.gif'),(176,'Tuvala','tuvala.gif'),(177,'United Arab Emirates','uae.gif'),(178,'Uganda','uganda.gif'),(179,'United Kingdom','uk.gif'),(180,'Ukraine','ukraine.gif'),(181,'Uruguay','uruguay.gif'),(182,'United States of America','usa.gif'),(183,'USSR','ussr.gif'),(184,'Uzbekistan','uzbekistan.gif'),(185,'Vanuatu','vanuatu.gif'),(186,'Venezuela','venezuela.gif'),(187,'Vietnam','vietnam.gif'),(188,'Western Samoa','western_samoa.gif'),(189,'Yemen','yemen.gif'),(190,'Yugoslavia','yugoslavia.gif'),(191,'Zaire','zaire.gif'),(192,'Zambia','zambia.gif'),(193,'Zimbabwe','zimbabwe.gif');
/*!40000 ALTER TABLE `phpbb_flags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_forbidden_extensions`
--

DROP TABLE IF EXISTS `phpbb_forbidden_extensions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_forbidden_extensions` (
  `ext_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `extension` varchar(100) NOT NULL,
  PRIMARY KEY (`ext_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_forbidden_extensions`
--

LOCK TABLES `phpbb_forbidden_extensions` WRITE;
/*!40000 ALTER TABLE `phpbb_forbidden_extensions` DISABLE KEYS */;
INSERT INTO `phpbb_forbidden_extensions` VALUES (1,'php'),(2,'php3'),(3,'php4'),(4,'phtml'),(5,'pl'),(6,'asp'),(7,'cgi');
/*!40000 ALTER TABLE `phpbb_forbidden_extensions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_force_read`
--

DROP TABLE IF EXISTS `phpbb_force_read`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_force_read` (
  `topic_number` int(25) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `install_date` int(15) NOT NULL DEFAULT '0',
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `effected` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_force_read`
--

LOCK TABLES `phpbb_force_read` WRITE;
/*!40000 ALTER TABLE `phpbb_force_read` DISABLE KEYS */;
INSERT INTO `phpbb_force_read` VALUES (1,'Please read the following post as it contains important update information pertaining to this forum.',1334688207,0,1);
/*!40000 ALTER TABLE `phpbb_force_read` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_force_read_users`
--

DROP TABLE IF EXISTS `phpbb_force_read_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_force_read_users` (
  `user` varchar(255) NOT NULL DEFAULT '',
  `read` int(1) NOT NULL DEFAULT '0',
  `time` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_force_read_users`
--

LOCK TABLES `phpbb_force_read_users` WRITE;
/*!40000 ALTER TABLE `phpbb_force_read_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_force_read_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_forum_prune`
--

DROP TABLE IF EXISTS `phpbb_forum_prune`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_forum_prune` (
  `prune_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `forum_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `prune_days` smallint(5) unsigned NOT NULL DEFAULT '0',
  `prune_freq` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`prune_id`),
  KEY `forum_id` (`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_forum_prune`
--

LOCK TABLES `phpbb_forum_prune` WRITE;
/*!40000 ALTER TABLE `phpbb_forum_prune` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_forum_prune` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_forum_tour`
--

DROP TABLE IF EXISTS `phpbb_forum_tour`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_forum_tour` (
  `page_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `page_subject` varchar(60) DEFAULT NULL,
  `page_text` text,
  `page_sort` mediumint(8) NOT NULL DEFAULT '0',
  `bbcode_uid` varchar(10) DEFAULT NULL,
  `page_access` mediumint(8) NOT NULL,
  KEY `page_id` (`page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_forum_tour`
--

LOCK TABLES `phpbb_forum_tour` WRITE;
/*!40000 ALTER TABLE `phpbb_forum_tour` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_forum_tour` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_forums`
--

DROP TABLE IF EXISTS `phpbb_forums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_forums` (
  `forum_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `cat_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_name` varchar(150) DEFAULT NULL,
  `forum_desc` text,
  `forum_status` tinyint(4) NOT NULL DEFAULT '0',
  `forum_order` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `forum_posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_topics` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_last_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `prune_next` int(11) DEFAULT NULL,
  `prune_enable` tinyint(1) NOT NULL DEFAULT '0',
  `auth_view` tinyint(2) NOT NULL DEFAULT '0',
  `auth_read` tinyint(2) NOT NULL DEFAULT '0',
  `auth_post` tinyint(2) NOT NULL DEFAULT '0',
  `auth_reply` tinyint(2) NOT NULL DEFAULT '0',
  `auth_edit` tinyint(2) NOT NULL DEFAULT '0',
  `auth_delete` tinyint(2) NOT NULL DEFAULT '0',
  `auth_sticky` tinyint(2) NOT NULL DEFAULT '0',
  `auth_announce` tinyint(2) NOT NULL DEFAULT '0',
  `auth_global_announce` tinyint(2) NOT NULL DEFAULT '0',
  `auth_vote` tinyint(2) NOT NULL DEFAULT '0',
  `auth_pollcreate` tinyint(2) NOT NULL DEFAULT '0',
  `auth_attachments` tinyint(2) NOT NULL DEFAULT '0',
  `auth_download` tinyint(2) NOT NULL DEFAULT '0',
  `auth_news` tinyint(2) NOT NULL DEFAULT '2',
  `forum_link` varchar(255) DEFAULT NULL,
  `forum_link_internal` tinyint(1) NOT NULL DEFAULT '0',
  `forum_link_hit_count` tinyint(1) NOT NULL DEFAULT '0',
  `forum_link_hit` bigint(20) unsigned NOT NULL DEFAULT '0',
  `icon` varchar(255) DEFAULT NULL,
  `main_type` char(1) DEFAULT NULL,
  `auth_cal` tinyint(2) NOT NULL DEFAULT '0',
  `auth_ban` tinyint(2) NOT NULL DEFAULT '3',
  `auth_greencard` tinyint(2) NOT NULL DEFAULT '5',
  `auth_bluecard` tinyint(2) NOT NULL DEFAULT '1',
  `auth_delayedpost` tinyint(4) NOT NULL DEFAULT '3',
  PRIMARY KEY (`forum_id`),
  KEY `forums_order` (`forum_order`),
  KEY `cat_id` (`cat_id`),
  KEY `forum_last_post_id` (`forum_last_post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_forums`
--

LOCK TABLES `phpbb_forums` WRITE;
/*!40000 ALTER TABLE `phpbb_forums` DISABLE KEYS */;
INSERT INTO `phpbb_forums` VALUES (1,1,'Test Forum 1','This is just a test forum.',0,20,1,1,1,NULL,0,0,0,0,0,1,1,3,3,0,1,1,3,0,2,NULL,0,0,0,NULL,NULL,0,3,5,1,3),(2,1,'Test Forum 2','This is just a test forum.',0,30,0,0,0,NULL,0,0,0,1,1,1,1,3,3,5,1,1,3,0,3,'',0,0,0,'','c',3,3,5,1,3);
/*!40000 ALTER TABLE `phpbb_forums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_groups`
--

DROP TABLE IF EXISTS `phpbb_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_groups` (
  `group_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `group_type` tinyint(4) NOT NULL DEFAULT '1',
  `group_name` varchar(40) NOT NULL DEFAULT '',
  `group_description` varchar(255) NOT NULL DEFAULT '',
  `group_moderator` mediumint(8) NOT NULL DEFAULT '0',
  `group_single_user` tinyint(1) NOT NULL DEFAULT '1',
  `group_count` int(4) unsigned DEFAULT '99999999',
  `group_count_max` int(4) unsigned DEFAULT '99999999',
  `group_count_enable` smallint(2) unsigned DEFAULT '0',
  `group_amount` float DEFAULT '0',
  `group_period` int(11) DEFAULT '1',
  `group_period_basis` varchar(10) DEFAULT 'M',
  `group_first_trial_fee` float DEFAULT '0',
  `group_first_trial_period` int(11) DEFAULT '0',
  `group_first_trial_period_basis` varchar(10) DEFAULT '0',
  `group_second_trial_fee` float DEFAULT '0',
  `group_second_trial_period` int(11) DEFAULT '0',
  `group_second_trial_period_basis` varchar(10) DEFAULT '0',
  `group_sub_recurring` int(11) DEFAULT '1',
  `group_sub_recurring_stop` int(11) DEFAULT '0',
  `group_sub_recurring_stop_num` int(11) DEFAULT '0',
  `group_sub_reattempt` int(11) DEFAULT '1',
  PRIMARY KEY (`group_id`),
  KEY `group_single_user` (`group_single_user`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_groups`
--

LOCK TABLES `phpbb_groups` WRITE;
/*!40000 ALTER TABLE `phpbb_groups` DISABLE KEYS */;
INSERT INTO `phpbb_groups` VALUES (1,1,'Anonymous','Personal User',0,1,99999999,99999999,0,0,1,'M',0,0,'0',0,0,'0',1,0,0,1),(2,1,'Admin','Personal User',0,1,99999999,99999999,0,0,1,'M',0,0,'0',0,0,'0',1,0,0,1);
/*!40000 ALTER TABLE `phpbb_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_hacks_list`
--

DROP TABLE IF EXISTS `phpbb_hacks_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_hacks_list` (
  `hack_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `hack_name` varchar(255) NOT NULL DEFAULT '',
  `hack_desc` varchar(255) NOT NULL DEFAULT '',
  `hack_author` varchar(255) NOT NULL DEFAULT '',
  `hack_author_email` varchar(255) NOT NULL DEFAULT '',
  `hack_author_website` tinytext NOT NULL,
  `hack_version` varchar(32) NOT NULL DEFAULT '',
  `hack_hide` enum('Yes','No') NOT NULL DEFAULT 'No',
  `hack_download_url` tinytext NOT NULL,
  `hack_file` varchar(255) NOT NULL DEFAULT '',
  `hack_file_mtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`hack_id`),
  UNIQUE KEY `hack_name` (`hack_name`),
  KEY `hack_file` (`hack_file`),
  KEY `hack_hide` (`hack_hide`)
) ENGINE=MyISAM AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_hacks_list`
--

LOCK TABLES `phpbb_hacks_list` WRITE;
/*!40000 ALTER TABLE `phpbb_hacks_list` DISABLE KEYS */;
INSERT INTO `phpbb_hacks_list` VALUES (18,'Hacks List','Provides an admin panel for you to enter information about hacks you have installed on your board.','Nivisec','support@nivisec.com','http://www.nivisec.com/','1.20','No','http://www.nivisec.com/downloads/phpbb/hacks_list.zip','',1334688207),(4,'Admin Private Message Manager','An Admin panel plug in that allows the management of Private Messages on the board. You may sort by a variety of options, delete any PMs you choose, or optionally archive them for later use.','Nivisec','support@nivisec.com','http://www.nivisec.com/','1.5.1','No','http://www.nivisec.com/downloads/phpbb/admin_prv_msgs.zip','',1334688207),(7,'Admin Userlist','This MOD lets you view a list of every user on your board from the ACP.  While browsing the list you can activate, de-activate, delete, and ban multiple users at a time.  You can also edit one users permissions or manage their account.  Also see how many','wGEric','eric@egcnetwork.com','http://mods.best-dev.com/','2.0.1','No','http://eric.best-1.biz','',1334688207),(129,'Cash Mod','Cash Mod for users to gain money/points by posting','Xore','mods@xore.ca','http://www.xore.ca','2.2.3a','No','http://www.xore.ca','',1334688207),(12,'File Attachment Mod v2','This Mod adds the ability to attach files in phpBB2.','Acyd Burn','','http://www.opentools.de','2.3.10','No','http://www.opentools.de','',1334688207),(13,'Auto group','This mod will make it posible to add member to a user group, depending on there post count this makes it posible to make a group \\\"Everyone\\\" (0 posts) where all members are members by default or a group like \\\"Posters\\\" (1 posts) where all users witch ha','Niels Chr. Denmark','ncr@db9.dk','http://mods.db9.dk','1.2.1','No','http://mods.db9.dk','',1334688207),(131,'Lo-Fi Mod','This Mod will add a Textual/Low Graphic Layout to your Board. It\\\'s Ideal for Google Bot and for all Search Engine that spider your site, and also for printing in an easy way.','Bicet/CyberAlien/Justas','bicets@gmail.com','http://www.phpbbstyles.com','1.0.0','No','http://www.phpbbstyles.com','',1334688207),(15,'Complete banner','This mod makes it posible to add banners to your phpbb2 pages, by default banners are placed in top/botton but you may place the tags, inside any template file.','Niels Chr. Rød','ncr@db9.dk','http://mods.db9.dk','1.3.4','No','http://mods.db9.dk','',1334688207),(16,'phpBB2 Fast Hack','This makes your phpBB 2 forum faster.','dwing','dwing@weingarten-net.de','http://www.weingarten-net.de','1.0.0','No','http://www.weingarten-net.de','',1334688207),(19,'IntegraMOD','A pre-modded version of phpBB which integrates the best and most useful phpBB modifications.','masterdavid','webmaster@integramod.com','http://www.integramod.com','1.4.1f','No','http://www.integramod.com','',1334688207),(20,'IM Portal','A flexible and powerful portal addon for phpBB with dynamic blocks, multiple portal pages, display permissions and a dynamic cache system.','masterdavid','webmaster@integramod.com','http://www.integramod.com','1.2.0','No','http://www.integramod.com','',1334688207),(21,'Slash News Mod','Allows you to assign a news category to any new topic. The topic can then be displayed as news with a category graphic like Slashdot.','CodeMonkeyX','nickyoungso@yahoo.com','http://www.codemonkeyx.net','1.0.1','No','http://www.codemonkeyx.net','',1334688207),(22,'Forum Tour','Add a forum tour to your phpBB via ACP.','OXPUS','webmaster@oxpus.de','http://www.oxpus.de','1.0.3','No','http://www.oxpus.de','',1334688207),(23,'Junior Admin','This will allow you to define any and all users you\'d like to have access to whatever admin modules you\'d like.','Nivisec','support@nivisec.com','http://www.nivisec.com','2.0.5','No','http://www.nivisec.com/phpbb.php?l=p','../hl/jr_admin_by_nivisec.hl',1334688207),(24,'Left and Right IMG tags','This MOD will allow you to better format you posts by aligning images left and right instead of just in-line as with the standard [img][/img] tag. Text will also neatly wrap around the images.','Nuttzy','pktoolkit@blizzhackers.com','http://www.blizzhackers.com','1.6.0','No','http://www.blizzhackers.com','',1334688207),(25,'Mini Cal','Mini Calendar version of the Forum Calendar','netclectic','adrian@netclectic.com','http://www.netclectic.com/','2.0.2','No','http://www.netclectic.com/','',1334688207),(26,'Photo Album integration 4 PCP','This Mod integrates the Photo album by Smartor into the Profile Control Panel Mod','G-Funk','G-Funk@gmx.at','http://rpgnet.clanmckeen.com/demo/','0.1.4','No','http://rpgnet.clanmckeen.com/demo/','',1334688207),(27,'Announces Suite','This mod allows you to display the announces from the forum on the index page, and above the forum pages for the announce coming from forums of the same categories. It adds also a duration to each announcement, and global announcement.','Ptirhiik','admin@rpgnet-fr.com','http://rpgnet.clanmckeen.com/demo','3.0.2','No','http://rpgnet.clanmckeen.com/demo','',1334688207),(28,'Categories hierarchy','This mod allows to attach a categorie to a higher level categorie, keeping all the forum visible on the index page (vBulletin-like view), or have a sub-forum view.','Ptirhiik','ptirhiik@clanmckeen.com','http://rpgnet.clanmckeen.com/demo','2.0.4','No','http://rpgnet.clanmckeen.com/demo','',1334688207),(29,'Group ModeratorZ','This mod allows to have more than one moderator to a group','Ptirhiik','ptirhiik@clanmckeen.com','http://rpgnet.clanmckeen.com/demo','1.0.1','No','http://rpgnet.clanmckeen.com/demo','',1334688207),(30,'Keep unread topic','This mod keeps the unread flag active until the topic is read','Ptirhiik','ptirhiik@clanmckeen.com','http://rpgnet.clanmckeen.com/demo','1.0.0','No','http://rpgnet.clanmckeen.com/demo','',1334688207),(31,'Post Icons','This mod will allow to add an icon in front of each topic title.','Ptirhiik','ptirhiik@clanmckeen.com','http://rpgnet.clanmckeen.com/demo','1.0.1','No','http://rpgnet.clanmckeen.com/demo','',1334688207),(32,'Profile Control Panel','This mod is a rewrite of the user management, including new features','Ptirhiik','ptirhiik@clanmckeen.com','http://rpgnet.clanmckeen.com/demo','2.0.0-1','No','http://rpgnet.clanmckeen.com/demo','',1334688207),(33,'Split topic type','This mod splits the topic per type in the viewform display','Ptirhiik','ptirhiik@clanmckeen.com','http://rpgnet.clanmckeen.com/demo','2.0.1','No','http://rpgnet.clanmckeen.com/demo','',1334688207),(34,'Topic calendar','This mod adds a calendar to your board, working with natural phpBB auth','Ptirhiik','ptirhiik@clanmckeen.com','http://rpgnet.clanmckeen.com/demo','1.0.1','No','http://rpgnet.clanmckeen.com/demo','',1334688207),(35,'Page Generation Time','This MOD will show page generation info in the page footer','Smartor','smartor_xp@hotmail.com','http://smartor.is-root.com','2.0.0','No','http://smartor.is-root.com','',1334688207),(36,'PHP Syntax Highlighter BBCode','Highlights PHP specific code when used.','Fubonis','php_fubonis@yahoo.com','http://www.fubonis.com','3.0.4','No','http://www.fubonis.com','',1334688207),(37,'Approve Mod','Designate a forum for moderation by admins & chosen moderators','Aceman','phpbbmods@synace.com','http://www.synace.com','1.0.9','No','http://www.synace.com','',1334688207),(38,'PHP Info','This Mod shows the PHP Info in your Admin Panel.','Dwing','dwing@weingarten-net.de','http://www.dseitz.de','1.1.2','No','http://www.dseitz.de','',1334688207),(130,'Advanced BBCode Box MOD','This MOD adds lots of useful BBCode features and makes the bbcode buttons look just like Microsoft Office 2003. It also improves the functions of phpBB\\\'s BBCode function. It adds the bbcode exactly where the cursor is, inserts smilies where the cursor is','Disturbed One/AL Tnen','anthony@anthonycoy.com','http://www.hvmdesign.com','6','No','http://www.hvmdesign.com','',1334688207),(40,'Quick Reply with Quote','This will add a quick-reply form below every topics','Smartor','smartor_xp@hotmail.com','http://smartor.is-root.com','1.1.3','No','http://smartor.is-root.com','',1334688207),(41,'Rebuild Search Mod','This will index every post in your phpBB, rebuilding the search tables','GUI','spam@nickm.org','http://www.nickm.org/','1.0.0','No','http://www.nickm.org/','',1334688207),(43,'Send PM On User Registration','This MOD will send a PM to all new users when they register','AbelaJohnB','abela@phpbb.com','http://www.JohnAbela.Com','1.0.4','No','http://www.JohnAbela.Com','',1334688207),(44,'Fully integrated shoutbox','A fully phpBB2 enabled shoutbox','Niels Chr. Rød','ncr@db9.dk','http://mods.db9.dk ','1.0.10','No','http://mods.db9.dk ','',1334688207),(45,'Statistics Mod','The Statistics Mod is a complete statistics core for your phpBB 2 board','Acyd Burn','acyd.burn@gmx.de','http://www.opentools.de/board','3.0.0','No','http://www.opentools.de/board','',1334688207),(46,'Topic Description','This MOD allow you to add a little description of the topic that you have posted','Morpheus2matrix','morpheus2matrix@caramail.com','http://morpheus.2037.biz','1.0.5','No','http://morpheus.2037.biz','',1334688207),(47,'Usergroup Auto Join','Creates a usergroup category that allows a user to join without needing the approval of the group moderator','LifeIsPain','brian@orvp.net','','1.0.0','No','','',1334688207),(48,'Users of the day','Displays a list of the users who come during the last XX hours, which scrolls','fmavani','webmaster@feroz.org','http://feroz.domehost.com/forum','3.0.0','No','http://feroz.domehost.com/forum','',1334688207),(49,'Text-based Visit Counter','This will add a visit counter into your phpBB','Smartor','smartor_xp@hotmail.com','http://smartor.is-root.com','1.1.1','No','http://smartor.is-root.com','',1334688207),(51,'Add status to topic','This hack shows you how to add an info or status to a topic','Acid','','','1.0.3','No','http://www.phpbbhacks.com','',1334688207),(52,'Admin-Mods List Page','This hack produces a simple to understand page that shows anyone with any power other than that of a normal user in the ACP','Woody','woody@scoobler.com','','1.1.1','No','','',1334688207),(53,'BBcode Strike','This mod allows you to bar some text','R0cKW|LDeR','da_rockwilder_rw@yahoo.fr','','1.0','No','','',1334688207),(54,'Acronym Mod','Provides automatic acroymn additions to posts.','CodeMonkeyX','nickyoungso@yahoo.com','','0.9.4','No','','',1334688207),(55,'Country Flags for Profile Control Panel','This addon allows your registered board members to select the flag country of their residence','GilGraf','webmaster@ggweb-fr.com','http://ggweb-fr.com/phpbbfre','2.0.3','No','','',1334688207),(56,'Digests','Sends customized email digests of forum messages to subscribers','Indemmity83','Indemnity83@dormlife.us','http://www.dormlife.us','1.2.0','No','http://www.dormlife.us','',1334688207),(57,'Disable Board Message','Customize disable board message','Sko22','webmaste@quellicheilpc.com','http://www.quellicheilpc.com/','1.0.0','No','http://www.quellicheilpc.com/','',1334688207),(58,'Gender PCP Pic','This Mod adds the Gender Pictures for the PCP','G-Funk','G-Funk@k-wups.net','','0.1.2','No','http://rpgnet.clanmckeen.com/demo/','',1334688207),(59,'Google Search BBCode','Allows you to make strings in your post links to search for those strings at Google','wGEric','eric@egcnetwork.com','http://eric.best-1.biz','1.1.1','No','http://eric.best-1.biz','',1334688207),(60,'Knowledge Base','This mod is based on the Knowledge Base at phpBB with addon features','wGEric/Haplo','jonohlsson@hotmail.com','http://www.mx-system.com','2.0.2','No','http://www.mx-system.com','',1334688207),(61,'Keep Em Moving','This mod will keep your animated smilies animated even after clicking on one when posting.','Bill Beardslee','webmaster@webxtractions.com','','1.0.0','No','','',1334688207),(62,'Lock/Unlock in Posting Body','This Hack allows the Admin/Mod to lock/unlock a topic direct after submitting the post.','Meik Sievertsen','acyd.burn@gmx.de','','1.0.1','No','','',1334688207),(63,'Holidays for Profile Control Panel','Allows the users to or not specify if they are on holiday.','GilGraf','webmaster@ggweb-fr.com','http://ggweb-fr.com/phpbbfre/','1.0.3','No','http://rpgnet.clanmckeen.com/DEMO','',1334688207),(64,'No Thread Stretch','Prevents page stretching by long images and text','Thoul','thoul@users.sourceforge.net','http://darkmods.sourceforge.net','1.3.0','No','http://darkmods.sourceforge.net','',1334688207),(65,'Last Topics for Profile Control Panel','This add-on will add a new box on the profile home to display topics since your last visit or since x days','Ptirhiik','ptirhiik@clanmckeen.com','http://rpgnet.clanmckeen.com/demo','1.0.0','No','http://rpgnet.clanmckeen.com/demo','',1334688207),(66,'Bots MOD','Manage search engine bots in ACP','Adam Marcus','','','1.0.0','No','','',1334688207),(67,'printer-friendly topic view','This mod will add a button with a printer in topic view','Svyatozar','svyatozar@pochtamt.ru','','1.0.8','No','','',1334688207),(68,'Private Message Review','Review of received PM when replying','masterdavid','webmaster@integramod.com','','1.0.0','No','','',1334688207),(69,'Prune users','Admin plug-in that makes it posible to delete users who are inactive/haven\\\'t posted or like.','Niels Chr. Rød','ncr@db9.dk','http://mods.db9.dk','1.4.3','No','http://mods.db9.dk','',1334688207),(70,'QBar/QMenu','This mod will allow you to add a menu bar at the top of the board, and also will replace your default phpBB menu, allowing you to add quickly links to both within the ACP','Ptirhiik','ptirhiik@clanmckeen.com','http://rpgnet.clanmckeen.com/demo','1.0.1','No','http://rpgnet.clanmckeen.com/demo','',1334688207),(71,'Redirect to Post','After posting, editing, or deleting a message, the user is redirected to their post or the topic.','Thoul','thoul@users.sourceforge.net','http://darkmods.sourceforge.net','2.2.0','No','http://darkmods.sourceforge.net','',1334688207),(72,'Repeating events MOD','Repeating events for Topic Calendar','Antoon','antoonvdr@yahoo.com','','','No','','',1334688207),(73,'Rules Management for PCP','Create and to modify the Rules of the forum, checks how many users have read the rule from the last change and in case it is possible to warn them with a Private Message.','Sko22','sko22@quellicheilpc.com','http://www.quellicheilpc.com/','1.0.2','No','http://www.quellicheilpc.com/','',1334688207),(74,'Server Load Mod','Mod to show the number of pages served on your web server from your forums within a user-defined period','IDB','ian@errolian.com','http://www.team-allegiance.com','0.1.0','No','','',1334688207),(75,'Shrink Attached Image Mod','This Mod adds the ability to automatic shrink the attached image. It should works with the File Attachment Mod v2.3.10','roc','flying_roc@hotmail.com','http://roc.phpbbhost1.biz','1.0.0','No','http://roc.phpbbhost1.biz','',1334688207),(76,'Simply Merge Threads','This mod allows to merge two topics','Ptirhiik','ptirhiik@clanmckeen.com','http://www.rpgnet-fr.com','1.0.1','No','http://www.rpgnet-fr.com','',1334688207),(77,'Smilies in Topic Titles','Shows smilies in topic titles','Suisse','chatwithbea@bluewin.ch','http://www.techno-revelation.com','1.0.0','No','http://www.techno-revelation.com','',1334688207),(78,'Stop Author View Increase','Does not increase viewed count when author is viewing his/her own topic','DanielT','savi.mods@danielt.com','http://www.danielt.com','1.0.1','No','http://www.danielt.com','',1334688207),(80,'eXtreme Styles MOD','This mod is heavily optimized version of phpBB templates system and has some additional features. It compiles and executes files much faster, has cache system that speeds up templates many times, allowes to use php in templates and few other new features','CyberAlien','','http://www.phpbbstyles.com','2.3.1','No','http://www.phpbbstyles.com','',1334688207),(81,'Yellow card','Warning and ban system','Niels Chr. Rød','ncr@db9.dk','http://mods.db9.dk','1.4.11','No','http://mods.db9.dk','',1334688207),(82,'You BBCode','Adds a BBCode that puts the username of the person viewing the post where you add [you] to your post','wGEric','eric@egcnetwork.com','http://eric.best-1.biz','1.0.1','No','http://eric.best-1.biz','',1334688207),(83,'Type Quietly','Gently discourage users from \\\'shouting\\\' by popping up a Javascript alert if they start typing a message or subject in caps.','Lars Janssen','lars.tq@ukmix.net','http://www.ukmix.org/','1.0.1','No','http://www.ukmix.org/','',1334688207),(84,'ChatSpot','This will add a LIVE chatbox on your phpBB2','Project Dream Views','','http://www.dreamviews.com/chatspot/','3.02','No','http://www.dreamviews.com/chatspot/','',1334688207),(85,'Topic Shadow Manager','Admin Control Panel Plug-in to let you view all shadow topic links, some info about them, and optionally remove any or all.','Nivisec','support@nivisec.com','http://www.nivisec.com','2.13','No','http://www.nivisec.com/phpbb.php?l=p','./hl/topic_shadow_by_nivisec.hl',1334688207),(86,'Tell A Friend','This MOD will add a \\\"tell a friend\\\" feature','Hardout','duncan____jones@hotmail.com','www.handykoelsch.de','1.3.0','No','','',1334688207),(87,'BBCode Sup & Sub','Subscript (sub) and Superscript (sup) text','Lunatic','lunatic@10qt.net','http://www.10qt.net','1.0.0','No','www.phpbbhacks.com','',1334688207),(100,'Rating system','Users rate individual posts to produce overall ranks for posts, topics and users.','Gentle Giant','phpbb@mywebcommunities.com','http://www.mywebcommunities.com','1.1','No','http://www.phpbb.com','',1334688207),(89,'Rank images drop down menu','Changes the rank image selection to a drop down colum of all available images','Antony Bailey','','','1.0.0','No','http://www.phpbbhacks.com','',1334688207),(90,'Faq Manager','This mod allows the administrator to edit and re-arrange their FAQ and BBCode Guide through an admin control panel module','Selven','selven@zaion.com','http://www.zaion.com','1.0.0','No','www.phpbb.com','',1334688207),(91,'Group Extend','Adds into the ACP some features to see the permissions of groups and users','Malicious Rabbit','','http://www.web-lapin.levillage.org/forum/','0.0.1','No','http://www.web-lapin.levillage.org/forum/','',1334688207),(92,'Group Extra E-mails','Allows users to be informed via Email if they are removed from a group or if their request to join is denied','Malicious Rabbit','','http://www.web-lapin.levillage.org/forum/','1.0.1','No','http://www.web-lapin.levillage.org/forum/','',1334688207),(93,'Mass Email and PMs','Allows to send Mass PMs and E-mails to users using the ACP','Malicious Rabbit','','http://lapin-malin.com/','1.0.0','No','http://lapin-malin.com/','',1334688207),(94,'Ranks summarize','This mod displays all the ranks available on your board','Ptirhiik','ptirhiik@clanmckeen.com','http://www.rpgnet-fr.com','1.0.4','No','http://www.rpgnet-fr.com','',1334688207),(95,'Sub-templates','This mod allows you to set a different template - or parts of template - for a forum or an entire category','Ptirhiik','ptirhiik@clanmckeen.com','http://rpgnet.clanmckeen.com/demo','1.0.4','No','http://rpgnet.clanmckeen.com/demo','',1334688207),(96,'Error Mod','Adds error pages to your site so users don\\\'t get a boring old error screen .htaccess','Josh','Joshua_Hesketh@hotmail.com','http://cacfe.decoder.com.au','0.0.1','No','','',1334688207),(97,'Prillian - the Instant Messenger for phpBB','Allows registered users to use phpBB as an instant messenger.','Thoul','thoul@users.sourceforge.net','http://darkmods.sourceforge.net','0.7.0','No','http://darkmods.sourceforge.net','',1334688207),(98,'No flood control on edit','This MOD removes the flood control when editing posts','Graham','phpbb@grahameames.co.uk','http://www.grahameames.co.uk/phpbb','1.0.0','No','http://www.phpbb.com/files/mods/No_Flood_On_Edit_1.0.0.mod','',1334688207),(99,'MyCookies Manager','Adds a link to a page that will clear all of a user\\\'s cookies for that board.','A_Jelly_Doughnut','','http://www.phpbbsupport.co.uk','1.1.0','No','http://www.phpbbsupport.co.uk','',1334688207),(101,'Staff Site','An external site to display who is Mod or Admin on your board.','Acid','','','2.2.0','No','http://www.phpbbhacks.com','',1334688207),(102,'Postings Popup','This MOD will create a link from the replies in view forum which will create a popup window showing the users who have made posts to that topic together with the number of posts that they have made.','david63','david.wood63@btopenworld.com','http://www.david-wood.me.uk','1.3.0','No','www.phpbb.com','',1334688207),(103,'Smilies Upload Utility','Manage smilies images through the Admin Panel.','Thoul','thoul@users.sourceforge.net','http://darkmods.sourceforge.net','1.1.0','No','http://darkmods.sourceforge.net','../hl/smilies_upload.hl',1334688207),(104,'Optimize Database','It Checks and it Optimizes the Tables of the Database also in automatic.','Sko22','sko22@quellicheilpc.com','http://www.quellicheilpc.com/','1.2.2','No','http://www.quellicheilpc.com/','',1334688207),(105,'phpBB Database Cleaning','Clean all non-consistent data from forum database','Florian_DVP','florian@developpez.biz','http://florian.developpez.com','1.1.1','No','http://florian.developpez.com','',1334688207),(106,'Bookmarks','Keeps an internal list of bookmarks set by the user','PhilippK','phpBB2004@kordowich.net','http://phpbb.kordowich.net/','1.1.1a','No','http://phpbb.kordowich.net/','',1334688207),(107,'Delayed Topics','Allows users with the proper permissions to add topics that will appear at a given date.  Ideal if you want to schedule forum-based events and activities','themaze75','themaze75@hotmail.com','http://www.novisoft.com/maze','1.0.0','No','http://www.novisoft.com/maze','',1334688207),(108,'Today At/Yesterday At','Will show Today At if the post was posted today. Will show Yesterday At if the post was posted yesterday','akzhaiyk','phpbb2xp@myrunet.com','http://phpbb2xp.myrunet.com','1.0.0','No','http://phpbb2xp.myrunet.com','',1334688207),(109,'Extended Quote Tag','This Mod adds an extended functionality on the [quote] BBCode Tag.  Quote multiple posts through the topic review box','Acyd Burn','acyd.burn@gmx.de','http://www.opentools.de/','1.0.0','No','http://www.opentools.de/','',1334688207),(110,'IP Search','Search for a user by IP address.','Thoul','thoul@users.sourceforge.net','http://darkmods.sourceforge.net','1.2.0','No','http://darkmods.sourceforge.net','./hl/ip_search.hl',1334688207),(111,'Advanced Links Mod','Display links (with logo) on the forum index page.','stefan2k1','sp@phpbb2.de','http://www.phpbb2.de','1.2.2','No','http://www.phpbb2.de','',1334688207),(112,'Download Topics and Posts','Insert links on viewtopic to save the whole topic or one post of it in a textfile','OXPUS','webmaster@oxpus.de','http://www.oxpus.de','1.0.2','No','http://www.oxpus.de','',1334688207),(113,'DHTML Calendar Widget','The DHTML Calendar widget1 is an (HTML) user interface element that gives end-users a friendly way to select date and time','Mihai Bazon','mishoo@infoiasi.ro','http://dynarch.com/mishoo/','0.9.6','No','http://dynarch.com/mishoo/','',1334688207),(115,'DHTML Slide Menu for ACP','This MOD turns your ACP left pane into a Dynamic HTML Slide Menu (roll-in/roll-out effects), making it easier to navigate.\r\nModified by webmedic < bah@webmedic.net> (Brook HUmphrey) http://www.webmedic.net','markus_petrux','phpbb.mods@phpmix.com','http://www.phpmix.com','1.0.1','No','http://www.phpmix.com','',1334688207),(116,'phpBB Security','This MOD adds an enhanced security system to your phpBB forum.','aUsTiN','austin_inc@hotmail.com','http://phpbb-tweaks.com/','1.0.3','No','http://phpbb-tweaks.com/','',1334688207),(117,'HTTP Referers','Adds a referers page in ACP for admins, for a more detailed http referers overveiw.','oc5iD','admin@on-irc.net','http://on-irc.net','1.0.0','No','','',1334688207),(118,'Fix message_die for multiple errors MOD','This MOD replaces the \\\"message_die() was called multiple times\\\" message with something more useful. It reports a list of all \\\"those\\\" error messages with all relevant information. So that may help board administrators to identify the problem.','markus_petrux','phpbb.mods@phpmix.com','http://www.phpmix.com','1.0.3','No','http://www.phpmix.com/index.php?page=213&t=384','',1334688207),(119,'Force Topic Read','This MOD forces users to read a specific topic once before reading or posting in the forums.','aUsTiN','','http://www.phpbb-tweaks.com','1.0.2','No','http://www.phpbb-tweaks.com','',1334688207),(120,'PafileDB','Adds a file download database(downloads section) to your phpBB site.','PHP Arena/Mohd','','http://www.hostsector.com/~mohd/','3.1','No','http://www.hostsector.com/~mohd/','',1334688207),(121,'phpBB Spell','Adds a spellchecker to your phpBB site.','','','','3.1','No','','',1334688207),(122,'PCP Wizard','An Addon for PCP 2.0.0 that adds a more userfriendly interface to PCP.','Ednique','','http://www.integramod.com/','','No','','http://www.integramod.com/',1334688207),(123,'Donation MOD','Allows Paypal donations to be sent through your phpBB.','sandodo','zouxiong@loewen.com.sg','http://forum.loewen.com.sg','1.0.2','No','','http://forum.loewen.com.sg',1334688207),(124,'Paypal IPN Subscription','Adds group subscriptions through Paypal.','sandodo','zouxiong@loewen.com.sg','http://forum.loewen.com.sg','1.0.3','No','','http://forum.loewen.com.sg',1334688207),(128,'Photo for Profile Control Panel','This Mod adds the ability to let your users attach a photo to their profile.  This works exactly like the avatar function with all the ACP settings. You can even turn off the feature per user.','MrDSL','naugher@sbcglobal.net','http://www.thehottub.net','0.9.0','No','http://www.thehottub.net','',1334688207),(125,'CrackerTracker Professional G5','A fully integrated and complete Security System for your Forum. Blocks known Worm Attacks and Floods.','cback/cYbercOsmOnauT','webmaster@cback.de','http://www.cback.de','5.0.3','No','http://www.cback.de','',1334688207),(126,'Advanced Visual Confirmation','This MOD replaces the original CAPTCHA of the phpBB Visual Confirmation.','AmigaLink','webmaster@amigalink.de','http://www.EssenMitFreude.info','1.2.0','No','http://www.EssenMitFreude.info','',1334688207),(127,'Full Album Pack','An integration of Smartor\\\'s Photo Album with many of it\\\'s addons.  Supercharged Album Pack, Album Category Hierarchy, Album Multiple Uploads, Archive Mod, Thumbnail Dimension Mod, Picture Rotation Mod, Album Nuffload, Nuffimage, and many other modificat','Mighty Gorgon','','http://www.icyphoenix.com','1.2.3','No','http://www.icyphoenix.com','',1334688207);
/*!40000 ALTER TABLE `phpbb_hacks_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_im_config`
--

DROP TABLE IF EXISTS `phpbb_im_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_im_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_im_config`
--

LOCK TABLES `phpbb_im_config` WRITE;
/*!40000 ALTER TABLE `phpbb_im_config` DISABLE KEYS */;
INSERT INTO `phpbb_im_config` VALUES ('refresh_rate','60'),('flood_interval','15'),('success_close','1'),('refresh_method','2'),('auto_launch','0'),('popup_ims','1'),('list_ims','0'),('mode1_height','400'),('mode1_width','227'),('mode2_height','300'),('mode2_width','400'),('read_height','300'),('read_width','400'),('send_height','420'),('send_width','460'),('list_all_online','1'),('show_controls','1'),('allow_ims','1'),('allow_shout','1'),('allow_chat','1'),('override_users','0'),('enable_flood','1'),('box_limit','25'),('refresh_drop','1'),('play_sound','1'),('sound_name',''),('default_sound','0'),('themes_allow','1'),('themes_id','1'),('allow_network','1'),('session_length','120'),('enable_im_limit','1'),('auto_delete','1'),('open_pms','0'),('network_user_list','1'),('default_mode','1'),('mode3_height','100'),('mode3_width','400'),('prefs_height','500'),('prefs_width','500'),('use_frames','1'),('network_profile','profile'),('allow_mode_switch','1'),('version','0.7.0');
/*!40000 ALTER TABLE `phpbb_im_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_im_prefs`
--

DROP TABLE IF EXISTS `phpbb_im_prefs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_im_prefs` (
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_allow_ims` tinyint(1) NOT NULL DEFAULT '1',
  `user_allow_shout` tinyint(1) NOT NULL DEFAULT '1',
  `user_allow_chat` tinyint(1) NOT NULL DEFAULT '1',
  `user_allow_network` tinyint(1) NOT NULL DEFAULT '1',
  `admin_allow_ims` tinyint(1) NOT NULL DEFAULT '1',
  `admin_allow_shout` tinyint(1) NOT NULL DEFAULT '1',
  `admin_allow_chat` tinyint(1) NOT NULL DEFAULT '1',
  `admin_allow_network` tinyint(1) NOT NULL DEFAULT '1',
  `new_ims` smallint(5) unsigned NOT NULL DEFAULT '0',
  `unread_ims` smallint(5) unsigned NOT NULL DEFAULT '0',
  `read_ims` smallint(5) unsigned NOT NULL DEFAULT '0',
  `total_sent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `attach_sig` tinyint(1) NOT NULL DEFAULT '0',
  `refresh_rate` smallint(5) unsigned NOT NULL DEFAULT '60',
  `success_close` tinyint(1) NOT NULL DEFAULT '1',
  `refresh_method` tinyint(1) NOT NULL DEFAULT '2',
  `auto_launch` tinyint(1) NOT NULL DEFAULT '1',
  `popup_ims` tinyint(1) NOT NULL DEFAULT '1',
  `list_ims` tinyint(1) NOT NULL DEFAULT '0',
  `show_controls` tinyint(1) NOT NULL DEFAULT '1',
  `list_all_online` tinyint(1) NOT NULL DEFAULT '1',
  `default_mode` tinyint(1) NOT NULL DEFAULT '1',
  `current_mode` tinyint(1) NOT NULL DEFAULT '1',
  `mode1_height` varchar(4) NOT NULL DEFAULT '400',
  `mode1_width` varchar(4) NOT NULL DEFAULT '225',
  `mode2_height` varchar(4) NOT NULL DEFAULT '225',
  `mode2_width` varchar(4) NOT NULL DEFAULT '400',
  `mode3_height` varchar(4) NOT NULL DEFAULT '100',
  `mode3_width` varchar(4) NOT NULL DEFAULT '400',
  `prefs_width` varchar(4) NOT NULL DEFAULT '500',
  `prefs_height` varchar(4) NOT NULL DEFAULT '350',
  `read_height` varchar(4) NOT NULL DEFAULT '300',
  `read_width` varchar(4) NOT NULL DEFAULT '400',
  `send_height` varchar(4) NOT NULL DEFAULT '365',
  `send_width` varchar(4) NOT NULL DEFAULT '460',
  `play_sound` tinyint(1) NOT NULL DEFAULT '1',
  `default_sound` tinyint(1) NOT NULL DEFAULT '1',
  `sound_name` varchar(255) DEFAULT NULL,
  `themes_id` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `network_user_list` tinyint(1) NOT NULL DEFAULT '1',
  `open_pms` tinyint(1) NOT NULL DEFAULT '0',
  `auto_delete` tinyint(1) NOT NULL DEFAULT '0',
  `use_frames` tinyint(1) NOT NULL DEFAULT '1',
  `user_override` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_im_prefs`
--

LOCK TABLES `phpbb_im_prefs` WRITE;
/*!40000 ALTER TABLE `phpbb_im_prefs` DISABLE KEYS */;
INSERT INTO `phpbb_im_prefs` VALUES (2,1,1,1,1,1,1,1,1,0,0,0,0,0,60,1,2,1,1,0,1,1,1,1,'400','225','225','400','100','400','500','350','300','400','365','460',1,1,NULL,1,1,0,0,1,0);
/*!40000 ALTER TABLE `phpbb_im_prefs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_im_sessions`
--

DROP TABLE IF EXISTS `phpbb_im_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_im_sessions` (
  `session_user_id` mediumint(8) NOT NULL DEFAULT '0',
  `session_id` char(32) NOT NULL DEFAULT '',
  `session_time` int(11) NOT NULL DEFAULT '0',
  `session_popup` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`),
  KEY `session_user_id` (`session_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_im_sessions`
--

LOCK TABLES `phpbb_im_sessions` WRITE;
/*!40000 ALTER TABLE `phpbb_im_sessions` DISABLE KEYS */;
INSERT INTO `phpbb_im_sessions` VALUES (2,'b256fd88c6bec305ecb9747fe94d28f4',1334811804,1);
/*!40000 ALTER TABLE `phpbb_im_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_im_sites`
--

DROP TABLE IF EXISTS `phpbb_im_sites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_im_sites` (
  `site_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(50) NOT NULL DEFAULT '',
  `site_url` varchar(100) NOT NULL DEFAULT '',
  `site_phpex` varchar(4) NOT NULL DEFAULT 'php',
  `site_profile` varchar(50) NOT NULL DEFAULT 'profile',
  `site_enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_im_sites`
--

LOCK TABLES `phpbb_im_sites` WRITE;
/*!40000 ALTER TABLE `phpbb_im_sites` DISABLE KEYS */;
INSERT INTO `phpbb_im_sites` VALUES (1,'DarkMods','http://darkmods.sourceforge.net/mb/','php','profile',1),(2,'Moto-Forum','http://www.moto-forum.it/forum/','php','profile',1);
/*!40000 ALTER TABLE `phpbb_im_sites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_jr_admin_users`
--

DROP TABLE IF EXISTS `phpbb_jr_admin_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_jr_admin_users` (
  `user_id` mediumint(9) NOT NULL DEFAULT '0',
  `user_jr_admin` longtext NOT NULL,
  `start_date` int(10) unsigned NOT NULL DEFAULT '0',
  `update_date` int(10) unsigned NOT NULL DEFAULT '0',
  `admin_notes` text NOT NULL,
  `notes_view` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_jr_admin_users`
--

LOCK TABLES `phpbb_jr_admin_users` WRITE;
/*!40000 ALTER TABLE `phpbb_jr_admin_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_jr_admin_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_kb_articles`
--

DROP TABLE IF EXISTS `phpbb_kb_articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_kb_articles` (
  `article_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `article_category_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `article_title` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `article_description` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `article_date` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `article_author_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(255) DEFAULT NULL,
  `bbcode_uid` varchar(10) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `article_body` text NOT NULL,
  `article_type` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `approved` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `views` bigint(8) NOT NULL DEFAULT '0',
  `article_rating` double(6,4) NOT NULL DEFAULT '0.0000',
  `article_totalvotes` int(255) NOT NULL DEFAULT '0',
  KEY `article_id` (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_kb_articles`
--

LOCK TABLES `phpbb_kb_articles` WRITE;
/*!40000 ALTER TABLE `phpbb_kb_articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_kb_articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_kb_categories`
--

DROP TABLE IF EXISTS `phpbb_kb_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_kb_categories` (
  `category_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `category_details` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `number_articles` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `parent` mediumint(8) unsigned DEFAULT NULL,
  `cat_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_view` tinyint(3) NOT NULL DEFAULT '0',
  `auth_post` tinyint(3) NOT NULL DEFAULT '0',
  `auth_rate` tinyint(3) NOT NULL DEFAULT '0',
  `auth_comment` tinyint(3) NOT NULL DEFAULT '0',
  `auth_edit` tinyint(3) NOT NULL DEFAULT '0',
  `auth_delete` tinyint(3) NOT NULL DEFAULT '2',
  `auth_approval` tinyint(3) NOT NULL DEFAULT '0',
  `auth_approval_edit` tinyint(3) NOT NULL DEFAULT '0',
  `auth_view_groups` varchar(255) DEFAULT NULL,
  `auth_post_groups` varchar(255) DEFAULT NULL,
  `auth_rate_groups` varchar(255) DEFAULT NULL,
  `auth_comment_groups` varchar(255) DEFAULT NULL,
  `auth_edit_groups` varchar(255) DEFAULT NULL,
  `auth_delete_groups` varchar(255) DEFAULT NULL,
  `auth_approval_groups` varchar(255) DEFAULT NULL,
  `auth_approval_edit_groups` varchar(255) DEFAULT NULL,
  `auth_moderator_groups` varchar(255) DEFAULT NULL,
  `comments_forum_id` tinyint(3) NOT NULL DEFAULT '-1',
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_kb_categories`
--

LOCK TABLES `phpbb_kb_categories` WRITE;
/*!40000 ALTER TABLE `phpbb_kb_categories` DISABLE KEYS */;
INSERT INTO `phpbb_kb_categories` VALUES (1,'Test Category 1','This is a test category',0,0,10,0,0,0,0,0,2,0,0,'','','','','','','','','',0);
/*!40000 ALTER TABLE `phpbb_kb_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_kb_config`
--

DROP TABLE IF EXISTS `phpbb_kb_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_kb_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_kb_config`
--

LOCK TABLES `phpbb_kb_config` WRITE;
/*!40000 ALTER TABLE `phpbb_kb_config` DISABLE KEYS */;
INSERT INTO `phpbb_kb_config` VALUES ('allow_new','1'),('notify','1'),('admin_id','2'),('show_pretext','0'),('pt_header','Article Submission Instructions'),('pt_body','Please check your references and include as much information as you can.'),('use_comments','1'),('del_topic','1'),('use_ratings','0'),('comments_show','1'),('bump_post','1'),('stats_list','1'),('header_banner','1'),('votes_check_userid','1'),('votes_check_ip','1'),('art_pagination','5'),('comments_pagination','5'),('news_sort','Alphabetic'),('news_sort_par','ASC'),('wysiwyg','0'),('wysiwyg_path','modules/'),('allow_html','1'),('allow_bbcode','1'),('allow_smilies','1'),('formatting_fixup','0'),('allowed_html_tags','b,i,u,a');
/*!40000 ALTER TABLE `phpbb_kb_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_kb_custom`
--

DROP TABLE IF EXISTS `phpbb_kb_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_kb_custom` (
  `custom_id` int(50) NOT NULL AUTO_INCREMENT,
  `custom_name` text NOT NULL,
  `custom_description` text NOT NULL,
  `data` text NOT NULL,
  `field_order` int(20) NOT NULL DEFAULT '0',
  `field_type` tinyint(2) NOT NULL DEFAULT '0',
  `regex` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`custom_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_kb_custom`
--

LOCK TABLES `phpbb_kb_custom` WRITE;
/*!40000 ALTER TABLE `phpbb_kb_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_kb_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_kb_customdata`
--

DROP TABLE IF EXISTS `phpbb_kb_customdata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_kb_customdata` (
  `customdata_file` int(50) NOT NULL DEFAULT '0',
  `customdata_custom` int(50) NOT NULL DEFAULT '0',
  `data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_kb_customdata`
--

LOCK TABLES `phpbb_kb_customdata` WRITE;
/*!40000 ALTER TABLE `phpbb_kb_customdata` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_kb_customdata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_kb_results`
--

DROP TABLE IF EXISTS `phpbb_kb_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_kb_results` (
  `search_id` int(11) unsigned NOT NULL DEFAULT '0',
  `session_id` varchar(32) NOT NULL DEFAULT '',
  `search_array` mediumtext NOT NULL,
  PRIMARY KEY (`search_id`),
  KEY `session_id` (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_kb_results`
--

LOCK TABLES `phpbb_kb_results` WRITE;
/*!40000 ALTER TABLE `phpbb_kb_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_kb_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_kb_types`
--

DROP TABLE IF EXISTS `phpbb_kb_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_kb_types` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_kb_types`
--

LOCK TABLES `phpbb_kb_types` WRITE;
/*!40000 ALTER TABLE `phpbb_kb_types` DISABLE KEYS */;
INSERT INTO `phpbb_kb_types` VALUES (1,'Test Type 1');
/*!40000 ALTER TABLE `phpbb_kb_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_kb_votes`
--

DROP TABLE IF EXISTS `phpbb_kb_votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_kb_votes` (
  `votes_ip` varchar(50) NOT NULL DEFAULT '0',
  `votes_userid` int(50) NOT NULL DEFAULT '0',
  `votes_file` int(50) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_kb_votes`
--

LOCK TABLES `phpbb_kb_votes` WRITE;
/*!40000 ALTER TABLE `phpbb_kb_votes` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_kb_votes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_kb_wordlist`
--

DROP TABLE IF EXISTS `phpbb_kb_wordlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_kb_wordlist` (
  `word_text` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `word_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `word_common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`word_text`),
  KEY `word_id` (`word_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_kb_wordlist`
--

LOCK TABLES `phpbb_kb_wordlist` WRITE;
/*!40000 ALTER TABLE `phpbb_kb_wordlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_kb_wordlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_kb_wordmatch`
--

DROP TABLE IF EXISTS `phpbb_kb_wordmatch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_kb_wordmatch` (
  `article_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `word_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title_match` tinyint(1) NOT NULL DEFAULT '0',
  KEY `post_id` (`article_id`),
  KEY `word_id` (`word_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_kb_wordmatch`
--

LOCK TABLES `phpbb_kb_wordmatch` WRITE;
/*!40000 ALTER TABLE `phpbb_kb_wordmatch` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_kb_wordmatch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_layout`
--

DROP TABLE IF EXISTS `phpbb_layout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_layout` (
  `lid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `template` varchar(100) NOT NULL DEFAULT '',
  `forum_wide` tinyint(1) NOT NULL DEFAULT '1',
  `view` tinyint(1) NOT NULL DEFAULT '0',
  `groups` tinytext NOT NULL,
  `pagetitle` varchar(100) NOT NULL DEFAULT 'Home',
  PRIMARY KEY (`lid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_layout`
--

LOCK TABLES `phpbb_layout` WRITE;
/*!40000 ALTER TABLE `phpbb_layout` DISABLE KEYS */;
INSERT INTO `phpbb_layout` VALUES (1,'IntegraMOD Default','portal_body.tpl',1,0,'','Home'),(2,'Install and Configure','layout1.tpl',1,0,'','Home'),(3,'Sample 3 Column Layout','3_column.tpl',0,0,'','Sample 3 Column Layout'),(4,'Sample 4 Column Layout','4_column.tpl',0,0,'','Sample 4 Column Layout'),(5,'Sample 5 Column Layout','5_column.tpl',0,0,'','5 Column Layout'),(6,'Sample 6 Column Layout','6_column.tpl',0,0,'','6 Column Layout');
/*!40000 ALTER TABLE `phpbb_layout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_link_categories`
--

DROP TABLE IF EXISTS `phpbb_link_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_link_categories` (
  `cat_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(100) NOT NULL DEFAULT '',
  `cat_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`),
  KEY `cat_order` (`cat_order`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_link_categories`
--

LOCK TABLES `phpbb_link_categories` WRITE;
/*!40000 ALTER TABLE `phpbb_link_categories` DISABLE KEYS */;
INSERT INTO `phpbb_link_categories` VALUES (1,'Arts',1),(2,'Business',2),(3,'Children and Teens',3),(4,'Computers',4),(5,'Games',5),(6,'Health',6),(7,'Home',7),(8,'News',8);
/*!40000 ALTER TABLE `phpbb_link_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_link_config`
--

DROP TABLE IF EXISTS `phpbb_link_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_link_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_link_config`
--

LOCK TABLES `phpbb_link_config` WRITE;
/*!40000 ALTER TABLE `phpbb_link_config` DISABLE KEYS */;
INSERT INTO `phpbb_link_config` VALUES ('site_logo','http://www.integramod.com/home/images/banners/integra_88x31.gif'),('site_url','http://www.integramod.com'),('width','88'),('height','31'),('linkspp','10'),('display_interval','6000'),('display_logo_num','10'),('display_links_logo','1'),('email_notify','1'),('lock_submit_site','0'),('allow_no_logo','0');
/*!40000 ALTER TABLE `phpbb_link_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_links`
--

DROP TABLE IF EXISTS `phpbb_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_links` (
  `link_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `link_title` varchar(100) NOT NULL DEFAULT '',
  `link_desc` varchar(255) DEFAULT NULL,
  `link_category` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `link_url` varchar(100) NOT NULL DEFAULT '',
  `link_logo_src` varchar(120) DEFAULT NULL,
  `link_joined` int(11) NOT NULL DEFAULT '0',
  `link_active` tinyint(1) NOT NULL DEFAULT '0',
  `link_hits` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_ip` varchar(8) NOT NULL DEFAULT '',
  `last_user_ip` varchar(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_links`
--

LOCK TABLES `phpbb_links` WRITE;
/*!40000 ALTER TABLE `phpbb_links` DISABLE KEYS */;
INSERT INTO `phpbb_links` VALUES (1,'phpBB Official Website','Official phpBB Website',4,'http://www.phpbb.com/','images/banners/phpBB_88a.gif',1334688207,1,0,2,'',''),(2,'phpbbhacks','Place of phpbb modifications',4,'http://www.phpbbhacks.com','images/banners/phpbbhacks.gif',1334688207,1,0,2,'',''),(3,'IntegraMOD','The best pre-modded version of phpBB',4,'http://www.integramod.com','images/banners/integra_88x31.gif',1334688207,1,1,2,'','7f000001'),(4,'Forumimages.com','forumimages.co.uk',4,'http://www.forumimages.co.uk','images/banners/forum_images_banner_88x31.gif',1334688207,1,0,2,'','');
/*!40000 ALTER TABLE `phpbb_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_module_admin_panel`
--

DROP TABLE IF EXISTS `phpbb_module_admin_panel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_module_admin_panel` (
  `module_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT '',
  `config_type` varchar(20) NOT NULL DEFAULT '',
  `config_title` varchar(100) NOT NULL DEFAULT '',
  `config_explain` varchar(100) DEFAULT NULL,
  `config_trigger` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_module_admin_panel`
--

LOCK TABLES `phpbb_module_admin_panel` WRITE;
/*!40000 ALTER TABLE `phpbb_module_admin_panel` DISABLE KEYS */;
INSERT INTO `phpbb_module_admin_panel` VALUES (8,'num_columns','2','number','num_columns_title','num_columns_explain','integer'),(10,'exclude_images','0','number','exclude_images_title','exclude_images_explain','enum');
/*!40000 ALTER TABLE `phpbb_module_admin_panel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_module_cache`
--

DROP TABLE IF EXISTS `phpbb_module_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_module_cache` (
  `module_id` mediumint(8) NOT NULL DEFAULT '0',
  `module_cache_time` int(12) NOT NULL DEFAULT '0',
  `db_cache` text NOT NULL,
  `priority` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_module_cache`
--

LOCK TABLES `phpbb_module_cache` WRITE;
/*!40000 ALTER TABLE `phpbb_module_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_module_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_module_group_auth`
--

DROP TABLE IF EXISTS `phpbb_module_group_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_module_group_auth` (
  `module_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_module_group_auth`
--

LOCK TABLES `phpbb_module_group_auth` WRITE;
/*!40000 ALTER TABLE `phpbb_module_group_auth` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_module_group_auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_module_info`
--

DROP TABLE IF EXISTS `phpbb_module_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_module_info` (
  `module_id` mediumint(8) NOT NULL DEFAULT '0',
  `long_name` varchar(100) NOT NULL DEFAULT '',
  `author` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `version` varchar(10) NOT NULL DEFAULT '',
  `update_site` varchar(100) DEFAULT NULL,
  `extra_info` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_module_info`
--

LOCK TABLES `phpbb_module_info` WRITE;
/*!40000 ALTER TABLE `phpbb_module_info` DISABLE KEYS */;
INSERT INTO `phpbb_module_info` VALUES (1,'Administrative Statistics','Acyd Burn','acyd.burn@gmx.de','http://www.opentools.de','3.0.0','http://www.opentools.de/board/show_modules.php','This Module displays some Admin Statistics about your Board.\nIt is nearly the same you are able to see within the first Administration Panel visit.'),(2,'Most active Topics','Acyd Burn','acyd.burn@gmx.de','http://www.opentools.de','3.0.0','http://www.opentools.de/board/show_modules.php','This Module displays the most active topics at your board.'),(3,'Most viewed topics','Acyd Burn','acyd.burn@gmx.de','http://www.opentools.de','3.0.0','http://www.opentools.de/board/show_modules.php','This Module displays the most viewed topics at your board.'),(4,'Top Posters','Acyd Burn','acyd.burn@gmx.de','http://www.opentools.de','3.0.0','http://www.opentools.de/board/show_modules.php','This Module displays the Top Posters from your board.\nAnonymous Poster are not counted.'),(5,'Top Smilies','Acyd Burn','acyd.burn@gmx.de','http://www.opentools.de','3.0.0','http://www.opentools.de/board/show_modules.php','This Module displays the Top Smilies used at your board.\nThis Module uses an Smilie Index Table for caching the smilie data and to not\nrequire re-indexing of all posts.'),(6,'Most Active Topicstarter','Acyd Burn','acyd.burn@gmx.de','http://www.opentools.de','3.0.0','http://www.opentools.de/board/show_modules.php','This Module displays the most active topicstarter on your board.\nAnonymous Poster are not counted.'),(7,'New posts by month','Acyd Burn','acyd.burn@gmx.de','http://www.opentools.de','3.0.0','http://www.opentools.de/board/show_modules.php','This Module will display the posts created at your Board in a monthly statistic.'),(8,'Statistics Overview Section','Acyd Burn','acyd.burn@gmx.de','http://www.opentools.de','3.0.0','http://www.opentools.de/board/show_modules.php','This Module will print out a link Block with Links to the current Module at the Statistics Site.\nYou are able to define the number of columns displayed for this Module within the Administration Panel -&gt; Edit Module.'),(9,'New topics by month','Acyd Burn','acyd.burn@gmx.de','http://www.opentools.de','3.0.0','http://www.opentools.de/board/show_modules.php','This Module will display the topics created at your Board in a monthly statistic.'),(10,'Top Downloaded Attachments','Acyd Burn','acyd.burn@gmx.de','http://www.opentools.de','3.0.0','http://www.opentools.de/board/show_modules.php','This Module will print out the most downloaded Files.\nThe Attachment Mod Version 2.3.x have to be installed in order to let this Module work.\nYou are able to exclude Images from the statistic too.'),(11,'Top Posters this Month (Site History Mod)','Acyd Burn','acyd.burn@gmx.de','http://www.opentools.de','3.0.0','http://www.opentools.de/board/show_modules.php','This Module does NOT require the Site History Mod,\nit will display the Top Posters on a Monthly basis.'),(12,'Top Posters this Week (Site History Mod)','Acyd Burn','acyd.burn@gmx.de','http://www.opentools.de','3.0.0','http://www.opentools.de/board/show_modules.php','This Module does NOT require the Site History Mod,\nit will display the Top Posters on a Weekly basis.'),(13,'New users by month','Acyd Burn','acyd.burn@gmx.de','http://www.opentools.de','3.0.0','http://www.opentools.de/board/show_modules.php','This Module will display the users registered to your Board in a monthly statistic.');
/*!40000 ALTER TABLE `phpbb_module_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_modules`
--

DROP TABLE IF EXISTS `phpbb_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_modules` (
  `module_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `short_name` varchar(100) DEFAULT NULL,
  `update_time` mediumint(8) NOT NULL DEFAULT '0',
  `module_order` mediumint(8) NOT NULL DEFAULT '0',
  `active` tinyint(2) NOT NULL DEFAULT '0',
  `perm_all` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `perm_reg` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `perm_mod` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `perm_admin` tinyint(2) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_modules`
--

LOCK TABLES `phpbb_modules` WRITE;
/*!40000 ALTER TABLE `phpbb_modules` DISABLE KEYS */;
INSERT INTO `phpbb_modules` VALUES (1,'admin_statistics',360,20,1,1,1,1,1),(2,'most_active_topics',360,30,1,1,1,1,1),(3,'most_viewed_topics',360,40,1,1,1,1,1),(4,'top_posters',360,50,1,1,1,1,1),(5,'top_smilies',0,60,1,1,1,1,1),(6,'most_active_topicstarter',360,70,1,1,1,1,1),(7,'posts_by_month',360,80,1,1,1,1,1),(8,'stats_overview',360,10,1,1,1,1,1),(9,'topics_by_month',360,90,1,1,1,1,1),(10,'top_attachments',360,100,1,1,1,1,1),(11,'top_posters_month',360,110,1,1,1,1,1),(12,'top_posters_week',360,120,1,1,1,1,1),(13,'users_by_month',360,130,1,1,1,1,1);
/*!40000 ALTER TABLE `phpbb_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_news`
--

DROP TABLE IF EXISTS `phpbb_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_news` (
  `news_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `news_category` varchar(70) NOT NULL DEFAULT '',
  `news_image` varchar(70) NOT NULL DEFAULT '',
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_news`
--

LOCK TABLES `phpbb_news` WRITE;
/*!40000 ALTER TABLE `phpbb_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_optimize_db`
--

DROP TABLE IF EXISTS `phpbb_optimize_db`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_optimize_db` (
  `cron_enable` enum('0','1') NOT NULL DEFAULT '0',
  `cron_every` int(7) NOT NULL DEFAULT '86400',
  `cron_next` int(11) NOT NULL DEFAULT '0',
  `cron_count` int(5) NOT NULL DEFAULT '0',
  `cron_lock` enum('0','1') NOT NULL DEFAULT '0',
  `show_begin_for` varchar(150) NOT NULL DEFAULT '',
  `show_not_optimized` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_optimize_db`
--

LOCK TABLES `phpbb_optimize_db` WRITE;
/*!40000 ALTER TABLE `phpbb_optimize_db` DISABLE KEYS */;
INSERT INTO `phpbb_optimize_db` VALUES ('0',86400,1334774970,0,'1','','0');
/*!40000 ALTER TABLE `phpbb_optimize_db` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_pa_auth`
--

DROP TABLE IF EXISTS `phpbb_pa_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_pa_auth` (
  `group_id` mediumint(8) NOT NULL DEFAULT '0',
  `cat_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `auth_view` tinyint(1) NOT NULL DEFAULT '0',
  `auth_read` tinyint(1) NOT NULL DEFAULT '0',
  `auth_view_file` tinyint(1) NOT NULL DEFAULT '0',
  `auth_edit_file` tinyint(1) NOT NULL DEFAULT '0',
  `auth_delete_file` tinyint(1) NOT NULL DEFAULT '0',
  `auth_upload` tinyint(1) NOT NULL DEFAULT '0',
  `auth_download` tinyint(1) NOT NULL DEFAULT '0',
  `auth_rate` tinyint(1) NOT NULL DEFAULT '0',
  `auth_email` tinyint(1) NOT NULL DEFAULT '0',
  `auth_view_comment` tinyint(1) NOT NULL DEFAULT '0',
  `auth_post_comment` tinyint(1) NOT NULL DEFAULT '0',
  `auth_edit_comment` tinyint(1) NOT NULL DEFAULT '0',
  `auth_delete_comment` tinyint(1) NOT NULL DEFAULT '0',
  `auth_mod` tinyint(1) NOT NULL DEFAULT '0',
  `auth_search` tinyint(1) NOT NULL DEFAULT '1',
  `auth_stats` tinyint(1) NOT NULL DEFAULT '1',
  `auth_toplist` tinyint(1) NOT NULL DEFAULT '1',
  `auth_viewall` tinyint(1) NOT NULL DEFAULT '1',
  KEY `group_id` (`group_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_pa_auth`
--

LOCK TABLES `phpbb_pa_auth` WRITE;
/*!40000 ALTER TABLE `phpbb_pa_auth` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_pa_auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_pa_cat`
--

DROP TABLE IF EXISTS `phpbb_pa_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_pa_cat` (
  `cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_name` text,
  `cat_desc` text,
  `cat_parent` int(50) DEFAULT NULL,
  `parents_data` text NOT NULL,
  `cat_order` int(50) DEFAULT NULL,
  `cat_allow_file` tinyint(2) NOT NULL DEFAULT '0',
  `cat_allow_ratings` tinyint(2) NOT NULL DEFAULT '1',
  `cat_allow_comments` tinyint(2) NOT NULL DEFAULT '1',
  `cat_files` mediumint(8) NOT NULL DEFAULT '-1',
  `cat_last_file_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `cat_last_file_name` varchar(255) NOT NULL DEFAULT '',
  `cat_last_file_time` int(50) unsigned NOT NULL DEFAULT '0',
  `auth_view` tinyint(2) NOT NULL DEFAULT '0',
  `auth_read` tinyint(2) NOT NULL DEFAULT '0',
  `auth_view_file` tinyint(2) NOT NULL DEFAULT '0',
  `auth_edit_file` tinyint(1) NOT NULL DEFAULT '0',
  `auth_delete_file` tinyint(1) NOT NULL DEFAULT '0',
  `auth_upload` tinyint(2) NOT NULL DEFAULT '0',
  `auth_download` tinyint(2) NOT NULL DEFAULT '0',
  `auth_rate` tinyint(2) NOT NULL DEFAULT '0',
  `auth_email` tinyint(2) NOT NULL DEFAULT '0',
  `auth_view_comment` tinyint(2) NOT NULL DEFAULT '0',
  `auth_post_comment` tinyint(2) NOT NULL DEFAULT '0',
  `auth_edit_comment` tinyint(2) NOT NULL DEFAULT '0',
  `auth_delete_comment` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_pa_cat`
--

LOCK TABLES `phpbb_pa_cat` WRITE;
/*!40000 ALTER TABLE `phpbb_pa_cat` DISABLE KEYS */;
INSERT INTO `phpbb_pa_cat` VALUES (1,'My Category','',0,'',1,0,1,1,0,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0),(2,'Test Category','Just a test category',1,'',2,1,1,1,0,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0);
/*!40000 ALTER TABLE `phpbb_pa_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_pa_comments`
--

DROP TABLE IF EXISTS `phpbb_pa_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_pa_comments` (
  `comments_id` int(10) NOT NULL AUTO_INCREMENT,
  `file_id` int(10) NOT NULL DEFAULT '0',
  `comments_text` text NOT NULL,
  `comments_title` text NOT NULL,
  `comments_time` int(50) NOT NULL DEFAULT '0',
  `comment_bbcode_uid` varchar(10) DEFAULT NULL,
  `poster_id` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comments_id`),
  KEY `comments_id` (`comments_id`),
  FULLTEXT KEY `comment_bbcode_uid` (`comment_bbcode_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_pa_comments`
--

LOCK TABLES `phpbb_pa_comments` WRITE;
/*!40000 ALTER TABLE `phpbb_pa_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_pa_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_pa_config`
--

DROP TABLE IF EXISTS `phpbb_pa_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_pa_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_pa_config`
--

LOCK TABLES `phpbb_pa_config` WRITE;
/*!40000 ALTER TABLE `phpbb_pa_config` DISABLE KEYS */;
INSERT INTO `phpbb_pa_config` VALUES ('allow_comment_images','1'),('no_comment_image_message','[No image please]'),('allow_smilies','1'),('allow_comment_links','1'),('no_comment_link_message','[No links please]'),('settings_disable','0'),('allow_html','1'),('allow_bbcode','1'),('settings_topnumber','10'),('settings_newdays','7'),('settings_stats',''),('settings_viewall','1'),('settings_dbname','Download Database'),('settings_dbdescription',''),('max_comment_chars','5000'),('tpl_php','0'),('settings_file_page','20'),('hotlink_prevent','1'),('hotlink_allowed',''),('sort_method','file_time'),('sort_order','DESC'),('need_validation','0'),('validator','validator_admin'),('pm_notify','0'),('auth_search','0'),('auth_stats','0'),('auth_toplist','0'),('auth_viewall','0'),('max_file_size','262144'),('upload_dir','pafiledb/uploads/'),('screenshots_dir','pafiledb/images/ss/'),('forbidden_extensions','php, php3, php4, phtml, pl, asp, aspx, cgi');
/*!40000 ALTER TABLE `phpbb_pa_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_pa_custom`
--

DROP TABLE IF EXISTS `phpbb_pa_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_pa_custom` (
  `custom_id` int(50) NOT NULL AUTO_INCREMENT,
  `custom_name` text NOT NULL,
  `custom_description` text NOT NULL,
  `data` text NOT NULL,
  `field_order` int(20) NOT NULL DEFAULT '0',
  `field_type` tinyint(2) NOT NULL DEFAULT '0',
  `regex` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`custom_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_pa_custom`
--

LOCK TABLES `phpbb_pa_custom` WRITE;
/*!40000 ALTER TABLE `phpbb_pa_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_pa_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_pa_customdata`
--

DROP TABLE IF EXISTS `phpbb_pa_customdata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_pa_customdata` (
  `customdata_file` int(50) NOT NULL DEFAULT '0',
  `customdata_custom` int(50) NOT NULL DEFAULT '0',
  `data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_pa_customdata`
--

LOCK TABLES `phpbb_pa_customdata` WRITE;
/*!40000 ALTER TABLE `phpbb_pa_customdata` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_pa_customdata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_pa_download_info`
--

DROP TABLE IF EXISTS `phpbb_pa_download_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_pa_download_info` (
  `file_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `downloader_ip` varchar(8) NOT NULL DEFAULT '',
  `downloader_os` varchar(255) NOT NULL DEFAULT '',
  `downloader_browser` varchar(255) NOT NULL DEFAULT '',
  `browser_version` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_pa_download_info`
--

LOCK TABLES `phpbb_pa_download_info` WRITE;
/*!40000 ALTER TABLE `phpbb_pa_download_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_pa_download_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_pa_files`
--

DROP TABLE IF EXISTS `phpbb_pa_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_pa_files` (
  `file_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `poster_ip` varchar(8) NOT NULL DEFAULT '',
  `file_name` text,
  `file_size` int(20) NOT NULL DEFAULT '0',
  `unique_name` varchar(255) NOT NULL DEFAULT '',
  `real_name` varchar(255) NOT NULL,
  `file_dir` varchar(255) NOT NULL,
  `file_desc` text,
  `file_creator` text,
  `file_version` text,
  `file_longdesc` text,
  `file_ssurl` text,
  `file_sshot_link` tinyint(2) NOT NULL DEFAULT '0',
  `file_dlurl` text,
  `file_time` int(50) DEFAULT NULL,
  `file_update_time` int(50) NOT NULL DEFAULT '0',
  `file_catid` int(10) DEFAULT NULL,
  `file_posticon` text,
  `file_license` int(10) DEFAULT NULL,
  `file_dls` int(10) DEFAULT NULL,
  `file_last` int(50) DEFAULT NULL,
  `file_pin` int(2) DEFAULT NULL,
  `file_docsurl` text,
  `file_approved` tinyint(1) NOT NULL DEFAULT '1',
  `file_broken` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_pa_files`
--

LOCK TABLES `phpbb_pa_files` WRITE;
/*!40000 ALTER TABLE `phpbb_pa_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_pa_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_pa_license`
--

DROP TABLE IF EXISTS `phpbb_pa_license`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_pa_license` (
  `license_id` int(10) NOT NULL AUTO_INCREMENT,
  `license_name` text,
  `license_text` text,
  PRIMARY KEY (`license_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_pa_license`
--

LOCK TABLES `phpbb_pa_license` WRITE;
/*!40000 ALTER TABLE `phpbb_pa_license` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_pa_license` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_pa_mirrors`
--

DROP TABLE IF EXISTS `phpbb_pa_mirrors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_pa_mirrors` (
  `mirror_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `file_id` int(10) NOT NULL,
  `unique_name` varchar(255) NOT NULL DEFAULT '',
  `file_dir` varchar(255) NOT NULL,
  `file_dlurl` varchar(255) NOT NULL DEFAULT '',
  `mirror_location` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`mirror_id`),
  KEY `file_id` (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_pa_mirrors`
--

LOCK TABLES `phpbb_pa_mirrors` WRITE;
/*!40000 ALTER TABLE `phpbb_pa_mirrors` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_pa_mirrors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_pa_votes`
--

DROP TABLE IF EXISTS `phpbb_pa_votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_pa_votes` (
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `votes_ip` varchar(50) NOT NULL DEFAULT '0',
  `votes_file` int(50) NOT NULL DEFAULT '0',
  `rate_point` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `voter_os` varchar(255) NOT NULL DEFAULT '',
  `voter_browser` varchar(255) NOT NULL DEFAULT '',
  `browser_version` varchar(8) NOT NULL DEFAULT '',
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_pa_votes`
--

LOCK TABLES `phpbb_pa_votes` WRITE;
/*!40000 ALTER TABLE `phpbb_pa_votes` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_pa_votes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_phpBBSecurity`
--

DROP TABLE IF EXISTS `phpbb_phpBBSecurity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_phpBBSecurity` (
  `ban_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `ban_ip` varchar(15) NOT NULL DEFAULT '',
  `ban_reason` varchar(50) NOT NULL DEFAULT '0',
  `ban_date` int(10) NOT NULL DEFAULT '0',
  `ban_attempts` int(10) NOT NULL DEFAULT '0',
  `ban_link` text NOT NULL,
  PRIMARY KEY (`ban_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_phpBBSecurity`
--

LOCK TABLES `phpbb_phpBBSecurity` WRITE;
/*!40000 ALTER TABLE `phpbb_phpBBSecurity` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_phpBBSecurity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_portal_config`
--

DROP TABLE IF EXISTS `phpbb_portal_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_portal_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_portal_config`
--

LOCK TABLES `phpbb_portal_config` WRITE;
/*!40000 ALTER TABLE `phpbb_portal_config` DISABLE KEYS */;
INSERT INTO `phpbb_portal_config` VALUES (1,'md_num_news','5'),(2,'md_news_length','250'),(3,'md_news_forum_id','1'),(4,'md_ran_att_height','200'),(5,'md_ran_att_width','200'),(6,'md_ran_att_max','3'),(7,'md_ran_att_forums_incl',''),(8,'md_ran_att_forums_excl',''),(9,'md_cat_id','0'),(10,'md_pics_number','2'),(11,'md_pics_sort','0'),(12,'md_pics_all','1'),(13,'md_num_announcements','5'),(14,'md_announcements_length','250'),(15,'md_announcements_forum_id','1'),(16,'md_poll_forum_id','1'),(17,'md_poll_bar_length','65'),(18,'md_num_top_downloads','10'),(19,'md_num_new_downloads','10'),(20,'md_display_not_visit','1'),(21,'md_hours_track_users','24'),(22,'md_scroll_delay','100'),(23,'header_width','140'),(24,'footer_width','140'),(25,'md_cache_file_locking','1'),(26,'md_cache_write_control','1'),(27,'md_cache_read_control','1'),(28,'md_cache_read_type','md5'),(29,'md_cache_filename_protect','0'),(30,'md_cache_serialize','1'),(31,'md_num_new_donations','10'),(32,'cm_total_articles','5'),(33,'md_links_style','1'),(34,'md_links_own1','1'),(35,'md_links_own2','1'),(36,'md_links_code','1'),(37,'md_num_referers','10'),(38,'md_sort_referers','referer_hits DESC'),(39,'md_num_recent_topics','10'),(40,'md_approve_mod_installed','0'),(41,'md_recent_topics_style','1'),(42,'md_cat_id2','0'),(43,'md_pics_number2','2'),(44,'md_pics_sort2','0'),(45,'md_pics_all2','0'),(46,'md_search_option_text','IM Portal'),(47,'default_portal','1'),(48,'cache_enabled','1'),(49,'portal_header','1'),(50,'portal_tail','0');
/*!40000 ALTER TABLE `phpbb_portal_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_posts`
--

DROP TABLE IF EXISTS `phpbb_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_posts` (
  `post_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `poster_id` mediumint(8) NOT NULL DEFAULT '0',
  `post_time` int(11) NOT NULL DEFAULT '0',
  `poster_ip` varchar(8) NOT NULL DEFAULT '',
  `post_username` varchar(25) DEFAULT NULL,
  `enable_bbcode` tinyint(1) NOT NULL DEFAULT '1',
  `enable_html` tinyint(1) NOT NULL DEFAULT '0',
  `enable_smilies` tinyint(1) NOT NULL DEFAULT '1',
  `enable_sig` tinyint(1) NOT NULL DEFAULT '1',
  `post_edit_time` int(11) DEFAULT NULL,
  `post_edit_count` smallint(5) unsigned NOT NULL DEFAULT '0',
  `post_attachment` tinyint(1) NOT NULL DEFAULT '0',
  `post_icon` tinyint(2) DEFAULT NULL,
  `post_bluecard` tinyint(1) DEFAULT NULL,
  `rating_rank_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_id` (`poster_id`),
  KEY `post_time` (`post_time`),
  KEY `post_icon` (`post_icon`),
  KEY `posts_ratingrankid` (`rating_rank_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_posts`
--

LOCK TABLES `phpbb_posts` WRITE;
/*!40000 ALTER TABLE `phpbb_posts` DISABLE KEYS */;
INSERT INTO `phpbb_posts` VALUES (1,1,1,2,1334688207,'7F000001',NULL,1,0,1,1,NULL,0,0,NULL,NULL,0);
/*!40000 ALTER TABLE `phpbb_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_posts_text`
--

DROP TABLE IF EXISTS `phpbb_posts_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_posts_text` (
  `post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `bbcode_uid` varchar(10) NOT NULL DEFAULT '',
  `post_subject` varchar(60) DEFAULT NULL,
  `post_text` text,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_posts_text`
--

LOCK TABLES `phpbb_posts_text` WRITE;
/*!40000 ALTER TABLE `phpbb_posts_text` DISABLE KEYS */;
INSERT INTO `phpbb_posts_text` VALUES (1,'8e8de0c186','Welcome to IntegraMOD 1.4.1 :)','Welcome [you]! This is an example post in your [google]IntegraMOD[/google] installation. You may delete this post, this topic and even this forum if you like since everything seems to be working!');
/*!40000 ALTER TABLE `phpbb_posts_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_privmsgs`
--

DROP TABLE IF EXISTS `phpbb_privmsgs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_privmsgs` (
  `privmsgs_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `privmsgs_type` tinyint(4) NOT NULL DEFAULT '0',
  `privmsgs_subject` varchar(255) NOT NULL DEFAULT '0',
  `privmsgs_from_userid` mediumint(8) NOT NULL DEFAULT '0',
  `privmsgs_to_userid` mediumint(8) NOT NULL DEFAULT '0',
  `privmsgs_date` int(11) NOT NULL DEFAULT '0',
  `privmsgs_ip` varchar(8) NOT NULL DEFAULT '',
  `privmsgs_enable_bbcode` tinyint(1) NOT NULL DEFAULT '1',
  `privmsgs_enable_html` tinyint(1) NOT NULL DEFAULT '0',
  `privmsgs_enable_smilies` tinyint(1) NOT NULL DEFAULT '1',
  `privmsgs_attach_sig` tinyint(1) NOT NULL DEFAULT '1',
  `privmsgs_attachment` tinyint(1) NOT NULL DEFAULT '0',
  `privmsgs_from_username` varchar(25) NOT NULL DEFAULT '',
  `privmsgs_to_username` varchar(25) NOT NULL DEFAULT '',
  `site_id` mediumint(8) NOT NULL DEFAULT '0',
  `room_id` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`privmsgs_id`),
  KEY `privmsgs_from_userid` (`privmsgs_from_userid`),
  KEY `privmsgs_to_userid` (`privmsgs_to_userid`),
  KEY `room_id` (`room_id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_privmsgs`
--

LOCK TABLES `phpbb_privmsgs` WRITE;
/*!40000 ALTER TABLE `phpbb_privmsgs` DISABLE KEYS */;
INSERT INTO `phpbb_privmsgs` VALUES (1,5,'phpBB Security Update',2,2,1334800233,'42f94442',1,1,1,1,0,'','',0,0),(2,1,'phpBB Security Update',2,2,1334978149,'42f94442',1,1,1,1,0,'','',0,0),(3,1,'phpBB Security Update',2,2,1335059629,'42f94442',1,1,1,1,0,'','',0,0);
/*!40000 ALTER TABLE `phpbb_privmsgs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_privmsgs_archive`
--

DROP TABLE IF EXISTS `phpbb_privmsgs_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_privmsgs_archive` (
  `privmsgs_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `privmsgs_type` tinyint(4) NOT NULL DEFAULT '0',
  `privmsgs_subject` varchar(255) NOT NULL DEFAULT '0',
  `privmsgs_from_userid` mediumint(8) NOT NULL DEFAULT '0',
  `privmsgs_to_userid` mediumint(8) NOT NULL DEFAULT '0',
  `privmsgs_date` int(11) NOT NULL DEFAULT '0',
  `privmsgs_ip` varchar(8) NOT NULL DEFAULT '',
  `privmsgs_enable_bbcode` tinyint(1) NOT NULL DEFAULT '1',
  `privmsgs_enable_html` tinyint(1) NOT NULL DEFAULT '0',
  `privmsgs_enable_smilies` tinyint(1) NOT NULL DEFAULT '1',
  `privmsgs_attach_sig` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`privmsgs_id`),
  KEY `privmsgs_from_userid` (`privmsgs_from_userid`),
  KEY `privmsgs_to_userid` (`privmsgs_to_userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_privmsgs_archive`
--

LOCK TABLES `phpbb_privmsgs_archive` WRITE;
/*!40000 ALTER TABLE `phpbb_privmsgs_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_privmsgs_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_privmsgs_text`
--

DROP TABLE IF EXISTS `phpbb_privmsgs_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_privmsgs_text` (
  `privmsgs_text_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `privmsgs_bbcode_uid` varchar(10) NOT NULL DEFAULT '0',
  `privmsgs_text` text,
  PRIMARY KEY (`privmsgs_text_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_privmsgs_text`
--

LOCK TABLES `phpbb_privmsgs_text` WRITE;
/*!40000 ALTER TABLE `phpbb_privmsgs_text` DISABLE KEYS */;
INSERT INTO `phpbb_privmsgs_text` VALUES (1,'e51b668ff2','Your Daily Database Backup Was Completed.'),(2,'6a2e143731','Your Daily Database Backup Was Completed.'),(3,'5d83313670','Your Daily Database Backup Was Completed.');
/*!40000 ALTER TABLE `phpbb_privmsgs_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_quota_limits`
--

DROP TABLE IF EXISTS `phpbb_quota_limits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_quota_limits` (
  `quota_limit_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `quota_desc` varchar(20) NOT NULL DEFAULT '',
  `quota_limit` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`quota_limit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_quota_limits`
--

LOCK TABLES `phpbb_quota_limits` WRITE;
/*!40000 ALTER TABLE `phpbb_quota_limits` DISABLE KEYS */;
INSERT INTO `phpbb_quota_limits` VALUES (1,'Low',262144),(2,'Medium',2097152),(3,'High',5242880);
/*!40000 ALTER TABLE `phpbb_quota_limits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_ranks`
--

DROP TABLE IF EXISTS `phpbb_ranks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_ranks` (
  `rank_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `rank_title` varchar(255) NOT NULL DEFAULT '',
  `rank_min` mediumint(8) NOT NULL DEFAULT '0',
  `rank_max` mediumint(8) NOT NULL DEFAULT '0',
  `rank_special` tinyint(1) DEFAULT '0',
  `rank_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`rank_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_ranks`
--

LOCK TABLES `phpbb_ranks` WRITE;
/*!40000 ALTER TABLE `phpbb_ranks` DISABLE KEYS */;
INSERT INTO `phpbb_ranks` VALUES (1,'Site Admin',-1,0,1,NULL);
/*!40000 ALTER TABLE `phpbb_ranks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_rating`
--

DROP TABLE IF EXISTS `phpbb_rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_rating` (
  `post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `rating_time` int(10) unsigned NOT NULL DEFAULT '0',
  `option_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  KEY `rating_postid` (`post_id`),
  KEY `rating_userid` (`user_id`),
  KEY `rating_ratingoptionid` (`option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_rating`
--

LOCK TABLES `phpbb_rating` WRITE;
/*!40000 ALTER TABLE `phpbb_rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_rating_bias`
--

DROP TABLE IF EXISTS `phpbb_rating_bias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_rating_bias` (
  `bias_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `target_user` int(10) unsigned NOT NULL DEFAULT '0',
  `bias_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `bias_time` int(10) unsigned NOT NULL DEFAULT '0',
  `post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `option_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`bias_id`),
  KEY `ratingbias_userid_targetuser` (`user_id`,`target_user`),
  KEY `ratingbias_targetuser` (`target_user`),
  KEY `ratingbias_postid` (`post_id`),
  KEY `ratingbias_optionid` (`option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_rating_bias`
--

LOCK TABLES `phpbb_rating_bias` WRITE;
/*!40000 ALTER TABLE `phpbb_rating_bias` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_rating_bias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_rating_config`
--

DROP TABLE IF EXISTS `phpbb_rating_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_rating_config` (
  `label` varchar(100) DEFAULT NULL,
  `num_value` int(10) unsigned NOT NULL DEFAULT '0',
  `text_value` varchar(255) DEFAULT NULL,
  `config_id` int(10) unsigned NOT NULL DEFAULT '0',
  `input_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `list_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_rating_config`
--

LOCK TABLES `phpbb_rating_config` WRITE;
/*!40000 ALTER TABLE `phpbb_rating_config` DISABLE KEYS */;
INSERT INTO `phpbb_rating_config` VALUES ('Rating system active',0,NULL,1,3,100),('Weighting method',1,NULL,3,3,300),('Users can change ratings',1,NULL,4,3,400),('Max daily ratings (0=unlimited)',10,NULL,5,2,500),('Show who rated',1,NULL,6,3,600),('Allow users to hide name',1,NULL,7,3,700),('Rate first post only',0,NULL,2,3,200),('Overall ranking method: posts',1,NULL,8,3,800),('Overall ranking method: topics',1,NULL,9,3,900),('Overall ranking method: users',1,NULL,10,3,1000),('Max daily ratings per user',1,NULL,13,2,550),('Open in new window',1,NULL,14,3,1400),('Min. post count',5,NULL,15,2,240),('Min. days registered',7,NULL,16,2,250),('Bias system active',1,NULL,11,3,1100),('Show bias usernames?',1,NULL,17,3,1150),('Show dropdown in viewtopic?',1,NULL,18,3,1800),('Show dropdown in viewforum?',0,NULL,19,3,1900);
/*!40000 ALTER TABLE `phpbb_rating_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_rating_option`
--

DROP TABLE IF EXISTS `phpbb_rating_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_rating_option` (
  `option_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `points` tinyint(4) NOT NULL DEFAULT '0',
  `label` varchar(100) DEFAULT NULL,
  `weighting` smallint(5) unsigned NOT NULL DEFAULT '0',
  `user_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`option_id`),
  KEY `ratingoption_rating` (`points`),
  KEY `ratingoption_weighting` (`weighting`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_rating_option`
--

LOCK TABLES `phpbb_rating_option` WRITE;
/*!40000 ALTER TABLE `phpbb_rating_option` DISABLE KEYS */;
INSERT INTO `phpbb_rating_option` VALUES (1,2,'Highly recommended',5,1),(2,1,'Recommended',0,1),(3,5,'Moderator-recommended',0,3);
/*!40000 ALTER TABLE `phpbb_rating_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_rating_rank`
--

DROP TABLE IF EXISTS `phpbb_rating_rank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_rating_rank` (
  `rating_rank_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `average_threshold` tinyint(4) NOT NULL DEFAULT '0',
  `sum_threshold` int(11) NOT NULL DEFAULT '0',
  `label` varchar(100) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `user_rank` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`rating_rank_id`),
  KEY `ratingrank_type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_rating_rank`
--

LOCK TABLES `phpbb_rating_rank` WRITE;
/*!40000 ALTER TABLE `phpbb_rating_rank` DISABLE KEYS */;
INSERT INTO `phpbb_rating_rank` VALUES (2,5,2,5,'Worth a look','2star_green.gif',0),(3,5,4,20,'Impressive','4star_green.gif',0),(6,5,1,1,'Acknowledged','1star_green.gif',0),(7,5,3,10,'Quality','3star_green.gif',0),(8,5,5,40,'Inspired','5star_green.gif',0),(11,4,1,2,'Acknowledged','1star_cyan.gif',0),(12,4,2,10,'Worth a look','2star_cyan.gif',0),(13,4,3,20,'Quality','3star_cyan.gif',0),(14,4,4,40,'Impressive','4star_cyan.gif',0),(15,4,5,80,'Inspired','5star_cyan.gif',0);
/*!40000 ALTER TABLE `phpbb_rating_rank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_rating_temp`
--

DROP TABLE IF EXISTS `phpbb_rating_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_rating_temp` (
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  `points` tinyint(4) NOT NULL DEFAULT '0',
  KEY `ratingtemp_topicid` (`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_rating_temp`
--

LOCK TABLES `phpbb_rating_temp` WRITE;
/*!40000 ALTER TABLE `phpbb_rating_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_rating_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_referers`
--

DROP TABLE IF EXISTS `phpbb_referers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_referers` (
  `referer_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `referer_host` varchar(255) NOT NULL DEFAULT '',
  `referer_url` varchar(255) NOT NULL DEFAULT '',
  `referer_ip` varchar(8) NOT NULL DEFAULT '',
  `referer_hits` int(10) NOT NULL DEFAULT '1',
  `referer_firstvisit` int(11) NOT NULL DEFAULT '0',
  `referer_lastvisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`referer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_referers`
--

LOCK TABLES `phpbb_referers` WRITE;
/*!40000 ALTER TABLE `phpbb_referers` DISABLE KEYS */;
INSERT INTO `phpbb_referers` VALUES (1,'www.integramod.com','http://www.integramod.com/index.php','52c16df8',2,1334815129,1334815141),(2,'www.integramod.com','http://www.integramod.com/viewforum.php?f=1','52c16df8',1,1334815130,1334815130),(3,'www.integramod.com','http://www.integramod.com/posting.php?mode=newtopic&f=1','52c16df8',2,1334815132,1334815137);
/*!40000 ALTER TABLE `phpbb_referers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_rules`
--

DROP TABLE IF EXISTS `phpbb_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_rules` (
  `date` int(11) NOT NULL DEFAULT '0',
  `rules` text NOT NULL,
  `pm_subject` varchar(255) NOT NULL DEFAULT '',
  `pm_message` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_rules`
--

LOCK TABLES `phpbb_rules` WRITE;
/*!40000 ALTER TABLE `phpbb_rules` DISABLE KEYS */;
INSERT INTO `phpbb_rules` VALUES (1088516758,'While the administrators and moderators of this forum will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every message. Therefore you acknowledge that all posts made to these forums express the views and opinions of the author and not the administrators, moderators or webmaster (except for posts by these people) and hence will not be held liable.\r\n<br /><br />\r\nYou agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-oriented or any other material that may violate any applicable laws. Doing so may lead to you being immediately and permanently banned (and your service provider being informed). The IP address of all posts is recorded to aid in enforcing these conditions. You agree that the webmaster, administrator and moderators of this forum have the right to remove, edit, move or close any topic at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent, the webmaster, administrator and moderators cannot be held responsible for any hacking attempt that may lead to the data being compromised.\r\n<br /><br />\r\nThis forum system uses cookies to store information on your local computer. These cookies do not contain any of the information you have entered above; they serve only to improve your viewing pleasure. The e-mail address is used only for confirming your registration details and password (and for sending new passwords should you forget your current one).','Attention the Rules has been updated.','The Rules on this Forum has been updated for so much we invite you to read again it.  \r\n  \r\nThe Administrator');
/*!40000 ALTER TABLE `phpbb_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_search_results`
--

DROP TABLE IF EXISTS `phpbb_search_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_search_results` (
  `search_id` int(11) unsigned NOT NULL DEFAULT '0',
  `session_id` varchar(32) NOT NULL DEFAULT '',
  `search_array` mediumtext NOT NULL,
  `search_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`search_id`),
  KEY `session_id` (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_search_results`
--

LOCK TABLES `phpbb_search_results` WRITE;
/*!40000 ALTER TABLE `phpbb_search_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_search_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_search_wordlist`
--

DROP TABLE IF EXISTS `phpbb_search_wordlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_search_wordlist` (
  `word_text` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `word_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `word_common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`word_text`),
  KEY `word_id` (`word_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_search_wordlist`
--

LOCK TABLES `phpbb_search_wordlist` WRITE;
/*!40000 ALTER TABLE `phpbb_search_wordlist` DISABLE KEYS */;
INSERT INTO `phpbb_search_wordlist` VALUES ('example',1,0),('post',2,0),('phpbb',3,0),('installation',4,0),('delete',5,0),('topic',6,0),('forum',7,0),('since',8,0),('everything',9,0),('seems',10,0),('working',11,0),('welcome',12,0);
/*!40000 ALTER TABLE `phpbb_search_wordlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_search_wordmatch`
--

DROP TABLE IF EXISTS `phpbb_search_wordmatch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_search_wordmatch` (
  `post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `word_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title_match` tinyint(1) NOT NULL DEFAULT '0',
  KEY `post_id` (`post_id`),
  KEY `word_id` (`word_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_search_wordmatch`
--

LOCK TABLES `phpbb_search_wordmatch` WRITE;
/*!40000 ALTER TABLE `phpbb_search_wordmatch` DISABLE KEYS */;
INSERT INTO `phpbb_search_wordmatch` VALUES (1,1,0),(1,2,0),(1,3,0),(1,4,0),(1,5,0),(1,6,0),(1,7,0),(1,8,0),(1,9,0),(1,10,0),(1,11,0),(1,12,1),(1,3,1);
/*!40000 ALTER TABLE `phpbb_search_wordmatch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_serverload`
--

DROP TABLE IF EXISTS `phpbb_serverload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_serverload` (
  `time` int(14) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_serverload`
--

LOCK TABLES `phpbb_serverload` WRITE;
/*!40000 ALTER TABLE `phpbb_serverload` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_serverload` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_sessions`
--

DROP TABLE IF EXISTS `phpbb_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_sessions` (
  `session_id` varchar(32) NOT NULL DEFAULT '',
  `session_user_id` mediumint(8) NOT NULL DEFAULT '0',
  `session_start` int(11) NOT NULL DEFAULT '0',
  `session_time` int(11) NOT NULL DEFAULT '0',
  `session_ip` varchar(8) NOT NULL DEFAULT '0',
  `session_page` int(11) NOT NULL DEFAULT '0',
  `session_logged_in` tinyint(1) NOT NULL DEFAULT '0',
  `session_robot` varchar(32) DEFAULT NULL,
  `session_admin` tinyint(2) NOT NULL DEFAULT '0',
  `priv_session_id` char(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`session_id`),
  KEY `session_user_id` (`session_user_id`),
  KEY `session_id_ip_user_id` (`session_id`,`session_ip`,`session_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_sessions`
--

LOCK TABLES `phpbb_sessions` WRITE;
/*!40000 ALTER TABLE `phpbb_sessions` DISABLE KEYS */;
INSERT INTO `phpbb_sessions` VALUES ('494a2df12b48a1e8fdca8ae0e7bfb752',-1,1334703544,1335146963,'42f94442',-2,0,NULL,0,'a4bd6d230b0308f197f8e617af7916e9'),('fea597e6d6f0a3d1595f6011867a42ee',2,1335135623,1335136793,'322e8796',0,1,NULL,1,'81b88c2b843185e43cd17c40929aa3db');
/*!40000 ALTER TABLE `phpbb_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_sessions_keys`
--

DROP TABLE IF EXISTS `phpbb_sessions_keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_sessions_keys` (
  `key_id` varchar(32) NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `last_ip` varchar(8) NOT NULL DEFAULT '0',
  `last_login` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`key_id`,`user_id`),
  KEY `last_login` (`last_login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_sessions_keys`
--

LOCK TABLES `phpbb_sessions_keys` WRITE;
/*!40000 ALTER TABLE `phpbb_sessions_keys` DISABLE KEYS */;
INSERT INTO `phpbb_sessions_keys` VALUES ('cea5aec725ff4a9e0c30f13e3f42b396',2,'322e8796',1335135623);
/*!40000 ALTER TABLE `phpbb_sessions_keys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_shout`
--

DROP TABLE IF EXISTS `phpbb_shout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_shout` (
  `shout_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `shout_username` varchar(25) NOT NULL DEFAULT '',
  `shout_user_id` mediumint(8) NOT NULL DEFAULT '0',
  `shout_group_id` mediumint(8) NOT NULL DEFAULT '0',
  `shout_session_time` int(11) NOT NULL DEFAULT '0',
  `shout_ip` varchar(8) NOT NULL DEFAULT '',
  `shout_text` text NOT NULL,
  `shout_active` mediumint(8) NOT NULL DEFAULT '0',
  `enable_bbcode` tinyint(1) NOT NULL DEFAULT '0',
  `enable_html` tinyint(1) NOT NULL DEFAULT '0',
  `enable_smilies` tinyint(1) NOT NULL DEFAULT '0',
  `enable_sig` tinyint(1) NOT NULL DEFAULT '0',
  `shout_bbcode_uid` varchar(10) NOT NULL DEFAULT '',
  KEY `shout_id` (`shout_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_shout`
--

LOCK TABLES `phpbb_shout` WRITE;
/*!40000 ALTER TABLE `phpbb_shout` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_shout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_smilies`
--

DROP TABLE IF EXISTS `phpbb_smilies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_smilies` (
  `smilies_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `smile_url` varchar(100) DEFAULT NULL,
  `emoticon` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`smilies_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_smilies`
--

LOCK TABLES `phpbb_smilies` WRITE;
/*!40000 ALTER TABLE `phpbb_smilies` DISABLE KEYS */;
INSERT INTO `phpbb_smilies` VALUES (1,':D','icon_biggrin.gif','Very Happy'),(2,':-D','icon_biggrin.gif','Very Happy'),(3,':grin:','icon_biggrin.gif','Very Happy'),(4,':)','icon_smile.gif','Smile'),(5,':-)','icon_smile.gif','Smile'),(6,':smile:','icon_smile.gif','Smile'),(7,':(','icon_sad.gif','Sad'),(8,':-(','icon_sad.gif','Sad'),(9,':sad:','icon_sad.gif','Sad'),(10,':o','icon_surprised.gif','Surprised'),(11,':-o','icon_surprised.gif','Surprised'),(12,':eek:','icon_surprised.gif','Surprised'),(13,':shock:','icon_eek.gif','Shocked'),(14,':?','icon_confused.gif','Confused'),(15,':-?','icon_confused.gif','Confused'),(16,':???:','icon_confused.gif','Confused'),(17,'8)','icon_cool.gif','Cool'),(18,'8-)','icon_cool.gif','Cool'),(19,':cool:','icon_cool.gif','Cool'),(20,':lol:','icon_lol.gif','Laughing'),(21,':x','icon_mad.gif','Mad'),(22,':-x','icon_mad.gif','Mad'),(23,':mad:','icon_mad.gif','Mad'),(24,':P','icon_razz.gif','Razz'),(25,':-P','icon_razz.gif','Razz'),(26,':razz:','icon_razz.gif','Razz'),(27,':oops:','icon_redface.gif','Embarassed'),(28,':cry:','icon_cry.gif','Crying or Very sad'),(29,':evil:','icon_evil.gif','Evil or Very Mad'),(30,':twisted:','icon_twisted.gif','Twisted Evil'),(31,':roll:','icon_rolleyes.gif','Rolling Eyes'),(32,':wink:','icon_wink.gif','Wink'),(33,';)','icon_wink.gif','Wink'),(34,';-)','icon_wink.gif','Wink'),(35,':!:','icon_exclaim.gif','Exclamation'),(36,':?:','icon_question.gif','Question'),(37,':idea:','icon_idea.gif','Idea'),(38,':arrow:','icon_arrow.gif','Arrow'),(39,':|','icon_neutral.gif','Neutral'),(40,':-|','icon_neutral.gif','Neutral'),(41,':neutral:','icon_neutral.gif','Neutral'),(42,':mrgreen:','icon_mrgreen.gif','Mr. Green');
/*!40000 ALTER TABLE `phpbb_smilies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_stats_config`
--

DROP TABLE IF EXISTS `phpbb_stats_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_stats_config` (
  `config_name` varchar(100) NOT NULL DEFAULT '',
  `config_value` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_stats_config`
--

LOCK TABLES `phpbb_stats_config` WRITE;
/*!40000 ALTER TABLE `phpbb_stats_config` DISABLE KEYS */;
INSERT INTO `phpbb_stats_config` VALUES ('install_date','2012-04-17'),('return_limit','10'),('version','3.0.0'),('page_views','0');
/*!40000 ALTER TABLE `phpbb_stats_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_stats_smilies_index`
--

DROP TABLE IF EXISTS `phpbb_stats_smilies_index`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_stats_smilies_index` (
  `code` varchar(50) DEFAULT NULL,
  `smile_url` varchar(100) DEFAULT NULL,
  `smile_count` mediumint(8) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_stats_smilies_index`
--

LOCK TABLES `phpbb_stats_smilies_index` WRITE;
/*!40000 ALTER TABLE `phpbb_stats_smilies_index` DISABLE KEYS */;
INSERT INTO `phpbb_stats_smilies_index` VALUES (':arrow:','icon_arrow.gif',1),(':D','icon_biggrin.gif',1),(':?','icon_confused.gif',0),('8)','icon_cool.gif',1),(':cry:','icon_cry.gif',8),(':shock:','icon_eek.gif',0),(':evil:','icon_evil.gif',0),(':!:','icon_exclaim.gif',1),(':idea:','icon_idea.gif',1),(':lol:','icon_lol.gif',20),(':x','icon_mad.gif',0),(':mrgreen:','icon_mrgreen.gif',0),(':|','icon_neutral.gif',0),(':?:','icon_question.gif',0),(':P','icon_razz.gif',0),(':oops:','icon_redface.gif',2),(':roll:','icon_rolleyes.gif',2),(':(','icon_sad.gif',0),(':)','icon_smile.gif',0),(':o','icon_surprised.gif',5),(':twisted:','icon_twisted.gif',0),(':wink:','icon_wink.gif',3);
/*!40000 ALTER TABLE `phpbb_stats_smilies_index` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_stats_smilies_info`
--

DROP TABLE IF EXISTS `phpbb_stats_smilies_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_stats_smilies_info` (
  `last_post_id` mediumint(8) NOT NULL DEFAULT '0',
  `last_update_time` int(12) NOT NULL DEFAULT '0',
  `update_time` mediumint(8) NOT NULL DEFAULT '10080'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_stats_smilies_info`
--

LOCK TABLES `phpbb_stats_smilies_info` WRITE;
/*!40000 ALTER TABLE `phpbb_stats_smilies_info` DISABLE KEYS */;
INSERT INTO `phpbb_stats_smilies_info` VALUES (0,1334688207,8388607);
/*!40000 ALTER TABLE `phpbb_stats_smilies_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_themes`
--

DROP TABLE IF EXISTS `phpbb_themes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_themes` (
  `themes_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `template_name` varchar(30) NOT NULL DEFAULT '',
  `style_name` varchar(30) NOT NULL DEFAULT '',
  `head_stylesheet` varchar(100) DEFAULT NULL,
  `body_background` varchar(100) DEFAULT NULL,
  `body_bgcolor` varchar(6) DEFAULT NULL,
  `body_text` varchar(6) DEFAULT NULL,
  `body_link` varchar(6) DEFAULT NULL,
  `body_vlink` varchar(6) DEFAULT NULL,
  `body_alink` varchar(6) DEFAULT NULL,
  `body_hlink` varchar(6) DEFAULT NULL,
  `tr_color1` varchar(6) DEFAULT NULL,
  `tr_color2` varchar(6) DEFAULT NULL,
  `tr_color3` varchar(6) DEFAULT NULL,
  `tr_class1` varchar(25) DEFAULT NULL,
  `tr_class2` varchar(25) DEFAULT NULL,
  `tr_class3` varchar(25) DEFAULT NULL,
  `th_color1` varchar(6) DEFAULT NULL,
  `th_color2` varchar(6) DEFAULT NULL,
  `th_color3` varchar(6) DEFAULT NULL,
  `th_class1` varchar(25) DEFAULT NULL,
  `th_class2` varchar(25) DEFAULT NULL,
  `th_class3` varchar(25) DEFAULT NULL,
  `td_color1` varchar(6) DEFAULT NULL,
  `td_color2` varchar(6) DEFAULT NULL,
  `td_color3` varchar(6) DEFAULT NULL,
  `td_class1` varchar(25) DEFAULT NULL,
  `td_class2` varchar(25) DEFAULT NULL,
  `td_class3` varchar(25) DEFAULT NULL,
  `fontface1` varchar(50) DEFAULT NULL,
  `fontface2` varchar(50) DEFAULT NULL,
  `fontface3` varchar(50) DEFAULT NULL,
  `fontsize1` tinyint(4) DEFAULT NULL,
  `fontsize2` tinyint(4) DEFAULT NULL,
  `fontsize3` tinyint(4) DEFAULT NULL,
  `fontcolor1` varchar(6) DEFAULT NULL,
  `fontcolor2` varchar(6) DEFAULT NULL,
  `fontcolor3` varchar(6) DEFAULT NULL,
  `span_class1` varchar(25) DEFAULT NULL,
  `span_class2` varchar(25) DEFAULT NULL,
  `span_class3` varchar(25) DEFAULT NULL,
  `img_size_poll` smallint(5) unsigned DEFAULT NULL,
  `img_size_privmsg` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`themes_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_themes`
--

LOCK TABLES `phpbb_themes` WRITE;
/*!40000 ALTER TABLE `phpbb_themes` DISABLE KEYS */;
INSERT INTO `phpbb_themes` VALUES (1,'Default','Default','stylesheet.css','','','','','','','','','','','','','','','','','','','','','','','row1','row2','','','','',0,0,0,'','006600','ff0000','','','',0,0),(2,'prosilver','prosilver','prosilver.css','','','','','','','','','','','','','','','','','','','','','','','bg2','bg1','','','','',0,0,0,'','00AA00','AA0000','','','',0,0);
/*!40000 ALTER TABLE `phpbb_themes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_themes_name`
--

DROP TABLE IF EXISTS `phpbb_themes_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_themes_name` (
  `themes_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tr_color1_name` char(50) DEFAULT NULL,
  `tr_color2_name` char(50) DEFAULT NULL,
  `tr_color3_name` char(50) DEFAULT NULL,
  `tr_class1_name` char(50) DEFAULT NULL,
  `tr_class2_name` char(50) DEFAULT NULL,
  `tr_class3_name` char(50) DEFAULT NULL,
  `th_color1_name` char(50) DEFAULT NULL,
  `th_color2_name` char(50) DEFAULT NULL,
  `th_color3_name` char(50) DEFAULT NULL,
  `th_class1_name` char(50) DEFAULT NULL,
  `th_class2_name` char(50) DEFAULT NULL,
  `th_class3_name` char(50) DEFAULT NULL,
  `td_color1_name` char(50) DEFAULT NULL,
  `td_color2_name` char(50) DEFAULT NULL,
  `td_color3_name` char(50) DEFAULT NULL,
  `td_class1_name` char(50) DEFAULT NULL,
  `td_class2_name` char(50) DEFAULT NULL,
  `td_class3_name` char(50) DEFAULT NULL,
  `fontface1_name` char(50) DEFAULT NULL,
  `fontface2_name` char(50) DEFAULT NULL,
  `fontface3_name` char(50) DEFAULT NULL,
  `fontsize1_name` char(50) DEFAULT NULL,
  `fontsize2_name` char(50) DEFAULT NULL,
  `fontsize3_name` char(50) DEFAULT NULL,
  `fontcolor1_name` char(50) DEFAULT NULL,
  `fontcolor2_name` char(50) DEFAULT NULL,
  `fontcolor3_name` char(50) DEFAULT NULL,
  `span_class1_name` char(50) DEFAULT NULL,
  `span_class2_name` char(50) DEFAULT NULL,
  `span_class3_name` char(50) DEFAULT NULL,
  PRIMARY KEY (`themes_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_themes_name`
--

LOCK TABLES `phpbb_themes_name` WRITE;
/*!40000 ALTER TABLE `phpbb_themes_name` DISABLE KEYS */;
INSERT INTO `phpbb_themes_name` VALUES (1,'The lightest row colour','The medium row color','The darkest row colour','','','','Border round the whole page','Outer table border','Inner table border','Silver gradient picture','Blue gradient picture','Fade-out gradient on index','Background for quote boxes','All white areas','','Background for topic posts','2nd background for topic posts','','Main fonts','Additional topic title font','Form fonts','Smallest font size','Medium font size','Normal font size (post body etc)','Quote & copyright text','Code text colour','Main table header text colour','','','');
/*!40000 ALTER TABLE `phpbb_themes_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_themes_select_info`
--

DROP TABLE IF EXISTS `phpbb_themes_select_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_themes_select_info` (
  `themes_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `style_author` varchar(50) NOT NULL DEFAULT '',
  `style_version` varchar(10) NOT NULL DEFAULT '',
  `style_date` date NOT NULL DEFAULT '0000-00-00',
  `style_website` varchar(100) NOT NULL DEFAULT '',
  `style_views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `style_dlurl` varchar(100) NOT NULL DEFAULT '',
  `style_dls` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `style_loaclurl` varchar(100) NOT NULL DEFAULT '',
  `style_ludls` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`themes_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_themes_select_info`
--

LOCK TABLES `phpbb_themes_select_info` WRITE;
/*!40000 ALTER TABLE `phpbb_themes_select_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_themes_select_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_topics`
--

DROP TABLE IF EXISTS `phpbb_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_topics` (
  `topic_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `forum_id` smallint(8) unsigned NOT NULL DEFAULT '0',
  `topic_title` varchar(60) NOT NULL DEFAULT '',
  `topic_desc` varchar(255) DEFAULT '',
  `topic_poster` mediumint(8) NOT NULL DEFAULT '0',
  `topic_time` int(11) NOT NULL DEFAULT '0',
  `topic_views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_status` tinyint(3) NOT NULL DEFAULT '0',
  `topic_info` varchar(20) DEFAULT NULL,
  `topic_vote` tinyint(1) NOT NULL DEFAULT '0',
  `topic_type` tinyint(3) NOT NULL DEFAULT '0',
  `topic_first_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_last_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_moved_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_attachment` tinyint(1) NOT NULL DEFAULT '0',
  `news_id` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_announce_duration` mediumint(5) NOT NULL DEFAULT '0',
  `topic_calendar_time` int(11) DEFAULT NULL,
  `topic_calendar_duration` int(11) DEFAULT NULL,
  `topic_icon` tinyint(2) DEFAULT NULL,
  `topic_calendar_repeat` varchar(4) DEFAULT NULL,
  `rating_rank_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_moved_id` (`topic_moved_id`),
  KEY `topic_status` (`topic_status`),
  KEY `topic_type` (`topic_type`),
  KEY `news_id` (`news_id`),
  KEY `topic_calendar_time` (`topic_calendar_time`),
  KEY `topics_ratingrankid` (`rating_rank_id`),
  KEY `topic_first_post_id` (`topic_first_post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_topics`
--

LOCK TABLES `phpbb_topics` WRITE;
/*!40000 ALTER TABLE `phpbb_topics` DISABLE KEYS */;
INSERT INTO `phpbb_topics` VALUES (1,1,'Welcome to IntegraMOD 1.4.1 :)','',2,1334688207,2,0,0,NULL,0,0,1,1,0,0,0,0,NULL,NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `phpbb_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_topics_watch`
--

DROP TABLE IF EXISTS `phpbb_topics_watch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_topics_watch` (
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `notify_status` tinyint(1) NOT NULL DEFAULT '0',
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  KEY `notify_status` (`notify_status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_topics_watch`
--

LOCK TABLES `phpbb_topics_watch` WRITE;
/*!40000 ALTER TABLE `phpbb_topics_watch` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_topics_watch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_user_group`
--

DROP TABLE IF EXISTS `phpbb_user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_user_group` (
  `group_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_pending` tinyint(1) DEFAULT NULL,
  `group_moderator` tinyint(1) NOT NULL DEFAULT '0',
  `ug_expire_date` int(11) DEFAULT '0',
  `ug_active_date` int(11) DEFAULT '0',
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_user_group`
--

LOCK TABLES `phpbb_user_group` WRITE;
/*!40000 ALTER TABLE `phpbb_user_group` DISABLE KEYS */;
INSERT INTO `phpbb_user_group` VALUES (1,-1,0,0,0,0),(2,2,0,0,0,0);
/*!40000 ALTER TABLE `phpbb_user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_users`
--

DROP TABLE IF EXISTS `phpbb_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_users` (
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_active` tinyint(1) DEFAULT '1',
  `username` varchar(25) NOT NULL DEFAULT '',
  `user_password` varchar(32) NOT NULL DEFAULT '',
  `user_session_time` int(11) NOT NULL DEFAULT '0',
  `user_session_page` smallint(5) NOT NULL DEFAULT '0',
  `user_lastvisit` int(11) NOT NULL DEFAULT '0',
  `user_regdate` int(11) NOT NULL DEFAULT '0',
  `user_level` tinyint(4) DEFAULT '0',
  `user_posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_timezone` decimal(5,2) NOT NULL DEFAULT '0.00',
  `user_style` tinyint(4) DEFAULT NULL,
  `user_lang` varchar(255) DEFAULT NULL,
  `user_dateformat` varchar(14) NOT NULL DEFAULT 'd M Y H:i',
  `user_new_privmsg` smallint(5) unsigned NOT NULL DEFAULT '0',
  `user_unread_privmsg` smallint(5) unsigned NOT NULL DEFAULT '0',
  `user_last_privmsg` int(11) NOT NULL DEFAULT '0',
  `user_login_tries` smallint(5) unsigned NOT NULL DEFAULT '0',
  `user_last_login_try` int(11) NOT NULL DEFAULT '0',
  `user_emailtime` int(11) DEFAULT NULL,
  `user_viewemail` tinyint(1) DEFAULT NULL,
  `user_attachsig` tinyint(1) DEFAULT NULL,
  `user_setbm` tinyint(1) NOT NULL DEFAULT '0',
  `user_allowhtml` tinyint(1) DEFAULT '1',
  `user_allowbbcode` tinyint(1) DEFAULT '1',
  `user_allowsmile` tinyint(1) DEFAULT '1',
  `user_allowavatar` tinyint(1) NOT NULL DEFAULT '1',
  `user_allowphoto` tinyint(1) NOT NULL DEFAULT '1',
  `user_allow_pm` tinyint(1) NOT NULL DEFAULT '1',
  `user_allow_viewonline` tinyint(1) NOT NULL DEFAULT '1',
  `user_notify` tinyint(1) NOT NULL DEFAULT '1',
  `user_notify_pm` tinyint(1) NOT NULL DEFAULT '0',
  `user_popup_pm` tinyint(1) NOT NULL DEFAULT '0',
  `user_rank` int(11) DEFAULT '0',
  `user_avatar` varchar(100) DEFAULT NULL,
  `user_avatar_type` tinyint(4) NOT NULL DEFAULT '0',
  `user_photo` varchar(100) DEFAULT NULL,
  `user_photo_type` tinyint(4) NOT NULL DEFAULT '0',
  `user_email` varchar(255) DEFAULT NULL,
  `user_icq` varchar(15) DEFAULT NULL,
  `user_website` varchar(100) DEFAULT NULL,
  `user_from` varchar(100) DEFAULT NULL,
  `user_sig` text,
  `user_sig_bbcode_uid` varchar(10) DEFAULT NULL,
  `user_aim` varchar(255) DEFAULT NULL,
  `user_yim` varchar(255) DEFAULT NULL,
  `user_msnm` varchar(255) DEFAULT NULL,
  `user_skype` varchar(255) DEFAULT NULL,
  `user_occ` varchar(100) DEFAULT NULL,
  `user_interests` varchar(255) DEFAULT NULL,
  `user_actkey` varchar(32) DEFAULT NULL,
  `user_newpasswd` varchar(32) DEFAULT NULL,
  `ct_search_time` int(11) DEFAULT '1',
  `ct_search_count` mediumint(8) DEFAULT '1',
  `ct_last_mail` int(11) DEFAULT '1',
  `ct_last_post` int(11) DEFAULT '1',
  `ct_post_counter` mediumint(8) DEFAULT '1',
  `ct_last_pw_reset` int(11) DEFAULT '1',
  `ct_enable_ip_warn` tinyint(1) DEFAULT '1',
  `ct_last_used_ip` varchar(16) DEFAULT '0.0.0.0',
  `ct_login_count` mediumint(8) DEFAULT '1',
  `ct_login_vconfirm` tinyint(1) DEFAULT '0',
  `ct_last_pw_change` int(11) DEFAULT '1',
  `ct_global_msg_read` tinyint(1) DEFAULT '0',
  `ct_miserable_user` tinyint(1) DEFAULT '0',
  `ct_last_ip` varchar(16) DEFAULT '0.0.0.0',
  `user_realname` varchar(25) NOT NULL DEFAULT '',
  `user_gender` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_birthday` varchar(8) NOT NULL DEFAULT '0',
  `user_last_birthday` int(11) unsigned NOT NULL DEFAULT '0',
  `user_home_phone` varchar(20) DEFAULT NULL,
  `user_home_fax` varchar(20) DEFAULT NULL,
  `user_work_phone` varchar(20) DEFAULT NULL,
  `user_work_fax` varchar(20) DEFAULT NULL,
  `user_cellular` varchar(20) DEFAULT NULL,
  `user_pager` varchar(20) DEFAULT NULL,
  `user_summer_time` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_list_option` varchar(255) DEFAULT NULL,
  `user_allow_email` tinyint(1) NOT NULL DEFAULT '1',
  `user_allow_website` tinyint(1) NOT NULL DEFAULT '1',
  `user_allow_messenger` tinyint(1) NOT NULL DEFAULT '1',
  `user_allow_real` tinyint(1) NOT NULL DEFAULT '1',
  `user_allow_sig` tinyint(1) NOT NULL DEFAULT '1',
  `user_viewpm` tinyint(1) NOT NULL DEFAULT '1',
  `user_viewwebsite` tinyint(1) NOT NULL DEFAULT '1',
  `user_viewmessenger` tinyint(1) NOT NULL DEFAULT '1',
  `user_viewreal` tinyint(1) NOT NULL DEFAULT '1',
  `user_viewavatar` tinyint(1) NOT NULL DEFAULT '1',
  `user_viewphoto` tinyint(1) NOT NULL DEFAULT '1',
  `user_viewsig` tinyint(1) NOT NULL DEFAULT '1',
  `user_viewimg` tinyint(1) NOT NULL DEFAULT '1',
  `user_buddy_friend_display` tinyint(1) DEFAULT '1',
  `user_buddy_ignore_display` tinyint(1) DEFAULT '1',
  `user_buddy_friend_of_display` tinyint(1) DEFAULT '1',
  `user_buddy_ignored_by_display` tinyint(1) DEFAULT '1',
  `user_watched_topics_per_page` smallint(3) DEFAULT '15',
  `user_privmsgs_per_page` smallint(3) DEFAULT '5',
  `user_sub_forum` tinyint(1) NOT NULL DEFAULT '1',
  `user_split_cat` tinyint(1) NOT NULL DEFAULT '1',
  `user_last_topic_title` tinyint(1) NOT NULL DEFAULT '1',
  `user_sub_level_links` tinyint(1) NOT NULL DEFAULT '2',
  `user_display_viewonline` tinyint(1) NOT NULL DEFAULT '2',
  `user_announcement_date_display` tinyint(1) NOT NULL DEFAULT '1',
  `user_announcement_display` tinyint(1) NOT NULL DEFAULT '1',
  `user_announcement_display_forum` tinyint(1) NOT NULL DEFAULT '1',
  `user_announcement_split` tinyint(1) NOT NULL DEFAULT '1',
  `user_announcement_forum` tinyint(1) NOT NULL DEFAULT '1',
  `user_calendar_display_open` tinyint(1) NOT NULL DEFAULT '0',
  `user_calendar_header_cells` tinyint(1) NOT NULL DEFAULT '7',
  `user_fdow` tinyint(1) NOT NULL DEFAULT '1',
  `user_calendar_nb_row` tinyint(2) unsigned NOT NULL DEFAULT '5',
  `user_calendar_birthday` tinyint(1) NOT NULL DEFAULT '1',
  `user_calendar_forum` tinyint(1) NOT NULL DEFAULT '1',
  `user_last_topics_from_started` tinyint(2) NOT NULL DEFAULT '3',
  `user_last_topics_from_replied` tinyint(2) NOT NULL DEFAULT '3',
  `user_last_topics_from_ended` tinyint(2) NOT NULL DEFAULT '3',
  `user_last_topics_from_split` tinyint(1) NOT NULL DEFAULT '1',
  `user_last_topics_from_forum` tinyint(1) NOT NULL DEFAULT '1',
  `user_split_global_announce` tinyint(1) NOT NULL DEFAULT '1',
  `user_split_announce` tinyint(1) NOT NULL DEFAULT '1',
  `user_split_sticky` tinyint(1) NOT NULL DEFAULT '1',
  `user_split_topic_split` tinyint(1) NOT NULL DEFAULT '0',
  `user_points` decimal(11,0) NOT NULL DEFAULT '0',
  `user_unread_topics` text,
  `user_topics_last_per_page` smallint(2) NOT NULL DEFAULT '15',
  `user_flag` varchar(25) DEFAULT NULL,
  `user_holidays` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `user_warnings` smallint(5) DEFAULT '0',
  `user_rules` int(11) NOT NULL DEFAULT '0',
  `rating_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `user_extra` tinyint(2) NOT NULL DEFAULT '0',
  `user_allowsignature` tinyint(1) NOT NULL DEFAULT '1',
  `user_actviate_date` int(11) DEFAULT '0',
  `user_expire_date` int(11) DEFAULT '0',
  `user_inactive_emls` tinyint(1) NOT NULL DEFAULT '0',
  `user_inactive_last_eml` int(11) NOT NULL DEFAULT '0',
  `user_state` varchar(3) NOT NULL DEFAULT '0',
  `user_country` varchar(3) NOT NULL DEFAULT '0',
  `phpBBSecurity_answer` text NOT NULL,
  `phpBBSecurity_question` text NOT NULL,
  `phpBBSecurity_login_tries` smallint(5) NOT NULL DEFAULT '0',
  `phpBBSecurity_pm_sent` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  KEY `user_session_time` (`user_session_time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_users`
--

LOCK TABLES `phpbb_users` WRITE;
/*!40000 ALTER TABLE `phpbb_users` DISABLE KEYS */;
INSERT INTO `phpbb_users` VALUES (-1,0,'Anonymous','',0,0,0,1334688207,0,0,0.00,NULL,'','',0,0,0,0,0,NULL,0,0,0,1,1,1,1,1,0,1,0,1,0,NULL,'',0,NULL,0,'','','','','',NULL,'','','',NULL,'','','','',1335146993,1,1,1,1,1,1,'0.0.0.0',1,0,1,0,0,'0.0.0.0','',0,'0',0,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,15,5,1,1,1,2,2,1,1,1,1,1,0,7,1,5,1,1,3,3,3,1,1,1,1,1,0,0,NULL,15,NULL,2,0,0,0,0,1,0,0,0,0,'0','0','','',0,0),(2,1,'HelterSkelter','62e104762dbe10913bf1fa9a920ae8fb',1335136793,0,1334811803,1334688207,1,1,0.00,2,'english','d M Y h:i a',2,1,1334811803,0,0,NULL,2,1,1,1,1,1,1,1,1,1,1,1,1,1,'',0,NULL,0,'jwi1965@hotmail.com','','','','',NULL,'','','',NULL,'','','','',1,1,1,1,1,1336863666,1,'50.46.135.150',1,0,1,0,0,'50.46.135.150','',1,'19650227',0,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,1,1,1,1,1,1,2,2,2,1,1,1,1,1,1,1,1,15,5,1,1,1,2,2,1,1,1,1,1,0,7,0,5,1,1,3,3,3,1,1,1,1,1,0,0,NULL,15,NULL,2,0,1335135675,0,1,1,0,0,0,0,'201','181','ab86a1e1ef70dff97959067b723c5c24','who',0,0);
/*!40000 ALTER TABLE `phpbb_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_vote_desc`
--

DROP TABLE IF EXISTS `phpbb_vote_desc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_vote_desc` (
  `vote_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `vote_text` text NOT NULL,
  `vote_start` int(11) NOT NULL DEFAULT '0',
  `vote_length` int(11) NOT NULL DEFAULT '0',
  `vote_max` int(3) NOT NULL DEFAULT '1',
  `vote_voted` int(7) NOT NULL DEFAULT '0',
  `vote_hide` tinyint(1) NOT NULL DEFAULT '0',
  `vote_tothide` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vote_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_vote_desc`
--

LOCK TABLES `phpbb_vote_desc` WRITE;
/*!40000 ALTER TABLE `phpbb_vote_desc` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_vote_desc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_vote_results`
--

DROP TABLE IF EXISTS `phpbb_vote_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_vote_results` (
  `vote_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `vote_option_id` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `vote_option_text` varchar(255) NOT NULL DEFAULT '',
  `vote_result` int(11) NOT NULL DEFAULT '0',
  KEY `vote_option_id` (`vote_option_id`),
  KEY `vote_id` (`vote_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_vote_results`
--

LOCK TABLES `phpbb_vote_results` WRITE;
/*!40000 ALTER TABLE `phpbb_vote_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_vote_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_vote_voters`
--

DROP TABLE IF EXISTS `phpbb_vote_voters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_vote_voters` (
  `vote_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `vote_user_id` mediumint(8) NOT NULL DEFAULT '0',
  `vote_user_ip` char(8) NOT NULL DEFAULT '',
  KEY `vote_id` (`vote_id`),
  KEY `vote_user_id` (`vote_user_id`),
  KEY `vote_user_ip` (`vote_user_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_vote_voters`
--

LOCK TABLES `phpbb_vote_voters` WRITE;
/*!40000 ALTER TABLE `phpbb_vote_voters` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_vote_voters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_words`
--

DROP TABLE IF EXISTS `phpbb_words`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_words` (
  `word_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `word` char(100) NOT NULL DEFAULT '',
  `replacement` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`word_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_words`
--

LOCK TABLES `phpbb_words` WRITE;
/*!40000 ALTER TABLE `phpbb_words` DISABLE KEYS */;
/*!40000 ALTER TABLE `phpbb_words` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phpbb_wpm`
--

DROP TABLE IF EXISTS `phpbb_wpm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phpbb_wpm` (
  `name` varchar(255) NOT NULL DEFAULT '',
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phpbb_wpm`
--

LOCK TABLES `phpbb_wpm` WRITE;
/*!40000 ALTER TABLE `phpbb_wpm` DISABLE KEYS */;
INSERT INTO `phpbb_wpm` VALUES ('wpm_version','1.0.8'),('active_wpm','1'),('wpm_subject','Welcome to [sitename]!'),('wpm_message','Hi there, [username]!  I hope you enjoy your stay here at [sitename]!  If you have any questions about the site, please ask.'),('wpm_username','HelterSkelter'),('wpm_userid','2');
/*!40000 ALTER TABLE `phpbb_wpm` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-04-22 19:09:24
