<?php
/***************************************************************************
 *                          lang_prillian.php [English]
 *                            -------------------
 *   begin                : Friday, Jan 31, 2003
 *   version              : 0.7.0
 *   date                 : 2003/12/23 23:21
 ***************************************************************************/

//
// CONTRIBUTORS:
//	 Add your details here if wanted, e.g. Name, username, email address, website
//

//
// The format of this file is ---> $lang['message'] = 'text';
// The file will be included separately of other language files as needed, but must
// be included after lang_main.php and/or lang_admin.php
//
//

// Do not change the next six lines.
// Avoid including the file more than once.
if ( defined('IN_PRILLIAN_LANG') )
{
	return;
}
define('IN_PRILLIAN_LANG', true);

// You may want to edit the following lines to match your website.
$lang['Launch_Prillian'] = 'Ouvrir Prillian';  // Link for opening the IM Client
$lang['Prillian_FAQ'] = 'Messagerie instantanée (MI)';   // Title of the IM FAQ
$lang['Prillian'] = 'Prillian';  // Name of Prillian, used throughout the scripts

$lang['New_ims'] = 'Vous avez %d nouveaux messages'; // You have 2 new IMs
$lang['New_im'] = 'Vous avez %d nouveau message'; // You have 1 new IM
$lang['Unread_ims'] = 'Vous avez %d nouveaux messages non lus'; // You have 2 new IMs
$lang['Unread_im'] = 'Vous avez %d nouveau message non lu'; // You have 1 new IM

// Main IM Client/Who's Online window
$lang['Users_Online'] = 'Utilisateurs connectés';
$lang['Buddies_Online'] = 'Contacts connectés';
$lang['Hidden_Users_Online'] = 'Utilisateurs invisibles connectés';
$lang['Guests_Online'] = 'Invités connectés';
$lang['Close_windows'] = 'Fermer la fenêtre';
$lang['Send_im'] = 'Envoyer un message instantané (MI)';
$lang['IM'] = 'MI';
$lang['PM'] = 'MP';
$lang['New_messages'] = 'Nouveaux messages et messages non lus';


// Controls panels
$lang['Controls'] = 'Contrôles';
$lang['Check_IMs'] = 'Vérifier ses MIs';
$lang['Message_Log'] = 'Messages enregistrés';
$lang['Alt_Message_Log'] = 'Ouvrir les messages enregistrés';
$lang['Alt_New_Messages'] = 'Vérifier les nouveaux messages';
$lang['Alt_Home'] = 'Retourner aux forums';
$lang['Alt_Close_Windows'] = 'Fermer toutes les fenêtres annexes';
$lang['Alt_Prefs'] = 'Editer les préférences de ' . $lang['Prillian'] . '';
$lang['Alt_Logout'] = 'Déconnecter du forum et de  ' . $lang['Prillian'];
$lang['Prillian_Help'] = 'Aide';


// Sending/replying
$lang['phpBB_IM_default_subject'] = $lang['Message'];
$lang['Send_new_im'] = 'Envoyer un nouveau message instantané';
$lang['Select_emoticon'] = 'Sélectionner les Smileys';
$lang['Save_reply_pm'] = 'Sauvegarder et répondre';
$lang['Save_close_pm'] = 'Sauvegarder et fermer';
$lang['Delete_reply_pm'] = 'Effacer et répondre';
$lang['Delete_close_pm'] = 'Effacer et fermer';
$lang['IM_Quick_reply'] = 'Réponse rapide';


