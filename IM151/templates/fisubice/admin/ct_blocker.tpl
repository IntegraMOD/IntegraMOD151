<table cellspacing="0" cellpadding="0" style="margin-top:-10px;margin-left:-10px;" border="0" width="100%" background="../ctracker/images/acp_head_bg.jpg">
<tr>
  <td align="left" style="vertical-align:top;background:url(../ctracker/images/acp_head_bg.jpg);">
    <img src="../ctracker/images/acp_head.jpg">
  </td>
</tr>
</table>

<h1>{L_PF_HEAD}</h1>

<p>{L_PF_DESC}</p>

<br><br>
<center>
<table width="602px" cellpadding="10" cellspacing="2" border="0" class="forumline">
  <tr align="center">
    <th>{L_PF_HEAD}</th>
  </tr>
  <tr height="206px" valign="top" style="background:url(../ctracker/images/acp_mini_box.jpg)">
    <td align="left"><br>
      <form method="post" action="{S_FORM_ACTION}">
      <table width="76%" cellpadding="4" cellspacing="1" border="0" class="forumline">
        <tr>
          <th colspan="2">{L_PF_HEAD1}</th>
        </tr>
        <tr>
          <td class="row2" colspan="2" width="50%">{L_PF_DESC1}</td>
        </tr>
        <tr>
          <td class="row3" width="75%" align="center"><input type="text" class="post" name="entry" size="48" maxlength="240"></td>
          <td class="row2" width="25%" align="center"><input type="Submit" name="submit" class="mainoption" value="{L_ADD}"></td>
        </tr>
      </table>
      </form>
      <br><br><br>
    </td>
  </tr>
</table>
<br><br>
</center>
<h1>{L_PF_HEAD2}</h1>

<p>{L_PF_DESC2}</p>

<table width="100%" cellpadding="4" cellspacing="2" border="0" class="forumline">
<!-- BEGIN ctrack_datalist -->
  <tr>
    <td align="left" class="row2" width="75%"><span class="gensmall">{ctrack_datalist.L_DELDESC}</span></td>
    <td align="center" valign="top" class="row3" width="25%"><span class="gensmall"><b>[ <a href="{ctrack_datalist.U_DELLINK}">{ctrack_datalist.L_DELETE}</a> ]</b></span></td>
  </tr>
<!-- END ctrack_datalist -->
</table>
<br><br>
<center>
<span class="copyright">{L_SYS_FOOTER}</span>
</center>

