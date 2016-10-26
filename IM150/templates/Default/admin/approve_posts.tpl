<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="forumline">
  <!-- BEGIN approve_message -->
  <tr> 
    <td valign="top" align="center"><table width="100%" border="0" align="center" cellpadding="10" cellspacing="1" class="bodyline">
        <tr> 
          <td class="forumline" align="center">{approve_message.MESSAGE}</td>
        </tr>
      </table></td>
  </tr>
  <!-- END approve_message -->
  <tr> 
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="bodyline">
        <tr> 
          <td width="100%" valign="top" align="center"> <table width="100%" border="0" cellspacing="1" cellpadding="0" class="forumline">
              <tr> 
                <th width="100%" nowrap class="th"><div align="center">{L_AWAITING_APPROVAL}</div></th>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
                    <tr> 
                      <td width="150" nowrap class="cat"><div align="center"><strong>{L_AUTHOR}</strong></div></td>
                      <td nowrap class="cat"><div align="center"><strong>{L_POST_SUBJECT}&nbsp;</strong></div></td>
                      <td class="cat" width="150" nowrap><div align="center"><strong>{L_APPROVE_POST}</strong></div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td class="row3">&nbsp;{L_APPROVAL_POSTS_OF}</td>
              </tr>
              <!-- BEGIN approval_posts -->
              <tr> 
                <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
                    <tr> 
                      <td width="150" nowrap class="{approval_posts.S_ROW}"><div align="center"><a href="{approval_posts.S_U_LINK}">{approval_posts.S_AUTHOR}</a></div></td>
                      <td nowrap class="{approval_posts.S_ROW}"><div align="center"><a href="{approval_posts.S_LINK}">{approval_posts.S_SUBJECT}&nbsp;</a></div></td>
                      <td width="150" class="{approval_posts.S_ROW}"><div align="center"><a href="{approval_posts.S_APPROVE}">{L_APPROVE}</a></div></td>
                    </tr>
                  </table></td>
              </tr>
              <!-- END approval_posts -->
              <tr> 
                <td class="cat">&nbsp;{L_PAGE} 
                  <!-- BEGIN approval_paginate -->
                  {approval_paginate.S_LINK} 
                  <!-- END approval_paginate -->
                </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
