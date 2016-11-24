
<h1>{L_CURRENCY_CONFIGURATION_TITLE}</h1>

<p>{L_CURRENCY_CONFIGURATION_EXPLAIN}</p>

<form action="{S_CURRENCY_CONFIG_ACTION}" method="post"><table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
	  <th class="thHead" colspan="2">{L_CURRENCY_GENERAL_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_DONATE_CURRENCY}<br /><span class="gensmall">{L_DONATE_CURRENCY_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="donate_currencies" value="{DONATE_CURRENCY}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_DONATE_CURRENCY_PRI}<br /><span class="gensmall">{L_DONATE_CURRENCY_PRI_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="paypal_currency_code" value="{DONATE_CURRENCY_PRI}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_DONATE_USD_TO_PRI}<br /></td>
		<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="usd_to_primary" value="{DONATE_USD_TO_PRI}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_DONATE_EUR_TO_PRI}<br /></td>
		<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="eur_to_primary" value="{DONATE_EUR_TO_PRI}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_DONATE_GBP_TO_PRI}<br /></td>
		<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="gbp_to_primary" value="{DONATE_GBP_TO_PRI}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_DONATE_CAD_TO_PRI}<br /></td>
		<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="cad_to_primary" value="{DONATE_CAD_TO_PRI}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_DONATE_JPY_TO_PRI}<br /></td>
		<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="jpy_to_primary" value="{DONATE_JPY_TO_PRI}" /></td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="mode" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>
</table></form>

<br clear="all" />
