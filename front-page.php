<?php
/**
 * The front page template file
 *
 * This is the template that displays the homepage.
 *
 * *** MAJOR IMPROVEMENT (STEP 6) ***
 * - Replaced all hard-coded button links with dynamic get_theme_mod() calls.
 * - Replaced all `div` and `span` controls (arrows, dots, scroll) with
 * accessible `<button>` and `<a>` elements with ARIA roles.
 * - Removed ALL inline `onclick=""` attributes.
 * - Internationalized all user-facing text.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CORES_Theme
 */

get_header(); // This will include the header.php file

// --- NEW (STEP 6): Get dynamic links from Customizer ---
// We get the Page ID from the Customizer setting...
$slide_1_page_id = get_theme_mod( 'cores_hero_slide_1_link' );
$slide_2_page_id = get_theme_mod( 'cores_hero_slide_2_link' );
$slide_3_page_id = get_theme_mod( 'cores_hero_slide_3_link' );

// ...then we get the permanent URL (permalink) for that Page ID.
// We also provide a fallback '#' in case no page is selected.
$slide_1_url = $slide_1_page_id ? get_permalink( $slide_1_page_id ) : esc_url( home_url( '/' ) );
$slide_2_url = $slide_2_page_id ? get_permalink( $slide_2_page_id ) : esc_url( home_url( '/' ) );
$slide_3_url = $slide_3_page_id ? get_permalink( $slide_3_page_id ) : esc_url( home_url( '/' ) );

// Get the URL for the "About" page for the scroll-down link
$about_page_url = esc_url( home_url( '/about/' ) ); // Keeping this as a fallback
$about_page = get_page_by_path( 'about' ); // A more robust way
if ( $about_page ) {
    $about_page_url = get_permalink( $about_page->ID );
}

?>

    <main id="main-content">

        <!-- ============================================ -->
        <!-- HERO SLIDER SECTION -->
        <!-- ============================================ -->
        <section class="hero-section" id="home" aria-label="<?php esc_attr_e( 'Hero Slideshow', 'cores-theme' ); ?>">
            <div class="slider-container">
                
                <!-- *** IMPROVED: Added role, id, and dynamic link *** -->
                <div class="slide active" id="slide-0" role="tabpanel">
                    <div class="slide-bg" style="background-image: url('<?php echo esc_url( get_theme_mod( 'cores_hero_slide_1', 'https://picsum.photos/seed/coastal-horizon/1920/1080.jpg' ) ); ?>');"></div>
                    <div class="slide-overlay"></div>
                    <div class="vignette"></div>
                    <div class="slide-content">
                        <h1><?php echo esc_html( get_theme_mod( 'cores_hero_slide_1_title', 'Welcome to Our Coastal Horizon' ) ); ?></h1>
                        <p><?php echo esc_html( get_theme_mod( 'cores_hero_slide_1_desc', 'Exploring the dynamics of coastal ecosystems through innovative research and technology' ) ); ?></p>
                        <a href="<?php echo esc_url( $slide_1_url ); ?>" class="cta-button"><?php esc_html_e( 'Explore Our Research', 'cores-theme' ); ?></a>
                    </div>
                </div>

                <!-- *** IMPROVED: Added role, id, and dynamic link *** -->
                <div class="slide" id="slide-1" role="tabpanel">
                    <div class="slide-bg" style="background-image: url('<?php echo esc_url( get_theme_mod( 'cores_hero_slide_2', 'https://picsum.photos/seed/coastal-research/1920/1080.jpg' ) ); ?>');"></div>
                    <div class="slide-overlay"></div>
                    <div class="vignette"></div>
                    <div class="slide-content">
                        <h1><?php echo esc_html( get_theme_mod( 'cores_hero_slide_2_title', 'What We Research For?' ) ); ?></h1>
                        <p><?php echo esc_html( get_theme_mod( 'cores_hero_slide_2_desc', 'Understanding coastal processes to protect our shorelines and communities' ) ); ?></p>
                        <a href="<?php echo esc_url( $slide_2_url ); ?>" class="cta-button"><?php esc_html_e( 'Discover Our Work', 'cores-theme' ); ?></a>
                    </div>
                </div>

                <!-- *** IMPROVED: Added role, id, and dynamic link *** -->
                <div class="slide" id="slide-2" role="tabpanel">
                    <div class="slide-bg" style="background-image: url('<?php echo esc_url( get_theme_mod( 'cores_hero_slide_3', 'https://picsum.photos/seed/cores-team/1920/1080.jpg' ) ); ?>');"></div>
                    <div class="slide-overlay"></div>
                    <div class="vignette"></div>
                    <div class="slide-content">
                        <h1><?php echo esc_html( get_theme_mod( 'cores_hero_slide_3_title', 'Meet Our Team' ) ); ?></h1>
                        <p><?php echo esc_html( get_theme_mod( 'cores_hero_slide_3_desc', 'Passionate researchers dedicated to advancing coastal science' ) ); ?></p>
                        <a href="<?php echo esc_url( $slide_3_url ); ?>" class="cta-button"><?php esc_html_e( 'Get to Know Us', 'cores-theme' ); ?></a>
                    </div>
                </div>

            </div>

            <!-- *** IMPROVED: Converted <div> to <button> for accessibility *** -->
            <div class="slider-nav">
                <button class="slider-arrow" id="prevSlide" aria-label="<?php esc_attr_e( 'Previous slide', 'cores-theme' ); ?>">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="slider-arrow" id="nextSlide" aria-label="<?php esc_attr_e( 'Next slide', 'cores-theme' ); ?>">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <!-- *** IMPROVED: Converted <span> to <button>, removed onclick, added ARIA roles *** -->
            <div class="slider-dots" role="tablist" aria-label="<?php esc_attr_e( 'Slide controls', 'cores-theme' ); ?>">
                <button class="dot active" id="dot-0" role="tab" aria-selected="true" aria-controls="slide-0" aria-label="<?php esc_attr_e( 'Go to slide 1', 'cores-theme' ); ?>"></button>
                <button class="dot" id="dot-1" role="tab" aria-selected="false" aria-controls="slide-1" aria-label="<?php esc_attr_e( 'Go to slide 2', 'cores-theme' ); ?>"></button>
                <button class="dot" id="dot-2" role="tab" aria-selected="false" aria-controls="slide-2" aria-label="<?php esc_attr_e( 'Go to slide 3', 'cores-theme' ); ?>"></button>
            </div>

            <!-- Progress Bar -->
            <div class="progress-bar" id="progressBar"></div>

        </section>

        <!-- ============================================ -->
        <!-- ANIMATED WAVE TRANSITION -->
        <!-- ============================================ -->
        <div class="wave-transition-container">
            <!-- *** IMPROVED: Converted <div> to <a>, removed onclick, added i18n *** -->
            <a href="<?php echo esc_url( $about_page_url ); ?>" class="scroll-indicator-on-wave" aria-label="<?php esc_attr_e( 'Scroll to explore site', 'cores-theme' ); ?>">
                <i class="fas fa-chevron-down"></i>
                <span><?php esc_html_e( 'Scroll to explore', 'cores-theme' ); ?></span>
            </a>
            
            <!-- Animated SVG Waves -->
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7)" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#F5F5F5" />
                </g>
            </svg>
        </div>

    </main><!-- #main-content -->

<?php
get_footer(); // This will include the footer.php file
?>