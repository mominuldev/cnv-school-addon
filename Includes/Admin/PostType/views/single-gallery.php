<?php
get_header();

// Get project info meta
$project_info = get_post_meta( get_the_ID(), 'project_options', true );

?>

	<div class="single-project-details-banner">
		<div class="container">

			<div class="single-project-details-banner_content text-center">
				<h2 class="single-project-details-banner_title"><?php echo cnv_option('project-page-title'); ?></h2>
			</div>

		</div>
	</div>
	<!-- /.single-project-details-banner -->

	<div class="project-details-wrapper">
		<div class="container">

			<?php if ( has_post_thumbnail() ) { ?>
				<div class="project-details_thumb">
					<?php the_post_thumbnail( 'cnv_project_details_1300x600' ); ?>
				</div>
			<?php } ?>

			<div class="project-details_content">
				<?php
				while ( have_posts() ) :
					the_post();
					?>

					<div class="row">
						<?php if ( ! empty( $project_info['project_info'] ) ) { ?>
							<div class="col-lg-3 col-md-4">
								<div class="project-details_info">
									<ul class="project-single__info">
										<?php
										foreach ( $project_info['project_info'] as $info ) {
											?>
											<li class="project-single__info-item">
												<span class="project-single__info-title"><?php echo esc_html( $info['title'] ); ?></span>
												<?php echo esc_html( $info['info'] ); ?>
											</li>
											<?php
										}
										?>
									</ul>
								</div>
							</div>
						<?php } ?>

						<div class="col-lg-9 col-md-8">
							<div class="project-details_content-inner">
								<h2 class="project-details_title"><?php the_title(); ?></h2>
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
		<!-- /.container -->
	</div>
	<!-- /.project-details-wpapper -->

<?php
get_footer();