<script type="text/javascript">
    <!-- Hide Javascript from validators
    function toggleAllForums () {
      // If any particular forum is selected, this will unselect or select the all forums checkbox
      if (document.subscribe.all_forums.checked)
        document.subscribe.all_forums.checked = false;
      return;
    }
    function unCheckSubscribedForums (checkbox) {
      // If all forums checkbox is checked, must uncheck all the individual forums. This
      // involves some fancy Javascript due to IE's proprietary DOM, darn them.
      var isW3C = false;
      var isIE = false;
      is_checked= checkbox.checked;
         
      if (!(document.all)) isW3C=true; /* standard compliant DOM, probably */
      if (document.all) isIE=true;

      // Check/Uncheck for IE DOM
      var element_name = new String();
      if (isIE) {
        for(i=0;i<dynamicforums.children.length;i++) {
          thisobject = dynamicforums.children[i];
          element_name = thisobject.name;
          if(element_name != null) {
            if(element_name.substr(0,5) == "forum")
               thisobject.checked = is_checked;
          }
        }
      }
	if (isW3C) { // Check/Uncheck for Mozilla / W3C Compatible DOM
        var x = document.getElementById('dynamicforums');
        for(i=0;i<x.childNodes.length;i++) {
           thisobject = x.childNodes[i];
           element_name = thisobject.name;
           if(element_name != null) {
             if(element_name.substr(0,5) == "forum")
                thisobject.checked = is_checked;
           }
         }
       }
     return;
    }
    function unsubscribeCheck() {
      // If all forums is unchecked and none of the elected forums are checked, this
      // means unsubscribe. An unsubscribe message will occur on form submittal in this case,
      // unless the user cancels the confirm.
      var isW3C = false;
      var isIE = false;
      var num_checked;
      var process_form;
         
      if (!(document.all)) isW3C=true; /* standard compliant DOM, probably */
      if (document.all) isIE=true;
      num_checked = 0;
      process_form = true;

      // Check/Uncheck for IE DOM
      var element_name = new String();
      if (isIE) {
        for(i=0;i<dynamicforums.children.length;i++) {
          thisobject = dynamicforums.children[i];
          element_name = thisobject.name;
          if(element_name != null) {
            if(element_name.substr(0,5) == "forum") {
               if (thisobject.checked == true)
                 num_checked++;
            }
          }
        }
      }
	if (isW3C) { // Check/Uncheck for Mozilla / W3C Compatible DOM
        var x = document.getElementById('dynamicforums');
        for(i=0;i<x.childNodes.length;i++) {
           thisobject = x.childNodes[i];
           element_name = thisobject.name;
           if(element_name != null) {
             if(element_name.substr(0,5) == "forum")
               if (thisobject.checked == true)
                 num_checked++;
           }
         }
      }
      // If no forums were checked but the user did not request to cancel subscription then
      // this probably means to cancel the subscription. Confirm this is the case. If the user
      // cancels the form will not be submitted.
      if ((num_checked==0) && (document.subscribe.all_forums.checked==false) && (document.subscribe.digest_type[0].checked==false)) {
        process_form = confirm("{NO_FORUMS_SELECTED}");
        if (process_form)
          document.subscribe.digest_type[0].checked = true; // set "None" radio button for digest_type
      }
          
      return process_form;
    }
    // End hiding Javascript -->
    </script>
      <form name="subscribe" action="{S_POST_ACTION}" method="post" onsubmit="return unsubscribeCheck();">
	  
{ERROR_BOX}
        
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr> 
		<td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
	</tr>
