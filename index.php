<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no front-page.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CORES_Theme
 */

get_header(); // This will include the header.php file
?>

    <main id="main-content">

        <!-- ============================================ -->
        <!-- GENERIC PAGE/ARCHIVE HEADER -->
        <!-- ============================================ -->
        <section class="index-header" style="padding: 10rem 5% 4rem; background: var(--light-gray);">
            <div class="container" style="max-width: 1200px; margin: 0 auto; text-align: center;">
                <h1 class="page-title fade-in">
                    <?php
                    if ( is_home() && ! is_front_page() ) {
                        single_post_title(); // Shows "Blog" title on the blog index page
                    } elseif ( is_archive() ) {
                        the_archive_title(); // Shows "Category: ..." or "Author: ..."
                    } else {
                        esc_html_e( 'Welcome to the Blog', 'cores-theme' ); // A generic fallback
                    }
                    ?>
                </h1>
                <?php
                // Show an optional archive description (e.g., for categories)
                if ( is_archive() ) {
                    the_archive_description( '<p class="archive-description fade-in" style="font-size: 1.2rem; color: #555; max-width: 800px; margin: 1rem auto 0;">', '</p>' );
                }
                ?>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- MAIN CONTENT & SIDEBAR -->
        <!-- ============================================ -->
        <section class="index-content-area" style="padding: 6rem 5%;">
            <div class="container index-container"> <!-- Styles for this are in the style.css update -->
                
                <!-- Main Posts Feed -->
                <div class="main-posts-list">
                    <?php if ( have_posts() ) : ?>
                        <?php
                        // Start The Loop
                        while ( have_posts() ) :
                            the_post();
                            ?>
                            
                            <!-- Individual Post Card -->
                            <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-excerpt-card fade-in' ); ?>>
                                
                                <!-- Featured Image -->
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( 'large' ); // 'large' is a good default size ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <!-- Post Content -->
                                <div class="post-content">
                                    <header class="post-header">
                                        <div class="post-meta">
                                            <span><?php echo get_the_date(); ?></span> / 
                                            <span><?php the_category( ', ' ); ?></span> / 
                                            <span><?php the_author(); ?></span>
                                        </div>
                                        <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    </header>
                                    <div class="post-excerpt">
                                        <?php the_excerpt(); // Displays the post excerpt ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="cta-button" style="padding: 0.5rem 1.5rem; font-size: 0.9rem;">Read More</a>
                                </div>
                            </article>

                        <?php endwhile; ?>

                        <!-- Pagination -->
                        <div class="pagination-container">
                            <?php
                            the_posts_pagination(
                                array(
                                    'prev_text' => esc_html__( '« Previous', 'cores-theme' ),
                                    'next_text' => esc_html__( 'Next »', 'cores-theme' ),
                                )
                            );
                            ?>
                        </div>

                    <?php else : ?>

                        <!-- No Posts Found Message -->
                        <div class="no-posts-found" style="padding: 3rem; text-align: center; background: #fff; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                            <h2><?php esc_html_e( 'Nothing Found', 'cores-theme' ); ?></h2>
                            <p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'cores-theme' ); ?></p>
                            <?php get_search_form(); // Displays the default WordPress search form ?>
                        </div>

                    <?php endif; ?>
                </div> <!-- .main-posts-list -->
                
                <!-- Sidebar -->
                <aside class="sidebar-area">
                    <?php get_sidebar(); // This calls sidebar.php, which in turn displays the 'main-sidebar' widgets ?>
                </aside> <!-- .sidebar-area -->

            </div> <!-- .container.index-container -->
        </section>

    </main><!-- #main-content -->

<?php
get_footer(); // This will include the footer.php file
?>