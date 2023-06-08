<?php
/***************************************************************************
 *                          lang_contact.php [English]
 *                            -------------------
 *   begin                : Friday, Jan 31, 2003
 *   version              : 0.8.0
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

// Do not change the next six lines.
// Avoid including the file more than once.
if ( defined('IN_CONTACT_LANG') )
{
	return;
}
define('IN_CONTACT_LANG', true);

// You may want to edit the following lines to match your website.
$lang['Buddy'] = 'Contact';
$lang['Ignore'] = 'Ignorer';
$lang['Disallow'] = 'Ne pas autoriser';
$lang['User_ignoring_you'] = 'Ce membre vous a mis sur sa liste d\'utilisateurs à ignorer.';
$lang['User_not_want_contact'] = 'Ce membre vous a mis sur sa liste d\'utilisateurs qui ne peuvent le contacter';
$lang['Buddies_online'] = 'Ces contacts sont maintenant connectés';
$lang['Buddy_online'] = 'Ce contact est maintenant connecté';
$lang['Buddies_offline'] = 'Ces contacts sont maintenant déconnectés';
$lang['Buddy_offline'] = 'Ce contact est maintenant déconnecté';
$lang['Listbox_Buddies'] = 'Vos contacts';
$lang['Online'] = 'Connecté(s)';
$lang['Offline'] = 'Déconnecté(s)';
$lang['Buddies'] = 'Contact(s)';
$lang['Ignored_some_users'] = 'Des utilisateurs sur cette page ont été ignoré. %sVoir cette page avec ces utilisateurs ?%s';
$lang['Ignore_some_users'] = '%sVoir cette page sans les utilisateurs ignorés ?%s';

// These will be used in the user profiles for links to do the indicated thing
// Also used as ALT text for images in several places.  %s will be replaced with a
// user's name
$lang['Add_to_buddy'] = 'Ajouter %s à votre liste de contact';
$lang['Remove_from_buddy'] = 'Retirer %s de votre liste de contact';
$lang['Add_to_ignore'] = 'Ajouter %s à votre liste de gens ignorés';
$lang['Remove_from_ignore'] = 'Retirer %s de votre liste de gens ignorés';
$lang['Add_to_disallow'] = 'Ajouter %s à la liste des gens non autorisés à vous contacter';
$lang['Remove_from_disallow'] = 'Retirer %s de la liste des gens non autorisés à vous contacter';


// Error Messages
$lang['No_alerts_updated'] = 'Aucun utilisateur spécifié pour les mises à jour d\'alerte';
$lang['No_autoclose'] = 'Si vous voyez ce message, alors l\'option de fermeture automatique de fenêtre ne fonctionne pas avec votre navigateur. Une des causes possibles peut être la désactivation du Javascript dans votre navigateur. Veuillez fermer cette fenêtre.';

// Control Panel
$lang['Users_you_ignore'] = 'Utilisateurs que vous ignorez';
$lang['Users_you_disallow'] = 'Utilisateurs que vous n\'autorisez pas à vous contacter';
$lang['Users_buddy_you'] = 'Utilisateurs vous ayant dans leur liste de contacts';
$lang['Users_you_buddy'] = 'Vos contacts';
$lang['None_you_ignore'] = 'Vous n\'ignorez personne.';
$lang['None_you_disallow'] = 'Tous les utilisateurs peuvent vous contacter.';
$lang['None_buddy_you'] = 'Aucun utilisateur ne vous a mis dans sa liste de contacts.';
$lang['None_you_buddy'] = 'Vous n\'avez aucun contact.';
$lang['Add_a_user'] = 'Ajouter un utilisateur à cette liste ?';
$lang['Add_user'] = 'Ajouter';
$lang['Move_selected_users'] = 'Déplacer les utilisateurs sélectionnés vers :';
$lang['Buddy_link'] = 'Contacts';
$lang['Buddied_link'] = 'Contact de...';
$lang['Ignore_link'] = 'Ignorés';
$lang['Disallow_link'] = 'Non autorisés';
$lang['Be_alerted'] = 'M\'avertir quand cet utilisateur se connecte';
$lang['Edit_alerts'] = 'Editer les options d\'alerte de connexion et de déconnexion';

// Success messages
$lang['Alerts_updated'] = 'Préférences d\'alerte mises à jour pour tous les contacts changés';
$lang['Alerts_oops'] = ' Mis à part ceux qui suivent, qui ne peuvent pas être trouvés :<br />';
$lang['Moved_to_buddies'] = 'Les utilisateurs indiqués ont été déplacés dans votre liste de contacts.';
$lang['Moved_to_ignore'] = 'Les utilisateurs indiqués ont été déplacés dans votre liste de gens ignorés.';
$lang['Moved_to_disallow'] = 'Les utilisateurs indiqués ont été déplacés dans votre liste de gens non autorisés à vous contacter.';
$lang['Removed_selected_users'] = 'Les utilisateurs indiqués ont été supprimé.';
$lang['Buddy_updated'] = 'Liste de contacts mise à jour';
$lang['Ignore_updated'] = 'Liste des gens ignorés mise à jour';
$lang['Disallow_updated'] = 'Liste des gens non autorisés à vous contacter mise à jour';


// For Prillian
$lang['Close_window_link'] = '<br /><br /><a href="javascript:window.close();">' . $lang['Close_window'] . '</a>';

/* Entries Added in Prillian 0.7.0 & Contact List 0.3.0 */
$lang['No_ignore_admin'] = 'Vous avez tenté d\'ignorer ou de ne pas autoriser à vous contacter les administrateurs ou modérateurs suivants : %s. SVP, Modifiez les options sans essayer d\'ignorer ou de ne pas autoriser ces utilisateurs.<br />';
$lang['No_contact_add_self'] = 'Vous avez tenté de vous ajouter à une de vos liste de contacts. Ce n\'est pas autorisé ; SVP, Modifiez les options sans essayer de vous ajouter vous-même à vos liste de contacts.';
$lang['Add_Selected_as_Buddies'] = 'Ajouter les utilisateurs sélectionnés comme contact';
$lang['Add_contact_users_link'] = 'Ajouter de nouveaux contacts';
$lang['You_have_buddies'] = 'Vous avez %d contacts.';
$lang['You_have_buddy'] = 'Vous avez 1 contact.';
$lang['You_are_ignoring'] = 'Vous ignorez %d utilisateurs.';
$lang['You_are_ignoring_one'] = 'Vous ignorez 1 utilisateur.';
$lang['You_have_disallowed'] = 'Vous n\'autorisez pas %d utilisateurs à vous contacter.';
$lang['You_have_disallowed_one'] = 'Vous n\'autorisez pas 1 utilisateur à vous contacter.';
$lang['You_as_buddies'] = '%d utilisateurs vous a ajouté à sa liste de contacts.';
$lang['You_as_buddy'] = '1 utilisateur vous a ajouté à sa liste de contacts.';
$lang['Add_many_contacts_explain'] = 'Vous pouvez ajouter plusieurs utilisateurs à vos différentes listes d\'ici. Tapez le nom de chaque utilisateur dans le champ ci-dessous. Chaque nom d\'utilisateur doit être sur une ligne séparée.';
$lang['Add_to_Buddy_List'] = 'Ajouter à la liste de contacts';
$lang['Add_to_Ignore_List'] = 'Ajouter à la liste de gens à ignorer';
$lang['Add_to_Disallow_List'] = 'Ajouter à la liste des gens non-autorisés à me contacter';


