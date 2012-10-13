<h1>{L_ALBUM_CONFIG}</h1>

<p>{L_ALBUM_CONFIG_EXPLAIN}</p>

<form action="{S_ALBUM_CONFIG_ACTION}" method="post">
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
	<tr>
	  <th class="th" colspan="2">{L_ALBUM_CONFIG}</th>
	</tr>
	<tr>
	  <td class="row1" width="45%"><span class="genmed">{L_MAX_PICS}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="9" size="9" name="max_pics" value="{MAX_PICS}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_USER_PICS_LIMIT}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="12" size="5" name="user_pics_limit" value="{USER_PICS_LIMIT}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_MOD_PICS_LIMIT}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="12" size="5" name="mod_pics_limit" value="{MOD_PICS_LIMIT}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_HOTLINK_PREVENT}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {HOTLINK_PREVENT_ENABLED} name="hotlink_prevent" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {HOTLINK_PREVENT_DISABLED} name="hotlink_prevent" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_HOTLINK_ALLOWED}</span></td>
	  <td class="row2"><input class="post" type="text" size="40" name="hotlink_allowed" value="{HOTLINK_ALLOWED}" /></td>
	</tr>
	<!-- Multiple File Upload mod : begin -->
   	<tr>
	  <th class="thHead" colspan="2">{L_ALBUM_UPLOAD_SETTINGS}</th>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_MAX_FILES_TO_UPLOAD}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="2" size="2" name="max_files_to_upload" value="{MAX_FILES_TO_UPLOAD}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_MAX_PREGENERATED_FIELDS}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="2" size="2" name="max_pregenerated_fields" value="{MAX_PREGENERATED_FIELDS}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_DYN_GENERATE_FIELDS}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {DYNFIELDS_ENABLED} name="dynamic_fields" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {DYNFIELDS_DISABLED} name="dynamic_fields" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_PRE_GENERATE_FIELDS}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {PREGENFIELDS_ENABLED} name="pregenerate_fields" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {PREGENFIELDS_DISABLED} name="pregenerate_fields" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_PROPERCASE_TITLE}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {PROPERCASE_TITLE_ENABLED} name="propercase_pic_title" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {PROPERCASE_TITLE_DISABLED} name="propercase_pic_title" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_MAX_FILE_SIZE}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="12" size="12" name="max_file_size" value="{MAX_FILE_SIZE}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_MAX_WIDTH}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="9" size="9" name="max_width" value="{MAX_WIDTH}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_MAX_HEIGHT}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="9" size="9" name="max_height" value="{MAX_HEIGHT}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_PIC_DESC_MAX_LENGTH}</span></td>
	  <td class="row2"><input class="post" type="text" size="6" name="desc_length" value="{PIC_DESC_MAX_LENGTH}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_GD_VERSION}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {NO_GD} name="gd_version" value="0" />{L_MANUAL_THUMBNAIL}&nbsp;&nbsp;<input type="radio" {GD_V1} name="gd_version" value="1" />GD1&nbsp;&nbsp;<input type="radio" {GD_V2} name="gd_version" value="2" />GD2</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_JPG_ALLOWED}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {JPG_ENABLED} name="jpg_allowed" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {JPG_DISABLED} name="jpg_allowed" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_PNG_ALLOWED}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {PNG_ENABLED} name="png_allowed" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {PNG_DISABLED} name="png_allowed" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_GIF_ALLOWED}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {GIF_ENABLED} name="gif_allowed" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {GIF_DISABLED} name="gif_allowed" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <th class="th" colspan="2">{L_THUMBNAIL_SETTINGS}</th>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_THUMBNAIL_CACHE}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {THUMBNAIL_CACHE_ENABLED} name="thumbnail_cache" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {THUMBNAIL_CACHE_DISABLED} name="thumbnail_cache" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_THUMBNAIL_SIZE}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="4" size="4" name="thumbnail_size" value="{THUMBNAIL_SIZE}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_THUMBNAIL_QUALITY}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="3" size="3" name="thumbnail_quality" value="{THUMBNAIL_QUALITY}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_ROWS_PER_PAGE}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="2" size="2" name="rows_per_page" value="{ROWS_PER_PAGE}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_COLS_PER_PAGE}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="2" size="2" name="cols_per_page" value="{COLS_PER_PAGE}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_DEFAULT_SORT_METHOD}</span></td>
	  <td class="row2">
		<select name="sort_method">
			<option {SORT_TIME} value='pic_time'>{L_TIME}</option>
			<option {SORT_PIC_TITLE} value='pic_title'>{L_PIC_TITLE}</option>
			<option {SORT_USERNAME} value='username'>{L_USERNAME}</option>
			<option {SORT_VIEW} value='pic_view_count'>{L_VIEW}</option>
			<option {SORT_RATING} value='rating'>{L_RATING}</option>
			<option {SORT_COMMENTS} value='comments'>{L_COMMENTS}</option>
			<option {SORT_NEW_COMMENT} value='new_comment'>{L_NEW_COMMENT}</option>
		</select>
	  </td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_DEFAULT_SORT_ORDER}</span></td>
	  <td class="row2">
		<select name="sort_order">
			<option {SORT_ASC} value='ASC'>{L_ASC}</option>
			<option {SORT_DESC} value='DESC'>{L_DESC}</option>
		</select>
	  </td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_FULLPIC_POPUP}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {FULLPIC_POPUP_ENABLED} name="fullpic_popup" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {FULLPIC_POPUP_DISABLED} name="fullpic_popup" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <th class="th" colspan="2">{L_EXTRA_SETTINGS}</th>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_PERSONAL_GALLERY}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {PERSONAL_GALLERY_USER} name="personal_gallery" value="{S_USER}" />{L_REG}&nbsp;&nbsp;<input type="radio" {PERSONAL_GALLERY_PRIVATE} name="personal_gallery" value="{S_PRIVATE}" />{L_PRIVATE}&nbsp;&nbsp;<input type="radio" {PERSONAL_GALLERY_ADMIN} name="personal_gallery" value="{S_ADMIN}" />{L_ADMIN}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_PERSONAL_GALLERY_LIMIT}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="5" size="5" name="personal_gallery_limit" value="{PERSONAL_GALLERY_LIMIT}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_PERSONAL_GALLERY_VIEW}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {PERSONAL_GALLERY_VIEW_ALL} name="personal_gallery_view" value="{S_GUEST}" />{L_GUEST}&nbsp;&nbsp;<input type="radio" {PERSONAL_GALLERY_VIEW_REG} name="personal_gallery_view" value="{S_USER}" />{L_REG}&nbsp;&nbsp;<input type="radio" {PERSONAL_GALLERY_VIEW_PRIVATE} name="personal_gallery_view" value="{S_PRIVATE}" />{L_PRIVATE}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_RATE_SYSTEM}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {RATE_ENABLED} name="rate" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {RATE_DISABLED} name="rate" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_RATE_SCALE}</span></td>
	  <td class="row2"><input class="post" type="text" name="rate_scale" value="{RATE_SCALE}" size="3" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_COMMENT_SYSTEM}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {COMMENT_ENABLED} name="comment" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {COMMENT_DISABLED} name="comment" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" /></td>
	</tr>
</table></form>

<br clear="all" />