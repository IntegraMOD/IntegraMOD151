<?php 
/************************************************************** 
* MOD Title:   Signatures control 
* MOD Version: 1.2.1
* Translation: English 
* Rev date:    14/08/2004 
* 
* Translator:  -=ET=- < space_et@tiscali.fr > (n/a) http://www.golfexpert.net/phpbb 
*              Narc0sis < corrosion69@hotmail.com > (n/a) http://www.deviantcore.com
* 
***************************************************************/ 

$lang['sig_settings'] = 'Signature Settings'; 
$lang['sig_settings_explain'] = 'Warning: for all numeric fields (except for imposed font size), set a "0" or nothing means "unlimited"!'; 

$lang['sig_max_lines'] = 'Maximum number of lines'; 
$lang['sig_wordwrap'] = 'Maximum number of characters with no space'; 
$lang['sig_allow_font_sizes'] = 'Text font size [size]'; 
$lang['sig_allow_font_sizes_yes'] = 'Free'; 
$lang['sig_allow_font_sizes_max'] = 'Limited'; 
$lang['sig_allow_font_sizes_imposed'] = 'Imposed'; 
$lang['sig_font_size_limit'] = 'Font size limitations or imposed size'; 
$lang['sig_font_size_limit_explain'] = 'phpBB does not manage fonts larger than 29. Moreover if you want to impose a font size, you can not set a size smaller than 7'; 
$lang['sig_min_font_size'] = 'min /'; 
$lang['sig_max_font_size'] = 'max or imposed size'; 
$lang['sig_text_enhancement'] = 'Allow text enhancements'; 
$lang['sig_allow_bold'] = 'Bold [b]'; 
$lang['sig_allow_italic'] = 'Italic [i]'; 
$lang['sig_allow_underline'] = 'Underline [u]'; 
$lang['sig_allow_colors'] = 'Font colors [color]'; 
$lang['sig_text_presentation'] = 'Allow text presentations'; 
$lang['sig_allow_quote'] = 'Quotes [quote]'; 
$lang['sig_allow_code'] = 'Code quotes [code]'; 
$lang['sig_allow_list'] = 'Lists [list]'; 
$lang['sig_allow_url'] = 'Allow urls [url]'; 
$lang['sig_allow_images'] = 'Allow images [img]'; 
$lang['sig_max_images'] = 'Maximum number of images'; 
$lang['sig_max_img_size'] = 'Maximum images size'; 
$lang['sig_max_img_size_explain1'] = 'In principle, image size control must not be problematic on this board. Nevertheless, if an image size cannot be checked, set if the image must be allowed by default or refused'; 
$lang['sig_max_img_size_explain2'] = 'Image size control for some images may be impossible on this board (%s). Set if uncontrollable images must be allowed by default or refused'; 
$lang['sig_max_img_size_explain3'] = 'In principle, image size control is impossible on this board (%s). Set if uncontrollable images must be allowed by default or refused'; 
$lang['sig_img_size_legend'] = '(h x w)'; 
$lang['sig_allow_on_max_img_size_fail'] = 'Allow if impossible to control'; 
$lang['sig_max_img_files_size'] = 'Maximum total image files size'; 
$lang['sig_max_img_av_files_size'] = 'Maximum total image+avatar files size'; 
$lang['sig_max_img_av_files_size_explain'] = 'If a value is set in this field, a global control for the file size of the signature\'s images and poster\'s avatar will proceed, and the 2 separate controls will be disabled. If no value or a 0 is set, the global control will be disabled.'; 
$lang['sig_Kbytes'] = 'Kb'; 
$lang['sig_exotic_bbcodes_disallowed'] = 'Disallowed other BBCodes';
$lang['sig_exotic_bbcodes_disallowed_explain'] = 'Set other BBCodes which must be disallowed (eg.: fade,php,shadow)';
$lang['sig_allow_smilies'] = 'Allow smilies';
$lang['sig_reset'] = 'Reset member\'s signature';
$lang['sig_reset_explain'] = 'Erase the signature in the profile of <span style="color: #800000">all the members!</span> This is to oblige them to set it again, and then passed the signature control';
$lang['sig_reset_confirm'] = 'Are you sure you want to erase the signature of all the members?';

