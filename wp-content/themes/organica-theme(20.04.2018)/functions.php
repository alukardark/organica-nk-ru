<?php

if ( ! function_exists( 'organica_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function organica_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on organica-theme, use a find and replace
		 * to change 'organica-theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'organica-theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'organica-theme' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'organica_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'organica_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function organica_theme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'organica_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'organica_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function organica_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'organica-theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'organica-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'organica_theme_widgets_init' );


function IE(){
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if (stripos($user_agent, 'MSIE 6.0') !== false) {
        header("Location: /ie67/ie6.html");
        exit;
    }
    if (stripos($user_agent, 'MSIE 7.0') !== false) {
        header("Location: /ie67/ie7.html");
        exit;
    }
    if (stripos($user_agent, 'MSIE 8.0') !== false) {
        header("Location: /ie67/ie8.html");
        exit;
    }
    if (stripos($user_agent, 'MSIE 9.0') !== false) {
        header("Location: /ie67/ie9.html");
        exit;
    }
    if (stripos($user_agent, 'MSIE 10') !== false) {
        header("Location: /ie67/ie10.html");
        exit;
    }
}
IE();


/**
 * Enqueue scripts and styles.
 */
function organica_theme_scripts() {
 
    wp_enqueue_style( 'YTPlayer-css', get_template_directory_uri().'/lib/jquery.mb.YTPlayer/dist/css/jquery.mb.YTPlayer.min.css');
    wp_enqueue_style( 'slick-css', get_template_directory_uri().'/lib/slick/slick.css');
    wp_enqueue_style( 'slick-theme-css', get_template_directory_uri().'/lib/slick/slick-theme.css');
    wp_enqueue_style( 'aos-css', get_template_directory_uri().'/lib/aos/aos.css');
    wp_enqueue_style( 'fancybox-css', get_template_directory_uri().'/lib/fancybox/jquery.fancybox.min.css');
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri().'/lib/bootstrap/css/bootstrap.css');
    wp_enqueue_style( 'animate-css', get_template_directory_uri().'/lib/animate.min.css');
    wp_enqueue_style( 'ionicons-css', get_template_directory_uri().'/lib/ionicons/css/ionicons.min.css');
	wp_enqueue_style( 'organica-theme-style', get_stylesheet_uri() );



	wp_enqueue_script( 'jquery.min.js', get_template_directory_uri() . '/lib/jquery.min.js', '', '', false);
    wp_enqueue_script( 'YTPlayer.js', get_template_directory_uri() . '/lib/jquery.mb.YTPlayer/dist/jquery.mb.YTPlayer.min.js', '', '', false);
    wp_enqueue_script( 'cookie.js', get_template_directory_uri() . '/lib/js.cookie.js', '', '', false);
    wp_enqueue_script( 'slick.min.js', get_template_directory_uri() . '/lib/slick/slick.min.js', '', '', false);
    wp_enqueue_script( 'aos.js', get_template_directory_uri() . '/lib/aos/aos.js', '', '', false);
    wp_enqueue_script( 'jquery.fancybox.min.js', get_template_directory_uri() . '/lib/fancybox/jquery.fancybox.min.js', '', '', false);
    wp_enqueue_script( 'bootstrap.min.js', get_template_directory_uri() . '/lib/bootstrap/js/bootstrap.min.js', '', '', false);
    wp_enqueue_script( 'demo6.js', get_template_directory_uri() . '/js/demo6.js', '', '', false);
    wp_enqueue_script( 'common.js', get_template_directory_uri() . '/js/common.js', '', '', false);



	wp_enqueue_script( 'organica-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'organica-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'organica_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



// function IE(){
//     $user_agent = $_SERVER['HTTP_USER_AGENT'];
//     if (stripos($user_agent, 'MSIE 6.0') !== false) {
//         header("Location: /ie67/ie6.html");
//         exit;
//     }
//     if (stripos($user_agent, 'MSIE 7.0') !== false) {
//         header("Location: /ie67/ie7.html");
//         exit;
//     }
//     if (stripos($user_agent, 'MSIE 8.0') !== false) {
//         header("Location: /ie67/ie8.html");
//         exit;
//     }
//     if (stripos($user_agent, 'MSIE 9.0') !== false) {
//         header("Location: /ie67/ie9.html");
//         exit;
//     }
// }
// IE();

if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'mygallery', 932, 475, true );
    add_image_size( 'banners', 360, 330, true );
}

