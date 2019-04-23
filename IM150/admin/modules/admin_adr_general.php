<?php
/***************************************************************************
 *                              admin_adr_general.php
 *                            ------------------
 *   begin                : 01/02/2004
 *
 *
 ***************************************************************************/
if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Adr_settings']['Adr_misc_settings'] = "$filename?mode=misc";
	$module['Adr_Items']['Adr_items_settings'] = "$filename?mode=items";
	$module['Adr_settings']['Adr_skills_settings'] = "$filename?mode=skills";
	$module['ADR-Recipes']['Adr_temple_settings'] = "$filename?mode=temple";
	$module['ADR-Recipes']['Adr_beggar_settings'] = "$filename?mode=beggar";
	$module['ADR-Recipes']['Adr_lake_settings'] = "$filename?mode=lake";
	$module['Adr_settings']['Adr_Jail'] = "$filename?mode=cell";
	$module['Adr_vault']['Adr_vault_settings'] = "$filename?mode=vault";
	$module['Adr_battle']['Adr_battle_settings'] = "$filename?mode=battle";
	$module['Adr_settings']['Adr_display_settings'] = "$filename?mode=display";
  $module['Adr_settings']['Adr_guilds'] = "$filename?mode=guilds";
	return;
}
