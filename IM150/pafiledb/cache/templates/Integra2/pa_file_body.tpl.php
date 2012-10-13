<?php $this->_tpl_include('pa_header.tpl'); ?>
<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom">
		<span class="nav"><a href="<?php echo $this->_tpldata['.'][0]['U_INDEX']; ?>" class="nav"><?php echo ((isset($this->_tpldata['.'][0]['L_INDEX'])) ? $this->_tpldata['.'][0]['L_INDEX'] : ((isset($lang['INDEX'])) ? $lang['INDEX'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'INDEX'))) . ' 	}')); ?></a> -> <a href="<?php echo $this->_tpldata['.'][0]['U_DOWNLOAD_HOME']; ?>" class="nav"><?php echo $this->_tpldata['.'][0]['DOWNLOAD']; ?></a><?php $_navlinks_count = (isset($this->_tpldata['navlinks'])) ?  sizeof($this->_tpldata['navlinks']) : 0;if ($_navlinks_count) {for ($this->_navlinks_i = 0; $this->_navlinks_i < $_navlinks_count; $this->_navlinks_i++){ ?> -> <a href="<?php echo $this->_tpldata['navlinks'][$this->_navlinks_i]['U_VIEW_CAT']; ?>" class="nav"><?php echo $this->_tpldata['navlinks'][$this->_navlinks_i]['CAT_NAME']; ?></a><?php }} ?> -> <?php echo $this->_tpldata['.'][0]['FILE_NAME']; ?></span>
	</td>
  </tr>
</table>

<table width="100%" cellpadding="4" cellspacing="0" class="forumline">
  <tr> 
	<th class="thCornerL" align="left" colspan="2"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE'])) ? $this->_tpldata['.'][0]['L_FILE'] : ((isset($lang['FILE'])) ? $lang['FILE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE'))) . ' 	}')); ?> - <?php echo $this->_tpldata['.'][0]['FILE_NAME']; ?></th>
	<th class="thCornerR" align="right" nowrap>
<?php if ($this->_tpldata['.'][0]['AUTH_EDIT']) {  ?>  
		<a href="<?php echo $this->_tpldata['.'][0]['U_EDIT']; ?>"><img src="<?php echo $this->_tpldata['.'][0]['EDIT_IMG']; ?>" border="0" alt="<?php echo ((isset($this->_tpldata['.'][0]['L_EDIT'])) ? $this->_tpldata['.'][0]['L_EDIT'] : ((isset($lang['EDIT'])) ? $lang['EDIT'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'EDIT'))) . ' 	}')); ?>" title="<?php echo ((isset($this->_tpldata['.'][0]['L_EDIT'])) ? $this->_tpldata['.'][0]['L_EDIT'] : ((isset($lang['EDIT'])) ? $lang['EDIT'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'EDIT'))) . ' 	}')); ?>" /></a> &nbsp;&nbsp;
<?php }if ($this->_tpldata['.'][0]['AUTH_DELETE']) {  ?>  
		<a href="javascript:delete_file('<?php echo $this->_tpldata['.'][0]['U_DELETE']; ?>')"><img src="<?php echo $this->_tpldata['.'][0]['DELETE_IMG']; ?>" border="0" alt="<?php echo ((isset($this->_tpldata['.'][0]['L_DELETE'])) ? $this->_tpldata['.'][0]['L_DELETE'] : ((isset($lang['DELETE'])) ? $lang['DELETE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DELETE'))) . ' 	}')); ?>" title="<?php echo ((isset($this->_tpldata['.'][0]['L_DELETE'])) ? $this->_tpldata['.'][0]['L_DELETE'] : ((isset($lang['DELETE'])) ? $lang['DELETE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DELETE'))) . ' 	}')); ?>" /></a>
<?php } ?>
	</th>
  </tr>
