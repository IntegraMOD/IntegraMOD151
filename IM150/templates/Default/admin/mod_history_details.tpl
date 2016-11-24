<form action="{S_ACTION}" method="post">
<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline" width="100%">
	<tr>
		<th class="thCornerL" colspan="2" width="100%">{L_MOD_DATA}</th>
	</tr>
	<tr>
		<td class="row1" align="left" width="25%"><span class="gen">{L_MOD_TITLE}:</span></td>
		<td class="row2" align="left" width="75%"><span class="gen">{TITLE} &nbsp;&nbsp;&nbsp; {VERSION} &nbsp;&nbsp;&nbsp; {MOD_FILE}</span></td>
	</tr>
	<tr>
		<td class="row1" align="left" width="25%"><span class="gen">{L_MOD_DESCRIPTION}:</span></td>
		<td class="row2" align="left" width="75%"><span class="gen">{DESCRIPTION}</span></td>
	</tr>
	<tr>
		<td class="row1" align="left" width="25%"><span class="gen">{L_AUTHOR}:</span></td>
		<td class="row2" align="left" width="75%"><span class="gen">{AUTHOR} &nbsp;&nbsp;&nbsp; <a href="mailto:{EMAIL}">{EMAIL}</a> &nbsp;&nbsp;&nbsp; {REAL_NAME} &nbsp;&nbsp;&nbsp; <a href="{URL}" target="_blank">{URL}</a></span></td>
	</tr>
	<tr>
		<td class="row1" align="left" width="25%"><span class="gen">{L_INSTALL_DATE}:</span></td>
		<td class="row2" align="left" width="75%"><span class="gen">{DATE}</span></td>
	</tr>
	<tr>
		<td class="row1" align="left" width="25%"><span class="gen">{L_PHPBB_VER}:</span></td>
		<td class="row2" align="left" width="75%"><span class="gen">{PHPBB_VERSION}</span></td>
	</tr>
	<tr>
		<td class="row1" align="left" width="25%"><span class="gen">{L_THEMES}:</span></td>
		<td class="row2" align="left" width="75%"><span class="gen">{THEMES}</span></td>
	</tr>
	<tr>
		<td class="row1" align="left" width="25%"><span class="gen">{L_LANGUAGES}:</span></td>
		<td class="row2" align="left" width="75%"><span class="gen">{LANGUAGES}</span></td>
	</tr>
	<tr>
		<td class="row1" align="left" width="25%"><span class="gen">{L_FILES}:</span></td>
		<td class="row2" align="left" width="75%"><span class="gen">{FILES}{FILE_LIST}</span></td>
	</tr>
	<tr>
		<td class="row1" align="left" width="25%"><span class="gen">{L_DB_ALTS}:</span></td>
		<td class="row2" align="left" width="75%"><span class="gen">{L_ADDED}: {ADDED}&nbsp;&nbsp;&nbsp; {L_ALTERED}: {ALTERED}&nbsp;&nbsp;&nbsp; {L_INSERTED}: {INSERTED}</span></td>
	</tr>
	<tr>
		<td class="catbottom" align="center" colspan="2">
			<select name="mode" class="post">
				<option value="history">{L_BACK_TO_HISTORY}</option>
				<!-- BEGIN switch_files -->
				<option value="del_files">{L_DELETE_FILES}</option>
				<!-- END switch_files -->
				<option value="del_record">{L_DELETE_RECORD}</option>
				<!-- BEGIN switch_backups -->
				<option value="restore_backups">{L_RESTORE_BACKUPS}</option>
				<!-- END switch_backups -->
				<!-- BEGIN switch_install_file -->
				<option value="install_lang">{L_INSTALL_LANG}</option>
				<option value="install_themes">{L_INSTALL_THEMES}</option>
				<option value="uninstall">{L_UNISTALL}</option>
				<!-- END switch_install_file -->
			</select>
			{S_HIDDEN_FIELDS}
			<input type="submit" name="submit" value="{L_GO}" class="mainoption">
		</td>
	</tr>
</table>
</form>