<!-- BEGIN switch_banner_18 -->
<div class="container-fluid">
  <div class="row">
    <div class="col">{BANNER_18_IMG}</div>
  </div>
</div>
<br />
<!-- END switch_banner_18 -->

<div class="container-fluid">
  <div class="row">
    <div class="col gensmall">
    <a href="{U_INDEX}" class="navbr">{L_INDEX}</a>{NAV_CAT_DESC}<br />
    <!-- BEGIN switch_user_logged_in -->
    {LAST_VISIT_DATE}<br />
    <!-- END switch_user_logged_in -->
    <!-- BEGIN switch_user_logged_out -->
    {LAST_VISIT_DATE}<br />
    <!-- END switch_user_logged_out -->
    {CURRENT_TIME}
    </div>
    <div class="col text-end">
    <a href="{U_SEARCH_UNANSWERED}">{L_SEARCH_UNANSWERED}</a><br />
	<!-- BEGIN switch_user_logged_out -->
	<a href="{U_SEARCH_NEW}" class="gensmall">{L_SEARCH_NEW}</a><br />
	<!-- END switch_user_logged_out -->
	<!-- BEGIN switch_user_logged_in -->
	<a href="{U_SEARCH_NEW}">{L_SEARCH_NEW}</a><br />
	<a href="{U_MARK_READ}"><strong>{L_MARK_FORUMS_READ}</strong></a>
	<!-- END switch_user_logged_in -->
	</div>
  </div>
</div>
{BOARD_ANNOUNCES}
{BOARD_INDEX}
<div class="container" align="center">
  <div class="row text-center">
	<div class="col-3 text-start"></div>
	<div class="col"><img src="{FORUM_NEW_IMG}" alt="{L_NEW_POSTS}" title="{L_NEW_POSTS}" />&nbsp;<span class="gensmall">{L_NEW_POSTS}</span></div>
	&nbsp;
	<div class="col"><img src="{FORUM_IMG}" alt="{L_NO_NEW_POSTS}" title="{L_NO_NEW_POSTS}" />&nbsp;<span class="gensmall">{L_NO_NEW_POSTS}</span></div>
	&nbsp;
	<div class="col"><img src="{FORUM_LOCKED_IMG}" alt="{L_FORUM_LOCKED}" title="{L_FORUM_LOCKED}" />&nbsp;<span class="gensmall">{L_FORUM_LOCKED}</span></div>
	<div class="col-3 text-end"></div>
  </div>
</div>
<br />


