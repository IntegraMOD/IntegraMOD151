<div class="maintitle">{L_AUTH_TITLE}</div>
<br />
<div class="subtitle">{L_USER_OR_GROUPNAME}: {USERNAME}</div>
<br />
<form method="post" action="{S_AUTH_ACTION}">

<!-- BEGIN switch_user_auth -->
{USER_LEVEL}<br />
<br />
{USER_GROUP_MEMBERSHIPS}<br />
<!-- END switch_user_auth -->

<!-- BEGIN switch_group_auth -->
{GROUP_MEMBERSHIP}<br />
<!-- END switch_group_auth -->

<div class="subtitle">{L_PERMISSIONS}</div>

<div class="genmed">{L_AUTH_EXPLAIN}</div>
<br />
  
<table cellspacing="1" cellpadding="3" border="0" align="center" class="forumline">
<tr> 
<th width="30%" colspan="{INC_SPAN}">{L_FORUM}</th>
<!-- BEGIN acltype -->
<th>{acltype.L_UG_ACL_TYPE}</th>
<!-- END acltype -->
<th>{L_MODERATOR_STATUS}</th>
</tr>
	<!-- BEGIN row -->
	<!-- BEGIN cat -->
	<tr> 
		<!-- BEGIN inc -->
		<td class="row2" width="46"><img src="{SPACER}" width="46" height="0" /></td>
		<!-- END inc -->
		<td colspan="{row.cat.INC_SPAN}" class="{row.cat.CLASS_CAT}" align="left" nowrap> <span class="cattitlemed">{row.cat.CAT_TITLE}</span></td>
		<!-- BEGIN aclvalues -->
		<td class="{row.cat.CLASS_CAT}" align="left" nowrap><span class="cattitlemed">&nbsp;</span></td>
		<!-- END aclvalues -->
		<td class="{row.cat.CLASS_CAT}" align="left" nowrap><span class="cattitlemed">&nbsp;</span></td>
	</tr>
	<!-- END cat -->
<!-- BEGIN forums -->
		<!-- BEGIN inc -->
		<td class="row2" width="46"><img src="{SPACER}" width="46" height="0" /></td>
		<!-- END inc -->
		<td class="row1" align="left" colspan="{row.forums.INC_SPAN}"><span class="gentbl">{row.forums.FORUM_NAME}</span></td>
		<!-- BEGIN aclvalues -->
		<td class="row2" align="center">{row.forums.aclvalues.S_ACL_SELECT}</td>
		<!-- END aclvalues -->
		<td class="row1" align="center">{row.forums.S_MOD_SELECT}</td>
</tr>
<!-- END forums -->
<!-- END row -->
<tr> 
<td colspan="{S_COLUMN_SPAN}" class="row1" align="center"><span class="gensmall">{U_SWITCH_MODE}</span></td>
</tr>
<tr> 
<td colspan="{S_COLUMN_SPAN}" class="cat" align="center">{S_HIDDEN_FIELDS} 
<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
&nbsp;&nbsp; 
<input type="reset" value="{L_RESET}" class="button" name="reset" />
</td>
</tr>
</table>
</form>
