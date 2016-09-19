<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">

<h1>{L_KB_CAT_TITLE}</h1>

<p>{L_KB_CAT_DESCRIPTION}</p>

<table  width="100%" cellpadding="2" cellspacing="2" border="0">
	<tr>
<form action="{S_ACTION}" method="POST">
	  <td align="{S_CONTENT_DIR_RIGHT}" width="100%">{L_CREATE_CAT} &nbsp; <input type="text" name="new_cat_name"> &nbsp; <input type="submit" value="{L_CREATE}" class="liteoption"></td>
</form>
	</tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
	<tr>
	  <th class="thCornerL" nowrap="nowrap">{L_CATEGORY}</th>
	  <th class="thTop" nowrap="nowrap">{L_ARTICLES}</th>
	  <th class="thTop" nowrap="nowrap">{L_ORDER}</th>
	  <th class="thCornerR" nowrap="nowrap">{L_ACTION}</th>	  
	</tr>
	<!-- BEGIN catrow -->
	<tr> 	
	  <td class="{catrow.ROW_CLASS}"><span class="gen">{catrow.CATEGORY}<br />{catrow.CAT_DESCRIPTION}</span></td>
	  <td class="{catrow.ROW_CLASS}" align="center"><span class="gen">{catrow.CAT_ARTICLES}</span></td>
	  <td class="{catrow.ROW_CLASS}" align="center"><span class="gen">{catrow.U_UP}<br />{catrow.U_DOWN}</span></td>
	  <td class="{catrow.ROW_CLASS}" align="center">{catrow.U_EDIT} {catrow.U_DELETE}</td>
	</tr>
	<!-- BEGIN subrow -->
	<tr> 	
	  <td class="{catrow.subrow.ROW_CLASS}"><span class="gen">{catrow.subrow.INDENT}{catrow.subrow.CATEGORY}<br />&nbsp;&nbsp;&nbsp;&nbsp;{catrow.subrow.CAT_DESCRIPTION}</span></td>
	  <td class="{catrow.subrow.ROW_CLASS}" align="center"><span class="gen">{catrow.subrow.CAT_ARTICLES}</span></td>
	  <td class="{catrow.subrow.ROW_CLASS}" align="center"><span class="gen">{catrow.subrow.U_UP}<br />{catrow.subrow.U_DOWN}</span></td>
	  <td class="{catrow.subrow.ROW_CLASS}" align="center">{catrow.subrow.U_EDIT} {catrow.subrow.U_DELETE}</td>
	</tr>
	<!-- END subrow -->
	<!-- END catrow -->
</table>
<br clear="all" />