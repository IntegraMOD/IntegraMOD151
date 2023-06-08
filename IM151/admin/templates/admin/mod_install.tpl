<p>{L_EM_INTRO}</p>
<br>
<h2>{L_UNPROCESSED}</h2>
<p>{L_UNPROCESSED_DESC}</p>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
  <tr> 
	<th width="20%" class="thCornerL" height="25">{L_MOD}</th>
	<th width="10%" class="thTop" height="25">{L_AUTHOR}</th>
	<th width="35%" class="thTop" height="25">{L_DESCRIPTION}</th>
	<th width="10%" class="thTop" height="25">{L_EMC}</th>
	<th width="5%"  class="thCornerR" height="25">&nbsp; &nbsp;</th>
  </tr>
  <!-- BEGIN unprocessed -->
  <tr>
	<td class="{unprocessed.ROW_CLASS}" align="center">
	  <table width="100%">
	    <tr>
		<td align="center"><span class="gen"><b>{unprocessed.MOD_TITLE}</b></span></td>
	    </tr>
	    <tr>
		<td align="center"><span class="gen">{unprocessed.MOD_VERSION}</span></td>
	    </tr>
	    <tr>
		<td align="center"><span class="gen"><a href="{unprocessed.MOD_FILE_URL}" class="gen" target="_blank">{unprocessed.MOD_FILE}</a></span></td>
	    </tr>
	  </table>
	</td>
	<td class="{unprocessed.ROW_CLASS}" align="center">
	  <table width="100%">
	    <tr>
		<td align="center"><span class="gen"><b>{unprocessed.MOD_AUTHOR}</b></span></td>
	    </tr>
	    <tr>
		<td align="center"><span class="gen">{unprocessed.MOD_URL}</span></td>
	    </tr>
	  </table>
	</td>
	<td class="{unprocessed.ROW_CLASS}" align="left"><span class="gen">{unprocessed.MOD_DESC}</span></td>
	<td class="{unprocessed.ROW_CLASS}" align="center"><span class="gen">{unprocessed.MOD_EMC}</span></td>
	<td class="{unprocessed.ROW_CLASS}" align="center" valign="bottom">
		<form method="post" action="{S_ACTION}">
			<input type="hidden" name="mode" value="process" />
			<input type="hidden" name="install_file" value="{unprocessed.MOD_FILE}" />
			<input type="hidden" name="install_path" value="{unprocessed.MOD_PATH}" />
			<input type="hidden" name="password" value="{EM_PASS}" />
			<input type="submit" name="post" class="mainoption" value="{L_PROCESS}" /><br>
			{L_PREVIEW}: <input type="checkbox" name="preview" value="0" />
		</form>
	</td>
  </tr>
  <!-- END unprocessed -->

  <!-- BEGIN no_unprocessed -->
  <tr>
	<td colspan="6" align="center" class="row1"><span class="gen"><br>{L_ALL_PROCESSED}<br><br></span></td>
  </tr>
  <!-- END no_unprocessed -->
</table>
<br>
