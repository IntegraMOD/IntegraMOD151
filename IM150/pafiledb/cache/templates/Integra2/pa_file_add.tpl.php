<?php $this->_tpl_include('pa_header.tpl'); ?>
<script language="JavaScript" type="text/javascript">
<!--
	var error_msg = "";
	function checkAddForm() 
	{
		error_msg = "";
		if (document.form.cat_id.value == -1)
		{
			error_msg = "You can't add file to category that does not allow files on it";
		}

		if(document.form.name.value == "")
		{
			if(error_msg != "")
			{
				error_msg += "\n";
			}
			error_msg += "Please fill the file name field";
		}
		
		if(document.form.long_desc.value == "")
		{
			if(error_msg != "")
			{
				error_msg += "\n";
			}
			error_msg += "Please fill the file long descritpion field";
		}

		<?php if ($this->_tpldata['.'][0]['MODE'] == 'ADD') {  ?>
		if(document.form.userfile.value == "" && document.form.download_url.value == "")
		{
			if(error_msg != "")
			{
				error_msg += "\n";
			}
			error_msg += "Please fill the file url field or click browse to upload file from your machine";
		}
		<?php } ?>
		
		if(error_msg != "")
		{
			alert(error_msg);
			error_msg = "";
			return false;
		}
		else
		{
			return true;
		}
	}
// -->
</script>

<form enctype="multipart/form-data" action="<?php echo $this->_tpldata['.'][0]['S_ADD_FILE_ACTION']; ?>" method="post" name="form" onsubmit="return checkAddForm();">

