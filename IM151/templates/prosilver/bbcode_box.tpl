<script>
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

rtl_help = "{L_BBCODE_RTL_HELP}";
ltr_help = "{L_BBCODE_LTR_HELP}";
plain_help = "{L_BBCODE_PLAIN_HELP}";
fc_help = "{L_BBCODE_FC_HELP}";
fs_help = "{L_BBCODE_FS_HELP}";
ft_help = "{L_BBCODE_FT_HELP}";
right_help = "{L_BBCODE_RIGHT_HELP}";
left_help = "{L_BBCODE_LEFT_HELP}";
center_help = "{L_BBCODE_CENTER_HELP}";
justify_help = "{L_BBCODE_JUSTIFY_HELP}";
b_help = "{L_BBCODE_B_HELP}";
i_help = "{L_BBCODE_I_HELP}";
u_help = "{L_BBCODE_U_HELP}";
strike_help = "{L_BBCODE_STRIKE_HELP}";
sup_help = "{L_BBCODE_SUP_HELP}";
sub_help = "{L_BBCODE_SUB_HELP}";
grad_help ="{L_BBCODE_GRAD_HELP}";
fade_help = "{L_BBCODE_FADE_HELP}";
list_help = "{L_BBCODE_LIST_HELP}";
marqr_help = "{L_BBCODE_MARQR_HELP}";
marql_help = "{L_BBCODE_MARQL_HELP}";
marqu_help = "{L_BBCODE_MARQU_HELP}";
marqd_help = "{L_BBCODE_MARQD_HELP}";
quote_help = "{L_BBCODE_QUOTE_HELP}";
code_help = "{L_BBCODE_CODE_HELP}";
php_help = "{L_BBCODE_PHP_HELP}";
spoil_help = "{L_BBCODE_SPOIL_HELP}";
hide_help = "{L_BBCODE_HIDE_HELP}";
anchor_help = "{L_BBCODE_ANCHOR_HELP}";
url_help = "{L_BBCODE_URL_HELP}";
youtube_help = "{L_BBCODE_YOUTUBE_HELP}";
mail_help = "{L_BBCODE_MAIL_HELP}";
gotopost_help = "{L_BBCODE_GOTOPOST_HELP}";
img_help = "{L_BBCODE_IMG_HELP}";
stream_help="{L_BBCODE_STREAM_HELP}";
//ram_help="{L_BBCODE_RAM_HELP}";
web_help="{L_BBCODE_WEB_HELP}";
video_help="{L_BBCODE_VIDEO_HELP}";
flash_help="{L_BBCODE_FLASH_HELP}";
spell_help = "{L_BBCODE_SPELL_HELP}";
hr_help="{L_BBCODE_HR_HELP}";
you_help = "{L_BBCODE_YOU_HELP}";
tab_help = "{L_BBCODE_TAB_HELP}";
nbsp_help = "{L_BBCODE_NBSP_HELP}";
search_help = "{L_BBCODE_SEARCH_HELP}";
google_help = "{L_BBCODE_GOOGLE_HELP}";
table_help = "{L_BBCODE_TABLE_HELP}";
tip_help = "{L_BBCODE_TIP_HELP}";

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
var hide = 0;

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
    formErrors = "{L_BBCODE_TYPE_MESSAGE}";
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
    caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
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
    var confirmDel = confirm("{L_BBCODE_CONFIRM}");
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
    document.post.fade.src = "{L_ROOT}mods/bbcode_box/images/fade1.gif";
    fade = 1;
  } else {
    ToAdd = "[/fade]";
    document.post.fade.src = "{L_ROOT}mods/bbcode_box/images/fade.gif";
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
      alert("{L_BBCODE_SELECT}");
      return;
    }
      if (oSelectRange.text.length > 120) {
        alert("{L_BBCODE_LESS_120}");
        return;
      }
      showModalDialog("mods/bbcode_box/grad.htm",oSelectRange,"help:no; center:yes; status:no; dialogHeight:50px; dialogWidth:50px");
  }
  else
  {
    alert("{L_BBCODE_NOT_AVAILABLE}");
    return;
  }
}

