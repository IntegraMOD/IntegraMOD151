<!-- The button that is shown when the column is closed -->
<!-- BEGIN layout_collapse -->
<div class="sp-col" id="tail_hide" style="display: none;" align="left" width="10" height="18"><a href="JavaScript:ShowHide('tail_block','tail_hide','tail_block');"><img src="{layout_collapse.LAYOUT_IMAGER}" width="10" height="18" alt="" /></a></div>
<!-- END layout_collapse -->

<!-- The spacer image that replaces the above button when the collapsible layout is turned off -->
<!-- BEGIN no_layout_collapse -->
<div class="sp-col" width="10"><img src="{no_layout_collapse.SPACER}" alt="" width="10" height="30" /></div>
<!-- END no_layout_collapse -->

<!-- The td cell that closes when the collapse column button is clicked -->
<div class="col-xs-3 m-0" id="tail_block" style="display: block; min-width:126px !important;">

  <div class="container-fluid">
    <div class="row">
      <div class="col px-0 align-top">
        <!-- The start of the header block -->
        <!-- BEGIN tail_blocks_row -->
        <div class="container-fluid 
        <!-- BEGIN border -->
         forumline
        <!-- END border -->
         ">

          <!-- Shown when the title is text -->
          <!-- BEGIN title -->
          <div class="row th pt-1 pl-1">{tail_blocks_row.title.TITLE}</div>
          <!-- END title -->

          <!-- Shown when the title is an image -->
          <!-- BEGIN title_image -->
          <div class="row th pt-1"><img src="{tail_blocks_row.title_image.TITLE}" width="17" height="15" alt="" /></div>
          <!-- END title_image -->

          <div class="row">
            <div class="col px-1 
            <!-- BEGIN background -->
             row1
            <!-- END background -->
            ">

              <!-- The button that is shown when the block is closed -->
              <!-- BEGIN openclose -->
              <div onclick="ShowHide('block1_{tail_blocks_row.BLOCKID}','block2_{tail_blocks_row.BLOCKID}','block1_{tail_blocks_row.BLOCKID}');" style="display: none; width:100%; cursor: pointer;" id="block2_{tail_blocks_row.BLOCKID}" >
                <img src="{tail_blocks_row.openclose.OPEN_IMG}" alt="" />
              </div>
        	  <!-- END openclose -->

        	  <!-- The div cell that is closed when the collapse block button is clicked -->
        	  <div id="block1_{tail_blocks_row.BLOCKID}" style="display: block; position: relative;" >{tail_blocks_row.OUTPUT}
        	  <!-- The button that is shown when the block is open.  Note that it is within the collapsible cell and therefore disappears when the block closes -->
        	  <!-- BEGIN openclose -->
        	  <div onclick="ShowHide('block1_{tail_blocks_row.BLOCKID}','block2_{tail_blocks_row.BLOCKID}','block1_{tail_blocks_row.BLOCKID}');" style="width:100%; cursor: pointer;"><img src="{tail_blocks_row.openclose.CLOSE_IMG}" alt="" /></div>
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
		tmp = 'block1_{tail_blocks_row.BLOCKID}';
		if(GetCookie(tmp) == '2')
		{
			ShowHide('block1_{tail_blocks_row.BLOCKID}','block2_{tail_blocks_row.BLOCKID}','block1_{tail_blocks_row.BLOCKID}');
		}
		//-->
		</script>
		<!-- END openclose -->

<!-- END tail_blocks_row -->
      </div>

	  <!-- The button that is shown when the column is open.  Note that it is within the collapsible cell and therefore disappears when the column closes -->
	  <!-- BEGIN layout_collapse -->
	  <div class="sp-col" style="display: block; cursor: pointer;" align="left" width="10" height="18"><a href="JavaScript:ShowHide('tail_block','tail_hide','tail_block');"><img src="{layout_collapse.LAYOUT_IMAGEL}" alt="" width="10" height="18" /></a></div>
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
tmp = 'tail_block';
if(GetCookie(tmp) == '2')
{
	ShowHide('tail_block','tail_hide','tail_block');
}
//-->
</script>
