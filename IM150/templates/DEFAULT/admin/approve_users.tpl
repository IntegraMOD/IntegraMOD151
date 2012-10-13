<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="forumline">
  <tr align="center" valign="bottom"> 
    <td width="150" nowrap class="copyright"><a href="{S_MODERATED}">{L_MODERATED}</a></td>
    <td width="150" nowrap class="copyright"><a href="{S_APPROVED}">{L_AUTO_APPROVED}</a></td>
    <td width="150" nowrap class="copyright"><a href="{S_ADD_MODERATED}">{L_ADD_MODERATED}</a></td>
    <td width="150" nowrap class="copyright"><a href="{S_ADD_APPROVED}">{L_ADD_AUTO_APPROVED}</a></td>
  </tr>
  <!-- BEGIN approve_message -->
  <tr> 
    <td colspan="4" valign="top" align="center"><table width="100%" border="0" align="center" cellpadding="10" cellspacing="1" class="bodyline">
    <tr><td class="forumline" align="center">{approve_message.MESSAGE}</td></tr></table></td>
  </tr>
  <!-- END approve_message -->
  <tr> 
    <td colspan="4">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="bodyline">
        <tr> 
          <td width="100%" valign="top" align="center">
		  <!-- BEGIN moderated -->
          <table width="100%" border="0" cellspacing="1" cellpadding="0" class="forumline">
              <tr> 
                <th width="100%" nowrap class="th"><div align="center">{L_MODERATED}</div></th>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
                    <tr> 
                      <td nowrap class="cat"><div align="center"><strong>{L_USERNAME}</strong></div></td>
                      <td class="cat" width="150" nowrap><div align="center"><strong>{L_REMOVE_MODERATION}</strong></div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td class="row3">&nbsp;{L_MODERATED_USERS_OF}</td>
              </tr>
              <!-- BEGIN moderated_users -->
              <tr> 
                <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
                    <tr> 
                      <td nowrap class="{moderated.moderated_users.S_ROW}"><div align="center"><a href="{moderated.moderated_users.S_LINK}">{moderated.moderated_users.S_USERNAME}</a></div></td>
                      <td width="150" class="{moderated.moderated_users.S_ROW}"><div align="center"><a href="{moderated.moderated_users.S_REMOVE}">{L_REMOVE}</a></div></td>
                    </tr>
                  </table></td>
              </tr>
              <!-- END moderated_users -->
              <tr> 
                <td class="cat">&nbsp;{L_PAGE}
                  <!-- BEGIN moderated_paginate -->
                  {moderated.moderated_paginate.S_LINK} 
                  <!-- END moderated_paginate -->
                </td>
              </tr>
            </table>
          <!-- END moderated -->
          <!-- BEGIN approved -->
          <table width="100%" border="0" cellspacing="1" cellpadding="0" class="forumline">
              <tr> 
                <th width="100%" nowrap class="th"><div align="center">{L_AUTO_APPROVED}</div></th>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
                    <tr> 
                      <td nowrap class="cat"><div align="center"><strong>{L_USERNAME}</strong></div></td>
                      <td class="cat" width="150" nowrap><div align="center"><strong>{L_REMOVE_APPROVAL}</strong></div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td class="row3">&nbsp;{L_APPROVED_USERS_OF}</td>
              </tr>
              <!-- BEGIN approved_users -->
              <tr> 
                <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
                    <tr> 
                      <td nowrap class="{approved.approved_users.S_ROW}"><div align="center"><a href="{approved.approved_users.S_LINK}">{approved.approved_users.S_USERNAME}</a></div></td>
                      <td width="150" class="{approved.approved_users.S_ROW}"><div align="center"><a href="{approved.approved_users.S_REMOVE}">{L_REMOVE}</a></div></td>
                    </tr>
                  </table></td>
              </tr>
              <!-- END approved_users -->
              <tr> 
                <td class="cat">&nbsp;{L_PAGE}
                  <!-- BEGIN approved_paginate -->
                  {approved.approved_paginate.S_LINK} 
                  <!-- END approved_paginate -->
                </td>
              </tr>
            </table>
          <!-- END approved -->
          <!-- BEGIN add_approval -->
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="forumline">
                <form name="post" method="post" action="">
		<tr> 
                  <th width="100%" nowrap class="th"><div align="center">{add_approval.L_ADD_APPROVAL_USER}</div></th>
                </tr>
                <tr> 
                  <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <tr> 
                        <td class="row3">&nbsp;</td>
                        <td class="row3">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td nowrap class="row1"><div align="right">{L_USERNAME}:</div></td>
                        <td class="row1"> <div align="left"> 
                            <input name="username" type="text" id="username">
                            <input type="button" name="usersearch" value="{L_APPROVE_BUTTON_FIND}" class="liteoption" onClick="window.open('./../search.php?mode=searchuser', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" />
                          </div></td>
                      </tr>
                      <tr> 
                        <td nowrap class="row1">&nbsp;</td>
                        <td class="row1"><input type="hidden" name="mode" value="u"> 
                         </td>
                      </tr>
                      <tr> 
                        <td width="200" nowrap class="row3">&nbsp;</td>
                        <td class="row3"><input type="hidden" name="s" value="{add_approval.S_S}"><input type="submit" name="submit" value="{add_approval.L_APPROVAL}"></td>
                      </tr>
                    </table></td>
                </tr>
		</form>
              </table>
          <!-- END add_approval -->
        </td></tr>
      </table></td>
  </tr>
</table>
