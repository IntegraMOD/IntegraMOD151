<script language="javaScript" type="text/javascript"><!--
function helpwin(mylink)
{
	if (! window.focus)return true;
	var href;
	if (typeof(mylink) == 'string')
		href=mylink;
	else
		href=mylink.href;
	window.open(href, 'easymod_help', 'width=400,height=300,scrollbars=yes,resizable=yes');
	return false;
}
//--></script>
<h2>{L_SETTINGS}</h2>
<p>{L_DESC}</p>
<form action="{S_ACTION}" name="settings" method="post">
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr>
		<th colspan="2">{L_PW_TITLE}</th>
	</tr>
	<tr>
		<td class="row2" align="center" colspan="2"><span class="gen">{L_PW_DESC}</span></td>
	</tr>
	<tr>
		<td class="row1" align="right"><span class="gen">{L_PW_SET}</span></td>
		<td class="row2"><input type="password" name="em_pass" value="{EM_PASS}" /></td>
	</tr>
	<tr>
		<td class="row1" align="right"><span class="gen">{L_PW_CONFIRM}</span></td>
		<td class="row2"><input type="password" name="em_pass_confirm" value="" /></td>
	</tr>
	<tr>
		<th colspan="2">{L_FILE_TITLE}</th>
	</tr>
	<tr>
		<td class="row2" align="center" colspan="2"><span class="gen">{L_FILE_DESC}</span></td>
	</tr>
<!--
////////// REMOVING READ METHOD UNTIL THERE IS MORE THAN ONE OPTION (if ever) ;-)
	<tr>
		<td class="row1" align="right"><span class="gen">{L_FILE_READ}</span></td>
		<td class="row2">
			<select style="width:140px" name="sel_read">{SELECT_READ}</select>
			&nbsp;&nbsp;(<a href="{U_HELP}#" onclick="return helpwin(this);">{L_HELP}</a>)
		</td>
	</tr>
-->
	<tr>
		<td class="row1" align="right"><span class="gen">{L_FILE_WRITE}</span></td>
		<td class="row2">
			<select style="width:140px" name="sel_write">{SELECT_WRITE}</select>
			&nbsp;&nbsp;(<a href="{U_HELP}#file_writing" onclick="return helpwin(this);">{L_HELP}</a>)
		</td>
	</tr>
	<tr>
		<td class="row1" align="right"><span class="gen">{L_FILE_MOVE}</span></td>
		<td class="row2">
			<select style="width:140px" name="sel_move">{SELECT_MOVE}</select>
			&nbsp;&nbsp;(<a href="{U_HELP}#file_moving" onclick="return helpwin(this);">{L_HELP}</a>)
		</td>
	</tr>
	<tr>
		<th colspan="2">{L_FTP_TITLE}</th>
	</tr>
	<tr>
		<td class="row2" align="center" colspan="2"><span class="gen">{L_FTP_DESC}</span></td>
	</tr>
	<tr>
		<td class="row1" align="right"><span class="gen">{L_FTP_DIR}</span></td>
		<td class="row2">
			<input type="text" name="ftp_dir" value="{FTP_PATH}" /> (ex: public_html/phpBB2)
			&nbsp;&nbsp;(<a href="{U_HELP}#ftp_dir" onclick="return helpwin(this);">{L_HELP}</a>)
		</td>
	</tr>
	<tr>
		<td class="row1" align="right"><span class="gen">{L_FTP_USER}</span></td>
		<td class="row2"><input type="text" name="ftp_user" value="{FTP_USER}" /></td>
	</tr>
	<tr>
		<td class="row1" align="right"><span class="gen">{L_FTP_PASS}</span></td>
		<td class="row2"><input type="password" name="ftp_pass" value="{FTP_PASS}" /> {L_SUPPLY_CHANGE}</td>
	</tr>
	<tr>
		<td class="row1" align="right"><span class="gen">{L_FTP_HOST}</span></td>
		<td class="row2">
			<input type="text" name="ftp_host" value="{FTP_HOST}" />
			&nbsp;&nbsp;(<a href="{U_HELP}#ftp_host" onclick="return helpwin(this);">{L_HELP}</a>)
		</td>
	</tr>
	<tr>
		<td class="row1" align="right"><span class="gen">{L_FTP_PORT}</span></td>
		<td class="row2">
			<input type="text" size="5" maxlength="5" name="ftp_port" value="{FTP_PORT}" />
			&nbsp;&nbsp;(<a href="{U_HELP}#ftp_port" onclick="return helpwin(this);">{L_HELP}</a>)
		</td>
	</tr>
	<tr>
		<td class="row1" align="right"><span class="gen">{L_FTP_DEBUG}</span></td>
		<td class="row2">
			<input type="radio" name="ftp_debug" value="1" /><span class="gen">{L_YES}</span>&nbsp;&nbsp;
			<input type="radio" name="ftp_debug" value="0" checked="checked" /><span class="gen">{L_NO}</span>&nbsp;&nbsp;<span class="gen">{L_FTP_DEBUG_WARN}</span>
			&nbsp;&nbsp;(<a href="{U_HELP}#ftp_debug" onclick="return helpwin(this);">{L_HELP}</a>)
		</td>
	</tr>
	<tr>
		<td class="row1" align="right"><span class="gen">{L_FTP_EXT}</span></td>
		<td class="row2">
			<input type="radio" name="ftp_type" value="ext" {FTP_EXT} /><span class="gen">{L_YES}</span>&nbsp;&nbsp;
			<input type="radio" name="ftp_type" value="fsock" {FTP_FSOCK} /><span class="gen">{L_NO}</span>&nbsp;&nbsp;<span class="gen">{L_FTP_EXT_WARN}</span>
			&nbsp;&nbsp;(<a href="{U_HELP}#ftp_php_ext" onclick="return helpwin(this);">{L_HELP}</a>)
		</td>
	</tr>
	<tr>
		<td class="row1" align="right"><span class="gen">{L_FTP_CACHE}</span></td>
		<td class="row2">
			<input type="radio" name="ftp_cache" value="1" {FTP_CACHE_YES} /><span class="gen">{L_YES}</span>&nbsp;&nbsp;
			<input type="radio" name="ftp_cache" value="0" {FTP_CACHE_NO} /><span class="gen">{L_NO}</span>&nbsp;&nbsp;<span class="gen">{L_FTP_EXT_WARN}</span>
			&nbsp;&nbsp;(<a href="{U_HELP}#ftp_cache" onclick="return helpwin(this);">{L_HELP}</a>)
		</td>
	</tr>
	<tr>
		<th colspan="2">{L_EM_VERSION}</th>
	</tr>
	<tr>
		<td class="row2" align="center" colspan="2"><span class="gen">{L_EMV_DESC}</span></td>
	</tr>
	<tr>
		<td class="row1" align="right"><span class="gen">{L_EM_VERSION}</span></td>
		<td class="row2"><input type="text" name="em_version" value="{EM_VERSION}" /></td>
	</tr>
	<tr> 
		<td class="catbottom" align="center" colspan="2">
			<input type="hidden" name="mode" value="{MODE}" />
			<input type="hidden" name="password" value="{EM_PASS}" />
			<input class="mainoption" type="submit" value="{L_SUBMIT}" />&nbsp;
		</td>
	</tr>
</table>
</form>
