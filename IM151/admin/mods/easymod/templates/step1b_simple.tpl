<table width="100%" border="1" cellpadding="5">
<tr>
<td valign="top" class="row1" width="290">

<!-- FILE ACCESS -->
	{{[./templates/file_access.tpl]}}
<!-- FILE ACCESS -->

	<br />
	<span class="gen">{{EM_support}}</span><br />

</td><td valign="top" class="row2">
	<h2>{{EM_diagnosis}}</h2>


	<form action="{{U_FORM}}" name="install" method="post">
		<table width="100%" cellpadding="2" cellspacing="0" border="0" class="forumline">
		<tr>
			<th colspan="2">{{EM_auto_tech_detected}}</th>
		</tr>


<!-- WRITE AND COPY -->
		{{[./templates/step1b_write_copy.tpl]}}
<!-- WRITE AND COPY -->


<!-- WRITE AND noCOPY -->
		{{[./templates/step1b_write_nocopy.tpl]}}
<!-- WRITE AND noCOPY -->


<!-- noWRITE AND noCOPY -->
		{{[./templates/step1b_nowrite_nocopy.tpl]}}
<!-- noWRITE AND noCOPY -->


		<tr> 
			<td class="catbottom" align="center" colspan="2">

				{{[./templates/hidden_access.tpl]}}

				<input type="hidden" name="install_step" value="1" />
				<input type="hidden" name="substep" value="b" />
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
