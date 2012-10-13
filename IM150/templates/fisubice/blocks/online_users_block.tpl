<table border="0" cellpadding="0" cellspacing="1" width="100%">
	<tr> 
		<td>
			<p class="gensmall">{B_TOTAL_USERS_ONLINE}<br />
				<br />
				{B_LOGGED_IN_USER_LIST}<br /><br />
			</p>
			<p class="gensmall" align="center">[ <a href="{B_U_VIEWONLINE}">{B_L_VIEW}</a> ]</p>
			<p class="gensmall">{TOTAL_CHATTERS_ONLINE}:<br />
				{CHATTERS_LIST}
			</p>
			<p class="gensmall" align="center">[ {L_CHAT_LINK} ]
<!-- BEGIN switch_prillian_installed -->
<br />
[ <a href="{U_IM_LAUNCH}" target="prillian" onClick="javascript:prill_launch('{U_IM_LAUNCH}', '{IM_WIDTH}', '{IM_HEIGHT}'); return false" class="mainmenu">{L_IM_LAUNCH}</a> ]
<br/>
[ <a href="{U_CONTACT_MAN}" class="mainmenu">{L_CONTACT_MAN}</a> ]
<!-- END switch_prillian_installed -->
			
			
			</p>
			<p class="gensmall">{B_RECORD_USERS}</p>
		</td>
	</tr>
</table>