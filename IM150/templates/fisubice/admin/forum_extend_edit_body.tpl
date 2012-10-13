<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form method="post" name="edit" action="{S_ACTION}">
<table width="100%" cellpadding="2" cellspacing="0" border="0" align="center">
<tr>
	<td><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_CAT_DESC}</span></td>
</tr>
</table>

<table width="99%" cellpadding="0" cellspacing="0" border="0" align="center" class="forumline">
<tr>
	<td width="100%">
		<table width="100%" cellpadding="4" cellspacing="1" border="0" align="center">
		<tr>
			<th colspan="2" width="70%">{L_TITLE}</th>
		</tr>
		<tr>
			<td class="row1" width="40%"><span class="gen">{L_TYPE}</span></td>
			<td class="row2" width="60%"><span class="gen">&nbsp;<select name="type" onchange="this.form.submit();">{S_TYPE_OPT}</select></span></td>
		</tr>
		<tr>
			<td class="row1"><span class="gen">{L_NAME}</span></td>
			<td class="row2"><span class="gen">&nbsp;<input name="name" value="{NAME}" type="text" class="post" size="60" /></span></td>
		</tr>
		<tr>
			<td class="row1"><span class="gen">{L_DESC}</span></td>
			<td class="row2"><span class="gen">&nbsp;<textarea name="desc" rows="5" cols="60" class="post">{DESC}</textarea></span></td>
		</tr>
		<tr>
			<td class="row1"><span class="gen">{L_MAIN}</span></td>
			<td class="row2"><span class="gen">&nbsp;<select name="main" onchange="this.form.submit();">{S_FORUMS_OPT}</select></span></td>
		</tr>
		<tr>
			<td class="row1"><span class="gen">{L_ICON}</span><span class="gensmall"><br />{L_ICON_EXPLAIN}</span></td>
			<td class="row2"><span class="gen">&nbsp;<input name="icon" value="{ICON}" type="text" class="post" size="60" />{ICON_IMG}</span></td>
		</tr>
		<tr>
			<td class="row1"><span class="gen">{L_POSITION}</span></td>
			<td class="row2"><span class="gen">&nbsp;<select name="position">{S_POS_OPT}</select></span></td>
		</tr>
		<!-- BEGIN forum -->
		<tr>
			<td class="row1"><span class="gen">{L_STATUS}</span></td>
			<td class="row2"><span class="gen">&nbsp;<select name="status">{S_STATUS_OPT}</select></span></td>
		</tr>
		<!-- BEGIN topic_display_order -->
		<tr>
			<td class="row1"><span class="gen">{L_FORUM_DISPLAY_SORT}</span></td>
			<td class="row2"><span class="gen">&nbsp;<select name="forum_display_sort">{S_FORUM_DISPLAY_SORT_LIST}</select>&nbsp;<select name="forum_display_order">{S_FORUM_DISPLAY_ORDER_LIST}</select></span></td>
		</tr>
		<!-- END topic_display_order -->
		<!-- END forum -->
		<!-- BEGIN move -->
		<tr>
			<td class="row1"><span class="gen">{L_MOVE}</span></td>
			<td class="row2"><span class="gen">&nbsp;<select name="move">{S_MOVE_OPT}</select></span></td>
		</tr>
		<!-- END move -->
		<!-- BEGIN forum -->
		<tr>
			<td class="cat" colspan="2">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr>
					<td width="100%"><span class="cattitle">{L_PRUNE_ENABLE}</span></td>
					<td nowrap="nowrap">
						<span class="genmed">
							<b>{L_ENABLED}:&nbsp;</b>
							<input name="prune_enable" type="radio" value="0" {PRUNE_ENABLE_NO} onClick="if (this.form.prune_enable.checked=true) {document.all.prune_display.style.display='none'} else {document.all.prune_display.style.display=''}" />
							{L_NO}&nbsp;&nbsp;
							<input name="prune_enable" type="radio" value="1" {PRUNE_ENABLE_YES} onClick="if (this.form.prune_enable.checked=false) {document.all.prune_display.style.display='none'} else {document.all.prune_display.style.display=''}" />
							{L_YES}
						</span>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tbody id="prune_display" style="display:{PRUNE_DISPLAY}">
		<tr>
			<td class="row1" align="right"><span class="gen">{L_PRUNE_DAYS}</span></td>
			<td class="row2"><span class="gen">&nbsp;<input name="prune_days" type="text" class="post" value="{PRUNE_DAYS}" size="3" />&nbsp;{L_DAYS}</span></td>
		</tr>
		<tr>
			<td class="row1" align="right"><span class="gen">{L_PRUNE_FREQ}</span></td>
			<td class="row2"><span class="gen">&nbsp;<input name="prune_freq" type="text" class="post" value="{PRUNE_FREQ}" size="3" />&nbsp;{L_DAYS}</span></td>
		</tr>
		</tbody>
		<!-- END forum -->
		<!-- BEGIN link -->
		<tr>
			<td class="cat" colspan="2"><span class="cattitle">{L_LINK}</span></td>
		</tr>
		<tr>
			<td class="row1"><span class="gen">{L_FORUM_LINK}</span><span class="gensmall"><br />{L_FORUM_LINK_EXPLAIN}</span></td>
			<td class="row2"><span class="gen">&nbsp;<input name="link" type="text" class="post" value="{FORUM_LINK}" size="60" /></span></td>
		</tr>
		<tr>
			<td class="row1"><span class="gen">{L_FORUM_LINK_INTERNAL}</span><span class="gensmall"><br />{L_FORUM_LINK_INTERNAL_EXPLAIN}</span></td>
			<td class="row2"><span class="gen"><input name="link_internal" type="radio" value="1" {LINK_INTERNAL_YES} />{L_YES}&nbsp;&nbsp;<input name="link_internal" type="radio" value="0" {LINK_INTERNAL_NO} />{L_NO}</span></td>
		</tr>
		<tr>
			<td class="row1"><span class="gen">{L_FORUM_LINK_HIT_COUNT}</span><span class="gensmall"><br />{L_FORUM_LINK_HIT_COUNT_EXPLAIN}</span></td>
			<td class="row2"><span class="gen"><input name="link_hit_count" type="radio" value="1" {LINK_COUNT_YES} />{L_YES}&nbsp;&nbsp;<input name="link_hit_count" type="radio" value="0" {LINK_COUNT_NO} />{L_NO}</span></td>
		</tr>
		<!-- END link -->
		</table>
	</td>
