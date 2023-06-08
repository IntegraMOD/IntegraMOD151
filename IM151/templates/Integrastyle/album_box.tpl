<!-- BEGIN catheader -->
<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr>
		<!-- BEGIN col_span -->
		<td class="catLeft" colspan="{catheader.col_span.HEADER_COL_SPAN}" height="28"><span class="cattitle">{catheader.L_PUBLIC_CATS}</span></td>
		<!-- END col_span -->
	</tr>
	<tr>
		<th class="thCornerL" width="80%" height="25" colspan="2" nowrap="nowrap">&nbsp;{catheader.L_CATEGORY}&nbsp;</th>
		<!-- BEGIN thumb -->
		<th width="5%" class="{catheader.thumb.CLASS}">&nbsp;{catheader.thumb.L_LAST_PIC_THUMB}&nbsp;</th>
		<!-- END thumb -->
		<!-- BEGIN total_pics -->
		<th width="5%" class="{catheader.total_pics.CLASS}">&nbsp;{catheader.total_pics.L_TOTAL_PICS}&nbsp;</th>
		<!-- END total_pics -->
		<!-- BEGIN total_comments -->
		<th width="5%" class="{catheader.total_comments.CLASS}">&nbsp;{catheader.total_comments.L_TOTAL_COMMENTS}&nbsp;</th>
		<!-- END total_comments -->
		<!-- BEGIN pics -->
		<th width="5%" class="{catheader.pics.CLASS}">&nbsp;{catheader.pics.L_PICS}&nbsp;</th>
		<!-- END pics -->
		<!-- BEGIN comments -->
		<th width="5%" class="{catheader.comments.CLASS}" nowrap="nowrap">&nbsp;{catheader.comments.L_COMMENTS}&nbsp;</th>
		<!-- END comments -->
		<!-- BEGIN last_comment -->
		<th width="15%" class="{catheader.last_comment.CLASS}" nowrap="nowrap">&nbsp;{catheader.last_comment.L_LAST_COMMENT_INFO}&nbsp;</th>
		<!-- END last_comment -->
		<!-- BEGIN last_pic -->
		<th class="{catheader.last_pic.CLASS}" nowrap="nowrap">&nbsp;{catheader.last_pic.L_LAST_PIC}&nbsp;</th>
		<!-- END last_pic -->
	</tr>
<!-- END catheader -->

