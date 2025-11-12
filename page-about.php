<?php
/**
 * Template Name: About Page
 *
 * This is the template that displays the About page.
 * It contains: Introduction, Research Focus, Equipment Showcase, and Impact Stats.
 *
 * *** IMPROVED: All static content (stats, equipment) is now dynamic via the Customizer.
 * *** Removed inline onclick="" from filters and moved logic to main.js.
 * *** Added ARIA roles for accessibility and internationalized all text. ***
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CORES_Theme
 */

get_header(); // This will include the header.php file
?>

    <main id="main-content">

        <!-- ============================================ -->
        <!-- ABOUT INTRODUCTION SECTION -->
        <!-- ============================================ -->
        <section class="about-intro-section" style="padding: 10rem 5% 4rem; background: var(--white);">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                <h1 class="section-title fade-in"><?php esc_html_e( 'About CORES', 'cores-theme' ); ?></h1>
                
                <div class="about-intro-content fade-in" style="max-width: 900px; margin: 0 auto; text-align: center;">
                    <p style="font-size: 1.3rem; line-height: 1.8; color: var(--dark); margin-bottom: 2rem;">
                        <?php
                        printf(
                            /* translators: 1: Strong tag, 2: Closing strong tag */
                            esc_html__( 'We are %1$sCoastal Researchers (CORES)%2$s, a dedicated team of scientists and engineers committed to advancing our understanding of coastal ecosystems and processes. Based at the Water Resources Engineering Department of Brawijaya University, we combine cutting-edge technology with field expertise to address critical challenges facing our coastlines.', 'cores-theme' ),
                            '<strong>',
                            '</strong>'
                        );
                        ?>
                    </p>
                    <p style="font-size: 1.1rem; line-height: 1.8; color: var(--dark); margin-bottom: 2rem;">
                        <?php
                        printf(
                            /* translators: 1: Strong tag, 2: Closing strong tag, 3: Strong tag, 4: Closing strong tag, 5: Strong tag, 6: Closing strong tag */
                            esc_html__( 'Our multidisciplinary approach integrates %1$scoastal dynamics monitoring%2$s, %3$sdata analysis%4$s, %5$sremote sensing%6$s, and %7$secosystem studies%8$s to provide comprehensive insights into coastal behavior. Through innovative research methodologies and state-of-the-art equipment, we strive to develop sustainable solutions for coastal protection and management.', 'cores-theme' ),
                            '<strong>',
                            '</strong>',
                            '<strong>',
                            '</strong>',
                            '<strong>',
                            '</strong>',
                            '<strong>',
                            '</strong>'
                        );
                        ?>
                    </p>
                    <p style="font-size: 1.1rem; line-height: 1.8; color: var(--dark);">
                        <?php esc_html_e( 'From drone-based topographic mapping to mangrove parameterization, from wave gauge deployment to sediment analysis, our research spans the full spectrum of coastal science. We believe that understanding these complex systems is essential for protecting our shorelines, communities, and marine ecosystems in an era of climate change and increasing coastal pressures.', 'cores-theme' ); ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- RESEARCH FOCUS SECTION -->
        <!-- ============================================ -->
        <section class="research-section" id="research-focus" style="padding: 6rem 5%; background: var(--white);">
            <h2 class="section-title fade-in"><?php esc_html_e( 'Our Research Focus', 'cores-theme' ); ?></h2>
            
            <!-- *** IMPROVED: Removed inline onclick="", added ARIA roles *** -->
            <div class="research-filters fade-in" role="tablist" aria-label="<?php esc_attr_e( 'Research Filters', 'cores-theme' ); ?>">
                <button class="filter-btn active" data-category="all" role="tab" aria-selected="true" aria-controls="research-cards-container">
                    <?php esc_html_e( 'All Research', 'cores-theme' ); ?>
                </button>
                <button class="filter-btn" data-category="monitoring" role="tab" aria-selected="false" aria-controls="research-cards-container">
                    <?php esc_html_e( 'Coastal Monitoring', 'cores-theme' ); ?>
                </button>
                <button class="filter-btn" data-category="analysis" role="tab" aria-selected="false" aria-controls="research-cards-container">
                    <?php esc_html_e( 'Data Analysis', 'cores-theme' ); ?>
                </button>
                <button class="filter-btn" data-category="ecosystem" role="tab" aria-selected="false" aria-controls="research-cards-container">
                    <?php esc_html_e( 'Ecosystem Studies', 'cores-theme' ); ?>
                </button>
            </div>

            <div class="cards-container" id="research-cards-container">
                <div class="card fade-in" data-category="monitoring">
                    <div class="card-icon"><i class="fas fa-water"></i></div>
                    <h3><?php esc_html_e( 'Coastal Dynamics', 'cores-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Advanced monitoring of wave patterns, tidal movements, and coastal processes using state-of-the-art equipment including wave gauges and GNSS rovers.', 'cores-theme' ); ?></p>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'research' ) ) ); ?>" class="card-link"><?php esc_html_e( 'Learn More', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="card fade-in" data-category="analysis">
                    <div class="card-icon"><i class="fas fa-chart-line"></i></div>
                    <h3><?php esc_html_e( 'Data Analysis', 'cores-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Computational modeling and statistical analysis of coastal processes, climate change impacts, and erosion patterns using advanced software tools.', 'cores-theme' ); ?></p>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'research' ) ) ); ?>" class="card-link"><?php esc_html_e( 'View Projects', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="card fade-in" data-category="monitoring">
                    <div class="contour-icon">
                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <!-- Drone Body -->
                            <ellipse cx="50" cy="50" rx="12" ry="6" class="drone-body"/>
                            
                            <!-- Drone Arms -->
                            <line x1="38" y1="50" x2="25" y2="35" class="drone-arms"/>
                            <line x1="62" y1="50" x2="75" y2="35" class="drone-arms"/>
                            <line x1="38" y1="50" x2="25" y2="65" class="drone-arms"/>
                            <line x1="62" y1="50" x2="75" y2="65" class="drone-arms"/>
                            
                            <!-- Propellers -->
                            <circle cx="25" cy="35" r="6" class="drone-propellers"/>
                            <circle cx="75" cy="35" r="6" class="drone-propellers"/>
                            <circle cx="25" cy="65" r="6" class="drone-propellers"/>
                            <circle cx="75" cy="65" r="6" class="drone-propellers"/>
                            
                            <!-- Camera/Gimbal -->
                            <circle cx="50" cy="54" r="3" fill="#05BFDB"/>
                            <rect x="48" y="56" width="4" height="5" fill="#0A4D68"/>
                            
                            <!-- Topographic Contour Lines -->
                            <path d="M 15 80 Q 35 75, 50 80 T 85 80" class="topographic-lines"/>
                            <path d="M 15 85 Q 35 80, 50 85 T 85 85" class="topographic-lines"/>
                            <path d="M 15 90 Q 35 85, 50 90 T 85 90" class="topographic-lines"/>
                        </svg>
                    </div>
                    <h3><?php esc_html_e( 'Drone Topography', 'cores-theme' ); ?></h3>
                    <p><?php esc_html_e( 'High-precision coastal mapping using drone photogrammetry with WebODM software for detailed terrain analysis and contour mapping.', 'cores-theme' ); ?></p>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'research' ) ) ); ?>" class="card-link"><?php esc_html_e( 'See Technology', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="card fade-in" data-category="ecosystem">
                    <div class="card-icon"><i class="fas fa-tree"></i></div>
                    <h3><?php esc_html_e( 'Mangrove Studies', 'cores-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Comprehensive mangrove ecosystem research including parameterization, carbon sequestration studies, and coastal protection analysis.', 'cores-theme' ); ?></p>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'research' ) ) ); ?>" class="card-link"><?php esc_html_e( 'Explore Research', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="card fade-in" data-category="analysis">
                    <div class="card-icon"><i class="fas fa-flask"></i></div>
                    <h3><?php esc_html_e( 'Sediment Analysis', 'cores-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Laboratory and field-based sediment composition analysis to understand coastal evolution and transport patterns.', 'cores-theme' ); ?></p>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'research' ) ) ); ?>" class="card-link"><?php esc_html_e( 'View Methods', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="card fade-in" data-category="monitoring">
                    <div class="card-icon"><i class="fas fa-satellite"></i></div>
                    <h3><?php esc_html_e( 'Remote Sensing', 'cores-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Satellite imagery and aerial photography analysis for large-scale coastal monitoring and change detection.', 'cores-theme' ); ?></p>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'research' ) ) ); ?>" class="card-link"><?php esc_html_e( 'Discover More', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- EQUIPMENT SHOWCASE SECTION -->
        <!-- ============================================ -->
        <section class="equipment-section" style="padding: 6rem 5%; background: linear-gradient(135deg, rgba(224, 225, 221, 0.3), rgba(255, 255, 255, 1));">
            <h2 class="section-title fade-in"><?php esc_html_e( 'Our Research Equipment', 'cores-theme' ); ?></h2>
            
            <div class="equipment-showcase">
                <!-- *** IMPROVED: Content is now dynamic from Customizer *** -->
                
                <?php
                // We will loop 4 times, for 4 equipment slots
                $default_img = 'https://picsum.photos/seed/equipment/400/300.jpg';
                
                for ( $i = 1; $i <= 4; $i++ ) :
                    $image_url = get_theme_mod( "cores_equipment_image_$i", $default_img );
                    $name      = get_theme_mod( "cores_equipment_name_$i", esc_html__( 'Research Equipment', 'cores-theme' ) );
                    $desc      = get_theme_mod( "cores_equipment_desc_$i", esc_html__( 'Set a description in the Customizer.', 'cores-theme' ) );
                    
                    // Use a unique placeholder image for each default
                    if ( $image_url === $default_img ) {
                        $image_url = 'https://picsum.photos/seed/equipment' . $i . '/400/300.jpg';
                    }
                ?>
                <div class="equipment-card fade-in">
                    <div class="equipment-image" style="background-image: url('<?php echo esc_url( $image_url ); ?>');"></div>
                    <div class="equipment-info">
                        <div class="equipment-name"><?php echo esc_html( $name ); ?></div>
                        <div class="equipment-desc"><?php echo esc_html( $desc ); ?></div>
                    </div>
                </div>
                <?php endfor; ?>
                
            </div>
        </section>

        <!-- ============================================ -->
        <!-- IMPACT STATS SECTION -->
        <!-- ============================================ -->
        <section class="impact-section" style="padding: 6rem 5%; background: var(--white);">
            <h2 class="section-title fade-in"><?php esc_html_e( 'Our Impact', 'cores-theme' ); ?></h2>
            
            <!-- *** IMPROVED: Stats are now dynamic from Customizer *** -->
            <div class="stats-container">
                <div class="stat-card fade-in">
                    <div class="stat-number"><?php echo esc_html( get_theme_mod( 'cores_stat_1_number', '10+' ) ); ?></div>
                    <div class="stat-label"><?php echo esc_html( get_theme_mod( 'cores_stat_1_label', esc_html__( 'Research Projects', 'cores-theme' ) ) ); ?></div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-number"><?php echo esc_html( get_theme_mod( 'cores_stat_2_number', '25+' ) ); ?></div>
                    <div class="stat-label"><?php echo esc_html( get_theme_mod( 'cores_stat_2_label', esc_html__( 'Publications', 'cores-theme' ) ) ); ?></div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-number"><?php echo esc_html( get_theme_mod( 'cores_stat_3_number', '15' ) ); ?></div>
                    <div class="stat-label"><?php echo esc_html( get_theme_mod( 'cores_stat_3_label', esc_html__( 'Team Members', 'cores-theme' ) ) ); ?></div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-number"><?php echo esc_html( get_theme_mod( 'cores_stat_4_number', '5+' ) ); ?></div>
                    <div class="stat-label"><?php echo esc_html( get_theme_mod( 'cores_stat_4_label', esc_html__( 'Partner Institutions', 'cores-theme' ) ) ); ?></div>
                </div>
            </div>
        </section>

    </main><!-- #main-content -->

<?php
get_footer(); // This will include the footer.php file
?>