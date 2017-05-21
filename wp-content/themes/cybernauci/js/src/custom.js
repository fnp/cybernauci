jQuery(document).ready(function () {
  var sortedList = jQuery('.list-sorted'),
    katalogList = jQuery('.katalog-list');

  if (sortedList.length) {
    window.setTimeout(function () {
      var content = (sortedList.length > 0) ? sortedList.find('.mainblock > div') : katalogList.find(' > div'),
        maxHeight = Math.max.apply(null, content.map(function () {
            return jQuery(this).outerHeight();
          }).get()) + 40;
      content.css('min-height', maxHeight);
    }, 0);
  }
});