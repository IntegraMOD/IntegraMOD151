<?php
/***************************************************************************
 *                            profile.php
 *                            -----------
 *	begin				: 08/05/2003
 *	copyright			: Ptirhiik
 *	email				: admin@rpgnet-fr.com
 *
 *	version				: 1.0.9 - 17/10/2003
 *
 ***************************************************************************/

define('IN_PHPBB', true);
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignorepvar = array('helpbox','delete','deleteall','phpBBSecurity_answer','phpBBSecurity_question','user_interests');
if ( (isset($_GET['mode']) && ($_GET['mode'] == 'viewprofile')) || (isset($_POST['mode']) && ($_POST['mode'] == 'viewprofile')) )
{
	define('IN_CASHMOD', true);
	define('CM_VIEWPROFILE',true);
}
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'profilcp/functions_profile.'.$phpEx);

include($phpbb_root_path . 'includes/functions_selects.'.$phpEx);
include($phpbb_root_path . 'includes/functions_validate.'.$phpEx);
include($phpbb_root_path . 'includes/functions_post.'.$phpEx);
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);
include($phpbb_root_path . 'includes/emailer.'.$phpEx);
include_once($phpbb_root_path . 'includes/functions_topics_list.' . $phpEx);

//
// Start session management
$userdata = session_pagestart($user_ip, PAGE_PROFILE);
init_userprefs($userdata);

//
// Set default email variables
//
$script_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($board_config['script_path']));
$script_name = ( $script_name != '' ) ? $script_name . '/profile.'.$phpEx : 'profile.'.$phpEx;
$server_name = trim($board_config['server_name']);
$server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
$server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';

$server_url = $server_protocol . $server_name . $server_port . $script_name;

//
//  get viewed user id
$view_user_id = ANONYMOUS;
if ( isset($_POST[POST_USERS_URL]) || isset($_GET[POST_USERS_URL]) )
{
	$view_user_id = isset($_POST[POST_USERS_URL]) ? intval($_POST[POST_USERS_URL]) : intval($_GET[POST_USERS_URL]);
}
if ($view_user_id==ANONYMOUS) $view_user_id = $userdata['user_id'];

//
// get the menu
$dir = @opendir($phpbb_root_path . "profilcp");
$setmodules = true;
while( $file = @readdir($dir) )
{
	if( preg_match("/^profilcp_.*?\." . $phpEx . "$/", $file) )
	{
		include($phpbb_root_path . "profilcp/" . $file);
	}
}
@closedir($dir);

unset($setmodules);
//
// sort
for ($i=0; $i < count($module['sub']); $i++)
{
	if ( !empty($module['sub'][$i]) )
	{
		@array_multisort( $module['sub'][$i]['sort'], $module['sub'][$i]['mode'], $module['sub'][$i]['shortcut'], $module['sub'][$i]['url'], $module['sub'][$i]['page_title'] );
	}
}
@array_multisort( $module['sort'], $module['mode'], $module['shortcut'], $module['url'], $module['page_title'], $module['sub'] );

// session id get
$sid = '';
if (!empty($_POST['sid']) || !empty($_GET['sid']))
{
   $sid = (!empty($_POST['sid'])) ? $_POST['sid'] : $_GET['sid'];
} 

