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
<style type="text/css">
.postimage {
	cursor: pointer;
	cursor: hand;
}
</style>
<form action="{S_POST_ACTION}" method="post" name="post" onsubmit="return checkForm2(this)" {S_FORM_ENCTYPE}>
<table width="100%" cellspacing="2" cellpadding="2" border="0" id="posting-form">
<tr>
<td class="maintitle">{L_POST_A}</td>
</tr>
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a> 
<!-- BEGIN switch_not_privmsg -->
{NAV_CAT_DESC}
<!-- END switch_not_privmsg -->
{NAV_SEPARATOR} {L_POST_A}</td>
</tr>
</table>
{POST_PREVIEW_BOX}
{ERROR_BOX}
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
<tr>
<th colspan="2">{L_POST_A}</th>
</tr>
<!-- BEGIN switch_username_select -->
<tr>
<td align="right" class="row1"><span class="explaintitle">{L_USERNAME}:</span></td>
<td class="row2"><input type="text" class="post" tabindex="1" name="username" size="25" maxlength="25" value="{USERNAME}" /> 
</td>
</tr>
<!-- END switch_username_select -->
<!-- BEGIN switch_privmsg -->
<tr> 
<td align="right" class="row1"><span class="explaintitle">{L_USERNAME}:</span></td>
<td class="row2"> <input type="text"  class="post" name="username" maxlength="25" size="25" tabindex="1" value="{USERNAME}" /> 
&nbsp; <input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="button" onclick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" /> 
</td>
</tr>
<!-- END switch_privmsg -->
<tr>
<td width="22%" align="right" class="row1"><span class="explaintitle">{L_SUBJECT}:</span></td>
<td class="row2" width="78%"><input type="text" {S_LOCK_SUBJECT} name="subject" size="45" maxlength="60" style="width:450px" tabindex="2" class="post" value="{SUBJECT}" onkeydown="typeQuietly(this, event);" /> 
</td>
</tr>
<!-- BEGIN topic_description -->
<tr>
<td class="row1" width="22%" align="right"><span class="explaintitle"><b>{L_TOPIC_DESCRIPTION}:</b></span></td>
<td class="row2" width="78%"> <span class="gen">
<input type="text" name="topic_desc" size="45" maxlength="60" style="width:450px" tabindex="2" class="post" value="{TOPIC_DESCRIPTION}" onkeydown="typeQuietly(this, event);" />
</span> </td>
</tr>
<!-- END topic_description -->
<!-- BEGIN switch_news_cat -->
<tr>
<td class="row1" width="22%" align="right" ><span class="explaintitle"><b>{switch_news_cat.L_NEWS_CATEGORY}:</b></span></td>
<td class="row2" width="78%">
<select name="{switch_news_cat.S_NAME}">
{switch_news_cat.S_CATEGORY_BOX}
</select>
</td>
</tr>
<!-- END switch_news_cat -->
<!-- BEGIN switch_icon_checkbox -->
<tr>
<td valign="top" class="row1" align="right"><span class="explaintitle"><b>{L_ICON_TITLE}:</b></span></td>
<td class="row2">
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<!-- BEGIN row -->
<tr>
<td nowrap="nowrap">
<span class="gen">
<!-- BEGIN cell -->
<input type="radio" name="post_icon" value="{switch_icon_checkbox.row.cell.ICON_ID}"{switch_icon_checkbox.row.cell.ICON_CHECKED}>&nbsp;{switch_icon_checkbox.row.cell.ICON_IMG}&nbsp;&nbsp;
<!-- END cell -->
</span>
</td>
</tr>
<!-- END row -->
</table>
</td>
</tr>
<!-- END switch_icon_checkbox -->
<tr>
<td class="row1" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="1">
<tr>
<td align="right"><span class="explaintitle">{L_MESSAGE_BODY}:</span></td>



