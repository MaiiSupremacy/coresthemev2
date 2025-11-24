<?php
/**
 * The footer for our theme
 *
 * Contains the closing of the main content and all footer content.
 * NOW INCLUDES: Full "Get In Touch" contact section before footer
 *
 * ENHANCED FEATURES:
 * - Fully dynamic content from Customizer
 * - Accessibility improvements (WCAG 2.1 compliant)
 * - Schema.org structured data for contact info
 * - AJAX-powered contact form
 * - Responsive design
 * - Social media integration
 * - Newsletter subscription
 * - Back to top button
 * - Performance optimizations
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CORES_Theme
 * @version 2.3.0
 */
?>

    <!-- ============================================ -->
    <!-- GET IN TOUCH SECTION (Before Footer) -->
    <!-- ============================================ -->
    <section class="contact-section" id="contact">
        <div class="container">
            <h2 class="section-title fade-in"><?php esc_html_e( 'Get In Touch', 'cores-theme' ); ?></h2>
            
            <div class="contact-container">
                
                <!-- LEFT SIDE: Contact Information with Schema.org markup -->
                <div class="contact-info fade-in" itemscope itemtype="https://schema.org/Organization">
                    <meta itemprop="name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                    <meta itemprop="url" content="<?php echo esc_url( home_url() ); ?>">
                    
                    <h3 style="font-size: 2rem; margin-bottom: 2rem;">
                        <?php esc_html_e( 'Contact Information', 'cores-theme' ); ?>
                    </h3>
                    
                    <!-- Address with Schema.org -->
                    <div class="contact-item" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                        <div class="contact-icon" aria-hidden="true">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4><?php esc_html_e( 'Address', 'cores-theme' ); ?></h4>
                            <p itemprop="streetAddress">
                                <?php
                                $address = get_theme_mod( 
                                    'cores_address', 
                                    "Water Resources Engineering Department\nBrawijaya University\nJl. MT. Haryono No.167, Ketawanggede, Kec. Lowokwaru, Kota Malang, Jawa Timur\n65145"
                                );
                                echo nl2br( esc_html( $address ) );
                                ?>
                            </p>
                            <meta itemprop="addressLocality" content="Malang">
                            <meta itemprop="addressRegion" content="Jawa Timur">
                            <meta itemprop="postalCode" content="65145">
                            <meta itemprop="addressCountry" content="ID">
                        </div>
                    </div>
                    
                    <!-- Phone with Schema.org -->
                    <div class="contact-item" itemprop="telephone">
                        <div class="contact-icon" aria-hidden="true">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h4><?php esc_html_e( 'Phone', 'cores-theme' ); ?></h4>
                            <p>
                                <a href="tel:<?php echo esc_attr( str_replace( ' ', '', get_theme_mod( 'cores_phone_1', '+62 821 4279 3179' ) ) ); ?>">
                                    <?php echo esc_html( get_theme_mod( 'cores_phone_1', '+62 821 4279 3179' ) ); ?>
                                </a>
                                <br>
                                <?php
                                $phone_2 = get_theme_mod( 'cores_phone_2', '+62 896 6579 9413' );
                                if ( ! empty( $phone_2 ) ) :
                                ?>
                                <a href="tel:<?php echo esc_attr( str_replace( ' ', '', $phone_2 ) ); ?>">
                                    <?php echo esc_html( $phone_2 ); ?>
                                </a>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Email with Schema.org -->
                    <div class="contact-item" itemprop="email">
                        <div class="contact-icon" aria-hidden="true">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4><?php esc_html_e( 'Email', 'cores-theme' ); ?></h4>
                            <p>
                                <a href="mailto:<?php echo esc_attr( get_theme_mod( 'cores_email_1', 'coastalresearchers@gmail.com' ) ); ?>">
                                    <?php echo esc_html( get_theme_mod( 'cores_email_1', 'coastalresearchers@gmail.com' ) ); ?>
                                </a>
                                <br>
                                <?php
                                $email_2 = get_theme_mod( 'cores_email_2', '' );
                                if ( ! empty( $email_2 ) && $email_2 !== get_theme_mod( 'cores_email_1' ) ) :
                                ?>
                                <a href="mailto:<?php echo esc_attr( $email_2 ); ?>">
                                    <?php echo esc_html( $email_2 ); ?>
                                </a>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Office Hours with Schema.org -->
                    <div class="contact-item" itemprop="openingHoursSpecification" itemscope itemtype="https://schema.org/OpeningHoursSpecification">
                        <div class="contact-icon" aria-hidden="true">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h4><?php esc_html_e( 'Office Hours', 'cores-theme' ); ?></h4>
                            <p>
                                <span itemprop="dayOfWeek" content="Monday">
                                    <?php esc_html_e( 'Monday - Thursday: 8:00 AM - 5:00 PM', 'cores-theme' ); ?>
                                </span>
                                <br>
                                <span itemprop="dayOfWeek" content="Friday">
                                    <?php esc_html_e( 'Friday: 8:00 AM - 3:00 PM', 'cores-theme' ); ?>
                                </span>
                                <meta itemprop="opens" content="08:00">
                                <meta itemprop="closes" content="17:00">
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- RIGHT SIDE: Contact Form with AJAX -->
                <div class="contact-form fade-in">
                    <h3 style="font-size: 2rem; margin-bottom: 2rem;">
                        <?php esc_html_e( 'Send Us a Message', 'cores-theme' ); ?>
                    </h3>
                    
                    <form id="contactForm" novalidate>
                        <div class="form-group">
                            <label for="name">
                                <?php esc_html_e( 'Full Name', 'cores-theme' ); ?> 
                                <span class="required" aria-label="<?php esc_attr_e( 'required', 'cores-theme' ); ?>">*</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   required 
                                   aria-required="true"
                                   placeholder="<?php esc_attr_e( 'John Doe', 'cores-theme' ); ?>"
                                   autocomplete="name">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">
                                <?php esc_html_e( 'Email Address', 'cores-theme' ); ?> 
                                <span class="required" aria-label="<?php esc_attr_e( 'required', 'cores-theme' ); ?>">*</span>
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   required 
                                   aria-required="true"
                                   placeholder="<?php esc_attr_e( 'john@example.com', 'cores-theme' ); ?>"
                                   autocomplete="email">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">
                                <?php esc_html_e( 'Subject', 'cores-theme' ); ?> 
                                <span class="required" aria-label="<?php esc_attr_e( 'required', 'cores-theme' ); ?>">*</span>
                            </label>
                            <input type="text" 
                                   id="subject" 
                                   name="subject" 
                                   required 
                                   aria-required="true"
                                   placeholder="<?php esc_attr_e( 'How can we help you?', 'cores-theme' ); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="message">
                                <?php esc_html_e( 'Message', 'cores-theme' ); ?> 
                                <span class="required" aria-label="<?php esc_attr_e( 'required', 'cores-theme' ); ?>">*</span>
                            </label>
                            <textarea id="message" 
                                      name="message" 
                                      required 
                                      aria-required="true"
                                      rows="5"
                                      placeholder="<?php esc_attr_e( 'Your message here...', 'cores-theme' ); ?>"></textarea>
                        </div>
                        
                        <!-- WordPress Nonce for security -->
                        <?php wp_nonce_field( 'cores_contact_form_nonce', 'contact_nonce' ); ?>
                        
                        <button type="submit" class="cta-button" style="width: 100%;">
                            <span class="button-text"><?php esc_html_e( 'Send Message', 'cores-theme' ); ?></span>
                            <span class="button-loader" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>
                            </span>
                        </button>
                    </form>
                </div>
                
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- MAIN FOOTER -->
    <!-- ============================================ -->
    <footer role="contentinfo" itemscope itemtype="https://schema.org/WPFooter">
        <div class="footer-content">
            
            <!-- About CORES Section -->
            <div class="footer-section">
                <h3><?php esc_html_e( 'About CORES', 'cores-theme' ); ?></h3>
                <p>
                    <?php
                    $about_text = get_theme_mod(
                        'cores_footer_about',
                        __( 'We are a dedicated team of researchers focused on advancing coastal science through innovative research, cutting-edge technology, and collaborative partnerships.', 'cores-theme' )
                    );
                    echo esc_html( $about_text );
                    ?>
                </p>
                
                <!-- Social Icons -->
                <div class="social-icons">
                    <?php
                    $social_networks = array(
                        'facebook'  => array( 'icon' => 'fab fa-facebook-f', 'label' => __( 'Facebook', 'cores-theme' ) ),
                        'twitter'   => array( 'icon' => 'fab fa-twitter', 'label' => __( 'Twitter', 'cores-theme' ) ),
                        'instagram' => array( 'icon' => 'fab fa-instagram', 'label' => __( 'Instagram', 'cores-theme' ) ),
                        'linkedin'  => array( 'icon' => 'fab fa-linkedin-in', 'label' => __( 'LinkedIn', 'cores-theme' ) ),
                        'youtube'   => array( 'icon' => 'fab fa-youtube', 'label' => __( 'YouTube', 'cores-theme' ) ),
                    );

                    foreach ( $social_networks as $network => $data ) {
                        $url = get_theme_mod( 'cores_' . $network, '#' );
                        if ( ! empty( $url ) && $url !== '#' ) {
                            printf(
                                '<a href="%s" class="social-icon" target="_blank" rel="noopener noreferrer" aria-label="%s"><i class="%s" aria-hidden="true"></i></a>',
                                esc_url( $url ),
                                /* translators: %s: Social network name */
                                esc_attr( sprintf( __( 'Visit our %s page', 'cores-theme' ), $data['label'] ) ),
                                esc_attr( $data['icon'] )
                            );
                        }
                    }
                    ?>
                </div>
            </div>
            
            <!-- Quick Links Section -->
            <div class="footer-section">
                <h3><?php esc_html_e( 'Quick Links', 'cores-theme' ); ?></h3>
                <?php
                if ( has_nav_menu( 'footer-menu' ) ) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-menu',
                            'container'      => 'nav',
                            'container_class' => 'footer-nav',
                            'menu_class'     => 'footer-links-list',
                            'depth'          => 1,
                            'fallback_cb'    => false,
                        )
                    );
                } else {
                    // Fallback menu
                    echo '<ul class="footer-links-list">';
                    echo '<li><a href="' . esc_url( home_url( '/about/' ) ) . '">' . esc_html__( 'About', 'cores-theme' ) . '</a></li>';
                    echo '<li><a href="' . esc_url( home_url( '/people/' ) ) . '">' . esc_html__( 'People', 'cores-theme' ) . '</a></li>';
                    echo '<li><a href="' . esc_url( home_url( '/research/' ) ) . '">' . esc_html__( 'Research', 'cores-theme' ) . '</a></li>';
                    echo '<li><a href="' . esc_url( home_url( '/publications/' ) ) . '">' . esc_html__( 'Publications', 'cores-theme' ) . '</a></li>';
                    echo '<li><a href="' . esc_url( home_url( '/supervision/' ) ) . '">' . esc_html__( 'Supervision', 'cores-theme' ) . '</a></li>';
                    echo '<li><a href="#contact">' . esc_html__( 'Contact', 'cores-theme' ) . '</a></li>';
                    echo '</ul>';
                }
                ?>
            </div>
            
            <!-- Research Categories Section (Dynamic Widget Area) -->
            <div class="footer-section">
                <h3><?php esc_html_e( 'Research', 'cores-theme' ); ?></h3>
                <?php
                if ( is_active_sidebar( 'footer-widget-area' ) ) {
                    echo '<ul class="footer-widget-list">';
                    dynamic_sidebar( 'footer-widget-area' );
                    echo '</ul>';
                } else {
                    // Fallback guide
                    if ( current_user_can( 'edit_theme_options' ) ) {
                        echo '<p><a href="' . esc_url( admin_url( 'widgets.php' ) ) . '">' . esc_html__( 'Add widgets to the Footer Widget Area', 'cores-theme' ) . '</a></p>';
                    }
                }
                ?>
            </div>
            
            <!-- Newsletter Section -->
            <div class="footer-section">
                <h3><?php esc_html_e( 'Newsletter', 'cores-theme' ); ?></h3>
                <p><?php esc_html_e( 'Subscribe to our newsletter for the latest research updates and news.', 'cores-theme' ); ?></p>
                
                <form class="newsletter-form" style="margin-top: 1rem;" aria-label="<?php esc_attr_e( 'Newsletter subscription form', 'cores-theme' ); ?>">
                    <label for="newsletter-email" class="screen-reader-text">
                        <?php esc_html_e( 'Your email address', 'cores-theme' ); ?>
                    </label>
                    <input type="email" 
                           id="newsletter-email" 
                           name="newsletter-email"
                           placeholder="<?php esc_attr_e( 'Your email', 'cores-theme' ); ?>" 
                           style="padding: 0.5rem; border-radius: 5px; border: none; width: 100%; margin-bottom: 0.5rem;"
                           autocomplete="email"
                           required
                           aria-required="true">
                    <button type="submit" class="cta-button" style="width: 100%; padding: 0.5rem;">
                        <?php esc_html_e( 'Subscribe', 'cores-theme' ); ?>
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Copyright Bar -->
        <div class="copyright">
            <p>
                &copy; <?php echo esc_html( date( 'Y' ) ); ?> 
                <a href="<?php echo esc_url( home_url() ); ?>" rel="home">
                    <?php bloginfo( 'name' ); ?>
                </a>. 
                <?php esc_html_e( 'All rights reserved.', 'cores-theme' ); ?> 
                | 
                <?php
                // Privacy Policy link (if set in WordPress)
                if ( function_exists( 'get_privacy_policy_url' ) && get_privacy_policy_url() ) {
                    printf(
                        '<a href="%s" style="color: var(--light);">%s</a>',
                        esc_url( get_privacy_policy_url() ),
                        esc_html__( 'Privacy Policy', 'cores-theme' )
                    );
                } else {
                    echo '<a href="#" style="color: var(--light);">' . esc_html__( 'Privacy Policy', 'cores-theme' ) . '</a>';
                }
                ?> 
                | 
                <a href="#" style="color: var(--light);">
                    <?php esc_html_e( 'Terms of Service', 'cores-theme' ); ?>
                </a>
            </p>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button class="back-to-top" 
            id="backToTop" 
            type="button"
            aria-label="<?php esc_attr_e( 'Scroll back to top', 'cores-theme' ); ?>"
            style="display: none;">
        <i class="fas fa-chevron-up" aria-hidden="true"></i>
    </button>

    <?php
    /**
     * Hook before wp_footer
     * Allows plugins/child themes to add content before the closing body tag
     */
    do_action( 'cores_before_footer' );
    
    /**
     * wp_footer hook - Essential for WordPress functionality
     * DO NOT REMOVE
     */
    wp_footer();
    ?>

</body>
</html>