<?php 
/**
 * Plugin Name: Volunteerism
 * Plugin URI: http://www.givinginc.co
 * Description: Plugin for providing volunteer management functionality
 * Author: johann8384
 * Author URI: www.twitter.com/johann8384
 * Version: 1.0
 * License: GPL2
 **/

add_action('admin_menu', 'volunteerism_admin_actions');

function volunteerism_admin_actions() {
  add_options_page("Volunteerism Admin", "Volunteerism Admin", 1, "Volunteerism Admin", "volunteerism_settings");
}

function volunteerism_settings() {
  include('volunteerism_settings.php');
}  
?>
