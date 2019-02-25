<tr>
	<td colspan="2"><table cellspacing="0" cellpadding="4" border="0" align="center"><form method="POST" action="{S_POLL_ACTION}">
		<tr>
			<td align="center"><span class="gensmall"><b>{B_POLL_QUESTION}</b></span></td>
		</tr>
		<tr>
			<td align="center"><table cellspacing="0" cellpadding="2" border="0">
				<!-- BEGIN b_poll_option -->
				<tr>
					<td><input type="radio" name="vote_id" value="{b_poll_option.B_POLL_OPTION_ID}" />&nbsp;</td>
					<td><span class="gensmall">{b_poll_option.B_POLL_OPTION_CAPTION}</span></td>
				</tr>
				<!-- END b_poll_option -->
			</table></td>
		</tr>
		<tr>
			<td align="center">
			 <!-- BEGIN switch_user_logged_in -->
			 <input type="submit" name="submit" value="{B_L_SUBMIT_VOTE}" class="liteoption" />
			 <!-- END switch_user_logged_in -->		
			 <!-- BEGIN switch_user_logged_out -->
			 <span class="gensmall">{B_LOGIN_TO_VOTE}<span>
			 <!-- END switch_user_logged_out -->
			</td>
		</tr>
	{B_S_HIDDEN_FIELDS}</form></table></td>
</tr>