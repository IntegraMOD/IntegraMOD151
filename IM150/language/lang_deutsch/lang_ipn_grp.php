<?php
/***************************************************************************
 *				lang_ipn_grp.php
 *
 *	begin				: OCT/29/2004
 *	copyright			: Loewen Enterprise - Xiong Zou
 *	email				: zouxiong@loewen.com.sg
 *
 *	version				: 1.0.0.1 - OCT/29/2004
 *
 ***************************************************************************/
/***************************************************************************
## Terms of Use
##
## All of my MODifications are to use and edit/change for phpBB End Users
##
## Plese DO NOT remove any copyright/licence declaration when using the MODification
##
## I will remain as the sole developer for all my MODifications unless stated otherwise
##
##
## Distribution Terms
##
## All of my MODifications are prohibited to distribute to others without the permission from me.
##
## Plese DO NOT remove any copyright/licence declaration when using the MODification
##
## I will remain as the sole developer for all my MODifications unless stated otherwise
##
## Re-Distribution Terms
##
## If you are distributing WHOLE or PART of my MOD in your MOD Projects or Pre-modded Projects or any other means, you must:
##
## Get the formal authorization from me first.
##
## Plese DO NOT remove any copyright/licence declaration when using the MODification
##
## I will remain as the sole developer for all my MODification unless stated otherwise. Do NOT declare youself as my co-developer
##
## Re-Distribution Terms DOES NOT apply to MOD authors that developing Add-Ons to my MOD. You will be the Add-Ons' Developer/Author
##
***************************************************************************/

//
// Display Topup.php
//
$lang['L_IPN_Subscribe_term_title'] = 'Subscription Terms: (Recurring Payment Method)';
$lang['L_IPN_Subscribe_free'] = 'Free';
$lang['L_IPN_Subscribe_for_first'] = ' for the first ';
$lang['L_IPN_Subscribe_then'] = 'Then';
$lang['L_IPN_Subscribe_for_next'] = ' for the next ';
$lang['L_IPN_Subscribe_for_following'] = ' for the following every ';
$lang['L_IPN_Subscribe_auto_renew'] = 'Your subscription will be automatically renewed unless you unsubscribed.';
$lang['L_IPN_Subscribe_for_every'] = ' for the every ';
$lang['L_IPN_Subscribe_term_manual'] = 'Subscription Terms: (Manual Payment Method)';
$lang['L_IPN_Subscribe_manual_renew'] = 'Your subscription will expire after expiration date, to keep your subscription, you have to manually pay subscription fee every ';
$lang['L_IPN_Subscribe_cancel_paypal'] = 'You can <A HREF="https://www.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=%s"><IMG SRC="https://www.paypal.com/en_US/i/btn/cancel_subscribe_gen.gif" BORDER="0"></A> from this group. <br />Note: Your unsubscription will take effect only when your current expiration date is reached.';
$lang['L_IPN_Subscribe_extend'] = 'Extend your subscription';
$lang['L_IPN_Subscribe_paypal_sub_url'] = 'https://www.paypal.com/cgi-bin/webscr';
$lang['L_IPN_Subscribe_to_grp'] = 'Subscribe to group - ';
$lang['L_IPN_Subscribe_paypal_button_alt'] = 'Make payments with PayPal - it\'s fast, free and secure!';


//display page_header
$lang['L_IPN_Subscribe_header_welcome'] = 'Welcome %s, your current subcriptions: ';
$lang['L_IPN_Subscribe_expire_date'] = ' [Expires at %s]';

//display at groupcp.php
$lang['L_IPN_Subscribe_this_grp'] = '%sSubscribe to this group%s';
$lang['L_IPN_Subscribe_Payment_grp'] = 'This is a payment group: ';

//display at user subscription administration
$lang['L_IPN_user_sub_title'] = 'User Subscription Control';
$lang['L_IPN_user_sub_enplain'] = 'Here you can change your users\' payment group subscription information.';
$lang['L_IPN_user_sub_yes'] = 'Yes';
$lang['L_IPN_user_sub_no'] = 'No';
$lang['L_IPN_user_sub_Update'] = 'Update';
$lang['L_IPN_user_sub_info'] = 'User Subscription Information';
$lang['L_IPN_user_sub_info_exp'] = 'Modify the user subscription information. You can add him to a group and set the expiration date. Note that the expiration date must follow the format "yyyy/mm/dd hh:mm:ss" exactly.';
$lang['L_IPN_grp_name'] = 'Group Name';
$lang['L_IPN_grp_inornot'] = 'In this group?';
$lang['L_IPN_grp_expire_date'] = 'Expiration Date';
$lang['L_IPN_grp_action'] = 'Action';
$lang['L_IPN_user_sub_updated'] = 'User subscription information updated successfully.';
$lang['L_IPN_click_update_again'] = 'Click %shere%s to check the subscription of this user again.';

//display IPN Log
$lang['L_IPN_log_title'] = 'IPN Log Information';
$lang['L_IPN_log_title_explain'] = 'Search the IPN for each user or list transaction logs for all users. Note: you can leave the field blank to search all transactions. If the username can not be found, it will ouput all transactions too.';
$lang['L_LW_USERNAME'] = 'User Account';

//display subscribe settings
$lang['L_SUB_SETTINGS_TITLE'] = 'Subscription Settings';
$lang['L_SUB_SETTINGS_EXPLAIN'] = 'Update the subscribtion related information';
$lang['L_SUB_SETTINGS'] = 'Subscription General Settings';
$lang['L_SUB_EXTRA_DAYS'] = 'Give extra days to subscriber';
$lang['L_SUB_EXTRA_DAYS_EXPLAIN'] = 'Since PayPal will delay on charging payment and for the purpose of reward too, give your subcriber some extra days. for example 2.';
$lang['update_sub_settings_error'] = 'Update %s of subscription settings error.';
$lang['sub_settings_updated'] = 'Subcription settings are successfully updated.';
$lang['Click_return_update_sub_settings'] = 'Click %shere%s to update the subscription settings again.';


$lang['L_SUBMIT'] = 'Submit';
$lang['L_RESET'] = 'Reset';

?>
