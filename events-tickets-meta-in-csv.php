<?php
/*
 * Plugin Name: Event Tickets Plus Meta CSV
 * Version: 1.1
 * Plugin URI: http://www.nightcirque.com/
 * Description: Add-on for Event Tickets Plus 4.1+. Include ticket meta information in CSV export of event attendee list.
 * Author: Night Cirque
 * Author URI: http://www.nightcirque.com/
 * Requires at least: 4.3
 * Tested up to: 4.3.1
 *
 * Text Domain: nightcirque-plugin-event-meta
 * @author Christian Høj
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/*
* Adds columns with ticket meta information to the attendee export data (CSV only).
*
* Filters via the tribe_events_tickets_generate_filtered_attendees_list hook.
*
*/

add_filter('tribe_events_tickets_generate_filtered_attendees_list', function ($post_id) {
  $columns = Tribe__Tickets_Plus__Main::instance()->meta()->get_meta_fields_by_event($post_id);
  if (!empty($columns)) {
    $callback = array(Tribe__Tickets_Plus__Main::instance()->meta()->export(), 'add_columns');
    add_filter('manage_'.get_current_screen()->id.'_columns', $callback, 30);
  }
});
