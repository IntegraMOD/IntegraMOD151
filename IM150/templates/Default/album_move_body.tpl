<form action="{S_ALBUM_ACTION}" method="post">
<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td class="nav" width="100%">
			<span class="nav">
				<a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEP}
				<a class="nav" href="{U_ALBUM}">{L_ALBUM}</a>
			</span>
		</td>
	</tr>
</table>
<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr><th height="25" class="thHead">{L_MOVE}</th></tr>
	<tr>
		<td class="row1" align="center">
			<br /><span class="gen">{L_MOVE_TO_CATEGORY}</span>&nbsp;{S_CATEGORY_SELECT}&nbsp;<input class="mainoption" type="submit" name="move" value="{L_MOVE}" /><br />
		</td>
	</tr>
</table>
<!-- BEGIN pic_id_array -->
<input type="hidden" name="pic_id[]" value="{pic_id_array.VALUE}" />
<!-- END pic_id_array -->
</form>
<br />
<!-- You must keep my copyright notice visible with its original content -->
{ALBUM_COPYRIGHT}
