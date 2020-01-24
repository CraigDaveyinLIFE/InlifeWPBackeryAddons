<?php

/*
 *
 * Plugin Name: Inlife WP Backery Addons
 * Plugin URI: https://github.com/CraigDaveyinLIFE/InlifeWPBackeryAddons
 * Author: inLIFE Design
 * Author URI: https://www.inlife.co.uk/
 * Description: This is the inlife wp backery addons plugin.
 * Version: 1.1
 *
 */

add_action('init' , 'inlife_wp_backery_addons');

function inlife_wp_backery_addons(){
    require_once plugin_dir_path(__FILE__) . '/vc_elements/post-grid-results.php';
    require_once plugin_dir_path(__FILE__) . '/vc_elements/hover-image.php';
    require_once plugin_dir_path(__FILE__) . '/vc_elements/post-grid-filter.php';
}

add_action('wp_enqueue_scripts' , 'inlife_wp_backery_addons_styles_scripts' , 99);

function inlife_wp_backery_addons_styles_scripts(){
    wp_enqueue_style('inlife-wpb-addons-post-grid' , plugin_dir_url(__FILE__).'/assets/css/post-grid.css');
    wp_enqueue_script('inlife-wpb-addons' , plugin_dir_url(__FILE__).'/assets/js/inlife-wp-backery-addons.js' , array( 'jquery' ) , '' , true);
    wp_localize_script( 'inlife-wpb-addons', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

function hex2rgba($color, $opacity = false) {

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if(empty($color))
        return $default;

    //Sanitize $color if "#" is provided
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if($opacity){
        if(abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(",",$rgb).')';
    }

    //Return rgb(a) color string
    return $output;
}

add_action( 'wp_ajax_filter_posts', 'filter_posts' );
add_action( 'wp_ajax_nopriv_filter_posts', 'filter_posts' );

function filter_posts(){

    if($_POST['term'] == 'all'){

        $posts = new WP_Query(
            array(
                'post_type' => $_POST['post_type'],
                'posts_per_page' => -1
            )
        );

    }else{

        $posts = new WP_Query(
            array(
                'post_type' => $_POST['post_type'],
                'tax_query' => array(
                    array(
                        'taxonomy' => $_POST['taxonomy'],
                        'field' => 'name',
                        'terms' => array($_POST['term'])
                    )
                )
            )
        );

    }

    $style = $_POST['style'];

    $itemstoshow = explode(',' , $_POST['show']);

    if($posts->have_posts()){

        while ($posts->have_posts()){ $posts->the_post();

           if($style == 1){

               ?>

               <li class="post-<?=$posts->post->ID?> inlife-post-grid-style-1-item">
                   <div class="background-block" style="background: url('<?=get_the_post_thumbnail_url($posts->post->ID)?>')">
                       <a class="full-a" href="<?=get_the_permalink($posts->post->ID)?>"></a>
                       <div class="overlay">

                           <?php if(in_array('post_title' , $itemstoshow)){ ?>
                               <div class="title">
                                   <?=get_the_title($posts->post->ID)?>
                               </div>
                           <?php } ?>

                           <?php if(in_array('post_excerpt' , $itemstoshow)){ ?>
                               <div class="excerpt">
                                   <?=get_the_excerpt($posts->post->ID)?>
                               </div>
                           <?php } ?>

                           <?php if(isset($_POST['buttontext'])){ ?>

                               <a href="<?=get_the_permalink($posts->post->ID)?>" class="button"><?=$_POST['buttontext']?></a>

                           <?php } ?>

                       </div>
                   </div>
               </li>

               <?php

           }elseif($style == 2){

               ?>

               <li class="post-<?=$posts->post->ID?> inlife-post-grid-style-2-item">
                   <div class="background-block" style="background: url('<?=get_the_post_thumbnail_url($posts->post->ID)?>')">
                   </div>

                   <?php if(in_array('posted_by' , $itemstoshow) || in_array('posted_on' , $itemstoshow)){ ?>

                       <div class="meta">
                           <?=(in_array('posted_on' , $itemstoshow)) ? 'Date Posted: '.get_the_date('jS F Y' , $posts->post->ID) : ''?>
                       </div>

                   <?php } ?>

                   <?php if(in_array('post_title' , $itemstoshow)){ ?>
                       <div class="title">
                           <?=get_the_title($posts->post->ID)?>
                       </div>
                   <?php } ?>

                   <?php if(in_array('post_excerpt' , $itemstoshow)){ ?>
                       <div class="excerpt">
                           <?=get_the_excerpt($posts->post->ID)?>
                       </div>
                   <?php } ?>

                   <?php if(isset($_POST['buttontext'])){ ?>

                       <a href="<?=get_the_permalink($posts->post->ID)?>" class="button"><?=$_POST['buttontext']?></a>

                   <?php } ?>

               </li>

                <?php

           }

        }

    }

    die();

}