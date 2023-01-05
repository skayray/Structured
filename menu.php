<nav class="navbar navbar-expand-lg  navbar-light bg-light">
				
				<?php 
				$bootstrap_ani='side';
				if ($bootstrap_ani=='side'){$side='side-'; get_template_part( 'assets/side-menu-support');} 
				?>
				<div class="container-fluid">
				
				<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
				<figure class="nav-logo">
					<?php the_custom_logo(); ?>
				</figure>	
				<?php else : ?> 
					<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>"> <?php bloginfo( 'name' ); ?></h2>
				<?php endif; ?>
				

				<button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="<?php _e($side); ?>collapse" data-bs-target="#<?php _e($side); ?>primary-menu-wrap" aria-controls="<?php _e($side); ?>primary-menu-wrap" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				</button>
				<?php
					wp_nav_menu( array(
						'menu_id'         => 'primary-menu',
						'container'       => 'div',
						'container_class' => 'collapse navbar-collapse ',
						'container_id'    => $side.'primary-menu-wrap',
						'menu_class'      => 'navbar-nav ms-auto mb-2 mb-lg-0',
						'fallback_cb'     => '__return_false',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 2,
						'walker' 		  => new Structure_theme_Walker
					) );
				?>
		</nav><!-- #site-navigation -->
		