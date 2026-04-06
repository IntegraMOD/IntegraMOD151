<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td class="nav">
			<span class="nav">
				<a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEP}
				<a href="{U_ALBUM}" class="nav">{L_ALBUM}</a>
			</span>
		</td>
		<td align="right">
			&nbsp;
		</td>
	</tr>
</table>

<form action="{S_ACTION}" method="post">
<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr><th class="thHead" colspan="{S_COLSPAN}" height="25" valign="middle">{L_PIC_GALLERY}</th></tr>
	<tr>
		<td class="catBottom" align="center" valign="middle" colspan="6" height="28">
			<span class="genmed">
				{L_CATEGORY}:&nbsp;{S_CATEGORY_SELECT}&nbsp;
				<input type="submit" class="liteoption" value="{L_GO}" name="pic_gallery" />
			</span>
		</td>
	</tr>
	<!-- BEGIN pic_row -->
	<tr>
	<!-- BEGIN pic_column -->
		<td class="row1" align="center" onMouseOver="this.className='row2';" onMouseOut="this.className='row1';">
			<table><tr><td><div class="picshadow"><div class="picframe">
				<a href="{pic_row.pic_column.PIC_IMAGE}"><img src="{pic_row.pic_column.PIC_THUMB}" alt="{pic_row.pic_column.PIC_NAME}" title="{pic_row.pic_column.PIC_NAME}" border="0" /></a>
			</div></div></td></tr></table>
			<br />
			<span class="genmed"><b>{pic_row.pic_column.PIC_NAME}</b></span>
		</td>
	<!-- END pic_column -->
	</tr>
	<tr>
	<!-- BEGIN pic_option_column -->
		<!-- <td class="row2" align="center"><input type="radio" name="pic_select" value="{pic_row.pic_option_column.S_OPTIONS_PIC}" /></td> -->
	<!-- END pic_option_column -->
	</tr>

	<!-- END pic_row -->
	<tr>
		<td class="catBottom" colspan="{S_COLSPAN}" align="center" height="28">
			&nbsp;&nbsp;
		</td>
	</tr>
</table>
</form>

<br />
<!-- You must keep my copyright notice visible with its original content -->
{ALBUM_COPYRIGHT}
