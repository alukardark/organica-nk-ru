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
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="inner-page-cont articles news">
                <div class="article-attitude"><?=get_the_date('d F Y')?></div>
                <div class="wrapper">
                    <h2><?the_title()?></h2>
                    <div class="text">
                         <?php the_content(); ?>
                    </div>
                    <a href="<?=get_post_type_archive_link('mass_media')?> " class="back">Назад</a>

                </div>
            </div>
        <?php endwhile; endif; ?>
    </div>



<?php
get_footer();
