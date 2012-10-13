<div class="maintitle">{L_RANKS_TITLE}</div>
<br />
<div class="genmed">{L_RANKS_TEXT}</div>
<br />
<form method="post" action="{S_RANKS_ACTION}">
<table cellspacing="1" cellpadding="3" border="0" align="center" class="forumline">
<tr> 
<th>&nbsp;{L_RANK}&nbsp;</th>
<th>&nbsp;{L_RANK_MINIMUM}&nbsp;</th>
<th>&nbsp;{L_SPECIAL_RANK}&nbsp;</th>
<th>&nbsp;{L_EDIT}&nbsp;</th>
<th>&nbsp;{L_DELETE}&nbsp;</th>
</tr>
<!-- BEGIN ranks -->
<tr> 
<td align="center" nowrap="nowrap" class="{ranks.ROW_CLASS}">{ranks.RANK}</td>
<td class="{ranks.ROW_CLASS}" align="center">{ranks.RANK_MIN}</td>
<td class="{ranks.ROW_CLASS}" align="center">{ranks.SPECIAL_RANK}</td>
<td class="{ranks.ROW_CLASS}" align="center"><a href="{ranks.U_RANK_EDIT}">{L_EDIT}</a></td>
<td class="{ranks.ROW_CLASS}" align="center"><a href="{ranks.U_RANK_DELETE}">{L_DELETE}</a></td>
</tr>
<!-- END ranks -->
<tr> 
<td class="cat" align="center" colspan="5"> 
<input type="submit" class="mainoption" name="add" value="{L_ADD_RANK}" />
</td>
</tr>
</table>
</form>
<br />
