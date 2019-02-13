<?php
/**************************************************************
*
*  MOD Title:   Complete banner
*  MOD Version: 1.2.0.
*  Translation: English
*  Rev date:    10/12/2003
*
*  Translator:  Niels < ncr@db9.dk > (Niels Chr. Rød) http://mods.db9.dk
*
***************************************************************/

// this is the text showen in admin panel, depending on your template layout,
// you may change the text, so this reflect the placement in the templates
// these are only exampels, you may add more or remove some of them.

$lang['Banner_spot']['0'] = "Over all banner"; // used for {BANNER_0_IMG} tag in the template files
$lang['Banner_spot']['1'] = "Top left 1"; // used for {BANNER_1_IMG} tag in the template files
$lang['Banner_spot']['2'] = "Top left 2"; // used for {BANNER_2_IMG} tag in the template files
$lang['Banner_spot']['3'] = "Top center 1"; // used for {BANNER_3_IMG} tag in the template files
$lang['Banner_spot']['4'] = "Top center 2"; // used for {BANNER_4_IMG} tag in the template files
$lang['Banner_spot']['5'] = "Top right 1"; // used for {BANNER_5_IMG} tag in the template files
$lang['Banner_spot']['6'] = "Top right 2"; // used for {BANNER_6_IMG} tag in the template files
$lang['Banner_spot']['7'] = "Bottom left 1"; // used for {BANNER_7_IMG} tag in the template files
$lang['Banner_spot']['8'] = "Bottom left 2"; // used for {BANNER_8_IMG} tag in the template files
$lang['Banner_spot']['9'] = "Bottom center 1"; // used for {BANNER_9_IMG} tag in the template files
$lang['Banner_spot']['10'] = "Bottom center 2"; // used for {BANNER_10_IMG} tag in the template files
$lang['Banner_spot']['11'] = "Bottom right 1"; // used for {BANNER_11_IMG} tag in the template files
$lang['Banner_spot']['12'] = "Bottom right 2"; // used for {BANNER_12_IMG} tag in the template files
$lang['Banner_spot']['13'] = "Forum view top"; // used for {BANNER_13_IMG} tag in the template files
$lang['Banner_spot']['14'] = "Topic view top"; // used for {BANNER_14_IMG} tag in the template files
$lang['Banner_spot']['15'] = "Topic view botton"; // used for {BANNER_15_IMG} tag in the template files

//
// please do not modify the text below (except if you are translating)
//
$lang['Banner_title'] = "Banner Administration";
$lang['Banner_text'] = "From here you may modify the banners used on this site, banners can be defined on a time based rule";
$lang['Add_new_banner'] = "New banner";
$lang['Banner_add_text'] = "Here you may add/edit a banner";

$lang['Banner_example']="Example";
$lang['Banner_example_explain'] ="This should be how the banner display";
$lang['Banner_type_text'] = "type";
$lang['Banner_type_explain'] = "Select the type of banner";
//pre-defined types
$lang['Banner_type'][0] = "Image link";
$lang['Banner_type'][2] = "Text link";
$lang['Banner_type'][4] = "Custom HTML code";
$lang['Banner_type'][6] = "Flash file";

$lang['Banner_name'] = "Image path/Text/Code";
$lang['Banner_name_explain'] = "path's must be relative to phpbb2 path or complete URL (include http://)";
$lang['Banner_size'] = "Image Size";
$lang['Banner_size_explain'] = "if size is set to zero, the image will default to is pixel size";
$lang['Banner_width'] = "Width";
$lang['Banner_height'] = "Height";

$lang['Banner_activated'] = "Activated";
$lang['Banner_activate'] = "Activate banner";
$lang['Banner_comment'] = "Comment";
$lang['Banner_description'] = "Image description";
$lang['Banner_description_explain'] = "This text is showen on mouse over Image";
$lang['Banner_url'] = "Redirect url";
$lang['Banner_url_explain'] ="The url of the site to redirect to, on mouse click, start with HTTP://<br />(The redirect URL is only enabled if type is Image or Text link)";
$lang['Banner_owner']="Moderator of banner";
$lang['Banner_owner_explain']="This user may manage the banner - (not implemented jet)";
$lang['Banner_placement'] = "Placement";
$lang['Banner_clicks'] = "Clicks";
$lang['Banner_clicks_explain'] = "(Counting is only enabled if type is Image or Text link)";
$lang['Banner_view'] = "Views";
$lang['Banner_weigth'] = "Weigth of banner";
$lang['Banner_weigth_explain'] = "How offen this banner are to be showen, relative to other active banners at the current time. (1-99)";
$lang['Show_to_users'] ='Show to users';
$lang['Show_to_users_explain'] ='Select witch type of users should see the banner';
$lang['Show_to_users_select'] = 'User must be %s to %s'; //%s are supstituded with dropdown selections
$lang['Banner_level']['-1'] = 'Guest';
$lang['Banner_level']['0'] = 'Registered';
$lang['Banner_level']['1'] = 'Moderator';
$lang['Banner_level']['2'] = 'Admin';
$lang['Banner_level_type']['0'] = 'equal';
$lang['Banner_level_type']['1'] = 'less or equal';
$lang['Banner_level_type']['2'] = 'greater or equal';
$lang['Banner_level_type']['3'] = 'not';

$lang['Time_interval'] = "Time interval";
$lang['Time_interval_explain'] = "Only apply either a date, a day of week or/and a time";
$lang['Start'] = "Start";
$lang['End'] = "End";
$lang['Year'] = "Year";
$lang['Month'] = "Month";
$lang['Date'] = "Date";
$lang['Weekday'] = "Day of week";
$lang['Hour'] = "Hour";
$lang['Min'] = "Min";
$lang['Time_type'] = "Time type";
$lang['Time_type_explain'] = "Select if the information is a time interval or a date interval <i>(you may still apply a time interval, if you select a date based rule)</i>";
$lang['Not_specify'] = "Not Specified";
$lang['No_time'] = "No time";
$lang['By_time'] = "By time";
$lang['By_week'] = "By day of week";
$lang['By_date'] = "By date";

// messages
$lang['Missing_banner_id'] = "The banner id is missing";
$lang['Missing_banner_owner'] = "You must select a banner owner";
$lang['Missing_time'] = "When you define a banner as time based, you must provide the time interval";
$lang['Missing_date'] ="When you define a banner by date, you must at least provide a date and a time interval";
$lang['Missing_week'] ="When you define a banner by week day, you must at least provide a day of week and a time interval";

$lang['Banner_removed'] = "The banner is now removed";
$lang['Banner_updated'] = "The banner is now updated";
$lang['Banner_added'] = "The banner is now added";
$lang['Click_return_banneradmin'] = 'Click %sHere%s to return to the Banner management';

$lang['No_redirect_error'] = 'If you page does not show shortly, please click <b><a href="%s" id="jumplink" name="jumplink">Here<a></b> to go to the requested URL';
$lang['Left_via_banner'] = 'Left via banner';

$lang['Banner_filter'] = 'Banner filter';
$lang['Banner_filter_explain'] = 'Hide this banner after the user have clicked on it';
$lang['Banner_filter_time'] = 'Inactive click time';
$lang['Banner_filter_time_explain'] = 'Number of sec the banner becomes inactive after a user click on it, if banner filter is enabled, the banner will not show during this time';

?>