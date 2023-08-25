<div <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="banner__content">
					<?php
					if ( ! empty( $settings['title'] ) ) : ?>
						<h1 <?php echo $this->get_render_attribute_string( 'title'); ?>>
							<?php echo $settings['title']; ?>
						</h1>
					<?php endif ?>

					<?php if ( ! empty( $settings['description'] ) ) : ?>
						<p class="banner__description">
							<?php echo $settings['description']; ?>
						</p>
					<?php endif ?>

					<div class="banner__btns">
						<?php if ( ! empty( $settings['btn_link']['url'] ) ) : ?>
							<a <?php $this->print_render_attribute_string( 'button' ); ?>>
								<?php echo $settings['btn_text'] ?>
							</a>
						<?php endif; ?>

						<?php if ( ! empty( $settings['sec_btn_link']['url'] ) ) : ?>
							<a <?php $this->print_render_attribute_string( 'secondary_button' ); ?>>
								<?php echo esc_html( $settings['sec_btn_text'] ); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
