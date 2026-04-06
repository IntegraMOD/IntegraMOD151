<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="{S_CONTENT_DIRECTION}" lang="en" xml:lang="en">
<head>
<meta charset="{S_CONTENT_ENCODING}" />
<meta http-equiv="Content-Style-Type" content="text/css">{META_HTTP_EQUIV_TAGS}
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="copyright" content="2001, 2024 Integramod Team" />
<title>{SITENAME} - {PAGE_TITLE}</title>{META_TAGS}
{META}
{NAV_LINKS}
<!--[if gte IE 5]><![if lt IE 7]><script type="text/javascript" src="templates/pngfix.js"></script><![endif]><![endif]--> 
<link rel="stylesheet" href="{TEMPLATE}{T_HEAD_STYLESHEET}" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="shortcut icon" href="./favicon.ico">

<!-- BEGIN switch_enable_pm_popup -->
<script>
// <![CDATA[
if ( {PRIVATE_MESSAGE_NEW_FLAG} )
{
window.open('{U_PRIVATEMSGS_POPUP}', '_phpbbprivmsg', 'HEIGHT=225,resizable=yes,WIDTH=400');;
}
// ]]>
</script>
<!-- END switch_enable_pm_popup -->
<!-- Start add - No copy MOD -->
	<script>
// <![CDATA[
let previousKey;
 
function handleRightClick(event) {
  if (event.button === 2) {
    alert('{L_NO_CLICK}');
    return false;
  }
}
 
function handleMouseDown(event) {
  if ((document.layers || (document.getElementById && !document.all)) &&
      (event.which === 2 || event.which === 3)) {
    alert('{L_NO_CLICK}');
    return false;
  }
}
 
function handleKeyDown(event) {
  const keyCode = event.keyCode || event.which;
 
  if (previousKey === 17) { // Ctrl key
    switch (keyCode) {
      case 45: // Insert
      case 46: // Delete
      case 67: // C
      case 88: // X
        alert('{L_NO_COPY}');
        event.preventDefault();
        previousKey = keyCode;
        return false;
    }
  } else if (previousKey === 16) { // Shift key
    switch (keyCode) {
      case 45: // Insert
      case 46: // Delete
        alert('{L_NO_COPY}' + keyCode);
        event.preventDefault();
        previousKey = keyCode;
        return false;
    }
  }
 
  previousKey = keyCode;
}
 
function handleKeyUp() {
  previousKey = 0;
}
 
function initializeEventListeners() {
  if (document.layers) {
    document.captureEvents(Event.MOUSEDOWN);
    document.onmousedown = handleMouseDown;
  } else if (document.all && !document.getElementById) {
    document.onmousedown = handleRightClick;
  }
 
  document.addEventListener('contextmenu', (event) => {
    alert('{L_NO_CLICK}');
    event.preventDefault();
  });
 
  document.addEventListener('keyup', handleKeyUp);
  document.addEventListener('keydown', handleKeyDown);
}
 
if ({USER_EXTRA}) {
  initializeEventListeners();
}
// ]]>
</script>
<!-- End add - No copy MOD -->
<!-- BEGIN birthday_popup -->
<script>
// <![CDATA[
// Open birthday popup
window.open(
    '{birthday_popup.U_BIRTHDAY_POPUP}',
    '_phpbbbirthday',
    'height=225,width=400,resizable=yes'
);
// ]]>
</script>
<!-- END birthday_popup -->
<script>
// <![CDATA[
// Function to open a tour window
function openTourWindow() {
    const tourUrl = "tour.php";
    const windowName = "_tour";
    const windowFeatures = "width=800,height=600,scrollbars=yes,resizable=yes";
 
    window.open(tourUrl, windowName, windowFeatures);
}
// ]]>
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="templates/assets/js/mouseover.js"></script>
<script src="templates/assets/js/toggle_display.js"></script>
<script src="templates/fi_newsfader_user.js"></script>
<script src="templates/assets/js/importal.js"></script>

<!-- Prillian - Begin Code Additions -->
<!-- BEGIN switch_user_logged_in -->
<script>
// <![CDATA[
/**
 * Opens a new window with specified dimensions for the Prillian application.
 * @param {string} url - The URL to open in the new window.
 * @param {number} width - The width of the new window.
 * @param {number} height - The height of the new window.
 */
function launchPrillian(url, width, height) {
    window.name = 'phpbbmain';
    const prillian = window.open(
        url,
        'prillian',
        `width=${width},height=${height},innerWidth=${width},innerHeight=${height},resizable,scrollbars`
    );
 
    // Optional: Handle if the window failed to open
    if (!prillian) {
        console.error('Failed to open Prillian window. Please check your pop-up blocker settings.');
    }
}
 
// Auto-launch Prillian if the condition is met
if (typeof IM_AUTO_POPUP !== 'undefined' && IM_AUTO_POPUP) {
    launchPrillian(U_IM_LAUNCH, IM_WIDTH, IM_HEIGHT);
}
// ]]>
</script>
<!-- END switch_user_logged_in -->

<!-- BEGIN buddy_alert -->
<script>
// <![CDATA[
// Check if buddy alert is enabled
if (buddyAlert.isEnabled) {
    // Open buddy alert window
    window.open(
      buddyAlert.url,
      '_buddyalert',
      'height=225,width=400,resizable=yes'
    );
}
// ]]>
</script>
<!-- END buddy_alert -->
<!-- Prillian - End Code Additions -->
{COLOR_CSS}
</head>
<body id="phpbb" class="section-index {S_CONTENT_DIRECTION}">
<!-- BEGIN switch_board_disabled -->
    <table width="100%" cellspacing="0" cellpadding="10" border="0" align="center"> 
	<tr> 
	<td class="forumline" align="center"><span class="alert"><b>{L_BOARD_DISABLE}</b></span></td>
    </tr>
   </table>
