<table width="100%" border="1" cellpadding="5">
<tr>
<td valign="top" class="row1" width="290">

	<br />
	<img src="./templates/nuttzy.jpg">
	<br />
	<span class="gen">{{EM_support}}</span><br />

</td><td valign="top" class="row2">
	<h2>{{EM_Settings}}</h2>

	<form action="{{U_FORM}}" name="install" method="post">
		<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">

		{{[./templates/empw_settings.tpl]}}

		<tr> 
			<td class="catbottom" align="center" colspan="2">

				{{[./templates/hidden_access.tpl]}}

				<input type="hidden" name="sel_read" value="{{SEL_READ}}">
				<input type="hidden" name="sel_write" value="{{SEL_WRITE}}">
				<input type="hidden" name="sel_move" value="{{SEL_MOVE}}">

				<input type="hidden" name="ftp_user" value="{{FTP_USER}}">
				<input type="hidden" name="ftp_pass" value="{{FTP_PASS}}">
				<input type="hidden" name="ftp_host" value="{{FTP_HOST}}">
				<input type="hidden" name="ftp_port" value="{{FTP_PORT}}">
				<input type="hidden" name="ftp_dir" value="{{FTP_DIR}}">
				<input type="hidden" name="ftp_debug" value="{{FTP_DEBUG}}">
				<input type="hidden" name="ftp_type" value="{{FTP_TYPE}}">
				<input type="hidden" name="ftp_cache" value="{{FTP_CACHE}}">

				<input type="hidden" name="install_step" value="2">
				<input class="mainoption" type="submit" value="{{Submit}}" />&nbsp;
				<input class="mainoption" type="submit" value="{{Rescan}}" name="rescan"/>
			</td>
		</tr>
		</table>
	</form>

</td></tr>
</table>
<br />
<br />
