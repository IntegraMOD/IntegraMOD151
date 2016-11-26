<!-- mod : profile cp -->
<script type="text/javascript">
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
<script type="text/javascript" src="templates/no_thread_stretch.js"></script>
<script type="text/javascript">
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
		<td colspan="2" width="100%" class="maintitle" >{TOPIC_TITLE}</td>
	</tr>
	<tr>
		<td width="50%"class="maintitle" valign="top">&nbsp;</td>
		<td width="50%" class="gensmall" align="right" valign="bottom" nowrap="nowrap">

		<ul class="genbtn uct">
			<a href="{U_VIEW_OLDER_TOPIC}"><li class="fa fa-arrow-left fa-2x" title="{L_VIEW_PREVIOUS_TOPIC}"></li></a>
			<a href="{U_PRINTER_TOPIC}"><li class="fa fa-print fa-2x" title="{L_PRINTER_TOPIC}"></li></a>
		<!-- BEGIN switch_logged_in -->
			<a href="tellafriend.php?topic={TOPIC_TITLE2}&link={TELL_LINK}"><li class="fa fa-envelope-o fa-2x" title="{L_TELL_FRIEND}"></li></a>
		<!-- END switch_logged_in -->
			<a href="{U_SEARCH}"><li class="fa fa-search fa-2x" title="{L_SEARCH}"></li></a>
			<li class="fa fa-21">{S_WATCH_TOPIC_IMG}</li>
		<!-- BEGIN bookmark_state -->
			<a href="{U_BOOKMARK_ACTION}"><li class="fa fa-bookmark-o fa-2x" title="{L_BOOKMARK_ACTION}"></li></a>
		<!-- END bookmark_state -->
		<!-- BEGIN switch_logged_in -->
			<a href="{U_PRIVATEMSGS}"><li class="fa fa-comments-o fa-2x" title="{L_PRIVATEMSGS}"></li></a>
		<!-- END switch_logged_in -->
		
			<a href="{U_POSTINGS_POPUP}" onClick="NewWindow(this.href,'PopupWin');return false" onFocus="this.blur()";><li class="fa fa-user-times fa-2x" title="{L_POPUP_MESSAGE}"></li></a>
			<a href="{U_EXPORT}"><li class="fa fa-external-link fa-2x" title="{L_EXPORT}"></li></a>
			<a href="#bot"><li class="fa fa-arrow-down fa-2x" title="{L_TOPIC_DOWN_IMAGE}"></li></a>
			<a href="{U_VIEW_NEWER_TOPIC}"><li class="fa fa-arrow-right fa-2x" title="{L_VIEW_NEXT_TOPIC}"></li></a>
		</ul>


		</td>
	</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
		<td align="{S_CONTENT_FLOW_BEGIN}" width="100%" valign="middle" nowrap="nowrap">
		<!-- BEGIN is_auth_post -->
		<a class="postbtn" href="{U_POST_NEW_TOPIC}"><span>{L_POST_NEW_TOPIC}</span></a>
		<!-- END is_auth_post -->
		<!-- BEGIN is_auth_reply -->
		<a class="postbtn" href="{U_POST_REPLY_TOPIC}"><span>{L_POST_REPLY_TOPIC}</span></a>
		<!-- END is_auth_reply -->
		</td>
		<td nowrap="nowrap" class="nav" align="right">{BANNER_14_IMG}<br/>{PAGINATION}</td>
	</tr>
</table>
<br />
{POLL_DISPLAY}

