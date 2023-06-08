<!-- INCLUDE pa_header.tpl -->
<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom">
		<span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a href="{U_DOWNLOAD}" class="nav">{DOWNLOAD}</a></span>
	</td>
  </tr>
</table>

<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr>
	<th class="thCornerL" width="6%">&nbsp;</th>
	<th class="thTop">{L_CATEGORY}</th>
	<th class="thCornerR" width="10%">{L_LAST_FILE}</th>	
	<th class="thCornerR" width="8%">{L_FILES}</th>
  </tr>
<!-- BEGIN no_cat_parent -->
	<!-- IF no_cat_parent.IS_HIGHER_CAT -->
<tr>
	<td class="cat" colspan="2" valign="middle"><a href="{no_cat_parent.U_CAT}" class="cattitle">{no_cat_parent.CAT_NAME}</a></td>
	<td class="rowpic" colspan="2" align="right">&nbsp;</td>
</tr>
	<!-- ELSE -->
<tr>
	<td class="row1" valign="middle" align="center"><a href="{no_cat_parent.U_CAT}" class="cattitle"><img src="{no_cat_parent.CAT_IMAGE}" border="0" alt="{no_cat_parent.CAT_NEW_FILE}"></a></td>
	<td class="row1" valign="middle"><a href="{no_cat_parent.U_CAT}" class="cattitle">{no_cat_parent.CAT_NAME}</a><br><span class="genmed">{no_cat_parent.CAT_DESC}</span><br><span class="gensmall"><b>{L_SUB_CAT}:</b> </span><span class="gensmall">{no_cat_parent.SUB_CAT}</span></b></td>
	<td class="row2" align="center" valign="middle" nowrap="nowrap"><span class="genmed">{no_cat_parent.LAST_FILE}</span></td>
	<td class="row2" align="center" valign="middle"><span class="genmed">{no_cat_parent.FILECAT}</span></td>
</tr>
	<!-- ENDIF -->
<!-- END no_cat_parent -->

  <tr> 
	<td class="cat" colspan="4">&nbsp;</td>
  </tr>
</table>
<!-- INCLUDE pa_footer.tpl -->