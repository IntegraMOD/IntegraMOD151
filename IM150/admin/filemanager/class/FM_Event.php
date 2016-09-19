<?php

/**
 * This code is part of the FileManager software (www.gerd-tentler.de/tools/filemanager), copyright by
 * Gerd Tentler. Obtain permission before selling this code or hosting it on a commercial website or
 * redistributing it over the Internet or in any other medium. In all cases copyright must remain intact.
 */

include_once('FM_Entry.php');
include_once('FM_Editor.php');
include_once('FM_Explorer.php');
include_once('FM_Tools.php');
include_once('FM_Zip.php');

/**
 * This class handles all user and system events.
 *
 * @package FileManager
 * @subpackage class
 * @author Gerd Tentler
 */
class FM_Event {

/* PRIVATE PROPERTIES ************************************************************************** */

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

/* PUBLIC METHODS ****************************************************************************** */

	/**
	 * constructor
	 *
	 * @param FileManager $FileManager
	 * @return FM_Event
	 */
	function FM_Event(&$FileManager) {
		$this->_FileManager =& $FileManager;
		$this->_Listing =& $FileManager->getListing();
	}

	/**
	 * handle event
	 *
	 * @param string $type		event type
	 * @param string $id		optional: object ID(s)
	 * @param string $param		optional: additional parameter(s)
	 * @return string
	 */
	function handle($type, $id = '', $param = '') {
		switch($type) {

			case 'open':
				return $this->_openDir($id);

			case 'expOpen':
				return $this->_openExpDir($id);

			case 'parent':
				return $this->_parentDir();

			case 'rename':
				return $this->_rename($id, $param);

			case 'delete':
				return $this->_delete($id);

			case 'restore':
				return $this->_restore($id);

			case 'newDir':
				return $this->_newDir($param);

			case 'newFile':
				return $this->_newFile();

			case 'refresh':
				return $this->_refresh();

			case 'permissions':
				return $this->_changePermissions($id, $_REQUEST['fmPerms']);

			case 'edit':
				return $this->_editFile($id);

			case 'search':
				return $this->_search($param);

			case 'saveFromUrl':
				return $this->_saveFromUrl($param);

			case 'upload':
				return $this->_upload();

			case 'toggleDeleted':
				return $this->_toggleDeleted();

			case 'getUserPerms':
				return $this->_getUserPerms();

			case 'getMessages':
				return $this->_getMessages();

			case 'getContSettings':
				return $this->_getContSettings();

			case 'getThumbnail':
				return $this->_getThumbnail($id);

			case 'getCachedImage':
				return $this->_getCachedImage($id);

			case 'getFile':
				return $this->_getFile($id, 'attachment', $this->_FileManager->enableDownload);

			case 'getFiles':
				$files = $this->_getFiles(explode(',', $id));
				return $this->_sendZip($files);

			case 'loadFile':
				return $this->_getFile($id, 'inline');

			case 'readTextFile':
				return $this->_readTextFile($id);

			case 'getExplorer':
				return $this->_getExplorer();

			case 'move':
				if($this->_FileManager->enableMove) {
					return $this->_move($id, $param);
				}
				$this->_Listing->view();
				return '';

			case 'copy':
				if($this->_FileManager->enableCopy) {
					return $this->_move($id, $param, true);
				}
				$this->_Listing->view();
				return '';

			case 'rotateLeft':
				return $this->_rotateImage($id, 90);

			case 'rotateRight':
				return $this->_rotateImage($id, 270);

			case 'jupload':
				return $this->_createJavaUploader();

			case '':
				$this->_Listing->view();
				$postMaxSize = ini_get('post_max_size');
				$error = "PHP post_max_size = $postMaxSize";
				$this->_FileManager->Log->add($error, 'error');
				return $error;
		}
		$this->_Listing->view();
		return '';
	}

/* PRIVATE METHODS ***************************************************************************** */

