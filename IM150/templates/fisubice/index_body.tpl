	  <!-- BEGIN switch_banner_18 -->
	  <div class="container">
	    <div class="row"> 
	      <div class="col mx-auto">
		  {BANNER_18_IMG}
	      </div>
	    </div>
	  </div>
	  <!-- END switch_banner_18 -->

	  <div class="container-fluid mb-2">
		<div class="row">
		  <div class="maintitle ml-0">{L_INDEX}</div>
		</div>
	 	<!-- BEGIN switch_user_logged_in -->
		<div class="row">
		  <div class="p-0 flex-fill gensmall"><a href="#"></a></div>
		  <div class="p-0 flex-fill text-right"><a href="{U_SEARCH_NEW}" class="gensmall">{L_SEARCH_NEW}</a></div>
		</div>
		<!-- END switch_user_logged_in -->
		<div class="row">
		  <div class="p-0 flex-fill gensmall">{LAST_VISIT_DATE}</div>
		<!-- BEGIN switch_user_logged_in -->
		  <div class="p-0 flex-fill text-right"><a href="{U_SEARCH_SELF}" class="gensmall">{L_SEARCH_SELF}</a></div>
		<!-- END switch_user_logged_in -->
		</div>
		<div class="row">
		  <div class="p-0 flex-fill text-nowrap">{CURRENT_TIME}</div>
		  <div class="p-0 flex-fill text-right"><a href="{U_SEARCH_UNANSWERED}" class="gensmall">{L_SEARCH_UNANSWERED}</a></div>
		</div>
		<div class="row">
		  <div class="p-0 flex-fill text-nowrap"><a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_CAT_DESC}</div>
		  <div class="p-0 flex-fill text-right"><a href="{U_MARK_READ}"><strong>{L_MARK_FORUMS_READ}</strong></a></div>
		</div>
	  </div>

