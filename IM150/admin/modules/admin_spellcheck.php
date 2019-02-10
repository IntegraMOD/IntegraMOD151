<?php

return; /* V: disabled. */
if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
if ( !empty($setmodules) )
{
   $filename = basename(__FILE__);
   $module['Forums']['Spellcheck'] = $filename;
   return;
}

?>