<?php 
/*************************************************************************** 
*                              lang_rating.php v1.1.0 
*                            ------------------- 
*   begin                : Friday, Jan 17, 2003 
*   copyright            : (C) 2002 Web Centre Ltd 
*   email                : phpbb@mywebcommunities.com 
* 
***************************************************************************/ 

$lang['Rating_page_title'] = 'Noter un message'; 
$lang['Die_rate_private'] = 'Vous ne pouvez pas noter des messages dans les forums privés'; 
$lang['Die_login_to_rate'] = 'Ce message est dans un forum restreint aux utilisateurs enregistrés. Vous devez être connectés pour accéder aux notes.'; 
$lang['Die_rate_only_first'] = 'Vous ne pouvez noter que le premier message de chaque sujet'; 
$lang['User_suspended'] = 'Les notations pour cet utilisateur ont été suspendues par l\'administrateur'; 
$lang['Cannot_rate_own'] = 'Vous ne pouvez pas noter vos propres messages'; 
$lang['Not_yet_rated'] = 'Ce message n\'a pas encore été noté'; 
$lang['Rating_anon_user'] = 'Utilisateur enregistré'; 
$lang['Must_be_logged_to_rate'] = 'Vous devez être connecté pour noter ce message'; 
$lang['Days_registered_before_rating'] = 'Vous devez être enregistré depuis %s avant de pouvoir noter les messages'; 
$lang['Posts_before_rating'] = 'Vous devez avoir posté %s avant de pouvoir noter d\'autres messages'; 
$lang['User_rating_limit'] = 'Vous avez déjà noté %s de cet utilisateur dans les dernières 24 heures, ce qui est la limite imposée par l\'administrateur'; 
$lang['Daily_rating_limit'] = 'Vous avez déjà noté %s dans les dernières 24 heures, ce qui est la limite imposée par l\'administrateur'; 
$lang['Already_rated'] = 'Vous avez déjà noté ce message'; 
$lang['No_rating_permission_post'] = 'Vous n\'avez pas la permission de noter ce message'; 
$lang['No_rating_permission'] = 'Vous n\'avez pas la permission de noter les messages'; 
$lang['Your_rating'] = 'Votre note pour ce message'; 
$lang['Rating_visible'] = 'Votre note sera visible par les autres utilisateurs'; 
$lang['Rating_visible_forced']  = 'NOTE: les notation anonymes ne sont plus autorisées. Si vous cliquez sur le bouton, toutes vos notations seront visibles par les autres utilisateurs'; 
$lang['Rate_anonymously'] = 'Noter anonymement (s\'applique à toutes vos notations)'; 
$lang['Return_to_post'] = 'Retourner au message'; 
$lang['Close_window'] = 'Fermer cette fenêtre'; 
$lang['Poster_rank'] = 'Rang de l\'auteur'; 
$lang['Topic_rank'] = 'Rang du sujet'; 
$lang['Post_rank'] = 'Rang du message'; 
$lang['Rated_by'] = 'Noté par'; 
$lang['Rated_on'] = 'le'; 
$lang['No_rating'] = 'Pas de note'; 
$lang['Unrated'] = 'Pas noté'; 
$lang['No_rank'] = 'Pas de rang'; 
$lang['Rating_sample_post'] = 'Message exemple'; 
$lang['Topic_starter'] = 'Sujet de départ'; 
$lang['Rating_deactivated'] = 'Désolé, le système de notation est actuellement désactivé'; 
$lang['No_ratings'] = 'Pas de note'; 
$lang['Total_points'] = 'Nombre total de points'; 
$lang['Average_points'] = 'Moyenne'; 
$lang['Rate_it'] = 'Noter'; 
$lang['Rating_config_gen'] = 'Configuration générale'; 
$lang['Rating_overview_text'] = '<b>Aperçu</b>: Les utilisateur peuvent noter chaque message individuellement, en sélectionnant parmi un intervalle d\'options, chacune étant associée à une valeur en points. Le classement général de chaque message est calculé en totalisant (ou en faisant la moyenne de) toutes les notes individuelles pour ce message, et en donnant un rang depuis la "table des totaux". Les classements généraux des sujets et des utilisateurs sont également calculés de la même manière (toutes les notes des messages dans un sujet particulier / par un utilisateur particulier).'; 
$lang['Rating_settings_title'] = 'Paramètres généraux pour votre système de notation'; 
$lang['Rating_settings_text'] = '<b>Noter le premier sujet seulement</b>: Autorise seulement le premier message de chaque sujet à être noté<br /> 
<b>Nbre mini messaget</b>: Nombre minimum de messages postés avant de pouvoir noter<br /> 
<b>Delai mini d\'enregistrement</b>: Nombre de jours qui doivent s\'être écoulés après l\'enregistrement avant de pouvoir noter<br /> 
<b>Méthode de pondération</b>: Si cette option est activée, un utilisateur ne peut sélectionner parmi les notes que celles dont son propre compte égale ou dépasse la valeur présente dans la colonne "Déclenchement de la pondération" (voir table ci-dessous)<br /> 
<b>Notes quotidiennes maxi</b>: Limite le nombre de notes qu\'un utilisateur peut donner par période de 24 heures<br /> 
<b>Notes quotidiennes maxi par utilisateur</b>: Limite le nombre de notes qu\'un utilisateur peut donner aux message d\'un même utilisateur par période de 24 heures<br /> 
<b>Autorise à cacher le nom</b>: Autorise un utilisateur à apparaître comme "Anonyme" dans la liste des personnes ayant noté un message<br /> 
<b>Méthode globale de notation</b>: Spécifie si la note totale est basée sur la somme ou la moyenne de toutes les notes individuelles'; 
$lang['Rating_options'] = 'Options de notation'; 
$lang['Points'] = 'Points'; 

