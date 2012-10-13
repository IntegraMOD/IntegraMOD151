<span class="gen">{{EM_simple_mode}} :: <a href="{{U_ADVANCED}}">{{EM_advanced_mode}}</a></span><br />
<table width="100%" border="1" cellpadding="5">
<tr>
<td valign="top" class="row1" width="290">

<!-- INSTALL INFO -->
	{{[./templates/install_info.tpl]}}
<!-- INSTALL INFO -->

	<br />

	<span class="gen">{{EM_support}}</span><br />

</td><td valign="top" class="row2">
	<h2>{{EM_server_style}}</h2>


	<form action="{{U_FORM}}" name="install" method="post">
		<table width="100%" cellpadding="2" cellspacing="0" border="0" class="forumline">
		<tr>
			<th>{{EM_about_server}}</th>
		</tr>
		<tr>
			<td class="row2" align="center"><span class="gen"><strong>{{EM_describes_server}}</strong></span></td>
		</tr>
		<tr>
			<td class="row1" align="left"><span class="gen"><input type="radio" name="option" value="ftp" checked="checked">{{EM_have_ftp}}</span></td>
		</tr>
		<tr>
			<td class="row1" align="left"><span class="gen"><input type="radio" name="option" value="windoze">{{EM_have_windows}}</span></td>
		</tr>
		<tr>
			<td class="row1" align="left"><span class="gen"><input type="radio" name="option" value="idunno">{{EM_no_ftp_suggest}}</span></td>
		</tr>
		<tr>
			<td class="row1" align="left"><br /></td>
		</tr>
		<tr> 
			<td class="catbottom" align="center" colspan="2">
				<input type="hidden" name="language" value="{{LANGUAGE}}">
				<input type="hidden" name="install_step" value="1">
				<input type="hidden" name="substep" value="a">
				<input class="mainoption" type="submit" value="{{Submit}}" />
			</td>
		</tr>
		</table>
	</form>

</td></tr>
</table>
<br />
<br />
