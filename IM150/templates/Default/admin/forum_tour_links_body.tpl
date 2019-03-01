<script>
<!--
function forum(text) {
	text = ' ' + text + ' ';
	if (opener.document.forms['post'].message.createTextRange && opener.document.forms['post'].message.caretPos) {
		var caretPos = opener.document.forms['post'].message.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
		opener.document.forms['post'].message.focus();
	} else {
	opener.document.forms['post'].message.value  += text;
	opener.document.forms['post'].message.focus();
	}
}
//-->
</script>

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
  <th class="thTop">Forum List</th>
</tr>
<!-- BEGIN catrow -->
<tr>
  <td align="left" valign="top"><a href="javascript:forum('{catrow.CAT_DESC}')" class="mainmenu"><b>{catrow.CAT_NAME}</b></a></td>
</tr>
<!-- BEGIN forumrow -->
<tr>
  <td class="{catrow.forumrow.ROW_CLASS}" align="left" valign="top"><a href="javascript:forum('{catrow.forumrow.U_FORUM_LINK}')" class="mainmenu">{catrow.forumrow.SUBJECT}</a></td>
</tr>
<!-- END forumrow -->
<!-- END catrow -->
</table>