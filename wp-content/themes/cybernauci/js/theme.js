jQuery(document).ready(function () {
  var aktualnosciList = jQuery('.aktualnosci-list'),
    katalogList = jQuery('.katalog-list');

  if (aktualnosciList.length || katalogList.length) {
    window.setTimeout(function () {
      var content = (aktualnosciList.length > 0) ? aktualnosciList.find('.mainblock > div') : katalogList.find(
        ' > div'),
        maxHeight = Math.max.apply(null, content.map(function () {
            return jQuery(this).outerHeight();
          }).get()) + 40;

      content.css('min-height', maxHeight);
    }, 0);
  }
});
jQuery(document).ready(function () {
  var katalogMeta = jQuery('.katalog-meta');

  if (katalogMeta.length > 0) {
    katalogMeta.find('.katalog-meta-parent').click(function () {
      katalogMeta.toggleClass('active');
    })
  }
});
jQuery(document).ready(function () {
  var konkursBlock = jQuery('#konkurs'),
    konkursMain = konkursBlock.find('.ninja-forms-cont');

  konkursBlock.find('.information-btn .konkurs-close').click(function () {
    konkursBlock.find('.information-modal, .information-background').remove();
  });
  if (jQuery('#konkurs').find('form.ninja-forms-no-display').length > 0) {
    konkursBlock.find('.information-modal, .information-background').remove();
  }
  if (konkursMain.length > 0) {
    var wojewodztwoList = jQuery(jQuery.map(konkursMain.find('select option'), function (val) {
        if (val.text == "Wybierz województwo *") {
          return val;
        }
      })[0]).parent(),
      miejscowoscList = jQuery(jQuery.map(konkursMain.find('select option'), function (val) {
        if (val.text == "Wybierz miejscowość *") {
          return val;
        }
      })[0]).parent(),
      nazwaSzkolyTyp = jQuery(jQuery.map(konkursMain.find('select option'), function (val) {
        if (val.text == "Wybierz typ szkoły *") {
          return val;
        }
      })[0]).parent(),
      nazwaSzkolyList = jQuery(jQuery.map(konkursMain.find('select option'), function (val) {
        if (val.text == "Nazwa szkoły *") {
          return val;
        }
      })[0]).parent(),
      szkolaUlica = konkursMain.find('input[value="Ulica *"]:visible'),
      szkolaNumer = konkursMain.find('input[value="Numer"]:visible'),
      szkolaKod = konkursMain.find('input[value="Kod pocztowy *"]:visible'),
      szkolaPoczta = konkursMain.find('input[value="Poczta *"]:visible'),
      szkolaEmail = konkursMain.find('input[value="Adres e-mail szkoły *"]:visible'),
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
              konkursMain.find('.hidden_wojewodztwo_id').val(select.attr('data-id'));
              konkursMain.find('.hidden_wojewodztwo_nazwa').val(select.val());
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
              konkursMain.find('.hidden_miejscowosc_id').val(select.attr('data-id'));
              konkursMain.find('.hidden_miejscowosc_nazwa').val(select.val());
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
                konkursMain.find('.hidden_szkola_id').val(szkola.attr('data-id'));
                konkursMain.find('.hidden_szkola_nazwa').val(szkola.attr('value'));
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
        konkursMain.find('.hidden_szkola_nazwa').val(modalSerial.newSzkolaNazwa);
        if (modalSerial.newSzkolaUlica.length) szkolaUlica.val(modalSerial.newSzkolaUlica);
        if (modalSerial.newSzkolaNumer.length) szkolaNumer.val(modalSerial.newSzkolaNumer);
        if (modalSerial.newSzkolaKodPocztowy.length) szkolaKod.val(modalSerial.newSzkolaKodPocztowy);
        if (modalSerial.newSzkolaPoczta.length) szkolaPoczta.val(modalSerial.newSzkolaPoczta);
        if (modalSerial.newSzkolaEmail.length) szkolaEmail.val(modalSerial.newSzkolaEmail);

        szkolaAddNew.modal('hide');
      }
    });

    konkursMain.find('select').each(function () {
      jQuery(this).find('option:first').attr('selected', 'selected');
    });

    wojewodztwo();

    konkursMain.find('input[type="submit"]').click(function () {
      var validate = (konkursMain.find(
        'form select.ninja-forms-req option:selected[value=""]').length == 0) ? true : false;
      konkursMain.find('form input.ninja-forms-req[type="text"]').filter(function () {
        var e = jQuery(this);
        if (e.val() == jQuery('#' + e.attr('id') + '_label_hidden').val()) {
          validate = false;
        }
      });
      if (konkursMain.find('form input.ninja-forms-req[type="checkbox"]:not(:checked)').length !== 0) validate = false;

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
jQuery(document).ready(function () {
  var quizBlock = jQuery('#quiz'),
    quizContent = quizBlock.find('.quiz-content'),
    opacityTime = 500, /*0.5s = 500ms*/
    expertMode = false,
    translate = {
      'poprzednie': 'Poprzednie',
      'nastepne': 'Następne',
      'koniec': 'Zakończ quiz',
      'twojaOdpowiedz': 'Twoja odpowiedź:',
      'poprawnaOdpowiedz': 'Najwyżej punktowana odpowiedź:'
    },
    points = {
      total: 40,
      gold: 36,
      silver: 20
    };

  if (quizBlock.length > 0) {
    var questions = quizBlock.find('.questionBlock'),
      questionsLength = questions.length;

    questions.last().addClass('last');
    questions.each(function (i) {
      var el = jQuery(this),
        content = el.html().match(/[^[\]]+(?=])/g),
        questionHtml = jQuery('<div></div>'),
        answersHtml = jQuery('<div></div>');

      jQuery.each(content, function (index, value) {
        if (index == 0) {
          questionHtml.addClass('question').text(value);
        }
        else {
          var temp = content[index].substr(content[index].indexOf(':') + 1),
            letter = ['0', 'A', 'B', 'C', 'D', 'E', 'F'],
            p = content[index].substr(0, content[index].indexOf(':')),
            q = temp.substr(0, temp.indexOf(':')),
            e = temp.substr(temp.indexOf(':') + 1);

          answersHtml.append(
            jQuery('<div></div>').addClass('answer').append(
              jQuery('<input>').attr({
                'type': 'radio',
                'class': 'answer',
                'name': 'pytanie-' + i,
                'id': 'pytanie-' + i + '-' + letter[index],
                'data-type': letter[index]
              }).data('rozwiazanie', '<p>' + jQuery.trim(e)).val(Number(p))
            ).append(
              jQuery('<label>').attr('for', 'pytanie-' + i + '-' + letter[index]).html(jQuery.trim(q))
            )
          )
        }
      });
      el.empty().append(questionHtml).append(answersHtml).append(
        jQuery('<div></div>').addClass('quizNavStats').append(
          jQuery('<div></div>').addClass('yourAnswer').text(translate.twojaOdpowiedz).append(
            jQuery('<span></span>').text('-')
          )
        ).append(
          jQuery('<div></div>').addClass('correctAnswer').text(translate.poprawnaOdpowiedz).append(
            jQuery('<span></span>').text('-')
          )
        )
      ).append(
        jQuery('<div></div>').addClass('quizNavStats').append(
          jQuery('<div></div>').addClass('questionList').text((i + 1) + "/" + questionsLength)
        )
      ).append(
        jQuery('<div></div>').addClass('quizNavExpert')
      ).append(
        jQuery('<div></div>').addClass('quizNavButtons').append(
          jQuery('<button></button>').addClass('prev').text(translate.poprzednie)
        ).append(
          jQuery('<button></button>').addClass('next').text(translate.nastepne)
        ).append(
          jQuery('<a></a>').attr({'href': '/', 'target': '_self'}).addClass('button-link').text(translate.koniec)
        )
      )
    });

    /*Question checked*/
    questions.find('input[type=radio]').change(function () {
      if (!expertMode) {
        countScore();
        jQuery(this).parents('.questionBlock').removeClass('visible').addClass('trigger');
        setTimeout(function () {
          var next = quizBlock.find('.questionBlock.trigger').removeClass('trigger').next();
          quizContent.css('height', next.outerHeight() + 'px');
          next.addClass('visible');
          scrollTop();
        }, opacityTime);
      }
    });

    /*Expert mode ON*/
    quizBlock.find('.expertHints > button').click(function () {
      expertMode = true;
      quizBlock.find('.quizScore').removeClass('visible');
      questions.find('input[type=radio]').each(function () {
        var that = jQuery(this),
          parent = that.parents('.questionBlock');
        that.prop('disabled', 'disabled');
        if (that.val() == 2) {
          parent.find('.quizNavStats .correctAnswer > span').text(that.attr('data-type'));
        }
        if (that.is(':checked')) {
          parent.find('.quizNavStats .yourAnswer > span').text(that.attr('data-type'));
          parent.find('.quizNavExpert').html(that.data('rozwiazanie'))
        }
      });
      setTimeout(function () {
        var reset = quizBlock.find('.questionBlock:first');
        questions.removeClass('visible');
        quizBlock.addClass('expert');
        quizContent.css('height', reset.outerHeight() + 'px');
        reset.addClass('visible');
      }, opacityTime);
    });

    /*Next and prev question*/
    quizBlock.find('.quizNavButtons > button').click(function () {
      var btn = jQuery(this);
      btn.parents('.questionBlock').removeClass('visible').addClass('trigger');
      if (btn.hasClass('prev')) {
        setTimeout(function () {
          var prev = quizBlock.find('.questionBlock.trigger').removeClass('trigger').prev();
          quizContent.css('height', prev.outerHeight() + 'px');
          prev.addClass('visible');
          scrollTop();
        }, opacityTime);
      }
      else {
        setTimeout(function () {
          var next = quizBlock.find('.questionBlock.trigger').removeClass('trigger').next();
          quizContent.css('height', next.outerHeight() + 'px');
          next.addClass('visible');
          scrollTop();
        }, opacityTime);
      }
    });

    /*START*/
    questions.first().addClass('visible');

    function scrollTop() {
      jQuery('html, body').animate({
        scrollTop: jQuery("#quiz .entry-header").offset().top
      }, 1000);
    }

    function countScore() {
      var scorePoints = 0,
        quizScore = quizBlock.find('.quizScore');

      questions.find('input[type=radio]:checked').each(function () {
        scorePoints += parseInt(jQuery(this).val(), 10);
      });
      quizScore.find('.points').text(scorePoints + '/' + points.total);
      quizScore.removeClass('gold silver bronze').addClass(
        scorePoints >= points.gold ? 'gold' : (scorePoints >= points.silver) ? 'silver' : 'bronze');
    }
  }
});
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