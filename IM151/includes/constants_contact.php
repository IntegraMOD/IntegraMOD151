<?php
/***************************************************************************
 *                           constants_contact.php
 *                            -------------------
 *   begin                : Wednesday, Dec 03, 2003
 *   version              : 1.0.0
 *   date                 : 2003/12/23 23:21
 ***************************************************************************/

// Set paths for including files later
define('CONTACT_PATH', $phpbb_root_path . 'mods/contact/');
define('CONTACT_URL', $phpbb_root_path . 'contact.' . $phpEx);

// Page number for session handling
define('PAGE_CONTACT', -8050);

// Table names
define('CONTACT_TABLE', $table_prefix.'contact_list');

// Alternate table names, for possible integration of Prillian
// with other buddy/ignore hacks
define('BUDDY_TABLE', $table_prefix.'contact_list');
define('IGNORE_TABLE', $table_prefix.'contact_list');
define('DISALLOW_TABLE', $table_prefix.'contact_list');


// Allows users to set themselves as buddies. This is mainly used only
// in debugged during development.  You should probably leave it at false.
//define('ALLOW_BUDDY_SELF', true);
define('ALLOW_BUDDY_SELF', false);

?>