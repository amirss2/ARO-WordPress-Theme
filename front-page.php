<?php
/**
 * The front page template file
 * This is the homepage template based on the original React design
 *
 * @package ARO_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <!-- HERO SECTION -->
    <section class="hero-section relative">
        <div class="container mx-auto px-6 pt-14 pb-24">
            <div class="grid md:grid-cols-2 items-center gap-10">
                <!-- Hero Content -->
                <div class="hero-content space-y-6 fade-up">
                    <div class="inline-flex items-center gap-2 text-xs uppercase tracking-widest text-neutral-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"></path>
                            <path d="M5 3v4"></path>
                            <path d="M19 17v4"></path>
                            <path d="M3 5h4"></path>
                            <path d="M17 19h4"></path>
                        </svg>
                        <span><?php echo esc_html(get_theme_mod('aro_hero_badge', 'Minimal Luxury')); ?></span>
                    </div>
                    
                    <h1 class="text-5xl md:text-7xl font-light leading-tight">
                        <?php echo wp_kses_post(get_theme_mod('aro_hero_title', 'ARO <span class="text-neutral-300">STYLE</span>')); ?>
                    </h1>
                    
                    <p class="text-neutral-300/90 max-w-lg">
                        <?php echo esc_html(get_theme_mod('aro_hero_description', 'کالکشن‌های محدود با برش‌های معماری، پارچه‌های پریمیوم و پالت لوکس.')); ?>
                    </p>
                    
                    <div class="flex flex-wrap gap-3">
                        <div class="relative inline-flex glow-cta">
                            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="glass-button bg-white text-black hover:bg-white shadow-lg px-8 py-3">
                                <?php esc_html_e('Shop Now', 'aro-theme'); ?>
                            </a>
                            <span class="pointer-events-none absolute inset-0 rounded-full ring-2 ring-[color:var(--aro-accent)]/60 blur-[1px]"></span>
                        </div>
                        
                        <a href="#lookbook" class="glass-button px-6 py-3 flex items-center gap-2">
                            <?php esc_html_e('Lookbook', 'aro-theme'); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                    
                    <!-- Marquee -->
                    <div class="aro-marquee">
                        <div class="track whitespace-nowrap">
                            <span class="mx-6 opacity-80"><?php esc_html_e('Free Shipping Over $150', 'aro-theme'); ?></span>
                            <span class="mx-6 opacity-80"><?php esc_html_e('New Drop Every Friday', 'aro-theme'); ?></span>
                            <span class="mx-6 opacity-80"><?php esc_html_e('Sustainable Fabrics', 'aro-theme'); ?></span>
                            <span class="mx-6 opacity-80"><?php esc_html_e('Limited Cards • Exclusive Access', 'aro-theme'); ?></span>
                            <span class="mx-6 opacity-80"><?php esc_html_e('Free Shipping Over $150', 'aro-theme'); ?></span>
                            <span class="mx-6 opacity-80"><?php esc_html_e('New Drop Every Friday', 'aro-theme'); ?></span>
                        </div>
                    </div>
                </div>
                
                <!-- Hero Image -->
                <div class="hero-image relative fade-up">
                    <div class="relative aspect-[3/4] rounded-[2rem] overflow-hidden border border-white/10 bg-white/5 backdrop-blur-xl">
                        <?php
                        $hero_image = get_theme_mod('aro_hero_image', get_template_directory_uri() . '/assets/images/hero-placeholder.jpg');
                        ?>
                        <img class="w-full h-full object-cover" src="<?php echo esc_url($hero_image); ?>" alt="<?php esc_attr_e('ARO hero', 'aro-theme'); ?>">
                        <div class="absolute inset-x-6 bottom-6 flex items-center justify-between">
                            <div class="text-sm opacity-90"><?php echo esc_html(get_theme_mod('aro_hero_image_caption', 'SS25 • ARCH CUT BLAZER')); ?></div>
                        </div>
                    </div>
                    <div class="absolute -left-6 -bottom-6 glass-card p-4 shadow-2xl fade-up">
                        <div class="flex items-center gap-2 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            <?php echo esc_html(get_theme_mod('aro_hero_rating', '4.9 rated')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WOMEN SLIDER SECTION -->
    <section id="women" class="py-12">
        <div class="container mx-auto px-6">
            <div class="mb-6 flex items-end justify-between">
                <h2 class="text-3xl md:text-4xl font-light"><?php esc_html_e('Women', 'aro-theme'); ?></h2>
                <a href="<?php echo esc_url(get_term_link('women', 'product_cat')); ?>" class="text-sm opacity-80 hover:opacity-100">
                    <?php esc_html_e('View All', 'aro-theme'); ?>
                </a>
            </div>
            <div class="aro-slider-container" data-category="women">
                <?php echo do_shortcode('[aro_product_slider category="women" count="20"]'); ?>
            </div>
        </div>
    </section>

    <!-- MEN SLIDER SECTION -->
    <section id="men" class="py-6">
        <div class="container mx-auto px-6">
            <div class="mb-6 flex items-end justify-between">
                <h2 class="text-3xl md:text-4xl font-light"><?php esc_html_e('Men', 'aro-theme'); ?></h2>
                <a href="<?php echo esc_url(get_term_link('men', 'product_cat')); ?>" class="text-sm opacity-80 hover:opacity-100">
                    <?php esc_html_e('View All', 'aro-theme'); ?>
                </a>
            </div>
            <div class="aro-slider-container" data-category="men">
                <?php echo do_shortcode('[aro_product_slider category="men" count="20"]'); ?>
            </div>
        </div>
    </section>

    <!-- NEW ARRIVALS SECTION -->
    <section id="collections" class="py-8 pb-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-light mb-10"><?php esc_html_e('New Arrivals', 'aro-theme'); ?></h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                // Query recent products
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 6,
                    'orderby' => 'date',
                    'order' => 'DESC',
                );
                $products = new WP_Query($args);
                
                if ($products->have_posts()) :
                    while ($products->have_posts()) : $products->the_post();
                        global $product;
                        ?>
                        <div class="product-card glass-card rounded-3xl overflow-hidden hover:translate-y-[-6px] transition-transform">
                            <div class="relative aspect-[3/4]">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('aro-product', array('class' => 'w-full h-full object-cover')); ?>
                                <?php endif; ?>
                                <div class="absolute top-3 left-3 text-[10px] px-3 py-1 rounded-full bg-black/50 backdrop-blur-md border border-white/10">
                                    <?php esc_html_e('SS25', 'aro-theme'); ?>
                                </div>
                                <div class="absolute bottom-3 right-3">
                                    <button class="aro-add-to-cart-btn glass-button px-4 py-2" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline-block mr-2">
                                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                            <line x1="3" y1="6" x2="21" y2="6"></line>
                                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                                        </svg>
                                        <?php esc_html_e('Add to cart', 'aro-theme'); ?>
                                    </button>
                                </div>
                            </div>
                            <div class="p-4 flex items-center justify-between">
                                <div>
                                    <div class="text-sm"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                                    <div class="text-xs opacity-70"><?php echo esc_html($product->get_attribute('pa_material') ?: 'Premium Fabric'); ?></div>
                                </div>
                                <div class="text-sm"><?php echo $product->get_price_html(); ?></div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- BLOG SECTION -->
    <section id="blog" class="py-8 pb-20">
        <div class="container mx-auto px-6">
            <div class="mb-10 flex items-end justify-between">
                <h2 class="text-3xl md:text-4xl font-light"><?php esc_html_e('From the Journal', 'aro-theme'); ?></h2>
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="text-sm opacity-80 hover:opacity-100">
                    <?php esc_html_e('View All', 'aro-theme'); ?>
                </a>
            </div>
            
            <div class="grid md:grid-cols-3 gap-6">
                <?php
                $blog_posts = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                ));
                
                if ($blog_posts->have_posts()) :
                    while ($blog_posts->have_posts()) : $blog_posts->the_post();
                        ?>
                        <article class="blog-card glass-card relative p-6 rounded-3xl overflow-hidden fade-up">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('aro-blog', array('class' => 'w-full h-44 object-cover rounded-2xl mb-4')); ?>
                            <?php else : ?>
                                <div class="w-full h-44 bg-white/10 rounded-2xl mb-4"></div>
                            <?php endif; ?>
                            
                            <h3 class="text-lg font-medium"><?php the_title(); ?></h3>
                            <p class="text-sm opacity-80 mt-2"><?php echo wp_trim_words(get_the_excerpt(), 20, '…'); ?></p>
                            
                            <div class="mt-4 text-sm opacity-90 inline-flex items-center gap-2">
                                <a href="<?php the_permalink(); ?>" class="underline"><?php esc_html_e('Read more', 'aro-theme'); ?></a>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </div>
                        </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Placeholder when no posts
                    for ($i = 1; $i <= 3; $i++) :
                        ?>
                        <article class="blog-card glass-card relative p-6 rounded-3xl overflow-hidden">
                            <div class="w-full h-44 rounded-2xl mb-4 animate-pulse bg-white/10"></div>
                            <div class="h-4 w-2/3 bg-white/20 rounded mb-2 animate-pulse"></div>
                            <div class="h-3 w-full bg-white/10 rounded mb-1 animate-pulse"></div>
                            <div class="h-3 w-4/5 bg-white/10 rounded animate-pulse"></div>
                        </article>
                    <?php
                    endfor;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section id="about" class="pb-24">
        <div class="container mx-auto max-w-5xl px-6">
            <div class="glass-card rounded-3xl p-10 fade-up">
                <h3 class="text-2xl font-light mb-4"><?php echo esc_html(get_theme_mod('aro_about_title', 'About ARO')); ?></h3>
                <p class="text-neutral-200/90 leading-relaxed">
                    <?php echo wp_kses_post(get_theme_mod('aro_about_description', 'ARO رویکردی مینیمال و لوکس را با مهندسی برش و دوخت دقیق ترکیب می‌کند. استفاده از متریال پایدار و تیپ‌فیس‌های ظریف، تجربه‌ای معماری‌واره برای پوشش روزمره می‌سازد.')); ?>
                </p>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
