/**
 * Created by WF18 on 1/25/2017.
 */


//var width = $(window).width();
//if ((width <= 1366)){       //small devices (tablet\phone)
//
////fixing left menu
////onload func
//    $(document).ready(function () {
//        $("#nav-mobile").css('transform', 'translateX(-100%)');
//        // $("#nav_mobile_button").click();
//        // $("#top_container").css('max-width', '100%');
//        // $("#top_container").parent().css('padding-left', '0');
//        $("#nav-mobile").attr('active', 'false');
//    });
//
//
////by opening the sidebar, shorting container
//    $("#nav_mobile_button").on('click', function () {
//        $("#nav-mobile").attr('style', 'transform:translateX(0)!important');
//        $("#top_container").parent().css('padding-left', '240px');
//        $("#top_container").css('max-width', '1280px');
//        $("#top_container").parent().css('padding-left', '240px');
//        $("#nav-mobile").attr('active', 'true');
//    });
//
////by hidding the sidebar, container - 100%
//    $(document).on('click', '#sidenav-overlay', function() {
//        $("#top_container").css('max-width', '100%');
//        $("#top_container").parent().css('padding-left', '0');
//        $("#nav-mobile").attr('active', 'false');
//    });
//}else{              //PC
//
//    $(document).ready(function () {
//
//
//        //adding new button without attr data-activates
//        $('#nav_mobile_button').parent().prepend('<a href="#"  class="button-collapse" style="opacity: 0" id="nav_mobile_button1"><i class="material-icons">menu</i></a>');
//        $('#nav_mobile_button').remove();
//        $("#nav-mobile").css('transform', 'translateX(0)');
//        $("#top_container").css('max-width', '1280px');
//        $("#top_container").parent().css('padding-left', '240px');
//        $("#nav-mobile").attr('active', 'true');
//        $("#sidenav-overlay").remove();
//
//
//    });
//
//    $(document).on('click', '#nav_mobile_button1', function() {
//        if($("#nav-mobile").attr('active') == 'false'){
//            $("#nav-mobile").css('transform', 'translateX(0)');
//            $("#top_container").css('max-width', '1280px');
//            $("#top_container").parent().css('padding-left', '240px');
//            $("#nav-mobile").attr('active', 'true');
//        }else{
//            $("#nav-mobile").css('transform', 'translateX(-100%)');
//            $("#top_container").css('max-width', '100%');
//            $("#top_container").parent().css('padding-left', '0');
//            $("#nav-mobile").attr('active', 'false');
//        }
//    });
//}
//
//
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
    $('.create_contact').on('click',function(){
        $.ajax({
            url: '/sys-admin/clients_view_new',
            error: function() {

            },
            dataType: 'json',
            success: function(data) {
                console.log(data)
                $('#newclient .modal-body').html(data.html);
                $('#newclient').modal('show');
            },
            type: 'GET'
        });
        //$('#newclient').modal('show');
    });
    $('#artash').on('click',function(){
        $('header').css('position','static');
    });



    $('[data-toggle="tooltip"]').tooltip();

    $('body').on('click','.create-contact-save',function(){
       $('#form_client_edit').submit();
    });
});






/*!
 * classie v1.0.0
 * class helper functions
 * from bonzo https://github.com/ded/bonzo
 * MIT license
 *
 * classie.has( elem, 'my-class' ) -> true/false
 * classie.add( elem, 'my-new-class' )
 * classie.remove( elem, 'my-unwanted-class' )
 * classie.toggle( elem, 'my-class' )
 */

/*jshint browser: true, strict: true, undef: true, unused: true */
/*global define: false */

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

    function www(){
        console.log("!");
    }

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

    var setTitleDots = function(){
        var page_title_width = $('.page-title').width(),
            page_title_text_width = $('.page-title .page-title-text').width();



        if(page_title_width < page_title_text_width){
            var page_title_dots_width = $('.page-title-dots').width();
            $('.page-title').width(page_title_width - page_title_dots_width);
            $('.page-title-dots').css('display', 'inline-block');

            document.getElementById("logo").addEventListener('scroll', function(e){
                var horizontal = e.currentTarget.scrollLeft;
                if(page_title_text_width - horizontal <= page_title_width){
                    $('.page-title').width(page_title_width);
                    $('.page-title-dots').css('display', 'none');
                }else{
                    $('.page-title').width(page_title_width - page_title_dots_width);
                    $('.page-title-dots').css('display', 'inline-block');
                }
            });
        }
    };

    setTitleDots();

    window.onresize = function(event) {

        $('.page-title').removeAttr('style');
        $('.page-title-dots').css('display', 'none');
        document.getElementById("logo").removeEventListener("scroll", setTitleDots());
        
    };

})( window );



function init() {
    window.addEventListener('scroll', function(e){
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 0,
            header = document.querySelector("header");
        if (distanceY > shrinkOn) {
            $('.page-content-wrapper .page-content').css('padding-top','60px');
            classie.add(header,"smaller");
        } else {
            $('.page-content-wrapper .page-content').css('padding-top','80px');
            if (classie.has(header,"smaller")) {
                classie.remove(header,"smaller");
            }
        }

    });
    $('#artash').click(function(){
        $('.page-content-wrapper .page-content').css('padding-top','0');
    });
}
window.onload = init();


