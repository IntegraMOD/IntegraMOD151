
<h1>{L_FIELD_TITLE}</h1>

<p>{L_FIELD_EXPLAIN}</p>

<form action="{S_FIELD_ACTION}" method="post">
<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr>
	<th colspan="2" class="thHead">{L_FIELD_TITLE}</th>
  </tr>
<!-- BEGIN field_row -->
	<tr>
	 <td width="3%" class="row1" align="center" valign="middle"><input type="radio" name="field_id" value="{field_row.FIELD_ID}" {field_row.SELECTED} /></td>
	 <td width="97%" class="row1"><b>{field_row.FIELD_NAME}</b><br /><span class="gensmall">{field_row.FIELD_DESC}</span></td></tr>
<!-- END field_row -->
 	<td align="center" class="cat" colspan="2">
	{S_HIDDEN_FIELDS}<input class="liteoption" type="submit" value="{L_FIELD_TITLE}" name="submit">
	</td>
  </tr>
</table>
</form>

