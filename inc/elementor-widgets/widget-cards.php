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

class Zami_grid_cards_multimedia extends Widget_Base {

    public function get_name() {
        return 'Zami_grid_cards_multimedia';
    }

    public function get_title() {
        return 'Grid Cards Multimedia';
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

		// Select post type
		$args = array(
			'public'   => true,
		);
	
		$output = 'names'; // names or objects, note names is the default
		$operator = 'and'; // 'and' or 'or'
		$post_types = get_post_types( $args, $output, $operator ); 
		$post_types_final = [];
	
		foreach ($post_types as $key => $value) {
			if($key != 'elementor_library') {
				$post_types_final[$value] = $value;
			}
		}

        $this->add_control(
			'post_types',
			[
				'label' => __( 'Show Elements', 'a' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'multiple' => true,
				'options' => $post_types_final,
				'default' => 'post',
			]
		);

		// Select Categories
        $choices = array();
        $default_cat = [];
        $categories = get_categories();
	
        foreach ($categories as $index => $item) {
            $choices[$item->term_id] = $item->name;

            if($index == 0) {
                $default_cat[] = $item->slug;
            }
        } 

		echo '<pre>';
		var_dump($choices);
		echo '</pre>';
		
        $this->add_control(
			'taxonomies',
			[
				'label' => __( 'Show Elements', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $choices,
				'default' => [$default_cat[0]],
			]
		);
		
        $this->add_responsive_control(
			'card_style',
			[
				'label' => __( 'Card Style', 'plugin-domain' ),
				'type' => Controls_Manager::SELECT,
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => 'card-item--bottom-info',
                'tablet_default' => 'card-item--bottom-info',
                'mobile_default' => 'card-item--bottom-info',
				'options' => [
					'card-item--inner-info' => __( 'Inner', 'plugin-domain' ),
					'card-item--bottom-info' => __( 'Bottom Info', 'plugin-domain' ),
					'card-item--left-info' => __( 'Left Info', 'plugin-domain' ),
					'card-item--right-info' => __( 'Right Info', 'plugin-domain' ),
				], 
				'selectors_dictionary' => [
					'card-item--inner-info' => 'position: absolute; height: 100%; width: 100%; z-index: -1;',
					'card-item--left-info' => 'order: 1;',
				],
				'selectors' => [
					'{{WRAPPER}} .component-image__wrap' => '{{VALUE}}',
				],
			]
		);	

		$this->add_control(
			'card_inner',
			[
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'condition' => ['card_style' => ['card-item--inner-info' ]],
				'default' => 'overflow: hidden;',
				'selectors' => [
					'{{WRAPPER}} .component-info' => '{{VALUE}}',
				],
			]
		);

		$this->add_control(
			'card_desktop',
			[
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'condition' => ['card_style' => ['card-item--left-info', 'card-item--right-info']],
				'devices' => [ 'desktop' ],
				'default' => 'display: flex;',
				'selectors' => [
					'(desktop+) {{WRAPPER}} .card-item' => '{{VALUE}}',
				],
			]
		);

		$breakpoints = \Elementor\Plugin::$instance->breakpoints->get_breakpoints();

		$this->add_control(
			'breakpoint_mobile',
			[
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'default' => '.',
				'selectors' => [
					'{{WRAPPER}}' => '--uk-breakpoint-s:' . $breakpoints['mobile']->get_value(),
				],
			]
		);

		$this->add_control(
			'breakpoint_tablet',
			[
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'default' => '.',
				'selectors' => [
					'{{WRAPPER}}' => '--uk-breakpoint-m:' . $breakpoints['tablet']->get_value(),
				],
			]
		);


		$this->add_control(
			'card_tablet',
			[
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'condition' => ['card_style_tablet' => ['card-item--left-info', 'card-item--right-info']],
				'devices' => [ 'tablet' ],
				'default' => 'display: flex;',
				'selectors' => [
					'(tablet) {{WRAPPER}} .card-item' => '{{VALUE}}',
				],
			]
		);

		$this->add_control(
			'card_mobile',
			[
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'condition' => ['card_style_tablet' => ['card-item--left-info', 'card-item--right-info']],
				'devices' => [ 'mobile' ],
				'default' => 'display: flex;',
				'selectors' => [
					'(mobile) {{WRAPPER}} .card-item' => '{{VALUE}}',
				],
			]
		);

        $this->add_control(
			'posts_count',
			[
				'label' => __( 'Posts Count', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 20,
				'step' => 1,
				'default' => 3,
				'separator' => 'before',
			]
		);

        $this->add_control(
			'posts_offset',
			[
				'label' => __( 'Posts Offset', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'step' => 1,
				'default' => 0,
			]
		);

        $this->add_control(
			'excerpt_length',
			[
				'label' => __( 'Excerpt Length ( Words )', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'step' => 1,
				'default' => 16,
			]
		);

        $this->add_responsive_control(
			'columns',
			[
				'label' => __( 'Columns', 'plugin-domain' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1-2',
				'tablet_default' => '1-2',
				'mobile_default' => '1-2',
				'options' => [
					'1-1' => __( '1', 'plugin-domain' ),
					'1-2' => __( '2', 'plugin-domain' ),
					'1-3' => __( '3', 'plugin-domain' ),
					'1-4' => __( '4', 'plugin-domain' ),
					'1-5' => __( '5', 'plugin-domain' ),
					'1-6' => __( '6', 'plugin-domain' ),
				],
			]
		);

        $this->add_control(
			'gap_items_row',
			[
				'label' => __( 'Gap Items ( Row )', 'plugin-domain' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'uk-grid-row-small',
				'options' => [
					'uk-grid-row-collapse' => __( 'Collapse', 'plugin-domain' ),
					'uk-grid-row-small' => __( 'Small', 'plugin-domain' ),
					'uk-grid-row-medium' => __( 'Medium', 'plugin-domain' ),
					'uk-grid-row-large' => __( 'Large', 'plugin-domain' ),
				],
			]
		);
		
        $this->add_control(
			'gap_items_column',
			[
				'label' => __( 'Gap Items ( Column )', 'plugin-domain' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'uk-grid-column-small',
				'options' => [
					'uk-grid-column-collapse' => __( 'Collapse', 'plugin-domain' ),
					'uk-grid-column-small' => __( 'Small', 'plugin-domain' ),
					'uk-grid-column-medium' => __( 'Medium', 'plugin-domain' ),
					'uk-grid-column-large' => __( 'Large', 'plugin-domain' ),
				],
			]
        );
        
        $this->end_controls_section();

        $this->start_controls_section (
            'zami_cards_show_hide', 
            [
                'label' => __('Show/Hide'),
            ],
        );

        $this->add_control(
			'show_title',
			[
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'plugin-domain' ),
				'label_off' => __( 'Hide', 'plugin-domain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        
        $this->add_control(
			'show_date',
			[
				'label' => __( 'Date', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'plugin-domain' ),
				'label_off' => __( 'Hide', 'plugin-domain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );

        $this->add_control(
			'show_tag',
			[
				'label' => __( 'Tag', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'plugin-domain' ),
				'label_off' => __( 'Hide', 'plugin-domain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        
        $this->add_control(
			'show_author',
			[
				'label' => __( 'Author', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'plugin-domain' ),
				'label_off' => __( 'Hide', 'plugin-domain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        
        $this->add_control(
			'show_excerpt',
			[
				'label' => __( 'Excerpt', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'plugin-domain' ),
				'label_off' => esc_html__( 'Hide', 'plugin-domain' ),
				'return_value' => 'yes',
                'default'   => 'yes',
			]
		);

        $this->add_control(
			'show_comments_icon',
			[
				'label' => __( 'Comments Icon', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'plugin-domain' ),
				'label_off' => __( 'Hide', 'plugin-domain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        
        $this->add_control(
			'show_listen',
			[
				'label' => __( 'Listen Icon', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'plugin-domain' ),
				'label_off' => __( 'Hide', 'plugin-domain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'card_style_image',
			[
				'label' => __( 'Image', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
			'image_height_desktop',
			[
				'label' => __( 'Image Height', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'devices' => [ 'desktop' ],
				'condition' => ['card_style' => ['card-item--inner-info', 'card-item--right-info', 'card-item--left-info']],
				'default' => [
					'size' => '35',
					'unit' => 'vh',
				],
				'size_units' => [ '%', 'px', 'vw', 'vh' ],
				'range' => [
					'%' => [
						'min' => 10,
						'max' => 100,
					],
					'px' => [
						'min' => 10,
						'max' => 1000,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'(desktop+) {{WRAPPER}} .card-item' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->add_responsive_control(
			'image_height_tablet',
			[
				'label' => __( 'Image Height', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'devices' => [ 'tablet' ],
				'condition' => ['card_style_tablet' => ['card-item--inner-info', 'card-item--right-info', 'card-item--left-info']],
				'default' => [
					'size' => '35',
					'unit' => 'vh',
				],
				'size_units' => [ '%', 'px', 'vw', 'vh' ],
				'range' => [
					'%' => [
						'min' => 10,
						'max' => 100,
					],
					'px' => [
						'min' => 10,
						'max' => 1000,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'(tablet) {{WRAPPER}} .card-item' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->add_responsive_control(
			'image_height_mobile',
			[
				'label' => __( 'Image Height', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'devices' => [ 'mobile' ],
				'condition' => ['card_style_mobile' => ['card-item--inner-info', 'card-item--right-info', 'card-item--left-info']],
				'default' => [
					'size' => '35',
					'unit' => 'vh',
				],
				'size_units' => [ '%', 'px', 'vw', 'vh' ],
				'range' => [
					'%' => [
						'min' => 10,
						'max' => 100,
					],
					'px' => [
						'min' => 10,
						'max' => 1000,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'(mobile) {{WRAPPER}} .card-item' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->add_responsive_control(
			'image_height_info_bottom_desktop',
			[
				'label' => __( 'Image Height ( Container )', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'devices' => [ 'desktop' ],
				'condition' => ['card_style' => [ 'card-item--bottom-info' ] ],
				'default' => [
					'size' => '35',
					'unit' => 'vh',
				],
				'size_units' => [ '%', 'px', 'vw', 'vh' ],
				'range' => [
					'%' => [
						'min' => 10,
						'max' => 100,
					],
					'px' => [
						'min' => 10,
						'max' => 1000,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .card-item' => 'display: flex; flex-direction: column;',
					'(desktop+) {{WRAPPER}} .component-image__wrap' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->add_responsive_control(
			'image_height_info_bottom_tablet',
			[
				'label' => __( 'Image Height ( Container )', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'devices' => [ 'tablet' ],
				'condition' => ['card_style_tablet' => [ 'card-item--bottom-info' ] ],
				'default' => [
					'size' => '35',
					'unit' => 'vh',
				],
				'size_units' => [ '%', 'px', 'vw', 'vh' ],
				'range' => [
					'%' => [
						'min' => 10,
						'max' => 100,
					],
					'px' => [
						'min' => 10,
						'max' => 1000,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .card-item' => 'display: flex; flex-direction: column;',
					'(tablet) {{WRAPPER}} .component-image__wrap' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);
        
        $this->add_responsive_control(
			'image_height_info_bottom_mobile',
			[
				'label' => __( 'Image Height ( Container )', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'devices' => [ 'mobile' ],
				'condition' => ['card_style_mobile' => [ 'card-item--bottom-info' ] ],
				'default' => [
					'size' => '35',
					'unit' => 'vh',
				],
				'size_units' => [ '%', 'px', 'vw', 'vh' ],
				'range' => [
					'%' => [
						'min' => 10,
						'max' => 100,
					],
					'px' => [
						'min' => 10,
						'max' => 1000,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .card-item' => 'display: flex; flex-direction: column;',
					'(mobile) {{WRAPPER}} .component-image__wrap' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);
        
        $this->add_responsive_control(
			'image_width_desktop',
			[
				'label' => __( 'Image Width', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'devices' => [ 'desktop' ],
				'condition' => ['card_style' => [ 'card-item--left-info', 'card-item--right-info' ] ],
				'default' => [
					'size' => '35',
					'unit' => 'vh',
				],
				'size_units' => [ '%', 'px', 'vw', 'vh' ],
				'range' => [
					'%' => [
						'min' => 10,
						'max' => 100,
					],
					'px' => [
						'min' => 10,
						'max' => 1000,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'(desktop+) {{WRAPPER}} .component-image__wrap' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);
        
        $this->add_responsive_control(
			'image_width_tablet',
			[
				'label' => __( 'Image Width', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'devices' => [ 'tablet' ],
				'condition' => ['card_style_tablet' => [ 'card-item--left-info', 'card-item--right-info' ] ],
				'default' => [
					'size' => '35',
					'unit' => 'vh',
				],
				'size_units' => [ '%', 'px', 'vw', 'vh' ],
				'range' => [
					'%' => [
						'min' => 10,
						'max' => 100,
					],
					'px' => [
						'min' => 10,
						'max' => 1000,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'(tablet) {{WRAPPER}} .component-image__wrap' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);
        
        $this->add_responsive_control(
			'image_width_mobile',
			[
				'label' => __( 'Image Width', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'devices' => [ 'mobile' ],
				'condition' => ['card_style_mobile' => [ 'card-item--left-info', 'card-item--right-info' ] ],
				'default' => [
					'size' => '35',
					'unit' => 'vh',
				],
				'size_units' => [ '%', 'px', 'vw', 'vh' ],
				'range' => [
					'%' => [
						'min' => 10,
						'max' => 100,
					],
					'px' => [
						'min' => 10,
						'max' => 1000,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'(mobile) {{WRAPPER}} .component-image__wrap' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'image_filters',
				'selector' => '{{WRAPPER}} .component-image__wrap img',
			]
		);

		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .component-image__wrap',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '7',
					'bottom' => '7',
					'left' => '7',
					'right' => '7',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .component-image__wrap, {{WRAPPER}} .component__bg-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

				
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .component-image__wrap',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'colors',
			[
				'label' => __( 'Colors', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .component__bg-overlay',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'default' => 'rgba(0,0,0,.35)',
					],
				],
				'condition' => [
					'card_style' => 'card-item--inner-info',
				],
			]
		);

        $this->add_control(
			'tag_background',
			[
				'label' => __( 'Tag Background', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
                'selectors' => [
					'{{WRAPPER}} .component-info__tag' => 'background-color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		
        $this->add_control(
			'tag_color',
			[
				'label' => __( 'Tag Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
                'selectors' => [
					'{{WRAPPER}} .component-info__tag' => 'color: {{VALUE}}',
				],
			]
		);
		
        $this->add_control(
			'info_color',
			[
				'label' => __( 'Info Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
                'selectors' => [
					'{{WRAPPER}} .component-info__date' => 'color: {{VALUE}}',
					'{{WRAPPER}} .component-info__author' => 'color: {{VALUE}}',
					'{{WRAPPER}} .component-info__listener i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .component-info__comments' => 'color: {{VALUE}}',
				],
			]
		);
		
        $this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
                'selectors' => [
					'{{WRAPPER}} .component-info__title' => 'color: {{VALUE}}',
				],
			]
		);
		
        $this->add_control(
			'excerpt_color',
			[
				'label' => __( 'Excerpt Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
                'selectors' => [
					'{{WRAPPER}} .component-info__excerpt' => 'color: {{VALUE}}',
				],
				'separator' => 'after',
			]
        );

		$this->end_controls_section();
		
		#TYPOGRAPHY
		$this->start_controls_section(
			'typography',
			[
				'label' => __( 'Typography', 'elementor' ),
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
				'selector' => '{{WRAPPER}} .component-info__title',
			]
        );
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name' => 'typography_excerpt',
				'label' => __( 'Typography Excerpt', 'plugin-domain' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
				'selector' => '{{WRAPPER}} .component-info__excerpt',
			]
        );
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name' => 'typography_info',
				'label' => __( 'Typography Info', 'plugin-domain' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
                'selector' => '
                    {{WRAPPER}} .component-info__date,
                    {{WRAPPER}} .component-info__comments,
                    {{WRAPPER}} .component-info__author
                    ',
			]
		);
		        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name' => 'typography_tag',
				'label' => __( 'Typography Tag', 'plugin-domain' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
                'selector' => '{{WRAPPER}} .component-info__tag',
			]
		);
		        
        $this->end_controls_section();

		$this->start_controls_section(
			'alignment',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
			'justify_info',
			[
				'label' => __( 'Justify Info', 'plugin-domain' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => __( 'Left', 'plugin-domain' ),
					'center' => __( 'Center', 'plugin-domain' ),
					'right' => __( 'Right', 'plugin-domain' ),
				],
				'selectors_dictionary' => [
					'left' => 'align-items: flex-start; text-align: lefta;',
					'center' => 'align-items: center; text-align: center;',
					'right' => 'align-items: flex-end; text-align: right;',
				],
				'selectors' => ['{{WRAPPER}} .justify_info' => '{{VALUE}}'],
			]
        );

        $this->add_responsive_control(
			'align_info',
			[
				'label' => __( 'Align Info ( Vertical )', 'plugin-domain' ),
				'type' => Controls_Manager::SELECT,
				'condition' => ['card_style' => ['card-item--right-info', 'card-item--left-info', 'card-item--inner-info']],
				'default' => 'left',
				'options' => [
					'top' => __( 'Top', 'plugin-domain' ),
					'center' => __( 'Center', 'plugin-domain' ),
					'bottom' => __( 'Bottom', 'plugin-domain' ),
				],
				'selectors_dictionary' => [
					'top' => 'align-items: flex-start;',
					'center' => 'align-items: center;',
					'bottom' => 'align-items: flex-end;',
				],
				'selectors' => ['{{WRAPPER}} .align_info' => '{{VALUE}}'],
				'separator' => 'after',
			]
        );

		$this->add_responsive_control(
			'padding_info_container',
			[
				'label'      => esc_html__( 'Padding Info  - Container', 'plugin-domain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem' ],
				'default' => [
					'top' => '.5',
					'right' => '1',
					'bottom' => '1',
					'left' => '0',
					'unit' => 'rem',
				],
				'selectors'  => [
					'{{WRAPPER}} .component-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'padding_info',
			[
				'label'      => esc_html__( 'Padding Info', 'plugin-domain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'rem', '%', 'em', 'px'],
				'selectors'  => [
					'{{WRAPPER}} .component-info__bar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_title',
			[
				'label'      => esc_html__( 'Padding Title', 'plugin-domain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
                'default'    => [
                    'unit'      => 'px',
                    'top'       => '10',
                    'right'     => '0',
                    'bottom'    => '10',
                    'left'      => '0',
                ],
				'selectors'  => [
					'{{WRAPPER}} .component-info__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_excerpt',
			[
				'label'      => esc_html__( 'Padding Excerpt', 'plugin-domain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '30',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => 'false',
				],
				'selectors'  => [
					'{{WRAPPER}} .component-info__excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
    }

    public function render() { 

		$settings = $this->get_settings_for_display();

		$columns_tablet_value = isset($settings['columns_tablet']) ? $settings['columns_tablet'] : '1-2';
		$columns_mobile_value = isset($settings['columns_mobile']) ? $settings['columns_mobile'] : '1-2';
		
		$columns_desktop = 'uk-child-width-' . $settings['columns'] . '@l';
		$columns_tablet = 'uk-child-width-' . $columns_tablet_value . '@m';
		$columns_mobile = 'uk-child-width-' . $columns_mobile_value . '@s';
	
		$this->add_render_attribute(
			'card_section',
			[
				'class' => [ 
					'cards-section',
					$settings['gap_items_row'],
					$settings['gap_items_column'],
					$columns_desktop,
					$columns_tablet,
					$columns_mobile,
					'uk-grid-match'
				]
			]
		);

		$this->add_render_attribute(
			'card_style',
			[
				'class' => [ $settings['card_style'], 'card-item__wrap' ]
			]
		);

    ?>

        <section <?php echo $this->get_render_attribute_string( 'card_section' ); ?> uk-grid>
            
            <?php $args = array (
                    // 'order' => 'asc',
                    'post_type' => 'post',
					'post_status' => 'publish',
					'offset' => $settings['posts_offset'],
					'posts_per_page' => $settings['posts_count'],
					'post_status'    => array( 'publish' ),
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => $settings['taxonomies'],
                    ),
                ),
            );

            $posts_query = new \WP_Query( $args );

            if( $posts_query->have_posts() ) {
                while( $posts_query->have_posts() ) {  
                $posts_query->the_post(); 
            ?>
            <div class="card-item__wrap">
                <div class="card-item">
                    <div class="component-image__wrap">
                        <img src="<?= the_post_thumbnail_url(); ?>" >
					</div>
					
					<div class="component__bg-overlay"></div>

                    <div class="component-info align_info">
						<div class="component-info__wrap justify_info">

							
							<?php if($settings['show_tag']) { ?>
								<div class="component-info__bar">
										<h4 class="component-info__tag"> 
										<?php 
											$data_tag = get_term($settings['taxonomies'][0]);
											$tag_link = get_tag_link($data_tag->term_id);
											$tag_name = get_term(6)->name;
										?>
											<a href="<?php echo $tag_link; ?>"><?php echo $tag_name; ?></a> 
										</h4>
								</div>
							<?php }; ?>

							<?php if($settings['show_title']) { ?>
								<h1 class="component-info__title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
							<?php }; ?>

							<?php if($settings['show_excerpt']) { ?>
								<h2 class="component-info__excerpt"><?= wp_trim_words( get_the_excerpt(), $settings['excerpt_length'], '...' ); ?></h2>
							<?php }; ?>
							
							<?php if($settings['show_author'] || $settings['show_date'] ) { ?>
								<div class="component-info__bar">
										<?php if($settings['show_author']) { ?>
											<h4 class="component-info__author"> by <?= get_the_author_meta('display_name'); ?></h4>
										<?php }; ?>

										<?php if($settings['show_date']) { ?>
											<h4 class="component-info__date"><?= get_the_date(); ?></h4>
										<?php }; ?>
								</div>
							<?php }; ?>

							<?php if($settings['show_comments_icon'] || $settings['show_listen'] ) { ?>

								<div class="component-info__bar">
									<?php if($settings['show_comments_icon'] ) { ?>
										<div class="component-info__comments">
											<i class="fas fa-comment-alt"></i>
											<span>8</span>
										</div>
									<?php }; ?>

									<?php if($settings['show_listen'] ) { ?>
										<div class="component-info__listener">
											<i class="fas fa-headphones-alt"></i>
										</div>
									<?php }; ?>
								</div>

							<?php }; ?>
						</div>
                    </div>
                </div>
            </div>
            <?php } 
            } ?>
        </section>
	<?php 
    }
 }


