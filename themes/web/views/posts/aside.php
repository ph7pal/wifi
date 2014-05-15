<div class="sidebar">
<div class="mbox sideNav">        
<?php
if($from!='search'){
if ($type == 'album') {
    echo '<h2>相册</h2>';
    $asides = Album::allAlbums(false);
    if (!empty($asides)) {
        echo "<ul>";
        foreach ($asides as $_sk => $_sc) {
            if ($_sc['id'] == $colid) {
                $class = 'current';
            } else {
                $class = '';
            }
            echo '<li>' . CHtml::link($_sc['title'], array('posts/images', 'id' => $_sc['id']), array('class' => $class)) . '</li>';
        }
        echo "</ul>";
    }
} elseif (!empty($likes)) {
    echo '<h2>相关文章</h2>';
    echo "<ul>";
    foreach ($likes as $like) {
        echo '<li>' . CHtml::link(zmf::subStr($like['title'], 10), array('posts/show', 'id' => $like['id']), array('title' => $like['title'])) . '</li>';
    }
    echo "</ul>";
} else {
    echo '<h2>导航</h2>';
    $asideCols = Columns::getAllByOne($colid, true);
    if (!empty($asideCols)) {
        echo "<ul>";
        foreach ($asideCols as $_ak => $_ac) {
            if ($_ak == $colid) {
                $class = 'current';
            } else {
                $class = '';
            }
            echo '<li>' . CHtml::link($_ac, array('posts/index', 'colid' => $_ak), array('class' => $class)) . '</li>';
        }
        echo "</ul>";
    }
}
}else{
    echo '<h2>热门搜索</h2>';
    echo "<ul>";
    $tops=  SearchRecords::tops();
    if(!empty($tops)){
        foreach($tops as $top){
            echo '<li>' . CHtml::link($top['title'], array('posts/search', 'keyword' => $top['title'])) . '</li>';
        }
    }    
    echo "</ul>";
}
?>
</div>
</div>