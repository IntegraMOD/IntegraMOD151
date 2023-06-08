      <table width="100%" border="0" cellspacing="0" cellpadding="0">
	    <tr> 
		  <td valign="top">
			<!-- BEGIN center_blocks_row -->
		    <!-- BEGIN title -->
		    <table width="100%" cellpadding="5" cellspacing="0" border="0" >
			  <tr>
			   <td align="left" class="sideblocktitle">&nbsp;&nbsp;{center_blocks_row.title.TITLE}</td>
			  </tr>
		    </table>
		    <!-- END title -->
		    <!-- BEGIN border -->
		    <table border="0" cellpadding="0" cellspacing="0" class="blkt">
			  <tr>
			    <td class="blktl"><img src="images/spacer.gif" alt="" width="10" height="15" /></td>
			    <td class="blktm" valign="top" width="100%"><img src="images/spacer.gif" alt="" width="8" height="3" /></td>
			    <td class="blktr"><img src="images/spacer.gif" alt="" width="10" height="15" /></td>
			  </tr>
		    </table>
		    <!-- END border -->	
			<table width="100%" cellpadding="2" cellspacing="0" border="0" 
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
						<!-- The button that is shown when the block is closed -->
						<!-- BEGIN openclose -->
						<div onclick="ShowHide('block1_{center_blocks_row.BLOCKID}','block2_{center_blocks_row.BLOCKID}','block1_{center_blocks_row.BLOCKID}');" style="display: none; width:100%; cursor: pointer; cursor: hand;" id="block2_{center_blocks_row.BLOCKID}" align="center">
							<img src="{center_blocks_row.openclose.OPEN_IMG}" />
						</div>
						<!-- END openclose -->
						<!-- The div cell that is closed when the collapse block button is clicked -->
						<div id="block1_{center_blocks_row.BLOCKID}" style="display: ''; position: relative;" align="center">{center_blocks_row.OUTPUT}
							<!-- The button that is shown when the block is open.  Note that it is within the collapsible cell and therefore disappears when the block closes -->
							<!-- BEGIN openclose -->
							<div onclick="ShowHide('block1_{center_blocks_row.BLOCKID}','block2_{center_blocks_row.BLOCKID}','block1_{center_blocks_row.BLOCKID}');" style="width:100%; cursor: pointer; cursor: hand;">
								<img src="{center_blocks_row.openclose.CLOSE_IMG}" />
							</div>
							<!-- END openclose -->
						</div>
					</td>
				</tr>
			</table>
			<!-- The cookie related javascript to remember what blocks are open/closed on page load -->
			<!-- BEGIN openclose -->
			<script language="javascript" type="text/javascript">
			<!--
			tmp = 'block1_{center_blocks_row.BLOCKID}';
			if(GetCookie(tmp) == '2')
			{
				ShowHide('block1_{center_blocks_row.BLOCKID}','block2_{center_blocks_row.BLOCKID}','block1_{center_blocks_row.BLOCKID}');
			}
			//-->
			</script>
			<!-- END openclose -->
		    <!-- BEGIN border -->
		    <table border="0" cellpadding="0" cellspacing="0" class="blkb">
			  <tr>
			    <td class="blkbl"><img src="images/spacer.gif" alt="" width="62" height="17" /></td>
			    <td class="blkbm" valign="bottom" width="100%"><img src="images/spacer.gif" alt="" width="8" height="17" /></td>
			    <td class="blkbr"><img src="images/spacer.gif" alt="" width="10" height="17" /></td>
		      </tr>
		    </table>
		    <!-- END border -->
			<!-- END center_blocks_row -->
		  </td>
	    </tr>
      </table>