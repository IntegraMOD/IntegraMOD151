/*Temp admin fix to allow image location when used by several files stored in different locations*/
var theSelection = false;

var clientPC = navigator.userAgent.toLowerCase(); // Get client info
var clientVer = parseInt(navigator.appVersion); // Get browser version

var is_ie = ((clientPC.indexOf("msie") != -1) && (clientPC.indexOf("opera") == -1));
var is_nav = ((clientPC.indexOf('mozilla')!=-1) && (clientPC.indexOf('spoofer')==-1)
                && (clientPC.indexOf('compatible') == -1) && (clientPC.indexOf('opera')==-1)
                && (clientPC.indexOf('webtv')==-1) && (clientPC.indexOf('hotjava')==-1));
var is_moz = 0;

var is_win = ((clientPC.indexOf("win")!=-1) || (clientPC.indexOf("16bit") != -1));
var is_mac = (clientPC.indexOf("mac")!=-1);

rtl_help = "Set textbox right to left";
ltr_help = "Set textbox left to right";
plain_help = "Remove BBCodes from the selected text";
fc_help = "Font color: [color=red]text[/color] (You can use HTML color=#FF0000)";
fs_help = "Font size: [size=9]Very Small[/size]";
ft_help = "Font type: [font=Andalus]text[/font]";
right_help = "Right align text: [align=right]text[/align]";
left_help = "Left align text: [align=left]text[/align]";
center_help = "Center align text: [align=center]text[/align]";
justify_help = "Justify text: [align=justify]text[/align]";
b_help = "Bold: [b]text[/b]";
i_help = "Italic: [i]text[/i]";
u_help = "Underline: [u]text[/u]";
strike_help = "Strike-through: [strike]text[/strike]";
sup_help = "Superscript: [sup]text[/sup]";
sub_help = "Subscript: [sub]text[/sub]";
grad_help ="Insert gradient text";
fade_help = "Fade text: [fade]text[/fade]";
list_help = "List: [list(=1|a)][*]item 1[*]item 2[/list]";
marqr_help = "Marquee right: [marq=right]text[/marq]";
marql_help = "Marquee left: [marq=left]text[/marq]";
marqu_help = "Marquee up: [marq=up]text[/marq]";
marqd_help = "Marquee down: [marq=down]text[/marq]";
quote_help = "Quote: [quote]text[/quote]";
code_help = "Code: [code]code[/code]";
php_help = "PHP: [php]php code[/php]";
spoil_help = "Spoiler: [spoil]text[/spoil]";
anchor_help = "Anchor: [anchor]name[/anchor]";
url_help = "Insert URL: [url]http://Site URL[/url] or [url=http://Site URL]Site Name[/url]";
youtube_help = "Insert youtube image: [youtube]http://youtube URL[/youtube]";
googlevid_help = "Insert google video: [GVideo]http://GVideo URL[/GVideo]";
mail_help = "Insert email: [email]Email Here[/email]";
gotopost_help = "Gotopost: [gotopost=post]text[/gotopost] [gotopost=name]text[/gotopost] [gotopost=post,name]text[/gotopost]";
photo_help = "Insert photo image: [photo]http://photo URL[/photo]";
img_help = "Insert image: [img(=left|right|center)]http://image path[/img] [albumimg(l|r|c)]AlbumImage#[/albumimg(l|r|c)]";
stream_help="Insert stream file: [stream]File URL[/stream]";
ram_help="Insert real media file: [ram]File URL[/ram]";
web_help="Insert web page: [web height=#]Page URL[/web]";
video_help="Insert video file: [video width=# height=#]file URL[/video]";
flash_help="Insert flash file: [flash width=# height=#]flash URL[/flash]";
spell_help = "Spell Check: Checks the spelling in the post";
hr_help="Insert H-Line: [hr]";
you_help = "Inserts username of the reader: [you]";
tab_help = "Inserts a tab into post: [tab]";
nbsp_help = "Inserts a non-breaking space into post: [nbsp]";
search_help = "Search site: [search]String to search for[/search]";
google_help = "Google: [google]String to search for[/google]";
table_help = "Creates a Table using BBCode";

var fade = 0;
var center = 0;
var left = 0;
var right = 0;
var justify = 0;
var bold = 0;
var italic = 0;
var underline = 0;
var strikeout = 0;
var superscript = 0;
var subscript = 0;
var marqd = 0;
var marqu = 0;
var marql = 0;
var marqr = 0;
var code = 0;
var quote = 0;
var php = 0;
var spoiler = 0;
var youtube = 0;
var GVideo = 0;

// Fix a bug involving the TextRange object in IE. From
// http://www.frostjedi.com/terra/scripts/demo/caretBug.html
// (script by TerraFrost modified by reddog)
function initInsertions() {
	var baseHeight;
	document.post.message.focus();
	if (is_ie && typeof(baseHeight) != 'number') baseHeight = document.selection.createRange().duplicate().boundingHeight;
}

function helpline(help) {
	document.post.helpbox.value = eval(help + "_help");
	document.post.helpbox.readOnly = "true";
}

function checkForm() {
	formErrors = false;    
	if (document.post.message.value.length < 2) {
		formErrors = "You must enter a message when posting";
	}
	if (formErrors) {
		alert(formErrors);
		return false;
	} else {
		//formObj.preview.disabled = true;
		//formObj.submit.disabled = true;
		return true;
	}
}

