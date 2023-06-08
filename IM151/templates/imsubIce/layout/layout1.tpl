    <div class="col px-0">
      <div class="container-fluid">
	    <div class="row">
	      <div class="col px-0 align-top">
	        <!-- The start of the header block -->
	        <!-- BEGIN center_blocks_row -->
	        <div class="container-fluid ctr 
	        <!-- BEGIN border -->
	         forumline
	        <!-- END border -->
	         ">
	
	          <!-- Shown when the title is text -->
	          <!-- BEGIN title -->
	          <div class="row th pt-1 pl-1">{center_blocks_row.title.TITLE}</div>
	          <!-- END title -->
	
	          <!-- Shown when the title is an image -->
	          <!-- BEGIN title_image -->
	          <div class="row th"><img src="{center_blocks_row.title_image.TITLE}"  alt=""/></div>
	          <!-- END title_image -->
	
	          <div class="row">
	            <div class="col 
	            <!-- BEGIN background -->
	             row1
	            <!-- END background -->
	            ">
	
	              <!-- The button that is shown when the block is closed -->
	              <!-- BEGIN openclose -->
	              <div onclick="ShowHide('block1_{center_blocks_row.BLOCKID}','block2_{center_blocks_row.BLOCKID}','block1_{center_blocks_row.BLOCKID}');" style="display: none; width:100%; cursor: pointer;" id="block2_{center_blocks_row.BLOCKID}" >
	                <img src="{center_blocks_row.openclose.OPEN_IMG}" alt="" />
	              </div>
	        	  <!-- END openclose -->
	
	        	  <!-- The div cell that is closed when the collapse block button is clicked -->
	        	  <div id="block1_{center_blocks_row.BLOCKID}" style="display: ''; position: relative;" >{center_blocks_row.OUTPUT}
	        	  <!-- The button that is shown when the block is open.  Note that it is within the collapsible cell and therefore disappears when the block closes -->
	        	  <!-- BEGIN openclose -->
	        	  <div onclick="ShowHide('block1_{center_blocks_row.BLOCKID}','block2_{center_blocks_row.BLOCKID}','block1_{center_blocks_row.BLOCKID}');" style="width:100%; cursor: pointer;"><img src="{center_blocks_row.openclose.CLOSE_IMG}" alt="" /></div>
	        	  <!-- END openclose -->
	        	  </div>
	            </div>
	          </div>
	        </div>
			<br />
	
			<!-- The cookie related javascript to remember what blocks are open/closed on page load -->
			<!-- BEGIN openclose -->
			<script>
			<!--
			tmp = 'block1_{center_blocks_row.BLOCKID}';
			if(GetCookie(tmp) == '2')
			{
				ShowHide('block1_{center_blocks_row.BLOCKID}','block2_{center_blocks_row.BLOCKID}','block1_{center_blocks_row.BLOCKID}');
			}
			//-->
			</script>
			<!-- END openclose -->
	
	<!-- END center_blocks_row -->
	      </div>
	    </div>
	  </div>
    </div>