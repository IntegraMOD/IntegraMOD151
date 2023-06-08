<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td valign="top">
    <!-- BEGIN center_blocks_row -->
    <table width="100%" cellpadding="5" cellspacing="0" border="0" >
      <!-- BEGIN title -->
      <tr>
        <td align="left" class="sideblocktitle">&nbsp;&nbsp;{center_blocks_row.title.TITLE}</td>
      </tr>
	  <!-- END title -->
	  <!-- BEGIN title_image -->
      <tr>
        <td align="left" class="sideblocktitle">&nbsp;&nbsp;<img src="{center_blocks_row.title_image.TITLE}" /></td>
      </tr>
	  <!-- END title_image -->
    </table>
    <!-- BEGIN border -->
    <table border="0" cellpadding="0" cellspacing="0" class="blkt">
	  <tr>
	    <td class="blktl"><img src="images/spacer.gif" alt="" width="10" height="15" /></td>
	    <td class="blktm" valign="top" width="100%"><img src="images/spacer.gif" alt="" width="8" height="3" /></td>
	    <td class="blktr"><img src="images/spacer.gif" alt="" width="10" height="15" /></td>
	  </tr>
	</table>
    <!-- END border -->
    <table width="100%" cellpadding="5" cellspacing="0" border="0" 
    <!-- BEGIN border -->
    class="forumline2"
    <!-- END border -->
    >
	  <tr>
	    <td
	    <!-- BEGIN background -->
	    class=""
	    <!-- END background -->
        >	
	      <!-- BEGIN openclose -->
	      <div onclick="ShowHide('block1_{center_blocks_row.BLOCKID}','block2_{center_blocks_row.BLOCKID}','block1_{center_blocks_row.BLOCKID}');" style="display: none; width:100%; cursor: pointer; cursor: hand;" id="block2_{center_blocks_row.BLOCKID}" align="center"><img src="{center_blocks_row.openclose.OPEN_IMG}" title="OPEN" /></div>
	      <!-- END openclose -->
	      <div id="block1_{center_blocks_row.BLOCKID}" style="display: ''; position: relative;" align="center">{center_blocks_row.OUTPUT}
	      <!-- BEGIN openclose -->
	      <div onclick="ShowHide('block1_{center_blocks_row.BLOCKID}','block2_{center_blocks_row.BLOCKID}','block1_{center_blocks_row.BLOCKID}');" style="width:100%; cursor: pointer; cursor: hand;"><img src="{center_blocks_row.openclose.CLOSE_IMG}" title="CLOSE" /></div>
	      <!-- END openclose -->
          </div>
	    </td
	  </tr>
    </table>
    <!-- BEGIN border -->
    <table border="0" cellpadding="0" cellspacing="0" class="blkb">
	  <tr>
	    <td class="blkbl"><img src="images/spacer.gif" alt="" width="62" height="17" /></td>
	    <td class="blkbm" valign="bottom" width="100%"><img src="images/spacer.gif" alt="" width="8" height="17" /></td>
	    <td class="blkbr"><img src="images/spacer.gif" alt="" width="10" height="17" /></td>
	  </tr>
	</table>
    <!-- END border -->
    <br />
	<script">
	<!--
	tmp = 'block1_{center_blocks_row.BLOCKID}';
	if(GetCookie(tmp) == '2')
	{
	  ShowHide('block1_{center_blocks_row.BLOCKID}','block2_{center_blocks_row.BLOCKID}','block1_{center_blocks_row.BLOCKID}');
	}
	//-->
	</script>
    <!-- END center_blocks_row -->

    </td>

    <td width="10"><img src="images/spacer.gif" alt="" width="10" height="30" /></td>
    <td width="150" valign="top">


    <!-- BEGIN right_blocks_row -->
    <table width="100%" cellpadding="5" cellspacing="0" border="0" >
      <!-- BEGIN title -->
      <tr>
        <td align="left" class="sideblocktitle">&nbsp;&nbsp;{right_blocks_row.title.TITLE}</td>
      </tr>
	  <!-- END title -->
	  <!-- BEGIN title_image -->
      <tr>
        <td align="left" class="sideblocktitle">&nbsp;&nbsp;<img src="{right_blocks_row.title_image.TITLE}" /></td>
      </tr>
	  <!-- END title_image -->
    </table>
    <!-- BEGIN border -->
    <table border="0" cellpadding="0" cellspacing="0" class="blkt">
	  <tr>
	    <td class="blktl"><img src="images/spacer.gif" alt="" width="10" height="15" /></td>
	    <td class="blktm" valign="top" width="100%"><img src="images/spacer.gif" alt="" width="8" height="3" /></td>
	    <td class="blktr"><img src="images/spacer.gif" alt="" width="10" height="15" /></td>
	  </tr>
	</table>
    <!-- END border -->
    <table width="100%" cellpadding="5" cellspacing="0" border="0" 
    <!-- BEGIN border -->
    class="forumline2"
    <!-- END border -->
    >
	  <tr>
	    <td
	    <!-- BEGIN background -->
	    class=""
	    <!-- END background -->
        >	
	      <!-- BEGIN openclose -->
	      <div onclick="ShowHide('block1_{right_blocks_row.BLOCKID}','block2_{right_blocks_row.BLOCKID}','block1_{right_blocks_row.BLOCKID}');" style="display: none; width:100%; cursor: pointer; cursor: hand;" id="block2_{right_blocks_row.BLOCKID}" align="center"><img src="{right_blocks_row.openclose.OPEN_IMG}" title="OPEN" /></div>
	      <!-- END openclose -->
	      <div id="block1_{right_blocks_row.BLOCKID}" style="display: ''; position: relative;" align="center">{right_blocks_row.OUTPUT}
	      <!-- BEGIN openclose -->
	      <div onclick="ShowHide('block1_{right_blocks_row.BLOCKID}','block2_{right_blocks_row.BLOCKID}','block1_{right_blocks_row.BLOCKID}');" style="width:100%; cursor: pointer; cursor: hand;"><img src="{right_blocks_row.openclose.CLOSE_IMG}" title="CLOSE" /></div>
	      <!-- END openclose -->
          </div>
	    </td
	  </tr>
    </table>
    <!-- BEGIN border -->
    <table border="0" cellpadding="0" cellspacing="0" class="blkb">
	  <tr>
	    <td class="blkbl"><img src="images/spacer.gif" alt="" width="62" height="17" /></td>
	    <td class="blkbm" valign="bottom" width="100%"><img src="images/spacer.gif" alt="" width="8" height="17" /></td>
	    <td class="blkbr"><img src="images/spacer.gif" alt="" width="10" height="17" /></td>
	  </tr>
	</table>
    <!-- END border -->
    <br />
	<script">
	<!--
	tmp = 'block1_{right_blocks_row.BLOCKID}';
	if(GetCookie(tmp) == '2')
	{
	  ShowHide('block1_{right_blocks_row.BLOCKID}','block2_{right_blocks_row.BLOCKID}','block1_{right_blocks_row.BLOCKID}');
	}
	//-->
	</script>
    <!-- END right_blocks_row -->

    </td>
  </tr>
</table>