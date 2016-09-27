<?php $this->_tpl_include('pa_header.tpl'); ?>
<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom">
		<span class="nav"><a href="<?php echo $this->_tpldata['.'][0]['U_INDEX']; ?>" class="nav"><?php echo ((isset($this->_tpldata['.'][0]['L_INDEX'])) ? $this->_tpldata['.'][0]['L_INDEX'] : ((isset($lang['INDEX'])) ? $lang['INDEX'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'INDEX'))) . ' 	}')); ?></a> -> <a href="<?php echo $this->_tpldata['.'][0]['U_DOWNLOAD']; ?>" class="nav"><?php echo $this->_tpldata['.'][0]['DOWNLOAD']; ?></a> -> <?php echo ((isset($this->_tpldata['.'][0]['L_TOPLIST'])) ? $this->_tpldata['.'][0]['L_TOPLIST'] : ((isset($lang['TOPLIST'])) ? $lang['TOPLIST'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'TOPLIST'))) . ' 	}')); ?></span>
	</td>
  </tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr> 
	<th class="thHead" colspan="7"><?php echo ((isset($this->_tpldata['.'][0]['L_TOPLIST'])) ? $this->_tpldata['.'][0]['L_TOPLIST'] : ((isset($lang['TOPLIST'])) ? $lang['TOPLIST'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'TOPLIST'))) . ' 	}')); ?></th>
  </tr>
	<tr> 
		<td colspan="7" class="row1" align="center"><span class="gen"><b><?php echo ((isset($this->_tpldata['.'][0]['L_CURRENT_TOPLIST'])) ? $this->_tpldata['.'][0]['L_CURRENT_TOPLIST'] : ((isset($lang['CURRENT_TOPLIST'])) ? $lang['CURRENT_TOPLIST'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'CURRENT_TOPLIST'))) . ' 	}')); ?> - <?php echo ((isset($this->_tpldata['.'][0]['L_NEW_FILES'])) ? $this->_tpldata['.'][0]['L_NEW_FILES'] : ((isset($lang['NEW_FILES'])) ? $lang['NEW_FILES'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'NEW_FILES'))) . ' 	}')); ?></b></span></td>
	</tr>
	<tr>
		<td colspan="7" class="row2" align="center"><span class="genmed"><a href="<?php echo $this->_tpldata['.'][0]['U_NEWEST_FILE']; ?>" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_NEWEST_FILE'])) ? $this->_tpldata['.'][0]['L_NEWEST_FILE'] : ((isset($lang['NEWEST_FILE'])) ? $lang['NEWEST_FILE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'NEWEST_FILE'))) . ' 	}')); ?></a> | <a href="<?php echo $this->_tpldata['.'][0]['U_MOST_POPULAR']; ?>" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_MOST_POPULAR'])) ? $this->_tpldata['.'][0]['L_MOST_POPULAR'] : ((isset($lang['MOST_POPULAR'])) ? $lang['MOST_POPULAR'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'MOST_POPULAR'))) . ' 	}')); ?></a> | <a href="<?php echo $this->_tpldata['.'][0]['U_TOP_RATED']; ?>" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_TOP_RATED'])) ? $this->_tpldata['.'][0]['L_TOP_RATED'] : ((isset($lang['TOP_RATED'])) ? $lang['TOP_RATED'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'TOP_RATED'))) . ' 	}')); ?></a></span></td>
	</tr>
