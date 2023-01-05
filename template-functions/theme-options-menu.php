<?php 

 
function theme_config_menu() {
 
	add_theme_page(
		'Theme options',            // The title to be displayed in the browser window for this page.
		'Theme options',            // The text to be displayed for this menu item
		'manage_options',            // Which type of users can see this menu item
		'structured_theme_options',    // The unique ID - that is, the slug - for this menu item
		'display_structured_options'     // The name of the function to call when rendering this menu's page
	);
 
} // end theme_config_menu
add_action( 'admin_menu', 'theme_config_menu' );
 
/**
 * Renders a simple page to display for the theme menu defined above.
 */
function display_structured_options() {
?>
	<!-- Create a header in the default WordPress 'wrap' container -->
	<div class="wrap">
	 
		<div id="icon-themes" class="icon32"></div>
		<h2>Structured Theme Options</h2>
		<?php settings_errors(); ?>
		 
		<form method="post" action="options.php">
<?php do_settings_sections( 'structured-options' ); ?>         
			<?php settings_fields( 'structured-options' ); ?>
			<?php submit_button(); ?>
		</form>
		 
	</div><!-- /.wrap -->
<?php
} // end structured_theme_display
 
 

function structured_initialize_sect1() {
 
	// If the theme options don't exist, create them.
	if( false == get_option( 'structured-options' ) ) {  
		add_option( 'structured-options' );
	} // end if
 
	// First, we register a section. This is necessary since all future options must belong to a 
	add_settings_section(
		'settings_section_one',         // ID used to identify this section and with which to register options
		'Open Graph and meta options',                  // Title to be displayed on the administration page
		'display_section_message1', // Callback used to render the description of the section
		'structured-options'     // Page on which to add this section of options
	);
	 
	// Next, we'll introduce the fields for toggling the visibility of content elements.
	add_settings_field( 
		'og_image_field',                      // ID used to identify the field throughout the theme
		'OG:image / twitter:image metatag  (OG and more)',                           // The label to the left of the option interface element
		'render_og_image_input',   // The name of the function responsible for rendering the option interface
		'structured-options',    // The page on which this option will be displayed
		'settings_section_one',         // The name of the section to which this field belongs
		array(                              // The array of arguments to pass to the callback. In this case, just a description.
			'Insert the url of an image with this proportion 1.91:1.'
		)
	);
	
	 
	 
	// Finally, we register the fields with WordPress
	register_setting(
		'structured-options',
		'structured-options'
	);
	 
} // end structured_initialize_structured_initialize_sect1
add_action('admin_init', 'structured_initialize_sect1');
 
 function display_section_message1() {
	 echo '
	<p>og:title = will be the title of the page<br>
	og:description = will be the first 60 chars of the post<br>
	og:site_name = will be the website title</p>	 		 
		 ';
 } // end structured_general_options_callback
   
function render_og_image_input($args) {
	// First, we read the options collection
	$options = get_option('structured-options');
	// Next, we update the name attribute to access this element's ID in the context of the display options array
	// We also access the show_header element of the options collection in the call to the checked() helper function
	$html = '<label for="og_image_field"> '  . $args[0] . '</label><br>'; 	
	$html .= '<input  type="text" id="og_image_field" name="structured-options[og_image_field]" value='. $options['og_image_field'].'>'; 	 
	// Here, we'll take the first argument of the array and add it to a label next to the checkbox
	echo $html;
} // end structured_toggle_header_callback


// second section

function structured_initialize_sect2() {
 
	// If the theme options don't exist, create them.
	if( false == get_option( 'structured-options' ) ) {  
		add_option( 'structured-options' );
	} // end if
 
	// First, we register a section. This is necessary since all future options must belong to a 
	add_settings_section(
		'settings_section_two',         // ID used to identify this section and with which to register options
		'Google Analytics options',                  // Title to be displayed on the administration page
		'display_section_message2', // Callback used to render the description of the section
		'structured-options'     // Page on which to add this section of options
	);
	 
	// Next, we'll introduce the fields for toggling the visibility of content elements.
	add_settings_field( 
	'ga_activate_input',                      // ID used to identify the field throughout the theme
	'Activate analytics',                           // The label to the left of the option interface element
	'render_ga_activate_input',   // The name of the function responsible for rendering the option interface
	'structured-options',    // The page on which this option will be displayed
	'settings_section_two'         // The name of the section to which this field belongs
	);
	add_settings_field( 
		'ga_id_input',                      // ID used to identify the field throughout the theme
		'Analytics field',                           // The label to the left of the option interface element
		'render_ga_id_input',   // The name of the function responsible for rendering the option interface
		'structured-options',    // The page on which this option will be displayed
		'settings_section_two',         // The name of the section to which this field belongs
		array(                              // The array of arguments to pass to the callback. In this case, just a description.
			'Insert the Analytics id ie. UA-1234-123'
		)

	);
	
	 
	 
	// Finally, we register the fields with WordPress
	register_setting(
		'structured-options',
		'ga_activate',
		'ga_id_input'
	);
	 
} // end structured_initialize_structured_initialize_sect1
add_action('admin_init', 'structured_initialize_sect2');

 
 function display_section_message2() {
	 echo '
<p style="margin:0">The Google analytics script is anonymized </p>		 ';
 } // end structured_general_options_callback
   
