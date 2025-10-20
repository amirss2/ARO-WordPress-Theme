<?php
/**
 * ARO Blog Feed Elementor Widget
 *
 * @package ARO_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

class ARO_Blog_Feed_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'aro_blog_feed';
    }

    public function get_title() {
        return esc_html__('ARO Blog Feed', 'aro-theme');
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'aro-theme'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_count',
            [
                'label' => esc_html__('Posts Count', 'aro-theme'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<div class="aro-blog-feed-widget">';
        echo '<p>' . esc_html__('Blog Feed Widget', 'aro-theme') . '</p>';
        echo '</div>';
    }
}

function aro_register_blog_feed_widget($widgets_manager) {
    $widgets_manager->register(new ARO_Blog_Feed_Widget());
}
add_action('elementor/widgets/register', 'aro_register_blog_feed_widget');
