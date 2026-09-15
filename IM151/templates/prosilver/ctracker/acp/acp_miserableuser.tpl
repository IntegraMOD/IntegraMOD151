<h1>{L_HEADLINE}</h1>
<p>{L_SUBHEADLINE}</p>

<br />

<!-- BEGIN infobox -->
<div align="center">
<table width="80%" cellspacing="1" cellpadding="3" border="0" class="forumline">
	<tr>
		<td align="center" style="background-color:#{infobox.COLOR};"><b>{infobox.L_MESSAGE_TEXT}</b></td>
	</tr>
</table>
</div>

<br /><br />
<!-- END infobox -->

<form method="post" name="post" action="{S_FORM_ACTION}">
<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
	<tr>
		<th align="center">{L_MARK_MU}</th>
	</tr>
	<tr>
		<td class="row1" align="center">
			<input type="text" class="post" name="username" maxlength="50" size="20" />
			<input type="Submit" name="submit" value="{L_LOOK_UP}" class="mainoption" />
			<input type="button" name="usersubmit" value="{L_FIND_USERNAME}" class="liteoption" onClick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" />
		</td>
	</tr>
</table>
</form>

<br /><br />

<table width="100%" cellspacing="1" cellpadding="3" border="0" class="forumline">
	<tr> 
		<th colspan="2">{L_USER_ENTR}</th>
	</tr>
	<tr> 
		<th width="80%">{L_TH1}</th>
		<th width="20%">{L_TH2}</th>
	</tr>
<!-- BEGIN output -->
	<tr> 
		<td class="{output.ROW_CLASS}">{output.L_USERNAME}</td>
		<td class="{output.ROW_CLASS}" align="center"><b>[ <a href="{output.U_DELLINK}">{L_DELETE}</a> ]</b></td>
	</tr>
<!-- END output -->
<!-- BEGIN no_entry -->
	<tr> 
		<td class="row3" align="center" colspan="2"><b>{L_NOTHING}</b></td>
	</tr>
<!-- END no_entry -->
	<tr>
		<td class="catBottom" colspan="2">&nbsp;</td>
	</tr>
</table>