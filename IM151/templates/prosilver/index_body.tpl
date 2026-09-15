<!-- BEGIN switch_banner_18 -->
<div class="banner-container">
  <div class="banner-wrapper">
    {BANNER_18_IMG}
  </div>
</div>
<!-- END switch_banner_18 -->
<!-- BEGIN switch_user_logged_in -->
<p class="rightside">{LAST_VISIT_DATE}</p>
<!-- END switch_user_logged_in -->
<p>{CURRENT_TIME}</p>

<ul class="linklist">
	<li>
	<a href="{U_SEARCH_UNANSWERED}">{L_SEARCH_UNANSWERED}</a><br />
	<!-- BEGIN switch_user_logged_out -->
	<a href="{U_SEARCH_NEW}" class="gensmall">{L_SEARCH_NEW}</a><br />
	<!-- END switch_user_logged_out -->
	<!-- BEGIN switch_user_logged_in -->
	<a href="{U_SEARCH_NEW}">{L_SEARCH_NEW}</a><br />
	<a href="{U_MARK_READ}"><strong>{L_MARK_FORUMS_READ}</strong></a>
	<!-- END switch_user_logged_in -->
</ul>

{BOARD_ANNOUNCES}
{BOARD_INDEX}

<div class="legend-container">
	<div class="legend-items">
	    <div class="legend-item">
	        <img src="{FORUM_NEW_IMG}" alt="{L_NEW_POSTS}" title="{L_NEW_POSTS}" />
	        <span class="legend-text">{L_NEW_POSTS}</span>
	    </div>
	    <div class="legend-item">
	        <img src="{FORUM_IMG}" alt="{L_NO_NEW_POSTS}" title="{L_NO_NEW_POSTS}" />
	        <span class="legend-text">{L_NO_NEW_POSTS}</span>
	    </div>
	    <div class="legend-item">
	        <img src="{FORUM_LOCKED_IMG}" alt="{L_FORUM_LOCKED}" title="{L_FORUM_LOCKED}" />
	        <span class="legend-text">{L_FORUM_LOCKED}</span>
	    </div>
	</div>
</div>

<div class="extra_wrapper">
  <div class="column-container">
    <div class="column side-column">
      {MINI_CAL_OUTPUT}
    </div>
    <div class="column main-column">
      <!-- BEGIN switch_user_logged_in -->
      <!-- Start add - Fully integrated shoutbox MOD -->
		<div class="forabg">
			<div class="inner"><span class="corners-top"><span></span></span>
			<ul class="topiclist">
				<li class="header">
					<dl class="row-item">
						<dt>
						    <a href="{U_SHOUTBOX_MAX}">{L_SHOUTBOX}</a>
						</dt>
					</dl>
				</li>
			</ul>
			<ul class="topiclist forums">
				<li style="margin: 0 6px; background: #CADCEB;" class="row shoutbox-container">
                    <iframe src="{U_SHOUTBOX}" scrolling="no" frameborder="0" marginheight="0" marginwidth="0" allowtransparency="true" ></iframe>
				</li>
			</ul>
			<span class="corners-bottom"><span></span></span></div>
		</div>
      <!-- End add - Fully integrated shoutbox MOD -->
      <!-- END switch_user_logged_in -->
    </div>
  </div>
</div>

<!-- BEGIN switch_user_logged_out -->
<form method="post" action="{S_LOGIN_ACTION}" class="headerspace">
<h3><a href="{U_LOGIN_LOGOUT}">{L_LOGIN_LOGOUT}</a>&nbsp; &bull; &nbsp;<a href="{U_REGISTER}">{L_REGISTER}</a></h3>
<fieldset class="quick-login">
	<label>{L_USERNAME}:</label>&nbsp;<input type="text" name="username" size="10" class="inputbox" title="{L_USERNAME}" />  
	<label>{L_PASSWORD}:</label>&nbsp;<input type="password" name="password" size="10" class="inputbox" title="{L_PASSWORD}" />
		| <label>{L_LOG_ME_IN} <input type="checkbox" name="autologin" /></label>
	<input type="submit" name="login" value="{L_LOGIN}" class="button2" />
</fieldset>
</form>
<h3>{L_WHO_IS_ONLINE}</h3>
<!-- END switch_user_logged_out -->
<!-- BEGIN switch_user_logged_in -->
<h3><a href="{U_VIEWONLINE}">{L_WHO_IS_ONLINE}</a></h3>
<!-- END switch_user_logged_in -->
<p>{TOTAL_USERS_ONLINE} ({L_ONLINE_EXPLAIN})<br />{RECORD_USERS}<br />{LOGGED_IN_USER_LIST}</p>
<p>{TOTAL_POSTS} &bull; {TOTAL_USERS} &bull; {NEWEST_USER}</p>
<p>{USERS_OF_THE_DAY_LIST}</p>
<!-- BEGIN switch_happy_birthday -->
<h3>{L_HAPPY_BIRTHDAY}</h3>
<p>{HAPPY_BIRTHDAY_FELLOWS}</p>
<!-- END switch_happy_birthday -->

<!-- BEGIN switch_banner_19 -->
<br />
<div class="banner-container">
  <div class="banner-wrapper">
    {BANNER_19_IMG}
  </div>
</div>
<!-- END switch_banner_19 -->
