<?php

/**
 * This code is part of the FileManager software (www.gerd-tentler.de/tools/filemanager), copyright by
 * Gerd Tentler. Obtain permission before selling this code or hosting it on a commercial website or
 * redistributing it over the Internet or in any other medium. In all cases copyright must remain intact.
 */

include_once('FM_Entry.php');
include_once('FM_FileSystem.php');
include_once('FM_Tools.php');
include_once('FM_Image.php');
include_once('FM_Explorer.php');

/**
 * This class manages directory listings.
 *
 * @package FileManager
 * @subpackage class
 * @author Gerd Tentler
 */
class FM_Listing {

/* PUBLIC PROPERTIES *************************************************************************** */

	/**
	 * current directory path
	 *
	 * @var string
	 */
	var $curDir;

	/**
	 * holds current search string
	 *
	 * @var string
	 */
	var $searchString;

	/**
	 * listing width in pixels
	 *
	 * @var integer
	 */
	var $listWidth;

	/**
	 * view deleted files
	 *
	 * @var boolean
	 */
	var $viewDeleted;

	/**
	 * holds OS type
	 *
	 * @var string
	 */
	var $sysType;

	/**
	 * holds FileSystem object
	 *
	 * @var FM_FileSystem
	 */
	var $FileSystem;

	/**
	 * holds FileManager object
	 *
	 * @var FileManager
	 */
	var $FileManager;

	/**
	 * holds Explorer object
	 *
	 * @var FM_Explorer
	 */
	var $Explorer;

/* PRIVATE PROPERTIES ************************************************************************** */

	/**
	 * cell width in pixels
	 *
	 * @var integer
	 */
	var $_cellWidth;

	/**
	 * number of cells in a table row
	 *
	 * @var integer
	 */
	var $_cellsPerRow;

	/**
	 * holds current listing (entry objects)
	 *
	 * @var array
	 */
	var $_entries;

	/**
	 * current folder index
	 *
	 * @var string
	 */
	var $_folderId;

	/**
	 * file extensions
	 *
	 * @var array
	 */
	var $_extensions = array(
		'text'         => 'txt|[sp]?html?|css|jse?|php\d*|pr?l|pm|cgi|inc|csv|py|asp|ini|sql|cfg|bat|sh|json|xml|xslt?|xsd|xul|rdf|dtd|wsdl',
		'image'        => 'gif|jpe?g|png|w?bmp|tiff?|pict?|ico',
		'archive'      => 'zip|[rtj]ar|t?gz|t?bz2?|arj|ace|lzh|lha|xxe|uue?|iso|cab|r\d+',
		'program'      => 'exe|com|pif|scr|app',
		'acrobat'      => 'pd[fx]',
		'word'         => 'do[ct]x?|do[ct]html',
		'excel'        => 'xl[stwv]x?|xl[st]html|slk|xlsx',
		'powerpoint'   => 'pp[ts]x?',
		'video'        => 'mpe?g|avi|mov|wmv|flv|swf|rm|mp4|3gp',
		'audio'        => 'wav|mp[321]|voc|midi?|mod|ac3|wma|m4a|aiff?|au|aac|og[ga]',
		FM_EXT_DELETED => 'deleted'
	);

/* PUBLIC METHODS ****************************************************************************** */

	/**
	 * constructor
	 *
	 * @param FileManager $FileManager		file manager object
	 * @param string $dir					optional: directory path
	 * @return FM_Listing
	 */
	function FM_Listing(&$FileManager, $dir = '') {
		$this->FileManager = $FileManager;
		$this->FileSystem = new FM_FileSystem($FileManager, ($FileManager->encoding == 'UTF-8'));
		$this->curDir = ($dir != '') ? $dir : $this->FileManager->startDir;
		$this->listWidth = $this->FileManager->fmWidth - $this->FileManager->explorerWidth - 2;
		$this->_cellsPerRow = floor($this->listWidth / 100);
		$this->_cellWidth = number_format(100 / $this->_cellsPerRow, 2);
	}

