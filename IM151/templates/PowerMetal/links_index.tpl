<script language="JavaScript" type="text/javascript">
<!--
function checkForm() {
	formErrors = false;    

	if (document.linkdata.link_title.value == '') {
		formErrors = '{L_LINK_TITLE}';	
	} else if (document.linkdata.link_url.value == 'http://') {
		formErrors = '{L_LINK_URL}';	
	} else if (document.linkdata.link_logo_src.value == 'http://' ) {
		formErrors = '{L_LINK_LOGO_SRC}';	
	} else if (document.linkdata.link_category.value == '' ) {
		formErrors = '{L_LINK_CATEGORY}';	
	} else if (document.linkdata.link_desc.value == '' ) {
		formErrors = '{L_LINK_DESC}';	
	}

	if (formErrors) {
		alert('{L_PLEASE_ENTER_YOUR}' + formErrors);
		return false;
	} 
	
	return true;
}
//-->
</script>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr> 
	  <!-- td align="left" class="nav"><a href="{U_INDEX}">{L_INDEX}</a> &raquo; <a href="{U_SITE_LINKS}">{L_SITE_LINKS}</a></td -->
	  <td align="right" style="font-weight: bold;font-size: 11px; color: orange">&#149;&nbsp;<a href="{U_SITE_SEARCH}">{L_SEARCH_SITE}</a>&nbsp;&nbsp;&#149;&nbsp;<a href="{U_SITE_TOP}">{L_DESCEND_BY_HITS}</a>&nbsp;&nbsp;&#149;&nbsp;<a href="{U_SITE_NEW}">{L_DESCEND_BY_JOINDATE}</a>
	  </td>
	</tr>
