<script language="JavaScript" type="text/javascript">
<!--
function checkForm(formObj) {

	formErrors = false;    

	if (formObj.message.value.length < 2) {
		formErrors = "<?php echo ((isset($this->_tpldata['.'][0]['L_EMPTY_MESSAGE_EMAIL'])) ? $this->_tpldata['.'][0]['L_EMPTY_MESSAGE_EMAIL'] : ((isset($lang['EMPTY_MESSAGE_EMAIL'])) ? $lang['EMPTY_MESSAGE_EMAIL'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'EMPTY_MESSAGE_EMAIL'))) . ' 	}')); ?>";
	}
	else if ( formObj.subject.value.length < 2)
	{
		formErrors = "<?php echo ((isset($this->_tpldata['.'][0]['L_EMPTY_SUBJECT_EMAIL'])) ? $this->_tpldata['.'][0]['L_EMPTY_SUBJECT_EMAIL'] : ((isset($lang['EMPTY_SUBJECT_EMAIL'])) ? $lang['EMPTY_SUBJECT_EMAIL'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'EMPTY_SUBJECT_EMAIL'))) . ' 	}')); ?>";
	}

	if (formErrors) {
		alert(formErrors);
		return false;
	}
}
//-->
</script>
<?php $this->_tpl_include('pa_header.tpl'); ?>
<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom">
		<span class="nav"><a href="<?php echo $this->_tpldata['.'][0]['U_INDEX']; ?>" class="nav"><?php echo ((isset($this->_tpldata['.'][0]['L_INDEX'])) ? $this->_tpldata['.'][0]['L_INDEX'] : ((isset($lang['INDEX'])) ? $lang['INDEX'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'INDEX'))) . ' 	}')); ?></a> -> <a href="<?php echo $this->_tpldata['.'][0]['U_DOWNLOAD_HOME']; ?>" class="nav"><?php echo $this->_tpldata['.'][0]['DOWNLOAD']; ?></a><?php $_navlinks_count = (isset($this->_tpldata['navlinks'])) ?  sizeof($this->_tpldata['navlinks']) : 0;if ($_navlinks_count) {for ($this->_navlinks_i = 0; $this->_navlinks_i < $_navlinks_count; $this->_navlinks_i++){ ?> -> <a href="<?php echo $this->_tpldata['navlinks'][$this->_navlinks_i]['U_VIEW_CAT']; ?>" class="nav"><?php echo $this->_tpldata['navlinks'][$this->_navlinks_i]['CAT_NAME']; ?></a><?php }} ?> -> <a href="<?php echo $this->_tpldata['.'][0]['U_FILE_NAME']; ?>" class="nav"><?php echo $this->_tpldata['.'][0]['FILE_NAME']; ?></a> -> <?php echo ((isset($this->_tpldata['.'][0]['L_EMAIL'])) ? $this->_tpldata['.'][0]['L_EMAIL'] : ((isset($lang['EMAIL'])) ? $lang['EMAIL'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'EMAIL'))) . ' 	}')); ?></span>
	</td>
  </tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr> 
	<th class="thHead" colspan="2"><?php echo ((isset($this->_tpldata['.'][0]['L_EMAIL'])) ? $this->_tpldata['.'][0]['L_EMAIL'] : ((isset($lang['EMAIL'])) ? $lang['EMAIL'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'EMAIL'))) . ' 	}')); ?></th>
  </tr>
  <tr> 
	<td class="row2" colspan="2"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_EMAILINFO'])) ? $this->_tpldata['.'][0]['L_EMAILINFO'] : ((isset($lang['EMAILINFO'])) ? $lang['EMAILINFO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'EMAILINFO'))) . ' 	}')); ?></span></td>
  </tr>
  <form action="<?php echo $this->_tpldata['.'][0]['S_EMAIL_ACTION']; ?>" method="post" onSubmit="return checkForm(this)" name="post">
  <tr> 
	<td class="row1" width="30%"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_YNAME'])) ? $this->_tpldata['.'][0]['L_YNAME'] : ((isset($lang['YNAME'])) ? $lang['YNAME'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'YNAME'))) . ' 	}')); ?>:&nbsp;</span></td>
	<td class="row2" width="70%"><?php if ($this->_tpldata['.'][0]['USER_LOGGED']) {  ?><input class="post" type="text" size="50" name="sname"><?php } else { ?><b><span class="genmed"><?php echo $this->_tpldata['.'][0]['SNAME']; ?></span></b><?php } ?></td>
  </tr>
  <tr> 
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_YEMAIL'])) ? $this->_tpldata['.'][0]['L_YEMAIL'] : ((isset($lang['YEMAIL'])) ? $lang['YEMAIL'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'YEMAIL'))) . ' 	}')); ?>:&nbsp;</span></td>
	<td class="row2"><?php if ($this->_tpldata['.'][0]['USER_LOGGED']) {  ?><input class="post" type="text" size="50" name="semail"><?php } else { ?><b><span class="genmed"><?php echo $this->_tpldata['.'][0]['SEMAIL']; ?></span></b><?php } ?></td>
  </tr>
  <tr> 
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FNAME'])) ? $this->_tpldata['.'][0]['L_FNAME'] : ((isset($lang['FNAME'])) ? $lang['FNAME'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FNAME'))) . ' 	}')); ?>:&nbsp;</span></td>
	<td class="row2"><input class="post" type="text" size="50" name="fname"></td>
  </tr>
  <tr> 
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FEMAIL'])) ? $this->_tpldata['.'][0]['L_FEMAIL'] : ((isset($lang['FEMAIL'])) ? $lang['FEMAIL'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FEMAIL'))) . ' 	}')); ?>: *&nbsp;</span></td>
	<td class="row2"><input class="post" type="text" size="50" name="femail"></td>
  </tr>
  <tr> 
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_ESUB'])) ? $this->_tpldata['.'][0]['L_ESUB'] : ((isset($lang['ESUB'])) ? $lang['ESUB'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'ESUB'))) . ' 	}')); ?>:&nbsp;</span></td>
	<td class="row2"><input class="post" type="text" size="50" name="subject" value="<?php echo $this->_tpldata['.'][0]['FILE_NAME']; ?>"></td>
  </tr>
  <tr> 
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_ETEXT'])) ? $this->_tpldata['.'][0]['L_ETEXT'] : ((isset($lang['ETEXT'])) ? $lang['ETEXT'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'ETEXT'))) . ' 	}')); ?>:&nbsp;</span></td>
	<td class="row2"><textarea cols="38" rows="10" name="message"><?php echo ((isset($this->_tpldata['.'][0]['L_DEFAULTMAIL'])) ? $this->_tpldata['.'][0]['L_DEFAULTMAIL'] : ((isset($lang['DEFAULTMAIL'])) ? $lang['DEFAULTMAIL'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DEFAULTMAIL'))) . ' 	}')); ?> <?php echo $this->_tpldata['.'][0]['FILE_URL']; ?></textarea></td>
  </tr>
  <tr> 
	<td class="cat" align="center" colspan="2"><?php echo $this->_tpldata['.'][0]['S_HIDDEN_FIELDS']; ?><input type="hidden" name="action" value="email"><input type="hidden" name="file_id" value="<?php echo $this->_tpldata['.'][0]['ID']; ?>"><input class="liteoption" type="submit" name="submit" value="<?php echo ((isset($this->_tpldata['.'][0]['L_SEMAIL'])) ? $this->_tpldata['.'][0]['L_SEMAIL'] : ((isset($lang['SEMAIL'])) ? $lang['SEMAIL'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SEMAIL'))) . ' 	}')); ?>"></td>
  </tr>
  </form>
</table>
<?php $this->_tpl_include('pa_footer.tpl'); ?>