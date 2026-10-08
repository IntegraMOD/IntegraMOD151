
<h1>{L_NETWORK_TITLE}</h1>

<p>{L_NETWORK_TEXT}</p>

<form method="post" action="{S_FORM_ACTION}"><table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
	<tr>
		<td class="row1">{L_URL}*</a></td>
		<td class="row2"><input class="post" type="text" name="site_url" size="50" maxlength="100" /></td>
	</tr>
	<tr>
		<td class="row2" colspan="2">{L_REQUIRED}</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="6" align="center">
			<input type="hidden" name="mode" value="autodetect" />
			<input type="submit" name="add" value="{L_SUBMIT}" class="mainoption" />
		</td>
	</tr>
</table></form>
