<style>
/*
div.col {border: 1px #000000 solid !important; }
.row  {border: 1px #41b829 solid !important; }
 */
</style>

<script>
<!--
function NewWindow(mypage,myname)
{
	settings='width=250,height=300,top=0,left=0,toolbar=no,location=no,directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes';
	PopupWin=window.open(mypage,myname,settings);
	PopupWin.focus();
}
// -->
</script>
<!-- BEGIN topics_list_box -->
<!-- BEGIN row -->
<!-- BEGIN header_table -->
<div class="container-fluid">
  <div class="row my-auto"> 
    <div class="col nav pl-0 gen"><a href="{catrow.U_VIEWCAT}" class="cattitle">{catrow.CAT_DESC}</a></div>
  </div>
</div>
<!-- BEGIN multi_selection -->
<script>
<!--
//
// checkbox selection management
function check_uncheck_main_{topics_list_box.row.header_table.BOX_ID}()
{
	var all_checked = true;
	for (i = 0; (i < document.{topics_list_box.FORMNAME}.elements.length) && all_checked; i++)
	{
		if (document.{topics_list_box.FORMNAME}.elements[i].name == '{topics_list_box.FIELDNAME}[]{topics_list_box.row.header_table.BOX_ID}')
		{
			all_checked =  document.{topics_list_box.FORMNAME}.elements[i].checked;
		}
	}
	document.{topics_list_box.FORMNAME}.all_mark_{topics_list_box.row.header_table.BOX_ID}.checked = all_checked;
}
// check/uncheck all
function check_uncheck_all_{topics_list_box.row.header_table.BOX_ID}()
{
	for (i = 0; i < document.{topics_list_box.FORMNAME}.length; i++)
	{
		if (document.{topics_list_box.FORMNAME}.elements[i].name == '{topics_list_box.FIELDNAME}[]{topics_list_box.row.header_table.BOX_ID}')
		{
			document.{topics_list_box.FORMNAME}.elements[i].checked = document.{topics_list_box.FORMNAME}.all_mark_{topics_list_box.row.header_table.BOX_ID}.checked;
		}
	}
}
// -->
</script>
<!-- END multi_selection -->
<div class="container tbt">
<div class="row">
  <div class="col"><img src="{TEMPLATE}images/spacer.gif" alt="" height="22" /></div>
  <div class="col"><b></b><span class="gen"><a href="{catrow.U_VIEWCAT}" class="cattitle">{catrow.CAT_DESC}</a></span></div>
  <div class="col"><img src="{TEMPLATE}images/spacer.gif" alt="" height="22" /></div>
</div>
</div>

<div class="container-fluid forumline">
  <div class="row d-flex justify-content-end th px-0">
	<div class="col pt-1">{topics_list_box.row.L_TITLE}</div>
	<div class="col-1 pt-1 px-0">{topics_list_box.row.L_REPLIES}</div>
	<div class="col-2 pt-1 ctr">{topics_list_box.row.L_AUTHOR}</div>
	<div class="col-1 pt-1 px-0">{topics_list_box.row.L_VIEWS}</div>
 	<div class="col-2 pt-1 ctr">{topics_list_box.row.L_LASTPOST}</div>
    <!-- BEGIN multi_selection -->
	<div class="col-1 pt-1 ctr"><input type="checkbox" name="all_mark_{topics_list_box.row.header_table.BOX_ID}" value="0" onClick="check_uncheck_all_{topics_list_box.row.header_table.BOX_ID}();" /></div>
    <!-- END multi_selection -->
  </div>
<!-- END header_table -->
<!-- BEGIN header_row -->
  <div class="row"> 
    <div class="col row2 gensmall mx-0 py-2"><b>{topics_list_box.row.L_TITLE}</b></div>
  </div>
