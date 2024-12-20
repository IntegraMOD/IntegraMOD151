<script>
	var selectedList;
	var availableList;
	function createListObjects(){
		availableList = document.getElementById("{AVAILABLENAME}");
		selectedList = document.getElementById("{SELECTEDNAME}");
	}
	function delAttribute(){
  	var selIndex = selectedList.selectedIndex;
		if(selIndex < 0) return;
		while (selIndex >= 0){
			availableList.appendChild(selectedList.options.item(selIndex));
			selIndex = selectedList.selectedIndex;
		}
		selectNone(selectedList,availableList);
		updateform();
	}
	function addAttribute(){
		var addIndex = availableList.selectedIndex;
		if(addIndex < 0) return;
		while (addIndex >= 0){
		 	selectedList.appendChild(availableList.options.item(addIndex));
			addIndex = availableList.selectedIndex;
		}
		selectNone(selectedList,availableList);
		updateform();
	}
	function selectNone(list1,list2){
		if(list1) list1.selectedIndex = -1;
    if(list2) list2.selectedIndex = -1;
	}
	function selectMap(){
		if (validateform()){
			selectNone(selectedList,availableList);
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
	function selectAll(list){
	  for(x=0; x<(list.length); x++){
    	list.item(x).selected = "true";
    }
	}
	function submitMap(){
		selectNone(availableList);
		selectAll(selectedList);
		setSelectedIndex();
		return true;
	}
	function swapOptions(obj,i,j) {
		var o = obj.options;
		var i_selected = o[i].selected;
		var j_selected = o[j].selected;
		var temp = new Option(o[i].text, o[i].value, o[i].defaultSelected, o[i].selected);
		var temp2= new Option(o[j].text, o[j].value, o[j].defaultSelected, o[j].selected);
		o[i] = temp2;
		o[j] = temp;
		o[i].selected = j_selected;
		o[j].selected = i_selected;
	}
	function moveOptionUp(obj) {
		for (i=0; i<obj.options.length; i++) {
			if (obj.options[i].selected) {
				if (i != 0 && !obj.options[i-1].selected) {
					swapOptions(obj,i,i-1);
					obj.options[i-1].selected = true;
				}
			}
		}
	}
	function moveOptionDown(obj) {
		for (i=obj.options.length-1; i>=0; i--) {
			if (obj.options[i].selected) {
				if (i != (obj.options.length-1) && ! obj.options[i+1].selected) {
					swapOptions(obj,i,i+1);
					obj.options[i+1].selected = true;
				}
			}
		}
	}
	function showfieldinfo(list){
		if(list.selectedIndex >= 0){
			field = list.item(list.selectedIndex).value;
			win = window.open("{S_HELP}&field="+field, 'field_info', "width=590, innerWidth=590, height=350, innerHeight=350, resizable, scrollbars");
			win.focus();
			win.moveTo(0,0);
			win.resizeTo(screen.width,screen.height);
		}	
	}
</script>

<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form action="{S_ACTION}" name="post" method="post" >
{HIDDEN_FIELDS}
<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<td class="row1" align="center" colspan="3" nowrap>
		{L_SELECT_MAP} <select name="{MAPSELECT_NAME}" id="{MAPSELECT_NAME}" class="post">{MAPOPTIONS}</select> <input type="submit" name="{SELECT_NAME}" value="{L_SELECT}" onclick="return selectMap();" class="mainoption" /> <input type="submit" name="{GOTO_NAME}" value="{L_GOTO}" class="mainoption" onclick="return selectMap();"/>
	</td>
</tr>
<!-- BEGIN message -->
<tr>
	<td class="errorline" align="center" colspan="3">
		{message.text}
	</td>
</tr>
<!-- END message -->
<tr>
	<th nowrap="nowrap">{L_AVAILABLE}</th>
	<th nowrap="nowrap">{L_ACTION}</th>
	<th nowrap="nowrap">{L_SELECTED}</th>
</tr>
<tr>
	<td class="row1" align="center"><select name="{AVAILABLENAME}" id="{AVAILABLENAME}" class="post" multiple size="20">{AVAILABLEOPTIONS}</select>&nbsp;<input type="button" value="?" onclick="showfieldinfo(availableList);" class="mainoption"></td>
	<td class="row1" align="center">
		<input type="button" value=" -> " onclick="addAttribute()" class="mainoption"><br /><br />
		<input type="button" value=" <- " onclick="delAttribute()" class="mainoption">
	</td>
	<td class="row1" align="center">
		<table><tr>
			<td><select name="{SELECTEDNAME}" id="{SELECTEDNAME}" class="post" multiple size="20" onChange="updateform();">{SELECTEDOPTIONS}</select>&nbsp;<input type="button" value="?" onclick="showfieldinfo(selectedList);" class="mainoption"></td>
			<td>
			<input type="button" value="{L_MOVE_UP}" onclick="moveOptionUp(selectedList);" class="mainoption"><br /><br />
		<input type="button" value="{L_MOVE_DOWN}" onclick="moveOptionDown(selectedList);" class="mainoption">
			</td></tr></table>
	</td>
</tr>
<tr>
	<td class="cat" align="center" colspan="7">
		<input type="submit" name="{SUBMIT_NAME}" value="{L_SUBMIT}" class="mainoption" onclick="submitMap();" />
	</td>
</tr>
</table>
</form>
<p>{HELP}</p>
<br />
<script language="javascript">
	createListObjects();
	setSelectedPage();
</script>