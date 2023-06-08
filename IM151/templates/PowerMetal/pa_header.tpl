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
<table class="blk" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="blkl" src="templates/PowerMetal/images/blk_tlc.gif"width="8" height="23" border="0" alt=""></td> 
   <td align="center" width="100%" background="templates/PowerMetal/images/blk_tm.gif"><strong>{L_PAGE_NAME}<strong><img name="blkm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="blkr" src="templates/PowerMetal/images/blk_trc.gif" width="77" height="23" border="0" alt=""></td>
  </tr>
  	</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td><img name="tlc" src="templates/PowerMetal/images/tlc.gif" width="8" height="6" border="0" alt=""></td> 
   <td width="100%" background="templates/PowerMetal/images/tm.gif"><img name="tm" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="trc" src="templates/PowerMetal/images/trc.gif" width="8" height="6" border="0" alt=""></td>
  </tr>
  <tr>
    <td background="templates/PowerMetal/images/left.gif"><img name="left" src="templates/PowerMetal/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
        <td valign="top" bgcolor="#484848">


<table width="100%" height="99%" cellpadding="2" cellspacing="0">
  <tr>
	<td align="center" width="100%" height="100%" valign="top">


<table width="40%" cellpadding="3" cellspacing="1">
  <tr>	
	<!-- IF IS_AUTH_SEARCH -->		
	<td align="center"><b>&nbsp;<a href="{U_PASEARCH}" class="gensmall"><img src="{SEARCH_IMG}" border="0" alt="{L_SEARCH}" align="middle" /></a>&nbsp;</b></td>
	<!-- ENDIF -->
	<!-- IF IS_AUTH_STATS -->	
	<td align="center"><b>&nbsp;<a href="{U_PASTATS}" class="gensmall"><img src="{STATS_IMG}" border="0" alt="{L_STATS}" align="middle" /></a>&nbsp;</b></td>
	<!-- ENDIF -->
	<!-- IF IS_AUTH_TOPLIST -->	
	<td align="center"><b>&nbsp;<a href="{U_TOPLIST}" class="gensmall"><img src="{TOPLIST_IMG}" border="0" alt="{L_TOPLIST}" align="middle" /></a>&nbsp;</b></td>
	<!-- ENDIF -->
	<!-- IF IS_AUTH_UPLOAD -->
	<td align="center"><b>&nbsp;<a href="{U_UPLOAD}" class="gensmall"><img src="{UPLOAD_IMG}" border="0" alt="{L_UPLOAD}" align="middle" /></a>&nbsp;</b></td>
	<!-- ENDIF -->	
	<!-- IF IS_AUTH_VIEWALL -->	
	<td align="center"><b>&nbsp;<a href="{U_VIEW_ALL}" class="gensmall"><img src="{VIEW_ALL_IMG}" border="0" alt="{L_VIEW_ALL}" align="middle" /></a>&nbsp;</b></td>	
	<!-- ENDIF -->	
	<!-- IF IS_AUTH_MCP -->	
	<td align="center"><b>&nbsp;<a href="{U_MCP}" class="gensmall"><img src="templates/PowerMetal/images/lang_english/icon_pa_modcp.gif" alt=""align="middle" /></a>&nbsp;</b></td>	
	<!-- ENDIF -->	
  </tr>
</table>



<table width="100%" height="30" border="0" cellpadding="2" cellspacing="0" class="table" align="center">
  <tr>
	<td width="100%" valign="top" colspan="2">