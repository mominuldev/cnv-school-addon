<div class="col-lg-<?php echo esc_attr( $settings['column'] ); ?> col-md-6 col-sm-6">
	<div <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
		<div class="rbt-feature-box__header">
			<?php if ( $item['title'] ): ?>
				<h4 class="rbt-feature-box__sub-title">
					<?php printf( '%s', $item['subtitle'] ); ?>
				</h4>
			<?php endif; ?>

			<span class="rbt-feature-box__count">
			<?php echo $count < 10 ? '0' . $count += 1 : $count += 1; ?>
		</span>
		</div>


		<div class="rbt-feature-box__content">
			<?php if ( $item['title'] ): ?>
				<h4 class="rbt-feature-box__title">
					<?php printf( '%s', $item['title'] ); ?>
				</h4>
			<?php endif; ?>
		</div>
	</div>
	<!-- /.rbt-feature-box -->
</div>
