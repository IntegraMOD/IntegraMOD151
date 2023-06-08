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
<div align="center"><span class="copyright"><br />
Powered by paFileDB 3.1 ©2002 <a href="http://www.phparena.net/" target="_phpbb" class="copyright">PHP Arena</a><br />
This script (pafiledb integration v 0.0.9d + <a href="http://www.mx-system.com/" target="_phpbb" class="copyright">MX Addon 1.0</a> + IntegraMOD integration) is modified by  <a href="http://www.hostsector.com/~mohd/" target="_phpbb" class="copyright">Mohd</a><br />
</span></div>
    </td>
    <td background="templates/PowerMetal/images/right.gif"><img name="right" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
   <td><img name="blc" src="templates/PowerMetal/images/blc.gif" width="8" height="8" border="0" alt=""></td>
    <td background="templates/PowerMetal/images/btm.gif"><img name="btm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="brc" src="templates/PowerMetal/images/brc.gif" width="8" height="8" border="0" alt=""></td>
  </tr></table>