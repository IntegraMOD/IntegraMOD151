<?php
/***************************************************************************
 *                            mini_cal_config.php
 *                            -------------------
 *   Author  		: 	netclectic - Adrian Cockburn - phpbb@netclectic.com
 *   Created 		: 	Thursday, Jan 30, 2003
 *	 Last Updated	:	Thursday, March 25, 2004
 *
 *	 Version		: 	MINI_CAL - 2.0.4
 *
 ***************************************************************************/
if ( !defined('IN_MINI_CAL') )
{
	die("Hacking attempt");
}


/***************************************************************************

The following values are configurable to tailor the mini cal to your needs.

***************************************************************************/

// Defines which events calendar you are using, if any
// possible values:
//      MYCAL       - MyCalendar
//      PLUS        - MyCalendar+
//      TOPIC       - Topic Calendar
//      SNAIL       - Websnail Calendar Pro
//      SNAILLITE   - Websnail Calendar Lite
//      NONE        - No Supported Calendar is installed
define('MINI_CAL_CALENDAR_VERSION', $board_config['mini_cal_calendar_version']);


// EVENTS CALENDAR USERS ONLY!
// Limits the number of events shown on the mini cal
define('MINI_CAL_LIMIT', $board_config['mini_cal_limit']);


// EVENTS CALENDAR USERS ONLY!
// Limits the number of days ahead in which time upcoming events will be shown
// set to 0 (zero) for umlimited
define('MINI_CAL_DAYS_AHEAD', $board_config['mini_cal_days_ahead']);


// Defines what type of search happens when a user clicks on a date in the calendar
// possible values:
//      POSTS   - will return all posts posted on that date
//      EVENTS  - will return all events happening on that date (ONLY SUITABLE FOR EVENTS CALENDAR USERS).
define('MINI_CAL_DATE_SEARCH', $board_config['mini_cal_date_search']);


// First Day of the Week - 0=Sunday, 1=Monday...6=Saturday
// if you change this remember to change the short day names in lang_main_mini_cal.php
/* USE the calendar week start, no need for duplicate fdow settings...
 * also this is defined by the user him/herself
 * define('MINI_CAL_FDOW', $board_config['mini_cal_fdow']);
 *
 * Forget the above comments... just use $board_config['board_fdow']
 */
define('MINI_CAL_FDOW', $board_config['board_fdow']);

// Defines the css class to use for mini cal days urls 
define('MINI_CAL_DAY_LINK_CLASS', $board_config['mini_cal_link_class']);

// Defines the css class to use for mini cal today date
define('MINI_CAL_TODAY_CLASS', $board_config['mini_cal_today_class']);


// defines the authentication level required to be able to view the upcoming events
// this relates to the permission level assigned to forum
// possible values:
//		auth_view, auth_read, auth_post, auth_reply, auth_edit, 
//		auth_delte, auth_sticky, auth_announce, auth_vote, auth_pollcreate
define('MINI_CAL_EVENT_AUTH_LEVEL', $board_config['mini_cal_auth']);


/***************************************************************************

You should NOT modify any values below here.

***************************************************************************/

// DO NOT MODIFY THIS!
define('MINI_CAL_DATE_PATTERNS', serialize(array('/%a/', '/%b/', '/%c/', '/%d/', '/%e/', '/%m/', '/%y/', '/%Y/', 
                    '/%H/', '/%k/', '/%h/', '/%l/', '/%i/', '/%s/', '/%p/')));

?>
