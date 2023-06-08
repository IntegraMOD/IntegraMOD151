	<!-- The button that is shown when the column is closed -->
	<!-- BEGIN layout_collapse -->
	<td id="header_hide" style="display: none;" valign="top" align="left" width="10" height="18"><a href="JavaScript:ShowHide('header_block','header_hide','header_block');"><img src="{layout_collapse.LAYOUT_IMAGER}" width="10" height="18" alt="" border="0" /></a></td>
	<!-- END layout_collapse -->
	<!-- The spacer image that replaces the above button when the collapsible layout is turned off -->
	<!-- BEGIN no_layout_collapse -->
	<td width="10"><img src="{no_layout_collapse.SPACER}" alt="" width="10" height="30" /></td>
	<!-- END no_layout_collapse -->
	<!-- The td cell that closes when the collapse column button is clicked -->

<td id="header_block"  class="leftcolumn" width="{HEADER_WIDTH}" valign="top" style="display: '';">
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td valign="top">
				<!-- The start of the header block -->
				<!-- BEGIN header_blocks_row -->
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<!-- Shown when the title is text -->
					<!-- BEGIN title -->
					<tr>
		              <td align="left">&nbsp;&nbsp;<img src="{TEMPLATE}images/icon_right_arrow.gif" width="9" height="9" border="0" alt="" /><font color="blue"><b>&nbsp;&nbsp;&nbsp;{header_blocks_row.title.TITLE}</b></font></td>
					</tr>
					<!-- END title -->

					<!-- Shown when the title is an image -->
					<!-- BEGIN title_image -->
					<tr>
						<td style="text-align:right;"><img src="{header_blocks_row.title_image.TITLE}" /></td>
					</tr>
					<!-- END title_image -->
					<tr>
						<td
						<!-- BEGIN background -->
						class="row1"
						<!-- END background -->
						>
							<!-- BEGIN openclose -->
							<div onclick="ShowHide('block1_{header_blocks_row.BLOCKID}','block2_{header_blocks_row.BLOCKID}','block1_{header_blocks_row.BLOCKID}');" style="display: none; width:100%; cursor: pointer; cursor: hand;" id="block2_{header_blocks_row.BLOCKID}" align="center"><img src="{header_blocks_row.openclose.OPEN_IMG}" title="OPEN" /></div>
							<!-- END openclose -->
							<div id="block1_{header_blocks_row.BLOCKID}" style="display: ''; position: relative;" align="center">{header_blocks_row.OUTPUT}
								<!-- BEGIN openclose -->
								<div onclick="ShowHide('block1_{header_blocks_row.BLOCKID}','block2_{header_blocks_row.BLOCKID}','block1_{header_blocks_row.BLOCKID}');" style="width:100%; cursor: pointer; cursor: hand;"><img src="{header_blocks_row.openclose.CLOSE_IMG}" title="CLOSE" /></div>
								<!-- END openclose -->
							</div>
						</td>
					</tr>
		<!-- BEGIN border -->
	    <tr>
		  <td><img src="{TEMPLATE}images/block_bot.gif" width="180" height="22" border="0" alt="" /></td>
        </tr>
        <!-- END border -->					
				</table>
<br />

<!-- The cookie related javascript to remember what blocks are open/closed on page load -->
<!-- BEGIN openclose -->
<script>
tmp = 'block1_{header_blocks_row.BLOCKID}';
if(GetCookie(tmp) == '2')
{
	ShowHide('block1_{header_blocks_row.BLOCKID}','block2_{header_blocks_row.BLOCKID}','block1_{header_blocks_row.BLOCKID}');
}
</script>
<!-- END openclose -->
<!-- END header_blocks_row -->

			</td>

			<!-- BEGIN layout_collapse -->
			<td valign="top" style="display: block; cursor: pointer; cursor: hand;" align="left" width="10" height="18"><a href="JavaScript:ShowHide('header_block','header_hide','header_block');"><img src="{layout_collapse.LAYOUT_IMAGEL}" alt="" width="10" height="18" border="0" /></a></td>
			<!-- END layout_collapse -->
		</tr>

	</table>

</td>

<!-- The spacer image that replaces the above button when the collapsible layout is turned off -->

<!-- BEGIN no_layout_collapse -->
<td width="10"><img src="{no_layout_collapse.SPACER}" alt="" width="10" height="30" /></td>
<!-- END no_layout_collapse -->


<!-- The cookie related javascript to remember what columns are open/closed on page load -->
<script>
<!--
tmp = 'header_block';
if(GetCookie(tmp) == '2')
{
	ShowHide('header_block','header_hide','header_block');
}
//-->
</script>