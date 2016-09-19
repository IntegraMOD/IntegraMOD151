<?php

/**
 * This code is part of the FileManager software (www.gerd-tentler.de/tools/filemanager), copyright by
 * Gerd Tentler. Obtain permission before selling this code or hosting it on a commercial website or
 * redistributing it over the Internet or in any other medium. In all cases copyright must remain intact.
 */

 include_once('FM_Tools.php');

/**
 * This class handles file operations on a single file.
 *
 * @package FileManager
 * @subpackage class
 * @author Gerd Tentler
 */
class FM_File {

/* PRIVATE PROPERTIES ************************************************************************** */

	/**
	 * holds FileManager object
	 *
	 * @var FileManager
	 */
	var $_FileManager;

	/**
	 * file path
	 *
	 * @var string
	 */
	var $_file;

	/**
	 * holds FTP stream
	 *
	 * @var resource
	 */
	var $_ftp;

	/**
	 * MIME types
	 *
	 * @var array
	 */
	var $_mimeTypes = array(
		'dwg'     => 'application/acad',
		'asd'     => 'application/astound',
		'tsp'     => 'application/dsptype',
		'dxf'     => 'application/dxf',
		'spl'     => 'application/futuresplash',
		'gz'      => 'application/gzip',
		'json'    => 'application/json',
		'ptlk'    => 'application/listenup',
		'hqx'     => 'application/mac-binhex40',
		'mbd'     => 'application/mbedlet',
		'mif'     => 'application/mif',
		'xls'     => 'application/msexcel',
		'xla'     => 'application/msexcel',
		'hlp'     => 'application/mshelp',
		'chm'     => 'application/mshelp',
		'ppt'     => 'application/mspowerpoint',
		'ppz'     => 'application/mspowerpoint',
		'pps'     => 'application/mspowerpoint',
		'pot'     => 'application/mspowerpoint',
		'doc'     => 'application/msword',
		'dot'     => 'application/msword',
		'bin'     => 'application/octet-stream',
		'oda'     => 'application/oda',
		'pdf'     => 'application/pdf',
		'ai'      => 'application/postscript',
		'eps'     => 'application/postscript',
		'ps'      => 'application/postscript',
		'rtc'     => 'application/rtc',
		'smp'     => 'application/studiom',
		'tbk'     => 'application/toolbook',
		'vmd'     => 'application/vocaltec-media-desc',
		'vmf'     => 'application/vocaltec-media-file',
		'xhtml'   => 'application/xhtml+xml',
		'bcpio'   => 'application/x-bcpio',
		'z'       => 'application/x-compress',
		'cpio'    => 'application/x-cpio',
		'csh'     => 'application/x-csh',
		'dcr'     => 'application/x-director',
		'dir'     => 'application/x-director',
		'dxr'     => 'application/x-director',
		'dvi'     => 'application/x-dvi',
		'evy'     => 'application/x-envoy',
		'gtar'    => 'application/x-gtar',
		'hdf'     => 'application/x-hdf',
		'php'     => 'application/x-httpd-php',
		'phtml'   => 'application/x-httpd-php',
		'latex'   => 'application/x-latex',
		'mif'     => 'application/x-mif',
		'nc'      => 'application/x-netcdf',
		'cdf'     => 'application/x-netcdf',
		'nsc'     => 'application/x-nschat',
		'sh'      => 'application/x-sh',
		'shar'    => 'application/x-shar',
		'swf'     => 'application/x-shockwave-flash',
		'cab'     => 'application/x-shockwave-flash',
		'spr'     => 'application/x-sprite',
		'sprite'  => 'application/x-sprite',
		'sit'     => 'application/x-stuffit',
		'sca'     => 'application/x-supercard',
		'sv4cpio' => 'application/x-sv4cpio',
		'sv4crc'  => 'application/x-sv4crc',
		'tar'     => 'application/x-tar',
		'tcl'     => 'application/x-tcl',
		'tex'     => 'application/x-tex',
		'texinfo' => 'application/x-texinfo',
		'texi'    => 'application/x-texinfo',
		't'       => 'application/x-troff',
		'tr'      => 'application/x-troff',
		'roff'    => 'application/x-troff',
		'troff'   => 'application/x-troff',
		'ustar'   => 'application/x-ustar',
		'src'     => 'application/x-wais-source',
		'zip'     => 'application/zip',
		'au'      => 'audio/basic',
		'snd'     => 'audio/basic',
		'es'      => 'audio/echospeech',
		'tsi'     => 'audio/tsplayer',
		'vox'     => 'audio/voxware',
		'aif'     => 'audio/x-aiff',
		'aiff'    => 'audio/x-aiff',
		'aifc'    => 'audio/x-aiff',
		'dus'     => 'audio/x-dspeeh',
		'cht'     => 'audio/x-dspeeh',
		'mid'     => 'audio/x-midi',
		'midi'    => 'audio/x-midi',
		'mp2'     => 'audio/x-mpeg',
		'ram'     => 'audio/x-pn-realaudio',
		'ra'      => 'audio/x-pn-realaudio',
		'rpm'     => 'audio/x-pn-realaudio-plugin',
		'stream'  => 'audio/x-qt-stream',
		'wav'     => 'audio/x-wav',
		'wma'     => 'audio/x-ms-wma',
		'dwf'     => 'drawing/x-dwf',
		'cod'     => 'image/cis-cod',
		'ras'     => 'image/cmu-raster',
		'fif'     => 'image/fif',
		'gif'     => 'image/gif',
		'ief'     => 'image/ief',
		'jpeg'    => 'image/jpeg',
		'jpg'     => 'image/jpeg',
		'jpe'     => 'image/jpeg',
		'tiff'    => 'image/tiff',
		'tif'     => 'image/tiff',
		'mcf'     => 'image/vasa',
		'wbmp'    => 'image/vnd.wap.wbmp',
		'fh4'     => 'image/x-freehand',
		'fh5'     => 'image/x-freehand',
		'fhc'     => 'image/x-freehand',
		'pnm'     => 'image/x-portable-anymap',
		'pbm'     => 'image/x-portable-bitmap',
		'pgm'     => 'image/x-portable-graymap',
		'ppm'     => 'image/x-portable-pixmap',
		'rgb'     => 'image/x-rgb',
		'xwd'     => 'image/x-windowdump',
		'xbm'     => 'image/x-xbitmap',
		'xpm'     => 'image/x-xpixmap',
		'csv'     => 'text/comma-separated-values',
		'css'     => 'text/css',
		'htm'     => 'text/html',
		'html'    => 'text/html',
		'shtml'   => 'text/html',
		'js'      => 'text/javascript',
		'txt'     => 'text/plain',
		'rtx'     => 'text/richtext',
		'rtf'     => 'text/rtf',
		'tsv'     => 'text/tab-separated-values',
		'wml'     => 'text/vnd.wap.wml',
		'wmlc'    => 'application/vnd.wap.wmlc',
		'wmls'    => 'text/vnd.wap.wmlscript',
		'wmlsc'   => 'application/vnd.wap.wmlscriptc',
		'xml'     => 'text/xml',
		'etx'     => 'text/x-setext',
		'sgm'     => 'text/x-sgml',
		'sgml'    => 'text/x-sgml',
		'talk'    => 'text/x-speech',
		'spc'     => 'text/x-speech',
		'mpeg'    => 'video/mpeg',
		'mpg'     => 'video/mpeg',
		'mpe'     => 'video/mpeg',
		'qt'      => 'video/quicktime',
		'mov'     => 'video/quicktime',
		'viv'     => 'video/vnd.vivo',
		'vivo'    => 'video/vnd.vivo',
		'avi'     => 'video/x-msvideo',
		'movie'   => 'video/x-sgi-movie',
		'flv'     => 'video/x-flv',
		'wmv'     => 'video/x-ms-wmv',
		'vts'     => 'workbook/formulaone',
		'vtts'    => 'workbook/formulaone',
		'3dmf'    => 'x-world/x-3dmf',
		'3dm'     => 'x-world/x-3dmf',
		'qd3d'    => 'x-world/x-3dmf',
		'qd3'     => 'x-world/x-3dmf',
		'wrl'     => 'x-world/x-vrml'
	);

/* PUBLIC METHODS ****************************************************************************** */

