<script src="templates/post_message.js"></script>
{JAVASCRIPT_BBCODE_BOX}
<script src='spelling/spellmessage.js'></script>
<script>
  var is_event_allowed = 0;
  var is_delayed_allowed = 0;

  function checkForm2() {
	formErrors = false;  
        if (document.post.message.value.length < 2) {
		formErrors = "You must enter a message when posting";
	}
	if (is_event_allowed && is_delayed_allowed){
		if (document.post.calendar_event.value && document.post.forcetime.value)
		{
			alert("A calendar event can't be posted as a delayed topic");
			return false;
		}
	}
	if (is_event_allowed) {
		if (!document.post.calendar_event.value && document.post.topic_calendar_repeats_value.value != 0)
		{
			alert("A repeating event must have a calendar event specified");
			return false;
		}
	}
if (formErrors) { 
        alert(formErrors); 
        return false; 
    } else if (is_submit) { 
        alert('Your post is already submitted'); 
      return false; 
    } else { 
        is_submit = true; 
    } 
    return true;
}
</script>
<div class="maintitle">{L_BLOCKS_TITLE}</div>
<br />
<div class="genmed">{L_BLOCKS_TEXT}</div>
<br />
<form method="post" action="{S_BLOCKS_ACTION}" name="post">
<table cellspacing="1" cellpadding="3" border="0" align="center" class="forumline">
<tr> 
<th colspan="2">{L_EDIT_BLOCK}</th>
</tr>

<tr> 
<td align="right" class="row1">{L_B_TITLE}:</td>
<td class="row2"> 
<input type="text" maxlength="60" size="30" name="title" value="{TITLE}" class="post" />
</td>
</tr>

<tr> 
<td align="right" class="row1">{L_B_TITLE_IMAGE}:</td>
<td class="row2"> 
<input type="text" maxlength="100" size="30" name="title_image" value="{TITLE_IMAGE}" class="post" />
</td>
</tr>

<tr> 
<td align="right" class="row1">{L_B_POSITION}:</td>
<td class="row2"> 
<select name="bposition" class="post">{POSITION}</select>
</td>
</tr>

<tr> 
<td align="right" class="row1">{L_B_ACTIVE}:</td>
<td class="row2"> 
<input type="radio" name="active" value="1" {ACTIVE} /> {L_YES}&nbsp;&nbsp;
<input type="radio" name="active" value="0" {NOT_ACTIVE} /> {L_NO}</td>
</tr>

<tr> 
<td align="right" class="row1">
		<table width="100%" border="0" cellspacing="0" cellpadding="1">
		  <tr> 
			<td align="right">{L_B_CONTENT}:<br /><br /><br /></td>
		  </tr>
		  <tr> 
			<td valign="middle" align="center"> <br />
			  <table width="100" border="0" cellspacing="0" cellpadding="5">
				<tr align="center"> 
				  <td colspan="{S_SMILIES_COLSPAN}" class="gensmall"><b>{L_EMOTICONS}</b></td>
				</tr>
				<!-- BEGIN smilies_row -->
				<tr align="center" valign="middle"> 
				  <!-- BEGIN smilies_col -->
				  <td><a href="javascript:emoticon('{smilies_row.smilies_col.SMILEY_CODE}')"><img src="{smilies_row.smilies_col.SMILEY_IMG}" border="0" alt="{smilies_row.smilies_col.SMILEY_DESC}" title="{smilies_row.smilies_col.SMILEY_DESC}" /></a></td>
				  <!-- END smilies_col -->
				</tr>
				<!-- END smilies_row -->
				<!-- BEGIN switch_smilies_extra -->
				<tr align="center"> 
				  <td colspan="{S_SMILIES_COLSPAN}"><span  class="nav"><a href="{U_MORE_SMILIES}" onclick="window.open('{U_MORE_SMILIES}', '_phpbbsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=250');return false;" target="_phpbbsmilies" class="nav">{L_MORE_SMILIES}</a></span></td>
				</tr>
				<!-- END switch_smilies_extra -->
			  </table>
			</td>
		  </tr>
		</table>