function emoticon(text) {
	var txtarea = document.post.message;
	var baseHeight;
	if (is_ie && typeof(baseHeight) != 'number') baseHeight = document.selection.createRange().duplicate().boundingHeight;
	text = ' ' + text + ' ';
	if (txtarea.createTextRange && txtarea.caretPos) {
		if (baseHeight != txtarea.caretPos.boundingHeight) {
			txtarea.focus();
			storeCaret(txtarea);
		}
		var caretPos = txtarea.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? caretPos.text + text + ' ' : caretPos.text + text;
		txtarea.focus();
	} else
	if (txtarea.selectionEnd && (txtarea.selectionStart | txtarea.selectionStart == 0))
	{ 
		mozWrap(txtarea, text, "");
		return;
	} else {
		txtarea.value  += text;
		txtarea.focus();
	}
}

function storeCaret(textEl) {
	if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
}

function PostWrite(text) {
	posttextarea = document.post.message;

	if (posttextarea.createTextRange && posttextarea.caretPos)
	{
		var caretPos = posttextarea.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ?	text + ' ' : text;
		posttextarea.focus(caretPos)
	}
	else if (posttextarea.selectionStart)
	{
		posttextarea.focus();
		scrollTop = posttextarea.scrollTop;
		
		var selLength = posttextarea.textLength;
		var selStart = posttextarea.selectionStart;
		var s1 = (posttextarea.value).substring(0,selStart);
		var s2 = (posttextarea.value).substring(selStart,selLength);
		
		posttextarea.value = s1 + text + s2;
		posttextarea.selectionStart = selStart + text.length;
		posttextarea.selectionEnd = selStart + text.length;
		posttextarea.scrollTop = scrollTop;
		posttextarea.focus();
	}
	else
	{
		posttextarea.value += text;
		posttextarea.focus();
	}
}

function mozWrap(posttextarea, open, close)
{
	posttextarea.focus();
	scrollTop = posttextarea.scrollTop;
	
	var selLength = posttextarea.textLength;
	var selStart = posttextarea.selectionStart;
	var selEnd = posttextarea.selectionEnd;
	if (selEnd == 1 || selEnd == 2) 
		selEnd = selLength;

	var s1 = (posttextarea.value).substring(0,selStart);
	var s2 = (posttextarea.value).substring(selStart, selEnd)
	var s3 = (posttextarea.value).substring(selEnd, selLength);
	posttextarea.value = s1 + open + s2 + close + s3;

	posttextarea.selectionStart = selStart;
	posttextarea.selectionEnd = selEnd + open.length + close.length;
	posttextarea.scrollTop = scrollTop;
	posttextarea.focus();
	return;
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

//----- Start: Prompt Control by Jason Sanborn
// promptMsg = Message to be displayed on Prompt Dialog Box
// promptDefault = Default text to be displayed in the Prompt Dialog Box
// promptReq = Data Required? 0-False, 1-True
// promptReqErr = Error message to display if Required data not entered
// promptRegEx = Regular Expression to validate data
// promptRegExErr = Error message to display if RegEx fails to validate data
function showPrompt(promptMsg,promptDefault,promptReq,promptReqErr,promptRegExp,promptRegExpErr)
{
	if (is_ie)
	{
		promptMsg = promptMsg.replace(/\n/gi," ");
		promptMsg = promptMsg.replace(/  /gi," ");
	}
	var promptVal = prompt(promptMsg,promptDefault);
	if (promptVal == null)
	{
		return "^pcncl-1";
	}
	else
	{
		var retVal = trim(promptVal);
		if (retVal == '' && promptReq == 1)
		{
			alert(promptReqErr);
			return "^perr-1";
		}
		else
		{
			if (retVal !='' && promptRegExp != '')
			{
				var regMatch = promptRegExp;
				if (regMatch.test(retVal))
				{
					return retVal;
				}
				else
				{
					alert(promptRegExpErr);
					return "^perr-1";
				}
			}
			else
			{
				return retVal;
			}
		}
	}
}

// JavaScript Trim: http://artlung.com/blog/2006/04/21/javascript-trim-function/
function trim(str)
{
while(''+str.charAt(0)==' ')
str=str.substring(1,str.length);
while(''+str.charAt(str.length-1)==' ')
str=str.substring(0,str.length-1);
return str;
}
//----- End: Prompt Control by Jason Sanborn

function BBCdir(dirc) {
       document.post.message.dir=(dirc);
}

function BBCplain() {
	if (is_ie)
	{
		theSelection = document.selection.createRange().text;
	}
	else
	{
		posttextarea = document.post.message;
		start = posttextarea.selectionStart;
		end = posttextarea.selectionEnd;
		scrollTop = posttextarea.scrollTop;
		theSelection=(posttextarea.value).substring(start,end);
	}
	if (theSelection == '')
	{
		var confirmDel = confirm("Are you sure that you want to erase all BBCodes in this post?\n\nThis action cannot be undone.");
		if (confirmDel)
		{
			posttextarea = document.post.message;
			posttextarea.select();
			if (is_ie)
			{
				theSelection = document.selection.createRange().text;
			}
			else
			{
				start = posttextarea.selectionStart;
				end = posttextarea.selectionEnd;
				scrollTop = posttextarea.scrollTop;
				theSelection=(posttextarea.value).substring(start,end);
			}
		}
	}
	if (theSelection != '')
	{
		temp = theSelection;
		temp = temp.replace(/\[FLASH=([^\]]*)\]WIDTH=[0-9]{0,4} HEIGHT=[0-9]{0,4}\[\/FLASH\]/gi,"$1");
		temp = temp.replace(/\[VIDEO=([^\]]*)\]WIDTH=[0-9]{0,4} HEIGHT=[0-9]{0,4}\[\/VIDEO\]/gi,"$1");
		temp = temp.replace(/\[[^\]]*\]/gi,"");
		if (is_ie)
		{
			document.selection.createRange().text = temp;
		}
		else
		{
			endtext=posttextarea.value.substring(end,posttextarea.textLength);
			starttext=posttextarea.value.substring(0,start);
			lendiff = theSelection.length - temp.length;
			posttextarea.value = starttext + temp + endtext;
			posttextarea.selectionStart = start;
			posttextarea.selectionEnd = end - lendiff;
			posttextarea.scrollTop = scrollTop;

			posttextarea.focus();
		}
	}
}

