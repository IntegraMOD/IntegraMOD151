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
	<th nowrap="nowrap">{L_ACTION}&nbsp;</th>
	<th colspan="2">{L_FORUM}</th>
	<th>&nbsp;{L_TOPICS}&nbsp;</th>
	<th>&nbsp;{L_POSTS}&nbsp;</th>
</tr>
<!-- BEGIN row -->
<tr>
  <td width="160" class="{row.COLOR}">
    <table cellpadding="0" cellspacing="1" border="0">
      <tr>
	    <td><a href="{row.U_MOVEUP}" class="genmed" title="{L_MOVEUP}"><img src="{TEMPLATE}images/p_up.png" alt="{L_MOVE_UP}" width="30" height="30" /></a></td>
		<td><a href="{row.U_MOVEDW}" class="genmed" title="{L_MOVEDW}"><img src="{TEMPLATE}images/p_down.png" alt="{L_MOVE_DOWN}" width="30" height="30" /></td>
		<td><a href="{row.U_EDIT}" class="genmed" title="{L_EDIT}"><img src="{TEMPLATE}images/p_edit.png" alt="{L_EDIT} {L_BLOCK}" width="30" height="30" /></a></td>
		<td><a href="{row.U_DELETE}" class="genmed" title="{L_DELETE}"><img src="{TEMPLATE}images/p_delete.png" alt="{L_DELETE}" width="30" height="30" /></a></td>
		<td><a href="{row.U_RESYNC}" class="genmed" title="{L_RESYNC}"><img src="{TEMPLATE}images/f_resync.png" alt="{L_RESYNC}" width="30" height="30" /></a></td>
	  </tr>
	</table>
  </td>
  <td width="5%" align="center" class="{row.COLOR}"><img src="{row.FOLDER}" border="0" alt="{row.L_FOLDER}" title="{row.L_FOLDER}" /></td>
  <td class="{row.COLOR}" valign="top" height="50" width="70%">
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
</table>
</form>