<?php

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
}
add_action( 'init', 'frost_child_register_block_patterns' );

//Test med shortcode istället då loopen inte fungerade i php filen för nyhetsboxen.
function frost_child_news_boxes_three_shortcode() {
    ob_start(); 
    ?>
    <div class="news-box-container">

<!-- läser in dynamiskt vilka de tre senaste nyheterna är-->
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
            <a href="<?php the_permalink() ?>"><button>Läs mer</button></a>
        </div>
        <?php
    }
 }
?>
</div> 

<style>
.news-box-container {
    display: flex; 
    justify-content: space-between;
    flex-direction: row; 
}

.news-box {
    width: 33%; 
    padding: 10px; 
    border: 1px solid black; 
}

.news-image-container {
    width: 100%; 
    height: 200px; 
    overflow: hidden; 
}

</style>
<?php
return ob_get_clean(); 
}
add_shortcode('news_boxes_three', 'frost_child_news_boxes_three_shortcode'); 