<?php
/**
 * Plugin Name: Elementor Custom Addons
 * Description: Custom Elementor widgets — starting with Reading Timeline.
 * Version: 0.1
 * Author: Faisal Arif
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Include core files
require_once plugin_dir_path(__FILE__) . 'includes/settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/hook.php';

// Elementor widget registration
add_action('elementor/widgets/register', function($widgets_manager) {
    require_once plugin_dir_path(__FILE__) . 'includes/widgets/reading-timeline.php';
    $widgets_manager->register(new \ECA_Reading_Timeline_Widget());
});