<div class="postTags clearfix">
    <?php //$tags=Tags::getPostTags($page['id'],true);
    if (!empty($tags)) {
        ?>  
        <p class="tagsTitle floatL">标签：</p>
        <ul class="tagsList clearfix">
            <?php
            foreach ($tags as $_tag) {?>                            
                <li><?php echo CHtml::link($_tag, array('posts/index', 'tag' => $_tag)); ?></li>
            <?php } ?>
        </ul>
<?php } ?>
</div>