/*
 +--------------------------------------------------------------------------------+
 |                                                                                |
 | DHTML Tabsets                                                                  |
 |                                                                                |
 | Copyright and Legal Notices:                                                   |
 |                                                                                |
 |   All source code, images, programs, files included in this distribution       |
 |   Copyright (c) 1996,1997,1998,1999,2000                                       |
 |                                                                                |
 |          John C. Cokos  iWeb, Inc.                                             |
 |          All Rights Reserved.                                                  |
 |                                                                                |
 |                                                                                |
 |   Web: http://www.iwebsoftware.com      Email: info@iwebsoftware.com           |
 |                                                                                |
 +--------------------------------------------------------------------------------+

**
	Original Tabset Scripts were obtained from another source.  Cannot remember
	where I got them from.  I've manipulated the daylights out of it, to make it
	work in all browsers, and behave the way that I wanted it to.   If you are,
	or if you know the originater, please email me at the address noted above, and
	I will be happy to change the copyright notices herein to include you as
	the original source.
**

*/


/*  This file should not be modified */


var NS4 = (document.layers) ? 1 : 0;
var IE = (document.all) ? 1 : 0;
var DOM = 0; 
if (parseInt(navigator.appVersion) >=5) {DOM=1};

var lastHeader;
var currShow;

function changeCont(tgt,header) {
	target=('T' +tgt);

	if (DOM) {
		// Hide the last one, and flip the tab color back.
		currShow.style.visibility="hidden";
		if ( lastHeader ) {
			lastHeader.style.background = tab_off;
			lastHeader.style.fontWeight="normal";
		}

		// Show this one, and make the tab silver
		var flipOn = document.getElementById(target);
		flipOn.style.visibility="visible";

		var thisTab = document.getElementById(header);
		thisTab.style.background = tab_on;
		thisTab.style.fontWeight = "bold";

		// Save for next go'round
		currShow=document.getElementById(target);
		lastHeader = document.getElementById(header);

		return false;
	}

	else if (IE) {

		// Hide the last one, and flip the tab color back.
		currShow.style.visibility = 'hidden';
		if (lastHeader) {
			lastHeader.style.background = tab_off;
			lastHeader.style.fontWeight="normal";
		}

		// Show this one, and make the tab silver
		document.all[target].style.visibility = 'visible';
		document.all[header].style.background = tab_on;
		document.all[header].style.fontWeight = 'bold';

		// Save for next go'round
		currShow=document.all[target];
		lastHeader=document.all[header];

		return false;
	}

	else if (NS4) {
		// Hide the last one, and flip the tab color back.
		currShow.visibility = 'hide';
		// if (lastHeader) { lastHeader.bgColor = tab_off; }

		// Show this one, and make the tab silver
		document.layers[target].visibility = 'show';
		// document.layers[header].bgColor  = tab_on;

		// Save for next go'round
		currShow=document.layers[target];
		// lastHeader=document.layers[header];

		return false;
	}

	// && (version >=4)
	else {
		window.location=('#A' +target);
		return true;
	}
}

function DrawTabs() {
	var output = '';
	var tabindex = 1;

	output += '<div id="tabstop">\n';
	output += '<table border="0" cellpadding="0" cellspacing="0" width="100%">\n';
	for ( var x = 1; x <= num_rows; x++ ) {
		output += '<tr valign="middle">\n';
		for ( var z = 1; z < rows[x].length; z++ ) {
			var tid = "tab" + x + z;
			var did = x + z;
			output += '<td class="button-cell"><button tabindex="' + tabindex +'" id="' + tid +'" onClick="changeCont(\'' + x + z + '\', \'' + tid + '\'); return false;" onFocus="if(this.blur)this.blur()" class="tab-button">' + rows[x][z] + '</button></td>\n';
			tabindex++;
		}
		if ( z == num_cols )
		{
			output += '<td id="' + tid +'" class="button-cell">&nbsp;</td>\n';
		}
		output += '</tr>\n';
	}
	output += '</table>\n';
	output += '</div>\n\n';

	self.document.write(output);
}