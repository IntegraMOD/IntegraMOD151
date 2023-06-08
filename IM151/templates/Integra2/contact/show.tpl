<script language="JavaScript" type="text/javascript">
<!--
function select_switch(status)
{
	for (i = 0; i < document.user_list.length; i++)
	{
		document.user_list.elements[i].checked = status;
	}
}
//-->
</script>

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
		<th colspan="2" class="thTop" height="25">{L_CONTACT_MAN}</th>
	</tr>
	<tr>
		<td class="row1" valign="middle">

		<!-- BEGIN top -->
			<table cellspacing="2" cellpadding="2" border="0" align="center" width="100%">
{CONTACT_CP_LINKS}
				<tr>
					<td colspan="6" align="center">
						<span class="gen">{NO_LIST}</span>
					</td>
				</tr>
			</table>
		<!-- END top -->
		<!-- BEGIN list -->
			<form method="post" action="{S_SORT_ACTION}">
			<table cellspacing="2" cellpadding="2" border="0" align="center" width="100%">
{CONTACT_CP_LINKS}
				<tr>
					<td colspan="3"><span class="nav">{PAGE_NUMBER}</span></td>
					<td colspan="3" align="right"><span class="nav">{PAGINATION}</span></td>
				</tr>
				<tr>
					<td colspan="3"><span class="nav">{TOTAL_TEXT}</span></td>
					<td colspan="3" align="right" nowrap="nowrap">
						<span class="genmed">{L_ORDER} {S_ORDER_SELECT}</span>
					</td>
				</tr>
			</table>
			</form>

			<form name="user_list" method="post" action="{list.S_FORM_ACTION}">
			{list.S_HIDDEN_FIELDS}
			<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
				<tr>
					<td class="catHead" height="25" nowrap="nowrap" align="center" colspan="5"><span class="cattitle">{TYPE_TITLE}</span></td>
				</tr>
				<tr>
					<th class="thTop" nowrap="nowrap">#</th>
					<th class="thTop" nowrap="nowrap">{L_USERNAME}</th>
					<th class="thTop" nowrap="nowrap">{L_PROFILE}</th>
					<th class="thTop" nowrap="nowrap">&nbsp;</th>
					<th class="thTop" nowrap="nowrap">{L_SELECT}</th>
				</tr>
				<!-- BEGIN list_row -->
				<tr>
					<td class="{list.list_row.ROW_CLASS}" align="center" valign="middle"><span class="gen">{list.list_row.ROW_NUMBER}</span></td>
					<td class="{list.list_row.ROW_CLASS}" align="center" valign="middle"><span class="gen"><a href="{list.list_row.U_PROFILE}">{list.list_row.USERNAME}</a></span></td>
					<td class="{list.list_row.ROW_CLASS}" align="center" valign="middle">{list.list_row.PROFILE_IMG}</td>
					<td class="{list.list_row.ROW_CLASS}" align="center" valign="middle">{list.list_row.PM_IMG}</td>
					<td class="{list.list_row.ROW_CLASS}" align="center" valign="middle">&nbsp;
					<!-- BEGIN mark -->
						<input type="checkbox" name="mark[]2" value="{list.list_row.mark.S_MARK_ID}" />
					<!-- END mark -->
					</td>
				</tr>
				<!-- END list_row -->
				<tr>
					<td class="row2" align="right" colspan="5" valign="middle">
						<span class="genmed">
						<a href="javascript:select_switch(true);">{L_MARK_ALL}</a>
						<a href="javascript:select_switch(false);">{L_UNMARK_ALL}</a>
						<input type="submit" name="submit" value="{list.L_ADD_TO_BUDDY}" class="mainoption" />
						</span>
					</td>
				</tr>
			</table>
			</form>

			<br />
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
				<tr>
					<td><span class="nav">{PAGE_NUMBER}</span></td>
					<td align="right"><span class="nav">{PAGINATION}</span></td>
				</tr>
			</table>
		<!-- END list -->
		</td>
	</tr>
</table>
