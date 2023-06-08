<!-- INCLUDE pa_header.tpl -->
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
	<td align="left" valign="bottom"><span class="maintitle">{L_SEARCH_MATCHES}</span><br /></td>
  </tr>
</table>

<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom">
		<span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a href="{U_DOWNLOAD}" class="nav">{DOWNLOAD}</a> -> {L_SEARCH}</span>
	</td>
  </tr>
</table>

<table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif"width="8" height="23" border="0" alt=""></td> 
   <td width="100%" background="templates/PowerMetal/images/blk_tm.gif"><img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
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
<table width="100%" border="0" cellspacing="0" cellpadding="10">
<tr>
<td bgcolor="#484848">
<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr> 
	<th width="4%" height="25" class="thCornerL" nowrap="nowrap">&nbsp;</th>
	<th class="thTop" nowrap="nowrap">&nbsp;{L_CATEGORY}&nbsp;</th>
	<th class="thTop" nowrap="nowrap">&nbsp;{L_FILE}&nbsp;</th>
	<th class="thTop" nowrap="nowrap">&nbsp;{L_SUBMITER}&nbsp;</th>
	<th class="thTop" nowrap="nowrap">&nbsp;{L_DATE}&nbsp;</th>
	<th class="thTop" nowrap="nowrap">&nbsp;{L_DOWNLOADS}&nbsp;</th>
	<th class="thCornerR" nowrap="nowrap">&nbsp;{L_RATE}&nbsp;</th>
  </tr>

 <!-- BEGIN searchresults -->
  <tr> 
	<td class="row1" align="center" valign="middle"><a href="{searchresults.U_FILE}" class="topictitle">{searchresults.PIN_IMAGE}</a></td>
	<td class="row1"><span class="forumlink"><a href="{searchresults.U_CAT}" class="forumlink">{searchresults.CAT_NAME}</a></span></td>
	<td class="row1" valign="middle"><a href="{searchresults.U_FILE}" class="topictitle">{searchresults.FILE_NAME}</a>&nbsp;<!-- IF searchresults.IS_NEW_FILE --><img src="{searchresults.FILE_NEW_IMAGE}" border="0" alt="{L_NEW_FILE}"><!-- ENDIF --><br><span class="genmed">{searchresults.FILE_DESC}</span></td>
	<td class="row1" align="center" valign="middle"><span class="name">{searchresults.FILE_SUBMITER}</span></td>
	<td class="row2" align="center" valign="middle"><span class="postdetails">{searchresults.DATE}</span></td>
	<td class="row1" align="center" valign="middle"><span class="postdetails">{searchresults.DOWNLOADS}</span></td>
	<td class="row2" align="center" valign="middle" nowrap="nowrap"><span class="postdetails">{searchresults.RATING}</span></td>
  </tr> 
 <!-- END searchresults -->
  <tr> 
	<td class="cat" colspan="7">&nbsp;</td>
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
<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr> 
	<td align="left" valign="top"><span class="nav">{PAGE_NUMBER}</span></td>
	<td align="right" valign="top" nowrap="nowrap"><span class="nav">{PAGINATION}</span></td>
  </tr>
</table>
<!-- INCLUDE pa_footer.tpl -->