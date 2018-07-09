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
                    <div class="tags">
                    	<?foreach(get_field('product-tags') as $tag):?>
                    		<?if($tag == 'new'):?><div class="new">Новинка</div><?endif?>
                            <?if($tag == 'gvnlp'):?><div class="gvnlp">ЖНВЛП</div><?endif?>
                        <?endforeach;?>
                    </div>
                </div>
            </div>
            <div class="inner-page-cont articles product">
                <div class="product-media">
                    <div class="product-media-wrap-slider">
                        <div class="product-slider-for-wrap">
                            <i class="ion-ios-arrow-left" style=""></i>
                            <div class="product-slider-for">
                                <div class="product-slider-for-item">
									<a href="<?=get_field('product-img')?>" data-fancybox>
                                        <div class="product-img" style="background-image: url(<?=get_field('product-img')?>);"></div>
                                    </a>
                                </div>
                                <?foreach (get_field('product-gallery') as $product_gallery_item):?>
			                		<div class="product-slider-for-item">
	                                    <a href="<?=$product_gallery_item['url']?>" data-fancybox class="fancybox-iframe" >
	                                        <div class="product-img" style="background-image: url(<?=$product_gallery_item['url']?>);"></div>
	                                    </a>
                                	</div>
                        		<?endforeach;?>
                            </div>
                            <i class="ion-ios-arrow-right" style=""></i>
                        </div>
                        <div class="product-slider-nav">

                        	<?if(get_field('product-gallery')):?>
	                            <div class="product-slider-nav-item">
	                                <div class="product-img" style="background-image: url(<?=get_field('product-img')?>);"></div>
	                            </div>
                            <?endif;?>
                            <?foreach (get_field('product-gallery') as $product_gallery_item) {?>
	                    	 	
                                <div class="product-slider-nav-item">
                                    <div class="product-img" style="background-image: url(<?=$product_gallery_item['url']?>);"></div>
                                </div>
                            <?}?>
                        </div>
                    </div>
                    <div class="files-list">

                    	<?foreach(get_field('product-file-wrap') as $file):?>
	                		<?$format = substr(strrchr( $file['product-file']['url'] , "."), 1);?>
							<a href="<?=$file['product-file']['url']?>" download class="link-documents <?=$format?>"><?=$file['product-file']['title']?></a>
                        <?endforeach;?>
                        
                        
                        <?
                            $this_name = get_the_title();
                            $this_post_name = get_post()->post_name;
                            



                            global $post;
                            $args = array('post_type' => 'articles', 'order' => 'DESC','numberposts' => -1);
                            $myposts = get_posts( $args );
                            foreach( $myposts as $post ){
                                setup_postdata($post);

                                
                                
                                foreach (get_field('articles-product') as $value) {


                                    if($this_post_name == $value->post_name):?>
                                        <?if(get_field('product-common-title', $value->ID)){
                                            $this_name = get_field('product-common-title', $value->ID);
                                        }?>
                                        <a href="<?="/articles/?sorproduct=".$value->ID?>" class="link-article link-article-new">Читать статьи про <?=$this_name?></a>
                                    <?
                                    break;
                                    endif;
                                }
                              

                                
                              
                            }wp_reset_postdata();
                      ?>


                    </div>
                </div>
                <div class="product-info">

                    <ul class="nostyle-list product-info-list">
                    	<?if(get_field('product-farmgroup-full')):?>
	                        <li>
	                            <b><?=get_field('product-farmgroup-full')?></b>
	                        </li>
                       	<?endif;?>
                       	<?if(get_field('product-mnn')):?>
	                        <li>
	                            <b>МНН - <?=get_field('product-mnn')?></b>
	                        </li>
                       	<?endif;?> 
                     	<?if(get_field('product-active')):?>
	                        <li>
	                            <b>Активное вещество:</b> <?=get_field('product-active')?>
	                        </li>
                       	<?endif;?>
                       	<?if(get_field('product-num')):?>
	                        <li>
	                            <b>Регистрационный номер:</b> <?=get_field('product-num')?>
	                        </li>
                        <?endif;?>
                        <?if(get_field('product-desc')):?>
	                        <li>
	                            <b>Форма выпуска:</b> <?=get_field('product-desc')?>
	                        </li>
                        <?endif;?>
                    </ul>

					<?if(get_field('product-text')):?>
                    	 <div class="product-text">
	                        <?=get_field('product-text')?>
	                    </div>
                    <?endif;?>
                   

                    <div class="contraindications">Имеются противопоказания. Перед применением проконсультируйтесь с врачом</div>
                    <a href="<?=get_post_type_archive_link('products')?> " class="back">Назад в каталог</a>

                </div>
            </div>
        </div>


<?php
get_footer();
