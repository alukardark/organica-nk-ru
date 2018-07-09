<?
add_action( 'wp_ajax_get_result_url', 'get_result_url' );
add_action( 'wp_ajax_nopriv_get_result_url', 'get_result_url' );


// function iti_custom_posts_per_page_new($query)
// {
//     $query->query_vars['posts_per_page'] = 6;
//     return $query;
// }
// if( !is_admin() )
// {
//     add_filter( 'pre_get_posts', 'iti_custom_posts_per_page' );
// }


function get_result_url() {
    global $query_string;

    // $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $paged = $_POST['PAGE_NUMBER'];


    $custom_query = new WP_Query( array( 'post_type' => 'news', 'paged' => $paged , 'posts_per_page'=>6) );


   
    if ( $custom_query->have_posts() ) : while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
        <li class="ajax-new">
            <div class="main-news-date"><?=get_the_date('d F Y')?></div>
            <a href="<?=esc_url(get_permalink())?>" class="main-news-title"><?the_title()?></a>
            <div class="main-news-text">
                <p><?php the_excerpt(); ?></p>
            </div>
        </li>
    <?php endwhile; endif;?>

    <ul class="pagination">
        <? $pagination = get_pagination(); 
            var_dump($pagination);
        ?>

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
<?wp_die();
}


