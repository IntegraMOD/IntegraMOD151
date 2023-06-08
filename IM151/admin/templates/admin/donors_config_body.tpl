
<h1>{L_DONOR_CONFIGURATION_TITLE}</h1>

<p>{L_DONOR_CONFIGURATION_EXPLAIN}</p>

<form action="{S_DONOR_CONFIG_ACTION}" method="post"><table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
	  <th class="thHead" colspan="2">{L_DONOR_GENERAL_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_USER_ACCOUNT}</td>
		<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="user_account" value="{USER_ACCOUNT}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_DONATE_MONEY}<br /></td>
		<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="lw_money" value="{DONATE_MONEY}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_DONATE_DATE}<br /><span class="gensmall">{L_DONATE_DATE_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="lw_date" value="{SCRIPT_PATH}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_TRANSACTION_ID}<br /></td>
		<td class="row2"><input class="post" type="text" size="40" maxlength="100" name="txn_id" value="{TRANSACTION_ID}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_DONOR_PAY_ACCOUNT}<br /><span class="gensmall">{L_DONOR_PAY_ACCOUNT_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="40" maxlength="255" name="donor_pay_acct" value="{DONOR_PAY_ACCOUNT}" /></td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>
</table></form>

<br clear="all" />
