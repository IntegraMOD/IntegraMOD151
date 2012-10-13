<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td>
			<a class="maintitle" href="{U_VIEW_CAT}">{CAT_TITLE}</a><br />
			<span class="gensmall">{CAT_DESC}&nbsp;</span><br /><br />
			<span class="gensmall">{L_MODERATORS}: {MODERATORS}</span>
			<!-- BEGIN personal_gallery_header -->
			<br />
			<span class="genmed">{L_PERSONAL_GALLERY_EXPLAIN}</span>
			<!-- END personal_gallery_header -->
			<br /><br />
			<span class="nav">{PAGE_NUMBER}<br />{PAGINATION}</span>
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

<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td class="nav" align="left">
			<!-- BEGIN manage_personal_gal_folders -->
			<a href="{U_MANAGE_PIC}"><img src="{MANAGE_PIC_IMG}" border="0" alt="{L_MANAGE_PIC}" title="{L_MANAGE_PIC}" align="middle" /></a>
			<!-- END manage_personal_gal_folders -->
			<!-- BEGIN enable_view_toggle -->
			<a href="{U_TOGGLE_VIEW_ALL}"><img src="{TOGGLE_VIEW_ALL_IMG}" border="0" alt="{L_TOGGLE_VIEW_ALL}" title="{L_TOGGLE_VIEW_ALL}" align="middle" /></a>
			<!-- END enable_view_toggle -->
			<!-- BEGIN enable_picture_upload -->
			{UPLOAD_FULL_LINK}
			<!-- END enable_picture_upload -->
			<!-- BEGIN enable_picture_upload_pg -->
			{UPLOAD_FULL_LINK}
			<!-- END enable_picture_upload_pg -->
			<!-- BEGIN enable_picture_download -->
			{DOWNLOAD_FULL_LINK}
			<!-- END enable_picture_download -->
			<!-- BEGIN enable_picture_download_pg -->
			{DOWNLOAD_FULL_LINK}
			<!-- END enable_picture_download_pg -->
			<br />
			<span class="nav">
				<a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEP}
				<a class="nav" href="{U_ALBUM}">{L_ALBUM}</a>
				{NAV_CAT_DESC}
			</span>
		</td>
		<td class="nav" align="right" valign="bottom"><span class="gensmall"><b>{SLIDESHOW}&nbsp;</b></span></td>
	</tr>
</table>
{ALBUM_BOARD_INDEX}
<!-- BEGIN index_pics_block -->
<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr>
		<th class="thTop" height="25" align="center" colspan="{S_COLS}" nowrap="nowrap">
		<!-- BEGIN enable_gallery_title -->
		{CAT_TITLE}
		<!-- END enable_gallery_title -->
		</th>
	</tr>
	<!-- BEGIN no_pics -->
	<tr>
		<td class="row1" align="center" colspan="{S_COLS}">
			<span class="gen">
				<br />
				{L_NO_PICS}<br />
				<br />
				<!-- BEGIN manage_personal_gal_folders -->
				{U_CREATE_PERSONAL_GALLERY}
				<br />
				<!--
				<a href="{U_CREATE_PERSONAL_GALLERY}"><img src="{CREATE_CATEGORY_IMG}" border="0" alt="{L_CREATE_PERSONAL_GALLERY}" title="{L_CREATE_PERSONAL_GALLERY}" /></a><br />
				<br />
				-->
				<!-- END manage_personal_gal_folders -->
			</span>
		</td>
	</tr>
	<!-- END no_pics -->
	<!-- BEGIN picrow -->
	<tr>
		<!-- BEGIN piccol -->
		<td class="row1" align="center" width="{S_COL_WIDTH}" onMouseOver="this.className='row2';" onMouseOut="this.className='row1';">
			<table><tr><td><div class="picshadow"><div class="picframe">
				<a href="{index_pics_block.picrow.piccol.U_PIC}" {TARGET_BLANK}><img src="{index_pics_block.picrow.piccol.THUMBNAIL}" {THUMB_SIZE} border="0" alt="{index_pics_block.picrow.piccol.DESC}" title="{index_pics_block.picrow.piccol.DESC}" vspace="10" /></a>
			</div></div></td></tr></table>
			<span class="genmed"><br />{index_pics_block.picrow.piccol.APPROVAL}</span>
		</td>
		<!-- END piccol -->
		<!-- BEGIN nopiccol -->
		<td align="center" width="{S_COL_WIDTH}" class="row1">&nbsp;</span></td>
		<!-- END nopiccol -->
	</tr>
	<tr>
		<!-- BEGIN pic_detail -->
		<td class="row2" align="center">
			<span class="gensmall">
				{L_PIC_TITLE}: {index_pics_block.picrow.pic_detail.TITLE}<br />
				{L_PIC_ID}: {index_pics_block.picrow.pic_detail.PIC_ID}<br />
				<!-- BEGIN cats -->
				{L_PIC_CAT}: <a href="{index_pics_block.picrow.pic_detail.cats.U_PIC_CAT}" {TARGET_BLANK}>{index_pics_block.picrow.pic_detail.cats.CATEGORY}</a><br />
				<!-- END cats -->
				{L_POSTER}: {index_pics_block.picrow.pic_detail.POSTER}<br />
				{L_POSTED}: {index_pics_block.picrow.pic_detail.TIME}<br />
				{L_VIEW}: {index_pics_block.picrow.pic_detail.VIEW}<br />
				{index_pics_block.picrow.pic_detail.RATING}
				{index_pics_block.picrow.pic_detail.COMMENTS}
				{index_pics_block.picrow.pic_detail.IP}
				{index_pics_block.picrow.pic_detail.EDIT} {index_pics_block.picrow.pic_detail.DELETE} {index_pics_block.picrow.pic_detail.LOCK} {index_pics_block.picrow.pic_detail.MOVE} {index_pics_block.picrow.pic_detail.AVATAR_PIC} <!-- {index_pics_block.picrow.pic_detail.IMG_BBCODE} -->
			</span>
		</td>
		<!-- END pic_detail -->
		<!-- BEGIN picnodetail -->
		<td class="row2">&nbsp;</td>
		<!-- END picnodetail -->
	</tr>
	<!-- END picrow -->
	<tr>
		<td class="catBottom" colspan="{S_COLS}" align="center" height="28">
			<form action="{S_ALBUM_ACTION}" method="post">
			<span class="gensmall">{L_SELECT_SORT_METHOD}:
			<select name="sort_method">
				<option {SORT_TIME} value='pic_time'>{L_TIME}</option>
				<option {SORT_PIC_TITLE} value='pic_title'>{L_PIC_TITLE}</option>
				{SORT_USERNAME_OPTION}
				<option {SORT_VIEW} value='pic_view_count'>{L_VIEW}</option>
				{SORT_RATING_OPTION}
				{SORT_COMMENTS_OPTION}
				{SORT_NEW_COMMENT_OPTION}
			</select>
			&nbsp;{L_ORDER}:
			<select name="sort_order">
				<option {SORT_ASC} value='ASC'>{L_ASC}</option>
				<option {SORT_DESC} value='DESC'>{L_DESC}</option>
			</select>
			&nbsp;<input type="submit" name="submit" value="{L_SORT}" class="liteoption" /></span>
		</td>
	</tr>
