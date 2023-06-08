<form method="post" action="{S_RECORDS_DAYS_ACTION}">
  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr> 
	  <td align="left" valign="bottom" colspan="2"></td>
	  <td align="right" valign="bottom" nowrap="nowrap"><span class="gensmall"><b>{PAGINATION}</b></span></td>
	</tr>
	<tr> 
	  <td align="left" valign="middle">&nbsp;</td>
	  <td align="left" valign="middle" class="nav" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
	  <td align="right" valign="bottom" class="nav" nowrap="nowrap"></td>
	</tr>
  </table>
<table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif"width="8" height="23" border="0" alt=""></td> 
   <td align="center" width="100%" background="templates/PowerMetal/images/blk_tm.gif"><strong>{L_PAGE_NAME}<strong><img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
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


  <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
	<tr> 
	  <th width="50" align="center" height="25" class="thCornerL" nowrap="nowrap">&nbsp;{L_LW_CURRENCY}&nbsp;</th>
	  <th width="100" align="center" class="thTop" nowrap="nowrap">&nbsp;{L_LW_MONEY}&nbsp;</th>
	  <th width="50" align="center" class="thTop" nowrap="nowrap">&nbsp;{L_LW_PLUS_MINUS}&nbsp;</th>
	  <th width="100" align="center" class="thTop" nowrap="nowrap">&nbsp;{L_LW_TXNID}&nbsp;</th>
	  <th width="100" align="center" class="thTop" nowrap="nowrap">&nbsp;{L_LW_STATUS}&nbsp;</th>
	  <th width="160" align="center" class="thTop" nowrap="nowrap">&nbsp;{L_LW_DATE}&nbsp;</th>
	  <th align="center" class="thCornerR" nowrap="nowrap">&nbsp;{L_LW_COMMENT}&nbsp;</th>
	</tr>
	<!-- BEGIN topicrow -->
	<tr> 
	  <td class="row1" align="center" valign="middle"><span class="postdetails">{topicrow.LW_CURRENCY}</span></td>
	  <td class="row3" align="center" valign="middle"><span class="postdetails">{topicrow.LW_MONEY}</span></td>
	  <td class="row2" align="center" valign="middle"><span class="name">{topicrow.LW_PLUS_MINUS}</span></td>
	  <td class="row3" align="center" valign="middle"><span class="postdetails">{topicrow.LW_TXNID}</span></td>
	  <td class="row2" align="center" valign="middle"><span class="postdetails">{topicrow.LW_STATUS}</span></td>
	  <td class="row3" align="center" valign="middle" nowrap="nowrap"><span class="postdetails">{topicrow.LW_DATE}</span></td>
	  <td class="row2" align="center" valign="middle"><span class="postdetails">{topicrow.LW_COMMENT}</span></td>
	</tr>
	<!-- END topicrow -->
	<!-- BEGIN switch_lw_no_records -->
	<tr> 
	  <td class="row1" colspan="8" height="30" align="center" valign="middle"><span class="gen">{L_LW_NO_RECORDS}</span></td>
	</tr>
	<!-- END switch_lw_no_records -->
	<tr> 
	  <td class="catBottom" align="center" valign="middle" colspan="8" height="28"><span class="genmed">{L_DISPLAY_TOPICS}&nbsp;{S_SELECT_TOPIC_DAYS}&nbsp; 
		{LW_HIDDEN_FIELDS}<input type="submit" class="liteoption" value="{L_GO}" name="submit" />
		</span></td>
	</tr>
  </table>

  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
	<tr> 
	  <td align="left" valign="middle">&nbsp;</td>
	  <td align="left" valign="middle" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
	  <td align="right" valign="middle" nowrap="nowrap"><span class="gensmall">{S_TIMEZONE}</span><br /><span class="nav">{PAGINATION}</span> 
		</td>
	</tr>
	<tr>
	  <td align="left" colspan="3"><span class="nav">{PAGE_NUMBER}</span></td>
	</tr>
  </table>

    </td>
    <td background="templates/PowerMetal/images/right.gif"><img name="right" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
   <td><img name="blc" src="templates/PowerMetal/images/blc.gif" width="8" height="8" border="0" alt=""></td>
    <td background="templates/PowerMetal/images/btm.gif"><img name="btm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="brc" src="templates/PowerMetal/images/brc.gif" width="8" height="8" border="0" alt=""></td>
  </tr></table>
</form>
