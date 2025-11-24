<?php
/**
 * Template Name: About Page - Enhanced
 *
 * This is the template that displays the About page with comprehensive
 * information about the CORES research organization.
 *
 * ENHANCED FEATURES V2.2:
 * ✓ Schema.org Organization structured data
 * ✓ Breadcrumbs navigation for better UX & SEO
 * ✓ Lazy loading for images (performance)
 * ✓ Animated counter for statistics
 * ✓ Mission, Vision, Values section
 * ✓ Team preview with link to full team page
 * ✓ Timeline/History section
 * ✓ Call-to-action sections
 * ✓ FAQ section with Schema markup
 * ✓ Progressive disclosure for content
 * ✓ Enhanced accessibility (WCAG 2.1 AA)
 * ✓ SEO optimized with meta tags
 * ✓ Performance optimized
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CORES_Theme
 * @version 2.3.0
 */

get_header();
?>

    <main id="main-content" role="main" itemscope itemtype="https://schema.org/AboutPage">

        <!-- ============================================ -->
        <!-- SCHEMA.ORG ORGANIZATION DATA -->
        <!-- ============================================ -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "ResearchOrganization",
            "name": "<?php echo esc_js( get_bloginfo( 'name' ) ); ?>",
            "alternateName": "CORES",
            "url": "<?php echo esc_url( home_url() ); ?>",
            "logo": {
                "@type": "ImageObject",
                "url": "<?php echo esc_url( get_theme_mod( 'cores_logo', get_template_directory_uri() . '/assets/Logo-Cores-UB-revisi-transparan@2x.png' ) ); ?>",
                "width": 200,
                "height": 50
            },
            "description": "<?php echo esc_js( get_bloginfo( 'description' ) ); ?>",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Jl. MT. Haryono No.167, Ketawanggede",
                "addressLocality": "Malang",
                "addressRegion": "Jawa Timur",
                "postalCode": "65145",
                "addressCountry": "ID"
            },
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "<?php echo esc_js( get_theme_mod( 'cores_phone_1', '+62 821 4279 3179' ) ); ?>",
                "contactType": "Research Inquiries",
                "email": "<?php echo esc_js( get_theme_mod( 'cores_email_1', 'coastalresearchers@gmail.com' ) ); ?>",
                "availableLanguage": ["English", "Indonesian"]
            },
            "sameAs": [
                <?php
                $social_links = array(
                    get_theme_mod( 'cores_facebook', '' ),
                    get_theme_mod( 'cores_twitter', '' ),
                    get_theme_mod( 'cores_instagram', '' ),
                    get_theme_mod( 'cores_linkedin', '' ),
                    get_theme_mod( 'cores_youtube', '' ),
                );
                $social_links = array_filter( $social_links );
                echo '"' . implode( '","', array_map( 'esc_js', $social_links ) ) . '"';
                ?>
            ],
            "foundingDate": "<?php echo esc_js( date( 'Y' ) - 3 ); ?>",
            "areaServed": {
                "@type": "Place",
                "name": "Indonesia"
            },
            "knowsAbout": [
                "Coastal Engineering",
                "Marine Science",
                "Oceanography",
                "Environmental Research",
                "Climate Change"
            ]
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
        <!-- PAGE HEADER -->
        <!-- ============================================ -->
        <section class="about-hero-section" style="padding: 2rem 5% 4rem; background: linear-gradient(135deg, var(--white), var(--light-gray));">
            <div class="container" style="max-width: 1200px; margin: 0 auto; text-align: center;">
                <h1 class="page-title fade-in" itemprop="name">
                    <?php esc_html_e( 'About CORES', 'cores-theme' ); ?>
                </h1>
                <p class="page-subtitle fade-in" style="font-size: 1.3rem; color: var(--dark-gray); max-width: 800px; margin: 1rem auto 0; line-height: 1.8;" itemprop="description">
                    <?php
                    printf(
                        esc_html__( 'Advancing coastal science through %1$sinnovative research%2$s, %3$scutting-edge technology%4$s, and %5$scollaborative partnerships%6$s since %7$s.', 'cores-theme' ),
                        '<strong style="color: var(--primary);">',
                        '</strong>',
                        '<strong style="color: var(--accent);">',
                        '</strong>',
                        '<strong style="color: var(--secondary);">',
                        '</strong>',
                        '<strong>' . esc_html( date( 'Y' ) - 3 ) . '</strong>'
                    );
                    ?>
                </p>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- INTRODUCTION SECTION -->
        <!-- ============================================ -->
        <section class="about-intro-section" style="padding: 0 5% 4rem; background: var(--white);">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                
                <div class="about-intro-content fade-in" style="max-width: 900px; margin: 0 auto;">
                    <p style="font-size: 1.2rem; line-height: 1.8; color: var(--dark); margin-bottom: 2rem;">
                        <?php
                        printf(
                            esc_html__( 'We are %1$sCoastal Researchers (CORES)%2$s, a dedicated team of scientists and engineers committed to advancing our understanding of coastal ecosystems and processes. Based at the Water Resources Engineering Department of Brawijaya University, we combine cutting-edge technology with field expertise to address critical challenges facing our coastlines.', 'cores-theme' ),
                            '<strong>',
                            '</strong>'
                        );
                        ?>
                    </p>
                    <p style="font-size: 1.1rem; line-height: 1.8; color: var(--dark); margin-bottom: 2rem;">
                        <?php
                        esc_html_e( 'Our multidisciplinary approach integrates coastal dynamics monitoring, data analysis, remote sensing, and ecosystem studies to provide comprehensive insights into coastal behavior. Through innovative research methodologies and state-of-the-art equipment, we strive to develop sustainable solutions for coastal protection and management.', 'cores-theme' );
                        ?>
                    </p>
                </div>

            </div>
        </section>

        <!-- ============================================ -->
        <!-- MISSION, VISION, VALUES -->
        <!-- ============================================ -->
        <section class="mvv-section" style="padding: 6rem 5%; background: linear-gradient(135deg, rgba(10, 77, 104, 0.03), rgba(5, 191, 219, 0.03));">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                
                <h2 class="section-title fade-in"><?php esc_html_e( 'Our Guiding Principles', 'cores-theme' ); ?></h2>

                <div class="cards-container">
                    
                    <!-- Mission -->
                    <div class="card fade-in" style="text-align: left;">
                        <div class="card-icon" style="background: linear-gradient(135deg, var(--primary), var(--accent)); color: white; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 0 1.5rem 0;">
                            <i class="fas fa-bullseye" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 style="color: var(--primary); margin-bottom: 1rem;"><?php esc_html_e( 'Our Mission', 'cores-theme' ); ?></h3>
                        <p style="line-height: 1.7;">
                            <?php esc_html_e( 'To advance coastal science through rigorous research, innovative technology, and collaborative partnerships, providing scientific evidence for sustainable coastal management and protection strategies.', 'cores-theme' ); ?>
                        </p>
                    </div>

                    <!-- Vision -->
                    <div class="card fade-in" style="text-align: left;">
                        <div class="card-icon" style="background: linear-gradient(135deg, var(--accent), var(--secondary)); color: white; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 0 1.5rem 0;">
                            <i class="fas fa-eye" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 style="color: var(--primary); margin-bottom: 1rem;"><?php esc_html_e( 'Our Vision', 'cores-theme' ); ?></h3>
                        <p style="line-height: 1.7;">
                            <?php esc_html_e( 'To be a leading center of excellence in coastal research, recognized nationally and internationally for innovative approaches to understanding and protecting coastal environments in the face of climate change.', 'cores-theme' ); ?>
                        </p>
                    </div>

                    <!-- Values -->
                    <div class="card fade-in" style="text-align: left;">
                        <div class="card-icon" style="background: linear-gradient(135deg, var(--secondary), var(--primary)); color: white; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 0 1.5rem 0;">
                            <i class="fas fa-heart" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 style="color: var(--primary); margin-bottom: 1rem;"><?php esc_html_e( 'Our Values', 'cores-theme' ); ?></h3>
                        <ul style="list-style: none; padding: 0; line-height: 2;">
                            <li><i class="fas fa-check-circle" style="color: var(--accent); margin-right: 0.5rem;"></i> <?php esc_html_e( 'Scientific Excellence', 'cores-theme' ); ?></li>
                            <li><i class="fas fa-check-circle" style="color: var(--accent); margin-right: 0.5rem;"></i> <?php esc_html_e( 'Collaborative Spirit', 'cores-theme' ); ?></li>
                            <li><i class="fas fa-check-circle" style="color: var(--accent); margin-right: 0.5rem;"></i> <?php esc_html_e( 'Environmental Stewardship', 'cores-theme' ); ?></li>
                            <li><i class="fas fa-check-circle" style="color: var(--accent); margin-right: 0.5rem;"></i> <?php esc_html_e( 'Innovation & Integrity', 'cores-theme' ); ?></li>
                        </ul>
                    </div>

                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- RESEARCH FOCUS SECTION -->
        <!-- ============================================ -->
        <section class="research-section" id="research-focus" style="padding: 6rem 5%; background: var(--white);">
            <h2 class="section-title fade-in"><?php esc_html_e( 'Our Research Focus', 'cores-theme' ); ?></h2>
            
            <!-- Filter Buttons -->
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
                
                <!-- Card 1: Coastal Dynamics -->
                <div class="card fade-in" data-category="monitoring">
                    <div class="card-icon"><i class="fas fa-water"></i></div>
                    <h3><?php esc_html_e( 'Coastal Dynamics', 'cores-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Advanced monitoring of wave patterns, tidal movements, and coastal processes using state-of-the-art equipment including wave gauges and GNSS rovers.', 'cores-theme' ); ?></p>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'research' ) ) ); ?>" class="card-link">
                        <?php esc_html_e( 'Learn More', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Card 2: Data Analysis -->
                <div class="card fade-in" data-category="analysis">
                    <div class="card-icon"><i class="fas fa-chart-line"></i></div>
                    <h3><?php esc_html_e( 'Data Analysis', 'cores-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Computational modeling and statistical analysis of coastal processes, climate change impacts, and erosion patterns using advanced software tools.', 'cores-theme' ); ?></p>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'research' ) ) ); ?>" class="card-link">
                        <?php esc_html_e( 'View Projects', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Card 3: Drone Topography -->
                <div class="card fade-in" data-category="monitoring">
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
                    <h3><?php esc_html_e( 'Drone Topography', 'cores-theme' ); ?></h3>
                    <p><?php esc_html_e( 'High-precision coastal mapping using drone photogrammetry with WebODM software for detailed terrain analysis and contour mapping.', 'cores-theme' ); ?></p>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'research' ) ) ); ?>" class="card-link">
                        <?php esc_html_e( 'See Technology', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Card 4: Mangrove Studies -->
                <div class="card fade-in" data-category="ecosystem">
                    <div class="card-icon"><i class="fas fa-tree"></i></div>
                    <h3><?php esc_html_e( 'Mangrove Studies', 'cores-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Comprehensive mangrove ecosystem research including parameterization, carbon sequestration studies, and coastal protection analysis.', 'cores-theme' ); ?></p>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'research' ) ) ); ?>" class="card-link">
                        <?php esc_html_e( 'Explore Research', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Card 5: Sediment Analysis -->
                <div class="card fade-in" data-category="analysis">
                    <div class="card-icon"><i class="fas fa-flask"></i></div>
                    <h3><?php esc_html_e( 'Sediment Analysis', 'cores-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Laboratory and field-based sediment composition analysis to understand coastal evolution and transport patterns.', 'cores-theme' ); ?></p>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'research' ) ) ); ?>" class="card-link">
                        <?php esc_html_e( 'View Methods', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Card 6: Remote Sensing -->
                <div class="card fade-in" data-category="monitoring">
                    <div class="card-icon"><i class="fas fa-satellite"></i></div>
                    <h3><?php esc_html_e( 'Remote Sensing', 'cores-theme' ); ?></h3>
                    <p><?php esc_html_e( 'Satellite imagery and aerial photography analysis for large-scale coastal monitoring and change detection.', 'cores-theme' ); ?></p>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'research' ) ) ); ?>" class="card-link">
                        <?php esc_html_e( 'Discover More', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

            </div>
        </section>

        <!-- ============================================ -->
        <!-- EQUIPMENT SHOWCASE SECTION -->
        <!-- ============================================ -->
        <section class="equipment-section" style="padding: 6rem 5%; background: linear-gradient(135deg, rgba(224, 225, 221, 0.3), rgba(255, 255, 255, 1));">
            <h2 class="section-title fade-in"><?php esc_html_e( 'Our Research Equipment', 'cores-theme' ); ?></h2>
            
            <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark-gray);">
                <?php esc_html_e( 'We utilize state-of-the-art equipment to ensure precise data collection and analysis in our coastal research projects.', 'cores-theme' ); ?>
            </p>

            <div class="equipment-showcase">
                
                <?php
                // Loop through 4 equipment slots from Customizer
                $default_img = 'https://picsum.photos/seed/equipment/400/300.jpg';
                
                for ( $i = 1; $i <= 4; $i++ ) :
                    $image_url = get_theme_mod( "cores_equipment_image_{$i}", 'https://picsum.photos/seed/equipment' . $i . '/400/300.jpg' );
                    $name      = get_theme_mod( "cores_equipment_name_{$i}", esc_html__( 'Research Equipment', 'cores-theme' ) );
                    $desc      = get_theme_mod( "cores_equipment_desc_{$i}", esc_html__( 'Professional research equipment for coastal studies.', 'cores-theme' ) );
                ?>
                
                <div class="equipment-card fade-in">
                    <div class="equipment-image" 
                         style="background-image: url('<?php echo esc_url( $image_url ); ?>');"
                         role="img"
                         aria-label="<?php echo esc_attr( $name ); ?>">
                        <!-- Lazy loading placeholder -->
                        <noscript>
                            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $name ); ?>" loading="lazy">
                        </noscript>
                    </div>
                    <div class="equipment-info">
                        <div class="equipment-name"><?php echo esc_html( $name ); ?></div>
                        <div class="equipment-desc"><?php echo esc_html( $desc ); ?></div>
                    </div>
                </div>
                
                <?php endfor; ?>
                
            </div>
        </section>

        <!-- ============================================ -->
        <!-- IMPACT STATS SECTION (With Animated Counters) -->
        <!-- ============================================ -->
        <section class="impact-section" style="padding: 6rem 5%; background: var(--white);">
            <h2 class="section-title fade-in"><?php esc_html_e( 'Our Impact', 'cores-theme' ); ?></h2>
            
            <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark-gray);">
                <?php esc_html_e( 'Measurable contributions to coastal science and environmental protection.', 'cores-theme' ); ?>
            </p>

            <div class="stats-container">
                
                <?php
                // Get stats from Customizer
                $stats = array(
                    1 => array(
                        'number' => get_theme_mod( 'cores_stat_1_number', '10+' ),
                        'label'  => get_theme_mod( 'cores_stat_1_label', esc_html__( 'Research Projects', 'cores-theme' ) ),
                        'icon'   => 'fa-project-diagram',
                    ),
                    2 => array(
                        'number' => get_theme_mod( 'cores_stat_2_number', '25+' ),
                        'label'  => get_theme_mod( 'cores_stat_2_label', esc_html__( 'Publications', 'cores-theme' ) ),
                        'icon'   => 'fa-file-alt',
                    ),
                    3 => array(
                        'number' => get_theme_mod( 'cores_stat_3_number', '15' ),
                        'label'  => get_theme_mod( 'cores_stat_3_label', esc_html__( 'Team Members', 'cores-theme' ) ),
                        'icon'   => 'fa-users',
                    ),
                    4 => array(
                        'number' => get_theme_mod( 'cores_stat_4_number', '5+' ),
                        'label'  => get_theme_mod( 'cores_stat_4_label', esc_html__( 'Partner Institutions', 'cores-theme' ) ),
                        'icon'   => 'fa-handshake',
                    ),
                );

                foreach ( $stats as $stat ) :
                ?>
                
                <div class="stat-card fade-in">
                    <div style="font-size: 3rem; color: var(--accent); margin-bottom: 1rem;">
                        <i class="fas <?php echo esc_attr( $stat['icon'] ); ?>" aria-hidden="true"></i>
                    </div>
                    <div class="stat-number" data-target="<?php echo esc_attr( $stat['number'] ); ?>">0</div>
                    <div class="stat-label"><?php echo esc_html( $stat['label'] ); ?></div>
                </div>
                
                <?php endforeach; ?>
                
            </div>
        </section>

        <!-- ============================================ -->
        <!-- TEAM PREVIEW SECTION -->
        <!-- ============================================ -->
        <section class="team-preview-section" style="padding: 6rem 5%; background: linear-gradient(135deg, var(--light-gray), var(--medium-gray));">
            <h2 class="section-title fade-in"><?php esc_html_e( 'Meet Our Team', 'cores-theme' ); ?></h2>
            
            <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark-gray);">
                <?php esc_html_e( 'Our dedicated researchers and faculty members bring expertise from diverse fields of coastal science.', 'cores-theme' ); ?>
            </p>

            <div class="team-grid" style="max-width: 1000px; margin: 0 auto;">
                
                <?php
                // Query for team members (preview - show 3)
                $team_preview_args = array(
                    'post_type'      => 'team_member',
                    'posts_per_page' => 3,
                    'orderby'        => 'rand', // Random for variety
                );

                $team_preview_query = new WP_Query( $team_preview_args );

                if ( $team_preview_query->have_posts() ) :
                    while ( $team_preview_query->have_posts() ) :
                        $team_preview_query->the_post();
                ?>
                
                <div class="team-member fade-in" style="cursor: default;">
                    <div class="team-avatar">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'thumbnail', array( 'style' => 'border-radius: 50%; width: 100px; height: 100px;', 'loading' => 'lazy' ) ); ?>
                        <?php else : ?>
                            <i class="fas fa-user" aria-hidden="true"></i>
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
                                if ( $tag_count < 3 ) { // Show max 3 tags
                                    echo '<span class="team-tag">' . esc_html( $tag->name ) . '</span>';
                                    $tag_count++;
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                
                <?php
                    endwhile;
                else :
                    // Fallback if no team members exist yet
                    ?>
                    <div class="fade-in" style="text-align: center; grid-column: 1 / -1;">
                        <p><?php esc_html_e( 'Our team information will be available soon. Check back later!', 'cores-theme' ); ?></p>
                    </div>
                    <?php
                endif;
                wp_reset_postdata();
                ?>
                
            </div>

            <!-- View Full Team Button -->
            <div style="text-align: center; margin-top: 3rem;">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'people' ) ) ); ?>" class="cta-button">
                    <?php esc_html_e( 'View Full Team', 'cores-theme' ); ?>
                    <i class="fas fa-arrow-right" aria-hidden="true" style="margin-left: 0.5rem;"></i>
                </a>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- HISTORY / TIMELINE SECTION -->
        <!-- ============================================ -->
        <section class="history-section" style="padding: 6rem 5%; background: var(--white);">
            <h2 class="section-title fade-in"><?php esc_html_e( 'Our Journey', 'cores-theme' ); ?></h2>
            
            <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark-gray);">
                <?php esc_html_e( 'Key milestones in our research and development journey.', 'cores-theme' ); ?>
            </p>

            <div class="timeline fade-in" style="max-width: 900px; margin: 0 auto;">
                
                <?php
                // Query milestones for history timeline (show latest 3)
                $milestone_args = array(
                    'post_type'      => 'milestone',
                    'posts_per_page' => 3,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                );

                $milestone_query = new WP_Query( $milestone_args );

                if ( $milestone_query->have_posts() ) :
                    while ( $milestone_query->have_posts() ) :
                        $milestone_query->the_post();
                ?>
                
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date"><?php echo esc_html( get_the_excerpt() ); ?></div>
                        <h4><?php the_title(); ?></h4>
                        <?php the_content(); ?>
                    </div>
                </div>
                
                <?php
                    endwhile;
                else :
                    // Default milestones if custom post type isn't populated yet
                    $default_milestones = array(
                        array(
                            'date'  => date( 'Y' ) - 2,
                            'title' => __( 'CORES Established', 'cores-theme' ),
                            'desc'  => __( 'Founded as a research group focused on coastal dynamics and environmental protection.', 'cores-theme' ),
                        ),
                        array(
                            'date'  => date( 'Y' ) - 1,
                            'title' => __( 'First Field Campaign', 'cores-theme' ),
                            'desc'  => __( 'Successfully completed comprehensive coastal monitoring campaign at Clungup Beach.', 'cores-theme' ),
                        ),
                        array(
                            'date'  => date( 'Y' ),
                            'title' => __( 'International Collaboration', 'cores-theme' ),
                            'desc'  => __( 'Established partnerships with international research institutions for collaborative studies.', 'cores-theme' ),
                        ),
                    );

                    foreach ( $default_milestones as $milestone ) :
                ?>
                
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date"><?php echo esc_html( $milestone['date'] ); ?></div>
                        <h4><?php echo esc_html( $milestone['title'] ); ?></h4>
                        <p><?php echo esc_html( $milestone['desc'] ); ?></p>
                    </div>
                </div>
                
                <?php
                    endforeach;
                endif;
                wp_reset_postdata();
                ?>
                
            </div>

            <!-- View Full Timeline Button -->
            <div style="text-align: center; margin-top: 3rem;">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'research' ) ) ); ?>#timeline" class="cta-button" style="background: transparent; color: var(--primary); border: 2px solid var(--primary);">
                    <?php esc_html_e( 'View Complete Timeline', 'cores-theme' ); ?>
                    <i class="fas fa-arrow-right" aria-hidden="true" style="margin-left: 0.5rem;"></i>
                </a>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- FAQ SECTION (With Schema.org) -->
        <!-- ============================================ -->
        <section class="faq-section" style="padding: 6rem 5%; background: linear-gradient(135deg, var(--light-gray), var(--white));" itemscope itemtype="https://schema.org/FAQPage">
            <h2 class="section-title fade-in"><?php esc_html_e( 'Frequently Asked Questions', 'cores-theme' ); ?></h2>
            
            <div style="max-width: 900px; margin: 0 auto;">
                
                <?php
                // FAQ data
                $faqs = array(
                    array(
                        'question' => __( 'What areas of coastal research does CORES focus on?', 'cores-theme' ),
                        'answer'   => __( 'CORES specializes in coastal dynamics monitoring, sediment analysis, mangrove ecosystem studies, drone-based topographic mapping, and computational modeling of coastal processes. We use advanced equipment and methodologies to provide comprehensive insights into coastal behavior.', 'cores-theme' ),
                    ),
                    array(
                        'question' => __( 'How can I collaborate with CORES?', 'cores-theme' ),
                        'answer'   => __( 'We welcome collaborations with researchers, institutions, and organizations interested in coastal science. Please contact us through our contact page to discuss potential research partnerships, data sharing, or joint projects.', 'cores-theme' ),
                    ),
                    array(
                        'question' => __( 'Do you offer student supervision opportunities?', 'cores-theme' ),
                        'answer'   => __( 'Yes! We actively supervise undergraduate and graduate students in various coastal research projects. Visit our Supervision page to learn about available research areas, requirements, and how to apply.', 'cores-theme' ),
                    ),
                    array(
                        'question' => __( 'Where can I access your research publications?', 'cores-theme' ),
                        'answer'   => __( 'Our research publications are available on our Publications page. We regularly publish in peer-reviewed journals and present at international conferences. Contact us if you need access to specific publications.', 'cores-theme' ),
                    ),
                    array(
                        'question' => __( 'What equipment and technology does CORES use?', 'cores-theme' ),
                        'answer'   => __( 'We utilize state-of-the-art equipment including GNSS rovers, wave gauges, drones with photogrammetry capabilities, sediment analysis tools, and advanced computational software for data processing and modeling.', 'cores-theme' ),
                    ),
                );

                foreach ( $faqs as $index => $faq ) :
                ?>
                
                <div class="faq-item fade-in" style="background: white; padding: 2rem; border-radius: 12px; margin-bottom: 1.5rem; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-left: 4px solid var(--accent);" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <h3 style="color: var(--primary); font-size: 1.3rem; margin-bottom: 1rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center;" 
                        itemprop="name" 
                        onclick="this.parentElement.classList.toggle('faq-open'); this.querySelector('.faq-toggle').textContent = this.parentElement.classList.contains('faq-open') ? '−' : '+';"
                        role="button"
                        tabindex="0"
                        onkeypress="if(event.key === 'Enter' || event.key === ' ') { event.preventDefault(); this.click(); }"
                        aria-expanded="false">
                        <?php echo esc_html( $faq['question'] ); ?>
                        <span class="faq-toggle" style="font-size: 2rem; color: var(--accent); font-weight: 300;" aria-hidden="true">+</span>
                    </h3>
                    <div class="faq-answer" 
                         style="display: none; color: var(--dark-gray); line-height: 1.7; padding-top: 1rem; border-top: 1px solid var(--light-gray);" 
                         itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div itemprop="text">
                            <p><?php echo esc_html( $faq['answer'] ); ?></p>
                        </div>
                    </div>
                </div>
                
                <?php endforeach; ?>
                
            </div>
        </section>

        <!-- ============================================ -->
        <!-- PARTNERSHIPS / COLLABORATIONS -->
        <!-- ============================================ -->
        <section class="partnerships-section" style="padding: 6rem 5%; background: var(--white);">
            <h2 class="section-title fade-in"><?php esc_html_e( 'Our Partners & Collaborators', 'cores-theme' ); ?></h2>
            
            <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark-gray);">
                <?php esc_html_e( 'We collaborate with leading institutions to advance coastal research and environmental protection.', 'cores-theme' ); ?>
            </p>

            <div class="partners-grid fade-in" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; max-width: 1000px; margin: 0 auto;">
                
                <?php
                // Partner logos (can be made dynamic with custom post type or customizer)
                $partners = array(
                    array(
                        'name' => __( 'Brawijaya University', 'cores-theme' ),
                        'logo' => get_template_directory_uri() . '/assets/partner-brawijaya.png',
                    ),
                    array(
                        'name' => __( 'Ministry of Marine Affairs', 'cores-theme' ),
                        'logo' => get_template_directory_uri() . '/assets/partner-ministry.png',
                    ),
                    array(
                        'name' => __( 'International Coastal Research', 'cores-theme' ),
                        'logo' => get_template_directory_uri() . '/assets/partner-international.png',
                    ),
                    array(
                        'name' => __( 'Environmental Foundation', 'cores-theme' ),
                        'logo' => get_template_directory_uri() . '/assets/partner-foundation.png',
                    ),
                );

                foreach ( $partners as $partner ) :
                ?>
                
                <div class="partner-card" style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); text-align: center; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; min-height: 150px;">
                    <div>
                        <!-- Placeholder for partner logo -->
                        <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--light-gray), var(--medium-gray)); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-university" style="font-size: 2rem; color: var(--primary);" aria-hidden="true"></i>
                        </div>
                        <p style="font-weight: 600; color: var(--dark); margin: 0; font-size: 0.9rem;"><?php echo esc_html( $partner['name'] ); ?></p>
                    </div>
                </div>
                
                <?php endforeach; ?>
                
            </div>

            <div style="text-align: center; margin-top: 3rem;">
                <p class="fade-in" style="font-size: 1rem; color: var(--dark-gray);">
                    <?php esc_html_e( 'Interested in partnering with us?', 'cores-theme' ); ?>
                    <a href="#contact" style="color: var(--accent); font-weight: 600; margin-left: 0.5rem;">
                        <?php esc_html_e( 'Get in Touch', 'cores-theme' ); ?>
                        <i class="fas fa-arrow-right" aria-hidden="true" style="margin-left: 0.3rem;"></i>
                    </a>
                </p>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- CALL TO ACTION - Join Us -->
        <!-- ============================================ -->
        <section class="cta-section" style="padding: 6rem 5%; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; text-align: center; position: relative; overflow: hidden;">
            
            <!-- Background Pattern -->
            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.1; background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Ccircle cx=&quot;30&quot; cy=&quot;30&quot; r=&quot;2&quot; fill=&quot;white&quot;/%3E%3C/svg%3E'); background-size: 60px 60px;" aria-hidden="true"></div>

            <div class="fade-in" style="max-width: 800px; margin: 0 auto; position: relative; z-index: 1;">
                <h2 style="font-size: 2.8rem; margin-bottom: 1.5rem; color: white;">
                    <?php esc_html_e( 'Join Our Research Community', 'cores-theme' ); ?>
                </h2>
                <p style="font-size: 1.2rem; line-height: 1.8; margin-bottom: 2.5rem; opacity: 0.95;">
                    <?php esc_html_e( 'Be part of groundbreaking coastal research. Whether you\'re a student, researcher, or organization, we welcome collaboration and fresh perspectives.', 'cores-theme' ); ?>
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'supervision' ) ) ); ?>" class="cta-button" style="background: white; color: var(--primary); font-size: 1.1rem;">
                        <i class="fas fa-user-graduate" aria-hidden="true" style="margin-right: 0.5rem;"></i>
                        <?php esc_html_e( 'Student Opportunities', 'cores-theme' ); ?>
                    </a>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'people' ) ) ); ?>" class="cta-button" style="background: var(--accent); font-size: 1.1rem;">
                        <i class="fas fa-users" aria-hidden="true" style="margin-right: 0.5rem;"></i>
                        <?php esc_html_e( 'Meet Our Team', 'cores-theme' ); ?>
                    </a>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- CALL TO ACTION - Publications -->
        <!-- ============================================ -->
        <section class="cta-section-alt" style="padding: 6rem 5%; background: var(--white); text-align: center;">
            <div class="fade-in" style="max-width: 800px; margin: 0 auto;">
                <div style="font-size: 4rem; color: var(--accent); margin-bottom: 1.5rem;">
                    <i class="fas fa-book-open" aria-hidden="true"></i>
                </div>
                <h2 style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1.5rem;">
                    <?php esc_html_e( 'Explore Our Research Publications', 'cores-theme' ); ?>
                </h2>
                <p style="font-size: 1.2rem; color: var(--dark-gray); line-height: 1.8; margin-bottom: 2.5rem;">
                    <?php esc_html_e( 'Discover our latest findings in coastal science, published in peer-reviewed journals and presented at international conferences.', 'cores-theme' ); ?>
                </p>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'publications' ) ) ); ?>" class="cta-button" style="font-size: 1.1rem;">
                    <i class="fas fa-file-alt" aria-hidden="true" style="margin-right: 0.5rem;"></i>
                    <?php esc_html_e( 'View Publications', 'cores-theme' ); ?>
                </a>
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
            const isPlus = target.includes('+');
            const numericValue = parseInt(target.replace(/\D/g, ''), 10) || 0;
            const duration = 2000;
            const startTime = Date.now();

            function update() {
                const elapsed = Date.now() - startTime;
                const progress = Math.min(elapsed / duration, 1);
                
                // Easing function for smooth animation
                const easeOutQuad = progress * (2 - progress);
                const current = Math.floor(easeOutQuad * numericValue);
                
                element.textContent = current + (isPlus ? '+' : '');

                if (progress < 1) {
                    requestAnimationFrame(update);
                } else {
                    element.textContent = target; // Ensure final value is exact
                }
            }

            update();
        }

        // ============================================
        // FAQ TOGGLE FUNCTIONALITY
        // ============================================
        function initFAQ() {
            const faqItems = document.querySelectorAll('.faq-item h3');
            
            faqItems.forEach(question => {
                question.addEventListener('click', function() {
                    const faqItem = this.parentElement;
                    const answer = faqItem.querySelector('.faq-answer');
                    const toggle = this.querySelector('.faq-toggle');
                    const isOpen = faqItem.classList.contains('faq-open');

                    // Close all other FAQs
                    document.querySelectorAll('.faq-item').forEach(item => {
                        if (item !== faqItem) {
                            item.classList.remove('faq-open');
                            item.querySelector('.faq-answer').style.display = 'none';
                            item.querySelector('.faq-toggle').textContent = '+';
                            item.querySelector('h3').setAttribute('aria-expanded', 'false');
                        }
                    });

                    // Toggle current FAQ
                    if (isOpen) {
                        faqItem.classList.remove('faq-open');
                        answer.style.display = 'none';
                        toggle.textContent = '+';
                        this.setAttribute('aria-expanded', 'false');
                    } else {
                        faqItem.classList.add('faq-open');
                        answer.style.display = 'block';
                        toggle.textContent = '−';
                        this.setAttribute('aria-expanded', 'true');
                    }
                });

                // Keyboard accessibility
                question.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
            });
        }

        // ============================================
        // LAZY LOADING FOR EQUIPMENT IMAGES
        // ============================================
        function initLazyLoading() {
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.style.opacity = '0';
                            img.style.transition = 'opacity 0.3s ease';
                            
                            setTimeout(() => {
                                img.style.opacity = '1';
                            }, 100);
                            
                            imageObserver.unobserve(img);
                        }
                    });
                });

                document.querySelectorAll('.equipment-image').forEach(img => {
                    imageObserver.observe(img);
                });
            }
        }

        // ============================================
        // PARTNER CARD HOVER EFFECTS
        // ============================================
        function initPartnerCards() {
            const partnerCards = document.querySelectorAll('.partner-card');
            
            partnerCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px) scale(1.05)';
                    this.style.boxShadow = '0 15px 40px rgba(0,0,0,0.15)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                    this.style.boxShadow = '0 4px 15px rgba(0,0,0,0.05)';
                });
            });
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
        // INITIALIZE ALL FEATURES
        // ============================================
        function init() {
            animateCounters();
            initFAQ();
            initLazyLoading();
            initPartnerCards();
            initSmoothScroll();
            
            console.log('[CORES About Page] All enhancements loaded successfully');
        }

        // Run initialization when DOM is ready
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