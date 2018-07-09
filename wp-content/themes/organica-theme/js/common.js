var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;


var ms_ie = false;
var ua = window.navigator.userAgent;
var old_ie = ua.indexOf('MSIE ');
var new_ie = ua.indexOf('Trident/');
if ((old_ie > -1) || (new_ie > -1)) {
    ms_ie = true;
}

$(function(){

    

    if( $("#main-video").length && !isMobile){
        var videoLink = $("#main-video").data('video');
        var videos = [
            {videoURL: videoLink,containment:'#main-video',stopMovieOnBlur: false, optimizeDisplay: true, showControls:false, autoPlay:true, mute:true, ratio:"auto", addRaster:true}
        ];
        $("#main-video").YTPlaylist(videos, false);
    }

    $('#scroll-top').click(function(e){
        $('html,body').animate({scrollTop: 0}, 'slow');
        return false;
    });
    if($(window).scrollTop()<750){
        $('#scroll-top').css('opacity', '0');
        $('#scroll-top').css('visibility', 'hidden');
    }else{
        $('#scroll-top').css('opacity', '1');
        $('#scroll-top').css('visibility', 'visible');
    }

     $(window).on('scroll resize orienationchange', function() {
        var wScroll = $(this).scrollTop();
        if(wScroll<750){
            $('#scroll-top').css('opacity', '0');
            $('#scroll-top').css('visibility', 'hidden');
        }else{
            $('#scroll-top').css('opacity', '1');
            $('#scroll-top').css('visibility', 'visible');
        }
    });



    $('.sort').click(function(e){
        e.preventDefault();
        $(this).siblings('.sort').removeClass('open');
        $(this).toggleClass('open');
        var $dataBtn = $(this).data('btn')
        
        $('.sort-list-wrap').each(function() {
            if( $dataBtn == $(this).data('sort') ){
                $(this).siblings('.sort-list-wrap').removeClass('open');
                $(this).toggleClass('open');
            }
        });  

        if($('.sort').hasClass('open')){
            $('.products-list').addClass('open');
        }else{
            $('.products-list').removeClass('open');
        }

    });
    $('.sort-list-wrap-close').on('click', function(){
        $(this).parent('.sort-list-wrap').removeClass('open');
        var $dataBtn = $(this).parent('.sort-list-wrap').data('sort');

        $('.sort').each(function() {
            if( $dataBtn == $(this).data('btn') ){
                $(this).removeClass('open');
            }
        }); 
        $('.products-list').removeClass('open');
    });


    $('.btn-down').click(function(e){
        var href = $(this).attr('href');
        if($(href).length){
            $('html, body').animate({
                scrollTop: $(href).offset().top
            }, 850 );
        }
        return false;
    });

    $(".burger").click(function (e) {
        e.preventDefault();
        $(this).toggleClass("menu-on");
        $('.nav-menu').toggleClass("menu-vis");
    });

    $('.slider-recommend').slick({
        swipe: false,
        dots: false,
        autoplay: true,
        autoplaySpeed: 3500,
        prevArrow: $('.slider-recommend-wrap .ion-ios-arrow-left'),
        nextArrow: $('.slider-recommend-wrap .ion-ios-arrow-right'),
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    swipe: true,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    swipe: true,
                    dots: true,
                }
            }
        ]
    });



    $('.gallery-slider').on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
        var i = (currentSlide ? currentSlide : 0) + 1;
        $('.gallery-slider-nav-count').html("<span>"+i+" </span>" + '/ ' + slick.slideCount);
    });

    $('.gallery-slider').slick({
        centerMode: true,
        centerPadding: '20%',
        slidesToShow: 1,
        speed: 1000,
        dots: false,
        arrows: true,
        infinite: true,
        swipe: true,
        adaptiveHeight: true,
        prevArrow: $('.gallery-slider-prev'),
        nextArrow: $('.gallery-slider-next'),
        responsive: [
            {
                breakpoint: 1900,
                settings: {
                    centerPadding: '15%',
                }
            },
            {
                breakpoint: 1600,
                settings: {
                    centerPadding: '10%',
                }
            },
            {
                breakpoint: 768,
                settings: {
                    centerPadding: '0',
                }
            }
        ]
    });


    $('.product-slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        swipe: false,
        infinite: false,
        // asNavFor: '.product-slider-nav',
        prevArrow: $('.product-slider-for-wrap .ion-ios-arrow-left'),
        nextArrow: $('.product-slider-for-wrap .ion-ios-arrow-right'),
    });
    // $('.product-slider-nav').slick({
    //     // slidesToShow: 3,
    //     slidesToShow: 2,
    //     slidesToScroll: 1,
    //     asNavFor: '.product-slider-for',
    //     dots: false,
    //     arrows: false,
    //     infinite: false,
    //     // centerMode: true,
    //     // centerPadding: '0px',
    //     focusOnSelect: true,
    // });
    // var $slideCount =  $('.product-slider-nav').slick("getSlick").slideCount ;
    // if($slideCount<=2){
    //     $('.product .product-media i').css('display', 'none');
    // }
     
    


    
    $('.product-slider-nav-item').click(function(){
        var $i = $(this).index();
        $( '.product-slider-for' ).slick( 'slickGoTo' , $i);
    });


    
    $('.product .product-media ul').addClass('nostyle-list');



    setTimeout(function() {
        $('.product-slider-for').css({'opacity':'1', 'visibility':'visible'});
        $('.product-slider-nav').css({'opacity':'1', 'visibility':'visible'});
        $('.gallery').css({'opacity':'1', 'visibility':'visible'});
        $('.slider-recommend-wrap').css({'opacity':'1', 'visibility':'visible'});
    }, 300);

    $('header .nav-menu > li i').click('on', function(){
        $(this).parent('li').toggleClass('active-link');
        $(this).next('ul').stop().slideToggle();
        $(this).parents('li').siblings('li').removeClass('active-link').find('ul').stop().slideUp();
    });

    AOS.init();


    if(isMobile){
        $('.products-list .main-news-list > li:not(.slider-recommend-wrap)').on('mouseover', function(){
            $(this).addClass('toggleAfter');
        });
        $('.products-list .main-news-list > li:not(.slider-recommend-wrap)').on('mouseout', function(){
            $(this).removeClass('toggleAfter');
        });

        $('.gallery-list > ul .gallery-list-item').on('mouseover', function(){
            $(this).addClass('toggleAfter');
        });
        $('.gallery-list > ul .gallery-list-item').on('mouseout', function(){
            $(this).removeClass('toggleAfter');
        });
    }

    $('.show-more').on('click', function(){
        ajaxFunc();
    });

    
    // $('.sort-list-wrap a').on('click', function(e){
    //     Cookies.set('title_farmgroup', $(this).text());
    // });

    $('table').removeAttr('border');

    var PlaceholdersHandler = function() {
        var inputSelector = $('.form-row input'),
            placeholderSelector = '.form-placeholder';

        inputSelector.each(function(index, element) {
            if ($(element).val()) {
                $(element).prev(placeholderSelector).addClass('active');
            }
        });
        inputSelector.on('focus', function() {
            $(this).prev(placeholderSelector).addClass('active');
        });

        inputSelector.on('focusout', function() {
            var input = $(this);
            // setTimeout(function() {
                if (!input.val()) {
                    input.prev(placeholderSelector).removeClass('active');
                }
            //}, 100);
        });
        $('.search-submit').on('focus', function() {
            inputSelector.prev(placeholderSelector).addClass('active');
        });

    };
    

    if(isMobile){
        $('.form-placeholder').addClass('active');
    }else{
        PlaceholdersHandler();
    }

    $('.search-link').click(function(e) {
        e.preventDefault();
    });;


    if(ms_ie){
        $('.btn-down span').css('animation', 'none');
        $('.product-link-wrap').css('display', 'block')
    }


    if(!Cookies.get('confform-submit')){
        $('body').append("<div class='confform'>Сайт использует cookie и аналогичные технологии для удобного и корректного отображения информации. Пользуясь нашим сервисом, вы соглашаетесь с их использованием.<div><br><a class='confform-podr' href='/privacy/' target='_blank'>Подробнее</a><span class='confform-submit'>ОК</span></div></div>");
    }

    $('.confform-submit').on('click', function(){
        Cookies.set('confform-submit', 'confform-submit', {expires :  365  });
        $('.confform').fadeOut(300);
    });

   

});

