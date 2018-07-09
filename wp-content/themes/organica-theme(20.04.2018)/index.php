<?php
get_header();
?>
<div class="big-main-wrap">
    
<div class="main-video">
    <div id="main-video"  data-video="<?=get_field('address-youtube', 72)?>"></div>
    <h2><?=get_field('address-video-text', 72)?></h2>
    <a href="/products/" class="view-products">Посмотреть продукцию</a>

    <a href="#main-wrap" class="btn-down">
        <span></span>
        <span></span>
        <span></span>
        <i class="ion-chevron-down"></i>
    </a>
</div>

<div id="main-wrap" class="main-wrap">
    <div class="main-value-wrap">
        <ul class="main-value-list">
            <li data-aos="fade" data-aos-duration="1500" style="background-image: url(<?=get_field('address-img-block-1', 72)?>);">
                <?=get_field('address-text-block-1', 72)?>
            </li>
            <li data-aos="fade" data-aos-duration="1500" style="background-image: url(<?=get_field('address-img-block-2', 72)?>);">
                <?=get_field('address-text-block-2', 72)?>
            </li>
            <li data-aos="fade" data-aos-duration="1500" style="background-image: url(<?=get_field('address-img-block-3', 72)?>);">
                <?=get_field('address-text-block-3', 72)?>
            </li>
            <li data-aos="fade" data-aos-duration="1500" style="background-image: url(<?=get_field('address-img-block-4', 72)?>);">
                <?=get_field('address-text-block-4', 72)?>
            </li>
        </ul>
    </div>

    <div class="main-news-wrap" data-aos="fade" data-aos-duration="1500">
        <ul class="main-news-list" >
             <?php
                global $post;
                $args = array('post_type' => 'news', 'order' => 'DESC','numberposts' => 2);
                $myposts = get_posts( $args );
                foreach( $myposts as $post ){
                    setup_postdata($post);?>
                     <li >
                        <div class="main-news-date"><?=get_the_date('d F Y')?></div>
                        <a href="<?=esc_url(get_permalink())?>" class="main-news-title"><?the_title()?></a>
                        <div class="main-news-text"><?php the_excerpt(); ?></div>
                    </li>
                <?}wp_reset_postdata();?>
        </ul>
        <a href="/company/news/" class="view-news">Все новости</a>
    </div>
</div>

</div>
<?php
get_footer();
