<div class="pricing_wrapper">
    <div class="row">
		<?php foreach ( $tables as $table_value ) : ?>
            <div class="<?php echo esc_attr( $grid ); ?> col-md-6">
                <div class="cnv-pricing-table-simple elementor-repeater-item-<?php echo $table_value['_id'] ?> <?php if ( $table_value['featured_table'] == 'yes' ) {
					echo 'featured active';
				} ?> <?php echo esc_attr( $settings['layout'] ); ?>">

                    <div class="pricing__header">
                        <div class="pricing__title">
							<?php if ( ! empty( $table_value['table_title'] ) ) : ?>
                                <h5><?php echo esc_html( $table_value['table_title'] ); ?></h5>
							<?php endif; ?>
                        </div>
                    </div><!-- .pricing-header -->

                    <div class="pricing__price">
						<?php if ( ! empty( $table_value['table_price'] ) ) : ?>
                            <h2 class="price">
								<?php echo esc_html( $table_value['table_price'] ); ?>
                            </h2>
						<?php endif; ?>

						<?php if ( ! empty( $table_value['table_period'] )) : ?>
							<span><?php echo esc_html( $table_value['table_period'] ); ?></span>
						<?php endif; ?>
                    </div>

	                <?php
	                $target   = $table_value['btn_url']['is_external'] ? ' target="_blank"' : '';
	                $nofollow = $table_value['btn_url']['nofollow'] ? ' rel="nofollow"' : '';

	                if ( ! empty( $table_value['btn_url']['url'] ) ) : ?>
						<div class="pricing__btn-wrapper">
							<a href="<?php echo esc_url( $table_value['btn_url']['url'] ); ?>" <?php echo $target . ' ' . $nofollow; ?> class="cnv-btn btn-outline btn-round"><?php echo esc_html( $table_value['button_text'] ); ?></a>
						</div><!-- .pricing-footer -->
	                <?php endif; ?>

					<?php if ( ! empty( $table_value['pricing_feature'] ) ) : ?>
                        <ul class="pricing__feature">
							<?php
							$table_contents = preg_split( '/\r\n|[\r\n]/', $table_value['pricing_feature'] );
							if ( is_array( $table_contents ) && ! empty( $table_contents ) ) :
								foreach ( $table_contents as $tab_text ) : ?>
                                    <li> <?php echo $tab_text; ?></li>
								<?php endforeach;
							endif;
							?>
                        </ul>
					<?php endif; ?>
                </div><!-- .single_plan -->
            </div>
		<?php endforeach; ?>
    </div>
</div>
<!-- /.pricing_wrapper -->
