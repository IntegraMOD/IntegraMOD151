<?php 
/************************************************************** 
* MOD Title:   Signatures control [Nederlands]
* MOD Version: 1.2.1
* Translation: English 
* Rev date:    14/08/2004 
* 
* Translator:  -=ET=- < space_et@tiscali.fr > (n/a) http://www.golfexpert.net/phpbb 
*              Narc0sis < corrosion69@hotmail.com > (n/a) http://www.deviantcore.com
* 
*   Nederlandse vertaling  : Maart 2005 
*   The Dutch Team         : http://www.integramod.nl 
*
***************************************************************/ 

$lang['sig_settings'] = 'Instellingen Ondertekening';
$lang['sig_settings_explain'] = 'Waarschuwing: voor alle numerieke velden (behalve voor gedwongen letter grootte), plaats "0" of niets betekent "onbeperkt"!';

$lang['sig_max_lines'] = 'Maximum aantal regels'; 
$lang['sig_wordwrap'] = 'Maximum aantal Karakters (zonder spaties)'; 
$lang['sig_allow_font_sizes'] = 'Tekst grootte [size]'; 
$lang['sig_allow_font_sizes_yes'] = 'Onbeperkt'; 
$lang['sig_allow_font_sizes_max'] = 'Beperkt'; 
$lang['sig_allow_font_sizes_imposed'] = 'Gedwongen'; 
$lang['sig_font_size_limit'] = 'Tekst grootte limiet of gedwongen grootte'; 
$lang['sig_font_size_limit_explain'] = 'phpBB kan tekst groter dan 29 niet aan.  Bovendien als u een tekst grootte wilt opleggen, kun je geen grootte plaatsen kleiner dan 7';
$lang['sig_min_font_size'] = 'min /'; 
$lang['sig_max_font_size'] = 'max of gedwongen grootte'; 
$lang['sig_text_enhancement'] = 'Toestaan van tekst verfraaiing'; 
$lang['sig_allow_bold'] = 'Vet [b]'; 
$lang['sig_allow_italic'] = 'Schuin [i]'; 
$lang['sig_allow_underline'] = 'Onderstreept [u]'; 
$lang['sig_allow_colors'] = 'Tekst kleur [color]'; 
$lang['sig_text_presentation'] = 'Toestaan van tekst verfraaiing'; 
$lang['sig_allow_quote'] = 'Citaat [quote]'; 
$lang['sig_allow_code'] = 'Code Citaten [code]'; 
$lang['sig_allow_list'] = 'Lijst [list]'; 
$lang['sig_allow_url'] = 'Toestaan van url\'s [url]'; 
$lang['sig_allow_images'] = 'Toestaan van Plaatjes [img]'; 
$lang['sig_max_images'] = 'Maximum aantal plaatjes'; 
$lang['sig_max_img_size'] = 'Maximum grootte Plaatjes'; 
$lang['sig_max_img_size_explain1'] = 'In principe hoeft de controle van de beeldgrootte geen probleem te zijn. Niettemin, wanneer de beeldgrootte niet kan worden gecontroleerd, kun je het hier standaard toestaan of weigeren'; 
$lang['sig_max_img_size_explain2'] = 'De controle van de grootte van het plaatje kan voor sommige plaatjes op deze site (%s) niet mogelijk zijn. Bepaal of niet controleerbare plaatjes moeten worden toegestaan of geweigerd.'; 
$lang['sig_max_img_size_explain3'] = 'In principe, is de controle van de beeldgrootte niet mogelijk op deze site (%s). Bepaal hier of niet controleerbare plaatjes moeten worden toegestaan of geweigerd.'; 
$lang['sig_img_size_legend'] = '(h x b)'; 
$lang['sig_allow_on_max_img_size_fail'] = 'Toestaan wanneer niet gecontroleerd kan worden'; 
$lang['sig_max_img_files_size'] = 'Maximum totale bestands grootte voor plaatjes'; 
$lang['sig_max_img_av_files_size'] = 'Maximum totale bestands grootte voor plaatjes+avatars'; 
$lang['sig_max_img_av_files_size_explain'] = 'Wanneer een waarde in dit veld wordt gezet, zal een globale controle voor de bestandsgrootte van de plaatjes en avatars voor de ondertekening plaats vinden, de 2 afzonderlijke controles zullen niet meer worden uitgevoerd. Als geen waarde of 0 wordt geplaatst, zal deze globale controle niet worden uitgevoerd.'; 
$lang['sig_Kbytes'] = 'Kb'; 
$lang['sig_exotic_bbcodes_disallowed'] = 'Andere BBCodes niet toestaan';
$lang['sig_exotic_bbcodes_disallowed_explain'] = 'Andere BBCodes die niet toegestaan mogen worden (eg.: fade,php,shadow)';
$lang['sig_allow_smilies'] = 'Toestaan van smilies';
$lang['sig_reset'] = 'Reset gebruikers Ondertekening';
$lang['sig_reset_explain'] = 'Verwijder de ondertekening in het profiel van <span style="color: #800000">alle gebruikers!</span> Dit is om ze te verplichten deze opnieuw te maken, en dan volgens de huidige/nieuwe instellingen';
$lang['sig_reset_confirm'] = 'Weet je zeker dat je de Ondertekening van alle gebruikers wilt verwijderen?';

