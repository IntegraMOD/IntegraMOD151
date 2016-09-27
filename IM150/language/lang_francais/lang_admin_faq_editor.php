<?php
/***************************************************************************
 *                       lang_admin_faq_editor.php [English]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/


$lang['faq_editor'] = 'Editer une langue';
$lang['faq_editor_explain'] = 'Ce module vous autorise à éditer et classer vos FAQ pour l\'Attachment Mod, les BBCodes et le forum. Vous <u>ne devez pas</u> enlever ou modifier la section nommée <b>phpBB 2</b>.';

$lang['faq_select_language'] = 'Choisissez la langue du fichier que vous voulez éditer';
$lang['faq_retrieve'] = 'Récupérer le fichier';

$lang['faq_block_delete'] = 'Etes-vous sûr de vouloir effacer ce bloc?';
$lang['faq_quest_delete'] = 'Etes-vous sûr de vouloir effacer cette question (et sa réponse)?';

$lang['faq_quest_edit'] = 'Editer la question et la réponse';
$lang['faq_quest_create'] = 'Créer une nouvelle question/réponse';

$lang['faq_quest_edit_explain'] = 'Editer la question et la réponse. Changez le bloc si vous le désirez.';
$lang['faq_quest_create_explain'] = 'Tapez les nouvelles questions et réponses, et pressez Envoyer.';

$lang['faq_block'] = 'Bloc';
$lang['faq_quest'] = 'Question';
$lang['faq_answer'] = 'Réponse';

$lang['faq_block_name'] = 'Nom du bloc';
$lang['faq_block_rename'] = 'Renommer un bloc';
$lang['faq_block_rename_explain'] = 'Changer le nom d\'un bloc dans le fichier';

$lang['faq_block_add'] = 'Ajouter le bloc';
$lang['faq_quest_add'] = 'Ajouter la question';

$lang['faq_no_quests'] = 'Aucune question dans ce bloc. Cela empêchera tout bloc après celui-là d\'être affiché. Effacez le bloc ou ajoutez une ou plusieurs questions.';
$lang['faq_no_blocks'] = 'Aucun bloc défini. Ajoutez un nouveau bloc en tapant un nom ci-dessous.';

$lang['faq_write_file'] = 'Le fichier langue n\'est pas inscriptible !';
$lang['faq_write_file_explain'] = 'Vous devez rendre le fichier langue dans language/lang_english/ or équivalent <i>inscriptible</i> pour utiliser ce panneau de contrôle. Sous UNIX, cela veut dire <code>chmodder 666</code> le fichier. Beaucoup de clients FTP peuvent faire ça par le menu Propriétés d\'un fichier, sinon vous pouvez utiliser telnet ou SSH.';

?>