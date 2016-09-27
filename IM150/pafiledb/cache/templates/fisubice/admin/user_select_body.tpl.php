<div class="maintitle"><?php echo ((isset($this->_tpldata['.'][0]['L_USER_TITLE'])) ? $this->_tpldata['.'][0]['L_USER_TITLE'] : ((isset($lang['USER_TITLE'])) ? $lang['USER_TITLE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'USER_TITLE'))) . ' 	}')); ?></div>
<br />
<div class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_USER_EXPLAIN'])) ? $this->_tpldata['.'][0]['L_USER_EXPLAIN'] : ((isset($lang['USER_EXPLAIN'])) ? $lang['USER_EXPLAIN'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'USER_EXPLAIN'))) . ' 	}')); ?></div>
<br />
<form method="post" name="post" action="<?php echo $this->_tpldata['.'][0]['S_USER_ACTION']; ?>">
<table cellspacing="1" cellpadding="3" border="0" align="center" class="forumline">
<tr> 
<th><?php echo ((isset($this->_tpldata['.'][0]['L_USER_SELECT'])) ? $this->_tpldata['.'][0]['L_USER_SELECT'] : ((isset($lang['USER_SELECT'])) ? $lang['USER_SELECT'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'USER_SELECT'))) . ' 	}')); ?></th>
</tr>
<tr> 
<td class="row1" align="center">
<input type="text" class="post" name="username" maxlength="50" size="20" />
<input type="hidden" name="mode" value="edit" />
<?php echo $this->_tpldata['.'][0]['S_HIDDEN_FIELDS']; ?>
<input type="submit" name="submituser" value="<?php echo ((isset($this->_tpldata['.'][0]['L_LOOK_UP'])) ? $this->_tpldata['.'][0]['L_LOOK_UP'] : ((isset($lang['LOOK_UP'])) ? $lang['LOOK_UP'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'LOOK_UP'))) . ' 	}')); ?>" class="mainoption" />
<input type="submit" name="usersubmit" value="<?php echo ((isset($this->_tpldata['.'][0]['L_FIND_USERNAME'])) ? $this->_tpldata['.'][0]['L_FIND_USERNAME'] : ((isset($lang['FIND_USERNAME'])) ? $lang['FIND_USERNAME'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FIND_USERNAME'))) . ' 	}')); ?>" class="button" onclick="window.open('<?php echo $this->_tpldata['.'][0]['U_SEARCH_USER']; ?>', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" /><input type="checkbox" name="new_user"><?php echo ((isset($this->_tpldata['.'][0]['L_CREATE_USER'])) ? $this->_tpldata['.'][0]['L_CREATE_USER'] : ((isset($lang['CREATE_USER'])) ? $lang['CREATE_USER'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'CREATE_USER'))) . ' 	}')); ?>
</td>
</tr>
</table>
</form>
<br />