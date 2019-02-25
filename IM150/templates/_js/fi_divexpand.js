function fiSelectEl(elId) {
var element = document.getElementById(elId);
if ( document.selection ) {
	var range = document.body.createTextRange();
	range.moveToElementText(element);
	range.select();
	}
if ( window.getSelection ) {
	var range = document.createRange();
	range.selectNodeContents(element);
	var blockSelection = window.getSelection();
	blockSelection.removeAllRanges();
	blockSelection.addRange(range);
	}
}

function fiResizeEl(elId,elState) {
divId = document.getElementById(elId);
divExpId = document.getElementById('ex' + elId);
divLnkCntrct = '<a href="#" onclick="fiResizeEl(\'' + elId + "');return false;\">" + Cntrct + "</a> &#8250;";
divLnkExpnd = '<a href="#" onclick="fiResizeEl(\'' + elId + "','1');return false;\">" + ExPnd + "</a> &#8250;";
if (!elState) {
	divId.style.height = 40;
	divId.parentNode.style.height = 0;
	divId.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.style.height = 0;
	divExpId.innerHTML = divLnkExpnd;
} else if (divId.scrollHeight > 40) {
	divId.style.height = divId.scrollHeight + 3;
	divId.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.style.height = divId.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.scrollHeight + 3;
	divExpId.innerHTML = divLnkCntrct;
	}
}

function docWrite(type) {
	Cntrct = 'Contract';
	ExPnd = 'Expand'; 
	randomId = 'd' + Math.floor(Math.random() * 2000); 
	document.write('&#8249; <a href="javascript:void(0);" onclick="fiSelectEl(\'' + randomId + '\');return false;">Select</a> &#8250;&#8249; <span id="ex' + randomId + '"><a href="javascript:void(0);" onclick="fiResizeEl(\'' + randomId + '\',\'1\');return false;">Expand</a> &#8250;</span></div><div id="' + randomId + '" class="' + type + '">');
}