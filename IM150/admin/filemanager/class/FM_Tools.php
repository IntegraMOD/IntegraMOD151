<?php

/**
 * This code is part of the FileManager software (www.gerd-tentler.de/tools/filemanager), copyright by
 * Gerd Tentler. Obtain permission before selling this code or hosting it on a commercial website or
 * redistributing it over the Internet or in any other medium. In all cases copyright must remain intact.
 */

/**
 * This class provides static methods for general use.
 *
 * @package FileManager
 * @subpackage class
 * @author Gerd Tentler
 */
class FM_Tools {

/* PUBLIC STATIC METHODS *********************************************************************** */

	/**
	 * clean local directory
	 *
	 * @param string $dir			directory
	 * @param integer $time			optional: modification timestamp
	 * @param boolean $remDirs		optional: remove sub folders
	 */
	function cleanDir($dir, $time = null, $remDirs = false) {
		if($dp = @opendir($dir)) {
			while(($file = @readdir($dp)) !== false) {
				if($file != '.' && $file != '..') {
					if($time) {
						$atime = @fileatime("$dir/$file");
						$mtime = @filemtime("$dir/$file");
						$fileTime = ($atime > $mtime) ? $atime : $mtime;
						$delete = ($fileTime < $time);
					}
					else $delete = true;

					if($delete) {
						if($remDirs && is_dir("$dir/$file")) FM_Tools::removeDir("$dir/$file");
						if(is_file("$dir/$file")) @unlink("$dir/$file");
					}
				}
			}
			@closedir($dp);
		}
	}

	/**
	 * remove local directory tree
	 *
	 * @param string $dir	directory
	 */
	function removeDir($dir) {
		if($dp = @opendir($dir)) {
			while(($file = @readdir($dp)) !== false) {
				if($file != '.' && $file != '..') {
					if(is_dir("$dir/$file")) FM_Tools::removeDir("$dir/$file");
					else @unlink("$dir/$file");
				}
			}
			@closedir($dp);
			@rmdir($dir);
		}
	}

	/**
	 * create local directory path
	 *
	 * @param string $newDir
	 * @return boolean
	 */
	function makeDir($dir) {
		if(!is_dir(FM_Tools::dirname($dir))) FM_Tools::makeDir(FM_Tools::dirname($dir));
		return (is_dir($dir) || @mkdir($dir, 0755));
	}

	/**
	 * get number of files in local directory
	 *
	 * @param string $dir	directory
	 * @return integer
	 */
	function getFileCount($dir) {
		$cnt = 0;
		if($dp = @opendir($dir)) {
			while(($file = @readdir($dp)) !== false) {
				if($file != '.' && $file != '..') {
					if(is_file("$dir/$file")) $cnt++;
				}
			}
			@closedir($dp);
		}
		return $cnt;
	}

	/**
	 * read local file
	 *
	 * @param string $file		file path
	 * @return string $data		file data
	 */
	function readLocalFile($file) {
		$data = '';
		if($fp = @fopen($file, 'r')) {
			$data = @fread($fp, @filesize($file));
			@fclose($fp);
		}
		return $data;
	}

	/**
	 * save local file
	 *
	 * @param string $path		file path
	 * @param string $data		file data
	 * @param boolean $append	optional: append data to existing file
	 * @return boolean
	 */
	function saveLocalFile($path, &$data, $append = false) {
		$ok = false;
		$mode = $append ? 'a' : 'w';

		if($fp = @fopen($path, $mode)) {
			$ok = @fwrite($fp, $data);
			@fclose($fp);
		}
		return $ok;
	}

	/**
	 * remove local files
	 *
	 * @param string $dir		directory path
	 * @param string $regExp	regular expression for filename
	 */
	function removeFiles($dir, $regExp) {
		if($dp = @opendir($dir)) {
			while(($file = @readdir($dp)) !== false) {
				if($file != '.' && $file != '..') {
					if(preg_match($regExp, $file)) {
						@unlink("$dir/$file");
					}
				}
			}
			@closedir($dp);
		}
	}

