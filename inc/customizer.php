<?php
/**
 * CORES Theme Customizer
 *
 * This file adds customization options to WordPress Customizer
 * allowing users to modify theme settings without coding.
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
	// SECTION 2: HERO SLIDER IMAGES
	// ============================================
	$wp_customize->add_section( 'cores_hero_section', array(
		'title'       => __( 'Hero Slider Images', 'cores-theme' ),
		'description' => __( 'Upload 3 images for the homepage hero slider.', 'cores-theme' ),
		'priority'    => 40,
	) );

	// Slide 1 Image
	$wp_customize->add_setting( 'cores_hero_slide_1', array(
		'default'           => 'https://picsum.photos/seed/coastal-horizon/1920/1080.jpg',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cores_hero_slide_1', array(
		'label'    => __( 'Slide 1 Image (Explore Our Research)', 'cores-theme' ),
		'section'  => 'cores_hero_section',
		'settings' => 'cores_hero_slide_1',
	) ) );

	// Slide 1 Title
	$wp_customize->add_setting( 'cores_hero_slide_1_title', array(
		'default'           => 'Welcome to Our Coastal Horizon',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'cores_hero_slide_1_title', array(
		'label'    => __( 'Slide 1 Title', 'cores-theme' ),
		'section'  => 'cores_hero_section',
		'type'     => 'text',
	) );

	// Slide 1 Description
	$wp_customize->add_setting( 'cores_hero_slide_1_desc', array(
		'default'           => 'Exploring the dynamics of coastal ecosystems through innovative research and technology',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );

	$wp_customize->add_control( 'cores_hero_slide_1_desc', array(
		'label'    => __( 'Slide 1 Description', 'cores-theme' ),
		'section'  => 'cores_hero_section',
		'type'     => 'textarea',
	) );

	// Slide 2 Image
	$wp_customize->add_setting( 'cores_hero_slide_2', array(
		'default'           => 'https://picsum.photos/seed/coastal-research/1920/1080.jpg',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cores_hero_slide_2', array(
		'label'    => __( 'Slide 2 Image (Discover Our Work)', 'cores-theme' ),
		'section'  => 'cores_hero_section',
		'settings' => 'cores_hero_slide_2',
	) ) );

	// Slide 2 Title
	$wp_customize->add_setting( 'cores_hero_slide_2_title', array(
		'default'           => 'What We Research For?',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'cores_hero_slide_2_title', array(
		'label'    => __( 'Slide 2 Title', 'cores-theme' ),
		'section'  => 'cores_hero_section',
		'type'     => 'text',
	) );

	// Slide 2 Description
	$wp_customize->add_setting( 'cores_hero_slide_2_desc', array(
		'default'           => 'Understanding coastal processes to protect our shorelines and communities',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );

	$wp_customize->add_control( 'cores_hero_slide_2_desc', array(
		'label'    => __( 'Slide 2 Description', 'cores-theme' ),
		'section'  => 'cores_hero_section',
		'type'     => 'textarea',
	) );

	// Slide 3 Image
	$wp_customize->add_setting( 'cores_hero_slide_3', array(
		'default'           => 'https://picsum.photos/seed/cores-team/1920/1080.jpg',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cores_hero_slide_3', array(
		'label'    => __( 'Slide 3 Image (Get to Know Us)', 'cores-theme' ),
		'section'  => 'cores_hero_section',
		'settings' => 'cores_hero_slide_3',
	) ) );

	// Slide 3 Title
	$wp_customize->add_setting( 'cores_hero_slide_3_title', array(
		'default'           => 'Meet Our Team',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'cores_hero_slide_3_title', array(
		'label'    => __( 'Slide 3 Title', 'cores-theme' ),
		'section'  => 'cores_hero_section',
		'type'     => 'text',
	) );

	// Slide 3 Description
	$wp_customize->add_setting( 'cores_hero_slide_3_desc', array(
		'default'           => 'Passionate researchers dedicated to advancing coastal science',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );

	$wp_customize->add_control( 'cores_hero_slide_3_desc', array(
		'label'    => __( 'Slide 3 Description', 'cores-theme' ),
		'section'  => 'cores_hero_section',
		'type'     => 'textarea',
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
	// SECTION 4: CONTACT INFORMATION
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
	// SECTION 5: SOCIAL MEDIA LINKS
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
	// SECTION 6: COLOR SCHEME
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