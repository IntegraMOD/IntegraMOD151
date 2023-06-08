
	<tr>
	  <td>
	  	<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td align="left" valign="top">	  
					  <!-- BEGIN quick_nav -->
					  	<form method="get" name="jumpbox" action="{QUICK_JUMP_ACTION}" onSubmit="if(document.jumpbox.cat.value == -1){return false;}">
					    	<table cellspacing="0" cellpadding="0" border="0">
								<tr>
									<td nowrap="nowrap"><span class="gensmall">{L_QUICK_NAV}&nbsp;	
					  					<select name="cat" onchange="if(this.options[this.selectedIndex].value != 0){ forms['jumpbox'].submit() }">
					    					<option value="0">{L_QUICK_JUMP}</otpion>
											{QUICK_NAV}
										</select>
										{S_HIDDEN_VARS}
										<input type="submit" value="{L_QUICK_JUMP}" class="liteoption" /></span>
									</td>
									</tr>
							</table>
						</form>
						<!-- END quick_nav -->
				</td>
				<td align="right">
					  <!-- BEGIN auth_can -->
					  <span class="gensmall">{S_AUTH_LIST}</span>
					  <!-- END auth_can -->
				</td>				
			</tr>
		</table>
	 </td>
	</tr>
	
	
	
</table>	

<!-- BEGIN copy_footer -->
<div align="center"><span class="copyright"><br />
Powered by Knowledge Base MOD, {L_MODULE_ORIG_AUTHOR} & <a href="http://www.mx-system.com/" target="_phpbb" class="copyright">{L_MODULE_AUTHOR}</a> © 2002-2005 <br /><a href="http://www.phpbb.com/phpBB/viewtopic.php?t=200195" target="_phpbb" class="copyright">PHPBB.com MOD</a>
</span></div>
<!-- END copy_footer -->

    </td>
    <td background="templates/PowerMetal/images/right.gif"><img name="right" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
   <td><img name="blc" src="templates/PowerMetal/images/blc.gif" width="8" height="8" border="0" alt=""></td>
    <td background="templates/PowerMetal/images/btm.gif"><img name="btm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="brc" src="templates/PowerMetal/images/brc.gif" width="8" height="8" border="0" alt=""></td>
  </tr></table>