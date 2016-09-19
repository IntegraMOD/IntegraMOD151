<?php

/**
 * This code is part of the FileManager software (www.gerd-tentler.de/tools/FileManager), copyright by
 * Gerd Tentler. Obtain permission before selling this code or hosting it on a commercial website or
 * redistributing it over the Internet or in any other medium. In all cases copyright must remain intact.
 */

include_once('FM_Image.php');
include_once('FM_Tools.php');

/**
 * This class manages directory listing entries.
 *
 * @package FileManager
 * @subpackage class
 * @author Gerd Tentler
 */
class FM_Entry {

/* PUBLIC PROPERTIES *************************************************************************** */

	/**
	 * file name
	 *
	 * @var string
	 */
	var $name;

	/**
	 * file owner
	 *
	 * @var string
	 */
	var $owner;

	/**
	 * file group
	 *
	 * @var string
	 */
	var $group;

	/**
	 * file size
	 *
	 * @var string
	 */
	var $size;

	/**
	 * last modified
	 *
	 * @var string
	 */
	var $changed;

	/**
	 * file permissions
	 *
	 * @var string
	 */
	var $permissions;

	/**
	 * file icon
	 *
	 * @var string
	 */
	var $icon;

	/**
	 * file path
	 *
	 * @var string
	 */
	var $path;

	/**
	 * image width
	 *
	 * @var integer
	 */
	var $width;

	/**
	 * image height
	 *
	 * @var integer
	 */
	var $height;

	/**
	 * thumbnail hash
	 *
	 * @var string
	 */
	var $thumbHash;

	/**
	 * stores entry ID
	 *
	 * @var integer
	 */
	var $id;

	/**
	 * symbolic link target - works only on local file system
	 *
	 * @var string
	 */
	var $target;

	/**
	 * ID3 tags
	 *
	 * @var array
	 */
	var $id3Tags;

	/**
	 * holds FileManager object
	 *
	 * @var FileManager
	 */
	var $FileManager;

	/**
	 * holds listing object
	 *
	 * @var FM_Listing
	 */
	var $Listing;

/* PRIVATE PROPERTIES ************************************************************************** */

	/**
	 * file is in local directory (temp directory)
	 *
	 * @var boolean
	 */
	var $_isLocalFile;

/* PUBLIC METHODS ****************************************************************************** */

	/**
	 * constructor
	 *
	 * @param FM_Listing $Listing	listing object
	 * @param boolean $isLocalFile	optional: file is in local directory
	 * @return FM_Entry
	 */
	function FM_Entry(&$Listing, $isLocalFile = false) {
		$this->Listing =& $Listing;
		$this->FileManager =& $this->Listing->FileManager;
		$this->_isLocalFile = $isLocalFile;
	}

	/**
	 * view entry
	 *
	 * @return string
	 */
	function view() {
		$entry = $this->_viewHeader() . ',';
		$entry .= $this->_viewIcon() . ',';
		$entry .= $this->_viewName() . ',';
		$entry .= $this->_viewSize() . ',';
		$entry .= $this->_viewModified() . ',';
		$entry .= $this->_viewPermissions() . ',';
		$entry .= $this->_viewOwner() . ',';
		$entry .= $this->_viewGroup() . ',';
		$entry .= $this->_viewThumbnail() . ',';
		$entry .= $this->_viewId3Tags() . ',';
		$entry .= $this->_viewCheckbox();
		$entry .= $this->_viewFooter();
		return $entry;
	}

	/**
	 * check if entry is a directory
	 *
	 * @return boolean
	 */
	function isDir() {
		return ($this->icon == 'dir');
	}

	/**
	 * check if entry is deleted
	 *
	 * @return boolean
	 */
	function isDeleted() {
		return preg_match('/\.' . FM_EXT_DELETED . '$/', $this->name);
	}

	/**
	 * rename file or directory
	 *
	 * @param string $dst		new file/directory path
	 * @return boolean
	 */
	function rename($dst) {
		return $this->Listing->FileSystem->rename($this->path, $dst);
	}