</table>
<table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif"width="8" height="23" border="0" alt=""></td> 
   <td align="center" width="100%" background="templates/PowerMetal/images/blk_tm.gif"><strong>{L_PAGE_NAME}<strong><img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
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

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
	  <td width="10%" nowrap="nowrap" valign="top">
		<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
			<tr>
			  <th class="thHead" align="left" nowrap="nowrap">{L_LINK_US}</th>
			</tr>
			<tr> 
			  <td class="row1">
			  	<br /><span class="gensmall"><center><img src="{U_SITE_LOGO}" border="0" alt="{SITENAME}" /></center><br />
			  	{L_LINK_US_EXPLAIN}</span><br />
			  	<table width="100%" cellspacing="1" cellpadding="4" border="0" align="center" >
				  <tr> 
					<td class="gensmall" ><textarea cols="15" rows="2" class="post" style="width:160px" readonly="1">{LINK_US_SYNTAX}</textarea></td>
				  </tr>
				</table>
			  </td>
			</tr>
		</table><br />
		<!-- BEGIN lock -->
		<!-- BEGIN logout -->
		<table border="0" cellpadding="0" cellspacing="1" width="100%" class="forumline">
		  <tr> 
			<th class="thHead" align="left">&nbsp;{L_LOGIN}</th>
		  </tr>
		<tr><td class="row1">
		<form method="post" action="{S_LOGIN_ACTION}">
		<table border="0" cellpadding="2" cellspacing="0" width="100%">
		<tr>
			<td class="row1">
			  <span class="gensmall">{L_LINK_REGISTER_GUEST_RULE}</span>
			</td>
		  </tr>
		  <tr>
			<td class="row1">
			  <span class="gensmall">{L_USERNAME}:</span><br /><input type="text" name="username" size="24" maxlength="40" value="" />
			</td>
		  </tr>
		  <tr>
			<td class="row1">
			  <span class="gensmall">{L_PASSWORD}:<br /><input type="password" name="password" size="24" maxlength="32" />
			</td>
		  </tr>
		  <tr> 
			<td class="row1"><span class="gensmall">{L_AUTO_LOGIN}: <input type="checkbox" name="autologin" /></span></td>
		  </tr>
		  <tr>
			<td class="row1" align="center"><input type="hidden" name="redirect" value="{U_SITE_LINKS}" /><input type="submit" name="login" class="mainoption" value="{L_LOGIN}" /><br /><br /><span class="gensmall"><a href="{U_REGISTER}">{L_REGISTER}</a></span></td>
		  </tr>
		</table></form>
		</td></tr>
		</table>
		<!-- END logout -->
		
		<!-- BEGIN submit -->
		<table border="0" cellpadding="0" cellspacing="1" width="100%" class="forumline">
		  <tr> 
			<th class="thHead" align="left">&nbsp;{L_LINK_REGISTER}</th>
		  </tr>
		<form name="linkdata" method="post" action="{U_LINK_REG}">
		<tr><td class="row1">
		<table border="0" cellpadding="2" cellspacing="0" width="100%">
			<tr> 
			  <td class="row1"><span class="gensmall">
			  {L_LINK_REGISTER_RULE}
			  </span></td>
			</tr>			
			<tr> 
			  <td class="row1"><br /><span class="gensmall">{L_LINK_TITLE}</span><br /><input type="text" name="link_title" value="" size="15" maxlength="20" class="post" style="width:160px"></td>
			</tr>
			<tr> 
			  <td class="row1"><span class="gensmall">{L_LINK_URL}</span><br /><input type="text" name="link_url" value="http://" size="15" maxlength="100" style="width:160px" class="post"></td>
			</tr>
			<tr> 
			  <td class="row1"><span class="gensmall">{L_LINK_LOGO_SRC}</span><br /><input type="text" size="15" maxlength="120" style="width:160px" name="link_logo_src" value="http://"><br /><span class="gensmall">[<a href="javascript: void(0)" onclick="var img_src=document.linkdata.link_logo_src.value;if(img_src=='http://' || img_src=='') img_src='images/links/no_logo88a.gif';_preview=window.open(img_src, '_preview', 'toolbar=no,width=200,height=100,top=300,left=300');">{L_PREVIEW}</a>]</span><br /><br /></td>
			</tr>
			<tr> 
			  <td class="row1">
			  	<span class="gensmall">{L_LINK_CATEGORY}</span><br />
				<select name="link_category" style="width:160px">
				  <option value="" selected>----------------</option>{LINK_CAT_OPTION}
				</select>
			  </td>
			</tr>
			<tr> 
			  <td class="row1"><span class="gensmall">{L_LINK_DESC}</span><br /><textarea name="link_desc" cols="15" rows="4" class="post" style="width:160px" maxsize="120" wrap="VIRTUAL"></textarea></td>
			</tr>
			
		</table>
		</td></tr>
		<tr> 
		  <td class="cat" align="center"><input type="submit" name="addlink" value="{L_SUBMIT}" class="liteoption"></td>
		</tr>
		</form>
		</table>
		<!-- END submit -->
		<!-- END lock -->
	  </td>
	  <td width="10" nowrap="nowrap">&nbsp;</td>
	  <td width="100%" nowrap="nowrap" valign="top">
		<table border="0" cellpadding="2" cellspacing="1" width="100%" class="forumline">
		<tr>
			  <th class="thHead" align="left" colspan="2">&nbsp;{L_LINK_CATEGORY}</th>
		</tr>
		<tr><td class="row1">
		<table border="0" cellpadding="3" cellspacing="0" width="100%">
			<tr>
				<td valign="top" width="50%" nowrap="nowrap" class="postbody">
				<!-- BEGIN linkrow1 -->
				<br />&nbsp;<a href="{linkrow1.LINK_URL}"><img src="{FOLDER_IMG}" alt="{linkrow1.LINK_TITLE}" align="absmiddle" border="0" /></a>&nbsp;<a href="{linkrow1.LINK_URL}">{linkrow1.LINK_TITLE}</a>&nbsp;({linkrow1.LINK_NUMBER})
				<br />
				<!-- END linkrow1 -->
				<br />
				</td>
				<td valign="top" width="50%" nowrap="nowrap" class="postbody">
				<!-- BEGIN linkrow0 -->
				<br />&nbsp;<a href="{linkrow0.LINK_URL}"><img src="{FOLDER_IMG}" alt="{linkrow0.LINK_TITLE}" align="absmiddle" border="0" /></a>&nbsp;<a href="{linkrow0.LINK_URL}">{linkrow0.LINK_TITLE}</a>&nbsp;({linkrow0.LINK_NUMBER})
				<br />
				<!-- END linkrow0 -->
				<br />
				</td>
			</tr>
		</table>
		</td></tr></table><br />
		<div align="center" style="font-family: Verdana; font-size: 10px; letter-spacing: -1px">Links MOD v1.2.2 by <a href="http://www.phpbb2.de" target="_blank">phpBB2.de</a> and OOHOO and <a href="http://mail.dhjh.tcc.edu.tw/~gzqbyr/" target="_gzqbyr">CRLin</a>.</div>
	  </td>
	</tr> 
</table>
    </td>
    <td background="templates/PowerMetal/images/right.gif"><img name="right" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
   <td><img name="blc" src="templates/PowerMetal/images/blc.gif" width="8" height="8" border="0" alt=""></td>
    <td background="templates/PowerMetal/images/btm.gif"><img name="btm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="brc" src="templates/PowerMetal/images/brc.gif" width="8" height="8" border="0" alt=""></td>
  </tr></table>