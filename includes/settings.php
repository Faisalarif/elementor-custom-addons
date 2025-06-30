<?php
add_action('admin_menu', function () {
    add_options_page(
        'Elementor Custom Addons',
        'Elementor Add-ons',
        'manage_options',
        'eca-settings',
        'eca_settings_page'
    );
});

function eca_settings_page() {
    ?>
    <div class="wrap">
        <h1>Elementor Add-ons</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('eca_settings');
            do_settings_sections('eca-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

add_action('admin_init', function () {
    register_setting('eca_settings', 'eca_enabled_widgets');
    register_setting('eca_settings', 'eca_reading_time_settings');

    add_settings_section('eca_section', '', null, 'eca-settings');

    add_settings_field('eca_reading_time', 'Enable Reading Timeline', function () {
        $enabled = (array) get_option('eca_enabled_widgets', []);
        $checked = in_array('reading_time', $enabled) ? 'checked' : '';
        echo "<input type='checkbox' name='eca_enabled_widgets[]' value='reading_time' $checked> Enable Reading Timeline";
    }, 'eca-settings', 'eca_section');

    add_settings_field('eca_reading_options', 'Reading Timeline Options', function () {
        $enabled = (array) get_option('eca_enabled_widgets', []);
        if (!in_array('reading_time', $enabled)) {
            echo "<em>Enable the widget to configure options.</em>";
            return;
        }

        $settings = get_option('eca_reading_time_settings', []);
        $color = $settings['bar_color'] ?? '#00aaff';
        $height = $settings['bar_height'] ?? 5;

        echo "Bar Color: <input type='color' name='eca_reading_time_settings[bar_color]' value='" . esc_attr($color) . "'><br><br>";
        echo "Bar Height (px): <input type='number' name='eca_reading_time_settings[bar_height]' value='" . intval($height) . "' min='1' max='100'><br><br>";

        echo "<strong>Enable on Post Types:</strong><br>";
        $post_types = get_post_types(['public' => true], 'objects');
        foreach ($post_types as $slug => $pt) {
            if (in_array($slug, ['attachment', 'nav_menu_item', 'elementor_library'])) continue;
            $checked = in_array($slug, $settings['post_types'] ?? []) ? 'checked' : '';
            echo "<label><input type='checkbox' name='eca_reading_time_settings[post_types][]' value='{$slug}' {$checked}> " . esc_html($pt->labels->name) . "</label><br>";
        }
    }, 'eca-settings', 'eca_section');
});