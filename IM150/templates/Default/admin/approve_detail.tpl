<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="bodyline">
  <tr align="center" valign="bottom"> 
    <td nowrapclass="copyright" align="center"><table width="600" border="0" cellspacing="0" cellpadding="10">
        <tr> 
          <td class="copyright"><div align="center">{S_APPROVE}</div></td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr> 
    <td width="600" colspan="2" align="left" valign="bottom" nowrap><a href="{U_VIEW_TOPIC}" class="maintitle">{TOPIC_TITLE}</a><br /></td>
  </tr>
  <tr> 
	<td width="600" align="left" valign="middle" nowrap><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> 
	  -> <a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a></span></td>
  </tr>
</table>
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" class="forumline">
  <tr align="right"> 
    <td class="cat" colspan="2" height="28"><span class="nav">&nbsp;</span></td>
  </tr>
  {POLL_DISPLAY} 
  <tr> 
    <th class="thLeft" width="150" height="26" nowrap="nowrap">{L_AUTHOR}</th>
    <th nowrap="nowrap" class="thRight">{L_MESSAGE}</th>
  </tr>
  <tr> 
    <td width="150" align="left" valign="top" class="{ROW_CLASS}"><span class="name"><a name="{U_POST_ID}"></a><b>{POSTER_NAME}</b></span><br /> 
      <span class="postdetails">{POSTER_RANK}<br />
      {RANK_IMAGE}{POSTER_AVATAR}<br />
      <br />
      {POSTER_JOINED}<br />
      {POSTER_POSTS}<br />
      {POSTER_FROM}</span><br /></td>
    <td class="{ROW_CLASS}" width="100%" height="28" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="100%"><span class="postdetails">{L_POSTED}: 
            {POST_DATE}<span class="gen">&nbsp;</span>&nbsp; &nbsp;{L_POST_SUBJECT}: 
            {POST_SUBJECT}</span></td>
          <td valign="top" nowrap="nowrap"> {EDIT_IMG} {DELETE_IMG} {IP_IMG}</td>
        </tr>
        <tr> 
          <td colspan="2"><hr /></td>
        </tr>
        <tr> 
          <td colspan="2"><span class="postbody">{MESSAGE}{SIGNATURE}</span><span class="gensmall">{EDITED_MESSAGE}</span></td>
        </tr>
      </table>
	  <table width="444" height="1" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td style="height: 1px;">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td class="{ROW_CLASS}" width="150" align="left" valign="middle">&nbsp;</td>
    <td class="{ROW_CLASS}" width="444" height="28" valign="bottom" nowrap="nowrap"><table cellspacing="0" cellpadding="0" border="0" height="18" width="18">
        <tr> 
          <td valign="middle" nowrap="nowrap">{PROFILE_IMG} {PM_IMG} {EMAIL_IMG} 
            {WWW_IMG} {AIM_IMG} {YIM_IMG} {MSN_IMG} 
            <script><!-- 

	if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 && navigator.userAgent.indexOf('6.') == -1 )
		document.write(' {ICQ_IMG}');
	else
		document.write('</td><td>&nbsp;</td><td valign="top" nowrap="nowrap"><div style="position:relative"><div style="position:absolute">{ICQ_IMG}</div><div style="position:absolute;left:3px;top:-1px">{ICQ_STATUS_IMG}</div></div>');
				
				//--></script> <noscript>
            {ICQ_IMG}</noscript></td>
        </tr>
      </table></td>
  </tr>
</table>
