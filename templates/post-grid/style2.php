<?php

$id = rand(0 , 10000);

$posts = new WP_Query(
    array(
        'post_type' => $atts['post_type'],
        'posts_per_page' => $atts['number']
    )
);

$itemstoshow = explode(',' , $atts['show']);
?>
<ul data-style="2" data-buttontext="<?=$atts['button_text']?>" data-show="<?=$atts['show']?>" id="grid-<?=$id?>" class="inlife-post-grid columns-<?=$atts['number_in_row']?> <?=(isset($atts['has_filter']) && $atts['has_filter'] == 'yes') ? 'has_filter' : ''?>">
    <?php
    while($posts->have_posts()){

        if($posts->have_posts()){ $posts->the_post();

            ?>

            <li class="post-<?=$posts->post->ID?> type_<?=$atts['post_type']?> inlife-post-grid-style-2-item">
                <div class="background-block" style="background: url('<?=get_the_post_thumbnail_url($posts->post->ID)?>')">
                </div>

                <?php if(in_array('posted_by' , $itemstoshow) || in_array('posted_on' , $itemstoshow)){ ?>

                    <div class="meta">
                        <?=(in_array('posted_on' , $itemstoshow)) ? 'Date Posted: :'.get_the_date('jS F Y' , $posts->post->ID) : ''?>
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

                <?php if(isset($atts['buttontext'])){ ?>

                    <a href="<?=get_the_permalink($posts->post->ID)?>" class="button"><?=$atts['buttontext']?></a>

                <?php } ?>

            </li>

            <?php

        }

    }
    ?>
</ul>

<style>

    #grid-<?=$id?> .title{
        color: <?=$atts['title_colour']?>;
        font-size:<?=$atts['title_size']?>px;
    }

    #grid-<?=$id?> .button{
        background: <?=hex2rgba($atts['button_colour'] , 1)?>
    }

    #grid-<?=$id?> .button:hover{
        background: <?=hex2rgba($atts['button_hover_colour'] , 1)?>
    }

    #grid-<?=$id?> .excerpt{
        color: <?=$atts['excerpt_colour']?>;
        font-size:<?=$atts['excerpt_size']?>px;
    }

</style>

