<?php get_header(); ?>

  <div id="rejestracja">
    <div class="info container-block">
      <div class="container mainblock">
        <img src="<?php bloginfo( 'template_directory' ); ?>/img/sidebanner-left-computer.png"
             class="sidebanner sidebanner-left" alt=""/>
        <img src="<?php bloginfo( 'template_directory' ); ?>/img/sidebanner-right-rockets.png"
             class="sidebanner sidebanner-right" alt=""/>
		  <?php if ( true ) { ?>
            <header class="entry-header">
              <h2 class="entry-title">Rejestracja szkół do projektu została zakończona.</h2>
            </header>
            <div class="entry-content registrationClosed">
              <div class="innerBlock col-xs-12 col-md-8 col-md-offset-2">
                <p><strong>Zachęcamy do samodzielnego prowadzenia zajęć przy pomocy naszych materiałów
                    edukacyjnych:</strong>
                <ul class="col-xs-8 col-md-11">
                  <li>Serwis edukacja medialna – zawiera pakiet scenariuszy z zakresu edukacji medialnej oraz
                    cyberbezpieczeństwa. Scenariusze zostały opracowane przy współpracy ekspertów z dziedziny edukacji
                    medialnej. Materiały są odpowiednie dla szkół wszystkich poziomów.
                    <span>www: <a href="https://edukacjamedialna.edu.pl/" target="_target">https://edukacjamedialna.edu.pl</a></span>
                  </li>
                  <li>Materiały edukacyjne „Cybernautów” – tutaj znajdują się komiksy edukacyjne dla dzieci i młodzieży,
                    scenariusze lekcji dla nauczycieli oraz test wiedzy dla rodziców.
                    <span>www: <a href="https://cybernauci.edu.pl/materialy-edukacyjne" target="_parent">https://cybernauci.edu.pl/materialy-edukacyjne</a></span>
                  </li>
                  <li>Baza dobrych praktyk – w bazie znajdują się opisy działań realizowanych w szkołach w ramach
                    konkursów Cybernautów. Baza jest ciekawym źródłem inspiracji do prowadzenia projektów wewnątrz jak i
                    zewnątrz szkolnych.
                    <span>www: <a href="https://cybernauci.edu.pl/dobre-praktyki/" target="_parent">https://cybernauci.edu.pl/dobre-praktyki/</a></span>
                  </li>
                  <li>Katalog materiałów edukacyjnych – katalogu gromadzimy ogólnodostepne materiały edukacyjne z
                    zakresu edukacji medialnej i bezpieczeństwa w sieci. Można tu znaleźć: quizy, gry, kolorowanki,
                    filmy edukacyjne, piosenki, poradniki, scenariusze zajęć i wiele innych materiałów.
                    <span>www: <a href="http://cybernauci.edu.pl/katalog/" target="_parent">http://cybernauci.edu.pl/katalog/</a></span>
                  </li>
                </ul>
              </div>
            </div>
		  <?php } else { ?>
            <header class="entry-header">
              <h2 class="entry-title">Formularz rejestracyjny</h2>
            </header>
            <div class="entry-content">
              <div class="col-xs-12 col-md-10 col-md-offset-1">
				  <?php echo get_field( 'rejestracja_wprowadzenie' ); ?>
              </div>
              <div class="innerBlock col-xs-12 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
				  <? the_content( sprintf(
					  __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'cybernauci' ),
					  get_the_title()
				  ) );
				  ?>
                <p class="col-xs-12 hidden validate-warning">Prosimy uzupełnić wszystkie <span
                      class="ninja-forms-req-symbol"><strong>*</strong></span> <strong>pola
                    obowiązkowe</strong> przed wysłaniem zgłoszenia.</p>
              </div>
            </div>
		  <?php } ?>
      </div>
    </div>
  </div>

  <div class="modal fade" id="szkolaAddNew" tabindex="-1" role="dialog" aria-labelledby="szkolaAddNewLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="szkolaAddNewLabel">Nowa szkoła</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="sr-only" for="newSzkolaNazwa">Nazwa szkoły *</label>
            <input type="text" class="form-control" id="newSzkolaNazwa" placeholder="Nazwa szkoły *"
                   required="required">
          </div>
          <div class="form-group">
            <label class="sr-only" for="newSzkolaUlica">Ulica *</label>
            <input type="text" class="form-control" id="newSzkolaUlica" placeholder="Ulica *"
                   required="required">
          </div>
          <div class="form-group">
            <label class="sr-only" for="newSzkolaNumer">Numer *</label>
            <input type="text" class="form-control" id="newSzkolaNumer" placeholder="Numer *"
                   required="required">
          </div>
          <div class="form-group">
            <label class="sr-only" for="newSzkolaKodPocztowy">Kod pocztowy *</label>
            <input type="text" class="form-control" id="newSzkolaKodPocztowy" placeholder="Kod pocztowy *"
                   required="required">
          </div>
          <div class="form-group">
            <label class="sr-only" for="newSzkolaPoczta">Poczta *</label>
            <input type="text" class="form-control" id="newSzkolaPoczta" placeholder="Poczta *"
                   required="required">
          </div>
          <div class="form-group">
            <label class="sr-only" for="newSzkolaEmail">Adres e-mail szkoły *</label>
            <input type="text" class="form-control" id="newSzkolaEmail" placeholder="Adres e-mail szkoły *"
                   required="required">
          </div>
          <div class="form-group">
            <label class="sr-only" for="newSzkolaPhone">Numer telefonu do szkoły *</label>
            <input type="text" class="form-control" id="newSzkolaPhone"
                   placeholder="Numer telefonu do szkoły *" required="required">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
          <button type="button" class="btn btn-primary">Dodaj szkołę</button>
        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>