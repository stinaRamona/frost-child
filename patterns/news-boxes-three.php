<?php 
/**
 * Title: Newsboxes with picture, heading, text, button.
 * Slug: frost-child/news-boxes-three
 * Categories: featured
 */
?>

<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
<div class="news-box-container">

    <!-- läser in dynamiskt vilka de tre senaste nyheterna är-->
     <?php 
     query_posts('category_name=nyheter&showposts=3'); 

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
<!-- /wp:group --> 
 
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
