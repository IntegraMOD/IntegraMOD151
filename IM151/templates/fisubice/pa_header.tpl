<script type="text/javascript">
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
			<td class="genbtn">
			<!-- IF IS_AUTH_SEARCH -->		
			<a class="icon_search" href="{U_PASEARCH}" title="{L_SEARCH}">&nbsp;<span class="fa fa-search fa-lg"></span>&nbsp;</a>
			<!-- ENDIF -->
			<!-- IF IS_AUTH_STATS -->	
			<a class="icon_stats" href="{U_PASTATS}" title="{L_STATS}">&nbsp;<span class="fa fa-bar-chart fa-lg"></span>&nbsp;</a>
			<!-- ENDIF -->
			<!-- IF IS_AUTH_TOPLIST -->	
			<a class="icon_toplist" href="{U_TOPLIST}" title="{L_TOPLIST}">&nbsp;<span class="fa fa-line-chart fa-lg"></span>&nbsp;</a>
			<!-- ENDIF -->
			<!-- IF IS_AUTH_UPLOAD -->
			<a class="icon_upload" href="{U_UPLOAD}" title="{L_UPLOAD}">&nbsp;<span class="fa fa-upload fa-lg"></span>&nbsp;</a>
			<!-- ENDIF -->	
			<!-- IF IS_AUTH_VIEWALL -->	
			<a class="icon_va" href="{U_VIEW_ALL}" title="{L_VIEW_ALL}">&nbsp;<span class="fa fa-th fa-lg"></span>&nbsp;</a>	
			<!-- ENDIF -->	
			<!-- IF IS_AUTH_MCP -->	
			<a class="icon_mod" href="{U_MCP}" title="{L_MCP_LINK}">&nbsp;<span class="fa fa-flag fa-lg"></span>&nbsp;</a>	
			<!-- ENDIF -->

			</td>
  		</tr>
	</table>



<table width="100%" height="30" border="0" cellpadding="2" cellspacing="0" class="table" align="center">
  <tr>
	<td width="100%" valign="top" colspan="2">