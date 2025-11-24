<?php
/**
 * The front page template file
 *
 * This is the template that displays the homepage with a modern hero slider.
 *
 * ENHANCED FEATURES:
 * - Dynamic hero slider with Customizer integration
 * - Fully accessible (WCAG 2.1 Level AA)
 * - Performance optimized
 * - Schema.org structured data
 * - Responsive design
 * - Touch-friendly controls
 * - Keyboard navigation support
 * - Modern animations
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CORES_Theme
 * @version 2.3.0
 */

get_header();

// Get dynamic slide links from Customizer
$slide_1_page_id = get_theme_mod( 'cores_hero_slide_1_link' );
$slide_2_page_id = get_theme_mod( 'cores_hero_slide_2_link' );
$slide_3_page_id = get_theme_mod( 'cores_hero_slide_3_link' );

// Get permalinks with fallbacks
$slide_1_url = $slide_1_page_id ? get_permalink( $slide_1_page_id ) : esc_url( home_url( '/' ) );
$slide_2_url = $slide_2_page_id ? get_permalink( $slide_2_page_id ) : esc_url( home_url( '/' ) );
$slide_3_url = $slide_3_page_id ? get_permalink( $slide_3_page_id ) : esc_url( home_url( '/' ) );

// Get the URL for the "About" page for scroll-down link
$about_page = get_page_by_path( 'about' );
$about_page_url = $about_page ? get_permalink( $about_page->ID ) : esc_url( home_url( '/about/' ) );

