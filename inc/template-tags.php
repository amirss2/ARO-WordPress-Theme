<?php
/**
 * Custom template tags for this theme
 *
 * @package ARO_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Prints HTML with meta information for the current post-date/time
 */
function aro_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf(
        $time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date(DATE_W3C)),
        esc_html(get_the_modified_date())
    );

    $posted_on = sprintf(
        /* translators: %s: post date. */
        esc_html_x('Posted on %s', 'post date', 'aro-theme'),
        '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span>';
}

/**
 * Prints HTML with meta information for the current author
 */
function aro_posted_by() {
    $byline = sprintf(
        /* translators: %s: post author. */
        esc_html_x('by %s', 'post author', 'aro-theme'),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
    );

    echo '<span class="byline"> ' . $byline . '</span>';
}

/**
 * Prints HTML with meta information for categories and tags
 */
function aro_entry_footer() {
    if ('post' === get_post_type()) {
        $categories_list = get_the_category_list(esc_html__(', ', 'aro-theme'));
        if ($categories_list) {
            printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'aro-theme') . '</span>', $categories_list);
        }

        $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'aro-theme'));
        if ($tags_list) {
            printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'aro-theme') . '</span>', $tags_list);
        }
    }

    if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
        echo '<span class="comments-link">';
        comments_popup_link(
            sprintf(
                wp_kses(
                    /* translators: %s: post title */
                    __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'aro-theme'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            )
        );
        echo '</span>';
    }

    edit_post_link(
        sprintf(
            wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                __('Edit <span class="screen-reader-text">%s</span>', 'aro-theme'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            wp_kses_post(get_the_title())
        ),
        '<span class="edit-link">',
        '</span>'
    );
}

/**
 * Display product badge based on conditions
 */
function aro_product_badge() {
    global $product;
    
    if (!$product) {
        return;
    }

    $badges = array();

    // New product (less than 30 days old)
    $post_date = get_the_date('U');
    $current_date = current_time('timestamp');
    $days_old = floor(($current_date - $post_date) / DAY_IN_SECONDS);
    
    if ($days_old <= 30) {
        $badges[] = array('text' => __('New', 'aro-theme'), 'class' => 'badge-orange');
    }

    // On sale
    if ($product->is_on_sale()) {
        $badges[] = array('text' => __('Sale', 'aro-theme'), 'class' => 'badge-pink');
    }

    // Featured
    if ($product->is_featured()) {
        $badges[] = array('text' => __('Featured', 'aro-theme'), 'class' => 'badge-indigo');
    }

    if (!empty($badges)) {
        foreach ($badges as $badge) {
            echo '<span class="product-badge ' . esc_attr($badge['class']) . '">' . esc_html($badge['text']) . '</span>';
        }
    }
}

/**
 * Get social media links
 */
function aro_get_social_links() {
    $social_networks = array(
        'facebook'  => array('icon' => 'facebook', 'label' => 'Facebook'),
        'instagram' => array('icon' => 'instagram', 'label' => 'Instagram'),
        'youtube'   => array('icon' => 'youtube', 'label' => 'YouTube'),
        'linkedin'  => array('icon' => 'linkedin', 'label' => 'LinkedIn'),
        'twitter'   => array('icon' => 'twitter', 'label' => 'Twitter'),
    );

    $links = array();
    foreach ($social_networks as $network => $data) {
        $url = get_theme_mod("aro_social_{$network}", '');
        if (!empty($url)) {
            $links[$network] = array(
                'url' => $url,
                'icon' => $data['icon'],
                'label' => $data['label'],
            );
        }
    }

    return $links;
}

/**
 * Display social media links
 */
function aro_social_links() {
    $links = aro_get_social_links();
    
    if (empty($links)) {
        return;
    }

    echo '<div class="social-links">';
    foreach ($links as $network => $data) {
        printf(
            '<a href="%s" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="%s">%s</a>',
            esc_url($data['url']),
            esc_attr($data['label']),
            aro_get_social_icon($data['icon'])
        );
    }
    echo '</div>';
}

/**
 * Get SVG icon for social media
 */
function aro_get_social_icon($icon) {
    $icons = array(
        'facebook' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>',
        'instagram' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>',
        'youtube' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>',
        'linkedin' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>',
        'twitter' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>',
    );

    return isset($icons[$icon]) ? $icons[$icon] : '';
}
