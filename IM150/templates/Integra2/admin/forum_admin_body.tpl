<div class="maintitle">{L_FORUM_TITLE}</div>
<br />
<form method="post" action="{S_FORUM_ACTION}">
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr> 
<th colspan="7">{L_FORUM_TITLE}</th>
</tr>
<!-- BEGIN catrow -->
<tr> 
<td class="cat" ><a href="{catrow.U_VIEWCAT}">{catrow.CAT_DESC}</a></td>
<td class="cat" align="center">&nbsp;</td>
</tr>
<!-- BEGIN forumrow -->
<tr> 
<td class="row2"><a href="{catrow.forumrow.U_VIEWFORUM}" target="_new">{catrow.forumrow.FORUM_NAME}</a><br />
<span class="gensmall">{catrow.forumrow.FORUM_DESC}</span></td>
<td class="row1" align="center"><a href="{catrow.forumrow.U_FORUM_EDIT}">{L_EDIT}</a></td>
</tr>
<!-- END forumrow -->
<tr> 
<td colspan="7" height="1" class="spacerow"><img src="../images/spacer.gif" alt="" width="1" height="1" /></td>
</tr>
<!-- END catrow -->
</table>
</form>
