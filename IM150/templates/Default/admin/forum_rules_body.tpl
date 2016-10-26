
<h1>{L_FORUM_RULES}</h1>

<p>{L_FORUM_RULES_EXPLAIN}</p>

<form method="post"	action="{S_FORUMRULES_ACTION}">
  <table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
	<tr> 
	  <th class="thHead">{L_FORUM_RULES} ({RULES_DATE})</th>
	</tr>

	<tr>
	  <td class="row1">{S_RULES_DATA}{RULES_DATA}</td>
	</tr>

	<tr> 
	  <td class="cat" align="center" colspan="2">
		<input type="submit" name="dorules" value="{L_DO}" class="mainoption">
	  </td>
	</tr>
  </table>
</form>

<div align="center">
	<span class="copyright">
		<a href="{U_NOTVIEW_RULES}">{L_NOTVIEW_RULES}</a><br /><br /><br />
	</span>
</div>