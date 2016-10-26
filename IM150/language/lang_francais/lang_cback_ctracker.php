<?php
/**
* <b>lang_cback_ctracker.php</b><br><br>
* English Language File for the CBACK Cracker Tracker
*
* @author Christian Knerr (cback)
* @translator Marc Renninger (mc-dragon)
* @french translators Ram et Spitfire Pat
* @package ctracker
* @version 5.0.0
* @since 21.07.2006 - 17:26:28
* @copyright (c) 2006 www.cback.de
*
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/


/*
 * Language Strings used for the ACP Menu points
 */
$lang['ctracker_module_category'] 		  = 'CrackerTracker';
$lang['ctracker_module_1']                = 'Scanner les sommes de contrôle';
$lang['ctracker_module_2']                = 'Crédits';
$lang['ctracker_module_3']                = 'Scanner les fichiers';
$lang['ctracker_module_4']                = 'Messages globaux';
$lang['ctracker_module_5']                = 'Bloquage IP et Agents';
$lang['ctracker_module_6']                = 'Gestion rapports';
$lang['ctracker_module_7']                = 'Maintenance & Tests';
$lang['ctracker_module_8']                = 'Utilisateur misérable';
$lang['ctracker_module_9']                = 'Paramètres';
$lang['ctracker_module_10']               = 'Restauration';
$lang['ctracker_module_11']               = 'Pied de page';


/*
 * Language Strings used in ACP Modules itself
 */
$lang['ctracker_wrong_module']			  = 'Numéro de module inconnu';
$lang['ctracker_img_descriptions']		  = 'Images';
$lang['ctracker_set_catname1']			  = 'Bloqueur d\'IP, Proxys & Agents';
$lang['ctracker_set_catname2']			  = 'Système de protection de la Recherche';
$lang['ctracker_set_catname3']			  = 'Système de protection des connexions';
$lang['ctracker_set_catname4']			  = 'Détection automatique des spams';
$lang['ctracker_set_catname5']			  = 'Système de protection des enregistrements';
$lang['ctracker_set_catname6']			  = 'Vérification du mot de passe	';
$lang['ctracker_set_catname7']			  = 'Fonctionnalités générales de sécurité';
$lang['ctracker_set_catname8']			  = 'Autres paramètres';
$lang['ctracker_settings_head']           = 'Paramètres de CrackerTracker';
$lang['ctracker_settings_expl']           = 'Ici vous pouvez gérer tous les paramètres du Systéme de Sécurité CBACK CrackerTracker.';
$lang['ctracker_button_submit']			  = 'Sauvegarder paramètres';
$lang['ctracker_button_reset']			  = 'Restaurer';

$lang['ctracker_settings_m1']			  = 'Activer le bloqueur d\'IP';
$lang['ctracker_settings_e1']			  = 'Active ou désactive le bloqueur d\'IPs, Proxys et Agents.';
$lang['ctracker_settings_m2']			  = 'Taille du rapport de bloquage d\'IPs';
$lang['ctracker_settings_e2']			  = 'Ici vous pouvez indiquer le nombre d\'entrées du fichier de rapport du bloqueur d\'IP. Si le nombre d\'entrées excède la limite, le fichier de rapport sera automatiquement supprimé pour sauver de l\'espace web.';
$lang['ctracker_settings_m3']			  = 'Activer la Protection de la Recherche';
$lang['ctracker_settings_e3']			  = 'Ici vous pouvez activer ou désactiver le Système de Protection de la Recherche.';
$lang['ctracker_settings_m4']			  = 'Délai de recherche pour les utilisateurs';
$lang['ctracker_settings_e4']			  = 'Il s\'agit du délai (en secondes) au delà duquel un utilisateur enregistré peut effectuer une nouvelle recherche, si la protection de la Recherche est activée. ';
$lang['ctracker_settings_m5']			  = 'Nombre de recherches pour les utilisateurs';
$lang['ctracker_settings_e5']			  = 'Ici vous pouvez ajuster le nombre de recherches qui peuvent être effectuées dans l\'intervalle de temps indiqué ci-dessus par un utilisateur enregistré. Si ce nombre est dépassé, les recherches ultérieures seront bloquées pendant l\'intervalle indiqué afin de préserver la bande passante du serveur.';
$lang['ctracker_settings_m6']			  = 'Délai de recherche pour les invités';
$lang['ctracker_settings_e6']			  = 'Intervalle de temps (en secondes) pendant lequel les invités doivent attendre, si la protection de la Recherche est activée.';
$lang['ctracker_settings_m7']			  = 'Nombre de recherches pour les invités';
$lang['ctracker_settings_e7']			  = 'Ici vous pouvez ajuster le nombre de recherches qui peuvent être effectuées dans l\'intervalle de temps indiqué ci-dessus par un invité. Si ce nombre est dépassé, les recherches ultérieures seront bloquées pendant l\'intervalle indiqué afin de préserver la bande passante du serveur.';
$lang['ctracker_settings_m8']			  = 'Activer la protection de la connexion';
$lang['ctracker_settings_e8']			  = 'Ici vous pouvez activer ou désactiver le Système de Protection des Connexions de CrackerTracker.';
$lang['ctracker_settings_m9']			  = 'Taille du rapport des connexions erronées';
$lang['ctracker_settings_e9']			  = 'Ici vous pouvez indiquer combien d\'entrées pour connexions échouées seront sauvegardées et au delà desquelels le fichier sera automatiquement supprimé afin de sauvegarder de l\'espace web.';
$lang['ctracker_settings_m10']			  = 'Nombre de connexions jusqu\'à la confirmation visuelle';
$lang['ctracker_settings_e10']			  = 'Combien de fois un utilisateur peut-il échouer à se connecter jusqu\'à ce que le Système de Protection contre les attaques par force brute et la confirmation visuelle soient activés.';
$lang['ctracker_settings_m11']			  = 'Historique des connexions';
$lang['ctracker_settings_e11']			  = 'Ici vous pouvez activer ou désactiver l\'historique de connexions des utilisateurs.';
$lang['ctracker_settings_m12']			  = 'Entrées de l\'historique de connexions par utilisateur';
$lang['ctracker_settings_e12']			  = 'Ici vous pouvez fixer combien de connexions réussies de chaque utilisateur seront sauvegardées dans l\'Historique. Chaque utilsateur a la possibilité de gérer les heures et adresses IP de ses connexions.';
$lang['ctracker_settings_m13']			  = 'Fonctionnalité de connexion IP';
$lang['ctracker_settings_e13']			  = 'Active ou désactive le système de connexion IP. Chaque utilisateur a la possibilité d\'activer ou de désactiver le système dans la page \'Sécurité des connexions\'. Le système de protection IP vérifie les changements d\'adresse IP. L\'utilisateur sera informé si l\'adresse IP a changé depuis sa dernière connexion. Ici vous verrez si quelqu\'un s\'est connecté depuis une adresse différente.';
$lang['ctracker_settings_m14']			  = 'Détection des spammeurs';
$lang['ctracker_settings_e14']			  = 'Ici le mode de détection automatique des spammeurs peut être activé.';
$lang['ctracker_settings_m15']			  = 'Spammeurs: Intervalle de temps';
$lang['ctracker_settings_e15']			  = 'Intervalle pendant lequel les messages des utilisateurs seront décomptés par la détection de spam. (en Secondes)';
$lang['ctracker_settings_m16']			  = 'Spammeurs: nombre de messages';
$lang['ctracker_settings_e16']			  = 'Nombre autorisé de messages pendant l\'intervalle de temps fixé ci-dessus. Si ce nombre est dépassé, l\'utilisateur sera identifié comme un spammeur.';
$lang['ctracker_settings_m17']			  = 'Taille du rapport de spams';
$lang['ctracker_settings_e17']			  = 'Taille du fichier de rapport dans lequel seront enregistrés les spammeurs identifiés.';
$lang['ctracker_settings_m18']			  = 'Protection des enregistrements';
$lang['ctracker_settings_e18']			  = 'Ici vous pouvez activer ou désactiver la protection des enregistrements.';
$lang['ctracker_settings_m19']			  = 'Blocage temporel des enregistrements';
$lang['ctracker_settings_e19']			  = 'Ici vous pouvez fixer le délai minimum entre deux enregistrements. (en secondes)';

