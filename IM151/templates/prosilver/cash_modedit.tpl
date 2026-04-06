
<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr> 
    <td align="left" valign="middle" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
  </tr>
</table>


<form action="{S_MODEDIT_ACTION}" method="post"><table cellspacing="2" cellpadding="2" border="0" align="center" class="forumline">
	<tr>
	  <th colspan="2" class="thHead" nowrap="nowrap">{TITLE}</th>
	</tr>
	<tr>
	  <td width="30%" class="catleft" align="center"><b><span class="gen">{L_AMOUNT}</span></b></td>
	  <td width="70%" class="catright" align="center"><b><span class="gen">{L_MESSAGE}</span></b></td>
	</tr>
	<tr>
	  <td class="row1">
		<table cellspacing="2" cellpadding="2" border="0" align="center">
			<tr>
			  <td class="row1" width="75"></td>
			  <td class="row2" width="75" align="center"><span class="gen">{TARGET}</span></td>
			  <td colspan="2" class="row3" width="150" align="center"><span class="gen"></span></td>
			</tr>
			<!-- BEGIN cashrow -->
			<tr>
			  <td class="row1" align="center"><span class="gen">{cashrow.CASH_NAME}</span></td>
			  <td class="row2" align="center"><span class="gen">{cashrow.RECEIVER_AMOUNT}</span></td>
			  <td class="row3" align="center"><select name="{cashrow.S_TYPE_FIELD}">
				<option value="0" selected="selected">{L_OMIT}</option>
				<option value="1">{L_ADD}</option>
				<option value="2">{L_REMOVE}</option>
				<option value="3">{L_SET}</option>
				</select></td>
			  <td class="row3" align="center"><input class="post" type="text" style="width:75" name="{cashrow.S_CHANGE_FIELD}"></td>
			</tr>
			<!-- END cashrow -->
		</table>
	  </td>
	  <td class="row1" align="center">
		  <textarea name="message" rows="10" cols="35" wrap="virtual" style="width:450px" class="post"></textarea>
	  </td>
	</tr>
	<tr>
	  <td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" /></td>
	</tr>
</table></form>