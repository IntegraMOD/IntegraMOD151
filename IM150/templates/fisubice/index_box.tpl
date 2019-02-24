<!-- BEGIN catrow -->
<!-- BEGIN tablehead -->
<div class="container-fluid forumline">
  <div class="row th">
	<div class="col bd pt-1  text-center">{catrow.tablehead.L_FORUM}</div>
	<div class="col-1 bd pt-1 mw1 text-center">{L_TOPICS}</div>
	<div class="col-1 bd pt-1 mw1 text-center">{L_POSTS}</div>
	<div class="col-2 bd pt-1 text-center iresp">{L_LASTPOST}</div>
  </div>
<!-- END tablehead -->

<!-- BEGIN cathead -->
  <div class="row catHead d-flex justify-content-end">
	<!-- BEGIN inc -->
	<div class="col-1 bd nb {catrow.cathead.inc.INC_CLASS}"></div>
	<!-- END inc -->
	<div class="col-8 nb pt-2 {catrow.cathead.CLASS_CAT}"><a href="{catrow.cathead.U_VIEWCAT}" class="cattitle" title="{catrow.cathead.CAT_DESC}">{catrow.cathead.CAT_TITLE}</a></div>
	<div class="col-3 nb align-right"></div>
  </div>
<!-- END cathead -->

<!-- BEGIN forumrow -->
  <div class="row row2 align-right"onMouseOver="this.className='row row1'" onMouseOut="this.className='row row2'">
 	<!-- BEGIN inc -->
	<div class="col-1 bd row2 mw2 pl-0 pb-4 {catrow.forumrow.inc.INC_CLASS}"><img src="{SPACER}" width="26" height="0" /></div>
	<!-- END inc -->
	<div  class="col-1 bd row2 mw2 pl-0 pb-4 {catrow.forumrow.INC_CLASS} pt-4"><img src="{catrow.forumrow.FORUM_FOLDER_IMG}" width="26" height="25" alt="{catrow.forumrow.L_FORUM_FOLDER_ALT}" title="{catrow.forumrow.L_FORUM_FOLDER_ALT}" /></div>
	<div class="col bd pt-3">
		<!-- BEGIN forum_icon -->
  		<div class="row>
			<a href="{catrow.forumrow.U_VIEWFORUM}"><img src="{catrow.forumrow.ICON_IMG}" border="0" /></a>
			<!-- END forum_icon -->
			<span class="forumlink"><a href="{catrow.forumrow.U_VIEWFORUM}" class="forumlink">{catrow.forumrow.FORUM_NAME}</a><br /></span>
			<span class="genmed">{catrow.forumrow.FORUM_DESC}</span>
			<span class="gensmall">{catrow.forumrow.L_MODERATOR}{catrow.forumrow.MODERATORS}{catrow.forumrow.L_LINKS}{catrow.forumrow.LINKS}</span>
			<!-- BEGIN forum_icon -->
		</div>
		<!-- END forum_icon -->
	</div>
	<!-- BEGIN forum_link_no -->
	<div class="col-1 bd row3 gensmall ctr pt-3 mw1" onMouseOver="this.className='col-1 row1 bd gensmall ctr pt-3 mw1'" onMouseOut="this.className='col-1 row3 bd gensmall ctr pt-3 mw1'">{catrow.forumrow.TOPICS}</div>
	<div class="col-1 bd row2 gensmall ctr pt-3 mw1" onMouseOver="this.className='col-1 row1 bd gensmall ctr pt-3 mw1'" onMouseOut="this.className='col-1 row2 bd gensmall ctr pt-3 mw1'">{catrow.forumrow.POSTS}</div>
	<div class="col-2 bd row3 gensmall ctr pt-3 iresp" onMouseOver="this.className='col-2 row1 bd gensmall ctr pt-3 iresp'" onMouseOut="this.className='col-2 row3 bd gensmall ctr pt-3 iresp'">{catrow.forumrow.LAST_POST}</div>
	<!-- END forum_link_no -->
	<!-- BEGIN forum_link -->
	<div class="col-1 bd row3 gensmall ctr pt-3 mw1">{catrow.forumrow.forum_link.HIT_COUNT}</div>
	<!-- END forum_link -->
  </div>
<!-- END forumrow -->

<!-- BEGIN catfoot -->
  <div class="row">
	<!-- BEGIN inc -->
    <div class="{catrow.catfoot.inc.INC_CLASS} col-1 bd catBottom"><img src="{SPACER}" width="26" height="0" /></div>
	<!-- END inc --> 
    <div class="col bd catBottom spaceRow"><img src="{SPACER}" width="1" height="1" /></div>
  </div>
</div>
<!-- END catfoot -->
<!-- BEGIN tablefoot -->
</div>
<br class="gensmall" />
<!-- END tablefoot -->
<!-- END catrow -->