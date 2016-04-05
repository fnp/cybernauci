window.onload = function () {
    var main = jQuery('#rejestracja .ninja-forms-cont'),
        wojewodztwoList = jQuery(jQuery.map(main.find('select option'), function (val) {
            if (val.text == "Wybierz województwo *") {
                return val;
            }
        })[0]).parent(),
        miejscowoscList = jQuery(jQuery.map(main.find('select option'), function (val) {
            if (val.text == "Wybierz miejscowość *") {
                return val;
            }
        })[0]).parent(),
        nazwaSzkolyList = jQuery(jQuery.map(main.find('select option'), function (val) {
            if (val.text == "Nazwa szkoły *") {
                return val;
            }
        })[0]).parent(),
        szkolaUlica = main.find('input[value="Ulica *"]:visible'),
        szkolaNumer = main.find('input[value="Numer"]:visible'),
        szkolaKod = main.find('input[value="Kod pocztowy *"]:visible'),
        szkolaPoczta = main.find('input[value="Poczta *"]:visible'),
        szkolaEmail = main.find('input[value="Adres e-mail szkoły *"]:visible'),
        szkolaPhone = main.find('input[value="Numer telefonu do szkoły *"]:visible'),
        szkolaAddNew = main.find('#szkolaAddNew'),

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
                        var id = jQuery("option:selected", this).attr('data-id');

                        clearMiejscowosc();
                        clearSzkoly();
                        console.log(id, main.find('.hidden_wojewodztwo_id').val());
                        miejscowosc(id);
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
                        var id = jQuery("option:selected", this).attr('data-id');

                        clearSzkoly();
                        main.find('.hidden_miejscowosc_id').val(id);
                        szkoly(id);
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

                        if (this.value == '' && szkola.text() == '(Szkoła z poza listy)') {
                            szkolaAddNew.modal('show')
                        } else {
                            main.find('.hidden_szkola_id').val(szkola.attr('data-id'));
                            szkolaUlica.val(szkola.attr('data-ulica'));
                            szkolaNumer.val(szkola.attr('data-numer'));
                            szkolaKod.val(szkola.attr('data-kod'));
                            szkolaPoczta.val(szkola.attr('data-poczta'));
                        }
                    });
                }
            });
        },
        clearMiejscowosc = function () {
            jQuery.each(miejscowoscList.find('options'), function () {
                if (jQuery(this).attr('value').length !== 0) {
                    jQuery(this).remove();
                }
            })
        },
        clearSzkoly = function () {
            jQuery.each(nazwaSzkolyList.find('options'), function () {
                if (jQuery(this).attr('value').length !== 0) {
                    jQuery(this).remove();
                }
            });
            szkolaUlica.val('Ulica *');
            szkolaNumer.val('Numer');
            szkolaKod.val('Kod pocztowy *');
            szkolaPoczta.val('Poczta *');
        };

    szkolaAddNew.find('.modal-footer .btn-primary').unbind('click').click(function (e) {
        e.preventDefault();

        var modalSerial = {};
        szkolaAddNew.find('input').map(function (key, item) {
            var n = item.id,
                v = item.value;
            modalSerial[n] = v;
        });
        if (nazwaSzkolyList.find('.option[value="' + modalSerial.newSzkolaNazwa + '"]').length == 0) {
            nazwaSzkolyList.append($('<option>').attr({
                    'data-ulica': modalSerial.newSzkolaUlica,
                    'data-numer': modalSerial.newSzkolaNumer,
                    'data-kod': modalSerial.newSzkolaKodPocztowy,
                    'data-poczta': modalSerial.newSzkolaPoczta,
                    'selected': 'selected'
                }).val(modalSerial.newSzkolaNazwa).text(modalSerial.newSzkolaNazwa)
            );
            szkolaUlica.val(modalSerial.newSzkolaUlica);
            szkolaNumer.val(modalSerial.newSzkolaNumer);
            szkolaKod.val(modalSerial.newSzkolaKodPocztowy);
            szkolaPoczta.val(modalSerial.newSzkolaPoczta);
            szkolaEmail.val(modalSerial.newSzkolaEmail);
            szkolaPhone.val(modalSerial.newSzkola);

            szkolaAddNew.modal('hide');
        }
    });

    wojewodztwo();
};