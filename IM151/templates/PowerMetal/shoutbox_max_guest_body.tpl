<table width="100%" cellspacing="0" cellpadding="2" border="0" align="center"><tr> 
<td align="left" valign="bottom"><span class="gensmall"> 
<!-- BEGIN switch_user_logged_in -->
{LAST_VISIT_DATE}<br />
<!-- END switch_user_logged_in -->
{CURRENT_TIME}<br />
</span><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
</tr>

</table>
<table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif"width="8" height="23" border="0" alt=""></td> 
   <td align="center" width="100%" background="templates/PowerMetal/images/blk_tm.gif"><strong>{L_SHOUTBOX}<strong><img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
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
<br />

<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" class="forumline">
<form action="{U_SHOUTBOX}" method="post" name="post" onsubmit="return checkForm(this)">
	<tr> 
	  <td class="catBottom" colspan="2" align="center" height="28"> {S_HIDDEN_FORM_FIELDS}
<input type="submit" tabindex="1" name="refresh" class="mainoption" value="{L_SHOUT_REFRESH}" />&nbsp;
</td>
	</tr>

</table>
</form>

  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
	<tr> 
	   <td align="right" valign="bottom" class="gensmall"> 
<span class="nav">
	{PAGINATION}</span>
</td>
	</tr>
</table>
<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
	<tr align="right">
		<td class="catHead" colspan="2" height="28" align="center"><b>&nbsp;{L_SHOUTBOX}&nbsp;<b/></td>
	</tr>
	<tr>
		<th class="thLeft" width="160" height="26" nowrap="nowrap">{L_AUTHOR}</th>
		<th class="thRight" nowrap="nowrap">{L_MESSAGE}</th>
	</tr>

	<!-- BEGIN shoutrow -->
	<tr> 
		<td width="160" align="left" valign="top" class="{shoutrow.ROW_CLASS}">
			<span class="name"><b>{shoutrow.SHOUT_USERNAME}</b></span><br />
			<span class="postdetails">{shoutrow.USER_RANK}<br />
			{shoutrow.RANK_IMAGE}<br/>
			{shoutrow.USER_AVATAR}<br /><br/>{shoutrow.USER_JOINED}</span></td>
		<td class="{shoutrow.ROW_CLASS}" width="100%" height="28" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100%"><a href="{shoutrow.U_MINI_POST}"><img src="{shoutrow.MINI_POST_IMG}" width="12" height="9" alt="{shoutrow.L_MINI_POST_ALT}" title="{shoutrow.L_MINI_POST_ALT}" border="0" /></a><span class="postdetails">{L_POSTED}: {shoutrow.TIME}</span></td>
				<td valign="top" align="right" nowrap="nowrap">{shoutrow.QUOTE_IMG}{shoutrow.EDIT_IMG}{shoutrow.DELETE_IMG}{shoutrow.IP_IMG}</td></form>
			</tr>
			<tr> 
				<td colspan="2"><hr/></td>
			</tr>
			<tr>
				<td colspan="2"><span class="postbody">{shoutrow.SHOUT}{shoutrow.SIGNATURE}</span></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr> 
		<td class="spaceRow" colspan="2" height="1"><img src="images/spacer.gif" alt="" width="1" height="1" /></td>
	</tr>
	<!-- END shoutrow -->

</table>
  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
	<tr> 
	  <td align="left" valign="top"><span class="gensmall">{S_TIMEZONE}</span></td>
	  <td align="right" valign="bottom" class="gensmall"> 
<span class="nav">
	{PAGINATION}</span>
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