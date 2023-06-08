<table cellpadding="4" cellspacing="1" border="0" class="forumline" width="100%">
<tr>
	<th >&nbsp;{L_NEW_PM}&nbsp;</th>
	<th width="150" nowrap="nowrap">&nbsp;{L_FROM}&nbsp;</th>
	<th width="150" nowrap="nowrap">&nbsp;{L_DATE}&nbsp;</th>
</tr>
<!-- BEGIN new_pm -->
<tr>
	<td class="{new_pm.CLASS}"><a href="{new_pm.U_TITLE}" class="topictitle">{new_pm.TITLE}</a></td>
	<td class="{new_pm.CLASS}" align="center"><span class="name"><a href="{new_pm.U_AUTHOR}" class="{new_pm.CLASS_NAME}">{new_pm.USERNAME}</a></span></td>
	<td class="{new_pm.CLASS}" align="center" nowrap="nowrap"><span class="postdetails">{new_pm.DATE}</span></td>
</tr>
<!-- END new_pm -->
<!-- BEGIN no_new_pm -->
<tr>
	<td class="row1" nowrap="nowrap" align="center" colspan="3"><span class="genmed"><i>{no_new_pm.L_NO_MESSAGES}</i></span></td>
</tr>
<!-- END no_new_pm -->
</table>