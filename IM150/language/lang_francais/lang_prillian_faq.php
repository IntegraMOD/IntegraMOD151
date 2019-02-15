<?php
/***************************************************************************
 *                      lang_prillian_faq.php [French]
 *                            -------------------
 *   begin                : Friday, May 30, 2003
 *   version              : 1.1.0
 *   date                 : 2003/12/23 23:23
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
//

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_prillian.' . $phpEx);


$progname = $lang['Prillian'];
//
$faq[] = array("--", "Questions Générales");
$faq[] = array("C'est quoi Prillian ?", "Prillian est une messagerie instantanée inclus au forum qui permet à nos utilisateurs enregistrés de pouvoir se contacter facilement et rapidement. C'est très similaire à d'autres programmes de messageries que vous avez utilisé précédemment, mais l'usage de Prillian est en général limité aux autres membres du forum ");
$faq[] = array("J'ai besoin de télécharger un programme pour utiliser Prillian ?", "Non, il n'y a pas de programme à télécharger Prillian est activé sur ce forum. Vous pouvez accéder et utiliser le programme par votre navigateur exactement comme une page web normale ou le forum lui-même.");
$faq[] = array("Je dois m'enregistrer pour utiliser Prillian ?", "Oui. Prillian fait partie du forum et utilise le même système d'enregistrement. Il utilise également une partie du système de messagerie privée du forum. Vous ne pourrez utiliser la messagerie que si vous êtes enregistré et connecté.");
$faq[] = array("Je dois rester constamment sur le site pour utiliser Prillian ?", "Non, ce n'est nécessaire. Aussi longtemps que vous gardez la fenêtre de Prillian ouverte, vous pouvez continuer normalement à surfer sur le Web. Gardez à l'esprit que le programme est ouvert dans votre navigateur, si vous fermez celui-ci vous fermerez Prillian également.");
$faq[] = array("Mon navigateur a-t-il besoin d'options particulières pour utiliser Prillian ?", "Prillian utilise beaucoup de JavaScript pour les options de contrôle et d'ouverture de nouvelles fenêtres. Il est donc recommandé que vous ayez ces options activées pour notre forum. Si ces options ne sont pas activées, vous pouvez encore utiliser la messagerie. Cependant, quelques fonctions ne marcheront pas.");
$faq[] = array("Comment accéder à Prillian ?", "D'abord il faut être membre et connecté sur le forum. Sur certains forums, l'administrateur peut configurer Prillian pour s'ouvrir automatiquement quand vous arrivez sur l'index du forum. Si la messagerie ne s'ouvre pas automatiquement recherchez un lien appelé \"Ouvrir  Prillian\" ou \"Qui est en ligne\" ou quelque chose de similaire. Si un nouveau message vous attend, ce lien doit afficher que vous avez un nouveau message . Cliquez sur ce lien pour ouvrir une nouvelle fenêtre de navigateur préformatée. Cette fenêtre appelé le \"Client MI,\" vous autorise à accéder à Prillian.");
$faq[] = array("J'ai fait tout ça, mais la fenêtre m'affiche des messages d'erreurs étranges. Pourquoi ?", "Il y a plusieurs raisons possibles. l'administrateur du forum peut avoir temporairement désactivé le programme (par exemple pour une mise à jour). Il est également possible qu'il vous ait banni de la liste des utilisateurs autorisés de Prillian. Vous n'avez rien à vous reprocher ? Il est également possible que vous ayez désactivé vous-même le programme. Dans ce cas le message d'erreur doit afficher un lien vers l'éditeur des préférences, où vous pouvez réactiver le programme.");
$faq[] = array("OK, j'ai ouvert la Messagerie Instantanée. Et maintenant je fais quoi ?", "De Prillian vous pouvez faire plusieurs choses. Vous pouvez voir une liste des membres qui sont en ligne en ce moment. Vous pouvez également leur envoyer un message instantané. Vous pouvez aussi envoyer des messages aux autres membres, en recevoir, voir les messages que vous avez reçu ou envoyé dans le passé, accéder au panneau de contrôle de la liste de contacts, et, si l'administrateur l'autorise, accéder aux préférences de votre messagerie.");
$faq[] = array("Comment puis-je recevoir des messages ?", "La messagerie vérifie automatiquement et périodiquement s'il y a des messages. Pour plus d'informations, lisez la section suivante de cette FAQ");
//
$faq[] = array("--", "Utiliser la Messagerie Instantanée");
//
$faq[] = array('Je vois beaucoup d\'images dans cette fenêtre. Qu\'est ce qu\'elle veulent dire ?", "Les contrôles de Prillian pour accéder aux options de messageries. Voici en dessous une liste des images que vous pouvez voir dans la messagerie et ceux qu\'elles représentent. Gardez à l\'esprit que ces images peuvent changer si vous altérez le thème utilisé par ' . $progname . '. Vous pouvez également apprendre ce que représente une image en passant dessus avec le curseur de votre souris (dans certains navigateurs seulement). Il y a aussi un set de liens-textes qui ont des fonctions similaires à ces images, en fonction de vos préférences.
<br /><br />
<table border="1" width="100%" cellpadding="5" cellspacing="0"><tr><td width="15%" align="center">
<img src="' . $images['prill_buddies'] . '">
</td><td class="gen">
' . $lang['Alt_Contact_Man'] . '
</td><td class="gen">
Ceci ouvre le panneau \"Gestion des contacts\" dans une autre fenêtre de votre navigateur.
</td></tr><tr><td align="center">
<img src="' . $images['prill_closewin'] . '">
</td><td class="gen">' . $lang['Alt_Close_Windows'] . '
</td><td class="gen">
Les fenêtres-filles peuvent inclure les  fenêtres des messages lus ouverts,des messages envoyés et des messages enregistrés.
</td></tr><tr><td align="center">
<img src="' . $images['prill_home'] . '">
</td><td class="gen">
' . $lang['Alt_Home'] . '
</td><td class="gen">
Ouvre l\'index du forum de ce site dans une autre fenêtre du navigateur .
</td></tr><tr><td align="center">
<img src="' . $images['prill_prefs'] . '">
</td><td class="gen">
' . $lang['Alt_Prefs'] . '
</td><td class="gen">
Change les options qui influe sur la manière dont la messagerie instantanée agit. L\'administrateur du forum peut passer outre à ces options, dans ce cas cette image n\'apparaîtra pas.
</td></tr><tr><td align="center">
<img src="' . $images['prill_message'] . '">
</td><td class="gen">
' . $lang['Send_Message'] . '
</td><td class="gen">
Cliquez ici pour ouvrir la fenêtre \"Envoyer un message\".
</td></tr><tr><td align="center">
<img src="' . $images['prill_refresh'] . '">
</td><td class="gen">
' . $lang['Check_IMs'] . '
</td><td class="gen">
Recharge ou rafraîchit la messagerie.  Cela mettra à jour les nouveaux messages et la liste des utilisateurs connectés.
</td></tr><tr><td align="center">
<img src="' . $images['prill_logout'] . '">
</td><td class="gen">
' . $lang['Alt_Logout'] . '
</td><td class="gen">
Cela fermera à la fois Prillian et  les fenêtres-filles.
</td></tr><tr><td align="center">
<img src="' . $images['prill_log'] . '">
</td><td class="gen">
' . $lang['Alt_Message_Log'] . '
</td><td class="gen">
Voir une liste des messages que vous avez envoyé ou reçu. Vous pouvez aussi voir les messages individuels enregistrés.
</td></tr><tr><td align="center">
<img src="' . $images['prill_offsite'] . '">
</td><td class="gen">
Utilisateurs \"Hors-Forum\"
</td><td class="gen">
Cet utilisateur est d\'un autre site/forum. Dans certains navigateurs, en passant le curseur de votre souris sur l\'image vous pouvez apercevoir le site d\'origine de l\'utilisateur.
</td></tr><tr><td align="center">
<img src="' . $images['prill_onsite'] . '">
</td><td class="gen">
Utilisateur \"Sur Le Forum\"
</td><td class="gen">
Cet utilisateur est membre du forum comme vous.
</td></tr><tr><td align="center">
<img src="' . $images['prill_help'] . '">
</td><td class="gen">
Aide
</td><td class="gen">
Accéder à cette page de FAQ.
</td></tr></table><br /><br />
Pour plus d\'informations sur les utilisateurs \"Hors-Forum et \"Sur Le Forum\", voir la section de cette FAQ intitulée \"Messagerie Site à Site\"');
//
$faq[] = array("Quelles sont les autres options de la Messagerie Instantanée ?", "En fonction de la manière dont l'administrateur a configuré Prillian, vous pouvez voir une série de blocs d'informations sur les utilisateurs sur le forum ou utilisant la messagerie instantanée. Cela inclue le nombre de membres connectés, d'invisibles et d'invités.
<br />
<br />Il y aura probablement un ou deux blocs de noms d'utilisateurs près des icônes des Hors-Forum, Sur Le Forum et  Envoyer un message. Il y a des membres qui sont actuellement connectés. Si un nom d'utilisateur Sur Le Forum est affiché <em>comme ceci</em> alors cet utilisateur utilise aussi la messagerie instantanée en ce moment. Si les modérateurs ou les administrateurs du site sont listés, leurs noms auront des couleurs différentes pour les distinguer des simples utilisateurs. Si vous cliquez sur l'icône \"Envoyer un Message\" près du nom d'un utilisateur, la fenêtre \"Envoyer un message\" s'ouvrira  avec le nom de cet utilisateur dans le champ \"Nom d'utilisateur\". Vous pouvez cliquer sur le nom d'un utilisateur pour voir son profil du forum.");
$faq[] = array("Comment puis-je recevoir de nouveaux messages ?", "Régulièrement, Prillian se rechargera automatiquement pour mettre à jour les nouveaux messages et la liste des utilisateurs en ligne. Quand cela arrivera, Prillian après s'être complètement rechargé peut afficher vos messages de deux manières différentes en fonction de vos préférences utilisateur et des options Javascripts de votre navigateur. Prillian peut automatiquement ouvrir les nouveaux messages dans de nouvelles petites fenêtres \"Lire le message\". Il peut aussi afficher les nouveaux messages et les messages non-lus dans la fenêtre Prillian elle-même. Si les messages s'affichent dans Prillian, vous verrez une version réduite du sujets des messages et du nom de l'expéditeur. Cliquez sur le sujet du message pour ouvrir un message dans une nouvelle fenêtre \"Lire le message\".
<br />
<br />En fonction de vos préférences utilisateur, Prillian peut vérifier les nouveaux messages instantanés seulement ou pour les messages instantanés et les messages privés. Si, pour une raison quelconque, Prillian échoue à se recharger automatiquement, vous pouvez cliquer sur le bouton ou le lien \"Vérifier les messages instantanés\" pour recharger Prillian manuellement.");
$faq[] = array("Comment puis-je effacer les anciens messages ?", "En fonction des préférences utilisateurs, les messages instantanés peuvent être automatiquement effacés une fois lus et au rechargement de Prillian. Vous pouvez également effacer les nouveaux et non lus messages privés et instantanés de la liste dans la messagerie instantanée. Les messages privés que vous avez déjà lu ne peuvent pas être effacés à partir de la messagerie instantanée (à moins qu'il ne soient listés dans la messagerie instantanée et effacés avant le rafraîchissement ).");

$faq[] = array("--", "Options et Préférences des Utilisateurs");
$faq[] = array("Comment puis-je changer mes options ?", "Toutes vos options sont stockées dans la base de donnés. Pour les modifier cliquez le lien ou l'icône <u>Préférences</u>  (Montrés en général en haut ou en bas de Prillian but ça peut ne pas être le cas). Cela vous autorise à changer toutes vos options");
$faq[] = array("J'ai cliqué sur le lien, mais il m'affiche quelque chose à propos de la priorité administrateur. Ca veut dire quoi ?", "Les administrateurs du forum ont la possibilité de passer outre aux préférences utilisateur. Quand cette option est activée, les préférences utilisateur ne peuvent être changées excepté par l'administrateur du forum. Vous ne pourrez pas accéder à l'éditeur des préférences pour modifier vos options de messagerie.");
$faq[] = array("Il y a beaucoup d'options ici. Qu'est ce qu'elles veulent dire ?", "Beaucoup des préférences utilisateur s'expliquent par elles-même. Ci-dessous voici un sommaire de quelques options qui nécessitent plus de détails.
<br />
<br /><table border=\"1\" width=\"100%\" cellpadding=\"5\" cellspacing=\"0\"><tr><td class=\"gen\" width=\"25%\">Localisation du fichier son</td><td class=\"gen\">Les options du fichier son vous autorise à jouer un nouveau son quand vous recevez des nouveaux messages. Vous pouvez choisir de jouer soit le son par défaut fourni par le forum, soit un son de votre propre PC. Cliquez sur le bouton \"Parcourir...\" pour spécifier le chemin d'un fichier son sur votre PC. La localisation du fichier son sera notée dans la base de données du forum. Si vous décidez de déplacer le fichier son, n'oubliez pas de mettre à jour les options.</td></tr><tr><td class=\"gen\">Lister ces utilisateurs dans la fenêtre principale</td><td class=\"gen\">Ces options vous autorise à changer les utilisateurs listés dans Prillian. Vous pouvez choisir de lister tous les utilisateurs sur les forums, tous les utilisateurs sur la messagerie, seulement les amis sur les forums, ou seulement les amis sur la messagerie.</td></tr><tr><td class=\"gen\">Choisir une méthode pour afficher les utilisateurs connectés sur d'autres forums</td><td class=\"gen\">Ces options vous autorise à définir comment les utilisateurs Hors-Forum sont affichés sur Prilllian.Vous pouvez choisir de ne pas les afficher du tout, de les afficher dans un tableau séparé des utilisateurs Sur le Forum, ou mélangés avec eux. Rappelez-vous, les utilisateurs Hors-Forum sont toujours des utilisateurs sur Prillian.</td></tr></table>");
$faq[] = array("Points importants à connaitre à propos des options.", "Il y a des choses importantes qu'il faut que vous sachiez à propos des préférences utilisateurs et des options. D'abord, faites attention quand vous changez \"Activer les options\". Désactiver ces options vous empêchera d'utiliser une partie de la messagerie. Deuxièmement, si vous voulez qu'un son soit joué quand vous recevez des nouveaux messages, il est mieux que ce soit un son de votre propre PC. Le son se chargera (et donc se jouera) plus rapidement que si la messagerie doit le télécharger du forum.");

$faq[] = array("--", "Problèmes de Postage");
$faq[] = array("Comment puis-je envoyer des messages ?", "C'est simple. Cliquez sur l'icône ou le lien \"Envoyer un message\" (soit près du nom de l'utilisateur soit dans les options) pour ouvrir la fenêtre \"Envoyer un message\". Là, vous aurez la possibilité de taper un message et de l'envoyer à un autre utilisateur. Si vous désirez envoyer un message à un autre utilisateur qu'à celui pour lequel vous aviez cliqué sur l'icône ou le lien \"Envoyer un message\", vous devez changer le nom dans le champ du nom d'utilisateur.
<br />SVP, veuillez noter que vous ne pouvez envoyer un message à un utilisateur Hors-Forum sur un forum particulier qu'en cliquant sur l'icône ou le lien près du nom d'un utilisateur Hors-Forum du même site. De la même manière, vous ne pouvez envoyer un message à un utilisateur Sur Le Forum sur un forum particulier qu'en cliquant sur l'icône ou le lien près du nom d'un utilisateur Sur Le Forum. Répondre à un message vous autorise à envoyer un message du même type également.");
$faq[] = array("Je suis dans la fenêtre \"Envoyer un message\". C'est quoi toutes ces options ?", "La fenêtre \"Envoyer un message\" a beaucoup d'options. Près du nom d'utilisateur, il y a deux boutons qui vous autorise à trouver rapidement un utilisateur ou un ami à qui vous pouvez envoyer un message. Le champ du sujet est optionnel. Il y a un choix de BBCode et de police similaire à celui de phpBB, ainsi que des options pour les désactiver dans les messages. Il y a également une liste défilante de Smileys. Enfin, il y a une option à cocher \"Sauvegarder le message\", qui sauvegardera une copy du message dans votre messagerie privée quand il sera envoyé avec succès.
<br />
<br />Quelques options peuvent être désactivées quand vous envoyez un message à un utilisateur Hors-Forum.");
$faq[] = array("Puis-je utiliser les BBcodes, les Smileys, le HTML, les signatures et les images dans les messages instantanés ?", "Vous le pouvez, si l'administrateur l'autorise. Les réglages pour ces options sont les même que celles sur le forum (en général, si vous pouvez utiliser les BBcodes sur le forum, vous pouvez les utiliser dans les messages instantanés.)");

$faq[] = array("--", "Lecture des Messages");
$faq[] = array("Je lis un message. Que veulent dire quelques-unes de ces options ?", "Il y a deux options dans la fenêtre \"Envoyer un message\" qui ont besoin d'être expliqués : Les boutons \"Sauvegarder et fermer\" et \"Sauvegarder et répondre\". Cliquez sur un de ces deux boutons sauvegardera une copie du message reçu dans votre messagerie privée. C'est utile si la suppression automatique des messages lus est activée. Les parties \"Fermer\" et \"Répondre\" de ces boutons sont facile à comprendre.
<br />
<br />En fonction de la configuration du forum, il peut aussi y avoir un champ \"Réponse rapide\" dans cette fenêtre.");
$faq[] = array("Je continue à recevoir des messages non désirés !", "Prillian comprend un système pour ignorer. Vous pouvez ignorer l'utilisateur envoyant les messages incriminés ou contacter l'administrateur du forum, qui peut interdire à l'utilisateur l'usage des système de  messagerie privée et instantanée");

$faq[] = array("--", "Messagerie Site à Site");
$faq[] = array("C'est quoi la messagerie Site à Site ?", "La messagerie Site à Site est un système spécial que Prillian utilise pour autoriser les utilisateurs d'autres forums à communiquer entre eux. Tous les utilisateurs Hors-Forum listés dans Prillian sont en fait des gens utilisant une messagerie similaire sur un autre forum. Ils ont également la possibilité de vous envoyer un message instantané via la messagerie Site à Site. Vous pouvez de la même manière leur envoyer un message.");
$faq[] = array("Ca à l'air bien, mais ça ne m'intéresse pas vraiment.", "Vous pouvez désactiver la messagerie Site à Site dans vos préférences utilisateur.");
$faq[] = array("Comment envoyer un message à quelqu'un sur un autre site ?", "Cliquez sur l'icône ou le lien \"Envoyer un message\" près de leur nom dans Prillian. Quand la fenêtre \"Envoyer un message\" s'ouvre, tapez simplement ! Quelques options peuvent être désactivées dans les messages Site à Site. Ainsi, même si vous pouvez voir les utilisateurs connectés d'autres sites, vous ne pourrez pas leur envoyer de messages. Vous pouvez seulement envoyer des messages si ce site/forum à ajouter ce forum à sa base de données \"Site à Site\".");
$faq[] = array("Pourquoi ces options sont-elles désactivées ?", "Le système de messagerie Site à Site est encore en développement. En fait, tout le programme de messagerie est encore en développement");

$faq[] = array("--", "Problèmes avec Prillian");
$faq[] = array("Qui a écrit ce programme de messagerie instantanée ?", "Ce programme (dans sa forme non-modifiée) est produit, fourni et copyright de et par <a href=\"http://darkmods.sourceforge.net/\" target=\"_blank\">Thoul</a>. Il est basé et inclus du code de programmation du forum phpBB, qui (dans sa forme non-modifiée) est produit, fourni et copyright du et par le <a href=\"http://www.phpbb.com/\" target=\"_blank\">groupe phpBB</a>.
<br />Les deux programmes sont sous la licence générale publique GNU et peuvent être distribués gratuitement; voir les liens pour plus de détails.");
$faq[] = array("Pourquoi telle option n'est pas disponible ?", "Ce programme a été écrit et est sous licence du groupe phpBB (dans le cas du programme de forum) et Thoul ( dans le cas de la messagerie instantanée). Si vous pensez qu'une option mériterait d'être ajoutée au programme Prillian alors visitez le site web darkmods.sourceforge.net et vérifiez qu'elle n'ait pas déjà été soumise sur les forums. Si ce n'est pas le cas, postez une demande d'option dans les forums ou sur Sourceforge.");
$faq[] = array("Qui dois-je contacter en cas d'abus et/ou d'utilisation illégale de Prillian ?", "Vous devriez contacter l'administrateur du forum. Si vous ne pouvez trouvez qui il est, essayez alors de joindre un des modérateurs du forum et demandez-lui qui contacter pour un abus avec Prillian. Si vous n'avez toujours pas de réponse, contactez alors, le propriétaire du nom de domaine ( trouvez-le grace à un recherche Whois), et si le forum se trouve sur un hébergeur gratuit (en général yahoo, free.fr, f2s.com, etc.), la direction ou le service clientèle. Notez que Thoul n'a absolument aucun contrôle et ne peut en aucun cas être tenu pour responsable sur la manière dont le forum incriminé et Prillian sont gérés.
<br />Il est totalement inutile de contacter Thoul à propos d'actions illégales et abusives avec Prillian, si cela n'est pas directement lié au site web darkmods.sourceforge.net ou à un problème technique avec Prillian lui-même. Si vous envoyez un email à Thoul en relation avec des problèmes non-liés avec ses aspects techniques, n'espérez aucune réponse de sa part.");



?>