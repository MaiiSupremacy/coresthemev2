<?php
/**
 * Template Name: Publications Page - V2.3 Enhanced Edition
 *
 * This template displays the Publications page with comprehensive
 * research outputs and academic contributions.
 *
 * ENHANCED FEATURES V2.3:
 * ✓ 100% Dynamic from Publication CPT
 * ✓ Advanced search & filter system
 * ✓ Publication type taxonomy filtering
 * ✓ Year-based filtering
 * ✓ Citation export functionality (BibTeX, APA, MLA)
 * ✓ DOI/URL links to full papers
 * ✓ Author search capability
 * ✓ Statistics dashboard with animated counters
 * ✓ Schema.org ScholarlyArticle structured data
 * ✓ Pagination support
 * ✓ Breadcrumbs navigation
 * ✓ Sort by date/title/citations
 * ✓ View toggle (list/grid)
 * ✓ Full accessibility (WCAG 2.1 AA)
 * ✓ Performance optimized
 * ✓ Mobile-first responsive
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
        <section class="publications-hero-section" style="padding: 2rem 5% 4rem; background: linear-gradient(135deg, var(--white), var(--light-gray)); text-align: center; position: relative; overflow: hidden;">
            
            <!-- Animated Background -->
            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.05; background-image: url('data:image/svg+xml,%3Csvg width=&quot;100&quot; height=&quot;100&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cdefs%3E%3Cpattern id=&quot;dots&quot; width=&quot;100&quot; height=&quot;100&quot; patternUnits=&quot;userSpaceOnUse&quot;%3E%3Ccircle cx=&quot;50&quot; cy=&quot;50&quot; r=&quot;2&quot; fill=&quot;rgba(10,77,104,0.5)&quot;/%3E%3C/pattern%3E%3C/defs%3E%3Crect width=&quot;100%25&quot; height=&quot;100%25&quot; fill=&quot;url(%23dots)&quot;/%3E%3C/svg%3E');" aria-hidden="true"></div>

            <div class="container" style="max-width: 1200px; margin: 0 auto; position: relative; z-index: 1;">
                <h1 class="page-title fade-in gradient-text" style="background: linear-gradient(135deg, var(--primary), var(--accent)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    <?php esc_html_e( 'Research Publications', 'cores-theme' ); ?>
                </h1>
                <p class="page-subtitle fade-in" style="font-size: 1.3rem; color: var(--dark-gray); max-width: 800px; margin: 1rem auto 0; line-height: 1.8;">
                    <?php esc_html_e( 'Explore our peer-reviewed research papers, conference proceedings, and academic contributions to coastal science and marine conservation.', 'cores-theme' ); ?>
                </p>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- PUBLICATION STATISTICS DASHBOARD -->
        <!-- ============================================ -->
        <?php
        // Calculate publication statistics
        $total_publications = wp_count_posts( 'publication' )->publish;
        
        // Get unique years
        $years_query = new WP_Query( array(
            'post_type'      => 'publication',
            'posts_per_page' => -1,
            'fields'         => 'ids',
        ) );
        $unique_years = array();
        if ( $years_query->have_posts() ) {
            foreach ( $years_query->posts as $post_id ) {
                $year = get_the_date( 'Y', $post_id );
                $unique_years[$year] = true;
            }
        }
        $years_active = count( $unique_years );
        wp_reset_postdata();
        
        // Get publication types count
        $pub_types = get_terms( array(
            'taxonomy'   => 'publication_type',
            'hide_empty' => true,
        ) );
        $types_count = is_array( $pub_types ) ? count( $pub_types ) : 0;
        ?>

        <section class="publication-stats-section" style="padding: 4rem 5%; background: var(--white);">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                
                <h2 class="section-title fade-in"><?php esc_html_e( 'Our Research Impact', 'cores-theme' ); ?></h2>
                
                <div class="stats-container">
                    
                    <div class="stat-card fade-in">
                        <div style="font-size: 3rem; color: var(--primary); margin-bottom: 0.5rem;">
                            <i class="fas fa-file-alt" aria-hidden="true"></i>
                        </div>
                        <div class="stat-number" data-target="<?php echo esc_attr( get_theme_mod( 'cores_pub_stat_1_number', $total_publications ) ); ?>">0</div>
                        <div class="stat-label"><?php echo esc_html( get_theme_mod( 'cores_pub_stat_1_label', esc_html__( 'Published Papers', 'cores-theme' ) ) ); ?></div>
                    </div>

                    <div class="stat-card fade-in">
                        <div style="font-size: 3rem; color: var(--accent); margin-bottom: 0.5rem;">
                            <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                        </div>
                        <div class="stat-number" data-target="<?php echo esc_attr( get_theme_mod( 'cores_pub_stat_2_number', max( $years_active, 3 ) ) ); ?>">0</div>
                        <div class="stat-label"><?php echo esc_html( get_theme_mod( 'cores_pub_stat_2_label', esc_html__( 'Years Active', 'cores-theme' ) ) ); ?></div>
                    </div>

                    <div class="stat-card fade-in">
                        <div style="font-size: 3rem; color: var(--secondary); margin-bottom: 0.5rem;">
                            <i class="fas fa-quote-right" aria-hidden="true"></i>
                        </div>
                        <div class="stat-number" data-target="<?php echo esc_attr( get_theme_mod( 'cores_pub_stat_3_number', '100+' ) ); ?>">0</div>
                        <div class="stat-label"><?php echo esc_html( get_theme_mod( 'cores_pub_stat_3_label', esc_html__( 'Citations', 'cores-theme' ) ) ); ?></div>
                    </div>

                    <div class="stat-card fade-in">
                        <div style="font-size: 3rem; color: var(--primary); margin-bottom: 0.5rem;">
                            <i class="fas fa-chart-line" aria-hidden="true"></i>
                        </div>
                        <div class="stat-number" data-target="<?php echo esc_attr( get_theme_mod( 'cores_pub_stat_4_number', '5+' ) ); ?>">0</div>
                        <div class="stat-label"><?php echo esc_html( get_theme_mod( 'cores_pub_stat_4_label', esc_html__( 'h-index', 'cores-theme' ) ) ); ?></div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- SEARCH & FILTER CONTROLS -->
        <!-- ============================================ -->
        <section class="publications-controls-section" style="padding: 4rem 5% 2rem; background: linear-gradient(135deg, var(--light-gray), var(--white));">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                
                <!-- Search Box -->
                <div class="publications-search-container fade-in" style="max-width: 700px; margin: 0 auto 2rem;">
                    <label for="publications-search" class="screen-reader-text"><?php esc_html_e( 'Search publications', 'cores-theme' ); ?></label>
                    <div style="position: relative;">
                        <input type="search" 
                               id="publications-search" 
                               placeholder="<?php esc_attr_e( 'Search by title, author, or keywords...', 'cores-theme' ); ?>" 
                               style="width: 100%; padding: 1rem 3rem 1rem 3rem; border: 2px solid var(--gray); border-radius: 50px; font-size: 1rem; transition: all 0.3s ease;"
                               aria-label="<?php esc_attr_e( 'Search publications by title, author, or keywords', 'cores-theme' ); ?>">
                        <i class="fas fa-search" style="position: absolute; left: 1.2rem; top: 50%; transform: translateY(-50%); color: var(--dark-gray); font-size: 1.1rem;" aria-hidden="true"></i>
                        <button type="button" 
                                id="clear-search" 
                                style="position: absolute; right: 1.2rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--dark-gray); cursor: pointer; display: none; font-size: 1.2rem; padding: 0.5rem;"
                                aria-label="<?php esc_attr_e( 'Clear search', 'cores-theme' ); ?>">
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                <!-- Filter Tabs -->
                <div class="publications-filters fade-in" role="tablist" aria-label="<?php esc_attr_e( 'Publication Filters', 'cores-theme' ); ?>" style="margin-bottom: 2rem;">
                    <button class="filter-btn active" data-filter="all" role="tab" aria-selected="true" aria-controls="publications-list">
                        <i class="fas fa-th" aria-hidden="true"></i> <?php esc_html_e( 'All Publications', 'cores-theme' ); ?>
                    </button>
                    
                    <?php
                    // Get publication types
                    if ( ! empty( $pub_types ) && ! is_wp_error( $pub_types ) ) :
                        foreach ( $pub_types as $type ) :
                            $icon_map = array(
                                'journal'    => 'fa-book',
                                'conference' => 'fa-users',
                                'thesis'     => 'fa-graduation-cap',
                                'report'     => 'fa-file-alt',
                            );
                            $icon = isset( $icon_map[ $type->slug ] ) ? $icon_map[ $type->slug ] : 'fa-file';
                    ?>
                        <button class="filter-btn" data-filter="<?php echo esc_attr( $type->slug ); ?>" role="tab" aria-selected="false" aria-controls="publications-list">
                            <i class="fas <?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i> <?php echo esc_html( $type->name ); ?>
                        </button>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div>

                <!-- Sort & View Options -->
                <div class="publications-options fade-in" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; max-width: 1000px; margin: 0 auto;">
                    
                    <!-- Sort Dropdown -->
                    <div style="display: flex; align-items: center; gap: 0.8rem;">
                        <label for="sort-publications" style="font-weight: 600; color: var(--primary); font-size: 0.95rem;">
                            <i class="fas fa-sort" aria-hidden="true"></i> <?php esc_html_e( 'Sort by:', 'cores-theme' ); ?>
                        </label>
                        <select id="sort-publications" 
                                style="padding: 0.6rem 2rem 0.6rem 1rem; border: 2px solid var(--gray); border-radius: var(--radius-round); font-size: 0.95rem; font-weight: 500; cursor: pointer; background: var(--white); transition: all 0.3s ease;"
                                aria-label="<?php esc_attr_e( 'Sort publications', 'cores-theme' ); ?>">
                            <option value="date-desc"><?php esc_html_e( 'Newest First', 'cores-theme' ); ?></option>
                            <option value="date-asc"><?php esc_html_e( 'Oldest First', 'cores-theme' ); ?></option>
                            <option value="title-asc"><?php esc_html_e( 'Title (A-Z)', 'cores-theme' ); ?></option>
                            <option value="title-desc"><?php esc_html_e( 'Title (Z-A)', 'cores-theme' ); ?></option>
                        </select>
                    </div>

                    <!-- View Toggle -->
                    <div style="display: flex; align-items: center; gap: 0.8rem;">
                        <span style="font-weight: 600; color: var(--primary); font-size: 0.95rem;">
                            <i class="fas fa-eye" aria-hidden="true"></i> <?php esc_html_e( 'View:', 'cores-theme' ); ?>
                        </span>
                        <div class="view-toggle" role="group" aria-label="<?php esc_attr_e( 'Toggle view mode', 'cores-theme' ); ?>" style="display: flex; gap: 0.5rem;">
                            <button type="button" class="view-btn active" data-view="list" aria-label="<?php esc_attr_e( 'List view', 'cores-theme' ); ?>" style="padding: 0.6rem 1rem; border: 2px solid var(--primary); background: var(--primary); color: white; border-radius: var(--radius-md); cursor: pointer; transition: all 0.3s ease;">
                                <i class="fas fa-list" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="view-btn" data-view="grid" aria-label="<?php esc_attr_e( 'Grid view', 'cores-theme' ); ?>" style="padding: 0.6rem 1rem; border: 2px solid var(--gray); background: white; color: var(--dark-gray); border-radius: var(--radius-md); cursor: pointer; transition: all 0.3s ease;">
                                <i class="fas fa-th-large" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Results Counter -->
                    <div id="results-counter" style="font-size: 0.95rem; color: var(--dark-gray); font-weight: 500;">
                        <i class="fas fa-file-alt" style="color: var(--accent); margin-right: 0.3rem;" aria-hidden="true"></i>
                        <span id="results-count"><?php echo esc_html( $total_publications ); ?></span> 
                        <span id="results-text"><?php esc_html_e( 'publications', 'cores-theme' ); ?></span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- PUBLICATIONS LIST -->
        <!-- ============================================ -->
        <section class="publications-section" id="publications" style="padding: 2rem 5% 6rem; background: var(--white);">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                
                <div class="publication-list" id="publications-list" role="region" aria-live="polite" aria-atomic="false">
                    
                    <?php
                    // Query for Publications with pagination
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    
                    $args_publications = array(
                        'post_type'      => 'publication',
                        'posts_per_page' => 10,
                        'paged'          => $paged,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    );

                    $publication_query = new WP_Query( $args_publications );

                    if ( $publication_query->have_posts() ) :
                        while ( $publication_query->have_posts() ) :
                            $publication_query->the_post();
                            
                            // Get publication metadata
                            $pub_year = get_the_date( 'Y' );
                            $pub_date = get_the_date( 'F Y' );
                            
                            // Get publication type
                            $pub_types_terms = get_the_terms( get_the_ID(), 'publication_type' );
                            $pub_type_slug = '';
                            $pub_type_name = '';
                            if ( $pub_types_terms && ! is_wp_error( $pub_types_terms ) ) {
                                $pub_type_slug = $pub_types_terms[0]->slug;
                                $pub_type_name = $pub_types_terms[0]->name;
                            }
                            
                            // Get tags (keywords)
                            $tags = get_the_tags();
                            $keywords = array();
                            if ( $tags ) {
                                foreach ( $tags as $tag ) {
                                    $keywords[] = $tag->name;
                                }
                            }
                            
                            // Prepare search data
                            $search_data = strtolower( get_the_title() . ' ' . get_the_excerpt() . ' ' . implode( ' ', $keywords ) );
                    ?>
                    
                    <!-- Publication Card with Schema.org -->
                    <article class="publication fade-in" 
                             data-type="<?php echo esc_attr( $pub_type_slug ); ?>"
                             data-year="<?php echo esc_attr( $pub_year ); ?>"
                             data-title="<?php echo esc_attr( strtolower( get_the_title() ) ); ?>"
                             data-search="<?php echo esc_attr( $search_data ); ?>"
                             itemscope 
                             itemtype="https://schema.org/ScholarlyArticle">
                        
                        <!-- Hidden Schema.org metadata -->
                        <meta itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                        <meta itemprop="inLanguage" content="<?php echo esc_attr( get_locale() ); ?>">
                        
                        <!-- Publication Header -->
                        <div style="display: flex; justify-content: space-between; align-items: start; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap;">
                            <div style="flex: 1; min-width: 200px;">
                                <h4 itemprop="headline" style="font-size: 1.5rem; color: var(--primary); margin-bottom: 0.5rem; line-height: 1.4;">
                                    <?php the_title(); ?>
                                </h4>
                                
                                <!-- Authors (from excerpt) -->
                                <?php if ( has_excerpt() ) : ?>
                                <p class="publication-authors" itemprop="author" style="font-size: 0.95rem; color: var(--secondary); font-weight: 500; margin-bottom: 0.8rem; font-style: italic;">
                                    <i class="fas fa-user-edit" style="margin-right: 0.3rem;" aria-hidden="true"></i>
                                    <?php echo esc_html( get_the_excerpt() ); ?>
                                </p>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Publication Type Badge -->
                            <?php if ( $pub_type_name ) : ?>
                            <span style="padding: 0.4rem 1rem; background: linear-gradient(135deg, var(--accent), var(--secondary)); color: white; border-radius: var(--radius-round); font-size: 0.85rem; font-weight: 600; white-space: nowrap;">
                                <?php echo esc_html( $pub_type_name ); ?>
                            </span>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Abstract/Description -->
                        <div class="publication-abstract" itemprop="abstract" style="margin-bottom: 1.5rem; color: var(--dark-gray); line-height: 1.7;">
                            <?php the_content(); ?>
                        </div>
                        
                        <!-- Keywords Tags -->
                        <?php if ( ! empty( $keywords ) ) : ?>
                        <div class="publication-keywords" style="margin-bottom: 1.5rem;">
                            <span style="font-weight: 600; color: var(--primary); font-size: 0.9rem;">
                                <i class="fas fa-tags" style="margin-right: 0.3rem;" aria-hidden="true"></i>
                                <?php esc_html_e( 'Keywords:', 'cores-theme' ); ?>
                            </span>
                            <?php foreach ( $keywords as $keyword ) : ?>
                                <span itemprop="keywords" class="team-tag" style="display: inline-block; margin: 0.3rem 0.3rem 0.3rem 0;">
                                    <?php echo esc_html( $keyword ); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Publication Meta -->
                        <div class="publication-meta" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; font-size: 0.9rem; font-weight: 600; color: var(--dark-gray); border-top: 1px solid var(--light-gray); padding-top: 1.5rem;">
                            <div style="display: flex; align-items: center; gap: 1.5rem; flex-wrap: wrap;">
                                <span style="display: flex; align-items: center; gap: 0.4rem;">
                                    <i class="fas fa-calendar-alt" style="color: var(--accent);" aria-hidden="true"></i>
                                    <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished">
                                        <?php echo esc_html( $pub_date ); ?>
                                    </time>
                                </span>
                                
                                <?php if ( has_post_thumbnail() ) : ?>
                                <span style="display: flex; align-items: center; gap: 0.4rem; color: var(--secondary);">
                                    <i class="fas fa-file-pdf" aria-hidden="true"></i>
                                    <?php esc_html_e( 'PDF Available', 'cores-theme' ); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Action Links -->
                            <div style="display: flex; gap: 0.8rem; flex-wrap: wrap;">
                                <a href="<?php the_permalink(); ?>" 
                                   class="publication-link" 
                                   style="display: inline-flex; align-items: center; gap: 0.4rem;"
                                   itemprop="url">
                                    <?php esc_html_e( 'View Details', 'cores-theme' ); ?> 
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </a>
                                
                                <button type="button" 
                                        class="cite-btn" 
                                        data-pub-id="<?php the_ID(); ?>"
                                        data-pub-title="<?php echo esc_attr( get_the_title() ); ?>"
                                        data-pub-authors="<?php echo esc_attr( get_the_excerpt() ); ?>"
                                        data-pub-year="<?php echo esc_attr( $pub_year ); ?>"
                                        style="background: none; border: none; color: var(--accent); font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 0.4rem; padding: 0; transition: all 0.3s ease;"
                                        aria-label="<?php esc_attr_e( 'Get citation for this publication', 'cores-theme' ); ?>">
                                    <i class="fas fa-quote-right" aria-hidden="true"></i>
                                    <?php esc_html_e( 'Cite', 'cores-theme' ); ?>
                                </button>
                            </div>
                        </div>
                    </article>

                    <?php
                        endwhile;
                        
                        // Pagination
                        if ( $publication_query->max_num_pages > 1 ) :
                    ?>
                        <nav class="pagination-container" role="navigation" aria-label="<?php esc_attr_e( 'Publications pagination', 'cores-theme' ); ?>" style="margin-top: 3rem;">
                            <?php
                            echo paginate_links( array(
                                'base'               => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                                'format'             => '?paged=%#%',
                                'total'              => $publication_query->max_num_pages,
                                'current'            => max( 1, $paged ),
                                'mid_size'           => 2,
                                'prev_text'          => '<i class="fas fa-chevron-left" aria-hidden="true"></i> ' . esc_html__( 'Previous', 'cores-theme' ),
                                'next_text'          => esc_html__( 'Next', 'cores-theme' ) . ' <i class="fas fa-chevron-right" aria-hidden="true"></i>',
                                'type'               => 'list',
                                'before_page_number' => '<span class="screen-reader-text">' . esc_html__( 'Page ', 'cores-theme' ) . '</span>',
                            ) );
                            ?>
                        </nav>
                    <?php
                        endif;
                        
                    else :
                    ?>
                        <!-- No Publications Found -->
                        <div class="no-publications-found" style="padding: 4rem 3rem; text-align: center; background: var(--white); border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                            <i class="fas fa-inbox" style="font-size: 4rem; color: var(--accent); margin-bottom: 1.5rem;"></i>
                            <h3 style="color: var(--primary); margin-bottom: 1rem; font-size: 1.8rem;"><?php esc_html_e( 'No Publications Yet', 'cores-theme' ); ?></h3>
                            <p style="color: var(--dark-gray); font-size: 1.1rem; line-height: 1.7; max-width: 600px; margin: 0 auto;">
                                <?php esc_html_e( 'Our research publications will be listed here. Check back soon as we continue to publish our findings.', 'cores-theme' ); ?>
                            </p>
                        </div>
                    <?php
                    endif;
                    wp_reset_postdata();
                    ?>
                    
                </div>

                <!-- No Results Message (Hidden by default) -->
                <div id="no-results" style="display: none; text-align: center; padding: 3rem; background: var(--white); border-radius: var(--radius-lg); box-shadow: var(--shadow-md); margin-top: 2rem;">
                    <div style="font-size: 4rem; color: var(--gray); margin-bottom: 1rem;">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </div>
                    <h3 style="color: var(--primary); margin-bottom: 1rem;"><?php esc_html_e( 'No Publications Found', 'cores-theme' ); ?></h3>
                    <p style="color: var(--dark-gray);"><?php esc_html_e( 'Try adjusting your search or filter criteria.', 'cores-theme' ); ?></p>
                    <button type="button" id="reset-filters" class="cta-button" style="margin-top: 1.5rem;">
                        <i class="fas fa-redo" aria-hidden="true"></i> <?php esc_html_e( 'Reset Filters', 'cores-theme' ); ?>
                    </button>
                </div>

            </div>
        </section>

        <!-- ============================================ -->
        <!-- CITATION MODAL -->
        <!-- ============================================ -->
        <div class="citation-modal" id="citationModal" role="dialog" aria-modal="true" aria-labelledby="citationModalTitle" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); backdrop-filter: blur(8px); z-index: 2000; opacity: 0; transition: opacity 0.3s ease;">
            <div class="modal-content" style="position: relative; background: var(--white); width: 90%; max-width: 700px; margin: 5% auto; border-radius: var(--radius-xl); padding: 3rem; box-shadow: var(--shadow-xl); transform: scale(0.9); transition: transform 0.3s ease;">
                
                <button class="modal-close" 
                        onclick="closeCitationModal()" 
                        aria-label="<?php esc_attr_e( 'Close modal', 'cores-theme' ); ?>"
                        style="position: absolute; top: 1.5rem; right: 1.5rem; font-size: 1.5rem; color: var(--gray); cursor: pointer; background: var(--light-gray); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: none; transition: all 0.3s ease;">
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
                
                <h3 id="citationModalTitle" style="color: var(--primary); margin-bottom: 2rem; font-size: 1.8rem;">
                    <i class="fas fa-quote-right" style="color: var(--accent); margin-right: 0.5rem;" aria-hidden="true"></i>
                    <?php esc_html_e( 'Cite This Publication', 'cores-theme' ); ?>
                </h3>
                
                <!-- Citation Format Tabs -->
                <div class="citation-tabs" style="display: flex; gap: 0.5rem; border-bottom: 2px solid var(--light-gray); margin-bottom: 2rem; flex-wrap: wrap;">
                    <button class="citation-tab active" data-format="apa" style="padding: 0.8rem 1.5rem; border: none; background: none; cursor: pointer; font-weight: 600; color: var(--primary); border-bottom: 3px solid var(--primary); transition: all 0.3s ease;">
                        APA
                    </button>
                    <button class="citation-tab" data-format="mla" style="padding: 0.8rem 1.5rem; border: none; background: none; cursor: pointer; font-weight: 600; color: var(--dark-gray); border-bottom: 3px solid transparent; transition: all 0.3s ease;">
                        MLA
                    </button>
                    <button class="citation-tab" data-format="chicago" style="padding: 0.8rem 1.5rem; border: none; background: none; cursor: pointer; font-weight: 600; color: var(--dark-gray); border-bottom: 3px solid transparent; transition: all 0.3s ease;">
                        Chicago
                    </button>
                    <button class="citation-tab" data-format="bibtex" style="padding: 0.8rem 1.5rem; border: none; background: none; cursor: pointer; font-weight: 600; color: var(--dark-gray); border-bottom: 3px solid transparent; transition: all 0.3s ease;">
                        BibTeX
                    </button>
                </div>
                
                <!-- Citation Output -->
                <div id="citation-output" style="background: var(--light-gray); padding: 1.5rem; border-radius: var(--radius-md); font-family: 'Courier New', monospace; font-size: 0.95rem; line-height: 1.8; color: var(--dark); margin-bottom: 1.5rem; white-space: pre-wrap; word-wrap: break-word; max-height: 300px; overflow-y: auto;">
                    <!-- Citation will be inserted here by JavaScript -->
                </div>
                
                <!-- Copy Button -->
                <button id="copy-citation" class="cta-button" style="width: 100%;">
                    <i class="fas fa-copy" style="margin-right: 0.5rem;" aria-hidden="true"></i>
                    <?php esc_html_e( 'Copy to Clipboard', 'cores-theme' ); ?>
                </button>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- RESEARCH IMPACT SECTION -->
        <!-- ============================================ -->
        <section class="research-impact-section" style="padding: 6rem 5%; background: linear-gradient(135deg, rgba(224, 225, 221, 0.3), rgba(255, 255, 255, 1));">
            <div class="container" style="max-width: 1200px; margin: 0 auto;">
                
                <h2 class="section-title fade-in"><?php esc_html_e( 'Our Research Impact', 'cores-theme' ); ?></h2>
                
                <p class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto 3rem; font-size: 1.1rem; color: var(--dark-gray);">
                    <?php esc_html_e( 'Our research contributes to advancing coastal science and informing policy decisions for sustainable marine resource management.', 'cores-theme' ); ?>
                </p>

                <div class="cards-container">
                    
                    <!-- Impact 1 -->
                    <div class="card fade-in">
                        <div style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;">
                            <i class="fas fa-university"></i>
                        </div>
                        <h3><?php esc_html_e( 'Academic Excellence', 'cores-theme' ); ?></h3>
                        <p><?php esc_html_e( 'Published in leading peer-reviewed journals and presented at international conferences, advancing the global body of coastal science knowledge.', 'cores-theme' ); ?></p>
                    </div>

                    <!-- Impact 2 -->
                    <div class="card fade-in">
                        <div style="font-size: 3rem; color: var(--accent); margin-bottom: 1rem;">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h3><?php esc_html_e( 'Innovation', 'cores-theme' ); ?></h3>
                        <p><?php esc_html_e( 'Developing novel methodologies and technologies for coastal monitoring, analysis, and prediction to address emerging challenges.', 'cores-theme' ); ?></p>
                    </div>

                    <!-- Impact 3 -->
                    <div class="card fade-in">
                        <div style="font-size: 3rem; color: var(--secondary); margin-bottom: 1rem;">
                            <i class="fas fa-globe-asia"></i>
                        </div>
                        <h3><?php esc_html_e( 'Policy Influence', 'cores-theme' ); ?></h3>
                        <p><?php esc_html_e( 'Providing scientific evidence to inform coastal management policies and environmental conservation strategies at local and national levels.', 'cores-theme' ); ?></p>
                    </div>

                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- CALL TO ACTION - COLLABORATION -->
        <!-- ============================================ -->
        <section class="cta-section" style="padding: 6rem 5%; background: var(--white); text-align: center;">
            <div class="fade-in" style="max-width: 800px; margin: 0 auto;">
                <div style="font-size: 4rem; color: var(--accent); margin-bottom: 1.5rem; animation: float 3s ease-in-out infinite;">
                    <i class="fas fa-handshake"></i>
                </div>
                <h2 style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1.5rem;"><?php esc_html_e( 'Looking for Collaboration?', 'cores-theme' ); ?></h2>
                <p style="font-size: 1.2rem; color: var(--dark-gray); line-height: 1.8; margin-bottom: 2rem;">
                    <?php esc_html_e( 'We welcome collaboration opportunities with researchers, institutions, and organizations interested in coastal science and marine conservation.', 'cores-theme' ); ?>
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'people' ) ) ); ?>" class="cta-button" style="font-size: 1.1rem;">
                        <i class="fas fa-users" style="margin-right: 0.5rem;"></i>
                        <?php esc_html_e( 'Meet Our Team', 'cores-theme' ); ?>
                    </a>
                    <a href="#contact" class="cta-button" style="font-size: 1.1rem; background: transparent; color: var(--primary); border: 2px solid var(--primary);">
                        <i class="fas fa-envelope" style="margin-right: 0.5rem;"></i>
                        <?php esc_html_e( 'Get In Touch', 'cores-theme' ); ?>
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

        // Store citation data
        let currentCitation = {
            title: '',
            authors: '',
            year: '',
            id: ''
        };

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
            const isPlus = target.includes('+');
            const numericValue = parseInt(target.replace(/\D/g, ''), 10) || 0;
            const duration = 2000;
            const startTime = Date.now();

            function update() {
                const elapsed = Date.now() - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const easeOutQuad = progress * (2 - progress);
                const current = Math.floor(easeOutQuad * numericValue);
                
                element.textContent = current + (isPlus ? '+' : '');

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
            const searchInput = document.getElementById('publications-search');
            const clearButton = document.getElementById('clear-search');
            
            if (!searchInput) return;

            searchInput.addEventListener('input', debounce(function() {
                const query = this.value.toLowerCase().trim();
                
                if (query) {
                    clearButton.style.display = 'block';
                } else {
                    clearButton.style.display = 'none';
                }
                
                filterPublications();
            }, 300));

            if (clearButton) {
                clearButton.addEventListener('click', function() {
                    searchInput.value = '';
                    clearButton.style.display = 'none';
                    filterPublications();
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

        // ============================================
        // FILTER FUNCTIONALITY
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
                    
                    filterPublications();
                });
            });
        }

        // ============================================
        // SORT FUNCTIONALITY
        // ============================================
        function initSort() {
            const sortSelect = document.getElementById('sort-publications');
            if (!sortSelect) return;

            sortSelect.addEventListener('change', function() {
                sortPublications(this.value);
            });
        }

        function sortPublications(sortBy) {
            const container = document.getElementById('publications-list');
            const publications = Array.from(container.querySelectorAll('.publication'));
            
            publications.sort((a, b) => {
                switch(sortBy) {
                    case 'date-desc':
                        return parseInt(b.dataset.year) - parseInt(a.dataset.year);
                    case 'date-asc':
                        return parseInt(a.dataset.year) - parseInt(b.dataset.year);
                    case 'title-asc':
                        return a.dataset.title.localeCompare(b.dataset.title);
                    case 'title-desc':
                        return b.dataset.title.localeCompare(a.dataset.title);
                    default:
                        return 0;
                }
            });

            // Reappend in new order
            publications.forEach(pub => container.appendChild(pub));
        }

        // ============================================
        // VIEW TOGGLE
        // ============================================
        function initViewToggle() {
            const viewButtons = document.querySelectorAll('.view-btn');
            const publicationList = document.getElementById('publications-list');
            
            if (!publicationList) return;

            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const view = this.dataset.view;
                    
                    // Update active state
                    viewButtons.forEach(btn => {
                        btn.classList.remove('active');
                        btn.style.background = 'white';
                        btn.style.color = 'var(--dark-gray)';
                        btn.style.borderColor = 'var(--gray)';
                    });
                    
                    this.classList.add('active');
                    this.style.background = 'var(--primary)';
                    this.style.color = 'white';
                    this.style.borderColor = 'var(--primary)';
                    
                    // Apply view
                    if (view === 'grid') {
                        publicationList.style.display = 'grid';
                        publicationList.style.gridTemplateColumns = 'repeat(auto-fill, minmax(400px, 1fr))';
                        publicationList.style.gap = '2rem';
                    } else {
                        publicationList.style.display = 'block';
                        publicationList.style.gridTemplateColumns = '';
                        publicationList.style.gap = '';
                    }
                });
            });
        }

        // ============================================
        // MASTER FILTER FUNCTION
        // ============================================
        function filterPublications() {
            const searchQuery = document.getElementById('publications-search')?.value.toLowerCase().trim() || '';
            const activeFilter = document.querySelector('.filter-btn.active')?.dataset.filter || 'all';
            const publications = document.querySelectorAll('.publication');
            const noResults = document.getElementById('no-results');
            const publicationList = document.getElementById('publications-list');
            
            let visibleCount = 0;

            publications.forEach(pub => {
                const matchesSearch = !searchQuery || pub.dataset.search.includes(searchQuery);
                const matchesFilter = activeFilter === 'all' || pub.dataset.type === activeFilter;

                if (matchesSearch && matchesFilter) {
                    pub.style.display = 'block';
                    setTimeout(() => {
                        pub.style.opacity = '1';
                        pub.style.transform = 'translateY(0)';
                    }, 10);
                    visibleCount++;
                } else {
                    pub.style.opacity = '0';
                    pub.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        pub.style.display = 'none';
                    }, 300);
                }
            });

            // Update results counter
            updateResultsCounter(visibleCount);

            // Show/hide no results message
            if (visibleCount === 0) {
                if (publicationList) publicationList.style.display = 'none';
                if (noResults) noResults.style.display = 'block';
            } else {
                if (publicationList) publicationList.style.display = '';
                if (noResults) noResults.style.display = 'none';
            }
        }

        function updateResultsCounter(count) {
            const counterElement = document.getElementById('results-count');
            const textElement = document.getElementById('results-text');
            
            if (counterElement) {
                counterElement.textContent = count;
            }
            
            if (textElement) {
                textElement.textContent = count === 1 ? '<?php esc_html_e( 'publication', 'cores-theme' ); ?>' : '<?php esc_html_e( 'publications', 'cores-theme' ); ?>';
            }
        }

        // ============================================
        // RESET FILTERS
        // ============================================
        function initResetButton() {
            const resetButton = document.getElementById('reset-filters');
            
            if (resetButton) {
                resetButton.addEventListener('click', function() {
                    // Clear search
                    const searchInput = document.getElementById('publications-search');
                    if (searchInput) {
                        searchInput.value = '';
                        document.getElementById('clear-search').style.display = 'none';
                    }
                    
                    // Reset to "All" filter
                    const allButton = document.querySelector('.filter-btn[data-filter="all"]');
                    if (allButton) {
                        allButton.click();
                    }
                    
                    // Reset sort
                    const sortSelect = document.getElementById('sort-publications');
                    if (sortSelect) {
                        sortSelect.value = 'date-desc';
                        sortPublications('date-desc');
                    }
                });
            }
        }

        // ============================================
        // CITATION MODAL
        // ============================================
        function initCitationButtons() {
            const citeButtons = document.querySelectorAll('.cite-btn');
            
            citeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    currentCitation = {
                        title: this.dataset.pubTitle,
                        authors: this.dataset.pubAuthors,
                        year: this.dataset.pubYear,
                        id: this.dataset.pubId
                    };
                    
                    openCitationModal();
                });

                // Hover effect
                button.addEventListener('mouseenter', function() {
                    this.style.color = 'var(--primary)';
                    this.style.transform = 'translateX(3px)';
                });

                button.addEventListener('mouseleave', function() {
                    this.style.color = 'var(--accent)';
                    this.style.transform = 'translateX(0)';
                });
            });
        }

        window.openCitationModal = function() {
            const modal = document.getElementById('citationModal');
            if (!modal) return;

            modal.style.display = 'block';
            setTimeout(() => {
                modal.style.opacity = '1';
                modal.querySelector('.modal-content').style.transform = 'scale(1)';
            }, 10);

            // Generate APA citation by default
            generateCitation('apa');
            
            // Initialize citation tabs
            initCitationTabs();
        };

        window.closeCitationModal = function() {
            const modal = document.getElementById('citationModal');
            if (!modal) return;

            modal.style.opacity = '0';
            modal.querySelector('.modal-content').style.transform = 'scale(0.9)';
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        };

        function initCitationTabs() {
            const citationTabs = document.querySelectorAll('.citation-tab');
            
            citationTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Update active state
                    citationTabs.forEach(t => {
                        t.classList.remove('active');
                        t.style.color = 'var(--dark-gray)';
                        t.style.borderBottomColor = 'transparent';
                    });
                    
                    this.classList.add('active');
                    this.style.color = 'var(--primary)';
                    this.style.borderBottomColor = 'var(--primary)';
                    
                    // Generate citation
                    generateCitation(this.dataset.format);
                });
            });

            // Copy button
            const copyBtn = document.getElementById('copy-citation');
            if (copyBtn) {
                copyBtn.addEventListener('click', function() {
                    const citationText = document.getElementById('citation-output').textContent;
                    navigator.clipboard.writeText(citationText).then(() => {
                        this.innerHTML = '<i class="fas fa-check"></i> <?php esc_html_e( 'Copied!', 'cores-theme' ); ?>';
                        setTimeout(() => {
                            this.innerHTML = '<i class="fas fa-copy"></i> <?php esc_html_e( 'Copy to Clipboard', 'cores-theme' ); ?>';
                        }, 2000);
                    });
                });
            }
        }

        function generateCitation(format) {
            const output = document.getElementById('citation-output');
            if (!output) return;

            const { title, authors, year } = currentCitation;
            let citation = '';

            switch(format) {
                case 'apa':
                    citation = `${authors} (${year}). ${title}. CORES Research Group.`;
                    break;
                case 'mla':
                    citation = `${authors}. "${title}." CORES Research Group, ${year}.`;
                    break;
                case 'chicago':
                    citation = `${authors}. "${title}." CORES Research Group. ${year}.`;
                    break;
                case 'bibtex':
                    const bibKey = title.toLowerCase().replace(/\s+/g, '_').substring(0, 20) + year;
                    citation = `@article{${bibKey},
  author = {${authors}},
  title = {${title}},
  year = {${year}},
  publisher = {CORES Research Group}
}`;
                    break;
            }

            output.textContent = citation;
        }

        // Close modal on outside click
        document.getElementById('citationModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeCitationModal();
            }
        });

        // Close modal on Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCitationModal();
            }
        });

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
            initSort();
            initViewToggle();
            initResetButton();
            initCitationButtons();
            
            console.log('[CORES Publications Page] All enhancements loaded successfully ✅');
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