	/**
	 * view current listing
	 *
	 * @return boolean
	 */
	function view() {
		if($this->searchString != '') {
			$this->_folderId = 'search';
			/* do not cache search results! */
			unset($this->_entries[$this->_folderId]);
		}
		else $this->_folderId = md5($this->curDir);

		if(!isset($this->_entries[$this->_folderId])) {
			$ok = $this->readDir($this->curDir);
		}
		else $ok = true;

		$this->_viewHeader();
		print $this->_makeCaptions() . ',';

		$startDir = $this->FileManager->startDir;
		$subdir = (
			strlen($this->curDir) > strlen($startDir) &&
			strncmp($this->curDir, $startDir, strlen($startDir)) == 0
		);
		$items = array();

		if($subdir || ($this->searchString != '' && $this->FileManager->enableSearch)) {
			$items[] = $this->_viewDirUp();
		}

		if(is_array($this->_entries[$this->_folderId])) {
			foreach($this->_entries[$this->_folderId] as $Entry) {
				$items[] = $Entry->view();
			}
		}
		print 'items:[' . implode(',', $items) . ']';

		$this->_viewFooter();
		return $ok;
	}

	/**
	 * refresh listing
	 *
	 * @return boolean
	 */
	function refresh() {
		$this->removeCacheFolder($this->_folderId);
		return $this->view();
	}

	/**
	 * remove cache folder(s)
	 *
	 * @param string $id	optional: folder ID
	 */
	function removeCacheFolder($id = '') {
		if($id != '') unset($this->_entries[$id]);
		else $this->_entries = array();
	}

	/**
	 * get entry by ID
	 *
	 * @param integer $id		entry ID
	 * @return mixed			entry object or false on failure
	 */
	function &getEntry($id) {
		if(is_array($this->_entries[$this->_folderId])) {
			foreach(array_keys($this->_entries[$this->_folderId]) as $ind) {
				$Entry = $this->_entries[$this->_folderId][$ind];
				if($Entry->id == $id) return $Entry;
			}
		}
		return false;
	}

	/**
	 * get entry by file/directory name
	 *
	 * @param string $name		file/directory name
	 * @return mixed			entry object or false on failure
	 */
	function &getEntryByName($name) {
		if(is_array($this->_entries[$this->_folderId])) {
			foreach(array_keys($this->_entries[$this->_folderId]) as $ind) {
				$Entry = $this->_entries[$this->_folderId][$ind];
				if($Entry->name == $name) return $Entry;
			}
		}
		$file = $this->curDir . '/' . $name;
		if(file_exists($file)) return $this->_addEntry($file);
		else return false;
	}

	/**
	 * get all entries
	 *
	 * @return FM_Entry[]	entry objects
	 */
	function &getEntries() {
		return $this->_entries[$this->_folderId];
	}

	/**
	 * move uploaded file to current directory
	 *
	 * @param string $src		source file path
	 * @param string $newName	new file name
	 * @return mixed			file name on success, else boolean false
	 */
	function upload($src, $newName) {
		if($this->FileManager->hideSystemFiles && $newName[0] == '.') {
			$this->FileManager->Log->add(FM_Tools::getMsg('errAccess') . ": $newName", 'error');
			return false;
		}
		$ext = strtolower(end(explode('.', $newName)));

		/* check if file extension is allowed */
		if($ext != '') {
			$hidden = $this->FileManager->hideFileTypes;
			$allowed = $this->FileManager->allowFileTypes;

			if(in_array($ext, $hidden) || ($allowed && !in_array($ext, $allowed))) {
				$this->FileManager->Log->add(FM_Tools::getMsg('errAccess') . ": $newName", 'error');
				return false;
			}
		}

		/* check if image has to be resized */
		if($this->FileManager->maxImageWidth > 0 || $this->FileManager->maxImageHeight > 0) {
			if(in_array($ext, array('jpg', 'jpeg', 'png', 'gif'))) {
				if($Entry = new FM_Entry($this, true)) {
					$Entry->path = $src;
					$Entry->name = FM_Tools::basename($src);
					$Entry->size = @filesize($src);
					$width = $this->FileManager->maxImageWidth;
					$height = $this->FileManager->maxImageHeight;
					$Image = new FM_Image($Entry, $width, $height);
					if($error = $Image->save()) $this->FileManager->Log->add($error, 'error');
				}
			}
		}

		/* check if file name has to be modified */
		$fmReplSpaces = ($this->FileManager->replSpacesUpload || $_REQUEST['fmReplSpaces']);
		$fmLowerCase = ($this->FileManager->lowerCaseUpload || $_REQUEST['fmLowerCase']);
		if($fmReplSpaces) $newName = str_replace(' ', '_', $newName);
		if($fmLowerCase) $newName = strtolower($newName);

		if($this->FileManager->createBackups) {
			$this->_createBackup($newName);
		}
		$dst = $this->curDir . '/' . $newName;
		return $this->FileSystem->putFile($src, $dst) ? $newName : false;
	}

