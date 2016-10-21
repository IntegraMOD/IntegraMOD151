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
	  <td class="row1" width="50%" align="left">
	  	<span class="gen">{L_LW_AMOUNT_TO_PAY}</span>
	  	<span class="gensmall"><br />{L_LW_AMOUNT_TO_PAY_EXPLAIN}</span>
	  </td>
	  <td class="row2" width="50%" align="left"><span class="gen"><input type="text" class="post" style="width:200px" name="amount" size="25" maxlength="255" /></span></td>
	</tr>
	<tr> 
	  <td class="row1" width="50%" align="left">
	  	<span class="gen">{L_LW_CURRENCY_TO_PAY}</span>
	  	<span class="gensmall"><br />{L_LW_CURRENCY_TO_PAY_EXPLAIN}</span>
	  </td>
	  <td class="row2" width="50%" align="left"><span class="gen">{LW_CURRENCY_OPTIONS}</span></td>
	</tr>
	<tr> 
	  <td class="row1" width="50%" align="left">
	  	<span class="gen">{L_LW_DONATE_WAY}</span>
	  </td>
	  <td class="row2" width="50%" align="left"><span class="gen"><input type="checkbox" name="lw_anonymous" value="1">{LW_WANT_ANONYMOUS}</span></td>
	</tr>
	<tr> 
	  <td class="row1" colspan=2 width="100%" align="center"><span class="gen">
	  	<input type="submit" name="submit" class="mainoption" value="GO">		
	  </span></td>
	</tr>
		
	</table>
	</td>
  </tr>
  </table>

