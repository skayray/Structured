<?php 
// TO BE DONE.
add_action('customize_register','init_customizer');
/*
 * Add in our custom Accent Color setting and control to be used in the Customizer in the Colors section
 *
 */
function init_customizer( $wp_customize ) {

$wp_customize->add_setting(
	  'primary_color', //give it an ID
	  array(
		  'default' => '#0d6efd', // Give it a default
	  )
  );
  $wp_customize->add_control(
	 new WP_Customize_Color_Control(
		 $wp_customize,
		 'primary_color', //give it an ID
		 array(
			 'label'      => __( 'Primary color', 'structured' ), //set the label to appear in the Customizer
			 'section'    => 'colors', //select the section for it to appear under  
			 'settings'   => 'primary_color' //pick the setting it applies to
		 )
	 )
  );

}

add_action( 'wp_enqueue_scripts', 'mytheme_customizer_css', 100 );
/**
 * Output CSS for background image with wp_add_inline_style
 */
function mytheme_customizer_css() {
	$handle = 'bootstrap-5';  // Swap in your CSS Stylesheet ID
	//$css = '';
	$accent_color = get_theme_mod( 'primary_color' ); // Assigning it to a variable to keep the markup clean.
	$css = ( $accent_color !== '') ? sprintf('
	:root {
		--bs-primary-rgb : %s;
	}
	', $accent_color ) : '';
	if ( $css ) {
	wp_add_inline_style( $handle  , $css );
	}
}