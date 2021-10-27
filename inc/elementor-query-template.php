<?php 

class All_in_elementor_query_template {

    public function __construct($template_name) {
        $this->query_part($template_name);
    }

    public function query_part($template_name) {

        $template_id = get_option($template_name);

        $args = array(
            'p'         => $template_id, // ID of a page, post, or custom type
            'post_type' => 'elementor_library'
        );

        $template_name = new WP_Query($args);

        if( $template_name->have_posts() ) {
            while( $template_name->have_posts() ) {  

                $template_name->the_post(); 
                the_content();

            }

        }
    }
}
