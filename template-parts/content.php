<?php
/**
 * Template part for displaying posts
 *
 * @package ARO_Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('glass-card p-6 rounded-3xl mb-8'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnail mb-4">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('aro-blog', array('class' => 'w-full rounded-2xl')); ?>
            </a>
        </div>
    <?php endif; ?>

    <header class="entry-header mb-4">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title text-3xl font-light mb-2">', '</h1>');
        else :
            the_title('<h2 class="entry-title text-2xl font-light mb-2"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;
        ?>

        <?php if ('post' === get_post_type()) : ?>
            <div class="entry-meta text-sm opacity-70">
                <?php
                aro_posted_on();
                aro_posted_by();
                ?>
            </div>
        <?php endif; ?>
    </header>

    <div class="entry-content opacity-90">
        <?php
        if (is_singular()) {
            the_content();
        } else {
            the_excerpt();
        }

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'aro-theme'),
            'after'  => '</div>',
        ));
        ?>
    </div>

    <?php if (!is_singular()) : ?>
        <div class="entry-footer mt-4">
            <a href="<?php the_permalink(); ?>" class="glass-button inline-flex items-center gap-2">
                <?php esc_html_e('Read more', 'aro-theme'); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    <?php else : ?>
        <footer class="entry-footer mt-6 pt-6 border-t border-white/10 text-sm opacity-70">
            <?php aro_entry_footer(); ?>
        </footer>
    <?php endif; ?>
</article>