function BBCft() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[font="+document.post.ft.value+"]" + theSelection + "[/font]";
		document.post.message.focus();
		document.post.ft[0].selected = true;
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[font="+document.post.ft.value+"]", "[/font]");
		document.post.ft[0].selected = true;
		return;
	}
	ToAdd = "[font="+document.post.ft.value+"]"+" "+"[/font]";
	document.post.ft[0].selected = true;
	PostWrite(ToAdd);
}

function BBCfs() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[size="+document.post.fs.value+"]" + theSelection + "[/size]";
		document.post.message.focus();
		document.post.fs[0].selected = true;
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[size="+document.post.fs.value+"]", "[/size]");
		document.post.fs[0].selected = true;
		return;
	}
	ToAdd = "[size="+document.post.fs.value+"]"+" "+"[/size]";
	document.post.fs[0].selected = true;
	PostWrite(ToAdd);
}

function BBCfc() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[color="+document.post.fc.value+"]" + theSelection + "[/color]";
		document.post.message.focus();
		document.post.fc[0].selected = true;
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[color="+document.post.fc.value+"]", "[/color]");
		document.post.fc[0].selected = true;
		return;
	}
	ToAdd = "[color="+document.post.fc.value+"]"+" "+"[/color]";
	document.post.fc[0].selected = true;
	PostWrite(ToAdd);
}

function BBCfade() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[fade]" + theSelection + "[/fade]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[fade]", "[/fade]");
		return;
	}
	if (fade == 0) {
		ToAdd = "[fade]";
		document.post.fade.src = "./../mods/bbcode_box/images/fade1.gif";
		fade = 1;
	} else {
		ToAdd = "[/fade]";
		document.post.fade.src = "./../mods/bbcode_box/images/fade.gif";
		fade = 0;
	}
	PostWrite(ToAdd);
}

function BBCgrad() {
    if ((clientVer >= 4) && is_ie && is_win)
	{
		var oSelect,oSelectRange;
	    document.post.message.focus();
	    oSelect = document.selection;
	    oSelectRange = oSelect.createRange();
	    if (oSelectRange.text.length < 1) {
			alert("Please select the text first");
			return;
		}
	    if (oSelectRange.text.length > 120) {
	      alert("This only works for less than 120 letters");
	      return;
	    }
	    showModalDialog("mods/bbcode_box/grad.htm",oSelectRange,"help:no; center:yes; status:no; dialogHeight:50px; dialogWidth:50px");
	}
	else
	{
		alert("Gradient is not available on your browser.");
		return;
	}
}

function BBClist() {
	var ToAdd = "";
	var Result1 = 0;
	while (Result1 == 0)
	{
		var Prompt1 = showPrompt("Enter list type:\n'1' for numbered list,\n'a' for alphabetical list,\n'unordered' for an unordered list","unordered",1,"Valid options are '1', 'a' or 'unordered'.",/(a|1|unordered|un-ordered)/i,"");
		if (Prompt1 == "^pcncl-1")
		{
			Result1 = 1;
		}
		else if (Prompt1 != "^perr-1")
		{
			ToAdd = "[list";
			if (Prompt1 == "1" || Prompt1 == "a" || Prompt1 == "A")
			{
				ToAdd += "="+Prompt1.toLowerCase();
			}
			ToAdd += "]";
			
			var Result2 = 0;
			while (Result2 == 0)
			{
				var Prompt2 = showPrompt("Enter the list item.\n\nPress 'Cancel' to End.","",1,"You didn't enter a list item.","","");
				if (Prompt2 == "^pcncl-1")
				{
					Result2 = 1;
				}
				else if (Prompt2 != "^perr-1")
				{
					ToAdd += "[*]"+Prompt2;
				}
			}
			ToAdd += "[/list]"
			Result1 = 1;
		}
	}
	PostWrite(ToAdd);
}

function BBCjustify() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=justify]" + theSelection + "[/align]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[align=justify]", "[/align]");
		return;
	}
	if (justify == 0) {
		ToAdd = "[align=justify]";
		document.post.justify.src = "./../mods/bbcode_box/images/justify1.gif";
		justify = 1;
	} else {
		ToAdd = "[/align]";
		document.post.justify.src = "./../mods/bbcode_box/images/justify.gif";
		justify = 0;
	}
	PostWrite(ToAdd);
}

function BBCleft() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=left]" + theSelection + "[/align]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[align=left]", "[/align]");
		return;
	}
	if (left == 0) {
		ToAdd = "[align=left]";
		document.post.left.src = "./../mods/bbcode_box/images/left1.gif";
		left = 1;
	} else {
		ToAdd = "[/align]";
		document.post.left.src = "./../mods/bbcode_box/images/left.gif";
		left = 0;
	}
	PostWrite(ToAdd);
}

