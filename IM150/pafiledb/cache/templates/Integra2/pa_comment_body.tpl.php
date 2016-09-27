<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr>
	<th class="thCornerL"><?php echo ((isset($this->_tpldata['.'][0]['L_AUTHOR'])) ? $this->_tpldata['.'][0]['L_AUTHOR'] : ((isset($lang['AUTHOR'])) ? $lang['AUTHOR'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'AUTHOR'))) . ' 	}')); ?></th>
	<th class="thCornerR"><?php echo ((isset($this->_tpldata['.'][0]['L_COMMENTS'])) ? $this->_tpldata['.'][0]['L_COMMENTS'] : ((isset($lang['COMMENTS'])) ? $lang['COMMENTS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COMMENTS'))) . ' 	}')); ?></th>
  </tr>
<?php if ($this->_tpldata['.'][0]['NO_COMMENTS']) {  ?>
  <tr>
	<td colspan="2" class="row1" align="center"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_NO_COMMENTS'])) ? $this->_tpldata['.'][0]['L_NO_COMMENTS'] : ((isset($lang['NO_COMMENTS'])) ? $lang['NO_COMMENTS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'NO_COMMENTS'))) . ' 	}')); ?></span></td>
  </tr>
<?php }$_text_count = (isset($this->_tpldata['text'])) ?  sizeof($this->_tpldata['text']) : 0;if ($_text_count) {for ($this->_text_i = 0; $this->_text_i < $_text_count; $this->_text_i++){ ?>
  <tr>
	<td width="150" align="left" valign="top" class="row1"><span class="name"><b><?php echo $this->_tpldata['text'][$this->_text_i]['POSTER']; ?></b></span><br /><span class="postdetails"><?php echo $this->_tpldata['text'][$this->_text_i]['POSTER_RANK']; ?><br /><?php echo $this->_tpldata['text'][$this->_text_i]['RANK_IMAGE'];echo $this->_tpldata['text'][$this->_text_i]['POSTER_AVATAR']; ?><br /><br /><?php echo $this->_tpldata['text'][$this->_text_i]['POSTER_JOINED']; ?><br /><?php echo $this->_tpldata['text'][$this->_text_i]['POSTER_POSTS']; ?><br /><?php echo $this->_tpldata['text'][$this->_text_i]['POSTER_FROM']; ?></span><br />&nbsp;</td>
	<td class="row1" height="28" valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100%" valign="middle"><span class="postdetails"><img src="<?php echo $this->_tpldata['text'][$this->_text_i]['ICON_MINIPOST_IMG']; ?>" width="12" height="9" border="0" /><?php echo ((isset($this->_tpldata['.'][0]['L_POSTED'])) ? $this->_tpldata['.'][0]['L_POSTED'] : ((isset($lang['POSTED'])) ? $lang['POSTED'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'POSTED'))) . ' 	}')); ?>: <?php echo $this->_tpldata['text'][$this->_text_i]['TIME']; ?><span class="gen">&nbsp;</span>&nbsp; &nbsp;<?php echo ((isset($this->_tpldata['.'][0]['L_COMMENT_SUBJECT'])) ? $this->_tpldata['.'][0]['L_COMMENT_SUBJECT'] : ((isset($lang['COMMENT_SUBJECT'])) ? $lang['COMMENT_SUBJECT'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COMMENT_SUBJECT'))) . ' 	}')); ?>: <?php echo $this->_tpldata['text'][$this->_text_i]['TITLE']; ?></span></td>
				<td align="right">
				<?php if ($this->_tpldata['text'][$this->_text_i]['AUTH_COMMENT_DELETE']) {  ?>
				<a href="<?php echo $this->_tpldata['text'][$this->_text_i]['U_COMMENT_DELETE']; ?>"><img src="<?php echo $this->_tpldata['text'][$this->_text_i]['DELETE_IMG']; ?>" alt="<?php echo ((isset($this->_tpldata['.'][0]['L_COMMENT_DELETE'])) ? $this->_tpldata['.'][0]['L_COMMENT_DELETE'] : ((isset($lang['COMMENT_DELETE'])) ? $lang['COMMENT_DELETE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COMMENT_DELETE'))) . ' 	}')); ?>" title="<?php echo ((isset($this->_tpldata['.'][0]['L_COMMENT_DELETE'])) ? $this->_tpldata['.'][0]['L_COMMENT_DELETE'] : ((isset($lang['COMMENT_DELETE'])) ? $lang['COMMENT_DELETE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COMMENT_DELETE'))) . ' 	}')); ?>" border="0"></a>
				<?php } ?>
				</td>
			</tr>
			<tr> 
				<td colspan="2"><hr /></td>
			</tr>
			<tr>
				<td colspan="2"valign="top"><span class="postbody"><?php echo $this->_tpldata['text'][$this->_text_i]['TEXT']; ?></span></td>
			</tr>
		</table>
	</td>
  </tr>
  <tr>
	<td class="row1" width="150" align="left" valign="middle"><span class="nav"><a href="#top" class="nav"><?php echo ((isset($this->_tpldata['.'][0]['L_BACK_TO_TOP'])) ? $this->_tpldata['.'][0]['L_BACK_TO_TOP'] : ((isset($lang['BACK_TO_TOP'])) ? $lang['BACK_TO_TOP'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'BACK_TO_TOP'))) . ' 	}')); ?></a></span></td>
	<td class="row1"></td>
  </tr>
  <tr> 
	<td class="spaceRow" colspan="2" height="1"><img src="<?php echo $this->_tpldata['text'][$this->_text_i]['ICON_SPACER']; ?>" alt="" width="1" height="1" /></td>
  </tr>
<?php }} ?>
  <tr>
	<td colspan="2" class="cat">&nbsp;</td>
  </tr>
</table>
<?php if ($this->_tpldata['.'][0]['AUTH_POST']) {  ?>
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr>
	<td><a href="<?php echo $this->_tpldata['.'][0]['U_COMMENT_DO']; ?>"><img src="<?php echo $this->_tpldata['.'][0]['REPLY_IMG']; ?>" border="0" alt="<?php echo ((isset($this->_tpldata['.'][0]['L_COMMENT_ADD'])) ? $this->_tpldata['.'][0]['L_COMMENT_ADD'] : ((isset($lang['COMMENT_ADD'])) ? $lang['COMMENT_ADD'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COMMENT_ADD'))) . ' 	}')); ?>" align="middle" /></a></td>
  </tr>
</table>
<br clear="all" />
<?php } ?>