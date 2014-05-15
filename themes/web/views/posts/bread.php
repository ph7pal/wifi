<ol class="breadcrumb"> 
    <li>您的位置：</li> 
    <li><a href="<?php echo Yii::app()->baseUrl;?>">首页</a></li>         
    <?php 
    if($from!='search'){
    if($type=='album'){
        echo '<li>'.CHtml::link($info['title'],array('posts/images','id'=>$info['id'])).'</li>';
    }else{
        echo '<li>'.CHtml::link($info['title'],array('posts/index','colid'=>$info['id'])).'</li>';
    }
        echo '<li>'.$info['title'].'</li>';
    }else{
        echo '<li>'.CHtml::link('搜索',array('posts/search','keyword'=>$keyword)).'</li>';
        echo '<li>'.$keyword.'</li>';
    }
    ?>
</ol>