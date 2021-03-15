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
    <header>
        <div class="top-nav">
            <div class="container-fluid">
                <div class="top-nav-inner">
                    <div class="contact-info">
                        <a href="#"><?php echo $contact['email_icon']; ?>
                            <?php echo $contact['email_label']; ?></a>
                        <div class='divider'></div>
                        <a href="#"><?php echo $contact['phone_icon']; ?>
                            <?php echo $contact['phone_label']; ?></a>
                    </div>
                    <div class="social-icons">
                        <a href="<?php echo $social['facebook_link']; ?>"><?php echo $social['facebook_icon']; ?></a>
                        <a href="<?php echo $social['instagram_link']; ?>"><?php echo $social['instagram_icon']; ?></a>
                        <a href="<?php echo $social['twitter_link']; ?>"><?php echo $social['twitter_icon']; ?></a>
                        <a href="<?php echo $social['tripadvisor_link']; ?>"><?php echo $social['tripadvisor_icon']; ?></a>
                    </div>
                </div>
            </div>
        </div>
        <nav id='navbar_top' class="navbar navbar-expand-lg navbar-light" role="navigation">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="<?php echo $global['site_logo']['url']; ?>" alt="<?php echo $global['site_logo']['alt']; ?>" class="logo">
                </a>
                <!-- Brand and toggle get grouped for better mobile display -->
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php wp_nav_menu(
                        array(
                            'menu' => 'Main Menu'
                            ,'container'       => 'div'
                            ,'container_class' => 'collapse navbar-collapse'
                            ,'container_id'    => 'bs-example-navbar-collapse-1'
                            ,'menu_class'      => 'navbar-nav ml-auto'
                            ,'depth' => 2
                            ,'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback'
                            ,'walker' => new WP_Bootstrap_Navwalker()
                        )
                    ); 
                ?>

            </div>
        </nav>
    </header>