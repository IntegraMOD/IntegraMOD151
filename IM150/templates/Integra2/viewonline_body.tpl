<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
	<td class="maintitle">{L_WHO_IS_ONLINE}</td>
</tr>
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_SEPARATOR}{L_WHO_IS_ONLINE}</td>
</tr>
</table>
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
<th >{L_USERNAME}</th>
<th >{L_LAST_UPDATE}</th>
<th>{L_FORUM_LOCATION}</th>
<th >{L_CONTACT}</th>
</tr>
<tr>
<td class="cat" colspan="4">{TOTAL_REGISTERED_USERS_ONLINE}</td>
</tr>
<!-- BEGIN reg_user_row -->
<tr>
	{reg_user_row.PANEL}
	<td class="{reg_user_row.ROW_CLASS}">{reg_user_row.CONTACT}</td>
</tr>
<!-- END reg_user_row -->
<tr>
<td colspan="4" height="1" class="row3"><img src="{TEMPLATE}images/spacer.gif" width="1" height="1" alt="" /></td>
</tr>
<tr>
<td class="cat" colspan="4">{TOTAL_GUEST_USERS_ONLINE}</td>
</tr>
<!-- BEGIN guest_user_row -->
<tr>
	{guest_user_row.PANEL}
	<td class="{guest_user_row.ROW_CLASS}">{guest_user_row.CONTACT}</td>
</tr>
<!-- END guest_user_row -->
<tr>
<td colspan="4" class="row1"><span class="gensmall">{L_ONLINE_EXPLAIN}</span></td>
</tr>
</table>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_SEPARATOR}{L_WHO_IS_ONLINE}</td>
</tr>
</table>