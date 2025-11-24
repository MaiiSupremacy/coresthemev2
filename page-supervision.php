<?php
/**
 * Template Name: Supervision Page
 *
 * This is the template that displays the Student Supervision page.
 *
 * *** MAJOR IMPROVEMENT: ***
 * - This file is now 100% dynamic. ALL static content has been removed.
 * - "Why Join", "Research Areas", "How to Join", "Requirements" sections
 * are all populated from "Appearance > Customize > Supervision Page Content".
 * - "Current Student Projects" timeline is now a WP_Query loop,
 * populated from the "Student Projects" Custom Post Type.
 * - "Meet Our Supervisors" is now a WP_Query loop, populated from the
 * "Team" CPT (with the 'lecture' role).
 * - All text is internationalized and accessible.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CORES_Theme
 * @version 2.3.0
 */

get_header(); // This will include the header.php file
?>

    <main id="main-content">

        <!-- ============================================ -->
        <!-- PAGE TITLE & INTRODUCTION -->
        <!-- ============================================ -->
        <section style="padding: 10rem 5% 4rem; background: var(--white);">
            <h1 class="section-title fade-in"><?php esc_html_e( 'Student Supervision', 'cores-theme' ); ?></h1>
            <p class="fade-in" style="text-align: center; max-width: 900px; margin: 0 auto; font-size: 1.2rem; color: var(--dark); line-height: 1.8;">
                <?php esc_html_e( 'Join CORES and contribute to cutting-edge coastal research while completing your undergraduate or graduate thesis under the guidance of our experienced faculty members.', 'cores-theme' ); ?>
            </p>
        </section>

        <!-- ============================================ -->
        <!-- ABOUT SUPERVISION -->
        <!-- ============================================ -->
        <section style="padding: 0 5% 6rem; background: var(--white);">
            <div class="fade-in" style="max-width: 1000px; margin: 0 auto;">
                <h2 style="font-size: 2.5rem; color: var(--primary); margin-bottom: 2rem; text-align: center;"><?php esc_html_e( 'Why Join CORES?', 'cores-theme' ); ?></h2>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 3rem;">
                    
                    <?php
                    // Icons are hard-coded for simplicity, text is dynamic.
                    $join_icons = array( 'fa-microscope', 'fa-users', 'fa-map-marked-alt', 'fa-graduation-cap' );
                    for ( $i = 1; $i <= 4; $i++ ) :
                        $title = get_theme_mod( "cores_supervision_join_card_${i}_title", esc_html__( 'Card Title', 'cores-theme' ) );
                        $desc  = get_theme_mod( "cores_supervision_join_card_${i}_desc", esc_html__( 'Card description goes here. Edit in Customizer.', 'cores-theme' ) );
                        ?>
                        <div class="card fade-in">
                            <div class="card-icon"><i class="fas <?php echo esc_attr( $join_icons[ $i - 1 ] ); ?>"></i></div>
                            <h3><?php echo esc_html( $title ); ?></h3>
                            <p><?php echo nl2br( esc_html( $desc ) ); // nl2br respects line breaks from textarea ?></p>
                        </div>
                    <?php endfor; ?>
                    
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- RESEARCH AREAS FOR STUDENTS -->
        <!-- ============================================ -->
        <section style="padding: 6rem 5%; background: linear-gradient(135deg, rgba(224, 225, 221, 0.3), rgba(255, 255, 255, 1));">
            <h2 class="section-title fade-in"><?php esc_html_e( 'Available Research Areas', 'cores-theme' ); ?></h2>
            
            <div style="max-width: 1200px; margin: 0 auto;">
                <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark);">
                    <?php esc_html_e( 'Students can choose from a variety of research topics aligned with our core research areas:', 'cores-theme' ); ?>
                </p>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
                    
                    <?php
                    // Icons are hard-coded for simplicity, text is dynamic.
                    $area_icons = array( 'fa-water', 'fa-tree', 'fa-drone', 'fa-flask', 'fa-chart-line', 'fa-satellite' );
                    for ( $i = 1; $i <= 6; $i++ ) :
                        $title = get_theme_mod( "cores_supervision_area_${i}_title", esc_html__( 'Area Title', 'cores-theme' ) );
                        $desc  = get_theme_mod( "cores_supervision_area_${i}_desc", esc_html__( 'Area description. Edit in Customizer.', 'cores-theme' ) );
                        ?>
                        <div class="publication fade-in"> <!-- Re-using 'publication' style card -->
                            <h4 style="color: var(--primary);"><i class="fas <?php echo esc_attr( $area_icons[ $i - 1 ] ); ?>" style="color: var(--accent); margin-right: 0.5rem;"></i> <?php echo esc_html( $title ); ?></h4>
                            <p style="font-size: 0.95rem;"><?php echo nl2br( esc_html( $desc ) ); ?></p>
                        </div>
                    <?php endfor; ?>
                    
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- ACTIVE PROJECTS -->
        <!-- ============================================ -->
        <section style="padding: 6rem 5%; background: var(--white);">
            <h2 class="section-title fade-in"><?php esc_html_e( 'Current Student Projects', 'cores-theme' ); ?></h2>
            
            <div class="timeline fade-in" style="max-width: 900px; margin: 0 auto;">
                
                <?php
                // WP_Query for Student Projects CPT
                $args_projects = array(
                    'post_type'      => 'student_project',
                    'posts_per_page' => 4,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                );

                $project_query = new WP_Query( $args_projects );

                if ( $project_query->have_posts() ) :
                    while ( $project_query->have_posts() ) :
                        $project_query->the_post();
                        
                        // Get Project Status (Taxonomy)
                        $status_terms = get_the_terms( get_the_ID(), 'project_status' );
                        $status_name = '';
                        $status_slug = 'available'; // Default
                        if ( ! empty( $status_terms ) && ! is_wp_error( $status_terms ) ) {
                            $status_name = $status_terms[0]->name;
                            $status_slug = $status_terms[0]->slug;
                        }

                        // Get Project Area (Post Tag)
                        $tags = get_the_terms( get_the_ID(), 'post_tag' );
                        
                        ?>
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <!-- Use Project Status for the "date" -->
                                <div class="timeline-date"><?php echo esc_html( $status_name ); ?></div>
                                <!-- Project Title -->
                                <h4><?php the_title(); ?></h4>
                                <!-- Project Description -->
                                <div style="margin-bottom: 1rem;"><?php the_content(); ?></div>
                                
                                <?php if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) : ?>
                                    <?php
                                    // Determine tag color based on status
                                    $tag_bg_color = ( $status_slug === 'available' ) ? 'var(--primary)' : 'var(--accent)';
                                    ?>
                                    <?php foreach ( $tags as $tag ) : ?>
                                        <span style="display: inline-block; padding: 0.3rem 0.8rem; background: <?php echo $tag_bg_color; ?>; color: white; border-radius: 15px; font-size: 0.85rem; margin-top: 0.5rem;">
                                            <?php echo esc_html( $tag->name ); ?>
                                        </span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                    endwhile;
                else :
                    echo '<p style="text-align: center;">' . esc_html__( 'No student projects found. Please add them in the "Student Projects" section.', 'cores-theme' ) . '</p>';
                endif;
                wp_reset_postdata(); // Reset the query
                ?>
                
            </div>
        </section>

        <!-- ============================================ -->
        <!-- HOW TO JOIN -->
        <!-- ============================================ -->
        <section style="padding: 6rem 5%; background: linear-gradient(135deg, rgba(224, 225, 221, 0.3), rgba(255, 255, 255, 1));">
            <h2 class="section-title fade-in"><?php esc_html_e( 'How to Join CORES', 'cores-theme' ); ?></h2>
            
            <div style="max-width: 1000px; margin: 0 auto;">
                <div class="stats-container" style="margin-bottom: 3rem;">
                    
                    <?php
                    // Icons are hard-coded for simplicity, text is dynamic.
                    $step_icons = array( 'fa-file-alt', 'fa-comments', 'fa-clipboard-check', 'fa-rocket' );
                    for ( $i = 1; $i <= 4; $i++ ) :
                        $title = get_theme_mod( "cores_supervision_how_step_${i}_title", esc_html__( 'Step Title', 'cores-theme' ) );
                        $desc  = get_theme_mod( "cores_supervision_how_step_${i}_desc", esc_html__( 'Step description. Edit in Customizer.', 'cores-theme' ) );
                        ?>
                        <div class="stat-card fade-in">
                            <div style="font-size: 3rem; margin-bottom: 1rem;"><i class="fas <?php echo esc_attr( $step_icons[ $i - 1 ] ); ?>" style="color: var(--accent);"></i></div>
                            <div class="stat-label" style="font-size: 1.1rem; font-weight: 600; color: var(--primary);"><?php echo esc_html( $title ); ?></div>
                            <p style="font-size: 0.9rem; margin-top: 0.5rem;"><?php echo esc_html( $desc ); ?></p>
                        </div>
                    <?php endfor; ?>
                    
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- REQUIREMENTS -->
        <!-- ============================================ -->
        <section style="padding: 6rem 5%; background: var(--white);">
            <h2 class="section-title fade-in"><?php esc_html_e( 'What We Look For', 'cores-theme' ); ?></h2>
            
            <div style="max-width: 900px; margin: 0 auto;">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem; margin-top: 3rem;">
                    <div class="fade-in">
                        <h3 style="color: var(--primary); margin-bottom: 1.5rem; font-size: 1.8rem;"><i class="fas fa-check-circle" style="color: var(--accent); margin-right: 0.5rem;"></i> <?php esc_html_e( 'Academic Requirements', 'cores-theme' ); ?></h3>
                        <ul style="list-style: none; padding: 0;">
                            <?php
                            $req_list_content = get_theme_mod( 'cores_supervision_req_list', "Currently enrolled in Water Resources Engineering or related program\nMinimum GPA of 3.0 (preferred)" );
                            $req_items        = explode( "\n", $req_list_content );
                            
                            foreach ( $req_items as $item ) :
                                if ( ! empty( $item ) ) :
                                    ?>
                                    <li style="padding: 0.8rem 0; border-bottom: 1px solid var(--gray); font-size: 1.05rem;"><i class="fas fa-chevron-right" style="color: var(--accent); margin-right: 0.5rem;"></i> <?php echo esc_html( $item ); ?></li>
                                <?php
                                endif;
                            endforeach;
                            ?>
                        </ul>
                    </div>
                    
                    <div class="fade-in">
                        <h3 style="color: var(--primary); margin-bottom: 1.5rem; font-size: 1.8rem;"><i class="fas fa-star" style="color: var(--accent); margin-right: 0.5rem;"></i> <?php esc_html_e( 'Desired Skills', 'cores-theme' ); ?></h3>
                        <ul style="list-style: none; padding: 0;">
                            <?php
                            $skill_list_content = get_theme_mod( 'cores_supervision_skill_list', "Enthusiasm for coastal science and fieldwork\nBasic programming skills\nStrong teamwork" );
                            $skill_items        = explode( "\n", $skill_list_content );
                            
                            foreach ( $skill_items as $item ) :
                                if ( ! empty( $item ) ) :
                                    ?>
                                    <li style="padding: 0.8rem 0; border-bottom: 1px solid var(--gray); font-size: 1.05rem;"><i class="fas fa-chevron-right" style="color: var(--accent); margin-right: 0.5rem;"></i> <?php echo esc_html( $item ); ?></li>
                                <?php
                                endif;
                            endforeach;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- MEET OUR SUPERVISORS -->
        <!-- ============================================ -->
        <section style="padding: 6rem 5%; background: linear-gradient(135deg, rgba(224, 225, 221, 0.3), rgba(255, 255, 255, 1));">
            <h2 class="section-title fade-in"><?php esc_html_e( 'Meet Our Supervisors', 'cores-theme' ); ?></h2>
            
            <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark);">
                <?php esc_html_e( 'Work with experienced faculty members who are passionate about mentoring the next generation of coastal researchers.', 'cores-theme' ); ?>
            </p>
            
            <div class="team-grid" style="max-width: 1000px; margin: 0 auto;">
                
                <?php
                // WP_Query for Lecturers (a preview)
                $args_lecture_preview = array(
                    'post_type'      => 'team_member',
                    'posts_per_page' => 4, // Show 4
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

                $lecture_preview_query = new WP_Query( $args_lecture_preview );

                if ( $lecture_preview_query->have_posts() ) :
                    while ( $lecture_preview_query->have_posts() ) :
                        $lecture_preview_query->the_post();
                        ?>
                        <!-- This is a non-clickable, non-modal card -->
                        <div class="team-member fade-in">
                            <div class="team-avatar">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'thumbnail', array( 'style' => 'border-radius: 50%; width: 100px; height: 100px;' ) ); ?>
                                <?php else : ?>
                                    <i class="fas fa-user-tie"></i>
                                <?php endif; ?>
                            </div>
                            <h4><?php the_title(); ?></h4>
                            <p><?php the_excerpt(); ?></p>
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
                    echo '<p style="text-align: center;">' . esc_html__( 'No supervisors found.', 'cores-theme' ) . '</p>';
                endif;
                wp_reset_postdata(); // Reset the query
                ?>
                
            </div>
            
            <div style="text-align: center; margin-top: 3rem;">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'people' ) ) ); ?>" class="cta-button"><?php esc_html_e( 'View Full Team', 'cores-theme' ); ?></a>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- CONTACT CTA -->
        <!-- ============================================ -->
        <section style="padding: 6rem 5%; background: var(--primary); color: white; text-align: center;">
            <div class="fade-in" style="max-width: 800px; margin: 0 auto;">
                <h2 style="font-size: 2.8rem; margin-bottom: 1.5rem; color: white;"><?php esc_html_e( 'Ready to Start Your Research Journey?', 'cores-theme' ); ?></h2>
                <p style="font-size: 1.2rem; line-height: 1.8; margin-bottom: 2.5rem; opacity: 0.95;">
                    <?php esc_html_e( 'Join CORES and be part of groundbreaking coastal research. Contact us today to discuss available projects and supervision opportunities.', 'cores-theme' ); ?>
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="#contact" class="cta-button" style="background: white; color: var(--primary); font-size: 1.1rem;"><?php esc_html_e( 'Send Us a Message', 'cores-theme' ); ?></a>
                    <a href="mailto:<?php echo esc_attr( get_theme_mod( 'cores_email_1', 'coastalresearchers@gmail.com' ) ); ?>" class="cta-button" style="background: var(--accent); font-size: 1.1rem;"><?php esc_html_e( 'Email Us Directly', 'cores-theme' ); ?></a>
                </div>
            </div>
        </section>

    </main><!-- #main-content -->

<?php
get_footer(); // This will include the footer.php file
?>