$lang['Rating_label'] = 'Description'; 
$lang['Weighting_threshold'] = 'Déclenchement de la pondération'; 
$lang['Rating_who'] = 'Qui'; 
$lang['Rating_used'] = 'Utilisée'; 
$lang['Rating_delete'] = 'Supprime'; 
$lang['Rating_update'] = 'Met à jour'; 
$lang['Rating_update_config'] = 'Met à jour la configuration'; 
$lang['Rating_add'] = 'Ajoute'; 
$lang['Rating_option_title'] = 'Détermine l\'intervalle de note qu\'un utilisateur peut donner à un message'; 
$lang['Rating_option_text'] = '<b>Points</b>: Utilisés pour calculer la note totale pour les messages, sujets et utilisateurs<br /> 
<b>Pondération</b>: Voir "Méthode de pondération" dans la configuration générale<br /> 
<b>Qui</b>: Utilisé pour limiter les options en fonction du statut de l\'utilisateur<br /> 
<b>Utilisée</b>: Nombre de fois qu\'une option a été utilisée à aujourd\'hui<br />'; 
$lang['Rating_ranks'] = 'Affichage des rangs des messages et sujets'; 
$lang['User_ranks_title'] = 'Affichage des rangs des utilisateurs'; 
$lang['Board_rank'] = 'Rang forum'; 
$lang['Rating_applies_to'] = 'S\'applique à'; 
$lang['Rating_sum'] = 'Somme de déclenchement'; 
$lang['Rating_average'] = 'Moyenne'; 
$lang['Rating_max'] = 'Maximum'; 
$lang['Rating_icon'] = 'Icône'; 
$lang['Rating_rank_title'] = 'Calcul et présentation des rangs généraux'; 
$lang['Rating_rank_text'] = '<b>Moyenne</b>: La moyenne de toutes les notes individuelles est calculée et le rang dont la moyenne est <b>la plus proche</b> est sélectionné<br /> 
<b>Somme de déclenchement</b>: Toutes les notes individuelles sont ajoutées et parmi les rangs dont le total <b>égale ou dépasse</b> la valeur dans la colonne "Somme de déclenchement", le rang avec la somme la plus élevée est sélectionné'; 
$lang['Rating_admin_page_title'] = 'Configuration du système de notation'; 
$lang['Must_be_an_integer'] = 'doit être un entier'; 
$lang['Invalid_point_value'] = 'Les valeurs de points doivent être un entier entre -127 et 128'; 
$lang['Invalid_threshold_value'] = 'La valeur de déclenchement doit être un entier entre 0 et 30000'; 
$lang['Invalid_average_threshold'] = 'La moyenne doit être un entier entre -127 et 128'; 
$lang['Invalid_sum_threshold'] = 'La somme de déclenchement doit être un entier entre -2000000000 et 2000000000'; 
$lang['Weighting_method_posts'] = 'Nombre de messages'; 
$lang['Rating_user_type_all'] = 'Tous les utilisateurs'; 
$lang['Rating_user_type_mods'] = 'Tous les modérateurs'; 
$lang['Rating_user_type_forum'] = 'Modérateurs du forum'; 
$lang['Rating_user_type_admin'] = 'Administrateur uniquement'; 
$lang['Rating_remove_confirm'] = 'Les notes existantes vont être supprimées. Etes-vous sûr de vouloir supprimer cette option ?'; 
$lang['Rating_recalc_confirm'] = 'Les notes existantes vont être recalculées. Etes-vous sûr de vouloir supprimer ce rang ?'; 
$lang['Rating_admin_errors'] = 'Il y a eu des problèmes avec les informations que vous avez soumises. Lisez le message ci-dessous, faites les corrections nécessaires et envoyez à nouveau les informations:'; 
$lang['As_rated_by'] = 'noté par'; 
$lang['As_rated_by_you'] = 'noté par vous'; 
$lang['Ratings_posts_by'] = 'messages par'; 
$lang['Ratings_posts_by_you'] = 'vos messages'; 
$lang['Recalc_text'] = 'Certaines actions peuvent nécessiter un recalcul manuel des notes, comme par exemple la suppression de messages déjà notés. Pour lancer ce recalcul, cliquez sur le bouton ci-dessous'; 
$lang['Recalc_button'] = 'Recalculer toutes les notes'; 
$lang['Recalc_confirm'] = 'Etes-vous certain? Cela peut prendre beaucoup de temps sur des gros forums.'; 
$lang['Ratedby_hidden'] = 'L\'administrateur a choisi de cacher les noms de ceux qui notent les messages'; 
$lang['Rating_screen_type'] = 'Type d\'écran'; 
$lang['Rating_in'] = 'dans'; // As in "posts IN this forum" 
$lang['Rating_all_forums'] = 'Tous les forums'; 
$lang['Rating_make_neutral'] = 'Etre neutre envers les notes données par %s'; 
$lang['Rating_is_neutral'] = 'Vous êtes actuellement neutre envers les notes données par %s'; 
$lang['Rating_make_buddy'] = 'Favorise les notes données par %s'; 
$lang['Rating_is_buddy'] = 'Vous favorisez actuellement les notes données par %s'; 
$lang['Rating_buddy'] = 'Vos notes sont actuellement favorisées par %s'; 
$lang['Rating_ignored'] = 'Vos notes sont actuellement ignorées par %s'; 
$lang['Rating_make_ignored'] = 'Ignorer les notes données par %s' ; 
$lang['Rating_is_ignored'] = 'Vous ignorez actuellement les notes données par %s'; 
$lang['Rating_bias'] = 'Orientation'; 
$lang['Rating_bias_off'] = 'Les options d\'orientation ne sont pas disponibles actuellement'; 
$lang['Rating_bias_loggedoff'] = 'Vous devez être connecté pour utiliser le système d\'orientation des notes'; 
$lang['Rating_all_but_ignore'] = 'Toutes sauf celles que j\'ignore'; 
$lang['Rating_everyone'] = 'Tout le monde'; 
$lang['Rating_buddies_only'] = 'Mes amis seulement'; 
$lang['Rating_include_by'] = 'Inclus les notes données par'; 
$lang['Rating_yourself'] = 'vous-même'; 
$lang['Rating_bias_prompt'] = 'Orientation demandée par'; 
$lang['Rating_bias_when'] = 'Quand'; 
$lang['Rating_current'] = 'Note actuelle'; 
$lang['Rating_buddies_only'] = 'Amis seulement'; 
$lang['Rating_ignores_only'] = 'Ignorés seulement'; 
$lang['Rating_post_removed'] = 'un message qui n\'existe plus'; 
$lang['Rating_this_post'] = 'ce message'; 
$lang['Rating_this_user'] = 'cet utilisateur'; 
$lang['Rating_of'] = 'note de'; 
$lang['Rating_awarded_to'] = 'donnée à'; 
$lang['Rating_my_bias_title'] = 'Mon orientation par rapport aux notes données par les autres utilisateurs'; 
$lang['Rating_their_bias_title'] = 'L\’orientation des autres utilisateurs par rapport à mes notes'; 
$lang['Rating_no_bias'] = 'Pas d\’orientation pour le moment'; 