</td>
<td class="row2">
			<table cellspacing="0" cellpadding="0" border="0" width="450" style="border-collapse: collapse;">
				<tr>
					<td width="7"><img src="../mods/bbcode_box/images/bar-left.gif" width="7" height="25" border="0" alt="" /></td>
					<td background="../mods/bbcode_box/images/bar-bg.gif">
						<table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse: collapse;">
							<tr>
								<td width="23"><img border="0" height="22" width="23" src="../mods/bbcode_box/images/ltr.gif" class="postimage" name="dirltr" onClick="BBCdir('ltr')" onMouseOver="helpline('ltr')" alt="Left to Right" /></td>
								<td width="23"><img border="0" height="22" width="23" src="../mods/bbcode_box/images/rtl.gif" class="postimage" name="dirrtl" onClick="BBCdir('rtl')" onMouseOver="helpline('rtl')" alt="Right to Left" /></td>
								<td width="6"><img border="0" height="25" width="6" src="../mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td width="23"><img border="0" height="22" width="23" src="../mods/bbcode_box/images/plain.gif" class="postimage" name="plain" onClick="BBCplain()" onMouseOver="helpline('plain')" alt="Remove BBcode" />
								<td width="6"><img border="0" height="25" width="6" src="../mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td width="23"><input border="0" height="22" width="23" src="../mods/bbcode_box/images/spell.gif" class="postimage" value="SpellCheck" name="button" type="image" onclick="openspell();return false;" onMouseOver="helpline('spell')" /></td>
								<td width="6"><img border="0" height="25" width="6" src="../mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td align="right"><a href="http://#/" class="gensmall" title="BBCode Box MOD - by Disturbed One - www.HVMDesign.com" target="blank">Advanced BBCode Box v6.0.0</a>&nbsp;</td>
							</tr>
						</table>
					</td>
					<td width="13"><img src="../mods/bbcode_box/images/bar-right.gif" width="13" height="25" border="0" alt="" /></td>
				</tr>
				<tr>
					<td width="7"><img src="../mods/bbcode_box/images/bar-left.gif" width="7" height="25" border="0" alt="" /></td>
					<td background="../mods/bbcode_box/images/bar-bg.gif">
						<table cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
							<tr>
								<td><img src="../mods/bbcode_box/images/font.gif" width="23" height="22" border="0" alt="Font" /></td>
								<td style="white-space: nowrap;">
									<select style="height: 20px;" name="ft" onChange="BBCft()" onMouseOver="helpline('ft')">
										<option style="font-weight : bold;" selected="selected">Font type</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Arial;" value="Arial" class="genmed">Arial</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Arial Black;" value="Arial Black" class="genmed">Arial Black</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Century Gothic;" value="Century Gothic" class="genmed">Century Gothic</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Comic Sans MS;" value="Comic Sans MS" class="genmed">Comic Sans MS</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Courier New;" value="Courier New" class="genmed">Courier New</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Georgia;" value="Georgia" class="genmed">Georgia</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Lucida Console;"value="Lucida Console">Lucida Console</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Microsoft Sans Serif;" value="Microsoft Sans Serif" class="genmed">Microsoft Sans Serif</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Symbol;" value="Symbol" class="genmed">Symbol</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Tahoma;" value="Tahoma" class="genmed">Tahoma</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Trebuchet;" value="Trebuchet" class="genmed">Trebuchet</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Times New Roman;" value="Times New Roman" class="genmed">Times New Roman</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Verdana;" value="Verdana" class="genmed">Verdana</option>
									</select>
									<select style="height: 20px;" name="fs" onChange="BBCfs()" onMouseOver="helpline('fs')">
										<option style="font-weight : bold;" selected="selected">Font Size</option>
										<option style="color:black; font-size: 8;" value="8" class="genmed">{L_FONT_TINY}</option>
										<option style="color:black; font-size: 10;" value="10" class="genmed">{L_FONT_SMALL}</option>
										<option style="color:black; font-size: 12;" value="12" class="genmed">{L_FONT_NORMAL}</option>
										<option style="color:black; font-size: 18;" value="18" class="genmed">{L_FONT_LARGE}</option>
										<option style="color:black; font-size: 24;" value="24" class="genmed">{L_FONT_HUGE}</option>
									</select>
									<select style="height: 20px;" name="fc" onChange="BBCfc()" onMouseOver="helpline('fc')">
										<option style="font-weight: bold;" selected="selected">Font Color</option>
										<option style="color:red; background-color: {T_TD_COLOR1}" value="red" class="genmed">{L_COLOR_RED}</option>
										<option style="color:orange; background-color: {T_TD_COLOR1}" value="orange" class="genmed">{L_COLOR_ORANGE}</option>
										<option style="color:brown; background-color: {T_TD_COLOR1}" value="brown" class="genmed">{L_COLOR_BROWN}</option>
										<option style="color:yellow; background-color: {T_TD_COLOR1}" value="yellow" class="genmed">{L_COLOR_YELLOW}</option>
										<option style="color:green; background-color: {T_TD_COLOR1}" value="green" class="genmed">{L_COLOR_GREEN}</option>
										<option style="color:olive; background-color: {T_TD_COLOR1}" value="olive" class="genmed">{L_COLOR_OLIVE}</option>
										<option style="color:cyan; background-color: {T_TD_COLOR1}" value="cyan" class="genmed">{L_COLOR_CYAN}</option>
										<option style="color:blue; background-color: {T_TD_COLOR1}" value="blue" class="genmed">{L_COLOR_BLUE}</option>
										<option style="color:darkblue; background-color: {T_TD_COLOR1}" value="darkblue" class="genmed">{L_COLOR_DARK_BLUE}</option>
										<option style="color:indigo; background-color: {T_TD_COLOR1}" value="indigo" class="genmed">{L_COLOR_INDIGO}</option>
										<option style="color:violet; background-color: {T_TD_COLOR1}" value="violet" class="genmed">{L_COLOR_VIOLET}</option>
										<option style="color:white; background-color: {T_TD_COLOR1}" value="white" class="genmed">{L_COLOR_WHITE}</option>
										<option style="color:black; background-color: {T_TD_COLOR1}" value="black" class="genmed">{L_COLOR_BLACK}</option>
									</select>
								</td>
								<td><img border="0" height="25" width="6" src="../mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/fade.gif" class="postimage" name="fade" onClick="BBCfade()" onMouseOver="helpline('fade')" alt="Fade" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/grad.gif" class="postimage" name="grad" onClick="BBCgrad()" onMouseOver="helpline('grad')" alt="Gradient" /></td>
								<td><img border="0" height="25" width="6" src="../mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/list.gif" class="postimage" name="listdf" onClick="BBClist()" onMouseOver="helpline('list')" alt="List" /></td>
							</tr>
						</table>
					</td>
					<td width="13"><img src="../mods/bbcode_box/images/bar-right.gif" width="13" height="25" border="0" alt="" /></td>
				</tr>
				<tr>
					<td width="7"><img src="../mods/bbcode_box/images/bar-left.gif" width="7" height="25" border="0" alt="" /></td>
					<td background="../mods/bbcode_box/images/bar-bg.gif">
						<table cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
							<tr>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/left.gif" class="postimage" name="left" onClick="BBCleft()" onMouseOver="helpline('left')" alt="Left" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/center.gif" class="postimage" name="center" onClick="BBCcenter()" onMouseOver="helpline('center')" alt="Center" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/right.gif" class="postimage" name="right" onClick="BBCright()" onMouseOver="helpline('right')" alt="Right" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/justify.gif" class="postimage" name="justify" onClick="BBCjustify()" onMouseOver="helpline('justify')" alt="Justify" /></td>
								<td><img border="0" height="25" width="6" src="../mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/bold.gif" class="postimage" name="bold" onClick="BBCbold()" onMouseOver="helpline('b')" alt="Bold" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/italic.gif" class="postimage" name="italic" onClick="BBCitalic()" onMouseOver="helpline('i')" alt="Italic" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/under.gif" class="postimage" name="under" onClick="BBCunder()" onMouseOver="helpline('u')" alt="Underline" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/strike.gif" class="postimage" name="strik" onClick="BBCstrike()" onMouseOver="helpline('strike')" alt="Strike-through" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/sup.gif" class="postimage" name="supscript" onClick="BBCsup()" onMouseOver="helpline('sup')" alt="Superscript" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/sub.gif" class="postimage" name="subs" onClick="BBCsub()" onMouseOver="helpline('sub')" alt="Subscript" /></td>
								<td><img border="0" height="25" width="6" src="../mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/marqd.gif" class="postimage" name="marqd" onClick="BBCmarqd()" onMouseOver="helpline('marqd')" alt="Marquee Down" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/marqu.gif" class="postimage" name="marqu" onClick="BBCmarqu()" onMouseOver="helpline('marqu')" alt="Marquee Up" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/marql.gif" class="postimage" name="marql" onClick="BBCmarql()" onMouseOver="helpline('marql')" alt="Marquee Left" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/marqr.gif" class="postimage" name="marqr" onClick="BBCmarqr()" onMouseOver="helpline('marqr')" alt="Marquee Right" /></td>
								<td><img border="0" height="25" width="6" src="../mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/code.gif" class="postimage" name="code" onClick="BBCcode()" onMouseOver="helpline('code')" alt="Code" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/php.gif" class="postimage" name="php" onClick="BBCphp()" onMouseOver="helpline('php')" alt="PHP" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/quote.gif" class="postimage" name="quote" onClick="BBCquote()" onMouseOver="helpline('quote')" alt="Quote" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/spoil.gif" class="postimage" name="spoil" onClick="BBCspoil()" onMouseOver="helpline('spoil')" alt="Spoilers" /></td>
							</tr>
						</table>
					</td>
					<td width="13"><img src="../mods/bbcode_box/images/bar-right.gif" width="13" height="25" border="0" alt="" /></td>
				</tr>
				<tr>
					<td width="7"><img src="../mods/bbcode_box/images/bar-left.gif" width="7" height="25" border="0" alt="" /></td>
					<td background="../mods/bbcode_box/images/bar-bg.gif">
						<table cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
							<tr>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/anchor.gif" class="postimage" name="anchor" onClick="BBCanchor()" onMouseOver="helpline('anchor')" alt="Anchor" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/url.gif" class="postimage" name="url" onClick="BBCurl()" onMouseOver="helpline('url')" alt="URL" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/email.gif" class="postimage" name="email" onClick="BBCmail()" onMouseOver="helpline('mail')" alt="Email" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/gotopost.gif" class="postimage" name="gotopost" onClick="BBCgotopost()" onMouseOver="helpline('gotopost')" alt="Gotopost" /></td>
								<td><img border="0" height="25" width="6" src="../mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/search.gif" class="postimage" name="search" onClick="BBCsearch()" onMouseOver="helpline('search')" alt="Search" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/google.gif" class="postimage" name="you" onClick="BBCgoogle()" onMouseOver="helpline('google')" alt="Google" /></td>
								<td><img border="0" height="25" width="6" src="../mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/img.gif" class="postimage" name="img" onClick="BBCimg()" onMouseOver="helpline('img')" alt="Image" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/flash.gif" class="postimage" name="flash" onClick="BBCflash()" onMouseOver="helpline('flash')" alt="Flash" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/sound.gif" class="postimage" name="stream" onClick="BBCstream()" onMouseOver="helpline('stream')" alt="Stream" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/ram.gif" class="postimage" name="ram" onClick="BBCram()" onMouseOver="helpline('ram')" alt="Real Media" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/video.gif" class="postimage" name="video" onClick="BBCvideo()" onMouseOver="helpline('video')" alt="Video" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/web.gif" class="postimage" name="web" onClick="BBCweb()" onMouseOver="helpline('web')" alt="Web Page" /></td>
								<td><img border="0" height="25" width="6" src="../mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/tab.gif" class="postimage" name="tab" onClick="BBCtab()" onMouseOver="helpline('tab')" alt="Tab" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/nbsp.gif" class="postimage" name="nbsp" onClick="BBCnbsp()" onMouseOver="helpline('nbsp')" alt="NBSP" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/hr.gif" class="postimage" name="hr" onClick="BBChr()" onMouseOver="helpline('hr')" alt="H-Line" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/you.gif" class="postimage" name="you" onClick="BBCyou()" onMouseOver="helpline('you')" alt="You" /></td>
								<td><img border="0" height="25" width="6" src="../mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/table.gif" class="postimage" name="table" onClick="BBCtable()" onMouseOver="helpline('table')" alt="Table" /></td>
						        <td><img border="0" height="22" width="23" src="../mods/bbcode_box/images/youtube.gif" class="postimage" name="youtube" onClick="BBCyoutube()" onMouseOver="helpline('youtube')" alt="YouTube" /></td>
							</tr>
						</table>
					</td>
					<td width="13"><img src="../mods/bbcode_box/images/bar-right.gif" width="13" height="25" border="0" alt="" /></td>
				</tr>
				<tr>
					<td width="7"><img src="../mods/bbcode_box/images/bar-left.gif" width="7" height="25" border="0" alt="" /></td>
					<td background="../mods/bbcode_box/images/bar-bg.gif">
						<table cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
							<tr>
								<td><img src="../mods/bbcode_box/images/help.gif" width="23" height="22" border="0" alt="Help" /></td>
								<td><input type="text" name="helpbox" size="45" maxlength="100" style="width:395px; font-size:10px" value="Tip: Styles can be applied quickly to selected text." /></td>
							</tr>
						</table>
					</td>
					<td width="13"><img src="../mods/bbcode_box/images/bar-right.gif" width="13" height="25" border="0" alt="" /></td>
				</tr>
				<tr>
					<td colspan="3"><textarea name="message" rows="15" cols="35" style="width:100%" tabindex="3" class="post" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this); typeQuietly(this, event);">{CONTENT}</textarea></td>
				</tr>
			    <!-- BEGIN switch_confirm -->
				<tr>
					<td class="row3" colspan="2" align="center"><br /><br />{CONFIRM_IMAGE}<br /><br /></td>
				</tr>
				<tr> 
				  <td class="row2" colspan="2" align="center"><span class="gen"><b>{L_CT_CONFIRM}</b></span><br /><span class="gensmall">{L_CT_CONFIRM_E}</span><br /><br /><input type="text" class="post" style="width: 200px" name="confirm_code" size="6" value="" />{S_HIDDEN_FIELDS}</td>
				</tr>
			    <!-- END switch_confirm -->
				<tr>
					<td colspan="3" align="center" height="20">{S_HIDDEN_FORM_FIELDS}
						<input type="submit" tabindex="5" name="preview" class="mainoption" value="{L_PREVIEW}" />
						&nbsp;&nbsp;<input type="submit" accesskey="s" tabindex="6" name="post" class="mainoption" value="{L_SUBMIT}" />
					</td>
				</tr>				
			</table>
