<!DOCTYPE html>
<html dir="{S_CONTENT_DIRECTION}">

<head>
<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta http-equiv="Content-Style-Type" content="text/css">{META_HTTP_EQUIV_TAGS}
<title>{SITENAME} - {PAGE_TITLE}</title>{META_TAGS}
{META}
{NAV_LINKS}
<!--[if gte IE 5]><![if lt IE 7]><script type="text/javascript" src="templates/pngfix.js"></script><![endif]><![endif]--> 
<link rel="shortcut icon" href="./favicon.ico">
<link rel="stylesheet" href="{TEMPLATE}{T_HEAD_STYLESHEET}" type="text/css">
<link rel="stylesheet" href="css/font-awesome.css" type="text/css">
<link rel="stylesheet" type="text/css" href="{TEMPLATE}/css/font-awesome-min.css">
<script type="text/javascript" src="templates/toggle_display.js"></script>
<script type="text/javascript" src="templates/importal.js"></script>
<!-- BEGIN switch_enable_pm_popup -->
<script type="text/javascript">
// <![CDATA[
if ( {PRIVATE_MESSAGE_NEW_FLAG} )
{
window.open('{U_PRIVATEMSGS_POPUP}', '_phpbbprivmsg', 'HEIGHT=225,resizable=yes,WIDTH=400');;
}
// ]]>
</script>
<!-- END switch_enable_pm_popup -->
<!-- Start add - No copy MOD -->
<script language="javascript">
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
<script type="text/javascript">
// <![CDATA[
window.open('{birthday_popup.U_BIRTHDAY_POPUP}', '_phpbbbirthday', 'HEIGHT=225,resizable=yes,WIDTH=400');
// ]]>
</script>
<!-- END birthday_popup -->
<script type="text/javascript"> 
// <![CDATA[
function tour() { 
window.open("tour.php", "_tour", "width=800,height=600,scrollbars,resizable=yes");
} 
// ]]> 
</script>
<script type="text/javascript" src="templates/mouseover.js"></script>
<!-- Prillian - Begin Code Additions -->
<!-- BEGIN switch_user_logged_in -->
<script type="text/javascript">
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
<script type="text/javascript">
// <![CDATA[
if ( {buddy_alert.BUDDY_ALERT} )
{
window.open('{buddy_alert.U_BUDDY_ALERT}', '_buddyalert', 'HEIGHT=225,resizable=yes,WIDTH=400');
}
// ]]>
</script>
<!-- END buddy_alert -->
<!-- Prillian - End Code Additions -->
<script type="text/javascript" src="templates/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="templates/jquery.easing.min.js"></script>
<script type="text/javascript" src="templates/jquery.toggle.js"></script>
<script type="text/javascript" src="templates/jQuery.mobTabMenu.js"></script>
<script type="text/javascript" src="templates/immenu.js"></script>

</head>
<body class="resp">
<div id="mobile-bar">
	<a href="#" class="mob-tab-menu-toggle toggle"></a>
</div>
<nav class="mobile-menu" style="display: none;">{QMENUS}</nav>

<!-- BEGIN switch_board_disabled -->
<div class="divTable">
	<div class="divTableBody">
		<div class="divTableRow">
			<div class="divTableCell center bx"><span class="alert"><strong>{L_BOARD_DISABLE}</strong></span></div>
		</div>
	</div>
