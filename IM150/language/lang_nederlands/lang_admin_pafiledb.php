<?php
/***************************************************************************
 *                       lang_admin_pafiledb.php [Nederlands]
 *                            -------------------
 *
 *   Nederlandse vertaling  : Maart 2005 
 *   The Dutch Team         : http://www.integramod.nl 
 *
 *   note: removing the original copyright is illegal even you have modified
 *         the code.  Just append yours if you have modified it.
 ***************************************************************************/

// Categories

$lang['Cat_manage_title'] = 'Categorie Beheer';
$lang['File_manage_title'] = 'Bestands Beheer';
$lang['All_files'] = 'Alle Bestanden';
$lang['Approved_files'] = 'Afgekeurde Bestanden';
$lang['Broken_files'] = 'Beschadigde Bestanden';
$lang['File_cat'] = 'Bestand in Categorie';
$lang['Maintenance'] = 'Bestands Onderhoud';
$lang['Approve'] = 'Goed gekeurd';
$lang['Unapprove'] = 'Afgekeurd';
$lang['File_mode'] = 'Bekijken';
$lang['Approve_selected'] = 'Geselecteerde Goedkeuren';
$lang['Unapprove_selected'] = 'Geselecteerde Afkeuren';
$lang['Delete_selected'] = 'Geselecteerde Verwijderen';
$lang['No_file'] = 'Er zijn geen bestanden';
$lang['Acat'] = 'Categorie: Toevoegen';
$lang['Ecat'] = 'Categorie: Wijzigen';
$lang['Dcat'] = 'Categorie: Verwijderen';
$lang['Rcat'] = 'Categorie: Schikken';
$lang['Cat_Permissions'] = 'Categorie Rechten';
$lang['User_Permissions'] = 'Gebruikers Rechten';
$lang['Group_Permissions'] = 'Groep Rechten';
$lang['User_Global_Permissions'] = 'Gebruiker Globale Rechten';
$lang['Group_Global_Permissions'] = 'Groep Globale Rechten';
$lang['Acattitle'] = 'Categorie toevoegen'; 
$lang['Ecattitle'] = 'Categorie wijzigen'; 
$lang['Dcattitle'] = 'Categorie verwijderen'; 
$lang['Rcattitle'] = 'Categorieën sorteren'; 
$lang['Catexplain'] = 'Hier kun je Categorieën Toevoegen, Bewerken, Verwijderen en schikken. <br />Om bestanden te kunnen toevoegen moet je minimaal één Categorie hebben gemaakt. <br />Selecteer hieronder een link om de Categorieën te beheren.'; 
$lang['Rcatexplain'] = 'Hier kun je de volgorde van de categorieen aanpassen waarin ze worden getoond op de hoofd pagina. <br />To reorder the categories, change the numbers to the order you want them shown in. <br />1 will be showed first, 2 will be shown second, etc. This does not affect sub-categories.';
$lang['Catadded'] = 'De nieuwe categorie is toegevoegd';
$lang['Catname'] = 'Categorie Naam';
$lang['Catnameinfo'] = 'Dit wordt de naam van de Categorie.';
$lang['Catdesc'] = 'Categorie Omschrijving';
$lang['Catdescinfo'] = 'Dit is een Omschrijving van de bestanden die je in deze Categorie plaatst';
$lang['Catparent'] = 'Bovenliggende Categorie';
$lang['Catparentinfo'] = 'Wanneer je wilt dat dit een sub-categorie is, selecteer de categorie waarvan je wilt dat het een sub-categorie wordt.';
$lang['Allow_file'] = 'Bestand Toevoegen Toestaan';
$lang['Allow_file_info'] = 'Wanneer je Bestand Upload niet toestaat dan wordt deze Categorie een Hoger Niveau Categorie en kun je hier Sub-Categorieën aan toevoegen, zoals in het forum.';
$lang['None'] = 'Geen';
$lang['Catedited'] = 'De geselecteerde categorie is gewijzigd';
$lang['Delfiles'] = 'Wat wil je met de bestanden in de Categorie doen?';
$lang['Do_cat'] = 'Wat wil je met de sub-categorie in deze categorie doen?';
$lang['Move_to'] = 'Verplaats naar';
$lang['Catsdeleted'] = 'De geselecteerde Categorieën zijn verwijderd';
$lang['Cdelerror'] = 'Je hebt geen Categorieën geselecteerd om te verwijderen';
$lang['Rcatdone'] = 'De Categorieën zijn opnieuw geordend';

