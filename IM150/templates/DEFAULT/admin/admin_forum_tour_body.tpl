<script language="JavaScript" type="text/javascript">
<!--
function tour() {
 window.open("./../tour.php", "_tour", "width=800,height=600,scrollbars,resizable=yes");
}
//-->
</script>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr>
	  <td align="left"><span class="maintitle">{L_PAGE_NAME}</span></td>
	</tr>
  </table>

<br />
<table width="100%">
<tr>
	<td align="left" class="nav"><a href="{S_ACTION_ADD}" class="nav">{L_NEW_SITE}</a></td>
	<td align="right" class="nav"><a href="javascript:tour()" class="nav">{L_PREVIEW}</a></td>
</tr>
</table>
<br />

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
  <th height="25" class="thTop">{L_SUBJECT}</th>
  <th class="thTop">{L_ACCESS}</th>
  <th class="thTop">&nbsp;</th>
  <th class="thTop">&nbsp;</th>
</tr>
<!-- BEGIN forum_tour_pages -->
<tr>
  <td class="{forum_tour_pages.ROW_CLASS}" align="left" width="60%" valign="middle"><span class="gen">{forum_tour_pages.SUBJECT}</span></td>
  <td class="{forum_tour_pages.ROW_CLASS}" align="center" valign="middle"><span class="gen">{forum_tour_pages.PAGE_ACCESS}</span></td>
  <td class="{forum_tour_pages.ROW_CLASS}" align="center"><a href="{forum_tour_pages.U_EDIT}" class="nav">{L_EDIT}</a><br /><a href="{forum_tour_pages.U_DELETE}" class="nav">{L_DELETE}</a></td>
  <td class="{forum_tour_pages.ROW_CLASS}" align="center"><a href="{forum_tour_pages.S_MOVE_UP}" class="mainmenu">{L_MOVE_UP}</a><br/><a href="{forum_tour_pages.S_MOVE_DOWN}" class="mainmenu">{L_MOVE_DOWN}</a></td>
</tr>
<!-- END forum_tour_pages -->
</table>