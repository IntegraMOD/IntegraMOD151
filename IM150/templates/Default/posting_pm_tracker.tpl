
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr> 
		<td class="catHead" height="28" align="center"><b><span class="cattitle">{L_PM_TRACKER}</span></b></td>
	</tr>
	<tr>
		<td class="row1"><div style="height: 300px; width: 100%; overflow: auto">
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thCornerL" width="22%" height="26">{L_FROM}</th>
		<th class="thCornerR">{L_PRIVATE_MESSAGE}</th>
	</tr>
	<!-- BEGIN postrow -->
	<tr>
		<td width="22%" align="left" valign="top" class="{postrow.ROW_CLASS}">
		<span class="name"><b>{postrow.POSTER_NAME}</b><br /><br /></span>{postrow.AVATAR_IMG}<br /><br /></td>
		<!-- IF postrow.IS_CURRENT -->
		<td class="{postrow.ROW_CLASS}">
			{L_PM_CURRENTLY_VIEWING}
		</td>
		<!-- ELSE -->
		<td class="{postrow.ROW_CLASS}" height="28" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr> 
				<td width="100%"><img src="{MINI_POST_IMG}" width="12" height="9" alt="{L_MINI_POST_ALT}" title="{L_MINI_POST_ALT}" border="0" /><span class="postdetails">{L_SENT}: {postrow.PM_DATE}&nbsp;&nbsp;&nbsp;{L_TO}: <b>{postrow.ADDRESSEE_NAME}</b>&nbsp;&nbsp;&nbsp;{L_SUBJECT}: {postrow.PM_SUBJECT}&nbsp;&nbsp;&nbsp;{L_FOLDER}: <b>{postrow.BOX_NAME}</b></span></td>
			</tr>
			<tr> 
				<td colspan="2"><hr /></td>
			</tr>
			<tr>
				<td colspan="2"><span class="postbody">{postrow.MESSAGE}</span></td>
			</tr>

			<tr> 
				<td colspan="2"><br /><span class="genmed">&nbsp;{postrow.PRIVMSGS_LINK}</span></td>
			</tr>

		</table>
		<!-- ENDIF -->
		</td>
	</tr>
	<tr> 
		<td colspan="2" height="1" class="spaceRow"><img src="images/spacer.gif" alt="" width="1" height="1" /></td>
	</tr>
	 <!-- END postrow -->
</table>
		</div></td>
	</tr>
</table>