// Error messages
$lang['Close_window_link'] = '<br /><br /><a href="javascript:window.close();">' . $lang['Close_window'] . '</a>';
$lang['IM_disabled'] = 'Désolé, mais la messagerie instantanée est désactivée sur ce forum.';
$lang['Ims_not_allowed'] = 'Désolé, mais la messagerie instantanée a été désactivée pour ce compte d\'utilisateur.';
$lang['Ims_not_allowed_fail'] = 'La désactivation de la messagerie instantanée pour ce compte d\'utilisateur ne peut être vérifiée.';
$lang['Cannot_send_im'] = 'Désolé, mais la messagerie instantanée a été désactivée pour votre compte. Si c\'est de votre fait, vous pouvez l\'activer dans vos %spreferences%s.';
$lang['Cannot_send_im_admin'] = 'Désolé, mais la messagerie instantanée a été désactivée pour votre compte par un administrateur du forum.';
$lang['Please_set_im_prefs'] = 'Vous n\'avez pas défini vos préférences pour la messagerie instantanée. SVP, prenez un moment pour le faire %sici%s.';
$lang['Admin_override'] = 'Désolé mais un administrateur a configuré le forum pour ignorer les préférences utilisateur et les remplacer par les préférences globales du forum. Vous ne pouvez pas changer vos préférences tant que cette option est activée.';
$lang['Too_many_ims'] = 'Désolé mais cet utilisateur à trop de messages instantané en attente d\'être lus. Réessayez plus tard.';
$lang['No_autoclose'] = 'Si vous voyez ce message, alors l\'option de fermeture automatique de fenêtre de ' . $lang['Prillian'] . ' ne marche pas avec votre navigateur. Une des causes possibles peut être la désactivation du Javascript dans votre navigateur. SVP, fermez cette fenêtre.';
$lang['User_no_im'] = 'Vous ne pouvez pas envoyer de messages instantané à cet utilisateur. ';
$lang['No_im_reply_info'] = 'Aucune information disponible pour ce message. Cela veut sans doute dire qu\'il a déjà été automatiquement effacé.';
$lang['No_Admins_Found'] = 'Aucun administrateur de forum ne peut être trouvé dans la base de données.';
$lang['No_post_type'] = 'Le type de message ne peut être défini.';
$lang['Admin_no_user_from'] = 'Aucun expéditeur ne peut être défini pour une vérification.';
$lang['Admin_no_user_to'] = 'Aucun destinataire ne peut être défini pour une vérification.';


// Site to Site
$lang['IM_no_users_online'] = 'Il n\'y aucun utilisateur connecté.';
$lang['Online_at'] = 'Utilisateur est connecté à ';
$lang['User_from'] = 'Utilisateur de ';


// Admin Site to Site
$lang['URL'] = 'URL';
$lang['Extension'] = 'Extension de Fichier';
$lang['Profile_path'] = 'Chemin vers le profil';
$lang['Extension_explain'] = 'C\'est "php" par défaut';
$lang['Profile_path_explain'] = 'C\'est "profil" par défaut';


// Preferences editor
$lang['Prillian_Profile_updated'] = 'Vos préférences ont été mises à jour.<br /><br />Si nécessaire, cliquez %sici%s pour recharger la messagerie instantanée.';

$lang['User_allow_ims'] = 'Activer le système de messagerie instantanée pour ce compte';
$lang['User_allow_shout'] = 'Autoriser l\'utilisation de la Shoutbox';
$lang['User_allow_chat'] = 'Autoriser l\'utilisation du chat';
$lang['Always_add_sig_explain'] = 'les signatures peuvent être changées dans votre profil';
$lang['Refresh_rate'] = 'Taux de rafraîchissement de la fenêtre principale';
$lang['Refresh_rate_explain1'] = 'Nombre de secondes entre chaque rafraîchissement dans la messagerie instantanée.';
$lang['Refresh_rate_explain2'] = 'Temps entre chaque rafraîchissement dans la messagerie instantanée.';
$lang['Success_close'] = 'Fermer automatiquement la fenêtre de message après l\'envoi d\'un message';
$lang['Refresh_method'] = 'Choisir la méthode de rafraîchissement pour la messagerie instantanée';
$lang['Refresh_method_explain'] = 'L\'utilisation des deux méthodes est recommandée';
$lang['JavaScript'] = 'JavaScript';
$lang['META_tag'] = 'META tag'; 
$lang['Use_both_methods'] = 'Utiliser les deux méthodes';
$lang['IM_auto_launch_pref'] = 'Ouvrir la messagerie quand vous visitez l\'index du forum'; 
$lang['IM_auto_popup'] = 'Ouvrir automatiquement les nouveaux messages';
$lang['IM_list_new'] = 'Afficher la liste des nouveaux messages et des messages non-lus dans la fenêtre principale';
$lang['Show_controls'] = 'Montrer le panneau de contrôle';

// Do not change the [0], [1], etc. parts of the following
$lang['Controls_select'][0] = 'Ne pas montrer';
$lang['Controls_select'][1] = 'Comme images seulement';
$lang['Controls_select'][2] = 'Comme liens seulement';
$lang['Controls_select'][3] = 'Les deux';
$lang['Who_to_list'] = 'Afficher ces utilisateurs dans la fenêtre principale';
$lang['Online_Lists'][1] = 'Tous les utilisateurs connectés';
$lang['Online_Lists'][2] = 'Contacts sur les forums';
$lang['Online_Lists'][3] = 'Contacts sur la messagerie instantanée';
$lang['Online_Lists'][4] = 'tous les contacts sur la messagerie instantanée';

