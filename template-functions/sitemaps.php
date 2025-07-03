<?php  
function generate_sitemap() {
    $posts_for_sitemap = get_posts(array(
        'numberposts' => -1,
        'orderby' => 'modified',
        'post_type' => array('post', 'page'),
        'post_status' => 'publish' 
    ));

    $sitemap_content = '<?xml version="1.0" encoding="UTF-8"?>';
    $sitemap_content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    foreach ($posts_for_sitemap as $post) {
        setup_postdata($post);
        $postdate = explode(" ", $post->post_modified);

        $sitemap_content .= '<url>'.
            '<loc>'. get_permalink($post->ID) .'</loc>'.
            '<lastmod>'. $postdate[0] .'</lastmod>'.
            '<changefreq>monthly</changefreq>'.
            '</url>';
    }

    $sitemap_content .= '</urlset>';

    $file = fopen(ABSPATH . "sitemap.xml", "w");
    fwrite($file, $sitemap_content);
    fclose($file);
}

function remove_from_sitemap($post_id) {
    $post_type = get_post_type($post_id);
    if ($post_type === 'page' || $post_type === 'post') {
        generate_sitemap();
    }
}

add_action('publish_post', 'generate_sitemap');
add_action('publish_page', 'generate_sitemap');
add_action('trash_post', 'remove_from_sitemap');
add_action('trashed_post', 'remove_from_sitemap');
add_action('delete_post', 'remove_from_sitemap');