<h2>{L_INSTALLED}</h2>
<p>{L_INSTALLED_DESC}</p>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
	<td>
		<form action="{S_ACTION}" method="post">
			{L_FILTER_BY_FILE}:
			<select name="filter_option">{S_FILTER_OPTIONS}</select>
			<input type="submit" name="filter" value="{L_FILTER}" class="liteoption" />
			{S_HIDDEN_FIELDS}
		</form>
	</td>
	<td align="right">
		{L_TOTAL_MODS}: {S_TOTAL_MODS} ({L_HISTORY_STATUS})
	</td>
  </tr>
</table>
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
  <tr> 
	<th width="10%" height="25" class="thCornerL">{L_INSTALL_DATE}</th>
	<th width="20%" height="25" class="thTop">{L_MOD_NAME}</th>
	<th width="5%"  height="25" class="thTop">{L_VERSION}</th>
	<th width="10%" height="25" class="thTop">{L_AUTHOR}</th>
	<th width="10%" height="25" class="thTop">{L_PHPBB_VER}</th>
	<th width="20%" height="25" class="thTop">{L_THEMES}</th>
	<th width="15%" height="25" class="thTop">{L_LANGUAGES}</th>
	<th width="10%" height="25" class="thCornerR">&nbsp; &nbsp;</th>
  </tr>
  <!-- BEGIN install -->
  <tr> 
	<td width="15%" class="{install.ROW_CLASS}" align="left"><span class="gen">{install.INSTALL_DATE}</span></td>
	<td width="20%" class="{install.ROW_CLASS}" align="left"><span class="gen">{install.TITLE}</span></td>
	<td width="5%"  class="{install.ROW_CLASS}" align="center"><span class="gen">{install.VERSION}</span></td>
	<td width="10%" class="{install.ROW_CLASS}" align="center"><span class="gen"><a href="{install.URL}" class="gen">{install.AUTHOR}</a></span></td>
	<td width="10%" class="{install.ROW_CLASS}" align="center"><span class="gen">{install.PHPBB_VER}</span></td>
	<td width="20%" class="{install.ROW_CLASS}" align="left"><span class="gen">{install.THEMES}</span></td>
	<td width="15%" class="{install.ROW_CLASS}" align="left"><span class="gen">{install.LANGS}</span></td>
	<td width="5%"  class="{install.ROW_CLASS}" align="center">
		<form action="{install.S_ACTION}" method="post">
			{install.S_HIDDEN_FIELDS}
			<input type="submit" name="submit" value="{S_DETAILS}" class="liteoption">
		</form>
	</td>
  </tr>
  <!-- END install -->

  <!-- BEGIN no_install -->
  <tr>
	<td colspan="8" align="center" class="row1"><span class="gen">{L_NONE_INSTALLED}</span></td>
  </tr>
  <!-- END no_install -->
</table>

<br />