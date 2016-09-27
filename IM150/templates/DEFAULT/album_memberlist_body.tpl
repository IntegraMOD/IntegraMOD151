<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td width="100%">
			<a class="maintitle" href="{U_MEMBERLIST_GALLERY}">{L_PICTURES_OF_USER}</a><br />
			<span class="genmed">{L_MEMBERLIST_GALLERY_EXPLAIN}</span>
		</td>
		<!-- BEGIN switch_show_album_search -->
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
		</td>
		<!-- END switch_show_album_search -->
	</tr>
</table>

<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td class="nav" width="90%">
			<span class="nav">
				<!-- BEGIN switch_show_all_pics -->
				<a href="{U_SHOW_ALL_PICS}"><img src="{SHOW_ALL_PICS_IMG}" border="0" alt="{L_SHOW_ALL_PICS}" title="{L_SHOW_ALL_PICS}" /></a>&nbsp;
				<!-- END switch_show_all_pics -->
				<!-- BEGIN switch_show_all_ratings -->
				<a href="{U_SHOW_ALL_RATINGS}"><img src="{SHOW_ALL_RATINGS_IMG}" border="0" alt="{L_SHOW_ALL_RATINGS}" title="{L_SHOW_ALL_RATINGS}" /></a>&nbsp;
				<!-- END switch_show_all_ratings -->
				<!-- BEGIN switch_show_all_comments -->
				<a href="{U_SHOW_ALL_COMMENTS}"><img src="{SHOW_ALL_COMMENTS_IMG}" border="0" alt="{L_SHOW_ALL_COMMENTS}" title="{L_SHOW_ALL_COMMENTS}" /></a>&nbsp;
				<!-- END switch_show_all_comments -->
				<a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEP}
				<a href="{U_ALBUM}" class="nav">{L_ALBUM}</a>{NAV_SEP}
				<a class="nav" href="{U_MEMBERLIST_GALLERY}">{L_PICTURES_OF_USER}</a>
			</span>
		</td>
		<td nowrap="nowrap"><span class="gensmall"><b>{PAGINATION}</b></span></td>
	</tr>
</table>

<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr><th class="thTop" height="25" colspan="{S_COLS}">{L_PICTURES_OF_USER}</th></tr>
	<!-- BEGIN no_pics -->
	<tr><td class="row1" align="center" height="50"><span class="gen">{L_NO_PICTURES_BY_USER}</span></td></tr>
	<!-- END no_pics -->
	<!-- BEGIN picrow -->
	<tr>
		<!-- BEGIN piccol -->
		<td align="center" width="{S_COL_WIDTH}" class="row1"><span class="genmed"><a href="{picrow.piccol.U_PIC}" {TARGET_BLANK}><img src="{picrow.piccol.THUMBNAIL}" {THUMB_SIZE} border="0" alt="{picrow.piccol.DESC}" title="{picrow.piccol.DESC}" vspace="10" /></a></span></td>
		<!-- END piccol -->
	</tr>
	<tr>
		<!-- BEGIN pic_detail -->
		<td class="row2" align="center" width="{S_COL_WIDTH}">
			<span class="gensmall">
				{L_PIC_TITLE}: <a href="{picrow.pic_detail.U_PIC}" {TARGET_BLANK}>{picrow.pic_detail.TITLE}</a><br />
				{L_PIC_ID}: {picrow.pic_detail.PIC_ID}<br />
				{L_PIC_CAT}: <a href="{picrow.pic_detail.U_PIC_CAT}" {TARGET_BLANK}>{picrow.pic_detail.CATEGORY}</a><br />
				{L_POSTED}: {picrow.pic_detail.TIME}<br />
				{L_VIEW}: {picrow.pic_detail.VIEW}<br />
				{picrow.pic_detail.RATING}
				{picrow.pic_detail.COMMENTS}
				{picrow.pic_detail.IP}
				{picrow.pic_detail.EDIT}
				{picrow.pic_detail.DELETE}
				{picrow.pic_detail.LOCK}
				{picrow.pic_detail.MOVE}
			</span>
		</td>
		<!-- END pic_detail -->
	</tr>
	<!-- END picrow -->
	<tr>
		<td class="catBottom" colspan="{S_COLS}" align="center" height="28">
			<form action="{U_MEMBERLIST_GALLERY}" method="post">
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
					&nbsp;<input type="submit" name="submit" value="{L_SORT}" class="liteoption" />
				</span>
			</form>
		</td>
	</tr>
</table>

<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td width="100%">
			<span class="nav">
				<!-- BEGIN switch_show_all_pics -->
				<a href="{U_SHOW_ALL_PICS}"><img src="{SHOW_ALL_PICS_IMG}" border="0" alt="{L_SHOW_ALL_PICS}" title="{L_SHOW_ALL_PICS}" /></a>&nbsp;
				<!-- END switch_show_all_pics -->
				<!-- BEGIN switch_show_all_ratings -->
				<a href="{U_SHOW_ALL_RATINGS}"><img src="{SHOW_ALL_RATINGS_IMG}" border="0" alt="{L_SHOW_ALL_RATINGS}" title="{L_SHOW_ALL_RATINGS}" /></a>&nbsp;
				<!-- END switch_show_all_ratings -->
				<!-- BEGIN switch_show_all_comments -->
				<a href="{U_SHOW_ALL_COMMENTS}"><img src="{SHOW_ALL_COMMENTS_IMG}" border="0" alt="{L_SHOW_ALL_COMMENTS}" title="{L_SHOW_ALL_COMMENTS}" /></a>&nbsp;
				<!-- END switch_show_all_comments -->
				<a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEP}
				<a class="nav" href="{U_ALBUM}">{L_ALBUM}</a>{NAV_SEP}
				<a class="nav" href="{U_MEMBERLIST_GALLERY}">{L_PICTURES_OF_USER}</a>
			</span>
		</td>
		<td align="right" nowrap="nowrap"><span class="gensmall"><b>{PAGINATION}</b></span><br /><span class="gensmall">{S_TIMEZONE}</span></td>
	</tr>
	<tr><td colspan="4" align="right"><span class="gensmall"><b>{PAGE_NUMBER}</b></span></td></tr>
</table>
<br />
<!-- You must keep my copyright notice visible with its original content -->
{ALBUM_COPYRIGHT}