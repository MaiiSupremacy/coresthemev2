<?php
/**
 * Template Name: Research Page
 *
 * This is the template that displays the Research page.
 *
 * *** MAJOR IMPROVEMENT: ***
 * - Removed ALL hard-coded HTML for the map and timeline.
 * - Map is now 100% dynamic, populating from "Appearance > Customize > Research Page: Map".
 * - Timeline is now 100% dynamic, populating from the "Milestones" Custom Post Type.
 * - Removed all inline onclick="" attributes from map controls.
 * - All text is internationalized and accessible.
 * - Gallery was already dynamic, but text has been internationalized.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CORES_Theme
 */

get_header(); // This will include the header.php file
?>

    <main id="main-content">

        <!-- ============================================ -->
        <!-- PAGE TITLE -->
        <!-- ============================================ -->
        <section style="padding: 10rem 5% 4rem; background: var(--white);">
            <h1 class="section-title fade-in"><?php esc_html_e( 'Our Research', 'cores-theme' ); ?></h1>
            <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto; font-size: 1.2rem; color: var(--dark); line-height: 1.8;">
                <?php esc_html_e( 'Explore our research locations, milestones, and visual documentation of coastal studies at Clungup and surrounding areas.', 'cores-theme' ); ?>
            </p>
        </section>

        <!-- ============================================ -->
        <!-- RESEARCH LOCATIONS MAP (OpenStreetMap) -->
        <!-- ============================================ -->
        <section style="padding: 0 5% 6rem; background: var(--white);">
            <h2 class="section-title fade-in" style="margin-bottom: 3rem;"><?php esc_html_e( 'Research Locations', 'cores-theme' ); ?></h2>
            
            <div class="osm-container fade-in">
                <!-- 
                    *** IMPROVED: Map now gets coordinates and zoom from Customizer.
                    *** These data- attributes are read by js/main.js
                -->
                <div id="map" class="osm-map" 
                     data-lat="<?php echo esc_attr( get_theme_mod( 'cores_map_lat', '-8.4384848' ) ); ?>"
                     data-lng="<?php echo esc_attr( get_theme_mod( 'cores_map_lng', '112.6678858' ) ); ?>"
                     data-zoom="<?php echo esc_attr( get_theme_mod( 'cores_map_zoom', '12' ) ); ?>"
                     data-marker-title="<?php echo esc_attr( get_theme_mod( 'cores_map_marker_title', 'Clungup Research Location' ) ); ?>"
                     role="application"
                     aria-label="<?php esc_attr_e( 'Interactive map of research locations', 'cores-theme' ); ?>">
                </div>
                
                <div class="osm-controls">
                    <!-- 
                        *** IMPROVED: Removed onclick="", added IDs for js/main.js to hook into.
                        *** Converted <div> to <button> for accessibility.
                    -->
                    <button class="osm-control-btn" id="mapZoomIn" aria-label="<?php esc_attr_e( 'Zoom in', 'cores-theme' ); ?>">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button class="osm-control-btn" id="mapZoomOut" aria-label="<?php esc_attr_e( 'Zoom out', 'cores-theme' ); ?>">
                        <i class="fas fa-minus"></i>
                    </button>
                    <div class="osm-zoom-level" aria-live="polite">
                        <?php esc_html_e( 'Zoom:', 'cores-theme' ); ?> <?php echo esc_html( get_theme_mod( 'cores_map_zoom', '12' ) ); ?>
                    </div>
                </div>
            </div>
            
            <!-- *** IMPROVED: Map caption text is now dynamic from Customizer *** -->
            <p class="fade-in" style="text-align: center; color: var(--dark); margin-top: 1.5rem; font-size: 0.95rem;">
                <i class="fas fa-map-marker-alt" style="color: var(--accent);"></i> 
                <strong><?php echo esc_html( get_theme_mod( 'cores_map_marker_title', 'Clungup Research Location' ) ); ?>:</strong> <?php echo esc_html( get_theme_mod( 'cores_map_lat', '-8.4384848' ) ); ?>, <?php echo esc_html( get_theme_mod( 'cores_map_lng', '112.6678858' ) ); ?>
            </p>
        </section>

        <!-- ============================================ -->
        <!-- RESEARCH MILESTONES TIMELINE -->
        <!-- ============================================ -->
        <section style="padding: 6rem 5%; background: linear-gradient(135deg, rgba(224, 225, 221, 0.3), rgba(255, 255, 255, 1));">
            <h2 class="section-title fade-in"><?php esc_html_e( 'Research Milestones', 'cores-theme' ); ?></h2>
            
            <div class="timeline fade-in">
                
                <?php
                // 1. WP_Query for Milestones
                $args_milestones = array(
                    'post_type'      => 'milestone',
                    'posts_per_page' => 4, // Show the 4 most recent
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                );

                $milestone_query = new WP_Query( $args_milestones );

                if ( $milestone_query->have_posts() ) :
                    while ( $milestone_query->have_posts() ) :
                        $milestone_query->the_post();
                        ?>
                        
                        <!-- *** THIS IS NOW DYNAMIC *** -->
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <!-- Use Excerpt for the Date -->
                                <div class="timeline-date"><?php echo esc_html( get_the_excerpt() ); ?></div>
                                <!-- Use Title for the Milestone Title -->
                                <h4><?php the_title(); ?></h4>
                                <!-- Use Main Editor for the Description -->
                                <?php the_content(); ?>
                                <a href="<?php the_permalink(); ?>" class="milestone-link">
                                    <?php esc_html_e( 'View Milestone', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                    <?php
                    endwhile;
                else :
                    echo '<p style="text-align: center;">' . esc_html__( 'No milestones found. Please add them in the "Milestones" section of the dashboard.', 'cores-theme' ) . '</p>';
                endif;
                wp_reset_postdata(); // Reset the query
                ?>
                
            </div>
        </section>

        <!-- ============================================ -->
        <!-- RESEARCH GALLERY CAROUSEL (Swiper.js) -->
        <!-- ============================================ -->
        <section class="gallery-section" id="gallery" style="padding: 6rem 5% 8rem; background: var(--white);">
            <h2 class="section-title fade-in"><?php esc_html_e( 'Research Gallery', 'cores-theme' ); ?></h2>
            
            <p class="fade-in" style="text-align: center; max-width: 700px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark);">
                <?php esc_html_e( 'Visual documentation of our fieldwork, equipment deployment, and research activities at coastal sites.', 'cores-theme' ); ?>
            </p>
            
            <!-- Swiper Carousel Container -->
            <div class="gallery-carousel-container fade-in">
                <!-- Slider main container -->
                <div class="swiper gallery-carousel">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        
                        <!-- Loop 6 times for the 6 gallery slots from Customizer -->
                        <?php for ( $i = 1; $i <= 6; $i++ ) :
                            $image_url = get_theme_mod( "cores_gallery_{$i}", 'https://picsum.photos/seed/research' . $i . '/800/600.jpg' );
                            $caption   = get_theme_mod( "cores_gallery_{$i}_caption", esc_html__( 'Default Gallery Caption', 'cores-theme' ) );
                        ?>
                        <div class="swiper-slide">
                            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $caption ); ?>" />
                            <div class="gallery-caption"><?php echo esc_html( $caption ); ?></div>
                        </div>
                        <?php endfor; ?>
                        
                    </div>
                    
                    <!-- Pagination (dots) -->
                    <div class="swiper-pagination"></div>
                </div>
                
                <!-- Navigation Arrows -->
                <div class="swiper-button-prev" aria-label="<?php esc_attr_e( 'Previous slide', 'cores-theme' ); ?>"></div>
                <div class="swiper-button-next" aria-label="<?php esc_attr_e( 'Next slide', 'cores-theme' ); ?>"></div>
            </div>
        </section>

    </main><!-- #main-content -->

<?php
get_footer(); // This will include the footer.php file
?>