function BBCright() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=right]" + theSelection + "[/align]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[align=right]", "[/align]");
		return;
	}
	if (right == 0) {
		ToAdd = "[align=right]";
		document.post.right.src = "./../mods/bbcode_box/images/right1.gif";
		right = 1;
	} else {
		ToAdd = "[/align]";
		document.post.right.src = "./../mods/bbcode_box/images/right.gif";
		right = 0;
	}
	PostWrite(ToAdd);
}

function BBCcenter() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=center]" + theSelection + "[/align]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[align=center]", "[/align]");
		return;
	}
	if (center == 0) {
		ToAdd = "[align=center]";
		document.post.center.src = "./../mods/bbcode_box/images/center1.gif";
		center = 1;
	} else {
		ToAdd = "[/align]";
		document.post.center.src = "./../mods/bbcode_box/images/center.gif";
		center = 0;
	}
	PostWrite(ToAdd);
}

function BBCbold() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[b]" + theSelection + "[/b]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[b]", "[/b]");
		return;
	}
	if (bold == 0) {
		ToAdd = "[b]";
		document.post.bold.src = "./../mods/bbcode_box/images/bold1.gif";
		bold = 1;
	} else {
		ToAdd = "[/b]";
		document.post.bold.src = "./../mods/bbcode_box/images/bold.gif";
		bold = 0;
	}
	PostWrite(ToAdd);
}

function BBCitalic() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[i]" + theSelection + "[/i]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[i]", "[/i]");
		return;
	}
	if (italic == 0) {
		ToAdd = "[i]";
		document.post.italic.src = "./../mods/bbcode_box/images/italic1.gif";
		italic = 1;
	} else {
		ToAdd = "[/i]";
		document.post.italic.src = "./../mods/bbcode_box/images/italic.gif";
		italic = 0;
	}
	PostWrite(ToAdd);
}

function BBCunder() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[u]" + theSelection + "[/u]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[u]", "[/u]");
		return;
	}
	if (underline == 0) {
		ToAdd = "[u]";
		document.post.under.src = "./../mods/bbcode_box/images/under1.gif";
		underline = 1;
	} else {
		ToAdd = "[/u]";
		document.post.under.src = "./../mods/bbcode_box/images/under.gif";
		underline = 0;
	}
	PostWrite(ToAdd);
}

function BBCstrike() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[s]" + theSelection + "[/s]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[s]", "[/s]");
		return;
	}
	if (strikeout == 0) {
		ToAdd = "[s]";
		document.strik.src = "./../mods/bbcode_box/images/strike1.gif";
		strikeout = 1;
	} else {
		ToAdd = "[/s]";
		document.strik.src = "./../mods/bbcode_box/images/strike.gif";
		strikeout = 0;
	}
	PostWrite(ToAdd);
}

function BBCsup() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[sup]" + theSelection + "[/sup]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[sup]", "[/sup]");
		return;
	}
	if (superscript == 0) {
		ToAdd = "[sup]";
		document.supscript.src = "./../mods/bbcode_box/images/sup1.gif";
		superscript = 1;
	} else {
		ToAdd = "[/sup]";
		document.supscript.src = "./../mods/bbcode_box/images/sup.gif";
		superscript = 0;
	}
	PostWrite(ToAdd);
}

function BBCsub() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[sub]" + theSelection + "[/sub]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[sub]", "[/sub]");
		return;
	}
	if (subscript == 0) {
		ToAdd = "[sub]";
		document.subs.src = "./../mods/bbcode_box/images/sub1.gif";
		subscript = 1;
	} else {
		ToAdd = "[/sub]";
		document.subs.src = "./../mods/bbcode_box/images/sub.gif";
		subscript = 0;
	}
	PostWrite(ToAdd);
}

function BBCmarqu() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=up]" + theSelection + "[/marq]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[marq=up]", "[/marq]");
		return;
	}
	if (marqu == 0) {
		ToAdd = "[marq=up]";
		document.post.marqu.src = "./../mods/bbcode_box/images/marqu1.gif";
		marqu = 1;
	} else {
		ToAdd = "[/marq]";
		document.post.marqu.src = "./../mods/bbcode_box/images/marqu.gif";
		marqu = 0;
	}
	PostWrite(ToAdd);
}

function BBCmarql() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=left]" + theSelection + "[/marq]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[marq=left]", "[/marq]");
		return;
	}
	if (marql == 0) {
		ToAdd = "[marq=left]";
		document.post.marql.src = "./../mods/bbcode_box/images/marql1.gif";
		marql = 1;
	} else {
		ToAdd = "[/marq]";
		document.post.marql.src = "./../mods/bbcode_box/images/marql.gif";
		marql = 0;
	}
	PostWrite(ToAdd);
}

function BBCmarqr() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=right]" + theSelection + "[/marq]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[marq=right]", "[/marq]");
		return;
	}
	if (marqr == 0) {
		ToAdd = "[marq=right]";
		document.post.marqr.src = "./../mods/bbcode_box/images/marqr1.gif";
		marqr = 1;
	} else {
		ToAdd = "[/marq]";
		document.post.marqr.src = "./../mods/bbcode_box/images/marqr.gif";
		marqr = 0;
	}
	PostWrite(ToAdd);
}

