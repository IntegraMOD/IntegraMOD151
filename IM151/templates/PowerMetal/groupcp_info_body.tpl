

<form action="{S_GROUPCP_ACTION}" method="post">
<table width="100%" cellspacing="2" cellpadding="3" border="0">
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_SEPARATOR}<a href="{U_GROUP_CP}">{L_USERGROUPS}</a>{NAV_SEPARATOR}{GROUP_NAME}</td>
<td align="right" class="nav" nowrap="nowrap">{PAGINATION}</td>
</tr>
</table>
<table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif"width="8" height="23" border="0" alt=""></td> 
   <td align="center" width="100%" background="templates/PowerMetal/images/blk_tm.gif"><strong>{GROUP_NAME}<strong><img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
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

<table class="forumline" width="100%" cellspacing="1" cellpadding="4" border="0">
<tr>
<th colspan="2">{L_GROUP_INFORMATION}</th>
</tr>
<tr>
<td width="20%" align="right" class="row1"><span class="explaintitle">{L_GROUP_NAME}:</span></td>
<td class="row2" width="80%"><strong>{GROUP_NAME}</strong></td>
</tr>
<tr>
<td align="right" class="row1"><span class="explaintitle">{L_GROUP_DESC}:</span></td>
<td class="row2">{GROUP_DESC}</td>
</tr>
<tr>
<td align="right" class="row1"><span class="explaintitle">{L_GROUP_MEMBERSHIP}:</span></td>
<td class="row2">{GROUP_DETAILS} &nbsp;&nbsp; 
<!-- BEGIN switch_subscribe_group_input -->
{L_JOIN_GROUP}
<!-- END switch_subscribe_group_input -->
<!-- BEGIN switch_unsubscribe_group_input -->
{L_UNSUBSCRIBE_GROUP}
<!-- END switch_unsubscribe_group_input -->
</td>
</tr>
<!-- BEGIN switch_mod_option -->
<tr>
<td align="right" class="row1"><span class="explaintitle">{L_GROUP_TYPE}:</span></td>
<td class="row2"><table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><input type="radio" name="group_type" value="{S_GROUP_OPEN_TYPE}" {S_GROUP_OPEN_CHECKED} /></td>
<td>{L_GROUP_OPEN} &nbsp;&nbsp; </td>
<td><input type="radio" name="group_type" value="{S_GROUP_CLOSED_TYPE}" {S_GROUP_CLOSED_CHECKED} /></td>
<td>{L_GROUP_CLOSED} &nbsp;&nbsp;</td>
<td><input type="radio" name="group_type" value="{S_GROUP_HIDDEN_TYPE}" {S_GROUP_HIDDEN_CHECKED} /></td>
<td>{L_GROUP_HIDDEN} &nbsp;&nbsp;<input type="radio" name="group_type" value="{S_GROUP_AUTO_TYPE}" {S_GROUP_AUTO_CHECKED} /> {L_GROUP_AUTO} &nbsp;&nbsp;<input type="radio" name="group_type" value="{S_GROUP_PAYMENT_TYPE}" {S_GROUP_PAYMENT_CHECKED} />	{L_GROUP_PAYMENT} &nbsp;</td>
<td><input class="mainoption" type="submit" name="groupstatus" value="{L_UPDATE}" /></td>
</tr>
</table> 
</td>
</tr>
<!-- END switch_mod_option -->
</table>
{S_HIDDEN_FIELDS} 
</form>
<br />
<form action="{S_GROUPCP_ACTION}" method="post" name="post">
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
	<tr>
		<!-- BEGIN headers -->
		<th>{headers.L_HEADER}</th>
		<!-- END headers -->
		<th>{L_SELECT}</th>
	</tr>
	<tr>
		<td class="cat" colspan="{ROWCOUNT}">{L_GROUP_OWNER}</td>
	</tr>
	<tr>
		<!-- BEGIN mod -->
		<td class="{mod.CLASS}" width="{mod.WIDTH}" align="center">
			{mod.FIELD}
		</td>
		<!-- END mod -->
		<td class="row1" align="center">&nbsp;</td>
	</tr>
	<!-- BEGIN member_type -->
	<tr> 
	  <td class="cat" colspan="{ROWCOUNT}" height="28"><span class="cattitle">{member_type.L_TYPE}</span></td>
	</tr>
	<!-- BEGIN member_row -->
	<tr>
		<!-- BEGIN member_fields -->
		<td class="{member_type.member_row.ROW_CLASS}" width="{member_type.member_row.member_fields.WIDTH}" align="center">
			{member_type.member_row.member_fields.FIELD}
		</td>
		<!-- END member_fields -->
		<td class="{member_type.member_row.ROW_CLASS}" align="center"> 
	  <!-- BEGIN switch_mod_option -->
	  <input type="checkbox" name="members[]" value="{member_type.member_row.USER_ID}" /> 
	  <!-- END switch_mod_option -->
	  </td>
	</tr>
	<!-- END member_row -->
	<!-- END member_type -->
<!-- BEGIN switch_no_members -->
<tr>
<td class="row1" colspan="{ROWCOUNT}" align="center">{L_NO_MEMBERS}</td>
</tr>
<!-- END switch_no_members -->
<!-- BEGIN switch_hidden_group -->
<tr>
<td class="row1" colspan="{ROWCOUNT}" align="center">{L_HIDDEN_MEMBERS}</td>
</tr>
<!-- END switch_hidden_group -->
<!-- BEGIN switch_mod_option -->
<tr>
<td class="cat" colspan="7">
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
 	<tr>
 		<td>
<input type="text"  class="post" name="username" maxlength="50" size="20" />
<input type="submit" name="add" value="{L_ADD_MEMBER}" class="mainoption" />
<input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="button" onclick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'height=250,resizable=yes,width=400');return false;" />
</td>
 		<td align="right"><input type="submit" name="remove" value="{L_REMOVE_SELECTED}" class="mainoption" />
<!-- BEGIN switch_owner_option -->
			<input type="submit" name="grant_ungrant" value="{L_GRANT_UNGRANT_SELECTED}" class="liteoption" />
			<!-- END switch_owner_option -->
			</td>
 		</tr>
 	</table>
 
</td>
</tr>
<!-- END switch_mod_option -->
</table>
<table width="100%" cellspacing="2" border="0" cellpadding="3">
<tr>
<td width="100%" class="nav">{PAGE_NUMBER}</td>
<td align="right" class="nav" nowrap="nowrap">{PAGINATION}</td>
</tr>
</table>
{PENDING_USER_BOX} {S_HIDDEN_FIELDS} 
    </td>
    <td background="templates/PowerMetal/images/right.gif"><img name="right" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
   <td><img name="blc" src="templates/PowerMetal/images/blc.gif" width="8" height="8" border="0" alt=""></td>
    <td background="templates/PowerMetal/images/btm.gif"><img name="btm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="brc" src="templates/PowerMetal/images/brc.gif" width="8" height="8" border="0" alt=""></td>
  </tr></table>
</form>