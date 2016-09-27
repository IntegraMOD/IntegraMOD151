<?php
/***************************************************************************
 *						lang_extend_pcp_management.php [English]
 *						---------------------------------------
 *	begin				: 08/10/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 0.0.4 - 24/10/2003
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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_pcp_management'] = 'Profile Control Panel Management';

	// menu
	$lang['PCP_management'] = 'P.C.P.';
	$lang['PCP_00_tableslinked'] = 'Tables linked';
	$lang['PCP_01_valueslist'] = 'Values lists';
	$lang['PCP_02_classesfields'] = 'Classes';
	$lang['PCP_03_userfields'] = 'Fields definition';
	$lang['PCP_04_usermaps'] = 'Maps definition';

	// objects
	$lang['PCP_tableslinked'] = 'Tables linked';
	$lang['PCP_tableslinked_explain'] = 'Tables used by the Profile Control Panel for values list and buddy/member lists.';

	$lang['PCP_valueslist'] = 'Values lists';
	$lang['PCP_valueslist_explain'] = 'List of values used by the Profile Control Panel.';

	$lang['PCP_classesfields'] = 'Classes';
	$lang['PCP_classesfields_explain'] = 'Here you can edit or delete the classes fields.';

	$lang['PCP_userfields'] = 'Fields definition';
	$lang['PCP_userfields_explain'] = 'Here you can manage the fields used by the Profile Control Panel.';

	$lang['PCP_usermaps'] = 'Maps definition';
	$lang['PCP_usermaps_explain'] = 'Here you can manage the fields maps used in various places.';

	// fields
	$lang['PCP_field_name'] = 'Field name';
	$lang['PCP_field_name_explain'] = 'Set here the name of the field used in php scripts.';
	$lang['PCP_field_name_short'] = 'Field';
	$lang['PCP_field_desc'] = 'Description';
	$lang['PCP_field_image'] = 'Image';
	$lang['PCP_field_class'] = 'Class';
	$lang['PCP_field_type'] = 'Type';
	$lang['PCP_field_get_mode'] = 'Get mode';
	$lang['PCP_field_functions'] = 'Functions';
	$lang['PCP_field_maps_usage'] = 'Used in maps';

	$lang['PCP_field_sql_actions'] = 'SQL actions';
	$lang['PCP_field_add'] = 'Add a new field';

	// fields edit
	$lang['PCP_userfields_edit'] = 'Fields edition';
	$lang['PCP_userfields_edit_explain'] = 'Here you can edit or delete a field.';

	$lang['PCP_field_definition_part'] = 'Base definition';
	$lang['PCP_field_output_part'] = 'Output';
	$lang['PCP_field_input_part'] = 'Input';
	$lang['PCP_field_buddylist_part'] = 'Buddy/member list';

	$lang['PCP_field_lang_key'] = 'Legend of the field';
	$lang['PCP_field_lang_key_explain'] = 'This is the legend that will be use to display the field. You can use a text or a $lang[] key entry (see <i>your_language</i>/lang_main.php).';
	$lang['PCP_field_lang_key_short'] = 'Legend';
	$lang['PCP_field_explain'] = 'Explanation of the field';
	$lang['PCP_field_explain_explain'] = 'This is an explanation of the field that will be use to display. You can use a text or a $lang[] key entry (see <i>your_language</i>/lang_main.php).';
	$lang['PCP_field_image_explain'] = 'You can set here a direct URI or a $image[] key entry (see <i>your_template</i>/<i>your_template</i>.cfg).';
	$lang['PCP_field_title'] = 'Image title';
	$lang['PCP_field_title_explain'] = 'Text displayed in the bubble under the mouse cursor. You can use a text or a $lang[] key entry (see <i>your_language</i>/lang_main.php).';
	$lang['PCP_field_class_explain'] = 'Determines on which condition the content of the field is displayed. Use generic for a non-conditioned field.';
	$lang['PCP_field_type_explain'] = 'Set here the nature of the field.';

	$lang['PCP_field_sql_def'] = 'SQL definition';
	$lang['PCP_field_sql_def_explain'] = 'SQL definition of the field while used in buddy/member list.';

	$lang['PCP_field_get_mode_explain'] = 'Set here the way the field will be inputed. If you are using custom functions for get and check, leave this field blanks.';
	$lang['PCP_field_values_list'] = 'Values list';
	$lang['PCP_field_values_list_explain'] = 'Set here the name of the values list. A values list is required while using a LIST_* get mode.';
	$lang['PCP_field_default'] = 'Default value';
	$lang['PCP_field_default_explain'] = 'Initial value of the field.';
	$lang['PCP_field_auth'] = 'Auth level';
	$lang['PCP_field_auth_explain'] = 'Set here the minimal auth level required to access this field.';
	$lang['PCP_field_get_func'] = 'Get function';
	$lang['PCP_field_get_func_explain'] = 'Set here the name of the custom function used to input the value of the field.';
	$lang['PCP_field_chk_func'] = 'Check function';
	$lang['PCP_field_chk_func_explain'] = 'Set here the name of the custom function used to check the validity of the field after input.';
	$lang['PCP_field_dsp_func'] = 'Display function';
	$lang['PCP_field_dsp_func_explain'] = 'Set here the name of the custom function used to display the value of the field.';
	$lang['PCP_field_link'] = 'Link';
	$lang['PCP_field_link_explain'] = 'This will allows to make a link on the text and on the image. You can use the [cst.*], [view.*] and [user.*] to fill the parameters of the program called. ie :<br />&lt;a href="./profile.[php]?mode=viewprofile&[cst.POST_USERS_URL]=[view.user_id]" class="gen"&gt;%s&lt;/a&gt;';

	$lang['PCP_field_leg'] = 'Display the legend';
	$lang['PCP_field_leg_explain'] = 'Set this to yes to display the legend of the field.';
	$lang['PCP_field_leg_short'] = 'Leg';
	$lang['PCP_field_txt'] = 'Display the text value';
	$lang['PCP_field_txt_explain'] = 'Set this to yes to display the text value of the field.';
	$lang['PCP_field_txt_short'] = 'Txt';
	$lang['PCP_field_img'] = 'Display the image value';
	$lang['PCP_field_img_explain'] = 'Set this to yes to display the image value of the field.';
	$lang['PCP_field_img_short'] = 'Img';
	$lang['PCP_field_use_link'] = 'Use the link';
	$lang['PCP_field_use_link_explain'] = 'Set this to yes to add the link to the text value and/or to the image.';
	$lang['PCP_field_use_link_short'] = 'Lnk';
	$lang['PCP_field_crlf'] = 'Text to next line';
	$lang['PCP_field_crlf_explain'] = 'Set this to yes to write the text under the image.';
	$lang['PCP_field_style'] = 'Span display';
	$lang['PCP_field_style_explain'] = 'HTML expression designed to have a better presentation of the result. A <i>sprintf(style, result)</i> will be performed, so you have to use %s to designat the spot the result will use.<br />Example: &lt;i&gt;%s&lt/i&gt; will set the result in italic.';
	$lang['PCP_field_input_id'] = 'Config name field';
	$lang['PCP_field_input_id_explain'] = 'This will be the value name in an input context, also used as a config value name for the config table.';
	$lang['PCP_field_user_only'] = 'Not a config value';
	$lang['PCP_field_user_only_explain'] = 'Set this to yes will prevent a config value to be created and/or updated. You can use it to designat a users table field or a system field.';
	$lang['PCP_field_system'] = 'System field';
	$lang['PCP_field_system_explain'] = 'Set this to yes will force the field to be displayed for input, even if it is not config field nor a users table field. It will require a get and a check functions. Use it for links or buttons, or other special fields, like coming from other tables.';
	$lang['PCP_field_ind'] = 'Option address';
	$lang['PCP_field_ind_explain'] = 'For buddy/members lists : this is the address of the field in the user options field.';
	$lang['PCP_field_dft'] = 'Checked by default';
	$lang['PCP_field_dft_explain'] = 'For buddy/members lists : default choice for the field in the buddy/members list.';
	$lang['PCP_field_rqd'] = 'Force the selection';
	$lang['PCP_field_rqd_explain'] = 'For buddy/members lists : this will force the selection of the field in the buddy/members list.';
	$lang['PCP_field_hidden'] = 'Add the field as hidden';
	$lang['PCP_field_hidden_explain'] = 'For buddy/members lists : this will result in adding the field to the sql request without displaying it in the buddy/members list.';

	$lang['PCP_system_values'] = 'System values available';

	$lang['PCP_userfields_field_pick_up'] = 'Pick up a field';
	$lang['PCP_userfields_lang_key_pick_up'] = 'Pick up a lang key';

	// fields delete
	$lang['PCP_userfields_delete'] = 'Delete a field';

	// SQL actions
	$lang['PCP_SQL_create_field'] = 'Click %sHere%s to create field in the users table.<br /><br />';
	$lang['PCP_SQL_modify_field'] = 'Click %sHere%s to modify field in the users table.<br /><br />';
	$lang['PCP_SQL_delete_field'] = 'Delete the field from the users table ?';

	$lang['PCP_SQL_create_field_title'] = 'Create a field in the users table';
	$lang['PCP_SQL_edit_field_title'] = 'Modify a field in the users table';
	
	$lang['PCP_SQL_field_name'] = 'Field name';
	$lang['PCP_SQL_field_name_explain'] = 'Name of the table column.';
	$lang['PCP_SQL_field_type'] = 'Type';
	$lang['PCP_SQL_field_type_explain'] = 'Type of the table column';
	$lang['PCP_SQL_field_length'] = 'Length';
	$lang['PCP_SQL_field_length_explain'] = 'Length of the table column.';
	$lang['PCP_SQL_field_unsigned'] = 'Unsigned';
	$lang['PCP_SQL_field_unsigned_explain'] = 'For numeric field only.';
	$lang['PCP_SQL_null'] = 'Null allowed';
	$lang['PCP_SQL_default'] = 'Default value';
	$lang['PCP_SQL_null_value'] = 'NULL';

	// tables linked
	$lang['PCP_tableslinked_name_short'] = 'Names';
	$lang['PCP_tableslinked_name'] = 'Table linked name';
	$lang['PCP_tableslinked_name_explain'] = 'This name will identify the table definition in the various SQL definition of the PCP fields, surrounded by [].<br />(ie: users table will be identify by [USERS])';
	$lang['PCP_tableslinked_id_short'] = 'Id';
	$lang['PCP_tableslinked_id'] = 'SQL id';
	$lang['PCP_tableslinked_id_explain'] = 'SQL identifier, used by the SQL requests.<br />(ie : "u" is the usual used SQL id for users table)';
	$lang['PCP_tableslinked_join'] = 'SQL join';
	$lang['PCP_tableslinked_join_explain'] = 'FROM statement used in SQL requests.<hr />&nbsp;Use [cst.<i>table constant</i>] to get back the real table name.<br />(ie : [cst.USERS_TABLE] for phpbb_users).<hr />&nbsp;Use [<i>Tables linked name</i>] to identify the SQL id.<br />(ie: [USERS].username)<hr />Example: [cst.USERS_TABLE] AS [USERS]';
	$lang['PCP_tableslinked_where'] = 'SQL where';
	$lang['PCP_tableslinked_where_explain'] = 'WHERE statement used in SQL requests.<br />Use [<i>Tables linked name</i>] to identify the SQL id.<br />(ie: [USERS].username <> \'\')';
	$lang['PCP_tableslinked_order'] = 'SQL order by';
	$lang['PCP_tableslinked_order_explain'] = 'ORDER BY statement used in SQL requests.<br />Use [<i>Tables linked name</i>] to identify the SQL id.<br />(ie: [USERS].username)';
	$lang['PCP_tableslinked_sql_desc'] = 'SQL statements';

	$lang['PCP_tableslinked_add'] = 'Add a new table linked';

	// tables linked edit
	$lang['PCP_tableslinked_linked_edit'] = 'Edit a table linked';
	$lang['PCP_tableslinked_linked_edit_explain'] = 'Here you can edit or delete a table linked.';

	// values list
	$lang['PCP_valueslist_name'] = 'Name';
	$lang['PCP_valueslist_name_explain'] = 'This name will identify the values list in the various SQL definition of the PCP fields, surrounded by [].';
	$lang['PCP_valueslist_func'] = 'Function';
	$lang['PCP_valueslist_func_explain'] = 'Set here the name of the custom function used to build the list of values.';
	$lang['PCP_valueslist_table'] = 'Table';
	$lang['PCP_valueslist_table_explain'] = 'Table linked name used to build a list of values for this field.';
	$lang['PCP_valueslist_values'] = 'Values';

	$lang['PCP_valueslist_item_val'] = 'Value';
	$lang['PCP_valueslist_item_txt'] = 'Text';
	$lang['PCP_valueslist_item_img'] = 'Image';

	$lang['PCP_valueslist_add'] = 'Add a new values list';

	// values list edit
	$lang['PCP_valueslist_edit'] = 'Edit a values list';
	$lang['PCP_valueslist_edit_explain'] = 'Here you can edit or delete a values list.';
	$lang['PCP_valueslist_keyfield'] = 'Key field';
	$lang['PCP_valueslist_keyfield_explain'] = 'This fied contains the value of each choice.';
	$lang['PCP_valueslist_txtfield'] = 'Text field';
	$lang['PCP_valueslist_txtfield_explain'] = 'This field contains the text to display.';
	$lang['PCP_valueslist_imgfield'] = 'Image field';
	$lang['PCP_valueslist_imgfield_explain'] = 'This field contains the image to display.';

	$lang['PCP_valueslist_add_item'] = 'Add a new value';
	$lang['PCP_valueslist_del_item'] = 'Delete selection';

	// classes fields
	$lang['PCP_classesfields_name'] = 'Classes name';
	$lang['PCP_classesfields_name_explain'] = 'This name will identify the classes of a field.';
	$lang['PCP_classesfields_config'] = 'Config field';
	$lang['PCP_classesfields_config_explain'] = 'Set here the field managed by the board administrators in order to allow or not the use of the fields of this class to all the users.';
	$lang['PCP_classesfields_admin'] = 'Admin field';
	$lang['PCP_classesfields_admin_explain'] = 'Set here the field managed by the users administrators in order to allow or not the use of the fields of this class to a particular user.';
	$lang['PCP_classesfields_user'] = 'User field';
	$lang['PCP_classesfields_user_explain'] = 'Set here the user preferences field used to display or not the information of this class.';
	$lang['PCP_classesfields_sql_def'] = 'SQL definition';
	$lang['PCP_classesfields_sql_def_explain'] = 'This the sql definition for this class used in the buddy/members list.';

	$lang['PCP_classesfields_add'] = 'Add a new class';

	// classes fields edit
	$lang['PCP_classesfields_edit'] = 'Edit a class';
	$lang['PCP_classesfields_edit_explain'] = 'Here you can edit or delete a field class.';

	// usermaps
	$lang['PCP_usermaps_root'] = 'Root';

	$lang['PCP_usermaps_name'] = 'Map name';
	$lang['PCP_usermaps_name_explain'] = 'This name will identify the map used.';
	$lang['PCP_usermaps_split'] = 'New column';
	$lang['PCP_usermaps_split_explain'] = 'split the display in a new column.';
	$lang['PCP_usermaps_sub'] = 'Sub-maps';
	$lang['PCP_usermaps_add'] = 'Add a new map';
	$lang['PCP_usermaps_custom'] = 'Program used';
	$lang['PCP_usermaps_custom_explain'] = 'Set here if you want to use a standard panel program to display this map.';
	$lang['PCP_custom_none'] = 'Dedicated program';
	$lang['PCP_custom_input'] = 'Standard input program';
	$lang['PCP_custom_output'] = 'Standard output program';

	$lang['PCP_usermaps_fields'] = 'Fields';

	// usermaps edit
	$lang['PCP_usermaps_edit'] = 'Edit a map';
	$lang['PCP_usermaps_edit_explain'] = 'Here you can edit or delete a map.';
	$lang['PCP_usermaps_title'] = 'Map title';
	$lang['PCP_usermaps_title_explain'] = 'The map title is used in some displays. You can set here either a title, or a set of field in order to build the title with.';
	$lang['PCP_usermaps_parent'] = 'Mother map';
	$lang['PCP_usermaps_parent_explain'] = 'Set here to which map this map is attached.';

	$lang['PCP_usermaps_add_titlefield'] = 'Add a new title field';
	$lang['PCP_usermaps_add_field'] = 'Add a new field';

	// usermaps field edit
	$lang['PCP_usermaps_title_edit'] = 'Edit a title field';
	$lang['PCP_usermaps_title_edit_explain'] = 'Here you can edit or delete a field used in the map title.';
	$lang['PCP_usermaps_field_edit'] = 'Edit a field';
	$lang['PCP_usermaps_field_edit_explain'] = 'Here you can edit or delete a field used in the map.';

	// error msgs
	$lang['PCP_err_field_already_exists'] = 'This field already exists.';
	$lang['PCP_err_field_name_not_valid'] = 'The field name is not a valid one.';
	$lang['PCP_err_field_lang_key_missing'] = 'Lang key is missing.';
	$lang['PCP_err_field_class_unknown'] = 'Unknown class.';
	$lang['PCP_err_field_type_unknown'] = 'Unknown type.';
	$lang['PCP_err_field_get_mode_unknown'] = 'Unknown get mode.';
	$lang['PCP_err_field_values_list_unknown'] = 'Unknown values list.';
	$lang['PCP_err_field_auth_unknown'] = 'Unknown auth level.';

	$lang['PCP_err_field_values_list_missing'] = 'A list of values has to be provided if you use a LIST_* get mode.';
	$lang['PCP_err_field_values_list_presents'] = 'You can\'t use a values list if you don\'t use a LIST_* get mode.';
	$lang['PCP_err_field_get_mode_presents'] = 'You can\'t set a get mode while using get and check functions.';
	$lang['PCP_err_field_dsp_func_not_valid'] = 'The display function has not a valid name.';
	$lang['PCP_err_field_dsp_func_unknown'] = 'The display function is unknown.';
	$lang['PCP_err_field_get_func_not_valid'] = 'The get function has not a valid name.';
	$lang['PCP_err_field_chk_func_not_valid'] = 'The check function has not a valid name.';
	$lang['PCP_err_field_get_chk_func_missing'] = 'You have to provide both check and get functions.';

	$lang['PCP_err_sql_delete_not_allow'] = 'You can\'t remove this field from the users table.';
	$lang['PCP_err_sql_edit_not_allow'] = 'You can\'t create or modify this field in the users table.';
	$lang['PCP_err_sql_decimal_not_allow'] = 'You can\'t set decimals without using a decimal type.';
	$lang['PCP_err_sql_decimal_too_high'] = 'Number of decimal can\'t be greater or equal to field length.';
	$lang['PCP_err_sql_length_missing'] = 'The field length is missing.';
	$lang['PCP_err_sql_unsigned_not_allow'] = 'Unsigned is only allowed with numeric types.';
	$lang['PCP_err_sql_default_null_not_allow'] = 'Default value can\'t be null if the field doesn\'t accept null values.';
	$lang['PCP_err_sql_failed'] = 'This SQL request failed :';

	$lang['PCP_err_tableslinked_already_exists'] = 'The table linked name already exists.';
	$lang['PCP_err_tableslinked_name_not_valid'] = 'The table linked name is not a valid one.';
	$lang['PCP_err_tableslinked_sql_id_not_valid'] = 'The table linked id is not a valid one.';
	$lang['PCP_err_tableslinked_sql_join_missing'] = 'The table linked join is empty.';

	$lang['PCP_err_valueslist_already_exists'] = 'The values list name already exists.';
	$lang['PCP_err_valueslist_name_not_valid'] = 'The values list name is not a valid one.';
	$lang['PCP_err_valueslist_func_not_valid'] = 'The values list function name is not a valid one.';
	$lang['PCP_err_valueslist_no_data'] = 'Nothing in the values list.';

	$lang['PCP_err_classesfields_already_exists'] = 'The classes name already exists.';
	$lang['PCP_err_classesfields_name_not_valid'] = 'The classes name is not valid one.';
	$lang['PCP_err_classesfields_config_field_not_valid'] = 'The config field is not a valide one.';
	$lang['PCP_err_classesfields_admin_not_valid'] = 'The admin field is not a valid one.';
	$lang['PCP_err_classesfields_user_not_valid'] = 'The user field is not a valid one.';

	$lang['PCP_err_usermaps_already_exists'] = 'The map already exists.';
	$lang['PCP_err_usermaps_name_not_valid'] = 'The map name is not a valid one.';
	$lang['PCP_err_usermaps_not_empty'] = 'There are some maps still attached to the one you want to delete. Please attached them elsewhere first.';
	$lang['PCP_err_usermaps_field_already_in_map'] = 'This field is already existing in the map.';

	// global message, return path
	$lang['PCP_field_created'] = 'The field definition has been created.<br /><br />%sClick %sHere%s to return to the fields list.';
	$lang['PCP_field_modified'] = 'The field definition has been modified.<br /><br />%sClick %sHere%s to return to the fields list.';
	$lang['PCP_field_delete'] = 'Are you sure you want to delete <b>%s</b> definition ?';
	$lang['PCP_field_deleted'] = 'The field definition has been deleted.<br /><br />Click %sHere%s to return to the field list.';

	$lang['PCP_sql_field_created'] = 'The field has been succesfully created in the users table.<br /><br />Click %sHere%s to return to the fields list.';
	$lang['PCP_sql_field_modified'] = 'The field has been succesfully updated in the users table.<br /><br />Click %sHere%s to return to the fields list.';
	$lang['PCP_sql_field_deleted'] = 'The field has been succesfully deleted from the users table.<br /><br />Click %sHere%s to return to the fields list.';
	$lang['PCP_sql_field_deleted_short'] = 'The field has been succesfully deleted from the users table.';

	$lang['PCP_tableslinked_created'] = 'The table linked definition has been created.<br /><br />Click %sHere%s to return to the tables linked list.';
	$lang['PCP_tableslinked_modified'] = 'The table linked definition has been modified.<br /><br />Click %sHere%s to return to the tables linked list.';
	$lang['PCP_tableslinked_deleted'] = 'The table linked definition has been deleted.<br /><br />Click %sHere%s to return to the tables linked list.';

	$lang['PCP_valueslist_created'] = 'The values list definition has been created.<br /><br />Click %sHere%s to return to the values list.';
	$lang['PCP_valueslist_modified'] = 'The values list definition has been modified.<br /><br />Click %sHere%s to return to the values list.';
	$lang['PCP_valueslist_deleted'] = 'The values list definition has been deleted.<br /><br />Click %sHere%s to return to the values list.';

	$lang['PCP_classesfields_created'] = 'The class definition has been created.<br /><br />Click %sHere%s to return to the classes list.';
	$lang['PCP_classesfields_modified'] = 'The class definition has been modified.<br /><br />Click %sHere%s to return to the classes list.';
	$lang['PCP_classesfields_deleted'] = 'The class definition has been deleted.<br /><br />Click %sHere%s to return to the classes list.';

	$lang['PCP_usermaps_created'] = 'The map definition has been created.<br /><br />Click %sHere%s to return to the maps list.';
	$lang['PCP_usermaps_modified'] = 'The map definition has been modified.<br /><br />Click %sHere%s to return to the maps list.';
	$lang['PCP_usermaps_deleted'] = 'The map definition has been deleted.<br /><br />Click %sHere%s to return to the maps list.';

	// generic
	$lang['PCP_config_values'] = 'Config values';
	$lang['PCP_view_user_values'] = 'User viewed fields';
	$lang['PCP_user_values'] = 'User acting fields';

	$lang['Refresh'] = 'Refresh';
	$lang['Create'] = 'Create';
	$lang['Suggest'] = 'Suggest';
	$lang['More'] = 'More...';

	$lang['Auth_GUEST'] = 'Everybody';
	$lang['Auth_USER'] = 'Registered user';
	$lang['Auth_ADMIN'] = 'Users Administrator';
	$lang['Auth_BOARD_ADMIN'] = 'Board administrator';

	$lang['Up'] = '^';
	$lang['Down'] = 'v';

	$lang['Linefeed'] = '---';

	// PCP Extra :: Added :: Start
	$lang['PCP_field_required'] = 'Required field';
	$lang['PCP_field_required_explain'] = 'Set this to yes will force the user to submit a value for the field.';
	$lang['Auth_GUEST_ONLY'] = 'Guest Only';
	$lang['PCP_field_visibility'] = 'Show Visibility';
	$lang['PCP_field_visibility_explain'] = 'Show to the user, who will see the data being entered.';
	$lang['PCP_field_inputstyle'] = 'Input Template style';
	$lang['PCP_field_inputstyle_explain'] = 'In board_config_body.tpl we will execute the template html between &lt;!-- BEGIN inputstyle --&gt; and &lt;!-- END inputstyle --&gt; where inputstyle is the name entered here. Leave blank for default which is "field".';
	// PCP Extra :: Added :: End
}

?>
