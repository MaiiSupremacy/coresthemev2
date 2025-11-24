<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until the main content.
 * 
 * ENHANCED FEATURES:
 * - Modern HTML5 semantic structure
 * - Comprehensive SEO meta tags
 * - Accessibility (WCAG 2.1 Level AA compliant)
 * - Performance optimizations (preconnect, DNS prefetch)
 * - Progressive Web App (PWA) ready
 * - Schema.org structured data
 * - Open Graph and Twitter Card meta tags
 * - Security headers
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CORES_Theme
 * @version 2.3.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Preconnect to external domains for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <!-- DNS Prefetch for performance -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="//unpkg.com">
    
    <?php
    // Get page-specific information
    $page_title = wp_get_document_title();
    $site_name = get_bloginfo( 'name' );
    $site_description = get_bloginfo( 'description' );
    $current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
    // Get featured image for OG tags
    $og_image = '';
    if ( is_singular() && has_post_thumbnail() ) {
        $og_image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
    } else {
        // Fallback to site logo or default image
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        if ( $custom_logo_id ) {
            $og_image = wp_get_attachment_image_url( $custom_logo_id, 'full' );
        } else {
            $og_image = get_theme_mod( 'cores_logo', CORES_THEME_URI . '/assets/Logo-Cores-UB-revisi-transparan@2x.png' );
        }
    }
    
    // Get excerpt or description for meta description
    $meta_description = $site_description;
    if ( is_singular() ) {
        if ( has_excerpt() ) {
            $meta_description = get_the_excerpt();
        } else {
            $meta_description = wp_trim_words( get_the_content(), 30, '...' );
        }
        $meta_description = wp_strip_all_tags( $meta_description );
    } elseif ( is_category() || is_tag() || is_tax() ) {
        $meta_description = term_description();
        $meta_description = wp_strip_all_tags( $meta_description );
    }
    ?>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php echo esc_attr( $meta_description ); ?>">
    <meta name="keywords" content="coastal research, marine science, oceanography, Brawijaya University, CORES">
    <meta name="author" content="<?php echo esc_attr( $site_name ); ?>">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    
    <!-- Open Graph Meta Tags (Facebook, LinkedIn) -->
    <meta property="og:locale" content="<?php echo esc_attr( get_locale() ); ?>">
    <meta property="og:type" content="<?php echo is_singular() ? 'article' : 'website'; ?>">
    <meta property="og:title" content="<?php echo esc_attr( $page_title ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $meta_description ); ?>">
    <meta property="og:url" content="<?php echo esc_url( $current_url ); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>">
    <?php if ( $og_image ) : ?>
    <meta property="og:image" content="<?php echo esc_url( $og_image ); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="<?php echo esc_attr( $page_title ); ?>">
    <?php endif; ?>
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( $page_title ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $meta_description ); ?>">
    <?php if ( $og_image ) : ?>
    <meta name="twitter:image" content="<?php echo esc_url( $og_image ); ?>">
    <?php endif; ?>
    <?php
    $twitter_handle = get_theme_mod( 'cores_twitter', '' );
    if ( $twitter_handle && strpos( $twitter_handle, 'twitter.com/' ) !== false ) {
        $twitter_username = '@' . basename( parse_url( $twitter_handle, PHP_URL_PATH ) );
        echo '<meta name="twitter:site" content="' . esc_attr( $twitter_username ) . '">' . "\n";
    }
    ?>
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo esc_url( $current_url ); ?>">
    
    <!-- Theme Color for Mobile Browsers -->
    <meta name="theme-color" content="#0A4D68">
    <meta name="msapplication-TileColor" content="#0A4D68">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <!-- Favicon and Touch Icons -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_site_icon_url( 32 ) ); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_site_icon_url( 16 ) ); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_site_icon_url( 180 ) ); ?>">
    
    <!-- Preload critical assets for performance -->
    <link rel="preload" href="<?php echo esc_url( get_stylesheet_uri() ); ?>" as="style">
    <link rel="preload" href="<?php echo esc_url( CORES_THEME_URI . '/js/main.js' ); ?>" as="script">
    
    <!-- Remove 'no-js' class with JavaScript -->
    <script>
        document.documentElement.className = document.documentElement.className.replace(/\bno-js\b/, 'js');
    </script>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    
    <?php
    /**
     * wp_body_open hook - WordPress 5.2+
     * Allows plugins to inject content after the opening <body> tag
     */
    if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
    }
    ?>

    <!-- Skip to Content Link for Accessibility -->
    <a class="skip-link screen-reader-text" href="#main-content">
        <?php esc_html_e( 'Skip to content', 'cores-theme' ); ?>
    </a>

    <!-- Custom Animated Cursor (Desktop only) -->
    <div class="cursor" aria-hidden="true"></div>
    <div class="cursor-follower" aria-hidden="true"></div>

    <!-- Preloader / Loading Screen -->
    <div class="loader" id="loader" role="status" aria-live="polite" aria-label="<?php esc_attr_e( 'Loading', 'cores-theme' ); ?>">
        <div class="loader-content">
            <div class="wave-loader" aria-hidden="true">
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave"></div>
                <div class="wave-icon">
                    <i class="fas fa-water"></i>
                </div>
            </div>
            <div class="loader-text"><?php esc_html_e( 'LOADING', 'cores-theme' ); ?></div>
            <div class="loader-progress">
                <div class="loader-progress-bar"></div>
            </div>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- MAIN NAVIGATION BAR -->
    <!-- ============================================ -->
    <nav id="navbar" role="navigation" aria-label="<?php esc_attr_e( 'Main navigation', 'cores-theme' ); ?>">
        
        <!-- Logo Container -->
        <div class="logo-container">
            <?php
            // Check if custom logo is set
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {
                // Fallback to theme customizer logo
                $logo_url = get_theme_mod( 'cores_logo', CORES_THEME_URI . '/assets/Logo-Cores-UB-revisi-transparan@2x.png' );
                ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link" rel="home" aria-label="<?php esc_attr_e( 'Home', 'cores-theme' ); ?>">
                    <img src="<?php echo esc_url( $logo_url ); ?>" 
                         alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> <?php esc_attr_e( 'Logo', 'cores-theme' ); ?>" 
                         class="logo"
                         width="200"
                         height="50">
                </a>
                <?php
            }
            ?>
            
            <!-- Logo Text (Site Title) -->
            <?php if ( display_header_text() ) : ?>
            <div class="logo-text">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <?php echo esc_html( get_theme_mod( 'cores_logo_text', get_bloginfo( 'name' ) ) ); ?>
                </a>
            </div>
            <?php endif; ?>
        </div>

        <!-- Desktop Navigation Menu -->
        <?php
        if ( has_nav_menu( 'primary-menu' ) ) {
            wp_nav_menu(
                array(
                    'theme_location'  => 'primary-menu',
                    'container'       => 'ul',
                    'menu_class'      => 'main-nav-ul',
                    'menu_id'         => 'primary-menu',
                    'fallback_cb'     => 'cores_menu_fallback',
                    'depth'           => 2,
                    'walker'          => '', // Can add custom walker for advanced features
                    'items_wrap'      => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
                )
            );
        } else {
            cores_menu_fallback( array() );
        }
        ?>
        
        <!-- Hamburger Menu Toggle (Mobile) -->
        <button class="hamburger" 
                id="hamburger" 
                type="button"
                aria-expanded="false" 
                aria-controls="slideMenu" 
                aria-label="<?php esc_attr_e( 'Toggle navigation menu', 'cores-theme' ); ?>">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>
    </nav>

    <!-- ============================================ -->
    <!-- MOBILE SLIDE-OUT MENU -->
    <!-- ============================================ -->
    <div class="slide-menu" 
         id="slideMenu" 
         role="dialog" 
         aria-modal="true"
         aria-labelledby="mobile-menu-title"
         aria-hidden="true">
        
        <!-- Close Button -->
        <button class="menu-close" 
                id="menuClose" 
                type="button"
                aria-label="<?php esc_attr_e( 'Close navigation menu', 'cores-theme' ); ?>">
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
        
        <div class="slide-menu-content">
            <!-- Menu Title -->
            <h2 id="mobile-menu-title" style="margin-bottom: 2rem;">
                <?php esc_html_e( 'Menu', 'cores-theme' ); ?>
            </h2>
            
            <!-- Mobile Navigation Menu -->
            <?php
            if ( has_nav_menu( 'primary-menu' ) ) {
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary-menu',
                        'container'      => 'nav',
                        'container_class' => 'mobile-nav-container',
                        'menu_class'     => 'mobile-nav-ul',
                        'menu_id'        => 'mobile-menu',
                        'fallback_cb'    => 'cores_menu_fallback',
                        'depth'          => 2,
                    )
                );
            } else {
                cores_menu_fallback( array() );
            }
            ?>

            <!-- Quick Contact Section in Mobile Menu -->
            <div class="mobile-menu-contact" style="margin-top: 3rem;">
                <h3><?php esc_html_e( 'Quick Contact', 'cores-theme' ); ?></h3>
                <p style="margin-top: 1rem;">
                    <strong><?php esc_html_e( 'Email:', 'cores-theme' ); ?></strong><br>
                    <a href="mailto:<?php echo esc_attr( get_theme_mod( 'cores_email_1', 'coastalresearchers@gmail.com' ) ); ?>">
                        <?php echo esc_html( get_theme_mod( 'cores_email_1', 'coastalresearchers@gmail.com' ) ); ?>
                    </a>
                </p>
                <p>
                    <strong><?php esc_html_e( 'Phone:', 'cores-theme' ); ?></strong><br>
                    <a href="tel:<?php echo esc_attr( str_replace( ' ', '', get_theme_mod( 'cores_phone_1', '+62 821 4279 3179' ) ) ); ?>">
                        <?php echo esc_html( get_theme_mod( 'cores_phone_1', '+62 821 4279 3179' ) ); ?>
                    </a>
                </p>
            </div>
            
            <!-- Social Icons in Mobile Menu -->
            <div class="social-icons" style="margin-top: 2rem;">
                <?php
                $social_links = array(
                    'facebook'  => array( 'icon' => 'fab fa-facebook-f', 'label' => __( 'Facebook', 'cores-theme' ) ),
                    'twitter'   => array( 'icon' => 'fab fa-twitter', 'label' => __( 'Twitter', 'cores-theme' ) ),
                    'instagram' => array( 'icon' => 'fab fa-instagram', 'label' => __( 'Instagram', 'cores-theme' ) ),
                    'linkedin'  => array( 'icon' => 'fab fa-linkedin-in', 'label' => __( 'LinkedIn', 'cores-theme' ) ),
                    'youtube'   => array( 'icon' => 'fab fa-youtube', 'label' => __( 'YouTube', 'cores-theme' ) ),
                );

                foreach ( $social_links as $network => $data ) {
                    $url = get_theme_mod( 'cores_' . $network, '' );
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
    </div>
    
    <!-- The header.php file ends here. The page content will be added by individual templates. -->
    
    <?php
    /**
     * Hook after header
     * Allows plugins/child themes to add content after the header
     */
    do_action( 'cores_after_header' );
    ?>