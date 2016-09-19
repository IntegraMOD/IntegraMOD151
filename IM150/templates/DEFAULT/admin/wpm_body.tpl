<form action="{S_WELCOME_ACTION}" method="post">

{S_HIDDEN_FIELDS}

<h1>{L_WPM}</h1>

<p>{L_WPM_EXPLAIN}</p>

<p><table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th align="center" class="thTop" nowrap="nowrap" colspan="2">&nbsp;{L_WPM}&nbsp;</th>
	</tr>
	<tr>
		<td class="row1" align="left" valign="top" width="50%">
			<span class="gen">{L_WPM_ACTIVE}</span><br />
		</td>
		<td class="row1" align="left" valign="middle" width="50%"><span class="gen">
			<input type="radio" name="active_wpm" value="1" id="checkbox_active_wpm_1" {WPM_ACTIVE_YES} /> <label for="checkbox_active_wpm_1">{L_YES}</label>
			<input type="radio" name="active_wpm" value="0" id="checkbox_active_wpm_0" {WPM_ACTIVE_NO} /> <label for="checkbox_active_wpm_0">{L_NO}</label>
		</span></td>
	</tr>
		<tr>
		<td class="row1" align="left" valign="top" width="50%">
			<span class="gen">{L_WPM_NAME}</span>
		</td>
		<td class="row1" align="left" valign="middle" width="50%"><span class="gen">
			<input type="text" name="wpm_username" value="{WPM_USERNAME}" />
		</span></td>
	</tr>

	<tr>
		<td class="row1" align="left" valign="top" width="30%">
			<span class="gen">{L_WPM_SUBJECT}</span><br />
		</td>
		<td class="row1" align="left" valign="middle" width="70%"><span class="gen">
			<input type="text" name="wpm_subject" size="45" maxlength="100" tabindex="2" class="post" value="{WPM_SUBJECT}" />
		</span></td>
	</tr>
	<tr>
		<td class="row1" align="left" valign="top" width="30%">
			<span class="gen">{L_WPM_MESSAGE}</span><br />
		</td>
		<td class="row1" align="left" valign="middle" width="70%"><span class="gen">
			<textarea name="wpm_message" rows="15" cols="35" wrap="virtual" style="width:450px" tabindex="3" class="post">{WPM_MESSAGE}</textarea>
		</span></td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" /></td>
	</tr>
</table></p>
<div align="center"><span class="copyright">Designed by <a href="http://www.vitrax.vze.com/" target="_vitrax" class="copyright">Duvelske</a><br />WPM v. {WPM_VERSION}</span></div>

</form>
<br clear="all" />