/**
 * Created by WF18 on 1/25/2017.
 */


//fixing left menu
//onload func
$(document).ready(function () {
    $("#nav-mobile").css('transform', 'translateX(-100%)');
    $("#nav_mobile_button").click();
    $("#nav-mobile").attr('active', 'true');
});


//by opening the sidebar, shorting container
$("#nav_mobile_button").on('click', function () {
        $("#top_container").css('max-width', '1280px');
        $("#top_container").parent().css('padding-left', '240px');
    $("#nav-mobile").attr('active', 'true');
});

//by hidding the sidebar, container - 100%
$(document).on('click', '#sidenav-overlay', function() {
    $("#top_container").css('max-width', '100%');
    $("#top_container").parent().css('padding-left', '0');
    $("#nav-mobile").attr('active', 'false');
});
