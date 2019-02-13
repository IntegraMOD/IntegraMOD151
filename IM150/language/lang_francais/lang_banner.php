<?php
/**************************************************************
*
*  MOD Title:   Complete banner
*  MOD Version: 1.3.5
*  Translation: French
*  Rev date:    28/04/2004
*
*  Translator:  kooky < n/a > (n/a) http://perso.edeign.com/kooky/
*
***************************************************************/

// this is the text showen in admin panel, depending on your template layout,
// you may change the text, so this reflect the placement in the templates
// these are only exampels, you may add more or remove some of them.

$lang['Banner_spot']['0'] = 'Bannière principale'; // used for {BANNER_0_IMG} tag in the template files
$lang['Banner_spot']['1'] = 'Haut gauche 1'; // used for {BANNER_1_IMG} tag in the template files
$lang['Banner_spot']['2'] = 'Haut gauche 2'; // used for {BANNER_2_IMG} tag in the template files
$lang['Banner_spot']['3'] = 'Haut centré 1'; // used for {BANNER_3_IMG} tag in the template files
$lang['Banner_spot']['4'] = 'Haut centré 2'; // used for {BANNER_4_IMG} tag in the template files
$lang['Banner_spot']['5'] = 'Haut droit 1'; // used for {BANNER_5_IMG} tag in the template files
$lang['Banner_spot']['6'] = 'Haut droit 2'; // used for {BANNER_6_IMG} tag in the template files
$lang['Banner_spot']['7'] = 'Bas gauche 1'; // used for {BANNER_7_IMG} tag in the template files
$lang['Banner_spot']['8'] = 'Bas gauche 2'; // used for {BANNER_8_IMG} tag in the template files
$lang['Banner_spot']['9'] = 'Bas centré 1'; // used for {BANNER_9_IMG} tag in the template files
$lang['Banner_spot']['10'] = 'Bas centré 2'; // used for {BANNER_10_IMG} tag in the template files
$lang['Banner_spot']['11'] = 'Bas droit 1'; // used for {BANNER_11_IMG} tag in the template files
$lang['Banner_spot']['12'] = 'Bas droit 2'; // used for {BANNER_12_IMG} tag in the template files
$lang['Banner_spot']['13'] = 'Bannière en haut des forums'; // used for {BANNER_13_IMG} tag in the template files
$lang['Banner_spot']['14'] = 'Bannière en haut des sujets'; // used for {BANNER_14_IMG} tag in the template files
$lang['Banner_spot']['15'] = 'Bannière en bas des sujets'; // used for {BANNER_15_IMG} tag in the template files
$lang['Banner_spot']['16'] = "Haut du Portail"; // used for {BANNER_16_IMG} tag in the template files
$lang['Banner_spot']['17'] = "Bas du Portail"; // used for {BANNER_17_IMG} tag in the template files
$lang['Banner_spot']['18'] = "Haut de l'index"; // used for {BANNER_18_IMG} tag in the template files
$lang['Banner_spot']['19'] = "Bas de l'index"; // used for {BANNER_19_IMG} tag in the template files
$lang['Banner_spot']['20'] = "Bloc de lien du portail 1"; // used for {BANNER_20_IMG} tag in the template files
$lang['Banner_spot']['21'] = "Bloc de lien du portail 2"; // used for {BANNER_21_IMG} tag in the template files
$lang['Banner_spot']['22'] = "Bloc de lien du portail 3"; // used for {BANNER_22_IMG} tag in the template files
$lang['Banner_spot']['23'] = "Bloc de lien du portail 4"; // used for {BANNER_23_IMG} tag in the template files

//
// please do not modify the text below (except if you are translating)
//
$lang['Banner_title'] = 'Administration des bannières';
$lang['Banner_text'] = 'Ici, vous pouvez modifier les bannières utilisées sur ce site, elles peuvent être définies pour une durée voulue';
$lang['Add_new_banner'] = 'Nouvelle bannière';
$lang['Banner_add_text'] = 'Ici, vous pouvez ajouter/éditer une bannière';

$lang['Banner_example'] = 'Exemple';
$lang['Banner_example_explain'] = 'Cela pourrait être la manière dont une bannière est affichée.';
$lang['Banner_type_text'] = 'type';
$lang['Banner_type_explain'] = 'Sélectionner le type de lien pour votre bannière';
//pre-defined types
$lang['Banner_type'][0] = 'Image';
$lang['Banner_type'][2] = 'Texte';
$lang['Banner_type'][4] = 'Code HTML personnalisé';
$lang['Banner_type'][6] = 'Flash';

$lang['Banner_name'] = 'Chemin de l\'image/Texte/Code';
$lang['Banner_name_explain'] = 'le chemin doit être relatif au répertoire de phpbb2 ou de l\'adresse complète (en incluant http://)';
$lang['Banner_size'] = 'Taille de l\'image';
$lang['Banner_size_explain'] = 'Si la taille est mise sur zéro, l\'image sera mise par défaut à sa taille originale (en pixels)';
$lang['Banner_width'] = 'Largeur';
$lang['Banner_height'] = 'Hauteur';