$lang['ctracker_settings_m21']			  = 'Vérification d\'IP';
$lang['ctracker_settings_e21']			  = 'Si cette fonction est activée, un utilisateur avec une adresse IP identique à celle du dernier utilisateur enregistré ne pourra s\'enregistrer qu\'après que quelqu\'un se soit enregsitré avec une adresse IP différente.';
$lang['ctracker_settings_m22']			  = 'Validité du mot de passe';
$lang['ctracker_settings_e22']			  = 'Active la vérification de la validité du mot de passe pour tous les utilisateurs.';
$lang['ctracker_settings_m23']			  = 'Durée de la validité du mot de passe';
$lang['ctracker_settings_e23']			  = 'Pour quelle durée (en jours) le mot de passe restera-t-il valide, avant que l\'intéressé ne recoive une note l\'invitant à changer de mot de passe.';
$lang['ctracker_settings_m24']			  = 'Vérifier la complexité du mot de passe';
$lang['ctracker_settings_e24']			  = 'cette fonction vérifie la complexité du mot de passe.';
$lang['ctracker_settings_m25']			  = 'Mode de complexité du mot de passe';
$lang['ctracker_settings_e25']			  = 'Ici peut-être décidé si le mot de passe doit impérativement comporter des symboles.';
$lang['ctracker_settings_m26']			  = 'Longueur minimum du mot de passe';
$lang['ctracker_settings_e26']			  = 'Ici vous pouver fixer le nombre minimum de lettres du mot de passe.';
$lang['ctracker_settings_m27']			  = 'Vérificateur d\'annulation de mot de passe';
$lang['ctracker_settings_e27']			  = 'Ne permet l\'annulation de mot de passe (lien "mot de passe oublié ?") qu\'au bout d\'un certain délai. Ceci afin d\'éviter que des attaquants n\'utilisent cette fonction pour spamer les utilisateurs.';
$lang['ctracker_settings_m28']			  = 'Délai d\'annulation du mot de passe';
$lang['ctracker_settings_e28']			  = 'Intervalle de temps avant qu\'un utilisateur puisse à nouveau annuler son mot de passe(en minutes)';
$lang['ctracker_settings_m29']			  = 'Monitorage d\'email';
$lang['ctracker_settings_e29']			  = 'Ici vous pouvez activer la fonction permettant à l\'utilisateur de n\'utiliser la fonction Mail interne qu\'une fois pendnat l\'intervalle de temps ci-dessous, ceci afin de prévenir le spam.';
$lang['ctracker_settings_m30']			  = 'Laps de temps entre 2 emails';
$lang['ctracker_settings_e30']			  = 'intervalle entre deux emails que l\'utilisateur peut envoyer en utilisant la fonction mail interne (en minutes)';
$lang['ctracker_settings_m31']			  = 'Auto Restauration';
$lang['ctracker_settings_e31']			  = 'Active la fonction de sauvegarde automatique des paramètres du forum. Si ça ne fonctionne pas vous pouvez utimiser la dernière configuration connue comme fonctionnelle.';
$lang['ctracker_settings_m32']			  = 'Confirmation Visuelle pour Invités';
$lang['ctracker_settings_e32']			  = 'Quand vous activez cette fonction, les Invités doivent entrer un code visuel pour pouvoir poster. Autrement ils ne pourront pas envoyer le message. Ceci protège des robots spammeurs.';
$lang['ctracker_settings_m33']			  = 'Protection contre les emails jetables';
$lang['ctracker_settings_e33']			  = 'CrackerTracker dispose d\'une liste interne de services d\'emails "jetables". Si vous activez cette fonction, les utilisateurs avec de telles adresses eMail seront incapables de s\'enregistrer.';
$lang['ctracker_settings_m34']			  = 'Dépistage de configurations incorrectes';
$lang['ctracker_settings_e34']			  = 'Quand vous activez cette fonction, CrackerTracker vérifie la validité de la configuration générale du forum. Ainsi vous ne pouvez endommager votre forum du fait d\'une mauvaise configuration!';
$lang['ctracker_settings_m35']			  = 'Détection poussée des spammeurs';
$lang['ctracker_settings_e35']			  = 'Si vous activez cette fonction, CrackerTracker examinera les spammeurs humains et les messages. Beaucoup d\'entre eux seront bloqués.';
$lang['ctracker_settings_m36']			  = 'Vérification des mots-clés des spammeurs';
$lang['ctracker_settings_e36']			  = 'Si vous activez la fonction "Détection poussée des spammeurs", certains mot-clés dans les profils et les messages seront passés en revue afin de détecter les spammeurs.<br /><br /><b>ATTENTION</b> Il existe ici un risque important de détection erronée chez les nouveaux utilisateurs. Vérifiez le fichier de rapport de la détection des spammeurs.';


