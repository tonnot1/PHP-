<?php
/*
Plugin Name: First plugin
Plugin URI: http://wordpress.org/plugins/first-plugin/
Description: Ceci un premier plugin
Author: Mee
Version: 1.0
Author URI: http://mee.tt/
*/
add_action('wp_enqueue_scripts','load_script');

function load_script(){
    wp_enqueue_script('monscript',plugin_dir_url(__FILE__).'/js/monscript.js');
}