//Catgories Permission
$lang['View'] = 'Bekijken';
$lang['Read'] = 'Lezen';
$lang['View_file'] = 'Bekijk bestand';
// MX Addon
$lang['Delete_file'] = 'Verwijder bestand';
$lang['Edit_file'] = 'Wijzig bestand';
// End
$lang['Upload'] = 'Bestand Toevoegen';
$lang['Download_file'] = 'Download bestand';
$lang['Rate'] = 'classificeer';
$lang['View_comment'] = 'Commentaar bekijken';
$lang['Post_comment'] = 'Commentaar toevoegen';
$lang['Edit_comment'] = 'Commentaar wijzigen (n/a)';
$lang['Delete_comment'] = 'Commentaar verwijderen';
$lang['Category_auth_updated'] = 'Categorie rechten aangepast';
$lang['Click_return_catauth'] = 'Terug naar Categorie rechten Klik %sHier%s';
$lang['Auth_Control_Category'] = 'Categorie Rechten Control';
$lang['Category_auth_explain'] = 'Hier kun je de authorisatie nivau\'s van elke categorie regelen. <br />Bedenk dat wijziging van de rechten van categorieen gebruikers deze kunnen/zullen gebruiken.';
$lang['Select_a_Category'] = 'Selecteer een Categorie';
$lang['Look_up_Category'] = 'Zoek Categorie';
$lang['Category'] = 'Categorie';
$lang['Auth_Control_Category'] = 'Categorie Rechten Beheer';

$lang['Category_ALL'] = 'ALL';
$lang['Category_REG'] = 'REG';
$lang['Category_PRIVATE'] = 'PRIVATE';
$lang['Category_MOD'] = 'MOD';
$lang['Category_ADMIN'] = 'ADMIN';

