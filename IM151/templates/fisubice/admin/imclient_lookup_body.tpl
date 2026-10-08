<h1>{L_USER_TITLE}</h1>

<p>{L_USER_EXPLAIN}</p>

<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
	<tr>
		<th align="center" height="25" class="thCornerL" nowrap="nowrap">&nbsp;{L_USERNAME}&nbsp;</th>
		<th align="center" class="thTop" nowrap="nowrap">&nbsp;{L_EMAIL_ADDRESS}&nbsp;</th>
		<th align="center" class="thTop" nowrap="nowrap">&nbsp;{L_POSTS}&nbsp;</th>
		<th align="center" class="thTop" nowrap="nowrap">&nbsp;{L_JOINED}&nbsp;</th>
		<th align="center" class="thCornerR" nowrap="nowrap">&nbsp;{L_ACTIVE}&nbsp;</th>
	</tr>
	<!-- BEGIN user_row -->
	<tr>
		<td class="{user_row.ROW_CLASS}" align="left"><a href="{user_row.U_USERNAME}">{user_row.USERNAME}</a></td>
		<td class="{user_row.ROW_CLASS}" align="center">{user_row.EMAIL}</td>
		<td class="{user_row.ROW_CLASS}" align="center">{user_row.POSTS}</td>
		<td class="{user_row.ROW_CLASS}" align="center">{user_row.JOINED}</td>
		<td class="{user_row.ROW_CLASS}" align="center">{user_row.ACTIVE}</td>
	</tr>
	<!-- END user_row -->
	<tr>
		<td class="catBottom" align="center" valign="middle" colspan="5" height="28">&nbsp;</td>
	</tr>
</table>
<br />
