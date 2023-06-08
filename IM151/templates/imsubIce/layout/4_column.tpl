<div class="container-fluid">
  <div class="row"> 
    <div class="col-sm pr-0">
	
	
<strong>done!</strong><br><br>


	        <!-- BEGIN toprow_blocks_row -->
	        <div class="container-fluid 
	        <!-- BEGIN border -->
	         forumline
	        <!-- END border -->
	         mx-0">
	
	          <!-- Shown when the title is text -->
	          <!-- BEGIN title -->
	          <div class="row th pt-1 pl-1">{toprow_blocks_row.title.TITLE}</div>
	          <!-- END title -->
	
	          <!-- Shown when the title is an image -->
	          <!-- BEGIN title_image -->
	          <div class="row th pt-1"><img src="{toprow_blocks_row.title_image.TITLE}" width="17" height="15" alt=""/></div>
	          <!-- END title_image -->
	
	          <div class="row">
	            <div class="col px-0
	            <!-- BEGIN background -->
	             row1
	            <!-- END background -->
	            ">
	
	              <!-- The button that is shown when the block is closed -->
	              <!-- BEGIN openclose -->
	              <div onclick="ShowHide('block1_{toprow_blocks_row.BLOCKID}','block2_{toprow_blocks_row.BLOCKID}','block1_{toprow_blocks_row.BLOCKID}');" style="display: none; width:100%; cursor: pointer;" id="block2_{toprow_blocks_row.BLOCKID}" >
	                <img src="{toprow_blocks_row.openclose.OPEN_IMG}" alt="" />
	              </div>
	        	  <!-- END openclose -->
	
	        	  <!-- The div cell that is closed when the collapse block button is clicked -->
	        	  <div id="block1_{toprow_blocks_row.BLOCKID}" style="display: block; position: relative;" >{toprow_blocks_row.OUTPUT}
	        	  <!-- The button that is shown when the block is open.  Note that it is within the collapsible cell and therefore disappears when the block closes -->
	        	  <!-- BEGIN openclose -->
	        	  <div onclick="ShowHide('block1_{toprow_blocks_row.BLOCKID}','block2_{toprow_blocks_row.BLOCKID}','block1_{toprow_blocks_row.BLOCKID}');" style="width:100%; cursor: pointer;"><img src="{toprow_blocks_row.openclose.CLOSE_IMG}" alt="" /></div>
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
			tmp = 'block1_{toprow_blocks_row.BLOCKID}';
			if(GetCookie(tmp) == '2')
			{
				ShowHide('block1_{toprow_blocks_row.BLOCKID}','block2_{toprow_blocks_row.BLOCKID}','block1_{toprow_blocks_row.BLOCKID}');
			}
			//-->
			</script>
			<!-- END openclose -->
			<!-- END toprow_blocks_row -->

    </div>
  </div>
  <div class="row">
    <div class="col mx-0">
 
        <div class="row">
          <div class="col">
	        <!-- BEGIN column1_blocks_row -->
	        <div class="container-fluid ctr 
	        <!-- BEGIN border -->
	         forumline
	        <!-- END border -->
	         ">
	
	          <!-- Shown when the title is text -->
	          <!-- BEGIN title -->
	          <div class="row th pt-1 pl-1">{column1_blocks_row.title.TITLE}</div>
	          <!-- END title -->
	
	          <!-- Shown when the title is an image -->
	          <!-- BEGIN title_image -->
	          <div class="row th pt-1"><img src="{column1_blocks_row.title_image.TITLE}" width="17" height="15" alt=""/></div>
	          <!-- END title_image -->
	
	          <div class="row">
	            <div class="col px-0
	            <!-- BEGIN background -->
	             row1
	            <!-- END background -->
	            ">
	
	              <!-- The button that is shown when the block is closed -->
	              <!-- BEGIN openclose -->
	              <div onclick="ShowHide('block1_{column1_blocks_row.BLOCKID}','block2_{column1_blocks_row.BLOCKID}','block1_{column1_blocks_row.BLOCKID}');" style="display: none; width:100%; cursor: pointer;" id="block2_{column1_blocks_row.BLOCKID}" >
	                <img src="{column1_blocks_row.openclose.OPEN_IMG}" alt="" />
	              </div>
	        	  <!-- END openclose -->
	
	        	  <!-- The div cell that is closed when the collapse block button is clicked -->
	        	  <div id="block1_{column1_blocks_row.BLOCKID}" style="display: block; position: relative;" >{column1_blocks_row.OUTPUT}
	        	  <!-- The button that is shown when the block is open.  Note that it is within the collapsible cell and therefore disappears when the block closes -->
	        	  <!-- BEGIN openclose -->
	        	  <div onclick="ShowHide('block1_{column1_blocks_row.BLOCKID}','block2_{column1_blocks_row.BLOCKID}','block1_{column1_blocks_row.BLOCKID}');" style="width:100%; cursor: pointer;"><img src="{column1_blocks_row.openclose.CLOSE_IMG}" alt="" /></div>
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
			tmp = 'block1_{column1_blocks_row.BLOCKID}';
			if(GetCookie(tmp) == '2')
			{
				ShowHide('block1_{column1_blocks_row.BLOCKID}','block2_{column1_blocks_row.BLOCKID}','block1_{column1_blocks_row.BLOCKID}');
			}
			//-->
			</script>
			<!-- END openclose -->
			<!-- END column1_blocks_row -->

          </div>
          <div class="col px-0">

	        <!-- BEGIN column2_blocks_row -->
	        <div class="container-fluid ctr 
	        <!-- BEGIN border -->
	         forumline
	        <!-- END border -->
	         ">
	
	          <!-- Shown when the title is text -->
	          <!-- BEGIN title -->
	          <div class="row th pt-1 pl-1">{column2_blocks_row.title.TITLE}</div>
	          <!-- END title -->
	
	          <!-- Shown when the title is an image -->
	          <!-- BEGIN title_image -->
	          <div class="row th pt-1"><img src="{column2_blocks_row.title_image.TITLE}" width="17" height="15" alt=""/></div>
	          <!-- END title_image -->
	
	          <div class="row">
	            <div class="col px-0
	            <!-- BEGIN background -->
	             row1
	            <!-- END background -->
	            ">
	
	              <!-- The button that is shown when the block is closed -->
	              <!-- BEGIN openclose -->
	              <div onclick="ShowHide('block1_{column2_blocks_row.BLOCKID}','block2_{column2_blocks_row.BLOCKID}','block1_{column2_blocks_row.BLOCKID}');" style="display: none; width:100%; cursor: pointer;" id="block2_{column2_blocks_row.BLOCKID}" >
	                <img src="{column2_blocks_row.openclose.OPEN_IMG}" alt="" />
	              </div>
	        	  <!-- END openclose -->
	
	        	  <!-- The div cell that is closed when the collapse block button is clicked -->
	        	  <div id="block1_{column2_blocks_row.BLOCKID}" style="display: block; position: relative;" >{column2_blocks_row.OUTPUT}
	        	  <!-- The button that is shown when the block is open.  Note that it is within the collapsible cell and therefore disappears when the block closes -->
	        	  <!-- BEGIN openclose -->
	        	  <div onclick="ShowHide('block1_{column2_blocks_row.BLOCKID}','block2_{column2_blocks_row.BLOCKID}','block1_{column2_blocks_row.BLOCKID}');" style="width:100%; cursor: pointer;"><img src="{column2_blocks_row.openclose.CLOSE_IMG}" alt="" /></div>
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
			tmp = 'block1_{column2_blocks_row.BLOCKID}';
			if(GetCookie(tmp) == '2')
			{
				ShowHide('block1_{column2_blocks_row.BLOCKID}','block2_{column2_blocks_row.BLOCKID}','block1_{column2_blocks_row.BLOCKID}');
			}
			//-->
			</script>
			<!-- END openclose -->
			<!-- END column2_blocks_row -->
          </div>
        </div>

        <div class="row">
          <div class="col">


	        <!-- BEGIN bottomrow_blocks_row -->
	        <div class="container-fluid ctr 
	        <!-- BEGIN border -->
	         forumline
	        <!-- END border -->
	         ">
	
	          <!-- Shown when the title is text -->
	          <!-- BEGIN title -->
	          <div class="row th pt-1 pl-1">{bottomrow_blocks_row.title.TITLE}</div>
	          <!-- END title -->
	
	          <!-- Shown when the title is an image -->
	          <!-- BEGIN title_image -->
	          <div class="row th pt-1"><img src="{bottomrow_blocks_row.title_image.TITLE}" width="17" height="15" alt=""/></div>
	          <!-- END title_image -->
	
	          <div class="row">
	            <div class="col px-0
	            <!-- BEGIN background -->
	             row1
	            <!-- END background -->
	            ">
	
	              <!-- The button that is shown when the block is closed -->
	              <!-- BEGIN openclose -->
	              <div onclick="ShowHide('block1_{bottomrow_blocks_row.BLOCKID}','block2_{bottomrow_blocks_row.BLOCKID}','block1_{bottomrow_blocks_row.BLOCKID}');" style="display: none; width:100%; cursor: pointer;" id="block2_{bottomrow_blocks_row.BLOCKID}" >
	                <img src="{bottomrow_blocks_row.openclose.OPEN_IMG}" alt="" />
	              </div>
	        	  <!-- END openclose -->
	
	        	  <!-- The div cell that is closed when the collapse block button is clicked -->
	        	  <div id="block1_{bottomrow_blocks_row.BLOCKID}" style="display: block; position: relative;" >{bottomrow_blocks_row.OUTPUT}
	        	  <!-- The button that is shown when the block is open.  Note that it is within the collapsible cell and therefore disappears when the block closes -->
	        	  <!-- BEGIN openclose -->
	        	  <div onclick="ShowHide('block1_{bottomrow_blocks_row.BLOCKID}','block2_{bottomrow_blocks_row.BLOCKID}','block1_{bottomrow_blocks_row.BLOCKID}');" style="width:100%; cursor: pointer;"><img src="{bottomrow_blocks_row.openclose.CLOSE_IMG}" alt="" /></div>
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
			tmp = 'block1_{bottomrow_blocks_row.BLOCKID}';
			if(GetCookie(tmp) == '2')
			{
				ShowHide('block1_{bottomrow_blocks_row.BLOCKID}','block2_{bottomrow_blocks_row.BLOCKID}','block1_{bottomrow_blocks_row.BLOCKID}');
			}
			//-->
			</script>
			<!-- END openclose -->
			<!-- END bottomrow_blocks_row -->

          </div>
        </div>
      </div>

    </div>
  </div>
</div>