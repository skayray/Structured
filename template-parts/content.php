<?php 
$post_classes="card mb-3"; 
if (is_sticky() )$post_classes.=" bg-primary text-white";
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
	<?php if ( is_sticky() ) : ?>
		<span class="text-muted" title="<?php echo esc_attr__( 'Sticky Post', 'Structure' ); ?>"></span>
	<?php endif; ?>
	<div class="card-body">

		
<figure class="post-image-container">
	<?php 
	if ( has_post_thumbnail() ) {
	the_post_thumbnail('postimage-big');
	}
	?>
</figure> 
			<header class="entry-header mb-3">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title card-title h2">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title card-title h3"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="text-dark">', '</a></h2>' );
				endif; ?>
				
				<div class="entry-meta text-muted">
					<?php structure_posted_on(array('date','author')); ?>
				</div><!-- .entry-meta -->
			</header><!-- .entry-header -->


		<?php if( is_singular()) : ?>
			<div class="entry-content">
				<?php
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:'),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
		<?php else : ?>
			<div class="entry-summary">
				<?php echo get_excerpt(300); ?>
				<div>
					<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-primary btn-sm"><?php esc_html_e( 'Continue Reading' ); ?> <i class="fas fa-chevron-right"></i> </a>
				</div>
			</div><!-- .entry-summary -->
		<?php endif; ?>

	</div>
	<!-- /.card-body -->


		<footer class="entry-footer card-footer text-muted">
		<?php structure_posted_on(array('date','author','edit')); ?>
	
		</footer><!-- .entry-footer -->


</article><!-- #post-<?php the_ID(); ?> -->