function BBCmarqd() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=down]" + theSelection + "[/marq]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[marq=down]", "[/marq]");
		return;
	}
	if (marqd == 0) {
		ToAdd = "[marq=down]";
		document.post.marqd.src = "./../mods/bbcode_box/images/marqd1.gif";
		marqd = 1;
	} else {
		ToAdd = "[/marq]";
		document.post.marqd.src = "./../mods/bbcode_box/images/marqd.gif";
		marqd = 0;
	}
	PostWrite(ToAdd);
}

function BBCcode() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[code]" + theSelection + "[/code]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[code]", "[/code]");
		return;
	}	
	if (code == 0) {
		ToAdd = "[code]";
		document.post.code.src = "./../mods/bbcode_box/images/code1.gif";
		code = 1;
	} else {
		ToAdd = "[/code]";
		document.post.code.src = "./../mods/bbcode_box/images/code.gif";
		code = 0;
	}
	PostWrite(ToAdd);
}

function BBCphp() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[php]" + theSelection + "[/php]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[php]", "[/php]");
		return;
	}	
	if (php == 0) {
		ToAdd = "[php]";
		document.post.php.src = "./../mods/bbcode_box/images/php1.gif";
		php = 1;
	} else {
		ToAdd = "[/php]";
		document.post.php.src = "./../mods/bbcode_box/images/php.gif";
		php = 0;
	}
	PostWrite(ToAdd);
}

function BBCquote() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[quote]" + theSelection + "[/quote]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[quote]", "[/quote]");
		return;
	}
	if (quote == 0) {
		ToAdd = "[quote]";
		document.post.quote.src = "./../mods/bbcode_box/images/quote1.gif";
		quote = 1;
	} else {
		ToAdd = "[/quote]";
		document.post.quote.src = "./../mods/bbcode_box/images/quote.gif";
		quote = 0;
	}
	PostWrite(ToAdd);
}

function BBCspoil() {
	var txtarea = document.post.message;
	
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[spoil]" + theSelection + "[/spoil]";
		document.post.message.focus();
		return;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		mozWrap(txtarea, "[spoil]", "[/spoil]");
		return;
	}
	if (spoiler == 0) {
		ToAdd = "[spoil]";
		document.spoil.src = "./../mods/bbcode_box/images/spoil1.gif";
		spoiler = 1;
	} else {
		ToAdd = "[/spoil]";
		document.spoil.src = "./../mods/bbcode_box/images/spoil.gif";
		spoiler = 0;
	}
	PostWrite(ToAdd);
}

function BBCanchor() {
	var ToAdd = "";
	var Result1 = 0;
	while (Result1 == 0)
	{
		var Prompt1 = showPrompt("Enter the anchor name.\n\nAnchor name must be one word, alphanumeric","",1,"You didn't enter the anchor name.",/^[\w-\.]+$/,"Anchor name can only contain letters or numbers.");
		if (Prompt1 == "^pcncl-1")
		{
			Result1 = 1;
		}
		else if (Prompt1 != "^perr-1")
		{
			ToAdd = "[anchor]"+Prompt1+"[/anchor]";
			Result1 = 1;
		}
	}
	PostWrite(ToAdd);
}

function BBCurl() {
	var ToAdd = "";
	var Result1 = 0;
	while (Result1 == 0)
	{
		var Prompt1 = showPrompt("Enter the URL","http://",1,"You didn't enter the URL.","","");
		if (Prompt1 == "^pcncl-1")
		{
			Result1 = 1;
		}
		else if (Prompt1 != "^perr-1")
		{
			var Result2 = 0;
			while (Result2 == 0)
			{
				var Prompt2 = showPrompt("Enter the name of the page","",1,"You didn't enter the page name.","","");
				if (Prompt2 == "^pcncl-1")
				{
					Result2 = 1;
				}
				else if (Prompt2 != "^perr-1")
				{
					ToAdd = "[url="+Prompt1+"]"+Prompt2+"[/url]";
					Result2 = 1;
				}
			}
			Result1 = 1;
		}
	}
	PostWrite(ToAdd);
}

function BBCGVideo() {
	var FoundErrors = '';
	var enterURL   = prompt("Enter the movie URL", "http://");
	if (!enterURL)    {
		FoundErrors += " You didn't write the file URL";
	}
	if (FoundErrors)  {
		alert("Error:"+FoundErrors);
		return;
	}
	var ToAdd = "[GVideo]"+enterURL+"[/GVideo]";
	PostWrite(ToAdd);
}

function BBCyoutube() {
	var ToAdd = "";
	var Result1 = 0;
	while (Result1 == 0)
	{
		var Prompt1 = showPrompt("Enter the YouTube URL","http://",1,"You didn't enter the YouTube URL.","","");
		if (Prompt1 == "^pcncl-1")
		{
			Result1 = 1;
		}
		else if (Prompt1 != "^perr-1")
		{
			ToAdd = "[youtube]"+Prompt1+"[/youtube]";
			Result1 = 1;
		}
	}
	PostWrite(ToAdd);
}

function BBCmail() {
	var ToAdd = "";
	var Result1 = 0;
	while (Result1 == 0)
	{
		var Prompt1 = showPrompt("Enter the email address.","",1,"You didn't enter an email address.","","");
		if (Prompt1 == "^pcncl-1")
		{
			Result1 = 1;
		}
		else if (Prompt1 != "^perr-1")
		{
			ToAdd = "[email]"+Prompt1+"[/email]";
			Result1 = 1;
		}
	}
	PostWrite(ToAdd);
}

