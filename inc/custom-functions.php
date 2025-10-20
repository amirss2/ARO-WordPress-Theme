<?php
/**
 * Custom functions for ARO theme
 *
 * @package ARO_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * AJAX handler for add to cart
 */
function aro_ajax_add_to_cart() {
    check_ajax_referer('aro-theme-nonce', 'nonce');
    
    $product_id = isset($_POST['product_id']) ? absint($_POST['product_id']) : 0;
    
    if ($product_id && function_exists('WC')) {
        $result = WC()->cart->add_to_cart($product_id);
        
        if ($result) {
            wp_send_json_success(array(
                'cart_count' => WC()->cart->get_cart_contents_count(),
                'message' => __('Product added to cart', 'aro-theme')
            ));
        }
    }
    
    wp_send_json_error(array(
        'message' => __('Failed to add product to cart', 'aro-theme')
    ));
}
add_action('wp_ajax_aro_add_to_cart', 'aro_ajax_add_to_cart');
add_action('wp_ajax_nopriv_aro_add_to_cart', 'aro_ajax_add_to_cart');

/**
 * Product slider shortcode
 */
function aro_product_slider_shortcode($atts) {
    $atts = shortcode_atts(array(
        'category' => '',
        'count' => 20,
    ), $atts);

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => absint($atts['count']),
        'orderby' => 'date',
        'order' => 'DESC',
    );

    if (!empty($atts['category'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => sanitize_text_field($atts['category']),
            ),
        );
    }

    $products = new WP_Query($args);

    ob_start();
    
    if ($products->have_posts()) :
        ?>
        <div class="aro-slider-deck">
            <?php
            $index = 0;
            while ($products->have_posts()) : $products->the_post();
                global $product;
                $badge_types = array('pink', 'indigo', 'orange');
                $badge_texts = array('New', 'AI', 'UI');
                $badge_index = $index % 3;
                ?>
                <div class="aro-slide-card">
                    <div class="aro-slide-content">
                        <a href="<?php the_permalink(); ?>" class="aro-slide-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('aro-product'); ?>
                            <?php else : ?>
                                <img src="https://images.unsplash.com/photo-15<?php echo (($index % 9) + 1); ?>724385561-51dba16a26b8?q=80&w=1200&auto=format&fit=crop" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                            
                            <span class="aro-slide-badge badge-<?php echo esc_attr($badge_types[$badge_index]); ?>">
                                <?php echo esc_html($badge_texts[$badge_index]); ?>
                            </span>
                            
                            <div class="aro-slide-info">
                                <h3 class="aro-slide-title"><?php the_title(); ?></h3>
                                <p class="aro-slide-subtitle">
                                    <?php echo esc_html($product->get_attribute('pa_material') ?: 'Premium cut • SS25'); ?>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
                $index++;
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
        <div class="aro-slider-nav">
            <button class="aro-slider-btn slider-btn-prev" aria-label="<?php esc_attr_e('Previous', 'aro-theme'); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <button class="aro-slider-btn slider-btn-next" aria-label="<?php esc_attr_e('Next', 'aro-theme'); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>
        <?php
    else :
        echo '<p>' . esc_html__('No products found.', 'aro-theme') . '</p>';
    endif;

    return ob_get_clean();
}
add_shortcode('aro_product_slider', 'aro_product_slider_shortcode');

/**
 * Add custom product attributes
 */
function aro_register_product_attributes() {
    if (!function_exists('wc_create_attribute')) {
        return;
    }

    $attributes = array(
        array(
            'slug' => 'pa_material',
            'name' => __('Material', 'aro-theme'),
        ),
        array(
            'slug' => 'pa_season',
            'name' => __('Season', 'aro-theme'),
        ),
    );

    foreach ($attributes as $attribute) {
        if (!taxonomy_exists($attribute['slug'])) {
            wc_create_attribute(array(
                'name' => $attribute['name'],
                'slug' => $attribute['slug'],
                'type' => 'select',
            ));
        }
    }
}
add_action('init', 'aro_register_product_attributes');

/**
 * Modify product query for collections
 */
function aro_modify_product_query($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('product')) {
        $query->set('posts_per_page', 12);
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
    }
}
add_action('pre_get_posts', 'aro_modify_product_query');

/**
 * Add custom body classes for pages
 */
function aro_custom_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'aro-home';
    }
    
    if (is_singular('product')) {
        $classes[] = 'aro-single-product';
    }
    
    return $classes;
}
add_filter('body_class', 'aro_custom_body_classes');

/**
 * Modify excerpt length for blog cards
 */
function aro_blog_excerpt_length($length) {
    if (is_front_page() || is_home()) {
        return 20;
    }
    return $length;
}
add_filter('excerpt_length', 'aro_blog_excerpt_length', 999);

/**
 * Add animation classes to elements
 */
function aro_add_animation_class($content) {
    if (is_singular() && !is_front_page()) {
        return $content;
    }
    
    return '<div class="fade-up">' . $content . '</div>';
}

/**
 * Get placeholder image URL
 */
function aro_get_placeholder_image($width = 1200, $height = 1600) {
    return "https://images.unsplash.com/photo-1572635196237-14b3f281503f?q=80&w={$width}&h={$height}&auto=format&fit=crop";
}

/**
 * Custom logo output
 */
function aro_custom_logo() {
    if (has_custom_logo()) {
        the_custom_logo();
    } else {
        echo '<a href="' . esc_url(home_url('/')) . '" class="custom-logo-link" rel="home">';
        echo '<span class="site-title">' . esc_html(get_bloginfo('name')) . '</span>';
        echo '</a>';
    }
}

/**
 * Add preconnect for external resources
 */
function aro_resource_hints($urls, $relation_type) {
    if ('preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://images.unsplash.com',
            'crossorigin',
        );
        $urls[] = array(
            'href' => 'https://cdnjs.cloudflare.com',
            'crossorigin',
        );
    }
    return $urls;
}
add_filter('wp_resource_hints', 'aro_resource_hints', 10, 2);

/**
 * Disable WordPress emoji scripts
 */
function aro_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'aro_disable_emojis');

/**
 * Performance: Remove query strings from static resources
 */
function aro_remove_script_version($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'aro_remove_script_version', 15, 1);
add_filter('style_loader_src', 'aro_remove_script_version', 15, 1);