	/**
	 * open directory
	 *
	 * @param integer $id
	 * @return string
	 */
	function _openDir($id) {
		if($Entry =& $this->_Listing->getEntry($id)) {
			if($Entry->isDir()) {
				$this->_Listing->curDir = $Entry->path;
				$this->_Listing->searchString = '';

				if(!$this->_Listing->view()) {
					return FM_Tools::getMsg('errOpen', $Entry->name);
				}
			}
		}
		return '';
	}

	/**
	 * open explorer directory
	 *
	 * @param integer $id
	 * @return string
	 */
	function _openExpDir($id) {
		if(!$this->_Listing->Explorer) {
			$this->_Listing->Explorer = new FM_Explorer($this->_Listing);
		}
		if($folder = $this->_Listing->Explorer->getFolder($id)) {
			$this->_Listing->curDir = $folder[1];
			$this->_Listing->searchString = '';

			if(!$this->_Listing->view()) {
				return FM_Tools::getMsg('errOpen', FM_Tools::basename($folder[1]));
			}
		}
		return '';
	}

	/**
	 * return to parent directory
	 */
	function _parentDir() {
		$this->_Listing->curDir = preg_replace('%/[^/]+$%', '', $this->_Listing->curDir);
		$this->_Listing->searchString = '';
		$this->_Listing->view();
	}

	/**
	 * rename file / directory
	 *
	 * @param integer $id
	 * @param string $name
	 * @return string
	 */
	function _rename($id, $name) {
		$error = '';
		if($this->_FileManager->enableRename && $name != '' && $id != '') {
			if($Entry =& $this->_Listing->getEntry($id)) {
				$path = FM_Tools::dirname($Entry->path);
				if(get_magic_quotes_gpc()) $name = stripslashes($name);
				$name = FM_Tools::basename($name);

				if($Entry->rename("$path/$name")) {
					if($Entry->isDir()) $this->_Listing->Explorer = null;
				}
				else $error = FM_Tools::getMsg('errRename', "$Entry->name &raquo; $name");
			}
		}
		$this->_Listing->refresh();
		return $error;
	}

	/**
	 * delete files / directories
	 *
	 * @param string $ids
	 * @return string
	 */
	function _delete($ids) {
		$errors = array();
		if($this->_FileManager->enableDelete && $ids != '') {
			foreach(explode(',', $ids) as $id) {
				if($Entry =& $this->_Listing->getEntry($id)) {
					if($Entry->isDir()) {
						if(!$this->_Listing->remDir($Entry->path)) {
							$errors[] = FM_Tools::getMsg('errDelete', $Entry->name);
						}
						else $this->_Listing->Explorer = null;
					}
					else if(!$Entry->deleteFile()) {
						$errors[] = FM_Tools::getMsg('errDelete', $Entry->name);
					}
				}
			}
		}
		$this->_Listing->refresh();
		return implode('<br/>', $errors);
	}

	/**
	 * restore files
	 *
	 * @param string $ids
	 * @return string
	 */
	function _restore($ids) {
		$errors = array();
		if($this->_FileManager->enableRestore && $ids != '') {
			foreach(explode(',', $ids) as $id) {
				if($Entry =& $this->_Listing->getEntry($id)) {
					if(!$Entry->restoreFile()) {
						$errors[] = FM_Tools::getMsg('errRestore', $Entry->name);
					}
				}
			}
		}
		$this->_Listing->refresh();
		return implode('<br/>', $errors);
	}

	/**
	 * create new directory
	 *
	 * @param string $name
	 * @return string
	 */
	function _newDir($name) {
		if($this->_FileManager->enableNewDir) {
			if($name != '') {
				if(get_magic_quotes_gpc()) $name = stripslashes($name);
				$name = str_replace('\\', '/', $name);
				$dirs = explode('/', $name);
				$dir = '';

				for($i = 0; $i < count($dirs); $i++) {
					if($dirs[$i] != '') {
						if($dir != '') $dir .= '/';
						$dir .= $dirs[$i];
						$curDir = $this->_Listing->curDir;

						if(!$this->_Listing->mkDir("$curDir/$dir", 0755)) {
							$this->_Listing->refresh();
							return FM_Tools::getMsg('errDirNew', $dir);
						}
						else {
							$this->_Listing->Explorer = null;
							if($this->_FileManager->defaultDirPermissions) {
								if(!$this->_Listing->FileSystem->changePerms("$curDir/$dir", $this->_FileManager->defaultDirPermissions)) {
									$this->_Listing->refresh();
									return FM_Tools::getMsg('errPermChange', $dir);
								}
							}
						}
					}
				}
			}
		}
		$this->_Listing->refresh();
		return '';
	}

