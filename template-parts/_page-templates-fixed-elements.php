<?php  
$post_classes="card m-0 "; 
if ( $args['page_div_class'] ) { //qualor importando il template (i.e. da full width gli passassi degli argomenti..)
$page_div_class= $args['page_div_class'];
}
else{$page_div_class="d-sm-flex mt-4";}

if ( $args['content_div_class'] ) { //qualor importando il template (i.e. da full width gli passassi degli argomenti..)
$content_div_class= $args['content_div_class'];
}
else{$content_div_class="container flex-fill";}

?>
<?php get_header(); ?>

<body <?php body_class(); ?>>
	<a class="skip-link screen-reader-text" href="#content">Skip to content</a>
	<header>
		<?php get_template_part( 'menu' ); ?>
	</header><!-- #masthead -->
<div id="page" class="<?php echo $page_div_class; ?>" >	
<div id="content"  class=" <?php echo $content_div_class; ?>  <?php if ( is_active_sidebar('sidebar-1') ) _e('allow-sidebar') ?>" >


<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes); ?>>
	<div class="card-body">
