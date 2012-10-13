<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>
<p>{HELP}</p>

<form action="{S_ACTION}" name="post" method="post">

<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<th nowrap="nowrap">{L_NAME}</th>
	<th nowrap="nowrap">{L_DESC}</th>
	<th nowrap="nowrap">{L_ORDER}</th>
	<th nowrap="nowrap">{L_DEFAULT}</th>
	<th nowrap="nowrap">{L_FORCE}</th>
	<th nowrap="nowrap">{L_SELECT}</th>
	<th nowrap="nowrap">{L_HIDDEN}</th>
</tr>
<!-- BEGIN message -->
<tr>
	<td class="errorline" align="center" colspan="7">
		{message.text}
	</td>
</tr>
<!-- END message -->
<!-- BEGIN fields -->
<tr>
	<td class="{fields.COLOR}">{fields.name}</td>
	<td class="{fields.COLOR}"><span class="gensmall">{fields.explain}</span></td>
	<td class="{fields.COLOR}" align="center"><input type="text" name="{fields.ordername}" value="{fields.ordervalue}" class="post" size="5"></td>
	<td class="{fields.COLOR}" align="center"><input type="radio" name="{fields.optionname}" {fields.defaultchecked} value="{fields.defaultvalue}"></td>
	<td class="{fields.COLOR}" align="center"><input type="radio" name="{fields.optionname}" {fields.forcechecked} value="{fields.forcevalue}"></td>
	<td class="{fields.COLOR}" align="center"><input type="radio" name="{fields.optionname}" {fields.selectchecked} value="{fields.selectvalue}"></td>
	<td class="{fields.COLOR}" align="center"><input type="radio" name="{fields.optionname}" {fields.hiddenchecked} value="{fields.hiddenvalue}"></td>
</tr>
<!-- END fields -->
<tr>
	<td class="cat" align="center" colspan="7">
		<input type="submit" name="{SUBMIT_NAME}" value="{L_SUBMIT}" class="mainoption" />
	</td>
</tr>
</table>
</form>
<br />