	/**
	 * remove directory
	 *
	 * @param string $dir		directory path
	 * @return boolean
	 */
	function remDir($dir) {
		return $this->FileSystem->removeDir($dir);
	}

	/**
	 * create directory
	 *
	 * @param string $dir		directory path
	 * @return boolean
	 */
	function mkDir($dir) {
		return $this->FileSystem->makeDir($dir);
	}

	/**
	 * perform search
	 *
	 * @param string $text		search string
	 */
	function performSearch($text) {
		if($this->FileSystem->useUtf8) {
			$text = FM_Tools::utf8Encode($text, $this->FileManager->encoding);
		}
		else $text = FM_Tools::utf8Decode($text, $this->FileManager->encoding);

		$this->searchString = $text;
		$this->view();
	}

	/**
	 * check if directory access is allowed
	 *
	 * @param string $dir		directory path
	 * @return boolean
	 */
	function isAllowedDir($dir) {
		if(FM_Tools::dirname($dir) == $this->FileManager->startDir) {
			$allowedDirs = $this->FileManager->startSubDirs;
			if($allowedDirs && is_array($allowedDirs)) {
				if(!in_array(FM_Tools::basename($dir), $allowedDirs)) {
					return false;
				}
			}
		}
		$hideDirs = $this->FileManager->hideDirNames;
		if($hideDirs && is_array($hideDirs)) {
			if(in_array(FM_Tools::basename($dir), $hideDirs)) {
				return false;
			}
		}
		return true;
	}

	/**
	 * read directory entries
	 *
	 * @param string $dir		directory path
	 * @return boolean
	 */
	function readDir($dir) {
		if(!$this->sysType) {
			$this->sysType = $this->FileSystem->getSystemType();
			$this->sysType = str_replace('/', ' ', $this->sysType);
		}
		$startDir = $this->FileManager->startDir;

		if(strncmp($dir, $startDir, strlen($startDir)) != 0) {
			$dir = $this->curDir = $startDir;
		}
		if(!$this->isAllowedDir($dir)) return false;

		$list = $this->FileSystem->readDir($dir);

		if(!is_array($list)) {
			if($this->curDir != $startDir) {
				$this->curDir = $startDir;
				$this->readDir($startDir);
			}
			return false;
		}

		if($this->_folderId != 'search') {
			$this->_entries[$this->_folderId] = array();
		}

		foreach($list as $row) {
			$Entry = $this->_addEntry($row, $dir);
			if(is_object($Entry)) {
				if($this->searchString != '' && $Entry->isDir()) {
					$this->readDir($Entry->path);
				}
			}
			else if(is_string($Entry)) $this->readDir("$dir/$Entry");
		}
		return true;
	}

/* PRIVATE METHODS ***************************************************************************** */

