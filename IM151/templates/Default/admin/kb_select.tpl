
<h1>{L_FIELD_TITLE}</h1>

<p>{L_FIELD_EXPLAIN}</p>

<form action="{S_FIELD_ACTION}" method="post">
<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr>
	<th  class="thHead">{L_SELECT_TITLE}</b></th>
  </tr>
  <tr>
	<td align="center" class="row1" >
	<input class="liteoption" type="submit" value="add" name="mode">&nbsp;
	<input class="liteoption" type="submit" value="edit" name="mode">&nbsp;
	<input class="liteoption" type="submit" value="delete" name="mode"></td>
  </tr>
  <tr>
	<th  class="thHead">{L_FIELD_TITLE}</b></th>
  </tr>
<!-- BEGIN field_row -->
  <tr>
	<td width="97%" class="row1" align="center"><b>{field_row.FIELD_NAME}</b><br><span class="gensmall">{field_row.FIELD_DESC}</span></td>
</tr>
<!-- END field_row -->

</table>
</form>
