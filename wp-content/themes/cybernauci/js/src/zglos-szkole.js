jQuery(document).ready(function () {
  var zglosSzkoleMain = jQuery('#rejestracja .ninja-forms-cont');
  if (zglosSzkoleMain.length > 0) {
    var wojewodztwoList = jQuery(jQuery.map(zglosSzkoleMain.find('select option'), function (val) {
        if (val.text == "Wybierz województwo *") {
          return val;
        }
      })[0]).parent(),
      miejscowoscList = jQuery(jQuery.map(zglosSzkoleMain.find('select option'), function (val) {
        if (val.text == "Wybierz miejscowość *") {
          return val;
        }
      })[0]).parent(),
      nazwaSzkolyTyp = jQuery(jQuery.map(zglosSzkoleMain.find('select option'), function (val) {
        if (val.text == "Wybierz typ szkoły *") {
          return val;
        }
      })[0]).parent(),
      nazwaSzkolyList = jQuery(jQuery.map(zglosSzkoleMain.find('select option'), function (val) {
        if (val.text == "Nazwa szkoły *") {
          return val;
        }
      })[0]).parent(),
      szkolaUlica = zglosSzkoleMain.find('input[value="Ulica *"]:visible'),
      szkolaNumer = zglosSzkoleMain.find('input[value="Numer"]:visible'),
      szkolaKod = zglosSzkoleMain.find('input[value="Kod pocztowy *"]:visible'),
      szkolaPoczta = zglosSzkoleMain.find('input[value="Poczta *"]:visible'),
      szkolaEmail = zglosSzkoleMain.find('input[value="Adres e-mail szkoły *"]:visible'),
      szkolaAddNew = jQuery('#szkolaAddNew'),

      wojewodztwo = function () {
        jQuery.ajax({
          url: "/wp-content/themes/cybernauci/json/wojewodztwa.json",
          success: function (res) {
            for (var i = 0; i < res.length; i++) {
              wojewodztwoList.append(
                jQuery('<option></option>').attr({
                  'data-id': res[i].id,
                  'value': res[i].nazwa
                }).text(res[i].nazwa)
              )
            }
            wojewodztwoList.on('change', function (e) {
              var select = jQuery("option:selected", this);

              clearMiejscowosc();
              clearSzkoly();
              zglosSzkoleMain.find('.hidden_wojewodztwo_id').val(select.attr('data-id'));
              zglosSzkoleMain.find('.hidden_wojewodztwo_nazwa').val(select.val());
              miejscowosc(select.attr('data-id'));
            })
          }
        });
      },
      miejscowosc = function (wojewodztwo_id) {
        jQuery.ajax({
          url: "/wp-content/themes/cybernauci/json/miejscowosci/" + wojewodztwo_id + ".json",
          success: function (res) {
            for (var i = 0; i < res.length; i++) {
              miejscowoscList.append(
                jQuery('<option></option>').attr({
                  'data-id': res[i].id,
                  'value': res[i].nazwa
                }).text(res[i].nazwa)
              )
            }
            miejscowoscList.on('change', function (e) {
              var select = jQuery("option:selected", this);

              clearSzkoly();
              zglosSzkoleMain.find('.hidden_miejscowosc_id').val(select.attr('data-id'));
              zglosSzkoleMain.find('.hidden_miejscowosc_nazwa').val(select.val());
              szkoly(select.attr('data-id'));
            })
          }
        });
      },
      szkoly = function (miejscowosc_id) {
        jQuery.ajax({
          url: "/wp-content/themes/cybernauci/json/szkoly/" + miejscowosc_id + ".json",
          success: function (res) {
            for (var i = 0; i < res.length; i++) {
              nazwaSzkolyList.append(
                jQuery('<option></option>').attr({
                  'value': res[i].nazwa,
                  'data-id': res[i].id,
                  'data-typ': res[i].typ,
                  'data-ulica': res[i].ulica,
                  'data-numer': res[i].numer,
                  'data-kod': res[i].kod,
                  'data-poczta': res[i].miejscowosc
                }).text(res[i].nazwa)
              );
            }
            nazwaSzkolyList.on('change', function (e) {
              var szkola = jQuery("option:selected", this);

              if (this.value == '' && szkola.text().indexOf('z poza listy)') >= 0) {
                szkolaAddNew.modal('show')
              }
              else {
                zglosSzkoleMain.find('.hidden_szkola_id').val(szkola.attr('data-id'));
                zglosSzkoleMain.find('.hidden_szkola_nazwa').val(szkola.attr('value'));
                if (szkola.attr('data-ulica').length) szkolaUlica.val(szkola.attr('data-ulica'));
                if (szkola.attr('data-numer').length) szkolaNumer.val(szkola.attr('data-numer'));
                if (szkola.attr('data-kod').length) szkolaKod.val(szkola.attr('data-kod'));
                if (szkola.attr('data-poczta').length) szkolaPoczta.val(szkola.attr('data-poczta'));
                if (szkola.attr('data-typ').length) nazwaSzkolyTyp.find(
                  'option[value="' + szkola.attr('data-typ') + '"]').selected();
              }
            });
          }
        });
      },
      clearMiejscowosc = function () {
        jQuery.each(miejscowoscList.find('option'), function () {
          if (jQuery(this).attr('value').length !== 0) {
            jQuery(this).remove();
          }
        })
      },
      clearSzkoly = function () {
        jQuery.each(nazwaSzkolyList.find('option'), function () {
          if (jQuery(this).attr('value').length !== 0) {
            jQuery(this).remove();
          }
        });
        szkolaUlica.val('Ulica *');
        szkolaNumer.val('Numer');
        szkolaKod.val('Kod pocztowy *');
        szkolaPoczta.val('Poczta *');
      };

    nazwaSzkolyTyp.on('change', function (e) {
      var typ = this.value;

      if (typ !== '') {
        nazwaSzkolyList.find('option[value!=""][data-typ!="' + typ.toLowerCase() + '"]:visible').hide();
        nazwaSzkolyList.find('option[value!=""][data-typ="' + typ.toLowerCase() + '"]:hidden').show();
      }
      else {
        nazwaSzkolyList.find('option:hidden').show();
      }
    });

    nazwaSzkolyList.on('change', function (e) {
      var szkola = jQuery("option:selected", this);

      if (this.value == '' && szkola.text().indexOf('z poza listy)') >= 0) {
        szkolaAddNew.modal('show')
      }
    });

    szkolaAddNew.find('.modal-footer .btn-primary').click(function (e) {
      e.preventDefault();

      var modalSerial = {};
      szkolaAddNew.find('input').map(function (key, item) {
        var n = item.id,
          v = item.value;
        modalSerial[n] = v;
      });
      if (nazwaSzkolyList.find('.option[value="' + modalSerial.newSzkolaNazwa + '"]').length == 0) {
        nazwaSzkolyList.append(jQuery('<option>').attr({
            'data-ulica': modalSerial.newSzkolaUlica,
            'data-numer': modalSerial.newSzkolaNumer,
            'data-kod': modalSerial.newSzkolaKodPocztowy,
            'data-poczta': modalSerial.newSzkolaPoczta,
            'selected': 'selected'
          }).val(modalSerial.newSzkolaNazwa).text(modalSerial.newSzkolaNazwa)
        );
        zglosSzkoleMain.find('.hidden_szkola_nazwa').val(modalSerial.newSzkolaNazwa);
        if (modalSerial.newSzkolaUlica.length) szkolaUlica.val(modalSerial.newSzkolaUlica);
        if (modalSerial.newSzkolaNumer.length) szkolaNumer.val(modalSerial.newSzkolaNumer);
        if (modalSerial.newSzkolaKodPocztowy.length) szkolaKod.val(modalSerial.newSzkolaKodPocztowy);
        if (modalSerial.newSzkolaPoczta.length) szkolaPoczta.val(modalSerial.newSzkolaPoczta);
        if (modalSerial.newSzkolaEmail.length) szkolaEmail.val(modalSerial.newSzkolaEmail);

        szkolaAddNew.modal('hide');
      }
    });

    zglosSzkoleMain.find('select').each(function () {
      jQuery(this).find('option:first').attr('selected', 'selected');
    });

    wojewodztwo();

    zglosSzkoleMain.find('input[type="submit"]').click(function () {
      var validate = (zglosSzkoleMain.find(
        'form select.ninja-forms-req option:selected[value=""]').length == 0) ? true : false;
      zglosSzkoleMain.find('form input.ninja-forms-req[type="text"]').filter(function () {
        var e = jQuery(this);
        if (e.val() == jQuery('#' + e.attr('id') + '_label_hidden').val()) {
          validate = false;
        }
      });
      if (zglosSzkoleMain.find(
          'form input.ninja-forms-req[type="checkbox"]:not(:checked)').length !== 0) validate = false;

      if (validate == false) {
        jQuery('.validate-warning').removeClass('hidden').show();
        return false;
      }
      else {
        jQuery('.validate-warning').hide();
        return true;
      }
    });
  }
});