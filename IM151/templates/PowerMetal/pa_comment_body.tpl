
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
	<th class="thCornerL">{L_AUTHOR}</th>
	<th class="thCornerR">{L_COMMENTS}</th>
  </tr>
<!-- IF NO_COMMENTS -->
  <tr>
	<td colspan="2" class="row1" align="center"><span class="genmed">{L_NO_COMMENTS}</span></td>
  </tr>
<!-- ENDIF -->
<!-- BEGIN text -->
  <tr>
	<td width="150" align="left" valign="top" class="row1"><span class="name"><b>{text.POSTER}</b></span><br /><span class="postdetails">{text.POSTER_RANK}<br />{text.RANK_IMAGE}{text.POSTER_AVATAR}<br /><br />{text.POSTER_JOINED}<br />{text.POSTER_POSTS}<br />{text.POSTER_FROM}</span><br />&nbsp;</td>
	<td class="row1" height="28" valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100%" valign="middle"><span class="postdetails"><img src="{text.ICON_MINIPOST_IMG}" width="12" height="9" border="0" />{L_POSTED}: {text.TIME}<span class="gen">&nbsp;</span>&nbsp; &nbsp;{L_COMMENT_SUBJECT}: {text.TITLE}</span></td>
				<td align="right">
				<!-- IF text.AUTH_COMMENT_DELETE -->
				<a href="{text.U_COMMENT_DELETE}"><img src="{text.DELETE_IMG}" alt="{L_COMMENT_DELETE}" title="{L_COMMENT_DELETE}" border="0"></a>
				<!-- ENDIF -->
				</td>
			</tr>
			<tr> 
				<td colspan="2"><hr /></td>
			</tr>
			<tr>
				<td colspan="2"valign="top"><span class="postbody">{text.TEXT}</span></td>
			</tr>
		</table>
	</td>
  </tr>
  <tr>
	<td class="row1" width="150" align="left" valign="middle"><span class="nav"><a href="#top" class="nav">{L_BACK_TO_TOP}</a></span></td>
	<td class="row1"></td>
  </tr>
  <tr> 
	<td class="spaceRow" colspan="2" height="1"><img src="{text.ICON_SPACER}" alt="" width="1" height="1" /></td>
  </tr>
<!-- END text -->
  <tr>
	<td colspan="2" class="cat">&nbsp;</td>
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
<!-- IF AUTH_POST -->
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr>
	<td align="center"><a href="{U_COMMENT_DO}"><img src="{REPLY_IMG}" border="0" alt="{L_COMMENT_ADD}" align="middle" /></a></td>
  </tr>
</table>
<blockquote>
  <p><br clear="all" />
    <!-- ENDIF -->
    

    

  </p>
</blockquote>
