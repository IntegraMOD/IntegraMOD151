<!-- mod : profile cp -->
<script language="Javascript" type="text/javascript">
// <![CDATA[
function open_postreview(ref)
{
	height = screen.height / 3;
	width = screen.width / 2;
	window.open(ref, '_phpbbpostreview', 'HEIGHT=' + height + ',WIDTH=' + width + ',resizable=yes,scrollbars=yes');
	return;
}

// ]]>
</script>
<script language="JavaScript" type="text/javascript" src="templates/no_thread_stretch.js"></script>
<script language="JavaScript" type="text/javascript">
// <![CDATA[
function NewWindow(mypage,myname)
{
	settings='width=250,height=300,top=0,left=0,toolbar=no,location=no,directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes';
	PopupWin=window.open(mypage,myname,settings);
	PopupWin.focus();
}
function ref(object)
{
	if (document.getElementById)
	{
		return document.getElementById(object);
	}
	else if (document.all)
	{
		return eval('document.all.' + object);
	}
	else
	{
		return false;
	}
}

function toggle(pobject)
{
	object = ref('post_' + pobject);

	if( !object.style )
	{
		return false;
	}

	if( object.style.display == 'none' )
	{
		object.style.display = '';
	}
	else
	{
		object.style.display = 'none';
	}
}

no_thread_stretch({BLOCK_WIDTH}+340);

message = new Array();
<!-- BEGIN postrow -->
	message[{postrow.U_POST_ID}] = "[quote=\"{postrow.POSTER_NAME}\";p=\"{postrow.U_POST_ID}\"]\n{postrow.PLAIN_MESSAGE}\n[/quote]";
<!-- END postrow -->

function addquote(post_id) 
{
	window.parent.document.post.input.value += message[post_id];
	window.parent.document.post.input.focus();
	return;
}
// ]]>
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<tr>
	<td width="100%" class="nav" colspan="2" ><a href="{U_INDEX}">{L_INDEX}</a> {NAV_CAT_DESC}</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="100%" class="maintitle" >{TOPIC_TITLE}</td>
</tr>
<tr>
	<td class="maintitle" valign="top">&nbsp;</td>
	<td class="gensmall" align="right" valign="bottom" nowrap="nowrap">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td><a href="{U_VIEW_OLDER_TOPIC}"><img src="{TOPIC_PREVIOUS_IMAGE}" alt="{L_VIEW_PREVIOUS_TOPIC}" title="{L_VIEW_PREVIOUS_TOPIC}" border="0" /></a></td>
				<td><a href="{U_PRINTER_TOPIC}"><img src="{TOPIC_PRINT_IMAGE}" border="0" alt="{L_PRINTER_TOPIC}" title="{L_PRINTER_TOPIC}" /></a></td>
				<!-- BEGIN switch_logged_in -->
				<td><a href="tellafriend.php?topic={TOPIC_TITLE2}&link={TELL_LINK}"><img src="{TOPIC_EMAIL_IMAGE}" border="0" alt="{L_TELL_FRIEND}" title="{L_TELL_FRIEND}" /></a></td>
				<!-- END switch_logged_in -->
				<td><a href="{U_SEARCH}"><img src="{TOPIC_SEARCH_IMAGE}" border="0" alt="{L_SEARCH}" title="{L_SEARCH}" /></a></td>
				<td>{S_WATCH_TOPIC_IMG}</td>
				<!-- BEGIN bookmark_state -->
				<td><a href="{U_BOOKMARK_ACTION}"><img src="{BM_IMG}" width="22" height="25" border="0" alt="{L_BOOKMARK_ACTION}" title="{L_BOOKMARK_ACTION}" /></a></td>
				<!-- END bookmark_state -->
				<!-- BEGIN switch_logged_in -->
				<td nowrap="nowrap"><a href="{U_PRIVATEMSGS}"><img src="{PRIVMSG_IMG}" border="0" alt="{L_PRIVATEMSGS}" title="{L_PRIVATEMSGS}" /></a></td>
				<!-- END switch_logged_in -->
				<td><a href="{U_POSTINGS_POPUP}" onClick="NewWindow(this.href,'PopupWin');return false" onFocus="this.blur()"; title="{L_POPUP_MESSAGE}"><img src="{TOPIC_WHO_POST_IMAGE}" border="0" alt="{L_POPUP_MESSAGE}" title="{L_POPUP_MESSAGE}" /></a></td>
				<td><a href="{U_EXPORT}"><img src="{TOPIC_EXPORT_IMAGE}" border="0" alt="{L_EXPORT}" title="{L_EXPORT}" /></a></td>
				<td><a href="#bot"><img src="{TOPIC_DOWN_IMAGE}" title="{L_TOPIC_DOWN_IMAGE}" border="0" alt="{L_GO_TO_BOTTOM}" /></a></td>
				<td><a href="{U_VIEW_NEWER_TOPIC}"><img src="{TOPIC_NEXT_IMAGE}" alt="{L_VIEW_NEXT_TOPIC}" title="{L_VIEW_NEXT_TOPIC}" border="0" /></a></td>
			</tr>
		</table>
	</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
		<td align="{S_CONTENT_FLOW_BEGIN}" width="100%" valign="middle" nowrap="nowrap">
		<!-- BEGIN is_auth_post -->
		<a class="button_new" href="{U_POST_NEW_TOPIC}"><span>{L_POST_NEW_TOPIC}</span></a>
		<!-- END is_auth_post -->
		<!-- BEGIN is_auth_reply -->
		<a class="button_reply" href="{U_POST_REPLY_TOPIC}"><span>{L_POST_REPLY_TOPIC}</span></a>
		<!-- END is_auth_reply -->
		</td>
		<td nowrap="nowrap" class="nav" align="right">{BANNER_14_IMG}<br/>{PAGINATION}</td>
	</tr>
