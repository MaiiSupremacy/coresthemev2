<?php

/**
 * CORES Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CORES_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// *** ADDED: Define theme version for cache-busting ***
// This avoids using filemtime() on every page load, which is much better for performance.
define( 'CORES_THEME_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Theme Setup
 * Sets up theme defaults and registers support for various WordPress features.
 */
function cores_theme_setup() {
	
	// *** ADDED: Make theme available for translation. ***
	// This loads the .mo files from the /languages/ directory.
	load_theme_textdomain( 'cores-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'primary-menu' => esc_html__( 'Primary Menu', 'cores-theme' ),
			'footer-menu'  => esc_html__( 'Footer Menu', 'cores-theme' ),
		)
	);

	// Switch default core markup for search form, comment form, and comments
	// to output valid HTML5.
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
	
	// *** ADDED: Gutenberg (Block Editor) Support ***
	// Enable block editor styles.
	add_theme_support( 'wp-block-styles' );
	
	// Enable wide and full-width alignments.
	add_theme_support( 'align-wide' );
	
	// Make embeds (like YouTube) responsive.
	add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'cores_theme_setup' );


/**
 * Enqueue scripts and styles.
 *
 * *** MAJOR UPDATE FOR STEP 12 ***
 * - This function now checks if we are on the 'People' page.
 * - If we are, it runs a WP_Query to get ALL team member data.
 * - It passes this data to 'cores-main-js' using wp_localize_script.
 * - This makes the team modal 100% dynamic.
 *
 * *** NEW UPDATE FOR STEP 13 ***
 * - Added a new wp_localize_script call for 'cores_ajax_object'.
 * - This passes the secure AJAX URL and nonce to main.js for the contact form.
 */
function cores_enqueue_assets() {
	// Google Fonts
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap', array(), null );

	// Font Awesome
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );

	// Leaflet CSS (for map)
	wp_enqueue_style( 'leaflet-css', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', array(), '1.9.4' );
	
	// Swiper.js CSS (for gallery carousel)
	wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0' );

	// Main Theme Stylesheet
	// *** IMPROVED: Replaced filemtime() with theme version for performance. ***
	wp_enqueue_style( 'cores-style', get_stylesheet_uri(), array(), CORES_THEME_VERSION );

	// --- Scripts ---

	// Leaflet JS (for map)
	wp_enqueue_script( 'leaflet-js', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', array(), '1.9.4', true );

	// *** REMOVED: Chart.js - No longer needed ***
	
	// Swiper.js (for gallery carousel)
	// *** CRITICAL FIX: The original URL was incorrect (https-cdn-fix.net) ***
	wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true );

	// Main Theme JavaScript
	// *** IMPROVED: Replaced filemtime() with theme version for performance. ***
	// *** NOTE: Your main.js does not use jQuery, so it is not listed as a dependency. This is correct. ***
	wp_enqueue_script( 'cores-main-js', get_template_directory_uri() . '/js/main.js', array( 'leaflet-js', 'swiper-js' ), CORES_THEME_VERSION, true );

	// ============================================
	// *** DYNAMIC TEAM MODAL DATA (STEP 12) ***
	// ============================================
	// We only need to run this expensive query on the People page.
	if ( is_page_template( 'page-people.php' ) ) {
		
		$team_data_for_js = array();

		$team_query_args = array(
			'post_type'      => 'team_member',
			'posts_per_page' => -1, // Get all members
		);
		
		$team_query = new WP_Query( $team_query_args );

		if ( $team_query->have_posts() ) {
			while ( $team_query->have_posts() ) {
				$team_query->the_post();
				
				$post_slug = $post->post_name;
				
				// Get tags (expertise)
				$tags = get_the_tags();
				$expertise_list = array();
				if ( $tags ) {
					foreach ( $tags as $tag ) {
						$expertise_list[] = $tag->name;
					}
				}
				
				$team_data_for_js[ $post_slug ] = array(
					'name'         => get_the_title(),
					'title'        => get_the_excerpt(), // We use Excerpt for the title
					'bio'          => apply_filters( 'the_content', get_the_content() ), // Get the full bio from the editor
					'expertise'    => $expertise_list,
					'publications' => get_post_meta( get_the_ID(), '_team_publications', true ), // Get from new custom field
					'email'        => get_post_meta( get_the_ID(), '_team_email', true ), // Get from new custom field
				);
			}
		}
		wp_reset_postdata();

		// This is the magic function.
		// It creates a JavaScript object named 'coresTeamData'
		// that 'cores-main-js' can access.
		wp_localize_script(
			'cores-main-js',        // Handle of the script to attach data to
			'coresTeamData',        // Name of the new JavaScript object
			$team_data_for_js       // The PHP array to convert to JSON
		);
	}

	// ============================================
	// *** NEW: AJAX CONTACT FORM DATA (STEP 13) ***
	// ============================================
	// This data is needed on all pages that show the footer form.
	wp_localize_script(
		'cores-main-js',        // Handle of the script to attach data to
		'cores_ajax_object',    // Name of the new JavaScript object
		array(
			'ajax_url'    => admin_url( 'admin-ajax.php' ), // The WordPress AJAX URL
			'contact_nonce' => wp_create_nonce( 'cores_contact_form_nonce' ), // Create a nonce
			// Pass translated strings to JS
			'sending'     => esc_html__( 'Sending...', 'cores-theme' ),
			'success'     => esc_html__( 'Message Sent Successfully!', 'cores-theme' ),
			'success_msg' => esc_html__( 'Thank you for contacting us. We will get back to you soon.', 'cores-theme' ),
			'error'       => esc_html__( 'An Error Occurred', 'cores-theme' ),
			'error_msg'   => esc_html__( 'Please try again later.', 'cores-theme' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'cores_enqueue_assets' );


/**
 * Fallback menu for main navigation
 * Provides a gracefully degrading menu if no menu is assigned in 'Appearance > Menus'.
 * * Updated to match new navigation structure:
 * Home | About | People | Research | Publications | Supervision
 */
function cores_menu_fallback( $args ) {
	// *** IMPROVED: Added text domain for translation ***
	echo '<ul class="cores-menu-fallback">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'cores-theme' ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/about/' ) ) . '">' . esc_html__( 'About', 'cores-theme' ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/people/' ) ) . '">' . esc_html__( 'People', 'cores-theme' ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/research/' ) ) . '">' . esc_html__( 'Research', 'cores-theme' ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/publications/' ) ) . '">' . esc_html__( 'Publications', 'cores-theme' ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/supervision/' ) ) . '">' . esc_html__( 'Supervision', 'cores-theme' ) . '</a></li>';
	echo '</ul>';
}


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
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

	// *** ADDED: New widget area for the footer ***
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widget Area', 'cores-theme' ),
			'id'            => 'footer-widget-area',
			'description'   => esc_html__( 'Add widgets here to appear in the footer. Recommended: Categories, Archives, or a Custom Menu.', 'cores-theme' ),
			'before_widget' => '<li id="%1$s" class="widget footer-widget %2$s">', // Use <li> for semantics
			'after_widget'  => '</li>',
			'before_title'  => '<h4 class="widget-title">', // Use h4 for footer hierarchy
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'cores_widgets_init' );


