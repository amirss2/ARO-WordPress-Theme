<?php
/**
 * ARO Product Grid Elementor Widget
 *
 * @package ARO_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

class ARO_Product_Grid_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'aro_product_grid';
    }

    public function get_title() {
        return esc_html__('ARO Product Grid', 'aro-theme');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
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
            'products_count',
            [
                'label' => esc_html__('Products Count', 'aro-theme'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<div class="aro-product-grid-widget">';
        echo '<p>' . esc_html__('Product Grid Widget', 'aro-theme') . '</p>';
        echo '</div>';
    }
}

function aro_register_product_grid_widget($widgets_manager) {
    $widgets_manager->register(new ARO_Product_Grid_Widget());
}
add_action('elementor/widgets/register', 'aro_register_product_grid_widget');