$lang['sig_reset_successful'] = 'Signatures of all the member\'s have been successfully erased!';
$lang['sig_reset_failed'] = 'Error: member\'s signature can\'t be erased.';

$lang['sig_config_error'] = 'Your signature settings are not valid.'; 
$lang['sig_config_error_int'] = 'Data set for these fields are not positive integers (or font sizes resquested are larger than 29):'; 
$lang['sig_config_error_min_max'] = 'You have set incoherent values for minimum and maximum font sizes (min: %s / max: %s). The maximum font size must be larger than the minimum one.'; 
$lang['sig_config_error_imposed'] = 'You have chosen to impose the signature font size but the font size is not valid (%). The minimum is 7 and the maximum 29.'; 

$lang['sig_allow_signature'] = 'Can display signature';
$lang['sig_yes_not_controled'] = 'Yes not controled';
$lang['sig_yes_controled'] = 'Yes controled';

$lang['sig_explain'] = 'A signature is a little text that can be added at the bottom of your posts.';
$lang['sig_explain_limits'] = 'It\'s limited to %s characters%s%s%s.'; 
$lang['sig_explain_max_lines'] = ' on %s line(s)'; // Be careful to the space at the begining! 
$lang['sig_explain_font_size_limit'] = ' (size %s to %s)'; // Be careful to the space at the begining! 
$lang['sig_explain_font_size_max'] = ' (size %s maximum)'; // Be careful to the space at the begining! 
$lang['sig_explain_no_image'] = ' and no image'; // Be careful to the space at the begining! 
$lang['sig_explain_images_limit'] = ' and %s image(s) with none larger than %sx%s pixels and for a maximum of %sKb'; // Be careful to the space at the begining! 
$lang['sig_explain_unlimited_images'] = ' and as many images as you want but none can exceed %sx%s pixels, for a maximum of %sKb'; // Be careful to the space at the begining! 
$lang['sig_explain_avatar_included'] = ', avatar included'; 
$lang['sig_explain_wordwrap'] = 'In your text, no more than %s characters without space too.'; 

$lang['sig_BBCodes_are_OFF'] = 'BBCodes are <u>OFF</u>'; 
$lang['sig_bbcodes_on'] = '%sBBCodes%s ON: '; 
$lang['sig_bbcodes_off'] = '%sBBCodes%s OFF: '; 
$lang['sig_none'] = 'none'; 
$lang['sig_all'] = 'all'; 

$lang['sig_error'] = 'Your signature is not valid.'; 
$lang['sig_error_max_lines'] = 'Your text includes %s lines whereas only %s are authorized.'; 
$lang['sig_error_wordwrap'] = 'Your text includes %s group(s) of more than %s characters without space whereas it\'s forbidden.'; 
$lang['sig_error_bbcode'] = 'You have used this(these) forbidden BBCode(s): %s'; 
$lang['sig_error_font_size_min'] = 'You have used the font size %s whereas the minimum authorized is set to %s.'; 
$lang['sig_error_font_size_max'] = 'You have used the font size %s whereas the maximum authorized is set to %s.'; 
$lang['sig_error_num_images'] = 'You have used %s images whereas the maximum authorized is %s.'; 
$lang['sig_error_images_size'] = 'The %s image is too large.<br />Its size is %s pixels high and %s wide, whereas the maximum size authorized by image is %s high and %s wide.'; 
$lang['sig_unlimited'] = 'unlimited'; 
$lang['sig_error_images_size_control'] = 'Impossible to control the image size of: %s<br />Either there is no image at this address or the forum can not control it, so you can\'t use it.'; 
$lang['sig_error_avatar_local'] = 'There is a problem with this file: %s<br />It\'s impossible to verify its size.'; 
$lang['sig_error_avatar_url'] = 'This url must be wrong: %s<br />There is no avatar at this address.'; 
$lang['sig_error_img_files_size'] = 'The total size of the image file(s) used is %sKb whereas the maximum authorized is %sKb.'; 
$lang['sig_error_img_av_files_size'] = 'The total size of the image file(s) used for your signature (%sKb) and your avatar (%sKb) is higher than the %sKb authorized.'; 

?>