<tr> 
	<td class="row2" valign="middle" width="20%"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_DESC'])) ? $this->_tpldata['.'][0]['L_DESC'] : ((isset($lang['DESC'])) ? $lang['DESC'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DESC'))) . ' 	}')); ?>:</span></td>
	<td class="row1" valign="middle" width="80%" colspan="2"><span class="genmed"><?php echo $this->_tpldata['.'][0]['FILE_LONGDESC']; ?></span></td>
</tr>
<tr>
	<td class="row2" valign="middle" width="20%"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_SUBMITED_BY'])) ? $this->_tpldata['.'][0]['L_SUBMITED_BY'] : ((isset($lang['SUBMITED_BY'])) ? $lang['SUBMITED_BY'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SUBMITED_BY'))) . ' 	}')); ?>:</span></td>
	<td class="row1" valign="middle" width="80%" colspan="2"><span class="name"><?php echo $this->_tpldata['.'][0]['FILE_SUBMITED_BY']; ?></span></td>
</tr>  
<?php if ($this->_tpldata['.'][0]['SHOW_AUTHOR']) {  ?>
<tr>
	<td class="row2" valign="middle" width="20%"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_AUTHOR'])) ? $this->_tpldata['.'][0]['L_AUTHOR'] : ((isset($lang['AUTHOR'])) ? $lang['AUTHOR'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'AUTHOR'))) . ' 	}')); ?>:</span></td>
	<td class="row1" valign="middle" width="80%" colspan="2"><span class="genmed"><?php echo $this->_tpldata['.'][0]['FILE_AUTHOR']; ?></span></td>
</tr>  
<?php }if ($this->_tpldata['.'][0]['SHOW_VERSION']) {  ?>
<tr> 
	<td class="row2" valign="middle" width="20%"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_VERSION'])) ? $this->_tpldata['.'][0]['L_VERSION'] : ((isset($lang['VERSION'])) ? $lang['VERSION'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'VERSION'))) . ' 	}')); ?>:</span></td>
	<td class="row1" valign="middle" width="80%" colspan="2"><span class="genmed"><?php echo $this->_tpldata['.'][0]['FILE_VERSION']; ?></span></td>
  </tr>  
<?php }if ($this->_tpldata['.'][0]['SHOW_SCREENSHOT']) {  ?>
<tr> 
	<td class="row2" valign="middle" width="20%"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_SCREENSHOT'])) ? $this->_tpldata['.'][0]['L_SCREENSHOT'] : ((isset($lang['SCREENSHOT'])) ? $lang['SCREENSHOT'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SCREENSHOT'))) . ' 	}')); ?>:</span></td>
	<?php if ($this->_tpldata['.'][0]['SS_AS_LINK']) {  ?>
	<td class="row1" valign="middle" width="80%" colspan="2"><span class="genmed"><a href="<?php echo $this->_tpldata['.'][0]['FILE_SCREENSHOT']; ?>" target="_blank"><?php echo ((isset($this->_tpldata['.'][0]['L_CLICK_HERE'])) ? $this->_tpldata['.'][0]['L_CLICK_HERE'] : ((isset($lang['CLICK_HERE'])) ? $lang['CLICK_HERE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'CLICK_HERE'))) . ' 	}')); ?></a></span></td>
	<?php } else { ?>
	<td class="row1" valign="middle" width="80%" colspan="2"><span class="genmed"><a href="javascript:mpFoto('<?php echo $this->_tpldata['.'][0]['FILE_SCREENSHOT']; ?>')"><img src="<?php echo $this->_tpldata['.'][0]['FILE_SCREENSHOT']; ?>" border="0" width="100" hight="100"></a></span></td>
	<?php } ?>
  </tr>  
<?php }if ($this->_tpldata['.'][0]['SHOW_WEBSITE']) {  ?>
  <tr> 
	<td class="row2" valign="middle" width="20%"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_WEBSITE'])) ? $this->_tpldata['.'][0]['L_WEBSITE'] : ((isset($lang['WEBSITE'])) ? $lang['WEBSITE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'WEBSITE'))) . ' 	}')); ?>:</span></td>
	<td class="row1" valign="middle" width="80%" colspan="2"><span class="genmed"><a href="<?php echo $this->_tpldata['.'][0]['FILE_WEBSITE']; ?>" target="_blank"><?php echo ((isset($this->_tpldata['.'][0]['L_CLICK_HERE'])) ? $this->_tpldata['.'][0]['L_CLICK_HERE'] : ((isset($lang['CLICK_HERE'])) ? $lang['CLICK_HERE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'CLICK_HERE'))) . ' 	}')); ?></a></span></td>
  </tr>
<?php } ?> 
<tr> 
	<td class="row2" valign="middle"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_DATE'])) ? $this->_tpldata['.'][0]['L_DATE'] : ((isset($lang['DATE'])) ? $lang['DATE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DATE'))) . ' 	}')); ?>:</span></td>
	<td class="row1" valign="middle" colspan="2"><span class="genmed"><?php echo $this->_tpldata['.'][0]['TIME']; ?></span></td>
  </tr>
