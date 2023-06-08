  <div class="container-fluid px-0">
    <div class="row"> 
      <div class="col">
        <span class="nav"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_CAT_DESC}</span>
      </div>
    </div>
     <div class="row"> 
      <div class="col pl-0 text-left maintitle"><a href="{U_VIEW_FORUM}">{FORUM_NAME}</a></div>
      <div class="col text-right gensmall nw">{L_MODERATOR}: {MODERATORS}<br />{LOGGED_IN_USER_LIST}<br /><strong><a href="{U_MARK_READ}">{L_MARK_TOPICS_READ}</a></strong></div>
    </div>
  </div>

{BOARD_ANNOUNCES}

  <div class="container-fluid mb-3 px-0">
    <div class="row"> 
      <div class="col">
        <!-- BEGIN is_auth_post --> 
	    <a class="postbtn" href="{U_POST_NEW_TOPIC}"><i class="fa fa-file-o fa1 mr-1" aria-hidden="true"></i>{L_POST_NEW_TOPIC}</a>
	    <!-- END is_auth_post -->
      </div>
      <div class="col nav text-right">
	    <!-- BEGIN switch_banner_13 -->
	    {BANNER_13_IMG}<br />
	    <!-- END switch_banner_13 -->
	    {PAGINATION}
      </div>
    </div>
  </div>

{BOARD_INDEX}

<form method="post" name="seesince" action="{U_VIEW_FORUM}">
{TOPICS_LIST_BOX}
</form> 

  <div class="container-fluid pl-0">
    <div class="row"> 
      <div class="col-2">
	    <div class="nw text-left"><a class="postbtn" href="{U_POST_NEW_TOPIC}"><i class="fa fa-file-o fa1 mr-1" aria-hidden="true"></i>{L_POST_NEW_TOPIC}</a></div>
	  </div>
      <div class="col mb-0 pr-0 text-right gensmall"><b>{PAGINATION}</b><br />{PAGE_NUMBER}</div>
    </div>
    <div class="row"> 
      <div class="col pl-3 my-auto nav"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_CAT_DESC}</div>
      <div class="col gensmall text-right pr-0">{S_TIMEZONE}</div>
    </div>
  </div>

  <div class="container-fluid pl-0 my-2">
    <div class="row"> 
      <div class="col text-right">{JUMPBOX}</div>
	</div>
  </div>

  <!-- BEGIN ratingsbox -->
  <div class="container-fluid pr-0">
    <div class="row"> 
      <div class="col pr-0 gen text-right">
		<form method="get" name="ratingsbox" action="{ratingsbox.U_RATINGS}">
		<input type="hidden" name="forum_id" value="{FORUM_ID}">
		<select name="type">
		<option value="">{ratingsbox.L_LATEST_RATINGS}</option>
		<option value="p">{ratingsbox.L_HIGHEST_RANKED_POSTS}</option>
		<option value="t">{ratingsbox.L_HIGHEST_RANKED_TOPICS}</option>
		<option value="u">{ratingsbox.L_HIGHEST_RANKED_POSTERS}</option>
		</select>&nbsp;<input type="submit" value="Go" class="liteoption" />
		</form>
	  </div>
	</div>
  </div>
  <!-- END ratingsbox -->


 <div class="container-fluid m-0 p-0">
    <div class="row">
	  <div class="col-7">
	    <div class="row mb-1"> 
	      <div class="col nw"><img src="{FOLDER_ANNOUNCE_IMG}" alt="{L_ANNOUNCEMENT}" />&nbsp;{L_ANNOUNCEMENT}</div>
	      <div class="col nw"><img src="{FOLDER_STICKY_IMG}" alt="{L_STICKY}" />&nbsp;{L_STICKY}</div>
		</div>
	    <div class="row my-1"> 
	      <div class="col nw"><img src="{FOLDER_NEW_IMG}" alt="{L_NEW_POSTS}" />&nbsp;{L_NEW_POSTS}</div>
	      <div class="col nw"><img src="{FOLDER_IMG}" alt="{L_NO_NEW_POSTS}" />&nbsp;{L_NO_NEW_POSTS}</div>
		</div>
	    <div class="row my-1"> 
	      <div class="col nw"><img src="{FOLDER_HOT_NEW_IMG}" alt="{L_NEW_POSTS_HOT}" />&nbsp;{L_NEW_POSTS_HOT}</div>
	      <div class="col nw"><img src="{FOLDER_HOT_IMG}" alt="{L_NO_NEW_POSTS_HOT}" />&nbsp;{L_NO_NEW_POSTS_HOT}</div>
		</div>
	    <div class="row mt-1"> 
	      <div class="col nw"><img src="{FOLDER_LOCKED_NEW_IMG}" alt="{L_NEW_POSTS_LOCKED}" />&nbsp;{L_NEW_POSTS_LOCKED}</div>
	      <div class="col nw"><img src="{FOLDER_LOCKED_IMG}" alt="{L_NO_NEW_POSTS_LOCKED}" />&nbsp;{L_NO_NEW_POSTS_LOCKED}</div>
		</div>
  	  </div>
      <div class="col-5 gensmall text-right">{S_AUTH_LIST}</div>
    </div>
  </div>