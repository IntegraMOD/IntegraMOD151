<a name="cal" id="cal"></a>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="row1" align="center">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="left" colspan="2">{U_PREV_MONTH}</td>
                <td colspan="3" align="center"><span class="gensmall">
                <!-- BEGIN switch_mini_cal_events -->
                <a href="{U_MINI_CAL_CALENDAR}">
                <!-- END switch_mini_cal_events -->
                {L_MINI_CAL_MONTH}
                <!-- BEGIN switch_mini_cal_events -->
                </a>
                <!-- END switch_mini_cal_events -->
                </span></td>
                <td align="right" colspan="2">{U_NEXT_MONTH}</td>
            </tr>
            <tr class="row3">
                <td width="16%"><span class="gensmall">{L_MINI_CAL_SUN}</span></td>
                <td width="14%"><span class="gensmall">{L_MINI_CAL_MON}</span></td>
                <td width="14%"><span class="gensmall">{L_MINI_CAL_TUE}</span></td>
                <td width="14%"><span class="gensmall">{L_MINI_CAL_WED}</span></td>
                <td width="14%"><span class="gensmall">{L_MINI_CAL_THU}</span></td>
                <td width="14%"><span class="gensmall">{L_MINI_CAL_FRI}</span></td>
                <td width="14%"><span class="gensmall">{L_MINI_CAL_SAT}</span></td>
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
  <tr>
    <td class="row1" align="left"><span class="gensmall">{L_WHOSBIRTHDAY_TODAY}</span></td>
  </tr>
  <tr>
    <td class="row1" align="left"><span class="gensmall">{L_WHOSBIRTHDAY_WEEK}</span></td>
  </tr>
  <!-- END switch_mini_cal_birthdays -->
  <!-- BEGIN switch_mini_cal_events -->
  <tr>
    <td class="row3" align="center"><span class="genmed">{L_MINI_CAL_EVENTS}</span></td>
  </tr>
  <!-- END switch_mini_cal_events -->
  <!-- BEGIN mini_cal_events -->
  <tr>
    <td class="row1"><span class="gensmall">{mini_cal_events.MINI_CAL_EVENT_DATE} - <a href="{mini_cal_events.U_MINI_CAL_EVENT}" class="gensmall">{mini_cal_events.S_MINI_CAL_EVENT}</a></span></td>
  </tr>
  <!-- END mini_cal_events -->
  <!-- BEGIN mini_cal_no_events -->
  <tr>
    <td class="row1"><span class="genMed">{L_MINI_CAL_NO_EVENTS}</span></td>
  </tr>
  <!-- END mini_cal_no_events -->
</table>