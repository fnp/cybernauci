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
        jQuery('<div></div>').addClass('quizNavButtons noAnswer').append(
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
          quizBlock.find('.questionBlock.trigger .quizNavButtons').removeClass('noAnswer');
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
        if (that.val() === '2') {
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