<div class="container-fluid mx-0">
<!-- BEGIN switch_user_logged_out -->
  <div class="row">
    <div class="col">
      <form method="post" action="{S_LOGIN_ACTION}">
      <div class="container-fluid forumline mx-0">
	    <div class="row cat">
		  <div class="col cattitle">{L_LOGIN_LOGOUT}</div>
	    </div>
	    <div class="row">
		  <div class="col row1 text-center">
		  
		  
		  
		   <div class="container-fluid mx-0"> 
			  <div class="row"> 
			    <div class="col gensmall">{L_USERNAME}:&nbsp;</div>
			    <div class="col"><input class="post" type="text" name="username" size="10" /></div>
			    <div class="col gensmall">&nbsp;&nbsp;&nbsp;{L_PASSWORD}:</div>
			    <div class="col"><input class="post" type="password" name="password" size="10" maxlength="32" /></div>
			    <!-- BEGIN switch_allow_autologin -->
			    <div class="col gensmall">&nbsp;&nbsp;&nbsp;{L_AUTO_LOGIN}</div>
			    <div class="col"><input class="text" type="checkbox" name="autologin" /></div>
			    <!-- END switch_allow_autologin -->
			    <div class="col">&nbsp;&nbsp;<input type="submit" class="mainoption" name="login" value="{L_LOGIN}" /></div>
			  </div>
		    </div>
			
			
			
 		  </div>
	    </div>
	  </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col">&nbsp;</div>
  </div>
  <!-- END switch_user_logged_out -->
  <div class="row">
	<div class="col px-0">
	
	
      <div class="container-fluid">
		<div class="row">
		  <div class="col-3 px-1">{MINI_CAL_OUTPUT}</div>
		  <div class="col px-1">
            <div class="container-fluid"> 
			  <div class="row">
			    <div class="col px-0">				
			      <!-- BEGIN switch_user_logged_in -->
			      <!-- Start add - Fully integrated shoutbox MOD -->
                  <div class="container-fluid forumline text-center"> 
					<div class="row cat">
					  <div class="col th pt-2 text-center cattitle"><a href="{U_SHOUTBOX_MAX}" class="cattitle">{L_SHOUTBOX}</a></div> 
				    </div> 
				    <div class="row">
					  <div class="col px-0"> 
					    <iframe src="{U_SHOUTBOX}" scrolling="NO" width="100%" height="210" frameborder="0" marginheight="0" marginwidth="0" allowtransparency="true"></iframe> 
					  </div> 
				    </div> 
			      </div>
			      <!-- End add - Fully integrated shoutbox MOD -->
			      <!-- END switch_user_logged_in -->
			    </div>
			  </div>
			  <!-- BEGIN disable_viewonline -->
			  <div class="row">
			    <div class="col">&nbsp;</div>
			  </div>				
			  <div class="row">
			    <div class="col px-0">
                  <div class="container-fluid forumline mx-0">
				    <div class="row cat">
					  <div class="col th pt-2 text-center cattitle"><a href="{U_VIEWONLINE}" class="cattitle">{L_WHO_IS_ONLINE}</a></div>
				    </div>
				    <div class="row">
					  <div class="col-1 d-flex align-items-center row1 hr3"><a href="{U_VIEWONLINE}" title="{L_WHO_IS_ONLINE}"><img src="{WHOSONLINE_IMAGE}" alt="{L_WHO_IS_ONLINE}" height="37" class="imgfolder" title="{L_WHO_IS_ONLINE}" /></a></div>
					  <div class="col row1 py-1"><span class="gensmall">{TOTAL_POSTS}<br />
					    {TOTAL_USERS}<br />
					    {NEWEST_USER}</span>
						<div class="row">
						  <div class="col"><span class="gensmall">{TOTAL_USERS_ONLINE} <br />
						  {RECORD_USERS}<br />
						  {LOGGED_IN_USER_LIST}</span>
						  </div>
						</div>
			  <!-- END disable_viewonline -->
						<div class="row">
						  <div class="col">
						  <span class="gensmall" style="font-weight:bold;">{L_GROUP_LEGEND}</span>
						  <!-- BEGIN legend -->
						  <!-- BEGIN color -->
						  <span style="white-space:nowrap;font-weight:bold;" class="gensmall">{legend.color.L_COMMA}<a href="{legend.U_GROUP}" title="{legend.GROUP_DESCRIPTION}" class="{legend.GROUP_COLOR}">{legend.GROUP_NAME}</a>{legend.color.L_COMMA2}</span>
						  <!-- END color -->
						  <!-- END legend -->
						  </div>
						</div>
						<div class="row">
						  <div class="col"><span class="gensmall">{L_ONLINE_EXPLAIN}</span></div>
						</div>
						<div class="row">
						  <div class="col"><span class="gensmall">{USERS_OF_THE_DAY_LIST}</span></div>
						</div>
					  </div>
				      <!-- BEGIN switch_happy_birthday -->
					  <div class="container-fluid mx-0">
				        <div class="row cat">
					      <div class="col th pt-1 text-center cattitle">{L_HAPPY_BIRTHDAY}</div>
						</div>
				        <div class="row">
					      <div class="col-1 d-flex align-items-center row1 hr3 py-4"><img src="{HAPPY_BIRTHDAY_IMG}" alt="{L_HAPPY_BIRTHDAY}" /></div>
						  <div class="col row1 gensmall text-start">&nbsp;{HAPPY_BIRTHDAY_FELLOWS}&nbsp;</div>
						</div>
					  </div>
				      <!-- END switch_happy_birthday -->
				    </div>					
			      </div>
			    </div>
			  </div>
 		    </div>
		  </div>
	    </div>
	  </div> 
	  
	  
	</div>
  </div>
</div>

<!-- BEGIN switch_banner_19 -->
<div class="container-fluid">
  <div class="row">
    <div class="col">{BANNER_19_IMG}</div>
  </div>
</div>
<br />
<!-- END switch_banner_19 -->
