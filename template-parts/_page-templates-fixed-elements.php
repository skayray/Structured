<?php  

$post_classes="card m-0 ";
$page_div_class="d-sm-flex";
$content_div_class="container flex-fill";
$entry_content_class="card-body entry-content";

if (  isset($args['post_classes']) ) { //qualor importando il template (i.e. da full width gli passassi degli argomenti..)
$post_classes= $args['post_classes'];
}
if ( isset($args['page_div_class']) ) { //qualor importando il template (i.e. da full width gli passassi degli argomenti..)
$page_div_class= $args['page_div_class'];
}


if (  isset($args['content_div_class']) ) { //qualor importando il template (i.e. da full width gli passassi degli argomenti..)
$content_div_class= $args['content_div_class'];
}
if (  isset($args['entry_content_class']) ) { //qualor importando il template (i.e. da full width gli passassi degli argomenti..)
$entry_content_class= $args['entry_content_class'];
}

get_header(); 

?>

<body <?php body_class(); ?>>
	<a class="skip-link screen-reader-text" href="#content">Skip to content</a>
	<header>
		<?php get_template_part( 'menu' ); ?>
	</header><!-- #masthead -->
<div id="page" class="<?php echo $page_div_class; ?>" >	
<div id="content"  class=" <?php echo $content_div_class; ?>  <?php if ( is_active_sidebar('sidebar-1') ) _e('allow-sidebar') ?>" >


<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes); ?>>
<div class="<?php echo $entry_content_class; ?>">
