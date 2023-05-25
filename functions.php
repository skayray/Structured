<?php 

require get_template_directory() . '/template-functions/theme-options-menu.php';
 require get_template_directory() . '/template-functions/theme-customize-menu.php';
require get_template_directory() . '/template-functions/menu-walker.php';
require get_template_directory() . '/template-functions/duplicate-posts.php';
require get_template_directory() . '/template-functions/include-files.php';
require get_template_directory() . '/template-functions/svg-support.php';
require get_template_directory() . '/template-functions/disable_api.php';
require get_template_directory() . '/template-functions/disable-comments.php';
require get_template_directory() . '/template-functions/custom-login.php';
require get_template_directory() . '/template-functions/social-share-shortcode.php';
require get_template_directory() . '/template-features/analytics.php';

function dequeue_jquery_migrate( $scripts ) {
	if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
		$scripts->registered['jquery']->deps = array_diff(
			$scripts->registered['jquery']->deps,
			[ 'jquery-migrate' ]
		);
	}
}
add_action( 'wp_default_scripts', 'dequeue_jquery_migrate' );



function init_menus() {
  register_nav_menus(
	array(
	  'primary-menu' => __( 'Primary menu' )
	)
  );
}
add_action( 'init', 'init_menus' );



function init_scripts_and_styles() {
	// bootstrap
	wp_enqueue_style( 'bootstrap-5', get_template_directory_uri() . '/includes/bootstrap-5.1.3-dist/css/bootstrap.min.css', array(), 'v5.1.3', 'all' );
	wp_enqueue_script( 'bootstrap-5-js', get_template_directory_uri() . '/includes/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js', array('jquery'), 'v5.1.3', true );
	
	//$vers=define('THEME_VERSION', $theme->Version);
	$vers=rand();
	// theme style
	// wp_enqueue_style( 'structured-colors', get_template_directory_uri().'/colors.css', array(), '1.1', 'all' );
	wp_enqueue_style( 'structured-style', get_template_directory_uri().'/style-structured.css', array(), '1.10831', 'all' );
	wp_enqueue_style( 'default-or-child-style', get_stylesheet_uri(), array(), $vers, 'all' ); //if there is a child, inserts the child style

// font-awesome se non ho elementor

	// your code here
	wp_enqueue_style( 'font-awesome-5', get_template_directory_uri() . '/includes/fontawesome-free-5.15.4-web/css/all.min.css', array(), 'v5.15.4', 'all' );
	
	//jquery sticky
		wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/includes/jquery.sticky.js', array('jquery'), 'v1.0', true );
		wp_enqueue_style( 'chosen', get_template_directory_uri() . '/includes/chosen.min.css', array('jquery') );
		wp_enqueue_script( 'jquery-chosen', get_template_directory_uri() . '/includes/chosen.jquery.min.js', array('jquery'), 'v1.0', true );
	
		wp_enqueue_script( 'generic-scripts', get_template_directory_uri() . '/includes/generic-scripts.js', array('jquery'), 'v1.2', true );

	
		
}
add_action( 'wp_enqueue_scripts', 'init_scripts_and_styles' );

function init_theme_support() {
	// Add custom-logo support
	add_theme_support( 'custom-logo',array(
		'height' => 100,
		'width'  => 400,
		'flex-height' => true,
		'flex-width'  => true,
		
	) );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'postimage-thumb', 300, 300, true ); // 300x300 - cropped 
	add_image_size( 'postimage-big', 1200, 500 ); // 1200xunlimited - full 
	
}
add_action( 'after_setup_theme', 'init_theme_support');

function init_sidebars() {
	register_sidebar( array(
		'name'          => 'Left Sidebar',
		'id'            => 'sidebar-1',
		'description'   => 'Widgets in this area will be shown on the left of all posts and pages.',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'init_sidebars' );








//useful functions and features

function get_excerpt($limit=150, $source = null){
	$excerpt = $source == "content" ? get_the_content() : get_the_excerpt();
	$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, $limit);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	return $excerpt;
}

function structure_posted_on($args=array('author','date','edit')) {
		$html="";
		if ( is_sticky() && is_home() && ! is_paged() ) {
				$html.= '<span class="sticky-post"><i class="fas fa-thumbtack"></i> Sticky </span> ';
		}
		// Set up and print post meta information.
			
			if (in_array('date', $args)) $html.='<i class="fas fa-clock"></i> <span class="entry-date"><a href="'.esc_url( get_permalink() ).'" rel="bookmark"><time class="entry-date" datetime="'.esc_attr( get_the_date( 'c' ) ).'">'.esc_html( get_the_date() ).'</time></a></span> ';
			if (in_array('author', $args)) $html.='<i class="fas fa-user"></i> <span class="author vcard"><a class="url fn n" href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" rel="author">'.get_the_author().'</a></span> ';
			if (in_array('edit', $args) && get_edit_post_link()) $html.='<i class="fas fa-pen"></i> <a href="'.get_edit_post_link().'" > edit post</a>';
			echo $html;
		
}

