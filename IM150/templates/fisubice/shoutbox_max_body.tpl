{COLOR_CSS}
<script language="JavaScript" type="text/javascript" src="templates/post_message.js"></script>
{JAVASCRIPT_BBCODE_BOX}
<script language='javascript' src='spelling/spellmessage.js'></script>
<style type="text/css">
.postimage {
	cursor: pointer;
	cursor: hand;
}
</style>

<table width="100%" cellspacing="0" cellpadding="2" border="0" align="center"><tr> 
<td align="left" valign="bottom"><span class="gensmall"> 
<!-- BEGIN switch_user_logged_in -->
{LAST_VISIT_DATE}<br />
<!-- END switch_user_logged_in -->
{CURRENT_TIME}<br />
</span><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
</tr>

</table>

{POST_PREVIEW_BOX}
{ERROR_BOX}
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" class="forumline">
<form action="{U_SHOUTBOX}" method="post" name="post" onsubmit="return checkForm(this)">
	<tr> 
		<th class="thHead" colspan="2" height="25"><b>{L_SHOUT_TEXT}</b></th>
	</tr>
	<!-- BEGIN switch_username_select -->
	<tr> 
		<td class="row1"><span class="gen"><b>{L_USERNAME}</b></span></td>
		<td class="row2"><span class="genmed"><input type="text" class="post" tabindex="1" name="username" size="25" maxlength="25" value="{USERNAME}" /></span></td>
	</tr>
	<!-- END switch_username_select -->

	<tr> 
	  <td class="row1" valign="top"> 
		<table width="100%" border="0" cellspacing="0" cellpadding="1">
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
				  <td colspan="{S_SMILIES_COLSPAN}"><span  class="nav"><a href="{U_MORE_SMILIES}" onclick="window.open('{U_MORE_SMILIES}', '_phpbbsmilies', 'HEIGHT=250,resizable=yes,scrollbars=yes,WIDTH=300');return false;" target="_phpbbsmilies" class="nav">{L_MORE_SMILIES}</a></span></td>
				</tr>
				<!-- END switch_smilies_extra -->
			  </table>
			</td>
		  </tr>
		</table>
	  </td>

	  <td class="row2" valign="top"><span class="gen"> <span class="genmed"> </span> 
<table id="posttable" cellspacing="0" cellpadding="0" border="0" width="450" style="border-collapse: collapse;">
	<tr>
		<td>
			<table cellspacing="0" cellpadding="0" border="0" width="450" style="border-collapse: collapse;">
				<tr>
					<td width="7"><img src="mods/bbcode_box/images/bar-left.gif" width="7" height="25" border="0" alt="" /></td>
					<td background="mods/bbcode_box/images/bar-bg.gif">
						<table cellspacing="0" cellpadding="0" border="0" width="430" style="border-collapse: collapse;">
							<tr>
								<td width="23"><img border="0" height="22" width="23" src="mods/bbcode_box/images/ltr.gif" class="postimage" name="dirltr" onClick="BBCdir('ltr')" onMouseOver="helpline('ltr')" alt="Left to Right" /></td>
								<td width="23"><img border="0" height="22" width="23" src="mods/bbcode_box/images/rtl.gif" class="postimage" name="dirrtl" onClick="BBCdir('rtl')" onMouseOver="helpline('rtl')" alt="Right to Left" /></td>
								<td width="6"><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td width="23"><img border="0" height="22" width="23" src="mods/bbcode_box/images/plain.gif" class="postimage" name="plain" onClick="BBCplain()" onMouseOver="helpline('plain')" alt="Remove BBcode" />
								<td width="6"><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td width="23"><input border="0" height="22" width="23" src="mods/bbcode_box/images/spell.gif" class="postimage" value="SpellCheck" name="button" type="image" onclick="openspell();return false;" onMouseOver="helpline('spell')" /></td>
								<td width="6"><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td align="right"><a href="http://hvmdesign.com/" class="gensmall" title="BBCode Box MOD - by Disturbed One - www.HVMDesign.com" target="blank">Advanced BBCode Box v5.0.0</a>&nbsp;</td>
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
					<td colspan="3"><textarea name="message" rows="15" cols="35" style="width:450px" tabindex="3" class="post" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this); typeQuietly(this, event);">{SHOUTBOX_MESSAGE}</textarea></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
		</span></td>
	</tr>
	<tr> 
	  <td class="row1" valign="top"><span class="gen"><b>{L_OPTIONS}</b></span><br /><span class="gensmall">{HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}</span></td>
	  <td class="row2"><span class="gen"> </span> 
		<table cellspacing="0" cellpadding="1" border="0">
		  <!-- BEGIN switch_html_checkbox -->
		  <tr> 
			<td> 
			  <input type="checkbox" name="disable_html" {S_HTML_CHECKED} />
			</td>
			<td><span class="gen">{L_DISABLE_HTML}</span></td>
		  </tr>
		  <!-- END switch_html_checkbox -->
		  <!-- BEGIN switch_bbcode_checkbox -->
		  <tr> 
			<td> 
			  <input type="checkbox" name="disable_bbcode" {S_BBCODE_CHECKED} />
			</td>
			<td><span class="gen">{L_DISABLE_BBCODE}</span></td>
		  </tr>
		  <!-- END switch_bbcode_checkbox -->
		</table>
	  </td>
	</tr>
	<tr> 
	  <td class="catBottom" colspan="2" align="center" height="28"> {S_HIDDEN_FORM_FIELDS}
