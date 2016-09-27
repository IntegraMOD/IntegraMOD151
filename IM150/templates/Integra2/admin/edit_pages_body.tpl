<script language="JavaScript" type="text/javascript">
<!--
// bbCode control by
// subBlue design
// www.subBlue.com

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

// Define the BBCode tags
bbcode = new Array();
bbtags = new Array('[b]','[/b]','[i]','[/i]','[u]','[/u]','[img]','[/img]','[url=','][/url]','[center]','[/center]','[quote]','[/quote]','[code]','[/code]');
imageTag = false;

// Shows the help messages in the helpline window
function helpline(help) {
	document.post.helpbox.value = eval(help + "_help");
}


// Replacement for arrayname.length property
function getarraysize(thearray) {
	for (i = 0; i < thearray.length; i++) {
		if ((thearray[i] == "undefined") || (thearray[i] == "") || (thearray[i] == null))
			return i;
		}
	return thearray.length;
}

// Replacement for arrayname.push(value) not implemented in IE until version 5.5
// Appends element to the array
function arraypush(thearray,value) {
	thearray[ getarraysize(thearray) ] = value;
}

// Replacement for arrayname.pop() not implemented in IE until version 5.5
// Removes and returns the last element of an array
function arraypop(thearray) {
	thearraysize = getarraysize(thearray);
	retval = thearray[thearraysize - 1];
	delete thearray[thearraysize - 1];
	return retval;
}


function checkForm() {

	formErrors = false;

	if (document.post.message.value.length < 2) {
		formErrors = "{L_EMPTY_MESSAGE}";
	}

	if (formErrors) {
		alert(formErrors);
		return false;
	} else {
		bbstyle(-1);
		//formObj.preview.disabled = true;
		//formObj.submit.disabled = true;
		return true;
	}
}

function emoticon(text) {
	var txtarea = document.post.message;
	text = ' ' + text + ' ';
	if (txtarea.createTextRange && txtarea.caretPos) {
		var caretPos = txtarea.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? caretPos.text + text + ' ' : caretPos.text + text;
		txtarea.focus();
	} else {
		txtarea.value  += text;
		txtarea.focus();
	}
}

function bbfontstyle(bbopen, bbclose) {
	var txtarea = document.post.message;

	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (!theSelection) {
			txtarea.value += bbopen + bbclose;
			txtarea.focus();
			return;
		}
		document.selection.createRange().text = bbopen + theSelection + bbclose;
		txtarea.focus();
		return;
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, bbopen, bbclose);
		return;
	}
	else
	{
		txtarea.value += bbopen + bbclose;
		txtarea.focus();
	}
	storeCaret(txtarea);
}


function bbstyle(bbnumber) {
	var txtarea = document.post.message;

	txtarea.focus();

	donotinsert = false;
	theSelection = false;
	bblast = 0;

	if (bbnumber == -1) { // Close all open tags & default button names
		while (bbcode[0]) {
			butnumber = arraypop(bbcode) - 1;
			txtarea.value += bbtags[butnumber + 1];
			buttext = eval('document.post.addbbcode' + butnumber + '.value');
			eval('document.post.addbbcode' + butnumber + '.value ="' + buttext.substr(0,(buttext.length - 1)) + '"');
		}
		imageTag = false; // All tags are closed including image tags :D
		txtarea.focus();
		return;
	}

	if ((clientVer >= 4) && is_ie && is_win)
	{
		theSelection = document.selection.createRange().text; // Get text selection
		if (theSelection) {
			// Add tags around selection
			document.selection.createRange().text = bbtags[bbnumber] + theSelection + bbtags[bbnumber+1];
			txtarea.focus();
			theSelection = '';
			return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, bbtags[bbnumber], bbtags[bbnumber+1]);
		return;
	}

	// Find last occurance of an open tag the same as the one just clicked
	for (i = 0; i < bbcode.length; i++) {
		if (bbcode[i] == bbnumber+1) {
			bblast = i;
			donotinsert = true;
		}
	}

	if (donotinsert) {		// Close all open tags up to the one just clicked & default button names
		while (bbcode[bblast]) {
				butnumber = arraypop(bbcode) - 1;
				txtarea.value += bbtags[butnumber + 1];
				buttext = eval('document.post.addbbcode' + butnumber + '.value');
				eval('document.post.addbbcode' + butnumber + '.value ="' + buttext.substr(0,(buttext.length - 1)) + '"');
				imageTag = false;
			}
			txtarea.focus();
			return;
	} else { // Open tags

		if (imageTag && (bbnumber != 14)) {		// Close image tag before adding another
			txtarea.value += bbtags[15];
			lastValue = arraypop(bbcode) - 1;	// Remove the close image tag from the list
			document.post.addbbcode14.value = "Img";	// Return button back to normal state
			imageTag = false;
		}

		// Open tag
		txtarea.value += bbtags[bbnumber];
		if ((bbnumber == 14) && (imageTag == false)) imageTag = 1; // Check to stop additional tags after an unclosed image tag
		arraypush(bbcode,bbnumber+1);
		eval('document.post.addbbcode'+bbnumber+'.value += "*"');
		txtarea.focus();
		return;
	}
	storeCaret(txtarea);
}

// Insert at Claret position. Code from
// http://www.faqts.com/knowledge_base/view.phtml/aid/1052/fid/130
function storeCaret(textEl) {
	if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
}

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--
function forum_links() {
 window.open("{USID}", "_forums", "width=400,height=500,scrollbars,resizable=yes");
}
//-->
</script>

<form action="{S_POST_ACTION}" method="post" name="post">

