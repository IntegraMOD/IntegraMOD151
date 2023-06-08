	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	    <tr> 
		  <!-- The button that is shown when the column is closed -->
		  <!-- BEGIN layout_collapse -->
		  <td id="left_block_hide" style="display: none;" valign="top" align="left" width="10" height="18"><a href="JavaScript:ShowHide('left_block','left_block_hide','left_block');"><img src="{layout_collapse.LAYOUT_IMAGER}" width="10" height="18" alt="" border="0" /></a></td>
		  <!-- END layout_collapse -->
		  <!-- The spacer image that replaces the above button when the collapsible layout is turned off -->
		  <!-- BEGIN no_layout_collapse -->
		  <td width="10"><img src="{no_layout_collapse.SPACER}" alt="" width="10" height="30" /></td>
		  <!-- END no_layout_collapse -->
		  <!-- The td cell that closes when the collapse column button is clicked -->

          <td id="left_block"  class="leftcolumn" width="180" valign="top" style="display: '';">
	        <table width="100%" cellpadding="0" cellspacing="0" border="0">
		      <tr>
			    <td valign="top">
				  <!-- The start of the header block -->
				  <!-- BEGIN left_blocks_row -->
				  <table width="100%" cellpadding="0" cellspacing="0" border="0">
					<!-- Shown when the title is text -->
					<!-- BEGIN title -->
					<tr>
		              <td align="left">&nbsp;&nbsp;<img src="{TEMPLATE}images/icon_right_arrow.gif" width="9" height="9" border="0" alt="" /><font color="blue"><b>&nbsp;&nbsp;&nbsp;{left_blocks_row.title.TITLE}</b></font></td>
					</tr>
					<!-- END title -->

					<!-- Shown when the title is an image -->
					<!-- BEGIN title_image -->
					<tr>
						<td style="text-align:right;"><img src="{left_blocks_row.title_image.TITLE}" /></td>
					</tr>
					<!-- END title_image -->
					<tr>
						<td
						<!-- BEGIN background -->
						class="row1"
						<!-- END background -->
						>
							<!-- BEGIN openclose -->
							<div onclick="ShowHide('block1_{left_blocks_row.BLOCKID}','block2_{left_blocks_row.BLOCKID}','block1_{left_blocks_row.BLOCKID}');" style="display: none; width:100%; cursor: pointer; cursor: hand;" id="block2_{left_blocks_row.BLOCKID}" align="center"><img src="{left_blocks_row.openclose.OPEN_IMG}" title="OPEN" /></div>
							<!-- END openclose -->
							<div id="block1_{left_blocks_row.BLOCKID}" style="display: ''; position: relative;" align="center">{left_blocks_row.OUTPUT}
								<!-- BEGIN openclose -->
								<div onclick="ShowHide('block1_{left_blocks_row.BLOCKID}','block2_{left_blocks_row.BLOCKID}','block1_{left_blocks_row.BLOCKID}');" style="width:100%; cursor: pointer; cursor: hand;"><img src="{left_blocks_row.openclose.CLOSE_IMG}" title="CLOSE" /></div>
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
				tmp = 'block1_{left_blocks_row.BLOCKID}';
				if(GetCookie(tmp) == '2')
				{
					ShowHide('block1_{left_blocks_row.BLOCKID}','block2_{left_blocks_row.BLOCKID}','block1_{left_blocks_row.BLOCKID}');
				}
				</script>
				<!-- END openclose -->
				<!-- END left_blocks_row -->

			    </td>

			    <!-- BEGIN layout_collapse -->
			    <td valign="top" style="display: block; cursor: pointer; cursor: hand;" align="left" width="10" height="18"><a href="JavaScript:ShowHide('left_block','left_block_hide','left_block');"><img src="{layout_collapse.LAYOUT_IMAGEL}" alt="" width="10" height="18" border="0" /></a></td>
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
		  tmp = 'left_block';
		  if(GetCookie(tmp) == '2')
		  {
		    ShowHide('left_block','left_block_hide','left_block');
		  }
		  //-->
		  </script>

		  <td width="10"><img src="images/spacer.gif" alt="" width="10" height="30" /></td>
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
		  <td width="180" valign="top">

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