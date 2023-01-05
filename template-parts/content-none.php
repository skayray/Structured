<?php
/**
 * Template part for displaying a message that posts cannot be found
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package structured
 */

?>
	<section class="text-center error-404">
		<header class="page-header">
				<h1 class="page-title text-secondary">Ops, we have an error.</h1>
		</header><!-- .page-header -->
		<div class="page-content">
						<hr>
			<p class="h3 text-secondary" style="font-weight:100">The page you are looking for is not here</p>
			<p class="mt-4"><a class="btn btn-primary btn-lg text-light rounded" href="<?php echo get_home_url(); ?>">HOME</a></p>
			
			<?php  if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
				<p><?php
					printf( wp_kses(
							/* translators: 1: link to WP admin new post page. */
							__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'structured' ),
							array(
								'a' => array(
									'href' => array(),
								),
							)
						),
						esc_url( admin_url( 'post-new.php' ) )
					);
				?></p>
			<?php  endif; ?>
	</div><!-- .page-content -->
	</section><!-- .error-404 -->