$lang['Rating system active']							= 'Système de note actif...';  
$lang['Weighting method'] 								= 'Méthode de pondération...';
$lang['Users can change ratings'] 				= 'Les utilisateurs peuvent changer leurs notes';
$lang['Max daily ratings (0=unlimited)'] 	= 'Nombre de notations quotidiennes maximum (0=illimité)';
$lang['Show who rated'] 									= 'Indiquer qui a noté';
$lang['Allow users to hide name'] 				= 'Permettre aux utilisateurs de cacher leur nom';
$lang['Rate first post only'] 						= 'Noter seulement le premier message';
$lang['Overall ranking method: posts'] 		= 'Méthode de classement: messages';
$lang['Overall ranking method: topics'] 	= 'Méthode de classement: sujets';
$lang['Overall ranking method: users']		= 'Méthode de classement: utilisateurs';
$lang['Max daily ratings per user'] 			= 'Nombre quotidien maximum de notation par utilisateur';
$lang['Open in new window'] 							= 'Ouvrir dans une nouvelle fenêtre';
$lang['Min. post count'] 									= 'Nombre de message minimum';
$lang['Min. days registered'] 						= 'Nombre de jours enregistré';
$lang['Bias system active'] 							= 'Système de mesure de l\'orientation activé';
$lang['Show bias usernames?'] 						= 'Montrer les utilisateurs avec orientation?';
$lang['Show dropdown in viewtopic?']			= 'Montrer la liste déroulante dans viewtopic?';
$lang['Show dropdown in viewforum?'] 			= 'Montrer la liste déroulante dans viewforum?';

?>
