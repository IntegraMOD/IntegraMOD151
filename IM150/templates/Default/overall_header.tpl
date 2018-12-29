<!DOCTYPE html>
<html dir="{S_CONTENT_DIRECTION}">

<head>
<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}">
<meta http-equiv="Content-Style-Type" content="text/css">{META_HTTP_EQUIV_TAGS}
<title>{SITENAME} - {PAGE_TITLE}</title>{META_TAGS}
{META}
{NAV_LINKS}
<!--[if gte IE 5]><![if lt IE 7]><script type="text/javascript" src="templates/pngfix.js"></script><![endif]><![endif]--> 
<link rel="shortcut icon" href="./favicon.ico">
<link rel="stylesheet" href="{TEMPLATE}{T_HEAD_STYLESHEET}" type="text/css">
<script type="text/javascript" src="templates/toggle_display.js"></script>
<script type="text/javascript" src="templates/importal.js"></script>

<!-- BEGIN switch_enable_pm_popup -->
<script type="text/javascript">
<!--
if ( {PRIVATE_MESSAGE_NEW_FLAG} )
{
window.open('{U_PRIVATEMSGS_POPUP}', '_phpbbprivmsg', 'HEIGHT=225,resizable=yes,WIDTH=400');;
}
//-->
</script>
<!-- END switch_enable_pm_popup -->
<!-- Start add - No copy MOD -->
<script language="javascript">
<!-- 
var previous_key ;

function clickIE4(){
if (event.button==2){
alert('{L_NO_CLICK}');
return false;
}
}

function clickNS4(e){
if (document.layers||document.getElementById&&!document.all){
if (e.which==2||e.which==3){
alert('{L_NO_CLICK}');
return false;
}
}
}

if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
document.onmousedown=clickIE4;
}
function handleKeyDown()
{
	if (previous_key==17 )
	{
		switch (window.event.keyCode)
		{
			case 45 :
			case 46: 
			case 67:
			case 88:
				alert('{L_NO_COPY}');
				event.keyCode=0;
				previous_key=window.event.keyCode;
				event.returnValue=false;
				break;
		}
	} else if (previous_key==16)
	{
		switch (window.event.keyCode)
		{
			case 45 :
			case 46: 
				alert('{L_NO_COPY}'+window.event.keyCode);
				event.keyCode=0;
				previous_key=window.event.keyCode;
				event.returnValue=false;
				break;
		}
	}
	previous_key=window.event.keyCode;
}
function handleKeyUp()
{
	previous_key=0;
}

if ( {USER_EXTRA} )
{
document.oncontextmenu=new Function("alert('{L_NO_CLICK}');return false")
document.onkeyup = handleKeyUp;
document.onkeydown = handleKeyDown;
}
//-->
</script>
<!-- End add - No copy MOD -->
<!-- BEGIN birthday_popup -->
<script type="text/javascript">
<!--
window.open('{birthday_popup.U_BIRTHDAY_POPUP}', '_phpbbbirthday', 'HEIGHT=225,resizable=yes,WIDTH=400');
//-->
</script>
<!-- END birthday_popup -->
<script type="text/javascript"> 
<!-- 
function tour() { 
window.open("tour.php", "_tour", "width=800,height=600,scrollbars,resizable=yes");
} 
//--> 
</script>
<script type="text/javascript" src="templates/mouseover.js"></script>
<!-- Prillian - Begin Code Additions -->
<!-- BEGIN switch_user_logged_in -->
<script type="text/javascript">
<!--
function prill_launch(url, w, h)
{
window.name = 'phpbbmain';
prillian = window.open(url, 'prillian', 'height=' + h + ', width=' + w + ', innerWidth=' + w + ', innerHeight=' + h + ', resizable, scrollbars');
}
if ( {IM_AUTO_POPUP} ) 
{ 
prill_launch('{U_IM_LAUNCH}', '{IM_WIDTH}', '{IM_HEIGHT}');
} 
//-->
</script>
<!-- END switch_user_logged_in -->
<!-- BEGIN buddy_alert -->
<script type="text/javascript">
if ( {buddy_alert.BUDDY_ALERT} )
{
window.open('{buddy_alert.U_BUDDY_ALERT}', '_buddyalert', 'HEIGHT=225,resizable=yes,WIDTH=400');
}
</script>
<!-- END buddy_alert -->
<!-- Prillian - End Code Additions -->
<script type="text/javascript" src="templates/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="templates/jquery.easing.min.js"></script>
<script type="text/javascript" src="templates/jquery.toggle.js"></script>
<script type="text/javascript" src="templates/jQuery.mobTabMenu.js"></script>
<script type="text/javascript" src="templates/immenu.js"></script>
<link rel="stylesheet" type="text/css" href="templates/Default/report_hack.css" />
{COLOR_CSS}
</head>
<body class="resp">
	<div id="mobile-bar">
		<a href="#" class="mob-tab-menu-toggle toggle"></a>
	</div>
	<nav class="mobile-menu" style="display: none;">{QMENUS}</nav>
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
<table class="bodyline" width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td>
	<table class="forumline head" border="0" cellpadding="0" cellspacing="0">
	  <tr>
	    <td>
