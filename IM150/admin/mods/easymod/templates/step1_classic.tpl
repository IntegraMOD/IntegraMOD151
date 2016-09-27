<span class="gen"><a href="{{U_SIMPLE}}">{{EM_simple_mode}}</a> :: {{EM_advanced_mode}}</span><br />
<table width="100%" border="1" cellpadding="5">
<tr>
<td valign="top" class="row1" width="290">

<!-- INSTALL INFO -->
	{{[./templates/install_info.tpl]}}
<!-- INSTALL INFO -->
	<br />

<!-- FILE ACCESS -->
	{{[./templates/file_access.tpl]}}
<!-- FILE ACCESS -->

	<br />
	<span class="gen">{{EM_support}}</span><br />

</td><td valign="top" class="row2">
	<h2>{{EM_Settings}}</h2>


	<form action="{{U_FORM}}" name="install" method="post">
		<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">

<!-- EM PASS -->
		{{[./templates/empw_settings.tpl]}}
<!-- EM PASS -->

		<tr>
			<th colspan="2">{{EM_file_title}}</th>
		</tr>
		<tr>
			<td class="row2" align="center" colspan="2"><span class="gen">{{EM_file_desc}}</span></td>
		</tr>

<!--
////////// REMOVING READ METHOD UNTIL THERE IS MORE THAN ONE OPTION (if ever) ;-)
		<tr>
			<td class="row1" align="right"><span class="gen"><a href="{{U_FORM}}?mode=help#" onClick="return helpwin(this)">{{EM_file_reading}}</a></span></td>
			<td class="row2"><select style="width:140px" name="sel_read">{{SELECT_READ}}</select>&nbsp;&nbsp; <span class="gen">(only option for now)</span></td>
		</tr>
-->

		<tr>
			<td class="row1" align="right"><span class="gen"><a href="{{U_FORM}}?mode=help#file_writing" onClick="return helpwin(this)">{{EM_file_writing}}</a></span></td>
			<td class="row2"><select style="width:140px" name="sel_write">{{SELECT_WRITE}}</select>&nbsp;&nbsp; <span class="gen">{{EM_file_alt}}: <a href="{{U_FORM}}?mode=help#file_writing" onClick="return helpwin(this)">{{WRITE_REC}}</a></span></td>
		</tr>
		<tr>
			<td class="row1" align="right"><span class="gen"><a href="{{U_FORM}}?mode=help#file_moving" onClick="return helpwin(this)">{{EM_file_moving}}</a></span></td>
			<td class="row2"><select style="width:140px" name="sel_move">{{SELECT_MOVE}}</select>&nbsp;&nbsp; <span class="gen">{{EM_file_alt}}: <a href="{{U_FORM}}?mode=help#file_moving" onClick="return helpwin(this)">{{MOVE_REC}}</a></span></td>
		</tr>

<!-- FTP SETTINGS -->
		{{[./templates/ftp_settings.tpl]}}
<!-- FTP SETTINGS -->

		<tr> 
			<td class="catbottom" align="center" colspan="2">

<!-- HIDDEN ACCESS -->
				{{[./templates/hidden_access.tpl]}}
<!-- HIDDEN ACCESS -->

				<input type="hidden" name="sel_read" value="server" />
				<input type="hidden" name="install_step" value="2" />
				<input type="hidden" name="setup" value="advanced" />
				<input class="mainoption" type="submit" value="{{Submit}}" />&nbsp;
				<input class="mainoption" type="submit" value="{{Rescan}}" name="rescan" />
			</td>
		</tr>
		</table>
	</form>

</td></tr>
</table>
<br />
<br />
