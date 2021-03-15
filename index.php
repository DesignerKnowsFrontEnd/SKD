<?php

global $post;
$bread = get_field('breadcrumbs_background_images', 'option');
get_header();
?>



<?php
if ( have_posts() ) :

	if ( is_home() && ! is_front_page() ) :
		?>



<main class="section-spacing">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">



                <?php
					endif;


					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

					

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

                <div class="our-news-main-text">
					<?php the_posts_pagination( array(
							'class' => 'pagination',
							'screen_reader_text' => ' ', 
							'prev_text'          => __( 'Previous', 'theme' ),
							'next_text'          => __( 'Next', 'theme' ),
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( '', 'theme' ) . ' </span>',
					) ); ?>
                </div>

            </div>
        </div>
    </div>
</main><!-- #main -->

<?php

get_footer();