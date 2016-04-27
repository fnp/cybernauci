jQuery(document).ready(function () {
    var aktualnosciList = jQuery('.aktualnosci-list');

    if (aktualnosciList.length) {
        var maxHeight = Math.max.apply(null, aktualnosciList.find('.mainblock > div').map(function () {
                return jQuery(this).outerHeight();
            }).get()) + 40;

        aktualnosciList.find('.mainblock > div').css('min-height', maxHeight);
    }
});