<script language="Javascript" type="text/javascript">
	// Lifted from privmsg page
	function select_switch()
	{
		for (i = 0; i < document.smilies_delete.length; i++)
		{
			document.smilies_delete.elements[i].checked = true;
		}
	}
</script>

<!-- BEGIN switch_no_uploads -->
{switch_no_uploads.L_SORRY}
<!-- END switch_no_uploads -->

<!-- BEGIN switch_uploads -->
<form action="{S_PROFILE_ACTION}" {S_FORM_ENCTYPE} method="post">
{ERROR_BOX}
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thSides" colspan="2" height="12" valign="middle">{L_SMILIES_UPLOAD}</th>
	</tr>
	<tr>
		<td class="row1" colspan="2">
			<span class="genmed">{L_UPLOAD_EXPLAIN}</span>
		</td>
	</tr>
	<tr>
		<td class="row1" width="50%"><span class="gen">{L_UPLOAD_FILE}:</span></td>
		<td class="row2"><input type="hidden" name="MAX_FILE_SIZE" value="{SMILIES_SIZE}" /><input type="file" name="imagefile" class="post" /></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_UPLOAD_NAME}:</span><br /><span class="gensmall">{L_NAME_EXPLAIN}</span></td>
		<td class="row2"><span class="gensmall"><input type="checkbox" name="defaultname" checked="checked" /> {L_DEFAULT_NAME}</span><br /><input type="text" name="imagename" size="40" class="post" style="width:200px" /></td>
	</tr>
	<tr>
		<td class="row1" colspan="2"><span class="gen"><input type="checkbox" name="autoadd" checked="checked" /> {L_AUTO_ADD}</span></td>
	</tr>
	<tr>
		<td class="cat" colspan="2" align="center" height="28">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" name="reset" class="liteoption" /></td>
	</tr>
</table>
</form>
<!-- END switch_uploads -->


<form action="{S_PROFILE_ACTION}" method="post" name="smilies_delete">
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thSides" colspan="{COL_NUMBER}" height="12" valign="middle">{L_UPLOADED_SMILIES}</th>
	</tr>
	<!-- BEGIN none_uploaded -->
	<tr>
		<td class="row1" colspan="{COL_NUMBER}">
			<span class="gen">{none_uploaded.L_SORRY_NONE}</span>
		</td>
	</tr>
	<!-- END none_uploaded -->
	<!-- BEGIN uploaded_row -->
	<tr>
		<!-- BEGIN uploaded_cell -->
		<td class="row1">
			<span class="gensmall"><img src="{SMILIES_PATH}/{uploaded_row.uploaded_cell.SMILIES_NAME}" />
			<input type="checkbox" name="delete_smilies[]" value="{uploaded_row.uploaded_cell.SMILIES_NAME}" /><br />
			{uploaded_row.uploaded_cell.SMILIES_NAME}
			</span>
		</td>
		<!-- END uploaded_cell -->
		<!-- BEGIN empty_cell -->
		<td class="row1">
			&nbsp;
		</td>
		<!-- END empty_cell -->
	</tr>
	<!-- END uploaded_row -->
	<tr>
		<td class="cat" colspan="{COL_NUMBER}" align="center" height="28">{S_HIDDEN_DELETE}<input type="submit" name="submit" value="{L_DELETE_MARKED}" class="mainoption" />&nbsp;&nbsp;<input type="button" name="markall" onclick="javascript:select_switch();" class="liteoption" value="{L_MARK_ALL}" />&nbsp;&nbsp;<input type="reset" value="{L_UNMARK_ALL}" name="reset" class="liteoption" />
		</td>
	</tr>
</table>
</form>


<div align="center"><span class="copyright">Smilies Upload Utility &copy; 2003 <a href="http://darkmods.sourceforge.net/" class="copyright">Thoul</a></span></div>