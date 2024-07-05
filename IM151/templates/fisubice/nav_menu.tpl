<script src="{ROOT_PATH}assets/js/css-menu.js"></script>
<a id="top"></a>
<nav class="menu">
  <input type="checkbox" class="responsive-menu" onclick="updatemenu()"><label></label>
  <ul>
  	<li class="menu-item genarrow arrows"><a href="#bottom" title="{L_BOTTOM}"><i class="fa-solid fa-arrow-down"></i></a></li>
    <!-- IF STARGATE -->
	<li<!-- IF S_IS_PORTAL --> class="activetab"<!-- ENDIF -->><a href="{U_PORTAL}" title="{L_PORTAL}"> {L_PORTAL} </a></li>
	<!-- ENDIF -->
    <li<!-- IF S_IS_INDEX --> class="activetab"<!-- ENDIF -->><a href="{U_INDEX}" title="{L_INDEX}"> {L_FORUM} </a></li>
	<!-- IF S_DISPLAY_SEARCH -->
    <li><a class="dropdown-arrow" href="#"> {L_SEARCH} </a>
      <ul class="sub-menus">
	    <li><a href="{U_SEARCH}"> {L_SEARCH_ADV} </a></li>
		<li><a href="{U_SEARCH_NEW}">{L_SEARCH_NEW}</a></li>
		<li><a href="{U_SEARCH_UNANSWERED}">{L_SEARCH_UNANSWERED}</a></li>
		<li><a href="{U_SEARCH_UNREAD}">{L_SEARCH_UNREAD}</a></li>
		<li><a href="{U_SEARCH_ACTIVE_TOPICS}">{L_SEARCH_ACTIVE_TOPICS}</a></li>
	    <li><a href="{U_SEARCH_SELF}">{L_SEARCH_SELF}</a></li>
	  </ul>	
    </li>
	<!-- ENDIF -->
    <li><a class="dropdown-arrow