<!-- END switch_board_disabled -->
<!-- Start add - Complete banner MOD -->
<!-- Banners -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="20%">
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<!-- BEGIN switch_banner_1 -->
<tr><td><div align="center">{BANNER_1_IMG}</div></td></tr>
<!-- END switch_banner_1 -->
<!-- BEGIN switch_banner_2 -->
<tr><td><div align="center">{BANNER_2_IMG}</div></td></tr>
<!-- END switch_banner_2 -->
</table>
</td>
<td width="60%">
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<!-- BEGIN switch_banner_3 -->
<tr><td><div align="center">{BANNER_3_IMG}</div></td></tr>
<!-- END switch_banner_3 -->
<!-- BEGIN switch_banner_4 -->
<tr><td><div align="center">{BANNER_4_IMG}</div></td></tr>
<!-- END switch_banner_4 -->
</table>
</td>
<td width="20%">
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<!-- BEGIN switch_banner_5 -->
<tr><td><div align="center">{BANNER_5_IMG}</div></td></tr>
<!-- END switch_banner_5 -->
<!-- BEGIN switch_banner_6 -->
<tr><td><div align="center">{BANNER_6_IMG}</div></td></tr>
<!-- END switch_banner_6 -->
</table>
</td>
</tr>
</table>
<!-- End Banners -->
<!-- End add - Complete banner MOD -->
{QBARS}
<a name="top" id="top"></a>
<div id="wrap">
<a id="top" accesskey="t"></a>
	<div id="page-header">
		<div class="headerbar">
			<div class="inner"><span class="corners-top"><span></span></span>
			<div id="site-description">
				<a href="{U_INDEX}" title="{L_INDEX}" id="logo"><img src="templates/prosilver/images/site_logo.svg" width="139" height="52" alt="" title="{SITENAME}" /></a>
				<h1>{SITENAME}</h1>
				<p>{SITE_DESCRIPTION}</p>
			</div>
			<div id="search-box">
				<form action="{U_SEARCH}" method="get" id="search">
				<fieldset>
					<input name="search_keywords" id="keywords" type="text" maxlength="128" title="" class="inputbox search" value="{L_SEARCH}" onclick="if(this.value=='{L_SEARCH}')this.value='';" onblur="if(this.value=='')this.value='{L_SEARCH}';" /> 
					<input class="button2" value="{L_SEARCH}" type="submit" />
					{S_HIDDEN_FIELDS}
				</fieldset>
				</form>
			</div>
			<span class="corners-bottom"><span></span></span></div>
		</div>

		<div class="navbar">
			<div class="inner"><span class="corners-top"><span></span></span>
			<ul class="linklist navlinks">
				<li class="icon-home"><a href="{U_PORTAL}">{L_HOME}</a>&nbsp;&bull;&nbsp;<a href="{U_INDEX}">{L_FORUM}</a><span class="breadcrumbs">&nbsp;&bull;&nbsp;{PAGE_TITLE}</span></li>
			</ul>
			<!-- BEGIN switch_user_logged_in -->
			<ul class="linklist leftside">
				<li class="icon-ucp">
					<a href="{U_PROFILE}" title="{L_PROFILE}">{L_PROFILE}</a>
					 (<a href="{U_PRIVATEMSGS}">{PRIVATE_MESSAGE_INFO}</a>) &bull; 
					<a href="{U_SEARCH_SELF}">{L_SEARCH_SELF}</a>
				</li>
			</ul>
			<!-- END switch_user_logged_in -->
			<ul class="linklist rightside">
				<li class="icon-faq"><a href="{U_FAQ}">{L_FAQ}</a></li>
				<li class="icon-search"><a href="{U_SEARCH}">{L_SEARCH}</a></li>
				<!-- BEGIN switch_user_logged_in -->
				<li class="icon-members"><a href="{U_MEMBERLIST}">{L_MEMBERLIST}</a></li>
				<!-- END switch_user_logged_in -->
				<!-- BEGIN switch_user_logged_out -->
				<li class="icon-register"><a href="{U_REGISTER}">{L_REGISTER}</a></li>
				<!-- END switch_user_logged_out -->
				<li class="icon-logout"><a href="{U_LOGIN_LOGOUT}" title="{L_LOGIN_LOGOUT}">{L_LOGIN_LOGOUT}</a></li>
			</ul>
			<span class="corners-bottom"><span></span></span></div>
		    </div>
		</div>
	<div id="page-body">

 <!-- BEGIN switch_lw_user_logged_in -->
<table align="center">
  <tr>
    <td height="25" align="center" valign="top" nowrap="nowrap"><span class="mainmenu">&nbsp;{L_LW_EXPIRE_REMINDER}</span></td>
  </tr>
</table>
<!-- END switch_lw_user_logged_in -->
{CALENDAR_BOX}
<!-- BEGIN switch_banner_16 -->
<table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td width="100%" align="center">{BANNER_16_IMG}</td>
  </tr>
</table>
<!-- END switch_banner_16 -->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    {PORTAL_HEADER}
    <td valign="top">