$lang['ctracker_settings_on']			  = 'Activer';
$lang['ctracker_settings_off']			  = 'Désactiver';
$lang['ctracker_blockmode_0']			  = 'Off';
$lang['ctracker_blockmode_1']			  = 'Bannir l\'utilisateur';
$lang['ctracker_blockmode_2']			  = 'Verrouiller l\'utilisateur';
$lang['ctracker_complex_1']				  = '[0-9]';
$lang['ctracker_complex_2']				  = '[a-z]';
$lang['ctracker_complex_3']				  = '[A-Z]';
$lang['ctracker_complex_4']				  = '[0-9][a-z]';
$lang['ctracker_complex_5']				  = '[0-9][A-Z]';
$lang['ctracker_complex_6']				  = '[0-9][a-z][A-Z]';
$lang['ctracker_complex_7']				  = '[0-9][*]';
$lang['ctracker_complex_8']				  = '[0-9][a-z][*]';
$lang['ctracker_complex_9']				  = '[0-9][a-z][A-Z][*]';


/*
 * Credits page in ACP
 */
$lang['ctracker_credits_head']			  = 'Credits';
$lang['ctracker_credits_subhead']         = 'Credits du MOD CBACK CrackerTracker. Ici vous trouvez plus d\'informations à propos de la sécurité et également un moyen de dire "Merci".';
$lang['ctracker_credits_donate']          = 'Faire un don';
$lang['ctracker_credits_donate_expl']     = 'Vous aimez <b>CBACK CrackerTracker Professional</b>? Then it would be nice, if you donated the CBACK Project using PayPal Donation. Further Development and the costs of the server will help do go on with our non-profit project. So we will be able to provide CrackerTracker for free in the future. <br /><br />Merci beaucoup pour votre aide.';
$lang['ctracker_credits_credits']		  = 'Credits';
$lang['ctracker_credits_credits_1']		  = 'Idée & Mise en oeuvre';
$lang['ctracker_credits_credits_2']		  = 'Auteurs et Support';
$lang['ctracker_credits_credits_3']		  = 'Icones';
$lang['ctracker_credits_credits_4']		  = 'Site de téléchargement officiel';
$lang['ctracker_credits_moddownload']	  = 'CrackerTracker MOD Download';
$lang['ctracker_credits_thanks']		  = 'Merci à...';
$lang['ctracker_credits_thanks_text']	  = 'Je tiens à remercier les personnes suivantes:';
$lang['ctracker_credits_thanks_to']		  = '<b>Idées, tests de sécurité et correction des failles</b><br />Tekin Birdüzen<br /><i>(<a href="http://www.cybercosmonaut.de" target="_blank">cYbercOsmOnauT</a>)</i><br /><br /><br /><br /><b>Idées:</b><br />Bernhard Jaud<br /><i>(GenuineParts)</i><br /><br /><br /><br /><b>Traducteur (English)</b><br />Marc Renninger<br /><i>(mc-dragon)</i><br /><br /><br /><br /><b>Correcteur (English)</b><br />George <br />Sommerset<br /><i>(<a href="http://www.englisch-hilfen.de" target="_blank">www.englisch-hilfen.de</a>)</i><br /><br /><br /><br /><b>Correcteur (Deutsch)</b><br />Johnny (diegoriv)<br /><i>(<a href="http://alpinum.at" target="_blank">Alpinum.at</a>)</i><br /><br /><br /><br /><b>Beta Testeurs</b><br />Merci à tout les participants du Beta-Test<br />aux utilisateurs de CBACK Premium et bien sûr à<br />nos collègues de la "Mod-Scene" Qui nous ont aidés avec les Beta Tests et les corrections.</i>';
$lang['ctracker_credits_info']			  = 'Plus de Sécurité?';
$lang['ctracker_credits_info_text']		  = 'L\'add-on parfait pour phpBB and the CrackerTracker: Pour une sécurité optimale nous recommandons le Mod <b>Advanced Visual Confirmation</b> par AmigaLink. Ce MOD améliore la fonction CAPTCHA de phpBB et de CrackerTracker Professional avec un système plus complexe qui ne peut être lu par les Robots. Ce MOD peut être téléchargé sur <a href="http://www.amigalink.de" target="_blank">www.AmigaLink.de</a>.<br /><br /><br /><br />Nous vous suggérons d\'intégrer également ce MOD dans votre forum pour une excellente sécurité';


/*
 * File Hash Check in ACP
 */
$lang['ctracker_fchk_head']				  = 'Scanner de sommes de contrôle CrackerTracker';
$lang['ctracker_fchk_subhead']			  = 'Ce scanner crée une somme de contrôle de chaque fichier PHP de votre forum quand vous cliquez "Créer ou mettre à jour les sommes de contrôle". Après celà vous avez la possibilité avec “Chercher modifications des fichiers” de déterminer si un fichier a été ou non modifié depuis la dernière production de vérifications de totaux. Vous pouvez ainsi voir si des fichiers ont été changés sans que vous ayiez fait quoique ce soit. C\'est habituelelment le signe que quelqu\'un a obtenu un accès au volume de données de votre forum. Vérifiez la date de dernière vérification pour voir si une personne non autorisée a activé le scanner!<br /><br /><br /><b>Information:</b> Tous les serveurs ne permettent pas cette fonctionnalité. Il peut parfois survenir un Timeout si le serveur prend trop de temps à produire la liste des fichiers phpBB. D\'autres serveurs stoppent le processus car il s\'agit d\'une procédure intensive.<br /><br /><br />&raquo; La dernière actualisation de la vérification a eu lieu le <b>%s</b>.';
$lang['ctracker_fchk_funcheader']		  = 'Fonctionnalités';
$lang['ctracker_fchk_tableheader']		  = 'Sortie système';
$lang['ctracker_fchk_option1']			  = 'Créer ou mettre à jour sommes de contrôle';
$lang['ctracker_fchk_option2']			  = 'Vérifier changements des fichiers';
$lang['ctracker_fchk_select_action']	  = 'Merci de choisir une action!';
$lang['ctracker_fchk_update_action']	  = 'Sommes de contrôle mises à jour!';
$lang['ctracker_fchk_tablehead1']		  = 'Chemin';
$lang['ctracker_fchk_tablehead2']		  = 'Etat';
$lang['ctracker_file_unchanged']		  = 'NON MODIFIE';
$lang['ctracker_file_changed']		 	  = 'MODIFIE';
$lang['ctracker_file_deleted']			  = 'SUPPRIME';


/*
 * File Safety Scanner in ACP
 */