<table class="forumline shadow" width="100%" cellspacing="1" cellpadding="3" border="0">
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


					<div class="divTable">
						<div class="divTableBody">
							<!-- Start add - Yellow card admin MOD -->
							<form method="post" action="{postrow.S_CARD}">
							<!-- End add - Yellow card admin MOD -->
							<div class="divTableRow">
								<div class="divTableCell postdetails"><a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" /></a>{L_POSTED}: {postrow.POST_DATE}<br />{L_POST_SUBJECT}: {postrow.POST_SUBJECT}</div>
								<div class="divTableCell" style="white-space:nowrap;">{postrow.QUOTE_IMG}{postrow.EDIT_IMG}{postrow.DELETE_IMG}<a class="icon_return_top" href="#top" title="{L_BACK_TO_TOP}"><img src="{ICON_UP_IMAGE}" alt="{L_BACK_TO_TOP}" title="{L_BACK_TO_TOP}" /></a>{postrow.IP_IMG}{postrow.U_R_CARD}{postrow.U_Y_CARD}{postrow.U_G_CARD}{postrow.U_B_CARD}{postrow.CARD_EXTRA_SPACE}{postrow.CARD_HIDDEN_FIELDS}</div>
							</div>
							<!-- Start add - Yellow card admin MOD -->
							</form>
							<!-- End add - Yellow card admin MOD -->
						</div>
					</div>
					<div class="divTable">
						<div class="divTableBody">
							<div class="divTableRow">
								<div class="divTableCell postbody">
									<hr />
									<div class="postoverflow">{postrow.MESSAGE}</div>
								</div>
							</div>
							<div class="divTableRow">
								<div class="divTableCell">{postrow.ATTACHMENTS}<span class="postdetails">{postrow.EDITED_MESSAGE}</span></div>
							</div>
							<div class="divTableRow">
								<div class="divTableCell"><br /> <span class="genmed">{postrow.SIGNATURE}</span></div>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<!-- BEGIN switch_no_buddy_ignore -->
			<tr>
				<td class="{postrow.ROW_CLASS}" width="100%" colspan="2" valign="bottom">
				<div class="tbx">
					<ul class="lft uct one">
						{postrow.BUTTONS_PANEL}
					</ul>
					<ul class="one">
						<li class="rt"><span class="gen"><a class="fa fa-download fa-2x" href="{postrow.DOWNLOAD_POST}" title="{L_DOWNLOAD_POST}">&nbsp;</a>&nbsp;{postrow.POST_RATING}</span><li>
					</ul>
				</div>
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

			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell"><a class="postdetails" href="#" onClick="toggle('{postrow.POST_ID}'); return false;">{L_IGNORE_CHOOSEN} </a></div>
						<div class="divTableCell">{postrow.IGNORE_IMG}</div>
					</div>
				</div>
			</div>

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
<br />
<table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
		<td align="{S_CONTENT_FLOW_BEGIN}" width="100%" valign="middle" nowrap="nowrap">
		<!-- BEGIN is_auth_post -->
		<a class="postbtn" href="{U_POST_NEW_TOPIC}"><span>{L_POST_NEW_TOPIC}</span></a>
		<!-- END is_auth_post -->
		<!-- BEGIN is_auth_reply -->
		<a class="postbtn" href="{U_POST_REPLY_TOPIC}"><span>{L_POST_REPLY_TOPIC}</span></a>
		<a class="postbtn fast-reply" href="javascript:void(0);" title="" onclick="this.blur();"><span>{L_QUICK_LOFI}</span></a>
		<!-- END is_auth_reply -->
		</td>
		<td width="100%" class="nav">&nbsp;</td>
		<td nowrap="nowrap" class="nav">{PAGINATION}</td>
	</tr>
</table>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="2">
	<tr>
		<td width="30%">{S_TOPIC_ADMIN}</td>
		<td width="70%" class="gensmall" align="right" valign="top" nowrap="nowrap">
			<ul class="genbtn uct">
			<a href="{U_VIEW_OLDER_TOPIC}"><li class="fa fa-arrow-left fa-2x"title="{L_VIEW_PREVIOUS_TOPIC}"></li></a>
			<a href="{U_PRINTER_TOPIC}"><li class="fa fa-print fa-2x" title="{L_PRINTER_TOPIC}"></li></a>
		<!-- BEGIN switch_logged_in -->
			<a href="tellafriend.php?topic={TOPIC_TITLE2}&link={TELL_LINK}"><li class="fa fa-envelope-o fa-2x" title="{L_TELL_FRIEND}"></li></a>
		<!-- END switch_logged_in -->
			<a href="{U_SEARCH}"><li class="fa fa-search fa-2x" title="{L_SEARCH}"></li></a>
			<li class="fa fa-21">{S_WATCH_TOPIC_IMG}</li>
		<!-- BEGIN bookmark_state -->
			<a href="{U_BOOKMARK_ACTION}"><li class="fa fa-bookmark-o fa-2x" title="{L_BOOKMARK_ACTION}"></li></a>
		<!-- END bookmark_state -->
		<!-- BEGIN switch_logged_in -->
			<a href="{U_PRIVATEMSGS}"><li class="fa fa-comments-o fa-2x" title="{L_PRIVATEMSGS}"></li></a>
		<!-- END switch_logged_in -->
		
			<a href="{U_POSTINGS_POPUP}" onClick="NewWindow(this.href,'PopupWin');return false" onFocus="this.blur()";><li class="fa fa-user-times fa-2x" title="{L_POPUP_MESSAGE}"></li></a>
			<a href="{U_EXPORT}"><li class="fa fa-external-link fa-2x" title="{L_EXPORT}"></li></a>
			<a href="#top"><li class="fa fa-arrow-up fa-2x" title="{L_TOPIC_UP_IMAGE}"></li></a>
			<a href="{U_VIEW_NEWER_TOPIC}"><li class="fa fa-arrow-right fa-2x" title="{L_VIEW_NEXT_TOPIC}"></li></a>
		    </ul>
		</td>
	</tr>
</table>
<div class="fastreply">{QUICK_REPLY_FORM}</div>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
	<tr>
		<td>
		<br />
		{JUMPBOX}
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
		<td width="40%" align="right">
			<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="left">
			{S_AUTH_LIST}
			</td></tr></table>
		</td>
	</tr>
	<tr>
		<td align="center" valign="bottom" colspan="2">{BANNER_15_IMG}</td>
	</tr>
</table>