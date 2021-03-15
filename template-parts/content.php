<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lellos_Theme
 */
$categories = get_the_category($post_id);
?>
<a class='our-news-card' href="<?php echo esc_url(get_the_permalink($post_id)) ?>">

    <?php echo get_the_post_thumbnail($post_id); ?>
    <div class="our-news-card-text">
        <?php the_title( '<h3>', '</h3>' ); ?>
        <?php the_excerpt(); ?>
    </div><!-- .our-news-text -->
    <div class="our-news-card-info">
        <p class='author'><?php echo get_the_author(); ?></p>
        <p class="date"><?php echo get_the_date() ?></p>
    </div>

</a><!-- .closing a -->