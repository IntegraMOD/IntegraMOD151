<script language="JavaScript" type="text/javascript" src="templates/assets/js/post_message.js"></script>
<script language="JavaScript" type="text/javascript">
<!--
function checkForm1() { 

   formErrors = false;    

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

<form method="post" action="{S_ACTION}" onsubmit="return checkForm1(this)" name="post">

{KB_PRETEXT_BOX}
{KB_PREVIEW_BOX}

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr>
		<td align="left" class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a href="{U_KB}" class="nav">{L_KB}</a></td>
	</tr>
</table>
<table border="0" cellpadding="3" cellspacing="1" align="center" width="100%" class="forumline">
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
	     <input type="text" name="article_name" size="45" maxlength="100" style="width:450px" class="post" value="{ARTICLE_TITLE}" onkeydown="typeQuietly(this, event);" /></span></td>
  </tr>
  <tr> 
  	   <td class="row1"><span class="gen"><b>{L_ARTICLE_DESCRIPTION}</b></span></td>
	   <td class="row2"> <span class="gen"> 
	     <input type="text" name="article_desc" size="45" maxlength="255" style="width:450px" class="post" value="{ARTICLE_DESC}" onkeydown="typeQuietly(this, event);" /></span></td>
  </tr>
  <tr> 
  	   <td class="row1" valign="top"><span class="gen"><b><nobr>{L_ARTICLE_TEXT}</nobr></b><br /><br />
	     <table width="100" border="0" cellspacing="0" cellpadding="5" align="center">
			<tr align="center"> 
				<td colspan="{S_SMILIES_COLSPAN}" class="gensmall"><b>{L_EMOTICONS}</b></td>
			</tr>
			<!-- BEGIN smilies_row -->
			<tr align="center" valign="middle"> 
			<!-- BEGIN smilies_col -->
				 <td><img src="{smilies_row.smilies_col.SMILEY_IMG}" border="0" onmouseover="this.style.cursor='hand';" onclick="emoticon('{smilies_row.smilies_col.SMILEY_CODE}');" alt="{smilies_row.smilies_col.SMILEY_DESC}" title="{smilies_row.smilies_col.SMILEY_DESC}" /></a></td>
			<!-- END smilies_col -->
			</tr>
			<!-- END smilies_row -->
			<!-- BEGIN switch_smilies_extra -->
			<tr align="center"> 
				<td colspan="{S_SMILIES_COLSPAN}"><span  class="nav"><a href="{U_MORE_SMILIES}" onclick="window.open('{U_MORE_SMILIES}', '_phpbbsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=250');return false;" target="_phpbbsmilies" class="nav">{L_MORE_SMILIES}</a></span></td>
			</tr>
			<!-- END switch_smilies_extra -->
		 </table>
		 <br /><br /><span class="gen"><b><nobr>Options</nobr></b></span><br /><span class="gensmall">{HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}</span><br /><br />
	   </td>
	   <td class="row2">
	     <table width="450" border="0" cellspacing="0" cellpadding="2">
		   <tr>
		     <td>
			   <table width="450" border="0" cellspacing="0" cellpadding="2">
		  	     <tr align="center" valign="middle"> 
				   <td>
			  <p dir="rtl" style="margin-top: 0; margin-bottom: 0" align="left"><span class="gen"> 
			  <span class="genmed"> 
			  &nbsp;<select name="fc" onChange="BBCfc()" onMouseOver="helpline('fc')" 	
					  <option style="color:darkred; background-color: {T_TD_COLOR1}" value="darkred" class="genmed" dir="ltr">
              <option selected>Font Color</option>
              <option style="color:black; value="{T_FONTCOLOR1}" value="{T_FONTCOLOR1}">{L_COLOR_DEFAULT}</option>
              <option value="darkred">{L_COLOR_DARK_RED}</option>
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
			  </select>&nbsp;&nbsp; <select name="fs" onChange="BBCfs()" onMouseOver="helpline('fs')" 
			  		  <option value="7" class="genmed" dir="ltr">
              <option selected>Font Size</option>
              {L_FONT_TINY}</option>
					  <option value="9" class="genmed">{L_FONT_SMALL}</option>
					  <option value="12" class="genmed">{L_FONT_NORMAL}</option>
					  <option value="18" class="genmed">{L_FONT_LARGE}</option>
					  <option  value="24" class="genmed">{L_FONT_HUGE}</option>
					</select> <span lang="ar-sy">&nbsp;</span><select name="ft" onChange="BBCft()" onMouseOver="helpline('ft')" 
        <option style="color:black; background-color: #FFFFFF " value="{L_ARIAL}" class="genmed" dir="ltr">
                                          <option selected>Font type</option>
                                          <option value="Arial">Default font
                                          </option>
<option style="color:black; background-color: #FFFFFF " value="Andalus" class="genmed">
Andalus</option> 
<option style="color:black; background-color: #FFFFFF " value="Arial" class="genmed">
Arial</option> 
<option style="color:black; background-color: #FFFFFF " value="Comic Sans MS" class="genmed">
Comic Sans MS</option> 
<option style="color:black; background-color: #FFFFFF " value="Courier New" class="genmed">
Courier New</option> 
                                          <option value="Lucida Console">Lucida Console
                                          </option>
<option style="color:black; background-color: #FFFFFF " value="Microsoft Sans Serif" class="genmed">
Microsoft Sans Serif</option> 
<option style="color:black; background-color: #FFFFFF " value="Symbol" class="genmed">
Symbol</option> 
<option style="color:black; background-color: #FFFFFF " value="Tahoma" class="genmed">
Tahoma</option> 
<option style="color:black; background-color: #FFFFFF " value="Times New Roman" class="genmed">
Times New Roman</option> 
<option style="color:black; background-color: #FFFFFF " value="Traditional Arabic" class="genmed">
Traditional Arabic</option> 
<option style="color:black; background-color: #FFFFFF " value="Verdana" class="genmed">
Verdana</option> 
<option style="color:black; background-color: #FFFFFF " value="Webdings" class="genmed">
Webdings</option> 
<option style="color:black; background-color: #FFFFFF " value="Wingdings" class="genmed">
Wingdings</option> 
                                  </select></span></span></span><p dir="rtl" style="margin-top: 0; margin-bottom: 0">
              <span class="genmed"><span style="font-size: 5pt">&nbsp;</span></span></td>
		  </tr>
		  <span class="gen"> 
		  <tr> 
			<td width="450"> 
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
                        <td> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
                                <tr> 
                                  <td>
                                  <p dir="ltr" align="left"><span class="gen">  
			  <span class="genmed"> 
			          <span lang="ar-sy">&nbsp;</span><img border="0" src="bbcode_box/images/justify.gif" name="justify" type="image" onClick="BBCjustify()" onMouseOver="helpline('justify')" style="border-style: outset; border-width: 1" alt="justify"><img border="0" src="bbcode_box/images/right.gif" name="right" type="image" onClick="BBCright()" onMouseOver="helpline('right')" style="border-style: outset; border-width: 1" alt="right"><img border="0" src="bbcode_box/images/center.gif" name="center" type="image" onClick="BBCcenter()" onMouseOver="helpline('center')" style="border-style: outset; border-width: 1" alt="center"><img border="0" src="bbcode_box/images/left.gif" name="left" type="image" onClick="BBCleft()" onMouseOver="helpline('left')" style="border-style: outset; border-width: 1" alt="left">&nbsp;&nbsp; 
                                  <img border="0" src="bbcode_box/images/bold.gif" name="bold" type="image" onClick="BBCbold()" onMouseOver="helpline('b')" style="border-style: outset; border-width: 1" alt="bold"><img border="0" src="bbcode_box/images/italic.gif" name="italic" type="image" onClick="BBCitalic()" onMouseOver="helpline('i')" style="border-style: outset; border-width: 1" alt="italic"><img border="0" src="bbcode_box/images/under.gif" name="under" type="image" onClick="BBCunder()" onMouseOver="helpline('u')" style="border-style: outset; border-width: 1" alt="under line"><img border="0" src="bbcode_box/images/strike.gif" name="strike" type="image" onClick="BBCstrike()" onMouseOver="helpline('strike')" style="border-style: outset; border-width: 1" alt="strike"><img border="0" src="bbcode_box/images/sup.gif" name="sup" type="image" onClick="BBCsup()" onMouseOver="helpline('sup')" style="border-style: outset; border-width: 1" alt="sup"><img border="0" src="bbcode_box/images/sub.gif" name="sub" type="image" onClick="BBCsub()" onMouseOver="helpline('sub')" style="border-style: outset; border-width: 1" alt="sub">&nbsp;&nbsp; 
                                  <img border="0" src="bbcode_box/images/fade.gif" name="fade" type="image" onClick="BBCfade()" onMouseOver="helpline('fade')" style="border-style: outset; border-width: 1" alt="fade"><img border="0" src="bbcode_box/images/grad.gif" name="grad" type="image" onClick="BBCgrad()" onMouseOver="helpline('grad')" style="border-style: outset; border-width: 1" alt="gradient">&nbsp;&nbsp; 
                                  <img border="0" src="bbcode_box/images/rtl.gif" name="dirrtl" type="image" onClick="BBCdir('rtl')" onMouseOver="helpline('rtl')" style="border-style: outset; border-width: 1" alt="Right to Left"><img border="0" src="bbcode_box/images/ltr.gif" name="dirltr" type="image" onClick="BBCdir('ltr')" onMouseOver="helpline('ltr')" style="border-style: outset; border-width: 1" alt="Left to Right">&nbsp;&nbsp; 
                                  <img border="0" src="bbcode_box/images/marqd.gif" name="marqd" type="image" onClick="BBCmarqd()" onMouseOver="helpline('marqd')" style="border-style: outset; border-width: 1" alt="Marque to down"><img border="0" src="bbcode_box/images/marqu.gif" name="marqu" type="image" onClick="BBCmarqu()" onMouseOver="helpline('marqu')" style="border-style: outset; border-width: 1" alt="Marque to up"><img border="0" src="bbcode_box/images/marql.gif" name="marql" type="image" onClick="BBCmarql()" onMouseOver="helpline('marql')" style="border-style: outset; border-width: 1" alt="Marque to left"><img border="0" src="bbcode_box/images/marqr.gif" name="marqr" type="image" onClick="BBCmarqr()" onMouseOver="helpline('marqr')" style="border-style: outset; border-width: 1" alt="Marque to right"></span></td> 
                                </tr> 
                                <tr> 
                                  <td dir="rtl">
                                  <p align="right" dir="rtl" style="margin-top: 0; margin-bottom: 0">
                                  <span style="font-size: 5pt">&nbsp;</span><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0"><span class="gen"> 
			  <span class="genmed"> 
			          &nbsp;<img border="0" src="bbcode_box/images/code.gif" name="code" type="image" onClick="BBCcode()" onMouseOver="helpline('code')" style="border-style: outset; border-width: 1" alt="Code"><img border="0" src="bbcode_box/images/php.gif" name="php" type="image" onClick="BBCphp()" onMouseOver="helpline('php')" style="border-style: outset; border-width: 1" alt="PHP"><img border="0" src="bbcode_box/images/quote.gif" name="quote" type="image" onClick="BBCquote()" onMouseOver="helpline('quote')" style="border-style: outset; border-width: 1" alt="Quote">&nbsp;&nbsp;<img border="0" src="bbcode_box/images/list.gif" name="list" type="image" onClick="BBClist()" onMouseOver="helpline('list')" style="border-style: outset; border-width: 1" alt="List">&nbsp;&nbsp; 
                                  <img border="0" src="bbcode_box/images/google.gif" name="google" type="image" onClick="BBCgoogle()" onMouseOver="helpline('google')" style="border-style: outset; border-width: 1" alt="google">&nbsp;&nbsp;
                                  <img border="0" src="bbcode_box/images/url.gif" name="url" type="image" onClick="BBCurl()" onMouseOver="helpline('url')" style="border-style: outset; border-width: 1" alt="URL"><img border="0" src="bbcode_box/images/email.gif" name="email" type="image" onClick="BBCmail()" onMouseOver="helpline('mail')" style="border-style: outset; border-width: 1" alt="Email"><img border="0" src="bbcode_box/images/web.gif" name="web" type="image" onClick="BBCweb()" onMouseOver="helpline('web')" style="border-style: outset; border-width: 1" alt="Wep Page">&nbsp;&nbsp; 
                                  <img border="0" src="bbcode_box/images/img.gif" name="img" type="image" onClick="BBCimg()" onMouseOver="helpline('img')" style="border-style: outset; border-width: 1" alt="Image"><img border="0" src="bbcode_box/images/flash.gif" name="flash" type="image" onClick="BBCflash()" onMouseOver="helpline('flash')" style="border-style: outset; border-width: 1" alt="Flash"><img border="0" src="bbcode_box/images/video.gif" name="video" type="image" onClick="BBCvideo()" onMouseOver="helpline('video')" style="border-style: outset; border-width: 1" alt="Video"><img border="0" src="bbcode_box/images/sound.gif" name="stream" type="image" onClick="BBCstream()" onMouseOver="helpline('stream')" style="border-style: outset; border-width: 1" alt="Stream"><img border="0" src="bbcode_box/images/ram.gif" name="ram" type="image" onClick="BBCram()" onMouseOver="helpline('ram')" style="border-style: outset; border-width: 1" alt="Real Media">&nbsp;&nbsp; 
                                  <img border="0" src="bbcode_box/images/hr.gif" name="hr" type="image" onClick="BBChr()" onMouseOver="helpline('hr')" style="border-style: outset; border-width: 1" alt="H-Line">&nbsp;&nbsp; 
                                  <img border="0" src="bbcode_box/images/plain.gif" name="plain" type="image" onClick="BBCplain()" onMouseOver="helpline('plain')" style="border-style: outset; border-width: 1" alt="Remove BBcode">&nbsp;&nbsp;<img border="0" src="bbcode_box/images/you.gif" name="you" type="image" onClick="BBCyou()" onMouseOver="helpline('you')" style="border-style: outset; border-width: 1" alt="you"></span></td> 
                                </tr> 
                          </table> 
                        </td> 
                  </tr> 

			  </table>
			</td></tr> 

			  </table>
			</td>
  			 </tr>
			 <tr>
<td colspan="9">
<input type="text" name="helpbox" size="45" maxlength="100" style="width:450px; font-size:10px" class="helpline" value="{L_STYLES_TIP}" />
</td>
</tr>
  			 <tr> 
		        <td><span class="gen"><textarea name="message" rows="22" cols="35" wrap="virtual" style="width:450px" class="post" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this); typeQuietly(this, event);">{ARTICLE_BODY}</textarea></span></td>
		     </tr>
		   </table>
	      </td>
	 </td>
  </tr>
  <tr> 
  	   <td class="row1" valign="top"><span class="gen"><b><nobr>{L_ARTICLE_TYPE}</nobr></b></span></td>
	   <td class="row2"><span class="gen">
	     <select name="type_id">
		   <option value="select_one">{L_SELECT}</option>
		   <!-- BEGIN types -->
		   {types.TYPE}
		   <!-- END types -->
		   
		 </select>
 		 </span> 
	   </td>
  </tr>
  <!-- BEGIN switch_edit -->
  <tr> 
  	   <td class="row1"><span class="gen"><b><nobr>{L_TOPIC}</nobr></b></span></td>
	   <td class="row2"> <span class="gen"> 
	     <input type="text" name="topic" size="45" maxlength="100" style="width:450px" class="post" value="{TOPIC}" /></span></td>
  </tr>
  <tr>
    <td class="row1"><span class="gen"><b>{L_ARTICLE_CATEGORY}</b></span></td>
    <td class="row2"><select name="category_id">
    {CATEGORYY}
    </select></td>
  </tr>
  <!-- END switch_edit -->
  <tr> 
  	   <td class="cat" colspan="2" align="center" height="28">{S_HIDDEN_FIELDS}<input type="submit" name="preview" value="{L_PREVIEW}" class="mainoption"> <input type="submit" name="article_submit" class="mainoption" value="{L_SUBMIT}" /></td>
  </tr> 
</table>
</form>
<table width="100%" cellspacing="2" border="0" align="center">
  <tr> 
	<td valign="top" align="right"><br />{JUMPBOX}</td>
  </tr>
</table>

</td>
</tr>
</table>