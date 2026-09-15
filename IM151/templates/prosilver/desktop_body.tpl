<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="{S_CONTENT_DIRECTION}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}">
<meta http-equiv="Content-Style-Type" content="text/css">{META_HTTP_EQUIV_TAGS}
<title>{SITENAME} - {PAGE_TITLE}</title>{META_TAGS}
{META}
{NAV_LINKS}
<!--[if gte IE 5]><![if lt IE 7]><script src="templates/assets/js/pngfix.js"></script><![endif]><![endif]--> 
<link rel="stylesheet" href="{TEMPLATE}{T_HEAD_STYLESHEET}" type="text/css" />
</head>
<body>
		  <table width="200" cellpadding="2" cellspacing="1" border="0" class="forumline">
		   <tr>
			<td class="cat" height="25"><span class="genmed"><b><a href="{U_PRIVATEMSGS}" class="mainmenu">{PRIVATE_MESSAGE_INFO}</a></b></span></td>
		   </tr>
          </table>
<br class="gensmall" />
		  
<table width="200" cellpadding="2" cellspacing="1" border="0" class="forumline">
		   <tr>
			<td class="cat" height="25"><span class="genmed"><b>{LOGIN_STATUS_TITLE}</b></span></td>
		   </tr>
		   <tr>
			<td class="row1" height="25"><span class="gensmall">{LOGIN_STATUS_EXPLAIN}</span></td>
		   </tr>
          </table>
<br class="gensmall" />

		  <table width="200" cellpadding="2" cellspacing="1" border="0" class="forumline">
		   <tr>
			<td class="cat" height="25"><span class="genmed"><b>{L_RECENT_TOPICS}</b></span></td>
		   </tr>
		   <tr>
			<td class="row1" align="left"><span class="gensmall">
			<marquee id="recent_topics" behavior="scroll" direction="up" height="175" scrolldelay="100" scrollamount="2">
			<!-- BEGIN recent_topic_row -->
			- <a href="{recent_topic_row.U_TITLE}" onMouseOver="document.all.recent_topics.stop()" onMouseOut="document.all.recent_topics.start()">{recent_topic_row.L_TITLE}</a><br />
			by <a href="{recent_topic_row.U_POSTER}" onMouseOver="document.all.recent_topics.stop()" onMouseOut="document.all.recent_topics.start()">{recent_topic_row.S_POSTER}</a> on {recent_topic_row.S_POSTTIME}<br /><br />
			<!-- END recent_topic_row -->
			</marquee>
			</span></td>
		   </tr>
		  </table>
<!--
<br />
          <table width="200" cellpadding="2" cellspacing="1" border="0" class="forumline">
		   <tr>
			<td class="cat" height="25"><span class="genmed"><b>{L_SEARCH_NEW}</b></span></td>
		   </tr>
		   <tr>
			<td class="row1" align="left"><span class="gensmall">
			<marquee id="recent_topics" behavior="scroll" direction="up" height="175" scrolldelay="100" scrollamount="2">

		<a href="search.php?search_id=newposts" onMouseOver="document.all.recent_topics.stop()" onMouseOut="document.all.recent_topics.start()">{L_SEARCH_NEW}</a><br />

			</marquee>
			</span></td>
		   </tr>
		  </table>

-->

<br class="gensmall" />
		  <table width="200" cellpadding="2" cellspacing="1" border="0" class="forumline">
		   <tr>
			<td class="cat" height="25"><span class="genmed"><b>{L_WHO_IS_ONLINE}</b></span></td>
		   </tr>
		   <tr>
			<td class="row1" align="left"><span class="gensmall">{TOTAL_USERS_ONLINE}<br /><br />{LOGGED_IN_USER_LIST}<br />{RECORD_USERS}<br />&nbsp;</span></td>
		   </tr>
		  </table>
		  {TPL_FTR}
</body>
</html>