<!-- BEGIN catmain -->
	<!-- BEGIN catrow -->
	<tr>
		<td class="row1" width="1%"><img src="{catmain.catrow.CAT_IMG}" alt="" /></td>
		<!-- <td class="row1" height="50" onMouseOver="this.style.backgroundColor='{T_TD_COLOR1}';" onMouseOut="this.style.backgroundColor='{T_TR_COLOR1}';"> -->
		<td class="row1" height="50" onMouseOver="this.className='row2';" onMouseOut="this.className='row1';">
			<span class="forumlink">
				&nbsp;{NAV_DOT}&nbsp;<a href="{catmain.catrow.U_VIEWCAT}" class="forumlink">{catmain.catrow.CAT_TITLE}</a>
				<!-- BEGIN newpics -->
				<img src="{catmain.catrow.newpics.I_NEWEST_PICS}" border="0" alt="{catmain.catrow.newpics.L_NEWEST_PICS}" title="{catmain.catrow.newpics.L_NEWEST_PICS}">
				<!-- END newpics -->
			</span>
			<span class="genmed">{catmain.catrow.SLIDESHOW}&nbsp;</span>
			<br />
			<img src="{SPACER}" width="14" height="0" alt="" />
			<span class="genmed">{catmain.catrow.CAT_DESC}&nbsp;</span>
			<span class="gensmall">{catmain.catrow.L_MODERATORS}&nbsp;{catmain.catrow.MODERATORS}</span>
			<!-- BEGIN subcat_link -->
			<br />
			<img src="{SPACER}" width="1" height="15" alt="" />
			<span class="gensmall">{catmain.catrow.subcat_link.L_LINKS}:&nbsp;{catmain.catrow.subcat_link.LINKS}</span>
			<!-- END subcat_link -->
		</td>
		<!-- BEGIN thumb -->
		<td class="{COL0}" align="center" onMouseOver="this.style.backgroundColor='{THUMB_OVER_COLOR}';" onMouseOut="this.style.backgroundColor='{THUMB_OUT_COLOR}';"><span class="gensmall">{catmain.catrow.thumb.LAST_PIC_URL}&nbsp;</span></td>
		<!-- END thumb -->
		<!-- BEGIN total_pics -->
		<td class="{COL1}" align="center" onMouseOver="this.style.backgroundColor='{TOTAL_PICS_OVER_COLOR}';" onMouseOut="this.style.backgroundColor='{TOTAL_PICS_OUT_COLOR}';"><span class="gensmall">{catmain.catrow.total_pics.TOTAL_PICS}&nbsp;</span></td>
		<!-- END total_pics -->
		<!-- BEGIN total_comments -->
		<td class="{COL2}" align="center" onMouseOver="this.style.backgroundColor='{TOTAL_COMMENTS_OVER_COLOR}';" onMouseOut="this.style.backgroundColor='{TOTAL_COMMENTS_OUT_COLOR}';"><span class="gensmall">{catmain.catrow.total_comments.TOTAL_COMMENTS}&nbsp;</span></td>
		<!-- END total_comments -->
		<!-- BEGIN pics -->
		<td class="{COL3}" align="center" onMouseOver="this.style.backgroundColor='{PICS_OVER_COLOR}';" onMouseOut="this.style.backgroundColor='{PICS_OUT_COLOR}';"><span class="gensmall">{catmain.catrow.pics.PICS}&nbsp;</span></td>
		<!-- END pics -->
		<!-- BEGIN comments -->
		<td class="{COL4}" align="center" onMouseOver="this.style.backgroundColor='{COMMENTS_OVER_COLOR}';" onMouseOut="this.style.backgroundColor='{COMMENTS_OUT_COLOR}';"><span class="gensmall">{catmain.catrow.comments.COMMENTS}&nbsp;</span></td>
		<!-- END comments -->
		<!-- BEGIN last_comment -->
		<td class="{COL5}" align="center" nowrap="nowrap" onMouseOver="this.style.backgroundColor='{LAST_COMMENT_OVER_COLOR}';" onMouseOut="this.style.backgroundColor='{LAST_COMMENT_OUT_COLOR}';"><span class="gensmall">{catmain.catrow.last_comment.LAST_COMMENT_INFO}&nbsp;</span></td>
		<!-- END last_comment -->
		<!-- BEGIN last_pic -->
		<td class="{COL6}" align="center" nowrap="nowrap" onMouseOver="this.style.backgroundColor='{LAST_PIC_OVER_COLOR}';" onMouseOut="this.style.backgroundColor='{LAST_PIC_OUT_COLOR}';"><span class="gensmall">{catmain.catrow.last_pic.LAST_PIC_INFO}&nbsp;</span></td>
		<!-- END last_pic -->
	</tr>
	<!-- END catrow -->
<!-- END catmain -->

<!-- BEGIN catfooter -->
	<!-- BEGIN cat_public_footer -->
	<tr>
		<td class="row1" height="50" colspan="{catfooter.cat_public_footer.FOOTER_COL_SPAN}" onMouseOver="this.className='row2';" onMouseOut="this.className='row1';">
			<span class="forumlink">
				&nbsp;{NAV_DOT}&nbsp;<a href="{catfooter.cat_public_footer.U_USERS_PERSONAL_GALLERIES}" class="cattitle">{catfooter.cat_public_footer.L_USERS_PERSONAL_GALLERIES}</a>
			</span>
			<br />
			<img src="{SPACER}" width="5" height="15" alt="" />
			<span class="gensmall">
				&nbsp;{NAV_DOT}&nbsp;<a href="{catfooter.cat_public_footer.U_YOUR_PERSONAL_GALLERY}" class="gensmall"><b>{catfooter.cat_public_footer.L_YOUR_PERSONAL_GALLERY}</b></a>
			</span>
		</td>
	</tr>
	<tr>
		<td class="catBottom" height="28" colspan="{catfooter.cat_public_footer.FOOTER_COL_SPAN}">&nbsp;</td>
	</tr>
	<!-- END cat_public_footer -->
</table>
<br clear="all" />
<!-- END catfooter -->