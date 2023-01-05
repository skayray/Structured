<?php  $post_classes="card m-0 "; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes); ?>>
	<div class="card-body">
<?php /* 		
<figure class="post-image-container">
	<?php 
	if ( has_post_thumbnail() ) {
	the_post_thumbnail('postimage-big');
	}
	?>
</figure> */
?>		
		
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->


		<div class="entry-content">
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-bootstrap-4' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div>
	<!-- /.card-body -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer card-footer text-muted">
		<?php structure_posted_on(array('date','author','edit')); ?>

	</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