/* Entries Changed in Prillian 0.7.0 & Contact List 0.3.0 */
/* Any of these that have contact in the $lang['name'] part used to have bid or
 buddy in place of contact. In some, that is the only change */
$lang['Contact_List_FAQ'] = 'Liste des contacts'; // Title of the FAQ

$lang['Contact_Management'] = 'Gestion des contacts';

// Error Messages
$lang['No_contact_mode'] = 'Aucun mode de contact défini';
$lang['No_contact_type'] = 'Aucun type de contact défini';
$lang['No_contact_action'] = 'Aucune action de contact définie';
$lang['No_contact_id'] = 'Aucune ID d\'utilisateur de contact définie';
$lang['Invalid_contact_action'] = 'La définition d\'action de contact est invalide';


// Control Panel
$lang['Contact_click_here'] = '%sGérer la liste de contacts%s';


// Success messages
$lang['Confirm_contact_changes'] = 'Etes-vous sûr(e) de vouloir faire ces changements?';
$lang['No_Contact_changes'] = 'Aucun changement spécifié';


//Private Message alerts
$lang['System_title'] = 'Système de message de la liste de contacts';
$lang['Contact_Alert_PM'] = '[url=%s]%s[/url] vous a ajouté à sa liste de contacts. Pour gérer votre liste de contacts, SVP [url=%s]cliquez ici[/url]. Ceci est un message automatique envoyé par le programme Prillian du forum. Il n\'est pas nécessaire d\'y répondre.';

?>