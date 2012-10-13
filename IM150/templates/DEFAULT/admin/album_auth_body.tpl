<h1>{L_ALBUM_AUTH_TITLE}</h1>

<p>{L_ALBUM_AUTH_EXPLAIN}</p>

<form action="{S_ALBUM_ACTION}" method="post">
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr>
		<th class="thCornerL" height="25" nowrap="nowrap">{L_GROUPS}</th>
		<th class="thTop" nowrap="nowrap">{L_VIEW}</th>
		<th class="thTop" nowrap="nowrap">{L_UPLOAD}</th>
		<th class="thTop" nowrap="nowrap">{L_RATE}</th>
		<th class="thTop" nowrap="nowrap">{L_COMMENT}</th>
		<th class="thTop" nowrap="nowrap">{L_EDIT}</th>
		<th class="thTop" nowrap="nowrap">{L_DELETE}</th>
		<th class="thCornerR" nowrap="nowrap">{L_IS_MODERATOR}</th>
	</tr>
	<!-- BEGIN grouprow -->
	<tr>
		<td class="row1" align="center" height="28"><span class="gen">{grouprow.GROUP_NAME}</span></td>
		<td class="row2" align="center">
		<input name="view[]" type="checkbox" {grouprow.VIEW_CHECKED} value="{grouprow.GROUP_ID}" />
		</td>
		<td class="row2" align="center">
		<input name="upload[]" type="checkbox" {grouprow.UPLOAD_CHECKED} value="{grouprow.GROUP_ID}" />
		</td>
		<td class="row2" align="center">
		<input name="rate[]" type="checkbox" {grouprow.RATE_CHECKED} value="{grouprow.GROUP_ID}" />
		</td>
		<td class="row2" align="center">
		<input name="comment[]" type="checkbox" {grouprow.COMMENT_CHECKED} value="{grouprow.GROUP_ID}" />
		</td>
		<td class="row2" align="center">
		<input name="edit[]" type="checkbox" {grouprow.EDIT_CHECKED} value="{grouprow.GROUP_ID}" />
		</td>
		<td class="row2" align="center">
		<input name="delete[]" type="checkbox" {grouprow.DELETE_CHECKED} value="{grouprow.GROUP_ID}" />
		</td>
		<td class="row2" align="center">
		<input name="moderator[]" type="checkbox" {grouprow.MODERATOR_CHECKED} value="{grouprow.GROUP_ID}" />
		</td>
	</tr>
	<!-- END grouprow -->
	<tr>
		<td class="catBottom" height="25" align="center" colspan="8"><input type="reset" value="{L_RESET}" class="liteoption" />&nbsp;&nbsp;&nbsp;<input name="submit" type="submit" value="{L_SUBMIT}" class="mainoption" /></td>
	</tr>
</table>
</form>

<br />