// Include any options you want in the refresh rate drop down list here
// They should be in this format:
// $lang['Refresh_times']['number of seconds'] = 'name in list';
// The number of seconds can be no longer than 5 digits, unless you alter
// the im_prefs database table.
$lang['Refresh_times'][60] = '1 minute';
$lang['Refresh_times'][120] = '2 minutes';
$lang['Refresh_times'][180] = '3 minutes';
$lang['Refresh_times'][240] = '4 minutes';
$lang['Refresh_times'][300] = '5 minutes';

$lang['IM_play_sound'] = 'Jouer un son en cas de nouveau message';
$lang['Default_sound'] = 'Utiliser le son par défaut du forum';
$lang['Current_sound'] = 'Fichier actuel du son';
$lang['IM_style'] = 'Style utilisé par ' . $lang['Prillian'];
$lang['Width'] = 'Largeur';
$lang['Height'] = 'Hauteur';
$lang['Read_Message'] = 'Lire le message';
$lang['Send_Message'] = 'Envoyer le message';
$lang['Set_window_sizes'] = 'Définir les dimensions de fenêtre';
$lang['Set_window_sizes_explain'] = 'Toutes les dimensions sont en pixels';
$lang['Open_pms'] = 'Ouvrir et/ou afficher la liste des messages privés';
$lang['Auto_delete_ims'] = 'Activer la suppression automatique des messages instantanés lus, au rafraîchissement de la messagerie instantanée.';

// Admin preferences editor
$lang['Admin_allow_ims'] = 'Autoriser l\'utilisateur à envoyer et recevoir des messages instantanés';
$lang['Admin_allow_shout'] = 'Autoriser l\'utilisateur à utiliser la Shoutbox';
$lang['Admin_allow_chat'] = 'Autoriser l\'utilisateur à utiliser le chat';
$lang['IM_user_auto_launch'] = 'Ouvrir automatiquement la messagerie instantanée dans un utilisateur visite l\'index du forum et est connecté';
$lang['Admin_user_added'] = 'L\'utilisateur a été ajouté à la base de données des préférences.';
$lang['Admin_Set_window_sizes'] = 'Activer les dimensions par défaut des fenêtres';


// Admin Configuration
$lang['IM_auto_launch'] = 'Ouvrir la messagerie instantanée automatiquement quand un utilisateur connecté visite l\'index du forum.'; 
$lang['IM_box_limit'] = 'Nombre maximum de messages instantanés non lus';
$lang['IM_enable_flood'] = 'Activer le contrôle du Flood';
$lang['IM_override_settings'] = 'Ignorer les options personnelles de l\'utilisateur';
$lang['IM_override_settings_explain'] = 'Ceci désactivera les préférences de l\'utilisateur et activera les options définies par défaut du forum';
$lang['IM_enable_ims'] = 'Activer le système de messagerie instantanée';
$lang['IM_enable_shoutbox'] = 'Activer la Shoutbox';
$lang['IM_enable_chatbox'] = 'Activer le Chat';
$lang['IM_refresh_drop'] = 'Utiliser une liste déroulante vers le bas quant à la préférence de l\'utilisateur pour son taux de rafraîchissement';
$lang['IM_sound_name'] = 'Localisation du fichier son';
$lang['IM_allow_sound'] = 'Autoriser les utilisateurs à entendre un son quand ils reçoivent un nouveau message';
$lang['IM_default_sound'] = 'Autoriser les utilisateurs à entendre leur son personnel';
$lang['IM_allow_different_style'] = 'Autoriser ' . $lang['Prillian'] . ' à utiliser un thème différent de celui du reste du forum';
$lang['Prillian_Config'] = 'Configuration générale de ' . $lang['Prillian'] . ' ';
$lang['Prillian_Config_explain'] = 'Le champ ci-dessous vous autorise à configurer toutes les options générales de la messagerie. Elles sont utilisées pour définir les comportements par défauts et les options de l\'utilisateur. Pour les configurations individuelles des utilisateurs, utilisez les liens adéquats dans l\'autre cadre.';
$lang['IM_session_length'] = 'Durée en Secondes de la session de messagerie';
$lang['IM_session_length_explain'] = 'Cette fonction est utilisée pour déterminer si un utilisateur est actif sur la messagerie. Il est recommandé de mettre une valeur plus grande que le taux de rafraîchissement.';
$lang['IM_enable_imbox_limit'] = 'Activer la limite maximum de messages instantanés non-lus';


