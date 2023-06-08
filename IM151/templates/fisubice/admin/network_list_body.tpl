
<h1>{L_NETWORK_TITLE}</h1>

<p>{L_NETWORK_TEXT}</p>

<form method="post" action="{S_FORM_ACTION}"><table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
	<tr>
		<th class="thCornerL">{L_SITENAME}</th>
		<th class="thTop">{L_URL}</th>
		<th class="thTop">{L_EXT}</th>
		<th class="thTop">{L_ENABLED}</th>
		<th colspan="2" class="thCornerR">{L_ACTION}</th>
	</tr>
	<!-- BEGIN sites -->
	<tr>
		<td class="{sites.ROW_CLASS}">{sites.NAME}</td>
		<td class="{sites.ROW_CLASS}"><a href="{sites.URL}" target="_blank">{sites.URL}</a></td>
		<td class="{sites.ROW_CLASS}">{sites.EXT}</td>
		<td class="{sites.ROW_CLASS}">{sites.ENABLED}</td>
		<td class="{sites.ROW_CLASS}"><a href="{sites.U_SITE_EDIT}">{L_EDIT}</a></td>
		<td class="{sites.ROW_CLASS}"><a href="{sites.U_SITE_DELETE}">{L_DELETE}</a></td>
	</tr>
	<!-- END sites -->
	<tr>
		<td class="catBottom" colspan="6" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="add" value="{L_NETWORK_ADD}" class="mainoption" />
		<input type="submit" name="autodetect" value="{L_NETWORK_AUTODETECT}" class="liteoption" /></td>
	</tr>
</table></form>
