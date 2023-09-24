<?php
get_header();

?>

    <div class="cnv-gallery-details">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
					<?php if ( has_post_thumbnail() ) { ?>
                        <div class="cnv-gallery-details_thumb">
							<?php the_post_thumbnail( 'cnv_cnv-gallery_details_1300x600' ); ?>
                        </div>
					<?php } ?>

                    <div class="cnv-gallery-details_content">
						<?php
						while ( have_posts() ) :
							the_post();
							?>

                            <div class="cnv-gallery-details_content-inner">
                                <h2 class="cnv-gallery-details_title"><?php the_title(); ?></h2>
								<?php the_content(); ?>
                            </div>


						<?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.cnv-gallery-details-wpapper -->

<?php
get_footer();