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
		selectedPage = document.getElementById("{MAPSELECT_NAME}").selectedIndex;
	}
	function setSelectedIndex(){
		// make sure they didn't change the map and submit without hitting select
		document.getElementById("{MAPSELECT_NAME}").selectedIndex = selectedPage;
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
	<td class="row1" align="center" colspan="5" nowrap>
		{L_SELECT_MAP} <select name="{MAPSELECT_NAME}" id="{MAPSELECT_NAME}" class="post">{MAPOPTIONS}</select> <input type="submit" name="{SELECT_NAME}" value="{L_SELECT}" class="mainoption" onclick="return selectMap();"/> <input type="submit" name="{GOTO_NAME}" value="{L_GOTO}" class="mainoption" onclick="return selectMap();"/></td>
</tr>
<!-- BEGIN message -->
<tr>
	<td class="errorline" align="center" colspan="5">
		{message.text}
	</td>
</tr>
<!-- END message -->
<tr>
	<th nowrap="nowrap">{L_FIELD}</th>
	<th nowrap="nowrap">{L_OPTIONS}</th>
	<th nowrap="nowrap">{L_HTML}</th>
	<th nowrap="nowrap">{L_EXTRA}</th>
	<th nowrap="nowrap">{L_EXAMPLE}</th>
</tr>
<!-- BEGIN fields -->
<tr>
	<td class="{fields.COLOR}" nowrap>
		<strong>{fields.name}</strong><br /><br /><span class="gensmall">{fields.explain}</span>
	</td>
	<td class="{fields.COLOR}" nowrap align="center">
		<table width="100%" border="0">
			<tr>
				<td>{L_LEGEND}:</td>
				<td><input type="checkbox" name="{fields.legendname}" {fields.legendchecked} value="1" onchange="updateform();"></td>
			</tr>
			<tr>
				<td>{L_TEXT}:</td>
				<td><input type="checkbox" name="{fields.textname}" {fields.textchecked} value="1" onchange="updateform();"></td>
			</tr>
			<tr>
				<td>{L_IMAGE}:</td>
				<td><input type="checkbox" name="{fields.imagename}" {fields.imagechecked} value="1" onchange="updateform();"></td>
			</tr>
			<tr>
				<td>{L_NEXTLINE}:</td>
				<td><input type="checkbox" name="{fields.nextlinename}" {fields.nextlinechecked} value="1" onchange="updateform();"></td>
			</tr>
		</table>
	</td>
	<td class="{fields.COLOR}" align="center"><textarea rows="6" cols="30" wrap="virtual" name="{fields.spanname}" class="post" onChange="updateform();">{fields.spanvalue}</textarea></td>
	<td class="{fields.COLOR}">
		{L_DSPFUNCT}:<br />
		<select name="{fields.dspfunctname}" id="{fields.dspfunctname}" class="post" onchange="updateform();">{fields.dspfunctoptions}</select><br /><br />
		{L_DISPLAY}:<br />
		<select name="{fields.displayname}" id="{fields.displayname}" class="post" onchange="updateform();">{fields.displayoptions}</select></td>
	<td class="{fields.COLOR}" align="center">{fields.example}</td>
</tr>
<!-- END fields -->
<tr>
	<td class="cat" align="center" colspan="5">
		<input type="submit" name="{SUBMIT_NAME}" value="{L_SUBMIT}" class="mainoption" onclick="setSelectedIndex();"/>
	</td>
</tr>
</table>
</form>
<p>{HELP}</p>
<br />
<script language="javascript">
	setSelectedPage();
</script>