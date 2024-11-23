<!-- BEGIN catrow -->
<!-- BEGIN tablehead -->
<table width="100%" cellpadding="0" cellspacing="1" border="0" class="forumline">
<tr> 
	<th colspan="{catrow.tablehead.INC_SPAN}" width="100%" nowrap="nowrap">&nbsp;{catrow.tablehead.L_FORUM}&nbsp;</th>
	<th width="50" nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
	<th width="50" nowrap="nowrap">&nbsp;{L_POSTS}&nbsp;</th>
	<th width="150" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</th>
</tr>
<!-- END tablehead -->
<!-- BEGIN cat -->
<tr> 
	<!-- BEGIN inc -->
	<td width="46" class="{catrow.cat.inc.INC_CLASS}"><img src="{SPACER}" width="46" height="0" /></td>
	<!-- END inc -->
	<td class="{catrow.cat.CLASS_CAT}" width="100%" colspan="{catrow.cat.INC_SPAN}"><span class="cattitle"><a href="{catrow.cat.U_VIEWCAT}" class="cattitle" title="{catrow.cat.CAT_DESC}">{catrow.cat.CAT_TITLE}</a></span></td>
	<td class="{catrow.cat.CLASS_ROWPIC}" colspan="3" align="right">&nbsp;</td> 
</tr>
<!-- END cat -->
<!-- BEGIN forumrow -->
<tr> 
	<!-- BEGIN inc -->
	<td width="46" class="{catrow.forumrow.inc.INC_CLASS}"><img src="{SPACER}" width="46" height="0" /></td>
	<!-- END inc -->
	<td class="{catrow.forumrow.INC_CLASS}" onMouseOver="this.className='row2'" onMouseOut="this.className='{catrow.forumrow.INC_CLASS}'" align="center" valign="middle" height="50"><img src="{catrow.forumrow.FORUM_FOLDER_IMG}" width="46" height="25" alt="{catrow.forumrow.L_FORUM_FOLDER_ALT}" title="{catrow.forumrow.L_FORUM_FOLDER_ALT}" /></td>
	<td class="row1" width="100%" height="50" colspan="{catrow.forumrow.INC_SPAN}" valign="top" onMouseOver="this.className='row2'" onMouseOut="this.className='{catrow.forumrow.INC_CLASS}'">
		<!-- BEGIN forum_icon -->
		<table cellpadding="2" cellspacing="0" border="0" width="100%" height="47">
		<tr>
			<td width="46" align="center"><a href="{catrow.forumrow.U_VIEWFORUM}"><img src="{catrow.forumrow.ICON_IMG}" border="0" /></a></td>
			<td>
		<!-- END forum_icon -->
		<span class="forumlink"><a href="{catrow.forumrow.U_VIEWFORUM}" class="forumlink">{catrow.forumrow.FORUM_NAME}</a><br /></span>
		<span class="genmed">{catrow.forumrow.FORUM_DESC}</span>
		<span class="gensmall">{catrow.forumrow.L_MODERATOR}{catrow.forumrow.MODERATORS}{catrow.forumrow.L_LINKS}{catrow.forumrow.LINKS}</span>
		<!-- BEGIN forum_icon -->
			</td>
		</tr>
		</table>
		<!-- END forum_icon -->
	</td>
	<!-- BEGIN forum_link_no -->
	<td class="row1" onMouseOver="this.className='row2'" onMouseOut="this.className='row1'" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.TOPICS}</span></td>
	<td class="row1" onMouseOver="this.className='row2'" onMouseOut="this.className='row1'" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.POSTS}</span></td>
	<td class="row1" onMouseOver="this.className='row2'" onMouseOut="this.className='row1'" align="center" valign="middle" height="50" nowrap="nowrap"> <span class="gensmall">{catrow.forumrow.LAST_POST}</span></td>
	<!-- END forum_link_no -->
	<!-- BEGIN forum_link -->
	<td class="row1" onMouseOver="this.className='row2'" onMouseOut="this.className='row1'" align="center" valign="middle" height="50" colspan="3"><span class="gensmall">{catrow.forumrow.forum_link.HIT_COUNT}</span></td>
	<!-- END forum_link -->
</tr>
<!-- END forumrow -->
<!-- BEGIN catfoot -->
<tr>
	<!-- BEGIN inc -->
	<td width="46" class="{catrow.catfoot.inc.INC_CLASS}"><img src="{SPACER}" width="46" height="0" /></td>
	<!-- END inc -->
	<td colspan="{catrow.catfoot.INC_SPAN}" height="1" class="catBottom"><img src="{SPACER}" alt="" width="1" height="1" /></td>
</tr>
<!-- END catfoot -->
<!-- BEGIN tablefoot -->
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="{TEMPLATE}images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="{TEMPLATE}images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="{TEMPLATE}images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<br class="gensmall" />
<!-- END tablefoot -->
<!-- END catrow -->