$lang['Banner_activated'] = 'Activée';
$lang['Banner_activate'] = 'Activer la bannière';
$lang['Banner_comment'] = 'Commentaire';
$lang['Banner_description'] = 'Description de l\'image';
$lang['Banner_description_explain'] = 'Ce texte est affiché lorsque la souris passe au-dessus de l\'image';
$lang['Banner_url'] = 'Adresse de redirection';
$lang['Banner_url_explain'] = 'Adresse/URL du site de redirection, lors du clic avec la souris, ouverture avec http://<br />(l\'adresse de redirection sera uniquement activée si le type de lien est une image ou du texte)';
$lang['Banner_owner'] = 'Modérateur des bannières';
$lang['Banner_owner_explain'] = 'Cet utilisateur peut gérer la bannière - (pas encore fonctionnel)';
$lang['Banner_placement'] = 'Placement';
$lang['Banner_clicks'] = 'Clics';
$lang['Banner_clicks_explain'] = '(le compteur sera uniquement activé si le type de lien est une image ou du texte)';
$lang['Banner_view'] = 'Vus';
$lang['Banner_weigth'] = 'Fréquence des bannières';
$lang['Banner_weigth_explain'] = 'Fréquence d\'affichage de la bannière, relatif aux autres bannières actives au même moment. (1-99)';
$lang['Show_to_users'] = 'Montrer aux utilisateurs';
$lang['Show_to_users_explain'] ='Sélectionner quels types d\'utilisateurs peuvent être autorisés à voir les bannières';
$lang['Show_to_users_select'] = 'L\'utilisateur doit être %s à %s'; //%s are supstituded with dropdown selections
$lang['Banner_level']['-1'] = 'Invité';
$lang['Banner_level']['0'] = 'Enregistré';
$lang['Banner_level']['1'] = 'Modérateur';
$lang['Banner_level']['2'] = 'Admin';
$lang['Banner_level_type']['0'] = 'égal';
$lang['Banner_level_type']['1'] = 'inférieur ou égal';
$lang['Banner_level_type']['2'] = 'supérieur ou égal';
$lang['Banner_level_type']['3'] = 'aucun';

$lang['Time_interval'] = 'Intervalle de temps';
$lang['Time_interval_explain'] = 'Appliquer uniquement à chaque date, jour de la semaine ou/et heure';
$lang['Start'] = 'début';
$lang['End'] = 'fin';
$lang['Year'] = 'année';
$lang['Month'] = 'mois';
$lang['Date'] = 'date';
$lang['Weekday'] = 'jour';
$lang['Hour'] = 'heure';
$lang['Min'] = 'min';
$lang['Time_type'] = 'Type d\'heure';
$lang['Time_type_explain'] = 'Sélectionner si les informations sont un intervalle de temps ou une date d\'intervalle (<i>vous pourrez encore appliquer un intervalle de temps si vous sélectionnez une durée voulue</i>)';
$lang['Not_specify'] = 'Non specifié';
$lang['No_time'] = 'Aucune heure';
$lang['By_time'] = 'par heure';
$lang['By_week'] = 'par jour';
$lang['By_date'] = 'par date';

// messages
$lang['Missing_banner_id'] = 'L\'ID de la bannière a été perdu';
$lang['Missing_banner_owner'] = 'Vous devez sélectionner un propriétaire de bannière';
$lang['Missing_time'] = 'Lorsque vous définissez une bannière sur une durée voulue, vous devez fournir un intervalle de temps.';
$lang['Missing_date'] = 'Lorsque vous définissez une bannière à partir d\'une date, vous devez au moins fournir une date et un intervalle de temps.';
$lang['Missing_week'] = 'Lorsque vous définissez une bannière à partir d\'un jour de la semaine, vous devez au moins fournir un jour de la semaine et un intervalle de temps.';

$lang['Banner_removed'] = 'La bannière a été supprimée';
$lang['Banner_updated'] = 'La bannière a été mise à jour';
$lang['Banner_added'] = 'La bannière a été ajoutée';
$lang['Click_return_banneradmin'] = 'Cliquez %sici%s pour revenir à la gestion des bannières';

$lang['No_redirect_error'] = 'Si votre page ne s\'affiche pas rapidement, veuillez cliquer <b><a href="%s" id="jumplink" name="jumplink">ici<a></b> pour aller à l\'adresse voulue';
$lang['Left_via_banner'] = 'Quitter via la bannière';

$lang['Banner_filter'] = 'Filtre des bannières';
$lang['Banner_filter_explain'] = 'Cacher cette bannière après que l\'utilisateur ait cliqué dessus.';
$lang['Banner_filter_time'] = 'Durée du clic inactive';
$lang['Banner_filter_time_explain'] = 'Nombre de secondes avant que la bannière devienne inactive après qu\'un utilisateur ait cliqué dessus. Si le filtre des bannières est activé, la bannière ne sera pas affichée à cet instant.';

?>