<div <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>

	<div class="container">
		<div class="row pr">
			<div class="col-lg-8 cnv-order-2">
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
					<?php if ( $settings['brands_lists'] ) : ?>
					<div class="banner__brands wow fadeInUp" data-wow-delay="2.7s">
						<?php if ( ! empty( $settings['brand_title'] ) ) : ?>
							<h3 class="banner__brands-title wow fadeInUp""><?php echo esc_html( $settings['brand_title'] ); ?></h3>
						<?php endif; ?>

						<ul class="banner__brand-list">
							<?php
							$ant = 0.3;
							?>
							<?php foreach ( $settings['brands_lists'] as $item ) :

								?>
								<li class="wow fadeInUp" data-wow-delay="<?php echo $ant; ?>s">
									<img src="<?php echo esc_url( $item['brand_image']['url'] ); ?>"  alt="<?php echo esc_attr( $item['brand_name'] ); ?>">
								</li>
							<?php $ant += 0.1; endforeach; ?>
						</ul>
					</div>
					<?php endif; ?>
				</div>
			</div>

			<?php if ( $settings['social_icons'] ) : ?>
			<ul class="banner__social-links">
				<?php foreach ( $settings['social_icons'] as $item ) : ?>
					<li class="wow" data-wow-delay=".5s">
						<a href="<?php echo esc_url( $item['social_link']['url'] ); ?>" target="_blank">

							<span class="banner__social-name"><?php echo esc_html( $item['social_title'] ); ?></span>
							<?php \Elementor\Icons_Manager::render_icon( $item['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</div>
	</div>

</div>
