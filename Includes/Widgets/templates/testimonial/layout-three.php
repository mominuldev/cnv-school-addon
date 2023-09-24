<div class="cnv-testimonial-wrapper">

	<div class="testimoinal-slider-nav style--three">
		<div <?php $this->print_render_attribute_string('wrapper-nav'); ?>>
			<div class="swiper-wrapper">
				<?php if (is_array($testimonials)) :
					foreach ($testimonials as $testimonial) : ?>
						<?php
						if ($testimonial['image'] != '') {
							$avatar = $testimonial['image']['url'];
						}
						?>
						<div class="swiper-slide">
							<div <?php $this->print_render_attribute_string('testimonial'); ?>>
								<?php if (!empty($avatar)): ?>
									<div class="cnv-testimonial__avatar">
										<img class="author-image" src="<?php echo esc_url($avatar) ?>"
											 alt="<?php echo esc_attr($testimonial['name']) ?>">
									</div>
								<?php endif; ?>
							</div>
						</div>
						<!-- /.swiper-slide -->
					<?php
					endforeach;
				endif;
				?>
			</div>
		</div>
		<!-- /.swiper-container testimonial-thumb -->
	</div>

	<div <?php $this->print_render_attribute_string('wrapper'); ?>>
		<?php if ($settings['navigation'] == 'yes') : ?>
			<div class="testimonial-prev">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
					<path
						d="M0.46967 5.46967C0.176777 5.76256 0.176777 6.23744 0.46967 6.53033L5.24264 11.3033C5.53553 11.5962 6.01041 11.5962 6.3033 11.3033C6.59619 11.0104 6.59619 10.5355 6.3033 10.2426L2.06066 6L6.3033 1.75736C6.59619 1.46447 6.59619 0.989593 6.3033 0.696699C6.01041 0.403806 5.53553 0.403806 5.24264 0.696699L0.46967 5.46967ZM1 6.75H18V5.25H1V6.75Z"
						fill="black"></path>
				</svg>
			</div>
		<?php endif; ?>

		<div class="swiper-wrapper">
			<?php if (is_array($testimonials)) :
				foreach ($testimonials as $testimonial) : ?>

					<div class="swiper-slide">
						<div <?php $this->print_render_attribute_string('testimonial'); ?>>

							<div class="cnv-testimonial__bio">
								<?php if (!empty($testimonial['name'])) : ?>
									<h4 class="cnv-testimonial__name"><?php echo $testimonial['name']; ?></h4>
								<?php endif; ?>

								<?php if (!empty($testimonial['designation'])) : ?>
									<span class="cnv-testimonial__designation"><?php echo $testimonial['designation']; ?></span>
								<?php endif; ?>

							</div>

							<?php if (!empty($testimonial['review_content'])) : ?>
								<p class="cnv-testimonial__review">
									<?php echo $testimonial['review_content']; ?>
								</p>
							<?php endif; ?>

							<?php
							$rating = $testimonial['rating'];
							$this->add_render_attribute('star-rating', 'class', 'cnv-stars');
							if($rating == '10'){
								$this->add_render_attribute('star-rating', 'class', 'cnv-stars--1 cnv-stars--1' );
							} elseif($rating == '15'){
								$this->add_render_attribute('star-rating', 'class', 'cnv-stars--1 cnv-stars--1--half' );
							} elseif($rating == '20'){
								$this->add_render_attribute('star-rating', 'class', 'cnv-stars--2 cnv-stars--2' );
							} elseif ($rating == '25') {
								$this->add_render_attribute('star-rating', 'class', 'cnv-stars--2 cnv-stars--2--half' );
							} elseif ($rating == '30') {
								$this->add_render_attribute('star-rating', 'class', 'cnv-stars--3 cnv-stars--3' );
							} elseif ($rating == '35') {
								$this->add_render_attribute('star-rating', 'class', 'cnv-stars--3 cnv-stars--3--half' );
							} elseif ($rating == '40') {
								$this->add_render_attribute('star-rating', 'class', 'cnv-stars--4 cnv-stars--4' );
							} elseif ($rating == '45') {
								$this->add_render_attribute('star-rating', 'class', 'cnv-stars--4 cnv-stars--4--half' );
							} elseif ($rating == '50') {
								$this->add_render_attribute('star-rating', 'class', 'cnv-stars--5 cnv-stars--5' );
							}

							?>

							<div class="cnv-widget-stars">
								<div <?php echo $this->get_render_attribute_string('star-rating'); ?> >
									<svg role="img" aria-labelledby="starRating" viewBox="0 0 251 46" xmlns="http://www.w3.org/2000/svg">
										<title id="starRating" lang="en">
											4.5 out of five star rating on
											Trustpilot
										</title>
										<g class="cnv-star">
											<path class="cnv-star__canvas" fill="#dcdce6" d="M0 46.330002h46.375586V0H0z"></path>
											<path class="cnv-star__shape" d="M39.533936 19.711433L13.230239 38.80065l3.838216-11.797827L7.02115 19.711433h12.418975l3.837417-11.798624 3.837418 11.798624h12.418975zM23.2785 31.510075l7.183595-1.509576 2.862114 8.800152L23.2785 31.510075z" fill="#FFF"></path>
										</g>
										<g class="cnv-star">
											<path class="cnv-star__canvas" fill="#dcdce6" d="M51.24816 46.330002h46.375587V0H51.248161z"></path>
											<path class="cnv-star__canvas--half" fill="#dcdce6" d="M51.24816 46.330002h23.187793V0H51.248161z"></path>
											<path class="cnv-star__shape" d="M74.990978 31.32991L81.150908 30 84 39l-9.660206-7.202786L64.30279 39l3.895636-11.840666L58 19.841466h12.605577L74.499595 8l3.895637 11.841466H91L74.990978 31.329909z" fill="#FFF"></path>
										</g>
										<g class="cnv-star">
											<path class="cnv-star__canvas" fill="#dcdce6" d="M102.532209 46.330002h46.375586V0h-46.375586z"></path>
											<path class="cnv-star__canvas--half" fill="#dcdce6" d="M102.532209 46.330002h23.187793V0h-23.187793z"></path>
											<path class="cnv-star__shape" d="M142.066994 19.711433L115.763298 38.80065l3.838215-11.797827-10.047304-7.291391h12.418975l3.837418-11.798624 3.837417 11.798624h12.418975zM125.81156 31.510075l7.183595-1.509576 2.862113 8.800152-10.045708-7.290576z"  fill="#FFF"></path>
										</g>
										<g class="cnv-star">
											<path class="cnv-star__canvas" fill="#dcdce6" d="M153.815458 46.330002h46.375586V0h-46.375586z"></path>
											<path class="cnv-star__canvas--half" fill="#dcdce6" d="M153.815458 46.330002h23.187793V0h-23.187793z"></path>
											<path class="cnv-star__shape" d="M193.348355 19.711433L167.045457 38.80065l3.837417-11.797827-10.047303-7.291391h12.418974l3.837418-11.798624 3.837418 11.798624h12.418974zM177.09292 31.510075l7.183595-1.509576 2.862114 8.800152-10.045709-7.290576z" fill="#FFF"></path>
										</g>
										<g class="cnv-star">
											<path class="cnv-star__canvas" fill="#dcdce6" d="M205.064416 46.330002h46.375587V0h-46.375587z"></path>
											<path class="cnv-star__canvas--half" fill="#dcdce6" d="M205.064416 46.330002h23.187793V0h-23.187793z"></path>
											<path class="cnv-star__shape" d="M244.597022 19.711433l-26.3029 19.089218 3.837419-11.797827-10.047304-7.291391h12.418974l3.837418-11.798624 3.837418 11.798624h12.418975zm-16.255436 11.798642l7.183595-1.509576 2.862114 8.800152-10.045709-7.290576z" fill="#FFF"></path>
										</g>
									</svg>
								</div>
							</div>
						</div>
					</div>
					<!-- /.swiper-slide -->
				<?php
				endforeach;
			endif;
			?>
		</div>

		<?php if ($settings['navigation'] == 'yes') : ?>
			<div class="testimonial-next ">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12" fill="none">
					<path
						d="M17.5303 6.53033C17.8232 6.23744 17.8232 5.76256 17.5303 5.46967L12.7574 0.696699C12.4645 0.403805 11.9896 0.403805 11.6967 0.696699C11.4038 0.989592 11.4038 1.46447 11.6967 1.75736L15.9393 6L11.6967 10.2426C11.4038 10.5355 11.4038 11.0104 11.6967 11.3033C11.9896 11.5962 12.4645 11.5962 12.7574 11.3033L17.5303 6.53033ZM17 5.25L6.55671e-08 5.25L-6.55671e-08 6.75L17 6.75L17 5.25Z"
						fill="black"/>
				</svg>
			</div>
		<?php endif; ?>
	</div>
	<!-- /.cnv-creative-testimonial -->
	<?php if ($settings['pagination'] == 'yes') { ?>
		<div class="testimonial-pagination swiper-pagination"></div>
	<?php } ?>

</div>
<!-- /.cnv-testimonial-wrapper -->
