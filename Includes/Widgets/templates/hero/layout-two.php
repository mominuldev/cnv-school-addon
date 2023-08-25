<div <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
	<div class="banner__shape-circle wow fadeInLeft">
		<img src="<?php echo esc_url( $settings['banner_shape_circle']['url']); ?>" alt="<?php echo esc_attr($settings['title']); ?>">
	</div>

	<?php if ( ! empty( $settings['marque_text'] ) ) : ?>
		<div class="banner__marquee">
			<div class="marquee-wrap">
				<ul class="banner__marquee-text">
					<?php foreach ( $settings['marque_text'] as $index => $item ) : ?>
						<li class="marquee-text"><?php echo $item['marque_text']; ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $settings['marque_text'] ) ) : ?>
		<div class="banner__marquee marque-center">
			<div class="marquee-wrap-two">
				<ul class="banner__marquee-text">
					<?php foreach ( $settings['marque_text'] as $index => $item ) : ?>
						<li class="marquee-text"><?php echo $item['marque_text']; ?></li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="banner__cube-shape">
				<img src="<?php echo esc_url( $settings['banner_shape_cube']['url']); ?>" alt="<?php echo esc_attr($settings['title']); ?>">
			</div>
		</div>
	<?php endif; ?>

	<div class="container d-flex align-items-center">
		<div class="row">
			<div class="col-lg-7 cnv-order-2">
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

	<div class="banner__feature-image">
		<?php if ( ! empty( $settings['feature_image_two']['url'] ) ) : ?>
			<img src="<?php echo esc_url( $settings['feature_image_two']['url'] ); ?>" class="wow fadeInRight" data-wow-delay="0.3s"
				 alt="<?php echo esc_attr( $settings['title'] ); ?>">
		<?php endif; ?>
	</div>
	<!-- /.banner-feature-image -->

</div>
