<script language="JavaScript" type="text/javascript" src="templates/no_thread_stretch.js"></script>
<script language="JavaScript" type="text/javascript">
<!--
no_thread_stretch({BLOCK_WIDTH}+240);

message = new Array();
<!-- BEGIN postrow -->
message[{postrow.U_POST_ID}] = "[quote=\"{postrow.POSTER_NAME}\";p=\"{postrow.U_POST_ID}\"]\n{postrow.PLAIN_MESSAGE}\n[/quote]";
<!-- END postrow -->

function addquote(post_id) {

	window.parent.document.post.message.value += message[post_id];
	window.parent.document.post.message.focus();
	return;
}

//-->
</script>
<br />
<!-- BEGIN switch_inline_mode -->
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
<tr>
<td class="cat" align="center">{L_TOPIC_REVIEW}</td>
</tr>
<tr>
<td class="row1"><iframe width="100%" height="300" src="{U_REVIEW_TOPIC}" frameborder="0" scrolling="yes">
<!-- END switch_inline_mode -->
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
<tr>
<th width="22%">{L_AUTHOR}</th>
<th>{L_MESSAGE}</th>
</tr>
<!-- BEGIN postrow -->
<tr>
<td width="22%" valign="top" class="{postrow.ROW_CLASS}"><span class="name"><a name="{postrow.U_POST_ID}" id="{postrow.U_POST_ID}"></a>{postrow.POSTER_NAME}</span>
<br />
<img src="images/spacer.gif" alt="" width="150" height="1" /></td>
<td class="{postrow.ROW_CLASS}" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left"><img src="{postrow.MINI_POST_IMG}" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" /><span class="postdetails">{L_POSTED}:
{postrow.POST_DATE}&nbsp; &nbsp;{L_POST_SUBJECT}: {postrow.POST_SUBJECT}</span></td>
<td valign="top" align="right" nowrap="nowrap">&nbsp;<span class="genmed"><input type="button" class="button" name="addquote" value="{L_QUICK_QUOTE}" style="width: 50px" onClick="addquote({postrow.U_POST_ID});" /></span>&nbsp;</td>
</tr>
<tr>
<td colspan=2><hr /></td>
</tr>
<tr>
<td class="postbody" colspan=2 align="left">
<div class="postoverflow">{postrow.MESSAGE}</div>
{postrow.ATTACHMENTS}</td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan="2" height="1" class="spacerow"><img src="images/spacer.gif" alt="" width="1" height="1" /></td>
</tr>
<!-- END postrow -->
</table>
<!-- BEGIN switch_inline_mode -->
</iframe></td>
</tr>
</table>
<!-- END switch_inline_mode -->