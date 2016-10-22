<td width="10"><img src="images/spacer.gif" alt="" width="10" height="30" /></td>
<td width="{HEADER_WIDTH}" valign="top">

<!-- BEGIN header_blocks_row -->

<table width="100%" cellpadding="2" cellspacing="0" border="0" 
<!-- BEGIN border -->
class="forumline"
<!-- END border -->
>
	<!-- BEGIN title -->
	<tr>
		<th>{header_blocks_row.title.TITLE}</th>
	</tr>
	<!-- END title -->
	<tr>
		<td
		<!-- BEGIN background -->
		class="row1"
		<!-- END background -->
		><div id="block1_{header_blocks_row.BLOCKID}" style="position: relative;">{header_blocks_row.OUTPUT}</div><!-- BEGIN openclose --><a class="openclose" href="javascript:ShowHide('block1_{header_blocks_row.BLOCKID}','block2_{header_blocks_row.BLOCKID}','block3_{header_blocks_row.BLOCKID}');">&nbsp;</a><!-- END openclose --></td>
	</tr>
</table>
<br />

<script type="text/javascript">
<!--
tmp = 'block3_{header_blocks_row.BLOCKID}';
if(GetCookie(tmp) == '2')
{
	ShowHide('block1_{header_blocks_row.BLOCKID}','block2_{header_blocks_row.BLOCKID}','block3_{header_blocks_row.BLOCKID}');
}
//-->
</script>

<!-- END header_blocks_row -->

</td>
