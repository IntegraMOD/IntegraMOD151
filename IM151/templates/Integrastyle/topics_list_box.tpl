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
<table border="0" cellpadding="0" cellspacing="0" class="tbt"><tr><td class="tbtl"><img src="{TEMPLATE}images/spacer.gif" alt="" width="22" height="22" /></td><td class="tbtbot"><b></b><span class="gen"><a href="{catrow.U_VIEWCAT}" class="cattitle">{catrow.CAT_DESC}</a></span></td><td class="tbtr"><img src="{TEMPLATE}images/spacer.gif" alt="" width="124" height="22" /></td></tr></table>
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
	<td class="row2" colspan="{topics_list_box.row.COLSPAN}"><span class="gensmall">&nbsp;&nbsp;<b>{topics_list_box.row.L_TITLE}</b></span></td>
</tr>
<!-- END header_row -->
<!-- BEGIN topic -->
<tr onclick="window.location.href='{topics_list_box.row.U_VIEW_TOPIC}'" >
	<!-- BEGIN single_selection -->
	<td class="{topics_list_box.row.ROW_CLASS}" onMouseOver="this.className='row2'" onMouseOut="this.className='{topics_list_box.row.ROW_CLASS}'" align="center" valign="middle" width="20"><input type="radio" name="{topics_list_box.FIELDNAME}" value="{topics_list_box.row.FID}" {topics_list_box.row.L_SELECT} /></td>
	<!-- END single_selection -->
	<td class="{topics_list_box.row.ROW_FOLDER_CLASS}" onMouseOver="this.className='row2'" onMouseOut="this.className='{topics_list_box.row.ROW_FOLDER_CLASS}'" align="center" valign="middle" ><img src="{topics_list_box.row.TOPIC_FOLDER_IMG}" alt="{topics_list_box.row.L_TOPIC_FOLDER_ALT}" title="{topics_list_box.row.L_TOPIC_FOLDER_ALT}" /></td>
	<!-- BEGIN icon -->
	<td class="{topics_list_box.row.ROW_CLASS}" onMouseOver="this.className='row2'" onMouseOut="this.className='{topics_list_box.row.ROW_CLASS}'" align="center" valign="middle" width="20">{topics_list_box.row.ICON}</td>
	<!-- END icon -->
	<td class="{topics_list_box.row.ROW_CLASS}" onMouseOver="this.className='row2'" onMouseOut="this.className='{topics_list_box.row.ROW_CLASS}'" width="100%"  onMouseOver="this.className='row2'" onMouseOut="this.className='{topics_list_box.row.ROW_CLASS}'">
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
	<td class="row1" onMouseOver="this.className='row2'" onMouseOut="this.className='row1'"  align="center" valign="middle"><span class="postdetails"><a href="{topics_list_box.row.U_POSTINGS_POPUP}" onclick="NewWindow(this.href,'PopupWin');return false" onfocus="this.blur()"; title="{L_POPUP_MESSAGE}">{topics_list_box.row.REPLIES}</a></span></td>
	<td class="row1" onMouseOver="this.className='row2'" onMouseOut="this.className='row1'"  align="center" valign="middle"><span class="name">{topics_list_box.row.TOPIC_AUTHOR}</span></td>
	<td class="row1" onMouseOver="this.className='row2'" onMouseOut="this.className='row1'"  align="center" valign="middle"><span class="postdetails">{topics_list_box.row.VIEWS}</span></td>
	<td class="row1" onMouseOver="this.className='row2'" onMouseOut="this.className='row1'"  align="center" valign="middle" nowrap="nowrap" onclick="window.location.href='{topics_list_box.row.U_VIEW_TOPIC}'"><span class="postdetails">{topics_list_box.row.LAST_POST_TIME}<br />{topics_list_box.row.LAST_POST_AUTHOR} {topics_list_box.row.LAST_POST_IMG}</span></td>
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
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="{TEMPLATE}images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="{TEMPLATE}images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="{TEMPLATE}images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<!-- END footer_table -->
<!-- END row -->
<!-- END topics_list_box -->
<br />