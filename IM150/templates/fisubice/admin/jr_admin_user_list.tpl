<!-- DEBUG_ID_MIKE START jr_admin_user_list.tpl -->
<!-- BEGIN statusrow -->
<table width="100%" cellspacing="2" cellpadding="2" border="1" align="center">
	<tr> 
	  <td align="center"><span class="gen">{L_STATUS}<br /></span>
	  <span class="genmed"><b>{I_STATUS_MESSAGE}</b></span><br /></td>
	</tr>
  </table>
<!-- END statusrow -->

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr> 
	  <td align="left"><span class="maintitle">{L_PAGE_NAME}</span>
	  	<br /><span class="gensmall"><b>{L_VERSION} {VERSION}
	  	<br />{NIVISEC_CHECKER_VERSION}</b></span><br /><br />
	  <span class="genmed">{L_PAGE_DESC}<br /><br />{VERSION_CHECK_DATA}</span></td>
	</tr>
</table>

<br />
<form action="{S_ACTION}" name="user_list_form" method="post">

<p>
<table border="0" cellpadding="0" cellspacing="0" align="center"><tr><td>
{LETTER_HEADING}
</tr></td></table>
</p>

<table  border="0" cellpadding="3" cellspacing="1" width="96%" class="forumline" align="center">
	<tr> 
		<td class="row3" height="30" valign="middle" align="center"><a href="{S_USERNAME}" class="cattitle">{L_USERNAME}</a>&nbsp;{IMG_USERNAME}</td>
		<!-- BEGIN colorgroup_switch -->
		<td class="row3" height="25" valign="middle" align="center"><a href="{S_COLORGROUP}" class="cattitle">{L_COLOR_GROUP}</a>&nbsp;{IMG_COLORGROUP}</td>
		<!-- END colorgroup_switch -->
		<td class="row3" height="25" valign="middle" align="center"><a href="{S_RANK}" class="cattitle">{L_RANK}</a>&nbsp;{IMG_RANK}</td>
		<td class="row3" height="25" valign="middle" align="center"><a href="{S_AVATAR}" class="cattitle">{L_AVATAR}</a>&nbsp;{IMG_AVATAR}</td>
		<td class="row3" height="25" valign="middle" align="center"><a href="{S_PM}" class="cattitle">{L_PM}</a>&nbsp;{IMG_PM}</td>
		<td class="row3" height="25" valign="middle" align="center"><a href="{S_ACTIVE}" class="cattitle">{L_ACTIVE}</a>&nbsp;{IMG_ACTIVE}</td>
		<td class="row2" height="25" valign="middle" align="center">&nbsp;</td>
</tr>
<!-- BEGIN userrow -->
<tr>
	<td class="{userrow.ROW_CLASS}"><span class="gensmall">{userrow.BOOKMARK}{userrow.NAME}{userrow.BOOKMARK_END}</span>&nbsp;&nbsp;<span class="gensmall">{userrow.MODULE_COUNT}</span></td>
	<!-- BEGIN colorrow -->
 		<td class="{userrow.ROW_CLASS}" nowrap="nowrap" align="center">[&nbsp;<font color="{userrow.colorrow.GROUP_COLOR}">{userrow.colorrow.GROUP_NAME}</font> ]</td>
	<!-- END colorrow -->	
	<!-- BEGIN blank_colorrow -->
 		<td class="{userrow.ROW_CLASS}" nowrap="nowrap">&nbsp;</td>
	<!-- END blank_colorrow -->	
	
<td class="{userrow.ROW_CLASS}" align="center">{userrow.RANK_LIST}</td>
	<td class="{userrow.ROW_CLASS}" align="center"><input type="checkbox" name="allow_pm_user_{userrow.ID}" {userrow.ALLOW_PM}></td>
	<td class="{userrow.ROW_CLASS}" align="center"><input type="checkbox" name="allow_avatar_user_{userrow.ID}" {userrow.ALLOW_AVATAR}></td>
	<td class="{userrow.ROW_CLASS}" align="center"><input type="checkbox" name="active_user_{userrow.ID}" {userrow.ACTIVE}></td>
	<td class="{userrow.ROW_CLASS}" align="center"><input type="submit" name="edit_user_{userrow.ID}" value="{L_EDIT_LIST}" class="liteoption"></td>
</tr>

<!-- END userrow -->
</table>
</form>
<!-- DEBUG_ID_MIKE END jr_admin_user_list.tpl -->
