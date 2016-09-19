<?php
/***************************************************************************
*                            $RCSfile: lang_admin_topic_shadow.php,v $
*                            -------------------
*   copyright            : (C) 2002-2003 Nivisec.com
*   email                : support@nivisec.com
*
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

/* If you are translating this, please email a copy to me! */
/* admin@nivisec.com is fine to use */

/* General */
$lang['Del_Before_Date'] = 'Les sujets traceurs avant le %s ont été supprimés<br />'; // %s = insertion of date
$lang['Deleted_Topic'] = 'Sujet traceur %s supprimé<br />'; // %s = topic name
$lang['Affected_Rows'] = '%d enregistrements concernés<br />'; // %d = affected rows (not avail with all databases!)
$lang['Delete_From_Date'] = 'Tous les sujets traceurs créés avant la date saisie seront supprimés.';
$lang['Delete_Before_Date_Button'] = 'Supprime tout avant "Date"';
$lang['No_Shadow_Topics'] = 'Aucun sujet traceur n\'a été trouvé.';
$lang['Topic_Shadow'] = 'Sujet traceur';
$lang['TS_Desc'] = 'Autorise la suppression des sujets traceurs sans détruire les messages. Les sujets traceurs sont créés quand vous déplacez un message vers un autre forum et que vous choisissez de laisser un lien vers ce nouveau message dans le forum original.';
$lang['Month'] = 'Mois';
$lang['Day'] = 'Jour';
$lang['Year'] = 'Année';
$lang['Clear'] = 'Annule';
$lang['Resync_Ran_On'] = 'Re-synchronisation effectuée sur %s<br />'; // %s = insertion of forum name
$lang['All_Forums'] = 'Tous les forums';
$lang['Version'] = 'Version';

$lang['Title'] = 'Titre';
$lang['Moved_To'] = 'Déplacé vers';
$lang['Moved_From'] = 'Déplacé depuis';
$lang['Delete'] = 'Supprime';

/* Modes */
$lang['topic_time'] = 'Heure du sujet';
$lang['topic_title'] = 'Titre du sujet';

/* Errors */
$lang['Error_Month'] = 'Le mois doit être compris entre 1 et 12';
$lang['Error_Day'] = 'Le jour doit être compris entre 1 et 31';
$lang['Error_Year'] = 'L\'année doit être comprise entre 1970 et 2038';
$lang['Error_Topics_Table'] = 'Erreur d\'accès la table des sujets';

//Special Cases, Do not change for another language
$lang['ASC'] = $lang['Sort_Ascending'];
$lang['DESC'] = $lang['Sort_Descending'];
$lang['Nivisec_Com'] = 'Nivisec.com';



?>