<?php
/***************************************************************************
 *                             login_security.php
 *                            --------------------
 *		Version			: 1.0.3
 *		Email			: austin@phpbb-amod.com
 *		Site			: http://phpbb-tweaks.com
 *		Copyright		: aUsTiN-Inc 2003/6 
 *
 ***************************************************************************/
 
define('IN_PHPBB', TRUE);
$phpbb_root_path = './';
include_once($phpbb_root_path .'extension.inc');
include_once($phpbb_root_path .'common.'. $phpEx);

$userdata = session_pagestart($user_ip, PAGE_INDEX); 
init_userprefs($userdata); 

include_once($phpbb_root_path .'includes/phpbb_security.'. $phpEx);

	$verify_sq 	= isset($_GET['phpBBSecurity']) ? $_GET['phpBBSecurity'] : $_POST['phpBBSecurity'];		
	$actions	= isset($_POST['actions']) ? $_POST['actions'] : '';
	
	$template->set_filenames(array(
		'body' => 'login_security.tpl')
			);
		
	$template->assign_vars(array(
		'HEADER'	=> $lang['PS_login_header'],
		'BUTTON'	=> $lang['PS_login_button'],
		'FORGOT'	=> $lang['PS_forgot_sq'])
			);
						
	$page_title = $lang['PS_login_title'];

	function LinkLength($link, $max)
		{
	if (strlen($link) > $max)
		$newlink = substr($link, 0, ($max - 3)) .'.....';
	else
		$newlink = $link;
	return $newlink;
		}
			
	if ($userdata['user_id'] != ANONYMOUS)
		{
		if ($verify_sq != 'caught')
			redirect(append_sid('index.'. $phpEx), TRUE);
		}
	
	if ($verify_sq == 'forgot')
		phpBBSecurity_Forgot();
	
	if ($verify_sq == 'caught')
		{
	$start			= isset($_GET['start']) ? intval($_GET['start']) : 0;
	$caught_data 	= phpBBSecurity_Caught($start, $board_config['phpBBSecurity_per_page']);
	$caught_count	= count($caught_data);
	$total 			= phpBBSecurity_Total();
	$pagination 	= generate_pagination("login_security.$phpEx?phpBBSecurity=caught", $total, $board_config['phpBBSecurity_per_page'], $start). '&nbsp;';
	$page_number 	= sprintf($lang['Page_of'], (floor($start / $board_config['phpBBSecurity_per_page']) + 1 ), ceil($total / $board_config['phpBBSecurity_per_page']));		
		
	if (!$caught_count)
		message_die(GENERAL_MESSAGE, $lang['PS_caught_msg'], $lang['PS_security_info']);
		
	$template->assign_block_vars('caught', array(
		'L'		=> $lang['PS_caught_left'],
		'CL'	=> $lang['PS_caught_c_left'],
		'CR'	=> $lang['PS_caught_c_right'],
		'R'		=> $lang['PS_caught_right'],
		'P'		=> $pagination,
		'PN'	=> $page_number)
			);
			
		for ($a = 0; $a < $caught_count; $a++)
			{
		$caught_ip 			= decode_ip($caught_data[$a]['ban_ip']);
		$caught_attempts 	= number_format($caught_data[$a]['ban_attempts'] + 1);
		$caught_reason 		= $caught_data[$a]['ban_reason'];
		$caught_time 		= create_date($board_config['default_dateformat'], $caught_data[$a]['ban_date'], $board_config['board_timezone']);		
		$fix_ip 			= explode('.', $caught_ip);
		$fixed_ip 			= $fix_ip[0] .'.'. $fix_ip[1] .'.'. $fix_ip[2] .'.xxx';
		$row_class 			= ( !($a % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
		$caught_link		= ($caught_data[$a]['ban_link'] != '') ? LinkLength($caught_data[$a]['ban_link'], 60) : 'Unknown';
			
		$template->assign_block_vars('caught.rows', array(
			'L'		=> $fixed_ip,
			'LC'	=> $caught_reason,
			'RC'	=> $caught_time,
			'R'		=> $caught_attempts,
			'LINK'	=> $caught_link,
			'NUM'	=> $start + ($a + 1),
			'ROWS'	=> $row_class)
				);
				
			if (!$caught_data[$a]['ban_id'])
				break;
			}
		}
		
	if ($verify_sq == 'retreive')
		{			
		if (!$actions)
			{
		$template->assign_block_vars('step_one', array(
			'NAME'		=> $lang['PS_login_username'],
			'MAIL'		=> $lang['PS_login_email'],
			'STEP_1'	=> $lang['PS_login_step_one'])
				);		
			}
		elseif ($actions == '1')
			{
		$ps_username 	= isset($_POST['ps_username']) ? $_POST['ps_username'] : '';
		$ps_email 		= isset($_POST['ps_email']) ? $_POST['ps_email'] : '';
		phpBBSecurity_ValidateStepOne($ps_username, $ps_email);
		
		$question = phpBBSecurity_ValidateGetQ($ps_username, $ps_email);
		
		$template->assign_block_vars('step_two', array(
			'QUESTION'	=> $question,
			'STEP_2'	=> $lang['PS_login_step_two'],
			'HIDDEN'	=> $ps_username)
				);		
			}
		elseif ($actions == '2')
			{
		$ps_username 	= isset($_POST['ps_username']) ? $_POST['ps_username'] : '';
		$ps_answer		= isset($_POST['ps_answer']) ? $_POST['ps_answer'] : '';
		
		phpBBSecurity_ValidateStepTwo($ps_username, $ps_answer);				
			}			
		else
			redirect(append_sid('index.'. $phpEx), TRUE);
		}				
		
	include_once($phpbb_root_path .'includes/page_header.'. $phpEx);		
	$template->pparse('body');
	include_once($phpbb_root_path .'includes/page_tail.'. $phpEx);
?>