<div class="col-md-6 col-sm-6 col-lg-<?php echo esc_attr( $settings['column'] ); ?>">
    <div class="cnv-post wow fadeInUp" data-wow-delay="<?php echo $ant; ?>s">
		<?php if ( has_post_thumbnail() ): ?>
            <div class="cnv-post__feature-image">
                <a href="<?php echo the_permalink(); ?>">
					<?php the_post_thumbnail( 'cnv_blog_grid_382x278', array( 'class' => 'img-fluid' ) ) ?>
                </a>
            </div>
		<?php endif; ?>
        <div class="cnv-post__blog-content">
			<?php if ( 'yes' == $settings['meta_show'] ) : ?>
                <ul class="cnv-post__meta">
                    <li class="cnv-post__author-avatar">
						<?php CNV_Theme_Helper::cnv_posted_author_avatar(); ?>
                    </li>
                    <li class="cnv-post__author-name">
                        <i class="fa-regular fa-clock"></i>
						<?php CNV_Theme_Helper::cnv_posted_on(); ?>
                    </li>
                </ul>
			<?php endif; ?>

            <h3 class="cnv-post__entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php if ( ! empty( $settings['read_more_text'] ) ) : ?>
                <a href="<?php echo get_the_permalink(); ?>" class="cnv-post__read-more"><?php echo esc_html( $settings['read_more_text'] ); ?> <i class="fa-solid fa-arrow-right"></i></a>
			<?php endif; ?>
        </div>

    </div>
</div>