jQuery(window).scroll(function ($) {
    if (jQuery(this).scrollTop() > 50) {
        jQuery('header').addClass("sticky");
    } else {
        jQuery('header').removeClass("sticky");
    }
});


jQuery(document).ready(function () {

    var getMax = function () {
        return jQuery(document).height() - jQuery(window).height();
    }

    var getValue = function () {
        return jQuery(window).scrollTop();
    }

    if ('max' in document.createElement('progress')) {
        var progressBar = jQuery('progress');

        progressBar.attr({
            max: getMax()
        });

        jQuery(document).on('scroll', function () {
            progressBar.attr({
                value: getValue()
            });
        });

        jQuery(window).resize(function () {

            progressBar.attr({
                max: getMax(),
                value: getValue()
            });
        });

    } else {

        var progressBar = jQuery('.progress-bar'),
            max = getMax(),
            value, width;

        var getWidth = function () {

            value = getValue();
            width = (value / max) * 100;
            width = width + '%';
            return width;
        }

        var setWidth = function () {
            progressBar.css({
                width: getWidth()
            });
        }

        jQuery(document).on('scroll', setWidth);
        jQuery(window).on('resize', function () {

            max = getMax();
            setWidth();
        });
    }
});