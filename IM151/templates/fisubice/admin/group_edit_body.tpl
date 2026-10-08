<div class="maintitle">{L_GROUP_TITLE}</div>
<br />
<form action="{S_GROUP_ACTION}" method="post" name="post">
<table border="0" cellpadding="3" cellspacing="1" class="forumline" align="center">
<tr> 
<th colspan="2">{L_GROUP_EDIT_DELETE}</th>
</tr>
<tr> 
<td class="row1" colspan="2"><span class="gensmall">{L_ITEMS_REQUIRED}</span></td>
</tr>
<tr> 
<td class="row1" width="38%">{L_GROUP_NAME}:</td>
<td class="row2" width="62%"> 
<input type="text" name="group_name" size="35" maxlength="40" value="{GROUP_NAME}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_GROUP_DESCRIPTION}:</td>
<td class="row2"> 
<textarea name="group_description" rows="5" cols="30" style="width: 350px" class="post">{GROUP_DESCRIPTION}</textarea>
</td>
</tr>
<tr> 
<td class="row1">{L_GROUP_MODERATOR}:</td>
<td class="row2"> 
<input type="text" class="post" name="username" maxlength="50" size="20" value="{GROUP_MODERATOR}" />
&nbsp; 
<input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="button" onclick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" />
</td>
</tr>
<tr> 
<td class="row1">{L_GROUP_STATUS}:</td>
<td class="row2"> 
<input type="radio" name="group_type" value="{S_GROUP_OPEN_TYPE}" {S_GROUP_OPEN_CHECKED} />
{L_GROUP_OPEN} &nbsp;&nbsp; 
<input type="radio" name="group_type" value="{S_GROUP_CLOSED_TYPE}" {S_GROUP_CLOSED_CHECKED} />
{L_GROUP_CLOSED} &nbsp;&nbsp; 
<input type="radio" name="group_type" value="{S_GROUP_HIDDEN_TYPE}" {S_GROUP_HIDDEN_CHECKED} />
{L_GROUP_HIDDEN}&nbsp;&nbsp;<input type="radio" name="group_type" value="{S_GROUP_AUTO_TYPE}" {S_GROUP_AUTO_CHECKED} />{L_GROUP_AUTO}&nbsp;<input type="radio" name="group_type" value="{S_GROUP_PAYMENT_TYPE}" {S_GROUP_PAYMENT_CHECKED} />	{L_GROUP_PAYMENT} &nbsp;</td>
</tr>
<tr> 
  <td class="row1" width="38%"><span class="gen">{L_GROUP_COUNT}:<br/>{L_GROUP_COUNT_MAX}:</span><br/>
  <span class="gensmall">{L_GROUP_COUNT_EXPLAIN}</span></td>
  <td class="row2" width="62%"><input type="text" class="post" name="group_count" maxlength="12" size="12" value="{GROUP_COUNT}" /><br/><input type="text" class="post" name="group_count_max" maxlength="12" size="12" value="{GROUP_COUNT_MAX}" />
	<br/>&nbsp;&nbsp; <span class="gen"></span><input type="checkbox" name="group_count_enable" {GROUP_COUNT_ENABLE_CHECKED} >&nbsp;{L_GROUP_COUNT_ENABLE}
	<br/>&nbsp;&nbsp; <input type="checkbox" name="group_count_update" value="0"/>&nbsp;{L_GROUP_COUNT_UPDATE}
	<br/>&nbsp;&nbsp; <input type="checkbox" name="group_count_delete" value="0"/>&nbsp;{L_GROUP_COUNT_DELETE}</span>
  </td>
</tr>
	<tr> 
	  <td class="row1" width="38%"><span class="gen">{L_GROUP_PAYMENTS_LW}:</span></td>
	  <td class="row2" width="62%"><input class="post" type="text" class="post" name="group_amount" maxlength="50" size="20" value="{GROUP_AMOUNT_LW}" /> (This amount will be billed now, or as soon as any trial periods are over) 
	  	<br> Continue to bill the subscriber for this amount on a recurring basis? {LW_SUB_RECUR}
	  	<br> Length of each billing cycle {LW_BILLING_CIRCLE_PERIOD} {LW_BILLING_PERIOD_BASIS}
					
		<br> Would you like to stop the recurring payments after a certain number? {LW_STOP_RECURRING} 
		<br> If yes, how many? {LW_STOP_RECURRING_NUM}
		<br> Would you like to reattempt if payment fails for the subscription? {LW_SUBCRIBE_REATTEMPT}
	  </td>
	</tr>
	<tr> 
	  <td class="row1" width="38%"><span class="gen">Trial Period #1:
(Skip this section if you do not want to offer trial periods with your subscriptions)</span></td>
	  <td class="row2" width="62%">Bill the subscriber now for <input class="post" type="text" class="post" name="group_first_trial_fee" maxlength="50" size="20" value="{GROUP_TRIAL_PERIOD_ONE_FEE_LW}" /> (Enter 0 to create a free trial period)
	  	<br> This trial period should last {LW_FIRST_TRIAL_PERIOD} {LW_FIRST_TRIAL_PERIOD_BASIS}
	  	
	  </td>
	</tr>
	<tr> 
	  <td class="row1" width="38%"><span class="gen">Trial Period #2:
(Skip this section if you are only offering one trial period.)</span></td>
	  <td class="row2" width="62%">Bill the subscriber now for <input class="post" type="text" class="post" name="group_second_trial_fee" maxlength="50" size="20" value="{GROUP_TRIAL_PERIOD_TWO_FEE_LW}" /> 
	  	<br> This trial period should last {LW_SECOND_TRIAL_PERIOD} {LW_SECOND_TRIAL_PERIOD_BASIS}
	  	
	  </td>
	</tr>
<!-- BEGIN group_edit -->
<tr> 
<td class="row1">{L_DELETE_MODERATOR}<br />
<span class="gensmall">{L_DELETE_MODERATOR_EXPLAIN}</span></td>
<td class="row2"> 
<input type="checkbox" name="delete_old_moderator" value="1" />
{L_YES}</td>
</tr>
<tr> 
<td class="row1">{L_GROUP_DELETE}:</td>
<td class="row2"> 
<input type="checkbox" name="group_delete" value="1" />
{L_GROUP_DELETE_CHECK}</td>
</tr>
<tr> 
	  <td class="row1"><span class="gen">{L_UPLOAD_QUOTA}</span></td>
	  <td class="row2">{S_SELECT_UPLOAD_QUOTA}</td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_PM_QUOTA}</span></td>
	  <td class="row2">{S_SELECT_PM_QUOTA}</td>
	</tr>
<!-- END group_edit -->
<tr> 
<td class="cat" colspan="2" align="center"> 
<input type="submit" name="group_update" value="{L_SUBMIT}" class="mainoption" />
&nbsp;&nbsp; 
<input type="reset" value="{L_RESET}" name="reset" class="button" />
</td>
</tr>
</table>
{S_HIDDEN_FIELDS}
</form>
<br />
<br />