	/**
	 * upload file(s) via PHP
	 *
	 * @return string
	 */
	function _newFile() {
		$errors = array();
		if($this->_FileManager->enableUpload) {
			$fmFile = $_FILES['fmFile'];
			$uploaded = array();

			if(is_array($fmFile)) {
				for($i = 0; $i < count($fmFile['size']); $i++) {
					$file = $fmFile['name'][$i];

					if($fmFile['size'][$i]) {
						if(($newFile = $this->_Listing->upload($fmFile['tmp_name'][$i], $file)) === false) {
							$errors[] = FM_Tools::getMsg('errSave', $file);
						}
						else {
							$uploaded[] = array(
								'path' => $this->_Listing->curDir . '/' . $newFile,
								'size' => $fmFile['size'][$i]
							);
							if($this->_FileManager->defaultFilePermissions) {
								$path = $this->_Listing->curDir . '/' . $newFile;
								if(!$this->_Listing->FileSystem->changePerms($path, $this->_FileManager->defaultFilePermissions)) {
									$errors[] = FM_Tools::getMsg('errPermChange', $newFile);
								}
							}
							if($this->_FileManager->uploadHook) {
								$info = end($uploaded);
								$this->_FileManager->callUploadHook($info['path'], $info['size']);
							}
						}
					}
					else if($file != '') {
						$maxFileSize = ini_get('upload_max_filesize');
						$postMaxSize = ini_get('post_max_size');
						$info = "PHP settings: upload_max_filesize = $maxFileSize, post_max_size = $postMaxSize";
						$errors[] = FM_Tools::getMsg('error', "$file = 0 B<br/>$info");
						$this->_FileManager->Log->add("Could not upload $file ($info)", 'error');
					}
				}
			}

			if($this->_FileManager->mailOnUpload && $uploaded) {
				$this->_FileManager->sendUploadInfo($uploaded);
			}
		}
		$this->_Listing->refresh();
		return implode('<br/>', $errors);
	}

	/**
	 * read file from URL and save it in current directory
	 *
	 * @param string $url
	 * @return string
	 */
	function _saveFromUrl($url) {
		if(!$this->_FileManager->enableUpload) {
			$this->_Listing->view();
			return 'Upload not allowed';
		}

		if($url == '') {
			$this->_Listing->view();
			return 'Missing URL';
		}
		$error = '';
		$newFile = FM_Tools::basename($url);
		$src = $this->_FileManager->getTmpDir() . '/' . $newFile;

		if(!$this->_Listing->FileSystem->saveFromUrl($url, $this->_FileManager->getTmpDir())) {
			$this->_Listing->view();
			return FM_Tools::getMsg('errOpen', $newFile);
		}

		if(($newFile = $this->_Listing->upload($src, $newFile)) === false) {
			$this->_Listing->view();
			return FM_Tools::getMsg('errSave', $newFile);
		}

		if($this->_FileManager->defaultFilePermissions) {
			$path = $this->_Listing->curDir . '/' . $newFile;
			if(!$this->_Listing->FileSystem->changePerms($path, $this->_FileManager->defaultFilePermissions)) {
				$error = FM_Tools::getMsg('errPermChange', $newFile);
			}
		}

		if($this->_FileManager->mailOnUpload || $this->_FileManager->uploadHook) {
			if($Entry = $this->_Listing->getEntryByName($newFile)) {
				if($this->_FileManager->mailOnUpload) {
					$fileInfo = array(
						'path' => $Entry->path,
						'size' => $Entry->size
					);
					$this->_FileManager->sendUploadInfo(array($fileInfo));
				}
				if($this->_FileManager->uploadHook) {
					$this->_FileManager->callUploadHook($Entry->path, $Entry->size);
				}
			}
		}
		$this->_Listing->refresh();
		return $error;
	}

