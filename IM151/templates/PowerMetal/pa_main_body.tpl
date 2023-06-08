<!-- INCLUDE pa_header.tpl -->
<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom">
		<span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a href="{U_DOWNLOAD}" class="nav">{DOWNLOAD}</a></span>
	</td>
  </tr>
</table>

<table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif" WIDTH=8 HEIGHT=23 border="0" alt=""></td> 
   <td width="100%" background="templates/PowerMetal/images/blk_tm.gif"><img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="blkr" src="templates/PowerMetal/images/blk_trc.gif" WIDTH=77 HEIGHT=23 border="0" alt=""></td>
  </tr>
  	</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="tlc" src="templates/PowerMetal/images/tlc.gif" WIDTH=8 HEIGHT=6 border="0" alt=""></td> 
   <td width="100%" background="templates/PowerMetal/images/tm.gif"><img name="tm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="trc" src="templates/PowerMetal/images/trc.gif" WIDTH=8 HEIGHT=6 border="0" alt=""></td>
  </tr>
  <tr>
    <td background="templates/PowerMetal/images/left.gif"><img name="left" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
        <td valign="top" bgcolor="#484848">
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr>
	<th class="thCornerL" width="6%">&nbsp;</th>
	<th class="thTop">{L_CATEGORY}</th>
	<th class="thCornerR" width="10%">{L_LAST_FILE}</th>	
	<th class="thCornerR" width="8%">{L_FILES}</th>
  </tr>
<!-- BEGIN no_cat_parent -->
	<!-- IF no_cat_parent.IS_HIGHER_CAT -->
<tr>
	<td class="cat" colspan="2" valign="middle"><a href="{no_cat_parent.U_CAT}" class="cattitle">{no_cat_parent.CAT_NAME}</a></td>
	<td class="rowpic" colspan="2" align="right">&nbsp;</td>
</tr>
	<!-- ELSE -->
<tr>
	<td class="row1" valign="middle" align="center"><a href="{no_cat_parent.U_CAT}" class="cattitle"><img src="{no_cat_parent.CAT_IMAGE}" border="0" alt="{no_cat_parent.CAT_NEW_FILE}"></a></td>
	<td class="row1" valign="middle"><a href="{no_cat_parent.U_CAT}" class="cattitle">{no_cat_parent.CAT_NAME}</a><br><span class="genmed">{no_cat_parent.CAT_DESC}</span><br><span class="gensmall"><b>{L_SUB_CAT}:</b> </span><span class="gensmall">{no_cat_parent.SUB_CAT}</span></b></td>
	<td class="row2" align="center" valign="middle" nowrap="nowrap"><span class="genmed">{no_cat_parent.LAST_FILE}</span></td>
	<td class="row2" align="center" valign="middle"><span class="genmed">{no_cat_parent.FILECAT}</span></td>
</tr>
	<!-- ENDIF -->
<!-- END no_cat_parent -->

  <tr> 
	<td class="cat" colspan="4">&nbsp;</td>
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