	/**
	 * view header
	 */
	function _viewHeader() {
		print $this->_makeHeader() . ',icons:[';

		if($this->FileManager->enableRestore) {
			if($this->viewDeleted) {
				$icon = 'hideDeleted.gif';
				$cmd = FM_Tools::getMsg('cmdHideDeleted');
			}
			else {
				$icon = 'viewDeleted.gif';
				$cmd = FM_Tools::getMsg('cmdViewDeleted');
			}
			print "{name:'$icon',width:11,height:14,call:'toggleDeleted',caption:'" . addslashes($cmd) . "',style:'cursor:pointer'},";
		}

		if($this->FileManager->enableSearch) {
			print "{name:'search.gif',width:13,height:14,dialog:'fmSearch',caption:'" . addslashes(FM_Tools::getMsg('cmdSearch')) . "',style:'cursor:pointer'},";
		}
		else if(!$this->FileManager->hideDisabledIcons) {
			$error = addslashes(FM_Tools::getMsg('cmdSearch') . ': ' . FM_Tools::getMsg('errDisabled'));
			print "{name:'search_x.gif',width:13,height:14,dialog:'fmError',caption:['" . addslashes(FM_Tools::getMsg('error')) . "', '$error'],style:''},";
		}

		if($this->FileManager->enableNewDir && $this->searchString == '') {
			print "{name:'newDir.gif',width:15,height:14,dialog:'fmNewDir',caption:'" . addslashes(FM_Tools::getMsg('cmdNewDir')) . "',style:'cursor:pointer'},";
		}
		else if(!$this->FileManager->hideDisabledIcons) {
			$error = addslashes(FM_Tools::getMsg('cmdNewDir') . ': ' . FM_Tools::getMsg('errDisabled'));
			print "{name:'newDir_x.gif',width:15,height:14,dialog:'fmError',caption:['" . addslashes(FM_Tools::getMsg('error')) . "', '$error'],style:''},";
		}

		if($this->FileManager->enableUpload && $this->searchString == '') {
			$dialogId = ($this->FileManager->uploadEngine == 'java') ? 'fmJavaUpload' : 'fmNewFile';
			print "{name:'new.gif',width:11,height:14,dialog:'$dialogId',caption:'" . addslashes(FM_Tools::getMsg('cmdUploadFile')) . "',style:'cursor:pointer'},";
			print "{name:'saveFromUrl.gif',width:11,height:14,dialog:'fmSaveFromUrl',caption:'" . addslashes(FM_Tools::getMsg('cmdSaveFromUrl')) . "',style:'cursor:pointer'}";
		}
		else if(!$this->FileManager->hideDisabledIcons) {
			$error = addslashes(FM_Tools::getMsg('cmdUploadFile') . ': ' . FM_Tools::getMsg('errDisabled'));
			print "{name:'new_x.gif',width:11,height:14,dialog:'fmError',caption:['" . addslashes(FM_Tools::getMsg('error')) . "', '$error'],style:''},";
			$error = addslashes(FM_Tools::getMsg('cmdSaveFromUrl') . ': ' . FM_Tools::getMsg('errDisabled'));
			print "{name:'new_x.gif',width:11,height:14,dialog:'fmError',caption:['" . addslashes(FM_Tools::getMsg('error')) . "', '$error'],style:''}";
		}
		print '],';

		if($this->FileManager->explorerWidth > 0) {
			print 'explorer:{width:' . (int) $this->FileManager->explorerWidth . '},';
		}
		print 'entries:{width:' . (int) $this->listWidth . ',';
		print "cellsPerRow:$this->_cellsPerRow,cellWidth:$this->_cellWidth,";
	}

	/**
	 * view footer
	 */
	function _viewFooter() {
		print '}';
	}

	/**
	 * view directory up icon
	 *
	 * @return string
	 */
	function _viewDirUp() {
		$Entry = new FM_Entry($this);
		$Entry->icon = 'cdup';
		$Entry->name = ($this->searchString == '') ? '..' : '';
		return $Entry->view();
	}

	/**
	 * make header
	 *
	 * @return string
	 */
	function _makeHeader() {
		$path = $this->FileSystem->checkPath($this->curDir);
		$path = ($path == '') ? '/' : FM_Tools::utf8Encode($path, $this->FileManager->encoding);
		$searchString = FM_Tools::utf8Encode($this->searchString, $this->FileManager->encoding);

		$json = "type:'list',cont:'{$this->FileManager->container}',lang:'{$this->FileManager->language}',";
		$json .= 'width:' . (int) $this->FileManager->fmWidth . ',';
		$json .= "search:'" . addslashes($searchString) . "',";
		$json .= "path:'" . addslashes($path) . "'";

		if(!$this->FileManager->hideSystemType) {
			if(FM_Tools::strlen($this->sysType) > 15) {
				$sysType = FM_Tools::substr($this->sysType, 0, 15) . '...';
			}
			else $sysType = $this->sysType;
			$sysType = FM_Tools::utf8Encode($sysType, $this->FileManager->encoding);
			$json .= ",sysType:'" . addslashes($sysType) . "'";
		}
		return $json;
	}

