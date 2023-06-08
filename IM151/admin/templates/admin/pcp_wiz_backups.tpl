<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>
<p>{HELP}</p>
<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<!-- BEGIN message -->
<tr>
	<td class="errorline" align="center" colspan="3">
		{message.text}
	</td>
</tr>
<!-- END message -->
<tr>
	<th nowrap="nowrap">{L_BACKUP}</th>
	<th nowrap="nowrap">{L_ACTIONS}</th>
</tr>
<tr><td align="center" colspan="2"><h2>{L_FIELDS}</h2></td></tr>
<!-- BEGIN fields -->
<tr>
	<td class="{fields.COLOR}">
		<span class="explaintitle">{fields.name}</span><br />
		<span class="gensmall">{fields.file}</span>
	</td>
	<td class="{fields.COLOR}">
		<input type="button" name="{fields.name}" value="{L_RESTORE}" class="mainoption" onclick="document.location = '{fields.restore}';" />
		<input type="button" name="{fields.name}" value="{L_DELETE}" class="mainoption" onclick="document.location = '{fields.delete}';" />
		<input type="button" name="{fields.name}" value="{L_VIEW}" class="mainoption" onclick="document.location = '{fields.view}';" />
	</td>
</tr>
<!-- END fields -->
<tr><td align="center" colspan="2"><h3>{L_PAGES}</h3></td></tr>
<!-- BEGIN pages -->
<tr>
	<td class="{pages.COLOR}">
		<span class="explaintitle">{pages.name}</span><br />
		<span class="gensmall">{pages.file}</span>
	</td>
	<td class="{pages.COLOR}">
		<input type="button" name="{pages.name}" value="{L_RESTORE}" class="mainoption" onclick="document.location = '{pages.restore}';" />
		<input type="button" name="{pages.name}" value="{L_DELETE}" class="mainoption" onclick="document.location = '{pages.delete}';" />
		<input type="button" name="{pages.name}" value="{L_VIEW}" class="mainoption" onclick="document.location = '{pages.view}';" />
	</td>
</tr>
<!-- END pages -->
<tr><td>&nbsp;</td></tr>
<tr>
	<th colspan="2"><input type="button" name="backup" value="{L_BACKUPNOW}" class="mainoption" onclick="document.location = '{U_BACKUPNOW}';" /></th>
</tr>
</table>
<br />