function BBCgotopost() {
	var ToAdd = "";
	var Result1 = 0;
	while (Result1 == 0)
	{
		var Prompt1 = showPrompt("Enter the post number. (Optional)\nNote: Either a post number or an anchor name is required.","",0,"",/^[\d]+$/,"Only numbers are allowed.");
		if (Prompt1 == "^pcncl-1")
		{
			Result1 = 1;
		}
		else if (Prompt1 != "^perr-1")
		{
			var Result2 = 0;
			while (Result2 == 0)
			{
				var Prompt2 = showPrompt("Enter the anchor name. (Optional)\nAnchor name must be one word, alphanumeric.\nNote: Either a post number or an anchor name is required.","",0,"",/^[\w-\.]+$/,"Anchor name can only contain letters or numbers.");
				if (Prompt2 == "^pcncl-1")
				{
					Result2 = 1;
				}
				else if (Prompt2 != "^perr-1")
				{
					if (Prompt1 == "" && Prompt2 == "")
					{
						alert("You didn't enter a post number nor an anchor name.\nYou must enter either a post number, an anchor name, or both.");
						BBCgotopost();
						return false;
					}
					var Result3 = 0;
					while (Result3 == 0)
					{
						var Prompt3 = showPrompt("Enter the name of the page","",1,"You didn't enter the page name.","","");
						if (Prompt3 == "^pcncl-1")
						{
							Result3 =1;
						}
						else if (Prompt3 != "^perr-1")
						{
							ToAdd = "[gotopost="+Prompt1;
							if (Prompt1 && Prompt2)
							{
								ToAdd += ",";
							}
							if (Prompt2 != "")
							{
								ToAdd += Prompt2;
							}
							ToAdd += "]"+Prompt3+"[/gotopost]";
							Result3 = 1;
						}
					}
					Result2 = 1;
				}
			}
			Result1 = 1;
		}
	}
	PostWrite(ToAdd);
}

function BBCsearch() {
	var ToAdd = "";
	var Result1 = 0;
	while (Result1 == 0)
	{
		var Prompt1 = showPrompt("Enter text to search for.","",1,"You didn't enter a search string.","","");
		if (Prompt1 == "^pcncl-1")
		{
			Result1 = 1;
		}
		else if (Prompt1 != "^perr-1")
		{
			ToAdd = "[search]"+Prompt1+"[/search]";
			Result1 = 1;
		}
	}
	PostWrite(ToAdd);
}

function BBCgoogle() {
	var ToAdd = "";
	var Result1 = 0;
	while (Result1 == 0)
	{
		var Prompt1 = showPrompt("Enter text to search for.","",1,"You didn't enter a search string.","","");
		if (Prompt1 == "^pcncl-1")
		{
			Result1 = 1;
		}
		else if (Prompt1 != "^perr-1")
		{
			ToAdd = "[google]"+Prompt1+"[/google]";
			Result1 = 1;
		}
	}
	PostWrite(ToAdd);
}

function BBCphoto() {
	var ToAdd = "";
	var Result1 = 0;
	while (Result1 == 0)
	{
		var Prompt1 = showPrompt("Enter the photo URL","http://",1,"You didn't enter the photo URL.","","");
		if (Prompt1 == "^pcncl-1")
		{
			Result1 = 1;
		}
		else if (Prompt1 != "^perr-1")
		{
			ToAdd = "[photo]"+Prompt1+"[/photo]";
			Result1 = 1;
		}
	}
	PostWrite(ToAdd);
}

function BBCimg() {
	var ToAdd = "";
	var imgType = "img";
	var Result1 = 0;

	var confirmSiteimg = confirm("Do you want to display an album image?\n\nThis will display an image from\nthe image gallery.\n\nCancel will link to an external image.");

	while (Result1 == 0)
	{
		var Prompt1 = "";
		if (confirmSiteimg)
		{
			var confirmFullimg = confirm("Do you want the image to be displayed as a thumbnail?\n\nClick cancel if you want the image to be displayed at full size.");
			if (confirmFullimg)
			{
				Prompt1 = showPrompt("Enter the gallery image number","",1,"You didn't enter the image number.",/^[\d]+$/,"Only numbers are allowed.");
				imgType = "albumimg";
			}
			else
			{
				Prompt1 = showPrompt("Enter the gallery image number","",1,"You didn't enter the image number.",/^[\d]+$/,"Only numbers are allowed.");
				imgType = "fullalbumimg";
			}
		}
		else
		{
			Prompt1 = showPrompt("Enter the image URL","http://",1,"You didn't enter the image URL.","","");
		}
		if (Prompt1 == "^pcncl-1")
		{
			Result1 = 1;
		}
		else if (Prompt1 != "^perr-1")
		{
			var Result2 = 0;
			while (Result2 == 0)
			{
var Prompt2 = showPrompt("Enter image position.\nLEFT = Position to left of text.\nRIGHT = Position to right of text.\nCENTER = Center in line.\nLeave blank for no positioning.","",0,"",/(left|right|center)/i,"Valid options are 'left', 'right', 'center', or leave blank.");
            if (Prompt2 == "^pcncl-1")
            {
               Result2 = 1;
            }
            else if (Prompt2 != "^perr-1")
            {
                  if (Prompt2.toLowerCase() == 'left')
               {
                  if (imgType == "img")
                  {
                     Prompt2 = "=left";
                  }
                  else
                  {
                     Prompt2 = "=left";
                  }
               }
               if (Prompt2.toLowerCase() == 'right')
               {
                  if (imgType == "img")
                  {
                     Prompt2 = "=right";
                  }
                  else
                  {
                     Prompt2 = "=right";
                  }
               }
               if (Prompt2.toLowerCase() == 'center')
               {
                  if (imgType == "img")
                  {
                     Prompt2 = "=center";
                  }
                  else
                  {
                     Prompt2 = "=center";
                  }
               }
                  ToAdd = "";
               if (Prompt2 != '')
               {
               if (imgType == "img")
                {
                  ToAdd += "[img"+Prompt2.toLowerCase()+"]"+Prompt1+"[/"+imgType+"]";
                }
               else
                {
                  ToAdd += "[align"+Prompt2.toLowerCase()+"]["+imgType+"]"+Prompt1+"[/"+imgType+"][/align]";
                }
               
               }
               else
               {
               ToAdd += "["+imgType+"]"+Prompt1+"[/"+imgType+"]";
            }
            }
            Result2 = 1;
			}
			Result1 = 1;
		}
	}
	PostWrite(ToAdd);
}