//
// Mode
// PCP Extra :: Altered :: $mode = 'home';
$mode = '';
$sub = '';
$msub = '';
$mod= '';
if ( !$userdata['session_logged_in'] ){
	$mode = 'profil';
	$sub = 'profile_prefer';
	$mod= 0;
}else{
$mode = 'home';
}
// PCP Extra :: END
if ( isset($_POST['mode']) || isset($_GET['mode']) )
{
	$mode = isset($_POST['mode']) ? $_POST['mode'] : $_GET['mode'];
	$mode = htmlspecialchars($mode);
}
if ( isset($_POST['sub']) || isset($_GET['sub']) ){
	$sub = isset($_POST['sub']) ? $_POST['sub'] : $_GET['sub'];
	$sub = htmlspecialchars($sub);
}
if ( isset($_POST['mod']) || isset($_GET['mod']) ){
	$mod = isset($_POST['mod']) ? $_POST['mod'] : $_GET['mod'];
	$mod = htmlspecialchars($mod);
}
if ( isset($_POST['msub']) || isset($_GET['msub']) ){
	$msub = isset($_POST['msub']) ? $_POST['msub'] : $_GET['msub'];
	$msub = htmlspecialchars($msub);
}
if ( $mode == 'activate' ) 
{
	include($phpbb_root_path . "profilcp/profilcp_activate.$phpEx");
}
if ( $mode == 'email' ) 
{
	include($phpbb_root_path . "profilcp/profilcp_email.$phpEx");
}
if ( $mode == 'sendpassword' ) 
{
	include($phpbb_root_path . "profilcp/profilcp_sendpassword.$phpEx");
}
if ($mode == 'privmsg_popup')
{
	include($phpbb_root_path . "profilcp/profilcp_privmsg_popup.$phpEx");
}
if ( $mode == 'confirm' && !function_exists('imagettfbbox') && !function_exists('imagettftext'))
{
	// Visual Confirmation
	if ( $userdata['session_logged_in'] && (htmlspecialchars($_GET['id']) != 'Admin'))
	{
		exit;
	}
	include($phpbb_root_path . 'includes/usercp_confirm.'.$phpEx);
	exit;
}
if ( $mode == 'confirm' && function_exists('imagettfbbox') && function_exists('imagettftext'))
{
	// Visual Confirmation
	if ( $userdata['session_logged_in'] && (htmlspecialchars($_GET['id']) != 'Admin'))
	{
		exit;
	}
	include($phpbb_root_path . 'includes/usercp_confirm_gd.'.$phpEx);
	exit;
}
if ( !in_array($mode, $module['mode']) ) $mode = 'home';

// no user_id asked, use current user
if ( $userdata['session_logged_in'] && ($view_user_id == ANONYMOUS) ) $view_user_id = $userdata['user_id'];

// check other $mode value
if ( !$userdata['session_logged_in'] )
{
	if ($mode != 'profil' || $sub != 'profile_prefer' || $mod !=0)
	{
		if ($view_user_id == ANONYMOUS)
		{
			redirect(append_sid("login.$phpEx?redirect=profile.$phpEx?mode=$mode&sub=$sub&mod=$mod&msub=$msub", true));
		}
		else if ($mode != 'activate') 
		{
			redirect(append_sid("login.$phpEx?redirect=profile.$phpEx&mode=viewprofile&" . POST_USERS_URL . "=$view_user_id", true));
			$mode = 'viewprofile';
		}
	}
}
if ( $userdata['session_logged_in'] )
{
	if ($view_user_id == ANONYMOUS) $view_user_id = $userdata['user_id'];
	if ( ($view_user_id != $userdata['user_id']) && !is_admin($userdata) && ($mode != 'activate') )
	{
		$mode = 'viewprofile';
	}
}

// check view_user_id
$sql = "SELECT * FROM " . USERS_TABLE . " WHERE user_id=$view_user_id";

if(!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, 'Couldn\'t obtain user information.', '', __LINE__, __FILE__, $sql);
}
if (!$user_row = $db->sql_fetchrow($result) )
{
	message_die(GENERAL_ERROR, $lang['No_such_user']);
}

// get curopt
$curopt = -1;
for ($i=0; ( ($i < count($module['mode'])) && ($curopt < 0) ); $i++ )
{
	if ($mode == $module['mode'][$i])
	{
		$curopt = $i;
	}
}

// sub-option
if ( !isset($module['sub'][$curopt]['mode']) || !in_array($sub, $module['sub'][$curopt]['mode']) )
{
	$sub = '';
}

// get cur subopt
$cur_subopt = -1;
for ($i=0; ( ($i < count($module['sub'][$curopt]['mode'])) && ($cur_subopt < 0) ); $i++ ) if ($sub == $module['sub'][$curopt]['mode'][$i]) $cur_subopt = $i;
if ( ($cur_subopt < 0) && (count($module['sub'][$curopt]) > 0) )
{
	$cur_subopt = 0;
	$sub = $module['sub'][$curopt]['mode'][0];
}

// action
$set = '';
if ( isset($_POST['set']) || isset($_GET['set']) )
{
	$set = isset($_POST['set']) ? $_POST['set'] : $_GET['set'];
}
$no_header = in_array($set, array('add', 'remove'));

// Control
$submit = ( isset($_POST['submit']) || (($mode=='privmsg') && isset($_POST['post'])) );
$reset = isset($_POST['reset']);
$remove = isset($_POST['remove']);
$adduser = isset($_POST['adduser']);
$preview = isset($_POST['preview']);
$cancel = isset($_POST['cancel']);
$confirm = isset($_POST['confirm']);

// privmsg
$save = isset($_POST['save']);
$mark_list = ( !empty($_POST['mark']) ) ? $_POST['mark'] : 0;
$save = ($save && $mark_list && ($sub != 'savebox') && ($sub != 'outbox'));

