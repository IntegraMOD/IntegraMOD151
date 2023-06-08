<!-- INCLUDE pa_header.tpl -->
<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom">
		<span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a href="{U_DOWNLOAD_HOME}" class="nav">{DOWNLOAD}</a><!-- BEGIN navlinks --> -> <a href="{navlinks.U_VIEW_CAT}" class="nav">{navlinks.CAT_NAME}</a><!-- END navlinks --> -> {FILE_NAME}</span>
	</td>
  </tr>
</table>

<table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif"width="8" height="23" border="0" alt=""></td> 
   <td width="100%" background="templates/PowerMetal/images/blk_tm.gif"><img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""><span class="genmed2"><center>{L_FILE} - {FILE_NAME}</center></td>
   <td><img name="blkr" src="templates/PowerMetal/images/blk_trc.gif" width="77" height="23" border="0" alt=""></td>
  </tr>
  	</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="tlc" src="templates/PowerMetal/images/tlc.gif" width="8" height="6" border="0" alt=""></td> 
   <td width="100%" background="templates/PowerMetal/images/tm.gif"><img name="tm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="trc" src="templates/PowerMetal/images/trc.gif" width="8" height="6" border="0" alt=""></td>
  </tr>
  <tr>
    <td background="templates/PowerMetal/images/left.gif"><img name="left" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
        <td valign="top" bgcolor="#484848">
<table width="100%" border="0" cellspacing="1" cellpadding="10">
<tr>
<td bgcolor="#484848">
<table width="100%" cellpadding="4" cellspacing="1" class="forumline">
  <tr> 
	<th class="thCornerL" align="left" colspan="2">{L_FILE} - {FILE_NAME}</th>
	<th align="left" valign="top" nowrap class="thCornerR">
<!-- IF AUTH_EDIT -->  
		<a href="{U_EDIT}"><img src="{EDIT_IMG}" border="0" alt="{L_EDIT}" /></a> &nbsp;&nbsp;
<!-- ENDIF -->
<!-- IF AUTH_DELETE -->  
		<a href="javascript:delete_file('{U_DELETE}')"><img src="{DELETE_IMG}" border="0" alt="{L_DELETE}" /></a>
<!-- ENDIF -->
	</th>
  </tr>
<tr> 
	<td class="row2" valign="middle" width="20%"><span class="genmed">{L_DESC}:</span></td>
	<td class="row1" valign="middle" width="80%" colspan="2"><span class="genmed">{FILE_LONGDESC}</span></td>
</tr>
<tr>
	<td class="row2" valign="middle" width="20%"><span class="genmed">{L_SUBMITED_BY}:</span></td>
	<td class="row1" valign="middle" width="80%" colspan="2"><span class="name">{FILE_SUBMITED_BY}</span></td>
</tr>  
<!-- IF SHOW_AUTHOR -->
<tr>
	<td class="row2" valign="middle" width="20%"><span class="genmed">{L_AUTHOR}:</span></td>
	<td class="row1" valign="middle" width="80%" colspan="2"><span class="genmed">{FILE_AUTHOR}</span></td>
</tr>  
<!-- ENDIF -->
<!-- IF SHOW_VERSION -->
<tr> 
	<td class="row2" valign="middle" width="20%"><span class="genmed">{L_VERSION}:</span></td>
	<td class="row1" valign="middle" width="80%" colspan="2"><span class="genmed">{FILE_VERSION}</span></td>
  </tr>  
<!-- ENDIF -->  
<!-- IF SHOW_SCREENSHOT -->
<tr> 
	<td class="row2" valign="middle" width="20%"><span class="genmed">{L_SCREENSHOT}:</span></td>
	<!-- IF SS_AS_LINK -->
	<td class="row1" valign="middle" width="80%" colspan="2"><span class="genmed"><a href="{FILE_SCREENSHOT}" target="_blank">{L_CLICK_HERE}</a></span></td>
	<!-- ELSE -->
	<td class="row1" valign="middle" width="80%" colspan="2"><span class="genmed"><a href="javascript:mpFoto('{FILE_SCREENSHOT}')"><img src="{FILE_SCREENSHOT}" border="0" width="100" hight="100"></a></span></td>
	<!-- ENDIF -->
  </tr>  
<!-- ENDIF -->
<!-- IF SHOW_WEBSITE -->
  <tr> 
	<td class="row2" valign="middle" width="20%"><span class="genmed">{L_WEBSITE}:</span></td>
	<td class="row1" valign="middle" width="80%" colspan="2"><span class="genmed"><a href="{FILE_WEBSITE}" target="_blank">{L_CLICK_HERE}</a></span></td>
  </tr>