</table>
<table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif"width="8" height="23" border="0" alt=""></td> 
   <td align="center" width="100%" background="templates/PowerMetal/images/blk_tm.gif"><strong>{PAGE_TITLE}<strong><img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="blkr" src="templates/PowerMetal/images/blk_trc.gif" width="77" height="23" border="0" alt=""></td>
  </tr>
  	</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="tlc" src="templates/PowerMetal/images/tlc.gif" width="8" height="6" border="0" alt=""></td> 
   <td width="100%" background="templates/PowerMetal/images/tm.gif"><img name="tm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="trc" src="templates/PowerMetal/images/trc.gif" width="8" height="6" border="0" alt=""></td>
  </tr>
  <tr>
    <td background="templates/PowerMetal/images/left.gif"><img name="left" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
        <td valign="top" bgcolor="#484848">

        
  <table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
    <tr> 
      <td class="row2" colspan="2" style="padding: 5px;"><span class="gen">{DIGEST_EXPLANATION}</span></td>
    </tr>
    <tr> 
      <td class="row1" style="padding: 5px;"><span class="gen">{L_DIGEST_FREQUENCY}</span><br /> 
        <span class="gensmall">{L_DIGEST_FREQUENCY_DESC}</span> </td>
      <td class="row2" style="padding: 5px;" valign="MIDDLE"> <input class="post" style="width:40px" name="digest_frequency" type="text" value="{S_DIGEST_FREQUENCY}" size="10" id="digest_frequency"> 
        <br /> </td>
    </tr>
    <tr> 
      <td class="row1" style="padding: 5px;"><span class="gen">{L_FORMAT}</span><br /> 
        <span class="gensmall">{L_FORMAT_DESC}</span></td>
      <td class="row2" style="padding: 5px;"> <input type="radio" name="format" {HTML_CHECKED} value="{S_HTML}" /> 
        <span class="gen">{L_HTML}</span><br /> <input type="radio" name="format" {TEXT_CHECKED} value="{S_TEXT}" /> 
        <span class="gen">{L_TEXT}</span> </td>
    </tr>
    <tr> 
      <td class="row1" style="padding: 5px;"><span class="gen">{L_SHOW_TEXT}</span></td>
      <td class="row2" style="padding: 5px;"> <input type="radio" name="show_text" {SHOW_TEXT_YES_CHECKED} value="{S_TRUE}" /> 
        <span class="gen">{L_YES}</span> <input type="radio" name="show_text" {SHOW_TEXT_NO_CHECKED} value="{S_FALSE}" /> 
        <span class="gen">{L_NO}</span> </td>
    </tr>
    <tr> 
      <td class="row1" style="padding: 5px;"><span class="gen">{L_SHOW_MINE}</span></td>
      <td class="row2" style="padding: 5px;"> <input type="radio" name="show_mine" {SHOW_MINE_YES_CHECKED} value="{S_TRUE}" /> 
        <span class="gen">{L_YES}</span> <input type="radio" name="show_mine" {SHOW_MINE_NO_CHECKED} value="{S_FALSE}" /> 
        <span class="gen">{L_NO}</span> </td>
    </tr>
    <tr> 
      <td class="row1" style="padding: 5px;"><span class="gen">{L_NEW_ONLY}</span><br /> 
        <span class="gensmall">{L_NEW_ONLY_DESC}</span></td>
      <td class="row2" style="padding: 5px;"> <input type="radio" name="new_only" {NEW_ONLY_YES_CHECKED} value="{S_TRUE}" /> 
        <span class="gen">{L_YES}</span> <input type="radio" name="new_only" {NEW_ONLY_NO_CHECKED} value="{S_FALSE}" /> 
        <span class="gen">{L_NO}</span> </td>
    </tr>
    <tr> 
      <td class="row1" style="padding: 5px;"><span class="gen">{L_SEND_ON_NO_MESSAGES}</span></td>
      <td class="row2" style="padding: 5px;"> <input type="radio" name="send_on_no_messages" {SEND_ON_NO_MESSAGES_YES_CHECKED} value="{S_TRUE}" /> 
        <span class="gen">{L_YES}</span> <input type="radio" name="send_on_no_messages" {SEND_ON_NO_MESSAGES_NO_CHECKED} value="{S_FALSE}" /> 
        <span class="gen">{L_NO}</span> </td>
    </tr>
    <tr> 
      <td class="row1" style="padding: 5px;"><span class="gen">{L_TEXT_LENGTH}</span><br /> 
        <span class="gensmall">{L_TEXT_LENGTH_DESC}</span></td>
      <td class="row2" style="padding: 5px;"> {S_TEXT_LENGH} </td>
    </tr>
    <tr> 
      <td valign="top" class="row1" style="padding: 5px;"><span class="gen">{L_FORUM_SELECTION}</span></td>
      <td class="row2" style="padding: 5px;"> <input type="checkbox" name="all_forums" {ALL_FORUMS_CHECKED} onclick="unCheckSubscribedForums(this);" /> 
        <span class="gen">{L_ALL_SUBSCRIBED_FORUMS}</span><br /> <div id="dynamicforums"> 
          <!-- BEGIN forums -->
          <input type="checkbox" name="{forums.FORUM_NAME}" {forums.CHECKED} onclick="toggleAllForums ();" />
          <span class="gen">{forums.FORUM_LABEL}</span><br />
          <!-- END forums -->
        </div></td>
    </tr>
    <tr> 
      <td colspan="2" align="center" class="cat" height="28"><input type="hidden" name="create_new" value="{DIGEST_CREATE_NEW_VALUE}" />
        <button type="submit" class="mainoption"><span class="gen">{L_SUBMIT}</span></button>
        &nbsp;
        <button type="reset" class="liteoption"><span class="gen">{L_RESET}</span></button></td>
    </tr>
  </table>
    </td>
    <td background="templates/PowerMetal/images/right.gif"><img name="right" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
   <td><img name="blc" src="templates/PowerMetal/images/blc.gif" width="8" height="8" border="0" alt=""></td>
    <td background="templates/PowerMetal/images/btm.gif"><img name="btm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="brc" src="templates/PowerMetal/images/brc.gif" width="8" height="8" border="0" alt=""></td>
  </tr></table>
      </form> 