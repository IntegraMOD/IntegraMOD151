<?php $this->_tpl_include('pa_header.tpl'); ?>
<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom">
		<span class="nav"><a href="<?php echo $this->_tpldata['.'][0]['U_INDEX']; ?>" class="nav"><?php echo ((isset($this->_tpldata['.'][0]['L_INDEX'])) ? $this->_tpldata['.'][0]['L_INDEX'] : ((isset($lang['INDEX'])) ? $lang['INDEX'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'INDEX'))) . ' 	}')); ?></a> -> <a href="<?php echo $this->_tpldata['.'][0]['U_DOWNLOAD']; ?>" class="nav"><?php echo $this->_tpldata['.'][0]['DOWNLOAD']; ?></a></span>
	</td>
  </tr>
</table>

<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr>
	<th class="thCornerL" width="6%">&nbsp;</th>
	<th class="thTop"><?php echo ((isset($this->_tpldata['.'][0]['L_CATEGORY'])) ? $this->_tpldata['.'][0]['L_CATEGORY'] : ((isset($lang['CATEGORY'])) ? $lang['CATEGORY'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'CATEGORY'))) . ' 	}')); ?></th>
	<th class="thCornerR" width="10%"><?php echo ((isset($this->_tpldata['.'][0]['L_LAST_FILE'])) ? $this->_tpldata['.'][0]['L_LAST_FILE'] : ((isset($lang['LAST_FILE'])) ? $lang['LAST_FILE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'LAST_FILE'))) . ' 	}')); ?></th>	
	<th class="thCornerR" width="8%"><?php echo ((isset($this->_tpldata['.'][0]['L_FILES'])) ? $this->_tpldata['.'][0]['L_FILES'] : ((isset($lang['FILES'])) ? $lang['FILES'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILES'))) . ' 	}')); ?></th>
  </tr>
<?php $_no_cat_parent_count = (isset($this->_tpldata['no_cat_parent'])) ?  sizeof($this->_tpldata['no_cat_parent']) : 0;if ($_no_cat_parent_count) {for ($this->_no_cat_parent_i = 0; $this->_no_cat_parent_i < $_no_cat_parent_count; $this->_no_cat_parent_i++){if ($this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['IS_HIGHER_CAT']) {  ?>
<tr>
	<td class="cat" colspan="2" valign="middle"><a href="<?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['U_CAT']; ?>" class="cattitle"><?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['CAT_NAME']; ?></a></td>
	<td class="rowpic" colspan="2" align="right">&nbsp;</td>
</tr>
	<?php } else { ?>
<tr>
	<td class="row1" valign="middle" align="center"><a href="<?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['U_CAT']; ?>" class="cattitle"><img src="<?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['CAT_IMAGE']; ?>" border="0" alt="<?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['CAT_NEW_FILE']; ?>"></a></td>
	<td class="row1" valign="middle"><a href="<?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['U_CAT']; ?>" class="cattitle"><?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['CAT_NAME']; ?></a><br><span class="genmed"><?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['CAT_DESC']; ?></span><br><span class="gensmall"><b><?php echo ((isset($this->_tpldata['.'][0]['L_SUB_CAT'])) ? $this->_tpldata['.'][0]['L_SUB_CAT'] : ((isset($lang['SUB_CAT'])) ? $lang['SUB_CAT'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SUB_CAT'))) . ' 	}')); ?>:</b> </span><span class="gensmall"><?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['SUB_CAT']; ?></span></b></td>
	<td class="row2" align="center" valign="middle" nowrap="nowrap"><span class="genmed"><?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['LAST_FILE']; ?></span></td>
	<td class="row2" align="center" valign="middle"><span class="genmed"><?php echo $this->_tpldata['no_cat_parent'][$this->_no_cat_parent_i]['FILECAT']; ?></span></td>
</tr>
	<?php }}} ?>

  <tr> 
	<td class="cat" colspan="4">&nbsp;</td>
  </tr>
</table>
<?php $this->_tpl_include('pa_footer.tpl'); ?>