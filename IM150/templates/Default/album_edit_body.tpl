<script>
<!--
function checkAlbumForm() {
	formErrors = false;

	if (document.editform.pic_title.value.length < 2)
	{
		formErrors = "{L_UPLOAD_NO_TITLE}";
	}
	else if (document.editform.pic_desc.value.length > {S_PIC_DESC_MAX_LENGTH})
	{
		formErrors = "{L_DESC_TOO_LONG}";
	}

	if (formErrors)
	{
		alert(formErrors);
		return false;
	}
	else
	{
		return true;
	}
}
// -->
</script>

<form name="editform" action="{S_ALBUM_ACTION}" method="post" onsubmit="return checkAlbumForm()">
<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td class="nav" width="100%">
			<span class="nav">
				<a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEP}
				<a class="nav" href="{U_ALBUM}">{L_ALBUM}</a>{NAV_SEP}
				<a class="nav" href="{U_VIEW_CAT}">{CAT_TITLE}</a>
			</span>
		</td>
	</tr>
</table>
<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr><th class="thTop" height="25" colspan="2">{L_EDIT_PIC_INFO}</th></tr>
	<tr>
		<td class="row1" width="30%" height="28"><span class="gen">{L_PIC_TITLE}</span></td>
		<td class="row2"><input class="post" type="text" name="pic_title" size="60" value="{PIC_TITLE}" /></td>
	</tr>
	<tr>
		<td class="row1" valign="top" width="30%" height="28"><span class="gen">{L_PIC_DESC}<br /></span><span class="genmed">{L_PLAIN_TEXT_ONLY}<br />{L_MAX_LENGTH}: <b>{S_PIC_DESC_MAX_LENGTH}</b></span></td>
		<td class="row2"><textarea class="post" cols="60" rows="4" name="pic_desc">{PIC_DESC}</textarea></td>
	</tr>
	<tr>
		<td class="catBottom" align="center" height="28" colspan="2"><input type="reset" value="{L_RESET}" class="liteoption" />&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" /></td>
	</tr>
</table>
</form>
<br />
<!-- You must keep my copyright notice visible with its original content -->
{ALBUM_COPYRIGHT}
