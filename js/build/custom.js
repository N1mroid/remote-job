jQuery(document).ready(function($) {

    var rtl, winWidth, head_col_label, head_col_count;
    
    if( jobscout_pro_data.rtl == '1' ){
        rtl = true;
    }else{
        rtl = false;
    }

    winWidth = $(window).width();
    
     //Header Search form show/hide
     $('.site-header .nav-holder .form-holder').prepend('<div class="btn-close-form"><span></span></div>');

     $('.site-header .form-section').click(function(event) {
        event.stopPropagation();
    });
     $("#btn-search").click(function() {
        $(".site-header .form-holder").show("fast");
    });

     $('.btn-close-form').click(function(){
        $('.site-header .nav-holder .form-holder').hide("fast");
    });

     /** Lightbox */
     if( jobscout_pro_data.lightbox == '1' ){        
        $('.entry-content').find('.gallery-columns-1').find('.gallery-icon > a').attr( 'data-fancybox', 'group1' );
        $('.entry-content').find('.gallery-columns-2').find('.gallery-icon > a').attr( 'data-fancybox', 'group2' );
        $('.entry-content').find('.gallery-columns-3').find('.gallery-icon > a').attr( 'data-fancybox', 'group3' );
        $('.entry-content').find('.gallery-columns-4').find('.gallery-icon > a').attr( 'data-fancybox', 'group4' );
        $('.entry-content').find('.gallery-columns-5').find('.gallery-icon > a').attr( 'data-fancybox', 'group5' );
        $('.entry-content').find('.gallery-columns-6').find('.gallery-icon > a').attr( 'data-fancybox', 'group6' );
        $('.entry-content').find('.gallery-columns-7').find('.gallery-icon > a').attr( 'data-fancybox', 'group7' );
        $('.entry-content').find('.gallery-columns-8').find('.gallery-icon > a').attr( 'data-fancybox', 'group8' );
        $('.entry-content').find('.gallery-columns-9').find('.gallery-icon > a').attr( 'data-fancybox', 'group9' );
        
        $("a[href$='.jpg'],a[href$='.jpeg'],a[href$='.png'],a[href$='.gif'],[data-fancybox]").fancybox({
            buttons: [
               "zoom",
               //"share",
               "slideShow",
               "fullScreen",
               //"download",
               // "thumbs",
               "close"
            ]
        });         
    }
    
    /**
    * First Letter of word to Drop Cap
    * https://stackoverflow.com/questions/5458605/first-word-selector 
    * https://paulund.co.uk/capitalize-first-letter-string-javascript
    */
    $.fn.wrapStart = function (numWords) { 
        var node = this.contents().filter(function () { 
            return this.nodeType == 3; 
        }).first(),
        text = node.text(),
        first = text.split(" ", numWords).join(" ");
        firstLetter = first.charAt(0);
        finale = '<span class="dropcap">' + firstLetter + '</span>' + first.slice(1);

        if (!node.length)
            return;

        node[0].nodeValue = text.slice(first.length);        
        node.before(finale);        
    };
    if( jobscout_pro_data.singular == 1 && jobscout_pro_data.drop_cap == 1 ){
        $('.entry-content p').wrapStart(1);
    }

    var headerHeight = $('.site-header').outerHeight();
    var mainheadHeight = $('.header-main').outerHeight();
    $('.sticky-blank').css('height', 0);

    $(window).scroll(function(){
        if($(this).scrollTop() > headerHeight){
            $('.site-header').addClass('sticky');
            $('.sticky-blank').css('height', mainheadHeight);
        }else {
            $('.site-header').removeClass('sticky');
            $('.sticky-blank').css('height', 0);
        }
    });
    
    //Sticky widget
    if( jobscout_pro_data.sticky == '1' && winWidth > 1024 ){
        $("#secondary").stick_in_parent({
            offset_top: mainheadHeight,
        });
    }
    
    if( jobscout_pro_data.sticky_widget == '1' && winWidth > 1024 ){
        $("#secondary").stick_in_parent({
            offset_top: 60,
        });
    }
    
    /** One page Scroll */
    if( jobscout_pro_data.sticky == '1' ){
        $('.main-navigation').onePageNav({
            currentClass: 'current-menu-item',
            changeHash: false,
            scrollSpeed: 1500,
            scrollThreshold: 0.5,
            filter: '',
            easing: 'swing',
            scrollOffset: mainheadHeight,     
        });
    }else{
        $('.main-navigation').onePageNav({
            currentClass: 'current-menu-item',
            changeHash: false,
            scrollSpeed: 1500,
            scrollThreshold: 0.5,
            filter: '',
            easing: 'swing',   
        }); 
    }

    // JobScout js code
    //testimonial section slider
    if ( $('.home ').length > 0 ) {
        $('.custom-background .testimonial-section .widgets-wrap').owlCarousel({
            items   : 1,
            center  : true,
            loop    : true,
            margin: 30,
            nav     : true,
            dots    : false,
            rtl: rtl,
            responsive: {
                //breakpoint from 1180 and up
                1180: {
                    stagePadding: 250,
                },
                //breakpoint from 1025 and up
                1025: {
                    stagePadding: 200,
                },
                //breakpoint from 769 and up
                783: {
                    stagePadding: 150,
                },
                //breakpoint from 0 and up
                0: {
                    stagePadding: 0,
                }
            }
        });

        $('.testimonial-section .widgets-wrap').owlCarousel({
            items   : 1,
            center  : true,
            loop    : true,
            margin: 30,
            nav     : true,
            dots    : false,
            rtl: rtl,
            responsive: {
                //breakpoint from 1700 and up
                1800:{
                    stagePadding: 506,
                },
                //breakpoint from 1180 and up
                1180: {
                    stagePadding: 320,
                },
                //breakpoint from 1025 and up
                1025: {
                    stagePadding: 200,
                },
                //breakpoint from 769 and up
                783: {
                    stagePadding: 150,
                },
                //breakpoint from 0 and up
                0: {
                    stagePadding: 0,
                }
            }
        });
    }

    //testimonial slider nav margin
    winWidth = $('.site').width();
    var itemWidth = $('.testimonial-section .owl-item').width();
    var halfWidth = (parseInt(winWidth) - parseInt(itemWidth)) / 2;
    $('.testimonial-section .owl-carousel .owl-nav .owl-prev').css('left', halfWidth);
    $('.testimonial-section .owl-carousel .owl-nav .owl-next').css('right', halfWidth);

    //scroll to top
    $(window).scroll(function(){
        if($(this).scrollTop() > 200){
            $('#back-to-top').addClass('show');
        }else {
            $('#back-to-top').removeClass('show');
        }
    });
    $('#back-to-top span').click(function(){
        $('html, body').animate({
            scrollTop: 0
        }, 600);
    });

    var wrapHeight = $('.single-job .site-content .entry-header .container').innerHeight();
    $('.single-job .site-content .entry-header + .container').css('padding-top', wrapHeight);

    if($(window).width() <= 640) {
        var wrapHeight1 = parseInt(wrapHeight) - 100;
        $('.single-job .site-content .entry-header + .container').css('padding-top', wrapHeight1);
    }

    //responsive menu toggle
    if($(window).width() <= 1024) {
        $('.header-main .main-navigation .toggle-btn').on('click', function(){
            $('body').addClass('menu-active');
        });

        $('.responsive-nav .close-btn').on('click', function(){
            $('body').removeClass('menu-active');
        });

        $('.responsive-nav ul li.menu-item-has-children').prepend('<span class="submenu-toggle"><i class="fas fa-angle-down"></i></span>');

        $('.responsive-nav ul li .submenu-toggle').on('click', function(){
            $(this).toggleClass('active');
            $(this).siblings('ul').slideToggle();
        });

    }

    $('.job-overview .overview-wrap a.btn-primary').click(function(){
        $(this).siblings('#singlejobapply').addClass('active');
    });

    $('.job-overview #singlejobapply .modal-dialog .close').click(function(e){
        e.preventDefault();
        $(this).parents('#singlejobapply').removeClass('active');
    });

    $("#site-navigation ul li a").focus(function(){
       $(this).parents("li").addClass("hover");
    }).blur(function(){
       $(this).parents("li").removeClass("hover");
    });


    //responsive table
    $( 'table.job-manager-jobs' ).each(function( index ) {
      //We are seeing our creatures
      head_col_count =  $(this).find('thead tr th').size();
      //We consider our th elements in the table
      for ( j=0; j <= head_col_count; j++ )  {
        // Work with text
        head_col_label = $(this).find('thead th:nth-child('+ j +')').text();
        //Each td is assigned a data-title, which is then output via css
        $( this ).find('tr td:nth-child('+ j +')').replaceWith(
          function(){
            return $('<td data-title="'+ head_col_label +'">').append($(this).contents());
        }
        );
    }
});
});
