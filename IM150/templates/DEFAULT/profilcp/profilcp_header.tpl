<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
	<td align="left" class="nav">
		<a href="{U_INDEX}" class="nav">{L_INDEX}</a>
		{NAV_SEPARATOR}<a href="{U_MODULE}" class="nav">{L_MODULE}</a>
		<!-- BEGIN sub_menu -->
		{NAV_SEPARATOR}<a href="{sub_menu.U_MODULE}" class="nav">{sub_menu.L_MODULE}</a>
		<!-- END sub_menu -->
	</td>
</tr>
</table>

<table class="profileline" width="100%" cellpadding="0" cellspacing="2" border="0">
<tr>
	<!-- BEGIN opt -->
	<!-- BEGIN curopt -->
	<td class="row2 profilelinea" nowrap="nowrap" align="center" width="{WIDTH}%">
		&nbsp;<span class="gensmall"><b>{opt.curopt.SHORTCUT}</b></span>&nbsp;
	</td>
	<!-- END curopt -->
	<!-- BEGIN otheropt -->
	<td nowrap="nowrap" align="center" width="{WIDTH}%">
		<table cellpadding="1" cellspacing="0" border="0" width="100%" class="bodylinea">
		<tr><td nowrap="nowrap" align="center">
		&nbsp;<a href="{opt.otheropt.U_SHORTCUT}" class="gensmall">{opt.otheropt.SHORTCUT}</a>&nbsp;
		</td></tr></table>
	</td>
	<!-- END otheropt -->
	<!-- BEGIN inactopt -->
	<td nowrap="nowrap" align="center" width="{WIDTH}%">
		<table cellpadding="1" cellspacing="0" border="0" width="100%" class="bodylinea">
		<tr><td nowrap="nowrap" class="row3" align="center">
		&nbsp;<span class="gensmall"><i>{opt.inactopt.SHORTCUT}</i></span>&nbsp;
		</td></tr></table>
	</td>
	<!-- END inactopt -->
	<!-- END opt -->
	<!-- BEGIN filleropt -->
	<td nowrap="nowrap" align="center" width="{FILLER_WIDTH}%">
		&nbsp;
	</td>
	<!-- END filleropt -->
</tr>
<tr>
	<td colspan="{NBOPT}">
		<table cellpadding="10" cellspacing="0" width="100%" border="0">
		<tr>
			<td>
				<!-- BEGIN sub_menu -->
				<table cellpadding="10" cellspacing="0" border="0" width="100%">
				<tr>
					<td>
						<table cellpadding="0" cellspacing="2" border="0" width="100%">
						<tr>
							<!-- BEGIN opt -->
							<!-- BEGIN curopt -->
							<td nowrap="nowrap" class="profilelinea" align="center" width="{sub_menu.WIDTH}%">
								&nbsp;<span class="gensmall"><b>{sub_menu.opt.curopt.SHORTCUT}</b></span>&nbsp;
							</td>
							<!-- END curopt -->
							<!-- BEGIN otheropt -->
							<td nowrap="nowrap" align="center" width="{sub_menu.WIDTH}%">
								<table cellpadding="1" cellspacing="0" border="0" width="100%" class="bodylinea">
								<tr><td nowrap="nowrap" class="row1" align="center">
								&nbsp;<a href="{sub_menu.opt.otheropt.U_SHORTCUT}" class="gensmall">{sub_menu.opt.otheropt.SHORTCUT}</a>&nbsp;
								</td></tr></table>
							</td>
							<!-- END otheropt -->
							<!-- END opt -->
							<!-- BEGIN filleropt -->
							<td nowrap="nowrap" align="center" width="{sub_menu.FILLER_WIDTH}%">
								&nbsp;
							</td>
							<!-- END filleropt -->
						</tr>
						<tr>
							<td	class="row1" colspan="{sub_menu.NBOPT}">
								<table  class="profilelinea" cellpadding="0" cellspacing="10" width="100%" border="0">
								<tr>
									<td class="row4">
				<!-- END sub_menu -->
