<?php
// -------------------------------------------------------------
//
// $Id: ---- $
//
// FILENAME  : bbcode.php
// STARTED   : Sat Feb 13, 2001
// COPYRIGHT : © 2001, 2005 phpBB Group
// WWW       : http://www.phpbb.com/
// LICENCE   : GPL vs2.0 [ see /docs/COPYING ]
//
// -------------------------------------------------------------

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

define("BBCODE_UID_LEN", 10);

// global that holds loaded-and-prepared bbcode templates, so we only have to do
// that stuff once.

$bbcode_tpl = null;

/**
 * Loads bbcode templates from the bbcode.tpl file of the current template set.
 * Creates an array, keys are bbcode names like "b_open" or "url", values
 * are the associated template.
 * Probably pukes all over the place if there's something really screwed
 * with the bbcode.tpl file.
 *
 * Nathan Codding, Sept 26 2001.
 */
function load_bbcode_template()
{
	global $template;
	$tpl_filename = $template->make_filename('bbcode.tpl');
	$tpl = fread(fopen($tpl_filename, 'r'), filesize($tpl_filename));

	// replace \ with \\ and then ' with \'.
	$tpl = str_replace('\\', '\\\\', $tpl);
	$tpl  = str_replace('\'', '\\\'', $tpl);

	// strip newlines.
	$tpl  = str_replace("\n", '', $tpl);

	// Turn template blocks into PHP assignment statements for the values of $bbcode_tpls..
	$tpl = preg_replace('#<!-- BEGIN (.*?) -->(.*?)<!-- END (.*?) -->#', "\n" . '$bbcode_tpls[\'\\1\'] = \'\\2\';', $tpl);

	$bbcode_tpls = array();

	eval($tpl);

	return $bbcode_tpls;
}


/**
 * Prepares the loaded bbcode templates for insertion into preg_replace()
 * or str_replace() calls in the bbencode_second_pass functions. This
 * means replacing template placeholders with the appropriate preg backrefs
 * or with language vars. NOTE: If you change how the regexps work in
 * bbencode_second_pass(), you MUST change this function.
 *
 * Nathan Codding, Sept 26 2001
 *
 */
