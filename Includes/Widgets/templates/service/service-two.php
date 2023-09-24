<div <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
	<?php if ( 'one' == $settings['layout'] ) : ?>
		<div class="cnv-service-list__image">
			<img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="<?php echo esc_attr( $item['title'] ) ?>">
		</div>
	<?php endif; ?>

	<?php if ( 'two' == $settings['layout'] ) : ?>
		<span class="cnv-service-list__count">
			<?php echo $count < 10 ? '0' . $count += 1 : $count += 1; ?>
		</span>
	<?php endif; ?>

	<div class="cnv-service-list__content">
		<?php if ( $item['title'] ): ?>
			<h4 class="cnv-service-list__title">
				<?php if ( 'one' == $settings['layout'] ) : ?>
					<span class="cnv-service-list__count">
						<?php echo $count < 10 ? '0' . $count += 1 : $count += 1; ?> -
					</span>
				<?php endif; ?>
				<a href="<?php echo esc_url( $item['button_link']['url'] ); ?>">
					<?php printf( '%s', $item['title'] ); ?>
				</a>
			</h4>
		<?php endif; ?>

		<div class="cnv-service-list__link-wrapper">
			<?php if ( 'one' == $settings['layout'] ) : ?>
				<div class="cnv-service-list__description">
					<?php printf( '%s', $item['description'] ); ?>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $item['button_link']['url'] ) ): ?>
				<a href="<?php echo esc_url( $item['button_link']['url'] ); ?>" class="cnv-service-list__arrow">
					<span><i class="fa-solid fa-arrow-right"></i></span>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- /.cnv-service-list -->
