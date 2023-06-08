<?php
/***************************************************************************
 *                        lang_install.php [English]
 *                            -------------------
 *   begin                : Saturday, July 10, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website              : http://www.integramod.com
 *   email                : webmaster@integramod.com
 *
 *   note: removing the original copyright is illegal even you have modified
 *         the code.  Just append yours if you have modified it.
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// Install Process
//
$lang['Welcome_install'] = 'Bienvenue à l\'installation de IntegraMOD151';
$lang['Initial_config'] = 'Configuration de base';
$lang['DB_config'] = 'Configuration de la base de données';
$lang['Admin_config'] = 'Configuration du compte Administrateur';
$lang['continue_upgrade'] = 'Une fois que vous avez téléchargé le fichier config vers votre ordinateur, vous pouvez cliquer sur le boutton \'Continuer la Mise à jour\' ci-dessous pour progresser dans le processus de mise à jour. Veuillez attendre la fin du processus de mise à jour avant d\'envoyer le fichier config.';
$lang['upgrade_submit'] = 'Continuer la Mise à jour';

$lang['Installer_Error'] = 'Une erreur s\'est produite durant l\'installation';
$lang['Previous_Install'] = 'Une installation précédente a été détectée';
$lang['Install_db_error'] = 'Une erreur s\'est produite en essayant de mettre à jour la base de données';

$lang['Re_install'] = 'Votre installation précédente est toujours active. <br /><br />Si vous voulez réinstaller phpBB 2, cliquez sur le bouton Oui ci-dessous. Vous êtes conscient qu\'en faisant cela, vous détruirez toutes les données existantes, aucune sauvegarde ne sera faites! le nom d\'utilisateur de l\'administrateur et le mot de passe que vous utilisez pour vous connecter au forum seront recréés après la réinstallation, mais rien d\'autre ne sera conservé. <br /><br />Réfléchissez bien avant d\'appuyer sur Oui!';

$lang['Inst_Step_0'] = 'Merci d\'avoir choisi phpBB 2. Afin d\'achever cette installation, veuillez remplir les détails demandés ci-dessous. Veuillez noter que la base de données dans laquelle vous installez devrait déjà exister. Si vous êtes en train d\'installer sur une base de données qui utilise ODBC (MS Access par exemple), vous devez d\'abord lui créer un SGBD avant de continuer.';

$lang['Start_Install'] = 'Démarrer l\'Installation';
$lang['Finish_Install'] = 'Finir l\'Installation';

$lang['Default_lang'] = 'Langue par défaut du Forum';
$lang['DB_Host'] = 'Nom du serveur de base de données / SGBD';
$lang['DB_Name'] = 'Nom de votre base de données';
$lang['DB_Username'] = 'Nom d\'utilisateur';
$lang['DB_Password'] = 'Mot de passe';
$lang['Database'] = 'Votre base de données';
$lang['Install_lang'] = 'Choisissez la langue pour l\'installation';
$lang['dbms'] = 'Type de la base de données';
$lang['Table_Prefix'] = 'Préfixe des tables';
$lang['Admin_Username'] = 'Nom d\'utilisateur';
$lang['Admin_Password'] = 'Mot de passe';
$lang['Admin_Password_confirm'] = 'Mot de passe [ confirmer ]';

$lang['Inst_Step_2'] = 'Votre compte d\'administration a été créé. A ce point, l\'installation de base est terminée. Vous allez être redirigé vers une nouvelle page qui vous permettra d\'administrer votre nouvelle installation. Veuillez vous assurer de vérifier les détails de la Configuration Générale et d\'opérer les changements qui s\'imposent. Merci d\'avoir choisi phpBB 2.';

$lang['Unwriteable_config'] = 'Votre fichier config est en lecture seule actuellement. Une copie du fichier config va vous être proposée en téléchargement après avoir avoir cliqué sur le boutton ci-dessous. Vous devrez envoyer ce fichier dans le même répertoire où est installé phpBB 2. Une fois terminé, vous pourrez vous connecter en utilisant vos nom d\'utilisateur et mot de passe d\'administrateur que vous avez fourni précédemment, et visiter le Panneau d\'Administration (un lien apparaîtra en bas de chaque page une fois connecté) pour vérifier la Configuration Générale. Merci d\'avoir choisi phpBB 2.';
$lang['Download_config'] = 'Télécharger config';

$lang['ftp_choose'] = 'Choisir le méthode de téléchargement';
$lang['ftp_option'] = '<br />Tant que les extensions FTP seront activés dans cette version de PHP, l\'option d\'essayer d\'envoyer automatiquement le fichier config sur un ftp peut vous être donnée.';
$lang['ftp_instructs'] = 'Vous avez choisi de transférer automatiquement via FTP le fichier vers le compte contenant phpBB 2. Veuillez compléter les informtions ci-dessous afin de faciliter cette opération. Notez que le chemin FTP doit être le chemin exact vers le répertoire où est installé phpBB2 comme si vous étiez en train d\'envoyer le fichier avec n\'importe quel client FTP.';
$lang['ftp_info'] = 'Entrez vos informations FTP';
$lang['Attempt_ftp'] = 'Essayer de transférer config vers un serveur ftp';
$lang['Send_file'] = 'Juste m\'envoyer le fichier et je l\'enverrai manuellement sur le serveur ftp';
$lang['ftp_path'] = 'Chemin de phpBB2 FTP';
$lang['ftp_username'] = 'Votre nom d\'utilisateur FTP';
$lang['ftp_password'] = 'Votre mot de passe FTP';
$lang['Transfer_config'] = 'Démarrer le transfert';
$lang['NoFTP_config'] = 'La tentative d\'envoi du fichier config par FTP a échoué. Veuillez télécharger le fichier config et l\'envoyer manuellement sur votre serveur FTP.';

$lang['Install'] = 'Installation';
$lang['Upgrade'] = 'Mise à jour';


$lang['Install_Method'] = 'Choix du type d\'installation';

$lang['Install_No_Ext'] = 'La configuration de php sur votre serveur ne supporte pas le type de base de données que vous avez choisi';


$lang['Install_No_PCRE'] = 'phpBB2 requiert le support des expressions régulières Perl pour PHP, mais votre configuration de PHP ne le supporte apparemment pas !';

$lang['Install_No_File_Open'] = 'Le fichier %s ne peut être ouvert, les privilèges de sécurité ne sont pas suffisants. Merci de vérifier les instructions du chmod dans le guide d\'installation.';

$lang['Go_to_prillian'] = 'J\'ai effacé le répertoire install... Installation du prillian maintenant...';
$lang['Go_to_profile'] = 'J\'ai effacé les répertoires install et prill_install... Compléter les détails d\'enregistrement de mon compte...';

$lang['Extra_procedures'] = '<tr><th>Procédures supplémentaires Integramod</center></th></tr><tr><td><p>
Les informations supplémentaires requises pour installer Integramod sont indiquées ci-dessous. <ul>
<li>Veuillez effacer le répertoire install maintenant afin de prévenir une erreur lorsque l\'installation sera terminée</li>
		%s
	</ul>
	Si vous avez la moindre question, rendez-vous sur <a href="http://www.integramod.com">integramod.com.</a></p></td></tr>';
$lang['Extra_procedures_no_prillian'] = '<li>Veuillez effacer le répertoire prill_install puisque vous ne voulez pas utiliser cette installation.</li>'; // comes inside 'Extra_procedures'

$lang['Admin_config_settings'] = 'Configuration sécurité phpBB</th>';
$lang['Admin_config_name'] = 'Choisir un nom pour "admin config". Toute entrée est valide, essayez de la limiter à 1 ou 2 maximum, comme <b>admins_allowed</b>. Il est cependant déconseillé d\'utiliser cette suggestion.';
$lang['Mod_config_name'] = 'Choisir un nom pour "mod config". Toute entrée est valide, essayez de la limiter à 1 ou 2 maximum, comme <b>mods_allowed</b>. Il est cependant déconseillé d\'utiliser cette suggestion.';
$lang['Unwanted_config_name'] = 'Choisir un nom pour "disable config". Toute entrée est valide, essayez de la limiter à 1 ou 2 maximum, comme <b>block_unwanted</b>. Il est cependant déconseillé d\'utiliser cette suggestion.';
$lang['No_prillian_wanted'] = 'Marquez cette case pour <strong>ne pas</strong> installer le prillian.';
$lang['Install_options'] = 'Options d\'installation';

?>