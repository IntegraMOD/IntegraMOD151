#
# Basic DB data for Prillian Messenger
#

#
# Dumping data for table `phpbb_im_sites`
#
INSERT INTO phpbb_im_sites (site_id, site_name, site_url, site_phpex, site_profile, site_enable) VALUES (1, 'DarkMods', 'http://darkmods.sourceforge.net/mb/', 'php', 'profile', 1);
INSERT INTO phpbb_im_sites (site_id, site_name, site_url, site_phpex, site_profile, site_enable) VALUES (2, 'Moto-Forum', 'http://www.moto-forum.it/forum/', 'php', 'profile', 1);

#
# Dumping data for table `phpbb_im_config`
#
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('refresh_rate', '60');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('flood_interval', '15');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('success_close', '1');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('refresh_method', '2');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('auto_launch', '0');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('popup_ims', '1');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('list_ims', '0');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('mode1_height', '400');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('mode1_width', '225');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('mode2_height', '250');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('mode2_width', '400');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('read_height', '300');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('read_width', '400');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('send_height', '365');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('send_width', '460');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('list_all_online', '1');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('show_controls', '1');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('allow_ims', '1');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('allow_shout', '1');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('allow_chat', '1');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('override_users', '0');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('enable_flood', '1');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('box_limit', '25');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('refresh_drop', '1');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('play_sound', '1');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('sound_name', '');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('default_sound', '0');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('themes_allow', '1');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('themes_id', '1');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('allow_network', '1');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('session_length', '120');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('enable_im_limit', '1');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('auto_delete', '1');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('open_pms', '0');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('network_user_list', '1');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('default_mode', '1');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('mode3_height', '100');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('mode3_width', '400');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('prefs_height', '350');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('prefs_width', '500');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('use_frames', '1');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('network_profile', 'profile');
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('allow_mode_switch', '1');

# This one changes with each new version
INSERT INTO phpbb_im_config (config_name, config_value) VALUES ('version', '0.7.1');
