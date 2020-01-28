<?php

/*
Element Description: Vehicles Monthly Price Filter
*/

if(!class_exists('WPBakeryShortCode')) { return false; }

class vcInlifeHoverImage extends WPBakeryShortCode
{

    function __construct()
    {
        add_action('vc_before_init', array($this, 'vc_hover_image_mapping'));
        add_shortcode('vc_hover_image', array($this, 'vc_hover_image_html'));
    }

    public function vc_hover_image_mapping() {

        // Stop all if VC is not enabled

        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()

        vc_map(

            array(
                'name' => __('Hover Image', 'text-domain'),
                'base' => 'vc_hover_image',
                'category' => __('Inlife Addons' , 'inlife'),
                'params' => array(

                    array(
                        'type'        => 'attach_image',
                        'heading'     => __('Image'),
                        'param_name'  => '_general_image',
                        'admin_label' => true,
                        'group' => 'General',
                    ),

                    array(
                        'type'        => 'vc_link',
                        'heading'     => __('Link'),
                        'param_name'  => '_general_link',
                        'admin_label' => false,
                        'group' => 'General',
                    ),

                    array(
                        'type'        => 'attach_image',
                        'heading'     => __('Image'),
                        'param_name'  => '_hover_image',
                        'admin_label' => true,
                        'group' => 'Hover',
                    ),

                )
            )
        );

    }

    function vc_hover_image_html($attrs){

        $generalImage = wp_get_attachment_url($attrs['_general_image']);
        $hoverImage = wp_get_attachment_url($attrs['_hover_image']);

        $href = vc_build_link($attrs['_general_link']);

        if($href){

            $html  = '<a href="'.$href['url'].'" class="vc-hover-image-element">';
                $html .= '<img src="'.$generalImage.'" data-hover="'.$hoverImage.'" data-src="'.$generalImage.'">';
            $html .= '</a>';

        }else{

            $html  = '<div class="vc-hover-image-element">';
                $html .= '<img src="'.$generalImage.'" data-hover="'.$hoverImage.'" data-src="'.$generalImage.'">';
            $html .= '</div>';

        }

        return $html;

    }

}

new vcInlifeHoverImage();

?>