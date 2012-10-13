<?php
#########################################################
## SQL commands to phpBB2
## Author: Niels Chr. Rød
## Nickname: Niels Chr. Denmark
## Email: ncr@db9.dk
##
## Ver 1.0.0
##
## This file will, if executed by admin, update all the users post count
## to reflect the number of posts exisiting in the DB, that way insure
## that the number of posts showen in the users profile, also fit the 
## actual number of posts the user have
## if only a specific user need to be updated, then run this 2 SQL, instead
##
##  SELECT @u_posts:=COUNT(*) FROM phpbb_posts where poster_id=1;
##  UPDATE phpbb_users SET user_posts=@u_posts where user_id=1;
##
## Note, that you should substitude the prefix, with whatever you are using, and the users ID
##
#########################################################

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/functions_selects.'.$phpEx);

############################################################
## Here you can specify witch users shall be updated, you have a exlude list, and a include list, fill in with the users ID,
## seperate eatch entry with a comma
## e.g. $sql_exclude = ' "'.ANONYMOUS.'" , 2'; will exclude the guest user and the user with the ID of 2
## or e.g. $sql_include = '2'; will only update the user with the ID of 2, leave this empty to update all users


$sql_exclude = '"'.ANONYMOUS.'"';
$sql_include = '';


## End user defineble variables
############################################################

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

if ($userdata['user_level']!=ADMIN)
      message_die(GENERAL_ERROR, "You are not Authorised to do this"); 

$sql='SELECT u.user_id, count(p.poster_id) as posts FROM '.USERS_TABLE.' u, '.POSTS_TABLE.' p WHERE u.user_id = p.poster_id '.(($sql_include) ? 'AND u.user_id IN ('.$sql_include.')':'') . ' AND u.user_id NOT IN ('.$sql_exclude.') GROUP BY u.user_id';
if(!$result = $db->sql_query($sql)) 
{
 message_die(GENERAL_ERROR, "Error finding users post count"); 
}
else
{
  while( $users = $db->sql_fetchrow($result))
  {
     $sub_sql='UPDATE '.USERS_TABLE.' SET user_posts='.$users['posts'].' where user_id='.$users['user_id'];
     if(!$result2 = $db->sql_query($sub_sql)) 
     {
        message_die(GENERAL_ERROR, "Error updating users".$users['user_id']." post count"); 
     }
     $n++;
  }
  $message .='<b><font color=#0000fF>users updated:</font></b> in total '.$n.' users updated';
  message_die(GENERAL_MESSAGE, $message); 
}
?>