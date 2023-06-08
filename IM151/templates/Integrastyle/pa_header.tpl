<SCRIPT LANGUAGE="JavaScript"> 
<!-- 
	function mpFoto(img)
	{
		foto1= new Image(); 
		foto1.src=(img); 
		mpControl(img); 
	}

	function mpControl(img)
	{ 
		if((foto1.width!=0)&&(foto1.height!=0))
		{ 
			viewFoto(img);
		}
		else
		{ 
			mpFunc="mpControl('"+img+"')"; 
			intervallo=setTimeout(mpFunc,20); 
		} 
	} 

	function viewFoto(img)
	{ 
		largh=foto1.width+20; 
		altez=foto1.height+20; 
		string="width="+largh+",height="+altez; 
		finestra=window.open(img,"",string); 
	}
	
	function MM_jumpMenu(targ,selObj,restore)
	{ 
		//v3.0
		eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
		if (restore)
		{
			selObj.selectedIndex=0;
		}
	}

    function delete_file(theURL) 
	{
       if (confirm('Are you sure you want to delete this file??')) 
	   {
          window.location.href=theURL;
       }
       else
	   {
          alert ('No Action has been taken.');
       } 
    }
		
//--> 
</script>

<table width="100%" height="99%" cellpadding="2" cellspacing="0">
  <tr>
	<td align="center" width="100%" height="100%" valign="top">


<table width="40%" cellpadding="3" cellspacing="1">
  <tr>	
	<!-- IF IS_AUTH_SEARCH -->		
	<td align="center"><b>&nbsp;<a href="{U_PASEARCH}" class="gensmall" title="{L_SEARCH}"><img src="{SEARCH_IMG}" border="0" alt="{L_SEARCH}" align="middle" /></a>&nbsp;</b></td>
	<!-- ENDIF -->
	<!-- IF IS_AUTH_STATS -->	
	<td align="center"><b>&nbsp;<a href="{U_PASTATS}" class="gensmall" title="{L_STATS}"><img src="{STATS_IMG}" border="0" alt="{L_STATS}" align="middle" /></a>&nbsp;</b></td>
	<!-- ENDIF -->
	<!-- IF IS_AUTH_TOPLIST -->	
	<td align="center"><b>&nbsp;<a href="{U_TOPLIST}" class="gensmall" title="{L_TOPLIST}"><img src="{TOPLIST_IMG}" border="0" alt="{L_TOPLIST}" align="middle" /></a>&nbsp;</b></td>
	<!-- ENDIF -->
	<!-- IF IS_AUTH_UPLOAD -->
	<td align="center"><b>&nbsp;<a href="{U_UPLOAD}" class="gensmall" title="{L_UPLOAD}"><img src="{UPLOAD_IMG}" border="0" alt="{L_UPLOAD}" align="middle" /></a>&nbsp;</b></td>
	<!-- ENDIF -->	
	<!-- IF IS_AUTH_VIEWALL -->	
	<td align="center"><b>&nbsp;<a href="{U_VIEW_ALL}" class="gensmall" title="{L_VIEW_ALL}"><img src="{VIEW_ALL_IMG}" border="0" alt="{L_VIEW_ALL}" align="middle" /></a>&nbsp;</b></td>	
	<!-- ENDIF -->	
	<!-- IF IS_AUTH_MCP -->	
	<td align="center"><b>&nbsp;<a href="{U_MCP}" class="gensmall" title="{L_MCP_LINK}"><img src="{MCP_IMG}" border="0" alt="{L_MCP}" align="middle" /></a>&nbsp;</b></td>	
	<!-- ENDIF -->	
  </tr>
</table>



<table width="100%" height="30" border="0" cellpadding="2" cellspacing="0" class="table" align="center">
  <tr>
	<td width="100%" valign="top" colspan="2">