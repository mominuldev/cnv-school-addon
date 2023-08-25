<div class="col-md-6 col-sm-6 col-lg-<?php echo esc_attr($settings['column']); ?>">
	<div class="cnv-post__item wow fadeInUp" data-wow-delay="<?php echo $ant;?>s">
		<?php if ( has_post_thumbnail() ): ?>
			<div class="cnv-post__feature-image">
				<a href="<?php echo the_permalink(); ?>">
					<?php the_post_thumbnail( 'cnv_blog_grid_410x290', array( 'class' => 'img-fluid' ) ) ?>
				</a>

				<?php
				$category_list = get_the_category_list();

				// Get BG color
				$colors = $color_list[ $color_item_count ];
				$color  = explode( ':', $colors );

				?>
				<div class="cnv-post__category">
					<?php
					$terms = get_the_terms( get_the_ID(), 'category' );
					if ( $terms && ! is_wp_error( $terms ) ) :
						$cat_temp = '';
						foreach ( $terms as $term ) {
							$cat_temp .= '<a href="' . get_category_link( $term->term_id ) . '" style="background: ' . $color[0] . '"  class="category" rel="category">' . esc_html( $term->name ) . '</a>';
						}
					endif;

					echo $cat_temp;

					?>
				</div>

			</div>
		<?php endif; ?>
		<div class="cnv-post__blog-content">
			<?php if ( 'yes' == $settings['meta_show'] ) : ?>
				<div class="cnv-post__date-meta">
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M16.5 9C16.5 13.14 13.14 16.5 9 16.5C4.86 16.5 1.5 13.14 1.5 9C1.5 4.86 4.86 1.5 9 1.5C13.14 1.5 16.5 4.86 16.5 9Z"
							  stroke="#141416" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M11.7827 11.3843L9.45766 9.99684C9.05266 9.75684 8.72266 9.17934 8.72266 8.70684V5.63184" stroke="#141416"
							  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<?php CNV_Theme_Helper::cnv_posted_on(); ?>
				</div>
			<?php endif; ?>

			<div class="cnv-post__entry-header">
				<h3 class="cnv-post__entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>

				<p class="cnv-post__entry-content">
					<?php echo CNV_Theme_Helper::cnv_excerpt( $settings['content_length'] ); ?>
				</p>
			</div>
		</div>

		<div class="cnv-post__footer">
			<div class="cnv-post__author-avatar">
				<?php CNV_Theme_Helper::cnv_posted_author_avatar(); ?>
			</div>

			<div class="cnv-post__meta-right">
				<div class="cnv-post__comments">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M14.4276 7.76611C14.4302 8.74114 14.2029 9.70299 13.7643 10.5733C13.2443 11.6162 12.4449 12.4934 11.4557 13.1066C10.4664 13.7199 9.3263 14.0449 8.16314 14.0454C7.19039 14.0479 6.2308 13.8201 5.36253 13.3805L1.16162 14.7841L2.56192 10.5733C2.12336 9.70299 1.89609 8.74114 1.89862 7.76611C1.89907 6.6002 2.22335 5.45744 2.83514 4.46583C3.44694 3.47423 4.32207 2.67293 5.36253 2.1517C6.2308 1.7121 7.19039 1.4843 8.16314 1.48684H8.53164C10.0678 1.57179 11.5187 2.2217 12.6066 3.31215C13.6945 4.4026 14.3429 5.85695 14.4276 7.39674V7.76611Z"
							stroke="#7A7E83" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>

					<?php CNV_Theme_Helper::cnv_entry_comments( get_the_ID() ); ?>
				</div>

				<div class="cnv-post__views">
					<svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M12.345 8.13958C12.345 9.73043 11.0625 11.016 9.47535 11.016C7.88823 11.016 6.60571 9.73043 6.60571 8.13958C6.60571 6.54872 7.88823 5.26318 9.47535 5.26318C11.0625 5.26318 12.345 6.54872 12.345 8.13958Z"
							stroke="#7A7E83" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path
							d="M9.47597 14.7841C12.3055 14.7841 14.9427 13.1129 16.7783 10.2204C17.4997 9.08757 17.4997 7.18336 16.7783 6.05048C14.9427 3.15802 12.3055 1.48682 9.47597 1.48682C6.64641 1.48682 4.00923 3.15802 2.17363 6.05048C1.45221 7.18336 1.45221 9.08757 2.17363 10.2204C4.00923 13.1129 6.64641 14.7841 9.47597 14.7841Z"
							stroke="#7A7E83" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>

					<?php echo CNV_Theme_Helper::post_view_count( get_the_ID() ); ?>
				</div>
			</div>
		</div>
	</div>
</div>