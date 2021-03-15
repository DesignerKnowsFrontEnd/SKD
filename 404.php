<?php
    global $post;
    get_header();
?>
    <section class='breadcrumbs bg-2'>
        <div class='container'>
            <div class='breadcrumbs-flex'>
                <div class='breadcrumbs-info'>
                    <h3 class='above-title'><?php echo __('Error 404','lellos'); ?></h3>
                </div>
            </div>
        </div>
    </section>
    <main>
        <div class='container'>
            <div class='two-columns'>
                <div class='col-text'>
                    <h2><?php echo __('Page Not Found','lellos'); ?></h2>
                    <p class='lead-text'>

                    </p>
                </div>
            </div>
        </div>
    </main>
<?php get_footer(); ?>