<table cellpadding="0" cellspacing="10" border="0" width="100%">
<form name="post" action="{S_PROFILCP_ACTION}" method="post">
<tr>
	<td valign="top" align="center">

<table width="100%" cellpadding="0" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<th colspan="2">{L_MOD_NAME}</th>
</tr>
<tr>
	<td valign="top" class="row3">
		<table cellpadding="5" cellspacing="1" border="0" width="100%" class="bodyline">
		<tr><td><span class="genmed">{REQUIRED_EXPLAIN}</span></td></tr>
		<!-- BEGIN field -->
		<tr>
			<td valign="top" class="row1" width="50%"><span class="gen">{field.L_NAME}</span><span class="gensmall">{field.L_EXPLAIN}</span></td>
			<td class="row2" width="50%" ><span class="gen">{field.INPUT}</span></td>
		</tr>
		<!-- END field -->
		<!-- BEGIN rules -->
		<tr>
			<td colspan="2" valign="top" class="row1" width="100%">
				<table cellpadding="4" cellspacing="1" border="0" class="forumline" width="100%">
				<tr>
					<th colspan="2" valign="middle">{rules.L_NAME}</th> 
				</tr> 
				<tr> 
					<td class="row1"> 
						<div class="genmed" align="justify"><br />{rules.INPUT}<br /><br /></div> 
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<!-- END rules -->
		</table>
	</td>
</tr>
<tr>
	<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
	</td>
</tr>
</table>

	</td>
</tr>
</form>
</table>