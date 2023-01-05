<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header(); ?>
<body <?php body_class(); ?>>
	<header>
		<a class="skip-link screen-reader-text" href="#main">Skip to content</a>
		<?php get_template_part( 'menu' ); ?>
	</header><!-- #masthead -->

<style>
.error404 section{      background: rgb(255 255 255 / 86%);
    padding: 2rem 3rem;
    max-width: 800px;
    margin: auto;
    border: solid 1px #ddd;
}
	@media(max-width:414px){
		.error404 section{  	padding: .5rem 1rem;}
	}
	#cat{min-width:100px; max-width:320px;}
</style>
	<div id="page">
	<div class="container">
					<main id="main" class="site-main">

						<div class="content mt-2">
							<div class="card-body">
					<section class="text-center error-404">
						<header class="page-header text-center">
							<div><img src="<?php echo get_template_directory_uri(); ?>/assets/404-cat.svg" id="cat"></div>
								<h1 class="h2 page-title text-primary">Sorry, this page isn't available</h1>
						</header><!-- .page-header -->
						<div class="page-content">
										<hr>
							<p  style="font-weight:100">The link you followed may be broken, or the page have been removed. <a href="<?php echo get_home_url(); ?>">Go back to the home page</a>.</p>
							<p class="mt-4"><a class="btn btn-outline-dark btn-sm  rounded p-2" href="<?php echo get_home_url(); ?>"><i class="fa fa-home" aria-hidden="true" style="    font-size: 1.3rem;"></i> <br>Back home</a></p>

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
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->

					</main><!-- #main -->

	</div>
	<!-- /.container -->
</div>
<?php get_footer(); ?>
</body>
</html>