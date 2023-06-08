<script language="javascript" type="text/javascript">
<!--
function avatar_choose(avatarfile) {
	opener.document.forms['post'].avatarlocal.value = avatarfile;
	opener.focus();
	window.close();
}
//-->
</script>

<form method="post" name="avatar_select" action="{S_AVATAR_SELECT_ACTION}">
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="forumline">
<tr>
	<th valign="middle">{L_AVATAR_GALLERY}</th>
</tr>
<tr>
	<td class="cat" align="center" valign="middle">
		<span class="genmed">{L_CATEGORY}:&nbsp;{S_CATEGORY_SELECT}&nbsp;<input type="submit" class="liteoption" value="{L_GO}" name="avatargallery" /></span>
	</td>
</tr>
<tr>
	<td class="row3">
		<table cellpadding="3" cellspacing="1" width="100%" border="0">
		<!-- BEGIN avatar_row -->
		<tr> 
			<!-- BEGIN avatar_column -->
			<td class="row1" align="center"><a href="javascript:avatar_choose('{avatar_row.avatar_column.AVATAR_FILE}')">
				<img src="{avatar_row.avatar_column.AVATAR_IMAGE}" alt="{avatar_row.avatar_column.AVATAR_NAME}" title="{avatar_row.avatar_column.AVATAR_NAME}" border="0"/>
			</a></td>
			<!-- END avatar_column -->
		</tr>
		<!-- END avatar_row -->
		</table>
	</td>
</tr>
<tr> 
	<td class="cat" align="center">{S_HIDDEN_FIELDS}<a href="javascript:window.close();" class="genmed">{L_CLOSE_WINDOW}</a></td>
</tr>
</table>
</form>
