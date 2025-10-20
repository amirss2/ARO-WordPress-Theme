<?php
/**
 * The template for displaying the footer
 *
 * @package ARO_Theme
 */
?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer relative w-full max-w-6xl mx-auto flex flex-col items-center justify-center rounded-t-[2.5rem] border-t border-white/10 bg-[radial-gradient(35%_128px_at_50%_0%,rgba(255,255,255,0.08),transparent)] px-6 py-12 lg:py-16 backdrop-blur-xl">
        <div class="bg-white/20 absolute top-0 right-1/2 left-1/2 h-px w-1/3 -translate-x-1/2 -translate-y-1/2 rounded-full blur"></div>
        
        <div class="container grid w-full gap-8 xl:grid-cols-3 xl:gap-8">
            <!-- Branding Column -->
            <div class="footer-branding space-y-4 fade-up">
                <div class="inline-flex items-center gap-2 text-white/90">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        </svg>
                        <span class="tracking-widest"><?php bloginfo('name'); ?></span>
                    <?php endif; ?>
                </div>
                <p class="text-white/60 mt-8 text-sm md:mt-0">
                    <?php
                    $copyright_text = get_theme_mod('aro_copyright_text', '© ' . date('Y') . ' ' . get_bloginfo('name') . '. ' . esc_html__('All rights reserved.', 'aro-theme'));
                    echo esc_html($copyright_text);
                    ?>
                </p>
            </div>

            <!-- Footer Widgets -->
            <div class="footer-widgets mt-10 grid grid-cols-2 gap-8 md:grid-cols-4 xl:col-span-2 xl:mt-0">
                <?php for ($i = 1; $i <= 4; $i++) : ?>
                    <?php if (is_active_sidebar('footer-' . $i)) : ?>
                        <div class="footer-widget-area fade-up" style="transition-delay: <?php echo $i * 0.1; ?>s;">
                            <?php dynamic_sidebar('footer-' . $i); ?>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>

        <!-- Social Links (if none in widgets) -->
        <?php if (!is_active_sidebar('footer-4')) : ?>
        <div class="social-links mt-8 flex gap-4">
            <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="glass-button p-2" aria-label="Facebook">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                </svg>
            </a>
            <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="glass-button p-2" aria-label="Instagram">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                </svg>
            </a>
            <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="glass-button p-2" aria-label="YouTube">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                    <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                </svg>
            </a>
            <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="glass-button p-2" aria-label="LinkedIn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                    <rect x="2" y="9" width="4" height="12"></rect>
                    <circle cx="4" cy="4" r="2"></circle>
                </svg>
            </a>
        </div>
        <?php endif; ?>
    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
