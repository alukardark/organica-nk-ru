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
         <div class="news-list">
                <ul class="main-news-list">
                    <li class="slider-recommend-wrap">
                        <i class="ion-ios-arrow-left"></i>
                        <ul class="slider-recommend">
                        <?
                            global $post;
                            $args = array('post_type' => 'banners_publications', 'order' => 'DESC','numberposts' => -1);
                            $myposts = get_posts( $args );
                            foreach( $myposts as $post ){
                            setup_postdata($post);?>
                            <? $ID = get_field('banners-preparate')->ID ?>
                                <li class="slider-recommend-item">
                                    <a href="<?=get_page_link($ID)?>">
                                        <div class="product-link">
                                            <div class="product-link-wrap">
                                                <div class="product-img" style="background-image: url(<?=get_field('product-img', $ID)?>);"></div>
                                                <div class="wrap-title-anonse">
                                                    <h5 class="title"><?=get_the_title( $ID )?></h5>
                                                    <div class="anonse"><?=get_field('product-desc', $ID)?></div>
                                                </div>

                                                <div class="tags">
                                                    <?foreach(get_field('product-tags', $ID) as $tag):?>
                                                        <?if($tag == 'new'):?><div class="new">Новинка</div><?endif?>
                                                        <?if($tag == 'gvnlp'):?><div class="gvnlp">ЖНВЛП</div><?endif?>
                                                    <?endforeach;?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-recommend-img" style="background-image: url(<?=get_field('banners-img')['sizes']['banners']?>)"></div>
                                    </a>
                                </li>
                            <?}wp_reset_postdata();?>
                        </ul>
                        <i class="ion-ios-arrow-right"></i>
                    </li>
                    <?php
                        global $wp_query, $query_string;
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $max_num_pages = $wp_query->max_num_pages;
                        $custom_query = new WP_Query( array( 'post_type' => 'news', 'paged' => $paged ) );

                      
                        if ( $custom_query->have_posts() ) : while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

                         
                                
                         
                            <li class="ajax-item">
                                <div class="main-news-date"><?=get_the_date('d F Y')?></div>
                                <a href="<?=esc_url(get_permalink())?>" class="main-news-title"><?the_title()?></a>
                                <div class="main-news-text">
                                    <?php the_excerpt(); ?>
                                </div>
                            </li>
                        <?php endwhile; endif;?>

                    <li style="height: 0;margin: 0;"></li>
                    <li style="height: 0;margin: 0;"></li>
                    <li style="height: 0;margin: 0;"></li>

                </ul>


                <ul class="pagination">
                    <? $pagination = get_pagination(); ?>

                    <?if (isset($pagination->prev)):?>
                        <li class="pagination__prev"><a class="ion-ios-arrow-left" href="<?=$pagination->prev->link?>" ></a></li>
                    <?endif?>
                    <?foreach ($pagination->pages as $page):?>
                        <li>
                            <?if (isset($page->link)):?>
                                <a href="<?=$page->link ?>" class="<?=$page->class?> pagination__link"><?=$page->title?></a>
                            <?else:?>
                                <a href="<?=$page->link ?>" class="<?=$page->class?> pagination__link current active"><?=$page->title ?></a>
                            <?endif?>
                        </li>
                    <?endforeach?>
                    <?if (isset($pagination->next)):?>
                        <li class="pagination__next"><a class="ion-ios-arrow-right"  href="<?=$pagination->next->link?>" ></a></li>
                    <?endif?>
                </ul>
              
                <? if ($pagination->next->link): ?>
                    <button data-nextpage="<?=$pagination->next->link?>" class="show-more"><span>Показать ещё</span></button>
                    <button data-nextpage="<?=$pagination->next->link?>" class="show-more show-more-loader" style="background: #80ccef; display: none">
                        <span>
                            <figure style="margin:0">
                                <svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="uil-ring-alt">
                        <rect x="0" y="0" width="100" height="100" fill="none" class="bk"></rect>
                        <circle cx="50" cy="50" r="40" stroke="#80ccef" fill="none" stroke-width="10" stroke-linecap="round"></circle>
                        <circle cx="50" cy="50" r="40" stroke="#ffffff" fill="none" stroke-width="10" stroke-linecap="round">
                            <animate attributeName="stroke-dashoffset" dur="2s" repeatCount="indefinite" from="0" to="502"></animate>
                            <animate attributeName="stroke-dasharray" dur="2s" repeatCount="indefinite" values="150.6 100.4;1 250;150.6 100.4"></animate>
                        </circle>
                        </svg>
                        </figure>
                    </span>
                    </button>
                <? endif; ?>

            </div>
    </div>


<script>
    $(function(){
        if($('.main-news-list>li').length >4){
            $('.main-news-list>li').eq(2).after( $('.slider-recommend-wrap') );
        }
    });
</script>
<?php
get_footer();
