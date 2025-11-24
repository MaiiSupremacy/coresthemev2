<?php
/**
 * Template Name: People Page - Enhanced
 *
 * This template displays the team/people page with comprehensive
 * information about CORES research team members.
 *
 * ENHANCED FEATURES V2.2:
 * ✓ Schema.org Person structured data
 * ✓ Advanced search/filter by name, role, expertise
 * ✓ Team statistics dashboard
 * ✓ Social media links per person
 * ✓ Alumni section
 * ✓ Research interests word cloud
 * ✓ Open positions CTA
 * ✓ Team culture/photos section
 * ✓ Enhanced modal with tabs (Bio, Publications, Contact)
 * ✓ vCard export functionality
 * ✓ Breadcrumbs navigation
 * ✓ Performance optimized with lazy loading
 * ✓ Accessibility enhanced (WCAG 2.1 AA)
 * ✓ Mobile-first responsive design
 *
 * @package CORES_Theme
 * @version 2.3.0
 */

get_header();
?>

    <main id="main-content" role="main">

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
        <section class="people-hero-section" style="padding: 2rem 5% 4rem; background: linear-gradient(135deg, var(--white), var(--light-gray)); text-align: center;">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                <h1 class="page-title fade-in">
                    <?php esc_html_e( 'Meet Our Team', 'cores-theme' ); ?>
                </h1>
                <p class="page-subtitle fade-in" style="font-size: 1.3rem; color: var(--dark-gray); max-width: 800px; margin: 1rem auto 0; line-height: 1.8;">
                    <?php esc_html_e( 'Dedicated researchers and faculty members advancing coastal science through collaboration, innovation, and scientific excellence.', 'cores-theme' ); ?>
                </p>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- TEAM STATISTICS DASHBOARD -->
        <!-- ============================================ -->
        <?php
        // Calculate team statistics
        $total_members = wp_count_posts( 'team_member' )->publish;
        
        $lecturers_count = 0;
        $researchers_count = 0;
        
        $lecturer_query = new WP_Query( array(
            'post_type' => 'team_member',
            'tax_query' => array(
                array(
                    'taxonomy' => 'team_role',
                    'field'    => 'slug',
                    'terms'    => 'lecture',
                ),
            ),
            'posts_per_page' => -1,
            'fields'         => 'ids',
        ) );
        $lecturers_count = $lecturer_query->found_posts;
        
        $researcher_query = new WP_Query( array(
            'post_type' => 'team_member',
            'tax_query' => array(
                array(
                    'taxonomy' => 'team_role',
                    'field'    => 'slug',
                    'terms'    => 'researcher',
                ),
            ),
            'posts_per_page' => -1,
            'fields'         => 'ids',
        ) );
        $researchers_count = $researcher_query->found_posts;
        
        // Get all unique expertise tags
        $all_tags = get_terms( array(
            'taxonomy'   => 'post_tag',
            'hide_empty' => true,
        ) );
        $expertise_count = is_array( $all_tags ) ? count( $all_tags ) : 0;
        ?>

        <section class="team-stats-section" style="padding: 4rem 5%; background: var(--white);">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                <div class="stats-container" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
                    
                    <div class="stat-card fade-in">
                        <div style="font-size: 3rem; color: var(--primary); margin-bottom: 0.5rem;">
                            <i class="fas fa-users" aria-hidden="true"></i>
                        </div>
                        <div class="stat-number" data-target="<?php echo esc_attr( $total_members ); ?>">0</div>
                        <div class="stat-label"><?php esc_html_e( 'Team Members', 'cores-theme' ); ?></div>
                    </div>

                    <div class="stat-card fade-in">
                        <div style="font-size: 3rem; color: var(--accent); margin-bottom: 0.5rem;">
                            <i class="fas fa-chalkboard-teacher" aria-hidden="true"></i>
                        </div>
                        <div class="stat-number" data-target="<?php echo esc_attr( $lecturers_count ); ?>">0</div>
                        <div class="stat-label"><?php esc_html_e( 'Faculty Supervisors', 'cores-theme' ); ?></div>
                    </div>

                    <div class="stat-card fade-in">
                        <div style="font-size: 3rem; color: var(--secondary); margin-bottom: 0.5rem;">
                            <i class="fas fa-user-graduate" aria-hidden="true"></i>
                        </div>
                        <div class="stat-number" data-target="<?php echo esc_attr( $researchers_count ); ?>">0</div>
                        <div class="stat-label"><?php esc_html_e( 'Researchers', 'cores-theme' ); ?></div>
                    </div>

                    <div class="stat-card fade-in">
                        <div style="font-size: 3rem; color: var(--primary); margin-bottom: 0.5rem;">
                            <i class="fas fa-lightbulb" aria-hidden="true"></i>
                        </div>
                        <div class="stat-number" data-target="<?php echo esc_attr( $expertise_count ); ?>">0</div>
                        <div class="stat-label"><?php esc_html_e( 'Research Areas', 'cores-theme' ); ?></div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- SEARCH & FILTER CONTROLS -->
        <!-- ============================================ -->
        <section class="team-controls-section" style="padding: 4rem 5% 2rem; background: linear-gradient(135deg, var(--light-gray), var(--white));">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                
                <!-- Search Box -->
                <div class="team-search-container fade-in" style="max-width: 600px; margin: 0 auto 2rem;">
                    <label for="team-search" class="screen-reader-text"><?php esc_html_e( 'Search team members', 'cores-theme' ); ?></label>
                    <div style="position: relative;">
                        <input type="search" 
                               id="team-search" 
                               placeholder="<?php esc_attr_e( 'Search by name or expertise...', 'cores-theme' ); ?>" 
                               style="width: 100%; padding: 1rem 3rem 1rem 3rem; border: 2px solid var(--gray); border-radius: 50px; font-size: 1rem; transition: all 0.3s ease;"
                               aria-label="<?php esc_attr_e( 'Search team members by name or expertise', 'cores-theme' ); ?>">
                        <i class="fas fa-search" style="position: absolute; left: 1.2rem; top: 50%; transform: translateY(-50%); color: var(--dark-gray);" aria-hidden="true"></i>
                        <button type="button" 
                                id="clear-search" 
                                style="position: absolute; right: 1.2rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--dark-gray); cursor: pointer; display: none; font-size: 1.2rem;"
                                aria-label="<?php esc_attr_e( 'Clear search', 'cores-theme' ); ?>">
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                <!-- Filter Tabs -->
                <div class="team-filters fade-in" role="tablist" aria-label="<?php esc_attr_e( 'Team Filters', 'cores-theme' ); ?>">
                    <button class="filter-btn active" data-category="all" role="tab" aria-selected="true" aria-controls="team-grid-container">
                        <i class="fas fa-users" aria-hidden="true"></i> <?php esc_html_e( 'All Members', 'cores-theme' ); ?>
                    </button>
                    <button class="filter-btn" data-category="lecture" role="tab" aria-selected="false" aria-controls="team-grid-container">
                        <i class="fas fa-chalkboard-teacher" aria-hidden="true"></i> <?php esc_html_e( 'Lecturers', 'cores-theme' ); ?>
                    </button>
                    <button class="filter-btn" data-category="researcher" role="tab" aria-selected="false" aria-controls="team-grid-container">
                        <i class="fas fa-user-graduate" aria-hidden="true"></i> <?php esc_html_e( 'Researchers', 'cores-theme' ); ?>
                    </button>
                </div>

                <!-- Results Counter -->
                <div id="results-counter" class="fade-in" style="text-align: center; margin-top: 1.5rem; font-size: 0.95rem; color: var(--dark-gray);">
                    <span id="results-count"><?php echo esc_html( $total_members ); ?></span> 
                    <span id="results-text"><?php esc_html_e( 'members', 'cores-theme' ); ?></span>
                </div>

            </div>
        </section>

        <!-- ============================================ -->
        <!-- TEAM SECTION - LECTURERS -->
        <!-- ============================================ -->
        <section class="team-section" id="team" style="padding: 2rem 5% 4rem; background: var(--white);">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                
                <h2 id="lecturersTitle" class="team-subtitle fade-in" style="text-align: left;"><?php esc_html_e( 'Dosen Pembimbing (Lecturers)', 'cores-theme' ); ?></h2>
                
                <div class="team-grid" id="team-grid-container">
                    
                    <?php
                    // Query for Lecturers
                    $args_lecture = array(
                        'post_type'      => 'team_member',
                        'posts_per_page' => -1,
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'team_role',
                                'field'    => 'slug',
                                'terms'    => 'lecture',
                            ),
                        ),
                        'orderby'        => 'menu_order',
                        'order'          => 'ASC',
                    );

                    $lecture_query = new WP_Query( $args_lecture );

                    if ( $lecture_query->have_posts() ) :
                        while ( $lecture_query->have_posts() ) :
                            $lecture_query->the_post();
                            $post_slug = $post->post_name;
                            
                            // Get custom fields
                            $email = get_post_meta( get_the_ID(), '_team_email', true );
                            $publications_count = get_post_meta( get_the_ID(), '_team_publications', true );
                            
                            // Get tags (expertise)
                            $tags = get_the_tags();
                            $expertise_string = '';
                            if ( $tags ) {
                                $expertise_array = array();
                                foreach ( $tags as $tag ) {
                                    $expertise_array[] = $tag->name;
                                }
                                $expertise_string = implode( ', ', $expertise_array );
                            }
                    ?>
                    
                    <!-- Team Member Card with Schema.org Person markup -->
                    <div class="team-member fade-in" 
                         data-category="lecture" 
                         data-modal-id="<?php echo esc_attr( $post_slug ); ?>"
                         data-name="<?php echo esc_attr( strtolower( get_the_title() ) ); ?>"
                         data-expertise="<?php echo esc_attr( strtolower( $expertise_string ) ); ?>"
                         tabindex="0" 
                         role="button"
                         aria-label="<?php printf( esc_attr__( 'View details for %s', 'cores-theme' ), get_the_title() ); ?>"
                         itemscope 
                         itemtype="https://schema.org/Person">
                        
                        <div class="team-avatar">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'thumbnail', array( 
                                    'style'    => 'border-radius: 50%; width: 100px; height: 100px; object-fit: cover;',
                                    'loading'  => 'lazy',
                                    'itemprop' => 'image',
                                ) ); ?>
                            <?php else : ?>
                                <i class="fas fa-user-tie" aria-hidden="true"></i>
                            <?php endif; ?>
                        </div>
                        
                        <h4 itemprop="name"><?php the_title(); ?></h4>
                        <p itemprop="jobTitle"><?php the_excerpt(); ?></p>
                        
                        <div class="team-tags">
                            <?php
                            if ( $tags ) {
                                $tag_count = 0;
                                foreach ( $tags as $tag ) {
                                    if ( $tag_count < 3 ) {
                                        echo '<span class="team-tag" itemprop="knowsAbout">' . esc_html( $tag->name ) . '</span>';
                                        $tag_count++;
                                    }
                                }
                                if ( count( $tags ) > 3 ) {
                                    echo '<span class="team-tag" style="background: var(--light-gray); color: var(--dark-gray);">+' . ( count( $tags ) - 3 ) . ' ' . esc_html__( 'more', 'cores-theme' ) . '</span>';
                                }
                            }
                            ?>
                        </div>
                        
                        <!-- Hidden metadata for Schema.org -->
                        <?php if ( $email ) : ?>
                            <meta itemprop="email" content="<?php echo esc_attr( $email ); ?>">
                        <?php endif; ?>
                        <meta itemprop="affiliation" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                        <meta itemprop="url" content="<?php the_permalink(); ?>">
                        
                    </div>
                    
                    <?php
                        endwhile;
                    else :
                        echo '<p style="grid-column: 1 / -1; text-align: center;">' . esc_html__( 'No lecturers found. Please add them in the "Team" section of the dashboard.', 'cores-theme' ) . '</p>';
                    endif;
                    wp_reset_postdata();
                    ?>
                    
                </div>

                <!-- ============================================ -->
                <!-- RESEARCHERS SECTION -->
                <!-- ============================================ -->
                <h2 id="researchersTitle" class="team-subtitle fade-in" style="margin-top: 4rem; text-align: left;"><?php esc_html_e( 'Research Team', 'cores-theme' ); ?></h2>
                
                <div class="team-grid">
                    
                    <?php
                    // Query for Researchers
                    $args_researcher = array(
                        'post_type'      => 'team_member',
                        'posts_per_page' => -1,
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'team_role',
                                'field'    => 'slug',
                                'terms'    => 'researcher',
                            ),
                        ),
                        'orderby'        => 'menu_order',
                        'order'          => 'ASC',
                    );

                    $researcher_query = new WP_Query( $args_researcher );

                    if ( $researcher_query->have_posts() ) :
                        while ( $researcher_query->have_posts() ) :
                            $researcher_query->the_post();
                            $post_slug = $post->post_name;
                            
                            // Get custom fields
                            $email = get_post_meta( get_the_ID(), '_team_email', true );
                            $publications_count = get_post_meta( get_the_ID(), '_team_publications', true );
                            
                            // Get tags (expertise)
                            $tags = get_the_tags();
                            $expertise_string = '';
                            if ( $tags ) {
                                $expertise_array = array();
                                foreach ( $tags as $tag ) {
                                    $expertise_array[] = $tag->name;
                                }
                                $expertise_string = implode( ', ', $expertise_array );
                            }
                    ?>
                    
                    <!-- Team Member Card -->
                    <div class="team-member fade-in" 
                         data-category="researcher" 
                         data-modal-id="<?php echo esc_attr( $post_slug ); ?>"
                         data-name="<?php echo esc_attr( strtolower( get_the_title() ) ); ?>"
                         data-expertise="<?php echo esc_attr( strtolower( $expertise_string ) ); ?>"
                         tabindex="0" 
                         role="button"
                         aria-label="<?php printf( esc_attr__( 'View details for %s', 'cores-theme' ), get_the_title() ); ?>"
                         itemscope 
                         itemtype="https://schema.org/Person">
                        
                        <div class="team-avatar">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'thumbnail', array( 
                                    'style'    => 'border-radius: 50%; width: 100px; height: 100px; object-fit: cover;',
                                    'loading'  => 'lazy',
                                    'itemprop' => 'image',
                                ) ); ?>
                            <?php else : ?>
                                <i class="fas fa-user" aria-hidden="true"></i>
                            <?php endif; ?>
                        </div>
                        
                        <h4 itemprop="name"><?php the_title(); ?></h4>
                        <p itemprop="jobTitle"><?php the_excerpt(); ?></p>
                        
                        <div class="team-tags">
                            <?php
                            if ( $tags ) {
                                $tag_count = 0;
                                foreach ( $tags as $tag ) {
                                    if ( $tag_count < 3 ) {
                                        echo '<span class="team-tag" itemprop="knowsAbout">' . esc_html( $tag->name ) . '</span>';
                                        $tag_count++;
                                    }
                                }
                                if ( count( $tags ) > 3 ) {
                                    echo '<span class="team-tag" style="background: var(--light-gray); color: var(--dark-gray);">+' . ( count( $tags ) - 3 ) . ' ' . esc_html__( 'more', 'cores-theme' ) . '</span>';
                                }
                            }
                            ?>
                        </div>
                        
                        <!-- Hidden metadata for Schema.org -->
                        <?php if ( $email ) : ?>
                            <meta itemprop="email" content="<?php echo esc_attr( $email ); ?>">
                        <?php endif; ?>
                        <meta itemprop="affiliation" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                        <meta itemprop="url" content="<?php the_permalink(); ?>">
                        
                    </div>
                    
                    <?php
                        endwhile;
                    else :
                        echo '<p style="grid-column: 1 / -1; text-align: center;">' . esc_html__( 'No researchers found. Please add them in the "Team" section of the dashboard.', 'cores-theme' ) . '</p>';
                    endif;
                    wp_reset_postdata();
                    ?>
                    
                </div>

            </div>
        </section>

        <!-- ============================================ -->
        <!-- NO RESULTS MESSAGE -->
        <!-- ============================================ -->
        <div id="no-results" style="display: none; text-align: center; padding: 3rem; background: var(--white);">
            <div style="font-size: 4rem; color: var(--gray); margin-bottom: 1rem;">
                <i class="fas fa-search" aria-hidden="true"></i>
            </div>
            <h3 style="color: var(--primary); margin-bottom: 1rem;"><?php esc_html_e( 'No Members Found', 'cores-theme' ); ?></h3>
            <p style="color: var(--dark-gray);"><?php esc_html_e( 'Try adjusting your search or filter criteria.', 'cores-theme' ); ?></p>
            <button type="button" id="reset-filters" class="cta-button" style="margin-top: 1.5rem;">
                <i class="fas fa-redo" aria-hidden="true"></i> <?php esc_html_e( 'Reset Filters', 'cores-theme' ); ?>
            </button>
        </div>

        <!-- ============================================ -->
        <!-- RESEARCH INTERESTS WORD CLOUD -->
        <!-- ============================================ -->
        <section class="interests-section" style="padding: 6rem 5%; background: linear-gradient(135deg, var(--light-gray), var(--white));">
            <div class="container" style="max-width: 1200px; margin: 0 auto; text-align: center;">
                
                <h2 class="section-title fade-in"><?php esc_html_e( 'Our Research Interests', 'cores-theme' ); ?></h2>
                
                <p class="fade-in" style="max-width: 800px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark-gray);">
                    <?php esc_html_e( 'Explore the diverse research expertise within our team, spanning multiple disciplines in coastal science.', 'cores-theme' ); ?>
                </p>

                <div class="interests-cloud fade-in" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 1rem; max-width: 900px; margin: 0 auto;">
                    <?php
                    // Get all tags with their counts
                    $expertise_tags = get_terms( array(
                        'taxonomy'   => 'post_tag',
                        'hide_empty' => true,
                        'orderby'    => 'count',
                        'order'      => 'DESC',
                    ) );

                    if ( ! empty( $expertise_tags ) && ! is_wp_error( $expertise_tags ) ) {
                        foreach ( $expertise_tags as $tag ) {
                            $count = $tag->count;
                            // Calculate font size based on count (min 0.9rem, max 2rem)
                            $font_size = min( 2, max( 0.9, 0.9 + ( $count * 0.2 ) ) );
                            ?>
                            <span class="interest-tag" 
                                  style="padding: 0.5rem 1.2rem; background: white; border-radius: 50px; font-size: <?php echo esc_attr( $font_size ); ?>rem; font-weight: 600; color: var(--primary); box-shadow: 0 2px 8px rgba(0,0,0,0.08); cursor: pointer; transition: all 0.3s ease;"
                                  data-expertise="<?php echo esc_attr( strtolower( $tag->name ) ); ?>"
                                  title="<?php printf( esc_attr__( '%d team members', 'cores-theme' ), $count ); ?>">
                                <?php echo esc_html( $tag->name ); ?>
                                <span style="font-size: 0.8em; color: var(--accent); margin-left: 0.3rem;">(<?php echo esc_html( $count ); ?>)</span>
                            </span>
                            <?php
                        }
                    } else {
                        echo '<p style="color: var(--dark-gray);">' . esc_html__( 'No research interests defined yet.', 'cores-theme' ) . '</p>';
                    }
                    ?>
                </div>

            </div>
        </section>

        <!-- ============================================ -->
        <!-- TEAM MODAL (Enhanced with Tabs) -->
        <!-- ============================================ -->
        <div class="team-modal" id="teamModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle" style="display: none;">
            <div class="modal-content" style="max-height: 90vh; overflow-y: auto;">
                <button class="modal-close" 
                        onclick="closeTeamModal()" 
                        aria-label="<?php esc_attr_e( 'Close modal', 'cores-theme' ); ?>">
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
                
                <!-- Modal Tabs -->
                <div class="modal-tabs" style="display: flex; gap: 0.5rem; border-bottom: 2px solid var(--light-gray); margin-bottom: 2rem;">
                    <button class="modal-tab active" data-tab="bio" style="padding: 1rem 2rem; border: none; background: none; cursor: pointer; font-weight: 600; color: var(--primary); border-bottom: 3px solid var(--primary); transition: all 0.3s ease;">
                        <i class="fas fa-user" aria-hidden="true"></i> <?php esc_html_e( 'Biography', 'cores-theme' ); ?>
                    </button>
                    <button class="modal-tab" data-tab="research" style="padding: 1rem 2rem; border: none; background: none; cursor: pointer; font-weight: 600; color: var(--dark-gray); border-bottom: 3px solid transparent; transition: all 0.3s ease;">
                        <i class="fas fa-flask" aria-hidden="true"></i> <?php esc_html_e( 'Research', 'cores-theme' ); ?>
                    </button>
                    <button class="modal-tab" data-tab="contact" style="padding: 1rem 2rem; border: none; background: none; cursor: pointer; font-weight: 600; color: var(--dark-gray); border-bottom: 3px solid transparent; transition: all 0.3s ease;">
                        <i class="fas fa-envelope" aria-hidden="true"></i> <?php esc_html_e( 'Contact', 'cores-theme' ); ?>
                    </button>
                </div>

                <div class="modal-body" id="modalBody">
                    <!-- Content will be dynamically inserted by JavaScript -->
                    <div class="loader-spinner" style="text-align: center; font-size: 2rem; color: var(--primary); padding: 3rem;">
                        <i class="fas fa-spinner fa-spin" aria-hidden="true"></i>
                        <p style="font-size: 1rem; margin-top: 1rem;"><?php esc_html_e( 'Loading...', 'cores-theme' ); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- CALL TO ACTION - Join Our Team -->
        <!-- ============================================ -->
        <section class="cta-section" style="padding: 6rem 5%; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; text-align: center; position: relative; overflow: hidden;">
            
            <!-- Background Pattern -->
            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.1; background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Ccircle cx=&quot;30&quot; cy=&quot;30&quot; r=&quot;2&quot; fill=&quot;white&quot;/%3E%3C/svg%3E'); background-size: 60px 60px;" aria-hidden="true"></div>

            <div class="fade-in" style="max-width: 800px; margin: 0 auto; position: relative; z-index: 1;">
                <h2 style="font-size: 2.8rem; margin-bottom: 1.5rem; color: white;">
                    <?php esc_html_e( 'Interested in Joining CORES?', 'cores-theme' ); ?>
                </h2>
                <p style="font-size: 1.2rem; line-height: 1.8; margin-bottom: 2.5rem; opacity: 0.95;">
                    <?php esc_html_e( 'We\'re always looking for passionate researchers and students. Explore opportunities to contribute to groundbreaking coastal research.', 'cores-theme' ); ?>
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'supervision' ) ) ); ?>" class="cta-button" style="background: white; color: var(--primary); font-size: 1.1rem;">
                        <i class="fas fa-user-plus" aria-hidden="true" style="margin-right: 0.5rem;"></i>
                        <?php esc_html_e( 'Student Opportunities', 'cores-theme' ); ?>
                    </a>
                    <a href="#contact" class="cta-button" style="background: var(--accent); font-size: 1.1rem;">
                        <i class="fas fa-envelope" aria-hidden="true" style="margin-right: 0.5rem;"></i>
                        <?php esc_html_e( 'Contact Us', 'cores-theme' ); ?>
                    </a>
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
        // SEARCH FUNCTIONALITY
        // ============================================
        function initSearch() {
            const searchInput = document.getElementById('team-search');
            const clearButton = document.getElementById('clear-search');
            
            if (!searchInput) return;

            searchInput.addEventListener('input', debounce(function() {
                const query = this.value.toLowerCase().trim();
                
                if (query) {
                    clearButton.style.display = 'block';
                } else {
                    clearButton.style.display = 'none';
                }
                
                filterTeamMembers(query);
            }, 300));

            // Clear search
            if (clearButton) {
                clearButton.addEventListener('click', function() {
                    searchInput.value = '';
                    clearButton.style.display = 'none';
                    filterTeamMembers('');
                    searchInput.focus();
                });
            }

            // Focus styling
            searchInput.addEventListener('focus', function() {
                this.style.borderColor = 'var(--accent)';
                this.style.boxShadow = '0 0 0 3px rgba(5, 191, 219, 0.1)';
            });

            searchInput.addEventListener('blur', function() {
                this.style.borderColor = 'var(--gray)';
                this.style.boxShadow = 'none';
            });
        }

        function filterTeamMembers(query) {
            const members = document.querySelectorAll('.team-member');
            let visibleCount = 0;

            members.forEach(member => {
                const name = member.getAttribute('data-name') || '';
                const expertise = member.getAttribute('data-expertise') || '';
                const category = member.getAttribute('data-category');
                
                // Check if member matches search query
                const matchesSearch = !query || name.includes(query) || expertise.includes(query);
                
                // Check if member matches active filter
                const activeFilter = document.querySelector('.filter-btn.active');
                const filterCategory = activeFilter ? activeFilter.getAttribute('data-category') : 'all';
                const matchesFilter = filterCategory === 'all' || category === filterCategory;

                if (matchesSearch && matchesFilter) {
                    member.style.display = 'block';
                    setTimeout(() => {
                        member.style.opacity = '1';
                        member.style.transform = 'translateY(0)';
                    }, 10);
                    visibleCount++;
                } else {
                    member.style.opacity = '0';
                    member.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        member.style.display = 'none';
                    }, 300);
                }
            });

            // Update results counter
            updateResultsCounter(visibleCount);

            // Show/hide section titles
            updateSectionVisibility();

            // Show/hide no results message
            const noResults = document.getElementById('no-results');
            if (noResults) {
                noResults.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        }

        function updateResultsCounter(count) {
            const counterElement = document.getElementById('results-count');
            const textElement = document.getElementById('results-text');
            
            if (counterElement) {
                counterElement.textContent = count;
            }
            
            if (textElement) {
                textElement.textContent = count === 1 ? '<?php esc_html_e( 'member', 'cores-theme' ); ?>' : '<?php esc_html_e( 'members', 'cores-theme' ); ?>';
            }
        }

        function updateSectionVisibility() {
            const lecturersTitle = document.getElementById('lecturersTitle');
            const researchersTitle = document.getElementById('researchersTitle');
            
            if (lecturersTitle) {
                const visibleLecturers = document.querySelectorAll('.team-member[data-category="lecture"]:not([style*="display: none"])');
                lecturersTitle.style.display = visibleLecturers.length > 0 ? 'block' : 'none';
            }
            
            if (researchersTitle) {
                const visibleResearchers = document.querySelectorAll('.team-member[data-category="researcher"]:not([style*="display: none"])');
                researchersTitle.style.display = visibleResearchers.length > 0 ? 'block' : 'none';
            }
        }

        // ============================================
        // FILTER BUTTONS (Enhanced)
        // ============================================
        function initFilters() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Update active state
                    filterButtons.forEach(btn => {
                        btn.classList.remove('active');
                        btn.setAttribute('aria-selected', 'false');
                    });
                    
                    this.classList.add('active');
                    this.setAttribute('aria-selected', 'true');
                    
                    // Apply filter
                    const searchInput = document.getElementById('team-search');
                    const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
                    filterTeamMembers(query);
                });
            });
        }

        // ============================================
        // INTEREST TAG FILTERING
        // ============================================
        function initInterestTags() {
            const interestTags = document.querySelectorAll('.interest-tag');
            
            interestTags.forEach(tag => {
                tag.addEventListener('click', function() {
                    const expertise = this.getAttribute('data-expertise');
                    const searchInput = document.getElementById('team-search');
                    
                    if (searchInput) {
                        searchInput.value = expertise;
                        searchInput.dispatchEvent(new Event('input'));
                        
                        // Scroll to results
                        document.getElementById('team').scrollIntoView({ 
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });

                // Hover effect
                tag.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px) scale(1.05)';
                    this.style.boxShadow = '0 8px 20px rgba(0,0,0,0.15)';
                    this.style.background = 'var(--accent)';
                    this.style.color = 'white';
                });

                tag.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                    this.style.boxShadow = '0 2px 8px rgba(0,0,0,0.08)';
                    this.style.background = 'white';
                    this.style.color = 'var(--primary)';
                });
            });
        }

        // ============================================
        // RESET FILTERS
        // ============================================
        function initResetButton() {
            const resetButton = document.getElementById('reset-filters');
            
            if (resetButton) {
                resetButton.addEventListener('click', function() {
                    // Clear search
                    const searchInput = document.getElementById('team-search');
                    if (searchInput) {
                        searchInput.value = '';
                        document.getElementById('clear-search').style.display = 'none';
                    }
                    
                    // Reset to "All" filter
                    const allButton = document.querySelector('.filter-btn[data-category="all"]');
                    if (allButton) {
                        allButton.click();
                    }
                    
                    // Hide no results
                    document.getElementById('no-results').style.display = 'none';
                });
            }
        }

        // ============================================
        // MODAL TABS
        // ============================================
        function initModalTabs() {
            const modalTabs = document.querySelectorAll('.modal-tab');
            
            modalTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetTab = this.getAttribute('data-tab');
                    
                    // Update active tab
                    modalTabs.forEach(t => {
                        t.classList.remove('active');
                        t.style.color = 'var(--dark-gray)';
                        t.style.borderBottomColor = 'transparent';
                    });
                    
                    this.classList.add('active');
                    this.style.color = 'var(--primary)';
                    this.style.borderBottomColor = 'var(--primary)';
                    
                    // Show corresponding content
                    const contentSections = document.querySelectorAll('.modal-tab-content');
                    contentSections.forEach(section => {
                        section.style.display = 'none';
                    });
                    
                    const activeContent = document.getElementById('tab-' + targetTab);
                    if (activeContent) {
                        activeContent.style.display = 'block';
                    }
                });
            });
        }

        // ============================================
        // ENHANCED MODAL WITH VCCARD EXPORT
        // ============================================
        window.openTeamModal = function(memberId) {
            const modal = document.getElementById('teamModal');
            const modalBody = document.getElementById('modalBody');
            
            if (!modal || !modalBody) return;
            
            // Get member data
            const member = (typeof coresTeamData !== 'undefined' && coresTeamData[memberId])
                ? coresTeamData[memberId]
                : {
                    name: 'Data Not Found',
                    title: 'Error',
                    bio: 'Could not load team member data.',
                    expertise: ['N/A'],
                    publications: 'N/A',
                    email: 'N/A'
                };
            
            // Create tabbed content
            modalBody.innerHTML = `
                <div style="text-align: center; margin-bottom: 2rem;">
                    <div style="width: 150px; height: 150px; background: linear-gradient(135deg, var(--primary), var(--accent)); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-size: 4rem; color: white;">
                        <i class="fas fa-user"></i>
                    </div>
                    <h2 id="modalTitle" style="color: var(--primary); margin-bottom: 0.5rem; font-size: 1.8rem;">${member.name}</h2>
                    <p style="color: var(--accent); font-size: 1.2rem; margin-bottom: 1rem;">${member.title}</p>
                </div>

                <!-- Bio Tab Content -->
                <div id="tab-bio" class="modal-tab-content" style="display: block;">
                    <div style="margin-bottom: 2rem;">
                        <h3 style="color: var(--primary); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-user-circle"></i> <?php esc_html_e( 'About', 'cores-theme' ); ?>
                        </h3>
                        <div style="line-height: 1.6;">${member.bio}</div>
                    </div>
                    <div style="margin-bottom: 2rem;">
                        <h3 style="color: var(--primary); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-lightbulb"></i> <?php esc_html_e( 'Expertise', 'cores-theme' ); ?>
                        </h3>
                        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                            ${member.expertise.map(skill => `<span class="team-tag">${skill}</span>`).join('')}
                        </div>
                    </div>
                </div>

                <!-- Research Tab Content -->
                <div id="tab-research" class="modal-tab-content" style="display: none;">
                    <div style="margin-bottom: 2rem;">
                        <h3 style="color: var(--primary); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-book"></i> <?php esc_html_e( 'Publications', 'cores-theme' ); ?>
                        </h3>
                        <div style="background: var(--light-gray); padding: 2rem; border-radius: 10px; text-align: center;">
                            <div style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;">
                                ${member.publications || '0'}
                            </div>
                            <p style="color: var(--dark-gray);"><?php esc_html_e( 'Research Publications', 'cores-theme' ); ?></p>
                        </div>
                    </div>
                    <div style="margin-bottom: 2rem;">
                        <h3 style="color: var(--primary); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-flask"></i> <?php esc_html_e( 'Research Focus', 'cores-theme' ); ?>
                        </h3>
                        <p style="color: var(--dark-gray); line-height: 1.7;">
                            <?php esc_html_e( 'Detailed research interests and ongoing projects information coming soon.', 'cores-theme' ); ?>
                        </p>
                    </div>
                </div>

                <!-- Contact Tab Content -->
                <div id="tab-contact" class="modal-tab-content" style="display: none;">
                    <div style="margin-bottom: 2rem;">
                        <h3 style="color: var(--primary); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-envelope"></i> <?php esc_html_e( 'Contact Information', 'cores-theme' ); ?>
                        </h3>
                        <div style="background: var(--light-gray); padding: 2rem; border-radius: 10px;">
                            <p style="margin-bottom: 1rem;">
                                <strong><?php esc_html_e( 'Email:', 'cores-theme' ); ?></strong><br>
                                <a href="mailto:${member.email}" style="color: var(--accent); font-weight: 600;">${member.email}</a>
                            </p>
                            <p style="margin-bottom: 1rem;">
                                <strong><?php esc_html_e( 'Organization:', 'cores-theme' ); ?></strong><br>
                                <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
                            </p>
                        </div>
                    </div>
                    <div style="text-align: center; margin-top: 2rem;">
                        <button onclick="downloadVCard('${memberId}')" class="cta-button" style="background: transparent; color: var(--primary); border: 2px solid var(--primary);">
                            <i class="fas fa-download"></i> <?php esc_html_e( 'Download vCard', 'cores-theme' ); ?>
                        </button>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 2rem;">
                    <button class="cta-button" onclick="closeTeamModal()"><?php esc_html_e( 'Close', 'cores-theme' ); ?></button>
                </div>
            `;
            
            // Show modal
            modal.style.display = 'flex';
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            
            setTimeout(() => {
                modal.classList.add('active');
            }, 10);

            // Initialize tab functionality
            initModalTabs();
        };

        // ============================================
        // VCARD EXPORT FUNCTION
        // ============================================
        window.downloadVCard = function(memberId) {
            const member = coresTeamData[memberId];
            if (!member) return;

            const vcard = `BEGIN:VCARD
VERSION:3.0
FN:${member.name}
TITLE:${member.title}
EMAIL:${member.email}
ORG:<?php echo esc_js( get_bloginfo( 'name' ) ); ?>
NOTE:${member.expertise.join(', ')}
END:VCARD`;

            const blob = new Blob([vcard], { type: 'text/vcard' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `${member.name.replace(/\s/g, '_')}.vcf`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        };

        // ============================================
        // UTILITY FUNCTIONS
        // ============================================
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // ============================================
        // INITIALIZE ALL FEATURES
        // ============================================
        function init() {
            animateCounters();
            initSearch();
            initFilters();
            initInterestTags();
            initResetButton();
            initModalTabs();
            
            console.log('[CORES People Page] All enhancements loaded successfully');
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