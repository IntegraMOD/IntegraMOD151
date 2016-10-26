<?php
/***************************************************************************
 *						lang_extend_pcp_wiz.php [English]
 *						---------------------------------------
 *	begin				: 21/03/2005 (dd/mm/yyyy)
 *	copyright		: Ptirhiik / ednique
 *	email				: ptirhiik@clanmckeen.com / edwin@ednique.com
 *
 *	version			: 0.0.1 - 21/03/2005
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
	// addded by edwin :: PCP Wiz
	$lang['PCP_10_wizard'] = 'PCP Wizard';
	$lang['PCP_10_wizard_explain'] = 'We tried to make the PCP management a bit easier. I Hope you like it.';
	$lang['Wiz_mode_error'] = 'the mode <span class="explaintitle">%s</span> is not supported.';
	$lang['Wiz_buddylist'] = 'Quick Buddy List';
	$lang['Wiz_buddylist_description'] = 'Here you can alter the order, defaults and forced fields of the buddy/ignore/memberlist page.';
	$lang['Wiz_buddylist_explain'] = '<span class="explaintitle">Field name</span>: Click on the name to alter the basic field info.<br><span class="explaintitle">Order</span>: this is the order the fields appears in the list. Alter the numbers to move the fields.<br><span class="explaintitle">Default</span>: When the user never selected any fields to display, this field will be shown as default.<br><span class="explaintitle">Forced</span>: Force this field to always display in the list.<br><span class="explaintitle">Selectable</span>: This field can be selected by the users.<br><span class="explaintitle">Hidden</span>: this field is always send as hidden. Leave these fields alone if you want the buddy/ignore part to work.<br><span class="explaintitle">Submit</span>: Clicking this button will save your changes and a message will be shown stating if the changes were successfull or not. The order numbers will be altered automatically in case they are not submitted correctly.<br>';
	$lang['Default'] = 'Default';
	$lang['Forced'] = 'Forced';
	$lang['Selectable'] = 'Selectable';
	$lang['Update_success'] = 'Successfully updated the PCP files.';
	$lang['Wiz_addremovefields'] = 'Add / Remove Page Fields';
	$lang['Wiz_addremovefields_description'] = 'Here you can add or remove fields from a page and also change the field\'s order.';
	$lang['Wiz_addremovefields_explain'] = '<span class="explaintitle">Select a Page</span>: Select the page you want to edit from the dropdown box and click the select button. A message will appear showing what page you have selected. In case you messed up the fields badly you can simply hit select again to reload the initial values as long as you didn\'t hit submit.<br><span class="explaintitle">Alter Page Display</span>: Only visible if applicable. Select a page and then hit this button to alter the way the fields are displayed on that page.<br><span class="explaintitle">Alter Form Display</span>: Only visible if applicable. Select a page and then hit this button to alter the way the input fields are displayed on that form.<br><span class="explaintitle">Available fields</span>: Here you see a multi-select box containing all available fields not placed on the selected page. You can select 1 or more fields to move them to the selected page by using the "SHIFT + Click", the "CTRL + Click" or by the "Click + Drag" combination.<br><span class="explaintitle">Actions</span>: Click "->" to add fields to the page after selecting them in the Available Fields box first. Click "<-" to remove fields from the page after selecting them in the Selected Fields box first.<br><span class="explaintitle">Selected Fields</span>: Here you see a multi-select box containing all fields  placed on the selected page. You can select 1 or more fields to remove them from the selected page by using the "SHIFT + Click", the "CTRL + Click" or by the "Click + Drag" combination.<br><span class="explaintitle">Move Up/Down</span>: When you select one or more fields in the selected fields box you can use these buttons to move them up or down in the box. The fields will be displayed on the selected page in the same order.<br><span class="explaintitle">Submit</span>: Clicking this button will save your changes and relocate you to another page where you can specify the way the fields are displayed on the selected page.<br><span class="explaintitle">??</span>: When you select one field in the listbox and then hit this button, a new window will popup with more information about that field. You\'ll see it\'s description, on what page it is used and if possible, an example of how it looks on these pages.<br>';
	$lang['Map_selected'] = 'You selected the page <strong>%s</strong>';
	$lang['Move_up'] = 'Move Up';
	$lang['Move_down'] = 'Move Down';
	$lang['Wiz_showfieldinfo'] = 'Field Info';
	$lang['Wiz_showfieldinfo_description'] = 'Here you see the details of the selected field.';
	$lang['Wiz_showfieldinfo_explain'] = '<span class="explaintitle">Pages</span>: Click on the page link to alter the display of your field on that page.<br><span class="explaintitle">Field Name</span>: Click on the name to alter the basic field info.<br>';
	$lang['Pages'] = 'Pages';
	$lang['Select_page'] = 'Select a Page:';
	$lang['Select'] = 'Select';
	$lang['Available_fields'] = 'Available Fields';
	$lang['Action'] = 'Action';
	$lang['Selected_fields'] = 'Selected Fields';
	$lang['Default_Output'] = 'Default Display';
	$lang['Always_display'] = 'Display Always';
	$lang['Wiz_outputlist'] = 'Alter Page Display';
	$lang['Wiz_outputlist_description'] = 'Here you can alter the way the fields on a page are displayed.';
	$lang['Wiz_outputlist_explain'] = '<span class="explaintitle">Select a Page</span>: Select the page you want to edit from the dropdown box and click the select button. A message will appear showing what page you have selected. In case you messed up the fields badly you can simply hit select again to reload the initial values as long as you didn\'t hit submit.<br><span class="explaintitle">Add / Remove Page Fields</span>: Select a page and then hit this button to add fields to or remove fields from that page.<br><span class="explaintitle">Field</span>: Fieldname and description if available. Click on the name to alter the basic field info.<br><span class="explaintitle">Options</span>: Here you can select the options for each field.<br><span class="explaintitle">Leg</span>: Check this box to display the legend of the field. The legend is the desciption shown on the left under the fieldname.<br><span class="explaintitle">Txt</span>: Check this box to display the value as plain text.<br><span class="explaintitle">Img</span>: Check this box to display the value as an image.<br><span class="explaintitle">Line</span>: Check this box when you checked both Txt and Img and the text will appear under the image instead of next to the image.<br><span class="explaintitle">HTML Style</span>: Here you can add some HTML code to alter the display. Leave blank if not needed. You should place <em>%s</em> inside your HTML where the value of the field will be placed. Only use one <em>%s</em> and do not use <em>%</em> inside your HTML.<br><span class="explaintitle">Display Function</span>: Here you can select any available custom function for managing the display. If you don\'t need one, you should select <em>Default Display</em>. When creating your custom display function, the function name should start with <em>pcp_output_</em> and upload the function before comming to this page.<br><span class="explaintitle">Display When</span>: This option will manage to whom the field is shown. When a user has selected <em>Yes</em> or <em>Friends Only</em> in their profile for the selected question, other people will be able to see the value of this field. Choose <em>Display Always</em> to always show the field. ex: Choose <em>Always show my email address</em> for the output of an email address.<br><span class="explaintitle">Example</span>: If possible, you will see an example based on some dummy data, so don\'t be fooled if the value shown is not your value.<br><span class="explaintitle">Submit</span>: Clicking this button will save your changes and a message will be shown stating if the changes were successfull or not.<br>';
	$lang['Display_when'] = 'Display When';
	$lang['Nextline'] = 'Line';
	$lang['Html_style'] = 'HTML Style';
	$lang['Extra'] = 'Extra';
	$lang['Example'] = 'Example';
	$lang['Confirm_message'] = "Are you sure you want to ignore your changes?\\n\\nOK = Yes, Ignore my changes.\\n\\nCancel = No, let me hit Submit first.";
	$lang['Wiz_inputlist'] = 'Alter Form Display';
	$lang['Wiz_inputlist_description'] = 'Here you can alter the way the input fields on the form are displayed.';
	$lang['Wiz_inputlist_explain'] = '<span class="explaintitle">Select a Page</span>: Select the page you want to edit from the dropdown box and click the select button. A message will appear showing what page you have selected. In case you messed up the fields badly you can simply hit select again to reload the initial values as long as you didn\'t hit submit.<br><span class="explaintitle">Add / Remove Page Fields</span>: Select a page and then hit this button to add fields to or remove fields from that page.<br><span class="explaintitle">Field</span>: Fieldname and description if available. Click on the name to alter the basic field info.<br><span class="explaintitle">Auth level</span>: The minimum level of authentication that your user needs in order to see the input field. <em>Guest only</em> will show the field to only guests and is used on the register page for the control picture. <br><span class="explaintitle">Options</span>: Here you can select the options for each field.<br><span class="explaintitle">Required Field</span>: Check this box to to make the field required. The field will be marked as required and existing users that didn\'t complete this field will not be able to browse the forums unless they complete that field.<br><span class="explaintitle">Show Visibility</span>: Check this box to display the visibility of the input field. This will tell the user who can see the data they are about to submit. for example: <em>(visible by friends only)</em><br><span class="explaintitle">TPL Style</span>: Add a value here to give your input field an other design like for ex. the rules field. The name entered should be used in board_config_body.tpl using the <em>&lt;!-- BEGIN inputstyle --&gt;</em> and <em>&lt;!-- END inputstyle --&gt;</em> and the HTML in between will be executed for this field. Leave blank for default which is <em>field</em>.<br><span class="explaintitle">Type</span>: Choose one of these types for your field.<br><span class="explaintitle">Text Box</span>: This will show a text box or text area for your field.<br><span class="explaintitle">Drop Down</span>: This will show a drop down list box for your field. You also need to specify the <em>values list</em><br><span class="explaintitle">Radio Buttons</span>: This will show a radio button for each possible value of your field. You also need to specify the <em>values list</em><br><span class="explaintitle">Use Functions</span>: You will need to specify a get function and a chk function to display and validate this field.<br><span class="explaintitle">Extra</span>: Depending on the type chosen, you will see some more options.<br><span class="explaintitle">Values list</span>: Select the list of values to use.<br><span class="explaintitle">Get function</span>: Select the function for displaying the field. Create a function and name it like <em>mods_get_YOURNAME</em> or <em>mods_settings_get_YOURNAME</em> before comming to this page.<br><span class="explaintitle">Check  function</span>: Select the function for validating the field. Create a function and name it like <em>mods_check_YOURNAME</em> or <em>mods_settings_check_YOURNAME</em> before comming to this page.<br><span class="explaintitle">Example</span>: You will see an example based on some dummy data, so don\'t be fooled if the value shown is not your value.<br><span class="explaintitle">Submit</span>: Clicking this button will save your changes and a message will be shown stating if the changes were successfull or not.<br>';
	$lang['Tpl_style'] = 'TPL Style';
	$lang['Textmode'] = 'Text Box';
	$lang['Dropmode'] = 'Drop Down';
	$lang['Radiomode'] = 'Radio Buttons';
	$lang['Functmode'] = 'Use Functions';
	$lang['File_permissions'] = 'The File %s does not have the correct CHMOD settings <strong>(666)</strong>.';
	$lang['Wiz_validate'] = 'Validate PCP Files';
	$lang['Wiz_validate_description'] = 'This will do a validation of your current PCP Files and alert on any anomalies.';
	$lang['Missing_param'] = 'Missing';
	$lang['Move2map'] = 'Move 2 Maps';
	$lang['Move2field'] = 'Move 2 Fields';
	$lang['Maptitle_missing'] = 'Please add a title for the map.';
	$lang['Wiz_fields'] = 'Manage Fields';
	$lang['Wiz_fields_description'] = 'Here you can alter the basic field info and create new fields from the database.';
	$lang['Wiz_fields_explain'] = '<span class="explaintitle">Select a Field</span>: Select the field you want to edit from the dropdown box and click the select button. A message will appear showing what field you have selected. In case you messed up the fields badly you can simply hit select again to reload the initial values as long as you didn\'t hit submit.<br><span class="explaintitle">Field Info</span>: Select a field and then hit this button to view the field info and where it is used.<br><span class="explaintitle">Select New Field</span>: All fields from the user table that aren\'t used in the PCP are listed in the dropdown box. Select the field you want to add and click the select button.<br><span class="explaintitle">Legend of the field</span>: Enter a language key to be used as legend of the field.<br><span class="explaintitle">Display When</span>: This option will manage to whom the field is shown. When a user has selected <em>Yes</em> or <em>Friends Only</em> in their profile for the selected question, other people will be able to see the value of this field. Choose <em>Display Always</em> to always show the field. ex: Choose <em>Always show my email address</em> for the output of an email address.<br><span class="explaintitle">Type</span>: Choose one of these types for your field. This is the type of data your field holds. Next to the drop down list, you will see the type that is defined in the database. The database type is not shown for system fields.<br><span class="explaintitle">Auth level</span>: The minimum level of authentication that your user needs in order to see the input field. <em>Guest only</em> will show the field to only guests and is used on the register page for the control picture.<br><span class="explaintitle">Explanation of the field</span>: Used for input forms. You can add extra text underneath the legend of the field to give the users some explanation of what they need to enter.<br><span class="explaintitle">Image</span>: enter an image key from the <em>fisubice.cfg</em> file. When selecting <em>Img</em> as option in the <em>Alter Page Display</em> for this field, this image will be shown if <em>Default Display</em> is selected as <em>display function</em>.<br><span class="explaintitle">Image title</span>: The mouse over text for the above image.<br><span class="explaintitle">Submit</span>: Clicking this button will save your changes and a message will be shown stating if the changes were successfull or not.<br>';
	$lang['Select_field'] = 'Select a Field:';
	$lang['Field_selected'] = 'You selected the field <strong>%s</strong>';
	$lang['Select_new_field'] = 'Select New Field:';
	$lang['Newfield_selected'] = 'You selected the NEW field <strong>%s</strong>';
	$lang['Required_Error'] = 'The fields marked with%s are required. Please go back and complete the form.';
	$lang['Wiz_autocorrect'] = '<a href="%s">Click here to automatically correct your PCP Files.</a><br>A backupfile will be created in the /profilcp/def/ directory if your security settings allow this.';
	$lang['Not_in_fields'] = 'This field %s is not defined in def_userfields...';
	$lang['Wiz_fieldimport'] = 'Import Fields';
	$lang['Wiz_fieldimport_description'] = 'Here you can import field definitions that are needed for implementing mods.';
	$lang['Wiz_import_explain'] = 'Sometimes you will need to alter the PCP files when adding new mods.<br>This interface will allow you to do this, so you should ask the mod author to supply the info as requested below. Just supply him/her the info below and he/she will be able to easily supply you the needed info.<br>It\'s a good practice to run the <strong>validate</strong> function after updating your PCP files and if needed use the autocorrect feature.<br>In case you updated any fields or pages concerning the <strong>Buddy/Ignore/Memnerlist</strong>, you should go to the <strong>Quick Buddy List</strong> and submit that page (no need to change anything).<br>A <strong>backupfile</strong> will be created in the /profilcp/def/ directory if your security settings allow this. To be sure, you should always manually backup this directory.';
	$lang['Type'] = 'Type';
	$lang['Definition'] = 'Definition';
	$lang['Type_lists_title'] = 'List of Values';
	$lang['Type_lists_explain'] = 'You need to create the same code as you would put inside the <strong>values_list</strong> array but instead of using the name values_list, use <strong>new_lists</strong>. A <strong>$ is not allowed</strong> inside the code and will be stripped out. When you submit a list that already exists, that list will be updated with the newly submitted values. Example:<pre>
new_lists = array(
		\'list_im_versions\' => array(
				\'values\' => array(
					0 => array(\'txt\' => \'1.2.x\', \'img\' => \'\'),
					1 => array(\'txt\' => \'1.3.1\', \'img\' => \'\'),
					2 => array(\'txt\' => \'1.3.2\', \'img\' => \'\'),
					3 => array(\'txt\' => \'1.3.2c\', \'img\' => \'\'),
					4 => array(\'txt\' => \'1.3.2d\', \'img\' => \'\'),
					5 => array(\'txt\' => \'1.3.2e\', \'img\' => \'\'),
					6 => array(\'txt\' => \'1.4.0\', \'img\' => \'\'),
				),
			),
		);</pre>';
	$lang['Type_classes_title'] = 'Classes<BR /> for <em>Display When</em>';
	$lang['Type_classes_explain'] = 'You need to create the same code as you would put inside the <strong>classes_fields</strong> array but instead of using the name classes_fields, use <strong>new_classes</strong>. A <strong>$ is not allowed</strong> inside the code and will be stripped out. When you submit a class that already exists, that class will be updated with the newly submitted data. Example:
<pre>
new_classes = array(
		\'imversion\' => array(
				\'config_field\'	=> \'user_viewimversion\',
				\'admin_field\'	=> \'\',
				\'user_field\'	=> \'user_viewimversion\',
				\'sql_def\'		=> \'
				[USERS].user_id = [view.user_id] OR ( ( [BUDDY_MY].buddy_ignore <> 1 OR
			 	[BUDDY_MY].buddy_ignore IS NULL ) AND ( [board.user_viewimversion] <> 0 OR 
			 	[board.user_viewimversion_over] <> 1 ) AND ( [BUDDY_OF].buddy_visible = 1 OR ( 
			 	[USERS].user_viewimversion = 1 OR ([board.user_viewimversion] = 1 AND 
			 	[board.user_viewimversion_over] = 1) ) OR ( [BUDDY_OF].buddy_ignore = 0 AND ( 
			 	[USERS].user_viewimversion = 2 OR ([board.user_viewimversion] = 2 AND 
			 	[board.user_viewimversion_over] = 1) ) ) ) )\',
			),
		);
</pre>';
	$lang['Type_fields_title'] = 'Fields';
	$lang['Type_fields_explain'] = 'You need to create the same code as you would put inside the <strong>user_fields</strong> array but instead of using the name user_fields, use <strong>new_fields</strong>. A <strong>$ is not allowed</strong> inside the code and will be stripped out. When you submit a field that already exists, that field will be updated with the newly submitted data. Example:
<pre>
new_fields = array(
		\'user_viewimversion\' => array(
				\'lang_key\'     => \'Public_view_imversion\',
				\'class\'        => \'generic\',
				\'type\'         => \'TINYINT\',
				\'get_mode\'     => \'LIST_RADIO\',
				\'values\'       => \'list_yes_no_friend\',				
		),
		\'user_imversion\' => array(
				\'lang_key\'     => \'Im_version\',
				\'class\'        => \'imversion\',
				\'type\'         => \'VARCHAR\',
				\'dsp_func\'     => \'pcp_output_imversion\',
		),
);
</pre>';
	$lang['Type_deletes_title'] = 'Remove Lists, Classes and Fields';
	$lang['Type_deletes_explain'] = 'You need to create an array named <strong>deletes</strong> as shown in the example. A <strong>$ is not allowed</strong> inside the code and will be stripped out. Example:
<pre>
deletes = array(
	\'lists\' => array(
		\'list_im_versions\',
	),
	\'classes\' => array(
		\'imversion\',
	),
	\'fields\' => array(
		\'user_viewimversion\',
		\'user_imversion\', 
	),
);
</pre>';
	$lang['Wiz_pageimport'] = 'Import Pages';
	$lang['Wiz_pageimport_description'] = 'Here you can import page definitions that are needed for implementing mods.';
	$lang['Type_newpages_title'] = 'New / Update Pages';
	$lang['Type_newpages_explain'] = 'You need to create the same code as you would put inside the <strong>user_maps</strong> array but instead of using the name user_maps, use <strong>new_pages</strong>. A <strong>$ is not allowed</strong> inside the code and will be stripped out. When you submit a page that already exists, that page will be updated with the newly submitted data. Example:
<pre>
new_pages = array(	
	\'DEMO\' => array(
		\'title\'		=> \'Demo\',
	),
	\'DEMO.info\' => array(
		\'title\'		=> \'Demo_Info\',
		\'fields\'	=> array(
			\'user_photo\' => array(
				\'txt\'          => true,
				\'img\'          => true,
				\'crlf\'         => true,
				\'style\'        => \'<div class="gensmall">%s</div>\',
			),
		),
	),
);
</pre>
';
	$lang['Type_delpages_title'] = 'Remove Pages';
	$lang['Type_delpages_explain'] = 'You need to create an array of pages to be deleted, use <strong>del_pages</strong> as array name. A <strong>$ is not allowed</strong> inside the code and will be stripped out. Example:
<pre>
del_pages = array(	
	\'DEMO\',
);
</pre>';
	$lang['Type_newpagefields_title'] = 'New / Update Page Fields';
	$lang['Type_newpagefields_explain'] = 'You need to create the same code as you would put inside the <strong>user_maps</strong> array but instead of using the name user_maps, use <strong>new_pagefields</strong> and you need to add a new key called <strong>position</strong> for each page. Choose <strong>begin, end or a fieldname</strong> already on the page. The position will define where the new fields will come inside the page. A <strong>$ is not allowed</strong> inside the code and will be stripped out. When you submit a field that already exists, that field will be updated with the newly submitted data. Example:
<pre>
new_pagefields = array(	
	\'DEMO.info\'  => array(
		\'position\' => \'user_photo\', // choose begin, end or a fieldname
		\'fields\'	 => array(
			\'user_avatar\' => array(
				\'img\'          => true,
			),
			\'user_warning\' => array(
				\'img\'          => true,
			),
		),
	),
);</pre>';
	$lang['Type_delpagefields_title'] = 'Delete Page Fields';
	$lang['Type_delpagefields_explain'] = 'You need to create the same code as you would put inside the <strong>user_maps</strong> array but instead of using the name user_maps, use <strong>del_pagefields</strong>. A <strong>$ is not allowed</strong> inside the code and will be stripped out. Example:
<pre>
del_pagefields = array(	
	\'DEMO.info\'  => array(
		\'fields\'	 => array(
			\'user_avatar\' => array(
			),
		),
	),
);</pre>';
	$lang['Wiz_import_error'] = 'Error trying to import <strong>%s</strong>';
}

?>