	/**
	 * add listing entry
	 *
	 * @param string $file			file path or entry in FTP listing
	 * @param string $dir			optional: directory path
	 * @return mixed				entry object, directory name or false
	 */
	function &_addEntry($file, $dir = '') {
		if($dir == '') $dir = $this->curDir;

		/* if search is performed, $Entry will just contain the directory name */
		$Entry = $this->_createEntry($file, $dir);

		if(is_object($Entry)) {
			if($Entry->isDeleted()) {
				if(!$this->FileManager->enableRestore || !$this->viewDeleted) {
					return false;
				}
			}
			$ext = strtolower(end(explode('.', $Entry->name)));

			if($Entry->isDir()) {
				/* check if directory access is allowed */
				if(!$this->isAllowedDir($Entry->path)) return false;
			}
			else {
				/* check if file extension is allowed */
				if($ext != '') {
					$hidden = $this->FileManager->hideFileTypes;
					$allowed = $this->FileManager->allowFileTypes;

					if(in_array($ext, $hidden) || ($allowed && !in_array($ext, $allowed))) {
						return false;
					}
				}
			}
			$Entry->thumbHash = '';

			if(!$Entry->icon) {
				foreach($this->_extensions as $key => $types) {
					if(preg_match('/^(' . $types . ')$/i', $ext)) {
						$Entry->icon = $key;
						break;
					}
				}
				if(!$Entry->icon) $Entry->icon = 'file';

				if($this->FileManager->enableImagePreview) {
					if(in_array($ext, array('jpeg', 'jpg', 'gif', 'png'))) {
						$Image = new FM_Image($Entry);

						if(in_array($Image->getType(), array(1, 2, 3))) {
							$Entry->thumbHash = md5($Entry->path . time());
							$Entry->width = $Image->getWidth();
							$Entry->height = $Image->getHeight();
						}
					}
				}
			}
			$Entry->id = count($this->_entries[$this->_folderId]);
			$this->_entries[$this->_folderId][] = $Entry;
		}
		else if(is_string($Entry)) {
			/* check if directory access is allowed */
			if(!$this->isAllowedDir($Entry)) return false;
		}
		return $Entry;
	}

	/**
	 * create entry, but don't add it to the current listing
	 *
	 * @param string $file			local file path or FTP listing row
	 * @param string $dir			directory path
	 * @return mixed				entry object, directory name or false
	 */
	function &_createEntry($file, $dir) {
		$Entry = new FM_Entry($this);
		if($Entry->setProperties($file, $dir)) {
			if($this->searchString != '') {
				if(stristr($Entry->name, $this->searchString)) {
					return $Entry;
				}
				else if($Entry->isDir()) return $Entry->name;
			}
			else if(!$this->FileManager->hideSystemFiles || $Entry->name[0] != '.') {
				return $Entry;
			}
		}
		return false;
	}

	/**
	 * create backup by renaming original file
	 *
	 * @param string $fileName		file name
	 */
	function _createBackup($fileName) {
		$parts = explode('.', $fileName);
		if(count($parts) > 1) {
			$ext = '.' . end($parts);
			$name = FM_Tools::substr($fileName, 0, FM_Tools::strlen($fileName) - FM_Tools::strlen($ext));
		}
		else {
			$ext = '';
			$name = $fileName;
		}
		$backupName = $fileName;
		$cnt = 0;

		while($this->getEntryByName($backupName)) {
			$cnt++;
			$backupName = $name . "($cnt)$ext";
		}

		if($cnt > 0) {
			$this->FileSystem->rename($this->curDir . '/' . $fileName, $this->curDir . '/' . $backupName);
		}
	}

	/**
	 * make column captions
	 *
	 * @return string
	 */
	function _makeCaptions() {
		$items = array($this->_makeCaption('isDir', ''), $this->_makeCaption('name', FM_Tools::getMsg('name')));
		if(!in_array('size', $this->FileManager->hideColumns)) $items[] = $this->_makeCaption('size', FM_Tools::getMsg('size'));
		if(!in_array('changed', $this->FileManager->hideColumns)) $items[] = $this->_makeCaption('changed', FM_Tools::getMsg('lastChange'));
		if(!in_array('permissions', $this->FileManager->hideColumns)) $items[] = $this->_makeCaption('permissions', FM_Tools::getMsg('permissions'));
		if(!in_array('owner', $this->FileManager->hideColumns)) $items[] = $this->_makeCaption('owner', FM_Tools::getMsg('owner'));
		if(!in_array('group', $this->FileManager->hideColumns)) $items[] = $this->_makeCaption('group', FM_Tools::getMsg('group'));
		$cont = $this->FileManager->container;
		$icon = 'menu.gif';
		$tooltip = addslashes(FM_Tools::getMsg('cmdSelAction'));
		$style = 'cursor:pointer';
		$action = "exec:['fmLib.viewMenu','bulkAction','$cont']";
		return 'captions:[' . implode(',', $items) . "],lastCol:{icon:'$icon',style:'$style',$action,tooltip:'$tooltip'}";
	}

	/**
	 * make caption
	 *
	 * @param string $name			column name
	 * @param string $title			column title
	 * @return string
	 */
	function _makeCaption($name, $title) {
		return "{name:'$name',caption:'" . addslashes($title) . "'}";
	}
}

?>