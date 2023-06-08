<h1>{L_ALBUM_CONFIG}</h1>

<p>{L_ALBUM_CONFIG_EXPLAIN}</p>

<form action="{S_ALBUM_CLOWN_SP_CONFIG}" method="post">
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
	<tr>
	  <th class="th" colspan="2">{L_ALBUM_SP_GENERAL}</th>
	</tr>
	<tr>
	  <td class="row1" width="45%"><span class="genmed">{L_RATE_TYPE}</span></td>
	   <td class="row2">
		<select name="rate_type">
			<option {RATE_TYPE_0} value="0">{L_RATE_TYPE_0}</option>
			<option {RATE_TYPE_1} value="1">{L_RATE_TYPE_1}</option>
			<option {RATE_TYPE_2} value="2">{L_RATE_TYPE_2}</option>
		</select>
	  </td>
	</tr>
	
	<tr>
	  <td class="row1"><span class="genmed">{L_DISPLAY_LATEST}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {DISPLAY_LATEST_ENABLED} name="disp_late" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {DISPLAY_LATEST_DISABLED} name="disp_late" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_DISPLAY_HIGHEST}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {DISPLAY_HIGHEST_ENABLED} name="disp_high" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {DISPLAY_HIGHEST_DISABLED} name="disp_high" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_DISPLAY_RANDOM}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {DISPLAY_RANDOM_ENABLED} name="disp_rand" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {DISPLAY_RANDOM_DISABLED} name="disp_rand" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_PIC_ROW}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="12" size="5" name="img_rows" value="{PIC_ROW}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_PIC_COL}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="12" size="5" name="img_cols" value="{PIC_COL}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_MIDTHUMB_USE}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {MIDTHUMB_ENABLED} name="midthumb_use" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {MIDTHUMB_DISABLED} name="midthumb_use" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_MIDTHUMB_CACHE}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {MIDTHUMB_CACHE_ENABLED} name="midthumb_cache" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {MIDTHUMB_CACHE_DISABLED} name="midthumb_cache" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_MIDTHUMB_HEIGHT}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="12" size="5" name="midthumb_height" value="{MIDTHUMB_HEIGHT}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_MIDTHUMB_WIDTH}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="12" size="5" name="midthumb_width" value="{MIDTHUMB_WIDTH}" /></td>
	</tr>
	
	
	
	<tr>
	  <th class="th" colspan="2">{L_ALBUM_SP_WATERMARK}</th>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_WATERMARK}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {WATERMARK_ENABLED} name="use_watermark" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {WATERMARK_DISABLED} name="use_watermark" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_WATERMARK_USERS}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {WATERMARK_USERS_ENABLED} name="wut_users" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {WATERMARK_USERS_DISABLED} name="wut_users" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1" valign="top"><span class="genmed">{L_WATERMARK_PLACENT}</span></td>
	  <td class="row2">
	  	<table cellpadding="4">
	  	  <tr>
	  		<td><input type="radio" {WATERMAR_PLACEMENT_1} name="disp_watermark_at" value="1" /></td>
	  		<td><input type="radio" {WATERMAR_PLACEMENT_5} name="disp_watermark_at" value="5" /></td>
	  		<td><input type="radio" {WATERMAR_PLACEMENT_2} name="disp_watermark_at" value="2" /></td>
	  	  </tr>
	  	  <tr>
	  	  	<td><input type="radio" {WATERMAR_PLACEMENT_8} name="disp_watermark_at" value="8" /></td>
	  	  	<td><input type="radio" {WATERMAR_PLACEMENT_0} name="disp_watermark_at" value="0" /></td>
	  	  	<td><input type="radio" {WATERMAR_PLACEMENT_6} name="disp_watermark_at" value="6" /></td>
	  	  </tr>
	  	  <tr>
	  	  	<td><input type="radio" {WATERMAR_PLACEMENT_4} name="disp_watermark_at" value="4" /></td>
	  	  	<td><input type="radio" {WATERMAR_PLACEMENT_7} name="disp_watermark_at" value="7" /></td>
	  	  	<td><input type="radio" {WATERMAR_PLACEMENT_3} name="disp_watermark_at" value="3" /></td>
	  	  </tr>
	  	 </table>
	  </td>
	</tr>
	
	
	
	<tr>
	  <th class="th" colspan="2">{L_ALBUM_SP_HOTORNOT}</th>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_HON_USERS}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {HON_USERS_ENABLED} name="hon_rate_users" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {HON_USERS_DISABLED} name="hon_rate_users" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_HON_ALREDY_RATED}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {HON_ALREADY_RATED_ENABLED} name="hon_rate_times" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {HON_ALREADY_RATED_DISABLED} name="hon_rate_times" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_HON_SEP_RATING}</span></td>
	  <td class="row2"><span class="genmed"><input type="radio" {HON_SEP_RATING_ENABLED} name="hon_rate_sep" value="1" />{L_YES}&nbsp;&nbsp;<input type="radio" {HON_SEP_RATING_DISABLED} name="hon_rate_sep" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_HON_WHERE}</span></td>
	 <td class="row2"><input class="post" type="text" size="20" name="hon_rate_where" value="{HON_WHERE}" /></td>
	</tr>
	
	<tr>
	  <td class="cat" colspan="2" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" /></td>
	</tr>
</table></form>

<br clear="all" />