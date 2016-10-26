<table cellspacing="0" cellpadding="0" style="margin-top:-10px;margin-left:-10px;" border="0" width="100%" background="../ctracker/images/acp_head_bg.jpg">
<tr>
  <td align="left" style="vertical-align:top;background:url(../ctracker/images/acp_head_bg.jpg);">
    <img src="../ctracker/images/acp_head.jpg">
  </td>
</tr>
</table>

<h1>{L_CT_CONFIG}</h1>

<p>{L_CT_CONFIG_D}</p>

<br><form method="post" action="{S_FORM_ACTION}">

<table width="99%" cellpadding="6" cellspacing="2" border="0" class="forumline">
  <tr>
    <th colspan="2">{L_TABLE_1}</th>
  </tr>
  <tr>
    <td align="left" width="75%" class="row2"><b>{L_CONFIGP_P1}</b><br><span class="gensmall">{L_CONFIGP_D1}</span></td>
    <td align="center" width="25%" valign="top" class="row3"><select name="floodlog">{S_SEL_NUMB1}</select></td>
  </tr>
  <tr>
    <td align="left" width="75%" class="row2"><b>{L_CONFIGP_P2}</b><br><span class="gensmall">{L_CONFIGP_D2}</span></td>
    <td align="center" width="25%" valign="top" class="row3"><select name="proxylog">{S_SEL_NUMB2}</select></td>
  </tr>
</table>

<br>

<table width="99%" cellpadding="6" cellspacing="2" border="0" class="forumline">
  <tr>
    <th colspan="2">{L_TABLE_2}</th>
  </tr>
  <tr>
    <td align="left" width="75%" class="row2"><b>{L_CONFIGP_P3}</b><br><span class="gensmall">{L_CONFIGP_D3}</span></td>
    <td align="center" width="25%" valign="top" class="row3"><select name="filter">{S_SEL_ONOFF1}</select></td>
  </tr>
  <tr>
    <td align="left" width="75%" class="row2"><b>{L_CONFIGP_P4}</b><br><span class="gensmall">{L_CONFIGP_D4}</span></td>
    <td align="center" width="25%" valign="top" class="row3"><select name="floodprot">{S_SEL_ONOFF2}</select></td>
  </tr>
  <tr>
    <td align="left" width="75%" class="row2"><b>{L_CONFIGP_P5}</b><br><span class="gensmall">{L_CONFIGP_D5}</span></td>
    <td align="center" width="25%" valign="top" class="row3"><select name="regblock">{S_SEL_ONOFF3}</select></td>
  </tr>
  <tr>
    <td align="left" width="75%" class="row2"><b>{L_CONFIGP_P6}</b><br><span class="gensmall">{L_CONFIGP_D6}</span></td>
    <td align="center" width="25%" valign="top" class="row3"><select name="autoban">{S_SEL_ONOFF4}</select></td>
  </tr>
  <tr>
    <td align="left" width="75%" class="row2"><b>{L_CONFIGP_P14}</b><br><span class="gensmall">{L_CONFIGP_D14}</span></td>
    <td align="center" width="25%" valign="top" class="row3"><select name="mailfeature">{S_SEL_ONOFF5}</select></td>
  </tr>
  <tr>
    <td align="left" width="75%" class="row2"><b>{L_CONFIGP_P15}</b><br><span class="gensmall">{L_CONFIGP_D15}</span></td>
    <td align="center" width="25%" valign="top" class="row3"><select name="pwreset">{S_SEL_ONOFF6}</select></td>
  </tr>
  <tr>
    <td align="left" width="75%" class="row2"><b>{L_CONFIGP_P16}</b><br><span class="gensmall">{L_CONFIGP_D16}</span></td>
    <td align="center" width="25%" valign="top" class="row3"><select name="loginfeature">{S_SEL_ONOFF7}</select></td>
  </tr>
</table>

<br>

<table width="99%" cellpadding="6" cellspacing="2" border="0" class="forumline">
  <tr>
    <th colspan="2">{L_TABLE_3}</th>
  </tr>
  <tr>
    <td align="left" width="75%" class="row2"><b>{L_CONFIGP_P9}</b><br><span class="gensmall">{L_CONFIGP_D9}</span></td>
    <td align="center" width="25%" valign="top" class="row3"><select name="maxsearch">{S_SEL_COUNT1}</select></td>
  </tr>
  <tr>
    <td align="left" width="75%" class="row2"><b>{L_CONFIGP_P10}</b><br><span class="gensmall">{L_CONFIGP_D10}</span></td>
    <td align="center" width="25%" valign="top" class="row3"><select name="searchtime">{S_SEL_TIME_HIGH1}</select></td>
  </tr>
</table>

<br>

<table width="99%" cellpadding="6" cellspacing="2" border="0" class="forumline">
  <tr>
    <th colspan="2">{L_TABLE_4}</th>
  </tr>
  <tr>
    <td align="left" width="75%" class="row2"><b>{L_CONFIGP_P11}</b><br><span class="gensmall">{L_CONFIGP_D11}</span></td>
    <td align="center" width="25%" valign="top" class="row3"><select name="regtime">{S_SEL_TIME_HIGH2}</select></td>
  </tr>
  <tr>
    <td align="left" width="75%" class="row2"><b>{L_CONFIGP_P12}</b><br><span class="gensmall">{L_CONFIGP_D12}</span></td>
    <td align="center" width="25%" valign="top" class="row3"><select name="posttimespan">{S_SEL_TIME_LOW}</select></td>
  </tr>
  <tr>
    <td align="left" width="75%" class="row2"><b>{L_CONFIGP_P13}</b><br><span class="gensmall">{L_CONFIGP_D13}</span></td>
    <td align="center" width="25%" valign="top" class="row3"><select name="postintime">{S_SEL_COUNT2}</select></td>
  </tr>
</table>

<br>
<center><input type="Submit" name="submit" class="mainoption" value="{L_BUT_SUBMIT}"></center>

</form>

<center>
<br>
<span class="copyright">{L_SYS_FOOTER}</span>
</center>
