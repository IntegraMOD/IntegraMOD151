<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
	<tr>
<?php $_pertype_count = (isset($this->_tpldata['pertype'])) ?  sizeof($this->_tpldata['pertype']) : 0;if ($_pertype_count) {for ($this->_pertype_i = 0; $this->_pertype_i < $_pertype_count; $this->_pertype_i++){ ?>	
	  <td class="cat" align="left" nowrap="nowrap"><a href="<?php echo $this->_tpldata['pertype'][$this->_pertype_i]['U_NAME']; ?>"><?php echo $this->_tpldata['pertype'][$this->_pertype_i]['L_NAME']; ?></a></td> 
<?php }} ?>
	</tr>
</table>  
<br />

<h1><?php echo ((isset($this->_tpldata['.'][0]['L_AUTH_TITLE'])) ? $this->_tpldata['.'][0]['L_AUTH_TITLE'] : ((isset($lang['AUTH_TITLE'])) ? $lang['AUTH_TITLE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'AUTH_TITLE'))) . ' 	}')); ?></h1>

<p><?php echo ((isset($this->_tpldata['.'][0]['L_AUTH_EXPLAIN'])) ? $this->_tpldata['.'][0]['L_AUTH_EXPLAIN'] : ((isset($lang['AUTH_EXPLAIN'])) ? $lang['AUTH_EXPLAIN'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'AUTH_EXPLAIN'))) . ' 	}')); ?></p>

<h2><?php echo ((isset($this->_tpldata['.'][0]['L_CATEGORY'])) ? $this->_tpldata['.'][0]['L_CATEGORY'] : ((isset($lang['CATEGORY'])) ? $lang['CATEGORY'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'CATEGORY'))) . ' 	}'));if ($this->_tpldata['.'][0]['CATEGORY_NAME'] != '') {  ?> : <?php echo $this->_tpldata['.'][0]['CATEGORY_NAME'];} ?></h2>

<form method="post" action="<?php echo $this->_tpldata['.'][0]['S_CATAUTH_ACTION']; ?>">
  <table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
	<tr>
      <th class="thTop"><?php echo ((isset($this->_tpldata['.'][0]['L_CATEGORY'])) ? $this->_tpldata['.'][0]['L_CATEGORY'] : ((isset($lang['CATEGORY'])) ? $lang['CATEGORY'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'CATEGORY'))) . ' 	}')); ?></th>
	  <?php $_cat_auth_titles_count = (isset($this->_tpldata['cat_auth_titles'])) ?  sizeof($this->_tpldata['cat_auth_titles']) : 0;if ($_cat_auth_titles_count) {for ($this->_cat_auth_titles_i = 0; $this->_cat_auth_titles_i < $_cat_auth_titles_count; $this->_cat_auth_titles_i++){ ?>
	  <th class="thTop"><?php echo $this->_tpldata['cat_auth_titles'][$this->_cat_auth_titles_i]['CELL_TITLE']; ?></th>
	  <?php }} ?>
	</tr>
	<?php $_cat_row_count = (isset($this->_tpldata['cat_row'])) ?  sizeof($this->_tpldata['cat_row']) : 0;if ($_cat_row_count) {for ($this->_cat_row_i = 0; $this->_cat_row_i < $_cat_row_count; $this->_cat_row_i++){ ?>
	<tr>
	  <?php if ($this->_tpldata['cat_row'][$this->_cat_row_i]['IS_HIGHER_CAT']) {  ?>	
      	  <td class="cat" align="left" nowrap="nowrap"><?php echo $this->_tpldata['cat_row'][$this->_cat_row_i]['PRE']; ?>&nbsp;&raquo;&nbsp;<a href="<?php echo $this->_tpldata['cat_row'][$this->_cat_row_i]['U_CAT']; ?>"><?php echo $this->_tpldata['cat_row'][$this->_cat_row_i]['CATEGORY_NAME']; ?></a></td> 
	  <?php } else { ?>
		  <td class="row1" align="left" nowrap="nowrap"><?php echo $this->_tpldata['cat_row'][$this->_cat_row_i]['PRE']; ?>&nbsp;&raquo;&nbsp;<a href="<?php echo $this->_tpldata['cat_row'][$this->_cat_row_i]['U_CAT']; ?>"><?php echo $this->_tpldata['cat_row'][$this->_cat_row_i]['CATEGORY_NAME']; ?></a></td> 
	  <?php }$_cat_auth_data_count = (isset($this->_tpldata['cat_row'][$this->_cat_row_i]['cat_auth_data'])) ? sizeof($this->_tpldata['cat_row'][$this->_cat_row_i]['cat_auth_data']) : 0;if ($_cat_auth_data_count) {for ($this->_cat_auth_data_i = 0; $this->_cat_auth_data_i < $_cat_auth_data_count; $this->_cat_auth_data_i++){if ($this->_tpldata['cat_row'][$this->_cat_row_i]['IS_HIGHER_CAT']) {  ?>	
	  <td class="cat" align="center"><?php echo $this->_tpldata['cat_row'][$this->_cat_row_i]['cat_auth_data'][$this->_cat_auth_data_i]['S_AUTH_LEVELS_SELECT']; ?></td>
	  <?php } else { ?>
	  <td class="row1" align="center"><?php echo $this->_tpldata['cat_row'][$this->_cat_row_i]['cat_auth_data'][$this->_cat_auth_data_i]['S_AUTH_LEVELS_SELECT']; ?></td>
	  <?php }}} ?>
	</tr>
	<?php }} ?>
	<tr>
	  <td colspan="<?php echo $this->_tpldata['.'][0]['S_COLUMN_SPAN']; ?>" class="cat" align="center"><?php echo $this->_tpldata['.'][0]['S_HIDDEN_FIELDS']; ?> 
		<input type="submit" name="submit" value="<?php echo ((isset($this->_tpldata['.'][0]['L_SUBMIT'])) ? $this->_tpldata['.'][0]['L_SUBMIT'] : ((isset($lang['SUBMIT'])) ? $lang['SUBMIT'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SUBMIT'))) . ' 	}')); ?>" class="mainoption" />
		&nbsp;&nbsp; 
		<input type="reset" value="<?php echo ((isset($this->_tpldata['.'][0]['L_RESET'])) ? $this->_tpldata['.'][0]['L_RESET'] : ((isset($lang['RESET'])) ? $lang['RESET'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'RESET'))) . ' 	}')); ?>" name="reset" class="liteoption" />
	  </td>
	</tr>
  </table>
</form>