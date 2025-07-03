<?php 
$options = get_option('structured-options');
$url_thumb=get_the_post_thumbnail_url();

if ($url_thumb!=""){
	$og_image=$url_thumb;
	}
	elseif (isset($options['og_image_field'])){
	$og_image=$options['og_image_field'];
	}
if(isset($post->ID)) {$desc=get_post_meta( $post->ID, 'meta_description', true );}
else{$desc="";}
if ($desc==""){ 	$desc=get_bloginfo( 'description' );}
if ($desc==""){ 	$desc=get_excerpt(150);}

?>
<!-- START Structured meta  -->
<link rel="canonical" href="<?php _e (wp_get_canonical_url());?>"/>
<meta name="description" content="<?php _e ($desc);?>"/>
<meta property="og:locale" content="en_US"/>
<meta property="og:site_name" content="<?php _e (bloginfo( 'name' ));?>"/>
<meta property="og:title" content="<?php _e (get_the_title());?>"/>
<meta property="og:url" content="<?php _e (wp_get_canonical_url());?>"/>
<meta property="og:type" content="website"/>
<meta property="og:image" content="<?php _e ($og_image);?>"/>
<meta property="og:description" content="<?php _e ($desc);?>"/>
<meta name="twitter:title" content="<?php _e (get_the_title());?>"/>
<meta name="twitter:url" content="<?php _e (wp_get_canonical_url());?>"/>
<meta name="twitter:description" content="<?php _e ($desc);?>"/>
<meta name="twitter:image" content="<?php _e ($og_image);?>"/>
<meta name="twitter:card" content="summary_large_image"/>
<meta itemprop="name" content="<?php _e (get_the_title());?>"/>
<meta itemprop="description" content="<?php _e ($desc);?>"/>
<meta itemprop="image" content="<?php _e ($og_image);?>"/>
<!-- END - Structured meta -->
