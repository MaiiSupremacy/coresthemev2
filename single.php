<?php
/**
 * The template for displaying all single posts
 *
 * ENHANCED FEATURES:
 * ✓ Reading Progress Bar
 * ✓ Immersive Hero Header with Glassmorphism
 * ✓ Floating Social Share Sidebar
 * ✓ Estimated Reading Time
 * ✓ Enhanced Author Bio Box
 * ✓ Related Posts Grid
 * ✓ Post Navigation
 * ✓ Threaded Comments
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CORES_Theme
 * @version 2.3.0
 */

get_header();
?>

<!-- Reading Progress Bar -->
<div id="reading-progress-container" aria-hidden="true">
    <div id="reading-progress-bar"></div>
</div>

<main id="main-content" role="main">

    <?php
    while ( have_posts() ) :
        the_post();

        // Calculate Reading Time
        $content = get_post_field( 'post_content', get_the_ID() );
        $word_count = str_word_count( strip_tags( $content ) );
        $reading_time = ceil( $word_count / 200 ); // 200 words per minute

        // Get Categories
        $categories = get_the_category();
        $cat_list = [];
        if ( $categories ) {
            foreach ( $categories as $category ) {
                $cat_list[] = '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="hero-cat">' . esc_html( $category->name ) . '</a>';
            }
        }
        ?>

        <!-- ============================================ -->
        <!-- IMMERSIVE HERO SECTION -->
        <!-- ============================================ -->
        <header class="single-hero-section">
            <!-- Background Image -->
            <div class="single-hero-bg" style="background-image: url('<?php echo has_post_thumbnail() ? esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ) : 'https://picsum.photos/1920/1080'; ?>');"></div>
            <div class="single-hero-overlay"></div>
            
            <div class="container" style="position: relative; z-index: 2; height: 100%; display: flex; flex-direction: column; justify-content: center; text-align: center;">
                
                <!-- Breadcrumbs -->
                <div class="fade-in" style="margin-bottom: 2rem;">
                    <?php if ( function_exists( 'cores_breadcrumbs' ) ) cores_breadcrumbs(); ?>
                </div>

                <!-- Categories -->
                <div class="hero-categories fade-in">
                    <?php echo implode( ' ', $cat_list ); ?>
                </div>

                <!-- Title -->
                <h1 class="entry-title fade-in"><?php the_title(); ?></h1>

                <!-- Meta Data -->
                <div class="entry-meta fade-in">
                    <span class="meta-item">
                        <i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?>
                    </span>
                    <span class="meta-item">
                        <i class="far fa-user"></i> <?php the_author(); ?>
                    </span>
                    <span class="meta-item">
                        <i class="far fa-clock"></i> <?php echo sprintf( esc_html__( '%d min read', 'cores-theme' ), $reading_time ); ?>
                    </span>
                    <span class="meta-item">
                        <i class="far fa-comments"></i> <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?>
                    </span>
                </div>
            </div>
        </header>

        <div class="container single-post-layout">
            
            <!-- ============================================ -->
            <!-- SIDEBAR / SHARE (Sticky) -->
            <!-- ============================================ -->
            <aside class="single-sidebar-left">
                <div class="sticky-share-wrapper fade-in">
                    <span class="share-label"><?php esc_html_e( 'Share', 'cores-theme' ); ?></span>
                    
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer" class="share-btn fb" aria-label="Share on Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    
                    <a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer" class="share-btn tw" aria-label="Share on Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" rel="noopener noreferrer" class="share-btn li" aria-label="Share on LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    
                    <a href="https://wa.me/?text=<?php the_title(); ?>%20<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer" class="share-btn wa" aria-label="Share on WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>

                    <button class="share-btn cp" onclick="navigator.clipboard.writeText('<?php the_permalink(); ?>'); alert('Link copied!');" aria-label="Copy Link">
                        <i class="fas fa-link"></i>
                    </button>
                </div>
            </aside>

            <!-- ============================================ -->
            <!-- MAIN ARTICLE CONTENT -->
            <!-- ============================================ -->
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-content-area' ); ?>>
                
                <!-- Content -->
                <div class="entry-content fade-in">
                    <?php
                    the_content();

                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cores-theme' ),
                        'after'  => '</div>',
                    ) );
                    ?>
                </div>

                <!-- Tags -->
                <?php if ( has_tag() ) : ?>
                <div class="entry-footer fade-in">
                    <div class="tags-container">
                        <span class="tags-label"><i class="fas fa-tags"></i> <?php esc_html_e( 'Tags:', 'cores-theme' ); ?></span>
                        <?php the_tags( '', '' ); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Author Box -->
                <div class="author-box fade-in">
                    <div class="author-avatar">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
                    </div>
                    <div class="author-info">
                        <h3 class="author-name"><?php the_author(); ?></h3>
                        <p class="author-bio"><?php echo get_the_author_meta( 'description' ); ?></p>
                        <div class="author-links">
                            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                                <?php esc_html_e( 'View all posts', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Post Navigation -->
                <nav class="post-navigation fade-in">
                    <div class="nav-previous">
                        <?php
                        $prev_post = get_previous_post();
                        if ( $prev_post ) :
                        ?>
                            <span class="nav-subtitle"><i class="fas fa-arrow-left"></i> <?php esc_html_e( 'Previous Post', 'cores-theme' ); ?></span>
                            <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="nav-title"><?php echo get_the_title( $prev_post->ID ); ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="nav-next">
                        <?php
                        $next_post = get_next_post();
                        if ( $next_post ) :
                        ?>
                            <span class="nav-subtitle"><?php esc_html_e( 'Next Post', 'cores-theme' ); ?> <i class="fas fa-arrow-right"></i></span>
                            <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="nav-title"><?php echo get_the_title( $next_post->ID ); ?></a>
                        <?php endif; ?>
                    </div>
                </nav>

                <!-- Related Posts -->
                <div class="related-posts-section fade-in">
                    <h3 class="related-title">
                        <?php esc_html_e( 'You Might Also Like', 'cores-theme' ); ?>
                        <span class="title-line"></span>
                    </h3>
                    
                    <div class="related-grid">
                        <?php
                        $related_args = array(
                            'category__in'   => wp_get_post_categories( get_the_ID() ),
                            'post__not_in'   => array( get_the_ID() ),
                            'posts_per_page' => 3,
                            'orderby'        => 'rand'
                        );
                        $related_query = new WP_Query( $related_args );

                        if ( $related_query->have_posts() ) :
                            while ( $related_query->have_posts() ) : $related_query->the_post();
                        ?>
                            <a href="<?php the_permalink(); ?>" class="related-card">
                                <div class="related-thumb">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'medium' ); ?>
                                    <?php else : ?>
                                        <div class="fallback-thumb"><i class="fas fa-image"></i></div>
                                    <?php endif; ?>
                                </div>
                                <div class="related-content">
                                    <span class="related-date"><?php echo get_the_date( 'M j, Y' ); ?></span>
                                    <h4><?php the_title(); ?></h4>
                                </div>
                            </a>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p>' . esc_html__( 'No related posts found.', 'cores-theme' ) . '</p>';
                        endif;
                        ?>
                    </div>
                </div>

                <!-- Comments -->
                <?php
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>

            </article>

        </div>

    <?php endwhile; ?>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Reading Progress Bar
    const progressBar = document.getElementById('reading-progress-bar');
    const contentArea = document.querySelector('.entry-content');
    
    if (progressBar && contentArea) {
        window.addEventListener('scroll', function() {
            const contentBox = contentArea.getBoundingClientRect();
            const contentHeight = contentArea.offsetHeight;
            const windowHeight = window.innerHeight;
            const scrolled = window.scrollY;
            const contentTop = contentArea.offsetTop;
            
            // Calculate percentage
            let percentage = ((scrolled - contentTop + windowHeight) / contentHeight) * 100;
            
            // Clamp between 0 and 100
            percentage = Math.max(0, Math.min(100, percentage));
            
            progressBar.style.width = percentage + '%';
        }, { passive: true });
    }
});
</script>

<?php
get_footer();
?>