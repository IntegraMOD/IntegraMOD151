
<h1>{L_LW_SUBSCRIPTIONS}</h1>
<p>{L_LW_SUB_EXPLAIN}</p>
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
  <tr> 
	<th width="25%" class="thCornerL" height="25">&nbsp;{L_LW_SUB_GROUP_NAME}&nbsp;</th>
	<th width="25%" height="25" class="thTop">&nbsp;{L_LW_SUB_GROUP_INORNOT}&nbsp;</th>
	<th width="25%" class="thTop">&nbsp;{L_LW_SUB_EXPIRATION}&nbsp;</th>
	<th width="25%" class="thCornerR">&nbsp;{L_LW_SUB_ACTION}&nbsp;</th>
  </tr>
  <!-- BEGIN lw_sub_user_row -->
  <tr> 
  	{lw_sub_user_row.LW_SUB_GRP_FORM_ACTION_S}
	<td width="25%" class="{lw_sub_user_row.ROW_CLASS}">&nbsp;<span class="gen"><a href="{lw_sub_user_row.LW_SUB_GRP_PROFILE}" class="gen">{lw_sub_user_row.LW_SUB_GRP_NAME}</a></span>&nbsp;</td>
	<td width="25%" align="center" class="{lw_sub_user_row.ROW_CLASS}">&nbsp;<span class="gen">{lw_sub_user_row.LW_SUB_GRP_INORNOT}</span>&nbsp;</td>
	<td width="25%" align="center" nowrap="nowrap" class="{lw_sub_user_row.ROW_CLASS}">&nbsp;<span class="gen">{lw_sub_user_row.LW_SUB_EXPTIME}</span>&nbsp;</td>
	<td width="25%" class="{lw_sub_user_row.ROW_CLASS}">&nbsp;<span class="gen">{lw_sub_user_row.LW_SUB_ACTION}</span>&nbsp;</td>
  	{lw_sub_user_row.LW_SUB_GRP_FORM_ACTION_E}
  </tr>
  <!-- END lw_sub_user_row -->
</table>

<br />