	/**
	 * read file(s) from upload directory and save it in current directory;
	 * this method is used by the Java and Perl upload engines
	 *
	 * @return string
	 */
	function _upload() {
		if(!$this->_FileManager->enableUpload) {
			$this->_Listing->view();
			return 'Upload not allowed';
		}
		$errors = $uploaded = array();
		$uplDir = $this->_FileManager->getUploadDir();

		if($dp = @opendir($uplDir)) {
			while(($file = @readdir($dp)) !== false) {
				if($file != '.' && $file != '..') {
					if(($newFile = $this->_Listing->upload("$uplDir/$file", $file)) === false) {
						$errors[] = FM_Tools::getMsg('errSave', $file);
					}
					else {
						if($this->_FileManager->mailOnUpload || $this->_FileManager->uploadHook) {
							if($Entry = $this->_Listing->getEntryByName($newFile)) {
								$uploaded[] = array(
									'path' => $Entry->path,
									'size' => $Entry->size
								);
							}
						}
						if($this->_FileManager->defaultFilePermissions) {
							$path = $this->_Listing->curDir . '/' . $newFile;
							if(!$this->_Listing->FileSystem->changePerms($path, $this->_FileManager->defaultFilePermissions)) {
								$errors[] = FM_Tools::getMsg('errPermChange', $newFile);
							}
						}
						if($this->_FileManager->uploadHook && $uploaded) {
							$info = end($uploaded);
							$this->_FileManager->callUploadHook($info['path'], $info['size']);
						}
					}
				}
			}
			@closedir($dp);
		}

		if($this->_FileManager->mailOnUpload && $uploaded) {
			$this->_FileManager->sendUploadInfo($uploaded);
		}

		if($this->_FileManager->uploadEngine == 'java') {
			$this->_FileManager->cleanUploadDir();
		}
		else $this->_FileManager->removeUploadDir();

		$this->_Listing->refresh();
		return implode('<br/>', $errors);
	}

	/**
	 * refresh listing
	 */
	function _refresh() {
		$this->_Listing->Explorer = null;
		$this->_Listing->refresh();
	}

	/**
	 * change file / directory permissions
	 *
	 * @param string $ids
	 * @param array $perms
	 * @return string
	 */
	function _changePermissions($ids, $perms) {
		$errors = array();
		if($this->_FileManager->enablePermissions && is_array($perms) && $ids != '') {
			foreach(explode(',', $ids) as $id) {
				if($Entry =& $this->_Listing->getEntry($id)) {
					$mode = '';
					for($i = 0; $i < 9; $i++) {
						$mode .= $perms[$i] ? 1 : 0;
					}
					if(!$Entry->changePerms(bindec($mode))) {
						$errors[] = FM_Tools::getMsg('errPermChange', $Entry->name);
					}
				}
			}
		}
		$this->_Listing->refresh();
		return implode('<br/>', $errors);
	}

	/**
	 * edit file
	 *
	 * @param integer $id
	 * @return string
	 */
	function _editFile($id) {
		if($this->_FileManager->enableEdit && $id != '') {
			if($Entry =& $this->_Listing->getEntry($id)) {
				$fmText = FM_Tools::utf8Decode($_POST['fmText'], $this->_FileManager->encoding);
				if($fmText != '') {
					if(!$Entry->saveFile($fmText)) {
						$this->_Listing->refresh();
						return FM_Tools::getMsg('errSave', $Entry->name);
					}
					$this->_Listing->refresh();
				}
				else {
					$Editor = new FM_Editor($this->_FileManager);
					$Editor->view($Entry);
				}
			}
		}
		return '';
	}

	/**
	 * perform search
	 *
	 * @param string $value
	 */
	function _search($value) {
		$this->_Listing->performSearch($value);
	}

