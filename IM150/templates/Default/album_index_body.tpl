<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td class="nav">
			<span class="nav">
				<a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEP}
				<a href="{U_ALBUM}" class="nav">{L_ALBUM}</a>
			</span>
		</td>
		<td align="right">
			<form name="search" action="{U_ALBUM_SEARCH}">
				<span class="gensmall">
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
				</span>
			</form>
		</td>
	</tr>
</table>

<!-- Album Category Hierarchy : begin -->
{ALBUM_BOARD_INDEX}

<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0"><tr><td align="right"><span class="gensmall">{S_TIMEZONE}</span></td></tr></table>

<!-- BEGIN personal_picrow -->
<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr>
		<!-- BEGIN piccol -->
		<td align="center" width="{S_COL_WIDTH}" class="row1" onMouseOver="this.className='row2';" onMouseOut="this.className='row1';">
			<table><tr><td><div class="picshadow"><div class="picframe">
				<a href="{personal_picrow.piccol.U_PIC}" {TARGET_BLANK}><img src="{personal_picrow.piccol.THUMBNAIL}" border="0" alt="{personal_picrow.piccol.DESC}" title="{personal_picrow.piccol.DESC}" vspace="10" /></a>
			</div></div></td></tr></table>
		</td>
		<!-- END piccol -->
	</tr>
	<tr>
		<!-- BEGIN pic_detail -->
		<td class="row2" align="center">
			<span class="gensmall">
				{L_PIC_TITLE}: {personal_picrow.pic_detail.TITLE}<br />
				{L_PIC_ID}: {personal_picrow.pic_detail.PIC_ID}<br />
				{L_POSTED}: {personal_picrow.pic_detail.TIME}<br />
				{L_VIEW}: {picrpersonal_picrowow.pic_detail.VIEW}<br />
				{personal_picrow.pic_detail.RATING}
				{personal_picrow.pic_detail.COMMENTS}
				{pipersonal_picrowcrow.pic_detail.IP}
				{personal_picrow.pic_detail.EDIT}	{personal_picrow.pic_detail.DELETE}	{personal_picrow.pic_detail.LOCK}
			</span>
		</td>
		<!-- END pic_detail -->
	</tr>
</table>
<!-- END personal_picrow -->

<!-- BEGIN recent_pics_block -->
<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr><th class="thTop" height="25" colspan="{S_COLS}" nowrap="nowrap">{L_RECENT_PUBLIC_PICS}</th></tr>
	<!-- BEGIN no_pics -->
	<tr><td class="row1" align="center" colspan="{S_COLS}" height="50"><span class="gen">{L_NO_PICS}&nbsp;</span></td></tr>
	<!-- END no_pics -->
	<!-- BEGIN recent_pics -->
	<tr>
		<!-- BEGIN recent_col -->
		<td class="row1" width="{S_COL_WIDTH}" align="center" onMouseOver="this.className='row2';" onMouseOut="this.className='row1';">
			<table><tr><td><div class="picshadow"><div class="picframe">
				<a href="{recent_pics_block.recent_pics.recent_col.U_PIC}" {TARGET_BLANK}><img src="{recent_pics_block.recent_pics.recent_col.THUMBNAIL}" {THUMB_SIZE} border="0" alt="{recent_pics_block.recent_pics.recent_col.DESC}" title="{recent_pics_block.recent_pics.recent_col.DESC}" vspace="10" /></a>
			</div></div></td></tr></table>
		</td>
		<!-- END recent_col -->
	</tr>
	<tr>
		<!-- BEGIN recent_detail -->
		<td class="row2" align="center">
			<span class="gensmall">
				{L_POSTER}: {recent_pics_block.recent_pics.recent_detail.POSTER}<br />
				{L_PIC_TITLE}: {recent_pics_block.recent_pics.recent_detail.TITLE}<br />
				{L_PIC_ID}: {recent_pics_block.recent_pics.recent_detail.PIC_ID}<br />
				{L_POSTED}: {recent_pics_block.recent_pics.recent_detail.TIME}<br />
				{L_VIEW}: {recent_pics_block.recent_pics.recent_detail.VIEW}<br />
				{recent_pics_block.recent_pics.recent_detail.RATING}
				{recent_pics_block.recent_pics.recent_detail.COMMENTS}
				{recent_pics_block.recent_pics.recent_detail.IP}
			</span>
		</td>
		<!-- END recent_detail -->
	</tr>
	<!-- END recent_pics -->
