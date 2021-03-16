<?php
/**
 * Template Name: Homepage
 *
 */


$global = get_field('global_options', 'options');
global $post;

$hero = get_field('content_group');
$heroSlider = get_field('slider_content_group');

get_header(); ?>

<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h6><?php echo $hero['pre_header'];?></h6>
                <h1><?php echo $hero['title'];?></h1>
                <p><?php echo $hero['paragraph'];?></p>
                <a href='<?php echo esc_url($hero['button']['url']); ?>'><?php echo $hero['button']['title'];?></a> 
            </div>
        </div>
    </div>

    <div class="slider-main">
        <!-- Swiper -->
        <div id='sliderMain' class="swiper-container">
            <div class="swiper-wrapper">
                <?php if( have_rows('slider_content_group')) : ?>
                <?php while( have_rows('slider_content_group')): the_row(); 
                    $sliderImage = get_sub_field('image');  
                    $sliderTilte = get_sub_field('title');  
                    $sliderBtn = get_sub_field('button');  
                ?>
                <div class="swiper-slide overlay">
                    <img src="<?php echo esc_url($sliderImage['url']);  ?>" alt="<?php echo esc_attr($sliderImage['alt']);  ?>" class='mobile-img'/>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

</section>
    

    




<?php get_footer(); ?>