<tr> 
	<td class="row2" valign="middle"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_UPDATE_TIME'])) ? $this->_tpldata['.'][0]['L_UPDATE_TIME'] : ((isset($lang['UPDATE_TIME'])) ? $lang['UPDATE_TIME'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'UPDATE_TIME'))) . ' 	}')); ?>:</span></td>
	<td class="row1" valign="middle" colspan="2"><span class="genmed"><?php echo $this->_tpldata['.'][0]['UPDATE_TIME']; ?></span></td>
  </tr>
  <tr> 
	<td class="row2" valign="middle"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_LASTTDL'])) ? $this->_tpldata['.'][0]['L_LASTTDL'] : ((isset($lang['LASTTDL'])) ? $lang['LASTTDL'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'LASTTDL'))) . ' 	}')); ?>:</span></td>
	<td class="row1" valign="middle" colspan="2"><span class="genmed"><?php echo $this->_tpldata['.'][0]['LAST']; ?></span></td>
  </tr>
  <tr> 
	<td class="row2" valign="middle"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_SIZE'])) ? $this->_tpldata['.'][0]['L_SIZE'] : ((isset($lang['SIZE'])) ? $lang['SIZE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SIZE'))) . ' 	}')); ?>:</span></td>
	<td class="row1" valign="middle" colspan="2"><span class="genmed"><?php echo $this->_tpldata['.'][0]['FILE_SIZE']; ?></span></td>
  </tr>  
  <tr> 
	<td class="row2" valign="middle"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_RATING'])) ? $this->_tpldata['.'][0]['L_RATING'] : ((isset($lang['RATING'])) ? $lang['RATING'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'RATING'))) . ' 	}')); ?>:</span></td>
	<td class="row1" valign="middle" colspan="2"><span class="genmed"><?php echo $this->_tpldata['.'][0]['RATING']; ?> (<?php echo $this->_tpldata['.'][0]['FILE_VOTES']; ?> <?php echo ((isset($this->_tpldata['.'][0]['L_VOTES'])) ? $this->_tpldata['.'][0]['L_VOTES'] : ((isset($lang['VOTES'])) ? $lang['VOTES'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'VOTES'))) . ' 	}')); ?>)</span></td>
  </tr>
  <tr> 
	<td class="row2" valign="middle"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_DLS'])) ? $this->_tpldata['.'][0]['L_DLS'] : ((isset($lang['DLS'])) ? $lang['DLS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DLS'))) . ' 	}')); ?>:</span></td>
	<td class="row1" valign="middle" colspan="2"><span class="genmed"><?php echo $this->_tpldata['.'][0]['FILE_DLS']; ?></span></td>
  </tr>