// Configuration
$lang['Settings'] = 'Configuratie';
$lang['Settingstitle'] = 'Download Configuratie';
$lang['Settingsexplain'] = 'Het formulier hieronder zal u in staat stellen om alle algemene download opties aan te passen.';
$lang['Dbname'] = 'Database Naam';
$lang['Dbnameinfo'] = 'Dit is de naam van het gegevensbestand, zoals \'Download Index\'';
$lang['Sitename'] = 'Site Naam';
$lang['Sitenameinfo'] = 'Dit is de naam van uw Site voor het navigatie menu, zoals \'Home\'';
$lang['Dburl'] = 'Database URL';
$lang['Dburlinfo'] = 'Dat is de URL van de directorie waar deze is geinstalleerd';
$lang['Hpurl'] = 'Homepage URL';
$lang['Hpurlinfo'] = 'Dat is the URL naar je portaal of homepage';
$lang['Topnum'] = 'Top Nummmer';
$lang['Topnuminfo'] = 'Aantal bestanden dat wordt getoond op de Top X ge-Downloade bestanden lijst';
$lang['Nfdays'] = 'Nieuwe Bestanden (aantal Dagen)';
$lang['Nfdaysinfo'] = 'Hoeveel dagen moet een nieuw bestand met het \'New File\' icon worden geplaatst. Wanneer deze op 5 staat, worden alle bestanden die de afgelopen 5 dagen zijn toegevoegd het \'New File\' icon krijgen';
$lang['Showva'] = 'Bekijken \'Alle Bestanden\'';
$lang['Showvainfo'] = 'Choose whether or not you wish to have the \'View All Files\' categorie displayed with the other categories on the main page';
$lang['Php_template'] = 'PHP in sjabloon';
$lang['Php_template_info'] = 'Hiermee kun je het gebruik van PHP in de template bestanden toestaan';
$lang['Dbdl'] = 'Uitschakelen Downloads';
$lang['Dbdlinfo'] = 'Hierdoor zal de download sectie niet beschibaar zijn voor gebruikers. Dit is een goede optie wanneer je aan dit gedeelte werkt. Alleen Beheerders zullen nog toegang hebben';
$lang['Isdisabled'] = 'De download sectie is op dit moment niet beschikbaar, probeer het later nog eens.';
$lang['Com_settings'] = 'Commentaar Instellingen';
$lang['Com_allowh'] = 'HTML toestaan';
$lang['Com_allowb'] = 'BBCode toestaan';
$lang['Com_allows'] = 'Smilies toestaan';
$lang['Com_allowl'] = 'Links toestaan';
$lang['Com_messagel'] = 'Standaard \'Geen Links\' Bericht';
$lang['Com_messagel_info'] = 'Wanneer links niet toegestaan zijn, zal in plaats daarvan deze tekst worden getoond';
$lang['Com_allowi'] = 'Plaatjes toestaan';
$lang['Com_messagei'] = 'Standaard \'Geen Plaatjes\' Bericht';
$lang['Com_messagei_info'] = 'Wanneer afbeeldingen niet toegestaan zijn, zal in plaats daarvan deze tekst worden getoond';
$lang['Max_char'] = 'Maximum aantal Karakters';
$lang['Max_char_info'] = 'Wanneer iemand een commentaar plaatst, waarin meer karakters zijn dan toegestaan, zal een Fout bericht worden getoond (Beperk het commentaar).';
$lang['Settings_changed'] = 'Je instellingen zijn aangepast';
$lang['File_per_page'] = 'Aantal bestanden per pagina';
$lang['File_per_page_info'] = 'Hier kun je het aantal bestanden per pagina bepalen, wanneer je deze leeg laat zullen 20 bestanden per pagina getoond worden.';
$lang['Hotlink_prevent'] = 'Hotlink tegen gaan';
$lang['Hotlinl_prevent_info'] = 'Zet deze op Ja wanneer je GEEN hotlinks naar bestanden wilt toestaan';
$lang['Hotlink_allowed'] = 'Toegestane hotlink domeinen';
$lang['Hotlink_allowed_info'] = 'Toegestane hotlink domeinen (komma geschijden), bijvoorbeeld, www.phpbb.com, www.forumimages.com';
$lang['Default_sort_method'] = 'Standaard Sorteer Methode';
$lang['Default_sort_order'] = 'Standaard Sorteer volgorde';
$lang['Max_filesize'] = 'Maximum Bestands Grote';
$lang['Max_filesize_explain'] = 'Maximum bestandsgrote. Een waarde van 0 betekend \'geen limiet\'. Deze instelling wordt beperkt door de Server configuratie. Bijvoorbeeld, wanneer de php Configuratie een maximum upload toestaat van 2 MB, kan dat hier niet worden verandert.';
$lang['Upload_directory'] = 'Upload Directorie';
$lang['Upload_directory_explain'] = 'Vul het relatieve path van je phpBB2 installatie naar de bestands upload directorie in. Bijvoorbeeld,  \'pafiledb/uploads/\' wanneer je phpBB2 Installatie staat op http://www.yourdomain.com/phpBB2 en de Bestand Upload Directory staat op http://www.yourdomain.com/phpBB2/pafiledb/uploads.';
$lang['Screenshots_directory'] = 'Schermafdruk Directory';
$lang['Screenshots_directory_explain'] = 'Vul het relatieve path van je phpBB2 installatie naar de Schermafdrukken upload directorie. Bijvoorbeeld,  \'pafiledb/images/screenshots/\' wanneer je phpBB2 Installatie staat op http://www.yourdomain.com/phpBB2 en de Schermafdrukken Upload Directory staat op http://www.yourdomain.com/phpBB2/pafiledb/images/screenshots.';
$lang['Forbidden_extensions'] = 'Verboden Extenties';
$lang['Forbidden_extensions_explain'] = 'Hier kun je verboden bestands extenties Toevoegen of Verwijderen. De extenties moet je schijden met een komma.';
$lang['Permission_settings'] = 'Rechten instellingen';
$lang['Auth_search'] = 'Zoek Rechten';
$lang['Auth_search_explain'] = 'Zoeken toestaan voor specifiek type gebruikers';
$lang['Auth_stats'] = 'Statistieken Rechten';
$lang['Auth_stats_explain'] = 'Statistieken toestaan voor specifiek type gebruikers';
$lang['Auth_toplist'] = 'Toplijst Rechten';
$lang['Auth_toplist_explain'] = 'Toplijst toestaan voor specifiek type gebruikers';
$lang['Auth_viewall'] = 'Alles bekijken Rechten';
$lang['Auth_viewall_explain'] = 'Alles bekijken toestaan voor specifiek type gebruikers';
$lang['Bytes'] = 'Bytes';
$lang['KB'] = 'KB';
$lang['MB'] = 'MB';


