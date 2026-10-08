<div class="maintitle">{L_WELCOME}</div>
<br />
<div class="genmed">{L_ADMIN_INTRO}</div>
<br />
<div class="subtitle">{L_FORUM_STATS}</div>
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr> 
<th width="25%">{L_STATISTIC}</th>
<th width="25%">{L_VALUE}</th>
<th width="25%">{L_STATISTIC}</th>
<th width="25%">{L_VALUE}</th>
</tr>
<tr> 
<td class="row1" nowrap="nowrap" align="right">{L_NUMBER_POSTS}:</td>
<td class="row2">{NUMBER_OF_POSTS}</td>
<td class="row1" align="right">{L_POSTS_PER_DAY}:</td>
<td class="row2">{POSTS_PER_DAY}</td>
</tr>
<tr> 
<td class="row1" nowrap="nowrap" align="right">{L_NUMBER_TOPICS}:</td>
<td class="row2">{NUMBER_OF_TOPICS}</td>
<td class="row1" nowrap="nowrap" align="right">{L_TOPICS_PER_DAY}:</td>
<td class="row2">{TOPICS_PER_DAY}</td>
</tr>
<tr> 
<td class="row1" nowrap="nowrap" align="right">{L_NUMBER_USERS}:</td>
<td class="row2">{NUMBER_OF_USERS}</td>
<td class="row1" nowrap="nowrap" align="right">{L_USERS_PER_DAY}:</td>
<td class="row2">{USERS_PER_DAY}</td>
</tr>
<tr> 
<td class="row1" nowrap="nowrap" align="right">{L_BOARD_STARTED}:</td>
<td class="row2"><span class="genmed">{START_DATE}</span></td>
<td class="row1" nowrap="nowrap" align="right">{L_AVATAR_DIR_SIZE}:</td>
<td class="row2">{AVATAR_DIR_SIZE}</td>
</tr>
<tr> 
<td class="row1" nowrap="nowrap" align="right">{L_DB_SIZE}:</td>
<td class="row2">{DB_SIZE}</td>
<td class="row1" align="right">{L_GZIP_COMPRESSION}:</td>
<td class="row2">{GZIP_COMPRESSION}</td>
</tr>
</table>
<br />
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr> 
	<th style="width: 50%;">{L_INTEGRA_TITLE}</th>
	<th style="width: 50%;">{L_VERSION_INFORMATION}</th>
</tr>
<tr>
	<td class="row1" style="height: 50px; overflow: auto;">{INTEGRA_NEWS}</td>
	<td class="row2" style="height: 50px; overflow: auto;">{VERSION_INFO}</td>
</tr>
</table>

<br />

<div class="subtitle">{L_WHO_IS_ONLINE}</div>

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr> 
<th width="20%">&nbsp;{L_USERNAME}&nbsp;</th>
<th width="20%">&nbsp;{L_STARTED}&nbsp;</th>
<th width="20%">&nbsp;{L_LAST_UPDATE}&nbsp;</th>
<th width="20%">&nbsp;{L_FORUM_LOCATION}&nbsp;</th>
<th width="20%">&nbsp;{L_IP_ADDRESS}&nbsp;</th>
</tr>
<!-- BEGIN reg_user_row -->
<tr> 
<td width="20%" class="{reg_user_row.ROW_CLASS}">&nbsp;<a href="{reg_user_row.U_USER_PROFILE}" class="name">{reg_user_row.USERNAME}</a>&nbsp;</td>
<td width="20%" align="center" nowrap="nowrap" class="{reg_user_row.ROW_CLASS}">&nbsp;<span class="genmed">{reg_user_row.STARTED}</span>&nbsp;</td>
<td width="20%" align="center" nowrap="nowrap" class="{reg_user_row.ROW_CLASS}">&nbsp;<span class="genmed">{reg_user_row.LASTUPDATE}</span>&nbsp;</td>
<td width="20%" class="{reg_user_row.ROW_CLASS}">&nbsp;<a href="{reg_user_row.U_FORUM_LOCATION}">{reg_user_row.FORUM_LOCATION}</a>&nbsp;</td>
<td width="20%" class="{reg_user_row.ROW_CLASS}">&nbsp;<a href="{reg_user_row.U_WHOIS_IP}" target="_phpbbwhois">{reg_user_row.IP_ADDRESS}</a>&nbsp;</td>
</tr>
<!-- END reg_user_row -->
<tr> 
<td colspan="5" height="1" class="row3"><img src="../images/spacer.gif" width="1" height="1" alt="" /></td>
</tr>
<!-- BEGIN guest_user_row -->
<tr> 
<td width="20%" class="{guest_user_row.ROW_CLASS}">&nbsp;<span class="genmed">{guest_user_row.USERNAME}</span>&nbsp;</td>
<td width="20%" align="center" class="{guest_user_row.ROW_CLASS}">&nbsp;<span class="genmed">{guest_user_row.STARTED}</span>&nbsp;</td>
<td width="20%" align="center" nowrap="nowrap" class="{guest_user_row.ROW_CLASS}">&nbsp;<span class="genmed">{guest_user_row.LASTUPDATE}</span>&nbsp;</td>
<td width="20%" class="{guest_user_row.ROW_CLASS}">&nbsp;<a href="{guest_user_row.U_FORUM_LOCATION}">{guest_user_row.FORUM_LOCATION}</a>&nbsp;</td>
<td width="20%" class="{guest_user_row.ROW_CLASS}">&nbsp;<a href="{guest_user_row.U_WHOIS_IP}" target="_phpbbwhois">{guest_user_row.IP_ADDRESS}</a>&nbsp;</td>
</tr>
<!-- END guest_user_row -->
</table>
{JR_ADMIN_INFO_TABLE}
<br />