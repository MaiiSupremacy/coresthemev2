<?php
/**
 * CORES Theme Customizer
 *
 * This file adds customization options to WordPress Customizer
 * allowing users to modify theme settings without coding.
 *
 * *** UPDATED: Added new settings for "Hero Slider Links" (Step 6) ***
 * *** UPDATED: Added new sections for About Page Stats and Equipment ***
 * *** UPDATED: Added new section for Research Page Map ***
 * *** UPDATED: Added new section for Publication Page Stats ***
 * *** UPDATED: Added new sections for Supervision Page dynamic content ***
 *
 * @package CORES_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add customizer settings
 */
function cores_customize_register( $wp_customize ) {

	// ============================================
	// SECTION 1: LOGO SETTINGS
	// ============================================
	$wp_customize->add_section( 'cores_logo_section', array(
		'title'    => __( 'CORES Logo', 'cores-theme' ),
		'priority' => 30,
	) );

	// Logo Upload
	$wp_customize->add_setting( 'cores_logo', array(
		'default'           => get_template_directory_uri() . '/assets/Logo-Cores-UB-revisi-transparan@2x.png',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cores_logo', array(
		'label'    => __( 'Upload Logo', 'cores-theme' ),
		'section'  => 'cores_logo_section',
		'settings' => 'cores_logo',
	) ) );

	// Logo Text
	$wp_customize->add_setting( 'cores_logo_text', array(
		'default'           => 'CORES',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'cores_logo_text', array(
		'label'    => __( 'Logo Text', 'cores-theme' ),
		'section'  => 'cores_logo_section',
		'type'     => 'text',
	) );


	// ============================================
	// SECTION 2: HERO SLIDER
	// ============================================
	$wp_customize->add_section( 'cores_hero_section', array(
		'title'       => __( 'Hero Slider', 'cores-theme' ),
		'description' => __( 'Upload images, text, and links for the homepage hero slider.', 'cores-theme' ),
		'priority'    => 40,
	) );

	// --- Slide 1 ---
	$wp_customize->add_setting( 'cores_hero_slide_1', array(
		'default'           => 'https://picsum.photos/seed/coastal-horizon/1920/1080.jpg',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cores_hero_slide_1', array(
		'label'    => __( 'Slide 1 Image', 'cores-theme' ),
		'section'  => 'cores_hero_section',
	) ) );
	$wp_customize->add_setting( 'cores_hero_slide_1_title', array(
		'default'           => 'Welcome to Our Coastal Horizon',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'cores_hero_slide_1_title', array(
		'label'    => __( 'Slide 1 Title', 'cores-theme' ),
		'section'  => 'cores_hero_section',
		'type'     => 'text',
	) );
	$wp_customize->add_setting( 'cores_hero_slide_1_desc', array(
		'default'           => 'Exploring the dynamics of coastal ecosystems through innovative research and technology',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'cores_hero_slide_1_desc', array(
		'label'    => __( 'Slide 1 Description', 'cores-theme' ),
		'section'  => 'cores_hero_section',
		'type'     => 'textarea',
	) );
	// *** NEW (STEP 6) ***
	$wp_customize->add_setting( 'cores_hero_slide_1_link', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'cores_hero_slide_1_link', array(
		'label'       => __( 'Slide 1 Button Link', 'cores-theme' ),
		'description' => __( 'Select the page this slide\'s button should link to.', 'cores-theme' ),
		'section'     => 'cores_hero_section',
		'type'        => 'dropdown-pages', // This creates a dropdown of all your pages!
	) );


	// --- Slide 2 ---
	$wp_customize->add_setting( 'cores_hero_slide_2', array(
		'default'           => 'https://picsum.photos/seed/coastal-research/1920/1080.jpg',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cores_hero_slide_2', array(
		'label'    => __( 'Slide 2 Image', 'cores-theme' ),
		'section'  => 'cores_hero_section',
	) ) );
	$wp_customize->add_setting( 'cores_hero_slide_2_title', array(
		'default'           => 'What We Research For?',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'cores_hero_slide_2_title', array(
		'label'    => __( 'Slide 2 Title', 'cores-theme' ),
		'section'  => 'cores_hero_section',
		'type'     => 'text',
	) );
	$wp_customize->add_setting( 'cores_hero_slide_2_desc', array(
		'default'           => 'Understanding coastal processes to protect our shorelines and communities',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'cores_hero_slide_2_desc', array(
		'label'    => __( 'Slide 2 Description', 'cores-theme' ),
		'section'  => 'cores_hero_section',
		'type'     => 'textarea',
	) );
	// *** NEW (STEP 6) ***
	$wp_customize->add_setting( 'cores_hero_slide_2_link', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'cores_hero_slide_2_link', array(
		'label'       => __( 'Slide 2 Button Link', 'cores-theme' ),
		'section'     => 'cores_hero_section',
		'type'        => 'dropdown-pages',
	) );


	// --- Slide 3 ---
	$wp_customize->add_setting( 'cores_hero_slide_3', array(
		'default'           => 'https://picsum.photos/seed/cores-team/1920/1080.jpg',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cores_hero_slide_3', array(
		'label'    => __( 'Slide 3 Image', 'cores-theme' ),
		'section'  => 'cores_hero_section',
	) ) );
	$wp_customize->add_setting( 'cores_hero_slide_3_title', array(
		'default'           => 'Meet Our Team',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'cores_hero_slide_3_title', array(
		'label'    => __( 'Slide 3 Title', 'cores-theme' ),
		'section'  => 'cores_hero_section',
		'type'     => 'text',
	) );
	$wp_customize->add_setting( 'cores_hero_slide_3_desc', array(
		'default'           => 'Passionate researchers dedicated to advancing coastal science',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'cores_hero_slide_3_desc', array(
		'label'    => __( 'Slide 3 Description', 'cores-theme' ),
		'section'  => 'cores_hero_section',
		'type'     => 'textarea',
	) );
	// *** NEW (STEP 6) ***
	$wp_customize->add_setting( 'cores_hero_slide_3_link', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'cores_hero_slide_3_link', array(
		'label'       => __( 'Slide 3 Button Link', 'cores-theme' ),
		'section'     => 'cores_hero_section',
		'type'        => 'dropdown-pages',
	) );


	// ============================================
	// SECTION 3: RESEARCH GALLERY IMAGES
	// ============================================
	$wp_customize->add_section( 'cores_gallery_section', array(
		'title'       => __( 'Research Gallery Images', 'cores-theme' ),
		'description' => __( 'Upload 6 images for the research gallery carousel.', 'cores-theme' ),
		'priority'    => 50,
	) );

	// Gallery Image 1
	$wp_customize->add_setting( 'cores_gallery_1', array(
		'default'           => 'https://picsum.photos/seed/research1/800/600.jpg',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cores_gallery_1', array(
		'label'    => __( 'Gallery Image 1', 'cores-theme' ),
		'section'  => 'cores_gallery_section',
		'settings' => 'cores_gallery_1',
	) ) );

	$wp_customize->add_setting( 'cores_gallery_1_caption', array(
		'default'           => 'Field research at coastal monitoring station',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'cores_gallery_1_caption', array(
		'label'    => __( 'Gallery Image 1 Caption', 'cores-theme' ),
		'section'  => 'cores_gallery_section',
		'type'     => 'text',
	) );

	// Gallery Image 2
	$wp_customize->add_setting( 'cores_gallery_2', array(
		'default'           => 'https://picsum.photos/seed/research2/800/600.jpg',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cores_gallery_2', array(
		'label'    => __( 'Gallery Image 2', 'cores-theme' ),
		'section'  => 'cores_gallery_section',
		'settings' => 'cores_gallery_2',
	) ) );

	$wp_customize->add_setting( 'cores_gallery_2_caption', array(
		'default'           => 'Aerial survey using research drone',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'cores_gallery_2_caption', array(
		'label'    => __( 'Gallery Image 2 Caption', 'cores-theme' ),
		'section'  => 'cores_gallery_section',
		'type'     => 'text',
	) );

	// Gallery Image 3
	$wp_customize->add_setting( 'cores_gallery_3', array(
		'default'           => 'https://picsum.photos/seed/research3/800/600.jpg',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cores_gallery_3', array(
		'label'    => __( 'Gallery Image 3', 'cores-theme' ),
		'section'  => 'cores_gallery_section',
		'settings' => 'cores_gallery_3',
	) ) );

	$wp_customize->add_setting( 'cores_gallery_3_caption', array(
		'default'           => 'Laboratory sediment analysis',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'cores_gallery_3_caption', array(
		'label'    => __( 'Gallery Image 3 Caption', 'cores-theme' ),
		'section'  => 'cores_gallery_section',
		'type'     => 'text',
	) );

	// Gallery Image 4
	$wp_customize->add_setting( 'cores_gallery_4', array(
		'default'           => 'https://picsum.photos/seed/research4/800/600.jpg',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cores_gallery_4', array(
		'label'    => __( 'Gallery Image 4', 'cores-theme' ),
		'section'  => 'cores_gallery_section',
		'settings' => 'cores_gallery_4',
	) ) );

	$wp_customize->add_setting( 'cores_gallery_4_caption', array(
		'default'           => 'Mangrove ecosystem parameterization',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'cores_gallery_4_caption', array(
		'label'    => __( 'Gallery Image 4 Caption', 'cores-theme' ),
		'section'  => 'cores_gallery_section',
		'type'     => 'text',
	) );

	// Gallery Image 5
	$wp_customize->add_setting( 'cores_gallery_5', array(
		'default'           => 'https://picsum.photos/seed/research5/800/600.jpg',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cores_gallery_5', array(
		'label'    => __( 'Gallery Image 5', 'cores-theme' ),
		'section'  => 'cores_gallery_section',
		'settings' => 'cores_gallery_5',
	) ) );

	$wp_customize->add_setting( 'cores_gallery_5_caption', array(
		'default'           => 'Wave gauge deployment and measurement',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'cores_gallery_5_caption', array(
		'label'    => __( 'Gallery Image 5 Caption', 'cores-theme' ),
		'section'  => 'cores_gallery_section',
		'type'     => 'text',
	) );

	// Gallery Image 6
	$wp_customize->add_setting( 'cores_gallery_6', array(
		'default'           => 'https://picsum.photos/seed/research6/800/600.jpg',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cores_gallery_6', array(
		'label'    => __( 'Gallery Image 6', 'cores-theme' ),
		'section'  => 'cores_gallery_section',
		'settings' => 'cores_gallery_6',
	) ) );

	$wp_customize->add_setting( 'cores_gallery_6_caption', array(
		'default'           => 'Research team planning session',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'cores_gallery_6_caption', array(
		'label'    => __( 'Gallery Image 6 Caption', 'cores-theme' ),
		'section'  => 'cores_gallery_section',
		'type'     => 'text',
	) );


	// ============================================
	// SECTION 4: RESEARCH PAGE MAP
	// ============================================
	$wp_customize->add_section( 'cores_research_map_section', array(
		'title'       => __( 'Research Page: Map', 'cores-theme' ),
		'description' => __( 'Edit the map settings for the Research page.', 'cores-theme' ),
		'priority'    => 51, // Just after the gallery
	) );

	// Map Latitude
	$wp_customize->add_setting( 'cores_map_lat', array(
		'default'           => '-8.4384848',
		'sanitize_callback' => 'sanitize_text_field', // Good for coordinates
	) );
	$wp_customize->add_control( 'cores_map_lat', array(
		'label'    => __( 'Map Latitude', 'cores-theme' ),
		'section'  => 'cores_research_map_section',
		'type'     => 'text',
	) );

	// Map Longitude
	$wp_customize->add_setting( 'cores_map_lng', array(
		'default'           => '112.6678858',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'cores_map_lng', array(
		'label'    => __( 'Map Longitude', 'cores-theme' ),
		'section'  => 'cores_research_map_section',
		'type'     => 'text',
	) );

	// Map Zoom
	$wp_customize->add_setting( 'cores_map_zoom', array(
		'default'           => '12',
		'sanitize_callback' => 'absint', // Ensures it's a positive integer
	) );
	$wp_customize->add_control( 'cores_map_zoom', array(
		'label'    => __( 'Map Default Zoom', 'cores-theme' ),
		'section'  => 'cores_research_map_section',
		'type'     => 'number',
		'input_attrs' => array(
			'min' => 1,
			'max' => 20,
		),
	) );

	// Map Marker Title
	$wp_customize->add_setting( 'cores_map_marker_title', array(
		'default'           => 'Clungup Research Location',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'cores_map_marker_title', array(
		'label'    => __( 'Map Marker Title', 'cores-theme' ),
		'section'  => 'cores_research_map_section',
		'type'     => 'text',
	) );


	// ============================================
	// SECTION 5: ABOUT PAGE STATS
	// ============================================
	$wp_customize->add_section( 'cores_about_stats_section', array(
		'title'       => __( 'About Page: Stats', 'cores-theme' ),
		'description' => __( 'Edit the 4 impact stats on the About page.', 'cores-theme' ),
		'priority'    => 55,
	) );

	// Stat 1
	$wp_customize->add_setting( 'cores_stat_1_number', array( 'default' => '10+', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cores_stat_1_number', array(
		'label' => __( 'Stat 1 Number', 'cores-theme' ), 'section' => 'cores_about_stats_section', 'type' => 'text',
	) );
	$wp_customize->add_setting( 'cores_stat_1_label', array( 'default' => __( 'Research Projects', 'cores-theme' ), 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cores_stat_1_label', array(
		'label' => __( 'Stat 1 Label', 'cores-theme' ), 'section' => 'cores_about_stats_section', 'type' => 'text',
	) );

	// Stat 2
	$wp_customize->add_setting( 'cores_stat_2_number', array( 'default' => '25+', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cores_stat_2_number', array(
		'label' => __( 'Stat 2 Number', 'cores-theme' ), 'section' => 'cores_about_stats_section', 'type' => 'text',
	) );
	$wp_customize->add_setting( 'cores_stat_2_label', array( 'default' => __( 'Publications', 'cores-theme' ), 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cores_stat_2_label', array(
		'label' => __( 'Stat 2 Label', 'cores-theme' ), 'section' => 'cores_about_stats_section', 'type' => 'text',
	) );

	// Stat 3
	$wp_customize->add_setting( 'cores_stat_3_number', array( 'default' => '15', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cores_stat_3_number', array(
		'label' => __( 'Stat 3 Number', 'cores-theme' ), 'section' => 'cores_about_stats_section', 'type' => 'text',
	) );
	$wp_customize->add_setting( 'cores_stat_3_label', array( 'default' => __( 'Team Members', 'cores-theme' ), 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cores_stat_3_label', array(
		'label' => __( 'Stat 3 Label', 'cores-theme' ), 'section' => 'cores_about_stats_section', 'type' => 'text',
	) );

	// Stat 4
	$wp_customize->add_setting( 'cores_stat_4_number', array( 'default' => '5+', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cores_stat_4_number', array(
		'label' => __( 'Stat 4 Number', 'cores-theme' ), 'section' => 'cores_about_stats_section', 'type' => 'text',
	) );
	$wp_customize->add_setting( 'cores_stat_4_label', array( 'default' => __( 'Partner Institutions', 'cores-theme' ), 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cores_stat_4_label', array(
		'label' => __( 'Stat 4 Label', 'cores-theme' ), 'section' => 'cores_about_stats_section', 'type' => 'text',
	) );


	// ============================================
	// SECTION 6: ABOUT PAGE EQUIPMENT
	// ============================================
	$wp_customize->add_section( 'cores_about_equipment_section', array(
		'title'       => __( 'About Page: Equipment', 'cores-theme' ),
		'description' => __( 'Edit the 4 equipment items on the About page.', 'cores-theme' ),
		'priority'    => 56,
	) );

	// Loop to create settings for 4 equipment items
	for ( $i = 1; $i <= 4; $i++ ) {

		// Equipment Image
		$wp_customize->add_setting( "cores_equipment_image_$i", array(
			'default'           => 'https://picsum.photos/seed/equipment' . $i . '/400/300.jpg',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "cores_equipment_image_$i", array(
			'label'    => sprintf( __( 'Equipment %d Image', 'cores-theme' ), $i ),
			'section'  => 'cores_about_equipment_section',
		) ) );

		// Equipment Name
		$wp_customize->add_setting( "cores_equipment_name_$i", array(
			'default'           => esc_html__( 'Research Equipment', 'cores-theme' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( "cores_equipment_name_$i", array(
			'label'    => sprintf( __( 'Equipment %d Name', 'cores-theme' ), $i ),
			'section'  => 'cores_about_equipment_section',
			'type'     => 'text',
		) );

		// Equipment Description
		$wp_customize->add_setting( "cores_equipment_desc_$i", array(
			'default'           => esc_html__( 'Set a description in the Customizer.', 'cores-theme' ),
			'sanitize_callback' => 'sanitize_textarea_field',
		) );
		$wp_customize->add_control( "cores_equipment_desc_$i", array(
			'label'    => sprintf( __( 'Equipment %d Description', 'cores-theme' ), $i ),
			'section'  => 'cores_about_equipment_section',
			'type'     => 'textarea',
		) );
	}


	// ============================================
	// SECTION 7: PUBLICATION PAGE STATS
	// ============================================
	$wp_customize->add_section( 'cores_publication_stats_section', array(
		'title'       => __( 'Publications Page: Stats', 'cores-theme' ),
		'description' => __( 'Edit the 4 impact stats on the Publications page.', 'cores-theme' ),
		'priority'    => 57, // After About Page sections
	) );

	// Stat 1
	$wp_customize->add_setting( 'cores_pub_stat_1_number', array( 'default' => '6+', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cores_pub_stat_1_number', array(
		'label' => __( 'Stat 1 Number (e.g., 6+)', 'cores-theme' ), 'section' => 'cores_publication_stats_section', 'type' => 'text',
	) );
	$wp_customize->add_setting( 'cores_pub_stat_1_label', array( 'default' => __( 'Published Papers', 'cores-theme' ), 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cores_pub_stat_1_label', array(
		'label' => __( 'Stat 1 Label', 'cores-theme' ), 'section' => 'cores_publication_stats_section', 'type' => 'text',
	) );

	// Stat 2
	$wp_customize->add_setting( 'cores_pub_stat_2_number', array( 'default' => '3+', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cores_pub_stat_2_number', array(
		'label' => __( 'Stat 2 Number (e.g., 3+)', 'cores-theme' ), 'section' => 'cores_publication_stats_section', 'type' => 'text',
	) );
	$wp_customize->add_setting( 'cores_pub_stat_2_label', array( 'default' => __( 'Years Active', 'cores-theme' ), 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cores_pub_stat_2_label', array(
		'label' => __( 'Stat 2 Label', 'cores-theme' ), 'section' => 'cores_publication_stats_section', 'type' => 'text',
	) );

	// Stat 3
	$wp_customize->add_setting( 'cores_pub_stat_3_number', array( 'default' => '100+', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cores_pub_stat_3_number', array(
		'label' => __( 'Stat 3 Number (e.g., 100+)', 'cores-theme' ), 'section' => 'cores_publication_stats_section', 'type' => 'text',
	) );
	$wp_customize->add_setting( 'cores_pub_stat_3_label', array( 'default' => __( 'Citations', 'cores-theme' ), 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cores_pub_stat_3_label', array(
		'label' => __( 'Stat 3 Label', 'cores-theme' ), 'section' => 'cores_publication_stats_section', 'type' => 'text',
	) );

	// Stat 4
	$wp_customize->add_setting( 'cores_pub_stat_4_number', array( 'default' => '5+', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cores_pub_stat_4_number', array(
		'label' => __( 'Stat 4 Number (e.g., 5+)', 'cores-theme' ), 'section' => 'cores_publication_stats_section', 'type' => 'text',
	) );
	$wp_customize->add_setting( 'cores_pub_stat_4_label', array( 'default' => __( 'h-index', 'cores-theme' ), 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cores_pub_stat_4_label', array(
		'label' => __( 'Stat 4 Label', 'cores-theme' ), 'section' => 'cores_publication_stats_section', 'type' => 'text',
	) );


	// ============================================
	// *** NEW SECTION 8: SUPERVISION PAGE CONTENT ***
	// ============================================
	$wp_customize->add_section( 'cores_supervision_section', array(
		'title'       => __( 'Supervision Page Content', 'cores-theme' ),
		'description' => __( 'Edit all static content for the Supervision page.', 'cores-theme' ),
		'priority'    => 58,
	) );

	// --- "Why Join CORES?" ---
	for ( $i = 1; $i <= 4; $i++ ) {
		$wp_customize->add_setting( "cores_supervision_join_card_${i}_title", array(
			'default' => __( 'Card Title', 'cores-theme' ), 'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( "cores_supervision_join_card_${i}_title", array(
			'label' => sprintf( __( '"Why Join" Card %d: Title', 'cores-theme' ), $i ), 'section' => 'cores_supervision_section', 'type' => 'text',
		) );

		$wp_customize->add_setting( "cores_supervision_join_card_${i}_desc", array(
			'default' => __( 'Card description goes here.', 'cores-theme' ), 'sanitize_callback' => 'sanitize_textarea_field',
		) );
		$wp_customize->add_control( "cores_supervision_join_card_${i}_desc", array(
			'label' => sprintf( __( '"Why Join" Card %d: Description', 'cores-theme' ), $i ), 'section' => 'cores_supervision_section', 'type' => 'textarea',
		) );
	}

	// --- "Available Research Areas" ---
	for ( $i = 1; $i <= 6; $i++ ) {
		$wp_customize->add_setting( "cores_supervision_area_${i}_title", array(
			'default' => __( 'Area Title', 'cores-theme' ), 'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( "cores_supervision_area_${i}_title", array(
			'label' => sprintf( __( 'Research Area %d: Title', 'cores-theme' ), $i ), 'section' => 'cores_supervision_section', 'type' => 'text',
		) );

		$wp_customize->add_setting( "cores_supervision_area_${i}_desc", array(
			'default' => __( 'Area description goes here.', 'cores-theme' ), 'sanitize_callback' => 'sanitize_textarea_field',
		) );
		$wp_customize->add_control( "cores_supervision_area_${i}_desc", array(
			'label' => sprintf( __( 'Research Area %d: Description', 'cores-theme' ), $i ), 'section' => 'cores_supervision_section', 'type' => 'textarea',
		) );
	}

	// --- "How to Join" ---
	for ( $i = 1; $i <= 4; $i++ ) {
		$wp_customize->add_setting( "cores_supervision_how_step_${i}_title", array(
			'default' => __( 'Step Title', 'cores-theme' ), 'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( "cores_supervision_how_step_${i}_title", array(
			'label' => sprintf( __( '"How to Join" Step %d: Title', 'cores-theme' ), $i ), 'section' => 'cores_supervision_section', 'type' => 'text',
		) );

		$wp_customize->add_setting( "cores_supervision_how_step_${i}_desc", array(
			'default' => __( 'Step description goes here.', 'cores-theme' ), 'sanitize_callback' => 'sanitize_textarea_field',
		) );
		$wp_customize->add_control( "cores_supervision_how_step_${i}_desc", array(
			'label' => sprintf( __( '"How to Join" Step %d: Description', 'cores-theme' ), $i ), 'section' => 'cores_supervision_section', 'type' => 'textarea',
		) );
	}

	// --- "What We Look For" (Requirements) ---
	$wp_customize->add_setting( 'cores_supervision_req_list', array(
		'default'           => "Currently enrolled in Water Resources Engineering or related program\nMinimum GPA of 3.0 (preferred)\nStrong foundation in mathematics and physics\nAbility to commit to regular research activities",
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'cores_supervision_req_list', array(
		'label'    => __( 'Requirements List (One per line)', 'cores-theme' ),
		'section'  => 'cores_supervision_section',
		'type'     => 'textarea',
	) );

	// --- "What We Look For" (Skills) ---
	$wp_customize->add_setting( 'cores_supervision_skill_list', array(
		'default'           => "Enthusiasm for coastal science and fieldwork\nBasic programming skills (Python, MATLAB, or R)\nExperience with data analysis (preferred but not required)\nStrong teamwork and communication skills",
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'cores_supervision_skill_list', array(
		'label'    => __( 'Desired Skills List (One per line)', 'cores-theme' ),
		'section'  => 'cores_supervision_section',
		'type'     => 'textarea',
	) );


	// ============================================
	// SECTION 9: CONTACT INFORMATION (was 8)
	// ============================================
	$wp_customize->add_section( 'cores_contact_section', array(
		'title'    => __( 'Contact Information', 'cores-theme' ),
		'priority' => 60,
	) );

	// Email 1
	$wp_customize->add_setting( 'cores_email_1', array(
		'default'           => 'coastalresearchers@gmail.com',
		'sanitize_callback' => 'sanitize_email',
	) );

	$wp_customize->add_control( 'cores_email_1', array(
		'label'    => __( 'Email Address 1', 'cores-theme' ),
		'section'  => 'cores_contact_section',
		'type'     => 'email',
	) );

	// Email 2
	$wp_customize->add_setting( 'cores_email_2', array(
		'default'           => 'coastalresearchers@gmail.com',
		'sanitize_callback' => 'sanitize_email',
	) );

	$wp_customize->add_control( 'cores_email_2', array(
		'label'    => __( 'Email Address 2', 'cores-theme' ),
		'section'  => 'cores_contact_section',
		'type'     => 'email',
	) );

	// Phone 1
	$wp_customize->add_setting( 'cores_phone_1', array(
		'default'           => '+62 821 4279 3179',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'cores_phone_1', array(
		'label'    => __( 'Phone Number 1', 'cores-theme' ),
		'section'  => 'cores_contact_section',
		'type'     => 'text',
	) );

	// Phone 2
	$wp_customize->add_setting( 'cores_phone_2', array(
		'default'           => '+62 896 6579 9413',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'cores_phone_2', array(
		'label'    => __( 'Phone Number 2', 'cores-theme' ),
		'section'  => 'cores_contact_section',
		'type'     => 'text',
	) );

	// Address
	$wp_customize->add_setting( 'cores_address', array(
		'default'           => 'Water Resources Engineering Department, Brawijaya University, Jl. MT. Haryono No.167, Ketawanggede, Kec. Lowokwaru, Kota Malang, Jawa Timur 65145',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );

	$wp_customize->add_control( 'cores_address', array(
		'label'    => __( 'Address', 'cores-theme' ),
		'section'  => 'cores_contact_section',
		'type'     => 'textarea',
	) );


	// ============================================
	// SECTION 10: SOCIAL MEDIA LINKS (was 9)
	// ============================================
	$wp_customize->add_section( 'cores_social_section', array(
		'title'    => __( 'Social Media Links', 'cores-theme' ),
		'priority' => 70,
	) );

	// Facebook
	$wp_customize->add_setting( 'cores_facebook', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'cores_facebook', array(
		'label'    => __( 'Facebook URL', 'cores-theme' ),
		'section'  => 'cores_social_section',
		'type'     => 'url',
	) );

	// Twitter
	$wp_customize->add_setting( 'cores_twitter', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'cores_twitter', array(
		'label'    => __( 'Twitter URL', 'cores-theme' ),
		'section'  => 'cores_social_section',
		'type'     => 'url',
	) );

	// Instagram
	$wp_customize->add_setting( 'cores_instagram', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'cores_instagram', array(
		'label'    => __( 'Instagram URL', 'cores-theme' ),
		'section'  => 'cores_social_section',
		'type'     => 'url',
	) );

	// LinkedIn
	$wp_customize->add_setting( 'cores_linkedin', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'cores_linkedin', array(
		'label'    => __( 'LinkedIn URL', 'cores-theme' ),
		'section'  => 'cores_social_section',
		'type'     => 'url',
	) );

	// YouTube
	$wp_customize->add_setting( 'cores_youtube', array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'cores_youtube', array(
		'label'    => __( 'YouTube URL', 'cores-theme' ),
		'section'  => 'cores_social_section',
		'type'     => 'url',
	) );


	// ============================================
	// SECTION 11: COLOR SCHEME (was 10)
	// ============================================
	$wp_customize->add_section( 'cores_colors_section', array(
		'title'    => __( 'Color Scheme', 'cores-theme' ),
		'priority' => 80,
	) );

	// Primary Color
	$wp_customize->add_setting( 'cores_primary_color', array(
		'default'           => '#0A4D68',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cores_primary_color', array(
		'label'    => __( 'Primary Color', 'cores-theme' ),
		'section'  => 'cores_colors_section',
		'settings' => 'cores_primary_color',
	) ) );

	// Accent Color
	$wp_customize->add_setting( 'cores_accent_color', array(
		'default'           => '#05BFDB',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cores_accent_color', array(
		'label'    => __( 'Accent Color', 'cores-theme' ),
		'section'  => 'cores_colors_section',
		'settings' => 'cores_accent_color',
	) ) );

	// Secondary Color
	$wp_customize->add_setting( 'cores_secondary_color', array(
		'default'           => '#088395',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cores_secondary_color', array(
		'label'    => __( 'Secondary Color', 'cores-theme' ),
		'section'  => 'cores_colors_section',
		'settings' => 'cores_secondary_color',
	) ) );

}
add_action( 'customize_register', 'cores_customize_register' );


/**
 * Output custom CSS for color scheme
 */
function cores_customizer_css() {
	$primary   = get_theme_mod( 'cores_primary_color', '#0A4D68' );
	$accent    = get_theme_mod( 'cores_accent_color', '#05BFDB' );
	$secondary = get_theme_mod( 'cores_secondary_color', '#088395' );
	?>
	<style type="text/css">
		:root {
			--primary: <?php echo esc_attr( $primary ); ?>;
			--accent: <?php echo esc_attr( $accent ); ?>;
			--secondary: <?php echo esc_attr( $secondary ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'cores_customizer_css' );

?>