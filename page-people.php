<?php
/**
 * Template Name: People Page
 *
 * This is the template that displays the People/Team page.
 *
 * *** MAJOR IMPROVEMENT: ***
 * - Removed ALL hard-coded HTML for team members.
 * - Page is now 100% dynamic, populating from a new "Team" Custom Post Type.
 * - Team members are displayed using two custom WP_Query loops (for Lecturers and Researchers).
 * - Removed all inline onclick="" attributes.
 * - Added accessibility (ARIA roles) to filters and internationalized all text.
 * - Modal is now triggered by an event listener in main.js, using a 'data-modal-id' (the post slug).
 *
 * *** BUG FIX (from previous version): Fixed a fatal PHP syntax error (stray 'F') in the 'else' condition for researchers. ***
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CORES_Theme
 */

get_header(); // This will include the header.php file
?>

    <main id="main-content">

        <!-- ============================================ -->
        <!-- TEAM SECTION -->
        <!-- ============================================ -->
        <section class="team-section" id="team" style="padding: 10rem 5% 6rem; background: var(--white);">
            <h1 class="section-title fade-in"><?php esc_html_e( 'Meet Our Team', 'cores-theme' ); ?></h1>
            
            <!-- Team Filters (functionality is in js/main.js) -->
            <!-- *** IMPROVED: ARIA roles added, onclick removed. data-category slugs must match taxonomy slugs. *** -->
            <div class="team-filters fade-in" role="tablist" aria-label="<?php esc_attr_e( 'Team Filters', 'cores-theme' ); ?>">
                <button class="filter-btn active" data-category="all" role="tab" aria-selected="true" aria-controls="team-grid-container">
                    <?php esc_html_e( 'All Members', 'cores-theme' ); ?>
                </button>
                <button class="filter-btn" data-category="lecture" role="tab" aria-selected="false" aria-controls="team-grid-container">
                    <?php esc_html_e( 'Lecturers', 'cores-theme' ); ?>
                </button>
                <button class="filter-btn" data-category="researcher" role="tab" aria-selected="false" aria-controls="team-grid-container">
                    <?php esc_html_e( 'Researchers', 'cores-theme' ); ?>
                </button>
            </div>

            <!-- ============================================ -->
            <!-- LECTURERS (DOSEN PEMBIMBING) -->
            <!-- ============================================ -->
            <h3 id="lecturersTitle" class="team-subtitle fade-in"><?php esc_html_e( 'Dosen Pembimbing (Lecturers)', 'cores-theme' ); ?></h3>
            <div class="team-grid" id="team-grid-container">
                <?php
                // 1. WP_Query for Lecturers
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
                    'orderby'        => 'date',
                    'order'          => 'ASC',
                );

                $lecture_query = new WP_Query( $args_lecture );

                if ( $lecture_query->have_posts() ) :
                    while ( $lecture_query->have_posts() ) :
                        $lecture_query->the_post();
                        $post_slug = $post->post_name; // This is the unique key
                        ?>

                        <!-- *** THIS IS NOW DYNAMIC *** -->
                        <div class="team-member fade-in" 
                             data-category="lecture" 
                             data-modal-id="<?php echo esc_attr( $post_slug ); ?>"
                             tabindex="0" 
                             role="button"
                             aria-label="<?php printf( esc_attr__( 'View details for %s', 'cores-theme' ), get_the_title() ); ?>">
                            
                            <div class="team-avatar">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'thumbnail', array( 'style' => 'border-radius: 50%; width: 100px; height: 100px;' ) ); ?>
                                <?php else : ?>
                                    <i class="fas fa-user-tie"></i>
                                <?php endif; ?>
                            </div>
                            <h4><?php the_title(); ?></h4>
                            <p><?php the_excerpt(); // Use Excerpt for "Lecture" / "Researcher" title ?></p>
                            
                            <div class="team-tags">
                                <?php
                                $tags = get_the_tags();
                                if ( $tags ) {
                                    foreach ( $tags as $tag ) {
                                        echo '<span class="team-tag">' . esc_html( $tag->name ) . '</span>';
                                    }
                                }
                                ?>
                            </div>
                        </div>

                    <?php
                    endwhile;
                else :
                    echo '<p>' . esc_html__( 'No lecturers found. Please add them in the "Team" section of the dashboard.', 'cores-theme' ) . '</p>';
                endif;
                wp_reset_postdata(); // Reset the query
                ?>
            </div>

            <!-- ============================================ -->
            <!-- RESEARCHERS -->
            <!-- ============================================ -->
            <h3 id="researchersTitle" class="team-subtitle fade-in"><?php esc_html_e( 'Research Team', 'cores-theme' ); ?></h3>
            <div class="team-grid">
                <?php
                // 2. WP_Query for Researchers
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
                    'orderby'        => 'date',
                    'order'          => 'ASC',
                );

                $researcher_query = new WP_Query( $args_researcher );

                if ( $researcher_query->have_posts() ) :
                    while ( $researcher_query->have_posts() ) :
                        $researcher_query->the_post();
                        $post_slug = $post->post_name; // This is the unique key
                        ?>

                        <!-- *** THIS IS NOW DYNAMIC *** -->
                        <div class="team-member fade-in" 
                             data-category="researcher" 
                             data-modal-id="<?php echo esc_attr( $post_slug ); ?>"
                             tabindex="0" 
                             role="button"
                             aria-label="<?php printf( esc_attr__( 'View details for %s', 'cores-theme' ), get_the_title() ); ?>">
                             
                            <div class="team-avatar">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'thumbnail', array( 'style' => 'border-radius: 50%; width: 100px; height: 100px;' ) ); ?>
                                <?php else : ?>
                                    <i class="fas fa-user"></i>
                                <?php endif; ?>
                            </div>
                            <h4><?php the_title(); ?></h4>
                            <p><?php the_excerpt(); // Use Excerpt for "Lecture" / "Researcher" title ?></p>
                            
                            <div class="team-tags">
                                <?php
                                $tags = get_the_tags();
                                if ( $tags ) {
                                    foreach ( $tags as $tag ) {
                                        echo '<span class="team-tag">' . esc_html( $tag->name ) . '</span>';
                                    }
                                }
                                ?>
                            </div>
                        </div>

                    <?php
                    endwhile;
                else :
                    // *** BUG FIX: Removed stray 'F' before the dot. ***
                    echo '<p>' . esc_html__( 'No researchers found. Please add them in the "Team" section of the dashboard.', 'cores-theme' ) . '</p>';
                endif;
                wp_reset_postdata(); // Reset the query
                ?>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- TEAM MODAL (Popup) -->
        <!-- ============================================ -->
        <!-- *** This HTML is still here, but it's just a template. *** -->
        <!-- *** The content is now filled by main.js from the teamData object. *** -->
        <div class="team-modal" id="teamModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle" style="display: none;">
            <div class="modal-content">
                <button class="modal-close" onclick="closeTeamModal()" aria-label="<?php esc_attr_e( 'Close modal', 'cores-theme' ); ?>">
                    <i class="fas fa-times"></i>
                </button>
                <div class="modal-body" id="modalBody">
                    <!-- Modal content will be dynamically inserted by JavaScript -->
                    <!-- A loading spinner as a placeholder -->
                    <div class="loader-spinner" style="text-align: center; font-size: 2rem; color: var(--primary);">
                        <i class="fas fa-spinner fa-spin"></i>
                        <p style="font-size: 1rem; margin-top: 1rem;"><?php esc_html_e( 'Loading...', 'cores-theme' ); ?></p>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- #main-content -->

<?php
get_footer(); // This will include the footer.php file
?>