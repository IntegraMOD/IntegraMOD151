#
# Basic DB data for phpBB2.0.24 IntegraMOD151
#


# -- Config
INSERT INTO phpbb_config (config_name, config_value) VALUES ('config_id','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_disable','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sitename','yourdomain.com');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('site_desc','A _little_ text to describe your forum');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cookie_name','im_b_248');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cookie_path','/');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cookie_domain','');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cookie_secure','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('session_length','3600');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_html','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_html_tags','b,i,u,pre');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_bbcode','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_smilies','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_sig','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_namechange','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_theme_create','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_avatar_local','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_avatar_remote','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_avatar_upload','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_photo_local','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_photo_remote','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_photo_upload','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('enable_confirm', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_autologin','1'); 
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_autologin_time','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_user_style','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('posts_per_page','15');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('topics_per_page','50');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('hot_threshold','25');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_poll_options','10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_sig_chars','255');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_inbox_privmsgs','50');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_sentbox_privmsgs','25');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_savebox_privmsgs','50');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_email_sig','Thanks, The Management');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smtp_delivery','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smtp_host','');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smtp_username','');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smtp_password','');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sendmail_fix','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('require_activation','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('flood_interval','15');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_login_attempts', '5'); 
INSERT INTO phpbb_config (config_name, config_value) VALUES ('login_reset_time', '30');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_email_form','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_filesize','6144');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_max_width','80');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_max_height','80');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_path','images/avatars');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_gallery_path','images/avatars/gallery');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('photo_filesize','102400');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('photo_max_width','800');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('photo_max_height','600');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('photo_path','images/photos');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('photo_gallery_path','images/photos/gallery');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('read_viewphoto','');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smilies_path','images/smiles');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('default_style','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('default_dateformat','D M d, Y g:i a');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_timezone','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('prune_enable','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('privmsg_disable','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('gzip_compress','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('debug_mode', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('coppa_fax', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('coppa_mail', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('record_online_users', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('record_online_date', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('version', '.0.24');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_news', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_item_trim', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_title_trim', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_item_num', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_path', 'images/news');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_rss', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_rss_desc', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_rss_language', 'en_us');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_rss_ttl', '60');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_rss_cat', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_rss_image', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_rss_image_desc', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_rss_item_count', '15');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_rss_show_abstract', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_base_url', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_index_file', 'portal.php');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('prune_shouts', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('integramod_version', '1.5.0' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('visit_counter', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('nextcron', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('pseudocron', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('crontest', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_disable_msg', 'Upgrading the site...');
INSERT INTO phpbb_config (config_name, config_value) VALUES ("bluecard_limit", "3");
INSERT INTO phpbb_config (config_name, config_value) VALUES ("bluecard_limit_2", "1");
INSERT INTO phpbb_config (config_name, config_value) VALUES ("max_user_bancard", "10");
INSERT INTO phpbb_config (config_name, config_value) VALUES ("report_forum", "0");
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_link_bookmarks', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('user_topics_last_per_page_over', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('mini_cal_calendar_version', 'TOPIC');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('mini_cal_limit', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('mini_cal_days_ahead', '30');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('mini_cal_date_search', 'POSTS');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('mini_cal_fdow', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('mini_cal_link_class', 'gensmall');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('mini_cal_today_class', 'topicTitle');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('mini_cal_auth', 'auth_view');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_keywords', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_description', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_author', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_identifier_url', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_reply_to', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_revisit_after', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_category', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_copyright', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_generator', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_robots', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_distribution', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_date_creation_day', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_date_creation_month', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_date_creation_year', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_date_revision_day', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_date_revision_month', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_date_revision_year', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_redirect_url_time', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_redirect_url_adress', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_refresh', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_pragma', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_language', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('auto_lang_en', 'english');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('auto_lang_en-gb', 'english');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('auto_lang_en-us', 'english');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('auto_lang_fr', 'francais');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('auto_lang_nl', 'nederlands');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('auto_lang_nl-be', 'nederlands');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('auto_lang_de', 'deutsch');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('auto_lang_he', 'hebrew');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_rebuild_end', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_rebuild_pos', '-1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_rebuildcfg_maxmemory', '500');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_rebuildcfg_minposts', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_rebuildcfg_php3only', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_rebuildcfg_php3pps', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_rebuildcfg_php4pps', '8');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_rebuildcfg_timelimit', '240');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_rebuildcfg_timeoverwrite', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_disallow_postcounter', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_disallow_rebuild', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_max_lines', '5');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_wordwrap', '100');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_allow_font_sizes', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_min_font_size', '7');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_max_font_size', '12');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_allow_bold', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_allow_italic', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_allow_underline', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_allow_colors', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_allow_quote', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_allow_code', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_allow_list', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_allow_url', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_allow_images', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_max_images', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_max_img_height', '75');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_max_img_width', '500');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_allow_on_max_img_size_fail', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_max_img_files_size', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_max_img_av_files_size', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_exotic_bbcodes_disallowed', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_allow_smilies', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('logo_image_path', 'images/logo');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('logo_image', 'phpbb2_logo.png');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('logo_image_w', '500');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('logo_image_h', '110');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('paypal_p_acct', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('paypal_b_acct', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('paypal_currency_code', 'USD');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('lw_trial_period', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dislay_x_donors', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('donate_start_time', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('donate_end_time', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('donate_cur_goal', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('donate_description', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('donate_to_points', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('donate_to_posts', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('list_top_donors', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('donate_to_grp_one', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('to_grp_one_amount', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('donate_to_grp_two', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('to_grp_two_amount', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('donate_currencies', 'USD;');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('usd_to_primary', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('eur_to_primary', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('gbp_to_primary', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cad_to_primary', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('jpy_to_primary', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_flood_interval', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rand_seed', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('apmr_deny_msg', 'Sorry %U%, The Admin You Are Trying To Private Message Currently Is Not Accepting Private Messages.');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('apmr_redirect_msg', 'The admin you have private messaged, has redirected your PM to another member for a faster response time.');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('donor_rank_id', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('lw_header_reminder', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_login_limit', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_notify_admin', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_notify_admin_id', '2');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_auto_ban', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_allowed_sessions', '50');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_DDoS_Ban', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_Encoded_Ban', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_Union_Ban', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_Clike_Ban', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_SQL_Ban', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_File_Ban', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_Perl_Ban', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_total_attempts', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_Cback_Ban', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_Allow_Change', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_notify_admin_pm', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_notify_admin_em', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_DDoS_level', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_per_page', '100');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_allowed_admins', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_disallowed_agents', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_disallowed_referers', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_last_backup_date', '19');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_backup_time', '18');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_backup_on', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_backup_folder', 'backups');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_backup_filename', 'backups');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_guest_matches', '8');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_use_password_match', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_password_min_length', '5');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('phpBBSecurity_version', '1.0.3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_min_chars', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cash_disable',0);
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cash_display_after_posts',0);
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cash_post_message','You earned %s for that post');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cash_disable_spam_num',10);
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cash_disable_spam_time',24);
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cash_disable_spam_message','You have exceeded the alloted amount of posts and will not earn anything for your post');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cash_installed','yes');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cash_version','2.2.3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cash_adminbig','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cash_adminnavbar','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('points_name','Points');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('EM_version', '0.4.0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('EM_password', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('EM_read', 'server');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('EM_write', 'server');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('EM_move', 'copy');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('EM_ftp_dir', '/');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('EM_ftp_user', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('EM_ftp_pass', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('EM_ftp_host', 'localhost');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('EM_ftp_port', '21');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('EM_ftp_type', 'fsock');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('EM_ftp_cache', '0');

# -- CrackerTracker 5.0.3
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('ipblock_enabled', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('ipblock_logsize', '100');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('auto_recovery', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('vconfirm_guest', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('autoban_mails', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('detect_misconfiguration', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('search_time_guest', '30');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('search_time_user', '20');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('search_count_guest', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('search_count_user', '4');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('massmail_protection', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('reg_protection', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('reg_blocktime', '30');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('reg_lastip', '0.0.0.0');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pwreset_time', '20');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('massmail_time', '20');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('spammer_time', '30');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('spammer_postcount', '4');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('spammer_blockmode', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('loginfeature', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pw_reset_feature', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('reg_last_reg', '1155944976');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('login_history', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('login_history_count', '10');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('login_ip_check', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pw_validity', '30');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pw_complex_min', '4');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pw_complex_mode', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pw_control', '0');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pw_complex', '0');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('last_file_scan', '1156000091');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('last_checksum_scan', '1156000082');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('logsize_logins', '100');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('logsize_spammer', '100');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('reg_ip_scan', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('global_message', 'Hello world!');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('global_message_type', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('logincount', '2');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('search_feature_enabled', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('spam_attack_boost', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('spam_keyword_det', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('footer_layout', '6');

INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (1, '*WebStripper*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (2, '*NetMechanic*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (3, '*CherryPicker*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (4, '*EmailCollector*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (5, '*EmailSiphon*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (6, '*WebBandit*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (7, '*EmailWolf*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (8, '*ExtractorPro*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (9, '*SiteSnagger*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (10, '*CheeseBot*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (11, '*ia_archiver*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (12, '*Website Quester*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (13, '*WebZip*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (14, '*moget*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (15, '*WebSauger*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (16, '*WebCopier*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (17, '*WWW-Collector*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (18, '*InfoNaviRobot*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (19, '*Harvest*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (20, '*Bullseye*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (21, '*LinkWalker*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (22, '*LinkextractorPro*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (23, '*WebProxy*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (24, '*BlowFish*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (25, '*WebEnhancer*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (26, '*TightTwatBot*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (27, '*LinkScan*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (28, '*WebDownloader*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (29, 'lwp');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (30, '*BruteForce*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (31, 'lwp-*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (32, '*anonym*');

ALTER TABLE `phpbb_users` ADD `ct_search_time` INT( 11 ) NULL DEFAULT 1 AFTER `user_newpasswd`;
ALTER TABLE `phpbb_users` ADD `ct_search_count` MEDIUMINT( 8 ) NULL DEFAULT 1 AFTER `ct_search_time`;
ALTER TABLE `phpbb_users` ADD `ct_last_mail` INT( 11 ) NULL DEFAULT 1 AFTER `ct_search_count`;
ALTER TABLE `phpbb_users` ADD `ct_last_post` INT( 11 ) NULL DEFAULT 1 AFTER `ct_last_mail`;
ALTER TABLE `phpbb_users` ADD `ct_post_counter` MEDIUMINT( 8 ) NULL DEFAULT 1 AFTER `ct_last_post`;
ALTER TABLE `phpbb_users` ADD `ct_last_pw_reset` INT( 11 ) NULL DEFAULT 1 AFTER `ct_post_counter`;
ALTER TABLE `phpbb_users` ADD `ct_enable_ip_warn` TINYINT( 1 ) NULL DEFAULT 1 AFTER `ct_last_pw_reset`;
ALTER TABLE `phpbb_users` ADD `ct_last_used_ip` VARCHAR( 16 ) NULL DEFAULT '0.0.0.0' AFTER `ct_enable_ip_warn`;
ALTER TABLE `phpbb_users` ADD `ct_last_ip` VARCHAR( 16 ) NULL DEFAULT '0.0.0.0' AFTER `ct_last_used_ip`;
ALTER TABLE `phpbb_users` ADD `ct_login_count` MEDIUMINT( 8 ) NULL DEFAULT 1 AFTER `ct_last_used_ip`;
ALTER TABLE `phpbb_users` ADD `ct_login_vconfirm` TINYINT( 1 ) NULL DEFAULT 0 AFTER `ct_login_count`;
ALTER TABLE `phpbb_users` ADD `ct_last_pw_change` INT( 11 ) NULL DEFAULT 1 AFTER `ct_login_vconfirm`;
ALTER TABLE `phpbb_users` ADD `ct_global_msg_read` TINYINT( 1 ) NULL DEFAULT 0 AFTER `ct_last_pw_change`;
ALTER TABLE `phpbb_users` ADD `ct_miserable_user` TINYINT( 1 ) NULL DEFAULT 0 AFTER `ct_global_msg_read`;

# -- Advanced Visual Confirmation
INSERT INTO `phpbb_captcha_config` VALUES ('width', '450');
INSERT INTO `phpbb_captcha_config` VALUES ('height', '100');
INSERT INTO `phpbb_captcha_config` VALUES ('exsample_code', 'SAMPLE');
INSERT INTO `phpbb_captcha_config` VALUES ('background_color', '#E5ECF9');
INSERT INTO `phpbb_captcha_config` VALUES ('jpeg', '0');
INSERT INTO `phpbb_captcha_config` VALUES ('jpeg_quality', '90');
INSERT INTO `phpbb_captcha_config` VALUES ('pre_letters', '0');
INSERT INTO `phpbb_captcha_config` VALUES ('pre_letters_great', '1');
INSERT INTO `phpbb_captcha_config` VALUES ('font', '1');
INSERT INTO `phpbb_captcha_config` VALUES ('trans_letters', '0');
INSERT INTO `phpbb_captcha_config` VALUES ('chess', '0');
INSERT INTO `phpbb_captcha_config` VALUES ('ellipses', '1');
INSERT INTO `phpbb_captcha_config` VALUES ('arcs', '1');
INSERT INTO `phpbb_captcha_config` VALUES ('lines', '1');
INSERT INTO `phpbb_captcha_config` VALUES ('image', '1');
INSERT INTO `phpbb_captcha_config` VALUES ('bg_transition', '35');
INSERT INTO `phpbb_captcha_config` VALUES ('gammacorrect', '0.8');
INSERT INTO `phpbb_captcha_config` VALUES ('foreground_lattice_x', '20');
INSERT INTO `phpbb_captcha_config` VALUES ('foreground_lattice_y', '20');
INSERT INTO `phpbb_captcha_config` VALUES ('lattice_color', '#FFFFFF');
INSERT INTO `phpbb_captcha_config` VALUES ('avc_version', '1.2.0');

# -- Cash
INSERT INTO phpbb_cash (cash_id, cash_order, cash_settings, cash_dbfield, cash_name, cash_default, cash_decimals, cash_imageurl, cash_exchange, cash_perpost, cash_postbonus, cash_perreply, cash_maxearn, cash_perpm, cash_perchar, cash_allowance, cash_allowanceamount, cash_allowancetime, cash_allowancenext, cash_forumlist) VALUES (1, 1, 3313, 'user_points', 'Points', 0, 0, '', 1, 25, 2, 25, 75, 0, 20, 0, 0, 2, 0, '');

# -- Categories
INSERT INTO phpbb_categories (cat_id, cat_title, cat_order) VALUES (1, 'Test category 1', 10);


# -- Forums
INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, cat_id, forum_order, forum_posts, forum_topics, forum_last_post_id, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_announce, auth_sticky, auth_pollcreate, auth_vote, auth_attachments) VALUES (1, 'Test Forum 1', 'This is just a test forum.', 1, 10, 1, 1, 1, 0, 0, 0, 0, 1, 1, 3, 3, 1, 1, 3);


# -- Users
INSERT INTO phpbb_users (user_id, username, user_level, user_regdate, user_password, user_email, user_icq, user_website, user_occ, user_from, user_interests, user_sig, user_viewemail, user_style, user_aim, user_yim, user_msnm, user_posts, user_attachsig, user_allowsmile, user_allowhtml, user_allowbbcode, user_allow_pm, user_notify_pm, user_allow_viewonline, user_rank, user_avatar, user_lang, user_timezone, user_dateformat, user_actkey, user_newpasswd, user_notify, user_active) VALUES ( -1, 'Anonymous', 0, 0, '', '', '', '', '', '', '', '', 0, NULL, '', '', '', 0, 0, 1, 1, 1, 0, 1, 1, NULL, '', '', 0, '', '', '', 0, 0);

# -- username: admin    password: admin (change this or remove it once everything is working!)
INSERT INTO phpbb_users (user_id, username, user_level, user_regdate, user_password, user_email, user_icq, user_website, user_occ, user_from, user_interests, user_sig, user_viewemail, user_style, user_aim, user_yim, user_msnm, user_posts, user_attachsig, user_allowsmile, user_allowhtml, user_allowbbcode, user_allow_pm, user_notify_pm, user_popup_pm, user_allow_viewonline, user_rank, user_avatar, user_lang, user_timezone, user_dateformat, user_actkey, user_newpasswd, user_notify, user_active) VALUES ( 2, 'Admin', 1, 0, '21232f297a57a5a743894a0e4a801fc3', 'admin@yourdomain.com', '', '', '', '', '', '', 1, 1, '', '', '', 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, '', 'english', 0, 'd M Y h:i a', '', '', 0, 1);


# -- Ranks
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_max, rank_special, rank_image) VALUES ( 1, 'Site Admin', -1, 0, 1, NULL);


# -- Groups
INSERT INTO phpbb_groups (group_id, group_name, group_description, group_single_user) VALUES (1, 'Anonymous', 'Personal User', 1);
INSERT INTO phpbb_groups (group_id, group_name, group_description, group_single_user) VALUES (2, 'Admin', 'Personal User', 1);


# -- User -> Group
INSERT INTO phpbb_user_group (group_id, user_id, user_pending) VALUES (1, -1, 0);
INSERT INTO phpbb_user_group (group_id, user_id, user_pending) VALUES (2, 2, 0);


# -- Demo Topic
INSERT INTO phpbb_topics (topic_id, topic_title, topic_poster, topic_time, topic_views, topic_replies, forum_id, topic_status, topic_type, topic_vote, topic_first_post_id, topic_last_post_id) VALUES (1, 'Welcome to IntegraMOD 1.5.1 :)', 2, '972086460', 0, 0, 1, 0, 0, 0, 1, 1);


# -- Demo Post
INSERT INTO phpbb_posts (post_id, topic_id, forum_id, poster_id, post_time, post_username, poster_ip) VALUES (1, 1, 1, 2, CURRENT_DATE, NULL, '7F000001');
INSERT INTO phpbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES (1, '8e8de0c186', 'Welcome to IntegraMOD 1.5.1 :)', 'Welcome [you]! This is an example post in your [google]IntegraMOD[/google] installation. You may delete this post, this topic and even this forum if you like since everything seems to be working!');


# -- Smilies
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 1, ':D', 'icon_biggrin.gif', 'Very Happy');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 2, ':-D', 'icon_biggrin.gif', 'Very Happy');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 3, ':grin:', 'icon_biggrin.gif', 'Very Happy');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 4, ':)', 'icon_smile.gif', 'Smile');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 5, ':-)', 'icon_smile.gif', 'Smile');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 6, ':smile:', 'icon_smile.gif', 'Smile');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 7, ':(', 'icon_sad.gif', 'Sad');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 8, ':-(', 'icon_sad.gif', 'Sad');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 9, ':sad:', 'icon_sad.gif', 'Sad');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 10, ':o', 'icon_surprised.gif', 'Surprised');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 11, ':-o', 'icon_surprised.gif', 'Surprised');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 12, ':eek:', 'icon_surprised.gif', 'Surprised');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 13, ':shock:', 'icon_eek.gif', 'Shocked');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 14, ':?', 'icon_confused.gif', 'Confused');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 15, ':-?', 'icon_confused.gif', 'Confused');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 16, ':???:', 'icon_confused.gif', 'Confused');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 17, '8)', 'icon_cool.gif', 'Cool');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 18, '8-)', 'icon_cool.gif', 'Cool');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 19, ':cool:', 'icon_cool.gif', 'Cool');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 20, ':lol:', 'icon_lol.gif', 'Laughing');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 21, ':x', 'icon_mad.gif', 'Mad');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 22, ':-x', 'icon_mad.gif', 'Mad');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 23, ':mad:', 'icon_mad.gif', 'Mad');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 24, ':P', 'icon_razz.gif', 'Razz');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 25, ':-P', 'icon_razz.gif', 'Razz');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 26, ':razz:', 'icon_razz.gif', 'Razz');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 27, ':oops:', 'icon_redface.gif', 'Embarassed');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 28, ':cry:', 'icon_cry.gif', 'Crying or Very sad');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 29, ':evil:', 'icon_evil.gif', 'Evil or Very Mad');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 30, ':twisted:', 'icon_twisted.gif', 'Twisted Evil');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 31, ':roll:', 'icon_rolleyes.gif', 'Rolling Eyes');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 32, ':wink:', 'icon_wink.gif', 'Wink');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 33, ';)', 'icon_wink.gif', 'Wink');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 34, ';-)', 'icon_wink.gif', 'Wink');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 35, ':!:', 'icon_exclaim.gif', 'Exclamation');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 36, ':?:', 'icon_question.gif', 'Question');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 37, ':idea:', 'icon_idea.gif', 'Idea');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 38, ':arrow:', 'icon_arrow.gif', 'Arrow');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 39, ':|', 'icon_neutral.gif', 'Neutral');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 40, ':-|', 'icon_neutral.gif', 'Neutral');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 41, ':neutral:', 'icon_neutral.gif', 'Neutral');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 42, ':mrgreen:', 'icon_mrgreen.gif', 'Mr. Green');


