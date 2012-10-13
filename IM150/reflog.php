<?php
/***************************************************************************
 *                                 reflog.php
 *                            -------------------
 *   copyright            : oc5iD (C) 2005 XTreme Mods
 *   web                  : http://www.on-irc.net
 *   Email                : admin@on-irc.net
 *
 ***************************************************************************/

$reflog = 'referer/reflog.txt';
$semaphore = 'referer/semaphore.ref';
$maxref = 10;
$mydomain = $board_config['server_name'];
$ref = getenv("HTTP_REFERER");

if (($ref) and (!strstr($ref, $mydomain))) 
{	
	$ref .= "\n";
	$sp = fopen($semaphore, "w"); 
	if (flock($sp, 2)) 
	{				
		
		$rfile = file($reflog); 
		if ($ref <> $rfile[0]) 
		{		
			
			if (count($rfile) == $maxref)
				array_pop($rfile); 
			array_unshift($rfile, $ref); 
			$r = join("", $rfile); 
			$rp = fopen($reflog, "w"); 
			$status = fwrite($rp, $r); 
			$status = fclose($rp); 
		}
	}
	$status = fclose($sp); 
}

?>