	/**
	 * copy file
	 *
	 * @param string $dst		file path
	 * @return boolean
	 */
	function copyFile($dst) {
		return $this->Listing->FileSystem->copyFile($this->path, $dst);
	}

	/**
	 * delete file
	 *
	 * @return boolean
	 */
	function deleteFile() {
		return $this->Listing->FileSystem->deleteFile($this->path);
	}

	/**
	 * restore file
	 *
	 * @return boolean
	 */
	function restoreFile() {
		return $this->Listing->FileSystem->restoreFile($this->path);
	}

	/**
	 * save file data
	 *
	 * @param string $data		file data
	 * @return boolean
	 */
	function saveFile(&$data) {
		return $this->Listing->FileSystem->writeFile($this->path, $data);
	}

	/**
	 * change file permissions
	 *
	 * @param integer $mode		new mode
	 * @return boolean
	 */
	function changePerms($mode) {
		return $this->Listing->FileSystem->changePerms($this->path, $mode);
	}

	/**
	 * get file permissions
	 *
	 * @return string			permissions
	 */
	function getPerms() {
		if($this->FileManager->ftpHost) {
			return $this->permissions;
		}
		$file = $this->path;
		if(is_dir($file)) {
			$perms = 'd';
			$rwx = substr(decoct(@fileperms($file)), 2);
		}
		else {
			$perms = '-';
			$rwx = substr(decoct(@fileperms($file)), 3);
		}
		for($i = 0; $i < strlen($rwx); $i++) {
			switch($rwx[$i]) {
				case 1: $perms .= '--x'; break;
				case 2: $perms .= '-w-'; break;
				case 3: $perms .= '-wx'; break;
				case 4: $perms .= 'r--'; break;
				case 5: $perms .= 'r-x'; break;
				case 6: $perms .= 'rw-'; break;
				case 7: $perms .= 'rwx'; break;
				default: $perms .= '---';
			}
		}
		return $perms;
	}

	/**
	 * get document type
	 *
	 * @return integer	0 = no document, 1 = plain text, 2 = Google Docs Viewer
	 */
	function getDocType() {
		if(substr($this->icon, 0, 4) == 'text') return 1;
		$ext = end(explode('.', $this->name));
		return preg_match('/^(' . FM_EXT_GDVIEWER . ')$/i', $ext) ? 2 : 0;
	}

	/**
	 * send file for download
	 *
	 * @param string $disp		optional: content disposition ('attachment' or 'inline')
	 * @return boolean			false on failure
	 */
	function sendFile($disp = '') {
		$ret = $this->getFile(true);

		if(is_array($ret)) {
			$path = $ret[0];
			$status = $ret[1];
			$ftp = $ret[2];
		}
		else {
			$path = $ret;
			$status = $ftp = false;
		}

		if(is_file($path)) {
			$filename = $this->name;
			$File = new FM_File($this->FileManager, $path);
			if(!$disp) $disp = 'attachment';

			if($disp != 'inline') {
				if($this->FileManager->replSpacesDownload) {
					$filename = str_replace(' ', '_', $filename);
				}
				if($this->FileManager->lowerCaseDownload) {
					$filename = strtolower($filename);
				}
				if($this->FileManager->mailOnDownload) {
					$info = array('path' => $this->path, 'size' => $this->size);
					$this->FileManager->sendDownloadInfo(array($info));
				}
				if($this->FileManager->downloadHook) {
					$this->FileManager->callDownloadHook($this->path, $this->size);
				}
			}
			header('Content-Type: ' . $File->getMimeType());
			header('Content-Disposition: ' . $disp . '; filename="' . $filename . '"');
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: ' . (int) $this->size);
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Expires: 0');
			ob_end_flush();

			if($status && $ftp) {
				if($fp = @fopen($path, 'r')) {
					$start = 0;

					while($status == FTP_MOREDATA) {
						@clearstatcache();
						$size = @filesize($path) - $start;
						if($start) @fseek($fp, $start);
						if($size) echo @fread($fp, $size);
						$start += $size;
						$status = @ftp_nb_continue($ftp);
					}
					@fclose($fp);
				}
			}
			else readfile($path);
			exit;
		}
		return false;
	}

