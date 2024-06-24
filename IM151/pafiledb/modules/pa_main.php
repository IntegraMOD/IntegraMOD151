<?php
/*
  paFileDB 3.0
  ©2001/2002 PHP Arena
  Written by Todd
  todd@phparena.net
  http://www.phparena.net
  Keep all copyright links on the script visible
  Sub category counting bug fix by Kron
  Please read the license included with this script for more information.
*/

class pafiledb_main extends pafiledb_public
{
	function main($action)
	{
		global $pafiledb_template, $lang, $board_config, $phpEx, $pafiledb_config, $debug, $phpbb_root_path;
		//===================================================
		// assign var for naviagation
		//===================================================
/*		include_once($phpbb_root_path . 'pafiledb/includes/functions_menu.php');
		$menu = new layers_menu();
		$menu->set_table_name(PA_CATEGORY_TABLE);
		$table_fields = array('id' => 'cat_id',
							  'parent_id' => 'cat_parent',
							  'text' => 'cat_name',
							  'link' => '',
							  'title' => 'cat_name', 
							  'icon' => '',
							  'target' => '',
							  'orderfield' => 'cat_order',
							  'expanded' => '');

		$menu->set_table_fields($table_fields);
		$menu->scan_table_for_menu('menu');
		$menu->new_tree_menu('menu');
		
		$menu_output = implode('', file($phpbb_root_path . 'pafiledb/lib/layersmenu-browser_detection.js'));
		$menu_output .= '<script language="JavaScript" type="text/javascript" src="' . $phpbb_root_path . 'pafiledb/lib/layersmenu-library.js"></script>
									   <script language="JavaScript" type="text/javascript" src="' . $phpbb_root_path . 'pafiledb/lib/layersmenu.js"></script>
									   <script language="JavaScript" type="text/javascript" src="' . $phpbb_root_path . 'pafiledb/lib/layerstreemenu-cookies.js"></script>';
		$menu_output .= $menu->get_tree_menu('menu');*/
		
		$pafiledb_template->assign_vars(array(
			'L_INDEX' => sprintf($lang['Forum_Index'], $board_config['sitename']),

			'U_INDEX' => append_sid('index.'.$phpEx),
			'U_DOWNLOAD' => append_sid('dload.'.$phpEx),

			'DOWNLOAD' => $pafiledb_config['settings_dbname'],
			'TREE' => $menu_output)
		); 

		//===================================================
		// Show the Category for the download database index
		//===================================================
		$this->category_display();

		$this->display($lang['Download'], 'pa_main_body.tpl');
	}
}

?>