<!-- ENDIF --> 
<tr> 
	<td class="row2" valign="middle"><span class="genmed">{L_DATE}:</span></td>
	<td class="row1" valign="middle" colspan="2"><span class="genmed">{TIME}</span></td>
  </tr>
<tr> 
	<td class="row2" valign="middle"><span class="genmed">{L_UPDATE_TIME}:</span></td>
	<td class="row1" valign="middle" colspan="2"><span class="genmed">{UPDATE_TIME}</span></td>
  </tr>
  <tr> 
	<td class="row2" valign="middle"><span class="genmed">{L_LASTTDL}:</span></td>
	<td class="row1" valign="middle" colspan="2"><span class="genmed">{LAST}</span></td>
  </tr>
  <tr> 
	<td class="row2" valign="middle"><span class="genmed">{L_SIZE}:</span></td>
	<td class="row1" valign="middle" colspan="2"><span class="genmed">{FILE_SIZE}</span></td>
  </tr>  
  <tr> 
	<td class="row2" valign="middle"><span class="genmed">{L_RATING}:</span></td>
	<td class="row1" valign="middle" colspan="2"><span class="genmed">{RATING} ({FILE_VOTES} {L_VOTES})</span></td>
  </tr>
  <tr> 
	<td class="row2" valign="middle"><span class="genmed">{L_DLS}:</span></td>
	<td class="row1" valign="middle" colspan="2"><span class="genmed">{FILE_DLS}</span></td>
  </tr>
<!-- BEGIN custom_field -->
  <tr>
	<td class="row2" valign="middle"><span class="genmed">{custom_field.CUSTOM_NAME}:</span></td>
	<td class="row1" valign="middle" colspan="2"><span class="genmed">{custom_field.DATA}</span></td>
  </tr>
<!-- END custom_field -->
  <tr> 
	<td class="cat" align="center" colspan="3"></td>
  </tr>
</table>
</td>
</tr>
</table></td>
    <td background="templates/PowerMetal/images/right.gif"><img name="right" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
   <td><img name="blc" src="templates/PowerMetal/images/blc.gif" width="8" height="8" border="0" alt=""></td>
    <td background="templates/PowerMetal/images/btm.gif"><img name="btm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="brc" src="templates/PowerMetal/images/brc.gif" width="8" height="8" border="0" alt=""></td>
  </tr></table>

<table width="100%" cellpadding="2" cellspacing="0">
  <tr>
<!-- IF AUTH_DOWNLOAD -->  
	<td width="33%" align="center">
	<a href="{U_DOWNLOAD}"
		ONMOUSEOVER="changeImages('download_over', 'templates/PowerMetal/images/lang_english/icon_pa_download_hover.gif'); return true;" 
		ONMOUSEOUT="changeImages('download_over', 'templates/PowerMetal/images/lang_english/icon_pa_download.gif'); return true;">
		<img name="download_over" src="{DOWNLOAD_IMG}" border="0" alt="{L_DOWNLOAD}" /></a></td>
<!-- ENDIF -->
<!-- IF AUTH_RATE -->  
	<td width="34%" align="center">
		<a href="{U_RATE}"
		ONMOUSEOVER="changeImages('rate_over', 'templates/PowerMetal/images/lang_english/icon_pa_rate_hover.gif'); return true;" 
		ONMOUSEOUT="changeImages('rate_over', 'templates/PowerMetal/images/lang_english/icon_pa_rate.gif'); return true;">
		<img name="rate_over" src="templates/PowerMetal/images/lang_english/icon_pa_rate.gif" BORDER="0" alt="{L_RATE}" /></a></td>
<!-- ENDIF -->
<!-- IF AUTH_EMAIL -->  
	<td width="33%" align="center">
	<a href="{U_EMAIL}"
		ONMOUSEOVER="changeImages('email_over', 'templates/PowerMetal/images/lang_english/icon_pa_email_hover.gif'); return true;" 
		ONMOUSEOUT="changeImages('email_over', 'templates/PowerMetal/images/lang_english/icon_pa_email.gif'); return true;">
	<img name="email_over" src="{EMAIL_IMG}" border="0" alt="{L_EMAIL}" /></a></td>
<!-- ENDIF -->
  </tr>
</table>
<br />
<!-- IF INCLUDE_COMMENTS -->
	<!-- INCLUDE pa_comment_body.tpl -->
<!-- ENDIF -->
<!-- INCLUDE pa_footer.tpl -->
