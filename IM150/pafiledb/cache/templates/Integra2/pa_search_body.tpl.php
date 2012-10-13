<?php $this->_tpl_include('pa_header.tpl'); ?>
<form action="<?php echo $this->_tpldata['.'][0]['S_SEARCH_ACTION']; ?>" method="post">
<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom">
		<span class="nav"><a href="<?php echo $this->_tpldata['.'][0]['U_INDEX']; ?>" class="nav"><?php echo ((isset($this->_tpldata['.'][0]['L_INDEX'])) ? $this->_tpldata['.'][0]['L_INDEX'] : ((isset($lang['INDEX'])) ? $lang['INDEX'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'INDEX'))) . ' 	}')); ?></a> -> <a href="<?php echo $this->_tpldata['.'][0]['U_DOWNLOAD']; ?>" class="nav"><?php echo $this->_tpldata['.'][0]['DOWNLOAD']; ?></a> -> <?php echo ((isset($this->_tpldata['.'][0]['L_SEARCH'])) ? $this->_tpldata['.'][0]['L_SEARCH'] : ((isset($lang['SEARCH'])) ? $lang['SEARCH'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SEARCH'))) . ' 	}')); ?></span>
	</td>
  </tr>
</table>
<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr> 
	<th class="thHead" colspan="2"><?php echo ((isset($this->_tpldata['.'][0]['L_SEARCH'])) ? $this->_tpldata['.'][0]['L_SEARCH'] : ((isset($lang['SEARCH'])) ? $lang['SEARCH'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SEARCH'))) . ' 	}')); ?></th>
  </tr>
	<tr> 
		<td class="row1" width="50%"><span class="gen"><?php echo ((isset($this->_tpldata['.'][0]['L_SEARCH_KEYWORDS'])) ? $this->_tpldata['.'][0]['L_SEARCH_KEYWORDS'] : ((isset($lang['SEARCH_KEYWORDS'])) ? $lang['SEARCH_KEYWORDS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SEARCH_KEYWORDS'))) . ' 	}')); ?>:</span><br /><span class="gensmall"><?php echo ((isset($this->_tpldata['.'][0]['L_SEARCH_KEYWORDS_EXPLAIN'])) ? $this->_tpldata['.'][0]['L_SEARCH_KEYWORDS_EXPLAIN'] : ((isset($lang['SEARCH_KEYWORDS_EXPLAIN'])) ? $lang['SEARCH_KEYWORDS_EXPLAIN'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SEARCH_KEYWORDS_EXPLAIN'))) . ' 	}')); ?></span></td>
		<td class="row2" valign="top"><span class="genmed"><input type="text" style="width: 300px" class="post" name="search_keywords" size="30" /><br /><input type="radio" name="search_terms" value="any" checked="checked" /> <?php echo ((isset($this->_tpldata['.'][0]['L_SEARCH_ANY_TERMS'])) ? $this->_tpldata['.'][0]['L_SEARCH_ANY_TERMS'] : ((isset($lang['SEARCH_ANY_TERMS'])) ? $lang['SEARCH_ANY_TERMS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SEARCH_ANY_TERMS'))) . ' 	}')); ?><br /><input type="radio" name="search_terms" value="all" /> <?php echo ((isset($this->_tpldata['.'][0]['L_SEARCH_ALL_TERMS'])) ? $this->_tpldata['.'][0]['L_SEARCH_ALL_TERMS'] : ((isset($lang['SEARCH_ALL_TERMS'])) ? $lang['SEARCH_ALL_TERMS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SEARCH_ALL_TERMS'))) . ' 	}')); ?></span></td>
	</tr>
	<tr> 
		<td class="row1"><span class="gen"><?php echo ((isset($this->_tpldata['.'][0]['L_SEARCH_AUTHOR'])) ? $this->_tpldata['.'][0]['L_SEARCH_AUTHOR'] : ((isset($lang['SEARCH_AUTHOR'])) ? $lang['SEARCH_AUTHOR'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SEARCH_AUTHOR'))) . ' 	}')); ?>:</span><br /><span class="gensmall"><?php echo ((isset($this->_tpldata['.'][0]['L_SEARCH_AUTHOR_EXPLAIN'])) ? $this->_tpldata['.'][0]['L_SEARCH_AUTHOR_EXPLAIN'] : ((isset($lang['SEARCH_AUTHOR_EXPLAIN'])) ? $lang['SEARCH_AUTHOR_EXPLAIN'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SEARCH_AUTHOR_EXPLAIN'))) . ' 	}')); ?></span></td>
		<td class="row2" valign="middle"><span class="genmed"><input type="text" style="width: 300px" class="post" name="search_author" size="30" /></span></td>
	</tr>
	<tr> 
		<th class="thHead" colspan="2" height="25"><?php echo ((isset($this->_tpldata['.'][0]['L_SEARCH_OPTIONS'])) ? $this->_tpldata['.'][0]['L_SEARCH_OPTIONS'] : ((isset($lang['SEARCH_OPTIONS'])) ? $lang['SEARCH_OPTIONS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SEARCH_OPTIONS'))) . ' 	}')); ?></th>
	</tr>
  <tr> 
	<td class="row1" width="50%"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_CHOOSE_CAT'])) ? $this->_tpldata['.'][0]['L_CHOOSE_CAT'] : ((isset($lang['CHOOSE_CAT'])) ? $lang['CHOOSE_CAT'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'CHOOSE_CAT'))) . ' 	}')); ?>&nbsp; </span></td>
	<td class="row2"><select name="cat_id" class="forminput"><option value="0" selected><?php echo ((isset($this->_tpldata['.'][0]['L_ALL'])) ? $this->_tpldata['.'][0]['L_ALL'] : ((isset($lang['ALL'])) ? $lang['ALL'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'ALL'))) . ' 	}')); ?></option><?php echo $this->_tpldata['.'][0]['S_CAT_MENU']; ?></select></td>
  </tr>
  <tr> 
	<td class="row1" width="50%"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_INCLUDE_COMMENTS'])) ? $this->_tpldata['.'][0]['L_INCLUDE_COMMENTS'] : ((isset($lang['INCLUDE_COMMENTS'])) ? $lang['INCLUDE_COMMENTS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'INCLUDE_COMMENTS'))) . ' 	}')); ?>:&nbsp; </span></td>
	<td class="row2"><span class="genmed"><input type="radio" name="comments_search" value="YES" checked="checked" /> <?php echo ((isset($this->_tpldata['.'][0]['L_YES'])) ? $this->_tpldata['.'][0]['L_YES'] : ((isset($lang['YES'])) ? $lang['YES'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'YES'))) . ' 	}')); ?> <input type="radio" name="comments_search" value="NO" /> <?php echo ((isset($this->_tpldata['.'][0]['L_NO'])) ? $this->_tpldata['.'][0]['L_NO'] : ((isset($lang['NO'])) ? $lang['NO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'NO'))) . ' 	}')); ?></span></td>
  </tr>
  <tr>
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_SORT_BY'])) ? $this->_tpldata['.'][0]['L_SORT_BY'] : ((isset($lang['SORT_BY'])) ? $lang['SORT_BY'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SORT_BY'))) . ' 	}')); ?>:&nbsp;</span></td>
	<td class="row2" valign="middle" nowrap="nowrap"><span class="genmed">
	<select class="post" name="sort_method">
		<option value='file_name'><?php echo ((isset($this->_tpldata['.'][0]['L_NAME'])) ? $this->_tpldata['.'][0]['L_NAME'] : ((isset($lang['NAME'])) ? $lang['NAME'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'NAME'))) . ' 	}')); ?></option>
		<option selected="selected" value='file_time'><?php echo ((isset($this->_tpldata['.'][0]['L_DATE'])) ? $this->_tpldata['.'][0]['L_DATE'] : ((isset($lang['DATE'])) ? $lang['DATE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DATE'))) . ' 	}')); ?></option>
		<option value='file_rating'><?php echo ((isset($this->_tpldata['.'][0]['L_RATING'])) ? $this->_tpldata['.'][0]['L_RATING'] : ((isset($lang['RATING'])) ? $lang['RATING'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'RATING'))) . ' 	}')); ?></option>
		<option value='file_dls'><?php echo ((isset($this->_tpldata['.'][0]['L_DOWNLOADS'])) ? $this->_tpldata['.'][0]['L_DOWNLOADS'] : ((isset($lang['DOWNLOADS'])) ? $lang['DOWNLOADS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DOWNLOADS'))) . ' 	}')); ?></option>
		<option value='file_update_time'><?php echo ((isset($this->_tpldata['.'][0]['L_UPDATE_TIME'])) ? $this->_tpldata['.'][0]['L_UPDATE_TIME'] : ((isset($lang['UPDATE_TIME'])) ? $lang['UPDATE_TIME'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'UPDATE_TIME'))) . ' 	}')); ?></option>
	</select></span>&nbsp;</td>
  </tr>
  <tr>
	<td class="row1"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_SORT_DIR'])) ? $this->_tpldata['.'][0]['L_SORT_DIR'] : ((isset($lang['SORT_DIR'])) ? $lang['SORT_DIR'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SORT_DIR'))) . ' 	}')); ?>:&nbsp;</span></td>
	<td class="row2" valign="middle" nowrap="nowrap"><span class="genmed"><input type="radio" name="sort_order" value="ASC" /> <?php echo ((isset($this->_tpldata['.'][0]['L_SORT_ASCENDING'])) ? $this->_tpldata['.'][0]['L_SORT_ASCENDING'] : ((isset($lang['SORT_ASCENDING'])) ? $lang['SORT_ASCENDING'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SORT_ASCENDING'))) . ' 	}')); ?> <input type="radio" name="sort_order" value="DESC" checked /> <?php echo ((isset($this->_tpldata['.'][0]['L_SORT_DESCENDING'])) ? $this->_tpldata['.'][0]['L_SORT_DESCENDING'] : ((isset($lang['SORT_DESCENDING'])) ? $lang['SORT_DESCENDING'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SORT_DESCENDING'))) . ' 	}')); ?></span>&nbsp;</td>
  </tr>  
  <tr>   
	<td class="cat" align="center" colspan="2"><input type="hidden" name="action" value="search"><input class="liteoption" type="submit" name="submit" value="<?php echo ((isset($this->_tpldata['.'][0]['L_SEARCH'])) ? $this->_tpldata['.'][0]['L_SEARCH'] : ((isset($lang['SEARCH'])) ? $lang['SEARCH'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SEARCH'))) . ' 	}')); ?>"></td>
  </tr>
</form>
</table>
<?php $this->_tpl_include('pa_footer.tpl'); ?>