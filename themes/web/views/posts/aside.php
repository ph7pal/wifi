<div class="sidebar">
    <div class="mbox sideNav">        
        <?php
        if ($type == 'album') {
            echo '<h2>相册</h2>';
            $asides = Album::allAlbums(false);
            if (!empty($asides)) {
                ?>
                <ul>
                    <?php
                    foreach ($asides as $_sk => $_sc) {
                        if ($_sc['id'] == $colid) {
                            $class = 'current';
                        } else {
                            $class = '';
                        }
                        ?>
                        <li><?php echo CHtml::link($_sc['title'], array('posts/images', 'id' => $_sc['id']), array('class' => $class)); ?></li>
                    <?php } ?>
                </ul> 
                <?php
            }
        } elseif (!empty($likes)) {
            echo '<h2>相关文章</h2>';
            ?>
            <ul>
                <?php
                foreach ($likes as $like) {
                    ?>
                <li><?php echo CHtml::link(zmf::subStr($like['title'],10), array('posts/show', 'id' => $like['id']),array('title'=>$like['title'])); ?></li>
            <?php } ?>
            </ul>
            <?php
        } else {
            echo '<h2>导航</h2>';
            $asideCols = Columns::getAllByOne($colid, true);
            if (!empty($asideCols)) {
                ?>
                <ul>
                    <?php
                    foreach ($asideCols as $_ak => $_ac) {
                        if ($_ak == $colid) {
                            $class = 'current';
                        } else {
                            $class = '';
                        }
                        ?>
                        <li><?php echo CHtml::link($_ac, array('posts/index', 'colid' => $_ak), array('class' => $class)); ?></li>
                <?php } ?>
                </ul>
            <?php }
        }
        ?>
    </div>	
</div>