<?php
/**
 * wptheme04 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wptheme04
 */

if ( ! function_exists( 'wptheme04_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wptheme04_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wptheme04, use a find and replace
		 * to change 'wptheme04' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wptheme04', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'img600x355', 600, 355, true );
		add_image_size( 'img300x200', 300, 200, true );
		add_image_size( 'img230x180', 230, 180, true );		

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'wptheme04' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'wptheme04_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'wptheme04_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wptheme04_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'wptheme04_content_width', 640 );
}
add_action( 'after_setup_theme', 'wptheme04_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wptheme04_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wptheme04' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wptheme04' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wptheme04_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wptheme04_scripts() {
	wp_enqueue_style( 'wptheme04-style', get_stylesheet_uri() );

	wp_enqueue_style( 'wptheme04-fonts', 'https://fonts.googleapis.com/css?family=Righteous');

	wp_enqueue_script('jquery');
	wp_enqueue_script('wptheme04-my-jquery', 'https://code.jquery.com/jquery-1.12.4.min.js', false);

	//wp_enqueue_script( 'wptheme04-match-height', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js', array(), '20151215', true );

	wp_enqueue_script( 'wptheme04-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'wptheme04-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script('wptheme04-custom-js', get_template_directory_uri() . '/js/script.js');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wptheme04_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

include get_template_directory() . '/inc/plugin-activation/plugin-activation.php';
include get_template_directory() . '/inc/class-tgm-plugin-activation.php';


/**
 * Create title section widget
 */
class company_Info_Table_Widget extends WP_Widget {
 
	function __construct() {
		$widget_options = array(
			'classname' => 'company_info_register_widgets',
			'description' => 'Add data table information.'
		);
		parent::__construct( 
			'company_info_register_widgets', 
			'Company Info List', 
			$widget_options
		);
	}

	// create the widget output
	function widget( $args, $instance ) {
	
		$title = apply_filters( 'widget_title', $instance[ 'title' ] );
		$content_data = apply_filters( 'widget_title', $instance[ 'content_data' ] );
		
		echo '<div class="info-item"><div class="info-title">'.$title.'</div><div class="info-details">'.$content_data.'</div></div>';
		
		// echo '<h2 class="title-sec">'. $args['before_widget'] . $args['before_title'] . $title . '<span>' . $en_title . '</span>' . $args['after_title'];

		// echo $args['after_widget'].'</h2>';
	}

	function form( $instance ) { 
		$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ) ?>" class="siteorigin-widget-field-label"><?php _e( 'Header Data', 'siteorigin-panels' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'content_data' ); ?>" class="siteorigin-widget-field-label"><?php _e( 'Text Data', 'siteorigin-panels' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'content_data' ); ?>" name="<?php echo $this->get_field_name( 'content_data' ); ?>" value="<?php echo esc_attr($instance['content_data']) ?>" />
		</p><?php
	}

	// Update database with new info
	function update( $new_instance, $old_instance ) { 
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'content_data' ] = strip_tags( $new_instance[ 'content_data' ] );

		return $instance;
	}
}

// register the widget
function title_sec_register_widgets() { 
	register_widget('company_Info_Table_Widget');
}
add_action( 'widgets_init', 'title_sec_register_widgets' );


/**
 * Add some plugins to TGM plugin activation
 */
function wptheme04_recommended_plugins(){
	$plugins = array(
		array(
			'name'      => __('SiteOrigin Page Builder', 'wptheme04'),
			'slug'      => 'siteorigin-panels',
			'required'  => false,
		),
		array(
			'name'      => __('SiteOrigin Widgets Bundle', 'wptheme04'),
			'slug'      => 'so-widgets-bundle',
			'required'  => false,
		),
		array(
			'name'      => __('Breadcrumb NavXT', 'wptheme04'),
			'slug'      => 'breadcrumb-navxt',
			'required'  => false,
		),
	);

	$config = array(
		'id'           => 'tgmpa-wptheme04',         // Unique ID for hashing notices for multiple instances of TGMPA.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'wptheme04_recommended_plugins' );