</table>
<!-- END index_pics_block -->
<!-- BEGIN recent_pics_block -->
<br />
<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr><th class="thTop" height="25" colspan="{S_COLS}" nowrap="nowrap">{L_RECENT_PUBLIC_PICS}</th></tr>
	<!-- BEGIN no_pics -->
	<tr><td class="row1" align="center" colspan="{S_COLS}" height="50"><span class="gen">{L_NO_PICS}</span></td></tr>
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

<!-- BEGIN mostviewed_pics_block -->
<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr><th class="thTop" height="25" colspan="{S_COLS}" nowrap="nowrap">{L_MOST_VIEWED}</th></tr>
	<!-- BEGIN no_pics -->
	<tr><td class="row1" align="center" colspan="{S_COLS}" height="50"><span class="gen">{L_NO_PICS}</span></td></tr>
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

<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td class="nav" width="100%">
			<span class="nav">
				<!-- BEGIN manage_personal_gal_folders -->
				<a href="{U_MANAGE_PIC}"><img src="{MANAGE_PIC_IMG}" border="0" alt="{L_MANAGE_PIC}" title="{L_MANAGE_PIC}" align="middle" /></a>
				<!-- END manage_personal_gal_folders -->
				<!-- BEGIN enable_view_toggle -->
				<a href="{U_TOGGLE_VIEW_ALL}"><img src="{TOGGLE_VIEW_ALL_IMG}" border="0" alt="{L_TOGGLE_VIEW_ALL}" title="{L_TOGGLE_VIEW_ALL}" align="middle" /></a>
				<!-- END enable_view_toggle -->
				<!-- BEGIN enable_picture_upload -->
				{UPLOAD_FULL_LINK}
				<!-- END enable_picture_upload -->
				<!-- BEGIN enable_picture_upload_pg -->
				{UPLOAD_FULL_LINK}
				<!-- END enable_picture_upload_pg -->
				<!-- BEGIN enable_picture_download -->
				{DOWNLOAD_FULL_LINK}
				<!-- END enable_picture_download -->
				<!-- BEGIN enable_picture_download_pg -->
				{DOWNLOAD_FULL_LINK}
				<!-- END enable_picture_download_pg -->
				<br />
				<a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEP}
				<a class="nav" href="{U_ALBUM}">{L_ALBUM}</a>
				{NAV_CAT_DESC}
			</span>
		</td>
		<td align="right" valign="top" nowrap="nowrap"><span class="nav">{PAGE_NUMBER}<br />{PAGINATION}</span></td>
	</tr>
	<tr><td colspan="2"></td></tr>
</table>
</form>

<table width="98%" cellspacing="0" border="0" cellpadding="0">
	<tr><td align="right" class="gensmall" nowrap="nowrap">{ALBUM_JUMPBOX}</td></tr>
	<tr><td align="right" class="gensmall"><br />{S_TIMEZONE}<br />{S_AUTH_LIST}</td></tr>
</table>
<br />
<!-- You must keep my copyright notice visible with its original content -->
{ALBUM_COPYRIGHT}
