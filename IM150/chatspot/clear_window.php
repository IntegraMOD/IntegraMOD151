<?php

/***************************************************************************
 *							clear_window.php
 *							-------------------
 *	last updated      : August 28, 2004
 *	copyright         : (c) 2004 Project Dream Views; icedawg
 *	email             : phpbbchatspot@dreamviews.com
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/* **[DESCRIPTION]*********************************************************************************************************
		- simply used to clear frames
	************************************************************************************************************************ */

define( 'CHATSPOT', true );
define( 'IN_PHPBB', true );
$phpbb_root_path = './../';
include_once( $phpbb_root_path . 'extension.inc' );
include_once( $phpbb_root_path . 'chatspot/chatspot_config.' . $phpEx );

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $chatspot_config[ 'charset' ]; ?>">
<meta http-equiv="Content-Style-Type" content="text/css" >
<meta name="author" content="Project Dream Views; icedawg">
<meta name="copyright" content="&copy; 2004 Project Dream Views; http://www.dreamviews.com/chatspot">
<link rel="stylesheet" href="<?php echo $chatspot_config['stylesheet']?>" type="text/css">
</head>
<body leftmargin="2" topmargin="2" marginwidth="0" marginheight="0" link="#006699">
</body>
</html>