</tr>
<tr>
<td align="center"><br />
<table width="100" border="0" cellspacing="0" cellpadding="5">
<tr align="center">
<td colspan="{S_SMILIES_COLSPAN}" class="gensmall"><span class="explaintitle">{L_EMOTICONS}</span></td>
</tr>
<!-- BEGIN smilies_row -->
<tr align="center">
<!-- BEGIN smilies_col -->
<td><img src="{smilies_row.smilies_col.SMILEY_IMG}" border="0" onmouseover="this.style.cursor='hand';" onclick="emoticon('{smilies_row.smilies_col.SMILEY_CODE}');" alt="{smilies_row.smilies_col.SMILEY_DESC}" title="{smilies_row.smilies_col.SMILEY_DESC}" /></a></td>
<!-- END smilies_col -->
</tr>
<!-- END smilies_row -->
<!-- BEGIN switch_smilies_extra -->
<tr align="center">
<td colspan="{S_SMILIES_COLSPAN}" class="nav"><a href="{U_MORE_SMILIES}" onclick="window.open('{U_MORE_SMILIES}', '_phpbbsmilies', 'HEIGHT=250,resizable=yes,scrollbars=yes,WIDTH=300');return false;" target="_phpbbsmilies">{L_MORE_SMILIES}</a></td>
</tr>
<!-- END switch_smilies_extra -->
</table>
</td>
</tr>
</table>
</td>
<td class="row2" valign="top">


