
<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form name="post" method="post" action="{S_ACTION}">
<table width="100%" cellpadding="4" cellspacing="1" border="0"><tr><td class="nav">{S_NAV_DESC}</td></tr></table>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
<tr>
	<th align="center" colspan="{HEAD_SPAN}">{L_TITLE}</th>
	<th align="center" colspan="2">{L_SETTINGS}</th>
	<!-- BEGIN switch_import_no -->
	<th align="center" nowrap="nowrap" colspan="2">&nbsp;{L_ACTION}&nbsp;</span></th>
	<!-- END switch_import_no -->
</tr>
<!-- BEGIN qbar -->
<tr>
	<td class="row3" colspan="{qbar.SPAN}">
		<!-- BEGIN switch_hide_fields -->
		<input type="checkbox" name="open_ids[{qbar.PANEL_ID}]" value="1" onClick="javascript:submit()" {qbar.OPENED} />&nbsp;&nbsp;
		<!-- END switch_hide_fields -->
		{qbar.NAME}&nbsp;&nbsp;{qbar.STYLE}{qbar.SUB_TEMPLATE}
	</td>
	<td class="row3" nowrap="nowrap">
		<span class="gensmall">
			<b>{L_CLASS}:</b>&nbsp;{qbar.CLASS}<br />
			<b>{L_DISPLAY}:</b>&nbsp;{qbar.DISPLAY}
		</span>
	</td>
	<td class="row3" nowrap="nowrap">
		<span class="gensmall">
			<b>{L_CELLS}:</b>&nbsp;{qbar.CELLS}<br />
			<b>{L_IN_TABLE}:</b>&nbsp;{qbar.IN_TABLE}
		</span>
	</td>
	<!-- BEGIN switch_import_no -->
	<td class="row3" align="center">
		<span class="gen">
			<!-- BEGIN switch_system_no -->
			<a href="{qbar.U_EDIT}" class="gen">{L_EDIT}</a>
			<br />
			<a href="{qbar.U_DELETE}" class="gen">{L_DELETE}</a>
			<!-- END switch_system_no -->
		</span>
	</td>
	<td class="row3" align="center" nowrap="nowrap">
		<span class="gen">
			<!-- BEGIN switch_system_no -->
			<a href="{qbar.U_MOVEUP}" class="gen">{L_MOVEUP}</a>
			<br />
			<a href="{qbar.U_MOVEDW}" class="gen">{L_MOVEDW}</a>
			<!-- END switch_system_no -->
		</span>
	</td>
	<!-- END switch_import_no -->
