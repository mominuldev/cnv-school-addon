<div class="pricing">

	<div class="animated-shape has-animation">
		<div class="translate-right-75 opacity-animation transition-200 transition-delay-1000">
			<img src="<?php echo CNV_PLUGIN_URL . 'elementor/assets/images/element7.png' ?>"
					alt="<?php echo esc_attr( $settings['monthly_title'] ); ?>">
		</div>
	</div>

	<div class="container">
		<div class="tab-content priceing-tab">

			<?php if ( 'yes' === $settings['show_tab'] ) { ?>
				<label class="pricing-switch-wrap">
                    <span class="switch-icon">
                        <span class="beforeinput year-switch">
                            <?php echo esc_html( $settings['monthly_title'] ) ?>
                        </span>
                        <input type="checkbox" class="d-none" id="js-contcheckbox">

                        <span class="afterinput year-switch active">
                             <?php echo esc_html( $settings['anual_title'] ) ?>
                        </span>
                    </span>
				</label>

			<?php } ?>

			<div class="row advanced-pricing-table text-center">
				<?php if ( $tables ) {
					foreach ( $tables as $key => $table ) {
						$purchase_btn        = $table['purchase_btn_url'];
						$purchase_btn_target = $purchase_btn['is_external'] ? 'target="_blank"' : '';

						$purchase_btn_annual        = $table['purchase_btn_url_annual'];
						$purchase_btn_target_annual = $purchase_btn['is_external'] ? 'target="_blank"' : '';
						?>
						<div class="col-lg-4 col-md-6 wow pixFadeUp" data-wow-dealy="0.4s">
							<div class="pricing-table elementor-repeater-item-<?php echo $table['_id']; ?> <?php echo $table['popular'] == 'yes' ? 'featured' : ''; ?>"
									id="<?php echo esc_attr( $id_int . '-' . $key ); ?>">

								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
										width="446px" height="440px">
									<path fill-rule="evenodd" fill="rgb(240, 246, 255)"
											d="M73.406,-0.004 C29.231,-0.004 -1.953,46.535 8.762,102.937 C14.223,131.675 18.736,140.191 23.879,156.353 C44.367,220.757 25.884,221.435 7.098,269.548 C-5.957,302.983 0.342,339.509 14.824,360.151 C26.337,376.561 42.308,381.916 61.444,381.916 C64.770,381.916 68.191,381.754 71.701,381.461 C85.459,380.310 95.175,378.680 103.744,378.680 C113.267,378.680 121.374,380.692 132.053,387.613 C159.288,405.264 172.968,432.202 207.921,438.445 C213.864,439.506 219.585,439.998 225.083,439.998 C277.736,439.998 310.564,395.031 335.473,375.630 C345.656,367.699 354.972,365.125 364.024,365.125 C380.022,365.125 395.202,373.158 412.938,373.847 C413.420,373.866 413.901,373.876 414.375,373.876 C442.368,373.876 456.691,341.734 436.672,314.624 C414.317,284.348 387.727,270.894 402.986,233.329 C407.130,223.129 418.869,226.035 427.152,208.548 C439.529,182.421 428.197,125.979 391.683,125.973 C390.948,125.973 390.209,125.996 389.454,126.042 C380.724,126.577 371.117,129.061 361.396,129.061 C350.395,129.061 339.248,125.882 329.054,113.099 C302.303,79.551 288.893,41.955 259.153,41.954 C257.650,41.954 256.107,42.050 254.517,42.247 C234.636,44.713 219.407,52.582 200.312,52.582 C190.344,52.582 179.323,50.438 166.037,44.263 C153.839,38.593 146.094,32.616 115.802,13.497 C101.023,4.169 86.632,-0.004 73.406,-0.004 "/>
								</svg>

								<?php if ( ! empty( $table['feature_image']['url'] ) ) : ?>
									<div class="table-feature-image">
										<img src="<?php echo esc_url( $table['feature_image']['url'] ); ?>" alt="">
									</div>
								<?php endif; ?>

								<div class="price-content-wrapper">
									<div class="pricing-header pricing-amount">
										<h2 class="price-title"><?php echo esc_html( $table['title'] ) ?></h2>
										<div class="yearly-price">
											<h3 class="price">
												<?php echo esc_html( $table['currency'] ) ?><?php echo esc_html( $table['annual_price'] ) ?>
											</h3>
										</div>
										<!-- /.annual_price -->

										<div class="monthly-price">
											<h3 class="price">
												<?php echo esc_html( $table['currency'] ) ?><?php echo esc_html( $table['monthly_price'] ) ?><span class="period"><?php echo $table['period']; ?></span>
											</h3>
										</div>
										<!-- /.monthly_price -->
									</div>
									<ul class="price-feture">
										<?php
										$table_contents = preg_split( '/\r\n|[\r\n]/', $table['list_items'] );
										if ( is_array( $table_contents ) && ! empty( $table_contents ) ) :
											foreach ( $table_contents as $tab_text ) :
												echo '<li>' . $tab_text . '</li>';
											endforeach;
										endif;
										?>
									</ul>

									<div class="action text-center">
										<div class="btn-month monthly-price">
											<?php if ( ! empty( $table['purchase_btn_label'] ) ) : ?>
												<a href="<?php echo esc_url( $purchase_btn['url'] ); ?>"
														class="cnv-btn <?php echo $table['popular'] !== 'yes' ? 'btn-outline' : ''; ?>"
													<?php echo $purchase_btn_target; ?>>
													<?php echo esc_html( $table['purchase_btn_label'] ) ?>
												</a>
											<?php endif; ?>
										</div>
										<div class="btn-annual yearly-price">
											<?php if ( ! empty( $table['purchase_btn_label_annual'] ) ) : ?>
												<a href="<?php echo esc_url( $purchase_btn_annual['url'] ); ?>"
														class="cnv-btn <?php echo $table['popular'] !== 'yes' ? 'btn-outline' : ''; ?>"
													<?php echo $purchase_btn_target_annual; ?>>
													<?php echo esc_html( $table['purchase_btn_label_annual'] ) ?>
												</a>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php }
				} ?>
			</div>

		</div>
	</div>
	<!-- /.container -->

	<div class="section-circle-shape shape-right">
		<span class="circle-top"></span>
		<span class="circle-bottom"></span>
	</div>
	<!-- /.section-circle-shape -->
</div>
<!-- /.pricing -->