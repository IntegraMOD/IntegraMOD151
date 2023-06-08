<table width="100%" cellpadding="0" cellspacing="0" border="0">
<!-- BEGIN no_pics -->
<tr>
	<td align="center" height="50"><span class="gen">{L_NO_PICS}</span></td>
</tr>
<!-- END no_pics -->
<!-- BEGIN recent_pics -->
<!-- BEGIN recent_detail -->
<tr>
	<td width="{S_COL_WIDTH}" align="center"><a href="{recent_pics.recent_detail.U_PIC}" {TARGET_BLANK}><img src="{recent_pics.recent_detail.THUMBNAIL}" border="0" alt="{recent_pics.recent_detail.DESC}" title="{recent_pics.recent_detail.DESC}" vspace="10" /></a></td>
</tr>
<tr>
	<td>
		<table width="100%" cellpadding="5" cellspacing="0" border="0"><tr><td>
		<span class="gensmall">{L_PIC_TITLE}: {recent_pics.recent_detail.TITLE}<br />
		{L_POSTER}: {recent_pics.recent_detail.POSTER}<br />{L_POSTED}: {recent_pics.recent_detail.TIME}<br />
		{L_VIEW}: {recent_pics.recent_detail.VIEW}<br />{recent_pics.recent_detail.RATING}{recent_pics.recent_detail.COMMENTS}<br /></span>
		</td></tr></table>
	</td>
</tr>
<!-- END recent_detail -->
<!-- END recent_pics -->
<tr>
	<td height="25" align="center"><span class="gensmall">[ <a href="{U_ALBUM}">{L_ALBUM}</a> ]</span></td>
</tr>
</table>