$lang['ctracker_fscan_complete']		  = 'Le scan des fichiers a été éxécuté avec succès. Merci de cliquer sur "Voir résultats". Vous pouvez corriger les fichiers.<br /><br /><br /><br /><u>ASTUCE:</u><br /><br />I peut arriver parfois que CrackerTracker détecte un fichier comme peu sûr. Ceci peu arriver dans le cas de fichiers PHP trés, trés différents et parfois un programmeur souhaite que son code soit transposé à partir de sources extérieures. Dans ce cas - et UNIQUEMENT si vous en êtes absolument sûr - vous pouvez dire à CRACKERTRACKER qu\'il s\'agit d\'un fichier sécurisé. Ecrivez simplement dans ce fichier, à son tout début: <?php le code suivant: <br /><br /><br /><i>// CTracker_Ignore: File Checked By Human</i><br /><br /><br />Si vous avez un doute, vous pouvez également vous adresser à la <a href="http://www.community.cback.de" target="_blank">Communuté CBACK</a> pour davantage d\'instructions.';
$lang['ctracker_fscan_unchecked']		  = 'NON VERIFIE';
$lang['ctracker_fscan_ok']                = 'SUR';
$lang['ctracker_fscan_prob_1']			  = 'extension.inc probablement non inclus ou trop tard';
$lang['ctracker_fscan_prob_2']			  = '$phpbb_root_path probablement non initialisé correctement';
$lang['ctracker_fscan_prob_3']			  = 'common.php / pagestart.php probablement non inclus ou trop tard';
$lang['ctracker_fscan_prob_4']			  = 'Le Code du fichier est possiblement éxécutable en dehors de phpBB';
$lang['ctracker_fscan_prob_5']			  = 'extension.inc est manquant et/ou $phpbb_root_path et/ou  constante non trouvée';
$lang['ctracker_fscan_prob_def']		  = 'Une erreur indéfinie est survenue pendant le scanning';
$lang['ctracker_fscan_important']		  = 'Votre attention s\'il vous plaît!';
$lang['ctracker_fscan_sel_action']		  = 'Pour démarrer la vérification de tous vos fichiers merci de cliquer sur "Démarrer vérification des fichiers". Une fois accompli cliquez sur "Voir résultats" pour voir les résultatsde la vérifcation. Cette liste peut être retrouvée à tout moment sur le panneau d\'administration jusqu\'à ce qu\'une nouvelle vérification soit démarrée.<br /><br /><br />Pour des raisons techniques il n\'est pas possible de délivrer une information <u>sans ambigûité</u> et <u>infaillible</u> sur la sécurité d\'un script PHP. Aussi ne vous endormez pas sur de fausses impressions de sécurité. Il peut arriver que le scanner classe un fichier sûr comme non sûr et vice versa. PHP est si complexe et les codes dépendent de tant de facteurs qu\'il ne peut y avoir cent pour cent de sécurité. Sinon il n\'y aurait plus de scripts insécurisés. ;-)<br /><br /><br />Ce scanner est spécialisé dans les failles de sécurité des fichiers inclus en cherchant les secteurs du forum accessibles de l\'extérieur, offrant ainsi une surface d\'attaque que CrackerTracker ne peut surveiller, lui-même travaillant à l\'intérieur du forum. Avec ce scanner vous pouvez chercher facilement et éliminer une grande partie de ces dangers.<br /><br /><br />Pour davantages de détails et d\'assistance, comme par exemple comment corriger les fichiers classés comme incertains, vous trouverez beaucoup de réponses avec la fonction de recherche de la communauté CBACK!<br /><br /><br />';
$lang['ctracker_fscan_head']			  = 'Scanner de Sécurité CBACK CrackerTracker';
$lang['ctracker_fscan_subhead']			  = 'Ce scanner de sécurité examine tous les fichiers PHP de votre forum sur de sérieux problèmes de sécurité et y porte une attention particulière afin qu\'il n\'y ait pas de failles de sécuirité pouvant être exploitées par des vers. Ces failles peuvent être exploitées de l\'extérieur sans utiliser les fichiers du forum. Aussi le système CrackerTracker restera-t-il inactif et ne pourra pas protéger les fichiers. Avec ce module vous avez la possibilité de chercher de telles failles et de les éliminer.<br /><br /><br /><b>Veuillez noter:</b> Tous les serveurs n\'acceptent pas cette fonctionnalité! Avce de trés grands forums il peut arriver que ce système de scan, trés gourmand en ressources, outrepasse le temps d\'exécution PHP. L\'algorithme de ce scanner a été optimisé au mieux afin de se cantonner dans les limites, toutefois cela peut malheureusement survenir sur certaines machines. Nous vous prions de bien vouloir le prendre en compte.<br /><br /><br />&raquo; La dernière vérification a été effectuée le <b>%s</b>.';
$lang['ctracker_fscan_option1']			  = 'Démarrer vérification des fichiers';
$lang['ctracker_fscan_option2']			  = 'Voir résultats';


/*
 * Global message in ACP
 */
$lang['ctracker_glob_msg_head']			  = 'Message Global';
$lang['ctracker_glob_msg_subhead']		  = 'Ici vous pouvez délivrer un message global à l\'intention de tous les utilisateurs, message que l\'utilisateur lira lors de sa prochaine connexion. Vous avez la possibilité de vous reférer à un lien ou d\'écrire votre propre texte (255 caractères). ;)';
$lang['ctracker_glob_msg_entry']          = 'Paramétrer le message ';
$lang['ctracker_glob_msg_submit']		  = 'Insérer';
$lang['ctracker_glob_msg_reset']		  = 'Annuler';
$lang['ctracker_glob_msg_type']			  = 'Type du message global';
$lang['ctracker_glob_type_1']			  = 'Texte';
$lang['ctracker_glob_type_2']			  = 'Lien';
$lang['ctracker_glob_msg_txt']			  = 'Texte du message';
$lang['ctracker_glob_msg_link']			  = 'Lien de destination du message';
$lang['ctracker_glob_msg_reset']		  = 'Annuler message actuel';
$lang['ctracker_glob_res_txt']			  = 'Si vous cliquez sur "Annuler message actuel", un message enregistré sera supprimé.';
$lang['ctracker_glob_msg_saved']		  = 'Le message global a été enregistré avec succès.<br /><br />Cliquez <a href="%s">ICI</a> pour revenir au gestionnaire CrackerTracker.';
$lang['ctracker_glob_msg_reset_ok']		  = 'Le message global a été effacé de la table des utilisateurs. le message entré ne sera plus affichée.<br /><br />Cliquez <a href="%s">ICI</a> pour revenir au gestionnaire CrackerTracker.';
$lang['ctracker_dbg_mode']            	  = '<b>CrackerTracker tourne en MODE DEBOGUAGE. Ceci ne devrait pas être une condition permanente.<br />Veuillez revenir en mode normal dés que possible.<br /><br /><u>Ce message ne peut pas être effacé!</u></b>';


/*
 * IP&Agent Blocker
 */
