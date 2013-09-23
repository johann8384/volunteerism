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

include('volunteerism_tokens.inc');

// Add the Administration Menu for configuring this plugin
add_action('admin_menu', 'volunteerism_admin_actions');

// Add the filter which will insert the plugin content into a page or post
add_filter(‘the_content’,'volunteerism_add_content’);

function volunteerism_admin_actions() {
  add_options_page('Volunteerism Admin', 'Volunteerism Admin', 'edit_plugins', 'volunteerism_settings', 'volunteerism_settings');
}

function volunteerism_settings() {
  include('volunteerism_settings.php');
}

// Replace defined tokens with plugin content
function volunteerism_add_content( $content ) {

/*
Array
(
    [0] => Array
        (
            [0] => %volunteerism_tk_project_list|foo=5|test%
            [1] => %volunteerism_tk_listing_all_the_things%
        )

    [1] => Array
        (
            [0] => project_list|foo=5|test
            [1] => listing_all_the_things
        )

)

replaces %volunteerism_tk_listing_all_the_things% with the return value of call_user_func('listing_all_the_things');
replaces %volunteerism_tk_project_list|foo=5|test% with the return value of call_user_func_array('project_list', Array('foo' => 5, 'test' => true));

*/

  preg_match_all('/^%volunteerism_tk_(.+)%$/im', $content, $matches);

  if ($matches === false || ! is_array($matches))
  {
    return $content;
  }

  foreach ( $matches[1] as $possible_callback_function )
  {
    $token = 'volunteerism_tk_' . $possible_callback_function;
    $parts = explode('|', $possible_callback_function);

    $callback_function = $parts[0];

    foreach ($parts as $key => $value)
    {
      if ($value == $possible_callback_function)
      {
        $callback_function_args = false;
      }
      else
      {
        $arg_value = explode('=', $value);
        if ($arg_value[0] == $value)
        {
          $callback_function_args[$value] = true;
        }
        else
        {
          $callback_function_args[$arg_value[0]] = $arg_value[1];
        }
      }
    }

    if (function_exists($callback_function)) {
      if ($callback_function_args !== false)
      {
        $token_replacment = call_user_func_array($callback_function, $callback_function_args);
      }
      else
      {
        $token_replacement = call_user_func($callback_function)
      }
      str_replace($token, $token_replacement, $content));
    }
  }

  return $content;
}

?>