<table id="posttable" cellspacing="0" cellpadding="0" border="0" width="80%" style="border-collapse: collapse;">
	<tr>
		<td>
			<table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse: collapse;">
				<tr>
					<td width="7"><img src="mods/bbcode_box/images/bar-left.gif" width="7" height="25" border="0" alt="" /></td>
					<td background="mods/bbcode_box/images/bar-bg.gif">
						<table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse: collapse;">
							<tr>
								<td width="23"><img border="0" height="22" width="23" src="mods/bbcode_box/images/ltr.gif" class="postimage" name="dirltr" onClick="BBCdir('ltr')" onMouseOver="helpline('ltr')" alt="Left to Right" /></td>
								<td width="23"><img border="0" height="22" width="23" src="mods/bbcode_box/images/rtl.gif" class="postimage" name="dirrtl" onClick="BBCdir('rtl')" onMouseOver="helpline('rtl')" alt="Right to Left" /></td>
								<td width="6"><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td width="23"><img border="0" height="22" width="23" src="mods/bbcode_box/images/plain.gif" class="postimage" name="plain" onClick="BBCplain()" onMouseOver="helpline('plain')" alt="Remove BBcode" />
								<td width="6"><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td width="23"><input border="0" height="22" width="23" src="mods/bbcode_box/images/spell.gif" class="postimage" value="SpellCheck" name="button" type="image" onclick="openspell();return false;" onMouseOver="helpline('spell')" /></td>
								<td width="6"><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td align="right"><a href="http://#/" class="gensmall" title="BBCode Box MOD - by Disturbed One - www.HVMDesign.com" target="blank">Advanced BBCode Box v6</a>&nbsp;</td>
							</tr>
						</table>
					</td>
					<td width="13"><img src="mods/bbcode_box/images/bar-right.gif" width="13" height="25" border="0" alt="" /></td>
				</tr>
				<tr>
					<td width="7"><img src="mods/bbcode_box/images/bar-left.gif" width="7" height="25" border="0" alt="" /></td>
					<td background="mods/bbcode_box/images/bar-bg.gif">
						<table cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
							<tr>
								<td><img src="mods/bbcode_box/images/font.gif" width="23" height="22" border="0" alt="Font" /></td>
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
								<td><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/fade.gif" class="postimage" name="fade" onClick="BBCfade()" onMouseOver="helpline('fade')" alt="Fade" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/grad.gif" class="postimage" name="grad" onClick="BBCgrad()" onMouseOver="helpline('grad')" alt="Gradient" /></td>
								<td><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/list.gif" class="postimage" name="listdf" onClick="BBClist()" onMouseOver="helpline('list')" alt="List" /></td>
							</tr>
						</table>
					</td>
					<td width="13"><img src="mods/bbcode_box/images/bar-right.gif" width="13" height="25" border="0" alt="" /></td>
				</tr>
				<tr>
					<td width="7"><img src="mods/bbcode_box/images/bar-left.gif" width="7" height="25" border="0" alt="" /></td>
					<td background="mods/bbcode_box/images/bar-bg.gif">
						<table cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
							<tr>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/left.gif" class="postimage" name="left" onClick="BBCleft()" onMouseOver="helpline('left')" alt="Left" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/center.gif" class="postimage" name="center" onClick="BBCcenter()" onMouseOver="helpline('center')" alt="Center" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/right.gif" class="postimage" name="right" onClick="BBCright()" onMouseOver="helpline('right')" alt="Right" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/justify.gif" class="postimage" name="justify" onClick="BBCjustify()" onMouseOver="helpline('justify')" alt="Justify" /></td>
								<td><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/bold.gif" class="postimage" name="bold" onClick="BBCbold()" onMouseOver="helpline('b')" alt="Bold" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/italic.gif" class="postimage" name="italic" onClick="BBCitalic()" onMouseOver="helpline('i')" alt="Italic" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/under.gif" class="postimage" name="under" onClick="BBCunder()" onMouseOver="helpline('u')" alt="Underline" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/strike.gif" class="postimage" name="strik" onClick="BBCstrike()" onMouseOver="helpline('strike')" alt="Strike-through" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/sup.gif" class="postimage" name="supscript" onClick="BBCsup()" onMouseOver="helpline('sup')" alt="Superscript" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/sub.gif" class="postimage" name="subs" onClick="BBCsub()" onMouseOver="helpline('sub')" alt="Subscript" /></td>
								<td><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/marqd.gif" class="postimage" name="marqd" onClick="BBCmarqd()" onMouseOver="helpline('marqd')" alt="Marquee Down" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/marqu.gif" class="postimage" name="marqu" onClick="BBCmarqu()" onMouseOver="helpline('marqu')" alt="Marquee Up" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/marql.gif" class="postimage" name="marql" onClick="BBCmarql()" onMouseOver="helpline('marql')" alt="Marquee Left" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/marqr.gif" class="postimage" name="marqr" onClick="BBCmarqr()" onMouseOver="helpline('marqr')" alt="Marquee Right" /></td>
								<td><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/code.gif" class="postimage" name="code" onClick="BBCcode()" onMouseOver="helpline('code')" alt="Code" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/php.gif" class="postimage" name="php" onClick="BBCphp()" onMouseOver="helpline('php')" alt="PHP" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/quote.gif" class="postimage" name="quote" onClick="BBCquote()" onMouseOver="helpline('quote')" alt="Quote" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/spoil.gif" class="postimage" name="spoil" onClick="BBCspoil()" onMouseOver="helpline('spoil')" alt="Spoilers" /></td>
							</tr>
						</table>
					</td>
					<td width="13"><img src="mods/bbcode_box/images/bar-right.gif" width="13" height="25" border="0" alt="" /></td>
				</tr>
				<tr>
					<td width="7"><img src="mods/bbcode_box/images/bar-left.gif" width="7" height="25" border="0" alt="" /></td>
					<td background="mods/bbcode_box/images/bar-bg.gif">
						<table cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
							<tr>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/anchor.gif" class="postimage" name="anchor" onClick="BBCanchor()" onMouseOver="helpline('anchor')" alt="Anchor" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/url.gif" class="postimage" name="url" onClick="BBCurl()" onMouseOver="helpline('url')" alt="URL" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/email.gif" class="postimage" name="email" onClick="BBCmail()" onMouseOver="helpline('mail')" alt="Email" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/gotopost.gif" class="postimage" name="gotopost" onClick="BBCgotopost()" onMouseOver="helpline('gotopost')" alt="Gotopost" /></td>
								<td><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/search.gif" class="postimage" name="search" onClick="BBCsearch()" onMouseOver="helpline('search')" alt="Search" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/google.gif" class="postimage" name="you" onClick="BBCgoogle()" onMouseOver="helpline('google')" alt="Google" /></td>
								<td><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/img.gif" class="postimage" name="img" onClick="BBCimg()" onMouseOver="helpline('img')" alt="Image" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/flash.gif" class="postimage" name="flash" onClick="BBCflash()" onMouseOver="helpline('flash')" alt="Flash" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/sound.gif" class="postimage" name="stream" onClick="BBCstream()" onMouseOver="helpline('stream')" alt="Stream" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/ram.gif" class="postimage" name="ram" onClick="BBCram()" onMouseOver="helpline('ram')" alt="Real Media" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/video.gif" class="postimage" name="video" onClick="BBCvideo()" onMouseOver="helpline('video')" alt="Video" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/web.gif" class="postimage" name="web" onClick="BBCweb()" onMouseOver="helpline('web')" alt="Web Page" /></td>
								<td><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/tab.gif" class="postimage" name="tab" onClick="BBCtab()" onMouseOver="helpline('tab')" alt="Tab" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/nbsp.gif" class="postimage" name="nbsp" onClick="BBCnbsp()" onMouseOver="helpline('nbsp')" alt="NBSP" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/hr.gif" class="postimage" name="hr" onClick="BBChr()" onMouseOver="helpline('hr')" alt="H-Line" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/you.gif" class="postimage" name="you" onClick="BBCyou()" onMouseOver="helpline('you')" alt="You" /></td>
								<td><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/table.gif" class="postimage" name="table" onClick="BBCtable()" onMouseOver="helpline('table')" alt="Table" /></td>
						        <td><img border="0" height="22" width="23" src="mods/bbcode_box/images/youtube.gif" class="postimage" name="youtube" onClick="BBCyoutube()" onMouseOver="helpline('youtube')" alt="YouTube" /></td>
							</tr>
						</table>
					</td>
					<td width="13"><img src="mods/bbcode_box/images/bar-right.gif" width="13" height="25" border="0" alt="" /></td>
				</tr>
				<tr>
					<td width="7"><img src="mods/bbcode_box/images/bar-left.gif" width="7" height="25" border="0" alt="" /></td>
					<td background="mods/bbcode_box/images/bar-bg.gif">
						<table cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
							<tr>
								<td><img src="mods/bbcode_box/images/help.gif" width="23" height="22" border="0" alt="Help" /></td>
								<td><input type="text" name="helpbox" size="45" maxlength="100" style="width:395px; font-size:10px" value="Tip: Styles can be applied quickly to selected text." /></td>
							</tr>
						</table>
					</td>
					<td width="13"><img src="mods/bbcode_box/images/bar-right.gif" width="13" height="25" border="0" alt="" /></td>
				</tr>
				<tr>
					<td colspan="3"><textarea name="message" rows="15" cols="35" style="width:100%" tabindex="3" class="post" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this); typeQuietly(this, event);">{MESSAGE}</textarea></td>
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
</table>


