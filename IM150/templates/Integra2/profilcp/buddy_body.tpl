<script language="JavaScript" type="text/javascript">
<!--
	function ref(object)
	{
		if (document.getElementById)
		{
			return document.getElementById(object);
		}
		else if (document.all)
		{
			return eval('document.all.' + object);
		}
		else
		{
			return false;
		}
	}

	function expand(object)
	{
		var object = ref(object);
	
		if( !object.style )
		{
			return false;
		}
		else
		{
			object.style.display = '';
		}

		if (window.event)
		{
			window.event.cancelBubble = true;
		}
	}

	function contract(object)
	{
		var object = ref(object);
	
		if( !object.style )
		{
			return false;
		}
		else
		{
			object.style.display = 'none';
		}

		if (window.event)
		{
			window.event.cancelBubble = true;
		}
	}

	function toggle(object, open_close)
	{
		object = ref(object);
		icone = ref(open_close);

		if( !object.style )
		{
			return false;
		}

		if( object.style.display == 'none' )
		{
			object.style.display = '';
			icone.src = "{UP_ARROW}";
		}
		else
		{
			object.style.display = 'none';
			icone.src = "{DOWN_ARROW}";
		}
	}
	//
	// checkbox selection management
	function check_uncheck_main()
	{
		var all_checked = true;
		for (i = 0; (i < document.post.elements.length) && all_checked; i++)
		{
			if (document.post.elements[i].name == 'user_ids[]')
			{
				all_checked =  document.post.elements[i].checked;
			}
		}
		document.post.all_mark.checked = all_checked;
	}

	function check_uncheck_all()
	{
		for (i = 0; i < document.post.length; i++)
		{
			if (document.post.elements[i].name == 'user_ids[]')
			{
				document.post.elements[i].checked = document.post.all_mark.checked;
			}
		}
	}
//-->
</script>

<table cellpadding="0" cellspacing="10" border="0" width="100%">
<form name="post" action="{S_PROFILCP_ACTION}" method="post">
<tr>
	<td valign="top" align="center" colspan="2">
		<table cellpadding="4" cellspacing="1" border="0" class="forumline" width="100%">
		<tr>
			<th width="100%" colspan="{COLSPAN}"><a href="#" onClick="toggle('fields_display','open_close'); return false;"><img src="{DOWN_ARROW}" id="open_close" border="0"></a>&nbsp;&nbsp;{L_USER_FIELDS}</th>
		</tr>
		<tbody id="fields_display" style="display:none">
		<!-- BEGIN userfields_row -->
		<tr>
			<!-- BEGIN userfields_cell -->
			<td class="{userfields_row.userfields_cell.CLASS}" nowrap="nowrap">
				<span class="genmed">
					<input type="checkbox" name="field_ids[]" value="{userfields_row.userfields_cell.FIELD_ID}" {userfields_row.userfields_cell.CHECKED} />
					&nbsp;{userfields_row.userfields_cell.FIELDS}
				</span>
			</td>
			<!-- END userfields_cell -->
			<!-- BEGIN userfields_cell_empty -->
			<td class="{userfields_row.userfields_cell_empty.CLASS}" nowrap="nowrap"><span class="gen">&nbsp;</span></td>
			<!-- END userfields_cell_empty -->
		</tr>
		<!-- END userfields_row -->
		<tr> 
			<td class="cat" colspan="{COLSPAN}" align="center">
				{S_HIDDEN_FIELDS} 
				<input type="submit" name="fields_choosen" value="{L_SUBMIT}" class="mainoption" />
			</td>
		</tr>
		</tbody>
		</table>
	</td>
</tr>
<tr>
	<td align="left" valign="bottom" nowrap="nowrap">
		<span class="gen">
			{L_FILTER_FIELDS}:<br />
			{S_FILTER_FIELDS}&nbsp;
			{S_COMP}&nbsp; 
			<input type="text" class="gen" name="fvalue" size="20" maxlength="255" value="{FILTER}" />&nbsp;
			<input type="submit" name="filter_active" value="{L_GO}" class="liteoption" />
		</span>
	</td>
	<td align="right" valign="bottom" nowrap="nowrap"><span class="nav"><b>{PAGINATION}</b></span></td>
</tr>
<tr>
	<td valign="top" align="center" colspan="2">
		<table cellpadding="4" cellspacing="1" border="0" class="forumline" width="100%">
		<tr>
			<th width="1%" align="center">&nbsp;#&nbsp;</th>
			<!-- BEGIN header_list -->
			<th nowrap="nowrap">&nbsp;{header_list.L_FIELD}&nbsp;{header_list.ICON_SORT}</th>
			<!-- END header_list -->
			<!-- BEGIN select -->
			<th nowrap="nowrap">&nbsp;<input type="checkbox" name="all_mark" value="{L_SELECT}" onClick="check_uncheck_all();">&nbsp;</th>
			<!-- END select -->
		</tr>
		<!-- BEGIN userrow -->
		<tr>
			<td width="1%" align="center" class="{userrow.CLASS}"><span class="genmed">{userrow.NUMBER}</span></td>
			<!-- BEGIN user_list -->
			<td class="{userrow.CLASS}" align="center"><span class="genmed">{userrow.user_list.FIELD}</span></td>
			<!-- END user_list -->
			<!-- BEGIN select -->
			<td class="{userrow.CLASS}" align="center"><input type="checkbox" name="user_ids[]" value="{userrow.select.USER_ID}" {userrow.select.CHECKED}  onClick="check_uncheck_main();" /></td>
			<!-- END select -->
		</tr>
		<!-- END userrow -->
		<!-- BEGIN select -->
		<tr>
			<td class="cat" colspan="{ROW_SPAN}" align="left" valign="top" nowrap="nowrap">
				<span class="genmed">
					<input type="text" class="post" name="username" maxlength="50" size="20" />&nbsp;
					<input type="submit" name="adduser" value="{L_ADD_MEMBER}" class="mainoption" />&nbsp;
					<input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="liteoption" onClick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" />
					<input type="submit" name="remove" class="liteoption" value="{L_REMOVE_SELECTED}">
				</span>
			</td>
		</tr>
		<!-- END select -->
		</table>
	</td>
</tr>
<tr>
	<td align="right" valign="bottom" nowrap="nowrap" colspan="2"><span class="nav"><b>{PAGINATION}</b></span></td>
</tr>
</form>
</table>