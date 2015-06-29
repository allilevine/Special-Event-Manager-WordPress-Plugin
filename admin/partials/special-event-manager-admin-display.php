<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/allilevine/Special-Event-Manager-WordPress-Plugin
 * @since      1.0.0
 *
 * @package    Special_Event_Manager
 * @subpackage Special_Event_Manager/admin/partials
 */

// - grab data -

	    global $post;
	    $custom = get_post_custom($post->ID);
	    $meta_sd = isset($custom["sem_events_startdate"][0]) ? $custom["sem_events_startdate"][0] : time();
	    $meta_ed = isset($custom["sem_events_enddate"][0]) ? $custom["sem_events_enddate"][0] : time();
	    $meta_st = $meta_sd;
	    $meta_et = $meta_ed;

	    // - grab wp time formats -
			$date_format = get_option('date_format');
	    $time_format = get_option('time_format');

	    // - convert to pretty formats -

	    $clean_sd = date("D, M d, Y", $meta_sd);
	    $clean_ed = date("D, M d, Y", $meta_ed);
	    $clean_st = date($time_format, $meta_st);
	    $clean_et = date($time_format, $meta_et);

	    // - security -

	    echo '<input type="hidden" name="SEM-events-nonce" id="SEM-events-nonce" value="' .
	    wp_create_nonce( 'SEM-events-nonce' ) . '" />';

	    // - output -

	    ?>
	    <div class="special-event-meta">
	        <ul>
	            <li><label>Start Date</label><input name="sem_events_startdate" id="startPicker" value="<?php echo $clean_sd; ?>" /></li>
	            <li><label>Start Time</label><input name="sem_events_starttime" value="<?php echo $clean_st; ?>" /></li>
	            <li><label>End Date</label><input name="sem_events_enddate" id="endPicker" value="<?php echo $clean_ed; ?>" /></li>
	            <li><label>End Time</label><input name="sem_events_endtime" value="<?php echo $clean_et; ?>" /></li>
	        </ul>
	    </div>
