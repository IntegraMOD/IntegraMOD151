<!-- INCLUDE pa_header.tpl -->
<form action="{S_SEARCH_ACTION}" method="post">
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
	<th class="thHead" colspan="2">{L_SEARCH}</th>
  </tr>
	<tr> 
		<td class="row1" width="50%"><span class="gen">{L_SEARCH_KEYWORDS}:</span><br /><span class="gensmall">{L_SEARCH_KEYWORDS_EXPLAIN}</span></td>
		<td class="row2" valign="top"><span class="genmed"><input type="text" style="width: 300px" class="post" name="search_keywords" size="30" /><br /><input type="radio" name="search_terms" value="any" checked="checked" /> {L_SEARCH_ANY_TERMS}<br /><input type="radio" name="search_terms" value="all" /> {L_SEARCH_ALL_TERMS}</span></td>
	</tr>
	<tr> 
		<td class="row1"><span class="gen">{L_SEARCH_AUTHOR}:</span><br /><span class="gensmall">{L_SEARCH_AUTHOR_EXPLAIN}</span></td>
		<td class="row2" valign="middle"><span class="genmed"><input type="text" style="width: 300px" class="post" name="search_author" size="30" /></span></td>
	</tr>
	<tr> 
		<th class="thHead" colspan="2" height="25">{L_SEARCH_OPTIONS}</th>
	</tr>
  <tr> 
	<td class="row1" width="50%"><span class="genmed">{L_CHOOSE_CAT}&nbsp; </span></td>
	<td class="row2"><select name="cat_id" class="forminput"><option value="0" selected>{L_ALL}</option>{S_CAT_MENU}</select></td>
  </tr>
  <tr> 
	<td class="row1" width="50%"><span class="genmed">{L_INCLUDE_COMMENTS}:&nbsp; </span></td>
	<td class="row2"><span class="genmed"><input type="radio" name="comments_search" value="YES" checked="checked" /> {L_YES} <input type="radio" name="comments_search" value="NO" /> {L_NO}</span></td>
  </tr>
  <tr>
	<td class="row1"><span class="genmed">{L_SORT_BY}:&nbsp;</span></td>
	<td class="row2" valign="middle" nowrap="nowrap"><span class="genmed">
	<select class="post" name="sort_method">
		<option value='file_name'>{L_NAME}</option>
		<option selected="selected" value='file_time'>{L_DATE}</option>
		<option value='file_rating'>{L_RATING}</option>
		<option value='file_dls'>{L_DOWNLOADS}</option>
		<option value='file_update_time'>{L_UPDATE_TIME}</option>
	</select></span>&nbsp;</td>
  </tr>
  <tr>
	<td class="row1"><span class="genmed">{L_SORT_DIR}:&nbsp;</span></td>
	<td class="row2" valign="middle" nowrap="nowrap"><span class="genmed"><input type="radio" name="sort_order" value="ASC" /> {L_SORT_ASCENDING} <input type="radio" name="sort_order" value="DESC" checked /> {L_SORT_DESCENDING}</span>&nbsp;</td>
  </tr>  
  <tr>   
	<td class="cat" align="center" colspan="2"><input type="hidden" name="action" value="search"><input class="liteoption" type="submit" name="submit" value="{L_SEARCH}"></td>
  </tr>
</form>
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
<!-- INCLUDE pa_footer.tpl -->