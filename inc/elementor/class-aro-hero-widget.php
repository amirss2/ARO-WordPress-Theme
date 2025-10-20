<?php
/**
 * ARO Hero Section Elementor Widget
 *
 * @package ARO_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

class ARO_Hero_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'aro_hero';
    }

    public function get_title() {
        return esc_html__('ARO Hero Section', 'aro-theme');
    }

    public function get_icon() {
        return 'eicon-header';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function register_controls() {
        // Content controls would go here
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'aro-theme'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'hero_title',
            [
                'label' => esc_html__('Title', 'aro-theme'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('ARO STYLE', 'aro-theme'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<div class="aro-hero-widget">';
        echo '<h1>' . esc_html($settings['hero_title']) . '</h1>';
        echo '</div>';
    }
}

function aro_register_hero_widget($widgets_manager) {
    $widgets_manager->register(new ARO_Hero_Widget());
}
add_action('elementor/widgets/register', 'aro_register_hero_widget');
