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