// Message Log
$lang['Messages_Sent_by'] = 'Messages envoyés par ';
$lang['Messages_Received_by'] = 'Messages reçus par ';
$lang['Offsite_Messages_Sent_by'] = 'Messages hors-site envoyés par ';
$lang['Offsite_Messages_Received_by'] = 'Messages hors-site reçus par ';
$lang['Received'] = 'Reçu(s)';
$lang['Offsite_Received'] = 'Hors-Forum reçu(s)';
$lang['Offsite_Sent'] = 'Hors-Forum envoyé(s)';
$lang['No_sent'] = 'Il n\'y a aucun message (envoyé par vous) enregistré.';
$lang['No_received'] = 'Il n\'y a aucun message (reçu par vous) enregistré.';
$lang['Message_Log_admin_explain'] = 'Ici vous pouvez voir les messages instantanés envoyés et reçus par vos utilisateurs.';



/* Entries Added in 0.7.0 */
$lang['Prill_new_posts'] = 'Posts sepuis la dernière visite';
$lang['No_prill_config'] = 'Les informations de configuration de Prillian ne peuvent être consultées';
$lang['No_prill_prefs'] = 'Les préférences de la messagerie instantanée ne peuvent être consultées';
$lang['No_prill_userprefs'] = 'Utilisateur non trouvé dans le tableau des préférences de la messagerie instantanée';
$lang['Not_authed_im_delete'] = 'Désolé, vous ne pouvez pas effacer les messages que vous avez envoyé.';
$lang['Back_to_log'] = '%sRevenir aux messages enregistrés%s';
$lang['Mini_Client_Window'] = 'Mode mini-messagerie';
$lang['Use_frames'] = 'Utiliser des cadres dans la messagerie instantanée';
$lang['Use_frames_explain'] = 'Utiliser des cadres accélère le chargement de la page quand vous consultez vos nouveaux messages.';
$lang['Use_frames_explain_admin'] = $lang['Use_frames_explain'] . ' Cela peut sauvegarder de la bande passante et ainsi soulager votre serveur.';
$lang['Default_mode'] = 'Mode à utiliser à l\'ouverture de la messagerie instantanée';

// Do not change the [0], [1], etc. parts of the following
$lang['Default_mode_select'][0] = 'Dernier mode utilisé';
$lang['Default_mode_select'][1] = 'Modes: <u>Normal</u>';
$lang['Default_mode_select'][2] = '<u>Etendu</u>';

