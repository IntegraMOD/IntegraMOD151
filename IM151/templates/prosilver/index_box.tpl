<!-- BEGIN catrow -->
	<!-- BEGIN tablehead -->
	<div class="forabg">
	    <div class="inner"><span class="corners-top"><span></span></span>
	        <ul class="topiclist">
	            <li class="header">
	                <dl class="row-item">
	                    <dt><div class="list-inner">{catrow.tablehead.L_FORUM}</div></dt>
	                    <dd class="topics">{L_TOPICS}</dd>
	                    <dd class="posts">{L_POSTS}</dd>
	                    <dd class="lastpost"><span>{L_LASTPOST}</span></dd>
	                </dl>
	            </li>
	        </ul>
	<!-- END tablehead -->
	<!-- BEGIN cat -->
	        <ul class="topiclist forums">
	            <li class="row">
	                <dl class="row-item {catrow.cat.CLASS_CAT}">
	                    <dt>
	                        <div class="list-inner">
	                            <!-- BEGIN inc -->
	                            <span class="forum-image"><img src="{SPACER}" width="46" height="0" alt="" /></span>
	                            <!-- END inc -->
	                            <a href="{catrow.cat.U_VIEWCAT}" class="forumtitle" title="{catrow.cat.CAT_DESC}">{catrow.cat.CAT_TITLE}</a>
	                        </div>
	                    </dt>
	                    <dd class="{catrow.cat.CLASS_ROWPIC}">&nbsp;</dd>
	                </dl>
	            </li>
	        </ul>
	<!-- END cat -->
	<!-- BEGIN forumrow -->
	        <ul class="topiclist forums">
	            <li class="row">
	                <dl class="row-item {catrow.forumrow.INC_CLASS}">
	                    <dt>
	                        <div class="list-inner">
	                            <!-- BEGIN inc -->
	                            <span class="forum-image"><img src="{SPACER}" width="46" height="0" alt="" /></span>
	                            <!-- END inc -->
	                            <span class="forum-image"><img src="{catrow.forumrow.FORUM_FOLDER_IMG}" width="46" height="25" alt="{catrow.forumrow.L_FORUM_FOLDER_ALT}" title="{catrow.forumrow.L_FORUM_FOLDER_ALT}" /></span>
	                            <a href="{catrow.forumrow.U_VIEWFORUM}" class="forumtitle ipush">{catrow.forumrow.FORUM_NAME}</a>
	                            <br /><span class="forum-description ipush">{catrow.forumrow.FORUM_DESC}</span>
	                            <!-- BEGIN forum_icon -->
	                            <span class="forum-icon">
	                                <a href="{catrow.forumrow.U_VIEWFORUM}"><img src="{catrow.forumrow.ICON_IMG}" alt="" /></a>
	                            </span>
	                            <!-- END forum_icon -->
	                            <span class="forum-moderators">{catrow.forumrow.L_MODERATOR}{catrow.forumrow.MODERATORS}</span>
	                            <span class="forum-links">{catrow.forumrow.L_LINKS}{catrow.forumrow.LINKS}</span>
	                        </div>
	                    </dt>
	                    <!-- BEGIN forum_link_no -->
	                    <dd class="topics">{catrow.forumrow.TOPICS} <dfn>{L_TOPICS}</dfn></dd>
	                    <dd class="posts">{catrow.forumrow.POSTS} <dfn>{L_POSTS}</dfn></dd>
	                    <dd class="lastpost">
	                        <span>
	                            <dfn>{L_LASTPOST}</dfn>
	                            {catrow.forumrow.LAST_POST}
	                        </span>
	                    </dd>
	                    <!-- END forum_link_no -->
	                    <!-- BEGIN forum_link -->
	                    <dd class="redirect" colspan="3">{catrow.forumrow.forum_link.HIT_COUNT}</dd>
	                    <!-- END forum_link -->
	                </dl>
	            </li>
	        </ul>
	<!-- END forumrow -->
	<!-- BEGIN catfoot -->
	        <ul class="topiclist forums">
	            <li class="row">
	                <dl class="row-item">
	                    <!-- BEGIN inc -->
	                    <dt class="{catrow.catfoot.inc.INC_CLASS}"><span class="forum-image"><img src="{SPACER}" width="46" height="0" alt="" /></span></dt>
	                    <!-- END inc -->
	                    <dd class="lastpost"><span>&nbsp;</span></dd>
	                </dl>
	            </li>
	        </ul>
	<!-- END catfoot -->
	<!-- BEGIN tablefoot -->
	    <span class="corners-bottom"><span></span></span></div>
	</div>
	<br class="gensmall" />
	<!-- END tablefoot -->
	<!-- END catrow -->