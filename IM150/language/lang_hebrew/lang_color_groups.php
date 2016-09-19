<?php
/***************************************************************************
*                            $RCSfile: lang_color_groups.php,v $
*                            -------------------
*   copyright            : (C) 2003 Nivisec.com
*   email                : support@nivisec.com
*
*   $Id: lang_color_groups.php,v 1.3 2003/09/03 02:52:47 nivisec Exp $
*
*
***************************************************************************/

/***************************************************************************
*
*   This program is free software; you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation; either version 2 of the License, or
*   (at your option) any later version.
*
***************************************************************************/

$lang['Color_Groups'] = 'Color Groups';
$lang['Manage_Color_Groups'] = 'Manage Color Groups';
$lang['Add_New_Group'] = 'Add New Group';
$lang['Status'] = 'Status';
$lang['Color'] = 'Color';
$lang['User_Count'] = 'User Count';
$lang['Color_List'] = 'Color Name List:';
$lang['Group_Name'] = 'Group Name';
$lang['Define_Users'] = 'Define Users';
$lang['Color_Group_User_List'] = 'Color Group User List';
$lang['Options'] = 'Options';
$lang['Example'] = 'Example';
$lang['Version'] = 'Version';
$lang['User_List'] = 'Full User List';
$lang['Unassigned_User_List'] = 'Users With No Group';
$lang['Assigned_User_List'] = 'Users With A Group';
$lang['Add_Arrow'] = 'Add To List';
$lang['Update'] = 'Update';
$lang['Updated_Group'] = 'Updated Group User List<br>';
$lang['Delete'] = 'Delete';
$lang['Deleted_Group'] = 'Deleted Specified Group.  All users that were in it have been reset to no group membership<br>';
$lang['Hide'] = 'Hide';
$lang['Un-hide'] = 'Un-hide';
$lang['Move_Up'] = 'Move Up';
$lang['Move_Down'] = 'Move Down';
$lang['Group_Hidden'] = 'Group Hidden<br>';
$lang['Group_Unhidden'] = 'Group Un-hidden<br>';
$lang['Groups_Updated'] = 'Group changes have been updated<br>';
$lang['Moved_Group'] = 'Moved group order<br>';


//Descriptions
$lang['Manage_Color_Groups_Desc'] = 'Update groups, add a new group, or manage the users assigned to a particular color group.<br>Groups that you choose to "Hide" will not show up on the main index list.';
$lang['Color_Group_User_List_Desc'] = 'Add or remove users to a specified color group.';

//Errors
$lang['Error_Group_Table'] = 'Error querying the color groups table.';
$lang['Error_Font_Color'] = '<b><u>Warning:</b></u>  The specified font color appears to be invalid!';
$lang['Color_Ok'] = 'The specified font color appears to be valid.';
$lang['No_Groups_Exist'] = 'No groups exist.';
$lang['Error_Users_Table'] = 'Error querying the users table.';
$lang['Invalid_Group_Add'] = '%s is an invalid or duplicate group name.<br>';

//Dynamic
$lang['Group_Updated'] = 'Updated Color Group %s<br>';
$lang['Editing_Group'] = 'Currently editing the user list for %s.';
$lang['Invalid_User'] = '%s is an invalid username, skipping<br>';
$lang['Invalid_Order_Num'] = '%s contained an invalid order number, but it has been fixed.  Please try your move up/down again.';

//New for 1.2.0
$lang['Users_List'] = 'Users List';
$lang['Groups_List'] = 'User Groups List';
$lang['List_Info'] = '<b>Notes</b>: <ul><li>Hold CTRL when clicking to select multiple names.  <li>If a user belongs to a user group, and is added to a specific color group, the color group that contains the user will be used; not the one the user group belongs to.<li>The list names are formated as NAME (CURRENT_COLOR_GROUP).  There will be no (CURRENT_COLOR_GROUP) if the entry doesn\'t belong to one.<li>If a user is a member of 2 or more user groups, the highest ranking color group will be assigned (you order their appearance on the main page).</ul>';

?>