	/**
	 * call URL
	 *
	 * @param string $url				URL
	 * @param string $errstr			stores error message
	 * @return string					response
	 */
	function callUrl($url, &$errstr) {
		$errno = $errstr = $response = '';
		$urlParts = parse_url($url);
		$host = ($urlParts['host'] != '') ? $urlParts['host'] : $_SERVER['HTTP_HOST'];
		if($host == '' || $host == 'localhost') $host = '127.0.0.1';
		$port = $urlParts['port'] ? $urlParts['port'] : 80;
		$query = ($urlParts['query'] != '') ? '?' . $urlParts['query'] : '';
		$path = str_replace(' ', '%20', $urlParts['path'] . $query);

		if($sp = @fsockopen($host, $port, $errno, $errstr, 10)) {
			$out = "GET $path HTTP/1.0\r\n";
			$out .= "Host: $host\r\n";

			if($urlParts['user'] != '') {
				$login = base64_encode($urlParts['user'] . ':' . $urlParts['pass']);
				$out .= "Authorization: Basic $login\r\n";
			}
			$out .= "Connection: close\r\n\r\n";
			@fwrite($sp, $out);

			while(!@feof($sp)) {
				$response .= @fread($sp, 4096);

				if(preg_match('/^HTTP\/[\d\.]+ (\d+) ([\w ]+)/i', $response, $m)) {
					if($m[1] != 200) {
						$errstr = "Host returned \"$m[1] $m[2]\"";
						break;
					}
				}
			}
			@fclose($sp);
		}
		return $response;
	}

	/**
	 * check if string contains 3 or 4 byte characters (Chinese etc.);
	 * usually these characters have a bigger width than the characters
	 * of the Latin alphabet
	 *
	 * @param string $str		the string
	 * @return boolean
	 */
	function containsBigChars($str) {
		return preg_match('/[\xE0-\xF4][\x80-\xBF]{2,3}/', $str);
	}

