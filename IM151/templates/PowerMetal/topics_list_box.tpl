<script language="javascript" type="text/javascript">
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
<!-- BEGIN multi_selection -->
<script language="Javascript" type="text/javascript">
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
<table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif"width="8" height="23" border="0" alt=""></td> 
   <td width="100%" background="templates/PowerMetal/images/blk_tm.gif" align="center" class="genmed" >&nbsp;<strong>{topics_list_box.row.L_TITLE}</strong>&nbsp;<img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="blkr" src="templates/PowerMetal/images/blk_trc.gif" width="77" height="23" border="0" alt=""></td>
  </tr>
  	</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="tlc" src="templates/PowerMetal/images/tlc.gif" width="8" height="6" border="0" alt=""></td> 
   <td width="100%" background="templates/PowerMetal/images/tm.gif"><img name="tm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="trc" src="templates/PowerMetal/images/trc.gif" width="8" height="6" border="0" alt=""></td>
  </tr>
  <tr>
    <td background="templates/PowerMetal/images/left.gif"><img name="left" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
        <td valign="top" bgcolor="#484848">
<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
<tr> 
	<th colspan="{topics_list_box.row.header_table.COLSPAN}" align="center" nowrap="nowrap">&nbsp;{topics_list_box.row.L_TITLE}&nbsp;</th>
	<th width="50" align="center" nowrap="nowrap">&nbsp;{topics_list_box.row.L_REPLIES}&nbsp;</th>
	<th width="100" align="center" nowrap="nowrap">&nbsp;{topics_list_box.row.L_AUTHOR}&nbsp;</th>
	<th width="50" align="center" nowrap="nowrap">&nbsp;{topics_list_box.row.L_VIEWS}&nbsp;</th>
	<th width="150" align="center" nowrap="nowrap">&nbsp;{topics_list_box.row.L_LASTPOST}&nbsp;</th>
	<!-- BEGIN multi_selection -->
	<th width="20" align="center" nowrap="nowrap"><input type="checkbox" name="all_mark_{topics_list_box.row.header_table.BOX_ID}" value="0" onClick="check_uncheck_all_{topics_list_box.row.header_table.BOX_ID}();" /></th>
	<!-- END multi_selection -->
</tr>
<!-- END header_table -->
<!-- BEGIN header_row -->
<tr>
	<td class="row3" colspan="{topics_list_box.row.COLSPAN}"><span class="gensmall">&nbsp;&nbsp;<b>{topics_list_box.row.L_TITLE}</b></span></td>
</tr>
<!-- END header_row -->
<!-- BEGIN topic -->
<!-- <tr onclick="window.location.href='{topics_list_box.row.U_VIEW_TOPIC}'" style="cursor: pointer; cursor: hand"> -->
<!-- temp fix for firefox ctrl click -->
<tr>
	<!-- BEGIN single_selection -->
	<td class="{topics_list_box.row.ROW_CLASS}" align="center" valign="middle" width="20"><input type="radio" name="{topics_list_box.FIELDNAME}" value="{topics_list_box.row.FID}" {topics_list_box.row.L_SELECT} /></td>
	<!-- END single_selection -->
	<td class="{topics_list_box.row.ROW_FOLDER_CLASS}" align="center" valign="middle" ><img src="{topics_list_box.row.TOPIC_FOLDER_IMG}" alt="{topics_list_box.row.L_TOPIC_FOLDER_ALT}" title="{topics_list_box.row.L_TOPIC_FOLDER_ALT}" /></td>
	<!-- BEGIN icon -->
	<td class="{topics_list_box.row.ROW_CLASS}" align="center" valign="middle" width="20">{topics_list_box.row.ICON}</td>
	<!-- END icon -->
	<td class="{topics_list_box.row.ROW_CLASS}" width="100%"  onMouseOver="this.className='row2'" onMouseOut="this.className='{topics_list_box.row.ROW_CLASS}'">
		<span class="topictitle">{topics_list_box.row.MINICLOCK}{topics_list_box.row.NEWEST_POST_IMG}{topics_list_box.row.TOPIC_ATTACHMENT_IMG}{topics_list_box.row.L_NEWS}{topics_list_box.row.TOPIC_TYPE}</span><span class="gensmall">{topics_list_box.row.TOPIC_INFO}</span><span class="topictitle"><a href="{topics_list_box.row.U_VIEW_TOPIC}" class="topictitle">{topics_list_box.row.TOPIC_TITLE}</a></span>&nbsp;<span>{topics_list_box.row.RATING}</span><span class="gensmall">&nbsp;&nbsp;{topics_list_box.row.TOPIC_ANNOUNCES_DATES}
		{topics_list_box.row.TOPIC_DESCRIPTION}<br />
	      {topics_list_box.row.TOPIC_CALENDAR_DATES}</span>
		<span class="gensmall">
			{topics_list_box.row.GOTO_PAGE}
			<!-- BEGIN nav_tree -->
			{topics_list_box.row.TOPIC_NAV_TREE}
			<!-- END nav_tree -->
		</span>
	</td>
	<td class="row1" align="center" valign="middle"><span class="postdetails"><a href="{topics_list_box.row.U_POSTINGS_POPUP}" onclick="NewWindow(this.href,'PopupWin');return false" onfocus="this.blur()"; title="{L_POPUP_MESSAGE}">{topics_list_box.row.REPLIES}</a></span></td>
	<td class="row3" align="center" valign="middle"><span class="name">{topics_list_box.row.TOPIC_AUTHOR}</span></td>
	<td class="row1" align="center" valign="middle"><span class="postdetails">{topics_list_box.row.VIEWS}</span></td>
	<td class="row3" align="center" valign="middle" nowrap="nowrap"><span class="postdetails">{topics_list_box.row.LAST_POST_TIME}<br />{topics_list_box.row.LAST_POST_AUTHOR} {topics_list_box.row.LAST_POST_IMG}</span></td>
	<!-- BEGIN multi_selection -->
	<td class="row2" align="center" valign="middle"><span class="postdetails"><input type="checkbox" name="{topics_list_box.FIELDNAME}[]{topics_list_box.row.BOX_ID}" value="{topics_list_box.row.FID}" onClick="javascript:check_uncheck_main_{topics_list_box.row.BOX_ID}();" {topics_list_box.row.L_SELECT} /></span></td>
	<!-- END multi_selection -->
</tr>
<!-- END topic -->
<!-- BEGIN no_topics -->
<tr> 
	<td class="row1" colspan="{topics_list_box.row.COLSPAN}" height="30" align="center" valign="middle"><span class="gen">{topics_list_box.row.L_NO_TOPICS}</span></td>
</tr>
<!-- END no_topics -->
<!-- BEGIN bottom -->
<tr> 
	<td class="cat" colspan="{topics_list_box.row.COLSPAN}" align="center" valign="middle"><span class="genmed">{topics_list_box.row.FOOTER}</span></td>
</tr>
<!-- END bottom -->
<!-- BEGIN footer_table -->
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>

    </td>
    <td background="templates/PowerMetal/images/right.gif"><img name="right" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
   <td><img name="blc" src="templates/PowerMetal/images/blc.gif" width="8" height="8" border="0" alt=""></td>
    <td background="templates/PowerMetal/images/btm.gif"><img name="btm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="brc" src="templates/PowerMetal/images/brc.gif" width="8" height="8" border="0" alt=""></td>
  </tr></table>
<!-- END footer_table -->
<!-- END row -->
<!-- END topics_list_box -->
<br />