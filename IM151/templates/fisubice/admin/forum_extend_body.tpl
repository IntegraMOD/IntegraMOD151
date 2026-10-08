<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form action="{S_ACTION}" name="post" method="post">
<table width="100%" cellpadding="2" cellspacing="0" border="0" align="center">
<tr>
	<td><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_CAT_DESC}</span></td>
</tr>
</table>

<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<th colspan="2">{L_FORUM}</th>
	<th>&nbsp;{L_TOPICS}&nbsp;</th>
	<th>&nbsp;{L_POSTS}&nbsp;</th>
	<th nowrap="nowrap">&nbsp;{L_ACTION}&nbsp;</th>
</tr>
<!-- BEGIN row -->
<tr>
	<td width="5%" align="center" class="{row.COLOR}"><img src="{row.FOLDER}" border="0" alt="{row.L_FOLDER}" title="{row.L_FOLDER}" /></td>
	<td class="{row.COLOR}" valign="top" height="50" width="60%">
		<!-- BEGIN forum_icon -->
		<table cellpadding="2" cellspacing="0" border="0" height="47" width="100%">
		<tr>
			<td width="46" align="center"><img src="{row.ICON_IMG}" border="0" alt="{row.ICON}" title="{row.ICON}" /></td>
			<td width="100%">
		<!-- END forum_icon -->
				<span class="forumlink"><a href="{row.U_FORUM}" class="forumlink" title="{row.FORUM_NAME}">{row.FORUM_NAME}</a></span>
				<span class="genmed"><br />{row.FORUM_DESC}</span>
				<span class="gensmall">{row.LINKS}</span>
		<!-- BEGIN forum_icon -->
			</td>
		</tr>
		</table>
		<!-- END forum_icon -->
	</td>
	<td width="5%" class="{row.COLOR}" align="center" valign="middle"><span class="gensmall">{row.TOPICS}</span></td>
	<td width="5%" class="{row.COLOR}" align="center" valign="middle"><span class="gensmall">{row.POSTS}</span></td>
	<td width="25%" class="{row.COLOR}" align="center">
		<table cellpadding="0" cellspacing="3" border="0" align="center">
		<tr>
			<td><table cellpadding="1" cellspacing="0" border="1" align="center" width="80"><tr><td class="genmed" align="center"><span class="genmed"><a href="{row.U_EDIT}" class="genmed" title="{L_EDIT}">{L_EDIT}</a></span></td></tr></table></td>
			<td><table cellpadding="1" cellspacing="0" border="1" align="center" width="80"><tr><td class="genmed" align="center"><span class="genmed"><a href="{row.U_DELETE}" class="genmed" title="{L_DELETE}">{L_DELETE}</a></span></td></tr></table></td>
			<td rowspan="2">
				<table cellpadding="0" cellspacing="2" border="0" align="center">
				<tr>
					<td><table cellpadding="2" cellspacing="0" border="1" align="center"><tr><td class="genmed" align="center"><a href="{row.U_MOVEUP}" class="genmed" title="{L_MOVEUP}"><img src="{IMG_MOVEUP}" border="0" /></a></td></tr></table></td>
				</tr>
				<tr>
					<td><table cellpadding="2" cellspacing="0" border="1" align="center"><tr><td class="genmed" align="center"><a href="{row.U_MOVEDW}" class="genmed" title="{L_MOVEDW}"><img src="{IMG_MOVEDW}" border="0" /></a></td></tr></table></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2"><table cellpadding="1" cellspacing="0" border="1" align="center" width="80"><tr><td class="genmed" align="center"><span class="genmed"><a href="{row.U_RESYNC}" class="genmed" title="{L_RESYNC}">{L_RESYNC}</a></span></td></tr></table></td>
		</tr>
		</table>
	</td>
</tr>
<!-- END row -->
<!-- BEGIN empty -->
<tr>
	<td class="row1" colspan="5" align="center"><span class="gen">{NO_SUBFORUMS}</span></td>
</tr>
<!-- END empty -->
<tr>
	<td class="cat" colspan="5" align="center">{S_HIDDEN_FIELDS}
		<span class="cattitle">
			<!-- BEGIN no_root -->
			<input type="submit" name="edit" value="{L_EDIT_FORUM}" class="mainoption" />&nbsp;
			<input type="submit" name="create" value="{L_CREATE_FORUM}" class="liteoption" />&nbsp;
			<input type="submit" name="delete" value="{L_DELETE_FORUM}" class="liteoption" />&nbsp;
			<input type="submit" name="resync" value="{L_RESYNC_FORUM}" class="liteoption" />
			<!-- END no_root -->
			<!-- BEGIN root -->
			<input type="submit" name="create" value="{L_CREATE_FORUM}" class="mainoption" />&nbsp;
			<input type="submit" name="resync" value="{L_RESYNC_FORUM}" class="liteoption" />
			<!-- END root -->
		</span>
	</td>
</tr>
</table></form>