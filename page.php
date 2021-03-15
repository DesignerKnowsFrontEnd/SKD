<?php
global $post;
get_header();
?>

<div id="page" class="content-area <?php echo $extraClass; ?>">
        <?php echo the_content(); ?>
    </div>

    


<?php get_footer(); ?>