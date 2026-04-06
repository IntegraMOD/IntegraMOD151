<script language="javascript" type="text/javascript">
<!--
function photo_choose(photofile) {
	opener.document.forms['post'].photolocal.value = photofile;
	opener.focus();
	window.close();
}
//-->
</script>

<form method="post" name="photo_select" action="{S_PHOTO_SELECT_ACTION}">
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="forumline">
<tr>
	<th valign="middle">{L_PHOTO_GALLERY}</th>
</tr>
<tr>
	<td class="catBottom" align="center" valign="middle">
		<span class="genmed">{L_CATEGORY}:&nbsp;{S_CATEGORY_SELECT}&nbsp;<input type="submit" class="liteoption" value="{L_GO}" name="photogallery" /></span>
	</td>
</tr>
<tr>
	<td class="row3">
		<table cellpadding="3" cellspacing="1" width="100%" border="0">
		<!-- BEGIN photo_row -->
		<tr> 
			<!-- BEGIN photo_column -->
			<td class="row1" align="center"><a href="javascript:photo_choose('{photo_row.photo_column.PHOTO_FILE}')">
				<img src="{photo_row.photo_column.PHOTO_IMAGE}" alt="{photo_row.photo_column.PHOTO_NAME}" title="{photo_row.photo_column.PHOTO_NAME}" border="0"/>
			</a></td>
			<!-- END photo_column -->
		</tr>
		<!-- END photo_row -->
		</table>
	</td>
</tr>
<tr> 
	<td class="catBottom" align="center">{S_HIDDEN_FIELDS}<a href="javascript:window.close();" class="genmed">{L_CLOSE_WINDOW}</a></td>
</tr>
</table>
</form>
