/*
======================================================================
 NewsBar v1.2 (modified to Forum Images NewsFader 1.0)
 Vasil Dinkov's NewsBar v1.2 is modified for use and distribution by
 forumimages.com with the author's kind permission.
======================================================================
 Forum Images NewsFader 1.0
 A Forum Images Production -- http://www.forumimages.us/
 Authors: SamG, Daz
 License: FI Free to Use and Distribute - Please see the included licenses.html
	file before using this software. A copy of the license that applies to this script
	can be	found on the Forum Images site should it not be included;
	http://www.forumimages.us/terms.html
======================================================================
*/

// Variables for news items
var defaultNews = 'Welcome to the Our website!';
var newsContent = [
  '<a href="http://www.integramod.com/forum/portal.php?page=3">IntegraMOD</a> and <a href="http://www.integramod.com/forum/portal.php?page=4">IM Portal</a> are the two main projects of this site which utilizes the power of the <a href="http://www.phpbb.com">phpBB</a> forum application',
  '<a href="http://www.integramod.com/forum/portal.php?page=14">IM Portal</a> is a flexible and powerful portal front end for your <a href="http://www.phpbb.com">phpBB</a> forum with lots of great and advanced features.',
  '<a href="http://www.integramod.com/forum/portal.php?page=3">IntegraMOD</a> is a full featured pre-modded version of <a href="http://www.phpbb.com">phpBB</a> forum application with all the great and powerful MODs seamlessly integrated into one superb package.',
  'Do NOT forget to read the <a href="rules.php">rules</a> of this site.',
  'Please <a href="profile.php?mode=register">register</a> and join the discussions in our <a href="index.php">forums</a>',
  'Enjoy, and have a nice day!'
];

// Variables for general configuration
var defaultNewsTimeout = 6;
var newsPopUpFeatures = 'height=320,left=16,menubar,resizable,scrollbars,status,toolbar,top=16,width=560';
var newsPopUpName = 'newsPopUp';
var newsTimeout = 10;
var pauseOnMouseover = true;

// Variables for news fade
var fade = true;
var fadeToDark = true;

var startRed = 255;
var startGreen = 255;
var startBlue = 255;
var endRed = 0;
var endGreen = 0;
var endBlue = 0;
