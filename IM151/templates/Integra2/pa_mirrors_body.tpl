<!-- INCLUDE pa_header.tpl -->
<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a href="{U_DOWNLOAD_HOME}" class="nav">{DOWNLOAD}</a><!-- BEGIN navlinks --> -> <a href="{navlinks.U_VIEW_CAT}" class="nav">{navlinks.CAT_NAME}</a><!-- END navlinks --> -> {FILE_NAME}</span></td>
  </tr>
</table>
<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr> 
	<th class="thCornerL">{L_MIRRORS}</th>
	<th class="thCornerR">{L_MIRROR_LOCATION}</th>
  </tr>
  <!-- BEGIN mirror_row -->
  <tr>
	<td class="row2" valign="middle"><span class="genmed"><a href="{mirror_row.U_DOWNLOAD}">{L_DOWNLOAD}</a></span></td>
	<td class="row1" valign="middle"><span class="genmed">{mirror_row.MIRROR_LOCATION}</span></td>
  </tr>
  <!-- END mirror_row -->
  <tr> 
	<td class="cat" align="center" colspan="2"></td>
  </tr>
</table>
<!-- INCLUDE pa_footer.tpl -->