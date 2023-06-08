<!-- BEGIN blocks -->
	<!-- IF blocks.NONE -->
		{L_IMPORTAL_LAYOUT_NO_BLOCKS}
	<!-- ELSE -->
		<table class="forumline" width="100%">
			<tr>
				<td class="row2">{blocks.TITLE} [ {blocks.CONTENT} : {blocks.TYPE} ]</td>
			</tr>
			<tr>
				<td class="row1">
					<a href="{blocks.U_MOVE_UP}"><img src="{TEMPLATE}images/p_up.png" alt="{L_MOVE_UP}" title="{L_MOVE_UP}" width="30" height="30" /></a>
					<a href="{blocks.U_MOVE_DOWN}"><img src="{TEMPLATE}images/p_down.png" alt="{L_MOVE_DOWN}" title="{L_MOVE_DOWN}" width="30" height="30" /></a>
					<a href="{blocks.U_EDIT}"><img src="{TEMPLATE}images/p_edit.png" alt="{L_EDIT} {L_BLOCK}" title="{L_EDIT}" width="30" height="30" /></a>
					<a href="{blocks.U_DELETE}"><img src="{TEMPLATE}images/p_delete.png" alt="{L_DELETE}" title="{L_DELETE}" width="30" height="30" /></a>
				</td>
			</tr>
		</table>
	<!-- ENDIF -->
<!-- END blocks -->