<?php
$itemstoshow = explode(',' , $_POST['show']);
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
</li>