	/**
	 * constructor
	 *
	 * @param FileManager $FileManager	reference to FileManager object
	 * @param string $path				file path
	 * @param resource $ftp				optional: FTP stream
	 * @return FM_File
	 */
	function FM_File(&$FileManager, $path, $ftp = null) {
		$this->_FileManager =& $FileManager;
		$this->_file = $path;
		$this->_ftp = $ftp;
	}

	/**
	 * upload file
	 *
	 * @param string $dstPath	destination path (remote / target dir)
	 * @return boolean
	 */
	function put($dstPath) {
		/* remove old versions from cache */
		$cache = $this->_FileManager->getCacheDir();
		FM_Tools::removeFiles($cache, '/^' . md5($dstPath) . '/');

		if($this->_ftp) {
			return @ftp_put($this->_ftp, $dstPath, $this->_file, FTP_BINARY);
		}
		return @copy($this->_file, $dstPath);
	}

	/**
	 * change permissions
	 *
	 * @param integer $mode		permissions
	 * @return boolean
	 */
	function changePerms($mode) {
		if($this->_ftp) {
			if(!function_exists('ftp_chmod')) {
				return @ftp_site($this->_ftp, sprintf('CHMOD %o %s', $mode, $this->_file));
			}
			return @ftp_chmod($this->_ftp, $mode, $this->_file);
		}
		return @chmod($this->_file, $mode);
	}

