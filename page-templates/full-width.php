
<?php
/*
* Template Name: Full Width
*
*/

 get_template_part( 'template-parts/_page-templates-fixed-elements',null,array('page_div_class'=> 'mt-0 page-full','content_div_class'=>'container-full') ); 
?>



<?php if ( have_posts() ) : ?>

	<?php if ( !is_home() && !is_front_page() ) : ?>
		<header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
		</header>
	<?php endif; ?>

    <?php
         while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', 'page-full' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :  comments_template();   endif;

		endwhile; // End of the loop. 
	?>
<?php endif;  ?>


<?php  get_template_part( 'template-parts/_page-templates-fixed-elements-end' ); ?>
