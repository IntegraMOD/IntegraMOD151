<?php
/***************************************************************************
 *                             album_nuffload_pbar.php
 *                            -------------------
 *   Author                : Nuffmon
 *   Email                 : nuffmon@hotmail.com
 *   Version               : 1.4.0
 *   Last Update           : 20/09/2005
 *
 ***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
$album_root_path = $phpbb_root_path . 'album_mod/';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

// Start session management
$userdata = session_pagestart($user_ip, PAGE_ALBUM);
init_userprefs($userdata);
// End session management

// Get general album information
include($album_root_path . 'album_common.'.$phpEx);

function hms($sec)
{
	$thetime = str_pad(intval(intval($sec) / 3600),2,"0",STR_PAD_LEFT).":". str_pad(intval(($sec / 60) % 60),2,"0",STR_PAD_LEFT).":". str_pad(intval($sec % 60),2,"0",STR_PAD_LEFT) ;
	return $thetime;
}

// Check session_id and monitor upload or quit
if(isset($_REQUEST['sessionid']))
{
	// Set unlimited timeout
	set_time_limit(0);
	$start_time = time(); //Set start time as now
	$sessionid = $_REQUEST['sessionid'];
	
	// Path to data files
	$info_file = $album_config['path_to_bin'] . "tmp/$sessionid"."_flength";
	$data_file = $album_config['path_to_bin'] . "tmp/$sessionid"."_postdata";
	$signal_file = $album_config['path_to_bin'] . "tmp/$sessionid"."_signal";

	// Dump page header
	$gen_simple_header = TRUE;
	$page_title = $lang['upload_in_progress'];
	if(!$album_config['simple_format']){
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);
	}

	// Load template
	$template->set_filenames(array(
		'body' => 'album_nuffload_pbar_body.tpl'
		)
	);

	// Load template variable
	$template->assign_vars(array(
		'L_ALBUM' => $lang['album'],
		'L_UPLOAD_PIC' => $lang['Upload_Pic'],
		'L_UPLOAD_IN_PROGRESS' => $lang['upload_in_progress'],
		'L_TIME_ELAPSED' => $lang['time_elapsed'],
		'L_TIME_REMAINING' => $lang['time_remaining'],
		'L_NUFFLOAD_VERSION' => "v1.4.0"
		)
	);

	//Output page
	$template->pparse('body');

	$template->set_filenames(array(
		'overall_footer' => 'simple_footer.tpl'
		)
	);

	$template->pparse('overall_footer');

	$db->sql_close();

	// Loop/monitor filesize until complete
	for(;$percent_done<100;)
	{
		// Open info file to find filesize
		// info file created by perl script
		if (intval($total_size) <= 0)
		{
			if ($fp = @fopen($info_file,"r"))
			{
				$fd = fread($fp,1000);
				fclose($fp);
				$total_size = $fd;
			}
		}
		
		$time_elapsed = time()- $start_time;
		$previous_size = $current_size;
		clearstatcache();
		$current_size = @filesize($data_file);
		
		// This section checks for no activity and stops processing
		if ($previous_size < $current_size)
		{
			$activity_time = 0;
		}
		else
		{
			$activity_time++;
		}
		if ($activity_time >= $album_config['max_pause'])
		{
			?>
			<script language="JavaScript" type="text/javascript">
				<!--
					top.close();
				// -->
			</script>
			<?php
			exit;
		}
		
		// Calculate progress values if upload started.
		if ($current_size > 0 && $time_elapsed > 0)
		{
			$percent_done = sprintf("%.0f",($current_size / $total_size) * 100);
			$speed = ($current_size / $time_elapsed);
			if ($speed == 0) {$speed = 1024;}
			$time_remain_str = hms(($total_size-$current_size) / $speed);
			$time_elapsed_str = hms($time_elapsed);
		}
		if ($percent_done < 1)
		{
			$percent_done = 1;
		}
		?>
		<script language="JavaScript" type="text/javascript">
			<!--
				document.getElementById("progress1").width = "<?php print $percent_done; ?>%";
				document.getElementById("progress2").innerHTML = '<?php echo $current_size; ?>/<?php echo $total_size; ?> (<?php echo $percent_done; ?>%) <?php echo printf("%.2f",$speed/1024); ?> kbit/s<br><?php echo $lang['time_elapsed'] . ": " . $time_elapsed_str; ?><br><?php echo $lang['time_remaining'] . ": " . $time_remain_str; ?>';
			// -->
		</script>
<?php
		ob_flush();
		flush();
		sleep(1);
	}
	
	//  Now we have finished we can delete the data files
	@unlink($info_file);
	@unlink($data_file);
	@unlink($signal_file);
	
	// Send javascript to close form if required
	if ($album_config['close_on_finish'])
	{
		?>
		<script language="JavaScript" type="text/javascript">
			<!--
				top.close();
			// -->
		</script>
		<?php
	}
}
?>
