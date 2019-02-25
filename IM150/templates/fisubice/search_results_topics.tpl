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
<table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
		<td colspan="2" class="maintitle">{L_SEARCH_MATCHES}</td>
	</tr>
	<tr>
		<td width="100%" class="nav"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_SEPARATOR}<a href="{U_SEARCH}">{L_SEARCH}</a>{NAV_SEPARATOR}{L_SEARCH_MATCHES}</td>
		<td nowrap="nowrap" class="nav">{PAGINATION}</td>
	</tr>
</table>
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
<th colspan="2">{L_FORUM}</th>
<th>{L_TOPICS}</th>
<th>{L_AUTHOR}</th>
<th>{L_REPLIES}</th>
<th>{L_VIEWS}</th>
<th>{L_LASTPOST}</th>
</tr>
<!-- BEGIN searchresults -->
<tr>
<td width="4%" class="row1"><img src="{searchresults.TOPIC_FOLDER_IMG}" alt="{searchresults.L_TOPIC_FOLDER_ALT}" title="{searchresults.L_TOPIC_FOLDER_ALT}" /></td>
<td height="50%" class="row1"><strong><a href="{searchresults.U_VIEW_FORUM}">{searchresults.FORUM_NAME}</a></strong></td>
<td height="50%" class="row2"><span class="topictitle">{searchresults.MINICLOCK}{searchresults.NEWEST_POST_IMG}{searchresults.TOPIC_TYPE}<a href="{searchresults.U_VIEW_TOPIC}">{searchresults.TOPIC_TITLE}</a></span><br />
<span class="gensmall">{searchresults.GOTO_PAGE}</span></td>
<td class="row1" align="center"><span class="genmed">&nbsp;{searchresults.TOPIC_AUTHOR}&nbsp;</span></td>
<td class="row2" align="center"><span class="gensmall"><a href="{searchresults.U_POSTINGS_POPUP}" onclick="NewWindow(this.href,'PopupWin');return false" onfocus="this.blur()"; title="{L_POPUP_MESSAGE}">{searchresults.REPLIES}</a></span></td>
<td class="row1" align="center"><span class="gensmall">{searchresults.VIEWS}</span></td>
<td class="row2" align="center" nowrap="nowrap"><span class="gensmall">{searchresults.LAST_POST_TIME}<br />
{searchresults.LAST_POST_AUTHOR} {searchresults.LAST_POST_IMG}</span></td>
</tr>
<!-- END searchresults -->
<tr>
<td class="cat" colspan="7">&nbsp;</td>
</tr>
</table>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
		<td width="100%" class="nav"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_SEPARATOR}<a href="{U_SEARCH}">{L_SEARCH}</a>{NAV_SEPARATOR}{L_SEARCH_MATCHES}</td>
		<td nowrap="nowrap" class="nav">{PAGINATION}</td>
	</tr>
	<tr>
		<td colspan="2"><br />
			{JUMPBOX}</td>
	</tr>
</table>