</table>

{POLL_DISPLAY}

<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
	<tr>
		<th width="150" height="28">{L_AUTHOR}</th>
		<th width="100%">{L_MESSAGE}</th>
	</tr>
	<!-- BEGIN postrow -->
		<!-- BEGIN switch_buddy_ignore -->
		<tbody id="post_{postrow.POST_ID}" style="display:none">
		<!-- END switch_buddy_ignore -->
			<tr>
				<td valign="top" class="{postrow.ROW_CLASS}" ><span class="name"><a name="{postrow.U_POST_ID}" id="{postrow.U_POST_ID}"></a>{postrow.AUTHOR_PANEL}
					<img src="{TEMPLATE}images/spacer.gif" alt="" width="150" height="1" />
					</span>
				</td>
				<td class="{postrow.ROW_CLASS}" valign="top">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<!-- Start add - Yellow card admin MOD -->
							<form method="post" action="{postrow.S_CARD}">
							<!-- End add - Yellow card admin MOD -->
							<td class="postdetails"><a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" /></a>{L_POSTED}:
							{postrow.POST_DATE}&nbsp; &nbsp;{L_POST_SUBJECT}: {postrow.POST_SUBJECT}</td>
							<td valign="top" nowrap="nowrap" style="text-align:right;">{postrow.QUOTE_IMG}{postrow.EDIT_IMG}{postrow.DELETE_IMG}<a href="#top"><a href="#top"><img src="{ICON_UP_IMAGE}" alt="{L_BACK_TO_TOP}" title="{L_BACK_TO_TOP}" /></a>{postrow.IP_IMG}{postrow.U_R_CARD}{postrow.U_Y_CARD}{postrow.U_G_CARD}{postrow.U_B_CARD}{postrow.CARD_EXTRA_SPACE}{postrow.CARD_HIDDEN_FIELDS}&nbsp;</td>
							<!-- Start add - Yellow card admin MOD -->
							</form>
							<!-- End add - Yellow card admin MOD -->
						</tr>
					</table>
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td valign="top" class="postbody">
								<hr />
								<div class="postoverflow">{postrow.MESSAGE}</div>
							</td>
						</tr>
						<tr>
							<td valign="bottom" class="genmed">{postrow.ATTACHMENTS}<span class="postdetails">{postrow.EDITED_MESSAGE}</span></td>
						</tr>
						<tr>
							<td valign="bottom" class="{postrow.ROW_CLASS}"><br />
								<span class="genmed">{postrow.SIGNATURE}</span>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<!-- BEGIN switch_no_buddy_ignore -->
			
			<tr>
				<td class="{postrow.ROW_CLASS}" width="100%" colspan="2" valign="bottom" nowrap="nowrap">
					<table cellspacing="0" cellpadding="0" border="0" height="18" width="100%">
						<tr>
							{postrow.BUTTONS_PANEL}
							<td align="right" width="100%">
								<span class="gen"><a href="{postrow.DOWNLOAD_POST}" class="genmed"><img src="{ICON_DISK_IMAGE}" border="0" alt="{L_DOWNLOAD_POST}" title="{L_DOWNLOAD_POST}" /></a>&nbsp;{postrow.POST_RATING}&nbsp;&nbsp;{postrow.QUICK_QUOTE}</span>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<!-- END switch_no_buddy_ignore -->
			
			<!-- BEGIN switch_buddy_ignore -->
		</tbody>
		<!-- END switch_buddy_ignore -->
		<!-- BEGIN switch_buddy_ignore -->
		<tr>
			<td class="{postrow.ROW_CLASS}" width="150" align="left" valign="middle"><span class="nav"><a href="#top" class="nav">{L_BACK_TO_TOP}</a></span></td>
			<td class="{postrow.ROW_CLASS}" width="100%">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="100%"><a href="#" onClick="toggle('{postrow.POST_ID}'); return false;" class="postdetails">{L_IGNORE_CHOOSEN} </a></td>
						<td align="right">{postrow.IGNORE_IMG}</td>
					</tr>
				</table>
			</td>
		</tr>
		<!-- END switch_buddy_ignore -->
