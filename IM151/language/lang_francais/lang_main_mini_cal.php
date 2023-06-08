<?php
/***************************************************************************
 *                            lang_main_mini_cal.php
 *                            ----------------------
 *   Author  		: 	netclectic - Adrian Cockburn - phpbb@netclectic.com
 *   Created 		: 	Thursday, Jan 30, 2003
 *	 Last Updated	:	Tuesday, Nov 25, 2003
 *
 *	 Version		: 	MINI_CAL - 2.0.2
 *
 ***************************************************************************/

$lang['Mini_Cal_calendar'] = 'Calendrier';
$lang['Mini_Cal_add_event'] = 'Ajouter événement';
$lang['Mini_Cal_events'] = 'Prochains événements';
$lang['Mini_Cal_no_events'] = 'Aucun';


// uses MySQL DATE_FORMAT - %c  long_month, numeric (1..12) - %e  Day of the long_month, numeric (0..31)
// see http://www.mysql.com/doc/D/a/Date_and_time_functions.html for more details
// currently supports: %a, %b, %c, %d, %e, %m, %y, %Y, %H, %k, %h, %l, %i, %s, %p
$lang['Mini_Cal_date_format'] = '%b %e';


// if you change the first day of the week in constants.php, you should change values for the short day names accordingly
// e.g. FDOW = Sunday -> $lang['mini_cal']['day'][1] = 'Su'; ... $lang['mini_cal']['day'][7] = 'Sa'; 
//      FDOW = Monday -> $lang['mini_cal']['day'][1] = 'Mo'; ... $lang['mini_cal']['day'][7] = 'Su'; 

//           !!!! DO NOT CHANGE IT ANYMORE DEPENDING ON THE FDOW !!!!
$lang['mini_cal']['day'][1] = 'Di'; 
$lang['mini_cal']['day'][2] = 'Lu'; 
$lang['mini_cal']['day'][3] = 'Ma'; 
$lang['mini_cal']['day'][4] = 'Me'; 
$lang['mini_cal']['day'][5] = 'Je'; 
$lang['mini_cal']['day'][6] = 'Ve'; 
$lang['mini_cal']['day'][7] = 'Sa'; 

$lang['mini_cal']['month'][1] = 'Jan'; 
$lang['mini_cal']['month'][2] = 'Fév'; 
$lang['mini_cal']['month'][3] = 'Mar'; 
$lang['mini_cal']['month'][4] = 'Avr'; 
$lang['mini_cal']['month'][5] = 'Mai'; 
$lang['mini_cal']['month'][6] = 'Jun'; 
$lang['mini_cal']['month'][7] = 'Jui'; 
$lang['mini_cal']['month'][8] = 'Aou'; 
$lang['mini_cal']['month'][9] = 'Sep'; 
$lang['mini_cal']['month'][10] = 'Oct'; 
$lang['mini_cal']['month'][11] = 'Nov'; 
$lang['mini_cal']['month'][12] = 'Déc'; 

$lang['mini_cal']['long_month'][1] = 'Janvier'; 
$lang['mini_cal']['long_month'][2] = 'Février'; 
$lang['mini_cal']['long_month'][3] = 'Mars'; 
$lang['mini_cal']['long_month'][4] = 'Avril'; 
$lang['mini_cal']['long_month'][5] = 'Mai'; 
$lang['mini_cal']['long_month'][6] = 'Juin'; 
$lang['mini_cal']['long_month'][7] = 'Juillet'; 
$lang['mini_cal']['long_month'][8] = 'Août'; 
$lang['mini_cal']['long_month'][9] = 'Septembre'; 
$lang['mini_cal']['long_month'][10] = 'Octobre'; 
$lang['mini_cal']['long_month'][11] = 'Novembre'; 
$lang['mini_cal']['long_month'][12] = 'Décembre'; 
?>