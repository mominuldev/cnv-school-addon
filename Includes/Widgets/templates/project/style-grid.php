<?php

use CodeNestVentures\SchoolAddon\ImageSize;

if ( ! isset( $settings ) ) {
	$settings = array();
}

$ant = 0.5;

while ( $cnv_query->have_posts() ) :
	$cnv_query->the_post();
	$classes      = array( "cnv-project grid-item" );
	$reveal       = $settings['reveal_animation'];
	$grid_classes = '';

	if ( 'yes' == $reveal ) {
		$grid_classes .= 'overlay_effect ';
	}

	if ( 'yes' == $settings['tilt-effect'] ) {
		$grid_classes .= 'tilt-effect ';
	}

	if ( ! empty( $settings['grid_animation'] ) ) {
		$grid_classes .= $settings['grid_animation'] . ' wow ';
	}
	if ( ! empty( $settings['overlay_style'] ) ) {
		$grid_classes .= $settings['overlay_style'];
	}

	?>
	<figure <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="cnv-project__wrapper cnv-box <?php echo $grid_classes; ?>" data-wow-delay="<?php echo esc_attr( $ant ); ?>s">
			<div class="cnv-project__thumbnail-wrapper cnv-image">
				<div class="cnv-project__thumbnail">
					<a href="<?php echo the_permalink(); ?>" class="post-permalink link-secret">
						<?php if ( has_post_thumbnail() ) { ?>
							<?php $size = ImageSize::elementor_parse_image_size( $settings, '480x480' ); ?>
							<?php ImageSize::the_post_thumbnail( array( 'size' => $size ) ); ?>
						<?php } ?>
						<?php if ( 'cnv-project--overlay-one' == $settings['overlay_style'] ) : ?>
							<span class="cnv-project__permalink"><?php echo 'Case <br> Studies' ?></span>
						<?php endif; ?>
					</a>
				</div>
			</div>

			<?php if ( ! empty( $settings['overlay_style'] ) ) : ?>
				<div class="cnv-project__info">

					<div class="cnv-project__cat" data-wow-delay="<?php echo esc_attr( $ant ); ?>s">
						<?php
						$terms = get_the_terms( get_the_ID(), 'project_category' );

						if ( $terms && ! is_wp_error( $terms ) ) :
							foreach ( $terms as $term ) { ?>
								<span class="cnv-project__cat-item"><?php echo $term->name; ?></span>
							<?php } ?>
						<?php endif; ?>
					</div>

					<h3 class="cnv-project__title" data-wow-delay="<?php echo esc_attr( $ant ); ?>s" data-hover="<?php the_title(); ?>">
						<a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>

				</div>
			<?php endif; ?>
		</div>
	</figure>

	<?php
	$ant = $ant + 0.2;
endwhile;
?>