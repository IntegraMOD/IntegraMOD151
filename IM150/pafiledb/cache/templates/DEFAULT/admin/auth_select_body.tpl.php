<div class="maintitle"><?php echo ((isset($this->_tpldata['.'][0]['L_AUTH_TITLE'])) ? $this->_tpldata['.'][0]['L_AUTH_TITLE'] : ((isset($lang['AUTH_TITLE'])) ? $lang['AUTH_TITLE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'AUTH_TITLE'))) . ' 	}')); ?></div>
<br />
<div class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_AUTH_EXPLAIN'])) ? $this->_tpldata['.'][0]['L_AUTH_EXPLAIN'] : ((isset($lang['AUTH_EXPLAIN'])) ? $lang['AUTH_EXPLAIN'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'AUTH_EXPLAIN'))) . ' 	}')); ?></div>
<br />
<form method="post" action="<?php echo $this->_tpldata['.'][0]['S_AUTH_ACTION']; ?>">
<table cellspacing="1" cellpadding="3" border="0" align="center" class="forumline">
<tr>
<th><?php echo ((isset($this->_tpldata['.'][0]['L_AUTH_SELECT'])) ? $this->_tpldata['.'][0]['L_AUTH_SELECT'] : ((isset($lang['AUTH_SELECT'])) ? $lang['AUTH_SELECT'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'AUTH_SELECT'))) . ' 	}')); ?></th>
</tr>
<tr>
<td class="row1" align="center" height="30"><?php echo $this->_tpldata['.'][0]['S_HIDDEN_FIELDS'];echo $this->_tpldata['.'][0]['S_AUTH_SELECT']; ?>&nbsp;&nbsp; 
<input type="submit" value="<?php echo ((isset($this->_tpldata['.'][0]['L_LOOK_UP'])) ? $this->_tpldata['.'][0]['L_LOOK_UP'] : ((isset($lang['LOOK_UP'])) ? $lang['LOOK_UP'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'LOOK_UP'))) . ' 	}')); ?>" class="mainoption" />&nbsp;</td>
</tr>
</table>
</form>