<?php $_input_count = (isset($this->_tpldata['input'])) ?  sizeof($this->_tpldata['input']) : 0;if ($_input_count) {for ($this->_input_i = 0; $this->_input_i < $_input_count; $this->_input_i++){ ?>
  <tr>
	<td class="row1"><span class="genmed"><?php echo $this->_tpldata['input'][$this->_input_i]['FIELD_NAME']; ?></span><br><span class="gensmall"><?php echo $this->_tpldata['input'][$this->_input_i]['FIELD_DESCRIPTION']; ?></span></td>
	<td class="row2">
	<input type="text" class="post" size="50" name="field[<?php echo $this->_tpldata['input'][$this->_input_i]['FIELD_ID']; ?>]" value="<?php echo $this->_tpldata['input'][$this->_input_i]['FIELD_VALUE']; ?>" />
	</td>
  </tr>
<?php }} ?><!-- SPILT --><?php $_textarea_count = (isset($this->_tpldata['textarea'])) ?  sizeof($this->_tpldata['textarea']) : 0;if ($_textarea_count) {for ($this->_textarea_i = 0; $this->_textarea_i < $_textarea_count; $this->_textarea_i++){ ?>
  <tr>
	<td class="row1"><span class="genmed"><?php echo $this->_tpldata['textarea'][$this->_textarea_i]['FIELD_NAME']; ?></span><br><span class="gensmall"><?php echo $this->_tpldata['textarea'][$this->_textarea_i]['FIELD_DESCRIPTION']; ?></span></td>
	<td class="row2">
	<textarea rows="6" class="post" name="field[<?php echo $this->_tpldata['textarea'][$this->_textarea_i]['FIELD_ID']; ?>]" cols="32"><?php echo $this->_tpldata['textarea'][$this->_textarea_i]['FIELD_VALUE']; ?></textarea>
	</td>
  </tr>
<?php }} ?><!-- SPILT --><?php $_radio_count = (isset($this->_tpldata['radio'])) ?  sizeof($this->_tpldata['radio']) : 0;if ($_radio_count) {for ($this->_radio_i = 0; $this->_radio_i < $_radio_count; $this->_radio_i++){ ?>
  <tr>
	<td class="row1"><span class="genmed"><?php echo $this->_tpldata['radio'][$this->_radio_i]['FIELD_NAME']; ?></span><br><span class="gensmall"><?php echo $this->_tpldata['radio'][$this->_radio_i]['FIELD_DESCRIPTION']; ?></span></td>
	<td class="row2">
	<?php $_row_count = (isset($this->_tpldata['radio'][$this->_radio_i]['row'])) ? sizeof($this->_tpldata['radio'][$this->_radio_i]['row']) : 0;if ($_row_count) {for ($this->_row_i = 0; $this->_row_i < $_row_count; $this->_row_i++){ ?>	
	<input type="radio" name="field[<?php echo $this->_tpldata['radio'][$this->_radio_i]['FIELD_ID']; ?>]" value="<?php echo $this->_tpldata['radio'][$this->_radio_i]['row'][$this->_row_i]['FIELD_VALUE']; ?>" <?php echo $this->_tpldata['radio'][$this->_radio_i]['row'][$this->_row_i]['FIELD_SELECTED']; ?> /><span class="gensmall"><?php echo $this->_tpldata['radio'][$this->_radio_i]['row'][$this->_row_i]['FIELD_VALUE']; ?></span>&nbsp;
	<?php }} ?>
	</td>
  </tr>	
<?php }} ?><!-- SPILT --><?php $_select_count = (isset($this->_tpldata['select'])) ?  sizeof($this->_tpldata['select']) : 0;if ($_select_count) {for ($this->_select_i = 0; $this->_select_i < $_select_count; $this->_select_i++){ ?>
  <tr>
	<td class="row1"><span class="genmed"><?php echo $this->_tpldata['select'][$this->_select_i]['FIELD_NAME']; ?></span><br><span class="gensmall"><?php echo $this->_tpldata['select'][$this->_select_i]['FIELD_DESCRIPTION']; ?></span></td>
	<td class="row2">
		<select name="field[<?php echo $this->_tpldata['select'][$this->_select_i]['FIELD_ID']; ?>]" class="post">
		<?php $_row_count = (isset($this->_tpldata['select'][$this->_select_i]['row'])) ? sizeof($this->_tpldata['select'][$this->_select_i]['row']) : 0;if ($_row_count) {for ($this->_row_i = 0; $this->_row_i < $_row_count; $this->_row_i++){ ?>	
		<option value="<?php echo $this->_tpldata['select'][$this->_select_i]['row'][$this->_row_i]['FIELD_VALUE']; ?>"<?php echo $this->_tpldata['radio'][$this->_radio_i]['row'][$this->_row_i]['FIELD_SELECTED']; ?>><?php echo $this->_tpldata['select'][$this->_select_i]['row'][$this->_row_i]['FIELD_VALUE']; ?></option>
		<?php }} ?>
		</select>
	</td>
  </tr>	
<?php }} ?><!-- SPILT --><?php $_select_multiple_count = (isset($this->_tpldata['select_multiple'])) ?  sizeof($this->_tpldata['select_multiple']) : 0;if ($_select_multiple_count) {for ($this->_select_multiple_i = 0; $this->_select_multiple_i < $_select_multiple_count; $this->_select_multiple_i++){ ?>
  <tr>
	<td class="row1"><span class="genmed"><?php echo $this->_tpldata['select_multiple'][$this->_select_multiple_i]['FIELD_NAME']; ?></span><br><span class="gensmall"><?php echo $this->_tpldata['select_multiple'][$this->_select_multiple_i]['FIELD_DESCRIPTION']; ?></span></td>
	<td class="row2">
		<select name="field[<?php echo $this->_tpldata['select_multiple'][$this->_select_multiple_i]['FIELD_ID']; ?>][]" multiple="multiple" size="4" class="post">
		<?php $_row_count = (isset($this->_tpldata['select_multiple'][$this->_select_multiple_i]['row'])) ? sizeof($this->_tpldata['select_multiple'][$this->_select_multiple_i]['row']) : 0;if ($_row_count) {for ($this->_row_i = 0; $this->_row_i < $_row_count; $this->_row_i++){ ?>	
		<option value="<?php echo $this->_tpldata['select_multiple'][$this->_select_multiple_i]['row'][$this->_row_i]['FIELD_VALUE']; ?>"<?php echo $this->_tpldata['select_multiple'][$this->_select_multiple_i]['row'][$this->_row_i]['FIELD_SELECTED']; ?>><?php echo $this->_tpldata['select_multiple'][$this->_select_multiple_i]['row'][$this->_row_i]['FIELD_VALUE']; ?></option>
		<?php }} ?>
		</select>
	</td>
  </tr>	
<?php }} ?><!-- SPILT --><?php $_checkbox_count = (isset($this->_tpldata['checkbox'])) ?  sizeof($this->_tpldata['checkbox']) : 0;if ($_checkbox_count) {for ($this->_checkbox_i = 0; $this->_checkbox_i < $_checkbox_count; $this->_checkbox_i++){ ?>
  <tr>
	<td class="row1"><span class="genmed"><?php echo $this->_tpldata['checkbox'][$this->_checkbox_i]['FIELD_NAME']; ?></span><br><span class="gensmall"><?php echo $this->_tpldata['checkbox'][$this->_checkbox_i]['FIELD_DESCRIPTION']; ?></span></td>
	<td class="row2">
	<?php $_row_count = (isset($this->_tpldata['checkbox'][$this->_checkbox_i]['row'])) ? sizeof($this->_tpldata['checkbox'][$this->_checkbox_i]['row']) : 0;if ($_row_count) {for ($this->_row_i = 0; $this->_row_i < $_row_count; $this->_row_i++){ ?>	
	<input type="checkbox" name="field[<?php echo $this->_tpldata['checkbox'][$this->_checkbox_i]['FIELD_ID']; ?>][<?php echo $this->_tpldata['checkbox'][$this->_checkbox_i]['row'][$this->_row_i]['FIELD_VALUE']; ?>]" value="<?php echo $this->_tpldata['checkbox'][$this->_checkbox_i]['row'][$this->_row_i]['FIELD_VALUE']; ?>" <?php echo $this->_tpldata['checkbox'][$this->_checkbox_i]['row'][$this->_row_i]['FIELD_CHECKED']; ?>><span class="gensmall"><?php echo $this->_tpldata['checkbox'][$this->_checkbox_i]['row'][$this->_row_i]['FIELD_VALUE']; ?></span>&nbsp;
	<?php }} ?>
	</td>
  </tr>	
<?php }} ?>