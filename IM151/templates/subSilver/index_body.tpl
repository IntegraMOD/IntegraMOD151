<!-- BEGIN switch_banner_18 -->
<table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td width="100%" align="center">{BANNER_18_IMG}</td>
  </tr>
</table>
<br />
<!-- END switch_banner_18 -->

<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
    <td valign="bottom" class="gensmall">
    <a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_CAT_DESC}<br />
      <!-- BEGIN switch_user_logged_in -->
      {LAST_VISIT_DATE}<br />
      <!-- END switch_user_logged_in -->
      <!-- BEGIN switch_user_logged_out -->
      {LAST_VISIT_DATE}<br />
      <!-- END switch_user_logged_out -->
      {CURRENT_TIME}
    </td>
    <td align="right" valign="bottom" class="gensmall">
      <a href="{U_SEARCH_UNANSWERED}">{L_SEARCH_UNANSWERED}</a><br />
      <!-- BEGIN switch_user_logged_out -->
      <a href="{U_SEARCH_NEW}" class="gensmall">{L_SEARCH_NEW}</a><br />
      <!-- END switch_user_logged_out -->
      <!-- BEGIN switch_user_logged_in -->
      <a href="{U_SEARCH_NEW}">{L_SEARCH_NEW}</a><br />
      <a href="{U_MARK_READ}"><strong>{L_MARK_FORUMS_READ}</strong></a>
      <!-- END switch_user_logged_in -->
    </td>
  </tr>
</table>
{BOARD_ANNOUNCES}
{BOARD_INDEX}
<table border="0" align="center" cellpadding="0" cellspacing="3">
  <tr>
    <td><img src="{FORUM_NEW_IMG}" alt="{L_NEW_POSTS}" title="{L_NEW_POSTS}" /></td>
    <td class="gensmall">{L_NEW_POSTS}</td>
    <td>&nbsp;</td>
    <td><img src="{FORUM_IMG}" alt="{L_NO_NEW_POSTS}" title="{L_NO_NEW_POSTS}" /></td>
    <td class="gensmall">{L_NO_NEW_POSTS}</td>
    <td>&nbsp;</td>
    <td><img src="{FORUM_LOCKED_IMG}" alt="{L_FORUM_LOCKED}" title="{L_FORUM_LOCKED}" /></td>
    <td class="gensmall">{L_FORUM_LOCKED}</td>
  </tr>