</td>
</tr>

<tr> 
<td align="right" class="row1">{L_B_TYPE}:</td>
<td class="row2"> 
<input type="radio" name="type" value="1" {BBCODE} /> {L_B_BBCODE}&nbsp;&nbsp;
<input type="radio" name="type" value="0" {HTML} /> {L_B_HTML}</td>
</tr>

<tr> 
<td align="right" class="row1">{L_B_CACHE}:</td>
<td class="row2"> 
<input type="radio" name="cache" value="1" {CACHE} /> {L_YES}&nbsp;&nbsp;
<input type="radio" name="cache" value="0" {NO_CACHE} /> {L_NO}</td>
</tr>

<tr> 
<td align="right" class="row1">{L_B_CACHETIME}:</td>
<td class="row2"> 
<input type="text" maxlength="10" size="10" name="cachetime" value="{CACHETIME}" class="post" />
</td>
</tr>

<tr> 
<td align="right" class="row1">{L_B_BLOCK_FILE}:</td>
<td class="row2"> 
<select name="blockfile" class="post">{BLOCKFILE}</select>
</td>
</tr>

<tr> 
<td align="right" class="row1">{L_B_VIEW_BY}:</td>
<td class="row2"> 
<select name="view" class="post">{VIEWBY}</select>
</td>
</tr>

