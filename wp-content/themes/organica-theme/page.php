<?php
get_header();
?>

    <div class="shadow-wrap">
        <div class="inner-page-header">

            <div class="wrapper">
                <ul class="breadcrumbs ">
                    <?php if(function_exists('bcn_display')){bcn_display();}?>
                </ul>
                <h1><?the_title()?></h1>
            </div>

        </div>
        <div class="inner-page-cont">

            <div class="wrapper">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; endif; ?>
            </div>

        </div>
    </div>



<?php
get_footer();
