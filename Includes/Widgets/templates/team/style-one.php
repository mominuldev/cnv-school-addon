<?php
if ( $settings['image']['url'] ): ?>
	<figure <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
		<div class="cnv-team__avater">
			<img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['name'] ); ?>">
		</div>
		<!-- /.member-avatar -->

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

            <?php if ( $settings['mobile_number'] ): ?>
				<p class="cnv-team__number">
					<?php printf( '%s', $settings['mobile_number'] ); ?>
				</p>
			<?php endif; ?>

            <?php if ( $settings['short_info'] ): ?>
				<p class="cnv-team__short-info">
					<?php printf( '%s', $settings['short_info'] ); ?>
				</p>
			<?php endif; ?>

			<?php if ( ! empty( $settings['social_icons'] ) && 'one' == $settings['layout'] ) : ?>
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


            <?php if ( $settings['button_text'] ): ?>
                <a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>" class="cnv-team__button cnv-btn btn-small btn-round">
                    <?php printf( '%s', $settings['button_text'] ); ?>
                </a>
            <?php endif; ?>

		</div>
	</figure><!-- .cnv-team -->
<?php
endif;