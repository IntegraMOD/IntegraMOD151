    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	    <td valign="top">
		  <!-- BEGIN center_blocks_row -->
	      <table width="100%" cellpadding="2" cellspacing="0" border="0" 
	      <!-- BEGIN border -->
	      class="forumline"
	      <!-- END border -->
	      >
	        <!-- BEGIN title -->
	        <tr>
	          <th>{center_blocks_row.title.TITLE}</th>
	        </tr>
	        <!-- END title -->
	        <!-- BEGIN title_image -->
	        <tr>
	          <th><img src="{center_blocks_row.title_image.TITLE}" /></th>
	        </tr>
	        <!-- END title_image -->
	        <tr>
	          <td
	          <!-- BEGIN background -->
	          class="row1"
	          <!-- END background -->
	          >
	            <!-- BEGIN openclose -->
	            <div onclick="ShowHide('block1_{center_blocks_row.BLOCKID}','block2_{center_blocks_row.BLOCKID}','block1_{center_blocks_row.BLOCKID}');" style="display: none; width:100%; cursor: pointer; cursor: hand;" id="block2_{center_blocks_row.BLOCKID}" align="center">
				  <img src="{center_blocks_row.openclose.OPEN_IMG}" title="OPEN" />
				</div>
	            <!-- END openclose -->
	            <div id="block1_{center_blocks_row.BLOCKID}" style="display: ''; position: relative;" align="center">{center_blocks_row.OUTPUT}
				  <!-- BEGIN openclose -->
	              <div onclick="ShowHide('block1_{center_blocks_row.BLOCKID}','block2_{center_blocks_row.BLOCKID}','block1_{center_blocks_row.BLOCKID}');" style="width:100%; cursor: pointer; cursor: hand;">
				    <img src="{center_blocks_row.openclose.CLOSE_IMG}" title="CLOSE" />
	              </div>
	              <!-- END openclose -->
	            </div>
	          </td>
			</tr>
	      </table>
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
		<td id="right_block" style="display: ''; width:150px; vertical-align: text-top !important;">
		  <table cellpadding="0" cellspacing="0" border="0">
		    <tr>
		      <!-- BEGIN layout_collapse -->
		  	  <td valign="top" style="display: block; cursor: pointer; cursor: hand;" align="right" width="10" height="18">
			  <a href="JavaScript:ShowHide('right_block','right_hide','right_block');">
			  <img src="{layout_collapse.LAYOUT_IMAGER}" alt="" width="10" height="18" border="0" />
			  </a>
			  </td>
			  <!-- END layout_collapse -->
			  <!-- BEGIN no_layout_collapse -->
			  <td width="10"><img src="{no_layout_collapse.SPACER}" alt="" width="10" height="30" /></td>
			  <!-- END no_layout_collapse -->
	    	  <td style="vertical-align: text-top !important;">
			    <!-- BEGIN right_blocks_row -->
	     		<table width="100%" cellpadding="2" cellspacing="0" border="0" 
	     	  	<!-- BEGIN border -->
	    	 	class="forumline"
	     		<!-- END border -->
	     		>
	       		<!-- BEGIN title -->
	       		  <tr>
	         	    <td>{right_blocks_row.title.TITLE}</td>
	       		  </tr>
	       		  <!-- END title -->
	       		  <!-- BEGIN title_image -->
	       		  <tr>
	         	    <td><img src="{right_blocks_row.title_image.TITLE}" /></td>
				  </tr>
				  <!-- END title_image -->
				  <tr> 
				    <td
					<!-- BEGIN background -->
					class=""
					<!-- END background -->
					>
					  <!-- BEGIN openclose -->
					  <div onclick="ShowHide('block1_{right_blocks_row.BLOCKID}','block2_{right_blocks_row.BLOCKID}','block1_{right_blocks_row.BLOCKID}');" style="display: none; width:100%; cursor: pointer; cursor: hand;" id="block2_{right_blocks_row.BLOCKID}" align="center"><img src="{right_blocks_row.openclose.OPEN_IMG}" /></div>
					  <!-- END openclose -->
					  <div id="block1_{right_blocks_row.BLOCKID}" style="display: ''; position: relative;">{right_blocks_row.OUTPUT}
					    <!-- BEGIN openclose -->
					    <div align="center" onclick="ShowHide('block1_{right_blocks_row.BLOCKID}','block2_{right_blocks_row.BLOCKID}','block1_{right_blocks_row.BLOCKID}');" style="width:100%; cursor: pointer; cursor: hand;"><img src="{right_blocks_row.openclose.CLOSE_IMG}" /></div>
					    <!-- END openclose -->
					  </div>
				    </td>
				  </tr>
				</table>
	       		<br />
				<script language="javascript" type="text/javascript">
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
		</td>
	    <!-- BEGIN layout_collapse -->
	    <td id="right_hide" style="display: none;" valign="top" align="right" width="10" height="18"><a href="javascript:ShowHide('right_block','right_hide','right_block');"><img src="{layout_collapse.LAYOUT_IMAGEL}" width="10" height="18" alt="" border="0" /></a></td>
	    <!-- END layout_collapse -->
	    <!-- BEGIN no_layout_collapse -->
		<td width="10"><img src="images/spacer.gif" alt="" width="10" height="30" /></td>
	    <!-- END no_layout_collapse -->
 	  </tr>
    </table>

	<script>
	<!--
	tmp = 'right_block';
	if(GetCookie(tmp) == '2')
	{
		ShowHide('right_block','right_hide','right_block');
	}
	//-->
	</script>