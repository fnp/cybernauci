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
        typSzkolyList = jQuery(jQuery.map(main.find('select option'), function (val) {
            if (val.text == "Wybierz typ szkoły *") {
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

        wojewodztwo = function () {
            jQuery.ajax({
                url: "/wp-content/themes/cybernauci/json/wojewodztwa.json",
                success: function (res) {
                    for (var i = 0; i < res.length; i++) {
                        wojewodztwoList.append(
                            jQuery('<option></option>').attr('value', res[i].id).text(res[i].nazwa)
                        )
                    }
                    wojewodztwoList.on('change', function (e) {
                        clearMiejscowosc();
                        clearSzkoly();
                        miejscowosc(this.value);
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
                            jQuery('<option></option>').attr('value', res[i].id).text(res[i].nazwa)
                        )
                    }
                    miejscowoscList.on('change', function (e) {
                        clearSzkoly();
                        szkoly(this.value);
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
                                'value': res[i].id,
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

                        typSzkolyList.val(szkola.attr('data-typ'));
                        szkolaUlica.val(szkola.attr('data-ulica'));
                        szkolaNumer.val(szkola.attr('data-numer'));
                        szkolaKod.val(szkola.attr('data-kod'));
                        szkolaPoczta.val(szkola.attr('data-poczta'));
                    });
                    typSzkolyList.on('change', function (e) {
                        var typ = this.value;

                        if (typ == "") {
                            nazwaSzkolyList.find('option').show();
                        } else {
                            nazwaSzkolyList.find('option').filter(function (itm) {
                                if (itm.attr('data-typ').toLowerCase() == typ.toLowerCase()) {
                                    itm.show();
                                } else {
                                    itm.hide();
                                }
                            });
                        }
                    })
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
            jQuery.each(typSzkolyList.find('options'), function () {
                if (jQuery(this).attr('value').length !== 0) {
                    jQuery(this).remove();
                }
            });
            jQuery.each(nazwaSzkolyList.find('options'), function () {
                if (jQuery(this).attr('value').length !== 0) {
                    jQuery(this).remove();
                }
            });
            szkolaUlica.val('Ulica *');
            szkolaNumer.val('Numer');
            szkolaKod.val('Kod pocztowy *');
        };
    wojewodztwo();
};