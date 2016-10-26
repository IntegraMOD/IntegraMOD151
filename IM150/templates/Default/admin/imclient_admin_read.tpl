
<form method="post" action="{S_POST_ACTION}">
	<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
		<tr>
			<th colspan="4" class="thHead" nowrap="nowrap">{L_MESSAGE}</th>
		</tr>
		<tr>
			<td class="row2" width="15%"><span class="genmed">{L_FROM}:</span></td>
			<td class="row2" width="33%"><span class="genmed">{SITE_FROM}&nbsp;<a href="{U_FROM}" target="phpbbmain">{MESSAGE_FROM}</a></span></td>
			<td class="row2" width="10%"><span class="genmed">{L_TO}:</span></td>
			<td class="row2" width="32%"><span class="genmed">{SITE_TO}&nbsp;<a href="{U_TO}" target="phpbbmain">{MESSAGE_TO}</a></span></td>
		</tr>
		<tr>
			<td class="row2"><span class="genmed">{L_POSTED}:</span></td>
			<td colspan="3" class="row2"><span class="genmed">{POST_DATE}</span></td>
		</tr>
		<tr>
			<td class="row2"><span class="genmed">{L_SUBJECT}:</span></td>
			<td colspan="3" class="row2"><span class="genmed">{POST_SUBJECT}</span></td>
		</tr>
		<tr>
			<td valign="top" colspan="4" class="row1"><span class="postbody">{MESSAGE}</span></td>
		</tr>
		<tr>
			<td class="catBottom" colspan="4" height="28" align="center">{S_HIDDEN_FIELDS}
				<input type="submit" name="nosave" value="{L_REPLY}" class="mainoption" onClick="window.resizeTo({REPLY_WIDTH}, {REPLY_HEIGHT})">&nbsp; &nbsp;
				<input type="button" value="{L_CLOSE_WINDOW}" class="liteoption" onClick="window.close()" />
			</td>
		</tr>
	</table>
</form>
