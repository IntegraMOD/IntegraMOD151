
<h1>{PAGE_TITLE}</h1>
<p>{PAGE_EXPLAIN}</p>

<form name="link_form" action="{PAGE_ACTION}" method="POST">
  <table cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
	  <th class="thHead" colspan="2">{L_LINK_BASIC_SETTING}</th>
	</tr>
	<tr>
	  <td class="row1" width="40%" nowrap="nowrap">{L_LINK_TITLE}</td>
	  <td class="row2"><input type="text" size="30" maxlength="20" name="link_title" value="{LINK_TITLE}"></td>
	</tr>
	<tr>
	  <td class="row1" nowrap="nowrap">{L_LINK_URL}</td>
	  <td class="row2"><input type="text" size="50" maxlength="100" name="link_url" value="{LINK_URL}"></td>
	</tr>
	<tr>
	  <td class="row1">{L_LINK_LOGO_SRC}</td>
	  <td class="row2"><input type="text" size="50" maxlength="120" name="link_logo_src" value="{LINK_LOGO_SRC}">&nbsp;[<a href="javascript: void(0)" onclick="var img_src=document.link_form.link_logo_src.value;if(img_src=='') img_src='images/links/no_logo88a.gif';if(img_src.substr(0, 4) != 'http') img_src='../'+img_src;_preview=window.open(img_src, '_preview', 'toolbar=no,width=200,height=100,top=300,left=300');">{L_PREVIEW}</a>]</td>
	</tr>
	<tr> 
	  <td class="row1" nowrap="nowrap">{L_LINK_CATEGORY}</td>
	  <td class="row2"><select name="link_category"><option value="" selected>----------------</option>{LINK_CAT_OPTION}</select></td>
	</tr>
	<tr>
	  <td class="row1" nowrap="nowrap" valign="top">{L_LINK_DESC}</td>
	  <td class="row2" valign="top"><textarea name="link_desc" cols="30" rows="5" class="post" maxsize="120" wrap="VIRTUAL">{LINK_DESC}</textarea>{LINK_LOGO_IMG}</td>		
	</tr>
	<tr>
	  <th class="thHead" colspan="2">{L_LINK_ADV_SETTING}</th>
	</tr>
	<tr> 
	  <td class="row1" nowrap="nowrap">{L_LINK_ACTIVE}</td>
	  <td class="row2"><input type="radio" name="link_active" value="1" {LINK_ACTIVE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="link_active" value="0" {LINK_ACTIVE_NO} /> {L_NO}</td>
	</tr>
	<tr>
	  <td class="cat" colspan="2" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" /></td>
	</tr>
  </table>
</form>
<div align="center"><span class="copyright">Links MOD v1.2.1 by <a href="http://www.phpbb2.de" target="_blank">phpBB2.de</a> and OOHOO</span></div>
<br clear="all" />