var resizeTimer;

$(window).on('load',function(){
    setTimeout(function(){
        $('body').css({
            'opacity':'1',
            'visibility':'visible',
        });
    },100);
    $('.zoom-img').parent('a').attr('data-fancybox', 'gallery');
});

$(window).on('load resize orienationchange',function(){
    if (window.matchMedia('(max-width: 575px)').matches){
        $('header .nav-menu > li').removeClass("active-link");
        $('header .nav-menu > li ul').css('display', 'none')
    }else{
        $('header .nav-menu > li ul').removeAttr('style');
        $(".burger").removeClass("menu-on");
        $('.nav-menu').removeClass("menu-vis").css('transition', 'none');
        setTimeout(function(){
            $('.nav-menu').css('transition', '.3s ease-in-out opacity, .3s ease-in-out visibility');
        },100);
    }

});

$(window).on('resize orienationchange',function(){
    $('.slider-recommend').css('opacity', '0');
    $('.gallery-slider').css('opacity', '0');
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
        $('.slider-recommend').slick('setPosition').css('opacity', '1');
        $('.gallery-slider').slick('setPosition').css('opacity', '1');
    }, 300);
});

$(window).on('scroll load resize orienationchange',function(){
    if($('.main-wrap').length){
        var posStopFixed = $('.main-wrap').offset().top;
        var posScroll = $(window).scrollTop();
        if (posStopFixed-100 >= posScroll ){
            $('header').css({
                'position': 'fixed',
                'top': 0
            });
            $('body').css({'margin-top': '0'});
        }else{
            $('header').css({
                'position': 'relative',
                'top': posStopFixed+'px'
            });
            $('body').css({'margin-top': '-100px'});
        }
    }
});



var ajaxFunc = function() {
    var nextpage = $('.show-more').data('nextpage');

    $('.show-more').attr('data-curpage', nextpage);
    $('.show-more').hide();
    $('.show-more.show-more-loader').show();

    $.ajax({
        url: nextpage,
        type: "POST",
        success: function(data) {
            var $data = $(data);
            var items = $data.find('.ajax-item');
            var pagination = $data.find('.pagination');
            var newNextPage = pagination.find('.pagination__next a').attr('href');

            $('.main-news-list li:not([style])').last().after(items);
            $('.pagination').html(pagination.html());

            if (newNextPage) {
                $('.show-more').data('nextpage', newNextPage);
                $('.show-more').off();
                $('.show-more').on('click', function(){
                    ajaxFunc();
                });
                $('.show-more').show();
            }
            
            $('.show-more.show-more-loader').hide();

        }

        // dataType: "json"
    });
}