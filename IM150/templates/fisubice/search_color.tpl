<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="{S_CONTENT_DIRECTION}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}"  />
<meta http-equiv="Content-Style-Type" content="text/css" />
<title>{PAGE_TITLE}</title>
<style type="text/css">
.bd { border : 1px inset InactiveBorder; }
.s  { width:181 }
</style>
</head>
<body bgcolor="{T_BODY_BGCOLOR}" leftmargin="5" topmargin="5" marginheight="5" marginwidth="5" onload="P.C(P.initPalette)">
<form>
<table cellpadding="0" cellspacing="2" border="0" width="184">
	<tr>
		<td align="center"><select name="type" onchange="P.C(this.selectedIndex)" class="s"><option>{L_WEB_SAFE}</option><option>{L_WINDOWS_SYSTEM}</option><option>{L_GREY_SCALE}</option><option>{L_MAC_OS}</option></select></td>
	</tr>
	<tr>
		<td align="center">
			<script language="JavaScript">
			var P = opener.TCP;
			onload = "P.show(P.initPalette)";
			document.forms[0].elements[0].selectedIndex = P.initPalette;
			P.draw(window, document);
			</script>
		</td>
	</tr>
</table>
</form>
</body>
</html>