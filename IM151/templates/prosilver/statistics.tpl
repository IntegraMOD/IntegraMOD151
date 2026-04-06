<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
	<td class="maintitle">{L_STATISTICS}</td>
</tr>
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_SEPARATOR}{L_STATISTICS}</td>
</tr>
</table>
<!-- BEGIN modules -->
<a name="{modules.MODULE_ID}"></a>
<br />
<!-- cached: {modules.CACHED}<br /> reloaded: {modules.RELOADED}<br /> -->
{modules.CURRENT_MODULE}
<!--
<!-- BEGIN switch_display_timestats -->
<table border="0" cellpadding="0" cellspacing="0" class="forumline" width="100%"> 
<tr> 
	<td class="row2" align="center"><span class="gen">Last Update Time</span></td>
	<td class="row2" align="center"><span class="gen">{modules.LAST_UPDATE_TIME}</span></td>
	<td class="row2" align="center"><span class="gen">Next expected Update</span></td>
	<td class="row2" align="center"><span class="gen">{modules.NEXT_GUESSED_UPDATE_TIME}</span></td>
</tr> 
</table>
<!-- END switch_display_timestats -->
//-->
<!-- END modules -->

<br />
<center><span class="copyright">Statistics Mod Version 3 Demonstration (BETA3-2003-03-16)
<!-- BEGIN switch_debug -->
<br /><br /><br />Statistics Mod - [time: {TIME} | sql time: {SQL_TIME} | queries: {QUERY} | <a href="{U_EXPLAIN}" target="_blank">Explain</a>]
<!-- END switch_debug -->
</span></center>