<?php

/***************************************************************************
 *                            admin_qbar.php
 *                            --------------
 *	begin			: 22/07/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.0.5 - 29/10/2003
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

define('IN_PHPBB', true);
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignorepvar = array('url', 'icon', 'name', 'explain', 'shortcut', 'alternate');

if(!empty($setmodules)) {
    $file = basename(__FILE__);
    $module['General']['Qbar_admin'] = $file;
    return;
}

//
// Load default header
//
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'includes/functions_admin_qbar.' . $phpEx);
include($phpbb_root_path . 'includes/functions_qbar.' . $phpEx);
//
// constant
//
$classes = array(
    'System'	=> 'Qbar_class_system',
    'Bar'		=> 'Qbar_class_bar',
    'Menu'		=> 'Qbar_class_menu',
    'QRMenu'	=> 'Qbar_class_qrmenu',
    'Nav'		=> 'Qbar_class_nav',
    'Nav2'		=> 'Qbar_class_nav2',
    'List'		=> 'Qbar_class_list',
);

// selecting fields for import or main display
function select_field($import = false)
{
    global $lang, $phpEx, $template, $db, $board_config, $phpbb_root_path;
    global $qbar_maps;
    global $open_ids, $field_ids;
    global $mode, $s_hidden_fields, $panel_id, $field_id;

    // verify if default_tree qbar is present in order to get the increment to display
    $max_level = 0;
    $i = 0;
    $is_default = false;
		foreach ($qbar_maps as $qbar_name => $qbar)
		{
        $i++;
        if (($panel_id != 0) || isset($open_ids[$i])) {
            if ((($panel_id == 0) || ($panel_id == $i)) && ($qbar_name == 'default_tree')) {
                $is_default = true;
                @reset($qbar['fields']);
                while (list($field_name, $field) = @each($qbar['fields'])) {
                    if ($field['level'] > $max_level) {
                        $max_level = $field['level'];
                    }
                }
            }
        }
    }
    if (!$is_default) {
        $max_level = 0;
    }

    // display the qbars
    $template->set_filenames(
        array(
        'body' => 'admin/qbar_admin_body.tpl')
    );

    // Header
    $template->assign_vars(
        array(
        'L_TITLE'				=> (!$import) ? $lang['Qbar_admin'] : $lang['Qbar_admin_import'],
        'L_TITLE_EXPLAIN'		=> (!$import) ? $lang['Qbar_admin_explain'] : $lang['Qbar_admin_import_explain'],
        'L_SETTINGS'			=> $lang['Qbar_settings'],
        'L_CLASS'				=> $lang['Qbar_class'],
        'L_DISPLAY'				=> $lang['Qbar_display'],
        'L_CELLS'				=> $lang['Qbar_cells'],
        'L_IN_TABLE'			=> $lang['Qbar_in_table'],
        'L_AUTH_LOGGED'			=> $lang['Qbar_auth_logged'],
        'L_AUTH_ADMIN'			=> $lang['Qbar_auth_admin'],
        'L_AUTH_PM'				=> $lang['Qbar_auth_pm'],

        'L_ACTION'				=> $lang['Action'],
        'L_MOVEUP'				=> $lang['Move_up'],
        'L_MOVEDW'				=> $lang['Move_down'],
        'L_IMPORT_FIELD'		=> $lang['Import'],
        'L_CREATE_FIELD'		=> $lang['Create_field'],
        'L_CREATE_PANEL'		=> $lang['Create_panel'],

        'L_SHORTCUT'			=> $lang['Qbar_shortcut'],
        'L_EXPLAIN'				=> $lang['Qbar_explain'],
        'L_ALTERNATE'			=> $lang['Qbar_alternate'],
        'L_ICON'				=> $lang['Qbar_icon'],
        'L_USE_VALUE'			=> $lang['Qbar_use_value'],
        'L_USE_ICON'			=> $lang['Qbar_use_icon'],
        'L_INTERNAL'			=> $lang['Qbar_internal'],
        'L_WINDOW'				=> $lang['Qbar_window'],
        'L_TREE'				=> $lang['Qbar_tree_id'],

        'L_SUBMIT'				=> $lang['Submit'],
        'L_EDIT'				=> $lang['Edit'],
        'L_DELETE'				=> $lang['Delete'],
        'L_SELECT'				=> $lang['Select'],
        'L_CANCEL'				=> $lang['Cancel'],

        'HEAD_SPAN'				=> $max_level + 3,
        'MIDDLE_SPAN'			=> $max_level + 6,
        'BOTTOM_SPAN'			=> $max_level + 7,
        )
    );

    // import
    if ($import) {
        $template->assign_block_vars('switch_import', array());
    } else {
        $template->assign_block_vars('switch_import_no', array());
    }

    // values
    $i = 0;
		foreach ($qbar_maps as $qbar_name => $qbar)
		{
        $i++;
        if (empty($panel_id) || ($panel_id == $i)) {
            if ($import) {
                $name = '<input type="submit" name="goto[' . $i . ']" class="liteoption" value="' . $qbar_name . '" />';
            } else {
                $name = '<a href="' . append_sid("admin_qbar.$phpEx?panel=$i") . '" class="gen">' . $qbar_name . '</a>';
            }

            $template->assign_block_vars(
                'qbar',
                array(
                'PANEL_ID'		=> $i,
                'NAME'			=> $name,
                'CLASS'			=> $qbar['class'],
                'DISPLAY'		=> qbar_get_bool($qbar['display']),
                'CELLS'			=> $qbar['cells'],
                'IN_TABLE'		=> qbar_get_bool($qbar['in_table']),
                'STYLE'			=> qbar_get_style($qbar['style']),
                'SUB_TEMPLATE'	=> qbar_get_sub_template($qbar['style'], $qbar['sub_template']),

                'U_EDIT'		=> append_sid("admin_qbar.$phpEx?panel=$i&mode=edit"),
                'U_DELETE'		=> append_sid("admin_qbar.$phpEx?panel=$i&mode=delete"),
                'U_MOVEUP'		=> append_sid("admin_qbar.$phpEx?panel=$i&mode=up"),
                'U_MOVEDW'		=> append_sid("admin_qbar.$phpEx?panel=$i&mode=dw"),

                'SPAN'			=> $max_level + 3,
                'OPENED'		=> isset($open_ids[$i]) ? ' checked="checked"' : '',
                )
            );

            // system
            $system = ($qbar['class'] == 'System');

            // import
            if ($import) {
                $template->assign_block_vars('qbar.switch_import', array());
            } else {
                $template->assign_block_vars('qbar.switch_import_no', array());
                if (!$system) {
                    $template->assign_block_vars('qbar.switch_import_no.switch_system_no', array());
                }
            }

            if (empty($panel_id) && !$import) {
                $template->assign_block_vars('qbar.switch_hide_fields', array());
            }
            if (!empty($panel_id) || isset($open_ids[$i])) {
                $template->assign_block_vars('qbar.switch_show_fields', array());

                // import
                if ($import) {
                    $template->assign_block_vars('qbar.switch_show_fields.switch_import', array());
                } else {
                    $template->assign_block_vars('qbar.switch_show_fields.switch_import_no', array());
                    if (!$system) {
                        $template->assign_block_vars('qbar.switch_show_fields.switch_import_no.switch_system_no', array());
                    }
                }
            }

            // get the fields
            if (!empty($panel_id) || isset($open_ids[$i])) {
                @reset($qbar['fields']);
                $j = 0;
                $color = false;
                while (list($field_name, $field) = @each($qbar['fields'])) {
                    $cur_level = ($is_default) ? $field['level'] : $max_level;
                    $j++;
                    $color = !$color;
                    if ($qbar_name == 'default_tree') {
                        $color = !($field['level'] % 2);
                    }

                    // already selected field
                    $id_combined = $i . 'x' . $j;
                    $field_checked = in_array($id_combined, $field_ids) ? 'checked="checked"' : '';

                    $template->assign_block_vars(
                        'qbar.field',
                        array(
                        'ROW_CLASS'			=> $color ? 'row1' : 'row2',
                        'FIELD_ID'			=> $id_combined,
                        'FIELD_CHECKED'		=> $field_checked,
                        'NAME'				=> $field_name,
                        'SHORTCUT'			=> qbar_get_value($field['shortcut']),
                        'EXPLAIN'			=> qbar_get_value($field['explain']),
                        'ALTERNATE'			=> qbar_get_value($field['alternate']),
                        'ICON'				=> qbar_get_icon(qbar_image($field['icon'], $qbar['style'], $qbar['sub_template'])),
                        'USE_VALUE'			=> qbar_get_bool($field['use_value']),
                        'USE_ICON'			=> qbar_get_bool($field['use_icon']),
                        'INTERNAL'			=> qbar_get_bool($field['internal']),
                        'WINDOW'			=> qbar_get_bool($field['window']),
                        'AUTH_LOGGED'		=> qbar_get_auth($field['auth_logged']),
                        'AUTH_ADMIN'		=> qbar_get_auth($field['auth_admin']),
                        'AUTH_PM'			=> qbar_get_auth($field['auth_pm'], true),
                        'TREE_ID'			=> $field['tree_id'],
                        'TREE_TITLE'		=> qbar_get_tree_title($field['tree_id']),
                        'PHP_FUNCTION'		=> $field['php_function'],

                        'U_NAME'			=> $field['internal'] ? append_sid('../' . $field['url']) : $field['url'],
                        'U_EDIT'			=> append_sid("admin_qbar.$phpEx?panel=$i&field=$j&mode=edit"),
                        'U_DELETE'			=> append_sid("admin_qbar.$phpEx?panel=$i&field=$j&mode=delete"),
                        'U_MOVEUP'			=> append_sid("admin_qbar.$phpEx?panel=$i&field=$j&mode=up"),
                        'U_MOVEDW'			=> append_sid("admin_qbar.$phpEx?panel=$i&field=$j&mode=dw"),

                        'SPAN'				=> $max_level - $cur_level + 1,
                        )
                    );

                    // import
                    if ($import) {
                        $template->assign_block_vars('qbar.field.switch_import', array());
                    } else {
                        $template->assign_block_vars('qbar.field.switch_import_no', array());
                        if (!$system) {
                            $template->assign_block_vars('qbar.field.switch_import_no.switch_system_no', array());
                        }
                    }

                    // display the minimum
                    if (!empty($field['alternate'])) {
                        $template->assign_block_vars('qbar.field.switch_alternate', array());
                    }
                    if (!empty($field['tree_id']) && ($qbar_name != 'default_tree')) {
                        $template->assign_block_vars('qbar.field.switch_tree', array());
                    }


                    $line = !empty($field['php_function']) || !empty($field['auth_logged']) || !empty($field['auth_admin']) || !empty($field['auth_pm']);
                    if ($line) {
                        $cell = 0;
                        $template->assign_block_vars('qbar.field.line', array());
                    }
                    if (!empty($field['php_function'])) {
                        $template->assign_block_vars('qbar.field.line.has_php_function', array(
                            'NAME' => $field['php_function']
                        ));
                        $template->assign_block_vars('qbar.field.line', array());
                    }
                    if (!empty($field['auth_logged'])) {
                        $cell++;
                        $template->assign_block_vars('qbar.field.line.switch_auth_logged', array());
                    }
                    if (!empty($field['auth_admin'])) {
                        $cell++;
                        $template->assign_block_vars('qbar.field.line.switch_auth_admin', array());
                    }
                    if (($cell == 2) && !empty($field['auth_pm'])) {
                        $cell = 0;
                        $template->assign_block_vars('qbar.field.line', array());
                    }
                    if (!empty($field['auth_pm'])) {
                        $cell++;
                        $template->assign_block_vars('qbar.field.line.switch_auth_pm', array());
                    }
                    if ($line && ($cell < 2)) {
                        $cell = 0;
                        $line = false;
                        $template->assign_block_vars('qbar.field.line.switch_filler', array());
                    }
                    if ($qbar_name == 'default_tree') {
                        $color_inc = false;
                        for ($k = 1; $k <= $field['level']; $k++) {
                            $color_inc = !$color_inc;
                            $template->assign_block_vars(
                                'qbar.field.inc',
                                array(
                                'ROW_CLASS'	=> $color_inc ? 'row1' : 'row2',
                                )
                            );
                        }
                    }
                } // end while fields
            } // end if selected panel or opened
        } // end if no selected panel or current is the selected panel
    } // end while panels

    // system
    $s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
    $s_hidden_fields .= '<input type="hidden" name="panel_id" value="' . $panel_id . '" />';
    if (!empty($field_id)) {
        $s_hidden_fields .= '<input type="hidden" name="field_id" value="' . $field_id . '" />';
    }
    if ($import) {
        $s_hidden_fields .= '<input type="hidden" name="import_field" value="1" />';
        for ($i = 0; $i < count($field_ids); $i++) {
            $ids = explode('x', $field_ids[$i]);
            if (($ids[0] != $panel_id) && !isset($open_ids[ intval($ids[0]) ])) {
                $s_hidden_fields .= '<input type="hidden" name="field_ids[]" value="' . $field_ids[$i] . '" />';
            }
        }
    }
    $template->assign_vars(
        array(
        'S_NAV_DESC'		=> qbar_get_nav_desc($import),
        'S_ACTION'			=> append_sid("admin_qbar.$phpEx"),
        'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
        )
    );

    // footer
    $template->pparse('body');
    include('./page_footer_admin.'.$phpEx);
}
//
// init
//
qbar_read();
$s_hidden_fields = '';
//
// Parameters
//
$mode = '';
if (isset($_POST['mode']) || isset($_GET['mode'])) {
    $mode = isset($_POST['mode']) ? $_POST['mode'] : $_GET['mode'];
}
if (!in_array($mode, array('up', 'dw', 'edit', 'delete'))) {
    $mode = '';
}

$sav_mode = '';
if (isset($_POST['sav_mode']) || isset($_GET['sav_mode'])) {
    $sav_mode = isset($_POST['sav_mode']) ? $_POST['sav_mode'] : $_GET['sav_mode'];
}
if (!in_array($sav_mode, array('', 'main'))) {
    $sav_mode = '';
}

// panel
$panel_id = 0;
if (isset($_POST['panel_id']) || isset($_GET['panel'])) {
    $panel_id = isset($_POST['panel_id']) ? intval($_POST['panel_id']) : intval($_GET['panel']);
}

// panel while importing
if (isset($_POST['goto'])) {
    $indexed = $_POST['goto'];
    list($id, $action) = each($indexed);
    $panel_id = intval($id);
}

// field_ids while importing
$field_ids = array();
if (isset($_POST['field_ids'])) {
    $field_ids = $_POST['field_ids'];
}

// add a new field button pushed
$create_field = false;
$field_name = '';
if (isset($_POST['create_field'])) {
    $create_field = true;
    $indexed = $_POST['create_field'];
    if (is_array($indexed)) {
        list($id, $action) = each($indexed);
        $panel_id = intval($id);
        $field_names = array();
        $field_names = $_POST['field_name'];
        $field_name = isset($field_names[$panel_id]) ? trim(stripslashes($field_names[$panel_id])) : '';
    }
    $mode = 'edit';
}

// import fields
$import = false;
if (isset($_POST['import_field'])) {
    $import = true;
    $indexed = $_POST['import_field'];
    if (is_array($indexed)) {
        list($id, $action) = each($indexed);
        $panel_id = intval($id);
        $sav_mode = 'main';
    }
    $mode = 'edit';
}
if (!empty($sav_mode)) {
    $create_field = true;
}

// add a new panel button pushed
$create_panel = false;
$panel_name = '';
if (isset($_POST['create_panel'])) {
    $create_panel = true;
    $panel_name = trim(stripslashes($_POST['field_name']));
    $mode = 'edit';
}

// field id
$field_id = 0;
if (isset($_POST['field_id']) || isset($_GET['field'])) {
    $field_id = isset($_POST['field_id']) ? intval($_POST['field_id']) : intval($_GET['field']);
}
if ($create_field) {
    $field_id = 0;
}

// other button
$submit = isset($_POST['submit']);
$cancel = isset($_POST['cancel']);
$refresh = isset($_POST['refresh']);
//
// get who is opened
//
$open_ids = array();
if ($panel_id == 0) {
    if (isset($_POST['open_ids'])) {
        $open_ids = $_POST['open_ids'];
    }
}

//
// move
//
if (($mode == 'up') || ($mode == 'dw')) {
    // apply restrictions to system qbars and get qbar name
    if (!empty($panel_id)) {
        if (empty($qbar_keys[$panel_id][0])) {
            message_die(GENERAL_MESSAGE, $lang['Qbar_error_panel_not_found']);
        }
        $qname = $qbar_keys[$panel_id][0];
        if ($qbar_maps[$qname]['class'] == 'System') {
            message_die(GENERAL_MESSAGE, (empty($field_id) ? $lang['Qbar_error_panel_system'] : $lang['Qbar_error_field_system']));
        }
        if (!empty($field_id)) {
            if (empty($qbar_keys[$panel_id][$field_id])) {
                message_die(GENERAL_MESSAGE, $lang['Qbar_error_field_not_found']);
            }
            $fname = $qbar_keys[$panel_id][$field_id];
        }
    }

    $inc = +15;
    if ($mode == 'up') {
        $inc = -15;
    }
    if (!empty($panel_id)) {
        // find the panel
        if (!empty($field_id)) {
            $qbar_maps[$qname]['fields'][$fname]['order'] = $qbar_maps[$qname]['fields'][$fname]['order'] + $inc;
            $field_id = 0;
        } else {
            $qbar_maps[$qname]['order'] = $qbar_maps[$qname]['order'] + $inc;
            $panel_id = 0;
        }

        // re-order
        qbar_sort();
        qbar_write();
        qbar_read();
    }

    // return to the list
    $mode = '';
}
//
// deleting
//
if ($mode == 'delete') {
    // get the panel name
    if (empty($panel_id)) {
        message_die(GENERAL_MESSAGE, $lang['Qbar_error_panel_empty_name']);
    }
    if (!isset($qbar_keys[$panel_id][0])) {
        message_die(GENERAL_MESSAGE, $lang['Qbar_error_panel_not_found']);
    }
    $qname = $qbar_keys[$panel_id][0];
    if (!empty($field_id)) {
        if (!isset($qbar_keys[$panel_id][$field_id])) {
            message_die(GENERAL_MESSAGE, $lang['Qbar_error_field_not_found']);
        }
        $fname = $qbar_keys[$panel_id][$field_id];
    }

    // apply restrictions to system qbars
    if ($qbar_maps[$qname]['class'] == 'System') {
        message_die(GENERAL_MESSAGE, (empty($field_id) ? $lang['Qbar_error_panel_system'] : $lang['Qbar_error_field_system']));
    }

    // panels
    if ($cancel) {
        // return to the list
        $mode = '';
        if (empty($field_id)) {
            $panel_id = 0;
        }
        $field_id = 0;
    } elseif ($submit) {
        // update the table
        if (empty($field_id)) {
            @reset($qbar_maps);
            $wbar = array();
            $i = 0;
            while (list($qname, $qdata) = each($qbar_maps)) {
                $i++;
                if ($panel_id != $i) {
                    $wbar[$qname] = $qdata;
                }
            }
            $qbar_maps = $wbar;
        } else {
            @reset($qbar_maps);
            $wfields = array();
            $j = 0;
            while (list($fname, $fdata) = each($qbar_maps[$qname]['fields'])) {
                $j++;
                if ($field_id != $j) {
                    $wfields[$fname] = $fdata;
                }
            }
            $qbar_maps[$qname]['fields'] = $wfields;
        }
        // write it
        qbar_add_order();
        qbar_sort();
        qbar_write();
        qbar_read();

        // return to the list
        $mode = '';
        if (empty($field_id)) {
            $panel_id = 0;
        }
        $field_id = 0;
    } else {
        // template
        $template->set_filenames(
            array(
            'body' => 'admin/qbar_confirm_body.tpl')
        );

        // header
        $template->assign_vars(
            array(
            'L_TITLE'				=> $lang['Qbar_admin'],
            'L_TITLE_EXPLAIN'		=> $lang['Qbar_admin_explain'],

            'MESSAGE_TITLE'			=> empty($field_id) ? $lang['Qbar_delete_panel'] : $lang['Qbar_delete_field'],
            'MESSAGE_TEXT'			=> empty($field_id) ? sprintf($lang['Qbar_delete_panel_confirm'], $qname) : sprintf($lang['Qbar_delete_field_confirm'], $fname, $qname),

            'L_YES'					=> $lang['Yes'],
            'L_NO'					=> $lang['No'],
            )
        );

        // system
        $s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
        $s_hidden_fields .= '<input type="hidden" name="panel_id" value="' . $panel_id . '" />';
        if (!empty($field_id)) {
            $s_hidden_fields .= '<input type="hidden" name="field_id" value="' . $field_id . '" />';
        }
        $template->assign_vars(
            array(
            'S_NAV_DESC'		=> qbar_get_nav_desc(),
            'S_ACTION'			=> append_sid("admin_qbar.$phpEx"),
            'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
            )
        );

        // footer
        $template->pparse('body');
        include('./page_footer_admin.'.$phpEx);
    }
}
//
// editing/creating a field
//
if (($mode == 'edit') && (!empty($field_id) || $create_field)) {
    // apply restrictions to system qbars and get qbar name
    if (!empty($panel_id)) {
        if (empty($qbar_keys[$panel_id][0])) {
            message_die(GENERAL_MESSAGE, $lang['Qbar_error_panel_not_found']);
        }
        $qname = $qbar_keys[$panel_id][0];
        if (($qbar_maps[$qname]['class'] == 'System') && !$import) {
            message_die(GENERAL_MESSAGE, (empty($field_id) ? $lang['Qbar_error_panel_system'] : $lang['Qbar_error_field_system']));
        }
        if (!empty($field_id)) {
            if (empty($qbar_keys[$panel_id][$field_id])) {
                message_die(GENERAL_MESSAGE, $lang['Qbar_error_field_not_found']);
            }
            $fname = $qbar_keys[$panel_id][$field_id];
        }
    }

    // init data
    $field_shortcut		= '';
    $field_alternate	= '';
    $field_explain		= '';
    $field_icon			= '';
    $field_use_value	= true;
    $field_use_icon		= true;
    $field_url			= '';
    $field_internal		= true;
    $field_window		= false;
    $field_auth_logged	= 0;
    $field_auth_admin	= 0;
    $field_auth_pm		= 0;
    $field_tree_id		= '';

    // get data from the table
    if (!empty($field_id)) {
        $field_name			= $fname;
        $field_shortcut		= $qbar_maps[$qname]['fields'][$fname]['shortcut'];
        $field_alternate	= $qbar_maps[$qname]['fields'][$fname]['alternate'];
        $field_explain		= $qbar_maps[$qname]['fields'][$fname]['explain'];
        $field_icon			= $qbar_maps[$qname]['fields'][$fname]['icon'];
        $field_use_value	= $qbar_maps[$qname]['fields'][$fname]['use_value'];
        $field_use_icon		= $qbar_maps[$qname]['fields'][$fname]['use_icon'];
        $field_url			= $qbar_maps[$qname]['fields'][$fname]['url'];
        $field_internal		= $qbar_maps[$qname]['fields'][$fname]['internal'];
        $field_window		= $qbar_maps[$qname]['fields'][$fname]['window'];
        $field_auth_logged	= $qbar_maps[$qname]['fields'][$fname]['auth_logged'];
        $field_auth_admin	= $qbar_maps[$qname]['fields'][$fname]['auth_admin'];
        $field_auth_pm		= $qbar_maps[$qname]['fields'][$fname]['auth_pm'];
        $field_tree_id		= $qbar_maps[$qname]['fields'][$fname]['tree_id'];
        $field_php_function	= $qbar_maps[$qname]['fields'][$fname]['php_function'];
    }

    // get data from the formular
    if (isset($_POST['name'])) {
        $field_name			= trim(stripslashes($_POST['name']));
    }
    if (isset($_POST['shortcut'])) {
        $field_shortcut		= trim(stripslashes($_POST['shortcut']));
    }
    if (isset($_POST['alternate'])) {
        $field_alternate	= trim(stripslashes($_POST['alternate']));
    }
    if (isset($_POST['explain'])) {
        $field_explain		= trim(stripslashes($_POST['explain']));
    }
    if (isset($_POST['icon'])) {
        $field_icon			= trim(stripslashes($_POST['icon']));
    }
    if (isset($_POST['use_value'])) {
        $field_use_value	= intval($_POST['use_value']);
    }
    if (isset($_POST['use_icon'])) {
        $field_use_icon		= intval($_POST['use_icon']);
    }
    if (isset($_POST['url'])) {
        $field_url			= trim(stripslashes($_POST['url']));
    }
    if (isset($_POST['internal'])) {
        $field_internal		= intval($_POST['internal']);
    }
    if (isset($_POST['window'])) {
        $field_window		= intval($_POST['window']);
    }
    if (isset($_POST['auth_logged'])) {
        $field_auth_logged	= intval($_POST['auth_logged']);
    }
    if (isset($_POST['auth_admin'])) {
        $field_auth_admin	= intval($_POST['auth_admin']);
    }
    if (isset($_POST['auth_pm'])) {
        $field_auth_pm		= intval($_POST['auth_pm']);
    }
    if (isset($_POST['tree_id'])) {
        $field_tree_id		= trim(stripslashes($_POST['tree_id']));
    }
    if (isset($_POST['php_function'])) {
        $field_php_function		= trim(stripslashes($_POST['php_function']));
    }
    // TODO check that PHP function starts with "qbar_function_"

    // process the action
    if ($import) {
        if ($cancel) {
            // get back the start value
            if (isset($_POST['sav_panel_id'])) {
                $panel_id = intval($_POST['sav_panel_id']);
            }
            if (isset($_POST['sav_field_id'])) {
                $field_id = intval($_POST['sav_field_id']);
            }

            // return to the display
            $cancel = false;
            $import = false;
            if (!empty($sav_mode)) {
                $mode = '';
            }
        } elseif ($submit) {
            // get the new values
            if (!empty($field_ids)) {
                // get the imported field ref
                ksort($field_ids);
                for ($i = 0; (($i == 0) && empty($sav_mode)) || (($i < count($field_ids)) && !empty($sav_mode)); $i++) {
                    $id_combined = $field_ids[$i];
                    $ids = explode('x', $id_combined);
                    $from_panel_id = intval($ids[0]);
                    $from_field_id = intval($ids[1]);
                    $from_qname = $qbar_keys[$from_panel_id][0];
                    $from_fname = $qbar_keys[$from_panel_id][$from_field_id];

                    // recall the save field ref
                    $qname = '';
                    if (isset($_POST['sav_panel_id'])) {
                        $panel_id = intval($_POST['sav_panel_id']);
                        $qname = isset($qbar_keys[$panel_id][0]) ? $qbar_keys[$panel_id][0] : '';
                    }
                    if (empty($sav_mode)) {
                        if (isset($_POST['sav_field_id'])) {
                            $field_id = intval($_POST['sav_field_id']);
                        }
                    }

                    // get the values
                    $field_name			= $from_fname;
                    $field_shortcut		= $qbar_maps[$from_qname]['fields'][$from_fname]['shortcut'];
                    $field_alternate	= $qbar_maps[$from_qname]['fields'][$from_fname]['alternate'];
                    $field_explain		= $qbar_maps[$from_qname]['fields'][$from_fname]['explain'];
                    $field_icon			= $qbar_maps[$from_qname]['fields'][$from_fname]['icon'];
                    $field_use_value	= $qbar_maps[$from_qname]['fields'][$from_fname]['use_value'];
                    $field_use_icon		= $qbar_maps[$from_qname]['fields'][$from_fname]['use_icon'];
                    $field_url			= $qbar_maps[$from_qname]['fields'][$from_fname]['url'];
                    $field_internal		= $qbar_maps[$from_qname]['fields'][$from_fname]['internal'];
                    $field_window		= $qbar_maps[$from_qname]['fields'][$from_fname]['window'];
                    $field_auth_logged	= $qbar_maps[$from_qname]['fields'][$from_fname]['auth_logged'];
                    $field_auth_admin	= $qbar_maps[$from_qname]['fields'][$from_fname]['auth_admin'];
                    $field_auth_pm		= $qbar_maps[$from_qname]['fields'][$from_fname]['auth_pm'];
                    $field_tree_id		= $qbar_maps[$from_qname]['fields'][$from_fname]['tree_id'];
                    $field_php_function	= $qbar_maps[$from_qname]['fields'][$from_fname]['php_function'];

                    if (!empty($sav_mode) && !empty($qname)) {
                        $wfield['shortcut']		= $field_shortcut;
                        $wfield['alternate']	= $field_alternate;
                        $wfield['explain']		= $field_explain;
                        $wfield['icon']			= $field_icon;
                        $wfield['use_value']	= $field_use_value;
                        $wfield['use_icon']		= $field_use_icon;
                        $wfield['url']			= $field_url;
                        $wfield['internal']		= $field_internal;
                        $wfield['window']		= $field_window;
                        $wfield['auth_logged']	= $field_auth_logged;
                        $wfield['auth_admin']	= $field_auth_admin;
                        $wfield['auth_pm']		= $field_auth_pm;
                        $wfield['tree_id']		= $field_tree_id;
                        $wfield['php_function']		= $field_php_function;

                        $qbar_maps[$qname]['fields'][$field_name] = $wfield;
                    }
                }

                // write
                qbar_add_order();
                qbar_sort();
                qbar_write();
                qbar_read();
            }

            // return to the display
            $submit = false;
            $import = false;
            if (!empty($sav_mode)) {
                $mode = '';
            }
        } else {
            $sav_panel_id = $panel_id;
            if (isset($_POST['sav_panel_id'])) {
                $sav_panel_id = intval($_POST['sav_panel_id']);
            } else {
                $panel_id = 0;
            }
            $sav_field_id = $field_id;
            if (isset($_POST['sav_field_id'])) {
                $sav_field_id = intval($_POST['sav_field_id']);
            }
            $s_hidden_fields .= '<input type="hidden" name="sav_panel_id" value="' . $sav_panel_id . '" />';
            if (!empty($sav_field_id)) {
                $s_hidden_fields .= '<input type="hidden" name="sav_field_id" value="' . $sav_field_id . '" />';
            }
            $s_hidden_fields .= '<input type="hidden" name="name" value="' . $field_name . '" />';
            $s_hidden_fields .= '<input type="hidden" name="shortcut" value="' . $field_shortcut . '" />';
            $s_hidden_fields .= '<input type="hidden" name="alternate" value="' . $field_alternate . '" />';
            $s_hidden_fields .= '<input type="hidden" name="explain" value="' . $field_explain . '" />';
            $s_hidden_fields .= '<input type="hidden" name="icon" value="' . $field_icon . '" />';
            $s_hidden_fields .= '<input type="hidden" name="use_value" value="' . $field_use_value . '" />';
            $s_hidden_fields .= '<input type="hidden" name="use_icon" value="' . $field_use_icon . '" />';
            $s_hidden_fields .= '<input type="hidden" name="url" value="' . $field_url . '" />';
            $s_hidden_fields .= '<input type="hidden" name="internal" value="' . $field_internal . '" />';
            $s_hidden_fields .= '<input type="hidden" name="window" value="' . $field_window . '" />';
            $s_hidden_fields .= '<input type="hidden" name="auth_logged" value="' . $field_auth_logged . '" />';
            $s_hidden_fields .= '<input type="hidden" name="auth_admin" value="' . $field_auth_admin . '" />';
            $s_hidden_fields .= '<input type="hidden" name="auth_pm" value="' . $field_auth_pm . '" />';
            $s_hidden_fields .= '<input type="hidden" name="tree_id" value="' . $field_tree_id . '" />';
            $s_hidden_fields .= '<input type="hidden" name="php_function" value="' . $field_php_function . '" />';
            if ($create_field) {
                $s_hidden_fields .= '<input type="hidden" name="create_field" value="1" />';
            }
            if (!empty($sav_mode)) {
                $s_hidden_fields .= '<input type="hidden" name="sav_mode" value="' . $sav_mode . '" />';
            }

            $fields_ids = select_field($import);
        }
    }
    if ($mode == 'edit') {
        if ($cancel) {
            // return to the list
            $mode = '';
            $field_id = 0;
        } elseif ($submit) {
            // check the input
            $error = false;
            $error_msg = '';

            // field name blank
            if (empty($field_name)) {
                $error = true;
                $error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Qbar_error_field_empty_name'];
            }

            // check if exists
            $idx = $qbar_maps[$qname]['fields'][$field_name]['idx'];
            if (!empty($idx) && ($idx != $field_id)) {
                $error = true;
                $error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Qbar_error_field_exists'];
            }

            // check if something to display
            if ($field_use_value && empty($field_shortcut)) {
                $error = true;
                $error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Qbar_error_field_empty_shortcut'];
            }
            if ($field_use_icon && empty($field_icon)) {
                $error = true;
                $error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Qbar_error_field_empty_icon'];
            }
            if (!$field_use_value && !$field_use_icon) {
                $error = true;
                $error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Qbar_error_field_display_nothing'];
            }

            // prog url
            if (empty($field_url)) {
                $error = true;
                $error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Qbar_error_field_empty_url'];
            }
            if (preg_match("/http/", strtolower($field_url)) && $field_internal) {
                $error = true;
                $error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Qbar_error_field_empty_url'];
            }

            // error
            if ($error) {
                message_die(GENERAL_MESSAGE, $error_msg);
            }

            // update the table
            $wfield = array();
            $wfield['shortcut']		= $field_shortcut;
            $wfield['alternate']	= $field_alternate;
            $wfield['explain']		= $field_explain;
            $wfield['icon']			= $field_icon;
            $wfield['use_value']	= $field_use_value;
            $wfield['use_icon']		= $field_use_icon;
            $wfield['url']			= $field_url;
            $wfield['internal']		= $field_internal;
            $wfield['window']		= $field_window;
            $wfield['auth_logged']	= $field_auth_logged;
            $wfield['auth_admin']	= $field_auth_admin;
            $wfield['auth_pm']		= $field_auth_pm;
            $wfield['tree_id']		= $field_tree_id;
            $wfield['php_function']	= $field_php_function;
            if (!empty($field_id)) {
                $wname = $qbar_keys[$panel_id][$field_id];
                @reset($qbar_maps[$qname]['fields']);
                $wdata = array();
                while (list($fname, $fdata) = each($qbar_maps[$qname]['fields'])) {
                    if ($fname == $wname) {
                        $wdata[$field_name] = $wfield;
                    } else {
                        $wdata[$fname] = $fdata;
                    }
                }
                $qbar_maps[$qname]['fields'] = $wdata;
            } else {
                $qbar_maps[$qname]['fields'][$field_name] = $wfield;
            }
            qbar_add_order();
            qbar_sort();
            qbar_write();
            qbar_read();

            // return to the list
            $mode = '';
            $field_id = 0;
        } else {
            // template
            $template->set_filenames(
                array(
                'body' => 'admin/qbar_field_body.tpl')
            );

            // header
            $template->assign_vars(
                array(
                'L_TITLE'				=> $lang['Qbar_admin_field'],
                'L_TITLE_EXPLAIN'		=> $lang['Qbar_admin_field_explain'],

                'L_AUTH'				=> $lang['Qbar_auths'],
                'L_PRIVATE_MESSAGE'		=> $lang['Qbar_private_messages'],

                'L_NAME'				=> $lang['Qbar_field_name'],
                'L_NAME_EXPLAIN'		=> $lang['Qbar_field_name_explain'],
                'L_SHORTCUT'			=> $lang['Qbar_shortcut'],
                'L_SHORTCUT_EXPLAIN'	=> $lang['Qbar_shortcut_explain'],
                'L_EXPLAIN'				=> $lang['Qbar_explain'],
                'L_EXPLAIN_EXPLAIN'		=> $lang['Qbar_explain_explain'],
                'L_ALTERNATE'			=> $lang['Qbar_alternate'],
                'L_ALTERNATE_EXPLAIN'	=> $lang['Qbar_alternate_explain'],
                'L_ICON'				=> $lang['Qbar_icon'],
                'L_ICON_EXPLAIN'		=> $lang['Qbar_icon_explain'],
                'L_USE_VALUE'			=> $lang['Qbar_use_value'],
                'L_USE_VALUE_EXPLAIN'	=> $lang['Qbar_use_value_explain'],
                'L_USE_ICON'			=> $lang['Qbar_use_icon'],
                'L_USE_ICON_EXPLAIN'	=> $lang['Qbar_use_icon_explain'],
                'L_URL'					=> $lang['Qbar_url'],
                'L_URL_EXPLAIN'			=> $lang['Qbar_url_explain'],
                'L_INTERNAL'			=> $lang['Qbar_internal'],
                'L_INTERNAL_EXPLAIN'	=> $lang['Qbar_internal_explain'],
                'L_WINDOW'				=> $lang['Qbar_window'],
                'L_WINDOW_EXPLAIN'		=> $lang['Qbar_window_explain'],
                'L_AUTH_LOGGED'			=> $lang['Qbar_auth_logged'],
                'L_AUTH_LOGGED_EXPLAIN'	=> $lang['Qbar_auth_logged_explain'],
                'L_AUTH_ADMIN'			=> $lang['Qbar_auth_admin'],
                'L_AUTH_ADMIN_EXPLAIN'	=> $lang['Qbar_auth_admin_explain'],
                'L_AUTH_PM'				=> $lang['Qbar_auth_pm'],
                'L_AUTH_PM_EXPLAIN'		=> $lang['Qbar_auth_pm_explain'],
                'L_TREE_ID'				=> $lang['Qbar_tree_id'],
                'L_TREE_ID_EXPLAIN'		=> $lang['Qbar_tree_id_explain'],

                'L_YES'					=> $lang['Yes'],
                'L_NO'					=> $lang['No'],

                'L_IGNORE'				=> $lang['Qbar_auth_ignore'],
                'L_REQUIRE'				=> $lang['Qbar_auth_required'],
                'L_DENY'				=> $lang['Qbar_auth_prohibited'],

                'L_PM_NEW'				=> $lang['Qbar_auth_pm_new'],
                'L_PM_NO_NEW'			=> $lang['Qbar_auth_pm_no_new'],
                'L_PM_UNREAD'			=> $lang['Qbar_auth_pm_unread'],

                'L_SUBMIT'				=> $lang['Submit'],
                'L_CANCEL'				=> $lang['Cancel'],
                'L_REFRESH'				=> $lang['Refresh'],
                'L_IMPORT'				=> $lang['Import'],
                )
            );

            // switches
            $use_value_yes			= ($field_use_value) ? ' checked="checked"' : '';
            $use_value_no			= (!$field_use_value) ? ' checked="checked"' : '';
            $use_icon_yes			= ($field_use_icon) ? ' checked="checked"' : '';
            $use_icon_no			= (!$field_use_icon) ? ' checked="checked"' : '';
            $internal_yes			= ($field_internal) ? ' checked="checked"' : '';
            $internal_no			= (!$field_internal) ? ' checked="checked"' : '';
            $window_yes				= ($field_window) ? ' checked="checked"' : '';
            $window_no				= (!$field_window) ? ' checked="checked"' : '';
            $auth_logged_ignore		= ($field_auth_logged == 0) ? ' checked="checked"' : '';
            $auth_logged_require	= ($field_auth_logged == 1) ? ' checked="checked"' : '';
            $auth_logged_deny		= ($field_auth_logged == 2) ? ' checked="checked"' : '';
            $auth_admin_ignore		= ($field_auth_admin == 0) ? ' checked="checked"' : '';
            $auth_admin_require		= ($field_auth_admin == 1) ? ' checked="checked"' : '';
            $auth_admin_deny		= ($field_auth_admin == 2) ? ' checked="checked"' : '';
            $auth_pm_ignore			= ($field_auth_pm == 0) ? ' checked="checked"' : '';
            $auth_pm_new			= ($field_auth_pm == 1) ? ' checked="checked"' : '';
            $auth_pm_no_new			= ($field_auth_pm == 2) ? ' checked="checked"' : '';
            $auth_pm_unread			= ($field_auth_pm == 3) ? ' checked="checked"' : '';

            // get lang value and images
            $shortcut_tr	= isset($lang[$field_shortcut]) ? $lang[$field_shortcut] : '';
            $explain_tr		= isset($lang[$field_explain]) ? $lang[$field_explain] : '';
            $alternate_tr	= isset($lang[$field_alternate]) ? $lang[$field_alternate] : '';
            $icon_tr		= qbar_get_icon(qbar_image($field_icon, $qbar_maps[$qname]['style'], $qbar_maps[$qname]['sub_template']));

            // value
            $template->assign_vars(
                array(
                'PHP_FUNCTION'			=> $field_php_function,
                'NAME'					=> $field_name,
                'SHORTCUT'				=> $field_shortcut,
                'SHORTCUT_TR'			=> $shortcut_tr,
                'EXPLAIN'				=> $field_explain,
                'EXPLAIN_TR'			=> $explain_tr,
                'ALTERNATE'				=> $field_alternate,
                'ALTERNATE_TR'			=> $alternate_tr,
                'ICON'					=> $field_icon,
                'ICON_TR'				=> $icon_tr,
                'USE_VALUE_YES'			=> $use_value_yes,
                'USE_VALUE_NO'			=> $use_value_no,
                'USE_ICON_YES'			=> $use_icon_yes,
                'USE_ICON_NO'			=> $use_icon_no,
                'URL'					=> $field_url,
                'INTERNAL_YES'			=> $internal_yes,
                'INTERNAL_NO'			=> $internal_no,
                'WINDOW_YES'			=> $window_yes,
                'WINDOW_NO'				=> $window_no,
                'AUTH_LOGGED_IGNORE'	=> $auth_logged_ignore,
                'AUTH_LOGGED_REQUIRE'	=> $auth_logged_require,
                'AUTH_LOGGED_DENY'		=> $auth_logged_deny,
                'AUTH_ADMIN_IGNORE'		=> $auth_admin_ignore,
                'AUTH_ADMIN_REQUIRE'	=> $auth_admin_require,
                'AUTH_ADMIN_DENY'		=> $auth_admin_deny,
                'AUTH_PM_IGNORE'		=> $auth_pm_ignore,
                'AUTH_PM_NEW'			=> $auth_pm_new,
                'AUTH_PM_NO_NEW'		=> $auth_pm_no_new,
                'AUTH_PM_UNREAD'		=> $auth_pm_unread,
                'S_TREE_ID'				=> qbar_get_tree_options($field_tree_id),
                )
            );

            // system
            $s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
            $s_hidden_fields .= '<input type="hidden" name="panel_id" value="' . $panel_id . '" />';
            if (!empty($field_id)) {
                $s_hidden_fields .= '<input type="hidden" name="field_id" value="' . $field_id . '" />';
            } else {
                $s_hidden_fields .= '<input type="hidden" name="create_field[' . $panel_id . ']" value="1" />';
            }
            $template->assign_vars(
                array(
                'S_NAV_DESC'		=> qbar_get_nav_desc(),
                'S_ACTION'			=> append_sid("admin_qbar.$phpEx"),
                'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
                )
            );

            // footer
            $template->pparse('body');
            include('./page_footer_admin.'.$phpEx);
        }
    }
}
//
// editing/creating a panel
//
if (($mode == 'edit') && empty($field_id) && !$create_field) {
    // apply restrictions to system qbars
    if (!empty($panel_id)) {
        if (empty($qbar_keys[$panel_id][0])) {
            message_die(GENERAL_MESSAGE, $lang['Qbar_error_panel_not_found']);
        }
        $qname = $qbar_keys[$panel_id][0];
        if ($qbar_maps[$qname]['class'] == 'System') {
            message_die(GENERAL_MESSAGE, (empty($field_id) ? $lang['Qbar_error_panel_system'] : $lang['Qbar_error_field_system']));
        }
    }

    // init data
    $panel_class		= 'Bar';
    $panel_display		= true;
    $panel_cells		= 5;
    $panel_in_table		= true;

    // get data from the table
    if (!empty($panel_id)) {
        $panel_name				= $qname;
        $panel_class			= $qbar_maps[$qname]['class'];
        $panel_display			= $qbar_maps[$qname]['display'];
        $panel_cells			= $qbar_maps[$qname]['cells'];
        $panel_in_table			= $qbar_maps[$qname]['in_table'];
        $panel_style			= $qbar_maps[$qname]['style'];
        $panel_sub_template		= $qbar_maps[$qname]['sub_template'];
    }

    // get data from the formular
    if (isset($_POST['panel_name'])) {
        $panel_name				= trim(stripslashes($_POST['panel_name']));
    }
    if (isset($_POST['panel_class'])) {
        $panel_class			= trim(stripslashes($_POST['panel_class']));
    }
    if (isset($_POST['panel_display'])) {
        $panel_display			= intval($_POST['panel_display']);
    }
    if (isset($_POST['panel_cells'])) {
        $panel_cells			= intval($_POST['panel_cells']);
    }
    if (isset($_POST['panel_in_table'])) {
        $panel_in_table			= intval($_POST['panel_in_table']);
    }
    if (isset($_POST['panel_style'])) {
        $panel_style			= intval($_POST['panel_style']);
    }
    if (isset($_POST['panel_sub_template'])) {
        $panel_sub_template		= qbar_fix_sub_template($panel_style, trim(stripslashes($_POST['panel_sub_template'])));
    }

    // process the action
    if ($cancel) {
        // return to the list
        $mode = '';
        $panel_id = 0;
        $field_id = 0;
    } elseif ($submit) {
        // check the input
        $error = false;
        $error_msg = '';

        // panel name blank
        if (empty($panel_name)) {
            $error = true;
            $error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Qbar_error_panel_empty_name'];
        }

        // check if exists
        $idx = $qbar_maps[$panel_name]['idx'];
        if (!empty($idx) && ($idx != $panel_id)) {
            $error = true;
            $error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Qbar_error_panel_exists'];
        }

        // number of cell and display
        if ($panel_display && ($panel_cells <= 0)) {
            $error = true;
            $error_msg .= (($error_msg != '') ? '<br />' : '') . $lang['Qbar_error_panel_empty_cells'];
        }

        // error
        if ($error) {
            message_die(GENERAL_MESSAGE, $error_msg);
        }

        // update the table
        $wmap = array();
        $wmap['class']			= $panel_class;
        $wmap['display']		= $panel_display;
        $wmap['in_table']		= $panel_in_table;
        $wmap['style']			= $panel_style;
        $wmap['sub_template']	= $panel_sub_template;
        $wmap['cells']			= $panel_cells;
        $wmap['fields']			= array();
        if (!empty($panel_id)) {
            $wname = $qbar_keys[$panel_id][0];
            $wmap['fields'] = $qbar_maps[$wname]['fields'];
            @reset($qbar_maps);
            $wbar = array();
            while (list($qname, $qdata) = each($qbar_maps)) {
                if ($qname == $wname) {
                    $wbar[$panel_name] = $wmap;
                } else {
                    $wbar[$qname] = $qdata;
                }
            }
            $qbar_maps = $wbar;
        } else {
            $qbar_maps[$panel_name] = $wmap;
        }
        qbar_add_order();
        qbar_sort();
        qbar_write();
        qbar_read();

        // return to the list
        $mode = '';
        $panel_id = (!empty($qbar_maps[$panel_name]['idx'])) ? $qbar_maps[$panel_name]['idx'] : 0;
        $field_id = 0;
    } else {
        // template
        $template->set_filenames(
            array(
            'body' => 'admin/qbar_panel_body.tpl')
        );

        // header
        $template->assign_vars(
            array(
            'L_TITLE'					=> $lang['Qbar_admin_panel'],
            'L_TITLE_EXPLAIN'			=> $lang['Qbar_admin_panel_explain'],

            'L_NAME'					=> $lang['Qbar_name'],
            'L_NAME_EXPLAIN'			=> $lang['Qbar_name_explain'],
            'L_CLASS'					=> $lang['Qbar_class'],
            'L_CLASS_EXPLAIN'			=> $lang['Qbar_class_explain'],
            'L_DISPLAY'					=> $lang['Qbar_display'],
            'L_DISPLAY_EXPLAIN'			=> $lang['Qbar_display_explain'],
            'L_CELLS'					=> $lang['Qbar_cells'],
            'L_CELLS_EXPLAIN'			=> $lang['Qbar_cells_explain'],
            'L_IN_TABLE'				=> $lang['Qbar_in_table'],
            'L_IN_TABLE_EXPLAIN'		=> $lang['Qbar_in_table_explain'],
            'L_STYLE'					=> $lang['Qbar_style'],
            'L_STYLE_EXPLAIN'			=> $lang['Qbar_style_explain'],
            'L_SUB_TEMPLATE'			=> $lang['Qbar_sub_template'],
            'L_SUB_TEMPLATE_EXPLAIN'	=> $lang['Qbar_sub_template_explain'],

            'L_SUBMIT'					=> $lang['Submit'],
            'L_CANCEL'					=> $lang['Cancel'],
            'L_REFRESH'					=> $lang['Refresh'],
            'L_YES'						=> $lang['Yes'],
            'L_NO'						=> $lang['No'],
            )
        );

        // selection lists
        $s_class = '<select name="panel_class">';
        reset($classes);
        while (list($key, $lang_key) = each($classes)) {
            if ($key != 'System') {
                $selected = ($panel_class == $key) ? ' selected="selected"' : '';
                $s_class .= '<option value="' . $key . '"' . $selected . '>' . $lang[$lang_key] . '</option>';
            }
        }
        $s_class .= '</select>';

        // switches
        $display_yes	= ($panel_display) ? ' checked="checked"' : '';
        $display_no		= (!$panel_display) ? ' checked="checked"' : '';

        $in_table_yes	= ($panel_in_table) ? ' checked="checked"' : '';
        $in_table_no	= (!$panel_in_table) ? ' checked="checked"' : '';

        $s_sub_template = qbar_sub_template_select($panel_style, $panel_sub_template);

        // value
        $template->assign_vars(
            array(
            'NAME'				=> $panel_name,
            'S_CLASS'			=> $s_class,
            'DISPLAY_YES'		=> $display_yes,
            'DISPLAY_NO'		=> $display_no,
            'CELLS'				=> $panel_cells,
            'IN_TABLE_YES'		=> $in_table_yes,
            'IN_TABLE_NO'		=> $in_table_no,

            'S_STYLE'			=> qbar_style_select($panel_style),
            'S_SUB_TEMPLATE'	=> $s_sub_template,
            )
        );

        // system
        if (isset($lang['Subtemplate']) && !empty($s_sub_template)) {
            $template->assign_block_vars('sub_template', array());
        }
        $s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
        if (!empty($panel_id)) {
            $s_hidden_fields .= '<input type="hidden" name="panel_id" value="' . $panel_id . '" />';
        }
        $template->assign_vars(
            array(
            'S_NAV_DESC'		=> qbar_get_nav_desc(),
            'S_ACTION'			=> append_sid("admin_qbar.$phpEx"),
            'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
            )
        );

        // footer
        $template->pparse('body');
        include('./page_footer_admin.'.$phpEx);
    }
}
//
// default entry
//
if ($mode == '') {
    select_field();
}
