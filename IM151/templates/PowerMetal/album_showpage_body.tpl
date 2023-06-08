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

function checkFormRate()
{
	formErrors = false;
	if (document.ratingform.rating.value == -1)
	{
		formErrors = "{L_PLEASE_RATE_IT}";
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

// Startup variables
var imageTag = false;
var theSelection = false;

// Check for Browser & Platform for PC & IE specific bits
// More details from: http://www.mozilla.org/docs/web-developer/sniffer/browser_type.html
var clientPC = navigator.userAgent.toLowerCase(); // Get client info
var clientVer = parseInt(navigator.appVersion); // Get browser version

var is_ie = ((clientPC.indexOf("msie") != -1) && (clientPC.indexOf("opera") == -1));
var is_nav = ((clientPC.indexOf('mozilla')!=-1) && (clientPC.indexOf('spoofer')==-1)
		&& (clientPC.indexOf('compatible') == -1) && (clientPC.indexOf('opera')==-1)
		&& (clientPC.indexOf('webtv')==-1) && (clientPC.indexOf('hotjava')==-1));
var is_moz = 0;

var is_win = ((clientPC.indexOf("win")!=-1) || (clientPC.indexOf("16bit") != -1));
var is_mac = (clientPC.indexOf("mac")!=-1);

var baseHeight;
window.onload = initInsertions;

function initInsertions()
{
	//document.commentform.comment.focus();
	if (is_ie && typeof(baseHeight) != 'number') baseHeight = document.selection.createRange().duplicate().boundingHeight;
}

function emoticon(text)
{
	var txtarea = document.commentform.comment;
	text = ' ' + text + ' ';
	if (txtarea.createTextRange && txtarea.caretPos)
	{
		if (baseHeight != txtarea.caretPos.boundingHeight)
		{
			txtarea.focus();
			storeCaret(txtarea);
		}
		var caretPos = txtarea.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
		txtarea.focus();
	}
	else if ((txtarea.selectionEnd | txtarea.selectionEnd == 0) && (txtarea.selectionStart | txtarea.selectionStart == 0))
	{
		mozInsert(txtarea, text, "");
		return;
	}
	else
	{
		txtarea.value += text;
		txtarea.focus();
	}
}

// Insert at Claret position. Code from
// http://www.faqts.com/knowledge_base/view.phtml/aid/1052/fid/130
function storeCaret(textEl)
{
	if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
}

function mozWrap(txtarea, open, close)
{
	var selLength = txtarea.textLength;
	var selStart = txtarea.selectionStart;
	var selEnd = txtarea.selectionEnd;
	if (selEnd == 1 || selEnd == 2)
	{
		selEnd = selLength;
	}

	var s1 = (txtarea.value).substring(0,selStart);
	var s2 = (txtarea.value).substring(selStart, selEnd)
	var s3 = (txtarea.value).substring(selEnd, selLength);
	txtarea.value = s1 + open + s2 + close + s3;
	return;
}

function mozInsert(txtarea, openTag, closeTag)
{
	if (txtarea.selectionEnd > txtarea.value.length)
	{
		txtarea.selectionEnd = txtarea.value.length;
	}

	var startPos = txtarea.selectionStart;
	var endPos = txtarea.selectionEnd + openTag.length;

	txtarea.value=txtarea.value.slice(0,startPos) + openTag + txtarea.value.slice(startPos);
	txtarea.value=txtarea.value.slice(0,endPos) + closeTag + txtarea.value.slice(endPos);

	txtarea.selectionStart = startPos + openTag.length;
	txtarea.selectionEnd = endPos;
	txtarea.focus();
}

//pops up a window with all smilies
function openAllSmiles()
{
	smiles = window.open('album_showpage.php?mode=smilies', '_phpbbsmilies', 'HEIGHT=600,resizable=yes,scrollbars=yes,WIDTH=470');
	smiles.focus();
	return true;
}
// -->
</script>

<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td>
			<span class="nav">
				<a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEP}
				<a class="nav" href="{U_ALBUM}">{L_ALBUM}</a>
				{NAV_CAT_DESC}
			</span>
		</td>
    </tr>
</table>
<table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif" WIDTH=8 HEIGHT=23 border="0" alt=""></td> 
   <td width="100%" background="templates/PowerMetal/images/blk_tm.gif"><img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""><span class="genmed2"><center>          </center></td>
   <td><img name="blkr" src="templates/PowerMetal/images/blk_trc.gif" WIDTH=77 HEIGHT=23 border="0" alt=""></td>
  </tr>
  	</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="tlc" src="templates/PowerMetal/images/tlc.gif" WIDTH=8 HEIGHT=6 border="0" alt=""></td> 
   <td width="100%" background="templates/PowerMetal/images/tm.gif"><img name="tm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="trc" src="templates/PowerMetal/images/trc.gif" WIDTH=8 HEIGHT=6 border="0" alt=""></td>
  </tr>
  <tr>
    <td background="templates/PowerMetal/images/left.gif"><img name="left" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
        <td valign="top" bgcolor="#484848">
<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
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

<a name="TopPic"></a>

<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr><th class="thTop" width="100%" height="25">{NEXT_PIC}&nbsp;&nbsp;{PIC_TITLE}&nbsp;&nbsp;{PREV_PIC}</th></tr>
	<tr>
		<td class="row1" width="100%" align="center">
			<!-- BEGIN switch_slideshow_enabled -->
			<form name="slideshowf" action="{U_SLIDESHOW}" method="post" onsubmit="return true;">
				<span class="gensmall">{SLIDESHOW_SELECT}</span>
				<input type="submit" class="button" value="{L_SLIDESHOW_ONOFF}" style="width: 120px" /><br />
			</form>
			<!-- END switch_slideshow_enabled -->
			{U_PIC_L1}<img src="{U_PIC}" border="0" vspace="10" alt="{PIC_TITLE}" title="{PIC_TITLE}" />{U_PIC_L2}<br />
			<span class="genmed">{U_PIC_CLICK}</span><br />
			<!-- BEGIN pic_nuffed_enabled -->
			<span class="genmed"><a href="{pic_nuffed_enabled.U_PIC_NUFFED_CLICK}" class="genmed">{pic_nuffed_enabled.L_PIC_NUFFED_CLICK}</a></span><br />
			<!-- END pic_nuffed_enabled -->
		</td>
	</tr>
	<tr>
		<td class="row2" width="100%">
			<table width="100%" align="center" border="0" cellspacing="1" cellpadding="2">
				<tr>
					<td width="50%" align="right" valign="top"><span class="genmed">{L_POSTER}:</span></td>
					<td width="50%" align="left" valign="top"><span class="genmed"><b>{POSTER}</b></span></td>
				</tr>
				<tr>
					<td valign="top" align="right"><span class="genmed">{L_PIC_TITLE}:</span></td>
					<td valign="top" align="left"><b><span class="genmed">{PIC_TITLE}</span></b></td>
				</tr>
				<tr>
					<td valign="top" align="right"><span class="genmed">{L_PIC_DETAILS}:</span></td>
					<td valign="top" align="left"><b><span class="genmed">{L_PIC_ID}:&nbsp;{PIC_ID}&nbsp;-&nbsp;{L_PIC_TYPE}:&nbsp;{PIC_TYPE}&nbsp;-&nbsp;{L_PIC_SIZE}:&nbsp;{PIC_SIZE}</span></b></td>
				</tr>
				<tr>
					<td valign="top" align="right"><span class="genmed">{L_PIC_BBCODE}:</span></td>
					<td valign="top" align="left"><b><span class="genmed"><form name="select_all"><input name="BBCode" size="50" maxlength="100" value="{PIC_BBCODE}" type="text" readonly="1" onClick="javascript:this.form.BBCode.focus();this.form.BBCode.select();"/></form></span></b></td>
				</tr>
				<tr>
					<td valign="top" align="right"><span class="genmed">{L_POSTED}:</span></td>
					<td valign="top" align="left"><b><span class="genmed">{PIC_TIME}</span></b></td>
				</tr>
				<tr>
					<td valign="top" align="right"><span class="genmed">{L_VIEW}:</span></td>
					<td valign="top" align="left"><b><span class="genmed">{PIC_VIEW}</span></b></td>
				</tr>
				<!-- BEGIN rate_switch -->
				<tr>
					<td valign="top" align="right"><span class="genmed">{L_RATING}:</span></td>
					<td valign="top" align="left">
						<span class="genmed"><b>{PIC_RATING}</b></span>
						<!-- BEGIN rate_row -->
						<form name="ratingform" action="{S_ALBUM_ACTION}" method="post" onsubmit="return checkFormRate();">
							<select name="rating">
								<option value="-1">{S_RATE_MSG}</option>
								<!-- BEGIN rate_scale_row -->
								<option value="{rate_switch.rate_row.rate_scale_row.POINT}">{rate_switch.rate_row.rate_scale_row.POINT}</option>
								<!-- END rate_scale_row -->
							</select>&nbsp;
							<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
						</form>
						<!-- END rate_row -->
					</td>
				<br />
				</tr>
				<!-- END rate_switch -->
				<tr>
					<td valign="top" align="right"><span class="genmed">{L_PIC_DESC}:</span></td>
					<td valign="top" align="left"><b><span class="genmed">{PIC_DESC}</span></b></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<!-- BEGIN pics_nav -->
<br />
<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr><th class="thTop" nowrap="nowrap" width="100%" colspan="5">{pics_nav.L_PICS_NAV}</th></tr>
	<tr>
		<!-- BEGIN next -->
		<td width="20%" align="center">
			<table><tr><td><div class="picshadow"><div class="picframe">
				<a href="{pics_nav.next.U_PICS_LINK}"><img src="{pics_nav.next.U_PICS_THUMB}" {THUMB_SIZE} border="0" alt="{pics_nav.L_PICS_NAV_NEXT}" title="{pics_nav.L_PICS_NAV_NEXT}" vspace="10" /></a>
			</div></div></td></tr></table>
		</td>
		<!-- END next -->
		<td width="20%" align="center">
			<table><tr><td><div class="picshadow"><div class="picframe">
				<img src="{U_PIC_THUMB}" {THUMB_SIZE} border="3px" alt="{PIC_TITLE}" title="{PIC_TITLE}" vspace="10" style="border-color: #FF8866" />
			</div></div></td></tr></table>
		</td>
		<!-- BEGIN prev -->
		<td width="20%" align="center">
			<table><tr><td><div class="picshadow"><div class="picframe">
				<a href="{pics_nav.prev.U_PICS_LINK}"><img src="{pics_nav.prev.U_PICS_THUMB}" {THUMB_SIZE} border="0" alt="{pics_nav.L_PICS_NAV_PREV}" title="{pics_nav.L_PICS_NAV_PREV}" vspace="10" /></a>
			</div></div></td></tr></table>
		</td>
		<!-- END prev -->
	</tr>
</table>
<br />
<!-- END pics_nav -->
<!-- BEGIN coment_switcharo_top -->
<br />
<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr>
		<th class="thTop" nowrap="nowrap" width="150">{L_POSTER}</th>
		<th class="thTop" nowrap="nowrap">{L_MESSAGE}</th>
	</tr>
<!-- END coment_switcharo_top -->
<!-- BEGIN commentrow -->
<tr> 
	<td width="150" align="left" valign="top" class="row1"><span class="name">{commentrow.PANEL_INFO}</span><br /></td>
	<td class="row1" width="100%" height="28" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="100%"><a href="{commentrow.U_MINI_POST}"><img src="{commentrow.MINI_POST_IMG}" width="12" height="9" alt="{commentrow.L_MINI_POST_ALT}" title="{commentrow.L_MINI_POST_ALT}" border="0" /></a><span class="postdetails">Posted at: {commentrow.TIME}</span></td>
			<td valign="top" nowrap="nowrap"><span class="genmed">{commentrow.EDIT}&nbsp;{commentrow.DELETE}&nbsp;{commentrow.IP}</span></td>
		</tr>
		<tr> 
			<td colspan="2"><hr /></td>
		</tr>
		<tr>
			<td colspan="2"><span class="postbody">{commentrow.TEXT}</span></td>
		</tr>
	</table></td>
</tr>
<tr> 
	<td class="row1" width="150" align="left" valign="middle"><span class="nav"><a href="#top" class="nav">Back to top</a></span></td>
	<td class="row1" width="100%" height="28" valign="bottom" nowrap="nowrap"><table cellspacing="0" cellpadding="0" border="0" height="18" width="18">
		<tr> 
			<td valign="middle" nowrap="nowrap">{commentrow.BUTTONS_PANEL}</td>
		</tr>
	</table></td>
</tr>
<tr> 
	<td class="spaceRow" colspan="2" height="1"><img src="templates/subSilver/images/spacer.gif" alt="" width="1" height="1" /></td>
</tr>
<!-- END commentrow -->
<!-- BEGIN switch_comment -->
	<tr>
		<td class="catBottom" align="center" height="28" colspan="2">
			<form action="{S_ALBUM_ACTION}" method="post">
				<span class="gensmall">{L_ORDER}:</span>
				<select name="sort_order">
					<option {SORT_ASC} value='ASC'>{L_ASC}</option>
					<option {SORT_DESC} value='DESC'>{L_DESC}</option>
				</select>&nbsp;
				<input type="submit" name="submit" value="{L_SORT}" class="liteoption" />
			</form>
		</td>
	</tr>
<!-- END switch_comment -->
<!-- BEGIN coment_switcharo_bottom -->
	<tr>
		<td class="spaceRow" colspan="2" height="1"><img src="images/spacer.gif" alt="" width="1" height="1" /></td>
	</tr>
</table>
<!-- END coment_switcharo_bottom -->


<!-- BEGIN switch_comment -->
<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td width="100%"><span class="nav">{PAGE_NUMBER}</span></td>
		<td align="right" nowrap="nowrap">
			<span class="gensmall">{S_TIMEZONE}</span><br />
			<span class="nav">{PAGINATION}</span>
		</td>
	</tr>
</table>
<!-- END switch_comment -->

<!-- BEGIN switch_comment_post -->
<form name="commentform" action="{S_ALBUM_ACTION}" method="post" onsubmit="return checkForm();">
	<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
		<tr><th class="thTop" height="25" colspan="3">{L_POST_YOUR_COMMENT}</th></tr>
		<!-- BEGIN logout -->
		<tr>
			<td class="row1" width="30%" height="28"><span class="genmed">{L_USERNAME}</span></td>
			<td class="row2" colspan="3"><input class="post" type="text" name="comment_username" size="32" maxlength="32" /></td>
		</tr>
		<!-- END logout -->
		<tr>
			<td class="row1" valign="top" width="20%">
				<span class="genmed">{L_MESSAGE}<br />
				{L_MAX_LENGTH}: <b>{S_MAX_LENGTH}</b></span>
			</td>
			<td class="row2" valign="top" width="60%">
				<textarea name="comment" class="post" cols="80" rows="9" wrap="virtual" onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>{S_MESSAGE}</textarea>
			</td>
			<td class="row2" align="center" valign="middle" width="20%">
				<table border="0" cellspacing="0" cellpadding="5">
					<tr>
					<!-- BEGIN smilies -->
						<td align="center">
							<img src="{switch_comment_post.smilies.URL}" border="0" onmouseover="this.style.cursor='hand';" onclick="emoticon(' {switch_comment_post.smilies.CODE} ');" alt="{switch_comment_post.smilies.DESC}" title="{switch_comment_post.smilies.DESC}" />
						</td>
					<!-- BEGIN new_col -->
					</tr>
					<tr>
					<!-- END new_col -->
					<!-- END smilies -->
					</tr>
				</table>
				<input type='button' CLASS="button" name="SmilesButt" value="Smileys" onclick="openAllSmiles();" />
			</td>
		</tr>
		<tr>
			<td class="catBottom" align="center" colspan="3" height="28">
				<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
			</td>
		</tr>
	</table>
</form>
<!-- END switch_comment_post -->
<br />
<!-- You must keep my copyright notice visible with its original content -->
{ALBUM_COPYRIGHT}


    </td>
    <td background="templates/PowerMetal/images/right.gif"><img name="right" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
   <td><img name="blc" src="templates/PowerMetal/images/blc.gif" width="8" height="8" border="0" alt=""></td>
    <td background="templates/PowerMetal/images/btm.gif"><img name="btm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="brc" src="templates/PowerMetal/images/brc.gif" width="8" height="8" border="0" alt=""></td>
  </tr></table>