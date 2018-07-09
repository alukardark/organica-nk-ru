<?php
get_header();
?>

    <div class="shadow-wrap">
        <div class="inner-page-header">

            <div class="wrapper">
                <ul class="breadcrumbs ">
                    <?php if(function_exists('bcn_display')){bcn_display();}?>
                </ul>
                <h1>Результаты поиска: <?=get_search_query()?></h1>
            </div>

        </div>
        <div class="inner-page-cont">

            <div class="wrapper">
        <?
			if ( have_posts() ) : 
	           	while ( have_posts() ) :
					the_post();

					?>
					<div class="search-block">
						<h5> <a href="<?=esc_url( get_permalink() )?>"> <?the_title();?> </a> </h5>
					</div>
					<?	
					
	            endwhile;
			else :
				echo "Ничего не найдено";
			endif;

                 ?>
            </div>

        </div>
    </div>




	
	

		

			<?php

		




get_footer();
?>