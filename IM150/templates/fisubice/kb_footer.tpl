
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
Powered by Knowledge Base MOD by {L_MODULE_ORIG_AUTHOR} & {L_MODULE_AUTHOR} &copy; 2002-2005
</span></div>
<!-- END copy_footer -->
