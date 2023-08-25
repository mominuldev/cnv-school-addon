<?php
if ( $settings['image']['url'] ): ?>
	<figure <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
		<div class="cnv-team__avater">
			<img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['name'] ); ?>">
		</div>
		<!-- /.member-avater -->

		<div class="cnv-team__info">
			<?php if ( $settings['name'] ): ?>
				<h5 class="cnv-team__name">
					<?php printf( '%s', $settings['name'] ); ?>
				</h5>
			<?php endif; ?>

			<?php if ( $settings['position'] ): ?>
				<h6 class="cnv-team__designation">
					<?php printf( '%s', $settings['position'] ); ?>
				</h6>
			<?php endif; ?>

			<?php if ( ! empty( $settings['social_icons'] )  ) : ?>

				<ul class="cnv-team__social">
					<?php foreach ( $settings['social_icons'] as $index => $item ) :
						$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'social-icon', $index );
						$this->add_render_attribute( $repeater_setting_key, 'class', 'cnv-social-icon' );

						?>
						<li <?php $this->print_render_attribute_string( 'social-icon' ); ?>>
							<?php
							if ( ! empty( $item['link']['url'] ) ) {
							$link_key = 'link_' . $index;

							$this->add_link_attributes( $link_key, $item['link'] );
							?>
							<a <?php $this->print_render_attribute_string( $link_key ); ?>>

								<?php }
								\Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
								<?php if ( ! empty( $item['link']['url'] ) ) : ?>
							</a>
						<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>

			<?php endif; ?>
		</div>
	</figure><!-- .cnv-team -->
<?php
endif;