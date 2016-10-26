<form action="{S_FORM_ACTION}" method="post" target="_top">

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
	<td align="left" class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
  </tr>
</table>

<br />

<table width="80%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
  <tr> 
	<th height="25" nowrap="nowrap" colspan="2">{L_HEADER_TEXT}</th>
  </tr>
  <tr>
  	<td class="row2" rowspan="2"><img src="{PAGE_ICON}" border="0" alt="{L_HEADER_TEXT}" title="{L_HEADER_TEXT}"></td>
	<td class="row1"><span class="gen">{L_DESCRIPTION} <br /><br /><br /><br /> </span></td>
  </tr>
  <tr>
  	<td class="row2" align="center">
  		<br />
		{CONFIRM_IMAGE}
		{S_HIDDEN_FIELDS}
		<br /><br />
		<span class="gen">
			<input type="text" name="confirm_code" value="" class="post"> <b>&raquo;</b> <input type="Submit" name="submit" value="{L_BUTTON_TEXT}" class="mainoption">
		</span>
		<br /><br />
  	</td>
  </tr>
  <tr>
  	<td class="row3" align="right" colspan="2">&nbsp;</td>
  </tr>
</table>

<br />

</form>