// remove_filter( 'the_content', 'wpautop' );
// remove_filter( 'the_excerpt', 'wpautop' );
// 


function startsWith($haystack, $needle)
{
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
}
function endsWith($haystack, $needle)
{
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
}

add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

    return $content;
});
function remove_image_size_attributes( $html ) {
    return preg_replace( '/(width|height)="\d*"/', '', $html );
}

// Remove image size attributes from post thumbnails
add_filter( 'post_thumbnail_html', 'remove_image_size_attributes' );

// Remove image size attributes from images added to a WordPress post
add_filter( 'image_send_to_editor', 'remove_image_size_attributes' );





function array_to_object($array)
{
    $obj = new \stdClass;

    foreach ($array as $k => $v) {
        if (strlen($k)) {
            if (is_array($v)) {
                $obj->{$k} = array_to_object($v); // Recursion.
            } else {
                $obj->{$k} = $v;
            }
        }
    }

    return $obj;
}
function mypaginate_links($args = '')
{
    $defaults = array(
        'base' => '%_%', // Example http://example.com/all_posts.php%_% : %_% is replaced by format (below).
        'format' => '?page=%#%', // Example ?page=%#% : %#% is replaced by the page number.
        'total' => 1,
        'current' => 0,
        'show_all' => false,
        'prev_next' => true,
        'prev_text' => __('&laquo; Previous'),
        'next_text' => __('Next &raquo;'),
        'end_size' => 1,
        'mid_size' => 2,
        'type' => 'array',
        'add_args' => false, // Array of query args to add.
        'add_fragment' => '',
    );
    $args = wp_parse_args($args, $defaults);

    // Who knows what else people pass in $args.
    $args['total'] = intval((int) $args['total']);
    if ($args['total'] < 2) {
        return array();
    }
    $args['current'] = (int) $args['current'];
    $args['end_size'] = 0 < (int) $args['end_size'] ? (int) $args['end_size'] : 1; // Out of bounds?  Make it the default.
    $args['mid_size'] = 0 <= (int) $args['mid_size'] ? (int) $args['mid_size'] : 2;
    $args['add_args'] = is_array($args['add_args']) ? $args['add_args'] : false;
    $page_links = array();
    $dots = false;
    if ($args['prev_next'] && $args['current'] && 1 < $args['current']) {
        $link = str_replace('%_%', 2 === absint($args['current']) ? '' : $args['format'], $args['base']);
        $link = str_replace('%#%', $args['current'] - 1, $link);
        if ($args['add_args']) {
            $link = add_query_arg($args['add_args'], $link);
        }
        $link .= $args['add_fragment'];
        $link = untrailingslashit($link);
        $page_links[] = array(
            'class' => 'prev page-numbers',
            'link' => esc_url(apply_filters('mypaginate_links', $link)),
            'title' => $args['prev_text'],
        );
    }
    for ($n = 1; $n <= $args['total']; $n++) {
        $n_display = number_format_i18n($n);
        if (absint($args['current']) === $n) {
            $page_links[] = array(
                'class' => 'page-number page-numbers current',
                'title' => $n_display,
                'text' => $n_display,
                'name' => $n_display,
                'current' => true,
            );
            $dots = true;
        } else {
            if ($args['show_all'] || ( $n <= $args['end_size'] || ( $args['current'] && $n >= $args['current'] - $args['mid_size'] && $n <= $args['current'] + $args['mid_size'] ) || $n > $args['total'] - $args['end_size'] )) {
                $link = str_replace('%_%', 1 === absint($n) ? '' : $args['format'], $args['base']);
                $link = str_replace('%#%', $n, $link);
                $link = trailingslashit($link) . ltrim($args['add_fragment'], '/');
                if ($args['add_args']) {
                    $link = rtrim(add_query_arg($args['add_args'], $link), '/');
                }
                $link = str_replace(' ', '+', $link);
                $link = untrailingslashit($link);
                $page_links[] = array(
                    'class' => 'page-number page-numbers',
                    'link' => esc_url(apply_filters('mypaginate_links', $link)),
                    'title' => $n_display,
                    'name' => $n_display,
                    'current' => absint($args['current']) === $n,
                );
                $dots = true;
            } elseif ($dots && ! $args['show_all']) {
                $page_links[] = array(
                    'class' => 'dots',
                    'title' => __('&hellip;'),
                );
                $dots = false;
            }
        }
    }
    if ($args['prev_next'] && $args['current'] && ( $args['current'] < $args['total'] || -1 === intval($args['total']) )) {
        $link = str_replace('%_%', $args['format'], $args['base']);
        $link = str_replace('%#%', $args['current'] + 1, $link);
        if ($args['add_args']) {
            $link = add_query_arg($args['add_args'], $link);
        }
        $link = untrailingslashit(trailingslashit($link) . $args['add_fragment']);
        $page_links[] = array(
            'class' => 'next page-numbers',
            'link' => esc_url(apply_filters('mypaginate_links', $link)),
            'title' => $args['next_text'],
        );
    }
    return $page_links;
}
function get_pagination($prefs = array())
{

    global $wp_query;
    global $paged;
    global $wp_rewrite;

    $args = array();
    $args['total'] = ceil($wp_query->found_posts / $wp_query->query_vars['posts_per_page']);

    if ($wp_rewrite->using_permalinks()) {
        $url = explode('?', get_pagenum_link(0));

        if (isset($url[1])) {
            parse_str($url[1], $query);
            $args['add_args'] = $query;
        }

        $args['format'] = 'page/%#%';
        $args['base'] = trailingslashit($url[0]).'%_%';
    } else {
        $big = 999999999;
        $args['base'] = str_replace($big, '%#%', esc_url(get_pagenum_link($big)));
    }

    $args['type'] = 'array';
    $args['current'] = max(1, get_query_var('paged'));
    $args['mid_size'] = max(9 - $args['current'], 3);
    $args['prev_next'] = false;

    if (is_int($prefs)) {
        $args['mid_size'] = $prefs - 2;
    } else {
        $args = array_merge($args, $prefs);
    }

    $data = array();
    $data['pages'] = mypaginate_links($args);
    $next = get_next_posts_page_link($args['total']);

    if ($next) {
        $data['next'] = array( 'link' => untrailingslashit($next), 'class' => 'page-numbers next' );
    }

    $prev = previous_posts(false);

    if ($prev) {
        $data['prev'] = array( 'link' => untrailingslashit($prev), 'class' => 'page-numbers prev' );
    }

    if ($paged < 2) {
        $data['prev'] = null;
    }

    return array_to_object($data);
}

