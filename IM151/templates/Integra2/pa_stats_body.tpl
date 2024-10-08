<!-- INCLUDE pa_header.tpl -->
<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom">
	  <span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a href="{U_DOWNLOAD}" class="nav">{DOWNLOAD}</a> -> {L_STATISTICS}</span>
	</td>
  </tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr> 
	<th colspan="2" class="thHead">{L_STATISTICS}</th>
  </tr>
  <tr> 
	<td colspan="2" class="cat" align="center"><span class="cattitle">{L_GENERAL_INFO}</span></td>
  </tr>  
  <tr>
	<td colspan="2" class="row1"><span class="genmed">{STATS_TEXT}</span></td>
  </tr>
  <tr> 
	<td class="cat" width="50%" align="center"><span class="cattitle">{L_DOWNLOADS_STATS}</span></td>
	<td class="cat" width="50%" align="center"><span class="cattitle">{L_RATING_STATS}</span></td>
  </tr>  
  <tr> 
	<td class="row2" colspan="2" align="center"><span class="genmed">{L_OS}</span></td>
  </tr>    
  <tr>
	<!-- BEGIN downloads_os -->
	<td class="row1" align="center">
	  <table cellspacing="0" cellpadding="2" border="0">

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
	  </table>	
	</td>
	<!-- END downloads_os -->
	<!-- BEGIN rating_os -->
	<td class="row1" align="center">
	  <table cellspacing="0" cellpadding="2" border="0">
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
	  </table>		
	</td>
	<!-- END rating_os -->
  </tr>
  <tr> 
	<td class="row2" colspan="2" align="center"><span class="genmed">{L_BROWSERS}</span></td>
  </tr>

  <tr> 
	<!-- BEGIN downloads_b -->
	<td class="row1" align="center">
	  <table cellspacing="0" cellpadding="2" border="0">
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
	  </table>	
	</td>
	<!-- END downloads_b -->
	<!-- BEGIN rating_b -->
	<td class="row1" align="center">
	  <table cellspacing="0" cellpadding="2" border="0">
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
	  </table>		
	</td>
	<!-- END rating_b -->
  </tr>  
    
  <tr> 
	<td colspan="2" class="cat" height="28">&nbsp;</td>
  </tr>
</table>
<!-- INCLUDE pa_footer.tpl -->