$lang['ctracker_ipb_delete']			  = 'Supprimer entrée';
$lang['ctracker_ipb_blocklist']			  = 'Liste des bloqués';
$lang['ctracker_ipb_head']                = 'Bloqueur de Proxys, IP & Agents';
$lang['ctracker_ipb_description']		  = 'ici vous pouvez gérer la liste des bloqués du Bloqueur de Proxys, IP & Agents CrackerTracker. Vous pouvez suuprimer des entrées existantes ou en ajouter de nouvelles. Avec une nouvelle entrée vous disposez du joker (*) pour ajouter n\'importe quelle combinaison au filtre de la liste. Par exemple: lwp* bloquera lwp-1 aussi bien que lwp-simple etc. ou bien 100.*.*.* bloquera toutes les adresses IP commençant par 100. .<br /><br /><b>ATTENTION</b> Veillez à ne pas bloquer votre propre User-Agent ou adresse IP. Autrement vous seriez éjecté de votre forum!';
$lang['ctracker_ipb_new_entry']			  = 'Nouvelle entrée';
$lang['ctracker_ipb_added']               = 'Entrée ajoutée avec succès!';
$lang['ctracker_ipb_deleted']			  = 'Entrée supprimée avec succès!';
$lang['ctracker_ipb_add_now']			  = 'Ajouter une entrée';


/*
 * Log Manager
 */
$lang['ctracker_log_manager_title']		  = 'Gestionnaire des rapports';
$lang['ctracker_log_manager_subtitle']	  = 'Ici vous pouvez consulter ou supprimer tous les fichiers de rapports de CrackerTracker.';
$lang['ctracker_log_manager_overview']	  = 'Vue d\'ensemble du gestionnaire de rapports';
$lang['ctracker_log_manager_blocked']	  = 'CrackerTracker a bloqué <b>%s</b> attaques jusqu\'alors.';
$lang['ctracker_log_manager_overview']	  = 'Vue d\'ensemble du fichier de rapport';
$lang['ctracker_log_manager_head1']		  = 'Nom du rapport';
$lang['ctracker_log_manager_head2']		  = 'Nombre d\'entrées';
$lang['ctracker_log_manager_head3']		  = 'Fonctions';
$lang['ctracker_log_manager_name2']		  = 'Protection contre Vers & Exploits';
$lang['ctracker_log_manager_name3']		  = 'Bloqueur de Proxys, IP & Agents';
$lang['ctracker_log_manager_name4']		  = 'Connexions incorrectes';
$lang['ctracker_log_manager_name5']		  = 'Spammeurs bloqués';
$lang['ctracker_log_manager_name6']       = 'Entrées de déboguage';
$lang['ctracker_log_manager_view']		  = 'VOIR';
$lang['ctracker_log_manager_delete']	  = 'SUPPRIMER';
$lang['ctracker_log_manager_delete_all']  = 'Supprimé tous les fichiers de rapports';
$lang['ctracker_log_manager_deleted']	  = 'Le fichier de rapport a été supprimé avec succès!';
$lang['ctracker_log_manager_all_deleted'] = 'Tous les fichiers de rapport ont été supprimés avec succès!';
$lang['ctracker_log_manager_showheader1'] = 'Il y a <b>une</b> entrée dans ce fichier de rapport. Cliquez <b><a href="%s">ICI</a></b> pour retourner à la vue d\'ensemble.';
$lang['ctracker_log_manager_showheader']  = 'Il y a <b>%s</b> entrées dans ce fichier de rapport. Cliquez <b><a href="%s">ICI</a></b> pour retourner à la vue d\'ensemble.';
$lang['ctracker_log_manager_showlog']	  = 'Voir fichier';
$lang['ctracker_log_manager_cell_1']	  = 'Date / Heure';
$lang['ctracker_log_manager_cell_2a']	  = 'Appel';
$lang['ctracker_log_manager_cell_2b']	  = 'Pseudo';
$lang['ctracker_log_manager_cell_3']	  = 'Referer';
$lang['ctracker_log_manager_cell_4']	  = 'User-Agent';
$lang['ctracker_log_manager_cell_5']	  = 'Adresse IP';
$lang['ctracker_log_manager_cell_6']	  = 'Hôte distant';
$lang['ctracker_log_manager_sysmsg']	  = 'Le dernier nettoyage du fichier de rapport remonte à <b>%s</b>.';


/*
 * Footer configuration
 */
$lang['ctracker_footer_head']			  = 'Gestion du bas de page';
$lang['ctracker_footer_subhead']		  = 'Ici vous pouvez choisir le bas de page que CrackerTracker affichera dans votre Forum. Merci de ne pas modifier ce bas de page ainsi que le lien vers www.cback.de!';
$lang['ctracker_select_footer']			  = 'Choisissez votre bas de page';
$lang['ctracker_footer_saveit']			  = 'Accepter la disposition du bas de page';
$lang['ctracker_footer_done']			  = 'Les modifications du bas d epage ont été sauvegardées avec succès!';


/*
 * Maintenance Module in ACP
 */
