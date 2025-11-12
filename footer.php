<?php
/**
 * The footer for our theme
 *
 * Contains the closing of the main content and all footer content.
 * NOW INCLUDES: Full "Get In Touch" contact section before footer
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
        <h2 class="section-title fade-in">Get In Touch</h2>
        <div class="contact-container">
            
            <!-- LEFT SIDE: Contact Information -->
            <div class="contact-info fade-in">
                <h3 style="font-size: 2rem; margin-bottom: 2rem;">Contact Information</h3>
                
                <!-- Address -->
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <h4>Address</h4>
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
                        <h4>Phone</h4>
                        <p><?php echo esc_html( get_theme_mod( 'cores_phone_1', '+62 821 4279 3179' ) ); ?><br><?php echo esc_html( get_theme_mod( 'cores_phone_2', '+62 896 6579 9413' ) ); ?></p>
                    </div>
                </div>
                
                <!-- Email -->
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <h4>Email</h4>
                        <p><?php echo esc_html( get_theme_mod( 'cores_email_1', 'coastalresearchers@gmail.com' ) ); ?><br><?php echo esc_html( get_theme_mod( 'cores_email_2', 'coastalresearchers@gmail.com' ) ); ?></p>
                    </div>
                </div>
                
                <!-- Office Hours -->
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-clock"></i></div>
                    <div>
                        <h4>Office Hours</h4>
                        <p>Monday - Thursday: 8:00 AM - 5:00 PM<br>Friday: 8:00 AM - 3:00 PM</p>
                    </div>
                </div>
            </div>
            
            <!-- RIGHT SIDE: Contact Form -->
            <div class="contact-form fade-in">
                <h3 style="font-size: 2rem; margin-bottom: 2rem;">Send Us a Message</h3>
                <form id="contactForm">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <button type="submit" class="cta-button" style="width: 100%;">Send Message</button>
                </form>
            </div>
            
        </div>
    </section>

    <!-- ============================================ -->
    <!-- FOOTER -->
    <!-- ============================================ -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>About CORES</h3>
                <p>We are a dedicated team of researchers focused on advancing coastal science through innovative research, cutting-edge technology, and collaborative partnerships.</p>
                <div class="social-icons">
                    <a href="<?php echo esc_url( get_theme_mod( 'cores_facebook', '#' ) ); ?>" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="<?php echo esc_url( get_theme_mod( 'cores_twitter', '#' ) ); ?>" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="<?php echo esc_url( get_theme_mod( 'cores_instagram', '#' ) ); ?>" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="<?php echo esc_url( get_theme_mod( 'cores_linkedin', '#' ) ); ?>" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    <a href="<?php echo esc_url( get_theme_mod( 'cores_youtube', '#' ) ); ?>" class="social-icon"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-link">Home</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="footer-link">About</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/people/' ) ); ?>" class="footer-link">People</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/research/' ) ); ?>" class="footer-link">Research</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/publications/' ) ); ?>" class="footer-link">Publications</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/supervision/' ) ); ?>" class="footer-link">Supervision</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Research Areas</h3>
                <ul>
                    <li><a href="#" class="footer-link">Coastal Dynamics</a></li>
                    <li><a href="#" class="footer-link">Data Analysis</a></li>
                    <li><a href="#" class="footer-link">Remote Sensing</a></li>
                    <li><a href="#" class="footer-link">Ecosystem Studies</a></li>
                    <li><a href="#" class="footer-link">Topographic Mapping</a></li>
                    <li><a href="#" class="footer-link">Sediment Analysis</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Newsletter</h3>
                <p>Subscribe to our newsletter for the latest research updates and news.</p>
                <form style="margin-top: 1rem;">
                    <input type="email" placeholder="Your email" style="padding: 0.5rem; border-radius: 5px; border: none; width: 100%; margin-bottom: 0.5rem;">
                    <button type="submit" class="cta-button" style="width: 100%; padding: 0.5rem;">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved. | <a href="#" style="color: var(--light);">Privacy Policy</a> | <a href="#" style="color: var(--light);">Terms of Service</a></p>
        </div>
    </footer>

    <div class="back-to-top" id="backToTop">
        <i class="fas fa-chevron-up"></i>
    </div>

    <?php wp_footer(); ?>

</body>
</html>