window.onload = function () {
    var aktualnosciList = jQuery('.aktualnosci-list');

    if (aktualnosciList.length) {
        var maxHeight = Math.max.apply(null, main.find('.mainblock > div').map(function () {
                return jQuery(this).outerHeight();
            }).get()) + 20;

        aktualnosciList.find('.mainblock > div').css('min-height', maxHeight);
    }
};