<!-- END header_row -->
<!-- BEGIN topic -->
  <div class="row d-flex justify-content-end nowrap px-0" onclick="window.location.href='{topics_list_box.row.U_VIEW_TOPIC}'" style="cursor: pointer; cursor: hand">
	<div class="col nav hr5">
	  <!-- BEGIN single_selection -->
	  <div class="px-1 py-2 {topics_list_box.row.ROW_CLASS}"><input type="radio" name="{topics_list_box.FIELDNAME}" value="{topics_list_box.row.FID}" {topics_list_box.row.L_SELECT} /></div>
	  <!-- END single_selection -->
	  <div class="px-1 py-2 {topics_list_box.row.ROW_FOLDER_CLASS}"><img src="{topics_list_box.row.TOPIC_FOLDER_IMG}" alt="{topics_list_box.row.L_TOPIC_FOLDER_ALT}" title="{topics_list_box.row.L_TOPIC_FOLDER_ALT}" /></div>
      <!-- BEGIN icon -->
	  <div class="{topics_list_box.row.ROW_CLASS} py-2 pt-1">{topics_list_box.row.ICON}</div>
      <!-- END icon -->
	  <div class="hr5 py-2 {topics_list_box.row.ROW_CLASS}" onMouseOver="this.className='hr5 py-2 row2'" onMouseOut="this.className='hr5 py-2 {topics_list_box.row.ROW_CLASS}'">
        <span class="topictitle">{topics_list_box.row.MINICLOCK}{topics_list_box.row.NEWEST_POST_IMG}{topics_list_box.row.TOPIC_ATTACHMENT_IMG}{topics_list_box.row.L_NEWS}{topics_list_box.row.TOPIC_TYPE}</span><span class="gensmall">{topics_list_box.row.TOPIC_INFO}</span><span class="topictitle"><a href="{topics_list_box.row.U_VIEW_TOPIC}" class="topictitle">{topics_list_box.row.TOPIC_TITLE}</a></span>&nbsp;<span>{topics_list_box.row.RATING}</span><span class="gensmall">&nbsp;&nbsp;{topics_list_box.row.TOPIC_ANNOUNCES_DATES}{topics_list_box.row.TOPIC_DESCRIPTION}<br />{topics_list_box.row.TOPIC_CALENDAR_DATES}</span>
	    <span class="gensmall">{topics_list_box.row.GOTO_PAGE}
	    <!-- BEGIN nav_tree -->
	    {topics_list_box.row.TOPIC_NAV_TREE}
	    <!-- END nav_tree -->
	    </span>
      </div>
	</div>
	<div class="{topics_list_box.row.ROW_CLASS} col-1 pt-2 ctr postdetails" onMouseOver="this.className='col-1 pt-2 ctr postdetails row2'" onMouseOut="this.className='col-1 pt-2 ctr postdetails {topics_list_box.row.ROW_CLASS}'"><a href="{topics_list_box.row.U_POSTINGS_POPUP}" onclick="NewWindow(this.href,'PopupWin');return false" onfocus="this.blur()"; title="{L_POPUP_MESSAGE}">{topics_list_box.row.REPLIES}</a></div>
	<div class="{topics_list_box.row.ROW_CLASS} col-2 pt-2 hr5 ctr name" onMouseOver="this.className='col-2 pt-2 hr5 ctr name row2'" onMouseOut="this.className='col-2 pt-2 hr5 ctr name {topics_list_box.row.ROW_CLASS}'">{topics_list_box.row.TOPIC_AUTHOR}</div>
	<div class="{topics_list_box.row.ROW_CLASS} col-1 pt-2 hr5 ctr postdetails"   onMouseOver="this.className='col-1 pt-2 hr5 ctr postdetails row2'" onMouseOut="this.className='col-1 pt-2 hr5 ctr postdetails {topics_list_box.row.ROW_CLASS}'">{topics_list_box.row.VIEWS}</div>
	<div class="{topics_list_box.row.ROW_CLASS} col-2 pt-2 hr5 postdetails"  onMouseOver="this.className='col-2 pt-2 hr5 postdetails row2'" onMouseOut="this.className='col-2 pt-2 hr5 postdetails {topics_list_box.row.ROW_CLASS}'" onclick="window.location.href='{topics_list_box.row.U_VIEW_TOPIC}'">{topics_list_box.row.LAST_POST_TIME}<br />{topics_list_box.row.LAST_POST_AUTHOR} {topics_list_box.row.LAST_POST_IMG}</div>
	
	<div class="{topics_list_box.row.ROW_CLASS} col-1 pt-2 postdetails" onMouseOver="this.className='col-1 pt-2 postdetails row2'" onMouseOut="this.className='col-1 pt-2 postdetails {topics_list_box.row.ROW_CLASS}'">
	  <!-- BEGIN multi_selection -->
	  <input type="checkbox" name="{topics_list_box.FIELDNAME}[]{topics_list_box.row.BOX_ID}" value="{topics_list_box.row.FID}" onClick="javascript:check_uncheck_main_{topics_list_box.row.BOX_ID}();" {topics_list_box.row.L_SELECT} />
	  <!-- END multi_selection -->
	</div>
	
  </div>
<!-- END topic -->
<!-- BEGIN no_topics -->
  <div class="row"> 
    <div class="col row2 gensmall gen mx-3">{topics_list_box.row.L_NO_TOPICS}</div>
  </div>
<!-- END no_topics -->
<!-- BEGIN bottom -->
  <div class="row"> 
    <div class="col catBottom text-center genmed gen pt-1 mx-0">{topics_list_box.row.FOOTER}</div>
  </div>
<!-- END bottom -->
<!-- BEGIN footer_table -->
</div>
<!-- END footer_table -->
<!-- END row -->
<!-- END topics_list_box -->
<br />