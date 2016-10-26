<h1>{L_GROUP_EXTEND_TITLE}</h1>

<P>{L_GROUP_EXTEND_TEXT}</p>

<!-- BEGIN group_page -->
<form method="post" action="{S_GROUP_DISP_ACTION}">

<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline" width="100%">
	<tr> 
		<td align="center" nowrap="nowrap" colspan ="2" class="row3"><span class="genmed">{L_SELECT_GROUP_DISP}:&nbsp;{S_GROUP_DISP_SELECT}&nbsp;
	  	<span class="genmed">{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{L_ORDER}&nbsp;{S_ORDER_SELECT}&nbsp;&nbsp; 
		<input type="submit" name="submit" value="{L_SUBMIT}" class="liteoption" /></span></td>
	</tr>
</table>

<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline" width="100%">
	<!-- BEGIN groups -->
	<tr>
	<td class="row2" align="center" width"100%" valign="center"><span class="maintitle"><b>{L_GROUP_EXTEND_GROUPS}</b><br /></span></td>
	</tr>
	<!-- BEGIN groups_list_name -->
	<tr>
	<td align="center" width="100%" class="{group_page.groups.groups_list_name.ROW_CLASS}">
	<span class="gen"><u><a href="{group_page.groups.groups_list_name.LINK}">{group_page.groups.groups_list_name.GL_NAME}</a></u></span>
	<span class="gensmall">{group_page.groups.groups_list_name.GL_USERS}<br /></span>
	</span></td>
	</tr>
	<!-- END groups_list_name -->
	<!-- END groups -->
	<!-- BEGIN users -->
	<tr>
	<td class="row2" align="center"><span class="maintitle"><b>{L_GROUP_EXTEND_USERS}</b><br /></span>
	</tr>
	<!-- BEGIN groups_list_name2 -->
	<tr>
	<td align="center" width="100%" class="{group_page.users.groups_list_name2.ROW_CLASS}">
	<span class="gen"><u><a href="{group_page.users.groups_list_name2.LINK}">{users.groups_list_name2.GL_NAME2}</a></u></span>
 	<span class="gensmall">{group_page.users.groups_list_name2.GL_USERS2}<br /></span>
	</span></td>
	</tr>
	<!-- END groups_list_name2 -->
	</span></td>
	</tr>
	<!-- END users -->

</table>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr> 
	<td><span class="nav">{PAGE_NUMBER}</span></td>
	<td align="right"><span class="nav">{PAGINATION}</span></td>
  </tr>
</table>

</form>
<!-- END group_page -->

<!-- BEGIN group_page1 -->
<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline" width="100%">
	<tr>
		<td class="row2" align="center" width"100%" valign="center"><span class="maintitle"><b>{GROUP_NAME}</b><br /></span><span class ="gen">{GROUP_DESC}</span></td>
	</tr>
	<tr>
		<td class="row2" align="center" width"100%" valign="center"><span class ="gen">&nbsp;</span></td>
	</tr>
	<tr>
		<td class="row2" align="center" width"100%" valign="center"><span class ="gen"><b>{L_MOD}</b></span></td>
	</tr>
<!-- BEGIN groups_auths_mod -->
	<tr>
		<td class="row2" align="center" width"100%" valign="center"><span class="gen">{group_page1.groups_auths_mod.FORUM_NAME}<br /></span></td>
	</tr>	
<!-- END groups_auths_mod -->
	<tr>
		<td class="row2" align="center" width"100%" valign="center"><span class ="gen">&nbsp;</span></td>
	</tr>
	<tr>
		<td class="row2" align="center" width"100%" valign="center"><span class ="gen"><b>{L_VIEW}</b></span></td>
	</tr>
<!-- BEGIN groups_auths_view -->
	<tr>
		<td class="row2" align="center" width"100%" valign="center"><span class="gen">{group_page1.groups_auths_view.FORUM_NAME}<br /></span></td>
	</tr>	
<!-- END groups_auths_view -->
</table>
<!-- END group_page1 -->

<!-- BEGIN group_page2 -->
<table cellspacing="1" cellpadding="10" border="0" align="center" class="forumline" width="100%">
	<tr>
		<td class="row2" align="center" width"100%" valign="center"><span class="maintitle"><b>{L_AUTHS}{USERNAME}</b></span></td>
	</tr>
</table>
<!-- BEGIN forums -->
	<tr> 
		<td class="spaceRow" colspan="5" height="5">&nbsp;</td>
	</tr>
<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline" width="80%">

	<tr>
		<td class="row1" align="center" width"100%" valign="center" colspan="5"><span class="cattitle">{group_page2.forums.FORUM_NAME}<br /></span></td>
	</tr>	
	<tr>
		<td class="row2" align="center" valign="center"><span class="gen"><b>{L_FORUM_MOD}</b></span></td>
		<td class="row1" align="center" valign="center"><span class="gen">{L_FORUM_VIEW}</span></td>
		<td class="row2" align="center" valign="center"><span class="gen">{L_FORUM_READ}</span></td>
		<td class="row1" align="center" valign="center"><span class="gen">{L_FORUM_POST}</span></td>
		<td class="row2" align="center" valign="center"><span class="gen">{L_FORUM_REPLY}</span></td>
	</tr>	
	<tr>
		<td class="row2" align="center" valign="center"><span class="gen"><b>{group_page2.forums.FORUM_MOD}</b></span></td>
		<td class="row1" align="center" valign="center"><span class="gen">{group_page2.forums.FORUM_VIEW}</span></td>
		<td class="row2" align="center" valign="center"><span class="gen">{group_page2.forums.FORUM_READ}</span></td>
		<td class="row1" align="center" valign="center"><span class="gen">{group_page2.forums.FORUM_POST}</span></td>
		<td class="row2" align="center" valign="center"><span class="gen">{group_page2.forums.FORUM_REPLY}</span></td>
	</tr>	
</table>
<!-- END forums -->
</table>
<!-- END group_page2 -->

<br clear="all" />