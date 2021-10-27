<?php /**
 * The default template for displaying content
 *
 * @author      OMA Themes
 * @link        http://omathemes.store
 */ 

namespace Elementor;

class All_in_widget_footer extends Widget_Base {
    
    public function get_name() {
        return 'all-in-footer';
    }

    public function get_title() {
        return 'Footer';
    }

    public function get_icon() {
        return 'fa fa-font';
    }

    public function get_categories() {
        return ['first-category'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'all_in_footer',
            [
                'label' => __('Footer'),
            ]
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
				'label' => __( 'Show Elements', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'multiple' => true,
				'options' => $post_types_final,
				'default' => 'post',
			]
		);

		// Select Categories
		$defaults = array( 'post_type' => 'movie' );
		$choices = array();
		$default_cat = [];
		$categories = get_posts($defaults);

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
				// 'default' => [$default_cat[0]],
			]
		);
    }

    protected function render() {
		
		$settings = $this->get_settings_for_display();
		?>

	<?php

    }
}

// navbar-icons__item navbar-icon elementor-social-icona

