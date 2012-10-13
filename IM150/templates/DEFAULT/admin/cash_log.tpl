{NAVBAR}
<h1>{L_LOG_TITLE}</h1>

<p>{L_LOG_EXPLAIN}</p>

<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
	<tr>
		<th colspan="{NUMTIMEFILTERS}" class="thCornerL">{L_TIME}</th>
		<th colspan="{NUMACTIONFILTERS}" class="thCornerR">{L_TYPE}</th>
	</tr>
	<tr>
		<!-- BEGIN timefilter -->
		<td class="{timefilter.ROW_CLASS}">
			<!-- BEGIN switch_linkpage_on -->
			<a href="{timefilter.LINK}">{timefilter.NAME}</a>
			<!-- END switch_linkpage_on -->
			<!-- BEGIN switch_linkpage_off -->
			<b>{timefilter.NAME}</b>
			<!-- END switch_linkpage_off -->
		</td>
		<!-- END timefilter -->
		<!-- BEGIN actionfilter -->
		<td class="{actionfilter.ROW_CLASS}">
			<!-- BEGIN switch_linkpage_on -->
			<a href="{actionfilter.LINK}">{actionfilter.NAME}</a>
			<!-- END switch_linkpage_on -->
			<!-- BEGIN switch_linkpage_off -->
			<b>{actionfilter.NAME}</b>
			<!-- END switch_linkpage_off -->
		</td>
		<!-- END actionfilter -->
	</tr>
</table>

<table border="0">
	<tr>
	<!-- BEGIN countfilter -->
	<td>
		<!-- BEGIN switch_linkpage_on -->
		<a href="{countfilter.LINK}">{countfilter.NAME}</a>
		<!-- END switch_linkpage_on -->
		<!-- BEGIN switch_linkpage_off -->
		<b>{countfilter.NAME}</b>
		<!-- END switch_linkpage_off -->
	</td>
	<!-- END countfilter -->
	<td>{L_PER_PAGE}</td>
	</tr>
</table>

<table border="0"><tr><td>{PAGINATION}</td></tr></table>

<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
	<tr>
		<th class="thCornerL">{L_TIME}</th>
		<th class="thTop">{L_TYPE}</th>
		<th class="thTop">{L_ACTION}</th>
		<th class="thCornerR">{L_LOG}</th>
	</tr>
	<!-- BEGIN logrow -->
	<tr>
		<td class="{logrow.ROW_CLASS}">{logrow.TIME}</td>
		<td class="{logrow.ROW_CLASS}">{logrow.TYPE}</td>
		<td class="{logrow.ROW_CLASS}">{logrow.ACTION}</td>
		<td class="{logrow.ROW_CLASS}">{logrow.TEXT}</td>
	</tr>
	<!-- END logrow -->
</table>

<table border="0"><tr><td>{PAGINATION}</td></tr></table>
<br />
<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
	<tr>
		<!-- BEGIN actionfilter -->
		<td class="{actionfilter.ROW_CLASS}"><a href="{actionfilter.DELETECOMMAND}"><b>{actionfilter.DELETE}</b></a></td>
		<!-- END actionfilter -->
	</tr>
</table>
<br />
