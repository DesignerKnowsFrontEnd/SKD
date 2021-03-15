<?php

$bread = get_field('breadcrumbs_snippet'); 
?>

<section class="breadcrumbs">
    <div class="container">
        <div class="row h-100 d-flex">
            <div class="col-lg-12">
                <div class="bread-inner">
                    <h2><?php echo get_the_title(); ?></h2>
                    <div class='title-divider'></div>
                    <p class="mx-width-860">
                        <?php echo $bread; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>