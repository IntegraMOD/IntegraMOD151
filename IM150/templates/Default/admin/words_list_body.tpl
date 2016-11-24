<div class="maintitle">{L_WORDS_TITLE}</div>
<br />
<div class="genmed">{L_WORDS_TEXT}</div>
<br />
<form method="post" action="{S_WORDS_ACTION}">
<table cellspacing="1" cellpadding="3" border="0" align="center" class="forumline">
<tr> 
<th>&nbsp;{L_WORD}&nbsp;</th>
<th>&nbsp;{L_REPLACEMENT}&nbsp;</th>
<th colspan="2">{L_ACTION}</th>
</tr>
<!-- BEGIN words -->
<tr> 
<td class="{words.ROW_CLASS}" align="center">{words.WORD}</td>
<td class="{words.ROW_CLASS}" align="center">{words.REPLACEMENT}</td>
<td class="{words.ROW_CLASS}">&nbsp;<a href="{words.U_WORD_EDIT}">{L_EDIT}</a>&nbsp;</td>
<td class="{words.ROW_CLASS}">&nbsp;<a href="{words.U_WORD_DELETE}">{L_DELETE}</a>&nbsp;</td>
</tr>
<!-- END words -->
<tr> 
<td colspan="5" align="center" class="cat">{S_HIDDEN_FIELDS} 
<input type="submit" name="add" value="{L_ADD_WORD}" class="mainoption" />
</td>
</tr>
</table>
</form>
<br />