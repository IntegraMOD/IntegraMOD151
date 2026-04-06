<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
	<td class="maintitle">{PAGE_TITLE}</td>
</tr>
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_SEPARATOR}{PAGE_TITLE}</td>
</tr>
</table>
<form method="get" name="ratings_form" action="{U_RATINGS}">
<table border="0">
<tr><td class="gen">{L_SCREEN_TYPE}</td><td class="gen">{L_FORUM}</td><td class="gen">{L_INCLUDE_BY}</td><td>&nbsp;</td></tr>
<tr><td class="gen"><select name="type">
<!-- BEGIN screen_type --> 
<option value="{screen_type.VALUE}"{screen_type.SELECTED}>{screen_type.TITLE}</option>
<!-- END screen_type --> 
</select></td><td><select name="forum_id">
<!-- BEGIN forums --> 
<option value="{forums.ID}"{forums.SELECTED}>{forums.TITLE}</option>
<!-- END forums --> 
</select></td><td><select name="ratingsby">
<!-- BEGIN ratingsby --> 
<option value="{ratingsby.ID}"{ratingsby.SELECTED}>{ratingsby.TITLE}</option>
<!-- END ratingsby --> 
</select></td><td><input type="submit" value="Go" class="liteoption" name="submit" /></td></tr>
</table>
</form>

<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline"> 
<tr> 
<th align="center" class="thCornerL">&nbsp;{L_COLUMN1}&nbsp;</th> 
<th align="center" class="thTop">&nbsp;{L_TOPIC}&nbsp;</th> 
<th align="center" class="thTop">&nbsp;&nbsp;{L_COLUMN3}&nbsp;&nbsp;</th> 
<th align="center" class="thTop">&nbsp;{L_COLUMN4}&nbsp;</th> 
<th align="center" class="thCornerR">&nbsp;{L_COLUMN5}&nbsp;</th> 
</tr> 
<!-- BEGIN rating --> 
<tr> 
<td class="row1" align="center" valign="middle"><span class="name">{rating.COLUMN1}</span></td> 
<td class="row2" valign="middle"><span class="topictitle"><a class="nav" href="{rating.COLUMN2}">{rating.TOPIC_TITLE}</a></span></td> 
<td class="row1" align="center" valign="middle"><span class="name">{rating.COLUMN3}</span></td>
<td class="row2" align="center" valign="middle"><span class="postdetails">{rating.COLUMN4}</span></td> 
<td class="row1" align="center" valign="middle" nowrap="nowrap"><span class="postdetails">{rating.COLUMN5}</span></td> 
</tr> 
<!-- END rating --> 
<!-- BEGIN norating --> 
<tr> 
<td class="row1" colspan="5" height="30" align="center" valign="middle"><span class="gen">{L_NO_RATINGS}</span></td> 
</tr> 
<!-- END norating --> 
</table>