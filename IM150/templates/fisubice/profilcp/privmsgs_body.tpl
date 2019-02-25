<script language="Javascript" type="text/javascript">
	//
	// Should really check the browser to stop this whining ...
	//
	//
	// checkbox selection management
	function check_uncheck_main()
	{
		var all_checked = true;
		for (i = 0; (i < document.privmsg_list.elements.length) && all_checked; i++)
		{
			if (document.privmsg_list.elements[i].name == 'mark[]2')
			{
				all_checked =  document.privmsg_list.elements[i].checked;
			}
		}
		document.privmsg_list.all_mark.checked = all_checked;
	}

	function check_uncheck_all()
	{
		for (i = 0; i < document.privmsg_list.length; i++)
		{
			if (document.privmsg_list.elements[i].name == 'mark[]2')
			{
				document.privmsg_list.elements[i].checked = document.privmsg_list.all_mark.checked;
			}
		}
	}
</script>


<table cellpadding="0" cellspacing="10" border="0" width="100%">
<form method="post" name="privmsg_list" action="{S_PRIVMSGS_ACTION}">
<tr><td valign="top" align="center">

	<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr> 
		<td width="20%" valign="middle" nowrap="nowrap">{POST_PM_IMG}</td>
		<!-- BEGIN switch_box_size_notice -->
		<td align="left" valign="middle">
			<table cellspacing="1" cellpadding="1" border="0" class="bodyline">
			<tr>
				<td class="row1" nowrap="nowrap" align="center">
					<table cellspacing="0" cellpadding="1" border="0">
					<tr>
						<td align="center"><span class="gensmall">{BOX_SIZE_STATUS}</span></td>
					</tr>
					<tr>
						<td align="center">
							<table width="175" cellspacing="0" cellpadding="0" border="1" class="bodyline">
							<tr>
								<td class="row2">
									<table cellspacing="0" cellpadding="1" border="1">
									<tr>
										<td class="bodyline"><img src="{IMG_SPACER}" width="{INBOX_LIMIT_IMG_WIDTH}" height="8" alt="{INBOX_LIMIT_PERCENT}" /></td>
									</tr>
									</table>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
		</td>
		<!-- END switch_box_size_notice -->
		<td align="right" nowrap="nowrap" width="100%">
			<span class="gensmall">
				{L_DISPLAY_MESSAGES}: <select name="msgdays">{S_SELECT_MSG_DAYS}</select>
				<input type="submit" value="{L_GO}" name="submit_msgdays" class="liteoption" />
			</span>
		</td>
	</tr>
	</table>

	<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr> 
	  <th width="5%" nowrap="nowrap">&nbsp;{L_FLAG}&nbsp;</th>
	  <th width="55%" nowrap="nowrap">&nbsp;{L_SUBJECT}&nbsp;</th>
	  <th width="20%" nowrap="nowrap">&nbsp;{L_FROM_OR_TO}&nbsp;</th>
	  <th width="15%" nowrap="nowrap">&nbsp;{L_DATE}&nbsp;</th>
	  <th width="5%" nowrap="nowrap">&nbsp;<input type="checkbox" name="all_mark" value="{L_SELECT}" onClick="check_uncheck_all();">&nbsp;</th>
	</tr>
	<!-- BEGIN listrow -->
	<tr> 
	  <td class="{listrow.ROW_CLASS}" width="5%" align="center" valign="middle"><img src="{listrow.PRIVMSG_FOLDER_IMG}" alt="{listrow.L_PRIVMSG_FOLDER_ALT}" title="{listrow.L_PRIVMSG_FOLDER_ALT}" /></td>
	  <td width="55%" valign="middle" class="{listrow.ROW_CLASS}">{listrow.PRIVMSG_ATTACHMENTS_IMG}<span class="topictitle">&nbsp;<a href="{listrow.U_READ}" class="topictitle">{listrow.SUBJECT}</a></span></td>
	  <td width="20%" valign="middle" align="center" class="{listrow.ROW_CLASS}"><span class="name">&nbsp;<a href="{listrow.U_FROM_USER_PROFILE}" class="{listrow.CLASS_NAME}">{listrow.FROM}</a></span></td>
	  <td width="15%" align="center" valign="middle" class="{listrow.ROW_CLASS}"><span class="postdetails">{listrow.DATE}</span></td>
	  <td width="5%" align="center" valign="middle" class="{listrow.ROW_CLASS}"><span class="postdetails"> 
		<input type="checkbox" name="mark[]2" value="{listrow.S_MARK_ID}" onClick="javascript:check_uncheck_main();" />
		</span></td>
	</tr>
	<!-- END listrow -->
	<!-- BEGIN switch_no_messages -->
	<tr> 
	  <td class="row1" colspan="5" align="center" valign="middle"><span class="gen">{L_NO_MESSAGES}</span></td>
	</tr>
	<!-- END switch_no_messages -->
	<tr> 
	  <td class="cat" colspan="5" align="right">{S_HIDDEN_FIELDS}
		<!-- BEGIN switch_save -->
		<input type="submit" name="save" value="{L_SAVE_MARKED}" class="mainoption" />
		&nbsp; 
		<!-- END switch_save -->
		<input type="submit" name="delete" value="{L_DELETE_MARKED}" class="liteoption" />
		&nbsp; 
		<input type="submit" name="deleteall" value="{L_DELETE_ALL}" class="liteoption" />
	  </td>
	</tr>
	</table>

	<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
	<tr> 
	  <td width="20%" valign="middle" nowrap="nowrap"><span class="nav">{POST_PM_IMG}</span></td>
	  <td align="left" valign="middle" width="100%"><span class="nav">{PAGE_NUMBER}</span></td>
	  <td align="right" valign="top" nowrap="nowrap"><span class="nav">{PAGINATION}<br /></span></td>
	</tr>
	</table>

</td></tr>
</form>
</table>
