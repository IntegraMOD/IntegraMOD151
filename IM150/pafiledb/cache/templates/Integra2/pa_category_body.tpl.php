<?php $this->_tpl_include('pa_header.tpl'); ?>
<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom">
		<span class="nav"><a href="<?php echo $this->_tpldata['.'][0]['U_INDEX']; ?>" class="nav"><?php echo ((isset($this->_tpldata['.'][0]['L_INDEX'])) ? $this->_tpldata['.'][0]['L_INDEX'] : ((isset($lang['INDEX'])) ? $lang['INDEX'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'INDEX'))) . ' 	}')); ?></a> -> <a href="<?php echo $this->_tpldata['.'][0]['U_DOWNLOAD']; ?>" class="nav"><?php echo $this->_tpldata['.'][0]['DOWNLOAD']; ?></a><?php $_navlinks_count = (isset($this->_tpldata['navlinks'])) ?  sizeof($this->_tpldata['navlinks']) : 0;if ($_navlinks_count) {for ($this->_navlinks_i = 0; $this->_navlinks_i < $_navlinks_count; $this->_navlinks_i++){ ?> -> <a href="<?php echo $this->_tpldata['navlinks'][$this->_navlinks_i]['U_VIEW_CAT']; ?>" class="nav"><?php echo $this->_tpldata['navlinks'][$this->_navlinks_i]['CAT_NAME']; ?></a><?php }} ?></span>
	</td>
  </tr>
</table>

<?php if ($this->_tpldata['.'][0]['CAT_PARENT']) {  ?>
<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr> 
	<th class="thCornerL" width="6%">&nbsp;</th>
	<th class="thTop"><?php echo ((isset($this->_tpldata['.'][0]['L_CATEGORY'])) ? $this->_tpldata['.'][0]['L_CATEGORY'] : ((isset($lang['CATEGORY'])) ? $lang['CATEGORY'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'CATEGORY'))) . ' 	}')); ?></th>
	<th class="thTop" width="10%"><?php echo ((isset($this->_tpldata['.'][0]['L_LAST_FILE'])) ? $this->_tpldata['.'][0]['L_LAST_FILE'] : ((isset($lang['LAST_FILE'])) ? $lang['LAST_FILE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'LAST_FILE'))) . ' 	}')); ?></th>
	<th class="thCornerR" width="8%"><?php echo ((isset($this->_tpldata['.'][0]['L_FILES'])) ? $this->_tpldata['.'][0]['L_FILES'] : ((isset($lang['FILES'])) ? $lang['FILES'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILES'))) . ' 	}')); ?></th>
  </tr>
<?php $_no_cat_parent_count = (isset($this->_tpldata['no_cat_parent'])) ?  sizeof($this->_tpldata['no_cat_parent']) : 0;if ($_no_cat_parent_count) {for ($this->_no_cat_parent_i = 0; $this->_no_cat_parent_i < $_no_cat_parent_count; $this->_no_cat_parent_i++){if ($this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['IS_HIGHER_CAT']) {  ?>
<tr>
	<td class="cat" colspan="2" valign="middle"><a href="<?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['U_CAT']; ?>" class="cattitle"><?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['CAT_NAME']; ?></a></td>
	<td class="rowpic" colspan="2" align="right">&nbsp;</td>
</tr>
	<?php } else { ?>
  <tr> 
	<td class="row1" align="center" valign="middle"><a href="<?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['U_CAT']; ?>" class="cattitle"><img src="<?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['CAT_IMAGE']; ?>" border="0" alt="<?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['CAT_NEW_FILE']; ?>"></a></td>
	<td class="row1" valign="middle"><a href="<?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['U_CAT']; ?>" class="cattitle"><?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['CAT_NAME']; ?></a><br><span class="genmed"><?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['CAT_DESC']; ?></span><br><span class="gensmall"><b><?php echo ((isset($this->_tpldata['.'][0]['L_SUB_CAT'])) ? $this->_tpldata['.'][0]['L_SUB_CAT'] : ((isset($lang['SUB_CAT'])) ? $lang['SUB_CAT'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SUB_CAT'))) . ' 	}')); ?>:</b> </span><span class="gensmall"><?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['SUB_CAT']; ?></span></b></td>
	<td class="row2" align="center" valign="middle" nowrap="nowrap"><span class="genmed"><?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['LAST_FILE']; ?></span></td>
	<td class="row2" align="center" valign="middle"><span class="genmed"><?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['FILECAT']; ?></span></td>
  </tr>
	<?php }}} ?>

  <tr> 
	<td class="cat" colspan="4">&nbsp;</td>
  </tr>
</table>
<br>
<?php }if ($this->_tpldata['.'][0]['FILELIST']) {  ?>
<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr> 
	<th class="thCornerL" width="5%">&nbsp;</th>
	<th class="thTop" width="57%"><?php echo ((isset($this->_tpldata['.'][0]['L_FILE'])) ? $this->_tpldata['.'][0]['L_FILE'] : ((isset($lang['FILE'])) ? $lang['FILE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE'))) . ' 	}')); ?></th>
	<th class="thTop" width="15%"><?php echo ((isset($this->_tpldata['.'][0]['L_DATE'])) ? $this->_tpldata['.'][0]['L_DATE'] : ((isset($lang['DATE'])) ? $lang['DATE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DATE'))) . ' 	}')); ?></th>
	<th class="thTop" width="10%"><?php echo ((isset($this->_tpldata['.'][0]['L_DOWNLOADS'])) ? $this->_tpldata['.'][0]['L_DOWNLOADS'] : ((isset($lang['DOWNLOADS'])) ? $lang['DOWNLOADS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DOWNLOADS'))) . ' 	}')); ?></th>
	<th class="thTop" width="10%"><?php echo ((isset($this->_tpldata['.'][0]['L_RATING'])) ? $this->_tpldata['.'][0]['L_RATING'] : ((isset($lang['RATING'])) ? $lang['RATING'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'RATING'))) . ' 	}')); ?></th>
	<th class="thCornerR" width="3%">&nbsp;</th>
  </tr>
  