</td>
</tr>
<tr>
<td class="row1" valign="top"><span class="explaintitle">{L_OPTIONS}:</span><br />
<span class="gensmall">{HTML_STATUS}<br />
{BBCODE_STATUS}<br />
{SMILIES_STATUS}</span></td>
<td class="row2"> 
<table cellspacing="0" cellpadding="1" border="0">
<!-- BEGIN switch_html_checkbox -->
<tr>
<td>
<input type="checkbox" name="disable_html" {S_HTML_CHECKED} />
</td>
<td class="gensmall">{L_DISABLE_HTML}</td>
</tr>
<!-- END switch_html_checkbox -->
<!-- BEGIN switch_bbcode_checkbox -->
<tr>
<td>
<input type="checkbox" name="disable_bbcode" {S_BBCODE_CHECKED} />
</td>
<td class="gensmall">{L_DISABLE_BBCODE}</td>
</tr>
<!-- END switch_bbcode_checkbox -->
<!-- BEGIN switch_smilies_checkbox -->
<tr>
<td>
<input type="checkbox" name="disable_smilies" {S_SMILIES_CHECKED} />
</td>
<td class="gensmall">{L_DISABLE_SMILIES}</td>
</tr>
<!-- END switch_smilies_checkbox -->
<!-- BEGIN switch_signature_checkbox -->
<tr>
<td>
<input type="checkbox" name="attach_sig" {S_SIGNATURE_CHECKED} />
</td>
<td class="gensmall">{L_ATTACH_SIGNATURE}</td>
</tr>
<!-- END switch_signature_checkbox -->
<!-- BEGIN switch_bookmark_checkbox -->
<tr> 
<td> 
<input type="checkbox" name="setbm" {S_SETBM_CHECKED} />
</td>
<td><span class="gensmall">{L_SET_BOOKMARK}</span></td>
</tr>
<!-- END switch_bookmark_checkbox -->
<!-- BEGIN switch_notify_checkbox -->
<tr>
<td>
<input type="checkbox" name="notify" {S_NOTIFY_CHECKED} />
</td>
<td class="gensmall">{L_NOTIFY_ON_REPLY}</td>
</tr>
<!-- END switch_notify_checkbox -->
<!-- BEGIN switch_delete_checkbox -->
<tr>
<td>
<input type="checkbox" name="delete" />
</td>
<td class="gensmall">{L_DELETE_POST}</td>
</tr>
<!-- END switch_delete_checkbox -->
<!-- BEGIN switch_lock_topic -->
<tr> 
<td> 
<input type="checkbox" name="lock" {S_LOCK_CHECKED} />
</td>
<td><span class="gensmall">{L_LOCK_TOPIC}</span></td>
</tr>
<!-- END switch_lock_topic -->
<!-- BEGIN switch_unlock_topic -->
<tr> 
<td> 
<input type="checkbox" name="unlock" {S_UNLOCK_CHECKED} />
</td>
<td><span class="gensmall">{L_UNLOCK_TOPIC}</span></td>
</tr>
<!-- END switch_unlock_topic -->
<!-- BEGIN switch_type_toggle -->
<tr>
<td></td>
<td><strong>{S_TYPE_TOGGLE}</strong></td>
</tr>
<!-- END switch_type_toggle -->
</table>
<!-- BEGIN switch_type_cal -->
<style type="text/css">@import url({TEMPLATE_PATH}calendar.css);</style>
<script src="templates/calendar.js"></script>
<script src="language/{LANG}/calendar.js"></script>
<script src="templates/calendar-setup.js"></script>
<script>
  is_event_allowed = 1;
