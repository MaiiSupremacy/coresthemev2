<?php
/**
 * The front page template file
 *
 * This is the template that displays the homepage.
 * It contains ONLY the hero slider gallery with 3 slides.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CORES_Theme
 */

get_header(); // This will include the header.php file
?>

    <main id="main-content">

        <!-- ============================================ -->
        <!-- HERO SLIDER SECTION -->
        <!-- ============================================ -->
        <section class="hero-section" id="home">
            <div class="slider-container">
                
                <!-- SLIDE 1: Explore Our Research -->
                <div class="slide active">
                    <div class="slide-bg" style="background-image: url('<?php echo esc_url( get_theme_mod( 'cores_hero_slide_1', 'https://picsum.photos/seed/coastal-horizon/1920/1080.jpg' ) ); ?>');"></div>
                    <div class="slide-overlay"></div>
                    <div class="vignette"></div>
                    <div class="slide-content">
                        <h1><?php echo esc_html( get_theme_mod( 'cores_hero_slide_1_title', 'Welcome to Our Coastal Horizon' ) ); ?></h1>
                        <p><?php echo esc_html( get_theme_mod( 'cores_hero_slide_1_desc', 'Exploring the dynamics of coastal ecosystems through innovative research and technology' ) ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/research/' ) ); ?>" class="cta-button">Explore Our Research</a>
                    </div>
                </div>

                <!-- SLIDE 2: Discover Our Work -->
                <div class="slide">
                    <div class="slide-bg" style="background-image: url('<?php echo esc_url( get_theme_mod( 'cores_hero_slide_2', 'https://picsum.photos/seed/coastal-research/1920/1080.jpg' ) ); ?>');"></div>
                    <div class="slide-overlay"></div>
                    <div class="vignette"></div>
                    <div class="slide-content">
                        <h1><?php echo esc_html( get_theme_mod( 'cores_hero_slide_2_title', 'What We Research For?' ) ); ?></h1>
                        <p><?php echo esc_html( get_theme_mod( 'cores_hero_slide_2_desc', 'Understanding coastal processes to protect our shorelines and communities' ) ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="cta-button">Discover Our Work</a>
                    </div>
                </div>

                <!-- SLIDE 3: Get to Know Us -->
                <div class="slide">
                    <div class="slide-bg" style="background-image: url('<?php echo esc_url( get_theme_mod( 'cores_hero_slide_3', 'https://picsum.photos/seed/cores-team/1920/1080.jpg' ) ); ?>');"></div>
                    <div class="slide-overlay"></div>
                    <div class="vignette"></div>
                    <div class="slide-content">
                        <h1><?php echo esc_html( get_theme_mod( 'cores_hero_slide_3_title', 'Meet Our Team' ) ); ?></h1>
                        <p><?php echo esc_html( get_theme_mod( 'cores_hero_slide_3_desc', 'Passionate researchers dedicated to advancing coastal science' ) ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/people/' ) ); ?>" class="cta-button">Get to Know Us</a>
                    </div>
                </div>

            </div>

            <!-- Slider Navigation Arrows -->
            <div class="slider-nav">
                <div class="slider-arrow" id="prevSlide">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="slider-arrow" id="nextSlide">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>

            <!-- Slider Dots -->
            <div class="slider-dots">
                <span class="dot active" onclick="goToSlide(0)"></span>
                <span class="dot" onclick="goToSlide(1)"></span>
                <span class="dot" onclick="goToSlide(2)"></span>
            </div>

            <!-- Progress Bar -->
            <div class="progress-bar" id="progressBar"></div>

        </section>

        <!-- ============================================ -->
        <!-- ANIMATED WAVE TRANSITION -->
        <!-- ============================================ -->
        <div class="wave-transition-container">
            <!-- Scroll Indicator on Wave -->
            <div class="scroll-indicator-on-wave" onclick="window.location.href='<?php echo esc_url( home_url( '/about/' ) ); ?>'">
                <i class="fas fa-chevron-down"></i>
                <span>Scroll to explore</span>
            </div>
            
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