</tr>
<!-- BEGIN field -->
<tr>
	<td width="30" class="row3">
		<!-- BEGIN switch_import -->
		<input type="checkbox" name="field_ids[]" value="{qbar.field.FIELD_ID}" {qbar.field.FIELD_CHECKED} />
		<!-- END switch_import -->
	</td>
	<!-- BEGIN inc -->
	<td class="{qbar.field.inc.ROW_CLASS}" width="30">&nbsp;</td>
	<!-- END inc -->
	<td class="{qbar.field.ROW_CLASS}" colspan="{qbar.field.SPAN}">
		<a href="{qbar.field.U_NAME}" class="gen">{qbar.field.NAME}</a><br />
		<span class="genmed"><b>{L_INTERNAL}:</b>&nbsp;{qbar.field.INTERNAL}</span>
		<span class="genmed"><b>{L_WINDOW}:</b>&nbsp;{qbar.field.WINDOW}</span>
	</td>
	<td width="30" class="{qbar.field.ROW_CLASS}" nowrap="nowrap" align="center"><span class="gensmall">{qbar.field.ICON}</span></td>
	<td class="{qbar.field.ROW_CLASS}" nowrap="nowrap" colspan="2">
		<table cellpadding="2" cellspacing="1" border="0" width="100%">
		<tr><td colspan="2"><span class="genmed"><b>{L_SHORTCUT}:</b>&nbsp;{qbar.field.SHORTCUT}</span></td></tr>
		<!-- BEGIN switch_alternate -->
		<tr><td colspan="2"><span class="genmed"><b>{L_ALTERNATE}:</b>&nbsp;{qbar.field.ALTERNATE}</span></td></tr>
		<!-- END switch_alternate -->
		<tr><td colspan="2"><span class="gensmall"><b>{L_EXPLAIN}:</b>&nbsp;{qbar.field.EXPLAIN}</span></td></tr>
		<!-- BEGIN switch_tree -->
		<tr><td colspan="2"><span class="gensmall"><b>{L_TREE}:</b>&nbsp;{qbar.field.TREE_TITLE}</span></td></tr>
		<!-- END switch_tree -->
		<!-- BEGIN line -->
		<tr>
			<!-- BEGIN has_php_function -->
			<td width="50%" nowrap="nowrap"><span class="gensmall"><b>{L_QBAR_PHP_FUNCTION}:</b>&nbsp;{qbar.field.has_php_function.NAME}</span></td>
			<!-- END has_php_function -->
			<!-- BEGIN switch_auth_logged -->
			<td width="50%" nowrap="nowrap"><span class="gensmall"><b>{L_AUTH_LOGGED}:</b>&nbsp;{qbar.field.AUTH_LOGGED}</span></td>
			<!-- END switch_auth_logged -->
			<!-- BEGIN switch_auth_admin -->
			<td width="50%" nowrap="nowrap"><span class="gensmall"><b>{L_AUTH_ADMIN}:</b>&nbsp;{qbar.field.AUTH_ADMIN}</span></td>
			<!-- END switch_auth_admin -->
			<!-- BEGIN switch_auth_pm -->
			<td width="50%" nowrap="nowrap"><span class="gensmall"><b>{L_AUTH_PM}:</b>&nbsp;{qbar.field.AUTH_PM}</span></td>
			<!-- END switch_auth_pm -->
			<!-- BEGIN switch_filler -->
			<td width="50%" nowrap="nowrap"></td>
			<!-- END switch_filler -->
		</tr>
		<!-- END line -->
		</table>
	</td>
	<!-- BEGIN switch_import_no -->
	<td class="{qbar.field.ROW_CLASS}" align="center">
		<span class="gen">
			<!-- BEGIN switch_system_no -->
			<a href="{qbar.field.U_EDIT}" class="gen">{L_EDIT}</a>
			<br />
			<a href="{qbar.field.U_DELETE}" class="gen">{L_DELETE}</a>
			<!-- END switch_system_no -->
		</span>
	</td>
	<td class="{qbar.field.ROW_CLASS}" align="center" nowrap="nowrap">
		<span class="gen">
			<!-- BEGIN switch_system_no -->
			<a href="{qbar.field.U_MOVEUP}" class="gen">{L_MOVEUP}</a>
			<br />
			<a href="{qbar.field.U_MOVEDW}" class="gen">{L_MOVEDW}</a>
			<!-- END switch_system_no -->
		</span>
	</td>
	<!-- END switch_import_no -->
</tr>
<!-- END field -->
<!-- BEGIN switch_show_fields -->
<tr>
	<td class="cat"></td>
	<td class="cat" colspan="{MIDDLE_SPAN}">
		<!-- BEGIN switch_import_no -->
		<input type="text" name="field_name[{qbar.PANEL_ID}]" />&nbsp;
		<input type="submit" name="create_field[{qbar.PANEL_ID}]" value="{L_CREATE_FIELD}" class="liteoption" />&nbsp;
		<input type="submit" name="import_field[{qbar.PANEL_ID}]" value="{L_IMPORT_FIELD}" class="liteoption" />
		<!-- END switch_import_no -->
	</td>
</tr>
<!-- END switch_show_fields -->
<!-- END qbar -->
<tr>
	<!-- BEGIN switch_import_no -->
	<td class="cat" colspan="{BOTTOM_SPAN}">{S_HIDDEN_FIELDS}
		<input type="text" name="panel_name" />&nbsp;
		<input type="submit" name="create_panel" value="{L_CREATE_PANEL}" class="liteoption" />
	</td>
	<!-- END switch_import_no -->
	<!-- BEGIN switch_import -->
	<td class="cat" align="center" colspan="{BOTTOM_SPAN}">{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" value="{L_SELECT}" class="mainoption" />&nbsp;
		<input type="submit" name="cancel" value="{L_CANCEL}" class="liteoption" />
	</td>
	<!-- END switch_import -->
</tr>
</table>
</form>