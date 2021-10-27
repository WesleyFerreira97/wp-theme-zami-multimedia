<?php /**
 * The default template for displaying content
 *
 * @author      OMA Themes
 * @link        http://omathemes.store
 * @copyright   Copyright (c) 2021 OMA Themes
 */

// use Elementor\Widget_Base;
// use Elementor\Controls_Manager;
// use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
// use Elementor\Core\Kits\Documents\Tabs\Global_Typography;


class My_Elementor_Widgets {

	protected static $instance = null;

	public static function get_instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new static;
		}

		return static::$instance;
	}

	protected function __construct() {
		require_once('widget-cards.php');
		require_once('widget-grid-cards-inner-2.php');
		require_once('widget-navbar-vertical.php');
		require_once('widget-gallery-1.php');
		require_once('widget-footer.php');
		require_once('widget-main-content-2.php');
		require_once('widget-section-header.php');
		require_once('widget-base-header.php');
		require_once('widget-single.php');
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}

	public function register_widgets() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Zami_grid_cards_multimedia() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Zami_grid_cards_inner_2() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\All_in_widget_main_content_2() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Zami_navbar_vertical() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Zami_widget_gallery_1() );

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Zami_widget_section_header() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\All_in_widget_footer() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\All_in_widget_base_header() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\All_in_widget_single() );
	}

}

add_action( 'init', 'my_elementor_init' );

function my_elementor_init() {
	My_Elementor_Widgets::get_instance();
}



