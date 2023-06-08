<!DOCTYPE html>
<html dir="{S_CONTENT_DIRECTION}">

<head>
<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}">
<meta http-equiv="Content-Style-Type" content="text/css">{META_HTTP_EQUIV_TAGS}
<title>{SITENAME} - {PAGE_TITLE}</title>{META_TAGS}
{META}
{NAV_LINKS}
<!--[if gte IE 5]><![if lt IE 7]><script src="templates/_js/pngfix.js"></script><![endif]><![endif]--> 
<link rel="shortcut icon" href="./favicon.ico">
<link rel="stylesheet" href="{TEMPLATE}{T_HEAD_STYLESHEET}" type="text/css" />
<script src="templates/_js/toggle_display.js"></script>
<script src="templates/_js/importal.js"></script>

<!-- BEGIN switch_enable_pm_popup -->
<script>
<!--
if ( {PRIVATE_MESSAGE_NEW_FLAG} )
{
window.open('{U_PRIVATEMSGS_POPUP}', '_phpbbprivmsg', 'HEIGHT=225,resizable=yes,WIDTH=400');;
}
//-->
</script>
<!-- END switch_enable_pm_popup -->
<!-- Start add - No copy MOD -->
<script>
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
<script>
<!--
window.open('{birthday_popup.U_BIRTHDAY_POPUP}', '_phpbbbirthday', 'HEIGHT=225,resizable=yes,WIDTH=400');
//-->
</script>
<!-- END birthday_popup -->
<script> 
<!-- 
function tour() { 
window.open("tour.php", "_tour", "width=800,height=600,scrollbars,resizable=yes");
} 
//--> 
</script>
<script src="templates/_js/mouseover.js"></script>
<!-- Prillian - Begin Code Additions -->
<!-- BEGIN switch_user_logged_in -->
<script>
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
<script>
if ( {buddy_alert.BUDDY_ALERT} )
{
window.open('{buddy_alert.U_BUDDY_ALERT}', '_buddyalert', 'HEIGHT=225,resizable=yes,WIDTH=400');
}
</script>
<!-- END buddy_alert -->
<!-- Prillian - End Code Additions -->
<script src="templates/_js/jquery-1.12.0.min.js"></script>
<script src="templates/_js/jquery.easing.min.js"></script>
<script src="templates/_js/jquery.toggle.js"></script>
<script src="templates/_js/jQuery.mobTabMenu.js"></script>
<script src="templates/_js/immenu.js"></script>
<link rel="stylesheet" type="text/css" href="{TEMPLATE}/report_hack.css" />
{COLOR_CSS}

<script type="text/javascript" src="templates/_js/fi_newsfader_user.js"></script>
<style type="text/css">
<!--
   .finews {
     height: 20px;
     text-align: center;
   }
-->
</style>
<script>
jQuery.noConflict();
jQuery(document).ready(function(){
 	// hides the fastreply as soon as the DOM is ready
 	// (a little sooner than page load)
  	jQuery('.fastreply').hide();
 	// toggles the fastreply on clicking the link
  	jQuery('a.fast-reply').click(function() {
 		jQuery('.fastreply').toggle(500);
 		return false;
  		});
	});

	jQuery.noConflict();
	jQuery(document).ready(function(){
		jQuery("a.button").click(function(){
		jQuery(this).toggleClass("active").next().slideToggle();
		});

	});
</script>
</head>

<body>

<!-- BEGIN switch_board_disabled -->
    <table width="100%" cellspacing="0" cellpadding="10" border="0" align="center"> 
	<tr> 
	<td align="center"><span class="alert"><b>{L_BOARD_DISABLE}</b></span></td>
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

<div>{QBARS}</div>
<a name="top" id="top" ></a>
<table class="bodyline" width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
<td>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="100%">&nbsp;</td>
<td align="right" nowrap="nowrap"><br /><span style="font:bold 14 Arial;"><font color="#0000FF"><b>Integra</b></font>ting <font color="#F26521"><b>MOD</b></font>ifications</span></td>
<td>&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="top"><a href="#bot" title="{L_TOPIC_DOWN_IMAGE}"><span>&nbsp;</span></a></td>
		<td align="center" width="100%" class="qb">{QMENUS}</td>
		<td class="top"><a href="#bot" title="{L_TOPIC_DOWN_IMAGE}"><span>&nbsp;</span></a></td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td align="left" valign="top"><img src="{TEMPLATE}images/header_bot.gif" width="589" height="23" border="0" alt="" /></td>
<td valign="top" width="100%">
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="headerbot3"><img src="{TEMPLATE}images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
</td>
<td align="right" valign="top"><img src="{TEMPLATE}images/header_bot2.gif" width="240" height="13" border="0" alt="" /></td>
<td valign="top" width="15">
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tblbot"><img src="{TEMPLATE}images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="{TEMPLATE}images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
</td>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="8"><img src="{TEMPLATE}images/spacer.gif" alt="" width="8" height="4" /></td>
<td width="178" align="center"><img src="{TEMPLATE}images/logo.gif" width="178" height="39" border="0" alt="" /></td>
<td width="4"><img src="{TEMPLATE}images/spacer.gif" alt="" width="4" height="4" /></td>
<td width="10" class="rightborder1"><img src="{TEMPLATE}images/spacer.gif" alt="" width="10" height="4" /></td>
<td width="5"><img src="{TEMPLATE}images/spacer.gif" alt="" width="5" height="4" /></td>
<td width="100%" align="center">
  <div class="finews" id="finewsdisplay">
  <script type="text/javascript" src="templates/_js/fi_newsfader.js"></script>
  </div>
</td>
<td width="5"><img src="{TEMPLATE}images/spacer.gif" alt="" width="5" height="4" /></td>
<td width="5"><img src="{TEMPLATE}images/spacer.gif" alt="" width="5" height="4" /></td>
</tr>
<tr>
<td class="headerdiv" colspan="9"></td>
</tr>
</table>
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
<td class="row1" width="10">&nbsp;</td>
<td class="row1" width="{HEADER_WIDTH}" valign="top">&nbsp;</td>
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
<td width="10"><img src="{TEMPLATE}images/spacer.gif" alt="" width="10" /></td>
<td valign="top">
