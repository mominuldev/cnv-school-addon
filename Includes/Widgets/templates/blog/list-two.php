<div class="cnv__post-list cnv__post-list--<?php echo esc_attr($settings['layout']); ?>">
	<div class="container">
		<div class="cnv__post-list__inner">
			<div class="cnv-post__date-meta">
				<?php CNV_Theme_Helper::cnv_posted_date(); ?>
			</div>

			<div class="cnv__image-contentwrapper">
				<?php if ( has_post_thumbnail() ): ?>
					<div class="cnv__feature-image">
						<?php the_post_thumbnail( 'cnv-blog-list_300x185', array( 'class' => 'img-fluid' ) ) ?>
					</div>
				<?php endif; ?>

				<div class="cnv__blog-content">
					<div class="cnv__post-list-title-wrapper">
						<h3 class="cnv__entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</div>

					<p class="cnv-post__entry-content">
						<?php echo CNV_Theme_Helper::cnv_excerpt( $settings['content_length'] ); ?>
					</p>
				</div>
			</div>

			<?php if ( 'yes' == $settings['category_show'] ) : ?>
				<div class="cnv__meta-category-wrapper">
					<?php
					$icon = '
				<svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M22.9301 6.76001L19.5601 20.29C19.3201 21.3 18.4201 22 17.3801 22H4.24013C2.73013 22 1.65015 20.5199 2.10015 19.0699L6.31014 5.55005C6.60014 4.61005 7.47015 3.95996 8.45015 3.95996H20.7501C21.7001 3.95996 22.4901 4.53997 22.8201 5.33997C23.0101 5.76997 23.0501 6.26001 22.9301 6.76001Z" stroke="#00D565" stroke-width="2" stroke-miterlimit="10"/>
					<path d="M17 22H21.78C23.07 22 24.08 20.91 23.99 19.62L23 6" stroke="#00D565" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M10.6797 6.38L11.7197 2.06006" stroke="#00D565" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M17.3799 6.38977L18.3199 2.0498" stroke="#00D565" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M8.7002 12H16.7002" stroke="#00D565" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M7.7002 16H15.7002" stroke="#00D565" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>';
					?>

					<?php $category_list = get_the_category_list();
					$terms               = get_the_terms( get_the_ID(), 'category' );
					$cat_temp            = '';

					if ( $terms && ! is_wp_error( $terms ) ) :
						foreach ( $terms as $term ) {
							$cat_temp .= '<a href="' . get_category_link( $term->term_id ) . '" class="cnv__blog-meta-category" rel="category tag">'. $icon . esc_html( $term->name ) . '</a>';
						}
					endif;

					echo $cat_temp; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>