//Be careful! Do not uncomment the next line!
//$lang['Default_mode_select'][3] = 'Mini Mode';
$lang['Size'] = 'Taille';
$lang['Color'] = 'Couleur';
$lang['Enabled_explain'] = 'Si vous mettez Non, vos utilisateurs ne seront pas autorisé à interagir avec ce site.';
$lang['Profile_path_ex_expanded'] = 'Entrez le chemin relatif à votre fichier profile.php, par rapport à la racine du forum (répertoire où se trouve votre forum). Ceci est utilisé par l\'option d\'auto-détection du système de messagerie à distance quand les administrateurs d\'autres sites tentent d\'auto-détecter votre site. Ne mettez pas l\'extension du fichier, mettez "profile" et pas "profile.php"';
$lang['Network_autodetect'] = 'Détecter automatiquement un nouveau site';
$lang['Network_autodetect_explain'] = 'Entrez l\'URL d\'un forum en-dessous, et Prillian tentera de se connecter à une messagerie Prillian sur le forum de cette URL. Si la connexion est établie, Prillian essayera d\'ajouter automatiquement ce site à votre liste  de messagerie à distance.<br /><br />Quand vous entrez une URL, assurez vous qu\'elle commence par soit http:// ou ftp:// et se termine par un slash (/). Aucun nom de fichier ne doit être inclus. Voici une URL correcte:<br />http://darkmods.sourceforge.net/mb/<br /><br />Les URL suivantes sont fausses:<br />darkmods.sourceforge.net/mb/<br />http://darkmods.sourceforge.net/<br />darkmods.sourceforge.net/mb<br />http://darkmods.sourceforge.net/mb/imclient.php<br />';
$lang['No_allow_url_fopen'] = 'La configuration PHP allow_url_fopen setting n\'est pas activée. Cela veut dire que les scripts PHP sur ce serveur ne peuvent pas se connecter à des sites éloignés. Vous ne pouvez donc pas utiliser la messagerie à distance. Sur la manière d\'activer cette option, veuillez vous adresser à votre hébergeur ou à l\'administrateur de votre serveur. Si vous *êtes* cette personne et que vous avez besoin de plus d\'informations, consultez le<a href="http://www.php.net/manual" target="_blank">Manuel PHP</a>, particulièrement les chapitres de configuration.<br /><br />Si vous voyez ce message, vous devriez désactiver la messagerie à distance dans la configuration de Prillian afin d\'accélérer la vitesse du programme . Vous pourrez activer la messagerie à distance plus tard si vous le désirez.';
$lang['ND_cannot_add'] = 'Le site dont vous avez entrez l\'URL ne peut pas être ajouté à votre messagerie à distance.';
$lang['ND_no_connect'] = 'le script ne peut pas se connecter au site éloigné en utilsant cette URL :';
$lang['ND_no_connect_explain'] = 'SVP, assurez-vous que vous avez taper l\'URL correctement, et qu\'elle commence par soit http:// soit ftp://. Vérifiez aussi que le site que vous voulez atteindre est connecté. Si ce n\'est pas le cas essayez plus tard.<br /><br />Si l\'URL est correcte et le site est connecté, Alors les composants pour la messagerie à distance de Prillian ne sont pas installés à cette URL. ' . $lang['ND_cannot_add'];
$lang['ND_disabled'] = 'La messagerie à distance est désactivée sur le site éloigné. ' . $lang['ND_cannot_add'];
$lang['ND_connected'] = 'Le script a pu se connecter au site éloigné avec succès !';
$lang['ND_enabled'] = 'La messagerie à distance est activée sur le site éloigné.';
$lang['ND_version'] = 'Une version différente de Prillian est installée sur le site éloigné, aussi il peut y avoir des conflits entre votre version et celle du site éloigné. Nous utiliserons l\'auto-détection pour le moment.';
$lang['ND_060'] = 'Le script a détecté que Prillian 0.6.0 est installé sur le site éloigné. Prillian 0.6.0 ne supporte pas l\'auto-detection, et le script ne peut ajouté ce site à votr liste de messagerie à distance. Vous pouvez l\'ajouter manuellement, si vous le désirez. Vous pouvez aussi suggérer à l\'administrateur du site éloigné de passer à la dernière version de Prillian.';
$lang['ND_Unnamed_Site'] = 'Site non nommé détecté';
$lang['ND_data_error'] = 'Il y a quelques problèmes avec les informations d\'auto-détection en prévenance du site éloigné, aussi ce site sera ajouté à votre messagerie à distance sous un statut désactivé avec au moins une valeur par défaut entrée. Vous devriez revoir les informations par l\'Editeur de messagerie à distance plus tard. L\'erreur peut être aussi simple qu\'un champ vide pour le nom d\'un site.';
$lang['ND_Added_Success'] = 'Le site a été ajouté avec succès à votre messagerie à distance !';
$lang['Allow_mode_switch'] = 'Autoriser les utilisateurs à choisir différents modes de messagerie';

// These three will be used when there are images for the mode switches
//$lang['Alt_Main_Mode'] = 'Changer le Client IM en Mode Normal';
//$lang['Alt_Wide_Mode'] = 'Changer le Client IM en Mode Etendu';
//$lang['Alt_Mini_Mode'] = 'Changer le Client IM en Mode Mini';
$lang['Alt_Main_Mode'] = 'Modes: <u>Normal</u>';
$lang['Alt_Wide_Mode'] = 'Modes: <u>Etendu</u>';
$lang['Alt_Mini_Mode'] = 'Modes: <u>Mini</u>';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';