function iti_custom_posts_per_page($query)
{
    if(startsWith($_SERVER['REQUEST_URI'], '/company/news/')){
        switch ($query->query_vars['post_type']) {
            case 'news':
                $query->query_vars['posts_per_page'] = 6;
                break;
            default:
                break;
        }
        return $query;
    }

    if(startsWith($_SERVER['REQUEST_URI'], '/articles/')){
        switch ($query->query_vars['post_type']) {
            case 'articles':
                $query->query_vars['posts_per_page'] = 5;
                break;
            default:
                break;
        }
        return $query;
    }

     if(startsWith($_SERVER['REQUEST_URI'], '/publications/mass-media/')){
        switch ($query->query_vars['post_type']) {
            case 'mass_media':
                $query->query_vars['posts_per_page'] = 6;
                break;
            default:
                break;
        }
        return $query;
    }
}
if( !is_admin() )
{
    add_filter( 'pre_get_posts', 'iti_custom_posts_per_page' );
}

require get_template_directory() . "/ajax-load-news.php";


function rus2translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '',  'ы' => 'y',   'ъ' => '',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '',  'Ы' => 'Y',   'Ъ' => '',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return strtr($string, $converter);
}
function latin($str) {
    // переводим в транслит
    $str = rus2translit($str);
    // в нижний регистр
    $str = strtolower($str);
    // заменям все ненужное нам на "-"
    $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
    // удаляем начальные и конечные '-'
    $str = trim($str, "-");
    return $str;
}


