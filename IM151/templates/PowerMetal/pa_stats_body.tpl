<!-- INCLUDE pa_header.tpl -->
<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom">
		<span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a href="{U_DOWNLOAD}" class="nav">{DOWNLOAD}</a> -> {L_STATISTICS}</span>
	</td>
  </tr>
</table>

<table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif" WIDTH=8 HEIGHT=23 border="0" alt=""></td> 
   <td width="100%" background="templates/PowerMetal/images/blk_tm.gif"><img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""><span class="genmed2"><center>{L_STATISTICS}</center></td>
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
<table width="100%" border="0" cellspacing="0" cellpadding="10">
<tr>
<td bgcolor="#484848">
<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr> 
	<td colspan="2" class="cat" align="center"><span class="cattitle">{L_GENERAL_INFO}</span></td>
  </tr>  
  <tr>
	<td colspan="2" class="row1"><center><span class="genmed">{STATS_TEXT}</span></center></td>
  </tr>
  <tr> 
	<td class="cat" width="50%" align="center"><span class="cattitle">{L_DOWNLOADS_STATS}</span></td>
	<td class="cat" width="50%" align="center"><span class="cattitle">{L_RATING_STATS}</span></td>
  </tr>  
  <tr> 
	<td class="row2" colspan="2" align="center"><span class="genmed">{L_OS}</span></td>
  </tr>    
  <tr> 
	<td class="row1" align="center">
		  <table cellspacing="0" cellpadding="2" border="0">
			<!-- BEGIN downloads_os -->
			<tr> 
			  <td><img src="{downloads_os.OS_IMG}" alt="" />&nbsp;<span class="gen">{downloads_os.OS_NAME}</span></td>
			  <td> 
				<table cellspacing="0" cellpadding="0" border="0">
				  <tr> 
					<td><img src="{U_VOTE_LCAP}" width="4" alt="" height="12" /></td>
					<td><img src="{downloads_os.OS_OPTION_IMG}" width="{downloads_os.OS_OPTION_IMG_WIDTH}" height="12" alt="{downloads_os.OS_OPTION_RESULT}" /></td>
					<td><img src="{U_VOTE_RCAP}" width="4" alt="" height="12" /></td>
				  </tr>
				</table>
			  </td>
			  <td align="center"><span class="gen">[ {downloads_os.OS_OPTION_RESULT} ]</span></td>
			</tr>
			<!-- END downloads_os -->
		  </table>	
	</td>
	<td class="row1" align="center">
		<table cellspacing="0" cellpadding="2" border="0">
			<!-- BEGIN rating_os -->
			<tr> 
			  <td><img src="{rating_os.OS_IMG}" alt="" />&nbsp;<span class="gen">{rating_os.OS_NAME}</span></td>
			  <td> 
				<table cellspacing="0" cellpadding="0" border="0">
				  <tr> 
					<td><img src="{U_VOTE_LCAP}" width="4" alt="" height="12" /></td>
					<td><img src="{rating_os.OS_OPTION_IMG}" width="{rating_os.OS_OPTION_IMG_WIDTH}" height="12" alt="{rating_os.OS_OPTION_RESULT}" /></td>
					<td><img src="{U_VOTE_RCAP}" width="4" alt="" height="12" /></td>
				  </tr>
				</table>
			  </td>
			  <td align="center"><span class="gen">[ {rating_os.OS_OPTION_RESULT} ]</span></td>
			</tr>
			<!-- END rating_os -->
		  </table>		
	</td>
  </tr>
  <tr> 
	<td class="row2" colspan="2" align="center"><span class="genmed">{L_BROWSERS}</span></td>
  </tr>

  <tr> 
	<td class="row1" align="center">
		  <table cellspacing="0" cellpadding="2" border="0">
			<!-- BEGIN downloads_b -->
			<tr> 
			  <td><img src="{downloads_b.B_IMG}" alt="" />&nbsp;<span class="gen">{downloads_b.B_NAME}</span></td>
			  <td> 
				<table cellspacing="0" cellpadding="0" border="0">
				  <tr> 
					<td><img src="{U_VOTE_LCAP}" width="4" alt="" height="12" /></td>
					<td><img src="{downloads_b.B_OPTION_IMG}" width="{downloads_b.B_OPTION_IMG_WIDTH}" height="12" alt="{downloads_b.B_OPTION_RESULT}" /></td>
					<td><img src="{U_VOTE_RCAP}" width="4" alt="" height="12" /></td>
				  </tr>
				</table>
			  </td>
			  <td align="center"><span class="gen">[ {downloads_b.B_OPTION_RESULT} ]</span></td>
			</tr>
			<!-- END downloads_b -->
		  </table>	
	</td>
	<td class="row1" align="center">
		<table cellspacing="0" cellpadding="2" border="0">
			<!-- BEGIN rating_b -->
			<tr> 
			  <td><img src="{rating_b.B_IMG}" alt="" />&nbsp;<span class="gen">{rating_b.B_NAME}</span></td>
			  <td> 
				<table cellspacing="0" cellpadding="0" border="0">
				  <tr> 
					<td><img src="{U_VOTE_LCAP}" width="4" alt="" height="12" /></td>
					<td><img src="{rating_b.B_OPTION_IMG}" width="{rating_b.B_OPTION_IMG_WIDTH}" height="12" alt="{rating_b.B_OPTION_RESULT}" /></td>
					<td><img src="{U_VOTE_RCAP}" width="4" alt="" height="12" /></td>
				  </tr>
				</table>
			  </td>
			  <td align="center"><span class="gen">[ {rating_b.B_OPTION_RESULT} ]</span></td>
			</tr>
			<!-- END rating_b -->
		  </table>		
	</td>
  </tr>  
    
  <tr> 
	<td colspan="2" class="cat" height="28">&nbsp;</td>
  </tr>
</table>
</td>
</tr>
</table></td>
    <td background="templates/PowerMetal/images/right.gif"><img name="right" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
   <td><img name="blc" src="templates/PowerMetal/images/blc.gif" WIDTH=8 HEIGHT=8 border="0" alt=""></td>
    <td background="templates/PowerMetal/images/btm.gif"><img name="btm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="brc" src="templates/PowerMetal/images/brc.gif" WIDTH=8 HEIGHT=8 border="0" alt=""></td>
  </tr></table>
<!-- INCLUDE pa_footer.tpl -->

