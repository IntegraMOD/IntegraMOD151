<?php
/***************************************************************************
 *						lang_extend_meta_tags.php [English]
 *						-----------------------------------------------
 *	begin				: 12/10/2004
 *	copyright		: paperclips
 *	email				: jm.lachance@gmail.com
 *
 *	version				: 1.0.0 - 11/10/2004
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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
$lang['Click_return_admin_meta_tags'] = 'Cliquez %sici%s pour retourner au menu d\'Administration des Meta Tags';
$lang['Lang_extend_meta_tags'] = 'Meta Tags +';
$lang['Meta_tags_title'] = 'Meta Tags +';
$lang['Meta_tags_title_explain'] = 'Bienvenue sur la gestion des meta tags. Ces champs vous permettent de donner aux moteurs de recherche une description plus complète de votre site web.<br/ >Vous devriez remplir ces champs avec soin.<br/ >En plus du référencement, ces champs permettent de definir certaines options comme les redirections automatiques.';

$lang['Meta_parameters'] = 'Liste complète des meta tags';
$lang['Meta_parameters_explain'] = 'Résumé des principaux meta tags, avec la synthaxe : <<b>meta name="xxx" content="xxx"</b>>';
$lang['Meta_keywords']  = 'META Keywords';
$lang['Meta_keywords_explain']  = '- Indique aux moteurs de recherche des mots-clefs de votre site.<br />- Nombre maximum de charactères: 1000 ou 100 mots-clefs.<br/ >- Lorsque vous comptez le nombre de caractères, pensez à tenir compte des <a href="accent.htm">charactères accentués</a> une fois que ceux-ci sont codés en HTML. Par exemple la lettre "à", codée &amp&agrave; en HTML, compte pour 8 charactères.<br />- Vouc ne devriez pas répéter plusieurs fois les mêmes mots-clefs (cela peut être pénalisant sur certains moteurs de recherche).<br />- Les mots-clefs sont séparés à choix par une virgule, un espace ou une virgule et un espace.';
$lang['Meta_description'] = 'META Description';
$lang['Meta_description_explain'] = '- Description de votre site.<br />- Nombre maximum de charactères: 200<br />- Evitez les accents, refusés par certains moteurs de recherche.';
$lang['Meta_author']  = 'META Author';
$lang['Meta_author_explain']  = '- Identifie l\'auteur du site.<br/ >- En général, prénom suivi du nom en majuscules.<br/ >- Vous pouvez mettre plusieurs auteurs séparés par des virgules.';
$lang['Meta_identifier_url']  = 'META Identifier-url';
$lang['Meta_identifier_url_explain']  = ' - Identification de l\'URL.<br />- Entrez l\'URL de votre page principale.<br />- Vous devez ne spécifier qu\'une seule valeur.';
$lang['Meta_reply_to']  = 'META Reply-to';
$lang['Meta_reply_to_explain']  = ' - Permet de spécifier l\'adresse email du webmaster.<br/ >- Une seule adresse est préférable.';
$lang['Meta_revisit_after']  = 'META Revisit-after';
$lang['Meta_revisit_after_explain']  = ' - Spécifie la fréquence à laquelle le spider (robot du moteur de recherche) revient visiter votre site. - "15 days" ou "30 days" sont les meilleures valeurs.';
$lang['Meta_category']  = 'META Category';
$lang['Meta_category_explain']  = ' - Catégorie de votre site. Utilisé seulement par les moteurs de recherche qui classent les sites par catégorie.';
$lang['Meta_generator']  = 'META Generator';
$lang['Meta_generator_explain']  = '  - Typiquement le nom et la version de l\'outil ayant permis la création du site.<br/ >- Utilisé par les vendeurs pour tester la popularité des programmes. <br / >- Mêmes champs que pour publisher.';
$lang['Meta_copyright']  = 'META Copyright';
$lang['Meta_copyright_explain']  = '- Typiquement une information sur le copyright.<br /> - Vous pouvez mentionner ici copyright, marques déposées, patentes, etc.';
$lang['Meta_robots']  = 'META Robots';
$lang['Meta_robots_explain']  = '- Contrôle des robots.<br/ >- all = indexation du site complet (valeur par défaut)<br />- none = aucune indexation<br />- index = cette page est indexée<br />- noindex = cette page n\'est pas indexée, mais le robot continue de parcourir le site<br />- follow = Le robot suit les liens de cette page pour les indéxer.<br />- nofollow = le robot ne suit pas les liens sur cette page.';
$lang['Meta_distribution']  = 'META Distribution';
$lang['Meta_distribution_explain']  = '- There are three classifications of distribution of your web content:<br/ >- Global (the entire web)<br/ >- Local (reserved for the local IP block of your site)<br/ >- IU (Internal Use, not for public distribution)';
$lang['Meta_date_creation']  = 'META Date-creation-yyyymmdd';
$lang['Meta_date_creation_explain']  = '- Date de création du site';
$lang['Meta_date_revision']  = 'META Date-revision-yyyymmdd';
$lang['Meta_date_revision_explain']  = '- Date de la dernière mise à jour';
$lang['Meta_day'] = 'Jour :';
$lang['Meta_month'] = 'Mois :';
$lang['Meta_year'] = 'Année :';

$lang['Meta_http_equiv_parameters'] = 'Autres tags';
$lang['Meta_http_equiv_parameters_explain'] = ' La synthaxe de ces champs est : <<b>meta http-equiv="xxx" CONTENT="xxx"</b>>. Si vous ne voulez pas les utiliser, laissez-les en blanc.';
$lang['Meta_refresh']  = 'META Refresh 1';
$lang['Meta_refresh_explain']  = '- Nombre de secondes avant que le navigateur ne recharge la page.';
$lang['Meta_redirect_url']  = 'META Refresh 2';
$lang['Meta_redirect_url_explain']  = '- Nombre de secondes avant que le navigateur ne continue sur la page suivante, pour laquelle l\'URL est spécifié.';
$lang['Meta_redirect_url_time']  = 'Délai (sec):';
$lang['Meta_redirect_url_adress']  = 'Adresse (URL):';
$lang['Meta_pragma']  = 'META Pragma';
$lang['Meta_pragma_explain']  = '- Empêche que la page ne soit mise en cache dans le navigateur.<br/ >- Pour utiliser ce champ, entrez <i>no-cache</i>.';
$lang['Meta_language']  = 'META Language';
$lang['Meta_language_explain']  = '- fr : français<br/ >- en : anglais ou américain<br/ >- de : hollandais<br/ >- es : espagnol<br/ >- it : italien<br/ >- pt : portugais<br/ >- Si votre site est en plusieurs langues, il est recommandé de ne pas utiliser ce champ.';
}
?>