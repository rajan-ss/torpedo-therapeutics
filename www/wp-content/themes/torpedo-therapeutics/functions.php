<?php
/**
 * Torpedo Therapeutics functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Torpedo_Therapeutics
 */

if ( ! function_exists( 'torpedo_therapeutics_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function torpedo_therapeutics_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Torpedo Therapeutics, use a find and replace
		 * to change 'torpedo-therapeutics' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'torpedo-therapeutics', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'nav-pri' => esc_html__( 'Primary', 'torpedo-therapeutics' ),
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
		add_theme_support( 'custom-background', apply_filters( 'torpedo_therapeutics_custom_background_args', array(
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
add_action( 'after_setup_theme', 'torpedo_therapeutics_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function torpedo_therapeutics_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'torpedo_therapeutics_content_width', 640 );
}
add_action( 'after_setup_theme', 'torpedo_therapeutics_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function torpedo_therapeutics_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'torpedo-therapeutics' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'torpedo-therapeutics' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'torpedo_therapeutics_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function torpedo_therapeutics_scripts() {
	wp_enqueue_style( 'torpedo-therapeutics-style', get_stylesheet_uri() );
	add_action( 'wp_head', function(){ echo '<script>var ss;</script>'; } ); // don't remove
	wp_enqueue_script( 'torpedo-therapeutics-bundle', get_template_directory_uri() . '/js/bundle.js', array('jquery'), null, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'torpedo_therapeutics_scripts' );

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


/*
 * Brand functionality.
*/
add_filter('get_custom_logo', 'ss_logo_class_name');
function ss_logo_class_name($html){
	$html = str_replace('custom-logo', 'navbar-brand', $html);
	$html = str_replace('custom-logo-link', 'navbar-brand', $html);

	return $html;
}
function get_brand(){
	if(get_custom_logo()):
		the_custom_logo();
	else:
		$img = array('logo.svg','logo.png','logo.jpg');
		$brand = '<span>'.get_bloginfo('name').'</span>';
		foreach ($img as $logo){
			if(file_exists(get_template_directory().'/img/'.$logo)){
				$brand = '<img src="'.get_template_directory_uri().'/img/'.$logo.'" alt="'.get_bloginfo('name').'">';
			}elseif(file_exists(get_template_directory().'/images/'.$logo)){
				$brand = '<img src="'.get_template_directory_uri().'/images/'.$logo.'" alt="'.get_bloginfo('name').'">';
			}
		}
		return '<a class="navbar-brand" href="'.esc_url(home_url('/')).'">'.$brand.'</a>';
	endif;
	return false;
}
function the_brand(){ echo get_brand(); }

/**
 * Load Custom Login with Ajax
 */
//require get_template_directory() . '/inc/custom-login.php';

/**
 * Load Custom Nav Walker.
 */
if(!file_exists( get_template_directory() . '/inc/ss-bootstrap-navwalker.php')){
	wp_die('<div style="text-align:center"><h1 style="font-weight:normal">Custom Walker Nav Not Found</h1><p>Opps we have got error!<br>It appears the bootstrap-navwalker.php file may be missing.</p></div>','Custom Walker Nav Not Found');
}else{
	require_once get_template_directory() . '/inc/ss-bootstrap-navwalker.php';
}

/**
 * Load Custom Breadcrumbs.
 */
if(!file_exists( get_template_directory() . '/inc/ss-breadcrumbs.php')){
	wp_die('<div style="text-align:center"><h1 style="font-weight:normal">Breadcrumbs Not Found</h1><p>Opps we have got error!<br>It appears the breadcrumbs.php file may be missing.</p></div>','Breadcrumbs Not Found');
}else{
	require_once get_template_directory() . '/inc/ss-breadcrumbs.php';
}

/*
 * Image
 */
function get_svg_tpl($width=null, $height=null){
	return '<svg class="svg img-fluid" viewBox="0 0 '.$width.' '.$height.'" width="'.$width.'" height="'.$height.'"></svg>';
}

/**
 * ACF
 */
if(function_exists( 'acf_add_options_page' )){
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));	
}