// Custom Field
$lang['Afield'] = 'Eigen veld: Toevoegen';
$lang['Efield'] = 'Eigen veld: Bewerken';
$lang['Dfield'] = 'Eigen veld: Verwijderen';
$lang['Mfieldtitle'] = 'Eigen velden';
$lang['Afieldtitle'] = 'Veld toevoegen';
$lang['Efieldtitle'] = 'Veld bewerken';
$lang['Dfieldtitle'] = 'Veld verwijderen';
$lang['Fieldexplain'] = 'Je kunt de Eigen velden beheer pagina gebruiken om Eigen velden toe te voegen, bewerken, en te verwijderen. Je kunt Eigen velden gebruiken om meer informatie over een bestande te geven. Bijvoorbeeld, om de bestands grote in aan te geven, daarvoor maak je dan een veld zodat je op de pagina om een bestand toe te voegen of te wijzigen dit kunt invullen.';
$lang['Fieldname'] = 'Veld Naam';
$lang['Fieldnameinfo'] = 'Dit is de naam van het veld, bijvoorbeeld \'File Size\'';
$lang['Fielddesc'] = 'Veld Omschrijving';
$lang['Fielddescinfo'] = 'Dit is een omschrijving van het veld, bijvoorbeeld \'Bestand Grote in Megabytes\'';
$lang['Fieldadded'] = 'Het Eigen veld is succesvol toegevoegd';
$lang['Fieldedited'] = 'Het Eigen veld dat je selecteerde is succesvol gewijzigd';
$lang['Dfielderror'] = 'Je hebt geen velden geselecteerd om te verwijderen';
$lang['Fieldsdel'] = 'De Eigen velden die je selecteerde zijn succesvol verwijderd';

$lang['Field_data'] = 'Opties';
$lang['Field_data_info'] = 'Vul de opties in waaruit de gebruikers kunnen kiezen. Elke optie op een nieuwe regel.';
$lang['Field_regex'] = 'Standaard Uitdrukking';
$lang['Field_regex_info'] = 'Je kunt een input veld een standaard uitdrukking eisen %s(PCRE)%s.';
$lang['Field_order'] = 'Volgorde';

