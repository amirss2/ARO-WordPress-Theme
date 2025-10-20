<?php
/**
 * ARO Product Slider Elementor Widget
 *
 * @package ARO_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

class ARO_Slider_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'aro_product_slider';
    }

    public function get_title() {
        return esc_html__('ARO Product Slider', 'aro-theme');
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_keywords() {
        return ['aro', 'product', 'slider', 'carousel'];
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
            'product_category',
            [
                'label' => esc_html__('Product Category', 'aro-theme'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'women',
                'description' => esc_html__('Enter the product category slug', 'aro-theme'),
            ]
        );

        $this->add_control(
            'product_count',
            [
                'label' => esc_html__('Number of Products', 'aro-theme'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 20,
                'min' => 1,
                'max' => 50,
                'step' => 1,
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'aro-theme'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_border_radius',
            [
                'label' => esc_html__('Card Border Radius', 'aro-theme'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .aro-slide-image' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        echo '<div class="aro-slider-container elementor-aro-slider">';
        echo do_shortcode('[aro_product_slider category="' . esc_attr($settings['product_category']) . '" count="' . esc_attr($settings['product_count']) . '"]');
        echo '</div>';
    }

    protected function content_template() {
        ?>
        <#
        var category = settings.product_category || 'women';
        var count = settings.product_count || 20;
        #>
        <div class="aro-slider-container elementor-aro-slider">
            <p><?php esc_html_e('ARO Product Slider Widget', 'aro-theme'); ?></p>
            <p><?php esc_html_e('Category:', 'aro-theme'); ?> {{ category }}</p>
            <p><?php esc_html_e('Count:', 'aro-theme'); ?> {{ count }}</p>
        </div>
        <?php
    }
}

// Register the widget
function aro_register_slider_widget($widgets_manager) {
    $widgets_manager->register(new ARO_Slider_Widget());
}
add_action('elementor/widgets/register', 'aro_register_slider_widget');
