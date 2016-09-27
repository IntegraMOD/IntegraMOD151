
<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form method="post" action="{S_ACTION}">
<table width="100%" cellpadding="4" cellspacing="1" border="0"><tr><td class="nav">{S_NAV_DESC}</td></tr></table>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
<tr>
	<th align="center" colspan="2">{L_TITLE}</th>
</tr>
<tr>
	<td class="row2" width="50%"><span class="gen">{L_NAME}</span><span class="gensmall"><br />{L_NAME_EXPLAIN}</span></td>
	<td class="row1" width="50%">
		<span class="gen">
			<input type="text" name="name" value="{NAME}" />&nbsp;
			<input type="submit" name="import_field" value="{L_IMPORT}" class="liteoption" />
		</span>
	</td>
</tr>
<tr>
	<td class="cat" align="center" colspan="2"><span class="cattitle">{L_SHORTCUT}</span></td>
</tr>
<tr>
	<td class="row2"><span class="gen">{L_USE_VALUE}</span><span class="gensmall"><br />{L_USE_VALUE_EXPLAIN}</span></td>
	<td class="row1">
		<span class="gen">
			<input type="radio" name="use_value" value="1" {USE_VALUE_YES} />{L_YES}&nbsp;
			<input type="radio" name="use_value" value="0" {USE_VALUE_NO} />{L_NO}
		</span>
	</td>
</tr>
<tr>
	<td class="row2"><span class="gen">{L_SHORTCUT}</span><span class="gensmall"><br />{L_SHORTCUT_EXPLAIN}</span></td>
	<td class="row1"><span class="gen"><input type="text" name="shortcut" value="{SHORTCUT}" /><br />{SHORTCUT_TR}</span></td>
</tr>
<tr>
	<td class="row2"><span class="gen">{L_EXPLAIN}</span><span class="gensmall"><br />{L_EXPLAIN_EXPLAIN}</span></td>
	<td class="row1"><span class="gen"><input type="text" name="explain" size="50" value="{EXPLAIN}" /><br />{EXPLAIN_TR}</span></td>
</tr>
<tr>
	<td class="cat" align="center" colspan="2"><span class="cattitle">{L_ICON}</span></td>
</tr>
<tr>
	<td class="row2"><span class="gen">{L_USE_ICON}</span><span class="gensmall"><br />{L_USE_ICON_EXPLAIN}</span></td>
	<td class="row1">
		<span class="gen">
			<input type="radio" name="use_icon" value="1" {USE_ICON_YES} />{L_YES}&nbsp;
			<input type="radio" name="use_icon" value="0" {USE_ICON_NO} />{L_NO}
		</span>
	</td>
</tr>
<tr>
	<td class="row2"><span class="gen">{L_ICON}</span><span class="gensmall"><br />{L_ICON_EXPLAIN}</span></td>
	<td class="row1"><span class="gen"><input type="text" size="50" name="icon" value="{ICON}" /><br />{ICON_TR}</span></td>
</tr>
<tr>
	<td class="cat" align="center" colspan="2"><span class="cattitle">{L_URL}</span></td>
</tr>
<tr>
	<td class="row2"><span class="gen">{L_INTERNAL}</span><span class="gensmall"><br />{L_INTERNAL_EXPLAIN}</span></td>
	<td class="row1">
		<span class="gen">
			<input type="radio" name="internal" value="1" {INTERNAL_YES} />{L_YES}&nbsp;
			<input type="radio" name="internal" value="0" {INTERNAL_NO} />{L_NO}
		</span>
	</td>
</tr>
<tr>
   <td class="row2"><span class="gen">{L_WINDOW}</span><span class="gensmall"><br />{L_WINDOW_EXPLAIN}</span></td>
   <td class="row1">
      <span class="gen">
         <input type="radio" name="window" value="1" {WINDOW_YES} />{L_YES}&nbsp;
         <input type="radio" name="window" value="0" {WINDOW_NO} />{L_NO}
      </span>
   </td>
</tr>
<tr>
	<td class="row2"><span class="gen">{L_URL}</span><span class="gensmall"><br />{L_URL_EXPLAIN}</span></td>
	<td class="row1"><span class="gen"><input type="text" size="50" name="url" value="{URL}" /></span></td>
</tr>
<tr>
	<td class="cat" align="center" colspan="2"><span class="cattitle">{L_AUTH}</span></td>
</tr>
<tr>
	<td class="row2"><span class="gen">{L_AUTH_LOGGED}</span><span class="gensmall"><br />{L_AUTH_LOGGED_EXPLAIN}</span></td>
	<td class="row1">
		<span class="gen">
			<input type="radio" name="auth_logged" value="0" {AUTH_LOGGED_IGNORE} />{L_IGNORE}&nbsp;
			<input type="radio" name="auth_logged" value="1" {AUTH_LOGGED_REQUIRE} />{L_REQUIRE}&nbsp;
			<input type="radio" name="auth_logged" value="2" {AUTH_LOGGED_DENY} />{L_DENY}
		</span>
	</td>
</tr>
<tr>
	<td class="row2"><span class="gen">{L_AUTH_ADMIN}</span><span class="gensmall"><br />{L_AUTH_ADMIN_EXPLAIN}</span></td>
	<td class="row1">
		<span class="gen">
			<input type="radio" name="auth_admin" value="0" {AUTH_ADMIN_IGNORE} />{L_IGNORE}&nbsp;
			<input type="radio" name="auth_admin" value="1" {AUTH_ADMIN_REQUIRE} />{L_REQUIRE}&nbsp;
			<input type="radio" name="auth_admin" value="2" {AUTH_ADMIN_DENY} />{L_DENY}
		</span>
	</td>
</tr>
<tr>
	<td class="row2"><span class="gen">{L_TREE_ID}</span><span class="gensmall"><br />{L_TREE_ID_EXPLAIN}</span></td>
	<td class="row1"><span class="gen">{S_TREE_ID}</td>
</tr>
<tr>
	<td class="cat" align="center" colspan="2"><span class="cattitle">{L_PRIVATE_MESSAGE}</span></td>
</tr>
<tr>
	<td class="row2"><span class="gen">{L_ALTERNATE}</span><span class="gensmall"><br />{L_ALTERNATE_EXPLAIN}</span></td>
	<td class="row1"><span class="gen"><input type="text" name="alternate" value="{ALTERNATE}" /></span></td>
</tr>
<tr>
	<td class="row2"><span class="gen">{L_AUTH_PM}</span><span class="gensmall"><br />{L_AUTH_PM_EXPLAIN}</span></td>
	<td class="row1">
		<span class="gen">
			<input type="radio" name="auth_pm" value="0" {AUTH_PM_IGNORE} />{L_IGNORE}&nbsp;
			<input type="radio" name="auth_pm" value="1" {AUTH_PM_NEW} />{L_PM_NEW}&nbsp;
			<input type="radio" name="auth_pm" value="2" {AUTH_PM_NO_NEW} />{L_PM_NO_NEW}&nbsp;
			<input type="radio" name="auth_pm" value="3" {AUTH_PM_UNREAD} />{L_PM_UNREAD}
		</span>
	</td>
</tr>
<tr>
	<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;
		<input type="submit" name="refresh" value="{L_REFRESH}" class="liteoption" />&nbsp;
		<input type="submit" name="cancel" value="{L_CANCEL}" class="liteoption" />
	</td>
</tr>
</table>
</form>