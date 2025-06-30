<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class ECA_Reading_Timeline_Widget extends Widget_Base {
    public function get_name() {
        return 'eca_reading_timeline';
    }

    public function get_title() {
        return 'Reading Timeline';
    }

    public function get_icon() {
        return 'eicon-clock';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {
        $this->start_controls_section('section_content', [
            'label' => 'Settings',
        ]);

        $this->add_control('label_text', [
            'label' => 'Label Text',
            'type' => Controls_Manager::TEXT,
            'default' => 'Reading time:',
        ]);

        $this->add_control('suffix_text', [
            'label' => 'Time Suffix',
            'type' => Controls_Manager::TEXT,
            'default' => 'min read',
            'description' => 'e.g. "min", "minutes", "mins read"',
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $label = esc_html($settings['label_text']);
        $suffix = esc_attr($settings['suffix_text']);

        echo "<div class='eca-reading-label'>{$label} <span id='eca-reading-time' data-suffix='{$suffix}'></span></div>";
    }
}