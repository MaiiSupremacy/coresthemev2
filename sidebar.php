<?php
/**
 * The sidebar containing the main widget area
 *
 * ENHANCED FEATURES:
 * ✓ Sticky Sidebar Support (via CSS class)
 * ✓ Accessibility Improvements (ARIA labels)
 * ✓ Fallback Content (if no widgets active)
 * ✓ Modern Widget Styling Wrappers
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CORES_Theme
 * @version 2.3.0
 */
?>

<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'cores-theme' ); ?>">
    
    <!-- Sticky Container Wrapper -->
    <div class="sidebar-sticky-container">
        
        <?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
            
            <?php dynamic_sidebar( 'main-sidebar' ); ?>

        <?php else : ?>

            <!-- Fallback Content if no widgets are active -->
            <section class="widget widget_search fade-in">
                <?php get_search_form(); ?>
            </section>

            <section class="widget widget_categories fade-in">
                <h2 class="widget-title"><?php esc_html_e( 'Categories', 'cores-theme' ); ?></h2>
                <ul>
                    <?php
                    wp_list_categories( array(
                        'title_li' => '',
                        'show_count' => true,
                    ) );
                    ?>
                </ul>
            </section>

            <section class="widget widget_archive fade-in">
                <h2 class="widget-title"><?php esc_html_e( 'Archives', 'cores-theme' ); ?></h2>
                <ul>
                    <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                </ul>
            </section>

        <?php endif; ?>

        <!-- Optional: Theme Info Widget (Always visible) -->
        <section class="widget widget_text fade-in">
            <h2 class="widget-title"><?php esc_html_e( 'About CORES', 'cores-theme' ); ?></h2>
            <div class="textwidget">
                <p><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
                <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="cta-button small-btn" style="margin-top: 1rem; display: inline-block;">
                    <?php esc_html_e( 'Learn More', 'cores-theme' ); ?>
                </a>
            </div>
        </section>

    </div><!-- .sidebar-sticky-container -->

</aside><!-- #secondary -->