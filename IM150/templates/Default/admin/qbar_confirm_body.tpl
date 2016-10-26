
<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form method="post" action="{S_ACTION}">
<table width="100%" cellpadding="4" cellspacing="1" border="0"><tr><td class="nav">{S_NAV_DESC}</td></tr></table> 

<table class="forumline" width="100%" cellspacing="1" cellpadding="4" border="0">
<tr>
	<th class="thHead" height="25" valign="middle"><span class="tableTitle">{MESSAGE_TITLE}</span></th>
</tr>
<tr>
	<td class="row1" align="center">{S_HIDDEN_FIELDS}
		<span class="gen">
			<br />{MESSAGE_TEXT}<br /><br />
			<input type="submit" name="submit" value="{L_YES}" class="mainoption" />&nbsp;&nbsp;
			<input type="submit" name="cancel" value="{L_NO}" class="liteoption" />
		</span>
	</td>
</tr>
</table>

<br clear="all" />
