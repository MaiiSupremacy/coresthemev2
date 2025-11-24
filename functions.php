<?php
/**
 * CORES Theme V2 - Enhanced Functions and Definitions
 *
 * This file contains all the theme setup, custom post types, widgets,
 * and functionality enhancements following WordPress 2024-2025 best practices.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CORES_Theme
 * @version 2.3.0
 * @since 2.0.0
 */

// Exit if accessed directly - Security best practice
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ============================================
// THEME CONSTANTS - Performance Optimization
// ============================================
define( 'CORES_VERSION', wp_get_theme()->get( 'Version' ) );
define( 'CORES_THEME_DIR', get_template_directory() );
define( 'CORES_THEME_URI', get_template_directory_uri() );

// ============================================
// THEME SETUP
// ============================================
function cores_theme_setup() {
	
	load_theme_textdomain( 'cores-theme', CORES_THEME_DIR . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	
	add_image_size( 'cores-hero', 1920, 1080, true );
	add_image_size( 'cores-card', 800, 600, true );
	add_image_size( 'cores-thumbnail', 400, 300, true );
	
	register_nav_menus(
		array(
			'primary-menu' => esc_html__( 'Primary Menu', 'cores-theme' ),
			'footer-menu'  => esc_html__( 'Footer Menu', 'cores-theme' ),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
	
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 400,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
	
	// Gutenberg Support
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'custom-line-height' );
	add_theme_support( 'custom-spacing' );
	add_theme_support( 'custom-units', 'px', 'em', 'rem', 'vh', 'vw', '%' );
	
	add_theme_support(
		'editor-color-palette',
		array(
			array( 'name' => esc_html__( 'Primary', 'cores-theme' ), 'slug' => 'primary', 'color' => '#0A4D68' ),
			array( 'name' => esc_html__( 'Accent', 'cores-theme' ), 'slug' => 'accent', 'color' => '#05BFDB' ),
			array( 'name' => esc_html__( 'Secondary', 'cores-theme' ), 'slug' => 'secondary', 'color' => '#088395' ),
			array( 'name' => esc_html__( 'Dark', 'cores-theme' ), 'slug' => 'dark', 'color' => '#333333' ),
			array( 'name' => esc_html__( 'Light', 'cores-theme' ), 'slug' => 'light', 'color' => '#F5F5F5' ),
			array( 'name' => esc_html__( 'White', 'cores-theme' ), 'slug' => 'white', 'color' => '#FFFFFF' ),
		)
	);
	
	add_theme_support( 'disable-custom-colors' );
	
	add_theme_support(
		'editor-font-sizes',
		array(
			array( 'name' => esc_html__( 'Small', 'cores-theme' ), 'size' => 14, 'slug' => 'small' ),
			array( 'name' => esc_html__( 'Normal', 'cores-theme' ), 'size' => 16, 'slug' => 'normal' ),
			array( 'name' => esc_html__( 'Medium', 'cores-theme' ), 'size' => 20, 'slug' => 'medium' ),
			array( 'name' => esc_html__( 'Large', 'cores-theme' ), 'size' => 28, 'slug' => 'large' ),
			array( 'name' => esc_html__( 'Huge', 'cores-theme' ), 'size' => 36, 'slug' => 'huge' ),
		)
	);
	
	add_theme_support( 'disable-custom-font-sizes' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor-style.css' );
}
add_action( 'after_setup_theme', 'cores_theme_setup' );

// ============================================
// CONTENT WIDTH
// ============================================
function cores_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cores_content_width', 1200 );
}
add_action( 'after_setup_theme', 'cores_content_width', 0 );

// ============================================
// ENQUEUE SCRIPTS AND STYLES
// ============================================
function cores_enqueue_assets() {
	
	// Google Fonts
	wp_enqueue_style(
		'cores-google-fonts',
		'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap',
		array(),
		null
	);

	// Font Awesome
	wp_enqueue_style(
		'font-awesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
		array(),
		'6.4.0'
	);

	// Leaflet CSS (conditional)
	if ( is_page_template( 'page-research.php' ) ) {
		wp_enqueue_style( 'leaflet-css', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', array(), '1.9.4' );
	}
	
	// Swiper.js CSS (conditional)
	if ( is_page_template( 'page-research.php' ) ) {
		wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0' );
	}

	// Main Theme Stylesheet
	wp_enqueue_style( 'cores-style', get_stylesheet_uri(), array(), CORES_VERSION );

	// Leaflet JS (conditional)
	if ( is_page_template( 'page-research.php' ) ) {
		wp_enqueue_script( 'leaflet-js', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', array(), '1.9.4', true );
	}
	
	// Swiper.js (conditional)
	if ( is_page_template( 'page-research.php' ) ) {
		wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true );
	}

	// Main Theme JavaScript
	wp_enqueue_script( 'cores-main-js', CORES_THEME_URI . '/js/main.js', array(), CORES_VERSION, true );

	// Dynamic Team Modal Data
	if ( is_page_template( 'page-people.php' ) ) {
		
		$team_data_for_js = array();
		$team_query = new WP_Query(
			array(
				'post_type'      => 'team_member',
				'posts_per_page' => -1,
			)
		);

		if ( $team_query->have_posts() ) {
			while ( $team_query->have_posts() ) {
				$team_query->the_post();
				$post_slug = $post->post_name;
				$tags = get_the_tags();
				$expertise_list = array();
				if ( $tags ) {
					foreach ( $tags as $tag ) {
						$expertise_list[] = $tag->name;
					}
				}
				
				$team_data_for_js[ $post_slug ] = array(
					'name'         => get_the_title(),
					'title'        => get_the_excerpt(),
					'bio'          => apply_filters( 'the_content', get_the_content() ),
					'expertise'    => $expertise_list,
					'publications' => get_post_meta( get_the_ID(), '_team_publications', true ),
					'email'        => get_post_meta( get_the_ID(), '_team_email', true ),
				);
			}
		}
		wp_reset_postdata();

		wp_localize_script( 'cores-main-js', 'coresTeamData', $team_data_for_js );
	}

	// AJAX Contact Form Data
	wp_localize_script(
		'cores-main-js',
		'cores_ajax_object',
		array(
			'ajax_url'      => admin_url( 'admin-ajax.php' ),
			'contact_nonce' => wp_create_nonce( 'cores_contact_form_nonce' ),
			'sending'       => esc_html__( 'Sending...', 'cores-theme' ),
			'success'       => esc_html__( 'Message Sent Successfully!', 'cores-theme' ),
			'success_msg'   => esc_html__( 'Thank you for contacting us. We will get back to you soon.', 'cores-theme' ),
			'error'         => esc_html__( 'An Error Occurred', 'cores-theme' ),
			'error_msg'     => esc_html__( 'Please try again later.', 'cores-theme' ),
		)
	);
	
	// Comment reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cores_enqueue_assets' );

// ============================================
// NAVIGATION MENU FALLBACK
// ============================================
function cores_menu_fallback( $args ) {
	echo '<ul class="cores-menu-fallback">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'cores-theme' ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/about/' ) ) . '">' . esc_html__( 'About', 'cores-theme' ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/people/' ) ) . '">' . esc_html__( 'People', 'cores-theme' ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/research/' ) ) . '">' . esc_html__( 'Research', 'cores-theme' ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/publications/' ) ) . '">' . esc_html__( 'Publications', 'cores-theme' ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/supervision/' ) ) . '">' . esc_html__( 'Supervision', 'cores-theme' ) . '</a></li>';
	echo '</ul>';
}

// ============================================
// WIDGET AREAS
// ============================================
function cores_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Main Sidebar', 'cores-theme' ),
			'id'            => 'main-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'cores-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widget Area', 'cores-theme' ),
			'id'            => 'footer-widget-area',
			'description'   => esc_html__( 'Add widgets here to appear in the footer. Recommended: Categories, Archives, or a Custom Menu.', 'cores-theme' ),
			'before_widget' => '<li id="%1$s" class="widget footer-widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'cores_widgets_init' );

// ============================================
// INCLUDE CUSTOMIZER
// ============================================
require CORES_THEME_DIR . '/inc/customizer.php';

// ============================================
// CUSTOM POST TYPE: TEAM
// ============================================
function cores_register_team_cpt_and_tax() {

    $labels_cpt = array(
        'name'                  => _x( 'Team', 'Post Type General Name', 'cores-theme' ),
        'singular_name'         => _x( 'Team Member', 'Post Type Singular Name', 'cores-theme' ),
        'menu_name'             => __( 'Team', 'cores-theme' ),
        'name_admin_bar'        => __( 'Team Member', 'cores-theme' ),
        'archives'              => __( 'Team Archives', 'cores-theme' ),
        'attributes'            => __( 'Team Member Attributes', 'cores-theme' ),
        'parent_item_colon'     => __( 'Parent Member:', 'cores-theme' ),
        'all_items'             => __( 'All Team Members', 'cores-theme' ),
        'add_new_item'          => __( 'Add New Team Member', 'cores-theme' ),
        'add_new'               => __( 'Add New', 'cores-theme' ),
        'new_item'              => __( 'New Team Member', 'cores-theme' ),
        'edit_item'             => __( 'Edit Team Member', 'cores-theme' ),
        'update_item'           => __( 'Update Team Member', 'cores-theme' ),
        'view_item'             => __( 'View Team Member', 'cores-theme' ),
        'view_items'            => __( 'View Team', 'cores-theme' ),
        'search_items'          => __( 'Search Team Member', 'cores-theme' ),
        'not_found'             => __( 'Not found', 'cores-theme' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'cores-theme' ),
        'featured_image'        => __( 'Profile Picture', 'cores-theme' ),
        'set_featured_image'    => __( 'Set profile picture', 'cores-theme' ),
        'remove_featured_image' => __( 'Remove profile picture', 'cores-theme' ),
        'use_featured_image'    => __( 'Use as profile picture', 'cores-theme' ),
        'insert_into_item'      => __( 'Insert into member', 'cores-theme' ),
        'uploaded_to_this_item' => __( 'Uploaded to this member', 'cores-theme' ),
        'items_list'            => __( 'Team list', 'cores-theme' ),
        'items_list_navigation' => __( 'Team list navigation', 'cores-theme' ),
        'filter_items_list'     => __( 'Filter team list', 'cores-theme' ),
    );
    $args_cpt = array(
        'label'                 => __( 'Team Member', 'cores-theme' ),
        'description'           => __( 'Post type for CORES team members', 'cores-theme' ),
        'labels'                => $labels_cpt,
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'tags' ),
        'taxonomies'            => array( 'team_role', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-groups',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'team_member', $args_cpt );

    $labels_tax = array(
        'name'                       => _x( 'Team Roles', 'Taxonomy General Name', 'cores-theme' ),
        'singular_name'              => _x( 'Team Role', 'Taxonomy Singular Name', 'cores-theme' ),
        'menu_name'                  => __( 'Team Roles', 'cores-theme' ),
        'all_items'                  => __( 'All Roles', 'cores-theme' ),
        'parent_item'                => __( 'Parent Role', 'cores-theme' ),
        'parent_item_colon'          => __( 'Parent Role:', 'cores-theme' ),
        'new_item_name'              => __( 'New Role Name', 'cores-theme' ),
        'add_new_item'               => __( 'Add New Role', 'cores-theme' ),
        'edit_item'                  => __( 'Edit Role', 'cores-theme' ),
        'update_item'                => __( 'Update Role', 'cores-theme' ),
        'view_item'                  => __( 'View Role', 'cores-theme' ),
        'separate_items_with_commas' => __( 'Separate roles with commas', 'cores-theme' ),
        'add_or_remove_items'        => __( 'Add or remove roles', 'cores-theme' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'cores-theme' ),
        'popular_items'              => __( 'Popular Roles', 'cores-theme' ),
        'search_items'               => __( 'Search Roles', 'cores-theme' ),
        'not_found'                  => __( 'Not Found', 'cores-theme' ),
        'no_terms'                   => __( 'No roles', 'cores-theme' ),
        'items_list'                 => __( 'Roles list', 'cores-theme' ),
        'items_list_navigation'      => __( 'Roles list navigation', 'cores-theme' ),
    );
    $args_tax = array(
        'labels'                     => $labels_tax,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
    );
    register_taxonomy( 'team_role', array( 'team_member' ), $args_tax );

}
add_action( 'init', 'cores_register_team_cpt_and_tax', 0 );

// ============================================
// CUSTOM POST TYPE: MILESTONE
// ============================================
function cores_register_milestone_cpt() {
    $labels = array(
        'name'                  => _x( 'Milestones', 'Post Type General Name', 'cores-theme' ),
        'singular_name'         => _x( 'Milestone', 'Post Type Singular Name', 'cores-theme' ),
        'menu_name'             => __( 'Milestones', 'cores-theme' ),
        'name_admin_bar'        => __( 'Milestone', 'cores-theme' ),
        'archives'              => __( 'Milestone Archives', 'cores-theme' ),
        'attributes'            => __( 'Milestone Attributes', 'cores-theme' ),
        'parent_item_colon'     => __( 'Parent Milestone:', 'cores-theme' ),
        'all_items'             => __( 'All Milestones', 'cores-theme' ),
        'add_new_item'          => __( 'Add New Milestone', 'cores-theme' ),
        'add_new'               => __( 'Add New', 'cores-theme' ),
        'new_item'              => __( 'New Milestone', 'cores-theme' ),
        'edit_item'             => __( 'Edit Milestone', 'cores-theme' ),
        'update_item'           => __( 'Update Milestone', 'cores-theme' ),
        'view_item'             => __( 'View Milestone', 'cores-theme' ),
        'view_items'            => __( 'View Milestones', 'cores-theme' ),
        'search_items'          => __( 'Search Milestone', 'cores-theme' ),
        'not_found'             => __( 'Not found', 'cores-theme' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'cores-theme' ),
        'featured_image'        => __( 'Featured Image', 'cores-theme' ),
        'set_featured_image'    => __( 'Set featured image', 'cores-theme' ),
        'remove_featured_image' => __( 'Remove featured image', 'cores-theme' ),
        'use_featured_image'    => __( 'Use as featured image', 'cores-theme' ),
        'insert_into_item'      => __( 'Insert into milestone', 'cores-theme' ),
        'uploaded_to_this_item' => __( 'Uploaded to this milestone', 'cores-theme' ),
        'items_list'            => __( 'Milestones list', 'cores-theme' ),
        'items_list_navigation' => __( 'Milestones list navigation', 'cores-theme' ),
        'filter_items_list'     => __( 'Filter milestones list', 'cores-theme' ),
    );
    $args = array(
        'label'                 => __( 'Milestone', 'cores-theme' ),
        'description'           => __( 'Research milestones for the timeline', 'cores-theme' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 21,
        'menu_icon'             => 'dashicons-flag',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'milestone', $args );
}
add_action( 'init', 'cores_register_milestone_cpt', 0 );

// ============================================
// CUSTOM POST TYPE: PUBLICATION
// ============================================
function cores_register_publication_cpt() {
    
    $labels_tax = array(
        'name'                       => _x( 'Publication Types', 'Taxonomy General Name', 'cores-theme' ),
        'singular_name'              => _x( 'Publication Type', 'Taxonomy Singular Name', 'cores-theme' ),
        'menu_name'                  => __( 'Publication Types', 'cores-theme' ),
        'all_items'                  => __( 'All Types', 'cores-theme' ),
        'new_item_name'              => __( 'New Type Name', 'cores-theme' ),
        'add_new_item'               => __( 'Add New Type', 'cores-theme' ),
        'edit_item'                  => __( 'Edit Type', 'cores-theme' ),
        'update_item'                => __( 'Update Type', 'cores-theme' ),
        'view_item'                  => __( 'View Type', 'cores-theme' ),
        'search_items'               => __( 'Search Types', 'cores-theme' ),
        'not_found'                  => __( 'Not Found', 'cores-theme' ),
    );
    $args_tax = array(
        'labels'                     => $labels_tax,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
    );
    register_taxonomy( 'publication_type', array( 'publication' ), $args_tax );

    $labels_cpt = array(
        'name'                  => _x( 'Publications', 'Post Type General Name', 'cores-theme' ),
        'singular_name'         => _x( 'Publication', 'Post Type Singular Name', 'cores-theme' ),
        'menu_name'             => __( 'Publications', 'cores-theme' ),
        'name_admin_bar'        => __( 'Publication', 'cores-theme' ),
        'archives'              => __( 'Publication Archives', 'cores-theme' ),
        'all_items'             => __( 'All Publications', 'cores-theme' ),
        'add_new_item'          => __( 'Add New Publication', 'cores-theme' ),
        'add_new'               => __( 'Add New', 'cores-theme' ),
        'new_item'              => __( 'New Publication', 'cores-theme' ),
        'edit_item'             => __( 'Edit Publication', 'cores-theme' ),
        'update_item'           => __( 'Update Publication', 'cores-theme' ),
        'search_items'          => __( 'Search Publications', 'cores-theme' ),
        'not_found'             => __( 'Not found', 'cores-theme' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'cores-theme' ),
    );
    $args_cpt = array(
        'label'                 => __( 'Publication', 'cores-theme' ),
        'description'           => __( 'Research publications, journal articles, and conference papers.', 'cores-theme' ),
        'labels'                => $labels_cpt,
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'tags' ),
        'taxonomies'            => array( 'publication_type', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 22,
        'menu_icon'             => 'dashicons-media-document',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'publication', $args_cpt );
}
add_action( 'init', 'cores_register_publication_cpt', 0 );

// ============================================
// CUSTOM POST TYPE: STUDENT PROJECT
// ============================================
function cores_register_project_cpt() {

    $labels_tax = array(
        'name'                       => _x( 'Project Statuses', 'Taxonomy General Name', 'cores-theme' ),
        'singular_name'              => _x( 'Project Status', 'Taxonomy Singular Name', 'cores-theme' ),
        'menu_name'                  => __( 'Project Statuses', 'cores-theme' ),
        'all_items'                  => __( 'All Statuses', 'cores-theme' ),
        'new_item_name'              => __( 'New Status Name', 'cores-theme' ),
        'add_new_item'               => __( 'Add New Status', 'cores-theme' ),
        'edit_item'                  => __( 'Edit Status', 'cores-theme' ),
    );
    $args_tax = array(
        'labels'                     => $labels_tax,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => false,
        'show_tagcloud'              => false,
    );
    register_taxonomy( 'project_status', array( 'student_project' ), $args_tax );

    $labels_cpt = array(
        'name'                  => _x( 'Student Projects', 'Post Type General Name', 'cores-theme' ),
        'singular_name'         => _x( 'Student Project', 'Post Type Singular Name', 'cores-theme' ),
        'menu_name'             => __( 'Student Projects', 'cores-theme' ),
        'name_admin_bar'        => __( 'Student Project', 'cores-theme' ),
        'all_items'             => __( 'All Projects', 'cores-theme' ),
        'add_new_item'          => __( 'Add New Project', 'cores-theme' ),
        'add_new'               => __( 'Add New', 'cores-theme' ),
        'new_item'              => __( 'New Project', 'cores-theme' ),
        'edit_item'             => __( 'Edit Project', 'cores-theme' ),
    );
    $args_cpt = array(
        'label'                 => __( 'Student Project', 'cores-theme' ),
        'description'           => __( 'Projects for the Supervision page timeline.', 'cores-theme' ),
        'labels'                => $labels_cpt,
        'supports'              => array( 'title', 'editor' ),
        'taxonomies'            => array( 'project_status', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 23,
        'menu_icon'             => 'dashicons-welcome-learn-more',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
    );
    register_post_type( 'student_project', $args_cpt );
}
add_action( 'init', 'cores_register_project_cpt', 0 );

// ============================================
// TEAM META BOXES
// ============================================
function cores_add_team_meta_boxes() {
    add_meta_box(
        'cores_team_details',
        __( 'Team Member Details', 'cores-theme' ),
        'cores_team_meta_box_html',
        'team_member',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'cores_add_team_meta_boxes' );

function cores_team_meta_box_html( $post ) {
    wp_nonce_field( 'cores_save_team_meta_data', 'cores_team_meta_nonce' );

    $email = get_post_meta( $post->ID, '_team_email', true );
    $publications = get_post_meta( $post->ID, '_team_publications', true );
    ?>
    <p>
        <label for="team_email" style="font-weight: bold;"><?php esc_html_e( 'Email Address:', 'cores-theme' ); ?></label>
        <br>
        <input type="email" id="team_email" name="team_email" value="<?php echo esc_attr( $email ); ?>" class="widefat" placeholder="example@gmail.com">
    </p>
    <p>
        <label for="team_publications" style="font-weight: bold;"><?php esc_html_e( 'Publications Count:', 'cores-theme' ); ?></label>
        <br>
        <input type="number" id="team_publications" name="team_publications" value="<?php echo esc_attr( $publications ); ?>" class="widefat" placeholder="e.g., 5">
    </p>
    <p>
        <em><?php esc_html_e( 'Use the main "Excerpt" box for the member\'s role (e.g., "Researcher").', 'cores-theme' ); ?></em>
        <br>
        <em><?php esc_html_e( 'Use the main "Tags" box for the member\'s expertise (e.g., "Coastal Dynamics").', 'cores-theme' ); ?></em>
    </p>
    <?php
}

function cores_save_team_meta_data( $post_id ) {
    if ( ! isset( $_POST['cores_team_meta_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( $_POST['cores_team_meta_nonce'], 'cores_save_team_meta_data' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['team_email'] ) ) {
        update_post_meta( $post_id, '_team_email', sanitize_email( $_POST['team_email'] ) );
    }

    if ( isset( $_POST['team_publications'] ) ) {
        update_post_meta( $post_id, '_team_publications', absint( $_POST['team_publications'] ) );
    }
}
add_action( 'save_post_team_member', 'cores_save_team_meta_data' );

// ============================================
// AJAX CONTACT FORM HANDLER
// ============================================
function cores_handle_contact_form() {
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'cores_contact_form_nonce' ) ) {
        wp_send_json_error( array( 'message' => esc_html__( 'Nonce verification failed. Please refresh and try again.', 'cores-theme' ) ) );
        die();
    }

    $name    = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
    $email   = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
    $subject = isset( $_POST['subject'] ) ? sanitize_text_field( $_POST['subject'] ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( $_POST['message'] ) : '';

    if ( empty( $name ) || empty( $email ) || empty( $subject ) || empty( $message ) ) {
        wp_send_json_error( array( 'message' => esc_html__( 'Please fill out all required fields.', 'cores-theme' ) ) );
        die();
    }
    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => esc_html__( 'Please provide a valid email address.', 'cores-theme' ) ) );
        die();
    }

    $admin_email = get_option( 'admin_email' );
    $email_subject = 'New Contact Form Submission from ' . $name;
    
    $email_body  = "You have received a new message from your website contact form.\n\n";
    $email_body .= "Name: " . $name . "\n\n";
    $email_body .= "Email: " . $email . "\n\n";
    $email_body .= "Subject: " . $subject . "\n\n";
    $email_body .= "Message:\n" . $message . "\n";
    
    $headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

    if ( wp_mail( $admin_email, $email_subject, $email_body, $headers ) ) {
        wp_send_json_success( array( 'message' => esc_html__( 'Thank you! Your message has been sent.', 'cores-theme' ) ) );
    } else {
        wp_send_json_error( array( 'message' => esc_html__( 'An error occurred while trying to send your message. Please try again later.', 'cores-theme' ) ) );
    }

    die();
}
add_action( 'wp_ajax_send_contact_email', 'cores_handle_contact_form' );
add_action( 'wp_ajax_nopriv_send_contact_email', 'cores_handle_contact_form' );

// ============================================
// SECURITY ENHANCEMENTS
// ============================================
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'xmlrpc_enabled', '__return_false' );

function cores_remove_version_scripts_styles( $src ) {
    if ( strpos( $src, 'ver=' ) ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}
add_filter( 'style_loader_src', 'cores_remove_version_scripts_styles', 9999 );
add_filter( 'script_loader_src', 'cores_remove_version_scripts_styles', 9999 );

function cores_add_security_headers() {
    header( 'X-Content-Type-Options: nosniff' );
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'X-XSS-Protection: 1; mode=block' );
    header( 'Referrer-Policy: strict-origin-when-cross-origin' );
}
add_action( 'send_headers', 'cores_add_security_headers' );

// ============================================
// PERFORMANCE OPTIMIZATIONS
// ============================================
function cores_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'cores_disable_emojis' );

function cores_defer_scripts( $tag, $handle ) {
    $defer_scripts = array( 'font-awesome' );
    
    if ( in_array( $handle, $defer_scripts, true ) ) {
        return str_replace( ' src', ' defer src', $tag );
    }
    
    return $tag;
}
add_filter( 'script_loader_tag', 'cores_defer_scripts', 10, 2 );

// ============================================
// EXCERPT CUSTOMIZATION
// ============================================
function cores_custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'cores_custom_excerpt_length', 999 );

function cores_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'cores_excerpt_more' );

