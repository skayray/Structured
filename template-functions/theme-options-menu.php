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
 
//cookie banner 

function structured_initialize_sect0() {
 
	// If the theme options don't exist, create them.
	if( false == get_option( 'structured-options' ) ) {  
		add_option( 'structured-options' );
	} // end if
 
	// First, we register a section. This is necessary since all future options must belong to a 
	add_settings_section(
		'settings_section_zero',         // ID used to identify this section and with which to register options
		'Cookie banner',                  // Title to be displayed on the administration page
		'display_section_message0', // Callback used to render the description of the section
		'structured-options'     // Page on which to add this section of options
	);
	 
	// Next, we'll introduce the fields for toggling the visibility of content elements.
	add_settings_field( 
	'cookie_activate_input',                      // ID used to identify the field throughout the theme
	'Activate Cookie banner control',                           // The label to the left of the option interface element
	'render_cookie_activate_input',   // The name of the function responsible for rendering the option interface
	'structured-options',    // The page on which this option will be displayed
	'settings_section_zero'         // The name of the section to which this field belongs
	);
	add_settings_field( 
		'cookie_page_slug_input',                      // ID used to identify the field throughout the theme
		'Cookie policy page id',                           // The label to the left of the option interface element
		'render_cookie_page_slug_input',   // The name of the function responsible for rendering the option interface
		'structured-options',    // The page on which this option will be displayed
		'settings_section_zero',         // The name of the section to which this field belongs
		array(                              // The array of arguments to pass to the callback. In this case, just a description.
			'insert the page slug of the cookie policy page'
		)

	);
	
	 
	 
	// Finally, we register the fields with WordPress
	register_setting(
		'structured-options',
		'cookie_activate_input',
		'render_cookie_page_slug_input'
	);
	 
} // end structured_initialize_structured_initialize_sect4
add_action('admin_init', 'structured_initialize_sect0');

 
 function display_section_message0() {
	 echo '
<p>Enable cookies</p>		 ';
 } // end structured_general_options_callback
   
function render_cookie_activate_input($args) {
	// First, we read the options collection
	$options = get_option('structured-options');
	if (!is_array($options) OR !isset($options['cookie_activate_input']) OR  empty($options['cookie_activate_input'])) 
	{$options=array(); $options['cookie_activate_input']=0;}

	$html = '<input type="checkbox" id="cookie_activate_input" name="structured-options[cookie_activate_input]" value="1" '.  checked(1,  $options['cookie_activate_input'], false) .'>'; 	 
	echo $html;
} 

   
function render_cookie_page_slug_input($args) {
	$options = get_option('structured-options');
	if (!is_array($options) OR !isset($options['cookie_page_slug_input']) OR  empty($options['cookie_page_slug_input'])) 
	{$options=array(); $options['cookie_page_slug_input']='cookies';}
	$html = '<label for="cookie_page_slug_input"> '  . $args[0] . '</label><br>'; 	
	$html .= '<input type="text" id="cookie_page_slug_input" name="structured-options[cookie_page_slug_input]" value="'. $options['cookie_page_slug_input'].'">'; 	 
	echo $html;
} 


//OG:image
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
	if (!is_array($options) OR !isset($options['og_image_field']) OR  empty($options['og_image_field'])) 
	{$options=array(); $options['og_image_field']='';}

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
			'Insert the Analytics id ie. G-1234123'
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
		if (!is_array($options) OR !isset($options['ga_activate_input']) OR  empty($options['ga_activate_input'])) 
	{$options=array(); $options['ga_activate_input']='';}

	$html = '<input type="checkbox" id="ga_activate_input" name="structured-options[ga_activate_input]" value="1" '.  checked(1,  $options['ga_activate_input'], false) .'>'; 	 
	echo $html;
} 

   
function render_ga_id_input($args) {
	$options = get_option('structured-options');
		if (!is_array($options) OR !isset($options['ga_id_input']) OR  empty($options['ga_id_input'])) 
	{$options=array(); $options['ga_id_input']='';}

	$html = '<label for="ga_id_input"> '  . $args[0] . '</label><br>'; 	
	$html .= '<input type="text" id="ga_id_input" name="structured-options[ga_id_input]" value='. $options['ga_id_input'].'>'; 	 
	echo $html;
} 

//Gtag section

