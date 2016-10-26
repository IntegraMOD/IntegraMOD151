<?php

/**
 * This code is part of the FileManager software (www.gerd-tentler.de/tools/filemanager), copyright by
 * Gerd Tentler. Obtain permission before selling this code or hosting it on a commercial website or
 * redistributing it over the Internet or in any other medium. In all cases copyright must remain intact.
 */

include_once('FM_File.php');

/**
 * This class handles file operations on a single file.
 *
 * @package FileManager
 * @subpackage class
 * @author Gerd Tentler
 */
class FM_FileMp3 extends FM_File {

/* PRIVATE PROPERTIES ************************************************************************** */

	/**
	 * list of ID3 tags
	 *
	 * @var array
	 */
	var $_id3Tags = array(
		'TALB' => 'album',
		'TCON' => 'genre',
		'TENC' => 'encoder',
		'TIT2' => 'title',
		'TPE1' => 'artist',
		'TPE2' => 'ensemble',
		'TYER' => 'year',
		'TCOM' => 'composer',
		'TCOP' => 'copyright',
		'TRCK' => 'track',
		'WOAR' => 'url',
		'COMM' => 'comment',
		'APIC' => 'picture'
	);

	/**
	 * list of ID3 genres
	 *
	 * @var array
	 */
	var $_id3Genres = array(
		0 => 'Blues',
		1 => 'Classic Rock',
		2 => 'Country',
		3 => 'Dance',
		4 => 'Disco',
		5 => 'Funk',
		6 => 'Grunge',
		7 => 'Hip-Hop',
		8 => 'Jazz',
		9 => 'Metal',
		10 => 'New Age',
		11 => 'Oldies',
		12 => 'Other',
		13 => 'Pop',
		14 => 'R&B',
		15 => 'Rap',
		16 => 'Reggae',
		17 => 'Rock',
		18 => 'Techno',
		19 => 'Industrial',
		20 => 'Alternative',
		21 => 'Ska',
		22 => 'Death Metal',
		23 => 'Pranks',
		24 => 'Soundtrack',
		25 => 'Euro-Techno',
		26 => 'Ambient',
		27 => 'Trip-Hop',
		28 => 'Vocal',
		29 => 'Jazz+Funk',
		30 => 'Fusion',
		31 => 'Trance',
		32 => 'Classical',
		33 => 'Instrumental',
		34 => 'Acid',
		35 => 'House',
		36 => 'Game',
		37 => 'Sound Clip',
		38 => 'Gospel',
		39 => 'Noise',
		40 => 'Alternative Rock',
		41 => 'Bass',
		42 => 'Soul',
		43 => 'Punk',
		44 => 'Space',
		45 => 'Meditative',
		46 => 'Instrumental Pop',
		47 => 'Instrumental Rock',
		48 => 'Ethnic',
		49 => 'Gothic',
		50 => 'Darkwave',
		51 => 'Techno-Industrial',
		52 => 'Electronic',
		53 => 'Pop-Folk',
		54 => 'Eurodance',
		55 => 'Dream',
		56 => 'Southern Rock',
		57 => 'Comedy',
		58 => 'Cult',
		59 => 'Gangsta',
		60 => 'Top 40',
		61 => 'Christian Rap',
		62 => 'Pop/Funk',
		63 => 'Jungle',
		64 => 'Native US',
		65 => 'Cabaret',
		66 => 'New Wave',
		67 => 'Psychadelic',
		68 => 'Rave',
		69 => 'Showtunes',
		70 => 'Trailer',
		71 => 'Lo-Fi',
		72 => 'Tribal',
		73 => 'Acid Punk',
		74 => 'Acid Jazz',
		75 => 'Polka',
		76 => 'Retro',
		77 => 'Musical',
		78 => 'Rock & Roll',
		79 => 'Hard Rock',
		80 => 'Folk',
		81 => 'Folk-Rock',
		82 => 'National Folk',
		83 => 'Swing',
		84 => 'Fast Fusion',
		85 => 'Bebob',
		86 => 'Latin',
		87 => 'Revival',
		88 => 'Celtic',
		89 => 'Bluegrass',
		90 => 'Avantgarde',
		91 => 'Gothic Rock',
		92 => 'Progressive Rock',
		93 => 'Psychedelic Rock',
		94 => 'Symphonic Rock',
		95 => 'Slow Rock',
		96 => 'Big Band',
		97 => 'Chorus',
		98 => 'Easy Listening',
		99 => 'Acoustic',
		100 => 'Humour',
		101 => 'Speech',
		102 => 'Chanson',
		103 => 'Opera',
		104 => 'Chamber Music',
		105 => 'Sonata',
		106 => 'Symphony',
		107 => 'Booty Bass',
		108 => 'Primus',
		109 => 'Porn Groove',
		110 => 'Satire',
		111 => 'Slow Jam',
		112 => 'Club',
		113 => 'Tango',
		114 => 'Samba',
		115 => 'Folklore',
		116 => 'Ballad',
		117 => 'Power Ballad',
		118 => 'Rhytmic Soul',
		119 => 'Freestyle',
		120 => 'Duet',
		121 => 'Punk Rock',
		122 => 'Drum Solo',
		123 => 'Acapella',
		124 => 'Euro-House',
		125 => 'Dance Hall',
		126 => 'Goa',
		127 => 'Drum & Bass',
		128 => 'Club-House',
		129 => 'Hardcore',
		130 => 'Terror',
		131 => 'Indie',
		132 => 'BritPop',
		133 => 'Negerpunk',
		134 => 'Polsk Punk',
		135 => 'Beat',
		136 => 'Christian Gangsta Rap',
		137 => 'Heavy Metal',
		138 => 'Black Metal',
		139 => 'Crossover',
		140 => 'Contemporary Christian',
		141 => 'Christian Rock',
		142 => 'Merengue',
		143 => 'Salsa',
		144 => 'Trash Metal',
		145 => 'Anime',
		146 => 'Jpop',
		147 => 'Synthpop'
	);

/* PUBLIC METHODS ****************************************************************************** */

