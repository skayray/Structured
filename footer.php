

	<footer id="colophon" class="site-footer text-center bg-light mt-5 text-secondary p-4">
	
<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
<figure class="footer-logo d-inline">
	<?php the_custom_logo(); ?>
</figure>	
<?php endif; ?>

	<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>"> <?php bloginfo( 'name' ); ?></p>

	</footer><!-- #colophon -->

<?php wp_footer(); ?>