// File
$lang['Afile'] = 'Bestand: Toevoegen';
$lang['Efile'] = 'Bestand: Wijzigen';
$lang['Dfile'] = 'Bestand: Verwijderen';
$lang['Afiletitle'] = 'Toevoegen Bestand';
$lang['Efiletitle'] = 'Wijzigen Bestand';
$lang['Dfiletitle'] = 'Verwijderen Bestand';
$lang['Fileexplain'] = 'Je kunt de bestand beheer pagina gebruiken om bestanden toe te voegen, bewerken, of verwijderen.';
$lang['Upload'] = 'Upload Bestand';
$lang['Uploadinfo'] = 'Dit bestand Uploaden';
$lang['Uploaderror'] = 'Dit bestand bestaat al. Hernoem het bestand en probeer het nog eens.';
$lang['Uploaddone'] = 'Het bestand is succesvol geupload. De URL naar het bestand is';
$lang['Uploaddone2'] = 'Klik Hier om deze URL in het Download URL veld te plaatsen.';
$lang['Upload_do_done'] = 'Upload Succesvol';
$lang['Upload_do_not'] = 'Upload NIET Succesvol';
$lang['Upload_do_exist'] = 'Bestand bestaat al';
$lang['Filename'] = 'Bestands Naam';
$lang['Filenameinfo'] = 'Vul hier de naam van het bestand in, zoals \'Mijn foto\'.';
$lang['Filesd'] = 'Korte Omschrijving';
$lang['Filesdinfo'] = 'Dit is een korte beschrijving van het bestand. Dit komt op de pagina met een lijst van alle bestanden in een categorie, dus deze beschrijving moet kort zijn';
$lang['Fileld'] = 'Lange Omschrijving';
$lang['Fileldinfo'] = 'Dit is een langere omschijving van het bestand. Deze komt op de informatie pagina van het bestand, daarom kan deze omschrijving langer zijn.';
$lang['Filecreator'] = 'Maker/Auteur';
$lang['Filecreatorinfo'] = 'Dit is de naam van de maker van het bestand.';
$lang['Fileversion'] = 'Bestands Versie';
$lang['Fileversioninfo'] = 'Vul hier de bestands versie in, zoals 3.0 of 1.3 Beta';
$lang['Filess'] = 'Schermafdruk URL';
$lang['Filessinfo'] = 'Dit is een URL naar een schermafdruk van het bestand. Bijvoorbeeld, als je een Winamp skin toevoegt, dit zou dan een URL naar een schermafdruk van Winamp met deze skin kunnen zijn. Je kunt een URL handmatig invoegen of je kunt het leeg laten en een schermafdruk uploaden met de knop bladeren hierboven.';
$lang['Filess_upload'] = 'Upload Schermafdruk';
$lang['Filessinfo_upload'] = 'Je kunt een schermafdruk uploaden door op bladeren te klikken';
$lang['Filess_link'] = 'Link naar een schermafdruk';
$lang['Filess_link_info'] = 'Klik Ja aan, wanneer je schermafdrukken via een link wilt toevoegen.';
$lang['Filedocs'] = 'Documentatie/Handleiding URL';
$lang['Filedocsinfo'] = 'Dit is een link naar de documentatie of handleiding voor het bestand';
$lang['Fileurl'] = 'URL Bestand';
$lang['Fileurlinfo'] = 'This is a URL to the file that will be downloaded. You can type it in manually or you can click on browse above and upload a file.';
$lang['File_upload'] = 'Bestand Upload';
$lang['Fileinfo_upload'] = 'Je kunt een bestand uploaden door op bladeren te klikken';
$lang['Uploaded_file'] = 'GeUpload bestand';
$lang['Filepi'] = 'Plaats Icon';
$lang['Filepiinfo'] = 'Je kunt een pictogram voor het bestand kiezen. Het pictogram zal naast het bestand in de lijst van bestanden worden getoond.';
$lang['Filecat'] = 'Categorie';
$lang['Filecatinfo'] = 'This is the category the file belongs in.';
$lang['Filelicense'] = 'Licentie';
$lang['Filelicenseinfo'] = 'Dit is de licentie overeenkomst waar de gebruiker mee akkoord moet gaan voordat het bestand gedownload kan worden.';
$lang['Filepin'] = 'Pin Bestand';
$lang['Filepininfo'] = 'Kies of je het bestand wilt vast Pinnen of niet. Een bestand dat vast gepind is zal altijd bovenaan in de lijst staan.';
$lang['Fileadded'] = 'Het bestand is toegevoegd';
// MX Addon
$lang['Filedeleted'] = 'Het bestand is verwijderd';
// End
$lang['Fileedited'] = 'Het bestand is aangepast';
$lang['Fderror'] = 'Je hebt geen bestand geselecteerd om te verwijderen';
$lang['Filesdeleted'] = 'De door jou geselecteerde bestanden zijn verwijderd';
$lang['Filetoobig'] = 'Het bestand is te groot!';
$lang['Approved'] = 'Goed gekeurd';
$lang['Not_approved'] = '(NIET Goed Gekeurd)';
$lang['Approved_info'] = 'Gebruik deze optie om het bestand aan de gebruikers ter beschikking te stellen, en ook om het bestand dat ge-upload is door een gebruiker goed te keuren.';
$lang['Fchecker'] = 'Bestands Onderhoud';
$lang['File_checker'] = 'Bestands Onderhoud';
$lang['File_checker_explain'] = 'Hier kunt u bestanden in het gegevensbestand en bestanden in de download folder controleren.';
$lang['File_saftey'] = 'Bestands onderhoud zal proberen om alle bestanden en screenshots die momenteel niet nodig zijn te verwijderen, en zal database vermeldingen waar het bestand of de scherm afdruk niet meer aanwezig zijn verwijderen. <br /><br />Als de bestanden niet beginnen met <FONT COLOR="#FF0000">{html_path}</FONT>dan zullen de bestanden om veiligheidsredenen worden overgeslagen. <br /><br />Zorg ervoor dat <FONT COLOR="#FF0000">{html_path}</FONT> het path is dat je voor bestanden gebruikt.<br /><br /><b>Attentie:</b> Het is strerk aan te raden om eerst een <b><a href="' . append_sid("admin_db_utilities.php?perform=backup") . '" class="genmed"> Backup van je database</a></b> te maken.';
$lang['File_checker_perform'] = 'Controleer Prestaties';
$lang['Checker_saved'] = 'Totaal bespaarde ruimte';
$lang['Checker_sp1'] = 'Database controleren op ontbrekende bestanden...';
$lang['Checker_sp2'] = 'Database controleren op ontbrekende schermafdrukken...';
$lang['Checker_sp3'] = 'Niet gebruikte bestanden verwijderen...'; 
$lang['Filedls'] = 'Download Totaal';
$lang['Addtional_field'] = 'Extra Veld';
$lang['File_not_found'] = 'Het bestand kan niet gevonden worden';
$lang['SS_not_found'] = 'De schermafdruk kan niet gevonden worden';
// License 
$lang['Alicense'] = 'Licentie: Toevoegen';
$lang['Elicense'] = 'Licentie: Bewerken';
$lang['Dlicense'] = 'Licentie: Verwijderen';
$lang['Alicensetitle'] = 'Toevoegen Licentie';
$lang['Elicensetitle'] = 'Bewerken Licentie';
$lang['Dlicensetitle'] = 'Verwijderen Licentie';
$lang['Licenseexplain'] = 'Je kunt de Licentie beheer sectie gebruiken om licentie overeenkomsten toe te voegen, bewerken en te verwijderen.<br />Je kunt een licentie voor een bestand selecteren in de Toevoeg of Bewerk pagina.<br />Als een bestand een licentie overeenkomst heeft, zal een gebruiker akkoord moeten gaan alvorens het bestand te downloaden.';
$lang['Lname'] = 'Licentie Naam';
$lang['Ltext'] = 'License Tekst';
$lang['Licenseadded'] = 'De nieuwe licentie overeenkomst is met succes toegevoegd';
$lang['Licenseedited'] = 'De geselecteerde licentie overeenkomst is met succes bewerkt';
$lang['Lderror'] = 'Je hebt geen licentie geselecteerd om te verwijderen';
$lang['Ldeleted'] = 'De door jou geselecteerde licentie overeenkomsten zijn met succes verwijderd';
// MX
$lang['License_title'] = 'Licentie';
// ENd
$lang['Click_return'] = 'Terug naar vorige pagina Klik %sHier%s';
$lang['Click_edit_permissions'] = 'Rechten voor deze categorie bewerken Klik %sHier%s';

