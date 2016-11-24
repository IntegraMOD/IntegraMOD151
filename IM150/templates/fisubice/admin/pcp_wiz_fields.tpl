<script language="javascript">
	formupdated = false;
	function selectMap(){
		if (validateform()){
			// make sure they didn't change the map and submit without hitting select
			setSelectedPage();
			document.post.reset();
			setSelectedIndex();
			return true;
		} else return false;		
	}
	function setSelectedPage(){
		// make sure they didn't change the map and submit without hitting select
		selectedPage = document.getElementById("{FIELDSELECT_NAME}").selectedIndex;
		selectedPage2 = document.getElementById("{NEWSELECT_NAME}").selectedIndex;
	}
	function setSelectedIndex(){
		// make sure they didn't change the map and submit without hitting select
		document.getElementById("{FIELDSELECT_NAME}").selectedIndex = selectedPage;
		document.getElementById("{NEWSELECT_NAME}").selectedIndex = selectedPage2;
		return true;
	}
	function updateform(){
		formupdated = true;
	}
	function validateform(){
		doyou = true;
		if(formupdated){
			doyou = confirm("{CONFIRM_MESSAGE}"); 
		}
		return doyou;
	}
</script>
<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form action="{S_ACTION}" name="post" method="post">
{HIDDEN_FIELDS}
<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<td class="row1" align="left" colspan="4" nowrap>
		{L_SELECT_FIELD} <select name="{FIELDSELECT_NAME}" id="{FIELDSELECT_NAME}" class="post">{FIELDOPTIONS}</select> <input type="submit" name="{SELECT_NAME}" value="{L_SELECT}" class="mainoption" onclick="return selectMap();"/>  <input type="submit" name="{GOTO_NAME}" value="{L_GOTO}" class="mainoption" onclick="return selectMap();"/><br /><br />
		{L_SELECT_NEW_FIELD} <select name="{NEWSELECT_NAME}" id="{NEWSELECT_NAME}" class="post">{NEWOPTIONS}</select> <input type="submit" name="{NEW_NAME}" value="{L_SELECT}" class="mainoption" onclick="return selectMap();"/>
	</td>
</tr>
<!-- BEGIN message -->
<tr>
	<td class="errorline" align="center" colspan="4">
		{message.text}
	</td>
</tr>
<!-- END message -->
<!-- BEGIN selected -->
<tr><td colspan="4">{FIELDINFO}</td></tr>
<tr>
	<td class="cat" align="center" colspan="4">
		<input type="submit" name="{SUBMIT_NAME}" value="{L_SUBMIT}" class="mainoption" onclick="setSelectedIndex();"/>
	</td>
</tr>
<!-- END selected -->
</table>
</form>
<p>{HELP}</p>
<br />
<script language="javascript">
	setSelectedPage();
</script>