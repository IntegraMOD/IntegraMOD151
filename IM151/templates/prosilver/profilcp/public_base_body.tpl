<table cellpadding="0" cellspacing="10" border="0" width="100%">
<tr>
	<td valign="top" align="center">
		<table cellpadding="2" cellspacing="1" border="0" class="forumline" width="100%">
		<tr>
			<th valign="middle">{L_PUBLIC_TITLE}</th>
		</tr>
		<tr>
			<td class="row3" valign="top">
				<table cellpadding="2" cellspacing="4" border="0" width="100%">
				<tr>
					<!-- BEGIN col -->
					<td valign="top">
						<!-- BEGIN panel -->
						<!-- BEGIN linefeed -->
						<br style="font-size: 4 px;" />
						<!-- END linefeed -->
						<table cellpadding="4" cellspacing="0" border="0" class="bodyline" width="100%">
						<tr>
							<td class="cat" align="center" colspan="{col.panel.SPAN}"><span class="cattitle">{col.panel.TITLE}</span></td>
						</tr>
						<!-- BEGIN row -->
						<tr>
							<!-- BEGIN linefeed -->
							<td class="row2" colspan="{col.panel.SPAN}"><span style="font-size: 2px">&nbsp;</span></td>
							<!-- END linefeed -->
							<!-- BEGIN cell -->
							<td class="{col.panel.row.cell.CLASS}" align="{col.panel.row.cell.ALIGN}" width="{col.panel.row.cell.WIDTH}" {col.panel.row.cell.WRAP}><span class="gen">{col.panel.row.cell.VALUE}</span></td>
							<!-- END cell -->
							<!-- BEGIN cellfeed -->
							<td class="row2"></td>
							<!-- END cellfeed -->
						</tr>
						<!-- END row -->
						</table>
						<!-- END panel -->
					</td>
					<!-- END col -->
				</tr>
<!-- BEGIN recent_pics_block -->
<br />
<table cellpadding="4" cellspacing="0" border="0" class="bodyline" width="100%">
	<tr>
		<td class="cat" align="center" colspan="{S_COLS}"><span class="cattitle">{L_RECENT_PUBLIC_PICS}</span></td>
	</tr>
	<!-- BEGIN no_pics -->
	<tr>
		<td class="row1" align="center" colspan="{S_COLS}" height="50"><span class="gen">{L_NO_PICS}</span></td>
	</tr>
	<!-- END no_pics -->
	<!-- BEGIN recent_pics -->
	<tr>
		<!-- BEGIN recent_col -->
		<td class="row1" width="{S_COL_WIDTH}" align="center">
			<a href="{recent_pics_block.recent_pics.recent_col.U_PIC}" {}><img src="{recent_pics_block.recent_pics.recent_col.THUMBNAIL}" border="0" alt="{recent_pics_block.recent_pics.recent_col.DESC}" title="{recent_pics_block.recent_pics.recent_col.DESC}" vspace="10" /></a>
		</td>
		<!-- END recent_col -->
	</tr>
	<tr>
		<!-- BEGIN recent_detail -->
		<td class="row2" align="center">
			<span class="gensmall">
				{L_PIC_TITLE}: {recent_pics_block.recent_pics.recent_detail.TITLE}<br />
				{L_POSTER}: {recent_pics_block.recent_pics.recent_detail.POSTER}<br />
				{L_POSTED}: {recent_pics_block.recent_pics.recent_detail.TIME}<br />
				{L_VIEW}: {recent_pics_block.recent_pics.recent_detail.VIEW}<br />
			</span>
		</td>
		<!-- END recent_detail -->
	</tr>
	<!-- END recent_pics -->
</table>
<br />
<!-- END recent_pics_block -->
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>