</table>
<br />
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <!-- BEGIN switch_user_logged_out -->
  <tr>
    <td>
      <form method="post" action="{S_LOGIN_ACTION}">
      <table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
        <tr>
          <td class="cat">{L_LOGIN_LOGOUT}</td>
        </tr>
        <tr>
		  <td class="row1" align="center">
		    <table border="0" cellpadding="3" cellspacing="1" >
		      <tr> 
		        <td class="gensmall">{L_USERNAME}:&nbsp;</td>
		        <td><input class="post" type="text" name="username" size="10" /></td>
		        <td class="gensmall">&nbsp;&nbsp;&nbsp;{L_PASSWORD}:</td>
		        <td><input class="post" type="password" name="password" size="10" maxlength="32" /></td>
		        <!-- BEGIN switch_allow_autologin -->
		        <td class="gensmall">&nbsp;&nbsp;&nbsp;{L_AUTO_LOGIN}</td>
		        <td><input class="text" type="checkbox" name="autologin" /></td>
		        <!-- END switch_allow_autologin -->
		        <td>&nbsp;&nbsp;<input type="submit" class="mainoption" name="login" value="{L_LOGIN}" /></td>
		      </tr>
		    </table>
		  </td>
        </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"></td><td class="tblbot"></td><td class="tblr"></td></tr></table>
      </form>
    </td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <!-- END switch_user_logged_out -->
  <tr>
    <td>
      <table width="100%" cellspacing="0" border="0" cellpadding="0">
        <tr>
          <td valign="top">{MINI_CAL_OUTPUT}</td><td width="10"><img src="images/spacer.gif" alt="" width="10" height="30" /></td>
          <td width="100%" valign="top">
			<table width="100%" cellspacing="0" bordero="0" cellpadding="0">
			  <tr>
			    <td>
			      <!-- BEGIN switch_user_logged_in -->
			      <!-- Start add - Fully integrated shoutbox MOD -->
			      <table width="100%" cellpadding="0" cellspacing="1"  border="0" align="center" class="forumline"> 
			        <tr> 
			          <th align="center" nowrap="nowrap" class="cat"><span class="cattitle"><a href="{U_SHOUTBOX_MAX}">{L_SHOUTBOX}</a></span></th> 
			        </tr> 
			        <tr>
			          <td><iframe src="{U_SHOUTBOX}" scrolling="NO" width="100%" height="210" frameborder="0" marginheight="0" marginwidth="0" allowtransparency="true"></iframe></td> 
			        </tr> 
			      </table>
                  <table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"></td><td class="tblbot"></td><td class="tblr"></td></tr></table>
                  <!-- End add - Fully integrated shoutbox MOD -->
                  <!-- END switch_user_logged_in -->
                </td>
              </tr>
              <!-- BEGIN disable_viewonline -->
              <tr><td>&nbsp;</td></tr>
              <tr>
			    <td>
                  <table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
                    <tr>
                      <th align="center" nowrap="nowrap" class="cat" colspan="2"><span class="cattitle"><a href="{U_VIEWONLINE}">{L_WHO_IS_ONLINE}</a></span></th>
                    </tr>
                    <tr>
                      <td class="row1" rowspan="4"><img src="{WHOSONLINE_IMAGE}" alt="{L_WHO_IS_ONLINE}" width="25" height="25" class="imgfolder" title="{L_WHO_IS_ONLINE}" /></td>
                      <td class="row1" width="100%"><span class="gensmall">{TOTAL_POSTS}<br />{TOTAL_USERS}<br />{NEWEST_USER}</span></td>
                    </tr>
                    <tr>
                      <td class="row1"><span class="gensmall">{TOTAL_USERS_ONLINE} <br /> {L_WHOSONLINE}<br />{RECORD_USERS}<br />{LOGGED_IN_USER_LIST}</span></td>
                    </tr>
                    <tr>
                      <td height="20" class="row1"><span class="gensmall">{L_ONLINE_EXPLAIN}</span></td>
				    </tr>
				    <tr>
				      <td class="row1" align="left"><span class="gensmall">{USERS_OF_THE_DAY_LIST}</span></td>
				    </tr>
				  </table>
                  <table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"></td><td class="tblbot"></td><td class="tblr"></td></tr></table>
                </td>
              </tr>
			  <!-- END disable_viewonline -->
			  <!-- BEGIN switch_happy_birthday -->
			  <tr><td>&nbsp;</td></tr>
			  <tr>
			    <td>
				  <table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
					<tr>
					  <th class="cat" colspan="2" height="28"><span class="cattitle">{L_HAPPY_BIRTHDAY}</span></th>
					</tr>
					<tr>
					  <td class="row1" align="center" valign="middle"><img src="{HAPPY_BIRTHDAY_IMG}" alt="{L_HAPPY_BIRTHDAY}" /></td>
					  <td class="row1" align="left" width="100%"><span class="gensmall">&nbsp;{HAPPY_BIRTHDAY_FELLOWS}&nbsp;</span></td>
					</tr>
				  </table>
				  <table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"></td><td class="tblbot"></td><td class="tblr"></td></tr></table>
                </td>
			  </tr>
              <!-- END switch_happy_birthday -->
            </table>
		  </td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<!-- BEGIN switch_banner_19 -->
<br />
<table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td width="100%" align="center">{BANNER_19_IMG}</td>
  </tr>
</table>
<!-- END switch_banner_19 -->
