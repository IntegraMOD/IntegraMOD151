<script language='javascript'>
    <!--
	var add_file = false;
	var deletefile = false;
	
	function set_add_file(status)
	{
		add_file = status;
	}
	
	function set_delete_file(status)
	{
		deletefile = status;
	}
	
	
    function delete_file(theURL) 
	{
       if (confirm('Are you sure you want to delete this file??')) 
	   {
          window.location.href=theURL;
       }
       else
	   {
          alert ('No Action has been taken.');
       } 
    }
	
	function disable_cat_list()
	{
		if(document.form.mode_js.options[document.form.mode_js.selectedIndex].value != 'file_cat')
		{
			document.form.cat_js_id.disabled = true;
		}
		if(document.form.mode_js.options[document.form.mode_js.selectedIndex].value == 'file_cat')
		{
			document.form.cat_js_id.disabled = false;
		}
	}
	
	//
	// Taking from the Attachment MOD of Acyd Burn
	//
	function select(status)
	{
		for (i = 0; i < document.file_ids.length; i++)
		{
			document.file_ids.elements[i].checked = status;
		}
	}

	function check()
	{
		if(add_file)
		{
			return true;
		}

		for (i = 0; i < document.file_ids.length; i++)
		{
			if(document.file_ids.elements[i].checked == true)
			{
				if(deletefile)
				{
			       if (confirm('Are you sure you want to delete these files??')) 
				   {
				   		return true;
				   }
				   else
				   {
						return false;
				   }
				}
				return true;
			}
		}
		alert('Please Select at least one file.');
		return false;
	}
	-->
</script>
<?php $this->_tpl_include('pa_header.tpl'); ?>
<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom">
		<span class="nav"><a href="<?php echo $this->_tpldata['.'][0]['U_INDEX']; ?>" class="nav"><?php echo ((isset($this->_tpldata['.'][0]['L_INDEX'])) ? $this->_tpldata['.'][0]['L_INDEX'] : ((isset($lang['INDEX'])) ? $lang['INDEX'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'INDEX'))) . ' 	}')); ?></a> -> <a href="<?php echo $this->_tpldata['.'][0]['U_DOWNLOAD']; ?>" class="nav"><?php echo $this->_tpldata['.'][0]['DOWNLOAD']; ?></a> -> <?php echo ((isset($this->_tpldata['.'][0]['L_MCP_TITLE'])) ? $this->_tpldata['.'][0]['L_MCP_TITLE'] : ((isset($lang['MCP_TITLE'])) ? $lang['MCP_TITLE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'MCP_TITLE'))) . ' 	}')); ?></span>
	</td>
  </tr>
</table>
<p><?php echo ((isset($this->_tpldata['.'][0]['L_MCP_EXPLAIN'])) ? $this->_tpldata['.'][0]['L_MCP_EXPLAIN'] : ((isset($lang['MCP_EXPLAIN'])) ? $lang['MCP_EXPLAIN'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'MCP_EXPLAIN'))) . ' 	}')); ?></p>
<body onLoad="disable_cat_list();">
<form method="post" action="<?php echo $this->_tpldata['.'][0]['S_FILE_ACTION']; ?>" name="form">
<table width="100%" cellpadding="3" cellspacing="1">
  <tr>
	<td><b><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_MODE'])) ? $this->_tpldata['.'][0]['L_MODE'] : ((isset($lang['MODE'])) ? $lang['MODE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'MODE'))) . ' 	}')); ?>:</span></b> <select name="mode_js" onchange="disable_cat_list();"><?php echo $this->_tpldata['.'][0]['S_MODE_SELECT']; ?></select> <b><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_CATEGORY'])) ? $this->_tpldata['.'][0]['L_CATEGORY'] : ((isset($lang['CATEGORY'])) ? $lang['CATEGORY'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'CATEGORY'))) . ' 	}')); ?>:</span></b> <?php echo $this->_tpldata['.'][0]['S_CAT_LIST']; ?><input type="submit" class="liteoption" name="go" value="<?php echo ((isset($this->_tpldata['.'][0]['L_GO'])) ? $this->_tpldata['.'][0]['L_GO'] : ((isset($lang['GO'])) ? $lang['GO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'GO'))) . ' 	}')); ?>" /></td>
  </tr>
</table>
	<?php echo $this->_tpldata['.'][0]['S_HIDDEN_FIELDS']; ?>
