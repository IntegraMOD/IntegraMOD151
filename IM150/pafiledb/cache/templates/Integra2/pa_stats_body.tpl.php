<?php $this->_tpl_include('pa_header.tpl'); ?>
<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom">
		<span class="nav"><a href="<?php echo $this->_tpldata['.'][0]['U_INDEX']; ?>" class="nav"><?php echo ((isset($this->_tpldata['.'][0]['L_INDEX'])) ? $this->_tpldata['.'][0]['L_INDEX'] : ((isset($lang['INDEX'])) ? $lang['INDEX'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'INDEX'))) . ' 	}')); ?></a> -> <a href="<?php echo $this->_tpldata['.'][0]['U_DOWNLOAD']; ?>" class="nav"><?php echo $this->_tpldata['.'][0]['DOWNLOAD']; ?></a> -> <?php echo ((isset($this->_tpldata['.'][0]['L_STATISTICS'])) ? $this->_tpldata['.'][0]['L_STATISTICS'] : ((isset($lang['STATISTICS'])) ? $lang['STATISTICS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'STATISTICS'))) . ' 	}')); ?></span>
	</td>
  </tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr> 
	<th colspan="2" class="thHead"><?php echo ((isset($this->_tpldata['.'][0]['L_STATISTICS'])) ? $this->_tpldata['.'][0]['L_STATISTICS'] : ((isset($lang['STATISTICS'])) ? $lang['STATISTICS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'STATISTICS'))) . ' 	}')); ?></th>
  </tr>
  <tr> 
	<td colspan="2" class="cat" align="center"><span class="cattitle"><?php echo ((isset($this->_tpldata['.'][0]['L_GENERAL_INFO'])) ? $this->_tpldata['.'][0]['L_GENERAL_INFO'] : ((isset($lang['GENERAL_INFO'])) ? $lang['GENERAL_INFO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'GENERAL_INFO'))) . ' 	}')); ?></span></td>
  </tr>  
  <tr>
	<td colspan="2" class="row1"><span class="genmed"><?php echo $this->_tpldata['.'][0]['STATS_TEXT']; ?></span></td>
  </tr>
  <tr> 
	<td class="cat" width="50%" align="center"><span class="cattitle"><?php echo ((isset($this->_tpldata['.'][0]['L_DOWNLOADS_STATS'])) ? $this->_tpldata['.'][0]['L_DOWNLOADS_STATS'] : ((isset($lang['DOWNLOADS_STATS'])) ? $lang['DOWNLOADS_STATS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'DOWNLOADS_STATS'))) . ' 	}')); ?></span></td>
	<td class="cat" width="50%" align="center"><span class="cattitle"><?php echo ((isset($this->_tpldata['.'][0]['L_RATING_STATS'])) ? $this->_tpldata['.'][0]['L_RATING_STATS'] : ((isset($lang['RATING_STATS'])) ? $lang['RATING_STATS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'RATING_STATS'))) . ' 	}')); ?></span></td>
  </tr>  
  <tr> 
	<td class="row2" colspan="2" align="center"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_OS'])) ? $this->_tpldata['.'][0]['L_OS'] : ((isset($lang['OS'])) ? $lang['OS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'OS'))) . ' 	}')); ?></span></td>
  </tr>    
  <tr> 
	<td class="row1" align="center">
		  <table cellspacing="0" cellpadding="2" border="0">
			<?php $_downloads_os_count = (isset($this->_tpldata['downloads_os'])) ?  sizeof($this->_tpldata['downloads_os']) : 0;if ($_downloads_os_count) {for ($this->_downloads_os_i = 0; $this->_downloads_os_i < $_downloads_os_count; $this->_downloads_os_i++){ ?>
			<tr> 
			  <td><img src="<?php echo $this->_tpldata['downloads_os'][$this->_downloads_os_i]['OS_IMG']; ?>" alt="" />&nbsp;<span class="gen"><?php echo $this->_tpldata['downloads_os'][$this->_downloads_os_i]['OS_NAME']; ?></span></td>
			  <td> 
				<table cellspacing="0" cellpadding="0" border="0">
				  <tr> 
					<td><img src="<?php echo $this->_tpldata['.'][0]['U_VOTE_LCAP']; ?>" width="4" alt="" height="12" /></td>
					<td><img src="<?php echo $this->_tpldata['downloads_os'][$this->_downloads_os_i]['OS_OPTION_IMG']; ?>" width="<?php echo $this->_tpldata['downloads_os'][$this->_downloads_os_i]['OS_OPTION_IMG_WIDTH']; ?>" height="12" alt="<?php echo $this->_tpldata['downloads_os'][$this->_downloads_os_i]['OS_OPTION_RESULT']; ?>" /></td>
					<td><img src="<?php echo $this->_tpldata['.'][0]['U_VOTE_RCAP']; ?>" width="4" alt="" height="12" /></td>
				  </tr>
				</table>
			  </td>
			  <td align="center"><span class="gen">[ <?php echo $this->_tpldata['downloads_os'][$this->_downloads_os_i]['OS_OPTION_RESULT']; ?> ]</span></td>
			</tr>
			<?php }} ?>
		  </table>	
	</td>
	<td class="row1" align="center">
		<table cellspacing="0" cellpadding="2" border="0">
			<?php $_rating_os_count = (isset($this->_tpldata['rating_os'])) ?  sizeof($this->_tpldata['rating_os']) : 0;if ($_rating_os_count) {for ($this->_rating_os_i = 0; $this->_rating_os_i < $_rating_os_count; $this->_rating_os_i++){ ?>
			<tr> 
			  <td><img src="<?php echo $this->_tpldata['rating_os'][$this->_rating_os_i]['OS_IMG']; ?>" alt="" />&nbsp;<span class="gen"><?php echo $this->_tpldata['rating_os'][$this->_rating_os_i]['OS_NAME']; ?></span></td>
			  <td> 
				<table cellspacing="0" cellpadding="0" border="0">
				  <tr> 
					<td><img src="<?php echo $this->_tpldata['.'][0]['U_VOTE_LCAP']; ?>" width="4" alt="" height="12" /></td>
					<td><img src="<?php echo $this->_tpldata['rating_os'][$this->_rating_os_i]['OS_OPTION_IMG']; ?>" width="<?php echo $this->_tpldata['rating_os'][$this->_rating_os_i]['OS_OPTION_IMG_WIDTH']; ?>" height="12" alt="<?php echo $this->_tpldata['rating_os'][$this->_rating_os_i]['OS_OPTION_RESULT']; ?>" /></td>
					<td><img src="<?php echo $this->_tpldata['.'][0]['U_VOTE_RCAP']; ?>" width="4" alt="" height="12" /></td>
				  </tr>
				</table>
			  </td>
			  <td align="center"><span class="gen">[ <?php echo $this->_tpldata['rating_os'][$this->_rating_os_i]['OS_OPTION_RESULT']; ?> ]</span></td>
			</tr>
			<?php }} ?>
		  </table>		
	</td>
  </tr>
  <tr> 
	<td class="row2" colspan="2" align="center"><span class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_BROWSERS'])) ? $this->_tpldata['.'][0]['L_BROWSERS'] : ((isset($lang['BROWSERS'])) ? $lang['BROWSERS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'BROWSERS'))) . ' 	}')); ?></span></td>
  </tr>

  <tr> 
	<td class="row1" align="center">
		  <table cellspacing="0" cellpadding="2" border="0">
			<?php $_downloads_b_count = (isset($this->_tpldata['downloads_b'])) ?  sizeof($this->_tpldata['downloads_b']) : 0;if ($_downloads_b_count) {for ($this->_downloads_b_i = 0; $this->_downloads_b_i < $_downloads_b_count; $this->_downloads_b_i++){ ?>
			<tr> 
			  <td><img src="<?php echo $this->_tpldata['downloads_b'][$this->_downloads_b_i]['B_IMG']; ?>" alt="" />&nbsp;<span class="gen"><?php echo $this->_tpldata['downloads_b'][$this->_downloads_b_i]['B_NAME']; ?></span></td>
			  <td> 
				<table cellspacing="0" cellpadding="0" border="0">
				  <tr> 
					<td><img src="<?php echo $this->_tpldata['.'][0]['U_VOTE_LCAP']; ?>" width="4" alt="" height="12" /></td>
					<td><img src="<?php echo $this->_tpldata['downloads_b'][$this->_downloads_b_i]['B_OPTION_IMG']; ?>" width="<?php echo $this->_tpldata['downloads_b'][$this->_downloads_b_i]['B_OPTION_IMG_WIDTH']; ?>" height="12" alt="<?php echo $this->_tpldata['downloads_b'][$this->_downloads_b_i]['B_OPTION_RESULT']; ?>" /></td>
					<td><img src="<?php echo $this->_tpldata['.'][0]['U_VOTE_RCAP']; ?>" width="4" alt="" height="12" /></td>
				  </tr>
				</table>
			  </td>
			  <td align="center"><span class="gen">[ <?php echo $this->_tpldata['downloads_b'][$this->_downloads_b_i]['B_OPTION_RESULT']; ?> ]</span></td>
			</tr>
			<?php }} ?>
		  </table>	
	</td>
	<td class="row1" align="center">
		<table cellspacing="0" cellpadding="2" border="0">
			<?php $_rating_b_count = (isset($this->_tpldata['rating_b'])) ?  sizeof($this->_tpldata['rating_b']) : 0;if ($_rating_b_count) {for ($this->_rating_b_i = 0; $this->_rating_b_i < $_rating_b_count; $this->_rating_b_i++){ ?>
			<tr> 
			  <td><img src="<?php echo $this->_tpldata['rating_b'][$this->_rating_b_i]['B_IMG']; ?>" alt="" />&nbsp;<span class="gen"><?php echo $this->_tpldata['rating_b'][$this->_rating_b_i]['B_NAME']; ?></span></td>
			  <td> 
				<table cellspacing="0" cellpadding="0" border="0">
				  <tr> 
					<td><img src="<?php echo $this->_tpldata['.'][0]['U_VOTE_LCAP']; ?>" width="4" alt="" height="12" /></td>
					<td><img src="<?php echo $this->_tpldata['rating_b'][$this->_rating_b_i]['B_OPTION_IMG']; ?>" width="<?php echo $this->_tpldata['rating_b'][$this->_rating_b_i]['B_OPTION_IMG_WIDTH']; ?>" height="12" alt="<?php echo $this->_tpldata['rating_b'][$this->_rating_b_i]['B_OPTION_RESULT']; ?>" /></td>
					<td><img src="<?php echo $this->_tpldata['.'][0]['U_VOTE_RCAP']; ?>" width="4" alt="" height="12" /></td>
				  </tr>
				</table>
			  </td>
			  <td align="center"><span class="gen">[ <?php echo $this->_tpldata['rating_b'][$this->_rating_b_i]['B_OPTION_RESULT']; ?> ]</span></td>
			</tr>
			<?php }} ?>
		  </table>		
	</td>
  </tr>  
    
  <tr> 
	<td colspan="2" class="cat" height="28">&nbsp;</td>
  </tr>
</table>
<?php $this->_tpl_include('pa_footer.tpl'); ?>