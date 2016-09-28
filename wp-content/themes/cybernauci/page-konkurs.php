<?php get_header(); ?>

    <div id="konkurs">
        <div class="information-modal">
            <?php the_field('konkurs-modal'); ?>
            <div class="information-btn text-center">
                <button class="btn btn-primary konkurs-close">Zamknij</button>
            </div>
        </div>
        <div class="information-background"></div>

        <div class="info container-block">
            <div class="container mainblock">
                <img src="<?php bloginfo('template_directory'); ?>/img/sidebanner-left-computer.png"
                     class="sidebanner sidebanner-left" alt=""/>
                <img src="<?php bloginfo('template_directory'); ?>/img/sidebanner-right-rockets.png"
                     class="sidebanner sidebanner-right" alt=""/>

                <header class="entry-header">
                    <h2 class="entry-title">Konkurs</h2>
                </header>
                <div class="entry-content">
                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                        <?php echo get_field('rejestracja_wprowadzenie'); ?>
                    </div>
                    <div class="innerBlock col-xs-12 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                        <? the_content(sprintf(
                            __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'cybernauci'),
                            get_the_title()
                        ));
                        ?>
                        <p class="col-xs-12 hidden validate-warning">Prosimy uzupełnić wszystkie <span
                                class="ninja-forms-req-symbol"><strong>*</strong></span> <strong>pola
                                obowiązkowe</strong> przed wysłaniem zgłoszenia.</p>
                    </div>
                </div>
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