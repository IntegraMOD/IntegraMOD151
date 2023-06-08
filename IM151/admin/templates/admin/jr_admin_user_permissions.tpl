<script language="JavaScript">
function toggle_check_all(main, sub_num)
{
	for (var i=0; i < document.module_form.elements.length; i++)
	{
		var checkbox_element = document.module_form.elements[i];
		if ((main.name.search("check_all_page") != -1) && (checkbox_element.type == 'checkbox'))
		{
			checkbox_element.checked = main.checked;
		}		
		else if ((checkbox_element.name.search("check_all") == -1) && (checkbox_element.name.search(sub_num+"_update_module_") != -1) && (checkbox_element.type == 'checkbox'))
		{
			checkbox_element.checked = main.checked;
		}
	}
}
</script>

<!-- BEGIN statusrow -->
<table width="100%" cellspacing="2" cellpadding="2" border="1" align="center">
	<tr> 
	  <td align="center"><span class="gen">{L_STATUS}<br /></span>
	  <span class="genmed"><b>{I_STATUS_MESSAGE}</b></span><br /></td>
	</tr>
  </table>
<!-- END statusrow -->

<table width="100%" cellspacing="1" cellpadding="2" border="0" align="center">
	<tr> 
	  <td align="left"><span class="maintitle">{L_PAGE_NAME}</span>
	  	<br /><span class="gensmall"><b>{L_VERSION} {VERSION}
	  	<br />{NIVISEC_CHECKER_VERSION}</b></span><br /><br />
	  <span class="genmed">{L_PAGE_DESC}<br /><br />{VERSION_CHECK_DATA}</span></td>
	</tr>
</table>

<br />
<table  border="0" cellpadding="3" cellspacing="1" class="forumline" align="center" width="90%">
	<tr> 
		<th class="thHead" height="25" valign="middle" width="33%">{L_USER_STATS}</th>
		<th class="thHead" height="25" valign="middle" width="33%">{L_USER_INFO}</th>
		<th class="thHead" height="25" valign="middle" width="33%">{L_COLOR_GROUP}</th>
	</tr>
<tr>
<td align="center" class="row1" valign="middle"><span class="gen"><b>{USERNAME}</b></span><br>
{GROUP_NAME}<br><span class="gensmall">{ADMIN_TEXT}</span>
</td>
<td class="row2" align="center" valign="middle">
<form name="user_permissions" action="{S_USER_PERM}" method="post">
<input type="hidden" name="username" value="{USERNAME}">
<input type="hidden" name="mode" value="user">
<input type="submit" name="submit" value="{L_EDIT_PERMISSIONS}" class="liteoption">
</form>
<form name="user_profile" action="{S_PROFILE}" method="get">
<input type="hidden" name="{S_USER_POST_URL}" value="{USER_ID}">
<input type="hidden" name="mode" value="viewprofile">
<input type="submit" name="submit" value="{L_VIEW_PROFILE}" class="liteoption">
</form>
<form name="user_management" action="{S_MANAGEMENT}" method="post">
<input type="hidden" name="username" value="{USERNAME}">
<input type="hidden" name="mode" value="edit">
<input type="submit" name="submituser" value="{L_EDIT_USER_DETAILS}" class="liteoption">
</form>
</td>


<td align="center" class="row2">
<span class="gensmall">{DISABLED_TEXT}</span><br>



<form action="{S_ACTION}" name="module_form" method="post">

<select name="color_group_id" class="post" {DISABLED} size="6">
<option {DEFAULT_SELECT} value="0">{L_NONE}</option>
<!-- BEGIN grouprow -->
<option {grouprow.SELECTED} value="{grouprow.ID}">{grouprow.NAME}</option>
<!-- END grouprow -->
</select>
</td></tr>

<tr>
<td class="row1" align="center"><span class="genmed"><b>{L_START_DATE}</b><br>
{START_DATE}</span><br><br>
<span class="genmed"><b>{L_UPDATE_DATE}</b><br>
{UPDATE_DATE}</span>
</td>

<td class="row3" colspan="2" align="center"><span class="gensmall"><b>{L_NOTES}</b> &nbsp;&nbsp;&nbsp; {L_ALLOW_VIEW}<input type="checkbox" name="notes_view" value="1" {NOTES_VIEW_CHECKED}></span><br>
<TEXTAREA name="admin_notes" class="post" cols="45" rows="5">{NOTES}</TEXTAREA>
</td></tr>
</table>


<br><table  border="0" cellpadding="3" cellspacing="1" class="forumline" align="center" width="95%">
	<tr> 
		<th class="thHead" height="25" valign="middle" colspan="3">{L_MODULE_INFO}</th>
	</tr>
	<tr>
		<td class="row1" colspan="3" align="center" height="28">
		<input type="submit" name="update_user" value="{L_UPDATE}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" name="reset" class="liteoption" /></td>
	</tr>
	<tr>
	<td class="cat" align="right">&nbsp;</td><td class="cat" align="center" width="10%">
		
		<input type="checkbox" name="check_all_page" onClick="toggle_check_all(check_all_page, 1);"></td>
		<td class="cat" align="left"><span class="gen">&nbsp;&nbsp;<-- {L_CHECK_ALL}&nbsp;&nbsp;</span></td>
	</tr>
<!-- BEGIN catrow -->
<tr>
	<td class="cat" colspan="1"><span class="cattitle">{catrow.CAT}</span></td>
	
		<td class="cat" align="center" valign="middle" width="10%">
		<input type="checkbox" name="check_all_{catrow.NUM}" onClick="toggle_check_all(check_all_{catrow.NUM}, {catrow.NUM});">
		</td><td class="cat" align="left" valign="middle">
		<span class="gensmall">&nbsp;&nbsp;<-- {L_CHECK_ALL_IN_CAT}&nbsp;&nbsp;</span>
		</td>
<!-- BEGIN modulerow -->
<tr>
	<td class="{catrow.modulerow.ROW}"><span class="gen"><b>{catrow.modulerow.NAME}</b></span><br><span class="gensmall">{catrow.modulerow.FILENAME}<br>({catrow.modulerow.FILE_HASH})</span></td>
	<td class="{catrow.modulerow.ROW}" width="10%" align="center"><span class="gen"><input type="checkbox" {catrow.modulerow.CHECKED} name="{catrow.NUM}_update_module_{catrow.modulerow.FILE_HASH}"></span></td>
	<td class="{catrow.modulerow.ROW}">&nbsp;</td>
	</tr>
<!-- END modulerow -->
</tr>
<!-- END catrow -->
	<tr>
	<td class="cat" align="right">&nbsp;</td><td class="cat" align="center" width="10%">
		
		<input type="checkbox" name="check_all_page1" onClick="toggle_check_all(check_all_page1, 1);"></td>
		<td class="cat" align="left"><span class="gen">&nbsp;&nbsp;<-- {L_CHECK_ALL}&nbsp;&nbsp;</span></td>
	</tr>
	<tr>
		<td class="cat" colspan="3" align="center" height="28">
		<input type="hidden" name="user_id" value="{USER_ID}">
		<input type="submit" name="update_user" value="{L_UPDATE}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" name="reset" class="liteoption" /></td>
	</tr>
</table>
</form>