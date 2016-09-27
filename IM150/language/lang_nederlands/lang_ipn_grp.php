<?php
/****************************************************************
 *				lang_ipn_grp.php  [Nederlands]
 *
 *	begin				: OCT/29/2004
 *	copyright			: Loewen Enterprise - Xiong Zou
 *	email				: zouxiong@loewen.com.sg
 *
 *	version				: 1.0.0.1 - OCT/29/2004
 *
 *   Nederlandse vertaling  : Maart 2005 
 *   The Dutch Team         : http://www.integramod.nl 
 * 
 *   note: removing the original copyright is illegal even you 
 *         have modified the code. Just append yours if you
 *         have modified it. 
 ****************************************************************/ 

/****************************************************************
 *
 *   This program is free software; you can redistribute it and/or
 *   modify it under the terms of the GNU General Public License as
 *   published by the Free Software Foundation; either version 2
 *   of the License, or (at your option) any later version.
 *
 ****************************************************************/
/*****************************************************************
## Terms of Use
##
## All of my MODifications are to use and edit/change for phpBB End Users
##
## Plese DO NOT remove any copyright/licence declaration when using the MODification
##
## I will remain as the sole developer for all my MODifications unless stated otherwise
##
##
## Distribution Terms
##
## All of my MODifications are prohibited to distribute to others without the permission from me.
##
## Plese DO NOT remove any copyright/licence declaration when using the MODification
##
## I will remain as the sole developer for all my MODifications unless stated otherwise
##
## Re-Distribution Terms
##
## If you are distributing WHOLE or PART of my MOD in your MOD Projects or Pre-modded Projects or any other means, you must:
##
## Get the formal authorization from me first.
##
## Plese DO NOT remove any copyright/licence declaration when using the MODification
##
## I will remain as the sole developer for all my MODification unless stated otherwise. Do NOT declare youself as my co-developer
##
## Re-Distribution Terms DOES NOT apply to MOD authors that developing Add-Ons to my MOD. You will be the Add-Ons' Developer/Author
##
*****************************************************************/

//
// Display Topup.php
//
$lang['L_IPN_Subscribe_term_title'] 		= 'Inschrijvings Voorwaarden: (Terugkerende Betaalmethode)';
$lang['L_IPN_Subscribe_free'] 			= 'Gratis';
$lang['L_IPN_Subscribe_for_first'] 		= ' voor de eerste ';
$lang['L_IPN_Subscribe_then'] 			= 'Dan';
$lang['L_IPN_Subscribe_for_next'] 		= ' voor de volgende ';
$lang['L_IPN_Subscribe_for_following'] 		= ' voor iedere volgende ';
$lang['L_IPN_Subscribe_auto_renew'] 		= 'Je inschrijving wordt automatisch vernieuwd, tenzij je je uitschrijft.';
$lang['L_IPN_Subscribe_for_every'] 		= ' voor elke ';
$lang['L_IPN_Subscribe_term_manual'] 		= 'Inschrijvings Voorwaarden: (Handmatige Betaalmethode)';
$lang['L_IPN_Subscribe_manual_renew'] 		= 'Je inschrijving zal verlopen na de verloopdatum. Om je inschrijving te behouden, dien je handmatig je inschrijvingsgeld te betalen, en wel elke ';
$lang['L_IPN_Subscribe_cancel_paypal'] 		= 'Je, <A HREF="https://www.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=%s">, kunt je hier uitschrijven uit deze groep <IMG SRC="https://www.paypal.com/en_US/i/btn/cancel_subscribe_gen.gif" BORDER="0"></A>. <br />Opmerking: Je uitschrijving zal alleen resultaat hebben wanneer je huidige verloopdatum bereikt is.';
$lang['L_IPN_Subscribe_extend'] 		= 'Verleng je inschrijving';
$lang['L_IPN_Subscribe_paypal_sub_url'] = 'https://www.paypal.com/cgi-bin/webscr';
$lang['L_IPN_Subscribe_to_grp'] 		= 'Schrijf je in bij de groep - ';
$lang['L_IPN_Subscribe_paypal_button_alt'] 	= 'Betaal via PayPal - het is snel, gratis en veilig!';


