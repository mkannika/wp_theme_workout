<?php
/**
 * wptheme04 Theme Customizer
 *
 * @package wptheme04
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wptheme04_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'wptheme04_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'wptheme04_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'wptheme04_customize_register' );

// Custom Customizer
function wptheme04_customize($wp_customize){

	/**
	 * Contact section
	 */
	$wp_customize->add_section( 'wptheme04_contact_section',
		 array(
			'title' => __( 'Site Contact' ),
			'description' => esc_html__( 'These are global information for website.' ),
			'panel' => '', // Only needed if adding your Section to a Panel
			'priority' => 160, // Not typically needed. Default is 160
			'capability' => 'edit_theme_options', // Not typically needed. Default is edit_theme_options
			'theme_supports' => '', // Rarely needed
			'active_callback' => '', // Rarely needed
			'description_hidden' => 'false', // Rarely needed. Default is False
		 )
	);

	// Telephone
	$wp_customize->add_setting( 'wptheme04_telephone', array(
		'default' => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'wptheme04_sanitize_strip_slashes',
	) );

	$wp_customize->add_control( 'wptheme04_telephone', array(
		'type' => 'text',
		'section' => 'wptheme04_contact_section',
		'label' => __( 'Telephone' ),
		'description' => __('Ex. 020-222222', 'wptheme04' ),
	) );

	// Fax number
	$wp_customize->add_setting( 'wptheme04_fax', array(
		'default' => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'wptheme04_sanitize_strip_slashes',
	) );

	$wp_customize->add_control( 'wptheme04_fax', array(
		'type' => 'text',
		'section' => 'wptheme04_contact_section',
		'label' => __( 'Fax' ),
		'description' => __('Ex. 021-333333', 'wptheme04' ),
	) );

	// Contact time
	$wp_customize->add_setting( 'wptheme04_text_time', array(
		'default' => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'wptheme04_sanitize_strip_slashes',
	) );

	$wp_customize->add_control( 'wptheme04_text_time', array(
		'type' => 'text',
		'section' => 'wptheme04_contact_section',
		'label' => __( 'Contact time' ),
		'description' => __('Ex. 09:00〜18:00', 'wptheme04' ),
	) );

	// Copyright
	$wp_customize->add_setting( 'wptheme04_copyright', array(
	  'default' => '',
	  'transport'   => 'refresh',
	  'sanitize_callback' => 'wptheme04_sanitize_strip_slashes',
	) );

	$wp_customize->add_control( 'wptheme04_copyright', array(
	  'type' => 'text',
	  'section' => 'wptheme04_contact_section', // // Add a default or your own section
	  'label' => __( 'Copyright' ),
	  'description' => __( 'Add your copyright text' ),
	) );

}
add_action('customize_register','wptheme04_customize');


if( !function_exists('wptheme04_theme_settings') ) :
/**
 * Setup theme settings.
 *
 * @since wptheme04 1.0
 */
function wptheme04_theme_settings(){
	$settings = SiteOrigin_Settings::single();

	/**
	 * Blog Settings
	 */

	$settings->add_field('blog', 'archive_layout', 'select', __('Blog Archive Layout', 'wptheme04'), array(
		'options' => wptheme04_blog_layout_options(),
		'description' => __('Choose the layout to be used on blog and archive pages.', 'wptheme04')
	) );

	// $settings->add_field('blog', 'archive_content', 'select', __('Post Content', 'wptheme04'), array(
	// 	'options' => array(
	// 		'full' => __('Full Post', 'wptheme04'),
	// 		'excerpt' => __('Post Excerpt', 'wptheme04'),
	// 	),
	// 	'description' => __('Choose how to display posts on post archive when using default blog layout.', 'wptheme04'),
	// ));

	$settings->add_field('blog', 'excerpt_length', 'number', __('Excerpt Length', 'wptheme04'), array(
		'description' => __('If no manual post excerpt is added one will be generated. How many words should it be? Only applicable if Post Excerpt has been selected from the Post Content setting.', 'wptheme04'),
		'sanitize_callback' => 'absint'
	) );


}
endif;
add_action('siteorigin_settings_init', 'wptheme04_theme_settings');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wptheme04_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wptheme04_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


/**
 * Adds sanitization callback function: Strip Slashes
 * @package Activello
 */
function wptheme04_sanitize_strip_slashes($input) {
	return wp_kses_stripslashes($input);
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wptheme04_customize_preview_js() {
	wp_enqueue_script( 'wptheme04-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'wptheme04_customize_preview_js' );
