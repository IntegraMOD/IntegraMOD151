
		<!-- BEGIN catrow -->
		<div class="forabg">
			<div class="inner"><span class="corners-top"><span></span></span>
			<ul class="topiclist">
				<li class="header">
					<dl class="icon">
						<dt><a href="{catrow.U_VIEWCAT}">{catrow.CAT_DESC}</a></dt>
						<dd class="topics">{L_TOPICS}</dd>
						<dd class="posts">{L_POSTS}</dd>
						<dd class="lastpost"><span>{L_LASTPOST}</span></dd>
					</dl>
				</li>
			</ul>
			<ul class="topiclist forums">
				<!-- BEGIN forumrow -->
				<li class="row">
					<dl class="icon" style="background-image: url({catrow.forumrow.FORUM_FOLDER_IMG}); background-repeat: no-repeat;">
						<dt title="{catrow.forumrow.L_FORUM_FOLDER_ALT}">
							<a href="{catrow.forumrow.U_VIEWFORUM}" class="forumtitle">{catrow.forumrow.FORUM_NAME}</a><br />
							{catrow.forumrow.FORUM_DESC}<br />{catrow.forumrow.L_MODERATOR} {catrow.forumrow.MODERATORS}
						</dt>
						<dd class="topics">{catrow.forumrow.TOPICS}</dd>
						<dd class="posts">{catrow.forumrow.POSTS}</dd>
						<dd class="lastpost"><span>{catrow.forumrow.LAST_POST}</span></dd>
					</dl>
				</li>
				<!-- END forumrow -->
			</ul>
			<span class="corners-bottom"><span></span></span></div>
		</div>
		<!-- END catrow -->