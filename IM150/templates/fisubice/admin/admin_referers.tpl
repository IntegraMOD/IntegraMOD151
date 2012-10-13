<h1>{L_HTTP_REFERERS_TITLE}</h1>

<p>{L_HTTP_REFERERS_EXPLAIN}</p>

<p align="center"><form action="{U_SHOW_URLS_ACTION}" method="post"><input type="submit" value="{L_DO_SHOW_URLS}" class="liteoption"></form></p>

<table width="95%" align="center" cellpadding="3" cellspacing="1" border="0" class="forumline"><form action="{U_LIST_ACTION}" method="post">
	<tr>
		<td class="catHead" align="center" colspan="7"><span class="genmed">{L_SELECT_SORT_METHOD}:&nbsp;
		<select name="sort">
			<option value="referer_host" {REFERER_SELECTED} >{L_REFERER}</option>
			<option value="referer_hits" {HITS_SELECTED} >{L_HITS}</option>
			<option value="referer_firstvisit" {FIRSTVISIT_SELECTED} >{L_FIRSTVISIT}</option>
			<option value="referer_lastvisit" {LASTVISIT_SELECTED} >{L_LASTVISIT}</option>
		</select>
		{L_ORDER}:&nbsp;
		<select name="order">
			<option value="" {ASC_SELECTED} >{L_SORT_ASCENDING}</option>
			<option value="DESC" {DESC_SELECTED}>{L_SORT_DESCENDING}</option>
		</select>
		<!-- BEGIN switch_show_ref_urls -->
		<input type="hidden" name="mode" value="showurls">
		<!-- END switch_show_ref_urls -->
		<input type="submit" value="{L_SORT}" class="liteoption">
		</span></td>
	</tr>
	<tr>
		<th class="thCornerL" nowrap="nowrap">&nbsp;{L_REFERER}&nbsp;</th>
		<!-- BEGIN switch_show_ref_urls -->
		<th class="thTop" nowrap="nowrap">&nbsp;{L_REFERER_URL}&nbsp;</th>
		<th class="thTop" nowrap="nowrap">&nbsp;{L_REFERER_IP}&nbsp;</th>
		<!-- END switch_show_ref_urls -->
		<th class="thTop" nowrap="nowrap">&nbsp;{L_HITS}&nbsp;</th>
		<th class="thTop" nowrap="nowrap">&nbsp;{L_FIRSTVISIT}&nbsp;</th>
		<th class="thTop" nowrap="nowrap">&nbsp;{L_LASTVISIT}&nbsp;</th>
		<th class="thCornerR" nowrap="nowrap">&nbsp;{L_ACTION}&nbsp;</th>
	</tr>
	<!-- BEGIN refererrow_with_ref_urls -->
	<tr>
		<td class="{refererrow_with_ref_urls.COLOR}" nowrap="nowrap"><span class="gensmall"><a href="{refererrow_with_ref_urls.U_REFERER}" target="_blank">{refererrow_with_ref_urls.REFERER}</a></span></td>
		<td class="{refererrow_with_ref_urls.COLOR}" align="center" nowrap="nowrap"><span class="gensmall"><a href="{refererrow_with_ref_urls.U_URL}"{refererrow_with_ref_urls.URL_TITLE} target="_blank">{refererrow_with_ref_urls.URL}</a></span></td>
		<td class="{refererrow_with_ref_urls.COLOR}" align="center" nowrap="nowrap"><span class="gensmall"><a href="{refererrow_with_ref_urls.U_IP}">{refererrow_with_ref_urls.L_IP}</a></span></td>
		<td class="{refererrow_with_ref_urls.COLOR}" align="center" nowrap="nowrap"><span class="gensmall">{refererrow_with_ref_urls.HITS}</span></td>
		<td class="{refererrow_with_ref_urls.COLOR}" align="center" nowrap="nowrap"><span class="gensmall">{refererrow_with_ref_urls.FIRSTVISIT}</span></td>
		<td class="{refererrow_with_ref_urls.COLOR}" align="center" nowrap="nowrap"><span class="gensmall">{refererrow_with_ref_urls.LASTVISIT}</span></td>
		<td class="{refererrow_with_ref_urls.COLOR}" align="center" nowrap="nowrap"><span class="gensmall"><a onclick="return (confirm('{L_CONFIRM_DELETE_REFERER}'));" href="{refererrow_with_ref_urls.U_DELETE}">{L_DELETE}</a></span></td>
	</tr>
	<!-- END refererrow_with_ref_urls -->
	<!-- BEGIN refererrow -->
	<tr>
		<td class="{refererrow.COLOR}" nowrap="nowrap"><span class="gensmall"><a href="{refererrow.U_REFERER}" target="_blank">{refererrow.REFERER}</a></span></td>
		<td class="{refererrow.COLOR}" align="center" nowrap="nowrap"><span class="gensmall">{refererrow.HITS}</span></td>
		<td class="{refererrow.COLOR}" align="center" nowrap="nowrap"><span class="gensmall">{refererrow.FIRSTVISIT}</span></td>
		<td class="{refererrow.COLOR}" align="center" nowrap="nowrap"><span class="gensmall">{refererrow.LASTVISIT}</span></td>
		<td class="{refererrow.COLOR}" align="center" nowrap="nowrap"><span class="gensmall"><a onclick="return (confirm('{L_CONFIRM_DELETE_REFERER}'));" href="{refererrow.U_DELETE}">{L_DELETE}</a></span></td>
	</tr>
	<!-- END refererrow -->
	<tr>
		<td class="catBottom" colspan="7" align="center"><input type="submit" onclick="return (confirm('{L_CONFIRM_DELETE_REFERERS}'));" value="{L_DELETE_ALL}" name="delete" class="liteoption"></td>
	</tr>
</table>

<table width="95%" cellspacing="2" cellpadding="2" align="center">
	<tr>
		<td valign="middle" nowrap="nowrap" class="nav">{PAGE_NUMBER}</td>
		<td align="right" valign="middle" class="nav">{PAGINATION}</td>
	</tr>
</form>
</table>
<br />