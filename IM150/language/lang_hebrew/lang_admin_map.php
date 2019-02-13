<?php
/***************************************************************************
 *
 *   MOD                  : Map MOD
 *   file                 : lang_admin_map.php (english)
 *   copyright            : (C) 2003 Michael Keppler
 *   web                  : www.bananeweizen.de
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

// panel names shown in ACP
$lang['Map'] = 'Map'; 
$lang['map_panel_configuration'] = 'Configuration'; 
$lang['map_panel_locations'] = 'Shown locations'; 
$lang['map_panel_maps'] = 'Maps';
$lang['map_panel_wrong'] = 'Wrong entries';
$lang['map_panel_search'] = 'Search places';

// panel "configuration"
$lang['map_config'] = 'Map configuration';
$lang['map_config_explain'] = 'Here you can change the map to be used for user location.';
$lang['map_settings'] = 'Map settings';
$lang['map_flag_settings'] = 'Location flag settings';
$lang['map_flag_explain'] = 'Name of picture file relative to phpBB directory';
$lang['map_flag_self'] = 'Flag for self';
$lang['map_flag_highlight'] = 'Flag for selected member';
$lang['map_flag'] = 'Flag for other members';
$lang['map_offset_x'] = 'Horizontal flag offset';
$lang['map_offset_y'] = 'Vertical flag offset';
$lang['map_offset_explain'] = 'Increase the offset if your flag does not point at the bottom left corner of the flag image.';
$lang['map_other_settings'] = 'Other settings';
$lang['map_users_near'] = 'Number of users in distance table (with map)';
$lang['map_config_updated'] = 'Map configuration updated.';
$lang['map_image_types'] = 'Supported formats: JPEG, PNG.';
$lang['map_border_explain'] = 'Insert degrees as floating point value.';
$lang['map_border_unit'] = 'degrees';
$lang['map_click_return_map_config'] = 'Click %shere%s to return to map configuration.';
$lang['map_max_width'] = 'Maximum width of map';
$lang['map_max_height'] = 'Maximum height of map';
$lang['map_max_width_explain'] = 'On zooming in the displayed map will not get bigger than specified here.';
$lang['map_zoom_settings'] = 'Zoom and move settings';
$lang['map_move_percent'] = 'Percent of map to be scrolled';
$lang['map_move_percent_explain'] = 'With 20 percent you must scroll 5 times to move the map from left to right completely';
$lang['map_cluster_distance'] = 'Minimum distance between flags (pixels)';
$lang['map_cluster_distance_explain'] = 'If the flags of two or more users have a pixel distance smaller than this value then both users are assigned only one flag.';
$lang['map_cluster_settings'] = 'Cluster settings';
$lang['map_users_near_more'] = 'Number of users in distance table (without map)';
$lang['map_auth_view_config'] = 'Who may look at the map?';
$lang['map_flag_multiple'] = 'Flag for grouped members';

// panel "maps"
$lang['map_map'] = 'Maps';
$lang['map_map_explain'] = 'Here you can edit the available maps.';
$lang['map_edit'] = 'Edit map';
$lang['map_add_map'] = 'Add map';
$lang['map_name'] = 'Map name';
$lang['map_name_explain'] = 'This name is shown in the map selection list.';
$lang['map_filename'] = 'File name';
$lang['map_default'] = 'Default map';
$lang['map_become_default'] = 'Become default';
$lang['map_picture'] = 'Map picture file';
$lang['map_picture_explain'] = 'Name of picture file relative to phpBB directory';
$lang['map_east'] = 'Eastern longitude';
$lang['map_west'] = 'Western longitude';
$lang['map_north'] = 'Northern latitude';
$lang['map_south'] = 'Southern latitude';
$lang['map_import_map'] = 'Import map with coordinates';

// panel "additional locations"
$lang['map_locations'] = 'Shown locations';
$lang['map_locations_explain'] = 'Here you can add locations with names and coordinates which are always automatically shown in the map.<br />Attention: The locations are each added for a <b>single</b> map only (but you may copy them from one map to another).';
$lang['map_location_settings'] = 'Locations';
$lang['map_delete_location'] = 'Delete';
$lang['map_font_settings'] = 'Output settings';
$lang['map_location_updated'] = 'The location was updated successfully.';
$lang['map_click_return_location'] = 'Click %shere%s to return to the administration of additional locations.';
$lang['map_location_name'] = 'Name';
$lang['map_edit_location'] = 'Edit location';
$lang['map_add_location'] = 'Add location';
$lang['map_new_location'] = 'New location';
$lang['map_location_update'] = 'Update';
$lang['map_map_updated'] = 'The map was updated successfully.';
$lang['map_click_return_map'] = 'Click %shere%s to return to the maps.';
$lang['map_location_link'] = 'Hyper link';
$lang['map_location_url'] = 'URL';
$lang['map_location_url_explain'] = 'By setting an URL it will be possible to click the location on the map.<br />Be sure to include "http://" or other protocol.<br />Leave blank for no hyper link.';
$lang['map_location_target'] = 'Target of hyper link';
$lang['map_location_target_explain'] = 'You may specify the name of another window or frame for the link to be opened.<br />Leave blank to open link in same frame or window.';
$lang['map_location_icon'] = 'Icon';
$lang['map_location_icon_explain'] = 'You may set an icon for the location to be shown on the map.<br />Store new icon files in images/map/icons.';
$lang['map_location_copy'] = 'Copy from other map';
$lang['map_location_no_icon'] = 'No icon';

// panel "wrong coordinates"
$lang['map_wrong'] = 'Erroneuous coordinates';
$lang['map_wrong_explain'] = 'This list shows all the people where the coordinates are off the <b>default</b> map.';

// panel "search places"
$lang['map_search_places'] = 'Places to be searched';
$lang['map_search_places_explain'] = 'Your users may use a location search to determine their geographical coordinates. Here you can manage the places that can be searched.';
$lang['map_num_places'] = 'Number of places';
$lang['map_country'] = 'Country';
$lang['map_import'] = 'Import places';
$lang['map_import_explain'] = 'You may import places from files located in the admin/map_mod directory';
$lang['map_rename'] = 'Rename';
?>