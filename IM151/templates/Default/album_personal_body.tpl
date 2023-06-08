<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td width="100%">
			<a class="maintitle" href="{U_PERSONAL_GALLERY}">{L_PERSONAL_GALLERY_OF_USER}</a><br />
			<span class="genmed">{L_PERSONAL_GALLERY_EXPLAIN}</span>
		</td>
		<td align="right" valign="bottom" nowrap="nowrap">
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
		<span class="gensmall"><b>{PAGINATION}</b></span></td>
	</tr>
</table>

<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td class="nav" align="left">
			<!-- BEGIN your_personal_gallery -->
			{UPLOAD_FULL_LINK}
			<!-- END your_personal_gallery -->
			<!-- BEGIN enable_picture_download -->
			{DOWNLOAD_FULL_LINK}
			<!-- END enable_picture_download -->
			<br />
			<span class="nav">
				<a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEP}
				<a href="{U_ALBUM}" class="nav">{L_ALBUM}</a>{NAV_SEP}
				<a href="{U_PERSONAL_GALLERY}" class="nav">{L_PERSONAL_GALLERY_OF_USER}</a>
			</span>
		</td>
		<td class="nav" align="right" valign="bottom">
			<span class="gensmall"><b>{SLIDESHOW}</b></span>
		</td>
	</tr>
</table>

<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr>
		<th class="thTop" height="25" colspan="{S_COLS}">{L_PERSONAL_GALLERY_OF_USER}</th>
	</tr>
	<!-- BEGIN no_pics_personal -->
	<tr>
		<td class="row1" align="center">
			<span class="gen">
				<br />
				{L_PERSONAL_GALLERY_NOT_CREATED}<br /><br />
				{U_CREATE_PERSONAL_GALLERY}
				<br />
			</span>
		</td>
	</tr>
	<!-- END no_pics_personal -->
	<!-- BEGIN picrow -->
	<tr>
	<!-- BEGIN piccol -->
		<td class="row1" align="center" width="{S_COL_WIDTH}"><span class="genmed"><a href="{picrow.piccol.U_PIC}" {TARGET_BLANK}><img src="{picrow.piccol.THUMBNAIL}" {THUMB_SIZE} border="0" alt="{picrow.piccol.DESC}" title="{picrow.piccol.DESC}" vspace="10" /></a></span></td>
	<!-- END piccol -->
	</tr>
	<tr>
	<!-- BEGIN pic_detail -->
	<td class="row2" align="center"><span class="gensmall">
		{L_PIC_TITLE}: {picrow.pic_detail.TITLE}<br />
		{L_PIC_ID}: {picrow.pic_detail.PIC_ID}<br />
		{L_POSTED}: {picrow.pic_detail.TIME}<br />
		{L_VIEW}: {picrow.pic_detail.VIEW}<br />
		{picrow.pic_detail.RATING}
		{picrow.pic_detail.COMMENTS}
		{picrow.pic_detail.IP}
		{picrow.pic_detail.EDIT}&nbsp;&nbsp;{picrow.pic_detail.DELETE}&nbsp;&nbsp;{picrow.pic_detail.LOCK}</span>
	</td>
	<!-- END pic_detail -->
	</tr>
	<!-- END picrow -->
	<tr>
	<td class="catBottom" colspan="{S_COLS}" align="center" height="28">
		<form action="{U_PERSONAL_GALLERY}" method="post">
		<span class="gensmall">{L_SELECT_SORT_METHOD}:
		<select name="sort_method">
			<option {SORT_TIME} value='pic_time'>{L_TIME}</option>
			<option {SORT_PIC_TITLE} value='pic_title'>{L_PIC_TITLE}</option>
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

<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td class="nav" width="100%">
			<!-- BEGIN your_personal_gallery -->
			{UPLOAD_FULL_LINK}
			<!-- END your_personal_gallery -->
			<!-- BEGIN enable_picture_download -->
			{DOWNLOAD_FULL_LINK}
			<!-- END enable_picture_download -->
			<br />
			<span class="nav">
				<a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEP}
				<a class="nav" href="{U_ALBUM}">{L_ALBUM}</a>{NAV_SEP}
				<a class="nav" href="{U_PERSONAL_GALLERY}">{L_PERSONAL_GALLERY_OF_USER}</a>
			</span>
		</td>
		<td align="right" nowrap="nowrap">
			<span class="gensmall">{S_TIMEZONE}</span><br />
			<span class="nav">{PAGINATION}</span>
		</td>
	</tr>
	<tr>
		<td colspan="3"><span class="nav">{PAGE_NUMBER}</span></td>
	</tr>
</table>
</form>
<br />
<!-- You must keep my copyright notice visible with its original content -->
{ALBUM_COPYRIGHT}
