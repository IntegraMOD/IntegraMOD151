
<script language="JavaScript">
<!--
function check() {
var correct = true; 

if ( document.forms[0].send_pm[0].checked == true && document.forms[0].elements[0].value == "" ){ 
	alert ("{L_SELECT_USER_FIRST}");
	correct = false; 
	} else {
	correct = true;
	}

if ( correct == true) document.forms[0].submit(); 

return correct; 
}
//-->
</script>

<h1>{L_FORUM_RULES}</h1>

<p>{L_FORUM_RULES_EXPLAIN}</p>

<form method="post"	action="{S_FORUMRULES_ACTION}" onSubmit="return check()">
  
<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
<tr> 
	<th class="thHead" colspan="2">{L_NOTVIEW_RULES}</th>
</tr>

<tr>
	<td class="row2" rowspan="4" valign="top">
	<b>{L_USERS_NOTVIEW_RULES}</b><br>
	<select name="user_notview_rules[]" size="23" multiple>
	{S_NOTVIEW_RULES}
	</select>
	</td>

	<td class="row1" align="left" valign="top">
	<b>{L_SUBJECT}</b><br />
	<span class="gen"><input type="text" name="subject" size="45" maxlength="60" style="width:450px" tabindex="2" class="post" value="{S_PM_SUBJECT}" /></span>
	</td>
</tr>
	
<tr>
	<td class="row1" align="left" valign="top">
	<b>{L_MESSAGE_BODY}</b><br />
	<span class="gen"><textarea name="message" rows="15" cols="35" wrap="virtual" style="width:450px" tabindex="3" class="post" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);">{S_PM_MESSAGE}</textarea></span>
	</td>
</tr>

<tr> 
	<td class="row2">
	<b>{L_SEND_PM_TO}:</b> &nbsp; {L_SEND_PM_SELECT} <input type="radio" name="send_pm" value="send_pm_select" checked> {L_SEND_PM_ALL} <input type="radio" name="send_pm" value="send_pm_all"><br />
	 </td>
</tr>

<tr> 
	<td class="row2">
	<b>{L_SEND_EMAIL}</b> <input type="checkbox" name="send_email"><br />
	 </td>
</tr>

<tr> 
	<td class="cat" align="center" colspan="2"><input type="hidden" name="all_user_notview_rules" value="{S_HIDDEN_VARS}" />
	<input type="submit" name="dorules" value="{L_DO}" class="mainoption">
	 </td>
</tr>

</table>

</form>