?>

    <main id="main-content" role="main">

        <!-- ============================================ -->
        <!-- HERO SLIDER SECTION -->
        <!-- ============================================ -->
        <section class="hero-section" 
                 id="home" 
                 aria-label="<?php esc_attr_e( 'Hero Slideshow', 'cores-theme' ); ?>">
            
            <div class="slider-container">
                
                <!-- Slide 1 -->
                <div class="slide active" 
                     id="slide-0" 
                     role="tabpanel" 
                     aria-label="<?php esc_attr_e( 'Slide 1 of 3', 'cores-theme' ); ?>">
                    <?php
                    $slide_1_img = get_theme_mod( 'cores_hero_slide_1', 'https://picsum.photos/seed/coastal-horizon/1920/1080.jpg' );
                    $slide_1_title = get_theme_mod( 'cores_hero_slide_1_title', __( 'Welcome to Our Coastal Horizon', 'cores-theme' ) );
                    $slide_1_desc = get_theme_mod( 'cores_hero_slide_1_desc', __( 'Exploring the dynamics of coastal ecosystems through innovative research and technology', 'cores-theme' ) );
                    ?>
                    <div class="slide-bg" 
                         style="background-image: url('<?php echo esc_url( $slide_1_img ); ?>');"
                         role="img"
                         aria-label="<?php echo esc_attr( $slide_1_title ); ?>"></div>
                    <div class="slide-overlay" aria-hidden="true"></div>
                    <div class="vignette" aria-hidden="true"></div>
                    <div class="slide-content">
                        <h1><?php echo esc_html( $slide_1_title ); ?></h1>
                        <p><?php echo esc_html( $slide_1_desc ); ?></p>
                        <a href="<?php echo esc_url( $slide_1_url ); ?>" class="cta-button">
                            <?php esc_html_e( 'Explore Our Research', 'cores-theme' ); ?>
                        </a>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="slide" 
                     id="slide-1" 
                     role="tabpanel" 
                     aria-label="<?php esc_attr_e( 'Slide 2 of 3', 'cores-theme' ); ?>"
                     aria-hidden="true">
                    <?php
                    $slide_2_img = get_theme_mod( 'cores_hero_slide_2', 'https://picsum.photos/seed/coastal-research/1920/1080.jpg' );
                    $slide_2_title = get_theme_mod( 'cores_hero_slide_2_title', __( 'What We Research For?', 'cores-theme' ) );
                    $slide_2_desc = get_theme_mod( 'cores_hero_slide_2_desc', __( 'Understanding coastal processes to protect our shorelines and communities', 'cores-theme' ) );
                    ?>
                    <div class="slide-bg" 
                         style="background-image: url('<?php echo esc_url( $slide_2_img ); ?>');"
                         role="img"
                         aria-label="<?php echo esc_attr( $slide_2_title ); ?>"></div>
                    <div class="slide-overlay" aria-hidden="true"></div>
                    <div class="vignette" aria-hidden="true"></div>
                    <div class="slide-content">
                        <h1><?php echo esc_html( $slide_2_title ); ?></h1>
                        <p><?php echo esc_html( $slide_2_desc ); ?></p>
                        <a href="<?php echo esc_url( $slide_2_url ); ?>" class="cta-button">
                            <?php esc_html_e( 'Discover Our Work', 'cores-theme' ); ?>
                        </a>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="slide" 
                     id="slide-2" 
                     role="tabpanel" 
                     aria-label="<?php esc_attr_e( 'Slide 3 of 3', 'cores-theme' ); ?>"
                     aria-hidden="true">
                    <?php
                    $slide_3_img = get_theme_mod( 'cores_hero_slide_3', 'https://picsum.photos/seed/cores-team/1920/1080.jpg' );
                    $slide_3_title = get_theme_mod( 'cores_hero_slide_3_title', __( 'Meet Our Team', 'cores-theme' ) );
                    $slide_3_desc = get_theme_mod( 'cores_hero_slide_3_desc', __( 'Passionate researchers dedicated to advancing coastal science', 'cores-theme' ) );
                    ?>
                    <div class="slide-bg" 
                         style="background-image: url('<?php echo esc_url( $slide_3_img ); ?>');"
                         role="img"
                         aria-label="<?php echo esc_attr( $slide_3_title ); ?>"></div>
                    <div class="slide-overlay" aria-hidden="true"></div>
                    <div class="vignette" aria-hidden="true"></div>
                    <div class="slide-content">
                        <h1><?php echo esc_html( $slide_3_title ); ?></h1>
                        <p><?php echo esc_html( $slide_3_desc ); ?></p>
                        <a href="<?php echo esc_url( $slide_3_url ); ?>" class="cta-button">
                            <?php esc_html_e( 'Get to Know Us', 'cores-theme' ); ?>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Slider Navigation Controls -->
            <div class="slider-nav" aria-label="<?php esc_attr_e( 'Slider navigation', 'cores-theme' ); ?>">
                <button class="slider-arrow" 
                        id="prevSlide" 
                        type="button"
                        aria-label="<?php esc_attr_e( 'Previous slide', 'cores-theme' ); ?>"
                        aria-controls="slider-container">
                    <i class="fas fa-chevron-left" aria-hidden="true"></i>
                </button>
                <button class="slider-arrow" 
                        id="nextSlide" 
                        type="button"
                        aria-label="<?php esc_attr_e( 'Next slide', 'cores-theme' ); ?>"
                        aria-controls="slider-container">
                    <i class="fas fa-chevron-right" aria-hidden="true"></i>
                </button>
            </div>

            <!-- Slider Dot Indicators -->
            <div class="slider-dots" 
                 role="tablist" 
                 aria-label="<?php esc_attr_e( 'Slide controls', 'cores-theme' ); ?>">
                <button class="dot active" 
                        id="dot-0" 
                        type="button"
                        role="tab" 
                        aria-selected="true" 
                        aria-controls="slide-0" 
                        aria-label="<?php esc_attr_e( 'Go to slide 1', 'cores-theme' ); ?>"></button>
                <button class="dot" 
                        id="dot-1" 
                        type="button"
                        role="tab" 
                        aria-selected="false" 
                        aria-controls="slide-1" 
                        aria-label="<?php esc_attr_e( 'Go to slide 2', 'cores-theme' ); ?>"></button>
                <button class="dot" 
                        id="dot-2" 
                        type="button"
                        role="tab" 
                        aria-selected="false" 
                        aria-controls="slide-2" 
                        aria-label="<?php esc_attr_e( 'Go to slide 3', 'cores-theme' ); ?>"></button>
            </div>

            <!-- Progress Bar -->
            <div class="progress-bar" 
                 id="progressBar" 
                 role="progressbar" 
                 aria-valuenow="0" 
                 aria-valuemin="0" 
                 aria-valuemax="100"
                 aria-label="<?php esc_attr_e( 'Slide progress', 'cores-theme' ); ?>"></div>

        </section>

        <!-- ============================================ -->
        <!-- ANIMATED WAVE TRANSITION -->
        <!-- ============================================ -->
        <div class="wave-transition-container">
            <!-- Scroll Indicator -->
            <a href="<?php echo esc_url( $about_page_url ); ?>" 
               class="scroll-indicator-on-wave" 
               aria-label="<?php esc_attr_e( 'Scroll to explore site content', 'cores-theme' ); ?>">
                <i class="fas fa-chevron-down" aria-hidden="true"></i>
                <span><?php esc_html_e( 'Scroll to explore', 'cores-theme' ); ?></span>
            </a>
            
            <!-- Animated SVG Waves -->
            <svg class="waves" 
                 xmlns="http://www.w3.org/2000/svg" 
                 xmlns:xlink="http://www.w3.org/1999/xlink"
                 viewBox="0 24 150 28" 
                 preserveAspectRatio="none" 
                 shape-rendering="auto"
                 role="img"
                 aria-label="<?php esc_attr_e( 'Decorative wave pattern', 'cores-theme' ); ?>">
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

        <?php
        /**
         * Hook after hero section
         * Allows plugins/child themes to add content after the hero
         */
        do_action( 'cores_after_hero' );
        ?>

    </main><!-- #main-content -->

<?php
get_footer();
?>