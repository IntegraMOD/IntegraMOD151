<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}">
</head>
<body style="margin-top:0px;margin-left:0px;background-color:{T_BODY_BGCOLOR}">
<script language="JavaScript">
<!-- 
var linkrow = new Array({LINKS_LOGO});
var interval = {DISPLAY_INTERVAL};
var link_start = 0;
var link_num = {DISPLAY_LOGO_NUM};
document.write('<table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><div id="links"></div></td></tr></table>');
function writeDiv(){
	var link_innerHTML = '';
	if(linkrow.length > link_num)
	{
		for(var i=0; i<link_num; i++)
		{
			link_innerHTML += linkrow[(i + link_start) % linkrow.length];
		}
		document.all.links.innerHTML=link_innerHTML;
		(link_start < linkrow.length - 1) ? link_start ++ : link_start = 0;
		setTimeout("writeDiv()",interval);
	}
	else
	{
		for(var j=0; j<linkrow.length; j++)
		{
			link_innerHTML += linkrow[j];	
		}
		document.all.links.innerHTML=link_innerHTML;
	}
}
	
writeDiv();
// -->
</script>
</body>
</html>