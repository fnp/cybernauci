<?php get_header(); ?>

	<div id="quiz">
		<div class="info container-block">
			<div class="container mainblock">
				<header class="entry-header">
					<h2 class="entry-title">QUIZ</h2>
					<h3 class="entry-subtitle">Mama i Tata bezpieczni w sieci.</h3>
				</header>
				<div class="entry-content">
					<div class="quiz-content">
						<?php $fields = get_field_objects();
						if ( $fields ) {
							foreach ( $fields as $field_name => $field ) {
								if ( substr( $field['label'], 0, 7 ) === "Pytanie" && $field['value'] ) {
									echo '<div class="questionBlock col-xs-12 col-md-6">' . $field['value'] . '</div>';
								}
							}
						} ?>
						<div class="quizScore col-xs-12 col-md-6">
							<div class="points"></div>
							<? if ( $fields ) {
								foreach ( $fields as $field_name => $field ) {
									if ( substr( $field['label'], 0, 7 ) !== "Pytanie" && $field['value'] ) {
										echo '<div class="quizTitle ' . $field_name . '">' . $field['label'] . '</div>';
										echo '<div class="quizComment ' . $field_name . '">' . $field['value'] . '</div>';
									}
								}
							} ?>
							<div class="expertHints">
								<button>Pokaż odpowiedzi z komentarzami eksperta</button>
							</div>
							<div class="socialShare"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>