function register_post_type_news() {
    $labels = array(
        'name' => 'Новости',
        'singular_name' => 'Новости', // админ панель Добавить->Функцию
        'add_new' => 'Добавить новость',
        'add_new_item' => 'Добавить новую новость',
        'edit_item' => 'Редактировать новость',
        'new_item' => 'Новая новость',
        'all_items' => 'Все новости',
        'view_item' => 'Просмотреть новость',
        'search_items' => 'Искать новость',
        'not_found' =>  'Новостей не найдено.',
        'not_found_in_trash' => 'В корзине нет новостей.',
        'menu_name' => 'Новости' // ссылка в меню в админке
    );
    $args = array(

        'rewrite' => array( 'slug'=>'company/news', 'with_front' => false ),
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        //'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
        'menu_icon' => 'dashicons-editor-kitchensink', // иконка в меню
        'menu_position' => 30 // порядок в меню
    ,'supports' => array('title','excerpt', 'editor')
    );
    register_post_type('news', $args);
}
add_action( 'init', 'register_post_type_news' );

function register_post_type_mass_media() {
    $labels = array(
        'name' => 'СМИ о нас',
        'singular_name' => 'СМИ о нас', // админ панель Добавить->Функцию
        'add_new' => 'Добавить новость',
        'add_new_item' => 'Добавить новую новость',
        'edit_item' => 'Редактировать новость',
        'new_item' => 'Новая новость',
        'all_items' => 'Все новости',
        'view_item' => 'Просмотреть новость',
        'search_items' => 'Искать новость',
        'not_found' =>  'Новостей не найдено.',
        'not_found_in_trash' => 'В корзине нет новостей.',
        'menu_name' => 'СМИ о нас' // ссылка в меню в админке
    );
    $args = array(
        'rewrite' => array( 'slug'=>'publications/mass-media', 'with_front' => false ),
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        //'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
        'menu_icon' => 'dashicons-editor-kitchensink', // иконка в меню
        'menu_position' => 30 // порядок в меню
    ,'supports' => array('title','excerpt', 'editor')
    );
    register_post_type('mass_media', $args);
}
add_action( 'init', 'register_post_type_mass_media' );

function register_post_type_photogallery() {
    $labels = array(
        'name' => 'Фотогалерея',
        'singular_name' => 'Фотогалерея', // админ панель Добавить->Функцию
        'add_new' => 'Добавить альбом',
        'add_new_item' => 'Добавить новый альбом',
        'edit_item' => 'Редактировать альбом',
        'new_item' => 'Новый альбом',
        'all_items' => 'Все альбомы',
        'view_item' => 'Просмотреть альбом',
        'search_items' => 'Искать альбомы',
        'not_found' =>  'Альбомов не найдено.',
        'not_found_in_trash' => 'В корзине нет альбомов.',
        'menu_name' => 'Фотогалерея' // ссылка в меню в админке
    );
    $args = array(
        'rewrite' => array( 'slug'=>'company/photogallery', 'with_front' => false ),
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        //'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
        'menu_icon' => 'dashicons-format-gallery', // иконка в меню
        'menu_position' => 30 // порядок в меню
    ,'supports' => array('title')
    );
    register_post_type('photogallery', $args);
}