function structured_initialize_Gtag() {
 
	// If the theme options don't exist, create them.
	if( false == get_option( 'structured-options' ) ) {  
		add_option( 'structured-options' );
	} // end if
 
	// First, we register a section. This is necessary since all future options must belong to a 
	add_settings_section(
		'settings_section_Gtag',         // ID used to identify this section and with which to register options
		'Gtag options',                  // Title to be displayed on the administration page
		'display_section_messageGtag', // Callback used to render the description of the section
		'structured-options'     // Page on which to add this section of options
	);
	 
	// Next, we'll introduce the fields for toggling the visibility of content elements.
	add_settings_field( 
	'Gtag_activate_input',                      // ID used to identify the field throughout the theme
	'Activate Gtag',                           // The label to the left of the option interface element
	'render_Gtag_activate_input',   // The name of the function responsible for rendering the option interface
	'structured-options',    // The page on which this option will be displayed
	'settings_section_Gtag'         // The name of the section to which this field belongs
	);
	add_settings_field( 
		'Gtag_id_input',                      // ID used to identify the field throughout the theme
		'Analytics field',                           // The label to the left of the option interface element
		'render_Gtag_id_input',   // The name of the function responsible for rendering the option interface
		'structured-options',    // The page on which this option will be displayed
		'settings_section_Gtag',         // The name of the section to which this field belongs
		array(                              // The array of arguments to pass to the callback. In this case, just a description.
			'Insert the Gtag id (ex. GTM-N3MPWB4M)'
		)

	);
	
	 
	 
	// Finally, we register the fields with WordPress
	register_setting(
		'structured-options',
		'Gtag_activate',
		'Gtag_id_input'
	);
	 
} // end structured_initialize_structured_initialize_sect1
add_action('admin_init', 'structured_initialize_Gtag');

 
 function display_section_messageGtag() {
	 echo '
<p style="margin:0">Gtag </p>		 ';
 } // end structured_general_options_callback
   
function render_Gtag_activate_input($args) {
	// First, we read the options collection
	$options = get_option('structured-options');
		if (!is_array($options) OR !isset($options['Gtag_activate_input']) OR  empty($options['Gtag_activate_input'])) 
	{$options=array(); $options['Gtag_activate_input']='';}

	$html = '<input type="checkbox" id="Gtag_activate_input" name="structured-options[Gtag_activate_input]" value="1" '.  checked(1,  $options['Gtag_activate_input'], false) .'>'; 	 
	echo $html;
} 

   
function render_Gtag_id_input($args) {
	$options = get_option('structured-options');
		if (!is_array($options) OR !isset($options['Gtag_id_input']) OR  empty($options['Gtag_id_input'])) 
	{$options=array(); $options['Gtag_id_input']='';}

	$html = '<label for="Gtag_id_input"> '  . $args[0] . '</label><br>'; 	
	$html .= '<input type="text" id="Gtag_id_input" name="structured-options[Gtag_id_input]" value='. $options['Gtag_id_input'].'>'; 	 
	echo $html;
} 




//fine Gtag


// third section

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

  function display_section_message3() {
	 echo '<p>Facebook</p> ';
 } // end structured_general_options_callback
   

   
function render_fbpixel_activate_input($args) {
	// First, we read the options collection
	$options = get_option('structured-options');
		if (!is_array($options) OR !isset($options['fbpixel_activate_input']) OR  empty($options['fbpixel_activate_input'])) 
	{$options=array(); $options['fbpixel_activate_input']='';}
	$html = '<input type="checkbox" id="fbpixel_activate_input" name="structured-options[fbpixel_activate_input]" value="1" '.  checked(1,  $options['fbpixel_activate_input'], false) .'>'; 	 
	echo $html;
} 

   
function render_fbpixel_id_input($args) {
	$options = get_option('structured-options');
		if (!is_array($options) OR !isset($options['fbpixel_id_input']) OR  empty($options['fbpixel_id_input'])) 
	{$options=array(); $options['fbpixel_id_input']='';}
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
	if (!is_array($options) OR !isset($options['matomo_activate_input']) OR  empty($options['matomo_activate_input'])) 
	{$options=array(); $options['matomo_activate_input']='';}
	$html = '<input type="checkbox" id="matomo_activate_input" name="structured-options[matomo_activate_input]" value="1" '.  checked(1,  $options['matomo_activate_input'], false) .'>'; 	 
	echo $html;
} 

   
function render_matomo_id_input($args) {
	$options = get_option('structured-options');
	if (!is_array($options) OR !isset($options['matomo_id_input']) OR  empty($options['matomo_id_input'])) 
	{$options=array(); $options['matomo_id_input']='';}
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
	'metricool_activate_input',                      // ID used to identify the field throughout the theme
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

 
 function display_section_message5() {
	 echo '
<p>Enable Metricool</p>		 ';
 } // end structured_general_options_callback
   
function render_metricool_activate_input($args) {
	// First, we read the options collection
	$options = get_option('structured-options');
	if (!is_array($options) OR !isset($options['metricool_activate_input']) OR  empty($options['metricool_activate_input'])) 
	{$options=array(); $options['metricool_activate_input']='';}
	$html = '<input type="checkbox" id="metricool_activate_input" name="structured-options[metricool_activate_input]" value="1" '.  checked(1,  $options['metricool_activate_input'], false) .'>'; 	 
	echo $html;
} 

   
function render_metricool_id_input($args) {
	$options = get_option('structured-options');
	if (!is_array($options) OR !isset($options['metricool_id_input']) OR  empty($options['metricool_id_input'])) 
	{$options=array(); $options['metricool_id_input']='';}
	$html = '<label for="metricool_id_input"> '  . $args[0] . '</label><br>'; 	
	$html .= '<input type="text" id="metricool_id_input" name="structured-options[metricool_id_input]" value='. $options['metricool_id_input'].'>'; 	 
	echo $html;
} 

?>