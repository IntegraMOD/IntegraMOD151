<td width="10"><img src="images/spacer.gif" alt="" width="10" height="30" /></td>
<td width="{FOOTER_WIDTH}" valign="top">

<!-- BEGIN tail_blocks_row -->

<table width="100%" cellpadding="5" cellspacing="0" border="0"
<!-- BEGIN border -->
class="forumline shadow"
<!-- END border -->
>
	<!-- BEGIN title -->
	<tr>
		<th>{tail_blocks_row.title.TITLE}</th>
	</tr>
	<!-- END title -->
	<tr>
		<td
		<!-- BEGIN background -->
		class="row1"
		<!-- END background -->
		><div id="block1_{tail_blocks_row.BLOCKID}" style="position: relative;">{tail_blocks_row.OUTPUT}</div><!-- BEGIN background --><a class="openclose" href="javascript:ShowHide('block1_{tail_blocks_row.BLOCKID}','block2_{tail_blocks_row.BLOCKID}','block3_{tail_blocks_row.BLOCKID}');">&nbsp;</a><!-- END background --></td>
	</tr>
</table>
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