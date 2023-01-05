		<figure class="post-image-container">
		<?php if ( has_post_thumbnail() ) { the_post_thumbnail('postimage-big');	}?>
		</figure>
		
<header class="entry-header mb-3">
<?php the_title( '<h1 class="entry-title card-title h2">', '</h1>' ); ?>
</header><!-- .entry-header -->


the_content();
