( function( $ ) {
$(window).load(function(){


/*------------------------------------------------
                SIDR MENU
------------------------------------------------*/

$('#sidr-left-top-button').sidr({
    name: 'sidr-left-top',
    timing: 'ease-in-out',
    speed: 500,
    side: 'left',
    source: '.left'
});

/*------------------------------------------------
                END SIDR MENU
------------------------------------------------*/

/*------------------------------------------------
                PRELOADER
------------------------------------------------*/

 $('#loader').fadeOut();
 $('#loader-container').fadeOut();

 $('.topbar-toggle').click(function(){
    $('#top-bar').toggleClass('open-topbar');
 });

 $('.display-none').css({'display' : 'block'});
/*------------------------------------------------
                END PRELOADER
------------------------------------------------*/

/*------------------------------------------------
                MENU ACTIVE
------------------------------------------------*/

$('.main-navigation ul li').click(function(){
    $('.main-navigation ul li').removeClass('current-menu-item');
    $(this).addClass('current-menu-item');
});

/*------------------------------------------------
                END MENU ACTIVE
------------------------------------------------*/

/*------------------------------------------------
                STICKY HEADER
------------------------------------------------*/

$(window).scroll(function() {    
    var scroll = $(window).scrollTop();  
    if (scroll > 50) {
        $(".site-header").addClass("active");
        $(".site-header").addClass("fixed");
    }
    else {
         $(".site-header").removeClass("active");
        $(".site-header").removeClass("fixed");
    }
});


/*------------------------------------------------
                END STICKY HEADER
------------------------------------------------*/

/*------------------------------------------------
                BACK TO TOP
------------------------------------------------*/
 $(window).scroll(function(){
    if ($(this).scrollTop() > 1) {
    $('.backtotop').fadeIn();
    } else {
    $('.backtotop').fadeOut();
    }
    });
    $('.backtotop').click(function(){
    $('html, body').animate({scrollTop: '0px'}, 800);
    return false;
});
/*------------------------------------------------
                END BACK TO TOP
------------------------------------------------*/

/*------------------------------------------------
                SLICK SLIDER
------------------------------------------------*/
var $ease = $('#main-slider').data('effect');

$('#main-slider').slick({
    cssEase: $ease
});

$('#logo-slider .regular').slick({
    responsive: [
       {
         breakpoint: 1200,
         settings: {
           slidesToShow: 4,
           slidesToScroll: 1
         }
       },
       {
         breakpoint: 767,
         settings: {
           slidesToShow: 3,
           slidesToScroll: 1
         }
       }
     ]
});

/*------------------------------------------------
                END SLICK SLIDER
------------------------------------------------*/

/*------------------------------------------------
                TABS
------------------------------------------------*/
$('.tabs li').click(function(){
    var tab_id = $(this).attr('data-tab');

    $('ul.tabs li').removeClass('active');
    $('.tab-content').removeClass('active');
    $('.tab-content').hide();

    $(this).addClass('active');
    $("#"+tab_id).fadeIn();
});

$(".grid-icons .fa-th-list").click(function() {
    $(".courses-list .tab-content").removeClass("grid-view");
    $(".courses-list .tab-content").addClass("list-view");
});

$(".grid-icons .fa-th-large").click(function() {
    $(".courses-list .tab-content").removeClass("list-view");
    $(".courses-list .tab-content").addClass("gridview-view");
});

$(".grid-icons li").click(function() {
   $('.grid-icons li').removeClass('active');
   $(this).addClass('active');
});

/*------------------------------------------------
                END TABS
------------------------------------------------*/

// localized site url
var current_site = data.current_site;

/*------------------------------------------------------------
            ARCHIVE DROPDOWN
-------------------------------------------------------------*/
    // Category 
    $( '#graduate select#category' ).change( function(){

        var cat_slug = this.value;
        var new_path = current_site + '/category/' + cat_slug;

        // url location
        if ( cat_slug != '' ) {
            location.replace( new_path );
        }
        
    });

    // Class Category
    $( '#graduate select#tp-class-category' ).change( function(){

        var cat_slug = this.value;
        var new_path = current_site + '/tp-class-category/' + cat_slug;

        // url location
        if ( cat_slug != '' ) {
            location.replace( new_path );
        }
        
    });

    // course Category
    $( '#graduate select#tp-course-category' ).change( function(){

        var cat_slug = this.value;
        var new_path = current_site + '/tp-course-category/' + cat_slug;

        // url location
        if ( cat_slug != '' ) {
            location.replace( new_path );
        }
        
    });

    // event Category
    $( '#graduate select#tp-event-category' ).change( function(){
        var cat_slug = this.value;
        var new_path = current_site + '/tp-event-category/' + cat_slug;

        // url location
        if ( cat_slug != '' ) {
            location.replace( new_path );
        }
        
    });

    // excursion Category
    $( '#graduate select#tp-excursion-category' ).change( function(){
        var cat_slug = this.value;
        var new_path = current_site + '/tp-excursion-category/' + cat_slug;

        // url location
        if ( cat_slug != '' ) {
            location.replace( new_path );
        }
        
    });

    // affiliation Category
    $( '#graduate select#tp-affiliation-category' ).change( function(){
        var cat_slug = this.value;
        var new_path = current_site + '/tp-affiliation-category/' + cat_slug;

        // url location
        if ( cat_slug != '' ) {
            location.replace( new_path );
        }
        
    });

/*------------------------------------------------------------
            CLIENT TESTIMONIAL
-------------------------------------------------------------*/
$(".staff-list li").hover(function() {

    var staff_id = $(this).attr('data-tab');

    $('.staff-list li').removeClass('active');
    $(this).addClass('active');
    
    $('#client-testimonial .featured-image').removeClass('active');

    $("#"+staff_id).addClass('active');

});



});

/*------------------------------------------------
            END JQUERY
------------------------------------------------*/
})( jQuery );

