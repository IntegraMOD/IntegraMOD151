<?php
/****************************************************************
 *               lang_main_mini_cal.php  [Nederlands]
 *               ----------------------
 *   Author  	 : netclectic - Adrian Cockburn - phpbb@netclectic.com
 *   Created 	 : Thursday, Jan 30, 2003
 *	 Last Updated: Tuesday, Nov 25, 2003
 *
 *	 Version	 : 	MINI_CAL - 2.0.2
 *
 *   Nederlandse vertaling  : Maart 2005 
 *   The Dutch Team         : http://www.integramod.nl
 * 
 *   note: removing the original copyright is illegal even you 
 *         have modified the code. Just append yours if you
 *         have modified it. 
 ***************************************************************/

/****************************************************************
 *
 *   This program is free software; you can redistribute it and/or
 *   modify it under the terms of the GNU General Public License as
 *   published by the Free Software Foundation; either version 2
 *   of the License, or (at your option) any later version.
 *
 ***************************************************************/

$lang['Mini_Cal_calendar'] = 'Kalender';
$lang['Mini_Cal_add_event'] = 'Gebeurtenis toevoegen';
$lang['Mini_Cal_events'] = 'Agenda';
$lang['Mini_Cal_no_events'] = 'Geen';


// uses MySQL DATE_FORMAT - %c  long_month, numeric (1..12) - %e  Day of the long_month, numeric (0..31)
// see http://www.mysql.com/doc/D/a/Date_and_time_functions.html for more details
// currently supports: %a, %b, %c, %d, %e, %m, %y, %Y, %H, %k, %h, %l, %i, %s, %p
$lang['Mini_Cal_date_format'] = '%b %e';


// if you change the first day of the week in constants.php, you should change values for the short day names accordingly
// e.g. FDOW = Sunday -> $lang['mini_cal']['day'][1] = 'Zo'; ... $lang['mini_cal']['day'][7] = 'Sa'; 
//      FDOW = Monday -> $lang['mini_cal']['day'][1] = 'Ma'; ... $lang['mini_cal']['day'][7] = 'Zo'; 

//           !!!! DO NOT CHANGE IT ANYMORE DEPENDING ON THE FDOW !!!!
$lang['mini_cal']['day'][1] = 'Zo'; 
$lang['mini_cal']['day'][2] = 'Ma'; 
$lang['mini_cal']['day'][3] = 'Di'; 
$lang['mini_cal']['day'][4] = 'Wo'; 
$lang['mini_cal']['day'][5] = 'Do'; 
$lang['mini_cal']['day'][6] = 'Vr'; 
$lang['mini_cal']['day'][7] = 'Za'; 

$lang['mini_cal']['month'][1] = 'Jan'; 
$lang['mini_cal']['month'][2] = 'Feb'; 
$lang['mini_cal']['month'][3] = 'Mrt'; 
$lang['mini_cal']['month'][4] = 'Apr'; 
$lang['mini_cal']['month'][5] = 'Mei'; 
$lang['mini_cal']['month'][6] = 'Jun'; 
$lang['mini_cal']['month'][7] = 'Jul'; 
$lang['mini_cal']['month'][8] = 'Aug'; 
$lang['mini_cal']['month'][9] = 'Sept'; 
$lang['mini_cal']['month'][10] = 'Okt'; 
$lang['mini_cal']['month'][11] = 'Nov'; 
$lang['mini_cal']['month'][12] = 'Dec'; 

$lang['mini_cal']['long_month'][1] = 'January'; 
$lang['mini_cal']['long_month'][2] = 'February'; 
$lang['mini_cal']['long_month'][3] = 'Maart'; 
$lang['mini_cal']['long_month'][4] = 'April'; 
$lang['mini_cal']['long_month'][5] = 'Mei'; 
$lang['mini_cal']['long_month'][6] = 'Juni'; 
$lang['mini_cal']['long_month'][7] = 'Juli'; 
$lang['mini_cal']['long_month'][8] = 'Augustus'; 
$lang['mini_cal']['long_month'][9] = 'September'; 
$lang['mini_cal']['long_month'][10] = 'OKtober'; 
$lang['mini_cal']['long_month'][11] = 'November'; 
$lang['mini_cal']['long_month'][12] = 'December'; 
?>