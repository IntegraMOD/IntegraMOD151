<form action="{S_LOGIN_ACTION}" method="post">
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
	<td class="maintitle">{L_LOGIN}</td>
</tr>
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_SEPARATOR}{L_LOGIN}</td>
</tr>
</table>
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
<th>{L_ENTER_PASSWORD}</th>
</tr>
<tr>
<td class="row1">
<table border="0" cellpadding="3" cellspacing="1" width="100%">
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td width="45%" align="right" class="explaintitle">{L_USERNAME}:</td>
<td width="55%">
<input type="text" name="username" size="25" maxlength="40" value="{USERNAME}" class="post" />
</td>
</tr>
<tr>
<td align="right" class="explaintitle">{L_PASSWORD}:</td>
<td>
<input type="password" name="password" size="25" maxlength="32" class="post" />
</td>
</tr>
<tr>
<td colspan="2" align="center">
<table border="0" cellspacing="0" cellpadding="0">
<!-- BEGIN switch_allow_autologin -->
<tr>
<td class="genmed">{L_AUTO_LOGIN}:&nbsp;</td>
<td><input name="autologin" type="checkbox" /></td>
</tr>
<!-- END switch_allow_autologin -->
</table>
</td>
</tr>
<!-- BEGIN switch_confirm -->
<tr>
<td class="row1" colspan="2" align="center">
<br /><br /><span class="gen">{L_CONFIRM_CODE}</span>
<span class="gensmall">&nbsp;</span><br /><br />{CONFIRM_IMG}<br /><br /></td>
</tr>
<tr>
<td colspan="2" align="center" class="row2">
<input type="text" class="post" name="confirm_code" size="25" maxlength="6" value="" />
<br /><br />
</td>
</tr>
<!-- END switch_confirm -->
<tr>
<td colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="login" class="mainoption" value="{L_LOGIN}" />
</td>
</tr>
<tr>
<td colspan="2" class="gensmall" align="center"><a href="{U_SEND_PASSWORD}">{L_SEND_PASSWORD}</a></td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="cat">&nbsp;</td>
</tr>
</table>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_SEPARATOR}{L_LOGIN}</td>
</tr>
</table>
</form>
