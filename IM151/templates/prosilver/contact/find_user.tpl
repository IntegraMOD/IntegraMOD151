<!-- BEGIN find_user -->
			<div align="center">
			<table width="50%" cellpadding="2" cellspacing="1" border="0" class="forumline">

				<tr>
					<th colspan="2" class="thTop" height="25" nowrap="nowrap">{find_user.L_ADD_A_USER}</th>
				</tr>
				<tr>
					<form method="post" action="{find_user.S_FORM_ACTION}" name="post">
					{find_user.S_HIDDEN_FIELDS}
					<td class="row1"><span class="genmed"><b>{L_USERNAME}</b></span></td>
					<td class="row2"><span class="genmed"><input type="text" class="post" tabindex="1" name="username" size="25" maxlength="25" value="{find_user.USERNAME}" />&nbsp;<input type="submit" name="usersubmit" value="{find_user.L_FIND_USERNAME}" class="liteoption" onClick="window.open('{find_user.U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" /></span></td>
				</tr>
<!-- BEGIN alert -->
				<tr>
					<td class="row2" align="center" colspan="2">
					<input type="checkbox" name="alert"> <span class="genmed">{L_ALERT}</span></td>
				</tr>
<!-- END alert -->
				<tr>
					<td class="row2" align="center" colspan="2">
					<input type="submit" name="single" value="{find_user.L_ADD_USER}" class="mainoption"/></td>
				</tr>
			</table></form>
			</div>
<!-- END find_user -->
		</td>
	</tr>
</table>
