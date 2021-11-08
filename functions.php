<?php /**
 * The default template for displaying content
 *
 * @author      OMA Themes
 * @link        http://omathemes.store
 * @copyright   Copyright (c) 2021 OMA Themes
 */ ?>

<?php 
#Thumbnails
add_theme_support( 'post-thumbnails' );

require get_template_directory().'/inc/elementor-new-section.php';
require get_template_directory().'/inc/elementor-query-template.php';
require get_template_directory().'/inc/elementor-widgets/init-widgets.php';


//======================================================================
// Style and Scripts 
//======================================================================

#CSS
function all_in_theme_css() {
	wp_enqueue_style( 'ui-kit-css', get_template_directory_uri(). '/assets/css/uikit.min.css', array(), null );
	wp_enqueue_style( 'all-in-css', get_template_directory_uri(). '/inc/css/theme-style.css', array(), null );
}

#JS
function all_in_theme_scripts() {
    wp_enqueue_script( 'ui-kit', get_theme_file_uri( '/assets/js/uikit.min.js' ), [], null, true );
	wp_enqueue_script( 'ui-kit-icons', get_theme_file_uri( '/assets/js/uikit-icons.js' ), [], null, true );
	wp_enqueue_script( 'ui-kit-new-icons', get_theme_file_uri( '/assets/js/uikit-new-icons.js' ), [], null, true );
	wp_enqueue_script( 'main-carousel', get_theme_file_uri( '/inc/js/carousel.js' ), [], null, true );
	wp_enqueue_script( 'main-carousel', get_theme_file_uri( '/inc/js/uikit-new-icons.js' ), [], null, true );
	wp_enqueue_script( 'card-behavior', get_theme_file_uri( '/inc/js/card-inner-wrap.js') , [], NULL, true );
}

add_action( 'wp_enqueue_scripts', 'all_in_theme_css' );
add_action( 'wp_enqueue_scripts', 'all_in_theme_scripts' );






