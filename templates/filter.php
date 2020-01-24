<?php
    $terms = explode(',' , $atts['terms']);
?>

<div class="inlife-post-grid-filter">
    <?php
        foreach($terms as $term){

            $termObj = get_term_by('slug' , $term , $atts['taxonomy']);

            ?>

            <a href="javascript:void(0);" data-term="<?=$termObj->name?>" data-posttype="<?=$atts['post_type']?>" data-taxonomy="<?=$atts['taxonomy']?>" class="inlife-post-grid-filter-toggle term_<?=$termObj->name?>"><?=$termObj->name?></a>

            <?php

        }

    ?>
    <a href="javascript:void(0);" data-term="all" data-posttype="<?=$atts['post_type']?>" data-taxonomy="<?=$atts['taxonomy']?>" class="inlife-post-grid-filter-toggle term_all">View All</a>

</div>