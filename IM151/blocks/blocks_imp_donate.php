<?php
// -------------------------------------------------------------
//
// FILENAME  : blocks_imp_donate.php
// STARTED   : June 17, 2005
// COPYRIGHT : © 2005 IntegraMOD Group
// WWW       : http://www.integramod.com/
// LICENCE   : http://opensource.org/licenses/gpl-license.php
//
// -------------------------------------------------------------

if (!defined('IN_PHPBB')) {
	exit;
}

if(!function_exists('imp_donate_block_func'))
{
	function imp_donate_block_func()
   {
		global $template, $portal_config, $table_prefix, $phpEx, $db, $lang, $board_config, $theme;

      $sql = "SELECT a.*, u.* FROM ".$table_prefix."account_hist a, " . $table_prefix."users u WHERE a.status = 'Completed' AND u.user_id = a.user_id ORDER BY a.lw_date DESC LIMIT 0," . $portal_config['md_num_new_donations'];
      if (!($result = $db->sql_query($sql)))
      {
         message_die(GENERAL_ERROR, 'Could not query database for the newest donations');
      }

      $i = 1;
      while ($donations = $db->sql_fetchrow($result)) 
      {
         $template->assign_block_vars('dntns', array(
            'NUMBERING' => strval($i++),
            'DONATE_AMNT' => $donations['lw_money'],
            'L_DONATED_BY' => $lang['Donated_by'],
            'DONATE_LINK' => './lwdonate.'.$phpEx,
            'DONATED_BY' => $donations ['username'],
            'L_DONATE_LINK' => $lang['Donate_Funds'],
            'L_AMOUNT' => $lang['Amount']
         ));
      }
      $template->assign_vars(array(
         'L_NEW_DONATIONS' => $lang['New_donations'],
         'DONATE_LINK' => './lwdonate.'.$phpEx,
         'L_DONATE_LINK' => $lang['Donate_Funds'],
         )
      );
   }
}

imp_donate_block_func();
?>