<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom">
		<span class="nav"><a href="<?php echo $this->_tpldata['.'][0]['U_INDEX']; ?>" class="nav"><?php echo ((isset($this->_tpldata['.'][0]['L_INDEX'])) ? $this->_tpldata['.'][0]['L_INDEX'] : ((isset($lang['INDEX'])) ? $lang['INDEX'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'INDEX'))) . ' 	}')); ?></a> -> <a href="<?php echo $this->_tpldata['.'][0]['U_DOWNLOAD']; ?>" class="nav"><?php echo $this->_tpldata['.'][0]['DOWNLOAD']; ?></a> -> <?php echo ((isset($this->_tpldata['.'][0]['L_UPLOAD'])) ? $this->_tpldata['.'][0]['L_UPLOAD'] : ((isset($lang['UPLOAD'])) ? $lang['UPLOAD'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'UPLOAD'))) . ' 	}')); ?></span>
	</td>
  </tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr>
	<th colspan="2" class="thHead"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_TITLE'])) ? $this->_tpldata['.'][0]['L_FILE_TITLE'] : ((isset($lang['FILE_TITLE'])) ? $lang['FILE_TITLE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_TITLE'))) . ' 	}')); ?></th>
  </tr>
  <tr>
	<td width="50%" class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_NAME'])) ? $this->_tpldata['.'][0]['L_FILE_NAME'] : ((isset($lang['FILE_NAME'])) ? $lang['FILE_NAME'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_NAME'))) . ' 	}')); ?></span><br><span class="gensmall"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_NAME_INFO'])) ? $this->_tpldata['.'][0]['L_FILE_NAME_INFO'] : ((isset($lang['FILE_NAME_INFO'])) ? $lang['FILE_NAME_INFO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_NAME_INFO'))) . ' 	}')); ?></span></td>
	<td class="row2"><input type="text" class="post" size="50" name="name" value="<?php echo $this->_tpldata['.'][0]['FILE_NAME']; ?>" /></td>
  </tr>
  <tr>
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_SHORT_DESC'])) ? $this->_tpldata['.'][0]['L_FILE_SHORT_DESC'] : ((isset($lang['FILE_SHORT_DESC'])) ? $lang['FILE_SHORT_DESC'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_SHORT_DESC'))) . ' 	}')); ?></span><br><span class="gensmall"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_SHORT_DESC_INFO'])) ? $this->_tpldata['.'][0]['L_FILE_SHORT_DESC_INFO'] : ((isset($lang['FILE_SHORT_DESC_INFO'])) ? $lang['FILE_SHORT_DESC_INFO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_SHORT_DESC_INFO'))) . ' 	}')); ?></span></td>
	<td class="row2"><input type="text" class="post" size="50" name="short_desc" value="<?php echo $this->_tpldata['.'][0]['FILE_DESC']; ?>" /></td>
  </tr>
  <tr>
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_LONG_DESC'])) ? $this->_tpldata['.'][0]['L_FILE_LONG_DESC'] : ((isset($lang['FILE_LONG_DESC'])) ? $lang['FILE_LONG_DESC'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_LONG_DESC'))) . ' 	}')); ?></span><br><span class="gensmall"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_LONG_DESC_INFO'])) ? $this->_tpldata['.'][0]['L_FILE_LONG_DESC_INFO'] : ((isset($lang['FILE_LONG_DESC_INFO'])) ? $lang['FILE_LONG_DESC_INFO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_LONG_DESC_INFO'))) . ' 	}')); ?></span></td>
	<td class="row2"><textarea rows="6" name="long_desc" cols="32"><?php echo $this->_tpldata['.'][0]['FILE_LONG_DESC']; ?></textarea></td>
  </tr>
  <tr>
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_AUTHOR'])) ? $this->_tpldata['.'][0]['L_FILE_AUTHOR'] : ((isset($lang['FILE_AUTHOR'])) ? $lang['FILE_AUTHOR'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_AUTHOR'))) . ' 	}')); ?></span><br><span class="gensmall"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_AUTHOR_INFO'])) ? $this->_tpldata['.'][0]['L_FILE_AUTHOR_INFO'] : ((isset($lang['FILE_AUTHOR_INFO'])) ? $lang['FILE_AUTHOR_INFO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_AUTHOR_INFO'))) . ' 	}')); ?></span></td>
	<td class="row2"><input type="text" class="post" size="50" name="author" value="<?php echo $this->_tpldata['.'][0]['FILE_AUTHOR']; ?>" /></td>
  </tr>
  <tr>
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_VERSION'])) ? $this->_tpldata['.'][0]['L_FILE_VERSION'] : ((isset($lang['FILE_VERSION'])) ? $lang['FILE_VERSION'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_VERSION'))) . ' 	}')); ?></span><br><span class="gensmall"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_VERSION_INFO'])) ? $this->_tpldata['.'][0]['L_FILE_VERSION_INFO'] : ((isset($lang['FILE_VERSION_INFO'])) ? $lang['FILE_VERSION_INFO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_VERSION_INFO'))) . ' 	}')); ?></span></td>
	<td class="row2"><input type="text" class="post" size="50" name="version" value="<?php echo $this->_tpldata['.'][0]['FILE_VERSION']; ?>" /></td>
  </tr>
  <tr>
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_WEBSITE'])) ? $this->_tpldata['.'][0]['L_FILE_WEBSITE'] : ((isset($lang['FILE_WEBSITE'])) ? $lang['FILE_WEBSITE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_WEBSITE'))) . ' 	}')); ?></span><br><span class="gensmall"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_WEBSITE_INFO'])) ? $this->_tpldata['.'][0]['L_FILE_WEBSITE_INFO'] : ((isset($lang['FILE_WEBSITE_INFO'])) ? $lang['FILE_WEBSITE_INFO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_WEBSITE_INFO'))) . ' 	}')); ?></span></td>
	<td class="row2"><input type="text" class="post" size="50" name="website" value="<?php echo $this->_tpldata['.'][0]['FILE_WEBSITE']; ?>" /></td>
  </tr>

  <tr>
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_POSTICONS'])) ? $this->_tpldata['.'][0]['L_FILE_POSTICONS'] : ((isset($lang['FILE_POSTICONS'])) ? $lang['FILE_POSTICONS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_POSTICONS'))) . ' 	}')); ?></span><br><span class="gensmall"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_POSTICONS_INFO'])) ? $this->_tpldata['.'][0]['L_FILE_POSTICONS_INFO'] : ((isset($lang['FILE_POSTICONS_INFO'])) ? $lang['FILE_POSTICONS_INFO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_POSTICONS_INFO'))) . ' 	}')); ?></span></td>
	<td class="row2"><?php echo $this->_tpldata['.'][0]['S_POSTICONS']; ?></td>
  </tr>
  <tr>
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_CAT'])) ? $this->_tpldata['.'][0]['L_FILE_CAT'] : ((isset($lang['FILE_CAT'])) ? $lang['FILE_CAT'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_CAT'))) . ' 	}')); ?></span><br><span class="gensmall"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_CAT_INFO'])) ? $this->_tpldata['.'][0]['L_FILE_CAT_INFO'] : ((isset($lang['FILE_CAT_INFO'])) ? $lang['FILE_CAT_INFO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_CAT_INFO'))) . ' 	}')); ?></span></td>
	<td class="row2">
		<select name="cat_id" class="post">
		<?php echo $this->_tpldata['.'][0]['S_CAT_LIST']; ?>
		</select>
	</td>
  </tr>
  <tr>
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_LICENSE'])) ? $this->_tpldata['.'][0]['L_FILE_LICENSE'] : ((isset($lang['FILE_LICENSE'])) ? $lang['FILE_LICENSE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_LICENSE'))) . ' 	}')); ?></span><br><span class="gensmall"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_LICENSE_INFO'])) ? $this->_tpldata['.'][0]['L_FILE_LICENSE_INFO'] : ((isset($lang['FILE_LICENSE_INFO'])) ? $lang['FILE_LICENSE_INFO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_LICENSE_INFO'))) . ' 	}')); ?></span></td>
	<td class="row2">
		<select name="license" class="post">
		<?php echo $this->_tpldata['.'][0]['S_LICENSE_LIST']; ?>
		</select>
	</td>
  </tr>
