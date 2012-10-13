<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr>
		<td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
	</tr>
</table>
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
	<tr>
		<th class="thHead" colspan="7" nowrap="nowrap">{LEVEL_NAME}</th>
	</tr>
	<tr>
		<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">#</span></td>
		<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">{L_USERNAME}</span></td>
		<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">{L_FROM}</span></td>
		<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">{L_JOINED}</span></td>
		<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">{L_POSTS}</span></td>
		<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">{L_CONTACT}</span></td>
		<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">{L_MESSENGER}</span></td>
	</tr>
	<!-- BEGIN level_list -->
	<tr>
		<td class="{level_list.ROW_CLASS}" align="center"><span class="gen">&nbsp;{level_list.ROW_NUMBER}&nbsp;</span></td>
		<td class="{level_list.ROW_CLASS}" align="center"><span class="gen">{level_list.USERNAME}</span><br /><span class="gensmall">{level_list.USER_RANK}</span></td>
		<td class="{level_list.ROW_CLASS}" align="center" valign="middle"><span class="gen">{level_list.FROM}</span></td>
		<td class="{level_list.ROW_CLASS}" align="center" valign="middle"><span class="gensmall">{level_list.JOINED}</span></td>
		<td class="{level_list.ROW_CLASS}" align="center" valign="middle"><span class="gen">{level_list.POSTS}</span></td>
		<td class="{level_list.ROW_CLASS}" align="center" valign="middle">
			<span class="gen">{level_list.PM_IMG}&nbsp;{level_list.EMAIL_IMG}<br />
			{level_list.WWW_IMG}{level_list.ONLINE_STATUS}</span>
		</td>
		<td class="{level_list.ROW_CLASS}" align="center">
			<span class="gen">{level_list.AIM_IMG}&nbsp;{level_list.YIM_IMG}<br />
			{level_list.MSN_IMG}&nbsp;{level_list.ICQ_IMG}</span>
		</td>
	</tr>
	<!-- END level_list -->
	<tr>
		<td class="catBottom" colspan="7" height="28">&nbsp;</td>
	</tr>
</table>
<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
	<tr>
		<td align="right" valign="top"></td>
	</tr>
</table>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td><span class="nav"><span class="nav">{PAGINATION}<br />{PAGE_NUMBER}</span></td>
		<td align="right"><span class="gensmall">{S_TIMEZONE}</span></td>
	</tr>
</table>
<table width="100%" cellspacing="2" border="0" align="center">
	<tr>
		<td valign="top" align="right">{JUMPBOX}</td>
	</tr>
</table>