</div>
<!-- END switch_board_disabled -->
<!-- Start add - Complete banner MOD -->
<!-- Banners -->
<div class="BannerDivTable">
	<div class="BannerDivTableBody">
		<div class="BannerDivTableRow">
			<div class="BannerDivTableCell">
				<div class="BannerDivTable">
					<div class="BannerDivTableBody">
						<!-- BEGIN switch_banner_1 -->
						<div class="BannerDivTableRow">
							<div class="BannerDivTableCell">
								<div align="center">{BANNER_1_IMG}</div>
							</div>
						</div>
						<!-- END switch_banner_1 --> 
						<!-- BEGIN switch_banner_2 -->
						<div class="BannerDivTableRow">
							<div class="BannerDivTableCell">
								<div align="center">{BANNER_2_IMG}</div>
							</div>
						</div>
						<!-- END switch_banner_2 -->
					</div>
				</div>
			</div>
			<div class="BannerDivTableCell">
				<div class="BannerDivTable">
					<div class="BannerDivTableBody">
						<!-- BEGIN switch_banner_3 -->
						<div class="BannerDivTableRow">
							<div class="BannerDivTableCell">
								<div align="center">{BANNER_3_IMG}</div>
							</div>
						</div>
						<!-- END switch_banner_3 --> 
						<!-- BEGIN switch_banner_4 -->
						<div class="BannerDivTableRow">
							<div class="BannerDivTableCell">
								<div align="center">{BANNER_4_IMG}</div>
							</div>
						</div>
						<!-- END switch_banner_4 -->
					</div>
				</div>
			</div>
			<div class="BannerDivTableCell">
				<div class="BannerDivTable">
					<div class="BannerDivTableBody">
						<!-- BEGIN switch_banner_5 -->
						<div class="BannerDivTableRow">
							<div class="BannerDivTableCell">
								<div align="center">{BANNER_5_IMG}</div>
							</div>
						</div>
						<!-- END switch_banner_5 --> 
						<!-- BEGIN switch_banner_6 -->
						<div class="BannerDivTableRow">
							<div class="BannerDivTableCell">
								<div align="center">{BANNER_6_IMG}</div>
							</div>
						</div>
						<!-- END switch_banner_6 -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Banners -->
<!-- End add - Complete banner MOD -->
{QBARS}
<a name="top" id="top"></a>
<table class="bodyline" width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td>
			<div class="divTable topbkg">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell" style="width:{LOGO_WIDTH}px!important;"><a href="{U_PORTAL}"><img title="{SITENAME}" src="{LOGO}" alt="{SITENAME}" style="width:100%;max-width:{LOGO_WIDTH}px!important;height:auto;" /></a></div>
<nav class="desktop-menu">
						<!-- BEGIN switch_banner_0 -->
						<div class="divTableCell bcv">
							<div>{BANNER_0_IMG}</div>
						</div>
						<!-- END switch_banner_0 -->
</nav>
						<div class="divTableCell"><img src="images/spacer.gif" alt="" width="4" height="1" /></div>

					</div>
				</div>
			</div>
<nav class="desktop-menu">
			<div class="divTable topnav">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divQTableCell">
							<div><a class="icon_go_bottom" href="#bot" title="{L_GO_TO_BOTTOM}">&nbsp;</a></div>
						</div>
						<div class="divQTableCell cv">{QMENUS}</div>
						<div class="divQTableCell">
							<div><a class="icon_go_bottom" href="#bot" title="{L_GO_TO_BOTTOM}">&nbsp;</a></div>
						</div>
					</div>
				</div>
			</div>
</nav>
			<!-- BEGIN ctracker_message -->
			<br />
			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell"><img title="" src="{ctracker_message.ICON_GLOB}" alt="" border="0" /></div>
						<div class="divTableCell"><span class="gensmall">{ctracker_message.L_MESSAGE_TEXT}</span></div>
					</div>
					<div class="divTableRow">
						<div class="divTableCell"><span class="gensmall"><strong><a href="{ctracker_message.U_MARK_MESSAGE}">{ctracker_message.L_MARK_MESSAGE}</a></strong></span></div>
					</div>
				</div>
			</div>
			<!-- END ctracker_message -->
			<br />

 			<!-- BEGIN switch_lw_user_logged_in -->
			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell"><span class="mainmenu">&nbsp;{L_LW_EXPIRE_REMINDER}</span></div>
					</div>
				</div>
			</div>
			<!-- END switch_lw_user_logged_in -->

			<h1>{SITE_DESCRIPTION}</h1> 
			{CALENDAR_BOX}
			<!-- BEGIN switch_banner_16 -->
			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell">{BANNER_16_IMG}</div>
					</div>
				</div>
			</div>
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
