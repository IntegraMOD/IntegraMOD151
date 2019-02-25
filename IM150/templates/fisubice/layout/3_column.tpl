<div class="container-fluid">
  <div class="row"> 

  	<!-- LEFT BLOCKS BEGIN -->
    <!-- The button that is shown when the column is closed -->
  	<!-- BEGIN layout_collapse -->
  	<div class="sp-col text-left" id="left_hide" style="display: none;"><a href="JavaScript:ShowHide('left_block','left_hide','left_block');"><img src="{layout_collapse.LAYOUT_IMAGER}" width="10" height="18" alt="" /></a></div>
	<!-- END layout_collapse -->

	<!-- The spacer image that replaces the above button when the collapsible layout is turned off -->
	<!-- BEGIN no_layout_collapse -->
	<div class="sp-col"><img src="{no_layout_collapse.SPACER}" alt="" width="10" height="30" /></div>
	<!-- END no_layout_collapse -->

	<!-- The td cell that closes when the collapse column button is clicked -->
<div class="col-3 m-0 px-0" id="left_block" style="display: block; max-width:180px">

  <div class="container-fluid pr-0">
    <div class="row px-0 mx-0">
      <div class="col px-0 align-top">
            <!-- The start of the header block -->
            <!-- BEGIN left_blocks_row -->
        	<div class="container-fluid ctr 
        	<!-- BEGIN border -->
        	 forumline
        	<!-- END border -->
         	">

        	  <!-- Shown when the title is text -->
          	  <!-- BEGIN title -->
          	  <div class="row th pt-1 pl-1">{left_blocks_row.title.TITLE}</div>
          	  <!-- END title -->

          	  <!-- Shown when the title is an image -->
          	  <!-- BEGIN title_image -->
          	  <div class="row th pt-1"><img src="{left_blocks_row.title_image.TITLE}" width="17" height="15" alt=""/></div>
          	  <!-- END title_image -->

          	  <div class="row">
            	<div class="col px-1
                <!-- BEGIN background -->
            	 row1
            	<!-- END background -->
            	">

              	  <!-- The button that is shown when the block is closed -->
              	  <!-- BEGIN openclose -->
              	  <div onclick="ShowHide('block1_{left_blocks_row.BLOCKID}','block2_{left_blocks_row.BLOCKID}','block1_{left_blocks_row.BLOCKID}');" style="display: none; width:100%; cursor: pointer;" id="block2_{left_blocks_row.BLOCKID}" >
                	<img src="{left_blocks_row.openclose.OPEN_IMG}" alt="" />
              	  </div>
        	  	  <!-- END openclose -->

        	  	  <!-- The div cell that is closed when the collapse block button is clicked -->
        	  	  <div id="block1_{left_blocks_row.BLOCKID}" style="display: block; position: relative;" >{left_blocks_row.OUTPUT}
        	  	  <!-- The button that is shown when the block is open.  Note that it is within the collapsible cell and therefore disappears when the block closes -->
        	  	  <!-- BEGIN openclose -->
        	  	  <div onclick="ShowHide('block1_{left_blocks_row.BLOCKID}','block2_{left_blocks_row.BLOCKID}','block1_{left_blocks_row.BLOCKID}');" style="width:100%; cursor: pointer;"><img src="{left_blocks_row.openclose.CLOSE_IMG}" alt="" /></div>
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
		  tmp = 'block1_{left_blocks_row.BLOCKID}';
		  if(GetCookie(tmp) == '2')
		  {
			ShowHide('block1_{left_blocks_row.BLOCKID}','block2_{left_blocks_row.BLOCKID}','block1_{left_blocks_row.BLOCKID}');
		  }
		  //-->
		  </script>
		  <!-- END openclose -->

<!-- END left_blocks_row -->
        </div>

	    <!-- The button that is shown when the column is open.  Note that it is within the collapsible cell and therefore disappears when the column closes -->
	    <!-- BEGIN layout_collapse -->
	    <div class="sp-col text-left" style="display: block; cursor: pointer;"><a href="JavaScript:ShowHide('left_block','left_hide','left_block');"><img src="{layout_collapse.LAYOUT_IMAGEL}" alt="" width="10" height="18" /></a></div>
	    <!-- END layout_collapse -->

      </div>
    </div>
  </div>

  <!-- The spacer image that replaces the above button when the collapsible layout is turned off -->
  <!-- BEGIN no_layout_collapse -->
  <div class="sp-col"><img src="{no_layout_collapse.SPACER}" alt="" width="10" height="30" /></div>
  <!-- END no_layout_collapse -->

  <!-- The cookie related javascript to remember what columns are open/closed on page load -->

<script>
<!--
tmp = 'left_block';
if(GetCookie(tmp) == '2')
{
	ShowHide('left_block','left_hide','left_block');
}
//-->
</script>