//display page_header
$lang['L_IPN_Subscribe_header_welcome'] 	= 'Welkom %s, je huidige inschrijvingen: ';
$lang['L_IPN_Subscribe_expire_date'] 		= ' [Verloopt op %s]';

//display at groupcp.php
$lang['L_IPN_Subscribe_this_grp'] 		= '%sSchrijf je in bij deze groep%s';
$lang['L_IPN_Subscribe_Payment_grp'] 		= 'Dit is een betalingsgroep: ';

//display at user subscription administration
$lang['L_IPN_user_sub_title'] 			= 'Gebruiker Inschrijvings Beheer';
$lang['L_IPN_user_sub_enplain'] 		= 'Hier kun je de inschrijvingsinformatie van je gebruikers bij betalingsgroepen wijzigen.';
$lang['L_IPN_user_sub_yes'] 			= 'Ja';
$lang['L_IPN_user_sub_no'] 			= 'Nee';
$lang['L_IPN_user_sub_Update'] 			= 'Bijwerken';
$lang['L_IPN_user_sub_info'] 			= 'Gebruiker Inschrijvings Informatie';
$lang['L_IPN_user_sub_info_exp'] 		= 'Bewerk de inschrijvingsinformatie van de gebruiker. Je kunt hem toevoegen aan een groep en de verloopdatum instellen. Merk op dat de verloopdatum exact in het volgende formaat weergegeven moet worden "yyyy/mm/dd hh:mm:ss".';
$lang['L_IPN_grp_name'] 			= 'Groep Naam';
$lang['L_IPN_grp_inornot'] 			= 'In deze groep?';
$lang['L_IPN_grp_expire_date'] 			= 'Verloopdatum';
$lang['L_IPN_grp_action'] 			= 'Actie';
$lang['L_IPN_user_sub_updated'] 		= 'Gebruiker inschrijvingsinformatie succesvol bijgewerkt.';
$lang['L_IPN_click_update_again'] 		= 'Klik %shier%s om de inschrijving van deze gebruiker te controleren.';

//display IPN Log
$lang['L_IPN_log_title'] 			= 'IPN Log Informatie';
$lang['L_IPN_log_title_explain'] 		= 'Doorzoek de IPN voor elke gebruiker of maak een lijst van transactie logs voor alle gebruikers. Opmerking: Je kunt het veld leeg laten om alle transacties te doorzoeken. Wanneer de gebruikersnaam niet gevonden kan worden, zullen ook alle transacties als output gegeven worden.';
$lang['L_LW_USERNAME'] 				= 'Gebruikers Account';

//display subscribe settings
$lang['L_SUB_SETTINGS_TITLE'] 			= 'Inschrijvings Instellingen';
$lang['L_SUB_SETTINGS_EXPLAIN'] 		= 'Werk inschrijving gerelateerde informatie bij';
$lang['L_SUB_SETTINGS'] 			= 'Algemene Inschrijvings Instellingen';
$lang['L_SUB_EXTRA_DAYS'] 			= 'Geef extra dagen aan de inschrijver';
$lang['L_SUB_EXTRA_DAYS_EXPLAIN'] 		= 'Geef je inschrijver een paar extra dagen, bijv. 2, omdat PayPal de betaling zal vertragen en tevens als beloning.';
$lang['update_sub_settings_error'] 		= 'Fout in bijwerken van %s inschrijvings instellingen.';
$lang['sub_settings_updated'] 			= 'Inschrijvings Instellingen zijn succesvol bijgewerkt.';
$lang['Click_return_update_sub_settings'] 	= 'Klik %shier%s om de inschrijvings instellingen opnieuw bij te werken.';


$lang['L_SUBMIT'] 				= 'Opslaan';
$lang['L_RESET'] = 'Herstel';

?>