function prepare_bbcode_template($bbcode_tpl)
{
	global $lang, $current_template_path;

	$bbcode_tpl['olist_open'] = str_replace('{LIST_TYPE}', '\\1', $bbcode_tpl['olist_open']);

	$bbcode_tpl['color_open'] = str_replace('{COLOR}', '\\1', $bbcode_tpl['color_open']);

	$bbcode_tpl['size_open'] = str_replace('{SIZE}', '\\1', $bbcode_tpl['size_open']);

	$bbcode_tpl['quote_open'] = str_replace('{L_QUOTE}', $lang['Quote'], $bbcode_tpl['quote_open']);

	$bbcode_tpl['quote_username_open'] = str_replace('{L_QUOTE}', $lang['Quote'], $bbcode_tpl['quote_username_open']);
	$bbcode_tpl['quote_username_open'] = str_replace('{L_WROTE}', $lang['wrote'], $bbcode_tpl['quote_username_open']);
	$bbcode_tpl['quote_username_open'] = str_replace('{USERNAME}', '\\1', $bbcode_tpl['quote_username_open']);

	$bbcode_tpl['quote_post_open'] = str_replace('{L_QUOTE}', $lang['Quote'], $bbcode_tpl['quote_post_open']);
	$temp_url = append_sid('show_post.php?p=\\1');
	$bbcode_tpl['quote_post_open'] = str_replace('{U_VIEW_POST}', '<a href="#_somewhat" onClick="javascript:open_postreview( \'' . $temp_url . '\' );" class="genmed">' . $lang['View_post'] . '</a>', $bbcode_tpl['quote_post_open']);

	$bbcode_tpl['quote_username_post_open'] = str_replace('{L_QUOTE}', $lang['Quote'], $bbcode_tpl['quote_username_post_open']);
	$bbcode_tpl['quote_username_post_open'] = str_replace('{L_WROTE}', $lang['wrote'], $bbcode_tpl['quote_username_post_open']);
	$bbcode_tpl['quote_username_post_open'] = str_replace('{USERNAME}', '\\1', $bbcode_tpl['quote_username_post_open']);
	$temp_url = append_sid('show_post.php?p=\\2');
	$bbcode_tpl['quote_username_post_open'] = str_replace('{U_VIEW_POST}', '<a href="#_somewhat" onClick="javascript:open_postreview( \'' . $temp_url . '\' );" class="genmed">' . $lang['View_post'] . '</a>', $bbcode_tpl['quote_username_post_open']);

	$bbcode_tpl['code_open'] = str_replace('{L_CODE}', $lang['Code'], $bbcode_tpl['code_open']);
	$bbcode_tpl['php_open'] = str_replace('{L_PHP}', $lang['PHPCode'], $bbcode_tpl['php_open']); // PHP MOD

	$bbcode_tpl['img'] = str_replace('{URL}', '\\1', get_image_tag_replacement($bbcode_tpl));
	$bbcode_tpl['imgrel'] = str_replace('{URL}', '\\1', $bbcode_tpl['imgrel']);
	$bbcode_tpl['theme'] =  str_replace('{URL}', $current_template_path . '/\\1', $bbcode_tpl['theme']);

	//BBCode Search Mod
	$bbcode_tpl['search'] = str_replace('{KEYWORD}', '\\1', $bbcode_tpl['search']);

// LEFT-RIGHT-start
	$bbcode_tpl['left'] = str_replace('{URL}', '\\1', $bbcode_tpl['left']);
	$bbcode_tpl['right'] = str_replace('{URL}', '\\1', $bbcode_tpl['right']);
	$bbcode_tpl['center'] = str_replace('{URL}', '\\1', $bbcode_tpl['center']);
	$bbcode_tpl['themeleft'] = str_replace('{URL}', $current_template_path . '/\\1', $bbcode_tpl['themeleft']);
	$bbcode_tpl['themeright'] = str_replace('{URL}', $current_template_path . '/\\1', $bbcode_tpl['themeright']);
	$bbcode_tpl['relleft'] = str_replace('{URL}', '\\1', $bbcode_tpl['relleft']);
	$bbcode_tpl['relright'] = str_replace('{URL}', '\\1', $bbcode_tpl['relright']);
// LEFT-RIGHT-end

	// We do URLs in several different ways..
	$bbcode_tpl['url1'] = str_replace('{URL}', '\\1', $bbcode_tpl['url']);
	$bbcode_tpl['url1'] = str_replace('{DESCRIPTION}', '\\1', $bbcode_tpl['url1']);

	$bbcode_tpl['url2'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
	$bbcode_tpl['url2'] = str_replace('{DESCRIPTION}', '\\1', $bbcode_tpl['url2']);

	$bbcode_tpl['url3'] = str_replace('{URL}', '\\1', $bbcode_tpl['url']);
	$bbcode_tpl['url3'] = str_replace('{DESCRIPTION}', '\\2', $bbcode_tpl['url3']);

	$bbcode_tpl['url4'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
	$bbcode_tpl['url4'] = str_replace('{DESCRIPTION}', '\\3', $bbcode_tpl['url4']);

// Mighty Gorgon - Full Album Pack - BEGIN
	// Get Album PIC based on ID
	$bbcode_tpl['fullalbumimg'] = str_replace('{IMG_NUM}', '\\1', $bbcode_tpl['fullalbumimg']);
	$bbcode_tpl['fullalbumimgl'] = str_replace('{IMG_NUM}', '\\1', $bbcode_tpl['fullalbumimgl']);
	$bbcode_tpl['fullalbumimgr'] = str_replace('{IMG_NUM}', '\\1', $bbcode_tpl['fullalbumimgr']);
	$bbcode_tpl['fullalbumimgc'] = str_replace('{IMG_NUM}', '\\1', $bbcode_tpl['fullalbumimgc']);
	$bbcode_tpl['albumimg'] = str_replace('{IMG_NUM}', '\\1', $bbcode_tpl['albumimg']);
	$bbcode_tpl['albumimgl'] = str_replace('{IMG_NUM}', '\\1', $bbcode_tpl['albumimgl']);
	$bbcode_tpl['albumimgr'] = str_replace('{IMG_NUM}', '\\1', $bbcode_tpl['albumimgr']);
	$bbcode_tpl['albumimgc'] = str_replace('{IMG_NUM}', '\\1', $bbcode_tpl['albumimgc']);
// Mighty Gorgon - Full Album Pack - END

	$bbcode_tpl['email'] = str_replace('{EMAIL}', '\\1', $bbcode_tpl['email']);
    $bbcode_tpl['GVideo'] = str_replace('{GVIDEOLINK}', $lang['GVideo_link'], $bbcode_tpl['GVideo']);
    $bbcode_tpl['youtube'] = str_replace('{YOUTUBEID}', '\\3', $bbcode_tpl['youtube']);
    $bbcode_tpl['youtube'] = str_replace('{YOUTUBELINK}', $lang['youtube_link'], $bbcode_tpl['youtube']); 

	$bbcode_tpl['acronym_open'] = str_replace('{DESCRIPTION}', '\\1', $bbcode_tpl['acronym_open']);

	$bbcode_tpl['google'] = '\'' . $bbcode_tpl['google'] . '\'';
	$bbcode_tpl['google'] = str_replace('{STRING}', "' . str_replace('\\\"', '\"', '\\1') . '", $bbcode_tpl['google']);
	$bbcode_tpl['google'] = str_replace('{QUERY}', "' . urlencode(str_replace('\\\"', '\"', '\\1')) . '", $bbcode_tpl['google']);

	global $userdata;
	$bbcode_tpl['you'] = str_replace('{YOU}', '"' . $userdata['username'] . '"', $bbcode_tpl['you']);

	// Anchor
	$bbcode_tpl['anchor'] = str_replace('{URL}', '%s_\\1', $bbcode_tpl['anchor']);

	// Gotopost
	global $phpEx;
	$bbcode_tpl['gotopost_open_1'] = str_replace('{URL}', append_sid("viewtopic.$phpEx?p=" . '\\1') . '#\\1', $bbcode_tpl['gotopost_open']);
	$bbcode_tpl['gotopost_open_2'] = str_replace('{URL}', append_sid("viewtopic.$phpEx?p=" . '\\1') . '#\\1_\\2', $bbcode_tpl['gotopost_open']);
	$bbcode_tpl['gotopost_open_3'] = str_replace('{URL}', '#%s_\\1', $bbcode_tpl['gotopost_open']);

	$bbcode_tpl['table_mainrow_color'] = str_replace('{TABMRCOLOR}', '\\1', $bbcode_tpl['table_mainrow_color']);
	$bbcode_tpl['table_mainrow_size'] = str_replace('{TABMRSIZE}', '\\1', $bbcode_tpl['table_mainrow_size']);
	$bbcode_tpl['table_mainrow_cs1'] = str_replace('{TABMRCSCOLOR}', '\\1', $bbcode_tpl['table_mainrow_cs']);
	$bbcode_tpl['table_mainrow_cs1'] = str_replace('{TABMRCSSIZE}', '\\2', $bbcode_tpl['table_mainrow_cs1']);
	$bbcode_tpl['table_maincol_color'] = str_replace('{TABMCCOLOR}', '\\1', $bbcode_tpl['table_maincol_color']);
	$bbcode_tpl['table_maincol_size'] = str_replace('{TABMCSIZE}', '\\1', $bbcode_tpl['table_maincol_size']);
	$bbcode_tpl['table_maincol_cs1'] = str_replace('{TABMCCSCOLOR}', '\\1', $bbcode_tpl['table_maincol_cs']);
	$bbcode_tpl['table_maincol_cs1'] = str_replace('{TABMCCSSIZE}', '\\2', $bbcode_tpl['table_maincol_cs1']);
	$bbcode_tpl['table_row_color'] = str_replace('{TABRCOLOR}', '\\1', $bbcode_tpl['table_row_color']);
	$bbcode_tpl['table_row_size'] = str_replace('{TABRSIZE}', '\\1', $bbcode_tpl['table_row_size']);
	$bbcode_tpl['table_row_cs1'] = str_replace('{TABRCSCOLOR}', '\\1', $bbcode_tpl['table_row_cs']);
	$bbcode_tpl['table_row_cs1'] = str_replace('{TABRCSSIZE}', '\\2', $bbcode_tpl['table_row_cs1']);
	$bbcode_tpl['table_col_color'] = str_replace('{TABCCOLOR}', '\\1', $bbcode_tpl['table_col_color']);
	$bbcode_tpl['table_col_size'] = str_replace('{TABCSIZE}', '\\1', $bbcode_tpl['table_col_size']);
	$bbcode_tpl['table_col_cs1'] = str_replace('{TABCCSCOLOR}', '\\1', $bbcode_tpl['table_col_cs']);
	$bbcode_tpl['table_col_cs1'] = str_replace('{TABCCSSIZE}', '\\2', $bbcode_tpl['table_col_cs1']);
	$bbcode_tpl['table_size'] = str_replace('{TABSIZE}', '\\1', $bbcode_tpl['table_size']);
	$bbcode_tpl['table_color'] = str_replace('{TABCOLOR}', '\\1', $bbcode_tpl['table_color']);
	$bbcode_tpl['table_cs1'] = str_replace('{TABCSCOLOR}', '\\1', $bbcode_tpl['table_cs']);
	$bbcode_tpl['table_cs1'] = str_replace('{TABCSSIZE}', '\\2', $bbcode_tpl['table_cs1']);

//====================================================================== |
//==== Start Advanced BBCode Box MOD =================================== |
//==== v5.0.0 ========================================================== |
//====
	$bbcode_tpl['spoil_open'] = str_replace('{L_BBCODEBOX_HIDDEN}', $lang['BBCode_box_hidden'], $bbcode_tpl['spoil_open']);
	$bbcode_tpl['spoil_open'] = str_replace('{L_BBCODEBOX_VIEW}', $lang['BBcode_box_view'], $bbcode_tpl['spoil_open']);
	$bbcode_tpl['spoil_open'] = str_replace('{L_BBCODEBOX_HIDE}', $lang['BBcode_box_hide'], $bbcode_tpl['spoil_open']);
	$bbcode_tpl['align_open'] = str_replace('{ALIGN}', '\\1', $bbcode_tpl['align_open']);
	$bbcode_tpl['stream'] = str_replace('{URL}', '\\1', $bbcode_tpl['stream']);
	$bbcode_tpl['ram'] = str_replace('{URL}', '\\1', $bbcode_tpl['ram']);
	$bbcode_tpl['marq_open'] = str_replace('{MARQ}', '\\1', $bbcode_tpl['marq_open']);
    $bbcode_tpl['table_open'] = str_replace('{TABLE}', '\\1', $bbcode_tpl['table_open']);
    $bbcode_tpl['cell_open'] = str_replace('{CELL}', '\\1', $bbcode_tpl['cell_open']);
	$bbcode_tpl['web'] = str_replace('{URL}', '\\1', $bbcode_tpl['web']);
	$bbcode_tpl['flexiweb'] = str_replace('{URL}', '\\2', $bbcode_tpl['flexiweb']);
	$bbcode_tpl['flexiweb'] = str_replace('{HEIGHT}', '\\1', $bbcode_tpl['flexiweb']);
	$bbcode_tpl['flash'] = str_replace('{WIDTH}', '\\1', $bbcode_tpl['flash']);
	$bbcode_tpl['flash'] = str_replace('{HEIGHT}', '\\2', $bbcode_tpl['flash']);
	$bbcode_tpl['flash'] = str_replace('{URL}', '\\3', $bbcode_tpl['flash']);
	$bbcode_tpl['video'] = str_replace('{URL}', '\\3', $bbcode_tpl['video']);
	$bbcode_tpl['video'] = str_replace('{WIDTH}', '\\1', $bbcode_tpl['video']);
	$bbcode_tpl['video'] = str_replace('{HEIGHT}', '\\2', $bbcode_tpl['video']);
	$bbcode_tpl['font_open'] = str_replace('{FONT}', '\\1', $bbcode_tpl['font_open']);
	$bbcode_tpl['poet_open'] = str_replace('{POET}', '\\1', $bbcode_tpl['poet_open']);
//====
//==== Author: Disturbed One [http://hvmdesign.com] =================== |
//==== End Advanced BBCode Box MOD ==================================== |
//===================================================================== |

	define("BBCODE_TPL_READY", true);

	return $bbcode_tpl;
}

/** Disables the img tag for privileged pages. It also implements a compability hack for old templates.
*/
function get_image_tag_replacement($bbcode_tpl)
{
	global $lang, $HTTP_POST_VARS, $HTTP_GET_VARS;
	$bb_tmpl = '';
	if (isset($HTTP_POST_VARS['p_sid']))
	{
		if (isset($bbcode_tpl['p_img']))
		{
			$bb_tmpl = str_replace('{L_PRIV_IMG}', $lang['Priv_Img'], $bbcode_tpl['p_img']);
		}
		else
		{
			$bb_tmpl = $lang['Priv_Img'] . ': {URL}';
		}
	}
	else
	{
		$bb_tmpl = $bbcode_tpl['img'];
	}
	return $bb_tmpl;
}

/**
 * Does second-pass bbencoding. This should be used before displaying the message in
 * a thread. Assumes the message is already first-pass encoded, and we are given the
 * correct UID as used in first-pass encoding.
 */
function bbencode_second_pass($text, $uid)
{
	global $lang, $bbcode_tpl;

	$text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1&#058;", $text);

	// pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
	// This is important; bbencode_quote(), bbencode_list(), and bbencode_code() all depend on it.
	$text = " " . $text;

	// First: If there isn't a "[" and a "]" in the message, don't bother.
	if (! (strpos($text, "[") && strpos($text, "]")) )
	{
		// Remove padding, return.
		$text = substr($text, 1);
		return $text;
	}

	// Only load the templates ONCE..
	if (!defined("BBCODE_TPL_READY"))
	{
		// load templates from file into array.
		$bbcode_tpl = load_bbcode_template();

		// prepare array for use in regexps.
		$bbcode_tpl = prepare_bbcode_template($bbcode_tpl);
	}

	// [CODE] and [/CODE] for posting code (HTML, PHP, C etc etc) in your posts.
	$text = bbencode_second_pass_code($text, $uid, $bbcode_tpl);

	// PHP MOD
	// [PHP] and [/PHP] for posting PHP code in your posts.
	$text = bbencode_second_pass_php($text, $uid, $bbcode_tpl);

	// [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff.
	$text = str_replace("[quote:$uid]", $bbcode_tpl['quote_open'], $text);
	$text = str_replace("[/quote:$uid]", $bbcode_tpl['quote_close'], $text);

	// opening a quote with an pre-defined post entry
	$text = preg_replace("/\[quote:$uid=p=\"([0-9]+)\"\]/si", $bbcode_tpl['quote_post_open'], $text);

	// opening a username quote with an pre-defined post entry
	$text = preg_replace("/\[quote:$uid=(?:\"?([^\"]*)\"?);p=(?:\"?([0-9]+)\"?)\]/si", $bbcode_tpl['quote_username_post_open'], $text);

	// New one liner to deal with opening quotes with usernames...
	// replaces the two line version that I had here before..
	$text = preg_replace("/\[quote:$uid=\"(.*?)\"\]/si", $bbcode_tpl['quote_username_open'], $text);

	// acronym
	$text = preg_replace("/\[acronym:$uid=\"(.*?)\"\]/si", $bbcode_tpl['acronym_open'], $text);
	$text = str_replace("[/acronym:$uid]", $bbcode_tpl['acronym_close'], $text);

	// [list] and [list=x] for (un)ordered lists.
	// unordered lists
	$text = str_replace("[list:$uid]", $bbcode_tpl['ulist_open'], $text);
	// li tags
	$text = str_replace("[*:$uid]", $bbcode_tpl['listitem'], $text);
	// ending tags
	$text = str_replace("[/list:u:$uid]", $bbcode_tpl['ulist_close'], $text);
	$text = str_replace("[/list:o:$uid]", $bbcode_tpl['olist_close'], $text);
	// Ordered lists
	$text = preg_replace("/\[list=([a1]):$uid\]/si", $bbcode_tpl['olist_open'], $text);

	// colors
	$text = preg_replace("/\[color=(\#[0-9A-F]{6}|[a-z]+):$uid\]/si", $bbcode_tpl['color_open'], $text);
	$text = str_replace("[/color:$uid]", $bbcode_tpl['color_close'], $text);

	// size
	$text = preg_replace("/\[size=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['size_open'], $text);
	$text = str_replace("[/size:$uid]", $bbcode_tpl['size_close'], $text);

	// [b] and [/b] for bolding text.
	$text = str_replace("[b:$uid]", $bbcode_tpl['b_open'], $text);
	$text = str_replace("[/b:$uid]", $bbcode_tpl['b_close'], $text);

	// [sup] and [/sup] pour les textes en exposant.
	$text = str_replace("[sup:$uid]", $bbcode_tpl['sup_open'], $text);
	$text = str_replace("[/sup:$uid]", $bbcode_tpl['sup_close'], $text);

	// [sub] and [/sub] pour les textes en indice.
	$text = str_replace("[sub:$uid]", $bbcode_tpl['sub_open'], $text);
	$text = str_replace("[/sub:$uid]", $bbcode_tpl['sub_close'], $text);

	// [strike] and [/strike] for barring text.
    $text = str_replace("[strike:$uid]", $bbcode_tpl['strike_open'], $text);
    $text = str_replace("[/strike:$uid]", $bbcode_tpl['strike_close'], $text);

	// [u] and [/u] for underlining text.
	$text = str_replace("[u:$uid]", $bbcode_tpl['u_open'], $text);
	$text = str_replace("[/u:$uid]", $bbcode_tpl['u_close'], $text);

	// [i] and [/i] for italicizing text.
	$text = str_replace("[i:$uid]", $bbcode_tpl['i_open'], $text);
	$text = str_replace("[/i:$uid]", $bbcode_tpl['i_close'], $text);

	// Patterns and replacements for URL and email tags..
	$patterns = array();
	$replacements = array();

	// [img]image_url_here[/img] code..
	// This one gets first-passed..
//-- mod : profile cp ------------------------------------------------------------------------------
//-- add
	global $userdata;

	if (!$userdata['user_viewimg'])
	{
		$text = str_replace("[img:$uid]", "", $text);
		$text = str_replace("[/img:$uid]", "", $text);
		$text = str_replace("[img=left:$uid]", "", $text);
		$text = str_replace("[img=right:$uid]", "", $text);
		$text = str_replace("[img=center:$uid]", "", $text);
		$text = str_replace("[imgrel:$uid]", "", $text);
		$text = str_replace("[/imgrel:$uid]", "", $text);
		$text = str_replace("[imgrel=left:$uid]", "", $text);
		$text = str_replace("[imgrel=right:$uid]", "", $text);
		$text = str_replace("[theme:$uid]", "", $text);
		$text = str_replace("[theme=left:$uid]", "", $text);
		$text = str_replace("[theme=right:$uid]", "", $text);
		$text = str_replace("[/theme:$uid]", "", $text);
	}
//-- fin mod : profile cp --------------------------------------------------------------------------

	$patterns[] = "#\[img:$uid\]([^?](?:[^\[]+|\[(?!url))*?)\[/img:$uid\]#i";
	$replacements[] = $bbcode_tpl['img'];

	//BBCode Search Mod
	$patterns[] = "#\[search:$uid\](.*?)\[/search:$uid\]#si";
	$replacements[] = $bbcode_tpl['search'];

	$patterns[] = "#\[theme:$uid\](.*?)\[/theme:$uid\]#si";
	$replacements[] = $bbcode_tpl['theme'];

	$patterns[] = "#\[imgrel:$uid\](.*?)\[/imgrel:$uid\]#si";
	$replacements[] = $bbcode_tpl['img'];

// LEFT-RIGHT-start
	// [img=left]image_url_here[/img] code..
	$patterns[] = "#\[img=left:$uid\](.*?)\[/img:$uid\]#si";
	$replacements[] = $bbcode_tpl['left'];

	// [img=right]image_url_here[/img] code..
	$patterns[] = "#\[img=right:$uid\](.*?)\[/img:$uid\]#si";
	$replacements[] = $bbcode_tpl['right'];

	// [img=center]image_url_here[/img] code..
	$patterns[] = "#\[img=center:$uid\](.*?)\[/img:$uid\]#si";
	$replacements[] = $bbcode_tpl['center'];

	// [imgrel=left]image_url_here[/imgrel] code..
	$patterns[] = "#\[imgrel=left:$uid\](.*?)\[/imgrel:$uid\]#si";
	$replacements[] = $bbcode_tpl['relleft'];

	// [img=right]image_url_here[/img] code..
	$patterns[] = "#\[imgrel=right:$uid\](.*?)\[/imgrel:$uid\]#si";
	$replacements[] = $bbcode_tpl['relright'];

	// [img=left]image_url_here[/img] code..
	$patterns[] = "#\[theme=left:$uid\](.*?)\[/theme:$uid\]#si";
	$replacements[] = $bbcode_tpl['themeleft'];

	// [img=right]image_url_here[/img] code..
	$patterns[] = "#\[theme=right:$uid\](.*?)\[/theme:$uid\]#si";
	$replacements[] = $bbcode_tpl['themeright'];
// LEFT-RIGHT-end

	// matches a [url]xxxx://www.phpbb.com[/url] code..
	$patterns[] = "#\[url\]([\w]+?://([\w\#$%&~/.\-;:=,?@\]+]+|\[(?!url=))*?)\[/url\]#is";
	$replacements[] = $bbcode_tpl['url1'];

	// [url]www.phpbb.com[/url] code.. (no xxxx:// prefix).
	$patterns[] = "#\[url\]((www|ftp)\.([\w\#$%&~/.\-;:=,?@\]+]+|\[(?!url=))*?)\[/url\]#is";
	$replacements[] = $bbcode_tpl['url2'];

	// [url=xxxx://www.phpbb.com]phpBB[/url] code..
	$patterns[] = "#\[url=([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*?)\]([^?\n\r\t].*?)\[/url\]#is";
	$replacements[] = $bbcode_tpl['url3'];

	// [url=www.phpbb.com]phpBB[/url] code.. (no xxxx:// prefix).
	$patterns[] = "#\[url=((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*?)\]([^?\n\r\t].*?)\[/url\]#is";
	$replacements[] = $bbcode_tpl['url4'];

	// Mighty Gorgon - Full Album Pack - BEGIN
	// [albumimg]image number here[/albumimg]
	$album_img_patterns[1] = "#\[albumimg:$uid\]([0-9]+)\[/albumimg:$uid\]#si";
	$album_img_replacements[1] = $bbcode_tpl['albumimg'];

	// [albumimgl]image number here[/albumimgl]
	$album_img_patterns[2] = "#\[albumimgl:$uid\]([0-9]+)\[/albumimgl:$uid\]#si";
	$album_img_replacements[2] = $bbcode_tpl['albumimgl'];

	// [albumimgr]image number here[/albumimgr]
	$album_img_patterns[3] = "#\[albumimgr:$uid\]([0-9]+)\[/albumimgr:$uid\]#si";
	$album_img_replacements[3] = $bbcode_tpl['albumimgr'];

	// [albumimgc]image number here[/albumimgc]
	$album_img_patterns[4] = "#\[albumimgc:$uid\]([0-9]+)\[/albumimgc:$uid\]#si";
	$album_img_replacements[4] = $bbcode_tpl['albumimgc'];
	// site image-end

	// [fullalbumimg]image number here[/fullalbumimg]
	$album_img_patterns[5] = "#\[fullalbumimg:$uid\]([0-9]+)\[/fullalbumimg:$uid\]#si";
	$album_img_replacements[5] = $bbcode_tpl['fullalbumimg'];

	// [fullalbumimgl]image number here[/fullalbumimgl]
	$album_img_patterns[2] = "#\[fullalbumimgl:$uid\]([0-9]+)\[/fullalbumimgl:$uid\]#si";
	$album_img_replacements[2] = $bbcode_tpl['fullalbumimgl'];

	// [fullalbumimgr]image number here[/fullalbumimgr]
	$album_img_patterns[3] = "#\[fullalbumimgr:$uid\]([0-9]+)\[/fullalbumimgr:$uid\]#si";
	$album_img_replacements[3] = $bbcode_tpl['fullalbumimgr'];

	// [fullalbumimgc]image number here[/fullalbumimgc]
	$album_img_patterns[4] = "#\[fullalbumimgc:$uid\]([0-9]+)\[/fullalbumimgc:$uid\]#si";
	$album_img_replacements[4] = $bbcode_tpl['fullalbumimgc'];

	$text = preg_replace($album_img_patterns, $album_img_replacements, $text);
	// Mighty Gorgon - Full Album Pack - END

	// [email]user@domain.tld[/email] code..
	$patterns[] = "#\[email\]([a-z0-9&\-_.]+?@[\w\-]+\.([\w\-\.]+\.)?[\w]+)\[/email\]#si";
	$replacements[] = $bbcode_tpl['email'];

	// [GVideo]GVideo URL[/GVideo] code..
    $patterns[] = "#\[GVideo\]http://video.google.[A-Za-z0-9.]{2,5}/videoplay\?docid=([0-9A-Za-z-_]*)[^[]*\[/GVideo\]#is";
    $replacements[] = $bbcode_tpl['GVideo'];

    // [youtube]YouTube URL[/youtube] code..
    $patterns[] = "#\[youtube\](?:http|https)?://(?:www\.)?(youtube.com|youtu.be|gaming.youtube.com|m.youtube.com)/(watch\?v=|v/|)([0-9A-Za-z-_]{11})[^[]*\[/youtube\]#is";
    $replacements[] = $bbcode_tpl['youtube']; 

	// [google]string for search[/google] code..
	$patterns[] = "#\[google\](.*?)\[/google\]#ise";
	$replacements[] = $bbcode_tpl['google'];

	// [you] - inserts the name of the person viewing the post
	$patterns[] = "#\[you\]#ise";
	$replacements[] = $bbcode_tpl['you'];

	// [nbsp]
	$text = str_replace("[nbsp:$uid]", $bbcode_tpl['nbsp'], $text);

	// [tab]
	$text = str_replace("[tab:$uid]", $bbcode_tpl['tab'], $text);

	// anchor
	$post_id = ( isset($GLOBALS['postrow'][$GLOBALS['i']]['post_id']) ) ? $GLOBALS['postrow'][$GLOBALS['i']]['post_id'] : ( ( isset($GLOBALS['post_id']) ) ? $GLOBALS['post_id'] : 0 );
	$text = preg_replace("/\[anchor:$uid\]([a-zA-Z]\w*?)\[\/anchor:$uid\]/si", sprintf($bbcode_tpl['anchor'],$post_id), $text);

	// gotopost
	$text = preg_replace("/\[gotopost=([\d]+?):$uid\]/si", $bbcode_tpl['gotopost_open_1'], $text);
	$text = preg_replace("/\[gotopost=([\d]+?),([a-zA-Z]\w*?):$uid\]/si", $bbcode_tpl['gotopost_open_2'], $text);
	$text = preg_replace("/\[gotopost=([a-zA-Z]\w*?):$uid\]/si", sprintf($bbcode_tpl['gotopost_open_3'],$post_id), $text);
	$text = str_replace("[/gotopost:$uid]", $bbcode_tpl['gotopost_close'], $text);

	// [table] and [/table] for making tables.
	// beginning code [table], along with attributes
	$text = str_replace("[table:$uid]", $bbcode_tpl['table_open'], $text);
	$text = preg_replace("/\[table color=(\#[0-9A-F]{6}|[a-z]+):$uid\]/si", $bbcode_tpl['table_color'], $text);
	$text = preg_replace("/\[table fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_size'], $text);
	$text = preg_replace("/\[table color=(\#[0-9A-F]{6}|[a-z]+) fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_cs1'], $text);
	// mainrow tag [mrow], along with attributes
	$text = str_replace("[mrow:$uid]", $bbcode_tpl['table_mainrow'], $text);
	$text = preg_replace("/\[mrow color=(\#[0-9A-F]{6}|[a-z]+):$uid\]/si", $bbcode_tpl['table_mainrow_color'], $text);
	$text = preg_replace("/\[mrow fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_mainrow_size'], $text);
	$text = preg_replace("/\[mrow color=(\#[0-9A-F]{6}|[a-z]+) fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_mainrow_cs1'], $text);
	// maincol tag [mcol], along with attributes
	$text = str_replace("[mcol:$uid]", $bbcode_tpl['table_maincol'], $text);
	$text = preg_replace("/\[mcol color=(\#[0-9A-F]{6}|[a-z]+):$uid\]/si", $bbcode_tpl['table_maincol_color'], $text);
	$text = preg_replace("/\[mcol fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_maincol_size'], $text);
	$text = preg_replace("/\[mcol color=(\#[0-9A-F]{6}|[a-z]+) fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_maincol_cs1'], $text);
	// row tag [row], along with attributes
	$text = str_replace("[row:$uid]", $bbcode_tpl['table_row'], $text);
	$text = preg_replace("/\[row color=(\#[0-9A-F]{6}|[a-z]+):$uid\]/si", $bbcode_tpl['table_row_color'], $text);
	$text = preg_replace("/\[row fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_row_size'], $text);
	$text = preg_replace("/\[row color=(\#[0-9A-F]{6}|[a-z]+) fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_row_cs1'], $text);
	// column tag [col], along with attributes
	$text = str_replace("[col:$uid]", $bbcode_tpl['table_col'], $text);
	$text = preg_replace("/\[col color=(\#[0-9A-F]{6}|[a-z]+):$uid\]/si", $bbcode_tpl['table_col_color'], $text);
	$text = preg_replace("/\[col fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_col_size'], $text);
	$text = preg_replace("/\[col color=(\#[0-9A-F]{6}|[a-z]+) fontsize=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['table_col_cs1'], $text);
	// ending tag [/table]
	$text = str_replace("[/table:$uid]", $bbcode_tpl['table_close'], $text);

//====================================================================== |
//==== Start Advanced BBCode Box MOD =================================== |
//==== v5.0.0 ========================================================== |
//====
	// [fade]Faded Text[/fade] code..
	$text = str_replace("[fade:$uid]", $bbcode_tpl['fade_open'], $text);
	$text = str_replace("[/fade:$uid]", $bbcode_tpl['fade_close'], $text);

	// [ram]Ram URL[/ram] code..
	$patterns[] = "#\[ram:$uid\](.*?)\[/ram:$uid\]#si";
	$replacements[] = $bbcode_tpl['ram'];

	// [stream]Sound URL[/stream] code..
	$patterns[] = "#\[stream:$uid\](.*?)\[/stream:$uid\]#si";
	$replacements[] = $bbcode_tpl['stream'];

	// [web]Web Iframe URL[/web] code..
	$patterns[] = "#\[web:$uid\](.*?)\[/web:$uid\]#si";
	$replacements[] = $bbcode_tpl['web'];

	// [web]flexiWeb height=X Iframe URL[/web] code..
	$patterns[] = "#\[web height=([0-9]?[0-9]?[0-9]):$uid\](.*?)\[/web:$uid\]#si";
	$replacements[] = $bbcode_tpl['flexiweb'];

	// [flash width=X height=X]Flash URL[/flash] code..
	$patterns[] = "#\[flash width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9]):$uid\](.*?)\[/flash:$uid\]#si";
	$replacements[] = $bbcode_tpl['flash'];

	// [video width=X height=X]Video URL[/video] code..
	$patterns[] = "#\[video width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9]):$uid\](.*?)\[/video:$uid\]#si";
	$replacements[] = $bbcode_tpl['video'];
	$text = preg_replace($patterns, $replacements, $text);

	// [align=left/center/right/justify]Formatted Code[/align] code..
	$text = preg_replace("/\[align=(left|right|center|justify):$uid\]/si", $bbcode_tpl['align_open'], $text);
	$text = str_replace("[/align:$uid]", $bbcode_tpl['align_close'], $text);

	 // [marquee=left/right/up/down]Marquee Code[/marquee] code..
	$text = preg_replace("/\[marq=(left|right|up|down):$uid\]/si", $bbcode_tpl['marq_open'], $text);
	$text = str_replace("[/marq:$uid]", $bbcode_tpl['marq_close'], $text);

	// [table=blah]Table[/table] code..
	$text = preg_replace("/\[table=(.*?):$uid\]/si", $bbcode_tpl['table_open'], $text);
	$text = str_replace("[/table:$uid]", $bbcode_tpl['table_close'], $text);

	// [cell=blah]Cell[/table] code..
	$text = preg_replace("/\[cell=(.*?):$uid\]/si", $bbcode_tpl['cell_open'], $text);
	$text = str_replace("[/cell:$uid]", $bbcode_tpl['cell_close'], $text);

	// [font=fonttype]text[/font] code..
	$text = preg_replace("/\[font=(.*?):$uid\]/si", $bbcode_tpl['font_open'], $text);
	$text = str_replace("[/font:$uid]", $bbcode_tpl['font_close'], $text);

	// [hr]
	$text = str_replace("[hr:$uid]", $bbcode_tpl['hr'], $text);

	// [sub]Subscrip[/sub] code..
	$text = str_replace("[sub:$uid]", '<sub>', $text);
	$text = str_replace("[/sub:$uid]", '</sub>', $text);

	// [sup]Superscript[/sup] code..
	$text = str_replace("[sup:$uid]", '<sup>', $text);
	$text = str_replace("[/sup:$uid]", '</sup>', $text);

	// [strike]Strikethrough[/strike] code..
	$text = str_replace("[s:$uid]", '<strike>', $text);
	$text = str_replace("[/s:$uid]", '</strike>', $text);

	// [spoil]Spoiler[/spoil] code..
	$text = str_replace("[spoil:$uid]", $bbcode_tpl['spoil_open'], $text);
	$text = str_replace("[/spoil:$uid]", $bbcode_tpl['spoil_close'], $text);
//====
//==== Author: Disturbed One [http://hvmdesign.com] =================== |
//==== End Advanced BBCode Box MOD ==================================== |
//===================================================================== |

	$text = preg_replace($patterns, $replacements, $text);

	// Remove our padding from the string..
	$text = substr($text, 1);

	return $text;

} // bbencode_second_pass()

function make_bbcode_uid()
{
	// Unique ID for this message..

	$uid = dss_rand();
	$uid = substr($uid, 0, BBCODE_UID_LEN);

	return $uid;
}

function bbencode_first_pass($text, $uid)
{
	// pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
	// This is important; bbencode_quote(), bbencode_list(), and bbencode_code() all depend on it.
	$text = " " . $text;

	// [CODE] and [/CODE] for posting code (HTML, PHP, C etc etc) in your posts.
	$text = bbencode_first_pass_pda($text, $uid, '[code]', '[/code]', '', true, '');

	// [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff.
	$text = bbencode_first_pass_pda($text, $uid, '[quote]', '[/quote]', '', false, '');
	// [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff with an pre-defined post entry
	$text = bbencode_first_pass_pda($text, $uid, '/\[quote=p=\\\\&quot;([0-9]+)\\\\&quot;\]/is', '[/quote]', '', false, '', "[quote:$uid=p=\\\"\\1\\\"]");

	$text = bbencode_first_pass_pda($text, $uid, '/\[quote=\\\\&quot;(.*?)\\\\&quot;;p=\\\\&quot;([0-9]+)\\\\&quot;\]/is', '[/quote]', '', false, '', "[quote:$uid=\\\"\\1\\\";p=\\\"\\2\\\"]");
	$text = bbencode_first_pass_pda($text, $uid, '/\[quote=\\\\&quot;(.*?)\\\\&quot;\]/is', '[/quote]', '', false, '', "[quote:$uid=\\\"\\1\\\"]");

	// [acronym] and [/acronym]
	$text = bbencode_first_pass_pda($text, $uid, '/\[acronym=(\\\&quot;.*?\\\&quot;)\]/is', '[/acronym]', '', false, '', "[acronym:$uid=\\1]");

	// [list] and [list=x] for (un)ordered lists.
	$open_tag = array();
	$open_tag[0] = "[list]";

	// unordered..
	$text = bbencode_first_pass_pda($text, $uid, $open_tag, "[/list]", "[/list:u]", false, 'replace_listitems');

	$open_tag[0] = "[list=1]";
	$open_tag[1] = "[list=a]";

	// ordered.
	$text = bbencode_first_pass_pda($text, $uid, $open_tag, "[/list]", "[/list:o]",  false, 'replace_listitems');

	// [color] and [/color] for setting text color
	$text = preg_replace("#\[color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/color\]#si", "[color=\\1:$uid]\\2[/color:$uid]", $text);

	// [size] and [/size] for setting text size
	$text = preg_replace("#\[size=([1-2]?[0-9])\](.*?)\[/size\]#si", "[size=\\1:$uid]\\2[/size:$uid]", $text);

	// [b] and [/b] for bolding text.
	$text = preg_replace("#\[b\](.*?)\[/b\]#si", "[b:$uid]\\1[/b:$uid]", $text);

	// [sup] and [/sup] pour les textes en exposant.
	$text = preg_replace("#\[sup\](.*?)\[/sup\]#si", "[sup:$uid]\\1[/sup:$uid]", $text);

	// [sub] and [/sub] pour les textes en indice.
	$text = preg_replace("#\[sub\](.*?)\[/sub\]#si", "[sub:$uid]\\1[/sub:$uid]", $text);

	// [strike] and [/strike] for barring text.
    $text = preg_replace("#\[strike\](.*?)\[/strike\]#si", "[strike:$uid]\\1[/strike:$uid]", $text);

	// [u] and [/u] for underlining text.
	$text = preg_replace("#\[u\](.*?)\[/u\]#si", "[u:$uid]\\1[/u:$uid]", $text);

	// [i] and [/i] for italicizing text.
	$text = preg_replace("#\[i\](.*?)\[/i\]#si", "[i:$uid]\\1[/i:$uid]", $text);

	// [img]image_url_here[/img] code..
	$text = preg_replace("#\[img\]((http|ftp|https|ftps)://)([^\r\n\t<\"]*?)\[/img\]#sie", "'[img:$uid]\\1' . str_replace(' ', '%20', '\\3') . '[/img:$uid]'", $text);

	// [PHP] and [/PHP] for posting PHP code in your posts.
	$text = bbencode_first_pass_pda($text, $uid, '[php]', '[/php]', '', true, '');

	//BBCode Search Mod
	$text = preg_replace("#\[search\](.*?)\[/search\]#si", "[search:$uid]\\1[/search:$uid]", $text);

	$text = preg_replace("#\[theme\]([^ \?&=\#\"\n\r\t<]*?)\[/theme\]#sie", "'[theme:$uid]\\1' . str_replace(' ', '%20', '\\3') . '[/theme:$uid]'", $text);
	$text = preg_replace("#\[theme=left\]([^ \?&=\#\"\n\r\t<]*?)\[/theme\]#sie", "'[theme=left:$uid]\\1' . str_replace(' ', '%20', '\\3') . '[/theme:$uid]'", $text);
	$text = preg_replace("#\[theme=right\]([^ \?&=\#\"\n\r\t<]*?)\[/theme\]#sie", "'[theme=right:$uid]\\1' . str_replace(' ', '%20', '\\3') . '[/theme:$uid]'", $text);

	$text = preg_replace("#\[imgrel\]([^ \?&=\#\"\n\r\t<]*?)\[/imgrel\]#sie", "'[imgrel:$uid]\\1' . str_replace(' ', '%20', '\\3') . '[/imgrel:$uid]'", $text);
	$text = preg_replace("#\[imgrel=left\]([^\r\n\t<\"]*?)\[/imgrel\]#sie", "'[imgrel=left:$uid]\\1' . str_replace(' ', '%20', '\\3') . '[/imgrel:$uid]'", $text);
	$text = preg_replace("#\[imgrel=right\]([^\r\n\t<\"]*?)\[/imgrel\]#sie", "'[imgrel=right:$uid]\\1' . str_replace(' ', '%20', '\\3') . '[/imgrel:$uid]'", $text);

// LEFT-RIGHT-start
	$text = preg_replace("#\[img=left\]((http|ftp|https|ftps)://)([^\r\n\t<\"]*?)\[/img\]#sie", "'[img=left:$uid]\\1' . str_replace(' ', '%20', '\\3') . '[/img:$uid]'", $text);
	$text = preg_replace("#\[img=right\]((http|ftp|https|ftps)://)([^\r\n\t<\"]*?)\[/img\]#sie", "'[img=right:$uid]\\1' . str_replace(' ', '%20', '\\3') . '[/img:$uid]'", $text);
	$text = preg_replace("#\[img=center\]((http|ftp|https|ftps)://)([^\r\n\t<\"]*?)\[/img\]#sie", "'[img=center:$uid]\\1' . str_replace(' ', '%20', '\\3') . '[/img:$uid]'", $text);
// LEFT-RIGHT-end

	// [nbsp]
	$text = preg_replace("#\[nbsp\]#si", "[nbsp:$uid]", $text);

	// [tab]
	$text = preg_replace("#\[tab\]#si", "[tab:$uid]", $text);

	// [anchor]
	$text = preg_replace("#\[anchor\]([a-zA-Z]\w*?)\[/anchor\]#si", "[anchor:$uid]\\1[/anchor:$uid]", $text);

	// [gotopost]
	$text = preg_replace("#\[gotopost=([\d]+?)\](.*?)\[/gotopost\]#si", "[gotopost=\\1:$uid]\\2[/gotopost:$uid]", $text);
	$text = preg_replace("#\[gotopost=([\d]+?),([a-zA-Z]\w*?)\](.*?)\[/gotopost\]#si", "[gotopost=\\1,\\2:$uid]\\3[/gotopost:$uid]", $text);
	$text = preg_replace("#\[gotopost=([a-zA-Z]\w*?)\](.*?)\[/gotopost\]#si", "[gotopost=\\1:$uid]\\2[/gotopost:$uid]", $text);

	// [table] and [/table] for making tables.
	// beginning code [table], along with attributes
	$text = preg_replace("#\[table\](.*?)\[/table\]#si", "[table:$uid]\\1[/table:$uid]", $text);
	$text = preg_replace("#\[table color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/table\]#si", "[table color=\\1:$uid]\\2[/table:$uid]", $text);
	$text = preg_replace("#\[table fontsize=([1-2]?[0-9])\](.*?)\[/table\]#si", "[table fontsize=\\1:$uid]\\2[/table:$uid]", $text);
	$text = preg_replace("#\[table color=(\#[0-9A-F]{6}|[a-z\-]+) fontsize=([1-2]?[0-9])\](.*?)\[/table\]#si", "[table color=\\1 fontsize=\\2:$uid]\\3[/table:$uid]", $text);
	$text = preg_replace("#\[table fontsize=([1-2]?[0-9]) color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/table\]#si", "[table color=\\2 fontsize=\\1:$uid]\\3[/table:$uid]", $text);
	// mainrow tag [mrow], along with attributes
	$text = preg_replace("#\[mrow\](.*?)#si", "[mrow:$uid]\\1", $text);
	$text = preg_replace("#\[mrow color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)#si", "[mrow color=\\1:$uid]\\2", $text);
	$text = preg_replace("#\[mrow fontsize=([1-2]?[0-9])\](.*?)#si", "[mrow fontsize=\\1:$uid]\\2", $text);
	$text = preg_replace("#\[mrow color=(\#[0-9A-F]{6}|[a-z\-]+) fontsize=([1-2]?[0-9])\](.*?)#si", "[mrow color=\\1 fontsize=\\2:$uid]\\3", $text);
	$text = preg_replace("#\[mrow fontsize=([1-2]?[0-9]) color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)#si", "[mrow color=\\2 fontsize=\\1:$uid]\\3", $text);
	// maincol tag [mcol], along with attributes
	$text = preg_replace("#\[mcol\](.*?)#si", "[mcol:$uid]\\1", $text);
	$text = preg_replace("#\[mcol color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)#si", "[mcol color=\\1:$uid]\\2", $text);
	$text = preg_replace("#\[mcol fontsize=([1-2]?[0-9])\](.*?)#si", "[mcol fontsize=\\1:$uid]\\2", $text);
	$text = preg_replace("#\[mcol color=(\#[0-9A-F]{6}|[a-z\-]+) fontsize=([1-2]?[0-9])\](.*?)#si", "[mcol color=\\1 fontsize=\\2:$uid]\\3", $text);
	$text = preg_replace("#\[mcol fontsize=([1-2]?[0-9]) color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)#si", "[mcol color=\\2 fontsize=\\1:$uid]\\3", $text);
	// row tag [row], along with attributes
	$text = preg_replace("#\[row\](.*?)#si", "[row:$uid]\\1", $text);
	$text = preg_replace("#\[row color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)#si", "[row color=\\1:$uid]\\2", $text);
	$text = preg_replace("#\[row fontsize=([1-2]?[0-9])\](.*?)#si", "[row fontsize=\\1:$uid]\\2", $text);
	$text = preg_replace("#\[row color=(\#[0-9A-F]{6}|[a-z\-]+) fontsize=([1-2]?[0-9])\](.*?)#si", "[row color=\\1 fontsize=\\2:$uid]\\3", $text);
	$text = preg_replace("#\[row fontsize=([1-2]?[0-9]) color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)#si", "[row color=\\2 fontsize=\\1:$uid]\\3", $text);
	// column tag [col], along with attributes
	$text = preg_replace("#\[col\](.*?)#si", "[col:$uid]\\1", $text);
	$text = preg_replace("#\[col color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)#si", "[col color=\\1:$uid]\\2", $text);
	$text = preg_replace("#\[col fontsize=([1-2]?[0-9])\](.*?)#si", "[col fontsize=\\1:$uid]\\2", $text);
	$text = preg_replace("#\[col color=(\#[0-9A-F]{6}|[a-z\-]+) fontsize=([1-2]?[0-9])\](.*?)#si", "[col color=\\1 fontsize=\\2:$uid]\\3", $text);
	$text = preg_replace("#\[col fontsize=([1-2]?[0-9]) color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)#si", "[col color=\\2 fontsize=\\1:$uid]\\3", $text);

	// Mighty Gorgon - Full Album Pack - BEGIN
	// [albumimg]album image id here[/albumimg]
	$text = preg_replace("#\[fullalbumimg\]([0-9]+)\[/fullalbumimg\]#sie", "'[fullalbumimg:$uid]\\1[/fullalbumimg:$uid]'", $text);
	$text = preg_replace("#\[fullalbumimgl\]([0-9]+)\[/fullalbumimgl\]#sie", "'[fullalbumimgl:$uid]\\1[/fullalbumimgl:$uid]'", $text);
	$text = preg_replace("#\[fullalbumimgr\]([0-9]+)\[/fullalbumimgr\]#sie", "'[fullalbumimgr:$uid]\\1[/fullalbumimgr:$uid]'", $text);
	$text = preg_replace("#\[fullalbumimgc\]([0-9]+)\[/fullalbumimgc\]#sie", "'[fullalbumimgc:$uid]\\1[/fullalbumimgc:$uid]'", $text);
	$text = preg_replace("#\[albumimg\]([0-9]+)\[/albumimg\]#sie", "'[albumimg:$uid]\\1[/albumimg:$uid]'", $text);
	$text = preg_replace("#\[albumimgl\]([0-9]+)\[/albumimgl\]#sie", "'[albumimgl:$uid]\\1[/albumimgl:$uid]'", $text);
	$text = preg_replace("#\[albumimgr\]([0-9]+)\[/albumimgr\]#sie", "'[albumimgr:$uid]\\1[/albumimgr:$uid]'", $text);
	$text = preg_replace("#\[albumimgc\]([0-9]+)\[/albumimgc\]#sie", "'[albumimgc:$uid]\\1[/albumimgc:$uid]'", $text);
	// Mighty Gorgon - Full Album Pack - END

//====================================================================== |
//==== Start Advanced BBCode Box MOD =================================== |
//==== v5.0.0 ========================================================== |
//====
	// [fade]Faded Text[/fade] code..
	$text = preg_replace("#\[fade\](.*?)\[/fade\]#si", "[fade:$uid]\\1[/fade:$uid]", $text);

	// [align=left/center/right/justify]Formatted Code[/align] code..
	$text = preg_replace("#\[align=(left|right|center|justify)\](.*?)\[/align\]#si", "[align=\\1:$uid]\\2[/align:$uid]", $text);

	 // [marquee=left/right/up/down]Marquee Code[/marquee] code..
	$text = preg_replace("#\[marq=(left|right|up|down)\](.*?)\[/marq\]#si", "[marq=\\1:$uid]\\2[/marq:$uid]", $text);

	// [table=blah]Table[/table] code..
	$text = preg_replace("#\[table=(.*?)\](.*?)\[/table\]#si", "[table=\\1:$uid]\\2[/table:$uid]", $text);

	// [cell=blah]Cell[/table] code..
	$text = preg_replace("#\[cell=(.*?)\](.*?)\[/cell\]#si", "[cell=\\1:$uid]\\2[/cell:$uid]", $text);

	// [font=fonttype]text[/font] code..
	$text = preg_replace("#\[font=(.*?)\](.*?)\[/font\]#si", "[font=\\1:$uid]\\2[/font:$uid]", $text);

	// [ram]Ram URL[/ram] code..
	$text = preg_replace("#\[ram\](.*?)\[/ram\]#si", "[ram:$uid]\\1[/ram:$uid]", $text);

	// [stream]Sound URL[/stream] code..
	$text = preg_replace("#\[stream\](.*?)\[/stream\]#si", "[stream:$uid]\\1[/stream:$uid]", $text);

	// [web]Web Iframe URL[/web] code..
	$text = preg_replace("#\[web\](http(s)?://)([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+]+)\[/web\]#si", "[web:$uid]\\1\\3[/web:$uid]", $text);

	// [web]flexiWeb Iframe URL[/web] code..
	$text = preg_replace("#\[web height=([0-9]?[0-9]?[0-9])](http(s)?://)([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+]+)\[/web\]#si", "[web height=\\1:$uid]\\2\\4[/web:$uid]", $text);

	// [flash width=X height=X]Flash URL[/flash] code..
	$text = preg_replace("#\[flash width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9])\](([a-z]+?)://([^, \n\r]+))\[\/flash\]#si","[flash width=\\1 height=\\2:$uid\]\\3[/flash:$uid]", $text);

	// [video width=X height=X]Video URL[/video] code..
	$text = preg_replace("#\[video width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9])\](([a-z]+?)://([^, \n\r]+))\[\/video\]#si","[video width=\\1 height=\\2:$uid\]\\3[/video:$uid]", $text);

	// [hr]
	$text = preg_replace("#\[hr\]#si", "[hr:$uid]", $text);

	// [strike]Strikethrough[/strike] code..
	$text = preg_replace("#\[s\](.*?)\[/s\]#si", "[s:$uid]\\1[/s:$uid]", $text);

	// [spoil]Spoiler[/spoil] code..
	$text = preg_replace("#\[spoil\](.*?)\[/spoil\]#si", "[spoil:$uid]\\1[/spoil:$uid]", $text);

	// [sub]Subscrip[/sub] code..
	$text = preg_replace("#\[sub\](.*?)\[/sub\]#si", "[sub:$uid]\\1[/sub:$uid]", $text);

	// [sup]Superscript[/sup] code..
	$text = preg_replace("#\[sup\](.*?)\[/sup\]#si", "[sup:$uid]\\1[/sup:$uid]", $text);
//====
//==== Author: Disturbed One [http://hvmdesign.com] =================== |
//==== End Advanced BBCode Box MOD ==================================== |
//===================================================================== |

	// Remove our padding from the string..
	return substr($text, 1);;

} // bbencode_first_pass()

/**
 * $text - The text to operate on.
 * $uid - The UID to add to matching tags.
 * $open_tag - The opening tag to match. Can be an array of opening tags.
 * $close_tag - The closing tag to match.
 * $close_tag_new - The closing tag to replace with.
 * $mark_lowest_level - boolean - should we specially mark the tags that occur
 * 					at the lowest level of nesting? (useful for [code], because
 *						we need to match these tags first and transform HTML tags
 *						in their contents..
 * $func - This variable should contain a string that is the name of a function.
 *				That function will be called when a match is found, and passed 2
 *				parameters: ($text, $uid). The function should return a string.
 *				This is used when some transformation needs to be applied to the
 *				text INSIDE a pair of matching tags. If this variable is FALSE or the
 *				empty string, it will not be executed.
 * If open_tag is an array, then the pda will try to match pairs consisting of
 * any element of open_tag followed by close_tag. This allows us to match things
 * like [list=A]...[/list] and [list=1]...[/list] in one pass of the PDA.
 *
 * NOTES:	- this function assumes the first character of $text is a space.
 *				- every opening tag and closing tag must be of the [...] format.
 */
function bbencode_first_pass_pda($text, $uid, $open_tag, $close_tag, $close_tag_new, $mark_lowest_level, $func, $open_regexp_replace = false)
{
	$open_tag_count = 0;

	if (!$close_tag_new || ($close_tag_new == ''))
	{
		$close_tag_new = $close_tag;
	}

	$close_tag_length = strlen($close_tag);
	$close_tag_new_length = strlen($close_tag_new);
	$uid_length = strlen($uid);

	$use_function_pointer = ($func && ($func != ''));

	$stack = array();

	if (is_array($open_tag))
	{
		if (0 == count($open_tag))
		{
			// No opening tags to match, so return.
			return $text;
		}
		$open_tag_count = count($open_tag);
	}
	else
	{
		// only one opening tag. make it into a 1-element array.
		$open_tag_temp = $open_tag;
		$open_tag = array();
		$open_tag[0] = $open_tag_temp;
		$open_tag_count = 1;
	}

	$open_is_regexp = false;

	if ($open_regexp_replace)
	{
		$open_is_regexp = true;
		if (!is_array($open_regexp_replace))
		{
			$open_regexp_temp = $open_regexp_replace;
			$open_regexp_replace = array();
			$open_regexp_replace[0] = $open_regexp_temp;
		}
	}

	if ($mark_lowest_level && $open_is_regexp)
	{
		message_die(GENERAL_ERROR, "Unsupported operation for bbcode_first_pass_pda().");
	}

	// Start at the 2nd char of the string, looking for opening tags.
	$curr_pos = 1;
	while ($curr_pos && ($curr_pos < strlen($text)))
	{
		$curr_pos = strpos($text, "[", $curr_pos);

		// If not found, $curr_pos will be 0, and the loop will end.
		if ($curr_pos)
		{
			// We found a [. It starts at $curr_pos.
			// check if it's a starting or ending tag.
			$found_start = false;
			$which_start_tag = "";
			$start_tag_index = -1;

			for ($i = 0; $i < $open_tag_count; $i++)
			{
				// Grab everything until the first "]"...
				$possible_start = substr($text, $curr_pos, strpos($text, ']', $curr_pos + 1) - $curr_pos + 1);

				//
				// We're going to try and catch usernames with "[' characters.
				//
				if( preg_match('#\[quote=\\\&quot;#si', $possible_start, $match) && !preg_match('#\[quote=\\\&quot;(.*?)\\\&quot;\]#si', $possible_start) )
				{
					// OK we are in a quote tag that probably contains a ] bracket.
					// Grab a bit more of the string to hopefully get all of it..
					if ($close_pos = strpos($text, '&quot;]', $curr_pos + 14))
					{
						if (strpos(substr($text, $curr_pos + 14, $close_pos - ($curr_pos + 14)), '[quote') === false)
						{
							$possible_start = substr($text, $curr_pos, $close_pos - $curr_pos + 7);
						}
					}
				}

				// Now compare, either using regexp or not.
				if ($open_is_regexp)
				{
					$match_result = array();
					if (preg_match($open_tag[$i], $possible_start, $match_result))
					{
						$found_start = true;
						$which_start_tag = $match_result[0];
						$start_tag_index = $i;
						break;
					}
				}
				else
				{
					// straightforward string comparison.
					if (0 == strcasecmp($open_tag[$i], $possible_start))
					{
						$found_start = true;
						$which_start_tag = $open_tag[$i];
						$start_tag_index = $i;
						break;
					}
				}
			}

			if ($found_start)
			{
				// We have an opening tag.
				// Push its position, the text we matched, and its index in the open_tag array on to the stack, and then keep going to the right.
				$match = array("pos" => $curr_pos, "tag" => $which_start_tag, "index" => $start_tag_index);
				array_push($stack, $match);
				//
				// Rather than just increment $curr_pos
				// Set it to the ending of the tag we just found
				// Keeps error in nested tag from breaking out
				// of table structure..
				//
				$curr_pos += strlen($possible_start);
			}
			else
			{
				// check for a closing tag..
				$possible_end = substr($text, $curr_pos, $close_tag_length);
				if (0 == strcasecmp($close_tag, $possible_end))
				{
					// We have an ending tag.
					// Check if we've already found a matching starting tag.
					if (sizeof($stack) > 0)
					{
						// There exists a starting tag.
						$curr_nesting_depth = sizeof($stack);
						// We need to do 2 replacements now.
						$match = array_pop($stack);
						$start_index = $match['pos'];
						$start_tag = $match['tag'];
						$start_length = strlen($start_tag);
						$start_tag_index = $match['index'];

						if ($open_is_regexp)
						{
							$start_tag = preg_replace($open_tag[$start_tag_index], $open_regexp_replace[$start_tag_index], $start_tag);
						}

						// everything before the opening tag.
						$before_start_tag = substr($text, 0, $start_index);

						// everything after the opening tag, but before the closing tag.
						$between_tags = substr($text, $start_index + $start_length, $curr_pos - $start_index - $start_length);

						// Run the given function on the text between the tags..
						if ($use_function_pointer)
						{
							$between_tags = $func($between_tags, $uid);
						}

						// everything after the closing tag.
						$after_end_tag = substr($text, $curr_pos + $close_tag_length);

						// Mark the lowest nesting level if needed.
						if ($mark_lowest_level && ($curr_nesting_depth == 1))
						{
							if ($open_tag[0] == '[code]')
							{
								$code_entities_match = array('#<#', '#>#', '#"#', '#:#', '#\[#', '#\]#', '#\(#', '#\)#', '#\{#', '#\}#');
								$code_entities_replace = array('&lt;', '&gt;', '&quot;', '&#58;', '&#91;', '&#93;', '&#40;', '&#41;', '&#123;', '&#125;');
								$between_tags = preg_replace($code_entities_match, $code_entities_replace, $between_tags);
							}
// Start add - PHP Syntax Highlighter BBCode MOD
							if ($open_tag[0] == '[php]')
							{
								$between_tags = preg_replace('#&\##', '&amp;#', $between_tags);
								$between_tags = preg_replace('/\:[0-9a-z\:]+\]/si', ']', $between_tags);
// Start sanjis bbcode fix
                               $code_entities_match = array('#<#', '#>#', '#"#', '#:#', '#\[#', '#\]#', '#\(#', '#\)#', '#\{#', '#\}#');
                               $code_entities_replace = array('&lt;', '&gt;', '&quot;', '&#58;', '&#91;', '&#93;', '&#40;', '&#41;', '&#123;', '&#125;');
                               $between_tags = preg_replace($code_entities_match, $code_entities_replace, $between_tags);
// End sanjis bbcode fix
							}
// End add - PHP Syntax Highlighter BBCode MOD
							$text = $before_start_tag . substr($start_tag, 0, $start_length - 1) . ":$curr_nesting_depth:$uid]";
							$text .= $between_tags . substr($close_tag_new, 0, $close_tag_new_length - 1) . ":$curr_nesting_depth:$uid]";
						}
						else
						{
							if ($open_tag[0] == '[code]')
							{
								$text = $before_start_tag . '&#91;code&#93;';
								$text .= $between_tags . '&#91;/code&#93;';
							}
// Start add - PHP Syntax Highlighter BBCode MOD
							else if ($open_tag[0] == '[php]')
							{
								$text = $before_start_tag . '&#91;php&#93;';
								$text .= $between_tags . '&#91;/php&#93;';
							}
// End add - PHP Syntax Highlighter BBCode MOD
							else
							{
								if ($open_is_regexp)
								{
									$text = $before_start_tag . $start_tag;
								}
								else
								{
									$text = $before_start_tag . substr($start_tag, 0, $start_length - 1) . ":$uid]";
								}
								$text .= $between_tags . substr($close_tag_new, 0, $close_tag_new_length - 1) . ":$uid]";
							}
						}

						$text .= $after_end_tag;

						// Now.. we've screwed up the indices by changing the length of the string.
						// So, if there's anything in the stack, we want to resume searching just after it.
						// otherwise, we go back to the start.
						if (sizeof($stack) > 0)
						{
							$match = array_pop($stack);
							$curr_pos = $match['pos'];
//							bbcode_array_push($stack, $match);
//							++$curr_pos;
						}
						else
						{
							$curr_pos = 1;
						}
					}
					else
					{
						// No matching start tag found. Increment pos, keep going.
						++$curr_pos;
					}
				}
				else
				{
					// No starting tag or ending tag.. Increment pos, keep looping.,
					++$curr_pos;
				}
			}
		}
	} // while

	return $text;

} // bbencode_first_pass_pda()

/**
 * Does second-pass bbencoding of the [code] tags. This includes
 * running htmlspecialchars() over the text contained between
 * any pair of [code] tags that are at the first level of
 * nesting. Tags at the first level of nesting are indicated
 * by this format: [code:1:$uid] ... [/code:1:$uid]
 * Other tags are in this format: [code:$uid] ... [/code:$uid]
 */
function bbencode_second_pass_code($text, $uid, $bbcode_tpl)
{
	global $lang;

	$code_start_html = $bbcode_tpl['code_open'];
	$code_end_html =  $bbcode_tpl['code_close'];

	// First, do all the 1st-level matches. These need an htmlspecialchars() run,
	// so they have to be handled differently.
	$match_count = preg_match_all("#\[code:1:$uid\](.*?)\[/code:1:$uid\]#si", $text, $matches);

	for ($i = 0; $i < $match_count; $i++)
	{
		$before_replace = $matches[1][$i];
		$after_replace = $matches[1][$i];

		// Replace 2 spaces with "&nbsp; " so non-tabbed code indents without making huge long lines.
		$after_replace = str_replace("  ", "&nbsp; ", $after_replace);
		// now Replace 2 spaces with " &nbsp;" to catch odd #s of spaces.
		$after_replace = str_replace("  ", " &nbsp;", $after_replace);

		// Replace tabs with "&nbsp; &nbsp;" so tabbed code indents sorta right without making huge long lines.
		$after_replace = str_replace("\t", "&nbsp; &nbsp;", $after_replace);

		// now Replace space occurring at the beginning of a line
		$after_replace = preg_replace("/^ {1}/m", "&nbsp;", $after_replace);

		$str_to_match = "[code:1:$uid]" . $before_replace . "[/code:1:$uid]";

		$replacement = $code_start_html;
		$replacement .= $after_replace;
		$replacement .= $code_end_html;

		$text = str_replace($str_to_match, $replacement, $text);
	}

	// Now, do all the non-first-level matches. These are simple.
	$text = str_replace("[code:$uid]", $code_start_html, $text);
	$text = str_replace("[/code:$uid]", $code_end_html, $text);

	return $text;

} // bbencode_second_pass_code()

// Start add - PHP Syntax Highlighter BBCode MOD
/**
 * PHP MOD
 * Original code/function by phpBB Group
 * Modified by JW Frazier / Fubonis < php_fubonis@yahoo.com >
 */
function bbencode_second_pass_php($text, $uid, $bbcode_tpl)
{
	$code_start_html = $bbcode_tpl['php_open'];
	$code_end_html =  $bbcode_tpl['php_close'];

	// First, do all the 1st-level matches. These need an htmlspecialchars() run,
	// so they have to be handled differently.
	$match_count = preg_match_all("#\[php:1:$uid\](.*?)\[/php:1:$uid\]#si", $text, $matches);

	// To change the colors of the syntax, uncomment the 6 lines above and
	// change the color codes. IF your host php settings allow ini_set() the
	// colors will be changed. If ini_set() is disallowed, nothing will change.
//	@ini_set('highlight.string', '#DD0000');
//	@ini_set('highlight.comment', '#FF9900');
//	@ini_set('highlight.keyword', '#007700');
//	@ini_set('highlight.bg', '#FFFFFF');
//	@ini_set('highlight.default', '#0000BB');
//	@ini_set('highlight.html', '#000000');

	for ($i = 0; $i < $match_count; $i++)
	{
		$before_replace = $matches[1][$i];
		$after_replace = ltrim(rtrim($matches[1][$i]), "\n\r\x0B");

		// Prepare the code for highlight_string()
		$after_replace = undo_htmlspecialchars($after_replace);

		// Add the php tags if needed to let highlight_string() works
		if (preg_match('/^<\?.*?\?>$/si', $after_replace) <= 0)
		{
			$after_replace = "<?php$after_replace ?>";
			$added = TRUE;
		} else
		{
			$added = FALSE;
		}

		// Highlight the php code
		if(strcmp('4.2.0', phpversion()) > 0)
		{
			ob_start();
			highlight_string($after_replace);
			$after_replace = ob_get_contents();
			ob_end_clean();
		} else
		{
			$after_replace = highlight_string($after_replace, TRUE);
		}

		// Remove the php tags if added to let highlight_string() works
		if ($added == TRUE)
		{
			$after_replace = substr_replace($after_replace, '', strpos($after_replace, '&lt;?php'), 8);
			$after_replace = substr_replace($after_replace, '', strrpos($after_replace, '?&gt;'), 5);
		}

		// Remove the <code> tag added by highlight_string() not to force the text size
		$after_replace = str_replace('<code>', '', $after_replace);
		$after_replace = str_replace('</code>', '', $after_replace);

		// Remove the new lines added by highlight_string()
		$after_replace = str_replace("\n", '', $after_replace);

		// Replace ":", "(" & ")" by their HTML codes to prevent smilies replacements
		$code_entities_match = array('#:#', '#\(#', '#\)#');
		$code_entities_replace = array('&#58;', '&#40;', '&#41;');
		$after_replace = preg_replace($code_entities_match, $code_entities_replace, $after_replace);

		// Replace <font color=...> by <span style="color:...> to be HTML 4 compliant and  not to force the text size too
		$after_replace = preg_replace('/<font color="(.*?)">/si', '<span style="color: \\1;">', $after_replace);
		$after_replace = str_replace('</font>', '</span>', $after_replace);

		$str_to_match = "[php:1:$uid]" . $before_replace . "[/php:1:$uid]";

		$replacement = $code_start_html;
		$replacement .= $after_replace;
		$replacement .= $code_end_html;

		$text = str_replace($str_to_match, $replacement, $text);
	}

	// Now, do all the non-first-level matches. These are simple.
	$text = str_replace("[php:$uid]", $code_start_html, $text);
	$text = str_replace("[/php:$uid]", $code_end_html, $text);

	return $text;

}  // bbencode_second_pass_code_php()
// End add - PHP Syntax Highlighter BBCode MOD
/**
 * Rewritten by Nathan Codding - Feb 6, 2001.
 * - Goes through the given string, and replaces xxxx://yyyy with an HTML <a> tag linking
 * 	to that URL
 * - Goes through the given string, and replaces www.xxxx.yyyy[zzzz] with an HTML <a> tag linking
 * 	to http://www.xxxx.yyyy[/zzzz]
 * - Goes through the given string, and replaces xxxx@yyyy with an HTML mailto: tag linking
 *		to that email address
 * - Only matches these 2 patterns either after a space, or at the beginning of a line
 *
 * Notes: the email one might get annoying - it's easy to make it more restrictive, though.. maybe
 * have it require something like xxxx@yyyy.zzzz or such. We'll see.
 */
function make_clickable($text)
{

	$text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1&#058;", $text);

	// pad it with a space so we can match things at the start of the 1st line.
	$ret = ' ' . $text;

	// matches an "xxxx://yyyy" URL at the start of a line, or after a space.
	// xxxx can only be alpha characters.
	// yyyy is anything up to the first space, newline, comma, double quote or <
	$ret = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $ret);

	// matches a "www|ftp.xxxx.yyyy[/zzzz]" kinda lazy URL thing
	// Must contain at least 2 dots. xxxx contains either alphanum, or "-"
	// zzzz is optional.. will contain everything up to the first space, newline,
	// comma, double quote or <.
	$ret = preg_replace("#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $ret);

	// matches an email@domain type address at the start of a line, or after a space.
	// Note: Only the followed chars are valid; alphanums, "-", "_" and or ".".
	$ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $ret);

	// Remove our padding..
	$ret = substr($ret, 1);

	return($ret);
}

/**
 * Nathan Codding - Feb 6, 2001
 * Reverses the effects of make_clickable(), for use in editpost.
 * - Does not distinguish between "www.xxxx.yyyy" and "http://aaaa.bbbb" type URLs.
 *
 */
function undo_make_clickable($text)
{
	$text = preg_replace("#<!-- BBCode auto-link start --><a href=\"(.*?)\" target=\"_blank\">.*?</a><!-- BBCode auto-link end -->#i", "\\1", $text);
	$text = preg_replace("#<!-- BBcode auto-mailto start --><a href=\"mailto:(.*?)\">.*?</a><!-- BBCode auto-mailto end -->#i", "\\1", $text);

	return $text;

}

/**
 * Nathan Codding - August 24, 2000.
 * Takes a string, and does the reverse of the PHP standard function
 * htmlspecialchars().
 */
function undo_htmlspecialchars($input)
{
	$input = preg_replace("/&gt;/i", ">", $input);
	$input = preg_replace("/&lt;/i", "<", $input);
	$input = preg_replace("/&quot;/i", "\"", $input);
	$input = preg_replace("/&amp;/i", "&", $input);

	return $input;
}

/**
 * This is used to change a [*] tag into a [*:$uid] tag as part
 * of the first-pass bbencoding of [list] tags. It fits the
 * standard required in order to be passed as a variable
 * function into bbencode_first_pass_pda().
 */
function replace_listitems($text, $uid)
{
	$text = str_replace("[*]", "[*:$uid]", $text);

	return $text;
}

/**
 * Escapes the "/" character with "\/". This is useful when you need
 * to stick a runtime string into a PREG regexp that is being delimited
 * with slashes.
 */
function escape_slashes($input)
{
	$output = str_replace('/', '\/', $input);
	return $output;
}

/**
 * This function does exactly what the PHP4 function array_push() does
 * however, to keep phpBB compatable with PHP 3 we had to come up with our own
 * method of doing it.
 * This function was deprecated in phpBB 2.0.18
 */
function bbcode_array_push(&$stack, $value)
{
   $stack[] = $value;
   return(sizeof($stack));
}

/**
 * This function does exactly what the PHP4 function array_push() does
 * however, to keep phpBB compatable with PHP 3 we had to come up with our own
 * method of doing it.
 * This function was deprecated in phpBB 2.0.18
 */
function bbcode_array_pop(&$stack)
{
   $arrSize = count($stack);
   $x = 1;

   while(list($key, $val) = each($stack))
   {
      if($x < count($stack))
      {
	 		$tmpArr[] = $val;
      }
      else
      {
	 		$return_val = $val;
      }
      $x++;
   }
   $stack = $tmpArr;

   return($return_val);
}

//
// Smilies code ... would this be better tagged on to the end of bbcode.php?
// Probably so and I'll move it before B2
//
function smilies_pass($message)
{
	static $orig, $repl;

	if (!isset($orig))
	{
		global $db, $board_config, $portal_config, $var_cache;

		$orig = $repl = array();

		if($portal_config['cache_enabled'])
		{
			$orig = $var_cache->get('orig2', 86400, 'smilies');
			$repl = $var_cache->get('repl2', 86400, 'smilies');
		}
		if(!$orig)
		{
			$sql = 'SELECT * FROM ' . SMILIES_TABLE;
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't obtain smilies data", "", __LINE__, __FILE__, $sql);
			}
			$smilies = $db->sql_fetchrowset($result);

			if (count($smilies))
			{
				usort($smilies, 'smiley_sort');
			}

			for ($i = 0; $i < count($smilies); $i++)
			{
				$orig[] = "/(?<=.\W|\W.|^\W)" . preg_quote($smilies[$i]['code'], "/") . "(?=.\W|\W.|\W$)/";
				$repl[] = '<img src="'. $board_config['smilies_path'] . '/' . $smilies[$i]['smile_url'] . '" alt="' . $smilies[$i]['emoticon'] . '" border="0" />';
			}

			if($portal_config['cache_enabled'])
			{
				$var_cache->save($orig, 'orig2', 'smilies');
				$var_cache->save($repl, 'repl2', 'smilies');
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

function acronym_pass($message)
{
	static $orig, $repl;

	if( !isset($orig) )
	{
		global $db, $board_config;
		$orig = $repl = array();

		$sql = 'SELECT * FROM ' . ACRONYMS_TABLE;
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't obtain acronyms data", "", __LINE__, __FILE__, $sql);
		}

		$acronyms = $db->sql_fetchrowset($result);

		if( count($acronyms) )
		{
			usort( $acronyms, 'acronym_sort' );
		}

		for ($i = 0; $i < count($acronyms); $i++)
		{
			$orig[] = '#\b(' . preg_quote( $acronyms[$i]['acronym'], "/") . ')\b#';
			//$orig[] = "/(?<=.\W|\W.|^\W)" . phpbb_preg_quote($acronyms[$i]['acronym'], "/") . "(?=.\W|\W.|\W$)/";
			$repl[] = '<acronym title="' . $acronyms[$i]['description'] . '">' . $acronyms[$i]['acronym'] . '</acronym>'; ;
		}
	}

	if( count( $orig ) )
	{
		$segments = preg_split( '#(<acronym.+?>.+?</acronym>|<.+?>)#s' , $message, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

		$message = '';

		foreach( $segments as $seg )
		{
			if( $seg[0] != '<' && $seg[0] != '[' )
			{
				$message .= str_replace('\"', '"', substr(preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "preg_replace(\$orig, \$repl, '\\0')", '>' . $seg . '<'), 1, -1));
			}
			else
			{
				$message .= $seg;
			}
		}
	}

	return $message;
}

function smiley_sort($a, $b)
{
	if ( strlen($a['code']) == strlen($b['code']) )
	{
		return 0;
	}

	return ( strlen($a['code']) > strlen($b['code']) ) ? -1 : 1;
}

function acronym_sort($a, $b)
{
	if ( strlen($a['acronym']) == strlen($b['acronym']) )
	{
		return 0;
	}

	return ( strlen($a['acronym']) > strlen($b['acronym']) ) ? -1 : 1;
}
?>