$lang['ctracker_ma_unknown']			  = '<font color="#FFB900"><b>INCONNU</b></font>';
$lang['ctracker_ma_secure']			  	  = '<font color="#1CBF00"><b>SECURISE</b></font>';
$lang['ctracker_ma_warning']			  = '<font color="#FF0000"><b>ATTENTION</b></font>';
$lang['ctracker_ma_active']			  	  = '<font color="#1CBF00"><b>ACTIF</b></font>';
$lang['ctracker_ma_inactive']			  = '<font color="#FF0000"><b>INACTIF</b></font>';
$lang['ctracker_ma_on']				  	  = 'ON';
$lang['ctracker_ma_off']				  = 'OFF';
$lang['ctracker_ma_ca']				  	  = '<font color="#1CBF00"><b>OK</b></font>';
$lang['ctracker_ma_ci']					  = '<font color="#FF0000"><b>NON PARAMETRE</b></font>';
$lang['ctracker_ma_head']				  = 'Maintenance et vérification système';
$lang['ctracker_ma_subhead']			  = 'Ce système examine automatiquement les fonctionnalités des modules de sécurité de CrackerTracker et vous propose des astuces pour optimiser votre système.';
$lang['ctracker_ma_systest']			  = 'Test automatique du Système';
$lang['ctracker_ma_sectest']			  = 'Test de sécurité';
$lang['ctracker_ma_maint']				  = 'Fonction de service';
$lang['ctracker_ma_name_1']				  = 'Système de protection contre Vers & Exploits';
$lang['ctracker_ma_name_2']				  = 'Unité de contrôle des variables';
$lang['ctracker_ma_name_3']				  = 'Unité de protection contre IP, Proxys & Agents ';
$lang['ctracker_ma_name_4']				  = 'Groupe de définitions heuristiques des Vers - Nombre de Definitions: <b>%s</b>';
$lang['ctracker_ma_syshead_1']			  = 'Module de sécurité';
$lang['ctracker_ma_syshead_2']			  = 'Statut';
$lang['ctracker_ma_seccheck_1']			  = 'Pont de vérification';
$lang['ctracker_ma_seccheck_2']			  = 'Version / Statut';
$lang['ctracker_ma_seccheck_3']			  = 'Reférence';
$lang['ctracker_ma_seccheck_4']			  = 'Statut';
$lang['ctracker_ma_scheck_1']			  = 'Version de PHP (<a href="http://www.php.net" target="_blank">Visitez le site</a>)';
$lang['ctracker_ma_scheck_2']			  = '&raquo; PHP SAFE MODE';
$lang['ctracker_ma_scheck_3']			  = '&raquo; PHP GLOBALS';
$lang['ctracker_ma_scheck_4']			  = 'Version de phpBB (<a href="http://www.phpbb.com" target="_blank">Visitez le site</a>)';
$lang['ctracker_ma_scheck_4a']			  = '&raquo; Confirmation Visuelle';
$lang['ctracker_ma_scheck_4b']			  = '&raquo; Activation du compte';
$lang['ctracker_ma_scheck_5']			  = 'CBACK CrackerTracker (<a href="http://www.cback.de" target="_blank">Visitez le site</a>)';
$lang['ctracker_ma_chmod']				  = '<b>Statut CHMOD777 :</b> ';
$lang['ctracker_ma_desc_link']			  = 'EXECUTER MAINTENANT';
$lang['ctracker_ma_desc1']				  = '<b>Effacer Table IP, Proxy & Agents</b><br />Ici vous pouvez supprimer <u>toutes</u> les entrées de la Table des IP, Proxy & Agents.';
$lang['ctracker_ma_desc2']				  = '<b>Paramètres d\'origine: Bloqueur d\'IP, Proxys & Agents Blocker</b><br />Ici vous pouvez restaurer le statut d\'origine de la table des IP, Proxy & Agents . Vos filtres seront perdus!';
$lang['ctracker_ma_desc3']				  = '<b>Supprimer l\'Historique des Connexions</b><br />Ici vous pouvez supprimer toutes les entrées de l\'historique des connexions, indépendamment des utilisateurs et indépendamment du nombre de sauvegardes par utilisateur.';
$lang['ctracker_ma_desc4']				  = '<b>Effacer fichier vérification des tables de hachage</b><br />Supprime toutes les entrées sauvegardées du fichier de vérification de la table de hachage.';
$lang['ctracker_ma_desc5']				  = '<b>Effacer la Table du scanner de sécurité</b><br />Efface tous les résultats qui avaient été enregistrés dans la base de données pendant l\'examen de sécurité des fichiers.';
$lang['ctracker_ma_succ_main']			  = 'Processus exécuté avec succès!';
$lang['ctracker_ma_err_main']			  = 'Echec du Processus!';


/*
 * Miserable User Module in ACP...
 */
$lang['ctracker_mu_success']			  = 'L\'utilisateur a été marqué comme "Utilisateur Misérable" et rencontrera dés maintenant quelques problèmes pour naviguer sur votre forum. ;)';
$lang['ctracker_mu_error_admin']		  = 'ADMINS ou MODs ne peuvent pas être marqués comme "Utilisateur Misérable"!';
$lang['ctracker_mu_deleted']			  = 'Les utilisateurs sélectionnés ont été retirés avec succès de la liste des Utilisateurs misérables.';
$lang['ctracker_mu_head']				  = 'Utilisateur Misérable';
$lang['ctracker_mu_subhead']			  = 'Si un utilisateur ne se comporte pas comme il devrait, le risque est grand, et cela s\'est déjà produit, qu\'il se réinscrive sous un autre compte après avoir été banni. Il existe une fonctionnalité appelée "Utilisateur misérable" qui a été fréquememnt demandée. Le système CrackerTracker ne l\'associe pas avec "Nous solutionnons par l\'envoi de messages d\'erreur absurdes", qui est relativement transparent, mais procède selon le principe  "N\'alimentez pas le singe": Si un utilisateur est ainsi marqué "Utilisateur Misérable", ses messages ne pourront être lus que par l\'administrateur. Pour les autres utilisateurs, ses contributions seront invisibles et il n\'y aura par conséquent personne pour dialoguer avec le fauteur de troubles. Celui-ci va vite s\'ennuyer et quitter le forum.<b>Note: <u>cette fonction ne fait que masquer les messages dans un sujet.</u> L\'utilisation des fonctions citation ou recherche vous montre encore les messages d\'un utilisateur misérable !';
$lang['ctracker_mu_select']				  = 'Marquer l\'utilisateur comme Utilisateur Misérable';
$lang['ctracker_mu_find']				  = 'Chercher un Pseudonyme';
$lang['ctracker_mu_send']				  = 'Entrer Pseudonyme';
$lang['ctracker_mu_entr']				  = 'Pseudonyme marqués';
$lang['ctracker_mu_uname']				  = 'Pseudonyme entré';
$lang['ctracker_mu_remove']				  = 'Supprimer les entrées';
$lang['ctracker_mu_no_defined']			  = 'Il n\'y a, à ce jour, aucun utilisateur marqué comme "Utilisateur Misérable".';


/*
 * Recovery feature in ACP
 */
$lang['ctracker_rec_head']				  = 'Restauration du Système';
$lang['ctracker_rec_subhead']			  = 'Ici vous pouvez effectuer une sauvegarde de la Table de Configuration de votre forum ou récupérer la dernière configuration fonctionnelle. Si vous avez activé cette fonction dans les paramètres généraux de CrackerTracker, alors il sera procédé à une sauvegarde chaque fois que vous changerez la configuration générale. (ATTENTION! Ce n\'est <b>PAS</b> une sauvegarde de toute la Base de données!)<br /><br />Si vous n\'êtes pas dans le Panneau d\'Admin après avoir modifié les paramètres, il vous est possible de réactiver la dernière configuration en utilisant la console d\'urgence de CrackerTracker, too. Merci de lire les commentaires du fichier <i>ctracker/emergency.php</i> pour davantage d\'instructions sur les configurations de forums en cas d\'urgence. Veuillez noter que ce fichier doit être activé avant usage.<br /><br /><b>ATTENTION!</b> Cetet fonctionnalité ne doit être utilisée qu\'en cas de sérieux problèmes!';
$lang['ctracker_rec_last_saved']		  = 'Dernière sauvegarde de la Table de Configuration: <b>%s</b>';
$lang['ctracker_rec_never_saved']		  = 'La table de Configuration n\'a pas été sauvegardée à ce jour!';
$lang['ctracker_rec_backup']			  = 'Sauvegarde de la Table de Configuration';
$lang['ctracker_rec_restore']			  = 'Réstaurer la dernière Configuration fonctionnelle';
$lang['ctracker_rec_succ']				  = 'La procédure de Base de données a été exécutée avec succès.';
$lang['ctracker_rec_pab']				  = 'La restauration n\'est pas disponible tant que vous n\'aurez pas effectué une sauvegarde avec succès!';


