
<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr> 
    <td align="left" valign="middle" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
  </tr>
</table>
<table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif"width="8" height="23" border="0" alt=""></td> 
   <td align="center" width="100%" background="templates/PowerMetal/images/blk_tm.gif"><strong>&nbsp;<strong><img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="blkr" src="templates/PowerMetal/images/blk_trc.gif" width="77" height="23" border="0" alt=""></td>
  </tr>
  	</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="tlc" src="templates/PowerMetal/images/tlc.gif" width="8" height="6" border="0" alt=""></td> 
   <td width="100%" background="templates/PowerMetal/images/tm.gif"><img name="tm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="trc" src="templates/PowerMetal/images/trc.gif" width="8" height="6" border="0" alt=""></td>
  </tr>
  <tr>
    <td background="templates/PowerMetal/images/left.gif"><img name="left" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
        <td valign="top" bgcolor="#484848">
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
    </td>
    <td background="templates/PowerMetal/images/right.gif"><img name="right" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
   <td><img name="blc" src="templates/PowerMetal/images/blc.gif" width="8" height="8" border="0" alt=""></td>
    <td background="templates/PowerMetal/images/btm.gif"><img name="btm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="brc" src="templates/PowerMetal/images/brc.gif" width="8" height="8" border="0" alt=""></td>
  </tr></table>