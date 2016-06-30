jQuery(document).ready(function () {
    var aktualnosciList = jQuery('.aktualnosci-list'),
        katalogList = jQuery('.katalog-list');

    if (aktualnosciList.length || katalogList.length) {
        window.setTimeout(function () {
            var content = (aktualnosciList.length > 0) ? aktualnosciList.find('.mainblock > div') : katalogList.find(' > div'),
                maxHeight = Math.max.apply(null, content.map(function () {
                        return jQuery(this).outerHeight();
                    }).get()) + 40;

            content.css('min-height', maxHeight);
        }, 0);
    }
});