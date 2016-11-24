<div class="maintitle">{L_SMILEY_TITLE}</div>
<br />
<div class="genmed">{L_SMILEY_EXPLAIN}</div>
<br />
<script language="javascript" type="text/javascript">
<!--
function update_smiley(newimage)
{
	document.smiley_image.src = "{S_SMILEY_BASEDIR}/" + newimage;
}
//-->
</script>

<form method="post" action="{S_SMILEY_ACTION}">
<table class="forumline" cellspacing="1" cellpadding="4" border="0" align="center">
<tr> 
<th colspan="2">{L_SMILEY_CONFIG}</th>
</tr>
<tr> 
<td class="row2">{L_SMILEY_CODE}</td>
<td class="row2"> 
<input type="text" name="smile_code" value="{SMILEY_CODE}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_SMILEY_URL}</td>
<td class="row1"> 
<select name="smile_url" onchange="update_smiley(this.options[selectedIndex].value);">{S_FILENAME_OPTIONS} 
</select>
&nbsp; <img name="smiley_image" src="{SMILEY_IMG}" border="0" alt="" /> &nbsp;</td>
</tr>
<tr> 
<td class="row2">{L_SMILEY_EMOTION}</td>
<td class="row2"> 
<input type="text" name="smile_emotion" value="{SMILEY_EMOTICON}" class="post" />
</td>
</tr>
<tr> 
<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS} 
<input class="mainoption" type="submit" value="{L_SUBMIT}" />
</td>
</tr>
</table>
</form>
<br />