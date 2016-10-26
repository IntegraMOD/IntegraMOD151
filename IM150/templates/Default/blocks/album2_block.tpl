<table width="100%" cellpadding="0" cellspacing="0" border="0">
<!-- BEGIN no_pics -->
<tr>
	<td class="row1" align="center" height="50"><span class="gen">{L_NO_PICS2}</span></td>
</tr>
<!-- END no_pics -->
<!-- BEGIN recent_pics2 -->
<tr>
<!-- BEGIN recent_detail -->
	<td class="row1" width="{S_COL_WIDTH}" align="center"><a href="{recent_pics2.recent_detail.U_PIC}" {TARGET_BLANK}><img src="{recent_pics2.recent_detail.THUMBNAIL}" border="0" alt="{recent_pics2.recent_detail.DESC}" title="{recent_pics2.recent_detail.DESC}" vspace="10" /></a></td>
<!-- END recent_detail -->
</tr>
<tr>
<!-- BEGIN recent_detail2 -->
	<td class="row2">
		<table width="100%" cellpadding="5" cellspacing="0" border="0"><tr><td>
		<span class="gensmall">{L_PIC_TITLE}: {recent_pics2.recent_detail2.TITLE}<br />
		{L_POSTER}: {recent_pics2.recent_detail2.POSTER}<br />{L_POSTED}: {recent_pics2.recent_detail2.TIME}<br />
		{L_VIEW}: {recent_pics2.recent_detail2.VIEW}<br />{recent_pics2.recent_detail2.RATING}{recent_pics2.recent_detail2.COMMENTS}</span>
		</td></tr></table>
	</td>
<!-- END recent_detail2 -->
</tr>
<!-- END recent_pics2 -->
<tr>
	<td class="row3" height="25" align="center" colspan="{L_PICS_NUMBER}"><span class="gensmall">[ <a href="{U_ALBUM}">{L_ALBUM}</a> ]</span></td>
</tr>
</table>