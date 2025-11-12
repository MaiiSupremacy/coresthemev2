<?php
/**
 * Template Name: Publications Page
 *
 * This is the template that displays the Publications page.
 *
 * *** MAJOR IMPROVEMENT: ***
 * - Removed ALL hard-coded HTML for publications and stats.
 * - Page is now 100% dynamic.
 * - Publications are populated from a new "Publication" Custom Post Type.
 * - Stats are now editable in "Appearance > Customize" (inc/customizer.php).
 * - All text is internationalized and accessible.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CORES_Theme
 */

get_header(); // This will include the header.php file
?>

    <main id="main-content">

        <!-- ============================================ -->
        <!-- PAGE TITLE & INTRODUCTION -->
        <!-- ============================================ -->
        <section style="padding: 10rem 5% 4rem; background: var(--white);">
            <h1 class="section-title fade-in"><?php esc_html_e( 'Recent Publications', 'cores-theme' ); ?></h1>
            <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto; font-size: 1.2rem; color: var(--dark); line-height: 1.8;">
                <?php esc_html_e( 'Explore our latest research findings and academic contributions to coastal science, published in peer-reviewed journals and conferences.', 'cores-theme' ); ?>
            </p>
        </section>

        <!-- ============================================ -->
        <!-- PUBLICATIONS LIST -->
        <!-- ============================================ -->
        <section class="publications-section" id="publications" style="padding: 0 5% 6rem; background: var(--white);">
            <div class="publication-list">
                
                <?php
                // 1. WP_Query for Publications
                $args_publications = array(
                    'post_type'      => 'publication',
                    'posts_per_page' => 10, // Show 10 per page
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                );

                $publication_query = new WP_Query( $args_publications );

                if ( $publication_query->have_posts() ) :
                    while ( $publication_query->have_posts() ) :
                        $publication_query->the_post();
                        ?>
                        
                        <!-- *** THIS IS NOW DYNAMIC *** -->
                        <div class="publication fade-in">
                            <h4><?php the_title(); ?></h4>
                            
                            <?php if ( has_excerpt() ) : ?>
                                <!-- Use Excerpt for Authors / Journal Info -->
                                <p class="publication-authors"><?php echo esc_html( get_the_excerpt() ); ?></p>
                            <?php endif; ?>
                            
                            <?php the_content(); // Use main editor for the abstract/description ?>
                            
                            <div class="publication-meta">
                                <span>
                                    <i class="fas fa-calendar-alt" style="color: var(--accent); margin-right: 0.5rem;"></i>
                                    <?php echo get_the_date( 'F Y' ); // Format: "November 2025" ?>
                                </span>
                                
                                <!-- 
                                    IDEA: To make this link external, we can add a Custom Field 
                                    (e.g., 'publication_url') to the CPT. 
                                    For now, it just links to the single post page.
                                -->
                                <a href="<?php the_permalink(); ?>" class="publication-link">
                                    <?php esc_html_e( 'View Publication', 'cores-theme' ); ?> <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>

                    <?php
                    endwhile;
                    
                    // Add pagination if there are more than 10 publications
                    
                else :
                    echo '<p>' . esc_html__( 'No publications found. Please add them in the "Publications" section of the dashboard.', 'cores-theme' ) . '</p>';
                endif;
                wp_reset_postdata(); // Reset the query
                ?>
                
            </div>
        </section>

        <!-- ============================================ -->
        <!-- PUBLICATION STATS (Optional) -->
        <!-- ============================================ -->
        <section style="padding: 6rem 5%; background: linear-gradient(135deg, rgba(224, 225, 221, 0.3), rgba(255, 255, 255, 1));">
            <h2 class="section-title fade-in"><?php esc_html_e( 'Our Research Impact', 'cores-theme' ); ?></h2>
            
            <!-- *** IMPROVED: Stats are now dynamic from Customizer *** -->
            <div class="stats-container">
                <div class="stat-card fade-in">
                    <div class="stat-number"><?php echo esc_html( get_theme_mod( 'cores_pub_stat_1_number', '6+' ) ); ?></div>
                    <div class="stat-label"><?php echo esc_html( get_theme_mod( 'cores_pub_stat_1_label', esc_html__( 'Published Papers', 'cores-theme' ) ) ); ?></div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-number"><?php echo esc_html( get_theme_mod( 'cores_pub_stat_2_number', '3+' ) ); ?></div>
                    <div class="stat-label"><?php echo esc_html( get_theme_mod( 'cores_pub_stat_2_label', esc_html__( 'Years Active', 'cores-theme' ) ) ); ?></div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-number"><?php echo esc_html( get_theme_mod( 'cores_pub_stat_3_number', '100+' ) ); ?></div>
                    <div class="stat-label"><?php echo esc_html( get_theme_mod( 'cores_pub_stat_3_label', esc_html__( 'Citations', 'cores-theme' ) ) ); ?></div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-number"><?php echo esc_html( get_theme_mod( 'cores_pub_stat_4_number', '5+' ) ); ?></div>
                    <div class="stat-label"><?php echo esc_html( get_theme_mod( 'cores_pub_stat_4_label', esc_html__( 'h-index', 'cores-theme' ) ) ); ?></div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- CALL TO ACTION -->
        <!-- ============================================ -->
        <section style="padding: 6rem 5%; background: var(--white); text-align: center;">
            <div class="fade-in" style="max-width: 700px; margin: 0 auto;">
                <h2 style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1.5rem;"><?php esc_html_e( 'Looking for Collaboration?', 'cores-theme' ); ?></h2>
                <p style="font-size: 1.2rem; color: var(--dark); line-height: 1.8; margin-bottom: 2rem;">
                    <?php esc_html_e( 'We welcome collaboration opportunities with researchers, institutions, and organizations interested in coastal science and marine conservation.', 'cores-theme' ); ?>
                </p>
                <a href="#contact" class="cta-button" style="font-size: 1.1rem;"><?php esc_html_e( 'Get In Touch', 'cores-theme' ); ?></a>
            </div>
        </section>

    </main><!-- #main-content -->

<?php
get_footer(); // This will include the footer.php file
?>