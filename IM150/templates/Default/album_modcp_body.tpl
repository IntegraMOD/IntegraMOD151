<script>
<!--
//--- Album Category Hierarchy : begin
//--- version : 1.2.0
// tested with IE4+ and FireFox 0.8+
function checkBox(field)
{
	checkBoxes = field.form["pic_id[]"];
	checkButton = field.form["checkButton"];

	for (i = 0; i < checkBoxes.length; i++)
	{
		checkBoxes[i].checked = (checkButton.value == "{L_CHECK_ALL}") ? true : false;
	}
	return (checkButton.value == "{L_CHECK_ALL}") ? "{L_UNCHECK_ALL}" : "{L_CHECK_ALL}";
}

function checkBoxInverse(field)
{
	checkBoxes = field.form["pic_id[]"];

	for (i = 0; i < checkBoxes.length; i++)
	{
		checkBoxes[i].checked = (checkBoxes[i].checked) ? false : true;
	}
}
//--- Album Category Hierarchy : begin
// -->
</script>
<form name="modcp" action="{S_ALBUM_ACTION}" method="post">
<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
	<td width="100%"><a class="maintitle" href="{U_VIEW_CAT}">{CAT_TITLE}</a></td>
	<td align="right" valign="bottom" nowrap="nowrap"><span class="gensmall"><b>{PAGINATION}&nbsp;</b></span></td>
	</tr>
	<tr>
		<td class="nav">
			<span class="nav">
				<a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEP}
				<a class="nav" href="{U_ALBUM}">{L_ALBUM}</a>
			</span>
		</td>
		<td align="right" nowrap="nowrap">
			<span class="gensmall">
				{L_SELECT_SORT_METHOD}:
				<select name="sort_method">
					<option {SORT_TIME} value='pic_time'>{L_TIME}</option>
					<option {SORT_PIC_TITLE} value='pic_title'>{L_PIC_TITLE}</option>
					{SORT_USERNAME_OPTION}
					<option {SORT_VIEW} value='pic_view_count'>{L_VIEW}</option>
					{SORT_RATING_OPTION}
					{SORT_COMMENTS_OPTION}
					{SORT_NEW_COMMENT_OPTION}
				</select>
				&nbsp;{L_ORDER}:
				<select name="sort_order">
					<option {SORT_ASC} value='ASC'>{L_ASC}</option>
					<option {SORT_DESC} value='DESC'>{L_DESC}</option>
				</select>
				&nbsp;<input type="submit" name="submit" value="{L_SORT}" class="liteoption" />
			</span>
		</td>
	</tr>
</table>

<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr><th class="catLeft" height="25" align="center" colspan="6"><span class="cattitle">{L_MODCP}&nbsp;</span></th>	</tr>
	<tr>
		<th class="thCornerL" height="25" nowrap="nowrap">&nbsp;{L_PIC_TITLE}&nbsp;</th>
		<th width="5%" class="thTop" nowrap="nowrap">&nbsp;{L_RATING}&nbsp;</th>
		<th width="5%" class="thTop" nowrap="nowrap">&nbsp;{L_COMMENTS}&nbsp;</th>
		<th width="5%" class="thTop" nowrap="nowrap">&nbsp;{L_STATUS}&nbsp;</th>
		<th width="5%" class="thTop" nowrap="nowrap">&nbsp;{L_APPROVAL}&nbsp;</th>
		<th width="5%" class="thCornerR" nowrap="nowrap">&nbsp;{L_SELECT}&nbsp;</th>
	</tr>
	<!-- BEGIN no_pics -->
	<tr><td class="row1" align="center" colspan="6" height="50"><span class="gen">{L_NO_PICS}</span></td></tr>
	<!-- END no_pics -->
	<!-- BEGIN picrow -->
	<tr>
		<td class="row1" height="25">
			<span class="genmed">
				{L_POSTER}: {picrow.POSTER}<br />
				{L_PIC_TITLE}: {picrow.PIC_TITLE}<br />
				{L_PIC_ID}: {picrow.PIC_ID}<br />
				{L_TIME}: {picrow.TIME}
			</span>
		</td>
		<td align="center" class="row2"><span class="genmed">{picrow.RATING}</span></td>
		<td align="center" class="row2"><span class="genmed">{picrow.COMMENTS}</span></td>
		<td align="center" class="row2"><span class="genmed">{picrow.LOCK}&nbsp;</span></td>
		<td align="center" class="row2"><span class="genmed">{picrow.APPROVAL}</span></td>
		<td align="center" class="row3"><span class="genmed"><input type="checkbox" name="pic_id[]" value="{picrow.PIC_ID}" /></span></td>
	</tr>
	<!-- END picrow -->
	<tr>
		<td class="catbottom" colspan="6" align="right" height="28">
			<input type="hidden" name="mode" value="modcp" />
			<input type="submit" class="liteoption" name="move" value="{L_MOVE}" />
			<input type="submit" class="liteoption" name="lock" value="{L_LOCK}" />
			<input type="submit" class="liteoption" name="unlock" value="{L_UNLOCK}" />
			{DELETE_BUTTON}
			{APPROVAL_BUTTON}
			{UNAPPROVAL_BUTTON}
			&nbsp;&nbsp;
			<input type="button" class="liteoption" name="checkButton" value="{L_CHECK_ALL}" onClick="this.value=checkBox(this)">
			<input type="button" class="liteoption" name="inverseButton" value="{L_INVERSE_SELECTION}" onClick="checkBoxInverse(this)">
		</td>
	</tr>
</table>

<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td align="right" nowrap="nowrap">
			<span class="gensmall">{S_TIMEZONE}&nbsp;</span><br />
			<span class="nav">{PAGINATION}&nbsp;</span>
		</td>
	</tr>
	<tr><td colspan="3"><span class="nav">{PAGE_NUMBER}</span></td></tr>
</table>
</form>
<br />
<!-- You must keep my copyright notice visible with its original content -->
{ALBUM_COPYRIGHT}