// ============================================
// CUSTOM BODY CLASSES
// ============================================
function cores_custom_body_classes( $classes ) {
    if ( is_page() ) {
        global $post;
        $classes[] = 'page-' . $post->post_name;
    }
    
    if ( is_active_sidebar( 'main-sidebar' ) && ( is_home() || is_archive() || is_search() ) ) {
        $classes[] = 'has-sidebar';
    }
    
    return $classes;
}
add_filter( 'body_class', 'cores_custom_body_classes' );

// ============================================
// IMAGE OPTIMIZATION
// ============================================
function cores_image_quality( $quality ) {
    return 85;
}
add_filter( 'jpeg_quality', 'cores_image_quality' );
add_filter( 'wp_editor_set_quality', 'cores_image_quality' );

function cores_enable_webp_upload( $mime_types ) {
    $mime_types['webp'] = 'image/webp';
    return $mime_types;
}
add_filter( 'upload_mimes', 'cores_enable_webp_upload' );

// ============================================
// SCHEMA.ORG STRUCTURED DATA
// ============================================
function cores_add_schema_organization() {
    if ( ! is_front_page() ) {
        return;
    }
    
    $schema = array(
        '@context'  => 'https://schema.org',
        '@type'     => 'ResearchOrganization',
        'name'      => get_bloginfo( 'name' ),
        'url'       => home_url(),
        'logo'      => array(
            '@type' => 'ImageObject',
            'url'   => get_theme_mod( 'cores_logo', CORES_THEME_URI . '/assets/Logo-Cores-UB-revisi-transparan@2x.png' ),
        ),
        'description' => get_bloginfo( 'description' ),
        'address'   => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'Jl. MT. Haryono No.167, Ketawanggede',
            'addressLocality' => 'Malang',
            'addressRegion'   => 'Jawa Timur',
            'postalCode'      => '65145',
            'addressCountry'  => 'ID',
        ),
        'contactPoint' => array(
            '@type'       => 'ContactPoint',
            'email'       => get_theme_mod( 'cores_email_1', 'coastalresearchers@gmail.com' ),
            'telephone'   => get_theme_mod( 'cores_phone_1', '+62 821 4279 3179' ),
            'contactType' => 'Research',
        ),
        'sameAs' => array_filter(
            array(
                get_theme_mod( 'cores_facebook', '' ),
                get_theme_mod( 'cores_twitter', '' ),
                get_theme_mod( 'cores_instagram', '' ),
                get_theme_mod( 'cores_linkedin', '' ),
                get_theme_mod( 'cores_youtube', '' ),
            )
        ),
    );
    
    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
}
add_action( 'wp_footer', 'cores_add_schema_organization' );

