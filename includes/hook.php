<?php
add_filter('the_content', function ($content) {
    if (is_admin()) return $content;

    $enabled = (array) get_option('eca_enabled_widgets', []);
    $settings = get_option('eca_reading_time_settings', []);
    $post_type = get_post_type();

    if (!in_array('reading_time', $enabled) || !in_array($post_type, $settings['post_types'] ?? [])) {
        return $content;
    }

    wp_enqueue_script('eca-reading-js', plugin_dir_url(__FILE__) . '../assets/js/reading-time.js', [], '1.0', true);
    wp_register_style('eca-reading-css', false);
    wp_enqueue_style('eca-reading-css');

    $bar_color = esc_attr($settings['bar_color'] ?? '#00aaff');
    $bar_height = intval($settings['bar_height'] ?? 5);
    wp_add_inline_style('eca-reading-css', "
        #eca-progress-bar {
            background-color: {$bar_color};
            height: {$bar_height}px;
        }
    ");

    ob_start();
    echo '<div id="eca-progress-bar" style="position:fixed;top:0;left:0;width:0%;z-index:9999;"></div>';
    return ob_get_clean() . $content;
});