	/**
	 * send image
	 *
	 * @param integer $width
	 * @param integer $height
	 */
	function sendImage($width, $height) {
		$Image = new FM_Image($this, $width, $height);
		$Image->view();
	}

	/**
	 * rotate image
	 *
	 * @param integer $angle
	 * @return string			error message
	 */
	function rotateImage($angle) {
		$Image = new FM_Image($this);
		return $Image->rotate($angle);
	}

	/**
	 * load file from FTP server if necessary
	 *
	 * @param boolean $useFtpNb		optional: use FTP non-blocking mode
	 * @return string				local file path
	 */
	function getFile($useFtpNb = false) {
		if($this->_isLocalFile) return $this->path;
		return $this->Listing->FileSystem->getFile($this->path, $useFtpNb);
	}

	/**
	 * set properties from local file path or FTP listing row
	 *
	 * @param string $file		local file path or FTP listing row
	 * @param string $dir		directory path
	 * @return boolean
	 */
	function setProperties($file, $dir) {
		if($this->FileManager->ftpHost) {
			$sysType = preg_match('/winnt|windows/i', $this->Listing->sysType) ? 'Windows' : 'UNIX';
		}
		else $sysType = 'PHP';

		switch($sysType) {

			case 'UNIX':
				if(preg_match($this->Listing->FileSystem->unixRow, $file, $m)) {
					if($m[7] == '..' || $m[7] == '.') return false;
					$changed = $m[6] ? $m[5] : strstr($m[5], ':') ? preg_replace('/([\d\:]{4,5})$/', @date('Y') . " $1", $m[5]) : $m[5];
					$tstamp = @strtotime($changed);
					$this->permissions = $m[1];
					$this->owner = $m[2];
					$this->group = $m[3];
					$this->size = $m[4];
					$this->changed = ($tstamp !== false && $tstamp != -1) ? @date('Y-m-d H:i', $tstamp) : $m[5];
					$this->name = $m[7];
					$this->icon = ($this->permissions[0] == 'd') ? 'dir' : '';
					$this->path = $dir . '/' . $this->name;
					$this->id3Tags = $this->Listing->FileSystem->readId3Tags($this->path);
					return true;
				}
				break;

			case 'Windows':
				if(preg_match($this->Listing->FileSystem->windowsRow, $file, $m)) {
					if($m[4] == '..' || $m[4] == '.') return false;
					$isDir = (strtoupper($m[3]) == '<DIR>');
					$t = explode(':', $m[2]);
					if(preg_match('/[AP]M$/', strtoupper($t[1]), $m2)) {
						$t[1] = (int) $t[1];
						if($m2[0] == 'PM') $t[0] += 12;
					}
					if(strstr($m[1], '-')) {
						$d = explode('-', $m[1]);
						$tstamp = mktime($t[0], $t[1], 0, $d[0], $d[1], $d[2]);
					}
					else {
						$d = explode('.', $m[1]);
						$tstamp = mktime($t[0], $t[1], 0, $d[1], $d[0], $d[2]);
					}
					$this->changed = $tstamp ? @date('Y-m-d H:i', $tstamp) : $m[1] . ' ' . $m[2];
					$this->permissions = '';
					$this->size = $isDir ? 0 : str_replace('.', '', $m[3]);
					$this->name = $m[4];
					$this->icon = $isDir ? 'dir' : '';
					$this->path = $dir . '/' . $this->name;
					$this->id3Tags = $this->Listing->FileSystem->readId3Tags($this->path);
					return true;
				}
				break;

			case 'PHP':
				$filename = FM_Tools::basename($file);
				if($filename == '.' || $filename == '..') return false;
				$this->owner = @fileowner($file);
				$this->group = @filegroup($file);
				$this->size = @filesize($file);
				$this->changed = @date('Y-m-d H:i', @filemtime($file));
				$this->name = $filename;
				$this->icon = is_dir($file) ? 'dir' : '';
				$this->path = $dir . '/' . $this->name;
				$this->permissions = $this->getPerms();
				if(is_link($file)) $this->target = @realpath($file);
				$this->id3Tags = $this->Listing->FileSystem->readId3Tags($this->path);
				return true;
		}
		return false;
	}

/* PRIVATE METHODS ***************************************************************************** */

