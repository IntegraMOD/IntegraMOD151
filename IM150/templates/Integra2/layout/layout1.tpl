<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr> 
<td valign="top">

<!-- BEGIN center_blocks_row -->

<table width="100%" cellpadding="5" cellspacing="0" border="0" 
<!-- BEGIN border -->
class="forumline"
<!-- END border -->
>
	<!-- BEGIN title -->
	<tr>
		<th>{center_blocks_row.title.TITLE}</th>
	</tr>
	<!-- END title -->
	<tr>
		<td
		<!-- BEGIN background -->
		class="row1"
		<!-- END background -->
		><div id="block1_{center_blocks_row.BLOCKID}" style="position: relative;">{center_blocks_row.OUTPUT}</div></td>
	</tr>
	<!-- BEGIN openclose -->
	<tr>
		<td><a class="openclose" href="javascript:ShowHide('block1_{right_blocks_row.BLOCKID}','block2_{right_blocks_row.BLOCKID}','block3_{right_blocks_row.BLOCKID}');">&nbsp;</a></td>
	</tr>
	<!-- END openclose -->
</table>
<br />

<script type="text/javascript">
<!--
tmp = 'block3_{center_blocks_row.BLOCKID}';
if(GetCookie(tmp) == '2')
{
	ShowHide('block1_{center_blocks_row.BLOCKID}','block2_{center_blocks_row.BLOCKID}','block3_{center_blocks_row.BLOCKID}');
}
//-->
</script>

<!-- END center_blocks_row -->

</td>
</tr>
</table>