function render_ga_activate_input($args) {
	// First, we read the options collection
	$options = get_option('structured-options');
	$html .= '<input type="checkbox" id="ga_activate_input" name="structured-options[ga_activate_input]" value="1" '.  checked(1,  $options['ga_activate_input'], false) .'>'; 	 
	echo $html;
} 

   
function render_ga_id_input($args) {
	$options = get_option('structured-options');
	$html = '<label for="ga_id_input"> '  . $args[0] . '</label><br>'; 	
	$html .= '<input type="text" id="ga_id_input" name="structured-options[ga_id_input]" value='. $options['ga_id_input'].'>'; 	 
	echo $html;
} 


// second section

function structured_initialize_sect3() {
 
	// If the theme options don't exist, create them.
	if( false == get_option( 'structured-options' ) ) {  
		add_option( 'structured-options' );
	} // end if
 
	// First, we register a section. This is necessary since all future options must belong to a 
	add_settings_section(
		'settings_section_three',         // ID used to identify this section and with which to register options
		'FB Pixel options',                  // Title to be displayed on the administration page
		'display_section_message3', // Callback used to render the description of the section
		'structured-options'     // Page on which to add this section of options
	);
	 
	// Next, we'll introduce the fields for toggling the visibility of content elements.
	add_settings_field( 
	'fbpixel_activate_input',                      // ID used to identify the field throughout the theme
	'Activate Pixel',                           // The label to the left of the option interface element
	'render_fbpixel_activate_input',   // The name of the function responsible for rendering the option interface
	'structured-options',    // The page on which this option will be displayed
	'settings_section_three'         // The name of the section to which this field belongs
	);
	add_settings_field( 
		'fbpixel_id_input',                      // ID used to identify the field throughout the theme
		'Analytics field',                           // The label to the left of the option interface element
		'render_fbpixel_id_input',   // The name of the function responsible for rendering the option interface
		'structured-options',    // The page on which this option will be displayed
		'settings_section_three',         // The name of the section to which this field belongs
		array(                              // The array of arguments to pass to the callback. In this case, just a description.
			'Insert the pixel id ie. 12345467'
		)

	);
	
	 
	 
	// Finally, we register the fields with WordPress
	register_setting(
		'structured-options',
		'fbpixel_activate',
		'fbpixel_id_input'
	);
	 
} // end structured_initialize_structured_initialize_sect1
add_action('admin_init', 'structured_initialize_sect3');

 
   
function render_fbpixel_activate_input($args) {
	// First, we read the options collection
	$options = get_option('structured-options');
	$html .= '<input type="checkbox" id="fbpixel_activate_input" name="structured-options[fbpixel_activate_input]" value="1" '.  checked(1,  $options['fbpixel_activate_input'], false) .'>'; 	 
	echo $html;
} 

   
function render_fbpixel_id_input($args) {
	$options = get_option('structured-options');
	$html = '<label for="fbpixel_id_input"> '  . $args[0] . '</label><br>'; 	
	$html .= '<input type="text" id="fbpixel_id_input" name="structured-options[fbpixel_id_input]" value='. $options['fbpixel_id_input'].'>'; 	 
	echo $html;
} 

//fine pixel

