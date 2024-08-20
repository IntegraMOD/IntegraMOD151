<!-- mod : profile cp -->
<script>
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
<script src="templates/assets/js/no_thread_stretch.js"></script>
<script>
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
<script>
// <![CDATA[
jQuery.noConflict();
jQuery(document).ready(function(){
 	// hides the fastreply as soon as the DOM is ready
 	// (a little sooner than page load)
  	jQuery('#fastreply').hide();
 	// toggles the infobox on clicking the noted link
  	jQuery('a#fast-reply').click(function() {
 		jQuery('#fastreply').toggle(400);
 		return false;
  	});

	jQuery(function(){
		jQuery('a[rel="external"]').attr('target','_blank');
	});
});
	// ]]>
</script>

  <div class="container-fluid px-0">
    <div class="row"> 
      <div class="col">
        <span class="nav gen"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_CAT_DESC}</span>
      </div>
    </div>
  </div>
  <div class="container-fluid px-0">
    <div class="row"> 
      <div class="col maintitle">{TOPIC_TITLE}</div>
    </div>
    <div class="row"> 
      <div class="col d-inline text-end">
	    <ul class="genbtn uct gen pt-2 align-middle">
		  <a href="{U_VIEW_OLDER_TOPIC}"><li class="fa-solid fa-arrow-left fa-2x" title="{L_VIEW_PREVIOUS_TOPIC}"></li></a>
		  <!-- IF S_REPORT_TOPIC -->
		  <li><span class="">{S_REPORT_TOPIC}</span></li>
		  <!-- ENDIF -->
		  <a href="{U_PRINTER_TOPIC}"><li class="fa-solid fa-print fa-2x" title="{L_PRINTER_TOPIC}"></li></a>
		  <!-- BEGIN switch_logged_in -->
		  <a href="tellafriend.php?topic={TOPIC_TITLE2}&link={TELL_LINK}"><li class="fa-regular fa-envelope fa-2x" title="{L_TELL_FRIEND}"></li></a>
		  <!-- END switch_logged_in -->
		  <a href="{U_SEARCH}"><li class="fa-solid fa-search fa-2x" title="{L_SEARCH}"></li></a>
		  <li><span class="">{S_WATCH_TOPIC_IMG}</span></li>
		  <!-- BEGIN bookmark_state -->
		  <a href="{U_BOOKMARK_ACTION}"><li class="fa-regular fa-bookmark fa-2x" title="{L_BOOKMARK_ACTION}"></li></a>
		  <!-- END bookmark_state -->
		  <!-- BEGIN switch_logged_in -->
		  <a href="{U_PRIVATEMSGS}"><li class="fa-regular fa-message fa-2x" title="{L_PRIVATEMSGS}"></li></a>
		  <!-- END switch_logged_in -->
		  <a href="{U_POSTINGS_POPUP}" onClick="NewWindow(this.href,'PopupWin');return false" onFocus="this.blur()";><li class="fa-solid fa-clipboard-user fa-2x" title="{L_POPUP_MESSAGE}"></a>
		  <a href="{U_EXPORT}"><li class="fa-solid fa-arrow-up-right-from-square fa-2x" title="{L_EXPORT}"></li></a>
		  <a href="#bot"><li class="fa-solid fa-arrow-down fa-2x" title="{L_TOPIC_DOWN_IMAGE}"></li></a>
		  <a href="{U_VIEW_NEWER_TOPIC}"><li class="fa-solid fa-arrow-right fa-2x" title="{L_VIEW_NEXT_TOPIC}"></li></a>
        </ul>
      </div>
    </div>
  </div>
  <div class="container-fluid px-0 mb-3">
    <div class="row"> 
      <div class="col">
		<!-- BEGIN is_auth_post -->
		<a class="postbtn" href="{U_POST_NEW_TOPIC}"><i class="fa-regular fa-file fa1 me-1"></i>{L_POST_NEW_TOPIC}</a>
		<!-- END is_auth_post -->
		<!-- BEGIN is_auth_reply -->
		<a class="postbtn" href="{U_POST_REPLY_TOPIC}"><i class="fa-solid fa-reply fa1 me-1"></i>{L_POST_REPLY_TOPIC}</a>
		<!-- END is_auth_reply -->
      </div>
	  <!-- BEGIN switch_banner_14 -->
      <div class="col">
		{BANNER_14_IMG}
      </div>
	  <!-- END switch_banner_14 -->
    </div>
    <div class="row"> 
      <div class="col">{PAGINATION}</div>
    </div>
  </div>

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
							<td valign="top" nowrap="nowrap" style="text-align:right;">{postrow.QUOTE_IMG}{postrow.EDIT_IMG}{postrow.DELETE_IMG}<a href="#top" title="{L_BACK_TO_TOP}"><img src="{ICON_UP_IMAGE}" alt="{L_BACK_TO_TOP}" title="{L_BACK_TO_TOP}" /></a>{postrow.IP_IMG}{postrow.U_R_CARD}{postrow.U_Y_CARD}{postrow.U_G_CARD}{postrow.U_B_CARD}{postrow.CARD_EXTRA_SPACE}{postrow.CARD_HIDDEN_FIELDS}&nbsp;</td>
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
								<span class="gen"><a href="{postrow.DOWNLOAD_POST}" class="genmed"><img src="{ICON_DISK_IMAGE}"  alt="{L_DOWNLOAD_POST}" title="{L_DOWNLOAD_POST}" /></a>&nbsp;{postrow.POST_RATING}&nbsp;&nbsp;{postrow.QUICK_QUOTE}</span>
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






  <div class="container-fluid pe-0">
    <div class="row"> 
      <div class="col nav gen"><a href="{U_INDEX}">{L_INDEX}</a> {NAV_CAT_DESC}</div>
    </div>
    <!-- BEGIN ratingsbox -->
    <div class="row"> 
      <div class="col pe-0 gen text-end">
		<form method="get" name="ratingsbox" action="{ratingsbox.U_RATINGS}">
		<input type="hidden" name="forum_id" value="{FORUM_ID}">
		<select name="type">
		<option value="">{ratingsbox.L_LATEST_RATINGS}</option>
		<option value="p">{ratingsbox.L_HIGHEST_RANKED_POSTS}</option>
		<option value="t">{ratingsbox.L_HIGHEST_RANKED_TOPICS}</option>
		<option value="u">{ratingsbox.L_HIGHEST_RANKED_POSTERS}</option>
		</select>&nbsp;<input type="submit" value="Go" class="liteoption" />
		</form>
	  </div>
	</div>
    <!-- END ratingsbox -->
  </div>

  <div class="container-fluid px-0 my-2">
    <div class="row"> 
      <div class="col">
		<!-- BEGIN is_auth_post -->
		<a class="postbtn" href="{U_POST_NEW_TOPIC}"><i class="fa-regular fa-file fa1 me-1"></i>{L_POST_NEW_TOPIC}</a>
		<!-- END is_auth_post -->
		<!-- BEGIN is_auth_reply -->
		<a class="postbtn" href="{U_POST_REPLY_TOPIC}"><i class="fa-solid fa-reply fa1 me-1"></i>{L_POST_REPLY_TOPIC}</a>
		<a class="postbtn" id="fast-reply" href="javascript:void(0);" title="" onclick="this.blur();"><i class="fa-solid fa-reply-all fa1 me-1"></i>{L_QUICK_LOFI}</a>
		<!-- END is_auth_reply -->
      </div>
    </div>
    <div class="row"> 
      <div class="col">{PAGINATION}</div>
    </div>
  </div>
  <div class="container-fluid px-0">
    <div class="row">
      <div class="col-7">
	    <div class="row"> 
	      <div class="col text-start nw my-2">{S_TOPIC_ADMIN}</div>
	    </div>
	    <div class="row"> 
	      <div class="col" id="fastreply">{QUICK_REPLY_FORM}</div>
	    </div>
      </div>
      <div class="col-5">

		<div class="row"> 
		  <div class="col d-inline text-end">
			<ul class="genbtn uct gen pt-2 align-middle">
			  <a href="{U_VIEW_OLDER_TOPIC}"><li class="fa-solid fa-arrow-left fa-2x" title="{L_VIEW_PREVIOUS_TOPIC}"></li></a>
			  <!-- IF S_REPORT_TOPIC -->
			  <li><span class="">{S_REPORT_TOPIC}</span></li>
			  <!-- ENDIF -->
			  <a href="{U_PRINTER_TOPIC}"><li class="fa-solid fa-print fa-2x" title="{L_PRINTER_TOPIC}"></li></a>
			  <!-- BEGIN switch_logged_in -->
			  <a href="tellafriend.php?topic={TOPIC_TITLE2}&link={TELL_LINK}"><li class="fa-regular fa-envelope fa-2x" title="{L_TELL_FRIEND}"></li></a>
			  <!-- END switch_logged_in -->
			  <a href="{U_SEARCH}"><li class="fa-solid fa-search fa-2x" title="{L_SEARCH}"></li></a>
			  <li><span class="">{S_WATCH_TOPIC_IMG}</span></li>
			  <!-- BEGIN bookmark_state -->
			  <a href="{U_BOOKMARK_ACTION}"><li class="fa-regular fa-bookmark fa-2x" title="{L_BOOKMARK_ACTION}"></li></a>
			  <!-- END bookmark_state -->
			  <!-- BEGIN switch_logged_in -->
			  <a href="{U_PRIVATEMSGS}"><li class="fa-regular fa-message fa-2x" title="{L_PRIVATEMSGS}"></li></a>
			  <!-- END switch_logged_in -->
			  <a href="{U_POSTINGS_POPUP}" onClick="NewWindow(this.href,'PopupWin');return false" onFocus="this.blur()";><li class="fa-solid fa-clipboard-user fa-2x" title="{L_POPUP_MESSAGE}"></a>
			  <a href="{U_EXPORT}"><li class="fa-solid fa-arrow-up-right-from-square fa-2x" title="{L_EXPORT}"></li></a>
			  <a href="#top"><li class="fa-solid fa-arrow-up fa-2x" title="{L_TOPIC_UP_IMAGE}"></li></a>
			  <a href="{U_VIEW_NEWER_TOPIC}"><li class="fa-solid fa-arrow-right fa-2x" title="{L_VIEW_NEXT_TOPIC}"></li></a>
			</ul>
		  </div>
		</div>

	    <!-- BEGIN switch_info -->
	    <div class="row">
	      <div class="col text-end">
		    <form method="post" action="{S_INFO_ACTION}"><span class="gensmall">{L_TOPIC_INFO}:&nbsp;
			<input type="text" name="topic_info" maxlength="20" size="20" value="{TOPIC_INFO}">&nbsp;&nbsp;<input type="submit" name="submit_topic_info" value="{L_GO}" class="liteoption" /></span>
			</form>
	      </div>
	    </div>
	    <!-- END switch_info -->
	    <div class="row">
	      <div class="col pe-0 my-2 text-end">{JUMPBOX}</div>
	    </div>
	    <div class="row"> 
	      <div class="col text-end">{S_AUTH_LIST}</div>
		</div>
      </div>
    </div>
  </div>
  <!-- BEGIN switch_banner_15 -->		
  <div class="container-fluid px-0">
    <div class="row"> 
      <div class="col">{BANNER_15_IMG}</div>
    </div>
  </div>
  <!-- END switch_banner_15 -->
