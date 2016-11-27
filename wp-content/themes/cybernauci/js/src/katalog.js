jQuery(document).ready(function () {
  var katalogMeta = jQuery('.katalog-meta');

  if (katalogMeta.length > 0) {
    katalogMeta.find('.katalog-meta-parent').click(function () {
      katalogMeta.toggleClass('active');
    })
  }
});