	/**
	 * view header
	 *
	 * @return string
	 */
	function _viewHeader() {
		$deleted = $this->isDeleted() ? 1 : 0;
		$docType = $this->getDocType();
		return "{id:'$this->id',deleted:$deleted,docType:$docType";
	}

	/**
	 * view footer
	 *
	 * @return string
	 */
	function _viewFooter() {
		return '}';
	}

	/**
	 * view icon
	 *
	 * @return string
	 */
	function _viewIcon() {
		return "icon:'{$this->icon}.gif'";
	}

	/**
	 * view file name
	 *
	 * @return string
	 */
	function _viewName() {
		$name = $this->isDeleted()? preg_replace('/\.' . FM_EXT_DELETED . '$/', '', $this->name) : $this->name;
		$name = addslashes(FM_Tools::utf8Encode($name, $this->FileManager->encoding));
		$path = $this->Listing->FileSystem->checkPath($this->path);
		$dir = preg_replace('%^/$%', '', FM_Tools::dirname($path));
		$dir = addslashes(FM_Tools::utf8Encode($dir, $this->FileManager->encoding));
		$fullName = $this->FileManager->hideFilePath ? $name : "$dir/$name";

		if(!$this->FileManager->hideLinkTarget && $this->target != '') {
			$fullName .= addslashes(' => ' . $this->target);
		}
		$json = "name:'$name',fullName:'$fullName'";
		if($this->Listing->searchString != '') $json .= ",dir:'$dir'";
		return $json;
	}

	/**
	 * view file size
	 *
	 * @return string
	 */
	function _viewSize() {
		if($this->icon == 'cdup') {
			$size = '';
		}
		else if($this->size < 1000) {
			$size = $this->size . ' B';
		}
		else {
			$size = $this->size / 1024;
			if($size > 999) $size = number_format($size / 1024, 1) . ' M';
			else $size = number_format($size, 1) . ' K';
		}
		return "size:'$size',width:" . (int) $this->width . ',height:' . (int) $this->height;
	}

	/**
	 * view last modification date
	 *
	 * @return string
	 */
	function _viewModified() {
		return "changed:'$this->changed'";
	}

	/**
	 * view permissions
	 *
	 * @return string
	 */
	function _viewPermissions() {
		return "permissions:'$this->permissions'";
	}

	/**
	 * view owner
	 *
	 * @return string
	 */
	function _viewOwner() {
		return "owner:'$this->owner'";
	}

	/**
	 * view group
	 *
	 * @return string
	 */
	function _viewGroup() {
		return "group:'$this->group'";
	}

	/**
	 * view thumbnail
	 *
	 * @return string
	 */
	function _viewThumbnail() {
		$hash = $this->thumbHash ? addslashes($this->thumbHash) : '';
		return "thumbnail:'$hash'";
	}

	/**
	 * view ID3 tags
	 *
	 * @return string
	 */
	function _viewId3Tags() {
		$tags = array();
		if(is_array($this->id3Tags)) foreach($this->id3Tags as $key => $value) {
			$tags[] = ucfirst($key) . ":'" . addslashes($value) . "'";
		}
		return 'id3:{' . implode(',', $tags) . '}';
	}

	/**
	 * view checkbox
	 *
	 * @return string
	 */
	function _viewCheckbox() {
		return 'checkbox:' . (($this->icon == 'cdup' || $this->isDeleted()) ? 0 : 1);
	}
}

?>