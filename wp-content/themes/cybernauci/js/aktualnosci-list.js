window.onload = function () {
    var main = jQuery('.aktualnosci-list'),
        maxHeight = Math.max.apply(null, main.find('.mainblock > div').map(function () {
                return jQuery(this).outerHeight();
            }).get()) + 20;

    main.find('.mainblock > div').css('min-height', maxHeight);
};