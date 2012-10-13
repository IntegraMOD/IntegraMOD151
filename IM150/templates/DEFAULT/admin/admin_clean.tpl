<table width="100%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<form method="post" name="choix" action="{ACTION}">
	<tr>
	  <th class="thHead" colspan="3">{L_TITLE}</th>
	</tr>
	<tr>
		<td class="row1" align="center">{L_CHOICE}</td>
		<td class="row1" align="center">{L_TYPE}</td>
		<td class="row1" align="center">{L_NUMBER}</td>
	</tr>
        <!-- BEGIN admin_clean -->
	<tr>
		<td class="row2" align=center>{admin_clean.CHOICE}</td>
		<td class="row2">{admin_clean.TYPE}</td>
		<td class="row2" align=center>{admin_clean.NUMBER}</td>
	</tr>
        <!-- END admin_clean -->
	<tr>
		<td class="row1" align="center" colspan=3><input type=submit name="action" value="{L_LAUNCH}"></td>
	</tr>
</form>
</table>

<br />