	/**
	 * delete file
	 *
	 * @param boolean $restore		optional: restore enabled
	 * @return boolean
	 */
	function delete($restore = false) {
		if($restore) {
			if($this->_ftp) {
				return @ftp_rename($this->_ftp, $this->_file, $this->_file . '.' . FM_EXT_DELETED);
			}
			return @rename($this->_file, $this->_file . '.' . FM_EXT_DELETED);
		}
		else {
			if($this->_ftp) {
				return @ftp_delete($this->_ftp, $this->_file);
			}
			return @unlink($this->_file);
		}
	}

	/**
	 * restore file
	 *
	 * @return boolean
	 */
	function restore() {
		if(preg_match('/\.' . FM_EXT_DELETED . '$/', $this->_file)) {
			$newName = preg_replace('/\.' . FM_EXT_DELETED . '$/', '', $this->_file);
			return $this->rename($newName);
		}
		return false;
	}

	/**
	 * rename file / directory
	 *
	 * @param string $dstPath	destination path
	 * @return boolean
	 */
	function rename($dstPath) {
		if($this->_ftp) {
			return @ftp_rename($this->_ftp, $this->_file, $dstPath);
		}
		return @rename($this->_file, $dstPath);
	}

	/**
	 * copy file
	 *
	 * @param string $dstPath	destination path
	 * @return boolean
	 */
	function copy($dstPath) {
		if($this->_ftp) {
			$tmp = $this->_FileManager->getCacheDir() . '/' . md5($this->_file);

			if(@ftp_get($this->_ftp, $tmp, $this->_file, FTP_BINARY)) {
				return @ftp_put($this->_ftp, $dstPath, $tmp, FTP_BINARY);
			}
			return false;
		}
		return @copy($this->_file, $dstPath);
	}


	/**
	 * get MIME type
	 *
	 * @return string
	 */
	function getMimeType() {
		$ext = strtolower(end(explode('.', $this->_file)));

		if($this->_mimeTypes[$ext]) {
			return $this->_mimeTypes[$ext];
		}
		return 'application/octet-stream';
	}
}

?>