	/**
	 * view or hide deleted files
	 */
	function _toggleDeleted() {
		$this->_Listing->viewDeleted = !$this->_Listing->viewDeleted;
		$this->_Listing->removeCacheFolder();
		$this->_Listing->view();
	}

	/**
	 * get user permissions
	 */
	function _getUserPerms() {
		print '{';
		print 'download:' . (int) $this->_FileManager->enableDownload . ',';
		print 'bulkDownload:' . (int) $this->_FileManager->enableBulkDownload . ',';
		print 'upload:' . (int) $this->_FileManager->enableUpload . ',';
		print 'remove:' . (int) $this->_FileManager->enableDelete . ',';
		print 'restore:' . (int) $this->_FileManager->enableRestore . ',';
		print 'rename:' . (int) $this->_FileManager->enableRename . ',';
		print 'permissions:' . (int) $this->_FileManager->enablePermissions . ',';
		print 'edit:' . (int) $this->_FileManager->enableEdit . ',';
		print 'move:' . (int) $this->_FileManager->enableMove . ',';
		print 'copy:' . (int) $this->_FileManager->enableCopy . ',';
		print 'newDir:' . (int) $this->_FileManager->enableNewDir . ',';
		print 'mediaPlayer:' . (int) $this->_FileManager->enableMediaPlayer . ',';
		print 'docViewer:' . (int) $this->_FileManager->enableDocViewer . ',';
		print 'imgViewer:' . (int) $this->_FileManager->enableImagePreview . ',';
		print 'rotate:' . (int) $this->_FileManager->enableImageRotation . ',';
		print 'hideDisabledIcons:' . (int) $this->_FileManager->hideDisabledIcons;
		print '}';
	}

	/**
	 * get messages
	 */
	function _getMessages() {
		global $msg;

		print '{';
		$m = array();
		foreach($msg as $key => $val) $m[] = "$key:'" . addslashes($val) . "'";
		print implode(',', $m);
		print '}';
	}

	/**
	 * get container settings
	 */
	function _getContSettings() {
		print '{';
		print "sid:'" . $this->_FileManager->container . session_id() . "',";
		print "tmp:'" . addslashes($this->_FileManager->tmpFilePath) . "',";
		print "language:'" . addslashes($this->_FileManager->language) . "',";
		print "sort:{field:'isDir',order:'asc'},";
		print "listType:'" . addslashes($this->_FileManager->fmView) . "',";
		print 'markNew:' . (int) $this->_FileManager->markNew . ',';
		print 'useRightClickMenu:' . (int) $this->_FileManager->useRightClickMenu . ',';
		print 'thumbMaxWidth:' . (int) $this->_FileManager->thumbMaxWidth . ',';
		print 'thumbMaxHeight:' . (int) $this->_FileManager->thumbMaxHeight . ',';
		print 'mediaPlayerWidth:' . (int) $this->_FileManager->mediaPlayerWidth . ',';
		print 'mediaPlayerHeight:' . (int) $this->_FileManager->mediaPlayerHeight . ',';
		print 'docViewerWidth:' . (int) $this->_FileManager->docViewerWidth . ',';
		print 'docViewerHeight:' . (int) $this->_FileManager->docViewerHeight . ',';
		print "publicUrl:'" . addslashes($this->_FileManager->publicUrl) . "',";
		print 'perlEnabled:' . (int) $this->_FileManager->perlEnabled;
		print '}';
	}

	/**
	 * get thumbnail
	 *
	 * @param integer $id
	 */
	function _getThumbnail($id) {
		if($Entry =& $this->_Listing->getEntry($id)) {
			$width = $_REQUEST['width'] ? $_REQUEST['width'] : $this->_FileManager->thumbMaxWidth;
			$height = $_REQUEST['height'] ? $_REQUEST['height'] : $this->_FileManager->thumbMaxHeight;
			$Entry->sendImage($width, $height);
		}
	}

