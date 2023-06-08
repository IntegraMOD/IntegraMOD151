<form action="{S_POST_ACTION}" method="post" name="post">
  {ERROR_BOX} 
  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr> 
		<td align="left" class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEPARATOR}{L_POINTS_TITLE}</td>
	</tr>
  </table>
<table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif"width="8" height="23" border="0" alt=""></td> 
   <td align="center" width="100%" background="templates/PowerMetal/images/blk_tm.gif"><strong>{L_POINTS_TITLE}<strong><img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
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


  <table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr> 
	  <th class="th" colspan="2"></th>
	</tr>
	<!-- BEGIN switch_points_cp -->
	<tr> 
	  <td class="row1"><span class="gen">{L_USERNAME}:</span></td>
	  <td class="row2"><span class="genmed"> 
		<input type="text"  class="post" name="username" maxlength="25" size="25" tabindex="1" value="{USERNAME}" />
		&nbsp; 
		<input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="liteoption" onClick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" />
		</span></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_MASS_EDIT}:</span><br />
		<span class="gensmall">{L_MASS_EDIT_EXPLAIN}</span></td>
	  <td class="row2"><span class="genmed"><textarea name="mass_username" rows="5" cols="50"></textarea></span></td>
	</tr>
	<td class="row1"><span class="gen">{L_METHOD}:</span><br />
	  <span class="gensmall">{L_ADD_SUBTRACT}</span></td>
	<td class="row2"><span class="gensmall"> 
	  <input type="radio" name="method" value="1" checked />
	  {L_ADD}&nbsp;&nbsp; 
	  <input type="radio" name="method" value="0" />
	  {L_SUBTRACT}</span></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_AMOUNT}:</span><br />
		<span class="gensmall">{L_AMOUNT_GIVE_TAKE}</span> </td>
	  <td class="row2"> 
		<input type="text" name="amount" maxlength="11" value="0" size="11">
	  </td>
	</tr>
	<!-- END switch_points_cp -->
	<!-- BEGIN switch_points_donate -->
	<tr> 
	  <td class="row1"><span class="gen">{L_USERNAME}:</span><br />
		<span class="gensmall">{L_DONATE_TO}</span></td>
	  <td class="row2"><span class="genmed"> 
		<input type="text"  class="post" name="username" maxlength="25" size="25" tabindex="1" value="{USERNAME}" />
		&nbsp; 
		<input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="liteoption" onClick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" />
		</span></td>
	</tr>
	<tr> 
	  <td class="row1"><span class="gen">{L_AMOUNT}:</span><br />
		<span class="gensmall">{L_AMOUNT_GIVE}</span> </td>
	  <td class="row2"> 
		<input type="text" name="amount" maxlength="11" value="0" size="11">
	  </td>
	</tr>
	<!-- END switch_points_donate -->
	<tr> 
	  <td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS} 
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
		&nbsp;&nbsp; 
		<input type="reset" value="{L_RESET}" class="liteoption" />
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
</form>
<br clear="all" />