/*
 * Language Strings used at multiple places
 */
$lang['ctracker_error_updating_userdata'] = 'CBACK CrackerTracker a échoué dans l\'exécution d\'une opération de base de données dans la Table des utilisateurs.';
$lang['ctracker_error_database_op']       = 'CBACK CrackerTracker ne parvient pas à exécuter correctement l\'opération de base de données.';
$lang['ctracker_message_dialog_title']    = 'CBACK CrackerTracker Professionel';


/*
 * Language Strings used for the footer itself
 */
$lang['ctracker_fdisplay_imgdesc']		  = 'Panneau de Sécurité';
$lang['ctracker_fdisplay_n'] 			  = '<a href="http://www.cback.de" target="_blank">Securisé</a> par <a href="http://www.cback.de" target="_blank">CBACK CrackerTracker</a>.';
$lang['ctracker_fdisplay_c'] 			  = 'Protégé par <a href="http://www.cback.de" target="_blank">CBACK CrackerTracker</a><br /><b>%s</b> Attaques bloquées.';
$lang['ctracker_fdisplay_g'] 			  = '<b>%s</b> Attaques bloquées';


/*
 * Language Strings for the class_ct_database.php
 */
$lang['ctracker_error_loading_config']    = 'Echec du chargement de la Configuration de CBACK CrackerTracker à partir de la base de données. Avez vous bien exécuté le script d\'installation et modifié correctement le fichier "includes/constants.php" ?';
$lang['ctracker_error_updating_config']   = 'Echec de la mise à jour de la Configuration de CBACK CrackerTracker. Avez vous bien exécuté le script d\'installation et modifié correctement le fichier "includes/constants.php" ?';
$lang['ctracker_error_loading_blocklist'] = 'Echec du chargement de la liste des bloqués de CBACK CrackerTracker à partir de la base de données. Avez vous bien exécuté le script d\'installation et modifié correctement le fichier "includes/constants.php" ?';
$lang['ctracker_error_insert_blocklist']  = 'Echec de l\'ajout de données à la liste des bloqués de CBACK CrackerTracker. Avez vous bien exécuté le script d\'installation et modifié correctement le fichier "includes/constants.php" ?';
$lang['ctracker_error_delete_blocklist']  = 'Echec de la suppression de données à la liste des bloqués de CBACK CrackerTracker. Avez vous bien exécuté le script d\'installation et modifié correctement le fichier "includes/constants.php" ?';
$lang['ctracker_error_login_history']     = 'Une erreur est survenue pendant une opération de base de données sur l\'historique des connexions de CBACK CrackerTracker. Avez vous bien exécuté le script d\'installation et modifié correctement le fichier "includes/constants.php" ?';
$lang['ctracker_error_del_login_history'] = 'L\'historique des connexions de CrackerTracker ne peut pas être vidé.';


/*
 * Language Strings used in class_ct_userfunctions.php
 */
$lang['ctracker_info_search_time']        = "Pour des raisons de sécurité la recherche n'est possible que %s fois par périodes de  %s secondes. ce nombre étant dépassé, il vous faudra attendre <span id=\"waittime\">%s</span> secondes, pour effectuer une nouvelle recherche. <script type=\"text/javascript\"><!-- \n var wait = %s; var waitt = wait * 1000; for(i=1; i <= wait; i++) { window.setTimeout(\"newoutput(\" + i + \")\", i * 1000); } function newoutput(waitcounter) { if ( (waitt/1000) == waitcounter ) { document.getElementById(\"waittime\").innerHTML = \"0\"; } else { document.getElementById(\"waittime\").innerHTML = (waitt/1000) - waitcounter; } } //--></script>";
$lang['ctracker_info_regist_time']        = "Pour des raisons de sécurité un enregistrement n'est possible que toutes les %s secondes. si ce délai n'étant pas atteint, il vous reste <span id=\"waittime\">%s</span> secondes, pour demander à vous enregistrer. <script type=\"text/javascript\"><!-- \n var wait = %s; var waitt = wait * 1000; for(i=1; i <= wait; i++) { window.setTimeout(\"newoutput(\" + i + \")\", i * 1000); } function newoutput(waitcounter) { if ( (waitt/1000) == waitcounter ) { document.getElementById(\"waittime\").innerHTML = \"0\"; } else { document.getElementById(\"waittime\").innerHTML = (waitt/1000) - waitcounter; } } //--></script>";
$lang['ctracker_info_regip_double']		  = 'Il y a déjà eu un enregsitrement à partir de cette adresse IP. Pour des raisons de sécurité un seul enregsitrement provenant de la même adresse IP est possible.';
$lang['ctracker_info_profile_spammer']	  = 'Cet enregistrement a été identifié comme un compte de spam! Si vous pensez que ce n\'est pas le cas, veuillez contacter l\'administrateur de ce forum afin qu\'il vérifie votre compte.';
$lang['ctracker_info_password_minlng']    = 'L\'administrateur a décidé que le mot de passe devait contenir au moins <b>%s</b> caractères. Celui que vous avez choisi n\'en contient que <b>%s</b>. Veuillez cliquez sur "retour" pour entrer un nouveau mot de passe.';
$lang['ctracker_info_password_cmplx']	  = 'L\'administrateur a décidé que le mot de passe devait contenir au <b>minimum</b> les choses suivantes: %s';
$lang['ctracker_info_password_cmplx_1']	  = 'Figures';
$lang['ctracker_info_password_cmplx_2']	  = 'Minuscules';
$lang['ctracker_info_password_cmplx_3']	  = 'Capitales';
$lang['ctracker_info_password_cmplx_4']	  = 'Caractères spéciaux';
$lang['ctracker_info_pw_expired']		  = 'L\'administrateur a paramétré le forum afin que le mot de passe ne soit valide que pendant <b>%s jours</b>. Nous vous recommendons, pour de sraisons de sécurité, de changer votre mot de passe maintenant. (Profil)';


/*
 * Language Strings used in ct_visual_confirm.php
 */
$lang['ctracker_login_wrong']   = 'Le Code de Confirmation Visuelle entré est incorrect!';
$lang['ctracker_code_dbconn']   = 'Echec du chargement, à partir de la base de données, du Code de Confirmation Visuelle! Si vous avez phpBB Plus, vous devez installer le module pour Confirmation Visuelle. Veuillez consulter les références à phpBB plus dans le répertoire "add_ons" du package du Mod CrackerTracker!';
$lang['ctracker_login_success'] = 'Votre compte a été activé à nouveau.<br /><br />Cliquez <a href="%s">ICI</a> pour retourner à la page de connexion.';
$lang['ctracker_code_count']    = 'Le nombre d\'entrées de la Confirmation Visuelle a dépassé les limites de cette session.';


