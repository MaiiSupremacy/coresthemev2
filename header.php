<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until the main content.
 * UPDATED: New navigation structure (Home | About | People | Research | Publications | Supervision)
 * *** IMPROVED: Added "Skip to Content" link and ARIA roles for accessibility. ***
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CORES_Theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    
    <?php wp_body_open(); ?>

    <!-- *** ADDED: Skip to Content Link *** -->
    <!-- This is the first focusable element for keyboard/screen reader users. -->
    <a class="skip-link screen-reader-text" href="#main-content">
        <?php esc_html_e( 'Skip to content', 'cores-theme' ); ?>
    </a>

    <!-- Custom Cursor -->
    <div class="cursor"></div>
    <div class="cursor-follower"></div>

    <!-- Loader -->
    <div class="loader" id="loader">
        <!-- ... (loader content is unchanged) ... -->
        <div class="loader-content">
            <div class="wave-loader">
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave-icon">
                    <i class="fas fa-water"></i>
                </div>
            </div>
            <div class="loader-text">LOADING</div>
            <div class="loader-progress">
                <div class="loader-progress-bar"></div>
            </div>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- NAVIGATION BAR -->
    <!-- ============================================ -->
    <!-- *** IMPROVED: Added role="navigation" for accessibility *** -->
    <nav id="navbar" role="navigation" aria-label="<?php esc_attr_e( 'Main navigation', 'cores-theme' ); ?>">
        <div class="logo-container">
            <!-- Dynamic Logo from Customizer -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link">
                <!-- *** IMPROVED: Dynamic alt text for better SEO/accessibility *** -->
                <img src="<?php echo esc_url( get_theme_mod( 'cores_logo', get_template_directory_uri() . '/assets/Logo-Cores-UB-revisi-transparan@2x.png' ) ); ?>" 
                     alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> Logo" 
                     class="logo">
            </a>
            
            <!-- Dynamic Logo Text from Customizer -->
            <div class="logo-text"><?php echo esc_html( get_theme_mod( 'cores_logo_text', 'CORES' ) ); ?></div>
        </div>

        <!-- ============================================ -->
        <!-- MAIN NAVIGATION MENU -->
        <!-- NEW STRUCTURE: Home | About | People | Research | Publications | Supervision -->
        <!-- ============================================ -->
        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'primary-menu',
                'container'      => 'ul',
                'menu_class'     => 'main-nav-ul',
                'fallback_cb'    => 'cores_menu_fallback', // Uses fallback from functions.php
            )
        );
        ?>
        
        <!-- Hamburger Menu (Mobile) -->
        <!-- *** IMPROVED: Changed <div> to <button> for accessibility *** -->
        <button class="hamburger" id="hamburger" aria-expanded="false" aria-controls="slideMenu" aria-label="<?php esc_attr_e( 'Toggle navigation menu', 'cores-theme' ); ?>">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </nav>

    <!-- ============================================ -->
    <!-- SLIDE-OUT MOBILE MENU -->
    <!-- ============================================ -->
    <!-- *** IMPROVED: Added role="navigation" and aria-label *** -->
    <div class="slide-menu" id="slideMenu" role="navigation" aria-label="<?php esc_attr_e( 'Mobile menu', 'cores-theme' ); ?>">
        <!-- *** IMPROVED: Changed <div> to <button> for accessibility *** -->
        <button class="menu-close" id="menuClose" aria-label="<?php esc_attr_e( 'Close navigation menu', 'cores-theme' ); ?>">
            <i class="fas fa-times"></i>
        </button>
        <div class="slide-menu-content">
            <h2 style="margin-bottom: 2rem;"><?php esc_html_e( 'Menu', 'cores-theme' ); ?></h2>
            
            <!-- Same navigation menu for mobile -->
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary-menu',
                    'container'      => 'ul',
                    'menu_class'     => 'mobile-nav-ul',
                    'fallback_cb'    => 'cores_menu_fallback', // Uses same fallback
                )
            );
            ?>

            <!-- Quick Contact Section -->
            <div style="margin-top: 3rem;">
                <h3><?php esc_html_e( 'Quick Contact', 'cores-theme' ); ?></h3>
                <p style="margin-top: 1rem;"><?php esc_html_e( 'Email:', 'cores-theme' ); ?> <?php echo esc_html( get_theme_mod( 'cores_email_1', 'coastalresearchers@gmail.com' ) ); ?></p>
                <p><?php esc_html_e( 'Phone:', 'cores-theme' ); ?> <?php echo esc_html( get_theme_mod( 'cores_phone_1', '+62 821 4279 3179' ) ); ?></p>
            </div>
            
            <!-- Social Icons -->
            <div class="social-icons" style="margin-top: 2rem;">
                <!-- *** IMPROVED: Added aria-label to each link *** -->
                <a href="<?php echo esc_url( get_theme_mod( 'cores_facebook', '#' ) ); ?>" class="social-icon" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Visit our Facebook page', 'cores-theme' ); ?>"><i class="fab fa-facebook-f"></i></a>
                <a href="<?php echo esc_url( get_theme_mod( 'cores_twitter', '#' ) ); ?>" class="social-icon" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Visit our Twitter profile', 'cores-theme' ); ?>"><i class="fab fa-twitter"></i></a>
                <a href="<?php echo esc_url( get_theme_mod( 'cores_instagram', '#' ) ); ?>" class="social-icon" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Visit our Instagram profile', 'cores-theme' ); ?>"><i class="fab fa-instagram"></i></a>
                <a href="<?php echo esc_url( get_theme_mod( 'cores_linkedin', '#' ) ); ?>" class="social-icon" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Visit our LinkedIn profile', 'cores-theme' ); ?>"><i class="fab fa-linkedin-in"></i></a>
                <a href="<?php echo esc_url( get_theme_mod( 'cores_youtube', '#' ) ); ?>" class="social-icon" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Visit our YouTube channel', 'cores-theme' ); ?>"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
    
    <!-- The header.php file ends here. The page content will be added by individual templates. -->