<?php $this->_tpl_include('pa_header.tpl'); ?>
<script language="JavaScript" type="text/javascript">
<!--
function checkRateForm() {
	if (document.rateform.rating.value == -1)
	{
		return false;
	}
	else
	{
		return true;
	}
}
// -->
</script>

<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom">
		<span class="nav"><a href="<?php echo $this->_tpldata['.'][0]['U_INDEX']; ?>" class="nav"><?php echo ((isset($this->_tpldata['.'][0]['L_INDEX'])) ? $this->_tpldata['.'][0]['L_INDEX'] : ((isset($lang['INDEX'])) ? $lang['INDEX'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'INDEX'))) . ' 	}')); ?></a> -> <a href="<?php echo $this->_tpldata['.'][0]['U_DOWNLOAD_HOME']; ?>" class="nav"><?php echo $this->_tpldata['.'][0]['DOWNLOAD']; ?></a><?php $_navlinks_count = (isset($this->_tpldata['navlinks'])) ?  sizeof($this->_tpldata['navlinks']) : 0;if ($_navlinks_count) {for ($this->_navlinks_i = 0; $this->_navlinks_i < $_navlinks_count; $this->_navlinks_i++){ ?> -> <a href="<?php echo $this->_tpldata['navlinks'][$this->_navlinks_i]['U_VIEW_CAT']; ?>" class="nav"><?php echo $this->_tpldata['navlinks'][$this->_navlinks_i]['CAT_NAME']; ?></a><?php }} ?> -> <a href="<?php echo $this->_tpldata['.'][0]['U_FILE_NAME']; ?>" class="nav"><?php echo $this->_tpldata['.'][0]['FILE_NAME']; ?></a> -> <?php echo ((isset($this->_tpldata['.'][0]['L_RATE'])) ? $this->_tpldata['.'][0]['L_RATE'] : ((isset($lang['RATE'])) ? $lang['RATE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'RATE'))) . ' 	}')); ?></span>
	</td>
  </tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr> 
	<th colspan="2" class="thHead"><?php echo ((isset($this->_tpldata['.'][0]['L_RATE'])) ? $this->_tpldata['.'][0]['L_RATE'] : ((isset($lang['RATE'])) ? $lang['RATE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'RATE'))) . ' 	}')); ?></th>
  </tr>
  <tr> 
	<td class="row1" width="90%"><span class="genmed"><?php echo $this->_tpldata['.'][0]['RATEINFO']; ?></span></td>
	<td class="row2">
	<form name="rateform" action="<?php echo $this->_tpldata['.'][0]['S_RATE_ACTION']; ?>" method="post" onsubmit="return checkRateForm();">
		<select size="1" name="rating" class="forminput">
		<option value="-1" selected><?php echo ((isset($this->_tpldata['.'][0]['L_RATE'])) ? $this->_tpldata['.'][0]['L_RATE'] : ((isset($lang['RATE'])) ? $lang['RATE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'RATE'))) . ' 	}')); ?></option>
		<option value="1"><?php echo ((isset($this->_tpldata['.'][0]['L_R1'])) ? $this->_tpldata['.'][0]['L_R1'] : ((isset($lang['R1'])) ? $lang['R1'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'R1'))) . ' 	}')); ?></option>
		<option value="2"><?php echo ((isset($this->_tpldata['.'][0]['L_R2'])) ? $this->_tpldata['.'][0]['L_R2'] : ((isset($lang['R2'])) ? $lang['R2'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'R2'))) . ' 	}')); ?></option>
		<option value="3"><?php echo ((isset($this->_tpldata['.'][0]['L_R3'])) ? $this->_tpldata['.'][0]['L_R3'] : ((isset($lang['R3'])) ? $lang['R3'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'R3'))) . ' 	}')); ?></option>
		<option value="4"><?php echo ((isset($this->_tpldata['.'][0]['L_R4'])) ? $this->_tpldata['.'][0]['L_R4'] : ((isset($lang['R4'])) ? $lang['R4'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'R4'))) . ' 	}')); ?></option>
		<option value="5"><?php echo ((isset($this->_tpldata['.'][0]['L_R5'])) ? $this->_tpldata['.'][0]['L_R5'] : ((isset($lang['R5'])) ? $lang['R5'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'R5'))) . ' 	}')); ?></option>
		<option value="6"><?php echo ((isset($this->_tpldata['.'][0]['L_R6'])) ? $this->_tpldata['.'][0]['L_R6'] : ((isset($lang['R6'])) ? $lang['R6'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'R6'))) . ' 	}')); ?></option>
		<option value="7"><?php echo ((isset($this->_tpldata['.'][0]['L_R7'])) ? $this->_tpldata['.'][0]['L_R7'] : ((isset($lang['R7'])) ? $lang['R7'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'R7'))) . ' 	}')); ?></option>
		<option value="8"><?php echo ((isset($this->_tpldata['.'][0]['L_R8'])) ? $this->_tpldata['.'][0]['L_R8'] : ((isset($lang['R8'])) ? $lang['R8'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'R8'))) . ' 	}')); ?></option>
		<option value="9"><?php echo ((isset($this->_tpldata['.'][0]['L_R9'])) ? $this->_tpldata['.'][0]['L_R9'] : ((isset($lang['R9'])) ? $lang['R9'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'R9'))) . ' 	}')); ?></option>
		<option value="10"><?php echo ((isset($this->_tpldata['.'][0]['L_R10'])) ? $this->_tpldata['.'][0]['L_R10'] : ((isset($lang['R10'])) ? $lang['R10'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'R10'))) . ' 	}')); ?></option>
		<input type="hidden" name="action" value="rate">
		<input type="hidden" name="file_id" value="<?php echo $this->_tpldata['.'][0]['ID']; ?>">
		</select>
	</td>
  </tr>
  <tr> 
	<td colspan="2" class="cat" align="center"><input class="liteoption" type="submit" value="<?php echo ((isset($this->_tpldata['.'][0]['L_RATE'])) ? $this->_tpldata['.'][0]['L_RATE'] : ((isset($lang['RATE'])) ? $lang['RATE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'RATE'))) . ' 	}')); ?>" name="submit">

&nbsp;</td>
  </tr>
</table>
</form>
<?php $this->_tpl_include('pa_footer.tpl'); ?>