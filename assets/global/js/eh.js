$(document).ready(function(){
    $('.the_active').removeClass('the_active').addClass('active');

    $('.active').find('.collapsible-body').css('display', 'block');

    $('.nav-item').click(function(){
        $('.waves-ripple').delay(300).fadeOut(200);
    });

    $("#dropdown1").width( 600 );
    $('#dropdown1').css('display', 'none');

    $('.filter_dropdown').on('click',function(event){
        $('#dropdown1').css('display', 'block');
        $("#dropdown1").width( 600 );

    });
    $("#dropdown1").on('click',function(event){
        event.stopPropagation();
    })

    $('.close_filter').on('click',function(){
        $('#dropdown1').css('display', 'none');
    });
    $("#dropdown1:not(.active)").hover(function(){

        //$("#dropdown1").height( 40 );

    });

    $('#artash').on('click',function(){
        $('header').css('position','static');
    });



    $('[data-toggle="tooltip"]').tooltip();

    $('body').on('click','.create-contact-save',function(){
        $('#form_client_edit').submit();
    });
});


( function( window ) {

    'use strict';


    // class helper functions from bonzo https://github.com/ded/bonzo

    function classReg( className ) {
        return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
    }

    // classList support for class management
    // altho to be fair, the api sucks because it won't accept multiple classes at once
    var hasClass, addClass, removeClass;

    if ( 'classList' in document.documentElement ) {
        hasClass = function( elem, c ) {
            return elem.classList.contains( c );
        };
        addClass = function( elem, c ) {
            elem.classList.add( c );
        };
        removeClass = function( elem, c ) {
            elem.classList.remove( c );
        };
    }
    else {
        hasClass = function( elem, c ) {
            return classReg( c ).test( elem.className );
        };
        addClass = function( elem, c ) {
            if ( !hasClass( elem, c ) ) {
                elem.className = elem.className + ' ' + c;
            }
        };
        removeClass = function( elem, c ) {
            elem.className = elem.className.replace( classReg( c ), ' ' );
        };
    }

    function toggleClass( elem, c ) {
        var fn = hasClass( elem, c ) ? removeClass : addClass;
        fn( elem, c );
    }

    var classie = {
        // full names
        hasClass: hasClass,
        addClass: addClass,
        removeClass: removeClass,
        toggleClass: toggleClass,
        // short names
        has: hasClass,
        add: addClass,
        remove: removeClass,
        toggle: toggleClass
    };

    // transport
    if ( typeof define === 'function' && define.amd ) {
        // AMD
        define( classie );
    } else {
        // browser global
        window.classie = classie;
    }

    $('.chevron-up').click(function(){
        $('.rand-place').css("display", "none");
        $('.rand-place span').stop().slideUp();
        $(this).css("display", "none");
        $('.chevron-down').css("display", "inline-block");

        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 0,
            header = document.querySelector("header");
        $('.page-content-wrapper .page-content').css('padding-top','60px');
        classie.add(header,"smaller");
        $('.logo_first').css("display", "none");
    });

    $('.chevron-down').click(function(){
        $('.rand-place').css("display", "block");
        $('.rand-place span').stop().slideDown();
        $(this).css("display", "none");
        $('.chevron-up').css("display", "inline-block");

        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 0,
            header = document.querySelector("header");
        $('.page-content-wrapper .page-content').css('padding-top','80px');
        if (classie.has(header,"smaller")) {
            classie.remove(header,"smaller");
        }
        $('.logo_first').css("display", "inline-block");
    });



})( window );

function init() {
    var theScrollPosition = document.body.scrollTop;
    window.addEventListener('scroll', function(e){
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 0,
            header = document.querySelector("header"),
            screenWidth = screen.width,
            screenHeight = screen.height,
            lastScrollPosition = document.body.scrollTop;
        var scrollSpeed = (lastScrollPosition > theScrollPosition && lastScrollPosition - theScrollPosition <= 80 || theScrollPosition > lastScrollPosition && theScrollPosition - lastScrollPosition <= 80)? 2000 : false;
        theScrollPosition = lastScrollPosition;

        if(screenWidth > 993){
            var pageContentsPadding = "220px"
        }else if(screenWidth > 992){
            var pageContentsPadding = "180px"
        }else if(screenWidth > 600){
            var pageContentsPadding = "160px"
        }else{
            var pageContentsPadding = "180px"
        }
        if($('body').height() > screenHeight + 160){
            if (distanceY > shrinkOn) {
                $('.page-content-wrapper .page-content').css('padding-top','60px');
                classie.add(header,"smaller");

                    if(scrollSpeed == false){
                        $('.rand-place').stop().css('display', 'none');
                        $('.rand-place span').stop().slideUp();
                    }else{
                        $('.rand-place').stop().slideUp(scrollSpeed)
                        $('.rand-place span').stop().slideUp();

                    }


                //}
                $('.chevron-down').css("display", "inline-block");
                $('.chevron-up').css("display", "none");
                $('.logo_first').css("display", "none");
            } else {
                $('.page-content-wrapper .page-content').css('padding-top', pageContentsPadding);
                if (classie.has(header,"smaller")) {
                    classie.remove(header,"smaller");
                }


                if(scrollSpeed == false){
                    $('.rand-place').stop().show();
                    $('.rand-place span').stop().slideDown();
                }else{
                    $('.rand-place').stop().slideDown(scrollSpeed);
                    $('.rand-place span').stop().slideDown();
                }


                    //alert('zahrmar');
                //}
                $('.chevron-down').css("display", "none");
                $('.chevron-up').css("display", "none");
                $('.logo_first').css("display", "inline-block");
            }
        }
    });
    $('#artash').click(function(){
        $('.page-content-wrapper .page-content').css('padding-top','0');
    });

    window.addEventListener('click', function(e){

        var el = e.target;

        if(!$(el).hasClass('side-nav') && $(el).id != "artash" && !$(el).parents('.side-nav').length && $('header').css('position') == 'static'){

            var distanceY = window.pageYOffset || document.documentElement.scrollTop,
                shrinkOn = 0;

            $('header').css('position','fixed');

            if (distanceY > shrinkOn) {
                $('.page-content-wrapper .page-content').css('padding-top', '60px');
            }else{
                $('.page-content-wrapper .page-content').css('padding-top', '80px');
            }


        }
        //console.log(e.target);

    });
}
window.onload = init();