<input type="submit" tabindex="5" name="refresh" class="mainoption" value="{L_SHOUT_REFRESH}" />&nbsp;
<input type="submit" tabindex="5" name="preview" class="mainoption" value="{L_SHOUT_PREVIEW}" />&nbsp;
<input type="submit" accesskey="s" tabindex="6" name="shout" class="mainoption" value="{L_SHOUT_SUBMIT}" /></td>
	</tr>
  </table>
</form>
  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
	<tr> 
	   <td align="right" valign="bottom" class="gensmall"> 
<span class="nav">
	{PAGINATION}</span>
</td>
	</tr>
</table>
<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
	<tr align="right">
		<td class="catHead" colspan="2" height="28" align="center"><b>&nbsp;{L_SHOUTBOX}&nbsp;<b/></td>
	</tr>
	<tr>
		<th class="thLeft" width="160" height="26" nowrap="nowrap">{L_AUTHOR}</th>
		<th class="thRight" nowrap="nowrap">{L_MESSAGE}</th>
	</tr>

	<!-- BEGIN shoutrow -->
	<tr> 
		<td width="160" align="left" valign="top" class="{shoutrow.ROW_CLASS}">
			<span class="name"><b>{shoutrow.SHOUT_USERNAME}</b></span><br />
			<span class="postdetails">{shoutrow.USER_RANK}<br />
			{shoutrow.RANK_IMAGE}<br/>
			{shoutrow.USER_AVATAR}<br /><br/>{shoutrow.USER_JOINED}</span></td>
		<td class="{shoutrow.ROW_CLASS}" width="100%" height="28" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100%"><a href="{shoutrow.U_MINI_POST}"><img src="{shoutrow.MINI_POST_IMG}" width="12" height="9" alt="{shoutrow.L_MINI_POST_ALT}" title="{shoutrow.L_MINI_POST_ALT}" border="0" /></a>
					<span class="postdetails">{L_POSTED}: {shoutrow.TIME}</span></td>
				<td valign="top" align="right" nowrap="nowrap">{shoutrow.QUOTE_IMG}{shoutrow.EDIT_IMG}{shoutrow.CENSOR_IMG}{shoutrow.DELETE_IMG}{shoutrow.IP_IMG}</td></form>
			</tr>
			<tr> 
				<td colspan="2"><hr/></td>
			</tr>
			<tr>
				<td colspan="2"><span class="postbody">{shoutrow.SHOUT}{shoutrow.SIGNATURE}</span></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr> 
		<td class="spaceRow" colspan="2" height="1"><img src="{TEMPLATE}images/spacer.gif" alt="" width="1" height="1" /></td>
	</tr>
	<!-- END shoutrow -->

</table>
  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
	<tr> 
	  <td align="left" valign="top"><span class="gensmall">{S_TIMEZONE}</span></td>
	  <td align="right" valign="bottom" class="gensmall"> 
<span class="nav">
	{PAGINATION}</span>
</td>
	</tr>
</table>