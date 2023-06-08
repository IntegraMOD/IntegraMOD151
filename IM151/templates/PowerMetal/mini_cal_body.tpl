<table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif"WIDTH=8 HEIGHT=23 border="0" alt=""></td> 
   <td width="100%" background="templates/PowerMetal/images/blk_tm.gif"><img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""><span class="genmed2"><center><a href="{U_MINI_CAL_CALENDAR}">{L_MINI_CAL_CALENDAR}</a></center></td>
   <td><img name="blkr" src="templates/PowerMetal/images/blk_trc.gif" WIDTH=77 HEIGHT=23 border="0" alt=""></td>
  </tr>
  	</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="tlc" src="templates/PowerMetal/images/tlc.gif" WIDTH=8 HEIGHT=6 border="0" alt=""></td> 
   <td width="100%" background="templates/PowerMetal/images/tm.gif"><img name="tm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="trc" src="templates/PowerMetal/images/trc.gif" WIDTH=8 HEIGHT=6 border="0" alt=""></td>
  </tr>
  <tr>
    <td background="templates/PowerMetal/images/left.gif"><img name="left" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
        <td valign="top" bgcolor="#484848">
<!-- BEGIN switch_mini_cal_add_events -->
<form name="mini_cal" id ="mini_cal" action="{U_MINI_CAL_ADD_EVENT}" method="post">
<!-- END switch_mini_cal_add_events -->
<table width="30%" cellpadding="3" cellspacing="1" border="0" class="forumline">
  <tr>
            <!-- BEGIN switch_mini_cal_events -->
                <a href="{U_MINI_CAL_CALENDAR}" class="cattitle">
            <!-- END switch_mini_cal_events -->
            <!-- BEGIN switch_mini_cal_events -->
                </a>
            <!-- END switch_mini_cal_events -->
        </span>
  </tr>
  <tr><td class="row1" align="center">
  	<table width="100%">
        <tr><td align="left" colspan="2">{U_PREV_MONTH}</td><td colspan="3" align="center"><span class="genmed">{L_MINI_CAL_MONTH}</span></td><td align="right" colspan="2">{U_NEXT_MONTH}</td></tr>
		<tr>
			<th align="center" width="14%">{L_MINI_CAL_SUN}</th>
			<th align="center" width="14%">{L_MINI_CAL_MON}</th>
			<th align="center" width="14%">{L_MINI_CAL_TUE}</th>
			<th align="center" width="14%">{L_MINI_CAL_WED}</th>
			<th align="center" width="14%">{L_MINI_CAL_THU}</th>
			<th align="center" width="14%">{L_MINI_CAL_FRI}</th>
			<th align="center" width="14%">{L_MINI_CAL_SAT}</th>
		</tr>
		<!-- BEGIN mini_cal_row -->
		<tr>
			<!-- BEGIN mini_cal_days -->
			<td class="row1" align="center"><span class="gensmall">{mini_cal_row.mini_cal_days.MINI_CAL_DAY}</span></td>
			<!-- END mini_cal_days -->
		</tr>
		<!-- END mini_cal_row -->
	</table>
  	</td>
  </tr>
  <!-- BEGIN switch_mini_cal_birthdays -->
  <tr><td class="row1" align="left"><span class="gensmall">{L_WHOSBIRTHDAY_TODAY}</span></td></tr>
  <tr><td class="row1" align="left"><span class="gensmall">{L_WHOSBIRTHDAY_WEEK}</span></td></tr> 
  <!-- END switch_mini_cal_birthdays -->
  <!-- BEGIN switch_mini_cal_events -->
  <tr><td class="cat" height="28"><span class="cattitle"><center>{L_MINI_CAL_EVENTS}</center></span></td></tr>
  <!-- END switch_mini_cal_events -->
  <!-- BEGIN mini_cal_events -->
  <tr><td class="row1"><span class="gensmall">{mini_cal_events.MINI_CAL_EVENT_DATE} - <a href="{mini_cal_events.U_MINI_CAL_EVENT}" class="gensmall">{mini_cal_events.S_MINI_CAL_EVENT}</a></span></td></tr>
  <!-- END mini_cal_events -->
  <!-- BEGIN mini_cal_no_events -->
  <tr><td class="row1"><span class="genMed"><center>{L_MINI_CAL_NO_EVENTS}</center></span></td></tr>
  <!-- END mini_cal_no_events -->
  <!-- BEGIN switch_mini_cal_add_events -->
  <tr><td class="row1" height="28" align="center">
        <span class="genmed">
            {S_MINI_CAL_EVENTS_FORUMS_LIST} <input type="submit" value="{L_MINI_CAL_ADD_EVENT}" class="liteoption" />
            <input type="Hidden" name="mode" id="mode" value="newtopic" />
        </span>
      </td>
  </tr>
  <!-- END switch_mini_cal_add_events -->
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<!-- BEGIN switch_mini_cal_add_events -->
</form>
<!-- END switch_mini_cal_add_events -->

</td>
    <td background="templates/PowerMetal/images/right.gif"><img name="right" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
   <td><img name="blc" src="templates/PowerMetal/images/blc.gif" WIDTH=8 HEIGHT=8 border="0" alt=""></td>
    <td background="templates/PowerMetal/images/btm.gif"><img name="btm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="brc" src="templates/PowerMetal/images/brc.gif" WIDTH=8 HEIGHT=8 border="0" alt=""></td>
  </tr></table>