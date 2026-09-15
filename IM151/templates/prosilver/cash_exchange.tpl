
<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr> 
    <td align="left" valign="middle" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
  </tr>
</table>

<form action="{S_EXCHANGE_ACTION}" method="post"><table cellspacing="2" cellpadding="2" border="0" align="center" class="forumline">
	<tr>
	  <th colspan="2" class="thHead" nowrap="nowrap">{L_EXCHANGE}</th>
	</tr>
	<tr>
	  <td width="50%" class="row1"><span class="postbody">{L_CONVERT}</span></td>
	  <td width="50%" class="row1"><input class="post" type="text" maxlength="20" style="width:100" name="convert_amount" value="0" /></td>
	</tr>
	<tr>
	  <td width="50%" class="row1"><span class="postbody">{L_FROM}</span></td>
	  <td width="50%" class="row1"><select name="from_id" style="width:100">
		<option value="0">{L_SELECT_ONE}</option>
		<!-- BEGIN cashrow -->
		<option value="{cashrow.CASH_ID}">{cashrow.CASH_NAME}</option>
		<!-- END cashrow -->
		</select></td>
	</tr>
	<tr>
	  <td width="50%" class="row1"><span class="postbody">{L_TO}</span></td>
	  <td width="50%" class="row1"><select name="to_id" style="width:100">
		<option value="0">{L_SELECT_ONE}</option>
		<!-- BEGIN cashrow -->
		<option value="{cashrow.CASH_ID}">{cashrow.CASH_NAME}</option>
		<!-- END cashrow -->
		</select></td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>
</table></form>

<!-- BEGIN rowrow -->
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr>
  <!-- BEGIN cashtable -->
	<td height="100%" valign="top" class="row1">
	<table width="100%" height="100%" cellspacing="2" cellpadding="2" border="0" align="center" class="forumline">
	  <tr>
	    <th colspan="2" class="thHead" nowrap="nowrap">{rowrow.cashtable.HEADER}</th>
	  </tr>
	  <!-- BEGIN switch_exon -->
	  <tr>
	    <td width="50%" class="row1" valign="top"><span class="postbody">{rowrow.cashtable.ONE_WORTH}</span></td>
	    <td width="50%" class="row1"><span class="postbody">
		<!-- BEGIN exchangeitem -->
			{rowrow.cashtable.switch_exon.exchangeitem.EXCHANGE}<br />
		<!-- END exchangeitem -->
	    </span></td>
	  </tr>
	  <!-- END switch_exon -->
	  <!-- BEGIN switch_exoff -->
	  <tr>
	    <td colspan="2" class="row1"><span class="postbody">{rowrow.cashtable.NO_EXCHANGE}</span></td>
	  </tr>
	  <!-- END switch_exoff -->
	</table></td>
  <!-- END cashtable -->
  </tr>
</table>
<!-- END rowrow -->
