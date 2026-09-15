<!-- mod : profile cp -->
<script>
<!--

function open_postreview(ref)
{
	height = screen.height / 3;
	width = screen.width / 2;
	window.open(ref, '_phpbbpostreview', 'HEIGHT=' + height + ',WIDTH=' + width + ',resizable=yes,scrollbars=yes');
	return;
}

//-->
</script>

<script src="templates/assets/js/no_thread_stretch.js"></script>

<script>
<!--

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


no_thread_stretch({BLOCK_WIDTH}+240);

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

jQuery.noConflict();
jQuery(document).ready(function($){
    // Hides the fastreply as soon as the DOM is ready
    // (a little sooner than page load)
    $('.fastreply').hide();
 
    // Toggles the fastreply on clicking the link
    $('a.fast-reply').click(function(e) {
        e.preventDefault();
        $('.fastreply').toggle(500);
    });
});
//-->
</script>

<h2><a href="{U_VIEW_TOPIC}">{TOPIC_TITLE}</a></h2><br />
<div class="buttons" style="float:right">
	<ul class="button button-bar uct gen">
		<a href="{U_VIEW_OLDER_TOPIC}"><li class="fa-solid fa-arrow-left fa-2x" title="{L_VIEW_PREVIOUS_TOPIC}"></li></a>
		<a href="{U_PRINTER_TOPIC}"><li class="fa-solid fa-print fa-2x" title="{L_PRINTER_TOPIC}"></li></a>
		<!-- BEGIN switch_logged_in -->
		<!-- IF S_REPORT_TOPIC -->
		<li><span class="">{S_REPORT_TOPIC}</span></li>
		<!-- ENDIF -->
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
		<a href="#bottom"><li class="fa-solid fa-arrow-dowwn fa-2x" title="{L_TOPIC_DOWN_IMAGE}"></li></a>
		<a href="{U_VIEW_NEWER_TOPIC}"><li class="fa-solid fa-arrow-right fa-2x" title="{L_VIEW_NEXT_TOPIC}"></li></a>
	</ul>
</div>
<div class="clear"></div>

<div class="topic-actions">
	<div class="lbuttons"><a href="{U_POST_NEW_TOPIC}" class="button icon-button post-icon" title="{L_POST_NEW_TOPIC}">{L_POST_NEW_TOPIC}</a><a href="{U_POST_REPLY_TOPIC}" class="button icon-button post-icon" title="{L_POST_REPLY_TOPIC}">{L_POST_REPLY_TOPIC}</a></div>
	<div class="pagination">{PAGE_NUMBER}&nbsp; <span>{PAGINATION}</span></div>
</div>
<div class="clear"></div>
{POLL_DISPLAY}
<!-- BEGIN postrow -->
<div id="{postrow.U_POST_ID}" class="panel post {postrow.ROW_CLASS}">
	<div class="inner"><span class="corners-top"><span></span></span>
	<div class="postbody">
		<ul class="post-buttons">
			<li><a href="{postrow.U_QUOTE}" title="{L_QUOTE}" class="button icon-button quote-icon"><span>{L_QUOTE}</span></a></li>
			<li><a href="{postrow.U_EDIT}" title="{L_EDIT_POST}" class="button icon-button edit-icon"><span>{L_EDIT_POST}</span></a></li>
			<li><a href="{postrow.U_DELETE}" title="{L_DELETE_POST}" class="button icon-button delete-icon"><span>{L_DELETE_POST}</span></a></li>
			<li><a href="{postrow.U_VIEW_IP}" title="{L_VIEW_IP}" class="button icon-button info-icon"><span>{L_VIEW_IP}</span></a></li>
		</ul>
		<h3 class="first"><a href="{postrow.U_MINI_POST}">{postrow.POST_SUBJECT}</a></h3>
		<p class="author"><a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" alt="" /></a> <strong>{postrow.POSTER_NAME}</strong> &raquo; {postrow.POST_DATE}</p>
		<div class="content">{postrow.MESSAGE}</div>
		{postrow.EDITED_MESSAGE}{postrow.SIGNATURE}
	</div>
	<dl class="postprofile">
		<dt>{postrow.POSTER_AVATAR}</a><br /><strong>{postrow.POSTER_NAME}</strong></dt>
		<dd>{postrow.POSTER_RANK}<br />{postrow.RANK_IMAGE}</dd>
		<dd>&nbsp;</dd>
		<dd>{postrow.POSTER_POSTS}</dd>
		<dd>{postrow.POSTER_JOINED}</dd>
		<dd>{postrow.POSTER_FROM}</dd>
		<dd>
		    <ul class="profile-icons">
			{postrow.PM_IMG}
			{postrow.PROFILE_IMG}
			{postrow.EMAIL_IMG}
			{postrow.WWW_IMG}
			{postrow.DC_IMG}
			{postrow.FB_IMG}			
			{postrow.IG_IMG}
			{postrow.LI_IMG}			
			{postrow.PT_IMG}
			{postrow.SKP_IMG}
			{postrow.TG_IMG}
			{postrow.TT_IMG}
			{postrow.TWR_IMG}
			{postrow.ICQ_IMG}
		  </ul>
		</dd>
	</dl>
	<div class="back2top"><a href="#wrap" class="top" title="{L_BACK_TO_TOP}">{L_BACK_TO_TOP}</a></div>
	<span class="corners-bottom"><span></span></span></div>
