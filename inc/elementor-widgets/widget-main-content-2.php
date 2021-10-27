<?php 
/**
 * The default template for displaying content
 *
 * @author      OMA Themes
 * @link        http://omathemes.store
 */ 

 namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

 class All_in_widget_main_content_2 extends Widget_Base {

    public function get_name() {
        return 'all-in-main-content-2';
    }

    public function get_title() {
        return 'Main Content 2';
    }

    public function get_categories() {
        return ['first-category'];
    }

    public function _register_controls() {
        
        $this->start_controls_section (
            'all_in_main_content_2', 
            [
                'label' => __('Main Content'),
            ],
        );

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

        $this->add_control(
			'posts_count',
			[
				'label' => __( 'Posts Count', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 20,
				'step' => 1,
				'default' => 3,
			]
		);

        $this->end_controls_section();

        $this->start_controls_section (
            'main_content_show_hide', 
            [
                'label' => __('Show/Hide'),
            ],
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
				'label_on' => __( 'Show', 'plugin-domain' ),
				'label_off' => __( 'Hide', 'plugin-domain' ),
				'return_value' => 'yes',
				'default' => 'yes',
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
			'show_navbar',
			[
				'label' => __( 'Navbar', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'plugin-domain' ),
				'label_off' => __( 'Hide', 'plugin-domain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'main_content_sizes',
			[
				'label' => __( 'Sizes', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
			'main_content_height',
			[
				'label' => __( 'Main Content - Height', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '100',
					'unit' => 'vh',
				],
				'tablet_default' => [
					'size' => '100',
					'unit' => 'vh',
				],
				'mobile_default' => [
					'size' => '100',
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
					'{{WRAPPER}} .main-content__wrapper' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'inner_width',
			[
				'label' => __( 'Inner Width', 'elementor' ),
				// 'devices' => [ 'tablet', 'mobile' ],
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'vh' ],
				'range' => [
					'%' => [
						'min' => 60,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 92,
					'unit' => '%',
				],
				'tablet_default' => [
					'size' => 100,
					'unit' => '%',
				],
				'mobile_default' => [
					'size' => 100,
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .carousel__item' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .carousel-bar__controls--wrap' => 'width: {{SIZE}}{{UNIT}};',
					'(tablet) {{WRAPPER}} .carousel__item' => 'flex-direction: column;',
				],
			]
		);

		$this->add_control(
			'inner_height',
			[
				'label' => __( 'Inner Height (desktop only)', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'vh' ],
				'range' => [
					'%' => [
						'min' => 40,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 68,
					'unit' => '%',
				],
				'tablet_default' => [
					'size' => 68,
					'unit' => '%',
				],
				'mobile_default' => [
					'size' => 68,
					'unit' => '%',
				],
				'selectors' => [
					'(desktop+) {{WRAPPER}} .carousel__item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'background_width',
			[
				'label' => __( 'Background Width ( Desktop Only )', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', '' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 50,
					'unit' => '%',
				],
				'selectors' => [
					'(desktop+) {{WRAPPER}} .main-content__model-2::before' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'align_content',
			[
				'label' => __( 'Align Content ( Desktop Only )', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', '' ],
				'devices' => [ 'desktop'  ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 55,
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .component-image__wrap' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .carousel-bar__controls--wrap::before' => 'width: 0;',
					'(desktop+) {{WRAPPER}} .carousel-bar__controls--wrap::before' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);  

        $this->end_controls_section();

		$this->start_controls_section(
			'main_content_colors',
			[
				'label' => __( 'Colors', 'plugin-name' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
                'name' => 'main_content_background_primary',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '(desktop+)  {{WRAPPER}} .main-content__model-2::before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
                'name' => 'main_content_background_secondary',
				'label' => __( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .main-content__model-2',
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
			]
		);
		
        $this->add_control(
			'tag_color',
			[
				'label' => __( 'Tag Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
                'selectors' => [
					'{{WRAPPER}} .component-info__tag' => 'color: {{VALUE}}',
					'{{WRAPPER}} .play-now__wrap' => 'color: {{VALUE}}',
					'{{WRAPPER}} .play-now__wrap .play' => 'color: {{VALUE}}',
				],
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
					'{{WRAPPER}} .component-info__title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .component-info__author' => 'color: {{VALUE}}',
					'{{WRAPPER}} .component-info__date' => 'color: {{VALUE}}',
					'{{WRAPPER}} .component-info__comments' => 'color: {{VALUE}}',
					'{{WRAPPER}} .controls__index' => 'color: {{VALUE}}',
					'{{WRAPPER}} .button-border' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .button-border svg polyline' => 'stroke: {{VALUE}} !important',
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
					'{{WRAPPER}} .component-info__next-item' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();
		
		#TYPOGRAPHY
		$this->start_controls_section(
			'main-content_typography',
			[
				'label' => __( 'Typography', 'plugin-domain' ),
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
                'name' => 'typography_info',
                'label' => __( 'Typography Info', 'plugin-domain' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '
					{{WRAPPER}} .component-info__tag,
					{{WRAPPER}} .component-info__date,
					{{WRAPPER}} .component-info__comments,
					{{WRAPPER}} .component-info__author',
			],
		);
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name' => 'typography_excerpt',
                'label' => __( 'Typography Excerpt', 'plugin-domain' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '
					{{WRAPPER}} .component-info__excerpt,
					{{WRAPPER}} .component-info__next-item',
			],
		);
		        
        $this->end_controls_section();

        #STYLEEE
		$this->start_controls_section(
			'main_content_alignment',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'align_info',
			[
				'label'      => esc_html__( 'Align Info ( Content ) ', 'plugin-domain' ),
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
					'{{WRAPPER}} .component-info__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'align_controls',
			[
				'label'      => esc_html__( 'Align Controls', 'plugin-domain' ),
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
				'allowed_dimensions' => ['top', 'bottom'],
				'separator' => 'after',
				'selectors'  => [
					'{{WRAPPER}} .controls' => 'padding: {{TOP}}{{UNIT}} {{align_info.RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{align_info.LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_title',
			[
				'label'      => esc_html__( 'Margin Title', 'plugin-domain' ),
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
					'{{WRAPPER}} .component-info__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_info',
			[
				'label'      => esc_html__( 'Margin Info', 'plugin-domain' ),
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
					'{{WRAPPER}} .component-info__bar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_excerpt',
			[
				'label'      => esc_html__( 'Margin Excerpt', 'plugin-domain' ),
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
					'{{WRAPPER}} .component-info__excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_section();
	}
	
	public function main_content_1($active, $taxonomy) {

		$settings = $this->get_settings_for_display();
		$item_active = '';

		if($active) {
			$item_active = 'carousel__item--active active-default ';
		}


		
	?>
			<div class="carousel__item <?php echo $item_active ?> ">
				
				<div class="component-image__wrap">
						<img src="<?= the_post_thumbnail_url(); ?>" >
				</div>
				
				<div class="component-info">
					<div class="overflow-h">
						<div class="component-info__wrap">
							<div class="component-info__content">
								<div class="component-info__bar">
									<h4 class="component-info__tag">
										<?php $catInfo = get_category_by_slug($taxonomy[0]); 
											$catName = $catInfo->name; 
											echo $catName; ?>
									</h4>
									<h4 class="component-info__author"><?= get_the_author_meta('display_name'); ?></h4>
								</div>
								<h2 class="component-info__title">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								</h2>

								<?php if($settings['show_excerpt']) { ?>
									<div class="component-info__excerpt"><?php the_excerpt(); ?></div>
								<?php } ?>

								<div class="component-info__bar">
								<?php if($settings['show_comments_icon'] ) { ?>
									<div class="component-info__comments">
										<span uk-icon="comments"></span>
										<!-- <i class="fas fa-comment-alt"></i> -->
										<span>8</span>
									</div>
								<?php }; ?>
								<?php if($settings['show_comments_icon'] ) { ?>
									<span uk-icon="calendar"></span>
									<h5 class="component-info__date"><?= get_the_date(); ?></h5>
								<?php }; ?>
								</div>

								<audio class="media" controls="controls">
									<!-- <source src="https://nerdcast.jovemnerd.com.br/nerdcast_speak_english_33.mp3"> -->
								</audio>
							</div>
						</div>
					</div>
                </div>
            </div>
		<?php 
	}

    public function render() {

		$settings = $this->get_settings_for_display();
		$taxonomy = $settings['taxonomies'];
		$posts_count = $settings['posts_count'];


		
        ?>
			<main class="main-content__model-2">
				<div id="carousel-one" class="main-content__wrapper" data-wrap="carousel">

				<?php 
					$args = array (
							// 'order' => $show_by,
							'post_type' => 'post',
							'post_status' => 'publish',
							'posts_per_page' => 1,
							'tax_query' => array(
								array(
								'taxonomy' => 'category',
								'field' => 'slug',
								'terms' => $taxonomy,
								),
							),
						);
						
					$tax_query = new \WP_Query( $args );
					
					if( $tax_query->have_posts() ) {
						while( $tax_query->have_posts() ) {  
						$tax_query->the_post(); 
						
						echo $this->main_content_1(true, $taxonomy);

						wp_reset_postdata();

						}
					} 
						$args2 = array (
							'post_type' => 'post',
							'post_status' => 'publish',
							'posts_per_page' => $posts_count,
							'offset' => 1,
							'tax_query' => array(
								array(
								'taxonomy' => 'category',
								'field' => 'slug',
								'terms' => $taxonomy,
								),
							),
						);

					$tax_querya = new \WP_Query( $args2 );
					
					if( $tax_querya->have_posts() ) {
						while( $tax_querya->have_posts() ) {  
						$tax_querya->the_post(); 
						
						echo $this->main_content_1(false, $taxonomy);

						wp_reset_postdata();
						}
					} ?>
				</div>

				<!-- CONTROLS -->
				<?php if($settings['show_navbar'] ) { ?>
				<div class="carousel-bar">
						<div class="carousel-bar__controls--wrap">
							<div class="controls">
								<div class="controls__content--1">
									<div class="controls__button" data-carousel="carousel-one" data-control="prev">
										<span class="button-border" uk-icon="chevron-left"></span>
									</div>
									<div class="controls__button" data-carousel="carousel-one" data-control="next">
										<span class="button-border" uk-icon="chevron-right"></span>
									</div>
									<div class="controls__index" data-carousel="carousel-one" data-index="carousel"></div>
								</div>
								<div>
									<h4 class="component-info__next-item" data-info="carousel"></h4>
								</div>
							</div>
						</div>
				</div>
				<?php } ?>
				
			</main>

        <?php 
    }

 }