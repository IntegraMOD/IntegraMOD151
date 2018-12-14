<h1>{L_TITLE}</h1>
<form method="post" name="color" action="{S_ACTION}">
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="forumline" align="center">
	<tr>
		<th class="thHead" colspan="3">{L_EDIT}</th>
	</tr>
	<tr>
		<td class="row1" colspan="2" width="38%"><span class="gen">{L_TIME}</span><br /><span class="gensmall">{L_TIME_EXPLAIN}</span></td>
		<td class="row2" width="62%"><span class="gensmall"><input class="post" type="text" name="agcm_time" maxlength="6" size="20" value="{TIME}" />&nbsp;{S_VALUE}</span></td>
	</tr>
	<tr>
		<td class="row1" colspan="2" width="38%"><span class="gen">{L_CHECK}</span><br /><span class="gensmall">{L_CHECK_EXPLAIN}</span></td>
		<td class="row2" width="62%"><span class="gensmall"><input type="radio" name="agcm_check" value="{FALSE}"{S_CHECK_NO} /> {L_NO} &nbsp;&nbsp;<input type="radio" name="agcm_check" value="{TRUE}"{S_CHECK_YES} /> {L_YES}</span></td>
	</tr>
	<!-- BEGIN group_color_edit -->
	<tr>
		<th class="thHead" colspan="3">
			{group_color_edit.GROUP_NAME}
		</th>
	</tr>
	<tr>
		<td class="row1" rowspan="4"><span class="gen">&nbsp;
			<!-- BEGIN up -->
			<a href="{group_color_edit.U_WEIGHT_UP}" class="gen"><img src="{I_UP}" title="{L_UP}" alt="{L_UP}" border="0" /></a><br /><br />
			<!-- END up -->
			<!-- BEGIN down -->
			<a href="{group_color_edit.U_WEIGHT_DOWN}" class="gen"><img src="{I_DOWN}" title="{L_DOWN}" alt="{L_DOWN}" border="0" /></a>
			<!-- END down -->
		</span></td>
		<td class="row1" width="38%"><span class="gen">{L_COLOR}</span><br /><span class="gensmall">{L_COLOR_EXPLAIN}</span></td>
		<td class="row2" width="62%"><span class="gensmall"><input class="post" type="text" name="color_code{group_color_edit.ID}" maxlength="6" size="20" value="{group_color_edit.GROUP_COLOR}" /> &nbsp; <a href="javascript:TCP.popup(document.forms['color'].elements['color_code{group_color_edit.ID}'], '1', '{U_SEARCH_COLOR}')" class="gen">{L_FIND_COLOR}</a></span></td>
	</tr>
	<tr>
		<td class="row1" width="38%"><span class="gen">{L_LEGEND}</span></td>
		<td class="row2" width="62%"><span class="gensmall">
			<input type="radio" name="legend{group_color_edit.ID}" value="{FALSE}"{group_color_edit.S_LEGEND_NO} /> {L_NO} &nbsp;&nbsp;<input type="radio" name="legend{group_color_edit.ID}" value="{TRUE}"{group_color_edit.S_LEGEND_YES} /> {L_YES}<br />
		</span></td>
	</tr>
	<tr>
		<td class="row1" width="38%"><span class="gen">{L_STYLE_EXPLAIN}</span></td>
		<td class="row2" width="62%"><span class="gensmall">
			{L_BOLD} <input type="checkbox" name="bold{group_color_edit.ID}"{group_color_edit.BOLD} />&nbsp;&nbsp;
			{L_ITALIC} <input type="checkbox" name="italic{group_color_edit.ID}"{group_color_edit.ITALIC} />&nbsp;&nbsp;
			{L_UNDERLINE} <input type="checkbox" name="underline{group_color_edit.ID}"{group_color_edit.UNDERLINE} />
		</span></td>
	</tr>
	<tr>
		<td class="row1" width="38%"><span class="gen">{L_HOVER_STYLE_EXPLAIN}</span></td>
		<td class="row2" width="62%"><span class="gensmall">
			{L_BOLD} <input type="checkbox" name="hover_bold{group_color_edit.ID}"{group_color_edit.HOVER_BOLD} />&nbsp;&nbsp;
			{L_ITALIC} <input type="checkbox" name="hover_italic{group_color_edit.ID}"{group_color_edit.HOVER_ITALIC} />&nbsp;&nbsp;
			{L_UNDERLINE} <input type="checkbox" name="hover_underline{group_color_edit.ID}"{group_color_edit.HOVER_UNDERLINE} />
		</span></td>
	</tr>
	<!-- END group_color_edit -->
	<tr>
		<td class="catBottom" colspan="3" align="center"><span class="cattitle"><input type="submit" name="color_update" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp; <input type="reset" value="{L_RESET}" name="reset" class="liteoption" /></span></td>
	</tr>
</table>
{S_HIDDEN_FIELDS}
</form>