{BOARD_ANNOUNCES}
{BOARD_INDEX}

	  <div class="container-fluid mb-2">
		<div class="d-flex ctr">
		  <div class="p-0 flex-fill"><img src="{FORUM_NEW_IMG}" alt="{L_NEW_POSTS}" title="{L_NEW_POSTS}"/>{L_NEW_POSTS}</div>
		  <div class="p-0 flex-fill"><img src="{FORUM_IMG}" alt="{L_NO_NEW_POSTS}" title="{L_NO_NEW_POSTS}"/>{L_NO_NEW_POSTS}</div>
		  <div class="p-0 flex-fill"><img src="{FORUM_LOCKED_IMG}" alt="{L_FORUM_LOCKED}" title="{L_FORUM_LOCKED}"/>{L_NO_NEW_POSTS}</div>
		</div>
	  </div>

	  <div class="container-fluid">
	    <div class="row">
	      <div class="col-sm- mr-2">
		  {MINI_CAL_OUTPUT}
	      </div>
	      <div class="col-md pl-0 align-self-end">
			<!-- BEGIN switch_user_logged_in -->
			<!-- Start add - Fully integrated shoutbox MOD -->
	        <div class="row pb-4 pl-3">
	 	  	  <div class="container-fluid forumline">
			    <div class="row th">
			      <div class="col cattitle pt-1"><a href="{U_SHOUTBOX_MAX}">{L_SHOUTBOX}</a></div>
			    </div>
			    <div class="row row1">
			      <iframe src="{U_SHOUTBOX}" scrolling="NO" width="100%" height="210" frameborder="0" marginheight="0" marginwidth="0" allowtransparency="true"></iframe> 
			    </div>
			  </div>
	        </div>
			<!-- End add - Fully integrated shoutbox MOD -->
			<!-- END switch_user_logged_in -->
  		    <!-- BEGIN disable_viewonline -->
	        <div class="row pl-3">
		      <div class="container forumline mb-2">
			    <div class="row th">
			      <div class="col cattitle pt-2"><a href="{U_VIEWONLINE}">{L_WHO_IS_ONLINE}</a></div>
			    </div>
			    <div class="row row1">
				  <div class="col-2 pt-4 pr-0 ctr bdrr resp"><i class="fa fa-users fa-3x hov" title="{L_WHO_IS_ONLINE}"></i></div>
				  <div class="col row1 pl-1 mb-2">
				    <div class="row row1 ml-1">
				      <div class="col pl-1"><span class="gensmall">{TOTAL_POSTS}<br />{TOTAL_USERS}<br />{NEWEST_USER}</span></div>
				    </div>
				    <div class="row row1 ml-1">
			          <div class="col pl-1"><span class="gensmall">{TOTAL_USERS_ONLINE} &nbsp; [ {L_WHOSONLINE_ADMIN} ] &nbsp; [ {L_WHOSONLINE_MOD} ]<br />{RECORD_USERS}<br />{LOGGED_IN_USER_LIST}</span></div>
				    </div>
				    <div class="row row1 ml-1">
			           <div class="col pl-1 gensmall font-weight-bold">{L_GROUP_LEGEND}</div>
				    </div>
					<!-- BEGIN legend -->
					<!-- BEGIN color -->  
				    <div class="row row1 ml-1">
			          <div class="col pl-1 gensmall font-weight-bold">{legend.color.L_COMMA}<a href="{legend.U_GROUP}" title="{legend.GROUP_DESCRIPTION}" class="{legend.GROUP_COLOR}">{legend.GROUP_NAME}</a>{legend.color.L_COMMA2}</div>
				    </div>
					<!-- END color -->
					<!-- END legend -->
				    <div class="row row1 ml-1">
			          <div class="col pl-1 gensmall">{L_ONLINE_EXPLAIN}</div>
				    </div>
				    <div class="row row1 ml-1">
			          <div class="col pl-1 gensmall">{USERS_OF_THE_DAY_LIST}</div>
				    </div>
					<!-- BEGIN switch_happy_birthday -->
				    <div class="row row1 ml-1">
			          <div class="col pl-1 gensmall font-weight-bold"><i class="far fa-birthday-cake"></i>{HAPPY_BIRTHDAY_FELLOWS}</div>
				    </div>
					<!-- END switch_happy_birthday -->
				  </div>
			    </div>
			  </div>
	        </div>
  		    <!-- END disable_viewonline -->
	      </div>
	    </div>
	  </div>




	  <!-- BEGIN switch_user_logged_out -->
	  <form method="post" action="{S_LOGIN_ACTION}">
	  <div class="container-fluid forumline mt-2">
		<div class="row th">
		  <div class="col cattitle pt-2"><a id="login"></a>{L_LOGIN_LOGOUT}</div>
		</div>
		<div class="row row1">
		  <div class="col pb-2 mt-2">
		    <div class="cell row1">
			<span class="gensmall">{L_USERNAME}: 
			<input class="post" type="text" name="username" size="10" />
			&nbsp;&nbsp;&nbsp;{L_PASSWORD}: 
			<input class="post" type="password" name="password" size="10" maxlength="32" />
			<!-- BEGIN switch_allow_autologin -->
			&nbsp;&nbsp; &nbsp;&nbsp;{L_AUTO_LOGIN} 
			<input class="text" type="checkbox" name="autologin" />
			<!-- END switch_allow_autologin -->
			&nbsp;&nbsp;&nbsp; 
			{S_HIDDEN_FIELDS}
			<input type="submit" class="mainoption" name="login" value="{L_LOGIN}" />
			</span>
		    </div>
		  </div>
		</div>
	  </div>
	  </form>
	  <!-- END switch_user_logged_out -->

	  <!-- BEGIN switch_banner_19 -->
	  <div class="container">
	    <div class="row"> 
	      <div class="col mx-auto">
		  {BANNER_19_IMG}
	      </div>
	    </div>
	  </div>
	  <!-- END switch_banner_19 -->