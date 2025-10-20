<?php
/**
 * ARO Glassmorphism Theme Functions
 *
 * @package ARO_Theme
 * @version 3.7
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Theme version
define('ARO_THEME_VERSION', '3.7');
define('ARO_THEME_DIR', get_template_directory());
define('ARO_THEME_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function aro_theme_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 800, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'aro-theme'),
        'footer' => esc_html__('Footer Menu', 'aro-theme'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for WooCommerce if available
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Add support for Elementor
    add_theme_support('elementor');

    // Make theme available for translation
    load_theme_textdomain('aro-theme', ARO_THEME_DIR . '/languages');
}
add_action('after_setup_theme', 'aro_theme_setup');

/**
 * Enqueue scripts and styles
 */
function aro_theme_scripts() {
    // Main stylesheet
    wp_enqueue_style('aro-theme-style', get_stylesheet_uri(), array(), ARO_THEME_VERSION);

    // Additional theme styles
    wp_enqueue_style('aro-theme-main', ARO_THEME_URI . '/assets/css/main.css', array(), ARO_THEME_VERSION);

    // GSAP for animations (from CDN)
    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), '3.12.5', true);

    // Main theme script
    wp_enqueue_script('aro-theme-script', ARO_THEME_URI . '/assets/js/main.js', array('jquery', 'gsap'), ARO_THEME_VERSION, true);

    // Localize script for AJAX and theme data
    wp_localize_script('aro-theme-script', 'aroTheme', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('aro-theme-nonce'),
        'homeUrl' => home_url('/'),
        'themeUri' => ARO_THEME_URI,
    ));

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'aro_theme_scripts');

/**
 * Register widget areas
 */
function aro_theme_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'aro-theme'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'aro-theme'),
        'before_widget' => '<section id="%1$s" class="widget glass-card %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    // Footer widget areas
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(esc_html__('Footer Widget %d', 'aro-theme'), $i),
            'id'            => 'footer-' . $i,
            'description'   => sprintf(esc_html__('Footer widget area %d', 'aro-theme'), $i),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
    }
}
add_action('widgets_init', 'aro_theme_widgets_init');

/**
 * Customize the excerpt length
 */
function aro_excerpt_length($length) {
    return 140;
}
add_filter('excerpt_length', 'aro_excerpt_length', 999);

/**
 * Customize the excerpt more text
 */
function aro_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'aro_excerpt_more');

/**
 * Add custom image sizes
 */
function aro_image_sizes() {
    add_image_size('aro-hero', 1600, 2133, true); // 3:4 ratio for hero images
    add_image_size('aro-product', 1200, 1600, true); // 3:4 ratio for products
    add_image_size('aro-blog', 1200, 675, true); // 16:9 ratio for blog
}
add_action('after_setup_theme', 'aro_image_sizes');

/**
 * Register Elementor Widgets
 */
function aro_register_elementor_widgets() {
    if (did_action('elementor/loaded')) {
        require_once ARO_THEME_DIR . '/inc/elementor/class-aro-slider-widget.php';
        require_once ARO_THEME_DIR . '/inc/elementor/class-aro-hero-widget.php';
        require_once ARO_THEME_DIR . '/inc/elementor/class-aro-product-grid-widget.php';
        require_once ARO_THEME_DIR . '/inc/elementor/class-aro-blog-feed-widget.php';
    }
}
add_action('elementor/widgets/register', 'aro_register_elementor_widgets');

/**
 * Add Elementor support for custom locations
 */
function aro_elementor_locations() {
    if (function_exists('elementor_theme_do_location')) {
        return true;
    }
    return false;
}

/**
 * Customizer additions
 */
require ARO_THEME_DIR . '/inc/customizer.php';

/**
 * Template tags
 */
require ARO_THEME_DIR . '/inc/template-tags.php';

/**
 * Custom functions
 */
require ARO_THEME_DIR . '/inc/custom-functions.php';

/**
 * Add body classes
 */
function aro_body_classes($classes) {
    // Add class for RTL
    if (is_rtl()) {
        $classes[] = 'rtl';
    }

    // Add class if Elementor is active
    if (did_action('elementor/loaded')) {
        $classes[] = 'elementor-enabled';
    }

    // Add class for page template
    if (is_page_template()) {
        $classes[] = 'page-template';
    }

    return $classes;
}
add_filter('body_class', 'aro_body_classes');

/**
 * REST API endpoint for custom queries
 */
function aro_register_rest_routes() {
    register_rest_route('aro/v1', '/products', array(
        'methods' => 'GET',
        'callback' => 'aro_get_products',
        'permission_callback' => '__return_true',
    ));
}
add_action('rest_api_init', 'aro_register_rest_routes');

/**
 * Get products for REST API
 */
function aro_get_products($request) {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $request->get_param('per_page') ?: 20,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $query = new WP_Query($args);
    $products = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $products[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'excerpt' => get_the_excerpt(),
                'image' => get_the_post_thumbnail_url(get_the_ID(), 'aro-product'),
                'link' => get_permalink(),
            );
        }
        wp_reset_postdata();
    }

    return rest_ensure_response($products);
}

/**
 * Update cart count in header
 */
function aro_update_cart_count() {
    if (function_exists('WC')) {
        $cart_count = WC()->cart->get_cart_contents_count();
        wp_localize_script('aro-theme-script', 'aroCart', array(
            'count' => $cart_count,
        ));
    }
}
add_action('wp_enqueue_scripts', 'aro_update_cart_count');