</form>
<form method="post" action="<?php echo $this->_tpldata['.'][0]['S_FILE_ACTION']; ?>" name="file_ids" onsubmit="return check();">
<?php $_file_mode_count = (isset($this->_tpldata['file_mode'])) ?  sizeof($this->_tpldata['file_mode']) : 0;if ($_file_mode_count) {for ($this->_file_mode_i = 0; $this->_file_mode_i < $_file_mode_count; $this->_file_mode_i++){ ?>
<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr>
	<th colspan="6" class="thHead"><?php echo $this->_tpldata['file_mode'][$this->_file_mode_i]['L_FILE_MODE']; ?></span></th>
  </tr>
  <?php if ($this->_tpldata['file_mode'][$this->_file_mode_i]['DATA']) { $_file_row_count = (isset($this->_tpldata['file_mode'][$this->_file_mode_i]['file_row'])) ? sizeof($this->_tpldata['file_mode'][$this->_file_mode_i]['file_row']) : 0;if ($_file_row_count) {for ($this->_file_row_i = 0; $this->_file_row_i < $_file_row_count; $this->_file_row_i++){ ?>
  <tr>
	<td class="row1" align="center" width="5%"><span class="genmed"><?php echo $this->_tpldata['file_mode'][$this->_file_mode_i]['file_row'][$this->_file_row_i]['FILE_NUMBER']; ?></span></td>
	<td class="row1" width="50%"><span class="genmed"><?php echo $this->_tpldata['file_mode'][$this->_file_mode_i]['file_row'][$this->_file_row_i]['FILE_NAME']; ?></span></td>
	<td class="row1" align="center" width="10%"><span class="gen"><a href="<?php echo $this->_tpldata['file_mode'][$this->_file_mode_i]['file_row'][$this->_file_row_i]['U_FILE_EDIT']; ?>"><?php echo ((isset($this->_tpldata['.'][0]['L_EDIT'])) ? $this->_tpldata['.'][0]['L_EDIT'] : ((isset($lang['EDIT'])) ? $lang['EDIT'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'EDIT'))) . ' 	}')); ?></a></span></td>
	<td class="row1" align="center" width="10%"><span class="gen"><a href="javascript:delete_file('<?php echo $this->_tpldata['file_mode'][$this->_file_mode_i]['file_row'][$this->_file_row_i]['U_FILE_DELETE']; ?>')"><?php echo ((isset($this->_tpldata['.'][0]['L_DELETE'])) ? $this->_tpldata['.'][0]['L_DELETE'] : ((isset($lang['DELETE'])) ? $lang['DELETE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DELETE'))) . ' 	}')); ?></a></span></td>
	<td class="row1" align="center" width="20%"><span class="gen"><a href="<?php echo $this->_tpldata['file_mode'][$this->_file_mode_i]['file_row'][$this->_file_row_i]['U_FILE_APPROVE']; ?>"><?php echo $this->_tpldata['file_mode'][$this->_file_mode_i]['file_row'][$this->_file_row_i]['L_APPROVE']; ?></a></span></td>
	<td class="row1" align="center" width="5%"><span class="genmed"><input type="checkbox" name="file_ids[]" value="<?php echo $this->_tpldata['file_mode'][$this->_file_mode_i]['file_row'][$this->_file_row_i]['FILE_ID']; ?>" /></span></td>
  </tr>
   <?php }}} else { ?>
  <tr>
	  <td class="row1" align="center"><span class="gen"><?php echo ((isset($this->_tpldata['.'][0]['L_NO_FILES'])) ? $this->_tpldata['.'][0]['L_NO_FILES'] : ((isset($lang['NO_FILES'])) ? $lang['NO_FILES'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'NO_FILES'))) . ' 	}')); ?></span></td>
  </tr>
   <?php } ?>
</table>
<br />
<?php }} ?>
<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr>
	<td class="cat" align="center">
	<?php echo $this->_tpldata['.'][0]['S_HIDDEN_FIELDS']; ?>
	<input type="submit" class="liteoption" name="approve" value="<?php echo ((isset($this->_tpldata['.'][0]['L_APPROVE_FILE'])) ? $this->_tpldata['.'][0]['L_APPROVE_FILE'] : ((isset($lang['APPROVE_FILE'])) ? $lang['APPROVE_FILE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'APPROVE_FILE'))) . ' 	}')); ?>" onClick="set_add_file(false); set_delete_file(false);" />
	<input type="submit" class="liteoption" name="unapprove" value="<?php echo ((isset($this->_tpldata['.'][0]['L_UNAPPROVE_FILE'])) ? $this->_tpldata['.'][0]['L_UNAPPROVE_FILE'] : ((isset($lang['UNAPPROVE_FILE'])) ? $lang['UNAPPROVE_FILE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'UNAPPROVE_FILE'))) . ' 	}')); ?>" onClick="set_add_file(false); set_delete_file(false);" />
	</td>
  </tr>
</table>
</form>
<table width="100%" cellspacing="2" border="0" cellpadding="2">
  <tr>
	<td align="right" nowrap="nowrap"><span class="nav"><?php echo $this->_tpldata['.'][0]['PAGINATION']; ?></span></td>
  </tr>
  <tr>
	<td align="right" nowrap="nowrap"><span class="nav"><?php echo $this->_tpldata['.'][0]['PAGE_NUMBER']; ?></span></td>
  </tr>
</table>
<?php $this->_tpl_include('pa_footer.tpl'); ?>