	/**
	 * get cached image
	 *
	 * @param integer $id
	 */
	function _getCachedImage($name) {
		$cacheDir = $this->_FileManager->getCacheDir();
		$file = $cacheDir . '/' . $name;

		if(is_file($file)) {
			if($Entry = new FM_Entry($this->_FileManager->getListing(), true)) {
				$Entry->path = $file;
				$Entry->name = FM_Tools::basename($file);
				$Entry->size = @filesize($file);
				$width = $_REQUEST['width'] ? $_REQUEST['width'] : $this->_FileManager->thumbMaxWidth;
				$height = $_REQUEST['height'] ? $_REQUEST['height'] : $this->_FileManager->thumbMaxHeight;
				$Entry->sendImage($width, $height);
			}
		}
	}

	/**
	 * get file
	 *
	 * @param integer $id		entry ID
	 * @param string $disp		optional: content disposition ('attachment' or 'inline')
	 * @param boolean $enabled	optional: download permission
	 */
	function _getFile($id, $disp = '', $enabled = true) {
		if($enabled && $id != '') {
			if($Entry =& $this->_Listing->getEntry($id)) {
				$Entry->sendFile($disp);
			}
		}
	}

	/**
	 * get selected files
	 *
	 * @param array $ids		entry IDs
	 * @return array
	 */
	function _getFiles($ids) {
		$files = $dirs = array();

		if($this->_FileManager->enableDownload) {
			if(is_array($ids)) foreach($ids as $id) {
				if($Entry =& $this->_Listing->getEntry($id)) {
					if($Entry->isDir()) $dirs[] = $Entry;
					else $files[] = $Entry;
				}
			}

			if(count($dirs) > 0) foreach($dirs as $Entry) {
				if($this->_Listing->readDir($Entry->path)) {
					$entries = $this->_Listing->getEntries();

					if(is_array($entries)) {
						$newIds = array();
						foreach($entries as $Entry) $newIds[] = $Entry->id;
						$files = array_merge($files, $this->_getFiles($newIds, $dir));
					}
				}
			}
		}
		return $files;
	}

	/**
	 * send ZIP archive
	 * 
	 * @param FM_Entry[] $entries
	 */
	function _sendZip($entries) {
		if(is_array($entries) && count($entries) > 0) {
			$downloads = array();
			$memoryLimit = FM_Tools::toBytes(@ini_get('memory_limit'));
			$filename = 'FM_' . date('Y-m-d_H-i-s') . '.zip';

			$Zip = new FM_Zip($this->_FileManager->encoding);
			$Zip->startTransfer($filename);

			foreach($entries as $Entry) {
				$name = FM_Tools::substr($Entry->path, FM_Tools::strlen($this->_Listing->curDir), FM_Tools::strlen($Entry->path));
				$name = preg_replace('%^/%', '', $name);
				$time = @strtotime($Entry->changed);
				$data = '';

				if($memoryLimit) {
					$usedMemory = FM_Tools::getMemoryUsage();
					if($usedMemory + $Entry->size > $memoryLimit) {
						$data = 'Could not add file - size exceeds memory limit.';
						$name .= '.txt';
						$time = time();
					}
				}

				if($data == '') {
					$data = FM_Tools::readLocalFile($Entry->getFile());
					if($this->_FileManager->mailOnDownload) {
						$downloads[] = array('path' => $Entry->path, 'size' => $Entry->size);
					}
					if($this->_FileManager->downloadHook) {
						$this->_FileManager->callDownloadHook($Entry->path, $Entry->size);
					}
				}
				$Zip->addFile($data, $name, $time);
			}

			if($this->_FileManager->mailOnDownload && count($downloads) > 0) {
				$this->_FileManager->sendDownloadInfo($downloads);
			}
			$Zip->finishTransfer();
		}
	}

	/**
	 * read text file
	 *
	 * @param integer $id		entry ID
	 */
	function _readTextFile($id) {
		if($id != '') {
			if($Entry =& $this->_Listing->getEntry($id)) {
				$Editor = new FM_Editor($this->_FileManager, true);
				$Editor->view($Entry);
			}
		}
	}

