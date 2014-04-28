<?php $colitems = Posts::allPosts($colid); ?>
<ul>
    <?php if (!empty($colitems)) {
        foreach ($colitems as $ci) { ?>  
            <li>
        <?php echo CHtml::link(zmf::subStr($ci['title'], 15), array('posts/show', 'id' => $ci['id'])); ?>
                <span class="date"><?php echo date('m-d', $ci['cTime']); ?></span>
            </li>
    <?php }} ?>
</ul>    