<?php if ($this->_tpldata['.'][0]['IS_ADMIN'] || $this->_tpldata['.'][0]['IS_MOD']) {  ?> 
  <tr>
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_PINNED'])) ? $this->_tpldata['.'][0]['L_FILE_PINNED'] : ((isset($lang['FILE_PINNED'])) ? $lang['FILE_PINNED'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_PINNED'))) . ' 	}')); ?></span><br><span class="gensmall"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_PINNED_INFO'])) ? $this->_tpldata['.'][0]['L_FILE_PINNED_INFO'] : ((isset($lang['FILE_PINNED_INFO'])) ? $lang['FILE_PINNED_INFO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_PINNED_INFO'))) . ' 	}')); ?></span></td>
	<td class="row2">
		<input type="radio" name="pin" value="1"<?php echo $this->_tpldata['.'][0]['PIN_CHECKED_YES']; ?> /><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_YES'])) ? $this->_tpldata['.'][0]['L_YES'] : ((isset($lang['YES'])) ? $lang['YES'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'YES'))) . ' 	}')); ?></span>&nbsp;
		<input type="radio" name="pin" value="0"<?php echo $this->_tpldata['.'][0]['PIN_CHECKED_NO']; ?> /><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_NO'])) ? $this->_tpldata['.'][0]['L_NO'] : ((isset($lang['NO'])) ? $lang['NO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'NO'))) . ' 	}')); ?></span>&nbsp;
	</td>
  </tr>
  <tr>
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_DOWNLOAD'])) ? $this->_tpldata['.'][0]['L_FILE_DOWNLOAD'] : ((isset($lang['FILE_DOWNLOAD'])) ? $lang['FILE_DOWNLOAD'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_DOWNLOAD'))) . ' 	}')); ?></span></td>
	<td class="row2"><input type="text" class="post" size="10" name="file_download" value="<?php echo $this->_tpldata['.'][0]['FILE_DOWNLOAD']; ?>" /></td>
  </tr> 
