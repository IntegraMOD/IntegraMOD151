<h2>{L_STEP}</h2> 
<h3>{L_ALTERATIONS}</h3>
<p>{L_SQL_INTRO}</p>

<!-- BEGIN drop_warning -->
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
	<tr>
		<th height="25" class="thHead" nowrap="nowrap">{L_URGENT_WARNING}</th>
	</tr>
	<tr>
		<td class="row1">
			<table border="0" cellpadding="3" cellspacing="1" width="100%">
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
				<tr>
					<td width="100%" align="center"><span class="gen">{L_SQL_DROP_WARN}</span></td>
				</tr>
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br />
<!-- END drop_warning -->

<!-- BEGIN msaccess -->
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
	<tr>
		<th height="25" class="thHead" nowrap="nowrap">{L_NOTICE}</th>
	</tr>
	<tr>
		<td class="row1">
			<table border="0" cellpadding="3" cellspacing="1" width="100%">
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
				<tr>
					<td width="100%" align="center"><span class="gen">{L_SQL_MSACCESS_WARN}</span></td>
				</tr>
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br />
<!-- END msaccess -->

<!-- BEGIN sql_error -->
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
	<tr>
		<th height="25" class="thHead" nowrap="nowrap">{L_SQL_ERROR}</th>
	</tr>
	<tr>
		<td class="row1">
			<table border="0" cellpadding="3" cellspacing="1" width="100%">
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
				<tr>
					<td width="100%" align="center"><div class="gen"><b>{L_SQL_HALTED}</b><br />
						<br />{L_SQL_ERROR_EXPLAIN}<br />
						<br />
						{L_FAILED_LINE}:<br />
						<table cellpadding="4" border="0"><tr><td><pre style="text-align:left;">{sql_error.LINE}</pre></td></tr></table>
						<br />
						{L_SQL_ERROR}: {sql_error.ERROR_CODE}<br />
						{sql_error.ERROR_MSG}</div>
					</td>
				</tr>
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br />
<!-- END sql_error -->

<!-- BEGIN experimental -->
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
	<tr>
		<th height="25" class="thHead" nowrap="nowrap">{L_NOTICE}</th>
	</tr>
	<tr>
		<td class="row1">
			<table border="0" cellpadding="3" cellspacing="1" width="100%">
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
				<tr>
					<td width="100%" align="center"><span class="gen">{L_EXPERIMENTAL_EXPLAIN}</span></td>
				</tr>
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br />
<!-- END experimental -->

<!-- BEGIN warnings_block -->
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
	<tr>
		<th height="25" class="thHead" nowrap="nowrap">{warnings_block.TITLE}</th>
	</tr>
	<tr>
		<td class="row1">
			<table cellpadding="4" cellspacing="0" border="0" align="center">
				<tr><td align="left">
					<div class="genmed"><ol>
					<!-- BEGIN line -->
					<li style="margin-bottom:8px;">{warnings_block.line.TEXT}</li>
					<!-- END line -->
					</ol></div>
				</td></tr>
			</table>
		</td>
	</tr>
</table>
<br />
<!-- END warnings_block -->

<form name="sqlform" method="post" action="{S_ACTION}">
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
	<tr>
		<th width="5%" height="25" class="thCornerL">&nbsp;</th>
		<th width="90%" height="25" class="thTop">{L_PSEUDO}</th>
		<th width="5%" height="25" class="thCornerR">{L_ALLOW}</th>
	</tr>

	<!-- BEGIN error -->
	<tr>
		<td class="row1" colspan="3">
			<table border="0" cellpadding="3" cellspacing="1" width="100%">
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
				<tr>
					<td width="100%" align="center"><div class="gen">
						<b>{L_SQL_PROCESS_ERROR}:</b><br />
						{L_NO_SQL_PREFORMED}<br />
						<br />
						{L_FOLLOWING_ERROR}:<br />
						<br />
						{error.ERROR_MSG}
					</div></td>
				</tr>
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
	<!-- END error -->

	<!-- BEGIN no_sql -->
	<tr>
		<td class="row1" colspan="3">
			<table border="0" cellpadding="3" cellspacing="1" width="100%">
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
				<tr>
					<td width="100%" align="center"><span class="gen">{L_NO_SQL}</span></td>
				</tr>
				<tr>
					<td align="center">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
	<!-- END no_sql -->

	<!-- BEGIN sql_row -->
	<tr>
		<td width="5%" align="center" class="{sql_row.ROW_CLASS}"><span class="genmed">&nbsp;{sql_row.STMT_COUNT}&nbsp;</span></td>
		<td width="90%" class="{sql_row.ROW_CLASS}"><pre>{sql_row.DISPLAY_SQL}</pre></td>
		<td width="5%" align="center" class="{sql_row.ROW_CLASS}">
			{sql_row.HIDDEN_SQL}
			{sql_row.CHECK}
		</td>
	</tr>
	<!-- END sql_row -->

	<tr>
		<td class="catBottom" colspan="3" align="center" height="28">
			{HIDDEN}
			<input type="hidden" name="mode" value="{MODE}" />
			<input type="hidden" name="themes" value="{THEMES}" />
			<input type="hidden" name="languages" value="{LANGUAGES}" />
			<input type="hidden" name="files" value="{FILES}" />
			<input type="hidden" name="num_proc" value="{PROCESSED}" />
			<input type="hidden" name="num_unproc" value="{UNPROCESSED}" />
			<input type="hidden" name="install_file" value="{MOD_FILE}" />
			<input type="hidden" name="install_path" value="{MOD_PATH}" />
			<input type="hidden" name="password" value="{EM_PASS}" />
			<input type="submit" name="post" class="mainoption" value="{L_COMPLETE}" />
		</td>
	</tr>
</table>
<!-- BEGIN sql_rows -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td align="right"><span class="nav"><b><a href="javascript:marklist('sqlform', true);this.blur();">{L_MARK_ALL}</a> :: <a href="javascript:marklist('sqlform', false);this.blur();">{L_UNMARK_ALL}</a></b>&nbsp;</span></td>
	</tr>
</table>
<!-- END sql_rows -->
</form>
<br />
<script language="javascript" type="text/javascript"><!--
function marklist(formname, status)
{
	for( i = 0; i < document.forms[formname].length; i++ )
	{
		document.forms[formname].elements[i].checked = status;
	}
}
//--></script>