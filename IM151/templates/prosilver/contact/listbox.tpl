<script language="javascript" type="text/javascript">
<!--
function refresh_username(selected_username)
{
	opener.document.forms['post'].username.value = selected_username;
	opener.focus();
	window.close();
}
//-->
</script>

<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr> 
		<th colspan="2" class="thTop" height="25" nowrap="nowrap">{L_BUDDY_TITLE}</th>
	</tr>
	<tr> 
		<td class="row1" valign="middle">
<!-- BEGIN top -->
		<span class="gen">{NO_LIST}</span><br clear="all" />
<!-- END top -->

			<br />
<!-- BEGIN list -->
			<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
<!-- BEGIN list_row -->
				<tr> 
					<td class="row1" align="left" valign="middle" width="75%"><span class="gen"><a href="{list.list_row.U_ONCLICK}" {list.list_row.J_ONCLICK}>{list.list_row.USERNAME}</a></span></td>
					<td class="row1" align="left" valign="middle" width="25%"><span class="gen">{list.list_row.ONLINE_STATUS}</a></span></td>
				</tr>
<!-- END list_row -->
			</table>
<!-- END list -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr> 
	<td><span class="nav">{PAGE_NUMBER}</span></td>
	<td align="right"><span class="nav">{PAGINATION}</span></td>
  </tr>
</table>

		<br />
		</td>
	</tr>
</table>
