
<form action="{FORM_ACTION}" method="post">{S_HIDDEN_FIELDS}{S_EXTRA_FIELDS}<table width="100%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
		<th class="thHead" colspan="2">FTP Settings</th>
	</tr>
	<tr>
		<td class="row3" colspan="2" align="left"><span class="gensmall">To use selected feature you must set FTP settings. Password will not be stored and eXtreme Styles mod will ask you password every time you select function that requires FTP.</span></td>
	</tr>
	<tr>
		<td class="row1">FTP Host{XS_FTP_HOST2}:</td>
		<td class="row2"><input class="post" type="text" name="xs_ftp_host" value="{XS_FTP_HOST}" /></td>
	</tr>
	<tr>
		<td class="row1">FTP Login{XS_FTP_LOGIN2}:</td>
		<td class="row2"><input class="post" type="text" name="xs_ftp_login" value="{XS_FTP_LOGIN}" /></td>
	</tr>
	<tr>
		<td class="row1">FTP Path to phpBB{XS_FTP_PATH2}:</td>
		<td class="row2"><input class="post" type="text" name="xs_ftp_path" value="{XS_FTP_PATH}" /></td>
	</tr>
	<tr>
		<td class="row1">FTP Password:</td>
		<td class="row2"><input class="post" type="text" name="xs_ftp_pass" /></td>
	</tr>
	<tr>
		<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" /></td>
	</tr>
</table></form>
