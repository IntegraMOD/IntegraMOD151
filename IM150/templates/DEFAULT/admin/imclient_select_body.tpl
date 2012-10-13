<h1>{L_USER_TITLE}</h1>

<p>{L_USER_EXPLAIN}</p>
<p>{L_USER_LOOKUP_EXPLAIN}</p>

<form method="post" name="post" action="{S_USER_ACTION}"><table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
	<tr>
		<th class="thHead" align="center" colspan="2">{L_LOOK_UP}</th>
	</tr>
	<tr>
		<td class="row1" align="left" width="150">{L_USERNAME}</td><td class="row2" align="left"><input type="text" class="post" name="username" maxlength="50" size="30" /></td>
	</tr>
	<tr>
		<td class="row1" align="left" width="150">{L_EMAIL_ADDRESS}</td><td class="row2" align="left"><input type="text" class="post" name="email" maxlength="50" size="30" /></td>
	</tr>
	<tr>
		<td class="row1" align="left" width="150">{L_POSTS}</td><td class="row2" align="left"><input type="text" class="post" name="posts" maxlength="12" size="12" /></td>
	</tr>
	<tr>
		<td class="row1" align="left" width="150">{L_JOINED}<br /><span class="gensmall">{L_JOINED_EXPLAIN}</span></td><td class="row2" align="left"><input type="text" class="post" name="joined" maxlength="50" size="30" /></td>
	</tr>
	<tr>
		<td class="catBottom" align="center" valign="middle" colspan="2" height="28"><input type="hidden" name="mode" value="lookup" />{S_HIDDEN_FIELDS}<input type="submit" value="{L_LOOK_UP}" class="liteoption" /></td>
	</tr>
</table></form>
