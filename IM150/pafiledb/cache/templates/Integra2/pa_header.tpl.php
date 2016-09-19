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
			<?php if ($this->_tpldata['.'][0]['IS_AUTH_SEARCH']) {  ?>		
			<a class="icon_search" href="<?php echo $this->_tpldata['.'][0]['U_PASEARCH']; ?>" class="gensmall"><span><?php echo ((isset($this->_tpldata['.'][0]['L_SEARCH'])) ? $this->_tpldata['.'][0]['L_SEARCH'] : ((isset($lang['SEARCH'])) ? $lang['SEARCH'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'SEARCH'))) . ' 	}')); ?></span></a>
			<?php }if ($this->_tpldata['.'][0]['IS_AUTH_STATS']) {  ?>	
			<a class="icon_stats" href="<?php echo $this->_tpldata['.'][0]['U_PASTATS']; ?>" class="gensmall"><span><?php echo ((isset($this->_tpldata['.'][0]['L_STATS'])) ? $this->_tpldata['.'][0]['L_STATS'] : ((isset($lang['STATS'])) ? $lang['STATS'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'STATS'))) . ' 	}')); ?></span></a>
			<?php }if ($this->_tpldata['.'][0]['IS_AUTH_TOPLIST']) {  ?>	
			<a class="icon_toplist" href="<?php echo $this->_tpldata['.'][0]['U_TOPLIST']; ?>" class="gensmall"><span><?php echo ((isset($this->_tpldata['.'][0]['L_TOPLIST'])) ? $this->_tpldata['.'][0]['L_TOPLIST'] : ((isset($lang['TOPLIST'])) ? $lang['TOPLIST'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'TOPLIST'))) . ' 	}')); ?></span></a>
			<?php }if ($this->_tpldata['.'][0]['IS_AUTH_UPLOAD']) {  ?>
			<a class="icon_upload" href="<?php echo $this->_tpldata['.'][0]['U_UPLOAD']; ?>" class="gensmall"><span><?php echo ((isset($this->_tpldata['.'][0]['L_UPLOAD'])) ? $this->_tpldata['.'][0]['L_UPLOAD'] : ((isset($lang['UPLOAD'])) ? $lang['UPLOAD'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'UPLOAD'))) . ' 	}')); ?></span></a>
			<?php }if ($this->_tpldata['.'][0]['IS_AUTH_VIEWALL']) {  ?>	
			<a class="icon_va" href="<?php echo $this->_tpldata['.'][0]['U_VIEW_ALL']; ?>" class="gensmall"><span><?php echo ((isset($this->_tpldata['.'][0]['L_VIEW_ALL'])) ? $this->_tpldata['.'][0]['L_VIEW_ALL'] : ((isset($lang['VIEW_ALL'])) ? $lang['VIEW_ALL'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'VIEW_ALL'))) . ' 	}')); ?></span></a>	
			<?php }if ($this->_tpldata['.'][0]['IS_AUTH_MCP']) {  ?>	
			<a class="icon_mod" href="<?php echo $this->_tpldata['.'][0]['U_MCP']; ?>" class="gensmall"><span><?php echo ((isset($this->_tpldata['.'][0]['L_MCP_LINK'])) ? $this->_tpldata['.'][0]['L_MCP_LINK'] : ((isset($lang['MCP_LINK'])) ? $lang['MCP_LINK'] : '{ ' . ucfirst(strtolower(str_replace('_', ' ', 'MCP_LINK'))) . ' 	}')); ?></span></a>	
			<?php } ?>	
			</td>
  		</tr>
	</table>



<table width="100%" height="30" border="0" cellpadding="2" cellspacing="0" class="table" align="center">
  <tr>
	<td width="100%" valign="top" colspan="2">