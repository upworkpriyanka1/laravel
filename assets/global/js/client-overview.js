$(document).ready(function(){
    $('.theme-colors-ul').on('click','.color-light2, .color-default, .color-darkblue,.color-blue',function(){
        var color = $(this).attr('class').split(' ')[0];
        console.log(color)
        if(color=='color-light2'){
            $(".page-header.navbar,header .chevron .chevron-down i, header .chevron .chevron-up i,  nav.top-nav").css("background-color", "#c8c8c8");
            $(".side-nav .collapsible-body, .side-nav.fixed .collapsible-body").css("background-color", "#ddd");
        }
        if(color=='color-blue'){
            $(".page-header.navbar,header .chevron .chevron-down i, header .chevron .chevron-up i,  nav.top-nav").css("background-color", "#2D5F8B");
            $(".side-nav .collapsible-body, .side-nav.fixed .collapsible-body").css("background-color", "#267fa4");
        }
        if(color=='color-darkblue'){
            $(".page-header.navbar,header .chevron .chevron-down i, header .chevron .chevron-up i,  nav.top-nav").css("background-color", "#2b3643");
            $(".side-nav .collapsible-body, .side-nav.fixed .collapsible-body").css("background-color", "#267fa4");
        }
        if(color=='color-default'){
            $(".page-header.navbar,header .chevron .chevron-down i, header .chevron .chevron-up i,  nav.top-nav").css("background-color", "#1f1f1f");
            $(".side-nav .collapsible-body, .side-nav.fixed .collapsible-body").css("background-color", "#888");
        }
        $("ul.side-nav.fixed ul").removeClass("collapsible-accordion-green");
    });
    $('.theme-colors-ul').on('click','.color-light',function(){
        $(".page-header.navbar,header .chevron .chevron-down i, header .chevron .chevron-up i,  nav.top-nav").css("background-color", "35cec0");
        $(".side-nav .collapsible-body, .side-nav.fixed .collapsible-body").css("background-color", "#33c0b3");
        $("ul.side-nav.fixed ul").addClass("collapsible-accordion-green");
    });

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

    //$('#artash').on('click',function(){
    //    $('#sidenav-overlay').css('position','relative');
    //
    //});
    $('#artash').on('click',function(){
        $('header').css('position','static');
    });

    $("body").on('click','.btn-rem',function(){

        console.log($(this));
        $(this).parent().remove();
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('body').on('click','.create-contact-save',function(){
        $('#form_client_edit').submit();
    });
});


( function( window ) {

    'use strict';
    $('body').on('click','.add-row-button',function(){
        var next_row_class = $(this).attr('next-row-class');

        $('.'+next_row_class).css('display', 'block');

    });

    function xAbleClick(){
        console.log('button clicked');
        $(this).closest('.form-group').find('.x-able').val("");
        $(this).closest('.form-group').find('.x-able-button').remove();
    };



    $('.x-able').keyup(function(){
        var val = $(this).val();
        var html = '<div class="btn-rem-name x-able-button" style="display: inline-block; position: absolute; right: 0; top: 20px; ">'+
            '<i class="fa fa-times-circle" aria-hidden="true"></i></div>';

        if(val != "" && $(this).closest('.form-group').find('.x-able-button').length == 0){
            $(this).closest('.form-group').append(html);
            var buttons = document.getElementsByClassName('x-able-button');
            var i;
            for(i = 0; i < buttons.length; i++){
                buttons[i].addEventListener("click", function(){
                    $(this).closest('.form-group').find('.x-able').val("");
                    $(this).closest('.form-group').find('.x-able-button').remove();
                }, false);
            };

        }else if(val == ""){
            $(this).closest('.form-group').find('.x-able-button').remove();
        }
    });

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
            screenWidth = $(window).width(),
            screenHeight = screen.height,
            lastScrollPosition = document.body.scrollTop;
        //var scrollSpeed = (lastScrollPosition > theScrollPosition && lastScrollPosition - theScrollPosition <= 80 || theScrollPosition > lastScrollPosition && theScrollPosition - lastScrollPosition <= 80)? 2000 : false;
        var scrollSpeed = false;
        theScrollPosition = lastScrollPosition;

        if(screenWidth > 993){
            var pageContentsPadding = "220px";
        }else if(screenWidth > 992){
            var pageContentsPadding = "180px";
        }else if(screenWidth > 600){
            var pageContentsPadding = "160px";
        }else{
            var pageContentsPadding = "180px";
        }
        //if($('body').height() > screenHeight + 160){
            console.log('something');
            if (distanceY > shrinkOn) {
                $('.page-content-wrapper .page-content').css('padding-top','60px');
                classie.add(header,"smaller");

                    if(scrollSpeed == false){
                        $('.rand-place').stop().css('display', 'none');
                        $('.rand-place span').stop().slideUp();
                    }else{
                        $('.rand-place').stop().slideUp(scrollSpeed);
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
        //}
    });
    $('#artash').click(function(){
        $('.page-content-wrapper .page-content').css('padding-top','0');
    });
    $(".zang").click(function(){
        $(this).css('background-color','#208d83');
        $( ".notific-area" ).toggle();
        if( $(".notific-area").css("display") == "none")
            $(".zang").css('background-color','transparent');
    });

    //$(document).mouseup(function (e)
    //{
    //    var container = $(".notific-area");
    //
    //    if (!container.is(e.target)){
    //        alert("www");
    //        console.log("www");
    //    }
    //});

    window.addEventListener('click', function(e){
        //console.log(e.target);
        var el = e.target;

        if(!$(el).hasClass('side-nav') && $(el).id != "artash" && !$(el).parents('.side-nav').length && $('header').css('position') == 'static'){

            var screenWidth = $(window).width();

            if(screenWidth > 993){
                var pageContentsPadding = "220px";
            }else if(screenWidth > 992){
                var pageContentsPadding = "180px";
            }else if(screenWidth > 600){
                var pageContentsPadding = "160px";
            }else{
                var pageContentsPadding = "250px";
            }

            $('header').css('position','fixed');

            $('.page-content-wrapper .page-content').css('padding-top', pageContentsPadding);


        }

        if(!$(el).hasClass('notific-area') && !$(el).hasClass('zang') && !$(el).parents('.notific-area').length){
            if( $(".notific-area").css("display") != "none"){
                $(".zang").css('background-color','transparent');
                $(".zang").css('opacity','1');
                $( ".notific-area" ).toggle();
            }
        }

    });
}
window.onload = init();





