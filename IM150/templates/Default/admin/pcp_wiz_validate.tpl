<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<p>{AUTOCORRECT}</p>

<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<!-- BEGIN message -->
<tr>
	<td class="errorline" align="center" colspan="4">
		{message.text}
	</td>
</tr>
<!-- END message -->
<!-- BEGIN type -->
<tr><td align="center" colspan="4"><h1>{type.L_TITLE}</h1></td></tr>
<tr>
	<th nowrap="nowrap">{type.L_FIELD}</th>
	<th nowrap="nowrap">{type.L_REQUIRED}</th>
	<th nowrap="nowrap">{type.L_DELETE}</th>
	<th nowrap="nowrap">{type.L_MOVE}</th>
</tr>
<!-- BEGIN page -->
<tr><td align="center" colspan="4"><h2>{type.page.text}</h2></td></tr>
<!-- BEGIN titleerror -->
<tr><td class="errorline" align="center" colspan="4">{type.page.titleerror.text}</td></tr>
<!-- END titleerror -->
<!-- BEGIN fields -->
<!-- BEGIN notinfields -->
<tr><td class="errorline" align="center" colspan="4">{type.page.fields.notinfields.text}</td></tr>
<!-- END notinfields -->
<tr>
	<td class="{type.page.fields.COLOR}" nowrap>{type.page.fields.field}<br /><span class="gensmall">{type.page.fields.description}</span></td>
	<td class="{type.page.fields.COLOR}" nowrap>
		<ul>
		<!-- BEGIN required -->
		<li>{type.page.fields.required.key}</li>
		<!-- END required -->
		</ul>
	</td>
	<td class="{type.page.fields.COLOR}" nowrap>
		<ul>
		<!-- BEGIN delete -->
		<li>{type.page.fields.delete.key}<br /><span class="gensmall">({type.page.fields.delete.value})</span></li>
		<!-- END delete -->
		</ul>
	</td>
	<td class="{type.page.fields.COLOR}" nowrap>
		<ul>
		<!-- BEGIN move -->
		<li>{type.page.fields.move.key}<br /><span class="gensmall">({type.page.fields.move.value})</span></li>
		<!-- END move -->
		</ul>
	</td>
</tr>
<!-- END fields -->
<tr><td colspan="4">&nbsp;</td></tr>
<!-- END page -->
<tr><td colspan="4">&nbsp;</td></tr>
<!-- END type -->
</table>
</form>
<p>{HELP}</p>
<br />