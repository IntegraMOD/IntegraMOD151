<?php
/***************************************************************************
                                digest_emailer.php
                             -------------------
    begin                : Sat Oct 4 2003
    copyright            : (C) 2000 The phpBB Group
    email                : support@phpBB.com


 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

// Written by Mark D. Hamill, mhamill@computer.org
// This software is designed to work with phpBB Version 2.0.8 

// This is a special version of the emailer class with a few of code added
// so an HTML digest can be sent. The original class tells email clients that ASCII
// email is being sent always. This code had to be snipped so that web based
// email clients like Yahoo! Mail could receive formatted email.

if ( !defined('IN_PHPBB') )
{
  die("Hacking attempt");
}

class digest_emailer
{
	var $msg, $subject, $extra_headers;
	var $addresses, $reply_to, $from;
	var $use_smtp;

	var $tpl_msg = array();

	function emailer($use_smtp)
	{
		$this->reset();
		$this->use_smtp = $use_smtp;
		$this->reply_to = $this->from = '';
	}

	// Resets all the data (address, template file, etc etc to default
	function reset()
	{
		$this->addresses = array();
		$this->vars = $this->msg = $this->extra_headers = '';
	}

	// Sets an email address to send to
	function email_address($address)
	{
		$this->addresses['to'] = trim($address);
	}

	function cc($address)
	{
		$this->addresses['cc'][] = trim($address);
	}

	function bcc($address)
	{
		$this->addresses['bcc'][] = trim($address);
	}

	function replyto($address)
	{
		$this->reply_to = trim($address);
	}

	function from($address)
	{
		$this->from = trim($address);
	}

	// set up subject for mail
	function set_subject($subject = '')
	{
		$this->subject = trim(preg_replace('#[\n\r]+#s', '', $subject));
	}

	// set up extra mail headers
	function extra_headers($headers)
	{
		$this->extra_headers .= trim($headers) . "\n";
	}

	function use_template($template_file, $template_lang = '')
	{
		global $board_config, $phpbb_root_path;

		if (trim($template_file) == '')
		{
			//message_die(GENERAL_ERROR, 'No template file set', '', __LINE__, __FILE__);
		}

		if (trim($template_lang) == '')
		{
			$template_lang = $board_config['default_lang'];
		}

		if (empty($this->tpl_msg[$template_lang . $template_file]))
		{
			$tpl_file = $phpbb_root_path . 'language/lang_' . $template_lang . '/email/' . $template_file . '.tpl';

			if (!@file_exists(@phpbb_realpath($tpl_file)))
			{
				$tpl_file = $phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/email/' . $template_file . '.tpl';

				if (!@file_exists(@phpbb_realpath($tpl_file)))
				{
					//message_die(GENERAL_ERROR, 'Could not find email template file :: ' . $template_file, '', __LINE__, __FILE__);
				}
			}

			if (!($fd = @fopen($tpl_file, 'r')))
			{
				//message_die(GENERAL_ERROR, 'Failed opening template file :: ' . $tpl_file, '', __LINE__, __FILE__);
			}

			$this->tpl_msg[$template_lang . $template_file] = fread($fd, filesize($tpl_file));
			fclose($fd);
		}

		$this->msg = $this->tpl_msg[$template_lang . $template_file];

		return true;
	}

	// assign variables
	function assign_vars($vars)
	{
		$this->vars = (empty($this->vars)) ? $vars : $this->vars . $vars;
	}

	// Send the mail out to the recipients set previously in var $this->address
	function send($is_html)
	{
		global $board_config, $lang, $phpEx, $phpbb_root_path, $db;

    	// Escape all quotes, else the eval will fail.
		$this->msg = str_replace ("'", "\'", $this->msg);
		$this->msg = preg_replace('#\{([a-z0-9\-_]*?)\}#is', "' . $\\1 . '", $this->msg);

		// Set vars
		reset ($this->vars);
		while (list($key, $val) = each($this->vars)) 
		{
			$$key = $val;
		}

		eval("\$this->msg = '$this->msg';");

		// Clear vars
		reset ($this->vars);
		while (list($key, $val) = each($this->vars)) 
		{
			unset($$key);
		}

		// We now try and pull a subject from the email body ... if it exists,
		// do this here because the subject may contain a variable
		$drop_header = '';
		$match = array();
		if (preg_match('#^(Subject:(.*?))$#m', $this->msg, $match))
		{
			$this->subject = (trim($match[2]) != '') ? trim($match[2]) : (($this->subject != '') ? $this->subject : 'No Subject');
			$drop_header .= '[\r\n]*?' . phpbb_preg_quote($match[1], '#');
		}
		else
		{
			$this->subject = (($this->subject != '') ? $this->subject : 'No Subject');
		}

		if (preg_match('#^(Charset:(.*?))$#m', $this->msg, $match))
		{
			$this->encoding = (trim($match[2]) != '') ? trim($match[2]) : trim($lang['ENCODING']);
			$drop_header .= '[\r\n]*?' . phpbb_preg_quote($match[1], '#');
		}
		else
		{
			$this->encoding = trim($lang['ENCODING']);
		}

		if ($drop_header != '')
		{
			$this->msg = trim(preg_replace('#' . $drop_header . '#s', '', $this->msg));
		}

		$to = $this->addresses['to'];

		$cc = (count($this->addresses['cc'])) ? implode(', ', $this->addresses['cc']) : '';
		$bcc = (count($this->addresses['bcc'])) ? implode(', ', $this->addresses['bcc']) : '';

		// Build header
		// This is the one line of code modified from emailer.php so mail_digests.php can send HTML
		if ($is_html)
		{
 			$this->extra_headers = (($this->reply_to != '') ? "Reply-to: $this->reply_to\n" : '') . (($this->from != '') ? "From: $this->from\n" : "From: " . $board_config['board_email'] . "\n") . "Return-Path: " . $board_config['board_email'] . "\nMessage-ID: <" . md5(uniqid(time())) . "@" . $board_config['server_name'] . ">\nContent-transfer-encoding: 8bit\nDate: " . date('r', time()) . "\nX-Priority: 3\nX-MSMail-Priority: Normal\nX-Mailer: PHP\nX-MimeOLE: Produced By phpBB2\n" . $this->extra_headers . (($cc != '') ? "Cc: $cc\n" : '')  . (($bcc != '') ? "Bcc: $bcc\n" : '');
		}
		else 
		{
			$this->extra_headers = (($this->reply_to != '') ? "Reply-to: $this->reply_to\n" : '') . (($this->from != '') ? "From: $this->from\n" : "From: " . $board_config['board_email'] . "\n") . "Return-Path: " . $board_config['board_email'] . "\nMessage-ID: <" . md5(uniqid(time())) . "@" . $board_config['server_name'] . ">\nMIME-Version: 1.0\nContent-type: text/plain; charset=" . $this->encoding . "\nContent-transfer-encoding: 8bit\nDate: " . date('r', time()) . "\nX-Priority: 3\nX-MSMail-Priority: Normal\nX-Mailer: PHP\nX-MimeOLE: Produced By phpBB2\n" . $this->extra_headers . (($cc != '') ? "Cc: $cc\n" : '')  . (($bcc != '') ? "Bcc: $bcc\n" : '');
		}
		// Send message ... removed $this->encode() from subject for time being
		if ( $this->use_smtp )
		{
			if ( !defined('SMTP_INCLUDED') ) 
			{
				include($phpbb_root_path . 'includes/smtp.' . $phpEx);
			}

			$result = smtpmail($to, $this->subject, $this->msg, $this->extra_headers);
		}
		else
		{
                	$empty_to_header = ($to == '') ? TRUE : FALSE;
			$to = ($to == '') ? (($board_config['sendmail_fix']) ? ' ' : 'Undisclosed-recipients:;') : $to;
	
			$result = @mail($to, $this->subject, preg_replace("#(?<!\r)\n#s", "\n", $this->msg), $this->extra_headers);
			
			if (!$result && !$board_config['sendmail_fix'] && $empty_to_header)
			{
				$to = ' ';

				$sql = "UPDATE " . CONFIG_TABLE . " 
					SET config_value = '1'
					WHERE config_name = 'sendmail_fix'";
				if (!$db->sql_query($sql))
				{
					//message_die(GENERAL_ERROR, 'Unable to update config table', '', __LINE__, __FILE__, $sql);
				}

				$board_config['sendmail_fix'] = 1;
				$result = @mail($to, $this->subject, preg_replace("#(?<!\r)\n#s", "\n", $this->msg), $this->extra_headers);
			}
		        //die(preg_replace("#(?<!\r)\n#s", "\n", $this->msg));
                }
		// Did it work?
		if (!$result)
		{
			message_die(GENERAL_ERROR, 'Failed sending email :: ' . (($this->use_smtp) ? 'SMTP' : 'PHP') . ' :: ' . $result, '', __LINE__, __FILE__);
		}

		return true;
	}

	// Encodes the given string for proper display for this encoding ... nabbed 
	// from php.net and modified. There is an alternative encoding method which 
	// may produce lesd output but it's questionable as to its worth in this 
	// scenario IMO
	function encode($str)
	{
		if ($this->encoding == '')
		{
			return $str;
		}

		// define start delimimter, end delimiter and spacer
		$end = "?=";
		$start = "=?$this->encoding?B?";
		$spacer = "$end\r\n $start";

		// determine length of encoded text within chunks and ensure length is even
		$length = 75 - strlen($start) - strlen($end);
		$length = floor($length / 2) * 2;

		// encode the string and split it into chunks with spacers after each chunk
		$str = chunk_split(base64_encode($str), $length, $spacer);

		// remove trailing spacer and add start and end delimiters
		$str = preg_replace('#' . phpbb_preg_quote($spacer, '#') . '$#', '', $str);

		return $start . $str . $end;
	}

	//
	// Attach files via MIME.
	//
	function attachFile($filename, $mimetype = "application/octet-stream", $szFromAddress, $szFilenameToDisplay)
	{
		global $lang;
		$mime_boundary = "--==================_846811060==_";

		$this->msg = '--' . $mime_boundary . "\nContent-Type: text/plain;\n\tcharset=\"" . $lang['ENCODING'] . "\"\n\n" . $this->msg;

		if ($mime_filename)
		{
			$filename = $mime_filename;
			$encoded = $this->encode_file($filename);
		}

		$fd = fopen($filename, "r");
		$contents = fread($fd, filesize($filename));

		$this->mimeOut = "--" . $mime_boundary . "\n";
		$this->mimeOut .= "Content-Type: " . $mimetype . ";\n\tname=\"$szFilenameToDisplay\"\n";
		$this->mimeOut .= "Content-Transfer-Encoding: quoted-printable\n";
		$this->mimeOut .= "Content-Disposition: attachment;\n\tfilename=\"$szFilenameToDisplay\"\n\n";

		if ( $mimetype == "message/rfc822" )
		{
			$this->mimeOut .= "From: ".$szFromAddress."\n";
			$this->mimeOut .= "To: ".$this->emailAddress."\n";
			$this->mimeOut .= "Date: ".date("D, d M Y H:i:s") . " UT\n";
			$this->mimeOut .= "Reply-To:".$szFromAddress."\n";
			$this->mimeOut .= "Subject: ".$this->mailSubject."\n";
			$this->mimeOut .= "X-Mailer: PHP/".phpversion()."\n";
			$this->mimeOut .= "MIME-Version: 1.0\n";
		}

		$this->mimeOut .= $contents."\n";
		$this->mimeOut .= "--" . $mime_boundary . "--" . "\n";

		return $out;
		// added -- to notify email client attachment is done
	}

	function getMimeHeaders($filename, $mime_filename="")
	{
		$mime_boundary = "--==================_846811060==_";

		if ($mime_filename)
		{
			$filename = $mime_filename;
		}

		$out = "MIME-Version: 1.0\n";
		$out .= "Content-Type: multipart/mixed;\n\tboundary=\"$mime_boundary\"\n\n";
		$out .= "This message is in MIME format. Since your mail reader does not understand\n";
		$out .= "this format, some or all of this message may not be legible.";

		return $out;
	}

	//
   // Split string by RFC 2045 semantics (76 chars per line, end with \r\n).
	//
	function myChunkSplit($str)
	{
		$stmp = $str;
		$len = strlen($stmp);
		$out = "";

		while ($len > 0)
		{
			if ($len >= 76)
			{
				$out .= substr($stmp, 0, 76) . "\r\n";
				$stmp = substr($stmp, 76);
				$len = $len - 76;
			}
			else
			{
				$out .= $stmp . "\r\n";
				$stmp = "";
				$len = 0;
			}
		}
		return $out;
	}

	//
   // Split the specified file up into a string and return it
	//
	function encode_file($sourcefile)
	{
		if (is_readable(phpbb_realpath($sourcefile)))
		{
			$fd = fopen($sourcefile, "r");
			$contents = fread($fd, filesize($sourcefile));
	      $encoded = $this->myChunkSplit(base64_encode($contents));
	      fclose($fd);
		}

		return $encoded;
	}

} // class emailer

function auth_read($userdata)
{
    global $db, $lang;

    $type = AUTH_READ;
    $forum_id = AUTH_LIST_ALL;
    $f_access = '';

    switch( $type )
    {
        case AUTH_ALL:
            $a_sql = 'a.auth_view, a.auth_read, a.auth_post, a.auth_reply, a.auth_edit, a.auth_delete, a.auth_sticky, a.auth_announce, a.auth_global_announce, a.auth_vote, a.auth_pollcreate';
            $auth_fields = array('auth_view', 'auth_read', 'auth_post', 'auth_reply', 'auth_edit', 'auth_delete', 'auth_sticky', 'auth_announce', 'auth_global_announce', 'auth_vote', 'auth_pollcreate');
            break;
        case AUTH_VIEW:
            $a_sql = 'a.auth_view';
            $auth_fields = array('auth_view');
            break;
        case AUTH_READ:
    		$a_sql = 'a.auth_read';
    		$auth_fields = array('auth_read');
            break;
        case AUTH_POST:
            $a_sql = 'a.auth_post';
            $auth_fields = array('auth_post');
            break;
        case AUTH_REPLY:
            $a_sql = 'a.auth_reply';
            $auth_fields = array('auth_reply');
            break;
        case AUTH_EDIT:
            $a_sql = 'a.auth_edit';
            $auth_fields = array('auth_edit');
            break;
        case AUTH_DELETE:
            $a_sql = 'a.auth_delete';
            $auth_fields = array('auth_delete');
            break;
        case AUTH_STICKY:
            $a_sql = 'a.auth_sticky';
            $auth_fields = array('auth_sticky');
            break;
        case AUTH_POLLCREATE:
            $a_sql = 'a.auth_pollcreate';
            $auth_fields = array('auth_pollcreate');
            break;
        case AUTH_VOTE:
            $a_sql = 'a.auth_vote';
            $auth_fields = array('auth_vote');
            break;
        default:
            break;
    }
	//
	// If f_access has been passed, or auth is needed to return an array of forums
	// then we need to pull the auth information on the given forum (or all forums)
	//
	if ( empty($f_access) )
	{
		$forum_match_sql = ( $forum_id != AUTH_LIST_ALL ) ? "WHERE a.forum_id = $forum_id" : '';

		$sql = "SELECT a.forum_id, $a_sql
			FROM " . FORUMS_TABLE . " a
			$forum_match_sql";
		if ( !($result = $db->sql_query($sql)) )
		{
			//message_die(GENERAL_ERROR, 'Failed obtaining forum access control lists', '', __LINE__, __FILE__, $sql);
		}

		$sql_fetchrow = ( $forum_id != AUTH_LIST_ALL ) ? 'sql_fetchrow' : 'sql_fetchrowset';

		if ( !($f_access = $db->$sql_fetchrow($result)) )
		{
			$db->sql_freeresult($result);
			return array();
		}
		$db->sql_freeresult($result);
	}

	$u_access = array();

	$forum_match_sql = ( $forum_id != AUTH_LIST_ALL ) ? "AND a.forum_id = $forum_id" : '';

	$sql = "SELECT a.forum_id, $a_sql, a.auth_mod 
		FROM " . AUTH_ACCESS_TABLE . " a, " . USER_GROUP_TABLE . " ug 
		WHERE ug.user_id = ". intval($userdata['user_id']). " 
			AND ug.user_pending = 0 
			AND a.group_id = ug.group_id
			$forum_match_sql";
	if ( !($result = $db->sql_query($sql)) )
	{
		//message_die(GENERAL_ERROR, 'Failed obtaining forum access control lists', '', __LINE__, __FILE__, $sql);
	}

	if ( $row = $db->sql_fetchrow($result) )
    {
        do
        {
            if ( $forum_id != AUTH_LIST_ALL)
            {
                $u_access[] = $row;
            }
            else
            {
                $u_access[$row['forum_id']][] = $row;
            }
        }
        while( $row = $db->sql_fetchrow($result) );
    }

	$is_admin = ( $userdata['user_level'] == ADMIN ) ? TRUE : 0;

	$auth_user = array();
	for($i = 0; $i < count($auth_fields); $i++)
	{
		$key = $auth_fields[$i];

		if ( $forum_id != AUTH_LIST_ALL )
		{
			$value = $f_access[$key];

			switch( $value )
			{
				case AUTH_ALL:
					$auth_user[$key] = TRUE;
					$auth_user[$key . '_type'] = $lang['Auth_Anonymous_Users'];
					break;

				case AUTH_REG:
					$auth_user[$key] = TRUE;
					$auth_user[$key . '_type'] = $lang['Auth_Registered_Users'];
					break;

				case AUTH_ACL:
					$auth_user[$key] = auth_check_user(AUTH_ACL, $key, $u_access, $is_admin);
					$auth_user[$key . '_type'] = $lang['Auth_Users_granted_access'];
					break;

				case AUTH_MOD:
					$auth_user[$key] = auth_check_user(AUTH_MOD, 'auth_mod', $u_access, $is_admin);
					$auth_user[$key . '_type'] = $lang['Auth_Moderators'];
					break;

				case AUTH_ADMIN:
					$auth_user[$key] = $is_admin;
					$auth_user[$key . '_type'] = $lang['Auth_Administrators'];
					break;

				default:
					$auth_user[$key] = 0;
					break;
			}
		}
		else
		{
			for($k = 0; $k < count($f_access); $k++)
			{
				$value = $f_access[$k][$key];
				$f_forum_id = $f_access[$k]['forum_id'];

				switch( $value )
				{
					case AUTH_ALL:
						$auth_user[$f_forum_id][$key] = TRUE;
						$auth_user[$f_forum_id][$key . '_type'] = $lang['Auth_Anonymous_Users'];
						break;

					case AUTH_REG:
						$auth_user[$f_forum_id][$key] = TRUE;
						$auth_user[$f_forum_id][$key . '_type'] = $lang['Auth_Registered_Users'];
						break;

					case AUTH_ACL:
						$auth_user[$f_forum_id][$key] = auth_check_user(AUTH_ACL, $key, $u_access[$f_forum_id], $is_admin);
						$auth_user[$f_forum_id][$key . '_type'] = $lang['Auth_Users_granted_access'];
						break;

					case AUTH_MOD:
						$auth_user[$f_forum_id][$key] = auth_check_user(AUTH_MOD, 'auth_mod', $u_access[$f_forum_id], $is_admin);
						$auth_user[$f_forum_id][$key . '_type'] = $lang['Auth_Moderators'];
						break;

					case AUTH_ADMIN:
						$auth_user[$f_forum_id][$key] = $is_admin;
						$auth_user[$f_forum_id][$key . '_type'] = $lang['Auth_Administrators'];
						break;

					default:
						$auth_user[$f_forum_id][$key] = 0;
						break;
				}
			}
		}
	}

	//
	// Is user a moderator?
	//
	if ( $forum_id != AUTH_LIST_ALL )
	{
		$auth_user['auth_mod'] = auth_check_user(AUTH_MOD, 'auth_mod', $u_access, $is_admin);
	}
	else
	{
		for($k = 0; $k < count($f_access); $k++)
		{
			$f_forum_id = $f_access[$k]['forum_id'];

			$auth_user[$f_forum_id]['auth_mod'] = auth_check_user(AUTH_MOD, 'auth_mod', $u_access[$f_forum_id], $is_admin);
		}
	}

	return $auth_user;
}

//
// digest_smiles_pass is a clone of similes_pass that is in bbcode.php
// like the mailer class, it wasn't quite desgined for the use that email
// digests puts it to, so here we have a modified version. This version
// creates a fully qualified path to the image, instead of a relative one
//

function digest_smilies_pass($message, $siteURL)
{
	static $orig, $repl;

	if (!isset($orig))
	{
		global $db, $board_config, $portal_config, $var_cache;;
		$orig = $repl = array();

                if($portal_config['cache_enabled'])
		{
			$orig = $var_cache->get('orig3', 86400, 'smilies');
			$repl = $var_cache->get('repl3', 86400, 'smilies');
		}
                if(!$orig)
		{
     		        $sql = 'SELECT * FROM ' . SMILIES_TABLE;
     		        if( !$result = $db->sql_query($sql) )
     		        {
     			        //message_die(GENERAL_ERROR, "Couldn't obtain smilies data", "", __LINE__, __FILE__, $sql);
     		        }
     		        $smilies = $db->sql_fetchrowset($result);

     		        if (count($smilies))
     		        {
     			        usort($smilies, 'smiley_sort');
                        }

		        for ($i = 0; $i < count($smilies); $i++)
		        {
			        $orig[] = "/(?<=.\W|\W.|^\W)" . phpbb_preg_quote($smilies[$i]['code'], "/") . "(?=.\W|\W.|\W$)/";
			        $repl[] = '<img src="' . $siteURL . '/' . $board_config['smilies_path'] . '/' . $smilies[$i]['smile_url'] . '" alt="' . $smilies[$i]['emoticon'] . '" border="0" />';
		        }

                        if($portal_config['cache_enabled'])
			{
				$var_cache->save($orig, 'orig3', 'smilies');
				$var_cache->save($repl, 'repl3', 'smilies');
			}
                }
	}

	if (count($orig))
	{
		$message = preg_replace($orig, $repl, ' ' . $message . ' ');
		$message = substr($message, 1, -1);
	}

	return $message;
}

function digest_trim_text( &$text, $size)
  {
    $pos = strpos( $text, htmlspecialchars( '<!--break-->' ) );
    if( ($pos !== false) && ($pos < strlen( $text )) ) {
      return substr( $text, 0, $pos );
    }
    // Breaks up the message by blocks of bbcodes.
    // The message is divided into two parts,
    // 1. text inside a pair of bbcode tags.
    // 2. text not contained inside a pair of bbcode tags.
    $segments = preg_split(
          '#(\[([a-zA-Z]+?).*?\].+?\[/\\2.*?\])#s' ,
          $text, -1,
          PREG_SPLIT_NO_EMPTY);

	$offset = 0;
	foreach( $segments as $segment )
    {
	  $segment_length = strpos($text,$segment,$offset);
      if( ($segment_length + strlen($segment) > $size) &&
        ($segment_length <= $size) )
      // $size fall inside the current block.
      {
        $trimmed = true;
        return substr( $text, 0, $size );
      }
      elseif( $segment_length > $size )
      // We have gone past the trim point.
      {
        $trimmed = true;
        return substr( $text, 0, $segment_length );
      }
	  $offset = $segment_length + 1;
    }
    return $text;
  }

function unhtmlentities($string) {
    $trans_tbl = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
    $trans_tbl = array_flip($trans_tbl);
    return strtr($string, $trans_tbl);
}
?>
