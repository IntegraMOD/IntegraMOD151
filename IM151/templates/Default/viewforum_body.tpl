<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
<td class="nav" width="100%">&nbsp;<a href="{U_INDEX}">{L_INDEX}</a> {NAV_CAT_DESC}</a></td>
</tr>
<tr>
<td class="maintitle"><a href="{U_VIEW_FORUM}">{FORUM_NAME}</a></td>
<td class="gensmall" align="right" valign="bottom" nowrap="nowrap">{L_MODERATOR}: {MODERATORS}<br />
{LOGGED_IN_USER_LIST}<br />
<strong><a href="{U_MARK_READ}">{L_MARK_TOPICS_READ}</a></strong></td>
</tr>
</table>
{BOARD_ANNOUNCES}
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr> 
<td><!-- BEGIN is_auth_post --> 
<a class="button_new" href="{U_POST_NEW_TOPIC}"><span>{L_POST_NEW_TOPIC}</span></a>
<!-- END is_auth_post --></td>
<td nowrap="nowrap" class="nav" align="right">
<!-- BEGIN switch_banner_13 -->
{BANNER_13_IMG}<br/>
<!-- END switch_banner_13 -->
{PAGINATION}</td>
</tr>
</table>
{BOARD_INDEX}
<form method="post" name="seesince" action="{U_VIEW_FORUM}">
{TOPICS_LIST_BOX}
</form> 
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<!-- BEGIN is_auth_post -->
<td align="left" nowrap="nowrap"><a class="button_new" href="{U_POST_NEW_TOPIC}"><span>{L_POST_NEW_TOPIC}</span></a></td>
<!-- END is_auth_post -->
<td align="right" class="nav">&nbsp;<a href="{U_INDEX}">{L_INDEX}</a> {NAV_CAT_DESC}</td>
<td nowrap="nowrap" class="nav">{PAGINATION}</td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<tr>
<td><br />{JUMPBOX}</td>
<!-- BEGIN ratingsbox -->
<td><br />
<form method="get" name="ratingsbox" action="{ratingsbox.U_RATINGS}">
<input type="hidden" name="forum_id" value="{FORUM_ID}">
<select name="type">
<option value="">{ratingsbox.L_LATEST_RATINGS}</option>
<option value="p">{ratingsbox.L_HIGHEST_RANKED_POSTS}</option>
<option value="t">{ratingsbox.L_HIGHEST_RANKED_TOPICS}</option>
<option value="u">{ratingsbox.L_HIGHEST_RANKED_POSTERS}</option>
</select>&nbsp;<input type="submit" value="Go" class="liteoption" />
</form><br />
</td>
<!-- END ratingsbox -->
<td class="gensmall" align="right" valign="top"><strong><a href="{U_MARK_READ}">{L_MARK_TOPICS_READ}</a></strong><br />
{L_MODERATOR}: {MODERATORS}<br />
{LOGGED_IN_USER_LIST}
</td>
</tr>
</table>
<br />
<table width="100%" cellspacing="0" border="0" align="center" cellpadding="0">
<tr>
<td valign="top">
<table border="0" cellspacing="1" cellpadding="0">
<tr>
<td><img src="{FOLDER_NEW_IMG}" alt="{L_NEW_POSTS}" title="{L_NEW_POSTS}" /></td>
<td class="gensmall">{L_NEW_POSTS}</td>
<td>&nbsp;</td>
<td><img src="{FOLDER_IMG}" alt="{L_NO_NEW_POSTS}" title="{L_NO_NEW_POSTS}" /></td>
<td class="gensmall">{L_NO_NEW_POSTS}</td>
<td>&nbsp;</td>
<td><img src="{FOLDER_ANNOUNCE_IMG}" alt="{L_ANNOUNCEMENT}" title="{L_ANNOUNCEMENT}" /></td>
<td class="gensmall">{L_ANNOUNCEMENT}</td>
</tr>
<tr>
<td><img src="{FOLDER_HOT_NEW_IMG}" alt="{L_NEW_POSTS_HOT}" title="{L_NEW_POSTS_HOT}" /></td>
<td class="gensmall">{L_NEW_POSTS_HOT}</td>
<td>&nbsp;</td>
<td><img src="{FOLDER_HOT_IMG}" alt="{L_NO_NEW_POSTS_HOT}" vspace="4" title="{L_NO_NEW_POSTS_HOT}" /></td>
<td class="gensmall">{L_NO_NEW_POSTS_HOT}</td>
<td>&nbsp;</td>
<td><img src="{FOLDER_STICKY_IMG}" alt="{L_STICKY}" title="{L_STICKY}" /></td>
<td class="gensmall">{L_STICKY}</td>
</tr>
<tr>
<td><img src="{FOLDER_LOCKED_NEW_IMG}" alt="{L_NEW_POSTS_LOCKED}" title="{L_NEW_POSTS_LOCKED}" /></td>
<td class="gensmall">{L_NEW_POSTS_LOCKED}</td>
<td>&nbsp;</td>
<td><img src="{FOLDER_LOCKED_IMG}" alt="{L_NO_NEW_POSTS_LOCKED}" title="{L_NO_NEW_POSTS_LOCKED}" /></td>
<td class="gensmall">{L_NO_NEW_POSTS_LOCKED}</td>
<td>&nbsp;</td>
<td><img src="{FOLDER_POSTED_IMG}" alt="{L_POSTED}" title="{L_POSTED}" /></td>
<td class="gensmall">{L_POSTED}</td>
</tr>
</table>
</td>
<td align="right" valign="top"><span class="gensmall">{S_AUTH_LIST}</span></td>
</tr>
</table>
