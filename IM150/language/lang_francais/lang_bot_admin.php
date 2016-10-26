<?php

/***************************************************************************
*                             lang_bot_admin.php
*                            --------------------
*   begin                : Thursday, June 03, 2004
*   copyright            : (C) 2004 Adam Marcus
*   email                : adam_marcus@btinternet.com
*
*
***************************************************************************/

/***************************************************************************
*
*   This program is free software; you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation; either version 2 of the License, or
*   (at your option) any later version.
*
***************************************************************************/

$lang['Manage_Bots'] = "Gestion des robots";
$lang['Bot_Explain'] = "Les robots sont des agents automatisés utilisés généralement pour indexer les informations présentes sur internet. Très peu de ces robots supportent les sessions et donc ne peuvent indexer votre site correctement. Ici, vous pouvez définir comment assigner une session à ces robots pour résoudre ce problème.";

$lang['Pending_Bots'] = "Robots en attente";
$lang['Pending_Explain'] = "La liste ci-dessous représente les utilisateurs qui satisfont à certains de vos critères, mais pas tous. En d'autres termes, l'utilisateur correspond soit à l'agent, soit à l'adresse IP. L'information non concordante est affichée juste à côté du nom du robot. Vous pouvez ajouter cette info, qui apparaitra alors dans les critères de reconnaissance du robot ou l'ignorer.";

$lang['Bot_Ip_Or_Agent'] = "IP ou agent du robot";
$lang['Bot_Name'] = "Nom du robot";
$lang['Bots'] = "Robots";
$lang['Agent_Match'] = "Correspondance agent";
$lang['Bot_Ip'] = "IP du robot";

$lang['Last_Visit'] = "Dernière visite";
$lang['Visits'] = "Visites";
$lang['Pages'] = "Pages";
$lang['Never'] = "Jamais";
$lang['Options'] = "Options";
$lang['Result'] = "Résultat";
$lang['Ok'] = "OK";
$lang['Mark'] = "Marquer";
$lang['Ignore'] = "Ignorer";
$lang['Add'] = "Ajouter";

$lang['Submit'] = "Valider";
$lang['Delete'] = "Supprimer";
$lang['Reset'] = "Annuler";
$lang['Edit'] = "Modifier";

$lang['ip'] = "IP";
$lang['agent'] = "agent";

$lang['No_Bots'] = "Désolé, il n'y a actuellement aucun robot dans la base de données.";
$lang['No_Pending_Bots'] = "Désolé, il n'y a actuellement aucun robot en attente dans la base de données.";
$lang['Bot_Added_Or_Modified'] = "Information sur le robot ajoutée/ignorée avec succès.";
$lang['Bot_Result_Explain'] = "Ici, vous pouvez voir le résultat de votre requête.";
$lang['Bot_Settings_Changed'] = "Les paramètres des robots ont été modifiés/ajoutés avec succès.";

$lang['Bot_Edit_Or_Add_Explain'] = "Ici vous pouvez soit ajouter soit modifier une entrée existante sur un robot. Vous devez pouvoir fournir soit un utilisateur agent correspondant soit une plage d'IP à utiliser.";
$lang['Bot_Name_Explain'] = "Utilisé pour votre usage seulement.";
$lang['Bot_Agent_Explain'] = "Un utilisateur agent correspondant. Les correspondances partielles sont autorisées. Séparez les agents avec un '|'.";
$lang['Bot_Ip_Explain'] = "Les correspondances partielles sont autorisées. Séparez les adresses IP avec un '|'.";

$lang['Error_No_Agent_Or_Ip'] = "Vous n'avez pas fourni un agent utilisateur ou une adresse IP.";
$lang['Error_No_Bot_Name'] = "Vous n'avez pas fourni le nom d'un robot.";

?>