// ============================================
// SEARCH ENHANCEMENT
// ============================================
function cores_extend_search( $query ) {
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        $query->set( 'post_type', array( 'post', 'page', 'team_member', 'publication', 'milestone' ) );
    }
}
add_action( 'pre_get_posts', 'cores_extend_search' );

// ============================================
// ADMIN ENHANCEMENTS
// ============================================
function cores_admin_footer_text( $footer_text ) {
    $footer_text = sprintf(
        __( 'Thank you for using %s theme by CORES Research Team', 'cores-theme' ),
        '<strong>CORES Theme V2</strong>'
    );
    return $footer_text;
}
add_filter( 'admin_footer_text', 'cores_admin_footer_text' );

function cores_team_custom_columns( $columns ) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = $columns['title'];
    $new_columns['thumbnail'] = __( 'Photo', 'cores-theme' );
    $new_columns['team_role'] = __( 'Role', 'cores-theme' );
    $new_columns['email'] = __( 'Email', 'cores-theme' );
    $new_columns['publications'] = __( 'Publications', 'cores-theme' );
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter( 'manage_team_member_posts_columns', 'cores_team_custom_columns' );

function cores_team_custom_column_content( $column, $post_id ) {
    switch ( $column ) {
        case 'thumbnail':
            if ( has_post_thumbnail( $post_id ) ) {
                echo get_the_post_thumbnail( $post_id, array( 60, 60 ) );
            } else {
                echo '<span class="dashicons dashicons-admin-users" style="font-size: 60px; color: #ccc;"></span>';
            }
            break;
            
        case 'team_role':
            $terms = get_the_terms( $post_id, 'team_role' );
            if ( $terms && ! is_wp_error( $terms ) ) {
                $role_names = wp_list_pluck( $terms, 'name' );
                echo esc_html( implode( ', ', $role_names ) );
            } else {
                echo '—';
            }
            break;
            
        case 'email':
            $email = get_post_meta( $post_id, '_team_email', true );
            if ( $email ) {
                echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
            } else {
                echo '—';
            }
            break;
            
        case 'publications':
            $pubs = get_post_meta( $post_id, '_team_publications', true );
            echo $pubs ? esc_html( $pubs ) : '0';
            break;
    }
}
add_action( 'manage_team_member_posts_custom_column', 'cores_team_custom_column_content', 10, 2 );

