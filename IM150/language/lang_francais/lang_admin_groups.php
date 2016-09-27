<?php
/***************************************************************************
 *                       lang_admin_groups.php [English]
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

$lang['Group_not_exist'] = 'Ce groupe d\'utilisateurs n\'existe pas';
// addded to Auto group mod
$lang['group_count'] = 'Nombre de messages obligatoires';
$lang['group_count_max'] = 'Nombre de messages maximum';
$lang['group_count_updated'] = '%d membre(s) ont été retiré, %d membres ont été ajouté à ce groupe';
$lang['Group_count_enable'] = 'Utilisateurs automatiquement ajoutés après avoir posté';
$lang['Group_count_update'] = 'Ajouter/mettre à jour les nouveaux utilisateurs';
$lang['Group_count_delete'] = 'Effacer/mettre à jour les anciens utilisateurs';
$lang['User_allow_ag'] = "Activer l\'auto-ajout à un groupe";
$lang['group_count_explain'] = 'Quand les utilisateurs ont posté plus de messages que ce nombre <i>(dans n\'importe quel forum)</i>, ils sont automatiquement ajoutés à ce groupe d\'utilisateurs.<br/> Cela s\'applique uniquement si "'.$lang['Group_count_enable'].'" est activé.';
?>