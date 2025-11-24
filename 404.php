<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * ENHANCED FEATURES:
 * ✓ "Lost at Sea" Thematic Design
 * ✓ Animated Water 404 Text
 * ✓ Smart Search Functionality
 * ✓ "Helpful Links" Section (Recent Research)
 * ✓ Broken Link Reporter (Mailto)
 * ✓ Accessibility (WCAG 2.1 AA)
 * ✓ Mobile Responsive
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package CORES_Theme
 * @version 2.3.0
 */

get_header();
?>

<main id="main-content" role="main" class="error-404-main">

    <div class="container error-404-container">
        
        <!-- Visual 404 Element -->
        <div class="error-visual fade-in">
            <div class="glitch-404" data-text="404">404</div>
            <div class="wave-decoration">
                <svg viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path fill="var(--accent)" fill-opacity="0.2" d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>
            </div>
        </div>

        <!-- Text Content -->
        <header class="page-header fade-in">
            <h1 class="page-title"><?php esc_html_e( 'Drifted Off Course?', 'cores-theme' ); ?></h1>
            <p class="error-description">
                <?php esc_html_e( 'It looks like the page you are looking for has been moved, deleted, or does not exist. Don\'t worry, we can help you navigate back to shore.', 'cores-theme' ); ?>
            </p>
        </header>

        <!-- Search Form -->
        <div class="error-search fade-in">
            <?php get_search_form(); ?>
        </div>

        <!-- Action Buttons -->
        <div class="error-actions fade-in">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cta-button">
                <i class="fas fa-home"></i> <?php esc_html_e( 'Return Home', 'cores-theme' ); ?>
            </a>
            <a href="javascript:history.back()" class="cta-button secondary-btn" style="background: transparent; color: var(--primary); border: 2px solid var(--primary); margin-left: 1rem;">
                <i class="fas fa-arrow-left"></i> <?php esc_html_e( 'Go Back', 'cores-theme' ); ?>
            </a>
        </div>

        <!-- Suggested Content -->
        <div class="error-suggestions fade-in">
            <h3><?php esc_html_e( 'Or Explore Our Latest Research', 'cores-theme' ); ?></h3>
            <div class="suggestion-grid">
                <?php
                $args = array(
                    'post_type'      => array( 'post', 'publication', 'research' ), // Include custom types
                    'posts_per_page' => 3,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'ignore_sticky_posts' => 1,
                );
                $recent_query = new WP_Query( $args );

                if ( $recent_query->have_posts() ) :
                    while ( $recent_query->have_posts() ) :
                        $recent_query->the_post();
                        ?>
                        <a href="<?php the_permalink(); ?>" class="suggestion-card">
                            <div class="suggestion-icon">
                                <i class="fas fa-compass"></i>
                            </div>
                            <div class="suggestion-text">
                                <h4><?php the_title(); ?></h4>
                                <span class="suggestion-date"><?php echo get_the_date(); ?></span>
                            </div>
                        </a>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>

        <!-- Report Link -->
        <div class="error-report fade-in">
            <p>
                <?php esc_html_e( 'Think this is a mistake?', 'cores-theme' ); ?> 
                <a href="mailto:<?php echo esc_attr( get_theme_mod( 'cores_email_1', get_option( 'admin_email' ) ) ); ?>?subject=Broken Link Report: <?php echo esc_attr( "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ); ?>">
                    <?php esc_html_e( 'Report a broken link', 'cores-theme' ); ?>
                </a>
            </p>
        </div>

    </div><!-- .container -->

</main><!-- #main-content -->

<?php
get_footer();
?>