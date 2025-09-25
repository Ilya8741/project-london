<?php
/**
 * project-london functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package project-london
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.1.5' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function project_london_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on project-london, use a find and replace
		* to change 'project-london' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'project-london', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'project-london' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'project_london_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'project_london_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function project_london_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'project_london_content_width', 640 );
}
add_action( 'after_setup_theme', 'project_london_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function project_london_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'project-london' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'project-london' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'project_london_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function project_london_scripts() {
  wp_enqueue_style(
    'theme-fonts',
    get_stylesheet_directory_uri() . '/assets/css/fonts.css',
    [],
    filemtime(get_stylesheet_directory() . '/assets/css/fonts.css')
  );

  wp_enqueue_style('project-london-style', get_stylesheet_uri(), [], _S_VERSION);
  wp_style_add_data('project-london-style', 'rtl', 'replace');

  wp_enqueue_style(
    'project-london-custom',
    get_template_directory_uri() . '/assets/css/custom.css',
    ['project-london-style', 'theme-fonts'],
    _S_VERSION
  );

  wp_enqueue_script(
    'project-london-burger',
    get_template_directory_uri() . '/assets/js/header-menu.js',
    [],
    _S_VERSION,
    true
  );

  wp_enqueue_style(
    'swiper-css',
    'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
    [],
    '11.0.0'
  );
  wp_enqueue_script(
    'swiper-js',
    'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
    [],
    '11.0.0',
    true
  );
  wp_enqueue_script(
    'project-london-swiper-init',
    get_template_directory_uri() . '/assets/js/swiper-init.js',
    ['swiper-js'],
    _S_VERSION,
    true
  );

  wp_enqueue_script(
    'project-london-navigation',
    get_template_directory_uri() . '/js/navigation.js',
    [],
    _S_VERSION,
    true
  );

  if ( is_singular() && comments_open() && get_option('thread_comments') ) {
    wp_enqueue_script('comment-reply');
  }
}
add_action('wp_enqueue_scripts', 'project_london_scripts');


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

// ACF JSON sync
add_filter('acf/settings/save_json', function () {
    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function ($paths) {
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});

if ( function_exists('acf_add_options_page') ) {
  acf_add_options_page([
    'page_title' => 'Theme Settings',
    'menu_title' => 'Theme Settings',
    'menu_slug'  => 'theme-settings',
    'redirect'   => false,
  ]);

  // HEADER
  acf_add_options_sub_page([
    'page_title' => 'Header',
    'menu_title' => 'Header',
    'parent_slug'=> 'theme-settings',
    'post_id'    => 'header_options', 
  ]);

  // FOOTER
  acf_add_options_sub_page([
    'page_title' => 'Footer',
    'menu_title' => 'Footer',
    'parent_slug'=> 'theme-settings',
    'post_id'    => 'footer_options',
  ]);
}

add_filter('upload_mimes', function ($mimes) {
    if ( current_user_can('administrator') ) {
        $mimes['svg'] = 'image/svg+xml';
        $mimes['svgz'] = 'image/svg+xml';
    }
    return $mimes;
});
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes, $real_mime = null) {
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if ( in_array($ext, ['svg','svgz'], true) ) {
        $data['ext'] = 'svg';
        $data['type'] = 'image/svg+xml';
        $data['proper_filename'] = $filename;
    }
    return $data;
}, 10, 5);
