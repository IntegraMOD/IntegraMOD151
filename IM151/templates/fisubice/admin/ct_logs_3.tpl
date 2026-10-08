<table cellspacing="0" cellpadding="0" style="margin-top:-10px;margin-left:-10px;" border="0" width="100%" background="../ctracker/images/acp_head_bg.jpg">
<tr>
  <td align="left" style="vertical-align:top;background:url(../ctracker/images/acp_head_bg.jpg);">
    <img src="../ctracker/images/acp_head.jpg">
  </td>
</tr>
</table>

<h1>{L_LOG_F3}</h1>

<p><center><form method="post" action="{S_FORM_ACTION}"><input type="submit" name="Submit" value="{L_BACK}" class="mainoption"></form></center></p>

<br>
<table width="100%" cellpadding="6" cellspacing="1" border="0" class="forumline">
  <tr align="center">
    <th>{L_LO_1}</th>
    <th>{L_LO_2}</th>
    <th>{L_LO_4}</th>
    <th>{L_LO_5}</th>
  </tr>
<!-- BEGIN ctrack_logoutput -->
  <tr>
    <td align="left" width="12%" class="{ctrack_logoutput.T_ROW_CLASS}"><b>{ctrack_logoutput.L_DATE_CELL}</b></td>
    <td align="left" width="8%" class="{ctrack_logoutput.T_ROW_CLASS}">{ctrack_logoutput.L_C1}</td>
    <td align="left" width="35%" class="{ctrack_logoutput.T_ROW_CLASS}">{ctrack_logoutput.L_C2}</td>
    <td align="left" width="20%" class="{ctrack_logoutput.T_ROW_CLASS}">{ctrack_logoutput.L_C3}</td>
  </tr>
<!-- END ctrack_logoutput -->
  <tr height="30px">
    <td align="center" valign="center" colspan="4" class="row3"><b>{L_ANZ_ENTR}</b></td>
  </tr>
</table>

<br><br>

<center>
<span class="copyright">{L_SYS_FOOTER}</span>
</center>
