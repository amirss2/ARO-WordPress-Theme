<?php
/**
 * The template for displaying all single posts
 *
 * @package ARO_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container max-w-4xl mx-auto px-6 py-12">
        <?php
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', get_post_type());

            // Post navigation
            the_post_navigation(array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'aro-theme') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'aro-theme') . '</span> <span class="nav-title">%title</span>',
            ));

            // Comments section
            if (comments_open() || get_comments_number()) :
                ?>
                <div class="comments-area glass-card p-6 rounded-3xl mt-8">
                    <?php comments_template(); ?>
                </div>
                <?php
            endif;
        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();
