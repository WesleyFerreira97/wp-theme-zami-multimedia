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

class All_in_widget_single extends Widget_Base {

    public function get_name() {
        return 'all-in-single';
    }

    public function get_title() {
        return 'Single Page';
    }

    public function get_categories() {
        return ['zami-single-page'];
    }

    public function _register_controls() {
          
        $this->start_controls_section (
            'all_in_base', 
            [
                'label' => __('Single Page'),
            ],
        );
        #Settings
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
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
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
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
                'selector' => '
                    {{WRAPPER}} .component-info__date,
                    {{WRAPPER}} .component-info__tag,
                    {{WRAPPER}} .component-info__comments,
                    {{WRAPPER}} .component-info__author
                    ',
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

        $this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
                'selectors' => [
					'{{WRAPPER}} .component-info' => 'background: {{VALUE}}',
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
			'excerpt_color',
			[
				'label' => __( 'Excerpt Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
                'selectors' => [
					'{{WRAPPER}} .component-info__excerpt' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'info_color',
			[
				'label' => __( 'Info Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
                'selectors' => [
					'{{WRAPPER}} .component-info__tag' => 'color: {{VALUE}}',
					'{{WRAPPER}} .component-info__date' => 'color: {{VALUE}}',
					'{{WRAPPER}} .component-info__comments' => 'color: {{VALUE}}',
					'{{WRAPPER}} .component-info__author' => 'color: {{VALUE}}',
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
				],
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
			'padding_info_container',
			[
				'label'      => esc_html__( 'Padding Info  - Container', 'plugin-domain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'rem', '%', 'em', 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .component-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_title',
			[
				'label'      => esc_html__( 'Padding Title', 'plugin-domain' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'rem', '%', 'em', 'px'],
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
				'size_units' => [ 'rem', '%', 'em', 'px'],
				'selectors'  => [
					'{{WRAPPER}} .component-info__excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
    }

    public function render() {
        $settings = $this->get_settings_for_display();

		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
        ?>

		<div class="component-image__wrap">
			<?php the_post_thumbnail(); ?>
		</div>
        <header class="component-info">
            <div class="component-info__wrap">
                <div class="component-info__bar">
                    <h3 class="component-info__tag">
						<?php
                          $ct = get_the_category();
                          $ct_name = $ct[0]->cat_name;
                          echo $ct_name;
                        ?>
					</h3>
                    <h3 class="component-info__author">
						<?php 
                            $author = get_the_author();
                            echo  $author; 
                          ?> 
					</h3>
                </div>
                <h1 class="component-info__title">
					<?php the_title(); ?>
				</h1>
                <h2 class="component-info__excerpt">RememberRemember the Riddle of the Sphinx? The impossible question asked by the mythological creature that guarded the city</h2>
                <div class="component-info__bar">
                    <h3 class="component-info__comments">
                        <i class="fas fa-comment-alt"></i>
                        <span>8</span>
                    </h3>
                    <h3 class="component-info__date">
					</h3>                    
                </div>
            </div>
        </header>
		<?php the_content(); ?>
        <?php
			}
		}
    }

}

