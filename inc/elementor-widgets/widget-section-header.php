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

class Zami_widget_section_header extends Widget_Base {

    public function get_name() {
        return 'all-in-section-header';
    }

    public function get_title() {
        return 'Section Header';
    }

    public function get_categories() {
        return ['first-category'];
    }

    public function _register_controls() {
        
        $this->start_controls_section (
            'all_in_section_header', 
            [
                'label' => __('Section Header'),
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
				'label' => __( 'Select Tags', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $choices,
				'default' => [$default_cat[0]],
			]
		);
		
        $this->add_control(
			'title',
			[
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 2,
				'placeholder' => __( 'Enter your title', 'plugin-domain' ),
				'default' => __( 'Add Your Heading Text Here', 'plugin-domain' ),
			]
		);

        $this->add_control(
			'sub_title',
			[
				'label' => __( 'Sub Title', 'plugin-domain' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 2,
				'placeholder' => __( 'Enter your title', 'plugin-domain' ),
				'default' => __( 'Add Your Heading Text Here', 'plugin-domain' ),
			]
		);

        $this->add_control(
			'card_style',
			[
				'label' => __( 'Card Style', 'plugin-domain' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'card--bottom-info',
				'options' => [
					'card--inner-info' => __( 'Inner', 'plugin-domain' ),
					'card--bottom-info' => __( 'Bottom Info', 'plugin-domain' ),
				],
			]
        );

        $this->add_control(
			'show_menu',
			[
				'label' => __( 'Show Menu', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'plugin-domain' ),
				'label_off' => __( 'Hide', 'plugin-domain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );

        $this->end_controls_section();

        #STYLEEE
		$this->start_controls_section(
			'main_content_style',
			[
				'label' => __( 'Style', 'plugin-name' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		#COLOR
        $this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
                'selectors' => [
					'{{WRAPPER}} .section-navbar__title' => 'color: {{VALUE}}',
				],
			]
        );
        
        $this->add_control(
			'sub_title_color',
			[
				'label' => __( 'Sub Title Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
                'selectors' => [
					'{{WRAPPER}} .section-navbar__sub-title' => 'color: {{VALUE}}',
				],
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
				'selector' => '{{WRAPPER}} .section-navbar__title',
			]
        );
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
                'name' => 'typography_sub_title',
                'label' => __( 'Typography Sub Title', 'plugin-domain' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .section-navbar__sub-title',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_icon',
			[
				'label' => __( 'Icon', 'elementor' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'social',
				'default' => [
					'value' => 'fab fa-wordpress',
					'library' => 'fa-brands',
				],
				'recommended' => [
					'fa-brands' => [
						'android',
						'apple',
						'behance',
						'bitbucket',
						'codepen',
						'delicious',
						'deviantart',
						'digg',
						'dribbble',
						'elementor',
						'facebook',
						'flickr',
						'foursquare',
						'free-code-camp',
						'github',
						'gitlab',
						'globe',
						'houzz',
						'instagram',
						'jsfiddle',
						'linkedin',
						'medium',
						'meetup',
						'mix',
						'mixcloud',
						'odnoklassniki',
						'pinterest',
						'product-hunt',
						'reddit',
						'shopping-cart',
						'skype',
						'slideshare',
						'snapchat',
						'soundcloud',
						'spotify',
						'stack-overflow',
						'steam',
						'telegram',
						'thumb-tack',
						'tripadvisor',
						'tumblr',
						'twitch',
						'twitter',
						'viber',
						'vimeo',
						'vk',
						'weibo',
						'weixin',
						'whatsapp',
						'wordpress',
						'xing',
						'yelp',
						'youtube',
						'500px',
					],
					'fa-solid' => [
						'envelope',
						'link',
						'rss',
					],
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

		$repeater->add_control(
			'item_icon_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Official Color', 'elementor' ),
					'custom' => __( 'Custom', 'elementor' ),
				],
			]
		);

		$repeater->add_control(
			'item_icon_primary_color',
			[
				'label' => __( 'Primary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'item_icon_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.elementor-social-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'item_icon_secondary_color',
			[
				'label' => __( 'Secondary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'item_icon_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.elementor-social-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}}.elementor-social-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		
		$this->add_control(
			'social_icon_list',
			[
				'label' => __( 'Social Icons', 'elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'social_icon' => [
							'value' => 'fab fa-facebook',
							'library' => 'fa-brands',
						],
					],
					[
						'social_icon' => [
							'value' => 'fab fa-twitter',
							'library' => 'fa-brands',
						],
					],
					[
						'social_icon' => [
							'value' => 'fab fa-youtube',
							'library' => 'fa-brands',
						],
					],
				],
				'title_field' => '<# var migrated = "undefined" !== typeof __fa4_migrated, social = ( "undefined" === typeof social ) ? false : social; #>{{{ elementor.helpers.getSocialNetworkNameFromIcon( social_icon, social, true, migrated, true ) }}}',
			]
		);

		        
        $this->end_controls_section();

        #STYLEEE
		$this->start_controls_section(
			'main_content_spacing',
			[
				'label' => __( 'Spacing', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'margin_content',
			[
				'label'      => esc_html__( 'Margin Content', 'plugin-domain' ),
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
					'{{WRAPPER}} .section-navbar__header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .section-navbar__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_sub-title',
			[
				'label'      => esc_html__( 'Margin Sub-Title', 'plugin-domain' ),
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
					'{{WRAPPER}} .section-navbar__sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
    }

    public function render() {

		$settings = $this->get_settings_for_display();

		if ( '' === $settings['title'] ) {
			return;
		}

		$this->add_render_attribute( 'title', 'class', 'section-navbar__title' );
		$this->add_render_attribute( 'sub_title', 'class', 'section-navbar__sub-title' );
		
		
		$this->add_inline_editing_attributes('sub_title');

		?>

		<div id="" class="section-navbar">

			<div class="section-navbar__header">
				<h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>
				<h3 <?php echo $this->get_render_attribute_string( 'sub_title' ); ?>><?php echo $settings['sub_title'] ?></h3>
			</div>

			<div class="section-navbar__menu">

			</div>
		</div>
	<?php }
 }
