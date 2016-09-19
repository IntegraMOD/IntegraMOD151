<?php
/***************************************************************************
 *                              lang_rating.php v1.1.0
 *                            -------------------
 *   begin                : Friday, Jan 17, 2003
 *   copyright            : (C) 2002 Web Centre Ltd
 *   email                : phpbb@mywebcommunities.com
 *
 ***************************************************************************/
///
$lang['Rating_page_title'] = 'Rate post';
$lang['Die_rate_private'] = 'You cannot rate posts in private forums';
$lang['Die_login_to_rate'] = 'This post is in a forum restricted to registered members. You must be logged in to access the rating information.';
$lang['Die_rate_only_first'] = 'You can only rate the first post in each topic';
$lang['User_suspended'] = 'Ratings for this user have been suspended by the administrator';
$lang['Cannot_rate_own'] = 'You cannot rate your own posts';
$lang['Not_yet_rated'] = 'This post has not yet been rated';
$lang['Rating_anon_user'] = 'Registered user';
$lang['Must_be_logged_to_rate'] = 'You must be logged in to rate this post';
$lang['Days_registered_before_rating'] = 'You need to have been registered for %s before you can rate posts';
$lang['Posts_before_rating'] = 'You need to have made %s before you can rate other posts';
$lang['User_rating_limit'] = 'You have already rated %s by this user in the last 24 hours, which is the limit set by the administrator';
$lang['Daily_rating_limit'] = 'You have already rated %s in the last 24 hours, which is the limit set by the administrator';
$lang['Already_rated'] = 'You have already rated this post';
$lang['No_rating_permission_post'] = 'You do not have permission to rate this post';
$lang['No_rating_permission'] = 'You do not have permission to rate posts';
$lang['Your_rating'] = 'Your rating of this post';
$lang['Rating_visible']	= 'Your rating will be visible to others';
$lang['Rating_visible_forced']	= 'NOTE: Anonymous ratings are no longer allowed. If you click the button, all your ratings will be visible to others';
$lang['Rate_anonymously'] = 'Rate anonymously (applies to all your ratings)';
$lang['Return_to_post']	= 'Return to post';
$lang['Close_window'] = 'Close window';
$lang['Poster_rank'] = 'Poster rank';
$lang['Topic_rank'] = 'Topic rank';
$lang['Post_rank'] = 'Post rank';
$lang['Rated_by'] = 'Rated by';
$lang['Rated_on'] = 'On';
$lang['No_rating'] = 'No rating';
$lang['Unrated'] = 'Unrated';
$lang['No_rank'] = 'No rank';
$lang['Rating_sample_post'] = 'Sample post';
$lang['Topic_starter'] = 'Topic starter';
$lang['Rating_deactivated'] = 'Sorry, the rating system is de-activated at present';
$lang['No_ratings'] = 'No ratings';
$lang['Total_points'] = 'Total points';
$lang['Average_points'] = 'Average points';
$lang['Rate_it'] = 'Rate it';
$lang['Rating_config_gen'] = 'General configuration';
$lang['Rating_overview_text'] = '<b>Overview</b>: Users can rate each post individually, by selecting from a range of "rating options", each of which carries a certain point value.  The overall rank for each post is calculated by totalling (or averaging) all the individual rating points for that post, and assigning a rank from the "Totals table". Overall ranks for topics and users are also derived in this way (i.e. all ratings of posts in a particular topic / by a particular user).';
$lang['Rating_settings_title'] = 'Overall settings for your rating system';
$lang['Rating_settings_text'] = '<b>Rate first post only</b>: Only allow first post in each topic to be rated<br />
<b>Min. post count</b>: Number of posts a user must make before being able to rate<br />
<b>Min. days registered</b>: Days that must elapse after user registers before being able to rate<br />
<b>Weighting method</b>: If activated, a user can only select from those rating options where their own count (e.g. post count) equals or exceeds the figure in the "weighting threshold" column (see table below)<br />
<b>Max daily ratings</b>: Limit total number ratings a user can make in any 24 hour period<br />
<b>Max daily ratings per user</b>: Limit number of times that a user can rate posts by the same poster in any 24 hour period<br />
<b>Allow users to hide name</b>: Allow user to appear as anonymous in list of who rated a post<br />
<b>Overall rating method</b>: Whether rating totals are based on sum or average of all individual rating points';
$lang['Rating_options'] = 'Rating options';
$lang['Points'] = 'Points';
$lang['Rating_label'] = 'Label';
$lang['Weighting_threshold'] = 'Weighting threshold';
$lang['Rating_who'] = 'Who';
$lang['Rating_used'] = 'Used';
$lang['Rating_delete'] = 'Delete';
$lang['Rating_update'] = 'Update';
$lang['Rating_update_config'] = 'Update configuration';
$lang['Rating_add'] = 'Add';
$lang['Rating_option_title'] = 'Determines range of ratings a user can assign to a post';
$lang['Rating_option_text'] = '<b>Points</b>: Used to calculate total ratings for posts, topics and users<br />
<b>Weighting threshold</b>: See "Weighting Method" in general configuration<br />
<b>Who</b>: Used to restrict options based on user status<br />
<b>Used</b>: Number of times an option has been selected to date<br />';
$lang['Rating_ranks'] = 'Representation of post and topic ranks';
$lang['User_ranks_title'] = 'Representation of user ranks';
$lang['Board_rank'] = 'Board rank';
$lang['Rating_applies_to'] = 'Applies to';
$lang['Rating_sum'] = 'Sum';
$lang['Rating_average'] = 'Average';
$lang['Rating_max'] = 'Maximum';
$lang['Rating_icon'] = 'Icon';
$lang['Rating_rank_title'] = 'How overall ranks are calculated and presented';
$lang['Rating_rank_text'] = '<b>Average</b>: The average of all individual ratings is calculated, and the rank with the <b>nearest</b> "Average" figure being selected<br />
<b>Sum</b>: All individual ratings are totalled, and out of those ranks where this total <b>equals or exceeds</b> the "Sum threshold", the rank with the highest sum threshold is selected';
$lang['Rating_admin_page_title'] = 'Rating system configuration';
$lang['Must_be_an_integer'] = 'must be an integer';
$lang['Invalid_point_value'] = 'Points value must be an integer between -127 and 128';
$lang['Invalid_threshold_value'] = 'Threshold value must be an integer between 0 and 30000';
$lang['Invalid_average_threshold'] = 'Average threshold must be an integer between -127 and 128';
$lang['Invalid_sum_threshold'] = 'Sum threshold must be an integer between -2000000000 and 2000000000';
$lang['Weighting_method_posts'] = 'Post count';
$lang['Rating_user_type_all'] = 'All users';
$lang['Rating_user_type_mods'] = 'All moderators';
$lang['Rating_user_type_forum'] = 'Forum moderators';
$lang['Rating_user_type_admin'] = 'Admin only';
$lang['Rating_remove_confirm'] = 'Existing ratings will be removed. Are you sure you want to delete this option?';
$lang['Rating_recalc_confirm'] = 'Existing ratings will be recalculated. Are you sure you want to delete this rank?';
$lang['Rating_admin_errors'] = 'There were some problems with the information you submitted. Please read the messages below, make the necessary changes and re-submit:';
$lang['As_rated_by'] = 'as rated by';
$lang['As_rated_by_you'] = 'as rated by you';
$lang['Ratings_posts_by'] = 'posts by';
$lang['Ratings_posts_by_you'] = 'your posts';
$lang['Recalc_text'] = 'Some actions may require you to manually recalculate the ratings e.g. deletion of rated posts. To do this, click on the button below';
$lang['Recalc_button'] = 'Recalculate all ratings';
$lang['Recalc_confirm'] = 'Are you sure? This may take some time on large boards';
$lang['Ratedby_hidden'] = 'The administrator has chosen to hide the names of who rated which posts';
$lang['Rating_screen_type'] = 'Screen type';
$lang['Rating_in'] = 'in'; // As in "posts IN this forum"
$lang['Rating_all_forums'] = 'All forums';
$lang['Rating_make_neutral'] = 'Be neutral towards ratings by %s';
$lang['Rating_is_neutral'] = 'You are currently neutral towards ratings by %s';
$lang['Rating_make_buddy'] = 'Favour ratings by %s';
$lang['Rating_is_buddy'] = 'You are currently favouring ratings by %s';
$lang['Rating_buddy'] = 'Your ratings are currently favoured by %s';
$lang['Rating_ignored'] = 'Your ratings are currently ignored by %s';
$lang['Rating_make_ignored'] = 'Ignore ratings by %s' ;
$lang['Rating_is_ignored'] = 'You are currently ignoring ratings by %s';
$lang['Rating_bias'] = 'Bias';
$lang['Rating_bias_off'] = 'Bias options not currently available';
$lang['Rating_bias_loggedoff'] = 'You must be logged in to use the bias system for ratings';
$lang['Rating_all_but_ignore'] = 'All but my \'ignores\'';
$lang['Rating_everyone'] = 'Everyone';
$lang['Rating_buddies_only'] = 'My buddies only';
$lang['Rating_include_by'] = 'Include ratings by';
$lang['Rating_yourself'] = 'yourself';
$lang['Rating_bias_prompt'] = 'Bias prompted by';
$lang['Rating_bias_when'] = 'When';
$lang['Rating_current'] = 'Current rating';
$lang['Rating_buddies_only'] = 'Buddies only';
$lang['Rating_ignores_only'] = 'Ignores only';
$lang['Rating_post_removed'] = 'a post that no longer exists';
$lang['Rating_this_post'] = 'this post';
$lang['Rating_this_user'] = 'this user';
$lang['Rating_of'] = 'Rating of';
$lang['Rating_awarded_to'] = 'awarded to';
$lang['Rating_my_bias_title'] = 'My bias towards ratings by other users';
$lang['Rating_their_bias_title'] = 'Bias by other users towards my ratings';
$lang['Rating_no_bias'] = 'No bias at present';


