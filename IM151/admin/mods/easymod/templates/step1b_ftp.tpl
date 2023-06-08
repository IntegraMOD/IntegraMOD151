<table width="100%" border="1" cellpadding="5">
<tr>
<td valign="top" class="row1" width="290">

<!-- FILE ACCESS -->
	{{[./templates/file_access.tpl]}}
<!-- FILE ACCESS -->
	<br />

	<br />
	<span class="gen">{{EM_support}}</span><br />

</td><td valign="top" class="row2">
	<h2>{{EM_Settings}}</h2>

	<form action="{{U_FORM}}" name="install" method="post">
		<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">

		{{[./templates/ftp_settings.tpl]}}

		<tr> 
			<td class="catbottom" align="center" colspan="2">
				<input type="hidden" name="sel_read" value="{{SEL_READ}}">
				<input type="hidden" name="sel_write" value="{{SEL_WRITE}}">
				<input type="hidden" name="sel_move" value="{{SEL_MOVE}}">
				<input type="hidden" name="language" value="{{LANGUAGE}}">

				<input type="hidden" name="install_step" value="1">
				<input type="hidden" name="substep" value="c">
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
