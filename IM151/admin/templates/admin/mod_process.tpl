<!-- BEGIN fail -->
<h2>{fail.L_FAILED}</h2>

<p>{fail.L_FAILED_DESC}</p>
<!-- END fail -->

<!-- BEGIN error -->
<br />
<table class="forumline" width="100%" cellspacing="1" cellpadding="4" border="0">
	<tr>
		<th>{error.L_TITLE}</th>
	</tr>
	<tr> 
		<td class="row1"><table width="100%" cellspacing="0" cellpadding="1" border="0">
			<tr> 
				<td>&nbsp;</td>
			</tr>
			<tr> 
				<td align="center"><span class="gen">{error.ERROR_MESSAGE}</span></td>
			</tr>
			<tr> 
				<td>&nbsp;</td>
			</tr>
		</table></td>
	</tr>
</table>
<!-- END error -->


<!-- BEGIN success -->
<h2>{success.L_STEP}</h2>
<h3>{success.L_COMPLETE}</h3>
<p>{success.L_DESC}</p>
<!-- END success -->

<form action="{S_ACTION}" name="install" method="post">
<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline" width="100%">
	<tr>
		<th class="thCornerL" colspan="2" width="100%">{L_MOD_DATA}</th>
	</tr>
	<tr>
		<td class="row1" align="left" width="25%"><span class="gen">{L_MOD_TITLE}:</span></td>
		<td class="row2" align="left" width="75%"><span class="gen">{TITLE} &nbsp;&nbsp;&nbsp; {VERSION} &nbsp;&nbsp;&nbsp; {MOD_FILE}</span></td>
	</tr>
	<tr>
		<td class="row1" align="left" width="25%"><span class="gen">{L_AUTHOR}:</span></td>
		<td class="row2" align="left" width="75%"><span class="gen">{AUTHOR} &nbsp;&nbsp;&nbsp; {EMAIL} &nbsp;&nbsp;&nbsp; {REAL_NAME} &nbsp;&nbsp;&nbsp; <a href="{URL}" target="_blank">{URL}</a></span></td>
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
		<td class="row2" align="left" width="75%"><span class="gen">{FILES}</span></td>
	</tr>
	<tr>
		<td class="row1" align="left" width="25%"><span class="gen">{L_PROCESSED}:</span></td>
		<td class="row2" align="left" width="75%"><span class="gen">{PROCESSED}</span></td>
	</tr>
	<tr>
		<td class="row1" align="left" width="25%"><span class="gen">{L_UNPROCESSED}:</span></td>
		<td class="row2" align="left" width="75%"><span class="gen">{UNPROCESSED}</span></td>
	</tr>
<!-- BEGIN success -->
	<tr>
		<td class="catBottom" align="center" width="100%" colspan="2">
			<input type="hidden" name="mode" value="SQL_view" />
			{success.HIDDEN}
			<input type="hidden" name="themes" value="{THEMES}" />
			<input type="hidden" name="languages" value="{LANGUAGES}" />
			<input type="hidden" name="files" value="{FILES}" />
			<input type="hidden" name="num_proc" value="{PROCESSED}" />
			<input type="hidden" name="num_unproc" value="{UNPROCESSED}" />
			<input type="hidden" name="install_file" value="{success.MOD_FILE}" />
			<input type="hidden" name="install_path" value="{success.MOD_PATH}" />
			<input type="hidden" name="password" value="{EM_PASS}" />
			<input class="mainoption" type="submit" value="{success.L_NEXT_STEP}" />
		</td>
	</tr>
<!-- END success -->
</table>
</form>

<br />
<table width="100%">
<tr><td><span class="gen">{L_UNPROCESSED_DESC}</span></td></tr>
<tr><td>
<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline" width="100%">
	<tr>
		<th class="thCornerL">{L_UNPROCESSED}</th>
	</tr>
	<!-- BEGIN unprocessed -->
	<tr>
		<td class="{unprocessed.ROW_CLASS}" align="left" height="25"><div class="gen">{unprocessed.LINE}</div></td>
	</tr>
	<!-- END unprocessed -->			
</table>
</td></tr></table>


<br />
<table width="100%">
<tr><td><span class="gen">{L_PROCESSED_DESC}</span></td></tr>
<tr><td>
<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline" width="100%">
	<tr>
		<th class="thCornerL">{L_PROCESSED}</th>
	</tr>
	<!-- BEGIN processed -->
	<tr>
		<td class="{processed.ROW_CLASS}" align="left" height="25"><div class="gen">{processed.LINE}</div></td>
	</tr>
	<!-- END processed -->			
</table>
</td></tr></table>
<br />
