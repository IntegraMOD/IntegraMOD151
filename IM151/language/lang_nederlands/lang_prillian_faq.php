<?php
/****************************************************************
 *                      lang_prillian_faq.php [Nederlands]
 *                            -------------------
 *   begin                : Friday, May 30, 2003
 *   version              : 1.1.0
 *   date                 : 2003/12/23 23:23
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

// 
// To add an entry to your FAQ simply add a line to this file in this format:
// $faq[] = array('question', 'answer');
// If you want to separate a section enter
// $faq[] = array('--', 'Block heading goes here if wanted');
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
// To mention Prillian by the name you've set in lang_prillian.php, use the variable
// $progname as it is used in the defaults
//

include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_prillian.' . $phpEx);


$progname = $lang['Prillian'];

$faq[] = array('--', 'Algemene Vragen');
$faq[] = array('Wat is ' . $progname . '?', $progname . ' is een web-based instant messenger client die we aanbieden aan onze geregistreerde gebruikers zodat ze snel en eenvoudig contact met elkaar kunnen opnemen. Het lijkt erg veel op andere instant messenger programma\'s die je wellicht eerder gebruikt hebt, maar meestal zijn de gebruikers gelimiteerd tot andere gebruikers van dit forum.');
$faq[] = array('Moet ik software downloaden om ' . $progname . ' te gebruiken?', 'Nee, er hoeft geen software gedownload te worden. De ' . $progname . ' software draait op deze website. Je kunt de software gebruiken via je webbrowser, net als iedere gewone webpagina of het forum zelf.');
$faq[] = array('Moet ik me in de forums registreren om ' . $progname . ' te gebruiken?', 'Ja. ' . $progname . ' maakt onderdeel uit van de forums en maakt gebruik van dezelfde gebruikersregistratie. Het maakt tevens gebruik van delen van het privé berichten systeem wat in de forums is ingebouwd. Je kunt de messenger pas gebruiken wanneer je geregistreerd en ingelogd bent.');
$faq[] = array('Moet ik constant op deze site blijven om ' . $progname . ' te gebruiken?', 'Nee, dat hoeft niet. Zolang je het ' . $progname . ' client venster openhoudt, kun je verder surfen zoals je altijd zou doen. Houd in gedachte dat de messenger in je webbrowser draait. Wanneer je de browser volledig afsluit, wordt de messenger dus ook afgesloten.');
$faq[] = array('Zijn er speciale instellingen in mijn browser vereist om gebruik te maken van ' . $progname . '?', $progname . ' gebruikt aardig wat JavaScript voor beheeropties en het automatisch openen van nieuwe vensters. Het is daarom aanbevolen dat je deze opties voor deze website inschakelt. Wanneer deze opties uitgeschakeld zijn, kun je nog wel gebruik maken van de messenger. Sommige opties zouden echter niet kunnen werken.');
$faq[] = array('Hoe kom ik in ' . $progname . '?', 'Verzeker je er ten eerste van dat je je geregistreerd hebt en je ingelogd bent op het forum. Op sommige forums heeft de beheerder ingesteld dat ' . $progname . ' automatisch opent wanneer je de index pagina van het forum bezoekt. Indien de messenger niet automatisch opent, klik dan op de link "' . $lang['Launch_phpBB_IM'] . '," "' . $lang['Who_is_Online'] . '," of iets soortgelijks. Indien er een nieuwe instant message op je wacht, kan deze link zeggen dat je een nieuwe IM hebt. Klik op deze link om een nieuw venster te openen. Via dit venster, de "IM Client" genaamd, heb je toegang tot ' . $progname . '.');
$faq[] = array('Dat heb ik allemaal gedaan, maar het venster bevat een vreemd foutbericht. Waarom?', 'Daar kunnen verschillende oorzaken voor zijn. Het zou kunnen dat de beheerder van het forum de software tijdelijk uitgeschakeld heeft (wellicht voor een upgrade). Het zou ook kunnen dat de beheerder verhinderd heeft dat jij de software kunt gebruiken. Je hebt toch niets stouts gedaan, hè? <br /><br />Het is ook mogelijk dat je de software eerder zelf hebt uitgeschakeld. In dat geval zou het foutbericht een link moeten bevatten naar de voorkeuren bewerker, waar je de software weer kunt inschakelen.');
$faq[] = array('Oké, ik heb de IM Client geopend. Wat nu?', 'Vanuit de IM Client kun je veel dingen doen. Als het goed is zie je een lijst met gebruikers die nu online zijn. Je kunt deze gebruikers een instant message sturen. Je kunt ook berichten naar andere gebruikers sturen, berichten ontvangen, berichten bekijken die je in het verleden hebt ontvangen of verzonden, toegang krijgen tot het Contactlijst beheer paneel, en, wanneer de beheerder van het forum het toestaat, je messenger voorkeuren benaderen.');
$faq[] = array('Hoe ontvang ik berichten?', 'De IM Client zal om een bepaalde tijd kijken of er berichten voor je zijn. Lees voor meer informatie het volgende deel van deze FAQ.');
//
$faq[] = array('--', 'Gebruik Maken van de IM Client');
//
$faq[] = array('Ik zie een hoop afbeeldingen in het venster. Wat betekenen ze? ', 'Het menu van de IM Client geeft je toegang tot de opties van de messenger. Hieronder staat een lijst van afbeeldingen die je kunt zien in de IM Client en wat ze betekenen. Houd in gedachte dat deze afbeeldingen kunnen wijzigen wanneer je het thema dat wordt gebruikt door ' . $progname . ' verandert. In veel browsers kun je ook zien wat een afbeelding betekent, wanneer je met de muis over de afbeelding beweegt. Er zouden ook een aantal tekstlinks kunnen staan die dezelfde functie hebben als deze afbeeldingen, dit is afhankelijk van je voorkeuren.
<br /><br />
<table border="1" width="100%" cellpadding="5" cellspacing="0"><tr><td width="15%" align="center">
<img src="' . $images['prill_buddies'] . '">
</td><td class="gen">
' . $lang['Alt_Contact_Man'] . '
</td><td class="gen">
Dit opent het controlepaneel Contact Beheer in een nieuw venster.
</td></tr><tr><td align="center">
<img src="' . $images['prill_closewin'] . '">
</td><td class="gen">' . $lang['Alt_Close_Windows'] . '
</td><td class="gen">
Extra vensters kunnen o.a. Lees Message, Verzend Message en Message Log vensters zijn.
</td></tr><tr><td align="center">
<img src="' . $images['prill_home'] . '">
</td><td class="gen">
' . $lang['Alt_Home'] . '
</td><td class="gen">
Open de Forum Index van deze website in een nieuw venster.
</td></tr><tr><td align="center">
<img src="' . $images['prill_prefs'] . '">
</td><td class="gen">
' . $lang['Alt_Prefs'] . '
</td><td class="gen">
Wijzig instellingen die de werking van de messenger beïnvloeden. De beheerder kan deze instellingen overschrijven, dan zal deze afbeelding niet zichtbaar zijn.
</td></tr><tr><td align="center">
<img src="' . $images['prill_message'] . '">
</td><td class="gen">
' . $lang['Send_Message'] . '
</td><td class="gen">
Klik hierop om het Verzend Message venster te openen.
</td></tr><tr><td align="center">
<img src="' . $images['prill_refresh'] . '">
</td><td class="gen">
' . $lang['Check_IMs'] . '
</td><td class="gen">
Herlaad of vernieuw de IM Client. Er wordt dan gezocht naar nieuwe berichten en de lijst met online gebruikers wordt bijgewerkt.
</td></tr><tr><td align="center">
<img src="' . $images['prill_logout'] . '">
</td><td class="gen">
' . $lang['Alt_Logout'] . '
</td><td class="gen">
Dit zal de IM Client en alle extra vensters sluiten.
</td></tr><tr><td align="center">
<img src="' . $images['prill_log'] . '">
</td><td class="gen">
' . $lang['Alt_Message_Log'] . '
</td><td class="gen">
Bekijk de lijst met berichten die je hebt verzonden of ontvangen. Je kunt ook individuele berichten bekijken vanuit de Message Log.
</td></tr><tr><td align="center">
<img src="' . $images['prill_offsite'] . '">
</td><td class="gen">
Off-Site Gebruiker
</td><td class="gen">
Deze gebruiker bevindt zich op een andere website. In sommige browsers kun je je muis over de afbeelding bewegen om te zien op welke site de gebruiker zich bevindt.
</td></tr><tr><td align="center">
<img src="' . $images['prill_onsite'] . '">
</td><td class="gen">
On-Site Gebruiker
</td><td class="gen">
Deze gebruiker bevindt zich op deze website, net als jij.
</td></tr><tr><td align="center">
<img src="' . $images['prill_help'] . '">
</td><td class="gen">
Help
</td><td class="gen">
Ga naar deze FAQ pagina.
</td></tr></table><br /><br />
Lees voor meer informatie over Off-Site en On-Site Gebruikers de sectie van deze FAQ getiteld: Site-naar-Site Messaging."');
//
$faq[] = array('Wat staat er nog meer in de IM Client?', 'Afhankelijk van de manier waarop de beheerder de software heeft ingesteld, zou je een aantal blokken kunnen zien met informatie over gebruikers die nu op het forum en de messenger zijn. Dit kan het aantal gebruikers zijn, maar ook verborgen gebruikers en online gastgebruikers.
<br /><br />
Er zullen waarschijnlijk één of twee blokken met gebruikersnamen naast de Off-Site of On-Site Gebruiker pictogrammen en Verzonden berichten pictogrammen staan. Dit zijn gebruikers die op dit moment online zijn. Wanneer een On-Site Gebruikersnaam op 
<em>deze wijze</em> getoond wordt, dan gebruikt deze gebruiker op dit moment ook de messenger. Elke Off-Site Gebruiker die getoond worden, maken op dat moment ook gebruik van de messenger. Wanneer de moderators of beheerders van deze site getoond worden, zullen hun namen een andere kleur hebben dan de gewone gebruikers. Wanneer je klikt op het Verzend Message pictogram naast een gebruikersnaam, zal het Verzend Message venster zich openen met de naam van die gebruiker ingevuld in het veld “gebruikersnaam”. Je kunt op elke gebruikersnaam klikken om het forum profiel van die gebruiker te bekijken.');
$faq[] = array('Hoe kan ik nieuwe berichten ontvangen?', 'Om de zoveel tijd zal de IM Client automatisch herladen om te kijken of er nieuwe berichten zijn en om de lijst met online gebruikers bij te werken. Wanneer dit gebeurt, kan de IM Client na volledig herladen te zijn je berichten op een paar verschillende manieren weergeven, afhankelijk van je gebruikers voorkeuren en JavaScript instelling in je browser. De IM Client kan nieuwe berichten automatisch in een klein, nieuw Lees Bericht venster openen. Ook kan de Client nieuwe en ongelezen berichten weergeven in het IM Client venster zelf. Wanneer berichten in de IM Client staan weergegeven, zie je een verkorte versie van de onderwerpen van de berichten en de naam van de verzender. Klik op het onderwerp van de message om de message in een nieuw Lees Message venster te openen.
<br /><br />
Afhankelijk van je gebruikers voorkeuren kan de IM Client alleen naar instant berichten zoeken, maar ook naar instant berichten én privé berichten. Wanneer de IM Client om één of andere reden niet automatisch herlaadt, kun je op de Herlaad IM Client link of het bijbehorende pictogram klikken om de IM Client handmatig te herladen.');
$faq[] = array('Hoe verwijder ik oude berichten?', 'Afhankelijk van je gebruikers instellingen kunnen instant berichten automatisch verwijderd worden wanneer je ze gelezen hebt en de IM Client herlaadt. Je kunt ook nieuwe en ongelezen instant berichten of privé berichten verwijderen uit de lijst in de IM Client. Privé berichten die je al gelezen hebt, kun je niet verwijderen vanuit de IM Client (tenzij ze in de IM Client te zien zijn en je ze verwijdert voordat de IM Client herlaadt).');

$faq[] = array('--', 'Gebruikers Voorkeuren en Instellingen');
$faq[] = array('Hoe kan ik mijn instellingen wijzigen?', 'Al je instellingen worden bewaard in de database. Om ze te wijzigen klik je op de <u>Voorkeuren</u> link of pictogram (over het algemeen staat deze onder- of bovenaan de messenger client, maar dit hóeft niet het geval te zijn). Daar kun je al je instellingen wijzigen.');
$faq[] = array('Ik heb op de link geklikt, maar er wordt iets gezegd over de beheerder die iets overschrijft. Wat betekent dat?', 'Beheerders hebben de mogelijkheid gebruikers voorkeuren te overschrijven. Wanneer deze optie is ingeschakeld, kunnen gebruikers voorkeuren niet veranderd worden, behalve door een beheerder zelf. Je hebt ook geen toegang tot de Bewerk Voorkeuren pagina om je instellingen te wijzigen.');
$faq[] = array('Er zijn vele instellingen mogelijk. Wat betekenen ze allemaal?', 'Veel van de gebruikers voorkeuren spreken voor zich. Hieronder een overzicht van degene die wat meer uitleg nodig hebben.
<br /><br /><table border="1" width="100%" cellpadding="5" cellspacing="0">
<tr><td class="gen" width="25%">
Locatie van het geluidsbestand
</td><td class="gen">
De geluidsbestand optie stelt je in staat een nieuw geluid af te spelen wanneer je een nieuwe message ontvangt. Je kunt ervoor kiezen het standaardgeluid te laten afspelen of een geluid op je eigen computer. Klik op de "Browse..." knop om een geluidsbestand op je eigen computer toe te wijzen. De locatie van het geluidsbestand zal in de database van deze site worden opgeslagen. Wanneer je het geluidsbestand later naar een andere locatie verplaatst, vergeet dan niet deze instelling bij te werken.
</td></tr><tr><td class="gen">
Toon deze gebruikers in het hoofdscherm
</td><td class="gen">
Hier kun je aangeven welke gebruikers er worden weergegeven in de IM Client. Je kunt ervoor kiezen alle gebruikers op de forums te tonen, alle gebruikers op de messenger te tonen, enkel buddies op de forums te tonen of enkel buddies op de messenger te tonen.
</td></tr><tr><td class="gen">
Kies een methode om online gebruikers op andere sites te tonen
</td><td class="gen">
Hier kun je aangeven op welke wijze Off-Site Gebruikers worden weergegeven in de IM Client. Je kunt ervoor kiezen geen enkele te tonen, ze in een apart blok te scheiden van de On-Site Gebruikers of samen met de On-Site Gebruikers te tonen. Bedenk dat Off-Site Gebruikers altijd gebruikers op de messenger zijn.
</td></tr></table>');
$faq[] = array('Belangrijke zaken om te weten over Instellingen', 'Er zijn een paar dingen die belangrijk zijn voor je om te weten over gebruikers voorkeuren en instellingen. Wees ten eerste voorzichtig met het veranderen van de instelling Inschakelen. Het uitschakelen van deze instellingen zou ertoe kunnen leiden dat je delen van de messenger niet meer kunt gebruiken. Ten tweede is het beter een geluid op je eigen computer te gebruiken, wanneer je een geluid wilt afspelen bij het ontvangen van een nieuwe message. Het geluid zal sneller laden (en dus eerder afspelen) dan wanneer de messenger het moet downloaden van een website.');


$faq[] = array('--', 'Berichten Verzenden');
$faq[] = array('Hoe verzend ik berichten?', 'Dat is eenvoudig. Klik de Verzend Message link of pictogram (naast een gebruikersnaam of in het menu) om het Verzend Message venster te openen. Hier kun je een message typen en naar een andere gebruiker versturen. Als je een message naar een andere gebruiker wilt sturen dan de gebruiker van wie je de Verzend Message link of pictogram hebt aangeklikt, wijzig dan de naam in het gebruikersnaam veld.
<br /><br />
Merk alsjeblieft op dat je enkel een message naar een Off-Site Gebruiker op een bepaalde site kunt versturen door naast de naam van een Off-Site Gebruiker op de link of pictogram te klikken. Evenzo kun je ook alleen een message versturen naar een On-Site Gebruiker door de link of pictogram aan te klikken in het menu of naast de naam van een On-Site Gebruiker. Door te antwoorden op een message bereik je hetzelfde resultaat.');
$faq[] = array('Ik ben in het Verzend Message venster. Wat stelt alles voor?', 'Het Verzend Message venster heeft vele opties. Naast het Gebruikersnaam veld zijn er twee knoppen waarmee je snel een gebruiker of buddy kunt vinden naar wie je een message kunt sturen. In het Onderwerp veld kun je alles invullen wat je wilt. Er is een BBCode en Font menu aanwezig (net als wanneer je een gewoon forumbericht plaatst), alsook mogelijkheden om ze in een bericht uit te zetten. Er zou ook een schuifmenu kunnen staan met smilies. Tot slot is er een “Bewaar Message” veldje, waarmee je een kopie van de message in de Archiefbox van je privé berichten kunt bewaren wanneer deze succesvol verzonden is.
<br /><br />
Sommige optie kunnen uitgeschakeld zijn wanneer je een message stuurt naar een Off-Site Gebruiker.');
$faq[] = array('Kan ik BBCode, Smilies, HTML, handtekeningen en Afbeeldingen gebruiken in instant berichten?', 'Dat kun je doen wanneer de beheerder het toestaat. De instellingen voor deze opties zijn hetzelfde als op het forum zelf (d.w.z., wanneer je BBCode kunt gebruiken op het forum, kun je dat ook in instant berichten).');


$faq[] = array('--', 'Berichten Lezen');
$faq[] = array('Ik ben een bericht aan het lezen. Wat betekenen de opties die ik zie?', 'Er zijn twee opties in het Lees Message venster die wellicht uitleg behoeven: de “Opslaan en Sluiten" en "Opslaan en Antwoorden” knoppen. Beide knoppen zorgen ervoor dat een kopie van de message opgeslagen wordt in de archiefbox van je privé berichten. Dit is handig wanneer het automatisch verwijderen van gelezen berichten ingesteld staat. Het “Sluiten” en “Antwoorden” gedeelte van de knoppen moeten eenvoudig te begrijpen zijn.
<br /><br />
Afhankelijk van de instelling van het forum zou er ook een formulier voor snel antwoorden in dit scherm zichtbaar kunnen zijn.');
$faq[] = array('Ik krijg steeds ongewenste berichten!', $progname . ' heeft een negeer optie. Je kunt de gebruiker negeren die de berichten stuurt of direct contact opnemen met de beheerder die de gebruiker van het instant messaging of het privé berichten systeem kan bannen.');

$faq[] = array('--', 'Site-naar-Site Messaging');
$faq[] = array('Wat is Site-naar-Site Messaging?', 'Site-to-Site Messaging is een speciaal systeem dat je in staat stelt met gebruikers op andere sites te communiceren. Alle Off-Site Gebruikers die in de IM Client zichtbaar zijn, maken gebruik van een soortgelijke messenger op een andere site. Deze gebruikers kunnen zien of je online bent op deze site. Ze kunnen ook instant berichten naar je versturen via Site-naar-Site Messaging. Je kunt hen ook een message sturen.');
$faq[] = array('Dat klinkt leuk, maar ik wil dat niet.', 'Je kunt Site-naar-Site Messaging uitschakelen in je gebruikers voorkeuren.');
$faq[] = array('Hoe kan ik een message versturen naar iemand op een andere site?', 'Klik op de Verzend Message link of pictogram naast hun naam in de IM Client. Wanneer het Verzend Message venster opent, kun je typen wat je maar wilt! Sommige opties kunnen uitgeschakeld zijn in Site-naar-Site berichten. Het zou ook kunnen zijn dat je geen berichten kunt versturen naar iemand ook al zie je hem of haar online op een andere site. Je kunt enkel berichten verzenden naar een andere site, wanneer deze site is opgenomen in de Site-naar-Site database van die andere site.');
$faq[] = array('Waarom zijn die opties uitgeschakeld?', 'Het Site-naar-Site Messaging systeem is nog in ontwikkeling en is dus nog niet volledig actief.');

//
// These entries should remain in all languages and for all modifications
//
$faq[] = array('--', ' Vragen over ' . $progname . '');
$faq[] = array('Wie schreef deze instant messenger software?', 'Deze (niet gemodificeerde) software is geproduceerd, vrijgegeven en copyrighted door 
<a href="http://darkmods.sourceforge.net/" target="_blank">Thoul</a>. 
Het is gebaseerd op en bevat code van de phpBB forum software, wat (in zijn niet gemodificeerde vorm) geproduceerd, vrijgegeven en copyrighted is door 
<a href="http://www.phpbb.com/" target="_blank">phpBB Group</a>. 
Beide zijn beschikbaar gesteld onder de GNU General Public License en mogen vrij verspreid worden; zie de links voor meer details.');
$faq[] = array('Waarom is de X optie niet beschikbaar?', 'Deze software was geschreven en geautoriseerd door de phpBB Groep (in het geval van de forum software) en Thoul (in het geval van de instant messenger). Wanneer je vindt dat een optie toegevoegd zou moeten worden aan de instant messenger software, bezoek dan de darkmods.sourceforge.net website en kijk of er al eens iets over gezegd is op de daar aanwezige forums. Als dat niet het geval is, kun je een optie verzoek plaatsen op de forums of via de Sourceforge interface.');
$faq[] = array('Tot wie moet ik mij wenden over corrupte en/of wettelijke zaken met betrekking tot deze instant messenger?', 'Je moet dan contact opnemen met de beheerder van dit forum. Als je niet weet wie dat is, zou je eerst contact moeten opnemen met één van de moderators op het forum en vragen met wie je verder contact moet opnemen. Wanneer je daar geen antwoord van krijgt, zou je contact moeten opnemen met de eigenaar van het domein (raadpleeg een whois database) of, wanneer het een gratis domein betreft (zoals bijv. yahoo, free.fr, f2s.com ) het management of de klachtenservice van die service. Merk alsjeblieft op dat Thoul geen enkele controle heeft over en niet verantwoordelijk gehouden kan worden waar of door wie dit bord gebruikt wordt. Het is nutteloos contact op te nemen met Thoul over enige wettelijke kwestie die niet rechtstreeks verbonden is aan de darkmods.sourceforge.net website of de afzonderlijke software van de instant messenger zelf. Wanneer je Thoul wel emailed over het gebruik van een derde van deze software, hoef je geen antwoord te verwachten.');

//
// This ends the FAQ entries
//

?>