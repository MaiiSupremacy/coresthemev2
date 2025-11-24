<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * ENHANCED FEATURES:
 * ✓ Dynamic Archive Header (Category, Tag, Author, Date)
 * ✓ Glassmorphic Description Box
 * ✓ Masonry-style Grid Layout Option (via CSS)
 * ✓ Consistent Card Design with Index/Search
 * ✓ Sidebar Support
 * ✓ Breadcrumbs Integration
 * ✓ Accessibility Optimized
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CORES_Theme
 * @version 2.3.0
 */

get_header();
?>

<main id="main-content" role="main">

    <!-- ============================================ -->
    <!-- ARCHIVE HEADER -->
    <!-- ============================================ -->
    <section class="archive-header-section" style="padding: 10rem 5% 4rem; background: linear-gradient(135deg, var(--light-gray), var(--white)); position: relative; overflow: hidden;">
        
        <!-- Decorative Background Element -->
        <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(5, 191, 219, 0.05) 0%, transparent 70%); border-radius: 50%; z-index: 0;"></div>

        <div class="container" style="max-width: 1200px; margin: 0 auto; position: relative; z-index: 1; text-align: center;">
            
            <!-- Breadcrumbs -->
            <div class="fade-in" style="margin-bottom: 1.5rem;">
                <?php if ( function_exists( 'cores_breadcrumbs' ) ) cores_breadcrumbs(); ?>
            </div>

            <!-- Archive Title -->
            <h1 class="page-title fade-in" style="margin-bottom: 1.5rem;">
                <?php the_archive_title( '<span class="archive-prefix-label">', '</span>' ); ?>
            </h1>

            <!-- Archive Description -->
            <?php if ( get_the_archive_description() ) : ?>
                <div class="archive-description-box fade-in">
                    <?php the_archive_description(); ?>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- ============================================ -->
    <!-- ARCHIVE CONTENT -->
    <!-- ============================================ -->
    <section class="archive-content-area" style="padding: 4rem 5% 6rem;">
        <div class="container archive-container">
            
            <!-- Main Content Column -->
            <div class="archive-posts-list">
                
                <?php if ( have_posts() ) : ?>

                    <div class="archive-grid">
                        <?php
                        while ( have_posts() ) :
                            the_post();
                            ?>

                            <!-- Post Card (Consistent with Index/Search) -->
                            <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-excerpt-card fade-in' ); ?>>
                                
                                <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                                        <?php the_post_thumbnail( 'cores-card', array( 'loading' => 'lazy' ) ); ?>
                                    </a>
                                </div>
                                <?php endif; ?>

                                <div class="post-content">
                                    <header class="post-header">
                                        <!-- Meta -->
                                        <div class="post-meta">
                                            <span class="post-date">
                                                <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                                <?php echo get_the_date(); ?>
                                            </span>
                                            
                                            <!-- Only show author if not on author archive to avoid redundancy -->
                                            <?php if ( ! is_author() ) : ?>
                                            <span class="post-author">
                                                <i class="far fa-user" aria-hidden="true"></i>
                                                <?php the_author_posts_link(); ?>
                                            </span>
                                            <?php endif; ?>
                                        </div>

                                        <h2 class="post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                    </header>

                                    <div class="post-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <a href="<?php the_permalink(); ?>" class="cta-button small-btn">
                                        <?php esc_html_e( 'Read Article', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </article>

                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container" style="margin-top: 4rem;">
                        <?php
                        the_posts_pagination( array(
                            'mid_size'  => 2,
                            'prev_text' => '<i class="fas fa-chevron-left"></i>',
                            'next_text' => '<i class="fas fa-chevron-right"></i>',
                        ) );
                        ?>
                    </div>

                <?php else : ?>

                    <!-- Empty State -->
                    <div class="no-posts-found fade-in">
                        <i class="fas fa-folder-open" style="font-size: 4rem; color: var(--gray); margin-bottom: 1.5rem;"></i>
                        <h2><?php esc_html_e( 'No Posts Found', 'cores-theme' ); ?></h2>
                        <p><?php esc_html_e( 'We couldn\'t find any posts in this archive.', 'cores-theme' ); ?></p>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cta-button" style="margin-top: 1.5rem;">
                            <?php esc_html_e( 'Back to Home', 'cores-theme' ); ?>
                        </a>
                    </div>

                <?php endif; ?>

            </div>

            <!-- Sidebar -->
            <aside class="sidebar-area fade-in">
                <?php get_sidebar(); ?>
            </aside>

        </div>
    </section>

</main>

<?php
get_footer();
?>