</tr>
<!-- BEGIN forum_link -->
<tr>
	<td width="100%">
		<table width="100%" cellpadding="4" cellspacing="1" border="0" align="center">
		<tr>
			<td class="cat" colspan="{AUTH_SPAN}">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr>
					<td align="left" width="100%"><span class="cattitle">{L_AUTH}</span></td>
					<!-- BEGIN no_link -->
					<td align="right" nowrap="nowrap">
						<span class="genmed"><input type="hidden" name="preset_choice" value="0" />
							&nbsp;<b>{L_PRESET}:&nbsp;</b>
							<select name="forum_preset" onChange="this.form.preset_choice.value=1; this.form.submit();">{S_PRESET_OPT}</select>
						</span>
					</td>
					<!-- END no_link -->
				</tr>
				</table>
			</td>
		</tr>
		<!-- BEGIN auth -->
		<tr>
			<!-- BEGIN cell -->
			<td width="25%" class="{forum_link.auth.cell.COLOR}" align="center">
				<table cellpadding="2" cellspacing="0" border="0" width="100%">
				<tr>
					<td align="right" width="50%"><span class="genmed">{forum_link.auth.cell.L_AUTH}:</span></td>
					<td align="left" nowrap="nowrap"><select name="{forum_link.auth.cell.AUTH}">{forum_link.auth.cell.S_AUTH_OPT}</select></td>
				</tr>
				</table>
			</td>
			<!-- END cell -->
			<!-- BEGIN empty -->
			<td class="row3" colspan="{forum_link.auth.empty.SPAN}"><span class="genmed">&nbsp;</span></td>
			<!-- END empty -->
		</tr>
		<!-- END auth -->
		</table>
	</td>
</tr>
<!-- END forum_link -->
<tr>
	<td class="cat" align="center">{S_HIDDEN_FIELDS}
		<span class="cattitle">
			<input type="submit" name="update" value="{L_SUBMIT}" class="mainoption" />&nbsp;
			<input type="submit" name="cancel" value="{L_CANCEL}" class="liteoption" />&nbsp;
			<input type="submit" name="refresh" value="{L_REFRESH}" class="liteoption" />&nbsp;
		</span>
	</td>
</tr>
</table></form>