//Java script messages and php errors
$lang['Cat_name_missing'] = 'Vul het veld \'Categorie naam\' in';
$lang['Cat_conflict'] = 'Je kunt niet een categorie zonder bestand in een categorie hebben, die geen bestanden toestaat';
$lang['Cat_id_missing'] = 'Selecteer een categorie';
$lang['Missing_field'] = 'Gelieve alle vereiste velden te voltooien';


//Fields Types

$lang['Input'] = 'Enkelvoudige-Lijn Text Box';
$lang['Textarea'] = 'Enkelvoudige-Lijn Text Box';
$lang['Radio'] = 'Enkelvoudig-selectie Radio Buttons';
$lang['Select'] = 'Enkelvoudig-selectie Menu';
$lang['Select_multiple'] = 'Veelvoudig-selectie Menu';
$lang['Checkbox'] = 'Veelvoudig-selectie Checkbox';

// MX Addon
$lang['Validation_settings'] = 'Validatie van uploads';
$lang['Need_validate'] = 'Valideer uploads?';
$lang['Validator'] = 'Validator';
$lang['PM_notify'] = 'PM mededeling naar validator(s) (n/a)';
$lang['Validator_admin_option'] = 'Beheerder';
$lang['Validator_mod_option'] = 'Beheerder en cat moderator';

$lang['Allow_comments'] = 'Commentaren toestaan (n/a)';
$lang['Allow_comments_info'] = 'Commentaren toestaan in deze categorie.';
$lang['Allow_ratings'] = 'Classificatie toestaan (n/a)';
$lang['Allow_ratings_info'] = 'Classificatie Toestaan in deze categorie.';

$lang['MCP_title'] = 'Moderator Controle Paneel';
$lang['MCP_title_explain'] = 'Hier kunnen de moderatoren bestanden goedkeuren en beheren';

$lang['Fileadded_not_validated'] = 'Het nieuwe bestand is met succes toegevoegd, maar een moderator (beheerder) moet het bestand goedkeuren.';

?>
