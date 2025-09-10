<?php
function cc_mime_types($mimes) {
	if ( current_user_can( 'administrator' ) ) {
  $mimes['svg'] = 'image/svg+xml';
  $mimes['lottie'] = 'application/zip+dotlottie';
}
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
