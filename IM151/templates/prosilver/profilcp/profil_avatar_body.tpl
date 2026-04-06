<table cellpadding="0" cellspacing="10" border="0" width="100%">
<form action="{S_PROFILCP_ACTION}" method="post" name="post" {S_FORM_ENCTYPE}>
<tr>
	<td valign="top" align="center">
		<table cellpadding="4" cellspacing="1" border="0" class="forumline">
		<tr> 
			<th colspan="2" valign="middle">{L_AVATAR_PANEL}</th>
		</tr>
		<tr>
			<td class="row1" colspan="2">
				<table width="70%" cellspacing="2" cellpadding="0" border="0" align="center">
				<tr> 
					<td width="65%"><span class="gensmall">{L_AVATAR_EXPLAIN}</span></td>
					<td align="center"><span class="gensmall">{L_CURRENT_IMAGE}</span><br />{AVATAR}<br /><input type="checkbox" name="avatardel" />&nbsp;<span class="gensmall">{L_DELETE_AVATAR}</span></td>
				</tr>
				</table>
			</td>
		</tr>
		<!-- BEGIN switch_avatar_local_upload -->
		<tr> 
			<td class="row1" width="50%"><span class="gen">{L_UPLOAD_AVATAR_FILE}:</span></td>
			<td class="row2" width="50%"><input type="hidden" name="MAX_FILE_SIZE" value="{AVATAR_SIZE}" /><input type="file" name="avatar" class="post" style="width:200px" /></td>
		</tr>
		<!-- END switch_avatar_local_upload -->
		<!-- BEGIN switch_avatar_remote_upload -->
		<tr> 
			<td class="row1"><span class="gen">{L_UPLOAD_AVATAR_URL}:</span><br /><span class="gensmall">{L_UPLOAD_AVATAR_URL_EXPLAIN}</span></td>
			<td class="row2"><input type="text" name="avatarurl" size="40" class="post" style="width:200px" /></td>
		</tr>
		<!-- END switch_avatar_remote_upload -->
		<!-- BEGIN switch_avatar_remote_link -->
		<tr> 
			<td class="row1"><span class="gen">{L_LINK_REMOTE_AVATAR}:</span><br /><span class="gensmall">{L_LINK_REMOTE_AVATAR_EXPLAIN}</span></td>
			<td class="row2"><input type="text" name="avatarremoteurl" size="40" class="post" style="width:200px" /></td>
		</tr>
		<!-- END switch_avatar_remote_link -->
		<!-- BEGIN switch_avatar_local_gallery -->
		<tr> 
			<td class="row1"><span class="gen">{L_AVATAR_GALLERY}:</span></td>
			<td class="row2"><input type="text" name="avatarlocal" size="40" class="post" style="width:200px">&nbsp;<input type="submit" name="avatargallery" value="{L_SHOW_GALLERY}" class="liteoption" onClick="window.open('{U_AVATAR_SELECT}', '_phpbbavatar', 'HEIGHT=400,resizable=yes,scrollbars=yes,WIDTH=620');return false;" /></td>
		</tr>
		<!-- END switch_avatar_local_gallery -->
		<tr>
			<td class="cat" colspan="2" align="center">
				<input type="submit" name="submit" class="mainoption" value="{L_SUBMIT}">
				<input type="submit" name="reset" class="liteoption" value="{L_RESET}">
				{S_HIDDEN_FIELDS}
			</td>
		</tr>
		</table>
	</td>
</tr>
</form>
</table>