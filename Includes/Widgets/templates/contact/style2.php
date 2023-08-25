
<div class="form-wrapper">
    <div class="form-contents">
        <?php if ( ! empty( $heading ) ) : ?>
    <h2 class="form-title"><?php echo $heading; ?></h2>
    <?php endif;

    if ( ! empty( $description ) ) : ?>
        <p class="description"><?php echo $description; ?></p>
    <?php endif; ?>            

    </div>
    <!-- /.form-contents -->

    <?php echo $shortcode; ?>

</div>
<!-- /.form-wrapper -->



<?php if( 'yes' === $settings['show_shape'] ) : ?>
    <?php if ( ! empty( $settings[ 'shape_three' ][ 'url' ] )) :?>
        <div class="shape_left">
            <img src="<?php echo esc_url( $settings[ 'shape_three' ][ 'url' ] ) ?>" alt="#"  data-parallax='{"x": 0, "y": -150, "rotateZ": 0}'>
        </div>
    <?php endif; ?>
<?php endif; ?>