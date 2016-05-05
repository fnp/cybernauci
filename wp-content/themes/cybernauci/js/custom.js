jQuery(document).ready(function () {
    var aktualnosciList = jQuery('.aktualnosci-list'),
        katalogList = jQuery('.katalog-content');

    if (aktualnosciList.length || katalogList.length) {
        var content = (aktualnosciList.length > 0) ? aktualnosciList : katalogList,
            maxHeight = Math.max.apply(null, content.find('.mainblock > div').map(function () {
                    return jQuery(this).outerHeight();
                }).get()) + 40;

        content.find('.mainblock > div').css('min-height', maxHeight);
    }
});