<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
	  <th class="cattitle" width="20%" colspan="2" align="center"><span class="mainmenu">{L_MODE}</span></th>
	</tr>
	<tr>
	  <td class="row1" width="20%"><span class="gen"><b>{L_SUBJECT}</b></span></td>
	  <td class="row2" width="80%"> <span class="gen">
		<input type="text" name="subject" size="45" maxlength="60" style="width:450px" tabindex="2" class="post" value="{SUBJECT}" /></span></td>
	</tr>
  <tr>
	<td class="row1" width="20%" valign="top"><span class="gen"><b>BBCode</b></span></td>
	<td class="row2" width="80%">
		<span class="genmed">
		<input type="button" class="button" name="addbbcode0" value=" b " style="font-weight:bold" onClick="bbstyle(0)" />&nbsp;&nbsp;&nbsp;
		<input type="button" class="button" name="addbbcode2" value=" i " style="font-style:italic" onClick="bbstyle(2)" />&nbsp;&nbsp;&nbsp;
		<input type="button" class="button" name="addbbcode4" value=" u " style="text-decoration:underline" onClick="bbstyle(4)" />&nbsp;&nbsp;&nbsp;
		<input type="button" class="button" name="addbbcode6" value="IMG" onClick="bbstyle(6)" />&nbsp;&nbsp;&nbsp;
		<input type="button" class="button" name="addbbcode8" value="URL" onClick="bbstyle(8)" />&nbsp;&nbsp;&nbsp;
		<input type="button" class="button" name="addbbcode10" value="Center" onClick="bbstyle(10)" />&nbsp;&nbsp;&nbsp;
		<input type="button" class="button" name="addbbcode12" value="Quote" onClick="bbstyle(12)" />&nbsp;&nbsp;&nbsp;
		<input type="button" class="button" name="addbbcode14" value="Code" onClick="bbstyle(14)" />&nbsp;&nbsp;&nbsp;
		<br /><br />{L_FONT_COLOR}:
		<select name="addbbcode16" onChange="bbfontstyle('[color=' + this.form.addbbcode16.options[this.form.addbbcode16.selectedIndex].value + ']', '[/color]')" >
		  <option style="color:darkred;" value="darkred" class="genmed">{L_COLOR_DARK_RED}</option>
		  <option style="color:red;" value="red" class="genmed">{L_COLOR_RED}</option>
		  <option style="color:orange;" value="orange" class="genmed">{L_COLOR_ORANGE}</option>
		  <option style="color:brown;" value="brown" class="genmed">{L_COLOR_BROWN}</option>
		  <option style="color:yellow;" value="yellow" class="genmed">{L_COLOR_YELLOW}</option>
		  <option style="color:green;" value="green" class="genmed">{L_COLOR_GREEN}</option>
		  <option style="color:olive;" value="olive" class="genmed">{L_COLOR_OLIVE}</option>
		  <option style="color:cyan;" value="cyan" class="genmed">{L_COLOR_CYAN}</option>
		  <option style="color:blue;" value="blue" class="genmed">{L_COLOR_BLUE}</option>
		  <option style="color:darkblue;" value="darkblue" class="genmed">{L_COLOR_DARK_BLUE}</option>
		  <option style="color:indigo;" value="indigo" class="genmed">{L_COLOR_INDIGO}</option>
		  <option style="color:violet;" value="violet" class="genmed">{L_COLOR_VIOLET}</option>
		  <option style="color:white;" value="white" class="genmed">{L_COLOR_WHITE}</option>
		  <option style="color:black;" value="black" class="genmed">{L_COLOR_BLACK}</option>
		</select>
		&nbsp;&nbsp;&nbsp;{L_FONT_SIZE}:
		<select name="addbbcode18" onChange="bbfontstyle('[size=' + this.form.addbbcode18.options[this.form.addbbcode18.selectedIndex].value + ']', '[/size]')" >
		  <option value="1" class="genmed">size 1</option>
		  <option value="2" class="genmed">size 2</option>
		  <option value="3" selected class="genmed">size 3 (*)</option>
		  <option value="4" class="genmed">size 4</option>
		  <option  value="5" class="genmed">size 5</option>
		  <option  value="6" class="genmed">size 6</option>
		  <option  value="7" class="genmed">size 7</option>
		</select>&nbsp;&nbsp;&nbsp;<a href="{FORUM_LIST}" class="nav">{L_INDEX}</a></span>
	</td>
  </tr>
  <tr>
	<td class="row1" valign="top" width="20%"><span class="gen"><b>{L_ACCESS}</b></span></td>
	<td class="row2" valign="top" width="80%"><span class="gen">{PAGE_ACCESS}</span></td>
  </tr>
  <tr>
	<td class="row1" valign="top" width="20%"><span class="gen"><b>{L_MESSAGE}</b></span><br /><br /><br />
		<span  class="nav"><a href="{U_SMILIES}" onclick="window.open('{U_SMILIES}', '_phpbbsmilies', 'HEIGHT=400,resizable=yes,scrollbars=yes,WIDTH=600');return false;" target="_phpbbsmilies" class="nav">{L_SMILIES}</a></span></td>
	<td class="row2" valign="top" width="80%"><span class="gen"><textarea name="message" rows="30" cols="100" wrap="virtual" tabindex="3" class="post" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);">{MESSAGE}</textarea></span></td>
  </tr>
  <tr>
	<td class="catBottom" colspan="2" align="center" height="28"><input type="hidden" name="bbcode_uid" value="{BBCODE_UID}"><input type="submit" name="submit" class="mainoption" value="{L_SUBMIT}" />&nbsp;&nbsp;&nbsp;<input type="submit" name="cancel" class="liteoption" value="{L_CLOSE}" /></td>
  </tr>
</table>
</form>