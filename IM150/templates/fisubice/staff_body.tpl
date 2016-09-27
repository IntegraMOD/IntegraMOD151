<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr>
		<td class="maintitle">{L_STAFF_TITLE}</td>
	</tr>
  <tr> 
	<td class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEPARATOR}{L_STAFF_TITLE}</td>
  </tr>
	</table>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
  <tr>
        <th class="thTop">{L_USERNAME}</th>
        <th class="thTop">{L_FORUMS}</th>
        <th class="thTop">{L_STATS}</th>
        <th class="thTop">{L_CONTACT}</th>
  </tr>
  <!-- BEGIN user_level -->
  <tr>
        <td class="row3" colspan="6"><span class="nav"><b>{user_level.USER_LEVEL}</b></span></td>
  </tr>
  <!-- BEGIN staff -->
	<tr> 
        <td class="{user_level.staff.ROW_CLASS}" valign="top">
					{user_level.staff.PANEL_INFO}
				</td>
        <td class="{user_level.staff.ROW_CLASS}" valign="top"><span class="genmed">{user_level.staff.FORUMS}</span></td>
        <td class="{user_level.staff.ROW_CLASS}" valign="top">
					<span class="gensmall">{user_level.staff.PANEL_STATS}</span>
				</td>
        <td class="{user_level.staff.ROW_CLASS}" valign="top" align="center">
					{user_level.staff.PANEL_CONTACT}
				</td>
  </tr>
  <!-- END staff -->
  <!-- END user_level -->
  <tr>
        <td class="cat" colspan="6">&nbsp;</td>
  </tr>
</table>