<?php
/*
* Template Name: Left Sidebar NOT DONE
*/

get_header(); ?>
<body <?php body_class(); ?>>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php get_sidebar(); ?>
            </div>
            <!-- /.col-md-4 -->

            <div class="col-md-8">
                    <main id="main" class="main-content-area">

                        <?php
                        while ( have_posts() ) : the_post();

                            get_template_part( 'template-parts/content', 'page' );

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;

                        endwhile; // End of the loop.
                        ?>

                    </main><!-- #main -->
            </div>
            <!-- /.col-md-8 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

<?php get_footer(); ?>
</body>
</html>