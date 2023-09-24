<div class="notice-list">
    <?php
        $notice_file = get_post_meta( get_the_ID(), 'notice_options', true );
    ?>

    <h3 class="notice-list__title">
        <i class="fa-solid fa-angles-right"></i>
        <?php the_title(); ?>
    </h3>

    <div class="notice-list__file">
        <a href="<?php  echo esc_url( $notice_file['notice_file']['url'] ); ?>" target="_blank" class="notice-list__download-btn">
            <i class="fa-solid fa-download"></i>
            <span class="notice-list__text">ডাউনলোড</span>
        </a>
    </div>
</div>