function BBCram() {
	var ToAdd = "";
	var Result1 = 0;
	while (Result1 == 0)
	{
		var Prompt1 = showPrompt("Enter the URL to the Real Media stream.","http://",1,"You didn't enter the URL.","","");
		if (Prompt1 == "^pcncl-1")
		{
			Result1 = 1;
		}
		else if (Prompt1 != "^perr-1")
		{
			var Result2 = 0;
			while (Result2 == 0)
			{
				var Prompt2 = showPrompt("Enter the width of the control.","220",1,"You didn't enter a width.",/^[\d]+$/,"Only numbers are allowed.");
				if (Prompt2 == "^pcncl-1")
				{
					Result2 = 1;
				}
				else if (Prompt2 != "^perr-1")
				{
					var Result3 = 0;
					while (Result3 == 0)
					{
						var Prompt3 = showPrompt("Enter the height of the control.","140",1,"You didn't enter a height.",/^[\d]+$/,"Only numbers are allowed.");
						if (Prompt3 == "^pcncl-1")
						{
							Result3 =1;
						}
						else if (Prompt3 != "^perr-1")
						{
							ToAdd = "[ram width="+Prompt2+" height="+Prompt3+"]"+Prompt1+"[/ram]";
							Result3 = 1;
						}
					}
					Result2 = 1;
				}
			}
			Result1 = 1;
		}
	}
	PostWrite(ToAdd);
}

function BBCstream() {
	var ToAdd = "";
	var Result1 = 0;
	while (Result1 == 0)
	{
		var Prompt1 = showPrompt("Enter URL of sound file.","http://",1,"You didn't enter a valid URL.","","");
		if (Prompt1 == "^pcncl-1")
		{
			Result1 = 1;
		}
		else if (Prompt1 != "^perr-1")
		{
			ToAdd = "[stream]"+Prompt1+"[/stream]";
			Result1 = 1;
		}
	}
	PostWrite(ToAdd);
}

function BBCvideo() {
	var ToAdd = "";
	var Result1 = 0;
	while (Result1 == 0)
	{
		var Prompt1 = showPrompt("Enter the URL of the video file.","http://",1,"You didn't enter the URL.","","");
		if (Prompt1 == "^pcncl-1")
		{
			Result1 = 1;
		}
		else if (Prompt1 != "^perr-1")
		{
			var Result2 = 0;
			while (Result2 == 0)
			{
				var Prompt2 = showPrompt("Enter the width of the control.","400",1,"You didn't enter a width.",/^[\d]+$/,"Only numbers are allowed.");
				if (Prompt2 == "^pcncl-1")
				{
					Result2 = 1;
				}
				else if (Prompt2 != "^perr-1")
				{
					var Result3 = 0;
					while (Result3 == 0)
					{
						var Prompt3 = showPrompt("Enter the height of the control.","350",1,"You didn't enter a height.",/^[\d]+$/,"Only numbers are allowed.");
						if (Prompt3 == "^pcncl-1")
						{
							Result3 =1;
						}
						else if (Prompt3 != "^perr-1")
						{
							ToAdd = "[video width="+Prompt2+" height="+Prompt3+"]"+Prompt1+"[/video]";
							Result3 = 1;
						}
					}
					Result2 = 1;
				}
			}
			Result1 = 1;
		}
	}
	PostWrite(ToAdd);
}

function BBCweb() {
	var ToAdd = "";
	var Result1 = 0;
	while (Result1 == 0)
	{
		var Prompt1 = showPrompt("Enter URL of web page to include.","http://",1,"You didn't enter a valid URL.","","");
		if (Prompt1 == "^pcncl-1")
		{
			Result1 = 1;
		}
		else if (Prompt1 != "^perr-1")
		{
			var Result2 = 0;
			while (Result2 == 0)
			{
				var Prompt2 = showPrompt("Enter the height of the iframe.","350",1,"You didn't enter a height.",/^[\d]+$/,"Only numbers are allowed.");
				if (Prompt2 == "^pcncl-1")
				{
					Result2 =1;
				}
				else if (Prompt2 != "^perr-1")
				{
					ToAdd = "[web height="+Prompt2+"]"+Prompt1+"[/web]";
					Result2 = 1;
				}
			}
			Result1 = 1;
		}
	}
	PostWrite(ToAdd);
}

