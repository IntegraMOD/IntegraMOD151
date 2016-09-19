var agt = navigator.userAgent.toLowerCase();
var originalFirstChild;

function createTitle(which, string, x, y, bold) 
{
	// record the original first child (protection when deleting)
	if (typeof(originalFirstChild) == 'undefined') 
	{
		originalFirstChild = document.body.firstChild;
	}

	x = document.all ? (event.clientX + document.body.scrollLeft) : x;
	y = document.all ? (event.clientY + document.body.scrollTop) : y;
	element = document.createElement('div');
	element.style.position = 'absolute';
	element.style.zIndex = 1000;
	element.style.visibility = 'hidden';
	excessWidth = 0;
	if (document.all) 
	{
		excessWidth = 50;
	}
	excessHeight = 20;
	if (bold==1)
	{
		element.innerHTML = '<div class="bodyline"><table width="200" cellspacing="0" cellpadding="0" border="0"><tr><td><table width="100%"><tr><td class="acronym"><span class="gensmall"><b>' + string + '</b></span></td></tr></table></td></tr></table></div>';
	}else
	{
		element.innerHTML = '<div class="bodyline"><table width="300" cellspacing="0" cellpadding="0" border="0"><tr><td><table width="100%"><tr><td><span class="gen">' + string + '</span></td></tr></table></td></tr></table></div>';
	}
	renderedElement = document.body.insertBefore(element, document.body.firstChild);
	renderedWidth = renderedElement.offsetWidth;
	renderedHeight = renderedElement.offsetHeight;

	// fix overflowing off the right side of the screen
	overFlowX = x + renderedWidth + excessWidth - document.body.offsetWidth;
	x = overFlowX > 0 ? x - overFlowX : x;

	// fix overflowing off the bottom of the screen
	overFlowY = y + renderedHeight + excessHeight - window.innerHeight - window.pageYOffset;
	y = overFlowY > 0 ? y - overFlowY : y;

	renderedElement.style.top = (y + 15) + 'px';
	renderedElement.style.left = (x + 15) + 'px';

	// windows versions of mozilla are like too fast here...we have to slow it down
	if (agt.indexOf('gecko') != -1 && agt.indexOf('win') != -1) 
	{
		setTimeout("renderedElement.style.visibility = 'visible'", 1);
	}
	else 
	{
		renderedElement.style.visibility = 'visible';
	}
}

function destroyTitle() 
{
	// make sure we don't delete the actual page contents (javascript can get out of alignment)
	if (document.body.firstChild != originalFirstChild) 
	{
		document.body.removeChild(document.body.firstChild);
	}
}