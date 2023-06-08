<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td class="nav">
			<span class="nav">
				<a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEP}
				<a class="nav" href="{U_ALBUM}">{L_ALBUM}</a>
			</span>
		</td>
    </tr>
</table>
<table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif" WIDTH=8 HEIGHT=23 border="0" alt=""></td> 
   <td width="100%" background="templates/PowerMetal/images/blk_tm.gif"><img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""><span class="genmed2"><center><a href="{U_ALBUM}">{L_ALBUM}</a></center></td>
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
<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td align="right" nowrap="nowrap">
			<span class="gensmall">
				<form name="search" action="{U_ALBUM_SEARCH}">
					{L_SEARCH}:&nbsp;
					<select name="mode">
						<option value="user">{L_USERNAME}</option>
						<option value="name">{L_PIC_NAME}</option>
						<option value="desc">{L_DESCRIPTION}</option>
					</select>
					{L_SEARCH_CONTENTS}
					<input type="text" name="search" maxlength="20">
					&nbsp;&nbsp;
					<input class="liteoption" type="submit" value="{L_GO}">
				</form>
			</span>
		</td>
	</tr>
</table>

{ALBUM_BOARD_INDEX}

<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr>
		<th width="100%" height="25" nowrap="nowrap" class="thCornerL">&nbsp;{L_USERS_PERSONAL_GALLERIES}&nbsp;</th>
		<th class="thTop" nowrap="nowrap">&nbsp;{L_JOINED}&nbsp;</th>
		<th class="thCornerR" nowrap="nowrap">&nbsp;{L_PICS}&nbsp;</th>
	</tr>
	<!-- BEGIN memberrow -->
	<tr>
		<td height="28" class="{memberrow.ROW_CLASS}">&nbsp;<span class="gen"><a href="{memberrow.U_VIEWGALLERY}" class="gen">{memberrow.USERNAME}</a></span></td>
		<td class="{memberrow.ROW_CLASS}" align="center" nowrap="nowrap"><span class="gensmall">&nbsp;{memberrow.JOINED}&nbsp;</span></td>
		<td class="{memberrow.ROW_CLASS}" align="center"><span class="gensmall">{memberrow.PICS}</span></td>
	</tr>
	<!-- END memberrow -->
	<tr>
		<td class="catBottom" colspan="3" align="center"h>
		<form method="post" action="{S_MODE_ACTION}">
			<span class="gensmall">
				{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{L_ORDER}:&nbsp;{S_ORDER_SELECT}&nbsp;&nbsp;
				<input type="submit" name="submit" value="{L_SORT}" class="liteoption" />
			</span>
		</form>
		</td>
	</tr>
</table>

<table width="98%" align="center" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td><span class="nav">{PAGE_NUMBER}</span></td>
		<td align="right"><span class="gensmall">{S_TIMEZONE}</span><br /><span class="nav">{PAGINATION}</span></td>
	</tr>
</table>
<br />
<!-- You must keep my copyright notice visible with its original content -->
{ALBUM_COPYRIGHT}

    </td>
    <td background="templates/PowerMetal/images/right.gif"><img name="right" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
   <td><img name="blc" src="templates/PowerMetal/images/blc.gif" width="8" height="8" border="0" alt=""></td>
    <td background="templates/PowerMetal/images/btm.gif"><img name="btm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="brc" src="templates/PowerMetal/images/brc.gif" width="8" height="8" border="0" alt=""></td>
  </tr></table>