<?php $_file_rows_count = (isset($this->_tpldata['file_rows'])) ?  sizeof($this->_tpldata['file_rows']) : 0;if ($_file_rows_count) {for ($this->_file_rows_i = 0; $this->_file_rows_i < $_file_rows_count; $this->_file_rows_i++){ ?>
  <tr> 
	<td class="row1" align="center" valign="middle"><a href="<?php echo $this->_tpldata['file_rows'][$this->_file_rows_i]['U_FILE']; ?>" class="topictitle"><img src="<?php echo $this->_tpldata['file_rows'][$this->_file_rows_i]['PIN_IMAGE']; ?>" border="0"></a></td>
	<td class="row1" valign="middle"><a href="<?php echo $this->_tpldata['file_rows'][$this->_file_rows_i]['U_FILE']; ?>" class="topictitle"><?php echo $this->_tpldata['file_rows'][$this->_file_rows_i]['FILE_NAME']; ?></a>&nbsp;<?php if ($this->_tpldata['file_rows'][$this->_file_rows_i]['IS_NEW_FILE']) {  ?><img src="<?php echo $this->_tpldata['file_rows'][$this->_file_rows_i]['FILE_NEW_IMAGE']; ?>" border="0" alt="<?php echo ((isset($this->_tpldata['.'][0]['L_NEW_FILE'])) ? $this->_tpldata['.'][0]['L_NEW_FILE'] : ((isset($lang['NEW_FILE'])) ? $lang['NEW_FILE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'NEW_FILE'))) . ' 	}')); ?>"><?php } ?><br><span class="genmed"><?php echo $this->_tpldata['file_rows'][$this->_file_rows_i]['FILE_DESC']; ?></span></td>
	<td class="row2" align="center" valign="middle" nowrap="nowrap"><span class="postdetails"><?php echo $this->_tpldata['file_rows'][$this->_file_rows_i]['DATE']; ?></td>
	<td class="row2" align="center" valign="middle"><span class="postdetails"><?php echo $this->_tpldata['file_rows'][$this->_file_rows_i]['FILE_DLS']; ?></td>
	<td class="row2" align="center" valign="middle" nowrap="nowrap"><span class="postdetails"><?php echo $this->_tpldata['file_rows'][$this->_file_rows_i]['RATING']; ?></td>
	<td class="row2" align="center" valign="middle">
	<?php if ($this->_tpldata['file_rows'][$this->_file_rows_i]['HAS_SCREENSHOTS']) { if ($this->_tpldata['file_rows'][$this->_file_rows_i]['SS_AS_LINK']) {  ?>
	<a href="<?php echo $this->_tpldata['file_rows'][$this->_file_rows_i]['FILE_SCREENSHOT']; ?>" class="topictitle" target="_blank"><img src="<?php echo $this->_tpldata['file_rows'][$this->_file_rows_i]['FILE_SCREENSHOT_URL']; ?>" border="0" alt="<?php echo ((isset($this->_tpldata['.'][0]['L_SCREENSHOTS'])) ? $this->_tpldata['.'][0]['L_SCREENSHOTS'] : ((isset($lang['SCREENSHOTS'])) ? $lang['SCREENSHOTS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SCREENSHOTS'))) . ' 	}')); ?>"></a>
		<?php } else { ?>
	<a href="javascript:mpFoto('<?php echo $this->_tpldata['file_rows'][$this->_file_rows_i]['FILE_SCREENSHOT']; ?>')" class="topictitle"><img src="<?php echo $this->_tpldata['file_rows'][$this->_file_rows_i]['FILE_SCREENSHOT_URL']; ?>" border="0" alt="<?php echo ((isset($this->_tpldata['.'][0]['L_SCREENSHOTS'])) ? $this->_tpldata['.'][0]['L_SCREENSHOTS'] : ((isset($lang['SCREENSHOTS'])) ? $lang['SCREENSHOTS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SCREENSHOTS'))) . ' 	}')); ?>"></a>
		<?php }} else { ?>
	&nbsp;
	<?php } ?>
	</td>
  </tr>
<?php }} ?>

