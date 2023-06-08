<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="{S_CONTENT_DIRECTION}" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}">
<meta http-equiv="Content-Style-Type" content="text/css">{META_HTTP_EQUIV_TAGS}
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="copyright" content="2004, 2023 Integramod Team">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
<link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<title>{SITENAME} - {PAGE_TITLE}</title>{META_TAGS}
<link rel="icon" type="image/x-icon" href="images/favicon.ico">
<link rel="stylesheet" href="{TEMPLATE}{T_HEAD_STYLESHEET}" type="text/css" 
<link rel="stylesheet" type="text/css" href="{TEMPLATE}/report_hack.css" />


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
{COLOR_CSS}
</head>
<body>
<a id="top"></a>
<!-- BEGIN switch_board_disabled -->
<div class="container-fluid">
  <div class="row"> 
    <div class="col">
      <div class="forumline text-center"><span class="alert"><b>{L_BOARD_DISABLE}</b></span></div>
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
<div class="container-fluid mx-0 px-0 px-sm-4"> 
  <div class="row"> 
    <div class="col mx-0 my-2">
       <div class="container-fluid bodyline mx-0 px-0 pt-0 pb-2">
          <div class="row justify-content-center"> 
			<div class="col">
            <!-- Navbar begin -->				    
              <nav class="navbar navbar-expand-lg navbar-light rowpic hr7" aria-label="{SITENAME}">
                <div class="container-fluid mx-0">
                  <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="offcanvas offcanvas-start row1" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                      <h5 class="offcanvas-title navbar-toggler" type="button" data-bs-toggle="offcanvas" id="offcanvasNavbarLabel">{SITENAME}</h5>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0">
                      <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 align-items-center">
						<li class="nav-item gensmall wrap-word break-word">{QMENUS}</li>
                      </ul>
                      <form action="{U_SEARCH}" method="get" id="search">
                        <fieldset>
                        <input name="search_keywords" id="keywords" class="form-control" type="text" placeholder="Search" aria-label="Search">
                        {S_HIDDEN_FIELDS}
                        </fieldset>
                      </form>          
                    </div>
                  </div>
                </div>
              </nav>
            <!-- Navbar end -->
			<div class="container-fluid px-0">
			  <div class="row topbkg mx-0 hr6">
				<div class="col align-self-center">
				  <div class="row">
					<div class="col text-start"><a class="navbar-brand" href="{U_PORTAL}"><img class="img-fluid" src="{LOGO}" width="{LOGO_WIDTH}" height="{LOGO_HEIGHT}" alt="{SITENAME}" title="{SITENAME}" /></a></div>
					<!-- BEGIN switch_banner_0 -->
					<div class="col m-auto">{BANNER_0_IMG}</div>
					<!-- END switch_banner_0 -->
				  </div>
				  <div class="row">
					<div class="col py-2"></div>
				  </div>
				</div>
			  </div>
			</div>
            <div class="container-fluid pt-3">
              <div class="row d-flex align-items-center">
                 <div class="col text-center maintitle">{SITENAME}</div>
			  </div>	 
			  <div class="row d-flex align-items-center">
			     <div class="col text-center navbr">{SITE_DESCRIPTION}</div>
		      </div>
		    </div>
		  </div>
		  <div class="row"> 
		    <div class="col text-end">{CALENDAR_BOX}</div>
		  </div>		  
		</div>
		<!-- BEGIN ctracker_message -->
		<div class="row py-1"></div>
		<div class="container forumline">
		  <div class="row">
			<div class="text-center" style="background-color:#{ctracker_message.ROW_COLOR};"><img src="{ctracker_message.ICON_GLOB}" alt="" title="" border="0"></div>
			<div class="text-center gensmall" style="background-color:#{ctracker_message.ROW_COLOR};">{ctracker_message.L_MESSAGE_TEXT}</div>
		  </div>
		  <div class="row">
			<div class="row2 text-center gensmall"><strong><a href="{ctracker_message.U_MARK_MESSAGE}">{ctracker_message.L_MARK_MESSAGE}</a></strong></div>
		  </div>
		</div>
		<!-- END ctracker_message -->
		<div class="row py-2"></div>
		<!-- BEGIN switch_lw_user_logged_in -->
		<div class="row"> 
		  <div class="col mx-auto mainmenu">&nbsp;{L_LW_EXPIRE_REMINDER}</div>
		</div>
		<!-- END switch_lw_user_logged_in -->
		<!-- BEGIN switch_banner_16 -->
		<div class="container">
		  <div class="row"> 
			<div class="col mx-auto">{BANNER_16_IMG}</div>
		  </div>
		</div>
		<!-- END switch_banner_16 -->
		<div class="container-fluid">
<!--		
		<!-- BEGIN switch_portal_header -->
		  <div class="row">
			<div class="w-10">&nbsp;</div>
			<div class="" width="{HEADER_WIDTH}" valign="top">&nbsp;</div>
			<div class="w-10">&nbsp;</div>
			<div class="">&nbsp;</div>
			<div class="w-10">&nbsp;</div>
		  </div>
		  <!-- END switch_portal_header -->
-->
		  <!-- BEGIN switch_portal_tail -->
		  <div class="row">
			<div class="w-10">&nbsp;</div>
			<div class="">&nbsp;</div>
			<div class="w-10">&nbsp;</div>
			<div class="" width="{FOOTER_WIDTH}" valign="top">&nbsp;</div>
			<div class="w-10">&nbsp;</div>
		  </div>
		  <!-- END switch_portal_tail -->
		  <!-- BEGIN switch_portal_both -->
		  <div class="row">
			<div class="w-10">&nbsp;</div>
			<div class="" width="{HEADER_WIDTH}" valign="top">&nbsp;</div>
			<div class="w-10">&nbsp;</div>
			<div class="">&nbsp;</div>
			<div class="w-10">&nbsp;</div>
			<div class="" width="{FOOTER_WIDTH}" valign="top">&nbsp;</div>
			<div class="w-10">&nbsp;</div>
		  </div>
		  <!-- END switch_portal_both -->
		  <div class="row align-items-start">
		  {PORTAL_HEADER}
			<div class="col-sm pl-0">
			  <div class="">	
