<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until the main content.
 * UPDATED: New navigation structure (Home | About | People | Research | Publications | Supervision)
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

    <!-- Custom Cursor -->
    <div class="cursor"></div>
    <div class="cursor-follower"></div>

    <!-- Loader -->
    <div class="loader" id="loader">
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
    <nav id="navbar">
        <div class="logo-container">
            <!-- Dynamic Logo from Customizer -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link">
                <img src="<?php echo esc_url( get_theme_mod( 'cores_logo', get_template_directory_uri() . '/assets/Logo-Cores-UB-revisi-transparan@2x.png' ) ); ?>" alt="CORES Logo" class="logo">
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
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <!-- ============================================ -->
    <!-- SLIDE-OUT MOBILE MENU -->
    <!-- ============================================ -->
    <div class="slide-menu" id="slideMenu">
        <div class="menu-close" id="menuClose">
            <i class="fas fa-times"></i>
        </div>
        <div class="slide-menu-content">
            <h2 style="margin-bottom: 2rem;">Menu</h2>
            
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
                <h3>Quick Contact</h3>
                <p style="margin-top: 1rem;">Email: <?php echo esc_html( get_theme_mod( 'cores_email_1', 'coastalresearchers@gmail.com' ) ); ?></p>
                <p>Phone: <?php echo esc_html( get_theme_mod( 'cores_phone_1', '+62 821 4279 3179' ) ); ?></p>
            </div>
            
            <!-- Social Icons -->
            <div class="social-icons" style="margin-top: 2rem;">
                <a href="<?php echo esc_url( get_theme_mod( 'cores_facebook', '#' ) ); ?>" class="social-icon" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                <a href="<?php echo esc_url( get_theme_mod( 'cores_twitter', '#' ) ); ?>" class="social-icon" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a>
                <a href="<?php echo esc_url( get_theme_mod( 'cores_instagram', '#' ) ); ?>" class="social-icon" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
                <a href="<?php echo esc_url( get_theme_mod( 'cores_linkedin', '#' ) ); ?>" class="social-icon" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
                <a href="<?php echo esc_url( get_theme_mod( 'cores_youtube', '#' ) ); ?>" class="social-icon" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
    
    <!-- The header.php file ends here. The page content will be added by individual templates. -->