/*
 * Language Strings used in ctracker_login.php
 */
$lang['ctracker_login_title']   = 'Activation du Compte de CrackerTracker';
$lang['ctracker_login_logged']  = 'Les utilisateurs enregistrés ne peuvent accéder au site.';
$lang['ctracker_login_confim']  = 'Le nombre maximum de connexions erronées à votre compte a été atteint. Aussi votre compte a-t-il été bloqué. Il devra être réactivé en utilisant la Confirmation Visuelle.<br /><br />Veuillez taper le code affiché ci-dessus puis cliquer sur "Activer" pour déverrouiller votre compte. Une fois effectué, vous pourrez retourner à la page de connexion.';
$lang['ctracker_login_button']  = 'Activer';


/*
 * Language Strings for IP Warning Engine
 */
$lang['ctracker_ipwarn_info']	= 'Le scan de vos adresses IP est <b>%s</b>';
$lang['ctracker_ipwarn_prof']	= 'Scanner des adresses IP';
$lang['ctracker_ipwarn_pdes']	= 'Le Scanner des adresses IP vérifie, si activé, Les modifications d\'adresses IP. Si quelqu\'un se connecte sur votre compte avec une autre adresse, vous recevrez un bref message ( Et également, bien sûr, si vous vous connectez à partir d\'adresses différentes). . Vérifiez régulièrement que la fonction d\'alerte est activée, un individu malveillant pouvant l\'avoir désactivée. L\'enregistrement de l\'historique des connections se poursuit toutefois, vous avez donc toujours la possibilité de vérifier les modifications après réactivation.';
$lang['ctracker_ipwarn_chng']	= '<b>&raquo; AVIS &laquo;</b><br />L\'adresse IP de votre compte a changé. La connexion actuelle provient de  <b>%s</b>, la précédente de <b>%s</b>. Si vous ne vous êtes pas connecté à partir d\'une autre adresse, alors peut-être un aggresseur a-t-il utilisé votre compte sans autorisation!';
$lang['ctracker_ipwarn_welc']	= '<b>&raquo; AVIS &laquo;</b><br />La gamme des adresses IP de votre compte n\'a pas encore été initialisée. Ceci survient après deux connexions. Si vous souhaitez initialiser le scanner maintenant, alors connectez-vous et déconnectez-vous deux fois.';
$lang['ctracker_ipwarn_send']	= 'Accepter paramètres';


/*
 * Language Strings for Login History
 */
$lang['ctracker_lhistory_h']	= 'Historique des connexions';
$lang['ctracker_lhistory_i']	= 'Ici vous pouver jeter un oeil sur vos adresses IP enregistrées et les horaires de vos <b>%s</b> dernières connexions. Vous pourrez ainsi voir si votre compte a été utilisé par quelqu\'un d\'autre. S\'il y a des horaires de connexion ou des adresses IP inconnues, il est alors possible qu\'un individu ait dérobé votre mot de passe. Dans ce cas vous devriez changer votre mot de passe et vérifier également votre compte email.';
$lang['ctracker_lhistory_h1']	= 'Date et heure de connexion';
$lang['ctracker_lhistory_h2']	= 'Addresses IP sauvegardées';
$lang['ctracker_lhistory_nav']	= 'Historique des connexions CBACK CrackerTracker';
$lang['ctracker_lhistory_err']  = 'Vous devez être connecté pour utiliser les fonctionnalités de CrackerTracker.';
$lang['ctracker_lhistory_off']  = 'L\'Historique des connexions a été désactivée par l\'admin.';


/*
 * Other Language Strings used in the Board itself
 */
$lang['ctracker_gmb_link']		= 'L\'administrateur a écrit une note importante destinée à tous les utilisateurs. Cette note peut être lue ici:<br /><br /><a href="%s">%s</a><br />';
$lang['ctracker_gmb_mark']		= 'Marquer le message comme lu';
$lang['ctracker_gmb_markip']	= 'Supprimer l\'astuce';
$lang['ctracker_gmb_loginlink']	= 'Sécurité des Connexions';
$lang['ctracker_gmb_1stadmin']	= 'Les paramètres du premier admin ne peuvent pas être changés.';
$lang['ctracker_gmb_pu_1']		= '<b>CBACK CrackerTracker - Mauvaise configuration</b><br /><br />le Port 21 est utilisé par les services FTP. Si le forum est redirigé via ce port, il ne sera normalement plus exécutable, car les navigateurs utilisent également ce port pour les accès ftp.';
$lang['ctracker_gmb_pu_2']		= '<b>CBACK CrackerTracker - Mauvaise configuration</b><br /><br />La durée de session est trop courte! Sans doute serz-vous déconnecté sans arrêt avant de pouvoir modifier ce paramètre.';
$lang['ctracker_gmb_pu_3']		= '<b>CBACK CrackerTracker - Mauvaise configuration</b><br /><br />Le chemin du script commence et/ou se termine avec autre chose qu\'un slash  ( comme /forum/) ou ne comporte pas uniquement un slash (/)!';
$lang['ctracker_gmb_pu_4']		= '<b>CBACK CrackerTracker - Mauvaise configuration</b><br /><br />Le nom du serveur ne doit pas se terminer par un slash (/) !';
$lang['ctracker_binf_spammer']	= 'Le système de sécurité anti-spam vous surveille. Vous avez atteint le nombre maximum de messages permis par périodes de %s secondes. Si vous essayez de poster un nouveau message avant les <b>%s</b> prochaines secondes, votre compte sera <b>blocked!</b><br /><br />Merci d\'attendre un peu. Désolé de vous prendre de votre temps, mais c\'est nécessaire pour des raisons de sécurité.';
$lang['ctracker_binf_sban']		= 'Le système de blocage des spams vous a banni car vous avez été identifié comme un spammeur.';
$lang['ctracker_sendmail_info'] = 'Pour des raisons de sécurité vous n\'êtes autorisé a envoyer un e-mail que toutes les % minutes.';
$lang['ctracker_pwreset_info']	= 'Pour des raisons de sécurité, il ne vous est possible de changer de mot de passe que toutes les % minutes. Merci de contacter l\'administrateur si vous avez des problèmes!';
$lang['ctracker_vc_guest_post'] = 'Confirmation Visuelle pour Invités';
$lang['ctracker_vc_guest_expl'] = 'Merci d\'entrer le code suivant avant d\'envoyer votre message. Ceci est nécessaire avec les invités pour des raisons de sécurité anti-spam.';

?>
