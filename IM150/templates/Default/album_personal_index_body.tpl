<table width="98%" align="center" cellspacing="1" cellpadding="2" border="0">
	<tr>
		<td class="nav">
			<span class="nav">
				<a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_SEP}
				<a class="nav" href="{U_ALBUM}">{L_ALBUM}</a>
			</span>
		</td>
		<td align="right" nowrap="nowrap">
			<span class="gensmall">
				<form name="search" action="{U_ALBUM_SEARCH}">
					{L_SEARCH}:&nbsp;
					<select name="mode">
						<option value="user">{L_USERNAME}</option>
						<option value="name">{L_PIC_NAME}</option>
						<option value="desc">{L_DESCRIPTION}</option>
					</select>
					{L_SEARCH_CONTENTS}
					<input type="text" name="search" maxlength="20">
					&nbsp;&nbsp;
					<input class="liteoption" type="submit" value="{L_GO}">
				</form>
			</span>
		</td>
	</tr>
</table>

{ALBUM_BOARD_INDEX}

<table class="forumline" width="98%" align="center" cellspacing="1" cellpadding="2">
	<tr>
		<th width="100%" height="25" nowrap="nowrap" class="thCornerL">&nbsp;{L_USERS_PERSONAL_GALLERIES}&nbsp;</th>
		<th class="thTop" nowrap="nowrap">&nbsp;{L_JOINED}&nbsp;</th>
		<th class="thCornerR" nowrap="nowrap">&nbsp;{L_PICS}&nbsp;</th>
	</tr>
	<!-- BEGIN memberrow -->
	<tr>
		<td height="28" class="{memberrow.ROW_CLASS}">&nbsp;<span class="gen"><a href="{memberrow.U_VIEWGALLERY}" class="gen">{memberrow.USERNAME}</a></span></td>
		<td class="{memberrow.ROW_CLASS}" align="center" nowrap="nowrap"><span class="gensmall">&nbsp;{memberrow.JOINED}&nbsp;</span></td>
		<td class="{memberrow.ROW_CLASS}" align="center"><span class="gensmall">{memberrow.PICS}</span></td>
	</tr>
	<!-- END memberrow -->
	<tr>
		<td class="catBottom" colspan="3" align="center"h>
		<form method="post" action="{S_MODE_ACTION}">
			<span class="gensmall">
				{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{L_ORDER}:&nbsp;{S_ORDER_SELECT}&nbsp;&nbsp;
				<input type="submit" name="submit" value="{L_SORT}" class="liteoption" />
			</span>
		</form>
		</td>
	</tr>
</table>

<table width="98%" align="center" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td><span class="nav">{PAGE_NUMBER}</span></td>
		<td align="right"><span class="gensmall">{S_TIMEZONE}</span><br /><span class="nav">{PAGINATION}</span></td>
	</tr>
</table>
<br />
<!-- You must keep my copyright notice visible with its original content -->
{ALBUM_COPYRIGHT}
