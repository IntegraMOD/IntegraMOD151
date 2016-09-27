<div class="maintitle">{L_WORDS_TITLE}</div>
<br />
<div class="genmed">{L_WORDS_TEXT}</div>
<br />
<form method="post" action="{S_WORDS_ACTION}">
<table cellspacing="1" cellpadding="3" border="0" align="center" class="forumline">
<tr> 
<th colspan="2">{L_WORD_CENSOR}</th>
</tr>
<tr> 
<td align="right" class="row1">{L_WORD}:</td>
<td class="row2"> 
<input type="text" name="word" value="{WORD}" class="post" />
</td>
</tr>
<tr> 
<td align="right" class="row1">&nbsp;{L_REPLACEMENT}:</td>
<td class="row2"> 
<input type="text" name="replacement" value="{REPLACEMENT}" class="post" />
</td>
</tr>
<tr> 
<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS} 
<input type="submit" name="save" value="{L_SUBMIT}" class="mainoption" />
</td>
</tr>
</table>
</form>
<br />