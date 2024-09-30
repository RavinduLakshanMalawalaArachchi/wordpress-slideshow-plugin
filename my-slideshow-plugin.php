<?php
/*
Plugin Name: My Slideshow Plugin
Description: Adds a slideshow to each page with user-configurable images.
Version: 1.1
Author: Your Name
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin paths
define('MY_SLIDESHOW_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('MY_SLIDESHOW_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include admin settings
require_once MY_SLIDESHOW_PLUGIN_PATH . 'admin/admin-settings.php';

// Include shortcode
require_once MY_SLIDESHOW_PLUGIN_PATH . 'public/shortcode.php';

// Enqueue scripts and styles
function my_slideshow_plugin_enqueue_scripts() {
    wp_enqueue_style('my-slideshow-plugin-styles', MY_SLIDESHOW_PLUGIN_URL . 'public/styles.css');
    wp_enqueue_script('my-slideshow-plugin-scripts', MY_SLIDESHOW_PLUGIN_URL . 'public/scripts.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'my_slideshow_plugin_enqueue_scripts');
