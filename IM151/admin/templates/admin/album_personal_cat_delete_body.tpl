<table width="100%" cellpadding="4" cellspacing="1" border="0">
<tr>
	<td class="nav" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a> {ALBUM_NAVIGATION_ARROW} <a href="{U_ALBUM}" class="nav">{L_ALBUM}</a> {ALBUM_NAVIGATION_ARROW} <a href="{U_PERSONAL_ALBUM}" class="nav">{L_PERSONAL_ALBUM}</a> {ALBUM_NAVIGATION_ARROW} <a href="{U_PERSONAL_CAT_ADMIN}" class="nav">{L_PERSONAL_CAT_ADMIN}</a></span></td>
</tr>
</table>

<form action="{S_ALBUM_ACTION}" method="post">
<table cellpadding="4" cellspacing="1" border="0" class="forumline" align="center" width="100%">
	<tr>
	  <th colspan="2" class="thHead">{L_PERSONAL_CAT_ADMIN}</th>
	</tr>
	<tr>
		<td class="row1" colspan="2"><br />
		  <table cellpadding="4" cellspacing="1" border="0" class="forumline" align="center" width="100%">
			<tr>
			  <th colspan="2" class="thHead">{L_CAT_DELETE}</th>
			</tr>
			<tr>
			  <td class="row1" width="25%"><span class="gen">{L_CAT_TITLE}</span></td>
			  <td class="row1"><span class="genmed">{S_CAT_TITLE}</span></td>
			</tr>
			<tr>
			  <td class="row1" width="25%"><span class="genmed">{L_MOVE_CONTENTS}</span></td>
			  <td class="row1">{S_SELECT_TO}</td>
			</tr>
			<tr>
			  <td class="catBottom" colspan="2" align="center"><input type="hidden" name="mode" value="delete" /><input type="submit" name="submit" value="{L_MOVE_DELETE}" class="mainoption" /></td>
			</tr>
		  </table>
		</td>
	</tr>
</table>
</form>

<br />