/**
 * *** NEW: Include Theme Customizer ***
 * This file will contain all customization options for:
 * - Logo upload
 * - Hero slider images
 * - Gallery images
 * - Contact information
 * - Social media links
 * - Colors
 */
require get_template_directory() . '/inc/customizer.php';


// ============================================
// *** NEW: CUSTOM POST TYPE FOR TEAM ***
// ============================================

/**
 * Register Team Custom Post Type and Taxonomy
 */
function cores_register_team_cpt_and_tax() {

    // 1. Register the Custom Post Type (Team Member)
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
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'tags' ), // title=Name, editor=Bio, excerpt=Role, tags=Expertise
        'taxonomies'            => array( 'team_role', 'post_tag' ), // We will add 'team_role' next
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20, // Below 'Pages'
        'menu_icon'             => 'dashicons-groups',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false, // We use a page template, not an archive
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'team_member', $args_cpt );

    // 2. Register the Taxonomy (Team Role)
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
        'hierarchical'               => true, // Makes it like Categories (vs. Tags)
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
// *** NEW: CUSTOM META BOXES FOR TEAM ***
// ============================================

/**
 * Add meta box to Team Member CPT
 */
function cores_add_team_meta_boxes() {
    add_meta_box(
        'cores_team_details', // Unique ID
        __( 'Team Member Details', 'cores-theme' ), // Box title
        'cores_team_meta_box_html', // Content callback function
        'team_member', // Post type
        'normal', // Context (normal, side)
        'high' // Priority (high, low)
    );
}
add_action( 'add_meta_boxes', 'cores_add_team_meta_boxes' );

/**
 * Callback function to display the HTML for the meta box
 */
function cores_team_meta_box_html( $post ) {
    // Add a nonce field for security
    wp_nonce_field( 'cores_save_team_meta_data', 'cores_team_meta_nonce' );

    // Get existing values
    $email = get_post_meta( $post->ID, '_team_email', true );
    $publications = get_post_meta( $post->ID, '_team_publications', true );
    
    // We will use the main editor for Bio, so no field needed here.
    // We will use the Excerpt for Title (e.g., "Researcher"), so no field needed here.
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

/**
 * Save the custom meta box data
 */
function cores_save_team_meta_data( $post_id ) {
    // 1. Check if our nonce is set.
    if ( ! isset( $_POST['cores_team_meta_nonce'] ) ) {
        return;
    }

    // 2. Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['cores_team_meta_nonce'], 'cores_save_team_meta_data' ) ) {
        return;
    }

    // 3. If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // 4. Check the user's permissions.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // 5. OK, it's safe to save the data now.
    
    // Save Email
    if ( isset( $_POST['team_email'] ) ) {
        update_post_meta( $post_id, '_team_email', sanitize_email( $_POST['team_email'] ) );
    }

    // Save Publications Count
    if ( isset( $_POST['team_publications'] ) ) {
        update_post_meta( $post_id, '_team_publications', absint( $_POST['team_publications'] ) ); // absint ensures it's a positive integer
    }
}
add_action( 'save_post_team_member', 'cores_save_team_meta_data' );


