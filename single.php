<?php /**
 * The default template for displaying content
 *
 * @author      OMA Themes
 * @link        http://omathemes.store
 * @copyright   Copyright (c) 2021 OMA Themes
 */ ?>

<?php get_header(); ?>

<?php 

if(  \Elementor\Plugin::$instance->preview->is_preview_mode()  ) {

	if ( have_posts() ) {
		while ( have_posts() ) {
            the_post();
            the_content();
		}
    }
} 

if ( ! \Elementor\Plugin::$instance->preview->is_preview_mode()) {
    
    $single_page = new All_in_elementor_query_template('single_page');

} ?>

<?php get_footer(); ?>

