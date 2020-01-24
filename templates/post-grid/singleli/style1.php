<?php
    $itemstoshow = explode(',' , $_POST['show']);
?>
<li class="post-<?=the_ID()?> inlife-post-grid-style-1-item">
    <div class="background-block" style="background: url('<?=get_the_post_thumbnail_url($posts->post->ID)?>')">
        <a href="<?=the_permalink()?>"></a>
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

        </div>
    </div>
</li>