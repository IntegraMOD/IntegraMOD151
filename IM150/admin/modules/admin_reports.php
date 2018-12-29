<?php

if (!empty($setmodules))
{
	$file = basename(__FILE__);
	$module['Reports']['Modules_reasons'] = $file;
	$module['Reports']['Configuration'] = "$file?mode=config";
	return;
}
