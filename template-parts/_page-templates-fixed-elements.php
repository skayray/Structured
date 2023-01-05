<?php  $post_classes="card m-0 "; ?>
<?php get_header(); ?>

<body <?php body_class(); ?>>
	<a class="skip-link screen-reader-text" href="#content">Skip to content</a>
	<header>
		<?php get_template_part( 'menu' ); ?>
	</header><!-- #masthead -->
<div id="page" class="d-sm-flex mt-4">	
<div id="content" class="container flex-fill <?php if ( is_active_sidebar('sidebar-1') ) _e('allow-sidebar') ?>" >


<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes); ?>>
	<div class="card-body">
