<?php
get_header();
?>

    <div class="shadow-wrap">

        <div class="inner-page-header">
            <div class="wrapper">
                <ul class="breadcrumbs ">
                    <?php if(function_exists('bcn_display')){bcn_display();}?>
                </ul>
                <h1><?=str_replace("Архивы: ", "", get_the_archive_title()); ?></h1>
            </div>
        </div>


        <div class="news-list gallery-list">

            <ul>
                <?php
                global $wp_query;
                $custom_query = new WP_Query( array( 'post_type' => 'photogallery', 'paged' => $paged ) );
                if ( $custom_query->have_posts() ) : while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                    <li class="gallery-list-item" style="background-image: url(<?=get_field('photogallery-albom');?>);">
                        <a href="<? print_r( esc_url(get_permalink()) )?>">
                            <div class="title"><? the_title(); ?></div>
                            <span class="go-directory">Перейти в каталог</span>
                        </a>
                    </li>
                <?php endwhile; endif;?>
            </ul>

        </div>

    </div>



<?php
get_footer();