<form action="<?php echo $this->_tpldata['.'][0]['S_ACTION_SORT']; ?>" method="post">
<input type="hidden" name="action" value="category">
<input type="hidden" name="cat_id" value="<?php echo $this->_tpldata['.'][0]['ID']; ?>">
<input type="hidden" name="start" value="<?php echo $this->_tpldata['.'][0]['START']; ?>">
  <tr> 
	<td class="cat" align="center" colspan="6"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_SELECT_SORT_METHOD'])) ? $this->_tpldata['.'][0]['L_SELECT_SORT_METHOD'] : ((isset($lang['SELECT_SORT_METHOD'])) ? $lang['SELECT_SORT_METHOD'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SELECT_SORT_METHOD'))) . ' 	}')); ?>:&nbsp;
	<select name="sort_method">
		<option <?php echo $this->_tpldata['.'][0]['SORT_NAME']; ?> value='file_name'><?php echo ((isset($this->_tpldata['.'][0]['L_NAME'])) ? $this->_tpldata['.'][0]['L_NAME'] : ((isset($lang['NAME'])) ? $lang['NAME'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'NAME'))) . ' 	}')); ?></option>
		<option <?php echo $this->_tpldata['.'][0]['SORT_TIME']; ?> value='file_time'><?php echo ((isset($this->_tpldata['.'][0]['L_DATE'])) ? $this->_tpldata['.'][0]['L_DATE'] : ((isset($lang['DATE'])) ? $lang['DATE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DATE'))) . ' 	}')); ?></option>
		<option <?php echo $this->_tpldata['.'][0]['SORT_RATING']; ?> value='file_rating'><?php echo ((isset($this->_tpldata['.'][0]['L_RATING'])) ? $this->_tpldata['.'][0]['L_RATING'] : ((isset($lang['RATING'])) ? $lang['RATING'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'RATING'))) . ' 	}')); ?></option>
		<option <?php echo $this->_tpldata['.'][0]['SORT_DOWNLOADS']; ?> value='file_dls'><?php echo ((isset($this->_tpldata['.'][0]['L_DOWNLOADS'])) ? $this->_tpldata['.'][0]['L_DOWNLOADS'] : ((isset($lang['DOWNLOADS'])) ? $lang['DOWNLOADS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DOWNLOADS'))) . ' 	}')); ?></option>
		<option <?php echo $this->_tpldata['.'][0]['SORT_UPDATE_TIME']; ?> value='file_update_time'><?php echo ((isset($this->_tpldata['.'][0]['L_UPDATE_TIME'])) ? $this->_tpldata['.'][0]['L_UPDATE_TIME'] : ((isset($lang['UPDATE_TIME'])) ? $lang['UPDATE_TIME'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'UPDATE_TIME'))) . ' 	}')); ?></option>
	</select>
		&nbsp;<?php echo ((isset($this->_tpldata['.'][0]['L_ORDER'])) ? $this->_tpldata['.'][0]['L_ORDER'] : ((isset($lang['ORDER'])) ? $lang['ORDER'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'ORDER'))) . ' 	}')); ?>:
		<select name="sort_order">
			<option <?php echo $this->_tpldata['.'][0]['SORT_ASC']; ?> value="ASC"><?php echo ((isset($this->_tpldata['.'][0]['L_ASC'])) ? $this->_tpldata['.'][0]['L_ASC'] : ((isset($lang['ASC'])) ? $lang['ASC'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'ASC'))) . ' 	}')); ?></option>
			<option <?php echo $this->_tpldata['.'][0]['SORT_DESC']; ?> value="DESC"><?php echo ((isset($this->_tpldata['.'][0]['L_DESC'])) ? $this->_tpldata['.'][0]['L_DESC'] : ((isset($lang['DESC'])) ? $lang['DESC'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DESC'))) . ' 	}')); ?></option>
		</select>
	&nbsp;<input type="submit" name="submit" value="<?php echo ((isset($this->_tpldata['.'][0]['L_SORT'])) ? $this->_tpldata['.'][0]['L_SORT'] : ((isset($lang['SORT'])) ? $lang['SORT'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SORT'))) . ' 	}')); ?>" class="liteoption" />
	</span></td>
  </tr>
</table>
<table width="100%" cellspacing="2" border="0" cellpadding="2">
  <tr>
	<td align="right" nowrap="nowrap"><span class="nav"><?php echo $this->_tpldata['.'][0]['PAGINATION']; ?></span></td>
  </tr>
  <tr>
	<td align="right" nowrap="nowrap"><span class="nav"><?php echo $this->_tpldata['.'][0]['PAGE_NUMBER']; ?></span></td>
  </tr>
</table>
</form>	
<?php }if ($this->_tpldata['.'][0]['NO_FILE']) {  ?>
<table class="forumline" width="100%" cellspacing="1" cellpadding="3">
	<tr>
		<th class="thHead"><?php echo ((isset($this->_tpldata['.'][0]['L_NO_FILES'])) ? $this->_tpldata['.'][0]['L_NO_FILES'] : ((isset($lang['NO_FILES'])) ? $lang['NO_FILES'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'NO_FILES'))) . ' 	}')); ?></th>
	</tr>
	<tr> 
		<td class="row1" align="center" height="30"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_NO_FILES_CAT'])) ? $this->_tpldata['.'][0]['L_NO_FILES_CAT'] : ((isset($lang['NO_FILES_CAT'])) ? $lang['NO_FILES_CAT'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'NO_FILES_CAT'))) . ' 	}')); ?></span></td>
	</tr>
</table> 
<?php }$this->_tpl_include('pa_footer.tpl'); ?>