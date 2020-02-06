<?php

/*
 Element Description: Inlife Post Grid Results
*/

if(!class_exists('WPBakeryShortCode')) { return false; }

class vcInlifePostGridFilter extends WPBakeryShortCode {

    function __construct()
    {
        add_action('vc_before_init' , array($this , 'vc_inlife_post_grid_filter_mapping'));
        add_shortcode('vc_inlife_post_grid_filter' , array($this , 'vc_inlife_post_grid_filter_html'));
    }

    function get_all_post_types(){

        $post_types = get_post_types();
        return $post_types;

    }

    function get_all_taxonomies(){

        return get_taxonomies();

    }

    public function vc_inlife_post_grid_filter_mapping(){

        if( !defined('WPB_VC_VERSION') ){ return; }

        vc_map(
            array(
                'name' => __('Inlife Post Grid Filter' , 'inlife'),
                'base' => 'vc_inlife_post_grid_filter',
                'category' => __('Inlife Addons' , 'inlife'),
                'admin_enqueue_js' => plugin_dir_url(__FILE__).'../assets/js/inlife-wp-backery-addons.js',
                'icon' => plugin_dir_url(__FILE__).'../assets/logo-black-small.png',
                'params' => array(

                    array(
                        'type' => 'dropdown',
                        'class'      => '',
                        'heading'    => esc_html__('Post Type', 'inlife'),
                        'param_name' => 'post_type',
                        'save_always' => true,
                        'value' => $this->get_all_post_types(),
                        'group' => 'Query'
                    ),

                    array(
                        'type' => 'dropdown',
                        'class'      => '',
                        'heading'    => esc_html__('Taxonomy', 'inlife'),
                        'param_name' => 'taxonomy',
                        'save_always' => true,
                        'value' => $this->get_all_taxonomies(),
                        'group' => 'Query'
                    ),

                    array(
                        'type' => 'textfield',
                        'class'      => '',
                        'heading'    => esc_html__('Terms', 'inlife'),
                        'description' => 'Enter slugs for the terms from the taxonomy above. (separated by commas)',
                        'param_name' => 'terms',
                        'save_always' => true,
                        'group' => 'Query'
                    ),

                )
            )
        );

    }

    public function vc_inlife_post_grid_filter_html($atts){

        ob_start();
        include plugin_dir_path(__FILE__).'../templates/filter.php';
        return ob_get_clean();

    }

}

new vcInlifePostGridFilter();