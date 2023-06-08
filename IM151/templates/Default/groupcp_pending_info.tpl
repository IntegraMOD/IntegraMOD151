<br />
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
	<tr>
		<!-- BEGIN headers -->
		<th>{headers.L_HEADER}</th>
		<!-- END headers -->
		<th>{L_SELECT}</th>
	</tr>
	<tr>
		<td class="cat" colspan="{ROWCOUNT}">{L_PENDING_MEMBERS}</td>
	</tr>
	<!-- BEGIN pending_members_row -->
	<tr>
		<!-- BEGIN member_fields -->
		<td class="{pending_members_row.ROW_CLASS}" width="{pending_members_row.member_fields.WIDTH}" align="center">
			{member_type.member_row.member_fields.FIELD}
		</td>
		<!-- END member_fields -->
		<td class="{pending_members_row.ROW_CLASS}" align="center"> 
	  <input type="checkbox" name="pending_members[]" value="{pending_members_row.USER_ID}" checked="checked" />
	  </td>
	</tr>
	<!-- END pending_members_row -->
<tr>
<td class="cat" colspan="8" align="right">
<input type="submit" name="approve" value="{L_APPROVE_SELECTED}" class="mainoption" />&nbsp;&nbsp;
<input type="submit" name="deny" value="{L_DENY_SELECTED}" class="button" />
</td>
</tr>
</table>