</table>
<br />
<!-- END recent_pics_block -->

<!-- BEGIN highest_pics_block -->
<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr><th height="25" colspan="{S_COLS}" nowrap="nowrap">{L_HI_RATINGS}</th></tr>
	<!-- BEGIN no_pics -->
	<tr>
		<td class="row1" align="center" colspan="{S_COLS}" height="50"><span class="gen">{L_NO_PICS}</span></td>
	</tr>
	<!-- END no_pics -->
	<!-- BEGIN highest_pics -->
	<tr>
		<!-- BEGIN highest_col -->
		<td class="row1" width="{S_COL_WIDTH}" align="center" onMouseOver="this.className='row2';" onMouseOut="this.className='row1';">
			<table><tr><td><div class="picshadow"><div class="picframe">
				<a href="{highest_pics_block.highest_pics.highest_col.U_PIC}" {TARGET_BLANK}><img src="{highest_pics_block.highest_pics.highest_col.THUMBNAIL}" {THUMB_SIZE} border="0" alt="{highest_pics_block.highest_pics.highest_col.DESC}" title="{highest_pics_block.highest_pics.highest_col.DESC}" vspace="10" /></a>
			</div></div></td></tr></table>
		</td>
		<!-- END highest_col -->
	</tr>
	<tr>
		<!-- BEGIN highest_detail -->
		<td class="row2" align="center">
			<span class="gensmall">
				{L_POSTER}: {highest_pics_block.highest_pics.highest_detail.H_POSTER}<br />
				{L_PIC_TITLE}: {highest_pics_block.highest_pics.highest_detail.H_TITLE}<br />
				{L_PIC_ID}: {highest_pics_block.highest_pics.highest_detail.PIC_ID}<br />
				{L_POSTED}: {highest_pics_block.highest_pics.highest_detail.H_TIME}<br />
				{L_VIEW}: {highest_pics_block.highest_pics.highest_detail.H_VIEW}<br />
				{highest_pics_block.highest_pics.highest_detail.H_RATING}
				{highest_pics_block.highest_pics.highest_detail.H_COMMENTS}
				{highest_pics_block.highest_pics.highest_detail.H_IP}
			</span>
		</td>
	<!-- END highest_detail -->
	</tr>
	<!-- END highest_pics -->
</table>
<br />
<!-- END highest_pics_block -->

<!-- BEGIN mostviewed_pics_block -->
<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr><th class="thTop" height="25" colspan="{S_COLS}" nowrap="nowrap">{L_MOST_VIEWED}</th></tr>
	<!-- BEGIN no_pics -->
	<tr><td class="row1" align="center" colspan="{S_COLS}" height="50"><span class="gen">{L_NO_PICS}&nbsp;</span></td></tr>
	<!-- END no_pics -->
	<!-- BEGIN mostviewed_pics -->
	<tr>
	<!-- BEGIN mostviewed_col -->
		<td class="row1" width="{S_COL_WIDTH}" align="center" onMouseOver="this.className='row2';" onMouseOut="this.className='row1';">
			<table><tr><td><div class="picshadow"><div class="picframe">
				<a href="{mostviewed_pics_block.mostviewed_pics.mostviewed_col.U_PIC}" {TARGET_BLANK}><img src="{mostviewed_pics_block.mostviewed_pics.mostviewed_col.THUMBNAIL}" {THUMB_SIZE} border="0" alt="{mostviewed_pics_block.mostviewed_pics.mostviewed_col.DESC}" title="{mostviewed_pics_block.mostviewed_pics.mostviewed_col.DESC}" vspace="10" /></a>
			</div></div></td></tr></table>
		</td>
	<!-- END mostviewed_col -->
	</tr>
	<tr>
		<!-- BEGIN mostviewed_detail -->
		<td class="row2" align="center">
			<span class="gensmall">
				{L_POSTER}: {mostviewed_pics_block.mostviewed_pics.mostviewed_detail.H_POSTER}<br />
				{L_PIC_TITLE}: {mostviewed_pics_block.mostviewed_pics.mostviewed_detail.H_TITLE}<br />
				{L_PIC_ID}: {mostviewed_pics_block.mostviewed_pics.mostviewed_detail.PIC_ID}<br />
				{L_POSTED}: {mostviewed_pics_block.mostviewed_pics.mostviewed_detail.H_TIME}<br />
				{L_VIEW}: {mostviewed_pics_block.mostviewed_pics.mostviewed_detail.H_VIEW}<br />
				{mostviewed_pics_block.mostviewed_pics.mostviewed_detail.H_RATING}
				{mostviewed_pics_block.mostviewed_pics.mostviewed_detail.H_COMMENTS}
				{mostviewed_pics_block.mostviewed_pics.mostviewed_detail.H_IP}
			</span>
		</td>
		<!-- END mostviewed_detail -->
	</tr>
	<!-- END mostviewed_pics -->
