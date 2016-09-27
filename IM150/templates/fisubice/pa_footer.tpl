	</td>
  </tr>
  <tr>
	<td align="left" valign="top">
	<form method="get" name="jumpbox" action="{S_JUMPBOX_ACTION}" onSubmit="if(document.jumpbox.cat_id.value == -1){return false;}">
	<input type="hidden" name="action" value="category" />
	<select name="cat_id" onchange="if(this.options[this.selectedIndex].value != -1){ forms['jumpbox'].submit() }">
	<option value="-1">{L_JUMP}</option>
	{JUMPMENU}
	</select>
	</form>
	
	</td>
	<td align="right" valign="top"><span class="gensmall">{S_TIMEZONE}</span></td>
  </tr>
</table>

	</td>
  </tr>
</table>
