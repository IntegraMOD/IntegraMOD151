<script>
<!--
function emoticon(text)
{
	var txtarea = opener.document.commentform.comment;
	text = ' ' + text + ' ';
	if (txtarea.createTextRange && txtarea.caretPos)
	{
		var caretPos = txtarea.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
		txtarea.focus();
	}
	else if (txtarea.selectionEnd && (txtarea.selectionStart | txtarea.selectionStart == 0))
	{
		mozInsert(txtarea, text, "");
	}
	else
	{
		txtarea.value  += text;
		txtarea.focus();
	}
}

function mozInsert(txtarea, openTag, closeTag)
{
	if (txtarea.selectionEnd > txtarea.value.length)
	{
		txtarea.selectionEnd = txtarea.value.length;
	} 

	var startPos = txtarea.selectionStart; 
	var endPos = txtarea.selectionEnd+openTag.length; 

	txtarea.value=txtarea.value.slice(0,startPos)+openTag+txtarea.value.slice(startPos); 
	txtarea.value=txtarea.value.slice(0,endPos)+closeTag+txtarea.value.slice(endPos); 
	
	txtarea.selectionStart = startPos+openTag.length; 
	txtarea.selectionEnd = endPos; 
	txtarea.focus(); 
}
//-->
</script>

<table width="98%" align="center" border="0" cellspacing="0" cellpadding="10">
	<tr>
		<td><table width="100%" border="0" cellspacing="1" cellpadding="4" class="forumline">
			<tr><th class="thHead" height="25">{L_EMOTICONS}</th></tr>
			<tr>
				<td>
					<table width="100" border="0" cellspacing="0" cellpadding="5">
						<!-- BEGIN smilies_row -->
						<tr align="center" valign="middle">
							<!-- BEGIN smilies_col -->
							<td><img src="{smilies_row.smilies_col.SMILEY_IMG}" border="0" onmouseover="this.style.cursor='hand';" onclick="emoticon('{smilies_row.smilies_col.SMILEY_CODE}');javascript:window.close();" alt="{smilies_row.smilies_col.SMILEY_DESC}" title="{smilies_row.smilies_col.SMILEY_DESC}" /></a></td>
							<!-- END smilies_col -->
						</tr>
						<!-- END smilies_row -->
						<!-- BEGIN switch_smilies_extra -->
						<tr align="center">
							<td colspan="{S_SMILIES_COLSPAN}"><span  class="nav"><a href="{U_MORE_SMILIES}" onclick="open_window('{U_MORE_SMILIES}', 250, 300);return false" target="_smilies" class="nav">{L_MORE_SMILIES}</a></td>
						</tr>
						<!-- END switch_smilies_extra -->
					</table>
				</td>
			</tr>
			<tr><td align="center"><br /><span class="genmed"><a href="javascript:window.close();" class="genmed">{L_CLOSE_WINDOW}</a></span></td></tr>
		</table></td>
	</tr>
</table>