<?php } ?><!--  
  <tr>
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_APPROVED'])) ? $this->_tpldata['.'][0]['L_FILE_APPROVED'] : ((isset($lang['FILE_APPROVED'])) ? $lang['FILE_APPROVED'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_APPROVED'))) . ' 	}')); ?></span><br><span class="gensmall"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_APPROVED_INFO'])) ? $this->_tpldata['.'][0]['L_FILE_APPROVED_INFO'] : ((isset($lang['FILE_APPROVED_INFO'])) ? $lang['FILE_APPROVED_INFO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_APPROVED_INFO'))) . ' 	}')); ?></span></td>
	<td class="row2">
	<input type="radio" name="approved" value="1" <?php echo $this->_tpldata['.'][0]['APPROVED_CHECKED_YES']; ?>><?php echo ((isset($this->_tpldata['.'][0]['L_YES'])) ? $this->_tpldata['.'][0]['L_YES'] : ((isset($lang['YES'])) ? $lang['YES'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'YES'))) . ' 	}')); ?>&nbsp;
	<input type="radio" name="approved" value="0" <?php echo $this->_tpldata['.'][0]['APPROVED_CHECKED_NO']; ?>><?php echo ((isset($this->_tpldata['.'][0]['L_NO'])) ? $this->_tpldata['.'][0]['L_NO'] : ((isset($lang['NO'])) ? $lang['NO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'NO'))) . ' 	}')); ?>&nbsp;
	</td>
  </tr>
-->
  <tr>
	<td class="cat" colspan="2" align="center"><span class="cattitle"><?php echo ((isset($this->_tpldata['.'][0]['L_SCREENSHOT'])) ? $this->_tpldata['.'][0]['L_SCREENSHOT'] : ((isset($lang['SCREENSHOT'])) ? $lang['SCREENSHOT'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SCREENSHOT'))) . ' 	}')); ?></span></td>
  </tr>  
  <tr>
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FILESS_UPLOAD'])) ? $this->_tpldata['.'][0]['L_FILESS_UPLOAD'] : ((isset($lang['FILESS_UPLOAD'])) ? $lang['FILESS_UPLOAD'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILESS_UPLOAD'))) . ' 	}')); ?></span><br><span class="gensmall"><?php echo ((isset($this->_tpldata['.'][0]['L_FILESSINFO_UPLOAD'])) ? $this->_tpldata['.'][0]['L_FILESSINFO_UPLOAD'] : ((isset($lang['FILESSINFO_UPLOAD'])) ? $lang['FILESSINFO_UPLOAD'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILESSINFO_UPLOAD'))) . ' 	}')); ?></span></td>
	<td class="row2">
		<input type="file" size="50" name="screen_shot" maxlength="<?php echo $this->_tpldata['.'][0]['FILESIZE']; ?>" class="post" />
	</td>
  </tr>  
  <tr>
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FILESS'])) ? $this->_tpldata['.'][0]['L_FILESS'] : ((isset($lang['FILESS'])) ? $lang['FILESS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILESS'))) . ' 	}')); ?></span><br><span class="gensmall"><?php echo ((isset($this->_tpldata['.'][0]['L_FILESSINFO'])) ? $this->_tpldata['.'][0]['L_FILESSINFO'] : ((isset($lang['FILESSINFO'])) ? $lang['FILESSINFO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILESSINFO'))) . ' 	}')); ?></span></td>
	<td class="row2">
		<input type="text" class="post" size="50" name="screen_shot_url" value="<?php echo $this->_tpldata['.'][0]['FILE_SSURL']; ?>">
	</td>
  </tr>
  <tr>
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_SSLINK'])) ? $this->_tpldata['.'][0]['L_FILE_SSLINK'] : ((isset($lang['FILE_SSLINK'])) ? $lang['FILE_SSLINK'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_SSLINK'))) . ' 	}')); ?></span><br><span class="gensmall"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_SSLINK_INFO'])) ? $this->_tpldata['.'][0]['L_FILE_SSLINK_INFO'] : ((isset($lang['FILE_SSLINK_INFO'])) ? $lang['FILE_SSLINK_INFO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_SSLINK_INFO'))) . ' 	}')); ?></span></td>
	<td class="row2">
	<input type="radio" name="sshot_link" value="1" <?php echo $this->_tpldata['.'][0]['SS_CHECKED_YES']; ?>><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_YES'])) ? $this->_tpldata['.'][0]['L_YES'] : ((isset($lang['YES'])) ? $lang['YES'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'YES'))) . ' 	}')); ?></span>&nbsp;
	<input type="radio" name="sshot_link" value="0" <?php echo $this->_tpldata['.'][0]['SS_CHECKED_NO']; ?>><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_NO'])) ? $this->_tpldata['.'][0]['L_NO'] : ((isset($lang['NO'])) ? $lang['NO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'NO'))) . ' 	}')); ?></span>&nbsp;
	</td>
  </tr>  
  <tr>
	<td class="cat" colspan="2" align="center"><span class="cattitle"><?php echo ((isset($this->_tpldata['.'][0]['L_FILES'])) ? $this->_tpldata['.'][0]['L_FILES'] : ((isset($lang['FILES'])) ? $lang['FILES'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILES'))) . ' 	}')); ?></span></td>
  </tr>  
  <tr>
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_UPLOAD'])) ? $this->_tpldata['.'][0]['L_FILE_UPLOAD'] : ((isset($lang['FILE_UPLOAD'])) ? $lang['FILE_UPLOAD'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_UPLOAD'))) . ' 	}')); ?></span><br><span class="gensmall"><?php echo ((isset($this->_tpldata['.'][0]['L_FILEINFO_UPLOAD'])) ? $this->_tpldata['.'][0]['L_FILEINFO_UPLOAD'] : ((isset($lang['FILEINFO_UPLOAD'])) ? $lang['FILEINFO_UPLOAD'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILEINFO_UPLOAD'))) . ' 	}')); ?></span></td>
	<td class="row2">
		<input type="file" size="50" name="userfile" maxlength="<?php echo $this->_tpldata['.'][0]['FILESIZE']; ?>" class="post" />
	</td>
  </tr>  
  <tr>
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_URL'])) ? $this->_tpldata['.'][0]['L_FILE_URL'] : ((isset($lang['FILE_URL'])) ? $lang['FILE_URL'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_URL'))) . ' 	}')); ?></span><br><span class="gensmall"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE_URL_INFO'])) ? $this->_tpldata['.'][0]['L_FILE_URL_INFO'] : ((isset($lang['FILE_URL_INFO'])) ? $lang['FILE_URL_INFO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_URL_INFO'))) . ' 	}')); ?></span></td>
	<td class="row2">
		<input type="text" class="post" size="50" name="download_url" value="<?php echo $this->_tpldata['.'][0]['FILE_DLURL']; ?>">
	</td>
  </tr>
