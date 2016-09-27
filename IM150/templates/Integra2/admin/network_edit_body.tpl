
<h1>{L_NETWORK_TITLE}</h1>

<p>{L_NETWORK_TEXT}</p>

<form method="post" action="{S_FORM_ACTION}"><table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline" width="100%">
	<tr>
		<th class="thHead" colspan="2">{L_SITE_CONFIG}</th>
	</tr>
	<tr>
		<td class="row2" colspan="2">{L_REQUIRED}</td>
	</tr>
	<tr>
		<td class="row1" width="35%">{L_SITENAME}*</td>
		<td class="row2"><input class="post" type="text" name="site_name" value="{NAME}" maxlength="50" /></td>
	</tr>
	<tr>
		<td class="row1">{L_URL}*</td>
		<td class="row2"><input class="post" type="text" name="site_url" value="{URL}" size="50" maxlength="100" /></td>
	</tr>
	<tr>
		<td class="row1">{L_EXT}<br /><span class="gensmall">{L_EXT_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" name="site_phpex" value="{EXT}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_PROFILE_PATH}<br /><span class="gensmall">{L_PROFILE_PATH_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" name="site_profile" value="{PROFILE_PATH}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_ENABLED}<br /><span class="gensmall">{L_ENABLED_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="radio" name="site_enable" value="1" {ENABLED_YES} /> {L_YES} <input class="post" type="radio" name="site_enable" value="0" {ENABLED_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="catbottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input class="mainoption" type="submit" value="{L_SUBMIT}" /></td>
	</tr>
</table></form>
