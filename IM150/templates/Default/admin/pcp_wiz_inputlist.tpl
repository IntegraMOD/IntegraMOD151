<script>
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
	function show(object) {
   if (document.getElementById && document.getElementById(object) != null)
      node = document.getElementById(object).style.visibility='visible';
   else if (document.all)
      document.all(object).style.visibility = 'visible';
   else if (document.layers && document.layers[object] != null)
      document.layers[object].visibility = 'visible';
 }

	function hide(object) {
		 if (document.getElementById && document.getElementById(object) != null)
				node = document.getElementById(object).style.visibility='hidden';
		 else if (document.all)
				document.all(object).style.visibility = 'hidden';
		 else if (document.layers && document.layers[object] != null)
				document.layers[object].visibility = 'hidden';
	}

</script>
<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form action="{S_ACTION}" name="post" method="post">
{HIDDEN_FIELDS}
<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<td class="row1" align="left" colspan="4" nowrap>
		{L_SELECT_MAP}<br><select name="{MAPSELECT_NAME}" id="{MAPSELECT_NAME}" class="post">{MAPOPTIONS}</select> <input type="submit" name="{SELECT_NAME}" value="{L_SELECT}" class="mainoption" onclick="return selectMap();"/> <input type="submit" name="{GOTO_NAME}" value="{L_GOTO}" class="mainoption" onclick="return selectMap();"/></td>
</tr>
<!-- BEGIN message -->
<tr>
	<td class="errorline" align="center" colspan="4">
		{message.text}
	</td>
</tr>
<!-- END message -->
<tr>
	<th nowrap="nowrap">{L_FIELD}</th>
	<th nowrap="nowrap">{L_OPTIONS}</th>
	<th nowrap="nowrap">{L_TYPE}</th>
	<th nowrap="nowrap">{L_EXTRA}</th>
</tr>
<!-- BEGIN fields -->
<tr>
	<td class="{fields.COLOR}" nowrap>
		<strong>{fields.namelink}</strong><br />
		<span class="gensmall">{fields.explain}</span><br /><br />
		{L_AUTH}<br />
		<select name="{fields.authname}" id="{fields.authname}" class="post" onchange="updateform();">{fields.authoptions}</select>
	</td>
	<td class="{fields.COLOR}" align="center" nowrap>
		<table border="0">
			<tr>
				<td><input type="checkbox" name="{fields.requiredname}" {fields.requiredchecked} value="1" onchange="updateform();"></td><td>{L_REQUIRED}</td>
			</tr><tr>
				<td><input type="checkbox" name="{fields.visibilityname}" {fields.visibilitychecked} value="1" onchange="updateform();"></td><td>{L_VISIBILITY}</td>
			</tr><tr>
				<td colspan="2">{L_STYLE}<br /><input type="text" name="{fields.inputstylename}" value="{fields.inputstylevalue}" class="post" onchange="updateform();"></td>
			</tr>
		</table>
	</td>
	<td class="{fields.COLOR}" nowrap>
		<table border="0">
			<tr>
				<td ><input type="radio" name="{fields.get_modename}" {fields.textmodechecked} value="{fields.textmodevalue}" onchange="updateform();" onclick="settxt_{fields.name}();"></td><td nowrap>{L_TEXTMODE}</td>
			</tr><tr>
				<td><input type="radio" name="{fields.get_modename}" {fields.dropmodechecked} value="{fields.dropmodevalue}" onchange="updateform();" onclick="setlst_{fields.name}();"></td><td nowrap>{L_DROPMODE}</td>
			</tr><tr>
				<td><input type="radio" name="{fields.get_modename}" {fields.radiomodechecked} value="{fields.radiomodevalue}" onchange="updateform();" onclick="setlst_{fields.name}();"></td><td nowrap>{L_RADIOMODE}</td>
			</tr><tr>
				<td><input type="radio" name="{fields.get_modename}" {fields.functmodechecked} value="{fields.functmodevalue}" onchange="updateform();" onclick="setfunct_{fields.name}();"></td><td nowrap>{L_FUNCTMODE}</td>
			</tr>
		</table>
	</td>
	<td class="{fields.COLOR}" align="left" nowrap>
		<div id="{fields.valuesname}" class="{fields.COLOR}">
		{L_VALUES}<br />
		<select name="{fields.valuesname}" class="post" onchange="updateform();">{fields.valuesoptions}</select><br /></div>
	<div id="{fields.getfuncname}" class="{fields.COLOR}">
		{L_GETFUNCT}<br />
		<select name="{fields.getfuncname}" class="post" onchange="updateform();">{fields.getfuncoptions}</select><br /></div>
		<div id="{fields.chkfuncname}" class="{fields.COLOR}">
		{L_CHECKFUNCT}<br />
		<select name="{fields.chkfuncname}" class="post" onchange="updateform();">{fields.chkfuncoptions}</select>
		</div>
	</td>
</tr>
<script>
	function settxt_{fields.name}(){
		hide('{fields.valuesname}');
		hide('{fields.getfuncname}');
		hide('{fields.chkfuncname}');
	}
	function setlst_{fields.name}(){
		hide('{fields.getfuncname}');
		hide('{fields.chkfuncname}');
		show('{fields.valuesname}');
	}
	function setfunct_{fields.name}(){
		show('{fields.getfuncname}');
		show('{fields.chkfuncname}');
		hide('{fields.valuesname}');
	}
	if('{fields.textmodechecked}' == 'checked'){
		settxt_{fields.name}();
	}
	if('{fields.dropmodechecked}' == 'checked' || '{fields.radiomodechecked}' == 'checked'){
		setlst_{fields.name}();
	}
	if('{fields.functmodechecked}' == 'checked'){
		setfunct_{fields.name}();
	}
</script>
<!-- END fields -->
<tr>
	<td class="cat" align="center" colspan="4">
		<input type="submit" name="{SUBMIT_NAME}" value="{L_SUBMIT}" class="mainoption" onclick="setSelectedIndex();"/>
	</td>
</tr>
<tr>
	<td class="cat" align="center" colspan="4">
		{L_EXAMPLE}
	</td>
</tr>
<tr>
	<td class="row1" align="center" colspan="4" nowrap>
		{EXAMPLE}
	</td>
</tr>
</table>
</form>
<p>{HELP}</p>
<br />
<script>
	setSelectedPage();
</script>