// Adapted from Enhanced Admin User Lookup
$lang['User_lookup_explain'] = 'Vous pouvez rechercher des utilisateurs en spécifiant un ou plusieurs des critères ci-dessous. Aucune info supplémentaire n\'est nécessaire, elle sera ajouté automatiquement.';
$lang['One_user_found'] = 'Seulement un utilisateur a été trouvé, vous avez été dirigé vers cet utilisateur';
$lang['Click_goto_prefs'] = 'Cliquez %sici%s pour éditer les préférences de cet utilisateur';
$lang['Click_goto_log'] = 'Cliquez %sici%s pour voir les messages de cet utilisateur';
$lang['User_joined_explain'] = 'La syntaxe utilisée est identique à la fonction <a href="http://www.php.net/strtotime" target="_other">strtotime()</a> PHP';
$lang['Click_return_perms_admin'] = 'Cliquez %sIci%s Pour retourner au panneau de contrôle des permissions des utilisateurs';


/* Entries Changed in 0.7.0 */

// Controls panels
$lang['Alt_Contact_Man'] = 'Gérer les contacts'; // Was $lang['Alt_Buddy_Man']

// Preferences editor
$lang['Wide_Client_Window'] = 'Mode Etendu de la Messagerie '; // Was $lang['Whos_Online_Window']
$lang['Main_Window'] = 'Mode Normal de la Messagerie';

/* Any of these that have network in the $lang['name'] part used to have s2s in
 place of network. In some, that is the only change */
// Network Messaging
$lang['Network_disabled'] = 'Désolé, mais le le système à distance de messagerie instantanée a été désactivé sur ce forum.';
$lang['Network_no_username'] = 'La messagerie à distance ne reçoit pas votre nom ou votre ID d\'utilisateur.';
$lang['Network_no_siteurl'] = 'La messagerie à distance ne reçoit pas l\'URL du site d\'où vous envoyez votre message.';
$lang['Network_no_siteid'] = 'La messagerie à distance ne reçoit l\'ID du site Vers lequel vous envoyez votre message.';
$lang['Network_Users_online'] = 'Utilisateurs connectés d\'autres sites';
$lang['No_network_type'] = 'Le type ne peut pas être déterminé.';
$lang['Invalid_network_type'] = 'Un type valide ne peut pas être déterminé.';
$lang['Network_not_in_db'] = 'Désolé, mais le site d\'où vous envoyez votre message n\'est pas sur la liste des sites approuvés par le site où vous voulez envoyer votre message.';
$lang['Send_a_new_network'] = 'Envoyer un message à distance';
$lang['Reply_to_a_network'] = 'Répondre à un message à distance';
$lang['Network_Flood_Error'] = 'Le système à distance de messagerie instantanée ne peut pas recevoir un post si rapidement après le dernier. Svp, réessayez dans quelques instants.';

// Admin Network Messaging
$lang['Network_title'] = 'Editeur du système à distance de messagerie instantanée';
$lang['Network_explain'] = 'De cette page, vous pouvez ajouter, éditer et retirer des sites pour lesquels vos utilisateurs peuvent interagir avec l\'option de messagerie à distance de Prillian.';
$lang['Network_add'] = 'Ajouter un nouveau site';
$lang['Network_del_success'] = 'Le site a été effacé avec succès. Vos utilisateurs ne peuvent plus interagir avec ce site par l\'intermédiaire de Prillian.';
$lang['Click_return_network'] = 'Cliquez %sici%s pour retourner à la messagerie à distance.';
$lang['Network_config'] = 'Configuration du site';
$lang['Network_add_success'] = 'Les informations du site ont été modifiées avec succès.';

// Admin preferences editor
$lang['Admin_allow_network'] = 'Autoriser l\'utilisateur à utiliser le système à distance de messagerie instantanée';

// Preferences editor
$lang['User_allow_network'] = 'Activer le système à distance de messagerie instantanée pour ce compte';
$lang['Network_user_list'] = 'Choisissez une méthode d\'affichage des utilisateurs d\'autres sites connectés sur Prillian.';

// Do not change the [0], [1], etc. parts of the following
$lang['network_lists'][0] = 'Ne pas afficher';
$lang['network_lists'][1] = 'Afficher avec les utilisateurs de ce site';
$lang['network_lists'][2] = 'Afficher séparément des utilisateurs de ce site';

// Admin Configuration
$lang['IM_allow_network'] = 'Activer le système à distance de messagerie instantanée';
/* End of the s2s -> network changes */



/*
The following entries were removed in 0.7.0

$lang['PUU_Constant']
$lang['PPU_Constant']
$lang['PUU_Constant_explain']
$lang['PPU_Constant_explain']
*/
?>
