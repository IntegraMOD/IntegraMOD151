<div class="maintitle">{L_FORUM_TITLE} :: {L_APPROVE_POSTS}</div>
<br />
<form action="{S_FORUM_ACTION}" method="post">
<!-- // Begin Approve_Mod Block : 19 // --> 
</form>
<script language= "JavaScript">
<!--
function addUsername()
{
	len = document.post.usernames.length;
	if ( document.post.username.value == "" )
	{
		alert("Please enter a name!");
		document.post.username.value = "";
		return false;
	}
	for (i = 0; i < (document.post.usernames.length); i++)
	{
		if (document.post.usernames.options[i].text == document.post.username.value)
		{
			alert("Please enter a new unique name!");
			document.post.username.value = "";
			return false;
		}
	}
	if ( len > 9 )
	{
		alert("Please only enter a maximum of up to 10 names!");
		return false;
	}
	document.post.usernames.options[len] = new Option(document.post.username.value);
	document.post.usernames.options[len].text = document.post.username.value;

	updateUsername();
	document.post.username.value = "";
	return false;
}
function remUsername()
{
	for (i = 0; i < (document.post.usernames.length); i++)
	{
		if ( document.post.usernames.options[i].selected && document.post.usernames.options[i] != null )
		{
			document.post.usernames.options[i] = null;
			i = i - 1;
		}
	}
	updateUsername();
	return false;
}
function updateUsername()
{
	new_value = '';
	for (i = 0; i < document.post.usernames.length; i++)
	{
		if ( document.post.usernames.options[i] != null )
		{
			if ( i == 0 )
			{
				new_value = document.post.usernames.options[i].text;
			}
			else
			{
				new_value = new_value + "  |  " + document.post.usernames.options[i].text;
			}
		}
	}
	document.post.usernames_list.value = new_value;
}
//-->
</script>
<form action="{S_FORUM_ACTION}" method="post" name="post">
<!-- // End Approve_Mod Block : 19 // -->   
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline" align="center">
<tr> 
<th colspan="2">{FORUM_NAME}</th>
</tr>
<!-- // Begin Approve_Mod Block : 20 // --> 
<!-- BEGIN approve_mod_switch -->
	<tr> 
	  <td class="row1">
	     <table width="100%" border="0" cellpadding="1" cellspacing="0">
          <tr> 
            <td align="right" valign="middle" nowrap>{L_APPROVE_ENABLE}</td>
            <td align="left" valign="middle" nowrap><input type="checkbox" name="approve_enable" value="1" {S_APPROVE_ENABLED} /></td>
          </tr>
          <tr> 
            <td align="right" valign="middle" nowrap>{L_APPROVE_USERS_ENABLE}</td>
            <td align="left" valign="middle" nowrap><input type="radio" name="approve_users_enable" value="1" {S_APPROVE_USERS_ENABLED} />
              {L_APPROVE_USERS_ALL}&nbsp;&nbsp; <input type="radio" name="approve_users_enable" value="0" {S_APPROVE_USERS_DISABLED} />
              {L_APPROVE_USERS_MOD}</td>
          </tr>
          <tr> 
            <td align="right" valign="top" nowrap>{L_APPROVE_POSTS_TOPICS}</td>
            <td align="left" valign="middle" nowrap><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="50%" nowrap><input type="checkbox" name="approve_topics_enable" value="1" {S_APPROVE_TOPICS_ENABLED} />
                    {L_APPROVE_TOPICS_ENABLE}</td>
                  <td width="50%" nowrap><input type="checkbox" name="approve_posts_enable" value="1" {S_APPROVE_POSTS_ENABLED} />
                    {L_APPROVE_POSTS_ENABLE}</td>
                </tr>
                <tr> 
                  <td nowrap><input type="checkbox" name="approve_topice_enable" value="1" {S_APPROVE_TOPICE_ENABLED} />
                    {L_APPROVE_TOPICE_ENABLE}</td>
                  <td nowrap> <input type="checkbox" name="approve_poste_enable" value="1" {S_APPROVE_POSTE_ENABLED} />
                    {L_APPROVE_POSTE_ENABLE}</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td align="right" valign="middle" nowrap>{L_APPROVE_NOTIFY_USER}</td>
            <td align="left" valign="middle" nowrap>
	     <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="50%" nowrap><input class="post" type="text" name="username" size="20" /></td>
                  <td width="50%" nowrap><input type="button" name="usersearch" value="{L_APPROVE_BUTTON_FIND}" class="liteoption" onClick="window.open('./../search.php?mode=searchuser', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" /></td>
                </tr>
                <tr>
                  <td rowspan="2" valign="top" nowrap>
		    <select name="usernames" size="3" multiple>
			  {S_APPROVE_NOTIFY_USER_OPTIONS}
		    </select>
		  </td>
                  <td nowrap>
		    <input type="button" name="add" value="{L_APPROVE_BUTTON_ADD}" class="liteoption" onClick="javascript: addUsername();"><input name="usernames_list" type="hidden" value="{S_APPROVE_NOTIFY_USER_LIST}"><br/>
		  </td>
                </tr>
		<tr>
		 <td nowrap><input type="button" name="remove" value="{L_APPROVE_BUTTON_REM}" class="liteoption" onClick="javascript: remUsername();"></td>
		</tr>
              </table>
            </td>
          </tr>
	  <tr> 
            <td align="right" valign="middle" nowrap>{L_APPROVE_NOTIFY_USER_ENABLE}</td>
            <td align="left" valign="middle" nowrap><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="50%" nowrap><input type="radio" name="approve_notify_user_enable" value="1" {S_APPROVE_NOTIFY_USER_ENABLED} />
                    {L_APPROVE_NOTIFY_ENABLED}</td>
                  <td width="50%" nowrap><input type="radio" name="approve_notify_user_enable" value="0" {S_APPROVE_NOTIFY_USER_DISABLED} />
                    {L_APPROVE_NOTIFY_DISABLED}</td>
                </tr>
              </table>
	    </td>
          </tr>
	  <tr> 
            <td align="right" valign="middle" nowrap>{L_APPROVE_HIDE_TOPICS_ENABLE}</td>
            <td align="left" valign="middle" nowrap><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="50%" nowrap><input type="radio" name="approve_hide_topics_enable" value="1" {S_APPROVE_HIDE_TOPICS_ENABLED} />
                    {L_APPROVE_NOTIFY_ENABLED}</td>
                  <td width="50%" nowrap><input type="radio" name="approve_hide_topics_enable" value="0" {S_APPROVE_HIDE_TOPICS_DISABLED} />
                    {L_APPROVE_NOTIFY_DISABLED}</td>
                </tr>
              </table>
	    </td>
          </tr>
	  <tr> 
            <td align="right" valign="middle" nowrap>{L_APPROVE_HIDE_POSTS_ENABLE}</td>
            <td align="left" valign="middle" nowrap><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="50%" nowrap><input type="radio" name="approve_hide_posts_enable" value="1" {S_APPROVE_HIDE_POSTS_ENABLED} />
                    {L_APPROVE_NOTIFY_ENABLED}</td>
                  <td width="50%" nowrap><input type="radio" name="approve_hide_posts_enable" value="0" {S_APPROVE_HIDE_POSTS_DISABLED} />
                    {L_APPROVE_NOTIFY_DISABLED}</td>
                </tr>
              </table>
	    </td>
          </tr>
	  <tr> 
            <td align="right" valign="middle" nowrap>{L_APPROVE_NOTIFY_ENABLE}</td>
            <td align="left" valign="middle" nowrap><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="50%" nowrap><input type="radio" name="approve_notify_enable" value="1" {S_APPROVE_NOTIFY_ENABLED} />
                    {L_APPROVE_NOTIFY_ENABLED}</td>
                  <td width="50%" nowrap><input type="radio" name="approve_notify_enable" value="0" {S_APPROVE_NOTIFY_DISABLED} />
                    {L_APPROVE_NOTIFY_DISABLED}</td>
                </tr>
              </table>
	    </td>
          </tr>
          <tr> 
            <td align="right" valign="top" nowrap>{L_APPROVE_NOTIFY_POSTS_TOPICS}</td>
            <td align="left" valign="middle" nowrap><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="50%" nowrap><input type="checkbox" name="approve_notify_topics_enable" value="1" {S_APPROVE_NOTIFY_TOPICS_ENABLED} />
                    {L_APPROVE_NOTIFY_TOPICS_ENABLE}</td>
                  <td width="50%" nowrap><input type="checkbox" name="approve_notify_posts_enable" value="1" {S_APPROVE_NOTIFY_POSTS_ENABLED} />
                    {L_APPROVE_NOTIFY_POSTS_ENABLE}</td>
                </tr>
                <tr> 
                  <td nowrap><input type="checkbox" name="approve_notify_topice_enable" value="1" {S_APPROVE_NOTIFY_TOPICE_ENABLED} />
                    {L_APPROVE_NOTIFY_TOPICE_ENABLE}</td>
                  <td nowrap><input type="checkbox" name="approve_notify_poste_enable" value="1" {S_APPROVE_NOTIFY_POSTE_ENABLED} />
                    {L_APPROVE_NOTIFY_POSTE_ENABLE} </td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td align="right" valign="middle" nowrap>{L_APPROVE_NOTIFY_TYPE}</td>
            <td align="left" valign="middle" nowrap> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="50%" nowrap><input type="radio" name="approve_notify_type_enable" value="1" {S_APPROVE_NOTIFY_PM_ENABLED} />
                    {L_APPROVE_NOTIFY_PM_ENABLE}</td>
                  <td width="50%" nowrap><input type="radio" name="approve_notify_type_enable" value="-1" {S_APPROVE_NOTIFY_EMAIL_ENABLED} />
                    {L_APPROVE_NOTIFY_EMAIL_ENABLE}</td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td align="right" valign="middle" nowrap>{L_APPROVE_NOTIFY_MESSAGE_ENABLE}</td>
            <td align="left" valign="middle" nowrap><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="50%" nowrap><input type="checkbox" name="approve_notify_message_enable" value="1" {S_APPROVE_NOTIFY_MESSAGE_ENABLED} />
                    {L_APPROVE_NOTIFY_ENABLED}</td>
                  <td width="50%" nowrap><input class="post" type="text" name="approve_notify_message_len" value="{S_APPROVE_NOTIFY_MESSAGE_LEN}" size="5" />
                    {L_APPROVE_NOTIFY_MESSAGE_LEN} </td>
                </tr>
              </table></td>
          </tr>
        </table>
          </td>
	</tr>
<!-- END approve_mod_switch -->
<!-- // End Approve_Mod Block : 20 // -->
<tr> 
<td colspan="2" align="center" class="cat">{S_HIDDEN_FIELDS} 
<input type="submit" name="submit" value="{S_SUBMIT_VALUE}" class="mainoption" />
</td>
</tr>
</table>
</form>
		
<br clear="all" />
