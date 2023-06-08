<table width="100%" border="0" cellpadding="3" cellspacing="1" class="forumline">
<tr> 
<th>Poll :: {POLL_QUESTION}</th>
</tr>
<tr>
<td class="row2">
<br />
<table cellspacing="0" cellpadding="4" border="0" align="center">
<tr> 
<td><table cellspacing="0" cellpadding="2" border="0">
<!-- BEGIN poll_option -->
<tr> 
<td>{poll_option.POLL_OPTION_CAPTION}</td>
<td> <table cellspacing="0" cellpadding="0" border="0">
<tr> 
<td><img src="{VOTE_LEFT_IMAGE}" alt="" /></td>
<td><img src="{poll_option.POLL_OPTION_IMG}" width="{poll_option.POLL_OPTION_IMG_WIDTH}" height="12" alt="{poll_option.POLL_OPTION_PERCENT}" title="{poll_option.POLL_OPTION_PERCENT}" /></td>
<td><img src="{VOTE_RIGHT_IMAGE}" alt="" /></td>
</tr>
</table></td>
<td align="center">&nbsp;<strong>{poll_option.POLL_OPTION_PERCENT}</strong>&nbsp;</td>
<td align="center">[ {poll_option.POLL_OPTION_RESULT} ]</td>
</tr>
<!-- END poll_option -->
</table></td>
</tr>
<tr> 
<td colspan="4" align="center"><span class="gen"><b>{VOTED_SHOW}{voted_vote}</b></span></td>
</tr>
<tr> 
<td colspan="4" align="center"><span class="gen"><b>{L_TOTAL_VOTES} : {TOTAL_VOTES}</b></span></td>
</tr>
<tr> 
<td colspan="4" align="center"><span class="gensmall">{L_RESULTS_AFTER}</span></td>
</tr>
<tr> 
<td colspan="4" align="center"><span class="gensmall">{L_POLL_EXPIRES}{POLL_EXPIRES}</span></td>
</tr>
</table>
<br />
</td>
</tr>
</table>
<br />