	/**
	 * read ID3 tags from MP3 file
	 *
	 * @return array
	 */
	function readId3Tags() {
		$v1 = $this->_readId3v1Tags();
		$v2 = $this->_readId3v2Tags();
		$id3 = array();

		if(!$v1 && !$v2) return $id3;
		if(!$v1) return $v2;
		if(!$v2) return $v1;

		foreach($v2 as $key => $value) {
			$value = trim($value);

			if(isset($v1[$key]) && strlen(trim($v1[$key])) > strlen($value)) {
				$value = $v1[$key];
			}
			else if($key == 'genre') {
				if(preg_match('/^\(?(\d+)\)?$/', $value, $m) && $this->_id3Genres[$m[1]]) {
					$value = $this->_id3Genres[$m[1]];
				}
				else $value = preg_replace('/^\(\d+\)/', '', $value);
			}
			$id3[$key] = $value;
		}

		foreach($v1 as $key => $value) {
			if(!isset($id3[$key])) $id3[$key] = $value;
		}
		ksort($id3);
		return $id3;
	}

/* PRIVATE METHODS ***************************************************************************** */

	/**
	 * read ID3 v2 tags from local MP3 file
	 *
	 * @return array
	 */
	function _readId3v2Tags() {
		if($fp = @fopen($this->_file, 'r')) {
			$header = @unpack('a3signature/c1version_major/c1version_minor/c1flags/Nsize', @fread($fp, 10));

	        if($header['signature'] != 'ID3') {
				@fclose($fp);
				return false;
			}
	   		$id3 = array();

	   		for($i = 0; $i < 22; $i++) {
				$tag = rtrim(@fread($fp, 6));

				$size = @unpack('n', @fread($fp, 2));
				$size = $size[1] + 2;

				$value = @fread($fp, $size);

				if($tag && $this->_id3Tags[$tag]) {
					if($tag == 'COMM') $value = substr($value, 4);

					if($tag == 'APIC') {
						if(preg_match('/image\/([a-z]+)\0.*?\0.*?\0(.+)/s', $value, $m)) {
							$Listing = $this->_FileManager->getListing();
							$name = FM_Tools::basename($this->_file);
							$name = md5($Listing->curDir . '/' . $name) . '.' . strtolower($m[1]);
							$path = $this->_FileManager->getCacheDir() . '/' . $name;

							if(!is_file($path)) {
								$value = FM_Tools::saveLocalFile($path, $m[2]) ? $name : '';
							}
							else $value = $name;

							if($value != '') {
								$size = @getimagesize($path);
								$value .= ':' . $size[0] . ':' . $size[1];
							}
						}
						else $value = '';
					}
					else if(function_exists('iconv')) {
						switch(ord($value[2])) {
							case 0: $value = iconv('ISO-8859-1', 'UTF-8', substr($value, 3)); break;
							case 1: $value = iconv('UTF-16LE', 'UTF-8', substr($value, 5)); break;
							case 2: $value = iconv('UTF-16BE', 'UTF-8', substr($value, 5)); break;
						}
					}
					else if(function_exists('mb_convert_encoding')) {
						switch(ord($value[2])) {
							case 0: $value = mb_convert_encoding(substr($value, 3), 'UTF-8', 'ISO-8859-1'); break;
							case 1: $value = mb_convert_encoding(substr($value, 5), 'UTF-8', 'UTF-16LE'); break;
							case 2: $value = mb_convert_encoding(substr($value, 5), 'UTF-8', 'UTF-16BE'); break;
						}
					}
					if($value != '') $id3[$this->_id3Tags[$tag]] = preg_replace('/[\x00-\x1A]+/', '', $value);
				}
			}
			@fclose($fp);
	  		return $id3;
		}
		return false;
	}

	/**
	 * read ID3 v1 tags from local MP3 file
	 *
	 * @return array
	 */
	function _readId3v1Tags() {
		if($fp = @fopen($this->_file, 'r')) {
			@fseek($fp, -128, SEEK_END);
			$id3 = @fread($fp, 128);
			@fclose($fp);

			$id3 = @unpack('a3signature/a30title/a30artist/a30album/a4year/a28comment/C1zerobyte/C1track/c1genre', $id3);

			if($id3['signature'] != 'TAG') {
				return false;
			}
			unset($id3['signature']);
			unset($id3['zerobyte']);
			$n = $id3['track'];

			if(!($n > 0 && $n < 30) && (ord($n) > 0 && ord($n) < 30)) {
				$id3['track'] = ord($id3['track']);
			}
			$id3['comment'] = rtrim($id3['comment']);
			$id3['genre'] = $this->_id3Genres[$id3['genre']];
	  		return $id3;
		}
		return false;
	}
}

?>