<?php if ($this->_tpldata['.'][0]['IS_NEWEST']) {  ?>	
	<tr> 
		<td colspan="7" class="row1" align="center">
			<span class="gen">
				<b><?php echo ((isset($this->_tpldata['.'][0]['L_TOTAL_NEW_FILE'])) ? $this->_tpldata['.'][0]['L_TOTAL_NEW_FILE'] : ((isset($lang['TOTAL_NEW_FILE'])) ? $lang['TOTAL_NEW_FILE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'TOTAL_NEW_FILE'))) . ' 	}')); ?>:</b> <?php echo ((isset($this->_tpldata['.'][0]['L_LAST_WEEK'])) ? $this->_tpldata['.'][0]['L_LAST_WEEK'] : ((isset($lang['LAST_WEEK'])) ? $lang['LAST_WEEK'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'LAST_WEEK'))) . ' 	}')); ?> ( <?php echo $this->_tpldata['.'][0]['TOTAL_FILE_WEEK']; ?> ) | <?php echo ((isset($this->_tpldata['.'][0]['L_LAST_30_DAYS'])) ? $this->_tpldata['.'][0]['L_LAST_30_DAYS'] : ((isset($lang['LAST_30_DAYS'])) ? $lang['LAST_30_DAYS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'LAST_30_DAYS'))) . ' 	}')); ?> ( <?php echo $this->_tpldata['.'][0]['TOTAL_FILE_MONTH']; ?> )<br />
				<b><?php echo ((isset($this->_tpldata['.'][0]['L_SHOW'])) ? $this->_tpldata['.'][0]['L_SHOW'] : ((isset($lang['SHOW'])) ? $lang['SHOW'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SHOW'))) . ' 	}')); ?>:</b> <a href="<?php echo $this->_tpldata['.'][0]['U_ONE_WEEK']; ?>" class="gen"><?php echo ((isset($this->_tpldata['.'][0]['L_ONE_WEEK'])) ? $this->_tpldata['.'][0]['L_ONE_WEEK'] : ((isset($lang['ONE_WEEK'])) ? $lang['ONE_WEEK'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'ONE_WEEK'))) . ' 	}')); ?></a> - <a href="<?php echo $this->_tpldata['.'][0]['U_TWO_WEEK']; ?>" class="gen"><?php echo ((isset($this->_tpldata['.'][0]['L_TWO_WEEK'])) ? $this->_tpldata['.'][0]['L_TWO_WEEK'] : ((isset($lang['TWO_WEEK'])) ? $lang['TWO_WEEK'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'TWO_WEEK'))) . ' 	}')); ?></a> - <a href="<?php echo $this->_tpldata['.'][0]['U_30_DAYS']; ?>" class="gen"><?php echo ((isset($this->_tpldata['.'][0]['L_30_DAYS'])) ? $this->_tpldata['.'][0]['L_30_DAYS'] : ((isset($lang['30_DAYS'])) ? $lang['30_DAYS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', '30_DAYS'))) . ' 	}')); ?></a>
			</span>
		</td>
	</tr>
	<?php if ($this->_tpldata['.'][0]['FILE_DATE']) {  ?>	
	<tr> 
		<td colspan="7" class="row1" align="center">
		<span class="gen">
		<?php $_files_date_count = (isset($this->_tpldata['files_date'])) ?  sizeof($this->_tpldata['files_date']) : 0;if ($_files_date_count) {for ($this->_files_date_i = 0; $this->_files_date_i < $_files_date_count; $this->_files_date_i++){ ?>
		<strong><big>&middot;</big></strong> <a href="<?php echo $this->_tpldata['files_date'][$this->_files_date_i]['U_DATES']; ?>"><?php echo $this->_tpldata['files_date'][$this->_files_date_i]['DATES']; ?></a>&nbsp(<?php echo $this->_tpldata['files_date'][$this->_files_date_i]['TOTAL_DOWNLOADS']; ?>)<br />
		<?php }} ?>
		</span>
		</td>
	</tr>
	<?php }}if ($this->_tpldata['.'][0]['IS_POPULAR']) {  ?>
	<tr> 
		<td colspan="7" class="row1" align="center">
		<span class="genmed">
		<b><?php echo ((isset($this->_tpldata['.'][0]['L_SHOW_TOP'])) ? $this->_tpldata['.'][0]['L_SHOW_TOP'] : ((isset($lang['SHOW_TOP'])) ? $lang['SHOW_TOP'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SHOW_TOP'))) . ' 	}')); ?>:</b> [ <a href="<?php echo $this->_tpldata['.'][0]['U_TOP_10']; ?>" class="genmed">10</a> - <a href="<?php echo $this->_tpldata['.'][0]['U_TOP_25']; ?>" class="genmed">25</a> - <a href="<?php echo $this->_tpldata['.'][0]['U_TOP_50']; ?>" class="genmed">50</a> ]
		<b><?php echo ((isset($this->_tpldata['.'][0]['L_OR_TOP'])) ? $this->_tpldata['.'][0]['L_OR_TOP'] : ((isset($lang['OR_TOP'])) ? $lang['OR_TOP'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'OR_TOP'))) . ' 	}')); ?>:</b> [ <a href="<?php echo $this->_tpldata['.'][0]['U_TOP_PER_1']; ?>" class="genmed">1%</a> - <a href="<?php echo $this->_tpldata['.'][0]['U_TOP_PER_5']; ?>" class="genmed">5%</a> - <a href="<?php echo $this->_tpldata['.'][0]['U_TOP_PER_10']; ?>" class="genmed">10%</a> ]
		</span>
		</td>
	</tr>

<?php }if ($this->_tpldata['.'][0]['FILE_LIST']) {  ?>
  <tr> 
	<td width="4%" align="center" class="cat" nowrap="nowrap">&nbsp;</td>
	<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">&nbsp;<?php echo ((isset($this->_tpldata['.'][0]['L_CATEGORY'])) ? $this->_tpldata['.'][0]['L_CATEGORY'] : ((isset($lang['CATEGORY'])) ? $lang['CATEGORY'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'CATEGORY'))) . ' 	}')); ?>&nbsp;</span></td>
	<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">&nbsp;<?php echo ((isset($this->_tpldata['.'][0]['L_FILE'])) ? $this->_tpldata['.'][0]['L_FILE'] : ((isset($lang['FILE'])) ? $lang['FILE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FILE'))) . ' 	}')); ?>&nbsp;</span></td>
	<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">&nbsp;<?php echo ((isset($this->_tpldata['.'][0]['L_SUBMITER'])) ? $this->_tpldata['.'][0]['L_SUBMITER'] : ((isset($lang['SUBMITER'])) ? $lang['SUBMITER'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SUBMITER'))) . ' 	}')); ?>&nbsp;</span></td>
	<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">&nbsp;<?php echo ((isset($this->_tpldata['.'][0]['L_DATE'])) ? $this->_tpldata['.'][0]['L_DATE'] : ((isset($lang['DATE'])) ? $lang['DATE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DATE'))) . ' 	}')); ?>&nbsp;</span></td>
	<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">&nbsp;<?php echo ((isset($this->_tpldata['.'][0]['L_DOWNLOADS'])) ? $this->_tpldata['.'][0]['L_DOWNLOADS'] : ((isset($lang['DOWNLOADS'])) ? $lang['DOWNLOADS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DOWNLOADS'))) . ' 	}')); ?>&nbsp;</span></td>
	<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">&nbsp;<?php echo ((isset($this->_tpldata['.'][0]['L_RATE'])) ? $this->_tpldata['.'][0]['L_RATE'] : ((isset($lang['RATE'])) ? $lang['RATE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'RATE'))) . ' 	}')); ?>&nbsp;</span></td>
  </tr>
		<?php $_files_row_count = (isset($this->_tpldata['files_row'])) ?  sizeof($this->_tpldata['files_row']) : 0;if ($_files_row_count) {for ($this->_files_row_i = 0; $this->_files_row_i < $_files_row_count; $this->_files_row_i++){ ?>
  <tr> 
	<td class="row1" align="center" valign="middle"><a href="<?php echo $this->_tpldata['files_row'][$this->_files_row_i]['U_FILE']; ?>" class="topictitle"><?php echo $this->_tpldata['files_row'][$this->_files_row_i]['PIN_IMAGE']; ?></a></td>
	<td class="row1"><span class="forumlink"><a href="<?php echo $this->_tpldata['files_row'][$this->_files_row_i]['U_CAT']; ?>" class="forumlink"><?php echo $this->_tpldata['files_row'][$this->_files_row_i]['CAT_NAME']; ?></a></span></td>
	<td class="row1" valign="middle"><a href="<?php echo $this->_tpldata['files_row'][$this->_files_row_i]['U_FILE']; ?>" class="topictitle"><?php echo $this->_tpldata['files_row'][$this->_files_row_i]['FILE_NAME']; ?></a>&nbsp;<?php if ($this->_tpldata['files_row'][$this->_files_row_i]['IS_NEW_FILE']) {  ?><img src="<?php echo $this->_tpldata['files_row'][$this->_files_row_i]['FILE_NEW_IMAGE']; ?>" border="0" alt="<?php echo ((isset($this->_tpldata['.'][0]['L_NEW_FILE'])) ? $this->_tpldata['.'][0]['L_NEW_FILE'] : ((isset($lang['NEW_FILE'])) ? $lang['NEW_FILE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'NEW_FILE'))) . ' 	}')); ?>"><?php } ?><br /><span class="genmed"><?php echo $this->_tpldata['files_row'][$this->_files_row_i]['FILE_DESC']; ?></span></td>
	<td class="row1" align="center" valign="middle"><span class="name"><?php echo $this->_tpldata['files_row'][$this->_files_row_i]['FILE_SUBMITER']; ?></span></td>
	<td class="row2" align="center" valign="middle"><span class="postdetails"><?php echo $this->_tpldata['files_row'][$this->_files_row_i]['DATE']; ?></span></td>
	<td class="row1" align="center" valign="middle"><span class="postdetails"><?php echo $this->_tpldata['files_row'][$this->_files_row_i]['DOWNLOADS']; ?></span></td>
	<td class="row2" align="center" valign="middle" nowrap="nowrap"><span class="postdetails"><?php echo $this->_tpldata['files_row'][$this->_files_row_i]['RATING']; ?></span></td>
  </tr> 
		<?php }} ?>
  <tr> 
	<td colspan="7" class="cat" align="center">&nbsp </td>
  </tr>
<?php } ?>	
</table>
<?php $this->_tpl_include('pa_footer.tpl'); ?>