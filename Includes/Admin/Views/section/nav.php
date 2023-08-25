<div id="navbar" class="navbar">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="cnv-admin-nav">
                    <ul>
                        <?php
                            $admin_nav_first_item_class = ( !isset( $_GET['action'] ) && $_GET['page'] == 'cnv-school-addon' ) ? 'active' : '';

                            $admin_nav_items = array(
                                'default' => array(
                                    'title' => 'CNV',
                                    'url'   => admin_url( 'admin.php?page=cnv_core' ),
                                    'target' => '_self',
                                ),
                                'banner' => array(
                                    'title' => 'Documentation',
                                    'url'   => 'https://themeboxr.com/product/wpcnv-university-alumni-wordpress-theme/',
                                    'target' => '_blank',
                                ),
                                'section_title' => array(
                                    'title' => 'Support',
                                    'url'   => 'https://themeboxr.com/contact-us/',
                                    'target' => '_blank',
                                ),
                            );

                            foreach ( $admin_nav_items as $key => $item ) {

                                $active_class = '';
                                if( !isset( $_GET['action'] ) ) {
                                    $active_class = ( 'default' == $key ) ? 'active' : '';
                                } else {
                                    $active_class = ( isset( $_GET['action'] ) && $_GET['action'] == $key ) ? 'active' : '';
                                }

                                echo sprintf(
                                    '<li><a href="%s" target="%s" class="%s %s">%s</a></li>',
                                    $item['url'],
	                                $item['target'],
                                    $key,
                                    $active_class,
                                    $item['title']
                                );
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>