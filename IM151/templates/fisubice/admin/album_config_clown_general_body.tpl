<tr>
	<td class="row1"><span class="genmed">{L_RATE_TYPE}</span></td>
	<td class="row2" colspan="2" border="1">
		<select onchange="setChange();" name="rate_type">
			<option {RATE_TYPE_0} value="0">{L_RATE_TYPE_0}</option>
			<option {RATE_TYPE_1} value="1">{L_RATE_TYPE_1}</option>
			<option {RATE_TYPE_2} value="2">{L_RATE_TYPE_2}</option>
		</select>
	</td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_DISPLAY_LATEST}</span></td>
	<td class="row2"colspan="2"><span class="genmed"><input onchange="setChange();" type="radio" {DISPLAY_LATEST_ENABLED} name="disp_late" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {DISPLAY_LATEST_DISABLED} name="disp_late" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_DISPLAY_HIGHEST}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {DISPLAY_HIGHEST_ENABLED} name="disp_high" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {DISPLAY_HIGHEST_DISABLED} name="disp_high" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_DISPLAY_MOST_VIEWED}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {DISPLAY_MOST_VIEWED_ENABLED} name="disp_mostv" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {DISPLAY_MOST_VIEWED_DISABLED} name="disp_mostv" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_DISPLAY_RANDOM}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {DISPLAY_RANDOM_ENABLED} name="disp_rand" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {DISPLAY_RANDOM_DISABLED} name="disp_rand" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_PIC_ROW}</span></td>
	<td class="row2"><input onchange="setChange();" class="post" type="text" maxlength="12" size="5" name="img_rows" value="{PIC_ROW}" /></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_PIC_COL}</span></td>
	<td class="row2"><input onchange="setChange();" class="post" type="text" maxlength="12" size="5" name="img_cols" value="{PIC_COL}" /></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_MIDTHUMB_USE}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {MIDTHUMB_ENABLED} name="midthumb_use" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {MIDTHUMB_DISABLED} name="midthumb_use" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_MIDTHUMB_CACHE}</span></td>
	<td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {MIDTHUMB_CACHE_ENABLED} name="midthumb_cache" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {MIDTHUMB_CACHE_DISABLED} name="midthumb_cache" value="0" />{L_NO}</span></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_MIDTHUMB_HEIGHT}</span></td>
	<td class="row2"><input onchange="setChange();" class="post" type="text" maxlength="12" size="5" name="midthumb_height" value="{MIDTHUMB_HEIGHT}" /></td>
</tr>
<tr>
	<td class="row1"><span class="genmed">{L_MIDTHUMB_WIDTH}</span></td>
	<td class="row2"><input onchange="setChange();" class="post" type="text" maxlength="12" size="5" name="midthumb_width" value="{MIDTHUMB_WIDTH}" /></td>
</tr>