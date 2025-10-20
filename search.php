<?php
/**
 * The template for displaying search results pages
 *
 * @package ARO_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container mx-auto px-6 py-12">
        <?php if (have_posts()) : ?>
            <header class="page-header glass-card p-8 rounded-3xl mb-10">
                <h1 class="page-title text-4xl font-light">
                    <?php
                    /* translators: %s: search query. */
                    printf(esc_html__('Search Results for: %s', 'aro-theme'), '<span class="search-query">' . get_search_query() . '</span>');
                    ?>
                </h1>
            </header>

            <div class="search-results grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content', 'search');
                endwhile;
                ?>
            </div>

            <?php
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => __('&laquo; Previous', 'aro-theme'),
                'next_text' => __('Next &raquo;', 'aro-theme'),
                'class'     => 'pagination mt-10',
            ));
        else :
            get_template_part('template-parts/content', 'none');
        endif;
        ?>
    </div>
</main>

<?php
get_footer();
