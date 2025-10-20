<?php
/**
 * Theme Customizer
 *
 * @package ARO_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add customizer settings
 */
function aro_customize_register($wp_customize) {
    
    // Hero Section
    $wp_customize->add_section('aro_hero_section', array(
        'title'    => __('Hero Section', 'aro-theme'),
        'priority' => 30,
    ));

    // Hero Badge
    $wp_customize->add_setting('aro_hero_badge', array(
        'default'           => 'Minimal Luxury',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('aro_hero_badge', array(
        'label'   => __('Hero Badge Text', 'aro-theme'),
        'section' => 'aro_hero_section',
        'type'    => 'text',
    ));

    // Hero Title
    $wp_customize->add_setting('aro_hero_title', array(
        'default'           => 'ARO <span class="text-neutral-300">STYLE</span>',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('aro_hero_title', array(
        'label'       => __('Hero Title', 'aro-theme'),
        'section'     => 'aro_hero_section',
        'type'        => 'text',
        'description' => __('You can use HTML tags for styling', 'aro-theme'),
    ));

    // Hero Description
    $wp_customize->add_setting('aro_hero_description', array(
        'default'           => 'کالکشن‌های محدود با برش‌های معماری، پارچه‌های پریمیوم و پالت لوکس.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('aro_hero_description', array(
        'label'   => __('Hero Description', 'aro-theme'),
        'section' => 'aro_hero_section',
        'type'    => 'textarea',
    ));

    // Hero Image
    $wp_customize->add_setting('aro_hero_image', array(
        'default'           => get_template_directory_uri() . '/assets/images/hero-placeholder.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'aro_hero_image', array(
        'label'   => __('Hero Image', 'aro-theme'),
        'section' => 'aro_hero_section',
    )));

    // Hero Image Caption
    $wp_customize->add_setting('aro_hero_image_caption', array(
        'default'           => 'SS25 • ARCH CUT BLAZER',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('aro_hero_image_caption', array(
        'label'   => __('Hero Image Caption', 'aro-theme'),
        'section' => 'aro_hero_section',
        'type'    => 'text',
    ));

    // Hero Rating
    $wp_customize->add_setting('aro_hero_rating', array(
        'default'           => '4.9 rated',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('aro_hero_rating', array(
        'label'   => __('Hero Rating Text', 'aro-theme'),
        'section' => 'aro_hero_section',
        'type'    => 'text',
    ));

    // About Section
    $wp_customize->add_section('aro_about_section', array(
        'title'    => __('About Section', 'aro-theme'),
        'priority' => 40,
    ));

    // About Title
    $wp_customize->add_setting('aro_about_title', array(
        'default'           => 'About ARO',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('aro_about_title', array(
        'label'   => __('About Title', 'aro-theme'),
        'section' => 'aro_about_section',
        'type'    => 'text',
    ));

    // About Description
    $wp_customize->add_setting('aro_about_description', array(
        'default'           => 'ARO رویکردی مینیمال و لوکس را با مهندسی برش و دوخت دقیق ترکیب می‌کند. استفاده از متریال پایدار و تیپ‌فیس‌های ظریف، تجربه‌ای معماری‌واره برای پوشش روزمره می‌سازد.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('aro_about_description', array(
        'label'   => __('About Description', 'aro-theme'),
        'section' => 'aro_about_section',
        'type'    => 'textarea',
    ));

    // Footer Section
    $wp_customize->add_section('aro_footer_section', array(
        'title'    => __('Footer Settings', 'aro-theme'),
        'priority' => 50,
    ));

    // Copyright Text
    $wp_customize->add_setting('aro_copyright_text', array(
        'default'           => '© ' . date('Y') . ' ARO. All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('aro_copyright_text', array(
        'label'   => __('Copyright Text', 'aro-theme'),
        'section' => 'aro_footer_section',
        'type'    => 'text',
    ));

    // Social Media Links
    $social_networks = array(
        'facebook'  => 'Facebook',
        'instagram' => 'Instagram',
        'youtube'   => 'YouTube',
        'linkedin'  => 'LinkedIn',
        'twitter'   => 'Twitter',
    );

    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting("aro_social_{$network}", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control("aro_social_{$network}", array(
            'label'   => sprintf(__('%s URL', 'aro-theme'), $label),
            'section' => 'aro_footer_section',
            'type'    => 'url',
        ));
    }

    // Colors Section
    $wp_customize->add_section('aro_colors', array(
        'title'    => __('Theme Colors', 'aro-theme'),
        'priority' => 60,
    ));

    // Primary Color
    $wp_customize->add_setting('aro_primary_color', array(
        'default'           => '#8A2F56',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'aro_primary_color', array(
        'label'   => __('Primary Color (Mulberry)', 'aro-theme'),
        'section' => 'aro_colors',
    )));

    // Accent Color
    $wp_customize->add_setting('aro_accent_color', array(
        'default'           => '#C8A45D',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'aro_accent_color', array(
        'label'   => __('Accent Color (Gold)', 'aro-theme'),
        'section' => 'aro_colors',
    )));
}
add_action('customize_register', 'aro_customize_register');

/**
 * Output customizer CSS
 */
function aro_customizer_css() {
    $primary_color = get_theme_mod('aro_primary_color', '#8A2F56');
    $accent_color = get_theme_mod('aro_accent_color', '#C8A45D');
    ?>
    <style type="text/css">
        :root {
            --aro-primary: <?php echo esc_attr($primary_color); ?>;
            --aro-accent: <?php echo esc_attr($accent_color); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'aro_customizer_css');