<!--	
		<tr>
			<td class="spacerow" colspan="2" height="1"><img src="{TEMPLATE}images/spacer.gif" alt="" width="1" height="1" /></td>
		</tr>
-->
		<!-- END postrow -->
	
	
		<tr>
			<td colspan="2" align="center" class="cat">
				<form method="post" action="{S_POST_DAYS_ACTION}">
					<table cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td class="gensmall">{L_DISPLAY_POSTS}:&nbsp;&nbsp;</td>
							<td>{S_SELECT_POST_DAYS}&nbsp;</td>
							<td>{S_SELECT_POST_ORDER}&nbsp;</td>
							<td><input type="submit" value="{L_GO}" class="catbutton" name="submit" /></td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</table>

	<table width="100%" cellspacing="2" cellpadding="2" border="0">
		<tr>
			<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a> {NAV_CAT_DESC}</td>
			<!-- BEGIN ratingsbox -->
			<td align="right" valign="middle">
				<form method="get" name="ratingsbox" action="{ratingsbox.U_RATINGS}">
					<input type="hidden" name="f" value="{FORUM_ID}">
					<select name="type">
					<option value="">{ratingsbox.L_LATEST_RATINGS}</option>
					<option value="p">{ratingsbox.L_HIGHEST_RANKED_POSTS}</option>
					<option value="t">{ratingsbox.L_HIGHEST_RANKED_TOPICS}</option>
					<option value="u">{ratingsbox.L_HIGHEST_RANKED_POSTERS}</option>
					</select>&nbsp;<input type="submit" value="Go" class="liteoption" />
				</form>
			</td>
			<!-- END ratingsbox -->
		</tr>
	</table>
	
	
	<table width="100%" cellspacing="2" cellpadding="2" border="0">
		<tr>
			<td align="{S_CONTENT_FLOW_BEGIN}" width="100%" valign="middle" nowrap="nowrap">
			<!-- BEGIN is_auth_post -->
			<a class="button_new" href="{U_POST_NEW_TOPIC}"><span>{L_POST_NEW_TOPIC}</span></a>
			<!-- END is_auth_post -->
			<!-- BEGIN is_auth_reply -->
			<a class="button_reply" href="{U_POST_REPLY_TOPIC}"><span>{L_POST_REPLY_TOPIC}</span></a>
			<a class="button button_qreply fast-reply" href="javascript:void(0);" title="" onclick="this.blur();"><span>{L_QUICK_LOFI}</span></a>
			<!-- END is_auth_reply -->
			</td>
			<td width="100%" class="nav">&nbsp;</td>
			<td nowrap="nowrap" class="nav">{PAGINATION}</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td width="100%">{S_TOPIC_ADMIN}</td>
		</tr>
		<tr>
			<td width="100%">
			<div class="fastreply">
			{QUICK_REPLY_FORM}<br />
			</div>
				<br />
				{JUMPBOX}<br />
				<!-- BEGIN switch_info -->
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td align="left" colspan="2">
								<form method="post" action="{S_INFO_ACTION}"><span class="gensmall">{L_TOPIC_INFO}:&nbsp;
								<input type="text" name="topic_info" maxlength="20" size="20" value="{TOPIC_INFO}">&nbsp;&nbsp;<input type="submit" name="submit_topic_info" value="{L_GO}" class="liteoption" /></span>
								</form>
							</td>
						</tr>
					</table>
				<!-- END switch_info -->


			</td>
			<td class="gensmall" align="right" valign="top" nowrap="nowrap">
				<table width="100%" cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td width="100%">&nbsp;</td>
						<td><a href="{U_VIEW_OLDER_TOPIC}"><img src="{TOPIC_PREVIOUS_IMAGE}" alt="{L_VIEW_PREVIOUS_TOPIC}" title="{L_VIEW_PREVIOUS_TOPIC}" border="0" /></a></td>
						<td><a href="{U_PRINTER_TOPIC}"><img src="{TOPIC_PRINT_IMAGE}" border="0" alt="{L_PRINTER_TOPIC}" title="{L_PRINTER_TOPIC}" /></a></td>
						<!-- BEGIN switch_logged_in -->
						<td><a href="tellafriend.php?topic={TOPIC_TITLE2}&link={TELL_LINK}"><img src="{TOPIC_EMAIL_IMAGE}" border="0" alt="{L_TELL_FRIEND}" title="{L_TELL_FRIEND}" /></a></td>
						<!-- END switch_logged_in -->
						<td><a href="{U_SEARCH}"><img src="{TOPIC_SEARCH_IMAGE}" border="0" alt="{L_SEARCH}" title="{L_SEARCH}" /></a></td>
						<td>{S_WATCH_TOPIC_IMG}</td>
						<!-- BEGIN bookmark_state -->
						<td><a href="{U_BOOKMARK_ACTION}"><img src="{BM_IMG}" width="22" height="25" border="0" alt="{L_BOOKMARK_ACTION}" title="{L_BOOKMARK_ACTION}" /></a></td>
						<!-- END bookmark_state -->
						<!-- BEGIN switch_logged_in -->
						<td nowrap="nowrap"><a href="{U_PRIVATEMSGS}"><img src="{PRIVMSG_IMG}" border="0" alt="{L_PRIVATEMSGS}" title="{L_PRIVATEMSGS}" /></a></td>
						<!-- END switch_logged_in -->
						<td><a href="{U_POSTINGS_POPUP}" onClick="NewWindow(this.href,'PopupWin');return false" onFocus="this.blur()"; title="{L_POPUP_MESSAGE}"><img src="{TOPIC_WHO_POST_IMAGE}" border="0" alt="{L_POPUP_MESSAGE}" title="{L_POPUP_MESSAGE}" /></a></td>
						<td><a href="{U_EXPORT}"><img src="{TOPIC_EXPORT_IMAGE}" border="0" alt="{L_EXPORT}" title="{L_EXPORT}" /></a></td>
						<td><a href="#top"><img src="{TOPIC_UP_IMAGE}" title="{L_TOPIC_UP_IMAGE}" border="0" alt="{L_GO_TO_TOP}" /></a></td>
						<td><a href="{U_VIEW_NEWER_TOPIC}"><img src="{TOPIC_NEXT_IMAGE}" alt="{L_VIEW_NEXT_TOPIC}" title="{L_VIEW_NEXT_TOPIC}" border="0" /></a></td>
					</tr>
				</table><br />
			
				{S_AUTH_LIST}
			</td>
		</tr>
		
		<tr>
			<td align="center" valign="bottom" colspan="2">{BANNER_15_IMG}</td>
		</tr>
		
	</table>