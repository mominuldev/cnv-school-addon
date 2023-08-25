<div class="cnv__post-list cnv__post-list--<?php echo esc_attr($settings['layout']); ?>">

	<?php if (has_post_thumbnail()): ?>
		<div class="cnv__feature-image">
			<?php the_post_thumbnail('cnv-blog-list_300x185', array('class' => 'img-fluid')) ?>
		</div>
	<?php endif; ?>

	<div class="cnv-post__date-meta">
		<?php CNV_Theme_Helper::cnv_posted_date(); ?>
	</div>

	<div class="cnv__blog-content">
		<div class="cnv__post-list-title-wrapper">
			<h3 class="cnv__entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</div>

		<p class="cnv-post__entry-content">
			<?php echo CNV_Theme_Helper::cnv_excerpt($settings['content_length']); ?>
		</p>
	</div>
</div>