<nav class="desktop-menu">
	      <table border="0" cellpadding="0" cellspacing="0">
		    <tr>
			  <td class="top"><a href="#bot" title="{L_TOPIC_DOWN_IMAGE}"><span>&nbsp;</span></a></td>
			  <td align="center" width="100%" class="qb">{QMENUS}</td>
			  <td class="top"><a href="#bot" title="{L_TOPIC_DOWN_IMAGE}"><span>&nbsp;</span></a></td>
			</tr>
		  </table>
		  <table class="topbkg" width="100%" cellspacing="0" cellpadding="0" border="0">
		    <tr> 
			  <td><a href="{U_PORTAL}"><img src="{LOGO}" width="{LOGO_WIDTH}" height="{LOGO_HEIGHT}" border="0" alt="{SITENAME}" title="{SITENAME}" /></a></td>
			  <!-- BEGIN switch_banner_0 -->
			  <td width="100%" colspan="3"><div align="right">{BANNER_0_IMG}</div></td>
			  <!-- END switch_banner_0 -->
			  <td align="center" width="100%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		    </tr>
		  </table>
</nav>
<!-- BEGIN switch_user_logged_out -->
		  <div class="finews" id="finewsdisplay"><script type="text/javascript" src="templates/fi_newsfader.js"></script></div>
<!-- END switch_user_logged_out -->
		</td>
	  </tr>
	</table>

 	<!-- BEGIN switch_lw_user_logged_in -->
	<table align="center">
  	  <tr>
        <td height="25" align="center" valign="top" nowrap="nowrap"><span class="mainmenu">&nbsp;{L_LW_EXPIRE_REMINDER}</span></td>
  	  </tr>
	</table>
	<!-- END switch_lw_user_logged_in -->
	<div id="site_description"><h1>{SITE_DESCRIPTION}</h1></div> 
	{CALENDAR_BOX}
	<!-- BEGIN switch_banner_16 -->
	<table border="0" cellspacing="0" cellpadding="0" width="100%">
	  <tr>
	    <td width="100%" align="center">{BANNER_16_IMG}</td>
	  </tr>
	</table>
	<!-- END switch_banner_16 -->
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<!-- BEGIN switch_portal_header -->
	  <tr>
	    <td width="10">&nbsp;</td>
		<td width="{HEADER_WIDTH}" valign="top">&nbsp;</td>
		<td width="10">&nbsp;</td>
		<td>&nbsp;</td>
		<td width="10">&nbsp;</td>
	  </tr>
	<!-- END switch_portal_header -->
	<!-- BEGIN switch_portal_tail -->
	  <tr>
		<td width="10">&nbsp;</td>
		<td>&nbsp;</td>
		<td width="10">&nbsp;</td>
		<td width="{FOOTER_WIDTH}" valign="top">&nbsp;</td>
		<td width="10">&nbsp;</td>
	  </tr>
	<!-- END switch_portal_tail -->
	<!-- BEGIN switch_portal_both -->
	  <tr>
		<td width="10">&nbsp;</td>
		<td width="{HEADER_WIDTH}" valign="top">&nbsp;</td>
		<td width="10">&nbsp;</td>
		<td>&nbsp;</td>
		<td width="10">&nbsp;</td>
		<td width="{FOOTER_WIDTH}" valign="top">&nbsp;</td>
		<td width="10">&nbsp;</td>
	  </tr>
	<!-- END switch_portal_both -->
	  <tr> 
	{PORTAL_HEADER}
		<td width="10"><img src="images/spacer.gif" alt="" width="10" /></td>
		<td valign="top">
