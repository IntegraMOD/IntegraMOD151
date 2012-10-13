
<h1>{L_MASS_EMAIL_TITLE}</h1>

<p>{L_MASS_EMAIL_TEXT}</p>

<form action="{S_SUBMIT_ACTION}" method="post">



<br clear="all" />

<!-- BEGIN userlist -->
<table class="forumline" cellpadding="4" cellspacing="1" border="0" align="center" width="99%">
	<tr>
		<th colspan="3" >{L_DEST_USERS}</th>
	</tr>
	<!-- BEGIN targets -->
	<tr>
		<td class="row1" width="40%" align="center" ><span class="gen">{userlist.targets.USER_NAME}</span></td>
		<td class="row1" width="40%" align="center" ><span class="gen">{userlist.targets.USER_EMAIL}</span></td>
		<td class="row1" align="center" ><input type="checkbox" name="{userlist.targets.USER_ID}" value="1" /></td>
	</tr>
	<!-- END targets -->
	<tr>
		<td class="cat" colspan="3" align="center">
			<input type="submit" name="remove" value="{L_REMOVE}" class="mainoption" />
			<input type="submit" name="send" value="{L_SEND}" class="mainoption" />
		</td>
	</tr>
</table>

<br clear="all" />

<table class="forumline" cellpadding="4" cellspacing="1" border="0" align="center" width="99%">
	<tr>
		<th colspan="5" >{L_USERLIST}</th>
	</tr>
	<tr>
		<td class="row1" align="left" colspan="2" nowrap="nowrap"><span class="genmed">{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{L_ORDER}&nbsp;{S_ORDER_SELECT}&nbsp;&nbsp;<input type="submit" name="submit" value="{L_SORT}" class="liteoption" /></span></td>
		<td class="row1" align="right" colspan="3" nowrap="nowrap"><input type="submit" name="add" value="{L_ADD}" class="mainoption" /></td>
	</tr>
	<tr>
		<th width="20%" align="center" >{L_USER_NAME}</th>
		<th width="20%" align="center" >{L_USER_EMAIL}</th>
		<th width="20%" align="center" >{L_USER_POSTS}</th>
		<th width="30%" align="center" >{L_USER_GROUPS}</th>
		<th width="10%" align="center" >{L_SELECT}</th>
	</tr>
	<!-- BEGIN users -->
	<tr>
		<td class="{userlist.users.ROW}" width="20%" align="center" ><span class="gen">{userlist.users.USER_NAME}</span></td>
		<td class="{userlist.users.ROW}" width="20%" align="center" ><span class="gen">{userlist.users.USER_EMAIL}</span></td>
		<td class="{userlist.users.ROW}" width="20%" align="center" ><span class="gen">{userlist.users.USER_POSTS}</span></td>
		<td class="{userlist.users.ROW}" width="30%" align="center" ><span class="gen">
		<!-- BEGIN groups -->
			<a href="{userlist.users.groups.GROUP_LINK}">{userlist.users.groups.GROUP_NAME}</a><br />
		<!-- END groups -->
		</span></td>

		<td class="{userlist.users.ROW}" width="10%" align="center" ><input type="checkbox" name="{userlist.users.USER_ID}" value="1" /></td>
	</tr>
	<!-- END users -->
</table>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr> 
	<td><span class="nav">{PAGE_NUMBER}</span></td>
	<td align="right"><span class="nav">{PAGINATION}</span></td>
  </tr>
</table>
<!-- END userlist -->

<!-- BEGIN send -->
<table class="forumline" cellpadding="4" cellspacing="1" border="0" align="center" width="99%">
	<tr>
		<th colspan="3" >{L_DEST_USERS}</th>
	</tr>
	<!-- BEGIN targets -->
	<tr>
		<td class="row1" width="50%" align="center" ><span class="gen">{send.targets.USER_NAME}</span></td>
		<td class="row2" width="50%" align="center" ><span class="gen">{send.targets.USER_EMAIL}</span></td>
	</tr>
	<!-- END targets -->
</table>

<br clear="all" />

<table class="forumline" cellpadding="4" cellspacing="1" border="0" align="center" width="99%">
	<tr>
		<th colspan="2" >{L_MESSAGE_TO_SEND}</th>
	</tr>
	<tr>
		<td class="row1" width="30%" align="center" ><span class="gen"><b>{L_SUBJECT}</b></span></td>
		<td align="center" width="70%" class="row2"><input type="post" name="subject" size="30" maxlength="40"></td>
	</tr>
	<tr>
		<td class="row1" align="center" ><span class="gen"><b>{L_MESSAGE}</b></span></td>
		<td align="center" class="row2"><textarea name="message" rows="15" cols="35" wrap="virtual" style="width:450px" tabindex="3" class="post" ></textarea></td>
	</tr>
	<tr>
		<td class="cat" colspan="3" align="center">
			<input type="submit" name="send_action" value="{L_SEND_MAIL}" class="mainoption" />&nbsp;&nbsp;
			<input type="submit" name="send_pm_action" value="{L_SEND_PM}" class="mainoption" />
		</td>
	</tr>
</table>
<!-- END send -->

</form>
