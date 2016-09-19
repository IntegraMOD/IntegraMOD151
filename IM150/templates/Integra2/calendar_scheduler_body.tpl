<form name="_calendar_scheduler" method="post" action="{ACTION}">
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
	<td class="maintitle">{L_CALENDAR_SCHEDULER}</td>
</tr>
<tr>
	<td align="left" valign="middle" class="nav" width="100%"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEPARATOR}<a href="{U_CALENDAR}" alt="{L_CALENDAR}" title="{L_CALENDAR}" class="genmed">{L_CALENDAR}</a>{NAV_SEPARATOR}<a href="{U_CALENDAR_SCHEDULER}" class="nav">{L_TITLE}</a></span></td>
	<td align="right" valign="bottom" nowrap="nowrap"><span class="gensmall"><b>{PAGINATION}</b></span></td>
</tr>
</table>

<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr>
	<td colspan="3">
		<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
		<tr>
			<!-- BEGIN hour -->
			<td class="{hour.CLASS}" align="center" valign="middle"><span class="genmed"><a href="{hour.U_HOUR}" class="genmed">{hour.HOUR}</a></span></td>
			<!-- END hour -->
		</tr>
		</table>
		<br style="font-size:5;" />
	</td>
</tr>
<tr>
	<td valign="top">
		<table cellpadding="3" cellspacing="1" border="0" class="forumline">
		<tr>
			<!-- BEGIN header_cell -->
			<th width="14%">{header_cell.L_DAY}</th>
			<!-- END header_cell -->
		</tr>
		<tr>
			<td class="cat" colspan="7" align="center">
				<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td class="genmed"><b>&nbsp;<a href="{U_PREC}" class="gen">&laquo;</a>&nbsp;</b></td>
					<td width="100%" align="center">{S_MONTH}{S_YEAR}</td>
					<td class="genmed"><b>&nbsp;<a href="{U_NEXT}" class="gen">&raquo;</a>&nbsp;</b></td>
				</tr>
				</table>
			</td>
		</tr>
		<!-- BEGIN row -->
		<tr>
			<!-- BEGIN cell -->
			<td class="{row.cell.CLASS}" align="center" height="25"><span class="gen">{row.cell.DAY}</span></td>
			<!-- END cell -->
		</tr>
		<!-- END row -->
		<tr>
			<td class="cat" colspan="7" align="center"><span class="genmed"><a href="{U_CALENDAR}" alt="{L_CALENDAR}" title="{L_CALENDAR}" class="genmed"><img src="{IMG_CALENDAR}" border="0" align="absbottom" hspace="5" alt="{L_CALENDAR}" title="{L_CALENDAR}" />{L_CALENDAR}</a></span></td>
		</tr>
		</table>
	</td>
	<td><span class="gensmall">&nbsp;</span></td>
	<td valign="top" width="100%">
		{TOPIC_LIST_SCHEDULER}
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
	<td align="right" valign="bottom" nowrap="nowrap">{S_HIDDEN_FIELDS}<span class="gensmall"><b>{PAGINATION}</b></span></td>
</tr>
</table>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr> 
	<td align="right">{JUMPBOX}</td>
</tr>
</table>