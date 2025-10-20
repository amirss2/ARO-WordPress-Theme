<?php
/**
 * The template for displaying all pages
 *
 * @package ARO_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container max-w-5xl mx-auto px-6 py-12">
        <?php
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('glass-card p-8 rounded-3xl'); ?>>
                <header class="entry-header mb-6">
                    <?php the_title('<h1 class="entry-title text-4xl font-light">', '</h1>'); ?>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail mb-6">
                        <?php the_post_thumbnail('aro-hero', array('class' => 'w-full rounded-2xl')); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content opacity-90 leading-relaxed">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links glass-card p-4 rounded-xl mt-6">' . esc_html__('Pages:', 'aro-theme'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <?php if (get_edit_post_link()) : ?>
                    <footer class="entry-footer mt-6 pt-6 border-t border-white/10">
                        <?php
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
                            '<span class="edit-link glass-button inline-block">',
                            '</span>'
                        );
                        ?>
                    </footer>
                <?php endif; ?>
            </article>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
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
