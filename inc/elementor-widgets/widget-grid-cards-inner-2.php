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

class Zami_grid_cards_inner_2 extends Widget_Base {

    public function get_name() {
        return 'Zami_grid_cards_inner_2';
    }

    public function get_title() {
        return '2 Grid Cards Multimedia - ( Inner ) ';
    }

    public function get_categories() {
        return ['first-category'];
    }

    public function _register_controls() {

		$this->start_controls_section (
            'zami_cards', 
            [
                'label' => __('Cards Layout'),
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
            $choices[$item->slug] = $item->name;

            if($index == 0) {
                $default_cat[] = $item->slug;
            }
        } 
        
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
				'devices' => [ 'desktop', 'tablet' ],
				'default' => '1-3',
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
            'multimedia_behavior', 
            [
                'label' => __('Multimedia Behavior'),
            ],
		);

		$this->add_control(
			'multimedia_type',
			[
				'label' => __( 'Multimedia Type', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'image' => [
						'title' => __( 'Image', 'plugin-domain' ),
						'icon' => 'fas fa-photo-video',
					],
					'audio' => [
						'title' => __( 'Audio', 'plugin-domain' ),
						'icon' => 'fas fa-volume-up',
					],
					'video' => [
						'title' => __( 'Video', 'plugin-domain' ),
						'icon' => 'fas fa-film',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
		);
		
		$this->add_responsive_control(
			'size_icon_multimedia',
			[
				'label' => __( 'Size Icon (SVG)', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '30',
					'unit' => 'px',
				],
				'size_units' => [ '%', 'px', 'vh' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .multimedia-bar__wrap svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'entrance_animation',
			[
				'label' => __( 'Entrance Animation', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::ANIMATION,
				'prefix_class' => 'animated ',
			]
		);
		
		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
				'prefix_class' => 'elementor-animation-',
			]
		);

		$this->add_control(
			'icon_multimedia',
			[
				'label' => __( 'Icon Multimedia', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fab fa-youtube',
					'library' => 'fa-brands',
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
			'show_multimedia_bar',
			[
				'label' => __( 'Multimedia Bar', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'plugin-domain' ),
				'label_off' => __( 'Hide', 'plugin-domain' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'after',
			]
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
				'return_value' => 'off',
				'default' => '',
			]
        );
        
        $this->add_control(
			'show_excerpt',
			[
				'label' => __( 'Excerpt', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'plugin-domain' ),
				'label_off' => esc_html__( 'Hide', 'plugin-domain' ),
				'return_value' => 'off',
                'default'   => '',
			]
		);

        $this->add_control(
			'show_comments_icon',
			[
				'label' => __( 'Comments Icon', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'plugin-domain' ),
				'label_off' => __( 'Hide', 'plugin-domain' ),
				'return_value' => 'off',
				'default' => '',
			]
		);
        
        $this->add_control(
			'enable_carousel',
			[
				'label' => __( 'Enable Carousel', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'plugin-domain' ),
				'label_off' => __( 'Hide', 'plugin-domain' ),
				'return_value' => 'off',
				'default' => '',
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
			'card_height',
			[
				'label' => __( 'Card Height', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '40',
					'unit' => 'vh',
				],
				'size_units' => ['px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 400,
						'max' => 1300,
					],
					'vh' => [
						'min' => 40,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .card__item' => 'height: {{SIZE}}{{UNIT}}',
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
			'card_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '3',
					'bottom' => '3',
					'left' => '3',
					'right' => '3',
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
				'name' => 'card_box_shadow',
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
				'label' => __( 'Background Overlay', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'default' => 'rgba(0,0,0,.35)',
					],
				],
				'selector' => '{{WRAPPER}} .component__bg-overlay',
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
					'default' => Global_Colors::COLOR_TEXT,
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
					'default' => Global_Colors::COLOR_TEXT,
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
					'default' => Global_Colors::COLOR_TEXT,
				],
                'selectors' => [
					'{{WRAPPER}} .component-info__excerpt' => 'color: {{VALUE}}',
				],
			]
        );
		
        $this->add_control(
			'multimedia-bar_background',
			[
				'label' => __( 'Multimedia Bar Background', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
                'selectors' => [
					'{{WRAPPER}} .card__info--play-bar' => 'background: {{VALUE}}',
				],
				'separator' => 'before',
			]
        );

        $this->add_control(
			'multimedia-bar_background_active',
			[
				'label' => __( 'Multimedia Bar Background (Active)', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
                'selectors' => [
					'{{WRAPPER}} .multimedia_active' => 'background: {{VALUE}}',
				],
			]
        );
				
        $this->add_control(
			'multimedia-content_background',
			[
				'label' => __( 'Multimedia Content Background', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
                'selectors' => [
					'{{WRAPPER}} .card__info--player' => 'background: {{VALUE}}',
				],
			]
        );

        $this->add_control(
			'multimedia-bar_icon',
			[
				'label' => __( 'Multimedia Bar - Icon Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
                'selectors' => [
					'{{WRAPPER}} .card__info--play-bar svg' => 'fill: {{VALUE}}',
					// '{{WRAPPER}} .card__info--play-bar i' => 'color: {{VALUE}}',
					// '{{WRAPPER}} .card__info--play-bar svg' => 'stroke: {{VALUE}}',
				],
			]
        );		
		
        $this->add_control(
			'multimedia-bar_title',
			[
				'label' => __( 'Multimedia Bar - Title Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
                'selectors' => [
					'{{WRAPPER}} .play-bar__title' => 'color: {{VALUE}}',
				],
			]
        );

		$this->end_controls_section();

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

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name' => 'typography_multimedia_bar_title',
				'label' => __( 'Typography Multimedia Bar - Title', 'plugin-domain' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
                'selector' => '{{WRAPPER}} .card__info--play-bar',
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
					'left' => 'align-items: flex-start; text-align: left;',
					'center' => 'align-items: center; text-align: center;',
					'right' => 'align-items: flex-end; text-align: right;',
				],
				'selectors' => [
					'{{WRAPPER}} .card__info--header' => '{{VALUE}}',
					'{{WRAPPER}} .component-info__bar' => '{{VALUE}}',
				],
			]
        );

		$this->add_responsive_control(
			'padding_title',
			[
				'label'      => esc_html__( 'Padding Title', 'plugin-domain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem' ],
				'default' => [
					'top' => '0.5',
					'right' => '1',
					'bottom' => '0.5',
					'left' => '1',
					'unit' => 'rem',
				],
				'selectors'  => [
					'{{WRAPPER}} .component-info__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'padding_info',
			[
				'label'      => esc_html__( 'Padding Info', 'plugin-domain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem' ],
				'default' => [
					'top' => '0.5',
					'right' => '1',
					'bottom' => '0.5',
					'left' => '1',
					'unit' => 'rem',
				],
				'selectors'  => [
					'{{WRAPPER}} .component-info__bar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'top' => '0.5',
						'right' => '1',
						'bottom' => '0.5',
						'left' => '1',
						'unit' => 'rem',
						'isLinked' => 'false',
				],
				'selectors'  => [
					'{{WRAPPER}} .component-info__excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_multimedia_bar',
			[
				'label'      => esc_html__( 'Padding Multimedia Bar', 'plugin-domain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem' ],
				'default' => [
					'top' => '0.5',
					'right' => '1',
					'bottom' => '0.5',
					'left' => '1',
					'unit' => 'rem',
				],
				'selectors'  => [
					'{{WRAPPER}} .card__info--play-bar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
    }

    public function render() { 
		$settings = $this->get_settings_for_display();

		$columns_tablet_value = isset($settings['columns_tablet']) ? $settings['columns_tablet'] : '1-2';

		$columns_desktop = 'uk-child-width-' . $settings['columns'] . '@l';
		$columns_tablet = 'uk-child-width-' . $columns_tablet_value . '@m';
		$uk_slider = '';
		$uk_slider_items = '';

		if($settings['enable_carousel']) {
			$uk_slider = 'uk-slider';
			$uk_slider_items = 'uk-slider-items';
		}

		$this->add_render_attribute(
			'card_section',
			[
				'class' => [ 
					'section__card--inner',
					$settings['gap_items_row'],
					$settings['gap_items_column'],
					$columns_desktop,
					$columns_tablet,
					'uk-grid-match',
					$uk_slider_items
				]
			]
		);
    ?>
        <section <?php echo $uk_slider; ?> >
			<div <?php echo $this->get_render_attribute_string( 'card_section' ); ?> uk-grid>
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
                        'field' => 'slug',
                        'terms' => $settings['taxonomies'],
                    ),
                ),
            );

            $posts_query = new \WP_Query( $args );

            if( $posts_query->have_posts() ) {
                while( $posts_query->have_posts() ) {  
                $posts_query->the_post(); 
            ?>
            <div class="card__item" card-multimedia data-player>
                <div class="card__item-wrap">
                    <div class="card__image">
						<img src="<?= the_post_thumbnail_url(); ?>" >
                    </div>
                    <div class="component__bg-overlay"></div>
                    <div class="card__info" data-card-info>
                        <div class="card__info--header">
							<?php if($settings['show_tag']) { ?>
								<div class="component-info__bar">
									<h4 class="component-info__tag"> 
									<?php $catInfo = get_category_by_slug($settings['taxonomies'][0]); 
										$catName = $catInfo->name; 
										echo $catName; ?>
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
                        </div>
                        <div class="card__info--play-bar" play-bar>
							<div class="play-bar__wrap">
								<div class="play-bar__play" data-control="play">
									<span uk-icon="icon: play_cut" class="play-icon"></span>
									<h3 class="play-bar__title">Play</h3>
								</div>
								<div class="play-bar__buttons">
									<span uk-icon="icon: undo30" data-control="return-time"></span>
									<span uk-icon="icon: speed" data-control="speed"></span>
									<span uk-icon="icon: redo10" data-control="advance-time"></span>
	
								</div>
							</div>
						</div>
                        <div class="card__info--player" data-controls>
							<!-- <input type="range" uk-icon="icon: redo10" data-control="time-bar"></input> -->
							<input  data-control="time-bar" type="range"> 
							<span uk-icon="icon: redo10" data-control="current-time"></span>
							<span uk-icon="icon: redo10" data-control="volume"></span>
						<?php 
							$media = get_media_embedded_in_content( 
								apply_filters( 'the_content', get_the_content() )
							);
							if($media){
								echo '<div class="post-media" data-media>';
								echo $media[0];
								echo '</div>';
							}
						 ?>
						</div>
                    </div>
                </div>
            </div>
			
		<?php } 
            } ?>

			</div>
        </section>
	<?php 
    }
}
