<h1>{L_CONFIGURATION_TITLE}</h1>
<p>{L_CONFIGURATION_EXPLAIN}</p>
<form action="{S_CONFIG_ACTION}" method="post">
  <table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
    <tr> 
      <th class="th" colspan="2">{L_SYS_SETTINGS}</th>
    </tr>
    <tr> 
      <td class="row1">{L_ENABLE_POST}<br /> <span class="gensmall">{L_ENABLE_POST_EXPLAIN}</span></td>
      <td class="row2"> <input type="radio" name="points_post" value="1" {S_POINTS_POST_YES} />
        {L_YES}   <input type="radio" name="points_post" value="0" {S_POINTS_POST_NO} />
        {L_NO} </td>
    </tr>
    <tr> 
      <td class="row1">{L_ENABLE_DONATION}<br /> <span class="gensmall">{L_ENABLE_DONATION_EXPLAIN}</span></td>
      <td class="row2"> <input type="radio" name="points_donate" value="1" {S_POINTS_DONATE_YES} />
        {L_YES}   <input type="radio" name="points_donate" value="0" {S_POINTS_DONATE_NO} />
        {L_NO} </td>
    </tr>
    <tr> 
      <td class="row1">{L_POINTS_NAME}<br /> <span class="gensmall">{L_POINTS_NAME_EXPLAIN}</span></td>
      <td class="row2"> <input type="text" maxlength="100" name="points_name" value="{S_POINTS_NAME}" /> 
      </td>
    </tr>
    <tr> 
      <td class="row1">{L_PER_REPLY}<br /> <span class="gensmall">{L_PER_REPLY_EXPLAIN}</span></td>
      <td class="row2"> <input type="text" name="points_reply" size="3" maxlength="4" value="{S_POINTS_REPLY}" /> 
      </td>
    </tr>
    <tr>
      <td class="row1">{L_PER_TOPIC}<br /> <span class="gensmall">{L_PER_TOPIC_EXPLAIN}</span></td>
      <td class="row2"><input type="text" name="points_topic" size="3" maxlength="4" value="{S_POINTS_TOPIC}" /></td>
    </tr>
    <tr> 
      <td class="row1">{L_USER_GROUP_AUTH}<br />
        <span class="gensmall">{L_USER_GROUP_AUTH_EXPLAIN}</span></td>
      <td class="row2"><textarea name="points_user_group_auth_ids">{S_USER_GROUP_AUTH}</textarea> 
      </td>
    </tr>
    <tr> 
      <td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS} 
        <input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" /> 
           <input type="reset" value="{L_RESET}" class="liteoption" /> </td>
    </tr>
  </table>
</form>
<br clear="all" />