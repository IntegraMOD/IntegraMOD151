<h1>{L_PSEUDOCRON_TITLE}</h1> 

<p>{L_PSEUDOCRON_EXPLAIN}</p> 

<form action="{S_PSEUDOCRON_ACTION}" method="post"><input type="hidden" name="set" value="general"><table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline"> 
   <tr> 
     <th class="thHead" colspan="2">{L_PSEUDOCRON_TITLE}</th> 
   </tr> 

   <tr> 
      <td class="row1">{L_ENABLE_PSEUDOCRON}<br /><span class="gensmall">{L_ENABLE_PSEUDOCRON_EXPLAIN}</span></td> 
      <td class="row2"><input type="radio" name="pseudocron" value="1" {ENABLE_PSEUDOCRON_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="pseudocron" value="0" {ENABLE_PSEUDOCRON_NO} /> {L_NO}</td> 
   </tr> 
   <tr> 
      <td class="row1">{L_NEXTCRON}<br /><span class="gensmall">{L_NEXTCRON_EXPLAIN}</span></td> 
      <td class="row2">{NEXTCRON_NUMBER}<br />{NEXTCRON_MINUTES}</td> 
   </tr> 
   <tr> 
      <td class="row1">{L_CRONTEST}</td> 
      <td class="row2">{CRONTEST}</td> 
   </tr> 
   <tr> 
      <td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" /> 
      </td> 
   </tr> 
</table></form> 

<br clear="all" />