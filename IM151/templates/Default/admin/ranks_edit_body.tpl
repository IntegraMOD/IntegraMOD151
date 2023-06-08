<script> 
<!-- 
function update_rank(newimage) 
{
   if(newimage != '../')
   {
	document.rank_image.src = newimage; 
   }
   else
   {
	document.rank_image.src = '../images/spacer.gif';
   }
} 
//--> 
</script>
<div class="maintitle">{L_RANKS_TITLE}</div>
<br />
<div class="genmed">{L_RANKS_TEXT}</div>
<br />
<form action="{S_RANK_ACTION}" method="post">
<table class="forumline" cellpadding="3" cellspacing="1" border="0" align="center">
<tr> 
<th colspan="2">{L_RANKS_TITLE}</th>
</tr>
<tr> 
<td class="row1" width="38%">{L_RANK_TITLE}:</td>
<td class="row2" width="62%"> 
<table cellpadding="2" cellspacing="1" border="0" width="100%">
			<tr>
				<td align="right" nowrap="nowrap"><span class="gen"><b>{L_RANK_DEFAULT}:</b></td>
				<td width="100%"><input class="post" type="text" name="title_default" size="35" maxlength="85" value="{RANK_DEFAULT}" /></span></td>
			</tr>
			<tr>
				<td align="right" nowrap="nowrap"><span class="gen"><b>{L_RANK_MALE}:</b></td>
				<td width="100%"><input class="post" type="text" name="title_male" size="35" maxlength="85" value="{RANK_MALE}" /></span></td>
			</tr>
			<tr>
				<td align="right" nowrap="nowrap"><span class="gen"><b>{L_RANK_FEMALE}:</b></td>
				<td width="100%"><input class="post" type="text" name="title_female" size="35" maxlength="85" value="{RANK_FEMALE}" /></span></td>
			</tr>
			</table>
</td>
</tr>
<tr> 
<td class="row1">{L_RANK_SPECIAL}</td>
<td class="row2"> 
<input type="radio" name="special_rank" value="1" {SPECIAL_RANK} />
{L_YES} &nbsp;&nbsp; 
<input type="radio" name="special_rank" value="0" {NOT_SPECIAL_RANK} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_RANK_MINIMUM}:</td>
<td class="row2"> 
<input type="text" name="min_posts" size="5" maxlength="10" value="{MINIMUM}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_RANK_IMAGE}:<br />
<td class="row2"> 
<select name="rank_image" onchange="update_rank('../' + this.options[selectedIndex].value);">{RANK_LIST}</select> &nbsp; <img name="rank_image" src="{RANK_IMG}" border="0" alt="" /><br />
{IMAGE_DISPLAY}</td>
</tr>
<tr> 
<td class="cat" colspan="2" align="center"> 
<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
&nbsp;&nbsp; 
<input type="reset" value="{L_RESET}" class="button" />
</td>
</tr>
</table>
{S_HIDDEN_FIELDS}
</form>
<br />
