<?php
get_header();
?>
<div class="shadow-wrap" style="padding-bottom: 0;">
    <div class="inner-page-header">
        <div class="wrapper">
            <ul class="breadcrumbs ">
                <?php if(function_exists('bcn_display')){bcn_display();}?>
            </ul>
            <h1><? the_title(); ?></h1>
        </div>
    </div>
</div>

<div class="news-list gallery">
    <ul class="gallery-slider">
        <?foreach (get_field('photogallery-list') as $photogallery_item):?>
           <li class="gallery-slider-item">
                <a href="<?=$photogallery_item['url']?>" data-fancybox="gallery">
                    <div class="img" style="background-image: url(<? print_r($photogallery_item['sizes']['mygallery']) ?>);"></div>
                </a>
                <div class="title"><?=$photogallery_item->title?></div>
            </li>
        <?endforeach;?>

        
    </ul>
    <div class="gallery-slider-nav">
        <div class="gallery-slider-prev">Предыдущее фото</div>
        <div class="gallery-slider-nav-count"><span></span></div>
        <div class="gallery-slider-next">Следующее фото</div>
    </div>
</div>



<?php
get_footer();
