<script language="javascript" type="text/javascript">
<!--

function NextWindow(page)
{
	window.opener.location.href(page);
	self.close();
}
// -->
</script>

<title>{PAGE_TITLE}</title>

<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th colspan="2" align="center" class="row1">{L_TOPIC}&nbsp;:{TITLE_BREAK}{TOPIC_TITLE}</th>
	</tr>
	<tr>
		<th colspan="2" align="center" class="row1" nowrap="nowrap">{L_TOTAL_POSTS}&nbsp;:&nbsp;{TOTAL_TOPICS}</th>
	</tr>
	<tr> 
		<td class="row3"><span class="name">&nbsp;&nbsp;&nbsp;{L_USER}</span></td>
		<td align="center" class="row3"><span class="name">{L_POSTS}</span></td>
	</tr>
	<!-- BEGIN topicrow -->
	<tr>
		<td class="row1"><span class="name">{topicrow.FLAG}<a href="{topicrow.POSTER_URL}" onclick="NextWindow(this.href);return false"; title="{L_PROFILE_MESSAGE}">{topicrow.POSTER}</a></span></td>

		<td class="row1" align="center"><span class="name"><a href="{topicrow.POSTS_URL}" onclick="NextWindow(this.href);return false"; title="{L_POSTS_MESSAGE}">{topicrow.POSTS}</a></span></td>
	</tr>
	<!-- END topicrow -->
	<tr>
		<td colspan="2" align="left"class="row3"><span class="name">*&nbsp;=&nbsp;{L_AUTHOR}</span></td>
	</tr>
	<tr>
		<td colspan="2" align="center"class="row3"><span class="name">{L_VIEW_TOPIC}&nbsp;:{TITLE_BREAK}<a href="{TOPIC_URL}" onclick="NextWindow(this.href);return false";>{TOPIC_TITLE}</a></span></td>
	</tr>
	<tr>
		<td colspan="2" align="center"class="row3"><span class="name">{L_CLOSE_WINDOW}</span></td>
	</tr>
</table>