function BBClist() {
  var ToAdd = "";
  var Result1 = 0;
  while (Result1 == 0)
  {
    var Prompt1 = showPrompt("{L_BBCODE_LIST_BOX}","unordered",1,"{L_BBCODE_LISTBOX_OPTIONS}",/(a|1|unordered|un-ordered)/i,"");
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
        var Prompt2 = showPrompt("{L_BBCODE_LISTBOX_ITEM}","",1,"{L_BBCODE_NO_LISTBOX_ITEM}","","");
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
    document.post.justify.src = "mods/bbcode_box/images/justify1.gif";
    justify = 1;
  } else {
    ToAdd = "[/align]";
    document.post.justify.src = "mods/bbcode_box/images/justify.gif";
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
    document.post.left.src = "mods/bbcode_box/images/left1.gif";
    left = 1;
  } else {
    ToAdd = "[/align]";
    document.post.left.src = "mods/bbcode_box/images/left.gif";
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
    document.post.right.src = "mods/bbcode_box/images/right1.gif";
    right = 1;
  } else {
    ToAdd = "[/align]";
    document.post.right.src = "mods/bbcode_box/images/right.gif";
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
    document.post.center.src = "mods/bbcode_box/images/center1.gif";
    center = 1;
  } else {
    ToAdd = "[/align]";
    document.post.center.src = "mods/bbcode_box/images/center.gif";
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
    document.post.bold.src = "mods/bbcode_box/images/bold1.gif";
    bold = 1;
  } else {
    ToAdd = "[/b]";
    document.post.bold.src = "mods/bbcode_box/images/bold.gif";
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
    document.post.italic.src = "mods/bbcode_box/images/italic1.gif";
    italic = 1;
  } else {
    ToAdd = "[/i]";
    document.post.italic.src = "mods/bbcode_box/images/italic.gif";
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
    document.post.under.src = "mods/bbcode_box/images/under1.gif";
    underline = 1;
  } else {
    ToAdd = "[/u]";
    document.post.under.src = "mods/bbcode_box/images/under.gif";
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
    document.strik.src = "mods/bbcode_box/images/strike1.gif";
    strikeout = 1;
  } else {
    ToAdd = "[/s]";
    document.strik.src = "mods/bbcode_box/images/strike.gif";
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
    document.supscript.src = "mods/bbcode_box/images/sup1.gif";
    superscript = 1;
  } else {
    ToAdd = "[/sup]";
    document.supscript.src = "mods/bbcode_box/images/sup.gif";
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
    document.subs.src = "mods/bbcode_box/images/sub1.gif";
    subscript = 1;
  } else {
    ToAdd = "[/sub]";
    document.subs.src = "mods/bbcode_box/images/sub.gif";
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
    document.post.marqu.src = "mods/bbcode_box/images/marqu1.gif";
    marqu = 1;
  } else {
    ToAdd = "[/marq]";
    document.post.marqu.src = "mods/bbcode_box/images/marqu.gif";
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
    document.post.marql.src = "mods/bbcode_box/images/marql1.gif";
    marql = 1;
  } else {
    ToAdd = "[/marq]";
    document.post.marql.src = "mods/bbcode_box/images/marql.gif";
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
    document.post.marqr.src = "mods/bbcode_box/images/marqr1.gif";
    marqr = 1;
  } else {
    ToAdd = "[/marq]";
    document.post.marqr.src = "mods/bbcode_box/images/marqr.gif";
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
    document.post.marqd.src = "mods/bbcode_box/images/marqd1.gif";
    marqd = 1;
  } else {
    ToAdd = "[/marq]";
    document.post.marqd.src = "mods/bbcode_box/images/marqd.gif";
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
    document.post.code.src = "mods/bbcode_box/images/code1.gif";
    code = 1;
  } else {
    ToAdd = "[/code]";
    document.post.code.src = "mods/bbcode_box/images/code.gif";
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
    document.post.php.src = "mods/bbcode_box/images/php1.gif";
    php = 1;
  } else {
    ToAdd = "[/php]";
    document.post.php.src = "mods/bbcode_box/images/php.gif";
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
    document.post.quote.src = "mods/bbcode_box/images/quote1.gif";
    quote = 1;
  } else {
    ToAdd = "[/quote]";
    document.post.quote.src = "mods/bbcode_box/images/quote.gif";
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
    document.spoil.src = "mods/bbcode_box/images/spoil1.gif";
    spoiler = 1;
  } else {
    ToAdd = "[/spoil]";
    document.spoil.src = "mods/bbcode_box/images/spoil.gif";
    spoiler = 0;
  }
  PostWrite(ToAdd);
}