//matomo
function structured_initialize_sect4() {
 
	// If the theme options don't exist, create them.
	if( false == get_option( 'structured-options' ) ) {  
		add_option( 'structured-options' );
	} // end if
 
	// First, we register a section. This is necessary since all future options must belong to a 
	add_settings_section(
		'settings_section_four',         // ID used to identify this section and with which to register options
		'Matomo options',                  // Title to be displayed on the administration page
		'display_section_message4', // Callback used to render the description of the section
		'structured-options'     // Page on which to add this section of options
	);
	 
	// Next, we'll introduce the fields for toggling the visibility of content elements.
	add_settings_field( 
	'matomo_activate_input',                      // ID used to identify the field throughout the theme
	'Activate matomo',                           // The label to the left of the option interface element
	'render_matomo_activate_input',   // The name of the function responsible for rendering the option interface
	'structured-options',    // The page on which this option will be displayed
	'settings_section_four'         // The name of the section to which this field belongs
	);
	add_settings_field( 
		'matomo_id_input',                      // ID used to identify the field throughout the theme
		'Analytics field',                           // The label to the left of the option interface element
		'render_matomo_id_input',   // The name of the function responsible for rendering the option interface
		'structured-options',    // The page on which this option will be displayed
		'settings_section_four',         // The name of the section to which this field belongs
		array(                              // The array of arguments to pass to the callback. In this case, just a description.
			'Insert the Matomo site-id ie. 2'
		)

	);
	
	 
	 
	// Finally, we register the fields with WordPress
	register_setting(
		'structured-options',
		'matomo_activate',
		'matomo_id_input'
	);
	 
} // end structured_initialize_structured_initialize_sect4
add_action('admin_init', 'structured_initialize_sect4');

 
 function display_section_message4() {
	 echo '
<p>Enable Matomo</p>		 ';
 } // end structured_general_options_callback
   
function render_matomo_activate_input($args) {
	// First, we read the options collection
	$options = get_option('structured-options');
	$html .= '<input type="checkbox" id="matomo_activate_input" name="structured-options[matomo_activate_input]" value="1" '.  checked(1,  $options['matomo_activate_input'], false) .'>'; 	 
	echo $html;
} 

   
function render_matomo_id_input($args) {
	$options = get_option('structured-options');
	$html = '<label for="matomo_id_input"> '  . $args[0] . '</label><br>'; 	
	$html .= '<input type="text" id="matomo_id_input" name="structured-options[matomo_id_input]" value='. $options['matomo_id_input'].'>'; 	 
	echo $html;
} 

//metricool
function structured_initialize_sect5() {
 
	// If the theme options don't exist, create them.
	if( false == get_option( 'structured-options' ) ) {  
		add_option( 'structured-options' );
	} // end if
 
	// First, we register a section. This is necessary since all future options must belong to a 
	add_settings_section(
		'settings_section_five',         // ID used to identify this section and with which to register options
		'Metricool options',                  // Title to be displayed on the administration page
		'display_section_message5', // Callback used to render the description of the section
		'structured-options'     // Page on which to add this section of options
	);
	 
	// Next, we'll introduce the fields for toggling the visibility of content elements.
	add_settings_field( 
	'matomo_activate_input',                      // ID used to identify the field throughout the theme
	'Activate Metricool',                           // The label to the left of the option interface element
	'render_metricool_activate_input',   // The name of the function responsible for rendering the option interface
	'structured-options',    // The page on which this option will be displayed
	'settings_section_five'         // The name of the section to which this field belongs
	);
	add_settings_field( 
		'metricool_id_input',                      // ID used to identify the field throughout the theme
		'Metricool hash',                           // The label to the left of the option interface element
		'render_metricool_id_input',   // The name of the function responsible for rendering the option interface
		'structured-options',    // The page on which this option will be displayed
		'settings_section_five',         // The name of the section to which this field belongs
		array(                              // The array of arguments to pass to the callback. In this case, just a description.
			'Insert the Metricool hash ie. 10be9eee554491898e599417dcc66f63'
		)

	);
	
	 
	 
	// Finally, we register the fields with WordPress
	register_setting(
		'structured-options',
		'metricool_activate',
		'metricool_id_input'
	);
	 
} // end structured_initialize_structured_initialize_sect4
add_action('admin_init', 'structured_initialize_sect5');

 
 function display_section_messag5() {
	 echo '
<p>Enable Metricool</p>		 ';
 } // end structured_general_options_callback
   
function render_metricool_activate_input($args) {
	// First, we read the options collection
	$options = get_option('structured-options');
	$html .= '<input type="checkbox" id="metricool_activate_input" name="structured-options[metricool_activate_input]" value="1" '.  checked(1,  $options['metricool_activate_input'], false) .'>'; 	 
	echo $html;
} 

   
function render_metricool_id_input($args) {
	$options = get_option('structured-options');
	$html = '<label for="metricool_id_input"> '  . $args[0] . '</label><br>'; 	
	$html .= '<input type="text" id="metricool_id_input" name="structured-options[metricool_id_input]" value='. $options['metricool_id_input'].'>'; 	 
	echo $html;
} 

?>