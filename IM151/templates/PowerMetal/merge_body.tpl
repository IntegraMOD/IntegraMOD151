<form name="post" action="{S_ACTION}" method="post">
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr> 
	<td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_CAT_DESC}</span></td>
</tr>
</table>
<table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif"width="8" height="23" border="0" alt=""></td> 
   <td align="center" width="100%" background="templates/PowerMetal/images/blk_tm.gif"><strong>L_TITLE}<strong><img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
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


<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
<tr>
	<td class="row1"><span class="gen">{L_TOPIC_TITLE}<br /></span><span class="gensmall">{L_TOPIC_TITLE_EXPLAIN}</span></td>
	<td class="row2">
		<span class="gen">
			<input type="text" class="post" name="topic_title" size="50" maxlength="60" value="{TOPIC_TITLE}" />
		</span>
	</td>
</tr>
<tr>
	<td class="row1" width="50%"><span class="gen">{L_FROM_TOPIC}<br /></span><span class="gensmall">{L_FROM_TOPIC_EXPLAIN}</span></td>
	<td class="row2" width="50%">
		<span class="gen">
			<input type="text" class="post" name="from_topic" size="50" maxlength="60" value="{FROM_TOPIC}" />
			<input type="submit" class="liteoption" name="select_from" value="{L_SEARCH}" />
		</span>
	</td>
</tr>
<tr>
	<td class="row1" width="50%"><span class="gen">{L_TO_TOPIC}<br /></span><span class="gensmall">{L_TO_TOPIC_EXPLAIN}</span></td>
	<td class="row2" width="50%">
		<span class="gen">
			<input type="text" class="post" name="to_topic" size="50" maxlength="60" value="{TO_TOPIC}" />
			<input type="submit" class="liteoption" name="select_to" value="{L_SEARCH}" />
		</span>
	</td>
</tr>
<tr>
	<td class="row1" width="50%"><span class="gen">{L_SHADOW}</span></td>
	<td class="row2" width="50%"><span class="gen"><input type="checkbox" name="shadow"{SHADOW} /></span></td>
</tr>
<tr>
	<td class="cat" colspan="2" align="center" height="28">
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
		<input type="submit" name="refresh" value="{L_REFRESH}" class="liteoption" />
		{S_HIDDEN_FIELDS}
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