<form action="{S_SEARCH_ACTION}" method="post">
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
	<td class="maintitle">{L_SEARCH}</td>
</tr>
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_SEPARATOR}{L_SEARCH}</td>
</tr>
</table>
<table class="forumline" width="100%" cellpadding="3" cellspacing="1" border="0">
<tr>
<th colspan="4">{L_SEARCH_QUERY}</th>
</tr>
<tr>
<td class="row1" colspan="2" width="50%" valign="top"><span class="explaintitle">{L_SEARCH_KEYWORDS}:</span><br />
<span class="gensmall">{L_SEARCH_KEYWORDS_EXPLAIN}</span></td>
<td class="row2" colspan="2"> <input type="text" style="width: 300px" class="post" name="search_keywords" size="30" />
<br />
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><input type="radio" name="search_terms" value="any" checked="checked" /></td>
<td nowrap="nowrap" class="genmed">&nbsp;{L_SEARCH_ANY_TERMS}</td>
</tr>
<tr>
<td><input type="radio" name="search_terms" value="all" /></td>
<td nowrap="nowrap" class="genmed">&nbsp;{L_SEARCH_ALL_TERMS}</td> 
</tr>
</table>
<span class="genmed">{L_ONLY_BLUECARDS}</span></td>
</tr>
<tr>
<td class="row1" colspan="2"><span class="explaintitle">{L_SEARCH_AUTHOR}:</span><br />
<span class="gensmall">{L_SEARCH_AUTHOR_EXPLAIN}</span></td>
<td class="row2" colspan="2">
<input type="text" style="width: 300px" class="post" name="search_author" size="30" />
</td>
</tr>
<tr>
<th colspan="4">{L_SEARCH_OPTIONS}</th>
</tr>
<tr>
<td class="row1" align="right"><span class="explaintitle">{L_FORUM}:</span></td>
<td class="row2">
<select class="post" name="search_where">{S_FORUM_OPTIONS}</select>
</td>
<td class="row1" align="right" nowrap="nowrap"><span class="explaintitle">{L_SEARCH_PREVIOUS}:</span></td>
<td class="row2">
<select class="post" name="search_time">{S_TIME_OPTIONS}</select>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><input type="radio" name="search_fields" value="all" checked="checked" /></td>
<td nowrap="nowrap" class="genmed">&nbsp;{L_SEARCH_MESSAGE_TITLE}</td>
</tr>
<tr>
<td><input type="radio" name="search_fields" value="msgonly" /></td>
<td nowrap="nowrap" class="genmed">&nbsp;{L_SEARCH_MESSAGE_ONLY}</td>
</tr>
</table>
</td>
</tr>
<tr>

<td class="row1" align="right" nowrap="nowrap"><span class="explaintitle">{L_DISPLAY_RESULTS}:</span></td>
<td class="row2">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><input type="radio" name="show_results" value="posts" /></td>
<td class="genmed" nowrap="nowrap">&nbsp;{L_POSTS}&nbsp;&nbsp;</td>
<td><input type="radio" name="show_results" value="topics" checked="checked" /></td>
<td class="genmed" nowrap="nowrap">&nbsp;{L_TOPICS}</td>
</tr>
</table>
</td>

<td class="row1" align="right"><span class="explaintitle">{L_SORT_BY}:</span></td>
<td class="row2">
<select class="post" name="sort_by">{S_SORT_OPTIONS}</select>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><input type="radio" name="sort_dir" value="ASC" /></td>
<td nowrap="nowrap" class="genmed">&nbsp;{L_SORT_ASCENDING}</td>
</tr>
<tr>
<td><input type="radio" name="sort_dir" value="DESC" checked="checked" /></td>
<td nowrap="nowrap" class="genmed">&nbsp;{L_SORT_DESCENDING}</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="row1">&nbsp;</td>
<td class="row2">&nbsp;</td>
<td class="row1" align="right"><span class="explaintitle">{L_RETURN_FIRST}:</span></td>
<td class="row2">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><select class="post" name="return_chars">{S_CHARACTER_OPTIONS}</select></td>
<td class="genmed" nowrap="nowrap">&nbsp;{L_CHARACTERS}</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="cat" colspan="4" align="center">{S_HIDDEN_FIELDS}<input class="button" type="submit" value="{L_SEARCH}" />
</td>
</tr>
</table>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_SEPARATOR}{L_SEARCH}</td>
</tr>
</table>
</form>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
	<td><br />{JUMPBOX}</td>
	</tr>
</table>