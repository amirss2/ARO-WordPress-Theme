<?php
/**
 * The template for displaying archive pages
 *
 * @package ARO_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container mx-auto px-6 py-12">
        <?php if (have_posts()) : ?>
            <header class="page-header glass-card p-8 rounded-3xl mb-10">
                <?php
                the_archive_title('<h1 class="page-title text-4xl font-light">', '</h1>');
                the_archive_description('<div class="archive-description mt-4 opacity-90">', '</div>');
                ?>
            </header>

            <div class="posts-grid grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content', get_post_type());
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
