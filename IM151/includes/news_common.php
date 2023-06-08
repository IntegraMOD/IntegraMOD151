<?php
// ********************************************************************************
// news_common.php
// Author : Nicholas Young-Soares
//
// Copyright (c) 2002-2003 Nicholas Young-Soares
// --------------------------------------------------------------------------------
// Version: 0.1
// Date Started: 08/10/2003
// Description:
//   Sets up all requirements for the news classes.
//
// Requirements:
//   Requires $phpbb_root_path to be set to the root dir of phpBB before this file
//   is included.
//
// --------------------------------------------------------------------------------
// Changelog:
// Version 0.1 - 08/10/2003
//   - Initial version.
//
// ********************************************************************************

// Make phpBB files think that they are in the phpBB enviroment.
define( 'IN_PHPBB', 1 );

// Set up some constants.
define( 'DEFAULT_NUM_ITEMS', 10 );

define( 'SORT_DATE_DEC', 0 );
define( 'SORT_DATE_ASC', 1 );
define( 'SORT_ALPH_ASC', 2 );
define( 'SORT_ALPH_DEC', 3 );

?>