	/**
	 * get directory tree
	 */
	function _getExplorer() {
		if(!$this->_Listing->Explorer) {
			$this->_Listing->Explorer = new FM_Explorer($this->_Listing);
		}
		$cont = $this->_FileManager->container;
		print "{cont:'$cont',explorer:" . $this->_Listing->Explorer->make() . '}';
	}

	/**
	 * move file / directory
	 *
	 * @param string $entryIds
	 * @param integer $folderId
	 * @param boolean $copy			optional: copy file
	 * @return string
	 */
	function _move($entryIds, $folderId, $copy = false) {
		if(!$this->_Listing->Explorer) {
			$this->_Listing->Explorer = new FM_Explorer($this->_Listing);
		}
		$errors = array();

		if($folder = $this->_Listing->Explorer->getFolder($folderId)) {
			foreach(explode(',', $entryIds) as $entryId) {
				$Entry = $this->_Listing->getEntry($entryId);
				if($copy && !$Entry->isDir()) {
					if(!$Entry->copyFile($folder[1] . '/' . $Entry->name)) {
						$errors[] = FM_Tools::getMsg('errSave', $Entry->name);
					}
					else $this->_Listing->removeCacheFolder(md5($folder[1]));
				}
				else {
					if(!$Entry->rename($folder[1] . '/' . $Entry->name)) {
						$errors[] = FM_Tools::getMsg('errRename', $Entry->name);
					}
					else {
						$this->_Listing->removeCacheFolder(md5($folder[1]));
						if($Entry->isDir()) $this->_Listing->Explorer = null;
					}
				}
			}
		}
		else $errors[] = FM_Tools::getMsg('errOpen');

		if($copy) $this->_Listing->view();
		else $this->_Listing->refresh();
		return implode('<br/>', $errors);
	}

	/**
	 * rotate image
	 *
	 * @param integer $id
	 * @param integer $angle
	 * @return string
	 */
	function _rotateImage($id, $angle) {
		$error = '';
		if($this->_FileManager->enableImageRotation) {
			if($Entry =& $this->_Listing->getEntry($id)) {
				$error = $Entry->rotateImage($angle);
			}
		}
		$this->_Listing->refresh();
		return $error;
	}

	/**
	 * create Java uploader
	 */
	function _createJavaUploader() {
		include_once('jupload/jupload.php');

		$allowFileTypes = is_array($this->_FileManager->allowFileTypes) ? implode('/', $this->_FileManager->allowFileTypes) : '';
		$specificHeaders = array();

		if($this->_FileManager->authUser != '') {
			$specificHeaders[] = 'Authorization: Basic ' . base64_encode($this->_FileManager->authUser . ':' . $this->_FileManager->authPassword);
		}

		$appletParameters = array(
			'maxFileSize' => '2G',
			'archive' => 'jupload/wjhk.jupload.jar',
			'width' => 520,
			'height' => 250,
			'lookAndFeel' => 'system',
			'lang' => $this->_FileManager->language,
			'encoding' => $this->_FileManager->encoding,
			'allowedFileExtensions' => $allowFileTypes,
			'specificHeaders' => implode('\n', $specificHeaders),
			'afterUploadURL' => 'javascript:parent.document.fmJavaUpload.submit()'
		);

		$classParameters = array(
			'demo_mode' => false,
			'allow_subdirs' => false,
			'destdir' => $this->_FileManager->getUploadDir()
		);

		$juploadPhpSupportClass = new JUpload($appletParameters, $classParameters);

		print "<html>\n<head>\n";
		print "<!--JUPLOAD_JSCRIPT-->\n";
		print "<link rel=\"stylesheet\" href=\"css/filemanager.css\" type=\"text/css\">\n";
		print "</head>\n";
		print "<body class=\"fmTD3\" style=\"margin:0px; padding:0px\">\n";
		print "<div align=\"center\">\n";
		print "<!--JUPLOAD_APPLET-->\n";
		print "</div>\n</body>\n</html>\n";
	}
}

?>