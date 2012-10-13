<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">

<h1>{L_KB_TYPE_TITLE}</h1>

<p>{L_KB_TYPE_DESCRIPTION}</p>

<table width="100%" cellpadding="4" cellspacing="1" border="0">
	<tr>
<form action="{S_ACTION}" method="POST">
	  <td align="{S_CONTENT_DIR_RIGHT}" width="100%">{L_CREATE_TYPE} &nbsp; <input class="post" type="text" name="new_type_name"> &nbsp; <input type="submit" value="{L_CREATE}" class="liteoption"></td>
</form>
	</tr>
</table>
<table  width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
	<tr>
	  <th class="thCornerL" nowrap="nowrap">{L_TYPE}</th>
	  <th class="thCornerR" nowrap="nowrap">{L_ACTION}</th>	  
	</tr>
	<!-- BEGIN typerow -->
	<tr> 	
	  <td class="{typerow.ROW_CLASS}"><span class="gen">{typerow.TYPE}</span></td>
	  <td width="15%" nowrap="nowrap" class="{typerow.ROW_CLASS}" align="center">{typerow.U_EDIT} {typerow.U_DELETE}</td>
	</tr>
	<!-- END typerow -->
	<tr>
	  <td colspan="2" class="catBottom">&nbsp;</td>
	</tr>
</table>
<br clear="all" />