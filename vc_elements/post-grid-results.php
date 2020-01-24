<?php

/*
 Element Description: Inlife Post Grid Results
*/

if(!class_exists('WPBakeryShortCode')) { return false; }

class vcInlifePostGridResults extends WPBakeryShortCode {

    function __construct()
    {
        add_action('vc_before_init' , array($this , 'vc_inlife_post_grid_results_mapping'));
        add_shortcode('vc_inlife_post_grid_results' , array($this , 'vc_inlife_post_grid_results_html'));
    }

    function get_all_post_types(){

        $post_types = get_post_types();
        return $post_types;

    }

    function get_all_opacity(){

        return array(
            '10%' => '0.1',
            '20%' => '0.2',
            '30%' => '0.3',
            '40%' => '0.4',
            '50%' => '0.5',
            '60%' => '0.6',
            '70%' => '0.7',
            '80%' => '0.8',
            '90%' => '0.9',
            '100%' => '1',
        );

    }

    function get_all_font_sizes(){

        return array(
            '14px' => 14,
            '16px' => 16,
            '18px' => 18,
            '20px' => 20,
            '22px' => 22,
            '24px' => 24,
            '26px' => 26,
            '28px' => 28,
            '30px' => 30
        );

    }

    public function vc_inlife_post_grid_results_mapping(){

        if( !defined('WPB_VC_VERSION') ){ return; }

        vc_map(
            array(
                'name' => __('Inlife Post Grid Results' , 'inlife'),
                'base' => 'vc_inlife_post_grid_results',
                'description' => __('Post grid that works with the Post Grid Filter element' , 'inlife'),
                'category' => __('Inlife Addons' , 'inlife'),
                'admin_enqueue_js' => plugin_dir_url(__FILE__).'../assets/js/inlife-wp-backery-addons.js',
                'params' => array(

                    array(
                        'type' => 'dropdown',
                        'class'      => '',
                        'heading'    => esc_html__('Style', 'inlife'),
                        'param_name' => 'style',
                        'std' => 1,
                        'value' => array(
                            'Style 1' => '1',
                            'Style 2' => '2'
                        ),
                        'admin_label' => true,
                        'save_always' => true,
                        'group' => 'Design'
                    ),

                    array(
                        'type' => 'dropdown',
                        'class'      => '',
                        'heading'    => esc_html__('Has Filter', 'inlife'),
                        'param_name' => 'has_filter',
                        'save_always' => true,
                        'std' => 'no',
                        'value' => array(
                            'No' => 'no',
                            'Yes' => 'yes'
                        ),
                        'group' => 'Design'
                    ),

                    array(
                        'type' => 'dropdown',
                        'class'      => '',
                        'heading'    => esc_html__('Number of posts in a row', 'inlife'),
                        'param_name' => 'number_in_row',
                        'save_always' => true,
                        'group' => 'Design',
                        'std' => 2,
                        'value' => array(
                            2,
                            3,
                            4,
                            5,
                            6
                        )
                    ),

                    array(
                        'type' => 'textfield',
                        'class'      => '',
                        'heading'    => esc_html__('Button Text', 'inlife'),
                        'param_name' => 'button_text',
                        'save_always' => true,
                        'group' => 'Button',
                    ),

                    array(
                        'type' => 'colorpicker',
                        'class'      => '',
                        'heading'    => esc_html__('Button Colour', 'inlife'),
                        'param_name' => 'button_colour',
                        'save_always' => true,
                        'group' => 'Button',
                    ),

                    array(
                        'type' => 'colorpicker',
                        'class'      => '',
                        'heading'    => esc_html__('Button Hover Colour', 'inlife'),
                        'param_name' => 'button_hover_colour',
                        'save_always' => true,
                        'group' => 'Button',
                    ),


                    // Query fields

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
                        'type' => 'checkbox',
                        'class'      => '',
                        'heading'    => esc_html__('Show', 'inlife'),
                        'description' => __('Parts of post to show' , 'inlife'),
                        'param_name' => 'show',
                        'value' => array(
                            'Title' => 'post_title',
                            'Excerpt' => 'post_excerpt',
                            'Posted On' => 'posted_on'
                        ),
                        'save_always' => true,
                        'group' => 'Query'
                    ),

                    array(
                        'type' => 'textfield',
                        'class'      => '',
                        'heading'    => esc_html__('Number Of Posts Shown', 'inlife'),
                        'param_name' => 'number',
                        'save_always' => true,
                        'group' => 'Query'
                    ),

                    // TEXT STYLES

                    array(
                        'type' => 'colorpicker',
                        'class'      => '',
                        'heading'    => esc_html__('Title Colour', 'inlife'),
                        'param_name' => 'title_colour',
                        'group' => 'Text Style',
                        'dependency' => array(
                            'element' => 'show',
                            'value' => 'post_title',
                        )
                    ),

                    array(
                        'type' => 'dropdown',
                        'class'      => '',
                        'heading'    => esc_html__('Title Size', 'inlife'),
                        'param_name' => 'title_size',
                        'group' => 'Text Style',
                        'value' => $this->get_all_font_sizes(),
                        'dependency' => array(
                            'element' => 'show',
                            'value' => 'post_title',
                        )
                    ),

                    array(
                        'type' => 'colorpicker',
                        'class'      => '',
                        'heading'    => esc_html__('Excerpt Colour', 'inlife'),
                        'param_name' => 'excerpt_colour',
                        'group' => 'Text Style',
                        'dependency' => array(
                            'element' => 'show',
                            'value' => 'post_excerpt',
                        )
                    ),

                    array(
                        'type' => 'dropdown',
                        'class'      => '',
                        'heading'    => esc_html__('Excerpt Size', 'inlife'),
                        'param_name' => 'excerpt_size',
                        'value' => $this->get_all_font_sizes(),
                        'group' => 'Text Style',
                        'dependency' => array(
                            'element' => 'show',
                            'value' => 'post_excerpt',
                        )
                    ),

                    // STYLE 1 Fields

                    array(
                        'type' => 'colorpicker',
                        'class'      => '',
                        'heading'    => esc_html__('Hover Colour', 'inlife'),
                        'param_name' => 'style1_hover_colour',
                        'group' => 'Hover',
                        'dependency' => array(
                            'element' => 'style',
                            'value' => '1',
                        )
                    ),

                    array(
                        'type' => 'dropdown',
                        'class'      => '',
                        'heading'    => esc_html__('Hover Colour Opacity', 'inlife'),
                        'param_name' => 'style1_hover_opacity',
                        'group' => 'Hover',
                        'value' => $this->get_all_opacity(),
                        'dependency' => array(
                            'element' => 'style',
                            'value' => '1',
                        )
                    )

                )
            )
        );

    }

    public function vc_inlife_post_grid_results_html($atts){

        ob_start();
        include plugin_dir_path(__FILE__).'../templates/post-grid/style'.$atts['style'].'.php';
        return ob_get_clean();

    }

}

new vcInlifePostGridResults();