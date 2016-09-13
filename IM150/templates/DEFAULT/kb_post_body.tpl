<script language="JavaScript" type="text/javascript" src="templates/post_message.js"></script>
<script src="{JAVASCRIPT_BBCODE_BOX}"></script>
<script language='javascript' src='spelling/spellmessage.js'></script>

<script language="JavaScript" type="text/javascript">
<!--
function checkForm() { 

   formErrors = false;    
   if (document.post.article_name.value.length < 2) { 
      formErrors = "{L_EMPTY_ARTICLE_NAME}\r"; 
   } 
   if (document.post.article_desc.value.length < 2) { 
      formErrors = "{L_EMPTY_ARTICLE_DESC}\r"; 
   } 
   if (document.post.message.value.length < 2) { 
      formErrors = "{L_EMPTY_MESSAGE}\r"; 
   } 
   if (document.post.type_id.value=='select_one') { 
      formErrors = "{L_EMPTY_TYPE}\r"; 
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
//-->
</script>

<!-- BEGIN tinyMCE -->
<script language="javascript" type="text/javascript" src="modules/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
   tinyMCE.init({
      mode : "textareas",
      theme : "advanced",
      theme_advanced_toolbar_location : "top",
      plugins : "table",
      theme_advanced_buttons3_add_before : "tablecontrols, separator"
   });
</script>
<!-- END tinyMCE -->

<form method="post" action="{S_ACTION}" onsubmit="return checkForm(this)" name="post">

{KB_PRETEXT_BOX}
{KB_PREVIEW_BOX}

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr>
		<td align="left" class="nav"><a href="{U_KB}" class="nav">{L_KB}</a></td>
	</tr>
</table>

<table border="0" cellpadding="4" cellspacing="0" align="center" width="100%" class="forumline">
  <tr>
        <th class="thHead" colspan="2" height="25"><b>{L_ADD_ARTICLE}</b></th>
  </tr>
  <!-- BEGIN switch_name -->
  <tr> 
  	   <td class="row1"><span class="gen"><b><nobr>{L_NAME}</nobr></b></span></td>
	   <td class="row2"> <span class="gen"> 
	     <input type="text" name="username" size="45" maxlength="100" style="width:450px" class="post" value="{USERNAME}" /></span></td>
  </tr>
  <!-- END switch_name -->
  <tr> 
  	   <td class="row1"><span class="gen"><b><nobr>{L_ARTICLE_TITLE}</nobr></b></span></td>
	   <td class="row2"> <span class="gen"> 
	     <input type="text" name="article_name" size="45" maxlength="100" style="width:450px" class="post" value="{ARTICLE_TITLE}" /></span></td>
  </tr>
  <tr> 
  	   <td class="row1"><span class="gen"><b>{L_ARTICLE_DESCRIPTION}</b></span></td>
	   <td class="row2"> <span class="gen"> 
	     <input type="text" name="article_desc" size="45" maxlength="255" style="width:450px" class="post" value="{ARTICLE_DESC}" /></span></td>
  </tr>
<!-- BEGIN custom_data_fields -->  
  <tr>
	<td class="cat" colspan="2" align="center"><span class="cattitle">{custom_data_fields.L_ADDTIONAL_FIELD}</span></td>
  </tr>  
<!-- END custom_data_fields --> 

<!-- BEGIN input -->
  <tr>
	<td class="row1"><span class="genmed">{input.FIELD_NAME}</span><br><span class="gensmall">{input.FIELD_DESCRIPTION}</span></td>
	<td class="row2">
	<input type="text" class="post" size="50" name="field[{input.FIELD_ID}]" value="{input.FIELD_VALUE}" />
	</td>
  </tr>
<!-- END input -->
<!-- SPILT -->
<!-- BEGIN textarea -->
  <tr>
	<td class="row1"><span class="genmed">{textarea.FIELD_NAME}</span><br><span class="gensmall">{textarea.FIELD_DESCRIPTION}</span></td>
	<td class="row2">
	<textarea rows="6" class="post" name="field[{textarea.FIELD_ID}]" cols="32">{textarea.FIELD_VALUE}</textarea>
	</td>
  </tr>
<!-- END textarea -->
<!-- SPILT -->
<!-- BEGIN radio -->
  <tr>
	<td class="row1"><span class="genmed">{radio.FIELD_NAME}</span><br><span class="gensmall">{radio.FIELD_DESCRIPTION}</span></td>
	<td class="row2">
	<!-- BEGIN row -->	
	<input type="radio" name="field[{radio.FIELD_ID}]" value="{radio.row.FIELD_VALUE}" {radio.row.FIELD_SELECTED} /><span class="gensmall">{radio.row.FIELD_VALUE}</span>&nbsp;
	<!-- END row -->
	</td>
  </tr>	
<!-- END radio -->
<!-- SPILT -->
<!-- BEGIN select -->
  <tr>
	<td class="row1"><span class="genmed">{select.FIELD_NAME}</span><br><span class="gensmall">{select.FIELD_DESCRIPTION}</span></td>
	<td class="row2">
		<select name="field[{select.FIELD_ID}]" class="post">
		<!-- BEGIN row -->	
		<option value="{select.row.FIELD_VALUE}"{radio.row.FIELD_SELECTED}>{select.row.FIELD_VALUE}</option>
		<!-- END row -->
		</select>
	</td>
  </tr>	
<!-- END select -->
<!-- SPILT -->
<!-- BEGIN select_multiple -->
  <tr>
	<td class="row1"><span class="genmed">{select_multiple.FIELD_NAME}</span><br><span class="gensmall">{select_multiple.FIELD_DESCRIPTION}</span></td>
	<td class="row2">
		<select name="field[{select_multiple.FIELD_ID}][]" multiple="multiple" size="4" class="post">
		<!-- BEGIN row -->	
		<option value="{select_multiple.row.FIELD_VALUE}"{select_multiple.row.FIELD_SELECTED}>{select_multiple.row.FIELD_VALUE}</option>
		<!-- END row -->
		</select>
	</td>
  </tr>	
<!-- END select_multiple -->
<!-- SPILT -->
<!-- BEGIN checkbox -->
  <tr>
	<td class="row1"><span class="genmed">{checkbox.FIELD_NAME}</span><br><span class="gensmall">{checkbox.FIELD_DESCRIPTION}</span></td>
	<td class="row2">
	<!-- BEGIN row -->	
	<input type="checkbox" name="field[{checkbox.FIELD_ID}][{checkbox.row.FIELD_VALUE}]" value="{checkbox.row.FIELD_VALUE}" {checkbox.row.FIELD_CHECKED}><span class="gensmall">{checkbox.row.FIELD_VALUE}</span>&nbsp;
	<!-- END row -->
	</td>
  </tr>	
<!-- END checkbox -->
  <tr> 
  	   <td class="row1" valign="top"><span class="gen"><b><nobr>{L_ARTICLE_TEXT}</nobr></b><br /><br />
	     <table width="100" border="0" cellspacing="0" cellpadding="5" align="center">
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
		 <br /><br /><span class="gen"><b><nobr>{L_OPTIONS}</nobr></b></span><br /><span class="gensmall">{HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}</span><br /><br />
	   </td>
	  <td class="row2" valign="top"><span class="gen">
		<!-- BEGIN switch_bbcodes -->
<table id="posttable" cellspacing="0" cellpadding="0" border="0" width="450px" style="border-collapse: collapse;">
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
			</table>
		</td>
	</tr>

  		<!-- END switch_bbcodes -->
  			 
  			 <tr> 
		        <td colspan="9"><span class="gen"><textarea name="message" rows="30" cols="35" wrap="virtual" style="width:450px" class="post" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);">{ARTICLE_BODY}</textarea></span>
				<!-- BEGIN formatting -->
		        <br /><span class="gen"><b><nobr>{L_FORMATTING}</nobr></b></span><hr><span class="gensmall"><b>{L_PAGES}</b><br />{L_PAGES_EXPLAIN}<br /><b>{L_TOC}</b><br />{L_TOC_EXPLAIN}<br /><b>{L_ABSTRACT}</b><br />{L_ABSTRACT_EXPLAIN}<br /><hr><b>{L_TITLE_FORMAT}</b><br />{L_TITLE_FORMAT_EXPLAIN}<br /><b>{L_SUBTITLE_FORMAT}</b><br />{L_SUBTITLE_FORMAT_EXPLAIN}<br /><b>{L_SUBSUBTITLE_FORMAT}</b><br />{L_SUBSUBTITLE_FORMAT_EXPLAIN}</span><br /><br />
				<!-- END formatting -->
				</td>
		     </tr>
		     
		  </table>
	   </span></td>
  </tr>
  
  <tr> 
  	   <td class="row1" valign="top"><span class="gen"><b><nobr>{L_ARTICLE_TYPE}</nobr></b></span></td>
	   <td class="row2"><span class="gen">
	     <select name="type_id">
		   <option value="select_one">{L_SELECT_TYPE}</option>
		   <!-- BEGIN types -->
		   {types.TYPE}
		   <!-- END types -->
		 </select>
 		 </span> 
	   </td>
  </tr>
  <!-- BEGIN switch_edit -->
  <tr>
    <td class="row1"><span class="gen"><b>{L_ARTICLE_CATEGORY}</b></span></td>
    <td class="row2">
    	<select name="cat">
		{switch_edit.CAT_LIST}
		</select>
    </td>
  </tr>
  <!-- END switch_edit -->
  <tr> 
  	   <td class="catBottom" colspan="2" align="center" height="28">{S_HIDDEN_FIELDS}<input type="submit" name="preview" value="{L_PREVIEW}" class="mainoption"> <input type="submit" name="article_submit" class="mainoption" value="{L_SUBMIT}" /></td>
  </tr> 
</table>
</form>


 
