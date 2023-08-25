<?php
if ( $settings['image']['url'] ): ?>
	<figure <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
		<div class="cnv-team__avater">
			<img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['name'] ); ?>">
		</div>
		<!-- /.member-avatar -->

		<?php if ( ! empty( $settings['social_icons'] ) && 'one' == $settings['layout'] ) : ?>
			<div class="cnv-team__icons-wrapper">
				<div class="cnv-team__expand-icon">
					<svg width="19" height="21" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M14.5 13C16.5703 13 18.25 14.6797 18.25 16.75C18.25 18.8594 16.5703 20.5 14.5 20.5C12.3906 20.5 10.75 18.8594 10.75 16.75C10.75 16.5547 10.7891 16.1641 10.8281 15.9688L6.80469 13.4688C6.17969 13.9766 5.35938 14.25 4.5 14.25C2.39062 14.25 0.75 12.6094 0.75 10.5C0.75 8.42969 2.39062 6.75 4.5 6.75C5.35938 6.75 6.17969 7.0625 6.80469 7.57031L10.8281 5.07031C10.75 4.83594 10.75 4.5625 10.75 4.25C10.75 2.17969 12.3906 0.5 14.5 0.5C16.5703 0.5 18.25 2.17969 18.25 4.25C18.25 6.35938 16.5703 8 14.5 8C13.6016 8 12.7812 7.72656 12.1562 7.21875L8.13281 9.71875C8.17188 9.91406 8.25 10.3047 8.25 10.5C8.25 10.7344 8.17188 11.125 8.13281 11.3203L12.1562 13.8203C12.7812 13.3125 13.6016 13 14.5 13Z" fill="white"/>
					</svg>
				</div>
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
			</div>
		<?php endif; ?>

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
		</div>
	</figure><!-- .cnv-team -->
<?php
endif;