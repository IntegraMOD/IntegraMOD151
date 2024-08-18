<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="{S_CONTENT_DIRECTION}" lang="en" xml:lang="en">
<head>
<meta charset="{S_CONTENT_ENCODING}" />
<meta http-equiv="Content-Style-Type" content="text/css">{META_HTTP_EQUIV_TAGS}
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="copyright" content="2001, 2024 Integramod Team" />

<!-- Vendor CSS Files -->
<link href="templates/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="templates/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="templates/assets/vendor/aos/aos.css" rel="stylesheet">
<link href="templates/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="templates/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

<title>{SITENAME} - {PAGE_TITLE}</title>{META_TAGS}
{META}
{NAV_LINKS}
<!--[if gte IE 5]><![if lt IE 7]><script src="templates/assets/js/pngfix.js"></script><![endif]><![endif]--> 
<link rel="shortcut icon" href="./favicon.ico">
<link rel="stylesheet" href="{TEMPLATE}{T_HEAD_STYLESHEET}" type="text/css" />
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="templates/assets/js/toggle_display.js"></script>
<script src="templates/assets/js/importal.js"></script>
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
<script src="templates/assets/js/mouseover.js"></script>

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
<script src="templates/assets/js/jquery.toggle.js"></script>
<script src="templates/assets/js/css-menu.js"></script>

{COLOR_CSS}
</head>
<body>
<!-- BEGIN switch_board_disabled -->
<div class="container-fluid">
  <div class="row"> 
    <div class="col">
      <div class="forumline" align="center"><span class="alert"><b>{L_BOARD_DISABLE}</b></span></div>
    </div>
  </div>
</div>
<!-- END switch_board_disabled -->

<!-- Start add - Complete banner MOD -->
<!-- Banners -->
<div class="container-fluid">
  <div class="row"> 
    <div class="col-3 mx-auto">
      <!-- BEGIN switch_banner_1 -->
      <div>{BANNER_1_IMG}</div>
	  <!-- END switch_banner_1 -->
	  <!-- BEGIN switch_banner_2 -->
      <div>{BANNER_2_IMG}</div>
	  <!-- END switch_banner_2 -->
    </div>

    <div class="col-6 mx-auto">
	  <!-- BEGIN switch_banner_3 -->
      <div>{BANNER_3_IMG}</div>
	  <!-- END switch_banner_3 -->
	  <!-- BEGIN switch_banner_4 -->
      <div>{BANNER_4_IMG}</div>
	  <!-- END switch_banner_4 -->
    </div>

    <div class="col-3 mx-auto">
	  <!-- BEGIN switch_banner_5 -->
      <div>{BANNER_5_IMG}</div>
	  <!-- END switch_banner_5 -->
	  <!-- BEGIN switch_banner_26 -->
      <div>{BANNER_6_IMG}</div>
	  <!-- END switch_banner_6 -->
    </div>
  </div>
</div>
<!-- End Banners -->
<!-- End add - Complete banner MOD -->

{QBARS}
{QRMENUS}

