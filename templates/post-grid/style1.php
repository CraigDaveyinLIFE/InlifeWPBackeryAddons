<?php

    $id = rand(0 , 10000);

    $args = array(
        'post_type' => $atts['post_type'],
        'posts_per_page' => ($atts['number'] != '') ? $atts['number'] : -1
    );

    if($atts['has_filter'] == 'no' && $atts['taxonomy'] != '' && $atts['terms'] != ''){

        $args['tax_query'][] = array(
            'taxonomy' => $atts['taxonomy'],
            'field' => 'slug',
            'terms' => explode(','  , $atts['terms'])
        );

    }

    $posts = new WP_Query($args);

    $itemstoshow = explode(',' , $atts['show']);
?>
<ul data-style="1" data-buttontext="<?=$atts['button_text']?>" data-show="<?=$atts['show']?>" id="grid-<?=$id?>" class="inlife-post-grid columns-<?=$atts['number_in_row']?> <?=(isset($atts['has_filter']) && $atts['has_filter'] == 'yes') ? 'has_filter' : ''?>">
    <?php
        while($posts->have_posts()){

            if($posts->have_posts()){ $posts->the_post();

                ?>

                    <li class="post-<?=$posts->post->ID?> type_<?=$atts['post_type']?> inlife-post-grid-style-1-item">
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

                                <?php if(isset($atts['button_text'])){ ?>

                                    <a href="<?=get_the_permalink($posts->post->ID)?>" class="button"><?=$atts['button_text']?></a>

                                <?php } ?>

                            </div>
                        </div>
                    </li>

                <?php

            }

        }
    ?>
</ul>

<style>

    #grid-<?=$id?> .overlay{
        background: <?=hex2rgba($atts['style1_hover_colour'] , $atts['style1_hover_opacity'])?>
    }

    #grid-<?=$id?> .button{
        background: <?=hex2rgba($atts['button_colour'] , 1)?>
    }

    #grid-<?=$id?> .button:hover{
        background: <?=hex2rgba($atts['button_hover_colour'] , 1)?>
    }

    #grid-<?=$id?> .title{
        color: <?=$atts['title_colour']?>;
        font-size:<?=$atts['title_size']?>px;
    }

    #grid-<?=$id?> .excerpt{
        color: <?=$atts['excerpt_colour']?>;
        font-size:<?=$atts['excerpt_size']?>px;
    }

</style>