// reload the user row
$view_userdata = $user_row;

if ($submit || $remove || $adduser || $no_header || $save || $confirm)
{
	// session id check
	if ( ($sid != $userdata['session_id']) && ($set == '') && !$no_header && !defined('NO_SID'))
	{
		message_die(GENERAL_ERROR, 'Invalid_session');
	}

	if ( !empty($module['url'][$curopt]) && empty($module['sub'][$curopt]['url'][$cur_subopt]) )
	{
		@include( $phpbb_root_path . './profilcp/' . $module['url'][$curopt] );
	}
	if ( !empty($module['sub'][$curopt]['url'][$cur_subopt]) )
	{
		include( $phpbb_root_path . './profilcp/' . $module['sub'][$curopt]['url'][$cur_subopt] );
	}
	
	if (!$error && !$no_header)
	{
		$ret_link = append_sid("./profile.$phpEx?mode=$mode" . (($cur_subopt < 0) ? '' : "&sub=$sub") . "&" . POST_USERS_URL . "=$view_user_id" );
		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="3;url=' . $ret_link . '">')
		);
		/* PCP Extra :: Altered
		$message = $lang['Profile_updated'] . '<br /><br />' . sprintf($lang['Click_return_profilcp'], '<a href="' . $ret_link . '">', "</a>") . '<br /><br />';*/
		$message = $lang['Profile_updated'] . '<br /><br />' . sprintf($lang['Click_return_profilcp'], '<a href="' . $ret_link . '">', "</a>", $module['sub'][$curopt]['page_title'][$cur_subopt]) . '<br /><br />';
		message_die(GENERAL_MESSAGE, $message);
	}
}
else if ($cancel)
{
	redirect(append_sid("./profile.$phpEx?mode=$mode&sub=$sub"));
}
else
{
	// set the page title and include the page header
	$page_title = $module['page_title'][$curopt];
	if ($cur_subopt >= 0) $page_title .= ' :: ' . $module['sub'][$curopt]['page_title'][$cur_subopt];
	include ($phpbb_root_path . './includes/page_header.' . $phpEx);

	// template file
	$template->set_filenames(array(
		'profilcp_header' => 'profilcp/profilcp_header.tpl')
	);
	//
	// menu
	$nb_opt = count($module['shortcut']);
	if ( $nb_opt < 8 ) $nb_opt = 8;
	$width = intval(120 / $nb_opt) +1;
	$filler_width = 120 - $width * count($module['shortcut']);
	if ($filler_width < 0) $filler_width = 0;
	$template->assign_vars(array(
		'NBOPT'			=> $nb_opt,
		'WIDTH'			=> $width,
		'FILLER_WIDTH'	=> $filler_width,
		)
	);
	if ( $nb_opt > count($module['shortcut']) )
	{
		$template->assign_block_vars('filleropt', array() );	
	}

	for ($i=0; $i < count($module['shortcut']); $i++)
	{
		$switch = ($curopt==$i) ? 'curopt' : ( ($userdata['session_logged_in'] && ( ($userdata['user_id'] == $view_user_id) || (is_admin($userdata) && ($level_prior[get_user_level($userdata)] > $level_prior[get_user_level($view_userdata)])))) ? 'otheropt' : 'inactopt' );
		$template->assign_block_vars('opt', array());
		$link = append_sid("./profile.$phpEx?mode=" . $module['mode'][$i] . ( ($view_userdata['user_id'] != ANONYMOUS) ? '&' . POST_USERS_URL . '=' . $view_userdata['user_id'] : '') );
		if ( count($module['sub'][$i]['mode']) == 1 )
		{
			// only one sub-module
			$link = append_sid("./profile.$phpEx?mode=" . $module['mode'][$i] . "&sub=" . $module['sub'][$i]['mode'][0] . ( ($view_userdata['user_id'] != ANONYMOUS) ? '&' . POST_USERS_URL . '=' . $view_userdata['user_id'] : '') );
		}
		$template->assign_block_vars('opt.' . $switch, array(
			'SHORTCUT'		=> $module['shortcut'][$i],
			'U_SHORTCUT'	=> $link,
			)
		);
	}
	//
	// sub-menu
	if ( ($cur_subopt >= 0) && (count($module['sub'][$curopt]['mode']) > 1) )
	{
		$nb_opt = count($module['sub'][$curopt]['shortcut']);
		if ( $nb_opt < 8 ) $nb_opt = 8;
		$width = intval(100 / $nb_opt) +1;
		$filler_width = 100 - $width * count($module['sub'][$curopt]['shortcut']);
		if ($filler_width < 0) $filler_width = 0;

		$template->assign_block_vars('sub_menu', array(
			'U_MODULE'		=> append_sid("./profile.$phpEx?mode=" . $module['mode'][$curopt] . "&sub=$sub" . ( ($view_userdata['user_id'] != ANONYMOUS) ? '&' . POST_USERS_URL . '=' . $view_userdata['user_id'] : '') ),
			'L_MODULE'		=> $module['sub'][$curopt]['page_title'][$cur_subopt],
			'NBOPT'			=> $nb_opt,
			'WIDTH'			=> $width,
			'FILLER_WIDTH'	=> $filler_width,
			)
		);

		if ( $nb_opt > count($module['sub'][$curopt]['shortcut']) )
		{
			$template->assign_block_vars('sub_menu.filleropt', array() );
		}

		for ($i=0; $i < count($module['sub'][$curopt]['shortcut']); $i++)
		{
			$switch = ($cur_subopt==$i) ? 'curopt' : ( ($userdata['session_logged_in'] && ( ($mode=='viewprofile') || ($userdata['user_id'] == $view_user_id) || (is_admin($userdata) && ($level_prior[get_user_level($userdata)] > $level_prior[get_user_level($view_userdata)])))) ? 'otheropt' : 'inactopt' );
			$template->assign_block_vars('sub_menu.opt', array());
			if ($i < count($module['sub'][$curopt]['shortcut']))
			{
				$template->assign_block_vars('sub_menu.opt.' . $switch, array(
					'SHORTCUT'		=> $module['sub'][$curopt]['shortcut'][$i],
					'U_SHORTCUT'	=> append_sid("./profile.$phpEx?mode=" . $module['mode'][$curopt] . "&sub=" . $module['sub'][$curopt]['mode'][$i] . ( ($view_userdata['user_id'] != ANONYMOUS) ? '&' . POST_USERS_URL . '=' . $view_userdata['user_id'] : '') ),
					)
				);
			}
		}
	}

	// system info
	$s_hidden_fields  = '<input type="hidden" name="mode" value="' . $mode . '">';
	$s_hidden_fields .= '<input type="hidden" name="' . POST_USERS_URL . '" value="' . $view_user_id . '">';
	$s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '">';
	if ( $cur_subopt >= 0) $s_hidden_fields .= '<input type="hidden" name="sub" value="' . $sub . '">';

	$s_pagination_fields = 'mode=' . $mode;
	if ($view_user_id != ANONYMOUS)
	{
		$s_pagination_fields .= '&' . POST_USERS_URL . "=$view_user_id";
	}
	$s_pagination_fields .= '&sid=' . $userdata['session_id'];
	if ($cur_subopt >= 0)
	{
		$s_pagination_fields .= '&sub=' . $sub;
	}

	//
	// page header constant
	if (!isset($nav_separator)) $nav_separator = '&nbsp;->&nbsp;';
	$template->assign_vars(array(
		'NAV_SEPARATOR'		=> $nav_separator,
		'L_MODULE'			=> ( ($view_userdata['user_id'] != ANONYMOUS) ? $view_userdata['username'] : $lang['Guest'] ) . '&nbsp;:&nbsp;' . $module['page_title'][$curopt],
		'U_MODULE'			=> append_sid("./profile.$phpEx?mode=" . $module['mode'][$curopt] . ( ($view_userdata['user_id'] != ANONYMOUS) ? '&' . POST_USERS_URL . '=' . $view_userdata['user_id'] : '') ),
		)
	);

	// header
	$template->pparse('profilcp_header');

	// module
	if ( !empty($module['url'][$curopt]) && empty($module['sub'][$curopt]['url'][$cur_subopt]) )
	{
		@include( $phpbb_root_path . './profilcp/' . $module['url'][$curopt] );
	}
	if ( !empty($module['sub'][$curopt]['url'][$cur_subopt]) )
	{
		@include( $phpbb_root_path . './profilcp/' . $module['sub'][$curopt]['url'][$cur_subopt] );
	}
	
	// footer
	$template->set_filenames(array(
		'profilcp_footer' => 'profilcp/profilcp_footer.tpl')
	);

	// sub-menu
	if ( $cur_subopt >= 0 )
	{
		$template->assign_block_vars('sub_menu_b', array());
	}
	$template->pparse('profilcp_footer');

	//
	// page_footer
	include($phpbb_root_path . './includes/page_tail.'.$phpEx);
}

?>