	/**
	 * check if string contains UTF-8 characters
	 *
	 * @param string $str	the string
	 * @return boolean
	 */
	function isUtf8($str) {
		return preg_match('%(?:
			[\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
			|\xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
			|[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
			|\xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
			|\xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
			|[\xF1-\xF3][\x80-\xBF]{3}         # planes 4-15
			|\xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
			)%x', $str);
	}

	/**
	 * encode string if it doesn't contain UTF-8 characters
	 *
	 * @param string $str		the string
	 * @param string $encoding	character set
	 * @return string			encoded string
	 */
	function utf8Encode($str, $encoding) {
		if($encoding != '' && $encoding != 'UTF-8') {
			if(!FM_Tools::isUtf8($str)) {
				if(function_exists('iconv')) {
					return iconv($encoding, 'UTF-8//TRANSLIT', $str);
				}
				else if(function_exists('mb_convert_encoding')) {
					return mb_convert_encoding($str, 'UTF-8', $encoding);
				}
				return utf8_encode($str);
			}
		}
		return $str;
	}

	/**
	 * decode string if it contains UTF-8 characters
	 *
	 * @param string $str		the string
	 * @param string $encoding	character set
	 * @return string			decoded string
	 */
	function utf8Decode($str, $encoding) {
		if($encoding != '' && $encoding != 'UTF-8') {
			if(FM_Tools::isUtf8($str)) {
				if(function_exists('iconv')) {
					return iconv('UTF-8', $encoding . '//TRANSLIT', $str);
				}
				else if(function_exists('mb_convert_encoding')) {
					return mb_convert_encoding($str, $encoding, 'UTF-8');
				}
				return utf8_decode($str);
			}
		}
		return $str;
	}

	/**
	 * print icon
	 *
	 * @param string $path			image path
	 * @param integer $width		image width (pixels)
	 * @param integer $height		image height (pixels)
	 * @param string $action		optional: JavaScript action
	 * @param string $tooltip		optional: tooltip
	 * @param string $style			optional: CSS styles
	 */
	function printIcon($path, $width, $height, $action = '', $tooltip = '', $style = '') {
		print "<img src=\"$path\" border=\"0\" width=\"$width\" height=\"$height\"";
		if($action) print " onClick=\"$action\"";
		if($tooltip) print " alt=\"$tooltip\" title=\"$tooltip\"";
		if($style) print " style=\"$style\"";
		print "/>\n";
	}

	/**
	 * strlen() that works also with UTF-8 strings
	 *
	 * @param string $str			the string
	 * @return integer				number of characters
	 */
	function strlen($str) {
		if(FM_Tools::isUtf8($str)) {
			if(function_exists('mb_strlen')) {
				return mb_strlen($str, 'UTF-8');
			}
			return preg_match_all('/.{1}/us', $str, $m);
		}
		return strlen($str);
	}

	/**
	 * substr() that works also with UTF-8 strings
	 *
	 * @param string $str			the string
	 * @param integer $start		start position
	 * @param integer $length		optional: number of characters
	 * @return string				the substring
	 */
	function substr($str, $start, $length = null) {
		if(FM_Tools::isUtf8($str)) {
			if(function_exists('mb_substr')) {
				return mb_substr($str, $start, $length, 'UTF-8');
			}
			if(!$length) $length = FM_Tools::strlen($str, 'UTF-8');
			preg_match('/.{' . $start . '}(.{' . ($length - $start) . '})/us', $str, $m);
			return $m[1];
		}
		return substr($str, $start, $length);
	}

	/**
	 * basename() that works also with UTF-8 strings
	 *
	 * @param string $path		file path
	 * @return string
	 */
	function basename($path) {
		if(FM_Tools::isUtf8($path)) {
			return end(explode('/', $path));
		}
		return basename($path);
	}

	/**
	 * dirname() that works also with UTF-8 strings
	 *
	 * @param string $path		file path
	 * @return string
	 */
	function dirname($path) {
		if(FM_Tools::isUtf8($path)) {
			$parts = explode('/', $path);
			array_pop($parts);
			return implode('/', $parts);
		}
		return dirname($path);
	}

	/**
	 * convert strings like "8M" or "50K" to bytes
	 *
	 * @param string $str
	 * @return integer
	 */
	function toBytes($str) {
		switch(strtoupper($str[strlen($str) - 1])) {
			case 'M': return (int) $str * 1024 * 1024;
			case 'K': return (int) $str * 1024;
			case 'G': return (int) $str * 1024 * 1024 * 1024;
		}
		return (int) $str;
	}

	/**
	 * convert bytes to strings like "8.5 M" or "50.0 K"
	 *
	 * @param integer $bytes	number of bytes
	 * @param integer $dec		optional: decimals
	 * @return string
	 */
	function bytes2string($bytes, $dec = 1) {
		$sizes = array(
			'G' => 1024 * 1024 * 1024,
			'M' => 1024 * 1024,
			'K' => 1024
		);
		foreach($sizes as $key => $val) {
			if($bytes >= $val) {
				return number_format($bytes / $val, $dec) . ' ' . $key;
			}
		}
		return $bytes . ' B';
	}

	/**
	 * get microseconds - mimics PHP 5 microtime(true)
	 *
	 * @return float
	 */
	function microtime() {
		list($usec, $sec) = explode(' ', microtime());
		return (float) $usec + (float) $sec;
	}

	/**
	 * get web path
	 *
	 * @return string
	 */
	function getWebPath() {
		$incPath = str_replace('\\', '/', realpath(dirname(__FILE__) . '/..'));
		$webPath = preg_replace('%^' . $_SERVER['DOCUMENT_ROOT'] . '%', '', $incPath);

		if($webPath == $incPath) {
			$ld = basename($_SERVER['DOCUMENT_ROOT']);
			$webPath = substr($incPath, strpos($incPath, $ld) + strlen($ld));
		}
		return $webPath;
	}

	/**
	 * get message string
	 *
	 * @param string $token		message token
	 * @param string $val		optional: additional value
	 * @return string
	 */
	function getMsg($token, $val = '') {
		global $msg, $fmEncoding, $fmCnt;
		return $msg[$token] . (($val != '') ?  ': ' . FM_Tools::utf8Encode($val, $fmEncoding[$fmCnt]) : '');
	}

	/**
	 * get memory usage
	 *
	 * @return integer
	 */
	function getMemoryUsage() {
		if(function_exists('memory_get_usage')) {
			return function_exists('memory_get_peak_usage')
				? memory_get_peak_usage(true)
				: memory_get_usage();
		}
		return 0;
	}
}

?>