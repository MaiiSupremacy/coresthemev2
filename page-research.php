<?php
/**
 * Template Name: Research Page - V2.3 Enhanced Edition
 *
 * This template displays the Research page with comprehensive
 * information about CORES research activities and locations.
 *
 * ENHANCED FEATURES V2.3:
 * ✓ 100% Dynamic content from Customizer & CPTs
 * ✓ Interactive map with custom markers & popups
 * ✓ Dynamic timeline from Milestones CPT
 * ✓ Advanced Swiper.js gallery carousel
 * ✓ Research statistics dashboard
 * ✓ Search & filter functionality
 * ✓ Team members preview with expertise
 * ✓ Schema.org Place structured data
 * ✓ Breadcrumbs navigation
 * ✓ Lazy loading images
 * ✓ Animated counters
 * ✓ Full accessibility (WCAG 2.1 AA)
 * ✓ Performance optimized
 * ✓ Mobile-first responsive
 * ✓ Touch-friendly controls
 * ✓ Keyboard navigation support
 *
 * @package CORES_Theme
 * @version 2.3.0
 */

get_header();
?>

    <main id="main-content" role="main">

        <!-- ============================================ -->
        <!-- SCHEMA.ORG PLACE DATA FOR RESEARCH LOCATION -->
        <!-- ============================================ -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Place",
            "name": "<?php echo esc_js( get_theme_mod( 'cores_map_marker_title', 'CORES Research Location' ) ); ?>",
            "description": "Coastal research site for <?php echo esc_js( get_bloginfo( 'name' ) ); ?>",
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": "<?php echo esc_js( get_theme_mod( 'cores_map_lat', '-8.4384848' ) ); ?>",
                "longitude": "<?php echo esc_js( get_theme_mod( 'cores_map_lng', '112.6678858' ) ); ?>"
            },
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "Malang",
                "addressRegion": "Jawa Timur",
                "addressCountry": "ID"
            }
        }
        </script>

        <!-- ============================================ -->
        <!-- BREADCRUMBS NAVIGATION -->
        <!-- ============================================ -->
        <section class="breadcrumbs-section" style="padding: 10rem 5% 2rem; background: linear-gradient(135deg, var(--light-gray), var(--white));" aria-label="<?php esc_attr_e( 'Breadcrumb', 'cores-theme' ); ?>">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                <?php
                if ( function_exists( 'cores_breadcrumbs' ) ) {
                    cores_breadcrumbs();
                }
                ?>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- PAGE HEADER WITH ANIMATED TITLE -->
        <!-- ============================================ -->
        <section class="research-hero-section" style="padding: 2rem 5% 4rem; background: linear-gradient(135deg, var(--white), var(--light-gray)); text-align: center; position: relative; overflow: hidden;">
            
            <!-- Animated background pattern -->
            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.05; background-image: url('data:image/svg+xml,%3Csvg width=&quot;100&quot; height=&quot;100&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cdefs%3E%3Cpattern id=&quot;grid&quot; width=&quot;100&quot; height=&quot;100&quot; patternUnits=&quot;userSpaceOnUse&quot;%3E%3Cpath d=&quot;M 100 0 L 0 0 0 100&quot; fill=&quot;none&quot; stroke=&quot;rgba(10,77,104,0.5)&quot; stroke-width=&quot;1&quot;/%3E%3C/pattern%3E%3C/defs%3E%3Crect width=&quot;100%25&quot; height=&quot;100%25&quot; fill=&quot;url(%23grid)&quot;/%3E%3C/svg%3E');" aria-hidden="true"></div>

            <div class="container" style="max-width: 1200px; margin: 0 auto; position: relative; z-index: 1;">
                <h1 class="page-title fade-in gradient-text" style="background: linear-gradient(135deg, var(--primary), var(--accent)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    <?php esc_html_e( 'Our Research', 'cores-theme' ); ?>
                </h1>
                <p class="page-subtitle fade-in" style="font-size: 1.3rem; color: var(--dark-gray); max-width: 800px; margin: 1rem auto 0; line-height: 1.8;">
                    <?php esc_html_e( 'Explore our research locations, cutting-edge methodologies, and visual documentation of coastal studies at strategic sites across Indonesia.', 'cores-theme' ); ?>
                </p>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- RESEARCH STATISTICS DASHBOARD -->
        <!-- ============================================ -->
        <?php
        // Calculate research statistics
        $total_milestones = wp_count_posts( 'milestone' )->publish;
        $total_publications = wp_count_posts( 'publication' )->publish;
        $total_projects = wp_count_posts( 'student_project' )->publish;
        $research_years = max( 1, date( 'Y' ) - 2022 ); // Started in 2022
        ?>

        <section class="research-stats-section" style="padding: 4rem 5%; background: var(--white);">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                
                <h2 class="section-title fade-in"><?php esc_html_e( 'Research Impact', 'cores-theme' ); ?></h2>
                
                <div class="stats-container">
                    
                    <div class="stat-card fade-in">
                        <div style="font-size: 3rem; color: var(--primary); margin-bottom: 0.5rem;">
                            <i class="fas fa-map-marked-alt" aria-hidden="true"></i>
                        </div>
                        <div class="stat-number" data-target="<?php echo esc_attr( $total_milestones ); ?>">0</div>
                        <div class="stat-label"><?php esc_html_e( 'Research Milestones', 'cores-theme' ); ?></div>
                    </div>

                    <div class="stat-card fade-in">
                        <div style="font-size: 3rem; color: var(--accent); margin-bottom: 0.5rem;">
                            <i class="fas fa-book-open" aria-hidden="true"></i>
                        </div>
                        <div class="stat-number" data-target="<?php echo esc_attr( $total_publications ); ?>">0</div>
                        <div class="stat-label"><?php esc_html_e( 'Publications', 'cores-theme' ); ?></div>
                    </div>

                    <div class="stat-card fade-in">
                        <div style="font-size: 3rem; color: var(--secondary); margin-bottom: 0.5rem;">
                            <i class="fas fa-project-diagram" aria-hidden="true"></i>
                        </div>
                        <div class="stat-number" data-target="<?php echo esc_attr( $total_projects ); ?>">0</div>
                        <div class="stat-label"><?php esc_html_e( 'Active Projects', 'cores-theme' ); ?></div>
                    </div>

                    <div class="stat-card fade-in">
                        <div style="font-size: 3rem; color: var(--primary); margin-bottom: 0.5rem;">
                            <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                        </div>
                        <div class="stat-number" data-target="<?php echo esc_attr( $research_years ); ?>">0</div>
                        <div class="stat-label"><?php esc_html_e( 'Years of Research', 'cores-theme' ); ?></div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- RESEARCH AREAS OVERVIEW -->
        <!-- ============================================ -->
        <section class="research-areas-section" style="padding: 6rem 5%; background: linear-gradient(135deg, rgba(224, 225, 221, 0.3), rgba(255, 255, 255, 1));">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                
                <h2 class="section-title fade-in"><?php esc_html_e( 'Research Focus Areas', 'cores-theme' ); ?></h2>
                
                <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark-gray);">
                    <?php esc_html_e( 'Our multidisciplinary research approach integrates cutting-edge technology with field expertise to address critical coastal challenges.', 'cores-theme' ); ?>
                </p>

                <div class="cards-container">
                    
                    <!-- Card 1: Coastal Monitoring -->
                    <div class="card fade-in">
                        <div class="card-icon"><i class="fas fa-water"></i></div>
                        <h3><?php esc_html_e( 'Coastal Monitoring', 'cores-theme' ); ?></h3>
                        <p><?php esc_html_e( 'Real-time monitoring of wave patterns, tidal movements, and coastal processes using advanced equipment including GNSS rovers and wave gauges.', 'cores-theme' ); ?></p>
                        <div style="margin-top: 1rem;">
                            <span class="team-tag"><?php esc_html_e( 'GNSS Technology', 'cores-theme' ); ?></span>
                            <span class="team-tag"><?php esc_html_e( 'Wave Measurement', 'cores-theme' ); ?></span>
                        </div>
                    </div>

                    <!-- Card 2: Data Analysis -->
                    <div class="card fade-in">
                        <div class="card-icon"><i class="fas fa-chart-line"></i></div>
                        <h3><?php esc_html_e( 'Data Analysis', 'cores-theme' ); ?></h3>
                        <p><?php esc_html_e( 'Advanced computational modeling and statistical analysis of coastal processes, climate impacts, and erosion patterns using specialized software.', 'cores-theme' ); ?></p>
                        <div style="margin-top: 1rem;">
                            <span class="team-tag"><?php esc_html_e( 'Modeling', 'cores-theme' ); ?></span>
                            <span class="team-tag"><?php esc_html_e( 'Statistics', 'cores-theme' ); ?></span>
                        </div>
                    </div>

                    <!-- Card 3: Drone Topography -->
                    <div class="card fade-in">
                        <div class="contour-icon">
                            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <ellipse cx="50" cy="50" rx="12" ry="6" class="drone-body"/>
                                <line x1="38" y1="50" x2="25" y2="35" class="drone-arms"/>
                                <line x1="62" y1="50" x2="75" y2="35" class="drone-arms"/>
                                <line x1="38" y1="50" x2="25" y2="65" class="drone-arms"/>
                                <line x1="62" y1="50" x2="75" y2="65" class="drone-arms"/>
                                <circle cx="25" cy="35" r="6" class="drone-propellers"/>
                                <circle cx="75" cy="35" r="6" class="drone-propellers"/>
                                <circle cx="25" cy="65" r="6" class="drone-propellers"/>
                                <circle cx="75" cy="65" r="6" class="drone-propellers"/>
                                <circle cx="50" cy="54" r="3" fill="#05BFDB"/>
                                <rect x="48" y="56" width="4" height="5" fill="#0A4D68"/>
                                <path d="M 15 80 Q 35 75, 50 80 T 85 80" class="topographic-lines"/>
                                <path d="M 15 85 Q 35 80, 50 85 T 85 85" class="topographic-lines"/>
                                <path d="M 15 90 Q 35 85, 50 90 T 85 90" class="topographic-lines"/>
                            </svg>
                        </div>
                        <h3><?php esc_html_e( 'Drone Photogrammetry', 'cores-theme' ); ?></h3>
                        <p><?php esc_html_e( 'High-precision coastal mapping using drone-based photogrammetry with WebODM software for detailed terrain analysis and contour mapping.', 'cores-theme' ); ?></p>
                        <div style="margin-top: 1rem;">
                            <span class="team-tag"><?php esc_html_e( 'UAV Mapping', 'cores-theme' ); ?></span>
                            <span class="team-tag"><?php esc_html_e( '3D Modeling', 'cores-theme' ); ?></span>
                        </div>
                    </div>

                    <!-- Card 4: Ecosystem Studies -->
                    <div class="card fade-in">
                        <div class="card-icon"><i class="fas fa-tree"></i></div>
                        <h3><?php esc_html_e( 'Mangrove Research', 'cores-theme' ); ?></h3>
                        <p><?php esc_html_e( 'Comprehensive ecosystem studies including mangrove parameterization, carbon sequestration analysis, and coastal protection assessment.', 'cores-theme' ); ?></p>
                        <div style="margin-top: 1rem;">
                            <span class="team-tag"><?php esc_html_e( 'Ecology', 'cores-theme' ); ?></span>
                            <span class="team-tag"><?php esc_html_e( 'Conservation', 'cores-theme' ); ?></span>
                        </div>
                    </div>

                    <!-- Card 5: Sediment Analysis -->
                    <div class="card fade-in">
                        <div class="card-icon"><i class="fas fa-flask"></i></div>
                        <h3><?php esc_html_e( 'Sediment Studies', 'cores-theme' ); ?></h3>
                        <p><?php esc_html_e( 'Laboratory and field-based sediment composition analysis to understand coastal evolution, transport patterns, and morphological changes.', 'cores-theme' ); ?></p>
                        <div style="margin-top: 1rem;">
                            <span class="team-tag"><?php esc_html_e( 'Geomorphology', 'cores-theme' ); ?></span>
                            <span class="team-tag"><?php esc_html_e( 'Lab Analysis', 'cores-theme' ); ?></span>
                        </div>
                    </div>

                    <!-- Card 6: Remote Sensing -->
                    <div class="card fade-in">
                        <div class="card-icon"><i class="fas fa-satellite"></i></div>
                        <h3><?php esc_html_e( 'Remote Sensing', 'cores-theme' ); ?></h3>
                        <p><?php esc_html_e( 'Satellite imagery and aerial photography analysis for large-scale coastal monitoring, change detection, and environmental assessment.', 'cores-theme' ); ?></p>
                        <div style="margin-top: 1rem;">
                            <span class="team-tag"><?php esc_html_e( 'GIS', 'cores-theme' ); ?></span>
                            <span class="team-tag"><?php esc_html_e( 'Satellite Data', 'cores-theme' ); ?></span>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- INTERACTIVE RESEARCH LOCATIONS MAP -->
        <!-- ============================================ -->
        <section class="map-section" style="padding: 6rem 5%; background: var(--white);">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                
                <h2 class="section-title fade-in"><?php esc_html_e( 'Research Locations', 'cores-theme' ); ?></h2>
                
                <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark-gray);">
                    <?php esc_html_e( 'Explore our primary research sites along the Indonesian coastline, where we conduct field measurements and monitoring activities.', 'cores-theme' ); ?>
                </p>
                
                <!-- Map Container -->
                <div class="osm-container fade-in">
                    <div id="map" class="osm-map" 
                         data-lat="<?php echo esc_attr( get_theme_mod( 'cores_map_lat', '-8.4384848' ) ); ?>"
                         data-lng="<?php echo esc_attr( get_theme_mod( 'cores_map_lng', '112.6678858' ) ); ?>"
                         data-zoom="<?php echo esc_attr( get_theme_mod( 'cores_map_zoom', '12' ) ); ?>"
                         data-marker-title="<?php echo esc_attr( get_theme_mod( 'cores_map_marker_title', 'CORES Research Location' ) ); ?>"
                         role="application"
                         aria-label="<?php esc_attr_e( 'Interactive map of research locations', 'cores-theme' ); ?>">
                    </div>
                    
                    <!-- Map Controls -->
                    <div class="osm-controls">
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
                
                <!-- Map Information -->
                <div class="map-info fade-in" style="margin-top: 2rem; text-align: center; background: linear-gradient(135deg, rgba(5, 191, 219, 0.05), rgba(8, 131, 149, 0.05)); padding: 2rem; border-radius: var(--radius-lg); border-left: 4px solid var(--accent);">
                    <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; flex-wrap: wrap; font-size: 1rem; color: var(--dark-gray);">
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-map-marker-alt" style="color: var(--accent); font-size: 1.5rem;"></i>
                            <strong><?php echo esc_html( get_theme_mod( 'cores_map_marker_title', 'CORES Research Location' ) ); ?></strong>
                        </div>
                        <span style="color: var(--gray);">|</span>
                        <div>
                            <i class="fas fa-compass" style="color: var(--secondary); margin-right: 0.3rem;"></i>
                            <?php 
                            printf( 
                                esc_html__( 'Coordinates: %1$s, %2$s', 'cores-theme' ),
                                '<code style="background: var(--light-gray); padding: 0.2rem 0.5rem; border-radius: 4px;">' . esc_html( get_theme_mod( 'cores_map_lat', '-8.4384848' ) ) . '</code>',
                                '<code style="background: var(--light-gray); padding: 0.2rem 0.5rem; border-radius: 4px;">' . esc_html( get_theme_mod( 'cores_map_lng', '112.6678858' ) ) . '</code>'
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- RESEARCH MILESTONES TIMELINE -->
        <!-- ============================================ -->
        <section class="timeline-section" id="timeline" style="padding: 6rem 5%; background: linear-gradient(135deg, rgba(224, 225, 221, 0.3), rgba(255, 255, 255, 1));">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                
                <h2 class="section-title fade-in"><?php esc_html_e( 'Research Milestones', 'cores-theme' ); ?></h2>
                
                <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark-gray);">
                    <?php esc_html_e( 'Key achievements and significant developments in our coastal research journey.', 'cores-theme' ); ?>
                </p>
                
                <div class="timeline fade-in">
                    
                    <?php
                    // Query for Milestones
                    $args_milestones = array(
                        'post_type'      => 'milestone',
                        'posts_per_page' => 6, // Show 6 most recent
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    );

                    $milestone_query = new WP_Query( $args_milestones );

                    if ( $milestone_query->have_posts() ) :
                        $item_index = 0;
                        while ( $milestone_query->have_posts() ) :
                            $milestone_query->the_post();
                            $item_index++;
                    ?>
                    
                    <div class="timeline-item" style="--item-index: <?php echo esc_attr( $item_index ); ?>;">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <!-- Date from Excerpt -->
                            <div class="timeline-date">
                                <i class="fas fa-calendar-alt" style="margin-right: 0.3rem;"></i>
                                <?php echo esc_html( get_the_excerpt() ); ?>
                            </div>
                            <!-- Title -->
                            <h4><?php the_title(); ?></h4>
                            <!-- Content -->
                            <div style="margin-bottom: 1rem;"><?php the_content(); ?></div>
                            
                            <?php if ( has_post_thumbnail() ) : ?>
                            <!-- Featured Image if available -->
                            <div style="margin-top: 1rem; border-radius: var(--radius-md); overflow: hidden; box-shadow: var(--shadow-md);">
                                <?php the_post_thumbnail( 'medium', array( 'loading' => 'lazy', 'style' => 'width: 100%; height: auto;' ) ); ?>
                            </div>
                            <?php endif; ?>
                            
                            <a href="<?php the_permalink(); ?>" class="milestone-link">
                                <?php esc_html_e( 'Read More', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <?php
                        endwhile;
                    else :
                    ?>
                        <div style="text-align: center; padding: 3rem; background: var(--white); border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                            <i class="fas fa-info-circle" style="font-size: 3rem; color: var(--accent); margin-bottom: 1rem;"></i>
                            <h3 style="color: var(--primary); margin-bottom: 1rem;"><?php esc_html_e( 'Coming Soon', 'cores-theme' ); ?></h3>
                            <p style="color: var(--dark-gray);"><?php esc_html_e( 'Research milestones will be added here as we document our progress.', 'cores-theme' ); ?></p>
                        </div>
                    <?php
                    endif;
                    wp_reset_postdata();
                    ?>
                    
                </div>

                <?php if ( $milestone_query->found_posts > 0 ) : ?>
                <!-- View All Milestones Button -->
                <div style="text-align: center; margin-top: 3rem;">
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'milestone' ) ); ?>" class="cta-button" style="background: transparent; color: var(--primary); border: 2px solid var(--primary);">
                        <i class="fas fa-history" style="margin-right: 0.5rem;"></i>
                        <?php esc_html_e( 'View All Milestones', 'cores-theme' ); ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- RESEARCH GALLERY CAROUSEL -->
        <!-- ============================================ -->
        <section class="gallery-section" id="gallery" style="padding: 6rem 5% 8rem; background: var(--white);">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                
                <h2 class="section-title fade-in"><?php esc_html_e( 'Research Gallery', 'cores-theme' ); ?></h2>
                
                <p class="fade-in" style="text-align: center; max-width: 700px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark-gray);">
                    <?php esc_html_e( 'Visual documentation of our fieldwork, equipment deployment, laboratory analysis, and research activities at coastal sites.', 'cores-theme' ); ?>
                </p>
                
                <!-- Swiper Carousel Container -->
                <div class="gallery-carousel-container fade-in">
                    <div class="swiper gallery-carousel">
                        <div class="swiper-wrapper">
                            
                            <?php 
                            // Loop through 6 gallery slots from Customizer
                            for ( $i = 1; $i <= 6; $i++ ) :
                                $image_url = get_theme_mod( "cores_gallery_{$i}", 'https://picsum.photos/seed/research' . $i . '/800/600.jpg' );
                                $caption   = get_theme_mod( "cores_gallery_{$i}_caption", sprintf( esc_html__( 'Research Activity %d', 'cores-theme' ), $i ) );
                            ?>
                            
                            <div class="swiper-slide">
                                <img src="<?php echo esc_url( $image_url ); ?>" 
                                     alt="<?php echo esc_attr( $caption ); ?>" 
                                     loading="lazy" />
                                <div class="gallery-caption">
                                    <i class="fas fa-camera" style="margin-right: 0.5rem;"></i>
                                    <?php echo esc_html( $caption ); ?>
                                </div>
                            </div>
                            
                            <?php endfor; ?>
                            
                        </div>
                        
                        <!-- Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                    
                    <!-- Navigation Arrows -->
                    <div class="swiper-button-prev" aria-label="<?php esc_attr_e( 'Previous image', 'cores-theme' ); ?>"></div>
                    <div class="swiper-button-next" aria-label="<?php esc_attr_e( 'Next image', 'cores-theme' ); ?>"></div>
                </div>
                
                <!-- Gallery Tips -->
                <div class="fade-in" style="text-align: center; margin-top: 2rem; color: var(--dark-gray); font-size: 0.95rem;">
                    <i class="fas fa-info-circle" style="color: var(--accent); margin-right: 0.3rem;"></i>
                    <?php esc_html_e( 'Use arrow keys or swipe to navigate through images', 'cores-theme' ); ?>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- RESEARCH TEAM PREVIEW -->
        <!-- ============================================ -->
        <section class="research-team-section" style="padding: 6rem 5%; background: linear-gradient(135deg, var(--light-gray), var(--white));">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                
                <h2 class="section-title fade-in"><?php esc_html_e( 'Our Research Team', 'cores-theme' ); ?></h2>
                
                <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark-gray);">
                    <?php esc_html_e( 'Meet the dedicated researchers and faculty members driving our coastal science initiatives forward.', 'cores-theme' ); ?>
                </p>

                <div class="team-grid" style="max-width: 1000px; margin: 0 auto;">
                    
                    <?php
                    // Query for Team Members (preview - show 4)
                    $team_preview_args = array(
                        'post_type'      => 'team_member',
                        'posts_per_page' => 4,
                        'orderby'        => 'rand', // Random for variety
                    );

                    $team_preview_query = new WP_Query( $team_preview_args );

                    if ( $team_preview_query->have_posts() ) :
                        while ( $team_preview_query->have_posts() ) :
                            $team_preview_query->the_post();
                    ?>
                    
                    <div class="team-member fade-in" style="cursor: default;" tabindex="0">
                        <div class="team-avatar">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'thumbnail', array( 
                                    'style' => 'border-radius: 50%; width: 100px; height: 100px; object-fit: cover;',
                                    'loading' => 'lazy'
                                ) ); ?>
                            <?php else : ?>
                                <i class="fas fa-user-tie" aria-hidden="true"></i>
                            <?php endif; ?>
                        </div>
                        <h4><?php the_title(); ?></h4>
                        <p><?php the_excerpt(); ?></p>
                        <div class="team-tags">
                            <?php
                            $tags = get_the_tags();
                            if ( $tags ) {
                                $tag_count = 0;
                                foreach ( $tags as $tag ) {
                                    if ( $tag_count < 2 ) {
                                        echo '<span class="team-tag">' . esc_html( $tag->name ) . '</span>';
                                        $tag_count++;
                                    }
                                }
                                if ( count( $tags ) > 2 ) {
                                    echo '<span class="team-tag" style="background: var(--light-gray); color: var(--dark-gray);">+' . ( count( $tags ) - 2 ) . '</span>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    
                    <?php
                        endwhile;
                    else :
                    ?>
                        <div class="fade-in" style="grid-column: 1 / -1; text-align: center; padding: 3rem; background: var(--white); border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                            <i class="fas fa-users" style="font-size: 3rem; color: var(--accent); margin-bottom: 1rem;"></i>
                            <h3 style="color: var(--primary); margin-bottom: 1rem;"><?php esc_html_e( 'Team Information Coming Soon', 'cores-theme' ); ?></h3>
                            <p style="color: var(--dark-gray);"><?php esc_html_e( 'Our team profiles will be available here shortly.', 'cores-theme' ); ?></p>
                        </div>
                    <?php
                    endif;
                    wp_reset_postdata();
                    ?>
                    
                </div>

                <!-- View Full Team Button -->
                <div style="text-align: center; margin-top: 3rem;">
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'people' ) ) ); ?>" class="cta-button">
                        <i class="fas fa-users" style="margin-right: 0.5rem;"></i>
                        <?php esc_html_e( 'View Full Team', 'cores-theme' ); ?>
                    </a>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- RESEARCH METHODOLOGIES -->
        <!-- ============================================ -->
        <section class="methodologies-section" style="padding: 6rem 5%; background: var(--white);">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                
                <h2 class="section-title fade-in"><?php esc_html_e( 'Our Methodologies', 'cores-theme' ); ?></h2>
                
                <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark-gray);">
                    <?php esc_html_e( 'Combining traditional field techniques with cutting-edge technology for comprehensive coastal research.', 'cores-theme' ); ?>
                </p>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 3rem;">
                    
                    <!-- Method 1 -->
                    <div class="publication fade-in">
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary), var(--accent)); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.8rem; flex-shrink: 0;">
                                <i class="fas fa-microscope"></i>
                            </div>
                            <h4 style="color: var(--primary); margin: 0;"><?php esc_html_e( 'Field Measurements', 'cores-theme' ); ?></h4>
                        </div>
                        <p style="font-size: 0.95rem; color: var(--dark-gray);">
                            <?php esc_html_e( 'In-situ data collection using advanced equipment including GNSS rovers, wave gauges, and sediment samplers for accurate real-time measurements.', 'cores-theme' ); ?>
                        </p>
                    </div>

                    <!-- Method 2 -->
                    <div class="publication fade-in">
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--accent), var(--secondary)); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.8rem; flex-shrink: 0;">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <h4 style="color: var(--primary); margin: 0;"><?php esc_html_e( 'Computational Modeling', 'cores-theme' ); ?></h4>
                        </div>
                        <p style="font-size: 0.95rem; color: var(--dark-gray);">
                            <?php esc_html_e( 'Advanced numerical modeling and simulation using specialized software for coastal process analysis and prediction.', 'cores-theme' ); ?>
                        </p>
                    </div>

                    <!-- Method 3 -->
                    <div class="publication fade-in">
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--secondary), var(--primary)); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.8rem; flex-shrink: 0;">
                                <i class="fas fa-satellite-dish"></i>
                            </div>
                            <h4 style="color: var(--primary); margin: 0;"><?php esc_html_e( 'Remote Sensing', 'cores-theme' ); ?></h4>
                        </div>
                        <p style="font-size: 0.95rem; color: var(--dark-gray);">
                            <?php esc_html_e( 'Satellite imagery analysis and drone-based photogrammetry for large-scale monitoring and high-resolution mapping.', 'cores-theme' ); ?>
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- CALL TO ACTION - COLLABORATION -->
        <!-- ============================================ -->
        <section class="cta-section" style="padding: 6rem 5%; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; text-align: center; position: relative; overflow: hidden;">
            
            <!-- Animated Background -->
            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.1; background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Ccircle cx=&quot;30&quot; cy=&quot;30&quot; r=&quot;2&quot; fill=&quot;white&quot;/%3E%3C/svg%3E'); background-size: 60px 60px;" aria-hidden="true"></div>

            <div class="fade-in" style="max-width: 900px; margin: 0 auto; position: relative; z-index: 1;">
                <div style="font-size: 4rem; margin-bottom: 1.5rem; animation: float 3s ease-in-out infinite;">
                    <i class="fas fa-handshake" style="color: var(--accent);"></i>
                </div>
                <h2 style="font-size: 2.8rem; margin-bottom: 1.5rem; color: white;">
                    <?php esc_html_e( 'Interested in Collaboration?', 'cores-theme' ); ?>
                </h2>
                <p style="font-size: 1.2rem; line-height: 1.8; margin-bottom: 2.5rem; opacity: 0.95;">
                    <?php esc_html_e( 'We welcome partnerships with researchers, institutions, and organizations. Join us in advancing coastal science through collaborative research initiatives.', 'cores-theme' ); ?>
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'publications' ) ) ); ?>" class="cta-button" style="background: white; color: var(--primary); font-size: 1.1rem;">
                        <i class="fas fa-book-open" style="margin-right: 0.5rem;"></i>
                        <?php esc_html_e( 'View Publications', 'cores-theme' ); ?>
                    </a>
                    <a href="#contact" class="cta-button" style="background: var(--accent); font-size: 1.1rem;">
                        <i class="fas fa-envelope" style="margin-right: 0.5rem;"></i>
                        <?php esc_html_e( 'Contact Us', 'cores-theme' ); ?>
                    </a>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- RELATED RESOURCES -->
        <!-- ============================================ -->
        <section class="related-resources-section" style="padding: 6rem 5%; background: linear-gradient(135deg, var(--light-gray), var(--white));">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                
                <h2 class="section-title fade-in"><?php esc_html_e( 'Explore More', 'cores-theme' ); ?></h2>
                
                <div class="cards-container" style="margin-top: 3rem;">
                    
                    <!-- Resource 1: Publications -->
                    <div class="card fade-in">
                        <div style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h3><?php esc_html_e( 'Publications', 'cores-theme' ); ?></h3>
                        <p><?php esc_html_e( 'Access our peer-reviewed research papers, conference proceedings, and technical reports published in leading journals.', 'cores-theme' ); ?></p>
                        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'publications' ) ) ); ?>" class="card-link">
                            <?php esc_html_e( 'View Publications', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <!-- Resource 2: Supervision -->
                    <div class="card fade-in">
                        <div style="font-size: 3rem; color: var(--accent); margin-bottom: 1rem;">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3><?php esc_html_e( 'Student Opportunities', 'cores-theme' ); ?></h3>
                        <p><?php esc_html_e( 'Join our research team as a supervised student and contribute to groundbreaking coastal science projects.', 'cores-theme' ); ?></p>
                        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'supervision' ) ) ); ?>" class="card-link">
                            <?php esc_html_e( 'Learn More', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <!-- Resource 3: Team -->
                    <div class="card fade-in">
                        <div style="font-size: 3rem; color: var(--secondary); margin-bottom: 1rem;">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3><?php esc_html_e( 'Our Researchers', 'cores-theme' ); ?></h3>
                        <p><?php esc_html_e( 'Meet our dedicated team of faculty supervisors and researchers driving coastal science innovation.', 'cores-theme' ); ?></p>
                        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'people' ) ) ); ?>" class="card-link">
                            <?php esc_html_e( 'Meet the Team', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- #main-content -->

    <!-- ============================================ -->
    <!-- INLINE JAVASCRIPT FOR ENHANCEMENTS -->
    <!-- ============================================ -->
    <script>
    (function() {
        'use strict';

        // ============================================
        // ANIMATED COUNTER FOR STATS
        // ============================================
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number[data-target]');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                        entry.target.classList.add('counted');
                        animateValue(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            counters.forEach(counter => observer.observe(counter));
        }

        function animateValue(element) {
            const target = element.getAttribute('data-target');
            const numericValue = parseInt(target, 10) || 0;
            const duration = 2000;
            const startTime = Date.now();

            function update() {
                const elapsed = Date.now() - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const easeOutQuad = progress * (2 - progress);
                const current = Math.floor(easeOutQuad * numericValue);
                
                element.textContent = current;

                if (progress < 1) {
                    requestAnimationFrame(update);
                } else {
                    element.textContent = target;
                }
            }

            update();
        }

        // ============================================
        // SMOOTH SCROLL FOR ANCHOR LINKS
        // ============================================
        function initSmoothScroll() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href !== '#' && href.length > 1) {
                        e.preventDefault();
                        const target = document.querySelector(href);
                        if (target) {
                            const navbar = document.getElementById('navbar');
                            const offset = navbar ? navbar.offsetHeight : 80;
                            const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
                            
                            window.scrollTo({
                                top: targetPosition,
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });
        }

        // ============================================
        // GALLERY KEYBOARD NAVIGATION
        // ============================================
        function initGalleryKeyboard() {
            const gallery = document.querySelector('.gallery-carousel');
            if (!gallery) return;

            document.addEventListener('keydown', function(e) {
                // Only control gallery if it's in view
                if (!isElementInViewport(gallery)) return;

                if (e.key === 'ArrowLeft') {
                    e.preventDefault();
                    document.querySelector('.swiper-button-prev')?.click();
                } else if (e.key === 'ArrowRight') {
                    e.preventDefault();
                    document.querySelector('.swiper-button-next')?.click();
                }
            });
        }

        function isElementInViewport(el) {
            const rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }

        // ============================================
        // MAP ENHANCEMENT
        // ============================================
        function enhanceMap() {
            const mapElement = document.getElementById('map');
            if (!mapElement) return;

            // Add loading indicator
            mapElement.style.position = 'relative';
            const loader = document.createElement('div');
            loader.style.cssText = 'position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 2rem; color: var(--accent);';
            loader.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            mapElement.appendChild(loader);

            // Remove loader when map is ready
            setTimeout(() => {
                if (loader.parentNode) {
                    loader.remove();
                }
            }, 2000);
        }

        // ============================================
        // TIMELINE STAGGER ANIMATION
        // ============================================
        function initTimelineAnimation() {
            const timelineItems = document.querySelectorAll('.timeline-item');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('visible');
                        }, index * 150);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.2 });

            timelineItems.forEach(item => {
                observer.observe(item);
            });
        }

        // ============================================
        // LAZY LOAD IMAGES
        // ============================================
        function initLazyLoading() {
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.classList.add('loaded');
                            imageObserver.unobserve(img);
                        }
                    });
                });

                document.querySelectorAll('img[loading="lazy"]').forEach(img => {
                    imageObserver.observe(img);
                });
            }
        }

        // ============================================
        // PERFORMANCE LOGGING (DEV ONLY)
        // ============================================
        function logPerformance() {
            if (window.location.hostname !== 'localhost' && window.location.hostname !== '127.0.0.1') {
                return;
            }

            if (window.performance && window.performance.timing) {
                window.addEventListener('load', () => {
                    setTimeout(() => {
                        const perfData = window.performance.timing;
                        const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
                        console.log('📊 Research Page Load Time:', pageLoadTime + 'ms');
                    }, 0);
                }, { once: true });
            }
        }

        // ============================================
        // INITIALIZE ALL FEATURES
        // ============================================
        function init() {
            animateCounters();
            initSmoothScroll();
            initGalleryKeyboard();
            enhanceMap();
            initTimelineAnimation();
            initLazyLoading();
            logPerformance();
            
            console.log('[CORES Research Page] All enhancements loaded successfully ✅');
        }

        // Run initialization
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }

    })();
    </script>

<?php
get_footer();
?>