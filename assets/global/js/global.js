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
        $('#create-contact').modal('show');
        console.log(45);
    });




});