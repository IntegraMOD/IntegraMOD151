<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_SEPARATOR}{L_USERGROUPS}</td>
</tr>
</table>

<table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif"width="8" height="23" border="0" alt=""></td> 
   <td align="center" width="100%" background="templates/PowerMetal/images/blk_tm.gif"><strong>{L_USERGROUPS}<strong><img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
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

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<!-- BEGIN switch_groups_joined -->
<tr>
<th colspan="2">{L_GROUP_MEMBERSHIP_DETAILS}</th>
</tr>
<!-- BEGIN switch_groups_member -->
<tr>
<td class="row1" width="30%">{L_YOU_BELONG_GROUPS}</td>
<td class="row2" align="right" width="70%">
<form method="get" action="{S_USERGROUP_ACTION}">
<table width="90%" cellspacing="0" cellpadding="0" border="0">
<tr>
<td width="40%" class="gensmall">{GROUP_MEMBER_SELECT}</td>
<td align="center" width="30%">
<input type="submit" value="{L_VIEW_INFORMATION}" class="button" />{S_HIDDEN_FIELDS}</td>
</tr>
</table>
</form>
</td>
</tr>
<!-- END switch_groups_member -->
<!-- BEGIN switch_groups_pending -->
<tr>
<td class="row1">{L_PENDING_GROUPS}</td>
<td class="row2" align="right">
<form method="get" action="{S_USERGROUP_ACTION}">
<table width="90%" cellspacing="0" cellpadding="0" border="0">
<tr>
<td width="40%" class="gensmall">{GROUP_PENDING_SELECT}</td>
<td align="center" width="30%">
<input type="submit" value="{L_VIEW_INFORMATION}" class="button" />{S_HIDDEN_FIELDS}</td>
</tr>
</table>
</form>
</td>
</tr>
<!-- END switch_groups_pending -->
<!-- END switch_groups_joined -->
<!-- BEGIN switch_groups_remaining -->
<tr>
<th colspan="2">{L_JOIN_A_GROUP}</th>
</tr>
<tr>
<td class="row1">{L_SELECT_A_GROUP}</td>
<td class="row2" align="right"><form method="get" action="{S_USERGROUP_ACTION}">
<table width="90%" cellspacing="0" cellpadding="0" border="0">
<tr>
<td width="40%" class="gensmall">{GROUP_LIST_SELECT}</td>
<td align="center" width="30%">
<input type="submit" value="{L_VIEW_INFORMATION}" class="button" />{S_HIDDEN_FIELDS}</td>
</tr>
</table>
</form>
</td>
</tr>
<!-- END switch_groups_remaining -->
</table>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_SEPARATOR}{L_USERGROUPS}</td>
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