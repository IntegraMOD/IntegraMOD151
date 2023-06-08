<script language="JavaScript" type="text/javascript">
<!--
function checkForm()
{
	formErrors = false;

	if (document.post.message.value.length < 2) {
		formErrors = "{L_EMPTY_MESSAGE}";
	}

	if (formErrors) {
		alert(formErrors);
		return false;
	} else {
		bbstyle(-1);
		//formObj.preview.disabled = true;
		//formObj.submit.disabled = true;
		return true;
	}
}

// Update Emoticon Images
function update_smiley(newimage)
{
	document.smiley_image.src = "{S_SMILEY_BASEDIR}/" + newimage;
}
//-->
</script>
<script language="javascript" src="{U_IM_PATH}posting.js"></script>

<form action="{S_POST_ACTION}" method="post" name="post" onsubmit="return checkForm(this)">

{ERROR_BOX}

<table border="0" cellpadding="3" cellspacing="1" width="98%" class="forumline">
	<tr>
		<th class="thHead" colspan="2" height="25"><b>{L_POST_A}</b></th>
	</tr>
	<tr>
		<td class="row1"><span class="genmed"><b>{L_USERNAME}</b></span></td>
		<td class="row2">
			<span class="genmed"><input type="text" class="post" tabindex="1" name="username" size="15" maxlength="25" value="{USERNAME}" />&nbsp;
			<!-- BEGIN switch_find -->
			<input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="liteoption" onClick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" />&nbsp;<input type="submit" name="usersubmit" value="{L_BUDDIES}" class="liteoption" onClick="window.open('{U_CONTACT}', '_phpbbcontact', 'HEIGHT=225,resizable=yes,WIDTH=275');return false;" />
			<!-- END switch_find -->
			</span>
		</td>
	</tr>
	<tr>
		<td class="row1" width="22%"><span class="genmed"><b>{L_SUBJECT}</b></span></td>
		<td class="row2" width="78%">
			<input type="text" name="subject" size="45" maxlength="60" tabindex="2" class="post" value="{SUBJECT}" />
		</td>
	</tr>
	<tr>
		<td class="row2" valign="top" colspan="2">
			<table border="0" cellspacing="0" cellpadding="2" width="100%">
				<tr>
					<td align="center">
						<!-- BEGIN switch_font_controls -->
						<select name="addbbcode20" onChange="bbfontstyle('[size=' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + ']', '[/size]');this.selectedIndex=5;">
							<option value="7" class="genmed">{L_FONT_TINY}</option>
							<option value="9" class="genmed">{L_FONT_SMALL}</option>
							<option value="12" class="genmed">{L_FONT_NORMAL}</option>
							<option value="18" class="genmed">{L_FONT_LARGE}</option>
							<option  value="24" class="genmed">{L_FONT_HUGE}</option>
							<option value="12" selected class="genmed">{L_SIZE}</option>
						</select>
						<!-- END switch_font_controls -->
					</td>
					<td align="center">
						<!-- BEGIN switch_bbcode_controls -->
							<input type="button" class="button" accesskey="b" name="addbbcode0" value=" B " style="font-weight:bold; width: 30px" onClick="bbstyle(0)" /> 
							<input type="button" class="button" accesskey="i" name="addbbcode2" value=" i " style="font-style:italic; width: 30px" onClick="bbstyle(2)" />
							<input type="button" class="button" accesskey="u" name="addbbcode4" value=" u " style="text-decoration: underline; width: 30px" onClick="bbstyle(4)" /> 
							<input type="button" class="button" accesskey="p" name="addbbcode14" value="Img" style="width: 40px"  onClick="bbstyle(14)" />
							<input type="button" class="button" accesskey="w" name="addbbcode16" value="URL" style="text-decoration: underline; width: 40px" onClick="bbstyle(16)" />
						<!-- END switch_bbcode_controls -->
					</td>
				</tr>
				<tr>
					<td align="center">
						<!-- BEGIN switch_font_controls -->
						<select name="addbbcode18" onChange="bbfontstyle('[color=' + this.form.addbbcode18.options[this.form.addbbcode18.selectedIndex].value + ']', '[/color]');this.selectedIndex=0;">
							<option style="color:black; background-color: {T_TD_COLOR1}" value="{T_FONTCOLOR1}" class="genmed">{L_COLOR}</option>
							<option style="color:darkred; background-color: {T_TD_COLOR1}" value="darkred" class="genmed">{L_COLOR_DARK_RED}</option>
							<option style="color:red; background-color: {T_TD_COLOR1}" value="red" class="genmed">{L_COLOR_RED}</option>
							<option style="color:orange; background-color: {T_TD_COLOR1}" value="orange" class="genmed">{L_COLOR_ORANGE}</option>
							<option style="color:brown; background-color: {T_TD_COLOR1}" value="brown" class="genmed">{L_COLOR_BROWN}</option>
							<option style="color:yellow; background-color: black" value="yellow" class="genmed">{L_COLOR_YELLOW}</option>
							<option style="color:green; background-color: {T_TD_COLOR1}" value="green" class="genmed">{L_COLOR_GREEN}</option>
							<option style="color:olive; background-color: {T_TD_COLOR1}" value="olive" class="genmed">{L_COLOR_OLIVE}</option>
							<option style="color:cyan; background-color: black" value="cyan" class="genmed">{L_COLOR_CYAN}</option>
							<option style="color:blue; background-color: {T_TD_COLOR1}" value="blue" class="genmed">{L_COLOR_BLUE}</option>
							<option style="color:darkblue; background-color: {T_TD_COLOR1}" value="darkblue" class="genmed">{L_COLOR_DARK_BLUE}</option>
							<option style="color:indigo; background-color: {T_TD_COLOR1}" value="indigo" class="genmed">{L_COLOR_INDIGO}</option>
							<option style="color:violet; background-color: black" value="violet" class="genmed">{L_COLOR_VIOLET}</option>
							<option style="color:white; background-color: black;" value="white" class="genmed">{L_COLOR_WHITE}</option>
							<option style="color:black; background-color: {T_TD_COLOR1}" value="black" class="genmed">{L_COLOR_BLACK}</option>
						</select>
						<!-- END switch_font_controls -->
					</td>
					<td align="center">
						<!-- BEGIN switch_smilies_dropdown -->
						<select name="smile_url" onchange="javascript:update_smiley(this.options[selectedIndex].value);">
							<option selected value="spacer.gif">{L_SELECT_SMILE}</option>
							<!-- BEGIN smilies_row -->
							<option value="{switch_smilies_dropdown.smilies_row.S_SMILE_URL}" id="{switch_smilies_dropdown.smilies_row.S_SMILE_CODE}">{switch_smilies_dropdown.smilies_row.S_SMILE_NAME}</option>
							<!-- END smilies_row -->
						</select>
						<a href="javascript:emoticon(document.post.smile_url.options[document.post.smile_url.selectedIndex].id);"><img name="smiley_image" src="../images/spacer.gif" border="0"></a>
						<!-- END switch_smilies_dropdown -->
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea name="message" rows="5" cols="60" wrap="virtual"  tabindex="3" class="post" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);">{MESSAGE}</textarea>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="row1" valign="top">
			<span class="genmed"><b>{L_OPTIONS}</b></span><br /><span class="gensmall">{HTML_STATUS}<br />{BBCODE_STATUS}
			<!-- BEGIN switch_smilies_status -->
			<br />{SMILIES_STATUS}
			<!-- END switch_smilies_status -->
			</span>
		</td>
		<td class="row2">
		<table cellspacing="0" cellpadding="1" border="0">
			<!-- BEGIN switch_html_checkbox -->
			<tr>
				<td>
					<input type="checkbox" name="disable_html" {S_HTML_CHECKED} />
				</td>
				<td><span class="gensmall">{L_DISABLE_HTML}</span></td>
			</tr>
			<!-- END switch_html_checkbox -->
			<!-- BEGIN switch_bbcode_checkbox -->
			<tr>
				<td>
					<input type="checkbox" name="disable_bbcode" {S_BBCODE_CHECKED} />
				</td>
				<td><span class="gensmall">{L_DISABLE_BBCODE}</span></td>
			</tr>
			<!-- END switch_bbcode_checkbox -->
			<!-- BEGIN switch_smilies_checkbox -->
			<tr>
				<td>
					<input type="checkbox" name="disable_smilies" {S_SMILIES_CHECKED} />
				</td>
				<td><span class="gensmall">{L_DISABLE_SMILIES}</span></td>
			</tr>
			<!-- END switch_smilies_checkbox -->
			<!-- BEGIN switch_signature_checkbox -->
			<tr>
				<td>
					<input type="checkbox" name="attach_sig" {S_SIGNATURE_CHECKED} />
				</td>
				<td><span class="gensmall">{L_ATTACH_SIGNATURE}</span></td>
			</tr>
			<!-- END switch_signature_checkbox -->
			<!-- BEGIN switch_save -->
			<tr>
				<td>
				<input type="checkbox" name="save_sent" />
				</td>
				<td><span class="gensmall">{L_SAVE_SENT}</span></td>
			</tr>
			<!-- END switch_save -->
		</table>
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center" height="28"> {S_HIDDEN_FORM_FIELDS}<input type="submit" accesskey="s" tabindex="6" name="post" class="mainoption" value="{L_SUBMIT}" /> <input type="reset" accesskey="r" tabindex="7" name="post" class="liteoption" value="{L_RESET}" /> <input type="button" tabindex="8" value="{L_CLOSE_WINDOW}" class="liteoption" onClick="window.close()" /></td>
	</tr>
</table>
</form>