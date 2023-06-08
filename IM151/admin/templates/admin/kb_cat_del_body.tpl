
<h1>{L_DELETE_TITLE}</h1>

<p>{L_DELETE_DESCRIPTION}</p>

  <table cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
	<tr> 
<form action="{S_ACTION}" method="post">
	  <th colspan="2" class="thHead">{L_CAT_DELETE}</th>
	  </tr>
	<tr> 
	  <td class="row1">{L_CAT_NAME}</td>
	  <td class="row1"><span class="row1">{CAT_NAME}</span></td>
	</tr>
	<tr> 
	  <td class="row1">{L_MOVE_CONTENTS}</td>
	  <td class="row1"><select name="move_id"><option value="0">{L_DELETE_ARTICLES}</option>{S_SELECT_TO}</select></td>
	</tr>
	<tr> 
	  <td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_DELETE}" class="mainoption" /></td>
	</tr>
  </table>
</form>