<?php

/**
 * This code is part of the FileManager software (www.gerd-tentler.de/tools/filemanager), copyright by
 * Gerd Tentler. Obtain permission before selling this code or hosting it on a commercial website or
 * redistributing it over the Internet or in any other medium. In all cases copyright must remain intact.
 */

include_once('FM_Tools.php');

/**
 * This class creates a text editor/viewer.
 *
 * @package FileManager
 * @subpackage class
 * @author Gerd Tentler
 */
class FM_Editor {

/* PRIVATE PROPERTIES ************************************************************************** */

	/**
	 * holds FileManager object
	 *
	 * @var FileManager
	 */
	var $_FileManager;

	/**
	 * use read-only mode
	 *
	 * @var boolean
	 */
	var $_readOnly;

/* PUBLIC METHODS ****************************************************************************** */

	/**
	 * constructor
	 *
	 * @param FileManager $FileManager
	 * @param boolean $readOnly			optional: use read-only mode
	 * @return FM_Editor
	 */
	function FM_Editor(&$FileManager, $readOnly = false) {
		$this->_FileManager =& $FileManager;
		$this->_readOnly = $readOnly;
	}

	/**
	 * view text editor
	 *
	 * @param FM_Entry $Entry		file entry object
	 */
	function view(&$Entry) {
		$this->_viewHeader($Entry);
		$this->_viewContent($Entry);
	}

/* PRIVATE METHODS ***************************************************************************** */

	/**
	 * view header
	 *
	 * @param FM_Entry $Entry		file entry object
	 */
	function _viewHeader(&$Entry) {
		$type = $this->_readOnly ? 'viewer' : 'editor';
		print "type:'$type',cont:'{$this->_FileManager->container}',";
		print "lang:'{$this->_FileManager->language}',id:'$Entry->id',";

		if(!$this->_readOnly) {
			print 'icons:[';
			print "{name:'list.gif',width:14,height:14,call:'back',caption:'" . addslashes(FM_Tools::getMsg('cmdViewList')) . "',style:'cursor:pointer'},";
			print "{name:'reset.gif',width:14,height:14,call:'edit',id:'$Entry->id',caption:'" . addslashes(FM_Tools::getMsg('cmdReset')) . "',style:'cursor:pointer'},";
			print "{name:'save.gif',width:14,height:14,exec:['fmLib.callOK','" . addslashes(FM_Tools::getMsg('msgSaveFile')) . "','','frmEdit'],caption:'" . addslashes(FM_Tools::getMsg('cmdSave')) . "',style:'cursor:pointer'}";
			print '],';
		}
	}

	/**
	 * view file content
	 *
	 * @param FM_Entry $Entry		file entry object
	 */
	function _viewContent(&$Entry) {
		list($language, $content) = $this->_getContent($Entry);
		print "text:{lang:'$language',content:'" . base64_encode($content) . "'}";
	}

	/**
	 * get content
	 *
	 * @param FM_Entry $Entry		file entry object
	 * @return array				script language and file content
	 */
	function _getContent(&$Entry) {
		$file = $Entry->getFile();
		$content = htmlspecialchars(FM_Tools::readLocalFile($file));

		switch(true) {

			case preg_match('/\.jse?$/i', $Entry->name):
				$language = 'javascript';
				break;

			case preg_match('/\.(php|p?html?)$/i', $Entry->name):
				$language = 'php';
				break;

			case preg_match('/\.s?html?$/i', $Entry->name):
				$language = 'html';
				break;

			case preg_match('/\.css$/i', $Entry->name):
				$language = 'css';
				break;

			case preg_match('/\.(pm|pr?l|cgi)$/i', $Entry->name):
				$language = 'perl';
				break;

			case preg_match('/\.(xml|xslt?|wsdl|xsd|xul|rdf)$/i', $Entry->name):
				$language = 'xml';
				break;

			case preg_match('/\.sql$/i', $Entry->name):
				$language = 'sql';
				break;

			default:
				$language = '';
		}
		return array($language, $content);
	}
}

?>