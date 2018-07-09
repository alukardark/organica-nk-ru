<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="yandex-verification" content="47a20d1cfc98cfe0" />
    <meta name="google-site-verification" content="y7mtsRHa3h5aDxTFApzkr3BmBqVo7v1phszpMz8UZ-0" />
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
    <meta name="format-detection" content="telephone=no">
    
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TR9QCGP');</script>
    <!-- End Google Tag Manager -->

    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TR9QCGP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="search-win-wrap">
    <div class="search-win">
        <div id="btn-search-close" class="btn--hidden sort-list-wrap-close"></div>
            <div class="inner-page-header">
                <div class="wrapper">
                    <h2>Поиск по сайту</h2>
                    </div>
            </div>
                    <form role="search" method="get" class="search-form" action="/">
                        
                        <div class="form-row">
                            <i class="ion-ios-search-strong"></i>
                            <span class="form-placeholder">Что вы ищете?</span>
                            <input type="search" class="search-form-input" name="s" required>
                        </div>

                        <input type="submit" class="search-submit" value="Искать">
                    </form>

    </div>
</div>


<?if(!is_front_page()){?>
<div class="wrap-page">
<div class="inner-page">
<?}?>



<header>
    <a href="/" class="logo"></a>
    <div class="nav-wrap">
        <a href="#" class="burger">
            <span></span>
            <p>Меню</p>
        </a>
        <ul class="nav-menu">
            <li class="drop-down">
                <a href="/company/">О компании</a><i class="ion-chevron-down"></i>
                <ul>
                    <li><a href="/organika-segodnya/">Органика сегодня</a></li>
                    <li><a href="/company/istoriya/">История</a></li>
                    <li><a href="/company/news/">Новости</a></li>
                    <li><a rel="nofollow" target="_blank"  href="http://www.e-disclosure.ru/portal/company.aspx?id=565">Акционерам</a></li>
                    <li><a href="/company/documents/">Документы</a></li>
                    <li><a href="/company/photogallery/">Фотогалерея</a></li>
                </ul>
            </li>
            <li>
                <a href="/products/">Продукция</a><i class="ion-chevron-down"></i>
                <ul>
                    <li><a href="/products/">Наши препараты</a></li>
                    <li><a href="/farmakonadzor/">Фармаконадзор</a></li>
                    <li><a href="/spisok-iii/">Список III</a></li>
                </ul>
            </li>
            <li><a href="/products/new/">Новые препараты</a></li>
            <li class="drop-down">
                <a href="/articles/">Публикации</a><i class="ion-chevron-down"></i>
                <ul>
                    <li><a href="/articles/">Научные статьи</a></li>
                    <li><a href="/publications/mass-media/">СМИ о нас</a></li>
                </ul>
            </li>
            <li><a href="/contact/">Контакты</a></li>
        </ul>
    </div>
    <a href="#" id="btn-search" class="search-link ion-ios-search-strong"></a>
    <a href="/eng/" class="eng-link">EN</a>
</header>