<!-- LEFT BLOCKS END -->
<!-- CENTER BLOCKS BEGIN -->

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
	          <div class="row th pt-1"><img src="{center_blocks_row.title_image.TITLE}" width="17" height="15" alt=""/></div>
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
	        	  <div id="block1_{center_blocks_row.BLOCKID}" style="display: block; position: relative;" >{center_blocks_row.OUTPUT}
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

<!-- CENTER BLOCKS END -->
<!-- RIGHT BLOCKS BEGIN -->

    <div class="col-3 p-0" id="right_block" style="display: block; max-width:180px">
      <div class="container-fluid">
	    <div class="row">

		  <!-- BEGIN layout_collapse -->
		  <div class="sp-col" style="display: block; cursor: pointer;"><a href="JavaScript:ShowHide('right_block','right_hide','right_block');"><img src="{layout_collapse.LAYOUT_IMAGER}" alt="" width="10" height="18" /></a></div>
		  <!-- END layout_collapse -->
		
		  <!-- BEGIN no_layout_collapse -->
		  <div class="sp-col"><img src="{no_layout_collapse.SPACER}" alt="" width="10" height="30" /></div>
		  <!-- END no_layout_collapse -->

    	  <div class="col px-0 align-top">
		    <!-- BEGIN right_blocks_row -->
	        <div class="container-fluid ctr 
	        <!-- BEGIN border -->
	         forumline
	        <!-- END border -->
	         ">
	          <!-- Shown when the title is text -->
	          <!-- BEGIN title -->
	          <div class="row th pt-1 pl-1">{right_blocks_row.title.TITLE}</div>
	          <!-- END title -->
	
	          <!-- Shown when the title is an image -->
	          <!-- BEGIN title_image -->
	          <div class="row th pt-1"><img src="{right_blocks_row.title_image.TITLE}"  width="17" height="15" alt="" /></div>
	          <!-- END title_image -->
	          <div class="row">
	            <div class="col px-1
	            <!-- BEGIN background -->
	             row1
	            <!-- END background -->
	            ">
	
	              <!-- The button that is shown when the block is closed -->
	              <!-- BEGIN openclose -->
	              <div onclick="ShowHide('block1_{right_blocks_row.BLOCKID}','block2_{right_blocks_row.BLOCKID}','block1_{right_blocks_row.BLOCKID}');" style="display: none; width:100%; cursor: pointer;" id="block2_{right_blocks_row.BLOCKID}" >
	                <img src="{right_blocks_row.openclose.OPEN_IMG}" alt="" />
	              </div>
	        	  <!-- END openclose -->
	
	        	  <!-- The div cell that is closed when the collapse block button is clicked -->
	        	  <div id="block1_{right_blocks_row.BLOCKID}" style="display: block; position: relative;" >{right_blocks_row.OUTPUT}
	        	  <!-- The button that is shown when the block is open.  Note that it is within the collapsible cell and therefore disappears when the block closes -->
	        	  <!-- BEGIN openclose -->
	        	  <div onclick="ShowHide('block1_{right_blocks_row.BLOCKID}','block2_{right_blocks_row.BLOCKID}','block1_{right_blocks_row.BLOCKID}');" style="width:100%; cursor: pointer;"><img src="{right_blocks_row.openclose.CLOSE_IMG}" alt="" /></div>
	        	  <!-- END openclose -->
	        	  </div>
	            </div>
	          </div>
		    </div>
		    <br />
	    	  <script>
	    	  <!--
	    	  tmp = 'block1_{right_blocks_row.BLOCKID}';
	    	  if(GetCookie(tmp) == '2')
	    	  {
	    		ShowHide('block1_{right_blocks_row.BLOCKID}','block2_{right_blocks_row.BLOCKID}','block1_{right_blocks_row.BLOCKID}');
	    	  }
	    	  //-->
	    	  </script>
		
		       <!-- END right_blocks_row -->
    	  </div>
    	</div>
      </div>
	</div>

	<!-- BEGIN layout_collapse -->
    <div class="sp-col" id="right_hide" style="display: none;"><a href="javascript:ShowHide('right_block','right_hide','right_block');"><img src="{layout_collapse.LAYOUT_IMAGEL}" width="10" height="18" alt="" /></a></div>
 	<!-- END layout_collapse -->
	<!-- BEGIN no_layout_collapse -->
	<div class="sp-col"><img src="images/spacer.gif" alt="" width="10" height="30" /></div>
	<!-- END no_layout_collapse -->

  </div>
 </div>

<script>
<!--
tmp = 'right_block';
if(GetCookie(tmp) == '2')
{
	ShowHide('right_block','right_hide','right_block');
}
//-->
</script>