<?php 
/**
 * The default template for displaying content
 *
 * @author      OMA Themes
 * @link        http://omathemes.store
 */ 

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Zami_navbar_vertical extends Widget_Base {

    public function get_name() {
        return 'Zami_navbar_vertical';
    }

    public function get_title() {
        return 'Navbar Vertical';
    }

    public function get_categories() {
        return ['first-category'];
    }

    public function _register_controls() {

		$this->start_controls_section (
            'zami_cards', 
            [
                'label' => __('Zami Cards Multimedia'),
            ],
        );
        
		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'elementor' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
        );

        $this->add_control(
			'image_height_tablet',
			[
				'label' => __( 'Image Height', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'devices' => [ 'tablet' ],
				'default' => [
					'size' => '20',
					'unit' => 'vw',
				],
				'size_units' => [ '%', 'px', 'vw'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1920,
					],
					'vw' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .main-navbar' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'plugin-domain' ),
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'menu_icon',
			[
				'label' => __( 'Menu Icon', 'elementor' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'item_title',
			[
				'label' => __( 'Item Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'plugin-domain' ),
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
			]
		);

		$repeater->add_control(
			'section_id',
			[
				'label' => __( 'Section ID', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'plugin-domain' ),
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
			]
		);
		
		$this->add_control(
			'menu_items',
			[
				'label' => __( 'Repeater List', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => 'Item',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style',
			[
				'label' => __( 'Style', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name' => 'typography_title',
                'label' => __( 'Typography Title', 'plugin-domain' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name' => 'typography_menu',
                'label' => __( 'Typography Menu', 'plugin-domain' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .main-navbar__menu li',
			]
		);
				
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
                'selectors' => [
					'{{WRAPPER}} .main-navbar__title' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		    
		$this->add_control(
			'menu_color',
			[
				'label' => __( 'Menu Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
                'selectors' => [
					'{{WRAPPER}} .main-navbar__menu li' => 'color: {{VALUE}}',
				],
			]
		);
    
        $this->add_control(
			'background_color',
			[
				'label' => __( 'Background 1', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .main-navbar__header' => 'background-color: {{VALUE}};',
				],
			]
        );
        
        $this->add_control(
			'background_color_2',
			[
				'label' => __( 'Background 2', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .main-navbar' => 'background-color: {{VALUE}};',
				],
			]
        );
        
		$this->end_controls_section();

    }
     
    public function render() {

		$settings = $this->get_settings_for_display();
		
        ?>
            <nav class="main-navbar">
                <div class="main-navbar__header">
                    <div class="main-navbar__logo">
                        <img src="<?php echo $settings['image']['url']; ?>">    
                    </div>
                    <h1 class="main-navbar__title"><?php echo $settings['title']; ?></h1>
                </div>
                <ul class="main-navbar__menu">
					<?php foreach($settings['menu_items'] as $index => $item){ ?>
						<li>
							<a href="#<?php echo $item['section_id']; ?>" uk-scroll>
								<span class="main-navbar__item--image">
									<img src="<?php echo $item['menu_icon']['url']; ?>">
								</span>
								<?php echo $item['item_title']; ?>
							</a>
						</li>
					<?php } ?>
                </ul>
            </nav>
        ⠀<?php 
	}

}
