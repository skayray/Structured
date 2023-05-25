<?php get_header(); ?>

<body <?php body_class(); ?>>

<a class="skip-link screen-reader-text" href="#content">Skip to content</a>
	<header>
		<?php get_template_part( 'menu' ); ?>
	</header><!-- #masthead -->
<div id="page" class="d-sm-flex">	
		
<div id="content" class="container flex-fill <?php if ( is_active_sidebar('sidebar-1') ) _e('allow-sidebar') ?>" >
<?php
if ( have_posts() ) :


	if ( is_home() && ! is_front_page() ) : ?>
		<header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
		</header>

	<?php endif; ?>


	<?php
	/* Start the Loop */
	while ( have_posts() ) : the_post();
		$format= get_post_type()=='post' ? get_post_format() : get_post_type();
		
		get_template_part( 'template-parts/content', $format );

	endwhile;

	the_posts_navigation( array(
		'next_text' => esc_html__( 'Newer Posts', 'wp-bootstrap-4' ),
		'prev_text' => esc_html__( 'Older Posts', 'wp-bootstrap-4' ),
	) );

else :

	get_template_part( 'template-parts/content', 'none' );

endif; ?>	
		
		


</div>	<!-- #CONTENT -->
<?php if ( is_active_sidebar('sidebar-1') ) { ?>
<div id="sidebar" class="flex-fill me-2">
<?php get_sidebar(); ?>
</div>	<!-- #sidebar -->
<?php } ?>	
</div>	<!-- #PAGE -->

<?php get_footer(); ?>
</body>
</html>
