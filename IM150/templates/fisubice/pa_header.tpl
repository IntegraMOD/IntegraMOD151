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

	<table cellpadding="3" cellspacing="1">
  		<tr>
			<td>	
			<!-- IF IS_AUTH_SEARCH -->		
			<a class="icon_search" href="{U_PASEARCH}"><span>{L_SEARCH}</span></a>
			<!-- ENDIF -->
			<!-- IF IS_AUTH_STATS -->	
			<a class="icon_stats" href="{U_PASTATS}"><span>{L_STATS}</span></a>
			<!-- ENDIF -->
			<!-- IF IS_AUTH_TOPLIST -->	
			<a class="icon_toplist" href="{U_TOPLIST}"><span>{L_TOPLIST}</span></a>
			<!-- ENDIF -->
			<!-- IF IS_AUTH_UPLOAD -->
			<a class="icon_upload" href="{U_UPLOAD}"><span>{L_UPLOAD}</span></a>
			<!-- ENDIF -->	
			<!-- IF IS_AUTH_VIEWALL -->	
			<a class="icon_va" href="{U_VIEW_ALL}"><span>{L_VIEW_ALL}</span></a>	
			<!-- ENDIF -->	
			<!-- IF IS_AUTH_MCP -->	
			<a class="icon_mod" href="{U_MCP}"><span>{L_MCP_LINK}</span></a>	
			<!-- ENDIF -->	
			</td>
  		</tr>
	</table>



<table width="100%" height="30" border="0" cellpadding="2" cellspacing="0" class="table" align="center">
  <tr>
	<td width="100%" valign="top" colspan="2">