<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <?php get_template_part( 'template-parts/meta' ); ?>
    <?php wp_head();
    
    $global = get_field('global_options', 'options');
    $contact = get_field('contact_info', 'options');
    $social = get_field('social_icons', 'options'); 
    ?>
</head>


<body <?php body_class(); ?>>

<header class='header'>
    <div class="header-Logo">
           <img src="<?php echo $global['site_logo']['url']; ?>" alt="<?php echo $global['site_logo']['alt']; ?>" class="logo">
    </div>

    <?php
        $menuParameters = array(
            'menu' => 'primary_menu',
            'before'        => '',
            'after'     => '',
            'echo'            => false,
            'container'       => 'div',
            'container_class'       => 'header-Links',
            'depth'           => 0,
        );

echo strip_tags(wp_nav_menu( $menuParameters ), '<a><div>' );
?>
    <div class="header-CTA">
        <a href="#" class='btn btn-primary btn-header'>Hire Me</a>
    </div>
    <div class="header-MobileBtn">
        <a href="javascript:void(0);" class="icon" onclick="openNav()">
                <i class="bi bi-list"></i>
        </a>
    </div>
</header>    

<div id='sidebarNav' class="sidebarNav">
    <div class="sidebarNav-flex">
        <div class="sidebarNav-Links">
            <a href="#" class="header-Link active">home</a>
            <a href="#" class="header-Link">about</a>
            <a href="#" class="header-Link">portfolio</a>
            <a href="#" class="header-Link">articles</a>
            <a href="#" class="header-Link">contact</a>
        </div>
        <div class="header-CloseBtn">
            <a href="javascript:void(0);" class="closebtn" onclick="closeNav()">
                <i class="bi bi-x"></i>
            </a>
        </div>
    </div>
    
    <div class="sidebarNav-CTAs">
        <div class="social-links">
            <a href="#" class='social-link'>Fb</a>
            <a href="#" class='social-link'>In</a>
            <a href="#" class='social-link'>Ln</a>
            <a href="#" class='social-link'>Be</a>
            <a href="#" class='social-link'>Gh</a>
        </div>
        <div class="header-CTA">
            <a href="#" class='btn btn-primary btn-header'>Hire Me</a>
        </div>
    </div>
</div>


