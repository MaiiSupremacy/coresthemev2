<?php
/**
 * The footer for our theme
 *
 * Contains the closing of the main content and all footer content.
 * NOW INCLUDES: Full "Get In Touch" contact section before footer
 *
 * *** IMPROVED: Internationalized all text, added accessibility labels,
 * and replaced hard-coded lists with dynamic wp_nav_menu and a new widget area. ***
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CORES_Theme
 */
?>

    <!-- ============================================ -->
    <!-- GET IN TOUCH SECTION (Before Footer) -->
    <!-- ============================================ -->
    <section class="contact-section" id="contact">
        <h2 class="section-title fade-in"><?php esc_html_e( 'Get In Touch', 'cores-theme' ); ?></h2>
        <div class="contact-container">
            
            <!-- LEFT SIDE: Contact Information -->
            <div class="contact-info fade-in">
                <h3 style="font-size: 2rem; margin-bottom: 2rem;"><?php esc_html_e( 'Contact Information', 'cores-theme' ); ?></h3>
                
                <!-- Address -->
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <h4><?php esc_html_e( 'Address', 'cores-theme' ); ?></h4>
                        <p><?php echo nl2br( esc_html( get_theme_mod( 'cores_address', 'Water Resources Engineering Department
Brawijaya University
Jl. MT. Haryono No.167, Ketawanggede, Kec. Lowokwaru, Kota Malang, Jawa Timur
65145' ) ) ); ?></p>
                    </div>
                </div>
                
                <!-- Phone -->
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-phone"></i></div>
                    <div>
                        <h4><?php esc_html_e( 'Phone', 'cores-theme' ); ?></h4>
                        <p><?php echo esc_html( get_theme_mod( 'cores_phone_1', '+62 821 4279 3179' ) ); ?><br><?php echo esc_html( get_theme_mod( 'cores_phone_2', '+62 896 6579 9413' ) ); ?></p>
                    </div>
                </div>
                
                <!-- Email -->
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <h4><?php esc_html_e( 'Email', 'cores-theme' ); ?></h4>
                        <p><?php echo esc_html( get_theme_mod( 'cores_email_1', 'coastalresearchers@gmail.com' ) ); ?><br><?php echo esc_html( get_theme_mod( 'cores_email_2', 'coastalresearchers@gmail.com' ) ); ?></p>
                    </div>
                </div>
                
                <!-- Office Hours -->
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-clock"></i></div>
                    <div>
                        <h4><?php esc_html_e( 'Office Hours', 'cores-theme' ); ?></h4>
                        <p><?php esc_html_e( 'Monday - Thursday: 8:00 AM - 5:00 PM', 'cores-theme' ); ?><br><?php esc_html_e( 'Friday: 8:00 AM - 3:00 PM', 'cores-theme' ); ?></p>
                    </div>
                </div>
            </div>
            
            <!-- RIGHT SIDE: Contact Form -->
            <div class="contact-form fade-in">
                <h3 style="font-size: 2rem; margin-bottom: 2rem;"><?php esc_html_e( 'Send Us a Message', 'cores-theme' ); ?></h3>
                <form id="contactForm">
                    <div class="form-group">
                        <label for="name"><?php esc_html_e( 'Full Name *', 'cores-theme' ); ?></label>
                        <input type="text" id="name" name="name" required aria-required="true">
                    </div>
                    <div class="form-group">
                        <label for="email"><?php esc_html_e( 'Email Address *', 'cores-theme' ); ?></label>
                        <input type="email" id="email" name="email" required aria-required="true">
                    </div>
                    <div class="form-group">
                        <label for="subject"><?php esc_html_e( 'Subject *', 'cores-theme' ); ?></label>
                        <input type="text" id="subject" name="subject" required aria-required="true">
                    </div>
                    <div class="form-group">
                        <label for="message"><?php esc_html_e( 'Message *', 'cores-theme' ); ?></label>
                        <textarea id="message" name="message" required aria-required="true"></textarea>
                    </div>
                    <!-- *** ADDED: WordPress Nonce field for security *** -->
                    <!-- This will be used later when we build a secure AJAX handler -->
                    <?php wp_nonce_field( 'cores_contact_form_nonce', 'contact_nonce' ); ?>
                    <button type="submit" class="cta-button" style="width: 100%;"><?php esc_html_e( 'Send Message', 'cores-theme' ); ?></button>
                </form>
            </div>
            
        </div>
    </section>

    <!-- ============================================ -->
    <!-- FOOTER -->
    <!-- ============================================ -->
    <footer role="contentinfo">
        <div class="footer-content">
            <div class="footer-section">
                <h3><?php esc_html_e( 'About CORES', 'cores-theme' ); ?></h3>
                <p><?php esc_html_e( 'We are a dedicated team of researchers focused on advancing coastal science through innovative research, cutting-edge technology, and collaborative partnerships.', 'cores-theme' ); ?></p>
                <div class="social-icons">
                    <a href="<?php echo esc_url( get_theme_mod( 'cores_facebook', '#' ) ); ?>" class="social-icon" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Visit our Facebook page', 'cores-theme' ); ?>"><i class="fab fa-facebook-f"></i></a>
                    <a href="<?php echo esc_url( get_theme_mod( 'cores_twitter', '#' ) ); ?>" class="social-icon" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Visit our Twitter profile', 'cores-theme' ); ?>"><i class="fab fa-twitter"></i></a>
                    <a href="<?php echo esc_url( get_theme_mod( 'cores_instagram', '#' ) ); ?>" class="social-icon" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Visit our Instagram profile', 'cores-theme' ); ?>"><i class="fab fa-instagram"></i></a>
                    <a href="<?php echo esc_url( get_theme_mod( 'cores_linkedin', '#' ) ); ?>" class="social-icon" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Visit our LinkedIn profile', 'cores-theme' ); ?>"><i class="fab fa-linkedin-in"></i></a>
                    <a href="<?php echo esc_url( get_theme_mod( 'cores_youtube', '#' ) ); ?>" class="social-icon" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Visit our YouTube channel', 'cores-theme' ); ?>"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3><?php esc_html_e( 'Quick Links', 'cores-theme' ); ?></h3>
                <!-- *** IMPROVED: Replaced hard-coded list with dynamic Footer Menu *** -->
                <?php
                if ( has_nav_menu( 'footer-menu' ) ) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-menu',
                            'container'      => 'ul',
                            'menu_class'     => 'footer-links-list', // Used for styling
                        )
                    );
                } else {
                    // Fallback in case no menu is assigned, but still better than hard-coding
                    echo '<ul><li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Assign a Footer Menu', 'cores-theme' ) . '</a></li></ul>';
                }
                ?>
            </div>
            
            <div class="footer-section">
                <h3><?php esc_html_e( 'Research', 'cores-theme' ); ?></h3>
                <!-- *** IMPROVED: Replaced hard-coded list with a dynamic Widget Area *** -->
                <?php
                if ( is_active_sidebar( 'footer-widget-area' ) ) {
                    echo '<ul class="footer-widget-list">'; // Wrapper for styling
                    dynamic_sidebar( 'footer-widget-area' );
                    echo '</ul>';
                } else {
                    // Guide for the user if no widgets are active
                    echo '<p>' . esc_html__( 'Add widgets (like Categories or a custom menu) to the "Footer Widget Area" in Appearance > Widgets.', 'cores-theme' ) . '</p>';
                }
                ?>
            </div>
            
            <div class="footer-section">
                <h3><?php esc_html_e( 'Newsletter', 'cores-theme' ); ?></h3>
                <p><?php esc_html_e( 'Subscribe to our newsletter for the latest research updates and news.', 'cores-theme' ); ?></p>
                <form style="margin-top: 1rem;" class="newsletter-form">
                    <!-- *** ADDED: Accessible label for screen readers *** -->
                    <label for="newsletter-email" class="screen-reader-text"><?php esc_html_e( 'Your email address', 'cores-theme' ); ?></label>
                    <input type="email" id="newsletter-email" placeholder="<?php esc_attr_e( 'Your email', 'cores-theme' ); ?>" style="padding: 0.5rem; border-radius: 5px; border: none; width: 100%; margin-bottom: 0.5rem;" required>
                    <button type="submit" class="cta-button" style="width: 100%; padding: 0.5rem;"><?php esc_html_e( 'Subscribe', 'cores-theme' ); ?></button>
                </form>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'cores-theme' ); ?> | <a href="#" style="color: var(--light);"><?php esc_html_e( 'Privacy Policy', 'cores-theme' ); ?></a> | <a href="#" style="color: var(--light);"><?php esc_html_e( 'Terms of Service', 'cores-theme' ); ?></a></p>
        </div>
    </footer>

    <!-- *** IMPROVED: Changed <div> to <button> for accessibility *** -->
    <button class="back-to-top" id="backToTop" aria-label="<?php esc_attr_e( 'Scroll back to top', 'cores-theme' ); ?>">
        <i class="fas fa-chevron-up"></i>
    </button>

    <?php wp_footer(); ?>

</body>
</html>