<?php
/**
 * Template Name: Research Page
 *
 * This is the template that displays the Research page.
 * It contains: OpenStreetMap, Research Milestones Timeline, and Research Gallery Carousel.
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
            <h1 class="section-title fade-in">Our Research</h1>
            <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto; font-size: 1.2rem; color: var(--dark); line-height: 1.8;">
                Explore our research locations, milestones, and visual documentation of coastal studies at Clungup and surrounding areas.
            </p>
        </section>

        <!-- ============================================ -->
        <!-- RESEARCH LOCATIONS MAP (OpenStreetMap) -->
        <!-- ============================================ -->
        <section style="padding: 0 5% 6rem; background: var(--white);">
            <h2 class="section-title fade-in" style="margin-bottom: 3rem;">Research Locations</h2>
            
            <div class="osm-container fade-in">
                <div id="map" class="osm-map"></div>
                <div class="osm-controls">
                    <button class="osm-control-btn" onclick="zoomIn()">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button class="osm-control-btn" onclick="zoomOut()">
                        <i class="fas fa-minus"></i>
                    </button>
                    <div class="osm-zoom-level">Zoom: 12</div>
                </div>
            </div>
            
            <p class="fade-in" style="text-align: center; color: var(--dark); margin-top: 1.5rem; font-size: 0.95rem;">
                <i class="fas fa-map-marker-alt" style="color: var(--accent);"></i> 
                <strong>Clungup Research Location:</strong> -8.4384848, 112.6678858 | 
                <strong>AOI:</strong> Mangrove Conservation Area
            </p>
        </section>

        <!-- ============================================ -->
        <!-- RESEARCH MILESTONES TIMELINE -->
        <!-- ============================================ -->
        <section style="padding: 6rem 5%; background: linear-gradient(135deg, rgba(224, 225, 221, 0.3), rgba(255, 255, 255, 1));">
            <h2 class="section-title fade-in">Research Milestones</h2>
            
            <div class="timeline fade-in">
                <!-- Milestone 1 -->
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date">6 September 2025</div>
                        <h4>Clungup Fieldwork 1</h4>
                        <p>Deployment of 4 wave gauges at designated monitoring points. Field sampling concluded with the acquisition of 14 sediment samples and 5 water quality samples. Drone Mapping</p>
                        <a href="#" class="milestone-link">View Milestone <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- Milestone 2 -->
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date">14 September 2025</div>
                        <h4>Clungup Fieldwork 2</h4>
                        <p>Retrieved optical sensor video logs, completed mangrove biophysical parameterization, successfully collected wave gauge data, and acquired 17 additional sediment samples.</p>
                        <a href="#" class="milestone-link">View Milestone <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- Milestone 3 -->
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date">Coming Soon</div>
                        <h4>-</h4>
                        <p>-</p>
                        <a href="#" class="milestone-link">View Milestone <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- Milestone 4 -->
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date">Coming Soon</div>
                        <h4>-</h4>
                        <p>-</p>
                        <a href="#" class="milestone-link">View Milestone <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- RESEARCH GALLERY CAROUSEL (Swiper.js) -->
        <!-- ============================================ -->
        <section class="gallery-section" id="gallery" style="padding: 6rem 5% 8rem; background: var(--white);">
            <h2 class="section-title fade-in">Research Gallery</h2>
            
            <p class="fade-in" style="text-align: center; max-width: 700px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark);">
                Visual documentation of our fieldwork, equipment deployment, and research activities at coastal sites.
            </p>
            
            <!-- Swiper Carousel Container -->
            <div class="gallery-carousel-container fade-in">
                <!-- Slider main container -->
                <div class="swiper gallery-carousel">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slide 1 -->
                        <div class="swiper-slide">
                            <img src="<?php echo esc_url( get_theme_mod( 'cores_gallery_1', 'https://picsum.photos/seed/research1/800/600.jpg' ) ); ?>" alt="<?php echo esc_attr( get_theme_mod( 'cores_gallery_1_caption', 'Field research at coastal monitoring station' ) ); ?>" />
                            <div class="gallery-caption"><?php echo esc_html( get_theme_mod( 'cores_gallery_1_caption', 'Field research at coastal monitoring station' ) ); ?></div>
                        </div>
                        
                        <!-- Slide 2 -->
                        <div class="swiper-slide">
                            <img src="<?php echo esc_url( get_theme_mod( 'cores_gallery_2', 'https://picsum.photos/seed/research2/800/600.jpg' ) ); ?>" alt="<?php echo esc_attr( get_theme_mod( 'cores_gallery_2_caption', 'Aerial survey using research drone' ) ); ?>" />
                            <div class="gallery-caption"><?php echo esc_html( get_theme_mod( 'cores_gallery_2_caption', 'Aerial survey using research drone' ) ); ?></div>
                        </div>
                        
                        <!-- Slide 3 -->
                        <div class="swiper-slide">
                            <img src="<?php echo esc_url( get_theme_mod( 'cores_gallery_3', 'https://picsum.photos/seed/research3/800/600.jpg' ) ); ?>" alt="<?php echo esc_attr( get_theme_mod( 'cores_gallery_3_caption', 'Laboratory sediment analysis' ) ); ?>" />
                            <div class="gallery-caption"><?php echo esc_html( get_theme_mod( 'cores_gallery_3_caption', 'Laboratory sediment analysis' ) ); ?></div>
                        </div>
                        
                        <!-- Slide 4 -->
                        <div class="swiper-slide">
                            <img src="<?php echo esc_url( get_theme_mod( 'cores_gallery_4', 'https://picsum.photos/seed/research4/800/600.jpg' ) ); ?>" alt="<?php echo esc_attr( get_theme_mod( 'cores_gallery_4_caption', 'Mangrove ecosystem parameterization' ) ); ?>" />
                            <div class="gallery-caption"><?php echo esc_html( get_theme_mod( 'cores_gallery_4_caption', 'Mangrove ecosystem parameterization' ) ); ?></div>
                        </div>
                        
                        <!-- Slide 5 -->
                        <div class="swiper-slide">
                            <img src="<?php echo esc_url( get_theme_mod( 'cores_gallery_5', 'https://picsum.photos/seed/research5/800/600.jpg' ) ); ?>" alt="<?php echo esc_attr( get_theme_mod( 'cores_gallery_5_caption', 'Wave gauge deployment and measurement' ) ); ?>" />
                            <div class="gallery-caption"><?php echo esc_html( get_theme_mod( 'cores_gallery_5_caption', 'Wave gauge deployment and measurement' ) ); ?></div>
                        </div>
                        
                        <!-- Slide 6 -->
                        <div class="swiper-slide">
                            <img src="<?php echo esc_url( get_theme_mod( 'cores_gallery_6', 'https://picsum.photos/seed/research6/800/600.jpg' ) ); ?>" alt="<?php echo esc_attr( get_theme_mod( 'cores_gallery_6_caption', 'Research team planning session' ) ); ?>" />
                            <div class="gallery-caption"><?php echo esc_html( get_theme_mod( 'cores_gallery_6_caption', 'Research team planning session' ) ); ?></div>
                        </div>
                    </div>
                    
                    <!-- Pagination (dots) -->
                    <div class="swiper-pagination"></div>
                </div>
                
                <!-- Navigation Arrows -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </section>

    </main><!-- #main-content -->

<?php
get_footer(); // This will include the footer.php file
?>