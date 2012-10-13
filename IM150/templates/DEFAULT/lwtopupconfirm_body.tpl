  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr> 
	  <td align="left" valign="middle" class="nav" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a href="{S_LW_TOPUP}" class="nav">{L_LW_TOPUP}</a></td>
	</tr>
  </table>

  <table width="100%" cellpadding="0" cellspacing="10" border="0">
  <tr>
  	<td valign="top" align="center">
	<form action="{LW_PAYPAL_ACTION}" method="post">
	<table cellpadding="4" cellspacing="1" border="0" class="forumline" width="100%">
	<tr> 
		<th colspan="2" valign="middle">{L_LW_TOPUP_TITLE}</th>
	</tr>
	<tr> 
	  <td class="row1" colspan=2 width="100%" align="center">
	  	<span class="gen">{L_LW_AMOUNT_TO_PAY}</span>
	  </td>
	</tr>
	<tr> 
	  <td class="row1" colspan=2 width="100%" align="center"><span class="gen">
	  	<input type="image" src="{LW_PAYPAL_LOGO}" name="submit" alt="{L_LW_PAYPAL_EXPLAIN}">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="amount" value="{LW_PAY_AMOUNT}">
		<input type="hidden" name="currency_code" value="{LW_PAY_CURRENCY}">
		<input type="hidden" name="business" value="{LW_BUSINESS_ACCT}">
		<input type="hidden" name="item_name" value="{LW_ITEM_NAME}">
		<input type="hidden" name="item_number" value="{LW_ITEM_NUMBER}">
		<input type="hidden" name="no_shipping" value="1">	
		<input type="hidden" name="notify_url" value="{LW_NOTIFY_URL}">
		<input type="hidden" name="return" value="{LW_RETURN_URL}">
		<input type="hidden" name="cancel_return" value="{LW_CANCEL_RETURN_URL}">
		
	  </span></td>
	</tr>
		
	</table>
	</td>
  </tr>
  </table>