# -- wordlist
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 1, 'example', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 2, 'post', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 3, 'phpbb', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 4, 'installation', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 5, 'delete', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 6, 'topic', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 7, 'forum', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 8, 'since', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 9, 'everything', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 10, 'seems', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 11, 'working', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 12, 'welcome', 0 );


# -- wordmatch
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 1, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 2, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 3, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 4, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 5, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 6, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 7, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 8, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 9, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 10, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 11, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 12, 1, 1 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 3, 1, 1 );

# -- Album
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('max_pics', '1024');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('user_pics_limit', '-1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('mod_pics_limit', '-1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('max_file_size', '128000');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('max_width', '1024');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('max_height', '768');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('rows_per_page', '5');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('cols_per_page', '4');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('fullpic_popup', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('thumbnail_quality', '75');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('thumbnail_size', '125');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('thumbnail_cache', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('sort_method', 'pic_time');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('sort_order', 'DESC');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('jpg_allowed', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('png_allowed', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('gif_allowed', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('desc_length', '512');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('hotlink_prevent', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('hotlink_allowed', 'mightygorgon.com');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('personal_gallery', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('personal_gallery_private', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('personal_gallery_limit', '-1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('personal_gallery_view', '-1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('rate', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('rate_scale', '10');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('comment', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('gd_version', '2');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('album_version', '.0.53');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('fap_version', '1.2.3');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_index_thumb', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_index_total_pics', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_index_total_comments', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_index_comments', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_index_last_comment', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_index_last_pic', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_index_pics', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_recent_in_subcats', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_recent_instead_of_nopics', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('line_break_subcats', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_index_subcats', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('personal_allow_gallery_mod', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('personal_allow_sub_categories', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('personal_sub_category_limit', '-1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('personal_show_subcats_in_index', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('personal_show_recent_in_subcats', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('personal_show_recent_instead_of_nopics', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_personal_gallery_link', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('album_category_sorting', 'cat_order');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('album_category_sorting_direction', 'ASC');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('album_debug_mode', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_all_in_personal_gallery', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('new_pic_check_interval', '1M');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('index_enable_supercells', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('email_notification', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_download', '2');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_slideshow', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_pic_size_on_thumb', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('hon_rate_users', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('hon_rate_where', '');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('hon_rate_sep', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('hon_rate_times', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('disp_watermark_at', '3');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('wut_users', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('use_watermark', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('rate_type', '2');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('disp_rand', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('disp_mostv', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('disp_high', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('disp_late', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('img_cols', '4');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('img_rows', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('midthumb_use', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('midthumb_height', '600');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('midthumb_width', '800');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('midthumb_cache', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('max_files_to_upload', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('max_pregenerated_fields', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('dynamic_fields', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('pregenerate_fields', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('propercase_pic_title', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_index_last_pic_lv', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('personal_pics_approval', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_img_no_gd', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('dynamic_pic_resampling', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('max_file_size_resampling', '1024000');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('switch_nuffload', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('path_to_bin', './cgi-bin/');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('perl_uploader', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_progress_bar', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('close_on_finish', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('max_pause', '5');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('simple_format', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('multiple_uploads', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('max_uploads', '5');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('zip_uploads', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('resize_pic', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('resize_width', '600');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('resize_height', '600');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('resize_quality', '70');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_pics_nav', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_inline_copyright', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('enable_nuffimage', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('enable_sepia_bw', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('personal_allow_avatar_gallery', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_gif_mid_thumb', '1');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('slideshow_script', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('show_exif', '0');
INSERT INTO phpbb_album_config (config_name, config_value) VALUES ('album_bbcode', '1');

# -- Attachment
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('upload_dir','files');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('upload_img','images/icon_clip.gif');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('topic_icon','images/icon_clip.gif');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('display_order','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_filesize','262144');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attachment_quota','52428800');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_filesize_pm','262144');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_attachments','3');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_attachments_pm','1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('disable_mod','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('allow_pm_attach','1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attachment_topic_review','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('allow_ftp_upload','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('show_apcp','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attach_version','2.3.13');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('default_upload_quota', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('default_pm_quota', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_server','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_path','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('download_path','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_user','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_pass','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_pasv_mode','1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_display_inlined','1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_max_width','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_max_height','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_link_width','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_link_height','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_create_thumbnail','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_min_thumb_filesize','12000');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_imagick', '');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('use_gd2','1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('wma_autoplay','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('flash_autoplay','0');

# -- forbidden_extensions
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (1,'php');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (2,'php3');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (3,'php4');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (4,'phtml');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (5,'pl');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (6,'asp');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (7,'cgi');

# -- extension_groups
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (1,'Images',1,1,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (2,'Archives',0,1,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (3,'Plain Text',0,0,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (4,'Documents',0,0,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (5,'Real Media',0,0,2,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (6,'Streams',2,0,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (7,'Flash Files',3,0,1,'',0,'');

# -- extensions
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (1, 1,'gif', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (2, 1,'png', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (3, 1,'jpeg', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (4, 1,'jpg', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (5, 1,'tif', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (6, 1,'tga', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (7, 2,'gtar', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (8, 2,'gz', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (9, 2,'tar', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (10, 2,'zip', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (11, 2,'rar', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (12, 2,'ace', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (13, 3,'txt', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (14, 3,'c', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (15, 3,'h', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (16, 3,'cpp', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (17, 3,'hpp', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (18, 3,'diz', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (19, 4,'xls', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (20, 4,'doc', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (21, 4,'dot', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (22, 4,'pdf', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (23, 4,'ai', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (24, 4,'ps', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (25, 4,'ppt', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (26, 5,'rm', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (27, 6,'wma', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (28, 7,'swf', '');

# -- default quota limits
INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (1, 'Low', 262144);
INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (2, 'Medium', 2097152);
INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (3, 'High', 5242880);

INSERT INTO phpbb_approve_users (user_id, approve_moderate) VALUES (-1, 1);

INSERT INTO phpbb_stats_config (config_name, config_value) VALUES ('install_date', CURRENT_DATE);
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES ('return_limit', '10');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES ('version', '3.0.0');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES ('page_views', '0');

INSERT INTO phpbb_stats_smilies_info (last_post_id, last_update_time, update_time) VALUES (0, 0, 10080);

INSERT INTO phpbb_modules VALUES (1, 'admin_statistics', 360, 20, 1, 1, 1, 1, 1);
INSERT INTO phpbb_modules VALUES (2, 'most_active_topics', 360, 30, 1, 1, 1, 1, 1);
INSERT INTO phpbb_modules VALUES (3, 'most_viewed_topics', 360, 40, 1, 1, 1, 1, 1);
INSERT INTO phpbb_modules VALUES (4, 'top_posters', 360, 50, 1, 1, 1, 1, 1);
INSERT INTO phpbb_modules VALUES (5, 'top_smilies', 0, 60, 1, 1, 1, 1, 1);
INSERT INTO phpbb_modules VALUES (6, 'most_active_topicstarter', 360, 70, 1, 1, 1, 1, 1);
INSERT INTO phpbb_modules VALUES (7, 'posts_by_month', 360, 80, 1, 1, 1, 1, 1);
INSERT INTO phpbb_modules VALUES (8, 'stats_overview', 360, 10, 1, 1, 1, 1, 1);
INSERT INTO phpbb_modules VALUES (9, 'topics_by_month', 360, 90, 1, 1, 1, 1, 1);
INSERT INTO phpbb_modules VALUES (10, 'top_attachments', 360, 100, 1, 1, 1, 1, 1);
INSERT INTO phpbb_modules VALUES (11, 'top_posters_month', 360, 110, 1, 1, 1, 1, 1);
INSERT INTO phpbb_modules VALUES (12, 'top_posters_week', 360, 120, 1, 1, 1, 1, 1);
INSERT INTO phpbb_modules VALUES (13, 'users_by_month', 360, 130, 1, 1, 1, 1, 1);

INSERT INTO phpbb_module_info VALUES (1, 'Administrative Statistics', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays some Admin Statistics about your Board.\nIt is nearly the same you are able to see within the first Administration Panel visit.');
INSERT INTO phpbb_module_info VALUES (2, 'Most active Topics', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays the most active topics at your board.');
INSERT INTO phpbb_module_info VALUES (3, 'Most viewed topics', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays the most viewed topics at your board.');
INSERT INTO phpbb_module_info VALUES (4, 'Top Posters', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays the Top Posters from your board.\nAnonymous Poster are not counted.');
INSERT INTO phpbb_module_info VALUES (5, 'Top Smilies', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays the Top Smilies used at your board.\nThis Module uses an Smilie Index Table for caching the smilie data and to not\nrequire re-indexing of all posts.');
INSERT INTO phpbb_module_info VALUES (6, 'Most Active Topicstarter', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays the most active topicstarter on your board.\nAnonymous Poster are not counted.');
INSERT INTO phpbb_module_info VALUES (7, 'New posts by month', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module will display the posts created at your Board in a monthly statistic.');
INSERT INTO phpbb_module_info VALUES (8, 'Statistics Overview Section', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module will print out a link Block with Links to the current Module at the Statistics Site.\nYou are able to define the number of columns displayed for this Module within the Administration Panel -&gt; Edit Module.');
INSERT INTO phpbb_module_info VALUES (9, 'New topics by month', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module will display the topics created at your Board in a monthly statistic.');
INSERT INTO phpbb_module_info VALUES (10, 'Top Downloaded Attachments', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module will print out the most downloaded Files.\nThe Attachment Mod Version 2.3.x have to be installed in order to let this Module work.\nYou are able to exclude Images from the statistic too.');
INSERT INTO phpbb_module_info VALUES (11, 'Top Posters this Month (Site History Mod)', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module does NOT require the Site History Mod,\nit will display the Top Posters on a Monthly basis.');
INSERT INTO phpbb_module_info VALUES (12, 'Top Posters this Week (Site History Mod)', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module does NOT require the Site History Mod,\nit will display the Top Posters on a Weekly basis.');
INSERT INTO phpbb_module_info VALUES (13, 'New users by month', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module will display the users registered to your Board in a monthly statistic.');

INSERT INTO phpbb_module_admin_panel VALUES (8, 'num_columns', '2', 'number', 'num_columns_title', 'num_columns_explain', 'integer');
INSERT INTO phpbb_module_admin_panel VALUES (10, 'exclude_images', '0', 'number', 'exclude_images_title', 'exclude_images_explain', 'enum');

INSERT INTO phpbb_stats_smilies_index VALUES (':arrow:', 'icon_arrow.gif', 1);
INSERT INTO phpbb_stats_smilies_index VALUES (':D', 'icon_biggrin.gif', 1);
INSERT INTO phpbb_stats_smilies_index VALUES (':?', 'icon_confused.gif', 0);
INSERT INTO phpbb_stats_smilies_index VALUES ('8)', 'icon_cool.gif', 1);
INSERT INTO phpbb_stats_smilies_index VALUES (':cry:', 'icon_cry.gif', 8);
INSERT INTO phpbb_stats_smilies_index VALUES (':shock:', 'icon_eek.gif', 0);
INSERT INTO phpbb_stats_smilies_index VALUES (':evil:', 'icon_evil.gif', 0);
INSERT INTO phpbb_stats_smilies_index VALUES (':!:', 'icon_exclaim.gif', 1);
INSERT INTO phpbb_stats_smilies_index VALUES (':idea:', 'icon_idea.gif', 1);
INSERT INTO phpbb_stats_smilies_index VALUES (':lol:', 'icon_lol.gif', 20);
INSERT INTO phpbb_stats_smilies_index VALUES (':x', 'icon_mad.gif', 0);
INSERT INTO phpbb_stats_smilies_index VALUES (':mrgreen:', 'icon_mrgreen.gif', 0);
INSERT INTO phpbb_stats_smilies_index VALUES (':|', 'icon_neutral.gif', 0);
INSERT INTO phpbb_stats_smilies_index VALUES (':?:', 'icon_question.gif', 0);
INSERT INTO phpbb_stats_smilies_index VALUES (':P', 'icon_razz.gif', 0);
INSERT INTO phpbb_stats_smilies_index VALUES (':oops:', 'icon_redface.gif', 2);
INSERT INTO phpbb_stats_smilies_index VALUES (':roll:', 'icon_rolleyes.gif', 2);
INSERT INTO phpbb_stats_smilies_index VALUES (':(', 'icon_sad.gif', 0);
INSERT INTO phpbb_stats_smilies_index VALUES (':)', 'icon_smile.gif', 0);
INSERT INTO phpbb_stats_smilies_index VALUES (':o', 'icon_surprised.gif', 5);
INSERT INTO phpbb_stats_smilies_index VALUES (':twisted:', 'icon_twisted.gif', 0);
INSERT INTO phpbb_stats_smilies_index VALUES (':wink:', 'icon_wink.gif', 3);

#
# Dumping data for table `phpbb_themes`
#

INSERT INTO `phpbb_themes` (`themes_id`, `template_name`, `style_name`, `head_stylesheet`, `body_background`, `body_bgcolor`, `body_text`, `body_link`, `body_vlink`, `body_alink`, `body_hlink`, `tr_color1`, `tr_color2`, `tr_color3`, `tr_class1`, `tr_class2`, `tr_class3`, `th_color1`, `th_color2`, `th_color3`, `th_class1`, `th_class2`, `th_class3`, `td_color1`, `td_color2`, `td_color3`, `td_class1`, `td_class2`, `td_class3`, `fontface1`, `fontface2`, `fontface3`, `fontsize1`, `fontsize2`, `fontsize3`, `fontcolor1`, `fontcolor2`, `fontcolor3`, `span_class1`, `span_class2`, `span_class3`, `img_size_poll`, `img_size_privmsg`) VALUES (1, 'fisubice', 'fisubice', 'css/fisubice.css', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'row1', 'row2', '', '', '', '', 0, 0, 0, '', '006600', 'ff0000', '', '', '', 0, 0);

#
# Dumping data for table `phpbb_themes_name`
#

INSERT INTO `phpbb_themes_name` VALUES (1, 'The lightest row colour', 'The medium row color', 'The darkest row colour', '', '', '', 'Border round the whole page', 'Outer table border', 'Inner table border', 'Silver gradient picture', 'Blue gradient picture', 'Fade-out gradient on index', 'Background for quote boxes', 'All white areas', '', 'Background for topic posts', '2nd background for topic posts', '', 'Main fonts', 'Additional topic title font', 'Form fonts', 'Smallest font size', 'Medium font size', 'Normal font size (post body etc)', 'Quote & copyright text', 'Code text colour', 'Main table header text colour', '', '', '');

#
# Dumping data for table `phpbb_banner`
#

INSERT INTO phpbb_banner VALUES (1, 'images/banners/phpBB_88a.gif', 20, 0, 'phpbb2 community', 'http://www.phpbb.com', 2, 0, 1, 50, 1, 0, 0, 0, 0, 0, -1, 2, 'phpBB link', 0, 0, 0, 0, 600);
INSERT INTO phpbb_banner VALUES (2, 'images/banners/forum_images_banner_88x31.gif', 21, 0, 'forumimages.co.uk', 'http://www.forumimages.co.uk', 2, 0, 1, 50, 1, 0, 0, 0, 0, 0, -1, 2, 'forumimages link', 0, 0, 0, 0, 600);
INSERT INTO phpbb_banner VALUES (3, 'images/banners/smartorsite_logo.gif', 22, 0, 'Smartor Portal', 'http://smartor.is-root.com', 2, 0, 1, 50, 1, 0, 0, 0, 0, 0, -1, 2, 'Smartor link', 0, 0, 0, 0, 600);
INSERT INTO phpbb_banner VALUES (4, 'images/banners/phpbbhacks.gif', 23, 0, 'phpBBhacks.com', 'http://www.phpbbhacks.com', 2, 0, 1, 50, 1, 0, 0, 0, 0, 0, -1, 2, 'phpbbhacks link', 0, 0, 0, 0, 600);
INSERT INTO phpbb_banner VALUES (5, 'images/banners/phpbbintegraMOD.jpg', 0, 0, 'phpbb2 integraMOD', 'http://www.integramod.com', 2, 1, 1, 50, 1, 0, 0, 0, 0, 0, -1, 2, 'phpBB IntegraMOD', 0, 0, 0, 0, 600);

#
# Dumping data for table `phpbb_kb_articles`
#

#INSERT INTO phpbb_kb_articles VALUES (1, 1, 'Test Article', 'This is a test article for your KB', '1057708235', 2, '', '93074f48a9', 'This is a test article for your Knowledge Base programmed by [b:93074f48a9]wGEric &lt; eric@egcnetwork.com &gt; (Eric Faerber) - http://eric.best-1.biz/[/b:93074f48a9]\r\n\r\nBe sure you add categories and article types in the ACP and also change the Configuration to your liking.\r\n\r\nHave fun and enjoy your new Knowledge Base!  :D', 1, 1, 1, 0);

#
# Dumping data for table `phpbb_kb_categories`
#

INSERT INTO phpbb_kb_categories VALUES (1, 'Test Category 1', 'This is a test category', '0', '0', '10', '0', '0', '0', '0', '0', '2', '0', '0', '', '', '', '', '', '', '', '', '', '0' );

#
# Dumping data for table `phpbb_kb_config`
#

INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("allow_new", "1");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("notify", "1");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("admin_id", "2");
INSERT INTO phpbb_kb_config (config_name, config_value) values("show_pretext",0);
INSERT INTO phpbb_kb_config (config_name, config_value) values("pt_header","Article Submission Instructions");
INSERT INTO phpbb_kb_config (config_name, config_value) values("pt_body","Please check your references and include as much information as you can.");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("use_comments", "1");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("del_topic", "1");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("use_ratings", "0");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("comments_show", "1");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("bump_post", "1");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("stats_list", "1");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("header_banner", "1");

INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("votes_check_userid", "1");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("votes_check_ip", "1");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("art_pagination", "5");

INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("comments_pagination", "5");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("news_sort", "Alphabetic");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("news_sort_par", "ASC");

INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("wysiwyg", "0");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("wysiwyg_path", "modules/");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("allow_html", "1");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("allow_bbcode", "1");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("allow_smilies", "1");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("formatting_fixup", "0");
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ("allowed_html_tags", "b,i,u,a");

#
# Dumping data for table `phpbb_kb_types`
#

INSERT INTO phpbb_kb_types VALUES (1, 'Test Type 1');

#portal_page_layout
INSERT INTO phpbb_layout (lid, `name`, template, forum_wide, `view`, groups, pagetitle) VALUES(1, 'IntegraMOD Default', 'portal_body.tpl', 1, 0, '', 'Home');
INSERT INTO phpbb_layout (lid, `name`, template, forum_wide, `view`, groups, pagetitle) VALUES(2, 'Install and Configure', 'layout1.tpl', 1, 0, '', 'Home');
INSERT INTO phpbb_layout (lid, `name`, template, forum_wide, `view`, groups, pagetitle) VALUES(3, 'Sample 3 Column Layout', '3_column.tpl', 0, 0, '', 'Sample 3 Column Layout');
INSERT INTO phpbb_layout (lid, `name`, template, forum_wide, `view`, groups, pagetitle) VALUES(4, 'Sample 4 Column Layout', '4_column.tpl', 0, 0, '', 'Sample 4 Column Layout');
INSERT INTO phpbb_layout (lid, `name`, template, forum_wide, `view`, groups, pagetitle) VALUES(5, 'Sample 5 Column Layout', '5_column.tpl', 0, 0, '', '5 Column Layout');
INSERT INTO phpbb_layout (lid, `name`, template, forum_wide, `view`, groups, pagetitle) VALUES(6, 'Sample 6 Column Layout', '6_column.tpl', 0, 0, '', '6 Column Layout');


#IM Portal blocks

INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(1, 'Welcome to IntegraMOD', '', '<div style="width:100%"><img src="images/phpbbintegramod.jpg" style="display: block;width: 100%; height: auto;max-width:530px;margin:0 auto;overflow:hidden" /></div>', 'c', 1, 1, '', 0, 1, 1, 1000000000, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(2, 'News', '', '', 'c', 5, 0, 'blocks_imp_news', 0, 1, 1, 10000, '', 1, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(3, 'Board Navigation', '', '', '@', 2, 1, 'blocks_imp_menu', 0, 0, 0, 25000, '', 1, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(4, 'Statistics', '', '', 'r', 4, 0, 'blocks_imp_statistics', 0, 1, 1, 310, '', 1, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(5, 'Recent Topics', '', '', '@', 8, 0, 'blocks_imp_recent_topics', 0, 0, 0, 0, '', 1, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(6, 'Search', '', '', '@', 4, 0, 'blocks_imp_search', 0, 0, 1, 1000000000, '', 1, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(7, 'Links', '', '', 'r', 6, 0, 'blocks_imp_links', 0, 1, 1, 1900, '', 1, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(8, 'Active Users', '', '', 'r', 7, 0, 'blocks_imp_users_visited', 0, 1, 1, 280, '', 1, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(9, 'User Info', '', '', '@', 6, 0, 'blocks_imp_user_block', 0, 0, 0, 0, '', 1, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(10, 'Who is Online', '', '', '@', 7, 1, 'blocks_imp_online_users', 0, 0, 0, 0, '', 1, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(11, 'Mini Calendar', '', '', 'r', 3, 1, 'blocks_imp_calendar', 0, 1, 0, 0, '', 1, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(12, 'Site Survey', '', '', 'r', 1, 0, 'blocks_imp_poll', 0, 1, 0, 0, '', 1, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(13, 'Album', '', '', 'r', 5, 0, 'blocks_imp_album', 0, 1, 1, 270, '', 1, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(14, 'Visit Counter', '', '', 'r', 8, 0, 'blocks_imp_visit_counter', 0, 1, 1, 290, '', 1, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(15, 'Style Select', 'images/block_images/style_select.png', '', '@', 1, 1, 'blocks_imp_style_select', 0, 0, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(16, 'Second Menu', '', '', '@', 3, 1, 'blocks_imp_sec_menu', 0, 0, 0, 25100, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(17, 'security', '', '', '@', 5, 1, 'blocks_imp_security', 0, 0, 1, 1800, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(18, 'Referers', '', '', 'c', 4, 1, 'blocks_imp_referers', 0, 1, 1, 12250, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(19, 'Install and Configure Integramod 1.5.1', '', '<h1>Fresh Install for Integramod 1.5.1 </h1>\r\n\r\n<h2>Abbreviations used in this documentation:</h2>\r\n\r\nxxxxxx = wild card pattern .. those who are used to it its like "*" in most OS''s<br><br>\r\nchmod = name of command to change file permissions<br><br>\r\nwww.yoursite.com = to be replaced with the name of your web site<br><br>\r\nACP = Admin Control Panel<br><br>\r\n<br>\r\n<h2>Requirements:</h2>\r\n\r\n<ol type="1">\r\n    <lh><h3>In order to install IntegraMOD on your host server, you will require</h3></lh>\r\n    <li>A database source, which is MySQL3 or MySQL4 compliant. If you also have editing features like PHPMyAdmin - this may be helpful but not essential.</li><br><br>\r\n    <li>A host server with PHP Scripting 4.x. Please note IntegraMOD runs on PHP4 and PHP5 enabled hosts</li><br><br>\r\n    <li>A server space of at least 50Mb You may wish to consider more if you plan of providing</li><br>\r\n         - Multiple styles<br>\r\n         - File storage<br>\r\n         - Pictures<br>\r\n         - Attachments<br>\r\n</ul>\r\n</ol>\r\n<h2>Install:</h2>\r\n\r\n<ol type="1">\r\n<li> Upload all the files from the directory trunk (retaining the directory structure)<br>\r\n   to "public_html" or a sub directory (e.g. /forum/) on your web server</li>\r\n<br><br>\r\n<li>If your running on a *nix based OS or IIS widdows service<br>\r\n   Change the permissions of the following directories and files:<br>\r\n<Table border="1">\r\n    <tr><td align="center" >chmod</td></tr>\r\n    <tr><td align="center" >Setting</td><td>Directory or file name</td></tr>\r\n    <tr><td align="center" >777</td><td>album_mod/upload</td></tr>\r\n    <tr><td align="center" >777</td><td>album_mod/upload/cache</td></tr>\r\n    <tr><td align="center" >777</td><td>album_mod/upload/med_cache</td></tr>\r\n    <tr><td align="center" >777</td><td>album_mod/upload/wm_cache</td></tr>\r\n    <tr><td align="center" >777</td><td>backup</td></tr>\r\n    <tr><td align="center" >777</td><td>cache</td></tr>\r\n    <tr><td align="center" >666</td><td>cache/attach_config.php</td></tr>\r\n    <tr><td align="center" >777</td><td>cgi-bin/tmp</td></tr>\r\n    <tr><td align="center" >666</td><td>cgi-bin/nuffload.cgi</td></tr>\r\n    <tr><td align="center" >666</td><td>ctracker/logfiles/logfile_attempt_counter.txt</td></tr>\r\n    <tr><td align="center" >666</td><td>ctracker/logfiles/logfile_blocklist.txt</td></tr>\r\n    <tr><td align="center" >666</td><td>ctracker/logfiles/logfile_debug_mode.txt</td></tr>\r\n    <tr><td align="center" >666</td><td>ctracker/logfiles/logfile_malformed_logins.txt</td></tr>\r\n    <tr><td align="center" >666</td><td>ctracker/logfiles/logfile_spammer.txt</td></tr>\r\n    <tr><td align="center" >666</td><td>ctracker/logfiles/logfile_worms.txt</td></tr> \r\n    <tr><td align="center" >777</td><td>files</td></tr>\r\n    <tr><td align="center" >777</td><td>files/thumbs</td></tr>\r\n    <tr><td align="center" >777</td><td>images/avatars</td></tr>\r\n    <tr><td align="center" >777</td><td>images/smiles</td></tr>\r\n    <tr><td align="center" >777</td><td>images/photos</td></tr>\r\n    <tr><td align="center" >777</td><td>includes/cache_tpls</td></tr>\r\n    <tr><td align="center" >666</td><td>includes/def_auth.php</td></tr>\r\n    <tr><td align="center" >666</td><td>includes/def_icons.php</td></tr>\r\n    <tr><td align="center" >666</td><td>includes/def_qbar.php</td></tr>\r\n    <tr><td align="center" >666</td><td>includes/def_themes.php</td></tr>\r\n    <tr><td align="center" >666</td><td>includes/def_tree.php</td></tr>\r\n    <tr><td align="center" >666</td><td>includes/def_words.php</td></tr>\r\n    <tr><td align="center" >666</td><td>includes/phpbb_security.php</td></tr>\r\n    <tr><td align="center" >666</td><td>language/lang_xxxxxx/lang_contact_faq.php</td></tr>\r\n    <tr><td align="center" >666</td><td>language/lang_xxxxxx/lang_extend_xxxxxx .php</td></tr>\r\n    <tr><td align="center" >666</td><td>language/lang_xxxxxx/lang_faq.php</td></tr>\r\n    <tr><td align="center" >666</td><td>language/lang_xxxxxx/lang_faq_attach.php</td></tr>\r\n    <tr><td align="center" >666</td><td>language/lang_xxxxxx/lang_prillian_faq.php</td></tr>\r\n    <tr><td align="center" >777</td><td>modules</td></tr>\r\n    <tr><td align="center" >777</td><td>modules/cache</td></tr>\r\n    <tr><td align="center" >777</td><td>modules/cache/explain</td></tr>\r\n    <tr><td align="center" >777</td><td>pafiledb/cache</td></tr>\r\n    <tr><td align="center" >666</td><td>pafiledb/cache/data_global.php</td></tr>\r\n    <tr><td align="center" >777</td><td>pafiledb/cache/templates</td></tr>\r\n    <tr><td align="center" >777</td><td>pafiledb/cache/templates/xxxxxx</td></tr>\r\n    <tr><td align="center" >777</td><td>pafiledb/cache/templates/xxxxxx/admin</td></tr>\r\n    <tr><td align="center" >777</td><td>pafiledb/images/ss</td></tr>\r\n    <tr><td align="center" >777</td><td>pafiledb/uploads</td></tr>\r\n    <tr><td align="center" >666</td><td>profilcp/functions_profile.php</td></tr> \r\n    <tr><td align="center" >777</td><td>profilcp/def</td></tr>\r\n    <tr><td align="center" >666</td><td>profilcp/def/def_userxxxxxx.php</td></tr>\r\n    <tr><td align="center" >666</td><td>templates/xxxxxx/sub_templates.cfg</td></tr>\r\n    <tr><td align="center" >777</td><td>var_cache</td></tr>\r\n    <tr><td align="center" >666</td><td>config.php</td></tr>\r\n</table><br><br>\r\n<li>Create an empty Msql DataBase</li>\r\n<br><br>\r\n<li> Create a mySql DataBase User and assign their password</li>\r\n<br><br>\r\n<li> Add user to the DataBase with ALL privilages</li>\r\n<br><br>\r\n<li> Using your web browser<br>\r\n   visit the location where you uploaded the files with the addition of "install/install.php"<br>\r\n   (without the quotes)<br>\r\n   e.g: http://www.yoursite.com/forum/install/install.php</li>\r\n<br><br>\r\n<li> Fill out the necessary information in the installation page and submit the page<br>\r\n   (be sure that the information you specified are correct.<br>\r\n   Wrong information can result to your forum not accessible or nothing is displayed when it is accessed).</li>\r\n<br><br>\r\n<li> Click Finish Installation. (You will be redirected to the logon screen .. but don''t login yet</li>\r\n<br><br>\r\n<li> Follow the steps in installing the new prillian messenger. </li>\r\n<br><br>\r\n<li> Delete the directory "install".<br>\r\n   Do not just rename this directory. It is mandatory that this directory be deleted.</li>\r\n<br><br>\r\n<li> Delete the directory "prill_install".<br>\r\n    Do not just rename this directory. It is mandatory that this directory be deleted.</li>\r\n<br><br>\r\n<li> Change the permissions on config.php AND includes/phpbb_security.php to be writeable only by yourself (644).</li>\r\n<br><br>\r\n<li>  Using your web browser,<br>\r\n      Go to www.yoursite.com<br>\r\n      Login using the details you fill in in the installation screen</li>\r\n<br><br>\r\n<li> Fill in remaining registration details for your account</li>\r\n<br><br>\r\n<li> Click on Admin in the menu bar (or "Go to Administration Panel" at the bottom of the page)</li>\r\n<br><br>\r\n<li> it will ask you for your log in details again. you need to fill this in every session that you go to the ACP</li>\r\n<br><br>\r\n</ul>\r\n</ol>\r\nYou are now ready to Configure your system<br>\r\n<br>\r\n<h2>Basic Configuration:</h2>\r\nEnter the Admin control panel<br>\r\nYou will be asked for your log in details again.<br>\r\nYou need to fill this in every session that you go to the ACP as a security measure<br>\r\n\r\n<b>.: Security :.</b> :: <b>Special</b> -- This is the section which you have to edit whenever you add in new Admins and moderators so that the system doesn''t think that its been hacked. Change these settings to suit how you want to secure your site.<br>\r\n<br>\r\n<b>Attachments</b> :: <b>Management</b> -- Change these settings to how you''d like to allow attachments to msgs in your forum<br>\r\n<br>\r\n<b>Download</b> :: <b>Configuration</b> -- Setup your download limits and banned extentions in here<br>\r\n<br>\r\n<b>Extentions</b> :: <b>Extention Control</b> -- Check the extentions default set and add, remove as you want, need.<br>\r\n<br>\r\n<b>Extentions</b> :: <b>Special catagories</b> -- Set your settings for images in as attachments<br>\r\n<br>\r\n<b>eXtreme Styles</b> :: <b>Configuration</b> -- <b>Show on left frame</b> -- You can select what items to show on left frame in admin control panel.<br>\r\n                                                                                            (I generally select all the panel;s to show in left panel)<br>\r\n                                                                                            Set Default template directory to fisubice<br>\r\n                                                                                            Make sure that "set Add tpl filenames in html" is set to No.<br>\r\n                                                      -- <b>FTP configuration</b> -- Click on set host''s links and set path links<br>\r\n                                                                                            This will enable you to help keep track of what versions your running<br>\r\n                                                                                            Click on submit<br>\r\n<br>\r\n                   :: <b>Styles Management</b> -- <b>Set default style</b> -- Switch all users to use an IntegraMOD 1.4.x compatible style.<br>\r\n                                                                                            NOTE: It is recommended to uninstall all those styles that are NOT IntegraMOD 1.4.x compatible.<br>\r\n                                                          -- <b>Manage Cache</b> -- Click clear cache for all templates<br>\r\n                                                                                        -- Click compile cache for all templates<br>\r\n<br>\r\n<b>Forum Admin</b> :: <b>Spellcheck</b> --  Build your dictionaries (Remember part1 then part2) of each language you wish to support<br>\r\n                                                  NOTE: The Dictionaries take up a lot of DB Space. (approx 4-5mb each language)<br>\r\n                                                  Delete the /spelling/xxxxxx.dic Files once you''ve built your Dictionarys<br>\r\n<br>\r\n<b>General Admin</b> :: <b>Configuration</b> -- Set your Site Name, Description, and default language. Signature content settings, and Avatar settings</br>\r\n<br>\r\n                            :: <b>Optomize DB</b> -- Enable Cron: and set to how often you''d like your DB to be optomized<br>\r\n<br>\r\n                          :: <b>Rating System</b> -- Set rating system active to Yes.<br>\r\n                                                          If you do not want to have the rating system active in your forum, just leave it to no.<br>\r\n                                                          If you do NOT enable it, remove the link from the board navigation block through <b>General Admin</b> :: <b>Qbar</b><br>\r\n<br>\r\n<b>IM Portal</b> :: <b>Blocks Management</b> -- The cache for the following blocks must be set to No(disabled)<br>\r\n                                                           <b>Board Navigation</b><br>\r\n                                                           <b>IntegraNews</b><br>\r\n                                                           <b>Recent Topics</b><br>\r\n                                                           <b>Who is Online</b><br>\r\n<br>\r\n                    :: <b>Delete Cache Files</b> -- This will delete the cache files for the blocks<br>\r\n<br>\r\n                    :: <b>Portal Configuration</b> -- This is where you set the variables for IMPortal and Blocks eg:Scrolling links in links block<br>\r\n<br>\r\n<b>Links</b> :: <b>Configuration</b> -- Don''t forget to update the values for your own forum<br>\r\n<br>\r\n<b>News Admin</b> :: <b>Configuration</b> -- <b>News Mod Base URL</b> to the exact URL of your portal.php<br>\r\n                                                   (e.g. http://www.mysite.com/forum/portal.php)<br>\r\n<br>\r\n                                                -- <b>News Mod Index File</b> to portal.php<br>\r\n<br>\r\n<b>Photo Album</b> :: <b>Configuration</b> -- Set image Size maximums to what you want<br>\r\n<br>\r\n<b>Prillian</b> :: <b>Configuration</b> -- Finalize the settings for your Prillian installation.<br>\r\n                                                e.g: to Disable Prillian:-<br>\r\n                                                <b>Enable Instant Messaging System</b> No<br>\r\n                                                <b>Enable Network Messaging system</b> No<br>\r\n                                                <b>Over ride user settings </b> Yes<br>\r\n<br>\r\n<b>Pseudocron</b> :: <b>Cron Configuration</b> -- <b>Enable Pseudocron</b> Yes (To enable the sending of digests)<br>\r\n<br>\r\nOnce you''ve done these then feel free to familurize yourself with the rest of the Admin controls you have at your command..\r\n<br>\r\nEnjoy using <b>integramod</b> ;)\r\n<br>', 'c', 2, 1, '', 0, 2, 1, 1000, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(20, 'Downloads', '', '', 'c', 6, 0, 'blocks_imp_center_downloads', 0, 1, 1, 250, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(21, 'Donations', '', '', '@', 9, 1, 'blocks_imp_donate', 0, 0, 1, 25200, '', 1, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(22, 'clock', '', '', 'r', 2, 1, 'blocks_imp_clock', 0, 1, 0, 1000000000, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(23, 'Album', '', '', 'c', 7, 0, 'blocks_imp_album2', 0, 1, 1, 275, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(24, 'Chat', '', '', 'r', 9, 0, 'blocks_imp_chat', 2, 1, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(26, 'Announcements', '', '', 'c', 8, 1, 'blocks_imp_announcements', 0, 1, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(28, 'Newest Pic', '', '', 'r', 10, 0, 'blocks_imp_newest_pic', 0, 1, 1, 300, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(29, 'Online Users', '', '', 'r', 11, 0, 'blocks_imp_online_users2', 0, 1, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(30, 'Random Attach', '', '', 'c', 9, 0, 'blocks_imp_random_attach', 0, 1, 1, 260, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(31, 'Shoutbox', '', '', 'c', 3, 1, 'blocks_imp_shoutbox', 0, 1, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(32, 'Topics Since', '', '', 'c', 2, 1, 'blocks_imp_topics_since', 0, 1, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(33, 'Welcome', '', '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td align="center"><img src="images/phpbbintegramod.jpg" align="center"></td></tr></table>', 'c', 1, 1, '', 0, 2, 1, 10000, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(34, 'Welcome to IntegraMOD', '', '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td align="center"><img src="images/phpbbintegramod.jpg" align="center"></td></tr></table>', 'c', 1, 1, '', 0, 3, 1, 10000, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(35, 'Topics Since', '', '', 'c', 2, 1, 'blocks_imp_topics_since', 2, 3, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(36, 'Shoutbox', '', '', 'c', 3, 1, 'blocks_imp_shoutbox', 2, 3, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(37, 'Referers', '', '', 'c', 4, 1, 'blocks_imp_referers', 0, 3, 1, 10000, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(38, 'News', '', '', 'c', 6, 1, 'blocks_imp_news', 0, 3, 1, 10000, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(39, 'Announcements', '', '', 'c', 5, 1, 'blocks_imp_announcements', 0, 3, 1, 10000, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(40, 'Random Attach', '', '', 'c', 7, 0, 'blocks_imp_random_attach', 2, 3, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(41, 'Calendar', '', '', 'r', 1, 1, 'blocks_imp_calendar', 0, 3, 1, 10000, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(42, 'Site Survey', '', '', 'r', 2, 1, 'blocks_imp_poll', 0, 3, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(43, 'clock', '', '', 'r', 3, 1, 'blocks_imp_clock', 0, 3, 1, 10000, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(44, 'Statistics', '', '', 'r', 4, 1, 'blocks_imp_statistics', 0, 3, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(45, 'Links', '', '', 'r', 5, 1, 'blocks_imp_links', 0, 3, 1, 10000, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(46, 'Active Users', '', '', 'r', 6, 1, 'blocks_imp_users_visited', 0, 3, 1, 280, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(47, 'Visit Counter', '', '', 'r', 7, 1, 'blocks_imp_visit_counter', 0, 3, 1, 280, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(48, 'Board Navigation', '', '', 'l', 2, 1, 'blocks_imp_menu', 0, 3, 1, 10000, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(49, 'Style Select', '', '', 'l', 1, 1, 'blocks_imp_style_select', 0, 3, 1, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(50, 'Second Menu', '', '', 'l', 3, 1, 'blocks_imp_sec_menu', 0, 3, 1, 10000, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(51, 'Search', '', '', 'l', 4, 1, 'blocks_imp_search', 0, 3, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(52, 'security', '', '', 'l', 5, 1, 'blocks_imp_security', 0, 3, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(53, 'User Info', '', '', 'l', 6, 1, 'blocks_imp_user_block', 0, 3, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(54, 'Who is Online', '', '', 'l', 7, 1, 'blocks_imp_online_users', 0, 3, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(55, 'Recent Topics', '', '', 'l', 8, 1, 'blocks_imp_recent_topics', 2, 3, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(56, 'Donations', '', '', 'l', 9, 1, 'blocks_imp_donate', 0, 3, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(57, 'Welcome to IntegraMOD', '', '<div style="width:100%""><img src="images/phpbbintegramod.jpg" style="display: block;width: 100%; height: auto;max-width:530px;margin:0 auto;overflow:hidden" /></div>', 't', 1, 1, '', 0, 4, 1, 10000, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(58, 'Style Select', '', '', 'd', 1, 1, 'blocks_imp_style_select', 0, 4, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(59, 'Board Navigation', '', '', 'c', 1, 1, 'blocks_imp_menu', 0, 4, 1, 10000, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(60, 'Second Menu', '', '', 'c', 2, 1, 'blocks_imp_sec_menu', 0, 4, 1, 10000, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(61, 'clock', '', '', 'd', 2, 1, 'blocks_imp_clock', 0, 4, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(62, 'Calendar', '', '', 'd', 3, 1, 'blocks_imp_calendar', 0, 4, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(63, 'Statistics', '', '', 'd', 4, 1, 'blocks_imp_statistics', 0, 4, 1, 10000, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(64, 'Referers', '', '', 'b', 1, 1, 'blocks_imp_referers', 0, 4, 0, 280, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(65, 'Shoutbox', '', '', 'b', 2, 1, 'blocks_imp_shoutbox', 0, 4, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(66, 'Shoutbox', '', '', 'b', 1, 1, 'blocks_imp_shoutbox', 0, 5, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(67, 'Ads', '', '[b:41cb1c71a9][size=18:41cb1c71a9]This is an html/bbcode block that could contain site advertisements[/size:41cb1c71a9][/b:41cb1c71a9]', 'b', 2, 1, '', 0, 5, 1, 10000, '41cb1c71a9', 1, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(68, 'Board Navigation', '', '', '1', 1, 1, 'blocks_imp_menu', 0, 6, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(69, 'Second Menu', '', '', '1', 2, 1, 'blocks_imp_sec_menu', 0, 6, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(70, 'Calendar', '', '', '6', 1, 1, 'blocks_imp_calendar', 0, 6, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(71, 'Statistics', '', '', '5', 1, 1, 'blocks_imp_statistics', 0, 6, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(72, 'Who is Online', '', '', '6', 3, 1, 'blocks_imp_online_users', 0, 6, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(73, 'clock', '', '', '6', 2, 1, 'blocks_imp_clock', 0, 6, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(74, 'Recent Articles', '', '', '2', 1, 1, 'blocks_imp_recent_articles', 0, 6, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(75, 'Recent Topics', '', '', '2', 2, 1, 'blocks_imp_recent_topics', 0, 6, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(76, 'User Info', '', '', '3', 1, 1, 'blocks_imp_user_block', 0, 6, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(77, 'Links', '', '', '4', 1, 1, 'blocks_imp_links', 0, 6, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(78, 'Welcome to IntegraMOD', '', '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td align="center"><img src="images/phpbbintegramod.jpg" align="center"></td></tr></table>', 't', 1, 1, '', 0, 5, 0, 10000, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(79, 'Security', '', '', 'l', 1, 1, 'blocks_imp_security', 0, 5, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(80, 'Style Select', '', '', 'l', 2, 1, 'blocks_imp_style_select', 0, 5, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(81, 'Board Navigation', '', '', 'l', 3, 1, 'blocks_imp_menu', 0, 5, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(82, 'Second Menu', '', '', 'l', 4, 1, 'blocks_imp_sec_menu', 0, 5, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(83, 'Announcements', '', '', 'c', 1, 1, 'blocks_imp_announcements', 0, 5, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(84, 'News', '', '', 'c', 2, 0, 'blocks_imp_news', 0, 5, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(85, 'Referers', '', '', 'c', 4, 1, 'blocks_imp_referers', 0, 5, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(86, 'Recent Topics', '', '', 'c', 3, 1, 'blocks_imp_recent_topics', 0, 5, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(87, 'Calendar', '', '', 'r', 1, 1, 'blocks_imp_calendar', 0, 5, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(88, 'Site Survey', '', '', 'r', 2, 1, 'blocks_imp_poll', 0, 5, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(89, 'User Info', '', '', 'r', 4, 1, 'blocks_imp_user_block', 0, 5, 0, 0, '', 0, 1, 1, 1, 1, 1, '');
INSERT INTO phpbb_blocks (bid, title, title_image, content, bposition, weight, active, blockfile, view, layout, cache, cache_time, block_bbcode_uid, type, border, titlebar, openclose, background, local, groups) VALUES(90, 'Chatbox', '', '', 'r', 3, 1, 'blocks_imp_chat', 2, 5, 0, 0, '', 0, 1, 1, 1, 1, 1, '');


-- --------------------------------------------------------

--
-- Table structure for table 'phpbb_block_position'
--

CREATE TABLE IF NOT EXISTS phpbb_block_position (
  bpid int(10) NOT NULL auto_increment,
  pkey varchar(30) collate utf8_bin NOT NULL default '',
  bposition char(1) collate utf8_bin NOT NULL default '',
  layout int(10) NOT NULL default '1',
  PRIMARY KEY  (bpid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=80 ;

--
-- Dumping data for table 'phpbb_block_position'
--



INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(1, 'header', '@', 0);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(2, 'footer', '*', 0);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(3, 'right', 'r', 1);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(4, 'center', 'c', 1);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(5, 'center', 'c', 2);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(6, 'right', 'r', 3);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(7, 'center', 'c', 3);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(8, 'left', 'l', 3);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(9, 'toprow', 't', 4);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(10, 'column1', 'c', 4);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(11, 'column2', 'd', 4);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(12, 'bottomrow', 'b', 4);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(13, 'right', 'r', 5);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(14, 'bottomrow', 'b', 5);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(15, 'center', 'c', 5);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(16, 'toprow', 't', 5);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(17, 'left', 'l', 5);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(18, 'col_1', '1', 6);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(19, 'col_2', '2', 6);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(20, 'col_3', '3', 6);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(21, 'col_4', '4', 6);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(22, 'col_5', '5', 6);
INSERT INTO phpbb_block_position (bpid, pkey, bposition, layout) VALUES(23, 'col_6', '6', 6);


INSERT INTO phpbb_acronyms (acronym_id, acronym, description) VALUES (1, 'IntegraMOD', 'The best phpBB pre-modded package that ever exists. (www.integramod.com).');


INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Afghanistan','afghanistan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Albania','albania.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Algeria','algeria.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Andorra','andorra.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Angola','angola.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Antigua and Barbuda','antiguabarbuda.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Argentina','argentina.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Armenia','armenia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Australia','australia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Austria','austria.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Azerbaijan','azerbaijan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Bahamas','bahamas.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Bahrain','bahrain.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Bangladesh','bangladesh.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Barbados','barbados.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Belarus','belarus.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Belgium','belgium.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Belize','belize.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Benin','benin.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Bhutan','bhutan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Bolivia','bolivia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Bosnia Herzegovina','bosnia_herzegovina.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Botswana','botswana.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Brazil','brazil.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Brunei','brunei.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Bulgaria','bulgaria.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Burkina Faso','burkinafaso.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Burma','burma.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Burundi','burundi.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Cambodia','cambodia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Cameroon','cameroon.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Canada','canada.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Central African Rep','centralafricanrep.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Chad','chad.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Chile','chile.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','China','china.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Columbia','columbia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Comoros','comoros.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Congo','congo.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Costa Rica','costarica.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Croatia','croatia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Cuba','cuba.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Cyprus','cyprus.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Czech Republic','czechrepublic.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Dem Rep Congo','demrepcongo.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Denmark','denmark.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Djibouti','djibouti.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Dominica','dominica.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Dominican Rep','dominicanrep.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Ecuador','ecuador.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Egypt','egypt.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','El Salvador','elsalvador.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Eq Guinea','eq_guinea.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Eritrea','eritrea.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Estonia','estonia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Ethiopia','ethiopia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Fiji','fiji.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Finland','finland.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','France','france.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Gabon','gabon.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Gambia','gambia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Georgia','georgia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Germany','germany.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Ghana','ghana.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Greece','greece.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Grenada','grenada.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Grenadines','grenadines.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Guatemala','guatemala.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Guinea','guinea.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Guinea Bissau','guineabissau.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Guyana','guyana.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Haiti','haiti.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Honduras','honduras.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Hong Kong','hong_kong.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Hungary','hungary.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Iceland','iceland.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','India','india.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Indonesia','indonesia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Iran','iran.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Iraq','iraq.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Ireland','ireland.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Israel','israel.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Italy','italy.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Ivory Coast','ivorycoast.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Jamaica','jamaica.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Japan','japan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Jordan','jordan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Kazakhstan','kazakhstan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Kenya','kenya.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Kiribati','kiribati.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Kuwait','kuwait.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Kyrgyzstan','kyrgyzstan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Laos','laos.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Latvia','latvia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Lebanon','lebanon.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Liberia','liberia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Libya','libya.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Liechtenstein','liechtenstein.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Lithuania','lithuania.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Luxembourg','luxembourg.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Macadonia','macadonia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Macau','macau.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Madagascar','madagascar.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Malawi','malawi.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Malaysia','malaysia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Maldives','maldives.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Mali','mali.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Malta','malta.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Mauritania','mauritania.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Mauritius','mauritius.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Mexico','mexico.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Micronesia','micronesia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Moldova','moldova.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Monaco','monaco.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Mongolia','mongolia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Morocco','morocco.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Mozambique','mozambique.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Namibia','namibia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Nauru','nauru.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Nepal','nepal.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Neth Antilles','neth_antilles.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Netherlands','netherlands.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','New Zealand','newzealand.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Nicaragua','nicaragua.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Niger','niger.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Nigeria','nigeria.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','North Korea','north_korea.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Norway','norway.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Oman','oman.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Pakistan','pakistan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Panama','panama.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Papua New Guinea','papuanewguinea.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Paraguay','paraguay.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Peru','peru.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Philippines','philippines.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Poland','poland.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Portugal','portugal.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Puerto Rico','puertorico.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Qatar','qatar.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Quebec','quebec.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Rawanda','rawanda.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Romania','romania.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Russia','russia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Sao Tome','sao_tome.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Saudi Arabia','saudiarabia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Senegal','senegal.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Serbia','serbia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Seychelles','seychelles.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Sierra Leone','sierraleone.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Singapore','singapore.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Slovakia','slovakia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Slovenia','slovenia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Solomon Islands','solomon_islands.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Somalia','somalia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','South Korea','south_korea.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','South Africa','southafrica.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Spain','spain.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Sri Lanka','srilanka.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','St Kitts Nevis','stkitts_nevis.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','St Lucia','stlucia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Sudan','sudan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Suriname','suriname.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Sweden','sweden.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Switzerland','switzerland.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Syria','syria.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Taiwan','taiwan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Tajikistan','tajikistan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Tanzania','tanzania.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Thailand','thailand.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Togo','togo.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Tonga','tonga.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Trinidad and Tobago','trinidadandtobago.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Tunisia','tunisia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Turkey','turkey.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Turkmenistan','turkmenistan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Tuvala','tuvala.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','United Arab Emirates','uae.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Uganda','uganda.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','United Kingdom','uk.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Ukraine','ukraine.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Uruguay','uruguay.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','United States of America','usa.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','USSR','ussr.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Uzbekistan','uzbekistan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Vanuatu','vanuatu.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Venezuela','venezuela.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Vietnam','vietnam.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Western Samoa','western_samoa.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Yemen','yemen.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Yugoslavia','yugoslavia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Zaire','zaire.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Zambia','zambia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','Zimbabwe','zimbabwe.gif');

#
# Basic DB data for Prillian Messenger
#

INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip) VALUES (1, 'Googlebot', 'Googlebot', '', '0', '0', '', '', '216.239.46.|64.68.8|64.68.9|164.71.1.|192.51.44.');
INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip) VALUES (2, 'Alexa', 'ia_archiver', '', '0', '0', '', '', '66.28.250.|209.237.238.');
INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip) VALUES (3, 'Inktomi', 'Slurp/', '', '0', '0', '', '', '216.35.116.|66.196.|66.94.230.|202.212.5.');
INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip) VALUES (4, 'Infoseek', 'Infoseek', '', '0', '0', '', '', '204.162.9|205.226.203|206.3.30.|210.236.233.');
INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip) VALUES (5, 'Alta Vista', 'Scooter', '', '0', '0', '', '', '194.221.84.|204.123.28.|208.221.35|212.187.226.|66.17.148.');
INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip) VALUES (6, 'Lycos', 'Lycos', '', '0', '0', '', '', '208.146.27.|209.202.19|209.67.22|202.232.118.');
INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip) VALUES (7, 'FAST', 'alltheweb', '', '0', '0', '', '', '146.101.142.2|216.35.112.|64.41.254.2|213.188.8.');
INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip) VALUES (8, 'WiseNut', 'WISEnut', '', '0', '0', '', '', '64.241.243.|209.249.67.1|216.34.42.|66.35.208.');
INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip) VALUES (9, 'MSN', 'msnbot/', '', '0', '0', '', '', '131.107.3.|204.95.98.|131.107.1|65.54.164.95');
INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip) VALUES (10, 'Looksmart', 'MARTINI', '', '0', '0', '', '', '64.241.242.|207.138.42.212');
INSERT INTO phpbb_bots (bot_id, bot_name, bot_agent, last_visit, bot_visits, bot_pages, pending_agent, pending_ip, bot_ip) VALUES (11, 'Ask Jeeves', 'teoma', '', '0', '0', '', '', '216.200.130.|216.34.121.|63.236.92.1|64.55.148.|65.192.195.|65.214.36.');

INSERT INTO phpbb_pa_cat VALUES (1, 'My Category', '', 0, '', 1, 0, 1, 1, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO phpbb_pa_cat VALUES (2, 'Test Category', 'Just a test category', 1, '', 2, 1, 1, 1, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

INSERT INTO phpbb_pa_config VALUES ('allow_comment_images', '1');
INSERT INTO phpbb_pa_config VALUES ('no_comment_image_message', '[No image please]');
INSERT INTO phpbb_pa_config VALUES ('allow_smilies', '1');
INSERT INTO phpbb_pa_config VALUES ('allow_comment_links', '1');
INSERT INTO phpbb_pa_config VALUES ('no_comment_link_message', '[No links please]');
INSERT INTO phpbb_pa_config VALUES ('settings_disable', '0');
INSERT INTO phpbb_pa_config VALUES ('allow_html', '1');
INSERT INTO phpbb_pa_config VALUES ('allow_bbcode', '1');
INSERT INTO phpbb_pa_config VALUES ('settings_topnumber', '10');
INSERT INTO phpbb_pa_config VALUES ('settings_newdays', '7');
INSERT INTO phpbb_pa_config VALUES ('settings_stats', '');
INSERT INTO phpbb_pa_config VALUES ('settings_viewall', '1');
INSERT INTO phpbb_pa_config VALUES ('settings_dbname', 'Download Database');
INSERT INTO phpbb_pa_config VALUES ('settings_dbdescription', '');
INSERT INTO phpbb_pa_config VALUES ('max_comment_chars', '5000');
INSERT INTO phpbb_pa_config VALUES ('tpl_php', '0');
INSERT INTO phpbb_pa_config VALUES ('settings_file_page', '20');
INSERT INTO phpbb_pa_config VALUES ('hotlink_prevent', '1');
INSERT INTO phpbb_pa_config VALUES ('hotlink_allowed', '');
INSERT INTO phpbb_pa_config VALUES ('sort_method', 'file_time');
INSERT INTO phpbb_pa_config VALUES ('sort_order', 'DESC');
INSERT INTO phpbb_pa_config VALUES ('need_validation', '0');
INSERT INTO phpbb_pa_config VALUES ('validator', 'validator_admin');
INSERT INTO phpbb_pa_config VALUES ('pm_notify', '0');
INSERT INTO phpbb_pa_config (config_name, config_value) VALUES ('auth_search','0');
INSERT INTO phpbb_pa_config (config_name, config_value) VALUES ('auth_stats','0');
INSERT INTO phpbb_pa_config (config_name, config_value) VALUES ('auth_toplist','0');
INSERT INTO phpbb_pa_config (config_name, config_value) VALUES ('auth_viewall','0');
INSERT INTO phpbb_pa_config (config_name, config_value) VALUES ('max_file_size','262144');
INSERT INTO phpbb_pa_config (config_name, config_value) VALUES ('upload_dir','pafiledb/uploads/');
INSERT INTO phpbb_pa_config (config_name, config_value) VALUES ('screenshots_dir','pafiledb/images/ss/');
INSERT INTO phpbb_pa_config (config_name, config_value) VALUES ('forbidden_extensions','php, php3, php4, phtml, pl, asp, aspx, cgi');

INSERT INTO phpbb_rating_config VALUES ('Rating system active',0,NULL,1,3,100);
INSERT INTO phpbb_rating_config VALUES ('Weighting method',1,NULL,3,3,300);
INSERT INTO phpbb_rating_config VALUES ('Users can change ratings',1,NULL,4,3,400);
INSERT INTO phpbb_rating_config VALUES ('Max daily ratings (0=unlimited)',10,NULL,5,2,500);
INSERT INTO phpbb_rating_config VALUES ('Show who rated',1,NULL,6,3,600);
INSERT INTO phpbb_rating_config VALUES ('Allow users to hide name',1,NULL,7,3,700);
INSERT INTO phpbb_rating_config VALUES ('Rate first post only',0,NULL,2,3,200);
INSERT INTO phpbb_rating_config VALUES ('Overall ranking method: posts',1,NULL,8,3,800);
INSERT INTO phpbb_rating_config VALUES ('Overall ranking method: topics',1,NULL,9,3,900);
INSERT INTO phpbb_rating_config VALUES ('Overall ranking method: users',1,NULL,10,3,1000);
INSERT INTO phpbb_rating_config VALUES ('Max daily ratings per user',1,NULL,13,2,550);
INSERT INTO phpbb_rating_config VALUES ('Open in new window',1,NULL,14,3,1400);
INSERT INTO phpbb_rating_config VALUES ('Min. post count',5,NULL,15,2,240);
INSERT INTO phpbb_rating_config VALUES ('Min. days registered',7,NULL,16,2,250);
INSERT INTO phpbb_rating_config VALUES ('Bias system active',1,NULL,11,3,1100);
INSERT INTO phpbb_rating_config VALUES ('Show bias usernames?',1,NULL,17,3,1150);
INSERT INTO phpbb_rating_config VALUES ('Show dropdown in viewtopic?',1,NULL,18,3,1800);
INSERT INTO phpbb_rating_config VALUES ('Show dropdown in viewforum?',0,NULL,19,3,1900);

INSERT INTO phpbb_rating_option VALUES (1,2,'Highly recommended',5,1);
INSERT INTO phpbb_rating_option VALUES (2,1,'Recommended',0,1);
INSERT INTO phpbb_rating_option VALUES (3,5,'Moderator-recommended',0,3);

INSERT INTO phpbb_rating_rank VALUES (2,5,2,5,'Worth a look','2star_green.gif',0);
INSERT INTO phpbb_rating_rank VALUES (3,5,4,20,'Impressive','4star_green.gif',0);
INSERT INTO phpbb_rating_rank VALUES (6,5,1,1,'Acknowledged','1star_green.gif',0);
INSERT INTO phpbb_rating_rank VALUES (7,5,3,10,'Quality','3star_green.gif',0);
INSERT INTO phpbb_rating_rank VALUES (8,5,5,40,'Inspired','5star_green.gif',0);
INSERT INTO phpbb_rating_rank VALUES (11,4,1,2,'Acknowledged','1star_cyan.gif',0);
INSERT INTO phpbb_rating_rank VALUES (12,4,2,10,'Worth a look','2star_cyan.gif',0);
INSERT INTO phpbb_rating_rank VALUES (13,4,3,20,'Quality','3star_cyan.gif',0);
INSERT INTO phpbb_rating_rank VALUES (14,4,4,40,'Impressive','4star_cyan.gif',0);
INSERT INTO phpbb_rating_rank VALUES (15,4,5,80,'Inspired','5star_cyan.gif',0);

INSERT INTO phpbb_optimize_db VALUES ('0', 86400, 0, 0, '1', '', '0');

INSERT INTO phpbb_link_categories (cat_id, cat_title, cat_order) VALUES (1, 'Arts', 1);
INSERT INTO phpbb_link_categories (cat_id, cat_title, cat_order) VALUES (2, 'Business', 2);
INSERT INTO phpbb_link_categories (cat_id, cat_title, cat_order) VALUES (3, 'Children and Teens', 3);
INSERT INTO phpbb_link_categories (cat_id, cat_title, cat_order) VALUES (4, 'Computers', 4);
INSERT INTO phpbb_link_categories (cat_id, cat_title, cat_order) VALUES (5, 'Games', 5);
INSERT INTO phpbb_link_categories (cat_id, cat_title, cat_order) VALUES (6, 'Health', 6);
INSERT INTO phpbb_link_categories (cat_id, cat_title, cat_order) VALUES (7, 'Home', 7);
INSERT INTO phpbb_link_categories (cat_id, cat_title, cat_order) VALUES (8, 'News', 8);

INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('site_logo', 'http://www.integramod.com/home/images/banners/integra_88x31.gif');
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('site_url', 'http://www.integramod.com');
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('width', '88');
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('height', '31');
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('linkspp', '10');
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('display_interval', '6000');
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('display_logo_num', '10');
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('display_links_logo', '1');
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('email_notify', '1');
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('lock_submit_site', '0');
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('allow_no_logo', '0');

INSERT INTO phpbb_links (link_id, link_title, link_desc, link_category, link_url, link_logo_src, link_joined, link_active, link_hits, user_id, user_ip, last_user_ip) VALUES (1, 'phpBB Official Website', 'Official phpBB Website', 4, 'http://www.phpbb.com/', 'images/banners/phpBB_88a.gif', 1088006815, 1, 0, 2, '', '');
INSERT INTO phpbb_links (link_id, link_title, link_desc, link_category, link_url, link_logo_src, link_joined, link_active, link_hits, user_id, user_ip, last_user_ip) VALUES (2, 'phpbbhacks', 'Place of phpbb modifications', 4, 'http://www.phpbbhacks.com', 'images/banners/phpbbhacks.gif', 1088006815, 1, 0, 2, '', '');
INSERT INTO phpbb_links (link_id, link_title, link_desc, link_category, link_url, link_logo_src, link_joined, link_active, link_hits, user_id, user_ip, last_user_ip) VALUES (3, 'IntegraMOD', 'The best pre-modded version of phpBB', 4, 'http://www.integramod.com', 'images/banners/integra_88x31.gif', 1088006815, 1, 1, 2, '', '7f000001');
INSERT INTO phpbb_links (link_id, link_title, link_desc, link_category, link_url, link_logo_src, link_joined, link_active, link_hits, user_id, user_ip, last_user_ip) VALUES (4, 'Forumimages.com', 'forumimages.co.uk', 4, 'http://www.forumimages.co.uk', 'images/banners/forum_images_banner_88x31.gif', 1088006815, 1, 0, 2, '', '');
INSERT INTO phpbb_rules (date, rules, pm_subject, pm_message) VALUES (1088516758, 'While the administrators and moderators of this forum will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every message. Therefore you acknowledge that all posts made to these forums express the views and opinions of the author and not the administrators, moderators or webmaster (except for posts by these people) and hence will not be held liable.\r\n<br /><br />\r\nYou agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-oriented or any other material that may violate any applicable laws. Doing so may lead to you being immediately and permanently banned (and your service provider being informed). The IP address of all posts is recorded to aid in enforcing these conditions. You agree that the webmaster, administrator and moderators of this forum have the right to remove, edit, move or close any topic at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent, the webmaster, administrator and moderators cannot be held responsible for any hacking attempt that may lead to the data being compromised.\r\n<br /><br />\r\nThis forum system uses cookies to store information on your local computer. These cookies do not contain any of the information you have entered above; they serve only to improve your viewing pleasure. The e-mail address is used only for confirming your registration details and password (and for sending new passwords should you forget your current one).', 'Attention the Rules has been updated.', 'The Rules on this Forum has been updated for so much we invite you to read again it.  \r\n  \r\nThe Administrator');

INSERT INTO phpbb_hacks_list VALUES (18, 'Hacks List', 'Provides an admin panel for you to enter information about hacks you have installed on your board.', 'Nivisec', 'support@nivisec.com', 'http://www.nivisec.com/', '1.20', 'No', 'http://www.nivisec.com/downloads/phpbb/hacks_list.zip', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (4, 'Admin Private Message Manager', 'An Admin panel plug in that allows the management of Private Messages on the board. You may sort by a variety of options, delete any PMs you choose, or optionally archive them for later use.', 'Nivisec', 'support@nivisec.com', 'http://www.nivisec.com/', '1.5.1', 'No', 'http://www.nivisec.com/downloads/phpbb/admin_prv_msgs.zip', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (7, 'Admin Userlist', 'This MOD lets you view a list of every user on your board from the ACP.  While browsing the list you can activate, de-activate, delete, and ban multiple users at a time.  You can also edit one users permissions or manage their account.  Also see how many', 'wGEric', 'eric@egcnetwork.com', 'http://mods.best-dev.com/', '2.0.1', 'No', 'http://eric.best-1.biz', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (12, 'File Attachment Mod v2', 'This Mod adds the ability to attach files in phpBB2.', 'Acyd Burn', '', 'http://www.opentools.de', '2.3.10', 'No', 'http://www.opentools.de', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (13, 'Auto group', 'This mod will make it posible to add member to a user group, depending on there post count this makes it posible to make a group \\"Everyone\\" (0 posts) where all members are members by default or a group like \\"Posters\\" (1 posts) where all users witch ha', 'Niels Chr. Denmark', 'ncr@db9.dk', 'http://mods.db9.dk', '1.2.1', 'No', 'http://mods.db9.dk', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (15, 'Complete banner', 'This mod makes it posible to add banners to your phpbb2 pages, by default banners are placed in top/botton but you may place the tags, inside any template file.', 'Niels Chr. RÃ¸d', 'ncr@db9.dk', 'http://mods.db9.dk', '1.3.4', 'No', 'http://mods.db9.dk', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (16, 'phpBB2 Fast Hack', 'This makes your phpBB 2 forum faster.', 'dwing', 'dwing@weingarten-net.de', 'http://www.weingarten-net.de', '1.0.0', 'No', 'http://www.weingarten-net.de', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (19, 'IntegraMOD', 'A pre-modded version of phpBB which integrates the best and most useful phpBB modifications.', 'masterdavid', 'webmaster@integramod.com', 'http://www.integramod.com', '1.5.1', 'No', 'http://www.integramod.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (20, 'IM Portal', 'A flexible and powerful portal addon for phpBB with dynamic blocks, multiple portal pages, display permissions and a dynamic cache system.', 'masterdavid', 'webmaster@integramod.com', 'http://www.integramod.com', '1.2.0', 'No', 'http://www.integramod.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (21, 'Slash News Mod', 'Allows you to assign a news category to any new topic. The topic can then be displayed as news with a category graphic like Slashdot.', 'CodeMonkeyX', 'nickyoungso@yahoo.com', 'http://www.codemonkeyx.net', '1.0.1', 'No', 'http://www.codemonkeyx.net', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (22, 'Forum Tour', 'Add a forum tour to your phpBB via ACP.', 'OXPUS', 'webmaster@oxpus.de', 'http://www.oxpus.de', '1.0.3', 'No', 'http://www.oxpus.de', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (23, 'Junior Admin', 'This will allow you to define any and all users you''d like to have access to whatever admin modules you''d like.', 'Nivisec', 'support@nivisec.com', 'http://www.nivisec.com', '2.0.5', 'No', 'http://www.nivisec.com/phpbb.php?l=p', '../hl/jr_admin_by_nivisec.hl', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (24, 'Left and Right IMG tags', 'This MOD will allow you to better format you posts by aligning images left and right instead of just in-line as with the standard [img][/img] tag. Text will also neatly wrap around the images.', 'Nuttzy', 'pktoolkit@blizzhackers.com', 'http://www.blizzhackers.com', '1.6.0', 'No', 'http://www.blizzhackers.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (25, 'Mini Cal', 'Mini Calendar version of the Forum Calendar', 'netclectic', 'adrian@netclectic.com', 'http://www.netclectic.com/', '2.0.2', 'No', 'http://www.netclectic.com/', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (26, 'Photo Album integration 4 PCP', 'This Mod integrates the Photo album by Smartor into the Profile Control Panel Mod', 'G-Funk', 'G-Funk@gmx.at', 'http://rpgnet.clanmckeen.com/demo/', '0.1.4', 'No', 'http://rpgnet.clanmckeen.com/demo/', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (27, 'Announces Suite', 'This mod allows you to display the announces from the forum on the index page, and above the forum pages for the announce coming from forums of the same categories. It adds also a duration to each announcement, and global announcement.', 'Ptirhiik', 'admin@rpgnet-fr.com', 'http://rpgnet.clanmckeen.com/demo', '3.0.2', 'No', 'http://rpgnet.clanmckeen.com/demo', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (28, 'Categories hierarchy', 'This mod allows to attach a categorie to a higher level categorie, keeping all the forum visible on the index page (vBulletin-like view), or have a sub-forum view.', 'Ptirhiik', 'ptirhiik@clanmckeen.com', 'http://rpgnet.clanmckeen.com/demo', '2.0.4', 'No', 'http://rpgnet.clanmckeen.com/demo', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (29, 'Group ModeratorZ', 'This mod allows to have more than one moderator to a group', 'Ptirhiik', 'ptirhiik@clanmckeen.com', 'http://rpgnet.clanmckeen.com/demo', '1.0.1', 'No', 'http://rpgnet.clanmckeen.com/demo', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (30, 'Keep unread topic', 'This mod keeps the unread flag active until the topic is read', 'Ptirhiik', 'ptirhiik@clanmckeen.com', 'http://rpgnet.clanmckeen.com/demo', '1.0.0', 'No', 'http://rpgnet.clanmckeen.com/demo', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (31, 'Post Icons', 'This mod will allow to add an icon in front of each topic title.', 'Ptirhiik', 'ptirhiik@clanmckeen.com', 'http://rpgnet.clanmckeen.com/demo', '1.0.1', 'No', 'http://rpgnet.clanmckeen.com/demo', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (32, 'Profile Control Panel', 'This mod is a rewrite of the user management, including new features', 'Ptirhiik', 'ptirhiik@clanmckeen.com', 'http://rpgnet.clanmckeen.com/demo', '2.0.0-1', 'No', 'http://rpgnet.clanmckeen.com/demo', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (33, 'Split topic type', 'This mod splits the topic per type in the viewform display', 'Ptirhiik', 'ptirhiik@clanmckeen.com', 'http://rpgnet.clanmckeen.com/demo', '2.0.1', 'No', 'http://rpgnet.clanmckeen.com/demo', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (34, 'Topic calendar', 'This mod adds a calendar to your board, working with natural phpBB auth', 'Ptirhiik', 'ptirhiik@clanmckeen.com', 'http://rpgnet.clanmckeen.com/demo', '1.0.1', 'No', 'http://rpgnet.clanmckeen.com/demo', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (35, 'Page Generation Time', 'This MOD will show page generation info in the page footer', 'Smartor', 'smartor_xp@hotmail.com', 'http://smartor.is-root.com', '2.0.0', 'No', 'http://smartor.is-root.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (36, 'PHP Syntax Highlighter BBCode', 'Highlights PHP specific code when used.', 'Fubonis', 'php_fubonis@yahoo.com', 'http://www.fubonis.com', '3.0.4', 'No', 'http://www.fubonis.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (37, 'Approve Mod', 'Designate a forum for moderation by admins & chosen moderators', 'Aceman', 'phpbbmods@synace.com', 'http://www.synace.com', '1.0.9', 'No', 'http://www.synace.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (38, 'PHP Info', 'This Mod shows the PHP Info in your Admin Panel.', 'Dwing', 'dwing@weingarten-net.de', 'http://www.dseitz.de', '1.1.2', 'No', 'http://www.dseitz.de', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (40, 'Quick Reply with Quote', 'This will add a quick-reply form below every topics', 'Smartor', 'smartor_xp@hotmail.com', 'http://smartor.is-root.com', '1.1.3', 'No', 'http://smartor.is-root.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (41, 'Rebuild Search Mod', 'This will index every post in your phpBB, rebuilding the search tables', 'GUI', 'spam@nickm.org', 'http://www.nickm.org/', '1.0.0', 'No', 'http://www.nickm.org/', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (43, 'Send PM On User Registration', 'This MOD will send a PM to all new users when they register', 'AbelaJohnB', 'abela@phpbb.com', 'http://www.JohnAbela.Com', '1.0.4', 'No', 'http://www.JohnAbela.Com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (44, 'Fully integrated shoutbox', 'A fully phpBB2 enabled shoutbox', 'Niels Chr. RÃ¸d', 'ncr@db9.dk', 'http://mods.db9.dk ', '1.0.10', 'No', 'http://mods.db9.dk ', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (45, 'Statistics Mod', 'The Statistics Mod is a complete statistics core for your phpBB 2 board', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de/board', '3.0.0', 'No', 'http://www.opentools.de/board', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (46, 'Topic Description', 'This MOD allow you to add a little description of the topic that you have posted', 'Morpheus2matrix', 'morpheus2matrix@caramail.com', 'http://morpheus.2037.biz', '1.0.5', 'No', 'http://morpheus.2037.biz', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (47, 'Usergroup Auto Join', 'Creates a usergroup category that allows a user to join without needing the approval of the group moderator', 'LifeIsPain', 'brian@orvp.net', '', '1.0.0', 'No', '', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (48, 'Users of the day', 'Displays a list of the users who come during the last XX hours, which scrolls', 'fmavani', 'webmaster@feroz.org', 'http://feroz.domehost.com/forum', '3.0.0', 'No', 'http://feroz.domehost.com/forum', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (49, 'Text-based Visit Counter', 'This will add a visit counter into your phpBB', 'Smartor', 'smartor_xp@hotmail.com', 'http://smartor.is-root.com', '1.1.1', 'No', 'http://smartor.is-root.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (51, 'Add status to topic', 'This hack shows you how to add an info or status to a topic', 'Acid', '', '', '1.0.3', 'No', 'http://www.phpbbhacks.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (52, 'Admin-Mods List Page', 'This hack produces a simple to understand page that shows anyone with any power other than that of a normal user in the ACP', 'Woody', 'woody@scoobler.com', '', '1.1.1', 'No', '', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (53, 'BBcode Strike', 'This mod allows you to bar some text', 'R0cKW|LDeR', 'da_rockwilder_rw@yahoo.fr', '', '1.0', 'No', '', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (54, 'Acronym Mod', 'Provides automatic acroymn additions to posts.', 'CodeMonkeyX', 'nickyoungso@yahoo.com', '', '0.9.4', 'No', '', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (55, 'Country Flags for Profile Control Panel', 'This addon allows your registered board members to select the flag country of their residence', 'GilGraf', 'webmaster@ggweb-fr.com', 'http://ggweb-fr.com/phpbbfre', '2.0.3', 'No', '', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (56, 'Digests', 'Sends customized email digests of forum messages to subscribers', 'Indemmity83', 'Indemnity83@dormlife.us', 'http://www.dormlife.us', '1.2.0', 'No', 'http://www.dormlife.us', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (57, 'Disable Board Message', 'Customize disable board message', 'Sko22', 'webmaste@quellicheilpc.com', 'http://www.quellicheilpc.com/', '1.0.0', 'No', 'http://www.quellicheilpc.com/', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (58, 'Gender PCP Pic', 'This Mod adds the Gender Pictures for the PCP', 'G-Funk', 'G-Funk@k-wups.net', '', '0.1.2', 'No', 'http://rpgnet.clanmckeen.com/demo/', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (59, 'Google Search BBCode', 'Allows you to make strings in your post links to search for those strings at Google', 'wGEric', 'eric@egcnetwork.com', 'http://eric.best-1.biz', '1.1.1', 'No', 'http://eric.best-1.biz', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (60, 'Knowledge Base', 'This mod is based on the Knowledge Base at phpBB with addon features', 'wGEric/Haplo', 'jonohlsson@hotmail.com', 'http://www.mx-system.com', '2.0.2', 'No', 'http://www.mx-system.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (61, 'Keep Em Moving', 'This mod will keep your animated smilies animated even after clicking on one when posting.', 'Bill Beardslee', 'webmaster@webxtractions.com', '', '1.0.0', 'No', '', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (62, 'Lock/Unlock in Posting Body', 'This Hack allows the Admin/Mod to lock/unlock a topic direct after submitting the post.', 'Meik Sievertsen', 'acyd.burn@gmx.de', '', '1.0.1', 'No', '', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (63, 'Holidays for Profile Control Panel', 'Allows the users to or not specify if they are on holiday.', 'GilGraf', 'webmaster@ggweb-fr.com', 'http://ggweb-fr.com/phpbbfre/', '1.0.3', 'No', 'http://rpgnet.clanmckeen.com/DEMO', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (64, 'No Thread Stretch', 'Prevents page stretching by long images and text', 'Thoul', 'thoul@users.sourceforge.net', 'http://darkmods.sourceforge.net', '1.3.0', 'No', 'http://darkmods.sourceforge.net', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (65, 'Last Topics for Profile Control Panel', 'This add-on will add a new box on the profile home to display topics since your last visit or since x days', 'Ptirhiik', 'ptirhiik@clanmckeen.com', 'http://rpgnet.clanmckeen.com/demo', '1.0.0', 'No', 'http://rpgnet.clanmckeen.com/demo', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (66, 'Bots MOD', 'Manage search engine bots in ACP', 'Adam Marcus', '', '', '1.0.0', 'No', '', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (67, 'printer-friendly topic view', 'This mod will add a button with a printer in topic view', 'Svyatozar', 'svyatozar@pochtamt.ru', '', '1.0.8', 'No', '', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (68, 'Private Message Review', 'Review of received PM when replying', 'masterdavid', 'webmaster@integramod.com', '', '1.0.0', 'No', '', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (69, 'Prune users', 'Admin plug-in that makes it posible to delete users who are inactive/haven\\''t posted or like.', 'Niels Chr. RÃ¸d', 'ncr@db9.dk', 'http://mods.db9.dk', '1.4.3', 'No', 'http://mods.db9.dk', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (70, 'QBar/QMenu', 'This mod will allow you to add a menu bar at the top of the board, and also will replace your default phpBB menu, allowing you to add quickly links to both within the ACP', 'Ptirhiik', 'ptirhiik@clanmckeen.com', 'http://rpgnet.clanmckeen.com/demo', '1.0.1', 'No', 'http://rpgnet.clanmckeen.com/demo', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (71, 'Redirect to Post', 'After posting, editing, or deleting a message, the user is redirected to their post or the topic.', 'Thoul', 'thoul@users.sourceforge.net', 'http://darkmods.sourceforge.net', '2.2.0', 'No', 'http://darkmods.sourceforge.net', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (72, 'Repeating events MOD', 'Repeating events for Topic Calendar', 'Antoon', 'antoonvdr@yahoo.com', '', '', 'No', '', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (73, 'Rules Management for PCP', 'Create and to modify the Rules of the forum, checks how many users have read the rule from the last change and in case it is possible to warn them with a Private Message.', 'Sko22', 'sko22@quellicheilpc.com', 'http://www.quellicheilpc.com/', '1.0.2', 'No', 'http://www.quellicheilpc.com/', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (74, 'Server Load Mod', 'Mod to show the number of pages served on your web server from your forums within a user-defined period', 'IDB', 'ian@errolian.com', 'http://www.team-allegiance.com', '0.1.0', 'No', '', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (75, 'Shrink Attached Image Mod', 'This Mod adds the ability to automatic shrink the attached image. It should works with the File Attachment Mod v2.3.10', 'roc', 'flying_roc@hotmail.com', 'http://roc.phpbbhost1.biz', '1.0.0', 'No', 'http://roc.phpbbhost1.biz', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (76, 'Simply Merge Threads', 'This mod allows to merge two topics', 'Ptirhiik', 'ptirhiik@clanmckeen.com', 'http://www.rpgnet-fr.com', '1.0.1', 'No', 'http://www.rpgnet-fr.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (77, 'Smilies in Topic Titles', 'Shows smilies in topic titles', 'Suisse', 'chatwithbea@bluewin.ch', 'http://www.techno-revelation.com', '1.0.0', 'No', 'http://www.techno-revelation.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (78, 'Stop Author View Increase', 'Does not increase viewed count when author is viewing his/her own topic', 'DanielT', 'savi.mods@danielt.com', 'http://www.danielt.com', '1.0.1', 'No', 'http://www.danielt.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (80, 'eXtreme Styles MOD', 'This mod is heavily optimized version of phpBB templates system and has some additional features. It compiles and executes files much faster, has cache system that speeds up templates many times, allowes to use php in templates and few other new features', 'CyberAlien', '', 'http://www.phpbbstyles.com', '2.3.1', 'No', 'http://www.phpbbstyles.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (81, 'Yellow card', 'Warning and ban system', 'Niels Chr. RÃ¸d', 'ncr@db9.dk', 'http://mods.db9.dk', '1.4.11', 'No', 'http://mods.db9.dk', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (82, 'You BBCode', 'Adds a BBCode that puts the username of the person viewing the post where you add [you] to your post', 'wGEric', 'eric@egcnetwork.com', 'http://eric.best-1.biz', '1.0.1', 'No', 'http://eric.best-1.biz', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (83, 'Type Quietly', 'Gently discourage users from \\''shouting\\'' by popping up a Javascript alert if they start typing a message or subject in caps.', 'Lars Janssen', 'lars.tq@ukmix.net', 'http://www.ukmix.org/', '1.0.1', 'No', 'http://www.ukmix.org/', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (84, 'ChatSpot', 'This will add a LIVE chatbox on your phpBB2', 'Project Dream Views', '', 'http://www.dreamviews.com/chatspot/', '3.02', 'No', 'http://www.dreamviews.com/chatspot/', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (85, 'Topic Shadow Manager', 'Admin Control Panel Plug-in to let you view all shadow topic links, some info about them, and optionally remove any or all.', 'Nivisec', 'support@nivisec.com', 'http://www.nivisec.com', '2.13', 'No', 'http://www.nivisec.com/phpbb.php?l=p', './hl/topic_shadow_by_nivisec.hl', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (86, 'Tell A Friend', 'This MOD will add a \\"tell a friend\\" feature', 'Hardout', 'duncan____jones@hotmail.com', 'www.handykoelsch.de', '1.3.0', 'No', '', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (87, 'BBCode Sup & Sub', 'Subscript (sub) and Superscript (sup) text', 'Lunatic', 'lunatic@10qt.net', 'http://www.10qt.net', '1.0.0', 'No', 'www.phpbbhacks.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (100, 'Rating system', 'Users rate individual posts to produce overall ranks for posts, topics and users.', 'Gentle Giant', 'phpbb@mywebcommunities.com', 'http://www.mywebcommunities.com', '1.1', 'No', 'http://www.phpbb.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (89, 'Rank images drop down menu', 'Changes the rank image selection to a drop down colum of all available images', 'Antony Bailey', '', '', '1.0.0', 'No', 'http://www.phpbbhacks.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (90, 'Faq Manager', 'This mod allows the administrator to edit and re-arrange their FAQ and BBCode Guide through an admin control panel module', 'Selven', 'selven@zaion.com', 'http://www.zaion.com', '1.0.0', 'No', 'www.phpbb.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (91, 'Group Extend', 'Adds into the ACP some features to see the permissions of groups and users', 'Malicious Rabbit', '', 'http://www.web-lapin.levillage.org/forum/', '0.0.1', 'No', 'http://www.web-lapin.levillage.org/forum/', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (92, 'Group Extra E-mails', 'Allows users to be informed via Email if they are removed from a group or if their request to join is denied', 'Malicious Rabbit', '', 'http://www.web-lapin.levillage.org/forum/', '1.0.1', 'No', 'http://www.web-lapin.levillage.org/forum/', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (93, 'Mass Email and PMs', 'Allows to send Mass PMs and E-mails to users using the ACP', 'Malicious Rabbit', '', 'http://lapin-malin.com/', '1.0.0', 'No', 'http://lapin-malin.com/', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (94, 'Ranks summarize', 'This mod displays all the ranks available on your board', 'Ptirhiik', 'ptirhiik@clanmckeen.com', 'http://www.rpgnet-fr.com', '1.0.4', 'No', 'http://www.rpgnet-fr.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (95, 'Sub-templates', 'This mod allows you to set a different template - or parts of template - for a forum or an entire category', 'Ptirhiik', 'ptirhiik@clanmckeen.com', 'http://rpgnet.clanmckeen.com/demo', '1.0.4', 'No', 'http://rpgnet.clanmckeen.com/demo', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (96, 'Error Mod', 'Adds error pages to your site so users don\\''t get a boring old error screen .htaccess', 'Josh', 'Joshua_Hesketh@hotmail.com', 'http://cacfe.decoder.com.au', '0.0.1', 'No', '', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (97, 'Prillian - the Instant Messenger for phpBB', 'Allows registered users to use phpBB as an instant messenger.', 'Thoul', 'thoul@users.sourceforge.net', 'http://darkmods.sourceforge.net', '0.7.1', 'No', 'http://darkmods.sourceforge.net', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (98, 'No flood control on edit', 'This MOD removes the flood control when editing posts', 'Graham', 'phpbb@grahameames.co.uk', 'http://www.grahameames.co.uk/phpbb', '1.0.0', 'No', 'http://www.phpbb.com/files/mods/No_Flood_On_Edit_1.0.0.mod', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (99, 'MyCookies Manager', 'Adds a link to a page that will clear all of a user\\''s cookies for that board.', 'A_Jelly_Doughnut', '', 'http://www.phpbbsupport.co.uk', '1.1.0', 'No', 'http://www.phpbbsupport.co.uk', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (101, 'Staff Site', 'An external site to display who is Mod or Admin on your board.', 'Acid', '', '', '2.2.0', 'No', 'http://www.phpbbhacks.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (102, 'Postings Popup', 'This MOD will create a link from the replies in view forum which will create a popup window showing the users who have made posts to that topic together with the number of posts that they have made.', 'david63', 'david.wood63@btopenworld.com', 'http://www.david-wood.me.uk', '1.3.0', 'No', 'www.phpbb.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (103, 'Smilies Upload Utility', 'Manage smilies images through the Admin Panel.', 'Thoul', 'thoul@users.sourceforge.net', 'http://darkmods.sourceforge.net', '1.1.0', 'No', 'http://darkmods.sourceforge.net', '../hl/smilies_upload.hl', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (104, 'Optimize Database', 'It Checks and it Optimizes the Tables of the Database also in automatic.', 'Sko22', 'sko22@quellicheilpc.com', 'http://www.quellicheilpc.com/', '1.2.2', 'No', 'http://www.quellicheilpc.com/', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (105, 'phpBB Database Cleaning', 'Clean all non-consistent data from forum database', 'Florian_DVP', 'florian@developpez.biz', 'http://florian.developpez.com', '1.1.1', 'No', 'http://florian.developpez.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (106, 'Bookmarks', 'Keeps an internal list of bookmarks set by the user', 'PhilippK', 'phpBB2004@kordowich.net', 'http://phpbb.kordowich.net/', '1.1.1a', 'No', 'http://phpbb.kordowich.net/', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (107, 'Delayed Topics', 'Allows users with the proper permissions to add topics that will appear at a given date.  Ideal if you want to schedule forum-based events and activities', 'themaze75', 'themaze75@hotmail.com', 'http://www.novisoft.com/maze', '1.0.0', 'No', 'http://www.novisoft.com/maze', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (108, 'Today At/Yesterday At', 'Will show Today At if the post was posted today. Will show Yesterday At if the post was posted yesterday', 'akzhaiyk', 'phpbb2xp@myrunet.com', 'http://phpbb2xp.myrunet.com', '1.0.0', 'No', 'http://phpbb2xp.myrunet.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (109, 'Extended Quote Tag', 'This Mod adds an extended functionality on the [quote] BBCode Tag.  Quote multiple posts through the topic review box', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de/', '1.0.0', 'No', 'http://www.opentools.de/', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (110, 'IP Search', 'Search for a user by IP address.', 'Thoul', 'thoul@users.sourceforge.net', 'http://darkmods.sourceforge.net', '1.2.0', 'No', 'http://darkmods.sourceforge.net', './hl/ip_search.hl', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (111, 'Advanced Links Mod', 'Display links (with logo) on the forum index page.', 'stefan2k1', 'sp@phpbb2.de', 'http://www.phpbb2.de', '1.2.2', 'No', 'http://www.phpbb2.de', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (112, 'Download Topics and Posts', 'Insert links on viewtopic to save the whole topic or one post of it in a textfile', 'OXPUS', 'webmaster@oxpus.de', 'http://www.oxpus.de', '1.0.2', 'No', 'http://www.oxpus.de', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (113, 'DHTML Calendar Widget', 'The DHTML Calendar widget1 is an (HTML) user interface element that gives end-users a friendly way to select date and time', 'Mihai Bazon', 'mishoo@infoiasi.ro', 'http://dynarch.com/mishoo/', '0.9.6', 'No', 'http://dynarch.com/mishoo/', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (115, 'DHTML Slide Menu for ACP', 'This MOD turns your ACP left pane into a Dynamic HTML Slide Menu (roll-in/roll-out effects), making it easier to navigate.\r\nModified by webmedic < bah@webmedic.net> (Brook HUmphrey) http://www.webmedic.net', 'markus_petrux', 'phpbb.mods@phpmix.com', 'http://www.phpmix.com', '1.0.1', 'No', 'http://www.phpmix.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (116, 'phpBB Security', 'This MOD adds an enhanced security system to your phpBB forum.', 'aUsTiN', 'austin_inc@hotmail.com', 'http://phpbb-tweaks.com/', '1.0.3', 'No', 'http://phpbb-tweaks.com/', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (117, 'HTTP Referers', 'Adds a referers page in ACP for admins, for a more detailed http referers overveiw.', 'oc5iD', 'admin@on-irc.net', 'http://on-irc.net', '1.0.0', 'No', '', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (118, 'Fix message_die for multiple errors MOD', 'This MOD replaces the \\"message_die() was called multiple times\\" message with something more useful. It reports a list of all \\"those\\" error messages with all relevant information. So that may help board administrators to identify the problem.', 'markus_petrux', 'phpbb.mods@phpmix.com', 'http://www.phpmix.com', '1.0.3', 'No', 'http://www.phpmix.com/index.php?page=213&t=384', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (119, 'Force Topic Read', 'This MOD forces users to read a specific topic once before reading or posting in the forums.', 'aUsTiN', '', 'http://www.phpbb-tweaks.com', '1.0.2', 'No', 'http://www.phpbb-tweaks.com', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (120, 'PafileDB', 'Adds a file download database(downloads section) to your phpBB site.', 'PHP Arena/Mohd', '', 'http://www.hostsector.com/~mohd/', '3.1', 'No', 'http://www.hostsector.com/~mohd/', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (121, 'phpBB Spell', 'Adds a spellchecker to your phpBB site.', '', '', '', '3.1', 'No', '', '', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (122, 'PCP Wizard', 'An Addon for PCP 2.0.0 that adds a more userfriendly interface to PCP.', 'Ednique', '', 'http://www.integramod.com/', '', 'No', '', 'http://www.integramod.com/', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (123, 'Donation MOD', 'Allows Paypal donations to be sent through your phpBB.', 'sandodo', 'zouxiong@loewen.com.sg', 'http://forum.loewen.com.sg', '1.0.2', 'No', '', 'http://forum.loewen.com.sg', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (124, 'Paypal IPN Subscription', 'Adds group subscriptions through Paypal.', 'sandodo', 'zouxiong@loewen.com.sg', 'http://forum.loewen.com.sg', '1.0.3', 'No', '', 'http://forum.loewen.com.sg', 1168727612);
INSERT INTO phpbb_hacks_list VALUES (125, 'CrackerTracker Professional G5', 'A fully integrated and complete Security System for your Forum. Blocks known Worm Attacks and Floods.', 'cback/cYbercOsmOnauT', 'webmaster@cback.de', 'http://www.cback.de', '5.0.3', 'No', 'http://www.cback.de', '', 0);
INSERT INTO phpbb_hacks_list VALUES (126, 'Advanced Visual Confirmation', 'This MOD replaces the original CAPTCHA of the phpBB Visual Confirmation.', 'AmigaLink', 'webmaster@amigalink.de', 'http://www.EssenMitFreude.info', '1.2.0', 'No', 'http://www.EssenMitFreude.info', '', 0);
INSERT INTO phpbb_hacks_list VALUES (127, 'Full Album Pack', 'An integration of Smartor\\''s Photo Album with many of it\\''s addons.  Supercharged Album Pack, Album Category Hierarchy, Album Multiple Uploads, Archive Mod, Thumbnail Dimension Mod, Picture Rotation Mod, Album Nuffload, Nuffimage, and many other modificat', 'Mighty Gorgon', '', 'http://www.icyphoenix.com', '1.2.3', 'No', 'http://www.icyphoenix.com', '', 0);
INSERT INTO phpbb_hacks_list VALUES (128, 'Photo for Profile Control Panel', 'This Mod adds the ability to let your users attach a photo to their profile.  This works exactly like the avatar function with all the ACP settings. You can even turn off the feature per user.', 'MrDSL', 'naugher@sbcglobal.net', 'http://www.thehottub.net', '0.9.0', 'No', 'http://www.thehottub.net', '', 0);
INSERT INTO phpbb_hacks_list VALUES (129, 'Cash Mod', 'Cash Mod for users to gain money/points by posting', 'Xore', 'mods@xore.ca', 'http://www.xore.ca', '2.2.3a', 'No', 'http://www.xore.ca', '', 0);
INSERT INTO phpbb_hacks_list VALUES (130, 'Advanced BBCode Box MOD', 'This MOD adds lots of useful BBCode features and makes the bbcode buttons look just like Microsoft Office 2003. It also improves the functions of phpBB\\''s BBCode function. It adds the bbcode exactly where the cursor is, inserts smilies where the cursor is', 'Disturbed One/AL Tnen', 'anthony@anthonycoy.com', 'http://www.hvmdesign.com', '6', 'No', 'http://www.hvmdesign.com', '', 0);
INSERT INTO phpbb_hacks_list VALUES (131, 'Lo-Fi Mod', 'This Mod will add a Textual/Low Graphic Layout to your Board. It\\''s Ideal for Google Bot and for all Search Engine that spider your site, and also for printing in an easy way.', 'Bicet/CyberAlien/Justas', 'bicets@gmail.com', 'http://www.phpbbstyles.com', '1.0.0', 'No', 'http://www.phpbbstyles.com', '', 0);
INSERT INTO phpbb_hacks_list VALUES (132, 'Advanced Group Color Management', 'This mod adds colored username, configurable per group, everywhere', 'Teelk', '', '', '1.2.5', 'No', '', '', 0);

# -- IP Tracker
INSERT INTO phpbb_ip_tracking_config (max) VALUES ('25000');

# -- Welcome PM Mod
INSERT INTO phpbb_wpm VALUES ('wpm_version', '1.0.8');
INSERT INTO phpbb_wpm VALUES ('active_wpm', '1');

# -- in Install INSERT INTO phpbb_wpm VALUES ('wpm_username', 'Anonymous');
# -- in Install INSERT INTO phpbb_wpm VALUES ('wpm_userid', '-1');

INSERT INTO phpbb_wpm VALUES ('wpm_subject', 'Welcome to [sitename]!');
INSERT INTO phpbb_wpm VALUES ('wpm_message', 'Hi there, [username]!  I hope you enjoy your stay here at [sitename]!  If you have any questions about the site, please ask.');

INSERT INTO phpbb_force_read VALUES (1, 'Please read the following post as it contains important update information pertaining to this forum.', 0, 0, 1);
INSERT INTO phpbb_chatspot_rooms VALUES ('1', 'Lobby', '1', '0', NULL, '0');

# -- Advanced Group Color Management

-- Create three "fake" groups
INSERT INTO phpbb_groups (group_type, group_name, group_description, group_moderator, group_single_user) VALUES (1, 'Group_registered', 'Group_registered_desc', 0, 1);
INSERT INTO phpbb_groups (group_type, group_name, group_description, group_moderator, group_single_user) VALUES (1, 'Group_anonymous', 'Group_anonymous_desc', 0, 1);
INSERT INTO phpbb_groups (group_type, group_name, group_description, group_moderator, group_single_user) VALUES (1, 'Group_session', 'Group_session_desc', 0, 1);

-- Insert the values for these groups (or any other groups created before in this SQL file)
INSERT INTO phpbb_color (group_id, themes_id, color_code)
SELECT g.group_id, t.themes_id, ''
FROM phpbb_groups g, phpbb_themes t;

-- Create the config keys associated, values are wrong here but will be updated below
INSERT INTO phpbb_config (config_name , config_value) VALUES ('mod_advanced_group_color_management', '1.2.5');
INSERT INTO phpbb_config (config_name , config_value) VALUES ('group_registered', 'GROUP_REGISTERED');
INSERT INTO phpbb_config (config_name , config_value) VALUES ('group_anonymous', 'GROUP_ANONYMOUS');
INSERT INTO phpbb_config (config_name , config_value) VALUES ('group_session', 'GROUP_SESSION');
INSERT INTO phpbb_config (config_name , config_value) VALUES ('agcm_check', '0');
INSERT INTO phpbb_config (config_name , config_value) VALUES ('agcm_time', '2');
INSERT INTO phpbb_config (config_name , config_value) VALUES ('agcm_value', '1200');

-- Update phpbb_config with the correct values
UPDATE phpbb_config
  SET config_value = (SELECT group_id FROM phpbb_groups WHERE group_name = 'Group_registered')
  WHERE config_name = 'group_registered';
UPDATE phpbb_config
  SET config_value = (SELECT group_id FROM phpbb_groups WHERE group_name = 'Group_anonymous')
  WHERE config_name = 'group_anonymous';
UPDATE phpbb_config
  SET config_value = (SELECT group_id FROM phpbb_groups WHERE group_name = 'Group_session')
  WHERE config_name = 'group_session';
UPDATE phpbb_config SET config_value = (SELECT group_id FROM phpbb_groups WHERE group_name = 'Group_registered')
  WHERE config_name = 'user_group_id';

  -- Update users' "color group id"
  -- (order of these two queries is important so that Anonymous, -1, doesn't end up in Registered group)
UPDATE phpbb_users SET user_group_id = (SELECT group_id FROM phpbb_groups WHERE group_name = 'Group_registered');
UPDATE phpbb_users SET user_group_id = (SELECT group_id FROM phpbb_groups WHERE group_name = 'Group_anonymous')
  WHERE user_id = -1;

# -- Advanced Report Hack

INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_subject_auth', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_modules_cache', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_hack_count', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_notify', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_list_admin', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_new_window', '0');