<tr> 
<td align="right" class="row1">{L_B_BORDER}:</td>
<td class="row2"> 
<input type="radio" name="border" value="1" {BORDER} /> {L_YES}&nbsp;&nbsp;
<input type="radio" name="border" value="0" {NO_BORDER} /> {L_NO}</td>
</tr>

<tr> 
<td align="right" class="row1">{L_B_TITLEBAR}:</td>
<td class="row2"> 
<input type="radio" name="titlebar" value="1" {TITLEBAR} /> {L_YES}&nbsp;&nbsp;
<input type="radio" name="titlebar" value="0" {NO_TITLEBAR} /> {L_NO}</td>
</tr>

<tr> 
<td align="right" class="row1">{L_B_OPENCLOSE}:</td>
<td class="row2"> 
<input type="radio" name="openclose" value="1" {OPENCLOSE} /> {L_YES}&nbsp;&nbsp;
<input type="radio" name="openclose" value="0" {NO_OPENCLOSE} /> {L_NO}</td>
</tr>

<tr> 
<td align="right" class="row1">{L_B_LOCAL}:</td>
<td class="row2"> 
<input type="radio" name="local" value="1" {LOCAL} /> {L_YES}&nbsp;&nbsp;
<input type="radio" name="local" value="0" {NOT_LOCAL} /> {L_NO}</td>
</tr>

<tr> 
<td align="right" class="row1">{L_B_BACKGROUND}:</td>
<td class="row2"> 
<input type="radio" name="background" value="1" {BACKGROUND} /> {L_YES}&nbsp;&nbsp;
<input type="radio" name="background" value="0" {NO_BACKGROUND} /> {L_NO}</td>
</tr>

<tr> 
<td align="right" class="row1">{L_B_GROUP}:</td>
<td class="row2"> 
{GROUP}
</tr>

<tr> 
<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS} 
<input type="submit" name="save" value="{L_SUBMIT}" class="mainoption" />
</td>
</tr>
</table>
</form>
<br />
