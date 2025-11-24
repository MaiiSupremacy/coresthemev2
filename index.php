<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no front-page.php file exists.
 *
 * ENHANCED FEATURES:
 * - Modern card-based layout
 * - Responsive grid system
 * - Accessibility improvements (WCAG 2.1 Level AA)
 * - Schema.org structured data
 * - Advanced pagination
 * - Breadcrumbs navigation
 * - Featured image optimization
 * - Post meta with icons
 * - Reading time estimation
 * - Share buttons ready
 * - SEO optimized
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
        <!-- PAGE HEADER WITH BREADCRUMBS -->
        <!-- ============================================ -->
        <section class="index-header" style="padding: 10rem 5% 4rem; background: linear-gradient(135deg, var(--light-gray), var(--white));">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                
                <?php
                // Display breadcrumbs if function exists
                if ( function_exists( 'cores_breadcrumbs' ) ) {
                    cores_breadcrumbs();
                }
                ?>
                
                <h1 class="page-title fade-in" style="text-align: center; margin-top: 2rem;">
                    <?php
                    if ( is_home() && ! is_front_page() ) {
                        single_post_title();
                    } elseif ( is_archive() ) {
                        the_archive_title();
                    } elseif ( is_search() ) {
                        /* translators: %s: search query */
                        printf( esc_html__( 'Search Results for: %s', 'cores-theme' ), '<span>' . get_search_query() . '</span>' );
                    } elseif ( is_404() ) {
                        esc_html_e( '404 - Page Not Found', 'cores-theme' );
                    } else {
                        esc_html_e( 'Blog', 'cores-theme' );
                    }
                    ?>
                </h1>
                
                <?php
                // Show archive description
                if ( is_archive() && term_description() ) {
                    the_archive_description( '<div class="archive-description fade-in" style="font-size: 1.2rem; color: #555; max-width: 800px; margin: 1rem auto 0; text-align: center;">', '</div>' );
                }
                
                // Show search info
                if ( is_search() ) {
                    global $wp_query;
                    $total_results = $wp_query->found_posts;
                    echo '<p class="search-results-count fade-in" style="text-align: center; margin-top: 1rem; color: var(--dark-gray);">';
                    /* translators: %s: number of search results */
                    printf( esc_html( _n( '%s result found', '%s results found', $total_results, 'cores-theme' ) ), '<strong>' . number_format_i18n( $total_results ) . '</strong>' );
                    echo '</p>';
                }
                ?>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- MAIN CONTENT AREA -->
        <!-- ============================================ -->
        <section class="index-content-area" style="padding: 4rem 5% 6rem;">
            <div class="container index-container">
                
                <!-- Main Posts Feed -->
                <div class="main-posts-list" role="feed" aria-label="<?php esc_attr_e( 'Blog posts', 'cores-theme' ); ?>">
                    <?php if ( have_posts() ) : ?>
                        
                        <?php
                        // Start The Loop
                        while ( have_posts() ) :
                            the_post();
                            
                            // Get post format
                            $post_format = get_post_format() ?: 'standard';
                            ?>
                            
                            <!-- Individual Post Card -->
                            <article id="post-<?php the_ID(); ?>" 
                                     <?php post_class( 'post-excerpt-card fade-in' ); ?>
                                     itemscope 
                                     itemtype="https://schema.org/BlogPosting">
                                
                                <!-- Hidden meta for Schema.org -->
                                <meta itemprop="mainEntityOfPage" content="<?php the_permalink(); ?>">
                                <meta itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                <meta itemprop="dateModified" content="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>">
                                
                                <?php if ( has_post_thumbnail() ) : ?>
                                <!-- Featured Image -->
                                <div class="post-thumbnail" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                                    <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                                        <?php
                                        the_post_thumbnail(
                                            'cores-card',
                                            array(
                                                'alt' => the_title_attribute( array( 'echo' => false ) ),
                                                'loading' => 'lazy',
                                            )
                                        );
                                        ?>
                                    </a>
                                    <meta itemprop="url" content="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>">
                                    <meta itemprop="width" content="800">
                                    <meta itemprop="height" content="600">
                                </div>
                                <?php endif; ?>

                                <!-- Post Content -->
                                <div class="post-content">
                                    <header class="post-header">
                                        <!-- Post Meta -->
                                        <div class="post-meta">
                                            <span class="post-date">
                                                <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished">
                                                    <?php echo esc_html( get_the_date() ); ?>
                                                </time>
                                            </span>
                                            
                                            <span class="post-categories">
                                                <i class="fas fa-folder" aria-hidden="true"></i>
                                                <?php
                                                $categories = get_the_category();
                                                if ( $categories ) {
                                                    $output = array();
                                                    foreach ( $categories as $category ) {
                                                        $output[] = '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" rel="category tag">' . esc_html( $category->name ) . '</a>';
                                                    }
                                                    echo implode( ', ', $output );
                                                }
                                                ?>
                                            </span>
                                            
                                            <span class="post-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                                <i class="fas fa-user" aria-hidden="true"></i>
                                                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" itemprop="url">
                                                    <span itemprop="name"><?php echo esc_html( get_the_author() ); ?></span>
                                                </a>
                                            </span>
                                            
                                            <?php if ( get_comments_number() > 0 ) : ?>
                                            <span class="post-comments">
                                                <i class="far fa-comments" aria-hidden="true"></i>
                                                <a href="<?php comments_link(); ?>" aria-label="<?php echo esc_attr( sprintf( __( '%s comments', 'cores-theme' ), get_comments_number() ) ); ?>">
                                                    <?php
                                                    /* translators: %s: number of comments */
                                                    printf( _n( '%s Comment', '%s Comments', get_comments_number(), 'cores-theme' ), number_format_i18n( get_comments_number() ) );
                                                    ?>
                                                </a>
                                            </span>
                                            <?php endif; ?>
                                            
                                            <!-- Reading Time -->
                                            <span class="post-reading-time">
                                                <i class="far fa-clock" aria-hidden="true"></i>
                                                <?php
                                                $content = get_post_field( 'post_content', get_the_ID() );
                                                $word_count = str_word_count( strip_tags( $content ) );
                                                $reading_time = ceil( $word_count / 200 ); // Assume 200 words per minute
                                                /* translators: %s: reading time in minutes */
                                                printf( _n( '%s min read', '%s min read', $reading_time, 'cores-theme' ), number_format_i18n( $reading_time ) );
                                                ?>
                                            </span>
                                        </div>
                                        
                                        <!-- Post Title -->
                                        <h2 class="post-title" itemprop="headline">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                <?php the_title(); ?>
                                            </a>
                                        </h2>
                                    </header>
                                    
                                    <!-- Post Excerpt -->
                                    <div class="post-excerpt" itemprop="description">
                                        <?php
                                        if ( has_excerpt() ) {
                                            the_excerpt();
                                        } else {
                                            echo '<p>' . wp_trim_words( get_the_content(), 30, '...' ) . '</p>';
                                        }
                                        ?>
                                    </div>
                                    
                                    <!-- Tags -->
                                    <?php if ( has_tag() ) : ?>
                                    <div class="post-tags">
                                        <?php
                                        $tags = get_the_tags();
                                        if ( $tags ) {
                                            echo '<i class="fas fa-tags" aria-hidden="true"></i> ';
                                            foreach ( $tags as $tag ) {
                                                echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" rel="tag" class="post-tag">' . esc_html( $tag->name ) . '</a> ';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <!-- Read More Button -->
                                    <a href="<?php the_permalink(); ?>" 
                                       class="cta-button" 
                                       style="padding: 0.5rem 1.5rem; font-size: 0.9rem; margin-top: 1rem; display: inline-block;"
                                       aria-label="<?php echo esc_attr( sprintf( __( 'Read more about %s', 'cores-theme' ), get_the_title() ) ); ?>">
                                        <?php esc_html_e( 'Read More', 'cores-theme' ); ?>
                                        <i class="fas fa-arrow-right" aria-hidden="true" style="margin-left: 0.5rem;"></i>
                                    </a>
                                </div>
                            </article>

                        <?php endwhile; ?>

                        <!-- Pagination -->
                        <nav class="pagination-container" role="navigation" aria-label="<?php esc_attr_e( 'Posts pagination', 'cores-theme' ); ?>">
                            <?php
                            // Use WordPress built-in pagination
                            the_posts_pagination(
                                array(
                                    'mid_size'           => 2,
                                    'prev_text'          => '<i class="fas fa-chevron-left" aria-hidden="true"></i> ' . esc_html__( 'Previous', 'cores-theme' ),
                                    'next_text'          => esc_html__( 'Next', 'cores-theme' ) . ' <i class="fas fa-chevron-right" aria-hidden="true"></i>',
                                    'screen_reader_text' => esc_html__( 'Posts navigation', 'cores-theme' ),
                                    'aria_label'         => esc_html__( 'Posts', 'cores-theme' ),
                                    'class'              => 'pagination',
                                )
                            );
                            ?>
                        </nav>

                    <?php else : ?>

                        <!-- No Posts Found -->
                        <div class="no-posts-found" style="padding: 3rem; text-align: center; background: #fff; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                            <?php if ( is_search() ) : ?>
                                <i class="fas fa-search" style="font-size: 4rem; color: var(--accent); margin-bottom: 1.5rem;"></i>
                                <h2><?php esc_html_e( 'Nothing Found', 'cores-theme' ); ?></h2>
                                <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'cores-theme' ); ?></p>
                                <?php get_search_form(); ?>
                                
                                <!-- Suggestions -->
                                <div style="margin-top: 2rem; text-align: left; max-width: 600px; margin-left: auto; margin-right: auto;">
                                    <h3><?php esc_html_e( 'Suggestions:', 'cores-theme' ); ?></h3>
                                    <ul style="list-style: disc; padding-left: 2rem;">
                                        <li><?php esc_html_e( 'Check your spelling', 'cores-theme' ); ?></li>
                                        <li><?php esc_html_e( 'Try more general keywords', 'cores-theme' ); ?></li>
                                        <li><?php esc_html_e( 'Try different keywords', 'cores-theme' ); ?></li>
                                    </ul>
                                </div>
                                
                            <?php elseif ( is_404() ) : ?>
                                <i class="fas fa-exclamation-triangle" style="font-size: 4rem; color: var(--accent); margin-bottom: 1.5rem;"></i>
                                <h2><?php esc_html_e( 'Page Not Found', 'cores-theme' ); ?></h2>
                                <p><?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'cores-theme' ); ?></p>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cta-button" style="margin-top: 1.5rem;">
                                    <i class="fas fa-home" aria-hidden="true"></i>
                                    <?php esc_html_e( 'Go to Homepage', 'cores-theme' ); ?>
                                </a>
                                
                            <?php else : ?>
                                <i class="fas fa-inbox" style="font-size: 4rem; color: var(--accent); margin-bottom: 1.5rem;"></i>
                                <h2><?php esc_html_e( 'No Posts Yet', 'cores-theme' ); ?></h2>
                                <p><?php esc_html_e( 'It seems there are no posts available at the moment. Please check back later!', 'cores-theme' ); ?></p>
                                
                            <?php endif; ?>
                        </div>

                    <?php endif; ?>
                </div> <!-- .main-posts-list -->
                
                <!-- Sidebar -->
                <?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
                <aside class="sidebar-area" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'cores-theme' ); ?>">
                    <?php dynamic_sidebar( 'main-sidebar' ); ?>
                </aside>
                <?php endif; ?>

            </div> <!-- .container.index-container -->
        </section>

    </main><!-- #main-content -->

<?php
get_footer();
?>