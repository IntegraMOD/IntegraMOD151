<!-- BEGIN no_popup --> 
<table width="100%" border="0" cellspacing="0" cellpadding="2"> 
<tr> 
    <td width="100%" class="maintitle">{HEADING}</td> 
</tr> 
<tr> 
<td width="100%" class="nav"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_CAT_DESC}</td> 
</tr> 
<!-- END no_popup --> 
<!-- BEGIN popup --> 
<br /> 
<!-- END popup -->
<table width="100%" class="forumline">
<tr>
<th>{HEADING}</th>
</tr>
<tr>
<td class="row1">
<p class="gen">{L_POSTER}: <b>{POSTER}</b><br />
{L_TOPIC}: <b>{T_TITLE}</b><br />
{L_TOPIC_RANK}: {TOPIC_RANK}<br />
</p>

<form name="rating_form" method="post" action="{FORM_ACTION}">
<input type="hidden" name="rating_form_submitted" value="y">
<table cellspacing="10">
<tr>
<td valign="top">
	<table>
	<tr>
	<td colspan="2"><span class="gen">{RATE_POST_MSG}</span></td>
	</tr>
	<!-- BEGIN option -->
	<tr>
	<td><input type="radio" name="rating" value="{option.ID}" {option.SELECTED}></td>
	<td class="gen">{option.LABEL}</td>
	</tr>
	<!-- END option -->
	</table>
	{SUBMIT_BUTTON}
</td>
</tr>
<tr>
<td valign="top" align="center">
	<table border="0" cellpadding="3" cellspacing="1" class="forumline">
	<caption class="gen"><b>{L_POST_RANK}:&nbsp;{POST_RANK}</b></caption>
	<tr>
		<th class="thCornerL">{L_RATED_BY}</th>
		<!-- BEGIN bias_applicable --> 
        <th class="thTop">{L_BIAS}</th> 
        <!-- END bias_applicable -->
		<th class="thTop">{L_RATED_ON}</th>
		<th class="thCornerR">{L_RATING}</th>
	</tr>
<!-- BEGIN bias_applicable --> 
    <tr> 
    <td class="{bias_applicable.ROWCSS}"><span class="gen">{bias_applicable.WHO}</span></td> 
    <td class="{bias_applicable.ROWCSS}"><span class="gen">{bias_applicable.BIAS}</span></td> 
    <td class="{bias_applicable.ROWCSS}"><span class="gen">{bias_applicable.RATING_TIME}</span></td> 
    <td class="{bias_applicable.ROWCSS}"><span class="gen">{bias_applicable.RATING}</span></td> 
    </tr> 
    <!-- END bias_applicable --> 
    <!-- BEGIN bias_not_applicable --> 
    <tr> 
    <td class="{bias_not_applicable.ROWCSS}"><span class="gen">{bias_not_applicable.WHO}</span></td> 
    <td class="{bias_not_applicable.ROWCSS}"><span class="gen">{bias_not_applicable.RATING_TIME}</span></td> 
    <td class="{bias_not_applicable.ROWCSS}"><span class="gen">{bias_not_applicable.RATING}</span></td> 
    </tr> 
    <!-- END bias_not_applicable -->
	</table>
</td>
</tr>
</table>
</form>
<p class="maintitle"><a href="{U_END_LINK}">{L_END_LINK}</a></p>

</td></tr></table>