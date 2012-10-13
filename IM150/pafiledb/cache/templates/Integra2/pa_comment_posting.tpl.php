<?php $this->_tpl_include('pa_header.tpl'); ?>
<script language="JavaScript" type="text/javascript" src="templates/post_message.js"></script>
<script language="javascript" type="text/javascript" src="mods/bbcode_box/bbcode_box.js"></script>
<script language='javascript' src='spelling/spellmessage.js'></script>
<script language="javascript"> 
<!-- 
	var postmaxchars = <?php echo $this->_tpldata['.'][0]['MESSAGE_LENGTH']; ?>; 
	function checklength(theform)
	{ 
		if (postmaxchars != 0)
		{
			message = "";
		}
  		else
		{
			message = "";
		}
		alert("<?php echo ((isset($this->_tpldata['.'][0]['L_MSG_LENGTH_1'])) ? $this->_tpldata['.'][0]['L_MSG_LENGTH_1'] : ((isset($lang['MSG_LENGTH_1'])) ? $lang['MSG_LENGTH_1'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'MSG_LENGTH_1'))) . ' 	}')); ?>"+theform.message.value.length+"<?php echo ((isset($this->_tpldata['.'][0]['L_MSG_LENGTH_2'])) ? $this->_tpldata['.'][0]['L_MSG_LENGTH_2'] : ((isset($lang['MSG_LENGTH_2'])) ? $lang['MSG_LENGTH_2'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'MSG_LENGTH_2'))) . ' 	}')); ?>\n\r\n\r<?php echo ((isset($this->_tpldata['.'][0]['L_MSG_LENGTH_3'])) ? $this->_tpldata['.'][0]['L_MSG_LENGTH_3'] : ((isset($lang['MSG_LENGTH_3'])) ? $lang['MSG_LENGTH_3'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'MSG_LENGTH_3'))) . ' 	}')); ?>"+postmaxchars+"<?php echo ((isset($this->_tpldata['.'][0]['L_MSG_LENGTH_4'])) ? $this->_tpldata['.'][0]['L_MSG_LENGTH_4'] : ((isset($lang['MSG_LENGTH_4'])) ? $lang['MSG_LENGTH_4'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'MSG_LENGTH_4'))) . ' 	}')); ?>\n\r\n\r<?php echo ((isset($this->_tpldata['.'][0]['L_MSG_LENGTH_5'])) ? $this->_tpldata['.'][0]['L_MSG_LENGTH_5'] : ((isset($lang['MSG_LENGTH_5'])) ? $lang['MSG_LENGTH_5'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'MSG_LENGTH_5'))) . ' 	}')); ?>"+(postmaxchars-theform.message.value.length)+"<?php echo ((isset($this->_tpldata['.'][0]['L_MSG_LENGTH_6'])) ? $this->_tpldata['.'][0]['L_MSG_LENGTH_6'] : ((isset($lang['MSG_LENGTH_6'])) ? $lang['MSG_LENGTH_6'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'MSG_LENGTH_6'))) . ' 	}')); ?>"); 
	}
//--> 
</script>

<style type="text/css">
.postimage {
	cursor: pointer;
	cursor: hand;
}
</style>

<form action="<?php echo $this->_tpldata['.'][0]['S_POST_ACTION']; ?>" method="post" name="post" onsubmit="return checkForm(this)">

<?php if ($this->_tpldata['.'][0]['PREVIEW']) {  ?>
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr> 
		<th class="thHead" colspan="2" height="25"><?php echo ((isset($this->_tpldata['.'][0]['L_PREVIEW'])) ? $this->_tpldata['.'][0]['L_PREVIEW'] : ((isset($lang['PREVIEW'])) ? $lang['PREVIEW'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'PREVIEW'))) . ' 	}')); ?></th>
	</tr>
	<tr> 
		<td class="row1" valign="top"><span class="postbody"><?php echo $this->_tpldata['.'][0]['PRE_COMMENT']; ?></span></td>
	</tr>
