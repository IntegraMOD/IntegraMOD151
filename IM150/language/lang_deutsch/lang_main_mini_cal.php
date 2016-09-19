<?php
/***************************************************************************
 *                            lang_main_mini_cal.php
 *                            ----------------------
 *   Author  		: 	netclectic - Adrian Cockburn - phpbb@netclectic.com
 *   Created 		: 	Thursday, Jan 30, 2003
 *	 Last Updated	:	Tuesday, Nov 25, 2003
 *   modify             : Mahdi
 *	 Version		: 	MINI_CAL - 2.0.2
 *
 ***************************************************************************/

$lang['Mini_Cal_calendar'] = 'Kalender';
$lang['Mini_Cal_add_event'] = 'Event hinzufügen';
$lang['Mini_Cal_events'] = 'aufkommende Events';
$lang['Mini_Cal_no_events'] = 'Kein';


// uses MySQL DATE_FORMAT - %c  long_month, numeric (1..12) - %e  Day of the long_month, numeric (0..31)
// see http://www.mysql.com/doc/D/a/Date_and_time_functions.html for more details
// currently supports: %a, %b, %c, %d, %e, %m, %y, %Y, %H, %k, %h, %l, %i, %s, %p
$lang['Mini_Cal_date_format'] = '%b %e';


// if you change the first day of the week in constants.php, you should change values for the short day names accordingly
// e.g. FDOW = Sunday -> $lang['mini_cal']['day'][1] = 'Su'; ... $lang['mini_cal']['day'][7] = 'Sa'; 
//      FDOW = Monday -> $lang['mini_cal']['day'][1] = 'Mo'; ... $lang['mini_cal']['day'][7] = 'Su'; 

//           !!!! DO NOT CHANGE IT ANYMORE DEPENDING ON THE FDOW !!!!
$lang['mini_cal']['day'][1] = 'So'; 
$lang['mini_cal']['day'][2] = 'Mo'; 
$lang['mini_cal']['day'][3] = 'Di'; 
$lang['mini_cal']['day'][4] = 'Mi'; 
$lang['mini_cal']['day'][5] = 'Do'; 
$lang['mini_cal']['day'][6] = 'Fr'; 
$lang['mini_cal']['day'][7] = 'Sa'; 

$lang['mini_cal']['month'][1] = 'Jan'; 
$lang['mini_cal']['month'][2] = 'Feb'; 
$lang['mini_cal']['month'][3] = 'Mar'; 
$lang['mini_cal']['month'][4] = 'Apr'; 
$lang['mini_cal']['month'][5] = 'Mai'; 
$lang['mini_cal']['month'][6] = 'Jun'; 
$lang['mini_cal']['month'][7] = 'Jul'; 
$lang['mini_cal']['month'][8] = 'Aug'; 
$lang['mini_cal']['month'][9] = 'Sep'; 
$lang['mini_cal']['month'][10] = 'Okt'; 
$lang['mini_cal']['month'][11] = 'Nov'; 
$lang['mini_cal']['month'][12] = 'Dez'; 

$lang['mini_cal']['long_month'][1] = 'Januar'; 
$lang['mini_cal']['long_month'][2] = 'Februar'; 
$lang['mini_cal']['long_month'][3] = 'März'; 
$lang['mini_cal']['long_month'][4] = 'April'; 
$lang['mini_cal']['long_month'][5] = 'Mai'; 
$lang['mini_cal']['long_month'][6] = 'Juni'; 
$lang['mini_cal']['long_month'][7] = 'Juli'; 
$lang['mini_cal']['long_month'][8] = 'August'; 
$lang['mini_cal']['long_month'][9] = 'September'; 
$lang['mini_cal']['long_month'][10] = 'Oktober'; 
$lang['mini_cal']['long_month'][11] = 'November'; 
$lang['mini_cal']['long_month'][12] = 'Dezember'; 
?>