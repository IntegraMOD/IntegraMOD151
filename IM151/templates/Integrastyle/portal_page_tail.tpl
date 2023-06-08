<td width="10"><img src="{TEMPLATE}images/spacer.gif" alt="" width="10" /></td>
<td width="{FOOTER_WIDTH}" valign="top">

<!-- BEGIN tail_blocks_row -->
<table width="100%" cellpadding="5" cellspacing="0" border="0" >

	<tr>
		<td><img src="{TEMPLATE}images/icon_right_arrow.gif" width="9" height="9" border="0" alt="" /></td>
	<!-- BEGIN title -->
		<td align="left" width="100%"><font color="blue"><b>{tail_blocks_row.title.TITLE}</b></font></td>
	<!-- END title -->
	<!-- BEGIN openclose -->
		<td><a class="openclose" href="javascript:ShowHide('block1_{tail_blocks_row.BLOCKID}','block2_{tail_blocks_row.BLOCKID}','block3_{tail_blocks_row.BLOCKID}');">&nbsp;</a></td>
	<!-- END openclose -->
	</tr>

	<tr>
	        <td colspan="2">
			<table width="100%" cellpadding="0" cellspacing="0" border="0" >
			<tr>
			<td width="10"><img src="{TEMPLATE}images/spacer.gif" alt="" width="10" /></td>
			<td width="100%"><div id="block1_{tail_blocks_row.BLOCKID}" style="position: relative;">{tail_blocks_row.OUTPUT}</div></td>
			</tr>
			</table>
		</td>
	</tr>
</table>
<!-- BEGIN border -->
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td><img src="{TEMPLATE}images/block_bot.gif" width="180" height="22" border="0" alt="" /></td>
</tr>
</table>
<!-- END border -->
<br />
<script type="text/javascript">
<!--
tmp = 'block3_{tail_blocks_row.BLOCKID}';
if(GetCookie(tmp) == '2')
{
	ShowHide('block1_{tail_blocks_row.BLOCKID}','block2_{tail_blocks_row.BLOCKID}','block3_{tail_blocks_row.BLOCKID}');
}
//-->
</script>
<!-- END tail_blocks_row -->

</td>