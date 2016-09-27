<?php
/***************************************************************************
 *                           constats_prillian.php
 *                            -------------------
 *   begin                : Wednesday, Dec 03, 2003
 *   version              : 1.0.0
 *   date                 : 2003/12/23 23:20
 ***************************************************************************/

// Set paths for including files later
define('PRILL_PATH', $phpbb_root_path . 'mods/prillian/');
define('PRILL_URL', $phpbb_root_path . 'imclient.' . $phpEx);

// Table names
define('IM_PREFS_TABLE', $table_prefix.'im_prefs');
define('IM_CONFIG_TABLE', $table_prefix.'im_config');
define('IM_SITES_TABLE', $table_prefix.'im_sites');
define('IM_SESSIONS_TABLE', $table_prefix.'im_sessions');
// This isn't used yet - it's for a future version's chat box and shout box
// define('IM_ROOMS_TABLE', $table_prefix.'im_rooms');

// Page number for session handling
define('PAGE_PRILLIAN', -8051);


// Network Constants - do not change these if you want Network
// Messaging to work.
define('OFF_SITE', -2); // Off-Site User level
define('OFF_SITE_USERS_URL', 'u');
define('OFF_SITE_POST_URL', 'p');

// Instant Message flags
// These cannot be the same as any of the private message flags in constants.php
// unless you're trying to get IMs & PMs in the pm inbox
define('IM_NEW_MAIL', 6);
define('IM_READ_MAIL', 7);
define('IM_UNREAD_MAIL', 8);

// Prillian Mode Flags
define('MAIN_MODE', 1);
define('WIDE_MODE', 2);
define('MINI_MODE', 3);
define('FRAMES_MODE', 4);
define('NO_FRAMES_MODE', 5);


?>