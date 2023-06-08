
<form action="{FORM_ACTION}" method="post"><table width="100%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
	  <th class="thHead" colspan="2">{L_XS_SETTINGS}</th>
	</tr>
	<!-- BEGIN switch_updated -->
	<tr>
		<td class="row3" colspan="2" align="left">{L_XS_UPDATED}<br /><br /><span class="gensmall">{L_XS_UPDATED_EXPLAIN}</span></td>
	</tr>
	<!-- END switch_updated -->
	<!-- BEGIN switch_xs_warning -->
	<tr>
		<td class="row3" colspan="2" align="left">{L_XS_WARNING}<br /><a href="{U_CHMOD}">Click here</a> to try to change access mode to cache directory (you should set FTP settings below before doing it).<br /><br /><span class="gensmall">{L_XS_WARNING_EXPLAIN}</span></td>
	</tr>
	<!-- END switch_xs_warning -->
	<tr>
		<td class="row1">{L_XS_DEF_TEMPLATE}<br /><span class="gensmall">{L_XS_DEF_TEMPLATE_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" name="xs_def_template" value="{XS_DEF_TEMPLATE}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_XS_CHECK_SWITCHES}<br /><span class="gensmall">{L_XS_CHECK_SWITCHES_EXPLAIN}</span></td>
		<td class="row2">
			<input type="radio" name="xs_check_switches" value="0" {XS_CHECK_SWITCHES_0} /> {L_XS_CHECK_SWITCHES_0}<br />
			<br />
			<input type="radio" name="xs_check_switches" value="2" {XS_CHECK_SWITCHES_2} /> {L_XS_CHECK_SWITCHES_2}<br />
			<br />
			<input type="radio" name="xs_check_switches" value="1" {XS_CHECK_SWITCHES_1} /> {L_XS_CHECK_SWITCHES_1}
		</td>
	</tr>
	<tr>
		<td class="row1">Show errors when files are incorrectly includes in tpl files<br /><span class="gensmall">This feature enables/disables errors when in tpl file user used incorrect &lt;!-- INCLUDE filename --&gt;</span></td>
		<td class="row2"><input type="radio" name="xs_warn_includes" value="1" {XS_WARN_INCLUDES_1} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="xs_warn_includes" value="0" {XS_WARN_INCLUDES_0} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">Add tpl comments<br /><span class="gensmall">This feature adds comments to html code that allow style designers to detect which tpl file is displayed.</span></td>
		<td class="row2"><input type="radio" name="xs_add_comments" value="1" {XS_ADD_COMMENTS_1} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="xs_add_comments" value="0" {XS_ADD_COMMENTS_0} /> {L_NO}</td>
	</tr>
	<tr>
	  <th class="thHead" colspan="2">{L_XS_SETTINGS_CACHE}</th>
	</tr>
	<tr>
		<td class="row1">{L_XS_USE_CACHE}<br /><span class="gensmall">{L_XS_CACHE_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="xs_use_cache" value="1" {XS_USE_CACHE_1} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="xs_use_cache" value="0" {XS_USE_CACHE_0} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_XS_AUTO_COMPILE}<br /><span class="gensmall">{L_XS_AUTO_COMPILE_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="xs_auto_compile" value="1" {XS_AUTO_COMPILE_1} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="xs_auto_compile" value="0" {XS_AUTO_COMPILE_0} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_XS_AUTO_RECOMPILE}<br /><span class="gensmall">{L_XS_AUTO_RECOMPILE_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="xs_auto_recompile" value="1" {XS_AUTO_RECOMPILE_1} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="xs_auto_recompile" value="0" {XS_AUTO_RECOMPILE_0} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_XS_PHP}<br /><span class="gensmall">{L_XS_PHP_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" name="xs_php" value="{XS_PHP}" /></td>
	</tr>
	<tr>
		<th class="thHead" colspan="2">FTP Settings</th>
	</tr>
	<!-- BEGIN noftp -->
	<tr>
		<td class="row1" colspan="2" align="left">Warning: FTP functions are disabled on this server. You will not be able to use eXtreme Styles mod functions that require FTP access.</td>
	</tr>
	<!-- END noftp -->
	<!-- BEGIN ftperror -->
	<tr>
		<td class="row1" colspan="2" align="left">{ftperror.ERROR}</td>
	</tr>
	<!-- END ftperror -->
	<tr>
		<td class="row3" colspan="2" align="left"><span class="gensmall">FTP is used to upload new styles. If you want to use import styles feature then you should configure FTP settings. If you don't know FTP directory where phpBB is stored then set directory to "empty" and click "autodetect" button to try to detect directory".</span></td>
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
		<td class="row2"><input class="post" type="text" name="xs_ftp_path" value="{XS_FTP_PATH}" /> <input type="submit" name="ftp_autodetect" value="Try to detect" class="liteoption" disabled="disabled" /></td>
	</tr>
	<tr>
		<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" /></td>
	</tr>
</table></form>

<br clear="all" />


<table width="100%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
	  <th class="thHead" colspan="2">{L_XS_DEBUG_HEADER}</th>
	</tr>
	<tr>
		<td colspan="2" class="row3" align="left"><span class="gensmall">{L_XS_DEBUG_EXPLAIN}</span></td>
	</tr>
<!--	<tr>
		<th class="thHead" colspan="2">{L_XS_DEBUG_VARS}</th>
	</tr>
	<tr>
		<td class="row1" align="left"><span class="gen">{<b></b>TEMPLATE<b></b>}</span></td>
		<td class="row2" align="left"><span class="gen">{TEMPLATE}</span></td>
	</tr>
	<tr>
		<td class="row1" align="left"><span class="gen">{<b></b>PHP<b></b>}</span></td>
		<td class="row2" align="left"><span class="gen">{PHP}</span></td>
	</tr>
	<tr>
		<td class="row1" align="left"><span class="gen">{<b></b>TEMPLATE_NAME<b></b>}</span></td>
		<td class="row2" align="left"><span class="gen">{TEMPLATE_NAME}</span></td>
	</tr>
	<tr>
		<td class="row1" align="left"><span class="gen">{<b></b>LANG<b></b>}</span></td>
		<td class="row2" align="left"><span class="gen">{LANG}</span></td>
	</tr>-->
	<tr>
		<th class="thHead" colspan="2">{XS_DEBUG_HDR1}</th>
	</tr>
	<tr>
		<td class="row1" align="left"><span class="gen">{L_XS_DEBUG_TPL_NAME}</span></td>
		<td class="row2" align="left"><span class="gen">{XS_DEBUG_FILENAME1}</span></td>
	</tr>
	<tr>
		<td class="row1" align="left"><span class="gen">{L_XS_DEBUG_CACHE_FILENAME}</span></td>
		<td class="row2" align="left"><span class="gen">{XS_DEBUG_FILENAME2}</span></td>
	</tr>
	<tr>
		<td class="row1" align="left"><span class="gen">{L_XS_DEBUG_DATA}</span></td>
		<td class="row2" align="left"><span class="gensmall">{XS_DEBUG_DATA}</span></td>
	</tr>
</table>