</table>
<br />
<!-- END mostviewed_pics_block -->

<!-- BEGIN random_pics_block -->
<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr><th class="thTop" height="25" colspan="{S_COLS}" nowrap="nowrap">{L_RAND_PICS}</th></tr>
	<!-- BEGIN no_pics -->
	<tr>
		<td class="row1" align="center" colspan="{S_COLS}" height="50"><span class="gen">{L_NO_PICS}&nbsp;</span></td>
	</tr>
	<!-- END no_pics -->
	<!-- BEGIN rand_pics -->
	<tr>
		<!-- BEGIN rand_col -->
		<td class="row1" width="{S_COL_WIDTH}" align="center" onMouseOver="this.className='row2';" onMouseOut="this.className='row1';">
			<table><tr><td><div class="picshadow"><div class="picframe">
				<a href="{random_pics_block.rand_pics.rand_col.U_PIC}" {TARGET_BLANK}><img src="{random_pics_block.rand_pics.rand_col.THUMBNAIL}" {THUMB_SIZE} border="0" alt="{random_pics_block.rand_pics.rand_col.DESC}" title="{random_pics_block.rand_pics.rand_col.DESC}" vspace="10" /></a>
			</div></div></td></tr></table>
		</td>
		<!-- END rand_col -->
	</tr>
	<tr>
		<!-- BEGIN rand_detail -->
		<td class="row2" align="center">
			<span class="gensmall">
				{L_POSTER}: {random_pics_block.rand_pics.rand_detail.POSTER}<br />
				{L_PIC_TITLE}: {random_pics_block.rand_pics.rand_detail.TITLE}<br />
				{L_PIC_ID}: {random_pics_block.rand_pics.rand_detail.PIC_ID}<br />
				{L_POSTED}: {random_pics_block.rand_pics.rand_detail.TIME}<br />
				{L_VIEW}: {random_pics_block.rand_pics.rand_detail.VIEW}<br />
				{random_pics_block.rand_pics.rand_detail.RATING}
				{random_pics_block.rand_pics.rand_detail.COMMENTS}
				{random_pics_block.rand_pics.rand_detail.IP}
			</span>
		</td>
		<!-- END rand_detail -->
	</tr>
	<!-- END rand_pics -->
</table>
<br />
<!-- END random_pics_block -->

<!-- BEGIN switch_user_logged_out -->
<form method="post" action="{S_LOGIN_ACTION}">
	<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
		<tr>
			<td class="catHead" height="28"><a name="login"></a><span class="cattitle">{L_LOGIN_LOGOUT}&nbsp;</span></td>
		</tr>
		<tr>
			<td class="row1" align="center" height="28">
				<span class="gensmall">
				{L_USERNAME}:<input class="post" type="text" name="username" size="10" />
				&nbsp;&nbsp;&nbsp;
				{L_PASSWORD}:<input class="post" type="password" name="password" size="10" />
				&nbsp;&nbsp; &nbsp;&nbsp;
				{L_AUTO_LOGIN}
				<input class="text" type="checkbox" name="autologin" />
				&nbsp;&nbsp;&nbsp;
				<input type="submit" class="mainoption" name="login" value="{L_LOGIN}" />
				<input type="hidden" name="redirect" value="{U_PORTAL}" />
				</span>
			</td>
		</tr>
	</table>
</form>
<!-- END switch_user_logged_out -->
<br clear="all" />
<!-- You must keep my copyright notice visible with its original content -->
{ALBUM_COPYRIGHT}

