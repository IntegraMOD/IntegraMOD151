<?php
/***************************************************************************
 *						lang_extend_meta_tags.php [Nederlands]
 *						-----------------------------------------------
 *	begin				: 12/10/2004
 *	copyright		: paperclips
 *	email				: jm.lachance@gmail.com
 *
 *	version				: 1.0.0 - 11/10/2004
 *
 *   Nederlandse vertaling  : Maart 2005 
 *   The Dutch Team         : http://www.integramod.nl
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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
$lang['Click_return_admin_meta_tags'] = 'Terug naar Meta Tags Beheer Klik %sHier%s';
$lang['Lang_extend_meta_tags'] = 'Meta Tags +';
$lang['Meta_tags_title'] = 'Meta Tags +';
$lang['Meta_tags_title_explain'] = 'Welkom bij het Meta Tags beheer. Deze tags geven je de mogelijkheid een beschrijving te geven van je website aan de zoekmachine zodat je site geïndexeerd kan worden.<br/ >Daarom moet je hier goed op letten.<br/ >Met betrekking tot verwijzen: deze tags geven je ook andere opties zoals het automatisch doorsturen naar een andere URL.  ';

$lang['Meta_parameters'] = 'Complete lijst van meta tags';
$lang['Meta_parameters_explain'] = 'Samenvatting van de belangrijkste meta tags, hun syntax is : <<b>meta name="xxx" content="xxx"</b>>';
$lang['Meta_keywords']  = 'META Sleutelwoorden';
$lang['Meta_keywords_explain']  = '- Functie: Geef aan je site gerelateerde sleutelwoorden op aan zoekmachines.<br />- Maximum aantal karakters: 1000 of 100 sleutelwoorden.<br/ >- Vergeet in het aantal karakters niet de <a href="accent.htm">geaccentueerde letters</a> mee te rekenen die in HTML gecodeerd zijn. De letter "à" bijvoorbeeld, gecodeerd als &amp&agrave; telt in HTML voor acht karakters.<br />- Je moet hetzelfde sleutelwoord niet steeds herhalen (de zoekmachines houden hier niet van).<br />- De sleutelwoorden worden gescheiden door een komma, een spatie of een komma en een spatie, je mag zelf kiezen.';
$lang['Meta_description'] = 'META Beschrijving';
$lang['Meta_description_explain'] = '- Beschrijving van je site.<br />- Maximum aantal karakters: 200<br />- Voorkom de accenttekens, bij bepaalde zoekmachines worden die niet meegenomen.';
$lang['Meta_author']  = 'META Auteur';
$lang['Meta_author_explain']  = '- Maakt het mogelijk de auteur van je site te specificeren.<br/ >- Geef de voornaam op in kleine letters, gevolgd door de achternaam in hoofdletters.<br/ >- Als je wilt kun je meerdere auteurs opgeven, gescheiden door een komma.';
$lang['Meta_identifier_url']  = 'META Identificatie-url';
$lang['Meta_identifier_url_explain']  = ' - Maakt het mogelijk de URL te specificeren.<br />- Geef de URL van je homepage op.<br />- Je kunt slechts 1 URL opgeven.';
$lang['Meta_reply_to']  = 'META Antwoord-aan';
$lang['Meta_reply_to_explain']  = ' - Maakt het mogelijk de email van de webmaster te specificeren.<br/ > Het verdient de voorkeur slechts 1 adres op te geven.';
$lang['Meta_revisit_after']  = 'META Opnieuw-bezoeken-na';
$lang['Meta_revisit_after_explain']  = ' - Maakt het mogelijk de spider (robot van de zoekmachine) je site te laten indexeren om het aantal dagen dat je opgeeft. - "15 dagen" of "30 dagen" is het beste.';
$lang['Meta_category']  = 'META Categorie';
$lang['Meta_category_explain']  = ' - Maakt het mogelijk de categorie van je site te specificeren. Dit wordt door sommige zoekmachines gebruikt om een classificatie per categorie te geven.';
$lang['Meta_generator']  = 'META Generator';
$lang['Meta_generator_explain']  = '  - Normaliter de naam en het versienummer van een programma waarmee de pagina is gemaakt.<br/ >- Kan door programmamakers gebruikt worden om schattingen te maken van het marktaandeel. <br / >- Dezelfde tag als meta uitgever.';
$lang['Meta_copyright']  = 'META Copyright';
$lang['Meta_copyright_explain']  = '- Normaliter een onbevoegde copyright verklaring.<br /> - Je kunt hier copyright, handelsmerken, patenten of andere informatie toevoegen die relevant zijn voor je website.';
$lang['Meta_robots']  = 'META Robots';
$lang['Meta_robots_explain']  = '- Bestuurt robots van zoekmachines op een per-pagina basis.<br/ >- all = De robot indexeert de gehele site (standaardinstelling)<br />- none = De robot indexeert je site helemaal niet<br />- index = Je pagina wordt geïndexeerd<br />- noindex = Je pagina wordt niet geïndexeerd, maar de robots zullen de link van je pagina volgen<br />- follow = The bot take note of your the link on your page for indexing them after.<br />- nofollow = De robot indexeert de link op je pagina niet';
$lang['Meta_distribution']  = 'META Distributie';
$lang['Meta_distribution_explain']  = '- Er zijn drie distributie-classificaties voor je website inhoud:<br/ >- Global (het gehele web)<br/ >- Local (Gereserveerd voor de locale IP block van je site)<br/ >- IU (Internal Use, niet voor openbare distributie)';
$lang['Meta_date_creation']  = 'META Datum-gemaakt-yyyymmdd';
$lang['Meta_date_creation_explain']  = '- Datum waarop je site gemaakt is';
$lang['Meta_date_revision']  = 'META Datum-bijgewerkt-yyyymmdd';
$lang['Meta_date_revision_explain']  = '- Datum waarop de site voor het laatst is bijgewerkt';
$lang['Meta_day'] = 'Dag :';
$lang['Meta_month'] = 'Maand :';
$lang['Meta_year'] = 'Jaar :';

$lang['Meta_http_equiv_parameters'] = 'Andere tags';
$lang['Meta_http_equiv_parameters_explain'] = ' De algemene syntax voor deze tags is : <<b>meta http-equiv="xxx" CONTENT="xxx"</b>> Wanneer je geen tags wilt gebruiken, laat onderstaande velden dan leeg.';
$lang['Meta_refresh']  = 'META Vernieuwen 1';
$lang['Meta_refresh_explain']  = '- Specificeert een vertraging in seconden voordat de browser het document automatisch opnieuw laadt. Het aantal is de vertraging in seconden dat de browser zal "pauzeren" voordat de vernieuwing wordt uitgevoerd. Geef een nummer op in seconden.';
$lang['Meta_redirect_url']  = 'META Vernieuwen 2';
$lang['Meta_redirect_url_explain']  = '- Specificeert een vertraging in seconden voordat de browser automatisch doorstuurt naar een gespecificeerde URL.<br/ > Het aantal voor de URL is de vertraging in seconden dat de browser zal "pauzeren" voordat de doorsturing wordt uitgevoerd.';
$lang['Meta_redirect_url_time']  = 'Tijd (sec):';
$lang['Meta_redirect_url_adress']  = 'Webadres (URL):';
$lang['Meta_pragma']  = 'META Pragma';
$lang['Meta_pragma_explain']  = '- Verbiedt dat een backup van de pagina in het cachegeheugen van de browser wordt gemaakt.<br/ >- Type <i>no-cache</i> om gebruik te maken van deze tag, laat het veld anders leeg.';
$lang['Meta_language']  = 'META Taal';
$lang['Meta_language_explain']  = '- fr : Frans<br/ >- en : Engels of Amerikaans<br/ >- nl : Nederlands<br/ >- de : Duits<br/ - es : Spaans<br/ >- it : Italiaans<br/ >- pt : portugees<br/ >- Als je site meerdere talen heeft, wordt gebruik van deze tag afgeraden.';
}
?>