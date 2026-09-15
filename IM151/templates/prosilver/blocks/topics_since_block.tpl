<form method="post" name="post" action="{S_PROFILCP_ACTION}"><table cellpadding="0" cellspacing="10" border="0" width="100%">
<tr>
	<!-- BEGIN left_part -->
	<td valign="top">
		<!-- BEGIN box -->
		{left_part.box.BOX}
		<!-- BEGIN pagination -->
		<table width="100%" cellspacing="2" cellpadding="2" border="0">
		<tr>
			<td align="left" valign="top"><span class="gensmall"><b>{left_part.box.pagination.PAGE_NUMBER}</b></span></td>
			<td align="right" valign="top"><span class="gensmall"><b>{left_part.box.pagination.PAGINATION}</b></span></td>
		</tr>
		</table>
		<!-- END pagination -->
		<br class="gensmall" />
		<!-- END box -->
	</td>
	<!-- END left_part -->

	<!-- BEGIN right_part -->
	<td width="99%" valign="top">
		<!-- BEGIN box -->
		{right_part.box.BOX}
		<!-- BEGIN pagination -->
		<table width="100%" cellspacing="2" cellpadding="2" border="0">
		<tr>
			<td align="left" valign="top"><span class="gensmall"><b>{right_part.box.pagination.PAGE_NUMBER}</b></span></td>
			<td align="right" valign="top"><span class="gensmall"><b>{right_part.box.pagination.PAGINATION}</b></span></td>
		</tr>
		</table>
		<!-- END pagination -->
		<br class="gensmall" />
		<!-- END box -->
	</td>
	<!-- END right_part -->
</tr>
</table>{S_HIDDEN_FIELDS}</form>