function BBCflash() {
	var ToAdd = "";
	var Result1 = 0;
	while (Result1 == 0)
	{
		var Prompt1 = showPrompt("Enter the URL of the Flash file.","http://",1,"You didn't enter the URL.","","");
		if (Prompt1 == "^pcncl-1")
		{
			Result1 = 1;
		}
		else if (Prompt1 != "^perr-1")
		{
			var Result2 = 0;
			while (Result2 == 0)
			{
				var Prompt2 = showPrompt("Enter the width of the control.","250",1,"You didn't enter a width.",/^[\d]+$/,"Only numbers are allowed.");
				if (Prompt2 == "^pcncl-1")
				{
					Result2 = 1;
				}
				else if (Prompt2 != "^perr-1")
				{
					var Result3 = 0;
					while (Result3 == 0)
					{
						var Prompt3 = showPrompt("Enter the height of the control.","250",1,"You didn't enter a height.",/^[\d]+$/,"Only numbers are allowed.");
						if (Prompt3 == "^pcncl-1")
						{
							Result3 =1;
						}
						else if (Prompt3 != "^perr-1")
						{
							ToAdd = "[flash width="+Prompt2+" height="+Prompt3+"]"+Prompt1+"[/flash]";
							Result3 = 1;
						}
					}
					Result2 = 1;
				}
			}
			Result1 = 1;
		}
	}
	PostWrite(ToAdd);
}

function BBChr() {
	ToAdd = "[hr]";
	PostWrite(ToAdd);
}

function BBCnbsp() {
	ToAdd = "[nbsp]";
	PostWrite(ToAdd);
}

function BBCtab() {
	ToAdd = "[tab]";
	PostWrite(ToAdd);
}

function BBCyou() {
	ToAdd = "[you]";
	PostWrite(ToAdd);
}

function BBCtable()
{
	var ToAdd = "";
	var cols = 0;
	var rows = 0;

	var confirmAdvanced = confirm("Do you want to create an advanced table?\n\nAdvanced tables allow you to specify the\nbackground color and font size for each cell.\n\nCancel will create a basic table.");
	var confirmHeader = confirm("Do you want a header row?\n\nCancel will not create a header row.")

	var Result1 = 0;
	while (Result1 == 0)
	{
		var Prompt1 = showPrompt("How many columns in your table?","",1,"You didn't enter a number.",/^[\d]+$/,"Only numbers are allowed.");
		if (Prompt1 == "^pcncl-1")
		{
			Result1 = 1;
		}
		else if (Prompt1 != "^perr-1")
		{
			if (Prompt1 < 1)
			{
				alert("You cannot have less than 1 column.");
			}
			else
			{
				var Result2 = 0;
				while (Result2 == 0)
				{
					var Prompt2  = showPrompt("How many rows in your table?","",1,"You didn't enter a number.",/^[\d]+$/,"Only numbers are allowed.");
					if (Prompt2 == "^pcncl-1")
					{
						Result2 = 1;
					}
					else if (Prompt2 != "^perr-1")
					{
						if (Prompt2 < 1)
						{
							alert("You cannot have less than 1 row.");
						}
						else
						{
							cols = Prompt1;
							rows = Prompt2;
							Result2 = 1;
						}
					}
				}
				Result1 = 1;
			}
		}
	}

	if (rows != 0 && cols != 0)
	{
		var rowIndex = 0;
		var colIndex = 0;
		
		ToAdd = "[table";
		if (confirmAdvanced)
		{
			ToAdd += tableColorFont("the table");
		}
		ToAdd += "]";
		
		if (confirmHeader)
		{
			while (colIndex < cols)
			{
				if (colIndex == 0)
				{
					ToAdd += "[mrow";
				}
				else
				{
					ToAdd += "[mcol";
				}
				if (confirmAdvanced)
				{
					ToAdd += tableColorFont("Column Header "+(colIndex+1));
				}
				ToAdd += "]";
				
				var Prompt3 = showPrompt("Column Header "+(colIndex+1)+" Value:","",0,"","","");
				if (Prompt3 == "^pcncl-1")
				{
					Prompt3 = "";
				}
				ToAdd += Prompt3;
				colIndex++
			}
			colIndex = 0;
		}
		
		while (rowIndex < rows)
		{
			while (colIndex < cols)
			{
				if (colIndex == 0)
				{
					ToAdd += "[row";
				}
				else
				{
					ToAdd += "[col";
				}
				if (confirmAdvanced)
				{
					ToAdd += tableColorFont("Row "+(rowIndex+1)+", Column "+(colIndex+1));
				}
				ToAdd += "]";
				
				var Prompt4 = showPrompt("Row "+(rowIndex+1)+", Column "+(colIndex+1)+" Value:","",0,"","","");
				if (Prompt4 == "^pcncl-1")
				{
					Prompt4 = "";
				}
				ToAdd += Prompt4;
				colIndex++
			}
			colIndex = 0;
			rowIndex++
		}
		
		ToAdd += "[/table]";
	}

	PostWrite(ToAdd);
}

function tableColorFont(item)
{
	var retVal = "";
	var Prompt1 = showPrompt("What is the color for "+item+"?\nLeave blank if you don't want to set a color.","",0,"","","");
	if (Prompt1 != "" && Prompt1 != "^pcncl-1")
	{
		retVal += " color="+Prompt1;
	}
	var Result2 = 0;
	while (Result2 == 0)
	{
		var Prompt2 = showPrompt("What is the font size for "+item+"?\nLeave blank if you don't want to set a font size.","",0,"",/^[\d]+$/,"Only numbers are allowed.");
		if (Prompt2 == "^pcncl-1" || Prompt2 == "")
		{
			Result2 = 1;
		}
		else if (Prompt2 != "^perr-1")
		{
			retVal += " fontsize="+Prompt2;
			Result2 = 1;
		}
	}
	return retVal;
}