<tr>
	<td class="row1" width="45%"><span class="genmed">{L_MAX_PICS}</span></td>
	<td class="row2"><input onchange="setChange();" class="post" type="text" maxlength="9" size="9" name="max_pics" value="{MAX_PICS}" /></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_USER_PICS_LIMIT}</span></td>
	<td class="row2"><input onchange="setChange();" class="post" type="text" maxlength="12" size="5" name="user_pics_limit" value="{USER_PICS_LIMIT}" /></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_MOD_PICS_LIMIT}</span></td>
	<td class="row2"><input onchange="setChange();" class="post" type="text" maxlength="12" size="5" name="mod_pics_limit" value="{MOD_PICS_LIMIT}" /></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_HOTLINK_PREVENT}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {HOTLINK_PREVENT_ENABLED} name="hotlink_prevent" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {HOTLINK_PREVENT_DISABLED} name="hotlink_prevent" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_HOTLINK_ALLOWED}</span></td>
	<td class="row2"><input onchange="setChange();" class="post" type="text" size="40" name="hotlink_allowed" value="{HOTLINK_ALLOWED}" /></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_ALBUM_CATEGORY_SORTING}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {ALBUM_CATEGORY_SORTING_ID} name="album_category_sorting" value="cat_id" />{L_ALBUM_CATEGORY_SORTING_ID}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {ALBUM_CATEGORY_SORTING_NAME} name="album_category_sorting" value="cat_title" />{L_ALBUM_CATEGORY_SORTING_NAME}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {ALBUM_CATEGORY_SORTING_ORDER} name="album_category_sorting" value="cat_order" />{L_ALBUM_CATEGORY_SORTING_ORDER}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_ALBUM_CATEGORY_DIRECTION}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {ALBUM_CATEGORY_SORTING_ASC} name="album_category_sorting_direction" value="ASC" />{L_ALBUM_CATEGORY_SORTING_ASC}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {ALBUM_CATEGORY_SORTING_DESC} name="album_category_sorting_direction" value="DESC" />{L_ALBUM_CATEGORY_SORTING_DESC}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_SHOW_RECENT_IN_SUBCATS}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {SHOW_RECENT_IN_SUBCATS_ENABLED} name="show_recent_in_subcats" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {SHOW_RECENT_IN_SUBCATS_DISABLED} name="show_recent_in_subcats" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_SHOW_RECENT_INSTEAD_OF_NOPICS}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {SHOW_RECENT_INSTEAD_OF_NOPICS_ENABLED} name="show_recent_instead_of_nopics" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {SHOW_RECENT_INSTEAD_OF_NOPICS_DISABLED} name="show_recent_instead_of_nopics" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_ALBUM_DEBUG_MODE}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {ALBUM_DEBUG_MODE_ENABLED} name="album_debug_mode" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {ALBUM_DEBUG_MODE_DISABLED} name="album_debug_mode" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_RATE_SYSTEM}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {RATE_ENABLED} name="rate" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {RATE_DISABLED} name="rate" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_RATE_SCALE}</span></td>
	<td class="row2"><input onchange="setChange();" class="post" type="text" name="rate_scale" value="{RATE_SCALE}" size="3" /></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_COMMENT_SYSTEM}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {COMMENT_ENABLED} name="comment" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {COMMENT_DISABLED} name="comment" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_EMAIL_NOTIFICATION}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {EMAIL_NOTIFICATION_ENABLED} name="email_notification" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {EMAIL_NOTIFICATION_DISABLED} name="email_notification" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_SHOW_DOWNLOAD}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {SHOW_DOWNLOAD_ALWAYS} name="show_download" value="2" />{L_ALWAYS}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {SHOW_DOWNLOAD_ENABLED} name="show_download" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {SHOW_DOWNLOAD_DISABLED} name="show_download" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_SHOW_SLIDESHOW}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {SHOW_SLIDESHOW_ENABLED} name="show_slideshow" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {SHOW_SLIDESHOW_DISABLED} name="show_slideshow" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_SHOW_SLIDESHOW_SCRIPT}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {SLIDESHOW_SCRIPT_ENABLED} name="slideshow_script" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {SLIDESHOW_SCRIPT_DISABLED} name="slideshow_script" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_SHOW_PICS_NAV}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {SHOW_PICS_NAV_ENABLED} name="show_pics_nav" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {SHOW_PICS_NAV_DISABLED} name="show_pics_nav" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_SHOW_INLINE_COPYRIGHT}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {SHOW_INLINE_COPYRIGHT_ENABLED} name="show_inline_copyright" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {SHOW_INLINE_COPYRIGHT_DISABLED} name="show_inline_copyright" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_ENABLE_NUFFIMAGE}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {NUFFIMAGE_ENABLED} name="enable_nuffimage" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {NUFFIMAGE_DISABLED} name="enable_nuffimage" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_ENABLE_SEPIA_BW}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {SEPIABW_ENABLED} name="enable_sepia_bw" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {SEPIABW_DISABLED} name="enable_sepia_bw" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_SHOW_EXIF}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {SHOW_EXIF_ENABLED} name="show_exif" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {SHOW_EXIF_DISABLED} name="show_exif" value="0" />{L_NO}</span></td>
</tr>