<!-- IF S_IN_FAQ or S_IN_KNOWLEDGE_BASE or S_IN_MEMBERLIST or S_IN_DL or S_IN_HACKLIST or S_IN_GALLERY or S_IN_MCHAT or S_IN_CONTACT or S_IN_ACTIVITY or S_IN_BLOG --> activetab<!-- ENDIF -->
" href="#">
		<!-- IF SN_MODULE_ACTIVITYPAGE_ENABLED and S_IN_ACTIVITY -->{L_SN_AP_ACTIVITYPAGE}<!-- ENDIF -->			
		<!-- IF S_IN_FAQ -->{L_FAQ}<!-- ENDIF -->
		<!-- IF S_IN_KNOWLEDGE_BASE -->{L_KNOWLEDGE_BASE}<!-- ENDIF -->
		<!-- IF S_DISPLAY_MEMBERLIST and S_IN_MEMBERLIST -->{L_MEMBERLIST}<!-- ENDIF -->
		<!-- IF S_SHOW_DL_LINK and S_IN_DL -->{L_DOWNLOADS}<!-- ENDIF -->
		<!-- IF S_HACKLIST_ON and S_IN_HACKLIST -->{L_HACKLIST}<!-- ENDIF -->
		<!-- IF S_SHOW_GALL and S_IN_GALLERY -->{L_GALLERY}<!-- ENDIF -->
		<!-- IF S_MCHAT_ENABLE and U_MCHAT and S_SHOW_CHT and S_IN_MCHAT -->{L_CHAT}<!-- ENDIF -->
		<!-- IF S_CONTACT_ENABLED and S_IN_CONTACT -->{L_CONTACT_BOARD_ADMIN_SHORT}<!-- ENDIF -->
		<!-- IF S_IN_BLOG -->{L_BLOG}<!-- ENDIF -->
		<!-- IF not S_IN_ACTIVITY and not S_IN_FAQ and not S_IN_KNOWLEDGE_BASE and not S_IN_MEMBERLIST and not S_IN_DL and not S_IN_HACKLIST and not S_IN_GALLERY and not S_IN_MCHAT and not S_IN_CONTACT and not S_IN_BLOG -->{L_LINKS}<!-- ENDIF -->
      </a>
      <ul class="sub-menus">
        <li><a href="{U_FAQ}"><i class="fa-solid fa-circle-question"></i> {L_FAQ}</a></li>
        <li><a href="{U_KB}" title="{L_KB_EXPLAIN}"><i class="fa-solid fa-circle-info"></i> {L_KNOWLEDGE_BASE}</a></li>
	  <!-- IF not S_IS_BOT -->
		<!-- IF S_DISPLAY_MEMBERLIST -->
		<li><a href="{U_MEMBERLIST}"><i class="fa-solid fa-user-group"></i> {L_MEMBERLIST}</a></li>
		<!-- ENDIF -->	  
		<!-- IF S_SHOW_DL_LINK -->
		<li><a href="{U_DL_NAVS}"><i class="fa-solid fa-file-arrow-down"></i> {L_DOWNLOADS}</a></li>
		<!-- ENDIF -->
		<!-- IF S_HACKLIST_ON -->
		<li><a href="{U_HACKLIST}" title="{L_HACKLIST}"><i class="fa-solid fa-list-ul"></i> {L_HACKLIST}</a></li>
		<!-- ENDIF -->
		<!-- IF S_BUGTRACKER_ON -->
		<li><a href="{U_BUG_TRACKER}" title="{L_BUG_TRACKER}"><i class="fa-solid fa-bug"></i> {L_BUG_TRACKER}</a></li>
		<!-- ENDIF -->
		<!-- IF S_SHOW_GALL -->
		<li><a href="{U_GALLERY_MOD}" title="{L_GALLERY_EXPLAIN}"><i class="fa-regular fa-image"></i> {L_GALLERY}</a></li>
		<!-- ENDIF -->
		<!-- IF S_SHOW_CHT -->
		<li><a href="{U_CHAT}" title="{L_CHAT_EXPLAIN}"><i class="fa-solid fa-comment"></i> {L_CHAT}</a></li>
		<!-- ENDIF -->
		<!-- IF S_CONTACT_ENABLED -->
        <li><a href="{U_CONTACT}"><i class="fa-solid fa-message"></i> {L_CONTACT_BOARD_ADMIN_SHORT}</a></li>
		<!-- ENDIF -->
		<!-- BEGIN blog_links -->
		<li><a href="{blog_links.URL}"><i class="fa-solid fa-book-open-reader"></i> {blog_links.TEXT}</a></li>
		<!-- END blog_links -->
      <!-- ENDIF -->
      </ul>
    </li>
	<!-- IF not S_IS_BOT -->
	<!-- IF not S_USER_LOGGED_IN -->
    <li><a href="{U_LOGIN_LOGOUT}">&nbsp;{L_LOGIN_LOGOUT}&nbsp;</a></li>
	<!-- IF S_REGISTER_ENABLED and not (S_SHOW_COPPA or S_REGISTRATION) -->
	<li><a href="{U_REGISTER}">&nbsp;{L_REGISTER}&nbsp;</a></li>
	<!-- ENDIF -->
	<!-- ENDIF -->
	<!-- ENDIF -->
	
	
	
	
	<!-- IF S_USER_LOGGED_IN and not S_IS_BOT -->
    <li><a class="dropdown-arrow username uname" href="http:#">&nbsp;{S_USERNAME}&nbsp;</a>
      <ul class="sub-menus">
		<li><a href="{U_PROFILE}"><i class="fa-solid fa-user-gear"></i> {L_PROFILE}</a></li>
		<li><a href="{U_USER_PROFILE}" title="{L_READ_PROFILE}"><i class="fa-solid fa-address-card"></i> {L_READ_PROFILE}</a></li>
		<!-- IF S_DISPLAY_SEARCH -->
		<li><a href="{U_SEARCH_SELF}"><i class="fa-solid fa-magnifying-glass"></i> {L_SEARCH_SELF}</a></li>
		<!-- ENDIF -->
        <li><a href="{U_PERS_NOTES}"><i class="fa-regular fa-pen-to-square"></i> {L_PERS_NOTES}</a></li>
		<!-- IF U_RESTORE_PERMISSIONS -->
		<li><a href="{U_RESTORE_PERMISSIONS}"><i class="fa-solid fa-window-restore"></i> {L_RESTORE_PERMISSIONS}</a></li>
		<!-- ENDIF -->

        <li><a href="{U_LOGIN_LOGOUT}"><i class="fa-solid fa-power-off"></i> {L_LOGIN_LOGOUT}</a></li>		
      </ul>
    </li>
    <!-- ENDIF -->
  	<li class="menu-item genarrow arrows right-arrow"><a href="#bottom" title="{L_BOTTOM}"><i class="fa-solid fa-arrow-down"></i></a></li>

	<li class="style lightstyle"><a href="#" onclick="setActiveStyleSheet('light'); return false;" title="{L_STYLE_LIGHT}"><i class="fa-solid fa-lightbulb fa-lg"></i></a></li>
    <li class="style darkstyle"><a href="#" onclick="setActiveStyleSheet('dark'); return false;" title="{L_STYLE_DARK}"><i class="fa-solid fa-lightbulb fa-lg" style="color: #747576;"></i></a></li> 

  </ul>
  <li class="genarrow sm-right-arrow"><a href="#bottom" title="{L_BOTTOM}"><i class="fa-solid fa-arrow-down"></i></a></li>
  <div class="sm-style lightstyle"><a href="#" onclick="setActiveStyleSheet('light'); return false;" title="{L_STYLE_LIGHT}"><i class="fa-solid fa-lightbulb fa-lg"></i></a></div>
  <div class="sm-style darkstyle"><a href="#" onclick="setActiveStyleSheet('dark'); return false;" title="{L_STYLE_DARK}"><i class="fa-solid fa-lightbulb fa-lg" style="color: #747576;"></i></a></div> 
</nav>