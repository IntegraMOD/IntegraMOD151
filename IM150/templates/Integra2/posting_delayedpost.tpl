<!-- BEGIN switch_load_calendar -->
<style type="text/css">@import url({TEMPLATE_PATH}calendar.css);</style>
<script type="text/javascript" src="templates/calendar.js"></script>
<script type="text/javascript" src="language/{LANG}/calendar.js"></script>
<script type="text/javascript" src="templates/calendar-setup.js"></script>
<!-- END switch_load_calendar -->
<script language="JavaScript" type="text/javascript">
  is_delayed_allowed = 1;
</script>
<tr>
<th class="thHead" colspan="2">{L_DELAYED_POST}</th>
</tr>
<tr>
<td class="row1" colspan="2"><span class="gensmall">{L_DELAYED_POST_EXPLAIN}</span></td>
</tr>
<tr>
<td class="row1" align="right"><span class="explaintitle"><b>{L_POST_DATE}:</b></span></td>
<td class="row2" valign="middle"><span class="genmed"><input type="text" name="forcetime" id="delayinput" size="50" maxlength="255" class="post" value="{POST_DATE}" readonly="1" />&nbsp;<img src="{DATE_PICKER_IMAGE}" id="trigger" onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />&nbsp;<img src="{CLEAR_DATE_IMAGE}" onmouseover="this.style.background='red';" onmouseout="this.style.background=''" onclick="document.post.forcetime.value='';" /></span></td>
</tr>
<script language="JavaScript" type="text/javascript">
Calendar.setup(
{
inputField  : "delayinput",         // ID of the input field
ifFormat    : "%A, %B %e, %Y %I:%M %p",    // the date format
button      : "trigger",       // ID of the button
align       : "T1"
}
);
</script>
