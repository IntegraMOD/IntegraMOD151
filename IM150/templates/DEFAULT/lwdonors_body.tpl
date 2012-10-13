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
  <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
	<tr> 
	  <th width="40%" align="center" height="25" class="thCornerL" nowrap="nowrap">&nbsp;{L_LW_DONORS_NAME}&nbsp;</th>
	  <th width="30%" align="center" class="thTop" nowrap="nowrap">&nbsp;{L_LW_MONEY}&nbsp;</th>
	  <th width="30%" align="center" class="thTop" nowrap="nowrap">&nbsp;{L_LW_DATE}&nbsp;</th>
	</tr>
	<!-- BEGIN topicrow -->
	<tr> 
	  <td class="row1" align="center" valign="middle"><span class="postdetails">{topicrow.LW_DONORS_NAME}</span></td>
	  <td class="row3" align="center" valign="middle"><span class="postdetails">{topicrow.LW_MONEY}</span></td>
	  <td class="row2" align="center" valign="middle" nowrap="nowrap"><span class="postdetails">{topicrow.LW_DATE}</span></td>
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
</form>
