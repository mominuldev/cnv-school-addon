<div class="cnv__post-list cnv__post-list--<?php echo esc_attr($settings['layout']); ?>">
	<?php if ( has_post_thumbnail() ): ?>
		<div class="cnv__feature-image">
			<?php the_post_thumbnail( 'cnv_blog_grid_400x182', array( 'class' => 'img-fluid' ) ) ?>
			<div class="cnv__post-list-title-wrapper">
				<?php
				$icon = '
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
						<path d="M18.3307 9.99984C18.3307 5.39984 14.5974 1.6665 9.9974 1.6665C5.3974 1.6665 1.66406 5.39984 1.66406 9.99984C1.66406 14.5998 5.3974 18.3332 9.9974 18.3332" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M6.66667 2.5H7.5C5.875 7.36667 5.875 12.6333 7.5 17.5H6.66667" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M12.4961 2.5C13.3044 4.93333 13.7128 7.46667 13.7128 10" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M2.49609 13.3333V12.5C4.92943 13.3083 7.46276 13.7167 9.99609 13.7167" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M2.49609 7.5C7.36276 5.875 12.6294 5.875 17.4961 7.5" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M15.1667 17.8334C16.6394 17.8334 17.8333 16.6394 17.8333 15.1667C17.8333 13.6939 16.6394 12.5 15.1667 12.5C13.6939 12.5 12.5 13.6939 12.5 15.1667C12.5 16.6394 13.6939 17.8334 15.1667 17.8334Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M18.3333 18.3333L17.5 17.5" stroke="#202026" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					';
				?>
				<?php if ( 'yes' == $settings['category_show'] ) : ?>
					<div class="cnv__meta-category-wrapper">
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

				<h3 class="cnv__entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
			</div>

		</div>

	<?php endif; ?>
	<div class="cnv__blog-content">
		<p class="cnv-post__entry-content">
			<?php echo CNV_Theme_Helper::cnv_excerpt( $settings['content_length'] ); ?>
		</p>

		<?php if ( 'yes' == $settings['meta_show'] ) : ?>
			<div class="cnv__post-list--meta">
				<div class="cnv-post__author-meta">
					<svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M12.028 10.3634C11.7052 10.0712 11.3453 9.82991 10.96 9.64411M12.028 10.3634L11.9274 10.4746M12.028 10.3634C12.028 10.3634 12.028 10.3634 12.028 10.3634L11.9274 10.4746M12.028 10.3634C12.6013 10.8822 13.0266 11.5323 13.272 12.2506M10.96 9.64411L11.9274 10.4746M10.96 9.64411C11.7114 9.05915 12.1962 8.14602 12.1962 7.12137C12.1962 5.35891 10.7624 3.92532 9 3.92532C7.23755 3.92532 5.80395 5.35891 5.80395 7.12137C5.80395 8.14602 6.28871 9.05915 7.04 9.64411C6.65483 9.82988 6.29486 10.071 5.97196 10.3633C5.39876 10.8821 4.97343 11.5322 4.72796 12.2505C3.64218 11.1592 2.97031 9.65669 2.97031 8C2.97031 4.67534 5.67534 1.97031 9 1.97031C12.3247 1.97031 15.0297 4.67534 15.0297 8C15.0297 9.65679 14.3578 11.1593 13.272 12.2506M10.96 9.64411L13.272 12.2506M11.9274 10.4746C12.4999 10.9927 12.9195 11.6459 13.1528 12.3672C13.1931 12.3289 13.2328 12.29 13.272 12.2506M13.272 12.2506C13.2902 12.3036 13.3073 12.3571 13.3235 12.4108L13.272 12.2506ZM14.0558 2.94418C12.7056 1.59394 10.9095 0.85 9 0.85C7.09037 0.85 5.29442 1.59394 3.94418 2.94418C2.59394 4.29442 1.85 6.09037 1.85 8C1.85 9.90952 2.59394 11.7056 3.94418 13.0558C5.29442 14.4061 7.09037 15.15 9 15.15C10.9095 15.15 12.7056 14.4061 14.0558 13.0558C15.4061 11.7056 16.15 9.90952 16.15 8C16.15 6.09037 15.4061 4.29442 14.0558 2.94418ZM9 14.0297C7.77189 14.0297 6.62878 13.6604 5.67493 13.0274C5.99256 11.4617 7.36872 10.3174 9 10.3174C10.6314 10.3174 12.0074 11.4617 12.3251 13.0274C11.3712 13.6604 10.2281 14.0297 9 14.0297ZM6.92426 7.12137C6.92426 5.97684 7.85557 5.04563 9 5.04563C10.1444 5.04563 11.0757 5.97695 11.0757 7.12137C11.0757 8.26579 10.1444 9.19711 9 9.19711C7.85558 9.19711 6.92426 8.26579 6.92426 7.12137Z"
							fill="#141416" stroke="#141416" stroke-width="0.3"/>
					</svg>

					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
						<?php the_author(); ?>
					</a>
				</div>

				<div class="cnv-post__date-meta">
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M16.5 9C16.5 13.14 13.14 16.5 9 16.5C4.86 16.5 1.5 13.14 1.5 9C1.5 4.86 4.86 1.5 9 1.5C13.14 1.5 16.5 4.86 16.5 9Z"
							  stroke="#141416" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M11.7827 11.3843L9.45766 9.99684C9.05266 9.75684 8.72266 9.17934 8.72266 8.70684V5.63184" stroke="#141416"
							  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<?php CNV_Theme_Helper::cnv_posted_on(); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>