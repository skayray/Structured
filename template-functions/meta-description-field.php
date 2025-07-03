<?php
function add_meta_description_meta_box() {
    add_meta_box(
        'meta_description', // ID of the meta box
        'Meta Description',           // Title of the meta box
        'render_meta_description_meta_box', // Callback function
        ['post', 'page'],            // Post types where the meta box should appear
        'normal',                    // Context (normal, side, etc.)
        'high'                       // Priority (default, low, high, etc.)
    );
}
add_action('add_meta_boxes', 'add_meta_description_meta_box');

function render_meta_description_meta_box($post) {
    // Retrieve existing value from the database
    $meta_description = get_post_meta($post->ID, 'meta_description', true);

    // Display the form, using the current value.
    wp_nonce_field( basename( __FILE__ ), 'meta_description_nonce' ); ?>

    <textarea style="width:100%; height:100px;" id="meta_description" name="meta_description"><?php echo $meta_description; ?></textarea>
    <?php
}

function save_meta_description_meta_box($post_id) {
    // Check if our nonce is set.
    if (!isset($_POST['meta_description_nonce'])) {
        return $post_id;
    }

    $nonce = $_POST['meta_description_nonce'];

    // Verify that the nonce is valid.
	 if ( !isset( $nonce ) || !wp_verify_nonce( $nonce, basename( __FILE__ ) ) )
    return $post_id;
	

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // Check the user's permissions.
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    }

    // Sanitize the user input.
    $meta_description = sanitize_textarea_field($_POST['meta_description']);

    // Update the meta field in the database.
    update_post_meta($post_id, 'meta_description', $meta_description);
}
add_action('save_post', 'save_meta_description_meta_box');