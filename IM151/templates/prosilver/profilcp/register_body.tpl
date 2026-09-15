<table cellpadding="0" cellspacing="10" border="0" width="100%">
<form name="post" action="{S_PROFILCP_ACTION}" method="post">
<tr>
	<td valign="top" align="center">
		<table cellpadding="4" cellspacing="1" border="0" class="forumline" width="100%">
		<tr> 
			<th colspan="2" valign="middle">{L_REGISTRATION}</th>
		</tr>
		<tr>
			<td class="row1" width="50%"><span class="gen">{L_USERNAME}:</span></td>
			<!-- BEGIN switch_edit_name -->
			<td class="row2" width="50%"><input type="text" class="post" style="width:200px" name="username" size="25" maxlength="255" value="{USERNAME}" /></td>
			<!-- END switch_edit_name -->
			<!-- BEGIN switch_no_edit_name -->
			<td class="row2" width="50%"><span class="gen">{USERNAME}</span></td>
			<!-- END switch_no_edit_name -->
		</tr>
		<tr> 
			<td class="cat" colspan="2"><span class="cattitle">{L_EMAIL_TITLE}</span></td>
		</tr>
		<tr>
			<td class="row1" width="50%"><span class="gen">{L_EMAIL}:</span></td>
			<td class="row2" width="50%"><input type="text" class="post" style="width:200px" name="user_email" size="25" maxlength="255" value="{EMAIL}" /></td>
		</tr>
		<tr>
			<td class="row1" width="50%"><span class="gen">{L_EMAIL_CONFIRM}:</span></td>
			<td class="row2" width="50%"><input type="text" class="post" style="width:200px" name="user_email_confirm" size="25" maxlength="255" value="{EMAIL}" /></td>
		</tr>
		<!-- BEGIN switch_anti_robotic -->
		<tr>
			<td class="row1" width="50%">
				<span class="gen">{L_IMAGE}:</span>
				<span class="gensmall"><br />{L_IMAGE_EXPLAIN}</span>
			</td>
			<td class="row2">
				<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<!-- BEGIN robotic_pic -->
					<td><img src="{switch_anti_robotic.robotic_pic.PIC}"></td>
					<!-- END robotic_pic -->
				</tr>
				</table>
				<span class="gen"><input type="text" class="post" style="width:200px" name="robot_confirm" size="25" maxlength="255" />
			</td>
		</tr>
		<!-- END switch_anti_robotic -->
	<!-- BEGIN phpBB Security -->
	<tr> 
	  <td class="catSides" colspan="2" height="28">&nbsp;</td>
	</tr>
	<tr> 
		<th class="thSides" colspan="2" height="12" valign="middle">{PS_TITLE}</th>
	</tr>
	<tr>
		<td align="left" class="row2" colspan="2">
			<span class="genmed">
				{PS_EXP}
			</span>
		</td>
	</tr>
	<tr>
		<td align="left" valign="bottom" class="row1">
			<span class="genmed">
				{PS_QUESTION}
			</span>
			<br>
			<span class="gensmall">
				{PS_QUESTION_EXP}
			</span>			
		</td>
		<td align="left" valign="middle" class="row2">
			<input type="text" name="PS_question" value="{PS_Q}" class="post" size="50">
		</td>		
	</tr>
	<tr>
		<td align="left" valign="bottom" class="row1">
			<span class="genmed">
				{PS_ANSWER}
			</span>
			<br>
			<span class="gensmall">
				{PS_ANSWER_EXP}
			</span>			
		</td>
		<td align="left" valign="middle" class="row2">
			<input type="text" name="PS_answer" value="{PS_A}" class="post" size="50">
			<span class="gensmall">
				{PS_A_EXP}
			</span>
		</td>		
	</tr>	
	<!-- End phpBB Security -->
		<tr> 
			<td class="cat" colspan="2"><span class="cattitle">{L_PASSWORD_TITLE}</span></td>
		</tr>
		<!-- BEGIN switch_get_cur_password -->
		<tr> 
			<td class="row1" width="50%">
				<span class="gen">{L_CURRENT_PASSWORD}:</span>
				<span class="gensmall"><br />{L_CONFIRM_PASSWORD_EXPLAIN}</span>
			</td>
			<td class="row2"> 
				<input type="password" class="post" style="width: 200px" name="cur_password" size="25" maxlength="100" value="{CUR_PASSWORD}" />
			</td>
		</tr>
		<!-- END switch_get_cur_password -->
		<tr> 
			<td class="row1">
				<span class="gen">{L_NEW_PASSWORD}:</span>
				<span class="gensmall"><br />{L_PASSWORD_IF_CHANGED}</span>
			</td>
			<td class="row2"> 
				<input type="password" class="post" style="width: 200px" name="new_password" size="25" maxlength="100" value="{NEW_PASSWORD}" />
			</td>
		</tr>
		<tr> 
			<td class="row1">
				<span class="gen">{L_CONFIRM_PASSWORD}:</span>
				<span class="gensmall"><br />{L_PASSWORD_CONFIRM_IF_CHANGED}</span>
			</td>
			<td class="row2"> 
				<input type="password" class="post" style="width: 200px" name="password_confirm" size="25" maxlength="100" value="{PASSWORD_CONFIRM}" />
			</td>
		</tr>
		<!-- BEGIN switch_forum_rules -->
		</table>
	</td>
</tr>
<tr>
	<td valign="top" align="center">
		<table cellpadding="4" cellspacing="1" border="0" class="forumline" width="100%">
		<tr>
			<th colspan="2" valign="middle">{L_FORUM_RULES} ({RULES_DATE})</th> 
		</tr> 
		<tr> 
			<td class="row1"> 
				<div class="genmed" align="justify"><br />{RULES_DATA}<br /><br /></div> 
				<!-- BEGIN confirm_rules --> 
				<hr />
				<div align="center" class="postbody">{L_AGREE_RULES}<input type="checkbox" name="agree_rules" value="1"><br /></div>
				<!-- END confirm_rules -->
			</td>
		</tr>
		<!-- END switch_forum_rules -->
		<tr>
			<td class="cat" colspan="2" align="center">
				<input type="submit" name="submit" class="mainoption" value="{L_SUBMIT}">
				<input type="submit" name="reset" class="liteoption" value="{L_RESET}">
				{S_HIDDEN_FIELDS}
			</td>
		</tr>
		</table>
	</td>
</tr>
</form>
</table>