function BBCanchor() {
  var ToAdd = "";
  var Result1 = 0;
  while (Result1 == 0)
  {
    var Prompt1 = showPrompt("{L_BBCODE_ANCHORNAME}","",1,"{L_BBCODE_NO_ANCHORNAME}",/^[\w-\.]+$/,"{L_BBCODE_BAD_ANCHORNAME}");
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
    var Prompt1 = showPrompt("{L_BBCODE_ENTER_URL}","http://",1,"{L_BBCODE_NO_URL}","","");
    if (Prompt1 == "^pcncl-1")
    {
      Result1 = 1;
    }
    else if (Prompt1 != "^perr-1")
    {
      var Result2 = 0;
      while (Result2 == 0)
      {
        var Prompt2 = showPrompt("{L_BBCODE_ENTER_PAGENAME}","",1,"{L_BBCODE_NO_PAGENAME}","","");
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

function BBCyoutube() {
	var ToAdd = "";
	var Result1 = 0;
	while (Result1 == 0)
	{
		var Prompt1 = showPrompt("{L_BBCODE_YOUTUBE}","http://",1,"{L_BBCODE_NO_YOUTUBE}","","");
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

function BBChide() {
  var txtarea = document.post.message;

  if ((clientVer >= 4) && is_ie && is_win) {
    theSelection = document.selection.createRange().text;
    if (theSelection != '') {
    document.selection.createRange().text = "[hide]" + theSelection + "[/hide]";
    document.post.message.focus();
    return;
    }
  }
  else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
  {
    mozWrap(txtarea, "[hide]", "[/hide]");
    return;
  }
  if (hide == 0) {
    ToAdd = "[hide]";
    document.hide.src = "mods/bbcode_box/images/hide1.gif";
    hide = 1;
  } else {
    ToAdd = "[/hide]";
    document.hide.src = "mods/bbcode_box/images/hide.gif";
    hide = 0;
  }
  PostWrite(ToAdd);
}

function BBCmail() {
  var ToAdd = "";
  var Result1 = 0;
  while (Result1 == 0)
  {
    var Prompt1 = showPrompt("{L_BBCODE_ENTER_EMAIL}","",1,"{L_BBCODE_NO_EMAIL}","","");
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
    var Prompt1 = showPrompt("{L_BBCODE_POSTNUMBER}","",0,"",/^[\d]+$/,"{L_BBCODE_NO_POSTNUMBER}");
    if (Prompt1 == "^pcncl-1")
    {
      Result1 = 1;
    }
    else if (Prompt1 != "^perr-1")
    {
      var Result2 = 0;
      while (Result2 == 0)
      {
        var Prompt2 = showPrompt("{L_BBCODE_ANCHORNAME2}","",0,"",/^[\w-\.]+$/,"{L_BBCODE_BAD_ANCHORNAME");
        if (Prompt2 == "^pcncl-1")
        {
          Result2 = 1;
        }
        else if (Prompt2 != "^perr-1")
        {
          if (Prompt1 == "" && Prompt2 == "")
          {
            alert("{L_BBCODE_NO_ANCHORNAME2}");
            BBCgotopost();
            return false;
          }
          var Result3 = 0;
          while (Result3 == 0)
          {
            var Prompt3 = showPrompt("{L_BBCODE_ENTER_PAGENAME}","",1,"{L_BBCODE_NO_PAGENAME}","","");
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
    var Prompt1 = showPrompt("{L_BBCODE_ENTER_SEARCHTEXT}","",1,"{L_BBCODE_NO_SEARCHTEXT}","","");
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
    var Prompt1 = showPrompt("{L_BBCODE_ENTER_SEARCHTEXT}","",1,"{L_BBCODE_NO_SEARCHTEXT}","","");
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

function BBCimg() {
  var ToAdd = "";
  var imgType = "img";
  var Result1 = 0;

  var confirmSiteimg = confirm("Wil je een image van deze site weergeven?\n\nSite images geven een thumbnail weer van\n een image uit het Album, gelinked aan de grotere image.\n\nKlikken op annuleer zal naar een externe image linken.");

  while (Result1 == 0)
  {
    var Prompt1 = "";
    if (confirmSiteimg)
    {
      Prompt1 = showPrompt("Geef het ID nummer van de image op","",1,"Je hebt geen image ID nummer opgegeven.",/^[\d]+$/,"Alleen nummers zijn toegestaan.");
      imgType = "albumimg"
    }
    else
    {
      Prompt1 = showPrompt("Geef het URL van de image op","http://",1,"Je hebt geen URL opgegeven.","","");
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
        var Prompt2 = showPrompt("Geef de positie van de image op.\nLEFT = Plaats aan de linkerkant van de pagina.\nRIGHT = Plaats aan de rechterkant van de pagina.\nCENTER = Centreren.\nLaat leeg als je geen positie wilt opgeven.","",0,"",/(left|right|center)/i,"Je mag hier alleen het volgende invoeren 'left', 'right', 'center', of leeg laten.");
        if (Prompt2 == "^pcncl-1")
        {
          Result2 = 1;
        }
        else if (Prompt2 != "^perr-1")
        {
          if (Prompt2.toLowerCase() == 'center')
          {
            if (imgType != 'albumimg')
            {
              ToAdd = "[align=center]["+imgType+"]"+Prompt1+"[/"+imgType+"][/align]";
            }
            else
            {
              ToAdd = "[albumimgc]"+Prompt1+"[/albumimgc]";
            }
          }
          else
          {
            if (imgType != 'albumimg')
            {
              ToAdd = "["+imgType;
              if (Prompt2 != '')
              {
                ToAdd += "="+Prompt2.toLowerCase();
              }
              ToAdd += "]"+Prompt1+"[/"+imgType+"]";
            }
            else
            {
              if (Prompt2.toLowerCase() == 'left')
              {
                ToAdd = "[albumimgl]"+Prompt1+"[/albumimgl]";
              }
              else if (Prompt2.toLowerCase() == 'right')
              {
                ToAdd = "[albumimgr]"+Prompt1+"[/albumimgr]";
              }
              else
              {
                ToAdd = "[albumimg]"+Prompt1+"[/albumimg]";
              }
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
  while (Result1  == 0)
  {
    var Prompt1 = showPrompt("Enter URL of web page to include.","http://",1,"You didn't enter a valid URL.","","");
    if (Prompt1 == "^pcncl-1")
    {
      Result1 = 1;
    }
    else if (Prompt1 != "^perr-1")
    {
      var Result2 = 0;
      while (Result2  == 0)
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
</script>