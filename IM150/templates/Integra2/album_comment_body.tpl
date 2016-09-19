<form action="{S_ALBUM_ACTION}" method="post">
<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td class="nav">
			<span class="nav">
				<a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEP}
				<a class="nav" href="{U_ALBUM}">{L_ALBUM}</a>{NAV_SEP}
				<a class="nav" href="{U_VIEW_CAT}">{CAT_TITLE}</a>
			</span>
		</td>
		<td align="right">
			<form name="search" action="{U_ALBUM_SEARCH}">
				<span class="gensmall">
					{L_SEARCH}:&nbsp;
					<select name="mode">
						<option value="user">{L_USERNAME}</option>
						<option value="name">{L_PIC_NAME}</option>
						<option value="desc">{L_DESCRIPTION}</option>
					</select>
					{L_SEARCH_CONTENTS}
					<input type="text" name="search" maxlength="20">
					&nbsp;&nbsp;
					<input class="liteoption" type="submit" value="{L_GO}">
				</span>
			</form>
		</td>
	</tr>
</table>


<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr><th class="thTop" height="25" colspan="2">{PIC_TITLE}</th></tr>
	<tr><td class="row1" align="center"><img src="{U_PIC}" border="0" vspace="10" alt="{PIC_TITLE}" title="{PIC_TITLE}" /></td></tr>
	<tr>
		<td class="row2">
			<table width="90%" align="center" border="0" cellpadding="3" cellspacing="2">
				<tr>
					<td width="25%" align="right"><span class="genmed">{L_POSTER}:</span></td>
					<td><span class="genmed"><b>{POSTER}</b></span></td>
				</tr>
				<tr>
					<td valign="top" align="right"><span class="genmed">{L_PIC_TITLE}:</span></td>
					<td valign="top"><b><span class="genmed">{PIC_TITLE}</span></b></td>
				</tr>
				<tr>
					<td valign="top" align="right"><span class="genmed">{L_PIC_ID}:</span></td>
					<td valign="top"><b><span class="genmed">{PIC_ID}</span></b></td>
				</tr>
				<tr>
					<td align="right"><span class="genmed">{L_POSTED}:</span></td>
					<td><b><span class="genmed">{PIC_TIME}</span></b></td>
				</tr>
				<tr>
					<td align="right"><span class="genmed">{L_VIEW}:</span></td>
					<td><b><span class="genmed">{PIC_VIEW}</span></b></td>
				</tr>
				<!-- BEGIN rate_switch -->
				<tr>
					<td valign="top" align="right"><span class="genmed">{L_RATING}:</span></td>
					<td><b><span class="genmed">{PIC_RATING}</span></b></td>
				</tr>
				<!-- END rate_switch -->
				<tr>
					<td valign="top" align="right"><span class="genmed">{L_PIC_DESC}:</span></td>
					<td valign="top"><b><span class="genmed">{PIC_DESC}</span></b></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<!-- BEGIN coment_switcharo_top -->
<br />
<table border="0" class="forumline" width="100%">
	<tr>
		<th class="thTop" nowrap="nowrap" width="15%">{L_POSTER}</th>
		<th class="thTop" nowrap="nowrap" width="85%">{L_MESSAGE}</th>
	</tr>
<!-- END coment_switcharo_top -->
<!-- BEGIN commentrow -->
	<tr>
		<td class="row1" align="center" valign="top">
			<span class="genmed"><b>{commentrow.POSTER}</span></b>
		</td>
		<td class="row1">
			<table width="100%">
				<tr>
					<td><span class="genmed">{commentrow.TIME}</span></td>
					<td align="right"><span class="genmed">{commentrow.EDIT}&nbsp;{commentrow.DELETE}&nbsp;{commentrow.IP}</span></td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr>
					<td><span class="postbody">{commentrow.TEXT}</span></td>
				</tr>
			</table>
		</td>
	</tr>
<!-- END commentrow -->
<!-- BEGIN coment_switcharo_bottom -->
	<tr><td class="catBottom" colspan="2" height="28">&nbsp;</td></tr>
<!-- END coment_switcharo_bottom -->
<!-- BEGIN switch_comment -->
	<tr>
		<td class="catBottom" align="center" height="28" colspan="2"><span class="gensmall">{L_ORDER}:</span>
		<select name="sort_order"><option {SORT_ASC} value='ASC'>{L_ASC}</option><option {SORT_DESC} value='DESC'>{L_DESC}</option></select>&nbsp;<input type="submit" name="submit" value="{L_SORT}" class="liteoption" /></td>
	</tr>
<!-- END switch_comment -->
</table>
<!-- BEGIN switch_comment -->
<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td width="100%"><span class="nav">{PAGE_NUMBER}</span></td>
		<td align="right" nowrap="nowrap"><span class="gensmall">{S_TIMEZONE}</span><br /><span class="nav">{PAGINATION}</span></td>
	</tr>
</table>
<!-- END switch_comment -->
</form>

<script language="JavaScript" type="text/javascript">
<!--
function checkForm()
{
	formErrors = false;

	if ((document.commentform.comment.value.length < 2) && (document.commentform.rate.value == -1))
	{
		formErrors = "{L_COMMENT_NO_TEXT}";
	}
	else if (document.commentform.comment.value.length > {S_MAX_LENGTH})
	{
		formErrors = "{L_COMMENT_TOO_LONG}";
	}

	if (formErrors)
	{
		alert(formErrors);
		return false;
	}
	else
	{
		return true;
	}
}

function storeCaret(textEl)
{
	if (textEl.createTextRange)
	{
		textEl.caretPos = document.selection.createRange().duplicate();
	}
}

//how to add smilies
function emotions(text)
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

//pops up a window with all smilies
function openAllSmiles()
{
	smiles = window.open('album_showpage.php?mode=smilies', '_phpbbsmilies', 'HEIGHT=600,resizable=yes,scrollbars=yes,WIDTH=470');
	smiles.focus();
	return false;
}
// -->
</script>

<!-- BEGIN switch_comment_post -->
<form name="commentform" action="{S_ALBUM_ACTION}" method="post" onsubmit="return checkForm();">
<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr><th class="thTop" height="25" colspan="3">{L_POST_YOUR_COMMENT}</th></tr>
	<tr>
		<td class="row1" valign="top" width="20%">
			<span class="genmed">{L_MESSAGE}<br />
				{L_MAX_LENGTH}: <b>{S_MAX_LENGTH}</b>
			</span>
		</td>
		<td class="row2" valign="top">
			<textarea name="comment" class="post" cols="60" rows="9" wrap='virtual' class='post' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>{S_MESSAGE}</textarea>
		</td>
		<td class="row2" valign="middle" width="40%">
			<table border="0" cellspacing="0" cellpadding="5">
				<tr>
				<!-- BEGIN smilies -->
					<td><img src="{switch_comment_post.smilies.URL}" border="0" onclick="emotions(' {switch_comment_post.smilies.CODE} ');" alt="{switch_comment_post.smilies.DESC}" title="{switch_comment_post.smilies.DESC}" /></td>
				<!-- BEGIN new_col -->
				</tr>
				<tr>
				<!-- END new_col -->
				<!-- END smilies -->
				</tr>
			</table>
			<input type='button' class="button" name="SmilesButt" value="Smileys" onclick="openAllSmiles();" />
		</td>
	</tr>
	<tr>
		<td class="catBottom" align="center" colspan="3" height="28"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" /></td>
	</tr>
</table>
</form>
<!-- END switch_comment_post -->
<br />
<!-- You must keep my copyright notice visible with its original content -->
{ALBUM_COPYRIGHT}
