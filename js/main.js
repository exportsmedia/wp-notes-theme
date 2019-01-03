jQuery(window).scroll(function ($) {
    if (jQuery(this).scrollTop() > 50) {
        jQuery('header').addClass("sticky");
    } else {
        jQuery('header').removeClass("sticky");
    }
});