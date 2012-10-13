<?php
/***************************************************************************
      Admin FAQ Editor 1.0.0 for phpBB 2.0.4, 2.0.5
        (c) Selven [Selven@zaion.com]
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if( !empty($setmodules) ) 
{ 
   $file = basename(__FILE__); 
   $module['Faq_manager']['board_faq'] = "$file?file=faq"; 
   $module['Faq_manager']['bbcode_faq'] = "$file?file=bbcode"; 
	if(file_exists($phpbb_root_path . 'attach_mod/attachment_mod.'.$phpEx)) 
	{ 
	   $module['Faq_manager']['attachment_faq'] = "$file?file=faq_attach";    
	}
	if(file_exists($phpbb_root_path . 'mods/prillian/im_main.'.$phpEx)) 
	{ 
	   $module['Faq_manager']['prillian_faq'] = "$file?file=prillian_faq"; 
	   $module['Faq_manager']['bid_faq'] = "$file?file=contact_faq";   
	}
   return;
}

?>
