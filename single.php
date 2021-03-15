<?php
global $post;
get_header();
?>

<article class="article section-spacing">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">

                <?php echo get_the_post_thumbnail($post_id); ?>


                <?php echo the_title('<h1>','</h1>'); ?>


                <?php echo the_content(); ?>



            </div>
            <div class="offset-lg-1 col-lg-3">
            <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</article>


<?php get_footer(); ?>