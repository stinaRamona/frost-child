<?php

function my_child_theme_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
}
add_action('wp_enqueue_scripts', 'my_child_theme_enqueue_styles');

/*göra excerpt mindre*/
function theme_slug_excerpt_length( $length ) {
    if ( is_admin() ) {
            return $length;
    }
    return 13;
}
add_filter( 'excerpt_length', 'theme_slug_excerpt_length', 999 );


function frost_child_register_block_patterns() {
    register_block_pattern(
        'frost-child/news-boxes-three',
        array(
            'title'       => __( 'Newsboxes with picture, heading, text, button', 'frost-child' ),
            'description' => _x( 'A pattern with three news boxes, each containing a picture, heading, text, and a button.', 'Block pattern description', 'frost-child' ),
            'content'     => file_get_contents( get_theme_file_path( '/patterns/news-boxes-three.php' ) ),
            'categories'  => array( 'featured' ),
        )
    );

    register_block_pattern(
        'frost-child/posts-grid', 
        array(
            'title'         => __('Grid of posts in three columns', 'frost-child'), 
            'description'   => _x('Grid with three columns. For posts', 'Block pattern description', 'frost-child'), 
            'content'       => file_get_contents( get_theme_file_path('/patterns/posts-grid.php')), 
            'categories'    => array('posts'), 
            'blockTypes'    => array('core/query'),
        )
    ); 
}
add_action( 'init', 'frost_child_register_block_patterns' );

//Test med shortcode istället då loopen inte fungerade i php filen för nyhetsboxen.
function frost_child_news_boxes_three_shortcode() {
    ob_start(); 
    ?>
    <div class="news-box-container">

<!--läser in dynamiskt vilka de tre senaste nyheterna är-->
 <?php 
 query_posts('category_name=Nyheter&showposts=3'); 

 if (have_posts()) {
    while( have_posts()) {
        the_post(); 
        ?>
        <div class="news-box">
            <div class="news-image-container">
                <?php if(has_post_thumbnail()) {the_post_thumbnail();} ?>
            </div>
            <h3><?php the_title() ?></h3>
            <p><?php the_excerpt() ?></p>
            <a href="<?php the_permalink() ?>"><button class="read_more_btn">Läs mer</button></a>
        </div>
        <?php
    }
 }
?>
</div> 

<?php
return ob_get_clean(); 
}
add_shortcode('news_boxes_three', 'frost_child_news_boxes_three_shortcode'); 