<div class="maintitle">{L_USER_TITLE}</div>
<br />
<div class="genmed">{L_USER_EXPLAIN}</div>
<br />
{ERROR_BOX}
<form action="{S_PROFILE_ACTION}" {S_FORM_ENCTYPE} method="post">
<table width="100%" cellspacing="1" cellpadding="3" border="0" class="forumline">
<tr> 
<th colspan="2">{L_REGISTRATION_INFO}</th>
</tr>
<tr> 
<td class="row2" colspan="2"><span class="gensmall">{L_ITEMS_REQUIRED}</span></td>
</tr>
<tr> 
<td class="row1" width="38%">{L_USERNAME}: *</td>
<td class="row2"> 
<input type="text" name="user_name" size="35" maxlength="40" value="{USERNAME}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_EMAIL_ADDRESS}: *</td>
<td class="row2"> 
<input type="text" name="email" size="35" maxlength="255" value="{EMAIL}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_NEW_PASSWORD}: *<br />
<span class="gensmall">{L_PASSWORD_IF_CHANGED}</span></td>
<td class="row2"> 
<input type="password" name="password" size="35" maxlength="32" value="" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_CONFIRM_PASSWORD}: * <br />
<span class="gensmall">{L_PASSWORD_CONFIRM_IF_CHANGED}</span></td>
<td class="row2"> 
<input type="password" name="password_confirm" size="35" maxlength="32" value="" class="post" />
</td>
</tr>
<tr> 
<td class="cat" colspan="2">&nbsp;</td>
</tr>
<tr> 
<th colspan="2">{L_PROFILE_INFO}</th>
</tr>
<tr> 
<td class="row2" colspan="2"><span class="gensmall">{L_PROFILE_INFO_NOTICE}</span></td>
</tr>
<tr> 
<td class="row1">{L_ICQ_NUMBER}</td>
<td class="row2"> 
<input type="text" name="icq" size="10" maxlength="15" value="{ICQ}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_AIM}</td>
<td class="row2"> 
<input type="text" name="aim" size="20" maxlength="255" value="{AIM}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_MESSENGER}</td>
<td class="row2"> 
<input type="text" name="msn" size="20" maxlength="255" value="{MSN}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_YAHOO}</td>
<td class="row2"> 
<input type="text" name="yim" size="20" maxlength="255" value="{YIM}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_WEBSITE}</td>
<td class="row2"> 
<input type="text" name="website" size="35" maxlength="255" value="{WEBSITE}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_LOCATION}</td>
<td class="row2"> 
<input type="text" name="location" size="35" maxlength="100" value="{LOCATION}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_OCCUPATION}</td>
<td class="row2"> 
<input type="text" name="occupation" size="35" maxlength="100" value="{OCCUPATION}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_INTERESTS}</td>
<td class="row2"> 
<input type="text" name="interests" size="35" maxlength="150" value="{INTERESTS}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_SIGNATURE}<br />
<span class="gensmall">{L_SIGNATURE_EXPLAIN}<br />
<br />
{HTML_STATUS}<br />
{BBCODE_STATUS}<br />
{SMILIES_STATUS}</span></td>
<td class="row2"> 
<textarea name="signature" rows="6" cols="30" style="width: 300px" class="post">{SIGNATURE}</textarea>
</td>
</tr>
<tr> 
<td class="cat" colspan="2">&nbsp;</td>
</tr>
<tr> 
<th colspan="2">{L_PREFERENCES}</th>
</tr>
<tr> 
<td class="row1">{L_PUBLIC_VIEW_EMAIL}</td>
<td class="row2"> 
<input type="radio" name="viewemail" value="1" {VIEW_EMAIL_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="viewemail" value="0" {VIEW_EMAIL_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_HIDE_USER}</td>
<td class="row2"> 
<input type="radio" name="hideonline" value="1" {HIDE_USER_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="hideonline" value="0" {HIDE_USER_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_NOTIFY_ON_REPLY}</td>
<td class="row2"> 
<input type="radio" name="notifyreply" value="1" {NOTIFY_REPLY_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="notifyreply" value="0" {NOTIFY_REPLY_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_NOTIFY_ON_PRIVMSG}</td>
<td class="row2"> 
<input type="radio" name="notifypm" value="1" {NOTIFY_PM_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="notifypm" value="0" {NOTIFY_PM_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_POPUP_ON_PRIVMSG}</td>
<td class="row2"> 
<input type="radio" name="popup_pm" value="1" {POPUP_PM_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="popup_pm" value="0" {POPUP_PM_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ALWAYS_ADD_SIGNATURE}</td>
<td class="row2"> 
<input type="radio" name="attachsig" value="1" {ALWAYS_ADD_SIGNATURE_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="attachsig" value="0" {ALWAYS_ADD_SIGNATURE_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1"><span class="gen">{L_ALWAYS_SET_BOOKMARK}</span></td>
<td class="row2"> 
<input type="radio" name="setbm" value="1" {ALWAYS_SET_BOOKMARK_YES} />
<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
<input type="radio" name="setbm" value="0" {ALWAYS_SET_BOOKMARK_NO} />
<span class="gen">{L_NO}</span></td>
</tr>
<tr> 
<td class="row1">{L_ALWAYS_ALLOW_BBCODE}</td>
<td class="row2"> 
<input type="radio" name="allowbbcode" value="1" {ALWAYS_ALLOW_BBCODE_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="allowbbcode" value="0" {ALWAYS_ALLOW_BBCODE_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ALWAYS_ALLOW_HTML}</td>
<td class="row2"> 
<input type="radio" name="allowhtml" value="1" {ALWAYS_ALLOW_HTML_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="allowhtml" value="0" {ALWAYS_ALLOW_HTML_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ALWAYS_ALLOW_SMILIES}</td>
<td class="row2"> 
<input type="radio" name="allowsmilies" value="1" {ALWAYS_ALLOW_SMILIES_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="allowsmilies" value="0" {ALWAYS_ALLOW_SMILIES_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_BOARD_LANGUAGE}</td>
<td class="row2">{LANGUAGE_SELECT}</td>
</tr>
<tr> 
<td class="row1">{L_BOARD_STYLE}</td>
<td class="row2">{STYLE_SELECT}</td>
</tr>
<tr> 
<td class="row1">{L_TIMEZONE}</td>
<td class="row2">{TIMEZONE_SELECT}</td>
</tr>
<tr> 
<td class="row1">{L_DATE_FORMAT}<br />
<span class="gensmall">{L_DATE_FORMAT_EXPLAIN}</span></td>
<td class="row2"> 
<input type="text" name="dateformat" value="{DATE_FORMAT}" maxlength="16" class="post" />
</td>
</tr>
<tr> 
<td class="cat" colspan="2">&nbsp;</td>
</tr>
<tr> 
<th colspan="2">{L_SPECIAL}</th>
</tr>
<tr> 
<td class="row1" colspan="2"><span class="gensmall">{L_SPECIAL_EXPLAIN}</span></td>
</tr>
<!-- Start: phpBB Security -->
<tr>
<td class="row1">
<span class="gen">
{PS_LOCK}
</span>
<br />
<span class="gensmall">
{PS_LOCK_EXP}
</span>			
</td>
<td class="row2">
<span class="gensmall">
<input type="checkbox" name="ps_lock">  {PS_STATUS}
</span>
</td>
</tr>
<tr>
<td class="row1">
<span class="gen">
{PS_RESET}
</span>
<br />
<span class="gensmall">
{PS_RESET_EXP}
</span>			
</td>
<td class="row2">
<input type="checkbox" name="ps_reset">
</td>	
</tr>
<!-- End: phpBB Security -->
<tr> 
	  <td class="row1"><span class="gen">{L_UPLOAD_QUOTA}</span></td>
	  <td class="row2">{S_SELECT_UPLOAD_QUOTA}</td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_PM_QUOTA}</span></td>
	  <td class="row2">{S_SELECT_PM_QUOTA}</td>
	</tr>
<tr> 
<td class="row1">{L_USER_ACTIVE}</td>
<td class="row2"> 
<input type="radio" name="user_status" value="1" {USER_ACTIVE_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="user_status" value="0" {USER_ACTIVE_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ALLOW_PM}</td>
<td class="row2"> 
<input type="radio" name="user_allowpm" value="1" {ALLOW_PM_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="user_allowpm" value="0" {ALLOW_PM_NO} />
{L_NO}</td>
</tr>
<!-- Start add - Signatures control MOD -->
<tr> 
  <td class="row1"><span class="gen">{L_SIG_ALLOW_SIGNATURE}</span></td>
  <td class="row2"> 
	<input type="radio" name="user_allowsignature" value="2" {ALLOW_SIGNATURE_YES_NOT_CONTROLED} />
	<span class="gen">{L_SIG_YES_NOT_CONTROLED}</span>&nbsp;
	<input type="radio" name="user_allowsignature" value="1" {ALLOW_SIGNATURE_YES_CONTROLED} />
	<span class="gen">{L_SIG_YES_CONTROLED}</span>&nbsp;
	<input type="radio" name="user_allowsignature" value="0" {ALLOW_SIGNATURE_NO} />
	<span class="gen">{L_NO}</span></td>
</tr>
<!-- End replacement - Signatures control MOD -->
<tr> 
<td class="row1">{L_ALLOW_AVATAR}</td>
<td class="row2"> 
<input type="radio" name="user_allowavatar" value="1" {ALLOW_AVATAR_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="user_allowavatar" value="0" {ALLOW_AVATAR_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_SELECT_RANK}</td>
<td class="row2"> 
<select name="user_rank">{RANK_SELECT_BOX}
</select>
</td>
<!-- Start add - No copy MOD -->
	<tr> 
	  <td class="row1"><span class="gen">{L_EXTRA}?</span></td>
	  <td class="row2"> 
		<input type="checkbox" name="user_extra" {EXTRA_CHECKED}>
		{L_EXTRA_EXPLAIN}</td>
	</tr>
<!-- End add - No copy MOD -->
</tr>
<!-- BEGIN switch_show_delete -->
<tr> 
<td class="row1">{L_DELETE_USER}?</td>
<td class="row2"> 
<input type="checkbox" name="deleteuser" />
{L_DELETE_USER_EXPLAIN}</td>
</tr>
<!-- END switch_show_delete -->
<tr> 
<td class="row1"><span class="gen">{L_BANCARD}:</span><br /><span class="gensmall">{L_BANCARD_EXPLAIN}<br /></td> 
<td class="row2"><input type="text" class="post" style="width: 40px"  name="user_ycard" size="4" maxlength="4" value="{BANCARD}" /></td> 
</tr> 
<tr> 
<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS} 
<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
&nbsp;&nbsp; 
<input type="reset" value="{L_RESET}" class="button" />
</td>
</tr>
</table>
</form>
<br />