add_action( 'init', 'register_post_type_photogallery' ); 

function register_post_type_documents() {
    $labels = array(
        'name' => 'Документы',
        'singular_name' => 'Документы', // админ панель Добавить->Функцию
        'add_new' => 'Добавить документ',
        'add_new_item' => 'Добавить новый документ',
        'edit_item' => 'Редактировать документ',
        'new_item' => 'Новый документ',
        'all_items' => 'Все документы',
        'view_item' => 'Просмотреть документ',
        'search_items' => 'Искать документы',
        'not_found' =>  'Документов не найдено.',
        'not_found_in_trash' => 'В корзине нет документов.',
        'menu_name' => 'Документы' // ссылка в меню в админке
    );
    $args = array(
         'rewrite' => array( 'slug'=>'company/documents', 'with_front' => false ),
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        //'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
        'menu_icon' => 'dashicons-portfolio', // иконка в меню
        'menu_position' => 30 // порядок в меню
    ,'supports' => array('title')
    );
    register_post_type('documents', $args);
}

add_action( 'init', 'register_post_type_documents' );


function register_post_type_contacts() {
    $labels = array(
        'name' => 'Контакты отделов',
        'singular_name' => 'Контакты отделов', // админ панель Добавить->Функцию
        'add_new' => 'Добавить контакт',
        'add_new_item' => 'Добавить новые контакты',
        'edit_item' => 'Редактировать контакты',
        'new_item' => 'Новые контакты',
        'all_items' => 'Все контакты',
        'view_item' => 'Просмотр контакты',
        'search_items' => 'Искать контакты',
        'not_found' =>  'Контактов не найдено.',
        'not_found_in_trash' => 'В корзине нет контактов.',
        'menu_name' => 'Контакты отделов' // ссылка в меню в админке
    );
    $args = array(
        'exclude_from_search' => true,
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        //'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
        'menu_icon' => 'dashicons-feedback', // иконка в меню
        'menu_position' => 29 // порядок в меню
    ,'supports' => array( 'title' )
    );
    register_post_type('contacts', $args);
}

add_action( 'init', 'register_post_type_contacts' );

function register_post_type_settings() {
    $labels = array(
        'name' => 'Контактные данные и прочее',
        'singular_name' => 'Контактные данные и прочее', // админ панель Добавить->Функцию
        'add_new' => 'Добавить настройки',
        'add_new_item' => 'Добавить новые настройки',
        'edit_item' => 'Редактировать настройки',
        'new_item' => 'Новые настройки',
        'all_items' => 'Все настройки',
        'view_item' => 'Просмотр настроек',
        'search_items' => 'Искать настройки',
        'not_found' =>  'Настроек не найдено.',
        'not_found_in_trash' => 'В корзине нет Настроек.',
        'menu_name' => 'Контактные данные и прочее' // ссылка в меню в админке
    );
    $args = array(
        'exclude_from_search' => true,
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        //'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
        'menu_icon' => 'dashicons-wordpress-alt', // иконка в меню
        'menu_position' => 29 // порядок в меню
    ,'supports' => array( '' )
    );
    register_post_type('settings', $args);
}

add_action( 'init', 'register_post_type_settings' );


function register_post_type_products() {
    $labels = array(
        'name' => 'Наши препараты',
        'singular_name' => 'Наши препараты', // админ панель Добавить->Функцию
        'add_new' => 'Добавить препарат',
        'add_new_item' => 'Добавить новый препарат',
        'edit_item' => 'Редактировать препарат',
        'new_item' => 'Новый препарат',
        'all_items' => 'Все препараты',
        'view_item' => 'Просмотр препарат',
        'search_items' => 'Искать препарат',
        'not_found' =>  'Препаратов не найдено.',
        'not_found_in_trash' => 'В корзине нет препаратов.',
        'menu_name' => 'Наши препараты' // ссылка в меню в админке
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        //'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
        'menu_icon' => 'dashicons-products', // иконка в меню
        'menu_position' => 29 // порядок в меню
    ,'supports' => array( 'title' )
    );
    register_post_type('products', $args);
}

