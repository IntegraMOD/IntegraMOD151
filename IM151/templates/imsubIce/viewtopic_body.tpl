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
<!--
<script src="templates/_js/no_thread_stretch.js"></script>
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

no_thread_stretch({BLOCK_WIDTH}+320);

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
-->
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
      <div class="col maintitle">{TOPIC_TITLE}</div>
    </div>
    <div class="row"> 
      <div class="col navbr gen my-2 d-inline-flex"><a href="{U_INDEX}">{L_INDEX}</a> {NAV_CAT_DESC}</div>
    </div>
	    <div class="row" id="vttop"> 
          <div class="col text-end">
	        <ul class="genbtn uct gen nw">
			  <a href="{U_VIEW_OLDER_TOPIC}"><li class="fa-regular fa-circle-left py-2 fa-xl" title="{L_VIEW_PREVIOUS_TOPIC}"></li></a>
			  <a href="{U_PRINTER_TOPIC}"><li class="fa-solid fa-print py-2 fa-xl" title="{L_PRINTER_TOPIC}"></li></a>
			  <!-- BEGIN switch_logged_in -->
			  <a href="tellafriend.php?topic={TOPIC_TITLE2}&link={TELL_LINK}"><li class="fa-regular fa-envelope py-2 fa-xl" title="{L_TELL_FRIEND}"></li></a>
			  <!-- END switch_logged_in -->
			  <a href="{U_SEARCH}"><li class="fa-solid fa-magnifying-glass py-2 fa-xl" title="{L_SEARCH}"></li></a>
		      <li class="twtp">{S_WATCH_TOPIC_IMG}</li>
			  <!-- BEGIN bookmark_state -->
			  <a href="{U_BOOKMARK_ACTION}"><li class="fa-regular fa-bookmark py-2 fa-xl" title="{L_BOOKMARK_ACTION}"></li></a>
			  <!-- END bookmark_state -->
			  <!-- BEGIN switch_logged_in -->
			  <a href="{U_PRIVATEMSGS}"><li class="fa-regular fa-comments py-2 fa-xl" title="{L_PRIVATEMSGS}"></li></a>
			  <!-- END switch_logged_in -->
			  <a href="{U_POSTINGS_POPUP}" onClick="NewWindow(this.href,'PopupWin');return false" onFocus="this.blur()";><li class="fa-solid fa-list-ol py-2 fa-xl" title="{L_POPUP_MESSAGE}"></li></a>
			  <a href="{U_EXPORT}"><li class="fa-solid fa-up-right-from-square py-2 fa-xl" title="{L_EXPORT}"></li></a>
			  <a href="#vtbtm"><li class="fa-regular fa-circle-down py-2 fa-xl" title="{L_TOPIC_DOWN_IMAGE}"></li></a>
			  <a href="{U_VIEW_NEWER_TOPIC}"><li class="fa-regular fa-circle-right py-2 fa-xl" title="{L_VIEW_NEXT_TOPIC}"></li></a>
	        </ul>
	      </div>
	    </div>
  </div>
  <div class="container-fluid px-0 mb-3">
    <div class="row"> 
      <div class="col">
		<!-- BEGIN is_auth_post -->
	    <a class="postbtn" href="{U_POST_NEW_TOPIC}"><i class="fa-solid fa-file-pen"></i>&nbsp;{L_POST_NEW_TOPIC}</a>
		<!-- END is_auth_post -->
		<!-- BEGIN is_auth_reply -->
		<a class="postbtn" href="{U_POST_REPLY_TOPIC}"><i class="fa-solid fa-file-signature"></i>&nbsp;{L_POST_REPLY_TOPIC}</a>
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

  <div class="forumline">
    <div class="row mx-0">
	  <div class="col-2 th d-flex align-items-center">{L_AUTHOR}</div>
      <div class="col th d-flex align-items-center">{L_MESSAGE}</div>
    </div>
    <!-- BEGIN postrow -->
    <!-- BEGIN switch_buddy_ignore -->
    <div class="container-fluid d-none" id="post_{postrow.POST_ID}">
    <!-- END switch_buddy_ignore -->
    <div class="row mx-0">
	  <div class="col-2 hr3 {postrow.ROW_CLASS}"><span class="name"><a name="{postrow.U_POST_ID}" id="{postrow.U_POST_ID}"></a>{postrow.AUTHOR_PANEL}<img src="{TEMPLATE}images/spacer.gif" alt="" height="1" /></span></div>
	  <div class="col {postrow.ROW_CLASS}">
        <div class="container-fluid">
	      <div class="row mx-0">
		    <!-- Start add - Yellow card admin MOD -->
		    <form method="post" action="{postrow.S_CARD}">
		    <!-- End add - Yellow card admin MOD -->
		    <div class="col-5 gensmall"><a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" /></a>{L_POSTED}: {postrow.POST_DATE}<br />{L_POST_SUBJECT}: {postrow.POST_SUBJECT}</div>
		    <div class="col text-end">
			  <ul class="uct">			
				<li>{postrow.QUOTE_IMG}</li>
				<li>{postrow.EDIT_IMG}</li>
				<li>{postrow.DELETE_IMG}</li>
				<li class="pt-1"><a href="#top" title="{L_BACK_TO_TOP}"><img src="{ICON_UP_IMAGE}" alt="{L_BACK_TO_TOP}" title="{L_BACK_TO_TOP}" /></a></li>
				<li>{postrow.IP_IMG}</li>
				<li>{postrow.U_R_CARD}</li>
				<li>{postrow.U_Y_CARD}</li>
				<li>{postrow.U_G_CARD}</li>
				<li>{postrow.U_B_CARD}</li>
				<li>{postrow.CARD_EXTRA_SPACE}</li>
				<li>{postrow.CARD_HIDDEN_FIELDS}</li>
			  </ul>
			</div>
		    <!-- Start add - Yellow card admin MOD -->
		    </form>
		    <!-- End add - Yellow card admin MOD -->
		  </div>
	    </div>
        <div class="container-fluid">
		  <div class="row">
		    <div class="col"><hr /><div class="postoverflow">{postrow.MESSAGE}</div></div>
		  </div>
		  <div class="row">
		    <div class="col">{postrow.ATTACHMENTS}<span class="postdetails">{postrow.EDITED_MESSAGE}</span></div>
		  </div>
		  <div class="row">
		   <div class="col"><br /><span class="genmed">{postrow.SIGNATURE}</span></div>
		  </div>
	    </div>
	  </div>
    </div>
	<!-- BEGIN switch_no_buddy_ignore -->
    <div class="container-fluid {postrow.ROW_CLASS} hr2" height="18">
      <div class="row mx-0">
        <div class="col pt-2 mb-0 text-nowrap">
	      {postrow.BUTTONS_PANEL}
	      <div class="col text-end"><span class="gen"><a href="{postrow.DOWNLOAD_POST}" class="genmed"><img src="{ICON_DISK_IMAGE}"  alt="{L_DOWNLOAD_POST}" title="{L_DOWNLOAD_POST}" /></a>&nbsp;{postrow.POST_RATING}&nbsp;&nbsp;{postrow.QUICK_QUOTE}</span></div>
		</div>
	  </div>
    </div>
    <!-- END switch_no_buddy_ignore -->
    <!-- BEGIN switch_buddy_ignore -->
    </div>
    <!-- END switch_buddy_ignore -->
    <!-- BEGIN switch_buddy_ignore -->
    <div class="row mx-0 {postrow.ROW_CLASS}">
	  <div class="col-2 hr3"><span class="navbr"><a href="#top" class="navbr">{L_BACK_TO_TOP}</a></span></div>
	  <div class="col">
	    <div class="container">
		  <div class="row">
	  	    <div class="col"><a href="#" onClick="toggle('{postrow.POST_ID}'); return false;" class="postdetails">{L_IGNORE_CHOOSEN} </a></div>
		    <div class="col">{postrow.IGNORE_IMG}</div>
		  </div>
	    </div>
	  </div>
    </div>
    <!-- END switch_buddy_ignore -->
    <!-- END postrow -->
    <div class="row mx-0 mt-2 {postrow.ROW_CLASS}">
	  <div class="col cat pt-2">
	    <form method="post" action="{S_POST_DAYS_ACTION}">
	    <div class="row mx-0">
	      <div class="col d-flex justify-content-center">{L_DISPLAY_POSTS}:&nbsp;{S_SELECT_POST_DAYS}&nbsp;{S_SELECT_POST_ORDER}&nbsp;<input type="submit" value="{L_GO}" class="catbutton" name="submit" /></div>
	    </div>
	    </form>
	  </div>
    </div>
  </div>
  <div class="container-fluid pr-0">
    <div class="row mx-0 {postrow.ROW_CLASS}"> 
      <div class="col navbr gen my-2 d-inline-flex"><a href="{U_INDEX}">{L_INDEX}</a> {NAV_CAT_DESC}</div>
    </div>
    <!-- BEGIN ratingsbox -->
    <div class="row"> 
      <div class="col pr-0 gen text-end">
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
    <div class="row mx-0 {postrow.ROW_CLASS}"> 
      <div class="col">
		<!-- BEGIN is_auth_post -->
	    <a class="postbtn" href="{U_POST_NEW_TOPIC}"><i class="fa-solid fa-file-pen"></i>&nbsp;{L_POST_NEW_TOPIC}</a>
		<!-- END is_auth_post -->
		<!-- BEGIN is_auth_reply -->
		<a class="postbtn" href="{U_POST_REPLY_TOPIC}"><i class="fa-solid fa-file-signature"></i>&nbsp;{L_POST_REPLY_TOPIC}</a>
		<a class="postbtn" data-bs-toggle="collapse" href="#fastreply" role="button" aria-expanded="false" aria-controls="fastreply"><i class="fa-solid fa-bolt"></i>&nbsp;{L_QUICK_LOFI}</a>
		<!-- END is_auth_reply -->
      </div>
    </div>
    <div class="row"> 
      <div class="col">{PAGINATION}</div>
    </div>
  </div>
  <div class="container-fluid px-0">
    <div class="row mx-0 {postrow.ROW_CLASS}">
      <div class="col-6">
	    <div class="row"> 
	      <div class="col text-start nw my-2">{S_TOPIC_ADMIN}</div>
	    </div>
	    <div class="row"> 
		  <div class="collapse" id="fastreply">
			<div class="card-body">{QUICK_REPLY_FORM}</div>
		  </div>
	    </div>
      </div>
      <div class="col-6">

        <div class="row" id="vtbtm"> 
          <div class="col text-end">
	        <ul class="genbtn uct gen nw">
			  <a href="{U_VIEW_OLDER_TOPIC}"><li class="fa-regular fa-circle-left py-2 fa-xl" title="{L_VIEW_PREVIOUS_TOPIC}"></li></a>
			  <a href="{U_PRINTER_TOPIC}"><li class="fa-solid fa-print py-2 fa-xl" title="{L_PRINTER_TOPIC}"></li></a>
			  <!-- BEGIN switch_logged_in -->
			  <a href="tellafriend.php?topic={TOPIC_TITLE2}&link={TELL_LINK}"><li class="fa-regular fa-envelope py-2 fa-xl" title="{L_TELL_FRIEND}"></li></a>
			  <!-- END switch_logged_in -->
			  <a href="{U_SEARCH}"><li class="fa-solid fa-magnifying-glass py-2 fa-xl" title="{L_SEARCH}"></li></a>
		      <li class="twtp">{S_WATCH_TOPIC_IMG}</li>
			  <!-- BEGIN bookmark_state -->
			  <a href="{U_BOOKMARK_ACTION}"><li class="fa-regular fa-bookmark py-2 fa-xl" title="{L_BOOKMARK_ACTION}"></li></a>
			  <!-- END bookmark_state -->
			  <!-- BEGIN switch_logged_in -->
			  <a href="{U_PRIVATEMSGS}"><li class="fa-regular fa-comments py-2 fa-xl" title="{L_PRIVATEMSGS}"></li></a>
			  <!-- END switch_logged_in -->
			  <a href="{U_POSTINGS_POPUP}" onClick="NewWindow(this.href,'PopupWin');return false" onFocus="this.blur()";><li class="fa-solid fa-list-ol py-2 fa-xl" title="{L_POPUP_MESSAGE}"></li></a>
			  <a href="{U_EXPORT}"><li class="fa-solid fa-up-right-from-square py-2 fa-xl" title="{L_EXPORT}"></li></a>
			  <a href="#vttop"><li class="fa-regular fa-circle-up py-2 fa-xl" title="{L_TOPIC_UP_IMAGE}"></li></a>
			  <a href="{U_VIEW_NEWER_TOPIC}"><li class="fa-regular fa-circle-right py-2 fa-xl" title="{L_VIEW_NEXT_TOPIC}"></li></a>
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
	      <div class="col pr-0 my-2 text-end">{JUMPBOX}</div>
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