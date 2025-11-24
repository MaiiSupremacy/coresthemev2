<?php
/**
 * The template for displaying search results pages
 *
 * ENHANCED FEATURES:
 * ✓ Dedicated Search Header with Result Count
 * ✓ Filtered Results Grid
 * ✓ Post Type Badges (Article, Research, Team, etc.)
 * ✓ Highlighted Search Terms in Excerpts
 * ✓ "No Results" Friendly State with Suggestions
 * ✓ Accessibility Optimized
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package CORES_Theme
 * @version 2.3.0
 */

get_header();

global $wp_query;
$total_results = $wp_query->found_posts;
?>

<main id="main-content" role="main">

    <!-- ============================================ -->
    <!-- SEARCH HEADER -->
    <!-- ============================================ -->
    <section class="search-header-section" style="padding: 8rem 5% 3rem; background: linear-gradient(135deg, var(--light-gray), var(--white)); text-align: center;">
        <div class="container" style="max-width: 800px; margin: 0 auto;">
            
            <h1 class="page-title fade-in" style="margin-bottom: 1rem;">
                <?php
                /* translators: %s: search query */
                printf( esc_html__( 'Search Results for: %s', 'cores-theme' ), '<span class="search-query-highlight">' . get_search_query() . '</span>' );
                ?>
            </h1>
            
            <p class="search-meta fade-in" style="color: var(--dark-gray); font-size: 1.1rem;">
                <?php
                if ( $total_results > 0 ) {
                    /* translators: %s: number of results */
                    printf( 
                        esc_html( _n( 'We found %s matching result.', 'We found %s matching results.', $total_results, 'cores-theme' ) ),
                        '<strong>' . number_format_i18n( $total_results ) . '</strong>'
                    );
                } else {
                    esc_html_e( 'We couldn\'t find any matches.', 'cores-theme' );
                }
                ?>
            </p>

            <!-- Search Form Refiner -->
            <div class="search-refiner fade-in" style="margin-top: 2rem;">
                <?php get_search_form(); ?>
            </div>

        </div>
    </section>

    <!-- ============================================ -->
    <!-- SEARCH RESULTS GRID -->
    <!-- ============================================ -->
    <section class="search-results-section" style="padding: 4rem 5% 6rem;">
        <div class="container" style="max-width: 1200px; margin: 0 auto;">

            <?php if ( have_posts() ) : ?>

                <div class="search-grid">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        
                        // Determine Post Type Label & Icon
                        $post_type = get_post_type();
                        $type_label = 'Article';
                        $type_icon = 'fa-file-alt';
                        $type_color = 'var(--primary)'; // Default

                        switch ( $post_type ) {
                            case 'page':
                                $type_label = 'Page';
                                $type_icon = 'fa-file';
                                $type_color = 'var(--secondary)';
                                break;
                            case 'team_member':
                                $type_label = 'Team Member';
                                $type_icon = 'fa-user';
                                $type_color = 'var(--accent)';
                                break;
                            case 'publication':
                                $type_label = 'Publication';
                                $type_icon = 'fa-book';
                                $type_color = '#2ecc71'; // Green for publications
                                break;
                            case 'student_project':
                                $type_label = 'Project';
                                $type_icon = 'fa-project-diagram';
                                $type_color = '#e67e22'; // Orange for projects
                                break;
                            case 'milestone':
                                $type_label = 'Milestone';
                                $type_icon = 'fa-flag';
                                $type_color = '#9b59b6'; // Purple
                                break;
                        }
                        ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'search-card fade-in' ); ?>>
                            
                            <div class="search-card-type" style="background: <?php echo esc_attr( $type_color ); ?>;">
                                <i class="fas <?php echo esc_attr( $type_icon ); ?>"></i> <?php echo esc_html( $type_label ); ?>
                            </div>

                            <div class="search-card-content">
                                <h2 class="search-card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                
                                <div class="search-card-excerpt">
                                    <?php 
                                    // Highlight search term in excerpt if possible
                                    $excerpt = get_the_excerpt();
                                    $keys = explode(" ", get_search_query());
                                    $excerpt = preg_replace('/(' . implode('|', $keys) . ')/iu', '<mark>\0</mark>', $excerpt);
                                    echo $excerpt; 
                                    ?>
                                </div>

                                <a href="<?php the_permalink(); ?>" class="read-more-link">
                                    <?php esc_html_e( 'View Details', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>

                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="pagination-container" style="margin-top: 4rem; text-align: center;">
                    <?php
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => '<i class="fas fa-chevron-left"></i>',
                        'next_text' => '<i class="fas fa-chevron-right"></i>',
                    ) );
                    ?>
                </div>

            <?php else : ?>

                <!-- No Results Found -->
                <div class="no-results-container fade-in" style="text-align: center; padding: 3rem; background: var(--white); border-radius: var(--radius-lg); box-shadow: var(--shadow-md); max-width: 800px; margin: 0 auto;">
                    <div style="font-size: 4rem; color: var(--gray); margin-bottom: 1.5rem;">
                        <i class="fas fa-search-minus"></i>
                    </div>
                    <h2 style="color: var(--primary); margin-bottom: 1rem;"><?php esc_html_e( 'Nothing Found', 'cores-theme' ); ?></h2>
                    <p style="color: var(--dark-gray); margin-bottom: 2rem; font-size: 1.1rem;">
                        <?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'cores-theme' ); ?>
                    </p>
                    
                    <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cta-button">
                            <i class="fas fa-home"></i> <?php esc_html_e( 'Return Home', 'cores-theme' ); ?>
                        </a>
                        <a href="<?php echo esc_url( home_url( '/research/' ) ); ?>" class="cta-button secondary-btn" style="background: transparent; color: var(--primary); border: 2px solid var(--primary);">
                            <i class="fas fa-flask"></i> <?php esc_html_e( 'View Research', 'cores-theme' ); ?>
                        </a>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </section>

</main><!-- #main-content -->

<?php
get_footer();
?>