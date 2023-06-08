<td width="2"><img src="images/spacer.gif" alt="" width="2" /></td>
<td valign="top" style="width:{FOOTER_WIDTH}px !important;">

<!-- BEGIN tail_blocks_row -->
 <table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
   		<!-- BEGIN title -->
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif"WIDTH=8 HEIGHT=23 border="0" alt=""></td> 
   <td width="100%" background="templates/PowerMetal/images/blk_tm.gif"><img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""><span class="genblock">{tail_blocks_row.title.TITLE}</span></td>
   <td><img name="blkr" src="templates/PowerMetal/images/blk_trc.gif" WIDTH=77 HEIGHT=23 border="0" alt=""></td>
  </tr>
  		<!-- END title -->
 </table>
  	  <table border="0" cellpadding="0" cellspacing="0" width="100%" valign=Top">
  	  <!-- BEGIN border -->
  <tr>
   <td><img name="tlc" src="templates/PowerMetal/images/tlc.gif" WIDTH=8 HEIGHT=6 border="0" alt=""></td> 
   <td width="100%" background="templates/PowerMetal/images/tm.gif"><img name="tm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="trc" src="templates/PowerMetal/images/trc.gif" WIDTH=8 HEIGHT=6 border="0" alt=""></td>
  </tr>
  <tr>
    <td background="templates/PowerMetal/images/left.gif"><img name="left" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
    <!-- END border -->
        <td valign="top">
<table width="100%" cellpadding="2" cellspacing="0" border="0">

      <tr>
		<td
        <!-- BEGIN background -->
        class="row1" 
        <!-- END background -->
		><div id="block1_{tail_blocks_row.BLOCKID}" style="position: relative;">{tail_blocks_row.OUTPUT}</div><!-- BEGIN openclose --><a class="openclose" href="javascript:ShowHide('block1_{tail_blocks_row.BLOCKID}','block2_{tail_blocks_row.BLOCKID}','block3_{tail_blocks_row.BLOCKID}');">&nbsp;</a><!-- END openclose -->
		</td>
 	  </tr> 
    </table>
</td>
<!-- BEGIN border -->
    <td background="templates/PowerMetal/images/right.gif"><img name="right" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
   <td><img name="blc" src="templates/PowerMetal/images/blc.gif" WIDTH=8 HEIGHT=8 border="0" alt=""></td>
    <td background="templates/PowerMetal/images/btm.gif"><img name="btm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="brc" src="templates/PowerMetal/images/brc.gif" WIDTH=8 HEIGHT=8 border="0" alt=""></td>
  </tr>
  <!-- END border -->
  </table><br />
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