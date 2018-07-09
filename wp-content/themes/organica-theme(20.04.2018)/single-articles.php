<?php
get_header();
?>

<div class="shadow-wrap">
            <div class="inner-page-header">

                <div class="wrapper">
                    <ul class="breadcrumbs ">
                        <?php if(function_exists('bcn_display')){bcn_display();}?>
                    </ul>
                    <h1>Научные статьи</h1>
                </div>

            </div>
            <div class="inner-page-cont articles">
            <div class="article-attitude">
                <?
                    foreach (get_field('articles-product') as $value) {
                        if( get_field('product-common-title', $value->ID )){
                            echo get_field('product-common-title', $value->ID );
                            break;
                        }else{
                            echo $value->post_title;
                            break;
                        }
                    }
                ?>
            </div>
                <div class="wrapper">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <h2>
                        <?the_title()?>
                    </h2>

                    <div class="text">
                       <?=get_field('articles-text')?>
                    </div>

                    <div class="article-extra">
                        <div class="autor">
                            <?=get_field('articles-author')?>
                        </div>
                            <?
                              $format = substr(strrchr( get_field('articles-file')['url'] , "."), 1);
                                if($format=='doc' || $format=='docx'){
                                    $format_ico = get_template_directory_uri()."/img/doc.png";
                                }elseif($format=='pdf'){
                                    $format_ico = get_template_directory_uri()."/img/pdf.png";
                                }else{
                                    $format_ico = get_template_directory_uri()."/img/txt.png";
                                }
                                if(get_field('articles-file')):
                            ?>
                                <a target="_blank" href="<?=get_field('articles-file')['url']?>" class="article-download">
                                    <img src="<?=$format_ico?>" alt="">
                                    <span>Прочитать статью полностью</span>
                                </a>
                            <?endif?>
                    </div>
                <?php endwhile; endif; ?>
                    <a href="<?=get_post_type_archive_link('articles')?>" class="back">Назад</a>

                </div>

            </div>
</div>


<script>
    $(function(){
        if($('.main-news-list>li').length>3){
            $('.main-news-list>li').eq(1).after( $('.slider-recommend-wrap') );
        }

        $('.articles-enter-yes').click(function(e){
            e.preventDefault();
            Cookies.set('articles-enter', 'Y');
            $('#articles-enter').modal('hide');
        });
        $('.articles-enter-no').click(function(){
            Cookies.set('articles-enter');
        });

        $('#articles-enter .sort-list-wrap-close').click(function(){
            document.location.href = "/";
        });

        if(!Cookies.get('articles-enter')){
            $('#articles-enter').modal('show');
        }

    });
</script>
<?php
get_footer();
