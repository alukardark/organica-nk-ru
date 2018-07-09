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

    <div class="documents">

        <ul class="documents-list">
            <?php

            global $wp_query;
            $custom_query = new WP_Query( array( 'post_type' => 'documents', 'paged' => $paged ) );
            if ( $custom_query->have_posts() ) : while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

            <?
                $format = substr(strrchr( get_field('documents-file')['url'] , "."), 1);
                if($format=='doc' || $format=='docx'){
                    $format_ico = get_template_directory_uri()."/img/doc-big.png";
                    $attr_link = 'target="_blank"';
                }elseif($format=='pdf'){
                    $format_ico = get_template_directory_uri()."/img/pdf-big.png";
                     $attr_link = 'target="_blank"';
                }else{
                    $format_ico = get_field('documents-file')['url'];
                    $attr_link = "data-fancybox";
                }
            ?>
            <li class="documents-item">
                <a <?=$attr_link?>  href="<?=get_field('documents-file')['url']?>" class="documents-item-wrap">
                    <div class="documents-item-img documents-item-file" style="background-image: url(<?=$format_ico?>)"></div>
                    <p><?the_title()?></p>
                </a>
            </li>
            <?php endwhile; endif;?>


           

        </ul>

    </div>
</div>



<?php
get_footer();
