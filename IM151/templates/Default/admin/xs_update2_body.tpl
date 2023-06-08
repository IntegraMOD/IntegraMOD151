
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
	<tr>
		<th class="thCornerL" align="center" nowrap="nowrap">{L_XS_UPDATE_NAME}</th>
		<th class="thTop" align="center" nowrap="nowrap">{L_XS_UPDATE_TYPE}</th>
		<th class="thTop" align="center" nowrap="nowrap">{L_XS_UPDATE_CURRENT_VERSION}</th>
		<th class="thTop" align="center" nowrap="nowrap">{L_XS_UPDATE_LATEST_VERSION}</th>
		<th class="thTop" align="center" nowrap="nowrap">{L_XS_UPDATE_DOWNLOADINFO}</th>
		<th class="thCornerR" align="center" nowrap="nowrap">{L_XS_UPDATE_FILEINFO}</th>
	</tr>
	<!-- BEGIN row -->
	<tr>
		<td class="row1" align="left" nowrap="nowrap"><span class="gen">{row.item}</span></td>
		<td class="row2" align="center" nowrap="nowrap"><span class="gen">{row.type}</span></td>
		<td class="row1" align="center" nowrap="nowrap"><span class="gen">{row.version}</span></td>
		<!-- BEGIN update -->
		<td class="row2" align="center" nowrap="nowrap"><span class="gen">{row.update.version}</span></td>
		<td class="row1" align="center" nowrap="nowrap"><span class="gensmall">[<a href="{row.update.update}" target="_blank">{L_XS_DOWNLOAD}</a>]</td>
		<td class="row1" align="center" nowrap="nowrap"><?php if(!empty($update_item['info'])) { ?> [<a href="{row.update.info}" target="_blank">{L_XS_INFO}</a>]<?php } else echo '&nbsp;'; ?></td>
		<!-- END update -->
		<!-- BEGIN noupdate -->
		<td colspan="2" class="row2" align="left" nowrap="nowrap"><span class="genmed">{row.noupdate.message}</span></td>
		<td class="row1" align="center" nowrap="nowrap"><?php if(!empty($noupdate_item['info'])) { ?> [<a href="{row.noupdate.info}" target="_blank">{L_XS_INFO}</a>]<?php } else echo '&nbsp;'; ?></td>
		<!-- END noupdate -->
		<!-- BEGIN error -->
		<td colspan="2" class="row3" align="left" nowrap="nowrap"><span class="gen">{row.error.error}</span></td>
		<td class="row1">&nbsp;</td>
		<!-- END error -->
	</tr>
	<!-- END row -->
	<tr>
		<td class="cat" colspan="6" align="center">{COUNT_TOTAL}, {COUNT_ERROR}, {COUNT_UPDATE}</td>
	</tr>
</table>

<br />