</script>
<tr>
<th class="thHead" colspan="2">{L_CALENDAR_TITLE}</th>
</tr>
<tr>
<td class="row1"><span class="gen"><b>{L_CALENDAR_TITLE}&nbsp;:</b></span></td>
<td class="row2">
<span class="genmed"><input type="text" name="calendar_event" id="calendarevent" size="50" maxlength="255" class="post" value="{CALENDAR_EVENT}" readonly="1" />&nbsp;<img src="{DATE_PICKER_IMAGE}" id="trigger2" style="cursor: pointer;" onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />&nbsp;<img src="{CLEAR_DATE_IMAGE}" style="cursor: pointer;" onmouseover="this.style.background='red';" onmouseout="this.style.background=''" onclick="document.post.calendar_event.value='';" /></span></td>
<script>
Calendar.setup(
{
inputField  : "calendarevent",         // ID of the input field
ifFormat    : "%A, %B %e, %Y %I:%M %p",    // the date format
button      : "trigger2",       // ID of the button
align       : "T1"
}
);
</script>
<tr>
<td class="row1"><span class="gen"><b>{L_CALENDAR_UNTIL}&nbsp;:</b></span></td>
<td class="row2">
<span class="genmed"><input type="text" name="calendar_duration" id="calendarduration" size="50" maxlength="255" class="post" value="{CALENDAR_DURATION}" readonly="1" />&nbsp;<img src="{DATE_PICKER_IMAGE}" id="trigger3" style="cursor: pointer;" onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />&nbsp;<img src="{CLEAR_DATE_IMAGE}" style="cursor: pointer;" onmouseover="this.style.background='red';" onmouseout="this.style.background=''" onclick="document.post.calendar_duration.value='';" /></span></td>
<script>
Calendar.setup(
{
inputField  : "calendarduration",         // ID of the input field
ifFormat    : "%A, %B %e, %Y %I:%M %p",    // the date format
button      : "trigger3",       // ID of the button
align       : "T1"
}
);
</script>
</tr>
<tr>
<td class="row1"><span class="gen"><b>{L_REPEAT_MODE}&nbsp;:</b></span></td>
<td class="row2">
<span class="genmed">
{S_REPEATS_VALUE}{S_REPEATS}
</span>
</td>
</tr>
<!-- END switch_type_cal -->
{ATTACHBOX}{POLLBOX}{DELAYEDPOST}
<tr>
<td class="cat" colspan="2" align="center" height="28">{S_HIDDEN_FORM_FIELDS}
<input type="submit" tabindex="5" name="preview" class="mainoption" value="{L_PREVIEW}" />
&nbsp;&nbsp;<input type="submit" accesskey="s" tabindex="6" name="post" class="mainoption" value="{L_SUBMIT}" />
</td>
</tr>
</table>
</form>
<!-- BEGIN pm_review -->
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
<tr><th>{pm_review.L_MESSAGE_PREVIEW}</th></tr>
<tr> 
<td valign="top" class="row1">
{pm_review.PM_REVIEW_MESSAGE}
</td>
</tr>
</table>
<!-- END pm_review -->
{TOPIC_REVIEW_BOX} 
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a> 
<!-- BEGIN switch_not_privmsg -->
{NAV_CAT_DESC}
<!-- END switch_not_privmsg -->
{NAV_SEPARATOR} {L_POST_A}</td>
</tr>
<tr>
<td><br />{JUMPBOX}</td>
</tr>
</table>
<script>
var slice = Array.prototype.slice; // reify DOM nodes
// form title is not a .rowHead so we don't worry about it
var postingForm = document.getElementById('posting-form');
var heads = slice.call(document.getElementsByClassName('thHead'));
var container;
map(heads, function (head) {
  var tr = head.parentNode;
  container || (container = tr.parentNode);
  var children = takeWhile(tr, isNotHeader);
  console.log(head);

  // hide everything
  map(children, hide);

  // click to reveal
  var th = tr.children[0];
  var text = th.innerHTML;
  var hidden = true;
  updateText();
  function updateText() {
    th.innerHTML = text + " " + (hidden ? "[+]" : "[-]");
  }

  tr.onclick = function () {
    map(children, toggle);

    hidden = !hidden;
    updateText();
  }; 
});
//container.insertBefore(row, container.children[container.length - 1]);

function L(tag, opts) {
  var el = document.createElement(tag);
  if (opts.children) {
    for (var i = 0; i < opts.children; ++i) {
      el.appendChild(opts.children[i]);
    }
  }
  if (opts.parent) {
    opts.parent.appendChild(el);
  }
  return el;
}
function isNotHeader(el) {
  var child = el.children[0];
  if (!child) {
    return true;
  }
  return !child.classList.contains('thHead') && !child.classList.contains('cat');
}
function hide(el) {
  el.style.display = 'none';
}
function toggle(el) {
  el.style.display = el.style.display == 'none' ? '' : 'none';
}
function takeWhile(el, fn) {
  var xs = [];
  while ((el = el.nextElementSibling) && fn(el)) {
    xs.push(el);
  }
  return xs;
}
function map(xs, f) {
  for (var j = 0; j < xs.length; ++j) {
    f(xs[j]);
  }
}
</script>
