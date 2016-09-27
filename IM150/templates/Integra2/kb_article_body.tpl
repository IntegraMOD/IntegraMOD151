<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr>
		<td align="left" class="nav">
		  <a href="{U_KB}" class="nav">{L_KB}</a> {PATH}
		</td>
		<td align="right" class="nav">
		  <a href="{U_PRINT}" class="nav">{L_PRINT}</a>
		</td>
	</tr>
</table>

<table width="100%" cellpadding="4" cellspacing="0" border="0" class="forumline">
<!--
  <tr>
  	  <th class="thHead" nowrap="nowrap">&nbsp;{ARTICLE_TITLE}&nbsp;</th>
  </tr>
-->
  <tr>
  	  <td class="row2"><hr>
  	  <span class="gensmall"><b>{L_ARTICLE_AUTHOR}</b></span> <span class="gen">{ARTICLE_AUTHOR}</span>
  	  <span class="gensmall"><b>{L_ARTICLE_DATE}</b></span> <span class="gen">{ARTICLE_DATE}</span>
  	  <span class="gensmall">{VIEWS}<br /></span>
	  <span class="gensmall"><b>{L_ARTICLE_DESCRIPTION}</b></span> <span class="gen">{ARTICLE_DESCRIPTION}<br /></span>
  	  <span class="gensmall"><b>{L_ARTICLE_CATEGORY}</b></span> <span class="gen">{ARTICLE_CATEGORY}</span>
  	  <span class="gensmall"><b>{L_ARTICLE_TYPE}</b></span> <span class="gen">{ARTICLE_TYPE}</span>

    <!-- BEGIN custom_field -->
	<span class="gensmall"><br /><b>{custom_field.CUSTOM_NAME}</b> </span> <span class="gen">{custom_field.DATA} </span>
	<!-- END custom_field --> 
	 	  <hr>
  <!-- BEGIN switch_comments -->
  	  <span class="gensmall">{COMMENTS} </span> <span class="gen">{COMMENTS_IMG}<br /></span>
  <!-- END switch_comments -->
  <!-- BEGIN switch_ratings -->
  	  <span class="gensmall">{RATINGS} </span> <span class="gen">{RATE_IMG}</span>
  <!-- END switch_ratings -->
  

  
		<hr></td>
  </tr>

  <tr> 
  	   <td class="row1" wrap="wrap">
	   <span class="maintitle"style="font-size: 9pt;">{ARTICLE_TITLE}</span>
  </tr>
  <!-- BEGIN switch_toc -->
  <tr>
       <td class="row1" align="left"><br /><span class="maintitle">{L_TOC}</span><br /><br />
	   <span class="nav">
	   <!-- BEGIN pages -->
	   {switch_toc.pages.TOC_ITEM}
	   <!-- END pages -->
	   </span></td>
  </tr>
<!-- END switch_toc -->
  <tr> 
  	   <td class="row1" wrap="wrap"><span class="postbody">{ARTICLE_TEXT}</span></td>
  </tr>
  <!-- BEGIN switch_pages -->
  <tr>
       <td class="row1" align="center"><span class="nav">{L_GOTO_PAGE} 
	   <!-- BEGIN pages -->
	   {switch_pages.pages.PAGE_LINK}
	   <!-- END pages -->
	   </span></td>
  </tr>
<!-- END switch_pages -->
  <tr>
  	  <td class="catBottom" valign="middle" align="center"><span class="cattitle">&nbsp;{EDIT_IMG}</span>&nbsp;</td>
  </tr>
</table>

  <!-- BEGIN switch_comments_show -->
<br />
	<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center" class="forumline">
 	 <tr>
  		  <th class="thTop">&nbsp;{L_COMMENTS}&nbsp;</th>
 	 </tr>
  <!-- END switch_comments_show -->
	<!-- BEGIN postrow -->
	<tr> 
		<td class="row1" width="100%" height="28" valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100%"><span class="genmed"><b>{postrow.POSTER_NAME}</b></span><span class="postdetails"> {L_POSTED}: {postrow.POST_DATE}<span class="gen">&nbsp;</span>&nbsp; &nbsp;{L_POST_SUBJECT} {postrow.POST_SUBJECT}</span></td>
			</tr>
			<tr> 
				<td ><hr /></td>
			</tr>
			<tr>
				<td ><span class="postbody">{postrow.MESSAGE}</span></td>
			</tr>
		</table></td>
	</tr>
	<tr> 
		<td class="spaceRow" colspan="2" height="1"><img src="templates/{TEMPLATE}/images/spacer.gif" alt="" width="1" height="1" /></td>
	</tr>
	<!-- END postrow -->
  <!-- BEGIN switch_comments_show -->
	</table>
	
	<!-- BEGIN comments_pag -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
	<td><span class="nav">{PAGE_NUMBER}</span></td>
	<td align="right"><span class="nav">{PAGINATION}</span></td>
  </tr>
</table>
	<!-- END comments_pag -->
  <!-- END switch_comments_show -->

<table width="100%" cellspacing="2" border="0" align="center">
  <tr> 
  	<td valign="top" align="left">
	  <!-- BEGIN switch_comments -->
  	  <span class="gensmall">{COMMENTS}&nbsp;{COMMENTS_IMG}</span><br />
  <!-- END switch_comments -->
  <!-- BEGIN switch_ratings -->
  	  <span class="gensmall">{RATINGS}{RATE_IMG}</span>
  <!-- END switch_ratings -->
	</td>
  </tr>
</table>