<?php $_custom_field_count = (isset($this->_tpldata['custom_field'])) ?  sizeof($this->_tpldata['custom_field']) : 0;if ($_custom_field_count) {for ($this->_custom_field_i = 0; $this->_custom_field_i < $_custom_field_count; $this->_custom_field_i++){ ?>
  <tr>
	<td class="row2" valign="middle"><span class="genmed"><?php echo $this->_tpldata['custom_field'][$this->_custom_field_i]['CUSTOM_NAME']; ?>:</span></td>
	<td class="row1" valign="middle" colspan="2"><span class="genmed"><?php echo $this->_tpldata['custom_field'][$this->_custom_field_i]['DATA']; ?></span></td>
  </tr>
<?php }} ?>
  <tr> 
	<td class="cat" align="center" colspan="3"></td>
  </tr>
</table>

<table width="100%" cellpadding="2" cellspacing="0">
  <tr>
<?php if ($this->_tpldata['.'][0]['AUTH_DOWNLOAD']) {  ?>  
	<td width="33%" align="center"><a href="<?php echo $this->_tpldata['.'][0]['U_DOWNLOAD']; ?>"><img src="<?php echo $this->_tpldata['.'][0]['DOWNLOAD_IMG']; ?>" border="0" alt="<?php echo ((isset($this->_tpldata['.'][0]['L_DOWNLOAD'])) ? $this->_tpldata['.'][0]['L_DOWNLOAD'] : ((isset($lang['DOWNLOAD'])) ? $lang['DOWNLOAD'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DOWNLOAD'))) . ' 	}')); ?>" title="<?php echo ((isset($this->_tpldata['.'][0]['L_DOWNLOAD'])) ? $this->_tpldata['.'][0]['L_DOWNLOAD'] : ((isset($lang['DOWNLOAD'])) ? $lang['DOWNLOAD'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DOWNLOAD'))) . ' 	}')); ?>" /></a></td>
<?php }if ($this->_tpldata['.'][0]['AUTH_RATE']) {  ?>  
	<td width="34%" align="center"><a href="<?php echo $this->_tpldata['.'][0]['U_RATE']; ?>"><img src="<?php echo $this->_tpldata['.'][0]['RATE_IMG']; ?>" border="0" alt="<?php echo ((isset($this->_tpldata['.'][0]['L_RATE'])) ? $this->_tpldata['.'][0]['L_RATE'] : ((isset($lang['RATE'])) ? $lang['RATE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'RATE'))) . ' 	}')); ?>" title="<?php echo ((isset($this->_tpldata['.'][0]['L_RATE'])) ? $this->_tpldata['.'][0]['L_RATE'] : ((isset($lang['RATE'])) ? $lang['RATE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'RATE'))) . ' 	}')); ?>" /></a></td>
<?php }if ($this->_tpldata['.'][0]['AUTH_EMAIL']) {  ?>  
	<td width="33%" align="center"><a href="<?php echo $this->_tpldata['.'][0]['U_EMAIL']; ?>"><img src="<?php echo $this->_tpldata['.'][0]['EMAIL_IMG']; ?>" border="0" alt="<?php echo ((isset($this->_tpldata['.'][0]['L_EMAIL'])) ? $this->_tpldata['.'][0]['L_EMAIL'] : ((isset($lang['EMAIL'])) ? $lang['EMAIL'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'EMAIL'))) . ' 	}')); ?>" title="<?php echo ((isset($this->_tpldata['.'][0]['L_EMAIL'])) ? $this->_tpldata['.'][0]['L_EMAIL'] : ((isset($lang['EMAIL'])) ? $lang['EMAIL'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'EMAIL'))) . ' 	}')); ?>" /></a></td>
<?php } ?>
  </tr>
</table>
<br />
<?php if ($this->_tpldata['.'][0]['INCLUDE_COMMENTS']) { $this->_tpl_include('pa_comment_body.tpl');}$this->_tpl_include('pa_footer.tpl'); ?>