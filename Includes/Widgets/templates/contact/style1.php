<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="form-contents">
                <?php if ( ! empty( $heading ) ) : ?>
            <h2 class="form-title"><?php echo $heading; ?></h2>
            <?php endif;

            if ( ! empty( $description ) ) : ?>
                <p class="description"><?php echo $description; ?></p>
            <?php endif; ?>
            
            <ul class="infos">
                <?php foreach( $infos as $info ) { ?>
                    <li>
                        <?php if ( ! empty($info['info_icon']) ) : ?>
                            <i class="<?php echo esc_attr( $info['info_icon'] ); ?>"></i>
                        <?php endif; ?>
                        
                        <?php if ( ! empty( $info['info_title'] )) : ?>
                            <p>
                                <?php echo esc_attr( $info['info_title'] ); ?>
                            </p>
                        <?php endif; ?>
                    </li>
                <?php } ?>
            </ul>
            </div>
            <!-- /.form-contents -->
        </div>
        <!-- /.col-md-5 -->

        <div class="col-md-7">
        <?php echo $shortcode; ?>
        </div>
        <!-- /.col-md-7 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->


<?php if( 'yes' === $settings['show_shape'] ) : ?>
    <?php if ( ! empty( $settings[ 'shape_one' ][ 'url' ] )) :?>
        <div class="shape_left">
            <img src="<?php echo esc_url( $settings[ 'shape_one' ][ 'url' ] ) ?>" alt="#"  data-parallax='{"x": 0, "y": -150, "rotateZ": 180}'>
        </div>
    <?php endif; ?>

    <?php if ( ! empty( $settings[ 'shape_two' ][ 'url' ] )) :?>
        <div class="shape_right wow fadeInRight">
            <img src="<?php echo esc_url( $settings[ 'shape_two' ][ 'url' ] ) ?>" alt="#" data-parallax='{"x": 0, "y": -150, "rotateZ": 0}'>
        </div>
    <?php endif; ?>
<?php endif; ?>