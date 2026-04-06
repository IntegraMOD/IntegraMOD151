<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
	<td align="left" class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
  </tr>
</table>

<br />

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
	<tr> 
		<th height="25" nowrap="nowrap" colspan="3">{L_HEADER_TEXT}</th>
	</tr>
	<tr>
		<td class="row2" align="center" colspan="3"><span class="gen">{L_DESCRIPTION}</span></td>
	</tr>
	<tr>
		<th>#</th>
		<th>{L_TABLEHEAD_1}</th>
		<th>{L_TABLEHEAD_2}</th>
	</tr>
<!-- BEGIN login_output -->
	<tr>
		<td class="{login_output.ROW_CLASS}" align="center"><span class="gen"><b>{login_output.VALUE_1}</b></span></td>
		<td class="{login_output.ROW_CLASS}"><span class="gen">{login_output.VALUE_2}</span></td>
		<td class="{login_output.ROW_CLASS}"><span class="gen">{login_output.VALUE_3}</span></td>
	</tr>
<!-- END login_output -->
	<tr>
		<td class="catBottom" colspan="3">&nbsp;</td>
	</tr>
</table>

<!-- BEGIN log_set -->
<br /><br />
<form action="{log_set.S_FORM_ACTION}" method="post">
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
	<tr> 
		<th height="25" nowrap="nowrap" colspan="2">{log_set.L_HEADER_TEXT}</th>
	</tr>
	<tr>
		<td class="row3" rowspan="2" align="center" width="20%"><img src="{log_set.IMG_ICON}" border="0" alt="" title=""></td>
		<td class="row2" align="center"><span class="gen">{log_set.L_DESC}</span></td>
	</tr>
	<tr>
		<td class="row1">
			<span class="gen">
				<input type="radio" name="ct_enable_ip_warn" value="1"{log_set.S_SELECT_ON}> {log_set.L_ON}<br /><br />
				<input type="radio" name="ct_enable_ip_warn" value="0"{log_set.S_SELECT_OFF}> {log_set.L_OFF}<br />
			</span>
		</td>
	</tr>
	<tr>
		<td class="catBottom" align="center" colspan="2"><input type="Submit" name="submit" value="{log_set.L_SEND}" class="mainoption"></td>
	</tr>
</table>
</form>
<!-- END log_set -->

<br />