
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
	<tr>
		<th class="thCornerL" align="center" nowrap="nowrap">File</th>
		<th class="thTop" align="center" nowrap="nowrap">Template</th>
		<th class="thTop" align="center" nowrap="nowrap">Styles</th>
		<th class="thTop" align="center" nowrap="nowrap">Upload Time</th>
		<th class="thTop" align="center" nowrap="nowrap">Comment</th>
		<th class="thCornerR" align="center" nowrap="nowrap">Options</th>
	</tr>
	<!-- BEGIN styles -->
	<tr>
		<td class="{styles.ROW_CLASS}" align="left"><span class="gensmall">{styles.FILE2}</span></td>
		<td class="{styles.ROW_CLASS}" align="left"><span class="gen"><!-- BEGIN valid -->{styles.TEMPLATE}<!-- END valid --><!-- BEGIN error -->-<!-- END error --></span></td>
		<td class="{styles.ROW_CLASS}" align="left"><span class="gen"><!-- BEGIN list -->{list.STYLE}<br /><!-- END list --></span></td>
		<td class="{styles.ROW_CLASS}" align="center" nowrap="nowrap"><span class="genmed"><!-- BEGIN valid -->{styles.DATE}<!-- END valid --><!-- BEGIN error -->-<!-- END error --></span></td>
		<td class="{styles.ROW_CLASS}" align="left"><span class="gensmall"><!-- BEGIN valid -->{styles.COMMENT}<!-- END valid --><!-- BEGIN error -->{styles.error.ERROR}<!-- END error --></span></td>
		<td class="{styles.ROW_CLASS}" align="center">
		<!-- BEGIN valid -->
			[<a href="{styles.U_IMPORT}">import</a>]
			[<a href="{styles.U_LIST}">list files</a>]
		<!-- END valid -->
			[<a href="{styles.U_DELETE}">delete file</a>]
		</td>
	</tr>
	<!-- END styles -->
	<!-- BEGIN nostyles -->
	<tr>
		<td colspan="6" align="center"><span class="gen">There are no cached styles to import</span></td>
	</tr>
	<!-- END nostyles -->
</table>

<br />

<table width="100%">

<table width="100%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
	  <th class="thHead" colspan="2">Add Styles</th>
	</tr>
	<tr>
		<td class="row1">Download from web:</td>
		<td class="row2" nowrap="nowrap">
			<form action="{U_SCRIPT}" method="post" style="display: inline;"><input type="hidden" name="action" value="web" />{S_HIDDEN_FIELDS}
			<input type="text" name="source" size="40" value="http://" />
			<input type="submit" value="Get it" class="mainoption" />
			</form>
		</tr>
	</tr>
	<tr>
		<td class="row1">Copy from local file:</td>
		<td class="row2" nowrap="nowrap">
			<form action="{U_SCRIPT}" method="post" style="display: inline;"><input type="hidden" name="action" value="copy" />{S_HIDDEN_FIELDS}
			<input type="text" name="source" size="40" value="" />
			<input type="submit" value="Copy" class="mainoption" />
			</form>
		</tr>
	</tr>
	<tr>
		<td class="row1">Upload from computer:</td>
		<td class="row2" nowrap="nowrap">
			<form action="{U_SCRIPT}" method="post" enctype="multipart/form-data" style="display: inline;"><input type="hidden" name="action" value="upload" />{S_HIDDEN_FIELDS}
			<input type="file" name="source" size="30" />
			<input type="submit" value="Upload" class="mainoption" />
			</form>
		</tr>
	</tr>
</table>
