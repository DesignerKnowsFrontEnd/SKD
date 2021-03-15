<?php
/**
 * Template Name: Homepage
 *
 */


$global = get_field('global_options', 'options');
global $post;
get_header(); ?>


    <header class='header'>
        <div class="header-Logo">
             <img src="<?php echo $global['site_logo']['url']; ?>" alt="<?php echo $global['site_logo']['alt']; ?>" class="logo">
        </div>
        <div class="header-Links">
            <a href="#" class="header-Link">home</a>
            <a href="#" class="header-Link">about</a>
            <a href="#" class="header-Link">portfolio</a>
            <a href="#" class="header-Link">articles</a>
            <a href="#" class="header-Link">contact</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                 <i class="bi bi-list"></i>
            </a>
        </div>
        <div class="header-CTA">
            <a href="#" class='btn btn-primary btn-header'>Hire Me</a>
        </div>
    </header>    

    




<?php get_footer(); ?>