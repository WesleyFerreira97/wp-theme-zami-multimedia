<?php 
/**
 * The default template for displaying content
 *
 * @author      OMA Themes
 * @link        http://omathemes.store
 */ 

 namespace Elementor;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Zami_widget_gallery_1 extends Widget_Base {

    public function get_name() {
        return 'Zami_widget_gallery_1';
    }

    public function get_title() {
        return 'Zami Gallery 1';
    }

    public function get_categories() {
        return ['first-category'];
    }

    public function _register_controls() {
        
        $this->start_controls_section (
            'gallery_1', 
            [
                'label' => __('Gallery Header'),
            ],
		);
		
        $this->add_control(
			'text_1',
			[
				'label' => __( 'Text 1', 'plugin-domain' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 2,
				'placeholder' => __( 'Enter your Text', 'plugin-domain' ),
				'default' => __( 'Add Your Heading Text Here', 'plugin-domain' ),
			]
		);

        $this->add_control(
			'text_2',
			[
				'label' => __( 'Text 2', 'plugin-domain' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 2,
				'placeholder' => __( 'Enter your Text', 'plugin-domain' ),
				'default' => __( 'Add Your Heading Text Here', 'plugin-domain' ),
			]
		);

        $this->add_control(
			'text_3',
			[
				'label' => __( 'Text 3', 'plugin-domain' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 2,
				'placeholder' => __( 'Enter your Text', 'plugin-domain' ),
				'default' => __( 'Add Your Heading Text Here', 'plugin-domain' ),
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'gallery',
			[
				'label' => __( 'Gallery', 'plugin-name' ),
			]
		);
		
		$repeater = new Repeater();

		$repeater->add_control(
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

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'default' => [
					'is_external' => 'true',
				],
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'elementor' ),
			]
		);
	
		$this->add_control(
			'gallery_images',
			[
				'label' => __( 'Repeater List', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => 'Item',
			]
		);

		$this->add_responsive_control(
			'image_height_desktop',
			[
				'label' => __( 'Image Height', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '50',
					'unit' => 'vh',
				],
				'size_units' => [ '%', 'px', 'vh' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1920,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .zami-gallery__item' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		     
		$this->end_controls_section();

		$this->start_controls_section(
			'id',
			[
				'label' => __( 'ID', 'plugin-name' ),
			]
		);
			
				
		$this->add_control(
			'section_id',
			[
				'label' => __( 'Section ID', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type your ID here', 'plugin-domain' ),
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'text_style',
			[
				'label' => __( 'Text Style', 'plugin-name' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'text_1_color',
			[
				'label' => __( 'Text 1 - Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
                'selectors' => [
					'{{WRAPPER}} .zami-gallery__text--1' => 'color: {{VALUE}}',
				],
			]
		);
		
        $this->add_control(
			'text_2_color',
			[
				'label' => __( 'Text 2 - Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
                'selectors' => [
					'{{WRAPPER}} .zami-gallery__text--2' => 'color: {{VALUE}}',
				],
			]
        );
		
        $this->add_control(
			'text_3_color',
			[
				'label' => __( 'Text 3 - Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
                'selectors' => [
					'{{WRAPPER}} .zami-gallery__text--3' => 'color: {{VALUE}}',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name' => 'text_1_typography',
                'label' => __( 'Text 1 Typography', 'plugin-domain' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .zami-gallery__text--1',
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name' => 'text_2_typography',
                'label' => __( 'Text 2 Typography', 'plugin-domain' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .zami-gallery__text--2',
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name' => 'text_3_typography',
                'label' => __( 'Text 3 Typography', 'plugin-domain' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .zami-gallery__text--3',
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
			'header_alignment', [
				'label'			 =>esc_html__( 'Alignment', 'plugin-domain' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [
					'left'		 => [
						'title'	 =>esc_html__( 'Left', 'plugin-domain' ),
						'icon'	 => 'fa fa-align-left',
					],
					'center'	 => [
						'title'	 =>esc_html__( 'Center', 'plugin-domain' ),
						'icon'	 => 'fa fa-align-center',
					],
					'right'		 => [
						'title'	 =>esc_html__( 'Right', 'plugin-domain' ),
						'icon'	 => 'fa fa-align-right',
					],
				],
				'default' => 'text_center',
				'selectors' => ['{{WRAPPER}} .zami-gallery__header' => 'text-align: {{value}};'
				],
			],
		);

		$this->add_responsive_control(
			'padding_header',
			[
				'label'      => esc_html__( 'Padding Header', 'plugin-domain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'tablet_default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '30',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => 'false',
				],
				'mobile_default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '30',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => 'false',
				],
				'selectors'  => [
					'{{WRAPPER}} .zami-gallery__header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_text_1',
			[
				'label'      => esc_html__( 'Margin Text 1', 'plugin-domain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'tablet_default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '30',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => 'false',
				],
				'mobile_default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '30',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => 'false',
				],
				'selectors'  => [
					'{{WRAPPER}} .zami-gallery__text--1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_text_2',
			[
				'label'      => esc_html__( 'Margin Text 2', 'plugin-domain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'tablet_default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '30',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => 'false',
				],
				'mobile_default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '30',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => 'false',
				],
				'selectors'  => [
					'{{WRAPPER}} .zami-gallery__text--2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_text_3',
			[
				'label'      => esc_html__( 'Margin Text 3', 'plugin-domain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'tablet_default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '30',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => 'false',
				],
				'mobile_default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '30',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => 'false',
				],
				'selectors'  => [
					'{{WRAPPER}} .zami-gallery__text--3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_gallery',
			[
				'label'      => esc_html__( 'Padading Gallery', 'plugin-domain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'tablet_default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '30',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => 'false',
				],
				'mobile_default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '30',
						'left' => '0',
						'unit' => 'px',
						'isLinked' => 'false',
				],
				'selectors'  => [
					'{{WRAPPER}} .zami-gallery__images' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

    }

    public function render() {

		$settings = $this->get_settings_for_display();

		// if ( '' === $settings['title'] ) {
		// 	return;
		// }

		$this->add_render_attribute( 'text_1', 'class', 'zami-gallery__text--1' );
		$this->add_render_attribute( 'text_2', 'class', 'zami-gallery__text--2' );
		$this->add_render_attribute( 'text_3', 'class', 'zami-gallery__text--3' );
		
		
		$this->add_inline_editing_attributes('text_1');
		$this->add_inline_editing_attributes('text_2');
		$this->add_inline_editing_attributes('text_3');
		?>

		<div id="<?php echo $settings['section_id']; ?>" class="zami-gallery">

			<div class="zami-gallery__header">
				<h1 <?php echo $this->get_render_attribute_string( 'text_1' ); ?>><?php echo $settings['text_1']; ?></h1>
				<h1 <?php echo $this->get_render_attribute_string( 'text_2' ); ?>><?php echo $settings['text_2'] ?></h1>
				<h1 <?php echo $this->get_render_attribute_string( 'text_3' ); ?>><?php echo $settings['text_3'] ?></h1>
			</div>

			<div class="zami-gallery__images">
			<div class="uk-slider-container-offset" uk-slider>

				<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">

					<ul class="uk-slider-items uk-child-width-1-1@s uk-child-width-1-2@m  uk-child-width-1-3@l uk-grid uk-grid-small"  uk-scrollspy="cls: uk-animation-fade; target: li; delay: 250;">
						<?php foreach($settings['gallery_images'] as $index => $item){ ?>
							<li class="zami-gallery__item">
								<!-- <a href="#"> -->
									<img src="<?php echo $item['image']['url']; ?>">
								<!-- </a> -->
							</li>
						<?php } ?>
					</ul>

					<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
					<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

				</div>
				<ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>
				</div>

			</div>
		</div>
	<?php }
 }
