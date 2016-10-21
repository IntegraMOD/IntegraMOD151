<form method="POST" action="{S_POLL_ACTION}">
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="forumline">
<tr>
<td align="center"><span class="gen" style="color: red"><b>{MAX_VOTING_1_EXPLAIN}{max_vote}{MAX_VOTING_2_EXPLAIN}{POLL_VOTE_BR}</b></span><span class="gen" style="color: darkred">{MAX_VOTING_3_EXPLAIN}{POLL_VOTE_BR}{POLL_VOTE_BR}</span></td>
</tr>
<tr> 
<th>Poll :: {POLL_QUESTION}</th>
</tr>
<tr>
<td align="center" class="row2">
<br />
<table cellspacing="0" cellpadding="1" border="0">
<!-- BEGIN poll_option -->
<tr> 
<td> 
<input type="{poll_option.POLL_VOTE_BOX}" name="vote_id[]" value="{poll_option.POLL_OPTION_ID}" />&nbsp;</td>
<td class="postbody">{poll_option.POLL_OPTION_CAPTION}</td>
</tr>
<!-- END poll_option -->
</table>
<br />
{S_HIDDEN_FIELDS}
</td>
</tr>
<tr>
	<td align="center" class="cat"><table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><input type="submit" name="submit" value="{L_SUBMIT_VOTE}" class="mainoption" /></td>
			<td>&nbsp;&nbsp;</td>
			<td class="fakebut"><a class="but" href="{U_VIEW_RESULTS}">&nbsp; {L_VIEW_RESULTS} &nbsp;</a></td>
		</tr>
	</table>
		</td>
</tr>
</table>
</form>
<br />