function cores_team_sortable_columns( $columns ) {
    $columns['team_role'] = 'team_role';
    $columns['publications'] = 'publications';
    return $columns;
}
add_filter( 'manage_edit-team_member_sortable_columns', 'cores_team_sortable_columns' );

// ============================================
// BREADCRUMBS FUNCTION
// ============================================
function cores_breadcrumbs() {
    $separator  = '<span class="breadcrumb-separator"> / </span>';
    $home_title = esc_html__( 'Home', 'cores-theme' );

    global $post;

    if ( ! is_front_page() ) {
        echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'cores-theme' ) . '">';
        echo '<a href="' . esc_url( home_url() ) . '">' . $home_title . '</a>' . $separator;

        if ( is_archive() && ! is_tax() && ! is_category() && ! is_tag() ) {
            echo '<span class="breadcrumb-current">' . post_type_archive_title( '', false ) . '</span>';
        } elseif ( is_archive() && is_tax() && ! is_category() && ! is_tag() ) {
            $post_type = get_post_type();
            $post_type_object = get_post_type_object( $post_type );
            $post_type_archive = get_post_type_archive_link( $post_type );
            echo '<a href="' . esc_url( $post_type_archive ) . '">' . esc_html( $post_type_object->labels->name ) . '</a>' . $separator;
            echo '<span class="breadcrumb-current">' . single_term_title( '', false ) . '</span>';
        } elseif ( is_single() ) {
            $post_type = get_post_type();
            if ( 'post' !== $post_type ) {
                $post_type_object = get_post_type_object( $post_type );
                $post_type_archive = get_post_type_archive_link( $post_type );
                echo '<a href="' . esc_url( $post_type_archive ) . '">' . esc_html( $post_type_object->labels->name ) . '</a>' . $separator;
            }
            echo '<span class="breadcrumb-current">' . get_the_title() . '</span>';
        } elseif ( is_category() ) {
            echo '<span class="breadcrumb-current">' . single_cat_title( '', false ) . '</span>';
        } elseif ( is_page() ) {
            if ( $post->post_parent ) {
                $ancestors = get_post_ancestors( $post->ID );
                $ancestors = array_reverse( $ancestors );
                foreach ( $ancestors as $ancestor ) {
                    echo '<a href="' . esc_url( get_permalink( $ancestor ) ) . '">' . get_the_title( $ancestor ) . '</a>' . $separator;
                }
            }
            echo '<span class="breadcrumb-current">' . get_the_title() . '</span>';
        } elseif ( is_tag() ) {
            echo '<span class="breadcrumb-current">' . single_tag_title( '', false ) . '</span>';
        } elseif ( is_search() ) {
            echo '<span class="breadcrumb-current">' . esc_html__( 'Search results for: ', 'cores-theme' ) . get_search_query() . '</span>';
        } elseif ( is_404() ) {
            echo '<span class="breadcrumb-current">' . esc_html__( '404 Not Found', 'cores-theme' ) . '</span>';
        }

        echo '</nav>';
    }
}

// ============================================
// CLEANUP
// ============================================
function cores_cleanup_head() {
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );
}
add_action( 'init', 'cores_cleanup_head' );

// ============================================
// THEME ACTIVATION
// ============================================
function cores_theme_activation() {
    flush_rewrite_rules();
    
    $default_options = array(
        'cores_logo_text' => 'CORES',
        'cores_email_1'   => 'coastalresearchers@gmail.com',
        'cores_phone_1'   => '+62 821 4279 3179',
    );
    
    foreach ( $default_options as $key => $value ) {
        if ( ! get_theme_mod( $key ) ) {
            set_theme_mod( $key, $value );
        }
    }
}
add_action( 'after_switch_theme', 'cores_theme_activation' );

function cores_theme_deactivation() {
    flush_rewrite_rules();
}
add_action( 'switch_theme', 'cores_theme_deactivation' );
// End of functions.php