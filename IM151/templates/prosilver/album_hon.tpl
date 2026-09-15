<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td class="nav" width="100%">
			<span class="nav">
				<a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEP}
				<a class="nav" href="{U_ALBUM}">{L_ALBUM}</a>
			</span>
		</td>
	</tr>
</table>
<br />
<form action="album_hotornot.php">
	<input type="hidden" name="pic_id" value="{PICTURE_ID}" />
	<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
		<!-- BEGIN hon_rating -->
		<tr>
			<td align="center" class="row2">
				<span class="genmed">
				{L_PLEASE_RATE_IT}:&nbsp;&nbsp;&nbsp;
				<!-- BEGIN hon_row -->
				<input type="radio" name="hon_rating" value="{hon_rating.hon_row.VALUE}" onclick="this.form.submit()">&nbsp;{hon_rating.hon_row.VALUE}&nbsp;&nbsp;
				<!-- END hon_row -->
				</span>
			</td>
		</tr>
		<!-- END hon_rating -->
		<!-- BEGIN hon_rating_cant -->
		<tr>
			<td align="center" class="row2">
				<span class="genmed">{L_ALREADY_RATED}</span>
			</td>
		</tr>
		<!-- END hon_rating_cant -->
	</table>
</form>

<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr><th class="thTop" width="10%">{PIC_TITLE}</th></tr>
	<tr><td class="row1" align="center"><img src="{U_PIC}" border="0" vspace="10" alt="{PIC_TITLE}" title="{PIC_TITLE}" /></td></tr>
	<tr>
		<td class="row2" align="center">
			<table width="100%" align="center" border="0" cellpadding="3" cellspacing="2">
				<tr>
					<td width="25%" align="right"><span class="genmed">{L_POSTER}:</span></td>
					<td><span class="genmed"><b>{POSTER}</b></span></td>
				</tr>
				<tr>
					<td valign="top" align="right"><span class="genmed">{L_PIC_TITLE}:</span></td>
					<td valign="top"><b><span class="genmed">{PIC_TITLE}</span></b></td>
				</tr>
				<tr>
					<td valign="top" align="right"><span class="genmed">{L_PIC_ID}:</span></td>
					<td valign="top"><b><span class="genmed">{PIC_ID}</span></b></td>
				</tr>
				<tr>
					<td valign="top" align="right"><span class="genmed">{L_PIC_DESC}:</span></td>
					<td valign="top"><b><span class="genmed">{PIC_DESC}</span></b></td>
				</tr>
				<tr>
					<td align="right"><span class="genmed">{L_POSTED}:</span></td>
					<td><b><span class="genmed">{PIC_TIME}</span></b></td>
				</tr>
				<tr>
					<td align="right"><span class="genmed">{L_VIEW}:</span></td>
					<td><b><span class="genmed">{PIC_VIEW}</span></b></td>
				</tr>
				<!-- BEGIN rate_switch -->
				<tr>
					<td valign="top" align="right"><span class="genmed">{L_RATING}:</span></td>
					<td><b><span class="genmed">{PIC_RATING}</span></b></td>
				</tr>
				<!-- END rate_switch -->
				<!-- BEGIN comment_switch -->
				<tr>
					<td align="right"><span class="genmed"><a href="{U_COMMENT}">{L_COMMENTS}:</a></span></td>
					<td><b><span class="genmed">{PIC_COMMENTS}</span></b></td>
				</tr>
				<!-- END comment_switch -->
			</table>
		</td>
	</tr>
</table>
<br />
<!-- You must keep my copyright notice visible with its original content -->
{ALBUM_COPYRIGHT}
