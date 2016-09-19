<?php
/*****************************************************************
 *			lang_extend_pcp_wiz.php [Nederlands]
 *			---------------------------------------
 *	begin		: 21/03/2005 (dd/mm/yyyy)
 *	copyright	: Ptirhiik / ednique
 *	email		: ptirhiik@clanmckeen.com / edwin@ednique.com
 *
 *	version			: 0.0.1 - 21/03/2005
 *
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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
	// addded by edwin :: PCP Wiz
	$lang['PCP_10_wizard'] 			= 'PCP Wizard';
	$lang['PCP_10_wizard_explain'] 		= 'We hebben geprobeerd PCP beheer een beetje gemakkelijker te maken. We hopen dat het je bevalt.';
	$lang['Wiz_mode_error'] 		= 'De mode <span class="explaintitle">%s</span> wordt niet ondersteund.';
	$lang['Wiz_buddylist'] 			= 'Snelle Vrienden Lijst';
	$lang['Wiz_buddylist_description'] 	= 'Hier kunt u de volgorde, standaard en gedwongen velden van de vrienden/negeer/ledenlijst pagina aanpassen.';
	$lang['Wiz_buddylist_explain'] 		= '<span class="explaintitle">Veldnaam</span>: Klik op de naam om de standaard veldinfo te wijzigen.<br>
						<span class="explaintitle">Volgorde</span>: Dit is de volgorde waarin de velden in de lijst verschijnen. Verander de nummers om de velden te verschuiven.<br>
						<span class="explaintitle">Standaard</span>: Wanneer de gebruiker nooit een veld selecteert om te tonen, zal dit veld standaard worden getoond.<br>
						<span class="explaintitle">Verplicht</span>: Dit veld altijd Verplicht tonen in de lijst.<br>
						<span class="explaintitle">Selecteerbaar</span>: Dit veld kan geselecteerd worden door de gebruikers.<br>
						<span class="explaintitle">Verborgen</span>: Dit veld wordt altijd als verborgen verzonden. Laat deze velden zoals ze zijn wanneer je het buddy/negeer gedeelte wilt gebruiken.<br>
						<span class="explaintitle">Verstuur</span>: Met deze knop zullen je wijzigingen worden opgeslagen en zal een bericht worden getoond waarin staat of de aktie successvol was of niet. De nummers voor de volgorde zullen automatisch worden aangepast voor het geval deze niet correct zijn ingevoerd.<br>';
	$lang['Default']							= 'Standaard';
	$lang['Forced']								= 'Verplicht';
	$lang['Selectable'] 						= 'Verkiesbaar';
	$lang['Update_success']						= 'PCP bestanden succesvol gewijzigd.';
	$lang['Wiz_addremovefields']				= 'Paginavelden Toevoegen/Verwijderen ';
	$lang['Wiz_addremovefields_description']	= 'Hier kun je velden toevoegen of verwijderen van een pagina en ook de volgorde van velden wijzigen.';
	$lang['Wiz_addremovefields_explain']		= '<span class="explaintitle">Selecteer een Pagina</span>: Selecteer in de dropdown box de pagina die je wilt wijzigen en klik op "Selecteer". Een bericht zal tonen welke pagina je hebt geselecteerd. Mocht je de velden erg in de war hebben gemaakt dan kun je de originele waarden eenvoudig herladen door de pagina opnieuw te selecteren, zolang je de pagina maar niet hebt opgeslagen. <br>
						<span class="explaintitle">Wijzig Pagina Opmaak</span>: Slechts zichtbaar indien van toepassing. Selecteer een pagina en klik op deze knop om de opmaak van de velden op de pagina te wijzigen. <br>
						<span class="explaintitle">Wijzig Formulier Opmaak</span>: Slechts zichtbaar indien van toepassing.  Selecteer een pagina en klik op deze knop om de opmaak van de input velden op dit formulier te wijzigen.<br>
						<span class="explaintitle">Beschikbare velden</span>: Hier zie je een multi-selectie box welke alle beschikbare velden bevat die niet op de geselecteerde pagina zijn geplaatst. Je kunt 1 of meer velden selecteren om deze naar de geselecteerde pagina te verplaatsen door gebruik te maken van de combinaties "SHIFT + Muisklik", "CTRL + Muisklik" of "Muisklik + Slepen".<br>
						<span class="explaintitle">Acties</span>: Klik "->" om velden aan de pagina toe te voegen door deze eerst te selecteren in de Beschikbare Velden box. Klik "<-" om velden te verwijderen van de pagina door deze eerst te selecteren in de Geselecteerde velden box. <br>
						<span class="explaintitle">Geselecteerde Velden</span>: Hier zie je een multi-selectie box met alle velden die op de geselecteerde pagina zijn geplaatst. Je kunt 1 of meer velden selecteren om deze te verwijderen van de geselecteerde pagina door gebruik te maken van de combinaties "SHIFT + Muisklik", "CTRL + Muisklik" of "Muisklik + Slepen". <br>
						<span class="explaintitle">Verplaats Op/Neer</span>: Wanneer je één of meer velden in de Geselecteerde velden box selecteert kun je deze knoppen gebruiken om ze naar boven of naar onder in de box te bewegen. De velden zullen op de geselecteerde pagina in dezelfde volgorde worden getoond. <br>
						<span class="explaintitle">Opslaan</span>: Door op deze knop te klikken zullen je wijzigingen Opgeslagen worden en zul je naar een andere pagina gaan waar je kunt specificeren hoe de velden op de geselecteerde pagina worden getoond.<br>
						<span class="explaintitle">??</span>: Wanneer je 1 veld selecteert uit de lijst en op deze knop klikt, zal er een nieuw venster naar openen met meer informatie over dat veld. Je zult een omschrijving zien, op welke pagina het veld wordt gebruikt en indien mogelijk een voorbeeld hoe het er op deze pagina uit ziet.<br>';
	$lang['Map_selected']					= 'Je selecteerde de pagina <strong>%s</strong>';
	$lang['Move_up'] 						= 'Schuif Omhoog';
	$lang['Move_down'] 						= 'Schuif Omlaag';
	$lang['Wiz_showfieldinfo'] 				= 'Veld Info';
	$lang['Wiz_showfieldinfo_description'] 	= 'Hier zie je de details van het geselecteerde veld.';
	$lang['Wiz_showfieldinfo_explain']		= '<span class="explaintitle">Pagina</span>: Klik op de pagina link om de opmaak van het veld op de pagina te wijzigen.<br>
						<span class="explaintitle">Veldnaam</span>: Klik op de veldnaam om de standaard veldinfo te wijzigen.<br>';
	$lang['Pages'] 						= 'Pagina\'s';
	$lang['Select_page'] 				= '<div align="left">Selecteer een Pagina:</div>';
	$lang['Select'] 					= 'Selecteer';
	$lang['Available_fields'] 			= 'Beschikbare Velden';
	$lang['Action'] 					= 'Actie';
	$lang['Selected_fields'] 			= 'Geselecteerde Velden';
	$lang['Default_Output'] 			= 'Standaard Opmaak';
	$lang['Always_display'] 			= 'Altijd Tonen';
	$lang['Wiz_outputlist'] 			= 'Wijzigen Pagina Opmaak';
	$lang['Wiz_outputlist_description'] = 'Hier kunt u de manier waarop velden op een pagina worden getoond aanpassen.';
	$lang['Wiz_outputlist_explain'] 	= '<span class="explaintitle">Selecteer een Pagina</span>: Selecteer in de dropdown box de pagina die je wilt wijzigen en klik op "Selecteer". Een bericht zal tonen welke pagina je hebt geselecteerd. Mocht je de velden erg in de war hebben gemaakt dan kun je de originele waarden eenvoudig herladen door de pagina opnieuw te selecteren, zolang je de pagina maar niet hebt opgeslagen. <br>
						<span class="explaintitle">Paginavelden Toevoegen/verwijderen</span>: Selecteer een pagina en klik op deze knop om velden toe te voegen of te verwijderen van die pagina.<br>
						<span class="explaintitle">Veld</span>: Veldnaam en omschrijving indien beschikbaar. Klik op de naam om de standaard veldinfo te wijzigen.<br>
						<span class="explaintitle">Opties</span>: Hier kun je de opties voor elk veld selecteren.<br>
						<span class="explaintitle">Leg</span>: Markeer dit vakje om de legenda van het veld te tonen. De legenda is de beschrijving die links onder de veldnaam wordt getoond.<br>
						<span class="explaintitle">Txt</span>: Markeer dit vakje om de waarde als tekst te tonen.<br>
						<span class="explaintitle">Afb</span>: Markeer dit vakje om de waarde als een plaatje te tonen.<br>
						<span class="explaintitle">Lijn</span>: Markeer dit vakje wanneer je Txt en Img beide gemarkeerd hebt. De tekst zal dan onder het plaatje staan i.p.v. ernaast.<br>
						<span class="explaintitle">HTML Stijl</span>: Hier kun je HTML code toevoegen om de opmaak aan te passen. Laat leeg wanneer je dit niet nodig vindt. Je moet <em>%s</em> in je HTML zetten waar de waarde van het veld moet komen. Gebruik slechts 1 keer <em>%s</em> in je HTML en geen <em>%</em>.<br>
						<span class="explaintitle">Toon Functie</span>: Hier kun je een beschikbare custom functie selecteren voor het beheer van de opmaak. Wanneer je dit niet nodig hebt, moet je voor <em>Standaard Opmaak</em> kiezen. Bij het creëren van een eigen functie voor de opmaak moet de functienaam beginnen met <em>pcp_output_</em> en upload de functie voordat je naar die pagina gaat.<br>
						<span class="explaintitle">Wanneer Tonen</span>: Deze optie beheert aan wie het veld wordt getoond. Wanneer een gebruiker <em>Ja</em> of <em>Alleen Vrienden</em> heeft geselecteerd in hun profiel voor de geselecteerde vraag, zullen andere mensen de waarde van dit veld kunnen zien. Kies <em>Toon Altijd</em> om het veld altijd te tonen. Bijv: Kies <em>Altijd mijn e-mail adres tonen</em> voor de output van een e-mailadres.<br>
						<span class="explaintitle">Voorbeeld</span>: Indien mogelijk, zul je een voorbeeld zien dat op enkele proefgegevens wordt gebaseerd, laat je dus niet in de maling nemen als de getoonde waarde niet uw waarde is.<br>
						<span class="explaintitle">Opslaan</span>: Klik op deze knop en je wijzigingen worden opgeslagen en een bericht zal worden getoond of de veranderingen succesvol zijn opgeslagen of niet.<br>';
///

	$lang['Display_when'] 				= 'Wanneer Tonen';
	$lang['Nextline'] 					= 'Lijn';
	$lang['Html_style'] 				= 'HTML Stijl';
	$lang['Extra'] 						= 'Extra';
	$lang['Example'] 					= 'Voorbeeld';
	$lang['Confirm_message'] 			= "Weet je zeker dat je de wijzigingen wilt annuleren?\\n\\nOK = Ja, Annuleer mijn wijzigingen.\\n\\nAnnuleren = Nee, laat me eerst Opslaan.";
	$lang['Wiz_inputlist'] 				= 'Wijzigen Formulier Opmaak';
	$lang['Wiz_inputlist_description'] 	= 'Hier kunt u de manier waarop de inputvelden op het formulier worden getoond aanpassen.';
///
	$lang['Wiz_inputlist_explain'] 		= '<span class="explaintitle">Selecteer een Pagina</span>: Selecteer in de dropdown box de pagina die je wilt wijzigen en klik op "Selecteer". Een bericht zal tonen welke pagina je hebt geselecteerd. Mocht je de velden erg in de war hebben gemaakt dan kun je de originele waarden eenvoudig herladen door de pagina opnieuw te selecteren, zolang je de pagina maar niet hebt opgeslagen. <br>
						<span class="explaintitle">Paginavelden Toevoegen/Verwijderen</span>: Selecteer een pagina en klik op deze knop om velden toe te voegen of te verwijderen van die pagina.<br>
						<span class="explaintitle">Veld</span>: Veldnaam en omschrijving indien beschikbaar. Klik op de naam om de standaard veldinfo te wijzigen.<br>
						<span class="explaintitle">Auth niveau</span>: Het minimum authorisatieniveau dat je gebruiker moet hebben om het invoerveld te kunnen zien. <em>Alleen Gasten</em> zal het veld enkel aan gasten tonen en wordt op de registratiepagina gebruikt voor het controle plaatje. <br>
						<span class="explaintitle">Opties</span>: Hier kun je de opties voor elk veld selecteren.<br>
						<span class="explaintitle">Verplicht Veld</span>: Vink dit hokje aan om het veld verplicht te maken. Het veld zal als verplicht worden gemarkeerd en bestaande gebruikers die dit veld niet hebben ingevuld zullen niet op de forums kunnen komen tenzij ze eerst dat veld invullen.<br>
						<span class="explaintitle">Toon Zichtbaarheid</span>: Vink dit hokje aan om de zichtbaarheid van het invoerveld weer te geven. Dit maakt de gebruiker duidelijk wie de data kan zien die ze gaan invoeren. Bijvoorbeeld: <em>(alleen zichtbaar voor vrienden)</em><br>
						<span class="explaintitle">TPL Stijl</span>: Geef hier een waarde op om je invoerveld een ander uiterlijk te geven, zoals bijv. het Regels-veld. De ingevoerde naam moet worden gebruikt in board_config_body.tpl en <em>&lt;!-- BEGIN inputstyle --&gt;</em> en <em>&lt;!-- END inputstyle --&gt;</em> bevatten en de HTML ertussen zal bij dit veld worden uitgevoerd. Laat leeg voor default waarde (<em>field</em>).<br>
						<span class="explaintitle">Type</span>: Kies één van deze typen voor je veld.<br>
						<span class="explaintitle">Tekstvak</span>: Dit zal een tekstvak voor je veld tonen.<br>
						<span class="explaintitle">Drop Down</span>: Dit zal een drop down lijst tonen voor je veld. Je dient ook de <em>waardenlijst</em> te specificeren.<br>
						<span class="explaintitle">Radio Knoppen</span>: Dit zal een radio knop tonen voor elk mogelijke waarde voor je veld. Je dient ook de <em>waardenlijst</em> te specificeren.<br>
						<span class="explaintitle">Gebruik Functies</span>: Je moet een GET functie en een CHK functie specificeren om dit veld te tonen en te valideren.<br>
						<span class="explaintitle">Extra</span>: Afhankelijk van het gekozen type zie je een paar extra opties.<br>
						<span class="explaintitle">Waardenlijst</span>: Selecteer de lijst van waarden die gebruikt kunnen worden.<br>
						<span class="explaintitle">Get functie</span>: Selecteer de functie om het veld te tonen. Maak een functie en benoem het overeenkomstig <em>mods_get_JOUWNAAM</em> of <em>mods_settings_get_JOUWNAAM</em> voordat je deze pagina bezoekt.<br>
						<span class="explaintitle">Check functie</span>: Selecteer de functie om het veld te valideren. Maak een functie en benoem het overeenkomstig <em>mods_check_JOUWNAAM</em> of <em>mods_settings_check_JOUWNAAM</em> voordat je deze pagina bezoekt.<br>
						<span class="explaintitle">Voorbeeld</span>: Indien mogelijk, zul je een voorbeeld zien dat op enkele proefgegevens wordt gebaseerd, laat je dus niet in de maling nemen als de getoonde waarde niet uw waarde is.<br>
						<span class="explaintitle">Opslaan</span>: Klik op deze knop en je wijzigingen worden opgeslagen en een bericht zal worden getoond of de veranderingen succesvol zijn opgeslagen of niet.<br>';
///
	$lang['Tpl_style'] 					= 'TPL Stijl';
	$lang['Textmode'] 					= 'Tekstvak';
	$lang['Dropmode'] 					= 'Drop Down';
	$lang['Radiomode'] 					= 'Radio Knoppen';
	$lang['Functmode'] 					= 'Gebruik Functies';
	$lang['File_permissions'] 			= 'Het Bestand %s heeft niet de juiste CHMOD instellingen <strong>(666)</strong>.';
	$lang['Wiz_validate'] 				= 'Validatie PCP Bestanden';
	$lang['Wiz_validate_description'] 	= 'Dit zal een validatie doen van je huidige PCP Bestanden en zal waarschuwen bij afwijkingen.';
	$lang['Missing_param'] 				= 'Ontbrekend';
	$lang['Move2map'] 					= 'Verplaats naar Mappen';
	$lang['Move2field'] 				= 'Verplaats naar Velden';
	$lang['Maptitle_missing'] 			= 'Vul een titel in voor de map.';
	$lang['Wiz_fields'] 				= 'Beheer Velden';
	$lang['Wiz_fields_description'] 	= 'Hier kun je de standaard veld info wijzigen en nieuwe velden maken uit de database.';

	$lang['Wiz_fields_explain'] 		= '<span class="explaintitle">Selecteer een Veld</span>: Selecteer in de dropdown box de pagina die je wilt wijzigen en klik op "Selecteer". Een bericht zal tonen welke pagina je hebt geselecteerd. Mocht je de velden erg in de war hebben gemaakt dan kun je de originele waarden eenvoudig herladen door de pagina opnieuw te selecteren, zolang je de pagina maar niet hebt opgeslagen. <br>
						<span class="explaintitle">Veldinfo</span>: Selecteer een veld en klik op deze knop om de veldinfo te bekijken en waar deze wordt gebruikt.<br>
						<span class="explaintitle">Selecteer Nieuw Veld</span>: Alle velden uit de gebruikerstabel die niet in PCP worden gebruikt, worden weergegeven in de dropdown box. Selecteer het veld dat je wilt toevoegen en klik op "Selecteer".<br>
						<span class="explaintitle">Legenda van het Veld</span>: Voer een taalsleutel in die moet worden gebruikt als legenda van het veld.<br>
						<span class="explaintitle">Wanneer Tonen</span>: Deze optie beheert aan wie het veld wordt getoond. Wanneer een gebruiker <em>Ja</em> of <em>Alleen Vrienden</em> heeft geselecteerd in hun profiel voor de geselecteerde vraag, zullen andere mensen de waarde van dit veld kunnen zien. Kies <em>Toon Altijd</em> om het veld altijd te tonen. Bijv: Kies <em>Altijd mijn e-mail adres tonen</em> voor de output van een e-mailadres.<br>
						<span class="explaintitle">Type</span>: Kies één van deze typen voor je veld. Dit is het type data dat je veld bevat. Naast de dropdown lijst zie je het type dat in de database is gedefinieerd. Het database type wordt voor systeemvelden niet getoond.<br>
						<span class="explaintitle">Auth niveau</span>: Het minimum authorisatieniveau dat je gebruiker moet hebben om het invoerveld te kunnen zien. <em>Alleen Gasten</em> zal het veld enkel aan gasten tonen en wordt op de registratiepagina gebruikt voor het controle plaatje. <br>
						<span class="explaintitle">Uitleg van het Veld</span>: Wordt gebruik voor invoerformulieren. Je kunt extra tekst toevoegen onder de legenda van het veld om de gebruiker enige uitleg te geven over wat ze moeten invoeren.<br>
						<span class="explaintitle">Afbeelding</span>: Voer een afbeeldingssleutel in uit <em>fisubice.cfg</em> file. Wanneer in <em>Wijzigen Pagina Opmaak</em> voor dit veld <em>Afb</em> hebt gekozen, zal deze afbeelding worden getoond wanneer <em>Standaard Afbeelding</em> als <em>weergave functie</em> is geselecteerd.<br>
						<span class="explaintitle">Afbeeldingstitel</span>: De muis-over tekst voor bovenstaande afbeelding.<br>
						<span class="explaintitle">Opslaan</span>: Klik op deze knop en je wijzigingen worden opgeslagen en een bericht zal worden getoond of de veranderingen succesvol zijn opgeslagen of niet.<br>';

	$lang['Select_field'] 			= 'Selecteer een Veld:';
	$lang['Field_selected'] 		= 'Je selecteerde het veld <strong>%s</strong>';
	$lang['Select_new_field'] 		= 'Selecteer Nieuw Veld:';
	$lang['Newfield_selected'] 		= 'Je selecteerde het NIEUWE veld <strong>%s</strong>';

	$lang['Required_Error'] 		= 'De velden die gemarkeerd zijn met %s zijn verplicht. Ga terug en vul het formulier volledig in.';
	$lang['Wiz_autocorrect'] 		= '<a href="%s">Klik hier om je PCP Files automatisch te repareren.</a><br>
						Wanneer je beveiligingsinstellingen dit toestaan zal er een <strong>backupfile</strong> worden gemaakt in de /profilcp/def/ directory.';
	$lang['Not_in_fields'] 			= 'Het veld %s is niet gedefinieerd in def_userfields...';
	$lang['Wiz_fieldimport'] 		= 'Importeer Velden';

	$lang['Wiz_fieldimport_description'] 	= 'Hier kun je velddefinities importeren die benodigd zijn om mods te implementeren.';
	$lang['Wiz_import_explain'] 			= 'Soms zul je de PCP files moeten wijzigen voor het toevoegen van nieuwe mods.<br>
						Dit kun je doen met behulp van deze interface. Je moet de auteur van de mod vragen om onderstaande info te verstrekken. Stuur hem/haar gewoon onderstaande info en hij/zij kan je de benodigde info toesturen.<br>
						Het is een goede gewoonte om de <strong>validate</strong> functie te draaien na het updaten van je PCP files en gebruik wanneer nodig de autocorrectie functie.<br>
						Mocht je velden op de <strong>Vrienden/Negeer/Ledenlijst</strong> pagina hebben gewijzigd, moet je naar de <strong>Snelle Vrienden Lijst</strong> gaan en dit pagina opslaan (het is niet nodig iets te wijzigen).<br>
						Wanneer je beveiligingsinstellingen dit toestaan zal er een <strong>backupfile</strong> worden gemaakt in de /profilcp/def/ directory. Voor de zekerheid moet je deze directory altijd handmatig backuppen.';

	$lang['Type'] 				= 'Type';
	$lang['Definition'] 		= 'Definitie';
	$lang['Type_lists_title'] 	= 'Lijst van Waarden';
	$lang['Type_lists_explain'] = 'Je moet dezelfde code schrijven als welke je in de <strong>values_list</strong> array zou zetten, maar in plaats van gebruik te maken van de naam values_list, maak je gebruik van <strong>new_lists</strong>. Een <strong>$ is niet toegestaan</strong> in de code en zal er uit verwijderd worden. Wanneer je een lijst probeert op te slaan die al bestaat, zal die lijst worden bijgewerkt met de nieuw opgegeven waarden. Voorbeeld:<pre>
new_lists = array(
		\'list_im_versions\' => array(
				\'values\' => array(
					0 => array(\'txt\' => \'1.2.x\', \'img\' => \'\'),
					1 => array(\'txt\' => \'1.3.1\', \'img\' => \'\'),
					2 => array(\'txt\' => \'1.3.2\', \'img\' => \'\'),
					3 => array(\'txt\' => \'1.3.2c\', \'img\' => \'\'),
					4 => array(\'txt\' => \'1.3.2d\', \'img\' => \'\'),
					5 => array(\'txt\' => \'1.3.2e\', \'img\' => \'\'),
					6 => array(\'txt\' => \'1.4.0\', \'img\' => \'\'),
				),
			),
		);</pre>';
	$lang['Type_classes_title'] 	= 'Klassen<BR /> voor <em>Wanneer Tonen</em>';
	$lang['Type_classes_explain'] 	= 'Je moet dezelfde code schrijven als welke je in de <strong>classes_fields</strong> array zou zetten, maar in plaats van gebruik te maken van de naam classes_fields, maak je gebruik van <strong>new_classes</strong>. Een <strong>$ is niet toegestaan</strong> in de code en zal er uit verwijderd worden. Wanneer je een klasse probeert op te slaan die al bestaat, zal die klasse worden bijgewerkt met de nieuw opgegeven data. Voorbeeld:
<pre>
new_classes = array(
		\'imversion\' => array(
				\'config_field\'	=> \'user_viewimversion\',
				\'admin_field\'	=> \'\',
				\'user_field\'	=> \'user_viewimversion\',
				\'sql_def\'		=> \'
				[USERS].user_id = [view.user_id] OR ( ( [BUDDY_MY].buddy_ignore <> 1 OR
			 	[BUDDY_MY].buddy_ignore IS NULL ) AND ( [board.user_viewimversion] <> 0 OR 
			 	[board.user_viewimversion_over] <> 1 ) AND ( [BUDDY_OF].buddy_visible = 1 OR ( 
			 	[USERS].user_viewimversion = 1 OR ([board.user_viewimversion] = 1 AND 
			 	[board.user_viewimversion_over] = 1) ) OR ( [BUDDY_OF].buddy_ignore = 0 AND ( 
			 	[USERS].user_viewimversion = 2 OR ([board.user_viewimversion] = 2 AND 
			 	[board.user_viewimversion_over] = 1) ) ) ) )\',
			),
		);
</pre>';
	$lang['Type_fields_title'] 		= 'Velden';
	$lang['Type_fields_explain'] 	= 'Je moet dezelfde code schrijven als welke je in de <strong>user_fields</strong> array zou zetten, maar in plaats van gebruik te maken van de naam user_fields, maak je gebruik van <strong>new_fields</strong>. Een <strong>$ is niet toegestaan</strong> in de code en zal er uit verwijderd worden. Wanneer je een veld probeert op te slaan dat al bestaat, zal dat veld worden bijgewerkt met de nieuw opgegeven data. Voorbeeld:
<pre>
new_fields = array(
		\'user_viewimversion\' => array(
				\'lang_key\'     => \'Public_view_imversion\',
				\'class\'        => \'generic\',
				\'type\'         => \'TINYINT\',
				\'get_mode\'     => \'LIST_RADIO\',
				\'values\'       => \'list_yes_no_friend\',				
		),
		\'user_imversion\' => array(
				\'lang_key\'     => \'Im_version\',
				\'class\'        => \'imversion\',
				\'type\'         => \'VARCHAR\',
				\'dsp_func\'     => \'pcp_output_imversion\',
		),
);
</pre>';
	$lang['Type_deletes_title'] 	= 'Verwijder Lijsten, Klassen en Velden';
	$lang['Type_deletes_explain'] 	= 'Je moet een array maken met de naam <strong>deletes</strong> zoals in het voorbeeld. Een <strong>$ is niet toegestaan</strong> in de code en zal er uit verwijderd worden. Voorbeeld:
<pre>
deletes = array(
	\'lists\' => array(
		\'list_im_versions\',
	),
	\'classes\' => array(
		\'imversion\',
	),
	\'fields\' => array(
		\'user_viewimversion\',
		\'user_imversion\', 
	),
);
</pre>';
	$lang['Wiz_pageimport'] 			= 'Importeer Pagina\'s';
	$lang['Wiz_pageimport_description'] = 'Hier kun je pagina definities importeren die nodig zijn voor het implementeren van mods.';
	$lang['Type_newpages_title'] 		= 'Nieuw / Bewerk Pagina\'s';
	$lang['Type_newpages_explain'] 		= 'Je moet dezelfde code schrijven als welke je in de <strong>user_maps</strong> array zou zetten, maar in plaats van gebruik te maken van de naam user_maps, maak je gebruik van <strong>new_pages</strong>. Een <strong>$ is niet toegestaan</strong> in de code en zal er uit verwijderd worden. Wanneer je een pagina probeert op te slaan die al bestaat, zal die pagina worden bijgewerkt met de nieuw opgegeven data. Voorbeeld:
<pre>
new_pages = array(	
	\'DEMO\' => array(
		\'title\'		=> \'Demo\',
	),
	\'DEMO.info\' => array(
		\'title\'		=> \'Demo_Info\',
		\'fields\'	=> array(
			\'user_photo\' => array(
				\'txt\'          => true,
				\'img\'          => true,
				\'crlf\'         => true,
				\'style\'        => \'<div class="gensmall">%s</div>\',
			),
		),
	),
);
</pre>
';
	$lang['Type_delpages_title'] 	= 'Verwijder Pagina\'s';
	$lang['Type_delpages_explain']	= 'Je moet een array maken van de te verwijderen pagina\'s met de naam <strong>del_pages</strong>. Een <strong>$ is niet toegestaan</strong> in de code en zal er uit verwijderd worden. Voorbeeld:
<pre>
del_pages = array(	
	\'DEMO\',
);
</pre>';
	$lang['Type_newpagefields_title'] 	= 'Nieuw / Bewerk Pagina Velden';
	$lang['Type_newpagefields_explain'] = 'Je moet de zelfde code schrijven als welke je in de <strong>user_maps</strong> array zou zetten, maar in plaats van gebruik te maken van de naam user_maps, maak je gebruik van <strong>new_pagefields</strong> en moet je voor elke pagina een nieuwe key toevoegen genaamd <strong>position</strong>. Kies <strong>begin, end of een veldnaam</strong> van de pagina. De positie zal bepalen waar de nieuwe velden binnen de pagina zullen komen. Een <strong>$ is niet toegestaan</strong> in de code en zal er uit verwijderd worden. Wanneer je een veld probeert op te slaan dat reeds bestaat, zal dat veld bijgewerkt worden met de nieuw opgegeven data. Voorbeeld:
<pre>
new_pagefields = array(	
	\'DEMO.info\'  => array(
		\'position\' => \'user_photo\', // choose begin, end or a fieldname
		\'fields\'	 => array(
			\'user_avatar\' => array(
				\'img\'          => true,
			),
			\'user_warning\' => array(
				\'img\'          => true,
			),
		),
	),
);</pre>';
	$lang['Type_delpagefields_title'] 	= 'Verwijder Pagina Velden';
	$lang['Type_delpagefields_explain'] = 'Je moet de zelfde code schrijven als welke je in de <strong>user_maps</strong> array zou zetten, maar in plaats van gebruik te maken van de naam user_maps, maak je gebruik van <strong>del_pagefields</strong>. Een <strong>$ is niet toegestaan</strong> in de code en zal er uit verwijderd worden. Voorbeeld:
<pre>
del_pagefields = array(	
	\'DEMO.info\'  => array(
		\'fields\'	 => array(
			\'user_avatar\' => array(
			),
		),
	),
);</pre>';
	$lang['Wiz_import_error'] 			= 'Error bij importeer poging van <strong>%s</strong>';
	$lang['Wiz_backups'] 				= 'Backups';
	$lang['Wiz_backups_description'] 	= 'Hier kun je een backup van je PCP Bestanden maken en verwijderen of een backup terugzetten.';
	$lang['Wiz_backups_explain'] 		= '<span class="explaintitle">Backup</span>: Toont de datum en de bestandsnaam van de backup.<br>
						<span class="explaintitle">Actie</span>: Wat moet er met het bestand gebeuren.<br>
						<span class="explaintitle">Terugzetten</span>: Plaatst het geselecteerde bestand terug nadat er een backup van het huidige bestand is gemaakt.<br>
						<span class="explaintitle">Verwijder</span>: Verwijdert de geselecteerde backup.<br>
						<span class="explaintitle">Bekijken</span>: Toont de geselecteerde backup.<br>
						<span class="explaintitle">Backup Nu!</span>: Maakt een backup van de 2 bestanden: /profilcp/def/def_userfields.php en /profilcp/def/def_usermaps.php.<br>';
	$lang['Restore'] 			= 'Terugzetten';
	$lang['File_deleted'] 		= 'Succesvol verwijderd Bestand: %s';
	$lang['File_restored'] 		= 'Succesvol teruggezet Bestand: %s';
	$lang['backupnow']			= 'Backup Nu!';
	$lang['Backups_created']	= 'Backup bestanden gemaakt';
}

?>