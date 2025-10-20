/**
 * ARO Theme Main JavaScript
 * Handles sliders, animations, and interactive elements
 */

(function($) {
    'use strict';

    // Fade-up animation on scroll
    function initFadeUpAnimations() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.15
        });

        document.querySelectorAll('.fade-up').forEach(el => {
            observer.observe(el);
        });
    }

    // Mobile menu toggle
    function initMobileMenu() {
        const toggle = document.querySelector('.mobile-menu-toggle');
        const mobileNav = document.querySelector('.mobile-navigation');

        if (toggle && mobileNav) {
            toggle.addEventListener('click', function() {
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !isExpanded);
                mobileNav.classList.toggle('hidden');
            });
        }
    }

    // Product Slider
    function initProductSlider(container) {
        if (!container || typeof gsap === 'undefined') return;

        const deck = container.querySelector('.aro-slider-deck');
        const slides = Array.from(container.querySelectorAll('.aro-slide-card'));
        const prevBtn = container.querySelector('.slider-btn-prev');
        const nextBtn = container.querySelector('.slider-btn-next');
        
        if (!deck || slides.length === 0) return;

        let currentIndex = 0;
        let isDragging = false;
        let startX = 0;
        let currentX = 0;
        const THRESHOLD = 40;

        function updateSlides(withDrag = false) {
            slides.forEach((slide, i) => {
                let position = i - currentIndex;
                const half = Math.floor(slides.length / 2);
                
                // Wrap around positioning
                if (position < -half) position += slides.length;
                else if (position > half) position -= slides.length;

                const x = position * 320 + (withDrag ? currentX * 0.4 : 0);
                const y = position === 0 ? 20 : 0;
                const scale = position === 0 ? 1.03 : 0.95;

                if (Math.abs(position) > 2) {
                    gsap.set(slide, { x, y, scale });
                } else {
                    gsap.to(slide, {
                        x, y, scale,
                        duration: 0.4,
                        ease: 'power2.out'
                    });
                }
            });
        }

        function shift(direction) {
            const len = slides.length;
            currentIndex = direction === 'next' 
                ? (currentIndex + 1) % len 
                : (currentIndex - 1 + len) % len;
            updateSlides();
        }

        // Pointer events for drag
        deck.addEventListener('pointerdown', (e) => {
            isDragging = true;
            startX = e.clientX;
            currentX = 0;
            deck.classList.add('is-dragging');
            deck.setPointerCapture(e.pointerId);
        });

        deck.addEventListener('pointermove', (e) => {
            if (!isDragging) return;
            currentX = e.clientX - startX;
            updateSlides(true);
        });

        deck.addEventListener('pointerup', (e) => {
            if (!isDragging) return;
            
            if (currentX > THRESHOLD) {
                shift('prev');
            } else if (currentX < -THRESHOLD) {
                shift('next');
            } else {
                updateSlides();
            }
            
            isDragging = false;
            currentX = 0;
            deck.classList.remove('is-dragging');
        });

        deck.addEventListener('pointerleave', () => {
            if (isDragging) {
                isDragging = false;
                currentX = 0;
                deck.classList.remove('is-dragging');
                updateSlides();
            }
        });

        // Wheel support
        let wheelLock = false;
        deck.addEventListener('wheel', (e) => {
            if (wheelLock) return;
            
            if (Math.abs(e.deltaX) > Math.abs(e.deltaY) && Math.abs(e.deltaX) > 15) {
                wheelLock = true;
                shift(e.deltaX > 0 ? 'next' : 'prev');
                setTimeout(() => { wheelLock = false; }, 250);
            }
        });

        // Button navigation
        if (prevBtn) {
            prevBtn.addEventListener('click', () => shift('prev'));
        }
        if (nextBtn) {
            nextBtn.addEventListener('click', () => shift('next'));
        }

        // Initial render
        updateSlides();
    }

    // Add to cart button animation
    function initAddToCartButtons() {
        document.querySelectorAll('.aro-add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                
                if (this.classList.contains('is-active')) return;
                
                this.classList.add('is-active');
                
                const productId = this.dataset.productId;
                
                // AJAX add to cart (if WooCommerce is available)
                if (typeof aroTheme !== 'undefined' && productId) {
                    $.post(aroTheme.ajaxUrl, {
                        action: 'aro_add_to_cart',
                        product_id: productId,
                        nonce: aroTheme.nonce
                    }, function(response) {
                        if (response.success) {
                            // Update cart count if exists
                            const cartCount = document.querySelector('.cart-count');
                            if (cartCount && response.data.cart_count) {
                                cartCount.textContent = response.data.cart_count;
                            }
                        }
                    });
                }
                
                setTimeout(() => {
                    this.classList.remove('is-active');
                }, 1900);
            });
        });
    }

    // Glow CTA sparkles
    function initGlowCTA() {
        const glowCtas = document.querySelectorAll('.glow-cta');
        
        glowCtas.forEach(cta => {
            // Add sparkles if they don't exist
            if (!cta.querySelector('.aro-twinkle')) {
                for (let i = 0; i < 5; i++) {
                    const sparkle = document.createElement('span');
                    sparkle.className = 'aro-twinkle pointer-events-none absolute w-1.5 h-1.5 rounded-full bg-[color:var(--aro-accent)]/90 opacity-80';
                    sparkle.style.left = `${10 + i * 16}%`;
                    sparkle.style.top = `${-6 - (i % 2) * 8}px`;
                    sparkle.style.animationDelay = `${i * 0.6}s`;
                    sparkle.style.position = 'absolute';
                    sparkle.style.width = '6px';
                    sparkle.style.height = '6px';
                    sparkle.style.borderRadius = '9999px';
                    sparkle.style.backgroundColor = 'rgba(200, 164, 93, 0.9)';
                    sparkle.style.opacity = '0.8';
                    sparkle.style.pointerEvents = 'none';
                    cta.appendChild(sparkle);
                }
            }
        });
    }

    // Initialize all sliders on page
    function initAllSliders() {
        document.querySelectorAll('.aro-slider-container').forEach(container => {
            initProductSlider(container);
        });
    }

    // Document ready
    $(document).ready(function() {
        // Check if GSAP is loaded
        if (typeof gsap === 'undefined') {
            console.warn('GSAP not loaded. Slider functionality will be limited.');
        }

        initFadeUpAnimations();
        initMobileMenu();
        initAllSliders();
        initAddToCartButtons();
        initGlowCTA();

        // Reinitialize sliders after Elementor preview update
        if (typeof elementorFrontend !== 'undefined') {
            elementorFrontend.hooks.addAction('frontend/element_ready/widget', function($scope) {
                if ($scope.find('.aro-slider-container').length) {
                    initProductSlider($scope.find('.aro-slider-container')[0]);
                }
            });
        }
    });

    // AJAX Add to Cart handler
    if (typeof aroTheme !== 'undefined') {
        // This would be handled server-side in functions.php
    }

})(jQuery);

// WordPress AJAX handler for add to cart (to be added to functions.php)
/*
add_action('wp_ajax_aro_add_to_cart', 'aro_ajax_add_to_cart');
add_action('wp_ajax_nopriv_aro_add_to_cart', 'aro_ajax_add_to_cart');

function aro_ajax_add_to_cart() {
    check_ajax_referer('aro-theme-nonce', 'nonce');
    
    $product_id = isset($_POST['product_id']) ? absint($_POST['product_id']) : 0;
    
    if ($product_id && function_exists('WC')) {
        WC()->cart->add_to_cart($product_id);
        
        wp_send_json_success(array(
            'cart_count' => WC()->cart->get_cart_contents_count(),
            'message' => __('Product added to cart', 'aro-theme')
        ));
    }
    
    wp_send_json_error(array(
        'message' => __('Failed to add product to cart', 'aro-theme')
    ));
}
*/
