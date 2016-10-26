<h1><?php echo ((isset($this->_tpldata['.'][0]['L_FIELD_TITLE'])) ? $this->_tpldata['.'][0]['L_FIELD_TITLE'] : ((isset($lang['FIELD_TITLE'])) ? $lang['FIELD_TITLE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FIELD_TITLE'))) . ' 	}')); ?></h1>

<p><?php echo ((isset($this->_tpldata['.'][0]['L_FIELD_EXPLAIN'])) ? $this->_tpldata['.'][0]['L_FIELD_EXPLAIN'] : ((isset($lang['FIELD_EXPLAIN'])) ? $lang['FIELD_EXPLAIN'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FIELD_EXPLAIN'))) . ' 	}')); ?></p>

<form action="<?php echo $this->_tpldata['.'][0]['S_FIELD_ACTION']; ?>" method="post">
<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr>
	<th  class="thHead"><?php echo ((isset($this->_tpldata['.'][0]['L_FIELD_TITLE'])) ? $this->_tpldata['.'][0]['L_FIELD_TITLE'] : ((isset($lang['FIELD_TITLE'])) ? $lang['FIELD_TITLE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FIELD_TITLE'))) . ' 	}')); ?></b></th>
  </tr>
<?php $_field_row_count = (isset($this->_tpldata['field_row'])) ?  sizeof($this->_tpldata['field_row']) : 0;if ($_field_row_count) {for ($this->_field_row_i = 0; $this->_field_row_i < $_field_row_count; $this->_field_row_i++){ ?>
  <tr>
	<td width="97%" class="row1" align="center"><b><?php echo $this->_tpldata['field_row'][$this->_field_row_i]['FIELD_NAME']; ?></b><br><span class="gensmall"><?php echo $this->_tpldata['field_row'][$this->_field_row_i]['FIELD_DESC']; ?></span></td>
</tr>
<?php }} ?>
  <tr>
	<td align="center" class="cat" >
	<input class="liteoption" type="submit" value="add" name="mode">&nbsp;
	<input class="liteoption" type="submit" value="edit" name="mode">&nbsp;
	<input class="liteoption" type="submit" value="delete" name="mode"></td>
  </tr>
</table>
</form>