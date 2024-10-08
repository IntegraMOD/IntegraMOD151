<script>
function checkForm(formObj) {
    let formErrors = false;    
 
    if (formObj.message.value.length < 2) {
        formErrors = "{L_EMPTY_MESSAGE_EMAIL}";
    }
    else if (formObj.subject.value.length < 2) {
        formErrors = "{L_EMPTY_SUBJECT_EMAIL}";
    }
 
    if (formErrors) {
        alert(formErrors);
        return false;
    }
}
</script>
<!-- INCLUDE pa_header.tpl -->
<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a href="{U_DOWNLOAD_HOME}" class="nav">{DOWNLOAD}</a><!-- BEGIN navlinks --> -> <a href="{navlinks.U_VIEW_CAT}" class="nav">{navlinks.CAT_NAME}</a><!-- END navlinks --> -> <a href="{U_FILE_NAME}" class="nav">{FILE_NAME}</a> -> {L_EMAIL}</span></td>
  </tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr> 
	<th class="thHead" colspan="2">{L_EMAIL}</th>
  </tr>
  <tr> 
	<td class="row2" colspan="2"><span class="genmed">{L_EMAILINFO}</span></td>
  </tr>
  <form action="{S_EMAIL_ACTION}" method="post" onSubmit="return checkForm(this)" name="post">
  <tr> 
	<td class="row1" width="30%"><span class="genmed">{L_YNAME}:&nbsp;</span></td>
	<td class="row2" width="70%"><!-- IF USER_LOGGED --><input class="post" type="text" size="50" name="sname"><!-- ELSE --><b><span class="genmed">{SNAME}</span></b><!-- ENDIF --></td>
  </tr>
  <tr> 
	<td class="row1"><span class="genmed">{L_YEMAIL}:&nbsp;</span></td>
	<td class="row2"><!-- IF USER_LOGGED --><input class="post" type="text" size="50" name="semail"><!-- ELSE --><b><span class="genmed">{SEMAIL}</span></b><!-- ENDIF --></td>
  </tr>
  <tr> 
	<td class="row1"><span class="genmed">{L_FNAME}:&nbsp;</span></td>
	<td class="row2"><input class="post" type="text" size="50" name="fname"></td>
  </tr>
  <tr> 
	<td class="row1"><span class="genmed">{L_FEMAIL}: *&nbsp;</span></td>
	<td class="row2"><input class="post" type="text" size="50" name="femail"></td>
  </tr>
  <tr> 
	<td class="row1"><span class="genmed">{L_ESUB}:&nbsp;</span></td>
	<td class="row2"><input class="post" type="text" size="50" name="subject" value="{FILE_NAME}"></td>
  </tr>
  <tr> 
	<td class="row1"><span class="genmed">{L_ETEXT}:&nbsp;</span></td>
	<td class="row2"><textarea cols="38" rows="10" name="message">{L_DEFAULTMAIL} {FILE_URL}</textarea></td>
  </tr>
  <tr> 
	<td class="cat" align="center" colspan="2">{S_HIDDEN_FIELDS}<input type="hidden" name="action" value="email"><input type="hidden" name="file_id" value="{ID}"><input class="liteoption" type="submit" name="submit" value="{L_SEMAIL}"></td>
  </tr>
  </form>
</table>
<!-- INCLUDE pa_footer.tpl -->