<?php
get_header();
?>

<div class="shadow-wrap">

            <div class="inner-page-header">
                <div class="wrapper">
                    <ul class="breadcrumbs ">
                        <?if(!get_query_var( 'tags' )):?>
                            <?php if(function_exists('bcn_display')){bcn_display();}?>
                        <?else:?>
                            <li><a href="/">Главная</a><span> / </span></li>
                            <li><a href="#">Новые препараты</a><span> / </span></li>
                        <?endif;?>
                    </ul>
                    <?
                        global $wp_query;
                        $max_num_pages = $wp_query->max_num_pages;
                        $custom_query = new WP_Query( array( 'post_type' => 'products', 'paged' => $paged ) );
                        if ( $custom_query->have_posts() ) : while ( $custom_query->have_posts() ) : $custom_query->the_post();
                            if($_GET['type'] && latin(get_field('product-farmgroup'))==$_GET['type']){
                                    $title_farmgroup = get_field('product-farmgroup');
                                }
                        endwhile; endif;?>

                    <?if($title_farmgroup){?>
                        <h1><?=$title_farmgroup?></h1>
                    <?}elseif(get_query_var( 'tags' )) {?>
                        <h1><?='Новые препараты' ?></h1>
                     <?}else{?>
                        <h1><?=str_replace("Архивы: ", "", get_the_archive_title()) ?></h1>
                    <?}?>
                  
                </div>
            </div>


            <div class="news-list products-list">
                <a href="#" class="sort" data-btn="name"><span>По наименованию</span></a>
                <br>
                <a href="#" class="sort" data-btn="farmgroup"><span>По фармакотерапевтической группе</span></a>
                <div class="sort-list-wrap" data-sort="farmgroup">
                    <?php
                        global $post;

                        if( get_query_var( 'tags' ) ):
                            $meta_query_new = array(
                                'relation'      =>  'AND',
                                array(
                                    'key'       =>  'product-tags',
                                    'compare'   =>  'LIKE',
                                    'value'     =>  'new',
                                )
                            );
                        else:
                            $meta_query_new = array();
                        endif;

                        $args = array('post_type' => 'products', 'order' => 'DESC','numberposts' => -1,
                        'meta_query' => $meta_query_new
                    );
                        $myposts = get_posts( $args );
                        foreach( $myposts as $post ){
                            setup_postdata($post);
                            $product_arr[] = get_the_title() . "|" . esc_url(get_permalink());
                            if( get_field('product-farmgroup') == "") continue;
                            $farmgroup[ get_field('product-farmgroup') ][] = get_the_title() . "|" . esc_url(get_permalink());
                        }wp_reset_postdata();

                        $farmgroup_name = array_keys($farmgroup);
                        sort($farmgroup_name);
                        $farmgroup_name_sort = array_chunk($farmgroup_name, 4, true);?>
                        <?foreach ($farmgroup_name_sort as $farmgroup_name) {?>
                            <div class="sort-list-col">
                                <?foreach ($farmgroup_name as $farmgroup_name_value) {?>
                                    <div class="sort-list-cell">
                                        <ul class="sort-list">
                                            <? if( get_query_var( 'tags' ) ): ?>
                                                <li><a href="<?="/products/new/?type=".latin($farmgroup_name_value)?>"><?=$farmgroup_name_value?></a></li>
                                            <?else:?>
                                                <li><a href="<?="/products/?type=".latin($farmgroup_name_value)?>"><?=$farmgroup_name_value?></a></li>
                                            <?endif;?>
                                            
                                         </ul>
                                    </div>
                                <?}?> 
                            </div>    
                        <?}?> 
                       <div class="sort-list-wrap-close"></div>
                </div>
                <div class="sort-list-wrap" data-sort="name">
                    <?php
                        sort($product_arr);
                        $product_arr_sort = [];
                        foreach($product_arr as $product){
                            $product_arr_sort[mb_substr($product, 0, 1)][]=$product;
                        }
                        $product_arr_sort = array_chunk($product_arr_sort, 4, true);
                        foreach( $product_arr_sort as $product_arr_sort_column):?> 
                            <div class="sort-list-col">
                            <?foreach($product_arr_sort_column as $letter => $product_arr):?>
                                <div class="sort-list-cell">
                                    <div class="sort-list-letter"><?=$letter?></div>
                                    <ul class="sort-list">
                                        <?foreach($product_arr as $product):?>
                                            <?
                                                $link = substr(stristr($product, '|'), 1);
                                                $title = stristr($product, '|', true);
                                            ?>
                                            <li><a href="<?=$link?>"><?=$title?></a></li>
                                         <?endforeach;?>
                                    </ul>
                                </div>
                            <?endforeach;?>
                            </div>
                        <?endforeach;?>
                        <div class="sort-list-wrap-close"></div>
                </div>

                <ul class="main-news-list">
                    <?php if (!get_query_var( 'tags' ) && !$_GET['type']): ?>
                        <li class="slider-recommend-wrap">
                            <i class="ion-ios-arrow-left"></i>
                            <ul class="slider-recommend">

                                <?
                                    global $post;
                                    $args = array('post_type' => 'banners_products', 'order' => 'DESC','numberposts' => -1);
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
                    <?php endif ?>
                    
            	 	<?php
                    global $wp_query;
                    $max_num_pages = $wp_query->max_num_pages;
                    $custom_query = new WP_Query( array( 'post_type' => 'products', 'order' => 'ASC','orderby' => 'title', 'paged' => $paged, 'meta_query' => $meta_query_new ) );
                    if ( $custom_query->have_posts() ) : while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                    <?
                        if($_GET['type']):
                            if(latin(get_field('product-farmgroup'))==$_GET['type']):
                                ?>
                                <li>
                                    <a href="<?=esc_url(get_permalink())?>">
                                        <div class="product-link">
                                            <div class="product-link-wrap">
                                                <div class="product-img" style="background-image: url(<?=get_field('product-img')?>);"></div>
                                                <div class="wrap-title-anonse">
                                                    <h5 class="title"><?the_title()?></h5>
                                                    <div class="anonse"><?=get_field('product-desc')?></div>
                                                </div>

                                                <div class="tags">
                                                    <?foreach(get_field('product-tags') as $tag):?>
                                                        <?if($tag == 'new'):?><div class="new">Новинка</div><?endif?>
                                                        <?if($tag == 'gvnlp'):?><div class="gvnlp">ЖНВЛП</div><?endif?>
                                                    <?endforeach;?>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="go-directory">Подробнее о препарате</span>
                                    </a>
                                </li>
                            <?endif;?>
                        <?elseif(get_query_var( 'tags' )):
                            if(get_field('product-tags')[0]=='new'):
                        ?>
                                <li>
                                    <a href="<?=esc_url(get_permalink())?>">
                                        <div class="product-link">
                                            <div class="product-link-wrap">
                                                <div class="product-img" style="background-image: url(<?=get_field('product-img')?>);"></div>
                                                <div class="wrap-title-anonse">
                                                    <h5 class="title"><?the_title()?></h5>
                                                    <div class="anonse"><?=get_field('product-desc')?></div>
                                                </div>

                                                <div class="tags">
                                                    <?foreach(get_field('product-tags') as $tag):?>
                                                        <?if($tag == 'new'):?><div class="new">Новинка</div><?endif?>
                                                        <?if($tag == 'gvnlp'):?><div class="gvnlp">ЖНВЛП</div><?endif?>
                                                    <?endforeach;?>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="go-directory">Подробнее о препарате</span>
                                    </a>
                                </li>
                            <?endif;?>
                        <?else:?>
                            <li>
                                <a href="<?=esc_url(get_permalink())?>">
                                <div class="product-link">
                                    <div class="product-link-wrap">
                                        <div class="product-img" style="background-image: url(<?=get_field('product-img')?>);"></div>
                                        <div class="wrap-title-anonse">
                                            <h5 class="title"><?the_title()?></h5>
                                            <div class="anonse"><?=get_field('product-desc')?></div>
                                        </div>

                                        <div class="tags">
                                            <?foreach(get_field('product-tags') as $tag):?>
                                                <?if($tag == 'new'):?><div class="new">Новинка</div><?endif?>
                                                <?if($tag == 'gvnlp'):?><div class="gvnlp">ЖНВЛП</div><?endif?>
                                            <?endforeach;?>
                                        </div>
                                    </div>
                                </div>
                                <span class="go-directory">Подробнее о препарате</span>
                                </a>
                            </li>
                        <?endif;?>
      				
					<?php endwhile; endif;?>
                    <li style="height: 0;margin: 0; padding: 0; box-shadow: none"></li>
                    <li style="height: 0;margin: 0; padding: 0; box-shadow: none"></li>
                    <li style="height: 0;margin: 0; padding: 0; box-shadow: none"></li>

                </ul>

            </div>

        </div>
<script>
    $(function(){
        if($('.main-news-list>li').length >4){
            $('.main-news-list>li').eq(2).after( $('.slider-recommend-wrap') );
        }

        var my_link = location.pathname.split('/');

        if(my_link[2] == 'new'){
            $('.sort, .sort-list-wrap').remove();
        }

       

        
      
    });
</script>

<?php
get_footer();
