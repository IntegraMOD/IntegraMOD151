<table width="100%" align="center" valign="left">
	<tr>
		<td>
			<span class="genmed">
				<a href="{U_INDEX}">{L_INDEX}</a>
			</span>
		</td>
	</tr>
	<tr>
		<th width="100%" align="center" valign="middle">
			{HEADER}
		</th>
	</tr>
</table>
<!-- BEGIN step_one -->
<form name="step_one" action="login_security.php" method="POST">
<table width="100%" align="top" class="forumline">
	<tr>
		<th colspan="2" width="100%" align="center" valign="middle">
			{step_one.STEP_1}
		</th>
	</tr>
	<tr>
		<td align="left" valign="bottom" class="row1" width="70%">
			<span class="genmed">
				{step_one.NAME}
			</span>
		</td>
		<td align="left" valign="middle" class="row2">
			<input type="text" size"15" name="ps_username" class="post" value="">
		</td>
	</tr>
	<tr>
		<td align="left" valign="bottom" class="row1" width="70%">
			<span class="genmed">
				{step_one.MAIL}
			</span>
		</td>
		<td align="left" valign="middle" class="row2">
			<input type="text" size"15" name="ps_email" class="post" value="">
		</td>
	</tr>
	<tr>
		<td align="center" valign="bottom" class="row1" width="100%" colspan="2">
			<span class="genmed">
				{FORGOT}
			</span>
		</td>
	</tr>	
</table>
<table width="100%" align="center" valign="left">
	<tr>
		<td width="100%" align="center">
			<input type="hidden" name="phpBBSecurity" value="retreive">
			<input type="hidden" name="actions" value="1">
			<input type="submit" class="mainoption" value=" {BUTTON} " onchange="document.step_one.submit()">
		</td>
	</tr>
</table>
</form>	
<!-- END step_one -->

<!-- BEGIN step_two -->
<form name="step_two" action="login_security.php" method="POST">
<table width="100%" align="top" class="forumline">
	<tr>
		<th colspan="2" width="100%" align="center" valign="middle">
			{step_two.STEP_2}
		</th>
	</tr>
	<tr>
		<td align="left" valign="bottom" class="row1" width="70%">
			<span class="genmed">
				{step_two.QUESTION}
			</span>
		</td>
		<td align="left" valign="middle" class="row2">
			<input type="text" size"15" name="ps_answer" class="post" value="">
		</td>
	</tr>
	<tr>
		<td align="center" valign="bottom" class="row1" width="100%" colspan="2">
			<span class="genmed">
				{FORGOT}
			</span>
		</td>
	</tr>	
</table>
<table width="100%" align="center" valign="left">
	<tr>
		<td width="100%" align="center">
			<input type="hidden" name="phpBBSecurity" value="retreive">
			<input type="hidden" name="actions" value="2">
			<input type="hidden" name="ps_username" value="{step_two.HIDDEN}">
			<input type="submit" class="mainoption" value=" {BUTTON} " onchange="document.step_two.submit()">
		</td>
	</tr>
</table>
</form>	
<!-- END step_two -->

<!-- BEGIN caught -->
<table width="100%" align="top" class="forumline">
	<tr>
		<th width="7%" align="center" valign="middle">&nbsp;</th>	
		<th width="15%" align="center" valign="middle">
			{caught.L}
		</th>
		<th width="25%" align="center" valign="middle">
			{caught.CL}
		</th>
		<th width="15%" align="center" valign="middle">
			{caught.CR}
		</th>
		<th width="7%" align="center" valign="middle">
			{caught.R}
		</th>
		<th width="35%" align="center" valign="middle">&nbsp;</th>								
	</tr>
<!-- BEGIN rows -->
	<tr>
		<td align="left" valign="bottom" class="{caught.rows.ROWS}">
			<span class="genmed">
				{caught.rows.NUM}
			</span>
		</td>
		<td align="left" valign="bottom" class="{caught.rows.ROWS}">
			<span class="genmed">
				{caught.rows.L}
			</span>
		</td>
		<td align="left" valign="bottom" class="{caught.rows.ROWS}">
			<span class="genmed">
				{caught.rows.LC}
			</span>
		</td>
		<td align="left" valign="bottom" class="{caught.rows.ROWS}">
			<span class="genmed">
				{caught.rows.RC}
			</span>
		</td>
		<td align="left" valign="bottom" class="{caught.rows.ROWS}">
			<span class="genmed">
				{caught.rows.R}
			</span>
		</td>
		<td align="left" valign="bottom" class="{caught.rows.ROWS}">
			<span class="genmed">
				{caught.rows.LINK}
			</span>
		</td>								
<!-- END rows -->
	<tr>
		<td colspan="6" width="100%" align="right">
			<span class="genmed">
			{caught.P}          {caught.PN}
			</span>
		</td>
	</tr>
	<tr>
		<th colspan="6" width="100%">&nbsp;</th>
	</tr>
</table>
<!-- END caught -->