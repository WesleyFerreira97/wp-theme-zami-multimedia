<?php 

function add_elementor_widget_categories( $all_in_category ) {

    $all_in_category->add_category( 'first-category',
        [
        'title' => __( 'First Category', 'plugin-name' ),
        'icon' => 'fa fa-plug',
        ]
    );

    $all_in_category->add_category( 'zami-single-page',
        [
        'title' => __( 'Zami - Single Page Widgets', 'plugin-name' ),
        'icon' => 'fa fa-plug',
        ]
    );

}

add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );