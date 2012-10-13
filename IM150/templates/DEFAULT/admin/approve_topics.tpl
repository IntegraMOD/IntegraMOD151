<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="forumline">
  <tr align="center" valign="bottom"> 
    <td width="200" nowrap class="copyright"><a href="{S_AWAITING}">{L_AWAITING_APPROVAL}</a></td>
    <td width="200" nowrap class="copyright"><a href="{S_MODERATED}">{L_MODERATED_TOPICS}</a></td>
    <td width="200" nowrap class="copyright"><a href="{S_APPROVED}">{L_AUTO_APPROVED_TOPICS}</a></td>
  </tr>
  <!-- BEGIN approve_message -->
  <tr> 
    <td colspan="3" valign="top" align="center"><table width="100%" border="0" align="center" cellpadding="10" cellspacing="1" class="bodyline">
        <tr> 
          <td class="forumline" align="center">{approve_message.MESSAGE}</td>
        </tr>
      </table></td>
  </tr>
  <!-- END approve_message -->
  <tr> 
    <td colspan="3"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="bodyline">
        <tr>
          <td width="100%" valign="top" align="center"> 
            <!-- BEGIN awaiting_approval -->
            <table width="100%" border="0" cellspacing="1" cellpadding="0" class="forumline">
              <tr> 
                <th width="100%" nowrap class="th"><div align="center">{L_AWAITING_APPROVAL}</div></th>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
                    <tr> 
                      <td width="150" nowrap class="cat"><div align="center"><strong>{L_AUTHOR}</strong></div></td>
                      <td nowrap class="cat"><div align="center"><strong>{L_TOPIC_TITLE}</strong></div></td>
                      <td class="cat" width="150" nowrap><div align="center"><strong>{L_APPROVE_TOPIC}</strong></div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td class="row3">&nbsp;{L_APPROVAL_TOPICS_OF}</td>
              </tr>
              <!-- BEGIN approval_topics -->
              <tr> 
                <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
                    <tr> 
                      <td width="150" nowrap class="{awaiting_approval.approval_topics.S_ROW}"><div align="center"><a href="{awaiting_approval.approval_topics.S_U_LINK}">{awaiting_approval.approval_topics.S_AUTHOR}</a></div></td>
                      <td nowrap class="{awaiting_approval.approval_topics.S_ROW}"><div align="center"><a href="{awaiting_approval.approval_topics.S_LINK}">{awaiting_approval.approval_topics.S_TITLE}&nbsp;</a></div></td>
                      <td width="150" class="{awaiting_approval.approval_topics.S_ROW}"><div align="center"><a href="{awaiting_approval.approval_topics.S_APPROVE}">{L_APPROVE}</a></div></td>
                    </tr>
                  </table></td>
              </tr>
              <!-- END approval_topics -->
              <tr> 
                <td class="cat">&nbsp;{L_PAGE} 
                  <!-- BEGIN approval_paginate -->
                  {awaiting_approval.approval_paginate.S_LINK} 
                  <!-- END approval_paginate -->
                </td>
              </tr>
            </table>
            <!-- END awaiting_approval -->
            <!-- BEGIN moderated -->
            <table width="100%" border="0" cellspacing="1" cellpadding="0" class="forumline">
              <tr> 
                <th width="100%" nowrap class="th"><div align="center">{L_MODERATED_TOPICS}</div></th>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
                    <tr> 
                      <td width="150" nowrap class="cat"><div align="center"><strong>{L_AUTHOR}</strong></div></td>
                      <td nowrap class="cat"><div align="center"><strong>{L_TOPIC_TITLE}</strong></div></td>
                      <td class="cat" width="150" nowrap><div align="center"><strong>{L_REMOVE_MODERATION}</strong></div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td class="row3">&nbsp;{L_MODERATED_TOPICS_OF}</td>
              </tr>
              <!-- BEGIN moderated_topics -->
              <tr> 
                <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
                    <tr> 
                      <td width="150" nowrap class="{moderated.moderated_topics.S_ROW}"><div align="center"><a href="{moderated.moderated_topics.S_U_LINK}">{moderated.moderated_topics.S_AUTHOR}</a></div></td>
                      <td nowrap class="{moderated.moderated_topics.S_ROW}"><div align="center"><a href="{moderated.moderated_topics.S_LINK}">{moderated.moderated_topics.S_TITLE}&nbsp;</a></div></td>
                      <td width="150" class="{moderated.moderated_topics.S_ROW}"><div align="center"><a href="{moderated.moderated_topics.S_REMOVE}">{L_REMOVE}</a></div></td>
                    </tr>
                  </table></td>
              </tr>
              <!-- END moderated_topics -->
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
                <th width="100%" nowrap class="th"><div align="center">{L_AUTO_APPROVED_TOPICS}</div></th>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
                    <tr> 
                      <td width="150" nowrap class="cat"><div align="center"><strong>{L_AUTHOR}</strong></div></td>
                      <td nowrap class="cat"><div align="center"><strong>{L_TOPIC_TITLE}</strong></div></td>
                      <td class="cat" width="150" nowrap><div align="center"><strong>{L_REMOVE_APPROVAL}</strong></div></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td class="row3">&nbsp;{L_APPROVED_TOPICS_OF}</td>
              </tr>
              <!-- BEGIN approved_topics -->
              <tr> 
                <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
                    <tr> 
                      <td width="150" nowrap class="{approved.approved_topics.S_ROW}"><div align="center"><a href="{approved.approved_topics.S_U_LINK}">{approved.approved_topics.S_AUTHOR}</a></div></td>
                      <td nowrap class="{approved.approved_topics.S_ROW}"><div align="center"><a href="{approved.approved_topics.S_LINK}">{approved.approved_topics.S_TITLE}&nbsp;</a></div></td>
                      <td width="150" class="{approved.approved_topics.S_ROW}"><div align="center"><a href="{approved.approved_topics.S_REMOVE}">{L_REMOVE}</a></div></td>
                    </tr>
                  </table></td>
              </tr>
              <!-- END approved_topics -->
              <tr> 
                <td class="cat">&nbsp;{L_PAGE} 
                  <!-- BEGIN approved_paginate -->
                  {approved.approved_paginate.S_LINK} 

                  <!-- END approved_paginate -->
                </td>
              </tr>
            </table>
            <!-- END approved -->
          </td>
        </tr>
      </table></td>
  </tr>
</table>