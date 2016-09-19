<?php
/****************************************************************
 *                         lang_contact_faq.php [Nederlands]
 *                            -------------------
 *   begin                : Saturday, May 31, 2003
 *   version              : 3.0.0
 *   date                 : 2003/12/23 23:21
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

//  IMPORTANT NOTICE!!
//  This version of lang_contact_faq.php is intended for use when you have installed
//  Prillian without installing the expanded version of Contact List that is
//  available separately. If you are using the expanded version of Contact List, use
//  the lang_contact_faq.php file provided in that version!

// 
// To add an entry to your FAQ simply add a line to this file in this format:
// $faq[] = array('vraag', 'antwoord');
// If you want to separate a section enter
// $faq[] = array('--', 'Block heading gaat hierheen als je wilt');
// Links will be created automatically
//
// DO NOT forget the ; at the end of the line.
// Do NOT put single quotes (') in your FAQ entries, if you absolutely must then
// escape them i.e.. \'something\' or use double quotes (") at the beginning and end
// of the entries (in which case you'll need to escape any double quotes in the
// entry).
//
// The FAQ items will appear on the FAQ page in the same order they are listed in 
// this file
//
// To mention Contact List by name, use the variable
// $progname as it is used in the defaults
//

include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_contact.' . $phpEx);

$progname = $lang['Contact_List_FAQ'];

$faq[] = array('--', 'Algemene Vragen');
$faq[] = array('Wat zijn de ' . $progname . '?', $progname . ' is een middel bij welke je makkelijk kan vinden of contacten van gebruikers of om je te beschermen van gebruikers tegen het vinden  of contacten via de  messenger software. De lijsten bevatten een Vriendelijst, een negeerlijst , en een blokeer contact lijst. een blokeer contact lijst is een kleinere versie van een negeer lijst. Het verbergt je contact lijst informatie van vermelde gebruikers, maar wist de aanwezigheid niet zoals van  de negeerlijst .');
$faq[] = array('Dus deze lijsten zijn ingebouwd in de statusbak? Werken ze ook in andere gedeeltes van de forums?', 'Ja, de lijsten zijn gebouwd in de the messenger. Nee, ze werken niet in andere gedeeltes van de forums, uitgezonderd voor de  Contact Management controle paneel. De board administrator kan een uitgebreide versie van ' . $progname . ' om functionalitiet toe te voegen aan andere gedeeltes van de forums, zoals gebruikers profielen, onderwerpen, de memberlijst, prive berichten, en meer.');
$faq[] = array('Hoe verander ik mijn ' . $progname . '?', 'Om te bewerken ' . $progname . ', makkelijk toegang tot <a href="' . append_sid(CONTACT_URL) . '">Beheer Paneel</a>.');
$faq[] = array('Hoe kan ik een gebruiker toevoegen aan mijn ' . $progname . '?', 'Ga naar het toegangs controle paneel en ga naar de pagina voor de particular lijst om een gebruiker toe te voegen die je wenst. dan enter de gebruiker\'s gebruikersnaam in het formulier vlak bij de bodem van de pagina en druk op de Voeg gebruiker toe toets.<br /><br />Om verschillende gebruikers in 1 keer toe te voegen, ga dan naar het toegangs controle paneel en klik op de ' . $lang['Add_contact_users_link'] . ' link. op die pagina, kan je verschillende gebruikersnamen zien en allemaal in 1 keer toevoegen aan jouw lijst.<br /><br />Er zijn ook links om een gebruiker toe te voegen of te verwijderen van jouw lijst in het lees bericht venster.');

$faq[] = array('--', 'Gebruik ' . $progname);
$faq[] = array('Waar dient de vriendenlijst voor ?', 'De vriendenlijst is het meeste waardevolle van de 3 lijsten. Met de vriendenlijst, kun je beperken dat gebruikers zichtbaar zijn in de IM Client om aleen vrienden die momenteel online zijn  (on either the messenger or the forums). Je kunt daardoor ook gewaarschuwd worden als er een vriend online komt of offline gaat.');
$faq[] = array('Hoe kan ik kiezen om gewaarschuwd te worden als mijn vriend online komt?', 'Ga naar de toegangs controle paneel om jouw vriendenlijst te zien. Klik op de "Bewerk online of offline waarschuwings instellingen" link. Vanaf deze pagina, kan je kiezen om gewaarschuwd te worden als er bepaalde gebruikers online komen. Simpel vink de gebruikers aan die je wilt waarschuwen over en druk op de verzend toets. Om te stoppen door gewaarschuwd te worden over een gebruiker, Haal het vinkje weg en druk op de verzend toets.');
$faq[] = array('Waar is de knop voor vrienden om een bericht te verzenden  ?', 'Je kunt op deze toets drukken om een klein venster te openen met een lijst van jouw vrienden . De lijst zal jouw snel laten zien of er een vriend online of offline is, klik op hun naam om een bericht venster te laten zien.');
$faq[] = array('Waar dient de Negeer lijst voor?', 'Wanneer een gebruiker in jouw negeer lijst staat, kan deze jou geen directe berichten verzenden. Ook zal, de gebruiker niet zichtbaar worden in de lijst van online gebruikers in de IM Client.');
$faq[] = array('Waar dient de blokeer lijst voor?', 'Waneer een gebruiker in jouw blokeer lijst staat, dan kan die gebruiker je geen berichten  sturen. Ook kan, de gebruiker je niet zien in de lijst van de online gebruikers in de  IM Client.');



//
// These entries should remain in all languages and for all modifications
//
$faq[] = array('--', $progname . ' Oplossingen');
$faq[] = array('Wie schreef deze ' . $progname . ' software?', 'Deze software (in zijn ongewijzigde vorm) is gemaakt, released, en is copyrighted bij <a href="http://darkmods.sourceforge.net/" target="_blank">Thoul</a>. Het is gebaseerd op en bevat sommige codes phpBB forum software, welke (in zijn ongewijzigde vorm) is geproduceerd, uitgekomen, en is copyrighted bij <a href="http://www.phpbb.com/" target="_blank">phpBB Group</a>. Beide zijn toegankelijk gemaakt onder de GNU General Public License en mogen vrij gedistributeerd worden; Bekijk de links voor meer gegevens.');
$faq[] = array('Waarom is optie  X niet aanwezig?', 'Deze software is geschreven door en heeft een licentie bij de  phpBB Group (in het geval van het forum software) en Thoul (in het geval van de' . $progname . ' ). Als je vind dat er een nieuwe optie moet toegevoegd worden aan de statusbalk software bezoek dan de darkmods.sourceforge.net website en kijk of er al iets over gezegd is in de forums daar. als er niks over vermeld wordt, plaats dan een verzoek voor een nieuwe optie op het forum of via de Sourceforge interface.');
$faq[] = array('Wie moet ik contacten over misbruik en/of legale dingen gerelateerd aan deze  ' . $progname . ' ?', 'Je zal contact moeten opnemen met de administrator van deze site. als je niet kan vinden wie dat is, zal je eerst contact moeten opnemen met de forum moderators en aan hun vragen met wie je in contact moet treden . Als je dan nog steeds geen antwoord krijgt zou je contact kunnen opnemen met de eigenaar van de domeinnaam (Doe een Whois zoekfunctie) of, als deze draaid op een gratis service (o.a. yahoo, free.fr, f2s.com, etc.), De management afdeling van misbruik van die service . Onhoudt dat Thoul absoluut geen controle heeft en kan in geen enkele mogelijkheid verantwoordelijk gesteld worden , waar of bij wie dit board in gebruik is . Het is absoluut onnodig om Thoul te contacten in de relatie van elke legale (ophouden van, aansprakelijk, lasterlijke commentaar, etc.) manier wat niet direct gerelateerd is aan de darkmods.sourceforge.net website of de discrete software van de ' . $progname . ' eigen. Als je email verstuurd via Thoul of elke derde andere partij gebruik van deze  software dan kan je verwachten dat je geen bericht of antwoord terug krijgt.');

//
// This ends the FAQ entries
//

?>