jQuery(document).ready(function () {
  var quizBlock = jQuery('#quiz'),
    opacityTime = 500, /*0.5s = 500ms*/
    expertMode = false,
    translate = {
      'poprzednie': 'Poprzednie',
      'nastepne': 'Następne',
      'poprawnaOdpowiedz': 'Prawidłowa odpowiedź:'
    },
    points = {
      total: 40,
      gold: 36,
      silver: 20
    };

  if (quizBlock.length > 0) {
    var questions = quizBlock.find('.questionBlock'),
      questionsLength = questions.length;

    questions.each(function (i) {
      var el = jQuery(this),
        content = el.html().match(/\[(.*)\]/g);

      var pytanie = jQuery.trim(content[0].slice(1, -1)),
        odpowiedz1 = content[1].slice(1, -1).split(':'),
        odpowiedz2 = content[2].slice(1, -1).split(':'),
        odpowiedz3 = content[3].slice(1, -1).split(':');

      el.empty().append(
        jQuery('<div></div>').addClass('question').text(pytanie)
      ).append(
        jQuery('<div></div>').addClass('answer').append(
          jQuery('<input>').attr({
            'type': 'radio',
            'class': 'answer',
            'name': 'pytanie-' + i,
            'id': 'pytanie-' + i + '-0',
            'data-type': 'A'
          }).data('rozwiazanie', jQuery.trim(odpowiedz1[2])).val(Number(odpowiedz1[0]))
        ).append(
          jQuery('<label>').attr('for', 'pytanie-' + i + '-0').text(jQuery.trim(odpowiedz1[1]))
        )
      ).append(
        jQuery('<div></div>').addClass('answer').append(
          jQuery('<input>').attr({
            'type': 'radio',
            'class': 'answer',
            'name': 'pytanie-' + i,
            'id': 'pytanie-' + i + '-1',
            'data-type': 'B'
          }).data('rozwiazanie', jQuery.trim(odpowiedz2[2])).val(Number(odpowiedz2[0]))
        ).append(
          jQuery('<label>').attr('for', 'pytanie-' + i + '-1').text(jQuery.trim(odpowiedz2[1]))
        )
      ).append(
        jQuery('<div></div>').addClass('answer').append(
          jQuery('<input>').attr({
            'type': 'radio',
            'class': 'answer',
            'name': 'pytanie-' + i,
            'id': 'pytanie-' + i + '-2',
            'data-type': 'C'
          }).data('rozwiazanie', jQuery.trim(odpowiedz3[2])).val(Number(odpowiedz3[0]))
        ).append(
          jQuery('<label>').attr('for', 'pytanie-' + i + '-2').text(jQuery.trim(odpowiedz3[1]))
        )
      ).append(
        jQuery('<div></div>').addClass('quizNavStats').append(
          jQuery('<div></div>').addClass('correctAnswer').text(translate.poprawnaOdpowiedz).append(
            jQuery('<span></span>').text('-')
          )
        ).append(
          jQuery('<div></div>').addClass('questionList').text((i + 1) + "/" + questionsLength)
        )
      ).append(
        jQuery('<div></div>').addClass('quizNavButtons').append(
          jQuery('<button></button>').addClass('prev').text(translate.poprzednie)
        ).addClass('quizNavButtons').append(
          jQuery('<button></button>').addClass('next').text(translate.nastepne)
        )
      ).append(
        jQuery('<div></div>').addClass('quizNavExpert')
      )
    });

    /*Question checked*/
    questions.find('input[type=radio]').change(function () {
      if (!expertMode) {
        countScore();
        jQuery(this).parents('.questionBlock').removeClass('visible').addClass('trigger');
        setTimeout(function () {
          quizBlock.find('.questionBlock.trigger').removeClass('trigger').next().addClass('visible');
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
          parent.find('.quizNavExpert').html(that.data('rozwiazanie'))
        }
      });
      setTimeout(function () {
        questions.removeClass('visible');
        quizBlock.find('.questionBlock:first').addClass('visible');
        quizBlock.addClass('expert');
      }, opacityTime);
    });

    /*Next and prev question*/
    quizBlock.find('.quizNavButtons > button').click(function () {
      var btn = jQuery(this);
      btn.parents('.questionBlock').removeClass('visible').addClass('trigger');
      if (btn.hasClass('prev')) {
        setTimeout(function () {
          quizBlock.find('.questionBlock.trigger').removeClass('trigger').prev().addClass('visible');
        }, opacityTime);
      }
      else {
        setTimeout(function () {
          quizBlock.find('.questionBlock.trigger').removeClass('trigger').next().addClass('visible');
        }, opacityTime);
      }
    });

    /*START*/
    questions.first().addClass('visible');

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