add_action( 'init', 'register_post_type_products' );


function register_post_type_articles() {
    $labels = array(
        'name' => 'Научные статьи',
        'singular_name' => 'Научные статьи', // админ панель Добавить->Функцию
        'add_new' => 'Добавить статью',
        'add_new_item' => 'Добавить новую статью',
        'edit_item' => 'Редактировать статью',
        'new_item' => 'Новая статья',
        'all_items' => 'Все статьи',
        'view_item' => 'Просмотреть статью',
        'search_items' => 'Искать статью',
        'not_found' =>  'Статей не найдено.',
        'not_found_in_trash' => 'В корзине нет статей.',
        'menu_name' => 'Статьи' // ссылка в меню в админке
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        //'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
        'menu_icon' => 'dashicons-media-text', // иконка в меню
        'menu_position' => 30 // порядок в меню
    ,'supports' => array('title')
    );
    register_post_type('articles', $args);
}
add_action( 'init', 'register_post_type_articles' );


function register_post_type_banners_products() {
    $labels = array(
        'name' => 'Баннеры (Продукты)',
        'singular_name' => 'Баннеры (Продукты)', // админ панель Добавить->Функцию
        'add_new' => 'Добавить баннер',
        'add_new_item' => 'Добавить новый баннер',
        'edit_item' => 'Редактировать баннер',
        'new_item' => 'Новый баннер',
        'all_items' => 'Все баннера',
        'view_item' => 'Просмотреть баннер',
        'search_items' => 'Искать баннер',
        'not_found' =>  'Баннеров не найдено.',
        'not_found_in_trash' => 'В корзине нет баннеров.',
        'menu_name' => 'Баннеры (Продукты)' // ссылка в меню в админке
    );
    $args = array(
        'exclude_from_search' => true,
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        //'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
        'menu_icon' => 'dashicons-exerpt-view', // иконка в меню
        'menu_position' => 30 // порядок в меню
    ,'supports' => array('title')
    );
    register_post_type('banners_products', $args);
}

add_action( 'init', 'register_post_type_banners_products' ); // Использовать функцию только внутри хука init

function register_post_type_banners_publications() {
    $labels = array(
        'name' => 'Баннеры (Публикации)',
        'singular_name' => 'Баннеры (Публикации)', // админ панель Добавить->Функцию
        'add_new' => 'Добавить баннер',
        'add_new_item' => 'Добавить новый баннер',
        'edit_item' => 'Редактировать баннер',
        'new_item' => 'Новый баннер',
        'all_items' => 'Все баннера',
        'view_item' => 'Просмотреть баннер',
        'search_items' => 'Искать баннер',
        'not_found' =>  'Баннеров не найдено.',
        'not_found_in_trash' => 'В корзине нет баннеров.',
        'menu_name' => 'Баннеры (Публикации)' // ссылка в меню в админке
    );
    $args = array(
        'exclude_from_search' => true,
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        //'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
        'menu_icon' => 'dashicons-exerpt-view', // иконка в меню
        'menu_position' => 30 // порядок в меню
    ,'supports' => array('title')
    );
    register_post_type('banners_publications', $args);
}

add_action( 'init', 'register_post_type_banners_publications' ); // Использовать функцию только внутри хука init


function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'cf_search_join' );

function cf_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );





add_action('init','yoursite_init');
function yoursite_init() {
    global
    $wp,$wp_rewrite;
    $wp->add_query_var('tags');
    $wp_rewrite->add_rule('products/new',
        'index.php?tags=new&post_type=products&name=$matches[1]', 'top');

    // Once you get working, remove this next line
    $wp_rewrite->flush_rules(false);
}