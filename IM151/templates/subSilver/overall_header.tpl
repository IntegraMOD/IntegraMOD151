<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" dir="{S_CONTENT_DIRECTION}" lang="en" xml:lang="en">
<head>
<meta charset="{S_CONTENT_ENCODING}" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="copyright" content="2001, 2005 phpBB Group" />
<!-- Bootstrap CSS -->
<!--
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 -->
<link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
{META_HTTP_EQUIV_TAGS}
<title>{SITENAME} - {PAGE_TITLE}</title>{META_TAGS}
{META}
{NAV_LINKS}
<!--[if gte IE 5]><![if lt IE 7]><script src="templates/_js/pngfix.js"></script><![endif]><![endif]--> 
<link rel="shortcut icon" href="./favicon.ico">
<link rel="stylesheet" href="{TEMPLATE}{T_HEAD_STYLESHEET}" type="text/css" />
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="templates/_js/toggle_display.js"></script>
<script src="templates/_js/importal.js"></script>
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
// ]]>
</script>
<!-- End add - No copy MOD -->
<!-- BEGIN birthday_popup -->
<script>
// <![CDATA[
window.open('{birthday_popup.U_BIRTHDAY_POPUP}', '_phpbbbirthday', 'HEIGHT=225,resizable=yes,WIDTH=400');
// ]]>
</script>
<!-- END birthday_popup -->
<script> 
// <![CDATA[
function tour() { 
window.open("tour.php", "_tour", "width=800,height=600,scrollbars,resizable=yes");
} 
// ]]> 
</script>
<script src="templates/_js/mouseover.js"></script>

<!-- Prillian - Begin Code Additions -->
<!-- BEGIN switch_user_logged_in -->
<script>
// <![CDATA[
function prill_launch(url, w, h)
{
window.name = 'phpbbmain';
prillian = window.open(url, 'prillian', 'height=' + h + ', width=' + w + ', innerWidth=' + w + ', innerHeight=' + h + ', resizable, scrollbars');
}
if ( {IM_AUTO_POPUP} ) 
{ 
prill_launch('{U_IM_LAUNCH}', '{IM_WIDTH}', '{IM_HEIGHT}');
} 
// ]]>
</script>
<!-- END switch_user_logged_in -->

<!-- BEGIN buddy_alert -->
<script>
// <![CDATA[
if ( {buddy_alert.BUDDY_ALERT} )
{
window.open('{buddy_alert.U_BUDDY_ALERT}', '_buddyalert', 'HEIGHT=225,resizable=yes,WIDTH=400');
}
// ]]>
</script>
<!-- END buddy_alert -->
<!-- Prillian - End Code Additions -->
<script src="templates/_js/jquery.toggle.js"></script>
<script src="templates/_js/immenu.js"></script>
{COLOR_CSS}
</head>
<body>
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
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
		<tr> 
		  <td><a href="{U_PORTAL}"><img src="{LOGO}" width="{LOGO_WIDTH}" height="{LOGO_HEIGHT}" border="0" alt="{SITENAME}" title="{SITENAME}" /></a></td>
		  <!-- BEGIN switch_banner_0 -->
		  <td width="100%" colspan="3"><div align="right">{BANNER_0_IMG}</div></td>
		  <!-- END switch_banner_0 -->
		  <td align="center" width="100%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
	  </table>
      <br />
	  <table class="btmnav" cellpadding="0" cellspacing="0">
	    <tr>
		  <td align="right"><a href="#bot"><div class="hdr_right"><img src="images/spacer.gif" height="28" width="30" title="{L_TOPIC_DOWN_IMAGE}" border="0" alt="{L_TOPIC_UP_IMAGE}" /></div></td>
		  <td class="" align="center" width="100%">{QMENUS}</td>
		  <td align="left"><a href="#bot"><div class="hdr_left"><img src="images/spacer.gif" height="28" width="30" title="{L_TOPIC_DOWN_IMAGE}" border="0" alt="{L_TOPIC_UP_IMAGE}" /></div></td>
	    </tr>
	  </table>
	  <table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"></td><td class="tblbot"></td><td class="tblr"></td></tr></table>
	  &nbsp;<strong><font color="#006699">{SITE_DESCRIPTION}</font></strong> 
	  <!-- BEGIN ctracker_message -->
	  <br />
	  <div align="center">
		<table width="80%" cellspacing="1" cellpadding="3" border="0" class="forumline">
			<tr>
				<td align="center" style="background-color:#{ctracker_message.ROW_COLOR};"><img src="{ctracker_message.ICON_GLOB}" alt="" title="" border="0"></td>
				<td align="center" style="background-color:#{ctracker_message.ROW_COLOR};"><span class="gensmall">{ctracker_message.L_MESSAGE_TEXT}</span></td>
			</tr>
			<tr>
				<td align="center" class="row2" colspan="2"><span class="gensmall"><b><a href="{ctracker_message.U_MARK_MESSAGE}">{ctracker_message.L_MARK_MESSAGE}</a></b></span></td>
			</tr>
		</table>
	  </div>
      <br />
      <!-- END ctracker_message -->
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
<!--
	    <!-- BEGIN switch_portal_header -->
	    <tr>
	      <td width="10">&nbsp;</td>
		  <td width="{HEADER_WIDTH}" valign="top">&nbsp;</td>
		  <td width="10">&nbsp;</td>
		  <td>&nbsp;</td>
		  <td width="10">&nbsp;</td>
	    </tr>
	    <!-- END switch_portal_header -->
-->
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