<?php

use CodeNestVentures\SchoolAddon\ImageSize;

if (isset($settings['grid_metro_layout'])) {
	$metro_layout = array();

	foreach ($settings['grid_metro_layout'] as $key => $value) {
		$metro_layout[] = $value['size'];
	}
} else {
	$metro_layout = array(
		'1:1',
		'1:1',
		'1:1',
		'1:1',
		'2:1',
		'1:1',
		'1:2',
		'1:2',
		'1:1',
	);
}

if (count($metro_layout) < 1) {
	return;
}

$metro_layout_count = count($metro_layout);
$metro_item_count = 0;
$count = $cnv_query->post_count;
$ant = 0.5;

while ($cnv_query->have_posts()) : $cnv_query->the_post();
	$animation = $settings['grid_animation'];
	$reveal = $settings['reveal_animation'];
	$classes = array("cnv-project grid-item");


	$size = $metro_layout[$metro_item_count];
	$ratio = explode(':', $size);
	$ratioW = $ratio[0];
	$ratioH = $ratio[1];


	$grid_classes = '';

	if ('yes' == $reveal) {
		$grid_classes .= 'overlay_effect ';
	}

	if ('yes' == $settings['tilt-effect']) {
		$grid_classes .= 'tilt-effect ';
	}

	if (!empty($settings['grid_animation'])) {
		$grid_classes .= $settings['grid_animation'] . ' wow ';
	}
	if (!empty($settings['overlay_style'])) {
		$grid_classes .= $settings['overlay_style'];
	}


	$_image_width = $settings['metro_image_size_width'];
	$_image_height = $_image_width * $settings['metro_image_ratio']['size'];
	if (in_array($ratioW, array('2'))) {
		$_image_width *= 2;
	}

	if (in_array($ratioH, array('1.3', '2'))) {
		$_image_height *= 2;
	} ?>

	<figure <?php post_class(implode(' ', $classes)); ?> data-width="<?php echo esc_attr($ratioW); ?>"
														 data-height="<?php echo esc_attr($ratioH); ?>">
		<div class="cnv-project__wrapper cnv-box <?php echo $grid_classes; ?>" data-wow-delay="<?php echo esc_attr($ant); ?>s">
			<div class="cnv-project__thumbnail-wrapper cnv-image grid-item-height">
				<a href="<?php echo the_permalink(); ?>" class="post-permalink link-secret">
					<div class="cnv-project__thumbnail">
						<?php if (has_post_thumbnail()) { ?>
							<?php ImageSize::the_post_thumbnail(array(
								'size'   => 'custom',
								'width'  => $_image_width,
								'height' => $_image_height,
							)); ?>
						<?php } else {
							Unialumni_Helper::image_placeholder(480, 480);
						} ?>
					</div>
				</a>

				<?php if (!empty($settings['overlay_style'])) : ?>
					<div class="cnv-project__info">
						<h3 class="cnv-project__title" data-hover="<?php the_title(); ?>">
							<a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></span></a>
						</h3>
						<div class="cnv-project__cat">
							<?php
							$terms = get_the_terms(get_the_ID(), 'project_category');

							if ($terms && !is_wp_error($terms)) :
								foreach ($terms as $term) { ?>
									<span class="cnv-project__cat-item"><?php echo $term->name; ?></span>
								<?php } ?>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</figure>
	<?php

	$metro_item_count++;
	if ($metro_item_count == $count || $metro_layout_count == $metro_item_count) {
		$metro_item_count = 0;
	}

	$ant = $ant + 0.2;
	?>
<?php endwhile; ?>