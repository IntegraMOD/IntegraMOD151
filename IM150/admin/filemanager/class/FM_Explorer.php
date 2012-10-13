<?php

/**
 * This code is part of the FileManager software (www.gerd-tentler.de/tools/filemanager), copyright by
 * Gerd Tentler. Obtain permission before selling this code or hosting it on a commercial website or
 * redistributing it over the Internet or in any other medium. In all cases copyright must remain intact.
 */

include_once('FM_Tools.php');

/**
 * This class creates a directory explorer.
 *
 * @package FileManager
 * @subpackage class
 * @author Gerd Tentler
 */
class FM_Explorer {

/* PRIVATE PROPERTIES ************************************************************************** */

	/**
	 * stores folder information
	 *
	 * @var array
	 */
	var $_folders;

	/**
	 * explorer width
	 *
	 * @var integer
	 */
	var $_width;

	/**
	 * expand all folders
	 *
	 * @var boolean
	 */
	var $_expandAll;

	/**
	 * holds FileManager object
	 *
	 * @var FileManager
	 */
	var $_FileManager;

	/**
	 * holds listing object
	 *
	 * @var FM_Listing
	 */
	var $_Listing;

	/**
	 * system type
	 *
	 * @var string
	 */
	var $_sysType;

/* PUBLIC METHODS ****************************************************************************** */

	/**
	 * constructor
	 *
	 * @param FM_Listing $Listing
	 * @return FM_Explorer
	 */
	function FM_Explorer(&$Listing) {
		$this->_Listing =& $Listing;
		$this->_FileManager =& $this->_Listing->FileManager;
		$this->_width = $this->_FileManager->explorerWidth;
		$this->_expandAll = $this->_FileManager->explorerExpandAll;

		if($this->_FileManager->ftpHost) {
			$this->_sysType = preg_match('/winnt|windows/i', $this->_Listing->_sysType) ? 'Windows' : 'UNIX';
		}
		else $this->_sysType = 'PHP';
	}

	/**
	 * make directory explorer
	 *
	 * @return string
	 */
	function make() {
		$start = FM_Tools::microtime();
		$explorer = $this->_makeHeader();
		$explorer .= $this->_makeContent();
		$explorer .= $this->_makeFooter();
		return $explorer;
	}

	/**
	 * get all folders
	 *
	 * @return array
	 */
	function getFolders() {
		if(!$this->_folders) {
			$this->_folders = $this->_readFolders($this->_FileManager->startDir);
			$paths = array();
			foreach($this->_folders as $key => $row) $paths[$key] = strtolower($row[1]);
			array_multisort($paths, SORT_ASC, SORT_REGULAR, $this->_folders);
		}
		return $this->_folders;
	}

	/**
	 * get single folder
	 *
	 * @param integer $id
	 * @return array
	 */
	function getFolder($id) {
		$folders = $this->getFolders();
		return $folders[$id];
	}

/* PRIVATE METHODS ***************************************************************************** */

	/**
	 * make header
	 *
	 * @return string
	 */
	function _makeHeader() {
		return '{width:' . (int) $this->_width . ',expandAll:' . (int) $this->_expandAll . ',items:[';
	}

	/**
	 * make content
	 *
	 * @return string
	 */
	function _makeContent() {
		if(is_array($this->getFolders())) {
			$items = array();

			foreach($this->_folders as $id => $dir) {
				$name = FM_Tools::basename($dir[1]);
				$name = ($name == '') ? '/' : FM_Tools::utf8Encode($name, $this->_FileManager->encoding);
				$item = "{id:$id,";
				$item .= "level:$dir[0],";
				$item .= "name:'" . addslashes($name) . "',";
				$item .= "hash:'" . md5($dir[1]) . "'}";
				$items[] = $item;
			}
			return implode(',', $items);
		}
	}

	/**
	 * make footer
	 *
	 * @return string
	 */
	function _makeFooter() {
		return ']}';
	}

	/**
	 * read all sub-folders
	 *
	 * @param string $dir		directory path
	 * @param integer $level	optional: directory level
	 * @return array			folders (level, path)
	 */
	function _readFolders($dir, $level = 0) {
		$dirs = array();

		if($level == 0) {
			$dirs[] = array(1, $dir);
			$dirs = array_merge($dirs, $this->_readFolders($dir, 1));
		}
		else if($list = $this->_Listing->FileSystem->readDir($dir, true)) {
			if(is_array($list)) foreach($list as $file) {
				$path = '';

				switch($this->_sysType) {

					case 'UNIX':
						if(preg_match($this->_Listing->FileSystem->unixRow, $file, $m)) {
							if($m[7] != '..' && $m[7] != '.' && $m[1][0] == 'd') {
								$path = $dir . '/' . $m[7];
							}
						}
						break;

					case 'Windows':
						if(preg_match($this->_Listing->FileSystem->windowsRow, $file, $m)) {
							if($m[4] != '..' && $m[4] != '.' && strtoupper($m[3]) == '<DIR>') {
								$path = $dir . '/' . $m[4];
							}
						}
						break;

					case 'PHP':
						$filename = FM_Tools::basename($file);
						if($filename != '.' && $filename != '..' && is_dir($file)) {
							$path = $file;
						}
						break;
				}

				if($path != '') {
					if(!$this->_Listing->isAllowedDir($path)) continue;
					$dirs[] = array($level + 1, $path);
					$dirs = array_merge($dirs, $this->_readFolders($path, $level + 1));
				}
			}
		}
		return $dirs;
	}
}

?>