<script language="JavaScript" type="text/javascript">
<!--
function tour(link) {
 window.open(link, "_self", "width=250,height=800,scrollbars,resizable=no");
}
//-->
</script>

<table width="100%" cellspacing="2" cellpadding="5" border="0">
<!-- BEGIN forum_tour -->
	<tr>
		<td align="left" width="30%">{forum_tour.NAV_PREV}</td>
		<td align="center" width="40%">{forum_tour.NAV_FIRST_PAGE}</td>
		<td align="right" width="30%">{forum_tour.NAV_NEXT}</td>
	</tr>
	<tr>
		<td class="row2" nowrap="nowrap" align="center" colspan="3"><span class="mainmenu"><b>{forum_tour.SUBJECT}</b></span></td>
	</tr>
	<tr>
		<td class="row1" colspan="3"><span class="genmed">{forum_tour.MESSAGE}</span></td>
	</tr>
<!-- END forum_tour -->
</table>

<table width="100%" cellspacing="2" cellpadding="5" border="0">
<!-- BEGIN switch_no_forum_tour -->
	<tr>
		<td class="row2" align="center"><span class="mainmenu"><b>{switch_no_forum_tour.L_NO_FORUM_TOUR}</b></span></td>
	</tr>
<!-- END switch_no_forum_tour -->
</table>

<br />

<table width="100%" cellspacing="2" cellpadding="5" border="0" align="center">
<!-- BEGIN forum_tour -->
  <tr>
	<td align="center" valign="middle" width="100%"><span class="nav">{forum_tour.PAGINATION}</span></td>
  </tr>
<!-- END forum_tour -->
  <tr>
	<td align="center" valign="middle"><input class="mainoption" type="button" name="close" onClick="javascript:window.close()" value="{L_CLOSE_TOUR}"></td>
  </tr>
</table>