$lang['Rating system active']							= 'Rating system active...';  
$lang['Weighting method'] 								= 'Weighting method...';
$lang['Users can change ratings'] 				= 'Users can change ratings';
$lang['Max daily ratings (0=unlimited)'] 	= 'Max daily ratings (0=unlimited)';
$lang['Show who rated'] 									= 'Show who rated';
$lang['Allow users to hide name'] 				= 'Allow users to hide name';
$lang['Rate first post only'] 						= 'Rate first post only';
$lang['Overall ranking method: posts'] 		= 'Overall ranking method: posts';
$lang['Overall ranking method: topics'] 	= 'Overall ranking method: topics';
$lang['Overall ranking method: users']		= 'Overall ranking method: users';
$lang['Max daily ratings per user'] 			= 'Max daily ratings per user';
$lang['Open in new window'] 							= 'Open in new window';
$lang['Min. post count'] 									= 'Min. post count';
$lang['Min. days registered'] 						= 'Min. days registered';
$lang['Bias system active'] 							= 'Bias system active';
$lang['Show bias usernames?'] 						= 'Show bias usernames?';
$lang['Show dropdown in viewtopic?']			= 'Show dropdown in viewtopic?';
$lang['Show dropdown in viewforum?'] 			= 'Show dropdown in viewforum?';

?>