</div>
<hr class="divider" />
<!-- END postrow -->
<form method="post" action="{S_POST_DAYS_ACTION}">
<fieldset class="display-options" style="margin-top: 0; ">
	<label>{L_DISPLAY_POSTS}: {S_SELECT_POST_DAYS}&nbsp;{S_SELECT_POST_ORDER}&nbsp;<span class="res"><input type="submit" name="sort" value="{L_GO}" class="button2" /></span></label>
</fieldset>
</form>
<hr />
<div class="topic-actions">
    <!-- BEGIN is_auth_post -->
	<div class="lbuttons">
	<!-- END is_auth_post -->
	<!-- BEGIN is_auth_reply -->
	<a href="{U_POST_NEW_TOPIC}" class="button icon-button post-icon" title="{L_POST_NEW_TOPIC}">{L_POST_NEW_TOPIC}</a>
	<a href="{U_POST_REPLY_TOPIC}" class="button icon-button post-icon" title="{L_POST_REPLY_TOPIC}">{L_POST_REPLY_TOPIC}</a>
	<a href="javascript:void(0);" class="button icon-button post-icon  fast-reply" title="{L_QUICK_LOFI}" onclick="this.blur();">{L_QUICK_LOFI}</a>
	<!-- END is_auth_reply -->
	</div>
	<div class="pagination">{PAGE_NUMBER}&nbsp; <span>{PAGINATION}</span></div>
</div>
<div class="buttons" style="float:right">
	<ul class="button button-bar uct gen">
		<a href="{U_VIEW_OLDER_TOPIC}"><li class="fa-solid fa-arrow-left fa-2x" title="{L_VIEW_PREVIOUS_TOPIC}"></li></a>
		<a href="{U_PRINTER_TOPIC}"><li class="fa-solid fa-print fa-2x" title="{L_PRINTER_TOPIC}"></li></a>
		<!-- BEGIN switch_logged_in -->
		<!-- IF S_REPORT_TOPIC -->
		<li><span class="">{S_REPORT_TOPIC}</span></li>
		<!-- ENDIF -->
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
<div class="clear"></div>
<div class="action-bar top">
    <div class="pagination">
        {S_AUTH_LIST}
    </div>
</div>
<div class="fastreply">{QUICK_REPLY_FORM}<br /></div>
<div class="jumpbox bdr">{JUMPBOX}</div>
<div class="clear bdr"></div>
<!-- BEGIN switch_info -->
<div class="topic-info">
    <form method="post" action="{S_INFO_ACTION}">
        <fieldset>
            <label>{L_TOPIC_INFO}:</label>
            <input type="text" name="topic_info" maxlength="20" size="20" value="{TOPIC_INFO}" class="inputbox autowidth" />
            <input type="submit" name="submit_topic_info" value="{L_GO}" class="button2" />
        </fieldset>
    </form>
</div>
<!-- END switch_info -->
<br />
{S_TOPIC_ADMIN}
<div class="clear"></div>
<!-- BEGIN switch_banner_15 -->
	<div class="forabg">
	    <div class="inner">
	        <span class="corners-top"><span></span></span>
	        <ul class="topiclist">
	            <li class="header">
	                <dl class="icon">
	                    <dt>{BANNER_15_IMG}</dt>
	                </dl>
	            </li>
	        </ul>
	        <span class="corners-bottom"><span></span></span>
	    </div>
	</div>
<!-- END switch_banner_15 -->