// ============================================
// *** NEW: CUSTOM POST TYPE FOR MILESTONES ***
// ============================================

/**
 * Register Milestone Custom Post Type
 */
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
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ), // title=Title, editor=Description, excerpt=Date
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 21, // Below 'Team'
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
// *** NEW: CUSTOM POST TYPE FOR PUBLICATIONS ***
// ============================================

/**
 * Register Publication Custom Post Type and Taxonomy
 */
function cores_register_publication_cpt() {
    
    // 1. Register the Taxonomy (Publication Type)
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
        'hierarchical'               => true, // e.g., Journal, Conference Paper
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
    );
    register_taxonomy( 'publication_type', array( 'publication' ), $args_tax );


    // 2. Register the Custom Post Type (Publication)
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
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'tags' ), // title=Title, editor=Abstract, excerpt=Authors/Citation
        'taxonomies'            => array( 'publication_type', 'post_tag' ), // Use post_tag for keywords
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 22, // Below 'Milestones'
        'menu_icon'             => 'dashicons-media-document',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true, // We can have a /publications/ archive page
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'publication', $args_cpt );

}
add_action( 'init', 'cores_register_publication_cpt', 0 );


// ============================================
// *** NEW: CUSTOM POST TYPE FOR STUDENT PROJECTS ***
// ============================================

/**
 * Register Student Project Custom Post Type
 */
function cores_register_project_cpt() {

    // 1. Register the Taxonomy (Project Status)
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
        'hierarchical'               => true, // e.g., In Progress, Available
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => false,
        'show_tagcloud'              => false,
    );
    register_taxonomy( 'project_status', array( 'student_project' ), $args_tax );

    // 2. Register the Custom Post Type (Student Project)
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
        'supports'              => array( 'title', 'editor' ), // title=Project Title, editor=Description
        'taxonomies'            => array( 'project_status', 'post_tag' ), // Use post_tag for research area (e.g., "Data Analysis")
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 23, // Below 'Publications'
        'menu_icon'             => 'dashicons-welcome-learn-more',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true, // Don't show in site search
        'publicly_queryable'    => false, // Don't allow individual project pages
        'capability_type'       => 'post',
    );
    register_post_type( 'student_project', $args_cpt );

}
add_action( 'init', 'cores_register_project_cpt', 0 );


// ============================================
// *** NEW: AJAX CONTACT FORM HANDLER (STEP 13) ***
// ============================================

/**
 * Handle the contact form AJAX submission
 */
function cores_handle_contact_form() {
    // 1. Security Check: Verify the nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'cores_contact_form_nonce' ) ) {
        wp_send_json_error( array( 'message' => esc_html__( 'Nonce verification failed. Please refresh and try again.', 'cores-theme' ) ) );
        die();
    }

    // 2. Sanitize all input data
    $name    = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
    $email   = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
    $subject = isset( $_POST['subject'] ) ? sanitize_text_field( $_POST['subject'] ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( $_POST['message'] ) : '';

    // 3. Validate data (simple validation)
    if ( empty( $name ) || empty( $email ) || empty( $subject ) || empty( $message ) ) {
        wp_send_json_error( array( 'message' => esc_html__( 'Please fill out all required fields.', 'cores-theme' ) ) );
        die();
    }
    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => esc_html__( 'Please provide a valid email address.', 'cores-theme' ) ) );
        die();
    }

    // 4. Build the email
    $admin_email = get_option( 'admin_email' ); // Send to the site administrator
    $email_subject = 'New Contact Form Submission from ' . $name;
    
    $email_body  = "You have received a new message from your website contact form.\n\n";
    $email_body .= "Name: " . $name . "\n\n";
    $email_body .= "Email: " . $email . "\n\n";
    $email_body .= "Subject: " . $subject . "\n\n";
    $email_body .= "Message:\n" . $message . "\n";
    
    $headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

    // 5. Send the email
    if ( wp_mail( $admin_email, $email_subject, $email_body, $headers ) ) {
        // Success!
        wp_send_json_success( array( 'message' => esc_html__( 'Thank you! Your message has been sent.', 'cores-theme' ) ) );
    } else {
        // Error
        wp_send_json_error( array( 'message' => esc_html__( 'An error occurred while trying to send your message. Please try again later.', 'cores-theme' ) ) );
    }

    // Always die() at the end of an AJAX handler
    die();
}
// Hook for logged-in users
add_action( 'wp_ajax_send_contact_email', 'cores_handle_contact_form' );
// Hook for logged-out users (nopriv)
add_action( 'wp_ajax_nopriv_send_contact_email', 'cores_handle_contact_form' );
?>