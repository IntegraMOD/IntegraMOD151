<form name="user_list" method="post" action="{S_FORM_ACTION}">
	{S_HIDDEN_FIELDS}
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr>
		<td class="nav">
			<a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> 
			<a href="{U_CONTACT_MAN}" class="nav">{L_CONTACT_MAN}</a> -> 
			{TYPE_TITLE}
		</td>
	</tr>
</table>

	<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
		<tr>
			<th colspan="6" class="thTop" height="25">{L_CONTACT_MAN}</th>
		</tr>
		{CONTACT_CP_LINKS}

		<tr>
			<td class="catHead" height="25" nowrap="nowrap" align="center" colspan="6"><span class="cattitle">{TYPE_TITLE}</span></td>
		</tr>
		<tr>
			<td class="row1" colspan="6">
				<span class="genmed">
				{L_ADD_CONTACTS_EXPLAIN}
				</span>
			</td>
		</tr>
		<tr>
			<td class="row1" colspan="4">
				<textarea name="list_to_add" rows="10" cols="70" class="post"></textarea>
			</td>
			<td class="row1" colspan="2" valign="top">
				<span class="genmed">
				<input type="radio" name="type" value="buddy" checked="checked" />
				{L_ADD_TO_BUDDY_LIST}<br />
				<input type="radio" name="type" value="ignore" />
				{L_ADD_TO_IGNORE_LIST}<br />
				<input type="radio" name="type" value="disallow" />
				{L_ADD_TO_DISALLOW_LIST}<br /><br />
				<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
				<input type="reset" name="reset" value="{L_RESET}" class="liteoption" />
				</span>
			</td>
		</tr>
	</table>
</form>
