<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<p>{HELP}</p>

<form action="{S_ACTION}" name="post" method="post">
<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<!-- BEGIN message -->
<tr>
	<td class="errorline" align="center" colspan="4">
		{message.text}
	</td>
</tr>
<!-- END message -->
<tr>
	<th nowrap="nowrap">{L_TYPE}</th>
	<th nowrap="nowrap">{L_DEFINITION}</th>
</tr>
<!-- BEGIN type -->
<tr>
<td valign="top" class="{type.COLOR}"><span class="explaintitle">{type.title}</span></td>
<td class="{type.COLOR}" align="center">
	<textarea rows="10" cols="60" wrap="virtual" name="{type.name}" class="post"></textarea>
</td>
</tr>
<tr><td class="{type.COLOR}" colspan="2"><span class="gensmall">{type.explain}</span></td></tr>
<!-- END type -->
<tr>
	<td class="cat" align="center" colspan="5">
		<input type="submit" name="{SUBMIT_NAME}" value="{L_SUBMIT}" class="mainoption"/>
	</td>
</tr>
</table>
</form>
<br />