</table>
<br />
<?php } ?>
<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom">
		<span class="nav"><a href="<?php echo $this->_tpldata['.'][0]['U_INDEX']; ?>" class="nav"><?php echo ((isset($this->_tpldata['.'][0]['L_INDEX'])) ? $this->_tpldata['.'][0]['L_INDEX'] : ((isset($lang['INDEX'])) ? $lang['INDEX'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'INDEX'))) . ' 	}')); ?></a> -> <a href="<?php echo $this->_tpldata['.'][0]['U_DOWNLOAD_HOME']; ?>" class="nav"><?php echo $this->_tpldata['.'][0]['DOWNLOAD']; ?></a><?php $_navlinks_count = (isset($this->_tpldata['navlinks'])) ?  sizeof($this->_tpldata['navlinks']) : 0;if ($_navlinks_count) {for ($this->_navlinks_i = 0; $this->_navlinks_i < $_navlinks_count; $this->_navlinks_i++){ ?> -> <a href="<?php echo $this->_tpldata['navlinks'][$this->_navlinks_i]['U_VIEW_CAT']; ?>" class="nav"><?php echo $this->_tpldata['navlinks'][$this->_navlinks_i]['CAT_NAME']; ?></a><?php }} ?> -> <a href="<?php echo $this->_tpldata['.'][0]['U_FILE_NAME']; ?>" class="nav"><?php echo $this->_tpldata['.'][0]['FILE_NAME']; ?></a> -> <?php echo ((isset($this->_tpldata['.'][0]['L_COMMENT_ADD'])) ? $this->_tpldata['.'][0]['L_COMMENT_ADD'] : ((isset($lang['COMMENT_ADD'])) ? $lang['COMMENT_ADD'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COMMENT_ADD'))) . ' 	}')); ?></span>
	</td>
  </tr>
</table>

<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr> 
		<th class="thHead" colspan="2" height="25"><b><?php echo ((isset($this->_tpldata['.'][0]['L_COMMENT_ADD'])) ? $this->_tpldata['.'][0]['L_COMMENT_ADD'] : ((isset($lang['COMMENT_ADD'])) ? $lang['COMMENT_ADD'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COMMENT_ADD'))) . ' 	}')); ?></b></th>
	</tr>
	<tr>
		<td class="row1" ><span class="gen"><b><?php echo ((isset($this->_tpldata['.'][0]['L_COMMENT_TITLE'])) ? $this->_tpldata['.'][0]['L_COMMENT_TITLE'] : ((isset($lang['COMMENT_TITLE'])) ? $lang['COMMENT_TITLE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COMMENT_TITLE'))) . ' 	}')); ?></b></span></td>
		<td class="row2"><input type="text" name="subject" size="45" maxlength="60" style="width:450px" tabindex="2" class="post" value="<?php echo $this->_tpldata['.'][0]['SUBJECT']; ?>" /></span></td>
	</tr>
	<tr> 
	  <td class="row1" valign="top"> 
		<table width="100%" border="0" cellspacing="0" cellpadding="1">
		  <tr> 
			<td><span class="gen"><b><?php echo ((isset($this->_tpldata['.'][0]['L_COMMENT'])) ? $this->_tpldata['.'][0]['L_COMMENT'] : ((isset($lang['COMMENT'])) ? $lang['COMMENT'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COMMENT'))) . ' 	}')); ?></b></span></td>
		  </tr>
		  <tr> 
			<td valign="middle" align="center"> <br />
<table width="100" border="0" cellspacing="0" cellpadding="5">
<tr align="center">
<td colspan="<?php echo $this->_tpldata['.'][0]['S_SMILIES_COLSPAN']; ?>" class="gensmall"><span class="explaintitle"><?php echo ((isset($this->_tpldata['.'][0]['L_EMOTICONS'])) ? $this->_tpldata['.'][0]['L_EMOTICONS'] : ((isset($lang['EMOTICONS'])) ? $lang['EMOTICONS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'EMOTICONS'))) . ' 	}')); ?></span></td>
</tr>
<?php $_smilies_row_count = (isset($this->_tpldata['smilies_row'])) ?  sizeof($this->_tpldata['smilies_row']) : 0;if ($_smilies_row_count) {for ($this->_smilies_row_i = 0; $this->_smilies_row_i < $_smilies_row_count; $this->_smilies_row_i++){ ?>
<tr align="center">
<?php $_smilies_col_count = (isset($this->_tpldata['smilies_row'][$this->_smilies_row_i]['smilies_col'])) ? sizeof($this->_tpldata['smilies_row'][$this->_smilies_row_i]['smilies_col']) : 0;if ($_smilies_col_count) {for ($this->_smilies_col_i = 0; $this->_smilies_col_i < $_smilies_col_count; $this->_smilies_col_i++){ ?>
<td><img src="<?php echo $this->_tpldata['smilies_row'][$this->_smilies_row_i]['smilies_col'][$this->_smilies_col_i]['SMILEY_IMG']; ?>" border="0" onmouseover="this.style.cursor='hand';" onclick="emoticon('<?php echo $this->_tpldata['smilies_row'][$this->_smilies_row_i]['smilies_col'][$this->_smilies_col_i]['SMILEY_CODE']; ?>');" alt="<?php echo $this->_tpldata['smilies_row'][$this->_smilies_row_i]['smilies_col'][$this->_smilies_col_i]['SMILEY_DESC']; ?>" title="<?php echo $this->_tpldata['smilies_row'][$this->_smilies_row_i]['smilies_col'][$this->_smilies_col_i]['SMILEY_DESC']; ?>" /></a></td>
<?php }} ?>
</tr>
<?php }}$_switch_smilies_extra_count = (isset($this->_tpldata['switch_smilies_extra'])) ?  sizeof($this->_tpldata['switch_smilies_extra']) : 0;if ($_switch_smilies_extra_count) {for ($this->_switch_smilies_extra_i = 0; $this->_switch_smilies_extra_i < $_switch_smilies_extra_count; $this->_switch_smilies_extra_i++){ ?>
<tr align="center">
<td colspan="<?php echo $this->_tpldata['.'][0]['S_SMILIES_COLSPAN']; ?>" class="nav"><a href="<?php echo $this->_tpldata['.'][0]['U_MORE_SMILIES']; ?>" onclick="window.open('<?php echo $this->_tpldata['.'][0]['U_MORE_SMILIES']; ?>', '_phpbbsmilies', 'HEIGHT=250,resizable=yes,scrollbars=yes,WIDTH=300');return false;" target="_phpbbsmilies"><?php echo ((isset($this->_tpldata['.'][0]['L_MORE_SMILIES'])) ? $this->_tpldata['.'][0]['L_MORE_SMILIES'] : ((isset($lang['MORE_SMILIES'])) ? $lang['MORE_SMILIES'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'MORE_SMILIES'))) . ' 	}')); ?></a></td>
</tr>
<?php }} ?>
</table>
</td>
</tr>
</table>
</td>
<td class="row2" valign="top">
<table id="posttable" cellspacing="0" cellpadding="0" border="0" width="450" style="border-collapse: collapse;">
	<tr>
		<td>
			<table cellspacing="0" cellpadding="0" border="0" width="450" style="border-collapse: collapse;">
				<tr>
					<td width="7"><img src="mods/bbcode_box/images/bar-left.gif" width="7" height="25" border="0" alt="" /></td>
					<td background="mods/bbcode_box/images/bar-bg.gif">
						<table cellspacing="0" cellpadding="0" border="0" width="430" style="border-collapse: collapse;">
							<tr>
								<td width="23"><img border="0" height="22" width="23" src="mods/bbcode_box/images/ltr.gif" class="postimage" name="dirltr" onClick="BBCdir('ltr')" onMouseOver="helpline('ltr')" alt="Left to Right" /></td>
								<td width="23"><img border="0" height="22" width="23" src="mods/bbcode_box/images/rtl.gif" class="postimage" name="dirrtl" onClick="BBCdir('rtl')" onMouseOver="helpline('rtl')" alt="Right to Left" /></td>
								<td width="6"><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td width="23"><img border="0" height="22" width="23" src="mods/bbcode_box/images/plain.gif" class="postimage" name="plain" onClick="BBCplain()" onMouseOver="helpline('plain')" alt="Remove BBcode" />
								<td width="6"><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td width="23"><input border="0" height="22" width="23" src="mods/bbcode_box/images/spell.gif" class="postimage" value="SpellCheck" name="button" type="image" onclick="openspell();return false;" onMouseOver="helpline('spell')" /></td>
								<td width="6"><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td align="right"><a href="http://hvmdesign.com/" class="gensmall" title="BBCode Box MOD - by Disturbed One - www.HVMDesign.com" target="blank">Advanced BBCode Box v5.0.0</a>&nbsp;</td>
							</tr>
						</table>
					</td>
					<td width="13"><img src="mods/bbcode_box/images/bar-right.gif" width="13" height="25" border="0" alt="" /></td>
				</tr>
				<tr>
					<td width="7"><img src="mods/bbcode_box/images/bar-left.gif" width="7" height="25" border="0" alt="" /></td>
					<td background="mods/bbcode_box/images/bar-bg.gif">
						<table cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
							<tr>
								<td><img src="mods/bbcode_box/images/font.gif" width="23" height="22" border="0" alt="Font" /></td>
								<td style="white-space: nowrap;">
									<select style="height: 20px;" name="ft" onChange="BBCft()" onMouseOver="helpline('ft')">
										<option style="font-weight : bold;" selected="selected">Font type</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Arial;" value="Arial" class="genmed">Arial</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Arial Black;" value="Arial Black" class="genmed">Arial Black</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Century Gothic;" value="Century Gothic" class="genmed">Century Gothic</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Comic Sans MS;" value="Comic Sans MS" class="genmed">Comic Sans MS</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Courier New;" value="Courier New" class="genmed">Courier New</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Georgia;" value="Georgia" class="genmed">Georgia</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Lucida Console;"value="Lucida Console">Lucida Console</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Microsoft Sans Serif;" value="Microsoft Sans Serif" class="genmed">Microsoft Sans Serif</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Symbol;" value="Symbol" class="genmed">Symbol</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Tahoma;" value="Tahoma" class="genmed">Tahoma</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Trebuchet;" value="Trebuchet" class="genmed">Trebuchet</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Times New Roman;" value="Times New Roman" class="genmed">Times New Roman</option>
										<option style="color:black; background-color: #FFFFFF; font-family: Verdana;" value="Verdana" class="genmed">Verdana</option>
									</select>
									<select style="height: 20px;" name="fs" onChange="BBCfs()" onMouseOver="helpline('fs')">
										<option style="font-weight : bold;" selected="selected">Font Size</option>
										<option style="color:black; font-size: 8;" value="8" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FONT_TINY'])) ? $this->_tpldata['.'][0]['L_FONT_TINY'] : ((isset($lang['FONT_TINY'])) ? $lang['FONT_TINY'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FONT_TINY'))) . ' 	}')); ?></option>
										<option style="color:black; font-size: 10;" value="10" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FONT_SMALL'])) ? $this->_tpldata['.'][0]['L_FONT_SMALL'] : ((isset($lang['FONT_SMALL'])) ? $lang['FONT_SMALL'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FONT_SMALL'))) . ' 	}')); ?></option>
										<option style="color:black; font-size: 12;" value="12" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FONT_NORMAL'])) ? $this->_tpldata['.'][0]['L_FONT_NORMAL'] : ((isset($lang['FONT_NORMAL'])) ? $lang['FONT_NORMAL'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FONT_NORMAL'))) . ' 	}')); ?></option>
										<option style="color:black; font-size: 18;" value="18" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FONT_LARGE'])) ? $this->_tpldata['.'][0]['L_FONT_LARGE'] : ((isset($lang['FONT_LARGE'])) ? $lang['FONT_LARGE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FONT_LARGE'))) . ' 	}')); ?></option>
										<option style="color:black; font-size: 24;" value="24" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_FONT_HUGE'])) ? $this->_tpldata['.'][0]['L_FONT_HUGE'] : ((isset($lang['FONT_HUGE'])) ? $lang['FONT_HUGE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'FONT_HUGE'))) . ' 	}')); ?></option>
									</select>
									<select style="height: 20px;" name="fc" onChange="BBCfc()" onMouseOver="helpline('fc')">
										<option style="font-weight: bold;" selected="selected">Font Color</option>
										<option style="color:red; background-color: <?php echo $this->_tpldata['.'][0]['T_TD_COLOR1']; ?>" value="red" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_COLOR_RED'])) ? $this->_tpldata['.'][0]['L_COLOR_RED'] : ((isset($lang['COLOR_RED'])) ? $lang['COLOR_RED'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COLOR_RED'))) . ' 	}')); ?></option>
										<option style="color:orange; background-color: <?php echo $this->_tpldata['.'][0]['T_TD_COLOR1']; ?>" value="orange" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_COLOR_ORANGE'])) ? $this->_tpldata['.'][0]['L_COLOR_ORANGE'] : ((isset($lang['COLOR_ORANGE'])) ? $lang['COLOR_ORANGE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COLOR_ORANGE'))) . ' 	}')); ?></option>
										<option style="color:brown; background-color: <?php echo $this->_tpldata['.'][0]['T_TD_COLOR1']; ?>" value="brown" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_COLOR_BROWN'])) ? $this->_tpldata['.'][0]['L_COLOR_BROWN'] : ((isset($lang['COLOR_BROWN'])) ? $lang['COLOR_BROWN'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COLOR_BROWN'))) . ' 	}')); ?></option>
										<option style="color:yellow; background-color: <?php echo $this->_tpldata['.'][0]['T_TD_COLOR1']; ?>" value="yellow" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_COLOR_YELLOW'])) ? $this->_tpldata['.'][0]['L_COLOR_YELLOW'] : ((isset($lang['COLOR_YELLOW'])) ? $lang['COLOR_YELLOW'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COLOR_YELLOW'))) . ' 	}')); ?></option>
										<option style="color:green; background-color: <?php echo $this->_tpldata['.'][0]['T_TD_COLOR1']; ?>" value="green" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_COLOR_GREEN'])) ? $this->_tpldata['.'][0]['L_COLOR_GREEN'] : ((isset($lang['COLOR_GREEN'])) ? $lang['COLOR_GREEN'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COLOR_GREEN'))) . ' 	}')); ?></option>
										<option style="color:olive; background-color: <?php echo $this->_tpldata['.'][0]['T_TD_COLOR1']; ?>" value="olive" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_COLOR_OLIVE'])) ? $this->_tpldata['.'][0]['L_COLOR_OLIVE'] : ((isset($lang['COLOR_OLIVE'])) ? $lang['COLOR_OLIVE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COLOR_OLIVE'))) . ' 	}')); ?></option>
										<option style="color:cyan; background-color: <?php echo $this->_tpldata['.'][0]['T_TD_COLOR1']; ?>" value="cyan" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_COLOR_CYAN'])) ? $this->_tpldata['.'][0]['L_COLOR_CYAN'] : ((isset($lang['COLOR_CYAN'])) ? $lang['COLOR_CYAN'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COLOR_CYAN'))) . ' 	}')); ?></option>
										<option style="color:blue; background-color: <?php echo $this->_tpldata['.'][0]['T_TD_COLOR1']; ?>" value="blue" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_COLOR_BLUE'])) ? $this->_tpldata['.'][0]['L_COLOR_BLUE'] : ((isset($lang['COLOR_BLUE'])) ? $lang['COLOR_BLUE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COLOR_BLUE'))) . ' 	}')); ?></option>
										<option style="color:darkblue; background-color: <?php echo $this->_tpldata['.'][0]['T_TD_COLOR1']; ?>" value="darkblue" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_COLOR_DARK_BLUE'])) ? $this->_tpldata['.'][0]['L_COLOR_DARK_BLUE'] : ((isset($lang['COLOR_DARK_BLUE'])) ? $lang['COLOR_DARK_BLUE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COLOR_DARK_BLUE'))) . ' 	}')); ?></option>
										<option style="color:indigo; background-color: <?php echo $this->_tpldata['.'][0]['T_TD_COLOR1']; ?>" value="indigo" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_COLOR_INDIGO'])) ? $this->_tpldata['.'][0]['L_COLOR_INDIGO'] : ((isset($lang['COLOR_INDIGO'])) ? $lang['COLOR_INDIGO'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COLOR_INDIGO'))) . ' 	}')); ?></option>
										<option style="color:violet; background-color: <?php echo $this->_tpldata['.'][0]['T_TD_COLOR1']; ?>" value="violet" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_COLOR_VIOLET'])) ? $this->_tpldata['.'][0]['L_COLOR_VIOLET'] : ((isset($lang['COLOR_VIOLET'])) ? $lang['COLOR_VIOLET'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COLOR_VIOLET'))) . ' 	}')); ?></option>
										<option style="color:white; background-color: <?php echo $this->_tpldata['.'][0]['T_TD_COLOR1']; ?>" value="white" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_COLOR_WHITE'])) ? $this->_tpldata['.'][0]['L_COLOR_WHITE'] : ((isset($lang['COLOR_WHITE'])) ? $lang['COLOR_WHITE'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COLOR_WHITE'))) . ' 	}')); ?></option>
										<option style="color:black; background-color: <?php echo $this->_tpldata['.'][0]['T_TD_COLOR1']; ?>" value="black" class="genmed"><?php echo ((isset($this->_tpldata['.'][0]['L_COLOR_BLACK'])) ? $this->_tpldata['.'][0]['L_COLOR_BLACK'] : ((isset($lang['COLOR_BLACK'])) ? $lang['COLOR_BLACK'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COLOR_BLACK'))) . ' 	}')); ?></option>
									</select>
								</td>
								<td><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/fade.gif" class="postimage" name="fade" onClick="BBCfade()" onMouseOver="helpline('fade')" alt="Fade" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/grad.gif" class="postimage" name="grad" onClick="BBCgrad()" onMouseOver="helpline('grad')" alt="Gradient" /></td>
								<td><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/list.gif" class="postimage" name="listdf" onClick="BBClist()" onMouseOver="helpline('list')" alt="List" /></td>
							</tr>
						</table>
					</td>
					<td width="13"><img src="mods/bbcode_box/images/bar-right.gif" width="13" height="25" border="0" alt="" /></td>
				</tr>
				<tr>
					<td width="7"><img src="mods/bbcode_box/images/bar-left.gif" width="7" height="25" border="0" alt="" /></td>
					<td background="mods/bbcode_box/images/bar-bg.gif">
						<table cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
							<tr>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/left.gif" class="postimage" name="left" onClick="BBCleft()" onMouseOver="helpline('left')" alt="Left" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/center.gif" class="postimage" name="center" onClick="BBCcenter()" onMouseOver="helpline('center')" alt="Center" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/right.gif" class="postimage" name="right" onClick="BBCright()" onMouseOver="helpline('right')" alt="Right" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/justify.gif" class="postimage" name="justify" onClick="BBCjustify()" onMouseOver="helpline('justify')" alt="Justify" /></td>
								<td><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/bold.gif" class="postimage" name="bold" onClick="BBCbold()" onMouseOver="helpline('b')" alt="Bold" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/italic.gif" class="postimage" name="italic" onClick="BBCitalic()" onMouseOver="helpline('i')" alt="Italic" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/under.gif" class="postimage" name="under" onClick="BBCunder()" onMouseOver="helpline('u')" alt="Underline" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/strike.gif" class="postimage" name="strik" onClick="BBCstrike()" onMouseOver="helpline('strike')" alt="Strike-through" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/sup.gif" class="postimage" name="supscript" onClick="BBCsup()" onMouseOver="helpline('sup')" alt="Superscript" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/sub.gif" class="postimage" name="subs" onClick="BBCsub()" onMouseOver="helpline('sub')" alt="Subscript" /></td>
								<td><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/marqd.gif" class="postimage" name="marqd" onClick="BBCmarqd()" onMouseOver="helpline('marqd')" alt="Marquee Down" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/marqu.gif" class="postimage" name="marqu" onClick="BBCmarqu()" onMouseOver="helpline('marqu')" alt="Marquee Up" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/marql.gif" class="postimage" name="marql" onClick="BBCmarql()" onMouseOver="helpline('marql')" alt="Marquee Left" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/marqr.gif" class="postimage" name="marqr" onClick="BBCmarqr()" onMouseOver="helpline('marqr')" alt="Marquee Right" /></td>
								<td><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/code.gif" class="postimage" name="code" onClick="BBCcode()" onMouseOver="helpline('code')" alt="Code" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/php.gif" class="postimage" name="php" onClick="BBCphp()" onMouseOver="helpline('php')" alt="PHP" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/quote.gif" class="postimage" name="quote" onClick="BBCquote()" onMouseOver="helpline('quote')" alt="Quote" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/spoil.gif" class="postimage" name="spoil" onClick="BBCspoil()" onMouseOver="helpline('spoil')" alt="Spoilers" /></td>
							</tr>
						</table>
					</td>
					<td width="13"><img src="mods/bbcode_box/images/bar-right.gif" width="13" height="25" border="0" alt="" /></td>
				</tr>
				<tr>
					<td width="7"><img src="mods/bbcode_box/images/bar-left.gif" width="7" height="25" border="0" alt="" /></td>
					<td background="mods/bbcode_box/images/bar-bg.gif">
						<table cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
							<tr>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/anchor.gif" class="postimage" name="anchor" onClick="BBCanchor()" onMouseOver="helpline('anchor')" alt="Anchor" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/url.gif" class="postimage" name="url" onClick="BBCurl()" onMouseOver="helpline('url')" alt="URL" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/email.gif" class="postimage" name="email" onClick="BBCmail()" onMouseOver="helpline('mail')" alt="Email" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/gotopost.gif" class="postimage" name="gotopost" onClick="BBCgotopost()" onMouseOver="helpline('gotopost')" alt="Gotopost" /></td>
								<td><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/search.gif" class="postimage" name="search" onClick="BBCsearch()" onMouseOver="helpline('search')" alt="Search" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/google.gif" class="postimage" name="you" onClick="BBCgoogle()" onMouseOver="helpline('google')" alt="Google" /></td>
								<td><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/img.gif" class="postimage" name="img" onClick="BBCimg()" onMouseOver="helpline('img')" alt="Image" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/flash.gif" class="postimage" name="flash" onClick="BBCflash()" onMouseOver="helpline('flash')" alt="Flash" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/sound.gif" class="postimage" name="stream" onClick="BBCstream()" onMouseOver="helpline('stream')" alt="Stream" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/ram.gif" class="postimage" name="ram" onClick="BBCram()" onMouseOver="helpline('ram')" alt="Real Media" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/video.gif" class="postimage" name="video" onClick="BBCvideo()" onMouseOver="helpline('video')" alt="Video" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/web.gif" class="postimage" name="web" onClick="BBCweb()" onMouseOver="helpline('web')" alt="Web Page" /></td>
								<td><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/tab.gif" class="postimage" name="tab" onClick="BBCtab()" onMouseOver="helpline('tab')" alt="Tab" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/nbsp.gif" class="postimage" name="nbsp" onClick="BBCnbsp()" onMouseOver="helpline('nbsp')" alt="NBSP" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/hr.gif" class="postimage" name="hr" onClick="BBChr()" onMouseOver="helpline('hr')" alt="H-Line" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/you.gif" class="postimage" name="you" onClick="BBCyou()" onMouseOver="helpline('you')" alt="You" /></td>
								<td><img border="0" height="25" width="6" src="mods/bbcode_box/images/bar-div.gif" alt="" /></td>
								<td><img border="0" height="22" width="23" src="mods/bbcode_box/images/table.gif" class="postimage" name="table" onClick="BBCtable()" onMouseOver="helpline('table')" alt="Table" /></td>
							</tr>
						</table>
					</td>
					<td width="13"><img src="mods/bbcode_box/images/bar-right.gif" width="13" height="25" border="0" alt="" /></td>
				</tr>
				<tr>
					<td width="7"><img src="mods/bbcode_box/images/bar-left.gif" width="7" height="25" border="0" alt="" /></td>
					<td background="mods/bbcode_box/images/bar-bg.gif">
						<table cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
							<tr>
								<td><img src="mods/bbcode_box/images/help.gif" width="23" height="22" border="0" alt="Help" /></td>
								<td><input type="text" name="helpbox" size="45" maxlength="100" style="width:395px; font-size:10px" value="Tip: Styles can be applied quickly to selected text." /></td>
							</tr>
						</table>
					</td>
					<td width="13"><img src="mods/bbcode_box/images/bar-right.gif" width="13" height="25" border="0" alt="" /></td>
				</tr>
				<tr>
					<td colspan="3"><textarea name="message" rows="15" cols="35" style="width:450px" tabindex="3" class="post" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this); typeQuietly(this, event);"><?php echo $this->_tpldata['.'][0]['COMMENT']; ?></textarea></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
        </td>
	</tr>
	<tr>
		<td class="row1"><span class="gen"><B><?php echo ((isset($this->_tpldata['.'][0]['L_OPTIONS'])) ? $this->_tpldata['.'][0]['L_OPTIONS'] : ((isset($lang['OPTIONS'])) ? $lang['OPTIONS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'OPTIONS'))) . ' 	}')); ?></b></span><br /><span class="gensmall"><?php echo $this->_tpldata['.'][0]['HTML_STATUS']; ?><br /><?php echo $this->_tpldata['.'][0]['BBCODE_STATUS']; ?><br /><?php echo $this->_tpldata['.'][0]['SMILIES_STATUS']; ?><br /><?php echo $this->_tpldata['.'][0]['LINKS_STATUS']; ?><br /><?php echo $this->_tpldata['.'][0]['IMAGES_STATUS']; ?></span></td>
		<td class="row2"><span class="gen"><?php echo ((isset($this->_tpldata['.'][0]['L_COMMENT_EXPLAIN'])) ? $this->_tpldata['.'][0]['L_COMMENT_EXPLAIN'] : ((isset($lang['COMMENT_EXPLAIN'])) ? $lang['COMMENT_EXPLAIN'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'COMMENT_EXPLAIN'))) . ' 	}')); ?><br /><a href="javascript:checklength(document.post);"><?php echo ((isset($this->_tpldata['.'][0]['L_CHECK_MSG_LENGTH'])) ? $this->_tpldata['.'][0]['L_CHECK_MSG_LENGTH'] : ((isset($lang['CHECK_MSG_LENGTH'])) ? $lang['CHECK_MSG_LENGTH'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'CHECK_MSG_LENGTH'))) . ' 	}')); ?></a></span></td>
	</tr>
	<tr> 
	  <td class="cat" colspan="2" align="center" height="28"> <?php echo $this->_tpldata['.'][0]['S_HIDDEN_FORM_FIELDS']; ?><input type="submit" tabindex="5" name="preview" class="mainoption" value="<?php echo ((isset($this->_tpldata['.'][0]['L_PREVIEW'])) ? $this->_tpldata['.'][0]['L_PREVIEW'] : ((isset($lang['PREVIEW'])) ? $lang['PREVIEW'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'PREVIEW'))) . ' 	}')); ?>" />&nbsp;<input type="submit" accesskey="s" tabindex="6" name="submit" class="mainoption" value="<?php echo ((isset($this->_tpldata['.'][0]['L_SUBMIT'])) ? $this->_tpldata['.'][0]['L_SUBMIT'] : ((isset($lang['SUBMIT'])) ? $lang['SUBMIT'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SUBMIT'))) . ' 	}')); ?>" /></td>
  </form>
	</tr>
  </table>

<?php $this->_tpl_include('pa_footer.tpl'); ?>