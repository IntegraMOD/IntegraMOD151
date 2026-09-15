	<div class="action-bar top">
	    <div class="breadcrumbs">
	        <a href="{U_INDEX}">{L_INDEX}</a> {NAV_CAT_DESC}
	    </div>
	    <div class="topic-actions">
			<!-- BEGIN is_auth_post -->
			<div class="lbuttons"><a href="{U_POST_NEW_TOPIC}" class="button icon-button post-icon" title="{L_POST_NEW_TOPIC}">{L_POST_NEW_TOPIC}</a></div>
			<!-- END is_auth_post -->
	        <div class="pagination">
	            {PAGINATION}
	        </div>
	    </div>
	</div>
	 
	<div class="action-bar top">
		<ul class="linklist leftside">
			<li>{L_MODERATOR}: {MODERATORS}<br>{LOGGED_IN_USER_LIST}</li>
		</ul>
		<ul class="linklist rightside">
			<li><strong><a href="{U_MARK_READ}">{L_MARK_TOPICS_READ}</a></strong></li>
		</ul>
	</div>
	 
 
	{BOARD_ANNOUNCES}
	{BOARD_INDEX}
	 
	<form method="post" name="seesince" action="{U_VIEW_FORUM}">
	    {TOPICS_LIST_BOX}
	</form>
	 
	<div class="action-bar bottom">
		<!-- BEGIN is_auth_post -->
		<div class="lbuttons"><a href="{U_POST_NEW_TOPIC}" class="button icon-button post-icon" title="{L_POST_NEW_TOPIC}">{L_POST_NEW_TOPIC}</a></div>
		<!-- END is_auth_post -->
	    <div class="pagination">
	        {PAGINATION}
	    </div>
	    <div class="breadcrumbs">
	        <a href="{U_INDEX}">{L_INDEX}</a> {NAV_CAT_DESC}
	    </div>
	</div>
	 
	<div class="row">
	    <div class="col-md-8">
	        {JUMPBOX}
	    </div>
	    <div class="col-md-4">
	        <!-- BEGIN ratingsbox -->
	        <form method="get" name="ratingsbox" action="{ratingsbox.U_RATINGS}" class="form-inline">
	            <input type="hidden" name="forum_id" value="{FORUM_ID}">
	            <select name="type" class="form-control">
	                <option value="">{ratingsbox.L_LATEST_RATINGS}</option>
	                <option value="p">{ratingsbox.L_HIGHEST_RANKED_POSTS}</option>
	                <option value="t">{ratingsbox.L_HIGHEST_RANKED_TOPICS}</option>
	                <option value="u">{ratingsbox.L_HIGHEST_RANKED_POSTERS}</option>
	            </select>
	            <input type="submit" value="Go" class="btn btn-default" />
	        </form>
	        <!-- END ratingsbox -->
	    </div>
	</div>
	 
	<div class="stat-block online-list">
	    <h3>{L_MODERATOR}</h3>
	    <p>{MODERATORS}</p>
	    <h3>{L_ONLINE_USERS}</h3>
	    <p>{LOGGED_IN_USER_LIST}</p>
	</div>
	 
	<div class="stat-block-wrapper">
	    <div class="stat-block forum-legend">
	        <h3>{L_LEGEND}</h3>
	        <div class="legend-content">
	            <div class="legend-column">
	                 <img src="{FOLDER_NEW_IMG}" alt="{L_NEW_POSTS}" title="{L_NEW_POSTS}" /> {L_NEW_POSTS}<br />
	                 <img src="{FOLDER_IMG}" alt="{L_NO_NEW_POSTS}" title="{L_NO_NEW_POSTS}" /> {L_NO_NEW_POSTS}<br />
	                 <img src="{FOLDER_ANNOUNCE_IMG}" alt="{L_ANNOUNCEMENT}" title="{L_ANNOUNCEMENT}" /> {L_ANNOUNCEMENT}
	            </div>
	            <div class="legend-column">
	                 <img src="{FOLDER_HOT_NEW_IMG}" alt="{L_NEW_POSTS_HOT}" title="{L_NEW_POSTS_HOT}" /> {L_NEW_POSTS_HOT}<br />
	                 <img src="{FOLDER_HOT_IMG}" alt="{L_NO_NEW_POSTS_HOT}" title="{L_NO_NEW_POSTS_HOT}" /> {L_NO_NEW_POSTS_HOT}<br />
	                 <img src="{FOLDER_STICKY_IMG}" alt="{L_STICKY}" title="{L_STICKY}" /> {L_STICKY}
	            </div>
	            <div class="legend-column">
	                 <img src="{FOLDER_LOCKED_NEW_IMG}" alt="{L_NEW_POSTS_LOCKED}" title="{L_NEW_POSTS_LOCKED}" /> {L_NEW_POSTS_LOCKED}<br />
	                 <img src="{FOLDER_LOCKED_IMG}" alt="{L_NO_NEW_POSTS_LOCKED}" title="{L_NO_NEW_POSTS_LOCKED}" /> {L_NO_NEW_POSTS_LOCKED}<br />
	                 <img src="{FOLDER_POSTED_IMG}" alt="{L_POSTED}" title="{L_POSTED}" /> {L_POSTED}
	            </div>
	        </div>
	    </div>
	 
	    <div class="stat-block permissions">
	        <h3>{L_PERMISSIONS}</h3>
	        <p>{S_AUTH_LIST}</p>
	    </div>
	</div>