$lang['sig_reset_successful'] = 'De Ondertekening van alle gebruikers zijn verwijderd!';
$lang['sig_reset_failed'] = 'Fout: Ondertekening van de gebruikers kan niet worden verwijderd.';

$lang['sig_config_error'] = 'Je Ondertekening instellingen zijn niet geldig.'; 
$lang['sig_config_error_int'] = 'De reeks van gegevens voor deze velden zijn geen positieve gehelen (of font grootte verzoeken zijn groter dan 29):'; 
$lang['sig_config_error_min_max'] = 'U hebt onsamenhangende waarden voor minimum en maximum lettertype grote geplaatst (min.: %s / max.: %s). De maximum lettertype grootte moet groter zijn dan minimum grootte.'; 
$lang['sig_config_error_imposed'] = 'U hebt gekozen om het Ondertekening lettertype verplicht te maken maar de lettertype grootte is niet geldig (%s). Het minimum is 7 en het maximum is 29.'; 

$lang['sig_allow_signature'] = 'Mag een Ondertekening gebruiken';
$lang['sig_yes_not_controled'] = 'Ja NIET gecontroleerd';
$lang['sig_yes_controled'] = 'Ja gecontroleerd';

$lang['sig_explain'] = 'Een Ondertekening is een klein stukje tekst dat je onderaan je berichten kunt toevoegen.';
$lang['sig_explain_limits'] = 'Het is beperkt tot %s karakters%s%s%s.'; 
$lang['sig_explain_max_lines'] = ' op %s regels'; // Be careful to the space at the begining! 
$lang['sig_explain_font_size_limit'] = ' (grootte %s tot %s)'; // Be careful to the space at the begining! 
$lang['sig_explain_font_size_max'] = ' (grootte %s maximum)'; // Be careful to the space at the begining! 
$lang['sig_explain_no_image'] = ' en geen plaatje'; // Be careful to the space at the begining! 
$lang['sig_explain_images_limit'] = ' en %s plaatje(s) waarvan geen groter dan %sx%s pixels en een maximum van %sKb'; // Be careful to the space at the begining! 
$lang['sig_explain_unlimited_images'] = ' en zoveel plaatjes als je wilt maar geen mag groter zijn dan %sx%s pixels, tot een maximum van %sKb'; // Be careful to the space at the begining! 
$lang['sig_explain_avatar_included'] = ', inclusief avatar'; 
$lang['sig_explain_wordwrap'] = 'In je tekst, niet meer dan %s karakters (zonder spaties)ook zonder spatie.'; 

$lang['sig_BBCodes_are_OFF'] = 'BBCodes staan <u>UIT</u>'; 
$lang['sig_bbcodes_on'] = '%sBBCodes%s AAN: '; 
$lang['sig_bbcodes_off'] = '%sBBCodes%s UIT: '; 
$lang['sig_none'] = 'geen'; 
$lang['sig_all'] = 'alles'; 

$lang['sig_error'] = 'Je ondertekening is niet geldig.'; 
$lang['sig_error_max_lines'] = 'Je tekst bevat %s regels terwijl slechts %s toegestaan is.';
$lang['sig_error_wordwrap'] = 'Je tekst bevat %s groep(en) van meer dan %s karakters zonder spaties terwijl dat niet toegestaan is.'; 
$lang['sig_error_bbcode'] = 'Je hebt dit (deze) verboden BBCode (s) gebruikt: %s';
$lang['sig_error_font_size_min'] = 'Je hebt de tekst grootte %s gebruikt terwijl een minimum van %s is toegestaan.'; 
$lang['sig_error_font_size_max'] = 'Je hebt de tekst grootte %s gebruikt terwijl een maximum van %s is toegestaan.'; 
$lang['sig_error_num_images'] = 'Je hebt %s plaatjes gebruikt terwijl er een maximum van %s toegestaan is.'; 
$lang['sig_error_images_size'] = 'Het %s plaatje is te groot. <br /> De grootte is %s pixels hoog en %s breed, terwijl de maximumgrootte die hiervoor toegestaan %s hoog en %s breed is.';
$lang['sig_unlimited'] = 'Onbeperkt'; 
$lang['sig_error_images_size_control'] = 'Onmogelijk om de grootte van het plaatje te controleren: %s<br /> Of er is geen plaatje op dit adres of het forum kan het niet controleren, je kunt deze dus niet gebruiken.'; 
$lang['sig_error_avatar_local'] = 'Er is een problem met dit bestand: %s<br />Het is onmogelijk de grootte te verifiëren.'; 
$lang['sig_error_avatar_url'] = 'Deze url moet verkeerd zijn: %s<br /> Er is geen avatar op dit adres.';
$lang['sig_error_img_files_size'] = 'De totale grootte van het gebruikte plaatje(s) is %sKb terwijl een maximum van %sKb is toegestaan.'; 
$lang['sig_error_img_av_files_size'] = 'De totale grootte van het plaatje(s) gebruikt in je ondertekening %sKb en je avatar (%sKb) is hoger dan de toegestane %sKb.'; 

?>