<?php if ($this->_tpldata['.'][0]['CUSTOM_EXIST']) {  ?>
  <tr>
	<td class="cat" colspan="2" align="center"><span class="cattitle"><?php echo ((isset($this->_tpldata['.'][0]['L_ADDTIONAL_FIELD'])) ? $this->_tpldata['.'][0]['L_ADDTIONAL_FIELD'] : ((isset($lang['ADDTIONAL_FIELD'])) ? $lang['ADDTIONAL_FIELD'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'ADDTIONAL_FIELD'))) . ' 	}')); ?></span></td>
  </tr>
<?php }$this->_tpl_include('pa_custom_field.tpl'); ?>
  <tr>
	<td align="center" class="cat" colspan="2"><?php echo $this->_tpldata['.'][0]['S_HIDDEN_FIELDS']; ?><input class="mainoption" type="submit" value="<?php echo ((isset($this->_tpldata['.'][0]['L_FILE_TITLE'])) ? $this->_tpldata['.'][0]['L_FILE_TITLE'] : ((isset($lang['FILE_TITLE'])) ? $lang['FILE_TITLE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE_TITLE'))) . ' 	}')); ?>" name="submit"></td>
  </tr>
</table>	
</form>
<?php $this->_tpl_include('pa_footer.tpl'); ?>