<a id="top"></a>
<div class="container-fluid bodyline px-0 mx-0 mb-2">
  <div class="row">
    <div class="col">
	
	<div class="container-fluid">
      <div class="row topbkg">
	    <div class="col align-self-center">
		  <div class="row">
	        <div class="col-6 m-auto"><a href="{U_PORTAL}"><img class="img-fluid" src="{LOGO}" width="{LOGO_WIDTH}" height="{LOGO_HEIGHT}" alt="{SITENAME}" title="{SITENAME}" /></a></div>
		    <!-- BEGIN switch_banner_0 -->
		    <div class="col-6 m-auto">{BANNER_0_IMG}</div>
		    <!-- END switch_banner_0 -->
		  </div>

        </div>
      </div>
	</div>
	

	<nav class="container-fluid menu nav mx-auto px-0">
	  <input type="checkbox" class="responsive-menu" onclick="updatemenu()"><label></label>
	  <ul class="text-nowrap">
		<li class="menu-item genarrow arrows float-start ms-0"><a href="#bottom" title="{L_BOTTOM}"><i class="fa-solid fa-arrow-down"></i></a></li>
		{QMENUS}&nbsp;&bull;&nbsp;
		<li><a class="dropdown-arrow" href="#"> {L_SEARCH} </a>
		  <ul class="sub-menus">
			<li><a href="{U_SEARCH}">{L_SEARCH}</a></li>
			<li><a href="{U_SEARCH_UNANSWERED}">{L_SEARCH_UNANSWERED}</a></li>
 	        <!-- BEGIN switch_user_logged_in -->
			<li><a href="{U_SEARCH_NEW}">{L_SEARCH_NEW}</a></li>
			<li><a href="{U_SEARCH_UNREAD}">{L_SEARCH_UNREAD}</a></li>
			<li><a href="{U_SEARCH_ACTIVE_TOPICS}">{L_SEARCH_ACTIVE_TOPICS}</a></li>
			<li><a href="{U_SEARCH_SELF}">{L_SEARCH_SELF}</a></li>
 	        <!-- END switch_user_logged_in -->
		  </ul>	
		</li>
 	    <!-- BEGIN switch_user_logged_in -->
		<li><a class="dropdown-arrow username uname" href="#">&nbsp;{U_THISUSER}&nbsp;</a>
		  <ul class="sub-menus">
			<li><a href="{U_PROFILE}"><i class="fa-solid fa-user-gear"></i> {L_PROFILE}</a></li>
			<li><a href="{U_USER_PROFILE}" title="{L_READ_PROFILE}"><i class="fa-solid fa-address-card"></i> {L_READ_PROFILE}</a></li>
			<!-- IF S_DISPLAY_SEARCH -->
			<li><a href="{U_SEARCH_SELF}"><i class="fa-solid fa-magnifying-glass"></i> {L_SEARCH_SELF}</a></li>
			<!-- ENDIF -->
			<li>{ADMIN_SHORT_LINK}</li>
			<li><a href="{U_LOGIN_LOGOUT}"><i class="fa-solid fa-power-off"></i> {L_LOGIN_LOGOUT}</a></li>		
		  </ul>
		</li>
 	    <!-- END switch_user_logged_in -->
		<li class="menu-item genarrow arrows right-arrow me-0"><a href="#bottom" title="{L_BOTTOM}"><i class="fa-solid fa-arrow-down"></i></a></li>
	  </ul>
	</nav>

	<!-- BEGIN ctracker_message -->
	<div class="row py-1"></div>
	<div class="container forumline">
      <div class="row">
	    <div align="center" style="background-color:#{ctracker_message.ROW_COLOR};"><img src="{ctracker_message.ICON_GLOB}" alt="" title="" border="0"></div>
		<div align="center" style="background-color:#{ctracker_message.ROW_COLOR};"><span class="gensmall">{ctracker_message.L_MESSAGE_TEXT}</span></div>
	  </div>
      <div class="row">
		<div align="center" class="row2" colspan="2"><span class="gensmall"><b><a href="{ctracker_message.U_MARK_MESSAGE}">{ctracker_message.L_MARK_MESSAGE}</a></b></span></div>
	  </div>
	</div>
	<!-- END ctracker_message -->

	<div class="row py-2"></div>

 	<!-- BEGIN switch_lw_user_logged_in -->
    <div class="row"> 
      <div class="col mx-auto">
      <span class="mainmenu">&nbsp;{L_LW_EXPIRE_REMINDER}</span>
    </div>
	<!-- END switch_lw_user_logged_in -->

    <div class="row"> 
      <div class="col ctr mx-auto"><h1>{SITE_DESCRIPTION}</h1></div>
	</div>

    <div class="row"> 
      <div class="col align-right">{CALENDAR_BOX}</div>
    </div>

	<!-- BEGIN switch_banner_16 -->
    <div class="container">
	  <div class="row"> 
	    <div class="col mx-auto">
		  <div>{BANNER_16_IMG}</div>
	    </div>
	  </div>
	</div>
	<!-- END switch_banner_16 -->

  
<table width="100%" border="0" cellspacing="0" cellpadding="6">
  <tr> 
  {PORTAL_HEADER}
    <td valign="top">